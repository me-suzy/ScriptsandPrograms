<?php
/***************************************************************************
 *   links.php
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

// start output of links archives
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";

// first check if we're displaying all links archives or a specific month
if ($monthy == "all") {

	echo "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\"><span class=\"blogtitle\">" . strtoupper($lang['links']) . "</span>\n"
		. "<br />" . $lang['all_links'] . "</td></tr>\n"
		. "<tr><td colspan=\"2\" width=\"" . (MAX_WIDTH - 8) . "\"><br />\n";

	$result = execRequest("SELECT * FROM bloglinks ORDER BY id DESC", $connection);
	while ($links = nextLine($result)) {
			echo "<a href=\"http://" . $links->link . "\" target=\"_blank\" title=\"" . $lang['links'] . "\">" . $links->link . "</a><br />\n";
			$isvalid = TRUE;
	}
	
	if ($isvalid != TRUE) {
		echo $lang['no_links'] . "<br />";
	}

} else {

	$month = substr($monthy, 4, 2);

	echo "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\"><span class=\"blogtitle\">" . strtoupper($lang['links']) . "</span>\n"
		. "<br />" . $lang['archivesfrom'] . " " . convertMonth($month) . "</td></tr>\n"
		. "<tr><td colspan=\"2\" width=\"" . (MAX_WIDTH - 8) . "\"><br />\n";

	$result = execRequest("SELECT * FROM bloglinks WHERE monthy='$monthy' ORDER BY id DESC", $connection);
	while ($links = nextLine($result)) {
			echo "<a href=\"http://" . $links->link . "\" target=\"_blank\" title=\"" . $lang['links'] . "\">" . $links->link . "</a><br />\n";
			$isvalid = TRUE;
	}
	
	if ($isvalid != TRUE) {
		echo $lang['no_links'] . "<br />";
	}

}

echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
echo "</td></tr>\n<tr><td colspan=\"2\">&nbsp;</td></tr>\n";

echo "</table>\n\n";

$visitors = count_visitors($connection);
print_footer($visitors);
?>