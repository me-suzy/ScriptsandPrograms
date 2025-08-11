<?php

switch (@$_GET['do']){

	case 'top10viewed':
	top10viewed();
	break;

	case 'top10commented':
	top10commented();
	break;

	case 'toprated':
	toprated();
	break;

	default:
	home();
	break;
}

function home()
{
	echo ('<p class="error">Incorrect use of file</p>');
}

function top10viewed()
{
	$result = @mysql_query("SELECT id,name,views FROM articles ORDER BY views desc LIMIT 0,10");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');
	}

	$top10 = '';
	$i = 0;
	while ($row = mysql_fetch_array($result)) {
		$i++;
		$top10 .= "<tr><td width='1%'>{$i}</td><td style='border-right: 1px solid #999999'><a href='index.php?func=article&amp;id={$row['id']}' title='View Article: {$row['name']}'>{$row['name']}</a></td><td align='center'>{$row['views']}</td></tr>";
	}
?>
<h2>Top 10 Viewed Articles</h2>
<table summary="Our top 10 viewed articles" cellspacing="3" cellpadding="2" width="100%">
<tr style="border-bottom: 1px solid black"><th  colspan="2">Name</th><th>Views</th></tr>
<? echo $top10; ?>
</table>
<?
}

function top10commented()
{
	$result = @mysql_query("SELECT id,name,numcomments FROM articles ORDER BY numcomments desc LIMIT 0,10");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');
	}

	$top10 = '';
	$i = 0;
	while ($row = mysql_fetch_array($result)) {
		$i++;
		$top10 .= "<tr><td width='1%'>{$i}</td><td style='border-right: 1px solid #999999'><a href='index.php?func=article&amp;id={$row['id']}' title='View Article: {$row['name']}'>{$row['name']}</a></td><td align='center'>{$row['numcomments']}</td></tr>";		
	}
?>
<h2>Top 10 Commented Articles</h2>
<table summary="Our top 10 commented articles" cellspacing="3" cellpadding="2" width="100%">
<tr style="border-bottom: 1px solid black"><th  colspan="2">Name</th><th># Comments</th></tr>
<? echo $top10; ?>
</table>
<?
}

function toprated()
{
	$result = @mysql_query("SELECT id,name,rating FROM articles ORDER BY rating desc LIMIT 0,10");
	if (!$result) {
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');
	}

	$top10 = '';
	$i = 0;
	while ($row = mysql_fetch_array($result)) {
		$i++;
		$top10 .= "<tr><td width='1%'>{$i}</td><td style='border-right: 1px solid #999999'><a href='index.php?func=article&amp;id={$row['id']}' title='View Article: {$row['name']}'>{$row['name']}</a></td><td align='center'>{$row['rating']}</td></tr>";		
	}
?>
<h2>Top 10 Rated Articles</h2>
<table summary="Our top 10 rated articles" cellspacing="3" cellpadding="2" width="100%">
<tr style="border-bottom: 1px solid black"><th  colspan="2">Name</th><th>Rating</th></tr>
<? echo $top10; ?>
</table>
<?
}
?>