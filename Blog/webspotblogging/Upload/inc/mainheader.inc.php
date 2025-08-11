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
?>
<HTML>
<HEAD>
<LINK REL="alternate" TITLE="<? echo $settings['blogname']; ?> RSS Feed" HREF="<? echo $path; ?>rss.php" TYPE="application/rss+xml">
<?
echo "
<style>
.subheader{
color: ".$theme['subhead_text-color'].";
background: url(\"".$path.$theme['subhead_background-image']."\");
font-family: ".$theme['subhead_font-family'].";
font-size: ".$theme['subhead_font-size'].";
vertical-align: center;
border-bottom:#000000 1px solid;
}
.post_content{
color: ".$theme['postcontent_text-color'].";
background: ".$theme['postcontent_background-color'].";
font-family: ".$theme['postcontent_font-family'].";
font-size: ".$theme['postcontent_font-size'].";
vertical-align: center;
}
.content{
color: ".$theme['content_text-color'].";
background-color: ".$theme['content_background-color'].";
font-family: ".$theme['content_font-family'].";
font-size: ".$theme['content_font-size'].";
vertical-align: center;
}
.topbar{
color: ".$theme['topbar_text-color'].";
background-color: ".$theme['topbar_background-color'].";
font-family: ".$theme['topbar_font-family'].";
font-size: ".$theme['topbar_font-size'].";
vertical-align: center;
margin:0px 0px 0px 0px;
border-bottom:#000000 1px solid;
}
.topbar a{
color:".$theme['topbar_link-color'].";
}
.topbar a:visited{
color:".$theme['topbar_link-color'].";
}
.topbar a:hover{
color:".$theme['topbar_link-color'].";
background-color:".$theme['topbar_linkhover-color'].";
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
<div align="right"><img src="<? echo $path.$theme['logo'] ?>"></div>
<table cellpadding="8" cellspacing="0" border="0" width="<? echo $theme['content_width']; ?>" class="tblborder" align="center"><tr>
<td colspan="4" class="header" align="center">
<? echo $settings['blogname'];
if(isset($page)){
echo " -- ".$page;
}
?></td>
</tr>
<tr>
<td class="topbar">
<div style="margin:0px;">
<div style="float:left;">
<b>
<?
if(!isset($_SESSION['uid'])){
echo "<a href=\"".$path."login.php\">Login</a> | ";
}
?>
<a href="<? echo $path; ?>index.php">Home</a> | <a href="<? echo $path; ?>archives.php">Archives</a>
<?
if(isset($_SESSION['uid'])){
if($_SESSION['admin'] == 1) {
echo " | <a href=\"".$path."admin/index.php\">Admin CP</a>";
} 
if($_SESSION['mod'] == 1) {
echo " | <a href=\"".$path."posting/index.php\">Posting CP</a>";
}
}
?>
 | <a href="<? echo $path; ?>rss.php" target="_blank">RSS Syndication Feed</a> | <a href="<? echo $settings['websiteurl']; ?>"><? echo $settings['websitename']; ?></a>  | <a href="<? echo $settings['contactlink']; ?>">Contact Us</a>
 <?
 if(isset($_SESSION['uid'])){
	echo " | <a href=\"".$path."logout.php\">Logout</a>";
 }
 ?>
</b>
</div>
<div style="float:right;">
<?
echo date($settings['maindateformat']);
?>
</div>
</div>
</td>
</tr>
<tr>
<div align="center">
<td class="content">
<BR>