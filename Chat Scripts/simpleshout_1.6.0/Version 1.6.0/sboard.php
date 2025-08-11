<?php

/***************************************************************************
 *                            sboard.php
 *                         ----------------
 *   version              : version 1.6.0
 *   begin                : November 25, 2005
 *   copyright            : Jive Networks Resources
 *   email                : software@jivenetworks.com
 *   Script URL           : http://www.jivenetworks.info/software/php/simpleshout/
 *   License              : GNU General Public License
 *   http://www.gnu.org/copyleft/gpl.html
 ***************************************************************************/

// Configuration
$config = "config.php";

// Require files
require $config;

// Require Data Properties
$banfile = file($ipban);
$banfile = implode(' ', $banfile);
IF(strstr($banfile, $REMOTE_ADDR))
	{
	echo "Error: You have been banned!";
    die;
	}
	
// Start Add
if ($sact==add) {

echo "<link rel='stylesheet' href='style.css' type='text/css'>";
echo "<body bgcolor='$bgcolor' text=\"$text\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style='margin: 0pt;'>";

$name = strip_tags($name,"");
$site = strip_tags($site,"");

if ($site == "$field2") {
$name_link = "$name";
} elseif ($site == "") {
$name_link = "$name";
} else {
$name_link = "<a href=\"$field2$site\" target=\"_blank\" title=\"$name - $site\">$name</a>";

}

if ($name == "name") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=sboard.php?message=Enter+Name&info2=$info&site2=$site\">";
} elseif ($name == "") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=sboard.php?message=Enter+Name&info2=$info&site2=$site\">";
} elseif ($info == "") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=sboard.php?message=Enter+Message&name2=$name&site2=$site\">";
} elseif ($info == "message") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=sboard.php?message=Enter+Message&name2=$name&site2=$site\">";
} elseif (strlen($info)>$max_char) {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=sboard.php?message=Max+Characters+($max_char)&name2=$name&site2=$site\">";
} else {

$file = "data.dat";

	$info = strip_tags($info,"");
	// Start smilie codes
	$info = str_replace(":)","<img src='smilies/smile.gif'>",$info);
	$info = str_replace(":(","<img src='smilies/sad.gif'>",$info);
	$info = str_replace(":D","<img src='smilies/biggrin.gif'>",$info);
	$info = str_replace("8)","<img src='smilies/cool.gif'>",$info);
	$info = str_replace(":@","<img src='smilies/mad.gif'>",$info);
	$info = str_replace(";)","<img src='smilies/wink.gif'>",$info);
	$info = str_replace("???","<img src='smilies/confused.gif'>",$info);
	$info = str_replace(":amazed:","<img src='smilies/amazed.gif'>",$info);
	$info = str_replace(":notrust:","<img src='smilies/notrust.gif'>",$info);
	$info = str_replace(":noworry:","<img src='smilies/noworry.gif'>",$info);
	$info = str_replace(":nuts:","<img src='smilies/nuts.gif'>",$info);
	$info = str_replace(":oh:","<img src='smilies/oh.gif'>",$info);
	$info = str_replace(":rolleyes:","<img src='smilies/rolleyes.gif'>",$info);
	$info = str_replace(":'(","<img src='smilies/cry.gif'>",$info);
	$info = str_replace(":sick:","<img src='smilies/sick.gif'>",$info);
	$info = str_replace(":suspicious:","<img src='smilies/suspicious.gif'>",$info);
	$info = str_replace(":P","<img src='smilies/tongue.gif'>",$info);
	$info = str_replace(":unsure:","<img src='smilies/unsure.gif'>",$info);
	$info = str_replace(":wacko:","<img src='smilies/wacko.gif'>",$info);
	$info = str_replace(":weird:","<img src='smilies/weird.gif'>",$info);
	$info = str_replace(":worried:","<img src='smilies/worried.gif'>",$info);
	// Start bbcodes
	$info = str_replace("[hr]","<hr>",$info);
	$info = str_replace("[url]","[<a href=\"",$info);
	$info = str_replace("[/url]","\" target=\"_blank\">www</a>]",$info);
	$info = str_replace("[mail]","[<a href=\"mailto:",$info);
	$info = str_replace("[/mail]","\">email</a>]",$info);
	$info = str_replace("[b]","<b>",$info);
	$info = str_replace("[/b]","</b>",$info);
	$info = str_replace("[u]","<u>",$info);
	$info = str_replace("[/u]","</u>",$info);
	$info = str_replace("[i]","<i>",$info);
	$info = str_replace("[/i]","</i>",$info);
	$info = str_replace("[s]","<s>",$info);
	$info = str_replace("[/s]","</s>",$info);
	$info = str_replace("[tt]","<tt>",$info);
	$info = str_replace("[/tt]","</tt>",$info);
	$info = str_replace("[sup]","<sup>",$info);
	$info = str_replace("[/sup]","</sup>",$info);
	$info = str_replace("[sub]","<sub>",$info);
	$info = str_replace("[/sub]","</sub>",$info);
	$info = str_replace("[br]","<br>",$info);
	$info = str_replace("[center]","<center>",$info);
	$info = str_replace("[/center]","</center>",$info);
	$info = str_replace("[right]","<p aligh=\"right\">",$info);
	$info = str_replace("[/right]","</p>",$info);
	$info = str_replace("[left]","<p aligh=\"left\">",$info);
	$info = str_replace("[/left]","</p>",$info);
	$info = str_replace("[ul]","<ul>",$info);
	$info = str_replace("[/ul]","</ul>",$info);
	$info = str_replace("[ol]","<ol>",$info);
	$info = str_replace("[/ol]","</ol>",$info);
	$info = str_replace("[li]","<li>",$info);
	$info = str_replace("[/li]","</li>",$info);
	$info = str_replace("[move left]","<MARQUEE DIRECTION=\"LEFT\">",$info);
	$info = str_replace("[move right]","<MARQUEE DIRECTION=\"RIGHT\">",$info);
	$info = str_replace("[move slide]","<MARQUEE BEHAVIOR=\"SLIDE\">",$info);	
	$info = str_replace("[move alternate]","<MARQUEE BEHAVIOR=\"ALTERNATE\">",$info);	
	$info = str_replace("[move up]","<MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\">",$info);
	$info = str_replace("[move down]","<MARQUEE scrollAmount=\"1\" direction=\"down\" scrolldelay=\"25\" height=\"8\">",$info);
	$info = str_replace("[mark]","<span style=\"background-color:yellow;color:black\">",$info);	
	$info = str_replace("[/mark]","</span>",$info);		
	$info = str_replace("[glow]","<SPAN style=\"filter:glow(color=#FF3F0F); height:2\">",$info);	
	$info = str_replace("[/glow]","</span>",$info);	
	$info = str_replace("[fly left]","<MARQUEE DIRECTION=\"LEFT\"><MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\">",$info);	
	$info = str_replace("[fly right]","<MARQUEE DIRECTION=\"RIGHT\"><MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\">",$info);	
	$info = str_replace("[fly up]","<MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\"><MARQUEE BEHAVIOR=\"ALTERNATE\">",$info);	
	$info = str_replace("[fly down]","<MARQUEE scrollAmount=\"1\" direction=\"down\" scrolldelay=\"25\" height=\"8\"><MARQUEE BEHAVIOR=\"ALTERNATE\">",$info);		
	$info = str_replace("[/fly]","</MARQUEE></MARQUEE>",$info);
	$info = str_replace("[blink]","<BLINK>",$info);
	$info = str_replace("[/blink]","</BLINK>",$info);
    $info = str_replace("[/move]","</MARQUEE>",$info);
	$info = str_replace("[tr]","<tr>",$info);
	$info = str_replace("[/tr]","</tr>",$info);
	$info = str_replace("[td]","<td>",$info);
	$info = str_replace("[/td]","</td>",$info);
	$info = str_replace("[table]","<table>",$info);
	$info = str_replace("[/table]","</table>",$info);
	// Start swear word filter
	$info = str_replace("fuck","<b>MESSAGE BLOCKED</b>",$info);
	$info = str_replace("shit","<b>MESSAGE BLOCKED</b>",$info);
	$info = str_replace("bitch","<b>MESSAGE BLOCKED</b>",$info);
	$info = str_replace("slut","<b>MESSAGE BLOCKED</b>",$info);
	$info = str_replace("asshole","<b>MESSAGE BLOCKED</b>",$info);
	$info = str_replace("faggot","<b>MESSAGE BLOCKED</b>",$info);
	$info = str_replace("fagget","<b>MESSAGE BLOCKED</b>",$info);
	// Start miscellaneous stripslashes
	$info = stripslashes($info);
	$name = stripslashes($name);
	$name_link = stripslashes($name_link);
	
// Start add content
$date = date("G:i", time());

$date_array = explode("-", $date);

$new = $date_array[0] + $time_a;

$daten = date(" m/d @ $new:i ", time());

print "<meta http-equiv=\"refresh\" content=\"$refresh; URL=$location/sboard.php\">";

$fp = fopen ($file, "r+") or die ("error when opening $file");
flock($fp,2);
$old=fread($fp, filesize($file));
rewind($fp);
fwrite ($fp, "<b>$name_link</b>, on $daten<br>$info \n".$old);
flock($fp,3);
fclose ($fp);

}

