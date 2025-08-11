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
include ("./languages/lang-".$language.".php");

if(!is_writable($datafile)){
	$error = _DATA_UNWRITABLE;
} else if (!is_writable("config.php")){
	$error = _CONF_UNWRITABLE;
} else if (!is_writable($logfile)){
	$error = _LOG_UNWRITABLE;
}

if(validCookie($_COOKIE['gshout_auth'])){
	if ($_POST['action'] == "updateconfig" && $_POST['current_password'] == $admin_password && $_POST['changepassword'] != "" && $_POST['changepassword'] != $_POST['changepassword_confirm']){
			$error = _PASSWORDS_UNMATCH;
	} else if ($_POST['action'] == "updateconfig" && $_POST['current_password'] == $admin_password) {
	$fp = fopen("config.php","r");
	while (!feof($fp)){
		$data = fgets($fp, filesize("config.php"));
            if (substr($data,0,10) == '$namaadmin') {
                $output[] = "\$namaadmin = \"".trim($_POST['new_namaadmin'])."\";\n";
			} else if (substr($data,0,9) == '$adminweb') {
				$output[] = "\$adminweb = \"".trim($_POST['new_adminweb'])."\";\n";
			} else if (substr($data,0,5) == '$skin') {
				$output[] = "\$skin = \"".trim($_POST['new_skin'])."\";\n";
			} else if (substr($data,0,9) == '$language') {
				$output[] = "\$language = \"".trim($_POST['new_language'])."\";\n";
			} else if (substr($data,0,13) == '$commentshown') {
				$output[] = "\$commentshown = \"".trim($_POST['new_commentshown'])."\";\n";
			} else if (substr($data,0,12) == '$allowedtags') {
				$output[] = "\$allowedtags = \"".trim($_POST['new_allowedtags'])."\";\n";
			} else if (substr($data,0,9) == '$maxchars') {
				$output[] = "\$maxchars = \"".trim($_POST['new_maxchars'])."\";\n";
			} else if (substr($data,0,5) == '$keep') {
				$output[] = "\$keep = \"".trim($_POST['new_keep'])."\";\n";
			} else if (substr($data,0,9) == '$lastlogs') {
				$output[] = "\$lastlogs = \"".trim($_POST['new_lastlogs'])."\";\n";
			} else if (substr($data,0,11) == '$autologout') {
				$output[] = "\$autologout = \"".trim($_POST['new_autologout'])."\";\n";
			} else if (substr($data,0,11) == '$deletetime') {
				$output[] = "\$deletetime = \"".trim($_POST['new_deletetime'])."\";\n";
			} else if (substr($data,0,10) == '$floodwait') {
				$output[] = "\$floodwait = \"".trim($_POST['new_floodwait'])."\";\n";
			} else if (substr($data,0,18) == '$textwrappingwidth') {
				$output[] = "\$textwrappingwidth = \"".trim($_POST['new_textwrappingwidth'])."\";\n";
			} else if (substr($data,0,18) == '$wrappingseparator') {
				$output[] = "\$wrappingseparator = \"".$_POST['new_wrappingseparator']."\";\n";
			} else if (substr($data,0,14) == '$useHTMLencode') {
				$output[] = "\$useHTMLencode = \"".trim($_POST['new_useHTMLencode'])."\";\n";
			} else if (substr($data,0,12) == '$require_uri') {
				$output[] = "\$require_uri = \"".trim($_POST['new_require_uri'])."\";\n";
			} else if (substr($data,0,13) == '$sendcomments') {
				$output[] = "\$sendcomments = \"".trim($_POST['new_sendcomments'])."\";\n";
			} else if (substr($data,0,13) == '$emailaddress') {
				$output[] = "\$emailaddress = \"".trim($_POST['new_emailaddress'])."\";\n";
			} else if (substr($data,0,11) == '$dateformat') {
				$output[] = "\$dateformat = \"".trim($_POST['new_dateformat'])."\";\n";
			} else if (substr($data,0,4) == '$gmt') {
				$output[] = "\$gmt = \"".trim($_POST['new_gmt'])."\";\n";
			} else if (substr($data,0,16) == '$secret_question') {
				$output[] = "\$secret_question = \"".trim($_POST['new_secret_question'])."\";\n";
			} else if (substr($data,0,14) == '$secret_answer') {
				$output[] = "\$secret_answer = \"".trim($_POST['new_secret_answer'])."\";\n";
			} else if (substr($data,0,15) == '$admin_password' && $_POST['changepassword'] != "" && $_POST['changepassword'] == $_POST['changepassword_confirm']) {
					$output[] = "\$admin_password = \"".trim($_POST['changepassword'])."\";\n";
					writeLogs_php($_SERVER["REMOTE_ADDR"],"_LOG_CHANGE_PASS",$admin_password." -> ".$_POST['changepassword']);
            } else {//nothing happened
				$output[] = $data;
			}
	}//end while
        fclose($fp);
        $fp = fopen("config.php","w");
		if($fp){
        foreach ($output as $data){
            fwrite ($fp, $data);
			$message = _CONF_UPDATED;
        }
		} else {
			$error = _ERROR_WRITE_CONF;
		}
  } else if ($_POST['action'] == "updateconfig" && $_POST['current_password'] == ""){
	$error = _MUST_ENTER_CURRENT_PASSWORD;
  } else if ($_POST['action'] == "updateconfig" && $_POST['current_password'] != $admin_password){
	$error = _INCORRECT_CURRENT_PASSWORD;
  } else {}
} else { // invalid cookie
writeLogs_php($_SERVER["REMOTE_ADDR"],"_LOG_LOGIN_EXPIRED","");
header("Location: admin.php?error="._RELOGIN."");
exit();
}

