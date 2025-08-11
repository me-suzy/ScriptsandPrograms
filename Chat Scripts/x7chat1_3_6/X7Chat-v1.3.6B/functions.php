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
?>
<?
// Removed People who have gone offline without signing out
function cleanOnline(){
global $XUSER, $SERVER, $ROOMS;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online");
while($row = Do_Fetch_Row($q)){
if($row[4] <= $SERVER['EXP_ONLINE']){
forceexit($row[3],$row[1]);
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]online WHERE id=$row[0]");
}
}
}

function strip($logintime){
$logintime = eregi_replace("<","",$logintime);
$logintime = eregi_replace(">","",$logintime);
return $logintime;
}

function listrooms($font=""){
global $XUSER, $SERVER, $ROOMS, $CS, $txt;
if($font == ""){
$font = $CS['FONTLT'];
$target = "";
$dots = "";
}else{
$dots = "../";
$font = $CS['FONTDK'];
$target = "target=\"_parent\"";
}
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE type!=2");
$r = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
$r .= "<tr>
<td width=\"200\"><B>$txt[251]</b></td>
<td width=\"300\"><b>$txt[252]</b></td>
<td width=\"100\"><b>$txt[253]</b></td>
</tr>";
while($row = Do_Fetch_Row($q)){
$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$row[1]' AND username!='$XUSER[NAME]'");
$totals=0;
while($row2 = Do_Fetch_Row($q2)){
$totals++;
}
$curroomname = $row[1];
$row[1] = eregi_replace("'","\'",$row[1]);
$r .= "<tr>
<td width=\"200\"><a href=\"{$dots}index.php?changeroom=set&room=$row[1]\" $target><font color=\"$font\">$curroomname</font></a></td>
<td width=\"300\">$row[6]</td>
<td width=\"100\">$totals</td>
</tr>";
}
$r .= "</table>";
return $r;
}

function cleanusers(){
global $SERVER, $ROOMS;
if($SERVER['EXP_USER'] != 0){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users");
while($row = Do_Fetch_Row($q)){
if($row[12] <= $SERVER['TIMEXP_USER'] && $row[12] != 0){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]users WHERE id=$row[0]");
}
}
}
}

// Places People into the online table
function iamhere(){
global $XUSER, $SERVER, $ROOMS;
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]online WHERE username='$XUSER[NAME]'");
cleanOnline();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]online VALUES('0','$XUSER[NAME]','$XUSER[IP]','$ROOMS[IN_ROOM_NAME]','$SERVER[CURRENT_TIME]')");
$time = time();
if($ROOMS['TIME'] != 0){
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET time='$time' WHERE name='$ROOMS[IN_ROOM_NAME]'");
}
if($XUSER['TIME'] != 0){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET time='$time' WHERE username='$XUSER[NAME]'");
}
cleanusers();
}


// returns an array with total users,admins and rooms
function showtotals(){
global $XUSER, $SERVER, $ROOMS;
cleanOnline();
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online");
$RV[0] = 0; $RV[1] = 0; $RV[2] = 0;
while($row = Do_Fetch_Row($q)){
$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$row[1]'");
$row2 = Do_Fetch_Row($q2);
if($row2[4] == 4 || $row2[4] == 5){
$RV[0]++;
}else{
$RV[1]++;
}
}
cleanRooms();
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms");
while($row = Do_Fetch_Row($q)){
$RV[2]++;
}
return $RV;
}

function cleanmsgs(){
global $XUSER, $SERVER, $ROOMS;
if($SERVER['EXP_MSG'] != 0){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]messages");
while($row = Do_Fetch_Row($q)){
if($row[3] <= $SERVER['TIMEEXP_MSG']){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]messages WHERE id=$row[0]");
}
}
}
}

// clean your room. :) lol, removes expired rooms
function cleanRooms(){
global $XUSER, $SERVER, $ROOMS;
if($SERVER['EXP_ROOMS'] != 0){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms");
while($row = Do_Fetch_Row($q)){
if($row[9] <= $SERVER['TIMEEXP_ROOMS'] && $row[9] != 0 && $SERVER['EXP_ROOMS'] != 0){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]rooms WHERE id=$row[0]");
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]messages WHERE room='$row[1]'");
}
}
}
}


function cleanPMS(){
global $SERVER;
$time = time()-4;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]pmsessions WHERE time<=$time");
while($row = Do_Fetch_row($q)){
	DoQuery("DELETE FROM $SERVER[TBL_PREFIX]pmsessions WHERE id='$row[0]'");
}
}


function printinroom(){
global $XUSER, $SERVER, $ROOMS, $CS, $PERMISSIONS, $txt;
cleanOnline();
cleanRooms();

$xtimes = 0;
function doRollover($link,$imagename){
	global $xtimes;
	$xtimes++;
	$returnt = "<a href=\"$link\"><img src=\"./images/menu_{$imagename}_1.gif\" border=\"0\" name=\"$imagename$xtimes\" onMouseOver=\"javascript: document.$imagename$xtimes.src='./images/menu_{$imagename}_2.gif'\" onMouseOut=\"javascript: document.$imagename$xtimes.src='./images/menu_{$imagename}_1.gif'\"></a><Br>";
	return $returnt;
}

$vreturn[0] = ""; $vreturn[1] = 0;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]' ORDER BY time DESC");
while($row = Do_Fetch_Row($q)){
$ip = $row[2];
// Get permissions for user and generate user menu
$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]ignore WHERE user='$XUSER[NAME]' AND toignore='$row[1]'");
$row2 = Do_Fetch_Row($q2);
if($row2[0] != "")
	$ignore = 1;
else
	$ignore = 0;
	
$q2 = DoQuery("SELECT id,moderated FROM $SERVER[TBL_PREFIX]rooms WHERE name='$ROOMS[IN_ROOM_NAME]'");
$row2 = Do_Fetch_Row($q2);
$roomid = $row2[0];
$roommoderated = $row2[1];

