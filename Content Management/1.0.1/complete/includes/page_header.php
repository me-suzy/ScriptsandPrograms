<?php
// set up the template
include("template.php");

// create template from class
$t = new Template("skins/" . $skin . "/");

// set up some variables
$t->set_var("SITE_TITLE", $config["sitename"]);
$t->set_var("INDIE_TITLE", $indietitle);
$t->set_var("WIKIPAGE", $config["wikipage"]);
$t->set_var("VERSION", $config["version"]);

// check for returnable address for admin
if (($_SERVER["REQUEST_URI"]) && $_SESSION["userid"] == ""){
	$t->set_var("PAGE_FROM", $_SERVER["REQUEST_URI"] . "&page=signin");
}

//create the navigation menu
$t->set_file("navmenu", "overall_navigation.tpl");
$t->parse("NAVIGATION", "navmenu");

// parse the page header
$t->set_file("page_header", "overall_header.tpl");
$t->parse("page_all", "page_header", true);
?>