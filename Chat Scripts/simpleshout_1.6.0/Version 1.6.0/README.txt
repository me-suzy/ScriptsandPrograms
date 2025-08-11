-------------------------------------
GENERAL
-------------------------------------
This shoutbox was made by the programming team at Jive Networks Resources.
NEED HELP? software@jivenetworks.com

------------------------------------
COPYRIGHT AND CREDIT
-------------------------------------
- YOU CANT REMOVE ANY COPYRIGHT OR CREDIT LINKS !!!
- YOU CAN EDIT THE SHOUTBOX, BUT CANT SELL, RESELL, REPACKAGE, CLAIM AS YOURS OR LICENSE
- YOU CAN MODIFY THE CODING BUT CANT SELL, RESELL, REPACKAGE, CLAIM AS YOURS OR LICENSE

TO REMOVE LINKS EMAIL software@jivenetworks.com FOR MORE INFORMATION

THIS SOFTWARE IS LICENSED UNDER THE "GNU GENERAL PUBLIC LICENSE":
http://www.gnu.org/copyleft/gpl.html

-------------------------------------
SETUP & INSTALLATION
-------------------------------------
1. Unzip/Unpack php_simpleshout_1_6_0.zip to your desk or server
2. Open config.php - Line 3 requires editing to the correct path of the shoutbox, all others are optional
4. CHMOD all data.dat to 777 (Could be different depending on your server, ask your hosting provider if 777 doesn't work)

-------------------------------------
ADDING TO YOUR WEBSITE
-------------------------------------
USING IFRAMES (INLINE FRAMES) USE THE FOLLOWING:

<IFRAME SRC="http://PATH TO SHOUTBOX/sboard.php" TITLE="My Shoutbox">
Your browser doesn't support iframes:
<a href="http://PATH TO SHOUTBOX/sboard.php">Please view shoutbox here</a>
</IFRAME>

USING PHP INCLUDE:

<?php
include 'http://PATH TO SHOUTBOX/sboard.php';
?>

-------------------------------------
EDITOR CUSTOMIZATION
-------------------------------------
You can edited the first three lines of editor.js.
- You can set these to true and false only.
> helpstat - will display an alert to inform the user about what the function does.
> stprompt - includes a user friendly interface, where the user is prompted to enter the text, and codes are generated.
> basic - codes are generated, but the user has to enter the text manually.

-------------------------------------
UPDATING
-------------------------------------
To upgrade simply upload all files except those with .dat, and .db file extensions.
If you upload files with .dat, and .db file extensions you will lose stored messages and settings for properties / functions.

-------------------------------------
CHANGELOG
-------------------------------------
- ADDED: 3 new bbcodes.
- ADDED: 14 new smilies.
- ADDED: Users online has been added.
- ADDED: IP banning has been added.
- MODIFIED: Rich Text Editor updated with the new bbcodes and smilies.