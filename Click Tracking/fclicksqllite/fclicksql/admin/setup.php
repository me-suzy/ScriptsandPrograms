<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) {
  if(file_exists("admin.php")) header("Location: admin.php");
  else header("Location: admin/admin.php");
 }

if(file_exists("./cdata.php")) {
  print_page("Installer Locked", "<br>As long as ./cdata.php exists, the installer is automaticaly locked. <br><br><b>Delete cdata.php to re-enable the installer.</b><br><br>");
  exit;
 }

if(isset($IN["step"])) $step = $IN["step"];
else $step = 0;

global $title, $output, $step, $err_msg;
$title = $output = "";

switch($step) {
  case "1":
    step1();
    break;
  case "2":
    step2();
    break;
  default:
    welcome();
 }

function welcome() {
  global $title, $output;

  $title = "Welcome to Fast Click SQL";
  $output = <<<data
<TR><TD bgcolor="#a5bcc0" align=center colspan=2>Welcome to Fast Click SQL</TD></TR>
<TR>
  <TD bgcolor="#eaeaea" valign="top" colspan=2>
    Welcome to the Fast Click SQL Installer. This 
    installer is going to make setup easier then ever. 
    You'll have it up in minutes!<br><br>
    This installer will help you setup configuration 
    file and an administrator account.
  </TD>
</TR>
data;
 }

