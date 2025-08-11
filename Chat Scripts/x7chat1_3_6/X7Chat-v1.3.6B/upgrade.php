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
$body = "$txt[409]<Br>
<Br>$txt[410]<Br><Br>
<div align=\"center\"><a href=\"upgrade.php?step=2\"><font size=\"5\">$txt[35]</font></a></div>
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
$dberrors = "$txt[219]<Br><div align=\"center\"><a href=\"upgrade.php?step=3\"><font size=\"5\">$txt[35]</font></a></div>";
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
DoQuery("DROP TABLE $SERVER[TBL_PREFIX]bandwidth");
}
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

// ALTER permissions table in order to add a new field
DoQuery("ALTER TABLE $SERVER[TBL_PREFIX]permissions ADD Edit_Bandwidth INT NOT NULL");

// Update OLD style variables
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#FFFFFF' WHERE name = 'style_winbg1'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#b3b3b3' WHERE name = 'style_winbg2'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#cdcdcd' WHERE name = 'style_cs1'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#cdcdcd' WHERE name = 'style_cs3'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#000000' WHERE name = 'style_cs2'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#b3b3b3' WHERE name = 'style_msgboxbg'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#000000' WHERE name = 'style_ltfont'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#000000' WHERE name = 'style_dkfont'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='#000000' WHERE name = 'style_deffont'");

// Insert New Variables
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','bgimage','')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','news','')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','maxlog','1048576')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','defband','0')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_sysmsg','#ff0000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_otherusers','#ff0000')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','style_youruser','#001068')");
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]settings VALUES('0','serveroffset','0')");

// Update old permissions table to allow admins to access bandwidth settings
DoQuery("UPDATE $SERVER[TBL_PREFIX]permissions SET Edit_Bandwidth='1' WHERE user='DEFAULT_4'");

if($didfail == 1){
$body .= "<br><br>$txt[411]<a href=\"upgrade.php?step=3&override=true\"><font color=\"#EEEEEE\">$txt[40]</font></a><Br>";
}else{
$body .= "<Br><Br>$txt[412]</div>";
}



}

printct(700,700,"<font size=\"6\"><div align=\"center\">$txt[408]$step</div></font>",$body,"#CDCDCD","#CDCDCD","#EEEEEE");
?>
<div align="center"><Br><Br><Br>
<a href="http://www.x7chat.com"><img src="images/copyright.png" border="0"></a>
<Br><font size="2"><?=$txt[76]?></font>
<Br><font size="2"><?=$txt[77]?></font>
</div>
</body>
</html>
