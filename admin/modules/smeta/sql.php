CREATE TABLE module_smeta (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	page_id INT UNSIGNED NOT NULL,
	lang_id INT UNSIGNED NOT NULL,
	date datetime NOT NULL default '0000-00-00 00:00:00',
	theme varchar(50) NOT NULL default '',
	status int(10) unsigned NOT NULL default '0',
	sortfield int(10) unsigned NOT NULL default '0',
	PRIMARY KEY (`id`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8