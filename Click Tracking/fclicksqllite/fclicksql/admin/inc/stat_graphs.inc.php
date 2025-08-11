<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

$cat_id = $IN[cat_id] ? $IN[cat_id] : 1;

// Prepare URL

if(isset($IN['s_day'])) $url = "&s_day=".$IN['s_day'];
if(isset($IN['s_month'])) $url .= "&s_month=".$IN['s_month'];
if(isset($IN['s_year'])) $url .= "&s_year=".$IN['s_year'];
if(isset($IN['e_day'])) $url .= "&e_day=".$IN['e_day'];
if(isset($IN['e_month'])) $url .= "&e_month=".$IN['e_month'];
if(isset($IN['e_year'])) $url .= "&e_year=".$IN['e_year'];
if(isset($IN['m'])) $url .= "&m=".$IN['m'];
if(isset($IN['y'])) $url .= "&y=".$IN['y'];

// List of categories

$category = "<select name=\"cat_id\" onChange=\"location.href='admin.php?page=stat_graphs";
$category .= $url."&cat_id='+this.options[this.selectedIndex].value;\">\n";
$selected = ($cat_id == 'All') ? ' selected' : '';
$category .= "<option value=\"All\"".$selected.">All\n";
$selected = ($cat_id == 1) ? ' selected' : '';
$category .= "<option value=\"1\"".$selected.">Common\n";

$sth = $DB->query("SELECT CID, Name FROM ".$PREFIX."category ORDER BY Name");
if(!$sth) die('Database Error (Category List): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  if($row[0] <> '1') {
    $selected = ($cat_id == $row[0]) ? ' selected' : '';
    $category .= "<option value=\"".$row[0]."\"".$selected.">".$row[1]."\n";
   }
 }
$category .= "</select>";

// Links count

$query = " WHERE CID = '".$cat_id."'";
if((string)$cat_id == 'All') $query = "";

$ids = array();
$sth = $DB->query("SELECT Count(*) FROM ".$PREFIX."links".$query);
if(!$sth) die('Database Error (Link Count): '.$DB->error());
$link_cnt = $sth->fetchrow_one();

// Prepare for page numbering
$sp     = $IN['sp'] ? $IN['sp'] : 1;
$mh     = $IN['mh'] ? $IN['mh'] : 25;
$offset = ($sp-1) * $mh;

if(isset($IN['m'])) $url .= "&m=".$IN['m'];
if(isset($IN['y'])) $url .= "&y=".$IN['y'];

$page_num = _page_toolbar($sp, $link_cnt, $mh, "admin.php?page=stat_graphs&cat_id=".$cat_id.$url);

// Links

$query2 = "WHERE CID = '".$cat_id."'";
if((string)$cat_id == 'All') $query2 = "WHERE 1=1 ";

if(isset($IN['s_day'])) {
  $now = mktime(0, 0, 0, $IN['s_month'], $IN['s_day'], $IN['s_year']);
  if(isset($IN['e_day']))
    $now2 = mktime(0, 0, 0, $IN['e_month'], $IN['e_day'], $IN['e_year'])+86400;
  else $now2 = $now + 86400;
  $query2 .= "AND l_date >= '".$now."' AND l_date <= '".$now2."'";
 }

$totalcl = 0;

$sth = $DB->query("SELECT LID, COUNT(*) FROM ".$PREFIX."stats ".$query2." GROUP BY LID");
if(!$sth) die('Database Error (Count Today): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $count[$row[0]] = $row[1];
  $totalcl += $row[1];
 }

$sth = $DB->query("SELECT * FROM ".$PREFIX."links ".$query." ORDER BY Name LIMIT ".$offset.",".$mh);
if(!$sth) die('Database Error (Links): '.$DB->error());

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
 <TABLE border=0 align="center" width="100%">
 <TR>
  <TD valign=top align=center>
  <FORM ACTION="admin.php" METHOD=post>
   <table width="100%" border=0>
   <tr><td align=left>
   <div class=text style="margin-bottom:2pt;" align=left>Category:
<?=$category?>
   &nbsp;&nbsp;<b>Period:</b>
<?php
   if(isset($IN['s_day']))
     echo date($CFG['dmas'][$CFG['DFORMAT']], mktime(0, 0, 0, $IN[s_month], $IN[s_day], $IN[s_year]));
   else
     echo "All";
   if(isset($IN['e_day']))
     echo " - ".date($CFG['dmas'][$CFG['DFORMAT']], mktime(0, 0, 0, $IN[e_month], $IN[e_day], $IN[e_year]));
?>
   </div>
   </td>
   <td align=right class="text">
Pages: <?=$page_num?>
   </td>
   </tr></table>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=7>Clicks statistic</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>Link</B></TD>
         <TD bgcolor="#c5dce0" align=center width="200"> </TD>
         <TD bgcolor="#c5dce0" align=center><B>Count</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Percent</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Detail</B></TD>
        </TR>
<?php
while($row = $sth->fetchrow_array()) {
  $per = $totalcl ? $count[$row[0]]/$totalcl : 0;
  echo "        <TR>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a class=\"link\" href=\"".$row[4]."\">".$row[3]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=left>&nbsp;<img src=\"blue.gif\" height=10 width=".round($per*190)."></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".($count[$row[0]]+0)."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center>".(round($per*1000)/10)."%</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a href=\"javascript:det_view('".$row[0]."');\"><img border=0 src=\"closeup.gif\" width=11 height=11></a></TD>\n";
  echo "        </TR>\n";
 }
 echo "        <TR>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>Total</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center> </TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>".($totalcl+0)."</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center><b>100%</b></TD>\n";
 echo "         <TD bgcolor=\"#c5dce0\" align=center></TD>\n";
 echo "        </TR>\n";
?>
        <TR><TD colspan=7 align=center>
          <b>Total links: <font color="#556c70"><?=$link_cnt?></font></b> |
          <b>Total clicks: <font color="#556c70"><?=($totalcl+0)?></font></b>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
  </FORM>
  </TD>
  <TD class="text" valign=top align=center width=210>
<?show_cal(array('page'=>'stat_graphs', 'cat_id'=>$cat_id, 'm'=>$IN['m'], 'y'=>$IN['y']));?>
  </TD>
 </TR>
 </TABLE>
  <table width=100% align=center border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
</body>
</html>