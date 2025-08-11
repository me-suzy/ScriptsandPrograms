<? 
/*
This is TigerTom's Chat Room Software (TTChat).

http://www.tigertom.com
http://www.ttfreeware.com

Copyright (c) 2005 T. O' Donnell

Released under the GNU General Public License, with the
following proviso: 

That the HTML of hyperlinks to the authors' websites
this software generates shall remain intact and unaltered, 
in any version of this software you make.
 
If this is not strictly adhered to, your licence shall be 
rendered null, void and invalid.
*/

include("chat.php");
if (isset($_COOKIE['chatusername'])) {
	if (isset($_GET['ignore'])) {
		if ($_GET['ignore'] == "yes") {
			ignoreuser($_GET['user']);
		} else {
			allowuser($_GET['user']);
		}
		header("Location: chat_users.php");
	} else {
		showusers();
	}
} ?>
