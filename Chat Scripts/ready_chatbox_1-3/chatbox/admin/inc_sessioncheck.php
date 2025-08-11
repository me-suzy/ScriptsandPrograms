<?php
session_start();
$inc_admin_ses_username=$HTTP_SESSION_VARS["inc_admin_ses_username"];
$inc_admin_ses_password=$HTTP_SESSION_VARS["inc_admin_ses_password"];

include('../settings.php');

// Check to see if the username is correct
if ( $inc_admin_ses_username !== $admin_username ) {
	$error="yes";
}
// Check to see if the username is correct	
if ( $inc_admin_ses_password !== $admin_password ) {
	$error="yes";
}

//if( empty($inc_admin_ses_username) ) {
//	$error="yes";
//}

if( $error=="yes" ) {
	$error="yes";
	header("location:login.php");
	exit;
}

?>