//re-read the config file
include("config.php");

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

<div class="cpNavOn">
<a href="editconf.php">&nbsp;<?=_CONFIGURATION;?>&nbsp;</a>
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
<span class="crumblinks">
<h2><?=_EDIT_CONFIGURATION?></h2>
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

</table>

<form method="post" action="editconf.php">

<table style="width: 100%;" class="tableBorder" border="0" cellpadding="0" cellspacing="0">
<tbody>

<tr>
<td class="tablePad">

<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="tableHeadingBold">
<?=_PREFERENCE?>
</td>
<td class="tableHeadingBold">
<?=_VALUE?>
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="namaadmin"><?=_NICKNAME?></label>
</div>
<div class="subtext"><?=_NICKNAME_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_namaadmin" id="namaadmin" value="<?=$namaadmin?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>


<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="adminweb"><?=_WEBSITE?></label>
</div>
<div class="subtext"><?=_WEBSITE_SUBTEXT?>.</div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_adminweb" id="adminweb" value="<?=$adminweb?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<?=_SKINS?>
</div>
<div class="subtext"><?=_SKINS_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<select name="new_skin" class="select">
<? optionSkins()?>
</select>
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<?=_LANGUAGES?>
</div>
<div class="subtext"><?=_LANGUAGES_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<select name="new_language" class="select">
<? optionLanguages()?>
</select>
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="commentshown"><?=_AMOUNT_OF_SHOUTS?></label>
</div>
<div class="subtext"><?=_AMOUNT_OF_SHOUTS_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_commentshown" id="commentshown" size="20" maxlength="120" class="input" type="text" value="<?=$commentshown?>">
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="allowedtags"><?=_ALLOWED_TAGS?></label>
</div>
<div class="subtext"><?=_ALLOWED_TAGS_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_allowedtags" id="allowedtags" size="20" maxlength="120" class="input" type="text" value="<?=$allowedtags?>">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="maxchars"><?=_MAXCHARS?></label>
</div>
<div class="subtext"><?=_MAXCHARS_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_maxchars" id="maxchars" size="20" maxlength="120" class="input" type="text" value="<?=$maxchars?>">
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="keep">
<?=_KEEP?>
</label>
</div>
<div class="subtext"><?=_KEEP_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_keep" id="keep" value="<?=$keep?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="lastlogs">
<?=_KEEP_LOGS?>
</label>
</div>
<div class="subtext"><?=_KEEP_LOGS_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_lastlogs" id="lastlogs" value="<?=$lastlogs?>" size="20" maxlength="120" class="input" type="text">
</select>
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="autologout"><?=_AUTOLOGOUT?></label>
</div>
<div class="subtext"><?=_AUTOLOGOUT_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_autologout" id="autologout" value="<?=$autologout?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="deletetime"><?=_DELETE_TIME?></label>
</div>
<div class="subtext"><?=_DELETE_TIME_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_deletetime" id="deletetime" value="<?=$deletetime?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="floodwait"><?=_FLOOD_PROT?></label>
</div>
<div class="subtext"><?=_FLOOD_PROT_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_floodwait" id="floodwait" value="<?=$floodwait?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="textwrappingwidth"><?=_TEXT_WRAPPING_WIDTH?></label>
</div>
<div class="subtext"><?=_TEXT_WRAPPING_WIDTH_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_textwrappingwidth" id="textwrappingwidth" value="<?=$textwrappingwidth?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="wrappingseparator"><?=_WRAPPING_SEPARATOR?></label>
</div>
<div class="subtext"><?=_WRAPPING_SEPARATOR_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_wrappingseparator" id="wrappingseparator" value="<?=$wrappingseparator?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<?=_URI_REQUIRED?>
</div>
<div class="subtext"><?=_URI_REQUIRED_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<label class="hand" for="new_require_uri_yes">&nbsp;<?=_YES?>&nbsp;<input id="new_require_uri_yes" class='radio' type='radio' name='new_require_uri' value='yes' <?if($require_uri=="yes"){$checked="checked='checked'";echo $checked;}?> /></label>&nbsp;&nbsp;
<label class="hand" for="new_require_uri_no">&nbsp;<?=_NO?>&nbsp;<input id="new_require_uri_no" class='radio' type='radio' name='new_require_uri' value='no' <?if($require_uri=="no"){$checked="checked='checked'";echo $checked;}?>  />
</label>&nbsp;&nbsp;&nbsp;
</td>
</tr>


