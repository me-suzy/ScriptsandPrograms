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

$userin = userinchat();
if ($userin) {
	header("Location: chatroom.php");
} else { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><? echo chat_name; ?></title>
<link rel="STYLESHEET" type="text/css" href="chatstyles.css">
</head>

<body class="chatmsgsarea" onload="document.forms[0].username.focus()">

<table align="center" background="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr><td align="center">
<NOSCRIPT>You need a browser than can use JavaScript and cookies to enter this room :(</NOSCRIPT>
<? if (isset($_GET['msg'])) echo $_GET['msg']; ?>
<form method="post" action="enter.php">
<table align="center" border="0" cellpadding="0" cellspacing="10">
<tr><td>Username:</td><td><input type="text" name="username" size="15" maxlength="<? echo max_user_len; ?>"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password" size="15" maxlength="10"></td></tr>
<tr>
	<td align="center" colspan="2"><input type="submit" value="ENTER CHATROOM"></td>
</tr>
</table>
</form>
</td></tr>
<tr><td align="center" height="20" style="font-size: 7pt">
<!--// Removing or altering the hyperlinks to our sites in any way invalidates your licence to use this script //-->
<a href="http://www.ttfreeware.com">TTChat</a> originally developed for <a href="http://www.tigertom.com">TigerTom</a> by <a href="http://www.lpin.net">LP Informática</a></td></tr>
</table>

</body>
</html>

<? } ?>