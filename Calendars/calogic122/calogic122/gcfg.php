<?php
/*
CaLogic
Copyright (c) Philip Boone.
philip@calogic.de


*/

//asdbg_break();

/***************************************************************
** CaLogic Version Variable and error reporting variable
***************************************************************/
$calogicversion = "1.2.2";
$errep = "<br><br>Version Info<br><br>CaLogic: ".$calogicversion."<br><br>MySQL: ".mysql_get_client_info()."<br><br>PHP: ".PHP_VERSION."<br><br><br>Please send this information to me, Philip Boone, so that I may correct this error.<br>My adress is philip@calogic.de, thank you";

# Set the CaLogic debugger on or off, if it is on, all kinds of stuff
# will be printed to the screen.

$cldebug=false;
$havegcfg = true;

# check version function
# this is a new function as of 1.2.2
# this should not get called fom the same site it is running on.


	if(isset($_GET["version"])) {
	?>
		<html>
		<head>
		<meta HTTP-EQUIV="Expires" CONTENT="0">
		<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">

		<title>CaLogic Calendars Version Check</title>

	</head>

	<body>
	<h3>Thank you for using CaLogic</h3>
	<?php
	if($_GET["version"] == $calogicversion) {
		?>
		You are using the current version. Thanks for checking!
		<?php
	} else {
		?>
		There is a newer version of CaLogic available!<br><br>
		<a href="http://www.demo.calogic.de" target="_blank">Click here for the demo</a><br><br>
		<a href="http://www.calogic.de/modules/mydownloads/" target="_blank">Click here to downolad the newest version.</a>
		<?php
	}

	?>
	</body>
	</html>

	<?
	exit();
	}


# PHP setup
# script execution time limit
set_time_limit(3600);
ini_set("max_execution_time","3600");

# error reporting
# for release (no warnings or notices)
#ini_set("error_reporting","E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE");
# for debugging
ini_set("error_reporting","E_ALL");

/*
$date_time_array  = getdate($date);

$hours =  $date_time_array["hours"];
$minutes =  $date_time_array["minutes"];
$seconds =  $date_time_array["seconds"];
$month =  $date_time_array["mon"];
$day =  $date_time_array["mday"];
$year =  $date_time_array["year"];

$year +=1;
$cookietimestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
*/
$cookietimestamp =  time() + 31536000;

if(isset($_POST["unpwcookie"])) {
	#$cvexp = dateadd("yyyy",1,time());
	#$uncookieok =
        setcookie("calogicuname", $_POST["uname"],$cookietimestamp);
	#$pwcookieok =
        setcookie("calogicupw", $_POST["pw"],$cookietimestamp);
$xclun = $_POST["uname"];
$xclpw = $_POST["pw"];
#header("Set-Cookie: calogicuname=$xclun; Max-Age=$cookietimestamp; ");
#header("Set-Cookie: calogicupw=$xclpw; Max-Age=$cookietimestamp; ");

	#print "setting cookie<br>";
	#print "UN : ".$_POST["uname"]."<br>";
	#print "PW : ".$_POST["pw"]."<br>";

	#print "UN cookie: ".$uncookieok."<br>";
	#print "PW cookie: ".$pwcookieok."<br>";

#exit();

}


# strip slashes from $_GET and $POST according to how
# magic_quotes is set

# NOTE!! THIS MUST BE EXACTLY HERE!!!

/*
mqfix($_GET,0);
mqfix($_POST,0);
*/
#makevarglobal($_GET);
#makevarglobal($_POST);

import_request_variables("gp");

# make $GET and $_POST global
# I do it like this to prevent warnings when using import_request_variables without a prefix
/*
foreach($_GET as $GetKey => $GetVal) {
  $GLOBALS[$GetKey] = $GetVal;
}


foreach($_POST as $PostKey => $PostVal) {
  $GLOBALS[$PostKey] = $PostVal;
}

*/

#print "VD: ".$viewdate."<br>";
#print "VDG: ".$GLOBALS["viewdate"]."<br>";
#print "GVD: ".$_GET["viewdate"]."<br>";



