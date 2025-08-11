<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
include "../admin/connect.inc";
include "antihack.php";
include "languages/default.php";
$error_msg = "";
$title=$_POST["title"];
$siteemail = $_POST["siteemail"];
$siteemail = sesson($siteemail);
$donation_email_address=$_POST["donation_email_address"];
$donation_email_address = sesson($donation_email_address);
$donation_currency=$_POST["donation_currency"];
$dateset=$_POST["dateset"];
$ranpicpath=$_POST["ranpicpath"];
$galranpicpath=$_POST["galranpicpath"];
$sitepath=$_POST["sitepath"];
$siteaddress=$_POST["siteaddress"];
$donation_image_path=$_POST["donation_image_path"];
$rssimageurl = "$siteaddress/images/cclogo.jpg";
$version = "V2.0";
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status8.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
$status = '0';
if ($_POST["siteemail"] =="")
{
   echo "<font color = '#000000'>$fatal_err $check_your_sitemail<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $no_mail;
   echo "<tr><td valign = 'bottom'><br><form action='../urls.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   exit;
}
if ($_POST["title"] =="")
{
   $title = "Clever Copy";
}
if ($_POST["donation_email_address"] =="")
{
   $donation_email_address = "enter@mail_address_here.com";
   $donation_email_address = sesson($donation_email_address);
}
if ($_POST["ranpicpath"] =="")
{
   echo "<font color = '#000000'>$check_your_path<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $no_ranpicpath;
   $status = '1';
}
if ($_POST["galranpicpath"] =="")
{
   echo "<font color = '#000000'>$check_your_path<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $no_galranpicpath;
   $status = '1';
}
if ($_POST["sitepath"] =="")
{
   echo "<font color = '#000000'>$check_your_path<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $no_sitepath;
   $status = '1';
}
if ($_POST["donation_image_path"] =="")
{
   echo "<font color = '#000000'>$check_your_path<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $no_donationpath;
   $status = '1';
}
if ($_POST["siteaddress"] =="")
{
   echo "<font color = '#000000'>$check_your_address<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $no_siteaddress;
   $status = '1';
}
if ($status == '1')
{
   echo "<tr><td valign = 'bottom'><br><form action='../urls.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   echo "<tr><td valign = 'bottom'><br><form action='../complete.php' method='post'><input type='submit' name='submit' value='$next' class = 'buttons'></form>";
}else{
   $setprefs="update CC_prefs set rssimageurl = '$rssimageurl',version = '$version', donation_image_path = '$donation_image_path', siteaddress = '$siteaddress', sitepath = '$sitepath', ranpicpath = '$ranpicpath', dateset = '$dateset', donation_currency = '$donation_currency', donation_email_address = '$donation_email_address', title='$title', siteemail = '$siteemail', cc_address = '$siteemail'";
   mysql_query($setprefs);
   $error_msg .= mysql_error();
   $setgal="update CC_gallery set galranpicpath = '$galranpicpath'";
   mysql_query($setgal);
   $galerror_msg .= mysql_error();
   if (($error_msg !== "")||($galerror_msg !== ""))
   {
        echo "<br><b>$fatal_err<br> $error_msg<br>$galerror_msg<br></b>";
   }else{
        echo "<font color = '#000000'>";
        echo "<br><img src = 'ok.gif'> $status_ok";
        echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
        echo "$installed";
        echo "<tr><td valign = 'bottom'><br><form action='../complete.php' method='post'><input type='submit' name='submit' value='$next' class = 'buttons'></form>";
   }
}

?>