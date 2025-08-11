<?php
function links($text) {

	$result = @mysql_query('SELECT word FROM glossary');
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');
	}

	$text_array = array();
	while ($row = mysql_fetch_array($result)) {
		$text_array[] = $row['word'];
	}

	$result2 = @mysql_query('SELECT definition FROM glossary');
	if (!$result2) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');
	}
	$links_array = array();
	while ($row2 = mysql_fetch_array($result2)) {
		$links_array[] = $row2['definition'];
	}

	$search = array();
	$replace = array();

	foreach($text_array as $k => $v) {
		$vupper = strtoupper($v);
		$vlower = strtolower($v);
		$search[$k] = "[$v|$vupper|$vlower]";

		$replace[$k] = "$1<a href=\"#\" title='Hover mouse here for definition' style=\"font-weight: bold;
color: darkgreen;
cursor:help;\" onmouseover=\"this.T_BGCOLOR='#ded';this.T_FONTFACE='verdana';this.T_BORDERCOLOR='#565'; this.T_FONTCOLOR='#565';this.T_PADDING=5;this.T_FONTSIZE='12px'; this.T_FONTWEIGHT='bold'; return escape('".ucfirst($links_array[$k])."')\">$v$3</a>$4";
	}


	$text = preg_replace($search, $replace, $text);

	return trim($text);
}

$id = htmlspecialchars (@$_GET['id']);
if (empty($id))
{
	die("<p class='error'>No Article Selected</p>");
}
if (isset($_POST['submit']))
{

	$comment = $_POST['comment'];
	if (empty($comment))
	{
		die("<p class='error'>You didn't enter a comment!</p>");
	}
	$author = stripslashes($_POST['author']);
	$author = htmlspecialchars($_POST['author'],ENT_QUOTES);
	if (empty($author))
	{
		die("<p class='error'>You didn't enter your name!</p>");
	}

	$today = date("F j, Y");
	$sql = "INSERT into comments (author,comment,dateposted,articleid) VALUES ('$author','$comment',CURDATE(),'$id')";
	$sql2 = "UPDATE	cats SET numcomments=numcomments+1 where id='{$_POST['catid']}'";
	$sql3 = "UPDATE	articles SET numcomments=numcomments+1 where id='$id'";
	if (@mysql_query($sql) && @mysql_query($sql2) && @mysql_query($sql3)) {


		echo "<p class='fab'>Comment Added!</p>";
	}

	else
	{
		die ("<p class='error'>".mysql_error()."</p>");

	}
}



$result = @mysql_query("SELECT * FROM articles where id='$id'");
if (!$result) {
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}

$row = mysql_fetch_array($result);
if (empty($row))
{
	die("<p class='error'>No Such Article</p>");
}
$tut_rating = round($row['rating']);

if ($tut_rating == 1)
{
	$articlerating = "<img src='images/rating_1.gif' alt='Rated 1'/>";
}
elseif ($tut_rating == 2)
{
	$articlerating = "<img src='images/rating_2.gif' alt='Rated 2' />";
}
elseif ($tut_rating == 3)
{
	$articlerating = "<img src='images/rating_3.gif' alt='Rated 3' />";
}
elseif ($tut_rating == 4)
{
	$articlerating = "<img src='images/rating_4.gif' alt='Rated 4' />";
}
elseif ($tut_rating == 5)
{
	$articlerating = "<img src='images/rating_5.gif' alt='Rated 5' />";
}
elseif ($tut_rating != 1 OR 2 OR 3 OR 4)
{
	$articlerating = "No Rating";
}

if (isset($_POST['rating2']))
{
	$tut_id = $id;
	$rating = $_POST['rating'];
	if (isset($_SESSION['rated '.$tut_id.'']))
	{
		echo ("<p class='error'>You have already rated this article</p>");
	} else {
		$get_count = mysql_query("SELECT rating, numvotes FROM articles WHERE id=$tut_id");
		while(list($tut_rating, $tut_num_votes)=mysql_fetch_array($get_count)){
			$new_count = ($tut_num_votes + 1);
			$tut_rating2 = ($tut_rating * $tut_num_votes);
			$new_rating = (($rating + $tut_rating2) / ($new_count));
			$new_rating2 = number_format($new_rating, 2, '.', '');
			$update_rating = mysql_query("UPDATE articles SET rating='$new_rating2',numvotes='$new_count' WHERE id=$tut_id");

			$_SESSION['rated '.$tut_id.''] = TRUE;

			@header("Location:index.php?func=article&id={$tut_id}");
			

		}

	}

}

$row['article'] = links($row['article']);
$article = "<div style='float: right'>{$articlerating}</div><h2>{$row['name']} <a href='#' onclick='javascript:window.print();' title='Print this article'> <img src='images/print.gif' alt='Print' /></a></h2>
<p><a href='index.php?func=cat&amp;id={$row['catid']}' title='Back to catagory'>Back to catagory</a></p>
{$row['article']}";

mysql_query("UPDATE articles set views=views+1 WHERE id='$id'");


$result = @mysql_query("SELECT * FROM comments where articleid='$id'");
if (!$result) {
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}
$comments = '';
$names = '';
if (!mysql_num_rows($result))
{
	$comments = "<tr><td colspan='2'><em>There are currently no comments to show</em></td></tr>";
}
while ($comment = mysql_fetch_array($result))
{
	$comments .= "<tr><td style='padding: 3px; padding-top: 10px;'><img src='images/comment.gif' alt='Comment' />&nbsp;&nbsp;<span style='font-weight: bold;color: darkgreen'>{$comment['author']}</span> posted this on {$comment['dateposted']}</td></tr><tr><td style='border-bottom:1px dotted #999999; padding: 1px;'>
<blockquote>{$comment['comment']}</blockquote></td></tr>";

}

echo $article; 

?> 
  
<h2> Comments</h2>

<table summary="Comments for this article. Scroll down to post a comment" width="100%" style="border:1px solid #999999; padding: 5px;padding-bottom: 10px">
<? echo $comments; ?>
</table>

<h2>Post A Comment Or Rating</h2>

<div style="float:right; border-bottom:1px dotted #999999;">

<form name="rating" method="post" action="index.php?func=article&id=<? echo $id ?>">
    
    <select name="rating">
    <option value="5.0">5</option>
    <option value="4.0">4</option>
    <option value="3.0">3</option>
    <option value="2.0">2</option>
    <option value="1.0">1</option>
    <option value="0.0">0</option></select>
    <input type="hidden" name="cmd" value="do_rating" />
    <input type="hidden" name="tut_id" value="<? echo $id ?>" />
    <input type="submit" name="rating2" value="Add Rating" />
    </form>
    </div>
    
<form action="" method="post">

<textarea name="comment" rows="10" cols="30"></textarea>
<br />
<input type="text" name="author" value="Your Name" />
<input type="hidden" name="catid" value="<? echo $row['catid'] ?>" />
<input type="submit" name="submit" value="Add Comment" />
</form>