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
$userin = userinchat();
if (!$userin) header("Location: ./"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><? echo chat_name; ?></title>
</head>

<!-- frames -->
<frameset cols="*,150" border="1" framespacing="1" frameborder="1">
	<frameset rows="100,*,20" border="1" frameborder="1" framespacing="1">
	    <frame name="chatform" src="chat_form.php?username=<? echo $_COOKIE['chatusername']; ?>" marginwidth="0" marginheight="0" scrolling="no" frameborder="1" noresize>
	    <frame name="chatted" src="chat_msgs.php" marginwidth="10" marginheight="10" scrolling="auto" frameborder="1" noresize>
	    <frame name="copyright" src="copy.php" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" noresize>
	</frameset>
	<frame name="chatusers" src="chat_users.php" scrolling="auto" noresize marginwidth="10" marginheight="10" frameborder="1">
</frameset>

</html>
