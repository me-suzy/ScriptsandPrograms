<?php

#   CaLogic Language Table
#
#
#   SWEDISH
#
#
# Remove old global language table entry

$sqlstr = "delete from ".$tabpre."_languages where name = 'Swedish'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Add entry to global language table
#

$sqlstr = "INSERT INTO ".$tabpre."_languages VALUES ('', 'Swedish', 'Entered by Christian Sahlé')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_lang_Swedish`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_lang_Swedish";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_lang_Swedish (
  uid int(11) NOT NULL auto_increment,
  keyid varchar(100) NOT NULL default '',
  phrase mediumtext,
  remark varchar(254) default NULL,
  PRIMARY KEY  (uid),
  UNIQUE KEY keyid (keyid)
) TYPE=MyISAM COMMENT='A CaLogic Language Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Dumping data for table `".$tabpre."_lang_Swedish`
#

$entrynum = 0;



$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl1', 'Måndag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl2', 'Tisdag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl3', 'Onsdag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl4', 'Torsdag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl5', 'Fredag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl6', 'Lördag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdnl7', 'Söndag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns1', 'Mån', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns2', 'Tis', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns3', 'Ons', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns4', 'Tor', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns5', 'Fre', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns6', 'Lör', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wdns7', 'Sön', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl1', 'Januari', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl2', 'Februari', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl3', 'Mars', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl4', 'April', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl5', 'May', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl6', 'Juni', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl7', 'Juli', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl8', 'Augusti', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl9', 'September', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl10', 'Oktober', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl11', 'November', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl12', 'December', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns1', 'Jan', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns2', 'Feb', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns3', 'Mar', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns4', 'Apr', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns5', 'May', 'Abbr. Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns6', 'Jun', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns7', 'Jul', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns8', 'Aug', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns9', 'Sep', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns10', 'Okt', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns11', 'Nov', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns12', 'Dec', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dnl', 'Dag', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dns', 'Dg', 'Förk. för Dag, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wnl', 'Vecka', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wns', 'WK', 'Förk. för Week, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mnl', 'Månad', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mns', 'Mn', 'Förk. för Månad, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ynl', 'År', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yns', 'År', 'Förk. för År, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'prefl', 'Setup', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'prefs', 'Prefr', 'Förk. för Preferenser, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butgo', 'Gå', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butnew', 'Ny', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butedit', 'Redigera', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'prev', 'Föregående', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'next', 'Nästa', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'allDag', 'Alla Dagar', 'Used on the Week and Dag views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'events', 'Evenemang', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'event', 'Evenemang', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'nyrt', 'Va? Inte en registrerad användare än?<br>Okej, du/ni är bara 3 klick från att bli en registrerad användare.<br>Som en Registrerad användare får du möjlighet att skapa och konfigurera en egen online Webb kalender.<br>', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'liw', 'Logga in', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'low', 'Logga ut', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'lsel', 'Välj ett språk', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pli', 'Vänligen skriv in ditt Användar namn och Lösenord', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'un', 'Användar namn', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pw', 'Lösenord', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'subut', 'Skicka', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rebut', 'Rensa', 'Knapp Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rlnk', 'Klicka här för att registrera.', 'Used on Login Form as a link to the registration form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'urth', 'Användar Registrering', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'urfh', 'Fält', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ureh', 'Tillträde', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'urrh', 'Anmärkningar', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fnt', 'För namn', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'lnt', 'Efter namn', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'emt', 'E-Mail', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwa', 'Lösenord Igen', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'llt', 'Språk', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ungt', 'Välj ett <b> Användar namn</b>. Du kommer använda detta för att logga in till kalendern. Detta måste vara ett unikt namn och kan inte vara längre än 10 bokstäver. Det kan endast innehålla bokstäver och nummer, inga mellanslag och olika special tecken får användas.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fngt', 'Vänligen skriv ditt <b>För namn</b>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'lngt', 'Vänligen skriv ditt <b>Efter namn</b>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'emgt', 'Vänligen skriv din <b> E-Mail adress</b>. Detta måste vara en riktig/giltig adress. Efter registrerings formuläret är skickat, kommer det en bekräftelse via E-Mail. Du måste följa länken i E-Mailet för att fullfölja registrerings processen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwgt', 'Vänligen skriv ett <b>Lösenord</b>. Ditt Lösenord kommer bli krypterat. Mellanslag fram och bak kommer att bli intrimmade.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwagt', 'Vänligen bekräfta ditt <b>Lösenord</b>.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'llgt', 'Vänligen välj det <b>Språk</b> du önskar använda från listan av tillgängliga språk.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega1', 'Du glömde fylla i Användar Namn fältet. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega2', 'Du glömde fylla i För Namn fältet. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega3', 'Du glömde fylla i Efter Namn fältet. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega4', 'Du glömde fylla i E-Mail fältet. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega5', 'Du glömde fylla i Lösenord fältet. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega6', 'Du glömde fylla i Lösenord Bekräftelse fältet. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rega7', 'Lösenordet Stämde inte. Vänligen rätta till det och skicka-igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'emar', 'Det E-Mail du skrev finns redan i databasen. Vänligen gå tillbak och försök igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'badem', 'Det E-Mail du skrev verkar inte vara rätt formaterat. Vänligen rätta till och försök igen.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwreg', 'Vänligen vänta medan din registrering blir bekräftad....', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'badun', 'Det Användar Namn du begärde, har redan blivit användt. Vänligen gå tillbaka och välj ett annat. <b>Glöm inte, stora bokstäver både med Användar Namn and Lösenord!</b>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ldbp', 'Det är ett problem med Språk databasen. Vänligen kontakta Administratören', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'regok', '<br><br>Tack. <br><br>Din registrering har blivit bekräftad. <br>Bekräftelse E-Mailet har också blivit skickat. Du måste följa länken i bekräftelse E-Mailet innan du kan börja använda kalendern. <br><br>Om du inte bekräftar din registrering inom 7 dagar,  kommer det att bli annullerat och du får åter-registrera om du vill använda kalendern.<br>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pier', '<br><br>Databasen har indikerat ett inläggs fel. Om problem kvarstår, Vänligen tveka inte att kontakta Administratören.<br><br>Tack', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'regconf', '<br>Välkommen tillbaks %name% <br> <br>Tack för att du bekräftar registreringen. Du kan nu fortsätta till Logg in och skapa din egen kalender.<br><br>Vänligen informera mig med alla problem du upptäcker. Om du behöver, <a href=\"FAQ.php\">klicka här för att se FAQ\'s</A><br><br><a href=\"%index%\">Eller klicka här för att se din kalender!</A>', 'Användar Registration confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'regfu', '<br>Tyvärr, vi kan inte lokalisera bekräftelse nyckeln du skickade. Du kanske hade väntat för länge. <br><br><a href=\"Användarreg.php\">Vänligen klicka här för att registrera.</a>', 'User Registration Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'rereg', '<br>Bekräftelse nyckeln du skickade har redan använts av någon annan. <br><br><a href=\"%index%\">Vänligen klicka här för att logga in.</a>', 'User Registration Re-Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'regnotconf', '<br>Du har inte bekräftat din registrering. Vänligen följ länken i ditt bekräftelse E-Mail vilket just har blivit årer-sänt till dig. Email adressen du skickade är: %email% <br>Om inte detta är din Email adress, måste du åter-registrera dig för att kunna använda denna kalender.', 'User Registration not yet confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wrongli', 'Ogiltig inloggning. Vänligen försök igen.', 'Login failed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'goli', '<br>Du har blivit in loggad. <A HREF=\"%s\">klicka här</A> om din webläsare inte stöder automatisk uppdatering...', 'no longer needed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'tuid', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'calid', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'calname', 'Kalender Namn', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'userid', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'username', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'caltitle', 'Kalender Titel', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'caltype', 'Kalender Typ', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'showweek', 'Visa vecko nummer', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'preferedview', 'Preferens vy', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'weekstartonmonday', 'Vecka startar på', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'weekselreact', 'Vecko vals box', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'daybeginhour', 'Dagen börjar på', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dayendhour', 'Dagen slutar på', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'timetype', '12 eller 24 timmars format', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcdividerlinecolor', 'Avdelar länk färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcttcolor', 'Månads länk huvud teckensnitt färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcttbgcolor', 'Månads länk huvud teckensnitt bakgrunds färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcttstyle', 'Månads länk huvud stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcttcellcolor', 'Månads länk huvud Cell färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcheaderwdcolour', 'Veckodags huvud teckensnitt färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcheaderwdbgcolour', 'Veckodags huvud teckensnitt bakgrunds färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcheaderwecolour', 'Veckodags huvud teckensnitt färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcheaderwebgcolour', 'Veckodags huvud teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwdcolour', 'Veckodags länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwdbgcolour', 'Veckodags länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwdstyle', 'Veckodags länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwdcellcolour', 'Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwecolour', 'Veckosluts dags länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwebgcolor', 'Veckosluts dags länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwestyle', 'Veckosluts dags länk stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcwecellcolor', 'Veckosluts Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mccdcolor', 'Aktuell dag länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mccdbgcolor', 'Aktuell dag länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mccdstyle', 'Aktuell dag länk stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mccdcellcolor', 'Aktuell dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcnccolor', 'Månads dag som inte är aktuell (föregående/kommande) länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcncbgcolor', 'Månads dag som inte är aktuell (föregående/kommande) länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcncstyle', 'Månads dag utanför aktuell Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcnccellcolor', 'Månads dag utanför aktuell Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvdividerlinecolor', 'Avdelare linje Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvheadercolor', 'Huvud Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvttcolor', 'Månads länk Huvud teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvttbgcolor', 'Månads länk Huvud teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvttstyle', 'Månads länk Huvud Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvttcellcolor', 'Månads länk Huvud Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvheaderwdcolor', 'Veckodags Huvud teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvheaderwdbgcolor', 'Veckodags Huvud teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvheaderwecolor', 'Veckoslut Huvud teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvheaderwebgcolor', 'Veckoslut Huvud teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwdcolor', 'Veckodags Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwdbgcolor', 'Veckodags Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwdstyle', 'Veckodags Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwdcellcolor', 'Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwecolor', 'Veckoslut dag länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwebgcolor', 'Veckoslut dag länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwestyle', 'Veckoslut dag länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvwecellcolor', 'Veckoslut Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvcdcolor', 'Aktuell dag länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvcdbgcolor', 'Aktuell dag länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvcdstyle', 'Aktuell dag länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvcdcellcolor', 'Aktuell Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvnccellcolor', 'Utan för aktuell månad Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvdividerlinecolor', 'Avdelare linje Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvheadercolor', 'Huvud Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvheaderwdcolor', 'Huvud Veckodags teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvheaderwdbgcolor', 'Huvud Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvheaderwecolor', 'Huvud Veckoslut teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvheaderwebgcolor', 'Huvud Veckoslut Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwdcolor', 'Veckodags Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwdbgcolor', 'Veckodags Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwdstyle', 'Veckodags Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwdcellcolor', 'Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwecolor', 'Veckoslut dag Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwebgcolor', 'Veckoslut Dag Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwestyle', 'Veckoslut Dag Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwecellcolor', 'Veckoslut Dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvcdcolor', 'Aktuell Dag Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvcdbgcolor', 'Aktuell Dag Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvcdstyle', 'Aktuell Dag Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvcdcellcolor', 'Aktuell Dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvnccolor', 'Utan för aktuell månad Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvncbgcolor', 'Utan för aktuell månad Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvncstyle', 'Utan för aktuell månad Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvnccellcolor', 'Utan för aktuell månad Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwlcolor', 'Vecka Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwlbgcolor', 'Vecka Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvwlstyle', 'Vecka Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvdividerlinecolor', 'avdelare linje Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheadercolor', 'Huvud Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwdcolor', 'Huvud Veckodags Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwdbgcolor', 'Huvud Veckodags Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwdstyle', 'Huvud Veckodags Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwdcellcolor', 'Huvud Veckodags Länk Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwecolor', 'Huvud Veckoslut Dag Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwebgcolor', 'Huvud Veckoslut Dag Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwestyle', 'Huvud Veckoslut Dag Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderwecellcolor', 'Huvud Veckoslut Dag Länk Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheadercdcolor', 'Huvud aktuell Dag Länk teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheadercdbgcolor', 'Huvud aktuell Dag Länk teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheadercdstyle', 'Huvud aktuell Dag Länk Stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheadercdcellcolor', 'Huvud aktuell Dag Länk Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderadcolor', 'Alla evenemangs dagars Huvud teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderadbgcolor', 'Alla evenemangs dagars Huvud teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvheaderadcellcolor', 'Alla evenemangs dagars Huvud Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvawdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvawdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvawdcellcolor', 'Alla evenemangs dagars Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvawecolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvawebgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvawecellcolor', 'Alla evenemangs dagars Veckoslut Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvacdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvacdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvacdcellcolor', 'All Dag Events Aktuell Dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvwdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvwdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvwdcellcolor', 'Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvwecolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvwebgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvwecellcolor', 'Veckoslut Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvcdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvcdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvcdcellcolor', 'Aktuell Dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvtc', 'Timmar teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvtcbg', 'Timmar teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvtccellcolor', 'Timmar Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvdividerlinecolor', 'Delare Linje Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvheadercolor', 'Huvud Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvadcolor', 'Alla dagars evenemang Huvud Font Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvadbgcolor', 'Alla dagars evenemang Huvud Font Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvadcellcolor', 'Alla dagars evenemang Huvud Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvawdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvawdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvawdcellcolor', 'Alla dagars evenemang Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvawecolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvawebgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvawecellcolor', 'Alla dagars evenemang Veckoslut Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvacdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvacdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvacdcellcolor', 'Alla dagars evenemang Aktuell Dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvwdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvwdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvwdcellcolor', 'Veckodags Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvwecolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvwebgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvwecellcolor', 'Veckoslut Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvcdcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvcdbgcolor', 'inte använd', 'inte använd')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvcdcellcolor', 'Aktuell Dag Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvtccolor', 'Timmar teckensnitt Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvtcbgcolor', 'Timmar teckensnitt Bakgrunds Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvtccellcolor', 'Timmar Cell Färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'alcn', 'Kalender Namnet får inte vara blankt.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'alct', 'Kalender Titel får inte vara blankt.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'alts', 'Tiden då Dagen börjar får inte vara högre än dagens slut tid.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'alncc', 'Vill du verkligen skapa en ny kalender stil', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'calword', 'Kalender', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'aldel1', 'Vill du verkligen radera', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'aldel2', 'Radera', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'aldel3', 'Kalender kommer också att radera alla evenemang som är associerade med den, är du säker?', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'funcan', 'Funktionen avbryten', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'scgbut', 'Generellt', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'sgcbut', 'Global', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'smcbut', 'Mini Kalender', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'syvbut', 'Års översikt', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'smvbut', 'Månads översikt', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'swvbut', 'Vecko översikt', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'sdvbut', 'Dag översikt', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'srvbut', 'Rättigheter', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ssvbut', 'Beskrivningar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'scabut', 'Kategorier', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mycword', 'Min Kalender:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'opcalword', 'Annan (Öppen / Publik) Kalender:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butadd', 'Lägg till', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butdel', 'Radera', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fcalname', 'Detta är namnet på din kalender. Det måste vara unikt bland de andra namnen av dina kalendrar. Skriv upp till 50 bokstäver.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fcaltitle', 'Kalender Titeln visas upp på varje översikt.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fcaltype', 'Det finns tre typer av kalendrar, vissa som endast Site Admin kan se.<br><b>Öppna</b>: Vilken Användar / grupp kan se och eller lägga till / radera inlägg. Vilken Användar / grupp kan göra inlägg i öppna kalendrar.<br><b>Publik</b>: Vilken Användar / grupp kan se och eller göra inlägg till denna typ av kalender, men endast de Användar / grupp som är specifierad av dig kan lägga till / radera inlägg.<br><b>Privata</b>: Du måste specifiera vad varje användare får göra. Visa, lägga till, radera,  och komentera rättigheter är alla inställt individuellt för varje användare.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fshowweek', 'Välj ja om du kunna se vecko nummer i månads översikten.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fpreview', 'Välj den översikt du föredrar. Denna översikt används som din start översikt.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fmonday', 'MånDag', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fsunday', 'Söndag', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fwson', 'Välj hurvida du vill att din kalender ska börja med måndag eller söndag.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wfyes', 'Ja', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wfno', 'Nej', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wftype1', 'Typ1', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wftype2', 'Typ2', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ftype', '<b>Typ1</b>: Vecko väljar menyn kommer för-välja aktuell vecka, om det är inom 6 weeks av den aktuella visade datumen, annars blir första veckan av månaden för-vald.<br><b>Typ 2</b>: Den första visade veckan av månaden kommer alltid att vara för-vald.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ftimetype', 'Välj hurvida du vill ha 24 timmars visning eller 12 timmar med am och pm.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wf12', '12 timmar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wf24', '24 timmar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fdayst', 'Välj start timmen för vecka och dag visning', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fdayen', 'Välj slut timmen för vecka och dag visning.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'ffcaltxt', '<b>Du måste kompletera denna initial Setup (uppbyggnad) innan du kan fortsätta.</b>', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butsavech', 'Spara inställningar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butpv', 'Föregående värden', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butgoc', 'Gå till kalendern', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fnword', 'ingen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'funword', 'understrykning', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'folword', 'överstrykning', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'fstword', 'linje genom', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'funolword', 'understrykning och överstrykning', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'edlt1', 'Redigera ', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'edltt', 'Språk tabell', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'keyidt', 'KEYID (kan inte ändras)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pht', 'Fras (HTML tillåten)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'leaved', 'Lämna Editorn utan att spara ändringar', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'descword', 'Beskrivning', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'edlang', 'Redigera språk:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mkst', 'Gör till standard', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'entry', 'Inträde', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'opcw', 'Öppen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pucw', 'Publik', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'prcw', 'Privat', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'userlo', 'Du har blivit ut loggad', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'linff', 'Användar Namn kan inte vara blankt.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'lipff', 'Lösenord kan inte vara blankt.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'endwelc', 'Grattis! Du har gjort din första CaLogic Kalender.<br><br>Kalendern har blivit gjord med standard stilen, <br><a href=\"%index%?goprefs=1\">klicka här för att gå till setup</a> och designa kalendern som du vill ha den.<br>Or <a href=\"%index%\">klicka här för att se din kalender.</a><br><br>Du kan återvända till setup menyn när du vill.', 'First Cal Setup Success')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwsnc1', 'Spara kalender konfigurering', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwsnc2', 'Vänligen vänta medan din kalender', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwsnc3', 'blir sparad....', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwlet', 'Sparar språk', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwles', 'Vänligen vänta medan ändringarna sparas', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pwlec', 'Spara komplett.', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butgoset', 'Gå till Setup', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'butgoled', 'Konfigurera de valda redigerade språket', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'badcalnt', 'Kalender namnet är redan taget', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'pctta', 'Vänligen klicka här och försök igen.', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'badcaln', 'Du har redan en kalender med namnet', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvdtsl', 'Sommartid fungerar på denna server när CaLogic körs.', 'Dag View DTS Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dtss', 'DST', 'Sommartid')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'calownerword', 'Kalender ägare', 'used in the Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'tzofword', 'Tidzon Offset', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'tztext', 'Detta är din tidzon Offset från GMT och visas i timmar. Det är baserad på din dators tid och land inställningar. Tidzon Offset behövs för att visa den korekta datum och tiden och försäkra dig att påminnare skickas i tid.<br>Om tidzon Offset inte är korrekt, då är din dators tidsinställningar fel. Du ska inte justera tidzon Offset, men häldre ändra din dators tid inställningar.', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mcdwecellcolor', 'Dag med evenemang Cell Färg', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvdwecellcolor', 'Dag med evenemang Cell Färg', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_btxtfont', 'Standard Font', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_btxtcolor', 'Standard Font Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_standardbgcolor', 'Standard Back Ground Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_btxtsize', 'Standard Font Size in points', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_standardbgimg', 'Skriv in URL för bakgrunds bilden som ska användas till din kalender', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_prevcolor', '\"Föregående\" Länk färg ', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_prevbgcolor', '\"Föregående\" Länk bakgrunds färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscosf_prevstyle', '\"Föregående\" Länk stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_nextcolor', '\"Nästa\" Länk färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_nextbgcolor', '\"Nästa\" Länk bakgrunds färg', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscosf_nextstyle', '\"Nästa\" Länk stil', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_prefcolor', 'inte använd', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscosf_prefstyle', 'inte använd', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscocf_cssc', 'Aktuell Setup sektion knapp Cell Bakgrunds Färg', 'Används i setup för att belysa Aktuell sektions knapp')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_subtitletxt', 'Event Sub Title Descriptor', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_headpic', 'Header Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_headtext', 'Header Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_headlink', 'Header Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_headtarget', 'Header Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_footpic', 'Footer Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_foottext', 'Footer Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_footlink', 'Footer Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoif_foottarget', 'Footer Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_allowdv', 'Allow Day View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_allowwv', 'Allow Week View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_allowmv', 'Allow Month View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_allowyv', 'Allow Year View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_dispwvpd', 'Display Week View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_dispmvpd', 'Display Month View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_dispyvpd', 'Display Year View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_dispcnpd', 'Display Calendar Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_dispevcr', 'Display Event Creator', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_withesb', 'Display Month View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_withwvesb', 'Display Week View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_withdvesb', 'Display Day View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_showomd', 'Display Out of Month Day Numbers', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_showwvtime', 'Show the time column in Week View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'gcscoyn_showdvtime', 'Show the time column in Day View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'yvselmc_mcyv', 'Select if and where you want the mini calendar to show up in the year view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'mvselmc_mcmv', 'Select if and where you want the mini calendar to show up in the month view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'wvselmc_mcwv', 'Select if and where you want the mini calendar to show up in the week view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", 'dvselmc_mcdv', 'Select if and where you want the mini calendar to show up in the day view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# menu

