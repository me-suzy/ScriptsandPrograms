<?

////////////////////////////////////////////////////////////////// 
//								//
//		This Xaraya AuthMod was developed by a		//          
//		user of X7 Chat, Richard Virtue.  It is		//
//		based entrirely on the prior ideas and		//
//		concepts contained in the main body of   	//
//   		work by the X7 Group.				//
//   								//
//		The X7 Chat application is			//
//		Copyright (c) 2004 By the X7 Group		//
//		Website: http://www.x7chat.com			//
//							     	//						 //
//////////////////////////////////////////////////////////////////

$donotincluebase = 1;
if($isbase == "notset"){
require("../../var/config.system.php");
}else{
require("../var/config.system.php");
}

// Handle Xaraya Database Data
static $xarVars = NULL;
$xarVars = $systemConfiguration;
$xarPrefix = $xarVars['DB.TablePrefix']."_";


// Handle Xaraya login data
global $xarPrefix,$xarVars,$DATABASE,$SERVER,$_COOKIE;
mysql_close();
mysql_connect($xarVars['DB.Host'],$xarVars['DB.UserName'],$xarVars['DB.Password']);
mysql_select_db($xarVars['DB.Name']);
if(isset($_COOKIE["XARAYASID"])){
	$cvalue = $_COOKIE["XARAYASID"];
	$q = DoQuery("SELECT xar_uid FROM {$xarPrefix}session_info WHERE xar_sessid='$cvalue'");
	$suid = Do_Fetch_Row($q);
	$q = DoQuery("SELECT xar_uname,xar_pass FROM {$xarPrefix}roles WHERE xar_uid='$suid[0]'");
	$xarayaname = Do_Fetch_Row($q);
	@setcookie("X2CHATU",$xarayaname[0],time()+14000000,"$SERVER[PATH]");
	@setcookie("X2CHATP",$xarayaname[1],time()+14000000,"$SERVER[PATH]");
	$_COOKIE['X2CHATU'] = $xarayaname[0];
	$_COOKIE['X2CHATP'] = $xarayaname[1];
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$xarayaname[0]'");
	$row = Do_Fetch_Row($q);
	if($row[0] == ""){
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$xarayaname[0]','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
	}
}
@mysql_close();

function doXEncrypt($password){
	$password = md5($password);
	return $password;
}

function changePass($password,$username){
	global $xarPrefix,$xarVars,$DATABASE;
	mysql_close();
	mysql_connect($xarVars['DB.Host'],$xarVars['DB.UserName'],$xarVars['DB.Password']);
	mysql_select_db($xarVars['DB.Name']);
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$xarPrefix}roles SET xar_pass='$password' WHERE xar_uname='$username'");
	echo mysql_error();
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}

function getPass($username){
	global $xarPrefix,$xarVars,$DATABASE,$SERVER,$_COOKIE;
	mysql_close();
	mysql_connect($xarVars['DB.Host'],$xarVars['DB.UserName'],$xarVars['DB.Password']);
	mysql_select_db($xarVars['DB.Name']);
	$q = DoQuery("SELECT xar_pass FROM {$xarPrefix}roles WHERE xar_uname='$username'");
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
