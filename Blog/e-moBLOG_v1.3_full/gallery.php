<?php
/***************************************************************************
 *   gallery.php
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

echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
	. "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\" colspan=\"2\">\n"
	. "<span class=\"blogtitle\">" . strtoupper($lang['gallery']) . "</span></td></tr>\n"
	. "<tr><td width=\"" . MAX_WIDTH . "\" colspan=\"2\">\n"
	. "<br />\n\n";

// we need to put images onto multiple pages if there are a lot
$totals = getImg($connection);
$numberResults = 20;

if ($totalimg > $numberResults) {
	if (!$page || $page == "") {
		$page = 1;
	}
	
	if ($page == 1) {
		$slimit = "LIMIT 0,$numberResults";
	} else {
		$begin = ($page - 1) * $numberResults;
		$slimit = "LIMIT $begin,$numberResults";
	}	
} else {
	$slimit = "";	
}
	
// start gallery output
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . (MAX_WIDTH - 8) . "\"";
	
$result = execRequest("SELECT * FROM blogimages ORDER BY date DESC $slimit", $connection);
while ($gallery = nextLine($result)) {
	
	echo "<tr>\n<td width=\"150\" valign=\"top\">\n<a href=\"#\" onClick=\"window.open('http://$gallery->url', 'image', 'toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=no, width=" . ($gallery->width + 20) . ", height=" . ($gallery->height + 20) . ", left=100, top=200');\">";
	echo "<img src=\"blog_resize.php?rwidth=150&img=http://" . $gallery->url . "\" alt=\"image\" />";
	echo "</a>\n</td>\n<td valign=\"top\">\n";
	echo convertDate($gallery->date) . "<br />\n";
	
	// if the image comes from a article, display this article
	if ($gallery->postid != "" && $gallery->postid != 0) {
		$result1 = execRequest("SELECT id, title, monthy FROM blogposts WHERE id='$gallery->postid'", $connection);
		while ($post = nextLine($result1)) {
			echo $lang['frompost'] . ": <a href=\"" . BLOG_URL . "/index.php?monthy=" . $post->monthy . "#" . $post->id . "\" title=\"" . $lang['link'] . "\">" . stripslashes($post->title) . "</a>\n";
		}
		
	// if added directly to the gallery page, display its description
	} else {
		echo "description: " . stripslashes($gallery->descr);
	}
	
	echo "\n</td>\n</tr>\n";
	$isvalid = TRUE;
}

// if there are no images
if ($isvalid != TRUE) {
	echo "<tr><td align=\"center\">" . $lang['no_images'] . "</td></tr>";
}

// if there were more than $totalimg images, split them on multiple pages
if ($totalimg > $numberResults) {
	echo "<tr><td colspan=\"2\" align=\"right\">\n\n<form action=\"search.php?action=search\" method=\"post\" name=\"pages\">\n"
		. "<div class=\"ralign\">" . $lang['numpages'] . " \n"
		. "<select name=\"page\" onChange=\"document.pages.submit();\" class=\"boxes\">\n";
	
	$pageN = (int) $totalimg/$numberResults;
	
	for($i = 1; $i <= $pageN + 1; $i++) {
		if ($i == $page) {
			echo "<option value=\"$i\" selected=\"selected\"> " . $lang['page'] . " $i</option>\n";
		} else {
			echo "<option value=\"$i\"> " . $lang['page'] . " $i</option>\n";
		}
	}
	
	echo "</select></div></form>\n\n</td></tr>\n\n";
}

echo "</table>\n\n";

echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
echo "</td></tr></table>\n\n";

$visitors = count_visitors($connection);
print_footer($visitors);
?>