# DO NOT CHANGE THE TEXT HERE!!!
        $newlangkeys = array("pu_functionmenutype", "pu_MenuBarColor",
        "pu_MenuBarFont",
        "pu_MenuBarFontColor",
        "pu_MenuBarFontSize",
        "pu_MenuBarHighlightColor",
        "pu_MenuBarHighlightFont",
        "pu_MenuBarHighlightFontColor",
        "pu_MenuItemBorderColor",
        "pu_MenuItemColor",
        "pu_MenuItemFont",
        "pu_MenuItemFontColor",
        "pu_MenuItemFontSize",
        "pu_MenuItemHighlightColor",
        "pu_MenuItemHighlightFont",
        "pu_MenuItemHighlightFontColor",
        "pu_PopupDayCaptionColor",
        "pu_PopupDayCaptionFont",
        "pu_PopupDayCaptionFontColor",
        "pu_PopupDayCaptionSize",
        "pu_PopupDayColor",
        "pu_PopupDayFont",
        "pu_PopupDayFontColor",
        "pu_PopupDayFontSize",
        "pu_PopupEventCaptionColor",
        "pu_PopupEventCaptionFont",
        "pu_PopupEventCaptionFontColor",
        "pu_PopupEventCaptionSize",
        "pu_PopupEventColor",
        "pu_PopupEventFont",
        "pu_PopupEventFontColor",
        "pu_PopupEventFontSize",
        "pu_PopupCreatorCaptionColor",
        "pu_PopupCreatorCaptionFont",
        "pu_PopupCreatorCaptionFontColor",
        "pu_PopupCreatorCaptionSize",
        "pu_PopupCreatorColor",
        "pu_PopupCreatorFont",
        "pu_PopupCreatorFontColor",
        "pu_PopupCreatorFontSize");


