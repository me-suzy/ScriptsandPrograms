<? 
/*
This is TigerTom's Chat Room Software (TTChat).

http://www.tigertom.com
http://www.ttfreeware.com

Copyright (c) 2005 T. O' Donnell

Released under the GNU General Public License, with the
following proviso: 

That the HTML of hyperlinks to the authors' websites
this software generates shall remain intact and unaltered, 
in any version of this software you make.
 
If this is not strictly adhered to, your licence shall be 
rendered null, void and invalid.
*/

include("chat.php");

$usertopost = ($_POST) ? $_POST['username'] : $_GET['username'];

if (isset($_POST['message'])) {
	$smiletopost = (isset($_POST['pic'])) ? $_POST['pic'] : "";
	$msgtopost = $_POST['message'];
	$fontsize = $_POST['fontsize'];
	$fontfamily = $_POST['fontfamily'];
	$fontcolor = $_POST['fontcolor'];
	$fontstyle = $_POST['fontstyle'];
	if ($msgtopost != "") {
		$starttagopen = "<div";
		$starttagclose = ">";
		$starttagmid = "";
		$endtag = "</div>";
		if (($fontsize!="")||($fontfamily!="")||($fontcolor!="")||($fontstyle!="")) {
			$starttagmid = " style=\"";
			if ($fontfamily!="") $starttagmid .= "font-family: '".$fontfamily."';";
			if ($fontsize!="") $starttagmid .= "font-size: $fontsize;";
			if ($fontcolor!="") $starttagmid .= "color: $fontcolor;";
			$starttagmid .= "\"";
			if ($fontstyle!="") {
				$arrstyles = explode(" ", $fontstyle);
				for ($i = 0; $i < count($arrstyles); $i++) {
					$starttagclose .= "<".$arrstyles[$i].">";
					$endtag = "</".$arrstyles[$i].">".$endtag;
				}
			}
		}
		$starttag = "$starttagopen$starttagmid$starttagclose";
		sendmsg($usertopost, $msgtopost, $smiletopost, $starttag, $endtag);
	}
}

