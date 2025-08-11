<?php

if(is_file("install.php")){
	echo("There is install.php. If you have installed g-shout, you MUST delete install.php (or rename it to anything) and then you can go to Admin Control Panel directly.<br />But if you have not installed g-shout yet, read the README.txt file inside \"docs\" directory and then run install.php to check the required files. <br /><br />");
	echo ("<a href='admin.php'>click here to Login to Admin Control Panel</a> (delete install.php first)<br />");
	echo ("<a href='install.php'>click here to run install.php</a><br />");
} else {
	header("Location: admin.php");
}

?>