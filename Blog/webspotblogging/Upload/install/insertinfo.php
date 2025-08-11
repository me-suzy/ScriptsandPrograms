<?
$path = "../";
require $path."inc/config.inc.php";
require $path."inc/mysql.php";

$database = new database;

$database->connect($config['hostname'], $config['username'], $config['password']);
$database->select($config['database']);
include("../inc/installheader.inc.php");
$errors = 0;
?>
Now we will insert the settings you previously said into the database.<BR><BR>
<?
$content = "<?php
/**********************\
DON'T EDIT THIS FILE
USE THE SETTINGS EDITOR
\**********************/
\$settings[adminemail] = \"".$_POST['email']."\";
\$settings[blogname] = \"".$_POST['name']."\";
\$settings[websitename] = \"".$_POST['websitename']."\";
\$settings[websiteurl] = \"".$_POST['websiteurl']."\";
\$settings[contactlink] = \"mailto:".$_POST['email']."\";
\$settings[dateformat] = \"d-m-Y\";
\$settings[timeformat] = \"h:i A\";
\$settings[maindateformat] = \"l jS F Y\";
\$settings[timeoffset] = \"0\";
\$settings[numberrss] = \"10\";
\$settings[showeditedby] = \"1\";
\$settings[display_posts] = \"6\";
\$settings[version] = \"2.00\";
?>";
$file = fopen("../inc/settings.inc", "w");
fwrite($file, $content);
fclose($file);
$sql = "INSERT INTO `users` ( `uid` , `username` , `password` , `admin` , `mod` ) VALUES ('', '".$_POST['username']."', MD5( '".$_POST['password']."' ) , '1', '1');";
$database->query($sql);
?>
<BR>
Hopefully, that has all been completed successfully. Press Next to continue.
<form action="completion.php" method="link">
<input type="submit" value="Next Step" style="float:right;">
</form>
<?
include("../inc/footer.inc.php");
?>