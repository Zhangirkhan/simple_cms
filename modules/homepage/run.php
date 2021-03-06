<?php
	$moduleName = "homepage";
	$prefix = "modules/" . $moduleName . "/";

	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
			$moduleName . "knowledge" => $prefix . "knowledge.tpl",
		));

	# SETTINGS #####################################################################################

	$type = 0;
	$table = '';
	$usr_login = '';
	$usr_passw = '';
	$save = '';
	$raiting_items = '';
	$osi_list = '';
	$ucs_list_first_coll  = '';
	$ucs_list_second_coll  = '';
	$rating = '';
	$osi_count = '';
	# MAIN #########################################################################################
	header("Location: https://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/raiting");
	exit;

	if (isset($_POST['send'])) {
		$type = intval($_POST['type']);
		$phone = cleanStr($_POST['phone']);
		$password = cleanStr($_POST['password']);

		if ($type == 1) $table = 'module_ucs';
		if ($type == 2) $table = 'module_osi';
		if ($type == 3) $table = 'module_citizens';
		if ($type == 4) $table = 'module_worker_uc';
		if ($type == 5) $table = 'module_manager_uc';

		$result = db_query("SELECT * FROM ".$table." WHERE phone = '".$phone."' AND password = MD5('".$password."') LIMIT 1");
		if ($result) {
			$row = db_fetch_object($result);

			$_SESSION['id'] = $row->id;
			$_SESSION['email'] = $row->email;
			$_SESSION['type'] = $type;

			// Сохраняем логин и пароль в куках, удаляем если не отметили "запомнить"
			if (isset($_POST['chk_save'])) {
				$cookie_value = $phone."|".$password."|".$_SERVER['HTTP_HOST'];
				$cookie_value = crypt_string($cookie_value);
				setcookie("ehome_auth", $cookie_value, time()+60*60*24*30, "", $_SERVER['HTTP_HOST']);
			} else {
				if (isset($_COOKIE['ehome_auth'])) {
					$cookie_value = "";
					setcookie("ehome_auth", $cookie_value, 0, "", $_SERVER['HTTP_HOST']);
				}
			}

			header("Location: https://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/raiting");
			exit;
		} else {
			header("Location: http://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/1");
			exit;
		}
	} else {
		if (isset($_GET['item_id'])) {
			switch ($_GET['item_id']) {
				case 1: $tpl->assign("RESULT_MESSAGE", showResult(getval("MSG_LOGIN_ERROR_TITLE"), 'result_error')); break;
				default: $tpl->assign("RESULT_MESSAGE", '');
			}
		} else {
			$tpl->assign("RESULT_MESSAGE", '');
		}

		if (isset($_COOKIE['ehome_auth'])) {
			$str = crypt_string($_COOKIE['ehome_auth'], false);
			$login_info = explode("|", $str);
			if (is_array($login_info)) {
				$host = $login_info[2];
				if ($host == $_SERVER['HTTP_HOST']) {
					$usr_login = $login_info[0];
					$usr_passw = $login_info[1];
					$save = 'checked';
				}
			}
		}

		$tpl->assign(array(
				"USR_LOGIN" => $usr_login,
				"USR_PASSW" => $usr_passw,
				"SAVE"      => $save,
			));
	}

	// Список ОСИ
	$result = db_query("SELECT * FROM module_osi ORDER BY id DESC");
	$rating_id  = '';
	$rating = '';
	if (db_num_rows($result) > 0) {
		while ($row = db_fetch_array($result)) {

			$reviews = db_query("SELECT t1.*, t2.* FROM module_request_reviews AS t1 LEFT JOIN module_requests AS t2 ON t2.id = t1.request_id WHERE t2.osi_id = ".$row['id']."");

			$image = db_get_data("SELECT url_photos from module_photos WHERE id = ".$row['image'], "url_photos");


			while ($review = db_fetch_array($reviews)) {
							$rating_id = $review['rating_id'] + $rating_id;

						}


						if(db_num_rows($reviews)>0){
                        $rating              = $rating_id / db_num_rows($reviews);
                    }

						//if($rating_id){


						$rating = round($rating);
						$RATING_REVIEW_COUNT = round($rating);

						$raiting_items='';

						$raiting_items .= '<div class="text-primary">';

						for ($x=1; $x<=5; $x++){
							if($rating>=$x){
								$raiting_items .= '<i class="fa fa-star checked"> </i>';
							}else{
								$raiting_items .= '<i class="fa fa-star"> </i>';
							}
						}

						$raiting_items .= '</div>('.db_num_rows($reviews).')';
						/* }else{
							$raiting_items='';
						$raiting_items .= '<div class="text-primary">';

						for ($x=1; $x<=5; $x++){
							if($RATING_REVIEW_COUNT>=$x){
								$raiting_items .= '<i class="fa fa-star checked"> </i>';
							}else{
								$raiting_items .= '<i class="fa fa-star"> </i>';
							}
						}

						$raiting_items .= '</div>(0)';
						} */

						if($image){
							$logo = '<div class="profile-pic">
                            <span class="avatar cover-image avatar-xxl bradius" data-image-src="../photos/'.$image.'" background: url(../photos/'.$image.';) center center;"></span>
                        </div>';
						}else{
							$logo = '<div class="profile-pic">
                            <span class="avatar cover-image avatar-xxl bradius" data-image-src="../photos/1589361273-1.jpg" background: url(../photos/1589361273-1.jpg;) center center;"></span>
                        </div>';
						}



				$osi_list .= '<div class="item">';

			$osi_list .= '<div class="card">
			<div class="card-body p-3">
				<div class="d-md-flex">
					'.$logo.'
					<div class="mt-2 ml-2">
						<a class="text-body" href="/ru/profile_osi_portal/'.$row['id'].'">
							<h4 class="fs-16 font-weight-semibold">'.$row['name'].'</h4>
						</a>
							'.$raiting_items.'
					</div>
				</div>
			</div>
		</div>
		</div>
		';


		}
	}
	//Раздел
	$result = db_query("SELECT * FROM module_knowledgebases WHERE status = 3 ORDER BY time_create DESC LIMIT 3");
	if(db_num_rows($result) > 0){
		while ($row = db_fetch_array($result)) {

			if($row['user_type_id'] == 1){
				$author_name = db_get_data("SELECT * FROM module_ucs WHERE id = ".$row['user_id']);
			}elseif($row['user_type_id'] == 2){
				$author_name = db_get_data("SELECT * FROM module_osi WHERE id = ".$row['user_id']);
			}else if($row['user_type_id'] == 3){
				$author_name = db_get_data("SELECT * FROM module_citizens WHERE id = ".$row['user_id']);
			}else if($row['user_type_id'] == 4){
				$author_name = db_get_data("SELECT * FROM module_worker_uc WHERE id = ".$row['user_id']);
			}

			$main_pic = db_get_data("SELECT * from module_photos WHERE id = ".$row['main_pic']);
			$tpl->assign("ID", $row['id']);
			$tpl->assign("AUTHOR", $author_name['name']);
			$tpl->assign("AUTHOR_ID", $author_name['id']);
			$tpl->assign("TIME",  date("d.m.Y", strtotime($row['time_create'])));

			$tpl->assign("TITLE", $row['title']);
			$tpl->assign("TEXT", mb_strimwidth($row['text'], 0, 100, "..."));
			if($main_pic['url_photos']){
				$tpl->assign("MAIN_PIC", $main_pic['url_photos']);
			}else{
				$tpl->assign("MAIN_PIC", '1596363638-1.jpg');
			}


			$tpl->parse("KNOWLEDGE", ".".$moduleName . "knowledge");
		}

	}else{

	}


	$tpl->assign("OSI_LIST", $osi_list);

