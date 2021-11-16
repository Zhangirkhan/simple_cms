<?php
define('PASSWORD_DEFAULT', "2y");
$moduleName = "login_form";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
));

# SETTINGS #####################################################################################

$type = 0;
$table = '';

$usr_login = '';
$usr_passw = '';
$save = '';
# MAIN #########################################################################################

if (isset($_POST['send'])) {

	$login = cleanStr($_POST['login']);
	$password = cleanStr($_POST['password']);
	$password = md5($password);

	//echo  "SELECT * FROM module_users WHERE username = '" . $login . "' AND password = '" . $password . "'  LIMIT 1";

	$result = db_query("SELECT * FROM module_users WHERE username = '" . $login . "' AND password = '" . $password . "'  LIMIT 1");

	// 		if(empty($_POST['g-recaptcha-response']))
	//  {
	//   $captcha_error = 'Captcha is required';
	//   header("Location: https://".$_SERVER['SERVER_NAME']."/".LANG_INDEX."/".$_PAGE['mod_rewrite']."/2");
	// 	exit;
	//  }
	//  else
	//  {
	//   $secret_key = '6Ldv2bcUAAAAAFXUKdLW_qljFd9FpxNguf06DHhp';
	//   $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
	//   $response_data = json_decode($response);
	//   if($response_data->success)
	//   {
	//    $captcha_error = 'Captcha verification failed';
	//   }
	//  }


	if (db_num_rows($result) > 0) {
		$row = db_fetch_object($result);

		$_SESSION['id'] = $row->id;
		$_SESSION['usename'] = $row->username;
		$_SESSION['type'] = $row->type;

		//print_r($_SESSION);
		// Сохраняем логин и пароль в куках, удаляем если не отметили "запомнить"
		if (isset($_POST['chk_save'])) {
			$cookie_value = $login . "|" . md5($password) . "|" . $_SERVER['HTTP_HOST'];
			$cookie_value = crypt_string($cookie_value);
			setcookie("elearning_kazgasa", $cookie_value, time() + 60 * 60 * 24 * 30, "", $_SERVER['HTTP_HOST']);
		} else {
			if (isset($_COOKIE['elearning_kazgasa'])) {
				$cookie_value = "";
				setcookie("elearning_kazgasa", $cookie_value, 0, "", $_SERVER['HTTP_HOST']);
			}
		}

		if($_SESSION['type'] == 1){
			header("Location: https://" . $_SERVER['SERVER_NAME'] . "/" . LANG_INDEX . "/admin_dashboard");
		exit;
		}else if($_SESSION['type'] == 3){
			header("Location: https://" . $_SERVER['SERVER_NAME'] . "/" . LANG_INDEX . "/filler_dashboard");
		exit;
		}else if($_SESSION['type'] == 4){
				header("Location: https://" . $_SERVER['SERVER_NAME'] . "/" . LANG_INDEX . "/cabinet_pps");
		exit;
		}else{
				header("Location: https://" . $_SERVER['SERVER_NAME'] . "/" . LANG_INDEX . "/dashboard");
		exit;
		}




	} else {
		header("Location: https://" . $_SERVER['SERVER_NAME'] . "/" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
		exit;
	}
} else {
	if (isset($_GET['item_id'])) {
		switch ($_GET['item_id']) {
			case 1:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>' . showResult(getval("MSG_LOGIN_ERROR_TITLE") . '</strong>
			</div>', 'result_error'));
				break;
			case 2:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Капча обязательна</strong>
			</div>', 'result_error');
				break;
			case 3:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Капча не правильна</strong>
			</div>', 'result_error');
				break;
			default:
				$tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	if (isset($_COOKIE['elearning_kazgasa'])) {
		$str = crypt_string($_COOKIE['elearning_kazgasa'], false);
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

$tpl->parse(strtoupper($moduleName), $moduleName);
