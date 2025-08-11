<?php
/*
ShoutPro 1.0 - config.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is config.php.  Edit all the variables to customize ShoutPro.
*/

$shoutboxname = "TestBox"; //The name of your shoutbox.  Displayed in the title of the page and at the top if $displayname is set to "yes"
$displayname = "yes"; //Display $shoutboxname at the top of shoutbox.php and viewall.php?  Set to "yes" or "no".

$siteemail = "email@domain.com"; //Your admin e-mail address.
$userpanelon = "yes"; //If you are using the User Panel addon script, set this to "yes".
$refreshmode = "both"; //If set to "auto" ShoutPro will automatically refresh every $refresh (another variable you can set in this file) seconds.  If set to "manual" a link will be displayed to manually refresh the shoutbox.  Set to "both" if you want automatic refreshing along with a button to refresh manually.  If something other than those values is entered, ShoutPro will automatically go with the "both" option.
$bannedmessage = "Sorry you've been banned from this shoutbox."; //This message will be displayed when someone tries to use the shoutbox under a banned IP.  (Banned IPs are in the file lists/bannedips.php.)


$sitename = "SiteName"; //The name of your site
$siteurl = "http://www.yoursite.com"; //The url of the site where this shoutbox is located.

$thepassword = "changeme"; //IMPORTANT!  Change this file to your password.  Otherwise anyone will be able to clear your shoutbox.

$textboxstyle = ".textbox {font-family: tahoma; font-size: 10pt; border: 1px solid #0000AA; background-color: #00427B; color:#DDDDCC}"; //CSS code for the textbox style.  If you want a default style textbox then make this variable empty.

$row_coloring = "on"; // Turns the alternating row colors on must be set to "on" for it to work. DEFAULT: "on".
$row_color1 = "#336699"; // Row 1 Color, so rows 1,3,5 etc will be this color all odd numbers. DEFAULT: "#336699".
$row_color2 = "#00538C"; // Row 2 Color, so rows 2,4,6 etc will be this color all even numbers. DEFAULT: "#00538C".
$badnamemessage = "Sorry, that name is banned from this shoutbox."; // Message to display if the name of the poster is in the .
$minlength = "10"; //The minimum length of a shout.  Shouts shorter than this will generate an error.  Set to "1" to disable.
$maxlength = "100"; //The maximum length of a shout.  Shouts longer than this will generate an error.  Set to "0" to disable.

//Scrollbar styles - All of these variables have the same name as the CSS scrollbar setting except that the dashes have been replaced with underscores.
$scrollbar_face_color = "#0075AE";
$scrollbar_arrow_color = "#00538C";
$scrollbar_track_color = "#00427B";
$scrollbar_shadow_color = "#00427B";
$scrollbar_highlight_color = "#00427B";
$scrollbar_3dlight_color = "#00427B";
$scrollbar_darkshadow_color = "#00427B";

$link_style = "color: #999999;text-decoration: none;font-weight: bold;";
$link_visited_style = "color: #999999;text-decoration: none;font-weight: bold;";
$link_hover_style = "color: #999999;text-decoration: underline;font-weight: bold;";
$link_active_style = "color: #999999;text-decoration: none;font-weight: bold;";

$scrollbar_styles_on = "on"; //This variable sets the scrollbar CSS styles on or off.  Everything other than "off" (case sensitive) will put the styles on.

$refresh = "30"; //The number of seconds between each automatic refresh of the shoutbox.  Default is 30.
$fontface = "Tahoma"; //The font used in the shoutbox.  Default is Tahoma.
$textcolor = "#DDDDCC"; //The main text color.  Default is #DDDDCC.
$bgcolor = "#00538C"; //The background color of the shoutbox.  Default is #333333.
$textsize = "10"; //The text size in points.  Default is 10.

//Textmargins -- Make sure you leave $leftmargin and $rightmargin at 0 or there may be a horizontal scrollbar in your shoutbox.
$topmargin = "2";
$bottommargin = "2";
$leftmargin = "0";
$rightmargin = "0";

$inputshout = "Sorry, you have to input a shout."; //This message is shown if the user does not input a shout.  Default is "Sorry, you have to input a shout."
$inputname = "You have a name, don't you?  Please enter one."; //This message is shown in the user does not input a name.  Default is "You have a name, don't you?  Please enter one."

$namecolor = "#FF0000"; //The color users' names appear in.  Default is #FF0000.

$width = "192"; //The width of the shoutbox.  This needs to be the same as the width of the IFRAME.
?>