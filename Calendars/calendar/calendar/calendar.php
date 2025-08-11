<?PHP
	session_start();
	if ($_POST["password"] <> "") $_SESSION["password"] = $_POST["password"];
	if (isset($_SESSION)) $form_password = $_SESSION["password"];

	include_once('inc/globals.php');
	include_once('inc/functions.php');

	$form_id = $_POST['id'];

	$php_weekday = date("w");
	if ($php_weekday == 0) $php_weekday = 7;

	$php_cycle = date("W") % 2;
	if ($php_cycle == 0) $php_cycle = 2;

	$php_time = date("G") . ":" . date("i") . ":00";

	$sql = "SELECT id FROM " . $db_prefix . "calendar WHERE time_start <= '" . $php_time . "' AND time_end > '" . $php_time . "' AND weekday_start <= '" . $php_weekday . "' AND weekday_end >= '" . $php_weekday . "' AND (cycle = '" . $php_cycle . "' OR cycle = '0');";

	$result = mysql_query($sql,$db);
	$myrow = mysql_fetch_row($result);

	$current_id = $myrow[0];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
	<HEAD>
		<TITLE>Calendar</TITLE>
		<LINK rel="stylesheet" type="text/css" href="default.css">

		<script type="text/javascript"><!--
			function login() {
				var password = prompt("Superuser password","");
				document.forms["form"].password.value = password;
				document.forms["form"].submit();
			}

			function logout() {
				document.forms["form"].password.value = "logout";
				document.forms["form"].submit();
			}
		//--></script>
	</HEAD>

	<BODY>
		<?PHP
			if (($form_password == "logout") || ($form_password == "")) {
				echo("<A href=\"#\" onClick=\"login();\">Login</A> (Superuser password is su)");
			}
			else {
				echo("<A href=\"#\" onClick=\"logout();\">Logout</A>");
			}
		?>

		<?PHP
			$sql = "SELECT id, name, weekday_start, weekday_end, time_start, time_end, cycle, special, link, password FROM " . $db_prefix . "calendar ORDER BY weekday_start, cycle, time_start;";
			$result = mysql_query($sql,$db);

			while ($myrow = mysql_fetch_row($result)) {
				$db_id = $myrow[0];
				$db_weekday_start = $myrow[2];
				$db_weekday_end = $myrow[3];
				$db_time_start = substr($myrow[4], 0 , 5);
				$db_time_end = substr($myrow[5], 0 , 5);
				$db_cycle = $myrow[6];

				$id[$db_weekday_start][$db_time_start][$db_cycle] = $myrow[0];
				$entry[$db_id]["name"] = $myrow[1];
				$entry[$db_id]["special"] = $myrow[7];
				$entry[$db_id]["link"] = $myrow[8];
				$entry[$db_id]["password"] = $myrow[9];

				$entry[$db_id]["colspan"] = ($db_weekday_end - $db_weekday_start + 1) * 2;
				$entry[$db_id]["rowspan"] = diffTimeAbs($db_time_start, $db_time_end) / 15;

				$weekday = $db_weekday_start;
				while ($db_weekday_end - $weekday >= 0) {
					$time = $db_time_start;
					$diffTimeAbs = diffTimeAbs($time, $db_time_end);

					while ($diffTimeAbs > 0) {
						$id[$weekday][$time][$db_cycle] = $id[$db_weekday_start][$db_time_start][$db_cycle];

						$time_hour = substr($time, 0, 2);
						$time_minute = substr($time, 3, 2) + 15;
						if ($time_minute == "60") {
							$time_hour++;
							$time_minute = "00";
						}

						if (strlen($time_hour) < 2) $time_hour = "0" . $time_hour;
						$time = $time_hour . ":" . $time_minute;
						$diffTimeAbs = diffTimeAbs($time, $db_time_end);
					}
					$weekday++;
				}
			}

			echo("<TABLE width=\"900\" border=\"0\" bgcolor=\"white\" cellpadding=\"2\" cellspacing=\"1\">");
			echo("<TR bgcolor=\"lightblue\">");
				echo("<TD width=\"20\">&nbsp;</TD>");
				for ($i = 1; $i < 8; $i++) {
					echo("<TD width=\"123\" colspan=\"2\">".weekday($i)."</TD>");
				}
				echo("<TD width=\"20\">&nbsp;</TD>");
			echo("</TR>");

			for ($time_hour = 0; $time_hour < 24; $time_hour++) {
				if (strlen($time_hour) < 2) $time_hour = "0" . $time_hour;
					for($time_minute = 0; $time_minute < 60; $time_minute += 15) {

						if (strlen($time_minute) < 2) $time_minute = "0" . $time_minute;
						$time = $time_hour . ":" . $time_minute;

						echo("<TR height=\"0\">");
							if ($time_minute == "00") echo("<TD rowspan=\"4\" bgcolor=\"lightblue\">".$time_hour."<IMG align=\"right\" src=\"img/pixel.gif\" border=\"0\" height=\"20\" width=\"0\"></TD>");

								for($weekday = 1; $weekday < 8; $weekday++) {

									$bgcolor[3] = "#F0F0FF";

									$time_back_minute = $time_minute - 15;
									$time_back_stunde = $time_hour;
									if ($time_back_minute < 0) {
										$time_back_stunde--;
										$time_back_minute = "45";
									}
									if (strlen($time_back_minute) < 2) $time_back_minute = "0" . $time_back_minute;
									if (strlen($time_back_stunde) < 2) $time_back_stunde = "0" . $time_back_stunde;
									$time_back = $time_back_stunde . ":" . $time_back_minute;

									for($i = 0; $i < 1; $i++) {
										if ( ($id[$weekday][$time][$i] != "") && ($id[$weekday][$time][$i] != $id[$weekday - 1][$time][$i]) && ($id[$weekday][$time][$i] != $id[$weekday][$time_back][$i]) )
											$cycle[$i] = true;
										else
											$cycle[$i] = false;

										$bgcolor[$i] = "#F0F0FF";
										if ($entry[$id[$weekday][$time][$i]]["special"] == 1) $bgcolor[$i] = "#C00084";
										if ($id[$weekday][$time][$i] == $current_id) $bgcolor[$i] = "yellow";
									}

									for($i = 1; $i < 3; $i++) {
										if ( ($id[$weekday][$time][$i] != "") && ($id[$weekday][$time][$i] != $id[$weekday][$time_back][$i]) )
											$cycle[$i] = true;
										else
											$cycle[$i] = false;

										$bgcolor[$i] = "#F0F0FF";
										if ($entry[$id[$weekday][$time][$i]]["special"] == 1) $bgcolor[$i] = "#C00084";
										if ($id[$weekday][$time][$i] == $current_id) {
											$bgcolor[$i] = "yellow";
										}
									}

									if ($cycle[0] == true) {
										if ($entry[$id[$weekday][$time][0]]["link"] != "")
											$string_link = $entry[$id[$weekday][$time][0]]["link"];
										else
											$string_link = "javascript:void(0)";
										if ($entry[$id[$weekday][$time][0]]["anmerkung"] != "") {
											echo("<TD bgcolor=\"".$bgcolor[0]."\" colspan=\"".$entry[$id[$weekday][$time][0]]["colspan"]."\" rowspan=\"".$entry[$id[$weekday][$time][0]]["rowspan"]."\"><A href=\"".$string_link."\" onmouseover=\"stickyTip.show('".numberstring($id[$weekday][$time][0])."')\" onmouseout=\"stickyTip.hide()\">". $entry[$id[$weekday][$time][0]]["name"] . "</A>");
										}
										else {
											echo("<TD bgcolor=\"".$bgcolor[0]."\" colspan=\"".$entry[$id[$weekday][$time][0]]["colspan"]."\" rowspan=\"".$entry[$id[$weekday][$time][0]]["rowspan"]."\"><A href=\"".$string_link."\">". $entry[$id[$weekday][$time][0]]["name"] . "</A>");
										}
										if (($form_password == $entry[$id[$weekday][$time][0]]["password"]) || ($form_password == $pass_calSuperuser)) {
											echo("<BR><A href=\"change.php?id=" . $id[$weekday][$time][0] . "\"><IMG src=\"img/edit.gif\" border=\"0\"></A> <A href=\"delete.php?id=" . $id[$weekday][$time][0] . "\"><IMG src=\"img/delete.gif\" border=\"0\"></A>");
										}
										echo("<IMG align=\"right\" src=\"img/pixel.gif\" border=\"0\" height=\"".($entry[$id[$weekday][$time][0]]["rowspan"] * 5)."\" width=\"0\"></TD>");
									}

									if ($cycle[1] == true) {
										if ($entry[$id[$weekday][$time][1]]["link"] != "")
											$string_link = $entry[$id[$weekday][$time][1]]["link"];
										else
											$string_link = "javascript:void(0)";
										echo("<TD bgcolor=\"".$bgcolor[1]."\" rowspan=\"".$entry[$id[$weekday][$time][1]]["rowspan"]."\"><A href=\"".$string_link."\">". $entry[$id[$weekday][$time][1]]["name"] . "</A>");
										if (($form_password == $entry[$id[$weekday][$time][1]]["password"]) || ($form_password == $pass_calSuperuser)) {
											echo("<BR><A href=\"change.php?id=" . $id[$weekday][$time][1] . "\"><IMG src=\"img/edit.gif\" border=\"0\"></A> <A href=\"delete.php?id=" . $id[$weekday][$time][1] . "\"><IMG src=\"img/delete.gif\" border=\"0\"></A>");
										}
										echo("<IMG align=\"right\" src=\"img/pixel.gif\" border=\"0\" height=\"".($entry[$id[$weekday][$time][1]]["rowspan"] * 5)."\" width=\"0\"></TD>");
									}

									if ( ($id[$weekday][$time][0] == "") && ($id[$weekday][$time][1] == "") && ($id[$weekday][$time][2] == "") ) {
										if ($form_password == $pass_calSuperuser) {
											echo("<TD bgcolor=\"".$bgcolor[3]."\" colspan=\"2\"><A href=\"change.php?weekday=".$weekday."&time=".urlencode($time)."&cycle=0\"><IMG src=\"img/new.gif\" border=\"0\"></A></TD>");
										}
										else {
											echo("<TD colspan=\"2\"></TD>");
										}
									}

									if ( ($id[$weekday][$time][0] == "") && ($id[$weekday][$time][1] == "") && ($id[$weekday][$time][2] != "") ) {
										if ($form_password == $pass_calSuperuser) {
											echo("<TD bgcolor=\"".$bgcolor[3]."\"><A href=\"change.php?weekday=".$weekday."&time=".urlencode($time)."&cycle=1\"><IMG src=\"img/new.gif\" border=\"0\"></A></TD>");
										}
										else {
											echo("<TD></TD>");
										}
									}

									if ($cycle[2] == true) {
										if ($entry[$id[$weekday][$time][2]]["link"] != "")
											$string_link = $entry[$id[$weekday][$time][2]]["link"];
										else
											$string_link = "javascript:void(0)";
										if ($entry[$id[$weekday][$time][2]]["anmerkung"] != "") {
											echo("<TD bgcolor=\"".$bgcolor[2]."\" rowspan=\"".$entry[$id[$weekday][$time][2]]["rowspan"]."\"><A href=\"".$string_link."\" onmouseover=\"stickyTip.show('".numberstring($id[$weekday][$time][2])."')\" onmouseout=\"stickyTip.hide()\">". $entry[$id[$weekday][$time][2]]["name"] . "</A>");
										}
										else {
											echo("<TD bgcolor=\"".$bgcolor[2]."\" rowspan=\"".$entry[$id[$weekday][$time][2]]["rowspan"]."\"><A href=\"".$string_link."\">". $entry[$id[$weekday][$time][2]]["name"] . "</A>");
										}
										if (($form_password == $entry[$id[$weekday][$time][2]]["password"]) || ($form_password == $pass_calSuperuser)) {
											echo("<BR><A href=\"change.php?id=" . $id[$weekday][$time][2] . "\"><IMG src=\"img/edit.gif\" border=\"0\"></A> <A href=\"delete.php?id=" . $id[$weekday][$time][2] . "\"><IMG src=\"img/delete.gif\" border=\"0\"></A>");
										}
										echo("<IMG align=\"right\" src=\"img/pixel.gif\" border=\"0\" height=\"".($entry[$id[$weekday][$time][2]]["rowspan"] * 5)."\" width=\"0\"></TD>");
									}

									if ( ($id[$weekday][$time][0] == "") && ($id[$weekday][$time][1] != "") && ($id[$weekday][$time][2] == "") ) {
										if ($form_password == $pass_calSuperuser) {
											echo("<TD bgcolor=\"".$bgcolor[3]."\"><A href=\"change.php?weekday=".$weekday."&time=".urlencode($time)."&cycle=2\"><IMG src=\"img/new.gif\" border=\"0\"></A></TD>");
										}
										else {
											echo("<TD></TD>");
										}
									}
								}

							if ($time_minute == "00") echo("<TD rowspan=\"4\" bgcolor=\"lightblue\">".$time_hour."</TD>");
						echo("</TR>");
					}
			}

			echo("<TR bgcolor=\"#F0F0FF)\" height=\"0\">");
				echo("<TD width=\"20\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"20\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"61\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"61\"></TD>");
				echo("<TD width=\"20\" height=\"0\"><IMG src=\"img/pixel.gif\" border=\"0\" height=\"0\" width=\"20\"></TD>");
			echo("</TR>");

			echo("</TABLE>");
		?>
		The entries in the left side boxes are scheduled in uneven weeks, the entries in the right side boxes in even.<BR>
		The entries with maroon background are special entries.<BR>
		The currently running event has a yellow background.<BR>
		<form name="form" method="post" action="calendar.php"><input type="hidden" name="password"></form>
</BODY>
</HTML>
