# ----------------------------------------------------------------------
# Fast Click SQL - Advanced Clicks Counter System
# Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
# http://www.ftrain.siteburg.com/
# ----------------------------------------------------------------------
# Original Author of file: Dmitry Ignatyev
# ----------------------------------------------------------------------

# 
# Ñòðóêòóðà òàáëèöû `fc_category`
# 

CREATE TABLE fc_category (
  CID smallint(5) unsigned NOT NULL auto_increment,
  Cat varchar(50) NOT NULL default '',
  Name varchar(50) default NULL,
  PRIMARY KEY  (CID),
  KEY Cat (Cat)
) TYPE=MyISAM;
# --------------------------------------------------------

# 
# Ñòðóêòóðà òàáëèöû `fc_links`
# 

CREATE TABLE fc_links (
  LID smallint(5) unsigned NOT NULL auto_increment,
  Link varchar(50) NOT NULL default '',
  CID smallint(5) unsigned NOT NULL default '1',
  Name varchar(50) default NULL,
  URL varchar(150) default 'http://',
  Started int(10) unsigned NOT NULL default '0',
  Count mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (LID),
  KEY Link (Link)
) TYPE=MyISAM;
# --------------------------------------------------------

# 
# Ñòðóêòóðà òàáëèöû `fc_stats`
# 

CREATE TABLE fc_stats (
  ID mediumint(9) NOT NULL auto_increment,
  LID smallint(6) NOT NULL default '0',
  CID smallint(6) default NULL,
  VID smallint(6) default NULL,
  l_date int(11) NOT NULL default '0',
  PRIMARY KEY  (ID),
  KEY l_date (l_date)
) TYPE=MyISAM;
# --------------------------------------------------------

# 
# Ñòðóêòóðà òàáëèöû `fc_visitors`
# 

CREATE TABLE fc_visitors (
  VID smallint(5) unsigned NOT NULL auto_increment,
  IP int(10) NOT NULL default '0',
  Proxy int(11) default NULL,
  SDate int(10) unsigned NOT NULL default '0',
  EDate int(10) unsigned default NULL,
  IsBot char(1) default 'n',
  Browser varchar(20) default '-',
  OS varchar(20) default '-',
  Country char(2) default '-',
  Language char(2) default '-',
  Count mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (VID),
  KEY IP (IP),
  KEY EDate (EDate)
) TYPE=MyISAM;