# CHANGE THE TEXT HERE IF YOU WANT!
        $newlangvals = array("Function Menu Type", "Horizontal Menu Bar Color",
        "Horizontal Menu Bar Font",
        "Horizontal Menu Bar Font Color",
        "Horizontal Menu Bar Font Size in ponts",
        "Horizontal Menu Bar Highlight Color",
        "Horizontal Menu Bar Highlight Font",
        "Horizontal Menu Bar Highlight Font Color",
        "Menu Item Border Color",
        "Menu Item Color",
        "Menu Item Font",
        "Menu Item Font Color",
        "Menu Item Font Size in points",
        "Menu Item Highlight Color",
        "Menu Item Highlight Font",
        "Menu Item Highlight Font Color",
        "Day Popup Caption Color",
        "Day Popup Caption Font",
        "Day Popup Caption Font Color",
        "Day Popup Caption Size (1 to 7)",
        "Day Popup Color",
        "Day Popup Font",
        "Day Popup Font Color",
        "Day Popup Font Size (1 to 7)",
        "Event Popup Caption Color",
        "Event Popup Caption Font",
        "Event Popup Caption Font Color",
        "Event Popup Caption Size (1 to 7)",
        "Event Popup Color",
        "Event Popup Font",
        "Event Popup Font Color",
        "Event Popup Font Size (1 to 7)",
        "Creator Popup Caption Color",
        "Creator Popup Caption Font",
        "Creator Popup Caption Font Color",
        "Creator Popup Caption Size (1 to 7)",
        "Creator Popup Color",
        "Creator Popup Font",
        "Creator Popup Font Color",
        "Creator Popup Font Size (1 to 7)");

        #$keycount = 0;
## DONT CHANGE THIS FOREACH LOOP!!
        foreach($newlangkeys as $key => $val) {

            $keyval = $val;
            $val = $newlangvals["$key"];

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$tabpre."_lang_Swedish VALUES (".$entrynum.", '".$keyval."', '".$val."', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }
# --------------------------------------------------------

?>






