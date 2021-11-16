<?php

$moduleName = "admin_form_nir_types";
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
if (isset($_POST['addNIRWorkTypeSend'])) {
	$NIR = cleanStr($_POST['NIR']);

	$sql = "INSERT INTO module_nir_work_type SET time_created = NOW(), name = '" . $NIR . "', status = 1";
	db_query($sql);

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
	$newpassword = cleanStr($_POST['newpassword']);
	$user_data = db_get_data("SELECT * FROM module_users WHERE id =" . $user_id);
	$result =  db_query("UPDATE module_users SET password = '" . $newpassword . "' WHERE id = " . $user_id);

	$_SESSION['username'] = $user_data['username'];
	$_SESSION['password'] = $newpassword;
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
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Данные успешно добавлены</div>', 'result_error');
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

	$first_result = "SELECT * FROM module_nir_work_type";

	$full_result = $first_result;
	$result = db_query($full_result);
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("NIR_SETTING_ROWS");
		while ($row = db_fetch_array($result)) {
			$index++;
			$tpl->assign("ID", $index);
			$tpl->assign("NAME_NIR", $row['name']);

			$tpl->assign("TIME_CREATED", date("d.m.Y", strtotime($row['time_created'])));

			if ($row['status'] == 2) {
				$status = '<span class="badge badge-danger">INACTIVE</span></td>';
				$action = '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="changeNIRStatus(' . $row['id'] . ',1)" data-original-title="Активировать"><i class="fa fa-check"></i> ON</a>';
			} else {
				$status = '<span class="badge badge-success">ACTIVE</span></td>';
				$action = '<a class="btn btn-warning btn-sm text-white" data-toggle="tooltip" onclick="changeNIRStatus(' . $row['id'] . ',2)" data-original-title="Деактивировать"><i class="fa fa-times"></i> OFF</a>';
			}
			// $action .= ' <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" onclick="editNIR(' . $row['id'] . ')" data-original-title="Редактировать"><i class="fa fa-trash"></i> EDIT</a>';

			$action .= ' <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteNIR(' . $row['id'] . ')" data-original-title="Удалить"><i class="fa fa-trash"></i> DELETE</a>';

			$tpl->assign("STATUS", $status);
			$tpl->assign("ACTION", $action);

			$tpl->parse("NIR_SETTING_ROWS", "." . $moduleName . "row");
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
	// }
	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/home");
	exit;
}
