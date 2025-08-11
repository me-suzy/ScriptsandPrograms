<?php
/*
CaLogic
Copyright (c) Philip Boone.
philip@calogic.de
*/

//asdbg_break();

ini_set("error_reporting","E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_CORE_WARNING|E_PARSE");

$servertzos = ((date("Z") / 60) / 60);

if($servertzos > 0) {
	$servertzos = "+$servertzos";
} elseif($servertzos < 0) {
	$servertzos = "$servertzos";
}

include_once("./include/config.php");
include_once($GLOBALS["CLPath"]."/classes/session.php");
include_once($GLOBALS["CLPath"]."/include/gfunc.php");
include_once($GLOBALS["CLPath"]."/classes/calogicautomation.php");

$reconfigfinish = 0;
/*
if(!isset($PHPSESSID)) {
    print "nosid<br>";
    srand((double)microtime()*1000000);
    $xsesid = md5(uniqid(rand()));
} else {
    $xsesid = $PHPSESSID ;
    print "sid: ".$xsesid."<br>";
}
*/
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

#print "isadmin: ".$user->gsv("isadmin")."<br>";
#print "uid: ".$user->gsv("cuid")."<br>";
#print "uname: ".$user->gsv("uname")."<br>";

if($user->gsv("isadmin")==1 || $GLOBALS["demomode"] == true) {

switch ($setup_step) {

	case "3":
	    setup_step3();
                print "<br><br>Reconfig finished.<br><br>Please close this window.<br><br>";
		break;

	default:
	setup_head();
        setup_calg();
}

setup_foot();

#print "<br><br>";
#print $rootpath."<br>";
#print $pathlen."<br>";
#print $modpath."<br>";

exit();

} else {


    # not admin!!!

?>
<?php
print $GLOBALS["htmldoctype"];
?>

    <html>
    <head>
    <title>CaLogic Calendars</title>

<body <?php print $GLOBALS["sysbodystyle"]; ?>>

<h1>you are not the Administrator!<h1>
</body>
</html>
<?php
exit();

}

function setup_head() {

global $user,$reconfigfinish;

    ?>
    <?php
    print $GLOBALS["htmldoctype"];
    ?>

    <html>
    <head>
    <title>CaLogic Calendars - Configure</title>

    <?php
    include($GLOBALS["CLPath"]."/configjscript.php");
    ?>

    </head>

    <body <?php print $GLOBALS["sysbodystyle"]; ?> LANGUAGE=javascript onload="return window_onload()">
    <h1>CaLogic Calendars - Configure</h1>
    This configuration runs in its own window. To cancel, simply close the window.<br><br>
    <a href="http://www.demo.calogic.de/?version=<?php print $GLOBALS["calogicversion"]; ?>" target="_blank">Click here to open a window that checks for updates to CaLogic.</a><br><br>

    <?php

    if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
	print "<h3>NOTE: The configuration cannot be changed on this demo site.</h3>";
    }

    return;

}

function setup_foot() {
    include($GLOBALS["CLPath"]."/include/footer.php");
}

