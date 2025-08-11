<?php
include "admin/connect.php";
$username=$_GET['username'];
$thekey=$_GET['thekey'];
$validate="Update bl_admin set validated='1' where username='$username' and keynode='$thekey'";
mysql_query($validate) or die("Could not validate");
print "You account has been validated. Please go back to <A href='index.php'>Main</a>";
?>