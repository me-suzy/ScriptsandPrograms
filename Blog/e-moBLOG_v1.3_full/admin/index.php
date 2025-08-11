<?php
/***************************************************************************
 *   admin/index.php
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

if (!isset($_SESSION['sessok']) && $_SESSION['sessok'] != "authok") {

	if (!isset($login)) {
		
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
		. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      	. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n"
		. "<head>\n<title>e-moBLOG - ADMIN PAGE</title>\n"
		. "<meta name=\"Copyright\" content=\"Axel Achten / e-motionalis.net\" />\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n"
		. "<link rel=\"stylesheet\" type=\"text/css\" href=\"../includes/style.css\" />\n</head>\n<body>\n\n";
		echo "<div align=\"center\">\n\n";
		
		echo "<br /><br /><br /><span class=\"title\">e-moBLOG Administration System</span><br />Please identify yourself<br /><br />";
		
		echo"<form method=\"post\" action=\"index.php\">\n"
		. "<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\">\n"
		. "<tr><td>username:</td><td><input type=\"text\" name=\"login\" class=\"boxes\" /></td></tr>\n"
		. "<tr><td>password:</td><td><input type=\"password\" name=\"password\" class=\"boxes\" /></td></tr>\n"
		. "<tr><td>&nbsp;</td><td align=\"right\"><input type=\"submit\" value=\"identify\" class=\"buttons\" /></td></tr>\n"			
		. "</table></form>\n\n";
		
		echo "</div>\n\n</body>\n</html>";
		
	} else {
		
		require ("../includes/db.php");
		require ("./functions.php");
		
		if (!$connection) {
			$connection = connect(NAME, PASSWD, BASE, SERVER);
		}
	
		$result = execRequest("SELECT login, password FROM blogconfig WHERE login='$login'", $connection);
		while ($checkpass = nextLine($result)) {
			
			$password = md5("$password");
			$passdb = "$checkpass->password";
			
			if (strcmp($password, $passdb) == 0) {
			
				session_start();
				$_SESSION['sessok'] = "authok";
				header("Location: index2.php?" . SID);
				exit;
				
			}
		}
	}
	
} else {
	
	session_start();
	header("Location: index2.php?" . SID);
	exit;
	
}

?>