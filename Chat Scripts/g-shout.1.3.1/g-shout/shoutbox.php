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

include("config.php");
include("./includes/functions.inc.php");
include ("./languages/lang-".$language.".php");

/* this is useful if the form becomes one with shoutbox.
if($usecookie && $formsubmitted) {

	SetCookie ("gnamec", $gname, time()+2592000);
	SetCookie ("guric", $guri, time()+2592000);
	SetCookie ("gsexc", $gsex, time()+2592000);
	$gnamec = $gname;
	$guric = $guri;
	$gsexc = $gsex;

} else if (!$usecookie && $formsubmitted) {
	SetCookie ("gnamec", $gname, time()-2592000);
	SetCookie ("guric", $guri, time()-2592000);
	SetCookie ("gsexc", $gsex, time()-2592000);
	SetCookie ("gname", $gname, time());
	SetCookie ("guri", $guri, time());
	SetCookie ("gsex", $gsex, time());
}
*/

// antiflood system, started from version 1.1
if($formsubmitted && !isset($blockflooder) && getTimestampByIP($_SERVER["REMOTE_ADDR"]) >= time()-ceil($floodwait*60)) {
	$blockflood = TRUE;
} else {
	$blockflood = FALSE;
}

// DELETION IS SUCCESS OR NOT
if ($action == "deleteshout"){
        if ($_SERVER["REMOTE_ADDR"] == getIP($id)) {
			deleteShout($id);
			$message = _PROCESS_DELETED;
			} else {
				$error = _PROCESS_DELETEFAILED;
				}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>G-Shout</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=_CHARSET?>" />
<?
// to check the HTTP version
if($SERVER_PROTOCOL == "HTTP/1.0"){
echo("<meta http-equiv=\"pragma\" content=\"no-cache\" />\n");
}else{
echo("<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\" />\n");
}
?>
<meta name="Generator" content="G-Shout <?=$version?>" />

<?
// if you want your shoutbox depends on skins when you update skins from admin cpanel, uncomment this out
/*
<link rel="stylesheet" type="text/css" href="<?echo "skins/".$skin.".css";$hr = "no";?>"/>
*/
?>

<style type="text/css">
<!--
.textfield, input, textarea {
	font-family: verdana, arial, helvetica, sans-serif;
	font-size: 9px;
	color: #333333;
	background-color: #ffffff;
	border: #333333; 
	border-style: solid; 
	border-top-width: 1px; 
	border-right-width: 1px; 
	border-bottom-width: 1px; 
	border-left-width: 1px;
	width: 130;
}

html, body, p, td {
	scrollbar-face-color: #ffffff; 
	scrollbar-shadow-color: #ffffff; 
	scrollbar-highlight-color: #ffffff; 
	scrollbar-3dlight-color: #ffffff; 
	scrollbar-darkshadow-color: #838b8b; 
	scrollbar-track-color: #ededed; 
	scrollbar-arrow-color: #4169aa;

	font-family: verdana, arial, helvetica, sans-serif;
	font-size: 9px;
	color: #333333;
	background: #fff;
}

a {
	text-decoration: none;
	color: #FF8800;
}

a:link {
	color: #f30;
	text-decoration: none;
}

a:vlink {
	color: #f30;
}

a:alink {
	color: #f30;
}

a:visited {
	color: #f30;
}

a:hover {
	color: #fff;
	background-color:#f30;
}

hr {
	color: #999999;
	width: 100%;
	height: 1px;
}
#yahoo a, #yahoo a:link, #yahoo a:active, #yahoo a:visited, #yahoo a:hover {
	color: #ff0000;
	font-family: "Courier New", Courier, mono;
	font-weight: bold;
	font-size: small;
	background: none;
}
div.smileys a.icon, div.smileys a:link.icon, div.smileys a:active.icon, div.smileys a:visited.icon, div.smileys a:hover.icon {
	background: none;
}

.success {
	background: #f0f8ff;
	border: 1px solid #69c;
	padding: 0.2em 1em 0.2em 1em;
}
.alert {
	background: #fff0f8;
	border: 1px solid #cc666f;
	padding: 0.2em 1em 0.2em 1em;
}

a.delete:link, a.delete:visited {
	background: none;
	color: red;
	font-weight: bold;
}
a.delete:hover {
	background: #c00;
	color: #fff;
	font-weight: bold;
}

