
<h2>Manage Glossary</h2>
<?php

switch (@$_GET['do']){

	case 'delete':
	delete();
	break;

	case 'edit':
	edit();
	break;

	default:
	home();
	break;
}

function delete()
{

	$id = htmlspecialchars(intval(@$_GET['id']));
	if (empty($id))
	{
		die ("<p class='error'>No Word Selected</p>");
	}

	$result = @mysql_query("SELECT id FROM glossary where id='$id'");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such word! <a href='index.php?func=glossary' title='Go Back'>Return</a></p>");
		}
		unset ($row);

		$sql = "DELETE FROM glossary WHERE id='$id'";

		if (@mysql_query($sql)) {
			echo "<p class='fab'>Word Deleted! <a href='index.php?func=glossary' title='Go Back'>Return</a></p>";
		}

}

function edit()
{
	$id = htmlspecialchars(intval(@$_GET['id']));
	if (empty($id))
	{
		die ("<p class='error'>No Word Selected <a href='index.php?func=glossary' title='Go Back'>Return</a></p>");
	}
	if (isset($_POST['submit']))
	{
		$word = htmlspecialchars($_POST['word']);
		if (empty($word))
		{
			die ("<p class='error'>The word field was empty! <a href='index.php?func=glossary' title='Go Back'>Return</a></p>");
		}
		$definition = $_POST['definition'];
		if (empty($definition))
		{
			die ("<p class='error'>The definition field was empty! <a href='index.php?func=glossary' title='Go Back'>Return</a>");
		}
		$sql = "UPDATE glossary set word='$word',definition='$definition' WHERE id='$id'";

		if (@mysql_query($sql)) {
			echo "<p class='fab'>Word Updated! <a href='index.php?func=glossary' title='Go Back'>Return</a></p>";
		}
		else
		{
			die ("<p class='error'>".mysql_error()."</p>");

		}
	}
	else
	{
		$result = @mysql_query("SELECT * FROM glossary where id='$id'");
		if (!$result) {
			die('<p class="error">Error performing query: ' .
			mysql_error() . '</p>');
		}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such word! <a href='index.php?func=glossary' title='Go Back'>Return</a></p>");
		}

 	?>
 	<table style="border:1px solid #999999;" cellspacing="3" cellpadding="5" width="50%">
 	<form action="" method="post">
 	
 	<tr><td valign="middle" width="5%"><strong>Name:</strong></td><td valign="middle"><input type="text" name="word" value="<? echo $row['word'] ?>" /></td></tr>
 	<tr><td valign="middle" width="5%"><strong>Definition:</strong></td><td><input type="text" name="definition" value="<? echo $row['definition']?>" /></td></tr>
 	<tr><td colspan="2"><input type="submit" name="submit" value="Edit" /></td></tr>
 	
 	</form></table><br />
 	
 	<?

	}


}

function home()
{

	if (isset($_POST['addword']))
	{
		$word = htmlspecialchars($_POST['word']);
		if (empty($word))
		{

			die ("<p class='error'>You didn't enter a word!</p>");

		}
		$definition = htmlspecialchars($_POST['definition']);

		if (empty($definition))
		{
			die ("<p class='error'>You didn't enter a definition!</p>");
		}

		$sql = "INSERT into glossary (word,definition) VALUES ('$word','$definition')";

		if (@mysql_query($sql)) {
			echo ("<p class='fab'>Word Added!</p>");
		}
		else
		{
			die ("<p class='error'>".mysql_error()."</p>");

		}
	}

	// If current page number, use it
	// if not, set one!

	if(!isset($_GET['page'])){
		$page = 1;
	} else {
		$page = htmlspecialchars((int)$_GET['page']);
	}

	// Define the number of results per page
	$max_results = 10;

	// Figure out the limit for the query based
	// on the current page number.
	$from = (($page * $max_results) - $max_results);

	// Perform MySQL query on only the current page number's results

	$sql = mysql_query("SELECT * FROM glossary LIMIT $from, $max_results");

	$words = "";
	$check = "";
	while($row = mysql_fetch_array($sql)){

		$check .= $row['word'];
		// Build your formatted results here.
		$words .= "<tr><td style='border-bottom:1px dashed #999999;'>{$row['word']}</td><td width='50%' style='border-bottom:1px dashed #999999;border-left:1px dashed #999999;'><div style='float:right'><a href='index.php?func=glossary&amp;do=edit&amp;id={$row['id']}' title='Edit Word: {$row['word']}'><img src='../images/edit.gif' alt='Edit' /></a>&nbsp;&nbsp;&nbsp;<a href='index.php?func=glossary&amp;do=delete&amp;id={$row['id']}' title='Delete Word {$row['word']}'><img src='../images/delete.png' alt='Delete' /></a></div>{$row['definition']}</td></tr>";	}
	if (empty($check))
	{
		$words = "<tr><td colspan='2'><em>No words to show</em></td></tr>";
	}

	// Figure out the total number of results in DB:
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM glossary"),0);

	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results);

	// Build Page Number Hyperlinks
	$pag = "<p style='text-align: center'>Pages<br />";

	// Build Previous Link
	if($page > 1){
		$prev = ($page - 1);
		$pag .= "<a href=\"index.php?func=glossary&amp;page=$prev\" title='Previous Page'><<</a> ";
	}

	for($i = 1; $i <= $total_pages; $i++){
		if(($page) == $i){
			$pag .= "<strong>$i</strong> ";
		} else {
			$pag .= "<a href=\"index.php?func=glossary&amp;page=$i\" title='Go to page {$i}'>$i</a> ";
		}
	}

	// Build Next Link
	if($page < $total_pages){
		$next = ($page + 1);
		$pag .= "<a href=\"index.php?func=glossary&amp;page=$next\" title='Next Page'>>></a>";
	}
	$pag .= "</p>";
?>
<table width='100%' style='border:1px solid #999999; border-collapse: collapse' cellspacing='3' cellpadding='7'>
<tr align="left">
<th style="border: 1px dashed #999999">Word</th>
<th style="border:1px dashed #999999">Definition</th>
</tr>
<? echo $words; ?>
</table>
<? echo $pag ?>

<p><a onclick="switchMenu('nextstep');" style='cursor:pointer;cursor:hand' title="Switch!">Add Word</a>
</p>

<div id="nextstep" style="display: none;">
<form action="" method="post">
<table cellspacing="3" cellpadding="4">
<tr><td><strong>Word: </strong></td><td>
<input type="text" name="word" /></td></tr>
<tr><td><strong>Definition: </strong></td><td>
<input type="text" name="definition" /></td></tr>

<tr><td>
<input type='submit' name='addword' value='Add Word' />
</td><td></td></tr>
</table>
</form>

</div>
<br />
<?
}
?>
