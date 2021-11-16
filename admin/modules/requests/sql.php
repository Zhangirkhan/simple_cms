CREATE TABLE module_requests (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL default '0',
  lang_id int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  name text NOT NULL,
  address int(10) unsigned NOT NULL default '0',
  theme int(10) unsigned NOT NULL default '0',
  worker int(10) unsigned NOT NULL default '0',
  title text NOT NULL,
  description text NOT NULL,
  photo1 text NOT NULL,
  photo2 text NOT NULL,
  photo3 text NOT NULL,
  photo4 text NOT NULL,
  sortfield int(10) unsigned NOT NULL default '0' ,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8