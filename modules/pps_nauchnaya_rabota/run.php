<?php
$moduleName = "pps_nauchnaya_rabota";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",

$moduleName . "row" => $prefix . "row.tpl",

));


// MAIN ####################################################################################

if (isset($_SESSION['id'])) {

	// $categories = db_query("SELECT * FROM module_categories WHERE direction_id = 1");
	// while ($category = db_fetch_array($categories)) {
	// 	$categories_ids .=  $category['id'] . ',';
	// }
	// $categories_ids = mb_substr($categories_ids, 0, -1);


	//$first_result = "SELECT * FROM module_table_names WHERE category_id IN (".$categories_ids.")";
	$first_result = "SELECT * FROM module_table_names WHERE category_id = 5";

	$full_result = $first_result;
	$all_category = 0;
	$result = db_query($full_result);
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("VOSPITATEL_RABOTA_FORMS_ROWS");
		$index = 1;
		while ($row = db_fetch_array($result)) {

			$form_info = db_get_data("SELECT * FROM module_table_names WHERE id = " . $row['id']);
			$category_info = db_get_data("SELECT name FROM module_categories WHERE id = " . $form_info['category_id'], "name");
			$access_form = db_get_data("SELECT name FROM module_roles WHERE id = " . $row['type'], "name");

			$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE form_id = '" . $row['id']."' AND category_id =  '".$form_info['category_id']."' AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
			if($balls>0){

			}else{
				$balls =0;
			}
			$tpl->assign("ID", $row['id']);
			$tpl->assign("ID", $index);

			$tpl->assign("CATEGORY", $category_info);
			$tpl->assign("FORM_NAME", $form_info['form_name']);

			$select_count = 0;
			$result2 = db_query("SELECT * FROM module_validations WHERE table_id = " . $row['id']);
			while ($row2 = db_fetch_array($result2)) {
				if($row2['column_type']=="select"){
					$max_balls = db_get_data("SELECT max(ball) as maxballs FROM module_options WHERE validation_id = " . $row2['id'], "maxballs");
					$select_count += $max_balls;
				}
			}
			$all_category +=$select_count;
			$plus_all_ball = $select_count + $form_info['balls'];


			$tpl->assign("MAX_BALL",'<span class="badge badge-primary"> '. $plus_all_ball.' </span></td>');
			$tpl->assign("BALL",  '<span class="badge badge-success">'.$balls.'</span></td>');
			$action = null;
			$action .= ' <a class="btn btn-success btn-sm text-white" href="/ru/pps_single_form/' . $form_info['id'] . '" data-original-title="Заполнить"><i class="fa fa-plus"></i> ADD RECORD</a>';

			$tpl->assign("TIME_CREATED", '<span class="badge badge-primary">'.date("d.m.Y", strtotime($row['time_created'])). '</span>');
			$tpl->assign("ACTION", $action);
			$index++;
			$tpl->parse("VOSPITATEL_RABOTA_FORMS_ROWS", "." . $moduleName . "row");

		}
	}

	if (db_num_rows($full_result) > 0) {
		$records_count = db_num_rows($full_result);
		$tpl->assign("FORMS_COUNT", $records_count);
	}else{
		$tpl->assign("FORMS_COUNT", 0);
	}

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id = 5 AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	$tpl->assign("USER_BALLS", $balls);
	$ballses = db_get_data("SELECT sum(balls) as ballses FROM module_table_names WHERE category_id = 5 ", "ballses");
	$tpl->assign("CATEGORY_MAX_BALLS", $ballses+$all_category);
	$forms_count = db_get_data("SELECT count(id) as ids FROM module_table_names WHERE category_id = 5 ", "ids");
	$tpl->assign("FORMS_COUNT", $forms_count);
	
	$result = db_query("SELECT * FROM module_table_names WHERE category_id = 5  ORDER by table_name ASC");
	if (db_num_rows($result) > 0) {
		$indexa = 0;
		while ($row = db_fetch_array($result)) {
			
				$forms_fulled_count = db_get_data("SELECT count(id) as ids FROM ".$row['table_name']." WHERE user_type = ".$_SESSION['type']." AND user_id = ".$_SESSION['id'], "ids");
			//$indexa = $forms_fulled_count;
				if($forms_fulled_count>0){
					$indexa++;
				}
			//$indexa = 3;
		//	echo $row['table_name'];
		//	echo "<br/>";
		}
	}
	
	$tpl->assign("FORMS_FULLED", $indexa);


	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
