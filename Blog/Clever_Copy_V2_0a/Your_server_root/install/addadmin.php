<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
include "../admin/connect.inc";
include "antihack.php";
include "languages/default.php";
$error_msg = "";
$username=$_POST["username"];
$themailaddress = $_POST["admin_email_address"];
$themailaddress = sesson($themailaddress);
$status= '3';
$password=$_POST["password"];
$password2=$_POST["password2"];
$siteaddy = $_POST["siteaddy"];
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status6.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
if ($password !== $password2)
{
   echo "<font color = '#000000'>$pass_no_match<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $check_your_passwords;
   echo "<tr><td valign = 'bottom'><br><form action='setadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   exit;
}
if ($password == "")
{
   echo "<font color = '#000000'>$post_data_missing<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $missing_pass_data;
   echo "<tr><td valign = 'bottom'><br><form action='setadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   exit;
}
if ($username == "")
{
   echo "<font color = '#000000'>$post_data_missing<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $missing_user_data;
   echo "<tr><td valign = 'bottom'><br><form action='setadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   exit;
}
if ($_POST["admin_email_address"] == "")
{
    echo "<font color = '#000000'>$post_data_missing<br>";
    echo "<br><img src = 'notok.gif'> $status_notok";
    echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
    echo $missing_mail_data;
    echo "<tr><td valign = 'bottom'><br><form action='setadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
    exit;
}
$password=md5($password);
@mysql_query( "INSERT INTO CC_admin( admin_email_address, username, status, password) VALUES('$themailaddress','$username', '$status', '$password')" );
$error_msg .= mysql_error();
if( $error_msg == "" )
{
$joined = mktime();
@mysql_query( "INSERT INTO CC_users(user_site_name,status, joined, user_email_address, username,  password) VALUES('$username', '9','$joined','$themailaddress','$username', '$password')" );
$error_msg .= mysql_error();
}
if( $error_msg == "" )
{
    echo "<br><img src = 'ok.gif'> $status_ok";
    echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
    $error_msg = $_POST["username"];
    $addpas = "&nbsp;".$_POST["password"]."";
    echo "$error_msg $admin_added $addpas.<br>$move_on";
    echo "<tr><td valign = 'bottom'><br><form action='setadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
    echo "<td valign = 'bottom'><br><form action='../urls.php' method='post'>";
    echo "<input type='hidden' name='siteaddy'  value ='$siteaddy'>";
    echo "<input type='submit' name='submit' value='$next' class = 'buttons'></form>";
}else{
    echo "<font color = '#000000'>$unknown_problem<br>";
    echo "<br><img src = 'notok.gif'> $status_notok";
    echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
    echo $unknown_problem_data;
    echo "<tr><td valign = 'bottom'><br><form action='setadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
    exit;
}
?>