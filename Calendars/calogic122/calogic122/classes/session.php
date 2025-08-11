<?php

/***************************************************************
** Title.........: CaLogic Session Control
** Version.......: 1.0
** Author........: Philip Boone <philip@boone.at>
** Filename......: session.php
** Last changed..:
** Notes.........: Based upon ideas and original file from Tim Graf <tim.graf@kcs.info>
** Use...........: This class makes managing sessions and session variables
                   a whole lot easier

** Functions: clsession
              ssv
              gsv
              logon
              logoff

***************************************************************/


class clsession
{

/***************************************************************
** Class Constructor
***************************************************************/

    var $s_vars = array();
#    function clsession($sesvar)
    function clsession()
    {
        #session_id($sesvar);
        #session_start();

        $this->s_vars["gutab"] = $GLOBALS["tabpre"]."_user_reg";

        #foreach($GLOBALS["HTTP_SESSION_VARS"] as $key =>$value) {
        #    $this->s_vars[substr($key,10)] = $value;
	#}

        foreach($_SESSION as $key =>$value) {
            $this->s_vars[substr($key,10)] = $value;
	}

    }


/***************************************************************
** Function ssv: registers a session variable
***************************************************************/

    function ssv($key, $value)
    {
/*
        if(!session_is_registered("clsession_".$key)) {
            session_register("clsession_".$key);
        }
        $GLOBALS["clsession_".$key] = $value;
        $this->s_vars[$key] = $value;
*/
        #if(!isset($_SESSION["clsession_".$key])) {
            $_SESSION["clsession_".$key] = $value;
        #}
        #$GLOBALS["clsession_".$key] = $value;
        $this->s_vars[$key] = $value;

    }

/***************************************************************
** Function gsv: retrieves a session variable
***************************************************************/

    function gsv($key)
    {
	if(isset($this->s_vars[$key]) ) {
	    return $this->s_vars[$key];
	}else{
	    return "";
	}
    }

/***************************************************************
** Function logon: checks user name and password, sets main session
                   variables if a match is found.
***************************************************************/

