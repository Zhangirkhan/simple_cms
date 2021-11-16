<?php
$moduleName = "new_module_filler_dashboard";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "facultet" => $prefix . "facultet.tpl",
	$moduleName . "row" => $prefix . "row.tpl",

));


// MAIN ####################################################################################

if (isset($_SESSION['id'])) {

	$result = db_query("SELECT * FROM new_module_indicators");
	if (db_num_rows($result) > 0) {
		$tpl->assign("FORMS_COUNT", db_num_rows($result));
	}else{
		$tpl->assign("FORMS_COUNT", 0);
	}

	$result = db_query("SELECT * FROM new_module_indicators");
	if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$records_count += db_table_count($row['indicator_table_name'], "new_user_id = ".$_SESSION['id']);
			}
		$tpl->assign("RECORDS_COUNT", $records_count);
	}else{
		$tpl->assign("RECORDS_COUNT", 0);
	}

	$result = db_query("SELECT * FROM new_module_indicator_categories");
	if (db_num_rows($result) > 0) {
		$tpl->assign("DIRECTION_COUNT", db_num_rows($result));
	}else{
		$tpl->assign("DIRECTION_COUNT", 0);
	}


	$balls = db_query("SELECT * FROM new_module_departments");
	if(db_num_rows($balls) >0){
		$tpl->assign("DEPARTMENTS_COUNT", db_num_rows($balls));
	}else{
		$tpl->assign("DEPARTMENTS_COUNT", 0);
	}

	$facultets = db_query("SELECT * FROM new_module_departments");
	if (db_num_rows($facultets) > 0) {
		$tpl->CLEAR("FACULTETS");
		while ($row = db_fetch_array($facultets)) {

					$tpl->assign("FACULTET_NAME", $row['name']);

					//Выбор факультета
					$users_ids = null;
					$users = db_query("SELECT new_user_id FROM new_module_many_departments_and_users WHERE department_id = '".$row['id']."' GROUP BY department_id");
					while ($user = db_fetch_array($users)) {
						$users_ids .=  $user['new_user_id']. ',';
						// echo $user['id'];
					}
					$users_ids = mb_substr($users_ids, 0, -1);
					$tpl->CLEAR("USERS");
					// $tpl->assign("USERS", $users_ids);
					$facultet_rows = null;
					$index=0;
					$all_summ_balls=0;
					if(!empty($users_ids)){
					$first_result = "SELECT id, filler_id, sum(ball) as balls FROM new_module_balls WHERE user_type = 4 AND user_id IN (".$users_ids.") GROUP BY filler_id ORDER BY balls DESC LIMIT 10";
					$full_result = $first_result;
						$result = db_query($full_result);
						if (db_num_rows($result) > 0) {
							while ($row2 = db_fetch_array($result)) {
								$users_info = db_get_data("SELECT * FROM new_module_users WHERE id = " . $row2['user_id']);
								$user_initials = preg_replace('~^(\S++)\s++(\S)\S++\s++(\S)\S++$~u', '$1 $2.$3.', $users_info['fio']);

								$facultet_rows .= '<tr>
										<td>'.$user_initials.'</td>
										<td>'.++$index.'</td>
										<td>'.$row2['balls'].'</td></tr>';
								$all_summ_balls +=$row2['balls'];
								$display = "";
							}
						}else{
                            $facultet_rows .= ' <tr>
										<td colspan="3">Данных нет</td>
										</tr>';
										$display = "";
                        }
					}else{
						$facultet_rows .= ' <tr>
										<td colspan="3">Пользователей пока нет</td>
										</tr>';
										$display = 'style="display:none;"';
					}
				$tpl->assign("DISPLAY", $display);
				$tpl->assign("FACULTET_ROWS", $facultet_rows);
				$tpl->assign("ALL_SUMM_BALLS", $all_summ_balls);
		$tpl->assign("DISPLAY_NONE", 'style="display:none;"');

		$tpl->parse("FACULTETS", "." . $moduleName . "facultet");
		//$tpl->parse(strtoupper($moduleName), ".".$moduleName."facultet");
		}
	}


	// $tpl->assign("DISPLAY", 'style="display:none;"');

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
