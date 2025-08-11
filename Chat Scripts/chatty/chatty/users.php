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

if (!isset($username))
	$username = "";
if (!isset($password))
	$password = "";

/* security checks */
$username = stripslashes(urldecode($username));

header("Expires: Sun, 28 Dec 1997 09:32:45 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Refresh: " . $refresh_users_every);	/* refresh users' list every $refresh_users_every seconds */

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n";

echo "<HTML>\r\n";
echo "<HEAD>\r\n";
echo "<LINK REL=\"stylesheet\" HREF=\"style.css.php\" TYPE=\"text/css\">\r\n";
echo "</HEAD>\r\n\r\n";

echo "<BODY CLASS=\"chat\">\r\n";

/* delete users inactive for 2 minutes */
$sent_on = date("YmdHis", time() - 120);	/* 2 minutes ago*/
$query = "UPDATE users SET active = 'n' WHERE sent_on < '$sent_on'";
do_the_query($chat_db, $query);

echo "<DIV CLASS=\"center\">\r\n";

echo "<A HREF=\"logoff.php\" CLASS=\"chat\" TARGET=\"_top\">Logoff</A><BR>&nbsp;<BR>\r\n";

$query = "SELECT * FROM users WHERE active = 'y'";
$result = do_the_query($chat_db, $query);

echo "<SPAN CLASS=\"notes\">\r\n";
echo "<B>" . mysql_num_rows($result) . " user(s) in the chat:</B><BR>\r\n";

while ($row = mysql_fetch_array($result)) {
	echo stripslashes($row["username"]) . "<BR>\r\n";
}

if (mysql_num_rows($result) == 0) {
	echo "No user in the chat<BR>\r\n";
}
mysql_free_result($result);

echo "&nbsp;<BR>\r\n";
echo "</SPAN>\r\n";

echo "<BR>&nbsp;<BR>\r\n";
echo "<SPAN CLASS=\"smallwhite\">Comments? Suggestions? <A HREF=\"mailto:$mail_address\" CLASS=\"chat\">$mail_address</A></SPAN>\r\n";
echo "</DIV>\r\n";

echo "</BODY>\r\n";
echo "</HTML>\r\n";
?>
