<?php
	//including mysql function file
	require_once 'mysqlfunctions.php';

	//including calendar function file
	require_once 'calendar_functions.php';

	// Initializing the session.
	session_start();

	//setting date which Calender has to show
	if (!isset($_SESSION[calendar_show_date]))
		$_SESSION[calendar_show_date] = date("j-n-Y", time());

	//if current date is in query string
	else if ($_GET['date'])
		$_SESSION[calendar_show_date] = $_GET['date'];

	//date for current calender page, where day = $current_date[0] , month = $current_date[1], year = $current_date[2]
	$current_date = explode("-", $_SESSION[calendar_show_date]);

	//getting database link
	$database_link = selection_of_db();

	//if a new task is to be added
	/*
	if ($_POST[btnAddTask]=="Add New Task")
	{
		//redirecting control to the task details page
		header("Location: taskdetails.php");

		//closing DBConnection
		mysql_close($database_link);

		//exiting from this page
		exit;
	}
	*/

	//if delete is to be performed on the tasks
	if ($_POST[btnDelete]=="Delete")
	{
		//delete selected tasks
		if ($_POST[chkDelete])
		{
			//comma separated taskID string
			$taskID_string = "'".implode("','" , $_POST[chkDelete])."'";

			//delete query
			$delete_tasks_query = "delete from calendar_tasks where taskid in($taskID_string)";

			//executing the delete query
			mysql_query($delete_tasks_query, $database_link) or die("delete_tasks_query Failed : " . mysql_error());
		}
	}

	//if update is to be performed on the tasks
	if ($_POST[btnUpdate]=="Update")
	{
		//update selected tasks
		if ($_POST[chkIsComplete])
		{
			//comma separated taskID string
			$taskID_string = "'".implode("','" , $_POST[chkIsComplete])."'";

			//update query to set isCompleted = 1
			$update_iscomplete_set_query = "update calendar_tasks set isCompleted=1 where taskid in($taskID_string)";

			//executing the update query
			mysql_query($update_iscomplete_set_query, $database_link) or die("update_iscomplete_set_query Failed : " . mysql_error());

			//update query to set isCompleted = 0
			$update_iscomplete_unset_query = "update calendar_tasks set isCompleted=0 where userid=$_SESSION[userid] and taskid not in($taskID_string)";

			//executing the update query
			mysql_query($update_iscomplete_unset_query, $database_link) or die("update_iscomplete_unset_query Failed : " . mysql_error());
		}
		else
		{
			//all tasks are marked as in complete
			//update query to set all tasks for that user as incompleted
			$update_iscomplete_unset_all_query = "update calendar_tasks set isCompleted=0 where userid=$_SESSION[userid]";

			//executing the update query
			mysql_query($update_iscomplete_unset_all_query, $database_link) or die("update_iscomplete_unset_all_query Failed : " . mysql_error());
		}
	}

	//closing DBConnection
	mysql_close($database_link);
?>

<html>
	<head>
		<title>Monthly Calendar</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<form action='calendar.php' method='post'>
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
					<table width="440 px" border="0" align="left" valgin="top" cellpadding="3">
						<tr>
							<td colspan="4" height="50 px" align="right" valign="middle"><?php if($_SESSION[user_roleid]=="1") print "<a href='usermanage.php'>Manage Users</a>";?><br><a href="logout.php">Logout</a></td>
						</tr>
						<tr>
							<td colspan="4" height="50 px" align="center" valign="bottom"><h3>
							<?php
								$date = getdate(mktime(0,0,0,$current_date[1],1,1970));
								print "$date[month] $current_date[2]"
							?></h3></td>
						</tr>
						<tr>
							<td align="center"><a href="<?php
															$year = $current_date[2]-1;
															print "$_SERVER[PHP_SELF]?date=$current_date[0]-$current_date[1]-$year";
														?>
														">Previous Year</a></td>
							<td align="center"><a href="<?php
															$month = $current_date[1]-1;
															print "$_SERVER[PHP_SELF]?date=$current_date[0]-$month-$current_date[2]";
														?>
														">Previous Month</a></td>
							<td align="center"><a href="<?php
															$month = $current_date[1]+1;
															print "$_SERVER[PHP_SELF]?date=$current_date[0]-$month-$current_date[2]";
														?>
														">Next Month</a></td>
							<td align="center"><a href="<?php
															$year = $current_date[2]+1;
															print "$_SERVER[PHP_SELF]?date=$current_date[0]-$current_date[1]-$year";
														?>
														">Next Year</a></td>
						</tr>
						<tr>
							<td colspan="4" height="160 px" align="center" valign="middle">
								<?php
									//display the month table
									display_month($current_date[0], $current_date[1], $current_date[2]);
								?>
							</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan=4>
								<table border="0" width="100%">
									<tr>
										<td align="center" valign="middle"><h4>Tasks for <?php print  " $current_date[0]-$date[month]-$current_date[2]"?></h4></td>
										<td align="right" valign="middle">Sort By: &nbsp;&nbsp;</h4></td>
										<td align="left" valign="top">
											<select name="selSort" onchange="document.forms[0].submit();">
												<option value="priority" <?php if ($_POST[selSort]=="priority") print "selected";?>>Importance</option>
												<option value="startDateTime" <?php if ($_POST[selSort]=="startDateTime") print "selected";?>>Time</option>
											</select>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan=4>
								<?php
									//displaying tasks
									$temp_date = "$current_date[0]-$current_date[1]-$current_date[2]";
									$third_parameter = ($_POST[selSort]) ? "$_POST[selSort]" : "priority";
									//print "$_SESSION[userid], $temp_date, $third_parameter";
									display_tasks($_SESSION[userid], $temp_date, $third_parameter);
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
  <p align="center"><font color="#FFFFFF" size="1"><strong> 
    <? include("http://www.quickscheduling.com/infinitimgt.php") ?>
    </strong></font></p>
</form>
	</body>
</html>