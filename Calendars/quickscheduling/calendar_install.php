<?php
	/*on submit, intalling SimpleCalendar database and creating the calendar configuration file*/
	// ini_set('error_reporting', E_ALL);
	ini_set("display_errors",'1');
?>
<?
	if ($_POST[submit]=='Install')
	{
		//getting the link of the MySQL connection
		$link = @mysql_connect($_POST[txtHostName], $_POST[txtUserName], $_POST[txtPassword]);
		$connect_error = mysql_error();
		if(!$connect_error)
		{
			//creating database for SimpleCalender
			$create_database_query = "CREATE DATABASE $_POST[txtDatabaseName]";

			//executing create database query
			mysql_query($create_database_query, $link);
			$createdb_error = mysql_error();

			$installation_completion_message = " ";
			if($createdb_error)
			{
				$installation_completion_message .= "The database already exists. ";
			}

			//selecting database from active connection
			mysql_select_db($_POST[txtDatabaseName], $link) or die("Could not find database on ".$_POST[txtHostName]." : ".mysql_error());

			//to get the contents of sql script file
			// $file_string = file_get_contents('database_script.sql');

			/* read out the complete contents of the database script file */
			$sql_file_handle = fopen ('database_script.sql', "r");
			$file_string = fread ($sql_file_handle, filesize ('database_script.sql'));
			fclose ($sql_file_handle);

			//to get query array
			$query_array = explode(";",$file_string);

			//executing each query
			foreach ($query_array as $query)
			{
				//if query not empty, then only execute it
				if($query)
					mysql_query($query, $link) or die("Query Failed: ".mysql_error());
			}

			//creating calendar_config file
			$file_handle = fopen('calendar_config.php', 'w');

			//writing file content string
			$file_content = "<?php ";
			$file_content .= " \$host='$_POST[txtHostName]'; ";
			$file_content .= " \$user_name='$_POST[txtUserName]'; ";
			$file_content .= " \$password='$_POST[txtPassword]'; ";
			$file_content .= " \$database_name='$_POST[txtDatabaseName]'; ";
			$file_content .= "?>";

			//writing parameters string to the config file
			fwrite($file_handle, $file_content);

			//writing installation completion message
			$installation_completion_message .= "Simple Calendar has been setup successfully with"."<br>";
			$installation_completion_message .= "Administrator&nbsp;&nbsp;&nbsp; username : 'admin'&nbsp;&nbsp;  Password : 'admin'"."<br><br>";
			$installation_completion_message .= "<a href='login.php'>Click here to Login</a>";

			//closing file handle
			fclose($file_handle);
		}
	}

?>

<html>
	<head>
		<title>Install Simple Calendar</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
		<script type='text/javascript' src='javascript.js'></script>
		<script language='javascript'>

			function validate()
			{
				if((checkForBlank(document.forms[0].txtHostName, "Host Name")) || (checkForBlank(document.forms[0].txtUserName, "User Name")) ||  (checkForBlank(document.forms[0].txtPassword, "Password")) || (checkForBlank(document.forms[0].txtDatabaseName, "Database Name")))
					return false;
				else
					return true;
			}

		</script>

	</head>
	<body onload="document.forms[0].txtHostName.focus();">

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
					<form action="calendar_install.php" method="post" onsubmit="return validate();">
						<table width="440 px" border="0" align="left" valgin="top" cellpadding="3">
							<tr>
								<td colspan="3" height="120 px" align="center" valign="middle"><h3>Installation Details</h3></td>
							</tr>
							<tr>
								<td width="40 px"></td><td colspan="2"><b>Please provide the following installation details:<br><br></b></td>
							</tr>
							<tr height="10 px">
								<td  height="10 px" width="40 px"></td><td>Host Name:</td><td align="right"><input type="text" name="txtHostName" value='<?php print $_POST[txtHostName]?>'></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>User Name:</td><td align="right"><input type="text" name="txtUserName" value='<?php print $_POST[txtUserName]?>'></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>Password:</td><td align="right"><input type="password" name="txtPassword" value='<?php print $_POST[txtPassword]?>'></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td>Database Name:</td><td align="right"><input type="text" name="txtDatabaseName" value='<?php print $_POST[txtDatabaseName]?>'></input></td>
							</tr>
							<tr>
								<td width="40 px"></td><td colspan="2" align="right"><input type="submit" name="submit" value="Install" <?php if ($installation_completion_message) print " disabled ";?>></input></td>
							</tr>
							<?php
								if($connect_error)
								{
									print "<tr>\n";
										print "<td colspan='3' height='100 px' align='center' valign='middle'><b><font color=RED>Failed to establish connection to the database server with the host and user credentials provided. Please try again.<br><br>$connect_error</font></b></td>\n";
									print "</tr>\n";
								}
							?>
							<?php
								if ($installation_completion_message)
								{
									print "<tr>\n";
										print "<td colspan='3' height='100 px' align='center' valign='middle'><b><font color=BLUE>$installation_completion_message</font></b></td>\n";
									print "</tr>\n";
								}
							?>
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