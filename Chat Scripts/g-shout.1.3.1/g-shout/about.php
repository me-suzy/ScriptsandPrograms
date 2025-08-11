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

header("Expires: Sun, 10 Jan 1982 05:00:00 GMT"); // donie's birthday
header("Last-Modified: ".gmdate("D, d M Y H:i:s"). " GMT"); // always modified
if($SERVER_PROTOCOL == "HTTP/1.0"){
header("Pragma: no-cache"); // HTTP/1.0
}else{
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
}

include("./config.php");
include("./includes/functions.inc.php");
include("./languages/lang-".$language.".php");

$d_site = "http://slowrock.org";
$g_site = "http://gravitasi.com";
$feedback = "donie@gravitasi.com";

$tag_feedback = "<a href='mailto:".$feedback."' target='_blank'>".$feedback."</a>";

function mawut($email){
	$address = $email;
	$text = $email;
	$extra = "";
		$string = '<a href="mailto:'.$address.'" '.$extra.'>'.$text.'</a>';

		$bit = array();
		for ($i = 0; $i < strlen($string); $i++)
			{
			$bit[] .= 'v'.bin2hex(substr($string, $i, 1));
			}
		$bit = array_reverse($bit);

		$i = 0;
		$enkode = '';
		foreach ($bit as $val) {
			$enkode .= "u[".$i++."]='$val';";
		}

return "<script type=\"text/javascript\">var u=new Array();".$enkode."for(var i=u.length-1;i>=0;i--){if (u[i].substring(0,1)=='v') document.write(unescape(\"%\"+u[i].substring(1)));else document.write(unescape(u[i]));}</script>";

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<title>About G-Shout &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</title>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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

<link rel="stylesheet" type="text/css" href="<?echo "skins/".$skin.".css";$hr = "no";?>"/>

<style type="text/css">
#img_logo {
posi
}
#reg_to {
	border: 1px solid #999;
	margin: 10px 10px 10px 10px;
	padding: 10px 10px 10px 10px;
	text-align: center;
}
</style>

</head>
<body>

<!--
<table style="width: 100%;height: 100%;" class="tableBorder" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td class="tablePad">
-->

<table style="width: 100%; height: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody>

<tr>
<td class='tableCellOne'>


<div style="width:275px;height:117px;padding-left:15px;text-align:center;">

<img src="./images/g-shout.gif" width="275" height="117" />

</div>

<div class="defaultBold">
G-Shout
</div>
version <?=$version?>

<div class="subtext">
Website  : <a href="<?=$g_site?>" target="_blank"><?=$g_site?></a><br />
Feedback : 
<!--
<script type="text/javascript">document.write( unescape('<?=hex_encode($tag_feedback)?>') );</script>
-->
<?=mawut($tag_feedback)?>
</div>

<? /*TEMPORARY UNDER CONSTRUCTION ?>
<div id="reg_to">
<div class="highlight">
<?
echo(eval(gzuncompress(base64_decode("eJzLTNNIzkhNzg5KTddQKUpNj89OrdTUrE5NzshXUAIKZhaXpBalpihZ16bmFKdCxUPziqAyQHEAFqoX4w=="))));
?>
</div>
</div>
<? */ ?>

<div class="subtext">
G-Shout and G-Shout logo are copyright &copy; 2005 by <a href="<?=$g_site?>" target="_blank">Gravitasi</a>. All rights reserved.
<br />
G-Shout is Free Software released under the <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU/GPL license</a>.
</div>
<br />
<div>
<?=$HTTP_USER_AGENT?>
</div>

</td>
</tr>
<tr>
<td class='tableCellTwo' align='center' >

<input style="width:75px" class="submit" type="submit" value="OK" onclick="window.close()"/>

</td>
</tr>

</tbody>
</table>

<!--
</td>
</tr>
</tbody>
</table>
-->

</body>
</html>