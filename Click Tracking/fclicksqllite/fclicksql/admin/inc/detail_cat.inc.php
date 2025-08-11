<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

$now_time = $CFG['CTIME'];

$click_cnt=0;
$max = 0;

if(!isset($IN['period'])) $IN['period'] = "24hours";

if($IN['period']=="24hours") {
  $start_h = date("G", $now_time)+1;
  for($i=0; $i<24; $i++) $det_tab[$i] = 0;

  $sth = $DB->query("SELECT l_date FROM ".$PREFIX."stats WHERE l_date >= ".($now_time-86400)." AND CID = ".$IN['id']);
  if(!$sth) die('Database Error (Get Today List): '.$DB->error());
  while($row = $sth->fetchrow_array()) {
    $det_tab[date("G", $row[0])]++;
    $click_cnt++;
   }

  for($i=0; $i<24; $i++) $max = ($max<$det_tab[$i])?$det_tab[$i]:$max;
 }
else if($IN['period']=="7days"||$IN['period']=="30days") {
  if($IN['period']=="7days") $days = 7; else $days = 30;

  $start_h = date("j", $now_time-86400*($days-1));
  $days_num = date("t", $now_time-86400*($days-1));

  for($i=1; $i<=$days_num; $i++) $det_tab[$i] = 0;

  $sth = $DB->query("SELECT l_date FROM ".$PREFIX."stats WHERE l_date >= ".($now_time-86400*$days)." AND CID = ".$IN['id']);
  if(!$sth) die('Database Error (Get '.$days.' Days List): '.$DB->error());
  while($row = $sth->fetchrow_array()) {
    $det_tab[date("j", $row[0])]++;
    $click_cnt++;
   }

  for($i=1; $i<=$days_num; $i++) $max = ($max<$det_tab[$i])?$det_tab[$i]:$max;
 }
else if($IN['period']=="12month") {
  $start_h = date("n", $now_time)+1;
  for($i=1; $i<=12; $i++) $det_tab[$i] = 0;

  $sth = $DB->query("SELECT l_date FROM ".$PREFIX."stats WHERE l_date >= ".($now_time-86400*365)." AND CID = ".$IN['id']);
  if(!$sth) die('Database Error (Get Month List): '.$DB->error());
  while($row = $sth->fetchrow_array()) {
    $det_tab[date("n", $row[0])]++;
    $click_cnt++;
   }

  for($i=0; $i<12; $i++) $max = ($max<$det_tab[$i])?$det_tab[$i]:$max;
 }

$max = $max?$max:1;

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
<?
prtime();
$sth = $DB->query("SELECT Name FROM ".$PREFIX."category WHERE CID=".$IN['id']);
if(!$sth) die('Database Error (Category): '.$DB->error());
$row = $sth->fetchrow_one();
echo "<span class=\"liter\">Category</span> <span class=\"text2\">\"".$row."\"</span>\n";
?>

  <FORM ACTION="admin.php" METHOD=post>
   <table width="100%" border=0>
   <tr><td align=left>
     <div class=text style="margin-bottom:2pt;">Period:
     <select name="period" onChange="location.href='admin.php?page=detail_cat&id=<?=$IN['id']?>&period='+this.options[this.selectedIndex].value;">
      <option value="24hours" <?echo ($IN['period']=="24hours")?"selected":""?>>Last 24 hours
      <option value="7days" <?echo ($IN['period']=="7days")?"selected":""?>>Last 7 days
      <option value="30days" <?echo ($IN['period']=="30days")?"selected":""?>>Last 30 days
      <option value="12month" <?echo ($IN['period']=="12month")?"selected":""?>>Last 12 month
     </select></div>
   </td>
   </tr></table>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR>
         <TD align=center bgcolor="#c5dce0" width=35><b>%</b></TD>
<?php

