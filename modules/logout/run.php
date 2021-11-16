<?php
	$moduleName = "logout";
	$prefix = "./modules/".$moduleName."/";

	# MAIN #################################################################################

	session_destroy();

	header("Location: /".LANG_INDEX."/login");
	exit;
?>
