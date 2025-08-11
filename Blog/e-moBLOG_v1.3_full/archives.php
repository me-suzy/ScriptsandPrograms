<?php
/***************************************************************************
 *   archives.php
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


require ("./includes/db.php");
require ("./includes/functions.php");

if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

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
print_top();

// start output of months and year in archives
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
	. "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\">\n"
	. "<span class=\"blogtitle\">" . strtoupper($lang['archives']) . "</span></td></tr>\n"
	. "<tr><td width=\"" . MAX_WIDTH . "\">\n"
	. "<br />\n\n";
	
echo "<ul type=\"disc\">\n";

$result = execRequest("SELECT id, monthy FROM blogposts GROUP BY monthy DESC", $connection);
while ($archives = nextLine($result)) {
		
		// handle the $monthy string
		$mystr = $archives->monthy;
		$year = substr($mystr, 0, 4);
		$month = substr($mystr, 4, 2);
		
		// parse the month string to convert month number to text
		$month = convertMonth($month);
		
		echo "<li><a href=\"" . BLOG_URL . "index.php?monthy=" . $mystr . "&lim=no\" title=\"" . $lang['archivesfrom'] . " " . $month . ", " . $year . "\">"
			. $lang['archivesfrom'] . " " . $month . ", " . $year
			. "</a></li>\n";
}

echo "</ul>\n<br />\n";
echo "</td></tr></table>\n\n";

// start output of links archives
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
	. "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\">\n"
	. "<span class=\"blogtitle\">" . strtoupper($lang['links']) . "</span></td></tr>\n"
	. "<tr><td width=\"" . MAX_WIDTH . "\">\n"
	. "<br />\n\n";
	
echo "<ul type=\"disc\">\n";

$result = execRequest("SELECT * FROM bloglinks GROUP BY monthy DESC", $connection);
while ($links = nextLine($result)) {
		
		// handle the $postday string
		$mylink = $links->monthy;
		$yearlink = substr($mylink, 0, 4);
		$monthlink = substr($mylink, 4, 2);
		
		// parse the month string to convert month number to text
		$monthlink = convertMonth($monthlink);
		
		echo "<li><a href=\"" . BLOG_URL . "links.php?monthy=" . $mylink . "\" title=\"" . $lang['archivesfrom'] . " " . $monthlink . ", " . $yearlink . "\">"
			. $lang['archivesfrom'] . " " . $monthlink . ", " . $yearlink
			. "</a></li>\n";
}

echo "<li><a href=\"" . BLOG_URL . "links.php?monthy=all\" title=\"" . $lang['all_links'] . "\">" . $lang['all_links'] . "</a></li>\n</ul>\n<br />";

echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
echo "</td></tr></table>\n\n";

$visitors = count_visitors($connection);
print_footer($visitors);
?>