<?php
// providing all the functionality for an admin page
// just includes straight into the admin page, not a class
// simply regular functions for the admin panel

function UpdateConfig(){
	global $db, $dbprefix, $usr;
	
	// validate the user has access
	$usr->Auth(2);
	
	// lets update this funky config
	$sql = "SELECT * FROM " . $dbprefix . "config WHERE config_info <> ''";
	$opt = $db->execute($sql);
	if ($opt->rows < 1){ die("Holy crap! Your config appears to be empty!"); }
	
	// loop through each one, check for update
	do {
		$thisvar = $_POST[$opt->fields["config_name"]];
		if ($thisvar <> "" && $thisvar <> $opt->fields["config_value"]){
			$sql = "UPDATE " . $dbprefix . "config SET config_value = '" . dbSecure($thisvar) . "' WHERE config_name = '" . dbSecure($opt->fields["config_name"]) . "'";
			$db->execute($sql);
		}
	} while ($opt->fields = mysql_fetch_array($opt->res));
	
	// and return successful
	return "Config updated successfully!";
}
?>