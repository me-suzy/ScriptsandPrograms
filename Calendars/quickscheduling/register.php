<?php
	// Initialize the session.
	session_start();

	//if new member has registered
	if ($_POST[submit]=='Register')
	{
		//including MySQL functions file
		require_once 'mysqlfunctions.php';

		//getting database link
		$database_link = selection_of_db();

		//writing select query to check if database already has the username which is requested by new user
		$username_select_query = "select * from users where username like '$_POST[txtUserName]'";

		//executing above select query
		$result = mysql_query($username_select_query, $database_link);

		//if no row found then save user info to 'users' table
		if (!mysql_num_rows($result))
		{
			//writing Insert query to add a new record to 'users' table
			$insert_new_user_query = "insert into users values('','$_POST[txtUserName]',password('$_POST[txtPassword]'),'2','$_POST[txtFirstName]','$_POST[txtLastName]','$_POST[txtEmail]')";

			//executing insert query
			mysql_query($insert_new_user_query, $database_link) or die("insert_new_user_query Failed : " . mysql_error());

			//closing the database link
			mysql_close($database_link);	

			//setting registration confirmation message
			$_SESSION[registration_confirm_string] = "You have been registered sucessfully";

			//redirecting control to the login page
			header("Location: login.php");

			//closing DBConnection
			mysql_close($database_link);
			
			//exiting from this page
			exit;
		}
		else
		{
			//set error flag for this page
			$error_flag = 1;

			//set user name error message
			$error_message = "Username <u>'$_POST[txtUserName]'</u> already exists, please select some other username";
		}
		//closing DBConnection
		mysql_close($database_link);
	}
?>
<html>
	<head>
		<title>User Registration Form</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
		<script type='text/javascript' src='javascript.js'></script>
		<script language='javascript'>		

			function validate()
			{
				
				if((checkForBlank(document.forms[0].txtFirstName, "First Name")) || (checkForBlank(document.forms[0].txtLastName, "Last Name")) || (checkForBlank(document.forms[0].txtUserName, "User Name")) || (checkForBlank(document.forms[0].txtPassword, "Password")) || (checkForBlank(document.forms[0].txtVerifyPassword, "Verify Password")) || (checkForBlank(document.forms[0].txtEmail, "Email")))
					return false;
				if (document.forms[0].txtVerifyPassword.value != document.forms[0].txtPassword.value)
				{
					alert("Password and Verify Password values are not same");
					document.forms[0].txtPassword.value="";
					document.forms[0].txtVerifyPassword.value="";
					document.forms[0].txtPassword.focus();
					return false;
				}
					return true;				
			}

		</script>
	</head>
	<body <?php	if (!isset($error_flag)) print "onload='document.forms[0].txtFirstName.focus();'"; ?>>
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
					<form action="register.php" method="post" onsubmit="return validate();">
						<table width="440 px" border="0" align="left" valgin="top" cellpadding="3">
							<tr>
								<td colspan="3" height="120 px" align="center" valign="middle"><h3>Registration Form</h3></td>
							</tr>
							<?php
								//inserting username error message
								if (isset($error_flag))
								{
									print "<tr>\n";
									print "<td width='40 px'></td><td colspan='2'><b><font color=red>$error_message</font><br><br></b></td>";
									print "</tr>\n";
								}
							?>
							<tr>
								<td width="40 px"></td><td colspan="2"><b>Please provide the following details:<br><br></b></td>
							</tr>
							<tr height="10 px">
								<td  height="10 px" width="40 px"></td><td>First Name:</td><td align="right"><input type="text" name="txtFirstName" value="<?php print $_POST[txtFirstName]?>"></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>Last Name:</td><td align="right"><input type="text" name="txtLastName"  value="<?php print $_POST[txtLastName]?>"></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>User Name:</td><td align="right"><input type="text" name="txtUserName" value="<?php print $_POST[txtUserName]?>"></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>Password:</td><td align="right"><input type="Password" name="txtPassword"  value="<?php print $_POST[txtPassword]?>"></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>Verify Password:</td><td align="right"><input type="password" name="txtVerifyPassword"  value="<?php print $_POST[txtVerifyPassword]?>"></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>E-mail Address:</td><td align="right"><input type="text" name="txtEmail"  value="<?php print $_POST[txtEmail]?>"></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td colspan="2" align="right"><input type="submit" name="submit" value="Register"></input></td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
	<?php
		if (isset($error_flag))
		{
			//javascript code --> if user name error flag is set then set focus on the username
			$javascript = "<script language='javascript'>\n";
			$javascript .= "document.forms[0].txtUserName.focus();\n";
			$javascript .= "</script>\n";
			print $javascript;
		}
	?>
	</body>
	</html>