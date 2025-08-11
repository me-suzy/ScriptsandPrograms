<h2 style=' border-bottom:1px dashed #999999;'>Links</h2>
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
		die ("<p class='error'>No Link Selected</p>");
	}

	$result = @mysql_query("SELECT id FROM links where id='$id'");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such link! <a href='index.php?func=links' title='Go Back'>Return</a></p>");
		}
		unset ($row);

		$sql = "DELETE FROM links WHERE id='$id'";

		if (@mysql_query($sql)) {
		@header("Location: index.php?func=links");
		}

		else
		{
			die ("<p class='error'>".mysql_error()."</p>");

		}
}

function edit()
{
	$id = htmlspecialchars(intval(@$_GET['id']));
	if (empty($id))
	{
		die ("<p class='error'>No Link Selected <a href='index.php?func=links' title='Go Back'>Return</a></p>");
	}
	if (isset($_POST['submit']))
	{
		$name = htmlspecialchars($_POST['name']);
		if (empty($name))
		{
			die ("<p class='error'>The name field was empty!</p>");
		}
		$url = htmlspecialchars($_POST['url']);
		if (empty($url))
		{
			die ("<p class='error'>The URL field was empty!</p>");
		}
		$sql = "UPDATE links set name='$name',url='$url' WHERE id='$id'";

		if (@mysql_query($sql)) {
						
			@header("Location: index.php?func=links");
			
		}
		else
		{
			die ("<p class='error'>".mysql_error()."</p>");

		}
	}
	else
	{
		$result = @mysql_query("SELECT * FROM links where id='$id'");
		if (!$result) {
			die('<p class="error">Error performing query: ' .
			mysql_error() . '</p>');
		}

		$row = mysql_fetch_array($result);
		if (empty($row))
		{
			die("<p class='error'>No such link! <a href='index.php?func=links' title='Go Back'>Return</a></p>");
		}

 	?>
 	<table style="border:1px solid #999999;" cellspacing="3" cellpadding="5" width="50%">
 	<form action="" method="post">
 	
 	<tr><td valign="middle" width="5%"><strong>Name:</strong></td><td  valign="middle"><input type="text" name="name" value="<? echo $row['name'] ?>" /></td></tr>
 	<tr><td with="5%"><strong>URL:</strong></td><td><input type="text" name="url" value="<? echo $row['url'] ?>" /></td></tr>
 	<tr><td colspan="2"><input type="submit" name="submit" value="Edit" /></td></tr>
 	
 	</form></table><br />
 	
 	<?

	}


}

function home()
{

	if (isset($_POST['addlink']))
	{
		$name = htmlspecialchars($_POST['name']);
		if (empty($name))
		{
			die ("<p class='error'>You didn't enter a name!</p>");
		}
		$url = htmlspecialchars($_POST['url']);

		if (empty($url))
		{
			die ("<p class='error'>You didn't enter a URL!</p>");
		}


		$sql = "INSERT into links (name,url) VALUES ('$name','$url')";

		if (@mysql_query($sql)) {
			echo ("<p class='fab'>Link Added!</p>");
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

	$sql = mysql_query("SELECT * FROM links LIMIT $from, $max_results");


	$links = "";
	while($row = mysql_fetch_array($sql)){

		// Build your formatted results here.
		$links .= "<tr><td style='border:1px dashed #999999;'><div style='float: right;'><a href='index.php?func=links&amp;do=edit&amp;id={$row['id']}' title='Edit Link: {$row['name']}'><img src='../images/edit.gif' alt='Edit' /></a>&nbsp;&nbsp;&nbsp;<a href='index.php?func=links&amp;do=delete&amp;id={$row['id']}' title='Delete Link {$row['name']}'><img src='../images/delete.png' alt='Delete' /></a></div>{$row['name']}<br /><span style='font-size: 12px;color: grey'>{$row['url']}</td></tr>";
	}


	// Figure out the total number of results in DB:
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM links"),0);

	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results);

	// Build Page Number Hyperlinks
	$pag = "<p style='text-align: center'>Pages<br />";

	// Build Previous Link
	if($page > 1){
		$prev = ($page - 1);
		$pag .= "<a href=\"index.php?func=links&amp;page=$prev\" title='Previous Page'><<</a> ";
	}

	for($i = 1; $i <= $total_pages; $i++){
		if(($page) == $i){
			$pag .=  "<strong>$i</strong> ";
		} else {
			$pag .=  "<a href=\"index.php?func=links&amp;page=$i\" title='Go to page {$i}'>$i</a> ";
		}
	}

	// Build Next Link
	if($page < $total_pages){
		$next = ($page + 1);
		$pag .=  "<a href=\"index.php?func=links&amp;page=$next\" title='Next Page'>>></a>";
	}
	$pag .=  "</p>";
?>
<table width='100%' style='border:1px solid #999999; border-collapse: collapse' cellspacing='3' cellpadding='7'>
<? echo $links; ?>
</table>
<? echo $pag; ?>
<p>
<a onclick="switchMenu('nextstep');" style='cursor:pointer;cursor:hand' title="Switch!">Add Link</a>

</p>

<div id="nextstep" style="display: none;">
<form action="" method="post">
<table cellspacing="3" cellpadding="4">
<tr><td><strong>Name: </strong></td><td>
<input type="text" name="name" /></td></tr>
<tr><td><strong>URL: </strong></td><td>
<input type="text" name="url" /></td></tr>

<tr><td>
<input type='submit' name='addlink' value='Add Link' />
</td><td></td></tr>
</table>
</form>

</div>
<br />
<?
}
?>