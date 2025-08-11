<?PHP
	session_start();
	if (isset($_SESSION)) $form_password = $_SESSION["password"];

	include_once('inc/globals.php');
	include_once('inc/functions.php');

	$form_id = $_GET['id'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
	<HEAD>
		<TITLE>Calendar</TITLE>
		<LINK rel="stylesheet" type="text/css" href="default.css">
	</HEAD>

	<BODY>
		<?PHP
			if ($form_id != "") {
				$sql = "SELECT password FROM " . $db_prefix . "calendar WHERE id = " . $form_id . ";";
				$result = mysql_query($sql,$db);
				$num_rows = mysql_num_rows($result);

				if ($num_rows != FALSE) {
					$myrow = mysql_fetch_row($result);
					$db_password = $myrow[0];
				}
			}

			if (($db_password == $form_password) || ($form_password == $pass_calSuperuser)) {
				$sql = "DELETE FROM " . $db_prefix . "calendar WHERE id = '".$form_id."';";
				$result = mysql_query($sql);

				echo("
					<script language=\"javascript\">
					<!--
						location.replace(\"calendar.php\");
					-->
					</script>
				");
			}
			else {
				echo("password incorrect<BR>");
			}
		?>
		<A href="calendar.php">Back to the calendar</A>
	</BODY>
</HTML>