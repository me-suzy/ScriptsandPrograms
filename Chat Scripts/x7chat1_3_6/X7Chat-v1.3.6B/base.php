<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.4 Beta		   				     //          
//		Released March 24, 2004		     				 //
//		Copyright (c) 2004 By the X7 Group	    			 //
//		Website: http://www.x7chat.com		     			 //
//							   							     //
//		This program is free software.  You may	     		 //
//		modify and/or redistribute it under the	    		 //
//		terms of the included license as written    		 //
//		and published by the X7 Group.		    			 //
//							   							     //
//		By using this software you agree to the	    		 //
//		terms and conditions set forth in the	    		 //
//		enclosed file "license.txt".  If you did     		 //
//		not recieve the file "license.txt" please    	     //
//		visist our website and obtain an official    		 // 
//		copy of X7 Chat.		           				     //
//							    							 //
//		Removing this copyright and/or any other    		 //
//		X7 Group or X7 chat copyright from any	    		 //
//		of the files included in this distribution  		 //
//		is forbidden and doing so will terminate    		 //
//		your right to use this software.	     			 //
//							     							 //
///////////////////////////////////////////////////////////////

$X7CHATV = "1.3.4";
ob_start();

set_magic_quotes_runtime(0);

// A very fast register_globals work around, will be changed in next version
@import_request_variables("gpc");
if(ini_get("magic_quotes_gpc") == 1){
if(isset($msg)){
 $msg = eregi_replace(".'","'",$msg);
 $msg = eregi_replace(".\"","\"",$msg);
}
}

// Quick Anti-Notice bug fix
error_reporting(7);

if(!isset($isbase)){
$isbase = "notset";
}
if($isbase == "set"){
@require("Language/$SERVER[LANGUAGE].lng");
@require("lib/$DATABASE[TYPE].php");
@require("AuthMod/$SERVER[AUTH].php");
@require("lib/html.php");
@require("functions.php");
@setcookie("COOKIESND","lookyiamset",time()-14000000,"$SERVER[PATH]");
$imgpath = "./images";
}else{
// Language
@require("../Language/$SERVER[LANGUAGE].lng");
@require("../functions.php");
@require("../lib/html.php");
@require("../lib/$DATABASE[TYPE].php");
@require("../AuthMod/$SERVER[AUTH].php");
$imgpath = "../images";
}

DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
DoSelectDb($DATABASE['DATABASE']);

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]settings");
while($row = Do_Fetch_Row($q)){
if($row[2] == ""){
$row[2] = 0;
}
$vak = $row[1];
$GOT[$vak] = $row[2]; 

}
$SERVER['ENABLE_CHAT'] = $GOT['ed_chat'];
$SERVER['ENABLE_REG'] = $GOT['ed_registration'];
$SERVER['ENABLE_NEWROOM'] = $GOT['ed_newroom'];
$SERVER['ENABLE_PRIVATENR'] = $GOT['ed_newroomprivate'];
$SERVER['ENABLE_AVAS'] = $GOT['ed_avatars'];
//$SERVER['ENABLE_ENCRYPTION'] = $GOT['ed_encryption'];
$SERVER['EXP_ROOMS'] = $GOT['exp_room'];
$SERVER['TIMEEXP_ROOMS'] = time() - $SERVER['EXP_ROOMS'];
$SERVER['EXP_USER'] = $GOT['exp_user'];
$SERVER['TIMEXP_USER'] = time() - $SERVER['EXP_USER'];
$SERVER['EXP_MSG'] = $GOT['exp_msg'];
$SERVER['TIMEEXP_MSG'] = time() - $SERVER['EXP_MSG'];
$SERVER['MAX_IN_ROOM'] = $GOT['max_inrooms'];
$SERVER['MAX_ROOMS'] = $GOT['max_rooms'];
$SERVER['MAX_USERS'] = $GOT['max_total'];
$SERVER['MAX_IDLE'] = $GOT['max_idletime'];
$SERVER['EXP_ONLINE'] = time() - $SERVER['MAX_IDLE'];
$SERVER['MAX_MPS'] = $GOT['max_mps'];
$SERVER['ENABLE_SOUNDS'] = $GOT['ed_sounds'];
$STYLE['ENABLE_LINK'] = $GOT['ed_links'];
$STYLE['ENABLE_STYLE'] = $GOT['ed_style'];
$STYLE['ENABLE_SMILE'] = $GOT['ed_smile'];
$SERVER['NEWS'] = $GOT['news'];
$SERVER['MAXLOG'] = $GOT['maxlog'];
$SERVER['DEFAULT_BAND_LIMIT'] = $GOT['defband'];
$SERVER['SERVER_OFFSET'] = $GOT['serveroffset'];

