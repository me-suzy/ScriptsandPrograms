<?php
if (isset($_POST['addtemplate']))
{
	$name = $_POST['name'];
	if (empty($name))
	{
		die ("<p class='error'>The name field was empty! <a href='index.php?func=settings'>Return</a></p>");
	}
	$value = $_POST['value'];
	if (empty($value))
	{
		die ("<p class='error'>You did not enter a value! <a href='index.php?func=settings'>Return</a></p>");
	}
	$sql = "INSERT into templates (name,value) VALUES ('$name','$value')";
	if (@mysql_query($sql))
	{
		echo "<p class='fab'>Template bit Added!</p>";
	}
	else
	{
		echo "<p class='error'>".mysql_error()."</p>";

	}

}
$sql = mysql_query("SELECT * FROM templates");

$settings ="";
$i = 1;
while($row = mysql_fetch_array($sql)){
	$row['value'] = htmlentities($row['value']);
	$settings .= "<h4><div style='float: right'><a onclick=\"switchMenu('{$row['name']}');\" style='cursor:pointer;cursor:hand' title=\"Switch!\">Open/Close</a></div>{$row['name']}</h4>
    <div id='{$row['name']}' style='display:none;'>
	<textarea name=\"$i\" rows=\"15\" cols=\"40\">{$row['value']}</textarea>
  </div>
	";
	$i++;
}

if (isset($_POST['submit']))
{
	// assuming you have used the autoID value as the name for the link textbox

	$values = array();
	unset ($_POST['submit']);


	foreach ($_POST as $key=>$val) {


		html_entity_decode($val);

		$sql2 = "UPDATE templates set value='$val' WHERE id='$key'";
		mysql_query($sql2);
		unset ($sql2);
	}

	@header("Location: index.php?func=templates");


}

?>

<h2>Template Editor</h2>
<form method="post" action="">
  
 <?
 echo $settings;
?>

<p><input type="submit" name="submit" id="submit" value="Update Templates" />

</p>
</form>


<p>
<a onclick="switchMenu('nextstep');" style='cursor:pointer;cursor:hand' title="Switch!">Add Template Bit (Advanced Users Only!)</a>
</p>


<div id="nextstep" style="display: none">

<form action="" method="post">
<table cellspacing="3" cellpadding="4">
<tr><td><strong>Name</strong></td><td>
<input type="text" name="name" /></td></tr>
<tr><td><strong>Value</strong></td><td>
<textarea name="value" rows="15" cols="30"></textarea></td></tr>
<tr><td>
<input type='submit' name='addtemplate' value='Add Template' />
</td><td></td></tr>
</table>
</form>

</div>
<br />
