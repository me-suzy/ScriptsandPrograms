<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
include "languages/default.php";
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>Clever Copy install wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status1.jpg'><br><br>";
echo "<br><img src = 'ok.gif'> $status_ok";
echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>$welcome_message$welcome_messagetwo";
echo "<tr><td colspan = '2'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$next' class = 'buttons'></form>";
?>