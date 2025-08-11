<?php

#   CaLogic Language Table
#
#
#   Deutsch
#
#
# Remove old global language table entry

$sqlstr = "delete from ".$tabpre."_languages where name = 'Deutsch'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Add entry to global language table
#

$sqlstr = "INSERT INTO ".$tabpre."_languages VALUES ('', 'Deutsch', 'Entered by Goetz Kohlberg')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_lang_Deutsch`
#


$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_lang_Deutsch";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_lang_Deutsch (
  uid int(11) NOT NULL auto_increment,
  keyid varchar(100) NOT NULL default '',
  phrase mediumtext,
  remark varchar(254) default NULL,
  PRIMARY KEY  (uid),
  UNIQUE KEY keyid (keyid)
) TYPE=MyISAM COMMENT='A CaLogic Language Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Dumping data for table `".$tabpre."_lang_Deutsch`
#

$entrynum = 0;

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl1', 'Montag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl2', 'Dienstag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl3', 'Mittwoch', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl4', 'Donnerstag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl5', 'Freitag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl6', 'Samstag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdnl7', 'Sonntag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns1', 'Mo ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns2', 'Di ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns3', 'Mi ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns4', 'Do ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns5', 'Fr ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns6', 'Sa ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wdns7', 'So ', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl1', 'Januar', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl2', 'Februar', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl3', 'M&auml;rz', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl4', 'April', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl5', 'Mai', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl6', 'Juni', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl7', 'Juli', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl8', 'August', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl9', 'September', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl10', 'Oktober', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl11', 'November', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl12', 'Dezember', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns1', 'Jan', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns2', 'Feb', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns3', 'Mar', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns4', 'Apr', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns5', 'Mai', 'Abbr. Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns6', 'Jun', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns7', 'Jul', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns8', 'Aug', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns9', 'Sep', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns10', 'Okt', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns11', 'Nov', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns12', 'Dez', 'Abk. Wird in verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dnl', 'Tag', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dns', 'Tg', 'Abk. fuer Tag, In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wnl', 'Week', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wns', 'Wo', 'Abk. fuer Woche, In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mnl', 'Monat', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mns', 'Mn', 'Abk. fuer Monat, In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ynl', 'Jahr', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yns', 'Jr', 'Abk. fuer Jahr, In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'prefl', 'Setup', 'In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'prefs', 'Prefs', 'Abk. fuer Preferences, In verschiedenen Anzeigen verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butgo', 'GO', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butnew', 'Neu', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butedit', 'Edit', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'prev', 'Zur&uuml;ck', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'next', 'Vor', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'allday', 'Ganztags', 'Bei Tages und Wochenansicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'events', 'Events', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'event', 'Event', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'nyrt', 'Was? Noch kein registriertes Mitglied?<br>Na ja, Du bist nur 3 klicks davon entfernt.<br>Als registriertes Mitglied kannst Du Deine ganz pers&ouml;nlichen Partykalender erstellen und konfigurieren!<br>', 'Im Login verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'liw', 'Login', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'low', 'Logout', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'lsel', 'W&auml;hle eine Sprache', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pli', 'Bitte gib Deinen Mitgliedsnamen Dein Passwort ein', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'un', 'Mitgliedsname', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pw', 'Passwort', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'subut', 'Senden', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rebut', 'Reset', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rlnk', 'Klicke hier um Dich zu registrieren.', 'Used on Login Form as a link to the registration form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'urth', 'Mitglieder Registration', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'urfh', 'Feld', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ureh', 'Eintrag', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'urrh', 'Anmerkungen', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fnt', 'Vorname', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'lnt', 'Nachname', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'emt', 'E-Mail', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwa', 'Passwort wiederholen', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'llt', 'Sprache', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ungt', 'W&auml;hle einen <b> Mitglieds Namen</b>. Damit kannst Du Dich im Kalender  einloggen. Der Name muss eindeutig sein und darf nicht mehr als 10 Buchstaben haben. Er kann nur Buchstaben und Zahlen enthalten, keine Leer- oder Sonderzeichen.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fngt', 'Dein <b>Vornamen</b>', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'lngt', 'Dein <b>Nachname</b>', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'emgt', 'Deine<b> E-Mail Addresse</b>. Das muss eine echte Adresse sein! Nach Deiner Anmeldung senden wir Dir eine Best&auml;tigung zu, die Du ausf&uuml;hren musst, um Deine Registrierung abzuschliessen.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwgt', 'Dein <b>Passwort</b>. Dein Passwort wird verschl&uuml;sselt Leerzeichen davor oder danach werden abgeschnitten.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwagt', 'Wiederhole Dein <b>Passwort</b>.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'llgt', 'W&auml;hle die <b>Sprache</b> die Du verwenden willst.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega1', 'Du hast vergessen den Mitgliedsnamen auszuf&uuml;llen. Bitte ausf&uuml;llen und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega2', 'Du hast vergessen Deinen Vornamen anzugeben. Bitte ausf&uuml;llen und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega3', 'Du hast vergessen Deinen Nachnamen einzugeben. Bitte ausf&uuml;llen und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega4', 'Du hast vergessen Deine E-Mail anzugeben. Bitte ausf&uuml;llen und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega5', 'Du hast vergessen ein Passwort anzugeben. Bitte ausf&uuml;llen und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega6', 'Du hast vergessen das Passwort zu best&auml;tigen. Bitte ausf&uuml;llen und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rega7', 'Die Passw&ouml;rter stimmen nicht &uuml;berein. Bitte verbessern und nochmal abschicken.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'emar', 'Deine angegebene E-Mail Adresse ist bereits vorhanden. Bitte gehe zur&uuml;ck und korrigiere es.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'badem', 'Deine angegebene E-Mail Adresse ist fehlerhaft. Bitte gehe zur&uuml;ck und korrigiere es.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwreg', 'Bitte warten... Du wirst registriert ...', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'badun', 'Dein angegebener Mitgliedsname wird bereits verwendet. Bitte gehe zur&uuml;ck und w&auml;hle einen anderen. <b>Denk dran, Du kannst auch GROSS schreiben !</b>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ldbp', 'Argh, da gibt\'s ein Problem mit der Sprachdatenbank. Wende Dich bitte an den Admin', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'regok', '<br><br>Danke. <br><br>Deine Registrierung hier ist abgeschlossen. <br>Du hast eine Best&auml;tigungs E-Mail bekommen. Du musst den dort angegebenen Link verwenden, um die Registrierung abzuschliessen.<br><br>Wenn Du das nicht innerhalb der n&auml;chsten 7 Tage machst wird Dein Account gel&ouml;scht und Du musst neu anfangen.<br>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pier', '<br><br>Die Datenbank hat einen Fehler festgestellt. Falls das Problem weiter auftritt wende Dich bitte an den Admin.<br><br>Danke', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'regconf', '<br>Hallo %name% <br> <br>Danke, dass Du Deine Registrierung abschliesst. Du kannst Dich jetzt anelden und Deinen eigenen Kalender erstellen.<br><br>Please inform me of any trouble you experience. If you need to, <a href=\"FAQ.php\">click here to check out the FAQ\'s</A><br><br><a href=\"%index%\">Or click here to view your Calendar!</A>', 'User Registration confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'regfu', '<br>Ich kann den von Dir verwendeten Best&auml;tigungscode nicht finden.. Du hast wahrscheinlich l&auml;nger als 7 Tage gewartet. <br><br><a href=\"userreg.php\">Bitte registriere Dich hier neu.</a>', 'User Registration Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'rereg', '<br>Der von Dir angegebene Best&auml;tigungscode wurde bereits verwendet. <br><br><a href=\"%index%\">Bitte melde Dich hier an.</a>', 'User Registration Re-Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'regnotconf', '<br>Du hast Deine Registrierung noch nicht abgeschlossen. Bitte verwende den Link in Deiner Best&auml;tigungs E-Mail, die wir Dir geschickt haben. Die von Dir angegebene E-Mail Adresse ist: %email% <br>Falls das nicht Deine E-Mail Adresse ist musst Du Dich neu registrieren, um den Kalender zu nutzen..', 'User Registration not yet confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wrongli', 'Ung&uuml;ltiges Login. Bitte wiederholen.', 'Login failed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'goli', '<br>Du bist jetzt angemeldet. <A HREF=\"%s\">Klicke hier</A> falls Dein Browser Dich nicht automatisch weiterleitet...', 'no longer needed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'tuid', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'calid', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'calname', 'Kalender Name', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'userid', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'username', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'caltitle', 'Kalender Titel', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'caltype', 'Kalender Typ', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'showweek', 'Zeige Wochennummern', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'preferedview', 'Bevorzugte Anzeige', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'weekstartonmonday', 'Woche startet mit', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'weekselreact', 'Reaktion der Wochenauswahlbox', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'daybeginhour', 'Tag startet um', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dayendhour', 'Tag endet um', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'timetype', '12 oder 24 Stunden Format', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcdividerlinecolor', 'Trennlinienfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcttcolor', 'Monat Link Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcttbgcolor', 'Monat Link Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcttstyle', 'Monat Link Header Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcttcellcolor', 'Monat Link Header Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcheaderwdcolor', 'Wochentag Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcheaderwdbgcolor', 'Wochentag Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcheaderwecolor', 'Wochenende Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcheaderwebgcolor', 'Wochenende Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwdcolor', 'Wochentag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwdbgcolor', 'Wochentag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwdstyle', 'Wochentag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwdcellcolor', 'Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwecolor', 'Wochenende Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwebgcolor', 'Wochenende Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwestyle', 'Wochenende Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcwecellcolor', 'Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mccdcolor', 'Aktueller Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mccdbgcolor', 'Aktueller Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mccdstyle', 'Aktueller Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mccdcellcolor', 'Aktueller Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcnccolor', 'Out of Monat Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcncbgcolor', 'Out of Monat Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcncstyle', 'Out of Monat Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcnccellcolor', 'Out of Monat Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvttcolor', 'Monat Link Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvttbgcolor', 'Monat Link Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvttstyle', 'Monat Link Header Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvttcellcolor', 'Monat Link Header Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvheaderwdcolor', 'Wochentag Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvheaderwdbgcolor', 'Wochentag Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvheaderwecolor', 'Wochenende Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvheaderwebgcolor', 'Wochenende Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwdcolor', 'Wochentag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwdbgcolor', 'Wochentag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwdstyle', 'Wochentag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwdcellcolor', 'Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwecolor', 'Wochenende Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwebgcolor', 'Wochenende Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwestyle', 'Wochenende Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvwecellcolor', 'Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvcdcolor', 'Aktueller Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvcdbgcolor', 'Aktueller Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvcdstyle', 'Aktueller Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvcdcellcolor', 'Aktueller Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvnccellcolor', 'Out of Monat Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvheaderwdcolor', 'Header Wochentag Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvheaderwdbgcolor', 'Header Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvheaderwecolor', 'Header Wochenende Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvheaderwebgcolor', 'Header Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwdcolor', 'Wochentag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwdbgcolor', 'Wochentag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwdstyle', 'Wochentag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwdcellcolor', 'Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwecolor', 'Wochenende Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwebgcolor', 'Wochenende Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwestyle', 'Wochenende Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwecellcolor', 'Wochenende Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvcdcolor', 'Aktueller Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvcdbgcolor', 'Aktueller Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvcdstyle', 'Aktueller Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvcdcellcolor', 'Aktueller Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvnccolor', 'Out of Monat Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvncbgcolor', 'Out of Monat Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvncstyle', 'Out of Monat Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvnccellcolor', 'Out of Monat Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwlcolor', 'Week Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwlbgcolor', 'Week Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvwlstyle', 'Week Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwdcolor', 'Header Wochentag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwdbgcolor', 'Header Wochentag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwdstyle', 'Header Wochentag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwdcellcolor', 'Header Wochentag Link Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwecolor', 'Header Wochenende Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwebgcolor', 'Header Wochenende Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwestyle', 'Header Wochenende Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderwecellcolor', 'Header Wochenende Tag Link Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheadercdcolor', 'Header Aktueller Tag Link Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheadercdbgcolor', 'Header Aktueller Tag Link Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheadercdstyle', 'Header Aktueller Tag Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheadercdcellcolor', 'Header Aktueller Tag Link Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderadcolor', 'Ganztag Events Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderadbgcolor', 'Ganztag Events Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvheaderadcellcolor', 'Ganztag Events Header Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvawdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvawdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvawdcellcolor', 'Ganztag Events Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvawecolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvawebgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvawecellcolor', 'Ganztag Events Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvacdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvacdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvacdcellcolor', 'Ganztag Events Aktueller Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvwdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvwdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvwdcellcolor', 'Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvwecolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvwebgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvwecellcolor', 'Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvcdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvcdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvcdcellcolor', 'Aktueller Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvtccolor', 'Stunde Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvtcbgcolor', 'Stunde Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvtccellcolor', 'Stunde Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvadcolor', 'Ganztag Events Header Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvadbgcolor', 'Ganztag Events Header Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvadcellcolor', 'Ganztag Events Header Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvawdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvawdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvawdcellcolor', 'Ganztag Events Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvawecolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvawebgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvawecellcolor', 'Ganztag Events Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvacdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvacdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvacdcellcolor', 'Ganztag Events Aktueller Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvwdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvwdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvwdcellcolor', 'Wochentag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvwecolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvwebgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvwecellcolor', 'Wochenende Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvcdcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvcdbgcolor', 'nicht verwendet', 'nicht verwendet')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvcdcellcolor', 'Aktueller Tag Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvtccolor', 'Stunde Buchstabenfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvtcbgcolor', 'Stunde Buchstaben Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvtccellcolor', 'Stunde Zellfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'alcn', 'Der Kalendername darf nicht leer sein.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'alct', 'Der Kalendertitel darf nicht leer sein.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'alts', 'Das Tagesanfangsdatum darf nicht h&ouml;her sein als das Tagesende Datum.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'alncc', 'Willst Du wirklich den neuen Kalenderstil speichern', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'calword', 'Kalender', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'aldel1', 'Willst Du das wirklich l&ouml;Schen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'aldel2', 'L&ouml;schen des', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'aldel3', 'Kalenders, l&ouml;scht auch alle damit verbundenen Events. Bist Du Dir sicher?', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'funcan', 'Funktion abgebrochen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'scgbut', 'Generell', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'sgcbut', 'Global', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'smcbut', 'Mini Kalender', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'syvbut', 'Jahresansicht', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'smvbut', 'Monatsansicht', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'swvbut', 'Wochenansicht', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'sdvbut', 'Tages Ansicht', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'srvbut', 'Berechtigungen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ssvbut', 'Subskriptionen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'scabut', 'Kategorien', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mycword', 'Meine Kalender:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'opcalword', 'Andere &ouml;ffentliche Kalender:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butadd', 'Hinzu', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butdel', 'L&ouml;schen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fcalname', 'Das ist der Name Deines Kalenders. Er muss eindeutig sein und darf maxmal 50 Zeichen lang sein.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fcaltitle', 'Der Titel des Kalenders wird immer angezeigt.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fcaltype', 'Es gibt 3 Kalendertypen. Einige k&ouml;nnen vom Admin gesperrt sein.<br><b>Open</b>: Any user / group may view and or add / delete entries. Any user / group may subscribe to Open Calendars.<br><b>Public</b>: Any user / group may view and or subscribe to this type of Calendar, but only those users / groups specified by you may add / delete entries.<br><b>Private</b>: You must specify what each user may do. View, Add, Delete, and Subscribe rights are all set individually for each user.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fshowweek', 'W&auml;hle Ja wenn Du in der Monatsansicht die Wochennummern sehen willst.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fpreview', 'W&auml;hle die gew&uuml;nschte Ansicht. Das ist Deine Startansicht.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fmondays', 'Montag', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fsundays', 'Sonntag', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fwson', 'W&auml;hle ob Deine Woche Sonntag oder Montag beginnt.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wfyes', 'Ja', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wfno', 'Nein', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wftype1', 'Type1', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wftype2', 'Type2', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ftype', '<b>Type1</b>: Typ1: Die Wochenauswahl Box zeigt die aktuelle Woche wenn diese innerhalb 6 Wochen ist. Andernfalls wird die erste Woche des aktuellen Monats angezeigt. <bb>Standart</b><br><b>Typ 2</b>: Die erste Woche des angezeigten Monats wird immer verwendet.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ftimetype', '12 oder 24 Stunden Anzeige mit am/pm.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wf12', '12 Stunden', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wf24', '24 Stunden', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fdayst', 'Die Tagesanzeige beginnt um xxx Uhr', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fdayen', 'Die Tagesanzeige endet um xxx Uhr.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'ffcaltxt', '<b>Du must erst alles fertig ausf&uuml;llen, bevor Du weitermachen kannst.</b>', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butsavech', '&Auml;nderungen speichern', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butpv', 'Werte zur&uuml;cksetzen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butgoc', 'Gehe zum Kalender', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fnword', 'kein', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'funword', 'unterstrichen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'folword', '&uuml;berstrichen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'fstword', 'durchgestrichen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'funolword', '&Uuml;ber- und unterstrichen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'edlt1', '&Auml;ndere die ', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'edltt', 'Sprachtabelle', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'keyidt', 'KEYID (kann nicht ge&auml;ndert werden)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pht', 'Phrase (HTML zugelassen)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'leaved', 'Editor ohne abzuspeichern verlassen', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'descword', 'Beschreibung', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'edlang', '&Auml;ndere Sprache:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mkst', 'Fest voreinstellen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'entry', 'Eintrag', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'opcw', 'Offen', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pucw', '&Ouml;ffentlich', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'prcw', 'Privat', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'userlo', 'Du bist jetzt abgemeldet', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'linff', 'Der Mitgliedername darf nicht leer sein.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'lipff', 'Das Passwort darf nicht leer sein.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'endwelc', 'Gl&uuml;ckwunsch. Du hast Deinen ersten Kalender fertig.<br><br>Der Kalender ist im Standartstil angelegt,  <br><a href=\"%index%?goprefs=1\">klick hier um das Setup aufzurufen</a> und den Kalender nach Deinen W&uuml;nschen anzupasen..<br>Or <a href=\"%index%\">Klicke hier um deinen Kalender anzusehen.</a><br><br>Du kannst jederzeit in\'s Setup zur&uuml;ck.', 'First Cal Setup Success')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwsnc1', 'Kalenderkonfiguration speichern', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwsnc2', 'Warte bitte - Dein Kalender', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwsnc3', 'wird gespeichert....', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwlet', 'Speichere Sprache', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwles', 'Warte bitte bis die &Auml;nderungen gespeichert sind', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pwlec', 'Speicherung fertig.', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butgoset', 'Gehe zum Setup', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'butgoled', 'Sprachanpassung weiterf&uuml;hren', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'badcalnt', 'Der Kalendername existiert schon', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'pctta', 'Bitte hier klicken um es nocheinmal zu versuchen.', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'badcaln', 'Du hast schon einen Kalender namens', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvdtsl', 'Auf diesem Server ist die Sommerzeit eingeschaltet.', 'Tag View DTS Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dtss', 'DST', 'Sommerzeit')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'calownerword', 'Kalender Eigent&uuml;mer', 'used in the setup area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'tzofword', 'Zeitzonen offset', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'tztext', 'Das ist dein Zeitzonen Offset zu GMT in Stunden und h&auml;ngt von den Einstellungen Deines Computers ab. Der Zeitzonen Offset ist  notwendig, damit Dir die korrekte Zeit angezeigt wird.<br> Falls der Offset falsch ist liegt das an Deinem Computer, nicht an dieser Anzeige !.', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mcdwecellcolor', 'Tag mit Event Zellfarbe', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvdwecellcolor', 'Tag mit Event Zellfarbe', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_btxtfont', 'Standart Schrift', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_btxtcolor', 'Standart Schrift Farbe', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_standardbgcolor', 'Standart Hintergrund Farbe', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_btxtsize', 'Standart Schrift Größe in Punkte', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_standardbgimg', 'Gib die URL des Hintergrundbildes an, das Dein Kalender verwenden soll', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_prevcolor', '\"Zur&uuml;ck\" Link Farbe ', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_prevbgcolor', '\"N&auml;chster\" Link Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscosf_prevstyle', '\"Zur&uuml;ck\" Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_nextcolor', '\"N&auml;chster\" Link Farbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_nextbgcolor', '\"N&auml;chster\" Link Hintergrundfarbe', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscosf_nextstyle', '\"N&auml;chster\" Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_prefcolor', 'Nicht verwendet', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscosf_prefstyle', 'Nicht verwendet', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscocf_cssc', 'Aktueller Setup Section Button Cell Background Color', 'Used in the setup to highlight the Aktueller section button')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_subtitletxt', 'Event Sub Title Descriptor', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_headpic', 'Header Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_headtext', 'Header Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_headlink', 'Header Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_headtarget', 'Header Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_footpic', 'Footer Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_foottext', 'Footer Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_footlink', 'Footer Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoif_foottarget', 'Footer Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_allowdv', 'Allow Day View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_allowwv', 'Allow Week View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_allowmv', 'Allow Month View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_allowyv', 'Allow Year View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_dispwvpd', 'Display Week View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_dispmvpd', 'Display Month View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_dispyvpd', 'Display Year View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_dispcnpd', 'Display Calendar Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_dispevcr', 'Display Event Creator', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_withesb', 'Display Month View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_withwvesb', 'Display Week View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_withdvesb', 'Display Day View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_showomd', 'Display Out of Month Day Numbers', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_showwvtime', 'Show the time column in Week View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'gcscoyn_showdvtime', 'Show the time column in Day View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);



        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'yvselmc_mcyv', 'Select if and where you want the mini calendar to show up in the year view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'mvselmc_mcmv', 'Select if and where you want the mini calendar to show up in the month view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'wvselmc_mcwv', 'Select if and where you want the mini calendar to show up in the week view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", 'dvselmc_mcdv', 'Select if and where you want the mini calendar to show up in the day view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
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
            $sqlstr = "INSERT INTO ".$tabpre."_lang_Deutsch VALUES (".$entrynum.", '".$keyval."', '".$val."', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }


# --------------------------------------------------------

?>
