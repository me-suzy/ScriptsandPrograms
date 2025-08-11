<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

@Error_Reporting(E_ALL & ~E_NOTICE);

require($CFG['CDIR'].'/global.php'); 
require($CFG['CDIR'].'/sql.php');

startTiming();   // Start the timer 

function InitVars($init_db=1) {
  global $CFG, $DB_CFG, $PREFIX, $IN, $DB, $ERR;

  // Do some PHP config.
  @ini_set('magic_quotes_runtime', '0');

  $IN = _get_form_data();

//  $CFG = array();
  $CFG['VERSION'] = '1.1.2';           // Current version
  $CFG['NAME'] = 'Fast Click SQL';     // Product name
  $CFG['SERIES'] = 'Lite';             // Current series
  $CFG['URL'] = 'http://www.ftrain.siteburg.com'; // Home page
  $CFG['SURL'] = './';                 // Script URL
  $CFG['ADIR'] = './admin';            // Admin dir
  $CFG['IDIR'] = './admin/inc';        // Inc files dir
  if(!isset($CFG['CDIR'])) $CFG['CDIR'] = './common';  // Common dir
  $CFG['UNAME'] = 'admin';             // User name
  $CFG['PASSW'] = 'admin';             // User password
  $CFG['EMAIL'] = '';                  // Admin e-mail
  $CFG['TZONE'] = 0;                   // Time zone
  $CFG['DFORMAT'] = 3;                 // Date format
  $CFG['TFORMAT'] = 1;                 // Time format
  $CFG['DLTIME'] = 0;                  // Daylight time

  $CFG['tmas'][1]='H:i:s';         //time formats
  $CFG['tmas'][2]='G:i:s';         
  $CFG['tmas'][3]='H:i'; 
  $CFG['tmas'][4]='G:i';         
  $CFG['tmas'][5]='h:i:s A';
  $CFG['tmas'][6]='g:i:s A';
  $CFG['tmasform'][1]='HH:mm:ss';  //time formats descriptions
  $CFG['tmasform'][2]='H:mm:ss';  
  $CFG['tmasform'][3]='HH:mm';  
  $CFG['tmasform'][4]='H:mm';  
  $CFG['tmasform'][5]='hh:mm:ss tt';
  $CFG['tmasform'][6]='h:mm:ss tt';
  $CFG['dmas'][1]='j F Y';         //date formats
  $CFG['dmas'][2]='d F Y';
  $CFG['dmas'][3]='d-M-y';
  $CFG['dmas'][4]='d-M-Y';
  $CFG['dmas'][5]='j-M-y';
  $CFG['dmas'][6]='j-M-Y';
  $CFG['dmas'][7]='m/d/y';
  $CFG['dmas'][8]='m/d/Y';
  $CFG['dmas'][9]='n/j/y';
  $CFG['dmas'][10]='n/j/Y';
  $CFG['dmas'][11]='y/m/d';
  $CFG['dmas'][12]='Y/m/d';
  $CFG['dmas'][13]='y/n/j';
  $CFG['dmas'][14]='Y/n/j';
  $CFG['dmas'][15]='Y-m-d';
  $CFG['dmas'][16]='Y-n-j';
  $CFG['dmas'][17]='d.m.y';
  $CFG['dmas'][18]='d.m.Y';
  $CFG['dmas'][19]='j.n.y';
  $CFG['dmas'][20]='j.n.Y';
  $CFG['dmasform'][1]='d MMMM yyyy';
  $CFG['dmasform'][2]='dd MMMM yyyy';
  $CFG['dmasform'][3]='dd-MMM-yy';
  $CFG['dmasform'][4]='dd-MMM-yyyy';
  $CFG['dmasform'][5]='d-MMM-yy';
  $CFG['dmasform'][6]='d-MMM-yyyy';
  $CFG['dmasform'][7]='mm/dd/yy';   //date formats descriptions
  $CFG['dmasform'][8]='mm/dd/yyyy';
  $CFG['dmasform'][9]='m/d/yy';
  $CFG['dmasform'][10]='m/d/yyyy';
  $CFG['dmasform'][11]='yy/mm/dd';
  $CFG['dmasform'][12]='yyyy/mm/dd';
  $CFG['dmasform'][13]='yy/m/d';
  $CFG['dmasform'][14]='yyyy/m/d';
  $CFG['dmasform'][15]='yyyy-mm-dd';
  $CFG['dmasform'][16]='yyyy-m-d';
  $CFG['dmasform'][17]='dd.mm.yy';
  $CFG['dmasform'][18]='dd.mm.yyyy';
  $CFG['dmasform'][19]='d.m.yy';
  $CFG['dmasform'][20]='d.m.yyyy';

  $DB_CFG['host'] = 'localhost:3306';
  $DB_CFG['dbase'] = 'fclick';
  $DB_CFG['PREFIX'] = 'fc_';
  $DB_CFG['dblogin'] = 'root';
  $DB_CFG['dbpassw'] = '';

  // correct current time to current time zone
  $t=time();
  $tm=gmdate("n",$t);
  $td=gmdate("j",$t);
  $ty=gmdate("Y",$t);
  $th=gmdate("G",$t);
  $ti=gmdate("i",$t);
  $ts=gmdate("s",$t);
  $CFG['CTIME'] = mktime($th,$ti,$ts,$tm,$td,$ty,$CFG['DLTIME']);  //current GMT time
  $CFG['BTIME'] = $CFG['CTIME'];      //begin time for GMT

  if(!file_exists($CFG['SDIR']."./cdata.php")) {
    global $ERR;
    if(isset($CFG['SDIR'])) die("Script not installed! Ask Webadministrator.");
    setup();
    exit;
   }

  include($CFG['SDIR']."./cdata.php");

  //correct time

  $CFG['CTIME'] += ($CFG['TZONE']*3600);
  $db=getdate($CFG['BTIME']);
  $dc=getdate($CFG['CTIME']);

  //hours
  $hbtime=mktime($db['hours'],0,0,$db['mon'],$db['mday'],$db['year'],0);
  //time of the current hour
  $CFG['htime']=mktime($dc['hours'],0,0,$dc['mon'],$dc['mday'],$dc['year'],0);
  //number of current hour
  $CFG['hnum']=(int)(($CFG['htime']-$hbtime)/3600);

  //days
  $hbtime=mktime(0,0,0,$db['mon'],$db['mday'],$db['year'],0);
  //time of the current day
  $CFG['dtime']=mktime(0,0,0,$dc['mon'],$dc['mday'],$dc['year'],0);
  //number of current day
  $CFG['dnum']=(int)(($CFG['dtime']-$hbtime)/86400);

  //number of the current month
  $CFG['mnum']=($dc['year']-$db['year'])*12+$dc['mon']-$db['mon'];
  //begin time of the current month
  $CFG['mtime']=mktime(0,0,0,$dc['mon'],1,$dc['year'],0);
  //begin time of the last month
  $CFG['lmtime']=mktime(0,0,0,$dc['mon']-1,1,$dc['year'],0);
  //begin time of the last month
  $CFG['lpmtime']=mktime(0,0,0,$dc['mon']-2,1,$dc['year'],0);
  //begin time of the next month
  $CFG['nmtime']=mktime(0,0,0,$dc['mon']+1,1,$dc['year'],0);

  //begin time of the current week
  if($dc['wday']==0) $num=6;
  else $num=$dc['wday']-1;
  $CFG['wtime']=mktime(0,0,0,$dc['mon'],$dc['mday']-$num,$dc['year'],0);
  //begin time of the last week
  $CFG['lwtime']=mktime(0,0,0,$dc['mon'],$dc['mday']-7-$num,$dc['year'],0);
  //begin time of the next week
  $CFG['nwtime']=mktime(0,0,0,$dc['mon'],$dc['mday']+7-$num,$dc['year'],0);

  // Connect to Database
  if($init_db) {
    $DB = new DB($DB_CFG);
    $PREFIX = $DB_CFG['PREFIX'];
   }
 }

