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

header("Expires: Sun, 10 Jan 1982 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s"));
if($SERVER_PROTOCOL == "HTTP/1.0"){
header("Pragma: no-cache");
}else{
header("Cache-Control: no-cache, must-revalidate");
}

include("config.php");
include("./includes/functions.inc.php");
include ("./languages/lang-$language.php");

if(validCookie($gshout_auth)){
include("./includes/header.inc.php");

if(!is_writable($datafile)){
	$error = _DATA_UNWRITABLE;
} else if (!is_writable("config.php")){
	$error = _CONF_UNWRITABLE;
} else if (!is_writable($logfile)){
	$error = _LOG_UNWRITABLE;
}

if($emoticons != true){

?>

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="navCell" style="width: 2%;">

<div class="cpNavOff">
&nbsp;
</div>

</td>

<td class="navCell">
<div class="cpNavOn">
<a href="admin.php">&nbsp;<?=_EDIT_SHOUTS?>&nbsp;</a>
</div>
</td>


<td class="navCell">
<div class="cpNavOff">
<a href="editconf.php">&nbsp;<?=_CONFIGURATION?>&nbsp;</a>
</div>
</td>

<td class="navCell">
<div class="cpNavOff">
<a href="logs.php">&nbsp;<?=_VIEW_LOGS?>&nbsp;</a>
</div>
</td>


<td class="navCell" style="width: 2%;">

<div class="cpNavOff">
&nbsp;
</div>

</td>
</tr>
</tbody></table>



<div id="breadcrumb">
<table style="width: 100%;" class="contentWidth" border="0" cellpadding="6" cellspacing="0">
<tbody><tr>
<td class="defaultBold">
<span class="crumblinks">
<h2><?=_EDIT_SHOUT?></h2>
</span>
</td>
<td class="breadcrumbRight">
&nbsp;
</td>
</tr>
</tbody></table>


</div>

<div id="content">
<table border='0'  cellspacing='0' cellpadding='0' style='width:100%;' >

<?
if(isset($message)){
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='success'>";
	echo $message;
	echo "</div>";
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

<form name="editshout" method="post" action="admin.php">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="timestamp" value="<?=$timestamp?>" />
<input type="hidden" name="gotopage" value="<?=$page?>" />
  <table width="53%" border="0" cellspacing="0" cellpadding="2" class="">
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
      <textarea class="textarea" name="comment" cols="60" wrap="VIRTUAL" rows="7"><?=stripslashes($comment)?></textarea>
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
      <textarea class="textarea" name="reply" cols="60" wrap="VIRTUAL" rows="7"><?=stripslashes($reply)?></textarea>
	  <div align="right"><a href="editshout.php?emoticons=true" onclick="window.open(this.href, '_blank', 'width=300,height=400,scrollbars=yes,resizable=no,status=yes,screenx=250,screeny=100');return false;"  onkeypress="this.onclick()">Emoticons</a></div>
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
} else if($emoticons == TRUE) {
	array_walk ($smileys, 'alter_smiley', $smileydir);
	reset ($smileys);
	echo ("<div class=\"smileys\">");
	showEmoticons();
	echo ("</div>");
	echo("&nbsp;<a href=\"javascript:window.close()\">"._CLOSE_WINDOW."</a><br /><br />\n\n");
}
include("./includes/footer.inc.php");
} else {
	header("Location: admin.php");
}
?>