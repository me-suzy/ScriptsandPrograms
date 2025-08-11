<?php
session_start();
include "connect.inc";
include "languages/default.php";
include "../languages/default.php";
$style = $getprefs3[personality];
?>
<html><head>
<title><?php echo $bugreport_title; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css"></head>
<?php
echo "<body bgcolor=$getprefs3[block_background_color]>";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
    include "index.php";
    echo "<br><br>";
    echo "<table border='1' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td><left>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$submit_report_bug_label</font></b></center></td></tr>";
    echo "<tr><td ><br><img src = '/images/information.gif'> $bug_report_info_message_label<br><br><font color= '#FF0000'>* </font>$required_label";
    echo "<tr><td width= '100%'>";
    echo "<form name='form1' method='POST' action='bgcntct.php'>";
    echo "<br><font color= '#FF0000'>* </font> $your_name_label<br>";
    echo "<input type='text' name='name' size='40'><br>";
    echo "<br>$report_label<br>";
    echo "<select size='1' name='subject'>";
    echo "<option value='Clever Copy Bug Report'>$submit_bug_label</option>";
    echo "<option value='Clever Copy Suggestion'>$submit_suggestion_label</option>";
    echo "<option value='Clever Copy Comments'>$submit_comments_label</option>";
    echo "</select><br>";
    echo "<br><font color= '#FF0000'>* </font> $your_report_label<br>";
    echo "<textarea name='messagebody' cols='80' rows='15'></textarea><br><br>";
    echo "<input type='submit' name='submit' value='$submit_report_button_label' class= 'buttons'>";
    echo "</form>";
    echo "</td></tr></table>";
}else{
  echo $no_login_error;
  include "index.php";
}
?>