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

			"house_number" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Номер дома", "Номер дома", "Номер дома"),
				),

			"city" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("pages", 'id', 'title', 'type = "city"', 'title'),
					"Title" => array (1=> "Город", "Город", "Город"),
				),

			"district" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_city", 'id', 'title', '', 'title'),
					"Title" => array (1=> "Район", "Район", "Район"),
				),
			
			"address" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Адрес", "Адрес", "Адрес"),
				),

			"mail_index" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Почтовый индекс", "Почтовый индекс", "Почтовый индекс"),
				),

			"flat" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Квартира", "Квартира", "Квартира"),
				),

			"level" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Этаж", "Этаж", "Этаж"),
				),

			"entrance" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Подъезд", "Подъезд", "Подъезд"),
				),

			"phone" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Телефон", "Телефон", "Телефон"),
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