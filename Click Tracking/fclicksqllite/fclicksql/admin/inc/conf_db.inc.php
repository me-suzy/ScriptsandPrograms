<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

function create_tables() {
  global $CFG, $DB_CFG, $IN, $err_msg;

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
          $err_msg .= "<font color=red>Failed</font><br>\n";
          $err_msg .= "<font size=1>A mySQL error has occured #1. (".mysql_error().")<br>Query: ".$q.".</font><br><br>\n";
          return;
         }
       }
     }
    if (!mysql_query($q)) {
      $err_msg .= "<font color=red>Failed</font><br>\n";
      $err_msg .= "<font size=1>A mySQL error has occured #2. (".mysql_error().")<br>Query: ".$q.".</font><br><br>\n";
      return;
     }
   }

  $q = "INSERT INTO ".$IN[PREFIX]."category VALUES (0, '0', 'Common', 0, 0)";
  if(!mysql_query($q)) {
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>A mySQL error has occured #3. (".mysql_error().")<br>Query: ".$q.".</font><br><br>\n";
    return;
   }
  $err_msg .= "Passed<br>\n";
 }

function conf_save() {
  global $CFG, $DB_CFG, $PREFIX, $IN, $err_msg;

  $params = array('host', 'dbase', 'dblogin', 'dbpassw', 'PREFIX');
  while(list($k, $v) = each($params)) 
    if(isset($IN[$v])) $DB_CFG[$v] = $IN[$v];

  $req = array ('host', 'dblogin', 'dbase');
  while(list($k, $v) = each($req)) {
    if($IN[$v] == "") {
      $err_msg = "<font color=\"red\">Some required fields (".$v.") left blank.</font><br><br>";
      return; 
     }
   }

  $err_msg = "Tests:<br>\n &nbsp;&nbsp;Connect to MySQL Database: ";

  @mysql_connect($IN['host'], $IN['dblogin'], $IN['dbpassw']) OR $error = 1;
                
  if($error == 1) {
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>Database Host Name, Username or Password is incorrect.</font><br><br>\n";
    return;
   }
  else
    $err_msg .= "Passed<br>\n";

  $err_msg .= " &nbsp;&nbsp;Select MySQL Database: ";

  if(!mysql_select_db($IN['dbase'])) {
    $err_msg .= "<font color=red>Failed</font><br>\n";
    $err_msg .= "<font size=1>Cannot connect to the Database.<br>\n";
    $err_msg .= "This is due to an incorrect 'Database Name'.</font><br><br>\n";
    return;
   }
  else
    $err_msg .= "Passed<br>\n";

  if(isset($IN[NEW_TABLES]) and $IN[NEW_TABLES]) create_tables();

  SaveConf();
  if($ERR['flag']) {
    err('conf_gen.inc|conf_save|saving config file');
    log_out();
    err_scr_out();
    exit;
   }

  $err_msg .= "<br>Config file successfuly updated<br><br>";
 }

global $err_msg;
        
if(isset($IN[op])) {
  $IN[op]();
 }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Fast Click SQL</title>
  <base target="content">
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
<form method="post" action="admin.php">
<input type="hidden" name="page" value="conf_db">
<input type="hidden" name="op" value="conf_save">
<?php
if(isset($err_msg)) {?>
  <table width=450 align=center border=0 cellpadding=0 cellspacing=1>
  <tr><td><span class="liter2"><?=$err_msg?></span></td></tr>
  </table>
<?php
}
?>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="460" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=2>Database Options</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>MySQL Host</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="host" size="40" class="field" value="<?=$DB_CFG[host]?>"><br>
           <font size="1">Host and port of your MySQL database server.<br>
           (Normally 'localhost')</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Database Name</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="dbase" size="20" class="field" value="<?=$DB_CFG[dbase]?>"><br>
           <font size="1">Name of your database.<br>
           Example: fclicksql</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Table Prefix</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="PREFIX" size="20" class="field" value="<?=$DB_CFG[PREFIX]?>"><br>
           <font size="1">Prefix for Fast Click SQL tables.<br>
           Example: fc_</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>MySQL Username</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="dblogin" size="20" class="field" value="<?=$DB_CFG[dblogin]?>"><br>
           <font size="1">Example: root</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>MySQL Password</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="password" name="dbpassw" size="20" class="field" value="<?=$DB_CFG[dbpassw]?>"><br>
         </td>
        </TR>
        <TR>
         <td bgcolor="#eaeaea" valign="top" colspan=2>
           <input type="checkbox" name="NEW_TABLES" value="1">
           <b>Create New Tables</b><br>
           <font size="1" color="red"><b>Warning!!!</b></font>
           <font size="1">Old tables if it exists (with current DB Name
           and Table Prefix) will be deleted!</font>
         </td>
        </TR>
        <TR><TD colspan=2 align=right bgcolor="#dadada"><br>
          <input type="submit" value="Save" class="button"><br>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
  <table width=450 align=center border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
</form>
</body>
</html>