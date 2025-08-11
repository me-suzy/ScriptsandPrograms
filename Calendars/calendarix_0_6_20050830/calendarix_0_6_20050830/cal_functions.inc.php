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

echo "<table align=center class=menufont border=0 cellspacing=0><tr><td align=left width=60% valign=top>" ;
echo "<div class=menufont>" ;

echo "<a class=none><b>".translate("Event").": </b></a> &nbsp;" ;
if ((($publicview==1)&&($uname!=""))||($publicview==0)) {
  if ($addeventok==1){
    echo "<a class=menufont href='Javascript:void(0);' onclick=\"Javascript:window.open('cal_addevent.php?op=eventform&catview=$catview','popupwin','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=".$addeventwin_w.",height=".$addeventwin_h."');\">".translate("Add")."</a>";
    }
}

if ($administrationok==1){
  if (($addeventok==1)&&((($publicview==1)&&($uname!=""))||($publicview==0))) echo " | " ;
  echo "<a class=menufont href=\"admin/calendar.php\">".translate("Administration")."</a>";
  }

if ($eventcatfilter==1){
  if ((($addeventok==1)&&((($publicview==1)&&($uname!=""))||($publicview==0)))||($administrationok==1)) echo " | " ;
  echo "<a class=menufont href='Javascript:void(0);' onclick=\"Javascript:window.open('cal_catview.php?catview=$catview','viewcat','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=380,height=100');\">".translate("Category")."</a>" ;
  if ($catview!=0) {
    $query = "select cat_name from ".$CAT_TB." where cat_id=$catview";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    echo " - ".stripslashes($row->cat_name) ;
  }
  else echo " - ".translate("All categories") ;

}

echo "<br/><b>".translate("View").": </b> &nbsp;" ;
echo "<a class=menufont href='Javascript:void(0);' onclick=\"Javascript:window.open('yearcal.php?op=yearcal&ycyear=$y','popupyear','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=600');\">".translate("Current Year")."</a>";

if ($viewcalok==1){
  echo " | <a class=menufont href=calendar.php?op=cal&month=$m&year=$y&catview=$catview>".translate("Current Month")."</a>";
}

if ($viewweekok==1){
  echo " | <a class=menufont href=cal_week.php?op=week&catview=$catview>".translate("Current Week")."</a>";
}

if ($viewdayok==1){
  echo " | <a class=menufont href=cal_day.php?op=day&catview=$catview>".translate("Today")."</a>";
}

if ($viewevlistok==1){
  echo " | <a class=menufont href=cal_list.php?op=evlist&catview=$catview>".translate("Coming Events")."</a>";
}

if ($viewcatsok==1){
  echo " | <a class=menufont href=cal_cat.php?op=cats&catview=$catview>".translate("Categories")."</a>";
}


echo "</div></td><td width=40% align=right valign=top>" ;
echo "<div class=menufont>" ;

if ($userlogin==1) {
  if (isset($_SESSION["login"]))
    $callogin = $_SESSION["login"];

  if (isset($_SESSION["login"])) {
    echo " <a class=menufont href=cal_login.php?op=logout>".translate("Logout") ;
    echo " [".$callogin."]" ;
    echo "</a>&nbsp; "  ;
}
else if (($publicview==1)&&(!isset($_SESSION["login"]))){
  echo " <a class=menufont href=cal_login.php?op=logout>".translate("Login") ;
  echo "</a>&nbsp; "  ;
  }
}
else echo " &nbsp; " ;
echo "</div>" ;
echo "</td></tr></table>\n" ;

?>
