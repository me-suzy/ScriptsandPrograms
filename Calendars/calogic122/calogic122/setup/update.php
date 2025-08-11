<?php
/*
CaLogic
Copyright (c) Philip Boone.
philip@calogic.de
*/

//asdbg_break();

include("../gcfg.php");

$reconfigfinish = 0;

# set path info
$rootpath = str_replace("\\","/",getcwd());
$pathlen = strlen($rootpath);
$setpath = substr($rootpath,0,$pathlen-5);
$incpath = substr($rootpath,0,$pathlen-5);

$tdir = substr(dirname($_SERVER['PHP_SELF']),1);
$tdir = substr($tdir,0,strlen($tdir)-5);

$wroot = $_SERVER['HTTP_HOST']."/";
$wprogdir = $tdir;

$setpath .= "admin/"; #settings.php";
$incpath .= "include/";

#echo "rootpath: ".$rootpath."<br>";
#echo "setpath: ".$setpath."<br>";
#echo "incpath: ".$incpath."<br>";
#echo "tdir: ".$tdir."<br>";
#echo "wroot: http://".$wroot."<br>";
#echo "wprog: ".$wprogdir."<br>";



$forcedefaultcal = 0;
$rent = strftime("%y%m%d%H%M%S");
$ndblname = "";
$nbdsname = "";

$servertzos = ((date("Z") / 60) / 60);

if($servertzos > 0) {
	$servertzos = "+$servertzos";
} elseif($servertzos < 0) {
	$servertzos = "$servertzos";
}

$havedbloader = false;
$havesettings = false;

include_once("../include/dbfunc.php");
include_once("../classes/htmlMimeMail.php");
include("../include/setuptab.php");
include_once("../admin/dbloader.php");

switch ($setup_step) {

	case "2":
	    $reconfigfinish = 0;
	    setup_head();
            setup_calg();
            break;

	case "3":

        setup_step3();
            print "<br><br>Update finished.<br><br>You should now remove the setup folder from your web.<br><br>
            If you later wish to change any options, please logon as admin and follow the \"CaLogic Configuration\" link<br>
            under the Admin heading on the Functions menu.<br><br>
            <a href=\"".$fields["baseurl"].$fields["progdir"].$GLOBALS["idxfile"]."\">Click here to start CaLogic!</a><br><br>";
            break;
	case "dodbupdate":
	    $reconfigfinish = 1;
	    setup_head();
            dbupdate();
	    break;
	default:
	    $reconfigfinish = 1;
	    setup_head();
            confirmupdate();
}

setup_foot();

exit();

function confirmupdate() {

?>
    <br>Please make sure you are using the newest version of CaLogic before updating<br>
    <a href="http://www.demo.calogic.de/index.php?version=<?php print $GLOBALS["calogicversion"]; ?>" target="_blank">Click here to open a window that will tell you the newest version.</a><br><br>

<?php
    print "<font size='+2'>This update script will update CaLogic from <i>any</i> previous version.<br><br>
    <b>Before running this update, make absolutly sure you have backed up your CaLogic
    Database and web structure.<br>If anything goes wrong during this update, CaLogic may not work any more.<br><br>
    If the update fails, you will need to restore your backups before re-running the update.</b><br><br>
    Close all other browser windows running CaLogic BEFORE starting this update script. If you have CaLogic
    running now, then stop this script by closing this browser window. Then close all browsers that
    have CaLogic running. Then re-start this update script.</font><br><br>";

    print "<form method=\"post\" name=\"calogicupdate\" id=\"calogicupdate\" action=\"update.php\">";
    print "<input type=\"hidden\" name=\"setup_step\" value=\"dodbupdate\">";
    print "<input type=\"submit\" name=\"startupdate\" id=\"startupdate\" value=\"Start Update\"><br><br>";
    print "</form><br><br>";

    return;

}

