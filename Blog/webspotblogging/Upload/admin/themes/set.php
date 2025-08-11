<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$path = "../../";
$admincheck = 1;
$page = "Themes";
include("../../inc/global.php");
include("../../inc/checks.php");
$database->query("UPDATE theme SET using_now = 0 WHERE using_now = 1");
$database->query("UPDATE theme SET using_now = 1 WHERE tid = '".$_POST['using_now2']."'");
header("Location: ".$_SERVER['HTTP_REFERER']);
?>