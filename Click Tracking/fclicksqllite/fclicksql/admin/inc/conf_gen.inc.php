<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

function conf_save() {
  global $CFG, $IN, $err_msg;

  $params = array("SURL", "UNAME", "PASSW", "EMAIL", "TZONE", "DFORMAT", "TFORMAT");
  while(list($k, $v) = each($params)) 
    if(isset($IN[$v])) $CFG[$v] = $IN[$v];

  if(isset($IN[DLTIME]) and $IN[DLTIME]) $CFG['DLTIME'] = 0; 
  else $CFG['DLTIME'] = 1;

  $req2 = array("SURL", "EMAIL", "TZONE", "PASSW");
  while(list($k, $v) = each($req2)) {
    if($IN[$v] == "") {
      $err_msg = "<font color=\"red\">Some required fields (".$v.") left blank.</font><br><br>";
      return; 
     }
   }

  SaveConf();
  if($ERR['flag']) {
    err('conf_gen.inc|conf_save|saving config file');
    log_out();
    err_scr_out();
    exit;
   }

  $err_msg = "Config file successfuly updated<br><br>";
 }

global $err_msg;
        
if(isset($IN[op])) {
  $IN[op]();
 }

$tformats = "<select name=TFORMAT class=field>\n";
for($i=1;$i<=sizeof($CFG['tmas']);$i++) {
  $tformats .= '<option value="'.$i.'"';
  if($i==$CFG['TFORMAT']) $tformats .= ' selected';
  $tformats .= '>'.$CFG['tmasform'][$i].' (example: '.date($CFG['tmas'][$i], $CFG['CTIME']).')'.'</option>\n';
 }
$tformats .= "</select>\n";

$dformats = "<select name=DFORMAT class=field>\n";
for($i=1;$i<=sizeof($CFG['dmas']);$i++) {
  $dformats .= '<option value="'.$i.'"';
  if($i==$CFG['DFORMAT']) $dformats .= ' selected';
  $dformats .= '>'.$CFG['dmasform'][$i].' (example: '.date($CFG['dmas'][$i], $CFG['CTIME']).')'.'</option>\n';
 }
$dformats .= "</select>\n";

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
<input type="hidden" name="page" value="conf_gen">
<input type="hidden" name="op" value="conf_save">
<?php
if(isset($err_msg)) {?>
  <table width=450 align=center border=0 cellpadding=0 cellspacing=1>
  <tr><td align=center><span class="liter2"><?=$err_msg?></span></td></tr>
  </table>
<?php
}
?>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="460" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=2>General Options</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Script URL</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="SURL" size="40" class="field" value="<?=$CFG[SURL]?>"><br>
           <font size="1">The full URL (start with http://) to the location where 
           the PHP scripts reside. No trailing slash please.<br>
           Example: http://www.domain.com/fclicksql</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Your E-Mail Address</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="EMAIL" size="20" class="field" value="<?=$CFG[EMAIL]?>"><br>
           <font size="1">The email address you want to use.<br>
           Example: webmaster@yourdomain.com</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Admin Password</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="password" name="PASSW" size="20" class="field" value="<?=$CFG[PASSW]?>"><br>
           <font size="1">Password for you account</font>
         </td>
        </TR>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=2>Time Options</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Your Timezone</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="text" name="TZONE" size="10" class="field" value="<?=$CFG[TZONE]?>"><br>
           <font size="1">Should contain your time zone.<br>
           Will allow you to view reports with your current time.<br>
           Example: +6</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Time Format</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <?=$tformats?><br>
           <font size="1">Should contain format of time.<br>
           Will allow you to view reports with this format of time.</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Date Format</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <?=$dformats?><br>
           <font size="1">Should contain format of date.<br>
           Will allow you to view reports with this format of date.</font>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="140"><b>Daylight Time</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="checkbox" name="DLTIME"
<?php
 if(!$CFG['DLTIME']) echo "checked";
?>>
           <font size="1">Check it for the daylight time.
           Will allow you to correct time in daylight time period.</font>
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