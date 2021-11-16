<?php


		$moduleName = "requests";
		$prefix = "./modules/".$moduleName."/";
		
		$tpl->define(array(
				$moduleName => $prefix . $moduleName.".tpl",
				$moduleName . "tab1_row" => $prefix . "tab1_row.tpl",
				$moduleName . "tab2_row" => $prefix . "tab2_row.tpl",
				$moduleName . "tab3_row" => $prefix . "tab3_row.tpl",
				$moduleName . "tab4_row" => $prefix . "tab4_row.tpl",
				$moduleName . "tab5_row" => $prefix . "tab5_row.tpl",
				$moduleName . "tab6_row" => $prefix . "tab6_row.tpl",

		));

		# SETTINGS #############################################################################
		
		# Таблица статусы 

		# Житель - 1
			#	Новая заявка (Житель может создать заявку)
		# ОСИ - 2
			# 	Новая заявка (ОСИ может создать заявку без жителя)
			# 	Принято ОСИ
			# 	Не принято ОСИ
		# УК - 3

		# Выполнено - 4
			#	Выполнено ОСИ
			#	Не выполнено ОСИ
			#	Выполнено УК
			#	Не выполнено УК
			#	Ожидание оценки

		$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); 

		$newFileName1 = '';
		$newFileName2 = '';
		$newFileName3 = '';
		$newFileName4 = '';

		$house_list = '';
		$uc_list = '';
		$worker_list  = '';
		$button = '';

		# Functions #################################################################################

		function noticeUsers( $author_id, $author_type, $for_id, $for_type, $title, $description, $house_id, $flat_id, $url){
		
		$sql = "INSERT module_notifications SET author_id = '".$author_id."',
											author_type = '".$author_type."',
											for_id = '".$for_id."',
											for_type = '".$for_type."',
											title = '".$title."',
											url = '".$url."',
											description = '".$description."',
											time_create = NOW()";
		db_query($sql);
		}
		function logging( $request_id, $description, $who_type, $who_id){
			
			$sql = "INSERT module_logging SET request_id = '".$request_id."',
												description = '".$description."',
												who_type = '".$who_type."',
												who_id = '".$who_id."',
												time_create = NOW()"; 
			db_query($sql);

			//header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			//exit;
		}

		function GetUserСolumnBySessionTypeID($id) {
			if($id == 1){
				$type = "uc_id";
			}else if($id == 2){
				$type = "osi_id";
			}else if($id == 3){
				$type = "citizen_id";
			}else if($id == 4){
				$type = "worker_uc_id";
			}else if($id == 5){
				$type = "manager_uc_id";
			}
			return $type;
		}

		function GetExecutorId($id) {

			$executorInfo = db_get_data("SELECT osi_id, osi_accepted, worker_uc_id, worker_uc_accepted from module_requests WHERE id = '".$id."'");
				if($executorInfo['worker_uc_accepted']==3){
					$executor = $executorInfo['worker_uc_id'];
				}else if($executorInfo['osi_accepted']==3){
					$executor = $executorInfo['osi_id'];
				}
			return $executor;
		}
		function GetExecutorType($id) {
			$executorInfo = db_get_data("SELECT osi_id, osi_accepted, worker_uc_id, worker_uc_accepted from module_requests WHERE id = '".$id."'");
			
				if($executorInfo['worker_uc_accepted']==3){
					$executor_type = 4;
				}else if($executorInfo['osi_accepted']==3){
					$executor_type = 2;
				}
			return $executor_type;
		}

		function GetExecutorIDAndExecutorTypeByRequestIdAndSessionType($id, $user_type) {
			if($user_type == 1) {
				$executorInfo = db_get_array("SELECT worker_uc_id, worker_uc_accepted from module_requests WHERE id = '".$id."'", "worker_uc_id", "worker_uc_accepted");
				$executor = $executorInfo['worker_uc_id'];
			}else if ($user_type == 2){
				$executorInfo = db_get_array("SELECT osi_id, osi_accepted from module_requests WHERE id = '".$id."'", "osi_id", "osi_accepted");
				$executor = $executorInfo['osi_id'];
			}else if ($user_type == 3){
				$executorInfo = db_get_array("SELECT  osi_id, osi_accepted, worker_uc_id, worker_uc_accepted from module_requests WHERE id = '".$id."'", "osi_id", "osi_accepted", "worker_uc_id", "worker_uc_accepted");
				if($executorInfo['worker_uc_accepted']==2 && $executorInfo['worker_uc_id']){
					$executor = $executorInfo['worker_uc_id'];
				}else if($executorInfo['osi_accepted']==2 && $executorInfo['osi_id']){
					$executor = $executorInfo['osi_id'];
				}
			}else if ($user_type == 4){
				$executorInfo = db_get_array("SELECT worker_uc_id, worker_uc_accepted from module_requests WHERE id = '".$id."'", "worker_uc_id", "worker_uc_accepted");
				$executor = $executorInfo['worker_uc_id'];
			}else if ($user_type == 5){
				$executorInfo = db_get_array("SELECT worker_uc_id, worker_uc_accepted from module_requests WHERE id = '".$id."'", "worker_uc_id", "worker_uc_accepted");
				$executor = $executorInfo['worker_uc_id'];
			}
			return $executor;
		}

		function GetActionByTabIDAndSessionTypeID($tab, $sessionType, $id ,$sessionID, $from, $osi_accepted , $uc_id, $uc_accepted , $worker_uc_id, $worker_uc_accepted ) {
			// sessionType 1 -УК
			// sessionType 2 - ОСИ
			// sessionType 3 - Житель
			// sessionType 4 - Сотрудник
			// sessionType 5 - Менеджер

			// tab 1 - Новые заявки
			// tab 2 - Отклоненные заявки
			// tab 3 - В работе
			// tab 4 - Ожидает оценки
			// tab 5 - Выполнено
			// tab 5 - Не выполнено

			#Статусы принятия (accepted)
			#	0 - новая заявка
			#	1 - принятая завка
			#	2 - не принятая заявка
			#	3 - ожидает оценки
			#	4 - выполненная заявка
			#	5 - не выполненная заявка
			$action = '';
			if($tab == 1){
				if($sessionType == 1){ // УК
						if($uc_accepted > 0){ // УК приняла заявку чтобы выполнит
							if($worker_uc_id > 0){ // Работник для заявки выбран
								$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
								<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="OSIpushToUCButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>
								';
							}else{ // Работник пока еще не выбран
								$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
								<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="OSIpushToUCButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>
								';
							}
							
						}else{ // УК не приняла заявку
							$action = '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip"  onclick="changeAccepted('.$id.',11,'.$sessionType.','.$sessionID.','.$sessionType.')" data-original-title="Принять"><i class="fa fa-check"></i></a>
							<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
							<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="UCpushRequestOSIButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>
								';
						}
						
				}else if($sessionType == 2){ // Когда ОСИ зашел
					if($from > 0) { // когда заявка от жителя (приходит id Жителя)
						if($osi_accepted > 0){ // Заявка принята ОСи 
							
							if($uc_id > 0){ // УК определена
								if($uc_accepted > 0){
									$action = '
									';
								}else{
									$action = '
									<a class="btn btn-danger btn-sm text-white" data-toggle="modal" onclick="changeAccepted('.$id.',4,'.$sessionType.','.$sessionID.','.$sessionType.')" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
									';
								}
								
							}else{
								$action = '<a class="btn btn-warning btn-sm text-white" data-toggle="tooltip"  onclick="changeAccepted('.$id.',2,'.$sessionType.','.$sessionID.','.$sessionType.')" data-original-title="Сделать самому"><i class="fa fa-check"></i></a>
								<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
								<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="OSIpushToUCButton" data-target="#osi-push-request-uc" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>
								';
							}
						}else{ // заявка еще не принята
							$action = '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="changeAccepted('.$id.',1,'.$sessionType.','.$sessionID.','.$sessionType.')" data-original-title="Принять"><i class="fa fa-check"></i></a>
							<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
							<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="OSIpushToUCButton" data-target="#osi-push-request-uc" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>
							';
						}
					}else{ //  когда заявка от ОСИ
						if($uc_accepted > 0){ // УК определена
							
						}else{
							$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-target="#delete" onclick="deleteRequest('.$id.','.$sessionID.','.$sessionType.');" data-original-title="Удалить"><i class="fa fa-times"></i></a>
							';
						}
							
					}
				}else if($sessionType == 3){ // Житель
					if($osi_accepted == 0){ // Заявка создана но ее еще не приняли
						$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteRequest('.$id.','.$sessionID.','.$sessionType.');" data-original-title="Удалить"><i class="fa fa-times"></i></a>
						';
					}else{ //заявка взята или будет выполнять сам
						$action = '';
					}
					
				}else if($sessionType == 4){ // Сотрудник
					
						$action = '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip"  onclick="changeAccepted('.$id.',1,'.$sessionType.','.$sessionID.','.$sessionType.')" data-original-title="Принять"><i class="fa fa-check"></i></a>
							<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
							';
					
					
				}else if($sessionType == 5){
					
				}

			}else if($tab == 2){

				if($sessionType == 1){
					if($worker_uc_id > 0){
						if($worker_uc_accepted == 2){
							$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
							<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="OSIpushToUCButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>
							';
						}else{
							$action = '';
						}
					}else{
						$action = '';
					}
					
				}else if($sessionType == 2){
					if($from>0){
						$action = '';
					}else{
						$action = '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" data-original-title="Дублировать"><i class="fa fa-recycle"></i></a>
						';
					}
					if($uc_accepted==3){
						$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a>
						<a class="btn btn-primary btn-sm text-white" data-toggle="modal" id="OSIpushToUCButton" data-target="#osi-push-request-uc" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Направить"><i class="fa fa-arrow-right"></i></a>';
					}
					
				}else if($sessionType == 3){  // Житель
					$action = '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" data-original-title="Дублировать"><i class="fa fa-recycle"></i></a>
					<a class="btn btn-gray btn-sm text-white" data-toggle="modal" data-target="#not-finished-request" data-original-title="История"><i class="fa fa-history"></i></a>';
				}else if($sessionType == 4){
					
				}else if($sessionType == 5){
					
				}
			}else if($tab == 3){
				
				if($sessionType == 1){ //УК
					
				}else if($sessionType == 2){ //ОСИ
					
					$action = '<a class="btn btn-warning btn-sm text-white" data-toggle="tooltip"  onclick="changeAccepted('.$id.',3,'.$sessionType.','.$sessionID.','.$sessionType.')" data-original-title="Выполнить"><i class="fa fa-check"></i></a>
					<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a> ';			
				}else if($sessionType == 3){  // Житель
					
				}else if($sessionType == 4){ //Сотрудник УК
					$action = '<a class="btn btn-warning btn-sm text-white" data-toggle="tooltip"  onclick="changeAccepted('.$id.',3,'.$sessionType.','.$sessionID.','.$sessionType.')" data-original-title="Выполнить"><i class="fa fa-check"></i></a>
								<a class="btn btn-danger btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a> ';
				}else if($sessionType == 5){ //Менеджер УК
					
				}
				
			}else if($tab == 4){
				
				if($sessionType == 1){
					
				}else if($sessionType == 2){
					$action = '<a class="btn btn-success btn-sm text-white" id="AddReviewButton" data-toggle="modal" data-target="#AddReview" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Принять"><i class="fa fa-thumbs-up"></i></a>
					<a class="btn btn-danger btn-sm text-white " id="NotFinishedRequestButton" data-toggle="modal"  data-target="#NotFinishedRequest" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'"  data-original-title="Отклонить"><i class="fa fa-thumbs-down"></i></a>
					';
				}else if($sessionType == 3){  // Житель
					$action = '<a class="btn btn-success btn-sm text-white" id="AddReviewButton" data-toggle="modal" data-target="#AddReview" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Принять"><i class="fa fa-thumbs-up"></i></a>
					<a class="btn btn-danger btn-sm text-white " id="NotFinishedRequestButton" data-toggle="modal"  data-target="#NotFinishedRequest" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'"  data-original-title="Отклонить"><i class="fa fa-thumbs-down"></i></a>
					';
				}else if($sessionType == 4){
					
				}else if($sessionType == 5){
					
				}

			}else if($tab == 5){
				
				if($sessionType == 1){
					
				}else if($sessionType == 2){
					
				}else if($sessionType == 3){  // Житель
					
				}else if($sessionType == 4){
					
				}else if($sessionType == 5){
					
				}
			}else if($tab == 6){
				
				if($sessionType == 1){
					
				}else if($sessionType == 2){
					
				}else if($sessionType == 3){  // Житель
					
				}else if($sessionType == 4){
				}else if($sessionType == 5){
				}
			}
			$action .= ' <a class="btn btn-gray btn-sm text-white" data-toggle="tooltip"  onclick="requestHistory('.$id.')" data-original-title="История"><i class="fa fa-history"></i></a>';
			return $action;
		}

		function GetAction2ByTabIDAndSessionTypeID($tab, $sessionType, $id ,$sessionID, $from, $osi_accepted , $uc_id, $uc_accepted , $worker_uc_id, $worker_uc_accepted ) {
			$action = '';
			if($tab == 1){
				if($sessionType == 1){ // УК
						if($uc_accepted > 0){ // УК приняла заявку чтобы выполнит
							if($worker_uc_id > 0){ // Работник для заявки выбран
								$action = '
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'">Отклонить</a>
								<a href="#" class="btn btn-primary" data-toggle="modal" id="OSIpushToUCButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'">Направить</a>';
							
							}else{ // Работник пока еще не выбран
								$action = '
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'">Отклонить</a>
								<a href="#" class="btn btn-primary" data-toggle="modal" id="OSIpushToUCButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'">Направить</a>';
							}
							
						}else{ // УК не приняла заявку

							$action = '
								<a href="#" class="btn btn-success" data-toggle="tooltip"  onclick="changeAccepted('.$id.',1,'.$sessionType.','.$sessionID.','.$sessionType.')">Принять</a>
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>
								<a href="#" class="btn btn-primary" data-toggle="modal" id="UCpushRequestOSIButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Направить</a>';
						}
				}else if($sessionType == 2){ // Когда ОСИ зашел
					if($from > 0) { // когда заявка от жителя (приходит id Жителя)
						if($osi_accepted > 0){ // Заявка принята ОСи 
							
							if($uc_id > 0){ // УК определена
								if($uc_accepted > 0){
									$action = '
									';
								}else{
									$action = '	<a href="#" class="btn btn-danger" data-toggle="modal" onclick="changeAccepted('.$id.',4,'.$sessionType.','.$sessionID.','.$sessionType.')" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>';

								}
								
							}else{

								$action = '
								<a href="#" class="btn btn-warning" data-toggle="tooltip"  onclick="changeAccepted('.$id.',2,'.$sessionType.','.$sessionID.','.$sessionType.')">Сделать самому</a>
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>
								<a href="#" class="btn btn-primary" data-toggle="modal" id="OSIpushToUCButton" data-target="#osi-push-request-uc" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Направить</a>';

							}
						}else{ // заявка еще не принята

							$action = '
								<a href="#" class="btn btn-success" data-toggle="tooltip"  onclick="changeAccepted('.$id.',1,'.$sessionType.','.$sessionID.','.$sessionType.')">Принять</a>
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>
								<a href="#" class="btn btn-primary" data-toggle="modal" id="OSIpushToUCButton" data-target="#osi-push-request-uc" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Направить</a>';
						}
					}else{ //  когда заявка от ОСИ
						if($uc_accepted > 0){ // УК определена
							
						}else{
							$action = '
								<a href="#" class="btn btn-danger" data-toggle="tooltip" data-target="#delete" onclick="deleteRequest('.$id.','.$sessionID.','.$sessionType.');">Удалить</a>';

						}
							
					}
				}else if($sessionType == 3){ // Житель
					if($osi_accepted == 0){ // Заявка создана но ее еще не приняли
						$action = '
								<a href="#" class="btn btn-danger" data-toggle="tooltip" data-target="#delete" onclick="deleteRequest('.$id.','.$sessionID.','.$sessionType.');">Удалить</a>';
					}else{ //заявка взята или будет выполнять сам
						$action = '';
					}
					
				}else if($sessionType == 4){ // Сотрудник
					
					$action = '
								<a href="#" class="btn btn-success" data-toggle="tooltip"  onclick="changeAccepted('.$id.',1,'.$sessionType.','.$sessionID.','.$sessionType.')">Принять</a>
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>';
						
				}else if($sessionType == 5){
					
				}

			}else if($tab == 2){

				if($sessionType == 1){
					if($worker_uc_id > 0){
						if($worker_uc_accepted == 2){

							$action = '
								
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>
								<a href="#" class="btn btn-primary" data-toggle="modal" id="OSIpushToUCButton" data-target="#uc-push-request-worker" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Направить</a>';
						
						}else{
							$action = '';
						}
					}else{
						$action = '';
					}
					
				}else if($sessionType == 2){
					if($from>0){
						$action = '';
					}else{
						$action = '
								
								<a href="#" class="btn btn-primary" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" >Дублировать</a>';
						
					}
					
				}else if($sessionType == 3){  // Житель
					$action = '
								<a href="#" class="btn btn-primary" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" >Дублировать</a>
								';
				}else if($sessionType == 4){
					
				}else if($sessionType == 5){
					
				}
			}else if($tab == 3){
				
				if($sessionType == 1){ //УК
					
				}else if($sessionType == 2){ //ОСИ
					
					$action = '<a href="#" class="btn btn-warning" data-toggle="tooltip"  onclick="changeAccepted('.$id.',3,'.$sessionType.','.$sessionID.','.$sessionType.')" >Выполнить</a>
					<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>';			
					
				}else if($sessionType == 3){  // Житель
					
				}else if($sessionType == 4){ //Сотрудник УК

					$action = '<a href="#" class="btn btn-success" data-toggle="tooltip"  onclick="changeAccepted('.$id.',3,'.$sessionType.','.$sessionID.','.$sessionType.')" >Выполнить</a>
								<a href="#" class="btn btn-danger" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>';
						
				}else if($sessionType == 5){ //Менеджер УК
					
				}
				
			}else if($tab == 4){
				
				if($sessionType == 1){
					
				}else if($sessionType == 2){

					
				}else if($sessionType == 3){  // Житель

					$action = '
								
								<a href="#" class="btn btn-success" id="AddReviewButton" data-toggle="modal" data-target="#AddReview" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Принять</a>
								<a href="#" class="btn btn-danger" id="NotFinishedRequestButton" data-toggle="modal"  data-target="#NotFinishedRequest" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a>';
						
				}else if($sessionType == 4){
					
				}else if($sessionType == 5){
					
				}

			}else if($tab == 5){
				
				if($sessionType == 1){
					
				}else if($sessionType == 2){
					
				}else if($sessionType == 3){  // Житель
					
				}else if($sessionType == 4){
					
				}else if($sessionType == 5){
					
				}
			}else if($tab == 6){
				
				if($sessionType == 1){
					
				}else if($sessionType == 2){
					
				}else if($sessionType == 3){  // Житель
					
				}else if($sessionType == 4){
				}else if($sessionType == 5){
				}
			}
			$action .= '
			<a href="#" class="btn btn-gray" data-toggle="tooltip"  onclick="requestHistory('.$id.')">История</a>';
			return $action;
		}


		if($_SESSION['type'] == 2){
			$button = '<a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#add-request-osi" href="#"><i class="fa fa-plus"></i> Создать заявку</a>';
		}else if($_SESSION['type'] == 3){
			$button = '<a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#add-request-citizen" href="#"><i class="fa fa-plus"></i> Создать заявку</a>';
		}

		$tpl->assign("BUTTON_ADD", $button);
		
		# POST #################################################################################

		# NOT ACCEPT REQUEST #################################################################################
		if (isset($_POST['notAcceptRequestSend'])) {
			$cancel = cleanStr($_POST['cancel']);
			$id = intval($_POST['id']);
			$executor_type = intval($_POST['executor_type']);
			$request = db_get_data("SELECT * from module_requests WHERE id = ".$id);

			if($executor_type == 4){
				$sql = "UPDATE module_requests SET cancel = '".$cancel."', request_status_id = 1, worker_uc_accepted = 2 WHERE id = ".$id;
				noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['worker_uc_id'],$executor_type ,'<a href="/ru/requests/">Заявка не принята</a>' , 'Исполнитель не принял(а) заявку по причине'.$cancel, 0, 0, 'requests');
				
			}else if($executor_type == 1){
				$sql = "UPDATE module_requests SET cancel = '".$cancel."', request_status_id = 1,worker_uc_id = 0, uc_accepted = 3,  worker_uc_accepted = 0 WHERE id = ".$id;
				noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['uc_id'],$executor_type ,'Заявка не принята' , 'УК не принял(а) заявку по причине'.$cancel, 0, 0, 'requests');
			}
			else{
				$sql = "UPDATE module_requests SET request_status_id = 6, cancel = '".$cancel."' WHERE id = ".$id."";
				noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['citizen_id'], $executor_type ,'<a href="/ru/requests/">Заявка не принята</a>' , 'ОСИ не принял(а) заявку по причине'.$cancel, 0, 0, 'requests');
			}
			
			db_query($sql);

			logging( $id, 'Не принял(а/и) по причине: '.$cancel, $_SESSION['type'], $_SESSION['id']);
			
			

			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}


		# OSI PUSH REQUEST UC #################################################################################
		if (isset($_POST['OSIpushToUCSend'])) {
			$uc_id = intval($_POST['uc']);
			$id = intval($_POST['id']);
			$sql = "UPDATE module_requests SET request_status_id = 1, uc_id = '".$uc_id."', osi_accepted = 1, uc_accepted = 0 WHERE id = ".$id.""; //Момент странны
 
			db_query($sql);
			
			$uc_data = db_get_data("SELECT name, phone from module_ucs WHERE id = ".$uc_id);
			//$osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = ".$_SESSION['id']);

			$request_data = db_get_data("SELECT citizen_id from module_requests WHERE id = ".$id);

			logging( $id, 'Заявка была перенаправлена: '.$uc_data['name'].' / '.$uc_data['phone'], $_SESSION['type'], $_SESSION['id']);
			
			$request = db_get_data("SELECT * from module_requests WHERE id = ".$id);
			noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['uc_id'], 1 ,'<a href="/ru/request/">Заявка была перенаправлена</a>' , 'ОСИ перенаправил(а) заявку <b>#'.$id.'</b> к УК: <b>'.$uc_data['name'].'</b>', 0, 0, 'requests');
			noticeUsers( $_SESSION['id'], $_SESSION['type'], $request_data['citizen_id'], 3 ,'<a href="/ru/request/">Заявка была перенаправлена</a>' , 'ОСИ перенаправил(а) заявку <b>#'.$id.'</b> к УК: <b>'.$uc_data['name'].'</b>', 0, 0, 'requests');

			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}

		# UC PUSH REQUEST WORKER #################################################################################
		if (isset($_POST['UCpushtoWorkerSend'])) {
			$worker_id = intval($_POST['worker']);
			$id = intval($_POST['id']);
			$sql = "UPDATE module_requests SET worker_uc_id = ".$worker_id.", cancel = 0, request_status_id = 1, worker_uc_accepted = 0, uc_accepted=1	  WHERE id = ".$id."";

			db_query($sql);
			
			$worker_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = ".$worker_id);

			logging( $id, 'Для заявки выбран испольнитель: '.$worker_data['name'].' / '.$worker_data['phone'], $_SESSION['type'], $_SESSION['id']);

			$request = db_get_data("SELECT * from module_requests WHERE id = ".$id);
			noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['worker_uc_id'], 4 ,'Выбран исполнитель заявки' , 'УК выбрал(а) исполнителем заявки <b>#'.$id.'</b> сотрудника <b>'.$worker_data['name'].'</b>', 0, 0, 'requests');

			noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3 ,'Выбран исполнитель заявки' , 'УК выбрал(а) исполнителем заявки <b>#'.$id.'</b> сотрудника <b>'.$worker_data['name'].'</b>', 0, 0, 'requests');


			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}

		# PUSH-UC-WITHOUT-ACCEPT #################################################################################
		if (isset($_POST['OSIpushToUCWithoutAcceptSend'])) {
			$uc_id = intval($_POST['uc']);
			$executor = intval($_POST['executor']);
			$sql = "UPDATE module_requests SET request_status_id = 2, uc_id = ".$uc_id." WHERE id = ".$executor."";
			db_query($sql);

			$uc_data = db_get_data("SELECT name, phone from module_ucs WHERE id = ".$uc_id);
			logging( $id, 'Заявка была перенаправлена: '.$uc_data['name'].' / '.$uc_data['phone'], $_SESSION['type'], $_SESSION['id']);
			
			$request = db_get_data("SELECT * from module_requests WHERE id = ".$id);
			noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['uc_id'], 1 ,'Заявка была перенаправлена' , 'ОСИ перенаправил(а) заявку <b>#'.$id.'</b> к УК: <b>'.$uc_data['name'].'</b>', 0, 0, 'requests');

			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}

		# REQUEST-NOT-ACCEPTED-OSI #################################################################################
		if (isset($_POST['OSIpushToUCNotAcceptedSend'])) {
			$uc_id = intval($_POST['uc']);
			$executor = intval($_POST['executor']);
			
			$reason = intval($_POST['reason']);
			$sql = "UPDATE module_requests SET request_status_id = 6, uc_id = ".$uc_id.", cancel = ".$reason." WHERE id = ".$executor."";
			db_query($sql);

			
			logging( $id, 'Заявка была отменена по причине: '.$reason, $_SESSION['type'], $_SESSION['id']);

			$request = db_get_data("SELECT * from module_requests WHERE id = ".$id);
			noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['uc_id'], 1 ,'Заявка была отменена' , 'Заявка <b>#'.$id.'</b> была отменан по причине: <b>'.$reason.'</b>', 0, 0, 'requests');


			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}

		# ADD-GOOD-REVIEW-CITIZEN #################################################################################
		if (isset($_POST['AddReviewFormSend'])) {
			$rating = $_POST['rating-stars-value'];
			$id = intval($_POST['id']);
			$executor = GetExecutorId($id);
			$executor_type = GetExecutorType($id);
			$wroter = $_POST['wroter'];
			$wroter_type = $_POST['wroter_type'];
			$review = $_POST['review'];

			$sql = "UPDATE module_requests SET request_status_id = 4 WHERE id = ".$id;
			db_query($sql);


			if($executor_type == 4){
				$executor_data = db_get_data("SELECT id,name, phone from module_worker_uc WHERE id = ".$executor);
			}else if (($executor_type == 2)){
				$executor_data = db_get_data("SELECT id,name, phone from module_osi WHERE id = ".$executor);
			}else{

			}
			
			logging( $id, 'Заявку выполнил(а): ' .$executor_data['name']. ' / '.$executor_data['phone'] , $_SESSION['type'], $_SESSION['id']);

			noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявку выполнил(а)' , 'Заявка <b>#'.$id.'</b> успешно выполнен(а): Сотрудник УК <b>'.$executor_data['name'].'</b>', 0, 0, 'requests');

			$sql1 = "INSERT module_request_reviews SET request_id = '".$id."',
												description = '".$review."',
												rating_id = '".$rating."',
												executor = '".$executor."',
												executor_type = '".$executor_type."',	
												wroter = '".$wroter."',
												wroter_type = '".$wroter_type."',
												date_create = NOW()"; 
			db_query($sql1);

			logging( $id, 'Заявке написан отзыв с оценкой: '.$rating.' и с коммертарием: '.$review , $_SESSION['type'], $_SESSION['id']);
			
			noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type,'Заявке написан отзыв' , 'Заявке <b>#'.$id.'</b> написан отзыв с оценкой: <b>'.$rating.'</b> и с коммертарием: <b?'.$review.'</b>', 0, 0, 'requests');

			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}

		# NOT-FINISHED-REQUEST-CITIZEN #################################################################################
		if (isset($_POST['NotFinishedRequestFormSend'])) {
			$rating = $_POST['rating-stars-value'];
			$id = $_POST['id'];
			$executor = GetExecutorId($id);
			$executor_type = GetExecutorType($id);
			$wroter = $_POST['wroter'];
			$wroter_type = $_POST['wroter_type'];
			$review = $_POST['review'];

			$sql = "UPDATE module_requests SET request_status_id = 5 WHERE id = ".$id;
			db_query($sql);

			
			if($executor_type == 4){
				$executor_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = ".$executor);
			}else if (($executor_type == 2)){
				$executor_data = db_get_data("SELECT name, phone from module_osi WHERE id = ".$executor);
			}else{

			}
			
			logging( $id, 'Заявка была выполнена:' .$executor_data['name']. ' / '.$executor_data['phone'] , $_SESSION['type'], $_SESSION['id']);

			noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявку не выполнил(а)' , 'Заявка <b>#'.$id.'</b> не выполнен(а): Сотрудник УК <b>' .$executor_data['name'].'</b>', 0, 0, 'requests');


			$sql1 = "INSERT module_request_reviews SET request_id = '".$id."',
												description = '".$review."',
												rating_id = '".$rating."',
												executor = '".$executor."',
												executor_type = '".$executor_type."',	
												wroter = '".$wroter."',
												wroter_type = '".$wroter_type."',
												date_create = NOW()"; 
			db_query($sql1);

			logging( $id, 'Заявке написан отзыв с оценкой: '.$rating.' и с коммертарием: '.$review , $_SESSION['type'], $_SESSION['id']);

			noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявке написан отзыв' , 'Заявке <b>#'.$id.'</b> написан отзыв с оценкой: <b>'.$rating.'</b> и с коммертарием: <b>'.$review.'</b>', 0, 0, 'requests');

			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}


		# ADD_REQUEST_SITIZEN #################################################################################
		if (isset($_POST['send'])) {
			$flat_id = intval($_POST['flat_id']);
			$house_id = intval($_POST['house_id']);
			$uc_id = intval($_POST['uc_id']);
			$type_id = intval($_POST['type_id']);
			$description = cleanStr($_POST['description']);
			$flat_data = db_get_data("SELECT t1.*, t2.osi_id, t2.house_id, t2.flat_number, t2.city_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$flat_id);
			$house_data = db_get_data("SELECT * FROM module_houses WHERE osi_id = '".$_SESSION['id']."' AND status = 1 ORDER BY id DESC");
			if (!empty($_FILES['photo1'])) {
				$fileParts = pathinfo($_FILES['photo1']['name']);
				if (in_array($fileParts['extension'], $fileTypes)) {
					$filename = $_FILES['photo1']['name'];
					$tmp_filename = $_FILES['photo1']['tmp_name'];
					$newFileName1 = time()."-1.".$fileParts['extension'];

					$ret = copy($tmp_filename, "./photos/".$newFileName1);
				}
			}

			if (!empty($_FILES['photo2'])) {
				$fileParts = pathinfo($_FILES['photo2']['name']);
				if (in_array($fileParts['extension'], $fileTypes)) {
					$filename = $_FILES['photo2']['name'];
					$tmp_filename = $_FILES['photo2']['tmp_name'];
					$newFileName2 = time()."-2.".$fileParts['extension'];

					$ret = copy($tmp_filename, "./photos/".$newFileName2);
				}
			}

			if (!empty($_FILES['photo3'])) {
				$fileParts = pathinfo($_FILES['photo3']['name']);
				if (in_array($fileParts['extension'], $fileTypes)) {
					$filename = $_FILES['photo3']['name'];
					$tmp_filename = $_FILES['photo3']['tmp_name'];
					$newFileName3 = time()."-3.".$fileParts['extension'];

					$ret = copy($tmp_filename, "./photos/".$newFileName3);
				}
			}

			if (!empty($_FILES['photo4'])) {
				$fileParts = pathinfo($_FILES['photo4']['name']);
				if (in_array($fileParts['extension'], $fileTypes)) {
					$filename = $_FILES['photo4']['name'];
					$tmp_filename = $_FILES['photo4']['tmp_name'];
					$newFileName4 = time()."-4.".$fileParts['extension'];

					$ret = copy($tmp_filename, "./photos/".$newFileName4);
				}
			}

			$id_array = '';
			$images_array = [$newFileName1, $newFileName2, $newFileName3, $newFileName4];
			foreach ($images_array as $key => $value) {
				if ($value != "") {
					$sql = "INSERT INTO module_photos SET url_photos = '".$value."'";
					db_query($sql);

					$id_array[] = db_insert_id();
				}
			}

			$photo_i = serialize($id_array);

			
			if( intval($_SESSION['type'])===intval(1)){  //УК
				$user_type_id = 'uc_id';
			}else if( intval($_SESSION['type'])===intval(2)){ // ОСИ 
				$sql = "INSERT module_requests SET city_id = '".$house_data['city_id']."',
												house_id = '".$house_id."',
												osi_id = '".$_SESSION['id']."',	
												uc_id =  '".$uc_id."',
												description = '".$description."',
												photo_i = '".$photo_i."', 
												request_status_id = '11', 
												type_id = '".$type_id."',
												time_create = NOW()"; 

			db_query($sql);
			$id = db_insert_id();
			$osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = ".$_SESSION['id']);

			logging( $id, 'Новая заявка создана '.$osi_data['name'].' / '.$osi_data['phone'] , $_SESSION['type'], $_SESSION['id']);

			noticeUsers( $_SESSION['id'], $_SESSION['type'], $uc_id, 1 ,'Новая заявка' , 'Создана новая заявка от ОСИ: '.$osi_data['name'], 0, 0, 'requests');

			}else if( intval($_SESSION['type'])===intval(3)){ // Житель
				$sql = "INSERT module_requests SET city_id = '".$flat_data['city_id']."',
												osi_id = '".$flat_data['osi_id']."',
												house_id = '".$flat_data['house_id']."',
												flat_id = '".$flat_id."',
												citizen_id = '".$_SESSION['id']."',	
												description = '".$description."',
												photo_i = '".$photo_i."', 
												request_status_id = '11', 
												type_id = '".$type_id."',
												time_create = NOW()"; 
				db_query($sql);
				$id = db_insert_id();
			$citizen_data = db_get_data("SELECT name, phone from module_citizens WHERE id = ".$_SESSION['id']);
			logging( $id, 'Новая заявка создана '.$citizen_data['name'].' / '.$citizen_data['phone'] , $_SESSION['type'], $_SESSION['id']);

			noticeUsers( $_SESSION['id'], $_SESSION['type'], $flat_data['osi_id'], 2 ,'Новая заявка' , 'Создана новая заявка от Жителя: '.$citizen_data['name'], 0, 0, 'requests');

			}else if( intval($_SESSION['type'])===intval(4)){ //Работник
				$user_type_id = 'worker_uc_id';
			}else if( intval($_SESSION['type'])===intval(5)){ //Менеджер
				$user_type_id = 'manager_uc_id';
			}

			

			header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
			exit;
		}

		# MAIN #################################################################################


		if (isset($_SESSION['id'])) {

			$user_type_id = GetUserСolumnBySessionTypeID(intval($_SESSION['type']));
			

			//Первый таб 

			if($_SESSION['type'] == 1 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 11 AND uc_accepted = 0 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 1 AND uc_accepted = 1 AND NOT worker_uc_accepted = 2 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 11 AND uc_accepted = 1 AND NOT worker_uc_accepted = 2 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 1 AND uc_accepted = 0 AND NOT worker_uc_accepted = 2 ORDER BY time_create DESC");
			}else if($_SESSION['type'] == 4 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 11 AND worker_uc_accepted = 0 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 1 AND worker_uc_accepted = 0 ORDER BY time_create DESC");
			}else if($_SESSION['type'] == 3 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 11 ORDER BY time_create DESC");
			}else if($_SESSION['type'] == 2 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 11 AND uc_accepted = 0 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 1 AND uc_accepted = 0 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 1 AND uc_accepted = 1 ORDER BY time_create DESC");
			}else{
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 11 AND worker_uc_accepted = 2 ORDER BY time_create DESC");
			}
			

			$newRequestsCount = db_num_rows($result);
			$tpl->assign("NEW_REQUESTS_COUNT", $newRequestsCount);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$type = db_get_data("SELECT name FROM module_request_types WHERE id = ".$row['type_id'], "name");
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$name = db_get_data("SELECT name FROM module_citizens WHERE id = ".$row['citizen_id'], "name");
					$name_phone =  db_get_data("SELECT phone FROM module_citizens WHERE id = ".$row['citizen_id'], "phone");
					$osi = db_get_data("SELECT name FROM module_osi WHERE id = ".$row['osi_id'], "name");
					
					$osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = ".$row['osi_id'], "phone");

					$uc = db_get_data("SELECT name FROM module_ucs WHERE id = ".$row['uc_id'], "name");
					$uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = ".$row['uc_id'], "phone");

					$uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "name");
					$uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "phone");
					
					$status = db_get_data("SELECT name FROM module_request_statuses WHERE id = ".$row['request_status_id'], "name");
					$flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$row['flat_id']);
					$house = db_get_data("SELECT * FROM module_houses WHERE id = ".$row['house_id']);

					$images = unserialize($row['photo_i']);

					$tpl->assign("IMAGES_LIST", '');
					$image_list = "";
					$i = 0;
					if($images){
						foreach ($images as &$image) {
							$image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
							if($i==0){
								$image_list .='<div class="carousel-item active"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}else{
								$image_list .='<div class="carousel-item"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}
							
							$i++;
		
							}
					}else{
						$image_list = '<p>Вложенные фотографии отсутствует</p>';
					}
					
		
					$tpl->assign("IMAGES_LIST", $image_list);

					$tpl->assign("ID", $row['id']);
					$action = "";
					$action = GetActionByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					if(intval($row['citizen_id']) > 0){
							
						$tpl->assign("AUTHOR", "Житель:  ".$name);
						$tpl->assign("AUTHOR_PHONE", $name_phone);
						$tpl->assign("CITY", $city);
							$tpl->assign("FLAT_NUMBER", ", кв. ".$flat_data['flat_number']);
							$tpl->assign("STREET", $house['street']);
							$tpl->assign("HOUSE", $house['house_number']);
							if($row['uc_accepted'] > 0){ 
								if($row['worker_uc_id']> 0){
									$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
								$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
								}else{
									$tpl->assign("EXECUTOR", "УК: ".$uc);
									$tpl->assign("EXECUTOR_PHONE", $uc_phone);
								}
								
							}else{ // Если еще не выбрана УК 
							$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
							$tpl->assign("EXECUTOR_PHONE", $osi_phone);
							}
							
						}else{
							$tpl->assign("AUTHOR", "ОСИ:  ".$osi);
							$tpl->assign("AUTHOR_PHONE", $osi_phone);
							$tpl->assign("FLAT_NUMBER", "");
							$tpl->assign("CITY", $city);
								$tpl->assign("STREET", $house['street']);
								$tpl->assign("HOUSE", $house['house_number']);
								if($row['uc_id'] > 0){
									if($row['uc_accepted'] > 0){ 
										if($row['worker_uc_id']> 0){
											$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
										$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
										}else{
											$tpl->assign("EXECUTOR", "УК: ".$uc);
											$tpl->assign("EXECUTOR_PHONE", $uc_phone);
										}
										
									}else{ // Если еще не выбрана УК 
										$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
									$tpl->assign("EXECUTOR_PHONE", $osi_phone);
									}
								}
						}

						
						
					$tpl->assign("ACTION", $action);

					$action2 = "";
					$action2 = GetAction2ByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии
	
					$tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
					$tpl->assign("DESCR2", $row['description']);
					$tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
					$tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));
					
					
					$tpl->assign("STATUS", $status);

					

					$tpl->assign("TYPE", $type);
					
					


					
			//Активные УК для ОСИ (с которыми есть договор)
			$uc_id = db_get_array("SELECT ucs_id from module_osi_and_ucs WHERE osi_id = '".$_SESSION['id']."' AND status = 1", "ucs_id");
			$uc = db_get_array("SELECT * from module_ucs WHERE id = '".$uc_id[0]."' AND status = 1", "id", "name");
			assignList("UC_LIST", $uc);

					$tpl->parse("TAB1_ROWS", ".".$moduleName . "tab1_row");
				}
			}
			
			//Второй таб
			if($_SESSION['type'] == 1 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 6 OR ".$user_type_id." = ".$_SESSION['id']." AND worker_uc_accepted = 2 OR ".$user_type_id." = ".$_SESSION['id']." AND request_status_id IN (1,6) AND uc_accepted = 3 ORDER BY time_create DESC");
			}else if($_SESSION['type'] == 4 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id IN (1,6) AND worker_uc_accepted = 2 ORDER BY time_create DESC");
			}else if($_SESSION['type'] == 2 ){
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 6 OR ".$user_type_id." = ".$_SESSION['id']." AND uc_accepted = 3 ORDER BY time_create DESC");
			}else{
				$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 6 ORDER BY time_create DESC");
			}
			
			$acceptRequestsCount = db_num_rows($result);
			$tpl->assign("ACCEPT_REQUESTS_COUNT", $acceptRequestsCount);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$type = db_get_data("SELECT name FROM module_request_types WHERE id = ".$row['type_id'], "name");
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$name = db_get_data("SELECT name FROM module_citizens WHERE id = ".$row['citizen_id'], "name");
					$name_phone =  db_get_data("SELECT phone FROM module_citizens WHERE id = ".$row['citizen_id'], "phone");
					$osi = db_get_data("SELECT name FROM module_osi WHERE id = ".$row['osi_id'], "name");
					
					$osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = ".$row['osi_id'], "phone");

					$uc = db_get_data("SELECT name FROM module_ucs WHERE id = ".$row['uc_id'], "name");
					$uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = ".$row['uc_id'], "phone");

					$uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "name");
					$uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "phone");
					
					$status = db_get_data("SELECT name FROM module_request_statuses WHERE id = ".$row['request_status_id'], "name");
					$flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$row['flat_id']);
					$house = db_get_data("SELECT * FROM module_houses WHERE id = ".$row['house_id']);
					$tpl->assign("ID", $row['id']);

					
					$images = unserialize($row['photo_i']);
					$tpl->assign("IMAGES_LIST", '');
					$image_list = "";
					$i = 0;
					if($images){
						foreach ($images as &$image) {
							$image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
							if($i==0){
								$image_list .='<div class="carousel-item active"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}else{
								$image_list .='<div class="carousel-item"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}
							
							$i++;
		
							}
					}else{
						$image_list = '<p>Вложенные фотографии отсутствует</p>';
					}
					
		
					$tpl->assign("IMAGES_LIST", $image_list);




					$action = "";
					$action = GetActionByTabIDAndSessionTypeID(2, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$action2 = "";
					$action2 = GetAction2ByTabIDAndSessionTypeID(2, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии

					
					if(intval($row['citizen_id']) > 0){
							
						$tpl->assign("AUTHOR", "Житель:  ".$name);
						$tpl->assign("AUTHOR_PHONE", $name_phone);
						$tpl->assign("CITY", $city);
							$tpl->assign("FLAT_NUMBER", ", кв. ".$flat_data['flat_number']);
							$tpl->assign("STREET", $house['street']);
							$tpl->assign("HOUSE", $house['house_number']);
							if($row['uc_accepted'] > 0){ 
								if($row['worker_uc_id']> 0){
									$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
								$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
								}else{
									$tpl->assign("EXECUTOR", "УК: ".$uc);
									$tpl->assign("EXECUTOR_PHONE", $uc_phone);
								}
								
							}else{ // Если еще не выбрана УК 
								$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
							$tpl->assign("EXECUTOR_PHONE", $osi_phone);
							}
							
						}else{
							$tpl->assign("AUTHOR", "ОСИ:  ".$osi);
							$tpl->assign("AUTHOR_PHONE", $osi_phone);
							$tpl->assign("FLAT_NUMBER", "");
							$tpl->assign("CITY", $city);
								$tpl->assign("STREET", $house['street']);
								$tpl->assign("HOUSE", $house['house_number']);
								if($row['uc_id'] > 0){
									if($row['uc_accepted'] > 0){ 
										if($row['worker_uc_accepted']> 0){
											$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
										$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
										}else{
											$tpl->assign("EXECUTOR", "УК: ".$uc);
											$tpl->assign("EXECUTOR_PHONE", $uc_phone);
										}
										
									}else{ // Если еще не выбрана УК 
										$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
									$tpl->assign("EXECUTOR_PHONE", $osi_phone);
									}
								}
						}

					
					$tpl->assign("ACTION", $action);

					$tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
					$tpl->assign("DESCR2", $row['description']);

					$tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
					$tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));

					$why = $row['cancel'];
					$tpl->assign("WHY", $why);
					
					$tpl->assign("STATUS", $status);

					

					$tpl->assign("TYPE", $type);
					
					


					$tpl->parse("TAB2_ROWS", ".".$moduleName . "tab2_row");
				}
			}

			
			//Третий таб 
			$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id IN (2,7) ORDER BY time_create DESC");
			$inWorkRequestsCount = db_num_rows($result);
			$tpl->assign("IN_WORK_REQUESTS_COUNT", $inWorkRequestsCount);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$type = db_get_data("SELECT name FROM module_request_types WHERE id = ".$row['type_id'], "name");
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$name = db_get_data("SELECT name FROM module_citizens WHERE id = ".$row['citizen_id'], "name");
					$name_phone =  db_get_data("SELECT phone FROM module_citizens WHERE id = ".$row['citizen_id'], "phone");
					$osi = db_get_data("SELECT name FROM module_osi WHERE id = ".$row['osi_id'], "name");
					
					$osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = ".$row['osi_id'], "phone");

					$uc = db_get_data("SELECT name FROM module_ucs WHERE id = ".$row['uc_id'], "name");
					$uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = ".$row['uc_id'], "phone");

					$uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "name");
					$uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "phone");
					
					$status = db_get_data("SELECT name FROM module_request_statuses WHERE id = ".$row['request_status_id'], "name");
					$flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$row['flat_id']);
					$house = db_get_data("SELECT * FROM module_houses WHERE id = ".$row['house_id']);
					$tpl->assign("ID", $row['id']);


					
					$images = unserialize($row['photo_i']);

					$tpl->clear("IMAGES_LIST");

					$image_list = "";
					$i = 0;
					if($images){
						foreach ($images as &$image) {
							$image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
							if($i==0){
								$image_list .='<div class="carousel-item active"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}else{
								$image_list .='<div class="carousel-item"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}
							
							$i++;
		
							}
					}else{
						$image_list = '<p>Вложенные фотографии отсутствует</p>';
					}
					
		
					$tpl->assign("IMAGES_LIST", $image_list);



					$action = "";
					$action = GetActionByTabIDAndSessionTypeID(3, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$action2 = "";
					$action2 = GetAction2ByTabIDAndSessionTypeID(3, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии
					
					if(intval($row['citizen_id']) > 0){
							
						$tpl->assign("AUTHOR", "Житель:  ".$name);
						$tpl->assign("AUTHOR_PHONE", $name_phone);
						$tpl->assign("CITY", $city);
							$tpl->assign("FLAT_NUMBER", ", кв. ".$flat_data['flat_number']);
							$tpl->assign("STREET", $house['street']);
							$tpl->assign("HOUSE", $house['house_number']);
							if($row['uc_accepted'] > 0){ 
								if($row['worker_uc_id']> 0){
									$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
								$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
								}else{
									$tpl->assign("EXECUTOR", "УК: ".$uc);
									$tpl->assign("EXECUTOR_PHONE", $uc_phone);
								}
								
							}else{ // Если еще не выбрана УК 
								$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
							$tpl->assign("EXECUTOR_PHONE", $osi_phone);
							}
							
						}else{
							$tpl->assign("AUTHOR", "ОСИ:  ".$osi);
							$tpl->assign("AUTHOR_PHONE", $osi_phone);
							$tpl->assign("FLAT_NUMBER", "");
							$tpl->assign("CITY", $city);
								$tpl->assign("STREET", $house['street']);
								$tpl->assign("HOUSE", $house['house_number']);
								if($row['uc_id'] > 0){
									if($row['uc_accepted'] > 0){ 
										if($row['worker_uc_id']> 0){
											$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
										$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
										}else{
											$tpl->assign("EXECUTOR", "УК: ".$uc);
											$tpl->assign("EXECUTOR_PHONE", $uc_phone);
										}
										
									}else{ // Если еще не выбрана УК 
										$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
									$tpl->assign("EXECUTOR_PHONE", $osi_phone);
									}
								}
						}

					$tpl->assign("ACTION", $action);

					$tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
					$tpl->assign("DESCR2", $row['description']);
					$tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
					$tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));
					
					
					$tpl->assign("STATUS", $status);

					

					$tpl->assign("TYPE", $type);
					
					


					$tpl->parse("TAB3_ROWS", ".".$moduleName . "tab3_row");
				}
			}
			

			//Четвертный таб
			$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 3 ORDER BY time_create DESC");
			$reviewRequestsCount = db_num_rows($result);
			$tpl->assign("REVIEW_REQUESTS_COUNT", $reviewRequestsCount);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$type = db_get_data("SELECT name FROM module_request_types WHERE id = ".$row['type_id'], "name");
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$name = db_get_data("SELECT name FROM module_citizens WHERE id = ".$row['citizen_id'], "name");
					$name_phone =  db_get_data("SELECT phone FROM module_citizens WHERE id = ".$row['citizen_id'], "phone");

					$osi = db_get_data("SELECT name FROM module_osi WHERE id = ".$row['osi_id'], "name");
					$osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = ".$row['osi_id'], "phone");

					$uc = db_get_data("SELECT name FROM module_ucs WHERE id = ".$row['uc_id'], "name");
					$uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = ".$row['uc_id'], "phone");

					$uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "name");
					$uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "phone");

					$status = db_get_data("SELECT name FROM module_request_statuses WHERE id = ".$row['request_status_id'], "name");
					
					$flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$row['flat_id']);
					$house = db_get_data("SELECT * FROM module_houses WHERE id = ".$flat_data['house_id']);

					//Сделать проверку на уровни 

					$why = $row['cancel'];
					
					$tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
					$tpl->assign("DESCR2", $row['description']);

					$tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
					$tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));
					$tpl->assign("NAME", $name);
					$tpl->assign("CITY", $city);
					
					$tpl->assign("STATUS", $status);

					
					$tpl->assign("ID", $row['id']);


					
					
					$images = unserialize($row['photo_i']);

					$tpl->clear("IMAGES_LIST");

					$image_list = "";
					$i = 0;
					if($images){
						foreach ($images as &$image) {
							$image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
							if($i==0){
								$image_list .='<div class="carousel-item active"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}else{
								$image_list .='<div class="carousel-item"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}
							
							$i++;
		
							}
					}else{
						$image_list = '<p>Вложенные фотографии отсутствует</p>';
					}
					
		
					$tpl->assign("IMAGES_LIST", $image_list);



					
					$action = "";
					$action = GetActionByTabIDAndSessionTypeID(4, intval($_SESSION['type']), intval($row['id']) , intval($_SESSION['id']), intval($_SESSION['type']), $row['osi_accepted'],$row['uc_id'], $row['uc_accepted'] , $row['worker_uc_id'], $row['worker_uc_accepted']);

					$action2 = "";
					$action2 = GetAction2ByTabIDAndSessionTypeID(4, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии

					if(intval($row['citizen_id']) > 0){
							
						$tpl->assign("AUTHOR", "Житель:  ".$name);
						$tpl->assign("AUTHOR_PHONE", $name_phone);
						$tpl->assign("CITY", $city);
							$tpl->assign("FLAT_NUMBER", ", кв. ".$flat_data['flat_number']);
							$tpl->assign("STREET", $house['street']);
							$tpl->assign("HOUSE", $house['house_number']);
							if($row['uc_accepted'] > 0){ 
								if($row['worker_uc_id']> 0){
									$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
								$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
								}else{
									$tpl->assign("EXECUTOR", "УК: ".$uc);
									$tpl->assign("EXECUTOR_PHONE", $uc_phone);
								}
								
							}else{ // Если еще не выбрана УК 
								$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
							$tpl->assign("EXECUTOR_PHONE", $osi_phone);
							}
							
						}else{
							$tpl->assign("AUTHOR", "ОСИ:  ".$osi);
							$tpl->assign("AUTHOR_PHONE", $osi_phone);
							$tpl->assign("FLAT_NUMBER", "");
							$tpl->assign("CITY", $city);
								$tpl->assign("STREET", $house['street']);
								$tpl->assign("HOUSE", $house['house_number']);
								if($row['uc_id'] > 0){
									if($row['uc_accepted'] > 0){ 
										if($row['worker_uc_id']> 0){
											$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
										$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
										}else{
											$tpl->assign("EXECUTOR", "УК: ".$uc);
											$tpl->assign("EXECUTOR_PHONE", $uc_phone);
										}
										
									}else{ // Если еще не выбрана УК 
										$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
									$tpl->assign("EXECUTOR_PHONE", $osi_phone);
									}
								}
						}

					$tpl->assign("ACTION", $action);


					$tpl->assign("WHY", $why);

					$tpl->assign("TYPE", $type);
					$tpl->assign("FLAT_NUMBER", $flat_data['flat_number']);
					$tpl->assign("STREET", $house['street']);
					$tpl->assign("HOUSE", $house['house_number']);
					$tpl->parse("TAB4_ROWS", ".".$moduleName . "tab4_row");
				}
			}
			
			
			//Пятый таб
			$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 4 ORDER BY time_create DESC");
			$acceptedRequestsCount = db_num_rows($result);
			$tpl->assign("ACCEPTED_REQUESTS_COUNT", $acceptedRequestsCount);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$type = db_get_data("SELECT name FROM module_request_types WHERE id = ".$row['type_id'], "name");
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$name = db_get_data("SELECT name FROM module_citizens WHERE id = ".$row['citizen_id'], "name");
					$name_phone =  db_get_data("SELECT phone FROM module_citizens WHERE id = ".$row['citizen_id'], "phone");
					
					$osi = db_get_data("SELECT name FROM module_osi WHERE id = ".$row['osi_id'], "name");
					$osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = ".$row['osi_id'], "phone");

					$uc = db_get_data("SELECT name FROM module_ucs WHERE id = ".$row['uc_id'], "name");
					$uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = ".$row['uc_id'], "phone");

					$uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "name");
					$uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "phone");

					$status = db_get_data("SELECT name FROM module_request_statuses WHERE id = ".$row['request_status_id'], "name");

					$review = db_get_data("SELECT rating_id FROM module_request_reviews WHERE request_id = ".$row['id'], "rating_id");
					$review_text =  db_get_data("SELECT description FROM module_request_reviews WHERE request_id = ".$row['id'], "description");
					
					$flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$row['flat_id']);
					$house = db_get_data("SELECT * FROM module_houses WHERE id = ".$flat_data['house_id']);

					$why = $row['cancel'];
					
					$tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
					$tpl->assign("DESCR2", $row['description']);
					$tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
					$tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));
					
					$tpl->assign("ID", $row['id']);

					$images = unserialize($row['photo_i']);

					$tpl->clear("IMAGES_LIST");

					$image_list = "";
					$i = 0;
					if($images){
						foreach ($images as &$image) {
							$image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
							if($i==0){
								$image_list .='<div class="carousel-item active"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}else{
								$image_list .='<div class="carousel-item"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}
							
							$i++;
		
							}
					}else{
						$image_list = '<p>Вложенные фотографии отсутствует</p>';
					}
					
		
					$tpl->assign("IMAGES_LIST", $image_list);


					
					if(intval($row['citizen_id']) > 0){
							
						$tpl->assign("AUTHOR", "Житель:  ".$name);
						$tpl->assign("AUTHOR_PHONE", $name_phone);
						$tpl->assign("CITY", $city);
							$tpl->assign("FLAT_NUMBER", ", кв. ".$flat_data['flat_number']);
							$tpl->assign("STREET", $house['street']);
							$tpl->assign("HOUSE", $house['house_number']);
							if($row['uc_accepted'] > 0){ 
								if($row['worker_uc_id']> 0){
									$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
								$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
								}else{
									$tpl->assign("EXECUTOR", "УК: ".$uc);
									$tpl->assign("EXECUTOR_PHONE", $uc_phone);
								}
								
							}else{ // Если еще не выбрана УК 
								$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
							$tpl->assign("EXECUTOR_PHONE", $osi_phone);
							}
							
						}else{
							$tpl->assign("AUTHOR", "ОСИ:  ".$osi);
							$tpl->assign("AUTHOR_PHONE", $osi_phone);
							$tpl->assign("FLAT_NUMBER", "");
							$tpl->assign("CITY", $city);
								$tpl->assign("STREET", $house['street']);
								$tpl->assign("HOUSE", $house['house_number']);
								if($row['uc_id'] > 0){
									if($row['uc_accepted'] > 0){ 
										if($row['worker_uc_id']> 0){
											$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
										$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
										}else{
											$tpl->assign("EXECUTOR", "УК: ".$uc);
											$tpl->assign("EXECUTOR_PHONE", $uc_phone);
										}
										
									}else{ // Если еще не выбрана УК 
										$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
									$tpl->assign("EXECUTOR_PHONE", $osi_phone);
									}
								}
						}

					$tpl->assign("STATUS", $status);

					$tpl->assign("REVIEW", $review);
					$tpl->assign("REVIEW_TEXT", $review_text);

					$action = "";
					$action = GetActionByTabIDAndSessionTypeID(5, intval($_SESSION['type']), intval($row['id']) , intval($_SESSION['id']), intval($_SESSION['type']), $row['osi_accepted'],$row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted'] );
					
					$action2 = "";
					$action2 = GetAction2ByTabIDAndSessionTypeID(5, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии

					$tpl->assign("ACTION", $action);

					$tpl->assign("WHY", $why);

					$tpl->assign("TYPE", $type);
					
					$tpl->parse("TAB5_ROWS", ".".$moduleName . "tab5_row");
				}
			}
			

			//Шестой таб
			$result = db_query("SELECT * FROM module_requests WHERE ".$user_type_id." = ".$_SESSION['id']." AND request_status_id = 5 ORDER BY time_create DESC");
			$notAcceptedRequestsCount = db_num_rows($result);
			$tpl->assign("NOT_ACCEPTED_REQUESTS_COUNT", $notAcceptedRequestsCount);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$type = db_get_data("SELECT name FROM module_request_types WHERE id = ".$row['type_id'], "name");
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$name = db_get_data("SELECT name FROM module_citizens WHERE id = ".$row['citizen_id'], "name");
					$name_phone =  db_get_data("SELECT phone FROM module_citizens WHERE id = ".$row['citizen_id'], "phone");
					
					$osi = db_get_data("SELECT name FROM module_osi WHERE id = ".$row['osi_id'], "name");
					$osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = ".$row['osi_id'], "phone");

					$uc = db_get_data("SELECT name FROM module_ucs WHERE id = ".$row['uc_id'], "name");
					$uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = ".$row['uc_id'], "phone");

					$uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "name");
					$uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = ".$row['worker_uc_id'], "phone");

					$status = db_get_data("SELECT name FROM module_request_statuses WHERE id = ".$row['request_status_id'], "name");

					$review = db_get_data("SELECT rating_id FROM module_request_reviews WHERE request_id = ".$row['id'], "rating_id");
					$review_text =  db_get_data("SELECT description FROM module_request_reviews WHERE request_id = ".$row['id'], "description");
					
					$flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = ".$row['flat_id']);
					$house = db_get_data("SELECT * FROM module_houses WHERE id = ".$flat_data['house_id']);

					//Сделать проверку на уровни 

					$why = $row['cancel'];
					
					$tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
					$tpl->assign("DESCR2", $row['description']);
					$tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
					$tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));
					
					
					
					$images = unserialize($row['photo_i']);
					
					$tpl->assign("ID", $row['id']);

					
					$tpl->clear("IMAGES_LIST");

					$image_list = "";
					$i = 0;
					if($images){
						foreach ($images as &$image) {
							$image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
							if($i==0){
								$image_list .='<div class="carousel-item active"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}else{
								$image_list .='<div class="carousel-item"><a data-fancybox="gallery" href="../photos/'.$image_url[0].'"><img class="d-block center-img" height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></a></div>';
					   
							}
							
							$i++;
		
							}
					}else{
						$image_list = '<p>Вложенные фотографии отсутствует</p>';
					}
					
		
					$tpl->assign("IMAGES_LIST", $image_list);




					if(intval($row['citizen_id']) > 0){
							
						$tpl->assign("AUTHOR", "Житель:  ".$name);
						$tpl->assign("AUTHOR_PHONE", $name_phone);
						$tpl->assign("CITY", $city);
							$tpl->assign("FLAT_NUMBER", ", кв. ".$flat_data['flat_number']);
							$tpl->assign("STREET", $house['street']);
							$tpl->assign("HOUSE", $house['house_number']);
							if($row['uc_accepted'] > 0){ 
								if($row['worker_uc_id']> 0){
									$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
								$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
								}else{
									$tpl->assign("EXECUTOR", "УК: ".$uc);
									$tpl->assign("EXECUTOR_PHONE", $uc_phone);
								}
								
							}else{ // Если еще не выбрана УК 
								$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
							$tpl->assign("EXECUTOR_PHONE", $osi_phone);
							}
							
						}else{
							$tpl->assign("AUTHOR", "ОСИ:  ".$osi);
							$tpl->assign("AUTHOR_PHONE", $osi_phone);
							$tpl->assign("FLAT_NUMBER", "");
							$tpl->assign("CITY", $city);
								$tpl->assign("STREET", $house['street']);
								$tpl->assign("HOUSE", $house['house_number']);
								if($row['uc_id'] > 0){
									if($row['uc_accepted'] > 0){ 
										if($row['worker_uc_id']> 0){
											$tpl->assign("EXECUTOR", "Сотрудник УК: ".$uc_worker);
										$tpl->assign("EXECUTOR_PHONE", $uc_worker_phone);
										}else{
											$tpl->assign("EXECUTOR", "УК: ".$uc);
											$tpl->assign("EXECUTOR_PHONE", $uc_phone);
										}
										
									}else{ // Если еще не выбрана УК 
										$tpl->assign("EXECUTOR", "ОСИ: ".$osi);
									$tpl->assign("EXECUTOR_PHONE", $osi_phone);
									}
								}
						}

					
					$tpl->assign("STATUS", $status);

					$tpl->assign("REVIEW", $review);
					$tpl->assign("REVIEW_TEXT", $review_text);

					$action = "";
					$action = GetActionByTabIDAndSessionTypeID(6, intval($_SESSION['type']), intval($row['id']) , intval($_SESSION['id']), intval($_SESSION['type']), $row['osi_accepted'],$row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted'] );
					
					$action2 = "";
					$action2 = GetAction2ByTabIDAndSessionTypeID(6, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

					$tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии

					$tpl->assign("ACTION", $action);

					$tpl->assign("WHY", $why);

					$tpl->assign("TYPE", $type);
					
					$tpl->parse("TAB6_ROWS", ".".$moduleName . "tab6_row");
				}
			}
			

			// список квартир		
			$city_list = ''; 
			$result = db_query("SELECT t1.*, t2.osi_id, t2.house_id, t2.flat_number, t2.city_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.citizen_id = ".$_SESSION['id']);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$house = db_get_data("SELECT * FROM module_houses WHERE id = '".$row['house_id']."'");

					$city_list .= '<option value="'.$row['id'].'">'.$city.', '.getval("STR_STREET_SOKR_TITLE").' '.$house['street'].' '.$house['house_number'].', '.getval("STR_FLAT_SOKR_TITLE").' '.$row['flat_number'].'</option>';
				}
			}
			$tpl->assign("CITY_LIST", $city_list);

			// список домов для ОСИ
			$result = db_query("SELECT * FROM module_houses WHERE osi_id = '".$_SESSION['id']."' AND status = 1 ORDER BY id DESC");
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
					$house_list .= '<option value="'.$row['id'].'"> г. '.$city.', '.getval("STR_STREET_SOKR_TITLE").' '.$row['street'].' '.$row['house_number'].'</option>';
				}
			}
			$tpl->assign("HOUSE_LIST", $house_list);

			// список уК для ОСИ
			$result = db_query("SELECT * FROM module_osi_and_ucs WHERE osi_id = '".$_SESSION['id']."' AND status = 1 ORDER BY id DESC");
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$uc = db_get_data("SELECT * FROM module_ucs WHERE id = ".$row['ucs_id']);
					$uc_list .= '<option value="'.$uc['id'].'"> '.$uc['name'].'</option>';
				}
			}
			$tpl->assign("UC_LIST", $uc_list);


			// список работников для УК
			$result = db_query("SELECT * FROM module_worker_uc WHERE uc_id = '".$_SESSION['id']."' AND status = 1 ORDER BY id DESC");
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					//$uc = db_get_data("SELECT * FROM module_ucs WHERE id = ".$row['ucs_id']);
					$worker_list .= '<option value="'.$row['id'].'"> '.$row['name'].'</option>';
				}
			}
			$tpl->assign("WORKER_LIST", $worker_list);

			$type_list = db_get_array("SELECT * FROM module_request_types", "id", "name");
			assignList("TYPE_LIST", $type_list);

			
			$tpl->parse(strtoupper($moduleName), $moduleName);
		} else { 
			header("Location: /".LANG_INDEX."/auth");
			exit;
		}
	?>