<?php
/***************************************************************************
 *   admin/index2.php
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

// check if language option has already been loaded
if (!defined("BLANG")) {
	$result = execRequest("SELECT language FROM blogconfig", $connection);
	while ($lan = nextLine($result)) {
		define (BLANG, "$lan->language");
	}
}

require ("../language/" . BLANG . ".php");
require ("./constants.php");

// check mobile blogging messages if set as enabled
if (MOBLOGGING == "1") {
	$timenow = time();
	$result = execRequest("SELECT moblog FROM blogconfig", $connection);
	while ($rmoblog = nextLine($result)) {
		if ($timenow > ($rmoblog->moblog + 600)) {
				require ("../moblogging.php");
				$resulta = execRequest("UPDATE blogconfig SET moblog='" . time() . "'", $connection);
		}
	}
}

// print out the headers, menus and javascript needed
print_header2();
print_jscript();
print_top();
print_admin();

// display the error message or status message if there is one from a previous request
if ($err == "fields") {
	echo "<br /><span class=\"error\">" . $lang['field_error'] . "</span>\n\n";
} else if ($err == "fields2") {
	echo "<span class=\"error\">" . $lang['field2_error'] . "</span>\n\n";
} else if ($status == "add") {
	echo "<span class=\"status\">" . $lang['add_status'] . "</span>\n\n";
} else if ($status == "mod") {
	echo "<span class=\"status\">" . $lang['mod_status'] . "</span>\n\n";
} else if ($status == "del") {
	echo "<span class=\"status\">" . $lang['del_status'] . "</span>\n\n";
} else if ($status == "delcomm") {
	echo "<span class=\"status\">" . $lang['delcomm_status'] . "</span>\n\n";
} else if ($status == "conf") {
	echo "<span class=\"status\">" . $lang['conf_status'] . "</span>\n\n";
} else if ($status == "modc") {
	echo "<span class=\"status\">" . $lang['modc_status'] . "</span>\n\n";
}

echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n<tr>\n"
	. "<td class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['a_addpost']) . "</span></td>\n</tr>\n"
	. "<tr>\n<td align=\"center\">";
?>

<form action="modpost.php?action=add" method="post" name="post">
<table cellpadding="4" cellspacing="0" border="0" width="250" align="center">

<?php
// display some form fields only if the right options are set in the config file
if (POSTER == "1") { 
	echo "<tr><td width=\"90\">" . $lang['a_name'] . " *</td><td align=\"right\">\n"
		. "<input type=\"text\" name=\"name\" size=\"30\" maxlength=\"50\" value=\"" . $HTTP_COOKIE_VARS["e-moblog_name"] . "\" class=\"boxes\" /></td></tr>\n"
 		. "<tr><td width=\"90\">" . $lang['a_email'] . " *</td><td align=\"right\">\n"
		. "<input type=\"text\" name=\"email\" size=\"30\" maxlength=\"70\" value=\"" . $HTTP_COOKIE_VARS["e-moblog_email"] . "\" class=\"boxes\" /></td></tr>\n";
}
?>

 <tr>
  <td width="90"><?php echo $lang['a_title']; ?> *</td>
  <td align="right"><input type="text" name="title" size="30" maxlength="50" class="boxes" /></td>
 </tr>
 <tr>
  <td width="90"><?php echo $lang['a_audio']; ?></td>
  <td align="right"><input type="text" name="audio" size="30" maxlength="70" class="boxes" /></td>
 </tr>
 <tr>
  <td width="90"><?php echo $lang['a_quote']; ?></td>
  <td align="right"><input type="text" name="dayquote" size="30" maxlength="256" class="boxes" /></td>
 </tr>
 <tr>
  <td width="90"><?php echo $lang['a_content']; ?> *</td>
  <td align="right"><input type="button" value="<?php echo $lang['a_addline']; ?>" class="buttons" onClick="javascript:addline();" /></td>
 </tr>
 <tr>
  <td colspan="2" align="right"><textarea name="content" cols="55" rows="10" class="boxes"></textarea></td>
 </tr>
 <tr>
  <td colspan="2" align="left"><?php echo $lang['saveimages']; ?>&nbsp;&nbsp;<input type="checkbox" checked="checked" name="saveimages" value="yes" /></td>
 </tr>
 <tr>
  <td colspan="2" align="right">

  <input type="submit" value="<?php echo $lang['a_postbutton']; ?>" class="buttons" />&nbsp;&nbsp;
  <input type="reset" value="<?php echo $lang['a_clearbutton']; ?>" class="buttons" />
  
  </td>
 </tr>
</table>
</form>

<?php

echo "<br />&nbsp;</td></tr><tr>\n<td class=\"blogheader\"><span class=\"blogtitle\">" . strtoupper($lang['a_modtodaypost']) . "</span></td>\n</tr>\n"
	. "<tr>\n<td align=\"center\">";

// establish a DB connection if not done yet
if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

// display the errors if there is one from a previous request
if ($err == "fields") {
	echo "<br /><span class=\"error\">" . $lang['field_error'] . "</span>\n\n";
} else if ($err == "fields2") {
	echo "<span class=\"error\">" . $lang['field2_error'] . "</span>\n\n";
}

// do the DB query and display the last post only to be edited
$result = execRequest("SELECT * FROM blogposts ORDER BY date DESC LIMIT 1", $connection);
while ($lastpost = nextLine($result)) {
	
	echo "

<form action=\"modpost.php?action=mod\" method=\"post\" name=\"post2\">\n
<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"250\" align=\"center\">\n
 <tr>\n
  <td width=\"90\">" . $lang['a_title'] . " *</td>\n
  <td align=\"right\"><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"50\" class=\"boxes\" value=\"" . stripSlashes($lastpost->title) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td width=\"90\">" . $lang['a_audio'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"audio\" size=\"30\" maxlength=\"70\" class=\"boxes\" value=\"" . stripSlashes($lastpost->audio) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td width=\"90\">" . $lang['a_quote'] . "</td>\n
  <td align=\"right\"><input type=\"text\" name=\"dayquote\" size=\"30\" maxlength=\"256\" class=\"boxes\" value=\"" . stripSlashes($lastpost->dayquote) . "\" /></td>\n
 </tr>\n
 <tr>\n
  <td width=\"90\">" . $lang['a_content'] . " *</td>\n
  <td align=\"right\"><input type=\"button\" value=\"" . $lang['a_addline'] . "\" class=\"buttons\" onClick=\"javascript:addline2();\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"right\"><textarea name=\"content\" cols=\"55\" rows=\"10\" class=\"boxes\">" . stripSlashes($lastpost->content) . "</textarea></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"left\">" . $lang['saveimages'] . "&nbsp;&nbsp;<input type=\"checkbox\" name=\"saveimages\" value=\"yes\" /></td>\n
 </tr>\n
 <tr>\n
  <td colspan=\"2\" align=\"right\">\n

  <input type=\"submit\" value=\"" . $lang['a_updatebutton'] . "\" class=\"buttons\" />&nbsp;&nbsp;\n
  <input type=\"reset\" value=\"" . $lang['a_clearbutton'] . "\" class=\"buttons\" />\n
  <input type=\"hidden\" value=\"" . $lastpost->id . "\" name=\"postid\" />\n
  <input type=\"hidden\" value=\"" . $lastpost->monthy . "\" name=\"monthy\" />\n
  
  </td>\n
 </tr>\n
</table>\n\n
</form>\n";	
}

echo "<br /><img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
echo "</td>\n</tr>\n</table>\n\n";

print_footer();

?>