function setup_head() {
global $reconfigfinish;

    ?>
<?php
print $GLOBALS["htmldoctype"];
?>

    <html>
    <head>
    <title>CaLogic Calendars Update</title>

<?php
include("../configjscript.php");
?>

    </head>

    <body background="<?php print "../img/stonbk.jpg"; ?>" LANGUAGE=javascript onload="return window_onload()">
    <h1>CaLogic Calendars - UPDATE</h1>

<?php
return;
}

function setup_foot() {

// Please do not remove this information
// I worked a lot of long hard hours on this program
// give credit where credit is due.

    ?>

    <center><table border="0" width="100%">
    <tr>
    <td width="20%" align="right">
        <A class="gcprevlink" target="_blank" href="http://sourceforge.net ">
        <IMG src="../img/sf_logo.bmp" width="125" height="37" border="0" alt="SourceForge Logo">
        </A>
    </td>

    <td width="20%" align="left">
        <a target="_blank" class="gcprevlink" href="http://www.mysql.com ">
        <img border="1" width="125" height="37" src="../img/mysql_logo.png" alt="MySQL Logo">
        </a>
    </td>
    <td width="20%" align="center" nowrap>

        <a title="Visit the Home of CaLogic!" target="_blank" class="gcprevlink" href="http://www.calogic.de ">
        <font size="-1">CaLogic Calendars V<?php print $GLOBALS["calogicversion"]; ?></font>
        </a><br>
        <a title="EMail the author!" target="_blank" class="gcprevlink" href="mailto:philip@calogic.de">
        <font size="-1">&#xA9; Philip Boone</font>
        </a>
    </td>

    <td width="20%" align="right">
    <a target="_blank" class="gcprevlink" href="http://www.activestate.com ">
    <img border="1" src="../img/komodo.gif" alt="Komodo Logo">
    </a>
    </td>
    <td width="20%" align="left">
    <a target="_blank" class="gcprevlink" href="http://www.php.net ">
    <img border="1" src="../img/powered_php.gif" alt="PHP Logo">
    </a>
    </td>
    </tr>
    </table>
</center>
</body>
</html>

<?php
    exit();
}

# process submitted configuration form

