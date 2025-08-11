<?php
	session_start();

	if ($_POST[btnSave]=='Modify')
	{
		//including mysql function file
		require_once 'mysqlfunctions.php';

		//getting database link
		$database_link = selection_of_db();

		$time_units = explode(":", trim($_POST[txtStartTime]) );
		$hours = $time_units[0];
		$mins = $time_units[1];

		if( $_POST[startAMPM] == 'AM' && $hours == 12) {
		   $hours = "00";
		}
		if( $_POST[startAMPM] == 'PM' && $hours != 12) {
		   $hours += 12;
		}
		$newStartDateTime = "$_POST[txtDate] $hours:$mins:00";

		$time_units = explode(":", trim($_POST[txtEndTime]) );
		$hours = $time_units[0];
		$mins = $time_units[1];

		if( $_POST[endAMPM] == 'AM' && $hours == 12) {
		   $hours = "00";
		}
		if( $_POST[endAMPM] == 'PM' && $hours != 12) {
		   $hours += 12;
		}
		$newEndDateTime = "$_POST[txtDate] $hours:$mins:00";

		//writing update query
		$update_task_query = "update calendar_tasks set description='$_POST[txtDescription]', startdatetime='$newStartDateTime', enddatetime='$newEndDateTime', priority='$_POST[selPriority]' where taskid=$_POST[modify_taskid]";

		//executing update query
		mysql_query($update_task_query, $database_link) or die("Query Failed : " . mysql_error());

		//redirecting control to the calendar page
		header("Location: calendar.php");

		//closing DBConnection
		mysql_close($database_link);

		//exiting from this page
		exit;
	}

	elseif ($_POST[btnSave]=='Add')
	{
		//including mysql function file
		require_once 'mysqlfunctions.php';

		//getting database link
		$database_link = selection_of_db();

		$time_units = explode(":", trim($_POST[txtStartTime]) );
		$hours = $time_units[0];
		$mins = $time_units[1];

		if( $_POST[startAMPM] == 'AM' && $hours == 12) {
		   $hours = "00";
		}
		if( $_POST[startAMPM] == 'PM' && $hours != 12) {
		   $hours += 12;
		}
		$newStartDateTime = "$_POST[txtDate] $hours:$mins:00";

		$time_units = explode(":", trim($_POST[txtEndTime]) );
		$hours = $time_units[0];
		$mins = $time_units[1];

		if( $_POST[endAMPM] == 'AM' && $hours == 12) {
		   $hours = "00";
		}
		if( $_POST[endAMPM] == 'PM' && $hours != 12) {
		   $hours += 12;
		}
		$newEndDateTime = "$_POST[txtDate] $hours:$mins:00";

		//writing insert query
		$insert_task_query = "insert into calendar_tasks values ('','$_SESSION[userid]','$_POST[txtDescription]','$newStartDateTime','$newEndDateTime','$_POST[selPriority]','0')";

		//executing insert query
		mysql_query($insert_task_query, $database_link) or die("Query Failed : " . mysql_error());

		//redirecting control to the calendar page
		header("Location: calendar.php");

		//closing DBConnection
		mysql_close($database_link);

		//exiting from this page
		exit;
	}


	if ($_GET[taskid])
	{
		//including calendar function file
		require_once 'calendar_functions.php';

		//getting database link
		$database_link = selection_of_db();

		//select query to get task details
		$select_task_query = "select DATE_FORMAT(startdatetime,'%Y-%m-%d') as Start_Date, description, TIME_FORMAT(startdatetime,'%h:%i') as Start_Time , TIME_FORMAT(enddatetime,'%h:%i') as End_Time, priority, TIME_FORMAT(startdatetime, '%H') as start_hour, TIME_FORMAT(enddatetime, '%H') as end_hour from calendar_tasks where taskid like '$_GET[taskid]'";

		//executing the select query
		$result = mysql_query($select_task_query, $database_link) or die("Query Failed : " . mysql_error());

		//obtain the task row
		$task_row = mysql_fetch_array($result);

		//date on this page
		$date = $task_row[Start_Date];

		//closing DBConnection
		mysql_close($database_link);

	}
	else
	{
		//date on this page
		$array_date = explode("-",$_SESSION[calendar_show_date]);
		$date="$array_date[2]-$array_date[1]-$array_date[0]";
	}

	//formating date for display purpose
	$temp_date_array = explode("-", $date);
	$display_date = date("j F Y", mktime(0, 0, 0, $temp_date_array[1], $temp_date_array[2], $temp_date_array[0]));


