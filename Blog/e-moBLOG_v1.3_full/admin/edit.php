<?php
/***************************************************************************
 *   admin/edit.php
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

// establish the connection with the DB if not done yet
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

require ("../language/" . BLANG . ".php");
require ("./constants.php");

// print out the headers, menus and javascripts needed
print_header2();
print_jscript();
print_top();
print_admin();

// here we got a few options according the the value of the $display variable passed
switch ($display) {
	case "list": // if the variable is set to "list" we display the months and years

		// start output of months and year like in the archives system
		echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
			. "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\">\n"
			. "<span class=\"blogtitle\">" . strtoupper($lang['archives']) . "</span></td></tr>\n"
			. "<tr><td width=\"" . MAX_WIDTH . "\">\n"
			. "<br />\n";
	
		echo "<ul type=\"disc\">\n";

		$result = execRequest("SELECT id, monthy FROM blogposts GROUP BY monthy DESC", $connection);
		while ($archives = nextLine($result)) {
			// handle the $monthy string
			$mystr = $archives->monthy;
			$year = substr($mystr, 0, 4);
			$month = substr($mystr, 4, 2);
		
			// parse the month string to convert month number to text
			$month = convertMonth($month);
		
			echo "<li><a href=\"" . BLOG_URL . "admin/edit.php?display=posts&monthy=" . $mystr . "&" . SESS . "\" title=\"" . $lang['a_postsfrom'] . " " . $month . ", " . $year . "\">"
				. $lang['a_postsfrom'] . " " . $month . ", " . $year
				. "</a></li>\n";
		}

		echo "</ul><br /><img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
		echo "</td></tr></table>\n\n";
		break;
		
	case "posts": // if the variable is set to "posts" we display the posts from a specific month & year
	
		echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";

		$result = execRequest("SELECT * FROM blogposts WHERE monthy = '$monthy' ORDER BY date DESC", $connection);
		while ($posts = nextLine($result)) {
			$content = parseUBB(stripSlashes($posts->content));
			$content = nl2br($content);
			$content = parseSmileys($content);
			echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 50) . "\"><span class=\"blogtitle\">" . stripSlashes(strtoupper($posts->title)) . "</span>\n"
				. "<br />" . convertDate($posts->date) . "</td>\n"
				. "<td class=\"blogheader\" align=\"center\" width=\"50\">\n"
				. "<a href=\"./edit.php?display=edit&id=" . $posts->id . "&" . SESS . "\" class=\"adminquestion\" title=\"" . $lang['a_edit'] . "\">" . $lang['a_edit'] . "</a><br />\n"
				. "<a href=\"javascript:question('" . $posts->id . "');\" class=\"adminquestion\" title=\"" . $lang['a_delete'] . "\">" . $lang['a_delete'] . "</a></td></tr>\n"
				. "<tr><td colspan=\"2\" width=\"" . (MAX_WIDTH - 8) . "\">\n";
			
			// display the audio of the day if there is one set
			if ($posts->audio != "") {
				echo "<img src=\"../img/audio.gif\" alt=\"audio\" /> " . stripSlashes($posts->audio) . "<br />\n"
					. "<img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
			}
			
			echo "<br />" . $content . "<br />\n";
			
			// if the quote of the day field had been filled, display it
			if ($posts->dayquote != "") {
				echo "<br /><img src=\"../img/quote.gif\" alt=\"quote\" /> " . stripSlashes($posts->dayquote) . "<br />\n";
			}
				
			echo "<br /><img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n"
				. "<div class=\"ralign\">\n";
		
			// display the poster link if there is more than one author
			if (POSTER == "1") {
				echo "<a href=\"mailto:" . stripSlashes($posts->email) . "\" title=\"e-mail\">" . stripSlashes($posts->name) . "</a> | \n";
			}
		
			// display the comments only if they are enabled in the config file
			if (COMMENTS == "1") {
				echo " <a href=\"./edit.php?display=comments&id=" . $posts->id . "&" . SESS . "\" title=\"" . $lang['comments'] . "\">" . $posts->nrcomments . " \n";		
				if ($posts->nrcomments <= 1) {
					echo $lang['comment'];
				} else if ($posts->nrcomments > 0) {
					echo $lang['comments'];
				}
				echo "</a>";	
			}

			echo " </div></td></tr>\n<tr><td colspan=\"2\">&nbsp;</td></tr>\n";
		}
		echo "</table>\n\n";
		break;

	case "edit": // if the variable is set to "edit" we display the form needed to edit the post

		echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n<tr>\n"
			. "<td class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['a_editpost']) . "</span></td>\n</tr>\n"
			. "<tr>\n<td align=\"center\">";
	
		$result = execRequest("SELECT * FROM blogposts WHERE id='$id' ORDER BY date DESC", $connection);
		while ($editpost = nextLine($result)) {
			// print the whole html form needed to edit a post
			echo "

<form action=\"modpost.php?action=mod\" method=\"post\" name=\"post2\">\n
<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"250\" align=\"center\">\n
 <tr>\n
  <td width=\"90\">" . $lang['a_title'] . " *</td>\n
  <td align=\"right\"><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"50\" class=\"boxes\" value=\"" . stripSlashes($editpost->title) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td width=\"90\">" . $lang['a_audio'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"audio\" size=\"30\" maxlength=\"70\" class=\"boxes\" value=\"" . stripSlashes($editpost->audio) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td width=\"90\">" . $lang['a_quote'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"dayquote\" size=\"30\" maxlength=\"256\" class=\"boxes\" value=\"" . stripSlashes($editpost->dayquote) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td width=\"90\">" . $lang['a_content'] . " *</td>\n
  <td align=\"right\"><input type=\"button\" value=\"" . $lang['a_addline'] . "\" class=\"buttons\" onClick=\"javascript:addline2();\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"right\"><textarea name=\"content\" cols=\"55\" rows=\"6\" class=\"boxes\">" . stripSlashes($editpost->content) . "</textarea></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"right\">\n

  <input type=\"submit\" value=\"" . $lang['a_updatebutton'] . "\" class=\"buttons\" />&nbsp;&nbsp;\n
  <input type=\"reset\" value=\"" . $lang['a_clearbutton'] . "\" class=\"buttons\" />\n
  <input type=\"hidden\" value=\"" . $editpost->id . "\" name=\"postid\" />\n
  <input type=\"hidden\" value=\"" . $editpost->monthy . "\" name=\"monthy\" />\n
  
  </td>\n
 </tr>\n
</table>\n
</form>\n\n";
		}
		echo "</td>\n</tr>\n</table>\n\n";
		break;
		
	case "comments": // if the variable is set to "comments" we display the comments related to the posts

		echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";

		$result = execRequest("SELECT * FROM blogposts WHERE id = '$id'", $connection);
		while ($posts = nextLine($result)) {
			$content = parseUBB(stripSlashes($posts->content));
			$content = nl2br($content);
			$content = parseSmileys($content);
			echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 8) . "\"><span class=\"blogtitle\">" . stripSlashes(strtoupper($posts->title)) . "</span>\n"
				. "<br />" . convertDate($posts->date) . "</td></tr>\n"
				. "<tr><td>\n";
			
			// display the audio of the day if there is one set
			if ($posts->audio != "") {
				echo "<img src=\"../img/audio.gif\" alt=\"audio\" /> " . stripSlashes($posts->audio) . "<br />\n"
					. "<img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
			}

			$numcom = $posts->nrcomments;
	
			echo "<br />" . $content . "<br />\n";
			
			// if the quote of the day field had been filled, display it
			if ($posts->dayquote != "") {
				echo "<br /><img src=\"../img/quote.gif\" alt=\"quote\" /> " . stripSlashes($posts->dayquote) . "<br />\n";
			}
				
			echo "<br /><img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
			
			echo "</td></tr>\n<tr><td>&nbsp;</td></tr>\n";
		}

		echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 8) . "\"><span class=\"blogtitle\">" . strtoupper($lang['comments']) . "</span></td></tr>\n";

		// start output of the comments for the post
		if ($numcom != "0") {
			$result2 = execRequest("SELECT * FROM blogcomments WHERE postid = '$id' ORDER BY date ASC", $connection);
			while ($comments = nextLine($result2)) {
				$content = parseUBB(stripSlashes($comments->content));
				$content = nl2br($content);
				$content = parseSmileys($content);
		
			if ($comments->email == "") {
				$namestr = stripSlashes($comments->name);
			} else {
				$namestr = "<a href=\"mailto:" . stripSlashes($comments->email) . "\" class=\"commtitle\" title=\"e-mail\">" . stripSlashes($comments->name) . "</a>";
			}
			
			echo "<tr><td><span class=\"commtitle\">" . $lang['posted_by'] . " " . $namestr . " |</span> "
				. convertDate($comments->date) . " | " . $lang['postip'] . ": " . $comments->ip . "<br />\n"
				. $content . "</td></tr>\n";
				
			echo "<tr><td><div class=\"ralign\"><a href=\"./edit.php?display=cedit&id=" . $comments->id . "&" . SESS . "\" class=\"admintitle\" title=\"" . $lang['a_cedit'] . "\">edit this comment</a> - "
				. "<a href=\"javascript:questionC('" . $comments->id . "','" . $comments->postid . "','" . ($numcom - 1) . "');\" title=\"" . $lang['delcomm'] . "\">" . $lang['delcomm'] . "</a></div>\n"
				. "<img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /></td></tr>\n";
			
			}
		} else {
			echo "<tr><td>" . $lang['no_comments'] . "<br />\n"
				. "<img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /></td></tr>\n";
		}
	
		echo "<tr><td>&nbsp;<br /></td></tr>\n</table>\n\n";
		break;
		
	case "cedit": // if the variable is set to "cedit" we display the form needed to edit the comment

		echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n<tr>\n"
			. "<td class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['a_editcomment']) . "</span></td>\n</tr>\n"
			. "<tr>\n<td align=\"center\">";
	
		$result = execRequest("SELECT * FROM blogcomments WHERE id='$id' ORDER BY date DESC", $connection);
		while ($editcomment = nextLine($result)) {
			
			if ($editcomment->email == "") {
				$namestr = stripSlashes($editcomment->name);
			} else {
				$namestr = "<a href=\"mailto:" . stripSlashes($editcomment->email) . "\" class=\"commtitle\" title=\"e-mail\">" . stripSlashes($editcomment->name) . "</a>";
			}
			
			// print the whole html form needed to edit a comment
			echo "

<form action=\"modpost.php?action=modc\" method=\"post\" name=\"post2\">\n
<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"250\" align=\"center\">\n
 <tr>\n
  <td width=\"60\">" . $lang['posted_by'] . ":</td>\n
  <td align=\"left\" width=\"190\"><span class=\"commtitle\">$namestr</span></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"right\"><textarea name=\"content\" cols=\"55\" rows=\"6\" class=\"boxes\">" . stripSlashes($editcomment->content) . "</textarea></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"right\">\n

  <input type=\"submit\" value=\"" . $lang['a_updatecbutton'] . "\" class=\"buttons\" />&nbsp;&nbsp;\n
  <input type=\"hidden\" value=\"$id\" name=\"commid\" />\n
  
  </td>\n
 </tr>\n
</table>\n
</form>\n\n";
		}
		echo "</td>\n</tr>\n</table>\n\n";
		break;
		
}

print_footer();
?>