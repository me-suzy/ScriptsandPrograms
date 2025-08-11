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
$admincheck = 1;
$page = "Version Check";
include("../inc/adminheader.inc.php");
$lv = file("http://blogging.webspot.co.uk/vercheck.php?action=lv&ref=".$_SERVER['REMOTE_ADDR']."&rem=".$_SERVER['HTTP_REFERER']);
$la = file("http://blogging.webspot.co.uk/vercheck.php?action=la");
?>
<table width="50%" align="center" class="tblborder">
<tr>
<td class="light">
<b>Your Version</b>
</td>
<td class="dark">
<?
if($settings['version'] >= $lv[0]){ 
echo $settings['version']; 
} else {
echo "<div style=\"background-color:red;\">";
echo $settings['version']; 
echo "</div>";
}
?>
</td>
</tr>
<tr>
<td class="light">
<b>Latest Version</b>
</td>
<td class="dark">
<? echo $lv[0]; ?>
</td>
</tr>
</table>
<BR><BR>
<b>Latest Announcment</b>
<div align="center" class="tblborder">
<?
foreach($la as $value){
echo $value."<BR>";
}
?>
</div>
<?
include("../inc/footer.inc.php");
?>