?>
<html>
	<head>
		<title>Task Details</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
		<script type='text/javascript' src='javascript.js'></script>
		<script language='javascript'>

			function validate()
			{
				if((checkForBlank(document.forms[0].txtDescription, "Description")) || (checkForBlank(document.forms[0].txtStartTime, "Start Time")) || (checkForBlank(document.forms[0].txtEndTime, "End Time")))
					return false;
				else
					return true;
			}
		</script>

	</head>
	<body onload='document.forms[0].txtDescription.focus();'>
		<table width="100%" height="100%" border="0" cellpadding="5" cellspacing="0">
			<tr>
				<td width="150 px" class="menu" valign="top">
					<table width="100%" height="100%" border="0">
						<tr>
							<td class="menuheader" height="40 px" valign="middle"><i>Simple Calendar</i></td>
						</tr>
						<tr>
							<td valign="top"></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<form action="taskdetails.php" method = "post" onsubmit="return validate();">
					<!-- hidden control to store taskid -->
						<input type="hidden" name="modify_taskid" value='<?php print "$_GET[taskid]"?>'>
						<table width="480 px" border="0" align="left" valgin="top" cellpadding="3">
							<tr>
								<td colspan="4" height="50 px" align="center" valign="bottom"><h3>Task Details</h3></td>
							</tr>
							<tr>
								<td colspan=4>
									<table border="0" width="100%">
										<tr>
											<td align="right"><b>Date:</b>&nbsp;&nbsp;&nbsp;</td>
											<td align="left">
												<!-- hidden control to store currently selected date -->
												<input type="hidden" name="txtDate" value='<?php print "$date";?>'>
												<input type="text" name="" readonly value='<?php print "$display_date";?>'>
											</td>
											<td align="right"><b>Priority:</b>&nbsp;&nbsp;&nbsp;</td>
											<td align="left">
												<select name="selPriority">
													<option value="Critical" <?php if ($task_row[priority]=="Critical") print "selected"; ?>>Critical</option>
													<option value="High" <?php if ($task_row[priority]=="High") print "selected"; ?>>High</option>
													<option value="Low" <?php if ($task_row[priority]=="Low") print "selected"; ?>>Low</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="4">&nbsp;</td>
										</tr>
										<tr>
											<td align="right"><b>Description:</b>&nbsp;&nbsp;&nbsp;</td>
											<td align="left" colspan=3><textarea name="txtDescription" rows=2 cols=42><?php print "$task_row[description]";?></textarea></td>
										</tr>
										<tr>
											<td colspan="4">&nbsp;</td>
										</tr>
										<tr>
											<td align="right"><b>Start Time:</b>&nbsp;&nbsp;&nbsp;</td>
											<td align="left">
												<input type="textbox" name="txtStartTime" size=5 maxlength=5 value='<?php print "$task_row[Start_Time]";?>'>
												<select name="startAMPM">
													<option value="AM" <?php if ($task_row[start_hour] < 12) print "selected"; ?>>AM</option>
													<option value="PM" <?php if ($task_row[start_hour] > 11) print "selected"; ?>>PM</option>
												</select>
												<br>
												(<b>hh:mm</b> format)
											</td>
											<td align="right"><b>End Time:</b>&nbsp;&nbsp;&nbsp;</td>
											<td align="left">
												<input type="textbox" name="txtEndTime" size=5 maxlength=5 value='<?php print "$task_row[End_Time]";?>'>
												<select name="endAMPM">
													<option value="AM" <?php if ($task_row[end_hour] < 12) print "selected"; ?>>AM</option>
													<option value="PM" <?php if ($task_row[end_hour] > 11) print "selected"; ?>>PM</option>
												</select>
												<br>
												(<b>hh:mm</b> format)
											</td>
										</tr>
										<tr>
											<td colspan="4">&nbsp;</td>
										</tr>
										<tr>
										</tr>
										<tr>
											<td align="center" colspan=4><input type="submit" name="btnSave" value='<?php if ($_GET[taskid]) print "Modify"; else print "Add"; ?>'>
												&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="btnBack" value='Back' onclick="javascript:history.back()">
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
	
<p align="center"><font color="#FFFFFF" size="1"><strong> 
  <? include("http://www.quickscheduling.com/infinitimgt.php") ?>
  </strong></font></p>
</body>
</html>