<?php

/*
ShoutPro 1.0 - User Panel - register.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is register.php.  It is part of the User Panel addon to ShoutPro.  There is no need to modify anything in this file.  All modifications should be done in the file upconfig.php.
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
You are about to register a username.  Registering a username will allow you to add a password to it and prevent others from using it.  Your e-mail will be used to retrieve and change your password.<p>
<form name="register" action="doregister.php" method="POST">
<?php
if (!$_COOKIE['shoutpro_username']){
	echo("Name to Register: <input class='textbox' name='name' type='text' size='10' value=''><br />\n"); 
} else {
	echo("Name to Register: <input class='textbox' name='name' type='text' size='10' value='".$_COOKIE['shoutpro_username']."'><br />\n"); 
	}
?>
Password: <input class='textbox' type="password" name="enterpass"><br />
Confirm: <input class='textbox' type="password" name="confpass"><br />
Email: <input class='textbox' type="text" name="enteremail"><br />
Confirm: <input class='textbox' type="text" name="confemail"><br />
<input class='textbox' type='submit' value='Register'>
</form>
<p><a href="index.php">User Panel Home</a>::<a href="javascript:window.close()">Close Window</a>