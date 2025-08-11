<?php

/************************************************************************/
/* G-Shout : Gravitasi Shoutbox                                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2005 by Yohanes Pradono                                */
/* http://gravitasi.com                                                 */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

// to prevent direct access
if (eregi("header.inc.php",$_SERVER['PHP_SELF'])) {           
	die("<b>Access Denied!</b><br /><i>You can't access this file directly...</i><br /><br />- G-Shout -");
}

header("Expires: Sun, 10 Jan 1982 05:00:00 GMT"); // donie's birthday
header("Last-Modified: ".gmdate("D, d M Y H:i:s"). " GMT"); // always modified
if($SERVER_PROTOCOL == "HTTP/1.0"){
header("Pragma: no-cache"); // HTTP/1.0
}else{
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
}

if(is_file("install.php")){
		echo("There is install.php. If you have installed g-shout, you MUST delete install.php (or rename it to anything) and then you can go to Admin Control Panel directly.<br />But if you have not installed g-shout yet, read the README.txt file inside \"docs\" directory and then run install.php to check the required files. <br /><br />");
	echo ("<a href='admin.php'>click here to Login to Admin Control Panel</a> (you MUST delete install.php first)<br />");
	echo ("<a href='install.php'>click here to run install.php</a><br />");
	echo ("<br />");
	die("WARNING!!! You must delete install.php before using G-Shout");
}

// just checking if there is a datafile or not
if (is_writable($datafile) AND filesize($datafile) <= 35) {
	if($file = fopen($datafile, "w+")) {
		fwrite($file, "1#%Hi :D. You can delete this shout from Control Panel. Check G-Shout Website for update. Thanx for using G-Shout.#%");
		fwrite($file, "donie#%m#%http://gravitasi.com#%".time()."#%#%#%#%\n");
		fclose($file);
	}
} else if (!is_writable($datafile)) {
	$error = _DATA_UNWRITABLE;
} else {}

if (validCookie($_COOKIE['gshout_auth']) && $_GET['action'] != "logout"){
	makeCookie($admin_password);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>G-Shout <?=_CONTROL_PANEL?>&nbsp;&nbsp;&#8250;&nbsp;&nbsp;
<?
if(!validCookie($_COOKIE['gshout_auth']) && eregi("admin.php",$_SERVER['PHP_SELF']) && empty($forget)){
	$pagetitle = _LOGIN;
} else if (validCookie($_COOKIE['gshout_auth']) && eregi("admin.php",$_SERVER['PHP_SELF'])) {
	$pagetitle = _EDIT_SHOUTS;
} else if (validCookie($_COOKIE['gshout_auth']) && eregi("editshout.php",$_SERVER['PHP_SELF'])) {
	$pagetitle = _EDIT_SHOUT;
} else if (eregi("editconf.php",$_SERVER['PHP_SELF'])) {
	$pagetitle = _CONFIGURATION;
} else if (eregi("logs.php",$_SERVER['PHP_SELF'])) {
	$pagetitle = _VIEW_LOGS;
} else {
	$pagetitle = _FORGOT_PASSWORD;
}
echo $pagetitle;
?>
</title>


<meta http-equiv="content-type" content="text/html; charset=<?=_CHARSET?>" />
<meta name="MSSmartTagsPreventParsing" content="TRUE" />
<meta http-equiv="expires" content="-1" />
<?
if($SERVER_PROTOCOL == "HTTP/1.0"){
echo("<meta http-equiv=\"pragma\" content=\"no-cache\" />\n");
}else{
echo("<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\" />\n");
}
?>
<meta name="Generator" content="G-Shout <?=$version?>" />
 
<link rel="stylesheet" type="text/css" href="<?echo "skins/".$skin.".css";?>" />

<style type="text/css">
acronym {
  cursor: help;
}
label.hand {
	cursor: pointer;
}
</style>

<script type="text/javascript">
<!--
function add_smiley_cp(smiley)
{
    opener.document.editshout.reply.value += " " + smiley + " ";
    opener.window.document.editshout.reply.focus();
    window.close();
}
function about(){
window.open('./about.php', 'About', 'width=325,height=342,location=0,menubar=0,toolbar=0,scrollbars=yes,resizable=1,status=0,screenx=245,screeny=102');
}
//-->
</script>

</head>

<body>

<div id="topBar">

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody>

<tr>

<td class="helpLinks">
<div class="helpLinksLeft">
<a href="javascript:void(0)" onclick="javascript:about()">G-Shout&nbsp;&nbsp;<?=$version?></a>
</div>
</td>

<? if($emoticons != true){ ?>

<td class="helpLinks">
<a href="<?=$adminweb?>" target="_blank"><?=_MY_WEBSITE?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<?=_CURRENT_TIME?>: <?=formattanggal(time())?>&nbsp;&nbsp;&nbsp;
<?
if(validCookie($_COOKIE['gshout_auth'])){
echo "|&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=logout\">"._LOGOUT."</a>";
}
?>

<? } ?>

</td>

</tr>

</tbody></table>


</div>
<div id="header">&nbsp;</div>