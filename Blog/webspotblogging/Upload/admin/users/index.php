<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$path = "../../";
$admincheck = 1;
$page = "Users";
include("../../inc/adminheader.inc.php");
?>
<style>
.tblborder2 td{
border:1px solid #000000;
}
</style>
Here are all of the users that have been created on this blog. If they are <font color="#009900">Green</font> that means that they are an administrator. If they are <font color="#0099FF">Blue</font> that means that the user is not an administrator.<BR><BR>
<table class="tblborder2" width="75%" align="center">
<tr bgcolor="#EFEFEF">
<td><b>ID</b></td>
<td width="73%">
<b>Username</b>
</td>
<td colspan="2">&nbsp;

</td>
</tr>
<form action="set.php" method="post" name="set">
<?
$query = $database->query("SELECT * FROM users");
$color1 = 0;
while($userlist = $database->fetch_array($query)){
if($color1 == 1){
echo "<tr class=\"dark\">";
} else {
echo "<tr class=\"light\">";
}
echo "<td>";
echo $userlist['uid'];
echo "</td>";
echo "<td><b>";
if($userlist['admin'] == 1){
echo "<font color=\"#009900\">".$userlist['username']."</font>";
} else {
echo "<font color=\"#0099FF\">".$userlist['username']."</font>";
}
echo "</b></td>";
echo "<td><a href=\"edit.php?uid=".$userlist['uid']."\">Edit</a></td>";
echo "<td><a href=\"delete.php?uid=".$userlist['uid']."\">Delete</a></td>";
echo "</tr>";
if($color1 == 1){
$color1 = 0;
} else {
$color1 = 1;
}
}
?>
</form>
</table><BR>
<?
include("../../inc/footer.inc.php");
?>