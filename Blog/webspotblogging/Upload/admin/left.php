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
font-size:12px;
font-family:Arial, Helvetica, sans-serif;
}
.box{
border:#000000 1px solid;
background-color:#FFFFEE
}
.long{
border-bottom:#000000 1px solid;
width:100%;
background-color:#70B66D;
}
a:visited{
color:#0000FF;
}
</style>
<title>Left.php</title>
<base target="mainframe">
</head>
<body bgcolor="#EEEEEE">
<div align="center">

<div class="box">
<div class="long">
<b>Main Panels</b>
</div>

<a href="home.php">Admin CP Home</a><BR>
<a href="version.php">Version Check</a><BR>
<a href="credits.php">Credits</a><BR><BR>
</div><BR>
<div class="box">
<div class="long">
<b>Settings</b>
</div>
<a href="settings/general.php">General Settings</a><BR>
<a href="settings/date.php">Date / Time Settings</a><BR>
<a href="settings/display.php">Display Settings</a><BR><BR>
</div><BR>
<div class="box">
<div class="long">
<b>Themes</b>
</div><a href="themes/add.php">New Theme</a><BR>
<a href="themes/index.php">List themes</a><BR>
<a href="themes/import.php">Import Themes</a><BR>
<a href="themes/export.php">Export Themes</a><BR><BR>
</div><BR>
<div class="box">
<div class="long">
<b>User Panels</b>
</div>
<a href="users/index.php">Show Users</a><BR>
<a href="users/add.php">Add User</a><BR><BR>
</div><BR>

<div class="box">
<div class="long">
<b>Post Images</b>
</div>
<a href="images/index.php">List Images</a><BR>
<a href="images/add.php">Add Image</a><BR><BR>
</div>

</div>
</body>
</html>