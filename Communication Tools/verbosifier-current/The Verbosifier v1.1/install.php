<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="EN">
<head>
<!--
	# The Verbosifier v1.1: http://www.desiquintans.com/verbosifier
	# The Verbosifier is free under version 2 or later of the GPL.
	# This program is distributed with cursory support, but without
	# warranty or guarantee of any sort.
-->
<?php require ('admin/control.php'); ?>
<title>The Verbosifier v1.1 Installation</title>
<style type="text/stylesheet"><![CDATA[
BODY {font-family: Verdana; font-size: 9pt; font-weight: normal; color: #000000; text-align: justify; margin-left: 50px;}
H1 {font-size: 15pt; font-weight: normal; text-align: center; text-decoration: underline; margin-left: -40px;}
H2 {font-size: 12pt; font-weight: normal; margin-left: -40px;}
fieldset {padding: 5px; width: 500px;}
]]></style>
</head>
<body>
<h1>Install <em>The Verbosifier</em> v1.1</h1>
<?php
if($_POST[submit]) {
    // Create the entries table.
    $makeSHOUT = mysql_query("CREATE TABLE ".VERBOSE_TBL." (
    VerID INT NOT NULL AUTO_INCREMENT,
    Name TINYTEXT NOT NULL,
    Url TINYTEXT NOT NULL,
    Shout TINYTEXT NOT NULL,
    Timestamp INT(20) NOT NULL,
    PRIMARY KEY (VerID),
    UNIQUE KEY (VerID)
    )");
    if($makeSHOUT) echo '<span style="color: green;">Table '.VERBOSE_TBL.' successfully created.</span><br />';
        else die(mysql_error().'. You can <a href="mailto:desiq@bigpond.com">email the author</a> for help.');
    
    // Make the first shout.
    $now = time();
    $message = 'Just a friendly hello from the creator of The Verbosifier. Remember that you need to link to
        desiquintans.com/verbosifier at the bottom of your main.htm template. Have fun!';
    mysql_query("INSERT INTO ".VERBOSE_TBL." (VerID, Name, Url, Shout, Timestamp) VALUES (NULL, 'Desi Quintans',
        'http://www.desiquintans.com', '$message', '$now')");

    die('<em>The Verbosifier</em> was successfully installed. You can now post new shouts.
    <p>It is very important that you <strong>delete install.php</strong> from your server for security reasons.</p>');
}
?>

<form method="post" action="<?php echo $_SERVER[PHP_SELF]; ?>">
<fieldset>
<legend>Installing The Verbosifier</legend>
Before starting the installation, please make sure that the information you put in control.php is complete and correct.
<p>
<input type="submit" name="submit" value="I'm sure the information is correct. Install The Verbosifier, please." />
</p>
</fieldset>
</form>
</body>
</html>