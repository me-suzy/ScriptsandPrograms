<?php
session_start();
include "connect.inc";
include "languages/default.php";
echo "<link rel='stylesheet' href='../admin/style.css' type='text/css'>";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
  include "index.php";
  echo "<center><table>";
  echo "<tr><td height='7'></td></tr>";
  echo "<tr><td>";
  if(isset($_POST['submit']))
  {
     $ID=$_POST['ID'];
     $delgbentry="DELETE from CC_guestb where ID='$ID'";
     mysql_query($delgbentry) or die($no_gbook_error);
     $optquery =  ("OPTIMIZE TABLE `CC_guestb`");
     $optresult = mysql_query($optquery);
     echo "<b>$gbook_entry_deleted_label</b>";
     echo "<META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>";
  }
  else if(isset($_GET['ID']))
  {
     $ID=$_GET['ID'];
     $guestbook="SELECT * FROM CC_guestb WHERE ID ='$ID'";
     $row=mysql_query($guestbook);
     echo "<b>$delete_gbook_entry_label<br><br></b>";
     while($guestbentry=mysql_fetch_array($row))
     {
        $guestbentry[comment]=htmlspecialchars($guestbentry[comment]);
        $guestbentry[name]=htmlspecialchars($guestbentry[name]);
        echo "<tr><td width = '20%'valign = 'top'><b>$guestbentry[name]</b><br>";
        echo "$guestbentry[time]<br>";
        if(strlen($guestbentry[www])>1)
        {
            $www=$guestbentry[www];
            $www="http://$www";
            echo "<a href=$www target='new'><img src='../images/posterwww.gif'alt='$poster_www_alt_text' border='0'></a> ";
        }
        if(strlen($guestbentry[mail])>1)
        {
            $mail=registre($guestbentry[mail]);
            echo "<a href= 'mailto: $mail'><img border='0' src='../images/postermail.gif'alt='$poster_mail_alt_text'></a> ";
        }
        echo "<td >&nbsp;&nbsp;";
        echo "<td width = '80%' valign = 'top'>$guestbentry[comment]";
        echo "<tr><td colspan = '3' valign = 'top'><hr>";
     }
     echo "<form action='gbookdelete.php' method='post'>";
     echo "<input type='hidden' name='ID' value='$ID'>";
     echo "<input type='submit' name='submit' value='$delete_this_admin_button_label' class = 'buttons'></form>";
     }
        echo "</td></tr></table></center>";
}else{
  echo $no_login_error;
  include "index.php";
}
?>