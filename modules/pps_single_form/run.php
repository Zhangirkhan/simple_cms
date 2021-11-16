.<?php

$moduleName = "pps_single_form";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
	$moduleName . "inner_item" => $prefix . "inner_item.tpl",
	$moduleName . "nodata" => $prefix . "nodata.tpl",
));

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');

$docTypes = array('pdf', 'wmv', 'avi', 'mp4', 'jpg', 'jpeg', 'gif', 'svg', 'png', 'gif', 'zip', 'rar');


$newFileName1 = '';
$newFileName2 = '';
$newFileName3 = '';
$newFileName4 = '';

$newDocName1 = '';
#VARIABLES
$osi_ids = '';
#FUNCTION #####################################################

# POST ##########################################################################
if (isset($_POST['add_record'])) {
	$form_id = $_POST['form_id'];
	$table_info = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);
	$column = $_POST['column'];
	$oneDate = $_POST['oneDate'];
	$betweenDates = $_POST['betweenDates'];

	$column_index = 0;
	$result2 = db_query("SELECT * FROM module_validations where table_id = '" . $form_id . "' ORDER BY order_number ASC");
	if (db_num_rows($result2) > 0) {
		$sql .= "INSERT INTO " . $table_info['table_name'] . " SET ";
		while ($row2 = db_fetch_array($result2)) {
			$value = null;
			$value = $_POST['column'][$column_index];

			if ($row2['column_type'] == "file") {
				if (!empty($_FILES['file'])) {
					$fileParts = pathinfo($_FILES['file']['name']);
					if (in_array($fileParts['extension'], $docTypes)) {
						$filename = $_FILES['file']['name'];
						$tmp_filename = $_FILES['file']['tmp_name'];
						$newDocName1 = time() . "-1." . $fileParts['extension'];

						$ret = copy($tmp_filename, "./files/" . $newDocName1);
						$sql .= "`" . $row2['column_name'] . "` = '" . $newDocName1 . "' ,";
					}
				}
			} else if ($row2['column_type'] == "oneDate") {
				$sql .= "`" . $row2['column_name'] . "` = '" . $oneDate . "' ,";
			} else if ($row2['column_type'] == "betweenDates") {
				$sql .= "`" . $row2['column_name'] . "` = '" . $betweenDates . "' ,";
			} else {
				//echo $value;
				$sql .= "`" . $row2['column_name'] . "` = '" . db_real_escape_string($value) . "' ,";
				$column_index++;
			}
		}
	}
	// $sql = mb_substr($sql, 0, -1);
	$sql .= " data_status = 0, user_type = " . $_SESSION['type'] . ", user_id = " . $_SESSION['id'] . ", time_created = NOW()";
	// print_r($_POST['column']);
	// print_r($sql);
	db_query($sql);

	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
}


if (isset($_POST['edit_record'])) {

	$form_id = $_POST['form_id'];
	$row_id = $_POST['row_id'];
	$table_info = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);
	$column = $_POST['column'];

	$oneDate = $_POST['oneDate'];
	$betweenDates = $_POST['betweenDates'];

	$column_index = 0;
	$result2 = db_query("SELECT * FROM module_validations where table_id = '" . $form_id . "' ORDER BY order_number ASC");
	if (db_num_rows($result2) > 0) {
		$sql .= "UPDATE " . $table_info['table_name'] . " SET ";
		while ($row2 = db_fetch_array($result2)) {
			$value = null;
			$value = $_POST['column'][$column_index];

			if ($row2['column_type'] == "file") {
				if (!empty($_FILES['file'])) {
					$fileParts = pathinfo($_FILES['file']['name']);
					if (in_array($fileParts['extension'], $docTypes)) {
						$filename = $_FILES['file']['name'];
						$tmp_filename = $_FILES['file']['tmp_name'];
						$newDocName1 = time() . "-1." . $fileParts['extension'];

						$ret = copy($tmp_filename, "./files/" . $newDocName1);
						$sql .= "`" . $row2['column_name'] . "` = '" . $newDocName1 . "' ,";
					}
				}
			} else if ($row2['column_type'] == "oneDate") {
				$sql .= "`" . $row2['column_name'] . "` = '" . $oneDate . "' ,";
			} else if ($row2['column_type'] == "betweenDates") {
				$sql .= "`" . $row2['column_name'] . "` = '" . $betweenDates . "' ,";
			} else {
				//echo $value;
				$sql .= "`" . $row2['column_name'] . "` = '" . db_real_escape_string($value) . "' ,";
				$column_index++;
			}
		}
	}
	$sql = mb_substr($sql, 0, -1);
	$sql .= " WHERE id = " . $row_id;
	// print_r($_POST['column']);
	// print_r($sql);
	db_query($sql);

	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
}

# MAIN ##########################################################################

