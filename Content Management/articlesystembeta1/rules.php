<?php

$result = @mysql_query("SELECT name,value FROM templates WHERE name='comment_rules' OR name='usage_rules'");
if (!$result) {
	die('<p class="error">Error performing query: ' .
	mysql_error() . '</p>');
}

while ($row = mysql_fetch_array($result))
{
	$rule[$row['name']] = $row['value'];
}

?>
<h2>Commenting Rules</h2>
<blockquote>
<? echo $rule['comment_rules']; ?>
</blockquote>
<h2>Usage Rules</h2>
<blockquote>
<? echo $rule['usage_rules']; ?>
</blockquote>