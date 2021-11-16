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

			"avatar" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "image_preview",
					"Title" => array (1=> "Фото", "Фото", "Фото"),
				),

			"name" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Имя", "Имя", "Имя"),
				),

			"lastname" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Фамилия", "Фамилия", "Фамилия"),
				),

			"job" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_job", 'id', 'title', '', 'title'),
					"Title" => array (1=> "Должность", "Должность", "Должность"),
				),
			
			"phone" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Телефон", "Телефон", "Телефон"),
				),

			"email" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "E-mail", "E-mail", "E-mail"),
				),

			"price" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Оклад", "Оклад", "Оклад"),
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