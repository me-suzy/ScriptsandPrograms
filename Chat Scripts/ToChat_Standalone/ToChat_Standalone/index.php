<?php

//copyright Moulay Abdessalam El hassani El Alaoui
//http://www.to.ma
//Tochat pour phpnuke et postnuke sur http://www.to.ma/NukeScripts+main.html

include("header.php");
include ("config.cfg");
{
echo "<div align=\"center\">";
echo "<td>\n";
echo "<applet code=\"IRCApplet.class\" archive=\"irc.jar,pixx.jar\" width=\"$width\" height=\"$height\" align=\"center\" codebase=\"$codebase\">\n";
echo "<param name=\"CABINETS\" value=\"irc.cab,securedirc.cab,pixx.cab\">\n";

echo "<param name=\"nick\" value=\"$username\" />\n";
echo "<param name=\"alternatenick\" value=\"$username???\" />\n";
echo "<param name=\"name\" value=\"$username $TOCHATURL\" />\n";
echo "<param name=\"host\" value=\"$server\">\n";
echo "<param name=\"port\" value=\"$port\" /-->\n";
echo "<param name=\"gui\" value=\"pixx\" />\n";

// Alternate servers list, This is experimental code beware.
echo "<param name=\"alternateserver1\" value=\"$alternateserver1\" />\n";
echo "<param name=\"alternateserver2\" value=\"$alternateserver2\" />\n";

echo "<param name=\"quitmessage\" value=\"$QuitMessage\" />\n";
echo "<param name=\"asl\" value=\"$asl\" />\n";
echo "<param name=\"useinfo\" value=\"$useinfo\" />\n";
echo "<param name=\"userid\" value=\"$userid\" />\n";
echo "<param name=\"command1\" value=\"/join $channel\" />\n";
echo "<param name=\"authorizedjoinlist\" value=\"$authorizedjoinlist\" />\n";
echo "<param name=\"authorizedleavelist\" value=\"$authorizedleavelist\" />\n";
echo "<param name=\"authorizedcommandlist\" value=\"$authorizedcommandlist\" />\n";
echo "<!--param name=\"password\" value=\"$serverpass\" /--> \n";
echo "<param name=\"autoconnection\" value=\"$autoconnection\" />\n";
echo "<param name=\"language\" value=\"$language\" />\n";
echo "<param name=\"soundbeep\" value=\"$soundbeep\" />\n";
echo "<param name=\"soundquery\" value=\"$soundquery\" />\n";


// Style configs smilicons and such
echo "<param name=\"style:bitmapsmileys\" value=\"$smileys\" />\n";
echo "<param name=\"style:smiley1\" value=\":) img/sourire.gif\" />\n";
echo "<param name=\"style:smiley2\" value=\":-) img/sourire.gif\" />\n";
echo "<param name=\"style:smiley3\" value=\":-D img/content.gif\" />\n";
echo "<param name=\"style:smiley4\" value=\":d img/content.gif\" />\n";
echo "<param name=\"style:smiley5\" value=\":-O img/OH-2.gif\" />\n";
echo "<param name=\"style:smiley6\" value=\":o img/OH-1.gif\" />\n";
echo "<param name=\"style:smiley7\" value=\":-P img/langue.gif\" />\n";
echo "<param name=\"style:smiley8\" value=\":p img/langue.gif\" />\n";
echo "<param name=\"style:smiley9\" value=\";-) img/clin-oeuil.gif\" />\n";
echo "<param name=\"style:smiley10\" value=\";) img/clin-oeuil.gif\" />\n";
echo "<param name=\"style:smiley11\" value=\":-( img/triste.gif\" />\n";
echo "<param name=\"style:smiley12\" value=\":( img/triste.gif\" />\n";
echo "<param name=\"style:smiley13\" value=\":-| img/OH-3.gif\" />\n";
echo "<param name=\"style:smiley14\" value=\":| img/OH-3.gif\" />\n";
echo "<param name=\"style:smiley15\" value=\":'( img/pleure.gif\" />\n";
echo "<param name=\"style:smiley16\" value=\":$ img/rouge.gif\" />\n";
echo "<param name=\"style:smiley17\" value=\":-$ img/rouge.gif\" />\n";
echo "<param name=\"style:smiley18\" value=\"(H) img/cool.gif\" />\n";
echo "<param name=\"style:smiley19\" value=\"(h) img/cool.gif\" />\n";
echo "<param name=\"style:smiley20\" value=\":-@ img/enerve1.gif\" />\n";
echo "<param name=\"style:smiley21\" value=\":@ img/enerve2.gif\" />\n";
echo "<param name=\"style:smiley22\" value=\":-S img/roll-eyes.gif\" />\n";
echo "<param name=\"style:smiley23\" value=\":s img/roll-eyes.gif\" />\n";

echo "<param name=\"style:floatingasl\" value=\"$floatingasl\" />\n";
echo "<param name=\"style:righttoleft\" value=\"$righttoleft\" />\n";

echo "<param name=\"pixx:nicklistwidth\" value=\"$nicklistwidth\" \>\n";
echo "<param name=\"pixx:highlight\" value=\"$highlight\" />\n";
echo "<param name=\"pixx:highlightnick\" value=\"$highlightnick\" />\n";
echo "<param name=\"pixx:timestamp\" value=\"$timestamp\" />\n";
// Menu Buttons
echo "<param name=\"pixx:showchanlist\" value=\"$showchanlist\" />\n";
echo "<param name=\"pixx:showabout\" value=\"$showabout\" />\n";
echo "<param name=\"pixx:showconnect\" value=\"$showconnect\" />\n";
echo "<param name=\"pixx:showhelp\" value=\"$showhelp\" />\n";
echo "<param name=\"pixx:helppage\" value=\"$helppage\" />\n";

echo "<param name=\"pixx:nickfield\" value=\"$nickfield\" />\n";
echo "<param name=\"pixx:showclose\" value=\"$showclose\" />\n";
echo "<param name=\"pixx:showdock\" value=\"$showdock\" />\n";
echo "<param name=\"pixx:styleselector\" value=\"$styleselector\" />\n";
echo "<param name=\"pixx:setfontonstyle\" value=\"$setfontonstyle\" />\n";

// Support for some color themage for PIXX GUI
if ($theme!="default") {
include ("$theme.theme");
}
echo "<h1>\"$TOCHATCHATURL\"</h1>\n";
echo "\"$TOCHATINFO\"\n";
echo "</applet></td></tr></table></form></td></table>\n";
echo "</div>";
include("footer.php");
}
?>