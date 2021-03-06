<?php
	$moduleName = "menu_top2";
	$prefix = "./modules/" . $moduleName . "/";
	
	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
			$moduleName . "menu_row" => $prefix . "menu_row.tpl",
		));
	
	# SETTINGS ######################################################################
	
	$menu_id = getPageID("{".$moduleName."}", LANG_ID);
	$i = 0;
		
	# MAIN ##########################################################################
	
	if (isset($menu_id) > 0) {
		$result = db_query("SELECT * FROM pages WHERE parent_id = ".$menu_id." AND visible = 1 AND deleted = 0 ORDER BY sortfield");
		if ($result) {
			$tpl->CLEAR("MENU_ROWS2");
			while ($row = db_fetch_array($result)) {
				if ($row['external_link'] != '') {
					$url = $row['external_link'];
				} else {
					if ($mod_rewrite == true) $url = 'http://'.$_SERVER['SERVER_NAME'].'/'.LANG_INDEX.'/'.$row['mod_rewrite']."/";
						else $url = SITE_URL."?page_id=".$row['id']."&lang=".$row['lang_id'];
				}

				$tpl->assign("URL", $url);
				$tpl->assign("TITLE", $row['title']);
				$tpl->parse("MENU_ROWS2", ".".$moduleName . "menu_row");	
			}
		}
	}
	if(isset($_SESSION['id'])){
		$tpl->assign("LOGIN", "");
		$tpl->assign("DROPDOWN", "dropdown");
	}else{
		$tpl->assign("LOGIN", "Войти");
		$tpl->assign("DROPDOWN", "");
	}
	
	$tpl->parse(strtoupper($moduleName), $moduleName);
?>