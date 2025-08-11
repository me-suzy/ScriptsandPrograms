<?php
/***************************************************************
** Title.........: Header View
** Version.......: 1.0
** Author........: Philip Boone <philip@calogic.de>
** Filename......: vhfunc.php
** Last changed..:
** Notes.........:
** Use...........: This builds the header of every view


***************************************************************/

/***************************************************************
**
***************************************************************/

function viewheader($vdate,$vtype) {

global $mainmenu,$weekmenu,$monthmenu,$yearmenu,$calmenu,$funcmenu,$mainmenustyle,$menustyle;
global $menubarprevlink,$menubarnextlink,$menubarcurweek,$menubarcurmonth,$menubarcuryear;
global $menubarprevlinktext,$menubarnextlinktext;


    #print "VDATE: ".$vdate."<br>";
    #print "vtype: ".$vtype."<br>";

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$wsbfd,$wsbld,$weekselreact;
    global $user,$fsize,$curcalcfg;
    global $langcfg;
    global $xplnk, $xptxt, $xnlnk, $xntxt;
    global $viewdate,$weeksel;


    $ovlibmicfg = "";
    $ovlibmicfg .= "BGCOLOR,'".$curcalcfg["pu_MenuItemBorderColor"]."',";
    $ovlibmicfg .= "FGCOLOR,'".$curcalcfg["pu_MenuItemBorderColor"]."'";

    $menuid = "";
    $menutext = "";

$menuitempos = "";

    $mainmenucellcount = 2;

    if($curcalcfg["gcscoyn_dispwvpd"]==1) {
        $mainmenucellcount++;
    }

    if($curcalcfg["gcscoyn_dispmvpd"]==1) {
        $mainmenucellcount++;
    }

    if($curcalcfg["gcscoyn_dispyvpd"]==1) {
        $mainmenucellcount++;
    }

    if($curcalcfg["gcscoyn_dispcnpd"]==1) {
        $mainmenucellcount++;
    }


    $startyear=substr($vdate,0,4);
    $startmonth=substr($vdate,4,2);
    $startday=substr($vdate,6,2);

    $actdate = mktime(0,0,0,$startmonth,$startday,$startyear);
    $actyear = $startyear;

    print "<center>\n";

if(!$GLOBALS["printfriend"]) {

    print "<TABLE BORDER=0 WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
    print "<TR>\n";
#    print "<TD ALIGN=\"left\"  width=\"15%\" rowspan=\"2\">\n";


# mini cal left

    print "<TD ALIGN=\"left\"  width=\"15%\" >\n";

    if ($vtype=="Year") {

        $xws = time();
        $strty = strftime("%Y",$xws);
        $strtm = strftime("%m",$xws);
        $strtd = strftime("%d",$xws);

        $xtvdate = $strty.$strtm.$strtd;
#        $xtvdate = mktime(0,0,0,strftime("%m"),strftime("%d"),strftime("%Y"));

        $startyear=substr($xtvdate,0,4);
        $startmonth=substr($xtvdate,4,2);
        $startday=substr($xtvdate,6,2);

#print "curset: ".$curcalcfg["yvselmc_mcyv"]."<br>";

        if($curcalcfg["yvselmc_mcyv"]==0) {
            minical("01",$startmonth,$startyear,0);
        }else if($curcalcfg["yvselmc_mcyv"]==2) {
#print "SM1: ".$startmonth."<br>";
            $startmonth--;
#print "SM2: ".$startmonth."<br>";
            if($startmonth == 0){$startmonth = 12; $startyear--;}
            minical("01",$startmonth,$startyear,0);
        }else{
            print "&nbsp;";
        }

//        $startyear--;
    } else if($vtype=="Month") {

#print "curset cal: ".$curcalcfg["mvselmc_mcmv"]."<br>";
#print "curset cal CK: ".$curcalcfg["mcmv"]."<br>";
#print "curset def: ".$GLOBALS["mcmv"]."<br>";
#print "curset def CK: ".$GLOBALS["mvselmc_mcmv"]."<br>";

        if($curcalcfg["mvselmc_mcmv"]==0) {
#print "MC MV VAL 0<br>";
            minical($startday,$startmonth,$startyear,0);
        }else if ($curcalcfg["mvselmc_mcmv"]==2) {
#print "MC MV VAL 2<br>";
            $startmonth--;
            if($startmonth == 0){$startmonth = 12; $startyear--;}
            minical($startday,$startmonth,$startyear,0);
        }else{
            print "&nbsp;";
        }


#        $startmonth--;
#        if($startmonth == 0){$startmonth = 12; $startyear--;}
#
#        minical($startday,$startmonth,$startyear,0);

    } else if ($vtype=="Week") {

        if($curcalcfg["wvselmc_mcwv"]==0) {
            minical("01",$startmonth,$startyear,1);
        }else if($curcalcfg["wvselmc_mcwv"]==2) {
            $startmonth--;
            if($startmonth == 0){$startmonth = 12; $startyear--;}
            minical("01",$startmonth,$startyear,1);
        }else{
            print "&nbsp;";
        }

        #minical("01",$startmonth,$startyear,1);

    } else if ($vtype=="Day") {

#    print "SDATE: ".$startmonth.$startyear."<br>";

        if($curcalcfg["dvselmc_mcdv"]==0) {
            minical("01",$startmonth,$startyear,0);
        }else if($curcalcfg["dvselmc_mcdv"]==2) {
            $startmonth--;
            if($startmonth == 0){$startmonth = 12; $startyear--;}

#    print "XDATE: ".$startmonth.$startyear."<br>";

            minical("01",$startmonth,$startyear,0);
        }else{
            print "&nbsp;";
        }

    }

//    $startmonth--;
//    if($startmonth == 0){$startmonth = 12; $startyear--;}


    print "</TD>\n";
    print "<TD valign=\"top\" ALIGN=\"center\" width=\"70%\">\n";

# center top row

if($curcalcfg["gcscoif_headpic"] != "") {

    print "<table border=\"0\" width=\"99%\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
    print "<tr>\n";
    ###print "<td nowrap align=\"center\" width=\"20%\">\n";

}

# previous link


    $startyear=substr($vdate,0,4);
    $startmonth=substr($vdate,4,2);
    $startday=substr($vdate,6,2);

    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);
    $extralinkinfo = "";
    if ($vtype == "Day") {
        $preview = dateadd("d",-1,$cuts);
        $extralinkinfo = "&daysel=";
    } else if ($vtype == "Week") {
        $preview = dateadd("d",-7,$cuts);
        $extralinkinfo = "&weeksel=";

    } else if ($vtype == "Month") {
        $preview = dateadd("m",-1,$cuts);
        $extralinkinfo = "&monthsel=";
    } else if ($vtype == "Year") {
        $preview = dateadd("yyyy",-1,$cuts);
        $extralinkinfo = "&yearsel=";
    }

    $lyear = strftime("%Y",$preview);
    $lmonth = strftime("%m",$preview);
    $lday = strftime("%d",$preview);

    $GLOBALS["xplnk"] = $lyear.$lmonth.$lday;
    $GLOBALS["xptxt"] = $vtype;

    ###print "<A class=\"gcprevlink\" HREF=\"".$GLOBALS["idxfile"]."?viewdate=$lyear$lmonth$lday&viewtype=$vtype";
    ###if($GLOBALS["adsid"] == true) {
        ###print "&".SID;
    ###}

    ###print "\">".$langcfg["prev"]."&nbsp;$vtype</A>\n";

    ###print "</td>\n";

$menubarprevlinktext = "&nbsp;".$langcfg["prev"];
$menubarprevlink = $GLOBALS["idxfile"]."?viewdate=".$lyear.$lmonth.$lday."&viewtype=".$vtype.$extralinkinfo.$GLOBALS["xplnk"];

if($curcalcfg["gcscoif_headpic"] != "") {
    ###print "<td nowrap align=\"center\" width=\"60%\">\n";
    print "<td nowrap align=\"center\" width=\"100%\">\n";
}

# banner and or name and title

    if($curcalcfg["gcscoif_headpic"] != "") {

            if (strlen($curcalcfg["gcscoif_headlink"]) > 0) {
                print "<a title=\"".$curcalcfg["gcscoif_headtext"]."\" href=\"".$curcalcfg["gcscoif_headlink"]."\" target=\"".$curcalcfg["gcscoif_headtarget"]."\">";
            } else {
                print "<div title=\"".$curcalcfg["gcscoif_headtext"]."\">";
            }
            if(strtolower(substr($curcalcfg["gcscoif_headpic"],strrpos($curcalcfg["gcscoif_headpic"],".")))==".swf") {

                print "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"468\" height=\"60\">";
                print "<param name=movie value=\"".$curcalcfg["gcscoif_headpic"]."\">";
                print "<param name=quality value=high>";
                print "<embed border=\"0\" src=\"".$curcalcfg["gcscoif_headpic"]."\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"468\" height=\"60\">";
                print "</embed>";
                print "</object>";

            } else {
                print "<img border=\"0\" src=\"".$curcalcfg["gcscoif_headpic"]."\">";
            }

            if (strlen($curcalcfg["gcscoif_headlink"]) > 0) {
                print "</a>";
            } else {
                print "<div>";
            }
            print "<br>";

    } else {

        #print $user->gsv("fullname")." - ".$curcalcfg["caltitle"]."<br>";
        ###print "&nbsp;";
    }

# view text


# end view text
if($curcalcfg["gcscoif_headpic"] != "") {
    print "</td>\n";
}

# next link

    ###print "<td nowrap align=\"center\" width=\"20%\">\n";

    $extralinkinfo = "";
    if ($vtype == "Day") {
        $nextview = dateadd("d",1,$cuts);
        $extralinkinfo = "&daysel=";
    } else if ($vtype == "Week") {
        $nextview = dateadd("d",7,$cuts);
        $extralinkinfo = "&weeksel=";

    } else if ($vtype == "Month") {
        $nextview = dateadd("m",1,$cuts);
        $extralinkinfo = "&monthsel=";

    } else if ($vtype == "Year") {
        $nextview = dateadd("yyyy",1,$cuts);
        $extralinkinfo = "&yearsel=";
    }

    $lyear = strftime("%Y",$nextview);
    $lmonth = strftime("%m",$nextview);
    $lday = strftime("%d",$nextview);

    $GLOBALS["xnlnk"] = $lyear.$lmonth.$lday;
    $GLOBALS["xntxt"] = $vtype;

    ###print "<A class=\"gcnextlink\"HREF=\"".$GLOBALS["idxfile"]."?viewdate=$lyear$lmonth$lday&viewtype=$vtype";
    ###if($GLOBALS["adsid"] == true) {
        ###print "&".SID;
    ###}
    ###print "\">".$langcfg["next"]."&nbsp;$vtype</A>\n";


    $menubarnextlinktext = $langcfg["next"]."&nbsp;";
    $menubarnextlink = $GLOBALS["idxfile"]."?viewdate=".$lyear.$lmonth.$lday."&viewtype=".$vtype.$extralinkinfo.$GLOBALS["xnlnk"];

if($curcalcfg["gcscoif_headpic"] != "") {
    print "</td>\n";
    print "</tr>\n";

    print "</table>\n";
}

# end center top row

    print "<HR CLEAR=\"all\">\n";

# start menu

/*

# center middle row

    print "<table border=\"0\" width=\"70%\" cellspacing=\"0\" cellpadding=\"0\">\n";
    print "<tr>\n";

# setup link

    print "<td width=\"23%\" align=\"center\" valign=\"middle\">
    <A class=\"gcpreflink\" HREF=\"".$GLOBALS["idxfile"]."?goprefs=1";
    if($GLOBALS["adsid"] == true) {
        print "&".SID;
    }
    print "\">".$langcfg["prefl"]."</A></td>\n";
    print "<td width=\"23%\" align=\"center\" valign=\"middle\">";

# functions menu

    print "<form method=\"".$GLOBALS["postorget"]."\" action=\"".$GLOBALS["idxfile"]."\" name=\"gosfuncs\" id=\"gosfuncs\">";
    print "<SELECT id=\"qjump\" style=\"WIDTH: 120px\" name=\"qjump\">\n";
    print "<OPTION selected value=\"contacts\">Contacts</OPTION>\n";
    print "<OPTION value=\"categories\">Categories</OPTION>\n";
    print "<OPTION value=\"subscriptions\">Subscriptions</OPTION>\n";
    print "<OPTION value=\"usersettings\">User Settings</OPTION>\n";
    print "</SELECT>&nbsp;<INPUT type=\"submit\" value=\"".$langcfg["butgo"]."\" id=\"gosfuncs\" name=\"gosfuncs\">\n";
    print "</form>
          </td>\n";

# logout link

    print "<td width=\"23%\" align=\"center\" valign=\"middle\">
    <A class=\"gcpreflink\" HREF=\"".$GLOBALS["idxfile"]."?endsess=1";
    if($GLOBALS["adsid"] == true) {
        print "&".SID;
    }
    print "\">".$langcfg["low"]."</A></td>\n";
    print "</tr>\n";
    print "</table>\n";


*/


# week select box prepare

    print "<div id=\"divselbox\" name=\"divselbox\" style=\"display: inline;\">";

###    print "<table border=\"0\" width=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
###    print "<tr>\n";

/*
$pu_MenuBarColor = "#66FFFF";
$pu_MenuBarFont = "Verdana,Arial,Helvetica";
$pu_MenuBarFontColor = "#000000";
$pu_MenuBarFontSize = "2";
$pu_MenuBarHighlightColor = "#3399FF";
$pu_MenuBarHighlightFont = "Verdana,Arial,Helvetica";
$pu_MenuBarHighlightFontColor = "#FFFFFF";
*/


    $mainmenustyle = "font-family:".$curcalcfg["pu_MenuBarFont"]."; color:".$curcalcfg["pu_MenuBarFontColor"]."; font-size:".$curcalcfg["pu_MenuBarFontSize"]."pt;";
    $menustyle = "font-family:".$curcalcfg["pu_MenuItemFont"]."; color:".$curcalcfg["pu_MenuItemFontColor"]."; font-size:".$curcalcfg["pu_MenuItemFontSize"]."pt;";
    #$menustyle = "BACKGROUND-COLOR: ".$curcalcfg["pu_MenuItemColor"]."; font-family:".$curcalcfg["pu_MenuItemFont"]."; color:".$curcalcfg["pu_MenuItemFontColor"]."; font-size:".$curcalcfg["pu_MenuItemFontSize"]."pt;";

    $mainmenu .= "<table border=\"1\" style=\"border-collapse: collapse\" width=\"100%\" id=\"mainmenubar\"><tr bgcolor=\"".$curcalcfg["pu_MenuBarColor"]."\">";

    $menuid = "prevmenulink";
    $menutext = $menubarprevlinktext;
    $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

    $mainmenu .= "<td onclick=\"return jumptolink('".$menubarprevlink."')\" align=\"left\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
    $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

    $menuid = "weekmenu";
    $menutext = $langcfg["swvbut"];
    $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

    $startyear=substr($vdate,0,4);
    $startmonth=substr($vdate,4,2);
    $startday=substr($vdate,6,2);
    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

    if ($vtype == "Day") {

        ### print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

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

        $xws = dateadd("d",-56,$tval);
        $strty = strftime("%Y",$xws);
        $strtm = strftime("%m",$xws);
        $strtd = strftime("%d",$xws);

        if($curcalcfg["gcscoyn_dispwvpd"]==1) {

            $weekmenu = weekselectbox($strty,$strtm,$strtd,0,0,$startyear,$startmonth,$startday);
            #print $weekmenu."<br>";
            $weekmenu = " overlib('".$weekmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
            $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurweek."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$weekmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
            $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

        } else {
            ### print "&nbsp;";
        }


    } else if ($vtype == "Week") {

        ### print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

        if(!isset($weeksel)) {

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


            $xws = dateadd("d",-56,$tval);
            $strty = strftime("%Y",$xws);
            $strtm = strftime("%m",$xws);
            $strtd = strftime("%d",$xws);


        } else {

            $xws = dateadd("d",-56,$cuts);
            $strty = strftime("%Y",$xws);
            $strtm = strftime("%m",$xws);
            $strtd = strftime("%d",$xws);

        }


        if($curcalcfg["gcscoyn_dispwvpd"]==1) {
            ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
            ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            ###weekselectbox($strty,$strtm,$strtd,0,0,$startyear,$startmonth,$startday);

            $weekmenu = weekselectbox($strty,$strtm,$strtd,0,0,$startyear,$startmonth,$startday);
            #print $weekmenu."<br>";
            $weekmenu = " overlib('".$weekmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
            $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurweek."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$weekmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
            $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";


        } else {
            ####print "&nbsp;";
        }

    } else if ($vtype == "Month") {

        ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

//        if($GLOBALS["usingwindows"] == true) {
            $firstweekdaynum = strftime("%w",mktime(0,0,0,$startmonth,$startday,$startyear));
            if($firstweekdaynum == 0) {$firstweekdaynum = 7;}
//        } else {
//            $firstweekdaynum = strftime("%u",mktime(0,0,0,$startmonth,$startday,$startyear));
//        }

        if ($weekstartonmonday==0) {
            $firstweekdaynum++;
            if($firstweekdaynum>7){$firstweekdaynum=1;}
        }
        $firstweekdaynum--;
        $tval = dateadd("d",$firstweekdaynum*-1,$cuts);

        $tvaly = strftime("%Y",$tval);
        $tvalm = strftime("%m",$tval);
        $tvald = strftime("%d",$tval);


        $xws = dateadd("d",-35,$tval);
        $strty = strftime("%Y",$xws);
        $strtm = strftime("%m",$xws);
        $strtd = strftime("%d",$xws);


        if($curcalcfg["gcscoyn_dispwvpd"]==1) {
            ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
            ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            ###weekselectbox($strty,$strtm,$strtd,0,0,$startyear,$startmonth,$startday);
            $weekmenu = weekselectbox($strty,$strtm,$strtd,0,0,$startyear,$startmonth,$startday);
            #print $weekmenu."<br>";
            $weekmenu = " overlib('".$weekmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
            $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurweek."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$weekmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
            $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";


        } else {
            ###print "&nbsp;";
        }

    } else if ($vtype == "Year") {
        ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

#        $xtvuts = date;
        $xtvuts = time();
        $strtyx = strftime("%Y",$xtvuts);
        $strtmx = strftime("%m",$xtvuts);
        $strtdx = strftime("%d",$xtvuts);

        $xtvuts = mktime(0,0,0,$strtm,$strtd,$strty);

        $xws = dateadd("d",-56,$xtvuts);
        $strty = strftime("%Y",$xws);
        $strtm = strftime("%m",$xws);
        $strtd = strftime("%d",$xws);

        if($curcalcfg["gcscoyn_dispwvpd"]==1) {
            ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
            ####$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
           ###weekselectbox($strtyx,$strtmx,$strtdx,1,0,$strty,$strtm,$strtd);
            $weekmenu = weekselectbox($strtyx,$strtmx,$strtdx,1,0,$strty,$strtm,$strtd);
            #print $weekmenu."<br>";
            $weekmenu = " overlib('".$weekmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
            $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurweek."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$weekmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
            $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

        } else {
            ###print "&nbsp;";
        }

    }


    $menuid = "monthmenu";
    $menutext = $langcfg["smvbut"];
    $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

    if ($vtype <> "Year") {

        ##print "</td>\n";
        ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

        $startyear=substr($vdate,0,4);
        $startmonth=substr($vdate,4,2);
        $startday=substr($vdate,6,2);
        $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

        $tval = dateadd("m",-12,$cuts);
        $strty = strftime("%Y",$tval);
        $strtm = strftime("%m",$tval);
        $strtd = strftime("%d",$tval);
        if ($strty == "" || $strty < 1971) {
            $strty = "1971";
            $strtm = "01";
            $strtd = "01";
        }
        $tval = dateadd("m",12,$cuts);
        $endy = strftime("%Y",$tval);
        $endm = strftime("%m",$tval);
        $endd = strftime("%d",$tval);

        if ($vtype == "Day") {
            if($curcalcfg["gcscoyn_dispmvpd"]==1) {
                ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
                ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
                $monthmenu = monthselectbox($strtd,$strtm,$strty,$endd,$endm,$endy,$startday,$startmonth,$startyear,1);

                $monthmenu = " overlib('".$monthmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurmonth."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$monthmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

            } else {
                ####print "&nbsp;";
            }
        } else if ($vtype == "Week") {
            if($curcalcfg["gcscoyn_dispmvpd"]==1) {
                ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
                ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
                $monthmenu = monthselectbox($strtd,$strtm,$strty,$endd,$endm,$endy,$startday,$startmonth,$startyear,1);
                $monthmenu = " overlib('".$monthmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurmonth."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$monthmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            } else {
                ###print "&nbsp;";
            }
        } else if ($vtype == "Month") {
            if($curcalcfg["gcscoyn_dispmvpd"]==1) {
                ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
                ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
                $monthmenu = monthselectbox($strtd,$strtm,$strty,$endd,$endm,$endy,$startday,$startmonth,$startyear,0);
                $monthmenu = " overlib('".$monthmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurmonth."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$monthmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            } else {
                ###print "&nbsp;";
            }
        }
        ###print "</td>\n";

        ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

    } else {

        ###print "</td>\n";
        ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";


        $xws = time();
        $strty = strftime("%Y",$xws);
        $strtm = strftime("%m",$xws);
        $strtd = strftime("%d",$xws);

        $xtvdate = $strty.$strtm.$strtd;
#        $xtvdate = mktime(0,0,0,strftime("%m"),strftime("%d"),strftime("%Y"));

        $startyear=substr($xtvdate,0,4);
        $startmonth=substr($xtvdate,4,2);
        $startday=substr($xtvdate,6,2);
        $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

        $tval = dateadd("m",-12,$cuts);
        $strty = strftime("%Y",$tval);
        $strtm = strftime("%m",$tval);
        $strtd = strftime("%d",$tval);
        if ($strty == "" || $strty < 1971) {
            $strty = "1971";
            $strtm = "01";
            $strtd = "01";
        }
        $tval = dateadd("m",12,$cuts);
        $endy = strftime("%Y",$tval);
        $endm = strftime("%m",$tval);
        $endd = strftime("%d",$tval);

        if($curcalcfg["gcscoyn_dispmvpd"]==1) {
            ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
            ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            $monthmenu = monthselectbox($strtd,$strtm,$strty,$endd,$endm,$endy,$startday,$startmonth,$startyear,1);

                $monthmenu = " overlib('".$monthmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurmonth."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$monthmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
        } else {
            ###print "&nbsp;";
        }

        ###print "</td>\n";

        ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";

    }



    $menuid = "yearmenu";
    $menutext = $langcfg["syvbut"];
    $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

    $startyear = $actyear;
    $cyuts = mktime(0,0,0,1,1,$startyear);
    if($startyear-5 >1970){
        $tval = dateadd("yyyy",-5,$cyuts);
        $strty = strftime("%Y",$tval);
    } else {
        $strty = "1971";
    }
    $tval = dateadd("yyyy",5,$cyuts);
    $endy = strftime("%Y",$tval);

    if ($vtype == "Year") {
        if($curcalcfg["gcscoyn_dispyvpd"]==1) {
            ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
            ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            $yearmenu = yearselectbox($strty,$endy,$startyear,0);

                $yearmenu = " overlib('".$yearmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcuryear."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$yearmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

        } else {
            ##print "&nbsp;";
        }
    } else {
        if($curcalcfg["gcscoyn_dispyvpd"]==1) {
            ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
            ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
            $yearmenu = yearselectbox($strty,$endy,$startyear,1);
                $yearmenu = " overlib('".$yearmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcuryear."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$yearmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

        } else {
            ##print "&nbsp;";
        }
    }

//print "</TABLE>\n";
    ###print "</td>\n";


# select calendar function

# center middle row

    ###print "<td width=\"25%\" align=\"center\" valign=\"bottom\">\n";


    $menuid = "calmenu";
    $menutext = $langcfg["calword"];
    $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

    if($curcalcfg["gcscoyn_dispcnpd"]==1 || $user->gsv("isadmin")) {

        ###$mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
        ###$menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";

        ###print "<form method=\"".$GLOBALS["postorget"]."\" action=\"".$GLOBALS["idxfile"]."\" name=\"calsel\" id=\"calsel\">";
        ###print "<INPUT type=\"submit\" value=\"Calendars\" id=\"goocalselect\" name=\"goocalselect\"><br>\n";
        ###print "<INPUT type=\"hidden\" value=\"1\" id=\"goocalselect\" name=\"goocalselect\">";


        ###print "<select size=\"1\" id=\"ocalselect\" name=\"ocalselect\" style=\"WIDTH: 120px\" LANGUAGE=javascript onchange=\"calsel.submit();\">\n";

$calmenu = "";
$menubarcurcal = "";
$callink = "";
$calmenunum = 0;

$calmenu .= "<table border=\"1\" style=\"border-collapse: collapse\" width=\"100%\" id=\"calmenulist\">";


                $extsql = "";
                if($user->gsv("isadmin")) {
                    $extsql = " or (userid <> ".$user->gsv("cuid")." and caltype = 2 and calid <> '0')";
                }

                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where (userid = ".$user->gsv("cuid")." and calid <> '0') or (caltype < 2 and calid <> '0') ".$extsql." order by calname";
                $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                while($row = mysql_fetch_array($query1)) {
                    $row = gmqfix($row,1);

                    ###print "<option ";
                    $optstr = $row["calname"];
                    if($user->gsv("curcalid") == $row["calid"]) {
                        ###print " selected ";
                        $optstr = "<b>".$optstr."</b>";
                        $menubarcurcal = $GLOBALS["idxfile"]."?goocalselect=1&ocalselect=".$row["calid"];

                    }

                    ###print "value=\"".$row["calid"]."\">".($row["calname"])."</option>\n";

$calmenunum++;
$menunum = "calmenu".$calmenunum;
$callink = $GLOBALS["idxfile"]."?goocalselect=1&ocalselect=".$row["calid"];

$calmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
$calmenu .= "<td onclick=\"return jumptolink('".$callink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
$calmenu .= "</tr>";

                }
                mysql_free_result($query1);

        ###print "</select>\n";
$calmenu .= "</table>";
if($calmenunum>14) {
    $calmenu = "<span style=\"width: 100%; height: 300; overflow: auto\">".$calmenu."</span>";
}

$calmenu = getdespop($calmenu);

                $calmenu = " overlib('".$calmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
                $mainmenu .= "<td onclick=\"return jumptolink('".$menubarcurcal."')\" align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$calmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
                $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";


    } else {
        ###print "&nbsp;";
    }
    ###print "</form>";
   ###print "</td>\n";


##################
#print $user->gsv("isadmin")."<br>".$curcalcfg["pu_functionmenutype"]."<br>".$user->gsv("uname")."<br>";

if($GLOBALS["nonadminfunctionmenu"] == 1 || $user->gsv("isadmin") == 1 || $GLOBALS["demomode"] == true) {

    if($curcalcfg["pu_functionmenutype"] == 1 || $curcalcfg["pu_functionmenutype"] == 2) {

        $mainmenucellcount++;

        $funcmenu = "";
        $funclink = "";
        $funcmenunum = 0;

        $funcmenu .= "<table border=\"1\" style=\"border-collapse: collapse\" width=\"100%\" id=\"funcmenulist\">";


        $funcmenunum++;
        $menunum = "funcmenu".$funcmenunum;

        $optstr = "Printer Friendly View";
        $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=printfriend&printfriend=1";

        $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
        $funcmenu .= "<td onclick=\"return openlink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
        $funcmenu .= "</tr>";

        /*
        $funcmenunum++;
        $menunum = "funcmenu".$calmenunum;

        $optstr = "Event Search and List";
        $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=evsearch&evsearch=1";

        $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
        $funcmenu .= "<td onclick=\"return openlink('".$funclink."')\" style=\"".$mainmenustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
        $funcmenu .= "</tr>";
        */

        if($user->gsv("uname")!="Guest" || ($user->gsv("uname")=="Guest" && $GLOBALS["demomode"]==true)) {
        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "Contacts";
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=contacts&contacts=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";
        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "Categories";
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=categories&categories=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";
        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "User Settings";
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=usersettings&usersettings=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";

            if(($GLOBALS["allowmakeextf"]==1) || ($user->gsv("isadmin")==1) || ($GLOBALS["demomode"]==true)){
        #
                $funcmenunum++;
                $menunum = "funcmenu".$funcmenunum;

                $optstr = "Extended Fields";
                $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=extfldmgr&extfldmgr=1";

                $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
                $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
                $funcmenu .= "</tr>";
            }
            if($GLOBALS["usercustom"]==1 || $user->gsv("isadmin")==1 || ($GLOBALS["demomode"]==true)){
        #
                $funcmenunum++;
                $menunum = "funcmenu".$funcmenunum;

                $optstr = "Configure Calendar";
                $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=goprefs&goprefs=1";

                $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
                $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
                $funcmenu .= "</tr>";
            }
        }
        if($user->gsv("uname")!="Guest") {
        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "Log off";
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=endsess&endsess=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";

        } else {

            if($GLOBALS["userreg"]==1) {
                $ttxt = "Log on / Register";
            } else {
                $ttxt = "Log on";
            }
        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = $ttxt;
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=endsess&endsess=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";

        }
        if($user->gsv("isadmin") == 1 || $GLOBALS["demomode"] == true) {
        #


    #$menustyle = "font-family:".$curcalcfg["pu_MenuItemFont"]."; color:".$curcalcfg["pu_MenuItemFontColor"]."; font-size:".$curcalcfg["pu_MenuItemFontSize"]."pt;";

            $optstr = "Admin";

            #$funcmenu .= "<tr>";
            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuBarHighlightColor"]."\">";
            $funcmenu .= "<td align=\"center\" style=\"font-family:".$curcalcfg["pu_MenuBarHighlightFont"]."; color:".$curcalcfg["pu_MenuBarHighlightFontColor"]."; font-size:".$curcalcfg["pu_MenuBarFontSize"]."pt;\" nowrap width=\"100%\">".$optstr."</td>";
            #$funcmenu .= "<td align=\"center\" style=\"font-family:".$curcalcfg["pu_MenuItemHighlightFont"]."; color:".$curcalcfg["pu_MenuItemHighlightFontColor"]."; font-size:".$curcalcfg["pu_MenuItemFontSize"]."pt;"."\" nowrap width=\"100%\">".$optstr."</td>";
            $funcmenu .= "</tr>";

        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "CaLogic Config";
            $funclink = "reconfig.php?gosfuncs=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return openlink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";

        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "History Log";
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=histlog&histlog=1&record=0";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";


        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "Database Maintenance";
            $funclink = $GLOBALS["idxfile"]."?gosfuncs=1&qjump=databasemaint&databasemaint=1";

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return jumptolink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";

        #
            $funcmenunum++;
            $menunum = "funcmenu".$funcmenunum;

            $optstr = "Check for Updates";
            $funclink = "http://www.demo.calogic.de/?version=".$GLOBALS["calogicversion"];

            $funcmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
            $funcmenu .= "<td onclick=\"return openlink('".$funclink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=\"100%\" onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
            $funcmenu .= "</tr>";

        }

        $funcmenu .= "</table>";
        $funcmenu = getdespop($funcmenu);

        $menuid = "funcmenu";
        $menutext = $GLOBALS["functionmenutext"];
        $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

        $funcmenu = " overlib('".$funcmenu."',0 ,ANCHOR,'".$menuid."pos' ,STICKY,NOCLOSE,".$ovlibmicfg.")";
        $mainmenu .= "<td align=\"center\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"setmenubarin('".$menuid."');".$funcmenu.";return;\" onmouseout=\"nd();setmenubarout('".$menuid."');return;\" language=\"javascript\">".$menutext."</td>";
        $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";
    }

#################
}
    $menuid = "nextmenulink";
    $menutext = $menubarnextlinktext;
    $menutext = "&nbsp;&nbsp;".$menutext."&nbsp;&nbsp;";

    $mainmenu .= "<td onclick=\"return jumptolink('".$menubarnextlink."')\" align=\"right\" style=\"".$mainmenustyle."cursor: hand\" id=\"".$menuid."\" name=\"".$menuid."\" nowrap width=\"##mainmenucellwidth##\" onmouseover=\"return setmenubarin('".$menuid."')\" onmouseout=\"return setmenubarout('".$menuid."')\" language=\"javascript\">".$menutext."</td>";
    $menuitempos .= "<td height='1px' id=\"".$menuid."pos\" name=\"".$menuid."pos\" width=\"##mainmenucellwidth##\"></td>";


$mainmenucellcount = round(100 / $mainmenucellcount,0);
$mainmenu = str_replace("##mainmenucellwidth##",$mainmenucellcount."%",$mainmenu);
$menuitempos = str_replace("##mainmenucellwidth##",$mainmenucellcount."%",$menuitempos);
$menuitempos = "<tr>".$menuitempos."</tr>";

print $mainmenu;

    print "</tr>\n";

print $menuitempos;

    print "</table>\n";

    print "</div>";
    if($curcalcfg["gcscoyn_dispcnpd"]==1 || $curcalcfg["gcscoyn_dispwvpd"]==1 || $curcalcfg["gcscoyn_dispmvpd"]==1 || $curcalcfg["gcscoyn_dispyvpd"]==1) {
        print "<HR CLEAR=\"all\">\n";
    }


    if($curcalcfg["dtih"]==1) {
        print "<table border=\"0\" width=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
        print "<tr>\n";
        print "<td width=\"50%\" align=\"left\">\n";
    }

    $cuts = $actdate;

    $xdta = getdate ($cuts);
    $xtday = strftime("%w",$cuts);
    if ($weekstartonmonday==0) {
        $xtday++;
    } else {
        if($xtday==0){$xtday=7;}
    }

    $daynames = $daytext[$xtday];
    $daynamel = $daytextl[$xtday];
    $daynums = strftime("%d",$cuts);
    $kwnums = strftime("%W",$cuts);
    $monthnames = $monthtext[$xdta["mon"]];
    $monthnamel = $monthtextl[$xdta["mon"]];
    $monthnums = strftime("%m",$cuts);
    $yearnums = strftime("%Y",$cuts);

    if ($vtype == "Day") {
        print "<B><font class=\"dvhead\" size=\"+2\">";
        $optstr = "$daynamel, $monthnamel&nbsp;$daynums,&nbsp;$yearnums";

    } else if ($vtype == "Week") {
        print "<B><font class=\"wvhead\" size=\"+2\">";


        $startyear=substr($viewdate,0,4);
        $startmonth=substr($viewdate,4,2);
        $startday=substr($viewdate,6,2);


        $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

        $euts = dateadd("d",6,$cuts);
        $xdta = getdate ($euts);
        $xtday = strftime("%w",$euts);

        if ($weekstartonmonday==0) {
            $xtday++;
        } else {
            if($xtday==0){$xtday=7;}
        }

        if($curcalcfg["weektype"]=="1") {
            $wnum = ISOWeek($startyear, $startmonth, $startday);
        #    echo "WT: 1";
        } else {
            $wnum = strftime("%W",mktime(0,0,0,$startmonth,$startday,$startyear));
        #    echo "WT: 0";
        }

        $daynamese = $daytext[$xtday];
        $daynamele = $daytextl[$xtday];
        $daynumse = strftime("%d",$euts);
        $daynums = strftime("%d",$cuts);
        $kwnumse = strftime("%W",$euts);
        $monthnamese = $monthtext[$xdta["mon"]];
        $monthnamele = $monthtextl[$xdta["mon"]];
        $monthnumse = strftime("%m",$euts);
        $yearnumse = strftime("%Y",$euts);


#        $optstr = $langcfg["wns"]."&nbsp;$kwnums,&nbsp;$monthnames&nbsp;$daynums,&nbsp;$yearnums&nbsp;-&nbsp;$monthnamese&nbsp;$daynumse,&nbsp;$yearnumse";
        $optstr = $langcfg["wns"]."&nbsp;$wnum,&nbsp;$monthnames&nbsp;$daynums,&nbsp;$yearnums&nbsp;-&nbsp;$monthnamese&nbsp;$daynumse,&nbsp;$yearnumse";

    } else if ($vtype == "Month") {
        print "<B><font class=\"mvhead\" size=\"+2\">";
        $optstr = "$monthnamel&nbsp;$yearnums";

    } else if ($vtype == "Year") {
        print "<B><font class=\"yvhead\" size=\"+2\">";
        $optstr = "$yearnums";
    }

    print "&nbsp;&nbsp;$optstr</b>\n";

    if($curcalcfg["dtih"]==1) {

        print "</td>\n";
        print "<td width=\"50%\" align=\"right\">\n";
        print "<B><font class=\"wvhead\" size=\"+2\">";
        print $curcalcfg["caltitle"]."&nbsp;&nbsp;";
        print "</b></td></tr>\n";
        print "</table>\n";
    }




    print "</TD>\n";

# main table row column 3

# mini cal right

    print "<TD ALIGN=\"right\" width=\"15%\" rowspan=\"2\">\n\n";

# reset start date to actual selected date

    $startyear=substr($vdate,0,4);
    $startmonth=substr($vdate,4,2);
    $startday=substr($vdate,6,2);

/*
    if ($vtype=="Year") {
        print "&nbsp;";

    } else if ($vtype=="Month") {
        $startmonth++;
        if($startmonth == 13){$startmonth = 1; $startyear++;}
        minical($startday,$startmonth,$startyear,1);
    } else {
        print "&nbsp;";
    }

*/


    if ($vtype=="Year") {

        if($curcalcfg["yvselmc_mcyv"]==1) {
            minical($startday,$startmonth,$startyear,0);
        }elseif($curcalcfg["yvselmc_mcyv"]==2) {
            $startmonth++;
            if($startmonth == 13){$startmonth = 1; $startyear++;}
            minical($startday,$startmonth,$startyear,1);
        }else{
            print "&nbsp;";
        }

    } elseif ($vtype=="Month") {

        if($curcalcfg["mvselmc_mcmv"]==1) {
            minical($startday,$startmonth,$startyear,1);
        }elseif($curcalcfg["mvselmc_mcmv"]==2) {
            $startmonth++;
            if($startmonth == 13){$startmonth = 1; $startyear++;}
            minical($startday,$startmonth,$startyear,1);
        }else{
            print "&nbsp;";
        }

    } elseif ($vtype=="Week") {

        if($curcalcfg["wvselmc_mcwv"]==1) {
            minical("01",$startmonth,$startyear,1);
        }elseif($curcalcfg["wvselmc_mcwv"]==2) {
            $startmonth++;
            if($startmonth == 13){$startmonth = 1; $startyear++;}
            minical("01",$startmonth,$startyear,1);
        }else{
            print "&nbsp;";
        }

    } elseif ($vtype=="Day") {

        if($curcalcfg["dvselmc_mcdv"]==1) {
            minical("01",$startmonth,$startyear,1);
        }elseif($curcalcfg["dvselmc_mcdv"]==2) {
            $startmonth++;
            if($startmonth == 13){$startmonth = 1; $startyear++;}
            minical("01",$startmonth,$startyear,1);
        }else{
            print "&nbsp;";
        }

    }


    print "</TD>\n";
    print "</tr>\n";
    print "</TABLE>\n";


} else {

    # print friendly

    if($curcalcfg["gcscoif_headpic"] != "") {

            if (strlen($curcalcfg["gcscoif_headlink"]) > 0) {
                print "<a href=\"".$curcalcfg["gcscoif_headlink"]."\" target=\"".$curcalcfg["gcscoif_headtarget"]."\">";
            }
            if(strtolower(substr($curcalcfg["gcscoif_headpic"],strrpos($curcalcfg["gcscoif_headpic"],".")))==".swf") {

                print "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"468\" height=\"60\">";
                print "<param name=movie value=\"".$curcalcfg["gcscoif_headpic"]."\">";
                print "<param name=quality value=high>";
                print "<embed border=\"0\" src=\"".$curcalcfg["gcscoif_headpic"]."\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"468\" height=\"60\">";
                print "</embed>";
                print "</object><br>";

            } else {
                print "<img border=\"0\" src=\"".$curcalcfg["gcscoif_headpic"]."\">";
            }

            if (strlen($curcalcfg["gcscoif_headlink"]) > 0) {
                print "</a>";
            }
            print "<br>";

    }

    $cuts = $actdate;

    $xdta = getdate ($cuts);
    $xtday = strftime("%w",$cuts);
    if ($weekstartonmonday==0) {
        $xtday++;
    } else {
        if($xtday==0){$xtday=7;}
    }

    $daynames = $daytext[$xtday];
    $daynamel = $daytextl[$xtday];
    $daynums = strftime("%d",$cuts);
    $kwnums = strftime("%W",$cuts);
    $monthnames = $monthtext[$xdta["mon"]];
    $monthnamel = $monthtextl[$xdta["mon"]];
    $monthnums = strftime("%m",$cuts);
    $yearnums = strftime("%Y",$cuts);


    if ($vtype == "Day") {
        print "<B><font class=\"dvhead\" size=\"+2\">";
        $optstr = "$daynamel, $monthnamel&nbsp;$daynums,&nbsp;$yearnums";

    } else if ($vtype == "Week") {

        print "<B><font class=\"wvhead\" size=\"+2\">";

        $euts = dateadd("d",6,$cuts);
        $xdta = getdate ($euts);
        $xdta = getdate ($euts);
        $xtday = strftime("%w",$euts);
        if ($weekstartonmonday==0) {
            $xtday++;
        } else {
            if($xtday==0){$xtday=7;}
        }

        $daynamese = $daytext[$xtday];
        $daynamele = $daytextl[$xtday];
        $daynumse = strftime("%d",$euts);
        $kwnumse = strftime("%W",$euts);
        $monthnamese = $monthtext[$xdta["mon"]];
        $monthnamele = $monthtextl[$xdta["mon"]];
        $monthnumse = strftime("%m",$euts);
        $yearnumse = strftime("%Y",$euts);

        if($curcalcfg["weektype"]=="1") {
            $wnum = ISOWeek($startyear, $startmonth, $startday);
        #    echo "WT: 1";
        } else {
            $wnum = strftime("%W",mktime(0,0,0,$startmonth,$startday,$startyear));
        #    echo "WT: 0";
        }

#        $optstr = $langcfg["wns"]."&nbsp;$kwnums,&nbsp;$monthnames&nbsp;$daynums,&nbsp;$yearnums&nbsp;-&nbsp;$monthnamese&nbsp;$daynumse,&nbsp;$yearnumse";
        $optstr = $langcfg["wns"]."&nbsp;$wnum,&nbsp;$monthnames&nbsp;$daynums,&nbsp;$yearnums&nbsp;-&nbsp;$monthnamese&nbsp;$daynumse,&nbsp;$yearnumse";

    } else if ($vtype == "Month") {
        print "<B><font class=\"mvhead\" size=\"+2\">";
        $optstr = "$monthnamel&nbsp;$yearnums";

    } else if ($vtype == "Year") {
        print "<B><font class=\"yvhead\" size=\"+2\">";
        $optstr = "$yearnums";
    }

    print "$optstr\n";


    print "</font></B>\n";

    print "<br><br>\n";
}
}
?>
