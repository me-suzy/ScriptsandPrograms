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
<title>BloGenerator Administration - New Post</title>
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
<?php

if ($submit) {



require_once('connect.php');

$day=date("d");
$month=date("m");
$year=date("Y");

$year=date("Y");
$month=date("m");
$day=date("d");
$hour=date("h");
$minute=date("i");
$second=date("s");

$time="$year$month$day$hour$minute$second";


 $query = "INSERT INTO entries (title, text, picture, mood, year, month, day, time) VALUES ('$title','$text', '$picture','$mood','$year','$month', '$day','$time')";



mysql_query($query);
mysql_close();


echo "New Post submitted";

} else{

  // display form

if (!isset($_POST['submit']))
 { 

  ?>


<form method="post" action="<?php echo $PHP_SELF?>">

<table>
<tr>
<td colspan="2">
Welcome to the BloGenerator New Post page.

<br>
</td>
</tr>


<tr>
<td>
Post Title:</td><td><input type="Text" name="title" size="50"><br>
</td>
</tr>
<tr>
<td>
Picture URL:</td><td><input type="Text" name="picture" size="50"><br>
</td>
</tr>
<tr>
<td>
Post:</td><td><textarea rows="10" cols="50" maxlength="300" name="text"></textarea><br>
</td>
</tr>



<tr>
<td>
<input type="submit" name="submit" value="submit">
</td>
</tr>

</table>
</form>
  <?php



} // end if
}


?>




	</div>
    </td>
  </tr>
</table>
</body>
</html>
