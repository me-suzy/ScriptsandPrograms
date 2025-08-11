<?php 
include "admin/connect.php";
print "<link rel='stylesheet' href='admin/style.css' type='text/css'>";
$resumeid=$_GET['resumeid'];
$getcurrentresume="SELECT * from bl_resume where idresume='$resumeid'"; //fetch current resume
$getcurrentresume2=mysql_query($getcurrentresume) or die("Could not get current resume");
$getcurrentresume3=mysql_fetch_array($getcurrentresume2);
if(strlen($getcurrentresume3['address'])<1)
{
   $getcurrentresume3['address']="Address Not Available";
}
if(strlen($getcurrentresume3['zip'])<1)
{
   $getcurrentresume3['zip']="Location not available";
}
if(strlen($getcurrentresume3['phone'])<1)
{
   $getcurrentresume3['phone']="Phone Not Available";
}
if(strlen($getcurrentresume3['email'])<1)
{
   $getcurrentresume3['email']="Email Not Available";
}
if(strlen($getcurrentresume3['mission'])<1)
{
   $getcurrentresume3['mission']="Objetive Not Available";
}
$getcurrentresume3['address']=stripslashes($getcurrentresume3['address']);
$getcurrentresume3['zip']=stripslashes($getcurrentresume3['zip']);
$getcurrentresume3['phone']=stripslashes($getcurrentresume3['phone']);
$getcurrentresume3['email']=stripslashes($getcurrentresume3['email']);
$getcurrentresume3['mission']=stripslashes($getcurrentresume3['mission']);
$getcurrentresume3[body]=stripslashes($getcurrentresume3['body']);



print "<center>";
print "<table class='maintable'><tr class='headline'><td colspan='4'><center><h3><b>$getcurrentresume3[yourname]</b></td></center></td></tr>";
print "<tr class='mainrow'><td>$getcurrentresume3[address]</td><td>$getcurrentresume3[zip]</td><td>$getcurrentresume3[phone]</td><td>$getcurrentresume3[email]</td></tr>";
print "</table><br><br>";
print "</center>";
print "<center>";
print "<table class='maintable'><tr class='headline'><td colspan='2'><center>Mission Statement</center></td></tr>";
print "<tr class='mainrow'><td width=20%>Objective</td><td>$getcurrentresume3[mission]</td></tr>";
print "</table><br><br>";
print "</center>";
print "<center>";
print "$getcurrentresume3[body]";
print "</center>";
?>