$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$row[1]'");
$row2 = Do_Fetch_Row($q2);

$need = "3$roomid";
$isaop = 0;
$isadmin = 0;
if($row2[4] == 4 || $row2[4] == 5){
	$isadmin = 1;
}elseif($row2[4] == $need){
	$isaop = 1;
}

$makeadmins = 0;
if($PERMISSIONS['Make_Admins'] == 1)
	$makeadmins = 1;

$canvoice = 0;
$canop = 0;
$canban = 0;
$cankick = 0;
if($PERMISSIONS['Give_Ops_All'] == 1 || $XUSER['LEVEL'] == 3){
	$canvoice = 1;
	$canop = 1;
	if($PERMISSIONS['Ban'] != 1){
		$canban = 1;
	}
	if($PERMISSIONS['Kick'] != 1){
		$cankick = 1;
	}
}

$hasvoice = 0;
if($row2[4] == 5 || $row2[4] == 5 || $isaop == 1 || $row2[11] == "$roomid"){
	$hasvoice = 1;
}

$pms = 0;
if($XUSER['POPUPPM'] == 1){
	$pms = 1;
}

$isaway = "";
if($row2[10] == 2){
	$isaway = " $txt[333]";
}

$canviewip = 0;
if($PERMISSIONS['Lookup_Ips'] == 0 AND $XUSER['LEVEL'] > 2){
	$canviewip = 1;		// Print the IP address
}

$xtimes++;

$imageid = "";
if($isaop == 1){
	$imageid = "<img src=\"./images/op.png\" width=\"15\" height=\"15\">";
}elseif($isadmin == 1){
	$imageid = "<img src=\"./images/op.png\" width=\"15\" height=\"15\">";
}

$vreturn[0] .= "
<tr valign=\"top\">
	<td width=\"5\" height=\"18\">&nbsp;</td>
	<td width=\"20\" height=\"18\" style=\"border-bottom: 1px solid $CS[3];border-left: 1px solid $CS[3]; border-right: 1px solid $CS[3];\"><a OnClick=\"javascript:popUserMenu(event,'d$row[0]')\"><img src=\"./images/user_menu.gif\" name=\"arrow$xtimes\" onMouseOver=\"javascript: this.src='./images/user_menu_over.gif'\" onMouseOut=\"javascript: this.src='./images/user_menu.gif';\" width=\"20\" height=\"18\" border=\"0\" style=\"cursor:pointer\"></a></td>
	<td width=\"175\" bgcolor=\"$CS[2]\" height=\"18\" style=\"border-bottom: 1px solid $CS[3];border-right: 1px solid $CS[3];\">&nbsp;<font size=\"3\">$imageid $row[1]$isaway</font></td>
</tr>
<div class=\"tt\" id=\"d$row[0]\">";
$session = time().strlen($row[1]);
if($ignore == 1)
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=unignore&doto=$row[1]","unignore");
else
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=ignore&doto=$row[1]","ignore");
	
if($pms == 1)
	$vreturn[0] .= doRollover("frame.php?page=right.middle\" onClick=\"javascript: sinkUserMenu(event,'d$row[0]');window.open('frames/privatemessage.php?user=$row[1]','PM$session','width=600,height=300');\"","pm");
else
	$vreturn[0] .= doRollover("frame.php?page=left.bottom&privto=$row[1]\" onClick=\"javascript: sinkUserMenu(event,'d$row[0]')\" target=\"left_bot","pm");
	
if($makeadmins == 1 && $isadmin == 0){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=gadmin&doto=$row[1]","makeadmin");
}elseif($makeadmins == 1 && $isadmin == 1){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=tadmin&doto=$row[1]","removeadmin");
}

if($canban == 1){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=ban&doto=$row[1]","ban");
}

if($cankick == 1){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=kick&doto=$row[1]","kick");
}

if($canvoice == 1 && $hasvoice == 0){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=gvoice&doto=$row[1]","givevoice");
}elseif($canvoice == 1 && $hasvoice == 1){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=tvoice&doto=$row[1]","takevoice");
}

if($canop == 1 && $isaop != 1 && $isadmin != 1){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=gop&doto=$row[1]","makeop");
}elseif($canop == 1 && $isaop == 1 && $isadmin != 1){
	$vreturn[0] .= doRollover("frame.php?page=right.middle&umaction=top&doto=$row[1]","removeop");
}

if($canviewip == 1){
	$vreturn[0] .= doRollover("#1\" onClick=\"javascript: alert('$row[1]\'s Ip Address is: $ip')\"","viewip");
}

$vreturn[0] .= doRollover("index.php?viewprofile=$row[1]\" target=\"_parent","profile");

$vreturn[0] .= "
	<a onClick=\"javascript: sinkUserMenu(event,'d$row[0]')\"><img src=\"./images/menu_close_1.gif\" border=\"0\" name=\"close$xtimes\" onMouseOver=\"javascript: document.close$xtimes.src='./images/menu_close_2.gif'\" onMouseOut=\"javascript: document.close$xtimes.src='./images/menu_close_1.gif'\"></a><Br></div>";

$vreturn[0] .= "</div>";

$vreturn[1]++;
}
return $vreturn;
}

