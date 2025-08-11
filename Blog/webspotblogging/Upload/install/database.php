<?
include("../inc/installheader.inc.php");
?>

Next we require you to enter you MYSQL database settings. Please enter them below.<BR><BR>
<form action="connect.php" method="post">
<table>
<!--Start Database Settings Table-->
<tr>
<td>Host Name</td>
<td><input type="text" name="host"></td>
</tr>
<tr>
<td>Database Username</td>
<td><input type="text" name="username"></td>
</tr>
<tr>
<td>Database Password</td>
<td><input type="password" name="password"></td>
</tr>
<tr>
<td>Database Name</td>
<td><input type="text" name="database"></td>
</tr>
<!--End Database Settings Table-->
</table>
<BR>
<b>
Please verify that all these settings above are correct and then press next.
</b>
<input type="submit" value="Next Step" style="float:right;">
</form>
<?
include("../inc/footer.inc.php");
?>