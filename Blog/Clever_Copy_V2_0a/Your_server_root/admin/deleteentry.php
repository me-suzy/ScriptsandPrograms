<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "connect.inc";
?>
<head>
<title><?php echo $delete_entry_label; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head> ";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='3'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$delete_news_posting_label</font></b></center></td></tr>";
   echo "<tr><td>";
   echo "<br>$delete_item_label<br><br>";
   $ID=$_GET['ID'];
   if(isset($_POST['submit']))
   {
      $delcomments="DELETE from CC_comments where master='$ID'";
      mysql_query($delcomments) or die($no_comments_error);
      $delentry="DELETE from CC_news where entryid='$ID'";
      mysql_query($delentry) or die($problem_deleting_vpost_error);
      echo $post_deleted_success_label;
   }else{
      $getnewsentry="SELECT * from CC_news where entryid = '$ID'";
      $entry=mysql_query($getnewsentry) or die($no_news_found_error);
      $newsentry=mysql_fetch_array($entry);
      echo "<b>$delete_title_label - <br></b>";
      echo $newsentry[newstitle];
      echo "<br><br><b>$delete_id_label</b><br>";
      echo "$ID<br>";
      echo "<b><br>$short_text_label -  <br></b>$newsentry[introcontent]";
      echo "<b><br><br>$confirm_news_delete</b><br><br>";
      echo "<form action='deleteentry.php?ID=$ID' method='post'><br>";
      echo "<input type='submit' name='submit' value='$delete_this_admin_button_label' class = 'buttons'></form>";
   }
   echo "</td></tr></table>";
}
else
{
  echo $no_login_error;
  include "index.php";
}
?>