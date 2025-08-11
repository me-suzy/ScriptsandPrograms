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
$page = "Blog Closure Settings";
include("../../inc/adminheader.inc.php");
if($_POST['action'] == "save"){
$content = "
<?php
/**********************\
DON'T EDIT THIS FILE
USE THE SETTINGS EDITOR
\**********************/
\$settings[adminemail] = \"".$settings['adminemail']."\";
\$settings[blogname] = \"".$settings['blogname']."\";
\$settings[websitename] = \"".$settings['websitename']."\";
\$settings[websiteurl] = \"".$settings['websiteurl']."\";
\$settings[contactlink] = \"".$settings['contactlink']."\";
\$settings[dateformat] = \"".$_POST['dateformat']."\";
\$settings[timeformat] = \"".$_POST['timeformat']."\";
\$settings[maindateformat] = \"".$_POST['maindateformat']."\";
\$settings[timeoffset] = \"".$_POST['timeoffset']."\";
\$settings[numberrss] = \"".$settings['numberrss']."\";
\$settings[showeditedby] = \"".$settings['showeditedby']."\";
\$settings[display_posts] = \"".$settings['display_posts']."\";
\$settings[version] = \"".$settings['version']."\";
?>
";
$file = fopen("../../inc/settings.inc", "w");
fwrite($file, $content);
fclose($file);
header("Location: date.php?msg=Save Complete");
ob_end_flush();
exit();
}
if(isset($_REQUEST['msg'])){
echo "<font color=\"#FF0000\">";
echo $_REQUEST['msg'];
echo "<BR></font>";
}
?>
Below you are able to change date formats and offsets. Please make sure when it asks for a format that you follow formatting set by php's date() function:<BR><BR>
<form action="date.php" method="post">
<input type="hidden" name="action" value="save">
<table align="center">
<tr>
<td>
Posts' Date Format :  
</td>
<td>
<input type="text" name="dateformat" value="<? echo $settings['dateformat']; ?>">
</td>
</tr>
<tr>
<td>
Main Date Format :  
</td>
<td>
<input type="text" name="maindateformat" value="<? echo $settings['maindateformat']; ?>">
</td>
</tr>
<tr>
<td>
Posts' Time Format :  
</td>
<td>
<input type="text" name="timeformat" value="<? echo $settings['timeformat']; ?>">
</td>
</tr>
<tr>
<td>
Time Offset :  
</td>
<td>
<input type="text" name="timeoffset" value="<? echo $settings['timeoffset']; ?>">
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