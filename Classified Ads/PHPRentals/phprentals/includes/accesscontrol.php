<?php // accesscontrol.php

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

session_start();

if (isset($_POST['uid'])) {
 $uid = $_POST['uid'];
} else {
 $uid = $_SESSION['uid'];
}
if (isset($_POST['pwd'])) {
 $pwd = md5($_POST['pwd']);
} else {
 $pwd = $_SESSION['pwd'];
}


if(!isset($uid) || !isset($pwd) )
{
  ?>
  <html>
  <head>
  <title> Please Log In for Access </title>
  </head>
<body>
  <table align=center width=300 border=0 cellspacing=0 cellpadding=0 bgcolor="#2f4f4f">
  <tr><td>
   <table border=0 width=100% cellspacing=1 cellpadding=1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method=POST>
    <tr><td BGCOLOR="#2f4f4f"><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif" COLOR="#FFFFFF">
    <B>Please Log In For Access:</B>
    </td></tr>
    <tr><td BGCOLOR="#c7c7c7"><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
You must log in to access this area of the site.
     </td></tr>
    <tr>
     <td BGCOLOR="#fffff0">
      <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr>
     <td><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">Email Address:</td>
     <td><input type=text name="uid" size="20" value=""></td>
    </tr>
        <tr>
     <td><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">Password:</td>
     <td><input type=password name="pwd" size="20"></td>
    </tr>
    <tr>
     <td colspan=2 align=center>
      <input type=submit name="Login" value="Login">
     </td>
    </tr>
    </form>
      </table>
     </td>
    </tr>
   </table>
  </td></tr>
 </table>
  </body>
  </html>
  <?php
  exit;
}
//Clean the input submitted to mysql
$uid=addslashes($uid);
$pwd=addslashes($pwd);

//this puts the variable into the session

$_SESSION['uid'] = $uid; 
$_SESSION['pwd'] = $pwd;

$sql = "SELECT * FROM users WHERE email = '$uid' AND passwd = '$pwd' ";

$result = mysql_query($sql);

if (!$result) {
echo "A database error occurred while checking your login details";
}
//if bad user/pass combo access denied
if (mysql_num_rows($result) == 0) {

  unset($_SESSION['uid']);
  unset($_SESSION['pwd']);
  ?>
  <html>
  <head>
  <title> Access Denied </title>
  </head>
  <body>
  <h1> Access Denied </h1>
  <p>There are several reasons this may be happening:<BR>
  <UL><LI>Your username or password is incorrect</LI>
  <LI>You have forgotten your login information. <a href="/phprentals/html/lostpwd.php">Lost Password</a></LI></UL>
  To return to our login page, <a href="index.php">click here</a>.</p>
  </body>
  </html>
    <?php
  exit;
}

?>