function setup_step3() {

global $fields,$tabpre,$calogicversion,$servertzos,$reconfigfinish,$user;

    $fields = gmqfix($fields);
    #mqfix($fields);

    if(!emailok($fields["email"])) {
        print "<h3>".$fields["email"]." is not a valid email address.</br>";
        print "Please check the values and submit again.</h3><br>";
	$reconfigfinish = 0;
	setup_head();
        setup_calg_again();
        setup_foot();
        exit();
    }

        $sitebg = "";
        $sqlstr = "update ".$tabpre."_setup set ";
        foreach($fields as $k1 => $v1) {
            if($k1=="standardbgimg") {
                $sitebg=$v1;
            }
            $v1 = fmtfordb($v1);
            $sqlstr .= "$k1='$v1',";
        }

        $sqlstr .= "calogicversion='$calogicversion'";

        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "update ".$tabpre."_cal_ini set gcscoif_standardbgimg='".$sitebg."' where calid = '0'";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        // --------------------------------------------------------

    if($fields["publicview"] == 1 && $GLOBALS["curpubview"] == 0){

        #$sqlstr = "delete from ".$tabpre."_user_reg where uname='Guest'";
        #mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        #$sqlstr = "delete from ".$tabpre."_cal_ini where calid=-1";
        #mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $regtime = time();

        $xmdpw = md5("Guest");

        $istfadmin = 0;

	$gucid = "-1";
	$gucname = "Public";

	$key = makeuid();

        $sqlstr = "insert into ".$tabpre."_user_reg (uname,fname,lname,email,pw,emok,langid,language,startcalid,startcalname,tzos,regtime,regkey,isadmin)
        values('Guest','Guest','Guest','guest@dummy.com','$xmdpw',1,1,'English','".$gucid."','".$gucname."',0,$regtime,'$key',0)";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "select uid from ".$tabpre."_user_reg where uname='Guest'";
        $query1 = mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);


            $new_cal = getcalvals("0");
            $new_cal["calid"] = $gucid;
            $new_cal["calname"] = $gucname;
            $new_cal["caltitle"] = $gucname;
            $new_cal["userid"] = $row["uid"];
            $new_cal["username"] = "Guest";

            $sqlstr = "INSERT INTO ".$tabpre."_cal_ini (tuid";
            foreach($new_cal as $k1 => $v1) {
                if($k1<>"tuid") {
                    $sqlstr .= ",".$k1;
                }
            }
            $sqlstr .= ") values (''";

            foreach($new_cal as $k1 => $v1) {
                if($k1<>"tuid") {
                    $sqlstr .= ",'".$v1."'";
                }
            }
            $sqlstr .= ")";

            $query1 = mysql_query($sqlstr) or die("Cannot save Calendar Config<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    #} elseif(($fields["publicview"] == 0 && $GLOBALS["curpubview"] == 1) || $fields["publicview"] == 0) {
    } elseif(($fields["publicview"] == 0 && $GLOBALS["curpubview"] == 1)) {

        #$sqlstr = "delete from ".$tabpre."_user_reg where uname='Guest'";
        #mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        #$sqlstr = "delete from ".$tabpre."_cal_ini where calid=-1";
        #mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "select calogic_uid from ".$tabpre."_setup";
        $query1 = mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);
	$calogickey = $row["calogic_uid"];
	@mysql_free_result($query1);

	$retval = automation_delete_user($calogickey,$usernamedelete="Guest");
	if($retval["result"] != true) {
	    die($retval["messagehtml"]);
	}

    }

    if($fields["forcedefaultcal"]==1 && $GLOBALS["forcedefaultcal"]==0) {

	$calselect = $fields["defaultcalid"];
	$sqlstr = "select count(*) as defcalcnt from ".$GLOBALS["tabpre"]."_cal_ini where calid='".$calselect."'";


	$query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
	$row = mysql_fetch_array($query1);
	$defcalcnt = $row["defcalcnt"];
	@mysql_free_result($query1);


	if($defcalcnt == 1) {

	    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid='".$calselect."'";


	    $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
	    $row = mysql_fetch_array($query1);
	    $row = gmqfix($row,1);
	    #mqfix($row,1);

	    $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set udefscid=startcalid,udefscname=startcalname";
	    $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

	    $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalid='".$calselect."', startcalname='".fmtfordb($row["calname"],1)."'";
	    $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

	    $sqlstr = "update ".$GLOBALS["tabpre"]."_setup set dispcnpd=0, usercustom=0, forcedefaultcal=1,defaultcalid='".$calselect."', defaultcalname='".fmtfordb($row["calname"],1)."'";
	    $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
	    $user->ssv("startcalid",$calselect);
	    $user->ssv("startcalname",($row["calname"]));


	    $GLOBALS["forcedefaultcal"]=1;
	    $GLOBALS["defaultcalid"]=$calselect;
	    $GLOBALS["defaultcalname"]=($row["calname"]);


	    @mysql_free_result($query1);

	} else {
	    die("Calendar not found or CalID not unique in Config Table<br><br>File:".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]."<br><br>SQL String: ".$sqlstr);
	}


    } elseif($fields["forcedefaultcal"]==0 && $GLOBALS["forcedefaultcal"]==1) {

	$sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalid=udefscid,startcalname=udefscname";
	$query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

	$GLOBALS["forcedefaultcal"]=0;
	$GLOBALS["defaultcalid"]="";
	$GLOBALS["defaultcalname"]="";

    }


	$reconfigfinish = 1;
    	setup_head();
	return;


}

