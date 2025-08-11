<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

$query = "SELECT l_date, Name, URL, IP FROM ".$PREFIX."stats,".$PREFIX."links,".$PREFIX."visitors
          WHERE ".$PREFIX."stats.LID = ".$PREFIX."links.LID AND
                ".$PREFIX."stats.VID = ".$PREFIX."visitors.VID 
          ORDER BY l_date DESC LIMIT 0, 50";

$sth = $DB->query($query);
if(!$sth) die('Database Error (Get Last Clicks): '.$DB->error());

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
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=4>Last 50 Clicks</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>Date</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Link Name</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Link URL</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>IP</B></TD>
        </TR>
<?php
while($row = $sth->fetchrow_array()) {
  echo "        <TR>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=left width=13% nowrap>&nbsp;".(date("H:i (j M)", $row[0]))."</TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=left width=20% nowrap>&nbsp;<b>".$row[1]."</b></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=left>&nbsp;<a class=\"opt\" href=\"".$row[2]."\" target=\"_blank\">".$row[2]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center nowrap>".long2ip($row[3])."</TD>\n";
  echo "        </TR>\n";
 }
?>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>Date</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Link Name</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Link URL</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>IP</B></TD>
        </TR>
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
</body>
</html>