    function logon($name, $pass) {

	global $cldb;

	$rowcount = "";
	$sqlres = "";
	$eoq = false;
	$row = "";



        if(!isset($name) || !isset($pass)) {
            $this->ssv("logedin", false);
            $this->ssv("logoner", translate("wrongli",$GLOBALS["standardlang"]));
	    return;
	}

	$sqlstr = "select * from ".$this->s_vars["gutab"]." where uname = '".($name)."'";

	if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
	    enderror("Cannot query User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

#print "SQLRESNUM: ".$sqlres."<br><br>";

	if(!$cldb->execute($sqlres,$rowcount)) {
	    enderror("Cannot query User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

#print "Rowcnt: ".$rowcount."<br><br>";

	if($rowcount !== 1) {
#print "login false<br><br>";
	    $this->ssv("logedin", false);
	    $this->ssv("logoner", translate("wrongli",$GLOBALS["standardlang"]));

	    $logentry["uid"] = "0";
	    $logentry["calid"] = "0";
	    $logentry["evid"] = "0";
	    $logentry["adate"] = time();
	    $logentry["laction"] = "Login attempt with invalid user name: ".$name;
	    $logentry["lbefore"] = " ";
	    $logentry["lafter"] = " ";
	    $logentry["remarks"] = " ";
	    histlog($logentry);

	    $cldb->release($sqlres);

	    return;

	}

	if(!$cldb->get_row($sqlres,$row,$eoq)) {
	    enderror("Cannot query User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

	$cldb->release($sqlres);


	if (!($row["emok"]==1 || $this->gsv("emulateuser") === true)) {

	    $logentry["uid"] = "0";
	    $logentry["calid"] = "0";
	    $logentry["evid"] = "0";
	    $logentry["adate"] = time();
	    $logentry["laction"] = "Login attempt before confirming registration";
	    $logentry["lbefore"] = " ";
	    $logentry["lafter"] = " ";
	    $logentry["remarks"] = " ";
	    histlog($logentry);

	    $this->ssv("logedin", false);

	    $tstr1 = translate("regnotconf",$row["langid"]);
	    $tstr1 = str_replace("%email%",$row["email"],$tstr1);
	    $this->ssv("logoner", $tstr1);

	    if(!$row["emok"]==1) {
		regresend($row["fname"],$row["lname"],$row["email"],$row["emailtype"],$row["uname"],$row["language"],$row["regkey"]);
	    }

	    return;

	}

	if (!($row["pw"]==md5($pass) || $this->gsv("emulateuser") === true)) {

	    $sqlstr = "update ".$this->s_vars["gutab"]." set failedli = failedli +1 where uname = '".($name)."'";
	    if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
		enderror("Cannot update User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	    }

	    if(!$cldb->execute($sqlres,$rowcount)) {
		enderror("Error updating User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	    }

	    $cldb->release($sqlres);

	    $logentry["uid"] = $row["uid"];
	    $logentry["calid"] = "0";
	    $logentry["evid"] = "0";
	    $logentry["adate"] = time();
	    $logentry["laction"] = "Wrong password at login";
	    $logentry["lbefore"] = " ";
	    $logentry["lafter"] = " ";
	    $logentry["remarks"] = " ";
	    histlog($logentry);

	    $this->ssv("logedin", false);
	    $this->ssv("logoner", translate("wrongli",$row["langid"]));

	    return;
	}

	if(($row["failedli"] > $GLOBALS["badpwlock"] && $GLOBALS["badpwlock"] > 0) && ($this->gsv("emulateuser") !== true)) {

	    $this->ssv("logedin", false);
	    $this->ssv("logoner", translate("wrongli",$row["langid"]));

	    $logentry["uid"] = $row["uid"];
	    $logentry["calid"] = "0";
	    $logentry["evid"] = "0";
	    $logentry["adate"] = time();
	    $logentry["laction"] = "Locked account login attempt";
	    $logentry["lbefore"] = " ";
	    $logentry["lafter"] = " ";
	    $logentry["remarks"] = " ";
	    histlog($logentry);

	    return;
	}

	$sqlstr = "update ".$this->s_vars["gutab"]." set newpw = 0, failedli=0 where uname = '".($name)."'";

	#$sqlres = $cldb->set_sqlstring($sqlstr);
	#if(!$cldb->exec_nq($sqlres)) {
	    #die("Error updating User Database<br><br>DB Class said: ".$cldb->get_classerror($sqlres)."<br><br>MySQL said: ".$cldb->get_sqlerror($sqlres)."<br><br>SQL String: ".$cldb->get_sqlstring($sqlres)."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
	#}

	if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
	    enderror("Cannot update User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

	if(!$cldb->execute($sqlres,$rowcount)) {
	    enderror("Error updating User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

	$cldb->release($sqlres);


	    $logentry["uid"] = $row["uid"];
	    $logentry["calid"] = "0";
	    $logentry["evid"] = "0";
	    $logentry["adate"] = time();
	    $logentry["laction"] = "User logged on";
	    $logentry["lbefore"] = " ";
	    $logentry["lafter"] = " ";
	    $logentry["remarks"] = " ";
	    histlog($logentry);

	$this->ssv("logedin", true);

	$this->ssv("cuid",$row["uid"]);
	$this->ssv("uname",$row["uname"]);
	$this->ssv("fullname",$row["fname"]." ".$row["lname"]);
	$this->ssv("fname",$row["fname"]);
	$this->ssv("lname",$row["lname"]);
	$this->ssv("langsel",$row["langid"]);
	$this->ssv("langname",$row["language"]);
	$this->ssv("email",$row["email"]);
	$this->ssv("emailtype",$row["emailtype"]);
	$this->ssv("failedli",$row["failedli"]);
	$this->ssv("nextpwdate",$row["nextpwdate"]);
	$this->ssv("isadmin",$row["isadmin"]);
	$this->ssv("startcalid",$row["startcalid"]);
	$this->ssv("startcalname",($row["startcalname"]));
	$this->ssv("regtime",$row["regtime"]);
	$this->ssv("regkey",$row["regkey"]);
	$this->ssv("conftime",$row["conftime"]);
	$this->ssv("curview","");
	$this->ssv("curviewdate","");
	$this->ssv("tzlock",$row["tzlock"]);
	$this->ssv("caltzadj",$row["tzos"]);
	if($row["tzos"] != 0) {
	    $this->ssv("usertz",($row["tzos"] / 60 / 60));
	}else {
	    $this->ssv("usertz","0");
	}
	if($name=="Guest") {
	    $this->ssv("canpost",0);
	} else {
	    $this->ssv("canpost",1);
	}

	$sqlstr = "update ".$this->s_vars["gutab"]." set session = '".session_id()."' where uid = ".$row["uid"]." limit 1";

	#$sqlres = $cldb->set_sqlstring($sqlstr);
	#if(!$cldb->exec_nq($sqlres)) {
	    #die("Error updating User Database<br><br>DB Class said: ".$cldb->get_classerror($sqlres)."<br><br>MySQL said: ".$cldb->get_sqlerror($sqlres)."<br><br>SQL String: ".$cldb->get_sqlstring($sqlres)."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
	#}

	#$cldb->release($sqlres);

	if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
	    enderror("Cannot query User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

	if(!$cldb->execute($sqlres,$rowcount)) {
	    enderror("Error updating User table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
	}

	$cldb->release($sqlres);


    }  // end function


/***************************************************************
** Function logoff: minimal end session functions
**
**
** has been ported out to gcfg.php
**
***************************************************************/
/*
    function logoff()
    {
        #session_unset();
        #session_destroy();

        foreach($_SESSION as $key =>$value) {
            unset($GLOBALS[substr($key,10)]);
	    unset($_SESSION[$key]);
	}

        $this->s_vars = array();
	$_SESSION = array();
	setcookie( "CaLogicSessionID" ,"",0,"/");
	setcookie( "CaLogicSessionID");
	// Finally, destroy the session.
	session_destroy();
    }
*/

}?>
