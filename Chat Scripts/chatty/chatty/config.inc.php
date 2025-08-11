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

/* colors */
$darkyellow = "#FF9900";
$red = "#FF0000";
$white = "#FFFFFF";
$blue = "#000099";
$darkblue = "#CCCCFF";
$lightblue = "#666699";
$black = "#000000";
$yellow = "#FFFF00";
$green = "#009900";
$violet = "#990099";
$brown = "#996633";
$gray = "#666666";

/* logo URL */
$logo_url = "http://URL_TO_YOUR_LOGO/";

/* host specification */
$your_host = "yourhost.com";
$mail_address = "webmaster@yourhost.com";

/* name of the chat-db */
$chat_db = "chatty";

/* difference, in hours, between local server time and your timezone */
$diff_timezone = "0";

/* the time (in seconds) to refresh the list of the users (in seconds) */
$refresh_users_every = "300";

foreach ($_REQUEST as $key=>$value) $$key = $value;
foreach ($_SERVER as $key=>$value) $$key = $value;
?>
