<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

$now = $CFG['dtime'];

$sth = $DB->query("SELECT CID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".$now."' GROUP BY CID");
if(!$sth) die('Database Error (Count Today): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $today[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT CID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-86400)."' AND l_date < '".$now."' GROUP BY CID");
if(!$sth) die('Database Error (Count Yesterday): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $last[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT CID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-7*86400)."' GROUP BY CID");
if(!$sth) die('Database Error (Count 7 days): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $last7[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT CID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-30*86400)."' GROUP BY CID");
if(!$sth) die('Database Error (Count 7 days): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $last30[$row[0]] = $row[1];
 }

// Total cats

$sth = $DB->query("SELECT Count(*) FROM ".$PREFIX."category");
if(!$sth) die('Database Error (cat count): '.$DB->error());
$total = $sth->fetchrow_one();

// Prepare for page numbering
$sp     = $IN['sp'] ? $IN['sp'] : 1;
$mh     = $IN['mh'] ? $IN['mh'] : 25;
$offset = ($sp-1) * $mh;

$page_num = _page_toolbar($sp, $total, $mh, "admin.php?page=stat_cats");

// Get Count for Categories
$sth = $DB->query("SELECT CID, SUM(Count) FROM ".$PREFIX."links GROUP BY CID ORDER BY CID");
if(!$sth) die('Database Error (sum link count): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $cats[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT * FROM ".$PREFIX."category ORDER BY Cat LIMIT ".$offset.",".$mh);
if(!$sth) die('Database Error (Cats): '.$DB->error());

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
<script language="JavaScript">
function det_view(entry) {
  open("admin.php?page=detail_cat&id="+entry, "CatDet",
       "width=700,height=370,status=0,toolbar=0,menubar=0,scrollbars=1");
 }
</script>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;">
   <?=prtime()?>
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=7>Links statistic</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>Category</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Today</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Yesterday</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>For 7 days</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>For 30 days</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Total</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Detail</B></TD>
        </TR>
<? if($sp == 1) { ?>
        <TR>
         <TD bgcolor="#e9e9e9" align=center>Common</TD>
         <TD bgcolor="#e9e9e9" align=center><?=($today[1]+0)?></TD>
         <TD bgcolor="#e9e9e9" align=center><?=($last[1]+0)?></TD>
         <TD bgcolor="#e9e9e9" align=center><?=($last7[1]+0)?></TD>
         <TD bgcolor="#e9e9e9" align=center><?=($last30[1]+0)?></TD>
         <TD bgcolor="#e9e9e9" align=center><?=$cats[1]+0?></TD>
         <TD bgcolor="#e9e9e9" align=center><a href="javascript:det_view('1');"><img border=0 src="closeup.gif" width=11 height=11></a></TD>
        </TR>
<?php
  } 

 $today_all = $today[1]+0;
 $last_all = $last[1]+0;
 $last7_all = $last7[1]+0;
 $last30_all = $last30[1]+0;
 $totalcl = $cats[1]+0;

while($row = $sth->fetchrow_array()) {
  if($row[0] <> '1') {
    $cid = $row[0];          
    echo "        <TR>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".$row[2]."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($today[$cid]+0)."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($last[$cid]+0)."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($last7[$cid]+0)."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($last30[$cid]+0)."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($cats[$cid]+0)."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center><a href=\"javascript:det_view('".$cid."');\"><img border=0 src=\"closeup.gif\" width=11 height=11></a></TD>\n";
    echo "        </TR>\n";
    $today_all += $today[$cid];
    $last_all += $last[$cid];
    $last7_all += $last7[$cid];
    $last30_all += $last30[$cid];
    $totalcl += $cats[$cid];
   }
 }

 echo "        <TR>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>Total</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($today_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($last_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($last7_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($last30_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".$totalcl."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center></TD>\n";
 echo "        </TR>\n";
?>
        <TR><TD colspan=7 align=center>
          <b>Total categories: <font color="#556c70"><?=$total?></font></b> |
          <b>Total clicks: <font color="#556c70"><?=$totalcl?></font></b>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
  <table width=100% align=center border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
</body>
</html>