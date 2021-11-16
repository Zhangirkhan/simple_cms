<?php
$moduleName = "raiting";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "row" => $prefix . "row.tpl",
));


// MAIN ####################################################################################

if($_SESSION['type'] == 4){
	
$result = "SELECT *  FROM module_users WHERE";
}else{
$result = "SELECT *  FROM module_users WHERE id NOT IN (1,3,4) AND";
}
if (isset($_POST['ex'])) {
		if (isset($_POST['facultet_filters'])) {
			if (intval($_POST['facultet_filters']) > 0) {
				$dir_val = intval($_POST['facultet_filters']);
				$full_result = $result . " type = 4 AND `facultet_id` = '" . $dir_val . "' ORDER BY fio ASC";

				$tpl->assign("FILTER" . $dir_val, "selected");
			} else {
				$full_result = $result . " type = 4 and `facultet_id` IN (1,2,3,4,5,6,7,14)  ORDER BY fio ASC";
			}
		}

		} else {
			$full_result = $result . " type = 4 and `facultet_id` IN (1,2,3,4,5,6,7,14)  ORDER BY fio ASC";
		}

		$result = db_query($full_result);
		if (db_num_rows($result) > 0) {
			$users_and_balls =array();
			$nauchno = 0;
			$vneaudit = 0;
			while ($row = db_fetch_array($result)) {
				$vneaudit = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (1,2,3,4) AND user_type = 4 AND user_id = ".$row['id'], "balls");
				$nauchno = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (5) AND user_type = 4 AND user_id = ".$row['id'], "balls");

				if($vneaudit > 0){
				}else{
					$vneaudit = 0;
				}
				if($nauchno > 0){
				}else{
					$nauchno = 0;
				}
				$all_ball = $vneaudit + $nauchno;
				$users_and_balls += [$row['id'] => $all_ball];
				arsort($users_and_balls);
			}
		}

			$tpl->CLEAR("RAITING_ROWS");
			$index = 1;
$vneaudit = 0;
$nauchno = 0;
			//while ($row = db_fetch_array($result)) {
			foreach ($users_and_balls as $key => $value) {
				
				$user_data = db_get_data("SELECT *  FROM module_users WHERE type = 4 AND id = '".$key."' ORDER BY fio ASC");
				$facultet = db_get_data("SELECT name FROM module_facultets WHERE id = ".$user_data['facultet_id'], "name");

				$vneaudit = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (1,2,3,4) AND user_type=4 AND user_id = ".$user_data['id'], "balls");
				$nauchno = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (5) AND user_type= 4 AND user_id = ".$user_data['id'], "balls");

				if($vneaudit > 0){
				}else{
					$vneaudit = 0;
				}
				if($nauchno > 0){
				}else{
					$nauchno = 0;
				}
				$all_ball = $vneaudit + $nauchno;
				$tpl->assign("ID", $index);
				
				
				$count_var = substr_count(trim($user_data['fio']), ' ');;
				//echo $count_var."<br/>";
				if($count_var == 1){
					//$x = explode(" ", trim($user_data['fio']));
					//preg_match_all('/ (.)/iu', $user_data['fio'],$m);
					//$m2 = explode(' ', $user_data['fio']);
					//echo implode('|', array(1, 2, 3)); // выдаст строку: 1|2|3
					
					
					
					$user_initials = preg_replace('~^(\S++)\s++(\S)(\S)\S++$~u', '$1 $2.', trim($user_data['fio']), -1);

				}else if($count_var >= 2){
					$user_initials = preg_replace('~^(\S++)\s++(\S)\S++\s++(\S)\S++$~u', '$1 $2.$3.', trim($user_data['fio']));
				}
					
				

				$tpl->assign("FIO", $user_initials);
				$tpl->assign("FACULTET", $facultet);
				$tpl->assign("VNEAUDIT_WORK",$vneaudit);
				$tpl->assign("NAUCHNO_WORK", $nauchno);
				$tpl->assign("ALL_BALL", $value);


				$index++;
				$tpl->parse("RAITING_ROWS", ".".$moduleName . "row");
			}


$tpl->parse(strtoupper($moduleName), $moduleName);
