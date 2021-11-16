<?php
$moduleName = "new_module_admin_departments";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
	$moduleName . "inner" => $prefix . "inner.tpl",
	$moduleName . "row_inner" => $prefix . "row_inner.tpl",
	$moduleName . "nodata" => $prefix . "nodata.tpl",
));

# VARS #########################################################################################

$general_id = intval($_GET['item_id']);
$index = 0;

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
$docTypes = array('docx', 'txt', 'rtf', 'pdf', 'xls', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

# FUNCTIONS ##################################################################################


# MAIN #########################################################################################
if (isset($_POST['send'])) {
	try {
		$table = cleanStr($_POST['table']);
		$name = cleanStr($_POST['name']);
		$parent_id = cleanStr($_POST['parent_id']);
		$department_type_id = cleanStr($_POST['department_type_id']);
		$university_id = cleanStr($_POST['university_id']);

		// echo "INSERT INTO $table SET name = '".$name."', parent_id = $parent_id, department_type_id = $department_type_id, university_id = $university_id";
		$sql = "INSERT INTO $table SET name = '".$name."', parent_id = $parent_id, department_type_id = $department_type_id, university_id = $university_id";
		db_query($sql);
		$_SESSION['DATA_STATUS'] = 1;
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
		exit;
	} catch (Exception $e) {
		echo 'Ошибка: ',  $e->getMessage(), "\n";
		$_SESSION['DATA_STATUS'] = 3;
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
		exit;
	}
}

if (isset($_POST['update'])) {
	$table = cleanStr($_POST['table']);
	$general_id = cleanStr($_POST['general_id']);
	$name = cleanStr($_POST['name']);

	$sql = "UPDATE $table SET name = '" . $name . "' WHERE id = " . $general_id;
	db_query($sql);
	$_SESSION['DATA_STATUS'] = 2;
	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
	exit;
}

# INNER POST #########################################

if (isset($_POST['inner_send'])) {
	try {
		$table= "new_module_accesses";
		$method = cleanStr($_POST['method']);

		$department_id = cleanStr($_POST['department_id']);

		$indicator_or_category_ids = serialize($_POST['indicator_or_category_ids']);

    	$time_on = date( "Y-m-d",strtotime($_POST['time_on']));
		$time_to = date( "Y-m-d",strtotime($_POST['time_to']));

		// $all_down_category = cleanStr($_POST['all_down_category']);

		$indicator_categories_array = $_POST['indicator_or_category_ids'];
		foreach ($indicator_categories_array as &$indicator_categories_id) {
			$sql = "INSERT INTO $table SET department_id = '".$department_id."', indicator_category_id = '".$indicator_categories_id."', access_type = $method, active_date_from = '".$time_on."', active_date_to = '".$time_to."', status = 1";
			db_query($sql);
		}

		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/".$_GET['item_id']);
		exit;
	} catch (Exception $e) {
		echo 'Ошибка: ',  $e->getMessage(), "\n";
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/3");
		exit;
	}
}


# MAIN #########################################################

if (checkAccessPage($_PAGE['mod_rewrite'])) {

	if (isset($_SESSION['DATA_STATUS'])) {
		switch ($_SESSION['DATA_STATUS']) {
			case 1:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно добавили запись</div>', 'result_error');
				break;
			case 2:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно обновили запись</div>', 'result_error');
				break;
			case 3:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>При добавлении произошла ошибка</div>', 'result_error');
				break;
			case 4:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>При обновлении записи прозошла ошибка</div>', 'result_error');
				break;
			default:
				$tpl->assign("RESULT_MESSAGE", '');
		}
	unset($_SESSION['DATA_STATUS']);
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

if (isset($_GET['item_id'])) { //Внутренная страница
			$item_id = intval($_GET['item_id']);


				$table = "new_module_accesses";
				if($_GET['item_id'] == 0){
					$departments_name = "Все департаменты";
				}else{
					$departments_name = db_get_data("SELECT name FROM new_module_departments WHERE id = " . $_GET['item_id'] , "name");
				}
				$tpl->assign("TABLE_INNER_NAME", $departments_name);
				$tpl->assign("TABLE_INNER", $table);

				$tpl->assign("DEPARTMENT_ID", intval($_GET['item_id']));

				$result = db_query("SELECT * FROM $table WHERE department_id = ".$_GET['item_id']);
				$count = db_num_rows($result);
				if ($count > 0) {
					while ($row = db_fetch_array($result)) {
						$tpl->assign("GENERAL_ID", $row['id']);

						//1 это добавить
						//0 это исключить
						if($row['access_type'] == 1){
							$method ='<span class="badge badge-success">' . getval("STR_INCLUDE") . '</span>';
						}else{
							$method ='<span class="badge badge-danger">' . getval("STR_EXCLUDE") . '</span>';
						}
						$tpl->assign("METHOD", $method);

						$indicator_category = db_get_data("SELECT name FROM new_module_indicator_categories WHERE id = " . $row['indicator_category_id'] , "name");
						$tpl->assign("INDICATOR_CATEGORY", $indicator_category);


						$time_on = date("d.m.Y", strtotime($row['active_date_from']));
						$time_to = date("d.m.Y", strtotime($row['active_date_to']));
						$tpl->assign("TIME_BETWEEN", $time_on ." - ". $time_to);


						$action = '<div class="btn-group" role="group">'; // start group
						// $action .= '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="addNewData(\''.$row['indicator_table_name'].'\')" data-original-title="'.getval("STR_ADD").'"><i class="fa fa-trash"></i> '.getval("STR_ADD").'</a>';

						if($row['status'] == 1){
							$status = '<span class="badge badge-success">' . getval("STR_ACTIVE") . '</span>';

							$action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="newSHOWEditId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_EDIT").'"><i class="fa fa-clock-o"></i> '.getval("STR_EDIT").'</a>';
							// $action .= '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="sendIndicators(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_SEND").'"><i class="fa fa-send"></i> '.getval("STR_SEND").'</a>';
							$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
						}else{
							$status = '<span class="badge badge-success">' . getval("STR_NOT_ACTIVE") . '</span>';
							$action .='<span class="badge badge-success">' . getval("STR_SENDED") . '</span>';;
						}
						// $action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" href="/ru/filler_indicators/'.$row['id'].'" data-original-title="'.getval("STR_SHOW").'"><i class="fa fa-plus"></i> '.getval("STR_SHOW").'</a>';
						$action .= '</div>'; // end group
						$tpl->assign("STATUS", $status);
						$tpl->assign("ACTIONS", $action);
						$tpl->parse("ROWS_INNER", ".".$moduleName . "row_inner");
					}
				}else{
					$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
					$tpl->parse("NODATA", ".".$moduleName . "nodata");
				}




				$options = null;
				function IndicatorsCategoryTreeOptions($parent_id = 0, $sub_mark = ''){
					global $options;
					$query = db_query("SELECT * FROM new_module_indicator_categories WHERE parent_id = $parent_id   ORDER BY name ASC");

					if (db_num_rows($query) > 0) {
						while ($row = db_fetch_array($query)) {
							$options .= '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
							IndicatorsCategoryTreeOptions($row['id'], $sub_mark . '---');
						}
					}
					return $options;
				}

				$tpl->assign("INDICATORS_CATEGORY_LIST", IndicatorsCategoryTreeOptions());


				$tpl->parse(strtoupper($moduleName), ".".$moduleName."inner");
		} else {
			$table = "new_module_departments";
			$tpl->assign("TABLE", $table);

			function DepartmentTreeView($parent_id = 0, $sub_mark = '')
			{
				global $db;
				global $table;
				global $options;
				global $category;
				$query = db_query("SELECT * FROM $table WHERE parent_id = $parent_id ORDER BY order_by ASC");
				$category .= '<ul class="pl-2"> ';
				if (db_num_rows($query) > 0) {
					while ($row = db_fetch_array($query)) {
						if ($row['status'] == 1) {
							$status = '<span class="badge badge-success">' . getval("STR_ACTIVE") . '</span>';
						} else {
							$status =  '<span class="badge badge-danger">' . getval("STR_NOT_ACTIVE") . '</span>';
						}
						$category .= '<li> <div class="d-flex justify-content-between" ><a href="/ru/departments/'.$row['id'].'">'. $row['name'] . ' '. $status . '</a><div class="btn-group" role="group" ><a style="cursor: pointer;" class="btn-sm btn-success  text-white" data-toggle="tooltip" href="/ru/departments/'.$row['id'].'" data-original-title="' . getval("STR_ADD_PERMISSIONS") . '"><i class="fa fa-plus"></i> ' . getval("STR_ADD_PERMISSIONS") . '</a><a style="cursor: pointer;" class="btn-sm btn-primary  text-white" data-toggle="tooltip" onclick="newSHOWEditId(\'' . $table . '\',' . $row['id'] . ')" data-original-title="' . getval("STR_EDIT") . '"><i class="fa fa-edit"></i> ' . getval("STR_EDIT") . '</a><a style="cursor: pointer;" class="btn-sm btn-danger  text-white" data-toggle="tooltip" onclick="newDeleteId(\'' . $table . '\',' . $row['id'] . ')" data-original-title="' . getval("STR_DELETE") . '"><i class="fa fa-trash"></i> ' . getval("STR_DELETE") . '</a></div></div>';
						DepartmentTreeView($row['id'], $sub_mark . '   ');
						$category .= '</li>';
					}

				}
				$category .= '</ul>';
				return $category;
			}

			$all_deparments = '<ul class="mb-0"><li> <div class="d-flex justify-content-between" ><a href="/ru/departments/0">Все департаменты</a><div class="btn-group" role="group" ><a style="cursor: pointer;" class="btn-sm btn-success  text-white" data-toggle="tooltip" href="/ru/departments/0" data-original-title="' . getval("STR_ADD_PERMISSIONS") . '"><i class="fa fa-plus"></i> ' . getval("STR_ADD_PERMISSIONS") . '</a></div></div> </li></ul>';
			$tpl->assign("TREE_VIEW", $all_deparments.DepartmentTreeView());

			# FORM ACTIONS ####################################


			// $options = null;
			// function DepartmentTreeOptions($parent_id = 0, $sub_mark = ''){
			// 	global $options;
			// 	$query = db_query("SELECT * FROM new_module_departments WHERE parent_id = $parent_id   ORDER BY name ASC");

			// 	if (db_num_rows($query) > 0) {
			// 		while ($row = db_fetch_array($query)) {
			// 			$options .= '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
			// 			DepartmentTreeOptions($row['id'], $sub_mark . '---');
			// 		}
			// 	}
			// 	return $options;
			// }


			// $tpl->assign("DEPARTMENTS_LIST", DepartmentTreeOptions());

			$universities_list = db_get_array("SELECT * FROM new_module_universities ORDER BY name DESC", "id", "name");
			assignList("UNIVERSITIES_LIST", $universities_list);

			$departments_types_list = db_get_array("SELECT * FROM new_module_department_types ORDER BY name DESC", "id", "name");
			assignList("DEPARTMENTS_TYPES_LIST", $departments_types_list);


			$tpl->parse(strtoupper($moduleName), $moduleName);
}
} else {
	header("Location: /" . LANG_INDEX . "/login");
	exit;
}
