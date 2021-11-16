<?php

$moduleName = "users";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
	$moduleName . "inner" => $prefix . "inner.tpl",
	$moduleName . "inner_item" => $prefix . "inner_item.tpl",
	$moduleName . "nodata" => $prefix . "nodata.tpl",
));

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');

$docTypes = array('docx', 'txt', 'rtf', 'pdf', 'xls', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

$newFileName1 = '';
$newFileName2 = '';
$newFileName3 = '';
$newFileName4 = '';

$newDocName1 = '';
#VARIABLES
$osi_ids = '';
#FUNCTION #####################################################

# POST ##########################################################################
if (isset($_POST['addUserSend'])) {
	$fio = trim(cleanStr($_POST['fio']));
	$login = cleanStr($_POST['login']);
	$password = md5(cleanStr($_POST['password']));

	$user_type = intval($_POST['user_type']);
	$univer_id = intval($_POST['univer_id']);
	$facultet_id = intval($_POST['facultet_id']);
	
	$dolzhnost = cleanStr($_POST['dolzhnost']);
	$stepen = cleanStr($_POST['stepen']);

	$result = db_query("SELECT * FROM module_users WHERE `username` = '" . $login . "' ");
	if (db_num_rows($result) > 0) {
		//Если такой аккаунт найден нужно сообщить что такой аккаунт уже создан используйте другой
		$_SESSION['username'] = $login;
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/2");
		exit;
	} else {
		$sql = "INSERT INTO module_users SET time_created = NOW(), username = '" . $login . "', fio = '" . $fio . "', password = '" . $password . "', type = '" . $user_type . "', dolzhnost = '" . $dolzhnost . "', stepen = '" . $stepen . "', facultet_id = '" . $facultet_id . "', status = 1";
		db_query($sql);
	}
	$user_data = db_get_data("SELECT * FROM module_users WHERE id =" . db_insert_id());
	$_SESSION['username'] = $user_data['username'];

	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
	exit();
}

if (isset($_POST['updateUserSend'])) {
	$user_id = trim(cleanStr($_POST['user_id']));
	$fio = cleanStr($_POST['fio']);
	$login = cleanStr($_POST['login']);
	$phone_number = cleanStr($_POST['phone_number']);
	$adress = cleanStr($_POST['adress']);
	$email = cleanStr($_POST['email']);

	$user_type = intval($_POST['user_type']);
	$univer_id = intval($_POST['univer_id']);
	$facultet_id = intval($_POST['facultet_id']);

	$result =  db_query("UPDATE module_users SET fio = '" . $fio . "', username = '" . $login . "',phone_number = '" . $phone_number . "',adress = '" . $adress . "',email = '" . $email . "',type = '" . $user_type . "',facultet_id = '" . $facultet_id . "'  WHERE id = " . $user_id);
	$_SESSION['username'] = $login;
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/3");
	exit();
}


if (isset($_POST['changePassUserSend'])) {
	$user_id = cleanStr($_POST['user_id']);
	$newpassword = md5(cleanStr($_POST['newpassword']));
	$user_data = db_get_data("SELECT * FROM module_users WHERE id =" . $user_id);
	$result =  db_query("UPDATE module_users SET password = '" . $newpassword . "' WHERE id = " . $user_id);

	$_SESSION['username'] = $user_data['username'];
	$_SESSION['password'] = $_POST['newpassword'];
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/4");
	exit();
}

# MAIN ##########################################################################

if (isset($_SESSION['id'])) {
	// if (isset($_GET['item_id'])) { //Если в ссылке есть ID ВНУТРЕННАЯ ССЫЛКА

	// } else { // ВНЕШНАЯ СТРАНИЦА

	if (isset($_GET['item_id'])) {
		switch ($_GET['item_id']) {
			case 1:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно добавили пользователя ' . cleanStr($_SESSION['username']) . '</div>', 'result_error');
				break;
			case 2:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Такой пользователь ' . cleanStr($_SESSION['username']) . ' уже существует пожалуйста используйте другое имя</div>', 'result_error');
				break;
			case 3:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы обновили данные пользователя ' . cleanStr($_SESSION['username']) . '</div>', 'result_error');
				break;
			case 4:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно сменили пароль пользователю ' . $_SESSION['username'] . ' на ' . cleanStr($_SESSION['password']) . '</div>', 'result_error');
				break;
			default:
				$tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	$first_result = "SELECT * FROM module_users";

	// if (isset($_POST['ex'])) { //Фильр бюджета по годам
	// 	if (isset($_POST['yearFilter'])) {
	// 		if (intval($_POST['yearFilter']) > 0) {
	// 			$full_result = $first_result . " AND `year` = '" . intval($_POST['yearFilter']) . "' ORDER BY time_create DESC";

	// 			$tpl->assign("FILTER" . $_POST['yearFilter'], "selected");
	// 		} else {
	// 			$full_result = $first_result . " ORDER BY time_create DESC";
	// 		}
	// 	}
	// 	if (isset($_POST['osiFilter'])) {

	// 		if (intval($_POST['osiFilter']) > 0) {
	// 			$full_result = $first_result . " AND osi_id = '" . intval($_POST['osiFilter']) . "' ORDER BY time_create DESC";
	// 		} else {

	// 			$full_result = $first_result . " ORDER BY time_create DESC";
	// 		}
	// 	}
	// } else {
	// 	$full_result = $first_result . " ORDER BY time_create DESC";
	// }

	$full_result = $first_result;
	$result = db_query($full_result);
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("USER_ROWS");
		while ($row = db_fetch_array($result)) {
			$index++;
			$roles_name = db_get_data("SELECT name FROM module_roles WHERE id = " . $row['type'], "name");

			$tpl->assign("ID", $row['id']);
			$tpl->assign("FIO", $row['fio']);
			$tpl->assign("USERNAME", $row['username']);

			$tpl->assign("ROLE", $roles_name);

			$tpl->assign("TIME_CREATED", date("d.m.Y", strtotime($row['time_created'])));
			if ($row['status'] == 2) {
				$status = '<span class="badge badge-danger">INACTIVE</span></td>';
				$action = '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="changeUserStatus(' . $row['id'] . ',1)" data-original-title="Активировать"><i class="fa fa-check"></i> ON</a>';
			} else {
				$status = '<span class="badge badge-success">ACTIVE</span></td>';
				$action = '<a class="btn btn-warning btn-sm text-white" data-toggle="tooltip" onclick="changeUserStatus(' . $row['id'] . ',2)" data-original-title="Деактивировать"><i class="fa fa-times"></i> OFF</a>';
			}
			$action .= ' <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" onclick="openSettingUser(' . $row['id'] . ')" data-original-title="Настроить"><i class="fa fa-times"></i> SETTINGS</a>';
			$action .= ' <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" onclick="changePassUser(' . $row['id'] . ')" data-original-title="Изменить пароль"><i class="fa fa-times"></i> CHANGE PASS</a>';
			$action .= ' <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteUser(' . $row['id'] . ')" data-original-title="Удалить"><i class="fa fa-trash"></i> DELETE</a>';

			$tpl->assign("STATUS", $status);
			$tpl->assign("ACTION", $action);

			$tpl->parse("USER_ROWS", "." . $moduleName . "row");
		}
	} else {
		$tpl->assign("DISPLAY", 'style="display:none;"');
		$tpl->parse("NODATA", "." . $moduleName . "nodata");
	}
	// }

	$user_types = db_get_array("SELECT * FROM module_roles", "id", "name");
	assignList("USER_TYPE_LIST", $user_types);

	$years = db_get_array("SELECT * FROM module_years", "name", "name");
	assignList("YEAR_LIST", $years);

	$universities = db_get_array("SELECT * FROM module_universities", "id", "name");
	assignList("UNIVER_LIST", $universities);
	
	$stepens = db_get_array("SELECT * FROM module_stepens ORDER by NAME ASC", "id", "name");
	assignList("STEPEN_LIST", $stepens);
	
	$dolzhnosts = db_get_array("SELECT * FROM module_dolzhnosts ORDER by id ASC", "id", "name");
	assignList("DOLZHNOST_LIST", $dolzhnosts);

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/home");
	exit;
}
