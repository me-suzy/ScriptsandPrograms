<?php
/***************************************************************************
 *   blog_postcomment.php
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
require ("./constants.php");

// handle the output differently according to the options
if (COMMENTS == "1") {

	if (strlen($name) > 0 && strlen($content) > 0) {

		if ($email != "" && substr_count($email, "@") != 1 || substr_count($email, ".") < 1) {
			$email = "";
		}
	
		// send a cookie to keep name and email in memory
		$cookievalue = time() + 3600 * 24 * 365;
		setcookie("e-moblog_name", $HTTP_POST_VARS['name'], $cookievalue);
		setcookie("e-moblog_email", $HTTP_POST_VARS['email'], $cookievalue);

		$numcom = $numcom + 1;
	
		// connect to DB, insert the new comment, and add 1 to the number of comments for the current post
		if (!$connection) {
			$connection = connect(NAME, PASSWD, BASE, SERVER);
		}
		
		$result = execRequest("INSERT INTO blogcomments (postid, date, content, name, email, ip) VALUES ('" . $postid . "', '" . time() . "', '" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($name, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($email, ENT_QUOTES)) . "', '" . $ip . "')", $connection);
		$result2 = execRequest("UPDATE blogposts SET nrcomments='$numcom' WHERE id='$postid'", $connection);
		header("Location: ./blog_comments.php?id=" . $postid);
		exit;
		
	} else {
		// on error, get back and notify the user
		header("Location: ./blog_comments.php?id=" . $postid . "&err=fields");
		exit;
	}
	
// don't let the page run if the options are not correctly set
} else if (COMMENTS == "0" || COMMENTS == "2") {
	echo "hacking attempt.";
	exit;
}
?>
