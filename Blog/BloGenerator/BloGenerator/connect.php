<?php

//Read and follow the clearly marked instructions below.

// <-- Instructions -->
// replace "localhost" with your host name. If you're not sure what to put, leave localhost.
// <--End  Instructions -->
$dbhost=localhost;

// <-- Instructions -->
// replace "database_name" with the MySQL database name. 
// <--End  Instructions -->
$dbname=database_name;

// <-- Instructions -->
// replace "username" with the MySQL database username.
// <--End  Instructions -->
$dbusername=username;

// <-- Instructions -->
// replace "password" with the MySQL database password.
// <--End  Instructions -->
$dbpassword=password;


$db=mysql_connect ($dbhost, $dbusername, $dbpassword) or die ('Error - cannot connect to the database because: ' . mysql_error());

  mysql_select_db($dbname,$db);

?>




















