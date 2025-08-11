<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

// Show Current Time
function prtime() {
  global $CFG;
?>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
   <TR><TD>
     <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
     <TR><TD bgcolor="#a5bcc0" align=center>
     <div align=right class=liter style="font-size:8pt;LETTER-SPACING:2px;color: #13196D">
<?
echo date($CFG['dmas'][$CFG['DFORMAT']]." ".$CFG['tmas'][$CFG['TFORMAT']]." ", $CFG['CTIME']);
if($CFG['TZONE']) echo "+".$CFG['TZONE'];
else if($CFG['TZONE'] < 0) echo $CFG['TZONE'];
?>      
     GMT</div>
     </TD></TR></TABLE></TD></TR></TABLE><br>
<?
 }

// Parse teplate
function tparse(&$templ, &$vars) {
  global $pagehtml;
  $pagehtml .= preg_replace("/%%([A-Z0-9]+)%%/e","\$vars['\\1']",$templ);
 }

// Read array from file
function read_file($fname,&$fdata) {
  global $ERR;

  if(!file_exists($fname)) {
    err('global.php|read_file|the file '.$fname.' not found');
    return;
   }
  $file=fopen($fname,'r');
  if(!$file) { 
    err('global.php|read_file|can\'t open the file '.$fname);
    return;
   }
  flock($file,LOCK_SH);
  while($str=fgets($file,1000)) $fdata[]=trim($str);
  flock($file,LOCK_UN);
  fclose($file);
}

// Save array to file
function save_file($fname,&$fdata) {
  global $ERR;

  $file=fopen($fname,'w');
  if(!$file) {
    err('global.php|save_file|can\'t create the file '.$fname);
    return;
   }
  flock($file,LOCK_EX);
  $total=sizeof($fdata);
  for($c=0; $c<$total; $c++) {
    if(!fwrite($file,$fdata[$c]."\n")) { 
      err('global.php|save_file|can\'t write into the file '.$fname);
      return;
     }
   }
  flock($file,LOCK_UN);
  fclose($file);
 }

// Prepare string
function prstr($string) {
  return htmlspecialchars($string);
 }

// Print page navigation toolbar.
function _page_toolbar($page, $num, $max, $root_url) {
  $next_hit = $page + 1;
  $prev_hit = $page - 1;

  // First, set how many pages we have on the left and the right.
  $left  = $page;
  $right = intval($num / $max) - $page;

  // Then work out what page number we can go above and below.
  ($left > 7) ? ($lower = $left - 7) : ($lower = 1);
  ($right > 7) ? ($upper = $page + 7) : ($upper = intval($num / $max) + 1);

  // Finally, adjust those page numbers if we are near an endpoint.
  (7 - $page >= 0) and ($upper = $upper + (8 - $page));
  ($page > ($num / $max - 7)) and ($lower = $lower - ($page - intval($num / $max - 7) - 1));
  $url = '';

  // Then let's go through the pages and build the HTML.
  if ($page > 1) 
    $url .= "<a href=\"$root_url&sp=$prev_hit&mh=$max\" style=\"font-size:11px;\">[<<]</a>\n ";
  else $url .= "[<<]\n";
  for ($i = 1; $i <= intval($num / $max) + (($num % $max) ? 1 : 0 ); $i++) {
    if ($i < $lower) {
      $url .= ' ... ';
      $i = ($lower - 1);
      continue;
     }
    if ($i > $upper) {
      $url .= ' ... ';
      break;
     }
    ($i == $page) ? ($url .= "$i\n ") : ($url .= "<a href=\"$root_url&sp=$i&mh=$max\" style=\"font-size:11px;\">$i</a>\n ");
    if ($i * $max == $num) {
      $page == $i and $next_hit = $i;
      break;
     }
   }
  if (!($next_hit == $page or ($page * $max > $num))) {
    $url .= "<a href=\"$root_url&sp=$next_hit&mh=$max\" style=\"font-size:11px;\">[>>]</a>\n ";
   }
  else $url .= "[>>]\n";
  return $url;
 }

