<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

$ERR = array();
$ERR['log'] = '';
$ERR['mselog'] = 200000; // max size of errors log
$ERR['flag'] = false;
$ERR['file'] = 'errors.php';
$ERR['fileold'] = 'errsold.php';

//accumulate errors
/*-------------------------------------------------------*/
function err($str) {
  global $ERR, $CFG;
  if(!$ERR['flag']) {
    $ERR['log'] = date("j F Y - H:i:s", time());
    $ERR['flag'] = true;
  }
  $ERR['log'].='|'.$str;
 }

//output errors to error.log
/*-------------------------------------------------------*/

function log_out() {
  global $ERR;
  if(file_exists($ERR['file'])) {
    $exist=true;
    $fsize=filesize($ERR['file']);
    if($fsize > ($ERR['mselog'] / 2)) {
      if(file_exists($ERR['fileold'])) {
        if(!unlink($ERR['fileold'])) {
          err('error.php|log_out|can\'t delete file '.$ERR['fileold']);
          return;
         }
       }
      if(!rename($ERR['file'],$ERR['fileold'])) {
        err('error.php|log_out|can\'t rename '.$ERR['file'].' to '.$ERR['fileold']);
        return;
       }
      $exist=false;
     }
   }
  else $exist=false;

  $file=fopen($ERR['file'], 'a');
  if(!$file) {
    err('error.php|log_out|can\'t open the file '.$ERR['file']);
    return;
   }
  flock($file,LOCK_EX);
  if(!$exist) {
    if(!fwrite($file, "<?php die('Access restricted.');?>\n")) {  
// Click <a href=elog.php>here</a> for viewing the log of errors.
      err('error.php|log_out|can\'t write header into the file '.$ERR['file']);
      return;
     }
   }
  if(!fwrite($file, $ERR['log']."\n")) {
    err('error.php|log_out|can\'t attach errors to the file '.$ERR['file']);
    return;
   }
  flock($file,LOCK_UN);
  fclose($file);
 }

//output errors to screen
/*-------------------------------------------------------*/
function err_scr_out() {
  global $ERR, $pagehtml;

  $vars = array();

  require './common/data/err_tpl.php';

  //array with error data
  $errarr = preg_split("/\|/", $ERR['log']);

  $pagehtml = '';
  $vars['TIME'] = $errarr[0];
  tparse($top, $vars);

  //errors on levels
  $max=sizeof($errarr);
  $level=1;
  for($i=$max;$i>1;$i-=3) {
    $vars['FILE']=$errarr[$i-3];
    $vars['FUNCT']=$errarr[$i-2];
    $vars['DESC']=$errarr[$i-1];
    $vars['LEVEL']=$level;
    $level++;
    tparse($center,$vars);
   }

  tparse($bottom,$vars);

  //output HTML page
  echo $pagehtml;
  exit;
 }

?>