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
\$settings[dateformat] = \"".$settings['dateformat']."\";
\$settings[timeformat] = \"".$settings['timeformat']."\";
\$settings[maindateformat] = \"".$settings['maindateformat']."\";
\$settings[timeoffset] = \"".$settings['timeoffset']."\";
\$settings[numberrss] = \"".$settings['numberrss']."\";
\$settings[showeditedby] = \"".$_POST['showeditedby']."\";
\$settings[display_posts] = \"".$_POST['display_posts']."\";
\$settings[version] = \"".$settings['version']."\";
?>
";
$file = fopen("../../inc/settings.inc", "w");
fwrite($file, $content);
fclose($file);
header("Location: display.php?msg=Save Complete");
ob_end_flush();
exit();
}
if(isset($_REQUEST['msg'])){
echo "<font color=\"#FF0000\">";
echo $_REQUEST['msg'];
echo "<BR></font>";
}
?>
Please choose if you want to close the board below:<BR><BR>
<form action="display.php" method="post">
<input type="hidden" name="action" value="save">
<table align="center">
<tr>
<td>
Show Edited By Messages :  
</td>
<td>
<?
if($settings['showeditedby'] > 0){
?>
Yes <input type="radio" name="showeditedby" value="1" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
No <input type="radio" name="showeditedby" value="0">
<?
} else {
?>
Yes <input type="radio" name="showeditedby" value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
No <input type="radio" name="showeditedby" value="0" checked>
<?
}
?>
</td>
</tr>
<tr>
<td>
Number of Posts to Show :  
</td>
<td>
<input type="text" name="display_posts" value="<? echo $settings['display_posts']; ?>">
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