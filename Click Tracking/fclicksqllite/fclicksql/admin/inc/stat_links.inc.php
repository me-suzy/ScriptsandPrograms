<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

$now = $CFG['dtime'];

$sth = $DB->query("SELECT LID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".$now."' GROUP BY LID");
if(!$sth) die('Database Error (Count Today): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $today[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT LID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-86400)."' AND l_date < '".$now."' GROUP BY LID");
if(!$sth) die('Database Error (Count Yesterday): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $last[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT LID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-7*86400)."' GROUP BY LID");
if(!$sth) die('Database Error (Count 7 days): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $last7[$row[0]] = $row[1];
 }

$sth = $DB->query("SELECT LID, COUNT(*) FROM ".$PREFIX."stats WHERE l_date >= '".($now-30*86400)."' GROUP BY LID");
if(!$sth) die('Database Error (Count 7 days): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $last30[$row[0]] = $row[1];
 }

// List of categories

$cat_id = $IN[cat_id] ? $IN[cat_id] : 1;

$selected = ($cat_id == 'All') ? ' selected' : '';
$category = "<option value=\"All\"".$selected.">All\n";
$selected = ($cat_id == 1) ? ' selected' : '';
$category .= "<option value=\"1\"".$selected.">Common\n";

$sth = $DB->query("SELECT CID, Name FROM ".$PREFIX."category ORDER BY Name");
if(!$sth) die('Database Error (Category): '.$DB->error());
while ($row = $sth->fetchrow_array()) {
  if($row[0] <> '1') {
    $selected = ($cat_id == $row[0]) ? ' selected' : '';
    $category .= "<option value=\"".$row[0]."\"".$selected.">".$row[1]."\n";
   }
 }

// Total links

$query = " WHERE CID = '".$cat_id."'";
if((string)$cat_id == 'All') $query = "";

$sth = $DB->query("SELECT Count(*), SUM(Count) FROM ".$PREFIX."links".$query);
if(!$sth) die('Database Error (Total): '.$DB->error());
$row = $sth->fetchrow_array();
$total = $row[0];
$totalcl = $row[1]+0;

// Prepare for page numbering
$sp     = $IN['sp'] ? $IN['sp'] : 1;
$mh     = $IN['mh'] ? $IN['mh'] : 25;
$offset = ($sp-1) * $mh;

$page_num = _page_toolbar($sp, $total, $mh, "admin.php?page=stat_links&cat_id=".$cat_id);

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
  open("admin.php?page=detail_link&id="+entry, "LinkDet",
       "width=700,height=370,status=0,toolbar=0,menubar=0,scrollbars=1");
 }
</script>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;">
  <?=prtime()?>
  <FORM ACTION="admin.php" METHOD=post>
   <table width="100%" border=0>
   <tr><td align=left>
     <div class=text style="margin-bottom:2pt;">Category:
     <select name="cat_id" onChange="location.href='admin.php?page=stat_links&cat_id='+this.options[this.selectedIndex].value;">
<?=$category?>
     </select></div>
   </td>
   <td align=right class="text">
Pages: <?=$page_num?>
   </td>
   </tr></table>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=7>Links statistic</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>Link</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Today</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Yesterday</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>For 7 days</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>For 30 days</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Total</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Detail</B></TD>
        </TR>
<?php
$sth = $DB->query("SELECT * FROM ".$PREFIX."links ".$query." ORDER BY Name LIMIT ".$offset.",".$mh);
if(!$sth) die('Database Error (Links): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $lid = $row[0];
  echo "        <TR>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a class=\"link\" href=\"".$row[4]."\" target=\"_blank\">".$row[3]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($today[$lid]+0)."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($last[$lid]+0)."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($last7[$lid]+0)."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($last30[$lid]+0)."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($row[6]+0)."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a href=\"javascript:det_view('".$lid."');\"><img border=0 src=\"closeup.gif\" width=11 height=11></a></TD>\n";
  echo "        </TR>\n";
  $today_all += $today[$lid];
  $last_all += $last[$lid];
  $last7_all += $last7[$lid];
  $last30_all += $last30[$lid];
 }
 echo "        <TR>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>Total</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($today_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($last_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($last7_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($last30_all+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($totalcl+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center></TD>\n";
 echo "        </TR>\n";
?>
        <TR><TD colspan=7 align=center>
          <b>Total links: <font color="#556c70"><?=$total?></font></b> |
          <b>Total clicks: <font color="#556c70"><?=$totalcl?></font></b>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
  <table width=100% border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
  </FORM>
</body>
</html>