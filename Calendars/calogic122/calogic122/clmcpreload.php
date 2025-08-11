<?php

/*
CaLogic Mini Cal PreLoader
Copyright Philip Boone, philip@calogic.de

*/
$GLOBALS["CLPATH"] = dirname(__FILE__);
include_once($GLOBALS["CLPATH"]."/mcconfig.php");
include_once($GLOBALS["CLPATH"]."/classes/session.php");
include_once($GLOBALS["CLPATH"]."/include/calfunc.php");
include_once($GLOBALS["CLPATH"]."/include/gfunc.php");

$GLOBALS["mcpiactive"] = 1;

$erfilename = "File: ".substr(__FILE__,strrpos(__FILE__,"/")).";";
$loger = "";

$xplnk = "";
$xptxt = "";
$xnlnk = "";
$xntxt = "";

global $xplnk, $xptxt, $xnlnk, $xntxt;

/***************************************************************
**  This checks if the PHPSESSID has already been set, if not, it sets it
***************************************************************/

#if(!isset($PHPSESSID) || isset($login) ) {

/*
if(!isset($PHPSESSID)) {
    srand((double)microtime()*1000000);
    $xsesid = md5(uniqid(rand()));
} else {
    $xsesid = $PHPSESSID ;
}

/***************************************************************
**  clsession is the session class
***************************************************************/

#$user = new clsession($xsesid);

$user = new clsession();


/***************************************************************
**  this sets the current or selected language, it must be here
    because a user can select a language before logging in on the
    login page
***************************************************************/
if (!isset($langsel)) {
    $user->ssv("langsel","$standardlang");
} else {
    $user->ssv("langsel","$langsel");
}
$langsel = $user->gsv("langsel");
getcurlang($langsel);

// Parse command line
if(isset($gologinform)) {
    #gologin();
}


/* check for functions

if(isset($gosfuncs)) {
    if(isset($qjump)) {
        if($qjump == "goprefs") {
            $goprefs = 1;
        } elseif($qjump == "endsess") {
            $endsess = 1;
        } elseif($qjump == "usersettings") {
            $usersettings = 1;
        } elseif($qjump == "subscriptions") {
            unset($gosfuncs);
        } elseif($qjump == "contacts") {
            $contacts = 1;
        } elseif($qjump == "categories") {
            $categories = 1;
        }
    }
}

*/

/***************************************************************
**  this is the log out portion
**************************************************************
if (isset($endsess)) {

/*
    $user->ssv("logedin",false);
    foreach($user->s_vars as $k1 => $v1) {
        session_unregister("clsession_".$k1);
        unset($GLOBALS["clsession_".$k1]);
    }
    $user->logoff;
    session_unset();
    session_destroy();
    $user->s_vars = array();
    unset($PHPSESSID);
    unset($xsesid);
    unset($user);
    $GLOBALS["HTTP_SESSION_VARS"] = array();
    $HTTP_SESSION_VARS = array();
    $_SESSION = array();


    $user->logoff;

        foreach($_SESSION as $key =>$value) {
            unset($GLOBALS[substr($key,10)]);
	    unset($_SESSION[$key]);
	}

        $user->s_vars = array();
	$_SESSION = array();
	setcookie("CaLogicSessionID" ,"",0,"/");
	setcookie("CaLogicSessionID");
	// Finally, destroy the session.
	session_destroy();

    #$user->logoff;

    gologin();
#}

*/

/***************************************************************
**  this is the login portion, it gets executed at login
***************************************************************/

if(!$user->gsv("logedin")) {

    if(isset($GLOBALS["MCPI_USER"]) && isset($GLOBALS["MCPI_PASS"])) {
        $uname = $GLOBALS["MCPI_USER"];
        $pw = $GLOBALS["MCPI_PASS"];
        $login=1;
        $usertz="no";
        if($uname=="Guest" && $publicview!=true) {
            $login=0;
        } elseif($uname=="Guest" && $publicview==true) {
            $user->ssv("publicviewon",1);
        }
    } else {
        if(!isset($uname)) {
            if($publicview==true) {
                $uname="Guest";
                $pw="Guest";
                $login=1;
                $usertz="no";
                $user->ssv("publicviewon",1);
            }
        }
    }
}

if (isset($login)) {

    $user->logon($uname,$pw);
    if(!$user->gsv("logedin")) {
        $loger = $user->gsv("logoner");
    } else {

      // server time zone in seconds
        $servertz = date("Z",time());
        $user->ssv("servertz",$servertz);

        if($usertz != "no" && $user->gsv("tzlock") != 1) {

        // user time zone in hours made to seconds minus the servers time zone = time zone adjustment
            $user->ssv("usertz",$usertz);
            $caltzadj = ($usertz * 60 * 60) - $servertz;
            $user->ssv("caltzadj",$caltzadj);
        //    $user->ssv("caltzsadj",$caltzadj * 60 * 60);

            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set tzos = $caltzadj where uid = ".$user->gsv("cuid")." limit 1";
            $query = mysql_query($sqlstr) or die("Cannot update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        } else {

        // user time zone in hours made from the currently saved tzos
            $user->ssv("usertz",($user->gsv("caltzadj") / 60 / 60));
            $caltzadj = $user->gsv("caltzadj");
        }


        if($user->gsv("startcalid")<>"0") {
            $user->ssv("curcalid",$user->gsv("startcalid"));
            $user->ssv("curcalname",$user->gsv("startcalname"));
            $gocalselect = 1;
            $calselect = $user->gsv("startcalid");
        }
    }
}


    getuserstandards($user);

?>
