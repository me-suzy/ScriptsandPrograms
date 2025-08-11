<?php
//////////////////////////////////////////////////////////////////////////// 
// ltw_config.php 
// $Id: ltw_install.php,v 1.11 2003/08/16 13:09:25 t51admin Exp $ 
// 
// ltwCalendar Installer 
////////////////////////////////////////////////////////////////////////////
// needed files
require_once('./private/ltw_config.php');	
require_once($ltw_config['include_dir'].'/ltw_classes.php');

//the following lines are added for backwards compatibility for pre 4.1.0 PHP versions.. 
if ( !isset($_POST) 	) $_POST = $HTTP_POST_VARS;
if ( !isset($_REQUEST)) $_REQUEST = $HTTP_GET_VARS;
//end backward compatibility
 
// page header
echo "
<html>
<head><title>ltwCalendar (4.0) Installer</title></head>
<body>
<b>ltwCalendar Installer (v4.0)</b><br>
 ";

// if no command passed, welcome
if ( empty($_REQUEST['command']) ){
	echo "
	This script will install a new ltwCalendar database if one is not defined,<br> 
	or upgrade an existing V2.x or 3.x database to work with version 4.0.<br><br>
	<b>Before running this process</b><br>
	It is <b><i>highly recommended</b></i> you back up your existing database structure and contents.<br>
	The script will alter existing tables to add columns needed for v4.0 to work properly.<br><br>
	<A href=\"".$_SERVER['PHP_SELF']."?command=install\">Click to continue</A>
	";
	return;
}

// check for needed config parameters
$errors = '';
if ( empty($ltw_config['db_type'])   ) $errors .= "Missing 'db_type' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_server']) ) $errors .= "Missing 'db_server' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_user'])   ) $errors .= "Missing 'db_user' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_pass'])   ) $errors .= "Missing 'db_pass' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_name'])   ) $errors .= "Missing 'db_name' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_server']) ) $errors .= "Missing 'db_server' parameter in ltw_config.php<br>";

if ( empty($ltw_config['db_table_users'])   ) $errors .= "Missing 'db_table_users' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_table_calendar'])) $errors .= "Missing 'db_table_calendar' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_table_category'])) $errors .= "Missing 'db_table_category' parameter in ltw_config.php<br>";
if ( empty($ltw_config['db_table_log'])     ) $errors .= "Missing 'db_table_log' parameter in ltw_config.php<br>";
if ( !empty($errors) ) die($errors);

// I need my objects now
$db   = new ltwDb;
$auth = new ltwAuth;
$user = new ltwUser;

$showForm = 0;
$errors   = '';
$rstr     = '';

// If Submit was pressed, then we are going to
// create the user account in the db
if ( $_REQUEST['command'] == 'user' ){
	if ( empty($_POST['Submit']) ){
		$showForm = 1;
	}else{
		if (  empty($_POST['uname'])	){
			$errors .= "Missing username<br>";
		}else{
			if ( $user->findByName($_POST['uname']) ){
				$errors = "Username <b>".$_POST['uname']."</b> already exists.<br>";
			}else{
				$rstr = $auth->isPasswordValid($_POST['uname'],'',$_POST['pword'], $_POST['pwa']);
				if ( !empty($rstr) ) $errors .= $rstr;
			}

			// show the form if any errors!
			if ( !empty($errors) ){
				$showForm = 1;
			}else{
			 	$user->username  	= $_POST['uname']; 
				$user->password  	= crypt($_POST['pword'],$ltw_config['salt']);
				$user->email 	 	= $_POST['email'];
				$user->status    	= 0;
				$user->privledges	= UPADMIN;
				$user->bad_logins	= 0;
				$user->last_pw_change	= date("Y-m-d H:I:s");
				$user->create();
				
				echo "
				<br>Added Administrator Account <b>".$_POST['uname']."</b><br><br>
				At this point, <b>you should delete the file ltw_install.php from your server</b>.<br><br>
				You can access the calendar at http://<i>your-domain</i>".dirname($_SERVER['PHP_SELF'])."/calendar.php,
				<br>log in and start entering events!
				";
			}
		}
	}

	// show the form if any errors!
	if ( !empty($errors) ) $showForm = 1;

	// display the admin user create form
	if ( $showForm == 1 ){
		switch ($ltw_config['pw_strength']){
		case 0: $pws = "Weak"; break;
		case 1: $pws = "Medium"; break;
		case 2: $pws = "Strong"; break;
		}
		
		echo "
		<br>
		<h3>Add System Administrator</h3>
		<b>".$pws."</b> password strength checking enabled.<br><br>
		<form action=\"".$_SERVER['PHP_SELF']."?command=user\" method=\"POST\" name=\"addform\">
		<table border=\"0\">
		<tr><td align=\"right\">Username:</td>
		<td><input type=\"text\" size=\"30\" name=\"uname\" 
		";
		if ( !empty($_POST['uname']) ) echo " value=\"".$_POST['uname']."\"";
		echo "></td></tr>
		<tr><td align=\"right\">Password:<br>Again:</td>
		<td><input type=\"password\" size=\"30\" name=\"pword\"><br>
		<input type=\"password\" size=\"30\" name=\"pwa\"></td>
		</tr>
		<tr><td align=\"right\">Email:</td>
		<td><input type=\"text\" size=\"30\" name=\"email\" ";

		if ( !empty($_POST['email']) ) echo " value=\"".$_POST['email']."\"";
		echo "></td></tr>
		<tr><td colspan=\"2\"><input type=\"submit\" name=\"Submit\" value=\"Submit\"></td></tr>
		</table>
		</form>
		".$errors."<br>".$auth->pwRules()."
		</body>
		</html>
		";
	}
	exit;
}

