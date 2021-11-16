<?php
$moduleName = "request_citizens";
$prefix     = "modules/" . $moduleName . "/";

$tpl->define(array(
    $moduleName => $prefix . $moduleName . ".tpl",
    $moduleName . "row" => $prefix . "row.tpl",
    $moduleName . "nodata" => $prefix . "nodata.tpl",
));

# SETTINGS #####################################################################################

$type  = 0;
$table = '';

$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); 

		$newFileName1 = '';
		$newFileName2 = '';
		$newFileName3 = '';
		$newFileName4 = '';
# FUNCTIONS #########################################################################################

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
       if($sessionType == 3){ // Житель
            if($osi_accepted == 0){ // Заявка создана но ее еще не приняли
                $action = '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteRequest('.$id.','.$sessionID.','.$sessionType.');" data-original-title="Удалить"><i class="fa fa-times"></i></a> ';
            }else if($osi_accepted == 1){
                $action = '<a class="btn btn-warning btn-sm text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Отклонить"><i class="fa fa-times"></i></a> ';
            }else{ //заявка взята или будет выполнять сам
                $action = '';
            }
            
        }
    }else if($tab == 2){

       if($sessionType == 3){  // Житель
            $action = '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" data-original-title="Дублировать"><i class="fa fa-recycle"></i></a> ';
        }
    }else if($tab == 3){
        
       if($sessionType == 3){  // Житель
            
        }
        
    }else if($tab == 4){
        
       if($sessionType == 3){  // Житель
            $action = '<a class="btn btn-success btn-sm text-white" id="AddReviewButton" data-toggle="modal" data-target="#AddReview" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" data-original-title="Принять"><i class="fa fa-thumbs-up"></i></a> 
            <a class="btn btn-danger btn-sm text-white " id="NotFinishedRequestButton" data-toggle="modal"  data-target="#NotFinishedRequest" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'"  data-original-title="Отклонить"><i class="fa fa-thumbs-down"></i></a> ';
        }
    }
    else if($tab == 5){
        
       
     }
     else if($tab == 6){
        $action = '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" data-original-title="Дублировать"><i class="fa fa-recycle"></i></a> ';
      
     }

    $action .= '<a class="btn btn-gray btn-sm text-white" data-toggle="tooltip"  onclick="requestHistory('.$id.')" data-original-title="История"><i class="fa fa-history"></i></a> ';
    return $action;
}

