<?php
require("includes/global.php");
$indietitle = "Recent Changes";
include("includes/page_header.php");

// open up recordset of updated pages
$sql = "SELECT * FROM " . $dbprefix . "pages ORDER BY postdate DESC LIMIT 0, 25";
$rec = $db->execute($sql);
if ($rec->rows < 1){
	$t->set_var("CHANGES", "<li>No recently changed pages</li>");
} else {
	$t->set_file("rec_changes", "element_changes.tpl");
	do {
		$t->set_var("LINK_PAGE", $rec->fields["title"]);
		$t->set_var("LINK_DATE", date($config["dateformat"], $rec->fields["postdate"]));
		$t->parse("CHANGES", "rec_changes", true);
	} while ($rec->fields = mysql_fetch_array($rec->res));
}

// ok, draw this funky page up
$t->set_file("page_content", "page_recent.tpl");
$t->parse("page_all", "page_content", true);

// finish off the page
include("includes/page_footer.php");
?>