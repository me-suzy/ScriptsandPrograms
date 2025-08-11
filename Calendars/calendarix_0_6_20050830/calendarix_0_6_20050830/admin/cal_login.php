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

ob_start();

if (!isset($_GET['op']))
  $op = '';
else
  $op = $_GET['op'];

require ("../cal_config.inc.php");

if ($op == "loginok"){
  header("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/calendar.php");
  exit() ;
}

if ($op == "logout"){
  session_name("wcal4ulogin");
  session_start(); 
  session_unset(); 
  session_destroy(); 
}

if ($op == "login"){
  $loginok = false ;
  $request_type = strtolower($_SERVER["REQUEST_METHOD"]);
  $login = $_POST['login'];
  $password = $_POST['password'];

  // Remove all white spaces
  //$login = preg_replace("/ +/i", "", $_POST['login']);
  //$password = preg_replace("/ +/i", "", $_POST['password']);

  if ((trim($password)!="")&&($request_type=="post"))
  // Check for login and password to be only alpha-numeric
  //  if ((preg_match("/^[a-z0-9]+$/i", $login))&&(preg_match("/^[a-z0-9]+$/i", $password))) 
    $loginok = true ;

  $crypt = "we6c21end2r4u" ;
  $cryptpas = crypt($password,$crypt);
  $query = "select username,password from ".$USER_TB." where username='".$login."' AND password='".$cryptpas."' AND group_id='0'";
  $result = mysql_query($query);
  $row = mysql_fetch_object($result);

  if ((!$row)||(!$loginok)){
    $logintemplate = false ;
    if (file_exists("callogin_top.html")) $logintemplate = true ;
    if ($logintemplate) include ("callogin_top.html");
    else {
	echo "<html><head><title>".translate("Web Calendar Admin Login")."</title>\n";
	echo "<link href=\"../themes/".$theme.".css\" rel=\"stylesheet\" type\"text/css\" />\n";
	echo "</head><body><p>&nbsp;</p><div align=center class=titlefont>".translate("Web Calendar Admin Login")."</div>" ;
	}
    echo "<div align=center class=menufont><p>&nbsp;</p><b><i>".translate("wronglogin")."!</i></b>";
    echo "<br/><br/><a href=javascript:history.back()>".translate("Back")."</a><br/>";
    echo "</div>" ;
    if ($logintemplate) include ("callogin_bottom.html");
    exit();
    }
  else{
  	  // get session time out setting
//	  $query = "select * from ".$PARAM_TB." where name='session_timeout' ";
//	  $result = mysql_query($query);
//	  $row = mysql_fetch_object($result) ;
//	  session_cache_expire($row->value);
	  session_name("wcal4ulogin");
	  session_start(); 
	  $_SESSION["login"] = $row->username; 
	  $_SESSION["password"]= $row->password; 
	  header("location: ".$protocol."://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cal_login.php?op=loginok");
	  ob_end_flush();
	  // req'd when output_buffering = Off in php.ini
	  // echo "<meta http-equiv=\"refresh\" content=\"0;url=cal_login.php?op=loginok\">";
	}
}
else {
  $logintemplate = false ;
  if (file_exists("callogin_top.html")) $logintemplate = true ;
  if ($logintemplate) include ("callogin_top.html");
  else {
	echo "<html><head><title>".translate("Web Calendar Admin Login")."</title>\n";
	echo "<link href=\"../themes/".$theme.".css\" rel=\"stylesheet\" type\"text/css\" />\n";
	echo "</head><body><p>&nbsp;</p><div align=center class=titlefont>".translate("Web Calendar Admin Login")."</div>" ;
	}
  echo "<div align=center><form action=cal_login.php?op=login method=post><table align=center width=300 border=0><tr><td align=right><div class=menufont>";
  echo "<b>".ucfirst(translate("username")).":</b></div></td><td align=left><input type=text name=login></td></tr><tr><td align=right><div class=menufont>" ;
  echo "<b>".ucfirst(translate("password")).":</b></div></td><td align=left><input type=password name=password></td></tr><tr><td align=left>&nbsp;</td><td align=center>" ;
  echo "<input type=submit value='     ".translate("Login")."     '></td></tr>";
  echo "</table>" ;
  echo "</form>";
  echo "<div align=center class=menufont><a href=\"../calendar.php\">".translate("User Calendar")."</a></div>" ;
  echo "</div>" ;
  if ($logintemplate) include ("callogin_bottom.html");
  exit();
}

?>
</body>
</html>