function codeparse($message){
global $XUSER, $SERVER, $ROOMS, $STYLE;
// The Following X7CODE can be used in X7Chat
// [color=#000000][/color]
// [i][/i]
// [u][/u]
// [b][/b]
// [size=1-7][/size]
// [font][/font]
// smilies
$message = eregi_replace("'","\\'",$message);
$message = eregi_replace("<","&lt;",$message);
if($STYLE['ENABLE_STYLE'] == 1){
$message = eregi_replace("\[size=.\]","",$message);
$message = eregi_replace("\[color=.{7}\]","",$message);
$message = eregi_replace("\[.\]","",$message);
$message = eregi_replace("\[/.\]","",$message);
$message = eregi_replace("\[/size\]","",$message);
$message = eregi_replace("\[/color\]","",$message);
$message = eregi_replace("\[/font\]","",$message);

while(eregi("\[font=[A-z]*\]",$message,$match)){
$found = $match[0];
if($found != ""){
$len = strlen($match[0])-7;
$sub = substr($match[0],6,$len);
$sub = strtolower($sub);
if($sub != "arial" && 
$sub != "helvetica" && 
$sub != "courier" &&
$sub != "geneva" &&
$sub != "impact" &&
$sub != "tahoma" &&
$sub != "verdana"
)
	$font = "serif";
else
	$font = $sub;
$message = eregi_replace("\[font=$sub\]","",$message);

}else{
}
}

}else{
// Look for size
while(eregi("\[size=[1-7]\]",$message,$match)){
$found = $match[0];
if($found != ""){
$sub = substr($match[0],6,1);
$message = eregi_replace("\[size=$sub\]","<font size=\"$sub\">",$message);
}else{
}
}
$match[0] = "";

while(eregi("\[color=.......\]",$message,$match)){
$found = $match[0];
if($found != ""){
$sub = substr($match[0],7,7);
$message = eregi_replace("\[color=$sub\]","<font color=\"$sub\">",$message);
}else{
}
}
$match[0] = "";

while(eregi("\[font=[A-z]*\]",$message,$match)){
$found = $match[0];
if($found != ""){
$len = strlen($match[0])-7;
$sub = substr($match[0],6,$len);
$sub = strtolower($sub);
if($sub != "arial" && $sub != "helvetica" && $sub != "courier")
	$font = "serif";
else
	$font = $sub;
$message = eregi_replace("\[font=$sub\]","<font style=\"font-family: $font\">",$message);

}else{
}
}
$match[0] = "";


$message = eregi_replace("\[/size\]","</font>",$message);
$message = eregi_replace("\[/color\]","</font>",$message);
$message = eregi_replace("\[/font\]","</font>",$message);
$message = eregi_replace("\[i\]","<i>",$message);
$message = eregi_replace("\[/i\]","</i>",$message);
$message = eregi_replace("\[b\]","<b>",$message);
$message = eregi_replace("\[/b\]","</b>",$message);
$message = eregi_replace("\[u\]","<u>",$message);
$message = eregi_replace("\[/u\]","</u>",$message);
}

if($STYLE['ENABLE_LINK'] == 0){
$message = eregi_replace("http:/","http://",$message);

$message = preg_replace("#(http://|www.)([^\s|<]*)#i","<a href=\"http://$2\" target=\"_blank\">$1$2</a>",$message);

if(isset($nmessage)){
$message = $nmessage;
}

}else{
// do nothing
}

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]filter");
while($row = Do_Fetch_row($q)){
if($row[1] == 1 && $STYLE['ENABLE_SMILE'] == 0){
$message = eregi_replace($row[2],"<img src=\"$row[3]\">",$message);
}elseif($row[1] == 2){
$message = eregi_replace("$row[2]","$row[3]",$message);
}
}



$message .= "</font></a></i></b></u>";
return $message;
}


function getprivatemessages($update){
global $XUSER, $SERVER, $ROOMS, $txt, $messages, $CS;
$update = $update-1;
$update2 = time();
$messages = 0;

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]messages WHERE room='$XUSER[NAME]:PRIV' AND time>$update AND time<$update2 ORDER BY time ASC");
while($row = Do_Fetch_Row($q)){
$ignore = 0;
$q1 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]ignore WHERE user='$XUSER[NAME]' AND toignore='$row[2]'");
$row1 = Do_Fetch_Row($q1);
if($row1[0] == ""){
$messages = 1;
}else{
$ignore = 1;
} 
if($update <= 0){
$ignore = 1;
}

if($ignore != 1){
if($return[$row[2]] == ""){
$return[$row[2]] = "<font color=\"$CS[OTHERNAME]\"><b>$row[2]";
}else{
$return[$row[2]] .= "<font color=\"$CS[OTHERNAME]\"><b>$row[2]";
}

if($XUSER['TIMESTAMP'] == 0){
$timestamp = "[";
$temp_timestamp = date("g",$row[3])+$XUSER['OFFSET'];
$timestamp .= $temp_timestamp;	
$timestamp .= date(":i:s",$row[3]);
$timestamp .= "]";
$return[$row[2]] .= "$timestamp";
}
$return[$row[2]] .= "</b>:</font> &nbsp; ";

$return[$row[2]] .= codeparse($row[5]);
$return[$row[2]] .= "<Br>";
}
}
$return['number_messages_o'] = $messages;
return $return;
}


function getmessages($update){
global $XUSER, $SERVER, $ROOMS, $txt, $messages, $CS;
$update = $update-1;
$update2 = time();
$messages = 0;
$xtest = "";
if($XUSER['POPUPPM'] != 1){
$xtest = "OR room='$XUSER[NAME]:PRIV' AND time>$update AND time<$update2";
}
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]messages WHERE time>$update AND time<$update2 AND room='$ROOMS[IN_ROOM_NAME]' $xtest OR room='*' AND time>$update AND time<$update2 OR room='$XUSER[NAME]:PRIV' AND time>$update AND time<$update2 AND user='System' ORDER BY time ASC");
while($row = Do_Fetch_Row($q)){
$ignore = 0;
$q1 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]ignore WHERE user='$XUSER[NAME]' AND toignore='$row[2]'");
$row1 = Do_Fetch_Row($q1);
if($row1[0] == ""){
$messages = 1;
}else{
$ignore = 1;
} 
if($row[2] == $XUSER['NAME']){
$ignore = 1;
}
if($update == 0){
$ignore = 0;
}
if($row[5] == "$XUSER[NAME]$txt[255]" && $update == 0){
$ignore = 1;
}