a.edit, a.delete, a.edit:hover, a.delete:hover {
	border-bottom: none;
	display: block;
	padding: 5px 0;
	text-align: center;
	width: 100%;
}

label {
	cursor: pointer;
}
-->
</style>
<script type="text/javascript">
<!--
function add_smiley(smiley)
{
	// if help page opened in new window, use this
    opener.document.newguest.gcomment.value += " " + smiley + " ";
    opener.window.document.newguest.gcomment.focus();
    window.close();

	// if help page opened inside the IFRAME, use this
	//parent.document.newguest.gcomment.value += " " + smiley + " ";
    //parent.window.document.newguest.gcomment.focus();
}
//-->
</script>
</head>
<body>

<?

// just checking if there is a datafile or not
if (is_writable($datafile) AND filesize($datafile) <= 35) {
	if($file = fopen($datafile, "w+")) {
		fwrite($file, "".$id."#%Hi :D. You can delete this shout from Control Panel. Check G-Shout Website for update. Thanx for using G-Shout.#%");
		fwrite($file, "donie#%m#%http://gravitasi.com#%".time()."#%#%#%#%\n");
		fclose($file);
	}
} else if (!is_writable($datafile)) {
	$error = _DATA_UNWRITABLE;
} else {}

if($formsubmitted && $blockflood && ($floodwait > 0)) {
	$error = _PLEASE_WAIT;
} else if($formsubmitted) {
	$gname = strip_tags($gname);
	// if ok, then write the shout to datafile
	writeTag($gname, $gsex, $guri, $gcomment);
} else {}

// to show success/error message
if(isset($message)){
	echo "<div class='success'>";
	echo $message;
	echo "</div><br /><br />";
} else if(isset($error)) {
	echo "<div class='alert'>".$error."</div><br /><br />";
} else {}


// this function used to show ShoutBox
viewShoutBox();

include ("./languages/lang-$language.php");
if($help == TRUE){
	//echo("<a href=\"javascript:history.go(-1)\">BACK</a><br /><br />\n\n");
	echo("<a href=\"javascript:window.close()\">"._CLOSE_WINDOW."</a><br /><br />\n\n");
	echo ("<div class=\"smileys\">");
	showHelp();
	echo ("</div>");
    //echo("<a href=\"javascript:history.go(-1)\">BACK</a><br /><br />\n\n");
	echo("<a href=\"javascript:window.close()\">"._CLOSE_WINDOW."</a><br /><br />\n\n");
} else {

/*******************
BEGIN OF PAGINATION
*******************/
echo "<div align=\"center\">";
$shoutcount = countShouts();
if (!isset($page)||$page==0) {
	//$page=floor($shoutcount/20)+1;
	$page=1;
	}

$entry = ($commentshown * $page)-$commentshown;
$selesai = $commentshown*$page;
$output = getShouts($start,20,1);

        if ($page != 1) {
            echo "<a href='".$PHP_SELF."?page=1'>[ &lt;&lt; ]</a> <a href='".$PHP_SELF."?page=".($page-1)."&amp;commentshown=".$commentshown."'>[ &lt; ]</a> ";
        } else {
            echo "<font color='#666666'>[ &lt;&lt; ] [ &lt; ]</font> ";            
        }
        for ($count=0;$count<$shoutcount;$count=$count+$commentshown) {
            $newpage = floor($count/$commentshown) + 1;
            if ($page == $newpage) {
                echo $newpage." ";
            } else {
                echo "<a href='".$PHP_SELF."?page=".$newpage."&amp;commentshown=".$commentshown."'>".$newpage."</a> ";
            }
        }
		if ($page != floor($shoutcount/$commentshown)+1) {
            echo "<a href='".$PHP_SELF."?page=".($page+1)."&amp;commentshown=".$commentshown."'>[ &gt; ]</a> <a href='".$PHP_SELF."?page=".(floor($shoutcount/$commentshown)+1)."&amp;commentshown=".$commentshown."'>[ &gt;&gt; ]</a>";
        } else {
            echo "<font color='#666666'>[ &gt; ] [ &gt;&gt; ]</font>";
        }
echo "</div>";
// end of pagination
}

?>
<br />
</body>
</html>