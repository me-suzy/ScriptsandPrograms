<?php

/************************************
the version of G-Shout
don't change it, for updating purpose
*************************************/
$version = "1.3.1";

/************************************************************************/
/* G-Shout : Gravitasi Shoutbox                                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2005 by Yohanes Pradono                                */
/* http://gravitasi.com                                                 */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

/***************************************

NOTICE NOTICE NOTICE
For security reasons, you MUST rename and set the $datafile file and $logfile file (default are 'default.dat' and 'default.log') to be writeable. 
From telnet you can type: 
chmog ugo+w default.dat
chmog ugo+w default.log
or 
chmod 0666 default.dat
chmod 0666 default.log (this sets writeable and readable to all -rw-rw-rw-)

From FTP you can set writeable and readable to all -rw-rw-rw-
Please refer to manual for other FTP programs.

DO NOT DELETE index.html file INSIDE DIRECTORY "SECRET"

It would be better if you move directory "secret" to other directory inside your server
and then 

Ask your friend if you're in deep trouble :)

***************************************/

/*
// to prevent direct access
*/
if (eregi("config.php",$_SERVER['PHP_SELF'])) {
	die("<b>Access Denied!</b><br /><i>You can't access this file directly...</i><br /><br />- G-Shout -");
}



/* -------------------- BEGIN EDIT HERE ------------------- */



/* ADMIN LOGIN */

/* Password for logging in to Control Panel */
$admin_password = "gshout";

/* 
// Please rename the directory that contains default.dat and default.log file 
// to something hard to be guessed.
*/
$secret_dir = "_secret";

/* change these 2 file's names to something hard to be guessed */
$database = "default.dat";
$log = "default.log";


/*******************
You can edit the variables below later when you are logged in, and go to 'Edit Configuration' page
********************/

/* a question if you forget your password */
$secret_question = "Who is the author of G-Shout ?";
$secret_answer = "donie";

/* themes for admin control panel */
$skin = "default";

/* choose your language file inside languages/ directory */
$language = "english";

/* 
// protected nick, prevent visitors to use your nick and 
// this is used to display your name when you reply their messages
*/
$namaadmin = "yourNick";

/* your own web site */
$adminweb = "http://www.yoursite.com";

/*
// Option whether you want to keep the last ... entries, and shouts before them, will be auto deleted.
// ex: $keep = "20";
// set to $keep = "all"; if you want to keep all shouts.
*/
$keep = "200";

/*
// This is to avoid flooding. The person have to wait for another $floodwait minutes to post another messages. 
// Set it to '0' to disable it.
*/
$floodwait = "1";

/* the amount of comments shown. */
$commentshown = "40";

/* if idle within these minutes, automatic logged out */
$autologout = "20";

/*
// If a user posts, they can delete that post within $deletetime minutes of
// it being posted, as long as they have the same IP address as when they 
// posted it.
// If you don't want deleting, set to -1. Default is 20.
*/
$deletetime = "20";

/* keep the last ... logs, all logs before these last logs will be auto-deleted. */
$lastlogs = "250";

/* maximum characters for each comments. Set it 0 (zero) if you don't want to limit it. */
$maxchars = "160";

/*
// useful if the form becomes one with shoutbox.
// use cookie control to save name and url/email so that returning visitor don't have to retype it.
*/
$usecookie = "no";

/* text wrapping to avoid horizontal scrollbars for visitor who wrote long unbroken word. */
$usetextwrapping = "yes";

/*
// the width of the text wrapping. The value is relative to the font width. The width of 'A' is not the same as 'i'.
// Try checking it by using multiple A's (AAAAAAAAA and on) until it fits your frame.
*/
$textwrappingwidth = "84";

/*
//the character used to seperate wrapped words. '- ' means will be seperated like this: abcde- fghi.
// Empty ('') means disabling wordwrapping. use ' ' (space) for textwrapping without separator.
*/
$wrappingseparator = "- ";

/* Are visitors required to fill Web/Email field? */
$require_uri = "no";

/*
// this will change any url or emails INSIDE the COMMENT to url. Example: 'www.yourdomain.com' will be changed to
// '<a href="http://www.yourdomain.net" target="_blank">www.yourdomain.net</a>'.
*/
$useHTMLencode = "yes";

