<?php
session_start();
include "connect.inc";
include "languages/default.php";
include "antihak.php";
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
    $siteemail = regstre($getprefs3['siteemail']);
    $destination_email = $_POST[destination_email];
    $username = $_POST[username];
    $password = $_POST[password];
    $welcome_email_label = $_POST[welcome_email_label];
    $welcome_email_label_cont = $_POST[welcome_email_label_cont];
    $sendurl = $_POST[sendurl];
    $new_member_subject = $_POST[new_member_email_subject];
    if($HTTP_POST_VARS)
        {
        mail("$destination_email","$new_member_subject","$username$welcome_email_label\n$password_label $password $username_label $username\n$welcome_email_label_cont","FROM: $siteemail");
        echo $email_sent_label;
        echo "<meta http-equiv='refresh' content='0;URL=$sendurl'>";
    }
}else
{
    echo $no_login_error;
    include "index.php";
}
?>