This is TigerTom's Chat Room Software (TTChat).

Version Number: 1.0
Release date: 21 Nov. 2005.

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

-----

Version Number: 1.0
Release date: 21st Nov. 2005.

We've set it up, and tested it, but there may be bugs.
Help us fix these:

Experienced webmasters, please report bugs here:
http://www.tigertom.com/forum/

We will try to maintain a demo version here:
http://www.ttchat.co.uk/ttchat/default.php


CONTENTS OF THIS ARCHIVE
----------------------------

/chat
	chat.php		php functions file, 100% of the chat functions are here
	chat_form.php	form to post messages to the chat
	chat_msgs.php	page that displays the chatted text
	chat_users.php	page that displays the active users
	chatroom.php	frameset page
	chatstyles.css	stylesheet to customize easily the look and feel of the chat
	config.php	main config file, 100% customization is made here
	copy.php	copyright info page
	default.php	chat login page
	enter.php	page used to enter the user into the chat
	exit.php	logout page
	readme.txt	this file, duh!

/chat/smilies		folder with smilies to be used in the chat
	cool.gif
	exclamation.gif
	ignore.gif
	kick.gif
	sad.gif
	smile.gif
	tongue.gif
	wink.gif



INSTALL INSTRUCTIONS
-----------------------

1. Extract the contents of the archive file into a folder on your web. ie: /www/ttchat

2. Open the file 'config.php' in a text editor on your home computer, and follow the instructions there to configure the workings of the chatroom. Upload this file to the chat subdirectory.

3. To customize the look and feel of the chatroom you can open the file 'chatstyles.css' in a text editor and make all the changes that you want.
    The chatroom comes automatically configured to be showed in a 3 frames layout:

	The chatted frame 'chat_msgs.php' is where the chatted text is displayed. The body of this page has a css class of 'chatmsgsarea' assigned to it, so any change that you make to that class in the css file it will be shown in 'chat_msgs.php'.
	
	The chat form 'chat_form.php' is where the chatter writes his message to the chat. The body of this page has a css class of 'chatformarea' assigned to it, so any change that you make to that class in the css file it will be shown in 'chat_form.php'.

	The chatusers file 'chat_users.php' is where the active users list is showed. The body of this page has a css class of 'chatusersarea' assigned to it, so any change that you make to that class in the css file it will be showed in 'chat_users.php'. This file also uses another two css classes wich are:
		'chatuser' to format the other users in the users list.
		'itsme' to format your name in the users list.

GOT ERRORS?
---------------------------------

- FTP upload the file 'ttchat.zip' in BINARY mode only. 

- In the website ttchat directory, CHMOD (change file permissions) of 'msg.txt' to 777, to make it writeable. 

- Sub-directory where files are written to ('dbs'):  CHMOD to 777.

- .php files: CHMOD to 755, except 'config.php'. Leave that alone.

- FTP upload individual .php files in ASCII mode only.

- Don't edit the .php and and .txt files in a word processor, like MS Word. Use a simple text editor like Windows NotePad or EditPad instead.

- Repeat what caused the error, then go quickly to the error log on your control panel that came with your web hosting account. Any clues there?


Genuine bugs can be reported here: http://www.tigertom.com/forum/ 

----------------------------------

MISCELLANEOUS (but IMPORTANT)
--------------------------------

This software is freeware. All we insist is that you retain, as-is, the HTML of hyperlinks 
to our websites it outputs, in any version of the script you make. 
There is no support. 
There are no plans at the moment to develop it further; just to fix any bugs. 
A commercial version, without the hyperlinks, is not available.


== T. O' Donnell, Oct. 2005 ==



