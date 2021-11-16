<?php
$moduleName = "new_module_admin_accesses";
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

	 $ids = null;
function departmentsIDS($parent_id = '', $sub_mark = ''){
	global $ids;
	$query = db_query("SELECT * FROM new_module_departments WHERE parent_id = $parent_id ORDER BY name ASC");

	if (db_num_rows($query) > 0) {
		while ($row = db_fetch_array($query)) {
			// $ids .= $row['name']. '</br>';
			array_push($ids, $row['id']);
			departmentsIDS($row['id']);
		}
	}
	return $ids;
}

// $houses = db_query("SELECT * FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t1.flat_id = t2.id WHERE t1.citizen_id =".$_SESSION['id']);
// 		while ($house = db_fetch_array($houses)) {
// 			$houses_ids .=  $house['house_id']. ',';
// 		}
// 		$houses_ids = mb_substr($houses_ids, 0, -1);

# MAIN #########################################################################################
if (isset($_POST['send'])) {
	try {
		$table= "new_module_permisions";
		$user_id = cleanStr($_POST['user_id']);

		$group_indicators = $_POST['group_indicators'];
		foreach ($group_indicators as &$group_indicator_id) {
			$sql = "INSERT INTO $table SET new_user_id = '".$user_id."', indicator_category_id = '".$group_indicator_id."', status = 1";
			db_query($sql);
		}
		$_SESSION['status_data'] = 1;
		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
		exit;
	} catch (Exception $e) {
		echo 'Ошибка: ',  $e->getMessage(), "\n";
		$_SESSION['status_data'] = 3;
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

	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/2");
	exit;
}

if (checkAccessPage($_PAGE['mod_rewrite'])) {

	if (isset($_SESSION['status_data'])) {
		switch ($_SESSION['status_data']) {
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
		unset($_SESSION['status_data']);
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	$table = "new_module_permisions";
	$tpl->assign("TABLE", $table);

	$first_result = "SELECT * FROM $table";
					if (isset($_POST['ex'])) { //Фильр
							if (isset($_POST['userFilter'])) {
								if(intval($_POST['userFilter']) > 0){
									$_SESSION['user_id'] = intval($_POST['userFilter']);
									$full_result = $first_result." WHERE `new_user_id` = '".intval($_POST['userFilter'])."'";
								}else{
									$full_result = $first_result;
								}
							}
							if (isset($_POST['indicatorFilter'])) {
								if(intval($_POST['indicatorFilter']) > 0){
									$_SESSION['indicator_id'] = intval($_POST['indicatorFilter']);
									$full_result = $first_result." WHERE `indicator_category_id` = '".intval($_POST['indicatorFilter'])."'";
								}else{
									$full_result = $first_result;
								}
							}

						} else {
							$full_result = $first_result;
						}

		$result = db_query($full_result);
		$count = db_num_rows($result);
		if ($count > 0) {
			while ($row = db_fetch_array($result)) {
				$tpl->assign("GENERAL_ID", $row['id']);

				$user_name = db_get_data("SELECT fio FROM new_module_users WHERE id = " . $row['new_user_id'], "fio");
				$tpl->assign("USER_NAME", $user_name);

				$group_indicators = db_get_data("SELECT name FROM new_module_indicator_categories WHERE id = " . $row['indicator_category_id'], "name");
				$tpl->assign("GROUP_INDICATORS", $group_indicators);

				if ($row['status'] == 1) {
					$status = '<span class="badge badge-success">' . getval("STR_ACTIVE") . '</span>';
				} else {
					$status =  '<span class="badge badge-danger">' . getval("STR_NOT_ACTIVE") . '</span>';
				}
				$tpl->assign("STATUS", $status);


				$action = '<div class="btn-group" role="group">'; // start group
				$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
				$action .= '</div>'; // end group


				$tpl->assign("ACTIONS", $action);
				$tpl->parse("ROWS", ".".$moduleName . "row");
			}
		}else{
			$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
			$tpl->parse("NODATA", ".".$moduleName . "nodata");
		}

	$options = null;
	function getUsersOptions()
					{
						global $options;
						$table = 'new_module_permisions';
						$query = db_query("SELECT * FROM $table GROUP BY new_user_id");

						if (db_num_rows($query) > 0) {
							while ($row = db_fetch_array($query)) {
								if($row['new_user_id'] == $_SESSION['user_id']){
									$selected = "selected";
								}else{
									$selected = "";
								}
								$user_name = db_get_data("SELECT fio FROM new_module_users WHERE id = " . $row['new_user_id'], "fio");
								$options .= '<option value="' . $row['new_user_id'] . '" '.$selected.'>' .$user_name . '</option>';

							}
						}
						return $options;
		}

	$tpl->assign("USER_FILTER_LIST", getUsersOptions());

	$options_indicator = null;
	function getIndicatorsOptions()
					{
						global $options_indicator;
						$table = 'new_module_permisions';
						$query = db_query("SELECT * FROM $table GROUP BY indicator_category_id");

						if (db_num_rows($query) > 0) {
							while ($row = db_fetch_array($query)) {
								if($row['indicator_category_id'] == $_SESSION['indicator_id']){
									$selected = "selected";
								}else{
									$selected = "";
								}
								$indicator_name = db_get_data("SELECT name FROM new_module_indicator_categories WHERE id = " . $row['indicator_category_id'], "name");
								$options_indicator .= '<option value="' . $row['indicator_category_id'] . '" '.$selected.'>' .$indicator_name . '</option>';
							}
						}
						return $options_indicator;
		}

	$tpl->assign("INDICATORS_LIST", getIndicatorsOptions());

	# FORM ACTIONS ####################################

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


	$departments_types_list = db_get_array("SELECT * FROM new_module_department_types ORDER BY name DESC", "id", "name");
	assignList("DEPARTMENTS_TYPES_LIST", $departments_types_list);


	$resercher_users_list = db_get_array("SELECT * FROM new_module_users WHERE user_type_id = '2' ORDER BY fio DESC", "id", "fio");
	assignList("RESERCHER_USERS_LIST", $resercher_users_list);


	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/login");
	exit;
}
