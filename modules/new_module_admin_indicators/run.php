<?php
$moduleName = "new_module_admin_indicators";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
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
		// $parent_id = cleanStr($_POST['parent_id']);
		$formula = cleanStr($_POST['formula']);
		// echo $formula;
		$query = db_query("SELECT MAX(id) as max_id FROM $table");
		if (db_num_rows($query) > 0) {
			while ($row = db_fetch_array($query)) {
				$number = $row['max_id']+1;
			}
		}else{
			$number = 1;
		}
		// echo $number;
		$table_name = $table ."_".$number;


		$query = "CREATE TABLE $table_name (
                          id int(11) AUTO_INCREMENT,
						  data text NOT NULL ,
						  file_url text NOT NULL,
						  data_status int(11) NOT NULL ,
						  time_created DATETIME NOT NULL ,
						  new_user_id int(11) NOT NULL ,
						  status int(11) NOT NULL ,
						  score int(11) NOT NULL ,
						  cancel_reason text NOT NULL ,
                          PRIMARY KEY (id)
                          )";
		$result = db_query($query);

		echo "INSERT INTO $table SET name = '".$name."', formula = '".$formula."', indicator_table_name = '".$table_name."';";
		$sql = "INSERT INTO $table SET name = '".$name."', formula = '".$formula."', indicator_table_name = '".$table_name."';";
		db_query($sql);
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
		exit;

	} catch (Exception $e) {
		echo 'Ошибка: ',  $e->getMessage(), "\n";
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/3");
		exit;
	}
}

if (isset($_POST['update'])) {
	$table = cleanStr($_POST['table']);
	$general_id = cleanStr($_POST['general_id']);
	$name = cleanStr($_POST['name']);
	$ball = cleanStr($_POST['ball']);

	$sql = "UPDATE $table SET name = '" . $name . "', ball = '" . $ball . "' WHERE id = " . $general_id;
	db_query($sql);

	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/2");
	exit;
}

if (checkAccessPage($_PAGE['mod_rewrite'])) {

	if (isset($_GET['item_id'])) {
		switch ($_GET['item_id']) {
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
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	$table = "new_module_indicators";
	$tpl->assign("TABLE", $table);

		$result = db_query("SELECT * FROM $table");
		$count = db_num_rows($result);
		if ($count > 0) {
			while ($row = db_fetch_array($result)) {
				$tpl->assign("GENERAL_ID", $row['id']);
				$tpl->assign("NAME", $row['name']);

				$category = db_get_data("SELECT name FROM new_module_indicator_categories WHERE id = " . $row['category_id'], "name");
				$tpl->assign("CATEGORY",  $category);
				$action = '<div class="btn-group" role="group">'; // start group
				$action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="newSHOWEditId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_EDIT").'"><i class="fa fa-trash"></i> '.getval("STR_EDIT").'</a>';
				$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
				$action .= '</div>'; // end group
				if ($row['status'] == 1) {
					$status = '<span class="badge badge-success">' . getval("STR_ACTIVE") . '</span>';
				} else {
					$status =  '<span class="badge badge-danger">' . getval("STR_NOT_ACTIVE") . '</span>';
				}
				$tpl->assign("STATUS", $status);
				$tpl->assign("BALL", $row['ball']);
				$tpl->assign("ACTIONS", $action);
				$tpl->parse("ROWS", ".".$moduleName . "row");
			}
		}else{
			$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
			$tpl->parse("NODATA", ".".$moduleName . "nodata");
		}

	// function categoryTreeView($parent_id = 0, $sub_mark = '')
	// {
	// 	global $table;
	// 	global $category;
	// 	$query = db_query("SELECT * FROM $table WHERE parent_id = $parent_id ORDER BY order_by ASC");

	// 	if (db_num_rows($query) > 0) {
	// 		$category .= '<ul class="pl-2">';
	// 		while ($row = db_fetch_array($query)) {
	// 			if ($row['status'] == 1) {
	// 				$status = '<span class="badge badge-success">' . getval("STR_ACTIVE") . '</span>';
	// 			} else {
	// 				$status =  '<span class="badge badge-danger">' . getval("STR_NOT_ACTIVE") . '</span>';
	// 			}
	// 			$category .= '<li> <div class="d-flex justify-content-between" ><a href="#">'. $row['name'] . ' '. $status . '</a><div class="btn-group" role="group" ><a style="cursor: pointer;" class="btn-sm btn-primary  text-white" data-toggle="tooltip" onclick="newSHOWEditId(\'' . $table . '\',' . $row['id'] . ')" data-original-title="' . getval("STR_EDIT") . '"><i class="fa fa-edit"></i> ' . getval("STR_EDIT") . '</a><a style="cursor: pointer;" class="btn-sm btn-danger  text-white" data-toggle="tooltip" onclick="newDeleteId(\'' . $table . '\',' . $row['id'] . ')" data-original-title="' . getval("STR_DELETE") . '"><i class="fa fa-trash"></i> ' . getval("STR_DELETE") . '</a></div></div>';
	// 			categoryTreeView($row['id'], $sub_mark . '   ');
	// 			$category .= '</li>';
	// 		}
	// 		$category .= '</ul>';
	// 	}else{
	// 		// 	$category = '<h3 class="text-center">NO DATA</h3>';
	// 	}

	// 	return $category;
	// }


	// $tpl->assign("TREE_VIEW", categoryTreeView());

	// # FORM ACTIONS ####################################
	// $options = null;
	// function categoryTree($parent_id = 0, $sub_mark = '')
	// {
	// 	global $table;
	// 	global $options;
	// 	$query = db_query("SELECT * FROM $table WHERE parent_id = $parent_id   ORDER BY name ASC");

	// 	if (db_num_rows($query) > 0) {
	// 		while ($row = db_fetch_array($query)) {
	// 			$options .= '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
	// 			categoryTree($row['id'], $sub_mark . '---');
	// 		}
	// 	}
	// 	return $options;
	// }

	// $tpl->assign("PARENTS_LIST", categoryTree());

	// $universities_list = db_get_array("SELECT * FROM new_module_universities ORDER BY name DESC", "id", "name");
	// assignList("UNIVERSITIES_LIST", $universities_list);

	// $departments_types_list = db_get_array("SELECT * FROM new_module_department_types ORDER BY name DESC", "id", "name");
	// assignList("DEPARTMENTS_TYPES_LIST", $departments_types_list);


	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/login");
	exit;
}