// At this point, if the command is not 'install'
if ( $_REQUEST['command'] != 'install' ){
	echo "
	Unknown command: ".$_REQUEST['command']."
	</body></html>
	";
}

// get list of tables to see what needs to be created/upgraded
echo "Getting a list of tables from the database.<br>";
$query 	= 'show tables';
$result = $db->db_query($query);
while ( $row = $db->db_fetch_array($result) ) $tables[$row[0]] = 1;

echo "Checking the USER table (".$ltw_config['db_table_users'].") exists...";
if ( !isset($tables[$ltw_config['db_table_users']]) ){
	echo "No.<br>&nbsp;&nbsp;Creating a new one....";
	$query  = "CREATE TABLE ".$ltw_config['db_table_users'];
	$query .= " ( username varchar(20) NOT NULL default '', ";
	$query .= "   password varchar(100) NOT NULL default '', ";
	$query .= "   email varchar(100) default '', ";
	$query .= "   status int(11) not null default 0, ";
	$query .= "   privledges int(11) not null default 1, ";
	$query .= "   bad_logins int(11) NOT NULL default '0', ";
	$query .= "   bad_logins_start char(15),";
	$query .= "   last_pw_change datetime, ";
	$query .= "   PRIMARY KEY  (username)";
	$query .= " ) TYPE=MyISAM;";
	$result = $db->db_query($query); 
	if ( !$result ) die("<br><b>Could not create the user table.</b>");
	echo "Success!<br>\n";
}else{
	// User table exists, do an upgrade?
	echo "Yes.<br>&nbsp;&nbsp;Checking it's up to date....";
	$query = "SHOW COLUMNS FROM ".$ltw_config['db_table_users'];
	$result = $db->db_query($query); 
	while ( $row = $db->db_fetch_array($result) ) $columns[$row[0]] = 1;

	if ( isset($columns['last_pw_change']) ){
		echo "Yes<br>";
	}else{
		echo "No<br>";
		echo "&nbsp;&nbsp;Checking Columns for V4 db exist...";
		if ( isset($columns['last_pw_change']) ){
			echo "Yes.<br>";
		}else{
			echo "No, adding columns....";
			$query  = "ALTER TABLE ".$ltw_config['db_table_users']." ";
			$query .= "ADD COLUMN ( ";
			$query .= "   email varchar(100) default '', ";
			$query .= "   status int(11) not null default 0, ";
			$query .= "   privledges int(11) not null default 1, ";
			$query .= "   bad_logins int(11) NOT NULL default '0', ";
			$query .= "   bad_logins_start char(15),";
			$query .= "   last_pw_change datetime ";
			$query .= " )";
			$result = $db->db_query($query); 
			if ( !$result ) die("<br><b>Could not alter the user table.</b>");
			echo "Success!<br>\n";
		}
	}
}


