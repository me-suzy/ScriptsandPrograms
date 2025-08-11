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

include("config.php");
include("./includes/functions.inc.php");
include ("./languages/lang-$language.php");

if(!is_writable($datafile)){
	$error = _DATA_UNWRITABLE;
} else if (!is_writable("config.php")){
	$error = _CONF_UNWRITABLE;
} else if (!is_writable($logfile)){
	$error = _LOG_UNWRITABLE;
}

if ($_POST['action'] == "login") {
	if($_POST['var_password'] == $admin_password){
    makeCookie($_POST['var_password']);
	writeLogs_php($_SERVER["REMOTE_ADDR"],"_LOG_LOGIN_SUCCESS",$_POST['var_password']);
	header("Location: admin.php");
	} else if ($_POST['var_password'] != $admin_password) {
		header("Location: admin.php?error="._WRONG_PASS."");
		writeLogs_php($_SERVER["REMOTE_ADDR"],"_LOG_LOGIN_FAIL",$_POST['var_password']);
	}
}
if ($_GET['action'] == "logout"){
    delCookie();
	writeLogs_php($_SERVER["REMOTE_ADDR"],"_LOG_LOGOUT","");
    header("Location: admin.php");
}

if ($_POST['action'] == "updateshout") {
    if (validCookie($_COOKIE['gshout_auth'])) {
		if(updateShout($_POST['id'],$_POST['comment'],$_POST['name'],$_POST['sex'],$_POST['uri'],$_POST['timestamp'],$_POST['ip'],$_POST['reply'])){
		$message = _SHOUT_UPDATED;
		header("Location: admin.php?page=".$_POST['gotopage']."&message="._SHOUT_UPDATED."");
		}else{
			$error = _ERROR_WRITE_DATA;
			header("Location: admin.php?page=".$_POST['gotopage']."&error="._ERROR_WRITE_DATA."");
		}
    }
}
if ($_POST['action'] == "delete") {
    if (validCookie($_COOKIE['gshout_auth'])) {
		deleteShout($_POST['toggle']);
		if(count($_POST['toggle']) == "1"){
		$message = _SHOUT_DELETED;
		header("Location: admin.php?page=".$gotopage."&message="._SHOUT_DELETED."");
		} else {
			$message= _SHOUTS_DELETED;
		header("Location: admin.php?page=".$gotopage."&message="._SHOUTS_DELETED."");
		}
    }
}

