<?php
$connect = @mysql_connect('localhost', 'root', 'pass');
if (!$connect) {
	die('<p class="error">Unable to connect to the database server at this time.</p>');
}

// Select the jokes database
if (!@mysql_select_db(tst)) {
	die('<p class="error">Unable to locate the database at this time.</p>');
}
?>