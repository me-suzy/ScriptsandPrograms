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


$sql="update admin set overid='$_POST[overid]' where id='1' ";
$mysqlresult = mysql_query($sql);

echo "New Overstock Id set.";
}

$queryp=mysql_query("select * from admin");
$rowp=mysql_fetch_array($queryp);


?>
<form action='overid.php' method='post'>
<table>
<tr><td><b>Overstock Id</b></td><td><input type='text' name='overid' value='<?php echo $rowp['overid'] ?> '></td></tr>
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