if ($_POST['action'] == "filter" AND validCookie($_COOKIE['gshout_auth'])) {
	$fp = fopen("config.php","r");
	while (!feof($fp)){
		$data = fgets($fp, filesize("config.php"));
            if (substr($data,0,7) == '$status') {
				$output[] = '$status = "'.trim($_POST['new_status'])."\";\n";
			} else if (substr($data,0,8) == '$results') {
				$output[] = '$results = "'.trim($_POST['new_results'])."\";\n";
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
		header("Location: admin.php?results=".$_POST['new_results']."");
 }

// re-read the config file
if ($_POST['action'] == "updateshout") {
	include("config.php");
	include ("./languages/lang-".$language.".php");
}

//include header
include("./includes/header.inc.php");

if (validCookie($_COOKIE['gshout_auth'])) { // if admin still logged in
?>

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="navCell" style="width: 2%;">

<div class="cpNavOff">
&nbsp;
</div>

</td>

<td class="navCell">

<div class="cpNavOn">
<a href="admin.php">&nbsp;<?=_EDIT_SHOUTS?>&nbsp;</a>
</div>

</td>
<td class="navCell">

<div class="cpNavOff">
<a href="editconf.php">&nbsp;<?=_CONFIGURATION?>&nbsp;</a>
</div>

</td>
<td class="navCell">

<div class="cpNavOff">
<a href="viewlogs.php">&nbsp;<?=_VIEW_LOGS?>&nbsp;</a>
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
<h1><?=_EDIT_SHOUTS;?></h1>
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
} else if(isset($message)) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='success'>".$message."</div>";
	echo "</div></td></tr>";
} else if(isset($error)) {
	echo "<tr><td  class='box'  colspan='2'><div class='itemWrapper'>";
	echo "<div class='alert'>".$error."</div>";
	echo "</div></td></tr>";
} else {
	echo "<tr><td><div class='success'>&nbsp;</div></td></tr>";
}

?>

<tr>
<td  class='itemWrapper'  colspan='7'>

<form method='post' name='filterform' id='filterform' action='admin.php' >

<!-- still confuse, will be developed when I have time
<select name='new_status' class='select'>
<option value='all'>Filtered by Reply Status</option>
<option value='all' <?if($status=="all")echo "selected='selected'";?>>View All</option>
<option value='replied' <?if($status=="replied")echo "selected='selected'";?>>Replied</option>
<option value='notreplied' <?if($status=="notreplied")echo "selected='selected'";?>>Not Replied</option>
</select>
&nbsp;&nbsp;
-->

<select name='new_results' class='select'>
<option value='<?=$commentshown?>'><?=_SHOUTS_PER_PAGE?></option>
<option value='10' <?if($results=="10")echo "selected='selected'";?>>10 <?=_SHOUTS?></option>
<option value='20' <?if($results=="20")echo "selected='selected'";?>>20 <?=_SHOUTS?></option>
<option value='30' <?if($results=="30")echo "selected='selected'";?>>30 <?=_SHOUTS?></option>
<option value='40' <?if($results=="40")echo "selected='selected'";?>>40 <?=_SHOUTS?></option>
<option value='50' <?if($results=="50")echo "selected='selected'";?>>50 <?=_SHOUTS?></option>
</select>
&nbsp;&nbsp;
<input name='action' type='hidden' value='filter' />
<input name='submit' type='submit' value='Go' class='submit' />
</form>

</td>
</tr>
</table>

<form method="post" name="delete" id="delete" action="admin.php">
<script language="javascript" type="text/javascript"> 
<!--
	function toggle(thebutton)
        {
            if (thebutton.checked) 
            {
               val = true;
            }
            else
            {
               val = false;
            }
                        
            var len = document.target.elements.length;
        
            for (var i = 0; i < len; i++) 
            {
                var button = document.target.elements[i];
                
                var name_array = button.name.split("["); 
                
                if (name_array[0] == "toggle") 
                {
                    button.checked = val;
                }
            }
            
            document.target.toggleflag.checked = val;
        }
        
//-->
</script>

<table style="width: 100%;" class="tableBorder" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="tablePad">

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="tableHeadingBold">
<?=_ID;?>
</td>
<td class="tableHeadingBold">
<?=_DATE;?>
</td>
<td class="tableHeadingBold">
<?=_SHOUTS;?>
</td>
<td class="tableHeadingBold">
<?=_NAME;?>
</td>
<td class="tableHeadingBold">
<?=_SEX;?>
</td>
<td class="tableHeadingBold">
<?=_IP_ADDRESS;?>
</td>
<td class="tableHeadingBold">
<?=_WEB_EMAIL;?>
</td>
<td class="tableHeadingBold">
<?=_REPLYDATE;?>
</td>
<td class="tableHeadingBold">
<?=_REPLY;?>
</td>
<td class="tableHeadingBold">
<?=_EDIT;?>
</td>
<td class="tableHeadingBold">
<input class="checkbox" name="toggleflag" value="" onclick="toggle(this);" type="checkbox"><br />
<?=_DELETE;?>
</td>
</tr>

<!-- mulai ngelist -->

<?
//buat menentukan jumlah ditampilkan
//$shoutcount = countShouts();

if (isset($_GET['results'])){
$results = $_GET['results'];
}
if (isset($_GET['page'])){
$page = $_GET['page'];
}

if (!isset($page)||$page==0) {
	//buat nentuin halaman default
	//$page=floor($shoutcount/20)+1;
	$page=1;
	}

$entry = ($results * $page)-$results;
$selesai = $results*$page;
$output = getShouts($start,20,1);

$d = array();
require_once($datafile);
$shoutcount = count($d);

	while (trim($d[$entry]) != "" && $entry < $selesai ) {

		$temporary = explode("#%", $d[$entry]);
		$id = $temporary[0];
		$com = $temporary[1];
		$nam = $temporary[2];
		$sex = $temporary[3];
		$uri = $temporary[4];
		$timestamp = $temporary[5];
		$ip = $temporary[6];
		$reply = $temporary[7];
		$redate = $temporary[8];

	showEntryfromCPanel($id,$com,$nam,$sex,$uri,$timestamp,$ip,$reply,$redate);
	$entry++;
	}


?>

<!-- End of list -->

</tbody></table>


</td>
</tr>
</tbody></table>


<table style="width: 98%;" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="default">

<div class="crumblinks">

</div>

</td>

<td class="defaultRight">
<input type="hidden" name="gotopage" value="<?=$page?>" />
<input type="hidden" name="action" value="delete" />
<input type="submit" class="submit" value="<?=_DELETE?>" onclick="return confirm('<?=_ARE_YOU_SURE?>')" />
</td>
</tr>
</tbody></table>

</form>

<!-- Begin paginate -->
        <table class="paginate"><tr><td>&nbsp;&nbsp;<?=_DISPLAYING_PAGE?> <?=$page?> <?=_OF?> <?=floor($shoutcount/$results)+1?> (<?=_TOTAL?> <?=$shoutcount?> <?=_FROM_MAXIMAL?> <?=$keep?> <?=_LAST_SHOUTS?>)</tr></td><tr><td>&nbsp;&nbsp;<?=_PAGE?>
    <?
        if ($page != 1) {
            echo "<a href='admin.php?page=1'>[ &lt;&lt; ]</a> <a href='admin.php?page=".($page-1)."'>[ &lt; ]</a> ";
        } else {
            echo "<font color='#666666'>[ &lt;&lt; ] [ &lt; ]</font> ";            
        }
        for ($count=0;$count<$shoutcount;$count=$count+$results) {
            $newpage = floor($count/$results) + 1;
            if ($page == $newpage) {
                echo $newpage." ";
            } else {
                echo "<a href='admin.php?page=".$newpage."'>".$newpage."</a> ";
            }
        }
		if ($page != floor($shoutcount/$results)+1) {
            echo "<a href='admin.php?page=".($page+1)."'>[ &gt; ]</a> <a href='admin.php?page=".(floor($shoutcount/$results)+1)."'>[ &gt;&gt; ]</a>";
        } else {
            echo "<font color='#666666'>[ &gt; ] [ &gt;&gt; ]</font>";
        }
    ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>
<!-- End of paginate -->


<?
} else if(!empty($_POST['fgt_answer']) && strtolower($_POST['fgt_answer']) == strtolower($secret_answer)) {
writeLogs_php($_SERVER["REMOTE_ADDR"], "_LOG_RIGHT_SECRET_ANSWER", $_POST['fgt_answer']);	
?>

<div class='leftPad'>
<br />
<div class='leftPad'>

<div class='default'>
<?echo "<br /><div class='success'>Your password is: $admin_password</div>"?>
</div>

<div class='default'><br /><a href='admin.php' ><?=_RETURN_TO_LOGIN?></a></div>


<? } else if(!empty($_POST['fgt_answer']) && strtolower($_POST['fgt_answer']) == strtolower($secret_answer) && $sendmail == "yes") {

	$extra_hdr_str = "From: G-Shout System <g-shout@".$_SERVER['HTTP_HOST']."> \r\nContent-type: text/html\r\nX-Mailer: PHP/" .phpversion();
	$body = "<p align=\"center\">"._YOUR_PASSWORD_IS.": $admin_password</p>";
	$subject = "[G-Shout] "._YOUR_PASSWORD."";

	mail($emailaddress,$subject,$body,$extra_hdr_str);
?>

<div class='leftPad'>
<br />
<div class='leftPad'>

<div class='default'>
<?echo "<br /><div class='success'>Your password has been sent to ".$emailaddress."</div>"?>
</div>

<div class='default'><br /><a href='admin.php' ><?=_RETURN_TO_LOGIN?></a></div>

<?
} else if ($_POST['action'] == "sendpass" && !empty($_POST['fgt_answer']) && strtolower($_POST['fgt_answer']) != strtolower($secret_answer)){
writeLogs_php($_SERVER["REMOTE_ADDR"], "_LOG_WRONG_SECRET_ANSWER", $_POST['fgt_answer']);
?>

<div class='leftPad'>
<br />
<div class='leftPad'>

<div class='default'>
<?echo "<br /><div class='alert'>You have entered incorrect secret answer.</div>"?>
</div>

<div class='default'><br /><a href='admin.php?action=forgotpass' ><?=_RETURN_TO_FORGOT?></a></div>


<?
} else if ($_GET['action'] == "forgotpass" && empty($_POST['fgt_email']) && empty($_POST['fgt_email'])) { 
?>


<div class='leftPad'>
<br />
<div class='leftPad'>
<h2><?=_FORGOT_PASSWORD?></h2>

<form method='post' action='admin.php' >

<div class='default'><br /><label for='fgt_answer'><?=_ANSWER_THIS?></label></div>

<div class='default'><br /><b><label for='fgt_answer'><?=$secret_question?></label></b></div>

<div class='default'><input style='width:250px' type='text' name='fgt_answer' id='fgt_answer' value='' size='20' maxlength='80' class='input'  />
</div>

<div class='default'><br />
<input  type='hidden' name='action' value='sendpass' />
<input  type='submit' value='Submit' class='submit' />
</div>

<div class='default'><br /><a href='admin.php' ><?=_RETURN_TO_LOGIN?></a></div>

<?
	} else { // kalo gak terlogin

?>

<?

if(isset($_GET['error'])) {
	echo "<div class='itemWrapper' style='padding:10px'>";
	echo "<div class='alert'>".$_GET['error']."</div>";
	echo "</div>";
}
?>

<div class='leftPad'>
<br />
<div class='leftPad'>

<h2><?=_ADMIN_LOGIN?></h2>

<form name="login" method="post" action="admin.php" >

<div class='default'><br /><label for="password"><?=_PASSWORD?></label></div>

<div class='default'><input style="width:150px" type="password" name="var_password" id="password" value="" size="20" maxlength="32" class="input" />
</div>

<div class='default'>
<br />
<input type="hidden" name="action" value="login" />
<input type='submit' class='submit' value='Submit' />

</div>
</form>

<div class='default'><br /><a href='admin.php?action=forgotpass' ><?=_FORGOT_PASSWORD?></a></div>

<? } ?>

</div>
</div>


<?
include("./includes/footer.inc.php");
?>