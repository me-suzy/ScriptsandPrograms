<?php
session_start();
include "languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<link rel='stylesheet' href='$style' type='text/css'>";
if(($getadmin3['status']==3)||($getadmin3['status']==2))
{
$res = @mysql_query( "SELECT username FROM CC_tag_shout WHERE ID = " . $_POST[ "ID" ] );
$error_msg = "";
if( !isset( $_POST["ID"] ) )
$error_msg .= "<p>POST data error - please re-send form!</p>";
else
    {
    $res = @mysql_query( "SELECT * FROM CC_tag_shout WHERE ID = " . $_POST[ "ID" ] );
    $error_msg .= mysql_error();
     if( $error_msg == "" )
         {
         $row = mysql_fetch_array( $res );
         if( $error_msg == "" )
              {
              @mysql_query( "DELETE FROM CC_tag_shout WHERE ID = " . $_POST["ID"] );
              $error_msg .= mysql_error();
         }
    }
}
if( $error_msg == "" ){
    $error_msg .= "<br>$shout_successfully_deleted";
    echo $error_msg;
    echo "<meta http-equiv='refresh' content='0;URL=../tag/shoutout.php'>";
}
else {
      echo "<br>$problem_deleting_shout_error<br>";
      echo "$error_message_was_label<font color = 'red'> $error_msg </font>";
}
}else{
    echo $not_logged_in_label;
    include "index.php";
}
?>