function GetAction2ByTabIDAndSessionTypeID($tab, $sessionType, $id ,$sessionID, $from, $osi_accepted , $uc_id, $uc_accepted , $worker_uc_id, $worker_uc_accepted ) {
    
    $action = '';
    if($tab == 1){
        if($sessionType == 3){ // Житель
            if($osi_accepted == 0){ // Заявка создана но ее еще не приняли
                $action = '<a  class="btn btn-danger text-white" data-toggle="tooltip" data-target="#delete" onclick="deleteRequest('.$id.','.$sessionID.','.$sessionType.');">Удалить</a> ';
            }else if($osi_accepted == 1)
            { //заявка взята или будет выполнять сам   
                 $action = '<a class="btn btn-warning text-white" data-toggle="modal" id="CancelRequestButton" data-target="#not-accept-request-osi" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'">Отклонить</a> ';
            }else{
                $action = '';
            }
            
        }

    }else if($tab == 2){

        if($sessionType == 3){  // Житель
            $action = '<a  class="btn btn-primary text-white" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" >Дублировать</a> ';
        }
    }else if($tab == 3){
        
       
        
    }else if($tab == 4){
        
        if($sessionType == 3){  // Житель

            $action = ' <a  class="btn btn-success text-white" id="AddReviewButton" data-toggle="modal" data-target="#AddReview" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Принять</a> 
                        <a  class="btn btn-danger text-white" id="NotFinishedRequestButton" data-toggle="modal"  data-target="#NotFinishedRequest" data-id="'.$id.'" data-stuff="'.$sessionType.'" data-author="'.$sessionID.'" >Отклонить</a> ';
                
        }

    }else if($tab == 5){
        
       
    }else if($tab == 6){
        $action = '<a  class="btn btn-primary text-white" data-toggle="tooltip" onclick="recycleRequest('.$id.', '.$sessionType.' );" >Дублировать</a> ';
    }
    $action .= ' <a  class="btn btn-gray text-white" data-toggle="tooltip"  onclick="requestHistory('.$id.')">История</a>';
    return $action;
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

# ACTIONS #########################################################################################

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

    noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявка выполнена' , 'Сотрудник УК: <b>' .$executor_data['name'].'</b> выполнил(а) заявку #'.$id.'', 0, 0, 'requests_citizen', 'requests_citizen');

    $sql1 = "INSERT module_request_reviews SET request_id = '".$id."',
                                        description = '".$review."',
                                        rating_id = '".$rating."',
                                        executor = '".$executor."',
                                        executor_type = '".$executor_type."',	
                                        wroter = '".$wroter."',
                                        wroter_type = '".$wroter_type."',
                                        date_create = NOW()"; 
    db_query($sql1);

    $citizen_data = db_get_data("SELECT * from module_citizens WHERE id = ".$wroter);

   logging( $id, 'Заявке написан отзыв с оценкой: '.$rating.' и с коммертарием: '.$review , $_SESSION['type'], $_SESSION['id']);
    
   noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявке написан отзыв' , 'Житель: <b>'.$citizen_data['name'].'</b> написал(а) отзыв к заявке #'.$id.' с оценкой: '.$rating.' и с коммертарием: '.$review, 0, 0, 'requests_citizen');

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
    }else if ($executor_type == 2){
        $executor_data = db_get_data("SELECT name, phone from module_osi WHERE id = ".$executor);
    }else{

    }
    
    logging( $id, 'Заявка не выполнена:' .$executor_data['name']. ' / '.$executor_data['phone'] , $_SESSION['type'], $_SESSION['id']);

    noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявка не выполнена' , 'Сотрудник УК: <b>' .$executor_data['name'].'</b> не выполнил(а) заявку #'.$id.'', 0, 0, 'requests_citizen');


    $sql1 = "INSERT module_request_reviews SET request_id = '".$id."',
                                        description = '".$review."',
                                        rating_id = '".$rating."',
                                        executor = '".$executor."',
                                        executor_type = '".$executor_type."',	
                                        wroter = '".$wroter."',
                                        wroter_type = '".$wroter_type."',
                                        date_create = NOW()"; 
    db_query($sql1);

    $citizen_data = db_get_data("SELECT * from module_citizens WHERE id = ".$wroter);

    logging( $id, 'Заявке написан отзыв с оценкой: '.$rating.' и с коммертарием: '.$review , $_SESSION['type'], $_SESSION['id']);

    noticeUsers( $_SESSION['id'], $_SESSION['type'], $executor, $executor_type ,'Заявке написан отзыв' , 'Житель: <b>'.$citizen_data['name'].'</b> написал(а) отзыв к заявке #'.$id.' с оценкой: '.$rating.' и с коммертарием: '.$review, 0, 0, 'requests_citizen');

    header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
    exit;
}


		# NOT ACCEPT REQUEST #################################################################################
