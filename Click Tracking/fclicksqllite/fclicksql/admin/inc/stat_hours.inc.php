<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

for($i = 0; $i < 24; $i++)
  $hours[$i] = 0;

$sth = $DB->query("SELECT l_date FROM ".$PREFIX."stats");
if(!$sth) die('Database Error (Count): '.$DB->error());
while($row = $sth->fetchrow_one()) {
  $hours[date("G", $row)]++;
  $summ++;
 }

$sth = $DB->query("SELECT Count(*), SUM(Count) FROM ".$PREFIX."links");
if(!$sth) die('Database Error (Total): '.$DB->error());
$row = $sth->fetchrow_array();
$total = $row[0];
$totalcl = $row[1]+0;

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
        <TR><TD bgcolor="#a5bcc0" align=center colspan=4>Links statistic on hours</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center width=60><b>Hour</b></TD>
         <TD bgcolor="#c5dce0" align=center> </TD>
         <TD bgcolor="#c5dce0" align=center width=70><b>Clicks</b></TD>
         <TD bgcolor="#c5dce0" align=center width=80><b>Percent</b></B></TD>
        </TR>
<?php
while(list($k, $v) = each($hours)) {
  if($v) {
    echo "        <TR>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".$k."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\">&nbsp;<img src=\"blue.gif\" height=10 width=".round($v/$summ*190)."></TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($v?$v:"")."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".(round($v/$summ*1000)/10)."%</TD>\n";
    echo "        </TR>\n";
   }
 }
?>
        <TR>
         <TD bgcolor="#c5dce0" align=center><b>Total</b></TD>
         <TD bgcolor="#c5dce0" align=center> </TD>
         <TD bgcolor="#c5dce0" align=center><b><?=$summ?></b></TD>
         <TD bgcolor="#c5dce0" align=center><b>100%</b></B></TD>
        </TR>
        <TR><TD colspan=4 align=center>
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