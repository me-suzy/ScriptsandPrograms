<?
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Fast Click SQL - Home - Nav</title>
  <base target="body">
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
    <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=title>
     <TR><TD bgcolor="#a5bcc0" colspan=2><strong>Fast Click SQL Administration</strong></TD></TR>
     <TR>
       <TD bgcolor="#eaeaea">
         <a class="link" onmouseover="mMOver(this);" onmouseout="mMOut(this);" href="admin.php?page=home_body">Statistic</a> |
         <a class="link" onmouseover="mMOver(this);" onmouseout="mMOut(this);" href="admin.php?page=db_body">Database</a> |
         <a class="link" onmouseover="mMOver(this);" onmouseout="mMOut(this);" href="admin.php?page=conf_body">Tools</a> |
         <a class="link" onmouseover="mMOver(this);" onmouseout="mMOut(this);" href=# onClick="parent.location.href='admin.php?do=logout'; return false">Logout</a>
       </TD>
     </TR>
    </TABLE>
  </TD>
 </TR>
</TABLE>
</html>