if (isset($_POST['notAcceptRequestSend'])) {
			$cancel = cleanStr($_POST['cancel']);
			$id = intval($_POST['id']);
			$executor_type = intval($_POST['executor_type']);
			$request = db_get_data("SELECT * from module_requests WHERE id = ".$id);

			if($executor_type == 4){
				$sql = "UPDATE module_requests SET cancel = '".$cancel."', request_status_id = 1, worker_uc_accepted = 2 WHERE id = ".$id;
				noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['worker_uc_id'],$executor_type ,'Заявка не принята' , 'Исполнитель не принял(а) заявку по причине'.$cancel, 0, 0, 'requests_citizen');
				
			}else if($executor_type == 1){
				$sql = "UPDATE module_requests SET cancel = '".$cancel."', request_status_id = 6, uc_accepted = 2,  worker_uc_accepted = 0 WHERE id = ".$id;
				noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['uc_id'],$executor_type ,'Заявка не принята' , 'УК не принял(а) заявку по причине'.$cancel, 0, 0, 'requests_citizen');
			}
			else{
				$sql = "UPDATE module_requests SET request_status_id = 6, cancel = '".$cancel."' WHERE id = ".$id."";
				noticeUsers( $_SESSION['id'], $_SESSION['type'], $request['citizen_id'], $executor_type ,'Заявка не принята' , 'ОСИ не принял(а) заявку по причине'.$cancel, 0, 0, 'requests_citizen');
			}
			
			db_query($sql);

			logging( $id, 'Не принял(а/и) по причине: '.$cancel, $_SESSION['type'], $_SESSION['id']);
			
			

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

 if( intval($_SESSION['type'])===intval(3)){ // Житель
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
    $osi_data = db_get_data("SELECT name from module_osi WHERE id = ".$flat_data['osi_id']);
    
    logging( $id, 'Новая заявка создана '.$citizen_data['name'].' / '.$citizen_data['phone'] , $_SESSION['type'], $_SESSION['id']);

    noticeUsers( $_SESSION['id'], $_SESSION['type'], $flat_data['osi_id'], 2 ,'Новая заявка' , 'Житель: <b>'.$citizen_data['name'].'</b> создал(а) новую заявку <b>#'.$id.'</b> для ОСИ: <b>'.$osi_data['name'].'</b>', 0, 0, 'requests_citizen');

    }

    

    header("Location: /".LANG_INDEX."/".$_PAGE['mod_rewrite']);
    exit;
}

