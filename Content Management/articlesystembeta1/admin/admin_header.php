<?php
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// always modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP/1.0
header("Pragma: no-cache");

session_start();
include ("../db.php");

$sql = mysql_query("SELECT * FROM settings");
$setting = array();

while($row = mysql_fetch_array($sql)){
	$name = $row['realname'];
	$value = $row['value'];

	$setting[$name] = $value;

}
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<style type="text/css"><!-- 
			@import "../images/css.css"; 
		--></style>
				<style type="text/css" media="print"><!-- 
			@import "images/print.css"; 
		--></style>
		<title><? echo $setting['sysname'];?> :: Admin Area</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<?
if (@$_GET['func'] == "addarticle")
{
?>
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script><script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left"
});
</script>
<?}
?>
<script type="text/javascript" type="text/javascript">
<!--
function switchMenu(obj)
{
	var el = document.getElementById(obj);
	if(el.style.display != "block")
	{
		el.style.display = "block";
	}
	else
	{
		el.style.display = "none";
	}
}
-->
</script>
<script language="javascript" type="text/javascript">
<!--
function check()
{
var agree=confirm("Are you SURE you wish to continue? \n\n The action you are about to perform could have an adverse impact (E.G: It could screw up your site)");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
	</head>
	<body>
		<div id="pageWrapper">
			<div id="masthead" class="inside">

<!-- masthead content begin -->

<h1 style="color: #ded"><a href="index.php" style="color: #ded" title="Admin Area Home">EasyArticle - Admin Area</a></h1>

<!-- masthead content end -->

				<hr class="hide" />
			</div>
			
			<div id="outerColumnContainer">
				<div id="innerColumnContainer">
					<div id="SOWrap">
						<div id="middleColumn">
							<div class="inside">
