<?php

// If they tried to log in...
if ( $submit ){
	// Include the settings for the correct username and password
	include('../settings.php');

	// Get their login details from the headers
	$in_username = $_POST["username"];
	$in_password = $_POST["password"];

	// Set the error to no for now
	$error="no";

	// Check to see if the username is correct
	if ( $in_username !== $admin_username ){
		$error="yes"; $error_log .="The username $in_username is not valid. <br />\n";
	}
	// Check to see if the username is correct	
	if ( $in_password !== $admin_password ){
		$error="yes"; $error_log .="That password is not valid. <br />\n";
	}

	// If there was no error
	if ( $error=="no" ){
		$inc_admin_ses_username="$admin_username";
		$inc_admin_ses_password="$admin_password";
		session_start();
		session_register("inc_admin_ses_username");
		session_register("inc_admin_ses_password");
  
		//Redirect them to the administration home page
		header("location:index.php");
	}


}// End if they tried to log in

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ready chatbox - Administration</title>
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
	<form name="login" id="login" method="post" action="login.php">
      <table width="240" class="box" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td class="header">Administration Login </td>
        </tr>
<?php
if ($error_log) {
print"        <tr> \n";
print"          <td style=\"padding: 5px;\"> \n";
print"				$error_log  \n";
print"          </td> \n";
print"        </tr> \n";
}

?>
        <tr>
          <td style="padding: 5px;">Username: 
            <input type="text" name="username" />
          </td>
        </tr>
        <tr>
          <td style="padding: 5px;">Password: 
            <input type="password" name="password" />
          </td>
        </tr>
        <tr>
          <td align="center" style="padding: 5px;">
            <input type="submit" name="submit" value="Submit" />
          </td>
        </tr>
      </table>
	</form>
</div>
</body>
</html>
