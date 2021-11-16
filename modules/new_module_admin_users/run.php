<?php

$moduleName = "new_module_admin_users";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
	$moduleName . "inner" => $prefix . "inner.tpl",
	$moduleName . "row_inner" => $prefix . "row_inner.tpl",
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
	$login = trim(cleanStr($_POST['login']));
	$password = md5(cleanStr($_POST['password']));

	$user_type_id = intval($_POST['user_type']);
	$stepen = cleanStr($_POST['stepen']);

	$result = db_query("SELECT * FROM new_module_users WHERE `username` = '" . $login . "' ");
	if (db_num_rows($result) > 0) {
		//Если такой аккаунт найден нужно сообщить что такой аккаунт уже создан используйте другой название
		$_SESSION['username'] = $login;
		$_SESSION['data_status'] = 2;
		// Защита для сохранения ожной записи
		unset($_POST);
		$_POST = array();
		// Защита для сохранения ожной записи
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
		exit;
	} else {
		$sql = "INSERT INTO new_module_users SET time_created = NOW(), username = '" . $login . "', fio = '" . $fio . "', password = '" . $password . "', user_type_id = '" . $user_type_id . "', stepen = '" . $stepen . "'";
		db_query($sql);
		$_SESSION['username'] = $login;
	}
	// Защита для сохранения ложной записи
	unset($_POST);
	$_POST = array();
	// Защита для сохранения ложной записи
	$_SESSION['data_status'] = 1;
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
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

	$_SESSION['data_status'] = 3;
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
	// Защита для сохранения ожной записи
	unset($_POST);
	$_POST = array();
	// Защита для сохранения ожной записи

	exit();
}


if (isset($_POST['changePassUserSend'])) {
	$user_id = cleanStr($_POST['user_id']);
	$newpassword = md5(cleanStr($_POST['newpassword']));
	$user_data = db_get_data("SELECT * FROM new_module_users WHERE id =" . $user_id);
	$result =  db_query("UPDATE new_module_users SET password = '" . $newpassword . "' WHERE id = " . $user_id);

	$_SESSION['username'] = $user_data['username'];
	$_SESSION['password'] = $_POST['newpassword'];

	$_SESSION['data_status'] = 4;
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
	exit();
}



# INNER POST ###################################################################

if (isset($_POST['addDepartmentSend'])) {

	$userID = intval($_POST['userID']);
	$dolzhnost = intval($_POST['dolzhnost']);
	$department_id = intval($_POST['department_id']);
	$stavka = cleanStr($_POST['stavka']);

	$result = db_query("SELECT * FROM new_module_many_departments_and_users WHERE `department_id` = '" . $department_id . "' AND `new_user_id` = '" . $userID . "'");
	if (db_num_rows($result) > 0) {
		//Если такой аккаунт найден нужно сообщить что такой аккаунт уже создан используйте другой название
		$_SESSION['username'] = $login;

		$_SESSION['data_status_inner'] = 2;
		// Защита для сохранения ожной записи
		unset($_POST);
		$_POST = array();
		// Защита для сохранения ожной записи
		// echo "FIND";
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] ."/". $_GET['item_id']);
		exit;
	} else {
		$sql = "INSERT INTO new_module_many_departments_and_users SET department_id = '" . $department_id . "', dolzhnost_id = '" . $dolzhnost . "', stavka = '" . $stavka . "', new_user_id = '" . $userID . "'";
		db_query($sql);
		$_SESSION['username'] = $login;
	}
	// Защита для сохранения ложной записи
	unset($_POST);
	$_POST = array();
	// Защита для сохранения ложной записи
	$_SESSION['data_status_inner'] = 1;
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] ."/". $_GET['item_id']);
	// echo "OK";
	exit();
}

# MAIN ##########################################################################

