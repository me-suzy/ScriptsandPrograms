<?php

/*
ShoutPro 1.0 - shoutbox.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is shoutbox.php.  It is the main part of ShoutPro.  There is no need to modify anything in this file.  All modifications should be done in the file config.php.

JavaScript functions are defined below.
*/

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("include.php");

//Code for cookies
$act = $_GET['action'];
if ($_POST["name"]!=""){
	$name = $_POST['name'];
} else if ($_GET["name"]!=""){
	$name = $_GET["name"];
}
if ($_POST["shout"]!=""){
	$shout = $_POST['shout'];
} else if ($_GET["shout"]!=""){
	$shout = $_GET["shout"];
}
if($act=="post" && $name && $name!="Name"){
		//Prepare the name
		$shout = trim($shout);
		$shout = stripslashes($shout);
		$shout = str_replace ("\n", " ", $shout);
		$shout = str_replace ("\r", " ", $shout);
		$name = trim($name);
		$name = killhtml(killscript($name));
		restrictedname($name,$shout,$namepass2);
		//Store username in a cookie
		setcookie("shoutpro_username", "", time() - 31536000);
		$cookielife = time() + 31536000;
		setcookie("shoutpro_username", $name, $cookielife);
}
?>


<SCRIPT language=JavaScript> 
var tmron= false;
var timerID;
<?php
if ($refreshmode != "manual"){
	echo("starttmr();");
}
?>
function textboxfocus(whichbox) { 
   if (document.postshout.name.value == "Name" || document.postshout.name.value == "<?php echo($_COOKIE['shoutpro_username']);?>" && whichbox == "name"){ 
      document.postshout.name.value = ""; 
   } 
   if (document.postshout.shout.value == "Shout!" && whichbox == "shout"){ 
      document.postshout.shout.value = ""; 
   } 
   stoptmr(); 
} 

function leavefocus() {
	if (document.postshout.shout.value == ""){
		document.postshout.shout.value == "Shout!";
		<?php
		if ($refreshmode != "manual"){
			echo("starttmr();");
		}
		?>
	}	
}

function stoptmr(){ 
	if(tmron){ 
		clearTimeout(timerID); 
		tmron = false; 
	}
} 

function starttmr(){ 
   stoptmr(); 
   timerID = setTimeout('reload()', <?php echo($refresh); ?>000); 
   tmron = true; 
} 

function reload() { 
   document.location.reload(); 
} 

//Functions for pop-up windows.
function openviewall() {
	window.open('viewall.php','all_shouts','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=<?php echo($width); ?>,height=400');
}
function openhelp() {
	 window.open('help.php','help_window','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=270,height=400')
}
function openuserpanel() {
	 window.open('userpanel/index.php','userpanel','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=400,height=400')
}
	
</SCRIPT>

<html><head><title><?php echo($shoutboxname); ?></title>

<style type="text/css">
<!--
<?php echo($textboxstyle); ?>
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
<?php

//The following code posts a message.
if($act=="post"){
	if (!$name){
		echo("<script>alert(\"".$inputname."\");</script>");
	} else	if (!$shout || $shout=="Shout!"){
		echo("<script>alert(\"".$inputshout."\");</script>");
	} else {
		//Prepare the shout
		$shout = trim($shout);
		$shout = stripslashes($shout);
		$shout = str_replace ("\n", " ", $shout);
		$shout = str_replace ("\r", " ", $shout);
		badname($name);
		$shout = first($shout);
		$name = first($name);
		if(!length($shout,$minlength,$maxlength)){die;} //Check length of shout to min and max lengths
		//Find the date and time
		$date = date("F j, Y");
		$time = date("g:i A");
		//Add the shout to the end of shouts.php
		$FileName="shouts.php";
		if($FilePointer=fopen($FileName, "a+")){
			fwrite($FilePointer,"$name|^|$shout|^|$date|^|$time|^|$_SERVER[REMOTE_ADDR]|^|\n");
			fclose($FilePointer);
		}
	}
	echo("<script>location.href='shoutbox.php';</script>");
}

//Show the shoutbox name if selected
if ($displayname == "yes"){
	echo ("<div align=center><b>$shoutboxname</b></div><br>");
}
//Show the form.
echo("<form name='postshout' method='post' action='shoutbox.php?action=post'>");
if (!$_COOKIE['shoutpro_username']){
	echo("<input class='textbox' name='name' type='text' size='10' value='Name' onFocus=\"textboxfocus('name')\" onBlur=\"leavefocus();\"><br />\n"); 
} else {
	echo("<input class='textbox' name='name' type='text' size='10' value='".$_COOKIE['shoutpro_username']."' onFocus=\"textboxfocus('name')\" onBlur=\"leavefocus();\"><br />\n"); 
}
echo("<textarea class=textbox name='shout' rows='5' cols='15'  onFocus=\"textboxfocus('shout')\" onBlur=\"leavefocus();\">Shout!</textarea><br />\n");
echo("<input class=textbox type='submit' value='Post'>\n");
if ($refreshmode != "auto"){
	echo("<input class=textbox type=button value='Refresh' onClick=\"location.href='shoutbox.php'\">\n");
}
echo("<br />");
$row_count = 0;
//Display shouts
	echo ("<table width=100% cellpadding=0 cellspacing=0>");
	$shouts = file("shouts.php");
	$shouts = array_reverse($shouts);
	$shouts = array_slice($shouts,0,10);
	foreach ($shouts as $item){
		$row_color = ($row_count % 2) ? $row_color1 : $row_color2;
		list ($poster,$message,$date,$time,$ip) = explode ("|^|", $item);
		$thisnamecolor = $namecolor;
		$thisnamecolor = colornames($poster,$thisnamecolor);
		$thisshout = "$poster:$message";
		$wrap = intval(($width+15)/($textsize-2))+1;
		$thisshout = wordwrap($thisshout, $wrap, ' ', 1);
		$newmessage=profanityfilter(shoutcode(smilies(killhtml($message))));		
		$thisshout = str_replace($message,$newmessage,$thisshout);
		$thisshout = "<div title=\"Posted $date @ $time\">".$thisshout."</div>\n";
		$thisshout = str_replace("<script>"," ",$thisshout);
		$thisshout = str_replace("</script>"," ",$thisshout);
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


echo("<br /><a href=\"javascript:openviewall()\">View All</a>::<a href=\"javascript:openhelp()\">Help</a>");

if($userpanelon == "yes"){
	echo("<br /><a href=\"javascript:openuserpanel()\">User Panel</a>");
}

/* Start Copyright Text - Do not remove! */
copyrighttext();
/* End Copyright Text - Do not remove! */

?>