function setup_calg() {

global $tabpre,$servertzos,$wroot,$wprogdir;
global $setuptab,$fieldcnt,$user;

    $sqlstr = "select * from ".$tabpre."_setup";
    $query1 = mysql_query($sqlstr) or die("Database setup table error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


$row = mysql_fetch_array($query1);
$row = gmqfix($row,1);
#mqfix($row,1);

for($x=0;$x<$fieldcnt;$x++) {
    if($setuptab[$x][1] != "tabhead") {
        if(!isset($row[$setuptab[$x][1]])) {

# set defaule values for new fields. i.e. fields that are in setuptab.php but not in the database
# NOTE that this should be immpossible in this re-config page!!!!

           ${$setuptab[$x][1]} = $setuptab[$x][8];
        } else {
            ${$setuptab[$x][1]} = $row[$setuptab[$x][1]];
        }

    }
}
mysql_free_result($query1);

?>
    <form method="post" name="calgsetup" id="calgsetup" action="reconfig.php" LANGUAGE=javascript onsubmit="return calgsetup_onsubmit()">

<?php
$inreconfig=1;
include($GLOBALS["CLPath"]."/include/cfgfrm.php");
$disablebut = "";
if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
    $disablebut = " disabled ";
}
?>
        <td width="23%" valign="top" align="center">
        <input <?php print $disablebut; ?> type="submit" value="Submit" name="sumbit_step3">
        </td>
        <td width="22%" valign="top" align="center">
        <input  <?php print $disablebut; ?> type="reset" value="Reset">
        </td>
        <td width="55%" valign="top" align="left">
        &nbsp;
        </td>
      </tr>
    </table>

    </form>
<?php
if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
    print "<h3>NOTE: The configuration cannot be changed on this demo site.</h3>";
}

}


function setup_calg_again() {

global $tabpre,$servertzos,$wroot,$wprogdir;
global $setuptab,$fieldcnt,$user,$fields,$calogicversion;;

for($x=0;$x<$fieldcnt;$x++) {
    if($setuptab[$x][1] != "tabhead") {
        if(!isset($fields[$setuptab[$x][1]])) {
           ${$setuptab[$x][1]} = $setuptab[$x][8];
        } else {
            ${$setuptab[$x][1]} = $fields[$setuptab[$x][1]];
        }
    }
}

?>

    <form method="post" name="calgsetup" id="calgsetup" action="reconfig.php" LANGUAGE=javascript onsubmit="return calgsetup_onsubmit()">

<?php
$inreconfig=1;
include($GLOBALS["CLPath"]."/include/cfgfrm.php");
$disablebut = "";
if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
    $disablebut = " disabled ";
}

?>
        <td width="23%" valign="top" align="center">
        <input <?php print $disablebut; ?> type="submit" value="Submit" name="sumbit_step3">
        </td>
        <td width="22%" valign="top" align="center">
        <input <?php print $disablebut; ?> type="reset" value="Reset">
        </td>
        <td width="55%" valign="top" align="left">
        &nbsp;
        </td>
      </tr>
    </table>

    </form>

<?php
if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
    print "<h3>NOTE: The configuration cannot be changed on this demo site.</h3>";
}

}
?>

