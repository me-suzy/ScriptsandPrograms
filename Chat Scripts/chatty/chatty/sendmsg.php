<?PHP /* $Id$ */
# This file is part of Chatty :)
# Copyright (C) 2003, 2004, 2005 Marco Olivo
#
# Chatty :) is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

include("connect.inc.php");
include("config.inc.php");
include("utils.inc.php");

ignore_user_abort();

if (!isset($username))
	$username = "";
if (!isset($password))
	$password = "";
if (!isset($color))
	$color = "1";

/* security checks */
$username = stripslashes(urldecode($username));

/* is the login valid? */
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = do_the_query($chat_db, $query);

if (mysql_num_rows($result) != 0) {	/* login ok! */
	$failed_data = false;
}
else
	$failed_data = true;

if ($failed_data) {	/* sorry, there is an error*/
	header("Location: http://$your_host/index.php?username=$username");
	exit;
}

if (!isset($color)) {
	$color = random(6);
}

if (isset($msg)) {
	$query = "INSERT INTO msg VALUES ('', '$username', '" . htmlspecialchars(addslashes($msg)) . "', '$color', DATE_ADD(NOW(), INTERVAL $diff_timezone HOUR))";
	do_the_query($chat_db, $query);

	/* update the user so that he is not thrown out of the chat */
	$query = "UPDATE users SET active = 'y', sent_on = DATE_ADD(NOW(), INTERVAL $diff_timezone HOUR) WHERE username = '$username'";
	do_the_query($chat_db, $query);
}

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n";

echo "<HTML>\r\n";
echo "<HEAD>\r\n";
echo "<LINK REL=\"stylesheet\" HREF=\"style.css.php\" TYPE=\"text/css\">\r\n";
echo "</HEAD>\r\n\r\n";

echo "<BODY CLASS=\"chat\">\r\n";

echo "<FORM ACTION=\"$PHP_SELF\" METHOD=\"get\">\r\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"username\" VALUE=\"" . urlencode(addslashes($username)) . "\">\r\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"password\" VALUE=\"$password\">\r\n";
echo "<SPAN CLASS=\"white\">Your message:</SPAN><BR>\r\n";
echo "<INPUT TYPE=\"text\" NAME=\"msg\" VALUE=\"\" SIZE=\"40\" MAXLENGTH=\"255\">\r\n";
echo "<SELECT NAME=\"color\" SIZE=\"1\">\r\n";
echo "<OPTION " . ($color == "1" ? "SELECTED" : "") . " VALUE=\"1\">white</OPTION>\r\n";
echo "<OPTION " . ($color == "2" ? "SELECTED" : "") . " VALUE=\"2\">yellow</OPTION>\r\n";
echo "<OPTION " . ($color == "3" ? "SELECTED" : "") . " VALUE=\"3\">red</OPTION>\r\n";
echo "<OPTION " . ($color == "4" ? "SELECTED" : "") . " VALUE=\"4\">green</OPTION>\r\n";
echo "<OPTION " . ($color == "5" ? "SELECTED" : "") . " VALUE=\"5\">blue</OPTION>\r\n";
echo "<OPTION " . ($color == "6" ? "SELECTED" : "") . " VALUE=\"6\">brown</OPTION>\r\n";
echo "<OPTION " . ($color == "7" ? "SELECTED" : "") . " VALUE=\"7\">violet</OPTION>\r\n";
echo "<OPTION " . ($color == "8" ? "SELECTED" : "") . " VALUE=\"8\">light red</OPTION>\r\n";
echo "<OPTION " . ($color == "9" ? "SELECTED" : "") . " VALUE=\"9\">black</OPTION>\r\n";
echo "</SELECT>\r\n";
echo "<INPUT TYPE=\"submit\" VALUE=\"send\">\r\n";
echo "</FORM>\r\n";

echo "</BODY>\r\n";
echo "</HTML>\r\n";
?>
