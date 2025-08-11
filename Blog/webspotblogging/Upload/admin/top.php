<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$path = "../";
include("../inc/global.php");
$admincheck = 1;
include("../inc/checks.php");
?>
<html>
<head>
<style>
body{
font-family:Arial, Helvetica, sans-serif;
}
a:visited{
color:#0000FF;
}
</style>
<base target="mainframe">
<title>Top.php</title>
</head>
<body bgcolor="#EEEEEE">
<img src="logo.gif" style="float:left">
<div align="right">
<a href="../index.php" target="_parent">View Your Blog</a> | <a href="home.php">Admin CP Home</a> | <a href="logout.php" target="_parent">Logout <? echo $_SESSION['username']; ?></a>
</div>
</body>
</html>