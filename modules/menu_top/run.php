<?php
$moduleName = "menu_top";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",
	$moduleName . "menu_row" => $prefix . "menu_row.tpl",
	$moduleName . "sub_row" => $prefix . "sub_row.tpl",
));

# SETTINGS ######################################################################

$menu_id = '';
//ЗДЕСЬ МЕНЮ
if (isset($_SESSION['type'])) {
	if ($_SESSION['type'] == 1) $menu_id = getval("MENU_ADMIN");
	if ($_SESSION['type'] == 2) $menu_id = getval("MENU_RESEARCHER");
	if ($_SESSION['type'] == 3) $menu_id = getval("MENU_FILLER");
}


$i = 0;
$out = '';
$houses_ids = '';
$flats_ids = '';

# MAIN ##########################################################################

if ($menu_id > 0) {
	$result = db_query("SELECT * FROM pages WHERE parent_id = " . $menu_id . " AND visible = 1 AND deleted = 0 ORDER BY sortfield");
	$count = db_num_rows($result);
	if ($count > 0) {
		$tpl->CLEAR("MENU_ROWS");
		while ($row = db_fetch_array($result)) {
			$i++;

			if ($row['external_link'] != '') {
				$url = $row['external_link'];
			} else {
				if ($mod_rewrite == true) $url = 'https://' . $_SERVER['SERVER_NAME'] . '/' . LANG_INDEX . '/' . $row['mod_rewrite'] . "/";
				else $url = SITE_URL . "?page_id=" . $row['id'] . "&lang=" . $row['lang_id'];
			}

			if ($row['id'] == PAGE_ID) {

				$class = 'active';
			} else {
				$class = '';
				// echo PAGE_ID;
				// echo " / ";
				// echo $row['id'];
				// echo "  ";
			}

			if ($i != $count) $border = 'border-bottom';
			else $border = '';

			if ($row['id'] == PAGE_ID) $badgeclass = 'badge badge-light';
			else $badgeclass = 'badge badge-danger';

			$out .= '<a href="' . $url . '" class="dropdown-item"><i class="' . $row['kurs'] . '"></i> ' . $row['title'] . '</a>';

			$tpl->assign("BADGECLASS", $badgeclass);
			$tpl->assign("TITLE", $row['title']);
			$tpl->assign("ICON", $row['kurs']);
			$tpl->assign("URL", $url);
			$tpl->assign("CLASS", $class);
			$tpl->assign("BORDER", $border);
			$tpl->parse("MENU_ROWS", "." . $moduleName . "menu_row");
		}
	}
}

$tpl->assign("MENU_EX", $out);
$tpl->parse(strtoupper($moduleName), $moduleName);
