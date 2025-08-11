<?php
//
// File:    admin/manage_users.php
// License: GNU GPL
// Purpose: Used to register for an account.  Do not use sessions here!
//
// Filtered / safe variables begin with capital letters.
//
require('settings.php');
$page_title = ':: Register Account';
include_once("$wb_inc_dir/header.php");

$action   = ( isset($_REQUEST['action']) ) ? $_REQUEST['action'] : '';
$login    = ( isset($_POST['login']) )     ? $_POST['login']     : '';
$password = ( isset($_POST['password']) )  ? $_POST['password']  : '';
$cookie   = ( isset($_POST['cookie']) )    ? $_POST['cookie']    : '';
$www      = ( isset($_POST['www']) )       ? $_POST['www']       : '';
$email    = ( isset($_POST['email']) )     ? $_POST['email']     : '';




// If an email is given, filter it.
//
$Email_Regex = '/^[^@s]+@([-a-z0-9]+.)+[a-z]{2,}$/i';

if ( $email != '' &&  ! preg_match($Email_Regex, $email)) 
	die('This is not a valid email address');
else 
	$Email = $email;






	////
	////  User requested to add a new user
	////
	////
	if ( $action == 'process' )
	{
		$db = DB_connect($site, $user, $pass);
		DB_select_db($database, $db);

		if ( ! $login  ||  ! $password )
			die('You must supply a login and password.');

		// Make sure the login is unique.
		//
		$sql = "SELECT * FROM $tblUsers WHERE login = '$login'";
		$result = DB_query($sql, $db);
		if ( DB_num_rows($result) > 0 )
			die("There's already a user named $login.");

		$Flags = 0;
		$Flags += ( $cookie == 'on' ) ? 2 : 0;

		$sql = "INSERT INTO $tblUsers VALUES ( " .
			"'$login', '$password', '$Flags', '$www', '$Email' )";
		DB_query($sql, $db);

		echo "<p>Thanks for registering, $login.</p>";

		if ( $registered_comments )
			echo "<p>An account must be registered before it can comment on " .
			"posts.  The administrator will approve registration shortly.</p>";
		else
			echo '<p>You can begin commenting immediately.</p>';

		echo "Please click <a href=\"$wb_url\">here</a> to return to the " .
			"blog.</p>";

		exit(0);
	}








insert_form_heading('Register As a New User');


?>
<div class="subcontent-heading" id="reg">
<span>This registration process is necessary to prevent unsolicited 
comments from spammers. If you are a frequent visitor, you may enable <strong>Cookies</strong>
to keep your information active with <strong><?php echo $name_of_blog; ?></strong>. For your privacy, they only store your Username and Password.
</span>
</div>

<div class="subcontent-users">
<form method="post" action="registration.php?action=process">
<table cellpadding="2" cellspacing="0" border="0">
<tr>
<td class="fieldname" width="20%"><label>Login name:</label></td>
<td width="80%"><input name="login" style="width:8em" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>Password:</label></td>
<td width="80%"><input name="password" style="width:8em" /></td>
</tr>
<td class="fieldname" width="20%"><label>Email Address:</label></td>
<td width="80%"><input name="email" style="width:12em" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>Website:</label></td>
<td width="80%"><input name="www" style="width:15em" /></td>
</tr>
<tr>
<tr>
<td class="fieldname" width="20%"><label>Allow cookies:</label></td>
<td width="80%"><input class="check" type="checkbox" name="cookie" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>&nbsp;</label></td>
<td width="80%"><input type="submit" value="Register" /></td>
</tr>
</table>
</form>
</div>


<? include_once("$wb_inc_dir/footer.php"); ?>
