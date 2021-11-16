<?php
$moduleName = "cabinet";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "lc_science" => $prefix . "lc_science.tpl",
	$moduleName . "lc_specialist" => $prefix . "lc_specialist.tpl",
	$moduleName . "lc_manager_uc" => $prefix . "lc_manager_uc.tpl",
	$moduleName . "lc_osi" => $prefix . "lc_osi.tpl",
	$moduleName . "lc_admin" => $prefix . "lc_admin.tpl",
	$moduleName . "lc_pps" => $prefix . "lc_pps.tpl",
	$moduleName . "password" => $prefix . "password.tpl",
	$moduleName . "reviews" => $prefix . "reviews.tpl",
	$moduleName . "gallery" => $prefix . "gallery.tpl",
	$moduleName . "image" => $prefix . "image.tpl",
	$moduleName . "doc" => $prefix . "doc.tpl",
	$moduleName . "nodata" => $prefix . "nodata.tpl",
));

# SETTINGS ##############################################################################

$cab_tmp = '';

if ($_SESSION['type'] == 1) $cab_tmp = 'lc_admin';
if ($_SESSION['type'] == 2) $cab_tmp = 'lc_osi';
if ($_SESSION['type'] == 3) $cab_tmp = 'lc_science';
if ($_SESSION['type'] == 4) $cab_tmp = 'lc_pps';
if ($_SESSION['type'] == 5) $cab_tmp = 'lc_specialist';

