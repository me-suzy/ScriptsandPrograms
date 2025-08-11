<?php

/***************************************************************
** Title.........: CaLogic main program file
** Version.......: 1.0
** Author........: Philip Boone <philip@calogic.de>
** Filename......: index.php (variable)
** Last changed..:
** Notes.........: Other than the registering process files, setup, update and reconfig, this is the only file
                   that ever gets called in a url.
** Use...........: This is the main decision making / process branching program

** Functions: this is more of a "sectioned" program, that gets executed on
              a logical basis. (hence the name CaLogic (CAlendar LOGICal)
              the relevant sections are marked. The sections could probably easily
              be made into functions, but that wouldn't be logical now would it? :)
              It does have one function though: gologin, it is the login form, and I
              only made it a function because I needed to call it at different parts
              of the program.

***************************************************************/

/***************************************************************
** included files
** NOTE: do not change the order of appearance
***************************************************************/
#print "FILE: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br>";
#print "FILE: ".__FILE__."<br>";
#print "FILE:"."<br>";
#$CLPath = substr(__FILE__,0,strlen(__FILE__)-10);
$GLOBALS["CLPath"] = dirname(__FILE__);
include($GLOBALS["CLPath"]."/include/config.php");
include($GLOBALS["CLPath"]."/include/useredit.php");
include($GLOBALS["CLPath"]."/classes/session.php");
include($GLOBALS["CLPath"]."/include/calfunc.php");
include($GLOBALS["CLPath"]."/include/calsetup.php");
include($GLOBALS["CLPath"]."/include/gfunc.php");
include($GLOBALS["CLPath"]."/include/eventform.php");
include($GLOBALS["CLPath"]."/include/editeventform.php");

#$wroot
/*
if(isset($_POST["unpwcookie"])) {
	$cvexp = dateadd("yyyy",1,time());
	#$uncookieok =
        setcookie("calogicuname", $_POST["uname"],$cvexp);
	#$pwcookieok =
        setcookie("calogicupw", $_POST["pw"],$cvexp);

	print "setting cookie<br>";
	print "UN : ".$_POST["uname"]."<br>";
	print "PW : ".$_POST["pw"]."<br>";

	#print "UN cookie: ".$uncookieok."<br>";
	#print "PW cookie: ".$pwcookieok."<br>";

#exit();

}
*/

$cluname="";
$clpw="";

if(!isset($printfriend)) {
    $printfriend=false;
}else{
    $printfriend=true;
}

$newmenu="";

$xcid = 0;

if($rinterval > 3) {
    $rinterval = 3;
    $rfrequency = 1;
}
if($rinterval < 1) {
    $rinterval = 1;
    $rfrequency = 5;
}
if($rfrequency < 1) {
    $rfrequency = 1;
}
if($rdahead < 1) {$rdahead = 1;}
if($rdahead > 365) {$rdahead = 365;}

if($rinterval == 1) {
    $rminmin = $rfrequency;
    $rminmax = 60;
    $rhourmin = 1;
    $rhourmax = 24;
    $rdaymin = 1;
    $rdaymax = $rdahead;
    $rfrtval = "Minute(s)";
} elseif($rinterval == 2) {
    $rminmin = 0;
    $rminmax = 0;
    $rhourmin = $rfrequency;
    $rhourmax = 24;
    $rdaymin = 1;
    $rdaymax = $rdahead;
    $rfrtval = "Hour(s)";
} elseif($rinterval == 3) {
    $rminmin = 0;
    $rminmax = 0;
    $rhourmin = 0;
    $rhourmax = 0;
    $rdaymin = $rfrequency;
    $rdaymax = $rdahead;
    $rfrtval = "Day(s)";
}

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

//if(!isset($PHPSESSID) || isset($login) ) {
/*
if(!isset($PHPSESSID)) {
    srand((double)microtime()*1000000);
    $xsesid = md5(uniqid(rand()));
} else {
    $xsesid = $PHPSESSID ;
}
*/

/***************************************************************
**  clsession is the session class
***************************************************************/
#$user = new clsession($xsesid);
$user = new clsession();

#print "user set <br>";

/***************************************************************
**  this sets the current or selected language, it must be here
    because a user can select a language before logging in on the
    login page
***************************************************************/
if(!$user->gsv("logedin")) {

    $user->ssv("langsel","$standardlang");
    $user->ssv("publangsel","$standardlang");

}

