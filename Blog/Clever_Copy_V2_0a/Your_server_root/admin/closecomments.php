<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if(($getadmin3['status']==3)||($getadmin3['status']==2))
{
   include "index.php";
   $ID=$_GET['ID'];
   $updatecomments= "UPDATE CC_news set allowcomments ='0' WHERE entryid = '$ID'";
   mysql_query($updatecomments)or die($no_news_error);
   echo "<br>$comments_now_closed_label<br>";
   echo "</td></tr></table>";
}else{
  echo $no_login_error;
  include "index.php";
  echo "</td></tr></table>";
}
?>