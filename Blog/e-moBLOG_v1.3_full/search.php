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

// if we're entering the page normally, display the search box
if ($action != "search") {
	
	echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
		. "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\">\n"
		. "<span class=\"blogtitle\">" . strtoupper($lang['search']) . "</span></td></tr>\n"
		. "<tr><td width=\"" . MAX_WIDTH . "\">\n"
		. "<br />\n\n";
		
	echo "<form method=\"post\" action=\"search.php?action=search\">";
	echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" align=\"center\">";
	
	echo "<tr><td>" . $lang['search_posts'] . ": </td>";
	echo "<td>&nbsp;<input type=\"text\" name=\"findstr\" size=\"40\" maxlength=\"30\" class=\"boxes\" /></td></tr>";
	echo "<tr><td colspan=\"2\"><div align=\"right\"><input type=\"submit\" value=\"" . $lang['search'] . "\" class=\"buttons\" /></div></td></tr>";
	
	echo "</table>";
	echo "</form>";
		
	
	echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
	echo "</td></tr></table>\n\n";
	
// if we're doing a search, connect to DB and search for the required string
} else if ($action == "search") {
	
	// get the total number of results
	$totals = getTot($findstr, $connection);
	$numberResults = 10;
	$findstr2 = "$findstr";
	
	if ($totals > $numberResults) {
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
	
	// start results output
	echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";
	
	$result = execRequest("SELECT * FROM blogposts WHERE content LIKE '%$findstr%' OR title LIKE '%$findstr%' ORDER BY date DESC $slimit", $connection);
	while ($posts = nextLine($result)) {
		
		$content = parseUBB(stripSlashes($posts->content));
		$content = nl2br($content);
		$content = parseSmileys($content);
		echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 20) . "\"><a name=\"" . $posts->id . "\" class=\"blogtitle\">" . stripSlashes(strtoupper($posts->title)) . "</a>\n"
			. "<br />" . convertDate($posts->date) . "</td>\n"
			. "<td class=\"blogheader\" align=\"center\" width=\"20\"><a href=\"#top\" title=\"TOP\"><img src=\"./img/top.gif\" alt=\"top\" /></a></td></tr>\n"
			. "<tr><td colspan=\"2\" width=\"" . (MAX_WIDTH - 8) . "\">\n";
			
		if ($posts->audio != "") {
			echo "<img src=\"./img/audio.gif\" alt=\"audio\" /> " . stripSlashes($posts->audio) . "<br />\n"
				. "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
		}
			
		echo "<br />" . $content . "<br />\n";
			
		if ($posts->dayquote != "") {
			echo "<br /><img src=\"./img/quote.gif\" alt=\"quote\" /> " . stripSlashes($posts->dayquote) . "<br />\n";
		}
			
		echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n"
			. "<div class=\"ralign\">\n";
		
		if (POSTER == "1") {
			echo "<a href=\"mailto:" . stripSlashes($posts->email) . "\" title=\"e-mail\">" . stripSlashes($posts->name) . "</a> | \n";
		}
			
		echo "<a href=\"" . BLOG_URL . "index.php?monthy=" . $posts->monthy . "#" . $posts->id . "\" title=\"" . $lang['link'] . "\">\n"
			. $lang['link'] . "</a>\n";
				
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
			
	// if there is no result
	if ($isvalid != TRUE) {
		echo "<tr><td align=\"center\">" . $lang['noresults'] . "</td></tr>";
	}

	// if total number of results is more than $totals, split them on multiple pages
	if ($totals > $numberResults) {
		echo "<tr><td colspan=\"2\" align=\"right\">\n\n<form action=\"search.php?action=search\" method=\"post\" name=\"pages\">\n"
			. "<div class=\"ralign\">" . $lang['numpages'] . " \n"
			. "<select name=\"page\" onChange=\"document.pages.submit();\" class=\"boxes\">\n";
		
		$pageN = (int) $totals/$numberResults;
		
		for($i = 1; $i <= $pageN + 1; $i++) {
			if ($i == $page) {
				echo "<option value=\"$i\" selected=\"selected\"> " . $lang['page'] . " $i</option>\n";
			} else {
				echo "<option value=\"$i\"> " . $lang['page'] . " $i</option>\n";
			}
		}
		
		echo "</select></div><input type=\"hidden\" name=\"findstr\" value=\"$findstr2\" /></form>\n\n</td></tr>\n\n";
	}
	
	echo "</table>\n\n";
}

$visitors = count_visitors($connection);
print_footer($visitors);
?>