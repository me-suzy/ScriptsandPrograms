<?php

/************************************************************************/
/* G-Shout : Gravitasi Shoutbox                                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2005 by Yohanes Pradono                                */
/* http://gravitasi.com                                                 */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

if(is_file("install.php")){
	die("WARNING!!! You must delete install.php before using G-Shout");
}

header("Expires: Sun, 10 Jan 1982 05:00:00 GMT"); // donie's birthday
header("Last-Modified: ".gmdate("D, d M Y H:i:s"). " GMT"); // always modified
if($SERVER_PROTOCOL == "HTTP/1.0"){
header("Pragma: no-cache"); // HTTP/1.0
}else{
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
}

include("config.php");
include("./includes/functions.inc.php");
include("./languages/lang-".$language.".php");

if(validCookie($_COOKIE['gshout_auth'])){

if(!is_writable($datafile)){
	$error = _DATA_UNWRITABLE;
} else if (!is_writable("config.php")){
	$error = _CONF_UNWRITABLE;
} else if (!is_writable($logfile)){
	$error = _LOG_UNWRITABLE;
}

if ($_POST['action'] == "logfilter" AND validCookie($_COOKIE['gshout_auth'])) {
	$fp = fopen("config.php","r");
	while (!feof($fp)){
		$data = fgets($fp, filesize("config.php"));
            if (substr($data,0,12) == '$logsperpage') {
				$output[] = '$logsperpage = "'.trim($_POST['new_logsperpage'])."\";\n";
            } else {//nothing happened :)
				$output[] = $data;
			}
	}//end while
        fclose($fp);
        $fp = fopen("config.php","w");
		if($fp){
        foreach ($output as $data){
            fwrite ($fp, $data);
        }
		} else {
			$error = _ERROR_WRITE_CONF;
		}
 }

// re-read the new config file
include("config.php");

// include header
include("./includes/header.inc.php");
?>

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="navCell" style="width: 2%;">

<div class="cpNavOff">
&nbsp;
</div>

</td>
<td class="navCell">

<div class="cpNavOff">
<a href="admin.php">&nbsp;<?=_EDIT_SHOUTS;?>&nbsp;</a>
</div>

</td>

<td class="navCell">

<div class="cpNavOff">
<a href="editconf.php">&nbsp;<?=_CONFIGURATION;?>&nbsp;</a>
</div>

</td>

<td class="navCell">

<div class="cpNavOn">
<a href="logs.php">&nbsp;<?=_VIEW_LOGS?>&nbsp;</a>
</div>

</td>

<td class="navCell" style="width: 2%;">

<div class="cpNavOff">
&nbsp;
</div>

</td>
</tr>
</tbody></table>



<div id="breadcrumb">
<table style="width: 100%;" class="contentWidth" border="0" cellpadding="6" cellspacing="0">
<tbody><tr>
<td class="defaultBold">
<span class="crumblinks">
<h2><?=_VIEW_LOGS?></h2>
</span>

</td>
<td class="breadcrumbRight">
&nbsp;
</td>
</tr>
</tbody></table>


</div>

<div id="content">

<table border='0'  cellspacing='0' cellpadding='0' style='width:100%;' >
<?
if(isset($_GET['message'])){
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='success'>";
	echo $_GET['message'];
	echo "</div>";
	echo "</div></td></tr>";
} else if(isset($_GET['error'])) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='alert'>".$_GET['error']."</div>";
	echo "</div></td></tr>";
} else if(isset($message)){
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='success'>";
	echo $message;
	echo "</div>";
	echo "</div></td></tr>";
} else if(isset($error)) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='alert'>".$error."</div>";
	echo "</div></td></tr>";
} else {
	echo "<tr><td><div class='success'>&nbsp;</div></td></tr>";
}
?>
</table>

<table>
<tr>
<td  class='itemWrapper'  colspan='7'>

<form method='post' name='filterform' id='filterform'  action='logs.php' >

