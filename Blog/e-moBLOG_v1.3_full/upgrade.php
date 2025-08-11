<?php
/***************************************************************************
 *   upgrade.php
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
require ("./language/english.php");

// first ask if the user really wants to install the blog system
if (!isset($action)) {
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
		. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      	. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n"
		. "<head>\n<title>welcome to e-moBLOG!</title>\n"
		. "<meta http-equiv=\"imagetoolbar\" content=\"no\" />\n"
		. "<meta name=\"Copyright\" content=\"Axel Achten / e-motionalis.net\" />\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n"
		. "<link rel=\"stylesheet\" type=\"text/css\" href=\"./includes/style.css\" />\n</head>\n<body><div align=\"center\">\n";
		
	echo "<br /><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"400\">\n"
		. "<tr><td align=\"center\" valign=\"middle\" class=\"menu\"><div class=\"calign\"><img src=\"./img/blog.gif\" alt=\"blog\" /></div></td></tr>\n"
		. "<tr><td>&nbsp;</td></tr><tr><td>\n\n";
		
	echo "<br /><br /><div class=\"calign\">";
	echo "this procedure will upgrade your existing e-moBLOG installation.<br /><br />"
		. "if you don't have an existing e-moBLOG installed on this webhosting<br />"
		. "account, do not click on the \"proceed\" link below. Instead, go to<br />"
		. "<a href=\"http://www.e-motionalis.net\">www.e-motionalis.net</a> and download the full e-moBLOG package.";
	echo "<br /><br /><br />[ <a href=\"upgrade.php?action=upgrade\" title=\"upgrade e-moBLOG\">" . $lang['i_proceed'] . "</a> ]<br /><br /><br />";
	echo "if you do not want to proceed right now, simply close this window.<br /><br /><br /><u>note:</u> the installation process is in english only.<br />";
	echo "you will be able to choose another language for<br />your blog once fully installed.<br /><br />&nbsp;</div></td></tr></table>";
	exit;
} else if (isset($action)) {

// establish connection with the DB
if (!$connection) {
	$connection = mysql_pconnect (SERVER, NAME, PASSWD);
	if (!$connection) {
		echo "Sorry, could not connect to " . SERVER . " for the moment.\n";
		exit;
	}
	if (!mysql_select_db (BASE, $connection)) {
		echo "Sorry, could not reach " . BASE . " for the moment.\n";
		echo "<b>Message from MySQL:</b>" . mysql_error($connection);
		exit;
	}
}

switch ($action) {	
	case "upgrade": // drop existing tables, create the new ones and insert the default settings
	
		require ("./includes/functions.php");
		
		$query1 = "DROP TABLE IF EXISTS bloglinks";
		mysql_query($query1, $connection);
	
		$query1 = "CREATE TABLE bloglinks (id int(6) NOT NULL auto_increment,
										link varchar(200) NOT NULL,
										monthy int(6) NOT NULL default '0',
										PRIMARY KEY  (id) );";
		if (!mysql_query($query1, $connection)) return FALSE;

		$query1 = "UPDATE blogconfig SET eblogver='e-moBLOG v1.2'";
		if (!mysql_query($query1, $connection)) return FALSE;

		$result = execRequest("SELECT blog_url FROM blogconfig", $connection);
		while ($confi = nextLine($result)) {
			getSupport($confi->blog_url, "");
		}
		
		header("Location: ./upgrade.php?action=done");
		break;

		
	case "done": // the installation is correctly done
	
		require ("./includes/functions.php");
		require ("./constants.php");
	
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
			. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      		. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n<head>\n<title>e-moBLOG upgrade procedure: finished!</title>\n"
			. "<meta http-equiv=\"imagetoolbar\" content=\"no\" />\n"
			. "<meta name=\"Copyright\" content=\"Axel Achten / e-motionalis.net\" />\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n"
			. "<LINK rel=\"stylesheet\" type=\"text/css\" href=\"./includes/style.css\" />\n</head>\n<body><div align=\"center\">\n";
			
		echo "<br /><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"400\">\n"
			. "<tr><td align=\"center\" valign=\"middle\" class=\"menu\"><div class=\"calign\"><img src=\"./img/blog.gif\" alt=\"blog\" /></div></td></tr>\n"
			. "<tr><td>&nbsp;</td></tr><tr><td>\n\n";
			
		echo "<br /><br /><div class=\"calign\">" . $lang['i_done'];
		echo "<br /><a href=\"" . $lang['i_link'] . "\" target=\"_blank\" title=\"e-motionalis.net\">" . $lang['i_link'] . "</a><br /><br />";
		echo $lang['i_admin'];
		echo "<br /><a href=\"" . BLOG_URL . "admin/\" title=\"administration panel\">" . BLOG_URL . "admin/</a><br /><br />";
		echo "note: please don't forget to remove the file \"upgrade.php\" from<br />your webhosting account (see HOW-TO.txt file for informations).";
		echo "<br /><br />&nbsp;</div></td></tr></table>";
		break;
}

}

echo "</div></body></html>";

?>