if (!isset($langsel) && !isset($publangsel)) {

    if($user->gsv("publicviewon")==1) {
        $langsel = $user->gsv("publangsel");
    }else{
        $langsel = $user->gsv("langsel");
    }

    getcurlang($langsel);

} elseif (isset($langsel)) {

    $user->ssv("langsel","$langsel");
    $langsel = $user->gsv("langsel");

    getcurlang($langsel);
    gologin();

} elseif (isset($publangsel)) {

    $user->ssv("langsel","$publangsel");
    $user->ssv("publangsel","$publangsel");
    $langsel = $user->gsv("publangsel");

    getcurlang($langsel);

}


// Parse command line
if(isset($gologinform)) {
    gologin();
}


/* check for functions */

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
        } elseif($qjump == "databasemaint") {
            $databasemaint = 1;
        }
    }
}

/***************************************************************
**  this is the log out portion
***************************************************************/
if (isset($endsess)) {

    logoff();


    $langsel = $standardlang;
    $user="";

    getcurlang($langsel);
    gologin();
}



/***************************************************************
**  this is the login portion, it gets executed at login
***************************************************************/

if (isset($gopubcal)) {

    if($publicview==true) {
        $uname="Guest";
        $pw="Guest";
        $login=1;
        $usertz="no";
        $user->ssv("publicviewon",1);
        $user->ssv("publangsel","$publangsel");
    }

} elseif(!$user->gsv("logedin")) {

    $login=1;
    if(!isset($uname)) {
        if($publicview==true) {
            $uname="Guest";
            $pw="Guest";
            $login=1;
            $usertz="no";
            $user->ssv("publicviewon",1);
            $user->ssv("publangsel","$publangsel");
        }
    }
}

if (isset($login)) {

    $user->ssv("emulateuser", false);

    if(checkinput(mqfix($uname)) == false) {
        $user->ssv("logedin", false);
        $user->ssv("logoner", translate("wrongli",$GLOBALS["standardlang"]));
        $loger = $user->gsv("logoner");
    } else {

        if(isset($_POST["emulateuser"])) {
            if(isset($_POST["clseckey"])) {
                if($_POST["clseckey"] === $GLOBALS["calogic_uid"]) {
                    if(isset($_POST["username"])) {
                        $uname = $_POST["username"];
                        $user->ssv("emulateuser", true);
                        $pw = "";
                    }else{
                        exit();
                    }
                }else{
                    exit();
                }
            }else{
                exit();
            }
        }

        $user->logon($uname,$pw);
    }
    if(!$user->gsv("logedin")) {

        $loger = $user->gsv("logoner");

    } else {
/*
        if(isset($_POST["unpwcookie"])) {
            $cvexp = dateadd("yyyy",1,time());
            $uncookieok = setcookie ("calogicunpw[cluname]", $_POST["uname"],$cvexp);
            $pwcookieok = setcookie ("calogicunpw[clpw]", $_POST["pw"],$cvexp);

print "setting cookie<br>";
#print "UN : ".$uname."<br>";
#print "PW : ".$pw."<br>";

print "UN cookie: ".$uncookieok."<br>";
print "PW cookie: ".$pwcookieok."<br>";


        }
*/
        if (isset($gopubcal)) {
            $langsel = $publangsel;
        } else {
            $langsel = $user->gsv("langsel");
        }
#    print "lang5: ".$langsel;

            getcurlang($langsel);

#        print $langsel;
#        exit();


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

            $caltzadj = $user->gsv("caltzadj");
            if($caltzadj != 0) {
                $usertz = ($caltzadj / 60 / 60);
            } else {
                $usertz = 0;
            }
            $user->ssv("usertz",$usertz);
        }

        if($user->gsv("startcalid")<>"0") {
            $user->ssv("curcalid",$user->gsv("startcalid"));
            $user->ssv("curcalname",$user->gsv("startcalname"));
            $gocalselect = 1;
            $calselect = $user->gsv("startcalid");
        }
    }
}


