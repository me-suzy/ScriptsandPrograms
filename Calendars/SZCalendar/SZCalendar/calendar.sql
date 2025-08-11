/* 
  Use this for new installation
*/
CREATE TABLE calendar (
  id bigint(14) unsigned NOT NULL auto_increment,
  year smallint(4) unsigned NOT NULL default '0',
  month tinyint(2) unsigned NOT NULL default '0',
  day tinyint(2) unsigned NOT NULL default '0',
  weekday tinyint(1) unsigned NOT NULL default '0',
  hour tinyint(2) unsigned NOT NULL default '0',
  minute tinyint(2) unsigned NOT NULL default '0',
  end_date bigint(14) unsigned NOT NULL default '0',
  duration smallint(2) unsigned NOT NULL default '0',
  event_type tinyint(1) unsigned NOT NULL default '0',
  header varchar(100) NOT NULL default '',
  body text NOT NULL,
  PRIMARY KEY  (id),
  KEY id (id)
) TYPE=MyISAM;


/* 
  Use this for update
*/
ALTER TABLE calendar ADD duration SMALLINT( 2 ) UNSIGNED NOT NULL AFTER end_date ;
