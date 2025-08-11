<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?php
include "languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   echo "<tr><td>";
   $editthisblock=$_POST[theid];
   $getblock="SELECT * from CC_custom_blocks WHERE customid = '$editthisblock'";
   $getblock2=mysql_query($getblock) or die($no_customblock_error);
   $getblock3=mysql_fetch_array($getblock2);
   echo "<center><form action='editcustomblock.php?op=edit_block2nd' method='post'>";
   echo "<center>$add_custom_block_content_label<br>";
   echo "<center><textarea name='customcontent' rows='8' cols='80'>$getblock3[customblock]</textarea></center><br>";
   echo "<input type = 'hidden' name = 'ID' value = '$getblock3[customid]'>";
   echo "<input type='submit' name='submit' value='$confirm_admin_edit_button_label' class = 'buttons'></form>";
   echo "</td></tr></table>";

   switch( $_GET[ "op" ] )
   {
   case "edit_block2nd":
   $blockcontent = $_POST[customcontent];
   $ID = $_POST[ID];
   $ublock="UPDATE `CC_custom_blocks` SET `customblock` = '$blockcontent' WHERE`customid`  = '$ID'";
   mysql_query($ublock) or die($no_customblock_error);
   $error_msg .= mysql_error();
   echo "<b>$block_successfully_edited_label</b><br>";
   echo "<meta http-equiv='refresh' content='0;URL=blocks.php'>";
   break;
   }
}else{
  echo $no_login_error;
  include "index.php";
}
?>