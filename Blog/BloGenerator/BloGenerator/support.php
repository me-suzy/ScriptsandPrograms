<?php
  session_start();
  if ($_SESSION["blogen"] != "true"){
   header("Location:login.php");
   $_SESSION["error"] = "<font color=red>Wrong Password or User Name</font>";
   exit;  
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>BloGenerator Administration - Support</title>
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

Welcome to the BloGenerator Support page.
<br>
If you have any problems send an email to <a href="mailto:blogenerator@gmail.com?subject=BloGenerator%20Support">blogenerator@gmail.com</a>. For more support information please visit our website at <a href="http://blogenerator.cjb.net">blogenerator.cjb.net</a>



	</div>
    </td>
  </tr>
</table>
</body>
</html>