$CS['BGIMAGE'] = $GOT['bgimage'];
if($CS['BGIMAGE'] == "0")
	$CS['BGIMAGE'] = "";
$CS['WIN_BG1'] = $GOT['style_winbg1'];
$CS['WIN_BG2'] = $GOT['style_winbg2'];
$CS[1] = $GOT['style_cs1'];
$CS[3] = $GOT['style_cs2'];	// a.k.a. Border Color
$CS[2] = $GOT['style_cs3'];
$CS['CHATBG'] = $GOT['style_msgboxbg'];
$CS['FONTLT'] = $GOT['style_ltfont'];
$CS['FONTDK'] = $GOT['style_dkfont'];
$CS['FONTDT'] = $GOT['style_deffont'];
$CS['SYSMSG'] = $GOT['style_sysmsg'];
$CS['OTHERNAME'] = $GOT['style_otherusers'];
$CS['YOURNAME'] = $GOT['style_youruser'];


if($changevars['UE'] == 1){
	$SERVER['EXP_USER'] = 0;
}

// $notauthorized - 1 = not logged in, 2 = incorrect pass, 0 = authorization ok
$notauthorized=1;
$tempusername = @$_COOKIE[$AUTH['COOKIE_USERNAME']];
$temppassword = @$_COOKIE[$AUTH['COOKIE_PASSWORD']];

if(isset($doxlogin) && $X2CHATU != "" && $X2CHATP != ""){
	// Do first time login
	$tempusername = $X2CHATU;	// DO NOT CHANGE THESE
	$temppassword = doXEncrypt($X2CHATP);	// THEY ARE CORRECT!!!
	@setcookie($AUTH['COOKIE_USERNAME'],"$tempusername",time()+14000000,"$SERVER[PATH]");
	@setcookie($AUTH['COOKIE_PASSWORD'],"$temppassword",time()+14000000,"$SERVER[PATH]");
	
}


if(isset($tempusername) || isset($temppassword) && ($temppassword != "" && $tempusername != "")){
	$pass = getPass($tempusername);
	if($temppassword == $pass){
		$notauthorized = 0;
		@setcookie($AUTH['COOKIE_USERNAME'],"$tempusername",time()+14000000,"$SERVER[PATH]");
		@setcookie($AUTH['COOKIE_PASSWORD'],"$temppassword",time()+14000000,"$SERVER[PATH]");
	}else{
		$notauthorized = 2;
		forceexit($X2CHATR,$X2CHATU);
		@setcookie($AUTH['COOKIE_USERNAME'],"",time()-14000000,"$SERVER[PATH]");
		@setcookie($AUTH['COOKIE_PASSWORD'],"",time()-14000000,"$SERVER[PATH]");
		@setcookie("X2CHATR","",time()-14000000,"$SERVER[PATH]");
		@setcookie("XLU","",time()-14000000,"$SERVER[PATH]");
	}
}

if(isset($dologout)){
	$tempusername = "";
	$temppassword = "";
	forceexit($X2CHATR,$_COOKIE[$AUTH['COOKIE_USERNAME']]);
	@setcookie($AUTH['COOKIE_USERNAME'],"",time()-14000000,"$SERVER[PATH]");
	@setcookie($AUTH['COOKIE_PASSWORD'],"",time()-14000000,"$SERVER[PATH]");
	@setcookie("X2CHATR","",time()-14000000,"$SERVER[PATH]");
	@setcookie("XLU","",time()-14000000,"$SERVER[PATH]");
}

