<?php
include "admin/connect.php";
$ID=$_GET['ID'];
$getcontents="SELECT * from bl_userphotos where userphotoid='$ID'";
$getcontents2= mysql_query($getcontents) or die("Could not get contents");
$getcontents3=mysql_fetch_array($getcontents2);  
print "<center><img src='$getcontents3[path]' border'0'></center>";
?>