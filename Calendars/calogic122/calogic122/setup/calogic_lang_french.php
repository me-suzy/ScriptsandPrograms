<?php

#   CaLogic Language Table
#
#
#   French
#
#
# Remove old global language table entry

$sqlstr = "delete from ".$tabpre."_languages where name = 'French'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Add entry to global language table
#

$sqlstr = "INSERT INTO ".$tabpre."_languages VALUES ('', 'French', 'Traduit par Antoine Hurtado')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_lang_French`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_lang_French";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_lang_French (
  uid int(11) NOT NULL auto_increment,
  keyid varchar(100) NOT NULL default '',
  phrase mediumtext,
  remark varchar(254) default NULL,
  PRIMARY KEY  (uid),
  UNIQUE KEY keyid (keyid)
) TYPE=MyISAM COMMENT='A CaLogic Language Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Dumping data for table `".$tabpre."_lang_French`
#

$entrynum = 0;

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl1', 'Lundi', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl2', 'Mardi', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl3', 'Mercredi', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl4', 'Jeudi', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl5', 'Vendredi', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl6', 'Samedi', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdnl7', 'Dimanche', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns1', 'Lun', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns2', 'Mar', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns3', 'Mer', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns4', 'Jeu', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns5', 'Ven', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns6', 'Sam', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wdns7', 'Dim', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl1', 'Janvier', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl2', 'Février', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl3', 'Mars', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl4', 'Avril', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl5', 'Mai', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl6', 'Juin', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl7', 'Juillet', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl8', 'Août', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl9', 'Septembre', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl10', 'Octobre', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl11', 'Novembre', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl12', 'Decembre', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns1', 'Jan', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns2', 'Fev', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns3', 'Mar', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns4', 'Avr', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns5', 'Mai', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns6', 'Jun', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns7', 'Jui', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns8', 'Aoû', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns9', 'Sep', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns10', 'Oct', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns11', 'Nov', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns12', 'Dec', 'Abbr. Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dnl', 'Jour', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dns', 'Jr', 'Abbr. de Jour, Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wnl', 'Semaine', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wns', 'Se', 'Abbr. de Semaine, Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mnl', 'Mois', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mns', 'Ms', 'Abbr. de Mois, Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ynl', 'Année', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yns', 'An', 'Abbr. de Année, Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'prefl', 'Setup', 'Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'prefs', 'Prefs', 'Abbr. for Preferences, Utilisé dans plusieurs vues du calendrier')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butgo', 'GO', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butnew', 'Nouveau', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butedit', 'Modifier', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'prev', 'Précédent', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'next', 'Suivant', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'allday', 'Tous les jours', 'Utilisé dans la vue Semaine et Jours')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'events', 'Evènements', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'event', 'Evènement', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'nyrt', 'Tiens, pas encore inscrit ?<br>Vous n\'êtes qu\'à trois clics de l\'enregistrement utilisateur.<br>Et en tant qu\'utilisateur , vous pourrez créer et aménager vos propres calendriers.<br>', 'Utilisé dans le formulaire Login')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'liw', 'Login', 'Utilisé dans le formulaire Login')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'low', 'Logout', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'lsel', 'Choisir une langue', 'Utilisé dans le formulaire Login')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pli', 'Veuillez entrer votre nom d\'utilisateur et votre mot de passe\'', 'Utilisé dans le formulaire Login')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'un', 'Nom d\'utilisateur\'', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pw', 'Mot de passe', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'subut', 'Enregistrer', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rebut', 'Reset', 'Button Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rlnk', 'Cliquez ici pour vous enregistrer.', 'Utilisé dans le formulaire Login comme lien vers le formulaire d\'enregistrement')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'urth', 'Enregistrement utilisateur', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'urfh', 'Champs', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ureh', 'Entrée', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'urrh', 'Remarques', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fnt', 'Prénom', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'lnt', 'Nom', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'emt', 'E-Mail', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwa', 'Re-Mot de passe', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'llt', 'Langue', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ungt', 'Choisissez votre <b> Nom d\'utilisateur</b>. Il sert à se connecter au calendrier. Il doit être unique et ne doit pas dépasser 10 caractères. Il doit être composé de lettres et de chiffres : aucun caractère spécial ne doit être utilisé.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fngt', 'Merci d\'entrer votre <b>Prénom</b>', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'lngt', 'Merci d\'entrer votre <b>Nom</b>', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'emgt', 'Merci d\'entrer votre <b>E-Mail</b>. Cette adresse doit être opérationnelle. Après avoir rempli ce formulaire d\'enregistrement, vous recevrez votre confirmation par mèl. Vous devrez cliquer sur le lien proposé par ce mèl pour finaliser votre enregistrement.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwgt', 'Merci d\'entrer votre <b>Mot de passe</b>. Le mot de passe est encrypté, si des espaces se trouvent au début ou à la fin, ils sont supprimés.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwagt', 'Retapez le <b>Mot de passe</b> pour confirmer.', 'User registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'llgt', 'Choisissez la <b>Langue</b> d\'utilisation parmi cette liste.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega1', 'Vous avez oublié de remplir le champ Nom d\'utilisateur\'. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega2', 'Vous avez oublié de remplir le champ Nom. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega3', 'Vous avez oublié de remplir le champ prénom. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega4', 'Vous avez oublié de remplir le champ E-Mail. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega5', 'Vous avez oublié de remplir le champ Mot de passe. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega6', 'Vous avez oublié de remplir le champ Re-Mot de passe. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rega7', 'Les Mots de passe ne sont pas semblables. Effectuez la modification et cliquez sur Enregistrer.', 'User Registraton Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'emar', 'Le E-Mail que vous avez entré est déjà dans la base. Vous devez changer votre saisie.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'badem', 'Le E-Mail que vous avez entré n\'a pas la forme requise\'. Veuillez corriger votre saisie.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwreg', 'Votre demande est en cours d\'enregistrement....', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'badun', 'Le Nom d\'utilisateur que vous demandez est déjà utilisé. Vous devez changer votre saisie.', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ldbp', 'Il y a un problème avec la langue choisie. Vous devez contacter l\'administrateur', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'regok', '<br><br>Merci. <br><br>Votre formulaire est bien enregistré. <br>Un mèl de confirmation vient d\'être envoyé. Vous devrez cliquer sur le lien qui s\'y trouve pour être connecté au calendrier. <br><br>Vous disposez d\'un délai de 7 jours pour effctuer votre première connection.<br>', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pier', '<br><br>La Base de donnée a refusé cette entrée. Si le problème persiste, veuillez contacter l\'administrateur.<br><br>Merci', 'User Registration Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'regconf', '<br>Heureux de vous revoir %name% <br> <br>Merci d\'avoir confirmé cet enregistrement. Vous pouvez désormais vous loguer et créer votre propre calendrier.<br><br>N\'hésitez pas à me tenir informé des difficultés que vous pourrez rencontrer, <a href=\"FAQ.php\">cliquez ici pour consulter les FAQ</A><br><br><a href=\"%index%\">Et ici pour ouvrir votre Calendrier !</A>', 'User Registration confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'regfu', '<br>Pardon, Nous ne sommes pas en mesure de trouver la clef de confirmation que vous avez proposée. Peut-être avez-vous attendu trop longtemps. <br><br><a href=\"userreg.php\">Cliquez ici pour vous enregistrer.</a>', 'User Registration Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'rereg', '<br>La clef de confirmation que vous avez proposée est déjà utilisée. <br><br><a href=\"%index%\">Cliquez ici pour vous loguer.</a>', 'User Registration Re-Confirmation Error')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'regnotconf', '<br>Vous n\'avez pas confirmé votre inscription. Vous devez cliquer sur le lien de confirmation du E-Mail qui vient de vous être ré-envoyé. L\'adresse E-mail utilisée est: %email% <br>Si vous n\'utilisez pas cette adresse E-Mail, vous devez renouveler votre formulaire d\'inscription.', 'User Registration not yet confirmed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wrongli', 'Login invalide. Modifiez votre saisie.', 'Login failed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'goli', '<br>Vous êtes connecté. <A HREF=\"%s\">cliquez ici</A> si votre navigateur ne supporte pas l\'actualisation automatique...', 'no longer needed')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'tuid', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'calid', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'calname', 'Nom du Calendrier', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'userid', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'username', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'caltitle', 'Titre du Calendrier', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'caltype', 'Type de Calendrier', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'showweek', 'Afficher N° Semaines', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'preferedview', 'Vue préférée', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'weekstartonLundi', 'La semaine démarre', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'weekselreact', 'Week Select Box React', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'daybeginhour', 'Le jour démarre', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dayendhour', 'Le jour finit', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'timetype', 'Format 12 or 24 Heures', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcttcolor', 'Month Link Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcttbgcolor', 'Month Link Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcttstyle', 'Month Link Header Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcttcellcolor', 'Month Link Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcheaderwdcolor', 'Weekday Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcheaderwdbgcolor', 'Weekday Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcheaderwecolor', 'Weekend Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcheaderwebgcolor', 'Weekend Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwdcolor', 'Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwdbgcolor', 'Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwdstyle', 'Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwecolor', 'Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwebgcolor', 'Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwestyle', 'Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mccdcolor', 'Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mccdbgcolor', 'Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mccdstyle', 'Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mccdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcnccolor', 'Out of Month Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcncbgcolor', 'Out of Month Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcncstyle', 'Out of Month Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcnccellcolor', 'Out of Month Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvttcolor', 'Month Link Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvttbgcolor', 'Month Link Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvttstyle', 'Month Link Header Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvttcellcolor', 'Month Link Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvheaderwdcolor', 'Weekday Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvheaderwdbgcolor', 'Weekday Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvheaderwecolor', 'Weekend Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvheaderwebgcolor', 'Weekend Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwdcolor', 'Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwdbgcolor', 'Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwdstyle', 'Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwecolor', 'Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwebgcolor', 'Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwestyle', 'Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvcdcolor', 'Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvcdbgcolor', 'Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvcdstyle', 'Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvcdcellcolor', 'Current Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvnccellcolor', 'Out of Month Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvheaderwdcolor', 'Header Weekday Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvheaderwdbgcolor', 'Header Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvheaderwecolor', 'Header Weekend Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvheaderwebgcolor', 'Header Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwdcolor', 'Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwdbgcolor', 'Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwdstyle', 'Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwecolor', 'Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwebgcolor', 'Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwestyle', 'Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwecellcolor', 'Weekend Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvcdcolor', 'Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvcdbgcolor', 'Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvcdstyle', 'Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvcdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvnccolor', 'Out of Month Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvncbgcolor', 'Out of Month Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvncstyle', 'Out of Month Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvnccellcolor', 'Out of Month Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwlcolor', 'Week Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwlbgcolor', 'Week Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvwlstyle', 'Week Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwdcolor', 'Header Weekday Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwdbgcolor', 'Header Weekday Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwdstyle', 'Header Weekday Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwdcellcolor', 'Header Weekday Link Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwecolor', 'Header Weekend Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwebgcolor', 'Header Weekend Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwestyle', 'Header Weekend Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderwecellcolor', 'Header Weekend Day Link Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheadercdcolor', 'Header Current Day Link Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheadercdbgcolor', 'Header Current Day Link Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheadercdstyle', 'Header Current Day Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheadercdcellcolor', 'Header Current Day Link Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderadcolor', 'All Day Events Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderadbgcolor', 'All Day Events Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvheaderadcellcolor', 'All Day Events Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvawdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvawdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvawdcellcolor', 'All Day Events Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvawecolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvawebgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvawecellcolor', 'All Day Events Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvacdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvacdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvacdcellcolor', 'All Day Events Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvwdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvwdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvwecolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvwebgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvcdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvcdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvcdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvtccolor', 'Hour Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvtcbgcolor', 'Hour Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvtccellcolor', 'Hour Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvdividerlinecolor', 'Divider Line Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvheadercolor', 'Header Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvadcolor', 'All Day Events Header Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvadbgcolor', 'All Day Events Header Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvadcellcolor', 'All Day Events Header Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvawdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvawdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvawdcellcolor', 'All Day Events Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvawecolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvawebgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvawecellcolor', 'All Day Events Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvacdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvacdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvacdcellcolor', 'All Day Events Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvwdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvwdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvwdcellcolor', 'Weekday Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvwecolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvwebgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvwecellcolor', 'Weekend Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvcdcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvcdbgcolor', 'non utilisé', 'not used')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvcdcellcolor', 'Current Day Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvtccolor', 'Hour Font Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvtcbgcolor', 'Hour Font Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvtccellcolor', 'Hour Cell Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'alcn', 'Vous devez donner un Nom au Calendrier.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'alct', 'Vous devez donner un Titre au Calendrier.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'alts', 'L\'heure de début doit prédéder l\'heure de fin de journée.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'alncc', 'Voulez-vous réellement créer un calendrier avec les réglages', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'calword', 'Calendrier', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'aldel1', 'Voulez-vous réellement supprimer ', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'aldel2', 'Suppression de', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'aldel3', 'Calendrier va aussi supprimer toutes les données qui sont associées, Etes-vous d\'accord ?', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'funcan', 'Fonction annulée', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'scgbut', 'Général', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'sgcbut', 'Global', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'smcbut', 'Mini Calendrier', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'syvbut', 'Voir Année', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'smvbut', 'Voir Mois', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'swvbut', 'Voir Semaine', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'sdvbut', 'Voir Jour', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'srvbut', 'Droits', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ssvbut', 'Souscriptions', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'scabut', 'Catégories', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mycword', 'Mes Calendriers:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'opcalword', 'Autres (Open / Public) Calendriers:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butadd', 'Ajout', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butdel', 'Suppr', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fcalname', 'Ceci est le nom de votre Calendrier. Il doit être unique dans vos Calendriers. Entrez jusqu\'à 50 caractères.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fcaltitle', 'Le titre du Calendrier est le affiché sur chaque vue.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fcaltype', 'Il y a trois types de Calendriers, qu\'il est possible de désactiver avec le Site Admin.<br><b>Libre</b>: consultations et manipulations sont libres.<br><b>Publique</b>: consultations libres, manipulations administrées.<br><b>Privé</b>: consultations et manipulations administrées.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fshowweek', 'Sélectionnez Oui pour afficher les N° de semaines dans la vue par Mois.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fpreview', 'Sélectionnez votre vue préférée. Cette vue sera la vue à l\'ouverture du Calendrier.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fmondays', 'Lundi', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fsundays', 'Dimanche', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fwson', 'Indiquez si votre Calendrier démarre le Lundi ou le Dimanche.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wfyes', 'Oui', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wfno', 'Non', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wftype1', 'Type1', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wftype2', 'Type2', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ftype', '<b>Type1</b>: La boite de selection Semaine préselectionne la semaine en cours, si celle-ci est à moins de 6 weeks de la date affichée, sinon c\'est la première semaine du mois incluant la date affichée qui est pre-sélectionné.<br><b>Type 2</b>: The first week of the Month viewed will always be preselected.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ftimetype', 'Choisir l\'affichage par 24 heures ou par 12 heures avec indice am et pm.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wf12', '12 Heures', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wf24', '24 Heures', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fdayst', 'Choisir l\'heure de début de journée.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fdayen', 'Choisir l\'heure de fin de journée.', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'ffcaltxt', '<b>Vous devez remplir ce formulaire d\'installation pour continuer.</b>', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butsavech', 'Enregistrer', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butpv', 'Rétablir', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butgoc', 'Calendrier', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fnword', 'aucun', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'funword', 'souligner', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'folword', 'surligner', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'fstword', 'barrer', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'funolword', 'souligner et surligner', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'edlt1', 'Editing the ', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'edltt', 'Language Table', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'keyidt', 'KEYID (cannot be changed)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pht', 'Phrase (HTML allowed)', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'leaved', 'Leave Editor Without Saving Changes', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'descword', 'Description', 'Language Editor')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'edlang', 'Modifier langue:', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mkst', 'Par défaut', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'entry', 'Entrée', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'opcw', 'Libre', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pucw', 'Publique', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'prcw', 'Privé', 'Setup Area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'userlo', 'Vous êtes déconnecté', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'linff', 'Vous devez entrer un Nom d\'utilisateur.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'lipff', 'Vous devez entrer un Mot de passe.', 'Logon Screen')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'endwelc', 'Félicitations ! Votre calendrier CaLogic a bien été initialisé.<br><br>Votre Calendrier utilise les réglages par défaut, <br><a href=\"%index%?goprefs=1\">Cliquez ici pour ouvrir les réglages</a> et ajuster l\'affichage de votre Calendrier.<br>Or <a href=\"%index%\">Cliquez ici pour voir le Calendrier.</a><br><br>Vous pouvez retourner aux réglages à tout moment.', 'First Cal Setup Success')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwsnc1', 'Enregistrer règlages', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwsnc2', 'Patientez pendant que votre calendrier ', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwsnc3', 'est enregitré....', 'First Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwlet', 'Enregistrer la langue', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwles', 'Patientez pendant l\'enregistrement des modifications', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pwlec', 'Modifications enregistrées.', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butgoset', 'Aller au Setup', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'butgoled', 'Continuer les modifications de la langue sélectionnée', 'Language Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'badcalnt', 'Nom de calendrier déjà utilisé', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'pctta', 'Cliquez ici pour réessayer.', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'badcaln', 'Vous avez déjà un calendrier du nom de ', 'Calendar Save')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvdtsl', 'La date et l\'heure utilisées par votre Calendrier sont celles du serveur ou ils il est installé.', 'Day View DTS Text')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dtss', 'DST', 'Day Light Saving Time')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'calownerword', 'Auteur du Calendrier', 'used in the setup area')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'tzofword', 'Fuseau horraire', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'tztext', 'Ceci est votre fuseau horraire en GMT. Il se détermine avec vos réglages d\'horloge et de pays. Le fuseau horaire est nécessaire pour afficher la date et l\'heure en local et s\'assurer que les mémos vous seront envoyés correctement.<br>Si le réglage du fuseau aboutit à un décalage horraire, c\'est que les réglages de votre ordinateur ne sont pas corrects. Ne modifiez pas la valeur du fuseau, corrigez plutot les réglages de votre ordinateur.', 'used on the login form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mcdwecellcolor', 'Day With Event Cell Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvdwecellcolor', 'Day With Event Cell Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_btxtfont', 'Standard Font', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_btxtcolor', 'Standard Font Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_standardbgcolor', 'Standard Back Ground Color', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_btxtsize', 'Standard Font Size in points', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_standardbgimg', 'Entrez l\'URL de l\'image background pour votre Calendrier\'', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_prevcolor', '\"Previous\" Link Color ', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_prevbgcolor', '\"Previous\" Link Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscosf_prevstyle', '\"Previous\" Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_nextcolor', '\"Next\" Link Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_nextbgcolor', '\"Next\" Link Background Color', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscosf_nextstyle', '\"Next\" Link Style', 'Calendar Setup Form')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_prefcolor', 'non utilisé', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscosf_prefstyle', 'non utilisé', 'Used in all Headers')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum += 1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscocf_cssc', 'Current Setup Section Button Cell Background Color', 'Used in the setup to highlight the current section button')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);



