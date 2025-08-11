<?php

/*
ShoutPro 1.0 BETA 3- viewall.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is viewall.php.  This file shows older shouts.  There is no need to modify anything in this file.  All modifications should be done in the file config.php.
*/

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("include.php");
?>
<html><head><title><?php echo($shoutboxname); ?></title>
<?php 
if ($refreshmode != "manual"){
	echo("<META HTTP-EQUIV='refresh' content='".$refresh.";URL=viewall.php?start=$start'>"); 
}
?>

<!-- Begin Link Styles -->
<style type="text/css">
 a:link{<?php echo($link_style); ?>}
 a:visited{<?php echo($link_visited_style); ?>}
 a:hover{<?php echo($link_hover_style); ?>}   
 a:active{<?php echo($link_active_style); ?>}
</style>
<!-- End Link Styles -->

<style type="text/css">
<!--
<?php echo($textboxstyle); ?>
-->
</style>

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
<?php
$shouts = file("shouts.php");
$shouts = array_reverse($shouts);
/*

This code is for page splitting which is not used in BETA 4.  Uncommenting it may cause bugs.

$numshouts = count($shouts);
$numpages = $numshouts/10;
$rnumpages = round($numpages,"0");
if ($numpages > $rnumpages){
	$rnumpages++;
	$numpages = $rnumpages;
}

echo ("<form name='changepage'><select class='textbox' name='pageselect' onChange=\"location=document.changepage.pageselect.options[document.changepage.pageselect.selectedIndex].value;\" value='Select a Page'>");

for ($p = 0; $p < $numpages; $p++){
	$p2 = $p * 10;
	$p3 = $p + 1;
	if ($start == $p2){
		echo("<option selected value=\"viewall.php?start=".$p2."\">Page ".$p3."</option>\n");
	} else {
		echo("<option value=\"viewall.php?start=".$p2."\">Page ".$p3."</option>\n");
	}
	if ($p < $numpages-1){
		echo(", ");
	}
}
echo("</select></form>");
$shouts = array_slice ($shouts, $start, $start+10);
*/

$row_count = 0;
//Display shouts
	echo ("<table width=100% cellpadding=0 cellspacing=0>");
	foreach ($shouts as $item){
		list ($poster,$message,$date,$time,$ip) = explode ("|^|", $item);
		$row_color = ($row_count % 2) ? $row_color1 : $row_color2;
		$thisnamecolor = $namecolor;
		$thisnamecolor = colornames($poster,$thisnamecolor);
		$thisshout = "$poster:$message";
		$wrap = intval(($width+15)/($textsize-2))+1;
		$thisshout = wordwrap($thisshout, $wrap, ' ', 1);
		$newmessage=profanityfilter(shoutcode(smilies(killhtml($message))));
		$thisshout = str_replace($message,$newmessage,$thisshout);
		$thisshout = "<div title=\"Posted $date @ $time\">".$thisshout."</div>\n";
		$thisshout = str_replace($poster.":","<font color=".$thisnamecolor.">$poster:</font> ",$thisshout);
		if($row_coloring==on){
		$thisshout = "<tr bgcolor='$row_color'><td>".$thisshout."</td></tr>";
		} else {
		$thisshout = "<tr><td>".$thisshout."</td></tr>";
		}
		echo ($thisshout);
		$row_count++;
	}
	echo ("</table>");
	
echo ("	<a href='javascript:window.close()'>Close Window</a>
		</body></html>
		");
	
/* Start Copyright Text - Do not remove! */
copyrighttext();
/* End Copyright Text - Do not remove! */
?>
