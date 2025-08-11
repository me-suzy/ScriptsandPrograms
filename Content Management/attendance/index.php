<?php
define("_LIBPATH","./admin/lib/");
define("_MODPATH","./admin/modules/");
require_once _LIBPATH . "site.php";

//for the site to automaticaly load the attendance module
$_GET["mod"] = "attendance";

$site = new CSite("./admin/site.xml",false);
$site->Run();
?>
