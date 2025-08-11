<?php

// ######################################
// ####     Shout  Version 3.0         ##
// ####    By:  HockeyGod, GrafxGuye   ##
// ####    and Two4Roughing            ##
// ####   http://www.cheesehole.net    ##
// ######################################

// You may freely distribute this script as long as you do not make any
// changes to the original code and this disclaimer stays intact.  
// This script copyright 2002 cheesehole.net 

// ################  Edit Variables     ######################

$datfile = "shout.txt";
// This is the name of text file where all 
// the text is stored.

// Simply include this file where yo want
// the text to appear in your page.
/* example:  include("shout.txt")  */
// see test.php and the readme for further help.


$MAX_LENGTH = 35;
// This is the max length of the user's entry.  you should
// also make your input box's maxlength the same number or smaller
//  Basically this is just for error checking and to make sure
// the script was called from the page, not by itself.


$NUM_COMMENTS = 10;
// Make this bigger to show more  or smaller to show less.

/* NOTE:  There is no max length for the NAME, if you so desire one, 
simply limit the amount of characters that one can enter in the field. */

// #############  DO NOT EDIT BELOW THIS LINE  ################

if (!$name)
{ $name = ">>"; }
else $name .= ":";

$c = preg_replace("/</","&lt;",$c);
$c = preg_replace("/>/","&gt;",$c); 

$comfile = file($datfile);
if ($c != "") {
if (strlen($c) < $MAX_LENGTH) {
$fd = fopen ($datfile, "w");
$c = stripslashes($c);
fwrite ($fd, "<div style='width:112px; overflow:hidden'><i>$name</i> $c</div>\n");
for ($i = 0; $i < $NUM_COMMENTS; $i++) {
fwrite ($fd, $comfile[$i]);
}
}
fclose($fd);
}
Header("Location: $HTTP_REFERER");
?>