if ($_SESSION['type'] == 1) $link = 'cabinet_admin';
if ($_SESSION['type'] == 2) $link = 'cabinet_osi';
if ($_SESSION['type'] == 3) $link = 'cabinet_science';
if ($_SESSION['type'] == 4) $link = 'cabinet_pps';
if ($_SESSION['type'] == 5) $link = 'cabinet_specialist';

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
$docTypes = array('docx', 'txt', 'rtf', 'pdf', 'xls', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

# POST ##################################################################################

if (isset($_POST['docs_send'])) {
	$title = cleanStr($_POST['title']);

	$newFileName1 = '';
	$file_id = 0;

	if (!empty($_FILES['file'])) {
		$fileParts = pathinfo($_FILES['file']['name']);
		if (in_array($fileParts['extension'], $docTypes)) {
			$filename = $_FILES['file']['name'];
			$tmp_filename = $_FILES['file']['tmp_name'];
			$newFileName1 = time() . "-1." . $fileParts['extension'];

			$ret = copy($tmp_filename, "./files/" . $newFileName1);
		} else {
			header("Location: /" . LANG_INDEX . "/" . $link . "/5" . "#tab3");
			exit;
		}
	}

	if ($newFileName1 != "") {
		$sql = "INSERT INTO module_files SET url_files = '" . $newFileName1 . "'";
		db_query($sql);

		$file_id = db_insert_id();
	}

	$sql = "INSERT INTO module_docs SET date = NOW(), title = '" . $title . "', file_id = '" . $file_id . "', user_id = " . $_SESSION['id'] . ", user_type = " . $_SESSION['type'];
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/" . $link . "/1" . "#tab3");
	exit;
}

if (isset($_POST['edit_send'])) {
	$gallery_id = intval($_POST['gallery_id']);
	$title = cleanStr($_POST['title']);

	$sql = "UPDATE module_gallery SET title = '" . $title . "' WHERE id = " . $gallery_id;
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/" . $link . "/1" . "#tab4");
	exit;
}

if (isset($_POST['image_send'])) {
	$album_id = intval($_POST['album_id']);
	$title = cleanStr($_POST['title']);

	$newFileName1 = '';

	if (!empty($_FILES['file'])) {
		$fileParts = pathinfo($_FILES['file']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['file']['name'];
			$tmp_filename = $_FILES['file']['tmp_name'];
			$newFileName1 = time() . "-1." . $fileParts['extension'];

			$ret = copy($tmp_filename, "./photos/" . $newFileName1);
		}
	}

	$sql = "INSERT INTO module_photos SET url_photos = '" . $newFileName1 . "'";
	db_query($sql);

	$image_id = db_insert_id();

	$sql = "INSERT INTO module_gallery_images SET album_id = '" . $album_id . "', title = '" . $title . "', image_id = '" . $image_id . "'";
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/" . $link . "/1" . "#tab4");
	exit;
}

if (isset($_POST['gallery_send'])) {
	$title = cleanStr($_POST['title']);

	$sql = "INSERT INTO module_gallery SET title = '" . $title . "', user_id = " . $_SESSION['id'] . ", user_type = " . $_SESSION['type'];
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/" . $link . "/1" . "#tab4");
	exit;
}

if (isset($_POST['change_send'])) {
	if ($_SESSION['type'] == 1) $type = 1;
	if ($_SESSION['type'] == 2) $type = 2;
	if ($_SESSION['type'] == 3) $type = 3;
	if ($_SESSION['type'] == 4) $type = 4;
	if ($_SESSION['type'] == 5) $type = 5;

	$oldPassword = cleanStr($_POST['oldPassword']);
	$newPassword = cleanStr($_POST['newPassword']);
	$reNewPassword = cleanStr($_POST['reNewPassword']);

	$result = db_query("SELECT * FROM module_users WHERE id = '" . $_SESSION['id'] . "' AND password = MD5('" . $oldPassword . "') AND type = '".$type."' LIMIT 1");
	if (db_num_rows($result) > 0) {
		if ($newPassword == $reNewPassword) {
			$sql = "UPDATE module_users SET password = MD5('" . $newPassword . "') WHERE id = " . $_SESSION['id']. " AND type = ".$type;
			db_query($sql);

			header("Location: /" . LANG_INDEX . "/" . $link . "/4");
			exit;
		} else {
			header("Location: /" . LANG_INDEX . "/" . $link . "/3");
			exit;
		}
	} else {
		header("Location: /" . LANG_INDEX . "/" . $link . "/2");
		exit;
	}
}

if (isset($_POST['send'])) {
	if ($_SESSION['type'] == 1) {
		$fio = htmlspecialchars($_POST['fio'], ENT_COMPAT);
		$login = cleanStr($_POST['login']);
		$phone_number = cleanStr($_POST['phone_number']);
		$email = cleanStr($_POST['email']);
		$adress = cleanStr($_POST['adress']);
		$user_type = intval($_POST['user_type']);
		$facultet_id = cleanStr($_POST['facultet_id']);

		$newFileName1 = '';

		$sql = "UPDATE module_users SET fio = '" . $fio . "', username = '" . $login . "',phone_number = '" . $phone_number . "',adress = '" . $adress . "',email = '" . $email . "'  WHERE id = " . $_SESSION['id'];
	}

	if ($_SESSION['type'] == 2) {
		$name = htmlspecialchars($_POST['name'], ENT_COMPAT);
		$phone = cleanStr($_POST['phone']);
		$email = cleanStr($_POST['email']);
		$description = cleanStr($_POST['description']);
		$requisites = cleanStr($_POST['requisites']);
		$worktime = cleanStr($_POST['worktime']);
		$director = cleanStr($_POST['director']);
		$newFileName1 = '';

		//Проверка размера файла
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if ($check !== false) {
			$fileParts = pathinfo($_FILES['file']['name']);
			if (in_array($fileParts['extension'], $fileTypes)) {
				$filename = $_FILES['file']['name'];
				$tmp_filename = $_FILES['file']['tmp_name'];
				$newFileName1 = time() . "-1." . $fileParts['extension'];

				$ret = copy($tmp_filename, "./photos/" . $newFileName1);
			}
			$sql = "INSERT INTO module_photos SET url_photos = '" . $newFileName1 . "'";
			db_query($sql);

			$image_id = db_insert_id();
		}

		if ($check !== false) {
			$sql = "UPDATE module_osi SET name = '" . $name . "', phone = '" . $phone . "', email = '" . $email . "', requisites = '" . $requisites . "', description = '" . $description . "', worktime = '" . $worktime . "', director = '" . $director . "', image = '" . $image_id . "' WHERE id = " . $_SESSION['id'];
		} else {
			$sql = "UPDATE module_osi SET name = '" . $name . "', phone = '" . $phone . "', email = '" . $email . "', requisites = '" . $requisites . "', description = '" . $description . "', worktime = '" . $worktime . "', director = '" . $director . "' WHERE id = " . $_SESSION['id'];
		}
	}

	if ($_SESSION['type'] == 3) {
		$fio = htmlspecialchars($_POST['fio'], ENT_COMPAT);
		$login = cleanStr($_POST['login']);
		$phone_number = cleanStr($_POST['phone_number']);
		$email = cleanStr($_POST['email']);
		$adress = cleanStr($_POST['adress']);
		$user_type = intval($_POST['user_type']);
		$facultet_id = cleanStr($_POST['facultet_id']);

		$newFileName1 = '';

		$sql = "UPDATE module_users SET fio = '" . $fio . "',phone_number = '" . $phone_number . "',adress = '" . $adress . "',email = '" . $email . "'  WHERE id = " . $_SESSION['id'];

	}

	if ($_SESSION['type'] == 4) {
		$fio = trim(htmlspecialchars($_POST['fio'], ENT_COMPAT));
		//$login = cleanStr($_POST['login']);
		$phone_number = cleanStr($_POST['phone_number']);
		$email = cleanStr($_POST['email']);
		$adress = cleanStr($_POST['adress']);
		$user_type = intval($_POST['user_type']);
		$facultet_id = cleanStr($_POST['facultet_id']);

        $dolzhnost = cleanStr($_POST['dolzhnost']);
        $nauchnaya_deyatelnost = cleanStr($_POST['nauch_direction']);
        $stepen = cleanStr($_POST['stepen']);

		$newFileName1 = '';

		$sql = "UPDATE module_users SET fio = '" . $fio . "',phone_number = '" . $phone_number . "',adress = '" . $adress . "',email = '" . $email . "', facultet_id = '".$facultet_id."', dolzhnost = '".$dolzhnost."', nauchnaya_deyatelnost = '".$nauchnaya_deyatelnost."', stepen = '".$stepen."'  WHERE id = " . $_SESSION['id'];

	}

	if ($_SESSION['type'] == 5) {
		$name = cleanStr($_POST['name']);
		$phone = cleanStr($_POST['phone']);
		$email = cleanStr($_POST['email']);
		$work_type = intval($_POST['work_type']);

		$newFileName1 = '';
		//Проверка размера файла
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if ($check !== false) {
			$fileParts = pathinfo($_FILES['file']['name']);
			if (in_array($fileParts['extension'], $fileTypes)) {
				$filename = $_FILES['file']['name'];
				$tmp_filename = $_FILES['file']['tmp_name'];
				$newFileName1 = time() . "-1." . $fileParts['extension'];

				$ret = copy($tmp_filename, "./photos/" . $newFileName1);
			}
			$sql = "INSERT INTO module_photos SET url_photos = '" . $newFileName1 . "'";
			db_query($sql);
			$image_id = db_insert_id();
		}

		if ($check !== false) {
			$sql = "UPDATE module_specialists SET name = '" . $name . "', phone = '" . $phone . "', email = '" . $email . "', image = '" . $image_id . "', position_id = '" . $work_type . "' WHERE id = " . $_SESSION['id'];
		} else {
			$sql = "UPDATE module_specialists SET name = '" . $name . "', phone = '" . $phone . "', email = '" . $email . "', position_id = '" . $work_type . "' WHERE id = " . $_SESSION['id'];
		}
	}

	db_query($sql);

	header("Location: /" . LANG_INDEX . "/" . $link . "/1");
	exit;
}

# MAIN ##################################################################################

if (isset($_SESSION['id'])) {
	if (isset($_GET['item_id'])) {
		switch ($_GET['item_id']) {
			case 1:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . showResult(getval("MSG_SAVE_OK_TITLE") . '</div>', 'result_error'));
				break;
			case 2:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . showResult(getval("MSG_WRONG_OLD_PASSWORD_TITLE") . '</div>', 'result_error'));
				break;
			case 3:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . showResult(getval("MSG_WRONG_PASSWORD_TITLE") . '</div>', 'result_error'));
				break;
			case 4:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . showResult(getval("MSG_PASSWOR_OK_TITLE") . '</div>', 'result_error'));
				break;
			case 5:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . showResult(getval("MSG_NOT_ADD_DOCUMENT") . '</div>', 'result_error'));
				break;
			default:
				$tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	if ($_SESSION['type'] == 1) {
		$data = db_get_data("SELECT * FROM module_users WHERE id = " . $_SESSION['id']);

		$city_list = db_get_array("SELECT * FROM module_cities ORDER BY id", "id", "name");
		assignList("CITY_LIST", $city_list, $data['city_id']);

		$WORK_TYPE_LIST = db_get_array("SELECT * FROM module_request_types ORDER BY id", "id", "name");
		assignList("WORK_TYPE_LIST", $WORK_TYPE_LIST, $data['work_type']);

		$tpl->assign("FIO", $data['fio']);
		$tpl->assign("LOGIN", $data['username']);
		$tpl->assign("ADRESS_VALUE", $data['adress']);
		$tpl->assign("EMAIL_VALUE", $data['email']);
		$tpl->assign("PHONE_VALUE", $data['phone_number']);
		$tpl->assign("ADRESS_VALUE", $data['adress']);
		$user_types = db_get_array("SELECT * FROM module_roles", "id", "name");
		assignList("USER_TYPE_LIST", $user_types, $data['type']);

		$facultets = db_get_array("SELECT * FROM module_facultets", "id", "name");
		assignList("FACULTET_LIST", $facultets, $data['facultet_id']);
		$facultet_data = db_get_data("SELECT * FROM module_facultets WHERE id = " . $data['facultet_id']);
		$universities = db_get_array("SELECT * FROM module_universities", "id", "name");

		assignList("UNIVER_LIST", $universities, $facultet_data['universitet_id']);
	}

	if ($_SESSION['type'] == 2) {
		
	}

	if ($_SESSION['type'] == 3) {
		$data = db_get_data("SELECT * FROM module_users WHERE id =  " . $_SESSION['id']);

		$city_list = db_get_array("SELECT * FROM module_cities ORDER BY id", "id", "name");
		assignList("CITY_LIST", $city_list, $data['city_id']);

		$WORK_TYPE_LIST = db_get_array("SELECT * FROM module_request_types ORDER BY id", "id", "name");
		assignList("WORK_TYPE_LIST", $WORK_TYPE_LIST, $data['work_type']);

		$tpl->assign("FIO", $data['fio']);
		$tpl->assign("LOGIN", $data['username']);
		$tpl->assign("ADRESS_VALUE", $data['adress']);
		$tpl->assign("EMAIL_VALUE", $data['email']);
		$tpl->assign("PHONE_VALUE", $data['phone_number']);
		$tpl->assign("ADRESS_VALUE", $data['adress']);
		$user_types = db_get_array("SELECT * FROM module_roles", "id", "name");
		assignList("USER_TYPE_LIST", $user_types, $data['type']);

		$facultets = db_get_array("SELECT * FROM module_facultets", "id", "name");
		assignList("FACULTET_LIST", $facultets, $data['facultet_id']);
		$facultet_data = db_get_data("SELECT * FROM module_facultets WHERE id = " . $data['facultet_id']);
		$universities = db_get_array("SELECT * FROM module_universities", "id", "name");

		assignList("UNIVER_LIST", $universities, $facultet_data['universitet_id']);
	}

	if ($_SESSION['type'] == 4) {
		$data = db_get_data("SELECT * FROM module_users WHERE id = " . $_SESSION['id']);

		$city_list = db_get_array("SELECT * FROM module_cities ORDER BY id", "id", "name");
		assignList("CITY_LIST", $city_list, $data['city_id']);

		$WORK_TYPE_LIST = db_get_array("SELECT * FROM module_request_types ORDER BY id", "id", "name");
		assignList("WORK_TYPE_LIST", $WORK_TYPE_LIST, $data['work_type']);

		$tpl->assign("FIO", $data['fio']);
		$tpl->assign("LOGIN", $data['username']);
		$tpl->assign("ADRESS_VALUE", $data['adress']);
		$tpl->assign("EMAIL_VALUE", $data['email']);
		$tpl->assign("PHONE_VALUE", $data['phone_number']);
		$tpl->assign("ADRESS_VALUE", $data['adress']);
		
        $tpl->assign("NAUCH_VALUE", $data['nauchnaya_deyatelnost']);
		
        $tpl->assign("DOLZHNOST", $data['dolzhnost']);
        $tpl->assign("STEPEN", $data['stepen']);
		
		$dolzhnosts = db_get_array("SELECT * FROM module_dolzhnosts ORDER by name ASC", "id", "name");
		assignList("DOLZHNOST_LIST", $dolzhnosts, $data['dolzhnost']);
		$stepens = db_get_array("SELECT * FROM module_stepens", "id", "name");
		assignList("STEPEN_LIST", $stepens, $data['stepen']);

		$user_types = db_get_array("SELECT * FROM module_roles", "id", "name");
		assignList("USER_TYPE_LIST", $user_types, $data['type']);

		$facultets = db_get_array("SELECT * FROM module_facultets", "id", "name");
		assignList("FACULTET_LIST", $facultets, $data['facultet_id']);
		$facultet_data = db_get_data("SELECT * FROM module_facultets WHERE id = " . $data['facultet_id']);
		$universities = db_get_array("SELECT * FROM module_universities", "id", "name");

		assignList("UNIVER_LIST", $universities, $facultet_data['universitet_id']);
	}

	if ($_SESSION['type'] == 5) {
		$data = db_get_data("SELECT * FROM module_specialists WHERE id = " . $_SESSION['id']);


		$WORK_TYPE_LIST = db_get_array("SELECT * FROM module_specialists_specializations ORDER BY id", "id", "value");
		assignList("WORK_TYPE_LIST", $WORK_TYPE_LIST, $data['position_id']);

		$tpl->assign("NAME_VALUE", $data['name']);
		$tpl->assign("PHONE_VALUE", $data['phone']);
		$tpl->assign("EMAIL_VALUE", $data['email']);
	}


	$tpl->parse("CHANGE_PASSWORD", "." . $moduleName . "password");
	$tpl->parse("ROWS", "." . $moduleName . $cab_tmp);
	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/home");
	exit;
}