if($user->gsv("logedin")) {

    if(isset($setnewpw) && $setnewpw=="1") {
        $setnextpwdate = dateadd("d",$GLOBALS["maxpwdays"],time());
        $pw1 = mqfix($pw1);
        $pw2 = mqfix($pw2);

        #mqfix($pw1);
        #mqfix($pw2);

        unset($savenewpw);
        if(strlen($pw1) < $GLOBALS["minpwlen"]) {
            $newpwerr = 1;
            $loger = "The password you entered is too short. Min length is ".$GLOBALS["minpwlen"].". Please try again.";
            gogetnewpw();
        }

        $sqlstr = "select pw from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$user->gsv("cuid");
        $query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        while($row = mysql_fetch_array($query1) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"])) {
            $row = gmqfix($row,1);
            #mqfix($row,1);
            $tcurpw = $row["pw"];
            break;
        }
        @mysql_free_result($query1);

        if($GLOBALS["maxpwinterval"] > 0) {

            if(md5($pw1) == $tcurpw) {
                $newpwerr = 1;
                $loger = "You entered your current password. Please enter a new password.";
                @mysql_free_result($query1);
                gogetnewpw();
            }

            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_log where uid = ".$user->gsv("cuid")." and laction = 'New password set' order by hldate desc limit ".$GLOBALS["maxpwinterval"];
            $query1 = mysql_query($sqlstr) or die("Cannot query log Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            while($row = @mysql_fetch_array($query1)) {
                $row = gmqfix($row,1);
                #mqfix($row,1);
                if(md5($pw1) == $row["lbefore"]) {
                    $newpwerr = 1;
                    $loger = "You entered a previously used password. Please enter a new password.";
                    @mysql_free_result($query1);
                    gogetnewpw();
                }
             }
             @mysql_free_result($query1);

            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set pw = '".md5($pw1)."', nextpwdate=".$setnextpwdate." where uid = ".$user->gsv("cuid");
            $query1 = mysql_query($sqlstr) or die("Cannot update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $logentry["uid"] = $user->gsv("cuid");
            $logentry["calid"] = "0";
            $logentry["evid"] = "0";
            $logentry["adate"] = time();
            $logentry["laction"] = "New password set";
            $logentry["lbefore"] = $tcurpw;
            $logentry["lafter"] = " ";
            $logentry["remarks"] = " ";
            histlog($logentry);
            $user->ssv("nextpwdate",time()+($GLOBALS["maxpwdays"]*86400)) ;
        } else {

            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set pw = '".md5($pw1)."', nextpwdate=".$setnextpwdate." where uid = ".$user->gsv("cuid");
            $query1 = mysql_query($sqlstr) or die("Cannot update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $logentry["uid"] = $user->gsv("cuid");
            $logentry["calid"] = "0";
            $logentry["evid"] = "0";
            $logentry["adate"] = time();
            $logentry["laction"] = "New password set";
            $logentry["lbefore"] = $tcurpw;
            $logentry["lafter"] = " ";
            $logentry["remarks"] = " ";
            histlog($logentry);
            $user->ssv("nextpwdate",$setnextpwdate);
        }
    }

    if(time()+$user->gsv("caltzadj") > $user->gsv("nextpwdate") && $GLOBALS["maxpwdays"] > 0 && $user->gsv("uname") != "Guest" && $user->gsv("uname") != "demo") {
        #$newpwerr = 1;
        #$loger = "gping to new pw.";
        gogetnewpw();
    }

}

/***************************************************************
**  the next portion only gets executed if the user is logged in,
    if not everything gets skipped, and the login form is called.
    If a user often lands at the login form even if they are loggeg in,
    it usually means there is a problem with the session or session variables.
***************************************************************/
if($user->gsv("logedin")) {

    // the index.php got to be to large, so I ported some of it out to different core files
    // do not move the position of this include!!!
    include_once($GLOBALS["CLPath"]."/include/core1.php");


/***************************************************************
**  if none of the above sections gets called, these variables
    must be set for all other functions to work
***************************************************************/

    $weekstartonmonday = $curcalcfg["weekstartonmonday"];
    $dispwnum =  $curcalcfg["showweek"];
    $weekselreact =  $curcalcfg["weekselreact"];
    $daybeginhour =  $curcalcfg["daybeginhour"];
    $dayendhour =  $curcalcfg["dayendhour"];
    $dayhourcount = ($dayendhour - $daybeginhour)+1;

    setviewtext($langsel);

    // the index.php got to be to large, so I ported some of it out to different core files
    // do not move the position of these includes!!!

    include_once($GLOBALS["CLPath"]."/include/efuncs.php");

# begin efuncs.php

# end efuncs.php


    include_once($GLOBALS["CLPath"]."/include/sfuncs.php");


/***************************************************************
**  so, if we make it this far, then time to show the calendar
***************************************************************/

    include_once($GLOBALS["CLPath"]."/include/dvfunc.php");
    include_once($GLOBALS["CLPath"]."/include/wvfunc.php");
    include_once($GLOBALS["CLPath"]."/include/mvfunc.php");
    include_once($GLOBALS["CLPath"]."/include/yvfunc.php");

    include_once($GLOBALS["CLPath"]."/include/vhfunc.php");
    #include_once($GLOBALS["CLPath"]."/include/vhfuncnew.php");

    $haveusercurview = false;
    $haveusercurviewdate = false;
    if(isset($weeksel)) {
        $viewtype="Week";
        $viewdate = $weeksel;
        #$haveusercurview = true;
    } elseif(isset($monthsel)) {
        $viewtype="Month";
        $viewdate = $monthsel;
        #$haveusercurview = true;
    } elseif(isset($yearsel)) {
        $viewtype="Year";
        $viewdate = $yearsel;
        #$haveusercurview = true;
    } else {
        if(!isset($viewtype)) {
            if($user->gsv("curview") == "") {
                $user->ssv("curview",$curcalcfg["preferedview"]) ;
                $viewtype=$curcalcfg["preferedview"]; //"Month";
            } else {
                $viewtype=$user->gsv("curview");
                $haveusercurview = true;
            }
        }
        if(!isset($viewdate)) {
            $sdtx = time() + $user->gsv("caltzadj");
            $txvd = strftime("%Y",$sdtx).strftime("%m",$sdtx).strftime("%d",$sdtx);

            if($user->gsv("curviewdate") == "") {
                $user->ssv("curviewdate",$txvd);
                $viewdate = $txvd;
            } else {
                $viewdate = $user->gsv("curviewdate");
                $haveusercurviewdate = true;
            }
        }
    }

    $startyear=substr($viewdate,0,4);
    $startmonth=substr($viewdate,4,2);
    $startday=substr($viewdate,6,2);

    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);


    if($viewtype=="Week" && !isset($weeksel) && $haveusercurviewdate == false) {

        $firstweekdaynum = strftime("%w",mktime(0,0,0,$startmonth,$startday,$startyear));
        if($firstweekdaynum == 0) {$firstweekdaynum = 7;}

        if ($weekstartonmonday==0) {
            $firstweekdaynum++;
            if($firstweekdaynum>7){$firstweekdaynum=1;}
        }
        $firstweekdaynum--;
        $tval = dateadd("d",$firstweekdaynum*-1,$cuts);

        $tvaly = strftime("%Y",$tval);
        $tvalm = strftime("%m",$tval);
        $tvald = strftime("%d",$tval);

        $viewdate = $tvaly.$tvalm.$tvald;

    }

    if($viewtype=="Month" && !isset($monthsel) && $haveusercurviewdate == false) {

        $tval = time();
        $tvaly = strftime("%Y",$tval);
        $tvalm = strftime("%m",$tval);
        $tvald = "01";

        $viewdate = $tvaly.$tvalm.$tvald;

    }

    if($viewtype=="Year" && !isset($yearsel) && $haveusercurviewdate == false) {

        $tval = time();
        $tvaly = strftime("%Y",$tval);
        $tvalm = "01";
        $tvald = "01";

        $viewdate = $tvaly.$tvalm.$tvald;

    }

    $user->ssv("curview",$viewtype) ;
    $user->ssv("curviewdate",$viewdate);

//    print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\">\n";


/***************************************************************
**  begin calendar html
***************************************************************/

print $GLOBALS["htmldoctype"];

    print "<html>\n";
    print "<head>\n";

    print "<title>$viewtype&nbsp;View - ".$GLOBALS["sitetitle"]."</title>\n";

# setup links for jscript menu

# previous


    if ($viewtype == "Day") {
        $preview = dateadd("d",-1,$cuts);

    } else if ($viewtype == "Week") {
        $preview = dateadd("d",-7,$cuts);

    } else if ($viewtype == "Month") {
        $preview = dateadd("m",-1,$cuts);

    } else if ($viewtype == "Year") {
        $preview = dateadd("yyyy",-1,$cuts);
    }

    $lyear = strftime("%Y",$preview);
    $lmonth = strftime("%m",$preview);
    $lday = strftime("%d",$preview);

    $GLOBALS["xplnk"] = $lyear.$lmonth.$lday;
    $GLOBALS["xptxt"] = $viewtype;

# next

    if ($viewtype == "Day") {
        $nextview = dateadd("d",1,$cuts);

    } else if ($viewtype == "Week") {
        $nextview = dateadd("d",7,$cuts);

    } else if ($viewtype == "Month") {
        $nextview = dateadd("m",1,$cuts);

    } else if ($viewtype == "Year") {
        $nextview = dateadd("yyyy",1,$cuts);
    }

    $lyear = strftime("%Y",$nextview);
    $lmonth = strftime("%m",$nextview);
    $lday = strftime("%d",$nextview);

    $GLOBALS["xnlnk"] = $lyear.$lmonth.$lday;
    $GLOBALS["xntxt"] = $viewtype;


    include($GLOBALS["CLPath"]."/include/style.php");

#print "<!-- Copyright C 2001 Garrett S. Smith (DHTML Kitchen) http://dhtmlkitchen.com/ - Email: admin@dhtmlkitchen.com -->\n";
#print "<!-- Courtesy of SimplytheBest.net - http://simplythebest.net/scripts/ -->\n";
#print "<script src=\"./include/menubarAPI4.js\" type=\"text/javascript\"></script>\n";
#print "<script src=\"./include/init.js\" type=\"text/javascript\"></script>\n";

    include($GLOBALS["CLPath"]."/include/jscript.php");

    print "</head>\n";


#    if($GLOBALS["btxtfont"] != "") {
#        $bodyfont .= "font-family: ".$GLOBALS["btxtfont"]."; ";
#    } else {
#        $bodyfont ="";
#    }


#    print "<body bgcolor=\"".$GLOBALS["standardbgcolor"]."\"  style=\"".$bodyfont." color: ".$GLOBALS["btxtcolor"]."\" background=\"".$curcalcfg["gcbgimg"]."\" LANGUAGE=javascript onload=\"return window_onload()\" onresize=\"return window_onresize()\">\n";
    print "<body ".$GLOBALS["calbodystyle"]." LANGUAGE=javascript onload=\"return window_onload()\" onresize=\"return window_onresize()\">\n";
    print "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>\n";
    print "<script language=\"JavaScript\" src=\"./include/overlib_mini.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";
    print "<script language=\"JavaScript\" src=\"./include/overlib_anchor_mini.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";
    print "<script language=\"JavaScript\" src=\"./include/overlib_exclusive_mini.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";

//    print SID;
?>
<SCRIPT ID=menubuilder LANGUAGE=javascript>
<!--
function setmenuin(menuitem) {
//alert(menuitem);
    document.all.item(menuitem).bgColor = "<?php print $curcalcfg["pu_MenuItemHighlightColor"]; ?>";
    document.all.item(menuitem).style.fontFamily = "<?php print $curcalcfg["pu_MenuItemHighlightFont"]; ?>";
    document.all.item(menuitem).style.color = "<?php print $curcalcfg["pu_MenuItemHighlightFontColor"]; ?>";

}

function setmenuout(menuitem) {
//alert(menuitem);
    document.all.item(menuitem).bgColor = "";
    document.all.item(menuitem).style.fontFamily = "<?php print $curcalcfg["pu_MenuItemFont"]; ?>";
    document.all.item(menuitem).style.color = "<?php print $curcalcfg["pu_MenuItemFontColor"]; ?>";
}

function setmenubarin(menuitem) {
//alert(menuitem);
    document.all.item(menuitem).bgColor = "<?php print $curcalcfg["pu_MenuBarHighlightColor"]; ?>";
    document.all.item(menuitem).style.fontFamily = "<?php print $curcalcfg["pu_MenuBarHighlightFont"]; ?>";
    document.all.item(menuitem).style.color = "<?php print $curcalcfg["pu_MenuBarHighlightFontColor"]; ?>";

}

function setmenubarout(menuitem) {
//alert(menuitem);
    document.all.item(menuitem).bgColor = "";
    document.all.item(menuitem).style.fontFamily = "<?php print $curcalcfg["pu_MenuBarFont"]; ?>";
    document.all.item(menuitem).style.color = "<?php print $curcalcfg["pu_MenuBarFontColor"]; ?>";
}

function jumptolink(jumplink) {
    document.location.href = jumplink;
}
function openlink(jumplink) {
    window.open(jumplink,"CaLogic","height=600,width=800,status=no,toolbar=yes,menubar=no,location=no,resizable=yes,scrollbars=yes");
}

-->
</script>

<?php

    print "<center>\n";
    print "<table id=\"cvtab\" border=\"0\" width=\"".$GLOBALS["sitewidth"]."\" LANGUAGE=javascript onresize=\"return cvtab_onresize()\">\n";
    print "<tr>\n";
    print "<td>\n";

#print "VIEW DATE: ".$viewdate."<br><br>";
/***************************************************************
**  show header
***************************************************************/
    viewheader($viewdate,$viewtype);
    # located in vhfunc

#print "VIEW DATE: ".$viewdate."<br><br>";
/***************************************************************
**  decide which view and date etc. and show it
***************************************************************/
    if ($viewtype == "Day") {
        dayview($viewdate);
    } else if ($viewtype == "Week") {
        weekview($viewdate);
    } else if ($viewtype == "Month") {
        monthview($viewdate);
    } else if ($viewtype == "Year") {
        yearview($viewdate);
    } else {
        $viewtype = "Month";
        monthview($viewdate);
    }

    print "</tr>\n";
    print "</td>\n";
    print "</table>\n";
    print "</center>\n";
    include($GLOBALS["CLPath"]."/include/footer.php");
    flush();
    exit();
} else {

/***************************************************************
**  thats it! if we make it here, must go to login form
***************************************************************/

    gologin();
}
exit();


/***************************************************************
**
***************************************************************/

function gologin() {

global $langcfg,$gltab,$standardbgimg,$loger,$langsel;
// login form

    $cluname = "";
    $clpw = "";

    $wptitle = $langcfg["liw"];
    $uncv = "";
    $pwcv = "";

	#$uncookieok = setcookie("calogicuname", $_POST["uname"],$cvexp);
	#$pwcookieok = setcookie("calogicupw", $_POST["pw"],$cvexp);

    if (isset($_COOKIE['calogicuname']) && isset($_COOKIE['calogicupw'])) {
        $cluname = $_COOKIE['calogicuname'];
        $clpw = $_COOKIE['calogicupw'];
#print "unpw cookie read<br>";
        $uncv = $_COOKIE['calogicuname'];
        $pwcv = $_COOKIE['calogicupw'];
        #foreach ($_COOKIE['calogicunpw'] as $name => $value) {
#print $name." = ".$value."<br>";
            #$$name = $value;
        #}
    }

    ?>

<?php
print $GLOBALS["htmldoctype"];
?>
    <html>

    <head>
    <title><?php print $GLOBALS["sitetitle"]; ?> - <?php print "$wptitle"; ?></title>
    <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
    <!--

    function submit_onclick() {
        document.loginform.uname.value=trim(document.loginform.uname.value);
        document.loginform.pw.value=trim(document.loginform.pw.value);
        if(document.loginform.uname.value == "") {
            alert("<?php print $langcfg["linff"]; ?>");
            document.loginform.uname.focus();
            return false;
        }
        if(document.loginform.pw.value == "") {
            alert("<?php print $langcfg["lipff"]; ?>");
            document.loginform.pw.focus();
            return false;
        }
    }

    function trim(value) {
     startpos=0;
     while((value.charAt(startpos)==" ")&&(startpos<value.length)) {
       startpos++;
     }
     if(startpos==value.length) {
       value="";
     } else {
       value=value.substring(startpos,value.length);
       endpos=(value.length)-1;
       while(value.charAt(endpos)==" ") {
         endpos--;
       }
       value=value.substring(0,endpos+1);
     }
     return(value);
    }

    function langsel_onchange() {
    xurl = "<?php print $GLOBALS["idxfile"]; ?>?langsel=" + langsel.value;
    location.href=xurl;

    }

    function window_onload() {
        document.loginform.uname.focus();
        document.loginform.uname.select();

        var d, tz, utz;
        d = new Date();
        tz = d.getTimezoneOffset();
        if (tz < 0)
            utz = "+" + Math.abs(tz) / 60;
        else if (tz == 0)
            utz = "0";
        else
            utz = "-" + Math.abs(tz) / 60;

        loginform.usertz.value = utz;
    }

    function pw_onfocus() {
        loginform.pw.select();
    }
    function uname_onfocus() {
        loginform.uname.select();
    }

function gocalpvbut() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>?publangsel=" + langsel.value + "&gopubcal=1";
    location.href=xurl;
}

function goreqnewpw() {
    xurl="userreqpw.php";
    location.href=xurl;
}

    //-->
    </SCRIPT>
    </head>

    <body  <?php print $GLOBALS["sysbodystyle"]; ?> LANGUAGE=javascript onload="return window_onload()" >
<?php
#    <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
#    <script language="JavaScript" src="./include/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>
    #<script language="JavaScript" src="overlib.js"><!-- overLIB (c) Erik Bosrup --></script>


    #print "<br><br>langcfg<br>".print_r($langcfg);
    #print "END langcfg<br>";
    #print "gltab: ".$gltab."<br>";
    #print "standardbgimg: ".$standardbgimg."<br>";
    #print "loger: ".$loger."<br>";
    #print "langsel: ".$langsel."<br>";
?>

    <h1><b><?php print $GLOBALS["sitetitle"]; ?> - <?php print $langcfg["liw"]; ?></b></h1>
    <p><b><?php print $langcfg["lsel"]; ?> </b>
    <select size="1" id=langsel name=langsel LANGUAGE=javascript onchange="return langsel_onchange()" tabIndex=7>
    <?php

    $sqlstr = "select * from ".$gltab." order by name";
    $qu_res = mysql_query($sqlstr) or die("Cannot query Global Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while ($rs_lang = mysql_fetch_array($qu_res)) {
        print "<OPTION Value=".$rs_lang["uid"];
        if ($rs_lang["uid"] == $langsel ) {print " selected ";}
        print ">".$rs_lang["name"]."</OPTION>\n";
    }

    mysql_free_result($qu_res);

    ?>
    </select></p>
    <p><b><?php print $langcfg["pli"]; ?></b></p>
<!--

Change for 1.2.2 : the logon form MUST use the post method for security reasons!!!

<form method="<?php #print $GLOBALS["postorget"]; ?>" name="loginform" id="loginform" action="<?php #print $GLOBALS["idxfile"]; ?>">

-->
    <form method="POST" name="loginform" id="loginform" action="<?php print $GLOBALS["idxfile"]; ?>">
      <table border="0" width="100%">
        <tr>
          <th width="12%" valign="top"><?php print $langcfg["un"]; ?></th>
          <td width="15%" nowrap valign="top">
          <input type="text" name="uname" size="20" maxlength="10" tabIndex="1" value="<?php print $cluname; ?>" language="javascript" onfocus="return uname_onfocus()">
          </td>
          <td width="73%" rowspan="2" valign="top" >
          <?php
          if($GLOBALS["userreg"]==1) {
            print nl2br($langcfg["nyrt"])."<a href=\"userreg.php?langsel=".$langsel;
                if($GLOBALS["adsid"] == true) {
                    print "&".SID;
                }
            print "\" tabIndex=6>".$langcfg["rlnk"]."</a>";
          } else {
              print "&nbsp;";
          }
          ?>
          </td>
        </tr>
        <tr>
          <th width="12%" valign="top"><?php print $langcfg["pw"]; ?></th>
          <td width="15%" valign="top">
          <input type="password" name="pw" size="20" id="pw" maxlength="10" tabIndex="2" value="<?php print $clpw; ?>"  language="javascript" onfocus="return pw_onfocus()">
          </td>
        </tr>
        <tr>
          <td width="27%" valign="top" colspan="2"><br>
          <input tabIndex="3" type="checkbox" name="unpwcookie" value="1" id="unpwcookie">
          <label for="unpwcookie">Remember my user name and password</label>
          </td>
        <td width="73%" valign="top"><br>
        Check this box to store your user name and password in a cookie for one year. <br>
        Also, when you check this box, don't forget to accept the cookie after submitting the form.<br>
        You must have cookies enabled for this to work.
        </td>
        </tr>
        <tr>
        <th width="12%" valign="top"><br>
            <?php print $langcfg["tzofword"]; ?></th>
        <td width="15%" nowrap valign="top"><br>
            <input tabIndex="4" type="text" name="usertz" size="20" maxlength=5>
        </td>
        <td width="73%" valign="top"><br>
            <?php print $langcfg["tztext"]; ?>
        </td>
        </tr>
      </table>
      <input type="submit" value="<?php print $langcfg["subut"]; ?>" name="login" id=login LANGUAGE=javascript onclick="return submit_onclick()" tabIndex=5>&nbsp;&nbsp;&nbsp;<input type="reset" value="<?php print $langcfg["rebut"]; ?>" name="reset" id=reset tabIndex=5>
    </form>
    <?php
  if($GLOBALS["publicview"] == true ) {
    ?>
  <input type="button" value="Go to Public Calendar" name="gocalpvbut" id="gocalpvbut" LANGUAGE="javascript" onclick="return gocalpvbut()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
  }
  ?>
<input type="button" value="Forgot my password" name="goreqnewpw" id="goreqnewpw" LANGUAGE="javascript" onclick="return goreqnewpw()">
    <br>
    <center>
    <?php
    if (isset($endsess)) {
        print "<h2>".$langcfg["userlo"]."</h2>";
    } else {
        print "<h2>$loger</h2>";
    }
    ?>
    </center>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
exit();
}

