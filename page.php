<?php
define("IN_SITEDRIVE", 1);

ob_start("ob_gzhandler", 9);

require_once('./admin/includes/config.php');			// Настройки SiteDrive
require_once('./admin/includes/values.php');			// Работа с константами
require_once('./common.php');							// SiteDrive API and initialize
require_once("./admin/includes/template.php");		// FastTemplate
require_once('./class.Pages.php');						// Разбивка по страницам

# MAIN ####################################################################################

Initialize($_REQUEST);

db_connect(DB_HOST, DB_LOGIN, DB_PASSWORD);
db_select_db(DB_NAME);

// Инициализируем page_id и lang_id
setValidPage();

session_start();

$mod_rewrite = true;

global $tpl_name;
global $tpl_phone;
global $tpl_image;

if ($mod_rewrite == true) {
	$lang_id = intval($_GET['lang']);

	if (isset($_GET['parent_name'])) {
		$parent_id = db_get_data("SELECT id FROM pages WHERE mod_rewrite = '" . $_GET['name'] . "' AND lang_id = " . $lang_id . " AND deleted = 0 AND visible = 1 LIMIT 1", "id");
		$page_id = db_get_data("SELECT id FROM pages WHERE mod_rewrite = '" . $_GET['parent_name'] . "' AND parent_id = " . $parent_id . " AND lang_id = " . $lang_id . " AND deleted = 0 AND visible = 1 LIMIT 1", "id");
	} else {
		$page_id = db_get_data("SELECT id FROM pages WHERE mod_rewrite = '" . $_GET['name'] . "' AND lang_id = " . $lang_id . " AND deleted = 0 AND visible = 1 LIMIT 1", "id");
	}

	if ($_GET['lang'] == 1) $lang_index = 'ru';
	if ($_GET['lang'] == 2) $lang_index = 'en';
	if ($_GET['lang'] == 3) $lang_index = 'kz';

	define("PAGE_ID", $page_id);
	define("LANG_ID", $_GET['lang']);
	define("LANG_INDEX", $lang_index);
	define("SITE_PATH", SITE_URL . "?page_id=" . PAGE_ID . "&lang=" . LANG_ID);
} else {
	define("PAGE_ID", $_GET['page_id']);
	define("LANG_ID", $_GET['lang']);
	define("SITE_PATH", SITE_URL . "?page_id=" . PAGE_ID . "&lang=" . LANG_ID);
}
// Проверяем существует ли данная страница
if (!isPageExists(PAGE_ID, LANG_ID)) {
	header("Location: ../error404.html");
	//header("Location: /".LANG_INDEX."/error404.html");
	exit;
	//selfRedirect();
}

$_pages  = new Pages(15, 10);

// Получаем кодировку страницы
$encoding = db_get_data("SELECT encoding FROM languages WHERE id = " . LANG_ID . " LIMIT 1", "encoding");
if (empty($encoding)) $encoding = 'utf-8';
header('Content-type: text/html; charset=' . $encoding);
define("PAGE_ENCODING", $encoding);

// Получаем страницу
$_PAGE = db_get_data("SELECT * FROM pages WHERE id = " . PAGE_ID . " LIMIT 1");

// Подгружаем шаблон
if (!file_exists(PAGETEMPLATES_PATH . $_PAGE['template'])) die('Error. Page template not found.');

$tpl = new FastTemplate(".");
$tpl->define(array("page" => PAGETEMPLATES_PATH . $_PAGE['template']));

# PAGE GENERATE ##########################################################################

$tpl->assign("CONTENT", $_PAGE['content']);

// Разбор шаблона
$modules = array();
$template = file_get_contents(PAGETEMPLATES_PATH . $_PAGE['template']);
$template = str_replace("{CONTENT}", $_PAGE['content'], $template);

preg_match_all("/{([A-Z0-9_]*)}/e", $template, $modules);

// Вставка модулей
foreach ($modules[0] as $i => $name) {
	if ($name != "{CONTENT}" && $name != "{LANG}") {
		$name = str_replace("{", '', $name);
		$name = str_replace("}", '', $name);
		if (is_file('./modules/' . strtolower($name) . "/run.php")) {
			include_once('./modules/' . strtolower($name) . "/run.php");
		}
	}
}

