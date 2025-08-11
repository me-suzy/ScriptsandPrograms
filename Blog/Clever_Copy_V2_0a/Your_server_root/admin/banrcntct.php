<?php
session_start();
include "connect.inc";
include "antihak.php";
include "languages/default.php";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
if($getadmin3['status']==3)
{
    echo "<body bgcolor=$getprefs3[block_background_color]>";
    $siteemail = $getprefs3['siteemail'];
    $siteaddress = $getprefs3['siteaddress'];
    $siteemail = regstre($siteemail);
    $destination_email = $_POST[destination_email];
    $username = $_POST[username];
    $password = $_POST[password];
    if ($password == ''){$password = $empty_password_label;}
    $new_banner_msg_to_owner_label = $_POST[new_banner_msg_to_owner_label];
    $new_banner_msg_to_owner_cont_label = $_POST[new_banner_msg_to_owner_cont_label];
    $new_banner_email_subject = $_POST[new_banner_email_subject];
    $sendurl = $_POST[sendurl];
    if($HTTP_POST_VARS)
        {
        mail("$destination_email","$new_banner_email_subject","Hi $username\n\n$new_banner_msg_to_owner_label\n$new_banner_msg_to_owner_cont_label\n\n$login_to_banner_account_here_label\n$siteaddress/bannerlogin.php\n$password_label $password   $username_label $username","From: $siteemail");
        echo $email_sent_label;
        echo "<meta http-equiv='refresh' content='0;URL=$sendurl'>";
    }
}else{
    echo $not_logged_in_label;
    include "index.php";
}
?>