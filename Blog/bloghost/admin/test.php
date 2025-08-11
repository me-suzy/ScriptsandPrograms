<?php
include "connect.php";
$opencss=fopen("style.css","r"); //open style.css for reading
$grabcss=fread($opencss,filesize("style.css"));
fclose($opencss);
mysql_query("update bl_admin set css='$grabcss' where adminid='1'") or die("did not work");
print "Done";
?>