function step1() {
  global $title, $output, $CFG, $DB_CFG, $IN, $step;
  global $HTTP_SERVER_VARS;

  $step = 1;

  $url = str_replace("/admin/admin.php", "", $HTTP_SERVER_VARS["HTTP_REFERER"]);
  if(!$url) {
    $url = str_replace("/admin/admin.php", "", $_SERVER["SCRIPT_NAME"]);
    $url = "http://".$_SERVER["SERVER_NAME"].$url;
   }
  if(!$IN['SURL']) $CFG['SURL'] = $url;

  $title = "Options";

  $output = <<<data
<TR><TD bgcolor="#a5bcc0" align=center colspan=2>MySQL Database Options</TD></TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>MySQL Host</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="host" size="40" class="field" value="$DB_CFG[host]"><br>
    <font size="1">Host and port of your MySQL database server.<br>
    (Normally 'localhost')</font>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Database Name</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="dbase" size="25" class="field" value="$DB_CFG[dbase]"><br>
    <font size="1">Name of your database.<br>
    Example: fclicksql</font>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Table Prefix</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="PREFIX" size="25" class="field" value="$DB_CFG[PREFIX]"><br>
    <font size="1">Prefix for Fast Click SQL tables.<br>
    Example: fc_</font>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>MySQL Username</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="dblogin" size="25" class="field" value="$DB_CFG[dblogin]"><br>
    <font size="1">Example: root</font>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>MySQL Password</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="dbpassw" size="25" class="field" value="$DB_CFG[dbpassw]"><br>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Is First Installation?</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="checkbox" name="NEW_TABLES" checked value="1">
    <font size="1">If it is first installation of script must be checked.</font><br>
    <font size="1" color="red"><b>Warning!!!</b></font>
    <font size="1">Old tables if it exists (with current DB Name
    and Table Prefix) will be deleted! (If you update old version then uncheck it!)</font>
  </td>
</TR>
<TR><TD bgcolor="#a5bcc0" align=center colspan=2>General Options</TD></TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Script URL</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="SURL" size="40" class="field" value="$CFG[SURL]"><br>
    <font size="1">The full URL (start with http://) to the location where 
    the PHP scripts reside. No trailing slash please.<br>
    Example: http://www.domain.com/fclicksql</font>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Your E-Mail Address</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="text" name="EMAIL" size="25" class="field" value="$CFG[EMAIL]"><br>
    <font size="1">The email address you want to use.<br>
    Example: webmaster@yourdomain.com</font>
  </td>
</TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Admin Password</b></td>
  <td bgcolor="#eaeaea" valign="top">
    <input type="password" name="PASSW" size="25" class="field" value="$CFG[PASSW]"><br>
    <font size="1">Password for you account.<br>
    Default: admin</font>
  </td>
</TR>
<TR><TD bgcolor="#a5bcc0" align=center colspan=2>Time Options</TD></TR>
<TR>
  <TD bgcolor="#c5dce0" width="130"><b>Your Timezone</b></td>
  <td bgcolor="#eaeaea" valign="top">
<select name="TZONE" class="field">
<option value="-12">(GMT -12:00 hours) Eniwetok, Kwajalein</option>
<option value="-11">(GMT -11:00 hours) Midway Island, Samoa</option>
<option value="-10">(GMT -10:00 hours) Hawaii</option>
<option value="-9">(GMT -9:00 hours) Alaska</option>
<option value="-8">(GMT -8:00 hours) Pacific Time (US &amp; Canada), Tijuana</option>
<option value="-7">(GMT -7:00 hours) Mountain Time (US &amp; Canada), Arizona</option>
<option value="-6">(GMT -6:00 hours) Central Time (US &amp; Canada), Mexico City</option>
<option value="-5">(GMT -5:00 hours) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
<option value="-4">(GMT -4:00 hours) Atlantic Time (Canada), Caracas, La Paz</option>
<option value="-3">(GMT -3:00 hours) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
<option value="-2">(GMT -2:00 hours) Mid-Atlantic, Ascension Is., St. Helena</option>
<option value="-1">(GMT -1:00 hours) Azores, Cape Verde Islands</option>
<option value="0" selected>(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
<option value="1">(GMT +1:00 hours) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
<option value="2">(GMT +2:00 hours) Cairo, Helsinki, Kaliningrad, South Africa</option>
<option value="3">(GMT +3:00 hours) Baghdad, Riyadh, Moscow, Nairobi</option>
<option value="4">(GMT +4:00 hours) Abu Dhabi, Baku, Muscat, Tbilisi</option>
<option value="5">(GMT +5:00 hours) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
<option value="6">(GMT +6:00 hours) Almaty, Colombo, Dhaka, Novosibirsk</option>
<option value="7">(GMT +7:00 hours) Bangkok, Hanoi, Jakarta</option>
<option value="8">(GMT +8:00 hours) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
<option value="9">(GMT +9:00 hours) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
<option value="10">(GMT +10:00 hours) Canberra, Guam, Melbourne, Sydney</option>
<option value="11">(GMT +11:00 hours) Magadan, New Caledonia, Solomon Islands</option>
<option value="12">(GMT +12:00 hours) Auckland, Wellington, Fiji, Marshall Island</option>
</select>
   <font size="1">Should contain your time zone.<br>
   Will allow you to view reports with your current time.</font>
  </td>
</TR>
data;
 }

function step2() {
  global $IN, $title, $output, $CFG, $DB_CFG, $err_msg, $ERR;

  $params = array('host', 'dbase', 'dblogin', 'dbpassw', 'PREFIX');
  while(list($k, $v) = each($params)) 
    if(isset($IN[$v])) $DB_CFG[$v] = $IN[$v];

  $req = array('host', 'dblogin', 'dbase');
  while(list($k, $v) = each($req)) {
    if($IN[$v] == "") {
      step1();
      $err_msg = "<font color=\"red\">Some required for MySQL database fields (".$v.") left blank.</font><br><br>";
      return; 
     }
   }

  $params2 = array('SURL', 'UNAME', 'PASSW', 'EMAIL', 'TZONE', 'DFORMAT', 'TFORMAT');
  while(list($k, $v) = each($params2)) 
    if(isset($IN[$v])) $CFG[$v] = $IN[$v];

  $req2 = array('SURL', 'EMAIL', 'TZONE', 'PASSW');
  while(list($k, $v) = each($req2)) {
    if($IN[$v] == "") {
      step1();
      $err_msg = "<font color=\"red\">Some required fields (".$v.") left blank.</font><br><br>";
      return; 
     }
   }

  $err_msg = "Tests:<br>\n &nbsp;&nbsp;Connect to MySQL Database: ";

  @mysql_connect($DB_CFG['host'], $DB_CFG['dblogin'], $DB_CFG['dbpassw']) OR $error = 1;
                
  if($error == 1) {
    step1();
    err('setup.php|step2|connection with MySQL server has failed');
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>Database Host Name, Username or Password is incorrect.</font><br><br>\n";
    return;
   }
  else
    $err_msg .= "Passed<br>\n";

  $err_msg .= " &nbsp;&nbsp;Select MySQL Database: ";

  if(!mysql_select_db($DB_CFG['dbase'])) {
    step1();
    err('setup.php|step2|database selection has failed -- '.mysql_error());
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>Cannot connect to the Database.<br>\n";
    $err_msg .= "This is due to an incorrect 'Database Name'.</font><br><br>\n";
    return;
   }
  else
    $err_msg .= "Passed<br>\n";

  if(isset($IN[NEW_TABLES]) and $IN[NEW_TABLES]) {
    create_tables();
    if($ERR['flag']) {
      step1();
      err('setup.php|step2|can\'t create tables');
      return;
     }
   }

  $err_msg .= " &nbsp;&nbsp;Create Config File: ";

  ## Write the variables file
  SaveConf();
  if($ERR['flag']) {
    step1();
    err('setup.php|step2|can\'t create config file');
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>Cannot create config file.<br>\n";
    $err_msg .= "This is due to an incorrect permissions for folders.</font><br><br>\n";
    return;
   }
  else
    $err_msg .= "Passed<br>\n";

  @chmod("./cdata.php", 0666);

  $pr_text = $err_msg;
  $err_msg = "";

  $title = "Installation Complete";

  $output = <<<data
<TR><TD bgcolor="#a5bcc0" align=center colspan=2>Installation Complete</TD></TR>
<TR>
  <TD bgcolor="#eaeaea" valign="top" colspan=2>
  <span class="liter2">$pr_text</span><br>
  The setup is now complete. All tests have passed,
  you are ready to continue using Fast Click SQL.<br><br>
  You can continue on to the administrative script.
  </TD>
</TR>
data;
 }

function create_tables() {
  global $CFG, $DB_CFG, $IN, $err_msg, $ERR;

  include($CFG['CDIR']."/data/build_sql.php");

  $err_msg .= " &nbsp;&nbsp;Create New Tables: ";

  $sql = build_sql();
  foreach($sql as $q) {
    // Major fix is the addition to add '1' to stop looping of the replace, at the end
    if ($IN[PREFIX] != "fc_") { 
      $q = preg_replace("/fc_(\S+?)([\s\.,]|$)/", $IN[PREFIX]."\\1\\2", $q, 1);   
     }
    if (preg_match("/CREATE TABLE (\S+) \(/", $q, $match)) {
      if ($match[1]) {
        $the_query = "DROP TABLE if exists ".$match[1];
        if (!mysql_query($the_query)) { 
          step1();
          err('setup.php|create_tables|drop exists table has failed -- '.mysql_error());
          $err_msg .= "<font color=red>Failed</font><br>\n";
          $err_msg .= "<font size=1>A mySQL error has occured #1. (".mysql_error().")<br>Query: ".$q.".</font><br><br>\n";
          return;
         }
       }
     }
    if (!mysql_query($q)) {
      step1();
      err('setup.php|create_tables|create table has failed -- '.mysql_error());
      $err_msg .= "<font color=red>Failed</font><br>\n";
      $err_msg .= "<font size=1>A mySQL error has occured #2. (".mysql_error().")<br>Query: ".$q.".</font><br><br>\n";
      return;
     }
   }

  $q = "INSERT INTO ".$IN[PREFIX]."category VALUES (1, '0', 'Common')";
  if(!mysql_query($q)) {
    step1();
    err('setup.php|create_tables|insert in table has failed -- '.mysql_error());
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>A mySQL error has occured #3. (".mysql_error().")<br>Query: ".$q.".</font><br><br>\n";
    return;
   }
  $err_msg .= "Passed<br>\n";
 }

if($ERR['flag']) {err('setup.php||Setup was failed'); log_out();}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Fast Click SQL Installer</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="style.css" type="text/css" rel="stylesheet">
  <script language="JavaScript">
    function mMOver(ob) {
      ob.style.background='#c5dce0';
    }
    function mMOut(ob) {
      ob.style.background='#eaeaea';
    }
  </script>
</head>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;">
<br><form method="post" action="admin.php">
<input type="hidden" name="step" value="<?=($step+1)?>">
<?php
if(isset($err_msg)) {?>
  <table width=560 align=center border=0 cellpadding=0 cellspacing=1>
  <tr><td><span class="liter2"><?=$err_msg?></span></td></tr>
  </table>
<?php
}
?>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="560" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
<?=$output?>
        <TR><TD colspan=2 align=right bgcolor="#dadada"><br>
          <input type="submit" value="Next" class="button"><br>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
  <table width=560 align=center border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
</form>
</body>
</html>
<?
exit;
?>