# (try) to turn off magic_quotes_sybase
ini_set("magic_quotes_sybase","0");
# (try) to turn off magic_quotes_runtime
ini_set("magic_quotes_runtime","0");


$GLOBALS["CLPath"] = dirname(__FILE__);


# prepare sesson ID cookie and start / reload session
$mustsetcookie = true;

if(isset($_POST["emulateuser"])) {
	$login=1;
}

if (isset($_COOKIE["CaLogicSessionID"])){

	$debugstr .= "normal cookie present<br>";
	if($_COOKIE["CaLogicSessionID"] != "") {
		session_id($_COOKIE["CaLogicSessionID"]);
		$mustsetcookie = false;
		$debugstr .= "normal cookie okay<br>";
	}else{
		$debugstr .= "normal cookie is blank<br>";
		$mustsetcookie = true;
	}

}

#header("P3P: CP='NOI DSP COR NID CUR OUR STP UNI'");
#header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');
#header("P3P: CP=\"ALL DSP COR NID CURa OUR STP PUR\"");
session_start();
#header("Cache-control: private"); // IE 6 Fix.

$debugstr .= "SID: ".SID."<br>";
$debugstr .= "session_id: ".session_id()."<br>";

if($mustsetcookie === true) {
	$debugstr .= "setting normal cookie<br>";
	setcookie("CaLogicSessionID", session_id());
	$getsid = session_id();
	#header("Set-Cookie: CaLogicSessionID=$getsid;");
}


# Send no cache headers to the browser.
# this ensures that no CaLogic pages get cached.
# Dynamic pages should not get cached!

// Date in the past
#header("Expires: Sat, 03 Mar 1973 05:00:00 GMT");

// always modified
#header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP/1.1
#header("Cache-Control: no-store, no-cache, must-revalidate");
#header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP/1.0
#header("Pragma: no-cache");

$servertzos = ((date("Z") / 60) / 60);

if($servertzos > 0) {
	$servertzos = "+$servertzos";
} elseif($servertzos < 0) {
	$servertzos = "$servertzos";
}

# the htmldoctype variable gets inserted in each page. it's supposed to ensure a wider range
# of browser compatibility

#$GLOBALS["htmldoctype"] ="";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">\n";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"
#    \"http://www.w3.org/TR/html4/strict.dtd\">";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\"
#   \"http://www.w3.org/TR/html4/strict.dtd\">";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
#   \"http://www.w3.org/TR/html4/loose.dtd\">";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 //EN\"";

#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\">";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
#$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"ISO/IEC 15445:2000//DTD HyperText Markup Language//EN\">";

# this is the only one I found to work with the JavaScript Menus I use,
# but it isn't exactly correct (compliant) because the link to a .dtd document
# is missing.
# To be honest, I really do not care if my coding is W3C compliant or not.
# All I know, is that it works in IE5.5 and above! And that is all I care about.
# What do you expect from a FREE program?

# after reading up a little more on the subject, it seems that this doctype
# causes all browsers to quirk anyway, so it is actually the same as not
# even having one.

