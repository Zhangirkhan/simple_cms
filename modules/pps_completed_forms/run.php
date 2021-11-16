<?php

$moduleName = "pps_completed_forms";
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
	$fio = cleanStr($_POST['fio']);
	$login = cleanStr($_POST['login']);
	$password = md5(cleanStr($_POST['password']));

	$user_type = intval($_POST['user_type']);
	$univer_id = intval($_POST['univer_id']);
	$facultet_id = intval($_POST['facultet_id']);

	$result = db_query("SELECT * FROM module_users WHERE `username` = '" . $login . "' ");
	if (db_num_rows($result) > 0) {
		//Если такой аккаунт найден нужно сообщить что такой аккаунт уже создан используйте другой
		$_SESSION['username'] = $login;
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/2");
		exit;
	} else {
		$sql = "INSERT INTO module_users SET time_created = NOW(), username = '" . $login . "', fio = '" . $fio . "', password = '" . $password . "', type = '" . $user_type . "', facultet_id = '" . $facultet_id . "', status = 1";
		db_query($sql);
	}
	$user_data = db_get_data("SELECT * FROM module_users WHERE id =" . db_insert_id());
	$_SESSION['username'] = $user_data['username'];

	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
	exit();
}

if (isset($_POST['updateUserSend'])) {
	$user_id = cleanStr($_POST['user_id']);
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
	//Сделать глобальным информацию о пользователе
	$user_info = db_get_data("SELECT * FROM module_users WHERE id = " . $_SESSION['id']);

	//Доступы для сдачи формы
	$accesses = db_query("SELECT * FROM module_accesses WHERE facultet_id = " . $user_info['facultet_id'] . " ORDER by time_end DESC");
	while ($access = db_fetch_array($accesses)) {
		$accesses_ids .=  $access['form_id'] . ',';
	}
	$accesses_ids = mb_substr($accesses_ids, 0, -1);

	//Выбираем все незаполненные формы проверя заполнял ли он информацию
	$not_inserted_tables = null;
	$result = db_query("SELECT * FROM module_table_names WHERE id IN ($accesses_ids)");
	if (db_num_rows($result) > 0) {
		while ($row = db_fetch_array($result)) {
			$user_data_inserted = db_query("SELECT * FROM " . $row['table_name'] . " WHERE user_type = 4 AND user_id = " . $_SESSION['id']);
			if (db_num_rows($user_data_inserted) > 0) {
				$not_inserted_tables .= $row['id'] . ',';
			} else {
			}
		}
	}
	$not_inserted_tables = mb_substr($not_inserted_tables, 0, -1);



	// if (isset($_GET['item_id'])) {
	// 	switch ($_GET['item_id']) {
	// 		case 1:
	// 			$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно добавили пользователя ' . cleanStr($_SESSION['username']) . '</div>', 'result_error');
	// 			break;
	// 		case 2:
	// 			$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Такой пользователь ' . cleanStr($_SESSION['username']) . ' уже существует пожалуйста используйте другое имя</div>', 'result_error');
	// 			break;
	// 		case 3:
	// 			$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы обновили данные пользователя ' . cleanStr($_SESSION['username']) . '</div>', 'result_error');
	// 			break;
	// 		case 4:
	// 			$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно сменили пароль пользователю ' . $_SESSION['username'] . ' на ' . cleanStr($_SESSION['password']) . '</div>', 'result_error');
	// 			break;
	// 		default:
	// 			$tpl->assign("RESULT_MESSAGE", '');
	// 	}
	// } else {
	// 	$tpl->assign("RESULT_MESSAGE", '');
	// }

	$first_result = "SELECT * FROM module_accesses WHERE form_id IN ($not_inserted_tables)";

	$full_result = $first_result;
	$result = db_query($full_result);
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("INSERTED_ROWS");
		while ($row = db_fetch_array($result)) {
			$index++;

			$form_info = db_get_data("SELECT * FROM module_table_names WHERE id = " . $row['form_id']);
			$category_info = db_get_data("SELECT name FROM module_categories WHERE id = " . $form_info['category_id'], "name");
			$access_form = db_get_data("SELECT name FROM module_roles WHERE id = " . $row['type'], "name");
			//Количество добавленных данных
			$record_count = db_table_count($form_info['table_name'], " user_type = 3 AND user_id = " . $_SESSION['id']);

			$tpl->assign("ID", $row['id']);
			$tpl->assign("CATEGORY", $category_info);
			$tpl->assign("FORM_NAME", $form_info['form_name']);
			$tpl->assign("FORM_LAST_ADDED_TIME", $form_info['form_name']);
			$tpl->assign("FORM_ADDED_RECORDS_COUNT", $record_count);
			$tpl->assign("FORM_ACCESS",  '<span class="badge badge-danger">' . date("d.m.Y", strtotime($row['time_end'])) . '</span></td>');
			$action = null;
			$action .= ' <a class="btn btn-success btn-sm text-white" href="/ru/pps_single_form/' . $form_info['id'] . '" data-original-title="Заполнить"><i class="fa fa-plus"></i> ADD RECORD</a>';

			$tpl->assign("ACTION", $action);
			$tpl->parse("INSERTED_ROWS", "." . $moduleName . "row");
		}
	} else {
		$tpl->assign("DISPLAY", 'style="display:none;"');
		$tpl->parse("NODATA", "." . $moduleName . "nodata");
	}
	// }

	// $user_types = db_get_array("SELECT * FROM module_roles", "id", "name");
	// assignList("USER_TYPE_LIST", $user_types);

	// $years = db_get_array("SELECT * FROM module_years", "name", "name");
	// assignList("YEAR_LIST", $years);

	// $universities = db_get_array("SELECT * FROM module_universities", "id", "name");
	// assignList("UNIVER_LIST", $universities);

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/home");
	exit;
}
