<?php
define("IN_SITEDRIVE", 1);
session_start();
# INCLUDES ##############################################################################
require_once('./common.php'); // SiteDrive API and initialize
require_once('./admin/includes/config.php'); // Настройки SiteDrive
require_once('./admin/includes/values.php'); // Работа с константами
# MAIN ##################################################################################
db_connect(DB_HOST, DB_LOGIN, DB_PASSWORD);
db_select_db(DB_NAME);

# VARIABLES #############################################################################
$lang_index = 'ru';

 $options = null;
function  categoryTreeOptions($parent_id = 0, $sub_mark = ''){
	global $options;
	$query = db_query("SELECT * FROM new_module_departments WHERE parent_id = $parent_id   ORDER BY name ASC");

	if (db_num_rows($query) > 0) {
		while ($row = db_fetch_array($query)) {
			$options .= '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
			categoryTreeOptions($row['id'], $sub_mark . '---');
		}
	}
	return $options;
}

function  categoryIndicatorsTreeOptions($parent_id = 0, $sub_mark = ''){
	global $options;
	$query = db_query("SELECT * FROM new_module_indicator_categories WHERE parent_id = $parent_id   ORDER BY name ASC");

	if (db_num_rows($query) > 0) {
		while ($row = db_fetch_array($query)) {
			$options .= '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
			categoryIndicatorsTreeOptions($row['id'], $sub_mark . '---');
		}
	}
	return $options;
}



function logging($request_id, $description, $who_type, $who_id)
{
    $sql = "INSERT module_logging SET request_id = '" . $request_id . "',
											description = '" . $description . "',
											who_type = '" . $who_type . "',
											who_id = '" . $who_id . "',
											time_create = NOW()";
    db_query($sql);
}

$author_id = $_SESSION['id'];
$author_type = $_SESSION['type'];
function noticeUsers($author_id, $author_type, $for_id, $for_type, $title, $description, $house_id, $flat_id)
{
    $sql = "INSERT module_notifications SET author_id = '" . $author_id . "',
											author_type = '" . $author_type . "',
											for_id = '" . $for_id . "',
											for_type = '" . $for_type . "',
											title = '" . $title . "',
											description = '" . $description . "',
											house_id = '" . $house_id . "',
											flat_id = '" . $flat_id . "',
											time_create = NOW()";
    db_query($sql);
}

