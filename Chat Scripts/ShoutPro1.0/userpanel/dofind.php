<?php
/*
ShoutPro 1.0 - User Panel - dofind.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is dofind.php.  It is part of the User Panel addon to ShoutPro.  There is no need to modify anything in this file.  All modifications should be done in the file upconfig.php.
*/

//upconfig.php is essential for using this addon script.
require("upconfig.php");

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("$path/include.php");

if ($userpanelon != "yes"){
	die ("Sorry the user panel has not been enabled in config.php");
}
?>


<html><head><title>Find your Password</title>

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

if(!$_POST["name"]){
	echo ("Sorry, you must fill out all fields.");
} else {
	$FileName=$path."/lists/names.php";
	$list = file ($FileName);
	$numnames = count($list);
	for($x=0;$x<=$numnames;$x++){
		$value = $list[$x];
		list ($restrictedname,$namepass,$nameemail) = explode ("|^|", $value);
		if ($_POST["name"] == $restrictedname){
			$rname = 1;
			$thepass = $namepass;
			$email = $nameemail;
			$line = $x;
		}
	}	
		

	if ($rname == 1){
		$list[$line] = $_POST["name"]."|^|".$_POST["newpass1"]."|^|".$email."|^|";
		echo ("Password sent.");
		mail($email,"Shoutbox Username and Password","This e-mail is being sent from $sitename.  You indicated that you would like your username and password for our shoutbox sent to you.  Your username and password for $siteurl are ".$_POST["name"]." and ".$thepass.".  Please keep this e-mail for your reference.","From: $siteemail");


	} else if ($rname == 0) {
		echo ("That name doesn't appear to be registered yet.");
	} else {
		echo ("Sorry, the old password you entered doesn't match the current one for that username.");
	}
}
?>
<p><a href="index.php">User Panel Home</a>::<a href="javascript:window.close()">Close Window</a>