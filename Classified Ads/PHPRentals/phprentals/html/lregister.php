<?php

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$fname = addslashes(strip_tags($_POST['fname']));
$lname = addslashes(strip_tags($_POST['lname']));
$add = addslashes(strip_tags($_POST['add']));
$addtwo = addslashes(strip_tags($_POST['addone']));
$city = addslashes(strip_tags($_POST['city']));
$state = addslashes(strip_tags($_POST['state']));
$zip = addslashes(strip_tags($_POST['zip']));
$email = addslashes(strip_tags($_POST['email']));
$phone = addslashes(strip_tags($_POST['phone']));


if (!$fname || !$lname || !$add || !$city || !$state || !$zip || !$phone || !$email) {
    echo "Error!! You have not entered the following field(s).Hit back and try again<br>\n";

    $fields_to_validate = array('fname', 'lname', 'add', 'city', 'state', 'zip', 'phone', 'email');
    // validate above fields.
    $field_display_value = array('First Name', 'Last Name', 'Address', 'City', 'State', 'Zip', 'Telephone', 'Email');
    // if the field is not set then show the above display value.
    echo "<ul>\n";
	
    for($a = 0;$a < count($fields_to_validate);$a++) {
        // loop through fields and check whether that has been set or not.
        if (!${$fields_to_validate[$a]}) {

            echo "<li><font color=\"#FF0000\">$field_display_value[$a]</font>\n";
        } 
    } 
    echo "</ul>\n";
} else {

//Select statement detects if another user matches
$sql = "SELECT COUNT(*) FROM users WHERE email = '$email'";
    $result = mysql_query($sql);
    if (!$result) {	
echo "A database error occurred";
    }
//Code here inserts if customer has already been in
if (mysql_result($result,0,0)>0) 	
{ 
	echo "You have already registered. If you have forgotten your login details please <a href=\"lostpwd.php\">go here</a> to retrieve it.";
}else {

    // password generation
$length="8";
$newpass = substr(md5(uniqid(rand(), true)), 0, $length);
    $newpassinst = md5("$newpass");
	
    // db insert and redirection
    mysql_query ("INSERT INTO landlords (fname, lname, phone) VALUES ('$fname', '$lname', '$phone')");
    
$idsql = "SELECT * FROM landlords WHERE fname='$fname' and lname='$lname'";
//echo "$idsql";
$result2 = mysql_query($idsql)
or die ("Query failed");
while ($row2 = mysql_fetch_array($result2))
{
$llid=$row2["lid"];
}

    mysql_query ("INSERT INTO users (llid, fname, lname, email, addone, addtwo, city, state, zip, phone, passwd, tdate) VALUES ('$llid', '$fname', '$lname', '$email', '$add', '$addtwo', '$city', '$state', '$zip', '$phone', '$newpassinst', NOW()) ");
    
	// mail password to user

    mail("$email", "$emailsubject", "Dear $fname $lname,
Thank you for registering. Below you will find your username and password that will let you log in and begin to enter
rental listings.

Username: $email
Password: $newpass


", "FROM:$owneremail");

// thankyou page
header("Location: http://$domain/phprentals/html/postregister.php");
}} 
?>