/*
$notauthorized=2;
if(!isset($X2CHATU) || !isset($X2CHATP)){
$notauthorized=1;
}elseif(@$X2CHATP == "" || @$X2CHATP == ""){
$notauthorized=2;
}else{
$row[2] = getPass($X2CHATU);
if($row[2] == doXEncrypt($X2CHATP)){
$notauthorized=0;
@setcookie("X2CHATU","$X2CHATU",time()+14000000,"$SERVER[PATH]");
@setcookie("X2CHATP","$X2CHATP",time()+14000000,"$SERVER[PATH]");
if(isset($dologout)){
forceexit($X2CHATR,$X2CHATU);
@setcookie("X2CHATU","$X2CHATU",time()-14000000,"$SERVER[PATH]");
@setcookie("X2CHATP","$X2CHATP",time()-14000000,"$SERVER[PATH]");
@setcookie("X2CHATR","$X2CHATR",time()-14000000,"$SERVER[PATH]");
@setcookie("XLU","null",time()-14000000,"$SERVER[PATH]");
}
}
}
*/

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online");
$totalonline = 0;
$youalready = 0;
while($row = Do_Fetch_Row($q)){
$totalonline++;
if($row[1] == $tempusername){
$youalready = 1;
}
}

if($totalonline > $SERVER['MAX_USERS'] && $youalready == 0 && $SERVER['MAX_USERS'] != 0){
$terminalerror2 = "1";
}


$XUSER['IP'] = getenv("REMOTE_ADDR");
if($notauthorized == 0){

$XUSER['NAME'] = $tempusername;
///////////////////////////////////////////////////////////////
//THESE ARE DIFFERENT FOR EACH USER

// User Levels
// 0: not logged in
// 1: regulare user
// 2: voiced
// 3: Room Op
// >=4: Server Admin
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$XUSER[NAME]'");
$row = Do_Fetch_Row($q);
$XUSER['ID'] = $row[0];
$XUSER['LEVEL'] = $row[4];
$XUSER['STATUS'] = $row[10];
$XUSER['VOICED'] = $row[11];
$XUSER['TEMP'] = $row[13];
$XUSER['TIME'] = $row[12];


$k = 1; $i = 0; $s = 0; $r[0] = "";
$XUSER['TEMP'] = "$XUSER[TEMP]!";
while($k){
$sub = substr($XUSER['TEMP'],$i,1);
if($sub == "!"){
$k = 0;
break;
}
if($sub == ","){
$s++;
}else{
@$r[$s] = @$r[$s].$sub;
}
$i++;
}

$XUSER['COOKIE_TIME'] = $r[0];
$XUSER['REFRESH'] = $r[1];
if($r[2]==0){
$STYLE['ENABLE_STYLE'] = 1;
}
if($r[3]==0){
$STYLE['ENABLE_SMILE'] = 1;
}
$XUSER['TIMESTAMP'] = $r[4];
$XUSER['FLOOD'] = $r[5];
$XUSER['ACPT_PRIVATE'] = $r[6];
$XUSER['OFFSET'] = $r[7];
if($r[8] == 1){
$SERVER['ENABLE_SOUNDS'] = 1;
}
$XUSER['POPUPPM'] = $r[9];

if(isset($changeroom)){
if($room != @$X2CHATR && $room != ""){
enterroom($room);
$senduseragreeting = 1;
@exitroom($X2CHATR);
}
$X2CHATR = $room;
@setcookie("X2CHATR","$room",time()+14000000,"$SERVER[PATH]");
}

if((@$X2CHATR == "" || !isset($X2CHATR)) && !isset($croom1) && !isset($croom2)){
$listrooms = true;
}

$ROOMS['IN_ROOM_NAME'] = @strip($X2CHATR);
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE name='$ROOMS[IN_ROOM_NAME]'");
$row = Do_Fetch_Row($q);
$ROOMS['id'] = $row[0];
if($row[2]==1){
$ROOMS['TYPE'] = "Public";
}else{
$ROOMS['TYPE'] = "Private";
}
if($row[3]==1){
$ROOMS['LOG'] = "1";		// Used to be ENCRYPTED but since encryption isn't supported I use this field for logging
}else{
$ROOMS['LOG'] = "0";
}
$ROOMS['GREETING'] = $row[4];
if($row[5]==1){
$ROOMS['MODED'] = "1";
}else{
$ROOMS['MODED'] = "0";
}
$ROOMS['TOPIC'] = $row[6];
$ROOMS['PASSWORD'] = $row[7];
$ROOMS['MAX_USERS'] = $row[8];
$ROOMS['TIME'] = $row[9];


if(isset($senduseragreeting) && $ROOMS['GREETING'] != "" && $ROOMS['GREETING'] != "null"){
	$ROOMS['GREETING'] = eregi_replace("'","\\'",$ROOMS['GREETING']);
	$ROOMS['GREETING'] = eregi_replace("%u",$XUSER['NAME'],$ROOMS['GREETING']);
	$ROOMS['GREETING'] = eregi_replace("%d",date("F d, Y"),$ROOMS['GREETING']);
	$ROOMS['GREETING'] = eregi_replace("%t",date("g:i:s"),$ROOMS['GREETING']);
	sendsysmsgto($ROOMS['GREETING'],"$XUSER[NAME]:PRIV");
}

///////////////////////////////////////////////////////////////
if($ROOMS['MAX_USERS'] > $SERVER['MAX_IN_ROOM'] && $SERVER['MAX_IN_ROOM'] != 0){
$ROOMS['MAX_USERS'] = $SERVER['MAX_IN_ROOM'];
}
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
$total = 0;
while($row = Do_Fetch_Row($q)){
$total++;
}
$total++;
if($total > $ROOMS['MAX_USERS'] && $ROOMS['IN_ROOM_NAME'] != ""){
$terminalerror1 = "maxusersreached";
}

$SERVER['CURRENT_TIME'] = time();
$XUSER['IP'] = getenv("REMOTE_ADDR");
$CS['WIN_BG_2']=$CS['WIN_BG2']."\" text=\"".$CS['FONTDK'];
$CS['WIN_BG_1']=$CS['WIN_BG1']."\" text=\"".$CS['FONTDK'];
if(!isset($dologout)){
iamhere();
}
$RV = showtotals();
$ONLINE['USERS'] = $RV[1];
$ONLINE['ADMIN'] = $RV[0];
$ROOMS['TOTAL_ROOMS'] = $RV[2];
}else{
}

DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE name='' AND ip=''");
$q = @DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]bans WHERE room='$ROOMS[IN_ROOM_NAME]' || room='*'");
$banned = 0;
while($row = Do_Fetch_Row($q)){
if($row[5] != "" && $row[5] != 0){
$exptime = $row[4]+$row[5];
$time = time();
if(time() >= $exptime){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE id='$row[0]'");
}
}
if($row[2] == $XUSER['NAME'] && $row[2] != ""){
$banned = 1;
}elseif($row[3] == $XUSER['IP']){
$banned = 1;
}
if($banned == 1){
if($row[1] == "*"){
print("$txt[283]");
exit;
}else{
$listrooms = "true";
$ban = "1";
}
}
}


if(@$ROOMS['PASSWORD'] != "" && $listrooms != "true"){
if(!isset($X7CROOMP)){
$roomloginreq = "set";
$pincorrect = "set";
}else{
if($X7CROOMP == $ROOMS['PASSWORD']){
@setcookie("X7CROOMP","$X7CROOMP",time()+3600,"$SERVER[PATH]");
}else{
@setcookie("X7CROOMP","$X7CROOMP",time()-3600,"$SERVER[PATH]");
$listrooms = "set";
$pincorrect = "set";
}
}
}



// Do  User Authentication proccess

if(@$XUSER['LEVEL'] < 4 && @strlen($XUSER['LEVEL']) == 1){
$XUSER['LEVEL'] = 1;
}elseif(@strlen($XUSER['LEVEL']) > 1){
$q = ifroomop();
if($q == 1){
$XUSER['LEVEL'] = 3;
}else{
$XUSER['LEVEL'] = 1;
}
}else{
}
if(@$XUSER['LEVEL'] == 1){
$q = ifvoice();
if($q == 1){
$XUSER['LEVEL'] = 2;
}else{
$XUSER['LEVEL'] = 1;
}
}

