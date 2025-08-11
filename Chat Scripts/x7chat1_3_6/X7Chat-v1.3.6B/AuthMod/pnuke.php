<?

////////////////////////////////////////////////////////////////// 
//								//
//		This PostNuke AuthMod was developed by a	//          
//		user of X7 Chat, Richard Virtue.  It is		//
//		based entrirely on the ideas and prior		//
//		work contained in the main body of work   	//
//   		by the X7 Group.				//
//   								//
//		The X7 Chat application is			//
//		Copyright (c) 2004 By the X7 Group		//
//		Website: http://www.x7chat.com			//
//							     	//						 //
//////////////////////////////////////////////////////////////////

$donotincluebase = 1;
if($isbase == "notset"){
require("../../config.php");
}else{
require("../config.php");
}

// Handle PostNuke Database Data
$pnuke['DBHOST'] = $pnconfig['dbhost'];
$pnuke['UNAME'] = $pnconfig['dbuname'];
$pnuke['PWORD'] = $pnconfig['dbpass'];
$pnuke['DBNAME'] = $pnconfig['dbname'];
$pnukepre = $pnconfig['prefix']."_";


// Handle PostNuke login data
global $pnukepre,$pnuke,$DATABASE,$SERVER,$_COOKIE;
mysql_close();
mysql_connect($pnuke['DBHOST'],$pnuke['UNAME'],$pnuke['PWORD']);
mysql_select_db($pnuke['DBNAME']);
if(isset($_COOKIE["POSTNUKESID"])){
	$cvalue = $_COOKIE["POSTNUKESID"];
	$q = DoQuery("SELECT pn_uid FROM {$pnukepre}session_info WHERE pn_sessid='$cvalue'");
	$suid = Do_Fetch_Row($q);
	$q = DoQuery("SELECT pn_uname,pn_pass FROM {$pnukepre}users WHERE pn_uid='$suid[0]'");
	$pnukename = Do_Fetch_Row($q);
	@setcookie("X2CHATU",$pnukename[0],time()+14000000,"$SERVER[PATH]");
	@setcookie("X2CHATP",$pnukename[1],time()+14000000,"$SERVER[PATH]");
	$_COOKIE['X2CHATU'] = $pnukename[0];
	$_COOKIE['X2CHATP'] = $pnukename[1];
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$pnukename[0]'");
	$row = Do_Fetch_Row($q);
	if($row[0] == ""){
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$pnukename[0]','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
	}
}
@mysql_close();

function doXEncrypt($password){
	$password = md5($password);
	return $password;
}

function changePass($password,$username){
	global $pnukepre,$pnuke,$DATABASE;
	mysql_close();
	mysql_connect($pnuke['DBHOST'],$pnuke['UNAME'],$pnuke['PWORD']);
	mysql_select_db($pnuke['DBNAME']);
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$pnukepre}users SET pn_pass='$password' WHERE pn_uname='$username'");
	echo mysql_error();
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}

function getPass($username){
	global $pnukepre,$pnuke,$DATABASE,$SERVER,$_COOKIE;
	mysql_close();
	mysql_connect($pnuke['DBHOST'],$pnuke['UNAME'],$pnuke['PWORD']);
	mysql_select_db($pnuke['DBNAME']);
	$q = DoQuery("SELECT pn_pass FROM {$pnukepre}users WHERE pn_uname='$username'");
	echo mysql_error();
	$pass = Do_Fetch_Row($q);
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
	$row = Do_Fetch_Row($q);
	if($row[0] == "" && $_COOKIE['X2CHATP'] == $pass[0]){
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$username','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
	}
	return $pass[0];
}

// Some Configuration Stuff
$AUTH['CAN_REG'] = 0;
$AUTH['REG_NOTICE_HEADER'] = "Error";
$AUTH['REG_NOTICE'] = "You must already be registered to use this feature.";
$AUTH['COOKIE_USERNAME'] = "X2CHATU";
$AUTH['COOKIE_PASSWORD'] = "X2CHATP";

$changevars['UE'] = 1;
$txt[14] = "";

?> 