if (isset($_POST['type'])) {
    if ($_POST['type'] == "html-request") {



        // меняем статус в модуле my_houses_osi
        if ($_POST['action'] == 1) {
            $id = intval($_POST['id']);
            $status = intval($_POST['status']);

            $sql = "UPDATE module_houses SET status = '" . $status . "' WHERE id = " . $id;
            db_query($sql);

            $out = $status + 1;
        }


        // получаем список домов по илице
        // if ($_POST['action'] == 2) {
        //     $street = cleanStr($_POST['value']);

        //     $out .= '<option selected="selected">' . getval("STR_SELECT_HOUSE_NUMBER_TITLE") . '</option>';

        //     $result = db_query("SELECT * FROM module_houses WHERE street = '" . $street . "' AND status = 1 ORDER BY id");
        //     if (db_num_rows($result) > 0) {
        //         while ($row = db_fetch_array($result)) {
        //             $out .= '<option value="' . $row['house_number'] . '">' . $row['house_number'] . '</option>';
        //         }
        //     }
        // }

        if ($_POST['action'] == 3) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_flats_citizens WHERE id = " . $id;
            $connect = db_get_data("SELECT * from module_flats_citizens WHERE flat_id = " . $id);
            $citizens = db_get_data("SELECT * from module_citizens WHERE id = " . $connect['citizen_id']);

            $fullData = db_get_data("SELECT t1.*, t2.osi_id, t2.house_id, t2.flat_number, t2.city_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id =" . $id);
            $city = db_get_data("SELECT name FROM module_cities WHERE id = " . $fullData['city_id'], "name");
            $street = db_get_data("SELECT street FROM module_houses WHERE id = " . $fullData['house_id'], "street");
            $house_number = db_get_data("SELECT house_number FROM module_houses WHERE id = " . $fullData['house_id'], "house_number");

            $fullAdress .= '' . $city . ', ' . getval("STR_STREET_SOKR_TITLE") . ' ' . $street . ' ' . $house_number . ', ' . getval("STR_FLAT_SOKR_TITLE") . ' ' . $fullData['flat_number'] . '';
            noticeUsers($_SESSION['id'], $_SESSION['type'], $fullData['osi_id'], 2, 'Квартира удалена', 'Житель: <b>' . $citizens['name'] . ' </b> удалил(а) квартиру по адресу: <b> ' . $fullAdress . '</b>', 0, $fullData['flat_id']);

            db_query($sql);

            // $sql = "DELETE FROM module_flats WHERE id = " . $id;
            //  db_query($sql);
        }

        if ($_POST['action'] == 4) { // Жангирхан сделал
            $id = intval($_POST['id']);
            $status = intval($_POST['status']);

            $sql = "UPDATE module_osi_and_ucs SET status = " . $status . " WHERE id = " . $id;
            $connect = db_get_data("SELECT * from module_osi_and_ucs WHERE id = " . $id);
            if ($_SESSION['type'] == 2) {
                $who = $connect['ucs_id'];
                $who_type = 1;
                $uc_data = db_get_data("SELECT * from module_ucs WHERE id = " . $connect['ucs_id']);
                if ($status == 2) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Деактивация УК', 'ОСИ деактивировала УК: <b>' . $uc_data['name'] . '</b>', 0, 0);

                    //проверка новая УК

                    if ($new_entry == 0) {

                        $out = 2;
                    } else if ($new_entry) {

                        $out = 1;
                    }
                } else if ($status == 1) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Активация УК', 'ОСИ активировала УК: <b>' . $uc_data['name'] . '</b>', 0, 0);

                    //проверка новая УК

                    if ($new_entry == 0) {

                        $out = 2;
                    } else if ($new_entry) {

                        $out = 3;
                    }
                }
            } else if ($_SESSION['type'] == 1) {
                $who = $connect['osi_id'];
                $who_type = 2;
                $osi_data = db_get_data("SELECT * from module_osi WHERE id = " . $connect['osi_id']);
                if ($status == 2) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Деактивация ОСИ', 'УК деактивировала ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);

                    //проверка новая ОСИ

                    if ($new_entry == 0) {

                        $out = 2;
                    } else if ($new_entry) {

                        $out = 1;
                    }
                } else if ($status == 1) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Активация ОСИ', 'УК активировала ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);

                    //проверка новая ОСИ

                    if ($new_entry == 0) {

                        $out = 2;
                    } else if ($new_entry) {

                        $out = 3;
                    }
                }
            }

            db_query($sql);
        }

        if ($_POST['action'] == 5) {
            $id = intval($_POST['id']);
            $status = intval($_POST['status']);

            $sql = "UPDATE module_flats_citizens SET status = " . $status . " WHERE id = " . $id;

            $connect = db_get_data("SELECT * from module_flats_citizens WHERE id = " . $id);
            $flat_data = db_get_data("SELECT * from module_flats WHERE id = " . $connect['flat_id']);
            if ($_SESSION['type'] == 2) {
                $who = $connect['citizen_id'];
                $who_type = 3;
                $osi_data = db_get_data("SELECT * from module_osi WHERE id = " . $flat_data['osi_id']);

                $citizen_data = db_get_data("SELECT * from module_citizens WHERE id = " . $connect['citizen_id']);

                $fullData = db_get_data("SELECT t1.*, t2.osi_id, t2.house_id, t2.flat_number, t2.city_id FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id =" . $id);
                $city = db_get_data("SELECT name FROM module_cities WHERE id = " . $fullData['city_id'], "name");
                $street = db_get_data("SELECT street FROM module_houses WHERE id = " . $fullData['house_id'], "street");
                $house_number = db_get_data("SELECT house_number FROM module_houses WHERE id = " . $fullData['house_id'], "house_number");

                $fullAdress .= '' . $city . ', ' . getval("STR_STREET_SOKR_TITLE") . ' ' . $street . ' ' . $house_number . ', ' . getval("STR_FLAT_SOKR_TITLE") . ' ' . $fullData['flat_number'] . '';

                if ($status == 0) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Деактивация жителя', 'ОСИ: <b>' . $osi_data['name'] . '</b> деактивировала жителя: <b>' . $citizen_data['name'] . '</b> живущего по адресу: <b>' . $fullAdress . '</b>', 0, $flat_data['id']);
                } else if ($status == 1) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Активация жителя', 'ОСИ: <b>' . $osi_data['name'] . '</b> активировала жителя: <b>' . $citizen_data['name'] . '</b> живущего по адресу: <b>' . $fullAdress . '</b>', 0, $flat_data['id']);
                }
            } else if ($_SESSION['type'] == 1) {
                $who = $connect['osi_id'];
                $who_type = 2;

                $uc_data = db_get_data("SELECT * from module_ucs WHERE id = " . $_SESSION['id']);

                $osi_data = db_get_data("SELECT * from module_osi WHERE id = " . $flat_data['osi_id']);
                if ($status == 0) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Деактивация ОСИ', 'УК: <b>' . $uc_data['name'] . '</b> деактивировала ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);
                } else if ($status == 1) {
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $who, $who_type, 'Деактивация ОСИ', 'УК: <b>' . $uc_data['name'] . '</b> активировала ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);
                }
            }

            db_query($sql);

            $sql = "UPDATE module_flats SET status = " . $status . " WHERE id = " . $connect['flat_id'];
            db_query($sql);
        }

        // получаем управляющие компании по городу
        if ($_POST['action'] == 6) {
            $id = cleanStr($_POST['id']);

            $out .= '<option selected="selected">' . getval("STR_SELECT_UC_NAME") . '</option>';

            $result = db_query("SELECT * FROM module_ucs WHERE city_id = '" . $id . "' AND status = 1 ORDER BY id");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $out .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
        }

        // Удаляем связь между УК и ОСИ
        if ($_POST['action'] == 7) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_osi_and_ucs WHERE id = " . $id;
            db_query($sql);

            $out = 2;
        }

        // получение статуса
        if ($_POST['action'] == 8) {
            $id = intval($_POST['id']);
            $status = intval($_POST['status']);

            if ($status == 3) {
                $sql = "UPDATE module_requests SET request_status_inner_id = " . $status . " WHERE id = " . $id . "";
            } else {
                $sql = "UPDATE module_requests SET request_status_id = " . $status . ", request_status_inner_id = 0 WHERE id = " . $id . "";
            }

            db_query($sql);
        }

        // не удалять жангир написал)
        if ($_POST['action'] == 9) {
            $id = intval($_POST['id']);

            $who = intval($_POST['who']);
            $who_type = intval($_POST['who_type']);

            $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);

            if ($request['uc_id'] == 0) {
                $for_id_id = $request['osi_id'];
                $for_type_type = 2;
            } else {
                $for_id_id = $request['uc_id'];
                $for_type_type = 1;
            }

            $citizen_data = db_get_data("SELECT * from module_citizens WHERE id = " . $_SESSION['id']);

            noticeUsers($_SESSION['id'], $_SESSION['type'], $for_id_id, $for_type_type, 'Заявка удалена', 'Житель: <b>' . $citizen_data['name'] . '</b> удалил(а) заявку <b>#' . $request['id'] . '</b>', 0, 0);

            $sql = "DELETE FROM module_requests WHERE id = " . $id;

            db_query($sql);
        }

        // Меняем статус принятия у всех
        #Статусы принятия (accepted)
        #	0 - новая заявка
        #	1 - принятая завка
        #	2 - не принятая заявка
        #	3 - ожидает оценки
        #	4 - выполненная заявка
        #	5 - не выполненная заявка
        if ($_POST['action'] == 10) {
            $id = intval($_POST['id']);
            $status = intval($_POST['status']);
            $name = intval($_POST['name']);

            $who = intval($_POST['who']);
            $who_type = intval($_POST['who_type']);

            if ($name == 1) {
                if ($status == 1) {
                    $nameAccepted = "uc_accepted";
                    $sql = "UPDATE module_requests SET " . $nameAccepted . " = " . $status . "  WHERE id = " . $id . "";
                    $uc_data = db_get_data("SELECT name, phone from module_ucs WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка была принята Управляющей Компанией: ' . $uc_data['name'] . ' / ' . $uc_data['phone'], $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);

                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['osi_id'], 2, 'Заявка принята', 'УК: <b>' . $uc_data['name'] . '</b> принял(а) заявку <b> #' . $id . '</b>', 0, 0);

                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка принята', 'УК: <b>' . $uc_data['name'] . '</b> принял(а) заявку <b> #' . $id . '</b>', 0, 0);
                } else if ($status == 11) {
                    $nameAccepted = "uc_accepted";
                    $sql = "UPDATE module_requests SET " . $nameAccepted . " = 1, request_status_id = 1  WHERE id = " . $id . "";
                    $uc_data = db_get_data("SELECT name, phone from module_ucs WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка была принята Управляющей Компанией: ' . $uc_data['name'] . ' / ' . $uc_data['phone'], $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);

                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['osi_id'], 2, 'Заявка принята', 'УК: <b>' . $uc_data['name'] . '</b> принял(а) заявку <b> #' . $id . '</b>', 0, 0);

                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка принята', 'УК: <b>' . $uc_data['name'] . '</b> принял(а) заявку <b> #' . $id . '</b>', 0, 0);
                }
            } else if ($name == 2) {
                $nameAccepted = "osi_accepted";

                if ($status == 1) {
                    //$sql = "UPDATE module_requests SET ".$nameAccepted." = ".$status." WHERE id = ".$id."";
                    $sql = "UPDATE module_requests SET request_status_id = 1," . $nameAccepted . " = " . $status . " WHERE id = " . $id . "";
                    $osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = " . $who);

                    logging($id, 'Заявка была принята ОСИ', $who_type, $who);
                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка принята', 'ОСИ: <b>' . $osi_data['name'] . '</b> принял(а) заявку <b> #' . $id . '</b>', 0, 0);
                } else if ($status == 2) {

                    $sql = "UPDATE module_requests SET request_status_id = 2," . $nameAccepted . " = " . $status . " WHERE id = " . $id . "";
                    $osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка была взята в работу самим ОСИ', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка взята в работу самим ОСИ', 'ОСИ: <b>' . $osi_data['name'] . '</b> самостоятельно взялся выполнить заявку <b> #' . $id . '</b>', 0, 0);
                } else if ($status == 3) {
                    $sql = "UPDATE module_requests SET request_status_id = 3, " . $nameAccepted . " = 3 WHERE id = '" . $id . "'";
                    $osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка ожидает оценки:', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка выполнена и ожидает оценки', 'Заявка <b>#' . $id . '</b> выполнена и ожидает оценки', 0, 0);
                } else if ($status == 4) {
                    $sql = "UPDATE module_requests SET request_status_id = 1, " . $nameAccepted . " = 1, uc_id = 0 WHERE id = '" . $id . "'";
                    $osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = " . $_SESSION['id']);
                    logging($id, 'Перенаправление заявки было отменено', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Перенаправление было отменено', 'Перенаправление заявки было отменено ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['uc_id'], 1, 'Перенаправление было отменено', 'Перенаправление заявки было отменено ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);
                }
            } else if ($name == 3) {
                $nameAccepted = "citizen_accepted";
            } else if ($name == 4) {
                $nameAccepted = "worker_uc_accepted";

                if ($status == 3) {
                    $sql = "UPDATE module_requests SET request_status_id = 3, " . $nameAccepted . " = 3 WHERE id = '" . $id . "'";
                    $worker_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка ожидает оценки', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка ожидает оценки', 'Cотрудник УК: <b>' . $worker_data['name'] . '</b> выполнил заявку #' . $id . ' и ожидает оценки', 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['osi_id'], 2, 'Заявка ожидает оценки', 'Cотрудник УК: <b>' . $worker_data['name'] . '</b> выполнил заявку #' . $id . ' и ожидает оценки', 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['uc_id'], 1, 'Заявка ожидает оценки', 'Cотрудник УК: <b>' . $worker_data['name'] . '</b> выполнил заявку #' . $id . ' и ожидает оценки', 0, 0);
                } else if ($status == 4) {
                    $sql = "UPDATE module_requests SET request_status_id = 4, " . $nameAccepted . " = 1 WHERE id = '" . $id . "'";
                    $worker_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка была выполнена', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка выполнена', 'Cотрудник УК: <b>' . $worker_data['name'] . '</b> выполнил заявку #' . $id . '', 0, 0);
                } else if ($status == 5) {
                    $sql = "UPDATE module_requests SET request_status_id = 5, " . $nameAccepted . " = 2 WHERE id = '" . $id . "'";
                    $worker_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка была не выполнена', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка не выполнена', 'Сотрудник УК: <b>' . $worker_data['name'] . '</b> не выполнил заявку #' . $id . '', 0, 0);
                } else {
                    $sql = "UPDATE module_requests SET request_status_id = 2, " . $nameAccepted . " = '" . $status . "' WHERE id = '" . $id . "'";
                    $worker_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = " . $_SESSION['id']);
                    logging($id, 'Заявка была взята в работу', $who_type, $who);

                    $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 3, 'Заявка в работе', 'Сотрудник УК: <b>' . $worker_data['name'] . '</b> взял заявку #' . $id . ' в работу', 0, 0);
                }
            } else if ($name == 5) {
                $nameAccepted = "manager_uc_accepted";
            }

            db_query($sql);
        }

        // Меняем статус у любой заявки
        // if ($type == 1) $table = 'module_ucs';
        // if ($type == 2) $table = 'module_osi';
        // if ($type == 3) $table = 'module_citizens';
        // if ($type == 4) $table = 'module_worker_uc';
        // if ($type == 5) $table = 'module_manager_uc';
        if ($_POST['action'] == 11) {
            $id = intval($_POST['id']);
            $name = cleanStr($_POST['name']);
            if ($name == 1) {
                $nameAccepted = "uc_accepted";
            } else if ($name == 2) {
                $nameAccepted = "osi_accepted";
            } else if ($name == 3) {
                $nameAccepted = "citizen_accepted";
            } else if ($name == 4) {
                $nameAccepted = "worker_uc_accepted";
            } else if ($name == 5) {
                $nameAccepted = "manager_uc_accepted";
            }
            $accept = cleanStr($_POST['accept']);
            $status = intval($_POST['status']);
            $sql = "UPDATE module_requests SET request_status_id = " . $status . ", " . $nameAccepted . " = " . $accept . " WHERE id = " . $id . "";
            db_query($sql);
        }

        if ($_POST['action'] == 12) {
            $id = intval($_POST['id']);
            $name = intval($_POST['name']);
            if ($name == 1) {
                $nameAccepted = "uc_accepted";
            } else if ($name == 2) {
                $sql = "INSERT into module_requests(city_id, osi_id, house_id, flat_id, uc_id, description , photo_i, type_id, request_status_id, time_create) select city_id, osi_id, house_id, flat_id,  uc_id, description , photo_i, type_id, 11, NOW() from module_requests where id = " . $id . ";";

                $nameAccepted = "osi_accepted";
                $osi_data = db_get_data("SELECT name, phone from module_osi WHERE id = " . $_SESSION['id']);

                $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                noticeUsers($_SESSION['id'], $_SESSION['type'], $request['uc_id'], 1, 'Заявка продублирована', 'Заявка: <b>#' . $id . '</b> была продублирована ОСИ: <b>' . $osi_data['name'] . '</b>', 0, 0);
            } else if ($name == 3) {
                $sql = "INSERT into module_requests(city_id, osi_id, house_id, flat_id, citizen_id, description , photo_i, type_id, request_status_id, time_create) select city_id, osi_id, house_id, flat_id, citizen_id, description , photo_i, type_id, 11, NOW() from module_requests where id = " . $id . ";";

                $nameAccepted = "citizen_accepted";
                $citizen_data = db_get_data("SELECT name, phone from module_citizens WHERE id = " . $_SESSION['id']);

                $request = db_get_data("SELECT * from module_requests WHERE id = " . $id);
                noticeUsers($_SESSION['id'], $_SESSION['type'], $request['citizen_id'], 1, 'Заявка продублирована', 'Заявка: <b>#' . $id . '</b> была продублирована жителем: <b>' . $citizen_data['name'] . '</b>', 0, 0);
            } else if ($name == 4) {
                $nameAccepted = "worker_uc_accepted";
            } else if ($name == 5) {
                $nameAccepted = "manager_uc_accepted";
            }

            $new_id = db_query($sql);
            logging($id, 'Заявка была дублирована: ' . $new_id, $_SESSION['type'], $_SESSION['id']);
        }

        if ($_POST['action'] == 13) {

            $id = intval($_POST['id']);
            $result = "";
            $out = "";
            $result = db_query("SELECT * from module_logging WHERE request_id = " . $id . " ORDER BY time_create DESC");
            if (db_num_rows($result) > 0) {

                while ($row = db_fetch_array($result)) {

                    $who_type = $row['who_type'];
                    if ($who_type == 1) {
                        $who_data = db_get_data("SELECT name, phone from module_ucs WHERE id = " . $row['who_id']);
                        $type = "Управляющая компания";
                    } else if ($who_type == 2) {
                        $who_data = db_get_data("SELECT name, phone from module_osi WHERE id = " . $row['who_id']);
                        $type = "Объеденение Собственников Иммущества";
                    } else if ($who_type == 3) {
                        $who_data = db_get_data("SELECT name, phone from module_citizens WHERE id = " . $row['who_id']);
                        $type = "Житель";
                    } else if ($who_type == 4) {
                        $who_data = db_get_data("SELECT name, phone from module_worker_uc WHERE id = " . $row['who_id']);
                        $type = "Сотрудник компании";
                    } else if ($who_type == 5) {
                    }
                    $out .= '<tr>
						<td>
						  ' . date("d.m.Y H:i s", strtotime($row['time_create'])) . '
						</td>
						<td style="white-space: normal">' . $row['description'] . '</td>
						<td>' . $who_data['name'] . ' <br/> ' . $who_data['phone'] . '</td>
						<td>
						   ' . $type . '
						</td>

					 </tr>';
                }
            }
            //echo $out;

        }

        // деактивация голосования
        if ($_POST['action'] == 14) {
            $sql = "UPDATE module_polls SET `active` = 1 WHERE id = " . intval($_POST['id']);
            db_query($sql);
        }

        // активация голосования
        if ($_POST['action'] == 15) {
            $sql = "UPDATE module_polls SET `active` = 0 WHERE id = " . intval($_POST['id']);
            db_query($sql);
        }

        // активация и деактивация
        if ($_POST['action'] == 16) {
            $id = intval($_POST['id']);
            $worker_type = $_POST['worker_type'];
            $activeStatus = $_POST['activeStatus'];

            if ($activeStatus == 'Неактивный') {
                if ($worker_type == 'Менеджер') {
                    $sql = "UPDATE module_manager_uc SET status = 1 WHERE id = " . $id;
                    $manager_data = db_get_data("SELECT * from module_manager_uc WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $id, 5, 'Менеджер активирован', 'Менеджер был активирован: <b>' . $manager_data['name'] . '</b>', 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $manager_data['uc_id'], 1, 'Менеджер активирован', 'Менеджер был активирован: ' . $manager_data['name'], 0, 0);
                } else {
                    $sql = "UPDATE module_worker_uc SET status = 1 WHERE id = " . $id;
                    $worker_data = db_get_data("SELECT * from module_worker_uc WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $id, 4, 'Сотрудник активирован', 'Сотрудник был активирован: <b>' . $worker_data['name'], 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $worker_data['uc_id'], 1, 'Сотрудник активирован', 'Сотрудник был активирован: ' . $worker_data['name'] . '</b>', 0, 0);
                }
                $out = 2; //вот так указываеш что это второй таб
            } else {
                if ($worker_type == 'Менеджер') {
                    $sql = "UPDATE module_manager_uc SET status = 0 WHERE id = " . $id;
                    $manager_data = db_get_data("SELECT * from module_manager_uc WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $id, 5, 'Менеджер деактивирован', 'Менеджер был деактивирован: <b>' . $manager_data['name'], 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $manager_data['uc_id'], 1, 'Менеджер деактивирован', 'Менеджер был деактивирован: ' . $manager_data['name'] . '</b>', 0, 0);
                } else {
                    $sql = "UPDATE module_worker_uc SET status = 0 WHERE id = " . $id;
                    $worker_data = db_get_data("SELECT * from module_worker_uc WHERE id = " . $id);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $id, 4, 'Сотрудник деактивирован', 'Сотрудник был деактивирован: <b>' . $worker_data['name'], 0, 0);
                    noticeUsers($_SESSION['id'], $_SESSION['type'], $worker_data['uc_id'], 1, 'Сотрудник деактивирован', 'Сотрудник был деактивирован: ' . $worker_data['name'] . '</b>', 0, 0);
                }
                $out = 1; // вот так как первый таб он передается js как data
            }

            db_query($sql);
        }

        // Отправка нового пароля на почту
        if ($_POST['action'] == 17) {

            $email = cleanStr($_POST['email']);
            $worker_type = cleanStr($_POST['worker_type']);

            //Создаем новый пароль
            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
            $max = 6;
            $size = StrLen($chars) - 1;
            $password = null;
            while ($max--) {
                $password .= $chars[rand(0, $size)];
            }

            $to_email = $email;
            $subject = 'Смена пароля от сайта Ehome';
            $body = 'Вам был выдан новый пароль пожалуйста успользуйте новый пароль для входа в систему. <br/>Ваш новый пароль: ' . $password;
            $headers = 'From: noreply@ehome.sidelka-galina.kz';

            sendMail($to_email, $subject, $body, $sender_name = "", $sender_mail = "");

            $password2 = md5($password);

            echo $password2;
            print_r($password2);

            if ($worker_type == "Менеджер") {
                $sql = "UPDATE module_manager_uc SET password = '" . $password2 . "' WHERE email = '" . $email . "'";
            } else {
                $sql = "UPDATE module_worker_uc SET password = '" . $password2 . "' WHERE email = '" . $email . "'";
            }

            db_query($sql);
        }

        if ($_POST['action'] == 18) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_smeta_items WHERE id = " . $id;
            db_query($sql);
        }

        if ($_POST['action'] == 19) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_smeta WHERE id = " . $id;
            db_query($sql);

            $sql = "DELETE FROM module_smeta_items WHERE smeta_id = " . $id;
            db_query($sql);
        }

        if ($_POST['action'] == 20) {
            $id = intval($_POST['id']);

            $data = db_get_data("SELECT * FROM module_smeta WHERE id = " . $id);

            $out = json_encode($data);
        }

        if ($_POST['action'] == 21) {
            $id = intval($_POST['id']);

            if ($id == 1) {
                // список домов ОСИ
                $flat_list = '';
                $result = db_query("SELECT * FROM module_houses WHERE osi_id = " . $_SESSION['id']);
                if (db_num_rows($result) > 0) {
                    while ($row = db_fetch_array($result)) {
                        $city = db_get_data("SELECT name FROM module_cities WHERE id = " . $row['city_id'], "name");

                        $flat_list .= '<option value="' . $row['id'] . '">' . $city . ', ' . getval("STR_STREET_SOKR_TITLE") . ' ' . $row['street'] . ' ' . $row['house_number'] . '</option>';
                    }
                }
                $out = $flat_list;
                //$tpl->assign("FLAT_LIST", $flat_list);

            } else if ($id == 2) {
                // список квартир
                $flat_list = '';
                $result = db_query("SELECT * FROM module_flats WHERE osi_id = " . $_SESSION['id']);
                if (db_num_rows($result) > 0) {
                    while ($row = db_fetch_array($result)) {
                        $city = db_get_data("SELECT name FROM module_cities WHERE id = " . $row['city_id'], "name");
                        $house = db_get_data("SELECT * FROM module_houses WHERE id = '" . $row['house_id'] . "'");

                        $flat_list .= '<option value="' . $row['id'] . '">' . $city . ', ' . getval("STR_STREET_SOKR_TITLE") . ' ' . $house['street'] . ' ' . $house['house_number'] . ', кв. ' . $row['flat_number'] . '</option>';
                    }
                }
                $out = $flat_list;
            } else if ($id == 3) {
                // список жильцов в квартире
                $flat_list = '';
                //$result = db_query("SELECT t1.*, t2.* FROM module_flats_citizens AS t1 LEFT JOIN module_citizens AS t2 ON t2.id = t1.citizen_id WHERE t2.osi_id = ".$_SESSION['id']);
                //$result = db_query("SELECT t1.id, t1.name FROM module_citizens AS t1 INNER JOIN module_flats_citizens AS t2 ON t1.id= t2.citizen_id INNER JOIN module_flats AS t3 ON t3.id = t2.flat_id WHERE t3.osi_id = '".$_SESSION['id']."' GROUP BY t1.name");
                $result = db_query("SELECT t2.id, t2.name FROM module_flats_citizens AS t1 LEFT JOIN module_citizens AS t2 ON t2.id = t1.citizen_id INNER JOIN module_flats AS t3 ON t3.id = t1.flat_id WHERE t3.osi_id = '" . $_SESSION['id'] . "' GROUP BY t1.citizen_id");

                if (db_num_rows($result) > 0) {
                    while ($row = db_fetch_array($result)) {

                        $flat_list .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }

                $out = $flat_list;
            }
        }

        if ($_POST['action'] == 22) {
            $phone = cleanStr($_POST['phone']);
            $type = intval($_POST['type_user']);
            $forgot = intval($_POST['forgot']);


            if ($type == 1) {
                $table = 'module_ucs';
                $link = 'panel_uk';
            }

            if ($type == 2) {
                $table = 'module_osi';
                $link = 'panel_osi';
            }

            if ($type == 3) {
                $table = 'module_citizens';
                $link = 'cabinet';
            }
            if ($type == 5) {
                $table = 'module_specialists';
                $link = 'cabinet';
            }

            $count = db_table_count($table, "phone = " . $phone);

            if ($count == 0) {

                $code = '';
                for ($i = 0; $i < 6; $i++) {
                    $code .= rand(0, 9);
                }
                $_SESSION['sms_code'] = $code;
                $message = 'Ваш номер ' . $code . ' для регистрации на портале ehome.kz';
                if ($curl = curl_init()) {
                    $query = 'https://smsc.kz/sys/send.php?login=e-home&psw=123456&phones=' . $phone . '&mes=' . $message;
                    curl_setopt($curl, CURLOPT_URL, $query);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $out = curl_exec($curl);
                    curl_close($curl);
                }
                $out = '<div class="alert alert-primary">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>СМС отправлено</strong></div>';
            } else {
                if ($forgot == 1) {

                    $code = '';
                    for ($i = 0; $i < 6; $i++) {
                        $code .= rand(0, 9);
                    }
                    $_SESSION['sms_code'] = $code;
                    $message = 'Ваш номер ' . $code . ' для регистрации на портале ehome.kz';
                    if ($curl = curl_init()) {
                        $query = 'https://smsc.kz/sys/send.php?login=e-home&psw=123456&phones=' . $phone . '&mes=' . $message;
                        curl_setopt($curl, CURLOPT_URL, $query);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $out = curl_exec($curl);
                        curl_close($curl);
                    }
                    $out = '<div class="alert alert-primary">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>СМС отправлено</strong></div>';
                } else {
                    $out = '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Номер уже зарегестрирован</strong></div>';
                }
            }
        }

        if ($_POST['action'] == 23) {
            $id = intval($_POST['id']);
            $sql = '';

            $check = db_get_data("SELECT id FROM module_reads WHERE notification_id = '" . $id . "' AND reader_type = " . $_SESSION['type'] . " AND reader_id = " . $_SESSION['id']);
            if (empty($check['id'])) {
                // $sql = "INSERT INTO module_reads (time_create, reader_type, reader_id, notification_id)
                // VALUES ( NOW(), '".$_SESSION['type']."', '".$_SESSION['id']."', '".$id."'";
                $sql = "INSERT INTO module_reads ( time_create, reader_type, reader_id, notification_id)
					 VALUES ( now() ,'" . $_SESSION['type'] . "', '" . $_SESSION['id'] . "', '" . $id . "')";
                $add = db_query($sql);
            } else {
                $add = 'false';
            }

            // Вывод уведомления в окне
            //Работники ИД через запятую
            $result = db_query("SELECT * FROM module_notifications WHERE id = " . $id);
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {

                    if ($_SESSION['type'] == 1) {
                        if ($row['author_type'] == 4) {
                            $name = db_get_data("SELECT name FROM module_worker_uc WHERE id = " . $row['author_id'], "name");
                        } else if ($row['author_type'] == 5) {
                            $name = db_get_data("SELECT name FROM module_manager_uc WHERE id = " . $row['author_id'], "name");
                        } else {
                            $name = db_get_data("SELECT name FROM module_ucs WHERE id = " . $row['for_id'], "name");
                        }
                        $readed = db_get_data("SELECT id FROM module_reads WHERE reader_id = '" . $_SESSION['id'] . "' AND reader_type = 1 AND Notification_ID =" . $row['id'], "id");
                    } else if ($_SESSION['type'] == 2) {
                        if ($row['author_type'] == 3) {
                            $name = db_get_data("SELECT name FROM module_citizens WHERE id = " . $row['author_id'], "name");
                        } else if ($row['author_type'] == 1) {
                            $name = db_get_data("SELECT name FROM module_ucs WHERE id = " . $row['author_id'], "name");
                        }
                        $readed = db_get_data("SELECT id FROM module_reads WHERE reader_id = '" . $_SESSION['id'] . "' AND reader_type = 2 AND Notification_ID =" . $row['id'], "id");
                    } else if ($_SESSION['type'] == 3) {
                        if ($row['author_type'] == 2) {
                            $name = db_get_data("SELECT name FROM module_osi WHERE id = " . $row['author_id'], "name");
                        } else if ($row['author_type'] == 4) {
                            $name = db_get_data("SELECT name FROM module_ucs WHERE id = " . $row['author_id'], "name");
                        }
                        $readed = db_get_data("SELECT id FROM module_reads WHERE reader_id = '" . $_SESSION['id'] . "' AND reader_type = 3 AND Notification_ID =" . $row['id'], "id");
                    } else if ($_SESSION['type'] == 4) {

                        $name = db_get_data("SELECT name FROM module_ucs WHERE id = " . $row['for_id'], "name");
                        $readed = db_get_data("SELECT id FROM module_reads WHERE reader_id = '" . $_SESSION['id'] . "' AND reader_type = 4 AND Notification_ID =" . $row['id'], "id");
                    } else if ($_SESSION['type'] == 5) {
                    }

                    //Файлы
                    $files = unserialize($row['files_id']);
                    $files_list = "";
                    if ($files) {
                        foreach ($files as &$file) {
                            $file_url = db_get_data("SELECT url_files FROM module_files WHERE id = " . $file);
                            $files_list .= '<a class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Скачать файл"  href="../files/' . $file_url[0] . '"><i class="fa fa-download"></i></a>';
                        }
                    } else {
                        $files_list = '<p>Вложенные файлы отсутствует</p>';
                    }

                    //Фотографии
                    $images = unserialize($row['photo_i']);
                    $image_list = "";
                    $i = 0;
                    if ($images) {
                        foreach ($images as &$image) {
                            $image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = " . $image);
                            if ($i == 0) {
                                $image_list .= '<div class="carousel-item active"><img class="d-block w-100" loading="lazy"  height="200px" alt="" src="../photos/' . $image_url[0] . '" data-holder-rendered="true"></div>';
                            } else {
                                $image_list .= '<div class="carousel-item"><img class="d-block w-100" loading="lazy"  height="200px" alt="" src="../photos/' . $image_url[0] . '" data-holder-rendered="true"></div>';
                            }
                            $i++;
                        }
                    } else {
                        $image_list = '<p style="text-align: center;">Вложенные фотографии отсутствует</p>';
                    }

                    $id = $row['id'];
                    $description = $row['description'];
                }
            }

            $out = '<div class="modal fade" tabindex="-1" id="openinfonotice" data-id="openinfonotice" role="dialog" aria-hidden="true" style="z-index: 1500 !important ;">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content ">
							<div class="modal-header pd-x-20">
											<h6 class="modal-title" id="openinfotitle">Уведомление №' . $id . '</h6>
										<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
											<span aria-hidden="true">&times;</span>
										</button>
							</div>

							<div class="modal-body pd-20">
										<div class="row">
												<div class="col-xs-6 col-md-6 col-xl-6 col-lg-6">
													<h5>Описание:</h5>
													<p style="white-space: normal;">' . $description . '</p>
												</div>

											<div class="col-xs-6 col-md-6 col-xl-6 col-lg-6">

													<div id="carousel-controls-' . $id . '" class="carousel slide" data-ride="carousel-' . $id . '">
														<div class="carousel-inner">
																	' . $image_list . '
														</div>
														<a class="carousel-control-prev" href="#carousel-controls-' . $id . '" role="button" data-slide="prev">
																	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																	<span class="sr-only">Пред.</span>
														</a>
														<a class="carousel-control-next" href="#carousel-controls-' . $id . '" role="button" data-slide="next">
																	<span class="carousel-control-next-icon" aria-hidden="true"></span>
																	<span class="sr-only">След.</span>
														</a>

											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
							' . $files_list . '
							</div>
							</div>


					</div>
				</div>
				';

            //$out = $add;

        }

        if ($_POST['action'] == 24) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_knowledgebases WHERE id = " . $id;
            db_query($sql);
        }

        if ($_POST['action'] == 25) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_gallery_images WHERE id = " . $id;
            db_query($sql);

            $out = 4;
        }

        if ($_POST['action'] == 26) {
            $id = intval($_POST['id']);

            $sql = "DELETE FROM module_gallery WHERE id = " . $id;
            db_query($sql);

            $sql = "DELETE FROM module_gallery_images WHERE album_id = " . $id;
            db_query($sql);
        }

        if ($_POST['action'] == 27) {
            $id = intval($_POST['id']);

            $file_id = db_get_data("SELECT file_id FROM module_docs WHERE id = " . $id, "file_id");
            $file_url = db_get_data("SELECT url_files FROM module_files WHERE id = " . $file_id, "url_files");

            $sql = "DELETE FROM module_docs WHERE id = " . $id;
            db_query($sql);

            unlink("../files/" . $file_url);
        }

        if ($_POST['action'] == 28) {
            $id_request = intval($_POST['id']);
            $tab = intval($_POST['tab']);
            $request = db_get_data("SELECT * FROM module_requests WHERE id = " . $id_request);

            $type = db_get_data("SELECT name FROM module_request_types WHERE id = " . $request['type_id'], "name");
            $city = db_get_data("SELECT name FROM module_cities WHERE id = " . $request['city_id'], "name");
            $name = db_get_data("SELECT name FROM module_citizens WHERE id = " . $request['citizen_id'], "name");
            $name_phone = db_get_data("SELECT phone FROM module_citizens WHERE id = " . $request['citizen_id'], "phone");
            $osi = db_get_data("SELECT name FROM module_osi WHERE id = " . $request['osi_id'], "name");

            $osi_phone = db_get_data("SELECT phone FROM module_osi WHERE id = " . $request['osi_id'], "phone");

            $uc = db_get_data("SELECT name FROM module_ucs WHERE id = " . $request['uc_id'], "name");
            $uc_phone = db_get_data("SELECT phone FROM module_ucs WHERE id = " . $request['uc_id'], "phone");

            $uc_worker = db_get_data("SELECT name FROM module_worker_uc WHERE id = " . $request['worker_uc_id'], "name");
            $uc_worker_phone = db_get_data("SELECT phone FROM module_worker_uc WHERE id = " . $request['worker_uc_id'], "phone");

            $status = db_get_data("SELECT name FROM module_request_statuses WHERE id = " . $request['request_status_id'], "name");
            $flat_data = db_get_data("SELECT t1.*, t2.house_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = " . $request['flat_id']);
            $house = db_get_data("SELECT * FROM module_houses WHERE id = " . $request['house_id']);

            $review = db_get_data("SELECT rating_id FROM module_request_reviews WHERE request_id = " . $request['id'], "rating_id");

            $review_text = '';
            $review_text = db_get_data("SELECT description FROM module_request_reviews WHERE request_id = " . $request['id'], "description");

            $images = unserialize($request['photo_i']);

            $image_list = "";
            $i = 0;
            if ($images) {
                foreach ($images as &$image) {
                    $image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = " . $image);
                    if ($i == 0) {
                        $image_list .= '<div class="carousel-item active" data-responsive="../photos/' . $image_url[0] . '" data-src="../photos/' . $image_url[0] . '" data-sub-html="AA"><img class="d-block center img-responsive" style="display:block; margin:auto;" loading="lazy"  height="200px" alt="" src="../photos/' . $image_url[0] . '" data-holder-rendered="true"></div>';
                    } else {
                        $image_list .= '<div class="carousel-item" data-responsive="../photos/' . $image_url[0] . '" data-src="../photos/' . $image_url[0] . '" data-sub-html="AA"><img class="d-block center" style="display:block; margin:auto;" loading="lazy"  height="200px" alt="" src="../photos/' . $image_url[0] . '" data-holder-rendered="true"></div>';
                    }

                    $i++;
                }
            } else {
                $image_list = '<div class="carousel-item active"><p style="display:block; margin:auto; text-align: center;">Вложенные фотографии отсутствует</p></div>';
            }

            if (intval($request['citizen_id']) > 0) {

                $author = "Житель:  " . $name;
                $author_phone = $name_phone;
                $city = 'г.' . $city;
                $street = ' ул.' . $house['street'];
                $house = ' ' . $house['house_number'];
                $flat_number = ", кв. " . $flat_data['flat_number'];
                if ($request['uc_accepted'] > 0) {
                    if ($request['worker_uc_id'] > 0) {
                        $executor_name = "Сотрудник УК: " . $uc_worker;
                        $executor_name_phone = $uc_worker_phone;
                    } else {
                        $executor_name = "УК: " . $uc;
                        $executor_name_phone = $uc_phone;
                    }
                } else {
                    $executor_name = "ОСИ: " . $osi;
                    $executor_name_phone = $osi_phone;
                }
            } else {
                $author = "ОСИ:  " . $osi;
                $author_phone = $osi_phone;
                $flat_number = " ";
                $street = ' ул.' . $house['street'];
                $house = ' ' . $house['house_number'];
                $city = 'г.' . $city;

                if ($request['uc_id'] > 0) {
                    if ($request['uc_accepted'] > 0) {
                        if ($request['worker_uc_id'] > 0) {
                            $executor_name = "Сотрудник УК: " . $uc_worker;
                            $executor_name_phone = $uc_worker_phone;
                        } else {
                            $executor_name = "УК: " . $uc;
                            $executor_name_phone = $uc_phone;
                        }
                    } else {
                        $executor_name = "ОСИ: " . $osi;
                        $executor_name_phone = $osi_phone;
                    }
                }
            }

            $DATE = date("d.m.Y", strtotime($request['time_create']));
            $TIME = date("H:i", strtotime($request['time_create']));

            //$image_list = '<p>Вложенные фотографии отсутствует</p>';
            $action2 = "";
            $action2 = GetAction2ByTabIDAndSessionTypeID($tab, intval($_SESSION['type']), intval($request['id']), intval($_SESSION['id']), $request['citizen_id'], $request['osi_accepted'], $request['uc_id'], $request['uc_accepted'], $request['worker_uc_id'], $request['worker_uc_accepted']);
            $description = $request['description'];

            $out = '<div class="modal fade" tabindex="-1" id="openinfo" data-id="openinfo" role="dialog" aria-hidden="true" style="z-index: 1500 !important ;">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content ">
							<div class="modal-header pd-x-20">
											<h6 class="modal-title" id="openinfotitle">Заявка №' . $id_request . '</h6>
										<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
											<span aria-hidden="true">&times;</span>
										</button>
							</div>

							<div class="modal-body pd-20">

								<ul class="usertab-list mb-5">
								<li><span class="font-weight-semibold w100">Автор :</span> ' . $author . ' <br>
									' . $city . $street . $house . $flat_number . '
								</li>

									<li><span class="font-weight-semibold w100">Исполнитель:</span> ' . $executor_name . '
									</li>
									<li><span class="font-weight-semibold w100">Телефон:</span> ' . $executor_name_phone . '</li>
									<li><span class="font-weight-semibold w100">Дата:</span> ' . $DATE . '</li>
									<li><span class="font-weight-semibold w100">Статус:</span> ' . $status . '</li>
									<li><span class="font-weight-semibold w100">Тип:</span> ' . $type . '</li>
								</ul>
											<div class="row">
												<div class="col-xs-6 col-md-6 col-xl-6 col-lg-6">
													<h5>Описание:</h5>
													<p style="white-space: normal;">' . $description . '</p>
												</div>
											<div class="col-xs-6 col-md-6 col-xl-6 col-lg-6">

													<div id="carousel-controls-' . $id_request . '" class="carousel slide" data-ride="carousel-' . $id_request . '">
														<div class="carousel-inner " >
														<div class="demo-gallery">
																	<ul id="lightgallery" class="list-unstyled row">
																	' . $image_list . '
																	</ul>
																</div>
														</div>
														<a class="carousel-control-prev" href="#carousel-controls-' . $id_request . '" role="button" data-slide="prev">
																	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																	<span class="sr-only">Пред.</span>
														</a>
														<a class="carousel-control-next" href="#carousel-controls-' . $id_request . '" role="button" data-slide="next">
																	<span class="carousel-control-next-icon" aria-hidden="true"></span>
																	<span class="sr-only">След.</span>
														</a>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
							' . $action2 . '
							</div>
							</div>


					</div>
				</div>
				';
        }
        //Вывод всех городов
        if ($_POST['action'] == 29) {
            $city_name = "";
            $result = db_query("SELECT * FROM module_cities");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $city_name .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
            $out = $city_name;
        }
        //вывод улиц в зависимости от городов
        if ($_POST['action'] == 30) {
            $id = intval($_POST['value']);

            $street_name = "";
            $result = db_query("SELECT * FROM module_houses WHERE city_id = '" . $id . "' GROUP BY street");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $street_name .= '<option value="' . $row['id'] . '">' . $row['street'] . '</option>';
                }
            } else {
                $street_name .= '<option value="0">Улиц в вашем городе нет</option>';
            }
            $out = $street_name;
        }
        //вывод домов в зависимости от улиц
        if ($_POST['action'] == 31) {
            $id = intval($_POST['value']);

            $street = db_get_data("SELECT street FROM module_houses WHERE id = " . $id, "street");
            $street_name = "";
            $result = db_query("SELECT * FROM module_houses WHERE street = '" . $street . "'");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $street_name .= '<option value="' . $row['id'] . '">' . $row['house_number'] . '</option>';
                }
            } else {
                $street_name .= '<option value="0">Дома на этой улице нет</option>';
            }
            $out = $street_name;
        }
        //УДАЛЕНИЕ ГОЛОСОВАНИЕ ПОЛЬЗОВАТЕЛЯ (ФУНКЦИЯ ПЕРЕГОЛОСОВАТЬ)
        if ($_POST['action'] == 32) {
            $id = intval($_POST['id']);
            $result = db_query("DELETE FROM module_polled WHERE poll_id = " . $id . " AND user_id = " . $_SESSION['id'] . " AND user_type = " . $_SESSION['type']);
        }

        //УДАЛЕНИЕ БЮДЖЕТА В РАСХОДАХ (ТОЛЬКО ОСИ МОЖЕТ УДАЛИТЬ)
        if ($_POST['action'] == 33) {
            $id = intval($_POST['id']);
            $result = db_query("DELETE FROM module_budget WHERE id = " . $id);
        }

        //УДАЛЕНИЕ РАСХОДОВ В РАСХОДАХ (ВНУТРЕННАЯ СТРАНИЦА ) / (ТОЛЬКО ОСИ МОЖЕТ УДАЛИТЬ)
        if ($_POST['action'] == 34) {
            $id = intval($_POST['id']);
            $result = db_query("DELETE FROM module_expense_budget WHERE id = " . $id);
        }

        // диактивировать выбранных в модуле my_citizen_osi
        if ($_POST['action'] == 35) {
            $status = intval($_POST['status']);

            foreach ($_POST['items'] as $key => $value) {
                $sql = "UPDATE module_flats_citizens SET status = " . $status . " WHERE id = " . $value;
                db_query($sql);
            }
        }

        // диактивировать выбранных в модуле my_houses_osi
        if ($_POST['action'] == 36) {
            $status = intval($_POST['status']);

            foreach ($_POST['items'] as $key => $value) {
                $sql = "UPDATE module_houses SET status = '" . $status . "' WHERE id = " . $value;
                db_query($sql);
            }
        }

        // диактивировать выбранных в модуле my_uc_osi
        if ($_POST['action'] == 37) {
            $status = intval($_POST['status']);

            foreach ($_POST['items'] as $key => $value) {
                $sql = "UPDATE module_osi_and_ucs SET status = " . $status . " WHERE id = " . $value;
                db_query($sql);
            }
        }

        if ($_POST['action'] == 38) {
            foreach ($_POST['items'] as $key => $value) {
                $sql = "DELETE FROM module_osi_and_ucs WHERE id = " . $value;
                db_query($sql);
            }

            $out = 1;
        }

        // диактивировать выбранных в модуле my_osi_uk
        if ($_POST['action'] == 39) {
            $status = intval($_POST['status']);

            foreach ($_POST['items'] as $key => $value) {
                $sql = "UPDATE module_osi_and_ucs SET status = " . $status . " WHERE id = " . $value;
                db_query($sql);
            }
        }

        // Удалить пачку квитанцию со всеми вкладышными страницами
        if ($_POST['action'] == 40) {
            $id = intval($_POST['id']);

            $result = db_query("DELETE FROM module_invoices WHERE pack_invoice_id = " . $id);
            $result = db_query("DELETE FROM module_pack_invoice WHERE id = " . $id);
        }

        // Отправить квитанции и уведомление пользователям
        if ($_POST['action'] == 41) {
            $id = intval($_POST['id']);

            $result = db_query("SELECT * FROM module_invoices WHERE pack_invoice_id = " . $id);
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $citizen_id = db_get_data("SELECT * FROM module_flats_citizens WHERE flat_id = " . $row['flat_id']);
                    $osi_info = db_get_data("SELECT * FROM module_osi WHERE id = " . $row['osi_id']);

                    $pack_invoice = db_get_data("SELECT * FROM module_pack_invoice WHERE id = " . $id);

                    $flat_data = db_get_data("SELECT t1.*, t2.* FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = " . $row['flat_id']);
                    $house_data = db_get_data("SELECT * FROM module_houses WHERE id = " . $flat_data['house_id']);
                    $city = db_get_data("SELECT * FROM module_cities WHERE id = " . $flat_data['city_id'], "name");
                    $full_adress = 'г.' . $city . ' ул. ' . $house_data['street'] . ' ' . $house_data['house_number'] . ' кв. ' . $flat_data['flat_number'];

                    noticeUsers($_SESSION['id'], $_SESSION['type'], $citizen_id['citizen_id'], 3, 'Новая квитанция за ' . $pack_invoice['year'] . ' ' . $_MONTHS_RU[intval($pack_invoice['month'])], 'ОСИ:<b> ' . $osi_info['name'] . '</b> Создал квитанцию <b> ' . $full_adress . '</b>', 0, $row['flat_id'], 'invoice/');
                }
            }

            $result = db_query("UPDATE module_pack_invoice SET `status` = 1 WHERE id = " . $id);
        }

        // Удаление заявки специалистам созданной пользователем
        if ($_POST['action'] == 42) {
            $id = intval($_POST['id']);
            $result = db_query("DELETE FROM module_requests_specs WHERE id = " . $id);
        }

        if ($_POST['action'] == 43) {

            $id = intval($_POST['id']);
            $request_spec = db_get_data("SELECT * FROM module_requests_specs WHERE id = " . $id);
            $request_spec['id'];
            $request_spec['description'];
            mb_strimwidth($request_spec['description'], 0, 100, "...");
            $request_spec['time_created'];
            if ($request_spec['status'] == 0) $status = 'Новая';
            if ($request_spec['status'] == 1) $status = 'Отмена';
            if ($request_spec['status'] == 2) $status = 'Выбран исполнитель';
            if ($request_spec['status'] == 3) $status = 'Ожидание оценки';
            if ($request_spec['status'] == 4) $status = 'Завершен';
            if ($request_spec['status'] == 5) $status = 'Исполнитель отменил';

            $SPEC_NAME = db_get_data("SELECT value FROM module_specialists_specializations WHERE id = " . $request_spec['specialization'], "value");

            if ($request_spec['user_type'] == 1) {
                $userType = "УК";
                $userInfo = db_get_data("SELECT * FROM module_ucs WHERE id = " . $request_spec['user_id']);
            }
            if ($request_spec['user_type'] == 2) {
                $userType = "ОСИ";
                $userInfo = db_get_data("SELECT * FROM module_osi WHERE id = " . $request_spec['user_id']);
            }
            if ($request_spec['user_type'] == 3) {
                $userType = "Житель";
                $userInfo = db_get_data("SELECT * FROM module_citizens WHERE id = " . $request_spec['user_id']);
            }

            $row['photos'];
            $row['files'];
            $flat_data = db_get_data("SELECT t1.*, t2.* FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t1.id = " . $request_spec['flat_id']);
            $house_data = db_get_data("SELECT * FROM module_houses WHERE id = " . $flat_data['house_id']);
            $city = db_get_data("SELECT * FROM module_cities WHERE id = " . $flat_data['city_id'], "name");
            $flat_adress = 'г.' . $city . ' ул. ' . $house_data['street'] . ' ' . $house_data['house_number'] . ' кв. ' . $flat_data['flat_number'];

            $images = unserialize($request_spec['photos']);
            $image_list = "";
            $i = 0;
            if ($images) {
                foreach ($images as &$image) {
                    $image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = " . $image);
                    if ($i == 0) {
                        $image_list .= '<div class="carousel-item active"><img class="d-block w-100" loading="lazy"  height="300px" alt="" src="../photos/' . $image_url[0] . '" data-holder-rendered="true"></div>';
                    } else {
                        $image_list .= '<div class="carousel-item"><img class="d-block w-100" loading="lazy"  height="300px" alt="" src="../photos/' . $image_url[0] . '" data-holder-rendered="true"></div>';
                    }

                    $i++;
                }
            } else {
                $image_list = '<p style="text-align: center">Вложенные фотографии отсутствует</p>';
            }
            $finish_work = '';
            $result2 = db_query("SELECT * FROM module_responses WHERE requests_spec_id = " . $id . " AND spec_id =" . $_SESSION['id']);
            if (db_num_rows($result2) > 0) {
                while ($row2 = db_fetch_array($result2)) {
                    $add_response = '<div class="form-group mt-2" >
		<input type="hidden" name="id" value="' . $id . '"/>
			<label for="response" class="form-control-label">Вы уже отправили предложение</label>
			<textarea rows="3" class="form-control" name="response" id="response" placeholder="Укажите цену, сроки" readonly="readonly">' . $row2['responses'] . '</textarea>
		</div>';
                    if ($request_spec['status'] == 2) {
                        $finish_work = '<button type="button" onclick="finishRequestSpec(' . $id . ')" class="btn btn-info">Выполнено</button>';
                    } else if ($request_spec['status'] == 3) {
                        $finish_work = '';
                    }

                    $add_button = '';
                }
            } else {
                $add_response = '<div class="form-group mt-2" >
		<input type="hidden" name="id" value="' . $id . '"/>
			<label for="response" class="form-control-label">Укажите ваше предложение</label>
			<textarea rows="3" class="form-control" name="response" id="response" placeholder="Укажите цену, сроки"></textarea>
		</div>';
                $finish_work = '';

                $add_button = '<button type="submit" class="btn btn-info" >Указать цену</button>';
            }

            $out = '
			 <!-- request-spec-info -->
			 <div class="modal fade" id="openinfo">
			 <div class="modal-dialog modal-lg" role="document">
				 <div class="modal-content ">
				 <form action="" method="post" name="frmResposeSpec" enctype="multipart/form-data">
                <input type="hidden" value="1" name="send">
					 <div class="modal-header pd-x-20">
						 <h6 class="modal-title">Заявка №' . $id . '</h6>
						 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
					 </div>
					 <div class="modal-body pd-20">
						 <ul class="usertab-list mb-5">
							 <li><span class="font-weight-semibold w100">Автор :</span> ' . $userType . ': ' . $userInfo['name'] . ' </br>
								 ' . $flat_adress . '
							 </li>
							 <li><span class="font-weight-semibold w100">Телефон:</span> ' . $userInfo['phone'] . '</li>
							 <li><span class="font-weight-semibold w100">Дата:</span> ' . $request_spec['time_created'] . '</li>
							 <li><span class="font-weight-semibold w100">Статус:</span> ' . $status . '</li>
							 <li><span class="font-weight-semibold w100">Тип:</span> ' . $SPEC_NAME . '</li>
						 </ul>
						 <div class="row">
							 <div class="col-xs-6 col-md-6">
								 <h4> Описание</h4>
								 <p> ' . $request_spec['description'] . '</p>
							 </div>
							 <div class="col-xs-6 col-md-5">
								 <div id="carousel-controls-' . $id . '" class="carousel slide" data-ride="carousel-' . $id . '">
									 <div class="carousel-inner">
										 ' . $image_list . '
									 </div>
									 <a class="carousel-control-prev" href="#carousel-controls-' . $id . '" role="button"
										 data-slide="prev">
										 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
										 <span class="sr-only">Previous</span>
									 </a>
									 <a class="carousel-control-next" href="#carousel-controls-' . $id . '" role="button"
										 data-slide="next">
										 <span class="carousel-control-next-icon" aria-hidden="true"></span>
										 <span class="sr-only">Next</span>
									 </a>
								 </div>
							 </div>
						 </div>
						' . $add_response . '
					 </div><!-- modal-body -->
					 <div class="modal-footer">
						' . $add_button . '
						' . $finish_work . '
						 <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					 </div>
					 </form>
				 </div>
			 </div><!-- modal-dialog -->
			 </div><!-- modal end -->';
        }

        if ($_POST['action'] == 44) {

            $id = intval($_POST['id']);
            $request_spec = db_get_data("SELECT * FROM module_requests_specs WHERE id = " . $id);

            $result2 = db_query("SELECT * FROM module_responses WHERE requests_spec_id = " . $id);
            if (db_num_rows($result2) > 0) {
                while ($row2 = db_fetch_array($result2)) {
                    $spec_info = db_get_data("SELECT * FROM module_specialists WHERE id = " . $row2['spec_id']);

                    $tpl_image = db_get_data("SELECT image FROM module_specialists WHERE id = " . $row2['spec_id'], "image");
                    if ($tpl_image > 0) {
                        $image_url = db_get_data("SELECT url_photos FROM module_photos WHERE id = " . $tpl_image, "url_photos");
                        $image = '../photos/' . $image_url;
                    } else {
                        $image = '../assets/images/user.jpg';
                    }

                    $table_rows .= '<tr>
			<td><span class="avatar avatar-md  d-block brround cover-image" data-image-src="' . $image . '" style="background: url(' . $image . ') center center;"></span></td>
			<td>' . $spec_info['name'] . '</td>
			<td>' . $row2['responses'] . '</td>
			<td class="">' . $spec_info['phone'] . '</td>

			<td>
				<div class="rating-stars block" value="4">
					<div class="rating-stars-container">
						<div class="rating-star sm is--active">
							<i class="fa fa-star"></i>
						</div>
						<div class="rating-star sm is--active">
							<i class="fa fa-star"></i>
						</div>
						<div class="rating-star sm is--active">
							<i class="fa fa-star"></i>
						</div>
						<div class="rating-star sm is--active">
							<i class="fa fa-star"></i>
						</div>
						<div class="rating-star sm">
							<i class="fa fa-star"></i>
						</div>
					</div>
				</div>
			</td>

			<td>
				<a onclick="appointAsExecutor(' . $id . ',' . $row2['spec_id'] . ')" class="btn btn-success btn-sm mb-1">Принять</a>

			</td>
		</tr></form>';
                }
            } else {
                $add_response = '<div class="form-group">
			<input type="hidden" name="id" value="' . $id . '"/>
				<label for="response" class="form-control-label">Укажите ваше предложение</label>
				<textarea rows="3" class="form-control" name="response" id="response" placeholder="Укажите цену, сроки"></textarea>
			</div>';
            }

            $out = '
				 <!-- request-spec-info -->
				 <div class="modal fade" id="openinfo">
				 <div class="modal-dialog modal-lg" role="document">
					 <div class="modal-content ">
					 <form action="" method="post" name="frmResposeSpec" enctype="multipart/form-data">
					<input type="hidden" value="1" name="send">
						 <div class="modal-header pd-x-20">
							 <h6 class="modal-title">Заявка №' . $id . '</h6>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								 <span aria-hidden="true">&times;</span>
							 </button>
						 </div>
						 <div class="modal-body pd-20">
						 <table class="table card-table table-bordered table-hover table-vcenter">
						 <tbody>
						' . $table_rows . '

						 </tbody>
					 </table>
						 </div><!-- modal-body -->
						 <div class="modal-footer">

							 <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
						 </div>
						 </form>
					 </div>
				 </div><!-- modal-dialog -->
				 </div><!-- modal end -->';
        }

        // Принять специалиста как исполнителя заявки
        if ($_POST['action'] == 45) {
            $id = intval($_POST['id']);
            $spec_id = intval($_POST['spec_id']);

            $result = db_query("UPDATE module_requests_specs SET `status` = 2, `spec_id` = '.$spec_id.', `time_apply` = NOW() WHERE id = " . $id);
        }

        // Исполнитель выполняет работу
        if ($_POST['action'] == 46) {
            $id = intval($_POST['id']);

            $result = db_query("UPDATE module_requests_specs SET `status` = 3, `time_work_end` = NOW() WHERE id = " . $id);
        }

        if ($_POST['action'] == 47) {

            $id = intval($_POST['id']);

            $request_spec = db_get_data("SELECT * FROM module_requests_specs WHERE id = " . $id);

            $out = '
					 <!-- request-spec-info -->
					 <div class="modal fade" id="openinfo2">
					 <div class="modal-dialog modal-lg" role="document">
						 <div class="modal-content ">
						 <form action="" method="post" name="frmResposeSpec" enctype="multipart/form-data">
						<input type="hidden" value="1" name="sendReview">
						<input type="hidden" value="' . $id . '" name="request_id">
							 <div class="modal-header pd-x-20">
								 <h6 class="modal-title">Отзыв заявке №' . $id . '</h6>
								 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
							 </div>
							 <div class="modal-body pd-20">
							 <div class="rating-stars block" id="rating">
                        <label for="recipient-name" class="form-control-label">Оцените исполнителя:</label>
                        <input type="number" readonly="readonly" class="rating-value" name="rating_stars_value" id="rating-stars-value" value="3" required>
                        <div class="rating-stars-container">
                            <div class="rating-star">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="rating-star">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="rating-star">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="rating-star">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="rating-star">
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
					</div>
					<div class="form-group">
                        <label for="recipient-name" class="form-control-label">Отзыв</label>
                        <textarea rows="3" class="form-control" name="review" value="" placeholder="Тут просто отзыв" required>asdasd</textarea>
                    </div>
							 </div><!-- modal-body -->
							 <div class="modal-footer">
							 <button onclick="frmResposeSpec.submit()" class="btn btn-secondary">Оставить отзыв</button>
								 <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
							 </div>
							 </form>
						 </div>
					 </div><!-- modal-dialog -->
					 </div><!-- modal end -->';
        }

        // Удаление заявки специалистам созданной пользователем
        if ($_POST['action'] == 48) {
            $id = intval($_POST['id']);
            $result = db_query("UPDATE module_polls SET `status` = 2 WHERE id = " . $id);
        }

        // Меняем статус
        if ($_POST['action'] == 49) {
            $id = intval($_POST['id']);
            $statdata = intval($_POST['statdata']);
            $house_id = intval($_POST['house_id']);
            $citizen_id = intval($_POST['citizen_id']);

            if ($statdata === 0) {
                $i = 1;
            } else if ($statdata === 1) {
                $i = 0;
            }

            //Свзязи квартир с пользователями
            $flats_citizens = db_query("SELECT t1.* FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t2.house_id = " . $house_id . " AND t1.citizen_id = " . $citizen_id);
            while ($flat = db_fetch_array($flats_citizens)) {
                //$flats_ids .=  $flat['id']. ',';
                $result = db_query("UPDATE module_flats_citizens SET sovet = " . $i . " WHERE id = " . $flat['id']);
            }
            // $flats_ids = mb_substr($flats_ids, 0, -1);

            //  $flats = db_query("SELECT * FROM module_flats_citizen WHERE citizen_id = ".$citizen_id." AND sovet = ".$statdata);
            //     while ($flat = db_fetch_array($flats)) {
            //         $flats_ids .=  $flat['flat_id']. ',';
            //     }
            //     $flats_ids = mb_substr($flats_ids, 0, -1);



            //Назначение всех квартир в виде советника дома или жителями



            //echo $flats_ids;

            // Назначение одной квартиры в виде советника дома
            // $result = db_query("UPDATE module_flats SET `sovet` = " . $i . " WHERE id = " . $id);
        }

        if ($_POST['action'] == 50) {
            $id = intval($_POST['id']);
            // $house_id = db_get_data("SELECT house_id FROM module_polls_link WHERE poll_id = " . $id, "house_id");
            // $flats = db_query("SELECT * FROM module_flats WHERE house_id = " . $house_id);
            // while ($flat = db_fetch_array($flats)) {

            //     $polleds = db_query("SELECT * FROM module_polled WHERE poll_id = '" . $id . "' AND user_id = " . $flat['citizen_id']." AND user_type = 3 ");
            //     while ($polled = db_fetch_array($polleds)) {
            //         $citizen = db_get_data("SELECT * FROM module_citizen WHERE id = " . $flat['citizen_id']);

            //     }
            // }


            $result = db_query("UPDATE module_polls SET `status` = 3 WHERE id = " . $id);
        }
        if ($_POST['action'] == 51) {
            $id = intval($_POST['id']);


            $result = db_query("UPDATE module_polls SET `status` = 4 WHERE id = " . $id);
        }
        if ($_POST['action'] == 52) {
            $pass = intval($_POST['pass']);
            $phone = intval($_POST['phone']);
            $user_type = intval($_POST['user_type']);

            if ($user_type == 1) {
                $table = 'module_ucs';
            }
            if ($user_type == 2) {
                $table = 'module_osi';
            }
            if ($user_type == 3) {
                $table = 'module_citizens';
            }
            if ($user_type == 5) {
                $table = 'module_specialists';
            }
            $count = db_table_count($table, "phone = " . $phone . " ");

            if ($count == 0) {
                $out = "Извините но такого пользователя мы не нашли в базе";
            } else {
                if ($_SESSION['sms_code'] == $pass) {
                    $out = "Вы ввели правильный код";
                } else {
                    $out = "Вы ввели не правильный код";
                }
            }
        }
        if ($_POST['action'] == 53) {
            $flats_count = intval($_POST['flats_count']);
            $out = '';
            $x = 0;
            while ($x++ < $flats_count) {
                $out .= '<tr>
                <th><input type="text"  name="all_' . $i . '" placeholder="" value="' . strtotime("now") . '"/></th>
                <th>' . $x . '</th>
                <th>Статус</th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><input type="text" name="all_' . $i . '" placeholder="" /></th>
                <th><a class="btn btn-success text-white" > Сохранить</a></th>
            </tr>';
            }
        }
        if ($_POST['action'] == 54) {
            $id = intval($_POST['id']);
            $kvadratura = intval($_POST['kvadratura']);

            $result = db_query("UPDATE module_flats SET `kradratura` = " . $kvadratura . " WHERE id = " . $id);
        }
        if ($_POST['action'] == 55) {
            $id = intval($_POST['id']);

            $result = db_query("DELETE FROM module_flats WHERE id = " . $id);
        }

        if ($_POST['action'] == 56) {

            $flat_id = intval($_POST['flat_id']);
            $rowid = intval($_POST['rowid']);

            $out = '';
            $out = '<!-- request-spec-info -->
                <div class="modal fade" id="openinfo">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                    <form action="" method="post" name="frmsendaddInvoicePayment" >
                   <input type="hidden" value="1" name="sendaddInvoicePayment">
                   <input type="hidden" value="' . $flat_id . '" name="flat_id">
                   <input type="hidden" value="' . $rowid . '" name="pack_invoice">
                        <div class="modal-header pd-x-20">
                            <h6 class="modal-title">Частичная оплата </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pd-20">
                        <div class="form-group">
                        <label for="for_invoice_row" class="form-control-label">Сумма</label>

                        <select name="for_invoice_row" class="form-control"  id="for_invoice_row">

                            <option value="1" selected="">Расход на содержание дома	</option>
                            <option value="2">Взносы на капитальный ремонт	</option>
                        </select>
                    </div>
                        <div class="form-group">
                        <label for="invoice_payment" class="form-control-label">Сумма</label>
                        <input type="text" class="form-control" id="invoice_payment" name="invoice_payment" placeholder="Введите сумму" required>
                    </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Отправить</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                        </form>
                    </div>
                </div><!-- modal-dialog -->
                </div><!-- modal end -->';
        }

        if ($_POST['action'] == 57) {

            $flat_id = intval($_POST['flat_id']);
            $rowid = intval($_POST['rowid']);
            $index = 0;
            $result2 = db_query("SELECT * FROM module_invoice_payments WHERE flat_id = " . $flat_id . " AND pack_invoice_id = " . $rowid . " ORDER by time_created DESC");
            if (db_num_rows($result2) > 0) {
                while ($row3 = db_fetch_array($result2)) {
                    $index++;
                    if ($row3['for_invoice_row'] == 1) {
                        $name = 'Расход на содержание домa';
                    } else {
                        $name = 'Взносы на капитальный ремонт';
                    }

                    $table_rows .= '<tr>
            <td>' . $index . '</td>
            <td>' . $name . '</td>
			<td>' . $row3['payment_money'] . '</td>
			<td>' . $row3['time_created'] . '</td>

        </tr>';
                }
            } else {
                $table_rows = '<tr> <td colspan="3" >Пока нет никаких выплат</td> </tr>';
            }
            $out = '';
            $out = '<!-- request-spec-info -->
                <div class="modal fade" id="openinfo2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">

                        <div class="modal-header pd-x-20">
                            <h6 class="modal-title">Частичная оплата </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pd-20 vscroll" style="heigth:600px">
                        <table class="table card-table table-bordered table-hover table-vcenter">
                        <thead>
                        <tr>
                        <th>Номер</th>
                        <th>Название</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                    </thead>
						 <tbody>
                        ' . $table_rows . '
                        </tbody>
                        </table>
                        </div><!-- modal-body -->

                    </div>
                </div><!-- modal-dialog -->
                </div><!-- modal end -->';
        }
        // получаем номера дома
        if ($_POST['action'] == 58) {
            $city = cleanStr($_POST['value']);
            $district = cleanStr($_POST['value2']);
            $street = cleanStr($_POST['value3']);
            $out = "";
            $out .= '<option selected="selected">Выберите номер дома</option>';
            $result = db_query("SELECT * FROM module_houses WHERE city_id = '" . $city . "' AND district_id = '" . $district . "' AND street = '" . $street . "'  AND status = 1 ORDER BY house_number DESC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $out .= '<option value="' . $row['house_number'] . '">' . $row['house_number'] . '</option>';
                }
            }
        }
        if ($_POST['action'] == 59) {
            $house_number = intval($_POST['value']);
            $street = cleanStr($_POST['value1']);
            $city = intval($_POST['value2']);
            $street2 = '"' . $street . '"';
            $out = "";
            $house = db_get_data("SELECT * FROM module_houses WHERE house_number = " . $house_number . " AND city_id = " . $city . " AND street = " . $street2);

            $out .= '<option selected="selected">Выберите квартиру</option>';
            //$out .= $house['id'];
            $house_id = $house['id'];


            $result = db_query("SELECT * FROM module_flats WHERE city_id = " . $city . " AND house_id = " . $house_id . " ORDER BY CAST(flat_number AS UNSIGNED) ASC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $citizen = db_get_data("SELECT t1.*, t2.* FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t2.id = " . $row['id'] . "");
                    if ($citizen['citizen_id']) {

                        if ($citizen['status'] == 0) {
                            $out .= '<option value="' . $row['id'] . '">' . $row['flat_number'] . '</option>';
                        }
                    } else {
                        $out .= '<option value="' . $row['id'] . '">' . $row['flat_number'] . '</option>';
                    }
                }
            }
            $out .= '<option >Моей квартиры тут нет</option>';
        }

        if ($_POST['action'] == 60) {

            require_once('phpmailer/PHPMailerAutoload.php');
            $mail = new PHPMailer;
            $mail->CharSet = 'utf-8';

            $mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                                                                                             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'zendarolll@gmail.com'; // Ваш логин от почты с которой будут отправляться письма
            $mail->Password = 'flatronezt717b'; // Ваш пароль от почты с которой будут отправляться письма
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

            $mail->setFrom('info@e-home.kz'); // от кого будет уходить письмо?
            $mail->addAddress($email);     // Кому будет уходить письмо
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', '');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Форма обратной связи Контакты';
            $body = '' . $email . ' оставил заявку, его телефон ' . $adress . '<br>' . $name . '<br>Почта этого пользователя: ';
            $mail->Body    = $body;
            $mail->AltBody = '';

            if (!$mail->send()) {
                echo 'Error';
            } else {
                echo 'Отправленно';
            }
        }

        if ($_POST['action'] == 61) {
            $city = intval($_POST['value']);
            $out = "";
            $out .= '<option selected="selected">Выберите район</option>';

            $result = db_query("SELECT * FROM module_districts WHERE city_id = " . $city . " ORDER BY name ASC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $out .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
        }
        if ($_POST['action'] == 62) {
            $city = intval($_POST['value']);
            $district_id = intval($_POST['value2']);

            $out .= '<option selected="selected">Выберите улицу</option>';

            $result = db_query("SELECT * FROM module_houses WHERE city_id = " . $city . " AND district_id = " . $district_id . " AND status = 1 GROUP BY street ORDER BY street, house_number DESC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $out .= '<option value="' . $row['street'] . '">' . $row['street'] . '</option>';
                }
            }
        }
        ///////////////////////ЭЦП ПОДПИСЬ //////////////

        //удаление дома
        if ($_POST['action'] == 64) {
            $id = intval($_POST['id']);

            $result = db_query("DELETE FROM module_houses WHERE id =" . $id . " ");
        }

        if ($_POST['action'] == 65) {

            $flat_id = intval($_POST['flat_id']);
            $rowid = intval($_POST['rowid']);
            $dolg = intval($_POST['dolg']);

            $out = '';
            $out = '<!-- request-spec-info -->
                    <div class="modal fade" id="openinfo">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content ">
                        <form action="https://pay.post.kz/ru/?flat_id=' . $flat_id . '&pack_invoice=' . $rowid . '&invoice_payment=' . $dolg . '" method="get" name="frmsendaddInvoicePayment" >
                       <input type="hidden" value="1" name="sendaddInvoicePayment">
                       <input type="hidden" value="' . $flat_id . '" name="flat_id">
                       <input type="hidden" value="' . $rowid . '" name="pack_invoice">
                            <div class="modal-header pd-x-20">
                                <h6 class="modal-title">Частичная оплата </h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pd-20">
                            <div class="form-group">
                            <label for="for_invoice_row" class="form-control-label">Сумма</label>

                            <select name="for_invoice_row" class="form-control"  id="for_invoice_row">

                                <option value="1" selected="">Расход на содержание дома	</option>
                                <option value="2">Взносы на капитальный ремонт	</option>
                            </select>
                        </div>
                            <div class="form-group">
                            <label for="invoice_payment" class="form-control-label">Общая сумма</label>
                            <input type="text" class="form-control" id="invoice_payment" name="invoice_payment" placeholder="Введите сумму" value="' . $dolg . '" required>
                        </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-success" >Отправить</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            </div>
                            </form>
                        </div>
                    </div><!-- modal-dialog -->
                    </div><!-- modal end -->';
        }

        //удаление дома
        if ($_POST['action'] == 66) {
            $id = intval($_POST['id']);

            $result = db_query("DELETE FROM module_flats_citizens WHERE id =" . $id . " ");
        }
        if ($_POST['action'] == 67) {
            $house_number = intval($_POST['value']);

            $osi_id = db_get_data("SELECT osi_id FROM module_houses WHERE id = " . $house_number, "osi_id");
            $osi_info = db_get_data("SELECT * FROM module_osi WHERE id = " . $osi_id);

            $out = "Контакты ОСИ: <b>" . $osi_info['name'] . " / " . $osi_info['phone'] . "</b>";
        }

        if ($_POST['action'] == 68) {
            //   $house_ids = cleanStr($_POST['value']);

            if (isset($_POST['value'])) {

                if (is_array($_POST['value'])) {
                    foreach ($_POST['value'] as $house) {
                        $house_ids .=  $house . ' , ';
                    }
                    $house_ids = mb_substr($house_ids, 0, -2);
                } else {
                    $house_ids =  intval($_POST['value']);
                }




                $out .= '<option selected="selected" value="0">Выберите квартиру</option>';
                // $result = db_query("SELECT * FROM module_flats WHERE house_id IN (".$house_ids.")");
                $result = db_query("SELECT t1.flat_id, t2.house_id, t1.citizen_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t2.house_id IN (" . $house_ids . ") GROUP BY t1.citizen_id");
                if (db_num_rows($result) > 0) {

                    while ($row = db_fetch_array($result)) {
                        $sovet = "";
                        $flats_citizen = "";
                        $house = db_get_data("SELECT * FROM module_houses WHERE id = " . $row['house_id']);
                        $flats_citizen = db_get_data("SELECT * FROM module_flats_citizens WHERE status = 1 AND flat_id = " . $row['flat_id']);
                        $citizen_name = db_get_data("SELECT * FROM module_citizens WHERE id = " . $row['citizen_id']);

                        if ($flats_citizen['sovet'] == 1) {
                            $sovet = '/ Советник дома';
                        } else {
                            $sovet = '/ Житель';
                        }

                        if ($citizen_name != "") {
                            $name = '/ ' . $citizen_name['name'];
                        } else {
                            $name = "/ Без жителя";
                        }

                        $out .= '<option value="' . $citizen_name['id'] . '">' . $house['street'] . ' ' . $house['house_number'] . ' кв. ' . $row['flat_number'] . ' ' . $name . ' ' . $sovet . ' </option>';
                    }
                }
            } else {
                $out .= '<option selected="selected" value="0">Выберите сначало дом</option>';
            }
        }
        if ($_POST['action'] == 69) {
            //   $house_ids = cleanStr($_POST['value']);
            if ($_POST['value2'] == 1) {
                if (isset($_POST['value'])) {

                    if (is_array($_POST['value'])) {
                        foreach ($_POST['value'] as $house) {
                            $house_ids .=  $house . ' ,';
                        }

                        $house_ids = mb_substr($house_ids, 0, -1);
                    } else {
                        $house_ids = intval($_POST['value']);
                    }


                    $out .= '<option selected="selected" value="0">Выберите квартиру</option>';

                    $result = db_query("SELECT t1.flat_id, t2.house_id, t1.citizen_id, t2.flat_number FROM module_flats_citizens AS t1 LEFT JOIN module_flats AS t2 ON t2.id = t1.flat_id WHERE t2.house_id IN (" . $house_ids . ") GROUP BY t1.citizen_id");
                    if (db_num_rows($result) > 0) {

                        while ($row = db_fetch_array($result)) {

                            $house = db_get_data("SELECT * FROM module_houses WHERE id = " . $row['house_id']);
                            $flats_citizen = db_get_data("SELECT * FROM module_flats_citizens WHERE status = 1 AND flat_id = " . $row['flat_id']);
                            $citizen_name = db_get_data("SELECT * FROM module_citizens WHERE id = " . $row['citizen_id']);
                            if ($citizen_name != "") {
                                $name = '/ ' . $citizen_name['name'];
                                if ($flats_citizen['sovet'] != 0) {
                                    $sovet = '/ Советник дома';
                                } else {
                                    $sovet = '/ Житель';
                                }
                            } else {
                                $name = "/ Без жителя";
                            }
                            $out .= '<option value="' . $citizen_name['id'] . '">' . $house['street'] . ' ' . $house['house_number'] . ' кв. ' . $row['flat_number'] . ' ' . $name . ' ' . $sovet . ' </option>';
                        }
                    }
                } else {
                    $out .= '<option selected="selected" value="0">Выберите сначало дом</option>';
                }
            } else {

                if (is_array($_POST['value'])) {

                    foreach ($_POST['value'] as $house) {
                        $house_ids .=  $house . ' ,';
                    }
                    $house_ids = mb_substr($house_ids, 0, -1);
                } else {
                    $house_ids = intval($_POST['value']);
                }

                $out .= '<option selected="selected" value="0">Выберите ОСИ</option>';

                $result = db_query("SELECT * FROM module_houses WHERE id IN (" . $house_ids . ")");
                if (db_num_rows($result) > 0) {
                    while ($row = db_fetch_array($result)) {
                        $osi = db_get_data("SELECT * FROM module_osi WHERE id = " . $row['osi_id']);
                        $out .= '<option value="' . $osi['id'] . '">' . $osi['name'] . '</option>';
                    }
                }
            }
        }
        if ($_POST['action'] == 70) {
            $id = intval($_POST['id']);
            $status_number = intval($_POST['status_number']);
            $result = db_query("UPDATE module_polls SET `status` = " . $status_number . " WHERE id = " . $id);
        }
        if ($_POST['action'] == 71) {
            $pollid = intval($_POST['pollid']);

            $sql = "INSERT INTO module_poll_protocols SET creator_id = '" . $_SESSION['id'] . "', creator_type = '" . $_SESSION['type'] . "', poll_id = '" . $pollid . "', time_created = NOW()";
            db_query($sql);

            $result = db_query("UPDATE module_polls SET `secretar_status` = 1 WHERE id = " . $pollid);

            //**********************Сделать функцию для создания протокола и сохранение его в папку с файлами */

        }
        if ($_POST['action'] == 72) {
            $pollid = intval($_POST['pollid']);

            $result = db_query("UPDATE module_poll_protocols SET `status` = 1 WHERE id = " . $pollid);
            $result = db_query("UPDATE module_polls SET `status` = 3 WHERE id = " . $pollid);
        }
        if ($_POST['action'] == 73) {
            $pollid = intval($_POST['pollid']);


            $result = db_query("UPDATE module_polls SET end_time = NOW() WHERE id = " . $pollid);
            $result = db_query("UPDATE module_polls SET `status` = 4  WHERE id = " . $pollid);
        }
        if ($_POST['action'] == 74) {
            $pollid = intval($_POST['pollid']);


            $result = db_query("UPDATE module_polls SET dosrochno_time = NOW() WHERE id = " . $pollid);
            $result = db_query("UPDATE module_polls SET `status` = 3, dosrochno = 1 WHERE id = " . $pollid);
        }

        if ($_POST['action'] == 75) {
            $pollid = intval($_POST['pollid']);

            $sql = "INSERT INTO module_polled_sovet SET user_id = '" . $_SESSION['id'] . "', poll_id = '" . $pollid . "', paper = 1, time_created = NOW()";
            db_query($sql);

            //Вытащить номер протокола как то
            $sql = "INSERT INTO module_polled_sovet SET user_id = '" . $_SESSION['id'] . "', protocol_id = 0, paper = 1, time_created = NOW()";
            db_query($sql);
        }

        //Подпись ЭЦП для советников дома
        if ($_POST['action'] == 76) {
            $poll_id = intval($_POST['poll_id']);

            if (!file_exists('./files/polls/' . $poll_id . '/sovet')) {
                mkdir('./files/polls/' . $poll_id . '/sovet', 0775, true);
            }

            $polled = db_query("SELECT * FROM module_polled_sovet where signed=1 AND user_id=" . $_SESSION['id'] . " AND poll_id = " . $poll_id);
            if (db_num_rows($polled) > 0) {
                $fileUrl = 'sovet';
                $signed = 'signed_';
            } else {
                $fileUrl = 'citizen';
                $signed = 'signed_';
            }

            $result = db_query("SELECT * FROM module_polled where poll_id = " . $poll_id);
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {

                    $result2 = null;
                    $result2 = signFileAndSave(
                        $_POST['p12'],
                        $_POST['password'],
                        "./files/polls/" . $poll_id . "/citizen" . "/signed_" . $_POST['fileName'] . "_" . $row['flat_id'] . ".pdf",
                        "./files/polls/" . $poll_id . "/sovet" . "/sovet_signed" . $_POST['fileName'] . "_" . $row['flat_id'] . ".pdf"
                    );

                    // $sign_polled = db_query("UPDATE module_polled SET time_signed_polled = NOW(), sign_polled = 1 WHERE id = " . $row['id']);
                }
            }


            $out = $result2;
        }

        //Подпись ЭЦП для жителей
        if ($_POST['action'] == 63) {
            $poll_id = intval($_POST['poll_id']);

            $result = db_query("SELECT * FROM module_polled where user_id = " . $_SESSION['id'] . " AND poll_id = " . $poll_id);
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {

                    $result2 = null;
                    $result2 = signFileAndSave(
                        $_POST['p12'],
                        $_POST['password'],
                        "./files/polls/" . $poll_id . "/citizen" . "/" . $_POST['fileName'] . "_" . $row['flat_id'] . ".pdf",
                        "./files/polls/" . $poll_id . "/citizen/signed_" . $_POST['fileName'] . "_" . $row['flat_id'] . ".pdf"
                    );

                    $sign_polled = db_query("UPDATE module_polled SET time_signed_polled = NOW(), sign_polled = 1 WHERE id = " . $row['id']);
                }
            }


            $out = $result2;
        }

        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////
        //////////////////////////////////////////////

        //Выбор факультета опираясь на универ
        if ($_POST['action'] == 101) {
            $univer_id = intval($_POST['value']);
            $out = "";
            $out .= '<option selected="selected">Выберите факультет</option>';

            $result = db_query("SELECT * FROM module_facultets WHERE universitet_id = " . $univer_id . " ORDER BY name ASC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $out .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
        }

        //Удаление форм и всех зависимостей
        if ($_POST['action'] == 102) {
            if ($_SESSION['type'] == 1) {
                $form_id = intval($_POST['form_id']);

                //Перед удалением удаляем все что связано с этой формой-таблицей
                $result = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);

                db_query("DROP TABLE " . $result['table_name']);
                db_query("DELETE FROM module_validations WHERE table_id =" . $form_id);
                db_query("DELETE FROM module_table_names WHERE id = " . $form_id);
            }
        }

        //Меням статус у формы
        if ($_POST['action'] == 103) {
            if ($_SESSION['type'] == 1) {
                $form_id = intval($_POST['form_id']);
                $form_status = intval($_POST['form_status']);
                //Обновляем статус
                db_query("UPDATE module_table_names SET status = " . $form_status . " WHERE id = " . $form_id);
            }
        }

        //Меням статус у пользователя
        if ($_POST['action'] == 104) {
            if ($_SESSION['type'] == 1) {
                $user_id = intval($_POST['user_id']);
                $user_status = intval($_POST['user_status']);
                //Обновляем статус
                db_query("UPDATE module_users SET status = " . $user_status . " WHERE id = " . $user_id);
            }
        }

        //Удаляем пользователя
        if ($_POST['action'] == 105) {
            if ($_SESSION['type'] == 1) {
                $user_id = intval($_POST['user_id']);
                //Удаляем
                db_query("DELETE FROM module_users WHERE id =" . $user_id);
            }
        }
        //Настройки пользователя
        if ($_POST['action'] == 106) {

            $user_id = intval($_POST['user_id']);

            $user_info = db_get_data("SELECT * FROM module_users WHERE id = " . $user_id);

            $user_types = db_get_array("SELECT * FROM module_roles", "id", "name");
            $user_type_options = getSelectOptionWithOthers($user_types, $user_info['type'], "Выберите тип пользователя");

            $user_facultets = db_get_array("SELECT * FROM module_facultets", "id", "name");
            $user_facultet_options = getSelectOptionWithOthers($user_facultets, $user_info['facultet_id'], "Выберите факультет");

            $user_univer = db_get_array("SELECT * FROM module_universities", "id", "name");
            $user_univer_id = db_get_data("SELECT * FROM module_facultets WHERE id = " . $user_info['facultet_id']);
            $user_univer_options = getSelectOptionWithOthers($user_univer, $user_univer_id['universitet_id'], "Выберите университет");
            // $years = db_get_array("SELECT * FROM module_years", "name", "name");
            //assignList("YEAR_LIST", $years);

            // $universities = db_get_array("SELECT * FROM module_universities", "id", "name");
            // assignList("UNIVER_LIST", $universities);

            $out = '';
            $out = '<!-- request-spec-info -->
            <div class="modal fade" id="opendialog"  role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Настройки пользователя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" name="updateUserForm" enctype="multipart/form-data">
                        <input type="hidden" value="1" name="updateUserSend">
                        <input type="hidden" value="' . $user_id . '" name="user_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="fio" class="form-control-label">ФИО</label>
                                    <input type="text" class="form-control" name="fio" id="fio" placeholder="Введите ФИО пользователя" onKeyUp="translitUserName()" value="' . $user_info['fio'] . '" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="login" class="form-control-label">Логин</label>
                                    <input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин" value="' . $user_info['username'] . '" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="password" class="form-control-label">Почта</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Введите почту" value="' . $user_info['email'] . '" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="password" class="form-control-label">Номер телефона</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Введите номер телефона" value="' . $user_info['phone_number'] . '" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="password" class="form-control-label">Адрес</label>
                                    <input type="text" class="form-control" name="adress" id="adress" placeholder="Введите адрес" value="' . $user_info['adress'] . '" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="user_type" class="form-control-label">Тип пользователя</label>
                                    <select name="user_type" id="user_type" class="form-control select2-show-search" placeholder="" >
                                        ' . $user_type_options . '
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-control-label">Университет</label>
                                    <select name="univer_id" id="univer_id" class="form-control select2-show-search" onchange="changefacultets();" placeholder="" >
                                        ' . $user_univer_options . '
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-control-label">Факультет (не обязателен)</label>
                                    <select name="facultet_id" id="facultet_id" class="form-control select2-show-search" placeholder="" >
                                    ' . $user_facultet_options . '
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Обновить данные</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
        }
        //Изменить пароль
        if ($_POST['action'] == 107) {

            $user_id = intval($_POST['user_id']);

            $out = '';
            $out = '<!-- request-spec-info -->
            <div class="modal fade" id="opendialog"  role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменить пароль</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" name="changePassUserForm" enctype="multipart/form-data">
                        <input type="hidden" value="1" name="changePassUserSend">
                        <input type="hidden" value="' . $user_id . '" name="user_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="newpassword" class="form-control-label">Новый пароль</label>
                                    <input type="text" class="form-control" name="newpassword" id="newpassword" placeholder="Введите пароль" >
                                    <button type="button" for="newpassword" onclick="generateNewPass();" class="btn btn-primary btn-sm btn-block">Сгенерировать пароль</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Обновить данные</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
        }
        if ($_POST['action'] == 108) {
            $passwordCount = 8;

            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < $passwordCount; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $out = implode($pass); //turn the array into a string

        }

        if ($_POST['action'] == 109) {

            $form_id = intval($_POST['form_id']);

            $form_data = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);
            $column_names  = null;
            $result = db_query("SELECT * FROM module_validations WHERE table_id = " . $form_data['id'] . " ORDER BY order_number ASC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $column_names .= '<li class="listorder">' . $row['column_label'] . '</li>';
                }
            }
            $currentGroups = null;
            $result = db_query("SELECT * FROM module_groups WHERE table_id = " . $form_id . " ");
            if (db_num_rows($result) > 0) {
                $currentGroups .= '<div class="form-group col-12">
                <label for="fio" class="form-control-label">Существующие группы </label>
                <ul class="list-group">';
                while ($row = db_fetch_array($result)) {
                    $arr = unserialize($row['columns']);
                    $string = implode(", ", $arr);

                    $currentGroups .= '<li class="list-group-item justify-content-between">Столбцы ' . $string . ' объяденены в ' . $row['name'] . '<a class="badgetext badge badge-danger badge-pill text-white" onclick="deleteFormGroup(' . $row['id'] . ');">Удалить</a></li>';
                }
                $currentGroups .= '</ul>
                </div>';
            }




            $out = '';
            $out = '<!-- Not accepted request osi -->
            <div class="modal fade" id="update-setting-form" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title">Настройки формы</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="updateSettingForm" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="updateSettingFormSend">
                            <input type="hidden" value="0" name="number" id="number">
                            <input type="hidden" value="' . $form_id . '" name="form_id" id="form_id">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="fio" class="form-control-label">Название столбцев </label>
                                        <ul class="list-group">
                                            ' . $column_names . '
                                        </ul>
                                    </div>
                                    ' . $currentGroups . '
                                    <div class="form-group col-12">

                                        <button type="button" class="btn btn-success btn-block" onclick="addFormGroup();">Добавить группу</button>
                                    </div>
                                    <div class="form-group col-12" id="groups"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
        }

        //Удаляем пользователя
        if ($_POST['action'] == 110) {
            if ($_SESSION['type'] == 1) {
                $form_group_id = intval($_POST['form_group_id']);
                //Удаляем
                db_query("DELETE FROM module_groups WHERE id =" . $form_group_id);
            }
        }

        //ГЛАВНАЯ ФУНКЦИЯ
        if ($_POST['action'] == 111) {

            $form_id = intval($_POST['form_id']);
            //Проверяем какие графы есть
            $formElements = "";
            $result = db_query("SELECT * FROM module_validations where table_id = '" . $form_id . "' ORDER BY order_number ASC");
            $form_data = db_get_data("SELECT * FROM module_table_names where id = '" . $form_id . "' ORDER BY id ASC");

			if($form_id == "52"){
			$px = "400px";
			$vscroll = "vscroll";
			}else{
			$px = "700px";
			$vscroll = "";
			}
            if (db_num_rows($result) > 0) {
                $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmAddRecord">
                <input type="hidden" name="add_record" value="1">
                <input type="hidden" name="form_id" value="' . $form_id . '" id="form_id">
                <div class="modal-body" >
                <div class="content" style="'.$px.'">
                <div class="row">';

                while ($row = db_fetch_array($result)) {
                    $formElements .= getFormElementHTML($row['column_type'], $row['column_name'], $row['column_label'], $row['column_placeholder'], $row['column_required'], "", $row['id'], "");
                }
                $formElements .= '</div></div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div></form>';
            }

            $out = '<!-- ADD GENERATE FORM -->
            <div class="modal fade" id="add-form" role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document" style="max-width: 90%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">Добавить запись формы / ' . $form_data['form_name'] . '</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ' . $formElements . '
                        </div>
                </div>
            </div>';
        }

        //Удаляем запись из таблицы как АДМИН
        if ($_POST['action'] == 112) {
            if ($_SESSION['type'] == 1) {
                $form_id = intval($_POST['form_id']);
                $form_data = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);
                $row_id = intval($_POST['row_id']);
                //Удаляем
                db_query("DELETE FROM " . $form_data['table_name'] . " WHERE id =" . $row_id);
            }
        }

        //Удаляем категории форм
        if ($_POST['action'] == 113) {
            if ($_SESSION['type'] == 1) {
                $category_id = intval($_POST['category_id']);
                //Удаляем
                db_query("DELETE FROM module_categories WHERE id =" . $category_id);
            }
        }

        //Меням статус категории
        if ($_POST['action'] == 114) {
            if ($_SESSION['type'] == 1) {
                $category_id = intval($_POST['category_id']);
                $category_status = intval($_POST['category_status']);
                //Обновляем статус
                db_query("UPDATE module_categories SET status = " . $category_status . " WHERE id = " . $category_id);
            }
        }

        //Меням статус факультета
        if ($_POST['action'] == 115) {
            if ($_SESSION['type'] == 1) {
                $facultet_id = intval($_POST['facultet_id']);
                $facultet_status = intval($_POST['facultet_status']);
                //Обновляем статус
                db_query("UPDATE module_facultets SET status = " . $facultet_status . " WHERE id = " . $facultet_id);
            }
        }

        //Удаляем факультет
        if ($_POST['action'] == 116) {
            if ($_SESSION['type'] == 1) {
                $facultet_id = intval($_POST['facultet_id']);
                //Удаляем
                db_query("DELETE FROM module_facultets WHERE id =" . $facultet_id);
            }
        }

        //Удаляем факультет
        if ($_POST['action'] == 117) {
            if ($_SESSION['type'] == 1) {
                $univer_id = intval($_POST['univer_id']);
                //Удаляем
                db_query("DELETE FROM module_universities WHERE id =" . $univer_id);
            }
        }

        //Меням статус университета
        if ($_POST['action'] == 118) {
            if ($_SESSION['type'] == 1) {
                $univer_id = intval($_POST['univer_id']);
                $univer_status = intval($_POST['univer_status']);
                //Обновляем статус
                db_query("UPDATE module_universities SET status = " . $univer_status . " WHERE id = " . $univer_id);
            }
        }

        //Выбираем формы из
        if ($_POST['action'] == 119) {
            $category_id = intval($_POST['value']);
            $out = "";
            $out .= '<option selected="selected">Выберите категорию форм</option>';

            $result = db_query("SELECT * FROM module_table_names WHERE category_id = " . $category_id . " ORDER BY form_name ASC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $out .= '<option value="' . $row['id'] . '">' . $row['form_name'] . '</option>';
                }
            } else {
                $out = '<option selected="selected">Выбранной категории нет форм</option>';
            }
        }

        //Меням статус настройки форм
        if ($_POST['action'] == 120) {
            if ($_SESSION['type'] == 1) {
                $access_id = intval($_POST['access_id']);
                $access_status = intval($_POST['access_status']);
                //Обновляем статус
                db_query("UPDATE module_accesses SET status = " . $access_status . " WHERE id = " . $access_id);
            }
        }

        //Удаляем настройки форм
        if ($_POST['action'] == 121) {
            if ($_SESSION['type'] == 1) {
                $access_id = intval($_POST['access_id']);
                //Удаляем
                db_query("DELETE FROM module_accesses WHERE id =" . $access_id);
            }
        }

        //Удаляем запись из таблицы как АДМИН
        if ($_POST['action'] == 122) {
            if ($_SESSION['type'] == 4 || $_SESSION['type'] == 3 || $_SESSION['type'] == 2 || $_SESSION['type'] == 1) {
                $form_id = intval($_POST['form_id']);
                $form_data = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);
                $row_id = intval($_POST['row_id']);
                //Удаляем
                db_query("DELETE FROM " . $form_data['table_name'] . " WHERE id =" . $row_id);
				db_query("DELETE FROM module_balls WHERE form_id ='" . $form_id. "' AND row_id= '". $row_id."'");
            }
        }

        //РЕДАКТИРУЕМ СТРОКУ ДЛЯ ЛЮБОЙ ФОРМЫ
        if ($_POST['action'] == 123) {

            $form_id = intval($_POST['form_id']);
            $row_id = intval($_POST['row_id']);
            //Проверяем какие графы есть
            $formElements = "";
            $result = db_query("SELECT * FROM module_validations where table_id = '" . $form_id . "' ORDER BY order_number ASC");
            $table_name = db_get_data("SELECT table_name FROM module_table_names WHERE id = " . $form_id, "table_name");
            $form_name = db_get_data("SELECT form_name FROM module_table_names WHERE id = " . $form_id, "form_name");
            if (db_num_rows($result) > 0) {
                $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmEditRecord">
                <input type="hidden" name="edit_record" value="1">
                <input type="hidden" name="form_id" value="' . $form_id . '" id="form_id">
                <input type="hidden" name="row_id" value="' . $row_id . '" id="row_id">
                <div class="modal-body content vscroll"  style="max-height:500px">
                <div class="row">';

                while ($row = db_fetch_array($result)) {
                    $rowData = db_get_data("SELECT " . $row['column_name'] . " FROM " . $table_name . " WHERE id = " . $row_id, $row['column_name']);
                    if ($row['column_type'] != "file") {
                        $formElements .= getFormElementHTML($row['column_type'], $row['column_name'], $row['column_label'], $row['column_placeholder'], $row['column_required'], $rowData, $row['id'],"");
                    } else {
                        $formElements .= getFormElementHTML($row['column_type'], $row['column_name'], $row['column_label'] . " <b>Если вы обновите файл предыдущий файл удалиться. Если сохраните как есть файл НЕ останиться прежним</b>", $row['column_placeholder'], 2, $rowData, $row['id'],"");
                    }
                }
                $formElements .= '</div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Обновить данные</button>
                </div></form>';
            }

            $out = '<!-- ADD GENERATE FORM -->
            <div class="modal fade" id="edit-form" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title">Редактировать запись формы / ' . $form_name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ' . $formElements . '
                        </div>
                </div>
            </div>';
        }

        //РЕДАКТИРУЕМ СТРОКУ ДЛЯ ЛЮБОЙ ФОРМЫ
        if ($_POST['action'] == 124) {

            $row_id = intval($_POST['row_id']);
            //Проверяем какие графы есть
            $formElements = "";
            $result = db_query("SELECT * FROM module_categories where id = " . $row_id);

            if (db_num_rows($result) > 0) {
                $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmEditCategory">
                <input type="hidden" name="edit_category" value="1">
                <input type="hidden" name="category_id" value="' . $row_id . '" id="category_id">
                <div class="modal-body content vscroll"  style="max-height:500px">
                <div class="row">';
                $category_data = db_get_data("SELECT * FROM module_categories where id = " . $row_id);
                $direction = db_get_data("SELECT * FROM module_directions where id = " . $category_data['direction_id']);
                $name = $category_data['name'];

                $directions = db_get_array("SELECT * FROM module_directions", "id", "name");
                $direction_data = getSelectOptionWithOthers($directions, $category_data['direction_id'], "Выберите вид деятельности");

                $formElements .= '<div class="form-group col-12">
                            <label for="direction_id" class="form-control-label">Вид деятельности</label>
                            <select required class="form-control select2-show-search" name="direction_id" id="direction_id">
                                ' . $direction_data . '
                            </select>
                        </div>';

                $formElements .= '<div class="form-group col-12">
        <label class="form-label">Категория</label>
        <textarea class="form-control" id="category" name="category" rows="5" placeholder="Введите название категории" required>' . $name . '</textarea>
    </div>';
                $formElements .= '</div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Обновить данные</button>
                </div></form>';
            }

            $out = '<!-- ADD GENERATE FORM -->
            <div class="modal fade" id="edit-category" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title">Редактировать категорию</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ' . $formElements . '
                        </div>
                </div>
            </div>';
        }

        //РЕДАКТИРУЕМ НАСТРОЙКИ ФОРМ
        if ($_POST['action'] == 125) {

            $row_id = intval($_POST['row_id']);
            //Проверяем какие графы есть
            $formElements = "";

            $access_data = db_get_data("SELECT * FROM module_accesses where id = " . $row_id);
            $tables = db_get_data("SELECT * FROM module_table_names WHERE id = " . $access_data['form_id'], "id", "name");

            $forms = db_get_array("SELECT * FROM module_table_names", "id", "form_name");
            $forms_data = getSelectOptionWithOthers($forms, $access_data['form_id'], "Выберите форму");

            $categories_selected = db_get_data("SELECT id FROM module_categories", "id");
            $categories = db_get_array("SELECT * FROM module_categories", "id", "name");

            $category_data = getSelectOptionWithOthers($categories, $categories_selected, "Выберите категорию");

            $univers = db_get_array("SELECT * FROM module_universities", "id", "name");
            $univer_data = getSelectOptionWithOthers($univers, $access_data['universitet_id'], "Выберите универ");

            $facultets = db_get_array("SELECT * FROM module_categories", "id", "name");
            $facultet_data = getSelectOptionWithOthers($facultets, $access_data['facultet_id'], "Выберите факультет");

            $result = db_query("SELECT * FROM module_accesses where id = " . $row_id);
            $date =  date("d-m-Y", strtotime($access_data['time_end']));
            if (db_num_rows($result) > 0) {
                $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmEditAccesses">
                <input type="hidden" name="updateAccessesSend" value="1">
                <input type="hidden" name="accesses_id" value="' . $row_id . '" id="accesses_id">
                <div class="modal-body content vscroll" style="max-height:500px">
                <div class="row">';
                $formElements .= '<div class="form-group col-12">
                            <label for="category_form_id" class="form-control-label">Категория форм:</label>
                            <select required class="form-control select2-show-search" name="category_form_id" id="category_form_id" onchange="changeForms();" data-placeholder="">
                               ' . $category_data . '
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="form_id" class="form-control-label">Форма:</label>
                            <select required class="form-control select2-show-search" name="form_id" id="form_id" data-placeholder="">
                            ' . $forms_data . '
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="univer_id" class="form-control-label">Университет</label>
                            <select required class="form-control select2-show-search" name="univer_id" id="univer_id" onchange="changefacultets();" data-placeholder="">
                                ' . $univer_data . '
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="facultet_id" class="form-control-label">Факультет</label>
                            <select required class="form-control  select2-show-search" name="facultet_id" id="facultet_id" data-placeholder="">
                            ' . $facultet_data . '
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label class="form-label">Доступно до</label>
                            <div class="wd-200 mg-b-30">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                    </div><input class="flatpickr flatpickr-input form-control" name="enableDate" id="enableDate" type="text" placeholder="Выберите дату" value="' . $date . '">
                                </div>
                            </div>
                        </div>';
                $formElements .= '</div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Обновить данные</button>
                </div></form>';
            }

            $out = '<!-- ADD GENERATE FORM -->
            <div class="modal fade" id="edit-form-settings" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title">Редактировать категорию</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ' . $formElements . '
                        </div>
                </div>
            </div>';
        }

        //Меням статус настройки НИР
        if ($_POST['action'] == 126) {
            if ($_SESSION['type'] == 1) {
                $nir_id = intval($_POST['nir_id']);
                $nir_status = intval($_POST['nir_status']);
                //Обновляем статус
                db_query("UPDATE module_nir_work_type SET status = " . $nir_status . " WHERE id = " . $nir_id);
            }
        }

        //Удаляем настройки НИР
        if ($_POST['action'] == 127) {
            if ($_SESSION['type'] == 1) {
                $nir_id = intval($_POST['nir_id']);
                //Удаляем
                db_query("DELETE FROM module_nir_work_type WHERE id =" . $nir_id);
            }
        }

        //Удаляем настройки НИР запись
        if ($_POST['action'] == 128) {
            if ($_SESSION['type'] == 1) {
                $nir_record_id = intval($_POST['nir_record_id']);
                //Удаляем
                db_query("DELETE FROM module_nirs WHERE id =" . $nir_record_id);
            }
        }

        //Отправляем данные на проверку (Преподаватель)
        //ТУТ ФУНКЦИЯ ВЫДАЧИ БАЛЛОВ ЗА ЗАПОЛНЕНИЯ ТУТ ФОРМУЛА
        if ($_POST['action'] == 129) {

            $form_id = intval($_POST['form_id']);
            $row_id = intval($_POST['row_id']);
            //Находим таблицу
            $form_name = db_get_data("SELECT * FROM module_table_names where id = " . $form_id);

            $result2 = db_query("SELECT * FROM module_validations WHERE table_id = " . $form_id);
            $maxBalls = 0;
            $soavtors_count = 1; //ВОТ НАЧАЛО ФОРМУЛЫ
            $system_unit_count = 1;
            $unit_count = 1;
            while ($row2 = db_fetch_array($result2)) {
                if ($row2['column_type'] == "select") {
                    $form_column_value = db_get_data("SELECT " . $row2['column_name'] . " as colName FROM " . $form_name['table_name'] . " where id = " . $row_id, "colName");
                    $ball = db_get_data("SELECT ball FROM module_options where validation_id = " . $row2['id'] . " AND option_name = '" . $form_column_value . "' ", "ball");
                    $maxBalls += $ball;
                } else if ($row2['column_type'] == "soavtor") {
                    $soavtors_count = db_get_data("SELECT " . $row2['column_name'] . " as colName FROM " . $form_name['table_name'] . " where id = " . $row_id, "colName");
                } else if ($row2['column_type'] == "unit") {
                    $system_unit_count = $form_name['count_pl'];
                    $unit_count = db_get_data("SELECT " . $row2['column_name'] . " as colName FROM " . $form_name['table_name'] . " where id = " . $row_id, "colName");
                }
            }

            $all_count =  $maxBalls + $form_name['balls']; //v1
            $all_count = ($all_count * ($unit_count / $system_unit_count)) / $soavtors_count; //v2 ФОРМУЛА
            $all_count = round($all_count, 2);
            //Находим поле со статусом и отправляем (меняем статус для того чтобы данные отправить и не давать редактировать или удалять
            db_query("UPDATE " . $form_name['table_name'] . " SET data_status = 1 WHERE id = " . $row_id);
            //Добавляем баллы написать функцию деления на типы категорий
            $sql = "INSERT module_balls SET category_id = '" . $form_name['category_id'] . "',
											row_id = '" . $row_id . "',
                                            form_id = '" . $form_id . "',
											ball = '" . $all_count . "',
											delit = 1,
                                            user_id = '" . $_SESSION['id'] . "',
                                            user_type = '" . $_SESSION['type'] . "',
                                            status = 1,
											time_created = NOW()";
            db_query($sql);
            $out = $all_count;
        }

        if ($_POST['action'] == 130) {

            $row_id = intval($_POST['row_id']);
            $form_id = intval($_POST['form_id']);
            //Проверяем какие графы есть
            $formElements = "";

            $balls = db_get_data("SELECT * FROM module_balls where form_id = '" . $form_id . "' AND row_id = '" . $row_id . "' ");

            $ball_id = $balls['id'];
            $ball_number = $balls['ball'];
            $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmEditBall">
                <input type="hidden" name="editBall" value="1">
                <input type="hidden" name="ball_id" value="' . $ball_id . '" id="ball_id">
                <div class="modal-body content vscroll" style="max-height:500px">
                <div class="row">';
            $formElements .= '<div class="form-group col-12">
                            <label for="ball" class="form-control-label">Балл:</label>
                            <input required class="form-control" name="ball" id="ball" value="' . $ball_number . '" placeholder="Введите бал"/>
                        </div>';
            $formElements .= '</div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div></form>';

            $out = null;
            $out = '<div class="modal fade" id="editBallForm" role="dialog" name="editBallForm" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Редактировать балл</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ' . $formElements . '
                        </div>
                </div>
            </div>';
        }

        if ($_POST['action'] == 131) {

            $form_id = intval($_POST['form_id']);

            //$form_data = db_get_data("SELECT * FROM module_table_names WHERE id = " . $form_id);
            $column_names  = null;
            $result = db_query("SELECT * FROM module_validations WHERE table_id = " . $form_id . " ORDER BY order_number ASC");
            $index = 0;
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    if ($row['column_type'] == "select") {
                        $index++;
                        $column_names .= '<option value="' . $row['id'] . '">' . $row['column_label'] . '</option>';
                    }
                }
                if ($index == 0) {
                    $column_names = '<option value="" disabled>Извините в таблице нет select-ов</option>';
                }
            }

            $currentSelects = null;
            $result = db_query("SELECT * FROM module_options WHERE table_id = " . $form_id . " ");
            if (db_num_rows($result) > 0) {
                $currentSelects .= '<div class="form-group col-12">
                <label for="fio" class="form-control-label">Существующие select-ы </label>
                <ul class="list-group">';
                while ($row = db_fetch_array($result)) {
                    $validations_data = db_get_data("SELECT * FROM module_validations WHERE id = " . $row['validation_id']);
                    // $arr = unserialize($row['columns']);
                    // $string = implode(", ", $arr);
                    $string = $validations_data['column_label'];
                    $currentSelects .= '<li class="list-group-item justify-content-between">Select ' . $string . ' option ' . $row['option_name'] . ' / ' . $row['ball'] . ' баллов<a class="badgetext badge badge-danger badge-pill text-white" onclick="deleteOption(' . $row['id'] . ');">Удалить</a></li>';
                }
                $currentSelects .= '</ul>
                </div>';
            }

            $out = '';
            $out = '<!-- Not accepted request osi -->
            <div class="modal fade" id="editSelects" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Настройки формы</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="editSelectsForm" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="editSelectsFormSend">
                            <input type="hidden" value="0" name="numberj" id="numberj">
                            <input type="hidden" value="' . $form_id . '" name="form_id" id="form_id">
                            <div class="modal-body vscroll" style="height:500px; width: 800px;">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="fio" class="form-control-label">Select и options</label>
                                        <select required class="form-control select2-show-search" name="column_id" id="column_id"  required>
                                            ' . $column_names . '
                                        </select>
                                    </div>
                                    ' . $currentSelects . '
                                    <div class="form-group col-12">

                                        <button type="button" class="btn btn-success btn-block" onclick="addOption();">Добавить группу</button>
                                    </div>
                                    <div class="form-group col-12" id="options"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
        }

        //Удаляем option у select
        if ($_POST['action'] == 132) {
            if ($_SESSION['type'] == 1) {
                $option_id = intval($_POST['option_id']);
                //Удаляем
                db_query("DELETE FROM module_options WHERE id =" . $option_id);
            }
        }
        //Удаляем все данные со всех таблиц и начинаем новую жизнь
        if ($_POST['action'] == 133) {
            if ($_SESSION['type'] == 1) {

                $result = db_query("SELECT * FROM module_table_names");
                if (db_num_rows($result) > 0) {
                    while ($row = db_fetch_array($result)) {
                        db_query("TRUNCATE TABLE " . $row['table_name']);
                    }
                }

                db_query("TRUNCATE TABLE module_table_names");
                db_query("TRUNCATE TABLE module_uchebnaya");
                db_query("TRUNCATE TABLE module_balls");

                //Все селекты
                //db_query("TRUNCATE TABLE module_options");
                //db_query("TRUNCATE TABLE module_validations");

                //если нужно полностью почистить тогда раскоментируйте код
                //db_query("TRUNCATE TABLE module_facultets");
                //db_query("TRUNCATE TABLE module_universities");
                //db_query("TRUNCATE TABLE module_nir_work_type");
                //db_query("TRUNCATE TABLE module_groups");
                //db_query("TRUNCATE TABLE module_accesses");
                $out = 2;
            } else {
                $out = 1;
            }
        }

