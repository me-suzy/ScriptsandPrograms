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

include ("cal_admintop.php");

/*******************/
/* user management */
/*******************/

function users($timeout){
global $USER_TB,$PARAM_TB,$op,$userid,$id ;

  // Check if deleting user
  if (isset($_GET['isdelete']))
    $isdelete = $_GET['isdelete'];
  else
    $isdelete = "n" ;

   $query = "select * from ".$USER_TB." order by username ASC";
   $result = mysql_query($query);

   // this is for the delete user javascript
   echo "<script language=\"JavaScript\">\n" ;
   echo "function deluser(rid,uid) {\n" ;
   echo "if (rid!=uid) {\n" ;
   echo "  window.location.href='cal_user.php?isdelete=y&op=users&id='+rid ; }\n" ;
   echo "else { alert(\"".translate("Cannot delete current login user")."!\")} " ;
   echo "}\n" ;
   echo "</script>\n\n" ;

   echo "<table border=0 width=100% class=headerfont><tr><td align=left>".translate("User Management")."</td></tr></table>\n";

   echo "<table border=0>";
   $i = 1;
   while ($row = mysql_fetch_object($result)){
	echo "<tr><td align=right width=20><div class=titlefont>".$i."</div></td><td align=left><div class=normalfont>" ;
	echo "<a href='#' onclick=\"Javascript:window.open('usertype.php?userid=$row->user_id','usertype','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=300');\">".$row->username."</a>\n" ;
	if ($row->group_id=='0') { 
	  echo " &nbsp; (" ;

	  echo "<!-- <a href='#' onclick=\"Javascript:window.open('usertype.php?usertype=0','usertype','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=300');\"> -->".
translate("Administrator")."<!--</a>-->) &nbsp; " ;
	  }
	else if ($row->group_id=='1') {
	  echo " &nbsp; (" ;
	  echo "<!--<a href='#' onclick=\"Javascript:window.open('usertype.php?usertype=1','usertype','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=300');\"> -->".
translate("User")."<!--</a>-->) &nbsp; " ;
	  }

	echo "</div></td><td align=left><div class=menufont> - <a href=\"#\" onclick=\"Javascript:deluser(".$row->user_id.",".$userid.");\">".translate("Delete user")."</a>" ;
	echo " - <a href=\"cal_adduser.php?op=changepass&userid=".$row->user_id."\">".translate("Change password/group")."</a>" ;
	echo "</div></td></tr>\n\n";
   $i++;
   }
   echo "</table><br/>";
	
   if ($isdelete!="y")
     echo "<div class=titlefont>"."<a href='cal_adduser.php?op=adduser'>".translate("Add new user")."</a></div><br/>";
   else if ($userid!=$id)
     echo "<div class=titlefont>".translate("userdelok")." <a href='cal_user.php?op=userdel&userid=".$id."'>".translate("Yes")."</a>"." / "."<a href='Javascript:history.go(-1);'>".translate("No.")."</a></div><br/>";
  
}

if ($op == "adduser"){
  $login = $_POST['login'];
  $password = $_POST['password'];
  $usertype = $_POST['usertype'];
  $userdesc = $_POST['userdesc'];
}

function adduser($login,$password,$usertype,$userdesc){
global $USER_TB;

  // Check for login and password to be only alpha-numeric

  if ((!preg_match("/^[a-z0-9]+$/i", $login))||(!preg_match("/^[a-z0-9]+$/i", $password))) {
    echo "<script language=\"JavaScript\">\n" ;
    echo "  alert(\"".translate("Username and passwords must be alpha-numeric and without spaces.")."\"); \n" ;
    echo "  document.location.href = \"cal_adduser.php?op=adduser\" \n";
    echo "</script>\n" ;
    echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_adduser.php?op=adduser\">";
  }
  else {
    $crypt = "we6c21end2r4u";
    $cryptpas = crypt($password,$crypt);
    $userdescription = addslashes(nl2br($userdesc)) ;
    $query = "insert into ".$USER_TB." values ('','".$login."','".$cryptpas."','".$userdescription."','".$usertype."')";
    echo "<h4>".translate("Adding user")." ...</h4>" ;
    mysql_query($query);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_user.php?op=users\">";
    }
}

function deluser($userid){
global $USER_TB;
  $query = "delete from ".$USER_TB." where user_id='".$userid."'";
  echo "<h4>".translate("Deleting user")." ...</h4>" ;
  mysql_query($query);
  echo "<meta http-equiv=\"refresh\" content=\"0; url=cal_user.php?op=users\">";
}

switch ($op){

    // overview of admin-users

    case"users":{
	users($timeout);
    break;
    }


    // add new user
    case"adduser":{
	adduser($login,$password,$usertype,$userdesc);
    break;
    }

    //
    case"userdel":{
	deluser($userid);
    break;
    }


    // default: bar, and show new submissions
    default:{
	users($timeout);
    break;
    }
}

include ('cal_footer.inc.php');

?>