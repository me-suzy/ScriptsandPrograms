<?
$sql = mysql_query("SELECT id from articles");
$numarticles = mysql_num_rows($sql);

$sql = mysql_query("SELECT id from cats");
$numcats = mysql_num_rows($sql);

$result = @mysql_query("SELECT value FROM templates WHERE name='intro_text'");
if (!$result) {
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}

$row = mysql_fetch_array($result);
$intro = $row['value'];
?>

<h3>Welcome to the article system!</h3>
<? echo $intro; ?>
<p>We Have a total of <em><? echo $numarticles; ?></em> articles in <em><? echo $numcats; ?></em> catagories</p>


