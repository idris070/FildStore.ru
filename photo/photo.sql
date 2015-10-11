CREATE TABLE photo (
  id_photo int(11) NOT NULL auto_increment,
  name tinytext NOT NULL,
  small tinytext NOT NULL,
  big tinytext NOT NULL,
  hide enum('show','hide') NOT NULL default 'show',
  pos int(11) NOT NULL default '0',
  id_catalog int(11) NOT NULL default '0',
  PRIMARY KEY  (id_photo)
) TYPE=MyISAM;
CREATE TABLE photocat (
  id_catalog int(8) NOT NULL auto_increment,
  name tinytext NOT NULL,
  description tinytext NOT NULL,
  pos smallint(3) NOT NULL default '0',
  hide enum('show','hide') NOT NULL default 'show',
  id_parent int(8) NOT NULL default '0',
  PRIMARY KEY  (id_catalog)
) TYPE=MyISAM;
