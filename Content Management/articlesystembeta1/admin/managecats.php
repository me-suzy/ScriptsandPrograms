<?
switch (@$_GET['do'])
{
	case 'delete':
	delete();
	break;
	
	default:
	managecats();
	break;
}
function managecats ()
{
$sql = mysql_query("SELECT * FROM cats");

$settings ="";
$i = 1;
while($row = mysql_fetch_array($sql)){
	
	$row['description'] = html_entity_decode($row['description']);
	$row['description'] = htmlspecialchars($row['description']);
	
	$settings .= "
	<fieldset>
	<legend>{$row['name']}</legend>
	<div style='float: right'><a href='index.php?func=managecats&amp;do=delete&amp;id={$row['id']}' title='Delete this catagory'><img src='../images/delete.png' alt='Delete' /></a></div>
    <table cellspacing=\"5\" cellpadding=\"2\"><tr><td><strong>Catagory Name:</strong></td><td><input type=\"text\" name=\"name[{$row['id']}]\" value=\"{$row['name']}\" />
   </td></tr><tr><td><strong>Description:</strong></td><td><textarea cols=\"40\" rows=\"4\" name=\"desc[{$row['id']}]\">{$row['description']}</textarea></td></tr></table>
  </fieldset><br />";
	$i++;
}

if (isset($_POST['submit']))
{
	// assuming you have used the autoID value as the name for the link textbox


	foreach ($_POST['name'] as $key=>$val) {
$val = htmlspecialchars($val);
		$sql2 = "UPDATE cats set name='$val' WHERE id='$key'";
		mysql_query($sql2);
		unset ($sql2);
	}

		foreach ($_POST['desc'] as $key=>$val) {
$val = htmlspecialchars($val);
		$sql2 = "UPDATE cats set description='$val' WHERE id='$key'";
		mysql_query($sql2);
		unset ($sql2);
	}
	
	echo "<script language=\"javascript\">window.location=\"index.php?func=managecats\";</script>";


}


?>

<h2>Manage Catagories</h2>
<form method="post" action="">

 <?
 echo $settings;
?>

<p><input type="submit" name="submit" id="submit" value="Update Catagories" /></p>
<p><a href="index.php?func=addcat" title="Add a catagory">Want to add a catagory?</a></p>
</form>
<? } 

function delete()
{
	
	$id = htmlspecialchars(intval(@$_GET['id']));
	if (empty($id))
	{
		die ("<p class='error'>No Cat Selected</p>");
	}

	$result = @mysql_query("SELECT id FROM cats where id='$id'");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such catagory! <a href='index.php?func=managecats' title='Go Back'>Return</a></p>");
		}
		unset ($row);

		$sql = "DELETE FROM cats WHERE id='$id'";
		$sql2 = "DELETE FROM articles WHERE catid='$id'";

		if (@mysql_query($sql) && @mysql_query($sql2)) {
			echo "<p class='fab'>Catagory Deleted! <a href='index.php?func=managecats' title='Go Back'>Return</a></p>";
		}
}
?>