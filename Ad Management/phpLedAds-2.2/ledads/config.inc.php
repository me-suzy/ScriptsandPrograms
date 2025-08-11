<?php

/*
	Config File for phpLedAds v2.x
*/

$placonfig = array(
	// db settings
	db_host		=> 'localhost',
	db_user		=> 'pla',
	db_pass		=> 'pla',
	db_db		=> 'pla',

	// table prefix (pla_<tablename> by default)
	tbl_prefix	=> 'pla',

	// set user name and password to login with
	user		=> 'admin',
	pass		=> 'admin',

	/* set this to false or 0 to disable the graph stuff */
	do_graphs	=> true,

	/*
		set this equal to true if you want to try and
		display only unique ads -- SEE README!
	*/
	display_unique	=> true,
	
	/*
		This goes with previous option
		This will use files if we can't keep apache notes
		See readme
	*/
	extern_unique	=> true,
	
	/*
		This is the lifetime, in seconds, of the file's used to store the cache
		between sessions.
		
		This is *only* effective if the above 2 options
		are set to true.
	*/
	unique_life	=> 10,

	/*
		!! For advanced users only !!
		Set this equal to a mysql connection handle if you want
		Example where $conn is a connection handle
		from mysql_connect( ) (or mysql_pconnect( )):

		conn_handle => &$conn,
	*/
	conn_handle	=> null,
	// you must also mysql_select_db( ) on the handle!

	/*
		web path
		This script attempts to configure out the web path
		automagically. If its doing it wrong (usually noticable on the 'click.php' links)
		Then set this to the *directory* relative to the root of the webpage
		Example: http://mysite.com/ledads is the full web path
		So set this like so:
		web_path => '/ledads',
		Or if you wanted to use the full path
		web_path => 'http://mysite.com/ledads',
		
		But, you can probably just leave it as:
		web_path	=> null,
	*/
	web_path	=> null,

	/*
		set this equal to true to use fill path linking
		you can set this equal to true and set the above
		(web_path) to the full url of the directory these files
		reside in if things don't seem to be linking correctly
	*/
	usefullpath	=> true,
	
	/*
		Popup a notice window when making graphs?
		You can set this to false or 0 if it bugs you
	*/
	popup_dographs	=> true,

	/* other stuff (no need to edit) */
	'authname'	=> 'LedAds',
	'datadir'	=> _extras::catfile(dirname(__FILE__), 'data'),
	'libdir'	=> _extras::catfile(dirname(__FILE__), 'lib')
);

/* end configuration! */

?>