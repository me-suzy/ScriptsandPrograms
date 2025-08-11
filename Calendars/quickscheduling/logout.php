<?php

	/*Destroying a session*/

	// Initialize the session.
	session_start();

	// Unset all of the session variables.
	session_unset();

	// destroy the session.
	session_destroy();

	//redirecting control to the login page
	header("Location: login.php");

	//exiting from this page
	exit;

?>  
