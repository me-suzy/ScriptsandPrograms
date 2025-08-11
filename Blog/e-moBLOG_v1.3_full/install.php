<?php
/***************************************************************************
 *   install.php
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
		
	echo "<br /><br /><div class=\"calign\">" . $lang['i_confirm'];
	echo "<br /><br /><br />[ <a href=\"install.php?action=create\" title=\"e-moBLOG installation\">" . $lang['i_proceed'] . "</a> ]<br /><br /><br />";
	echo $lang['i_cancel'] . "<br /><br /><br /><u>note:</u> the installation process is in english only.<br />";
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
	case "create": // drop existing tables, create the new ones and insert the default settings
		
		$query1 = "DROP TABLE IF EXISTS blogcomments, blogposts, blogimages, bloglinks, blogconfig, blogvisitors";
		mysql_query($query1, $connection);
		
		$query1 = "CREATE TABLE blogcomments (id int(9) NOT NULL auto_increment, 
											postid int(9) NOT NULL default '0', 
											date int(11) NOT NULL default '0',
  											content text NOT NULL,
											name varchar(50) NOT NULL default '',
											email varchar(70) NOT NULL default '',
											ip varchar(15) NOT NULL default '0.0.0.0',
											PRIMARY KEY  (id) );";
		mysql_query($query1, $connection);
		
		$query1 = "CREATE TABLE blogposts (id int(9) NOT NULL auto_increment,
										date int(11) NOT NULL default '0',
										title varchar(50) NOT NULL default '',
										content mediumtext NOT NULL,
										audio varchar(70) NOT NULL default '',
										dayquote mediumtext NOT NULL,
										monthy int(6) NOT NULL default '0',
										nrcomments int(3) NOT NULL default '0',
										name varchar(50) NOT NULL default '',
										email varchar(70) NOT NULL default '',
										PRIMARY KEY  (id) );";
		mysql_query($query1, $connection);
		
		$query1 = "CREATE TABLE blogimages (id int(9) NOT NULL auto_increment,
										postid int(9) NOT NULL default '0',
										date int(11) NOT NULL default '0',
										url varchar(255) NOT NULL default '',
										width int(4) NOT NULL default '0',
										height int(4) NOT NULL default '0',
										descr mediumtext NOT NULL,
										PRIMARY KEY  (id) );";
		mysql_query($query1, $connection);
		
		$query1 = "CREATE TABLE bloglinks (id int(9) NOT NULL auto_increment,
										link varchar(200) NOT NULL,
										monthy int(6) NOT NULL default '0',
										PRIMARY KEY  (id) );";
		mysql_query($query1, $connection);
		
		$query1 = "CREATE TABLE blogvisitors (ip varchar(15) NOT NULL default '',
										time int(11) NOT NULL default '0');";
		mysql_query($query1, $connection);
		
		$query2 = "CREATE TABLE blogconfig (login varchar(40) NOT NULL default '',
										password varchar(60) NOT NULL default '',
										comments int(1) NOT NULL default '0',
										center int(1) NOT NULL default '0',
										poster int(1) NOT NULL default '0',
										smileys int(1) NOT NULL default '0',
										language varchar(15) NOT NULL default 'english',
										blog_name varchar(50) NOT NULL default '',
										blog_url varchar(100) NOT NULL default '',
										blog_path varchar(250) NOT NULL default '',
										author_name varchar(70) NOT NULL default '',
										author_email varchar(70) NOT NULL default '',
										blog_description mediumtext NOT NULL,
										blog_keywords mediumtext NOT NULL,
										blog_limit int(3) NOT NULL default '0',
										max_width int(3) NOT NULL default '0',
										servertime char(3) NOT NULL default '',
										moblogging int(1) NOT NULL default '0',
										mserver varchar(250) NOT NULL default '',
										mport int(5) NOT NULL default '110',
										mtype enum('pop3','imap') NOT NULL default 'pop3',
										mlogin varchar(70) NOT NULL default '',
										mpassword varchar(70) NOT NULL default '',
										moblog int(11) NOT NULL default '1000000',
										resize int(1) NOT NULL default '1',
										copyright varchar(35) NOT NULL default '',
										eblogver varchar(30) NOT NULL default '',
										PRIMARY KEY  (blog_url) );";
		mysql_query($query2, $connection);
		
		$query1 = "INSERT INTO blogconfig (login, password, comments, center, poster, smileys, language, blog_name, blog_url, author_name, author_email, blog_description, blog_keywords, blog_limit, max_width, servertime, moblogging, resize, copyright, eblogver) VALUES ('test', 'test', 1, 0, 0, 0, 'english', 'e-moBLOG', 'http://www.yourdomain.com/yourblog/', 'Your Name', 'you@mydomain.com', 'This is my blog!', 'best, blog, ever', 0, 400, '-06', 0, 1, 'copyright © 2005 e-motionalis.net', 'e-moBLOG v1.3');";
		mysql_query($query1, $connection);

		header("Location: ./install.php?action=conf");
		break;
		
		
	case "conf": // display the form that has to be filled to configure the system
		
		require ("./includes/functions.php");
		
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
			. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      		. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n<head>\n<title>e-moBLOG install procedure: configuration</title>\n"
			. "<meta http-equiv=\"imagetoolbar\" content=\"no\" />\n"
			. "<meta name=\"Copyright\" content=\"Axel Achten / e-motionalis.net\" />\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n"
			. "<link rel=\"stylesheet\" type=\"text/css\" href=\"./includes/style.css\" />\n</head>\n<body><div align=\"center\">\n";

		if ($err == "fields") {
			echo "<br /><span class=\"error\">" . $lang['field2_error'] . "</span>\n\n";
		} else if ($err == "pass") {
			echo "<br /><span class=\"error\">" . $lang['pass_error'] . "</span>\n\n";
		}
	
		$result = execRequest("SELECT * FROM blogconfig", $connection);
		while ($bconf = nextLine($result)) {
			echo "
<form action=\"./install.php?action=updateconf\" method=\"post\">\n
<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"650\">\n
 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_loginoptions']) . "</span></td>\n
 </tr>\n
			
 <tr>\n
  <td><span class=\"config\">" . $lang['c_login'] . "</span></td>\n
  <td align=\"right\"><input type=\"text\" name=\"login\" size=\"60\" maxlength=\"40\" class=\"boxes\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_password'] . "</span></td>\n
  <td align=\"right\"><input type=\"text\" name=\"pass\" size=\"60\" maxlength=\"30\" class=\"boxes\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_confirmpass'] . "</span></td>\n
  <td align=\"right\"><input type=\"text\" name=\"confpass\" size=\"60\" maxlength=\"30\" class=\"boxes\" /></td>\n
 </tr>\n
			
 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_general']) . "</span></td>\n
 </tr>\n
			
 <tr>\n
  <td><span class=\"config\">" . $lang['c_bname'] . "</span><br /><div align=\"justify\">" . $lang['c_bname_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"bname\" size=\"60\" maxlength=\"50\" class=\"boxes\" value=\"" . stripSlashes($bconf->blog_name) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_burl'] . "</span><br /><div align=\"justify\">" . $lang['c_burl_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"burl\" size=\"60\" maxlength=\"100\" class=\"boxes\" value=\"" . stripSlashes($bconf->blog_url) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_aname'] . "</span><br /><div align=\"justify\">" . $lang['c_aname_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"aname\" size=\"60\" maxlength=\"70\" class=\"boxes\" value=\"" . stripSlashes($bconf->author_name) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_aemail'] . "</span><br /><div align=\"justify\">" . $lang['c_aemail_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"aemail\" size=\"60\" maxlength=\"70\" class=\"boxes\" value=\"" . stripSlashes($bconf->author_email) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_bdesc'] . "</span><br /><div align=\"justify\">" . $lang['c_bdesc_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"bdesc\" size=\"60\" maxlength=\"256\" class=\"boxes\" value=\"" . stripSlashes($bconf->blog_description) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_bkeys'] . "</span><br /><div align=\"justify\">" . $lang['c_bkeys_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"bkeys\" size=\"60\" maxlength=\"256\" class=\"boxes\" value=\"" . stripSlashes($bconf->blog_keywords) . "\" /></td>\n
 </tr>\n

 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_moblogging']) . "</span></td>\n
 </tr>\n
 
 <tr>\n
  <td><span class=\"config\">" . $lang['c_moblogging_state'] . "</span><br /><div align=\"justify\">" . $lang['c_moblogging_desc'] . "</div></td>\n
  <td>
	<input type=\"radio\" name=\"moblogging\" value=\"0\" ";

	// the script checks which option is actually set in the config to pre-check the corresponding radio button
	if ($bconf->moblogging == "0") { echo "checked"; }
	echo " /> " . $lang['c_moblogging_0'] . "\n<br /><input type=\"radio\" name=\"moblogging\" value=\"1\" ";
	if ($bconf->moblogging == "1") { echo "checked"; }
	echo " /> " . $lang['c_moblogging_1'] . "\n
	
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mserver'] . "</span><br /><div align=\"justify\">" . $lang['c_mserver_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"mserver\" size=\"60\" maxlength=\"200\" class=\"boxes\" value=\"" . stripSlashes($bconf->mserver) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mport'] . "</span><br /><div align=\"justify\">" . $lang['c_mport_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"mport\" size=\"6\" maxlength=\"5\" class=\"boxes\" value=\"" . stripSlashes($bconf->mport) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mtype'] . "</span><br /><div align=\"justify\">" . $lang['c_mtype_desc'] . "</div></td>\n
  <td>
	<input type=\"radio\" name=\"mtype\" value=\"pop3\" ";

	// the script checks which option is actually set in the config to pre-check the corresponding radio button
	if ($bconf->mtype == "pop3") { echo "checked"; }
	echo " /> " . $lang['c_mtype_0'] . "\n<br /><input type=\"radio\" name=\"mtype\" value=\"imap\" ";
	if ($bconf->mtype == "imap") { echo "checked"; }
	echo " /> " . $lang['c_mtype_1'] . "\n

  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mlogin'] . "</span><br /><div align=\"justify\">" . $lang['c_mlogin_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"mlogin\" size=\"60\" maxlength=\"200\" class=\"boxes\" value=\"" . stripSlashes($bconf->mlogin) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mpassword'] . "</span><br /><div align=\"justify\">" . $lang['c_mpassword_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"password\" name=\"mpassword\" size=\"60\" maxlength=\"200\" class=\"boxes\" value=\"" . stripSlashes($bconf->mpassword) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_absolute'] . "</span><br /><div align=\"justify\">" . $lang['c_absolute_desc'] . "</div></td>\n
  <td align=\"right\"><input type=\"text\" name=\"bpath\" size=\"60\" maxlength=\"250\" class=\"boxes\" value=\"" . stripSlashes($bconf->blog_path) . "\" /></td>\n
 </tr>\n

 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_options']) . "</span></td>\n
 </tr>\n

 <tr>\n
  <td><span class=\"config\">" . $lang['c_resize'] . "</span><br /><div align=\"justify\">" . $lang['c_resize_desc'] . "</div></td>\n
  <td>\n
	<input type=\"radio\" name=\"resize\" value=\"0\" ";

// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconf->resize == "0") { echo "checked"; }
echo " /> " . $lang['c_moblogging_0'] . "\n<br /><input type=\"radio\" name=\"resize\" value=\"1\" ";
if ($bconf->resize == "1") { echo "checked"; }
echo " /> " . $lang['c_moblogging_1'] . "\n

  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_comments'] . "</span><br /><div align=\"justify\">" . $lang['c_comments_desc'] . "</div></td>\n
  <td>\n
	<input type=\"radio\" name=\"comments\" value=\"0\" ";

// the script checks which option is set by default in the config to pre-check the corresponding radio button
if ($bconf->comments == "0") { echo "checked"; }
echo " /> " . $lang['c_comments_0'] . "\n<input type=\"radio\" name=\"comments\" value=\"1\" ";
if ($bconf->comments == "1") { echo "checked"; }
echo " /> " . $lang['c_comments_1'] . "\n<input type=\"radio\" name=\"comments\" value=\"2\" ";
if ($bconf->comments == "2") { echo "checked"; }
	
echo "
	 /> " . $lang['c_comments_2'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_center'] . "</span><br /><div align=\"justify\">" . $lang['c_center_desc'] . "</div></td>\n
  <td>\n
	<input type=\"radio\" name=\"center\" value=\"0\" ";

// the script checks which option is set by default in the config to pre-check the corresponding radio button
if ($bconf->center == "0") { echo "checked"; }
echo " /> " . $lang['c_center_0'] . "\n<input type=\"radio\" name=\"center\" value=\"1\" ";
if ($bconf->center == "1") { echo "checked"; }
	
echo "
	 /> " . $lang['c_center_1'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_poster'] . "</span><br /><div align=\"justify\">" . $lang['c_poster_desc'] . "</div></td>\n
  <td>\n
	<input type=\"radio\" name=\"poster\" value=\"0\" ";
	
// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconf->poster == "0") { echo "checked"; }
echo " /> " . $lang['c_poster_0'] . "\n<input type=\"radio\" name=\"poster\" value=\"1\" ";
if ($bconf->poster == "1") { echo "checked"; }

echo "
	 /> " . $lang['c_poster_1'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_smileys'] . "</span><br /><div align=\"justify\">" . $lang['c_smileys_desc'] . "</div></td>\n
  <td>\n
	<input type=\"radio\" name=\"smileys\" value=\"0\" ";

// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconf->smileys == "0") { echo "checked"; }
echo " /> " . $lang['c_smileys_0'] . "\n<input type=\"radio\" name=\"smileys\" value=\"1\" ";
if ($bconf->smileys == "1") { echo "checked"; }
echo " /> " . $lang['c_smileys_1'] . "\n<input type=\"radio\" name=\"smileys\" value=\"2\" ";
if ($bconf->smileys == "2") { echo "checked"; }

echo "
	 /> " . $lang['c_smileys_2'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_language'] . "</span><br /><div align=\"justify\">" . $lang['c_language_desc'] . "</div></td>\n
  <td>\n
  	<select name=\"language\">\n";
  
			// this checks for languages files in the ./language/ directory and display them
			$handle = opendir("./language");
    		while ($file = readdir($handle)) {
				if ($file != "." && $file != "..") {
					$filef = substr($file, 0, (strlen($file)-4));
					if ($filef == BLANG) {
						$selec = " selected";
					} else {
						$selec = "";
					}
      	 		echo "<option value=\"" . $filef . "\"" . $selec . "> " . $filef . "</option>\n";
   				}
			}
   			closedir($handle);

			echo "
	</select>\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_limit'] . "</span><br /><div align=\"justify\">" . $lang['c_limit_desc'] . "</div></td>\n
  <td><input type=\"text\" name=\"blimit\" size=\"4\" maxlength=\"3\" class=\"boxes\" value=\"" . stripSlashes($bconf->blog_limit) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_maxwidth'] . "</span><br /><div align=\"justify\">" . $lang['c_maxwidth_desc'] . "</div></td>\n
  <td><input type=\"text\" name=\"maxwidth\" size=\"4\" maxlength=\"3\" class=\"boxes\" value=\"" . stripSlashes($bconf->max_width) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_servertime'] . "</span><br /><div align=\"justify\">" . $lang['c_servertime_desc'] . "</div></td>\n
  <td><input type=\"text\" name=\"servertime\" size=\"4\" maxlength=\"3\" class=\"boxes\" value=\"" . stripSlashes($bconf->servertime) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"./img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\">\n
  <input type=\"submit\" value=\"" . $lang['c_setbutton'] . "\" class=\"buttons\" />&nbsp;&nbsp;\n
  </td>\n
 </tr>\n
</table>\n
</form>\n\n";
		}
		break;
	
	
	case "updateconf": // check password match, and then update the configuration table with the user's custom settings
	
		require ("./includes/functions.php");
		
		if (strcmp($pass, $confpass) == 0) {
			$passok = md5($pass);
		} else if (strcmp($pass, $confpass) != 0) {
			header("Location: ./install.php?action=conf&err=pass");
			exit;
		}
	
		if (strlen($login) > 0 && strlen($pass) > 0 && strlen($bname) > 0 && strlen($burl) > 0 && strlen($aname) > 0 && strlen($aemail) > 0 && strlen($maxwidth) > 0 && strlen($servertime) > 0 && strlen($blimit) > 0) {
			if ($maxwidth < "250") {
				$maxwidth = "250";
			}
			$result = execRequest("UPDATE blogconfig SET login='$login', password='$passok', comments='$comments', center='$center', poster='$poster',
														smileys='$smileys', language='$language', 
														blog_name='" . addSlashes(htmlspecialchars($bname, ENT_QUOTES)) . "', 
														blog_url='" . addSlashes(htmlspecialchars($burl, ENT_QUOTES)) . "',
														blog_path='" . addSlashes(htmlspecialchars($bpath, ENT_QUOTES)) . "',
														author_name='" . addSlashes(htmlspecialchars($aname, ENT_QUOTES)) . "', 
														author_email='" . addSlashes(htmlspecialchars($aemail, ENT_QUOTES)) . "', 
														blog_description='" . addSlashes(htmlspecialchars($bdesc, ENT_QUOTES)) . "', 
														blog_keywords='" . addSlashes(htmlspecialchars($bkeys, ENT_QUOTES)) . "',
														blog_limit='$blimit',
														moblogging='$moblogging',
														mserver='" . addSlashes(htmlspecialchars($mserver, ENT_QUOTES)) . "',
														mport='" . addSlashes(htmlspecialchars($mport, ENT_QUOTES)) . "',
														mtype='$mtype',
														mlogin='" . addSlashes(htmlspecialchars($mlogin, ENT_QUOTES)) . "',
														mpassword='" . addSlashes(htmlspecialchars($mpassword, ENT_QUOTES)) . "',
														resize='$resize',
														max_width='$maxwidth', servertime='$servertime'", $connection);
			
			getSupport($burl, $aemail);
			header("Location: ./install.php?action=done");
			exit;
		} else {
			// on error, get back and notify the user
			header("Location: ./install.php?action=conf&err=fields");
			exit;
		}
		break;
		
		
	case "done": // the installation is correctly done
	
		require ("./includes/functions.php");
		require ("./constants.php");
	
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
			. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      		. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n<head>\n<title>e-moBLOG install procedure: finished!</title>\n"
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
		echo "note: please don't forget to remove the file \"install.php\" from<br />your webhosting account (see HOW-TO.txt file for informations).";
		echo "<br /><br />&nbsp;</div></td></tr></table>";
		break;
}

}

echo "</div></body></html>";

?>