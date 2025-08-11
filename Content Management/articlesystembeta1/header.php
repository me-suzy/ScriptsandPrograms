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
			@import "images/css.css"; 
		--></style>
		<style type="text/css" media="print"><!-- 
			@import "images/print.css"; 
		--></style>
		
		<title><? echo $setting['sysname']; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
 <meta name="description" content="<? echo $setting['sysdesc']; ?>" />
<meta name="keywords" content="<? echo $setting['syskeywords']; ?>" />
<?
if (@$_GET['func'] == "article")
{
?>
<script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "simple"
});
</script>
<?}
?>
	</head>
	<body>
		<div id="pageWrapper">
			<div id="masthead" class="inside">

<!-- masthead content begin -->

<h1 style="color: #ded"><a href="index.php" style="color: #ded" title="Home">EasyArticle</a></h1>


<!-- masthead content end -->

				<hr class="hide" />
			</div>
			
			<div id="outerColumnContainer">
				<div id="innerColumnContainer">
					<div id="SOWrap">
						<div id="middleColumn">
							<div class="inside">


