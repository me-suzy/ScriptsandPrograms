<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
// THIS FILE (COMPLETE.PHP) CAN BE SAFELY DELETED ONCE CLEVER COPY HAS BEEN INSTALLED
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>Clever Copy install wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><br><br><br><br>";
echo "<br>Status OK";
echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>";
if ((is_dir("install"))||(is_file("urls.php")))
{
   echo "There is one last thing to do before you can continue.<br>The file 'urls.php' and the directory 'install' were found. You must now remove or rename the 'install' directory and the file 'urls.php' from your server root. Do NOT close this window!<br><br>Go to your FTP client - once open, delete or rename the 'install' directory. When you have done that, delete or rename the file 'urls.php'. When that is done refresh this page.<br>This will prevent anyone else from running this install script and you cannot continue until you have done so.";
}else{
   echo "Well done - Install is completed!<br>You may now go to your site and login. Once logged in you will be recognised as admin and can customise your site.<br>";
   echo "<tr><td colspan = '2'><br><form action='index.php'><input type='submit' name='submit' value='Go to your site' class = 'buttons'></form>";
}

?>