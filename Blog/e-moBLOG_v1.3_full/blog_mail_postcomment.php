<?php
/***************************************************************************
 *   blog_mail_postcomment.php
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

// the output is handled differently according to the comments options
if (COMMENTS == "2") {

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

	// for the mail comments, all fields are required
	if (strlen($name) > 0 && strlen($content) > 0 && strlen($email) > 0) {

		if ($email != "" && substr_count($email, "@") != 1 || substr_count($email, ".") < 1) {
			header("Location: ./blog_comments.php?id=" . $postid . "&err=mail");
			exit;
		}
	
		// send a cookie to keep name & email in memory
		$cookievalue = time() + 3600 * 24 * 365;
		setcookie("e-moblog_name", $HTTP_POST_VARS['name'], $cookievalue);
		setcookie("e-moblog_email", $HTTP_POST_VARS['email'], $cookievalue);
	
		$from 	= $email;
		
		if (POSTER == "1") {
			$to = $postmail;
		} else {
			$to = AUTHOR_EMAIL;
		}
		
		$subject= $lang['mailsubject'];
		$msg 	= $lang['mailfrom'] . ": ". $name ."\n" . $lang['mailaddress'] . ": ". $email ."\n"
				. $lang['mailarticle'] . ": ". $article ."\n\n\n". $content;
		$msg	= stripslashes($msg);

		$frommail 	 = $from;
		$headerdate  = date("D, j M Y H:i:s " . SERVERTIME);
		$headermail  = "From: $frommail\n";
		$headermail .= "Reply-To: $frommail\n";
		$headermail .= "X-Mailer: PHP/" . phpversion() . "\n" ;
		$headermail .= "Date: $headerdate"; 

		mail($to,$subject,$msg,$headermail);
		
		// mail sent, get back to previous page and notice the user
		header("Location: ./blog_comments.php?id=" . $postid . "&status=sent");
		exit;
	} else {
		// on error, get back to the previous page and display a reason
		header("Location: ./blog_comments.php?id=" . $postid . "&err=fields2");
		exit;
	}
	
// don't let the page run if the options are not set correctly
} else if (COMMENTS == "0" || COMMENTS == "1") {
	echo "hacking attempt.";
	exit;
}

?>