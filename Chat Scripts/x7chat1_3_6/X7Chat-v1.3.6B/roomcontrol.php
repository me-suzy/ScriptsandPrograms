<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.0 Beta		   				     //          
//		Released February 2, 2004		     				 //
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

?>
<?
$isbase = "set";
require("config.php");
if(!isset($action)){
$action = "null"; 
}
if($XUSER['LEVEL'] < 3){
$head = $txt[2];
$body = $txt[78];
$action = "null";
}
if($action == "doban" && isset($kickonly) && $PERMISSIONS['Kick'] == 1){
$head = $txt[2];
$body = $txt[79];
$action = "null";
}
if($action == "doban" && !isset($kickonly) && $PERMISSIONS['Ban'] == 1){
$head = $txt[2];
$body = $txt[80];
$action = "null";
}

?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>X7 Chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="The X7 Group">
<meta http-equiv="content-language" content="en">
<META NAME="copyright" content="2003 By The X7 Group">
<META NAME="rating" content="general">
</head>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
if($action == "" || !isset($action)){
$head = $txt[2];
$body = $txt[81];
}elseif($action == "sysmessage"){
if($PERMISSIONS['Send_Sys_Message'] == 1){
$head = $txt[82];
$body = "$txt[83]<Br><Br>
<form action=\"\">
$txt[84]<input type=\"text\" name=\"message\" size=\"40\">
<input type=\"hidden\" name=\"action\" value=\"sndsysmsg\">
 <input type=\"submit\" value=\"$txt[85]\">
</form>
<Br><Br>";
}else{
$head = $txt[2];
$body = $txt[86];
}
}elseif($action == "sndsysmsg"){
if($PERMISSIONS['Send_Sys_Message'] == 1){
sendsysmsg($message);
$head = $txt[87];
$body = "$txt[88]<Br><Br><a href=\"index.php\">$txt[6]</a>";
}else{
$head = $txt[2];
$body = $txt[86];
}
}elseif($action == "iplookup"){
if($XUSER['LEVEL'] >= 3 && $PERMISSIONS['Lookup_Ips'] != 1){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
$ips = "";
while($row = Do_Fetch_Row($q)){
$ips .= "$row[1]: $row[2]<Br>";
}
$head = "$txt[89]";
$body = "$txt[90]<Br><Br>$ips<Br><Br><a href=\"index.php\">$txt[6]</a>";
}else{
$head = $txt[89];
$body = "$txt[388]<Br><Br><a href=\"index.php\">$txt[6]</a>";
}
}elseif($action == "ban"){
$kicknames = "<Br>";
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
while($row = Do_Fetch_Row($q)){
$kicknames .= "<a href=\"roomcontrol.php?action=doban&kickonly=true&user=$row[1]\">$row[1]</a><Br>";
}
$unbannames = "<Br>";
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]bans WHERE room='$ROOMS[IN_ROOM_NAME]'");
while($row = Do_Fetch_Row($q)){
if($row[2] != ""){
$unbannames .= "<a href=\"roomcontrol.php?action=doban&user=$row[2]&unban=true\">$row[2]</a><Br>";
}else{
$unbannames .= "<a href=\"roomcontrol.php?action=doban&user=$row[3]&isip=true&unban=true\">$row[3]</a><Br>";
}
}

