<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://www.webspot.co.uk/scripts/blogging/
* Licence : http://www.webspot.co.uk/scripts/blogging/eula.php
*
**/
session_start();
$path = "../";
require $path."inc/config.inc.php";
require $path."inc/mysql.php";

$database = new database;

$database->connect($config['hostname'], $config['username'], $config['password']);
$database->select($config['database']);
include("../inc/installheader.inc.php");
?>
Now we will insert the Default theme into the table.<BR><BR>
<?
$sql = "INSERT INTO `theme` VALUES (1, 'Default', '#FFFFFF', 'styles/default/subheader.gif', 'Tahoma, Verdana, Arial, Helvetica, Sans-Serif', '11px', '#FFFFFF', 'styles/default/header.gif', 'Tahoma, Verdana, Arial, Helvetica, Sans-Serif', '11px', '#000000', '#EDEDED', 'Tahoma, Verdana, Arial, Helvetica, Sans-Serif', '13px', '#000000', '#DCDCDC', 'Tahoma, Verdana, Arial, Helvetica, Sans-Serif', '13px', '#FFFFFF', '#70B66D', 'Tahoma, Verdana, Arial, Helvetica, Sans-Serif', '13px', '#ffffff', '#70B66D', '#EEEEEE', 'styles/default/logo.gif', '96%', 1);";
$query = $database->query($sql);
echo "Inserting theme into the table, 'theme'... ";
if (!$query){
echo "<b>Failed</b>";
} else{
echo "Done";
}
?>
<form action="information.php" method="link">
<input type="submit" value="Next Step" style="float:right;">
</form>
</td></div></tr></table>
<?
include("../inc/footer.inc.php");
?>
</body></html>