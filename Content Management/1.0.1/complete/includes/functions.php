<?php
// include other files
include("functions_admin.php");
include("functions_encode.php");
include("functions_moderate.php");

function dbSecure($code){
	// check for needing encoding
	if (!get_magic_quotes_gpc()){
		$code = addslashes($code);
	}
	
	// return the value
	return $code;
}

// start session, can be called after sign out
function StartSession(){
	// process session ID if required
	session_start();
}

// create a key for the email confirmation
function GenerateKey(){
	$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	srand((double)microtime()*1000000);  
    $i = 0;
    while ($i < 25) {  // change for other length
        $num = rand() % 33;
        $tmp = substr($salt, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    
    return $pass;
}

function SkinList($defaultvalue){
	
	// globalise variables
	global $config;
	
	// Open a known directory, and proceed to read its contents
	$codelist = "<select id=c_defaultskin name=c_defaultskin>\n";
	$tdir = $config["root"] . "skins/";
	$tdir = "skins/";
	if (is_dir($tdir)) {
		if ($dh = opendir($tdir)) {
			while (($file = readdir($dh)) !== false) {
				if ($file <> "." && $file <> ".." && filetype($tdir . $file) == "dir"){
					//echo "filename: $file : filetype: " . filetype($tdir . $file) . "<br />";
					$extracode = ($file == $config["defaultskin"]) ? " selected" : "";
					$codelist .= "		<option value=\"" . $file . "\"" . $extracode . ">" . $file . "</option>\n";
				}
			}
			closedir($dh);
		}
	}
	
	// finish the list
	$codelist .= "	</selected>";
	
	// return the list
	return $codelist;
}

// ok so if a user edits a page and wants to save
function SavePage($code, $ptitle, $reason = "", $pageid = 0){
	global $config, $dbprefix, $db, $usr;
	
	// if user is anonymous then check for allowed
	if ($config["anonedit"] == "0" && $usr->Access < 2){
		return "You do not have permission to edit this page";
	}
	
	// validate the data exists
	if ($code == ""){ return "You did not enter any content"; }
	if ($pageid == ""){ $pageid = 0; }
	
	// create some variables
	$ctime = time();
	
	// recordset to make sure page exists
	$sql = "SELECT * FROM " . $dbprefix . "pages WHERE ID = " . dbSecure($pageid);
	$page = $db->execute($sql);
	if ($page->rows < 1){
		// page does not exist, needs creating
		$sql = "INSERT INTO " . $dbprefix . "pages (postdate, title) VALUES (" . $ctime . ", '" . dbSecure($ptitle) . "')";
		$db->execute($sql);
		$updateid = mysql_insert_id();
	} else {
		// make sure mage isn't locked
		if ($page->fields["locked"] == 1 && $usr->Access < 2){
			return "This page has been locked and cannot be edited";
		}
		
		// set the ID of the page
		$updateid = $page->fields["ID"];
	}
	
	// ok so let's first create a history page
	$sql = "INSERT INTO " . $dbprefix . "history (pageid, postdate, author, body, reason) VALUES (";
	$sql .= $updateid . ", " . $ctime . ", '" . $_SERVER["REMOTE_ADDR"] . "', '";
	$sql .= dbSecure($code) . "', '" . dbSecure($reason) . "')";
	$db->execute($sql);
	
	// now let's update the pages table
	$sql = "UPDATE " . $dbprefix . "pages SET body = '" . dbSecure($code) . "', ";
	$sql .= "postdate = " . $ctime . " WHERE ID = " . $updateid;
	$db->execute($sql);
	
	// and let the user know
	return "Page saved and updated successfully! <a href=\"" . $config["wikipage"] . "?page=" . $ptitle . "\">View it...</a>";
}

// allow users to revent to an older version
function RevertPage($pageid, $revertid){
	global $config, $dbprefix, $db, $usr;
	
	// validate information has been entered
	if ($pageid == ""){ return "No page ID supplied"; }
	if ($revertid == ""){ return "No ID of the archived page supplied"; }
	
	// check that the page ID exists
	$sql = "SELECT * FROM " . $dbprefix . "pages WHERE ID = " . dbSecure($pageid);
	$page = $db->execute($sql);
	if ($page->rows < 1){ return "Unable to locate the page"; }
	
	// check the archived page also exists
	$sql = "SELECT * FROM " . $dbprefix . "history WHERE pageid = " . dbSecure($pageid) . " AND ID = " . dbSecure($revertid);
	$old = $db->execute($sql);
	if ($old->rows < 1){ return "Unable to locate the archived copy"; }
	
	// ok, it looks ok, revert the page
	$errormsg = SavePage($old->fields["body"], $page->fields["title"], "Reverting to copy " . $old->fields["ID"], $page->fields["ID"]);
	return $errormsg;
}

// allow admins to lock and unlock pages
function LockPage($paget){
	global $db, $dbprefix, $usr, $config;
	
	// first check the user
	$usr->Auth(2);
	
	// check the page exists
	$sql = "SELECT * FROM " . $dbprefix . "pages WHERE title = '" . dbSecure($paget) . "'";
	$page = $db->execute($sql);
	if ($page->rows < 1){ die("Unable to locate the page"); }
	
	// work out the new state
	$newstate = ($page->fields["locked"] == 1) ? 0 : 1;
	
	// ok, carry out the lock or unlock
	$sql = "UPDATE " . $dbprefix . "pages SET locked = " . $newstate . " WHERE ID = " . $page->fields["ID"];
	$db->execute($sql);
	
	// and return the user
	Header("Location: " . $config["wikipage"] . "?page=" . $page->fields["title"]);
}
?>