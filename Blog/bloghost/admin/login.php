<?php
include "connect.php";
print "<link rel='stylesheet' href='style.css' type='text/css'>";
print "<center><table class='maintable'><tr class='headline'><td><center>Login</center></td></tr>";
print "<tr class='mainrow'><td>";
print "<form action='authenticate.php' method='post'>";
print "Username:<br>";
print "<input type='text' name='username' size='20'><br>";
print "Password:<br>";
print "<input type='password' name='password' size='20'><br>";
print "<input type='submit' name='submit' value='submit'>";
print "</form>";
print "</td></tr></table>";
?>
