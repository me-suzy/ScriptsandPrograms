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
$page = "Themes";
include("../../inc/adminheader.inc.php");
?>
<style>
.tblborder2 td{
border:1px solid #000000;
}
</style>
Below are the themes installed on this copy of WebspotBlogging:<BR><BR>
<table class="tblborder2" width="75%" align="center">
<tr bgcolor="#EFEFEF">
<td><b>ID</b></td>
<td width="73%">
<b>Name</b>
</td>
<td colspan="2">&nbsp;

</td>
<td>Using?</td>
</tr>
<form action="set.php" method="post" name="set">
<?
$query = $database->query("SELECT * FROM theme");
$color1 = 0;
while($themelist = $database->fetch_array($query)){
if($color1 == 1){
echo "<tr class=\"dark\">";
} else {
echo "<tr class=\"light\">";
}
echo "<td>";
echo $themelist['tid'];
echo "</td>";
echo "<td>";
echo $themelist['name'];
echo "</td>";
echo "<td><a href=\"edit.php?tid=".$themelist['tid']."\">Edit</a></td>";
echo "<td><a href=\"delete.php?tid=".$themelist['tid']."\">Delete</a></td>";
echo "<td>";
if ($themelist['using_now'] > 0){
echo "<input type=\"radio\" name=\"using_now2\" value=\"".$themelist['tid']."\" checked onChange=\"document.set.submit();\">";
} else {
echo "<input type=\"radio\" name=\"using_now2\" value=\"".$themelist['tid']."\" onChange=\"document.set.submit();\">";
}
echo "</td>";
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