/*
// the text replacement for $useHTMLencode. This is used to save space. It can be '[LINK]' or anything else. 
// Leave it blank ('') to let the original url shown. Example: if $urltextreplacement is '[LINK]', 
// the www.yourdomain.com will be turned into <a href="http://www.yourdomain.com" target=_blank>[LINK]</a>.
// This feature will only be useful if $useHTMLencode is set to "yes".
*/
$urltextreplacement = '[LINK]';

/*
// show advertising. It will show the ad written below. You are given the permission to set this 
// variable to "no" if you follow the instruction above (The COPYRIGHT INFRINGEMENT section) ("yes"/"no")
*/
$showad = "no";

/*
// the ad text. You may change it as long as it refers to G-Shout Website.
// This will only shows if you set the $showad to "yes".
*/
$_____COPYRIGHT_____ = 'Copyright &copy; <a href="http://gravitasi.com" target="_blank">Gravitasi</a>';


/*****************
  EMAIL SETTINGS
*****************/

/*
// If you want to receive every comments written to shoutbox via email, set this variable to "yes".
*/
$sendcomments = "no";

/* your email address */
$emailaddress = "email@yoursite.com";

/* copy carbon will be sent to. Set to '' to disable it. */
$ccmail = "";

/* blind copy carbon will be sent to. Set to '' to disable it. */
$bccmail = "";


/*************
  appearance
*************/

/*
// the allowed tags used in the shoutbox. Format must not be changed. No space allowed.
// Just write the entities for tags with argument. Example: <a><font> etc. Set it empty to disable it.
*/
$allowedtags = "<b><u><i>";

/* place horizontal rulers to seperate each comments */
$hr = "yes";


/**********
  smileys
**********/

/* do you want to use smiley? ("yes"/"no") */
$usesmiley = "yes";

/* the smiley directory. Don't forget the underlying backslash. */
$smileydir = './images/emoticons/';

$smileys = array (
	":)" => "icon_smile.gif",
	":D" => "icon_biggrin.gif",
	":))" => "icon_lol.gif",
	"=))" => "icon_ngakak.gif",
	":P" => "icon_razz.gif",
	":p" => "icon_razz.gif",
	";)" => "icon_wink.gif",
	":D~" => "icon_slurp.gif",
	":\">" => "icon_redface.gif",
	":|" => "icon_mmm.gif",
	":(" => "icon_sad.gif",
	":o" => "icon_surprised.gif",
	":s" => "icon_worried.gif",
	":((" => "icon_cry.gif",
	":zzz:" => "icon_zzz.gif",
	"8)" => "icon_cool.gif",
	":*" => "icon_kiss.gif",
	":x" => "icon_wek.gif",
	":mad:" => "icon_mad.gif",
	":evil:" => "icon_evil.gif",
	":roll:" => "icon_rolleyes.gif",

/*
copy paste template below	
**********************
	"the_text" => "the_image.gif",	
***********************	

add yours below!	
*/	
    ":tt:" => "icon_applause.gif",
    ":v:" => "icon_pis.gif",
    "hihihi" => "icon_hihihi.gif",
    ":$:" => "icon_duit.gif",
    ":!:" => "icon_exclaim.gif",
	":?:" => "icon_question.gif",

/*
Limit of additions. Add only above this comment
*/
	":idea:" => "icon_idea.gif"
);



/************
  TIME
************/

/* Your time different with GMT  , GMT + ? */
$gmt = "7";

/* the syntax is same with PHP date() function - http://www.php.net/date */
$dateformat = "l, d F Y H:i";



/* -------------------- STOP EDITING HERE ------------------- */



/***********************************************************************

Configurations below for admin panel when viewing shout entries and logs

************************************************************************/

$results = "20";
$logsperpage = "25";


/********************************
DON'T TOUCH THESE FOLLOWING CODES
********************************/
//adjusting new version with old version
$datafile = $secret_dir.'/'.$database;
$logfile = $secret_dir.'/'.$log;
$datapath = $datafile;
$logpath = $logfile;
?>