CREATE TABLE module_messages (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL default '0',
  lang_id int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  user_id int(10) unsigned NOT NULL default '0',
  message text NOT NULL,
  file1 text NOT NULL,
  file2 text NOT NULL,
  file3 text NOT NULL,
  file4 text NOT NULL,
  photo1 text NOT NULL,
  photo2 text NOT NULL,
  photo3 text NOT NULL,
  photo4 text NOT NULL,
  sortfield int(10) unsigned NOT NULL default '0' ,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8