// Do Permissions Junk
$templevel = 0;
if($XUSER['LEVEL'] == 1){
$templevel = 1;
}elseif($XUSER['LEVEL'] == 2){
$templevel = 1;
}elseif($XUSER['LEVEL'] == 3){
$templevel = 1;
}elseif($XUSER['LEVEL'] == 4){
$templevel = 4;
}elseif($XUSER['LEVEL'] == 5){
$templevel = 5;
}else{
$templevel = 0;
}

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='$XUSER[NAME]'");
$row = Do_Fetch_Row($q);
if($row[0] == ""){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='DEFAULT_$templevel'");
$row = Do_Fetch_Row($q);
}
$PERMISSIONS['CreateRoom'] = $row[2];	// index*
$PERMISSIONS['CR_NeverExpire'] =$row[3];	// index*. room control*
$PERMISSIONS['CR_Private'] = $row[4];	// index*, room control*, IRC*
$PERMISSIONS['CR_Moderated'] = $row[5];	// index*, room control*, IRC*
$PERMISSIONS['Make_Admins'] = $row[6]; // roomcontrol*, IRC2**
$PERMISSIONS['Give_Ops_Own'] = $row[7]; // index*
$PERMISSIONS['Give_Ops_All'] = $row[8]; // base.php*
$PERMISSIONS['Lookup_Ips'] = $row[9]; // roomcontrol*, LC*
$PERMISSIONS['Kick'] = $row[10]; // roomcontrol*, IRC*, LC*
$PERMISSIONS['Ban'] = $row[11]; // roomcontrol*, IRC2**, LC*
$PERMISSIONS['Server_Ban'] = $row[12]; // index*, admin*
$PERMISSIONS['Send_Sys_Message'] = $row[13]; // roomcontrol*, IRC*
$PERMISSIONS['Edit_Settings'] = $row[14];	// admin*, index*
$PERMISSIONS['Edit_Styles'] = $row[15];	 // admin*, index*
$PERMISSIONS['Edit_Permissions'] = $row[16];	// admin*, index*
$PERMISSIONS['Edit_Users'] = $row[17];	// admin*, index*
$PERMISSIONS['Edit_Room'] = $row[18];	// admin*, index*
$PERMISSIONS['Edit_Smilies'] = $row[19];	// admin*, index*
$PERMISSIONS['Edit_Filter'] = $row[20];		// admin*, index*
$PERMISSIONS['Edit_Bandwidth'] = $row[21];		// admin*, index*

// Ok Permissions junk put into variables -- if 5 || 0 then do something special
if($templevel == 5){
$PERMISSIONS['CreateRoom'] = 0;
$PERMISSIONS['CR_NeverExpire'] = 1;
$PERMISSIONS['CR_Private'] = 0;
$PERMISSIONS['CR_Moderated'] = 0;
$PERMISSIONS['Make_Admins'] = 1;
$PERMISSIONS['Give_Ops_Own'] = 1;
$PERMISSIONS['Give_Ops_All'] = 1;
$PERMISSIONS['Lookup_Ips'] = 0;
$PERMISSIONS['Kick'] = 0;
$PERMISSIONS['Ban'] = 0;
$PERMISSIONS['Server_Ban'] = 1;
$PERMISSIONS['Send_Sys_Message'] = 1;
$PERMISSIONS['Edit_Settings'] = 1;
$PERMISSIONS['Edit_Styles'] = 1;
$PERMISSIONS['Edit_Permissions'] = 1;
$PERMISSIONS['Edit_Users'] = 1;
$PERMISSIONS['Edit_Room'] = 1;
$PERMISSIONS['Edit_Smilies'] = 1;
$PERMISSIONS['Edit_Filter'] = 1;
$PERMISSIONS['Edit_Bandwidth'] = 1;
}elseif($templevel == 0){
$PERMISSIONS['CreateRoom'] = 1;
$PERMISSIONS['CR_NeverExpire'] = 0;
$PERMISSIONS['CR_Private'] = 1;
$PERMISSIONS['CR_Moderated'] = 1;
$PERMISSIONS['Make_Admins'] = 0;
$PERMISSIONS['Give_Ops_Own'] = 0;
$PERMISSIONS['Give_Ops_All'] = 0;
$PERMISSIONS['Lookup_Ips'] = 1;
$PERMISSIONS['Kick'] = 1;
$PERMISSIONS['Ban'] = 1;
$PERMISSIONS['Server_Ban'] = 0;
$PERMISSIONS['Send_Sys_Message'] = 0;
$PERMISSIONS['Edit_Settings'] = 0;
$PERMISSIONS['Edit_Styles'] = 0;
$PERMISSIONS['Edit_Permissions'] = 0;
$PERMISSIONS['Edit_Users'] = 0;
$PERMISSIONS['Edit_Room'] = 0;
$PERMISSIONS['Edit_Smilies'] = 0;
$PERMISSIONS['Edit_Filter'] = 0;
$PERMISSIONS['Edit_Bandwidth'] = 0;
}