function setup_step3() {

    global $fields,$tabpre,$calogicversion,$servertzos;
    global $setuptab,$fieldcnt,$reconfigfinish;


    $fields = gmqfix($fields);

    if(!emailok($fields["email"])) {
        print "<h3>".$fields["email"]." is not a valid email address.</br>";
        print "Please check the values and submit again.</h3><br>";
	$reconfigfinish = 0;
	setup_head();
        setup_calg_again();
        setup_foot();
        exit();
    }

    $sqlstr = "DROP TABLE IF EXISTS ".$GLOBALS["tabpre"]."_setup;";
    mysql_query($sqlstr) or die("Cannot execute query.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sitebg = "";

    $sqlstr = "CREATE TABLE ".$GLOBALS["tabpre"]."_setup (";
    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {
            $sqlstr .= $setuptab[$x][1]." ".$setuptab[$x][2].",";
        }
    }
    $sqlstr .= "calogicversion varchar(15) NOT NULL default '$calogicversion'
    ) TYPE=MyISAM COMMENT='CaLogic Setup Table';";


    mysql_query($sqlstr) or die("Cannot execute query.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_setup VALUES (";

    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {
            $sqlstr .= "'".fmtfordb($fields[$setuptab[$x][1]])."',";
        }
    }
    $sqlstr .= "'".$calogicversion."')";

    mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_ini set gcscoif_standardbgimg='".$standardbgimg."' where calid = '0'";
    mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        // --------------------------------------------------------

    if($fields["publicview"] == 1 && $GLOBALS["curpubview"] == 0){

        $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_reg where uname='Guest'";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_ini where calid=-1";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $regtime = time();

        $xmdpw = md5("Guest");

        $istfadmin = 0;

            $gucid = "-1";
            $gucname = "Public";

	$key = makeuid();

        $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_reg (uname,fname,lname,email,pw,emok,langid,language,startcalid,startcalname,tzos,regtime,regkey,isadmin)
        values('Guest','Guest','Guest','guest@dummy.com','$xmdpw',1,1,'English','".$gucid."','".$gucname."',0,$regtime,'$key',$istfadmin)";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_user_reg where uname='Guest'";
        $query1 = mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);


            $new_cal = getcalvals("0");
            $new_cal["calid"] = $gucid;
            $new_cal["calname"] = $gucname;
            $new_cal["caltitle"] = $gucname;
            $new_cal["userid"] = $row["uid"];
            $new_cal["username"] = "Guest";

            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_ini (tuid";
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


    } elseif($fields["publicview"] == 0 && $GLOBALS["curpubview"] == 1) {

        $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_reg where uname='Guest'";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_ini where calid=-1";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
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

	    $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set udefscid=startcalid,udefscname=startcalname";
	    $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

	    $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalid='".$calselect."', startcalname='".fmtfordb($row["calname"],1)."'";
	    $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

	    $sqlstr = "update ".$GLOBALS["tabpre"]."_setup set dispcnpd=0, usercustom=0, forcedefaultcal=1,defaultcalid='".$calselect."', defaultcalname='".fmtfordb($row["calname"],1)."'";
	    $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


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
    global $setuptab,$fieldcnt;

    print "Please check your configuration options, then click \"submit\" at the bottom of this page.<br>";

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_setup";
    $query1 = mysql_query($sqlstr) or die("Database setup table error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $row = mysql_fetch_array($query1);
    $row = gmqfix($row,1);

    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {
            if(!isset($row[$setuptab[$x][1]])) {

# set default values for new fields

               ${$setuptab[$x][1]} = $setuptab[$x][8];
            } else {
                ${$setuptab[$x][1]} = $row[$setuptab[$x][1]];
            }
        }
    }
    mysql_free_result($query1);

?>

    <form method="post" name="calgsetup" id="calgsetup" action="update.php" LANGUAGE=javascript onsubmit="return calgsetup_onsubmit()">

<?php
$inreconfig=0;

include("../include/cfgfrm.php");

?>

        <td width="23%" valign="top" align="center">
        <input type="submit" value="Submit" name="sumbit_step3">
        </td>
        <td width="22%" valign="top" align="center">
        <input type="reset" value="Reset">
        </td>
        <td width="55%" valign="top" align="left">
        &nbsp;
        </td>
      </tr>
    </table>
    </form>
<?php
return;
}

function setup_calg_again() {

    global $tabpre,$servertzos,$wroot,$wprogdir;
    global $setuptab,$fieldcnt,$fields,$calogicversion;


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

    <form method="post" name="calgsetup" id="calgsetup" action="update.php" LANGUAGE=javascript onsubmit="return calgsetup_onsubmit()">

<?php
$inreconfig=0;

include("../include/cfgfrm.php");

?>

        <td width="23%" valign="top" align="center">
        <input type="submit" value="Submit" name="sumbit_step3">
        </td>
        <td width="22%" valign="top" align="center">
        <input type="reset" value="Reset">
        </td>
        <td width="55%" valign="top" align="left">
        &nbsp;
        </td>
      </tr>
    </table>
    </form>
<?php
return;
}


function dbupdate() {
    global $tabpre,$servertzos,$wroot,$wprogdir;
    global $setuptab,$fieldcnt,$fields,$calogicversion;

    include("dbupdate.php");

    print "<br><br>Database update finished.<br><br>Click Next to continue<br><br>";
    print "<form method=\"post\" name=\"calnext\" id=\"calnext\" action=\"update.php\">";
    print "<input type=\"hidden\" name=\"setup_step\" value=\"2\">";
    print "<input type=\"submit\" name=\"nextstep\" id=\"nextstep\" value=\"Next\"><br><br>";
    print "</form><br><br>";

}
?>

