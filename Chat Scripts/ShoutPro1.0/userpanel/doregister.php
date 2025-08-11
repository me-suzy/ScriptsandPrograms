<?php
/*
ShoutPro 1.0 - User Panel - doregister.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is doregister.php.  It is part of the User Panel addon to ShoutPro.  There is no need to modify anything in this file.  All modifications should be done in the file upconfig.php.
*/

//upconfig.php is essential for using this addon script.
require("upconfig.php");

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("$path/include.php");

if ($userpanelon != "yes"){
	die ("Sorry the user panel has not been enabled in config.php");
}
?>


<html><head><title>Register your Name</title>

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

</head>
<?php
echo("<body bgcolor=".$bgcolor." text=".$textcolor." bottommargin=".$bottommargin." topmargin=".$topmargin." leftmargin=".$leftmargin." rightmargin=".$rightmargin.">");
?>

<font style='font-size: <?php echo($textsize); ?>pt' face='<?php echo($fontface); ?>'>

<?php

if(!$_POST["name"] || !$_POST["enterpass"] || !$_POST["confpass"] || !$_POST["enteremail"] || !$_POST["confemail"]){
	echo ("Sorry, you must fill out all fields.");
} else if($_POST["enterpass"] != $_POST["confpass"]){
	echo ("Both passwords don't match.  Please try again.");
} else if($_POST["enteremail"] != $_POST["confemail"]){
	echo ("Both emails don't match.  Please try again.");
} else if($check1 = thecheck($_POST["name"]) || $check2 = thecheck($_POST["enterpass"]) || $check3 = thecheck($_POST["enteremail"])){
	echo ("It looks like you've used the string\"|^|\" in your username, password, or e-mail.  You can't do that.  Sorry.");
} else {
	$FileName=$path."/lists/names.php";
	$list = file ($FileName);
	foreach ($list as $value) {
		list ($restrictedname,$namepass,$nameemail) = explode ("|^|", $value);
		if ($_POST["name"] == $restrictedname){
				$rname=1;
		}
	}
	if ($rname == 1){
		echo ("Sorry, that name has already been taken.");
	} else {
		$FileName = $path."/lists/names.php";
		$list = file($FileName);
		$newitem = $_POST["name"]."|^|".$_POST["enterpass"]."|^|".$_POST["enteremail"]."|^|";
		$FilePointer = fopen($FileName, "a+");
		fwrite($FilePointer, "\n".$newitem);
		fclose($FilePointer);
		echo ("Name added.");
		mail($enteremail,"Shoutbox Username and Password","This e-mail is being sent from the shoutbox you registered at.  Your username and password for http://www.shoutpro.com are ".$_POST["name"]." and ".$_POST["enterpass"].".  Please keep this e-mail for your reference.","From: shoutpro@shoutpro.com");
	}
}
?>
<p><a href="index.php">User Panel Home</a>::<a href="javascript:window.close()">Close Window</a>