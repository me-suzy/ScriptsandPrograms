<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.6.20050215 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2005 Vincent Hor
##########################################################################

require ('cal_header.inc.php');
include ("cal_utils.php") ;

$id = $_GET['id'];
if (isset($_GET['isdelete']))
  $isdelete = $_GET['isdelete'];
else
  $isdelete = "n" ;


// Check if login , in case of public view, before look for passed username to prevent hacking.
if ((isset($_SESSION["login"]))&&(isset($_GET['uname']))) $uname = $_GET['uname'];
else $uname = "" ;

// used in delete event call
if (!isset($_GET['delev']))  $delev = 0 ;
else $delev = $_GET['delev'] ;

?>
<html>
<head>
 <title>Event</title>
</head>
<body>
<?php
// Close window and refresh calendar if copy event was done, which calls this page with "reload".
if (isset($_GET['reload'])) {
  echo "<script language=\"JavaScript\">\n" ;
  echo "top.opener.window.location.reload() ;\n" ;
  echo "window.close();\n" ;
  echo "</script>\n" ;
  }

if ($allowuserdel==1) {
  // Delete event portion
  if ($delev==1) {
    $dquery = "delete from ".$EVENTS_TB." where id='$id'";
    mysql_query($dquery);
    echo "<h4>".translate("Deleting event")." ...</h4>" ;
    echo "<!-- javascript redirect -->\n" ;
    echo "<script language=\"JavaScript\">\n" ;
    echo "top.opener.window.location.reload();\n" ;
    echo "window.close();\n" ;
    echo "</script>\n\n" ;
    }
}

$query = "select id,user,title,cat_name,description,starttime,endtime,day,month,year,approved,url,email from ".$EVENTS_TB." left join ".$CAT_TB." on ".$EVENTS_TB.".cat=".$CAT_TB.".cat_id where id='$id'";
$result = mysql_query($query);
$row = mysql_fetch_object($result);
echo "<div class=popupeventtitlefont>".stripslashes($row->title)."</div><br/>\n";
echo "\n<div class=popupeventfont>" ;
echo "<b>".translate("Date")." : </b>".$row->day ." ".$mth[$row->month]." ".$row->year."\n";

if ($notimeentry==0) 
	showtime($row->starttime,$row->endtime,2);

echo "<br/><b>".translate("Category")." : </b>".stripslashes($row->cat_name)."\n";
echo "<br/><br/><b>".translate("Event Description")." : </b><br/>\n";
echo "<blockquote>".stripslashes($row->description)."</blockquote>";
echo "<br/>\n";
if ($row->email)
        echo "<br/><b>".translate("Email")." : </b><a href=mailto:".$row->email.">".$row->email."</a>\n";
if ($row->url){
	echo "<br/><b>".translate("More info")." : </b><a href=";
	// for compatibility with up to 0.5 version
	if (strtolower(substr($row->url,0,4))<>"http") echo "http://".$row->url." target=_blank>http://".$row->url."</a>\n";
	else echo $row->url." target=_blank>".$row->url."</a>\n";
}
if (($showuserentry==1)&&($uname!=""))
  echo "<br/><br/><b>".translate("User")." : </b>".$row->user ;
echo "</div><hr/><div align=center class=menufont>" ;

if ((($publicview==1)&&($uname!=""))||($publicview==0)) {
  if (($addeventok==1)&&($isdelete!="y")){
    echo "<a href='#' onclick=\"Javascript:window.open('cal_addevent.php?op=eventform&id=$id','popupwin','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=".$addeventwin_w.",height=".$addeventwin_h."');\">".translate("Copy Event")."</a> ";
  }

  if (($allowuserdel==1)&&($uname==$row->user)) {
    if (($addeventok==1)&&($isdelete!="y")) echo " - " ;
    if ($isdelete!="y")
      echo "<a href='cal_popup.php?op=view&isdelete=y&uname=$uname&id=".$id."' >".ucwords(translate("Delete event"))."</a> ";
    else
      echo "<a href='cal_popup.php?op=view&id=".$id."&delev=1' >".ucwords(translate("Confirm delete?"))."</a> ";
  }
}

echo "<br/><br/>" ;
echo "<a href=\"Javascript:void(0);\" onclick='Javascript:window.close()'>".translate("Close")."</a></div>\n" ;
?>

</body>
</html>
