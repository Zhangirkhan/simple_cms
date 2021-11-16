<?php
	$fields = array (
			"date" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => true,
					"Field type" => "datetime",
					"Sortfield" => true,
					"Title" => array (1=> "Дата", "Date", "Дата"),
				),

			"user_id" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_citizen", 'id', 'email', '', 'email'),
					"Title" => array (1=> "Пользователь", "Пользователь", "Пользователь"),
				),

			"worker_id" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_workers", 'id', 'email', '', 'email'),
					"Title" => array (1=> "Сотрудник", "Сотрудник", "Сотрудник"),
				),

			"ksk_id" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_ksk", 'id', 'title', '', 'title'),
					"Title" => array (1=> "КСК", "КСК", "КСК"),
				),

			"title" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Заголовок", "Заголовок", "Заголовок"),
				),
			
			"message" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Сообщение", "Сообщение", "Сообщение"),
				),

			"sortfield" => array(
					"Display in grid" => false,
					"Display in form" => false,
					"Read only" => false,
					"Field type" => "textbox",
					"Sortfield" => true,
					"Title" => array (1=> "Индекс сортировки", "Sortfield", "Индекс сортировки"),
				),
		);
?>