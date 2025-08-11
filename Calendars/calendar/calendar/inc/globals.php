<?PHP
	// Passwords
	$pass_calSuperuser = "su";

	// DB related
	$db = mysql_connect("localhost", "username", "password");
	mysql_select_db("calendar",$db);
	$db_prefix = "cal_";

	// Layout related
	$inputfield_size = 80;
?>