$GLOBALS["htmldoctype"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"";


# set some global menu variables

$mainmenu = "";
$mainmenustyle = "";
$menustyle = "";
$weekmenu = "";
$monthmenu = "";
$yearmenu = "";
$calmenu = "";
$funcmenu = "";
$menubarprevlink = "";
$menubarnextlink = "";
$menubarprevlinktext = "";
$menubarnextlinktext = "";
$menubarcurweek = "";
$menubarcurmonth = "";
$menubarcuryear = "";


include_once($GLOBALS["CLPath"]."/classes/cldbclass.php");

$GLOBALS["cldb"] = new cldbclass();
#print "gcfg done<br>";

# un-escape variable(s) of any kind (GET, POST, Data from a MySQL Table or a regular variable.
# it does this properly, no matter how any magic_quote php.ini settings are set!!!

# it works on scalar variables or arrays of any depth.

# I call this function my Magic Quotes who cares how they are set fixer!

# I want to give special thanks to Dewey Williams for inspiring me to finally get this right.

# Parameters:
# $vartofix [mixed] (passed by reference): variable or array to be fixed.
# $vartype [integer]: variable type. This must be set to: 0 or 1 defaults to 0
	# 0 = the variable or array is a GET, POST or COOKIE type
	# 1 = the variable or array is a runtime type (a row or value from a data base query for example)

/*
function mqfix($vartofix, $vartype=0){

	mqfix_go($vartofix, $vartype);

	return($vartofix);

}

*/

# NEW Location for some Global functions.

function logoff() {

	global $user;

	foreach($_SESSION as $key =>$value) {
		unset($GLOBALS[substr($key,10)]);
		unset($_SESSION[$key]);
	}

    $user->s_vars = array();
	$_SESSION = array();

	setcookie("CaLogicSessionID","");
	#setcookie("CaLogicEmulateSessionID","");
	// Finally, destroy the session.
	session_destroy();

}

function stophack(&$inputvar) {

# this function formats input for the dtabase
# this function disables the <script> tag (this is to avoid hacking)


	if (is_array($inputvar)) {

		foreach ($inputvar as $inputvar_key => $inputvar_val ) {

			if (is_array($inputvar_val)) {

				stophack($inputvar_val);

			} else {

				$tempstr1 = "<script ";
				$tempstr2 = "< script ";

				$inputvar[$inputvar_key] = eregi_replace ($tempstr1,$tempstr2,$inputvar[$inputvar_key] );

				$tempstr1 = "<html ";
				$tempstr2 = "< html ";

				$inputvar[$inputvar_key] = eregi_replace ($tempstr1,$tempstr2,$inputvar[$inputvar_key] );

				$tempstr1 = "<body ";
				$tempstr2 = "< body ";

				$inputvar[$inputvar_key] = eregi_replace ($tempstr1,$tempstr2,$inputvar[$inputvar_key] );

				$tempstr1 = "</script";
				$tempstr2 = "< / script ";

				$inputvar[$inputvar_key]  = eregi_replace ($tempstr1,$tempstr2,$inputvar[$inputvar_key] );

				$tempstr1 = "</html";
				$tempstr2 = "< / html ";

				$inputvar[$inputvar_key]  = eregi_replace ($tempstr1,$tempstr2,$inputvar[$inputvar_key] );

				$tempstr1 = "</body";
				$tempstr2 = "< / body ";

				$inputvar[$inputvar_key]  = eregi_replace ($tempstr1,$tempstr2,$inputvar[$inputvar_key] );


			}
		}

	}else {

		$tempstr1 = "<script ";
		$tempstr2 = "< script ";

		$inputvar = eregi_replace ($tempstr1,$tempstr2,$inputvar);

		$tempstr1 = "<html ";
		$tempstr2 = "< html ";

		$inputvar = eregi_replace ($tempstr1,$tempstr2,$inputvar);

		$tempstr1 = "<body ";
		$tempstr2 = "< body ";

		$inputvar = eregi_replace ($tempstr1,$tempstr2,$inputvar);

		$tempstr1 = "</script";
		$tempstr2 = "< / script ";

		$inputvar = eregi_replace ($tempstr1,$tempstr2,$inputvar);

		$tempstr1 = "</html";
		$tempstr2 = "< / html ";

		$inputvar = eregi_replace ($tempstr1,$tempstr2,$inputvar);

		$tempstr1 = "</body";
		$tempstr2 = "< / body ";
		$inputvar = eregi_replace ($tempstr1,$tempstr2,$inputvar);

	}


	#return($retstr);

}

function mqfix_new(&$vartofix, $vartype=0) {

	if (is_array($vartofix)) {


		foreach ($vartofix as $vartofix_key => $vartofix_val ) {

			if (is_array($vartofix_val)) {
				mqrgfix ($vartofix_val,$vartype,$makeglobal);
			} else {

				if($vartype === 0) {

					if(ini_get('magic_quotes_gpc') === "1") {
						if (ini_get('magic_quotes_sybase') === "1") {
							$vartofix[$vartofix_key] = preg_replace("/''/", "'", $vartofix[$vartofix_key]);
						} else {
							$vartofix[$vartofix_key] = stripslashes($vartofix[$vartofix_key]);
						}
					}

				} elseif($vartype === 1) {

					if(ini_get('magic_quotes_runtime') === "1") {
						if (ini_get('magic_quotes_sybase') === "1") {
							$vartofix[$vartofix_key] = preg_replace("/''/", "'", $vartofix[$vartofix_key]);
						} else {
							$vartofix[$vartofix_key] = stripslashes($vartofix[$vartofix_key]);
						}
					}

				} else {
					die("Function mqfix, parameter ".$vartype." not supported<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
				}
			}
		}

	} else {

		if($vartype === 0) {

			if(ini_get('magic_quotes_gpc') === "1") {

				if (ini_get('magic_quotes_sybase') === "1") {
					$vartofix = preg_replace("/''/", "'", $vartofix);
				} else {
					$vartofix = stripslashes($vartofix);
				}
			}

		} elseif($vartype === 1) {

			if(ini_get('magic_quotes_runtime') === "1") {
				if (ini_get('magic_quotes_sybase') === "1") {
					$vartofix = preg_replace("/''/", "'", $vartofix);
				} else {
					$vartofix = stripslashes($vartofix);
				}
			}

		} else {
			die("Function mqfix, parameter ".$vartype." not supported<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
		}

	}

}


# this funtion can translate text into html entities,
# suitable for displaying etc.
function fmthtml(&$inputvar,$inout=0) {

	$htmltrans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
	$transhtml = array_flip($htmltrans);

	if (is_array($inputvar)) {

		foreach ($inputvar as $inputvar_key => $inputvar_val ) {

			if (is_array($inputvar_val)) {
				fmthtml ($inputvar_val,$inout);
			} else {
				if($inout == 0) {
					$inputvar[$inputvar_key] = strtr($inputvar[$inputvar_key],$htmltrans);
				} else {
					$inputvar[$inputvar_key] = strtr($inputvar[$inputvar_key],$transhtml);
				}
			}
		}

	} else {
		if($inout == 0) {
			$inputvar = strtr($inputvar,$htmltrans);
		} else {
			$inputvar = strtr($inputvar,$transhtml);
		}
	}



}

function enderror($message,$file,$line,$sqlres=0,$isdberr=false) {

	global $cldb;

	if($isdberr === true) {
		$sqlertxt = "";
		$sqlerror = "";
		$classertxt = "";
		$classerror = "";
		$sqlstr = "";
	    #$classerror = ($cldb->get_classerror($sqlres,$classertxt)) ? ($classertxt) : ("could not get class error text");
	    #$sqlerror = ($cldb->get_sqlerror($sqlres,$sqlertxt)) ? ($sqlertxt) : ("could not get sql error text");
		$classerror = $cldb->get_classerror($sqlres,$classertxt);
		$sqlerror = $cldb->get_sqlerror($sqlres,$sqlertxt);
		$sqlstrer = $cldb->get_sqlstring($sqlres,$sqlstr);
		if($sqlstrer == false) {
			$sqlstr = "could not get sql string from element: ".$sqlres;
		}
		if($classerror == false) {
			$classertxt = "could not get class error text for sql result: ".$sqlres;
		}
		if($sqlerror == false) {
			$sqlertxt = "could not get SQL Error text for sql result: ".$sqlres;
		}
	    die($message."<br><br>DB Class said: ".$classertxt."<br><br>MySQL said: ".$sqlertxt."<br><br>SQL String: ".$sqlstr."<br><br>File: ".$file."<br><br>Line: ".$line.$GLOBALS["errep"]);
	}else{
	    die($message."<br><br>Line: ".$line.$GLOBALS["errep"]);
	}

}
?>
