<?php
	$moduleName = "forgot_password";
	$prefix = "modules/" . $moduleName . "/";
	
	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
			$moduleName . "card_spec" => $prefix . "card_spec.tpl",
		));

	# VARS #########################################################################################	
	
	$user_id = $_SESSION['id'];	

	# MAIN #########################################################################################
	if(isset($_POST['send'])){
		$password = cleanStr($_POST['password']);
		$phone = intval($_POST['phone']);
		$user_type = intval($_POST['type_user']);
		
		if ($user_type == 1) {
			$table = 'module_ucs';
			$link = 'panel_uk';
		}

		if ($user_type == 2) {
			$table = 'module_osi';
			$link = 'panel_osi';
		}

		if ($user_type == 3) {
			$table = 'module_citizens';
			$link = 'cabinet_citizen';
		}
		if ($user_type == 5) {
			$table = 'module_specialists';
			$link = 'cabinet_specialist';
		}
		$count = db_table_count($table, " phone = ".$phone." ");

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
			header("Location: https://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/2");
			exit;
			
		}else{
			$sql = "UPDATE $table
			SET password = MD5('".$password."')
			WHERE phone = ".$phone;				 
			db_query($sql);
			$user_name = db_get_data("SELECT * FROM $table WHERE phone = " . $phone);

			$_SESSION['id'] = $user_name['id'];
			$_SESSION['type'] = $user_type;
			$_SESSION['phone'] = $phone;

			header("Location: https://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$link);
			exit;
		}
	}

	
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
			default: $tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}	
	
		$tpl->parse(strtoupper($moduleName), $moduleName);
