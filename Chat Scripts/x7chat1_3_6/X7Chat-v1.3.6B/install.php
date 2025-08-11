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
<body bgcolor="#EEEEEE" text="#000000" link="#3C41CF" alink="#990000" vlink="#3C41CF">
<div align="center">

<?
$isbase = "set";
require("config.php");
if(!isset($step)){
$step = "1";
}

if($step == 1){
$body = "$txt[212]<Br><Br>
<Br>$txt[213]<Br><Br>
<div align=\"center\"><a href=\"install.php?step=2\"><font size=\"5\">$txt[35]</font></a></div>
";
}elseif($step == 2){
if(DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS'])){
$dbcon = $txt[216];
}else{
$dbcon = "$txt[215]<Br>$txt[214]<Br>";
}

if(DoSelectDb($DATABASE['DATABASE'])){
$dbsel = $txt[216];
}else{
if($dbcon == $txt[216]){
$dbsel .= "<br>$txt[217]$DATABASE[DATABASE]<Br>";
}else{
$dbsel .= "<Br>$txt[218]<br>";
}
}

if($dbsel == $txt[216] && $dbcon == $txt[216]){
$dberrors = "$txt[219]<Br><div align=\"center\"><a href=\"install.php?step=3\"><font size=\"5\">$txt[35]</font></a></div>";
}else{
$dberrors = "$txt[220]<Br>";
}

$body = "$txt[221]<br><Br><Br>
$txt[222]$DATABASE[TYPE]$txt[223]$dbcon<Br>
$txt[224]$DATABASE[DATABASE]: $dbsel<Br><Br>$dberrors";
}elseif($step == 3){
$body = "$txt[225]<Br>";
DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
DoSelectDb($DATABASE['DATABASE']);

if(isset($override)){
if($override == "true"){
$body .= "<br>$txt[226]<Br><Br>";
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]users");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]rooms");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]online");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]messages");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]settings");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]ignore");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]bans");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]filter");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]permissions");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]pmsessions");
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]bandwidth");
}
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]users(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(60) NOT NULL,
password VARCHAR(60) NOT NULL,
email VARCHAR(90) NOT NULL,
level INT NOT NULL,
avatar VARCHAR(60) NOT NULL,
realname VARCHAR(60) NOT NULL,
location VARCHAR(60) NOT NULL,
hobbies VARCHAR(60) NOT NULL,
bio VARCHAR(60) NOT NULL,
status VARCHAR(60) NOT NULL,
voice INT NOT NULL,
time INT NOT NULL,
settings TEXT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[227]";
}else{
$body .= "<Br>$txt[228]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]rooms(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(60) NOT NULL,
type INT NOT NULL,
encrypted INT NOT NULL,
ban TEXT NOT NULL,
moderated INT NOT NULL,
topic VARCHAR(90) NOT NULL,
password VARCHAR(60) NOT NULL,
maxusers INT NOT NULL,
time INT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[229]";
	$err = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]rooms VALUES('0','General Chat','1','0','null','0','Welcome to X7 Chat','','100','0')");
	if($err == 1){
	$body .= "<Br>$txt[231]";
	}else{
	$body .= "<Br>$txt[232]<Br>$err<br><Br>";
	$didfail = 1;
	}
}else{
$body .= "<Br>$txt[230]<Br>$err<br><Br>";
$didfail = 1;
}



$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]online(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(60) NOT NULL,
ip VARCHAR(30) NOT NULL,
roomname VARCHAR(60) NOT NULL,
time INT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[233]";
}else{
$body .= "<Br>$txt[234]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]messages(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
room VARCHAR(60) NOT NULL,
user VARCHAR(60) NOT NULL,
time INT NOT NULL,
type INT NOT NULL,
body TEXT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[235]";
}else{
$body .= "<Br>$txt[403]<Br>$err<br><Br>";
$didfail = 1;
}

