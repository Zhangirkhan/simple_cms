CREATE TABLE module_catalog (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL default '0',
  lang_id int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  house_number int(10) unsigned NOT NULL default '0',
  city int(10) unsigned NOT NULL default '0',
  district int(10) unsigned NOT NULL default '0',
  address text NOT NULL,
  mail_index text NOT NULL,  
  sortfield int(10) unsigned NOT NULL default '0' ,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8