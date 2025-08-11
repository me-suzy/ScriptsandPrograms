<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

$now = $CFG['dtime'];

$sth = $DB->query("SELECT COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".$now."'");
if(!$sth) die('Database Error (Count): '.$DB->error());
$today = $sth->fetchrow_one();

$sth = $DB->query("SELECT COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-86400)."' AND l_date < '".$now."'");
if(!$sth) die('Database Error (Count -1): '.$DB->error());
$yesterday = $sth->fetchrow_one();

$sth = $DB->query("SELECT COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-6*86400)."'");
if(!$sth) die('Database Error (Count 7): '.$DB->error());
$for7 = $sth->fetchrow_one();

$sth = $DB->query("SELECT COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-30*86400)."'");
if(!$sth) die('Database Error (Count 30): '.$DB->error());
$for30 = $sth->fetchrow_one();

$sth = $DB->query("SELECT Count(*), SUM(Count) FROM ".$PREFIX."links");
if(!$sth) die('Database Error (Total): '.$DB->error());
$row = $sth->fetchrow_array();
$total = $row[0];
$totalcl = $row[1];

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
   <?=prtime()?>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="450" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=5>Links statistic</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center></TD>
         <TD bgcolor="#c5dce0" align=center><B>Today</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Yesterday</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>For 7 days</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>For 30 days</B></TD>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><b>Total</b></TD>
         <TD bgcolor="#c5dce0" align=center><b><?=$today?></b></TD>
         <TD bgcolor="#c5dce0" align=center><b><?=$yesterday?></b></TD>
         <TD bgcolor="#c5dce0" align=center><b><?=$for7?></b></TD>
         <TD bgcolor="#c5dce0" align=center><b><?=$for30?></b></TD>
        </TR>
        <TR><TD colspan=5 align=center>
          <b>Total links: <font color="#556c70"><?=$total?></font></b> |
          <b>Total clicks: <font color="#556c70"><?=$totalcl?></font></b>
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
</body>
</html>