<?php
/***************************************************************************
 *   index.php
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

// check mobile blogging messages if set as enabled
if (MOBLOGGING == "1") {
	$timenow = time();
	$result = execRequest("SELECT moblog FROM blogconfig", $connection);
	while ($rmoblog = nextLine($result)) {
		if ($timenow > ($rmoblog->moblog + 600)) {
				require ("moblogging.php");
				$resulta = execRequest("UPDATE blogconfig SET moblog='" . time() . "'", $connection);
		}
	}
}

print_header();
print_top();

// start output of posts
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";

if (BLOG_LIMIT != 0 && (!$monthy || $monthy == "")) {
	$blog_limit = " LIMIT " . BLOG_LIMIT;
	$wheremonth = "";
} else if ($monthy || $monthy != "") {
	$blog_limit = "";
	$wheremonth = "WHERE monthy = '$monthy'";
} else {
	$monthy = date("Ym");
	$blog_limit = "";
	$wheremonth = "WHERE monthy = '$monthy'";
}

$result = execRequest("SELECT * FROM blogposts $wheremonth ORDER BY date DESC $blog_limit", $connection);
while ($posts = nextLine($result)) {
		$content = parseUBB(stripSlashes($posts->content));
		$content = nl2br($content);
		$content = parseSmileys($content);
		echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 20) . "\"><a name=\"" . $posts->id . "\" class=\"blogtitle\">" . stripSlashes(strtoupper($posts->title)) . "</a>\n"
			. "<br />" . convertDate($posts->date) . "</td>\n"
			. "<td class=\"blogheader\" align=\"center\" width=\"20\"><a href=\"#top\" title=\"TOP\"><img src=\"./img/top.gif\" alt=\"top\" /></a></td></tr>\n"
			. "<tr><td colspan=\"2\" width=\"" . (MAX_WIDTH - 8) . "\">\n";
			
		// if the audio field had been filled, display it
		if ($posts->audio != "") {
			echo "<img src=\"./img/audio.gif\" alt=\"audio\" /> " . stripSlashes($posts->audio) . "<br />\n"
				. "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
		}
			
		echo "<br />" . $content . "<br />\n";
			
		// if the quote of the day field had been filled, display it
		if ($posts->dayquote != "") {
			echo "<br /><img src=\"./img/quote.gif\" alt=\"quote\" /> " . stripSlashes($posts->dayquote) . "<br />\n";
		}
			
		echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n"
			. "<div class=\"ralign\">\n";
		
		// display the name of the poster if required by the options
		if (POSTER == "1") {
			echo "<a href=\"mailto:" . stripSlashes($posts->email) . "\" title=\"e-mail\">" . stripSlashes($posts->name) . "</a> | \n";
		}
			
		echo "<a href=\"" . BLOG_URL . "index.php?monthy=" . $posts->monthy . "#" . $posts->id . "\" title=\"" . $lang['link'] . "\">\n"
			. $lang['link'] . "</a>\n";
		
		// display the number of comments according to the options
		if (COMMENTS == "1") {
			echo " | <a href=\"./blog_comments.php?id=" . $posts->id . "\" title=\"" . $lang['comments'] . "\">" . $posts->nrcomments . " \n";		
			if ($posts->nrcomments <= 1) {
				echo $lang['comment'];
			} else if ($posts->nrcomments > 0) {
				echo $lang['comments'];
			}
			echo "</a>";	
		} else if (COMMENTS == "2") {
			echo " | <a href=\"./blog_comments.php?id=" . stripSlashes($posts->id) . "\" title=\"" . $lang['mailcomment'] . "\">" . $lang['mailcomment'] . "</a>\n";
		}

		echo " </div></td></tr>\n<tr><td colspan=\"2\">&nbsp;</td></tr>\n";
		$isvalid = TRUE;
}

if ($isvalid != TRUE) {
	echo "<tr><td align=\"center\">" . $lang['no_posts'] . "</td></tr>";
}

echo "</table>\n\n";

$visitors = count_visitors($connection);
print_footer($visitors);
?>