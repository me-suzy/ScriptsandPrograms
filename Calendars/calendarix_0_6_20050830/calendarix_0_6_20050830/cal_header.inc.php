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

session_name("wcal4ulogin");
# some settings of vars
if (!isset($_GET['op']))
  $op = '';
else
  $op = $_GET['op'];
//if ($op == "eventform") session_cache_limiter('public');
session_start();
if (!isset($_SESSION["login"]))
// important to destroy session so as not to conflict with overlib when php insert session info automatically
{
  session_unset(); 
  session_destroy(); 
}

require "cal_config.inc.php";

$userid = "" ;
$uname = "" ;
$ugroup = 1 ;  // For usergroup definition when there is no login, default to 'user'

if ($userlogin==1) {
  if (isset($_SESSION["login"])){
    $callogin = $_SESSION["login"];
    $calpass = $_SESSION["password"];
    $row = 1;

    $query = "select username,password,user_id,group_id from ".$USER_TB." where username='".$callogin."' AND password='".$calpass."'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);

    if (!$row) {
	  if ($publicview==0)
        header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php");
	}
    else {
      $userid = $row->user_id ;
	  $ugroup = $row->group_id ;
	  $uname = $row->username ;
	  }
    }
  else 
	{
	if (($publicview==0)||($op== "eventform")||($op== "addevent"))
        header ("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php");
	}
}

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

// Use for view events of one category in calendar
if (!isset($_GET['catview']))  $catview = 0 ;
else {
	$catview = $_GET['catview'] ;
	if (preg_match("/[\-'*<>;+@]/",$catview)) $catview = 0;	// check to prevent sql injection
	if (preg_match("/and/",$catview)) $catview = 0;	// check to prevent sql injection
	if (preg_match("/or/",$catview)) $catview = 0;	// check to prevent sql injection
}

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
	//$ShowWeek53 = false ;
	$weeknum = weekNumber(31,12,$cyear) ;
	if ($weeknum>52) $ShowWeek53 = $weeknum ;
	settype($ShowWeek53,"integer");
	return $ShowWeek53 ;
}

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

// variables used for dynamically generating javascript redirects
$hd = $d ;
$hm = $m ;
$hy = $y ;
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
<head>
  <title>Calendar</title>

	<script language="Javascript">
	// script used for popup events
	function popup(event)
	{
	  var url = 'cal_popup.php?op=view&id='+event+'&uname=<?php echo $uname?>' ;
	  window.open(url,'Calendar','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=<?php echo $popupeventwidth?>,height=<?php echo $popupeventheight?>');
	}
	</script>

<?php

if (($op != "eventform")&&($op != "addevent")&&($op!="smallcal")&&($op!="yearcal")&&(!isset($_GET['delev']))&&($op!="view")) {

// this is for the goto month redirection javascript
echo "<!-- javascript redirect -->\n" ;
echo "<script language=\"JavaScript\">\n" ;
echo "// this script must be defined after variables hd,hm and hy is defined!\n" ;
echo "function gotomonth(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "switch (geti) {\n" ;
for ($i=1;$i<13;$i++) {
echo "  case \"".$i."\" : { window.location.href='calendar.php?op=cal&month=".$i."&year=".$hy."&catview=$catview' ; break ;}\n" ;
}
echo "  default : { window.location.href='calendar.php?op=cal&month=".$hm."&year=".$hy."&catview=$catview' ; break;}\n" ;
echo "  }\n" ;
echo "}\n" ;
echo "</script>\n\n" ;


// this is for the goto year redirection javascript
echo "<script language=\"JavaScript\">\n" ;
echo "// this script must be defined after hd,hm and hy is defined!\n" ;
echo "\tfunction gotoyear(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=$calstartyear;$i<=($y+$caladvanceyear);++$i) {
  echo "case \"$i\" : { window.location.href='calendar.php?op=cal&month=".$hm."&year=".$i."&catview=$catview' ; break ;} \n" ;
}
echo "default : { window.location.href='calendar.php?op=cal&month=$hm&year=$hy&catview=$catview' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;


// this is for the goto week redirection javascript
$weeknumber = weekNumber($hd,$hm,$hy) ;
echo "<script language=\"JavaScript\">\n" ;
echo "\tfunction gotoweek(selectopt) {\n" ;
echo "var geti = '1' ;\n" ;
echo "for (i=0;i<selectopt.options.length;i++) {\n" ;
echo "\tif (selectopt.options[i].selected) {\n" ;
echo "\t\tgeti = selectopt.options[i].value ;\n" ;
echo "\t\tbreak ;\n" ;
echo "\t}\n" ;
echo "}\n\n" ;
echo "\t\tswitch (geti) { \n" ;
for ($i=1;$i<=54;++$i) {				// maximum ever number of weeks is 54!
  echo "case \"".$i."\" : { window.location.href='cal_week.php?op=week&date=" ;
  $totaldays = ($i - $weeknumber) * 7 + $hd;
  echo date("Y-m-d", mktime(0,0,0,$hm,$totaldays,$hy)) ;
  echo "&catview=$catview' ; break ;} \n" ;
}
echo "default : { window.location.href='cal_week.php?op=week&date=".date("Y-m-d", mktime(0,0,0,$hm,$hd,$hy))."&catview=$catview' ; break;} \n" ;
echo "\t\t}\n" ;
echo "\t}\n" ;
echo "</script>" ;

}

?>
<link href="themes/<?php echo $theme.'.css'?>" rel="stylesheet" type"text/css" />
</head>
<body>
<!-- overLIB (c) Erik Bosrup -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script language="JavaScript" src="overlib.js"><!-- overLIB (c) Erik Bosrup --></script> 

<?php
if (($op != "eventform")&&($op != "addevent")&&($op!="smallcal")&&($op!="yearcal")&&($op!="view")&&(!isset($_GET['delev']))) {
	// ************  Company Name Header Information
	if ($showcompanyname==1) {
		echo "\n\n<table class=companynamefont width='100%' align=center border=0><tr><td align=center valign=middle>".$companyname."</td></tr></table>\n\n";
		}
}

if (($op != "eventform")&&($op != "addevent")&&($op!="smallcal")&&($op!="yearcal")&&($op!="view")&&(!isset($_GET['delev']))) {
	// ************  Calendar Name Header Information
	if ($showcalendarname==1) {
	echo "\n\n<table class=calendarnamefont width='100%' align=center border=0><tr><td align=center valign=middle>".$calendarname."</td></tr></table>\n\n";
	}
}

?>