if($IN['period']=="24hours") {
  for($i=$start_h; $i<$start_h+24; $i++) {
    $clicks = $det_tab[($i<24)?$i:($i-24)];
    $per = $click_cnt ? $clicks/$click_cnt : 0;
    echo "   <TD bgcolor=\"#e9e9e9\" align=center valign=bottom nowrap>".(round($per*1000)/10)."<BR><img src=\"graf.gif\" border=0 width=10 height=".round($clicks*160/$max)."></TD>\n";
   }

  echo "        </TR><TR>\n";
  echo "   <TD align=center bgcolor=\"#a5bcc0\" width=35><b>Clicks</b></TD>\n";

  for($i=$start_h; $i<$start_h+24; $i++)
    echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap>".$det_tab[($i<24)?$i:($i-24)]."</TD>\n";

  echo "        </TR><TR>\n";
  echo "   <TD align=center bgcolor=\"#a5bcc0\" width=35><b>Hours</b></TD>\n";

  for($i = $start_h;$i<$start_h+24;$i++)
    echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap><b>".(($i<24)?$i:($i-24))."</b></TD>\n";
  $rows=25;
 }
else if($IN['period']=="7days"||$IN['period']=="30days") {
  for($i=$start_h; $i<$start_h+$days; $i++) {
    $clicks = $det_tab[($i<=$days_num)?$i:($i-$days_num)];
    $per = $click_cnt ? $clicks/$click_cnt : 0;
    echo "   <TD bgcolor=\"#e9e9e9\" align=center valign=bottom nowrap>".(round($per*1000)/10)."<BR><img src=\"graf.gif\" border=0 width=10 height=".round($clicks*160/$max)."></TD>\n";
   }

  echo "        </TR><TR>\n";
  echo "   <TD align=center bgcolor=\"#a5bcc0\" width=35><b>Clicks</b></TD>\n";

  for($i=$start_h; $i<$start_h+$days; $i++)
    echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap>".$det_tab[($i<=$days_num)?$i:($i-$days_num)]."</TD>\n";

  echo "        </TR><TR>\n";
  echo "   <TD align=center bgcolor=\"#a5bcc0\" width=35><b>Days</b></TD>\n";

  for($i = $start_h;$i<$start_h+$days;$i++) {
    if($IN['period']=="7days") {
      $day = date('D', $CFG['CTIME'] + ($i - $start_h + 8)*86400);
      echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap><b>".(($i<=$days_num)?$i:($i-$days_num))."</b> (".$day.")</TD>\n";
     }
    else
      echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap><b>".(($i<=$days_num)?$i:($i-$days_num))."</b></TD>\n";
   }
  $rows=$days+1;
 }
else if($IN['period']=="12month") {
  for($i=$start_h; $i<$start_h+12; $i++) {
    $clicks = $det_tab[($i<=12)?$i:($i-12)];
    $per = $click_cnt ? $clicks/$click_cnt : 0;
    echo "   <TD bgcolor=\"#e9e9e9\" align=center valign=bottom nowrap>".(round($per*1000)/10)."<BR><img src=\"graf.gif\" border=0 width=10 height=".round($clicks*160/$max)."></TD>\n";
   }

  echo "        </TR><TR>\n";
  echo "   <TD align=center bgcolor=\"#a5bcc0\" width=35><b>Clicks</b></TD>\n";

  for($i=$start_h; $i<$start_h+12; $i++)
    echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap>".$det_tab[($i<=12)?$i:($i-12)]."</TD>\n";

  echo "        </TR><TR>\n";
  echo "   <TD align=center bgcolor=\"#a5bcc0\" width=35><b>Months</b></TD>\n";

  for($i = $start_h;$i<$start_h+12;$i++)
    echo "   <TD bgcolor=\"#a5bcc0\" align=center nowrap><b>".(($i<=12)?$i:($i-12))."</b></TD>\n";
  $rows=13;
 }
?>
        </TR>
        <TR><TD colspan=<?=$rows?> align=center>
          <b>Total clicks: <font color="#556c70"><?=$click_cnt?></font></b>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
  <table width=100% border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
  </FORM>
</body>
</html>