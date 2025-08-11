<?php
// If they tried to install...
if ( $submit ){
	$error="no";

	$result = @include('settings.php');
	// Check if they uploaded settings.php
	if ( $result ) { $log.= "Settings.php found <br /> \n";} else { $error="yes"; $log.= "Settings.php not found <br /> \n";}
	
	// Check if they filled in the variables
	
	if ( empty($admin_username) ) { $error="yes"; $log.= "admin_username variable not filled out in settings.php<br /> \n";}
	if ( empty($admin_password) ) { $error="yes"; $log.= "admin_password variable not filled out in settings.php<br /> \n";}
	
	if ( ($include_stylesheet=="NO") || ($include_stylesheet=="Yes")  ) { $log.= "Stylesheet option filled out<br /> \n"; } else{ $error="yes"; $log.= "admin_username variable not filled out in settings.php<br /> \n";}
	if ( !is_numeric($CountLimit) ) { $error="yes"; $log.= "countlimit variable not filled out in settings.php<br /> \n";}
	
	if ( empty($dbServer) ) { $error="yes"; $log.= "dbServer variable not filled out in settings.php<br /> \n";}
	if ( empty($dbuserName) ) { $error="yes"; $log.= "dbuserName variable not filled out in settings.php<br /> \n";}
	if ( empty($dbpassword) ) { $error="yes"; $log.= "dbpassword variable not filled out in settings.php<br /> \n";}
	if ( empty($dbName) ) { $error="yes"; $log.= "dbName variable not filled out in settings.php<br /> \n";}
	
	// Connect to the database and then select the database
	$con=mysql_connect ($dbServer, $dbuserName, $dbpassword);
	if ( $con ) { $log.= "Connected to mysql <br /> \n";} else { $error="yes"; $log.= "Could not connect to mysql<br /> \n";}
	$db=mysql_select_db ($dbName);
	if ( $db ) { $log.= "Connected to the database <br /> \n";} else { $error="yes"; $log.= "Could not connect to the database<br /> \n";}

// create the message table
$query = "CREATE TABLE chatbox_data ( ";
$query .= "  id int(11) NOT NULL auto_increment,";
$query .= "  name varchar(15) default NULL,";
$query .= "  message varchar(100) default NULL,";
$query .= "  timestamp varchar(25) default NULL,";
$query .= "  link varchar(100) default NULL,";
$query .= "  ip varchar(25) default NULL,";
$query .= "  PRIMARY KEY  (id)";
$query .= ") TYPE=MyISAM AUTO_INCREMENT=1 ;";
$result = mysql_query($query);
if ( $result ) { $log.= "Table chatbox_data created <br /> \n";} else { $error="yes"; $log.= "Table chatbox_data not created, ".mysql_error()." <br /> \n";}

// Insert a welcome message
$query = "INSERT INTO `chatbox_data`";
$query .= " VALUES (37, 'WebsiteReady', 'Thanks for using the Ready ChatBox  :)', '1118858118', 'http://www.websiteready.net', '11.111.11.111');";
$result = mysql_query($query);
if ( $result ) { $log.= "Default Data Inserted <br /> \n";} else { $error="yes"; $log.= "Default Data could not beInserted, ".mysql_error()." <br /> \n";}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ready chatbox - Install</title>
<style type="text/css">
<!--
.header {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #333333;
	background-color: #F8750B;
	padding-top: 2px;
	padding-bottom: 2px;
	padding-left: 10px;
	border-bottom-width: 1px;
	border-bottom-style: dashed;
	border-bottom-color: #333333;
}
.box {
	border: 1px solid #333333;
	background-color: #FBA762;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #222222;
}
a.link_a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:none;
	padding-left: 10px;
}
a.link_a:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:underline;
	padding-left: 11px;
}
a.link_b {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:none;
}
a.link_b:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:underline;
}
body {
	background-color: #333333;
}
.center {
	position: absolute; left: 200px; top: 250px;
}
-->
</style>
</head>

<body>
<br /><br /><br /><br /><br />
<div align="center">
	<form name="login" id="login" method="post" action="install.php">
      <table width="600" class="box" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td class="header">Ready ChatBox Install </td>
        </tr>
<?php
if ( $submit ){
	print"        <tr> \n";
	print"          <td align=\"center\" style=\"padding: 5px;\"> \n";
	if ( $error=="no" ){
		print "<b>Install was successful!</b> <br />"; 
	}else{
		print "<b>Install was NOT successful!</b> <br />";
	}
	print "$log <br />\n";
	
	if ( $error=="no" ){
		print "You can now <a class=\"link_b\" href=\"admin/\"> Login here</a>  <br />";
	}else{
		print "<b>Do not click on the install button again until you have fixed the above problems</b> <br />"; 
	}
	
	print"          </td> \n";
	print"        </tr> \n";


} // end if submit
?>
        <tr>
          <td align="center" style="padding: 5px;">
            <input type="submit" name="submit" value="Click to Install" />
          </td>
        </tr>
      </table>
	</form>
</div>
</body>
</html>




