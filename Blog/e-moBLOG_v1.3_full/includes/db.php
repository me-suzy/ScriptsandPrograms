<?php
/***************************************************************************
 *   includes/db.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " weblog engine
 *
 *   This program is a free software. You can modify it as you wish, though
 *   we would just appreciate if you could keep the copyright notice on the
 *   pages (including the engine version and link)  even if you should feel
 *   free to add your own copyright if you modified and enhanced the code.
 *
 *   Please note though that, this software being copyrighted means that the
 *   whole code (or part of it) is.  You should thus not sell any version of
 *   this program, neither any modified version of it using part of the fol-
 *   lowing code. Moreover, please do not use it for commercial purposes.
 *
 ***************************************************************************/

// define constants used to connect to MySQL
// please edit this file correctly as explained in the HOW-TO.txt file!

define (NAME, "your database username");
define (PASSWD, "your database password");
define (SERVER, "localhost");
define (BASE, "the name of your database");



// Please note that if your MySQL server requires a specific port to be used
// instead of the default one, you can change the SERVER line like this:
//
// instead of:
// define (SERVER, "localhost");
//
// use:
// define (SERVER, "localhost:port");
//
// and replace "port" by the right port to use to connect to the database.

?>