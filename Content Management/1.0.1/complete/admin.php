<?php
require("includes/global.php");
include("includes/adminfuncs.php");

// set up some variables
$indietitle = "Admin";

// include page_header
include("includes/page_header.php");

// is the user signed in or not?
if ($_SESSION["userid"] <> ""){
	$t->set_var("SIGN_TEXT", "Sign out");
	$t->set_var("SIGN_LINK", "signout");
	
	$t->set_var("MENU_DELETEPAGE", '<a href="admin.php?page=deletepage">Delete Page</a>');
} else {
	$t->set_var("SIGN_TEXT", "Sign in");
	$t->set_var("SIGN_LINK", "signin");
}

// work out what page this is
$pagesect = $_GET["page"];
if ($pagesect == "signin"){
	if ($_POST["username"] <> ""){
		$errormsg = $usr->signin($_POST["username"], $_POST["password"], $_POST["from"]);
		$t->set_var("RESULT", $errormsg . "<br /><br />\n\n");
	}
	
	// set up recurring form variables
	$t->set_var("DE_USERNAME", $_POST["username"]);
	$t->set_var("DE_PASSWORD", $_POST["password"]);
	
	// calculate the from variable
	if ($_GET["from"] <> ""){
		$t->set_var("DE_FROM", $_GET["from"]);
	} else {
		$t->set_var("DE_FROM", $_POST["from"]);
	}
	
	// set up the page if not a sign in attempt
	$t->set_file("adminpage", "admin_signin.tpl");
	$t->parse("CONTENT", "adminpage");
} elseif ($pagesect == "signout"){
	$usr->signout();
	$t->set_file("adminpage", "admin_signout.tpl");
	$t->parse("CONTENT", "adminpage");
} elseif ($pagesect == "myaccount"){
	// authorise the user
	$usr->Auth(1);
	
	// is the user trying to do something?
	if ($_POST["do"] == "password"){
		$errormsg = $usr->ChangePass($_POST["pass1"], $_POST["pass2"], $_POST["pass3"]);
		$t->set_var("RESULT", $errormsg . "<br /><br />");
	} elseif ($_POST["do"] == "information"){
		$errormsg = $usr->Information($_POST["email"]);
		$t->set_var("RESULT", $errormsg . "<br /><br />");
	}
	
	// bring up users profile
	$sql = "SELECT * FROM " . $dbprefix . "users WHERE ID = " . dbSecure($_SESSION["userid"]);
	$user = $db->execute($sql);
	if ($user->rows < 1){ die("Unable to locate user profile"); }
	$t->set_var("ADMIN_USER_EMAIL", $user->fields["email"]);
	
	$t->set_file("adminpage", "admin_myaccount.tpl");
	$t->parse("CONTENT", "adminpage");
} elseif ($pagesect == "deletepage"){
	// authorise the user
	$usr->Auth(2);
	
	// check for action
	if ($_POST["do"] == "deletepage"){
		$errormsg = deletepage($_POST["page"]);
	}
	
	// parse error message
	if ($errormsg <> ""){
		$t->set_var("RESULT", $errormsg . "<br /><br />");
	}
	
	// parse page
	$t->set_file("adminpage", "admin_deletepage.tpl");
	$t->parse("CONTENT", "adminpage");
} else {
	$usr->Auth(2);
	
	// is the user updating the site config?
	if ($_POST["do"] == "config"){
		$errormsg = UpdateConfig();
		$t->set_var("RESULT", $errormsg . "<br /><br />\n\n");
	} else {
		$t->set_var("RESULT", "<strong>Version information:</strong> " . versioninfo() . "<br /><br />\n\n");
	}
	
	// get recordset of all the config stuff
	$sql = "SELECT * FROM " . $dbprefix . "config WHERE config_info <> ''";
	$opt = $db->execute($sql);
	if ($opt->rows < 1){ die("Holy crap! Your config appears to be empty!"); } else {
		$t->set_file("siteconfig", "element_config.tpl");
		do {
			$t->set_var("CONFIG_NAME", $opt->fields["config_name"]);
			$t->set_var("CONFIG_INFO", $opt->fields["config_info"]);
			$t->set_var("CONFIG_VALUE", htmlspecialchars($opt->fields["config_value"]));
			$t->parse("CONFIG_ELEMENTS", "siteconfig", true);
		} while ($opt->fields = mysql_fetch_array($opt->res));
	}
	
	$t->set_file("adminpage", "admin_main.tpl");
	$t->parse("CONTENT", "adminpage");
}

// ok, display the current page
$t->set_file("page_content", "page_admin.tpl");
$t->parse("page_all", "page_content", true);

// finish off the page
include("includes/page_footer.php");
?>