// Start view all
} elseif ($sact==all) {

print "<html><head>
<title>$title</title>
<link rel='stylesheet' href='style.css' type='text/css'></head>
<body bgcolor=\"$bgcolor\" text=\"$text\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style=\"margin: 0pt;\">
<!-- Jive Networks Company: www.jivenetworks.com -->";

$file = "data.dat";
$fp = fopen ($file, "r") or die ("error when reading $file");
while ( !feof ($fp) ) {
$line = fgets ($fp, 9216);
print "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
        <tr> 
          <td bgcolor=\"$table1\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$line</font></td>
        </tr></table>";

}

print "<br><div align=\"center\"><font face=\"Verdana\" color=\"$text\" size=\"1\">[ <a href=\"javascript:self.close()\">close</a> ]</div></font>
<!-- Jive Networks Company: www.jivenetworks.com -->
</body></html>";

// Start editor view
} elseif ($sact=="editor") {

print "<html><head>
<title>$title</title>
<link rel='stylesheet' href='style.css' type='text/css'>
<script type=\"text/javascript\" src=\"editor.js\"></script>
</head>
<body bgcolor=\"$bgcolor\" text=\"$text\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style=\"margin: 0pt;\">
<!-- Jive Networks Company: www.jivenetworks.com -->";

print "<form action=\"$location/sboard.php?sact=add\" method=\"post\" name=\"editor\">
<table bgcolor=\"#FFFFFF\" width=\"500\"><tr><td align=\"center\" style=\"padding: 10px;\">
<b>Name:</b> <input type=\"text\" name=\"name\" value=\"$name2\" onfocus=\"this.value=''\" size=\"30\"><br>
<b>$field2name:</b> <input type=\"text\" name=\"site\" value=\"$site2\" size=\"30\"><br>
<textarea name=\"info\" rows=\"8\" cols=\"50\" wrap=\"physical\"></textarea>
</td></tr></table>
<table bgcolor=\"#F7F3EF\" width=\"500\"><tr><td align=\"center\" style=\"padding: 10px;\">
<a href=\"#\" onClick=\"bold()\"><img src=\"$location/images/bold.gif\" alt=\"Bold\" border=\"0\"></a>
<a href=\"#\" onClick=\"italic()\"><img src=\"$location/images/italic.gif\" alt=\"Italicize\" border=\"0\"></a>
<a href=\"#\" onClick=\"underline()\"><img src=\"$location/images/underline.gif\" alt=\"Underline\" border=\"0\"></a>
<a href=\"#\" onClick=\"strike()\"><img src=\"$location/images/strikethrough.gif\" alt=\"Strike Through\" border=\"0\"></a>
<a href=\"#\" onClick=\"sub()\"><img src=\"$location/images/sub.gif\" alt=\"Subscript\" border=\"0\"></a>
<a href=\"#\" onClick=\"sup()\"><img src=\"$location/images/sup.gif\" alt=\"Superscript\" border=\"0\"></a>
<a href=\"#\" onClick=\"hbar()\"><img src=\"$location/images/hr.gif\" alt=\"Horizontal Ruler\" border=\"0\"></a>
<a href=\"#\" onClick=\"linkopen()\"><img src=\"$location/images/link.gif\" alt=\"Insert Link\" border=\"0\"></a>
<a href=\"#\" onClick=\"maillink()\"><img src=\"$location/images/mail.gif\" alt=\"Insert E-mail\" border=\"0\"></a>
<a href=\"#\" onClick=\"left()\"><img src=\"$location/images/left.gif\" alt=\"Left Align\" border=\"0\"></a>
<a href=\"#\" onClick=\"center()\"><img src=\"$location/images/center.gif\" alt=\"Center\" border=\"0\"></a>
<a href=\"#\" onClick=\"right()\"><img src=\"$location/images/right.gif\" alt=\"Right Align\" border=\"0\"></a>
<a href=\"#\" onClick=\"ul()\"><img src=\"$location/images/bullist.gif\" alt=\"Bullet Listing\" border=\"0\"></a>
<a href=\"#\" onClick=\"ol()\"><img src=\"$location/images/numlist.gif\" alt=\"Number Listing\" border=\"0\"></a>
<a href=\"#\" onClick=\"table()\"><img src=\"$location/images/table.gif\" alt=\"Table\" border=\"0\"></a>
<br>
<a href=\"#\" onClick=\"biggrin()\"><img src=\"$location/smilies/biggrin.gif\" alt=\"Big Grin Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"smile()\"><img src=\"$location/smilies/smile.gif\" alt=\"Smile Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"sad()\"><img src=\"$location/smilies/sad.gif\" alt=\"Sad Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"cool()\"><img src=\"$location/smilies/cool.gif\" alt=\"Cool Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"mad()\"><img src=\"$location/smilies/mad.gif\" alt=\"Mad Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"wink()\"><img src=\"$location/smilies/wink.gif\" alt=\"Wink Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"confused()\"><img src=\"$location/smilies/confused.gif\" alt=\"Confused Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"amazed()\"><img src=\"$location/smilies/amazed.gif\" alt=\"Amazed Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"notrust()\"><img src=\"$location/smilies/notrust.gif\" alt=\"No Trust Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"noworry()\"><img src=\"$location/smilies/noworry.gif\" alt=\"No Worry Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"nuts()\"><img src=\"$location/smilies/nuts.gif\" alt=\"Nuts Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"oh()\"><img src=\"$location/smilies/oh.gif\" alt=\"Oh Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"rolleyes()\"><img src=\"$location/smilies/rolleyes.gif\" alt=\"Rolleyes Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"cry()\"><img src=\"$location/smilies/cry.gif\" alt=\"Cry Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"sick()\"><img src=\"$location/smilies/sick.gif\" alt=\"Sick Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"suspicious()\"><img src=\"$location/smilies/suspicious.gif\" alt=\"Suspicious Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"tongue()\"><img src=\"$location/smilies/tongue.gif\" alt=\"Tongue Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"unsure()\"><img src=\"$location/smilies/unsure.gif\" alt=\"Unsure Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"wacko()\"><img src=\"$location/smilies/wacko.gif\" alt=\"Wacko Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"weird()\"><img src=\"$location/smilies/weird.gif\" alt=\"Weird Smilie\" border=\"0\"></a>
<a href=\"#\" onClick=\"worried()\"><img src=\"$location/smilies/worried.gif\" alt=\"Worried Smilie\" border=\"0\"></a>
</td><td width=\"10\">&nbsp;</td><td align=\"right\"><input type=\"submit\" name=\"Submit\" value=\"shout\" class=\"SB_button\">
</td></tr></table>
</form>
";
print "<!-- Jive Networks Company: www.jivenetworks.com --></body></html>";

// Start printable view
} elseif ($sact=="printable") {

print "<html><head>
<style type=\"text/css\">
<!--
body{background-color:#ffffff;}
h2 {font-size: 20px; color: #333; padding: 10px; }
-->
</style>
<script type=\"text/javascript\">
function printIt()
	{
	if (window.print) 
		{
		setTimeout('window.print();',200);
		}
	else if (user_agent.indexOf(\"mac\") != -1) 
		{
		alert(\"Press 'Cmd+p' on your keyboard to print.\");
		}
	else 
		{
		alert(\"Press 'Ctrl+p' on your keyboard to print.\")
		}
	}
</script>
<title>$title</title>
</head>
<body bgcolor=\"$bgcolor\" text=\"$text\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style=\"margin: 0pt;\">
<!-- Jive Networks Company: www.jivenetworks.com -->";
print "<h2>Printable Shoutbox Page</h2><br><div align=\"center\"><font face=\"Verdana\" color=\"$text\" size=\"1\">[ <a href=\"javascript:void(printIt());\">Print Page</a> ]</div></font><br>";
print "<noscript><h2>Printable Shoutbox Page</h2><br><div align=\"center\"><font face=\"Verdana\" color=\"$text\" size=\"1\">[ PC: Ctrl + P / MAC: Cmd + P ]</div></font><br></noscript>";
$file = "data.dat";
$fp = fopen ($file, "r") or die ("error when reading $file");
while ( !feof ($fp) ) {
$line = fgets ($fp, 9216);
print "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
        <tr> 
          <td bgcolor=\"$table1\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$line</font></td>
        </tr></table>";

}

print "<br><div align=\"center\"><font face=\"Verdana\" color=\"$text\" size=\"1\">[ <a href=\"javascript:void(printIt());\">Print Page</a> ]</div></font></body></html>";
print "<noscript><br><div align=\"center\"><font face=\"Verdana\" color=\"$text\" size=\"1\">[ PC: Ctrl + P / MAC: Cmd + P ]</div></font></noscript><!-- Jive Networks Company: www.jivenetworks.com --></body></html>";

// Start end user shoutbox help file
} elseif ($sact == "help") {

print "<html>
<head>
<title>$title</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel='stylesheet' href='style.css' type='text/css'></head>
<body bgcolor=\"$bgcolor\"  text=\"$text\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style=\"margin: 0pt;\">
<!-- Jive Networks Company: www.jivenetworks.com -->
<table style=\"margin-left: 10px;margin-right: 10px;\"><tr><td>
<B>What is a Shoutbox?</B><BR>
A shoutbox is a mini message board system, that website owners can put on their website and recieve comments.
<P><B>Available Emoticons & BBCode</B><BR>
The following is a list of available smilies and bbcodes. This will allow you to add special effects to each shout.
<BR>
<TABLE cellspacing=\"0\" cellpadding=\"2\" border=\"0\" class=\"SB_shoutbox\">
 <TR>
  <TD><B>BBCodes</B></TD>
  <TD><B>Result</B></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">:)</TD>
  <TD align=\"left\"><img src='smilies/smile.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">:(</TD>
  <TD align=\"left\"><img src='smilies/sad.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">:P</TD>
  <TD align=\"left\"><img src='smilies/tongue.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">:D</TD>
  <TD align=\"left\"><img src='smilies/biggrin.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">8)</TD>
  <TD align=\"left\"><img src='smilies/cool.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">:@</TD>
  <TD align=\"left\"><img src='smilies/mad.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">;)</TD>
  <TD align=\"left\"><img src='smilies/wink.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">???</TD>
  <TD align=\"left\"><img src='smilies/confused.gif'></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[url]http://www.domain.com[/url]</TD>
  <TD align=\"left\"><A target=\"_blank\" href=\"http://www.domain.com\">www</A></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[mail]you@domain.com[/mail]</TD>
  <TD align=\"left\"><A href=\"mailto:you@domain.com\">email</A></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[b]Text[/b]</TD>
  <TD align=\"left\"><B>Text</B></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[i]Text[/i]</TD>
  <TD align=\"left\"><I>Text</I></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[u]Text[/u]</TD>
  <TD align=\"left\"><U>Text</U></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[s]Text[/s]</TD>
  <TD align=\"left\"><s>Text</s></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[tt]Text[/tt]</TD>
  <TD align=\"left\"><tt>Text</tt></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">Te[sup]xt[/sup]</TD>
  <TD align=\"left\">Te<sup>xt</sup></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">Te[sub]xt[/sub]</TD>
  <TD align=\"left\">Te<sub>xt</sub></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[nl]</TD>
  <TD align=\"left\">Page break</TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[move left]Text[/move]</TD>
  <TD align=\"left\"><MARQUEE DIRECTION=\"LEFT\">Text</MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[move right]Text[/move]</TD>
  <TD align=\"left\"><MARQUEE DIRECTION=\"RIGHT\">Text</MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[move slide]Text[/move]</TD>
  <TD align=\"left\"><MARQUEE BEHAVIOR=\"SLIDE\">Text</MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[move alternate]Text[/move]</TD>
  <TD align=\"left\"><MARQUEE BEHAVIOR=\"ALTERNATE\">Text</MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[move up]Text[/move]</TD>
  <TD align=\"left\"><MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\">Text</MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[move down]Text[/move]</TD>
  <TD align=\"left\"><MARQUEE scrollAmount=\"1\" direction=\"down\" scrolldelay=\"25\" height=\"8\">Text</MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[mark]Text[/mark]</TD>
  <TD align=\"left\"><span style=\"background-color:yellow;color:black\">Text</span></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[glow]Text[/glow]</TD>
  <TD align=\"left\"><SPAN style=\"filter:glow(color=#FF3F0F); height:2\">Text</SPAN></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[fly left]Text[/fly]</TD>
  <TD align=\"left\"><MARQUEE DIRECTION=\"LEFT\"><MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\">Text</MARQUEE></MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[fly right]Text[/fly]</TD>
  <TD align=\"left\"><MARQUEE DIRECTION=\"RIGHT\"><MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\">Text</MARQUEE></MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[fly up]Text[/fly]</TD>
  <TD align=\"left\"><MARQUEE scrollAmount=\"1\" direction=\"up\" scrolldelay=\"25\" height=\"8\"><MARQUEE BEHAVIOR=\"ALTERNATE\">Text</MARQUEE></MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[fly down]Text[/fly]</TD>
  <TD align=\"left\"><MARQUEE scrollAmount=\"1\" direction=\"down\" scrolldelay=\"25\" height=\"8\"><MARQUEE BEHAVIOR=\"ALTERNATE\">Text</MARQUEE></MARQUEE></TD>
 </TR>
 <TR valign=\"bottom\">
  <TD align=\"left\">[blink]Text[/blink]</TD>
  <TD align=\"left\"><BLINK>Text</BLINK></TD>
 </TR>
</TABLE>
<BR>
<!-- Jive Networks Company: You may not change, alter or change this link --><B>Where can I get my own Shoutbox?</B><BR>
You can get your own Shoutbox from <A href=\"http://www.jivenetworks.com\" target=\"_blank\">Jive Networks Company</A>!<!-- Jive Networks Company: You may not change, alter or change this link -->
<BR><BR>
</td></tr></table>
<!-- Jive Networks Company: www.jivenetworks.com -->
</body>
</html>";

// Start end user shoutbox administration
} elseif ($sact == "admin") {


print "<html>
<head>
<title>$title</title>
<script type=\"text/javascript\">

function openScript(url, width, height) {
        var Win = window.open(url,\"openScript\",'width=' + width + ',height=' + height + ',resizable=no,scrollbars=yes,menubar=no,status=no' );
}

</script>

<link rel='stylesheet' href='style.css' type='text/css'>

</head>
<body bgcolor=\"$bgcolor\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style=\"margin: 0pt;\" scroll=\"$scroll\" text=\"$text\">
<!-- Jive Networks Company: www.jivenetworks.com -->
<font face=\"Verdana\" color=\"#000000\" size=\"1\">";
print "<br><center><h3>Administration Panel</h3></center>
<table width=\"760\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"><tr>
<td align=\"right\"><font face=\"Verdana\" color=\"#000000\" size=\"1\"><a href=\"$location/sboard.php\" target=\"_blank\">Click Here</a> to view your site's shoutbox.</a></font></td>
</tr></table><table width=\"760\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td bgcolor=\"$table_bdr\"> 
      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
	    <tr bgcolor=\"#666666\"> 
          <td bgcolor=\"#666666\"><font face=\"Verdana\" color=\"#FFFFFF\" size=\"1\"><b>MESSAGE</b></font></td>
		  <td bgcolor=\"#666666\" align=\"center\" width=\"100\"><font face=\"Verdana\" color=\"#FFFFFF\" size=\"1\"><b>SPAM RATE</b></font></td>
		  <td bgcolor=\"#666666\" align=\"center\" width=\"100\"><font face=\"Verdana\" color=\"#FFFFFF\" size=\"1\"><b>DELETE</b></font></td>
        </tr>";

$file = "data.dat";
$fp = fopen ($file, "r") or die ("error when reading $file");
while ( !feof ($fp) ) {
$line = fgets ($fp, 9216);
print "
<tr> 
<td bgcolor=\"$table1\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$line</font></td>
<td bgcolor=\"$table1\" align=\"center\" width=\"100\"></td>
<td bgcolor=\"$table1\" align=\"center\" width=\"100\"><a href=\"$location/sboard.php?sact=admin&delete=true\"><img src=\"$location/images/btn_del.gif\" border=\"0\"></a></td>
</tr>";
}
print "   </table>
    </td>
  </tr>
</table>";
print "</font>";
print "<p align=\"center\"><font face=\"Verdana\" color=\"$text\" size=\"1\">Powered by SimpleShout 1.6.0<br>A software product of <a href=\"http://www.jivenetworks.com\" target=\"_blank\">Jive Networks Company</a></font></p>";


// Start board view
} else {

$file = "data.dat";
$fp = fopen ($file, "r+") or die ("error when reading $file");
$mess = file($file);

if ($name2 == "$name" ) { $name2 = "name"; } 

if ($info2 == "$info" ) { $info2 = "message"; } 

if ($site2 == "$site" ) { $site2 == "$field2"; } 

print "<html>
<head>
<title>$title</title>
<script type=\"text/javascript\">

function openScript(url, width, height) {
        var Win = window.open(url,\"openScript\",'width=' + width + ',height=' + height + ',resizable=no,scrollbars=yes,menubar=no,status=no' );
}

</script>

<link rel='stylesheet' href='style.css' type='text/css'>

</head>
<body bgcolor=\"$bgcolor\" link=\"$link\" alink=\"$alink\" vlink=\"$vlink\" style=\"margin: 0pt;\" scroll=\"$scroll\" text=\"$text\">
<!-- Jive Networks Company: www.jivenetworks.com -->
<font face=\"Verdana\" color=\"#000000\" size=\"1\">";

print "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td bgcolor=\"$table_bdr\"> 
      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
        <tr> 
          <td bgcolor=\"$table1\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$mess[0]</font></td>
        </tr>
        <tr>
          <td bgcolor=\"$table2\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$mess[1]</font></td>
        </tr>
        <tr>
          <td bgcolor=\"$table1\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$mess[2]</font></td>
        </tr>
        <tr>
          <td bgcolor=\"$table2\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$mess[3]</font></td>
        </tr>
        <tr>
          <td bgcolor=\"$table1\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$mess[4]</font></td>
        </tr>
        <tr>
          <td bgcolor=\"$table2\"><font face=\"Verdana\" color=\"$text\" size=\"1\">$mess[5]</font></td>
        </tr>
      </table>
    </td>
  </tr>
</table>";
print "</font>";
print "<div align=\"center\"><form name=\"input\" method=\"post\" action=\"$location/sboard.php?sact=add\">
  <font face=\"Verdana, Arial, Helvetica, sans-serif\"> <font size=\"1\" color=\"$text\"> 
  <input type=\"text\" name=\"name\" value=\"$name2\" onfocus=\"this.value=''\" class=\"SB_input\" size=\"17\"><br>
<input type=\"text\" name=\"site\" value=\"$field2input\" class=\"SB_input\" size=\"17\">
  <br>
  <input type=\"text\" name=\"info\" value=\"$info2\" onfocus=\"this.value=''\" class=\"SB_input\" size=\"17\"><br>
  <input type=\"submit\" name=\"Submit\" value=\"shout\" class=\"SB_button\"> <SPAN class=\"SB_shoutbox\">[ <a href=\"javascript:openScript('$location/sboard.php?sact=all','517','265')\">All</a> - <a href=\"javascript:openScript('$location/sboard.php?sact=editor','517','285')\">Editor</A> -  <a href=\"javascript:openScript('$location/sboard.php?sact=help','517','265')\">Help</a> - <a href=\"$location/sboard.php?sact=printable\">Print</A> ]</SPAN> 
  <noscript><input type=\"submit\" name=\"Submit\" value=\"shout\" class=\"SB_button\"> <SPAN class=\"SB_shoutbox\">[ <a href=\"$location/sboard.php?sact=all\">All</a> - <a href=\"$location/sboard.php?sact=editor\">Editor</A> -  <a href=\"$location/sboard.php?sact=help\">Help</a> - <a href=\"$location/sboard.php?sact=printable\">Print</A> ]</SPAN></noscript>
<br><!-- Jive Networks Company: You may not change, alter or change this link --><a href=\"http://www.jivenetworks.com\" target=\"_blank\">&copy; Jive Networks Company</a><!-- Jive Networks Company: You may not change, alter or change this link -->
<br><font color=\"#FF0000\"><br><b> $message </b></font>
  </font> </font> 
</form>
";

// Start users online
	if(phpversion() < 4.1) {
	 $_SERVER = $HTTP_SERVER_VARS;
	}

	if(!$settings) {
	 include("./config.php");
	}
 $seconds = 60;
 $past = time()-$seconds;
 $now = time();


 $write = "$_SERVER[REMOTE_ADDR]|$_SERVER[HTTP_REFERER]|$now|\n";
 $file = file($datafile);
	for($i=0;$i<count($file);$i++){
	 $userdata = explode("|", $file[$i]);
		if($userdata[2] > $past && $userdata[0] != $_SERVER[REMOTE_ADDR]) {
			 $write .= "$userdata[0]|$userdata[1]|$userdata[2]|\n";
		}
	}
	if($ofile = @fopen($datafile,"w")){
	 @fputs ($ofile, $write);
	 @fclose($ofile);
	} else {
	 echo "document.write('<font color=FF0000>You must CHMOD all .db files to 777!</font>');";
	}
 $count = count(file($datafile));
 $record = file($recordfile);
 $record = explode("``x",$record[0]);
	if($count > $record[0]){
		if($rfile = @fopen($recordfile,w)){
		 $data = $count."``x".time();
		 @fputs ($rfile, $data);
		 @fclose($rfile);
		} else {
		 echo "document.write('<font color=FF0000>You must CHMOD all .db files to 777!</font>');";
		}
	}
	if($count > 1){
	 $visitors = str_replace("<online>","$count",$showonline);
	} else {
	 $visitors = str_replace("<online>","$count",$firstonline);
	}
echo ("$visitors");

print "</div><!-- Jive Networks Company: www.jivenetworks.com --></body></html>";

}

?>