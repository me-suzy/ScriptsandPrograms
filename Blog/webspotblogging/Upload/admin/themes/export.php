<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
if(isset($_REQUEST['tid'])){
header("Content-Type: text/plain\n");
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
$query = $database->query("SELECT * FROM theme WHERE tid = '".$_REQUEST['tid']."'");
$export = $database->fetch_array($query);
$file = "
/**********************\
SAVE THIS FILE WITH THE FILENAME
AS '".$export['name'].".theme'
\**********************/
\$exportedtheme['name'] = '".$export['name']."';
\$exportedtheme['subhead_text-color'] = '".$export['subhead_text-color']."';
\$exportedtheme['subhead_background-image'] = '".$export['subhead_background-image']."';
\$exportedtheme['subhead_font-family'] = '".$export['subhead_font-family']."';
\$exportedtheme['subhead_font-size'] = '".$export['subhead_font-size']."';
\$exportedtheme['header_text-color'] = '".$export['header_text-color']."';
\$exportedtheme['header_background-image'] = '".$export['header_background-image']."';
\$exportedtheme['header_font-family'] = '".$export['header_font-family']."';
\$exportedtheme['header_font-size'] = '".$export['header_font-size']."';
\$exportedtheme['postcontent_text-color'] = '".$export['postcontent_text-color']."';
\$exportedtheme['postcontent_background-color'] = '".$export['postcontent_background-color']."';
\$exportedtheme['postcontent_font-family'] = '".$export['postcontent_font-family']."';
\$exportedtheme['postcontent_font-size'] = '".$export['postcontent_font-size']."';
\$exportedtheme['content_text-color'] = '".$export['content_text-color']."';
\$exportedtheme['content_background-color'] = '".$export['content_background-color']."';
\$exportedtheme['content_font-family'] = '".$export['content_font-family']."';
\$exportedtheme['content_font-size'] = '".$export['content_font-size']."';
\$exportedtheme['topbar_text-color'] = '".$export['topbar_text-color']."';
\$exportedtheme['topbar_background-color'] = '".$export['topbar_background-color']."';
\$exportedtheme['topbar_font-family'] = '".$export['topbar_font-family']."';
\$exportedtheme['topbar_font-size'] = '".$export['topbar_font-size']."';
\$exportedtheme['topbar_link-color'] = '".$export['topbar_link-color']."';
\$exportedtheme['topbar_linkhover-color'] = '".$export['topbar_linkhover-color']."';
\$exportedtheme['body_background-color'] = '".$export['body_background-color']."';
\$exportedtheme['logo'] = '".$export['logo']."';
\$exportedtheme['content_width'] = '".$export['content_width']."';";
echo $file;
exit();
} else {
$path = "../../";
$admincheck = 1;
$page = "Export a theme";
include("../../inc/adminheader.inc.php");
?>
<style>
.tblborder2 td{
border:1px solid #000000;
}
</style>
Below are the themes installed on this copy of WebspotBlogging. Please click the Export link next to the one that you wish to export. Remember to also get the folder under the main styles directory that contains all of the files for the theme.<BR><BR>
<table class="tblborder2" width="75%" align="center">
<tr bgcolor="#EFEFEF">
<td><b>ID</b></td>
<td width="73%">
<b>Name</b>
</td>
<td>&nbsp;</td>
</tr>
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
echo "<td><a target=\"_blank\" href=\"export.php?tid=".$themelist['tid']."\">Export</a></td>";
echo "</tr>";
if($color1 == 1){
$color1 = 0;
} else {
$color1 = 1;
}
}
?>
</table><BR>
<?
include("../../inc/footer.inc.php");
}
?>