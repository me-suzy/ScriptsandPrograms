<?
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Fast Click SQL - Home</title>
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
<TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%">
 <TR>
  <TD>
   <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
    <TR><TD bgcolor="#a5bcc0"><strong>General</strong></TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_gen">Summary</a>
    </TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_days">On Days</a>
    </TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_hours">On Hours</a>
    </TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=last_clicks">Last Clicks</a>
    </TD></TR>
   </TABLE>
  </TD>
 </TR>
</TABLE><br>
<TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%">
 <TR>
  <TD>
   <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
    <TR><TD bgcolor="#a5bcc0"><strong>Links Stat.</strong></TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_links">General</a>
    </TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_graphs">Graphs</a>
    </TD></TR>
   </TABLE>
  </TD>
 </TR>
</TABLE><br>
<TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%">
 <TR>
  <TD>
   <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
    <TR><TD bgcolor="#a5bcc0"><strong>Category Stat.</strong></TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_cats">General</a>
    </TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="admin.php?page=stat_cgraphs">Graphs</a>
    </TD></TR>
   </TABLE>
  </TD>
 </TR>
</TABLE><br>
<TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%">
 <TR>
  <TD>
   <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
    <TR><TD bgcolor="#a5bcc0"><strong>Useful Links</strong></TD></TR>
    <TR><TD onmouseover="mMOver(this);" onmouseout="mMOut(this);" bgcolor="#eaeaea">
      <a class="link" href="<?=$CFG[URL]?>" target="_blank">FtrainSoft, Inc.</a>
    </TD></TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<br><div align=center>Copyright &copy;2005 by Trainer</div>
</body>
</html>