//Обновляем баллы (осторожно если нажмете ваши ручные баллы будут сменены на автоматический рассчет)
        if ($_POST['action'] == 134) {

                $form_id = intval($_POST['form_id']);
               	$form_name = db_get_data("SELECT * FROM module_table_names where id = " . $form_id);



				$result = db_query("SELECT * FROM ".$form_name['table_name']);
				while ($row = db_fetch_array($result)) {

					$result2 = db_query("SELECT * FROM module_validations WHERE table_id = " . $form_id);
					$maxBalls = 0;
					$soavtors_count = 1; //ВОТ НАЧАЛО ФОРМУЛЫ
					$system_unit_count = 1;
					$unit_count = 1;
					$all_count = 0;
					while ($row2 = db_fetch_array($result2)) {
						if ($row2['column_type'] == "select") {
							$form_column_value = db_get_data("SELECT " . $row2['column_name'] . " as colName FROM " . $form_name['table_name'] . " where id = " . $row['id'], "colName");
							$ball = db_get_data("SELECT ball FROM module_options where validation_id = " . $row2['id'] . " AND option_name = '" . $form_column_value . "' ", "ball");
							$maxBalls += $ball;
						} else if ($row2['column_type'] == "soavtor") {
							$soavtors_count = db_get_data("SELECT " . $row2['column_name'] . " as colName FROM " . $form_name['table_name'] . " where id = " . $row['id'], "colName");
						} else if ($row2['column_type'] == "unit") {
							$system_unit_count = $form_name['count_pl'];
							$unit_count = db_get_data("SELECT " . $row2['column_name'] . " as colName FROM " . $form_name['table_name'] . " where id = " . $row['id'], "colName");
						}
					}


					$all_count =  $maxBalls + $form_name['balls']; //v1
					$all_count = ($all_count * ($unit_count / $system_unit_count)) / $soavtors_count; //v2 ФОРМУЛА
					$all_count = round($all_count, 2);
					//Находим поле со статусом и отправляем (меняем статус для того чтобы данные отправить и не давать редактировать или удалять
					//db_query("UPDATE " . $form_name['table_name'] . " SET data_status = 1 WHERE id = " . $row['id']);
					//Добавляем баллы написать функцию деления на типы категорий

					//$ball_id = db_get_data("SELECT id FROM module_balls where form_id = " . $form_id . " and row_id =  " . $row_id, "id");
					$sql = "UPDATE module_balls SET ball = '" . $all_count . "' WHERE form_id = " . $form_id . " and row_id =  " . $row['id'];
					db_query($sql);
				}


		}


        ///////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////
         //Удаляем данные с любых таблиц
        if ($_POST['action'] == "deleteID") {
            if ($_SESSION['type'] == 1 || $_SESSION['type'] == 3) {
                try{
                    $table = cleanStr($_POST['table']);
                    $general_id = intval($_POST['id']);
                    //Удаляем
                    db_query("DELETE FROM $table WHERE id =" . $general_id);
                    $out = 200;
                }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                        $out = 401;
                }

            }else{
                $out = 401;
            }
        }

        //РЕДАКТИРУЕМ СТРОКУ ДЛЯ ЛЮБОЙ ФОРМЫ
        if ($_POST['action'] == "updateID") {

            if ($_SESSION['type'] == 1 || $_SESSION['type'] == 3) {
                try{
                    $table = cleanStr($_POST['table']);
                    $general_id = intval($_POST['id']);

                    $result = db_query("SHOW COLUMNS FROM $table;");
                     $formElements = null;
                    if (db_num_rows($result) > 0) {
                        $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmEditRecord">
                <input type="hidden" name="update" value="1">
                <input type="hidden" name="table" value="' . $table . '" id="table_id">
                <input type="hidden" name="general_id" value="' . $general_id . '" id="general_id">
                <div class="modal-body content">
                <div class="row">';

                        while ($row = db_fetch_array($result)) {
                            $formElements .= getEditFormElementInHTML($row['Field'], $row['Type'], $row['Null'], $row['Key'], $row['Default'], $row['Extra'],$table, $general_id);
                        }

                        $formElements .= '</div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">'.getval("STR_CLOSE").'</button>
                    <button type="submit" class="btn btn-primary">'.getval("STR_UPDATE").'</button>
                </div></form>';
                    }

                $out = '<div class="modal fade" id="editForm" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title">'.getval("STR_EDIT_RECORD").' #'. $general_id.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="'.getval("STR_CLOSE").'">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        ' . $formElements . '
                        </div>
                </div>
            </div>';

                }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                        $out = 401;
                }

            }else{
                $out = 401;
            }


        }


         //РЕДАКТИРУЕМ СТРОКУ ДЛЯ ЛЮБОЙ ФОРМЫ
        if ($_POST['action'] == "AddID") {

            if ($_SESSION['type'] == 3) {
                try{
                    $table = cleanStr($_POST['table']);

                    // $result = db_query("SHOW COLUMNS FROM $table;");
                     $formElements = null;
                    // if (db_num_rows($result) > 0) {
                        $formElements .= '<form action="" method="post" enctype="multipart/form-data" name="frmADDRecord">
                            <input type="hidden" name="send" value="1">
                            <input type="hidden" name="table" value="' . $table . '" id="table_id">
                            <div class="modal-body content vscroll"  style="max-height:500px">
                            <div class="row">';

                        // while ($row = db_fetch_array($result)) {
                        //     $formElements .= getEditFormElementInHTML($row['Field'], $row['Type'], $row['Null'], $row['Key'], $row['Default'], $row['Extra'],$table, $general_id);
                        // }
                        $formElements .= '<div class="form-group col-12">
                            <label class="form-label">Значение</label>
                            <input type="text"  name="name" class="form-control" value="" placeholder="" reqired/>
                                </div>
                                <div class="form-group col-12">
                                <label class="form-label">Файл</label>
                                <input type="file" name="file1" value=""  placeholder="" reqired class="form-control-file"  accept=""/>
                                </div>';
                                                $formElements .= '</div></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">'.getval("STR_CLOSE").'</button>
                                            <button type="submit" class="btn btn-primary">'.getval("STR_UPDATE").'</button>
                                        </div></form>';
                                            // }

                                        $out = '<div class="modal fade" id="addData" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">'.getval("STR_ADD").' #'. $general_id.'</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="'.getval("STR_CLOSE").'">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                ' . $formElements . '
                                                </div>
                                        </div>
                                    </div>';

                }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                        $out = 401;
                }

            }else{
                $out = 401;
            }


        }

         //Выбор факультета опираясь на универ
        if ($_POST['action'] == "CHANGE_DEPARTMENT") {
            $univer_id = intval($_POST['value']);
            $out = "";
            $out .= '<option selected="selected">Выберите подразделение</option>';
            $out .= categoryTreeOptions();
        }


        if ($_POST['action'] == "sendIndicators") {
            if ($_SESSION['type'] == 1 || $_SESSION['type'] == 3) {
                try{
                    $table = cleanStr($_POST['table']);
                    $general_id = intval($_POST['id']);

                    $sql = "UPDATE $table SET data_status = 2 WHERE id = ".$general_id;
                    db_query($sql);

                    $indicator_info = db_get_data("SELECT * FROM new_module_indicators where indicator_table_name = '" . $table . "'");

                    $single_indicator_info = db_get_data("SELECT * FROM $table where id = " . $general_id );

                    $all_ball = intval($indicator_info['ball']) * intval($single_indicator_info['data']);
                    $sql = "INSERT INTO new_module_balls SET indicator_category_id = '" . $indicator_info['category_id'] . "', indicator_id = '" . $indicator_info['id'] . "', row_id = '" . $general_id . "', system_ball = '".$all_ball."', filler_id = '".$_SESSION['id']."', status = 1, time_created = NOW()";
                    db_query($sql);

                    $out = 200;
                }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                        $out = 401;
                }

            }else{
                $out = 401;
            }
        }

        //Страница создвание доступов
        if ($_POST['action'] == "AccessesUserTypeChange") {
            if ($_SESSION['type'] == 1 || $_SESSION['type'] == 3) {
                try{
                    $user_type = intval($_POST['users_type']);
                // echo $users_type;
                $users_select = "";
                    if  ($user_type == 1){

                        $users_select  = '<label for="recipient-name" class="form-control-label">Подразделения</label>
                            <select class="form-control select2-show-search" name="user_or_category_ids[]" placeholder="Поиск" multiple required>';
                        $users_select .= categoryTreeOptions();
                        $users_select .= '</select>';

                    }else if ($user_type == 2){
                        $users = db_get_array("SELECT * FROM new_module_users ORDER BY fio DESC", "id", "fio");
                        $users_select  = '<label for="recipient-name" class="form-control-label">Пользователи</label>
                            <select class="form-control select2-show-search" name="user_or_category_ids[]" placeholder="Поиск" multiple  required>';
                        $users_select .= getSelectOptionWithOthers($users);
                        $users_select  .= '</select>';

                    }
                    $out =  $users_select;

                }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                        $out = 401;
                }

            }else{
                $out = 401;
            }
        }

        if ($_POST['action'] == "AccessesIdicatorsTypeChange") {
            if ($_SESSION['type'] == 1 || $_SESSION['type'] == 3) {
                try{
                    $indicator_type = intval($_POST['indicator_type']);
                // echo $users_type;
                $users_select = "";
                    if  ($indicator_type == 1){

                        $users_select  = '<label for="recipient-name" class="form-control-label">Категория показателей:</label>
                            <select class="form-control select2-show-search" name="indicator_or_category_ids[]" placeholder="Поиск" multiple required>';
                        $users_select .= categoryIndicatorsTreeOptions();
                        $users_select .= '</select>';

                    }else if ($indicator_type == 2){
                        $indicators = db_get_array("SELECT * FROM new_module_indicators ORDER BY name DESC", "id", "name");
                        $users_select  = '<label for="recipient-name" class="form-control-label">Показатели:</label>
                            <select class="form-control select2-show-search" name="indicator_or_category_ids[]" placeholder="Поиск" multiple required>';
                        $users_select .= getSelectOptionWithOthers($indicators);
                        $users_select  .= '</select>';

                    }
                    $out =  $users_select;

                }catch (Exception $e){
                        echo 'Ошибка: ',  $e->getMessage(), "\n";
                        $out = 401;
                }

            }else{
                $out = 401;
            }
        }

         //Меням статус у пользователя
        if ($_POST['action'] == "ChangeUserStatus") {
            if ($_SESSION['type'] == 1) {
                $user_id = intval($_POST['user_id']);
                $user_status = intval($_POST['user_status']);
                //Обновляем статус
                db_query("UPDATE new_module_users SET status = " . $user_status . " WHERE id = " . $user_id);
            }
        }


        print_r($out);
    }
}

