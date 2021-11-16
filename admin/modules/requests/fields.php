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

			"name" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Имя", "Имя", "Имя"),
				),

			"address" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_catalog", 'id', 'address', '', 'address'),
					"Title" => array (1=> "Адрес", "Адрес", "Адрес"),
				),
			
			"theme" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_theme", 'id', 'title', '', 'title'),
					"Title" => array (1=> "Тема", "Тема", "Тема"),
				),

			"worker" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_workers", 'id', 'lastname', '', 'lastname'),
					"Title" => array (1=> "Исполнитель", "Исполнитель", "Исполнитель"),
				),

			"title" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Заголовок", "Заголовок", "Заголовок"),
				),

			"description" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Описание", "Описание", "Описание"),
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