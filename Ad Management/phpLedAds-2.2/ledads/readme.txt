/*
 *****************************************************************
 *			       	phpLedAds 2.x
 *
 * This program is distributed as freeware. We are not
 * responsible for any damages that the program causes	
 * to your system. It may be used and modified free of 
 * charge, as long as the copyright notice
 * in the program that give me credit remain intact.
 * If you find any bugs in this program. Please feel free 
 * to report it to bugs@ledscripts.com.
 * If you have any troubles installing this program. Please feel
 * free to post a message on our Support Forum.
 * Selling this script is absolutely forbidden and illegal.
 *
 *****************************************************************
 *
 *	               COPYRIGHT NOTICE:
 *	
 *	         Copyright 2004 Jon Coulter
 *	
 *	      Author:  Jon Coulter
 *	      Web Site: http://www.ledscripts.com
 *	      E-Mail: support@ledscripts.com
 *	      Support: http://www.ledscripts.com/
 *
 *       This program is protected by the U.S. Copyright Law
 *****************************************************************
*/

Requirements:
	PHP 4.1 or greater
	Mysql (3.22+)
	
	* If you want to be able to create graphs:
	GD (Graphics Library)

UPGRADING
===========================
	Upgrading from 2.0 is very simple: reconfigure config.inc.php
	(copying the settings from your current config.inc.php), then reupload
	*all* the files except install.php. There is no need to re-run the
	install.php script.

	To upgrade from version 1.0 (which isn't likely at this point), then
	follow the install instructions and use the import feature in the
	admin panel to import ad stats from 1.0.


INSTALLATION
============================
Here's the quick and dirty:
	- Hardest part (and its pretty easy!): Configuring it!
		- Open config.inc.php and edit the value in the $placonfig array
		- Fill in the correct values for these fields:
		db_host	=> 'localhost', // the host of your mysql database
		db_user	=> 'pla', // the username to login to mysql with
		db_pass	=> 'pla', // the password to login to mysql with
		db_db	=> 'pla', // the database name itself
		
		- Then edit this field:
		tbl_prefix => 'pla',
		  // set it equal to the prefix you want before tables
		  // (this allows you to install multiple copied of the program by changing
		  //  this prefix for each 'copy')
		
		- Then set the login username and password
		- Note that this is the login to the admin.php script, nothing else
		user	=> 'admin',
		pass	=> 'admin',
		// defaults shown
		
		- The other fields in the config are documented in the
		  source file. Feel free to mess around with stuff
	
	- Upload all files (including directories) into a sub-directory of your
		main site.
		
	- chmod steps:
		1) chmod data/ directory to 777
		
	     Here's a bash one-liner you can use if you've got shell access:
		
		chmod -R 777 data/

	- Go to install.php on your site:
		http://www.yoursite.com/ledads/install.php
		
		Follow the on-screen instructions (basically just click the link(s))
	
	- Login to admin.php (default username/password: admin/admin)
		
	- Start adding ads!
	

See below for style settings information

USAGE
============================
	To include the adcode itself:
	(this assumes your files are in www.yoursite.com/ledads/)
	- For html pages, put <!--#include virtual="/ledads/ledad.php"--> where you want
		the ad to show
	- For php pages, put
		<?
			require('path/to/ledads/ad_class.php');
			echo $pla_class->adcode( );
		?>
	where you want the ad to show up
	
	- If you want to include the ad in a page remotely (or on the same server, doesn't matter),
		then use the ledad_js.php url as a <script src=..> file.
		The included jsexample.html is an example of this.
		
	- phpLedAds can now track rich-media clicks. This is a quasi-hacked
	  features, but one that most people really really wanted, so I
	  included it. To use it, you have to insert extra code into the rich
	  media field. Basically, you take whatever the link of the rich media
	  field is going to be, and you pass it as a redirect param in the
	  query string that you pass to rich_click.php (example follows), as
	  well as a 'key' param, but this can be automated.

	  Example:
	  If you had a 'rich' media ad (this is a simplified example) of:
	  <a href="http://myadprovider.ext/foo/?a=1020&b=test"><img src="a.gif"></a>

	  You would put this in the rich media box:

	  <a
	  href="/ledads/rich_click.php?key=[key]&redirect=http://myadprovider.ext/foo/%3fa%3d1020%26b%3dtest"><img
	  src="a.gif"></a>

	  Notice that you *must* do the translation of these char's in your
	  'redirect' param:

	  ? becomes %3f
	  & becomes %26
	  = becomes %3d

	  Also note that [key] is a place older that the application will
	  replace at run-time with the correct value (so put the literal
	  string '[key]' there just as i have it in the example)

Extra Note:
	For those of you that are *nix guru's and decided to download this package
	straight to your server non-windows server (meaning you didn't upload
	all files in ascii mode), some of the cgi files might have
	\r's (carriage returns) (looks like ^M in vi or pico). You can fix this up by running this
	one simple command in the same directory as the phpLedAds files:
		
		perl -pi -e 's/\r//g' *.php

Please e-mail any bugs you find to bugs@ledscripts.com with the details
(such as program name and what you did) so that it can be fixed ASAP.
