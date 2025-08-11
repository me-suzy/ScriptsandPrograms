<?php
session_start();

//Authenticating Users

require_once('connect.php');

$query='SELECT * FROM auth';

$result=@mysql_query($query);

$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {

$passw=mysql_result($result,$i,"password");
$user=mysql_result($result,$i,"username");

$i++;
}


if (($_POST["username"] == $user) and
($_POST["password"] == $passw)){
$_SESSION["blogen"] = "true";
}

 if ($_SESSION["blogen"] == "true"){
   

?>



<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>BloGenerator Administration- Admin Home</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="600" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td height="60" colspan="2" valign="top"><img src="title.jpg" width="332" height="54"></td>
  </tr>
  <tr>
    <td >

	<div class="rollover"><a href="admin.php">Admin Home</a>
   <a href="new.php">New Post</a>
    <a href="update.php">Update</a>
<a href="support.php">Support</a>
    <a href="index.php">Your Blog</a></div>
	<div id="adminmain"> 

Welcome to the BloGenerator Admin Home.
<br>
Click New Post to begin blogging.
Click Update to change your user information.
Click Support for help. 
Click Your Blog to view your blog.


	</div>
    </td>
  </tr>
</table>
</body>
</html>






<?php


} else {
echo "<font color=red>Wrong
username or password. Click <a href='login.php'>here</a> to try again.</fonts>";
$_SESSION["error"] = "<font color=red>Wrong
username or password. Try again.</fonts>";
}



?>

