<?php
require("includes/global.php");
$indietitle = "Search";
include("includes/page_header.php");

// open up recordset of updated pages
$st = $_GET["q"];
if ($st <> ""){
	// work out the SQL
	if ($_GET["search"] == "Full Text"){
		$sql = "SELECT * FROM " . $dbprefix . "pages WHERE title LIKE '%" . dbSecure($st) . "%' OR body LIKE '%" . dbSecure($st) . "%' ORDER BY postdate DESC LIMIT 0, 25";
	} else {
		$sql = "SELECT * FROM " . $dbprefix . "pages WHERE title LIKE '%" . dbSecure($st) . "%' ORDER BY postdate DESC LIMIT 0, 25";
	}
	
	// execute the statement
	$rec = $db->execute($sql);
	if ($rec->rows < 1){
		$t->set_var("SEARCH_RESULTS", 'Sorry, no results found.');
	} else {
		$t->set_file("search_rec", "element_search.tpl");
		do {
			$t->set_var("LINK_PAGE", $rec->fields["title"]);
			$t->set_var("LINK_DATE", date($config["dateformat"], $rec->fields["postdate"]));
			$t->set_var("LINK_BODY", substr(strip_tags($rec->fields["body"]), 0, 100) . "...");
			
			$t->parse("SEARCH_RESULTS", "search_rec", true);
		} while ($rec->fields = mysql_fetch_array($rec->res));
	}
} else {
	$t->set_var("SEARCH_RESULTS", "Use title search to find a specific page or full text to find pages containing the text.");
}

// ok, draw this funky page up
$t->set_file("page_content", "page_search.tpl");
$t->set_var("SEARCH_TERM", $st);
$t->parse("page_all", "page_content", true);

// finish off the page
include("includes/page_footer.php");
?>