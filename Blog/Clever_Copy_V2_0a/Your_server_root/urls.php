<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
include "admin/connect.inc";
include "install/antihack.php";
include "install/languages/default.php";
$_POST['sitepath'] = getcwd();
$sitepath = $_POST['sitepath'];
$sitebaddress = $_POST['siteaddy'];
//$sitebaseaddress = $_SERVER['HTTP_HOST'];
$ranpicpath = "$sitepath/randompics/";
$donation_image_path = "$sitebaddress/images/paypal_donate.gif";
$galranpicpath = "$sitepath/gallery/photos/thumb/";
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'install/wizard.jpg'><br><br><img src = 'install/status7.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
echo "<br><img src = 'install/ok.gif'> $status_ok";
echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
echo "<form action='install/addurls.php' method='post'>";
echo "&nbsp;$set_prefs<br><br>";
echo "&nbsp;$site_name<br>";
echo "&nbsp;<input type='text' name='title' size='60'><br><br>";
echo "&nbsp;$main_mail<br>";
echo "&nbsp;<input type='text' name='siteemail' size='60'><br><br>";
echo "&nbsp;$paypal_addy<br>";
echo "&nbsp;<input type='text' name='donation_email_address' size='60'><br><br>";
echo "&nbsp;$pp_currency<br>";
echo "&nbsp;<select name='donation_currency'><br>";
echo "&nbsp;<option value='USD'>US Dollars</option>";
echo "&nbsp;<option value='GBP'>GB Pounds</option>";
echo "&nbsp;<option value='EUR'>Euros</option>";
echo "&nbsp;<option value='CAD'>Canada Dollars</option>";
echo "&nbsp;<option value='JPY'>Jpn Yen</option></select><br><br>";
echo "&nbsp;$date_format<br>";
echo "&nbsp;<select name='dateset'>";
echo "&nbsp;<option value='1'>$eur_time_label</option>";
echo "&nbsp;<option value='0'>$us_time_label</option></select><br><br>";
echo "<input type='hidden' name='sitepath' value ='$sitepath'>";
echo "<input type='hidden' name='ranpicpath' value ='$ranpicpath'>";
echo "<input type='hidden' name='siteaddress' value ='$sitebaddress'>";
echo "<input type='hidden' name='donation_image_path' value ='$donation_image_path'>";
echo "<input type='hidden' name='galranpicpath' value ='$galranpicpath'>";
echo "<input type='submit' name='submit' value='$next' class = 'buttons'></form>";
echo "<tr><td valign = 'bottom'><br><form action='install/addadmin.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
?>