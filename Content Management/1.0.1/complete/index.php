<?php
require("includes/global.php");

// work out what page this is
if ($_GET["page"]){
	$query = $_GET["page"];
	$state = 1;
} elseif ($_GET["links"]){
	$query = $_GET["links"];
	$state = 2;
} elseif ($_GET["edit"]){
	$query = $_GET["edit"];
	$state = 3;
} elseif ($_GET["history"]){
	$query = $_GET["history"];
	$state = 4;
} elseif ($_GET["lock"]){
	$query = $_GET["lock"];
	LockPage($query);
} else {
	$query = $config["defaultpage"];
	$homepagecheck = 1;
}

// setup the page title and authorise user
$indietitle = $query;
$usr->Auth(0);

// insert the page header
include("includes/page_header.php");

// work out what page this is
$sql = "SELECT * FROM " . $dbprefix . "pages WHERE title = '" . dbSecure($query) . "'";
$page = $db->execute($sql);

// should the edit link be included?
if ($page->rows < 1 || $usr->Access > 1 || ($page->fields["locked"] == 0 && $config["anonedit"] == "1")){
	$t->set_file("nav_edit", "misc_editpage.tpl");
	$t->parse("NAVLINK_EDIT", "nav_edit");
}

// should the lock link be shown?
if ($page->rows > 0  && $usr->Access > 1){
	$t->set_file("nav_lock", "misc_lockpage.tpl");
	
	// work out the text to be shown
	if ($page->fields["locked"] == 1){
		$t->set_var("MISC_LOCK_TEXT", "Unlock Page");
	} else {
		$t->set_var("MISC_LOCK_TEXT", "Lock Page");
	}
	
	$t->parse("NAVLINK_LOCK", "nav_lock");
}

if ($page->rows < 1 && $state <> 2 && $state <> 3){
	$t->set_file("page_content", "page_wiki.tpl");
	if ($homepagecheck == 1){
		// The default homepage is missing
		$t->set_var("CONTENT", "The default page is missing, please update your configuration");
	} else {
		// The page does not exist yet
		$t->set_var("CONTENT", "This page does not exist yet. <a href=\"" . $wikipage . "?edit=" . $query . "\">Create it</a>!");
	}
} elseif ($state == 2){
	// ok, so what pages link here?
	$t->set_file("page_content", "page_links.tpl");
	
	// record a recordset of the links
	$sql = "SELECT DISTINCT title FROM " . $dbprefix . "pages WHERE body LIKE '%[[" . dbSecure($query) . "]]%' ORDER BY title ASC LIMIT 0, 1000";
	$lip = $db->execute($sql);
	
	// loop though and set all the links
	if ($lip->rows < 1){
		$t->set_var("CONTENT", "<li>No pages link here</li>");
	} else {
		$t->set_file("sublinks", "element_links.tpl");
		do {
			// loop through each of them
			$t->set_var("LINK_PAGE", $lip->fields["title"]);
			$t->parse("CONTENT", "sublinks", true);
		} while ($lip->fields = mysql_fetch_array($lip->res));
	}
} elseif ($state == 3){
	// set the editing file
	$t->set_file("page_content", "page_edit.tpl");
	
	// work out if this is an edit
	if ($_POST["page"] <> ""){
		if ($_POST["do"] == "Preview"){
			// do a preview
			$t->set_var("PREVIEW", Encode(stripslashes($_POST["page"])) . "\n\n<hr />\nThis is just a preview. The page has not yet been saved.<br /><br />");
		} else {
			// save the new content
			$errormsg = SavePage($_POST["page"], $query, $_POST["reason"], $page->fields["ID"]);
			$t->set_var("RESULT", $errormsg . "\n\n<hr />");
		}
	} elseif ($_POST["cur"] <> ""){
		// revert to an older copy
		$errormsg = RevertPage($_POST["pageid"], $_POST["cur"]);
		$t->set_var("RESULT", $errormsg . "\n\n<hr />");
		
		// redraw the SQL for the thing because it's changed
		$sql = "SELECT * FROM " . $dbprefix . "pages WHERE ID = " . dbSecure($_POST["pageid"]);
		$page2 = $db->execute($sql);
		$editcontent = $page2->fields["body"];
	}
	
	// right, display the edit page
	if ($_POST["page"] <> ""){
		$editcontent = htmlspecialchars(stripslashes($_POST["page"]));
	} else {
		$editcontent = htmlspecialchars($page->fields["body"]);
	}
	
	$t->set_var("CONTENT", $editcontent);
	$t->set_var("REASON", $_POST["reason"]);
} elseif ($state == 4){
	// viewing history of the page
	$t->set_file("page_content", "page_history.tpl");
	$t->set_var("PAGE_ID", $page->fields["ID"]);
	
	// can the user edit this page?
	if ($page->fields["locked"] == 1 && $usr->Access < 2){
		$t->set_file("revert", "misc_norevert.tpl");
	} else {
		$t->set_file("revert", "misc_revert.tpl");
	}
	$t->parse("REVERT_BUTTON", "revert");
	
	// recordset of archived versions
	$sql = "SELECT * FROM " . $dbprefix . "history WHERE pageid = " . $page->fields["ID"] . " ORDER BY ID DESC LIMIT 0, 100";
	$old = $db->execute($sql);
	if ($old->rows > 0){
		$t->set_file("oldversions", "element_history.tpl");
		$rowcount = 0;
		do {
			// loop through each one
			$t->set_var("OLD_ID", $old->fields["ID"]);
			$t->set_var("OLD_USER", $old->fields["author"]);
			$t->set_var("OLD_REASON", $old->fields["reason"]);
			$t->set_var("OLD_DATE", date($config["dateformat"], $old->fields["postdate"]));
			
			// should we render it as checked?
			if ($rowcount == 0){
				$t->set_var("OLD_EXTRA", " checked=\"checked\"");
			} else {
				$t->set_var("OLD_EXTRA", "");
			}
			
			// and parse the stuff in
			$t->parse("CONTENT", "oldversions", true);
			$rowcount = ($rowcount + 1);
		} while ($old->fields = mysql_fetch_array($old->res));
	}
} else {
	// ok, display the current page
	$t->set_file("page_content", "page_wiki.tpl");
	
	// current version or achived version?
	if ($_GET["version"] <> ""){
		$sql = "SELECT * FROM " . $dbprefix . "history WHERE pageid = " . $page->fields["ID"] . " AND ID = " . dbSecure($_GET["version"]);
		$ver = $db->execute($sql);
		if ($ver->rows < 1){
			$t->set_var("CONTENT", "This version of the page is not unavailable");
		} else {
			$t->set_var("CONTENT", "Archived version from " . date($config["dateformat"], $ver->fields["postdate"]) . "\n<hr />\n\n" . Encode($ver->fields["body"]));
		}
	} else {
		$t->set_var("CONTENT", Encode($page->fields["body"]));
	}
}

// do some page variable things
$t->set_var("PAGE_TITLE", $query);
$t->set_var("QUERY", $query);

// set up the file and parse
$t->parse("page_all", "page_content", true);

// do the page footer and output
include("includes/page_footer.php");
?>