function setup() {
  global $HTTP_SERVER_VARS,$CFG,$DB_CFG,$ERR,$IN;
  require './admin/setup.php';
 }

function SaveConf() {
  global $CFG, $DB_CFG;

  $fdata[]="<?php\n\n## DO NOT EDIT THIS FILE\n";

  $fdata[]="\$CFG['SURL'] = '".$CFG['SURL']."';";
  $fdata[]="\$CFG['UNAME'] = '".$CFG['UNAME']."';";
  $fdata[]="\$CFG['PASSW'] = '".$CFG['PASSW']."';";
  $fdata[]="\$CFG['EMAIL'] = '".$CFG['EMAIL']."';";
  $fdata[]="\$CFG['TZONE'] = '".$CFG['TZONE']."';";
  $fdata[]="\$CFG['DFORMAT'] = '".$CFG['DFORMAT']."';";
  $fdata[]="\$CFG['TFORMAT'] = '".$CFG['TFORMAT']."';";
  $fdata[]="\$CFG['DLTIME'] = '".$CFG['DLTIME']."';\n";

  $fdata[]="\$DB_CFG['host'] = '".$DB_CFG['host']."';";
  $fdata[]="\$DB_CFG['dbase'] = '".$DB_CFG['dbase']."';";
  $fdata[]="\$DB_CFG['PREFIX'] = '".$DB_CFG['PREFIX']."';";
  $fdata[]="\$DB_CFG['dblogin'] = '".$DB_CFG['dblogin']."';";
  $fdata[]="\$DB_CFG['dbpassw'] = '".$DB_CFG['dbpassw']."';";
  $fdata[]="\n?".">";
  save_file('./cdata.php',$fdata);
 }

// Get form data from GET or POST vars, depending on how it was submitted,
// and return data in an array.  The request method is stored as the key
// REQUEST_METHOD in the returned array.
function _get_form_data() {
  global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;

  // Check to see which request method was used.
  switch(strtolower($HTTP_SERVER_VARS['REQUEST_METHOD'])) {
    case 'get':
      $data = $HTTP_GET_VARS;
      $data['REQUEST_METHOD'] = 'GET';
      break;
    case 'post':
      $data = $HTTP_POST_VARS;
      $data['REQUEST_METHOD'] = 'POST';
      break;
    default:
      $data = array();
   }

  // Check to see if magic_quotes_gpc is turned on,
  // and if it is remove the slashes.
  if(get_magic_quotes_gpc()) {
    foreach ($data as $key => $val) {
      if(!is_array($data[$key])) 
        $data[$key] = stripslashes($val);
     }
   }

  return $data;
 }

?>