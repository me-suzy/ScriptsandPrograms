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
<?
$isbase = "set";
require("config.php");
?>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<div align="center">
<?
if($SERVER['ENABLE_REG'] == 1){
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[2]</div></font>","
<div align=\"Center\">$txt[190]</div><Br><br>
","$CS[1]","$CS[2]","$CS[3]");
exit;
}

if($AUTH['CAN_REG'] == 0){
printct(700,700,"<font size=\"6\"><div align=\"center\">$AUTH[REG_NOTICE_HEADER]</div></font>","
<div align=\"Center\">$AUTH[REG_NOTICE]</div><Br><br>
","$CS[1]","$CS[2]","$CS[3]");
exit;
}

if(!isset($step)){
$body = "<div align=\"center\">$txt[191]<Br><Br>

<form action=\"register.php\" method=\"post\">
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
printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[192]</div></font>",$body,"$CS[1]","$CS[2]","$CS[3]");
exit;
}
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
DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
DoSelectDb($DATABASE['DATABASE']);

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
while($row = Do_Fetch_Row($q)){
$body = "$txt[194]";
$error = 1;
}

if(strtoupper($username) == "DEFAULT_4" || strtoupper($username) == "DEFAULT_1"){
$body = "$txt[194]";
$error = 1;
}

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE email='$email'");
while($row = Do_Fetch_Row($q)){
$body = "$txt[440]";
$error = 1;
}

$pass1 = doXEncrypt($pass1);
if(!isset($error)){
$q = DoQuery("SELECT value FROM $SERVER[TBL_PREFIX]settings WHERE name='serveroffset'");
$row = Do_Fetch_Row($q);
$settings = "14000,5000,1,1,0,3,1,$row[0],0,1";
$time = time();
$err = DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users 
VALUES('0','$username','$pass1','$email','1','$avatar','$realname','$location',
'$hobbies','$bio','','1','$time','$settings')");
if($err == 1){
$body = "<Br>$txt[195]<Br><Br><a href=\"index.php\">$txt[196]</a><Br><Br>";
}else{
$body = "Sorry a database error occured:<Br>$err<Br><Br>";
}
}

printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[197]</div></font>","<div align=\"Center\">$body</div>","$CS[1]","$CS[2]","$CS[3]");
?>
<Br><Br><Br>
<div align="center"><font size="2">Powered By <a href="http://www.x7chat.com/" target="_blank">X7 Chat</a> 1.3.6B<Br>&copy; 2004 By The <a href="http://www.x7chat.com/" target="_blank">X7 Group</a></font></div>
</body>
</html>
