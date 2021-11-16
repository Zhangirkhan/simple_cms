<?php
	$moduleName = "registration";
	$prefix = "modules/" . $moduleName . "/";
	
	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
		));
		
	# SETTINGS #####################################################################################
	
	$type = 0;
	$table = '';

	
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
	
	# MAIN #########################################################################################

	if (isset($_POST['send'])) { 
		if ($_SESSION['sms_code'] != $_POST['code']) {
			header("Location: http://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/3");
			exit;
		}

		if (empty($_POST['fio']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['password'])) {	
			header("Location: http://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/1");
			exit;
		}

		$type = intval($_POST['type_user']);
		$fio = cleanStr($_POST['fio']);
		$phone = cleanStr($_POST['phone']);
		$email = cleanStr($_POST['email']);
		$password = cleanStr($_POST['password']);

		if ($type == 1) {
			$table = 'module_ucs';
			$link = 'panel_uk';
		}

		if ($type == 2) {
			$table = 'module_osi';
			$link = 'panel_osi';
		}

		if ($type == 3) {
			$table = 'module_citizens';
			$link = 'cabinet_citizen';
		}
		if ($type == 5) {
			$table = 'module_specialists';
			$link = 'cabinet_specialist';
		}
		
		$count = db_table_count($table, "phone = ".$phone);
		
		if(empty($_POST['g-recaptcha-response']))
 {
  $captcha_error = 'Captcha is required';
  header("Location: https://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/4");
	exit;
 }
 else
 {
  $secret_key = '6Lf4mcIZAAAAAPRqWGUdz8pbOPj4TC0cO6jWIDjX';

  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

  $response_data = json_decode($response);

  if($response_data->success)
  {
   $captcha_error = 'Captcha verification success';

  }
 }

		if ($count == 0) {
			$sql = "INSERT INTO $table SET 
		 								name = '".$fio."',
										 phone = '".$phone."',
										 time_created = NOW(),
										 email = '".$email."',
										 status = 1,
		 								password = MD5('".$password."')";
			db_query($sql);
			
				
			$_SESSION['id'] = db_insert_id();
			$_SESSION['type'] = $type;
			$_SESSION['email'] = $email;
			
			if ($type == 1) $for_type = 0;
			if ($type == 2) $for_type = 0;
			if ($type == 3) $for_type = 2;
			
			noticeUsers( $_SESSION['id'], $_SESSION['type'], 0, $for_type, "Зарегестрирован новый пользователь", "Пользователь ".$fio." зарегестрирован", 0, 0, 'reg');

			
			header("Location: http://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$link);
			exit;
		} else {
			header("Location: http://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/2");
			exit;
		}
	} else {			
		if (isset($_GET['item_id'])) {
			switch ($_GET['item_id']) {
				case 1: $tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>'.showResult(getval("MSG_REQUIRED_FIELDS").'</strong>			
			</div>' , 'result_error')); break;
				case 2: $tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>'.showResult(getval("STR_USER_EXIST_TITLE").'</strong>			
			</div>' , 'result_error')); break;
				case 3: $tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>'.showResult(getval("STR_SMS_ERROR_TITLE").'</strong>			
			</div>' , 'result_error')); break;
			case 4:  $tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Капча обязательна</strong>			
			</div>', 'result_error');  break;
			case 5:  $tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Капча не правильна</strong>			
			</div>', 'result_error');  break;
				default: $tpl->assign("RESULT_MESSAGE", '');
			}
		} else {
			$tpl->assign("RESULT_MESSAGE", '');
		}	
	}
	
	$tpl->parse(strtoupper($moduleName), $moduleName);
?>