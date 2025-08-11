<?php
require "config.php";
?>

<?php

if (isset($name)) {

$name = trim($name);
$email = trim($email);
$message = trim($message);

$time = gmdate("M jS Y");
$name = mysql_real_escape_string(htmlentities($name));
$email = mysql_real_escape_string(htmlentities($email));
$message = mysql_real_escape_string(htmlentities($message));

$namelength = strlen($name);
$messagelength = strlen($message);

if ($namelength < 3) {
$msg = "Your name must be at least 3 characters.";
} elseif ($messagelength < 5) {
$msg = "Your message must be at least 5 characters.";
} elseif ($messagelength > 1000 ) {
$msg = "Your message must be no more than 1,000 characters.";
}

if (isset($msg)) {
echo "$msg";
exit();
} else {

mysql_query("INSERT INTO comments SET comment = '$message', name ='$name', time = '$time', email = '$email', entryid = '$idd' ") or die(mysql_error());

print "Your comment has been added! <a href='index.php'>Return to Index</a>";

}

}



if (!isset($name)) {

$idd = mysql_real_escape_string($_GET['idd']);

$existentry = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM blog WHERE id = '$idd'"));
if ($existentry[0] == 1) {

echo "
<form action=\"postcomment.php\" method=\"post\">
<br /><br /><strong>Post new comment</strong>
<h6>Name: </h6><input type=\"text\" name=\"name\" maxlength=\"25\" size=\"40\"  /><br /><br />
<h6>Email Address: </h6><input type=\"email\" name=\"mail\" maxlength=\"40\" size=\"40\"  /><br /><br />
<h6>Message:</h6> <textarea name=\"message\" rows=\"10\" cols=\"40\" ></textarea>
<input type=\"hidden\" name=\"idd\" value=\"$idd\" /><br /><br />
<input type=\"submit\" value=\"Post Comment\" name=\"send\" class=\"submit\" />
</form>
";

} else {
echo "Invalid blog ID";
}

}

?>