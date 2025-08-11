<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
include($path."inc/global.php");
include($path."inc/checks.php");
?>
<HTML>
<HEAD>
<?
echo "
<style>
.dark{
background-color: #dedede;
font-size: 15px;
font-family: Tahoma, Verdana, Arial, Helvetica, Sans-Serif;
}
.light{
background-color: #e6e6e6;
font-size: 15px;
font-family: Tahoma, Verdana, Arial, Helvetica, Sans-Serif;
}
.content{
color: ".$theme['content_text-color'].";
background-color: ".$theme['content_background-color'].";
font-family: ".$theme['content_font-family'].";
font-size: ".$theme['content_font-size'].";
vertical-align: center;
}
td{
font-size: ".$theme['content_font-size'].";
font-family: ".$theme['content_font-family'].";
}
.header{
color: ".$theme['header_text-color'].";
background: url(\"".$path.$theme['header_background-image']."\");
font-family: ".$theme['header_font-family'].";
font-size: ".$theme['header_font-size'].";
vertical-align: center;
border-bottom:#000000 1px solid;
}
.tblborder{
border:#000000 1px solid;
background: #EFEFEF;
}
a:visited{
color:blue;
}
body{
background-color:".$theme['body_background-color'].";
}
</style>
";
?>
<title>
<?
echo $settings['blogname'];
if(isset($page)){
echo " -- ".$page;
}
?>
</title>
</HEAD>
<body>
<table cellpadding="8" cellspacing="0" border="0" width="<? echo $theme['content_width']; ?>" class="tblborder" align="center"><tr>
<td colspan="4" class="header" align="center">
<b>
<? echo $settings['blogname'];
if(isset($page)){
echo " -- ".$page;
}
?></b></td>
</tr>
<tr>
<div align="center">
<td class="content">
<BR>