if($ignore != 1){
if($row[4] != 0){
if($row[2] == $XUSER['NAME']){
print("<b><font color=\"$CS[YOURNAME]\">$row[2]");
if($XUSER['TIMESTAMP'] == 0){
$timestamp = "[";
$temp_timestamp = date("g",$row[3])+$XUSER['OFFSET'];
$timestamp .= $temp_timestamp;
$timestamp .= date(":i:s",$row[3]);
$timestamp .= "]";
print("$timestamp");
}
print("</b>:</font> &nbsp; ");
}else{
print("<font color=\"$CS[OTHERNAME]\"><b>$row[2]");
if($XUSER['TIMESTAMP'] == 0){
$timestamp = "[";
$temp_timestamp = date("g",$row[3])+$XUSER['OFFSET'];
$timestamp .= $temp_timestamp;	
$timestamp .= date(":i:s",$row[3]);
$timestamp .= "]";
print("$timestamp");
}
print("");
if($row[1] == "$XUSER[NAME]:PRIV"){
print("[$txt[30]]</b>:</font> &nbsp; ");
}else{
print("</b>:</font> &nbsp; ");
}
}

echo codeparse($row[5]);
print("<Br>");
}else{
print("&nbsp; <font color=\"$CS[SYSMSG]\"><b><i>$row[5]</i></b></font><Br>");
}
}
}
}

function sendmsg($message){
global $XUSER, $SERVER, $ROOMS, $txt;
if($ROOMS['MODED']==1&&$XUSER['LEVEL']<=1){
$pe = $txt[254];
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$XUSER[NAME]:PRIV','System','$SERVER[CURRENT_TIME]','1','$pe')");

}
if(!isset($pe)){
$tmessage = eregi_replace("'","\\'",$message);
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$ROOMS[IN_ROOM_NAME]','$XUSER[NAME]','$SERVER[CURRENT_TIME]','1','$tmessage')");
if($ROOMS['LOG'] == 1)
	writeLog($XUSER['NAME'],$message,$ROOMS['IN_ROOM_NAME']);
}
}

function sendprivatemsg($message,$to){
global $XUSER, $SERVER, $ROOMS;
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$to:PRIV','$XUSER[NAME]','$SERVER[CURRENT_TIME]','1','$message')");
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]pmsessions WHERE user='$to' AND fromuser='$XUSER[NAME]'");
$row = Do_Fetch_Row($q);
if($row[0] == ""){
	$time = time();
	DoQuery("INSERT INTO $SERVER[TBL_PREFIX]pmsessions VALUES('0','$to','$XUSER[NAME]','$time','0')");
}
}

function ignore($user){
global $XUSER, $SERVER, $ROOMS;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]ignore WHERE user='$XUSER[NAME]' AND toignore='$user'");
$row = Do_Fetch_Row($q);
if($row[0] != ""){
$already = 1;
}else{
$already = 0;
}

if($already == 1){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]ignore WHERE user='$XUSER[NAME]' AND toignore='$user'");
return 1;
}else{
$time = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]ignore VALUES('0','$XUSER[NAME]','$user','$time','')");
return 2;
}
}

function sendsysmsg($message){
global $XUSER, $SERVER, $ROOMS;
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','*','System','$SERVER[CURRENT_TIME]','0','$message')");
}

function sendsysmsgto($message,$to){
global $XUSER, $SERVER, $ROOMS;
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$to','System','$SERVER[CURRENT_TIME]','0','$message')");
}

function enterroom($room){
global $XUSER, $SERVER, $txt;
$SERVER['CURRENT_TIME'] = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$room','System','$SERVER[CURRENT_TIME]','0','$XUSER[NAME]$txt[255]')");
}

function exitroom($room){
global $XUSER, $SERVER, $txt;
$SERVER['CURRENT_TIME'] = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$room','System','$SERVER[CURRENT_TIME]','0','$XUSER[NAME]$txt[256]')");
}

function forceexit($room,$user){
global $XUSER, $SERVER, $txt;
$SERVER['CURRENT_TIME'] = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$room','System','$SERVER[CURRENT_TIME]','0','$user$txt[256]')");
$q = DoQuery("SELECT id FROM $SERVER[TBL_PREFIX]online WHERE username='$user'");
$row = Do_Fetch_Row($q);
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]online WHERE id=$row[0]");
}

function invite($invite,$room){
global $XUSER, $SERVER, $ROOMS, $txt;
$message = "$XUSER[NAME]$txt[257] <a href=\"../index.php?changeroom=set&room=$room\" target=\"_parent\">$room</a>";
sendsysmsgto($message,"$invite:PRIV");
}

function ifroomop(){
global $XUSER, $SERVER, $ROOMS;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE name='$ROOMS[IN_ROOM_NAME]'");
$row = Do_Fetch_Row($q);
$needed = "3".$row[0];
if($XUSER['LEVEL'] == $needed){
return 1;
}else{
return 0;
}
}

function ifvoice(){
global $XUSER, $SERVER, $ROOMS;
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE name='$ROOMS[IN_ROOM_NAME]'");
$row = Do_Fetch_Row($q);
$needed = $row[0];
if($XUSER['VOICED'] == $needed){
return 1;
}else{
return 0;
}
}