function getEditFormElementInHTML($field, $type, $null, $key, $default,$extra, $table, $general_id){

    if($field != "id"){

        if($type == "text"){
            $req = "required";
            $span = '<span style="color: red;">*</span>';
        }else{
            $req = "";
            $span = '';
        }

        $table_data = db_get_data("SELECT $field FROM $table WHERE id = " . $general_id, $field);
    //     $formElementHtml  = '</br><div class="form-group col-4">';
    // //  $formElementHtml  .= $table;
    //  $formElementHtml  .= "</br>";
    //  $formElementHtml  .= $table_data ;
    //  $formElementHtml  .= "</br>";
    //  $formElementHtml  .= $general_id . "</div>";
        if($field != "indicator_table_name" && $field != "file_url" ){
            if($type == "bigint(20)" && $key =="MUL"){

                $referented_table = db_get_data("SELECT i1.TABLE_NAME,i1.COLUMN_NAME, i1.REFERENCED_TABLE_NAME, i1.REFERENCED_COLUMN_NAME FROM  information_schema.KEY_COLUMN_USAGE AS i1
        INNER JOIN information_schema.REFERENTIAL_CONSTRAINTS AS i2 ON i1.CONSTRAINT_NAME = i2.CONSTRAINT_NAME WHERE i1.REFERENCED_TABLE_NAME IS NOT NULL AND  i1.TABLE_SCHEMA  ='kaznpu2' AND i1.TABLE_NAME  ='".$table."' AND and i1.COLUMN_NAME  ='".$field."';");
        $options = null;
            $result = db_get_array("SELECT * FROM ".$referented_table['referenced_table_name'],"name", "value");

                    $options .=getSelectOptionWithOthers($result,$table_data[$field]);

            }else if($type == "text"){
                $formElementHtml = '<div class="form-group col-12">
                <label class="form-label">' . $field . ' ' . $span . '</label>
                <input type="text" id="' . $field . '" name="' . $field . '" class="form-control" value="' . $table_data . '" placeholder="" ' . $req . ' />
            </div>';
            }else if($type == "datetime"){
                $formElementHtml = null;
                if($field == "active_date_from"){
                $date_on  = date("d-m-Y", strtotime($table_data));
                // $date_on = "12-12-2021";
                $formElementHtml .= '<div class="form-group col-12">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">От</label>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><input class="flatpickr flatpickr-input form-control" autocomplete="off" name="'.$field.'" id="'.$field.'"  type="text" placeholder="..." value="'.$date_on.'"  required />
                                    </div>
                                </div>
                            </div>';
                    }else if($field == "active_date_to"){
                        // echo $table_data[$field];
                $date_to = date("d-m-Y", strtotime($table_data));
                        $formElementHtml .= '<div class="col-6">
                                <label class="form-label">До</label>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><input class="flatpickr flatpickr-input form-control" autocomplete="off" name="'.$field.'" id="'.$field.'"  type="text" placeholder="..." value="'.$date_to.'"  required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
            }
        }

    }else{
        $formElementHtml = "";
    }

    return $formElementHtml;
}





function getFormElementHTML($type, $name, $label, $placeholder, $required, $value, $validation_id = "", $comment = "1 п.л - 16 листов А4")
{
    if ($required == 1) {
        $req = "required";
        $span = '<span style="color: red;">*</span>';
    } else {
        $req = "";
        $span = '';
    }


    if ($type == "text") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
        <textarea class="form-control" id="' . $name . '" name="column[]" rows="2" placeholder="' . $placeholder . '" ' . $req . '>' . $value . '</textarea>
    </div>';
    } else if ($type == "number") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
        <input type="number" id="' . $name . '" name="column[]" class="form-control" value="' . $value . '" placeholder="' . $placeholder . '" ' . $req . ' min="0" step="1" />
    </div>';
    } else if ($type == "email") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
        <input type="email" id="' . $name . '" name="column[]" class="form-control" value="' . $value . '" placeholder="' . $placeholder . '" ' . $req . ' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
    </div>';
    } else if ($type == "phone") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
        <input type="text" id="' . $name . '" name="column[]" class="form-control" value="' . $value . '" placeholder="' . $placeholder . '" ' . $req . ' data-inputmask="\'mask\': \'+7(999)999-99-99\'" />
    </div>';
    } else if ($type == "file") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
        <input type="file" id="' . $name . '" name="file" value="' . $value . '"  placeholder="' . $placeholder . '" ' . $req . ' class="form-control-file"  accept=".pdf, video/* , .zip, .rar, image/* "/>
		<sub style="color: red;">Файл должен быть в виде в формате pdf или zip/rar архиве (если это фотографии) и не должен привышать размер 10 мб.</sub>
      </div>';
    } else if ($type == "select") {

        if ($validation_id != "") {
            $options  = null;
            $result = db_query("SELECT * FROM module_options WHERE validation_id = " . $validation_id . " ORDER BY ball ASC");
            if (db_num_rows($result) > 0) {
                while ($row = db_fetch_array($result)) {
                    $options .= '<option value="' . $row['option_name'] . '">' . $row['option_name'] . '</option>';
                }
            }
        }
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
         <select ' . $req . ' class="form-control select2-show-search" name="column[]" id="' . $name . '" data-placeholder="' . $placeholder . '">
            ' . $options . '
         </select>
      </div>';
    } else if ($type == "ball") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
        <input type="number" id="' . $name . '" name="column[]" class="form-control" value="' . $value . '" placeholder="' . $placeholder . '" ' . $req . ' min="0" step="1" />
    </div>';
    } else if ($type == "soavtor") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . ' (Если сооавторов нет пишите 1)</label>
        <input type="number" id="' . $name . '" name="column[]" class="form-control" value="' . $value . '" placeholder="' . $placeholder . '" ' . $req . ' min="1" step="1" />
    </div>';
    } else if ($type == "unit") {

        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . ''.$comment.'</label>
        <input type="number" id="' . $name . '" name="column[]" class="form-control" value="' . $value . '"  placeholder="' . $placeholder . '" ' . $req . ' min="0.01" step="0.01" />
    </div>';
    } else if ($type == "oneDate") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><input class="flatpickr flatpickr-input form-control" autocomplete="off" ' . $req . ' name="oneDate" id="' . $name . '" type="text" placeholder="' . $placeholder . '" value="' . $value . '"  required />
                                    </div>
                                </div>
    </div>';
    } else if ($type == "betweenDates") {
        $formElementHtml = '<div class="form-group col-4">
        <label class="form-label">' . $label . ' ' . $span . '</label>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><input class="flatpickrRange flatpickr-input form-control" autocomplete="off" ' . $req . ' name="betweenDates" id="' . $name . '" type="text" placeholder="' . $placeholder . '" value="' . $value . '"  required />
                                    </div>
                                </div>
    </div>';
    }
    return $formElementHtml;
}
