<?php
/***************************************************************
** Title.........: CaLogic Base Configuration
** Version.......: 1.0
** Author........: Philip Boone <philip@calogic.de>
** Filename......: config.php
** Last changed..:
** Notes.........: do not change anything in this file
** Use...........: This file sets up a few of the global variables

** Functions: none

***************************************************************/
$GLOBALS["CLPath"]  = substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-8);
include($GLOBALS["CLPath"]."/gcfg.php");
require_once($GLOBALS["CLPath"]."/admin/dbloader.php");
#print "dbloader<br>";
include_once($GLOBALS["CLPath"]."/include/dbfunc.php");
#print "dbfunc<br>";
include_once($GLOBALS["CLPath"]."/classes/htmlMimeMail.php");
$bugrep = "";
# Menu and Popup Color and Font definitions

/*
$pu_MenuBarColor = "#66FFFF";
$pu_MenuBarFont = "Verdana,Arial,Helvetica";
$pu_MenuBarFontColor = "#000000";
$pu_MenuBarFontSize = "2";
$pu_MenuBarHighlightColor = "#3399FF";
$pu_MenuBarHighlightFont = "Verdana,Arial,Helvetica";
$pu_MenuBarHighlightFontColor = "#FFFFFF";

$pu_MenuItemBorderColor = "#3399FF";
$pu_MenuItemColor = "#3399FF";
$pu_MenuItemFont = "Verdana,Arial,Helvetica";
$pu_MenuItemFontColor = "#FFFFFF";
$pu_MenuItemFontSize = "2";
$pu_MenuItemHighlightColor = "#66FFFF";
$pu_MenuItemHighlightFont = "Verdana,Arial,Helvetica";
$pu_MenuItemHighlightFontColor = "#000000";

$pu_PopupDayBorderColor = "#009933";
$pu_PopupDayCaptionColor = "#009933";
$pu_PopupDayCaptionFont = "Verdana,Arial,Helvetica";
$pu_PopupDayCaptionFontColor = "#FFFFFF";
$pu_PopupDayCaptionSize = "1";
$pu_PopupDayColor = "#99ff99";
$pu_PopupDayFont = "Verdana,Arial,Helvetica";
$pu_PopupDayFontColor = "#000000";
$pu_PopupDayFontSize = "1";

$pu_PopupCreatorBorderColor = "#FF6633";
$pu_PopupCreatorCaptionColor = "#FF6633";
$pu_PopupCreatorCaptionFont = "Verdana,Arial,Helvetica";
$pu_PopupCreatorCaptionFontColor = "#FFFFFF";
$pu_PopupCreatorCaptionSize = "1";
$pu_PopupCreatorColor = "#FEF3E0";
$pu_PopupCreatorFont = "Verdana,Arial,Helvetica";
$pu_PopupCreatorFontColor = "#000000";
$pu_PopupCreatorFontSize = "1";

$pu_PopupEventBorderColor = "#333399";
$pu_PopupEventCaptionColor = "#333399";
$pu_PopupEventCaptionFont = "Verdana,Arial,Helvetica";
$pu_PopupEventCaptionFontColor = "#FFFFFF";
$pu_PopupEventCaptionSize = "1";
$pu_PopupEventColor = "#CCCCFF";
$pu_PopupEventFont = "Verdana,Arial,Helvetica";
$pu_PopupEventFontColor = "#000000";
$pu_PopupEventFontSize = "1";
*/
# End  Menu and Popup Color and Font definitions

    $sqlstr = "select * from ".$tabpre."_setup";
    if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
	enderror("Cannot query Standard Setup table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
    }
    if(!$cldb->execute($sqlres,$rowcount)) {
	enderror("Cannot query Standard Setup table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
    }
    if($rowcount !== 1) {
	enderror("Cannot query Standard Setup table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
    }

    if(!$cldb->get_row($sqlres,$row,$eoq)) {
	enderror("Cannot query Standard Setup table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
    }

    $cldb->release($sqlres);

    $wroot = $row["baseurl"];
    $wprogdir = $row["progdir"];
    $forcedefaultcal = $row["forcedefaultcal"];

    require_once($GLOBALS["CLPath"]."/include/setuptab.php");

    for($x=0;$x<$fieldcnt;$x++) {
	if($setuptab[$x][1] != "tabhead") {
	    if(!isset($row[$setuptab[$x][1]])) {
	       ${$setuptab[$x][1]} = $setuptab[$x][8];
	    } else {
		${$setuptab[$x][1]} = $row[$setuptab[$x][1]];
	    }
	}
    }

#for($x=0;$x<$fieldcnt;$x++) {

    #print "FLD: ".$setuptab[$x][1]." = ".${$setuptab[$x][1]}."<br>";

#}

        $adminemail = $row["email"];
        $standardlang =  $row["standardlangid"];
        $postorget = $row["formtype"];
        $mailastext = $row["mailformat"];

        $errep = "<br><br>Version Info<br><br>CaLogic: ".$calogicversion."<br><br>Running at: ".$baseurl.$progdir."<br><br>Owned by: ".$siteowner."<br><br>Email: ".$adminemail."<br><br>MySQL: ".mysql_get_client_info()."<br><br>PHP: ".PHP_VERSION."<br><br><br>Please send this information to me, Philip Boone, so that I may correct this error.<br>My adress is philip@calogic.de, thank you";

    $sysbodystyle = "style=\"";

    if($GLOBALS["btxtfont"] != "") {
	$sysbodystyle .= "font-family: ".$GLOBALS["btxtfont"]."; font-size: ".$GLOBALS["btxtsize"]."pt; ";
    } else {
	$sysbodystyle .= "font-family: Times New Roman; font-size: ".$GLOBALS["btxtsize"]."pt; ";
    }

    if($GLOBALS["btxtcolor"] != "") {
	$sysbodystyle .= "color: ".$GLOBALS["btxtcolor"]."; ";
    } else {
	$sysbodystyle .= "color: Black; ";
    }
    $sysbodystyle .= "\" ";

    if($GLOBALS["standardbgcolor"] != "") {
	$sysbodystyle .= "bgcolor=\"".$GLOBALS["standardbgcolor"]."\" ";
    } else {
	$sysbodystyle .= "bgcolor=\"White\" ";
    }

    if($GLOBALS["standardbgimg"] != "") {
	$sysbodystyle .= "background=\"".$GLOBALS["standardbgimg"]."\" ";
    } else {
	$sysbodystyle .= "background=\"\" ";
    }


#if($uniem == true) {$uniem=1;} else {$uniem=0;}
#if($adsid == 1) {$adsid=true;} else {$adsid=false;}
$adsid=false;

if($seiyv == 1) {$seiyv=true;} else {$seiyv=false;}
if($withesb == 1) {$withesb=true;} else {$withesb=false;}
if($withwvesb == 1) {$withwvesb=true;} else {$withwvesb=false;}
if($withdvesb == 1) {$withdvesb=true;} else {$withdvesb=false;}
if($showomd == 1) {$showomd=true;} else {$showomd=false;}
if($showwvtime == 1) {$showwvtime=true;} else {$showwvtime=false;}
if($showdvtime == 1) {$showdvtime=true;} else {$showdvtime=false;}
if($demomode == 1) {$demomode=true;} else {$demomode=false;}



$curcalcfg = array();
$langcfg = array();
$csectcnt = array();

$sesname="";
$sesvar="";
$gltab = $tabpre."_languages";
$gutab = $tabpre."_user_reg";
$lstyle[1]="underline";
$lstyle[2]="overline";
$lstyle[3]="line-through";

$fsize["medium"] = "1";
$fsize["small"] = "-1";
$fsize["xsmall"] = "-2";

$timear = array();
$timear[0] = "0000";
$timear[1] = "0030";
$timear[2] = "0100";
$timear[3] = "0130";
$timear[4] = "0200";
$timear[5] = "0230";
$timear[6] = "0300";
$timear[7] = "0330";
$timear[8] = "0400";
$timear[9] = "0430";
$timear[10] = "0500";
$timear[11] = "0530";
$timear[12] = "0600";
$timear[13] = "0630";
$timear[14] = "0700";
$timear[15] = "0730";
$timear[16] = "0800";
$timear[17] = "0830";
$timear[18] = "0900";
$timear[19] = "0930";
$timear[20] = "1000";
$timear[21] = "1030";
$timear[22] = "1100";
$timear[23] = "1130";
$timear[24] = "1200";
$timear[25] = "1230";
$timear[26] = "1300";
$timear[27] = "1330";
$timear[28] = "1400";
$timear[29] = "1430";
$timear[30] = "1500";
$timear[31] = "1530";
$timear[32] = "1600";
$timear[33] = "1630";
$timear[34] = "1700";
$timear[35] = "1730";
$timear[36] = "1800";
$timear[37] = "1830";
$timear[38] = "1900";
$timear[39] = "1930";
$timear[40] = "2000";
$timear[41] = "2030";
$timear[42] = "2100";
$timear[43] = "2130";
$timear[44] = "2200";
$timear[45] = "2230";
$timear[46] = "2300";
$timear[47] = "2330";

$timeara = array();
$timeara[0]="12:00 AM";
$timeara[1]="12:30 AM";
$timeara[2]="1:00 AM";
$timeara[3]="1:30 AM";
$timeara[4]="2:00 AM";
$timeara[5]="2:30 AM";
$timeara[6]="3:00 AM";
$timeara[7]="3:30 AM";
$timeara[8]="4:00 AM";
$timeara[9]="4:30 AM";
$timeara[10]="5:00 AM";
$timeara[11]="5:30 AM";
$timeara[12]="6:00 AM";
$timeara[13]="6:30 AM";
$timeara[14]="7:00 AM";
$timeara[15]="7:30 AM";
$timeara[16]="8:00 AM";
$timeara[17]="8:30 AM";
$timeara[18]="9:00 AM";
$timeara[19]="9:30 AM";
$timeara[20]="10:00 AM";
$timeara[21]="10:30 AM";
$timeara[22]="11:00 AM";
$timeara[23]="11:30 AM";
$timeara[24]="12:00 PM";
$timeara[25]="12:30 PM";
$timeara[26]="1:00 PM";
$timeara[27]="1:30 PM";
$timeara[28]="2:00 PM";
$timeara[29]="2:30 PM";
$timeara[30]="3:00 PM";
$timeara[31]="3:30 PM";
$timeara[32]="4:00 PM";
$timeara[33]="4:30 PM";
$timeara[34]="5:00 PM";
$timeara[35]="5:30 PM";
$timeara[36]="6:00 PM";
$timeara[37]="6:30 PM";
$timeara[38]="7:00 PM";
$timeara[39]="7:30 PM";
$timeara[40]="8:00 PM";
$timeara[41]="8:30 PM";
$timeara[42]="9:00 PM";
$timeara[43]="9:30 PM";
$timeara[44]="10:00 PM";
$timeara[45]="10:30 PM";
$timeara[46]="11:00 PM";
$timeara[47]="11:30 PM";

# automation includes
$turnonautomation = false;
if(isset($GLOBALS["includeautomation"])) {
	if(!isset($_POST["includeautomation"])) {
		if(!isset($_GET["includeautomation"])) {
			if($GLOBALS["includeautomation"] == 1) {
				$turnonautomation = true;
			}
		}
	}
}


if($turnonautomation === true) {
    include_once($GLOBALS["CLPath"]."/classes/calogicautomation.php");
}

?>

