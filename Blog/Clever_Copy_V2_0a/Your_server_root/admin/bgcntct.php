<?php
session_start();
include "connect.inc";
include "languages/default.php";
include "../languages/default.php";
include "antihak.php";
$cadmin=$_SESSION['cadmin'];
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
     $getprefs="SELECT * from CC_prefs";
     $getprefs2=mysql_query($getprefs) or die($no_preferences_error);
     $getprefs3=mysql_fetch_array($getprefs2);
     $version =  $getprefs3['version'];
     $senderemail =  $getprefs3['siteemail'];
     $senderemail = regstre($senderemail);
     $senderurl = $getprefs3[siteaddress];
     if($_POST['submit']){
         $name = $_POST['name'];
         $messagebody = $_POST['messagebody'];
         $subject = $_POST['subject'];
         $version = $version;
          if  ((strlen($_POST['name'])<1)){
                echo "<b>$no_name_entered_error</b><br><br>";
                echo '<meta http-equiv="refresh" content="2;URL=bugreporting.php" target="_top">';
                echo "$taking_you_back_label<br>";
                echo "<a href='bugreporting.php' >$click_here_label</a>";
                exit;
          }
          if  ((strlen($_POST['messagebody'])<8)){
                echo "<b>$no_report_message_entered_error</b><br><br>";
                echo '<meta http-equiv="refresh" content="2;URL=bugreporting.php" target="_top">';
                echo "$taking_you_back_label<br>";
                echo "<a href='bugreporting.php'>$click_here_label</a>";
                exit;
          }
          echo "</font>";
          $header = "Return-Path: $senderemail\r\n";
          $header .= "From: <$senderemail>\r\n";
          $header .= "Content-Type: text/html; charset=iso-8859-1;\n\n\r\n";
          $ownermes = '<p>A report has been filed</p>
          <p>Name - '. $name .'  </p>
          <p>E-Mail -  <a href=mailto:' . $senderemail . '>' . $senderemail . '</a></p>
          <p>URL  - <a href=' . $senderurl . '>' . $senderurl . '</a>
          <p>Message ' . $messagebody . '</p>
          <p>Version ' . $version . '</p>
          ';
          $sendermess = '<p>Hi ' . $name .', </p>thanks for your submission to Clever Copy.
          <p>We always appreciate it when people take the time to report bugs or make suggestions etc. </p>
          <p>This allows us to continually improve Clever Copy. If your message needs a reply we will get back to you as soon as we can but please remember that we are very busy so it make take a few days!</p>
          <p></p>
          <p>Regards</p>
          <p>The Clever Copy team.</p>
          ';
          $to = "magusperde.cc@gmail.com";
          mail ($to,"$subject",$ownermes,$header);
          mail ($senderemail,"$subject",$sendermess,$header);
          $newname = explode(' ',$name );
          $message =  "$thank_you_label $newname[0] $for_your_submission_label";
}
?>
<html>
<head>
<title>Report sent</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
   if($message != NULL) {
    echo "<p align='center'>$message<br>";
    echo '<meta http-equiv="refresh" content="2;URL=index.php">';
    echo "$going_you_back_label<br>";
    echo "$if_you_see_label <a href='index.php' >$click_here_label</a>";
    }
}else
 {
  echo $no_login_error;
}
?>