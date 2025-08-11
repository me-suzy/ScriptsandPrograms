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

$CFG['SDIR'] = $path;
$CFG['CDIR'] = $CFG['SDIR']."./common";
require_once($CFG['CDIR']."/error.php");
require_once($CFG['CDIR']."/init.php");

// Initialization
InitVars();
if($ERR['flag']) {
  err('show.php||initialization was failed');
  log_out();
  err_scr_out();
  exit;
 }

$now_time = $CFG['dtime'];

if(!isset($path)) {
  if(isset($HTTP_GET_VARS["cid"])) $cid = $HTTP_GET_VARS["cid"];
  else if(isset($HTTP_GET_VARS["id"])) $lid = $HTTP_GET_VARS["id"];
  else $lid = $_SERVER[QUERY_STRING];
  if(isset($HTTP_GET_VARS["period"])) $period = $HTTP_GET_VARS["period"];
  else $period = "total";
 }

if(!isset($period) || $period == "total") $period="all";
if(!isset($lid) and !isset($cid)) die('Unknow ID');

if(isset($lid)) {
  if($period == "all") {
    // Get Link Count Total
    $sth = $DB->query("SELECT Count FROM ".$PREFIX."links WHERE Link = '".$lid."'");
    if(!$sth) die('Database Error (get link total): '.$DB->error());
    if(!$sth->rows()) die('Unknow link ID: '.$lid);
    $count = $sth->fetchrow_one();
   }
  else {
    $sth = $DB->query("SELECT Count(*) FROM ".$PREFIX."stats, ".$PREFIX."links 
                      WHERE ".$PREFIX."stats.LID = ".$PREFIX."links.LID AND 
                      Link = '".$lid."' AND l_date >= ".($now_time-86400*$period));
    if(!$sth) die('Database Error (get link): '.$DB->error());
    $count = $sth->fetchrow_one();
   }
 }
else if(isset($cid)) {
  if($cid != 'all') $query = " AND C.Cat = '".$cid."'";
  else $query = "";
  if($period == "all") {
    $sth = $DB->query("SELECT SUM(Count) ".
                      "FROM ".$PREFIX."category C, ".$PREFIX."links L ".
                      "WHERE C.CID = L.CID".$query);

    if(!$sth) die('Database Error (get cat total): '.$DB->error());
    if(!$sth->rows()) die('Unknow category ID: '.$cid);
    $count = $sth->fetchrow_one();
   }
  else {
    $sth = $DB->query("SELECT Count(*) FROM ".$PREFIX."stats S, ".$PREFIX."category C ".
                      "WHERE S.CID = C.CID AND l_date >= ".($now_time-86400*$period).$query);
    if(!$sth) die('Database Error (get cat): '.$DB->error());
    $count = $sth->fetchrow_one();
   }
 }
else die('Unknow ID');

if(isset($HTTP_GET_VARS["js"])) echo "document.write('".$count."');";
else echo $count;
 
?>