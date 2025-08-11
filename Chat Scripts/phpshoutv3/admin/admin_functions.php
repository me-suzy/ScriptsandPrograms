<?
function phpshout_chk_login()
{
	session_start();
	if (!isset($_SESSION["phpshout_admin_login"])) {
		echo "You are currently not logged in. Please go to the login page";
		exit;
	}
}
?>