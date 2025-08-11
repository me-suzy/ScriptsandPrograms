<?php
function deletepage($page){
	global $db, $dbprefix;
	
	if ($page == ""){ return "No page name entered"; }
	
	// check the page exists
	$sql = "SELECT * FROM " . $dbprefix . "pages WHERE title = '" . dbSecure($page) . "'";
	$rec = $db->execute($sql);
	if ($rec->rows < 1){ return "Unable to locate the page"; }
	
	// and it isn't locked
	if ($rec->fields["locked"] == 1){ return "The page cannot be deleted while it is locked"; }
	
	// first, delete the history
	$sql = "DELETE FROM " . $dbprefix . "history WHERE pageid = " . $rec->fields["ID"];
	$db->execute($sql);
	
	// and delete the page
	$sql = "DELETE FROM " . $dbprefix . "pages WHERE ID = " . $rec->fields["ID"];
	$db->execute($sql);
	
	// and return
	return "Page removed successfully!";
}
?>