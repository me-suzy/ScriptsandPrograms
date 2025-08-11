<?php
/***************************************************************************
 *   help.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " weblog engine
 *
 *   This program is a free software. You can modify it as you wish, though
 *   we would just appreciate if you could keep the copyright notice on the
 *   pages (including the engine version and link)  even if you should feel
 *   free to add your own copyright if you modified and enhanced the code.
 *
 *   Please note though that, this software being copyrighted means that the
 *   whole code (or part of it) is.  You should thus not sell any version of
 *   this program, neither any modified version of it using part of the fol-
 *   lowing code. Moreover, please do not use it for commercial purposes.
 *
 ***************************************************************************/


require ("./includes/functions.php");

// check if language option has already been loaded
if (!defined("BLANG")) {
	$result = execRequest("SELECT language FROM blogconfig", $connection);
	while ($lan = nextLine($result)) {
		define (BLANG, "$lan->language");
	}
}

require ("./language/" . BLANG . ".php");
require ("./constants.php");

print_header();

// start help output
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n"
	. "<tr>\n<td class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['help']) . "</span></td>\n"
	. "</tr>\n<tr>\n<td>\n";

echo "<br />\n";
echo $lang['helpfile1'];
echo "<br />\n";
echo $lang['helpfile2'];
echo "<br /><br />\n";
echo $lang['helpfile3'];
echo "<br />\n<ul type=\"disc\">\n";
echo "<li>" . $lang['help_bius'] . "<br />&nbsp;</li>\n";
echo "<li>" . $lang['a_help_center'] . "<br />&nbsp;</li>\n";
echo "<li>" . $lang['help_url'] . "<br />&nbsp;</li>\n";
echo "<li>" . $lang['help_img'] . "</li>\n";
echo "</ul><br />\n";
echo $lang['help_note'];
echo "<br />&nbsp;<br />&nbsp;<br />&nbsp;";

echo "</td>\n</tr>\n</table>\n\n</body></html>";
?>