if (isset($_SESSION['id'])) {
	if (isset($_GET['item_id'])) { //Если в ссылке есть ID ВНУТРЕННАЯ ССЫЛКА
		$id = cleanStr($_GET['item_id']);

		// $user_info = db_get_data("SELECT * FROM module_users WHERE id = " . $_SESSION['id']);
		// //Доступы для сдачи формы
		// $accesses = db_query("SELECT * FROM module_accesses WHERE form_id = " . $id . " AND facultet_id = " . $user_info['facultet_id'] . " AND status = 1 ORDER by time_end DESC");
		// if (db_num_rows($accesses) > 0) {
		// } else {
		// 	$tpl->assign("DISPLAY", 'style="display:none;"');
		// 	$tpl->parse("NODATA", "." . $moduleName . "nodata");
		// }




		//Вытащили название таблицы таблицу
		$table_info = db_get_data("SELECT * FROM module_table_names WHERE id = " . $id);




		// $workers = db_query("SELECT id FROM module_worker_uc WHERE uc_id = " . $_SESSION['id']);
		// while ($worker = db_fetch_array($workers)) {
		// 	$workers_ids .=  $worker['id'] . ',';
		// }
		// $workers_ids = mb_substr($workers_ids, 0, -1);


		$index = 0;
		$group_id = db_get_data("SELECT * FROM module_groups WHERE table_id = " . $id);
		if ($group_id['id'] > 0) {
			$arr = unserialize($group_id['columns']);
			$min = min($arr);
			$count = count($arr);
			$result = db_query("SELECT * FROM module_validations where table_id = '" . $id . "' ORDER BY order_number ASC");
			if (db_num_rows($result) > 0) {
				$group_header .= '<th class="wd-15p"></th>';
				while ($row = db_fetch_array($result)) {
					$index++;

					if ($index == $min) {
						$group_header .= '<th class="wd-20p" colspan=' . $count . '>' . $group_id['name'] . ' </th>';
					} else {
						$group_header .= '<th class="wd-15p"></th>';
					}
				}
				$group_header .= '<th class="wd-15p"></th>';
			}
		}

		$index = 0;
		$tpl->CLEAR("HEADERS");
		$result = db_query("SELECT * FROM module_validations where table_id = '" . $id . "' ORDER BY order_number ASC");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$index++;

				$header .= '<th class="wd-15p">' . $row['column_label'] . '</th>';
			}
		}

		$tpl->assign("HEADERS", $header);

		$tpl->assign("GROUP_HEADER", $group_header);

		$tpl->CLEAR("SINGLE_FORM_ROWS");

		//Название колонок
		$column_names = array();
		$columns = db_query("SHOW COLUMNS FROM " . $table_info['table_name'] . "");
		if (db_num_rows($columns) > 0) {
			while ($row2 = db_fetch_array($columns)) {
				$column_names[] .= $row2['Field'];
			}
		}
		//print_r($column_names[0]);

		//Вывод записей
		$row_count = 0;
		$result = db_query("SELECT * FROM " . $table_info['table_name'] . " WHERE user_type = 4 AND user_id = " . $_SESSION['id'] . " ORDER BY time_created ASC");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$row_count++;
				$rows .= '<tr>';
				$rows .= '<td>' . $row_count . '</td>';
				$count = 0;
				while ($count < $index) {
					// $tpl->assign("CHECK", $column_names[$index]);
					$column = null;
					$count++;
					$column = $row[$column_names[$count]];
					$validations = db_get_data("SELECT * FROM module_validations WHERE table_id = '" . $id . "' AND order_number = " . $count);
					// print_r($validations['column_type']);
					if ($validations['column_type'] == "file") {
						$rows .= '<td><a href="/files/' . $column . '">Скачать файл</a></td>';
					} else {
						$rows .= '<td>' . $column . '</td>';
					}
				}
				$row_id = $row['id'];
				if ($row['data_status'] == 0) {
					$rows .= '<td><a class="btn btn-warning btn-sm text-white" data-toggle="tooltip" onclick="editRecordFromTablePPS(' . $id . ',' . $row_id . ')" data-original-title="Редактировать"><i class="fa fa-trash"></i> EDIT</a>
					<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="sendRecordPPS(' . $id . ',' . $row_id . ')" data-original-title="Отправить"><i class="fa fa-send"></i> SEND</a>
					<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteRecordFromTablePPS(' . $id . ',' . $row_id . ')" data-original-title="Удалить"><i class="fa fa-trash"></i> DELETE</a></td>';
				} else {
					$rows .= '<td><span class="badge badge-success">Данные отправлены</span> <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="deleteRecordFromTablePPS(' . $id . ',' . $row_id . ')" data-original-title="Удалить"><i class="fa fa-trash"></i> DELETE</a></td>';
				}
				$rows .= '</tr>';
			}
		}
		$tpl->assign("SINGLE_FORM_ROWS", $rows);

		$tpl->assign("FORM_ID", $id);
		$tpl->assign("FORM_NAME", $table_info['form_name']);
	} else { // ВНЕШНАЯ СТРАНИЦА
		header("Location: /" . LANG_INDEX . "/	");
		exit;
	}
	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/home");
	exit;
}
