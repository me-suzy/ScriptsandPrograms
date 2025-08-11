<?php
session_start();
include "connect.inc";
include "languages/default.php";
?>
<html><head>
<title><?php echo $slogan_edit_title; ?></title>
<link rel="stylesheet" href="style.css" type="text/css">
<?php
echo "<body bgcolor=$getprefs3[block_background_color]>";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
include "index.php";
if(isset($_POST['submit']))
{
   $slogan=$_POST['slogan'];
   $slogan_font_face=$_POST['slogan_font_face'];
   $use_image_or_slogan=$_POST['use_image_or_slogan'];
   $slogan_font_size=$_POST['slogan_font_size'];
   $slogan_font_color =$_POST['slogan_font_color'];
   $site_slogan_alignment=$_POST['site_slogan_alignment'];
   $slogan_vertical_align=$_POST['slogan_vertical_align'];
   $site_image_alignment=$_POST['site_image_alignment'];
   $editslogan="UPDATE CC_slogan SET slogan='$slogan',site_image_alignment='$site_image_alignment',slogan_vertical_align='$slogan_vertical_align',site_slogan_alignment='$site_slogan_alignment',use_image_or_slogan='$use_image_or_slogan',slogan_font_face='$slogan_font_face',slogan_font_color ='$slogan_font_color ',slogan_font_size='$slogan_font_size'";
   mysql_query($editslogan) or die($unable_to_save_preferences_error);
   echo $preferences_saved_label;
   echo "<meta http-equiv='refresh' content='0;URL=editsiteslogan.php'>";
}else{
   $getslogan="SELECT * from CC_slogan";
   $getslogan2=mysql_query($getslogan) or die($no_slogan_error);
   $getslogan3=mysql_fetch_array($getslogan2);
   echo "<br><br>";
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_slogan_label</font></b></center></td></tr>";
   echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
   echo "<tr><td colspan = '2'><br><img src = '/images/information.gif'> $slogan_info_message_label<br><br>";
   echo "<tr><td width= '20%'>";
   echo "<b>$item_label</b>";
   echo "<td width= '80%'>";
   echo "<b>$current_settings_label</b>";
   echo "<tr><td width= '20%'>";
   echo "<form action='editsiteslogan.php' method='post'>";
   echo $current_slogan_label;
   echo "<td width= '80%'>";
   echo "<textarea rows='2' name='slogan' cols = '55'>$getslogan3[slogan]</textarea>";
   echo "<tr><td width= '20%'>";
   echo $slogan_use_which_label;
   echo "<td width= '80%'>";
   echo "<select name='use_image_or_slogan'>";
   if($getslogan3[use_image_or_slogan]=="both")
   {
       echo "<option value='both'>$both_label</option>";
       echo "<option value='image'>$image_label</option>";
       echo "<option value='slogan'>$slogan_label</option>";
   }
   elseif ($getslogan3[use_image_or_slogan]=="image")
   {
         echo "<option value='image'>$image_label</option>";
         echo "<option value='slogan'>$slogan_label</option>";
         echo "<option value='both'>$both_label</option>";
   }
   else
   {
       echo "<option value='slogan'>$slogan_label</option>";
       echo "<option value='image'>$image_label</option>";
       echo "<option value='both'>$both_label</option>";
   }
   echo "<tr><td width= '20%'>";
   echo $slogan_font_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='slogan_font_face' size='10' value='$getslogan3[slogan_font_face]'>";
   echo "<tr><td width= '20%'>";
   echo "$slogan_font_size_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='slogan_font_size' size='10' value='$getslogan3[slogan_font_size]'>";
   echo "<tr><td width= '20%'>";
   echo "$slogan_font_color_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='slogan_font_color' size='10' value='$getslogan3[slogan_font_color]'>";
   echo "<tr><td width= '20%'>";
   echo $site_slogan_valignment_label;
   echo "<td width= '80%'>";
   echo "<select name='slogan_vertical_align'>";
   if($getslogan3[slogan_vertical_align]=="top")
   {
       echo "<option value='top'>$top_label</option>";
       echo "<option value='middle'>$middle_label</option>";
       echo "<option value='bottom'>$bottom_label</option>";
   }
   elseif ($getslogan3[slogan_vertical_align]=="middle")
   {
         echo "<option value='middle'>$middle_label</option>";
         echo "<option value='top'>$top_label</option>";
         echo "<option value='bottom'>$bottom_label</option>";
   }
   else
   {
       echo "<option value='bottom'>$bottom_label</option>";
       echo "<option value='middle'>$middle_label</option>";
       echo "<option value='top'>$top_label</option>";
   }
   echo "<tr><td width= '20%'>";
   echo $site_slogan_alignment_label;
   echo "<td width= '80%'>";
   echo "<select name='site_slogan_alignment'>";
   if($getslogan3[site_slogan_alignment]=="left")
   {
       echo "<option value='left'>$left_label</option>";
       echo "<option value='center'>$center_label&nbsp;</option>";
       echo "<option value='right'>$right_label</option>";
   }
   elseif ($getslogan3[site_slogan_alignment]=="center")
   {
         echo "<option value='center'>$center_label&nbsp;</option>";
         echo "<option value='left'>$left_label</option>";
         echo "<option value='right'>$right_label</option>";
   }
   else
   {
       echo "<option value='right'>$right_label</option>";
       echo "<option value='center'>$center_label&nbsp;</option>";
       echo "<option value='left'>$left_label</option>";
   }
   echo "<tr><td width= '20%'>";
   echo $site_image_alignment_label;
   echo "<td width= '80%'>";
   echo "<select name='site_image_alignment'>";
   if($getslogan3[site_image_alignment]=="left")
   {
       echo "<option value='left'>$left_label</option>";
       echo "<option value='center'>$center_label&nbsp;</option>";
       echo "<option value='right'>$right_label</option>";
   }
   elseif ($getslogan3[site_image_alignment]=="center")
   {
         echo "<option value='center'>$center_label</option>";
         echo "<option value='left'>$left_label</option>";
         echo "<option value='right'>$right_label</option>";
   }
   else
   {
       echo "<option value='right'>$right_label</option>";
       echo "<option value='center'>$center_label</option>";
       echo "<option value='left'>$left_label</option>";
   }
   echo "<tr><td width= '20%'>";
   echo "<td width= '80%'>";
   echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
}
}else
 {
  echo $no_login_error;
  include "index.php";
}
?>