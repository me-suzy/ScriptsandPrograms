<?php
/***************************************************************************
 *   admin/help.php
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
 
require ("./protect.php");
require ("../includes/db.php");
require ("./functions.php");

// check if language option has already been loaded
if (!defined("BLANG")) {
	$result = execRequest("SELECT language FROM blogconfig", $connection);
	while ($lan = nextLine($result)) {
		define (BLANG, "$lan->language");
	}
}

require ("../language/" . BLANG . ".php");
require ("./constants.php");

// print headers, menus and such
print_header2();
print_top();
print_admin();

echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"500\">\n"
	. "<tr>\n<td class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['a_help']) . "</span></td>\n"
	. "</tr>\n<tr>\n<td>\n";

echo $lang['a_helpfile1'];
echo "<br />\n";
echo $lang['a_helpfile2'];
echo "<br /><br />\n";
echo $lang['a_helpfile3'];
echo "<br />\n<ul type=\"disc\">\n";
echo "<li>" . $lang['a_help_bius'] . "<br />&nbsp;</li>\n";
echo "<li>" . $lang['a_help_center'] . "<br />&nbsp;</li>\n";
echo "<li>" . $lang['a_help_url'] . "<br />&nbsp;</li>\n";
echo "<li>" . $lang['a_help_img'] . "</li>\n";
echo "</ul><br />\n";
echo $lang['a_help_note'];
echo "</body></html>";
  
echo "</td>\n</tr>\n</table>\n\n";

print_footer();

?>