<?php
switch (@$_GET['do'])
{
	case 'delete':
	delete();
	break;
	
	default:
	settings();
	break;
}

function settings()
{
if (isset($_POST['addsetting']))
{
	$rname = htmlspecialchars($_POST['realname']);
	if (empty($rname))
	{
		die ("<p class='error'>The realname field was empty! <a href='index.php?func=settings'>Return</a></p>");
	}
	$dname = htmlspecialchars($_POST['displayname']);
	if (empty($dname))
	{
		die ("<p class='error'>The displayname field was empty! <a href='index.php?func=settings'>Return</a>");
	}
	$value = $_POST['value'];
	if (empty($value))
	{
		die ("<p class='error'>The value field was empty! <a href='index.php?func=settings'>Return</a>");
	}
	$sql = "INSERT into settings (realname,displayname,value) VALUES ('$rname','$dname','$value')";
	if (@mysql_query($sql))
	{
		echo "<p class='fab'>Setting Added!</p>";
	}
	else
	{
		echo "<p class='error'>".mysql_error()."</p>";

	}

}
$sql = mysql_query("SELECT * FROM settings");

$settings ="";
$i = 1;
while($row = mysql_fetch_array($sql)){
	$settings .= "<tr>
    <th scope=\"row\"><div style='float:right'><a href='index.php?func=settings&amp;do=delete&amp;id={$row['id']}' onclick='return check();' title='Delete setting: {$row['realname']}'><img src='../images/delete.png' alt='Delete' /></a></div>{$row['displayname']} </th>
    <td width=\"75%\"><input type=\"text\" name=\"$i\" value=\"{$row['value']}\" /></td> 
  </tr>";
	$i++;
}

if (isset($_POST['submit']))
{
	

	foreach ($_POST as $key=>$val) {

		$sql2 = "UPDATE settings set value='$val' WHERE id='$key'";
		mysql_query($sql2);
		unset ($sql2);
	}

	@header("Location: index.php?func=settings");


}

?>

<h2>Settings</h2>
<form method="post" action="">
<table class="formdata" width="100%">

  <tr>
    <th width="25%"><strong>Setting Name</strong></th>
    <th scope="col"><strong>Setting Value</strong></th>  
  </tr>  
 <?
 echo $settings;
?>
</table>
<p><input type="submit" name="submit" id="submit" value="Update Settings" /></p>
</form>


<p>
<a onclick="switchMenu('nextstep');" style='cursor:pointer;cursor:hand' title="Switch!">Add Setting</a>
</p>
<div id="nextstep" style="display: none;">
<form action="" method="post">
<table cellspacing="3" cellpadding="4">
<tr><td><strong>Real Name</strong><br /><i style="font-size: 10px">(IE: $setting['realname']))</i></td><td>
<input type="text" name="realname" /></td></tr>
<tr><td><strong>Display Name</strong><br /><i style="font-size: 10px">(Used in table above)</i></td><td>
<input type="text" name="displayname" /></td></tr>
<tr><td><strong>Value</strong></td><td>
<input type="text" name="value" /></td></tr>
<tr><td>
<input type='submit' name='addsetting' value='Add Setting' />
</td><td></td></tr>
</table>
</form>

</div>
<br />
<? } 
function delete()
{
	$id = htmlspecialchars(intval(@$_GET['id']));
	if (empty($id))
	{
		die ("<p class='error'>No Setting Selected</p>");
	}

	$result = @mysql_query("SELECT id FROM settings where id='$id'");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such setting! <a href='index.php?func=settings' title='Go Back'>Return</a></p>");
		}
		unset ($row);

		$sql = "DELETE FROM settings WHERE id='$id'";

		if (mysql_query($sql)) {
			echo "<p class='fab'>Setting Deleted! <a href='index.php?func=settings' title='Go Back'>Return</a></p>";
		}

}

?>