if (isset($_SESSION['id'])) {
	// if (isset($_GET['item_id'])) { //Если в ссылке есть ID ВНУТРЕННАЯ ССЫЛКА

	// } else { // ВНЕШНАЯ СТРАНИЦА


	if (isset($_GET['item_id'])) { //Внутренная страница

			if (isset($_SESSION['data_status_inner'])) {
				switch ($_SESSION['data_status_inner']) {
					case 1:
						$tpl->assign("RESULT_MESSAGE_INNER", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно добавили департамент</div>', 'result_error');
						break;
					case 2:
						$tpl->assign("RESULT_MESSAGE_INNER", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>В таком департаменте пользователь уже работает</div>', 'result_error');
						break;
					default:
						$tpl->assign("RESULT_MESSAGE_INNER", '');
				}
				unset($_SESSION['data_status_inner']);
			} else {
				$tpl->assign("RESULT_MESSAGE_INNER", '');
			}


			$item_id = intval($_GET['item_id']);
			$user_data = db_get_data("SELECT id, fio FROM new_module_users WHERE id = " . $item_id);
			$table= "new_module_many_departments_and_users";
			// new_module_indicators

			$tpl->assign("USER_ID", $user_data['id']);
			$tpl->assign("USER_FIO", $user_data['fio']);
			$tpl->assign("TABLE_INNER_NAME", $indicator_table_name);
			$tpl->assign("TABLE_INNER", $table);
			$result = db_query("SELECT * FROM $table WHERE new_user_id = ".$item_id);
			$count = db_num_rows($result);
			if ($count > 0) {
				while ($row = db_fetch_array($result)) {
					$tpl->assign("GENERAL_ID", $row['id']);
					$department_name = db_get_data("SELECT name FROM new_module_departments WHERE id = " . $row['department_id'], "name");
					$tpl->assign("DEPARTMENT", $department_name);
					$tpl->assign("STAVKA", $row['stavka']);
					$dolzhnost_name = db_get_data("SELECT name FROM new_module_dolzhnosts WHERE id = " . $row['dolzhnost_id'], "name");
					$tpl->assign("DOLZHNOST", $dolzhnost_name);
					$action = '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';

					$tpl->assign("ACTION", $action);
					$tpl->parse("ROWS_INNER", ".".$moduleName . "row_inner");
				}
			}else{
				$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
				$tpl->parse("NODATA", ".".$moduleName . "nodata");
			}

			$universities = db_get_array("SELECT * FROM new_module_universities", "id", "name");
			assignList("NEW_UNIVER_LIST", $universities);

			$dolzhnosts = db_get_array("SELECT * FROM new_module_dolzhnosts ORDER by id ASC", "id", "name");
			assignList("NEW_DOLZHNOST_LIST", $dolzhnosts);

				$tpl->parse(strtoupper($moduleName), ".".$moduleName."inner");

	} else {
		if (isset($_SESSION['data_status'])) {
			switch ($_SESSION['data_status']) {
				case 1:
					$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно добавили пользователя ' . cleanStr($_SESSION['username']) . '</div>', 'result_error');
					break;
				case 2:
					$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Такой пользователь ' . cleanStr($_SESSION['username']) . ' уже существует пожалуйста попробуйте зарегестрировать другой логин</div>', 'result_error');
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
		unset($_SESSION['data_status']);
		} else {
			$tpl->assign("RESULT_MESSAGE", '');
		}

			$table = "new_module_users";
			$first_result = "SELECT * FROM $table";

			$full_result = $first_result;
			$result = db_query($full_result);
			if (db_num_rows($result) > 0) {
				$tpl->CLEAR("USER_ROWS");
				while ($row = db_fetch_array($result)) {
					$index++;
					$roles_name = db_get_data("SELECT value FROM new_module_user_types WHERE id = " . $row['user_type_id'], "value");

					$tpl->assign("ID", $row['id']);
					$tpl->assign("FIO", $row['fio']);
					$tpl->assign("USERNAME", $row['username']);

					$tpl->assign("ROLE", $roles_name);

					$tpl->assign("TIME_CREATED", date("d.m.Y", strtotime($row['time_created'])));
					if ($row['status'] == 2) {
						$status = '<span class="badge badge-danger">INACTIVE</span></td>';
						$action = '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="newChangeUserStatus(' . $row['id'] . ',1)" data-original-title="'.getval("STR_ACTIVE").'"><i class="fa fa-check"></i> ON</a>';
					} else {
						$status = '<span class="badge badge-success">ACTIVE</span></td>';
						$action = '<a class="btn btn-warning btn-sm text-white" data-toggle="tooltip" onclick="newChangeUserStatus(' . $row['id'] . ',2)" data-original-title="'.getval("STR_DEACTIVE").'"><i class="fa fa-times"></i> OFF</a>';
					}
					// $action .= ' <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" onclick="openSettingUser(' . $row['id'] . ')" data-original-title="Настроить"><i class="fa fa-times"></i> SETTINGS</a>';
					$action .= ' <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" onclick="changePassUser(' . $row['id'] . ')" data-original-title="'.getval("STR_CHANGE_PASS").'"><i class="fa fa-edit"></i> '.getval("STR_CHANGE_PASS").'</a>';
					$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
					$action .= ' <a class="btn btn-orange btn-sm text-white" data-toggle="tooltip" href="/ru/users/' . $row['id'] . '" data-original-title="'.getval("STR_WORK_DEPARTMENT").'"><i class="fa fa-show"></i> '.getval("STR_WORK_DEPARTMENT").'</a>';

					// $departments
					$departments = null;
					$result2 = db_query("SELECT * FROM new_module_many_departments_and_users WHERE `new_user_id` = '" . $row['id'] . "'");
					if (db_num_rows($result2) > 0) {
						while ($row2 = db_fetch_array($result2)) {
							$departments .= db_get_data("SELECT name FROM new_module_departments WHERE id = " . $row2['department_id'], "name") . "</br><b>Ставка: ". $row2['stavka']. "</b></br>";
						}
					}else{
						$departments .= '<span class="badge badge-danger">Не добавлены департаменты</span></td>';
					}
					$tpl->assign("DEPARTMENTS", $departments);
					$tpl->assign("STATUS", $status);
					$tpl->assign("ACTION", $action);

					$tpl->parse("USER_ROWS", "." . $moduleName . "row");
				}
			} else {
				$tpl->assign("DISPLAY", 'style="display:none;"');
				$tpl->parse("NODATA", "." . $moduleName . "nodata");
			}


			$user_types = db_get_array("SELECT * FROM new_module_user_types", "id", "value");
			assignList("NEW_USER_TYPE_LIST", $user_types);



			$stepens = db_get_array("SELECT * FROM new_module_stepens ORDER by NAME ASC", "id", "name");
			assignList("NEW_STEPEN_LIST", $stepens);


			$tpl->parse(strtoupper($moduleName), $moduleName);
	}
} else {
	header("Location: /" . LANG_INDEX . "/home");
	exit;
}
