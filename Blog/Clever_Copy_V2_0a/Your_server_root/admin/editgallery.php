<?php
session_start();
include "connect.inc";
include "languages/default.php";
?>
<head>
<title><?php echo $gallery_edit_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head> ";
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
   $galtitle=$_POST['galtitle'];
   $picspacing=$_POST['picspacing'];
   $galcols=$_POST['galcols'];
   $galrows=$_POST['galrows'];
   $galtopmessage=$_POST['galtopmessage'];
   $imagemethod=$_POST['imagemethod'];
   $convert=$_POST['convert'];
   $identify=$_POST['identify'];
   $imagequality =$_POST['imagequality'];
   $galranpicpath =$_POST['galranpicpath'];
   $editblocknames="update CC_gallery set galranpicpath='$galranpicpath',picspacing='$picspacing',galcols='$galcols',galrows='$galrows',galtopmessage='$galtopmessage',imagemethod='$imagemethod',convert='$convert',identify='$identify',galtitle='$galtitle',imagequality='$imagequality'";
   mysql_query($editblocknames) or die($unable_to_save_preferences_error);
   echo $preferences_saved_label;
   echo "<meta http-equiv='refresh' content='0;URL=editgallery.php'>";
}else{
   $getgal="SELECT * from CC_gallery";
   $getgal2=mysql_query($getgal) or die($no_gallery_error);
   $getgal3=mysql_fetch_array($getgal2);
   echo "<br><br>";
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_gallery_label</font></b></center></td></tr>";
   echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
   echo "<tr><td width= '20%'>";
   echo "<b>$item_label</b>";
   echo "<td width= '80%'>";
   echo "<b>$current_settings_label</b>";
   echo "<tr><td width= '20%'>";
   echo "<form action='editgallery.php' method='post'>";
   echo $gal_title_label;
   echo "<td width= '80%'>";
   echo "<input type ='text'  name='galtitle' size='40' value='$getgal3[galtitle]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_pic_spacing_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='picspacing' size='5' value='$getgal3[picspacing]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_col_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='galcols' size='5' value='$getgal3[galcols]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_row_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='galrows' size='5' value='$getgal3[galrows]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_top_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='galtopmessage' size='40' value='$getgal3[galtopmessage]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_image_method_label;
   echo "<td width= '80%'>";
   echo "<select name='imagemethod'>";
   if($getgal3[imagemethod]==gd1)
   {
      echo "<option value='gd1'>GD1</option>";
      echo "<option value='gd2'>GD2</option>";
      echo "<option value='imagemagick'>ImageMagick</option> ";
   }elseif ($getgal3[imagemethod]==gd2)
   {
      echo "<option value='gd2'>GD2</option>";
      echo "<option value='gd1'>GD1</option>";
      echo "<option value='imagemagick'>ImageMagick</option> ";
   }else {
      echo "<option value='imagemagick'>ImageMagick</option>";
      echo "<option value='gd1'>GD1</option>";
      echo "<option value='gd2'>GD2</option> ";
   }
   echo "<tr><td width= '20%'>";
   echo $path_to_galran_pics_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='galranpicpath' size='80' value='$getgal3[galranpicpath]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_use_IM_conv_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='convert' size='40' value='$getgal3[convert]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_use_IM_id_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='identify' size='40' value='$getgal3[identify]'>";
   echo "<tr><td width= '20%'>";
   echo $gal_image_qual_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='imagequality' size='5' value='$getgal3[imagequality]'> <img src='../images/information.gif'> $gal_image_quality_warning_label";
   echo "<tr><td width= '20%'>";
   echo "<td width= '80%'>";
   echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
}
}else{
  echo $no_login_error;
  include"index.php";
}
?>