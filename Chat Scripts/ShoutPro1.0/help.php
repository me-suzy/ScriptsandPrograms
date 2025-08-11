<?php
/*
ShoutPro 1.0 - help.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is help.php.  It displays help for users of your shoutbox.

JavaScript functions are defined below.
*/

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("include.php");
?>

<html><head><? 
if($title == "off") { 
	echo "<title>ShoutBox</title>"; 
} else { 
	echo "<title>".$title_viewall."</title>"; 
} ?>

<style type="text/css">
<!--
<?php echo($textboxstyle); ?>
body {font-family: <?php echo($fontface); ?>;}
-->
</style>

<!-- Begin Link Styles -->
<style type="text/css">
 a:link{<?php echo($link_style); ?>}
 a:visited{<?php echo($link_visited_style); ?>}
 a:hover{<?php echo($link_hover_style); ?>}   
 a:active{<?php echo($link_active_style); ?>}
</style>
<!-- End Link Styles -->

<!-- Begin Scrollbar Styles -->
<style>  
<!-- 
<?php
if($scrollbar_styles_on != "off"){
echo("BODY{ scrollbar-face-color:".$scrollbar_face_color."; scrollbar-arrow-color:".$scrollbar_arrow_color."; scrollbar-track-color:".$scrollbar_track_color."; scrollbar-shadow-color:".$scrollbar_shadow_color."; scrollbar-highlight-color:".$scrollbar_highlight_color."; scrollbar-3dlight-color:".$scrollbar_3dlight_color."; scrollbar-darkshadow-Color:".$scrollbar_darkshadow_color."; }");
}
?>
-->   
</style>    
<!-- End Scrollbar Styles -->

<!-- Begin Text Styles -->
<style type="text/css">
td{font-size: <?php echo($textsize); ?>pt; font-family: <?php echo($fontface); ?>;}
</style>
</head>
<?php
echo("<body bgcolor=".$bgcolor." text=".$textcolor." bottommargin=".$bottommargin." topmargin=".$topmargin." leftmargin=".$leftmargin." rightmargin=".$rightmargin.">");
?>

<font style='font-size: <?php echo($textsize); ?>pt' face='<?php echo($fontface); ?>'>

<table width=250 style="font-size: 8pt">
<tr><td colspan=2><b><center style="font-size: 8pt">
        ShoutPro Help 
      </center></b></td></tr>

<tr>
    <td colspan=2 style="font-size: 8pt">HTML is prohibited in this shoutbox. 
      However, you can use ShoutCode to format your text. You use ShoutCode just 
      like you use HTML, except instead of using &lt; and &gt;, 
      you use [ and ]. Here are the ShoutCode tags:</td>
  </tr>

<tr><td>[B]Text[/B]</td><td><b>Text</b></td></tr>
<tr><td>[I]Text[/I]</td><td><i>Text</i></td></tr>
<tr><td>[U]Text[/U]</td><td><u>Text</u></td></tr>
<tr><td>[url]http://www.yahoo.com[/url]</td><td>[<a href=http://www.yahoo.com target=_blank>www</a>]</td></tr>
<tr><td>[mail]joe@yahoo.com[/mail]</td><td>[<a href=mailto:joe@yahoo.com>@</a>]</tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 style="font-size: 8pt">There are also several smilies you can put into your posts.  A list is below.</td></tr>
<?php
//Open the smilies list and output on the table.
$FileName="lists/smilies.php";
$list = file ($FileName);
$numsmilies = count($list);
for($go = "0";$go < $numsmilies; $go++){
	list ($code,$image,) = explode ("|^|", $list[$go]);
		echo ("<tr bgcolor=$bgcolor><td valign=top>$code</td><td><img src='smilies/$image'></td></tr>");
}
echo ("</table>");

/* Start Copyright Text - Do not remove! */
copyrighttext();
/* End Copyright Text - Do not remove! */
?>

