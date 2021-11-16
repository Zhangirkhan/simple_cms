<?php
	$moduleName = "new_module_admin_universitets";
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
		 try{
		$table = cleanStr($_POST['table']);
		$name = cleanStr($_POST['name']);


		$sql = "INSERT INTO $table SET name = '" . $name . "'";
		db_query($sql);

		header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/1");
		exit;
		 }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                       header("Location: /" . LANG_INDEX . "/" . $_PAGE['mod_rewrite'] . "/3");
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

		$table="new_module_universities";
		$tpl->assign("TABLE", $table);
		$result = db_query("SELECT * FROM $table");
		$count = db_num_rows($result);
		if ($count > 0) {
			while ($row = db_fetch_array($result)) {
				$tpl->assign("GENERAL_ID", $row['id']);
				$tpl->assign("NAME", $row['name']);
				$action = '<div class="btn-group" role="group" aria-label="Basic example">'; // start group
				$action .= '<a class="btn btn-primary btn-sm text-white" data-toggle="tooltip" onclick="newSHOWEditId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_EDIT").'"><i class="fa fa-trash"></i> '.getval("STR_EDIT").'</a>';
				$action .= '<a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" onclick="newDeleteId(\''.$table.'\',' . $row['id'] . ')" data-original-title="'.getval("STR_DELETE").'"><i class="fa fa-trash"></i> '.getval("STR_DELETE").'</a>';
				$action .= '</div>'; // end group
				$tpl->assign("ACTIONS", $action);
				$tpl->parse("ROWS", ".".$moduleName . "row");
			}
		}else{
			$tpl->assign("NODATA_DISPLAY", 'style="display:none;"');
			$tpl->parse("NODATA", ".".$moduleName . "nodata");
		}

		$tpl->parse(strtoupper($moduleName), $moduleName);
	} else {
		header("Location: /".LANG_INDEX."/login");
		exit;
	}
