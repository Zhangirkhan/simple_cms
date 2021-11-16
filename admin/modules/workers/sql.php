CREATE TABLE module_workers (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL default '0',
  lang_id int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  avatar int(10) unsigned NOT NULL default '0',
  name text NOT NULL,
  lastname text NOT NULL,
  job int(10) unsigned NOT NULL default '0',
  phone text NOT NULL,
  email text NOT NULL,
  price text NOT NULL,
  rating int(10) unsigned NOT NULL default '0',
  status int(10) unsigned NOT NULL default '0',  
  sortfield int(10) unsigned NOT NULL default '0' ,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8