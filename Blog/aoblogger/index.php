<?php
require "config.php";
?>

<!-- Blog script copyright of addicted one http://yourmomatron.com please leave this line in to help me find users of my script via google searching. Newest release can always be found at http://mikeheltonisawesome.com/aoblogger.zip -->

<?php

$result = mysql_query("SELECT * FROM blog ORDER BY `id` DESC LIMIT 0 , 100");
while($row = mysql_fetch_array($result))
{

$id = $row[0];
$numcomments = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM comments WHERE entryid = '$id'"));

echo stripslashes(nl2br("
<h6>$row[3] - $row[1]</h6> $row[2] <br />
<h6>- <a href='viewcomments.php?idd=$id'>Comments: ($numcomments[0])</a> | <a href='postcomment.php?idd=$id'>Post Comment</a></h6>"));

}

?>