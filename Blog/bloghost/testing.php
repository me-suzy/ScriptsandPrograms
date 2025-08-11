<?php
include "admin/connect.php";
$getstyle="SELECT cssfile from bl_css where cssid='1'";
$getstyle2=mysql_query($getstyle) or die("Could not get style");
$getstyle3=mysql_fetch_array($getstyle2);
print "$getstyle3[cssfile]";
print "<table class='maintable'><tr class='headline'><td>Hi</td></tr></table";
?>>