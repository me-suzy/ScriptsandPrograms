<?php
session_start();
include("languages/default.php");
?>
<head><title><?php echo $block_preferences_title; ?></title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<?php
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
 include "index.php";
   if(isset($_POST['submit']))
   {
          $blockposition=$_POST['blockposition'];
          $id=$_POST['id'];
          $side=$_POST['side'];
          $view=$_POST['view'];
          $editblocks="UPDATE CC_blocks SET view = '$view', side = '$side', blockposition='$blockposition' WHERE id ='$id'";
          mysql_query($editblocks) or die($unable_to_save_preferences_error);
          echo $block_preferences_saved_label;
          echo "<br><b>$page_auto_refresh</b>";
          echo "<meta http-equiv='refresh' content='0;URL=block_weighting.php'>";
   }else{
       $query =  ("SELECT * FROM CC_blocks ORDER BY  side ASC, blockposition ASC") or die($no_blocks_found_error);
       $result = mysql_query($query);
       echo "<br><br>";
       echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
       echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='6'><left>";
       echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$block_weighting_label</font></b></center></td></tr>";
       echo "<tr><td colspan='6' bgcolor=$getprefs3[block_background_color] >";
       echo "<img src= '../images/information.gif'> $block_weighting_info_label<br><br>";
       echo "<tr><td width='10%' >";
       echo "<b>$block_name_show_label</b> ";
       echo "<td width='8%'>";
       echo "<b>$block_pos_show_label</b>";
       echo "<td width='8%' >";
       echo "<b>$block_side_show_label</b>";
       echo "<td width='12%' >";
       echo "<b>$block_view_show_label</b>";
       echo "<td width='60%' >";
       while($row = mysql_fetch_array( $result ))
       {
        echo "<form action='block_weighting.php' method='post'>";
        echo "<tr><td width='10%'  valign = 'top'>";
        echo "$row[label]";
        echo "<td width='8%'  valign = 'top'>";
        if ($row[side]=="2")
        {
             echo "n/a";
             echo "<input type ='hidden'  name='blockposition' size='1' value='2'>";
        }else{
             echo "<input type ='text'  name='blockposition' size='1' value='$row[blockposition]'>";
        }
        echo "<input type ='hidden'  name='id' size='1' value='$row[id]'>";
        echo "<td width='8%'  valign = 'top'>";
        echo "<select name='side'>";
        if($row[side]=="0")
        {
           echo "<option value='0' style='color: #000000'>$left_label</option>";
           echo "<option value='1' style='color: #FFFFFF'>$right_label</option></select>";
        }
        elseif($row[side]=="1")
        {
                echo "<option value='1' style='color: #FFFFFF'>$right_label</option>";
                echo "<option value='0' style='color: #000000'>$left_label</option></select>";
        }
        elseif($row[side]=="2")
        {
                echo "<option value='2'>$center_label</option></select>";
        }
        echo "<td width='12%' bgcolor=$getprefs3[block_background_color] valign = 'top'>";
        echo "<select name='view'>";

        if($row[view]=="0")
           {
           echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option>";
           echo "<option value='1'>$view_by_members_label</option>";
           echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
           echo "<option value='5' style='color: #000000'>$view_by_noone_label</option></select>";
        }
        elseif($row[view]=="1")
        {
                echo "<option value='1'>$view_by_members_label</option>";
                echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option>";
                echo "<option value='5' style='color: #000000'>$view_by_noone_label</option>";
                echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option></select>";
        }
        elseif($row[view]=="2")
        {
                echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
                echo "<option value='1'>$view_by_members_label</option>";
                echo "<option value='5' style='color: #000000'>$view_by_noone_label</option>";
                echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option></select>";
        }
        elseif($row[view]=="5")
        {
                echo "<option value='5' style='color: #000000'>$view_by_noone_label</option>";
                echo "<option value='1'>$view_by_members_label</option>";
                echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
                echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option></select>";
        }
        echo "<td  width ='60%' valign = 'top'><input type='submit' name='submit'  value='$save_button_label' class = 'buttons'></form>";
   }
}
echo"</tr></td></table>";
}else
{
  echo $no_login_error;
  include "index.php";
}
?>