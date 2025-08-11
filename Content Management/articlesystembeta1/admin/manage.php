<h2>Manage Articles</h2>
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
		die ("<p class='error'>No Article Selected</p>");
	}

	$result = @mysql_query("SELECT id FROM articles where id='$id'");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such article! <a href='index.php?func=manage' title='Go Back'>Return</a></p>");
		}
		unset ($row);

		$sql = "DELETE FROM articles WHERE id='$id'";

		if (@mysql_query($sql)) {
			echo "<p class='fab'>Article Deleted! <a href='index.php?func=manage' title='Go Back'>Return</a></p>";
		}

}

function edit()
{
	$id = htmlspecialchars(intval(@$_GET['id']));
	if (empty($id))
	{
		die ("<p class='error'>No Article Selected <a href='index.php?func=manage'>Go Back</a></p>");
	}
	if (isset($_POST['submit']))
	{
		$name = htmlspecialchars($_POST['name']);
		if (empty($name))
		{
			die ("<p class='error'>The name field was empty!</p>");
		}
		$article = $_POST['article'];
		if (empty($article))
		{
			die ("<p class='error'>The article field was empty!</p>");
		}
		$sql = "UPDATE articles set name='$name',article='$article' WHERE id='$id'";

		if (@mysql_query($sql)) {
			echo "<p class='fab'>Article Updated! <a href='index.php?func=manage'>Return</a></p>";
		}
	}
	else
	{
		$result = @mysql_query("SELECT * FROM articles where id='$id'");
		if (!$result) {
			die('<p class="error">Error performing query: ' .
			mysql_error() . '</p>');
		}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such article! <a href='index.php?func=manage'>Go Back</a></p>");
		}

 	?>
 	<table style="border:1px solid #999999;" cellspacing="3" cellpadding="5" width="50%">
 	<form action="" method="post">
 	
 	<tr><td valign="middle" width="5%"><strong>Name:</strong></td><td  valign="middle"><input type="text" name="name" value="<? echo $row['name'] ?>" /></td></tr>
 	<tr><td colspan="2"><textarea name="article" rows="15" cols="60"><? echo $row['article'] ?></textarea></td></tr>
 	<tr><td colspan="2"><input type="submit" name="submit" value="Edit" /></td></tr>
 	
 	</form></table><br />
 	
 	<?

	}


}

function home()
{
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

	$sql = mysql_query("SELECT * FROM articles LIMIT $from, $max_results");

	$articles = "";
	while($row = mysql_fetch_array($sql)){


		// Build your formatted results here.
		$articles .= "<tr><td style='border:1px dashed #999999;'><div style='float: right;'><a href='index.php?func=manage&amp;do=edit&amp;id={$row['id']}' title='Edit Article: {$row['name']}'><img src='../images/edit.gif' alt='Edit' /></a>&nbsp;&nbsp;&nbsp;<a href='index.php?func=manage&amp;do=delete&amp;id={$row['id']}' title='Delete Article: {$row['name']}'><img src='../images/delete.png' alt='Delete' /></a></div>{$row['name']}</td></tr>";
	}


	// Figure out the total number of results in DB:
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM articles"),0);

	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results);

	// Build Page Number Hyperlinks
	$pag = "<p style='text-align: center'>Pages<br />";

	// Build Previous Link
	if($page > 1){
		$prev = ($page - 1);
		$pag .= "<a href=\"index.php?func=manage&amp;page=$prev\" title='Previous Page'><<</a> ";
	}

	for($i = 1; $i <= $total_pages; $i++){
		if(($page) == $i){
			$pag .= "<strong>$i</strong> ";
		} else {
			$pag .= "<a href=\"index.php?func=manage&amp;page=$i\" title='Go to page {$i}'>$i</a> ";
		}
	}

	// Build Next Link
	if($page < $total_pages){
		$next = ($page + 1);
		$pag .= "<a href=\"index.php?func=manage&amp;page=$next\" title='Next Page'>>></a>";
	}
	$pag .= "</p>";
?>
<table width='100%' style='border:1px solid #999999; border-collapse: collapse' cellspacing='3' cellpadding='7'>
<? echo $articles; ?>
</table>
<? echo $pag; ?>
<br />

<?
}
?>