<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<?=_USE_HTML_ENCODE?>
</div>
<div class="subtext"><?=_USE_HTML_ENCODE_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<label class="hand" for="new_useHTMLencode_yes">&nbsp;<?=_YES?>&nbsp;<input id="new_useHTMLencode_yes" class='radio' type='radio' name='new_useHTMLencode' value='yes' <?if($useHTMLencode=="yes"){$checked="checked='checked'";echo $checked;}?> /></label>&nbsp;&nbsp;
<label class="hand" for="new_useHTMLencode_no">&nbsp;<?=_NO?>&nbsp;<input id="new_useHTMLencode_no" class='radio' type='radio' name='new_useHTMLencode' value='no' <?if($useHTMLencode=="no"){$checked="checked='checked'";echo $checked;}?> />
</label>&nbsp;&nbsp;&nbsp;
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<?=_SEND_TO_EMAIL?>
</div>
<div class="subtext"><?=_SEND_TO_EMAIL_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<label class="hand" for="new_sendcomments_yes">&nbsp;<?=_YES?>&nbsp;<input id="new_sendcomments_yes" class='radio' type='radio' name='new_sendcomments' value='yes' <?if($sendcomments=="yes"){$checked="checked='checked'";echo $checked;}?> /></label>&nbsp;&nbsp;
<label class="hand" for="new_sendcomments_no">&nbsp;<?=_NO?>&nbsp;<input id="new_sendcomments_no" class='radio' type='radio' name='new_sendcomments' value='no' <?if($sendcomments=="no"){$checked="checked='checked'";echo $checked;}?> />
</label>&nbsp;&nbsp;&nbsp;
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="emailaddress"><?=_EMAIL_ADDRESS?></label>
</div>
<div class="subtext"><?=_EMAIL_ADDRESS_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_emailaddress" id="emailaddress" value="<?=$emailaddress?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="dateformat"><?=_DATE_FORMAT?></label>
</div>
<div class="subtext"><?=_DATE_FORMAT_SUBTEXT?>.</div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_dateformat" id="dateformat" value="<?=$dateformat?>" size="20" maxlength="120" class="input" type="text"><br /><?=_OUTPUT?>: <b><?=formattanggal(time());?></b>
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<?=_TIMEZONE?>
</div>
</td>
<td class="tableCellOne" style="width: 50%;">
<select name="new_gmt" class="select">
<option value="-12" <?if($gmt=="-12"){echo "selected=\"selected\"";}?>>(GMT - 12 Hours) Enitwetok, Kwajalien</option>
<option value="-11" <?if($gmt=="-11"){echo "selected=\"selected\"";}?>>(GMT - 11 Hours) Nome, Midway Island, Samoa</option>
<option value="-10" <?if($gmt=="-10"){echo "selected=\"selected\"";}?>>(GMT - 10 Hours) Hawaii</option>
<option value="-9" <?if($gmt=="-9"){echo "selected=\"selected\"";}?>>(GMT - 9 Hours) Alaska</option>
<option value="-8" <?if($gmt=="-8"){echo "selected=\"selected\"";}?>>(GMT - 8 Hours) Pacific Time</option>
<option value="-7" <?if($gmt=="-7"){echo "selected=\"selected\"";}?>>(GMT - 7 Hours) Mountain Time</option>
<option value="-6" <?if($gmt=="-6"){echo "selected=\"selected\"";}?>>(GMT - 6 Hours) Central Time, Mexico City</option>
<option value="-5" <?if($gmt=="-5"){echo "selected=\"selected\"";}?>>(GMT - 5 Hours) Eastern Time, Bogota, Lima, Quito</option>
<option value="-4" <?if($gmt=="-4"){echo "selected=\"selected\"";}?>>(GMT - 4 Hours) Atlantic Time, Caracas, La Paz</option>
<option value="-3.5" <?if($gmt=="-3.5"){echo "selected=\"selected\"";}?>>(GMT - 3.5 Hours) Newfoundland</option>
<option value="-3" <?if($gmt=="-3"){echo "selected=\"selected\"";}?>>(GMT - 3 Hours) Brazil, Buenos Aires, Georgetown, Falkland Is.</option>
<option value="-2" <?if($gmt=="-2"){echo "selected=\"selected\"";}?>>(GMT - 2 Hours) Mid-Atlantic, Ascention Is., St Helena</option>
<option value="-1" <?if($gmt=="-1"){echo "selected=\"selected\"";}?>>(GMT - 1 Hours) Azores, Cape Verde Islands</option>
<option value="0" <?if($gmt=="0"){echo "selected=\"selected\"";}?>>(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
<option value="1" <?if($gmt=="1"){echo "selected=\"selected\"";}?>>(GMT + 1 Hour) Berlin, Brussels, Copenhagen, Madrid, Paris, Rome</option>
<option value="2" <?if($gmt=="2"){echo "selected=\"selected\"";}?>>(GMT + 2 Hours) Kaliningrad, South Africa, Warsaw</option>
<option value="3" <?if($gmt=="3"){echo "selected=\"selected\"";}?>>(GMT + 3 Hours) Baghdad, Riyadh, Moscow, Nairobi</option>
<option value="3.5" <?if($gmt=="3.5"){echo "selected=\"selected\"";}?>>(GMT + 3.5 Hours) Tehran</option>
<option value="4" <?if($gmt=="4"){echo "selected=\"selected\"";}?>>(GMT + 4 Hours) Adu Dhabi, Baku, Muscat, Tbilisi</option>
<option value="4.5" <?if($gmt=="4.5"){echo "selected=\"selected\"";}?>>(GMT + 4.5 Hours) Kabul</option>
<option value="5" <?if($gmt=="5"){echo "selected=\"selected\"";}?>>(GMT + 5 Hours) Islamabad, Karachi, Tashkent</option>
<option value="5.5" <?if($gmt=="5.5"){echo "selected=\"selected\"";}?>>(GMT + 5.5 Hours) Bombay, Calcutta, Madras, New Delhi</option>
<option value="6" <?if($gmt=="6"){echo "selected=\"selected\"";}?>>(GMT + 6 Hours) Almaty, Colomba, Dhakra</option>
<option value="6.5" <?if($gmt=="6.5"){echo "selected=\"selected\"";}?>>(GMT + 6.5 Hours  ) </option>
<option value="7" <?if($gmt=="7"){echo "selected=\"selected\"";}?>>(GMT + 7 Hours) Bangkok, Hanoi, Jakarta</option>
<option value="8" <?if($gmt=="8"){echo "selected=\"selected\"";}?>>(GMT + 8 Hours) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
<option value="9" <?if($gmt=="9"){echo "selected=\"selected\"";}?>>(GMT + 9 Hours) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
<option value="9.5" <?if($gmt=="9.5"){echo "selected=\"selected\"";}?>>(GMT + 9.5 Hours) Adelaide, Darwin</option>
<option value="10" <?if($gmt=="10"){echo "selected=\"selected\"";}?>>(GMT + 10 Hours) Melbourne, Papua New Guinea, Sydney, Vladivostok</option>
<option value="11" <?if($gmt=="11"){echo "selected=\"selected\"";}?>>(GMT + 11 Hours) Magadan, New Caledonia, Solomon Islands</option>
<option value="12" <?if($gmt=="12"){echo "selected=\"selected\"";}?>>(GMT + 12 Hours) Auckland, Wellington, Fiji, Marshall Island</option>
</select>
<br />
<?=_GMT_IS?>: <?=gmdate('Y-m-d g:i:s a')?>
</td>
</tr>

<tr>
<td class="tableCellTwo" style="width: 50%;">
<div class="defaultBold">
<label for="secret_question"><?=_SECRET_QUESTION?></label>
</div>
<div class="subtext"><?=_SECRET_QUESTION_SUBTEXT?></div>
</td>
<td class="tableCellTwo" style="width: 50%;">
<input style="width: 100%;" name="new_secret_question" id="secret_question" value="<?=$secret_question?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td class="tableCellOne" style="width: 50%;">
<div class="defaultBold">
<label for="secret_answer"><?=_SECRET_ANSWER?></label>
</div>
<div class="subtext"><?=_SECRET_ANSWER_SUBTEXT?></div>
</td>
<td class="tableCellOne" style="width: 50%;">
<input style="width: 100%;" name="new_secret_answer" id="secret_answer" value="<?=$secret_answer?>" size="20" maxlength="120" class="input" type="text">
</td>
</tr>

<tr>
<td>
&nbsp;
</tr>
</td>

<!-- Begin of password change form -->
<tr>
<td  class='tableCellOne'  style='width:100%;' colspan='2'>

<div class='itemWrapper'>

<div class='itemTitle'><label for="changepassword"><?=_PASS_CHANGE_FORM?></label></div>

<div class='itemWrapper'>
<div class='alert'><?=_LEAVE_BLANK?></div>

</div>

</div>

<div class='itemTitle'><?=_NEW_PASS?></div>
<input style='width:300px' type='password' name='changepassword' id='changepassword' value='' size='35' maxlength='32' class='input' />

<div class='itemWrapper'>

<div class='itemTitle'><?=_NEW_PASS_CONFIRM?></div>
<input style='width:300px' type='password' name='changepassword_confirm' id='changepassword_confirm' value='' size='35' maxlength='32' class='input' />

</div>

<div class='highlight'><?=_HAVE_LOG_BACK_IN?></div>

</td>

</tr>
<!-- end of password change form -->

<tr>
<td>
&nbsp;
</tr>
</td>

<!-- Begin of existing password -->
<tr>
<td>
<div class='paddedWrapper'>
<br />
<div class='itemTitle'><label for="current_password"><?=_EXISTING_PASS?></label></div>

<div class='itemWrapper'>
<div class='highlight'><?=_SUBMIT_CURRENT_PASS?></div>
</div>
<input style="width:310px" type="password" name="current_password" id="current_password" value="" size="35" maxlength="32" class="input" />

<div class='itemWrapper'>
<br />

</div>

</div>
</td>
</tr>
<!-- End of existing password -->

</tbody></table>


</td>
</tr>
</tbody></table>


<div class="default" align="right"><br>
<input type="hidden" name="action" value="updateconfig" />
<input value="<?=_UPDATE?>" class="submit" type="submit" />
</div>
</form>

<?
include("./includes/footer.inc.php");
?>