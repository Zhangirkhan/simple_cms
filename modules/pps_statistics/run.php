<?php
$moduleName = "pps_statistics";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "facultet" => $prefix . "facultet.tpl",
	$moduleName . "row" => $prefix . "row.tpl",
));


// MAIN ####################################################################################

if (isset($_SESSION['id'])) {

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (1,2,3,4) AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	if($balls >0){
		$tpl->assign("VNEAUDITORNAYA_RABOTA_BALLS_COUNT", $balls);
	}else{
		$tpl->assign("VNEAUDITORNAYA_RABOTA_BALLS_COUNT", 0);
	}

	$balls = db_get_data("SELECT count(id) as ids FROM module_table_names WHERE category_id IN (1,2,3,4)", "ids");
	if($balls >0){
		$tpl->assign("VNEAUDITORNAYA_RABOTA_FORMS_COUNT", $balls);
	}else{
		$tpl->assign("VNEAUDITORNAYA_RABOTA_FORMS_COUNT", 0);
	}

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id = 1 AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	if($balls >0){
		$tpl->assign("VOSPITATELNAYA_RABOTE_BALLS_COUNT", $balls);
	}else{
		$tpl->assign("VOSPITATELNAYA_RABOTE_BALLS_COUNT", 0);
	}

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id = 2 AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	if($balls >0){
		$tpl->assign("MEZHDUNARODNAYA_RABOTA_BALLS_COUNT", $balls);
	}else{
		$tpl->assign("MEZHDUNARODNAYA_RABOTA_BALLS_COUNT", 0);
	}

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id = 3 AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	if($balls >0){
		$tpl->assign("IMIDZH_RABOTA_BALLS_COUNT", $balls);
	}else{
		$tpl->assign("IMIDZH_RABOTA_BALLS_COUNT", 0);
	}

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id = 4 AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	if($balls >0){
		$tpl->assign("PROF_RABOTA_BALLS_COUNT", $balls);
	}else{
		$tpl->assign("PROF_RABOTA_BALLS_COUNT", 0);
	}

	$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id = 5 AND user_type = '".$_SESSION['type']."' AND user_id = '".$_SESSION['id']."' ", "balls");
	if($balls >0){
		$tpl->assign("NAUCHNAYA_RABOTA_BALLS_COUNT", $balls);
	}else{
		$tpl->assign("NAUCHNAYA_RABOTA_BALLS_COUNT", 0);
	}

	$forms_count = db_get_data("SELECT count(id) as ids FROM module_table_names WHERE category_id = 5", "ids");
	if($forms_count >0){
		$tpl->assign("NAUCHNAYA_RABOTA_FORMS_COUNT", $forms_count);
	}else{
		$tpl->assign("NAUCHNAYA_RABOTA_FORMS_COUNT", 0);
	}

	//
		$facultet_id = db_get_data("SELECT facultet_id FROM module_users WHERE id = ".$_SESSION['id'], "facultet_id");
		$users = db_query("SELECT id FROM module_users WHERE facultet_id = ".$facultet_id);
			while ($user = db_fetch_array($users)) {
				$users_ids .=  $user['id']. ',';
			}
		$users_ids = mb_substr($users_ids, 0, -1);
		//echo $users_ids;
		$balls = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE user_type = 4 AND user_id IN (".$users_ids.") ", "balls");
		if($balls >0){
			$tpl->assign("FACULTET_BALLS_COUNT", $balls);
		}else{
			$tpl->assign("FACULTET_BALLS_COUNT", 0);
		}


		////

		$full_result = "SELECT * FROM module_users WHERE type = 4 ORDER BY id ASC";
		$result = db_query($full_result);
		if (db_num_rows($result) > 0) {
			$users_and_balls =array();
			while ($row = db_fetch_array($result)) {
				$vneaudit = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (1,2,3,4) AND user_type=4 AND user_id = ".$row['id'], "balls");
				$nauchno = db_get_data("SELECT sum(ball) as balls FROM module_balls WHERE category_id IN (5) AND user_type= 4 AND id = ".$row['id'], "balls");

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

			$indexj = 1;
			//$tpl->assign("MESTO_VRAITING", $users_and_balls[0]);
			//echo $users_and_balls;
			//while ($row = db_fetch_array($result)) {
			foreach ($users_and_balls as $key => $value) {

				if($key == $_SESSION['id']){
					$tpl->assign("MESTO_VRAITING", $indexj);
				}
				$indexj++;
			}


		////

	$facultets = db_query("SELECT * FROM module_facultets");
	if (db_num_rows($facultets) > 0) {
		$tpl->CLEAR("FACULTETS");
		while ($row = db_fetch_array($facultets)) {


		$tpl->assign("FACULTET_NAME", $row['name']);

						//Выбор факультета
						$users_ids = null;
				$users = db_query("SELECT id FROM module_users WHERE id NOT IN (1,2,3,4) AND facultet_id = ".$row['id']);
						while ($user = db_fetch_array($users)) {
							$users_ids .=  $user['id']. ',';
						}
					$users_ids = mb_substr($users_ids, 0, -1);
					$tpl->CLEAR("USERS");
					//$tpl->assign("USERS", $users_ids);
					$facultet_rows = null;
					$index=0;
					$all_summ_balls=0;
					if(!empty($users_ids)){
					$first_result = "SELECT id, user_id, user_type ,sum(ball) as balls  FROM module_balls WHERE user_type = 4 AND user_id IN (".$users_ids.") GROUP BY user_id ORDER BY balls DESC LIMIT 10";
					$full_result = $first_result;
						$result = db_query($full_result);
						if (db_num_rows($result) > 0) {
							while ($row2 = db_fetch_array($result)) {
								$users_info = db_get_data("SELECT * FROM module_users WHERE id = " . $row2['user_id']);
								$user_initials = preg_replace('~^(\S++)\s++(\S)\S++\s++(\S)\S++$~u', '$1 $2.$3.', $users_info['fio']);
								if($row2['user_id'] == $_SESSION['id'] && $_SESSION['type']==4){
										$user_initials = "<b>".$user_initials."</b>";
								}

								$facultet_rows .= '<tr>
										<td>'.$user_initials.'</td>
										<td>'.++$index.'</td>
										<td>'.$row2['balls'].'</td></tr>';
								$all_summ_balls +=$row2['balls'];
							}
						}else{
                            $facultet_rows .= ' <tr>
										<td colspan="3">Данных нет</td>
										</tr>';
                        }
					}else{
						$facultet_rows .= ' <tr>
										<td colspan="3">Данных нет</td>
										</tr>';
					}
				$tpl->assign("FACULTET_ROWS", $facultet_rows);
				$tpl->assign("ALL_SUMM_BALLS", $all_summ_balls);
		//$tpl->assign("FACULTET_ROWS", $facultet_rows);

		$tpl->parse("FACULTETS", "." . $moduleName . "facultet");
		//$tpl->parse(strtoupper($moduleName), ".".$moduleName."facultet");
		}
	}

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
