<?php
	$fields = array (
			"id" => array(
					"Display in grid" => true,
					"Display in form" => false,
					"Read only" => true,
					"Field type" => "textbox",
					"Title" => array (1=> "Номер", "ID", "Номер"),
				),
			
			"theme" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_theme", 'id', 'title', '', 'title'),
					"Title" => array (1=> "Тема", "Тема", "Тема"),
				),
			
			"status" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "external_table",
					"External table" => array("module_status", 'id', 'title', '', 'title'),
					"Title" => array (1=> "Статус", "Статус", "Статус"),
				),
		);
?>
