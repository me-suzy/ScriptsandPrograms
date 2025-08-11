<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

$top=<<<TOP
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<title>Fast Click SQL - Error report</title>
<meta http-equiv="Content-Type" content="text/html; charset="ISO-8859-1">
<link href="style.css" type="text/css" rel="stylesheet"></head>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;"><br>
<TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="500" align="center">
 <TR><TD>
  <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
   <TR><TD bgcolor="#a5bcc0" align=center colspan=4>Information about error</TD></TR>
   <TR><TD bgcolor="#c5dce0" align=center><B>Level</B></TD>
    <TD bgcolor="#c5dce0" align=center><B>File</B></TD>
    <TD bgcolor="#c5dce0" align=center><B>Function</B></TD>
    <TD bgcolor="#c5dce0" align=center><B>Description</B></TD></TR>

TOP;

$center=<<<CENTER
   <TR><TD bgcolor="#e9e9e9" align=center>%%LEVEL%%</TD>
    <TD bgcolor="#e9e9e9" align=center>%%FILE%%</TD>
    <TD bgcolor="#e9e9e9" align=center>%%FUNCT%%</TD>
    <TD bgcolor="#e9e9e9" align=center>%%DESC%%</TD></TR>

CENTER;

$bottom=<<<BOTTOM
    <TR><TD bgcolor="#c5dce0" align=left colspan=4>&nbsp;&nbsp;%%TIME%%</TD></TR></TABLE></TD></TR></TABLE>
  <table width=500 align=center border=0><tr><td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td></tr></table>
</body></html>

BOTTOM;
?>