if($SERVER[TBL_PREFIX] == ""){
$err = DoQuery("CREATE TABLE $DATABASE[DATABASE].$SERVER[TBL_PREFIX]ignore(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(60) NOT NULL,
toignore VARCHAR(60) NOT NULL,
timeset INT NOT NULL,
length INT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[236]";
}else{
$body .= "<Br>$txt[237]<Br>$err<br><Br>";
$didfail = 1;
}
}else{
$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]ignore(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(60) NOT NULL,
toignore VARCHAR(60) NOT NULL,
timeset INT NOT NULL,
length INT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[236]";
}else{
$body .= "<Br>$txt[237]<Br>$err<br><Br>";
$didfail = 1;
}
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]bans(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
room VARCHAR(60) NOT NULL,
name VARCHAR(60) NOT NULL,
ip VARCHAR(60) NOT NULL,
timeset INT NOT NULL,
length INT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[238]";
}else{
$body .= "<Br>$txt[239]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]filter (
  id int(11) NOT NULL auto_increment,
  type int(11) NOT NULL default '0',
  code varchar(100) NOT NULL default '',
  image varchar(100) NOT NULL default '',
  PRIMARY KEY  (id)
)");
if($err == 1){
$body .= "<Br>$txt[397]";
}else{
$body .= "<Br>$txt[398]<Br>$err<br><Br>";
$didfail = 1;
}

$smilies[':)'] = '../images/smiley/happy.gif';
$smilies['\\\\[confused\\\\]'] = '../images/smiley/confused.gif';
$smilies['8)'] = '../images/smiley/cool.gif';
$smilies['\\\\~\\\\('] = '../images/smiley/cry.gif';
$smilies[':!:'] = '../images/smiley/explaim.gif';
$smilies['\\\\[question\\\\]'] = '../images/smiley/question.gif';
$smilies[':\\\\|'] = '../images/smiley/straight.gif';
$smilies['!)'] = '../images/smiley/surprised.gif';
$smilies[':\\\\('] = '../images/smiley/unhappy.gif';
$smilies[';)'] = '../images/smiley/wink.gif';

foreach($smilies as $key=>$val){
$err = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]filter VALUES('0','1','$key','$val')");
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]pmsessions (
  id int(11) NOT NULL auto_increment,
  user varchar(255) NOT NULL default '',
  fromuser varchar(255) NOT NULL default '',
  time int(11) NOT NULL default '0',
  isopen int(11) NOT NULL default '0',
  PRIMARY KEY  (id)
)");
if($err == 1){
$body .= "<Br>$txt[399]";
}else{
$body .= "<Br>$txt[400]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]permissions (
  id int(11) NOT NULL auto_increment,
  user varchar(255) NOT NULL default '',
  CreateRoom int(11) NOT NULL default '0',
  CR_NeverExpire int(11) NOT NULL default '0',
  CR_Private int(11) NOT NULL default '0',
  CR_Moderated int(11) NOT NULL default '0',
  Make_Admins int(11) NOT NULL default '0',
  Give_Ops_Own int(11) NOT NULL default '0',
  Give_Ops_All int(11) NOT NULL default '0',
  Lookup_Ips int(11) NOT NULL default '0',
  Kick int(11) NOT NULL default '0',
  Ban int(11) NOT NULL default '0',
  Server_Ban int(11) NOT NULL default '0',
  Send_Sys_Message int(11) NOT NULL default '0',
  Edit_Settings int(11) NOT NULL default '0',
  Edit_Styles int(11) NOT NULL default '0',
  Edit_Permissions int(11) NOT NULL default '0',
  Edit_Users int(11) NOT NULL default '0',
  Edit_Room int(11) NOT NULL default '0',
  Edit_Smilies int(11) NOT NULL default '0',
  Edit_Filter int(11) NOT NULL default '0',
  Edit_Bandwidth int(11) NOT NULL default '0',
  PRIMARY KEY  (id)
)");
if($err == 1){
$body .= "<Br>$txt[401]";
}else{
$body .= "<Br>$txt[402]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]permissions VALUES(1, 'DEFAULT_1', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0)");
if($err == 1){
$body .= "<Br>$txt[404]";
}else{
$body .= "<Br>$txt[405]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]permissions VALUES(2, 'DEFAULT_4', 0, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1,1)");
if($err == 1){
$body .= "<Br>$txt[406]";
}else{
$body .= "<Br>$txt[407]<Br>$err<br><Br>";
$didfail = 1;
}


