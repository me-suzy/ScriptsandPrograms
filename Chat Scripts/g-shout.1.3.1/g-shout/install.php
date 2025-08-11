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

$version_now = "1.3.1";

if (!isset($_GET['step'])){
header("Location: install.php?step=1");
}

function timer_start() {
    global $timestart;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timestart = $mtime;
    return true;
}

function timer_stop($display=0,$precision=3) { //if called like timer_stop(1), will echo $timetotal
    global $timestart,$timeend;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timeend = $mtime;
    $timetotal = $timeend-$timestart;
    if ($display)
        echo number_format($timetotal,$precision);
    return $timetotal;
}

//starting to count the page generation time
timer_start();

if ($_POST['action'] == "updatepath"){

	$fp = fopen("config.php","r");
	while (!feof($fp)){
		$data = fgets($fp, filesize("config.php"));
            if (substr($data,0,9) == '$datafile') {
				$output[] = '$datafile = "'.$_POST['new_datafile']."\";\n";
            } else if (substr($data,0,8) == '$logfile') {
				$output[] = '$logfile = "'.$_POST['new_logfile']."\";\n";
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
		header('Location: ?step=2');
}

if ($_POST['action'] == "ins_setpass"){

	$fp = fopen("config.php","r");
	while (!feof($fp)){
		$data = fgets($fp, filesize("config.php"));
            if (substr($data,0,15) == '$admin_password') {
				$output[] = '$admin_password = "'.$_POST['ins_password']."\";\n";
            } else if (substr($data,0,16) == '$secret_question') {
				$output[] = '$secret_question = "'.$_POST['ins_question']."\";\n";
            } else if (substr($data,0,14) == '$secret_answer') {
				$output[] = '$secret_answer = "'.$_POST['ins_answer']."\";\n";
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
		header('Location: ?step=3&updated=1');
}


if(is_file("config.php")){
include("config.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>G-Shout INSTALLATION&nbsp;&nbsp;&#8250;&nbsp;&nbsp;
Step <?=$_GET['step']?></title>


<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<meta name="MSSmartTagsPreventParsing" content="TRUE" />
<meta http-equiv="expires" content="-1" />
<?
if($SERVER_PROTOCOL == "HTTP/1.0"){
echo("<meta http-equiv=\"pragma\" content=\"no-cache\" />\n");
}else{
echo("<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\" />\n");
}
?>

<meta name="Generator" content="G-Shout <?=$version?>" />
 

<link rel="stylesheet" type="text/css" href="skins/default.css" />

<style type="text/css">
<!--
acronym {
  cursor: help;
}
label {
	cursor: pointer;
}

.green {
	color: green;
}
.red{
	color: red;
}
//-->
</style>
<script type="text/javascript">
<!--
function about(){
window.open('./about.php', 'About', 'width=310,height=395,location=0,menubar=0,toolbar=0,scrollbars=yes,resizable=0,status=0,screenx=245,screeny=103');
}
//-->
</script>
</head>

<body>

<div id="topBar">

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody>

<tr>

<td class="helpLinks">
<div class="helpLinksLeft">
<a href="javascript:void(0)" onclick="javascript:about()">G-Shout Installation Script</a>
</div>
</td>
</tr>

</tbody></table>


</div>
<div id="header">&nbsp;</div>

<div id='content'>
<h2>Installation step <?=$_GET['step']?></h2>

<!-- langkah - langkah -->

<?
$flag = true;
if ($_GET['step'] == "1"){
	echo "<div class='default'>Welcome to G-Shout Installation. Please read the README file first and then use this installation script.</div><br />";
	echo "<div align='center'><a href='?step=2'>NEXT &gt;&gt;</a></div>";
}else if ($_GET['step'] == "2"){

	echo "<br />Checking for required files.............<br /><br />";

	echo "<br /><br /><div class='default'>############## CONFIG FILE ##########################</div>";


	echo "<br />Checking config.php file .......... ";
	if (is_file("config.php")){
		echo "<span class='green'>file exists</span><br />";
	} else {
		echo "<span class='red'>file does not exist. Rename the config_bak.php file to config.php</span><br />";
		//set flag
		$flag = false;
	}

	echo "<br />Checking config.php permission .......... ";
	if (is_writable("config.php")){
		echo "<span class='green'>writeable</span><br />";
	} else {
		echo "<span class='red'>config.php is not writeable, change its permission to be writeable. (CHMOD 666 config.php, if you are using *NIX OS)</span><br />";
		//set flag
		$flag = false;
	}

	echo "<br /><br /><div class='default'>############## SECRET DIRECTORY ##########################</div>";

	echo "<br />Checking secret directory name .......... ";
	if  ($secret_dir == "_secret"){
		echo "<span class='red'>secret directory's name is '_secret' which is default name, CHANGE IT!</span><br />";
		//set flag
		$flag = false;
	} else {
		echo "<span class='green'>secret directory's name is not '_secret' but '".$secret_dir."', good.</span><br />";
	}

	echo "<br />Checking secret directory existences .......... ";
	if (is_dir($secret_dir)){
		echo "<span class='green'>directory '".$secret_dir."' exists</span><br />";
	} else {
		echo "<span class='red'>directory '".$secret_dir."' does not exist</span><br />";
		//set flag
		$flag = false;
	}

	echo "<br /><br /><div class='default'>############## DATABASE FILE ##########################</div>";

	echo "<br />Checking database file name .......... ";
	if ($database == "default.dat"){
		echo "<span class='red'>database file's name is '".$database."' which is default name, CHANGE IT!</span><br />";
		//set flag
		$flag = false;
	} else {
		echo "<span class='green'>database file's name is not 'default.dat' but '".$secret_dir."', good.</span><br />";
	}

	echo "<br />Checking database file existences .......... ";
	if (is_file($datapath)){
		echo "<span class='green'>database file '".$database."' exists</span><br />";
	} else {
		echo "<span class='red'>database file '".$database."' does not exist, make it exists!</span><br />";
		//set flag
		$flag = false;
	}

	echo "<br />Checking database file permission .......... ";
	if (is_writable($datapath)){
		echo "<span class='green'>database file '".$database."' is writeable</span><br />";
	} else {
		echo "<span class='red'>database file '".$database."' is NOT writeable, change its permission to be writeable. (CHMOD 666 ".$database.", if you are using *NIX OS)</span><br />";
		//set flag
		$flag = false;
	}

	echo "<br /><br /><div class='default'>############## LOG FILE ##########################</div>";

	echo "<br />Checking log file name .......... ";
	if ($log == "default.log"){
		echo "<span class='red'>log file's name is '".$log."' which is default name, CHANGE IT!</span><br />";
		//set flag
		$flag = false;
	} else {
		echo "<span class='green'>log file's name is not 'default.log' but '".$log."', good.</span><br />";
	}

	echo "<br />Checking log file existence .......... ";
	if (is_file($logpath)){
		echo "<span class='green'>log file '".$log."' exists</span><br />";
	} else {
		echo "<span class='red'>log file '".$log."' does not exist, make it exists!</span><br />";
		//set flag
		$flag = false;
	}

	echo "<br />Checking log file permission .......... ";
	if (is_writable($logpath)){
		echo "<span class='green'>log file '".$log."' is writeable</span><br />";
	} else {
		echo "<span class='red'>log file '".$log."' is not writeable, change its permission to be writeable. (CHMOD 666 ".$log.", if you are using *NIX OS)</span><br />";
		//set flag
		$flag = false;
	}

	// if all OK
	if ($flag){
		echo "<br /><br /><div class='success' align='center'>Everything is OK. GOOD! Now we can go to next page.</div>";
		echo "<div class='default' align='center'><a href='?step=1'>&lt;&lt; PREVIOUS</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='?step=3'>NEXT &gt;&gt;</a></div>";
	} else {
		echo "<br /><br /><div class='alert' align='center'>There is/are error(s). Please check and fix it first before you can go to next page.</div><br />";
		echo "<div class='default' align='center'><a href='?step=1'>&lt;&lt; PREVIOUS</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;NEXT &gt;&gt;</div>";
	}

} else if ($_GET['step'] == "3") {

	echo "
	<br /><br /><div class='alert'>Set your Password used to login.</div><br />
		<form method='post' action='install.php'>
		password:<br />
		<input class='input' type='text' name='ins_password' value='".$admin_password."' size='50' /><br /><br /><br />
		<br /><div class='alert'>Set your Secret Question and Secret Answer. Both used to display your Password if you have forgotten it.</div><br />
		secret question:<br />
		<input class='input' type='text' name='ins_question' value='".$secret_question."' size='50' /><br /><br />
		secret answer:<br />
		<input class='input' type='text' name='ins_answer' value='".$secret_answer."' size='50' /><br />
		<input type='hidden' name='action' value='ins_setpass' />
		<input type='submit' class='submit' value='SUBMIT' />
		</form>
	";
		echo "<br /><br /><br /><div class='default' align='center'><a href='?step=1'>&lt;&lt; PREVIOUS</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
		if ( $_GET['updated'] == "1"){
			echo "<a href='?step=4'>NEXT &gt;&gt;</a>";
		} else {
			echo "NEXT &gt;&gt;";

		}

} else {

echo "Installation Complete! Now you can login via <a href='admin.php'>Control Panel</a> (password: ".$admin_password.") or see <a href='iframe_demo.php'>Iframe Demo</a><br /><br />DON'T FORGET TO DELETE THIS FILE (install.php)!!!";

}
?>

<!-- akhir langkah - langkah -->
</div>

<div class='copyright'>
<a href='javascript:void(0)' onclick='javascript:about()'>G-Shout Installation Script</a> - Copyright &copy; 2005 - <a href='http://gravitasi.com' target='_blank'>Gravitasi</a>
<br />
Page generated in <?=number_format(timer_stop(), 2)?> seconds
</div>

</body>
</html>