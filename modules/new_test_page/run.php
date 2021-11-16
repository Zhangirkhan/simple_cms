<?php
	$moduleName = "new_test_page";
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

		$sql = "UPDATE $table SET name = '.$name.' WHERE id = ".$general_id;
		db_query($sql);

		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/2");
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
					$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
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

			$table="new_module_indicators";
			$tpl->assign("TABLE", $table);
			$first_result = "SELECT * FROM $table";

			if (isset($_POST['ex'])) { //Фильр
					if (isset($_POST['categoryFilter'])) {

						$_SESSION['category_id'] = intval($_POST['categoryFilter']);
						if(intval($_POST['categoryFilter']) > 0){
							$full_result = $first_result." WHERE `category_id` = '".intval($_POST['categoryFilter'])."' ORDER BY name DESC";

							// $tpl->assign("FILTER".$_POST['categoryFilter'], "selected");
						}else{
							$full_result = $first_result." ORDER BY name DESC";
						}
					}


				} else {
					$full_result = $first_result." ORDER BY name DESC";
				}
			$result = db_query($full_result);
			if ( db_num_rows($result) > 0) {
				while ($row = db_fetch_array($result)) {
					$tpl->assign("GENERAL_ID", $row['id']);
					$tpl->assign("NAME", $row['name']);
					$action = '<div class="btn-group" role="group">'; // start group
					// $action .= '<a class="btn btn-success btn-sm text-white" data-toggle="tooltip" onclick="addNewData(\''.$row['indicator_table_name'].'\')" data-original-title="'.getval("STR_ADD").'"><i class="fa fa-trash"></i> '.getval("STR_ADD").'</a>';
					// $action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
					$action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" href="/ru/filler_indicators/'.$row['id'].'" data-original-title="'.getval("STR_SHOW").'"><i class="fa fa-plus"></i> '.getval("STR_SHOW").'</a>';
					$action .= '</div>'; // end group

					$table_2 = $row['indicator_table_name'];
					$table_2_data = db_query("SELECT * FROM $table_2 WHERE new_user_id = " . $_SESSION['id']);
					$tpl->assign("COUNT_DATA",  db_num_rows($table_2_data));
					$category = db_get_data("SELECT name FROM new_module_indicator_categories WHERE id = " . $row['category_id'], "name");

					$tpl->assign("CATEGORY",  $category);
					$tpl->assign("ACTIONS", $action);
					$tpl->parse("ROWS", ".".$moduleName . "row");
				}
			}else{
				$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
				$tpl->parse("NODATA", ".".$moduleName . "nodata");
			}


			$options = null;
			function categoryTree($parent_id = 0, $sub_mark = '')
				{
					$table = 'new_module_indicator_categories';
					global $options;
					$query = db_query("SELECT * FROM $table WHERE parent_id = $parent_id  ORDER BY name ASC");

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
			$tpl->parse(strtoupper($moduleName), $moduleName);

		}
	} else {
		header("Location: /".LANG_INDEX."/login");
		exit;
	}
