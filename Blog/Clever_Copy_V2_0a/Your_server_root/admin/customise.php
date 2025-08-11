<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "antihak.php";
?>
<head><title>Customise Clever Copy</title>
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
 if($_POST['submit'])
 {
    $name = $_POST['name'];
    $messagebody = $_POST['messagebody'];
    $subject = $_POST['subject'];
    $version = $version;
    $senderemail = $_POST['senderemail'];
    $senderurl = $getprefs3[siteaddress];
    if ((strlen($_POST['name'])<1))
    {
       echo "<b>$no_name_entered_error</b><br><br>";
       echo '<meta http-equiv="refresh" content="2;URL=customise.php" target="_top">';
       echo "$taking_you_back_label<br>";
       echo "<a href='customise.php' >$click_here_label</a>";
       exit;
    }
    if  ((strlen($_POST['messagebody'])<8))
    {
       echo "<b>$no_report_message_entered_error</b><br><br>";
       echo '<meta http-equiv="refresh" content="2;URL=customise.php" target="_top">';
       echo "$taking_you_back_label<br>";
       echo "<a href='customise.php'>$click_here_label</a>";
       exit;
    }
    echo "</font>";
    $header = "Return-Path: $senderemail\r\n";
    $header .= "From: <$senderemail>\r\n";
    $header .= "Content-Type: text/html; charset=iso-8859-1;\n\n\r\n";
    $ownermes = '<p>A request for customisation work</p>
    <p>Name - '. $name .'  </p>
    <p>E-Mail -  <a href=mailto:' . $senderemail . '>' . $senderemail . '</a></p>
    <p>URL  - <a href=' . $senderurl . '>' . $senderurl . '</a>
    <p>Message ' . $messagebody . '</p>
    <p>Version ' . $version . '</p>
    ';
    if ($subject == "Customisation of Clever Copy")
    {
       $sendermess = "<p>Hi " . $name .", </p>thanks for your request for customisation of Clever Copy.
       <p>If you receive this email then you can be certain that we have received yours. </p>
       <p>Your request will be assessed and we make ask you for some additional detail. We will get back to you as soon as we can but please remember that we are very busy so it make take a few days!</p>
       <p></p>
       <p>Regards</p>
       <p>Magus Perde.</p>
       ";
    }else{
       $sendermess = "<p>Hi " . $name .", </p>thanks for your request to write you a custom script.
       <p>If you receive this email then you can be certain that we have received yours. </p>
       <p>Your request will be assessed and we make ask you for some additional detail. We will get back to you as soon as we can but please remember that we are very busy so it make take a few days!</p>
       <p></p>
       <p>Regards</p>
       <p>Magus Perde.</p>
       ";
    }
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
 if($message != NULL)
 {
    echo "<p align='center'>$message<br>";
    echo '<meta http-equiv="refresh" content="5;URL=index.php">';
    echo "$going_you_back_label<br>";
    echo "$if_you_see_label <a href='index.php' >$click_here_label</a>";
 }else{
    echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='6'><left>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>Request customisation of Clever Copy</font></b></center></td></tr>";
    echo "<tr><td bgcolor=$getprefs3[block_background_color] >";
    echo "We recognise that some people may want to customise their version of Clever Copy but may not have the necessary skills. It is possible to request customisation work for a fee and be guaranteed to get what you want and know that it will work correctly. ";
    echo "The cost may well be less than you think. We are also able to write custom scripts to your specification. To request a quote for customisation work, please fill in the form below.";
    echo "<tr><td width= '100%'>";
    echo "<form name='form1' method='POST' action='customise.php'>";
    echo "<br><font color= '#FF0000'>* </font> $your_name_label<br>";
    echo "<input type='text' name='name' size='60'><br>";
    $senderemail =  $getprefs3['siteemail'];
    $senderemail = regstre($senderemail);
    echo "<br><font color= '#FF0000'>* </font> Your mail address<br>";
    echo "<input type='text' name='senderemail' size='60'value = '$senderemail'><br>";
    echo "<br><font color= '#FF0000'>* </font> What would you like a quote for?<br>";
    echo "<select size='1' name='subject'>";
    echo "<option value='Customisation of Clever Copy'>Quote for customisation of Clever Copy</option>";
    echo "<option value='Write a custom script'>Write me a custom script</option>";
    echo "</select><br>";
    echo "<br><font color= '#FF0000'>* </font>Please quote me for the following customisation work or script.<br>(Please try to give as much detail as possible)<br>";
    echo "<textarea name='messagebody' cols='100' rows='18'></textarea><br><br>";
    echo "Once you have clicked 'Request quote', you will be sent a confirmation email<br><br>";
    echo "<input type='submit' name='submit' value='Request quote' class= 'buttons'>";
    echo "</form>";
    echo "</td></tr></table>";
 }
}else{
  echo $no_login_error;
  include "index.php";
}
?>