<select name='new_logsperpage' class='select'>
<option value='<?=$logsperpage?>'>Logs per page</option>
<option value='10' <?if($logsperpage=="10")echo "selected='selected'";?>>10 results</option>
<option value='25' <?if($logsperpage=="25")echo "selected='selected'";?>>25 results</option>
<option value='50' <?if($logsperpage=="50")echo "selected='selected'";?>>50 results</option>
<option value='75' <?if($logsperpage=="75")echo "selected='selected'";?>>75 results</option>
<option value='100' <?if($logsperpage=="100")echo "selected='selected'";?>>100 results</option>
</select>
&nbsp;&nbsp;
<input type='hidden' name='action' value='logfilter' />
<input type='submit' name='submit' value='Go' class='submit' />
</form>

</td>
</tr>
</table>

<table border='0'  cellspacing='0' cellpadding='0' style='width:100%;'  class='tableBorder' >

<tr>
<td  class='tablePad' >

<table border='0'  cellspacing='0' cellpadding='0' style='width:100%;' >

<tr>
<td  class='tableHeadingBold' >
<?=_DATE?>
</td>
<td  class='tableHeadingBold' >
<?=_IP_ADDRESS?>
</td>
<td  class='tableHeadingBold' >
<?=_ACTION?>
</td>
<td  class='tableHeadingBold' >
<?=_VALUE?>
</td>
</tr>

<?
	//buat menentukan jumlah ditampilkan
$logcount = countLogs();
if (!isset($page)||$page==0) {
	$page=1;
}

$entry = ($logsperpage * $page)-$logsperpage;
$selesai = $logsperpage*$page;

if($data = file($logfile)) {
	while ($data[$entry] != "" && $entry < $selesai ) {

	if($data = file($logfile)) {
		$temporary = explode("#%", $data[$entry]);
		$timestamp = $temporary[0];
		$ip = $temporary[1];
		$action = constant($temporary[2]);
		$value = $temporary[3];
	}
	viewLogs($timestamp,$ip,$action,$value);
	$entry++;
	}
}
?>

</table>

</td>

</tr>
</table>


<div class='itemWrapper'>
<div class='crumblinks'>
<!-- Begin paginate -->
        <table class="paginate"><tr><td>&nbsp;&nbsp;<?=_DISPLAYING_PAGE?> <?=$page?> <?=_OF?> <?=floor($logcount/$logsperpage)+1?> (<?=_TOTAL?> <?=$logcount?> <?=_FROM_MAXIMAL?> <?=$lastlogs?> <?=_LAST_LOGS?>)</tr></td><tr><td>&nbsp;&nbsp;<?=_PAGE?>
    <?
        if ($page != 1) {
            echo "<a href='logs.php?page=1'>[ &lt;&lt; ]</a> <a href='logs.php?page=".($page-1)."'>[ &lt; ]</a> ";
        } else {
            echo "<font color='#666666'>[ &lt;&lt; ] [ &lt; ]</font> ";            
        }
        for ($count=0;$count<$logcount;$count=$count+$logsperpage) {
            $newpage = floor($count/$logsperpage) + 1;
            if ($page == $newpage) {
                echo $newpage." ";
            } else {
                echo "<a href='logs.php?page=".$newpage."'>".$newpage."</a> ";
            }
        }
		if ($page != floor($logcount/$logsperpage)+1) {
            echo "<a href='logs.php?page=".($page+1)."'>[ &gt; ]</a> <a href='logs.php?page=".(floor($logcount/$logsperpage)+1)."'>[ &gt;&gt; ]</a>";
        } else {
            echo "<font color='#666666'>[ &gt; ] [ &gt;&gt; ]</font>";
        }
    ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>
<!-- End of paginate -->
</div>
</div>

<?
include("./includes/footer.inc.php");
} else {
	writeLogs($_SERVER["REMOTE_ADDR"],"_LOG_LOGIN_EXPIRED","");
	header("Location: admin.php?error="._RELOGIN."");
}
?>