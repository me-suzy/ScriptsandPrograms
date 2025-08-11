<?php
require "config.php";
?>

<?php


if (isset($message)) {

$time = gmdate("M jS Y");

mysql_query("INSERT INTO blog SET title = '$title', message ='$message', time = '$time'") or die(mysql_error());


print "Your blog has been updated. Go back to the <a href=index.php>index</a> to view it.";

}

if (!isset($message)) {

echo "
<form action=\"$filename\" method=\"post\">
<br /><br /><strong>Post new entry</strong>
<h6>Title:</h6> <textarea name=\"title\" rows=\"1\" cols=\"80\"></textarea>
<h6>Message:</h6> <textarea name=\"message\" rows=\"10\" cols=\"80\"></textarea><br /><br />
<input type=\"submit\" value=\"Post Entry\" name=\"send\" class=\"submit\" />
</form>";

}


?>