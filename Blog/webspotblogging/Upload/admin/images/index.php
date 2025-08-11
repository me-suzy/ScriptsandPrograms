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
$page = "Post Images";
include("../../inc/adminheader.inc.php");
?>
<style>
.tblborder2 td{
border:1px solid #000000;
}
</style>
Here are all of the post images that have been created on this blog. Click on the edit button to edit them and the delete button to delete them.
<table class="tblborder2" width="75%" align="center">
<tr bgcolor="#EFEFEF">
<td><b>ID</b></td>
<td width="73%">
<b>Alt text</b>
</td>
<td>
<b>Filename</b>
</td>
<td colspan="2">&nbsp;

</td>
</tr>
<form action="set.php" method="post" name="set">
<?
$query = $database->query("SELECT * FROM images");
$color1 = 0;
while($userlist = $database->fetch_array($query)){
if($color1 == 1){
echo "<tr class=\"dark\">";
} else {
echo "<tr class=\"light\">";
}
echo "<td>";
echo $userlist['gid'];
echo "</td>";
echo "<td>";
echo $userlist['alt'];
echo "</td>";
echo "<td>".$userlist['filename']."</td>";
echo "<td><a href=\"edit.php?gid=".$userlist['gid']."\">Edit</a></td>";
echo "<td><a href=\"delete.php?gid=".$userlist['gid']."\">Delete</a></td>";
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