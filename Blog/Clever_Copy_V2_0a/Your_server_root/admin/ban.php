<?php
session_start();
include "languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
$style = $getprefs3[personality];
echo "<head><title>$ban_users_label</title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
echo "</head>";
if($getadmin3['status']==3)
    {
    include "index.php";
    if(isset($_POST['submit']))
    {
      if(strlen($_POST['ip'])<1)
      {
         echo $no_ip_address_error;
      }
      else
          {
          $ip=$_POST['ip'];
          $insertip="INSERT into CC_ipbans (banip) values ('$ip')";
          mysql_query($insertip) or die($no_bannedip_error);
          echo $ip_is_banned_label;
          echo "<meta http-equiv='refresh' content='0;URL=ban.php'>";
    }
   }else{
   echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td  valign = 'top' colspan='3'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_banip_label</b></center></td></tr>";
   echo "<tr><td  colspan = '3' valign = 'top'><br><img src = '/images/information.gif'> $banning_ip_message_label<br><br>";
   $ip=$_POST['ip_address'];
   echo "<form action='ban.php' method='post'>";
   echo "$ip_to_be_banned_label<br>";
   echo "<input type='text' name='ip' size='20' value =$ip><br>";
   echo "<input type='submit' name='submit' value='$ban_ip_button_label' class = 'buttons'></form>";
   echo "<tr><td   colspan = '3' valign = 'top'><br>$currently_banned_ips_label<br><br>";
   echo "<tr><td width= '10%' valign = 'top'>";
   echo "<b>$item_label</b>";
   echo "<td width= '13%' valign = 'top'>";
   echo "<b>$current_settings_label</b>";
   echo "<td width='77%' >";
   $query="SELECT * from CC_ipbans";
   $result = mysql_query($query);
   while( $row = mysql_fetch_array( $result ) )
       {
       echo "<tr><td width= '10%'valign = 'top'>";
       echo $current_ip_address_label;
       echo "<td width='13%' valign = 'top'>";
       echo $row[banip];
       echo "<td width='77%' valign = 'top'><form action='ban.php?op=unban&ID=$row[banipid]' method='post'><input type='submit' name='go' value='$unban_ip_button_label' class = 'buttons'></form>";
   }
   echo "</td></tr></table>";
   }
switch( $_GET[ 'op' ] )
{
case "unban":
     $ID=$_GET['ID'];
     $delban="DELETE from CC_ipbans where banipid='$ID'";
     mysql_query($delban) or die($no_bannedip_error);
     echo $ip_unbanned_label;
     echo "<meta http-equiv='refresh' content='0;URL=ban.php'>";
break;
}
}else
{
  echo $no_login_error;
  echo "</td></tr></table>";
}
?>