<?PHP
	session_start();
	if (isset($_SESSION)) $form_password = $_SESSION["password"];

	include_once('inc/globals.php');
	include_once('inc/functions.php');

	$form_id = $_GET['id'];
	$form_weekday = $_GET['weekday'];
	$form_time = urldecode($_GET['time']);
	$form_cycle = $_GET['cycle'];

	if ($form_id != "") {
		$sql = "SELECT name, weekday_start, weekday_end, time_start, time_end, cycle, special, link, password FROM " . $db_prefix . "calendar WHERE id = " . $form_id . ";";
		$result = mysql_query($sql,$db);
		$num_rows = mysql_num_rows($result);

		if ($num_rows != FALSE) {
			$myrow = mysql_fetch_row($result);
			$db_name = $myrow[0];
			$db_weekday_start = $myrow[1];
			$db_weekday_end = $myrow[2];
			$db_time_start = $myrow[3];
				$db_time_start_hour = substr($db_time_start, 0, 2);
				$db_time_start_minute = substr($db_time_start, 3, 2);
			$db_time_end = $myrow[4];
				$db_time_end_hour = substr($db_time_end, 0, 2);
				$db_time_end_minute = substr($db_time_end, 3, 2);
			$db_cycle = $myrow[5];
			$db_special = $myrow[6];
			$db_link = $myrow[7];
			$db_password = $myrow[8];
		}
	}
	else {
		$db_weekday_start = $form_weekday;
		$db_weekday_end = $form_weekday;
		$db_time_start_hour = substr($form_time, 0, 2);
		$db_time_start_minute = substr($form_time, 3, 2);
		$db_time_end_hour = substr($form_time, 0, 2) + 1;
		$db_time_end_minute = substr($form_time, 3, 2);
		$db_cycle = $form_cycle;
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
	<HEAD>
		<TITLE>Calendar</TITLE>
		<LINK rel="stylesheet" type="text/css" href="default.css">

		<SCRIPT language="JavaScript" type="text/JavaScript">
			<!--
				function set_time_begin() {
					if (parseInt(document.entry.time_end_hour.value) < parseInt(document.entry.time_start_hour.value)) {
						document.entry.time_end_hour.value = parseInt(document.entry.time_start_hour.value) + 1;
					}
					if ( (parseInt(document.entry.time_end_minute.value) < parseInt(document.entry.time_start_minute.value)) &&
						(parseInt(document.entry.time_end_hour.value) == parseInt(document.entry.time_start_hour.value)) ) {
						document.entry.time_end_minute.value = document.entry.time_start_minute.value;
					}
				}

				function set_time_end() {
					if (parseInt(document.entry.time_start_hour.value) > parseInt(document.entry.time_end_hour.value)) {
						document.entry.time_start_hour.value = parseInt(document.entry.time_end_hour.value) - 1;
					}
					if ( (parseInt(document.entry.time_start_minute.value) > parseInt(document.entry.time_end_minute.value)) &&
						(parseInt(document.entry.time_end_hour.value) == parseInt(document.entry.time_start_hour.value)) ) {
						document.entry.time_start_minute.value = document.entry.time_end_minute.value;
					}

					if (parseInt(document.entry.time_end_hour.value) == '24') {
						document.entry.time_end_minute.value = '00';
					}
				}

				function set_date_begin() {
					if (document.entry.weekday_end.value < document.entry.weekday_start.value) {
						document.entry.weekday_end.value = document.entry.weekday_start.value;
					}
				}

				function set_date_end() {
					if (document.entry.weekday_start.value > document.entry.weekday_end.value) {
						document.entry.weekday_start.value = document.entry.weekday_end.value;
					}
				}

				function set_cycle(i) {
					document.entry.cycle[i].checked = true;
				}
			//-->
		</SCRIPT>
	</HEAD>

	<BODY onload="javascript:document.entry.name.focus();">
		<form name="entry" method="post" action="save.php">
			<table border="0">
				<tr>
					<td>Name</td>
        			<td>
        				<input type="text" name="name" size="<?PHP echo($inputfield_size); ?>" maxlength="80" value="<?PHP echo($db_name); ?>">
        			</td>
      			</tr>

      			<tr>
        			<td>&nbsp;</td>
        			<td>
        				<input name="special" type="checkbox" value="special" <?PHP if ($db_special == "1") echo("checked"); ?>> Special entry
        			</td>
      			</tr>
      			<tr>
      				<td>Weekday</td>
      				<td><select name="weekday_start" size="1" onChange="javascript:set_date_begin();">
							<option value="1" <?PHP if ($db_weekday_start == "1") echo("selected"); ?>><?PHP echo(weekday(1)); ?></option>
							<option value="2" <?PHP if ($db_weekday_start == "2") echo("selected"); ?>><?PHP echo(weekday(2)); ?></option>
							<option value="3" <?PHP if ($db_weekday_start == "3") echo("selected"); ?>><?PHP echo(weekday(3)); ?></option>
							<option value="4" <?PHP if ($db_weekday_start == "4") echo("selected"); ?>><?PHP echo(weekday(4)); ?></option>
							<option value="5" <?PHP if ($db_weekday_start == "5") echo("selected"); ?>><?PHP echo(weekday(5)); ?></option>
							<option value="6" <?PHP if ($db_weekday_start == "6") echo("selected"); ?>><?PHP echo(weekday(6)); ?></option>
							<option value="7" <?PHP if ($db_weekday_start == "7") echo("selected"); ?>><?PHP echo(weekday(7)); ?></option>
				        </select>
						-
						<select name="weekday_end" size="1" onChange="javascript:set_date_end();">
							<option value="1" <?PHP if ($db_weekday_end == "1") echo("selected"); ?>><?PHP echo(weekday(1)); ?></option>
							<option value="2" <?PHP if ($db_weekday_end == "2") echo("selected"); ?>><?PHP echo(weekday(2)); ?></option>
							<option value="3" <?PHP if ($db_weekday_end == "3") echo("selected"); ?>><?PHP echo(weekday(3)); ?></option>
							<option value="4" <?PHP if ($db_weekday_end == "4") echo("selected"); ?>><?PHP echo(weekday(4)); ?></option>
							<option value="5" <?PHP if ($db_weekday_end == "5") echo("selected"); ?>><?PHP echo(weekday(5)); ?></option>
							<option value="6" <?PHP if ($db_weekday_end == "6") echo("selected"); ?>><?PHP echo(weekday(6)); ?></option>
							<option value="7" <?PHP if ($db_weekday_end == "7") echo("selected"); ?>><?PHP echo(weekday(7)); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Time</td>
					<td><select name="time_start_hour" size="1" onChange="javascript:set_time_begin();">
						<option value="0"  <?PHP if ($db_time_start_hour ==  0) echo("selected"); ?>>0</option>
						<option value="1"  <?PHP if ($db_time_start_hour ==  1) echo("selected"); ?>>1</option>
						<option value="2"  <?PHP if ($db_time_start_hour ==  2) echo("selected"); ?>>2</option>
						<option value="3"  <?PHP if ($db_time_start_hour ==  3) echo("selected"); ?>>3</option>
						<option value="4"  <?PHP if ($db_time_start_hour ==  4) echo("selected"); ?>>4</option>
						<option value="5"  <?PHP if ($db_time_start_hour ==  5) echo("selected"); ?>>5</option>
						<option value="6"  <?PHP if ($db_time_start_hour ==  6) echo("selected"); ?>>6</option>
						<option value="7"  <?PHP if ($db_time_start_hour ==  7) echo("selected"); ?>>7</option>
						<option value="8"  <?PHP if ($db_time_start_hour ==  8) echo("selected"); ?>>8</option>
						<option value="9"  <?PHP if ($db_time_start_hour ==  9) echo("selected"); ?>>9</option>
						<option value="10" <?PHP if ($db_time_start_hour == 10) echo("selected"); ?>>10</option>
						<option value="11" <?PHP if ($db_time_start_hour == 11) echo("selected"); ?>>11</option>
						<option value="12" <?PHP if ($db_time_start_hour == 12) echo("selected"); ?>>12</option>
						<option value="13" <?PHP if ($db_time_start_hour == 13) echo("selected"); ?>>13</option>
						<option value="14" <?PHP if ($db_time_start_hour == 14) echo("selected"); ?>>14</option>
						<option value="15" <?PHP if ($db_time_start_hour == 15) echo("selected"); ?>>15</option>
						<option value="16" <?PHP if ($db_time_start_hour == 16) echo("selected"); ?>>16</option>
						<option value="17" <?PHP if ($db_time_start_hour == 17) echo("selected"); ?>>17</option>
						<option value="18" <?PHP if ($db_time_start_hour == 18) echo("selected"); ?>>18</option>
						<option value="19" <?PHP if ($db_time_start_hour == 19) echo("selected"); ?>>19</option>
						<option value="20" <?PHP if ($db_time_start_hour == 20) echo("selected"); ?>>20</option>
						<option value="21" <?PHP if ($db_time_start_hour == 21) echo("selected"); ?>>21</option>
						<option value="22" <?PHP if ($db_time_start_hour == 22) echo("selected"); ?>>22</option>
						<option value="23" <?PHP if ($db_time_start_hour == 23) echo("selected"); ?>>23</option>
					</select>
						<select name="time_start_minute" size="1" onChange="javascript:set_time_begin();">
						<option value="00" <?PHP if ($db_time_start_minute == 00) echo("selected"); ?>>00</option>
						<option value="15" <?PHP if ($db_time_start_minute == 15) echo("selected"); ?>>15</option>
						<option value="30" <?PHP if ($db_time_start_minute == 30) echo("selected"); ?>>30</option>
						<option value="45" <?PHP if ($db_time_start_minute == 45) echo("selected"); ?>>45</option>
					</select>
					-
					<select name="time_end_hour" size="1" onChange="javascript:set_time_end();">
					  <option value="0"  <?PHP if ($db_time_end_hour ==  0) echo("selected"); ?>>0</option>
					  <option value="1"  <?PHP if ($db_time_end_hour ==  1) echo("selected"); ?>>1</option>
					  <option value="2"  <?PHP if ($db_time_end_hour ==  2) echo("selected"); ?>>2</option>
					  <option value="3"  <?PHP if ($db_time_end_hour ==  3) echo("selected"); ?>>3</option>
					  <option value="4"  <?PHP if ($db_time_end_hour ==  4) echo("selected"); ?>>4</option>
					  <option value="5"  <?PHP if ($db_time_end_hour ==  5) echo("selected"); ?>>5</option>
					  <option value="6"  <?PHP if ($db_time_end_hour ==  6) echo("selected"); ?>>6</option>
					  <option value="7"  <?PHP if ($db_time_end_hour ==  7) echo("selected"); ?>>7</option>
					  <option value="8"  <?PHP if ($db_time_end_hour ==  8) echo("selected"); ?>>8</option>
					  <option value="9"  <?PHP if ($db_time_end_hour ==  9) echo("selected"); ?>>9</option>
					  <option value="10" <?PHP if ($db_time_end_hour == 10) echo("selected"); ?>>10</option>
					  <option value="11" <?PHP if ($db_time_end_hour == 11) echo("selected"); ?>>11</option>
					  <option value="12" <?PHP if ($db_time_end_hour == 12) echo("selected"); ?>>12</option>
					  <option value="13" <?PHP if ($db_time_end_hour == 13) echo("selected"); ?>>13</option>
					  <option value="14" <?PHP if ($db_time_end_hour == 14) echo("selected"); ?>>14</option>
					  <option value="15" <?PHP if ($db_time_end_hour == 15) echo("selected"); ?>>15</option>
					  <option value="16" <?PHP if ($db_time_end_hour == 16) echo("selected"); ?>>16</option>
					  <option value="17" <?PHP if ($db_time_end_hour == 17) echo("selected"); ?>>17</option>
					  <option value="18" <?PHP if ($db_time_end_hour == 18) echo("selected"); ?>>18</option>
					  <option value="19" <?PHP if ($db_time_end_hour == 19) echo("selected"); ?>>19</option>
					  <option value="20" <?PHP if ($db_time_end_hour == 20) echo("selected"); ?>>20</option>
					  <option value="21" <?PHP if ($db_time_end_hour == 21) echo("selected"); ?>>21</option>
					  <option value="22" <?PHP if ($db_time_end_hour == 22) echo("selected"); ?>>22</option>
					  <option value="23" <?PHP if ($db_time_end_hour == 23) echo("selected"); ?>>23</option>
					  <option value="24" <?PHP if ($db_time_end_hour == 24) echo("selected"); ?>>24</option>
					</select>
					<select name="time_end_minute" size="1" onChange="javascript:set_time_end();">
					  <option value="00" <?PHP if ($db_time_end_minute == 00) echo("selected"); ?>>00</option>
					  <option value="15" <?PHP if ($db_time_end_minute == 15) echo("selected"); ?>>15</option>
					  <option value="30" <?PHP if ($db_time_end_minute == 30) echo("selected"); ?>>30</option>
					  <option value="45" <?PHP if ($db_time_end_minute == 45) echo("selected"); ?>>45</option>
					</select>
				</td>
      		</tr>
      		<tr>
	  			<td>Cycle</td>
				<td>
					<TABLE border="0" cellpadding="0" cellspacing="0">
						<TR>
							<TD onClick="javascript:set_cycle(0)">
							  <input type="radio" value="0" name="cycle" <?PHP if ($db_cycle == "0") echo("checked"); ?>> <?PHP echo(cycle(0)); ?>
							</TD>
							<TD onClick="javascript:set_cycle(1)">
							  <input type="radio" value="1" name="cycle" <?PHP if ($db_cycle == "1") echo("checked"); ?>> <?PHP echo(cycle(1)); ?>
							</TD>
							<TD onClick="javascript:set_cycle(2)">
							  <input type="radio" value="2" name="cycle" <?PHP if ($db_cycle == "2") echo("checked"); ?>> <?PHP echo(cycle(2)); ?>
							</TD>
					  </TR>
				  </TABLE>
				</td>
      		</tr>
      		<tr>
      			<td>Link</td>
      			<td><input type="text" name="link" size="<?PHP echo($inputfield_size); ?>" value="<?PHP echo($db_link); ?>"></td>
      		</tr>
      		<tr>
				<td colspan="2">
					<?PHP
					if (($form_password == $pass_calSuperuser) && ($form_id != "")) {
						echo("<P>
							The password for this entry is " . $db_password . "
						</P>");
					}
					?>
				</td>
      		</tr>
      		<tr>
				<td colspan="2"><input type="hidden" name="id" value="<?PHP echo($form_id); ?>">
				  <input type="submit" name="location" value="save">
				  <input type="button" name="location" value="cancel" onClick="self.location.href='calendar.php'"></td>
			</tr>
		</table>
    </form>
	</BODY>
</HTML>