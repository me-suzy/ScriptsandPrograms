<?php

/*
ShoutPro 1.0 - User Panel - index.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is index.php.  It is part of the User Panel addon to ShoutPro.  There is no need to modify anything in this file.  All modifications should be done in the file upconfig.php.
*/

//upconfig.php is essential for using this addon script.
require("upconfig.php");

//include.php calls default ShoutPro functions and settings into effect.  ShoutPro cannot run without it.
require("$path/include.php");

if ($userpanelon != "yes"){
	die ("Sorry the user panel has not been enabled in config.php");
}
?>


<html><head><title><?php echo("$sitename Shoutbox User Panel"); ?></title>

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
Welcome to the user panel for <?php echo($sitename); ?>'s shoutbox.  Please follow the links below to your desired location. <p>
<a href="register.php">Register a Name</a><br />
<a href="changepass.php">Change your Password</a><br />
<a href="findpass.php">Look up your Password</a>
<p><a href="javascript:window.close()">Close Window</a>