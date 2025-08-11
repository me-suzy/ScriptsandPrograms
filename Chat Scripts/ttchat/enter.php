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

clearinactiveusers(); // delete inactive users

if ($_POST) {
	if (isset($_POST['username'])) {
		$result = enterchat($_POST['username'], $_POST['password']);
		if ($result!="") header("Location: ./?msg=".urlencode($result));
	}
} else {
	header("Location: ./");
} ?>