<?php
session_start();
include "connect.inc";
include "languages/default.php";
include "../languages/default.php";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
  include "index.php";
  echo "<center><table>";
  echo "<tr><td><center><br><b>$delete_multiple_news_label</center></b><br></td></tr>";
  echo "<tr><td>";
  if(isset($_POST['submit']))
  {
     $month=$_POST['month'];
     $year=$_POST['year'];
     $getentries="SELECT * from CC_news where month<'$month' and year<='$year'";
     $getentries2=mysql_query($getentries) or die(mysql_error());
     while($getentries3=mysql_fetch_array($getentries2))
     {
       $delcomments="DELETE from CC_comments where master='$getentries3[entryid]'";
       mysql_query($delcomments) or die($del_comments_error_label);
     }
     $getent="SELECT * from CC_news where year<'$year'";
     $getent2=mysql_query($getent) or die(mysql_error());
     while($getent3=mysql_fetch_array($getent2))
     {
       $delcomments="DELETE from CC_comments where master='$getentries3[entryid]'";
       mysql_query($delcomments) or die($del_comments_error_label);
     }
     $deletecomment="DELETE from CC_news where month<'$month'and year='$year'";
     mysql_query($deletecomment) or die(mysql_error());
     $deletecomm="DELETE from CC_news where year<'$year'";
     mysql_query($deletecomm) or die(mysql_error());
     echo "<b>$old_news_entries_deleted_sucessfully_label</b>";
     echo "<meta http-equiv='refresh' content='0;URL=pruneentries.php'>";
  }else{
     echo "<form action='pruneentries.php' method='post'>";
     echo "$del_all_news_b4_month_label - ";
     echo "<select name='month'>";
     echo "<option value='1'>$jan_label</option>";
     echo "<option value='2'>$feb_label</option>";
     echo "<option value='3'>$mar_label</option>";
     echo "<option value='4'>$apr_label</option>";
     echo "<option value='5'>$may_label</option>";
     echo "<option value='6'>$jun_label</option>";
     echo "<option value='7'>$jul_label</option>";
     echo "<option value='8'>$aug_label</option>";
     echo "<option value='9'>$sep_label</option>";
     echo "<option value='10'>$oct_label</option>";
     echo "<option value='11'>$nov_label</option>";
     echo "<option value='12'>$dec_label</option></select>";
     echo " $del_all_news_b4_year_label - ";
     echo "<select name='year'>";
     echo "<option value='2005'>2005</option>";
     echo "<option value='2006'>2006</option>";
     echo "<option value='2007'>2007</option>";
     echo "<option value='2008'>2008</option>";
     echo "<option value='2009'>2009</option>";
     echo "<option value='2010'>2010</option>";
     echo "<option value='2011'>2011</option>";
     echo "<option value='2012'>2012</option>";
     echo "<option value='2013'>2013</option>";
     echo "<option value='2014'>2014</option>";
     echo "<option value='2015'>2015</option>";
     echo "<option value='2016'>2016</option></select>";
     echo "&nbsp; - <input type='submit' name='submit' value='$delete_label' class = 'buttons'></form>";
  }
  echo "</td></tr></table>";
}else{
  echo $no_login_error;
  include "index.php";
}
?>