$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_subtitletxt', 'Event Sub Title Descriptor', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_headpic', 'Header Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_headtext', 'Header Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_headlink', 'Header Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_headtarget', 'Header Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_footpic', 'Footer Banner Pic URL', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_foottext', 'Footer Banner Picture alternat text', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_footlink', 'Footer Banner Link', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoif_foottarget', 'Footer Banner Link Target', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_allowdv', 'Allow Day View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_allowwv', 'Allow Week View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_allowmv', 'Allow Month View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_allowyv', 'Allow Year View', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_dispwvpd', 'Display Week View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_dispmvpd', 'Display Month View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_dispyvpd', 'Display Year View Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_dispcnpd', 'Display Calendar Selector', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_dispevcr', 'Display Event Creator', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_withesb', 'Display Month View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_withwvesb', 'Display Week View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_withdvesb', 'Display Day View Event Scroll Box', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_showomd', 'Display Out of Month Day Numbers', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_showwvtime', 'Show the time column in Week View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$entrynum +=1;
$sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'gcscoyn_showdvtime', 'Show the time column in Day View<br>(not yet implemented)', 'Calendar Setup')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);



        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'yvselmc_mcyv', 'Select if and where you want the mini calendar to show up in the year view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'mvselmc_mcmv', 'Select if and where you want the mini calendar to show up in the month view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'wvselmc_mcwv', 'Select if and where you want the mini calendar to show up in the week view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", 'dvselmc_mcdv', 'Select if and where you want the mini calendar to show up in the day view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
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
            $sqlstr = "INSERT INTO ".$tabpre."_lang_French VALUES (".$entrynum.", '".$keyval."', '".$val."', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }
# --------------------------------------------------------

?>


