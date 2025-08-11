<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

@ignore_user_abort(true);
@Error_Reporting(E_ALL & ~E_NOTICE);

$CFG['CDIR'] = "./common";
require($CFG['CDIR']."/error.php");
require($CFG['CDIR']."/init.php");

// Initialization
InitVars();
if($ERR['flag']) {
  err('fclick.php||initialization was failed');
  log_out();
  err_scr_out();
  exit;
 }

if(isset($HTTP_GET_VARS["id"])) $lid = $HTTP_GET_VARS["id"];
else $lid = $_SERVER[QUERY_STRING];
if(!$lid) die('Unknow link ID');

// Get Link 
$sth = $DB->query("SELECT * FROM ".$PREFIX."links WHERE Link = '".$lid."'");
if(!$sth) {
  err('fclick.php||get link from database was failed -- '.$DB->error());
  log_out();
  err_scr_out();
  exit;
 }
if(!$sth->rows()) die('Unknow link ID: '.$lid);
$link = $sth->fetchrow_array();

$ip = ip2long($HTTP_SERVER_VARS['REMOTE_ADDR']);

// Get Visitor
$sth = $DB->query("SELECT * FROM ".$PREFIX."visitors WHERE IP = ".ip2long($ip));
if(!$sth) die('Database Error (get visitor): '.$DB->error());
if(!$sth->rows()) {
  $visitor['IP'] = $ip;

  if(!$DB->insert($PREFIX."visitors", $visitor))
    die('Database Error (add visitor): '.$DB->error());

  $sth = $DB->query("SELECT LAST_INSERT_ID() FROM ".$PREFIX."visitors");
  if(!$sth) die('Database Error (get vis id): '.$DB->error());
  $uvis = 1;
 }

$visid = $sth->fetchrow_one();

$click['LID'] = $link[0];
$click['CID'] = $link[2];
$click['VID'] = $visid;
$click['l_date'] = $CFG['CTIME'];

if(!$DB->insert($PREFIX."stats", $click))
  die('Database Error (add to stat): '.$DB->error());

// Update Link Count
$sth = $DB->query("UPDATE ".$PREFIX."links SET Count=Count+1 WHERE LID = ".$link[0]);
if(!$sth) die('Database Error (update link count): '.$DB->error());

Header("Location: ".$link[4]);

?>