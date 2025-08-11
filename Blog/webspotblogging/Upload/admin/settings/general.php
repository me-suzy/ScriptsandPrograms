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
$path = "../../";
$admincheck = 1;
$page = "General Settings";
include("../../inc/adminheader.inc.php");
if($_POST['action'] == "save"){
$content = "
<?php
/**********************\
DON'T EDIT THIS FILE
USE THE SETTINGS EDITOR
\**********************/
\$settings[adminemail] = \"".$_POST['adminemail']."\";
\$settings[blogname] = \"".$_POST['blogname']."\";
\$settings[websitename] = \"".$_POST['websitename']."\";
\$settings[websiteurl] = \"".$_POST['websiteurl']."\";
\$settings[contactlink] = \"".$_POST['contactlink']."\";
\$settings[dateformat] = \"".$settings['dateformat']."\";
\$settings[timeformat] = \"".$settings['timeformat']."\";
\$settings[maindateformat] = \"".$settings['maindateformat']."\";
\$settings[timeoffset] = \"".$settings['timeoffset']."\";
\$settings[numberrss] = \"".$_POST['numberrss']."\";
\$settings[showeditedby] = \"".$settings['showeditedby']."\";
\$settings[display_posts] = \"".$settings['display_posts']."\";
\$settings[version] = \"".$settings['version']."\";
?>
";
$file = fopen("../../inc/settings.inc", "w");
fwrite($file, $content);
fclose($file);
header("Location: general.php?msg=Save Complete");
ob_end_flush();
exit();
}
if(isset($_REQUEST['msg'])){
echo "<font color=\"#FF0000\">";
echo $_REQUEST['msg'];
echo "<BR></font>";
}
?>
Edit general settings below:<BR><BR>
<form action="general.php" method="post">
<input type="hidden" name="action" value="save">
<table align="center">
<tr>
<td>
Blog Title : 
</td>
<td>
<input type="text" name="blogname" value="<? echo $settings['blogname']; ?>">
</td>
</tr>
<tr>
<td>
Admin Email : 
</td>
<td>
<input type="text" name="adminemail" value="<? echo $settings['adminemail']; ?>">
</td>
</tr>
<tr>
<td>
Website Name : 
</td>
<td>
<input type="text" name="websitename" value="<? echo $settings['websitename']; ?>">
</td>
</tr>
<tr>
<td>
Website URL : 
</td>
<td>
<input type="text" name="websiteurl" value="<? echo $settings['websiteurl']; ?>">
</td>
</tr>
<tr>
<td>
Contact Link : 
</td>
<td>
<input type="text" name="contactlink" value="<? echo $settings['contactlink']; ?>">
</td>
</tr>
<tr>
<td>
Number of Posts to put in RSS : 
</td>
<td>
<input type="text" name="numberrss" value="<? echo $settings['numberrss']; ?>">
</td>
</tr>
<tr>
<td colspan="2">
<div align="center">
<input type="submit" value="Save">
</div>
</td>
</tr>
</table>
</form>
<?
include("../../inc/footer.inc.php");
ob_end_flush();
?>