$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]settings(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(60) NOT NULL,
value TEXT NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[240]";
}else{
$body .= "<Br>$txt[241]<Br>$err<br><Br>";
$didfail = 1;
}

$err = DoQuery("CREATE TABLE $SERVER[TBL_PREFIX]bandwidth(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(255) NOT NULL,
month VARCHAR(15) NOT NULL,
bandwidth VARCHAR(255) NOT NULL,
allowed VARCHAR(255) NOT NULL
)");
if($err == 1){
$body .= "<Br>$txt[451]";
}else{
$body .= "<Br>$txt[452]<Br>$err<br><Br>";
$didfail = 1;
}

if(!isset($didfail)){
$didfail = 0;
}
if($didfail == 1){
$body .= "<br><br>$txt[242]<a href=\"install.php?step=3&override=true\">$txt[40]</a>$txt[243]<Br>";
}else{
$body .= "<Br><Br>$txt[244]<Br><div align=\"center\"><a href=\"install.php?step=4\"><font size=\"5\">$txt[35]</font></a></div>";
}



}elseif($step == 4){
$body = "<div align=\"center\">$txt[245]<Br><Br>

<form action=\"install.php\" method=\"post\">
<input type=\"hidden\" name=\"step\" value=\"5\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[12]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"username\"></td>
</tr>
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

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"email\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[48]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"avatar\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[49]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"realname\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[50]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"location\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[51]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"hobbies\"></td>
</tr>
<tr valign=\"top\">
<td width=\"150\" bgcolor=\"$CS[2]\">$txt[52]</td>

<td width=\"350\" bgcolor=\"$CS[2]\"><textarea name=\"bio\"></textarea></td>
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

}elseif($step == 5){
if($pass1 != $pass2 || $pass1 == ""){
$body = "$txt[44]<Br><Br>";
$error = 1;
}
if($username == ""){
$body = "$txt[193]<Br><br>";
$error = 1;
}
if($email == "" || !eregi("^.*@[^.]*\..+$",$email)){
$body = "$txt[45]<Br><Br>";
$error =1;
}

$pass1 = doXEncrypt($pass1);
if(!isset($error)){
DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
DoSelectDb($DATABASE['DATABASE']);
$settings = "14000,1000,1,1,0,3,1,0,0,1";
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]users WHERE username='$username' AND level='1'");
$err = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users 
VALUES('0','$username','$pass1','$email','5','$avatar','$realname','$location',
'$hobbies','$bio','','1','0','$settings')");
if($err == 1){
$body = "$txt[246]<Br>";
}else{
$body = "$txt[247]<Br>$err<Br><Br>";
$error = 1;
}
if(@$error != 1){
$body .= "<Br>$txt[250]";
DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
DoSelectDb($DATABASE['DATABASE']);
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]settings");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_sounds','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_chat','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_registration','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_newroom','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_newroomprivate','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_avatars','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','exp_room','600')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','exp_user','600')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','exp_msg','600')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','max_inrooms','100')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','max_rooms','100')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','max_total','500')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','max_idletime','240')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','max_mps','3')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_links','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_style','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','ed_smile','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_winbg1','#FFFFFF')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_winbg2','#b3b3b3')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_cs1','#cdcdcd')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_cs3','#cdcdcd')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_cs2','#000000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_msgboxbg','#b3b3b3')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_ltfont','#000000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_dkfont','#000000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_deffont','#000000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','bgimage','')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','news','')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','maxlog','1048576')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','defband','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_sysmsg','#ff0000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_otherusers','#ff0000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_youruser','#001068')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','serveroffset','0')");

}else{
}
}

}

printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[249]$step</div></font>",$body,"#CDCDCD","#CDCDCD","#EEEEEE");
?>
<div align="center"><Br><Br><Br>
<a href="http://www.x7chat.com"><img src="images/copyright.png" border="0"></a>
<Br><font size="2"><?=$txt[76]?></font>
<Br><font size="2"><?=$txt[77]?></font>
</div>
</body>
</html>
