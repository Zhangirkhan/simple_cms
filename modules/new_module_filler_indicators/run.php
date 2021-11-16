<?php
	$moduleName = "new_module_filler_indicators";
	$prefix = "modules/" . $moduleName . "/";

	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
			$moduleName . "row" => $prefix . "row.tpl",
			$moduleName . "inner" => $prefix . "inner.tpl",
			$moduleName . "row_inner" => $prefix . "row_inner.tpl",
			$moduleName . "nodata" => $prefix . "nodata.tpl",
			$moduleName . "nodata_indicators" => $prefix . "nodata_indicators.tpl",
		));

	# VARS #########################################################################################

	$general_id = intval($_GET['item_id']);
	$index = 0;

	$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
	$docTypes = array('docx', 'txt', 'rtf', 'pdf', 'xls', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4');

	# FUNCTIONS ##################################################################################

	$ids = array();
	function departmentsIDS($parent_id = '', $sub_mark = ''){
		global $ids;
		$query = db_query("SELECT * FROM new_module_departments WHERE parent_id = $parent_id ORDER BY name ASC");

		if (db_num_rows($query) > 0) {
			while ($row = db_fetch_array($query)) {
				array_push($ids, $row['id']);
				departmentsIDS($row['id']);
			}
		}
		return $ids;
	}
	# MAIN #########################################################################################
	if (isset($_POST['send'])) {
		try{
				$table = cleanStr($_POST['table']);
				$name = cleanStr($_POST['name']);
				echo $table;
				if (!empty($_FILES['file1'])) {
					$fileParts = pathinfo($_FILES['file1']['name']);
					if (in_array($fileParts['extension'], $fileTypes)) {
						$filename = $_FILES['file1']['name'];
						$tmp_filename = $_FILES['file1']['tmp_name'];
						$newFileName1 = time()."-1.".$fileParts['extension'];

						$ret = copy($tmp_filename, "./files/".$newFileName1);
					}
				}
				// echo "INSERT INTO $table SET data = '" . $name . "', file_url = '" . $newFileName1 . "', data_status = 1, time_created = NOW(), new_user_id = '".$_SESSION['id']."'";
				$sql = "INSERT INTO $table SET data = '" . $name . "', file_url = '" . $newFileName1 . "', data_status = 1, time_created = NOW(), new_user_id = '".$_SESSION['id']."'";
				db_query($sql);

				header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']. "/".$_GET['item_id']);
				exit;

				}catch (Exception $e){
								echo 'Ошибка: ',  $e->getMessage(), "\n";
							header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite']);
					exit;
				}

	}

	if (isset($_POST['update'])) {
		$table = cleanStr($_POST['table']);
		$general_id = cleanStr($_POST['general_id']);
		$name = cleanStr($_POST['name']);

		$sql = "UPDATE $table SET data = '".$name."' WHERE id = ".$general_id;
		db_query($sql);

		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/". $_GET['item_id']);
		exit;

	}

	if (checkAccessPage($_PAGE['mod_rewrite'])) {

		if (isset($_GET['item_id'])) { //Внутренная страница
			$item_id = intval($_GET['item_id']);
			$indicator_table_name = db_get_data("SELECT name FROM new_module_indicators WHERE id = " . $_GET['item_id'] , "name");
			$table = db_get_data("SELECT indicator_table_name FROM new_module_indicators WHERE id = " . $_GET['item_id'] , "indicator_table_name");

			// new_module_indicators

			$tpl->assign("TABLE_INNER_NAME", $indicator_table_name);
			$tpl->assign("TABLE_INNER", $table);
			$result = db_query("SELECT * FROM $table WHERE new_user_id = ".$_SESSION['id']);
			$count = db_num_rows($result);
			if ($count > 0) {
				while ($row = db_fetch_array($result)) {
					$tpl->assign("GENERAL_ID", $row['id']);
					$tpl->assign("NAME", $row['data']);

					$user_file = "./files/".$row['file_url'];
					$tpl->assign("FILE", '<a href="'.$user_file.'" > Посмотреть файл</a>');
					$tpl->assign("TIME_CREATED", date("d.m.Y H:i", strtotime($row['time_created'])));

					$action = '<div class="btn-group" role="group">'; // start group
					// $action .= '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="addNewData(\''.$row['indicator_table_name'].'\')" data-original-title="'.getval("STR_ADD").'"><i class="fa fa-trash"></i> '.getval("STR_ADD").'</a>';

					if($row['data_status'] == 1){
						$action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="newSHOWEditId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_EDIT").'"><i class="fa fa-trash"></i> '.getval("STR_EDIT").'</a>';
						$action .= '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="sendIndicators(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_SEND").'"><i class="fa fa-send"></i> '.getval("STR_SEND").'</a>';
						$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
					}else{
						$action .='<span class="badge badge-success">' . getval("STR_SENDED") . '</span>';
						}
					// $action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" href="/ru/filler_indicators/'.$row['id'].'" data-original-title="'.getval("STR_SHOW").'"><i class="fa fa-plus"></i> '.getval("STR_SHOW").'</a>';
					$action .= '</div>'; // end group
					$tpl->assign("ACTIONS", $action);
					$tpl->parse("ROWS_INNER", ".".$moduleName . "row_inner");
				}
			}else{
				$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
				$tpl->parse("NODATA", ".".$moduleName . "nodata");
			}

				$tpl->parse(strtoupper($moduleName), ".".$moduleName."inner");
		} else {
			//Делаем пустым
			$departments_array = "'0'";
			//Вытаскиваем всех пользователей
			$users_deparments = db_query("SELECT * FROM new_module_many_departments_and_users WHERE new_user_id = ".$_SESSION['id']);
			// $departments_array = null;
			while ($department = db_fetch_array($users_deparments)) {
				// array_push($departments_array, $department['department_id']);
				$departments_array .= ",'".$department['id']."'";
			}

			$today = date("d-m-Y");
			$all_departments_access = db_get_array("SELECT indicator_category_id FROM new_module_accesses WHERE department_id IN (".$departments_array.") AND access_type = 1 AND active_date_from <= CAST(NOW() as datetime) AND active_date_to >= CAST(NOW() as datetime)", "indicator_category_id");
			$all_departments_not_access = db_get_array("SELECT indicator_category_id FROM new_module_accesses WHERE department_id IN (".$departments_array.") AND access_type = 0 AND active_date_from <= CAST(NOW() as datetime) AND active_date_to >= CAST(NOW() as datetime)", "indicator_category_id");

			foreach ($all_departments_access as &$all_deparment_access_id) {
				foreach ($all_departments_not_access as &$all_deparment_not_access_id) {
						if($all_deparment_access_id == $all_deparment_not_access_id){
							$all_departments_access = array_diff($all_departments_access, [$all_deparment_not_access_id]);
						}
					}
			}
			// echo "SELECT indicator_category_id FROM new_module_accesses WHERE department_id IN (".$departments_array.") AND access_type = 1 AND active_date_from <= CAST(NOW() as datetime) AND active_date_to >= CAST(NOW() as datetime)";
			// echo "</br>";
			// echo "SELECT indicator_category_id FROM new_module_accesses WHERE department_id IN (".$departments_array.") AND access_type = 0 AND active_date_from <= CAST(NOW() as datetime) AND active_date_to >= CAST(NOW() as datetime)";


			// print_r ("<pre>");
			// print_r( $all_departments_access);
			// print_r ("</pre>");

			if(!empty($all_departments_access)){
				$categories = null;
				foreach ($all_departments_access as $key =>$value) {
					$categories .= "'".$value."', ";
				}
				$categories = mb_substr($categories, 0, -2);


				$options = null;
				function categoryTree($parent_id = 0, $sub_mark = '')
					{
						$table = 'new_module_indicator_categories';
						global $options;
						global $categories;
						$query = db_query("SELECT * FROM $table WHERE id IN (".$categories.") AND status = 1 AND parent_id = $parent_id  ORDER BY name ASC");

						if (db_num_rows($query) > 0) {
							while ($row = db_fetch_array($query)) {
								if($row['id'] == $_SESSION['category_id']){
									$selected = "selected";
								}else{
									$selected = "";
								}
								$options .= '<option value="' . $row['id'] . '" '.$selected.'>' . $sub_mark . $row['name'] . '</option>';
								categoryTree($row['id'], $sub_mark . '---');
							}
						}
						return $options;
					}

				$tpl->assign("CATEGORY_FILTER_LIST", categoryTree());

				$all_user_must_fill_indicators = db_get_array("SELECT name FROM new_module_indicators WHERE category_id IN (".$categories.") AND status = 1", "name");

					$table="new_module_indicators";
					$tpl->assign("TABLE", $table);
					$first_result = "SELECT * FROM $table";

					if (isset($_POST['ex'])) { //Фильр
							if (isset($_POST['categoryFilter'])) {

								$_SESSION['category_id'] = intval($_POST['categoryFilter']);
								if(intval($_POST['categoryFilter']) > 0){
									$full_result = $first_result." WHERE `category_id` = '".intval($_POST['categoryFilter'])."' AND status = 1 ORDER BY name DESC";

								}else{
									$full_result = $first_result." WHERE `category_id` IN (".$categories.") AND status = 1 ORDER BY name DESC";
								}
							}

						} else {
							$full_result = $first_result." WHERE category_id IN (".$categories.") AND status = 1 ORDER BY name DESC";
						}
						// echo $full_result;
					$result = db_query($full_result);
					if ( db_num_rows($result) > 0) {
						while ($row = db_fetch_array($result)) {
							$tpl->assign("GENERAL_ID", $row['id']);
							$tpl->assign("NAME", $row['name']);
							$action = '<div class="btn-group" role="group">'; // start group
							// $action .= '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="addNewData(\''.$row['indicator_table_name'].'\')" data-original-title="'.getval("STR_ADD").'"><i class="fa fa-trash"></i> '.getval("STR_ADD").'</a>';
							$action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" href="/ru/filler_indicators/'.$row['id'].'" data-original-title="'.getval("STR_SHOW").'"><i class="fa fa-plus"></i> '.getval("STR_SHOW").'</a>';
							$action .= '</div>'; // end group

							$table_2 = $row['indicator_table_name'];
							$table_2_data = db_query("SELECT * FROM $table_2 WHERE new_user_id = " . $_SESSION['id']);
							$tpl->assign("COUNT_DATA",  db_num_rows($table_2_data));
							$category = db_get_data("SELECT name FROM new_module_indicator_categories WHERE id = " . $row['category_id'], "name");

							$tpl->assign("CATEGORY",  $category);

							$tpl->assign("BALL",  $row['ball']);
							$tpl->assign("ACTIONS", $action);
							$tpl->parse("ROWS", ".".$moduleName . "row");
						}
					}else{
						$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
						$tpl->parse("NODATA", ".".$moduleName . "nodata");
					}

			}else{
				// echo "У вас нет активных показателей для заполнения";
				$tpl->assign("ACTIVE_INDICATORS_NOT_FOUND_DISPLAY", 'style="display:none;"');
				$tpl->parse("NODATA_INDICATORS", ".".$moduleName . "nodata_indicators");
			}




			$tpl->parse(strtoupper($moduleName), $moduleName);

		}
	} else {
		header("Location: /".LANG_INDEX."/login");
		exit;
	}