echo "Checking the event table (".$ltw_config['db_table_calendar'].") exists...";
if ( !isset($tables[$ltw_config['db_table_calendar']]) ){
	echo "No.<br>&nbsp;&nbsp;Creating a new one...";
	$query  = "CREATE TABLE " . $ltw_config['db_table_calendar'];
	$query .= " ( id              int(11) NOT NULL auto_increment, ";
	$query .= "   name            varchar(30) NOT NULL, ";
	$query .= "   event_date      date NOT NULL default '0000-00-00', ";
	$query .= "   start_time      time NOT NULL default '00:00:00', ";
	$query .= "   end_time        time NOT NULL default '00:00:00', ";
	$query .= "   description     text NOT NULL, ";
	$query .= "   recurring       tinyint(4) NOT NULL default '0', ";
	$query .= "   recur_dayofweek tinyint(4) default NULL, ";
	$query .= "   day_event       tinyint(4) NOT NULL default '0', ";
	$query .= "   cat_id          int(11) NOT NULL default '1', ";
	$query .= "   event_end       date NOT NULL default '0000-00-00', ";
	$query .= "   location        varchar(30) NOT NULL, ";
	$query .= "   PRIMARY KEY  (id), KEY idx_date(event_date)";
	$query .= " ) TYPE=MyISAM;";
	$result = $db->db_query($query); 
	if ( !$result ) die("<br><b>Could not create the calendar table.</b>");
	echo "Success!<br>\n";
}else{
	echo "Yes.<br>&nbsp;&nbsp;Checking it's up to date...";
	$query = "SHOW COLUMNS FROM ".$ltw_config['db_table_calendar'];
	$result = $db->db_query($query); 
	while ( $row = $db->db_fetch_array($result) ) $columns[$row[0]] = 1;

	if ( isset($columns[day_event]) && isset($columns[event_end]) ){
		echo "Yes<br>"; 
	}else{
		echo "No.<br>\n";
		echo "&nbsp;&nbsp;Checking Columns for V3 db exist...";
		if ( isset($columns[day_event]) && isset($columns[cat_id]) ){
			echo "Yes.<br>";
		}else{
			echo "No, adding columns...";
			$query  = "ALTER TABLE ".$ltw_config['db_table_calendar']." ";
			$query .= "ADD COLUMN ( ";
			$query .= "   day_event tinyint(4) NOT NULL default '0', ";
			$query .= "   cat_id 		int(11) NOT NULL default '1' ";
			$query .= " )";
			$result = $db->db_query($query); 
			if ( !$result ) die("<br><b>Could not alter the event table.</b><br>");
			echo "Success!<br>\n";
		}
	
		echo "&nbsp;&nbsp;Checking Columns for V4 db exist...";
		if ( isset($columns['event_end'])  && isset($columns['location'])){
			echo "Yes.<br>";
		}else{
			echo "No, adding columns...";
			$query  = "ALTER TABLE ".$ltw_config['db_table_calendar']." ";
			$query .= "ADD COLUMN ( ";
			$query .= "   event_end date NOT NULL default '0000-00-00', ";
			$query .= "   location  varchar(30) NOT NULL ";
			$query .= " )";
			$result = $db->db_query($query); 
			if ( !$result )die("<br><b>Could not alter the event table.</b><br>");
			echo "Success!<br>\n";

			echo "&nbsp;&nbsp;Populating event_end date from event_date. This may take some time...";
			$rcnt = 0;
			$eflag = 0;
			$endDate = date("Y")."-12-31";
			$query  = "SELECT id,event_date,recurring FROM ".$ltw_config['db_table_calendar']." ";
			$result = $db->db_query($query); 
			while( $row = $db->db_fetch_array($result) ){
				$rcnt++;
		 	 	$query2  = "UPDATE ".$ltw_config['db_table_calendar']." ";
				if ( !$row['recurring'] ){
					$query2 .= "SET event_end = '".$row['event_date']."' ";
				}else{
					$query2 .= "SET event_end = '".$endDate."' ";
				}
				$query2 .= "WHERE id = ".$row['id'];
				$result2 = $db->db_query($query2); 
				if ( !$result2 ){
					echo "Error updating event_end on id = ".$row['id']."<br>";
					$eflag = 1;
				}
			}
		}
		if ( $eflag == 1 ) die ("");
		echo "Success! ($rcnt records)<br>\n";
	}
}


echo "Checking the category table (".$ltw_config['db_table_category'].") exists...";
if ( !isset($tables[$ltw_config['db_table_category']]) ){
	echo "No.<br>&nbsp;&nbsp;Creating a new one...";
	$query  = "CREATE TABLE " . $ltw_config['db_table_category'];
	$query .= " ( id      int(11) NOT NULL auto_increment, ";
	$query .= "   name    varchar(30) NOT NULL, " ;
	$query .= "   fgcolor char(8) NOT NULL default '#000000', ";
	$query .= "   bgcolor char(8) NOT NULL default '#ffffff', ";
	$query .= "   PRIMARY KEY (id)";
	$query .= " ) TYPE=MyISAM;";
	$result = $db->db_query($query); 
	if ( !$result ) die("<br><b>Could not create the category table.</b><br>");
		echo "Success!<br>\n";
	}else{
		echo "Yes.<br>\n";
	}

echo "Checking the log table (".$ltw_config['db_table_log'].") exists...";
if ( !isset($tables[$ltw_config['db_table_log']]) ){
	echo "No.<br>&nbsp;&nbsp;Creating a new one...";
	$query  = "CREATE TABLE " . $ltw_config['db_table_log'];
	$query .= " ( id int(11) NOT NULL auto_increment, ";
	$query .= "   type  int(11), ";
	$query .= "   occured  timestamp(14) not null, ";
	$query .= "   admin    varchar(20), ";
	$query .= "   info     text, ";
	$query .= "   PRIMARY KEY  (id), key idx_occured(occured)";
	$query .= " ) TYPE=MyISAM;";
	$result = $db->db_query($query); 
	if ( !$result ) die("<br><b>Could not create the Calendar log table.</b><br>");
	echo "Success!<br>\n";
}else{
	echo "Yes.<br>";
}

// done, go create admin account
echo "
<br><b>Database install/upgrade complete.</b><br>
<br><b>Note:</b> 
This version of the ltwCalendar implements user privledges for access to various functions.<br>
You <b><i>must</b></i> create a new administrator account (at least temporarily) <b><I>even if you upgraded</b></I><br>
so you can 'manage' any existing accounts.<br>
<h4>Click <a href=\"".$_SERVER['PHP_SELF']."?command=user\">here</a> to create an Admin account.</h4>
</body></html>
";
exit;

?> 	
