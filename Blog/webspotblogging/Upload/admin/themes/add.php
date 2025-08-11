<?php
ob_start();
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
?>
<?
if($_POST['action'] == "new"){
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
$sql = "INSERT INTO theme SET `name` = '".$_POST['name']."', `subhead_text-color` = '".$_POST['subhead_text-color']."', `subhead_background-image` = '".$_POST['subhead_background-image']."', `subhead_font-family` = '".$_POST['subhead_font-family']."', `subhead_font-size` = '".$_POST['subhead_font-size']."', `header_text-color` = '".$_POST['header_text-color']."', `header_background-image` = '".$_POST['header_background-image']."', `header_font-family` = '".$_POST['header_font-family']."', `header_font-size` = '".$_POST['header_font-size']."', `postcontent_text-color` = '".$_POST['postcontent_text-color']."', `postcontent_background-color` = '".$_POST['postcontent_background-color']."', `postcontent_font-family` = '".$_POST['postcontent_font-family']."', `postcontent_font-size` = '".$_POST['postcontent_font-size']."', `content_text-color` = '".$_POST['content_text-color']."', `content_background-color` = '".$_POST['content_background-color']."', `content_font-family` = '".$_POST['content_font-family']."', `content_font-size` = '".$_POST['content_font-size']."', `topbar_text-color` = '".$_POST['topbar_text-color']."', `topbar_background-color` = '".$_POST['topbar_background-color']."', `topbar_font-family` = '".$_POST['topbar_font-family']."', `topbar_font-size` = '".$_POST['topbar_font-size']."', `topbar_link-color` = '".$_POST['topbar_link-color']."', `topbar_linkhover-color` = '".$_POST['topbar_linkhover-color']."', `body_background-color` = '".$_POST['body_background-color']."', `logo` = '".$_POST['logo']."', `content_width` = '".$_POST['content_width']."'";
$database->query($sql);
header("Location: index.php");
ob_end_flush();
exit();
}

$path = "../../";
$admincheck = 1;
$page = "New Theme";
include("../../inc/adminheader.inc.php");
?>
<form action="add.php" method="post">
<table>
<tr><td>name</td><td><input type="text" name="name"></td></tr>
<tr><td>subhead_text-color</td><td><input type="text" name="subhead_text-color"></td></tr>

<tr><td>subhead_background-image</td><td><input type="text" name="subhead_background-image"></td></tr>

<tr><td>subhead_font-family</td><td><input type="text" name="subhead_font-family"></td></tr>
<tr><td>subhead_font-size</td><td><input type="text" name="subhead_font-size"></td></tr>
<tr><td>header_text-color</td><td><input type="text" name="header_text-color"></td></tr>
<tr><td>header_background-image</td><td><input type="text" name="header_background-image"></td></tr>

<tr><td>header_font-family</td><td><input type="text" name="header_font-family"></td></tr>
<tr><td>header_font-size</td><td><input type="text" name="header_font-size"></td></tr>
<tr><td>postcontent_text-color</td><td><input type="text" name="postcontent_text-color"></td></tr>
<tr><td>postcontent_background-color</td><td><input type="text" name="postcontent_background-color"></td></tr>
<tr><td>postcontent_font-family</td><td><input type="text" name="postcontent_font-family"></td></tr>
<tr><td>postcontent_font-size</td><td><input type="text" name="postcontent_font-size"></td></tr>
<tr><td>content_text-color</td><td><input type="text" name="content_text-color"></td></tr>
<tr><td>content_background-color</td><td><input type="text" name="content_background-color"></td></tr>
<tr><td>content_font-family</td><td><input type="text" name="content_font-family"></td></tr>

<tr><td>content_font-size</td><td><input type="text" name="content_font-size"></td></tr>
<tr><td>topbar_text-color</td><td><input type="text" name="topbar_text-color"></td></tr>
<tr><td>topbar_background-color</td><td><input type="text" name="topbar_background-color"></td></tr>
<tr><td>topbar_font-family</td><td><input type="text" name="topbar_font-family"></td></tr>
<tr><td>topbar_font-size</td><td><input type="text" name="topbar_font-size"></td></tr>
<tr><td>topbar_link-color</td><td><input type="text" name="topbar_link-color"></td></tr>
<tr><td>topbar_linkhover-color</td><td><input type="text" name="topbar_linkhover-color"></td></tr>
<tr><td>body_background-color</td><td><input type="text" name="body_background-color"></td></tr>
<tr><td>logo</td><td><input type="text" name="logo"></td></tr>

<tr><td>content_width</td><td><input type="text" name="content_width"></td></tr>
<tr>
<td colspan="2">
<input type="hidden" name='action' value="new">
<input type="submit" value="Save!">
</td>
</tr>
</table>
</form>
<?
include("../../inc/footer.inc.php");
ob_end_flush();
?>
