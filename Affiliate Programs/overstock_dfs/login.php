<?php
include("includes/db.conf.php");
include("includes/connect.inc.php");



if (isset($_POST['Submit'])){
$pass=md5($_POST['password']);
  $query = "SELECT * from admin where username='$_POST[username]' and password='$pass'";
  $mysqlresult = mysql_query($query);
  $row=mysql_fetch_array($mysqlresult);
  $num=mysql_num_rows($mysqlresult);
  if ($num>0){
    
      session_start();
      $_SESSION['auth']=1;
echo "<html><head></head><body>";
echo "<script language='JavaScript'>window.location.href='admin.php';</script>  </body></html>";

  }}
?>
<html>
<head>
<style type="text/css">
body {font-family: arial}
</style></head>

<body bgcolor='#CCCCFF'>

<form action=login.php method='post'><center>
<table><tr>
<td ><b>Username</b></td><td><input type='text' name='username'></td></tr>
<tr><td ><b>Password</b></td><td><input type='password' name='password'></td></tr>
<tr><td colspan=2><input type='submit' name='Submit'></td></tr>
</table>
</form>
</center>
</body>
</html>
