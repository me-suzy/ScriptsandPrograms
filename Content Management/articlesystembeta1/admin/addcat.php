<?php

if (isset($_POST['submit']))
{
	$name = htmlspecialchars($_POST['name']);
	if (empty($name))
	{
		die ("<p class='error'>You didn't enter a name!</p>");
	}
	$description = htmlspecialchars($_POST['description']);
	
		if (empty($description))
	{
		die ("<p class='error'>You didn't enter a description!</p>");
	}
	
	 $sql = "INSERT into cats (name,description) VALUES ('$name','$description')";    


    if (@mysql_query($sql)) {
    	echo "<p class='fab'>Catagory added!</p>";
    }
    else
    {
    	die ("<p class='error'>".mysql_error()."</p>");
    	
    }
}
else{
	?>
	<h2>Add Catagory</h2>
	<form action="" method="post">
	<table cellspacing="3" cellpadding="5" style="border:1px solid #999999;">
	<tr><td><strong>Name:</strong><td><input type="text" name="name" /></td></tr>
	<tr><td><strong>Description:</strong></td><td><input type="text" name="description" /></td></tr>
	<tr><td colspan="2"><input type="submit" name="submit" value="Add Catagory" /></td></tr>
	</table>
	</form>
	<?
}
?>
