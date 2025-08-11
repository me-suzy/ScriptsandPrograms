<?php
session_start();
?>
<html>
<head>
<style type="text/css">
body {font-family: arial}
</style></head>

<body bgcolor='#CCCCFF'>
<center>
<?php
include ("includes/db.conf.php");
include ("includes/connect.inc.php");


if (isset($_SESSION['auth'])){



if (isset($_POST['submit'])){
if ($_POST['pass1']==$_POST['pass2']){

$pass=md5($_POST['pass1']);
$sql="update admin set password='$pass' where id='1' ";
$mysqlresult = mysql_query($sql);

echo "New password set.";


}else{
echo "<center>You have to type the same password on both fields</center><br>";
}
}


?>
<form action='password.php' method='post'>
<table>
<tr><td><b>New Password</b></td><td><input type='password' name='pass1'></td></tr>
<tr><td><b>Retype Password</b></td><td><input type='password' name='pass2'></td></tr>
<tr><td colspan=2><input type='submit' name='submit'></td></tr>
</table>
</form>
</center>
<?php

}else{

echo "<center>You are not allowed to see this page</center>";
}?>
</body>
</html>

