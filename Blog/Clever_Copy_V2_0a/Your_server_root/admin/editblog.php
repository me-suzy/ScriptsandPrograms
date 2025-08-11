<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   $ID=$_GET['ID'];
   $title=antihaxmjr($_POST['title']);
   $short=antihaxmjr($_POST['short']);
   $long=antihaxmjr($_POST['long']);
   $allow=$_POST['allow'];
   if(isset($_POST['submit']))
   {
      if(strlen($_POST['title'])<1)
     {
       echo $no_title_given_error_label;
     }
     else if(strlen($_POST['short'])<1)
     {
       echo $no_news_given_error_label;
     }else{
         $editblog="update CC_news set newstitle='$title',introcontent='$short',maincontent='$long',allowcomments='$allow' where entryid='$ID'";
         mysql_query($editblog) or die($no_news_error);
         echo "<b>$news_item_edited_label</b>";
         echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
      }
   }else{
      $getblog="SELECT * from CC_news where entryid='$ID'";
      $getblog2=mysql_query($getblog) or die($no_news_error);
      $getblog3=mysql_fetch_array($getblog2);
      echo "<center><font color = 'red'>*</font> $required_field_label<br><br>";
      echo "<form action='editblog.php?ID=$ID' method='post' name='form'>";
      echo "<font color = 'red'>*</font> $the_main_temp_title_label<br>";
      echo "<input type='text' name='title' size='80' value='$getblog3[newstitle]'><br><br>";
      echo "<font color = 'red'>*</font> $short_text_description_label<br>";
      echo "<textarea name='short' rows='6' cols='80'>$getblog3[introcontent]</textarea><br><br>";
      echo "$long_text_description_label<br>";
      echo "<textarea name='long' rows='8' cols='80'>$getblog3[maincontent]</textarea><br><br>";
      echo "$allow_comments_for_this_item_label<br>";
      echo "<select name='allow'>";
      echo "<option value='1'>$yes_label</option>";
      echo "<option value='0'>$no_label</option></select><br><br><br>";
      echo "<input type='submit' name='submit' value='$edit_this_news_item_button_label' class = 'buttons'></form>";
   }
   echo "</td></tr></table>";
}else{
    echo $not_logged_in_label;
    include "index.php";


}
?>