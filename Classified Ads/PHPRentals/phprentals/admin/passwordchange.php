<?php

include("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.inc.php");

$email = addslashes(strip_tags($_POST['email']));

if ($email == "") {
    echo "One or more required fields were left blank. Please fill them in and try again. Use your back button to return to the previous page";
} 

$sql = mysql_query("SELECT * FROM users WHERE email='$email' ");
while ($row = mysql_fetch_array($sql)) {

    $emaildb = $row["email"];

    $newpass = substr((time()), 0, 6);

    mysql_query("UPDATE users SET pword = md5('$newpass') WHERE email = '$user'");
        // Email the new password to the person.

$message = "Hello!
Your password has been reset . Here is your new password

password: $newpass

If you have any problems, feel free to contact us at $owneremail";

    mail("$emaildb","Your New Password",
         $message, "From:$owneremail");
		
}
if (!$notfound){
echo "<B>Password not changed.</B><P>Either your username or email address does not match your current information.<P>If you believe this is in error, please contact us at <a href=\"mailto:$owneremail\">$owneremail</a>";
 }else {
            echo "<html><head><title>Success!</title></head>";
            echo "<body>Your password has been reset.";
            echo "<P>Your new password was emailed to $emaildb. <P>Please log in again <a href=\"index.php\">Log In</a>";
            echo "</body></html>";
        } 
?>