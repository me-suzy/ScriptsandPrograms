<?php

$id = htmlspecialchars(intval(@$_GET['id']));
if (empty($id))
{
	die ("<p class='error'>No ID Entered</p>");
}
$result = @mysql_query("SELECT name,description FROM cats where id='$id'");

if (!$result)
{
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}

$row = mysql_fetch_array($result);

if (empty($row))
{
	die ("<p class='error'>No Such Catagory</p>");
}

echo "<h2>{$row['name']}</h2>";
echo "<p style='color: #696969'>{$row['description']}</p>";

if(!isset($_GET['page'])){
	$page = 1;
} else {
	$page = htmlspecialchars((int)$_GET['page']);
}

$max_results = 10;

$from = (($page * $max_results) - $max_results);

$sql = mysql_query("SELECT a.id,a.name,a.views,COUNT(c.id) as comments FROM articles a LEFT JOIN comments c ON (a.id=c.articleid) WHERE a.catid='$id' GROUP BY id LIMIT $from, $max_results");

$cat = '';
if (!mysql_num_rows($sql))
{
	$cat = "<tr><td colspan='4'><em>No articles to show</em></td></tr>";
}
while ($row = mysql_fetch_array($sql))
{
	$cat .= "<tr><td><a href='index.php?func=article&amp;id={$row['id']}' title='View Article: {$row['name']}'>{$row['name']}</a></td><td>{$row['views']}</td><td>{$row['comments']}</td></tr>";
}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM articles where catid='$id'"),0);

$total_pages = ceil($total_results / $max_results);

$pag = "<p style='text-align: center'>Pages<br />";

if($page > 1){
	$prev = ($page - 1);
	$pag .= "<a href='index.php?func=cat&amp;id={$id}&amp;page={$prev}' title='Previous Page'>&lt;&lt;</a> ";
}

for($i = 1; $i <= $total_pages; $i++){
	if(($page) == $i){
		$pag .= "<strong>$i</strong> ";
	} else {
		$pag .= "<a href='index.php?func=cat&amp;id={$id}&amp;page={$i}' title='Go to page: {$i}'>{$i}</a> ";
	}
}

if($page < $total_pages){
	$next = ($page + 1);
	$pag .= "<a href='index.php?func=cat&amp;id={$id}&amp;page={$next}' title='Next Page'>&gt;&gt;</a>";
}
$pag .= '</p>';

?>
<table width="100%" summary="The article listing for this catagory">
<tr><th align="left">Article Info</th><th align="left">Views</th><th align="left">Comments</th></tr>
<? echo $cat; ?>
</table>
<? echo $pag; ?>