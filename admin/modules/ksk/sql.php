CREATE TABLE module_ksk (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL default '0',
  lang_id int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  avatar int(10) unsigned NOT NULL default '0',
  title text NOT NULL,
  address text NOT NULL,
  head text NOT NULL,
  phone text NOT NULL,
  email varchar(255) NOT NULL default '',
  password varchar(255) NOT NULL default '',
  sortfield int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8