<?
$path = "../";
$page = "Installation Wizard : Welcome";
include("../inc/installheader.inc.php");
?>
Before you can install we will need to check that your configuration file is writable.<BR><BR>
<?
$checkchmod = is_writeable("../inc/config.inc.php");
$checkchmods = is_writeable("../inc/settings.inc");
if (!$checkchmod){
echo "<b>Unfortunatly you have not made the file, 'inc/config.inc.php', writable. Setup cannot proceed until you have made the file writable</b>";
} elseif (!$checkchmods){
echo "<b>Unfortunatly you have not made the file, 'inc/settings.inc', writable. Setup cannot proceed until you have made the file writable</b>";
} else {
?>
Configuration file : Writable.<BR>
<?
?>
Settings file : Writable.<BR><BR>
Everything seems in order and now can continue by pressing Next.<BR><BR>
<form action="database.php" method="link">
<input type="submit" value="Next Step" style="float:right;">
</form>
<?
}
include("../inc/footer.inc.php");
?>