function gogetnewpw() {
    global $langcfg,$gltab,$standardbgimg,$loger,$langsel,$newpwerr;

?>
<?php
print $GLOBALS["htmldoctype"];
?>
    <html>

    <head>
    <title><?php print $GLOBALS["sitetitle"]; ?> - <?php print "New password required"; ?></title>
    <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
    <!--

    function savenewpw_onclick() {
        document.newpwform.pw1.value=trim(document.newpwform.pw1.value);
        document.newpwform.pw2.value=trim(document.newpwform.pw2.value);
        if(document.newpwform.pw1.value == "" || document.newpwform.pw2.value == "") {
            alert("The passwords cannot be blank");
            document.newpwform.pw1.value="";
            document.newpwform.pw2.value="";
            document.newpwform.pw1.focus();
            return false;
        }
        if(document.newpwform.pw1.value != document.newpwform.pw2.value) {
            alert("the passwords do not match");
            document.newpwform.pw1.value="";
            document.newpwform.pw2.value="";
            document.newpwform.pw1.focus();
            return false;
        }
        newpwform.setnewpw.value="1";
        newpwform.submit();
    }

    function trim(value) {
     startpos=0;
     while((value.charAt(startpos)==" ")&&(startpos<value.length)) {
       startpos++;
     }
     if(startpos==value.length) {
       value="";
     } else {
       value=value.substring(startpos,value.length);
       endpos=(value.length)-1;
       while(value.charAt(endpos)==" ") {
         endpos--;
       }
       value=value.substring(0,endpos+1);
     }
     return(value);
    }

    //-->
    </SCRIPT>
    </head>

    <body  <?php print $GLOBALS["sysbodystyle"]; ?> LANGUAGE=javascript onload="return window_onload()" >


    <h1><b><?php print $GLOBALS["sitetitle"]; ?> - Your password has expired, please make a new one.</b></h1>
    <form method="<?php print $GLOBALS["postorget"]; ?>" name="newpwform" id="newpwform" action="<?php print $GLOBALS["idxfile"]; ?>">
    <input type="hidden" name="setnewpw" value="0" id="setnewpw">
      <table border="0" width="50%">
        <tr>
          <th width="40%" valign="top">Enter new password</th>
          <td width="60%" nowrap valign="top">
          <input type="password" name="pw1" size="20" tabIndex="1">
          </td>
        </tr>
        <tr>
          <th width="40%" valign="top">Confirm new password</th>
          <td width="60%" valign="top">
          <input type="password" name="pw2" size="20" id="pw2" tabIndex="2">
          </td>
        </tr>
      </table>
      <input type="button" value="<?php print $langcfg["subut"]; ?>" name="savenewpw" id="savenewpw" LANGUAGE=javascript onclick="return savenewpw_onclick()" tabIndex=4>&nbsp;&nbsp;&nbsp;<input type="reset" value="<?php print $langcfg["rebut"]; ?>" name="reset" id=reset tabIndex=5>
    </form>
    <br>
    <center>
    <?php
    if (isset($newpwerr)) {
        unset($newpwerr);
        print "<h2>$loger</h2>";
    }
    ?>
    </center>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
exit();
}
?>

}
?>
