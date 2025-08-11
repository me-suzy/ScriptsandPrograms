<?php

$result = @mysql_query('SELECT word,definition FROM glossary');
if (!$result) {
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}

$words = '';
while ($row = mysql_fetch_array($result)) {
	$words .= "<tr><td>{$row['word']}</td><td>{$row['definition']}</td></tr>";
}

?>
<h2>Glossary</h2>
<table summary="This table lists all the words in our glossary" style='border:1px solid #999999;' cellpadding="5" cellspacing="0" width="100%">
<tr>
<th align="left" style='border-bottom:1px dotted #999999;'>Word</th><th align="left" style='border-bottom:1px dotted #999999;'>Definition</th>
</tr>
<? echo $words; ?>
</table>
