<?php
session_start();
include "admin/languages/default.php";
include "admin/connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if ($getadmin3['status']==3)
{
   if ($num_results >=1)
   {
      echo "<br><br>&nbsp;$user_news_approve_label<br>";
      echo "<br>$num_results";
      echo "<br><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a href='admin/usersubmittednews.php'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$approve_news_label</a></font>";
   }
   if ($wlctr >=1)
   {
      echo "<br><br>&nbsp;$weblinks_approve_label<br>";
      echo "<br>$wlctr";
      echo "<br><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a href='admin/usersubmittednews.php'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$approve_weblinks_label</a></font>";
   }
   if ($ppcctr >=1)
   {
      $ppcctr = '0';
      while($row = mysql_fetch_array($thisresult))
      {
         if ($row[validated] == '1')
         {
            $ppcctr++;
         }
      }
      if ($ppcctr >=1)
      {
            echo "<br><br>&nbsp;$user_ppc_approve_label<br>";
            echo "<br>$ppcctr";
            echo "<br><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a href='admin/editppc.php'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$approve_ppc_label</a></font>";
      }
   }
}
else
{
    echo $no_admin_error;
}
?>