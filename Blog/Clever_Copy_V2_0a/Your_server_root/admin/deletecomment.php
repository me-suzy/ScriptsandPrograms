<?php
session_start();
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if(($getadmin3['status']==3)||($getadmin3['status']==2))
{
   include "index.php";
   echo "<br><br>";
   $ID=$_GET['ID'];
   $getcomments="SELECT * from CC_comments where commentid='$ID'";
   $getcomments2=mysql_query($getcomments) or die($no_comments_error);
   $getcomments3=mysql_fetch_array($getcomments2);
   if(isset($_POST['submit']))
   {
      $delcomments="DELETE from CC_comments where commentid='$ID'";
      mysql_query($delcomments) or die($no_comments_error);
      $delentry="UPDATE CC_news SET numcomments=numcomments-1 where entryid='$getcomments3[master]'";
      mysql_query($delentry) or die($no_comments_error);
      echo "<b>$comment_deleted_label</b>";
   }else{
      echo "<b>$comment_id_label $ID,&nbsp;&nbsp;  $comment_label $getcomments3[comment]<br><br></b> ";
      echo $are_you_sure_del_com_label;
      echo "<form action='deletecomment.php?ID=$ID' method='post'>";
      echo "<input type='submit' name='submit' value='$delete_this_admin_button_label' class = 'buttons'></form>";
   }
}else{
    echo $no_login_label;
    include "index.php";
}
?>