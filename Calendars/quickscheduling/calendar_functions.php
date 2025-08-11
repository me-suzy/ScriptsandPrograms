
<?php
	//including mysql function file
	require_once 'mysqlfunctions.php';

	/*function which displays month as per the input date*/

	function display_month($day, $month, $year)
	{
		//getting number of days in the month
		$days_in_month = date("t", mktime(0, 0, 0, $month, 1, $year));

		//getting week day--> 0 for sunday; 1 for monday and so on
		$numeric_week_day = date("w", mktime(0, 0, 0, $month, 1, $year));

		print "<table width='100%' height='100%' border='1'>\n";

		//putting table header
		print "\t<tr>\n";
		print "\t\t<td width='14%' class='calHeader'>Sun</td>\n";
		print "\t\t<td width='14%' class='calHeader'>Mon</td>\n";
		print "\t\t<td width='14%' class='calHeader'>Tue</td>\n";
		print "\t\t<td width='14%' class='calHeader'>Wed</td>\n";
		print "\t\t<td width='14%' class='calHeader'>Thu</td>\n";
		print "\t\t<td width='15%' class='calHeader'>Fri</td>\n";
		print "\t\t<td width='15%' class='calHeader'>Sat</td>\n";
		print "\t</tr>\n";

		//displaying days of the month
		print "\t<tr>\n";
		for ($i = 1; $i <= $numeric_week_day; $i++)
		{
			print "\t\t<td align='center'></td>\n";
		}

		for($j = 1+$numeric_week_day; $j <= $days_in_month+$numeric_week_day; $j++)
		{
			$temp_day = $j-$numeric_week_day;
			if ($j == $day+$numeric_week_day)
				print "\t\t<td align='center' bgcolor='#FFFFCC'>";
			else
				print "\t\t<td align='center'>";

			print "<a href='$_SERVER[PHP_SELF]?date=$temp_day-$month-$year'>";
			print "$temp_day";
			print "</a></td>\n";

			if($j % 7 == 0)
			{
				print "\t</tr>\n";
				print "\t<tr>\n";
			}
		}
		print "\t</tr>\n";
		print "</table>\n";
	}


	/*function to display tasks of a particular user on a particular date*/

	function display_tasks($userid, $date, $sortby)
	{
		//getting database link
		$database_link = selection_of_db();

		//writing select query to get the required task rows
		$select_task_query = "select taskid, userid, description, TIME_FORMAT(startdatetime,'%h:%i %p') as Start_Time , TIME_FORMAT(enddatetime,'%h:%i %p') as End_Time, priority, iscompleted from calendar_tasks where userid like '$userid' and DATE_FORMAT(startdatetime,'%e-%c-%Y') like '$date' order by $sortby";

		//executing the select query
		$result = mysql_query($select_task_query, $database_link) or die("Query Failed : " . mysql_error());

		//displaying table header
		print "<table border='0' width='100%'>\n";
		print "\t<tr>\n";
			print "\t\t<td align='center'><b>Start Time</b></td>\n";
			print "\t\t<td align='center'><b>End Time</b></td>\n";
			print "\t\t<td align='center'><b>Description</b></td>\n";
			print "\t\t<td align='center'><b>Priority</b></td>\n";
			print "\t\t<td align='center'><b>Completed</b></td>\n";
			print "\t\t<td align='center'><b>Delete</b></td>\n";
		print "\t</tr>\n";

		//displaying all the tasks of the day
		while($row = mysql_fetch_array($result))
		{
			print "\t<tr>\n";
				print "\t\t<td align='center'>$row[Start_Time]</td>\n";
				print "\t\t<td align='center'>$row[End_Time]</td>\n";
				print "\t\t<td align='center'><a href='taskdetails.php?taskid=$row[taskid]'>$row[description]</a></td>\n";
				print "\t\t<td align='center'>$row[priority]</td>\n";

				//if task is marked as completed
				$check = ($row[iscompleted]==1) ? 'checked' : '';

				print "\t\t<td align='center'><input type='checkbox' name='chkIsComplete[]' value='$row[taskid]' $check onclick='document.forms[0].btnUpdate.disabled=false;'></td>\n";
				print "\t\t<td align='center'><input type='checkbox' name='chkDelete[]' value='$row[taskid]' onclick='document.forms[0].btnDelete.disabled=false;'></td>\n";
			print "\t</tr>\n";
		}

		//adding update and delete buttons
		print "\t<tr>\n";
			print "\t\t<td align='center' colspan='4'><input type='button' value='Add New Task' name='btnAddTask' onclick='javascript:window.location.href=\"taskdetails.php\"'></td>\n";
			print "\t\t<td align='center'><input type='submit' value='Update' name='btnUpdate' disabled onclick='document.forms[0].submit();'></td>\n";
			print "\t\t<td align='center'><input type='submit' value='Delete' name='btnDelete' disabled onclick='document.forms[0].submit();'></td>\n";
		print "\t</tr>\n";
		print "</table>\n";

		//closing DBConnection
		mysql_close($database_link);
	}


	/*function to display usernames along with check boxes*/

	function display_users()
	{
		//getting database link
		$database_link = selection_of_db();

		//writing select query to get the required task rows
		$select_users_query = "select userName,userID from users where userRoleID='2'";

		//executing the select query
		$result = mysql_query($select_users_query, $database_link) or die("Query Failed : " . mysql_error());

		//displaying table header
		print "<table border='0' width='100%'>\n";
		print "\t<tr>\n";
			print "\t\t<td align='center'><b>Delete</b></td>\n";
			print "\t\t<td align='center'><b>Make Admin</b></td>\n";
			print "\t\t<td align='center'><b>User Name</b></td>\n";
		print "\t</tr>\n";

		//displaying all users
		while($row = mysql_fetch_array($result))
		{
			print "\t<tr>\n";
				print "\t\t<td align='center'><input type='checkbox'  name='chkDelete[]' value='$row[userID]' onclick='document.forms[0].btnDelete.disabled=false;'></td>\n";
				print "\t\t<td align='center'><input type='checkbox'  name='chkMakeAdmin[]' value='$row[userID]' onclick='document.forms[0].btnMakeAdmin.disabled=false;'></td>\n";
				print "\t\t<td align='center'>$row[userName]</td>\n";
			print "\t</tr>\n";
		}

		print "\t<tr>\n";
			print "\t\t<td align='center'><input type='submit' value='Delete' name='btnDelete' disabled></td>\n";
			print "\t\t<td align='center'><input type='submit' value='Make Admin' name='btnMakeAdmin' disabled></td>\n";
			print "\t\t<td align='left'>&nbsp;</td>\n";
		print "\t</tr>\n";
		print "</table>\n";
	}
?>