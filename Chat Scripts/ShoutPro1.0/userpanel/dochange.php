<?php
/*
ShoutPro 1.0 - User Panel - dochange.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is dochange.php.  It is part of the User Panel addon to ShoutPro.  There is no need to modify anything in this file.  All modifications should be done in the file upconfig.php.
*/

//upconfig.php is essential for using this addon script.
require("upconfig.php");

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("$path/include.php");

if ($userpanelon != "yes"){
	die ("Sorry the user panel has not been enabled in config.php");
}
?>


<html><head><title>Change your Password</title>

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

if(!$_POST["name"] || !$_POST["oldpass"] || !$_POST["newpass1"] || !$_POST["newpass2"]){
	echo ("Sorry, you must fill out all fields.");
} else if($_POST["newpass1"] != $_POST["newpass2"]){
	echo ("Both new passwords don't match.  Please try again.");
} else if($check1 = thecheck($_POST["newpass1"])){
	echo ("It looks like you've used the string\"|^|\" in your new password.  You can't do that.  Sorry.");
} else {
	$FileName=$path."/lists/names.php";
	$list = file ($FileName);
	$numnames = count($list);
	for($x=0;$x<=$numnames;$x++){
		$value = $list[$x];
		list ($restrictedname,$namepass,$nameemail) = explode ("|^|", $value);
		if ($_POST["name"] == $restrictedname){
			$rname = 1;
			$email = $nameemail;
			$line = $x;
		}
		if ($_POST["oldpass"] == $namepass){
			$rpass = 1;
		}
		if ($rname == 1 && $rpass == 1){
			$rgo = 1;
		}
	}	
		
//	foreach ($list as $value) {

//	}
	if ($rgo == 1){
		$FileName = $path."/lists/names.php";
		$list = file($FileName);
		$list[$line] = $_POST["name"]."|^|".$_POST["newpass1"]."|^|".$email."|^|";
		$FileName = $path."/lists/newnames.php";
		$FilePointer = fopen($FileName, "w+");
		for ($x=0;$x<=$numnames;$x++){
			fwrite($FilePointer,$list[$x]."\n");
		}
		fclose ($FilePointer);
		unlink($path."/lists/names.php");
		rename($path."/lists/newnames.php",$path."/lists/names.php");
		echo ("Password changed.");
		mail($email,"Shoutbox Username and Password","This e-mail is being sent from the shoutbox you registered at.  Your password has been changed.  Your username and password for http://www.shoutpro.com are now ".$_POST["name"]." and ".$_POST["newpass1"].".  Please keep this e-mail for your reference.","From: shoutpro@shoutpro.com");


	} else if ($rname == 0) {
		echo ("That name doesn't appear to be registered yet.");
	} else {
		echo ("Sorry, the old password you entered doesn't match the current one for that username.");
	}
}
?>
<p><a href="index.php">User Panel Home</a>::<a href="javascript:window.close()">Close Window</a>