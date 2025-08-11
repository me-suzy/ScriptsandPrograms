<?php
if (isset($_POST['submit']))
{
	$name = htmlspecialchars($_POST['name']);
	if (empty($name))
	{
		die ("<p class='error'>The name field was empty! <a href='index.php?func=addarticle'>Return</a></p>");
	}
	$article = $_POST['article'];

	$catid = $_POST['cats'];

	$sql = "INSERT into articles (name,article,catid) VALUES ('$name','$article','$catid')";
	$sql2 = "UPDATE cats set numarticles=numarticles+1 WHERE id='$catid'";


	if (@mysql_query($sql) && @mysql_query($sql2)) {
		echo "<p class='fab'>Article Added!</p>";
	}
	else
	{
		die ("<p class='error'>".mysql_error()."</p>");

	}
}
$result = @mysql_query('SELECT id,name FROM cats');
if (!$result) {
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}

$cats = "";
while ($row = mysql_fetch_array($result)) {
	$cats .= "<option value='{$row['id']}'>{$row['name']}</option>";
}
?>
<h2 style=' border-bottom:1px dashed #999999;'>Add Article</h2>
<form action="index.php?func=addarticle" method="post">
<table cellspacing="3" cellpadding="5" style="border:1px solid #999999;" width="100%">
<tr><td><strong>Article Name:</strong></td><td><input type="text" name="name" /></td></tr>
<tr><td><strong>Catagory:</strong></td>
<td>
<select name="cats">
<? echo $cats ?>
</select>
</td></tr>
<tr><td colspan="2">
<textarea name="article" cols="62" rows="25">
</textarea></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Add" /></td></tr>
</table>
</form>
