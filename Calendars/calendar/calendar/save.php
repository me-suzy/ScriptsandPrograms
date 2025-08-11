<?PHP
	session_start();
	if (isset($_SESSION)) $form_password = $_SESSION["password"];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
	<HEAD>
		<TITLE>Calendar</TITLE>
		<LINK rel="stylesheet" type="text/css" href="default.css">
	</HEAD>

	<BODY>
		<?PHP
			include_once('inc/globals.php');
			include_once('inc/functions.php');

			$form_name = $_POST['name'];
			$form_weekday_start = $_POST['weekday_start'];
			$form_weekday_end = $_POST['weekday_end'];
			$form_time_start_hour = $_POST['time_start_hour'];
			$form_time_start_minute = $_POST['time_start_minute'];
			$form_time_start = $form_time_start_hour . ":" . $form_time_start_minute . ":" . "00";
			$form_time_end_hour = $_POST['time_end_hour'];
			$form_time_end_minute = $_POST['time_end_minute'];
			$form_time_end = $form_time_end_hour . ":" . $form_time_end_minute . ":" . "00";

			$fordb_time_start_minute = $form_time_start_minute + 1;
			$fordb_time_start_hour = $form_time_start_hour;

			$fordb_time_start = $fordb_time_start_hour . ":" . $fordb_time_start_minute . ":" . "00";

			if ($form_time_end_minute == "00") {
				$fordb_time_end_minute = "59";
				$fordb_time_end_hour = $form_time_end_hour - 1;

				if ($fordb_time_end_hour == "-1") {
					$fordb_time_end_hour = "23";
				}
			}
			else {
				$fordb_time_end_minute = $form_time_end_minute - 1;
				$fordb_time_end_hour = $form_time_end_hour;
			}

			$fordb_time_end = $fordb_time_end_hour . ":" . $fordb_time_end_minute . ":" . "00";

			$form_cycle = $_POST['cycle'];
			$form_special = $_POST['special'];

			if ($form_special == "special") $form_special = 1;
				else $form_special = 0;

			$form_link = $_POST['link'];
			$form_id = $_POST['id'];

			$sql = "SELECT id, name, cycle FROM " . $db_prefix . "calendar
				WHERE (time_start BETWEEN '" . $fordb_time_start . "' AND '" . $fordb_time_end . "' OR time_end BETWEEN '" . $fordb_time_start . "' AND '" . $fordb_time_end . "' OR time_start = '" . $form_time_start . "' OR (time_start < '" . $fordb_time_start . "' AND time_end > '" . $fordb_time_end . "') )
				AND (weekday_start BETWEEN '" . $form_weekday_start . "' AND '" . $form_weekday_end . "' OR weekday_end BETWEEN '" . $form_weekday_start . "' AND '" . $form_weekday_end . "') ORDER BY time_start;";
			$result = mysql_query($sql,$db);
			$num_rows = mysql_num_rows($result);

			$conflict = FALSE;
			$conflict_id[0] = "";
			$conflict_name[0] = "";

			if ($num_rows != FALSE) {
				$i = 0;
				while ($myrow = mysql_fetch_row($result)) {
					$db_id[$i] = $myrow[0];
					$db_name[$i] = $myrow[1];
					$db_cycle[$i] = $myrow[2];

					$i++;
				}

				$n = 0;
				for ($i=0; $i<sizeof($db_id); $i++) {
					if ( (($db_cycle[$i] + $form_cycle != 3) || ($db_cycle[$i] == 0) || ($form_cycle == 0)) && ($db_id[$i] != $form_id) ) {
						$conflict = TRUE;
						$conflict_id[$n] = $db_id[$i];
						$conflict_name[$n] = $db_name[$i];
						$n++;
					}
				}
			}

			if ($form_id != "") {
				$sql = "SELECT password FROM " . $db_prefix . "calendar WHERE id = " . $form_id . ";";
				$result = mysql_query($sql,$db);
				$myrow = mysql_fetch_row($result);
				$db_password = $myrow[0];

				if (($db_password == $form_password) || ($form_password == $pass_calSuperuser)) {
					if ($conflict == FALSE) {
						$sql = "UPDATE " . $db_prefix . "calendar SET
							name = '".$form_name."',
							weekday_start = '".$form_weekday_start."',
							weekday_end = '".$form_weekday_end."',
							time_start = '".$form_time_start."',
							time_end = '".$form_time_end."',
							cycle = '".$form_cycle."',
							special = '".$form_special."',
							link = '".$form_link."'
							WHERE id = '".$form_id."';";

						$result = mysql_query($sql,$db);

						echo("
							<script language=\"javascript\">
							<!--
								location.replace(\"calendar.php\");
							-->
							</script>
						");
					}
					else {
						echo("Entry conflicts with:<BR>");
						echo("<UL>");
						for ($n=0; $n<sizeof($conflict_id); $n++) {
							echo("<LI><A href=\"change.php?id=" . $conflict_id[$n] . "\">" . $conflict_name[$n] . "</A><BR>");
						}
						echo("</UL>");
					}
				}
				else {
					echo("Password incorrect<BR>");
				}
			}
			else {
				if ($conflict == FALSE) {
					srand((double) microtime() * 1000000);
					$db_passhead = mysql_result(mysql_query("SELECT name FROM " . $db_prefix . "password WHERE id = ".rand(1,1000),$db),0,"name");
					$passmidl = rand(1,9);
					$db_passtail = mysql_result(mysql_query("SELECT name FROM " . $db_prefix . "password WHERE id = ".rand(1,1000),$db),0,"name");
					$db_password = $db_passhead . $passmidl . $db_passtail;

					$sql = "INSERT INTO " . $db_prefix . "calendar (name, weekday_start, weekday_end, time_start, time_end, cycle, special, link, password)
							VALUES ('".$form_name."', '".$form_weekday_start."', '".$form_weekday_end."', '".$form_time_start."', '".$form_time_end."', '".$form_cycle."', '".$form_special."', '".$form_link."', '".$db_password."');";
					$result = mysql_query($sql,$db);

					echo("
						<script language=\"javascript\">
						<!--
							location.replace(\"calendar.php\");
						-->
						</script>
					");
				}
				else {
					echo("Entry conflicts with:<BR>");
					echo("<UL>");
					for ($n=0; $n<sizeof($conflict_id); $n++) {
						echo("<LI><A href=\"change.php?id=" . $conflict_id[$n] . "\">" . $conflict_name[$n] . "</A><BR>");
					}
					echo("</UL>");
				}
			}
		?>
		<A href="calendar.php">Back to the calendar</A>
	</BODY>
</HTML>