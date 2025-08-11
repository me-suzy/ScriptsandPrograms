<?php
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");

$username = addslashes(strip_tags($_POST['email']));

 if ($username=="") {
echo "The email field is required. Use your back button to return to the previous page";
    }
    
// Check user, if ok then update else print error

$sql = mysql_query("SELECT * FROM users WHERE email='$username'");
if(mysql_num_rows($sql) == 1)
{
$row = mysql_fetch_array($sql);

    // password generation
$length="8";
$newpass = substr(md5(uniqid(rand(), true)), 0, $length);
$sendpass="$newpass";    
$newpass = md5("$newpass");

$result2 = mysql_query("UPDATE users SET passwd = '$newpass' WHERE email = '$username'");

// Email the new password to the person.
    $message = "Hello!
 
Here is your new password

    password: $sendpass

If you have any problems, feel free to contact us at
<$owneremail>.

Thank you,
$sitename
";

    mail($username,"Your Password for $sitename",
         $message, "From:<$owneremail>");


  
echo "<html><head><title>Welcome</title></head>";
echo "<body>Password Change Successful!!";
echo "<P>Your password has been changed. Your new password was emailed to $username.";
echo "</body></html>";
}
else
{
  echo "<B>Password not changed.</B> <P>Your email address does not match the information in our database. <P>If you believe this is in error, please contact us at <a href=\"mailto:$owneremail\">$owneremail</a>";
}
?>