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
$page = "Themes";
include("../inc/global.php");
include("../inc/checks.php");
$query = $database->query("SELECT * FROM `theme` PROCEDURE ANALYSE ( ) ");
$file = "<?php
/**********************\
DON'T EDIT THIS FILE
USE THE SETTINGS EDITOR
\**********************/\n";
while($themeinfo = $database->fetch_array($query)){
$themeinfo = str_replace("theme.","",$themeinfo['Field_name']);
$file .= "\$exportedtheme['".$themeinfo."'] = '\".\$export['".$themeinfo."'].\"'\n";
}
$file .= "?>";
echo $file;
?>