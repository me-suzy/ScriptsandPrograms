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

include("config.php");
include("./includes/functions.inc.php");
include ("./languages/lang-$language.php");

if(validCookie($_COOKIE['gshout_auth'])){
//include("./includes/header.inc.php");

if ($_POST['action'] == "updateshout") {
    if (validCookie($_COOKIE['gshout_auth'])) {
		if(updateShout($_POST['id'],$_POST['comment'],$_POST['name'],$_POST['sex'],$_POST['uri'],$_POST['timestamp'],$_POST['ip'],$_POST['reply'])){
		$message = _SHOUT_UPDATED;
		echo "<script type='text/javascript'>opener.window.location.href='admin.php?page=".$_POST['gotopage']."&message="._SHOUT_UPDATED."';window.close();</script>";
		}else{
			$error = _ERROR_WRITE_DATA;
			header("Location: admin.php?id=".$_POST['id']."&page=".$_POST['gotopage']."&error="._ERROR_WRITE_DATA."");
		}
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>G-Shout Control Panel&nbsp;&nbsp;&#8250;&nbsp;&nbsp;
Edit Shout</title>


<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<meta name="MSSmartTagsPreventParsing" content="TRUE" />
<meta http-equiv="expires" content="-1" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />

<meta name="Generator" content="G-Shout 1.3.1" />
 

<link rel="stylesheet" type="text/css" href="skins/default.css" />

<style type="text/css">
acronym {
  cursor: help;
}
label {
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
window.open('./about.php', 'About', 'width=310,height=395,location=0,menubar=0,toolbar=0,scrollbars=yes,resizable=0,status=0,screenx=245,screeny=103');
}
//-->
</script>

</head>

<body>
<?

if(!is_writable($datafile)){
	$error = _DATA_UNWRITABLE;
} else if (!is_writable("config.php")){
	$error = _CONF_UNWRITABLE;
} else if (!is_writable($logfile)){
	$error = _LOG_UNWRITABLE;
} else {
}

//stupid way to get data :p
$baris = getShoutByID($_GET['id']);
	$id = $GLOBALS['id'];
	$comment = $GLOBALS['com'];
	$name = $GLOBALS['nam'];
	$sex = $GLOBALS['sex'];
	$uri = $GLOBALS['uri'];
	$timestamp = $GLOBALS['timestamp'];
	$ip = $GLOBALS['ip'];
	$reply = $GLOBALS['reply'];
	$redate = $GLOBALS['redate'];

	//don't forget the page
	$page = $_GET['page'];

if($emoticons != true){

?>

<div id="content">
<table border='0'  cellspacing='0' cellpadding='0' style='width:100%;' >

<?
if(isset($_GET['message'])){
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='success'>";
	echo $_GET['message'];
	echo "</div>";
	echo "</div></td></tr>";
} else if(isset($_GET['error'])) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='alert'>".$_GET['error']."</div>";
	echo "</div></td></tr>";
} else if(isset($message)) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='alert'>".$message."</div>";
	echo "</div></td></tr>";
} else if(isset($error)) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='alert'>".$error."</div>";
	echo "</div></td></tr>";
} else {
	echo "<tr><td><div class='success'>&nbsp;</div></td></tr>";
}
?>
</table>

<form name="editshout" method="post" action="pop_editshout.php">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="timestamp" value="<?=$timestamp?>" />
<input type="hidden" name="gotopage" value="<?=$page?>" />
<input type="hidden" name="redate" value="<?=$redate?>" />
  <table width="53%" border="0" cellspacing="0" cellpadding="2" class="">
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle">ID</div></td>
    <td width="80%">
	<div class='default'><?=$id?></div>
	</td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_DATE?></div></td>
    <td width="80%">
	<div class='default'><?=formattanggal($timestamp)?></div>
	</td>
  </tr>
    <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_NAME?></div></td>
    <td width="80%">
      <input class="input" type="text" name="name" size="35" value="<?=$name?>" />
	  </td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_SEX?></div></td>
    <td width="80%"> 
      <input id="sexm" class="radio" type="radio" name="sex" size="35" value="m" <?if($sex=="m"){$checked="checked='checked'";echo $checked;}?> /><label for="sexm">&nbsp;<?=_MALE?>&nbsp;</label>&nbsp;&nbsp;
      <input id="sexf" class="radio" type="radio" name="sex" size="35" value="f" <?if($sex=="f"){$checked="checked='checked'";echo $checked;}?> /><label for="sexf">&nbsp;<?=_FEMALE?>&nbsp;</label>&nbsp;&nbsp;
    </td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_IP_ADDRESS?></div></td>
    <td width="80%"> 
      <input class="input" type="text" name="ip" size="35" value="<?=$ip?>" />
    </td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_WEB_EMAIL?></div></td>
    <td width="80%"> 
      <input class="input" type="text" name="uri" size="35" value="<?=$uri?>" />
    </td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_MESSAGE?></div></td>
    <td width="80%"> 
      <textarea class="textarea" name="comment" cols="35" wrap="VIRTUAL" rows="4"><?=stripslashes($comment)?></textarea>
    </td>
  </tr>
  <tr align="left" valign="top"> 
    <td>
	&nbsp;
    </td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_REPLYDATE?></div></td>
    <td width="80%"> 
      <div class='default'><? if($redate==""){echo formattanggal(time());}else{echo formattanggal($redate);}?></div>
    </td>
  </tr>
    <tr align="left" valign="top"> 
    <td width="20%"><div class="itemTitle"><?=_REPLY?></div></td>
    <td width="80%"> 
      <textarea class="textarea" name="reply" cols="35" wrap="VIRTUAL" rows="4"><?=stripslashes($reply)?></textarea>
	  <div align="right"><a href="pop_editshout.php?emoticons=true" onclick="window.open(this.href, '_blank', 'width=300,height=300,scrollbars=yes,resizable=no,status=yes,screenx=250,screeny=100');return false;">Emoticons</a></div>
    </td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="20%"> 
      <input type="hidden" name="timestamp" value="<?=$timestamp?>" />
      <input type="hidden" name="action" value="updateshout" />
    </td>
    <td width="80%"> 
      <input type="submit" name="Submit" value="Update Shout" class="submit" />
    </td>
  </tr>
</table>
</form>

<?
} else if(validCookie($_COOKIE['gshout_auth']) AND $emoticons == TRUE) {
	array_walk ($smileys, 'alter_smiley', $smileydir);
	reset ($smileys);
	echo ("<div class=\"smileys\">");
	showEmoticons();
	echo ("</div>");
	echo("&nbsp;<a href=\"javascript:window.close()\">"._CLOSE_WINDOW."</a><br /><br />\n\n");
}
//include("./includes/footer.inc.php");
echo "
</body>
</html>
";
} else if (validCookie($_COOKIE['gshout_auth']) AND $_GET['update'] == "sukses") {

echo "";

echo "
<br /><br /><br />
</body>
</html>
";
} else {
	writeLogs_php($_SERVER["REMOTE_ADDR"],"_LOG_LOGIN_EXPIRED","");
	header("Location: admin.php?error="._RELOGIN."");
}
?>