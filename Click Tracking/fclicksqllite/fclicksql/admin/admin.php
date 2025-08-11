<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

chdir('..');

$CFG['CDIR'] = "./common";
require($CFG['CDIR']."/error.php");
require($CFG['CDIR']."/init.php");

// Initialization
InitVars();
if($ERR['flag']) {
  err('admin.php||initialization was failed');
  log_out();
  err_scr_out();
  exit;
 }

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
if(!isset($_SESSION["log"])) $_SESSION["log"] = 0;

if(!$_SESSION["log"]) { 
  admin_page('login'); 
  if($ERR['flag']) {
    err('admin.php||print login page was failed');
    log_out();
    err_scr_out();
    exit;
   }
 }

if(isset($IN["do"])) $do = $IN["do"];
else {
  $do = 'page';
  if(isset($IN["page"])) $page = $IN["page"];
  else $page = "home";
 }

switch($do) {
  case "page": 
    admin_page($page);
    break;
  default:
    if($do == 'logout') { 
      session_unset();
      session_destroy();
      header('Location: admin.php');
      break;
     }
 }

if($ERR['flag']) {
  err('admin.php||error');
  log_out();
  err_scr_out();
 }

?>