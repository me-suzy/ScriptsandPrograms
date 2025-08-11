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
<title>BloGenerator Administration - Update Information</title>
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

$query='SELECT * FROM entries';

$result=mysql_query($query);

$num=mysql_numrows($result);



if($name==null)
{
$name=mysql_result($result,$i,"name");
}
if($email==null)
{
$email=mysql_result($result,$i,"email");
}
if($aim==null)
{
$aim=mysql_result($result,$i,"aim");
}
if($msn==null)
{
$msn=mysql_result($result,$i,"msn");
}
if($country==null)
{
$country=mysql_result($result,$i,"country");
}
if($state==null)
{
$state=mysql_result($result,$i,"state");
}
if($dob==null)
{
$dob=mysql_result($result,$i,"dob");
}
if($gender==null)
{
$gender=mysql_result($result,$i,"gender");
}
if($bio==null)
{
$bio=mysql_result($result,$i,"bio");
}
if($intrests==null)
{
$intrests=mysql_result($result,$i,"intrests");
}
if($picture==null)
{
$picture=mysql_result($result,$i,"picture");
}
if($ocupation==null)
{
$ocupation=mysql_result($result,$i,"ocupation");
}


$query = "UPDATE contacts SET name = '$name', email = '$email', aim = '$aim',msn = '$msn', country = '$country', state = '$state', dob = '$dob', gender = '$gender', bio='$bio', ubtrests='$intrests', picture='$picture', ocupation='ocupation'";


mysql_query($query);
mysql_close();


echo "Update Complete";

} else{

  // display form

if (!isset($_POST['submit']))
 { 

  ?>


<form method="post" action="<?php echo $PHP_SELF?>">

<table>
<tr>
<td colspan="2">
Welcome to the BloGenerator update page
<br>
</td>
</tr>

<tr>
<td colspan="2">
Personal Information (Will be displayed on Blog)
</td>
</tr>

<tr>
<td>
Name:</td><td><input type="Text" name="name" size="50"><br>
</td>
</tr>
<tr>
<td>
Picture URL:</td><td><input type="Text" name="picture" size="50"><br>
</td>
</tr>
<tr>
<td>
Email:</td><td><input type="Text" name="email" size="50"><br>
</td>
</tr>
<tr>
<td>
AIM:</td><td><input type="Text" name="aim" size="50"><br>
</td>
</tr>
<tr>
<td>
MSN:</td><td><input type="Text" name="msn" size="50"><br>
</td>
</tr>
<tr>
<td>
Country:</td><td><input type="Text" name="country" size="50"><br>
</td>
</tr>
<tr>
<td>
State/Province:</td><td><input type="Text" name="state" size="50"><br>
</td>
</tr>
<tr>
<td>
Birthday:</td><td><input type="Text" name="dob" size="50"><br>
</td>
</tr>
<tr>
<td>
Gender:</td><td><input type="Text" name="gender" size="50"><br>
</td>
</tr>
<tr>
<td>
Ocupation:</td><td><input type="Text" name="ocupation" size="50"><br>
</td>
</tr>
<tr>
<td>
Bio:</td><td><textarea rows="10" cols="50" maxlength="300" name="bio"></textarea><br>
</td>
</tr>
<tr>
<td>
Intrests:</td><td><textarea rows="10" cols="50" maxlength="300" name="intrests"></textarea><br>
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
