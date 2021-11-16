<?php
	$moduleName = "chat";
	$prefix = "./modules/".$moduleName."/";
	$tpl->define(array(
			$moduleName => $prefix . $moduleName.".tpl",
			$moduleName . "row_messages" => $prefix . "row_messages.tpl",
			$moduleName . "row_search" => $prefix . "row_search.tpl",
			$moduleName . "row_users" => $prefix . "row_users.tpl",
	));
	if (isset($_SESSION['id'])) {


/* Логика работы чата
Чат работает в основном через URL
Ссылка парсится uri делиться на части
1 элемент -> LANG_INDEX
2 элемент -> chat
3 элемент -> тип пользователя
используется при поиске Ajax
4 элемент -> id пользователя в чате
используется для получения и отправки сообщении конкретному пользователю */


///////////////////////////////////////////////////////////////////////////////
// Добавление нового чата /////////////////////////////////////////////////////
		// Для УК /////////////////////////////////////////////////////////////////
		if ($_SESSION['type'] === 1) {
			$usertype = "uc";
			$user = db_query("SELECT * FROM module_ucs WHERE id = '".$_SESSION['id']."'");
			$user = db_fetch_array($user);
			$username = $user['name'];
			$tpl->assign(array(
				"OSI_TEXT" => "<option value='osi'>ОСИ</option>",
				"WORKERS_TEXT" => "<option value='worker'>Ваши Сотрудники</option>",
				"MANAGER_TEXT" => "<option value='manager'>Ваши Менеджеры</option>",
			));
			// СПИСОК ОСИ // ВСЕ ////////////////////////////////////////////////////
			$osi_query = db_query("
				SELECT * FROM module_requests r
								INNER JOIN module_osi osi
								ON r.osi_id = osi.id
				WHERE r.uc_id = '".$_SESSION['id']."' AND r.uc_accepted <> 0");
			$osi_list = $osi_query;
			// СПИСОК Сотрудников // ТОЛЬКО СВОИ ////////////////////////////////////
			$workers_query = db_query("SELECT * FROM module_worker_uc WHERE uc_id = '".$_SESSION['id']."'");
			$workers_list = $workers_query;
			// СПИСОК Менеджеров // ТОЛЬКО СВОИ /////////////////////////////////////
			$managers_query = db_query("SELECT * FROM module_manager_uc WHERE uc_id = '".$_SESSION['id']."'");
			$managers_list = $managers_query;

		// Для ОСИ ////////////////////////////////////////////////////////////////
		} else if ($_SESSION['type'] === 2) {
			$usertype = "osi";
			$user = db_query("SELECT * FROM module_osi WHERE id = '".$_SESSION['id']."'");
			$user = db_fetch_array($user);
			$username = $user['name'];
			$tpl->assign(array(
				"UC_TEXT" => "<option value='uc'>УК</option>",
				"CITIZENS_TEXT" => "<option value='citizen'>Ваши Жители</option>",
				"WORKERS_TEXT" => "<option value='worker'>Сотрудники УК</option>",
				"MANAGER_TEXT" => "<option value='manager'>Менеджеры УК</option>",
			));
			// СПИСОК УК // ВСЕ /////////////////////////////////////////////////////
			$uc_query = db_query("
				SELECT * FROM module_requests r
								INNER JOIN module_ucs uc
								ON r.uc_id = uc.id
				WHERE r.osi_id = '".$_SESSION['id']."' AND r.osi_accepted <> 0");
			$uc_list = $uc_query;
			// СПИСОК Жителей // ТОЛЬКО СВОИ ////////////////////////////////////////
			$citizens_query = db_query("
				SELECT * FROM module_flats f
								INNER JOIN module_flats_citizens fc
								ON f.id = fc.flat_id
								INNER JOIN module_citizens c
								ON fc.citizen_id = c.id
				WHERE f.osi_id = '".$_SESSION['id']."'
			");
			$citizens_list = $citizens_query;
			// СПИСОК Сотрудников // ТОЛЬКО СВОИХ УК ////////////////////////////////
			$workers_query = db_query("
				SELECT * FROM module_requests r
								INNER JOIN module_osi_and_ucs osi_ucs
								ON r.osi_id = osi_ucs.osi_id
								INNER JOIN module_worker_uc wcs
								ON osi_ucs.ucs_id = wcs.uc_id
				WHERE r.osi_id = '".$_SESSION['id']."' AND r.osi_accepted <> 0 GROUP BY wcs.id
			");
			$workers_list = $workers_query;
			// СПИСОК Менеджеров // ТОЛЬКО СВОИХ УК ////////////////////////////////
			$managers_query = db_query("
				SELECT * FROM module_requests r
								INNER JOIN module_osi_and_ucs osi_ucs
								ON r.osi_id = osi_ucs.osi_id
								INNER JOIN module_manager_uc mcs
								ON osi_ucs.ucs_id = mcs.uc_id
				WHERE r.osi_id = '".$_SESSION['id']."' AND r.osi_accepted <> 0 GROUP BY mcs.id
			");
			$managers_list = $managers_query;

		// Для Жителей ////////////////////////////////////////////////////////////
		} else if ($_SESSION['type'] === 3) {
			$usertype = "citizen";
			$user = db_query("SELECT * FROM module_citizens WHERE id = '".$_SESSION['id']."'");
			$user = db_fetch_array($user);
			$username = $user['name'];
			$tpl->assign(array(
				"OSI_TEXT" => "<option value='osi'>Ваша ОСИ</option>",
				"CITIZENS_TEXT" => "<option value='citizen'>Жители дома</option>",
			));
			// СПИСОК ОСИ // ТОЛЬКО СВОЯ ////////////////////////////////////////////
			$osi_query = db_query("
				SELECT * FROM module_flats_citizens fc
								INNER JOIN module_flats f
								ON fc.flat_id = f.id
								INNER JOIN module_osi o
								ON f.osi_id = o.id
				WHERE fc.citizen_id = '".$_SESSION['id']."'
			");
			$osi_list = $osi_query;
			// СПИСОК Жителей // ТОЛЬКО СВОЕГО ДОМА /////////////////////////////////
			$citizens_query = db_query("
				SELECT * FROM module_flats_citizens fc
								INNER JOIN module_flats f
								ON fc.flat_id = f.id
								INNER JOIN module_houses h
								ON f.house_id = h.id
								INNER JOIN module_flats f2
								ON h.id = f2.house_id
								INNER JOIN module_flats_citizens fc2
								ON f2.id = fc2.flat_id
								INNER JOIN module_citizens c
								ON fc2.citizen_id = c.id
				WHERE fc.citizen_id = '".$_SESSION['id']."' AND c.id <> '".$_SESSION['id']."'
			");
			$citizens_list = $citizens_query;

		// Для Сотрудников ////////////////////////////////////////////////////////
		} else if ($_SESSION['type'] === 4) {
			$usertype = "worker";
			$user = db_query("SELECT * FROM module_worker_uc WHERE id = '".$_SESSION['id']."'");
			$user = db_fetch_array($user);
			$username = $user['name'];
			$tpl->assign(array(
				"UC_TEXT" => "<option value='uc'>Ваша УК</option>",
				"WORKERS_TEXT" => "<option value='worker'>Сотрудники УК</option>",
				"MANAGER_TEXT" => "<option value='manager'>Менеджеры УК</option>",
			));
			// СПИСОК УК ////////////////////////////////////////////////////////////
			$uc_query = db_query("SELECT * FROM module_ucs WHERE id = '".$user['uc_id']."'");
			$uc_list = $uc_query;
			// СПИСОК Сотрудников ///////////////////////////////////////////////////
			$workers_query = db_query("SELECT * FROM module_worker_uc WHERE id <> '".$_SESSION['id']."' AND uc_id = '".$user['uc_id']."'");
			$workers_list = $workers_query;
			// СПИСОК Менеджеров ////////////////////////////////////////////////////
			$managers_query = db_query("SELECT * FROM module_manager_uc WHERE uc_id = '".$user['uc_id']."'");
			$managers_list = $managers_query;

		// Для Менеджеров /////////////////////////////////////////////////////////
		} else if ($_SESSION['type'] === 5) {
			$usertype = "manager";
			$user = db_query("SELECT * FROM module_manager_uc WHERE id = '".$_SESSION['id']."'");
			$user = db_fetch_array($user);
			$username = $user['fio'];
			$tpl->assign(array(
				"UC_TEXT" => "<option value='uc'>Ваша УК</option>",
				"WORKERS_TEXT" => "<option value='worker'>Сотрудники УК</option>",
				"MANAGER_TEXT" => "<option value='manager'>Менеджеры УК</option>",
			));
			// СПИСОК УК ////////////////////////////////////////////////////////////
			$uc_query = db_query("SELECT * FROM module_ucs WHERE id = '".$user['uc_id']."'");
			$uc_list = $uc_query;
			// СПИСОК Сотрудников ///////////////////////////////////////////////////
			$workers_query = db_query("SELECT * FROM module_worker_uc WHERE uc_id = '".$user['uc_id']."'");
			$workers_list = $workers_query;
			// СПИСОК Менеджеров ////////////////////////////////////////////////////
			$managers_query = db_query("SELECT * FROM module_manager_uc WHERE id <> '".$_SESSION['id']."' AND uc_id = '".$user['uc_id']."'");
			$managers_list = $managers_query;
		}



		///////////////////////////////////////////////////////////////////////////
		// Создаем уникальный идентификатор пользователя///////////////////////////
		$userid = $_SESSION['id'];
		$userchatid = $usertype.$userid;



		///////////////////////////////////////////////////////////////////////////
		// Ajax Поиск /////////////////////////////////////////////////////////////
		// Поиск нужного периода по значению в ссылка /////////////////////////////
		$uri =  $_SERVER["REQUEST_URI"]; // Ссылка
		$uriArray = explode('/', $uri); //Конвертируем ссылку в Array
		# Проверяем HTTP или HTTPS
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			$link_type = "https";
		else
			$link_type = "http";
		// Ссылки для выбора периода. Указание времени в шаблоне
		$page_link = $link_type."://".$_SERVER['HTTP_HOST']."/".$uriArray[1]."/".$uriArray[2]."/";
		$tpl->assign("PAGE_LINK", $page_link);

		// Парсим ссылку, чтобы знать кого человек ищет
		if (isset($uriArray[3])) {
			$list = $uriArray[3]; // 3-йи элемент в ссылке
		} else {
			$list = "";
		}
		if (isset($uriArray[4])) {
			$current_chat_user = $uriArray[4]; // 4-ый элемент в ссылке
		} else {
			$current_chat_user = ""; // 4-ый элемент в ссылке
		}
		// Назначаем переменные для вывода по поиску
		$link_uc = "УК";
		$link_osi = "ОСИ";
		$link_citizen = "Жители";
		$link_worker = "Сотрудники";
		$link_manager = "Менеджеры";
		if ($list == 'uc') {
			$link_uc = "selected";
			$search_users = $uc_list;
			$search_type = "УК";
		} elseif ($list == 'osi') {
			$link_osi = "selected";
			$search_users = $osi_list;
			$search_type = "ОСИ";
		} elseif ($list == 'citizen') {
			$link_citizen = "selected";
			$search_users = $citizens_list;
			$search_type = "Житель";
		} elseif ($list == 'worker') {
			$link_worker = "selected";
			$search_users = $workers_list;
			$search_type = "Сотрудник";
		} elseif ($list == 'manager') {
			$link_manager = "selected";
			$search_users = $managers_list;
			$search_type = "Менеджер";
		}
		// Выводим результаты
		if (isset($search_users)) {
			if (db_num_rows($search_users) > 0) {
				while ($row = db_fetch_array($search_users)) {
					$search_user = $row['id'];
					// Если запрашивается житель - указываем дом
					if ($list === 'worker' OR $list === 'manager') {
						$newchatuseruc_query = db_query("SELECT * FROM module_ucs WHERE id = '".$row['uc_id']."'");
						if (db_num_rows($newchatuseruc_query) > 0) {
							$newchatuseruc_query = db_fetch_array($newchatuseruc_query);
							$newchatuseruc = $newchatuseruc_query['name']." -";
						}
					} else {
						$newchatuseruc = "";
					}
					// Если запрашивается менеджер указываем ФИО вместо имени
					if ($list === 'manager') {
						$search_name = $row['fio'];
					} else {
						$search_name = $row['name'];
					}
					$tpl->assign("SEARCH_NAME", $search_type." ".$newchatuseruc." ".$search_name);
					$tpl->assign("SEARCH_USER", $search_user);
					$tpl->parse("ROW_SEARCH", ".".$moduleName . "row_search");
				}
			}
		} else {
			$tpl->assign("SEARCH_USER", "Пользователей не найдено");
			$tpl->assign("SEARCH_NAME", "Пользователей не найдено");
			$tpl->parse("ROW_SEARCH", ".".$moduleName . "row_search");
		}
		$tpl->assign(array(
			"LINK_UC" => $link_uc,
			"LINK_OSI" => $link_osi,
			"LINK_CITIZEN" => $link_citizen,
			"LINK_WORKER" => $link_worker,
			"LINK_MANAGER" => $link_manager,
		));
		// Конец Ajax Поиска //////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////



		///////////////////////////////////////////////////////////////////////////
		// Добавить чат ///////////////////////////////////////////////////////////
		if (isset($_POST['send'])) {
			// Проверка наличия чата, назначение chatid и имени ///////////////////// // Создаем ID для чата для добавляемого пользователя
			if ($_POST['gettype'] === 'uc') {
				$new_chat_user = db_query("SELECT * FROM module_ucs WHERE id = '".$_POST['getusers']."'");
			} else if ($_POST['gettype'] === 'osi') {
				$new_chat_user = db_query("SELECT * FROM module_osi WHERE id = '".$_POST['getusers']."'");
			} else if ($_POST['gettype'] === 'citizen') {
				$new_chat_user = db_query("SELECT * FROM module_citizens WHERE id = '".$_POST['getusers']."'");
			} else if ($_POST['gettype'] === 'worker') {
				$new_chat_user = db_query("SELECT * FROM module_worker_uc WHERE id = '".$_POST['getusers']."'");
			} else if ($_POST['gettype'] === 'manager') {
				$new_chat_user = db_query("SELECT * FROM module_manager_uc WHERE id = '".$_POST['getusers']."'");
			}
			if (db_num_rows($new_chat_user) > 0) {
				$new_chat_user = db_fetch_array($new_chat_user);
			// Назначаем сам ID
				$newchatuserid = $_POST['gettype'].$new_chat_user['id'];
				if ($_POST['gettype'] === 'manager') {
					$newchatusername = $new_chat_user['fio']; 
				} else {
					$newchatusername = $new_chat_user['name'];
				}
			}
			// Берем чаты в которых присутствует пользователь
			$user_list_check = db_query("SELECT * FROM module_chat_users WHERE (userA = '".$usertype.$_SESSION['id']."' AND userB = '".$newchatuserid."') OR (userA = '".$newchatuserid."' AND userB = '".$usertype.$_SESSION['id']."')");
			// Проверяем наличие
			if (db_num_rows($user_list_check) > 0) {
				$chat_exists = true;
			}
			/////////////////////////////////////////////////////////////////////////
			// Если чат не существует
			if (!isset($chat_exists)) {
				// Назначаем переменные для добавления чата в таблицу /////////////////
				$userA = $userchatid;
				$userA_name = $username;
				$userA_type = $usertype;
				$userA_id = $_SESSION['id'];
				$userB = $newchatuserid;
				$userB_name = $newchatusername;
				$userB_type = $_POST['gettype'];
				$userB_id = cleanStr($_POST['getusers']);
				// Создаем запрос
				$sql_chat = "INSERT module_chat_users SET userA = '".$userA."',
										userA_name = '".$userA_name."',
										userA_type = '".$userA_type."',
										userA_id = '".$userA_id."',
										userB = '".$userB."',
										userB_name = '".$userB_name."',
										userB_type = '".$userB_type."',
										userB_id = '".$userB_id."'";
				// Запрашиваем
				db_query($sql_chat);
				///////////////////////////////////////////////////////////////////////

				// Еще раз обращаемся в базу данных, чтобы получить ID чата для сообщения
				$chat_id_query = db_query("SELECT * FROM module_chat_users WHERE userA = '".$userchatid."' AND userB = '".$newchatuserid."'");
				$chat_id_query = db_fetch_array($chat_id_query);

				// Назначаем переменные для нового сообщения
				$chat_id = $chat_id_query['id'];
				$from_user = $userchatid;
				$to_user = $newchatuserid;
				$message = cleanStr($_POST['message']);
				$datetime = date("Y-m-d H:i:s");
				$sql_message = "INSERT module_chat_messages SET chat_id = '".$chat_id."',
					from_user = '".$from_user."',
					to_user = '".$to_user."',
					message = '".$message."',
					datetime = '".$datetime."',
					readed = '0'";
				db_query($sql_message);
			} else {
				$tpl->assign("CHAT_EXISTS", "alert('Чат с выбранным Вами пользователем уже существует');");
			}
		}
		// Конец добавления чата //////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////
// Конец добавления нового чата ///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////
// Список пользователей и сообщении ///////////////////////////////////////////
		// Находим чаты пользователя
		$chatuserslist = db_query("SELECT * FROM module_chat_users WHERE userA = '".$usertype.$_SESSION['id']."' OR userB = '".$usertype.$_SESSION['id']."'");
		// Если пользователь существует
		if (db_num_rows($chatuserslist) > 0) {
			$not_readed_numbers_summ = 0;
			while ($row = db_fetch_array($chatuserslist)) {
				// Проверяем - создан ли чат пользователем или выбранным собеседником
				// и назначаем пользователю правильные имя и id
				if ($row['userA'] === $usertype.$_SESSION['id']) {
					$name = $row['userB_name'];
					$nameid = $row['userB'];
				} else if ($row['userB'] === $usertype.$_SESSION['id']) {
					$name = $row['userA_name'];
					$nameid = $row['userA'];
				}
				// Вытаскиваем самое последнее сообщение от пользователя
				$messages = db_query("SELECT * FROM module_chat_messages WHERE chat_id = '".$row['id']."' ORDER BY id DESC LIMIT 1");
				$messages = db_fetch_array($messages);
				$last_message = $messages['message'];
				$time = $messages['datetime'];
				// Если пользователь явлется получателем
				if ($messages['to_user'] === $usertype.$_SESSION['id']) {
					$not_readed = db_query("SELECT * FROM module_chat_messages WHERE chat_id = '".$row['id']."' AND readed = '0'");
					$not_readed_number = db_num_rows($not_readed);
					// Выводим значок, сколько не прочитанных сообщении
					if ($not_readed_number > 0) {
						$not_readed_text = "<span class='badge badge-primary float-right notreadedval' value='".$not_readed_number."'>".$not_readed_number."</span>";
						$not_readed_numbers_summ = $not_readed_numbers_summ + $not_readed_number;
					} else {
						$not_readed_text = "<span class='text-muted float-right'><i class='fa fa-envelope-open' aria-hidden='true'></i></span>";
					}
				} else {
					$not_readed_text = "<span class='text-muted float-right'><i class='fa fa-mail-reply' aria-hidden='true'></i></span>";
				}
				// Индивидуальная ссылка для пользователя 
				$userlink = $link_type."://".$_SERVER['HTTP_HOST']."/".$uriArray[1]."/".$uriArray[2]."/messages/".$nameid."/";
				// Проверяем активен ли чат и задаем ему стиль "активен"
				if (isset($uriArray[4])) {
					if ($uriArray[4] === $nameid) {
						$active_chat = "active-light";
					} else {
						$active_chat = "";
					}
				} else {
					$active_chat = "";
				}
				// Вывод
				$tpl->assign("ACTIVE_CHAT", $active_chat);
				$tpl->assign("USER_LINK", $userlink);
				$tpl->assign("NAME", $name);
				$tpl->assign("NAMEID", $nameid);
				$tpl->assign("LAST_MESSAGE", $last_message);
				$tpl->assign("TIME", $time);
				$tpl->assign("NOT_READED", $not_readed_text);
				$tpl->parse("ROW_USERS", ".".$moduleName . "row_users");
			}
			$tpl->assign("NOT_READED_SUMM", $not_readed_numbers_summ);
		} else {
			$tpl->assign("NO_CHATS", 'У Вас еще нет активных чатов. Для создания чата с другим пользователем нажмите кнопку <a class="btn-sm" data-toggle="modal" data-target="#chat-addchat" href="#"><i class="fa fa-plus"></i> Добавить Чат</a>');
		}
// Конец списока пользователей и сообщении ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////
// Отправка и список сообщении от пользователя ////////////////////////////////
		// Собрать сообщения для пользователя
		// Еще раз обращаемся в базу данных, чтобы получить ID чата для сообщения
		if ($current_chat_user != "") {
			$chat_id_query = db_query("SELECT * FROM module_chat_users WHERE (userA = '".$usertype.$_SESSION['id']."' OR userA = '".$current_chat_user."') AND (userB = '".$current_chat_user."' OR userB = '".$usertype.$_SESSION['id']."') ORDER BY id LIMIT 1");
			// $chat_id_query = db_query("SELECT * FROM module_chat_users WHERE (userA = '".$usertype.$_SESSION['id']."' OR userA = '".$current_chat_user."') AND (userB = '".$current_chat_user."' OR userB = '".$usertype.$_SESSION['id']."')");
			$chat_id_query = db_fetch_array($chat_id_query);
			// Берем чаты в которых присутствует пользователь
			$messageslist = db_query("SELECT * FROM module_chat_messages WHERE chat_id = '".$chat_id_query['id']."'");
			while ($row = db_fetch_array($messageslist)) {
				if ($row['from_user'] === $usertype.$_SESSION['id']) {
					$message = '<div class="message from">'.$row['message'].'</div>';
				} else {
					$message = '<div class="message to ready">'.$row['message'].'</div>';
					$make_read = "UPDATE module_chat_messages SET readed = '1' WHERE id = '".$row['id']."'";
					db_query($make_read);
				}
				$tpl->assign("MESSAGE", $message);
				$tpl->assign("TEST", $current_chat_user);
				$tpl->parse("ROWS_MESSAGES", ".".$moduleName . "row_messages");
			}
			$tpl->assign("RECIPIENT_FOR_MESSAGE", $current_chat_user);


			// Отправка сообщения пользователю
			if (isset($_POST['newMessageInput'])) {
				// Назначаем переменные для нового сообщения
				$from_user = $userchatid;
				$to_user = cleanStr($_POST['recipient']);
				$message = cleanStr($_POST['newMessageInput']);
				$datetime = date("Y-m-d H:i:s");
				$sql_message = "INSERT module_chat_messages SET chat_id = '".$chat_id_query['id']."',
					from_user = '".$from_user."',
					to_user = '".$current_chat_user."',
					message = '".$message."',
					datetime = '".$datetime."',
					readed = '0'";
				db_query($sql_message);
			}
		}
		$tpl->assign("USERTYPE", $usertype);
		$tpl->assign("STR_CLOSE_TITLE", "Закрыть");
		$tpl->assign("STR_ADD_TITLE", "Добавить");
// Конец чата с выбранным пользователем ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////
// Создание таблиц базы данных ////////////////////////////////////////////////

// Создание таблицы сообщении
// $sql_chat_users_table = "CREATE TABLE module_chat_users (
// id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// userA VARCHAR(60) NOT NULL,
// userA_name VARCHAR(250) NOT NULL,
// userA_type VARCHAR(30),
// userA_id INT(11),
// userB VARCHAR(60) NOT NULL,
// userB_name VARCHAR(250) NOT NULL,
// userB_type VARCHAR(30),
// userB_id INT(11)
// )";
// // Создание таблицы чатов
// db_query($sql_chat_users_table);
// $sql_chat_messages_table = "CREATE TABLE module_chat_messages (
// id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// chat_id INT(11) NOT NULL,
// from_user VARCHAR(250) NOT NULL,
// to_user VARCHAR(250),
// message text,
// datetime DATETIME,
// readed tinyint(1)
// )";
// db_query($sql_chat_messages_table);

// // Создание страниц для меню
// // 87
// $pages_table_check = db_query("SELECT * FROM pages WHERE parent_id = '87' AND title = 'Чат'");
// if (db_num_rows($pages_table_check) < 1) {
// 	$sql_chat_table = "INSERT pages SET
// 		parent_id = '87',
// 		lang_id = '1',
// 		type = 'page',
// 		group_id = '0',
// 		mod_rewrite = 'chat',
// 		title = 'Чат',
// 		description = '',
// 		kurs = 'typcn typcn-messages fs-20',
// 		content = '{CHAT}',
// 		template = 'default.tpl',
// 		icon = '0',
// 		external_link = '',
// 		sortfield = '121',
// 		visible = '1',
// 		deleted = '0',
// 		startpage = '0',
// 		sort_by = '',
// 		sort_order = '0',
// 		auth = '0'";
// 	db_query($sql_chat_table);
// }
// // 106
// $pages_table_check = db_query("SELECT * FROM pages WHERE parent_id = '106' AND title = 'Чат'");
// if (db_num_rows($pages_table_check) < 1) {
// 	$sql_chat_table = "INSERT pages SET
// 		parent_id = '106',
// 		lang_id = '1',
// 		type = 'page',
// 		group_id = '0',
// 		mod_rewrite = 'chat',
// 		title = 'Чат',
// 		description = '',
// 		kurs = 'typcn typcn-messages fs-20',
// 		content = '{CHAT}',
// 		template = 'default.tpl',
// 		icon = '0',
// 		external_link = '',
// 		sortfield = '121',
// 		visible = '1',
// 		deleted = '0',
// 		startpage = '0',
// 		sort_by = '',
// 		sort_order = '0',
// 		auth = '0'";
// 	db_query($sql_chat_table);
// }
// // 116
// $pages_table_check = db_query("SELECT * FROM pages WHERE parent_id = '116' AND title = 'Чат'");
// if (db_num_rows($pages_table_check) < 1) {
// 	$sql_chat_table = "INSERT pages SET
// 		parent_id = '116',
// 		lang_id = '1',
// 		type = 'page',
// 		group_id = '0',
// 		mod_rewrite = 'chat',
// 		title = 'Чат',
// 		description = '',
// 		kurs = 'typcn typcn-messages fs-20',
// 		content = '{CHAT}',
// 		template = 'default.tpl',
// 		icon = '0',
// 		external_link = '',
// 		sortfield = '121',
// 		visible = '1',
// 		deleted = '0',
// 		startpage = '0',
// 		sort_by = '',
// 		sort_order = '0',
// 		auth = '0'";
// 	db_query($sql_chat_table);
// }
// // 123
// $pages_table_check = db_query("SELECT * FROM pages WHERE parent_id = '123' AND title = 'Чат'");
// if (db_num_rows($pages_table_check) < 1) {
// 	$sql_chat_table = "INSERT pages SET
// 		parent_id = '123',
// 		lang_id = '1',
// 		type = 'page',
// 		group_id = '0',
// 		mod_rewrite = 'chat',
// 		title = 'Чат',
// 		description = '',
// 		kurs = 'typcn typcn-messages fs-20',
// 		content = '{CHAT}',
// 		template = 'default.tpl',
// 		icon = '0',
// 		external_link = '',
// 		sortfield = '121',
// 		visible = '1',
// 		deleted = '0',
// 		startpage = '0',
// 		sort_by = '',
// 		sort_order = '0',
// 		auth = '0'";
// 	db_query($sql_chat_table);
// }
// // 135
// $pages_table_check = db_query("SELECT * FROM pages WHERE parent_id = '135' AND title = 'Чат'");
// if (db_num_rows($pages_table_check) < 1) {
// 	$sql_chat_table = "INSERT pages SET
// 		parent_id = '135',
// 		lang_id = '1',
// 		type = 'page',
// 		group_id = '0',
// 		mod_rewrite = 'chat',
// 		title = 'Чат',
// 		description = '',
// 		kurs = 'typcn typcn-messages fs-20',
// 		content = '{CHAT}',
// 		template = 'default.tpl',
// 		icon = '0',
// 		external_link = '',
// 		sortfield = '121',
// 		visible = '1',
// 		deleted = '0',
// 		startpage = '0',
// 		sort_by = '',
// 		sort_order = '0',
// 		auth = '0'";
// 	db_query($sql_chat_table);
// }
// Конец создания таблиц базы данных //////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
		$tpl->parse(strtoupper($moduleName), $moduleName);
	} else {
		header("Location: /".LANG_INDEX."/auth");
		exit;
	}
?>