/*
	// Список УК ДЛЯ первой колонны
	$result = db_query("SELECT * FROM module_ucs ORDER BY id DESC LIMIT 0, 3");
	$rating_id = 0;

	if (db_num_rows($result)> 0) {
		$ucs_list_first_coll .= '<div class="col-lg-6">
				<ul class="vertical-scroll">';
		while ($row = db_fetch_array($result)) {

			$reviews = db_query("SELECT t1.*, t2.* FROM module_request_reviews AS t1 LEFT JOIN module_requests AS t2 ON t2.id = t1.request_id WHERE t2.uc_id = ".$row['id']."");
			$image = db_get_data("SELECT url_photos from module_photos WHERE id = ".$row['image']);
			if($image){
				$logo = '<div class="profile-pic">
				<span class="avatar cover-image avatar-xxl bradius" data-image-src="../photos/'.$image[0].'" style="border-radius: 50%; background: url(../photos/'.$image[0].';) center center;"></span>
			</div>';
			}else{
				$logo = '<div class="profile-pic">
				<span class="avatar cover-image avatar-xxl bradius" data-image-src="../photos/1589361273-1.jpg" style="border-radius: 50%; background: url(../photos/1589361273-1.jpg;) center center;"></span>
			</div>';
			}
			while ($review = db_fetch_array($reviews)) {
							$rating_id = $review['rating_id'] + $rating_id;

						}
						if($rating_id){
							//$rating = $rating_id / db_num_rows($reviews);

						$rating = round($rating, 2);
						$RATING_REVIEW_COUNT = round($rating);

						$raiting_items='';
						$raiting_items .= '<div class="text-primary">';

						for ($x=1; $x<=5; $x++){
							if($RATING_REVIEW_COUNT>=$x){
								$raiting_items .= '<i class="fa fa-star"> </i>';
							}else{
								$raiting_items .= '<i class="fa fa-star-o"> </i>';
							}
						}

						$raiting_items .= '</div>('.$RATING_REVIEW_COUNT.')';
						}else{
							$raiting_items = '0';
						}



				$ucs_list_first_coll .= '<li class="item bg-white">

					<div class="d-sm-flex card-body p-3">
						<div class="p-0 m-0 mr-3">
							<div class="">
								'.$logo.'
								</div>
						</div>
						<div class="item-card9">
							<a href="/ru/profile_uc_portal/'.$row['id'].'" class="text-dark">
								<h4 class="font-weight-semibold mt-1">'.$row['name'].'</h4>
							</a>
							'.$raiting_items.'
						</div>
						<div class="ml-auto">
							<a class="btn btn-light mt-3 mt-sm-6 mr-0 font-weight-semibold text-dark" href="/ru/profile_uc_portal/'.$row['id'].'">
								<i class="fa fa-briefcase"></i> Профиль
							</a>
						</div>
					</div>

			</li>';
			}
			$ucs_list_first_coll .= '</ul>
			</div>';
		}

*/

		/*
	// Список УК ДЛЯ второй колонны
	$result = db_query("SELECT * FROM module_ucs ORDER BY id DESC LIMIT 3, 3");
	$rating_id = 0;
	if (db_num_rows($result)>0) {
		$ucs_list_second_coll .= '<div class="col-lg-6">
				<ul class="vertical-scroll">';
		while ($row = db_fetch_array($result)) {

			$reviews = db_query("SELECT t1.*, t2.* FROM module_request_reviews AS t1 LEFT JOIN module_requests AS t2 ON t2.id = t1.request_id WHERE t2.uc_id = ".$row['id']."");

						while ($review = db_fetch_array($reviews)) {
							$rating_id = $review['rating_id'] + $rating_id;

						}


						//$rating = $rating_id / db_num_rows($reviews);

						$rating = round($rating, 2);
						$RATING_REVIEW_COUNT = round($rating);

						$raiting_items='';
						$raiting_items .= '<div class="text-primary">';

						for ($x=1; $x<=5; $x++){
							if($RATING_REVIEW_COUNT>=$x){
								$raiting_items .= '<i class="fa fa-star"> </i>';
							}else{
								$raiting_items .= '<i class="fa fa-star-o"> </i>';
							}
						}

						$raiting_items .= '</div>('.$RATING_REVIEW_COUNT.')';

						$image = db_get_data("SELECT url_photos from module_photos WHERE id = ".$row['image']);
			if($image){
				$logo = '<div class="profile-pic">
				<span class="avatar cover-image avatar-xxl bradius" data-image-src="../photos/'.$image[0].'" style="border-radius: 50%; background: url(../photos/'.$image[0].';) center center;"></span>
			</div>';
			}else{
				$logo = '<div class="profile-pic">
				<span class="avatar cover-image avatar-xxl bradius" data-image-src="../photos/1589361273-1.jpg" style="border-radius: 50%; background: url(../photos/1589361273-1.jpg;) center center;"></span>
			</div>';
			}
				$ucs_list_second_coll .= '<li class="item bg-white">

					<div class="d-sm-flex card-body p-3">
						<div class="p-0 m-0 mr-3">
							<div class="">
							'.$logo.'
							</div>
						</div>
						<div class="item-card9">
							<a href="/ru/profile_uc_portal/'.$row['id'].'" class="text-dark">
								<h4 class="font-weight-semibold mt-1">'.$row['name'].'</h4>
							</a>
							'.$raiting_items.'
						</div>
						<div class="ml-auto">
							<a class="btn btn-light mt-3 mt-sm-6 mr-0 font-weight-semibold text-dark" href="/ru/profile_uc_portal/'.$row['id'].'">
								<i class="fa fa-briefcase"></i> Профиль
							</a>
						</div>
					</div>

			</li>';
			}
		}
		$ucs_list_second_coll .= '</ul>
			</div>';
		*/
			$city_name ="";
			$result = db_query("SELECT * FROM module_cities");
					if ($result) {
						while ($row = db_fetch_array($result)) {
							$city_name .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
						}
					}
			$tpl->assign("STREETS", $city_name);

	$result = db_query("SELECT * FROM module_ucs WHERE status = 1 ORDER BY id DESC");
	$ucs_count = db_num_rows($result);
	$tpl->assign("UCS_COUNT", $ucs_count);
	$tpl->assign("UCS_LIST_FIRST_COLL", $ucs_list_first_coll);
	$tpl->assign("UCS_LIST_SECOND_COLL", $ucs_list_second_coll);

	// Список Активных домов
	$result = db_query("SELECT * FROM module_houses WHERE status = 1 ORDER BY id DESC");
	$houses_count = db_num_rows($result);
	$tpl->assign("HOUSES_COUNT", $houses_count);

	$result = db_query("SELECT * FROM module_osi");
	$osi_count = db_num_rows($result);
	$tpl->assign("OSI_COUNT", $osi_count);



	$tpl->parse(strtoupper($moduleName), $moduleName);
?>
