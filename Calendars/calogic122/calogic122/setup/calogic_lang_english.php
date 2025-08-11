 <?php

#   CaLogic Language Table
#
#
#   ENGLISH
#
#
# Remove old global language table entry

$sqlstr = "delete from ".$tabpre."_languages where name = 'English'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Add entry to global language table
#

$sqlstr = "INSERT INTO ".$tabpre."_languages VALUES ('', 'English', 'Entered by Philip Boone')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_lang_English`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_lang_English";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_lang_English (
  uid int(11) NOT NULL auto_increment,
  keyid varchar(100) NOT NULL default '',
  phrase mediumtext,
  remark varchar(254) default NULL,
  PRIMARY KEY  (uid),
  UNIQUE KEY keyid (keyid)
) TYPE=MyISAM COMMENT='A CaLogic Language Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Dumping data for table `".$tabpre."_lang_English`
#

$entrynum = 0;

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl1', 'Monday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl2', 'Tuesday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl3', 'Wednesday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl4', 'Thursday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl5', 'Friday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl6', 'Saturday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdnl7', 'Sunday', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns1', 'Mon', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns2', 'Tue', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns3', 'Wed', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns4', 'Thu', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns5', 'Fri', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns6', 'Sat', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wdns7', 'Sun', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl1', 'January', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl2', 'February', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl3', 'March', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl4', 'April', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl5', 'May', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl6', 'June', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl7', 'July', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl8', 'August', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl9', 'September', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl10', 'October', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl11', 'November', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl12', 'December', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns1', 'Jan', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns2', 'Feb', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns3', 'Mar', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns4', 'Apr', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns5', 'May', 'Abbr. Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns6', 'Jun', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns7', 'Jul', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns8', 'Aug', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns9', 'Sep', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns10', 'Oct', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns11', 'Nov', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns12', 'Dec', 'Abbr. Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dnl', 'Day', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dns', 'Dy', 'Abbr. for Day, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wnl', 'Week', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wns', 'WK', 'Abbr. for Week, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mnl', 'Month', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mns', 'Mn', 'Abbr. for Month, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ynl', 'Year', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yns', 'Yr', 'Abbr. for Year, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'prefl', 'Setup', 'Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'prefs', 'Prefs', 'Abbr. for Preferences, Used in the different calendar views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butgo', 'GO', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butnew', 'New', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butedit', 'Edit', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'prev', 'Previous', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'next', 'Next', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'allday', 'All Day', 'Used on the Week and Day views')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'events', 'Events', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'event', 'Event', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'nyrt', 'What? Not a registered user yet?<br>Well, you\'re just about 3 clicks away from becoming a Registered User.<br>As a Registered User you will be able to create and configure your very own Online Web Calendar.<br>', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'liw', 'Login', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'low', 'Logout', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'lsel', 'Select a Language', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pli', 'Please enter your User Name and Password', 'Used on Login Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'un', 'User Name', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pw', 'Password', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'subut', 'Submit', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rebut', 'Reset', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rlnk', 'Click here to register.', 'Used on Login Form as a link to the registration form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'urth', 'User Registration', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'urfh', 'Field', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ureh', 'Entry', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'urrh', 'Remarks', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fnt', 'First Name', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'lnt', 'Last Name', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'emt', 'E-Mail', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwa', 'Password Again', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'llt', 'Language', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ungt', 'Choose a <b> User Name</b>. You will use this to log into the Calendar. This must be a unique name and can be no longer than 10 characters. It can contain only letters and numbers, no spaces or any other special characters should be used.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fngt', 'Please enter your <b>First Name</b>', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'lngt', 'Please enter your <b>Last Name</b>', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'emgt', 'Please enter your <b> E-Mail address</b>. This must be a real address. After submitting the registration form, you will be sent a confirmation E-Mail. You must follow the link in the E-Mail in order to complete the registration process.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwgt', 'Please enter a <b>Password</b>. Your Password will be encrypted. Blank spaces at the front and back will be trimmed.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwagt', 'Please confirm your <b>Password</b>.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'llgt', 'Please choose the <b>Language</b> you wish to use from the list of available languages.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega1', 'You forgot to fill in the User Name field. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega2', 'You forgot to fill in the First Name field. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega3', 'You forgot to fill in the Last Name field. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega4', 'You forgot to fill in the E-Mail field. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega5', 'You forgot to fill in the Password field. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega6', 'You forgot to fill in the Password Conformation field. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rega7', 'The Passwords don\'t match. Please correct it and re-submit.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'emar', 'The E-Mail you entered is already in my database. Please go back and try again.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'badem', 'The E-Mail you entered doesn\'t seem to be properly formated. Please correct and try again.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwreg', 'Please wait while your registration gets processed....', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'badun', 'The User Name you have requested, has already been taken. Please go back and choose a different one. <b>Don\'t forget, capitalization matters both with the User Name and Password!</b>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ldbp', 'There\'s a problem with the Language Database. Please contact the Administrator', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'regok', '<br><br>Thank you. <br><br>Your registration has been submitted. <br>The confirmation E-Mail has also been sent. You must follow the link in the confirmation E-Mail before you can begin using the calendar. <br><br>If you do not confirm your registration within 7 days, it will be nullified and you will have to re-register if you want to use the calendar.<br>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pier', '<br><br>The Database has indicated an Insert Error. If the problem persists, please don\'t hesitate to contact the Administrator.<br><br>Thank You', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'regconf', '<br>Welcome Back %name% <br> <br>Thank you for confirming your registration. You may now continue to the login and create yourself a Calendar.<br><br>Please inform me of any trouble you experience. If you need to, <a href=\"FAQ.php\">click here to check out the FAQ\'s</A><br><br><a href=\"%index%\">Or click here to view your Calendar!</A>', 'User Registration confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'regfu', '<br>I\'m sorry, we are unable to locate the confirmaton key you submitted. You may have waited too long. <br><br><a href=\"userreg.php\">Please click here to register.</a>', 'User Registration Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'rereg', '<br>The confirmation key you submitted has already been used. <br><br><a href=\"%index%\">Please click here to login.</a>', 'User Registration Re-Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'regnotconf', '<br>You have not yet confirmed your registration. Please follow the link in your confirmation E-Mail which has just been re-sent to you. The Email address you submitted is: %email% <br>If this is not your Email address, you will have to re-register to be able to use this Calendar.', 'User Registration not yet confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wrongli', 'Invalid Login. Please try again.', 'Login failed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'goli', '<br>You have been loged on. <A HREF=\"%s\">click here</A> if your browser does not support automatic reloading...', 'no longer needed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'tuid', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'calid', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'calname', 'Calendar Name', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'userid', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'username', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'caltitle', 'Calendar Title', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'caltype', 'Calendar Type', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'showweek', 'Show Week Numbers', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'preferedview', 'Preferred View', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'weekstartonmonday', 'Week Starts on', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'weekselreact', 'Week Select Box React', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'daybeginhour', 'Day Starts at', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dayendhour', 'Day Ends at', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'timetype', '12 or 24 Hour Format', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcttcolor', 'Month Link Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcttbgcolor', 'Month Link Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcttstyle', 'Month Link Header Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcttcellcolor', 'Month Link Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcheaderwdcolor', 'Weekday Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcheaderwdbgcolor', 'Weekday Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcheaderwecolor', 'Weekend Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcheaderwebgcolor', 'Weekend Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwdcolor', 'Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwdbgcolor', 'Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwdstyle', 'Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwecolor', 'Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwebgcolor', 'Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwestyle', 'Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mccdcolor', 'Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mccdbgcolor', 'Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mccdstyle', 'Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mccdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcnccolor', 'Out of Month Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcncbgcolor', 'Out of Month Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcncstyle', 'Out of Month Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcnccellcolor', 'Out of Month Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvttcolor', 'Month Link Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvttbgcolor', 'Month Link Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvttstyle', 'Month Link Header Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvttcellcolor', 'Month Link Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvheaderwdcolor', 'Weekday Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvheaderwdbgcolor', 'Weekday Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvheaderwecolor', 'Weekend Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvheaderwebgcolor', 'Weekend Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwdcolor', 'Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwdbgcolor', 'Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwdstyle', 'Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwecolor', 'Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwebgcolor', 'Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwestyle', 'Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvcdcolor', 'Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvcdbgcolor', 'Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvcdstyle', 'Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvcdcellcolor', 'Current Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvnccellcolor', 'Out of Month Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvheaderwdcolor', 'Header Weekday Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvheaderwdbgcolor', 'Header Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvheaderwecolor', 'Header Weekend Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvheaderwebgcolor', 'Header Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwdcolor', 'Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwdbgcolor', 'Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwdstyle', 'Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwecolor', 'Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwebgcolor', 'Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwestyle', 'Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwecellcolor', 'Weekend Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvcdcolor', 'Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvcdbgcolor', 'Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvcdstyle', 'Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvcdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvnccolor', 'Out of Month Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvncbgcolor', 'Out of Month Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvncstyle', 'Out of Month Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvnccellcolor', 'Out of Month Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwlcolor', 'Week Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwlbgcolor', 'Week Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvwlstyle', 'Week Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwdcolor', 'Header Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwdbgcolor', 'Header Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwdstyle', 'Header Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwdcellcolor', 'Header Weekday Link Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwecolor', 'Header Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwebgcolor', 'Header Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwestyle', 'Header Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderwecellcolor', 'Header Weekend Day Link Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheadercdcolor', 'Header Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheadercdbgcolor', 'Header Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheadercdstyle', 'Header Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheadercdcellcolor', 'Header Current Day Link Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderadcolor', 'All Day Events Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderadbgcolor', 'All Day Events Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvheaderadcellcolor', 'All Day Events Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvawdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvawdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvawdcellcolor', 'All Day Events Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvawecolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvawebgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvawecellcolor', 'All Day Events Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvacdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvacdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvacdcellcolor', 'All Day Events Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvwdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvwdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvwecolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvwebgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvcdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvcdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvcdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvtccolor', 'Hour Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvtcbgcolor', 'Hour Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvtccellcolor', 'Hour Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvadcolor', 'All Day Events Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvadbgcolor', 'All Day Events Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvadcellcolor', 'All Day Events Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvawdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvawdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvawdcellcolor', 'All Day Events Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvawecolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvawebgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvawecellcolor', 'All Day Events Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvacdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvacdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvacdcellcolor', 'All Day Events Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvwdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvwdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvwecolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvwebgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvcdcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvcdbgcolor', 'not used', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvcdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvtccolor', 'Hour Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvtcbgcolor', 'Hour Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvtccellcolor', 'Hour Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'alcn', 'The Calendar Name must not be blank.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'alct', 'The Calendar Title must not be blank.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'alts', 'The Day Begin Time cannot be higher than the Day End Time.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'alncc', 'Do you really want to create a new Calendar styled like', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'calword', 'Calendar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'aldel1', 'Do you really want to delete the', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'aldel2', 'Deleting the', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'aldel3', 'Calendar will also delete all of the events associated with it, are you sure?', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'funcan', 'Function canceled', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'scgbut', 'General', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'sgcbut', 'Global', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'smcbut', 'Mini Calendar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'syvbut', 'Year View', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'smvbut', 'Month View', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'swvbut', 'Week View', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'sdvbut', 'Day View', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'srvbut', 'Rights', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ssvbut', 'Subscriptions', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'scabut', 'Categories', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mycword', 'My Calendars:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'opcalword', 'Other (Open / Public) Calendars:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butadd', 'Add', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butdel', 'Delete', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fcalname', 'This is the name of your Calendar. It must be unique among the names of your Calendars. Enter up to 50 characters.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fcaltitle', 'The Calendar Title shows up on each view.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fcaltype', 'There are three types of Calendars, some of which may be disabled by the Site Admin.<br><b>Open</b>: Any user / group may view and or add / delete entries. Any user / group may subscribe to Open Calendars.<br><b>Public</b>: Any user / group may view and or subscribe to this type of Calendar, but only those users / groups specified by you may add / delete entries.<br><b>Private</b>: You must specify what each user may do. View, Add, Delete, and Subscribe rights are all set individually for each user.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fshowweek', 'Select Yes if you would like to see the Week Numbers in the Month View.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fpreview', 'Select your Preferred View. This view is used as your starting view.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fmondays', 'Mondays', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fsundays', 'Sundays', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fwson', 'Choose whether you want your Calendar to begin on Mondays or Sundays.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wfyes', 'Yes', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wfno', 'No', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wftype1', 'Type1', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wftype2', 'Type2', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ftype', '<b>Type1</b>: The Week Selection Box will pre-select the Current Week, if it is within six weeks of the actual viewed date, otherwise the first week of the Month viewed will be pre-selected.<br><b>Type 2</b>: The first week of the Month viewed will always be preselected.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ftimetype', 'Select whether you want the 24 hour display or the 12 hour with am and pm.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wf12', '12 Hour', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wf24', '24 Hour', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fdayst', 'Select the Start Hour for the Week and Day Views', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fdayen', 'Select the End Hour for the Week and Day Views.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'ffcaltxt', '<b>You must complete this initial setup form before continuing.</b>', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butsavech', 'Save Changes', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butpv', 'Previous Values', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butgoc', 'Go to Calendar', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fnword', 'none', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'funword', 'underline', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'folword', 'overline', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'fstword', 'line through', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'funolword', 'underline and overline', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'edlt1', 'Editing the ', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'edltt', 'Language Table', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'keyidt', 'KEYID (cannot be changed)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pht', 'Phrase (HTML allowed)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'leaved', 'Leave Editor Without Saving Changes', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'descword', 'Description', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'edlang', 'Edit Language:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mkst', 'Make Standard', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'entry', 'Entry', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'opcw', 'Open', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pucw', 'Public', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'prcw', 'Private', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'userlo', 'You have been Logged Off', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'linff', 'The User Name cannot be blank.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'lipff', 'The Password cannot be blank.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'endwelc', 'Congratulations! You have set up your first CaLogic Calendar.<br><br>The Calendar has been set up with the default Style, <br><a href=\"%index%?goprefs=1\">click here go to the setup</a> and design the Calendar to your liking.<br>Or <a href=\"%index%\">click here to view your Calendar.</a><br><br>You may return to the setup at any time.', 'First Cal Setup Success')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwsnc1', 'Saving Calendar Config', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwsnc2', 'Please wait while your Calendar', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwsnc3', 'gets saved....', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwlet', 'Saving Language', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwles', 'Please wait while the changes get saved', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pwlec', 'Save complete.', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butgoset', 'Go to Setup', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'butgoled', 'Continue Editing Selected Language', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'badcalnt', 'Calendar Name Already Taken', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'pctta', 'Please click here to try again.', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'badcaln', 'You already have a Calendar by the name of', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvdtsl', 'Daylight Saving Time is in effect on the server where CaLogic is running.', 'Day View DTS Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dtss', 'DST', 'Day Light Saving Time')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'calownerword', 'Calendar Owner', 'used in the setup area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'tzofword', 'Timezone Offset', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'tztext', 'This is your Timezone Offset from GMT and is shown in hours. It is based on your computers time and country settings. The Timezone Offset is needed in order to show the correct date and time and to ensure that your reminders get sent on time.<br>If the Timezone Offset is not correct, then your computers time settings are wrong. You should not adjust the Timezone Offset, but rather correct your computers time settings.', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mcdwecellcolor', 'Day With Event Cell Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvdwecellcolor', 'Day With Event Cell Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);



