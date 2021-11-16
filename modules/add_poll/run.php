<?php
$moduleName = "add_poll";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
));

# VARS #########################################################################################

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
$docTypes = array('doc', 'docx', 'ppt', 'pptx', 'txt', 'rtf', 'pdf', 'xls', 'xlsx', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

# MAIN #########################################################################################

if (isset($_POST['send'])) {
	$number = intval($_POST['number']);
	$title = cleanStr($_POST['title']);
	$description = cleanStr($_POST['description']);

	$predcedatel_sobrania = cleanStr($_POST['predcedatel_sobrania']);
	$secretar = cleanStr($_POST['secretar']);
	$secretar_sobrania = cleanStr($_POST['secretar_sobrania']);
	$description = cleanStr($_POST['description']);


	if ($secretar == 0) {
		$secretarType = 2;
	} else {
		$secretarType = 3;
	}
	if (is_array($_POST['house_id'])) {
		foreach ($_POST['house_id'] as $key => $value) {
			//Квартиры советника дома объеденнные по пользователю квартир кто советник дома 3 может быть а сам советник 1
			$sovet_flats = db_query("SELECT t1.flat_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.sovet = 1 AND t2.house_id IN (" . $value . ") GROUP BY t1.citizen_id");
			$count_sovet .= db_num_rows($sovet_flats);
		}
	} else {
		$sovet_flats = db_query("SELECT t1.flat_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.sovet = 1 AND t2.house_id IN (" . intval($_POST['house_id']) . ") GROUP BY t1.citizen_id");
		$count_sovet = db_num_rows($sovet_flats);
	}

	if ($count_sovet < 3) {

		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
		exit;
	} else {

		$sql = "INSERT INTO module_polls SET title = '" . $title . "', description = '" . $description . "', time_create = NOW(), user_id = " . $predcedatel_sobrania . ", user_type_id = 3, secretar_type = " . $secretarType . ", secretar_id = " . $secretar_sobrania . ", initiator_id = " . $_SESSION['id'] . ", initiator_type = " . $_SESSION['type'] . ", status = 0 ";
		db_query($sql);

		$poll_id = db_insert_id();

		if (is_array($_POST['house_id'])) {
			foreach ($_POST['house_id'] as $key => $value) {
				$sql = 'INSERT INTO module_polls_link SET poll_id = ' . $poll_id . ', house_id = ' . $value;
				db_query($sql);
				//Квартиры советника дома объеденнные по пользователю квартир кто советник дома 3 может быть а сам советник 1
				$sovet_flats = db_query("SELECT t1.flat_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.sovet = 1 AND t2.house_id IN (" . $value . ") GROUP BY t1.citizen_id");
				$count_sovet .= db_num_rows($sovet_flats);
			}
		} else {
			$sql = 'INSERT INTO module_polls_link SET poll_id = ' . $poll_id . ', house_id = ' . $_POST['house_id'];
			db_query($sql);

			$sovet_flats = db_query("SELECT t1.flat_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.sovet = 1 AND t2.house_id IN (" . $_POST['house_id'] . ") GROUP BY t1.citizen_id");
			$count_sovet = db_num_rows($sovet_flats);
		}


		for ($i = 1; $i <= $number; $i++) {
			$question_title = cleanStr($_POST['question_title_' . $i]);
			$question_descr = cleanStr($_POST['question_description_' . $i]);

			$newFileName1 = '';
			$newFileName2 = '';
			$newDocName1 = '';
			$newDocName2 = '';

			if (!empty($_FILES['photo1_question_' . $i])) {
				$fileParts = pathinfo($_FILES['photo1_question_' . $i]['name']);
				if (in_array($fileParts['extension'], $fileTypes)) {
					$filename = $_FILES['photo1_question_' . $i]['name'];
					$tmp_filename = $_FILES['photo1_question_' . $i]['tmp_name'];
					$newFileName1 = time() . "-1" . $fileParts['extension'];

					$ret = copy($tmp_filename, "./photos/" . $newFileName1);
				}
			}

			if (!empty($_FILES['photo2_question_' . $i])) {
				$fileParts = pathinfo($_FILES['photo2_question_' . $i]['name']);
				if (in_array($fileParts['extension'], $fileTypes)) {
					$filename = $_FILES['photo2_question_' . $i]['name'];
					$tmp_filename = $_FILES['photo2_question_' . $i]['tmp_name'];
					$newFileName2 = time() . "-2" . $fileParts['extension'];

					$ret = copy($tmp_filename, "./photos/" . $newFileName2);
				}
			}

			if (!empty($_FILES['doc1_question_' . $i])) {
				$fileParts = pathinfo($_FILES['doc1_question_' . $i]['name']);
				if (in_array($fileParts['extension'], $docTypes)) {
					$filename = $_FILES['doc1_question_' . $i]['name'];
					$tmp_filename = $_FILES['doc1_question_' . $i]['tmp_name'];
					$newDocName1 = time() . "-1." . $fileParts['extension'];

					$ret = copy($tmp_filename, "./files/" . $newDocName1);
				}
			}

			if (!empty($_FILES['doc2_question_' . $i])) {
				$fileParts = pathinfo($_FILES['doc2_question_' . $i]['name']);
				if (in_array($fileParts['extension'], $docTypes)) {
					$filename = $_FILES['doc2_question_' . $i]['name'];
					$tmp_filename = $_FILES['doc2_question_' . $i]['tmp_name'];
					$newDocName2 = time() . "-2." . $fileParts['extension'];

					$ret = copy($tmp_filename, "./files/" . $newDocName2);
				}
			}

			$id_array = '';
			$images_array = [$newFileName1, $newFileName2];
			foreach ($images_array as $key => $value) {
				if ($value != "") {
					$sql = "INSERT INTO module_photos SET url_photos = '" . $value . "'";
					db_query($sql);

					$id_array[] = db_insert_id();
				}
			}

			$photo_id = serialize($id_array);

			$id_array = '';
			$files_array = [$newDocName1, $newDocName2];
			foreach ($files_array as $key => $value) {
				if ($value != "") {
					$sql = "INSERT INTO module_files SET url_files = '" . $value . "'";
					db_query($sql);

					$id_array[] = db_insert_id();
				}
			}

			$files_id = serialize($id_array);

			$sql = "INSERT INTO module_poll_questions SET title = '" . $question_title . "', description = '" . $question_descr . "', files_id = '" . $files_id . "', photos_id = '" . $photo_id . "', poll_id = " . $poll_id;
			db_query($sql);

			$question_id = db_insert_id();

			$sql = "INSERT INTO module_poll_answers SET title = '" . getval("STR_POLL_ANSWER_1_TITLE") . "', question_id = " . $question_id;
			db_query($sql);

			$sql = "INSERT INTO module_poll_answers SET title = '" . getval("STR_POLL_ANSWER_2_TITLE") . "', question_id = " . $question_id;
			db_query($sql);

			$sql = "INSERT INTO module_poll_answers SET title = '" . getval("STR_POLL_ANSWER_3_TITLE") . "', question_id = " . $question_id;
			db_query($sql);
		}
		if ($_SESSION['type'] == 2) {
			header("Location: /" . LANG_INDEX . "/polls_osi");
			exit;
		} else {
			header("Location: /" . LANG_INDEX . "/polls_citizen");
			exit;
		}
	}
}

if (isset($_SESSION['id'])) {

	if (isset($_GET['item_id'])) {
		switch ($_GET['item_id']) {
			case 1:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger text-white" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>В вашем голосовании меньше 3 советников дома. Пожалуйста укажите кто являеться советниками дома в разделе ЖИТЕЛИ</div>', 'result_error');
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

	if ($_SESSION['type'] == 2) {
		// список домов ОСИ		
		$flat_list = '<option label="Выберите дом(а)" value="0">Выберите дом(а)</option>';
		$result = db_query("SELECT * FROM module_houses WHERE osi_id = " . $_SESSION['id']);
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$city = db_get_data("SELECT name FROM module_cities WHERE id = " . $row['city_id'], "name");
				$district = db_get_data("SELECT * FROM module_districts WHERE id = '" . $row['district_id'] . "'");
				$flat_list .= '<option value="' . $row['id'] . '">' . $city . ', ' . $district['name'] . ', ' . getval("STR_STREET_SOKR_TITLE") . ' ' . $row['street'] . ' ' . $row['house_number'] . '</option>';
			}
		}

		$tpl->assign("MULTIPLE", "multiple");
	} else {
		// список квартир		
		$flat_list = '<option selected value="0">Выберите дом(а)</option>';
		$result = db_query("SELECT t1.*, t2.osi_id, t2.house_id, t2.flat_number, t2.city_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.citizen_id = " . $_SESSION['id'] . " GROUP BY t2.house_id");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$city = db_get_data("SELECT name FROM module_cities WHERE id = " . $row['city_id'], "name");
				$house = db_get_data("SELECT * FROM module_houses WHERE id = '" . $row['house_id'] . "'");
				$district = db_get_data("SELECT * FROM module_districts WHERE id = '" . $house['district_id'] . "'");
				$flat_list .= '<option value="' . $row['house_id'] . '">' . $city . ', ' . $district['name'] . ', ' . getval("STR_STREET_SOKR_TITLE") . ' ' . $house['street'] . ' ' . $house['house_number'] . '</option>';
			}
		}

		$tpl->assign("MULTIPLE", "multiple");
	}

	$tpl->assign("FLAT_LIST", $flat_list);
	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
