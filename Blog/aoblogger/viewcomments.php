<?php
require "config.php";
?>

<?php

$idd = mysql_real_escape_string($_GET['idd']);

$result = mysql_query("SELECT * FROM comments WHERE entryid = '$idd' ORDER BY `id` DESC LIMIT 0 , 40");

$numcomments = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM comments WHERE entryid = '$idd'"));
if ($numcomments[0] == 0) {
echo "There are no comments yet. <a href=\"postcomment.php?idd=$idd\">Post a comment</a>.<br />";
} else {

while($row = mysql_fetch_array($result)) {

echo stripslashes(nl2br("<strong>By:</strong> $row[2] (message #$row[0]) <br />
<strong>Date:</strong> $row[5] <br />
<strong>Message:</strong> $row[1]"));

}

}

echo "<li><a href=\"index.php\">Home</a> | <a href=\"postcomment.php?idd=$idd\">Post Comment</a></li>";

?>

<li><a href="index.php">Home</a></li>