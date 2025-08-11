<?
$errors = 0;
include("../inc/installheader.inc.php");
?>
We Will now attempt to connect with the settings you entered on the last page.<BR><BR>
<?
$connection = mysql_connect($_POST['host'], $_POST['username'], $_REQUEST['password']);
echo "Testing MYSQL Server connection : ";
if (!$connection){
echo "[<b>Failed</b>]<BR><BR>";
echo "<b>We were unable to connect to your MYSQL server with the information provided!!! Please go back and check your settings.</b>";
$errors = 1;
} else{
echo "[OK]<BR>";
$dbselect = mysql_select_db($_REQUEST['database']);
echo "Testing the ability to select the database : ";
if (!$dbselect){
echo "[<b>Failed</b>]<BR><BR>";
echo "<b>We were unable to connect to your MYSQL server with the information provided!!! Please go back and check your settings.</b><BR>".mysql_error();
$errors = 1;
} else{
echo "[OK]<BR>";
?>
<BR><BR>
Passed test's successfully. Now saving settings to file.<BR>
Saving Settings :&nbsp;
<?
	$configdata = "<?php\n".
	"\$config['hostname'] = \"".$_POST['host']."\";\n".
	"\$config['username'] = \"".$_POST['username']."\";\n".
	"\$config['password'] = \"".$_POST['password']."\";\n".
	"\$config['database'] = \"".$_POST['database']."\";\n".
	"?>";
	$file = fopen("../inc/config.inc.php", "w");
	fwrite($file, $configdata);
	fclose($file);
?>
[Done]<BR><BR>
<!--Finished Things-->
<b>Settings have been saved to the config file sucessfully. Now press next.</b>
<?
}
}
if ($errors == 0){
?>
<form action="createtables.php" method="link">
<input type="submit" value="Next Step" style="float:right;">
</form>
<?
}
include("../inc/footer.inc.php");
?>