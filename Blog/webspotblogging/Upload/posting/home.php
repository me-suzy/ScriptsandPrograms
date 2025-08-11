<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$path = "../";
$modcheck = 1;
$page = "Posting CP Home";
include("../inc/adminheader.inc.php");
?>
<style>
.tblborder2 td{
border:1px solid #000000;
}
</style>
<a href="new.php">New Post</a>
<table class="tblborder2" align="center" width="80%">
<tr bgcolor="#EFEFEF">
<td><b>ID</b></td>
<td><b>Title</b></td>
<td><b>Author</b></td>
<td colspan="2">&nbsp;</td>
</tr>
<?
$color1 = 0;
$query = $database->query("SELECT * FROM blog");
while($post = $database->fetch_array($query)){
if($color1 == 1){
echo "<tr class=\"dark\">";
} else {
echo "<tr class=\"light\">";
}
echo "<td width=\"2%\">".$post['pid']."</td>";
echo "<td width=\"70%\">".$post['title']."</td>";
$query2 = $database->query("SELECT username FROM users WHERE uid = '".$post['uid']."'");
$user = $database->fetch_array($query2);
echo "<td>".$user['username']."</td>";
if($_SESSION['admin'] == 0){
if($post['uid'] == $_SESSION['uid']){
echo "<td><a href=\"edit.php?id=".$post['pid']."\">Edit</a></td>";
echo "<td><a href=\"delete.php?id=".$post['pid']."\">Delete</a></td>";
} else {
echo "<td>&nbsp;</td><td>&nbsp;</td>";
}
} else {
echo "<td><a href=\"edit.php?id=".$post['pid']."\">Edit</a></td>";
echo "<td><a href=\"delete.php?id=".$post['pid']."\">Delete</a></td>";
}
echo "</tr>";
if($color1 == 1){
$color1 = 0;
} else {
$color1 = 1;
}
}
?>
</table>
<?
include("../inc/footer.inc.php");
?>