// Print Calendar
function show_cal($opts) {
 global $CFG, $IN;

 $url = "admin.php?";
 $hidden = "";

 reset($opts);
 while(list($k, $v) = each($opts)) {
   $url .= $k."=".$v."&";
   $hidden .= " <input type=\"hidden\" name=\"".$k."\" value=\"".$v."\">\n";
  }

 $url = substr($url, 0, (strlen($url)-1));

 $m = $IN['m'] ? $IN['m'] : 0;
 $y = $IN['y'] ? $IN['y'] : 0;

 require_once($CFG[ADIR]."/calendar.php");
 $c = new Calendar($url);
 echo $c->mk_calendar($m, $y);

 if($m || $y) {
   $url .= "&m=".$m."&y=".$y;
   $hidden .= " <input type=\"hidden\" name=\"m\" value=\"".$m."\">\n";
   $hidden .= " <input type=\"hidden\" name=\"y\" value=\"".$y."\">\n";
  }

?>
<br>
<table cellpadding="1" cellspacing="1" border="0" align="center">
 <form action="admin.php" method=post>
<?=$hidden?>
 <tr><td colspan="3" bgcolor="#c5dce0" class=text>&nbsp;Show statistic from:</td></tr>
 <tr>
  <td>
   <select name="s_day">
<?php
 $IN['s_day'] = $IN['s_day'] ? $IN['s_day'] : (int)date("d", $CFG['CTIME']);
 $IN['s_month'] = $IN['s_month'] ? $IN['s_month'] : (int)date("n", $CFG['CTIME']);
 $IN['s_year'] = $IN['s_year'] ? $IN['s_year'] : (int)date("Y", $CFG['CTIME']);

 for($i = 1; $i <= 31; $i++) {
   echo "<option value=\"".$i."\"";
   if($IN['s_day'] == $i) echo " selected";
   echo ">".$i."\n";
  }
?>
   </select>
  </td>
  <td>
   <select name="s_month">
<?php
 for($i = 1; $i <= 12; $i++) {
   echo "<option value=\"".$i."\"";
   if($IN['s_month'] == $i) echo " selected";
   echo ">".$c->months_str[$i - 1]."\n";
  }
?>
   </select>
  </td>
  <td>
   <select name="s_year">
<?php
 for($i = 2004; $i <= $IN[s_year]; $i++) {
   echo "<option value=\"".$i."\"";
   if($IN['s_year'] == $i) echo " selected";
   echo ">".$i."\n";
  }
?>
   </select>
  </td>
 </tr>
 <tr><td colspan="3" bgcolor="#c5dce0" class=text>&nbsp;till:</td></tr>
 <tr>
  <td>
   <select name="e_day">
<?php
 $IN['e_day'] = $IN['e_day'] ? $IN['e_day'] : $IN['s_day'];
 $IN['e_month'] = $IN['e_month'] ? $IN['e_month'] : $IN['s_month'];
 $IN['e_year'] = $IN['e_year'] ? $IN['e_year'] : $IN['s_year'];

 for($i = 1; $i <= 31; $i++) {
   echo "<option value=\"".$i."\"";
   if($IN['e_day'] == $i) echo " selected";
   echo ">".$i."\n";
  }
?>
   </select>
  </td>
  <td>
   <select name="e_month">
<?php
 for($i = 1; $i <= 12; $i++) {
   echo "<option value=\"".$i."\"";
   if($IN['e_month'] == $i) echo " selected";
   echo ">".$c->months_str[$i-1]."\n";
  }
?>
   </select>
  </td>
  <td>
   <select name="e_year">
<?php
 for($i = 2003; $i <= $IN[e_year]; $i++) {
   echo "<option value=\"".$i."\"";
   if($IN['e_year'] == $i) echo " selected";
   echo ">".$i."\n";
  }
?>
   </select>
  </td>
 </tr>
 <tr><td colspan="3" align=center><input type="submit" value="Show"></td></tr>
 </form>
</table>
<br>
<?php
 $e_d = $s_d = (int)date("d", $CFG['CTIME']);
 $e_m = (int)date("n", $CFG['CTIME']);
 $e_y = $s_y = (int)date("Y", $CFG['CTIME']);

 if($e_m == 1) {
   $s_m = 12;
   $s_y -= 1;
  }
 else 
   $s_m = $e_m - 1;

 $str = "&s_day=".$s_d."&s_month=".$s_m."&s_year=".$s_y."&e_day=".$e_d."&e_month=".$e_m."&e_year=".$e_y;
?>
<b>::</b> <a style="font-size: 11px; color: #E36700;" href="<?=$url?>">All</a> <b>::</b><br>
<b>::</b> <a style="font-size: 11px; color: #E36700;" href="<?=$url?><?=$str?>">For 30 days</a></span> <b>::</b><br>
<?php 
 $str = "&s_day=1&s_month=".$e_m."&s_year=".$s_y."&e_day=".$e_d."&e_month=".$e_m."&e_year=".$e_y;
?>
<b>::</b> <a style="font-size: 11px; color: #E36700;" href="<?=$url?><?=$str?>">For current month</a></span> <b>::</b><br>
<?php
 $i = 0;
 while((int)date("w", $CFG['CTIME'] - $i * 86400) != 1) $i++;
 $s_d = (int)date("d", $CFG['CTIME'] - $i * 86400);
 $s_m = (int)date("n", $CFG['CTIME'] - $i * 86400);
 $s_y = (int)date("Y", $CFG['CTIME'] - $i * 86400);
 $str = "&s_day=".$s_d."&s_month=".$s_m."&s_year=".$s_y."&e_day=".$e_d."&e_month=".$e_m."&e_year=".$e_y;
?>
<b>::</b> <a style="font-size: 11px; color: #E36700;" href="<?=$url?><?=$str?>">For current week</a></span> <b>::</b><br>
<?php

}

// Load a admin template and print it.
function admin_page($page) {
  global $CFG, $IN, $DB, $DB_CFG, $PREFIX;

  if(file_exists($CFG['IDIR']."/".$page.".inc.php")) 
    include($CFG['IDIR']."/".$page.".inc.php");
  else 
    err("global.php|admin_page|File not found: ".$CFG['IDIR']."/".$page.".inc");
 }

// startTiming() - to start the timer for script execution
function startTiming() {
  global $startTime;
  $tm = explode(' ', microtime());
  $startTime = ((float)$tm[1] + (float)$tm[0]);
 }

// stopTiming() - to stop the timer for script execution
function stopTiming() {
  global $startTime;
  $tm = explode(' ', microtime());
  $endTime = ((float)$tm[1] + (float)$tm[0]);
  return round(($endTime - $startTime),4);
 }

?>