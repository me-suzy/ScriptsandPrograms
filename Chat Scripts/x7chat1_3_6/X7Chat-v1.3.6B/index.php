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
$action = "null";
if(isset($dologout)){
$action = "logout";
}elseif(isset($bandwidtherror)){
$action = "bwe";
}elseif(isset($doinvite)){
$action = "invite";
}elseif(isset($settings) || isset($settings2)){
$action = "settings";
}elseif(isset($viewprofile)){
$action = "vp";
}elseif(isset($listrooms)){
$action = "list";
}elseif(isset($croom1)){
$action = "createroom1";
}elseif(isset($croom2)){
$action = "createroom2";
}elseif(isset($changestat)){
$action = "statchange";
}elseif(isset($roomloginreq)){
$action = "roomlogin";
}elseif($notauthorized == 1){
$action = "logintype1";
}elseif($notauthorized == 2){
$action = "logintype2";
}elseif($notauthorized == 0){
$action = "main";
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
<?
if(isset($terminalerror1) && isset($changeroom)){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[2]</div>","<div align=\"center\"><Br>$txt[4]<Br><Br><a href=\"index.php?listrooms=true\">$txt[3]</a><Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
?>
</body>
</html>
<?
exit;
}
if(@$terminalerror2 == 1){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[2]</div>","<div align=\"center\"><Br>$txt[4]<Br><Br><a href=\"index.php?listrooms=true\">$txt[3]</a><Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
?>
</body>
</html>
<?
exit;
}

if(($action == "createroom1" || $action == "createroom2") && $PERMISSIONS['CreateRoom'] == 1){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?

printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[2]</div>","
<div align=\"center\"><Br>$txt[5]<Br><Br><a href=\"index.php\">$txt[6]</a><Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
print("</body></html>");
exit;
}
if(($action == "createroom1" || $action == "createroom2") && $SERVER['MAX_ROOMS'] < $roomsifplusedbyone && $SERVER['MAX_ROOMS'] != 0 && $XUSER['LEVEL'] < 4){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?

printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[2]</div>","
<div align=\"center\"><Br>$txt[7]<Br><Br><a href=\"index.php\">$txt[6]</a><Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
print("</body></html>");
exit;
}
if($action == "logout"){
$expuser = round($SERVER['EXP_USER']/60);
$expmsg = round($SERVER['EXP_MSG']/60);
$exproom = round($SERVER['EXP_ROOMS']/60);

$expuser .= $txt[8];
$expmsg .= $txt[8];
$exproom .= $txt[8];

if($SERVER['EXP_USER'] == 0)
	$expuser = $txt[9];
if($SERVER['EXP_MSG'] == 0)
	$expmsg = $txt[9];
if($SERVER['EXP_ROOMS'] == 0)
	$exproom = $txt[9];
	
	$news = "";
if($SERVER['NEWS'] != ""){	
	$news = "<Br>";
	$news .= "<div align=\"center\">
			<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" style=\"border: 1px solid $CS[3]\">\n
			<tr align=\"top\">
			<td width=\"300\" bgcolor=\"$CS[2]\"><div align=\"center\">$SERVER[NEWS]</div></td>
			</tr>
			</table>
			</div>";
	$news .= "<Br>";
}
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$body = "
<div align=\"center\">
$txt[10]
<br>
$txt[11]
<Br>
$news
<form action=\"index.php\" method=\"post\">
<input type=\"hidden\" name=\"doxlogin\" value=\"1\">
$txt[12]<input type=\"text\" name=\"X2CHATU\"><Br>
$txt[13]<input type=\"password\" name=\"X2CHATP\"><br><Br>
<input type=\"submit\" value=\"$txt[20]\"><Br>
</form>
<a href=\"register.php\">$txt[14]</a><Br>
<Br><br>
$txt[15]$expuser<Br>
$txt[16]$exproom<Br>
$txt[17]$expmsg<Br><Br>
</div>
";
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[1]</div>",$body,"$CS[1]",$CS[2],"$CS[3]");
}elseif($action == "bwe"){
?><body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>"><?
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[2]</div>","<Br><div align=\"center\">$txt[427]</div><Br><Br>","$CS[1]",$CS[2],"$CS[3]");
}elseif($action == "main"){
?>
<frameset rows="200,500,200,0" border="0">
		<frame src="frame.php?page=top" name="left_top" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
	<frameset cols="500,200">
		<frame src="frame.php?page=left.middle" name="left_mid" frameborder="0" scrolling="yes" marginwidth="0" marginheight="0" noresize="true">
		<frame src="frame.php?page=right.middle" name="right_mid" frameborder="0" scrolling="yes" marginwidth="0" marginheight="0" noresize="true">
	</frameset>
	<frameset cols="500,200,0">
		<frame src="frame.php?page=left.bottom" name="left_bot" frameborder="0" scrolling="auto" marginwidth="0" marginheight="0" noresize="true">
		<frame src="frame.php?page=right.bottom" name="right_bot" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
		<frame src="frames/send.php" name="hidden_one" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
	</frameset>
	<frame src="frames/update.php" name="update" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
</frameset>
<NOFRAMES>
<?=$txt[18]?>
</NOFRAMES> 
<?
}elseif($action == "logintype2"){
$expuser = round($SERVER['EXP_USER']/60);
$expmsg = round($SERVER['EXP_MSG']/60);
$exproom = round($SERVER['EXP_ROOMS']/60);

$expuser .= $txt[8];
$expmsg .= $txt[8];
$exproom .= $txt[8];

if($SERVER['EXP_USER'] == 0)
	$expuser = $txt[9];
if($SERVER['EXP_MSG'] == 0)
	$expmsg = $txt[9];
if($SERVER['EXP_ROOMS'] == 0)
	$exproom = $txt[9];
	
	$news = "";
if($SERVER['NEWS'] != ""){	
	$news = "<Br>";
	$news .= "<div align=\"center\">
			<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" style=\"border: 1px solid $CS[3]\">\n
			<tr align=\"top\">
			<td width=\"300\" bgcolor=\"$CS[2]\"><div align=\"center\">$SERVER[NEWS]</div></td>
			</tr>
			</table>
			</div>";
	$news .= "<Br>";
}
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?

$body = "
<div align=\"center\">
$txt[19]<Br>
$news
<form action=\"index.php\" method=\"post\">
<input type=\"hidden\" name=\"doxlogin\" value=\"1\">
$txt[12]<input type=\"text\" name=\"X2CHATU\"><Br>
$txt[13]<input type=\"password\" name=\"X2CHATP\"><br><Br>
<input type=\"submit\" value=\"$txt[20]\"><Br>
</form>
<a href=\"register.php\">$txt[14]</a><Br>
<Br><br>
$txt[15]$expuser<Br>
$txt[16]$exproom<Br>
$txt[17]$expmsg<Br><Br>
</div>
";
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[1]</div>",$body,"$CS[1]",$CS[2],"$CS[3]");

}elseif($action == "logintype1"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$expuser = round($SERVER['EXP_USER']/60);
$expmsg = round($SERVER['EXP_MSG']/60);
$exproom = round($SERVER['EXP_ROOMS']/60);

$expuser .= $txt[8];
$expmsg .= $txt[8];
$exproom .= $txt[8];

if($SERVER['EXP_USER'] == 0)
	$expuser = $txt[9];
if($SERVER['EXP_MSG'] == 0)
	$expmsg = $txt[9];
if($SERVER['EXP_ROOMS'] == 0)
	$exproom = $txt[9];

$news = "";
if($SERVER['NEWS'] != ""){	
	$news = "<Br>";
	$news .= "<div align=\"center\">
			<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" style=\"border: 1px solid $CS[3]\">\n
			<tr align=\"top\">
			<td width=\"300\" bgcolor=\"$CS[2]\"><div align=\"center\">$SERVER[NEWS]</div></td>
			</tr>
			</table>
			</div>";
	$news .= "<Br>";
}

?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$body = "
<div align=\"center\">
$txt[21]<Br>
$news
<form action=\"index.php\" method=\"post\">
<input type=\"hidden\" name=\"doxlogin\" value=\"1\">
$txt[12]<input type=\"text\" name=\"X2CHATU\"><Br>
$txt[13]<input type=\"password\" name=\"X2CHATP\"><br><Br>
<input type=\"submit\" value=\"$txt[20]\"><Br>
</form>
<a href=\"register.php\">$txt[14]</a><Br>
<Br><br>
$txt[15]$expuser<Br>
$txt[16]$exproom<Br>
$txt[17]$expmsg<Br><Br>
</div>
";
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[1]</div>",$body,"$CS[1]",$CS[2],"$CS[3]");

}elseif($action == "list"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
if(isset($ban)){
$banned = "$txt[22]<Br><Br>";
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]online WHERE username='$XUSER[NAME]' AND roomname='$ROOMS[IN_ROOM_NAME]' OR ip='$XUSER[IP]' AND roomname='$ROOMS[IN_ROOM_NAME]'");
}else{
$banned = "";
}
if(isset($pincorrect)){
$banned .= "$txt[23]<Br><Br>";
}
$body = listrooms();

