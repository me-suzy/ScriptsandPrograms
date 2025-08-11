<?php

//### MYSQL DATABASE INFORMATION #######################################################################
// The location of your SQL server.  Leave alone unless you know otherwise:
$dbServer="localhost";
// The name of your database:
$dbName="replace";
// The username to the database:
$dbuserName="replace";
// The password to the database:
$dbpassword="replace";

//### ADMINISTRATION CONTROL PANEL #######################################################################
// Administration Panel Username
$admin_username="admin";
// Administration Panel Password
$admin_password="password";


//### chatbox SETTINGS #######################################################################
/* If you want your page to remain XHTML valid, you will need to include the stylesheet in the header of your page.
// You can do so by pasting in <?php include ('stylesheet.php'); ?> in the header of the same file you will include the chatbox file
// If you include the stylesheet in your header, change the following setting to NO .
// If you don't know what to do othersise, leave it the way it is ( YES ) */
$include_stylesheet="NO";
// How many many messages would you like to be displayed:
$CountLimit=15;
// Flood Controll = How long users must wait to post again (in seconds) set to 0 if you dont want it.
$flood_time=20;


// Do you want to filter bad words?  If so leave it set to 1 .  Otherwise, set it to the number 0 .
$filter_bad_words=1;
// If you set it to true, you may want to cusomize what you want to filter out.
// Try to follow the pattern.  The left side is the word you dont want, and the words on the right are what you want to replace it with.
// To avoid replacing common text inside of a word (you don't want to turn masses into m***es ), it is wise to add a space before and after the word, and in the replacing word. 
// If it's a word that you don't want to appear ever, even in the middle of a word, don't have spaces.
$badwords = array(
	// " badword "  => " replace ",
	"fuck"		=>	"****",
	"bitch"	=>	"*****",
	"shit "	=>	"****",
	"pussy"	=>	"*****",
	"dick"		=>	"****",
	" ass "		=>	" *** ",
	" cunt "		=>	" **** ",
	);

?>