function irc($command){
global $XUSER, $SERVER, $ROOMS, $OPERATOR, $CS, $PERMISSIONS;
// The following IRC commands are implemented
// unban
// devoice
// join
// mdeop
// names
// unignore
// voice
// kick
// mkick
// op
// away
// back
// ignore
// wallchop
// ban
// deop
// invite
// topic
// wallchan
// msg
// admin
// deadmin
//       mode
//  // +-s,+-p = Private, Public
//  // +-m = moded
//  // +-l <number> = user limit, number if +
//  // +-b = ban
//  // +-v = voice
//  // +-o = op
//  // +-i = ignore
//  // +-a = Admin/noadmin
$command = eregi_replace("/","",$command);
$commando = eregi_replace("/","",$command);
$i = 0;
while($token = strtok($command," ")){
$command = @eregi_replace("$token","",$command);
$cmd[$i] = $token;
$i++;
}

$command2 = "6439547".$commando;
$token = strtok($command2," ");
$command2 = @eregi_replace("$token ","",$command2);
if($cmd[0] != "wallchop" && $cmd[0] != "topic" && $cmd[0] != "wallchan" && $cmd[0] != "mode" && $cmd[0] != "join" && $cmd[0] != "me"){
$command2 = "6439547".$command2;
$token = strtok($command2," ");
$command2 = @eregi_replace("$token","",$command2);
}
$cmd[3] = $command2;

$cmd[1] = strip($cmd[1]);
$qa = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$cmd[1]'");
$rowa = do_Fetch_row($qa);
if($rowa[4] == 4 || $rowa[4] == 5){
$wuza = 1;
}
$noauth = 0;
if($XUSER['LEVEL'] < 3){
$noauth = 1;
}

// Start looking for the command the user ran
if($cmd[0] == "unban" && $noauth != 1){
mnotice($cmd[1],9);
if(eregi(".*\..*\..*\..*",$cmd[1])){
$isip = 1;
}
if(isset($isip)){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='$ROOMS[IN_ROOM_NAME]' && ip='$cmd[1]'");
}else{
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='$ROOMS[IN_ROOM_NAME]' && name='$cmd[1]'");
}
}elseif($cmd[0] == "devoice" && $noauth != 1 && !isset($wuza)){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE username='$cmd[1]'");
$row = Do_Fetch_Row($q);
if($row[3] == $ROOMS['IN_ROOM_NAME']){
$q = DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET voice='' WHERE username='$cmd[1]'");
mnotice($cmd[1],6);
}
}elseif($cmd[0] == "join"){
sendsysmsgto("To join $cmd[3] <a href=\"../index.php?changeroom=set&room=$cmd[3]\" target=\"_parent\">Click Here</a>.","$XUSER[NAME]:PRIV");
}elseif($cmd[0] == "help"){
function disp($mess_txt){
global $CS, $XUSER;
$mess_txt = eregi_replace("\r\n","",$mess_txt);
$mess_txt = eregi_replace("\n","",$mess_txt);
sendsysmsgto("$mess_txt","$XUSER[NAME]:PRIV");
}

if($cmd[1] == ""){
disp("This server accepts the following commands: ");
disp("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"75\">unban</td>
<td width=\"75\">devoice</td>
<td width=\"75\">join</td>
<td width=\"75\">mdeop</td>
<td width=\"75\">names</td>
<td width=\"75\">unignore</td>
</tr>
<tr>
<td width=\"75\">voice</td>
<td width=\"75\">kick</td>
<td width=\"75\">mkick</td>
<td width=\"75\">op</td>
<td width=\"75\">away</td>
<td width=\"75\">back</td>
</tr>
<tr>
<td width=\"75\">ignore</td>
<td width=\"75\">wallchop</td>
<td width=\"75\">ban</td>
<td width=\"75\">deop</td>
<td width=\"75\">invite</td>
<td width=\"75\">topic</td>
</tr>
<tr>
<td width=\"75\">wallchan</td>
<td width=\"75\">msg</td>
<td width=\"75\">admin</td>
<td width=\"75\">deadmin</td>
<td width=\"75\">mode</td>
<td width=\"75\">list</td>
</tr>
<tr>
<td width=\"75\">me</td>
<td width=\"75\">&nbsp;</td>
<td width=\"75\">&nbsp;</td>
<td width=\"75\">&nbsp;</td>
<td width=\"75\">&nbsp;</td>
<td width=\"75\">&nbsp;</td>
</tr>
</table>");
disp("For more information type /help <i>command</i>");
disp("Certain Commands may not be accepted if you do not have correct authorization.");
}elseif($cmd[1] == "unban"){
disp("Command: unban<Br>
Syntax: /unban <i>username</i><Br>
Action: Unbans a username or IP address from the chat room.");
}elseif($cmd[1] == "devoice"){
disp("Command: devoice<Br>
Syntax: /devoice <i>username</i><Br>
Action: Takes away a users voice so they can no longer send messages in a moderated chat room.");
}elseif($cmd[1] == "join"){
disp("Command: join<Br>
Syntax: /join <i>room name</i><Br>
Action: Gives you a link to change to room <i>room name</i>.");
}elseif($cmd[1] == "mdeop"){
disp("Command: mdeop<Br>
Syntax: /mdeop<Br>
Action: Mass De-Ops the entire room.  De-Ops all other ops but you.");
}elseif($cmd[1] == "names"){
disp("Command: names<Br>
Syntax: /names<Br>
Action: Prints the usernames of people in chat with you.");
}elseif($cmd[1] == "unignore"){
disp("Command: unignore<Br>
Syntax: /unignore <i>username</i><Br>
Action: Unignores the user with username <i>username</i>.");
}elseif($cmd[1] == "voice"){
disp("Command: voice<Br>
Syntax: /voice <i>username</i><Br>
Action: Gives user <i>username</i> a voice.  This allows them to send messages to a moderated chat room");
}elseif($cmd[1] == "kick"){
disp("Command: kick<Br>
Syntax: /kick <i>username</i><Br>
Action: This will kick (remove) a user from chat.");
}elseif($cmd[1] == "mkick"){
disp("Command: mkick<Br>
Syntax: /mkick<Br>
Action: This kicks all users in the chat room out except for you.");
}elseif($cmd[1] == "op"){
disp("Command: op<Br>
Syntax: /op <i>username</i><Br>
Action: Gives <i>username</i> operator status in the current chat room.");
}elseif($cmd[1] == "away"){
disp("Command: away<Br>
Syntax: /away<Br>
Action: Sets your current status as away.");
}elseif($cmd[1] == "back"){
disp("Command: back<Br>
Syntax: /back<Br>
Action: Sets your current stats as present.");
}elseif($cmd[1] == "ignore"){
disp("Command: ignore<Br>
Syntax: /ignore <i>username</i><Br>
Action: Ignores <i>username</i>, you will no longer recieve messages from <i>username</i>");
}elseif($cmd[1] == "wallchop"){
disp("Command: wallchop<Br>
Syntax: /wallchop <i>message</i><Br>
Action: Sends <i>message</i> to all the operators in the current chat room.");
}elseif($cmd[1] == "ban"){
disp("Command: ban<Br>
Syntax: /ban <i>username</i><Br>
Action: Bans a username or IP address from the chat room.  The user will no longer be able to access this chat room.");
}elseif($cmd[1] == "deop"){
disp("Command: deop<Br>
Syntax: /deop <i>username</i><Br>
Action: Takes operator status from a user.");
}elseif($cmd[1] == "invite"){
disp("Command: invite<Br>
Syntax: /invite <i>username</i><Br>
Action: Invites a username to join the current chat room.");
}elseif($cmd[1] == "topic"){
disp("Command: topic<Br>
Syntax: /topic <i>topic</i><Br>
Action: Sets the chat rooms topic to <i>topic</i>.");
}elseif($cmd[1] == "wallchan"){
disp("Command: wallcan<Br>
Syntax: /wallchan <i>message</i><Br>
Action: Sends a message to all channels on current server.");
}elseif($cmd[1] == "msg"){
disp("Command: msg<Br>
Syntax: /msg <i>username</i> <i>message</i><Br>
Action: Sends a private message, <i>message</i>, to <i>username</i>.");
}elseif($cmd[1] == "admin"){
disp("Command: admin<Br>
Syntax: /admin <i>username</i><Br>
Action: Grants <i>username</i> administrator access.");
}elseif($cmd[1] == "deadmin"){
disp("Command: deadmin<Br>
Syntax: /deadmin <i>username</i><Br>
Action: Takes <i>username</i>'s administrator access.");
}elseif($cmd[1] == "list"){
disp("Command: list<Br>
Syntax: /list<Br>
Action: Displays list of rooms on the server.");
}elseif($cmd[1] == "me"){
disp("Command: me<Br>
Syntax: /me <i>action</i><Br>
Action: Makes you do an action.");
}elseif($cmd[1] == "mode"){
disp("Command: mode<Br>
Syntax: /mode <i>mode</i> [<i>username</i>]<Br>
Action: Preforms <i>mode</i> on <i>username</i>.  If <i>mode</i> is a channel
mode then <i>username</i> may be ommited.  Placing a + in front of a mode applys it and placing
a - in from of a mode removes it.<Br><br>User Modes:<Br>
[+|-]b: [Bans|Unbans] a user from the current chat room.<Br>
[+|-]v: [Give Voice To|Take Voice From] a user in the current chat room.<Br>
[+|-]o: [Ops|Deops] a user in the current chat room.<Br> 
[+|-]i: [Ignores|Unignores] a user.<Br>
[+|-]a: [Admins|Deadmins] a user.<Br>
<Br>Channel Modes<br>
+p: Makes current chat room private.  Replace <i>username</i> with the password for the room.<br>
-p: Makes a chat room public.  <i>username</i> may be ommited.<Br>
+m: Makes a chat room moderated.  <i>username</i> may be ommited.<Br>
-m: Makes a chat room unmoderated.  <i>username</i> may be ommited.<Br>
+l: Sets the user limit for the current chat room.  Replace <i>username</i> with the maximum amount of users for the room.<br>
-l: Removes the user limit from current chat room.  <i>username</i> may be ommited.<Br>

");

}else{
disp("Sorry no help is available for that command.");
}




}elseif($cmd[0] == "mdeop" && $noauth != 1){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
while($row = Do_Fetch_row($q)){
$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$row[1]'");
$row = Do_Fetch_row($q2);
if($row[4] == "3$ROOMS[id]" && $row[1] != $XUSER['NAME']){
irc("/deop $row[1]");
}
}
}elseif($cmd[0] == "names"){
sendsysmsgto("Users in chat with you:","$XUSER[NAME]:PRIV");
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
while($row = Do_Fetch_row($q)){
sendsysmsgto("$row[1]","$XUSER[NAME]:PRIV");
}
}elseif($cmd[0] == "unignore"){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]ignore WHERE user='$XUSER[NAME]' AND toignore='$cmd[1]'");
}elseif($cmd[0] == "voice" && $noauth != 1 && !isset($wuza)){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET voice='$ROOMS[id]' WHERE username='$cmd[1]'");
mnotice($cmd[1],5);
}elseif($cmd[0] == "kick" && $noauth != 1 && !isset($wuza) && $PERMISSIONS['Kick'] != 1){
mnotice($cmd[1],7);
$time = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','$ROOMS[IN_ROOM_NAME]','$cmd[1]','','$time','60')");
}elseif($cmd[0] == "mkick" && $noauth != 1){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
while($row = Do_Fetch_row($q)){
if($row[1] != $XUSER['NAME']){
irc("/kick $row[1]");
}
}
}elseif($cmd[0] == "op" && $noauth != 1 && !isset($wuza)){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$cmd[1]'");
$row = Do_Fetch_Row($q);
if(strlen($XUSER['LEVEL']) == 1){
$isop = 0;
}elseif(strlen($row[4]) > 1){
$isop = 1;
}
if($isop == 0){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE username='$row[1]'");
$row = Do_Fetch_Row($q);
if($row[3] == $ROOMS['IN_ROOM_NAME']){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='3$ROOMS[id]' WHERE username='$cmd[1]'");
mnotice($cmd[1],3);
}
}

}elseif($cmd[0] == "away"){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET status=2 WHERE username='$XUSER[NAME]'");
}elseif($cmd[0] == "back"){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET status='' WHERE username='$XUSER[NAME]'");
}elseif($cmd[0] == "ignore"){
$time = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]ignore VALUES('0','$XUSER[NAME]','$cmd[1]','$time','')");
}elseif($cmd[0] == "msg"){

$cmd[3] = strip($cmd[3]);
sendprivatemsg($cmd[3],$cmd[1]);

}elseif($cmd[0] == "wallchop"){

$cmd[3] = strip($cmd[3]);
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]online WHERE roomname='$ROOMS[IN_ROOM_NAME]'");
while($row = do_fetch_row($q)){
$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$row[1]'");
$row2 = do_Fetch_row($q2);
if($row2[4] == "3$ROOMS[id]"){
sendprivatemsg($cmd[3],$row[1]);
}
}

}elseif($cmd[0] == "ban" && $noauth != 1 && !isset($wuza) && $PERMISSIONS['Ban'] != 1){

$time = time();
mnotice($cmd[1],8);
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','$ROOMS[IN_ROOM_NAME]','$cmd[1]','','$time','0')");

}elseif($cmd[0] == "deop" && $noauth != 1 && !isset($wuza)){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='1' WHERE username='$cmd[1]'");
mnotice($cmd[1],4);
}elseif($cmd[0] == "roll"){
global $XUSER, $SERVER, $ROOMS;
$SERVER['CURRENT_TIME'] = time();
$ran1 = rand(1,6);
$ran2 = rand(1,6);
if(@$cmd[1] == 2){
$message = "$XUSER[NAME] rolls two dice and gets a $ran1 and a $ran2";
}else{
$message = "$XUSER[NAME] rolls a dice and gets a $ran1";
}
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$ROOMS[IN_ROOM_NAME]','System','$SERVER[CURRENT_TIME]','0','$message')");
}elseif($cmd[0] == "me"){
global $XUSER, $SERVER, $ROOMS;
$SERVER['CURRENT_TIME'] = time();
if($cmd[1] != ""){
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$ROOMS[IN_ROOM_NAME]','System','$SERVER[CURRENT_TIME]','0','$XUSER[NAME] $cmd[3]')");
}
}elseif($cmd[0] == "invite"){

$SERVER['CURRENT_TIME'] = time();
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$cmd[1]:PRIV','System','$SERVER[CURRENT_TIME]','0','$XUSER[NAME] has invited you to join the chatroom <a href=\"../index.php?changeroom=set&room=$ROOMS[IN_ROOM_NAME]\" target=\"_parent\">$ROOMS[IN_ROOM_NAME]</a>')");

}elseif($cmd[0] == "topic" && $noauth != 1){
$cmd[3] = strip($cmd[3]);
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET topic='$cmd[3]' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice($cmd[3],12);
}elseif($cmd[0] == "wallchan" && $PERMISSIONS['Send_Sys_Message'] == 1){
sendsysmsg($cmd[3]);
}elseif($cmd[0] == "admin" && $PERMISSIONS['Make_Admins'] == 1){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='4',time='0' WHERE username='$cmd[1]'");
mnotice($cmd[1],1);
}elseif($cmd[0] == "deadmin" && $PERMISSIONS['Make_Admins'] == 1){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='1',time='0' WHERE username='$cmd[1]'");
mnotice($cmd[1],2);
}elseif($cmd[0] == "list"){
$r = listrooms("dark");
$r = eregi_replace("\r\n","",$r);
sendsysmsgto($r,"$XUSER[NAME]:PRIV");
}elseif($cmd[0] == "mode"){
$error = 0;
if(eregi("-",$cmd[1],$match)){
$type = "-";
}else{
$type = "+";
}


if($cmd[3] == $cmd[1]){
$cmd[3] = "";
}



$temp = eregi_replace("\+","\+",$cmd[1]);
$temp = eregi_replace("\-","\-",$temp);
$cmd[3] = eregi_replace("$temp","",$cmd[3]);
$cmd[3] = eregi_replace("^ ","",$cmd[3]);
$cmd[3] = eregi_replace(" $","",$cmd[3]);

if(eregi("p",$cmd[1],$match)){
if($XUSER['LEVEL'] > 2){
if($type == "-"){
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET type='1' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice("",11);
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +p <i>password</i>";
}else{
if($PERMISSIONS['CR_Private'] == 1){
$error = "The administrator of this server has disabled private rooms.";
}else{
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET type='2',password='$cmd[3]' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice("",10);
}
}
}
}else{
$error = 1;
}
}

if(eregi("m",$cmd[1],$match)){
if($XUSER['LEVEL'] > 2){
if($type == "-"){
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET moderated='0' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice("",15);
}else{
if($PERMISSIONS['CR_Moderated'] == 1){
$error = "The administrator of this server has disabled the creation of moderated rooms.";
}else{
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET moderated='1' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice("",14);
}
}
}else{
$error = 1;
}
}

if(eregi("l",$cmd[1],$match)){
if($XUSER['LEVEL'] > 2){
if($type == "-"){
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET maxusers='0' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice("Unlimited",13);
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +l <i>max users</i>";
}else{
if($cmd[3] < 2){
$cmd[3] = 2;
}
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET maxusers='$cmd[3]' WHERE name='$ROOMS[IN_ROOM_NAME]'");
mnotice($cmd[3],13);
}
}
}else{
$error = 1;
}
}

if(eregi("b",$cmd[1],$match)){
if($XUSER['LEVEL'] > 2){
if($type == "-"){
if($cmd[3] == ""){
$error = "Usage: /mode -b <i>username</i>";
}else{
irc("/unban $cmd[3]");
}
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +b <i>username</i>";
}else{
irc("/ban $cmd[3]");

}
}
}else{
$error = 1;
}
}

if(eregi("v",$cmd[1],$match)){
if($XUSER['LEVEL'] > 2){
if($type == "-"){
if($cmd[3] == ""){
$error = "Usage: /mode -v <i>username</i>";
}else{
irc("/devoice $cmd[3]");
}
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +v <i>username</i>";
}else{
irc("/voice $cmd[3]");

}
}
}else{
$error = 1;
}
}

if(eregi("o",$cmd[1],$match)){
if($XUSER['LEVEL'] > 2){
if($type == "-"){
if($cmd[3] == ""){
$error = "Usage: /mode -o <i>username</i>";
}else{
irc("/deop $cmd[3]");

}
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +o <i>username</i>";
}else{
irc("/op $cmd[3]");

}
}
}else{
$error = 1;
}
}

if(eregi("i",$cmd[1],$match)){
if($type == "-"){
if($cmd[3] == ""){
$error = "Usage: /mode -i <i>username</i>";
}else{
irc("/unignore $cmd[3]");

}
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +i <i>username</i>";
}else{
irc("/ignore $cmd[3]");

}
}
}

if(eregi("a",$cmd[1],$match)){
if($PERMISSIONS['Make_Admins'] == 1){
if($type == "-"){
if($cmd[3] == ""){
$error = "Usage: /mode -a <i>username</i>";
}else{
irc("/deadmin $cmd[3]");

}
}else{
if($cmd[3] == ""){
$error = "Usage: /mode +a <i>username</i>";
}else{
irc("/admin $cmd[3]");

}
}
}else{
$error = 1;
}
}


if($error == 1){
sendsysmsgto("You do not have permission to use that command.","$XUSER[NAME]:PRIV");
}elseif($error != "0"){
sendsysmsgto($error,"$XUSER[NAME]:PRIV");
}


}else{

$message = "Unknown Command $cmd[0]";
if(isset($wuza)){
$message = "Sorry, You may not preform this action on this user.";
}
sendsysmsgto($message,"$XUSER[NAME]:PRIV");


}

}



function mnotice($user,$mode){
global $XUSER, $SERVER, $ROOMS, $txt;
$SERVER['CURRENT_TIME'] = time();
if($mode == 1){
$message = "$XUSER[NAME] $txt[258] $user, $user $txt[259]";
}elseif($mode == 2){
$message = "$XUSER[NAME]$txt[260]$user, $user$txt[264]";
}elseif($mode == 3){
$message = "$XUSER[NAME]$txt[261]$user, $user$txt[265]";
}elseif($mode == 4){
$message = "$XUSER[NAME]$txt[262]$user, $user$txt[266]";
}elseif($mode == 5){
$message = "$XUSER[NAME]$txt[263]$user, $user$txt[267]";
}elseif($mode == 6){
$message = "$XUSER[NAME]$txt[268]$user, $user$txt[269]";
}elseif($mode == 7){
$message = "$XUSER[NAME]$txt[271]$user$txt[270]";
}elseif($mode == 8){
$message = "$XUSER[NAME] $txt[272]$user, $user$txt[278]";
}elseif($mode == 9){
$message = "$XUSER[NAME]$txt[273]$user, $user$txt[279]";
}elseif($mode == 10){
$message = "$XUSER[NAME]$txt[274]";
}elseif($mode == 11){
$message = "$XUSER[NAME]$txt[275]";
}elseif($mode == 12){
$message = "$XUSER[NAME]$txt[276]$user";
}elseif($mode == 13){
$message = "$XUSER[NAME]$txt[277]$user,$txt[280]$user";
}elseif($mode == 14){
$message = "$XUSER[NAME]$txt[281]";
}elseif($mode == 15){
$message = "$XUSER[NAME]$txt[282]";
}



DoQuery("INSERT INTO $SERVER[TBL_PREFIX]messages 
VALUES('0','$ROOMS[IN_ROOM_NAME]','System','$SERVER[CURRENT_TIME]','0','$message')");
}

function writelog($user,$message,$room){;
	global $SERVER;
	$size = filesize("Logs/$room.log");
	if(($size >= $SERVER['MAXLOG'] && $SERVER['MAXLOG'] != 0) || $SERVER['MAXLOG'] == 1){
		return 0;
	}
	$logfile = fopen("Logs/$room.log","a");
	$date = date("F d, Y")." at ".date("g:i:s");
	$append = "{$user}[$date]: &nbsp; &nbsp; $message\n";
	fputs($logfile,"$append");
	fclose($logfile);
}

function readlog($room){
	$logfile = @file("Logs/$room.log");
	$logfile = @implode($logfile,"");
	return $logfile;
}

function clearLog($room){
	$logfile = fopen("Logs/$room.log","w");
	fputs($logfile,"");
	fclose($logfile);
}

function logBandwidth($size){
	global $SERVER, $XUSER;
	$month = date("m");
	$q = DoQuery("SELECT bandwidth,allowed,month FROM $SERVER[TBL_PREFIX]bandwidth WHERE user='$XUSER[NAME]'");
	$row = Do_Fetch_Row($q);
	if($row[0] == ""){
		$q = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bandwidth VALUES('0','$XUSER[NAME]','$month','0','d')");
		$row[0] = 0;
		$row[1] = "d";
		$row[2] = $month;
	}
	
	// reset if its a new month
	if($row[2] != $month){
		DoQuery("UPDATE $SERVER[TBL_PREFIX]bandwidth SET month=$month,bandwidth=0 WHERE user='$XUSER[NAME]'");
		$row[0] = 0;
	}
		
	// record new bandwdith
	$newbandwidth = $row[0]+$size;
		DoQuery("UPDATE $SERVER[TBL_PREFIX]bandwidth SET bandwidth=$newbandwidth WHERE user='$XUSER[NAME]'");
		
		
	// See if user has gone over limit
	if($row[1] == "d")
		$row[1] = $SERVER['DEFAULT_BAND_LIMIT'];
	if($row[1] != 0){
		if($newbandwidth >= $row[1] && ($XUSER['LEVEL'] != 4 && $XUSER['LEVEL'] != 5))
			return 0;
		else
			return 1;
	}
	return 1;
}

?> 
