<?php

/*
  ===========================

  boastMachine v3.0 to v3.1 UPGRADE script

  Developed by Kailash Nadh
  Email   : kailash@bnsoft.net
  Website : www.kailashnadh.name
			www.bnsoft.net

  boastMachine
  Email   : kailash@boastology.com
  Website : www.boastology.com

  ===========================

*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>boastMachine Upgrade (3.0 to 3.1)</title>
	<style type="text/css">
	<!--

	body,html {
		background: #fafafa;
		font-family: 'Trebuchet MS';
		font-size: 13px;
	}

	#align_center {
		margin-left: 150px;
		width: 500px;
		margin-top: 50px;
	}

	#upgrade input {
		font-family: 'Trebuchet MS';
		font-weight: bold;
		font-size: 15px;
	}

	//-->
	</style>
</head>
<body>

<div id="align_center">

<?php

		include_once dirname(__FILE__)."/config.php";
		include_once dirname(__FILE__)."/$bmc_dir/inc/vars/bmc_conf.php";

		// Connect to MySQL
		$db=mysql_connect($my_host,$my_user,$my_pass);
		mysql_select_db($my_db, $db);

	if(!isset($_POST['upgrade'])) {

	// Check whether already running 3.1
	$flag=mysql_fetch_array(mysql_query("SELECT v_val FROM ".$my_prefix."vars WHERE v_name='site_url'"));
	if(isset($flag['v_val'])) {
		echo "<strong>You are already running boastMachine 3.1 ! Upgrade script is terminating..</strong>";
		echo "</div></body></html>"; exit;
	}

?>

<h1>boastMachine Upgrade</h1>
This script will upgrade your boastMachine 3.0 platinum database (mysql) to 3.1 <br /><br />
<strong>NOTES:</strong> <br />
1. You NEED NOT run the 3.1 install script once upgraded<br />
2. This script only upgrades the DB, your custom templates, files.. should be replaced manually.

<br /><br /><br /><br />
<div id="upgrade">
<form method="post" action"<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="upgrade" value="true" />
<input type="submit" value="UPGRADE TO 3.1" />
</form>
</div>

<?php
	}
	else {

		echo "Upgrading table '{$my_prefix}posts'..";
		mysql_query("ALTER TABLE ".$my_prefix."posts CHANGE m_cmt user_comment enum('1','0') NOT NULL default '1'", $db);
		mysql_query("ALTER TABLE ".$my_prefix."posts CHANGE m_vote user_vote enum('1','0') NOT NULL default '1'", $db);
		mysql_query("ALTER TABLE ".$my_prefix."posts CHANGE m_autobr post_autobr enum('1','0') NOT NULL default '1'", $db);
		mysql_query("ALTER TABLE ".$my_prefix."posts CHANGE m_trackback accept_trackback enum('1','0') NOT NULL default '1'", $db);
		mysql_query("ALTER TABLE ".$my_prefix."posts ADD user_comment_notify enum('1','0') NOT NULL default '1'", $db);

		echo "&nbsp;&nbsp;&nbsp;Done<br />\n";

		echo "Upgrading table '{$my_prefix}comments'..";
		mysql_query("ALTER TABLE ".$my_prefix."comments ADD parent_id INT(10) NOT NULL default ''", $db);
		echo "&nbsp;&nbsp;&nbsp;Done<br />\n";

		echo "Upgrading table '{$my_prefix}blogs'..";
		mysql_query("ALTER TABLE ".$my_prefix."blogs CHANGE m_users user_registrations enum('1','0') NOT NULL default '1'", $db);
		mysql_query("ALTER TABLE ".$my_prefix."blogs CHANGE m_rss rss_feed enum('1','0') NOT NULL default '1'", $db);
		echo "&nbsp;&nbsp;&nbsp;Done<br />\n";


// The users online table (new in 3.1)
$tbl_users_online=$my_prefix."users_online";
$tbl_users_online_dat=<<<EOF
CREATE TABLE $tbl_users_online (
  time_stamp INT(10) NOT NULL DEFAULT '0',
  ip varchar(40) NOT NULL,
  user varchar(40) NOT NULL
);
EOF;

// The Links table (3.1)
$tbl_links=$my_prefix."links";
$tbl_links_dat=<<<EOF
CREATE TABLE $tbl_links (
  id INT(10) NOT NULL AUTO_INCREMENT,
  title TINYTEXT NOT NULL default '',
  url TINYTEXT NOT NULL default '',
  description TINYTEXT NOT NULL default '',
  blog int(10) NOT NULL default '',
  PRIMARY KEY  (id)
);
EOF;

		echo "Creating '{$tbl_users_online}' table...  ";
		mysql_query($tbl_users_online_dat);
		echo "&nbsp;&nbsp;&nbsp;Done<br />\n";

		echo "Creating '{$tbl_links}' table...  ";
		mysql_query($tbl_links_dat);
		echo "&nbsp;&nbsp;&nbsp;Done<br />\n";


		// Get the server's time difference from GMT
		$gmtime=gmmktime(0,0,0,date("m"),date("h"),date("Y")); // GMT time
		$mytime=mktime(0,0,0,date("m"),date("h"),date("Y")); // Server's local time
		$time_difference=($gmtime-$mytime)/3600; // The time difference between GMT and the server time

		echo "Upgrading table '{$my_prefix}vars'..";
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='site_email' WHERE v_name='c_email'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='site_url' WHERE v_name='c_url'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='site_title' WHERE v_name='s_title'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='site_desc' WHERE v_name='s_desc'");

		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('trackbacks','1')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('image_verify','1')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('spam_words','')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('ban_spammer','0')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('user_comment_guests','1')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('user_comment_threading','1')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('user_comment_notify','1')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('gmt_diff','$time_difference')");
		mysql_query("INSERT INTO ".$my_prefix."vars (v_name,v_val) VALUES ('time_zone','')");

		mysql_query("UPDATE ".$my_prefix."vars SET v_name='summary_wrap' WHERE v_name='c_wrap'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='title_wrap' WHERE v_name='x_wrap'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_comment' WHERE v_name='m_cmt'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_comment_guests' WHERE v_name='m_cmt_guests'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_comment_session' WHERE v_name='m_cmt_ses'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_vote' WHERE v_name='m_vote'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_send_post' WHERE v_name='m_send'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_search' WHERE v_name='m_search'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='rss_feed' WHERE v_name='m_rss'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='auto_convert_link' WHERE v_name='m_cnv'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_registration' WHERE v_name='m_user'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_new_welcome' WHERE v_name='m_new_welcome'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_new_notify' WHERE v_name='m_new_notify'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_default_level' WHERE v_name='m_default_level'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='post_html' WHERE v_name='m_html'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='user_files' WHERE v_name='m_files'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_name='post_send_subject' WHERE v_name='subject'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_val='Default' WHERE v_name='theme_name'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_val='default' WHERE v_name='theme'");
		mysql_query("UPDATE ".$my_prefix."vars SET v_val='en.php' WHERE v_name='lang'");
		echo "&nbsp;&nbsp;&nbsp;Done<br />\n";

echo "Inserting data into '{$tbl_links}'...  ";
@mysql_query("INSERT INTO $tbl_links (title,description,url,blog) 
VALUES ('boastMachine', 'boastMachine, powering the best blogs','http://boastology.com','0'),
 ('NewzPile', 'NewzPile :: Tech News 24/7 - News from hundreds of sources','http://newzpile.com','0'),
 ('Kailash Nadh', 'Kailash Nadh :: The creator of boastMachine','http://kailashnadh.name','0'),
 ('BN Soft', 'Quality web services','http://bnsoft.net','0')
");
echo "&nbsp;&nbsp;&nbsp;Done <br />";

		echo "<br /><br /><br />\n\n Congratulations! Your boastMachine installation has been upgraded to v3.1 !<br />";
		echo "<a href=\"./\">Blog home</a>";

	}

?>

<br /><br /><br /><br />
<span style="text-align: center;"><a href="http://boastology.com">boastMachine</a></a>
</div></body></html>