$head = $txt[93];
$body = "$txt[94]<Br><Br>
<form action=\"roomcontrol.php\" method=\"post\">
<input type=\"hidden\" name=\"action\" value=\"doban\">
$txt[95]<input type=\"text\" name=\"ip\"><Br>$txt[96]<Br>
$txt[12]&nbsp; <input type=\"text\" name=\"username\"><br><Br>
<input type=\"submit\" value=\"$txt[99]\">
</form><Br><Br><Br>
$txt[97]
$kicknames<Br><Br><Br>
$txt[98]
$unbannames<Br><Br><Br>
";
}elseif($action == "doban"){
if(isset($unban)){
mnotice($user,9);
$head = $txt[100];
$body = "$txt[101]<Br><Br><a href=\"index.php\">$txt[6]</a>";
if(isset($isip)){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='$ROOMS[IN_ROOM_NAME]' && ip='$user'");
}else{
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='$ROOMS[IN_ROOM_NAME]' && name='$user'");
}
}else{
if(isset($kickonly)){
$head = $txt[102];
$body = "$txt[103]<Br><Br><a href=\"index.php\">$txt[6]</a>";
$time = time();
$user = strip($user);
mnotice($user,7);
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','$ROOMS[IN_ROOM_NAME]','$user','','$time','60')");
}else{
$head = $txt[104];
$body = "$txt[105]<Br><Br><a href=\"index.php\">$txt[6]</a>";
$time = time();
if($ip == ""){
$username = strip($username);
mnotice($username,8);
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','$ROOMS[IN_ROOM_NAME]','$username','','$time','0')");
}else{
$ip = strip($ip);
mnotice($ip,8);
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','$ROOMS[IN_ROOM_NAME]','','$ip','$time','0')");
}
}
}
}elseif($action == "viewlog"){
	$head = $txt[419];
if($XUSER['LEVEL'] != 3 && $XUSER['LEVEL'] != 4 && $XUSER['LEVEL'] != 5){
	$body = $txt[420];
}else{
	$logsize = @filesize("Logs/$ROOMS[IN_ROOM_NAME].log");
	$maxsize = $SERVER['MAXLOG'];
	$percentage = round($logsize/$maxsize*100);
	if($percentage == "")
		$percentage = 0;
	$txt[423] = eregi_replace("%p","$percentage",$txt[423]);
	if($percentage >= 100){
		$spaceinfo = $txt[424];
	}else{
		$spaceinfo = $txt[423];
	}
	$log = readLog($ROOMS['IN_ROOM_NAME']);
	$log = codeparse($log);
	$log = eregi_replace("\n","<Br>",$log);
	$body = "<div align=\"left\">".$log."<Br><Br>$spaceinfo<Br><Br><a href=\"index.php\">$txt[6]</a>";
}

}elseif($action == "roomset"){
$temp = eregi_replace("\\\\'","'",$ROOMS['IN_ROOM_NAME']);
$body = "<Br>
<form action=\"roomcontrol.php\" method=\"post\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[27]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$temp</td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[28]</td>
<td width=\"350\" bgcolor=\"$CS[2]\">
<select name=\"type\">
<option value=\"1\"";
if($ROOMS['TYPE'] == "Public"){
$body .= " SELECTED";
}
$body .= ">$txt[29]</option>";


if($PERMISSIONS['CR_Private'] != 1){
$body .= "<option value=\"2\"";
if($ROOMS['TYPE'] != "Public"){
$body .= " SELECTED";
}
$body .= ">$txt[30]</option>";
}

$body .= "</select>
</td>
</tr>";
if($PERMISSIONS['CR_Moderated'] == 0){
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[31]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"moded\" value=\"1\"";
if($ROOMS['MODED'] == "1"){
$body .= " CHECKED";
}
$body .= "></td>
</tr>";
}
$body .="<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[32]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"topic\" value=\"$ROOMS[TOPIC]\"></td>
</tr>

<tr valign=\"center\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[417]:<Br>$txt[418]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"greeting\" value=\"$ROOMS[GREETING]\"></td>
</tr>

<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[13]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"password\" name=\"password\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[33]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"maxusers\" value=\"$ROOMS[MAX_USERS]\"></td>
</tr>";
if($PERMISSIONS['CR_NeverExpire'] == 1){
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[34]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"neverexp\" value=\"1\" ";
if($ROOMS['TIME'] != 0){
$body .= "></td>
</tr>";
}else{
$body .= " CHECKED></td>
</tr>";
}
}
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
<input type=\"hidden\" name=\"action\" value=\"setroom\">
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></td>
</tr>
</table>
</div>
</td></tr></table>
</form>";
$head = $txt[171];

}elseif($action == "setroom"){
if(!isset($moded))
$moded = "";
if(!isset($neverexp))
$neverexp = "";
if($SERVER['ENABLE_NEWROOM'] == 1 && $XUSER['LEVEL'] <= 3){
$body = "$txt[5]<Br><Br>";
$donotmake = "set";
}
if($PERMISSIONS['CR_Private'] == 1 && $type==2){
$body = "$txt[37]<Br><Br>";
$donotmake = "set";
}
if($PERMISSIONS['CR_Moderated'] == 1 && $moded==1){
$body = "$txt[38]<Br><Br>";
$donotmake = "set";
}
if($password == ""){
$password = $ROOMS['PASSWORD'];
}
if($password == "" && $type==2){
$body = "$txt[172]<Br><Br>";
$donotmake = "set";
}
if($maxusers == "" || $maxusers < 2 || eregi("[A-z]",$maxusers)){
$maxusers == 2;
}
$head = $txt[2];
if(!isset($donotmake)){
if($moded != 1){
$moded=0;
}

if($PERMISSIONS['CR_NeverExpire'] == 1){
if($neverexp == 1){
$time = 0;
}else{
$time = time();
}
}else{
$time = time();
}

$type = strip($type);
$moded = strip($moded);
$topic = strip($topic);
$topic = eregi_replace("'","\\'",$topic);
$greeting = strip($greeting);
$greeting = eregi_replace("'","\\'",$greeting);
$password = strip($password);
$maxusers = strip($maxusers);
$tq = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE name='$ROOMS[IN_ROOM_NAME]'");
$trow = Do_Fetch_Row($tq);

if($type == 1 && $trow[2] != 1){
mnotice("",11);
}elseif($type == 2 && $trow[2] != 2){
mnotice("",10);
}
if($topic != $trow[6]){
mnotice($topic,12);
}
if($maxusers != $trow[8]){
mnotice($maxusers,13);
}

if($moded != $trow[5] && $moded == 1){
mnotice("",14);
}elseif($moded != $trow[5] && $moded != 1){
mnotice("",15);
}

$q = DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET type='$type', ban='$greeting', encrypted='', moderated='$moded', topic='$topic', password='$password', maxusers='$maxusers', time='$time' WHERE name='$ROOMS[IN_ROOM_NAME]'");
$temp = eregi_replace("\\\\'","'",$ROOMS['IN_ROOM_NAME']);
$head = "$txt[173] $temp";
$body = "$txt[174]<a href=\"index.php\">$txt[6]</a>";
}
}elseif($action == "makeop"){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE id='$userid'");
$row = Do_Fetch_Row($q);
if($row[4] != 4 && $row[4] != 5 && strlen($XUSER['LEVEL']) == 1){
$isop = 0;
}elseif($row[4] == "3$ROOMS[id]"){
$isop = 1;
}else{
$isop = 2;
}
$tempuser = $row[1];
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE username='$row[1]'");
$row = Do_Fetch_Row($q);
if($row[3] != $ROOMS['IN_ROOM_NAME']){
$isop = 2;
}
if($isop == 2){
$head = $txt[175];
$body = "$txt[176]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";

}elseif($isop == 1){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='1' WHERE id='$userid'");
mnotice($tempuser,4);
$head = $txt[177];
$body = "$txt[178]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";

}elseif($isop == 0){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE name='$ROOMS[IN_ROOM_NAME]'");
$row = Do_Fetch_Row($q);
$roomid = $row[0];
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='3$roomid' WHERE id='$userid'");
mnotice($tempuser,3);
$head = $txt[179];
$body = "$txt[180]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";
}
}elseif($action == "makeadmin"){
if($PERMISSIONS['Make_Admins'] == 1){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE id='$userid'");
$row = Do_Fetch_Row($q);
if($row[4] >= 4){
$time = time();
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='1',time='$time' WHERE id='$userid'");
mnotice($row[1],2);
$head = "$txt[181]";
$body = "$txt[182]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";
}else{
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='4',time='0' WHERE id='$userid'");
mnotice($row[1],1);
$head = "$txt[183]";
$body = "$txt[184]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";
}
}
}elseif($action == "voice"){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE id='$userid'");
$row = Do_Fetch_Row($q);
$q3 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE username='$row[1]'");
$row3 = Do_Fetch_Row($q3);
if($row3[3] != $ROOMS['IN_ROOM_NAME']){
$head = $txt[2];
$body = $txt[185];
}else{
if($row[4] < 4 && $row[11] != $ROOMS['id']){
mnotice($row[1],5);
$head = $txt[186];
$body = "$txt[187]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET voice='$ROOMS[id]' WHERE id='$userid'");
}elseif($row[11] == $ROOMS['id']){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET voice='' WHERE id='$userid'");
mnotice($row[1],6);
$head = $txt[188];
$body = "$txt[189]<Br><Br><a href=\"index.php\">$txt[6]</a><br><Br>";
}else{
$head = $txt[2];
$body = $txt[176];
}
}
}

?>
<?
printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div></font>","<div align=\"center\">$body<Br><Br></div>","$CS[1]","$CS[2]","$CS[3]");
?>
<Br><Br><Br>
<div align="center"><font size="2">Powered By <a href="http://www.x7chat.com/" target="_blank">X7 Chat</a> 1.3.6B<Br>&copy; 2004 By The <a href="http://www.x7chat.com/" target="_blank">X7 Group</a></font></div>
</body>
</html>