if($PERMISSIONS['CreateRoom'] != 1){
$body .= "<Br><Br>
<a href=\"index.php?croom1=yes\">$txt[25]</a>";
}

$temp = $PERMISSIONS['Edit_Settings']+$PERMISSIONS['Edit_Styles']+$PERMISSIONS['Edit_Permissions']+$PERMISSIONS['Edit_Users']+$PERMISSIONS['Edit_Room']+$PERMISSIONS['Server_Ban']+$PERMISSIONS['Edit_Filter']+$PERMISSIONS['Edit_Smilies']+$PERMISSIONS['Edit_Bandwidth'];
if($temp != 0){
$body .= "<Br><a href=\"admin.php\">[$txt[386]]</a>";
}

printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[24]</div>","
<div align=\"Center\">$banned$body 
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");

}elseif($action == "createroom1"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$body = "
$txt[26]<Br><Br>
<form action=\"index.php\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[27]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"name\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[28]</td>
<td width=\"350\" bgcolor=\"$CS[2]\">
<select name=\"type\">
<option value=\"1\">$txt[29]</option>";

if($PERMISSIONS['CR_Private'] != 1){
$body .= "<option value=\"2\">$txt[30]</option>";
}
$body .= "</select>
</td>
</tr>";
if($PERMISSIONS['CR_Moderated'] != 1){
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[31]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"moded\" value=\"1\"></td>
</tr>";
}
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[32]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"topic\"></td>
</tr>

<tr valign=\"center\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[417]:<br>$txt[418]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"greeting\"></td>
</tr>

<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[13]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"password\" name=\"roomword\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[33]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"maxusers\"></td>
</tr>";
if($PERMISSIONS['CR_NeverExpire'] == 1){
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[34]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"neverexp\" value=\"1\"></td>
</tr>";
}
$body .= "<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
<input type=\"hidden\" name=\"croom2\" value=\"yes\">
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></td>
</tr>
</table>
</div>
</td></tr></table>
</form>
";
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[25]</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");


}elseif($action == "createroom2"){
if(!isset($moded)){
$moded = 0;
}
if(!isset($neverexp)){
$neverexp = 0;
}
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
if($PERMISSIONS['CreateRoom'] == 1){
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
if($roomword == "" && $type==2){
$body = "$txt[172]<Br><Br>";
$donotmake = "set";
}
if($maxusers == "" || $maxusers < 2 || eregi("[A-z]",$maxusers)){
$maxusers = 2;
}
if($name == ""){
$body = "$txt[39]<Br><Br>";
$donotmake = "set";
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

$name = strip($name);
$greeting = strip($greeting);
$greeting = eregi_replace("'","\\'",$greeting);
$name = eregi_replace("'","\\'",$name);
$type = strip($type);
$moded = strip($moded);
$topic = strip($topic);
$topic = eregi_replace("'","\\'",$topic);
$roomword = strip($roomword);
$maxusers = strip($maxusers);

if(!isset($donotmake)){
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]rooms VALUES('0','$name','$type','','$greeting','$moded','$topic','$roomword','$maxusers','$time')");
$body = "$txt[41]<a href=\"index.php?changeroom=true&room=$name\">$txt[40]</a>";
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms WHERE name='$name'");
$row = Do_Fetch_Row($q);

if($XUSER['LEVEL'] != 5 && $XUSER['LEVEL'] != 4 && $PERMISSIONS['Give_Ops_Own'] == 1){
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level='3$row[0]' WHERE username='$XUSER[NAME]'");
}

}
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[25]</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");


}elseif($action == "vp"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
if($viewprofile == $XUSER['NAME']){
$head = $txt[42];
if(isset($step)){
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$viewprofile'");
$row = Do_Fetch_Row($q);
$body = "$txt[43]<Br><Br><a href=\"index.php\">$txt[6]</a>";
$error=0;
if($pass1 != $pass2){
$body = "$txt[44]<Br><Br>";
$error =1;
}
if(!isset($email)){
$body = "$txt[45]<Br><Br>";
$error =1;
}
if($error == 1){}else{
$pass1 = strip($pass1);
$email = strip($email);
$ava = strip($ava);
$realname = strip($realname);
$location = strip($location);
$hobbies = strip($hobbies);
$bio = strip($bio);

$time = time();
if($XUSER['TIME'] == 0){
$time = 0;
}


DoQuery("DELETE FROM $SERVER[TBL_PREFIX]users WHERE username='$XUSER[NAME]'");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES
('$row[0]','$row[1]','$row[2]','$email','$row[4]','$ava','$realname','$location','$hobbies','$bio','$row[10]','$row[11]','$time','$row[13]')");
if($pass1 != ""){
changePass($pass1,$XUSER['NAME']);
}
}
}else{
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$viewprofile'");
$row = Do_Fetch_Row($q);
$email = $row[3];
$ava =$row[5];
$realname = $row[6];
$loco = $row[7];
$hobb = $row[8];
$bio = $row[9];


$body = "<Br>
<div align=\"center\">
<form action=\"index.php\" method=\"post\">
<input type=\"hidden\" name=\"step\" value=\"5\">
<input type=\"hidden\" name=\"viewprofile\" value=\"$viewprofile\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">

<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[13]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"password\" name=\"pass1\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[46]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"password\" name=\"pass2\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[47]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"email\" value=\"$email\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[48]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"ava\" value=\"$ava\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[49]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"realname\" value=\"$realname\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[50]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"location\" value=\"$loco\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[51]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"hobbies\" value=\"$hobb\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[52]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><textarea name=\"bio\">$bio</textarea></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></td>
</tr>
</table>
</div>
</td></tr></table>
</form></div><Br>
";
}


}else{
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$viewprofile'");
$row = Do_Fetch_Row($q);
$pro_user = $row[1];
$pro_email = $row[3];
$pro_name = $row[6];
$pro_location = $row[7];
$pro_hobbies = $row[8];
$pro_bio = $row[9];
$pro_ava = $row[5];

$head = $txt[53];
$body = "<Br><Br><table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[12]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$pro_user</td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[48]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><img src=\"$pro_ava\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[47]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$pro_email</td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[49]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$pro_name</td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[50]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$pro_location</td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[51]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$pro_hobbies</td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[52]</td>

<td width=\"350\" bgcolor=\"$CS[2]\">$pro_bio</td>
</tr>
</table>
</div>
</td></tr></table>
</form><Br><a href=\"index.php\">$txt[6]</a><Br></div>";

}

printct(700,700,"<font size=\"6\"><div align=\"center\">${head}$txt[54]</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");

}elseif($action == "statchange"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$XUSER[NAME]'");
$row = Do_Fetch_Row($q);
if($row[10] == 2){
$head = $txt[55];
$body = "$txt[56]<a href=\"index.php\">$txt[40]</a>$txt[57]";
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET status=1 WHERE username='$XUSER[NAME]'");
sendsysmsgto("$XUSER[NAME] has returned","$ROOMS[IN_ROOM_NAME]");
}else{
$head = $txt[58];
$body = "$txt[59]<a href=\"index.php?changestat=back\">$txt[40]</a>$txt[60]";
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET status=2 WHERE username='$XUSER[NAME]'");
sendsysmsgto("$XUSER[NAME] is away","$ROOMS[IN_ROOM_NAME]");
}
printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
}elseif($action == "settings"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
if(!isset($settings)){
if(@$ssmilies == ""){
$ssmilies = 1;
}
if(@$CSs == ""){
$CSs = 1;
}
if(@$timestamp == ""){
$timestamp = 0;
}
if(@$sounds == ""){
$sounds = 0;
}
if($pms == ""){
$pms = 0;
}

if($refreshrate < 1)
	$refreshrate = 1;
if($refreshrate > 20)
	$refreshrate = 20;
	
$refreshrate = $refreshrate*1000;

$newsettings = $logintime.",".$refreshrate.",".$CSs.",".$ssmilies.",".$timestamp.","."3,1,".$offset.",".$sounds.",".$pms;

$newsettings = strip($newsettings);

DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET settings='$newsettings' WHERE username='$XUSER[NAME]'");
$head = $txt[61];
$body = "$txt[62]<Br><Br><a href=\"index.php\">$txt[6]</a>";

}else{
if($STYLE['ENABLE_STYLE'] == 0){
$CSs = "";
}else{
$CSs = " CHECKED";
}
if($STYLE['ENABLE_SMILE'] == 0){
$ssmilies = "";
}else{
$ssmilies = " CHECKED";
}
if($XUSER['TIMESTAMP'] == 1){
$timestamp = " CHECKED";
}else{
$timestamp = "";
}
if($SERVER['ENABLE_SOUNDS'] == 1){
$sounds = " CHECKED";
}else{
$sounds = "";
}
if($XUSER['POPUPPM'] == 1){
$pms = " CHECKED";
}else{
$pms = "";
}

$refresh = $XUSER['REFRESH']/1000;

$head = $txt[63];
$body = "<Br>
<div align=\"center\">
<form action=\"index.php\" method=\"post\">
<input type=\"hidden\" name=\"settings2\" value=\"set\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">

<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[64]<Br>
<font size=\"2\">$txt[65]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"logintime\" value=\"$XUSER[COOKIE_TIME]\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[66]<Br>
<font size=\"2\">$txt[67]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"refreshrate\" value=\"$refresh\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[311]:<Br>
<font size=\"2\">$txt[312]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"offset\" value=\"$XUSER[OFFSET]\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[68]<Br>
<font size=\"2\">$txt[69]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"ssmilies\" value=\"0\"$ssmilies></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[70]<Br>
<font size=\"2\">$txt[71]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"CSs\" value=\"0\"$CSs></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[72]<Br>
<font size=\"2\">$txt[73]</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"timestamp\" value=\"1\"$timestamp></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[343]<Br>
<font size=\"2\">$txt[344]</font></td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"sounds\" value=\"1\" $sounds></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[394]<Br>
<font size=\"2\">$txt[395]</font></td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"pms\" value=\"1\" $pms></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></td>
</tr>
</table>
</div>
</td></tr></table>
</form></div><Br>
";
}
printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
}elseif($action == "roomlogin"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$head = $txt[74];
$body = "$txt[75]<Br><Br>
<form action=\"index.php\" method=\"post\">
<input type=\"password\" name=\"X7CROOMP\"> <input type=\"Submit\" value=\"$txt[35]\">
</form>";

printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
}elseif($action == "invite"){
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$head = $txt[308];

if(!isset($invitewho)){
$body = "<Br>
<form action=\"index.php?doinvite=1\" method=\"post\">
<select name=\"invitewho\">";
$q = DoQuery("SELECT username FROM $SERVER[TBL_PREFIX]online WHERE roomname!='$ROOMS[IN_ROOM_NAME]'");
while($row = Do_Fetch_Row($q)){
	$body .= "<option value=\"$row[0]\">$row[0]</option>";
}

$body .= "</select> &nbsp; &nbsp; <input type=\"submit\" value=\"$txt[308]\"></form>";
$body .= "<Br><a href=\"index.php\">$txt[6]</a>";
}else{
	$invitewho = eregi_replace("'","\'",$invitewho);
	irc("/invite $invitewho");
	$body = "<Br><a href=\"index.php\">$txt[6]</a>";
}

printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div>","
<div align=\"Center\">$body
<Br><Br></div>","$CS[1]",$CS[2],"$CS[3]");
}
?>
<Br><Br><Br>
<div align="center"><font size="2">Powered By <a href="http://www.x7chat.com/" target="_blank">X7 Chat</a> 1.3.6B<Br>&copy; 2004 By The <a href="http://www.x7chat.com/" target="_blank">X7 Group</a></font></div>
</div>
</html>
