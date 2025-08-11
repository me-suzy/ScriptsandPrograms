<?php
session_start();
include "connect.inc";
include"languages/default.php";
?>
<head><title><?php echo $welcome_edit_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head> ";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   if(isset($_POST['submit']))
      {
      $welcome_message=$_POST['welcome_message'];
      $welcome_font_face=$_POST['welcome_font_face'];
      $welcome_font_size=$_POST['welcome_font_size'];
      $welcome_font_color=$_POST['welcome_font_color'];
      $editmsg="UPDATE CC_welcome SET welcome_font_color='$welcome_font_color',welcome_font_size='$welcome_font_size',welcome_font_face='$welcome_font_face',welcome_message='$welcome_message'";
      mysql_query($editmsg) or die($unable_to_save_preferences_error);
      echo $preferences_saved_label;
      echo "<meta http-equiv='refresh' content='0;URL=editwelcome.php'>";
   }
   else
       {
       $getprof="SELECT * from CC_welcome";
       $getprof2=mysql_query($getprof) or die($no_welcome_error);
       $getprof3=mysql_fetch_array($getprof2);
       echo "<br><br>";
       $textsize= $getprefs3[text_font_size];
       $textsize = ($textsize+9);
       echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
       echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
       echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_welcome_msg_label</font></b></center></td></tr>";
       echo "<td  bgcolor=$getprefs3[block_background_color] colspan = '4'>";
       echo "<tr><td width= '10%'>";
       echo "<b>$item_label</b>";
       echo "<td width= '90%'>";
       echo "<b>$current_settings_label</b>";
       echo "<tr><td width= '10%'>";
       echo "<form action='editwelcome.php' method='post'>";
       echo $font_face_label;
       echo "<td width= '90%'>";
       echo "<input type='text' name='welcome_font_face' size='10' value='$getprof3[welcome_font_face]'>";
       echo "<tr><td width= '10%'>";
       echo $font_size_label;
       echo "<td width= '90%'>";
       echo "<input type='text' name='welcome_font_size' size='10' value='$getprof3[welcome_font_size]'>";
       echo "<tr><td width= '10%'>";
       echo $font_color_label;
       echo "<td width= '90%'>";
       echo "<input type='text' name='welcome_font_color' size='10' value='$getprof3[welcome_font_color]'>";
       echo "<tr><td width= '10%'>";
       echo $welcome_cur_msg_label;
       echo "<td width= '90%'>";
       echo "<textarea rows='7' name='welcome_message' cols='80'>$getprof3[welcome_message]</textarea>";
       echo "<tr><td width= '10%'>";
       echo $message_looks_like_label;
       echo "<td width= '90%'>";
       include "../welcome.php";
       echo "<tr><td width= '10%'>";
       echo "<td width= '90%'>";
       echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
   }
}else{
  echo $no_login_error;
  include "index.php";
}
?>