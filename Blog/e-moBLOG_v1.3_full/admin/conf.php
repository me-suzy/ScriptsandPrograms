<?php
/***************************************************************************
 *   admin/conf.php
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

// print headers, menus and such
print_header2();
print_top();
print_admin();

if ($err == "fields2") {
	echo "<span class=\"error\">" . $lang['field2_error'] . "</span>\n\n";
}

// do the DB query to obtain the current configuration options, then echo the filled form
$result = execRequest("SELECT * FROM blogconfig", $connection);
while ($bconfig = nextLine($result)) {
	echo "

<form action=\"modpost.php?action=conf\" method=\"post\">\n
<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"650\">\n
 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_general']) . "</span></td>\n
 </tr>\n
 
 <tr>\n
  <td><span class=\"config\">" . $lang['c_bname'] . "</span> *<br />" . $lang['c_bname_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"bname\" size=\"60\" maxlength=\"50\" class=\"boxes\" value=\"" . stripSlashes($bconfig->blog_name) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_burl'] . "</span> *<br />" . $lang['c_burl_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"burl\" size=\"60\" maxlength=\"100\" class=\"boxes\" value=\"" . stripSlashes($bconfig->blog_url) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_aname'] . "</span> *<br />" . $lang['c_aname_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"aname\" size=\"60\" maxlength=\"70\" class=\"boxes\" value=\"" . stripSlashes($bconfig->author_name) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_aemail'] . "</span> *<br />" . $lang['c_aemail_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"aemail\" size=\"60\" maxlength=\"70\" class=\"boxes\" value=\"" . stripSlashes($bconfig->author_email) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_bdesc'] . "</span><br />" . $lang['c_bdesc_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"bdesc\" size=\"60\" maxlength=\"256\" class=\"boxes\" value=\"" . stripSlashes($bconfig->blog_description) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_bkeys'] . "</span><br />" . $lang['c_bkeys_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"bkeys\" size=\"60\" maxlength=\"256\" class=\"boxes\" value=\"" . stripSlashes($bconfig->blog_keywords) . "\" /></td>\n
 </tr>\n
	
 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_moblogging']) . "</span></td>\n
 </tr>\n
 
 <tr>\n
  <td><span class=\"config\">" . $lang['c_moblogging_state'] . "</span> *<br />" . $lang['c_moblogging_desc'] . "</td>\n
  <td>
	<input type=\"radio\" name=\"moblogging\" value=\"0\" ";

	// the script checks which option is actually set in the config to pre-check the corresponding radio button
	if ($bconfig->moblogging == "0") { echo "checked"; }
	echo " /> " . $lang['c_moblogging_0'] . "\n<br /><input type=\"radio\" name=\"moblogging\" value=\"1\" ";
	if ($bconfig->moblogging == "1") { echo "checked"; }
	echo " /> " . $lang['c_moblogging_1'] . "\n
	
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mserver'] . "</span><br />" . $lang['c_mserver_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"mserver\" size=\"60\" maxlength=\"200\" class=\"boxes\" value=\"" . stripSlashes($bconfig->mserver) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mport'] . "</span><br />" . $lang['c_mport_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"mport\" size=\"6\" maxlength=\"5\" class=\"boxes\" value=\"" . stripSlashes($bconfig->mport) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mtype'] . "</span><br />" . $lang['c_mtype_desc'] . "</td>\n
  <td>
	<input type=\"radio\" name=\"mtype\" value=\"pop3\" ";

	// the script checks which option is actually set in the config to pre-check the corresponding radio button
	if ($bconfig->mtype == "pop3") { echo "checked"; }
	echo " /> " . $lang['c_mtype_0'] . "\n<br /><input type=\"radio\" name=\"mtype\" value=\"imap\" ";
	if ($bconfig->mtype == "imap") { echo "checked"; }
	echo " /> " . $lang['c_mtype_1'] . "\n

  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mlogin'] . "</span><br />" . $lang['c_mlogin_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"mlogin\" size=\"60\" maxlength=\"200\" class=\"boxes\" value=\"" . stripSlashes($bconfig->mlogin) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_mpassword'] . "</span><br />" . $lang['c_mpassword_desc'] . "</td>\n
  <td align=\"right\"><input type=\"password\" name=\"mpassword\" size=\"60\" maxlength=\"200\" class=\"boxes\" value=\"" . stripSlashes($bconfig->mpassword) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_absolute'] . "</span><br />" . $lang['c_absolute_desc'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"bpath\" size=\"60\" maxlength=\"250\" class=\"boxes\" value=\"" . stripSlashes($bconfig->blog_path) . "\" /></td>\n
 </tr>\n
 
 <tr>\n
  <td colspan=\"2\" class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['c_options']) . "</span></td>\n
 </tr>\n
 
 <tr>\n
  <td><span class=\"config\">" . $lang['c_resize'] . "</span> *<br />" . $lang['c_resize_desc'] . "</td>\n
  <td>\n
	<input type=\"radio\" name=\"resize\" value=\"0\" ";

// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconfig->resize == "0") { echo "checked"; }
echo " /> " . $lang['c_moblogging_0'] . "\n<br /><input type=\"radio\" name=\"resize\" value=\"1\" ";
if ($bconfig->resize == "1") { echo "checked"; }
echo " /> " . $lang['c_moblogging_1'] . "\n

  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_comments'] . "</span> *<br />" . $lang['c_comments_desc'] . "</td>\n
  <td>\n
	<input type=\"radio\" name=\"comments\" value=\"0\" ";

// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconfig->comments == "0") { echo "checked"; }
echo " /> " . $lang['c_comments_0'] . "\n<br /><input type=\"radio\" name=\"comments\" value=\"1\" ";
if ($bconfig->comments == "1") { echo "checked"; }
echo " /> " . $lang['c_comments_1'] . "\n<br /><input type=\"radio\" name=\"comments\" value=\"2\" ";
if ($bconfig->comments == "2") { echo "checked"; }
	
echo "
	/> " . $lang['c_comments_2'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_center'] . "</span> *<br />" . $lang['c_center_desc'] . "</td>\n
  <td>\n
	<input type=\"radio\" name=\"center\" value=\"0\" ";

// the script checks which option is set by default in the config to pre-check the corresponding radio button
if ($bconfig->center == "0") { echo "checked"; }
echo " /> " . $lang['c_center_0'] . "\n<br /><input type=\"radio\" name=\"center\" value=\"1\" ";
if ($bconfig->center == "1") { echo "checked"; }
	
echo "
	 /> " . $lang['c_center_1'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_poster'] . "</span> *<br />" . $lang['c_poster_desc'] . "</td>\n
  <td>\n
	<input type=\"radio\" name=\"poster\" value=\"0\" ";
	
// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconfig->poster == "0") { echo "checked"; }
echo " /> " . $lang['c_poster_0'] . "\n<br /><input type=\"radio\" name=\"poster\" value=\"1\" ";
if ($bconfig->poster == "1") { echo "checked"; }

echo "
	 /> " . $lang['c_poster_1'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_smileys'] . "</span> *<br />" . $lang['c_smileys_desc'] . "</td>\n
  <td>\n
	<input type=\"radio\" name=\"smileys\" value=\"0\" ";

// the script checks which option is actually set in the config to pre-check the corresponding radio button
if ($bconfig->smileys == "0") { echo "checked"; }
echo " /> " . $lang['c_smileys_0'] . "\n<br /><input type=\"radio\" name=\"smileys\" value=\"1\" ";
if ($bconfig->smileys == "1") { echo "checked"; }
echo " /> " . $lang['c_smileys_1'] . "\n<br /><input type=\"radio\" name=\"smileys\" value=\"2\" ";
if ($bconfig->smileys == "2") { echo "checked"; }

echo "
	 /> " . $lang['c_smileys_2'] . "\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_language'] . "</span> *<br />" . $lang['c_language_desc'] . "</td>\n
  <td>\n
  	<select name=\"language\">\n";
  
// this calls the function which checks for languages files in the ./language directory and display them
getLang();

echo "
	</select>\n
  </td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_limit'] . "</span> *<br />" . $lang['c_limit_desc'] . "</td>\n
  <td><input type=\"text\" name=\"blimit\" size=\"4\" maxlength=\"3\" class=\"boxes\" value=\"" . stripSlashes($bconfig->blog_limit) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_maxwidth'] . "</span> *<br />" . $lang['c_maxwidth_desc'] . "</td>\n
  <td><input type=\"text\" name=\"maxwidth\" size=\"4\" maxlength=\"3\" class=\"boxes\" value=\"" . stripSlashes($bconfig->max_width) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>\n
  <td><span class=\"config\">" . $lang['c_servertime'] . "</span> *<br />" . $lang['c_servertime_desc'] . "</td>\n
  <td><input type=\"text\" name=\"servertime\" size=\"4\" maxlength=\"3\" class=\"boxes\" value=\"" . stripSlashes($bconfig->servertime) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\"><img src=\"../img/line.gif\" width=\"100%\" height=\"1\" alt=\"line\" /></td>\n
 </tr>\n
 <tr>
  <td colspan=\"2\">&nbsp;</td>
 </tr>
 <tr>
  <td colspan=\"2\"><span class=\"config\">" . $lang['required'] . "</span></td>
 </tr>
 
 <tr>\n
  <td colspan=\"2\">\n

  <input type=\"submit\" value=\"" . $lang['c_setbutton'] . "\" class=\"buttons\" />&nbsp;&nbsp;\n
  
  </td>\n
 </tr>\n
</table>\n
</form>\n\n";
}

print_footer();

?>