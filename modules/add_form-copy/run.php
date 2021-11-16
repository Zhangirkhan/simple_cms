<?php
$moduleName = "add_form";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
));

# VARS #########################################################################################

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
$docTypes = array('doc', 'docx', 'ppt', 'pptx', 'txt', 'rtf', 'pdf', 'xls', 'xlsx', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

# FUCTIONS ####################################################################################


function getRandomString($n)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';

	for ($i = 0; $i < $n; $i++) {
		$index = rand(0, strlen($characters) - 1);
		$randomString .= $characters[$index];
	}

	return $randomString;
}

# MAIN #########################################################################################

if (isset($_POST['send'])) {
	// if ($_POST) {
	// 	echo '<pre>';
	// 	echo htmlspecialchars(print_r($_POST, true));
	// 	echo '</pre>';
	// }
	//return;
	$number = intval($_POST['number']);

	$form_name = cleanStr($_POST['form_name']);
	$status = intval($_POST['status']);
	$year = cleanStr($_POST['year']);
	$category_id = intval($_POST['category_id']);

	$ball = intval($_POST['ball']);
	// $repeat_time = cleanStr($_POST['placeholder']);
	// $facultet_id = intval($_POST['facultet_id']);

	$table_name = "module_form_" . getRandomString(6);
	//Название таблицы вноситься в таблицу
	$sql = null;
	$sql = "INSERT INTO module_table_names SET table_name = '" . $table_name . "', form_name = '" . $form_name . "', time_created = NOW(), status = " . $status . ", year = " . $year . ", category_id = " . $category_id . ", balls = " . $ball . " ";
	db_query($sql);
	$last_table_name_id = db_insert_id();

	//Добавление в таблицу колонок
	$column_index = 0;
	foreach ($_POST['type_column'] as $key => $type_column) {
		$column_index++;
		if ($type_column == 2) {
			$column_type = "text";
		} else if ($type_column == 3) {
			$column_type = "number";
		} else if ($type_column == 4) {
			$column_type = "email";
		} else if ($type_column == 5) {
			$column_type = "phone";
		} else if ($type_column == 6) {
			$column_type = "file";
		}
		$required = $_POST['required_field'][$key];
		$column_name = $_POST['name'][$key];
		$column_label = $_POST['label'][$key];

		$sql = "INSERT INTO module_validations SET table_id = '" . $last_table_name_id . "', column_label = '" . $column_label . "', column_name = '" . $column_name . "', order_number = '" . $column_index . "', column_type = '" . $column_type . "', column_required = '" . $required . "' ";
		db_query($sql);
	}


	$query = "SELECT ID FROM " . $table_name;
	$result = db_query($query);

	//CREATE SQL CREATOR
	$sqlcreator = null;
	foreach ($_POST['name'] as $key => $name) {
		if ($_POST['type_column'][$key] == 1) {
			$not_null = " NOT NULL ,";
		} else {
			$not_null = " NULL ,";
		}
		$sqlcreator .= $name . " TEXT " . $not_null;
	}
	//Создание таблицы
	if (empty($result)) {
		$query = "CREATE TABLE " . $table_name . " (
                          id int(11) AUTO_INCREMENT,
						  " . $sqlcreator . "
						  data_status int(11) NOT NULL ,
						  time_created DATETIME NOT NULL ,
						  user_id int(11) NOT NULL ,
						  user_type int(11) NOT NULL ,
                          PRIMARY KEY  (id)
                          )";
		$result = db_query($query);
		//echo $query;
	}


	header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
	exit;
}
############## GENERAL ######################
if (isset($_SESSION['id'])) {

	if (isset($_GET['item_id'])) {
		switch ($_GET['item_id']) {

			case 1:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Вы успешно добавили форму в систему</div>', 'result_error');
				break;
			case 2:
				$tpl->assign("RESULT_MESSAGE", '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>Во время добавления произошла ошибка.</div>', 'result_error');
				break;
			default:
				$tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	$categories = db_get_array("SELECT * FROM module_categories", "id", "name");
	assignList("CATEGORY_LIST", $categories);

	$years = db_get_array("SELECT * FROM module_years", "name", "name");
	assignList("YEAR_LIST", $years);

	$universities = db_get_array("SELECT * FROM module_universities", "id", "name");
	assignList("UNIVER_LIST", $universities);

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