$userbanned = userbanned(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title><? echo chat_name; ?></title><link rel="STYLESHEET" type="text/css" href="chatstyles.css">
<? if ($userbanned) { echo '<META HTTP-EQUIV=Refresh CONTENT="'.banned_cookie_len.'; URL=chat_form.php?username='.$usertopost.'">'; } ?>
</head><body class="chatformarea"<? if (!$userbanned) {?> onload="document.chatter.message.focus()"<? } ?>>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr align="center"><td>
<? if ($userbanned) {
	echo '<font size="+2" color="#FF0000"><b>YOU´VE BEEN BANNED FOR USING BAD LANGUAGE<br>
YOU´LL HAVE TO WAIT '. banned_cookie_len.' SECONDS BEFORE POSTING AGAIN</b></font>';
} else { ?>
<form action="chat_form.php" method="post" name="chatter" style="display: inline">
<input type="hidden" name="username" value="<? echo $usertopost; ?>">
<table align="center" border="0" cellpadding="2" cellspacing="0">
<tr align="center">
	<td>&nbsp;<br><input type="radio" name="pic" value=""<? if ((!isset($_POST['pic']))||((isset($_POST['pic']))&&($_POST['pic']==""))) echo " checked"; ?>></td>
	<td><img src="smilies/cool.gif" width="20" height="20" border="0"><br><input type="radio" name="pic" value="cool.gif"<? if ((isset($_POST['pic']))&&($_POST['pic']=="cool.gif")) echo " checked"; ?>></td>
	<td><img src="smilies/sad.gif" width="20" height="20" border="0"><br><input type="radio" name="pic" value="sad.gif"<? if ((isset($_POST['pic']))&&($_POST['pic']=="sad.gif")) echo " checked"; ?>></td>
	<td><img src="smilies/smile.gif" width="20" height="20" border="0"><br><input type="radio" name="pic" value="smile.gif"<? if ((isset($_POST['pic']))&&($_POST['pic']=="smile.gif")) echo " checked"; ?>></td>
	<td><img src="smilies/tongue.gif" width="20" height="20" border="0"><br><input type="radio" name="pic" value="tongue.gif"<? if ((isset($_POST['pic']))&&($_POST['pic']=="tongue.gif")) echo " checked"; ?>></td>
	<td><img src="smilies/wink.gif" width="20" height="20" border="0"><br><input type="radio" name="pic" value="wink.gif"<? if ((isset($_POST['pic']))&&($_POST['pic']=="mink.gif")) echo " checked"; ?>></td>
	<td><select name="fontsize" size="1">
	<option value="">Font size</option>
	<option value="8pt" style="font-size: 8pt"<? if ((isset($_POST['fontsize']))&&($_POST['fontsize']=="8pt")) echo " selected"; ?>>1 (8pt)</option>
	<option value="10pt" style="font-size: 10pt"<? if ((isset($_POST['fontsize']))&&($_POST['fontsize']=="10pt")) echo " selected"; ?>>2 (10pt)</option>
	<option value="12pt" style="font-size: 12pt"<? if ((isset($_POST['fontsize']))&&($_POST['fontsize']=="12pt")) echo " selected"; ?>>3 (12pt)</option>
	<option value="14pt" style="font-size: 14pt"<? if ((isset($_POST['fontsize']))&&($_POST['fontsize']=="14pt")) echo " selected"; ?>>4 (14pt)</option>
</select></td>
	<td><select name="fontfamily" size="1">
	<option value="" selected>Font family</option>
	<? for ($i = 0; $i < count($font_families); $i++) { ?>
	<option value="<? echo $font_families[$i]; ?>" style="font-family: '<? echo $font_families[$i]; ?>'"<? if ((isset($_POST['fontfamily']))&&($_POST['fontfamily']==$font_families[$i])) echo " selected"; ?>><? echo $font_families[$i]; ?></option>
	<? } ?>
</select></td>
	<td><select name="fontcolor" size="1">
	<option value="" selected>Font color</option>
	<? for ($i = 0; $i < count($font_colors); $i++) { ?>
	<option value="<? echo $font_colors[$i]; ?>" style="color: <? echo $font_colors[$i]; ?>"<? if ((isset($_POST['fontcolor']))&&($_POST['fontcolor']==$font_colors[$i])) echo " selected"; ?>><? echo $font_colors[$i]; ?></option>
	<? } ?>
</select></td>
	<td><select name="fontstyle" size="1">
	<option value="">Font style</option>
	<option value="" style="font-style: normal"<? if ((isset($_POST['fontstyle']))&&($_POST['fontstyle']=="")) echo " selected"; ?>>normal</option>
	<option value="b" style="font-weight: bold"<? if ((isset($_POST['fontstyle']))&&($_POST['fontstyle']=="b")) echo " selected"; ?>>bold</option>
	<option value="b i" style="font-weight: bold; font-style: italic"<? if ((isset($_POST['fontstyle']))&&($_POST['fontstyle']=="b i")) echo " selected"; ?>>bold italic</option>
	<option value="i" style="font-style: italic"<? if ((isset($_POST['fontstyle']))&&($_POST['fontstyle']=="i")) echo " selected"; ?>>italic</option>
</select></td>
</tr>
</table>
<table align="center" border="0" cellpadding="5" cellspacing="0">
<tr>
	<td><input type="text" name="message" autocomplete="off" size="50" maxlength="<? echo max_chars_len; ?>"></td>
	<td><input type="submit" value="SEND"></form></td>
	<td><form action="exit.php" target="_top" style="display: inline"><input type="hidden" name="u" value="<? echo $usertopost;?>"><input type="submit" value="EXIT"></form></td>
</tr>
</table>

<? } ?>
</td></tr>
</table>

</body></html>
