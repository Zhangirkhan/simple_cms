<?php
$moduleName = "pps_nirs";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
	$moduleName . "smeta_inner" => $prefix . "smeta_inner.tpl",
	$moduleName . "item" => $prefix . "item.tpl",
	$moduleName . "item_inner" => $prefix . "item_inner.tpl",
	$moduleName . "comment" => $prefix . "comment.tpl",
	$moduleName . "nodata" => $prefix . "nodata.tpl",
));

# VARS #########################################################################################

$docTypes = array('docx', 'txt', 'rtf', 'pdf', 'xls', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');

		$newFileName1 = '';

# MAIN #########################################################################################

if (isset($_POST['poll_send'])) {
	$smeta_id = intval($_GET['item_id']);
	$answer = intval($_POST['answer']);

	$sql = "INSERT INTO module_smeta_polled SET date = NOW(), user_id = " . $_SESSION['id'] . ", user_type = " . $_SESSION['type'] . ", smeta_id = " . $smeta_id . ", answer = " . $answer;
	db_query($sql);

	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
}

if (isset($_POST['send'])) {

	$nir_id = cleanStr($_POST['nir_id']);
	$name = cleanStr($_POST['name']);
	$сharacter_work = cleanStr($_POST['сharacter_work']);
	$output = cleanStr($_POST['output']);
	$volume = cleanStr($_POST['volume']);
	$co_authors = cleanStr($_POST['co_authors']);

	if (!empty($_FILES['file_url'])) {
        $fileParts = pathinfo($_FILES['file_url']['name']);
        if (in_array($fileParts['extension'], $docTypes)) {
            $filename = $_FILES['file_url']['name'];
            $tmp_filename = $_FILES['file_url']['tmp_name'];
            $newFileName1 = time()."-1.".$fileParts['extension'];

            $ret = copy($tmp_filename, "./files/".$newFileName1);
        }
    }
	$user_data = db_get_data("SELECT facultet_id FROM module_users WHERE id = ".$_SESSION['id'], "facultet_id");


	$sql = "INSERT INTO module_nirs SET name = '" . $name . "', сharacter_work = '" . $сharacter_work . "', output = '" . $output . "', volume = '" . $volume . "', co_authors = '" . $co_authors . "', file_url = '" . $newFileName1 . "', nir_work_type_id = '" . $nir_id . "', user_type = '" . $_SESSION['type'] . "', user_id = '" . $_SESSION['id'] . "', facultet_id = '" . $user_data . "', time_created = NOW()";
	db_query($sql);

	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
}

if (isset($_POST['inner_send'])) {
	$smeta_id = intval($_GET['item_id']);
	$title = cleanStr($_POST['title']);
	$quantity = intval($_POST['quantity']);
	$price_per = intval($_POST['price_per']);
	$price = intval($_POST['price']);
	$srok = intval($_POST['srok']);
	$description = cleanStr($_POST['description']);

	$sql = "INSERT INTO module_smeta_items SET smeta_id = " . $smeta_id . ", title = '" . $title . "', quantity = " . $quantity . ", price_per = " . $price_per . ", price = " . $price . ", srok = " . $srok . ", message = '" . $description . "'";
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/smeta_osi/" . $smeta_id);
	exit;
}

if (isset($_POST['edit_send'])) {
	$smeta_id = intval($_POST['edit_smeta_id']);
	$house = intval($_POST['edit_house']);
	$quantity = intval($_POST['edit_quantity']);
	$type = intval($_POST['edit_type']);
	$description = cleanStr($_POST['edit_description']);

	$newDocName1 = '';
	$newDocName2 = '';
	$newDocName3 = '';
	$newDocName4 = '';

	if (!empty($_FILES['edit_file_1'])) {
		$fileParts = pathinfo($_FILES['edit_file_1']['name']);
		if (in_array($fileParts['extension'], $docTypes)) {
			$filename = $_FILES['edit_file_1']['name'];
			$tmp_filename = $_FILES['edit_file_1']['tmp_name'];
			$newDocName1 = time() . "-1." . $fileParts['extension'];

			$ret = copy($tmp_filename, "./files/" . $newDocName1);
		}
	}

	if (!empty($_FILES['edit_file_2'])) {
		$fileParts = pathinfo($_FILES['edit_file_2']['name']);
		if (in_array($fileParts['extension'], $docTypes)) {
			$filename = $_FILES['edit_file_2']['name'];
			$tmp_filename = $_FILES['edit_file_2']['tmp_name'];
			$newDocName1 = time() . "-2." . $fileParts['extension'];

			$ret = copy($tmp_filename, "./files/" . $newDocName1);
		}
	}

	if (!empty($_FILES['edit_file_3'])) {
		$fileParts = pathinfo($_FILES['edit_file_3']['name']);
		if (in_array($fileParts['extension'], $docTypes)) {
			$filename = $_FILES['edit_file_3']['name'];
			$tmp_filename = $_FILES['edit_file_3']['tmp_name'];
			$newDocName1 = time() . "-3." . $fileParts['extension'];

			$ret = copy($tmp_filename, "./files/" . $newDocName1);
		}
	}

	if (!empty($_FILES['edit_file_4'])) {
		$fileParts = pathinfo($_FILES['edit_file_4']['name']);
		if (in_array($fileParts['extension'], $docTypes)) {
			$filename = $_FILES['edit_file_4']['name'];
			$tmp_filename = $_FILES['edit_file_4']['tmp_name'];
			$newDocName1 = time() . "-4." . $fileParts['extension'];

			$ret = copy($tmp_filename, "./files/" . $newDocName1);
		}
	}

	$id_array = '';
	$files_array = [$newDocName1, $newDocName2, $newDocName3, $newDocName4];
	foreach ($files_array as $key => $value) {
		if ($value != "") {
			$sql = "INSERT INTO module_files SET url_files = '" . $value . "'";
			db_query($sql);

			$id_array[] = db_insert_id();
		}
	}

	$files_id = serialize($id_array);

	$sql = "UPDATE module_smeta SET house_id = " . $house . ", quantity = " . $quantity . ", type_id = " . $type . ", description = '" . $description . "', files = '" . $files_id . "' WHERE id = " . $smeta_id;
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/smeta_osi");
	exit;
}

//Обновление
if (isset($_POST['updateSettingFormSend'])) {
	$number = intval($_POST['number']);
	$form_id = intval($_POST['form_id']);

	$description = cleanStr($_POST['columns']);
	$group_index = 0;
	foreach ($_POST['name_group'] as $key => $name_group) {
		$group_index++;
		$string = $_POST['columns'][$key];
		$arr = explode(", ", $string);
		$column_ids = serialize($arr);
		$name = $_POST['name_group'][$key];

		$sql = "INSERT INTO module_groups SET name = '" . $name . "', columns = '" . $column_ids . "', table_id = '" . $form_id . "', `number` = '" . $number . "', time_created = NOW()";
		db_query($sql);
	}

	header("location: " . $_SERVER['REQUEST_URI']);
	exit;
}

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

	$first_result = "SELECT * FROM module_nirs WHERE user_type = 4 AND user_id =  ".$_SESSION['id'];

	$_SESSION['nir_work_type'] = 0;

	if (isset($_POST['ex'])) {
				if (isset($_POST['nirWorkTypeFilter'])) {
					if(intval($_POST['nirWorkTypeFilter']) > 0){
						$full_result = $first_result." AND nir_work_type_id = '".intval($_POST['nirWorkTypeFilter'])."' ORDER BY time_created DESC";
						$_SESSION['nir_work_type'] = $_POST['nirWorkTypeFilter'];
					}else{
						$full_result = $first_result." ORDER BY time_created DESC";
					}
				}
			} else {
				$full_result = $first_result." ORDER BY time_created DESC";
			}

	//$full_result = $first_result;
	$result = db_query($full_result);
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("NIR_ROWS");
		while ($row = db_fetch_array($result)) {
			$index++;
			$tpl->assign("ID", $index);
			$tpl->assign("NAME_NIR", $row['name']);
			$tpl->assign("CHARACTER_WORK", $row['сharacter_work']);
			$tpl->assign("OUTPUT", $row['output']);
			$tpl->assign("VOLUME", $row['volume']);
			$tpl->assign("CO_AUTHORS", $row['co_authors']);

			$tpl->assign("FILE_URL", $row['file_url']);
			$work_type = db_get_data("SELECT name FROM module_nir_work_type WHERE id = ".$row['nir_work_type_id'], "name");
			$tpl->assign("NIR_WORK_TYPE", $work_type);

			$tpl->assign("TIME_CREATED", date("d.m.Y", strtotime($row['time_created'])));

			// $action .= ' <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" onclick="editNIR(' . $row['id'] . ')" data-original-title="Редактировать"><i class="fa fa-trash"></i> EDIT</a>';
			$action = null;
			$action .= ' <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteNIRRecord(' . $row['id'] . ')" data-original-title="Удалить"><i class="fa fa-trash"></i> DELETE</a>';

			$tpl->assign("ACTION", $action);

			$tpl->parse("NIR_ROWS", "." . $moduleName . "row");
		}
	} else {
		$tpl->assign("DISPLAY", 'style="display:none;"');
		$tpl->parse("NODATA", "." . $moduleName . "nodata");
	}
	// }

	$work_type = db_get_array("SELECT * FROM module_nir_work_type", "id", "name");
	assignList("NIR_WORK_TYPE_LIST", $work_type, $_SESSION['nir_work_type']);

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