if (isset($_SESSION['id'])) {

    $first_result = "SELECT * FROM module_requests";

    if (isset($_POST['ex'])) { //Фильр бюджета по годам
        if (isset($_POST['statusFilter'])) {

            if(intval($_POST['statusFilter']) > 0){
                $full_result = $first_result." WHERE request_status_id = '".intval($_POST['statusFilter'])."' AND citizen_id = '".$_SESSION['id']."' ORDER BY id DESC";
                $sql_where = " request_status_id = '".intval($_POST['statusFilter'])."' AND citizen_id = ".$_SESSION['id'];
                $tpl->assign("STATUS".$_POST['statusFilter'], "selected");
            }else{
                $full_result = $first_result." WHERE citizen_id = '".$_SESSION['id']."' ORDER BY time_create DESC";
                $sql_where = " citizen_id = ".$_SESSION['id'];
            }

            $tpl->assign("STATUS".$_POST['statusFilter'], "selected");
        }
        if (isset($_POST['typeFilter'])) {

            if(intval($_POST['typeFilter']) > 0){
                $full_result = $first_result." WHERE type_id = '".intval($_POST['typeFilter'])."' AND citizen_id = '".$_SESSION['id']."' ORDER BY id DESC";
                $sql_where = " type_id = '".intval($_POST['typeFilter'])."' AND citizen_id = ".$_SESSION['id'];
               
                $tpl->assign("FILTER".$_POST['typeFilter'], "selected");
            }else{
                $full_result = $first_result." WHERE citizen_id = '".$_SESSION['id']."' ORDER BY time_create DESC";
                $sql_where = "citizen_id = ".$_SESSION['id'];
            }
            $tpl->assign("FILTER".$_POST['typeFilter'], "selected");
            
        }
        if (isset($_POST['dataFilter'])) {

            if(intval($_POST['dataFilter']) == 0){
                $full_result = $first_result." WHERE citizen_id = '".$_SESSION['id']."' ORDER BY time_create DESC";
                $sql_where = "citizen_id = ".$_SESSION['id'];
            }else if(intval($_POST['dataFilter'])== 1){ //Фильтр за сегодня
                $full_result = $first_result." WHERE DATE(`time_create`) = CURRENT_DATE() AND citizen_id = '".$_SESSION['id']."' ORDER BY id DESC";
            }else if(intval($_POST['dataFilter']) > 0){ //Фильтр за неделю
                $full_result = $first_result." WHERE DATE(`time_create`) >= ( NOW() - INTERVAL 7 DAY) AND citizen_id = '".$_SESSION['id']."' ORDER BY id DESC";
            }else if(intval($_POST['dataFilter']) > 0){ //Фильтр за месяц
                $full_result = $first_result." WHERE DATE(`time_create`) >= ( NOW() - INTERVAL 30 DAY) AND citizen_id = '".$_SESSION['id']."' ORDER BY id DESC";
            }
            $tpl->assign("DATEFILTER".$_POST['dataFilter'], "selected");
        }

    } else {
        $full_result = $first_result." WHERE citizen_id = '".$_SESSION['id']."' ORDER BY time_create DESC";
        $sql_where = " citizen_id = ".$_SESSION['id'];
    }
    $result2 = db_query($full_result);
    $_pages->numRows = db_num_rows($result2);
		$_pages->rowsPerPage = 5;
		$_pages->pagesRegion = 10;
		$i = 0;
        $resultLimit = $full_result." LIMIT ".$_pages->getLimit();
        
    $result = db_query($resultLimit);
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

            $review = db_get_data("SELECT rating_id FROM module_request_reviews WHERE request_id = ".$row['id'], "rating_id");

            $review_text = '';
            $review_text =  db_get_data("SELECT description FROM module_request_reviews WHERE request_id = ".$row['id'], "description");
            $why = $row['cancel'];
            
            $images = unserialize($row['photo_i']);

            $action = "";
            
            $for_id_id = "";
            $for_type_type = "";

            if($row['uc_id'] == 0){
                $for_id_id = $row['osi_id'];
                $for_type_type = 2;
            }else {
                $for_id_id = $row['uc_id'];
                $for_type_type = 1;
            }
            $action2 = "";
            $action = "";
            $tpl->clear("REVIEW_TEXT");
            if($row['request_status_id'] == 1){
                $tpl->assign("REVIEW_TEXT", '');
                $tpl->assign("STATUS", '<a class="badge badge-success" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                
				$action2 = GetAction2ByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
				
            }else if ($row['request_status_id'] == 2){
                $tpl->assign("REVIEW_TEXT", '');
                $tpl->assign("STATUS", '<a class="badge badge-primary" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                $action2 = GetAction2ByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

            }else if ($row['request_status_id'] == 3){
                $tpl->assign("REVIEW_TEXT", '');
                $tpl->assign("STATUS", '<a class="badge badge-success" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(4, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                $action2 = GetAction2ByTabIDAndSessionTypeID(4, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

            }else if ($row['request_status_id'] == 4){
                $tpl->assign("REVIEW_TEXT", '<div><h4>Отзыв</h4><p>'.$review_text.'</p></div>');
                $tpl->assign("STATUS", '<a class="badge badge-success" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(5, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                $action2 = GetAction2ByTabIDAndSessionTypeID(5, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

            }else if ($row['request_status_id'] == 5){
                
                $tpl->assign("REVIEW_TEXT", '<div style="color: red;"><h5>Причина отказа</h5><p>'.$review_text.'</p></div>');
                $tpl->assign("STATUS", '<a class="badge badge-danger" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(6, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                $action2 = GetAction2ByTabIDAndSessionTypeID(6, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );

            }else if ($row['request_status_id'] == 6){
                $tpl->assign("REVIEW_TEXT", '<div style="color: red;"><h5>Причина отказа</h5><p>'.$why.'</p></div>');
                $tpl->assign("STATUS", '<a class="badge badge-danger" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(2, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                $action2 = GetAction2ByTabIDAndSessionTypeID(2, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
           
            }else if ($row['request_status_id'] == 11){
                $tpl->assign("REVIEW_TEXT", '');
                $tpl->assign("STATUS", '<a class="badge badge-success" style="color: white">'.$status.'</a>');
                $action = GetActionByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
                $action2 = GetAction2ByTabIDAndSessionTypeID(1, intval($_SESSION['type']), intval($row['id']), intval($_SESSION['id']), $row['citizen_id'], $row['osi_accepted'], $row['uc_id'], $row['uc_accepted'], $row['worker_uc_id'], $row['worker_uc_accepted']  );
            
            }

            $image_list = "";
            $i = 0;
            if($images){
                foreach ($images as &$image) {
                    $image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = ".$image);
                    if($i==0){
                        $image_list .='<div class="carousel-item active"><img class="d-block w-100" loading="lazy"  height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></div>';
               
                    }else{
                        $image_list .='<div class="carousel-item"><img class="d-block w-100" loading="lazy"  height="200px" alt="" src="../photos/'.$image_url[0].'" data-holder-rendered="true"></div>';
                    }
                    
               
                    $i++;

                    }
            }else{
                $image_list = '<p style="text-align: center">Вложенные фотографии отсутствует</p>';
            }
            

            $tpl->assign("IMAGES_LIST", $image_list);
            $tpl->assign("ID", $row['id']);
            
           
            if(intval($row['citizen_id']) > 0){
                    
                $tpl->assign("AUTHOR", "Житель:  ".$name);
                $tpl->assign("AUTHOR_PHONE", $name_phone);
                $tpl->assign("CITY", 'г.'.$city);
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
                        
                    }else{
                    $tpl->assign("EXECUTOR", "ОСИ: ".$osi);
                    $tpl->assign("EXECUTOR_PHONE", $osi_phone);
                    }
                }else{
                    $tpl->assign("AUTHOR", "ОСИ:  ".$osi);
                    $tpl->assign("AUTHOR_PHONE", $osi_phone);
                    $tpl->assign("FLAT_NUMBER", "");
                    $tpl->assign("CITY", 'г.'.$city);
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
                            }else{
                                $tpl->assign("EXECUTOR", "ОСИ: ".$osi);
                            $tpl->assign("EXECUTOR_PHONE", $osi_phone);
                            }
                        }
                }

                if($review){
                    $tpl->assign("REVIEW", $review);
                }else{
                    $tpl->assign("REVIEW", 'Пока оценки нет');
                }
			
            $tpl->assign("ACTION", $action);
            $tpl->assign("ACTION2", $action2); //Кнопки в низу фотографии
            $tpl->assign("DESCR", mb_strimwidth($row['description'], 0, 100, "..."));
            $tpl->assign("DESCR2", $row['description']);
            $tpl->assign("DATE", date("d.m.Y", strtotime($row['time_create'])));
            $tpl->assign("TIME", date("H:i", strtotime($row['time_create'])));

            
            
            $tpl->assign("TYPE", $type);
            $uc_id = db_get_array("SELECT ucs_id from module_osi_and_ucs WHERE osi_id = '".$_SESSION['id']."' AND status = 1", "ucs_id");
            $uc = db_get_array("SELECT * from module_ucs WHERE id = '".$uc_id[0]."' AND status = 1", "id", "name");
            assignList("UC_LIST", $uc);
            $tpl->parse("ROWS", ".".$moduleName . "row");
            $_pages->parse(LANG_INDEX.'/requests_citizen/page/{PAGE}/show', "", "LIST_PAGES");
        }
    }
    else{
        $tpl->assign("HIDDEN", "display:none");
        $tpl->parse("NODATA", ".".$moduleName . "nodata");
        
        
    }




# MAIN #########################################################################################


			// список квартир		
			$city_list = ''; 
			$result = db_query("SELECT t1.*, t2.osi_id, t2.house_id, t2.flat_number, t2.city_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE status=1 AND t1.citizen_id = ".$_SESSION['id']);
			if (db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$city = db_get_data("SELECT name FROM module_cities WHERE id = ".$row['city_id'], "name");
                    $house = db_get_data("SELECT * FROM module_houses WHERE id = '".$row['house_id']."'");
                    $district = db_get_data("SELECT * FROM module_districts WHERE id = '".$house['district_id']."'");

					$city_list .= '<option value="'.$row['id'].'">г.'.$city.', '. $district['name'].', '.getval("STR_STREET_SOKR_TITLE").' '.$house['street'].' '.$house['house_number'].', '.getval("STR_FLAT_SOKR_TITLE").' '.$row['flat_number'].'</option>';
				}
			}
			$tpl->assign("CITY_LIST", $city_list);


$type_list = db_get_array("SELECT * FROM module_request_types", "id", "name");
assignList("TYPE_LIST", $type_list);

$tpl->parse(strtoupper($moduleName), $moduleName);

}else{
    header("Location: /".LANG_INDEX."/auth");
			exit;
}
?>