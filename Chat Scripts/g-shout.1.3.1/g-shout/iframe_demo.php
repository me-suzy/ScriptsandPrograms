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

/********************************************
This is the example of the iframe, modify it.
*********************************************/

include("config.php");
include("./languages/lang-".$language.".php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>G-Shout <?=$version?> | Iframe Demo</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=_CHARSET?>" />
<?
if($SERVER_PROTOCOL == "HTTP/1.0"){
echo("<meta http-equiv=\"pragma\" content=\"no-cache\" />\n");
}else{
echo("<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\" />\n");
}
?>
<meta name="Generator" content="G-Shout <?=$version?>" />

<style type="text/css">
body {
	padding-right: 0px; 
	padding-left: 0px; 
	background: #fff; 
	padding-bottom: 0px; 
	margin: 0px auto; 
	color: #333; 
	padding-top: 0px; 
	font-family: 'Lucida Grande', Verdana, Arial, Helvetica, sans-serif;
}

a {
	color: #4169aa; 
	background-color: transparent; 
	text-decoration: none;
}
a:link {
	color: #4169aa; 
	background-color: transparent; 
	text-decoration: none;
}
a:visited {
	color: #4169aa; 
	background-color: transparent; 
	text-decoration: none;
}
a:active {
	color: #f30;
}
a:hover {
	color: #fff; 
	background-color: #4169aa; 
	text-decoration: none;
}
  
.input {
	padding-right: 0px; 
	border-top: #999999 1px solid; 
	margin-top: 6px; 
	padding-left: 2px; 
	font-size: 11px; 
	margin-bottom: 3px; 
	padding-bottom: 0px; 
	border-left: #999999 1px solid; 
	color: #333; 
	padding-top: 0.3em; 
	font-family: Verdana, geneva, tahoma, trebuchet ms, Arial, sans-serif; 
	height: 1.6em; 
	background-color: #fff;
}


.input:focus {
	background-color : #efefef;
	color: #000000;
}


.checkbox {
	border-top-width: 0px; 
	padding-right: 0px; 
	padding-left: 0px; 
	border-left-width: 0px; 
	border-bottom-width: 0px; 
	padding-bottom: 0px; 
	margin: 3px; 
	padding-top: 0px; 
	background-color: transparent; 
	border-right-width: 0px;
}

label {
	cursor: pointer;
}
.radio {
	cursor: pointer;
	font-size: 9px;
	color: #000;
	background-color: transparent;
	padding-left: 7px;
}
.submit {
	padding-right: 3px; 
	margin-top: 6px; 
	padding-left: 3px; 
	font-weight: normal; 
	font-size: 10px; 
	margin-bottom: 4px; 
	padding-bottom: 1px; 
	text-transform: uppercase; 
	color: #000; 
	padding-top: 1px; 
	font-family: Arial, Verdana, sans-serif; 
	letter-spacing: 0.1em; 
	background-color: #fff;
}


#shoutboxform {
    padding-left: 15px;
}

</style>

<script type="text/javascript">

function calc(f) {
                clipped = false;
                maxLength = 160;

                if (f.gcomment.value.length > maxLength) {
                f.gcomment.value = f.gcomment.value.substring(0,maxLength);
                    charleft = 0;
                    clipped = true;
                        txtd = "Ndak isa nulis lagi";
                } else {
                        charleft = maxLength - f.gcomment.value.length;
                        txtd = "Tersisa " + charleft + " karakter";
                }

       f.quota.value = charleft;
                return clipped;
}
</script>

</head>

<body>

<!-- Begin G-Shout Shoutbox -->

<div style="width:180px;padding-top:20px;padding-right:20px;padding-left:20px;padding-bottom:20px;">
<iframe id="shoutbox" name="shoutbox" src="shoutbox.php" frameborder="0" width="100%" scrolling="yes" height="300"> Your browser does not support inline frames or is currently configured not to display inline frames.
</iframe>

<p />

<form name="newguest" action="shoutbox.php" method="post" target="shoutbox">


<input class="input" maxlength="20" size="20" name="gname" value="<?=_DEFAULT_NAME?>" onblur="if(this.value=='') this.value='<?=_DEFAULT_NAME?>';" onfocus="if(this.value=='<?=_DEFAULT_NAME?>') this.value='';" />
<br />
<input name="gsex" type="hidden" value="" />
<label class="radio" for="sex_male">
<input class="radio" id="sex_male" name="gsex" type="radio" value="m" /> Male </label>
<label class="radio" for="sex_female">
<input class="radio" id="sex_female" name="gsex" type="radio" value="f" /> Female </label>
<br />
<input class="input" size="20" name="guri" value="<?=_DEFAULT_URI?>" onblur="if(this.value=='') this.value='<?=_DEFAULT_URI?>';" onfocus="if(this.value=='<?=_DEFAULT_URI?>') this.value='';" />
<br />
<input class="input" maxlength="<?=$maxchars?>" size="20" id="gcomment"  name="gcomment" value="<?=_DEFAULT_MESSAGE?>" onblur="if(this.value=='') this.value='<?=_DEFAULT_MESSAGE?>';" onfocus="if(this.value=='<?=_DEFAULT_MESSAGE?>') this.value='';" onkeyup="calc(this.form)" />
<br />

<input class="readonly" readonly="readonly" size="4" value="160" name="quota" />

<input type="hidden" value="true" name="formsubmitted" />
<br />
<input class="submit" type="submit" value="Shout" name="Submit" />
<input class="submit" type="reset" value="Reset" name="Reset" />
<br />
<a title="Tags allowed, Emoticons, HTML Encoding" href="shoutbox.php?help=true" onclick="window.open(this.href, '_blank', 'width=300,height=400,scrollbars=yes,resizable=no,status=yes,screenx=5,screeny=5');return false;" onkeypress="this.onclick()">Help</a>
</form>
</div>

<!-- End of G-Shout Shoutbox -->

</body>
</html>