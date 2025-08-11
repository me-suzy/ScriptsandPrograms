<?php
/***************************************************************************
 *   constants.php
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

if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

// define most of the constants used in the engine pages
if (!defined("COMMENTS")) {
	$result = execRequest("SELECT * FROM blogconfig", $connection);
	while ($row = nextLine($result)) {
			define (COMMENTS, "$row->comments");
			define (CENTER, "$row->center");
			define (POSTER, "$row->poster");
			define (SMILEYS, "$row->smileys");
			define (BLOG_NAME, "$row->blog_name");
			define (BLOG_URL, "$row->blog_url");
			define (AUTHOR_NAME, "$row->author_name");
			define (AUTHOR_EMAIL, "$row->author_email");
			define (BLOG_DESCRIPTION, "$row->blog_description");
			define (BLOG_KEYWORDS, "$row->blog_keywords");
			define (BLOG_LIMIT, "$row->blog_limit");
			define (MAX_WIDTH, "$row->max_width");
			define (SERVERTIME, "$row->servertime");
			define (MOBLOGGING, "$row->moblogging");
			define (RESIZE, "$row->resize");
			define (COPYRIGHT, "$row->copyright");
			define (EBLOGVER, "$row->eblogver");
	}
}

?>