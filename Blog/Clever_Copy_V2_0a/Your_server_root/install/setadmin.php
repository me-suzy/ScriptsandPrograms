<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
$siteaddy = $_POST['siteaddy'];
include "languages/default.php";
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status5.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
echo "<br><img src = 'ok.gif'> $status_ok";
echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>";
echo "&nbsp;&nbsp;$setup_god_admin<br><br>";
echo "<form method='post' action='addadmin.php'>";
echo "&nbsp;&nbsp;<label>$your_email<br>&nbsp;&nbsp;<input type='text' size = '60' name='admin_email_address'></label><br>";
echo "&nbsp;&nbsp;<label>$your_username<br>&nbsp;&nbsp;<input type='text' name='username'></label><br>";
echo "&nbsp;&nbsp;<label>$your_pass<br>&nbsp;&nbsp;<input type='password' name='password'></label><br>";
echo "&nbsp;&nbsp;<label>$confirm_pass<br>&nbsp;&nbsp;<input type='password' name='password2'></label><br><br>";
echo "<input type='hidden' name='siteaddy'  value ='$siteaddy'>";
echo "&nbsp;&nbsp;<input type='submit' value='$set_god' class = 'buttons'/>";
echo "</form>";
echo "<tr><td valign = 'bottom'><br><form action='tables.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
?>