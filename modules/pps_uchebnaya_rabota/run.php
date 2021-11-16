<?php
$moduleName = "pps_uchebnaya_rabota";
$prefix = "./modules/" . $moduleName . "/";

$tpl->define(array(
	$moduleName => $prefix . $moduleName . ".tpl",

));

// MAIN ####################################################################################

if (isset($_SESSION['id'])) {

// $tpl->assign("ACTION_FORMS_ROWS", '<tr>
//     <td>1</td>
//     <td>Свод на почасовую оплату труда ППС</td>
//     <td><a class="btn btn-success btn-sm text-white" href="/ru/pps_uchebnaya_single_form/" data-original-title="Заполнить"><i class="fa fa-plus"></i> ADD RECORD</a></td>
// </tr>
// ');

$tpl->assign("ACTION_FORMS_ROWS", '<tr>
    <td></td>
    <td>Извините но данный тип работ все еще в разработке</td>
    <td></td>
</tr>
');

	$tpl->parse(strtoupper($moduleName), $moduleName);
} else {
	header("Location: /" . LANG_INDEX . "/auth");
	exit;
}