if($PERMISSIONS['Give_Ops_All'] == 1 && $XUSER['LEVEL'] != 5 && $XUSER['LEVEL'] != 4){
	$XUSER['LEVEL'] = 3;
}


if($SERVER['ENABLE_CHAT'] == 1 && $XUSER['LEVEL'] < 4 && $notauthorized!=1){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$head = "$txt[284]";
$body = "$txt[285]";

printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div></font>","
<div align=\"Center\">$body
<Br><Br></div>",$CS[1],$CS[2],$CS[3]);
exit;
}

$roomsifplusedbyone = 0;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms");
while($row = Do_Fetch_Row($q)){
$roomsifplusedbyone++;
}

if(@$XUSER['LEVEL'] >= 4 && @$terminalerror2 == 1){
$terminalerror2 = 0;
}

cleanPMS();		// Sick function name but what it does is clear the Private Messages

// Begin buffer flush to users web browser, this is done so that the login 
// works correctly and they do not get HEADER OUTPUT errors.  Editing this
// line will cause login to fail
ob_end_flush();
eval(base64_decode("JGNoZWF0aW5nID0gMDsKaWYoJGNmID0gQGZpbGUoImxpYi9odG1sLnBocCIpKXsKCSRjZiA9IGltcGxvZGUoIiIsJGNmKTsKCWlmKCFlcmVnaSgiPGRpdiBhbGlnbj1cImNlbnRlclwiPjxmb250IHNpemU9XCIyXCI+UG93ZXJlZCBCeSA8YSBocmVmPVwiaHR0cDovL3d3dy54N2NoYXQuY29tL1wiIHRhcmdldD1cIl9ibGFua1wiPlg3IENoYXQ8L2E+IDEuMy42QjxCcj4mY29weTsgMjAwNCBCeSBUaGUgPGEgaHJlZj1cImh0dHA6Ly93d3cueDdjaGF0LmNvbS9cIiB0YXJnZXQ9XCJfYmxhbmtcIj5YNyBHcm91cDwvYT48L2ZvbnQ+PC9kaXY+IiwkY2YpKXsKCQkkY2hlYXRpbmcgPSAxOwoJfQp9CmlmKCRjZiA9IEBmaWxlKCJmcmFtZXMvbmV3LnRvcC5waHAiKSl7CgkkY2YgPSBpbXBsb2RlKCIiLCRjZik7CglpZighZXJlZ2koIjxkaXYgYWxpZ249XCJjZW50ZXJcIj48Zm9udCBzaXplPVwiMlwiPlBvd2VyZWQgQnkgPGEgaHJlZj1cImh0dHA6Ly93d3cueDdjaGF0LmNvbS9cIiB0YXJnZXQ9XCJfYmxhbmtcIj5YNyBDaGF0PC9hPiAxLjMuNkI8QnI+JmNvcHk7IDIwMDQgQnkgVGhlIDxhIGhyZWY9XCJodHRwOi8vd3d3Lng3Y2hhdC5jb20vXCIgdGFyZ2V0PVwiX2JsYW5rXCI+WDcgR3JvdXA8L2E+PC9mb250PjwvZGl2PiIsJGNmKSl7CgkJJGNoZWF0aW5nID0gMTsKCX0KfQppZigkY2hlYXRpbmcgPT0gMSkKCWVjaG8gIlRoZSBzY3JpcHQgaGFzIGRldGVjdGVkIHRoYXQgdGhlIFg3IENoYXQgY29weXJpZ2h0IHdhcyBpbGxlZ2FsbHkgcmVtb3ZlZC4gIElmIHlvdSBiZWxpZXZlIHlvdSBhcmUgZ2V0dGluZyB0aGlzIG1lc3NhZ2UgaW4gZXJyb3IgcGxlYXNlIHZpc2l0IG91ciBmb3J1bSBhdCBodHRwOi8vZm9ydW0ueDdjaGF0LmNvbS8gYW5kIHJlcG9ydCBpdC4iOw=="));
// Check if user has exceeded bandwidth limit.

$bused = logBandwidth(0);
if($bused == 0){
		$bandwidtherror = 1;
}

// Thats it for this file
?> 
 
