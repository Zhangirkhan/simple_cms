<?php
$moduleName = "add_knowledge";
$prefix = "modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
));

	# VARS #########################################################################################

$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); 

	# MAIN #########################################################################################

if (isset($_POST['send'])) {
	$type = intval($_POST['type']);
	$title = cleanStr($_POST['title']);
	$editor = cleanStr($_POST['editor']);

	$main_pic = '';
	$newFileName1 = '';
	$newFileName2 = '';
	$newFileName3 = '';
	$newFileName4 = '';

	if (!empty($_FILES['main_pic'])) {
		$fileParts = pathinfo($_FILES['main_pic']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['main_pic']['name'];
			$tmp_filename = $_FILES['main_pic']['tmp_name'];
			$main_pic = time()."-0.".$fileParts['extension'];

			$ret = copy($tmp_filename, "./photos/".$main_pic);
		}
	}

	$sql = "INSERT INTO module_photos SET url_photos = '".$main_pic."'";
	db_query($sql);

	$main_pic_id = db_insert_id();

	if (!empty($_FILES['file1'])) {
		$fileParts = pathinfo($_FILES['file1']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['file1']['name'];
			$tmp_filename = $_FILES['file1']['tmp_name'];
			$newFileName1 = time()."-1.".$fileParts['extension'];

			$ret = copy($tmp_filename, "./photos/".$newFileName1);
		}
	}

	if (!empty($_FILES['file2'])) {
		$fileParts = pathinfo($_FILES['file2']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['file2']['name'];
			$tmp_filename = $_FILES['file2']['tmp_name'];
			$newFileName2 = time()."-2.".$fileParts['extension'];

			$ret = copy($tmp_filename, "./photos/".$newFileName2);
		}
	}

	if (!empty($_FILES['file3'])) {
		$fileParts = pathinfo($_FILES['file3']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['file3']['name'];
			$tmp_filename = $_FILES['file3']['tmp_name'];
			$newFileName3 = time()."-3.".$fileParts['extension'];

			$ret = copy($tmp_filename, "./photos/".$newFileName2);
		}
	}

	if (!empty($_FILES['file4'])) {
		$fileParts = pathinfo($_FILES['file4']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['file4']['name'];
			$tmp_filename = $_FILES['file4']['tmp_name'];
			$newFileName4 = time()."-4.".$fileParts['extension'];

			$ret = copy($tmp_filename, "./photos/".$newFileName2);
		}
	}

	$id_array = '';
	$images_array = [$newFileName1, $newFileName2, $newFileName3, $newFileName4];
	foreach ($images_array as $key => $value) {
		if ($value != "") {
			$sql = "INSERT INTO module_photos SET url_photos = '".$value."'";
			db_query($sql);

			$id_array[] = db_insert_id();
		}
	}

	$photo_id = serialize($id_array);

	$sql = "INSERT INTO module_knowledgebases SET time_create = NOW(), user_id = ".$_SESSION['id'].", user_type_id = ".$_SESSION['type'].", main_pic = '".$main_pic_id."', type_knowledgebase_id = '".$type."', title = '".$title."', text = '".$editor."', photos_id = '".$photo_id."', status = 1";
	db_query($sql);

	header("Location: /".LANG_INDEX."/edit_knowledge/".db_insert_id()."");
	exit;	
}

if (isset($_SESSION['id'])) {
	$type_list = db_get_array("SELECT * FROM module_knowledgebases_types", "id", "title");
	assignList("TYPE_LIST", $type_list);

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /".LANG_INDEX."/auth");
	exit;
}

	// ???????????? ?????? ???????????? ??????????

if (isset($_SESSION['type'])) {
	
	if ($_SESSION['type'] == 1) {
		
		$knowlege_link = "/ru/knowledge_uk/";

	}

	if ($_SESSION['type'] == 2) {
		
		$knowlege_link = "/ru/knowledge_osi/";

	}

	if ($_SESSION['type'] == 3) {
		
		$knowlege_link = "/ru/knowledge_citizen/";

	}

	if ($_SESSION['type'] == 4) {
		
		$knowlege_link = "/ru/knowledge_uk/";

	}

	if ($_SESSION['type'] == 5) {
		
		$knowlege_link = "/ru/knowledge_uk/";

	}

}

$tpl->assign("KNOWLEGE_LINK", $knowlege_link);

?>