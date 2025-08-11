<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.6.20050830 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2005 Vincent Hor
##########################################################################

if (!isset($_GET['op']))
  $op = '';
else
  $op = $_GET['op'];

session_name("wcal4ulogin");
// if ($op == "eventform")  session_cache_limiter('public');
session_start();

require "../cal_config.inc.php";

$userid = "" ;

  if (isset($_SESSION["login"])){
    $callogin = $_SESSION["login"];
    $calpass = $_SESSION["password"];
    $row = 1;

    $query = "select user_id,username,password from ".$USER_TB." where username='".$callogin."' AND password='".$calpass."' AND group_id='0'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    if (!$row) {
      header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php");
	}
    else $userid = $row->user_id ;

  }
  else 
	{
      header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php");
	}


# some settings of vars
if (!isset($_GET['day']))
  $day = '';
else
  $day = $_GET['day'];
if (!isset($_GET['month']))
  $month = '';
else
  $month = $_GET['month'];
if (!isset($_GET['year']))
  $year = '';
else
  $year = $_GET['year'];
if (!isset($_GET['date']))
  $date = '';
else
  $date = $_GET['date'];
if (!isset($_GET['ask']))
  $ask = '';
else
  $ask = $_GET['ask'];
if (!isset($_GET['id']))
  $id = '';
else
  $id = $_GET['id'];
if (!isset($_GET['uname']))
  $uname = '';
else
  $uname = $_GET['uname'];

if (isset($_GET['userid']))
  $userid = $_GET['userid'];
if (!isset($_GET['timeout']))
  $timeout = 3600 ;

# navbar at the top
$m = date("n");
$y = date("Y");
$d = date("j");

if ((date("G")+$timezone)>24) {
	$d = date("j",mktime(0,0,0,$m,date("j")+1,$y)) ;
	$m = date("n",mktime(0,0,0,$m,date("j")+1,$y)) ;
	$y = date("Y",mktime(0,0,0,$m,date("j")+1,$y)) ;
	}
if ((date("G")+$timezone)<0) {
	$d = date("j",mktime(0,0,0,$m,date("j")-1,$y)) ;
	$m = date("n",mktime(0,0,0,$m,date("j")-1,$y)) ;
	$y = date("Y",mktime(0,0,0,$m,date("j")-1,$y)) ;
	}

// check if there is a week 53 to display based on weekstartday
function showWeek53($cyear) {
	$ShowWeek53 = false ;
	$weeknum = weekNumber(31,12,$cyear) ;
	if ($weeknum>52) $ShowWeek53 = $weeknum ;
	settype($ShowWeek53,"integer");
	return $ShowWeek53 ;
}

/***************************/
/* get weeknumber function */
/***************************/

// weeknumber
function weekNumber($wday,$wmonth,$wyear) {
global $weekstartday ;
	$firstdayofyear = date("w", mktime(0,0,0,1,1,$wyear)) ;
	$dayoffset = $firstdayofyear - $weekstartday - 6;
	if (substr($wmonth,0,1) == "0"){ $wmonth = str_replace("0","",$wmonth);}
	if (substr($wday,0,1) == "0"){ $wday = str_replace("0","",$wday);}
	$WeekNumber = 1;
	if ($firstdayofyear==$weekstartday)
	  $WeekNumber = ceil(((date("z", mktime(0,0,0,$wmonth,$wday,$wyear)))+$dayoffset) / 7) + 1;
	else
	  $WeekNumber = ceil(((date("z", mktime(0,0,0,$wmonth,$wday,$wyear)))+$dayoffset) / 7) ;
	settype($WeekNumber,"integer");
	return $WeekNumber;
}

/*****************/
/* back function */
/*****************/

function back(){
echo "<div class=menufont align=center><a href='Javascript:history.back();'>".translate("Back")."</a></div>\n";
}

// variables used for dynamically generating javascript redirects
if ($day!='') $hd = $day;
else $hd = $d ;
if ($month!='') $hm = $month;
else $hm = $m ;
if ($year!='') $hy = $year;
else $hy = $y ;

if ($date){
  if ($day=='') $hd = substr($date,8,2) ;
  else $hd = $day ;
  if ($month=='') $hm = substr($date,5,2) ;
  else $hm = $month ;
  if ($year=='') $hy = substr($date,0,4) ;
  else $hy = $year ;
}
if ($op=="cal") { $hm = $month ; $hy = $year ; } 	// to handle monthly views
// ensure it does not exceed the max or min year set so scripts cannot jump beyond the restricted dates
if ($hy>($y+$caladvanceyear)) { $hy = $y+$caladvanceyear ; $hm = 12 ; $hd = 31 ; }
if ($hy<$calstartyear) { $hy = $calstartyear ; $hm = 1 ; $hd = 1 ; }
?>

<html>
<head><title>Calendarix : Admin</title>

<?php

if (($op!="eventform")&&($op!="addevent")&&($op!="hist")&&($op!="users")&&($op!="adduser")&&($op!="userdel")&&($op!="smallcal")&&($op!="yearcal")&&($op!="changepass")&&($op!="updateuser")) {
  include ("cal_adminscript.php") ;
}

if (($op!="addevent")&&($op!="userdel")&&($op!="smallcal")&&($op!="yearcal")&&($op!="updateuser")) {
  echo "<script language=\"JavaScript\" src=\"menu.js\"></script>\n";
  echo "<script language=\"JavaScript\" src=\"menu_items.js\"></script>\n";
  echo "<script language=\"JavaScript\" src=\"menu_cal.js\"></script>\n";
  echo "<link rel=\"stylesheet\" href=\"../themes/".$theme.".menu.css\" type\"text/css\" />\n";	
}
?>

<link href="<?php echo "../themes/".$theme.'.css'?>" rel="stylesheet" type"text/css" />
</head>
<body>
<!-- overLIB (c) Erik Bosrup -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script language="JavaScript" src="overlib.js"><!-- overLIB (c) Erik Bosrup --></script> 

<script language="JavaScript">
		new menu (MENU_ITEMS, MENU_POS);
</script>

<?php

function urlvar($uname) {
  if (($uname!="")&&($uname!="-")) echo "&uname=$uname" ;
}

if (($op!="smallcal")&&($op!="yearcal")) {
echo "<br/>";
/*
	echo "<div class=menufont>" ;
	echo "<a href=cal_history.php?op=hist";
	urlvar($uname);
	echo " >".translate("Historical Items")."</a>";
	echo " - <a href=calendar.php?op=approval>".translate("Approvals")."</a>";
	echo " - <a href=calendar.php?op=cal&month=$m&year=$y" ;
	urlvar($uname);
	echo " >".translate("Current Month")."</a>";
	echo " - <a href=cal_adminweek.php?op=week" ;
	urlvar($uname);
	echo " >".translate("Current Week")."</a>";
	echo " - <a href=cal_adminday.php?op=day";
	urlvar($uname);
	echo " >".translate("Today")."</a>";
	echo " - <a href=cal_cat.php?op=cats>".translate("Categories")."</a>";
	echo " - <a href=cal_event.php?op=eventform>".translate("Add Event")."</a>";
	echo " - <a href=cal_user.php?op=users>".ucfirst(translate("users"))."</a>";
	echo " - <a href=cal_login.php?op=logout>".translate("Logout")."</a>";
	echo " - <a href='../calendar.php'>".translate("User Calendar")."</a>";
	echo " &nbsp; &nbsp; </div>" ;
*/

echo "<hr/>\n";
}

?>
