<?php
$moduleName = "pps_uchebnaya_single_form";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
));


// POST ####################################################################################


if (isset($_POST['add_record'])) {
	$year = $_POST['year'];
	$month = $_POST['month'];
	$dolzhnost = $_POST['dolzhnost'];
	$admin_kolvo = $_POST['admin_kolvo'];
	$lecture = $_POST['lecture'];
	$practica = $_POST['practica'];
	$lab = $_POST['lab'];
	$in_english = $_POST['in_english'];
	$rukovod = $_POST['rukovod'];

	$sql = "INSERT INTO module_uchebnaya SET time_created = NOW(), `year` = '".$year."', `month` = '".$month."',
			user_type = '".$_SESSION['type']."', user_id = '".$_SESSION['id']."', `dolzhnost` = '".$dolzhnost."',
			`admin_times` = '".$admin_kolvo."', `lectii` = '".$lecture."', `practica` = '".$practica."',
			`lab` = '".$lab."', `translate_in_english` = '".$in_english."', `rukvo` = '".$rukovod."', `status` = 1";
	db_query($sql);

	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
}


// MAIN ####################################################################################

if (isset($_SESSION['id'])) {

	// $categories = db_query("SELECT * FROM module_categories WHERE direction_id = 1");
	// while ($category = db_fetch_array($categories)) {
	// 	$categories_ids .=  $category['id'] . ',';
	// }
	// $categories_ids = mb_substr($categories_ids, 0, -1);


	//$first_result = "SELECT * FROM module_table_names WHERE category_id IN (".$categories_ids.")";
	$first_result = "SELECT * FROM module_uchebnaya WHERE user_type = 4 AND user_id = ".$_SESSION['id'];

	$full_result = $first_result;
	$result = db_query($full_result);
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("SVOD_ROWS");
		$ALL_VSEGO = 0;
		while ($row = db_fetch_array($result)) {

			$tpl->assign("ID", $row['id']);

			if($row['dolzhnost']==1){
				$tpl->assign("PEDAGOG", 1);
				$tpl->assign("ADMINISTRATOR", 0);
			}else{
				$tpl->assign("PEDAGOG", 0);
				$tpl->assign("ADMINISTRATOR", 1);
			}

			$tpl->assign("ADMIN_TIMES", $row['admin_times']);
			$tpl->assign("LECTII", $row['lectii']);
			$tpl->assign("PRACTICA", $row['practica']);
			$tpl->assign("LAB", $row['lab']);
			$tpl->assign("IN_ENGLISH", $row['translate_in_english']);
			$tpl->assign("RUKVO", $row['rukvo']);

			$tpl->assign("YEAR", $row['year']);
			$tpl->assign("MONTH", $_MONTHS_RU[$row['month']]);

			$tpl->assign("ITOGO", $row['lectii'] + $row['practica'] + $row['lab']);

			$tpl->assign("VSEGO", $row['lectii'] + $row['practica'] + $row['lab'] + $row['translate_in_english'] + $row['rukvo']);
			$ALL_VSEGO +=$row['lectii'] + $row['practica'] + $row['lab'] + $row['translate_in_english'] + $row['rukvo'];
			$tpl->parse("SVOD_ROWS", "." . $moduleName . "row");

		}
	}
	$tpl->assign("ALL_VSEGO", $ALL_VSEGO);


	$years = '<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>';
	$tpl->assign("YEARS", $years);

	$month = $_MONTHS_RU[intval($row['month'])];
	for ($i=1; $i <13; $i++) {
		$months .= '<option value="'.$i.'">'.$_MONTHS_RU[$i].'</option>';
	}
	$tpl->assign("MONTHS", $months);

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
