# ======================================================================
# MySQL-Dump
# ======================================================================

#
# Table structure 'Shoutbox'
#

CREATE TABLE Shoutbox (
  ID int(10) NOT NULL auto_increment,
  Timestamp varchar(14) NOT NULL,
  Name varchar(20),
  EMail varchar(75),
  Text text NOT NULL,
  PRIMARY KEY (ID)
);
