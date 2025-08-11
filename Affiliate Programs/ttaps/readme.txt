This is TigerTom's Affiliate Program Software (TTAPS).

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
http://www.ttwebmaster.com/ttaps/associate.php

----------------------------
CONTENTS OF THIS ARCHIVE
----------------------------

	admin.php	program administration file.
	affil.php	redirect script to be used by the affiliate to link to the main site.
	affiliate_join.php	signup form for new affiliates to join the program.
	affiliate_stats.php	script to show the affiliates his stats.
	associate.php	shows general info and links for the new affiliates.
	button.gif	image used in the default skin of the program.
	commission.php	script that assigns the commissions to the affiliate.
	config.php	main configuration file.
	functions.php	main php general functions file.
	getcode.php	script to get the affiliate code to link to the main site.
	gradient20.gif	image used in the default skin of the program.
	gradient36.gif	image used in the default skin of the program.
	mainII.css	stylesheet used to customize the program interface.
	password_reminder.php	script to recover the affiliate login data.
	readme.txt	this file :)
	thanks.html	thank you page showed to the user after a purchase.
	validate.php	script used to validate an affiliate after he signs up.

	/affiliates	folder in which the affiliates individual sales log are going to be stored, needs write permissions.

	/templates	folder containing all the html templates of the program as well as a copy of the main stylesheet for tests purposes.

	/dbs		folder where will be stored the general databases: affiliates.dat, paired.dat, referrals.dat and sales.dat, needs write permissions

INSTALL INSTRUCTIONS
-----------------------

1. Extract the contents of the archive into a folder on your web. ie: /www/ttaps
   This folder and the affiliates subfolder should have write permissions so the app can write to the text files.

2. Open a copy of the file 'config.php' on your home computer, and follow the instructions 
   in the CONFIGURE THE PROGRAM section of this readme file to fully configure your version of this script.

3. Upload 'config.php' to the affiliate directory.

4. To customize the look and feel of the program you can open the file 'main.css' located at the script root folder in a text editor and make all the changes that you want. Refer to the CUSTOMIZE THE LOOK AND FEEL section of this readme file for more instructions on how to do this.


CONFIGURE THE PROGRAM
-------------------------

The file 'config.php' is simply a list of constants that the script will use. This constants must be set in the following format:

define("string_variable_name", "Value of a string constant");
define("number_variable_name", 10);

This means that the constants that will store some kind of text should be enclosed in quotes and the ones that will store some kind of a number should NOT be enclosed in any kind of character, is should have only the corresponding number.
This file can have any number of blank lines that you want and if you want to add some comments to it be sure to use the regular PHP comment characters: "//" (without the quotes) to start each line of a comment or "/*" and "*/" (without the quotes) for multiline comments.

Refer to the 'config.php' file for instructions on the different constants included.


GOT ERRORS?
---------------------------------

- FTP upload the file 'ttchat.zip' in BINARY mode only. 

- FTP upload individual .php files in ASCII mode only. 

- Don't edit the .php and and .dat files in a word processor, like MS Word. Use a simple text editor like Windows NotePad or EditPad instead.

- Change permissions of sub-directories, where files are written to, to be readable and writeable ('affiliates', 'dbs') e.g. at the command line type:  CHMOD 777 affiliates dbs.

- Change permissions of (CHMOD) .php files to 755, except 'config.php'. Leave that alone.

- IMPORTANT: The constants 'email_affiliates' and 'from_email' in the 'config.php' file HAVE to be valid email addresses, because these are the email addresses that the program is using to send the mails from and this is a requirement for the php mail function to work.

- Repeat what caused the error, then go quickly to the error log on your control panel that came with your web hosting account. Any clues there?


Genuine bugs can be reported here: http://www.tigertom.com/forum/ 


CUSTOMIZE THE LOOK AND FEEL
-------------------------------

To do this you have two options, you can use anyone of them or both.

1. Change the main stylesheet main.css located at the script root folder.

This stylesheet uses the following html elements: body, h1, h2, input, textarea, th, td, p, pre, a, a:hover. And the following custom classes: red, whitw, errormsg, button and fullwidth. You can add, edit or delete any of the elements included in this stylesheet to match the look and feel of your site.

2. Edit the html templates located in the templates folder.

This html files use the most simple an optimized html code possible BUT all of them include some variable names enclosed between "[" and "]" without the quotes that the program uses to change them for the dynamic data. You can change all the look and feel of these templates that you want but you HAVE TO KEEP all the variables included in the files for the script to work properly. If you delete or change any of these variables you better know what you are doing or the script could start to fail.

Since this program is based on templates you can do both things like i mentioned before meaning that you can use your own custom css file and your own custom html files, but remember to include the variables used in each file. Working this way the customization options are endless.


== Leonardo Panzardo, Oct. 2005 ==


EXAMPLE LINKS
--------------------------------

A typical affiliate link for a web page, where 'tig3rt0m' is the 
affiliate nickname or username:
http://www.yourdomain.com/ttaps/affil.php?affil=tig3rt0m

Basic information page for affiliates: 
http://www.yourdomain.com/ttaps/associate.php 

How you activate commission credits:
http://www.yourdomain.com/ttaps/commission.php?comm=750 (for a $7.50 commission)
http://www.yourdomain.com/ttaps/commission.php?price=3500&percent=15 (for a 15% commission of a $35 product)

(The latter would be used in a shopping cart script. You would need to 
alter the code in your shopping cart so that the TTAPS script URL is the last
URL the cart redirects to, and so that your cart puts the values of 'price' and 'percent' 
in the URL correctly.)

See 'config.php' to alter the payout threshold, and the upline commission.
  
Your admin page: 
http://www.yourdomain.com/ttaps/admin.php (you can get the username and password to access this from the 'config.php' file)

HOW IT WORKS
-----------  

A surfer clicks on an affiliate hyperlink. 
'affil.php' sets a cookie with the affiliate's username as a value.
The surfer is redirected to the merchant's website.
If the surfer subsequently buys a product from that site, the 'commission.php' file should be called at the end of the purchase.
The script recognises the affiliate cookie, and credits that affiliate's account accordingly.


MISCELLANEOUS (but IMPORTANT)
--------------------------------

This software is freeware. All we insist is that you retain, as-is, the HTML of hyperlinks 
to our websites it outputs, in any version of the script you make. 
There is no support. 
There are no plans at the moment to develop it further; just to fix any bugs. 
A commercial version, without the hyperlinks, is not available.


== T. O' Donnell, Oct. 2005 ==