$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_btxtfont', 'Standard Font', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_btxtcolor', 'Standard Font Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_standardbgcolor', 'Standard Back Ground Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_btxtsize', 'Standard Font Size in points', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_standardbgimg', 'Enter the URL for the Back Ground Image to use through out your Calendar', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_prevcolor', '\"Previous\" Link Color ', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_prevbgcolor', '\"Previous\" Link Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscosf_prevstyle', '\"Previous\" Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_nextcolor', '\"Next\" Link Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_nextbgcolor', '\"Next\" Link Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscosf_nextstyle', '\"Next\" Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_prefcolor', 'Not used', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscosf_prefstyle', 'Not used', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscocf_cssc', 'Current Setup Section Button Cell Background Color', 'Used in the setup to highlight the current section button')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_subtitletxt', 'Event Sub Title Descriptor', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_headpic', 'Header Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_headtext', 'Header Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_headlink', 'Header Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_headtarget', 'Header Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_footpic', 'Footer Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_foottext', 'Footer Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_footlink', 'Footer Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoif_foottarget', 'Footer Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_allowdv', 'Allow Day View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_allowwv', 'Allow Week View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_allowmv', 'Allow Month View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_allowyv', 'Allow Year View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_dispwvpd', 'Display Week View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_dispmvpd', 'Display Month View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_dispyvpd', 'Display Year View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_dispcnpd', 'Display Calendar Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_dispevcr', 'Display Event Creator', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_withesb', 'Display Month View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_withwvesb', 'Display Week View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_withdvesb', 'Display Day View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_showomd', 'Display Out of Month Day Numbers', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_showwvtime', 'Show the time column in Week View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'gcscoyn_showdvtime', 'Show the time column in Day View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'yvselmc_mcyv', 'Select if and where you want the mini calendar to show up in the year view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'mvselmc_mcmv', 'Select if and where you want the mini calendar to show up in the month view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'wvselmc_mcwv', 'Select if and where you want the mini calendar to show up in the week view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", 'dvselmc_mcdv', 'Select if and where you want the mini calendar to show up in the day view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
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
            $sqlstr = "INSERT INTO ".$tabpre."_lang_English VALUES (".$entrynum.", '".$keyval."', '".$val."', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }

# --------------------------------------------------------

?>