$tpl->assign(array(
	"LANG_ID" => LANG_ID,
	"LANG_INDEX" => LANG_INDEX,
	"PAGE_ID" => PAGE_ID,
	"PAGE_ENCODING" => PAGE_ENCODING,
	"SITE_TPL_URL" => $_SERVER['REQUEST_URI']
));

# START MODIFY SECTION ###################################################################

// $out = '';
// $result = db_query("SELECT * FROM module_banners WHERE page_id = " . getval("SLIDER_PAGE_ID") . " AND lang_id = " . LANG_ID . " AND display = 1 ORDER BY sortfield");
// if ($result) {
// 	while ($row = db_fetch_array($result)) {
// 		$img_url = getImageUrl($row['icon'], true);

// 		$out .= '<div><img src="' . $img_url . '" class="im2"></div>';
// 	}
// }
// $tpl->assign("SLIDER_ROWS", $out);

$lang_link_uri = substr($_SERVER['REQUEST_URI'], 4);

//По типу пользователя выводим информацию на в меню
if (isset($_SESSION['type'])) {
		$tpl_user = db_get_data("SELECT fio, username, user_type_id  FROM new_module_users WHERE id = " . $_SESSION['id']);
		$user_type = db_get_data("SELECT value FROM new_module_user_types WHERE id = " . $tpl_user['user_type_id'], "value");
		$many_departments_and_users = db_query("SELECT department_id FROM new_module_many_departments_and_users WHERE new_user_id = '". $_SESSION['id']."'");
		$departament_name = null;

		if (db_num_rows($many_departments_and_users) > 0) {
			while ($user = db_fetch_array($many_departments_and_users)) {
				$departament_name .= db_get_data("SELECT name FROM new_module_departments WHERE id = " . $user['department_id'], "name"). "</br>";
			}
		}else{
				$departament_name .= '<p class="text-red">Вы не работаете ни в одном из департаментов</p>';
		}

	$image = '../assets/images/users/empty_logo.png';

	$tpl->assign("TPL_NAME_VALUE", $tpl_user['fio']);
	$tpl->assign("TPL_USER_NAME_VALUE", $tpl_user['username']);
	$tpl->assign("TPL_IMAGE_VALUE", $image);
	$tpl->assign("TPL_TYPE_VALUE", $user_type);
	$tpl->assign("TPL_DEPARTAMENT_VALUE", $departament_name);
}

// Формируем массив названий месяцев
$_MONTHS = choose(LANG_ID, $_MONTHS_RU, $_MONTHS_EN, $_MONTHS_KZ);
$lang_switch = choose(
	LANG_ID,
	'<a href="/ru/' . $lang_link_uri . '" class="ln1">Рус</a>&nbsp;&nbsp;&nbsp;<a href="/en/' . $lang_link_uri . '" class="ln2">En</a>',
	'<a href="/ru/' . $lang_link_uri . '" class="ln2">Рус</a>&nbsp;&nbsp;&nbsp;<a href="/en/' . $lang_link_uri . '" class="ln1">En</a>',
	''
);

$tpl->assign("LANG_SWITCH", $lang_switch);
$tpl->assign("WINDOW_PAGE_TITLE", $_PAGE['title']);

$tpl->assign("CSS_VERSION", "3.4.5");


// $

	$options = null;
	function DepartmentTreeOptions($parent_id = 0, $sub_mark = ''){
		global $options;
		$query = db_query("SELECT * FROM new_module_departments WHERE parent_id = $parent_id   ORDER BY name ASC");

		if (db_num_rows($query) > 0) {
			while ($row = db_fetch_array($query)) {
				$options .= '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
				DepartmentTreeOptions($row['id'], $sub_mark . '---');
			}
		}
		return $options;
	}

	$tpl->assign("DEPARTMENTS_LIST", DepartmentTreeOptions());

# END MODIFY SECTION #####################################################################

$tpl->parse("FINAL", "page");




// Вставляем изображения
$tpl->FINAL = addImages($tpl->FINAL);

// Подменяем строковые значения в шаблонах и удаляем пустые метки
$tpl->FINAL = parse_values($tpl->FINAL);
$tpl->clear_unassigned_tags();

$tpl->FastPrint();
