<?php
//
// File:    admin/manage_users.php
// License: GNU GPL
// Purpose: User management
//
require_once('../settings.php');

if ( ! isAdmin() )
	HariKari('You are not the admin.');


$action     = ( isset($_REQUEST['action']) ) ? $_REQUEST['action'] : '';

// Text form data
$login      = ( isset($_POST['login']) )    ? $_POST['login']    : "";
$password   = ( isset($_POST['password']) ) ? $_POST['password'] : "";
$flags      = ( isset($_POST['flags']) )    ? $_POST['flags']    : "";
$www        = ( isset($_POST['www']) )      ? $_POST['www']      : "";
$email      = ( isset($_POST['email']) )    ? $_POST['email']    : "";

// Checkboxes
$admin      = ( isset($_POST['admin']) )      ? $_POST['admin']      : "";
$cookies    = ( isset($_POST['cookies']) )    ? $_POST['cookies']    : "";
$registered = ( isset($_POST['registered']) ) ? $_POST['registered'] : "";



	////
	////  User requested to add a new user
	////
	if ( $action == 'addnew' )
	{
		$db = DB_connect($site, $user, $pass);
		DB_select_db($database, $db);

		$sql = "SELECT * FROM $tblUsers WHERE login = '$login'";
		$result = DB_query($sql, $db);
		if ( DB_num_rows($result) > 0 )
			die("There's already a user named $login.");

		$sql = "INSERT INTO $tblUsers VALUES ( " .
			"'$login', '$password', '$flags', '$www', '$email' )";
		DB_query($sql, $db);

		Header("Location: $wb_admin_url/manage_users.php");
		exit(0);
	}

  

	////
	////  User requested to delete user
	////
	if ( $action == 'delete' )
	{
		if ( ! isset($_REQUEST['login']) ) die("I don't know who to delete!");
		else                               $login = $_REQUEST['login'];

		$db = DB_connect($site, $user, $pass);
		DB_select_db($database, $db);

		$sql = "DELETE FROM $tblUsers WHERE login='$login';";
		DB_query($sql, $db);

		Header("Location: $wb_admin_url/manage_users.php");
		exit(0);
	}



	////
	////  User requested to edit user
	////
	if ( $action == 'edit' )
	{
		$flags = 0;
		if ( $admin      == 1 ) $flags += 1;
		if ( $cookies    == 1 ) $flags += 2;
		if ( $registered == 1 ) $flags += 4;

		$sql = "UPDATE $tblUsers SET " .
			"login    = '$login',     " .
			"password = '$password',  " .
			"flags    = '$flags',     " .
			"www      = '$www',       " .
			"email    = '$email'      " .
			"WHERE login = '$login';";

		$db = DB_connect($site, $user, $pass);
		DB_select_db($database, $db);
		DB_query($sql, $db);
		//echo "<pre>$sql</pre>";

		Header("Location: $wb_admin_url/manage_users.php");
		exit(0);
	}




	$page_title = 'Managing User Accounts';
	include_once("$wb_inc_dir/header.php");

	// insert_form_heading('edit users');
	// insert_navigation();

	$db = DB_connect($site, $user, $pass);
	DB_select_db($database, $db);

	// Print out all the users
	//
	$result = DB_query("select * from $tblUsers", $db);

	insert_form_heading('Edit Existing Users');
	
	  while ($row = DB_fetch_array($result))
		  Print_User($row);
	
	insert_form_heading('Add New User');
	
	?>
<div class="subcontent-users">
<form id="adduser" method="post" action="./manage_users.php?action=addnew">
<table cellpadding="2" cellspacing="0" border="0">
<tr>
<td class="fieldname" width="20%"><label>login</label></td>
<td width="80%"><input name="login" style="width:8em" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>password</label></td>
<td width="80%"><input name="password" style="width:8em" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>admin</label></td>
<td width="80%"><input class="check" type="checkbox" name="admin" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>cookies</label></td>
<td width="80%"><input class="check" type="checkbox" name="cookies" /></td>
</tr>
<tr><td class="fieldname" width="20%"><label>registered</label></td>
<td width="80%"><input class="check" type="checkbox" name="registered" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>www</label></td>
<td width="80%"><input name="www" style="width:15em" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>email</label></td>
<td width="80%"><input name="email" style="width:12em" /></td>
</tr>
<tr>
<td class="fieldname" width="20%"><label>&nbsp;</label></td>
<td width="80%"><input type="submit" value="submit" /></td>
</tr>
</table>
</form>
</div>
  <?php

include_once("$wb_inc_dir/footer.php");






function Print_User($row)
{
	?>

	<?php
	
	# JBE - Now nested to loop top and bottom  markup
	Start_User_Table();

	Print_Field('login', $row['login'], 8);
	Print_Field('password', $row['password'], 8);

	$flags = $row['flags'];

	$admin      = ( isAdmin($flags)              ) ? 'checked' : '';
	$cookies    = ( isCookies($row['flags'] )    ) ? 'checked' : '';
	$registered = ( isRegistered($row['flags'] ) ) ? 'checked' : '';

	Print_Check('admin', $admin);
	Print_Check('cookies', $cookies);
	Print_Check('registered', $registered);

	Print_Field('www', $row['www'], 15);
	Print_Field('email', $row['email'], 12);

	# JBE - Now nested to loop top and bottom  markup
	End_User_Table($row['login']);

	?>

	<?php
}

function Print_check($name, $check)
{
	echo '<tr>'."\n".'<td class="fieldname" width="20%"><label>'.$name.'</label></td>
	      <td width="80%"><input class="check" type="checkbox" name="'.$name.'" '.$check.' value="1" />
		  '."\n".'</td></tr>'."\n";
}
# kludged to assign input size variable, which is deprecated
function Print_field($field, $item, $size)
{
	echo '<tr>'."\n".'<td class="fieldname" width="20%"><label>'.$field.'</label></td><td width="80%">
		  <input name="'.$field.'" value="'.$item.'" style="width:'.$size.'em" />'."\n".'</td></tr>'."\n";
}

# JBE - I modified these functions to work with the new layout



function Start_User_Table()
{
	echo '<div class="subcontent-users">'."\n".
		 '<form class="userlist" method="post" action="./manage_users.php?action=edit">'."\n".
		 '<table cellpadding="2" cellspacing="0" border="0">'."\n";
		 

}

function End_User_Table($login)
{

	echo  '<tr>'."\n".
          '<td class="fieldname" width="20%"><input type="hidden" name="action" value="edit" /><label>&nbsp;</label></td>'."\n".
          '<td>'."\n".
          '<input type="submit" value="edit" />'."\n".
          '<a href="./manage_users.php?action=delete&amp;login='. $login . '">delete</a></td>'."\n".
          '</tr>'."\n".
          '</table>'."\n".
		  '</form>'."\n".
          '</div>'."\n";
	
}


?>
