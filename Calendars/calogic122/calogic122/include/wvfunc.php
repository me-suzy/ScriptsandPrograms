<?php
function weekview($sdate) {

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl;
    global $daybeginhour,$dayendhour,$dayhourcount;
    global $user,$curcalcfg,$fsize;
    global $langcfg;
    global $cevent,$cellarr,$cellcount;

    $checkdisp = false;
    if($user->gsv("isadmin")!="1") {
#        if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
        if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
            $checkdisp = true;
        }
    }

    print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
    print "<TR><TD CLASS=\"wvdivider\">\n";
    print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"2\">\n";
    print "<TR>\n";


    $startyear=substr($sdate,0,4);
    $startmonth=substr($sdate,4,2);
    $startday=substr($sdate,6,2);

    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

    $date_time_array = getdate (time() + $user->gsv("caltzadj"));
    $todayday = $date_time_array[ "mday"];
    $todaymonth = $date_time_array[ "mon"];
    $todayyear = $date_time_array[ "year"];

    $today = time() + $user->gsv("caltzadj");
    $ltyear = strftime("%Y",$today);
    $ltmonth = strftime("%m",$today);
    $ltday = strftime("%d",$today);
    $ltweek = strftime("%W",$today);

    $cdc = 0;

    print "<TH WIDTH=\"10%\" >&nbsp;</TH>\n";
    for ( $ch = 1; $ch <= 7; $ch++ ) {

        $xdta = getdate ($cuts);
        $lcmn = $monthtext[$xdta["mon"]];
        $lcdn = $daytext[$xdta["mday"]];

        $lcyear = strftime("%Y",$cuts);
        $lcmonth = strftime("%m",$cuts);
        $lcday = strftime("%d",$cuts);
        $lcweek = strftime("%W",$cuts);

// check for events
        $wdxar[$ch] = checkforevents($lcday, $lcmonth, $lcyear,0,0,"Week");

        $hdr = $lcmn."&nbsp;".$lcday;

        if (($weekstartonmonday==1 && $ch < 6) || ($weekstartonmonday==0 && $ch > 1 && $ch < 7)) {
            $vclass="wd";
        } else {
            $vclass="we";
        }
        if ($ltyear == $lcyear && $ltmonth == $lcmonth && $ltday == $lcday){
            $cdc = $ch;
        }
        $cevent = $wdxar[$ch] ;

        $cellcount = $ch;
        $cellarr[$cellcount][0] = $lcyear;
        $cellarr[$cellcount][1] = $lcmonth;
        $cellarr[$cellcount][2] = $lcday;

        $smcpop = getmcpop();

        print "<td width=\"12%\" align=\"center\" class=\"wvh".$vclass."cell\">";
        print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr>
        <td width=\"30%\" class=\"wvh".$vclass."cell\">&nbsp;</td>";
        print "<TH WIDTH=\"40%\" align=\"center\" class=\"wvh".$vclass."cell\">";
        if(!$GLOBALS["printfriend"]) {
            print "<A ".$smcpop." class=\"wvh".$vclass."link\" HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$lcyear.$lcmonth.$lcday."&viewtype=Day";
            if($GLOBALS["adsid"] == true) {
                print "&".SID;
            }
            print "\">";
        } else {
            print "<font class=\"wvh".$vclass."link\">";
        }
        print "$daytext[$ch]<br>$hdr";
        if(!$GLOBALS["printfriend"]) {
            print "</A>";
        } else {
            print "</font>";
        }
        print "</TH>\n";
        print "<td width=\"30%\" valign=\"top\" align=\"right\" class=\"wvh".$vclass."cell\">";
        if(!$GLOBALS["printfriend"]) {
            if($user->gsv("canpost")==1 || $GLOBALS["demomode"]==true) {
                print "<a href=\"".$GLOBALS["idxfile"]."?viewdate=$sdate&viewtype=Week&func=Newevent&funcdate=$lcyear$lcmonth$lcday&functime=".$curcalcfg["daybeginhour"];
                if($GLOBALS["adsid"] == true) {
                    print "&".SID;
                }
                print "\" class=\"newlink\">";
                print "<img border=\"0\" src=\"./img/new.jpg\" alt=\"".$langcfg["butnew"]."&nbsp;".$langcfg["event"]."\"></a>";
            }
        }
        print "</td>";
        print "</tr></table>";
        print "</td>";
        $cuts = dateadd("d",1,$cuts);
    }
    print "</TR>\n";

// calculate min and max hour

    $starttime = $curcalcfg["daybeginhour"];
    $endtime = $curcalcfg["dayendhour"];

    $wdxmin = $starttime;
    $wdxmax = $endtime;

    for ( $ch = 1; $ch <= 7; $ch++ ) {
        $wdxinf = $wdxar[$ch];
        if($wdxinf[0][0] != 0) {
            foreach($wdxinf as $xk => $xv) {
                if($wdxinf[$xk]["sorttime"] != 0) {
                    $wdxst = substr($wdxinf[$xk]["sorttime"],0,4);
                    $wdxet = substr($wdxinf[$xk]["sorttime"],4,4);
                    if($wdxst < $wdxmin) {
                        $wdxmin = $wdxst;
                    }
                    if($wdxet > $wdxmax) {
                        $wdxmax = $wdxet;
                    }
                }
            }
        }

    }
    $wdxminh = substr($wdxmin,0,2);
    $wdxminm = substr($wdxmin,2,2);

    $wdxmaxh = substr($wdxmax,0,2);
    $wdxmaxm = substr($wdxmax,2,2);

    if($wdxminm < 30) {
        $wdxminm = "00";
    } elseif($wdxminm > 30) {
        $wdxminm = "30";
    }


    if($wdxmaxm < 30) {
        $wdxmaxm = "30";
    } elseif($wdxmaxm > 30) {
        $wdxmaxm = "00";
        $wdxmaxh++;
    }

    $wdxmin = sprintf("%02d%02d", $wdxminh,$wdxminm);
    $wdxmax = sprintf("%02d%02d", $wdxmaxh,$wdxmaxm);

    $starttime = $wdxmin;
    $sth = substr($starttime,0,2);
    $stm =substr($starttime,2,2);

    $endtime = $wdxmax;
    $enh = substr($endtime,0,2);
    $enm = substr($endtime,2,2);



    print "<TR><TH VALIGN=\"top\" WIDTH=\"10%\" class=\"wvhadcell\" HEIGHT=\"40\">
    <FONT class=\"wvhadtext\" >".$langcfg["allday"]."<br>".$langcfg["events"]."</FONT></TH>\n";

// all day events row
    for ( $ch = 1; $ch <= 7; $ch++ ) {

        if ($ch == $cdc) {
            print "<TD VALIGN=\"top\" WIDTH=\"12%\"  HEIGHT=\"75\" class=\"wvacdcell\">\n";
            $evsrc = "wvacdcell";
        } else {
            if (($weekstartonmonday==1 && $ch < 6) || ($weekstartonmonday==0 && $ch > 1 && $ch < 7)) {
                print "<TD VALIGN=\"top\" WIDTH=\"12%\"  HEIGHT=\"75\" class=\"wvawdcell\">\n";
                $evsrc = "wvawdcell";
            } else {
                print "<TD VALIGN=\"top\" WIDTH=\"12%\"  HEIGHT=\"75\" class=\"wvawecell\">\n";
                $evsrc = "wvawecell";
            }
        }


        $cevent = $wdxar[$ch];

            if($cevent[0][0] > 0) {

                for($xzc1=1;$xzc1<=$cevent[0][0];$xzc1++) {

                    if($cevent[$xzc1]["isallday"]=="1") {

// changes for sean
                        if($curcalcfg["gcscoyn_withesb"] == true && !$GLOBALS["printfriend"]) {
                            print "\n<span id=\"esp\" style=\"width: 100%; height: 75; overflow: auto\">\n";
                        }
// changes for sean
                        print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n";

                        for($ec=$xzc1;$ec<=$cevent[0][0];$ec++,$xzc1++) {

if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
    #$popdesc = getdespop($cevent[$ec]["description"],1);
    $popdesc = makeolevent($cevent[$ec]["description"]);
} else {
    $popdesc = "";
}
$tstathtml = "";
$havestatus = false;

                            if($cevent[$ec]["isallday"]=="1") {

                                print "<TR>";

# output event status column

                                if($curcalcfg["showstatus"] == 1) {

                                    if($cevent[$ec]["catcolorbg"] != "") {
                                        $evsrcx = " bgcolor=\"".$cevent[$ec]["catcolorbg"]."\"";
                                    } else {
                                        $evsrcx = " class=\"".$evsrc."\"";
                                    }

                                    print "<TD valign=\"top\">\n";
                                    if($cevent[$ec]["isallday"]==1 || $cevent[$ec]["sendreminder"]==1 || $cevent[$ec]["iseventseries"]==1 || $cevent[$ec]["conflict"]==1 || $cevent[$ec]["remsuballow"]==1) {
                                        $tstathtml .= "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"0\" CLASS=\"mvdivider\">\n";
                                        $tstathtml .= "<TR><td><TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\" ".$evsrcx."><tr>\n";
                                        $tstathtml .= "<td ".$evsrcx." valign=\"top\" width=\"2%\">\n";
                                        $tstathtml .= "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt;\"><b>";
                                        $havestatus = false;

                                        if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                                            if($cevent[$ec]["isallday"]==1) {
                                                $tstathtml .= "A<br>";
                                                $havestatus = true;
                                            }
                                        }
                                        if(($checkdisp == true && $curcalcfg["deirem"] == 1) || ($checkdisp == false)) {
                                            if($cevent[$ec]["sendreminder"]==1 || $cevent[$ec]["remsuballow"]==1) {
                                                $tstathtml .= "R<br>";
                                                $havestatus = true;
                                            }
                                        }
                                        if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
                                            if($cevent[$ec]["iseventseries"]==1) {
                                                $tstathtml .= "S<br>";
                                                $havestatus = true;
                                            }
                                        }
                                        if($cevent[$ec]["conflict"]==1) {
                                            $tstathtml .= "C<br>";
                                            $havestatus = true;
                                        }

                                        $tstathtml .=  "</b></font></td></tr></table></td></tr></table></td>\n";

                                    } else {
                                        $havestatus = true;
                                        $tstathtml .=  "<font style=\"FONT-SIZE: 9pt;\">&nbsp;</font></td>\n";
                                    }
                                }

                                if ($havestatus == true) {
                                    print $tstathtml;
                                }


                                print "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"98%\">";
                                if(($checkdisp == true && $curcalcfg["deiuser"] == 1) || ($checkdisp == false)) {
                                    if($cevent[$ec]["uname"]!=$user->gsv("uname") && strlen($cevent[$ec]["uname"])>0) {
                                        if(!$GLOBALS["printfriend"]) {
                                            print "<a title=\"Send this user an email\" style=\"text-decoration: none;
                                            cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"mailto: ".$cevent[$ec]["email"]."\" target=\"_blank\"><font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font></a><br>";
                                        } else {
                                            print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font><br>";
                                        }
                                    }
                                }

                                if($cevent[$ec]["isallday"]=="1") {
                                    if(!$GLOBALS["printfriend"]) {

#$popdesc = getdespop($cevent[$ec]["description"]);
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {

                                        #print "<div onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\" style=\"text-decoration: none;
                                        print "<div ".$popdesc." style=\"text-decoration: none;
                                        cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" LANGUAGE=javascript onclick=\"return eventclick('".$GLOBALS["idxfile"].
                                        "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$cellarr[$ch][0].$cellarr[$ch][1].$cellarr[$ch][2];
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "')\">";
#}
                                    } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        print "<div title=\"".htmlentities($cevent[$ec]["description"],ENT_QUOTES)."\"";
}
                                    }
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                    if(strlen($cevent[$ec]["subtitle"])>0) {$subtt="<br>".$cevent[$ec]["subtitle"];} else {$subtt="";}
} else {
    $subtt = "";
}
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
if(($checkdisp == true && $curcalcfg["deititle"] == 0 && $curcalcfg["deisub"] == 0 && $curcalcfg["deidate"] == 0)) {
    print "&nbsp;&nbsp;&nbsp;";
}

if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                                    print $cevent[$ec]["title"];
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                    print $subtt;
}
                                    print "</font>";
                                    if(!$GLOBALS["printfriend"]) {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        print "</div>";
#}
                                    } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        print "</div>";
}
                                    }
                                    print "<hr noshade color=\"black\" size=\"1\" >
                                    </td>";
                                } else {
                                    if(!$GLOBALS["printfriend"]) {

#$popdesc = getdespop($cevent[$ec]["description"]);
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        #print "<div onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\" style=\"text-decoration: none;
                                        print "<div ".$popdesc." style=\"text-decoration: none;
                                        cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" LANGUAGE=javascript onclick=\"return eventclick('".$GLOBALS["idxfile"].
                                        "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$cellarr[$ch][0].$cellarr[$ch][1].$cellarr[$ch][2];
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "')\">";
#}
                                    } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        print "<div title=\"".htmlentities($cevent[$ec]["description"],ENT_QUOTES)."\"";
}
                                    }
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
if(($checkdisp == true && $curcalcfg["deititle"] == 0 && $curcalcfg["deisub"] == 0 && $curcalcfg["deidate"] == 0)) {
    print "&nbsp;&nbsp;&nbsp;";
}

if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                                    print $cevent[$ec]["starttimet"]." - ".$cevent[$ec]["endtimet"]."<br>";
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                    if(strlen($cevent[$ec]["subtitle"])>0) {$subtt="<br>".$cevent[$ec]["subtitle"];} else {$subtt="";}
} else {
    $subtt = "";
}
if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                                    print $cevent[$ec]["title"];
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                    print $subtt;
}
                                    print "</font>";
                                    if(!$GLOBALS["printfriend"]) {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        print "</div>";
#}
                                    } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                        print "</div>";
}
                                    }
                                    print "<hr noshade color=\"black\" size=\"1\" width=\"95%\" ></td>";
                                }
                                print "</tr>\n";
                            }
                        }
                        print "</table>\n";
// changes for sean
                        if($curcalcfg["gcscoyn_withesb"] == true && !$GLOBALS["printfriend"]) {
                            print "</span>\n";
                        }
// changes for sean
                    }
                }
            } else {
                print "&nbsp;";
            }

//        print "&nbsp;</TD>\n";
        print "</TD>\n";
    }

    print "</TR>\n";

    $startyear=substr($sdate,0,4);
    $startmonth=substr($sdate,4,2);
    $startday=substr($sdate,6,2);

    $cuts = mktime(0,0,0,3,3,1973);

    $curtime = $starttime;
    $curh = substr($starttime,0,2);
    $curm = substr($starttime,2,2);

    if($curcalcfg["timetype"] == 1 ) {
        $timeout = date("H:i",mktime($curh,$curm,0,3,3,1973));
    } else {
        $timeout = date("g:i A",mktime($curh,$curm,0,3,3,1973));
    }

    $functimeout = date("Hi",mktime($curh,$curm,0,3,3,1973));

    $ckd1 = date("d",$cuts);
    $ckd2 = date("d",$cuts);
    $safetycounter = 60;


// half hourly rows

    $amimrs = array();
    for($xersc=1;$xersc<=7;$xersc++) {
        $amimrs[$xersc] = 0;
    }



// start of originlal
    while(($curtime <= $endtime) && ($ckd1 == $ckd2) && ($safetycounter > 0)) {
        $safetycounter--;

        if($curcalcfg["showalltimes"] == 0) {

            $printtimerow = false;

            for ( $ch = 1; $ch <= 7; $ch++ ) {
                $cevent = $wdxar[$ch];

                for($xzc1=1;$xzc1<=$cevent[0][0];$xzc1++) {
                    if($cevent[$xzc1]["isallday"] != 1) {
                        $xcurt = $curh.$curm;
                        $xcevst = substr($cevent[$xzc1]["sorttime"],0,2).substr($cevent[$xzc1]["sorttime"],2,2);
                        $xcevet = substr($cevent[$xzc1]["sorttime"],4,2).substr($cevent[$xzc1]["sorttime"],6,2);
                        $xcurtime = date("Hi",mktime($curh,$curm+29,0,3,3,1973));

                        if(($xcevst >= $xcurt && $xcevst <= $xcurtime) || ($xcevst <= $xcurtime && $xcevet >= $xcurtime) ) {
                            $printtimerow = true;
                            break;
                        }
                    }else{
                        $printtimerow = true;
                        break;
                    }
                }

                if($printtimerow == true) {
                    break;
                }
            }
        } else {
            $printtimerow = true;
        }

        if($printtimerow == true) {

            print "<TR><TH VALIGN=\"top\" WIDTH=\"10%\" class=\"wvtccell\"  HEIGHT=\"75\" >
                    <FONT class=\"wvtctext\" >$timeout</FONT></TH>\n";

            for ( $ch = 1; $ch <= 7; $ch++ ) {

                $chktime1 = date("Y-m-d",mktime($curh,$curm,0,$startmonth,$startday+($ch-1),$startyear));

                $chktime2 = date("Y-m-d, H:i",mktime($curh,$curm,0,$startmonth,$startday+($ch-1),$startyear));

    // original start of block

                if($amimrs[$ch] == 0 || $fxevlp == 1) {
                    if ($ch == $cdc) {
                        $evsrc = "wvcdcell";
                    } else {
                        if (($weekstartonmonday==1 && $ch < 6) || ($weekstartonmonday==0 && $ch > 1 && $ch < 7)) {
                            $evsrc = "wvwdcell";
                        } else {
                            $evsrc = "wvwecell";
                        }
                    }
                }

                $cevent = $wdxar[$ch];
                $conflict = false;
                $bconflict = false;

                $ccellt = "";
    //            if($amimrs[$ch] = 0;

                if($cevent[0][0] > 0) {

                    for($xzc1=1;$xzc1<=$cevent[0][0];$xzc1++) {



    //                    print "S1";

                        if($cevent[$xzc1]["isallday"] != 1) {

    //                    print "S2";

                            $xcurt = $curh.$curm;
                            $xcevt = substr($cevent[$xzc1]["sorttime"],0,2).substr($cevent[$xzc1]["sorttime"],2,2);
                            $xcurtime = date("Hi",mktime($curh,$curm+29,0,3,3,1973));

                            if($xcevt >= $xcurt && $xcevt <= $xcurtime) {

    //                    print "S3";

                                for($ec=$xzc1;$ec<=$cevent[0][0];$ec++,$xzc1++) {

#$popdesc = getdespop($cevent[$ec]["description"]);
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
    #$popdesc = getdespop($cevent[$ec]["description"],1);
    $popdesc = makeolevent($cevent[$ec]["description"]);
} else {
    $popdesc = "";
}

                                    if($cevent[$ec]["isallday"] != 1) {

                                        $xcurt = $curh.$curm;
    #                                    $xcevt = substr($cevent[$ec]["starttimet"],0,2).substr($cevent[$ec]["starttimet"],3,2);
                                        $xcevt = substr($cevent[$ec]["sorttime"],0,2).substr($cevent[$ec]["sorttime"],2,2);
                                        $xcurtime = date("Hi",mktime($curh,$curm+29,0,3,3,1973));

                                        if($xcevt >= $xcurt && $xcevt <= $xcurtime) {


    #                                        $zxcevth = substr($cevent[$ec]["endtimet"],0,2);
    #                                        $zxcevtm = substr($cevent[$ec]["endtimet"],3,2);
                                            $zxcevth = substr($cevent[$ec]["sorttime"],4,2);
                                            $zxcevtm = substr($cevent[$ec]["sorttime"],6,2);

    #                                        if($zxcevth != substr($cevent[$ec]["starttimet"],0,2)) {
                                            if($zxcevth != substr($cevent[$ec]["sorttime"],0,2)) {
                                                if($zxcevtm == 0) {
                                                    $zxcevtm = "59";
                                                    $zxcevth--;
                                                } elseif($zxcevtm == 30) {
                                                    $zxcevtm = "29";
                                                } elseif($zxcevtm > 29) {
                                                    $zxcevtm = "59";
                                                } else {
                                                    $zxcevtm = "29";
                                                }
    #                                            $zct1 = mktime(substr($cevent[$ec]["starttimet"],0,2),substr($cevent[$ec]["starttimet"],3,2),0,3,3,1973);
                                                $zct1 = mktime(substr($cevent[$ec]["sorttime"],0,2),substr($cevent[$ec]["sorttime"],2,2),0,3,3,1973);
    #                                            $zct2 = mktime(substr($cevent[$ec]["sorttime"],4,2),substr($cevent[$ec]["sorttime"],6,2),0,3,3,1973);
                                                $zct2 = mktime($zxcevth,$zxcevtm,0,3,3,1973);
                                                while($zct2 >= $zct1) {
                                                    $amimrs[$ch]++;
                                                    for($xxzc1=1;$xxzc1<=$cevent[0][0];$xxzc1++) {
    #                                                    $xzct1 = mktime(substr($cevent[$xxzc1]["starttimet"],0,2),substr($cevent[$xxzc1]["starttimet"],3,2),0,3,3,1973);
    #                                                    $xzct2 = mktime(substr($cevent[$xxzc1]["endtimet"],0,2),substr($cevent[$xxzc1]["endtimet"],3,2),0,3,3,1973);
                                                        $xzct1 = mktime(substr($cevent[$xxzc1]["sorttime"],0,2),substr($cevent[$xxzc1]["sorttime"],2,2),0,3,3,1973);
                                                        $xzct2 = mktime(substr($cevent[$xxzc1]["sorttime"],4,2),substr($cevent[$xxzc1]["sorttime"],6,2),0,3,3,1973);
                                                        if($xxzc1 != $ec) {
    #                                                        if(($xzct1 >= $zct1 && $xzct1 <= $zct2) || ($xzct2 >= $zct1 && $xzct2 <= $zct2)) {
                                                            if(($xzct1 >= $zct1 && $xzct1 <= $zct2)) {
                                                                $conflict = true;
                                                            }
                                                            if(($zct1 >= $xzct1 && $zct1 < $xzct2) ) {
                                                                $bconflict = true;
                                                            }
                                                        }
                                                    }
                                                    $zct2 = dateadd("n",-30,$zct2);
                                                }
                                            }

                                            $fxevlp = 1;

                                            $ccellt .=  "<TR>";

    # output event status column
$tstathtml = "";
$havestatus = false;

                                            if($curcalcfg["showstatus"] == 1) {
                                                if($cevent[$ec]["catcolorbg"] != "") {
                                                    $evsrcx = " bgcolor=\"".$cevent[$ec]["catcolorbg"]."\"";
                                                } else {
                                                    $evsrcx = " class=\"".$evsrc."\"";
                                                }

                                                $tstathtml .= "<TD valign=\"top\">\n";
                                                if($cevent[$ec]["isallday"]==1 || $cevent[$ec]["sendreminder"]==1 || $cevent[$ec]["iseventseries"]==1 || $cevent[$ec]["conflict"]==1 || $cevent[$ec]["remsuballow"]==1) {
                                                    $tstathtml .= "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"0\" CLASS=\"wvdivider\">\n";
                                                    $tstathtml .= "<TR><td><TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\" ".$evsrcx."><tr>\n";
                                                    $tstathtml .= "<td ".$evsrcx." valign=\"top\" width=\"2%\">\n";
                                                    $tstathtml .= "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt;\"><b>";
                                                    $havestatus = false;
if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                                                    if($cevent[$ec]["isallday"]==1) {
                                                        $tstathtml .= "A<br>";
                                                        $havestatus = true;
                                                    }
}
if(($checkdisp == true && $curcalcfg["deirem"] == 1) || ($checkdisp == false)) {
                                                    if($cevent[$ec]["sendreminder"]==1 || $cevent[$ec]["remsuballow"]==1) {
                                                        $tstathtml .= "R<br>";
                                                        $havestatus = true;
                                                    }
}
if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
                                                    if($cevent[$ec]["iseventseries"]==1) {
                                                        $tstathtml .= "S<br>";
                                                        $havestatus = true;
                                                    }
}
                                                    if($cevent[$ec]["conflict"]==1) {
                                                        $tstathtml .= "C<br>";
                                                        $havestatus = true;
                                                    }
                                                    $tstathtml .= "</b></font></td></tr></table></td></tr></table></td>\n";
                                                } else {
                                                    $havestatus = true;
                                                    $tstathtml .= "<font style=\"FONT-SIZE: 9pt;\">&nbsp;</font></td>\n";
                                                }
                                            }

                                            if ($havestatus == true) {
                                                $ccellt .= $tstathtml;
                                            }

                                            $ccellt .=  "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"98%\">";

if(($checkdisp == true && $curcalcfg["deiuser"] == 1) || ($checkdisp == false)) {

                                            if($cevent[$ec]["uname"]!=$user->gsv("uname") && strlen($cevent[$ec]["uname"])>0) {
                                                if(!$GLOBALS["printfriend"]) {
                                                    $ccellt .=  "<a title=\"Send this user an email\" style=\"text-decoration: none;
                                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"mailto: ".$cevent[$ec]["email"]."\" target=\"_blank\"><font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font></a><br>";
                                                } else {
                                                    $ccellt .=  "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font><br>";
                                                }
                                            }
}
                                            if($cevent[$ec]["isallday"]=="1") {
                                                if(!$GLOBALS["printfriend"]) {

#    $popdesc = getdespop($cevent[$ec]["description"]);

#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    #$ccellt .= "<div onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\" style=\"text-decoration: none;
                                                    $ccellt .= "<div ".$popdesc." style=\"text-decoration: none;
                                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" LANGUAGE=javascript onclick=\"return eventclick('".$GLOBALS["idxfile"].
                                                    "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$cellarr[$ch][0].$cellarr[$ch][1].$cellarr[$ch][2];
                                                    if($GLOBALS["adsid"] == true) {
                                                        $ccellt .= "&".SID;
                                                    }
                                                    $ccellt .= "')\">";
#}
                                                } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    $ccellt .=  "<div title=\"".htmlentities($cevent[$ec]["description"],ENT_QUOTES)."\"";
}
                                                }
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                                if(strlen($cevent[$ec]["subtitle"])>0) {$subtt="<br>".$cevent[$ec]["subtitle"];} else {$subtt="";}
} else {
    $subtt = "";
}
                                                $ccellt .=  "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
if(($checkdisp == true && $curcalcfg["deititle"] == 0 && $curcalcfg["deisub"] == 0 && $curcalcfg["deidate"] == 0)) {
    $ccellt .=  "&nbsp;&nbsp;&nbsp;";
}
if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                                                $ccellt .= $cevent[$ec]["title"];
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                                $ccellt .= $subtt;
}
                                                $ccellt .= "</font>";
                                                if(!$GLOBALS["printfriend"]) {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    $ccellt .=  "</div>";
#}
                                                } else {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    $ccellt .=  "</div>";
#}
                                                }
                                                $ccellt .=  "<hr noshade color=\"black\" size=\"1\" >
                                                </td>";

                                            } else {

                                                if(!$GLOBALS["printfriend"]) {

#    $popdesc = getdespop($cevent[$ec]["description"]);

#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    #$ccellt .= "<div onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\" style=\"text-decoration: none;
                                                    $ccellt .= "<div ".$popdesc." style=\"text-decoration: none;
                                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" LANGUAGE=javascript onclick=\"return eventclick('".$GLOBALS["idxfile"].
                                                    "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$cellarr[$ch][0].$cellarr[$ch][1].$cellarr[$ch][2];
                                                    if($GLOBALS["adsid"] == true) {
                                                        $ccellt .= "&".SID;
                                                    }
                                                    $ccellt .= "')\">";
#}
                                                } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    $ccellt .=  "<div title=\"".htmlentities($cevent[$ec]["description"],ENT_QUOTES)."\"";
}
                                                }
                                                $ccellt .=  "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
if(($checkdisp == true && $curcalcfg["deititle"] == 0 && $curcalcfg["deisub"] == 0 && $curcalcfg["deidate"] == 0)) {
    $ccellt .=  "&nbsp;&nbsp;&nbsp;";
}
if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                                                $ccellt .=  $cevent[$ec]["starttimet"]." - ".$cevent[$ec]["endtimet"]."<br>";
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                                if(strlen($cevent[$ec]["subtitle"])>0) {$subtt="<br>".$cevent[$ec]["subtitle"];} else {$subtt="";}
} else {
    $subtt = "";
}
if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                                                $ccellt .= $cevent[$ec]["title"];
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                                $ccellt .= $subtt;
}
                                                $ccellt .= "</font>";
                                                if(!$GLOBALS["printfriend"]) {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    $ccellt .=  "</div>";
#}
                                                } else {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                                    $ccellt .=  "</div>";
#}
                                                }
                                                $ccellt .= "<hr noshade color=\"black\" size=\"1\" width=\"95%\" ></td>";
                                            }
                                            $ccellt .=  "</tr>\n";
                                        }
                                    }
                                }

                                $ccellt .=  "</table>\n";

                                if(!$GLOBALS["printfriend"]) {
                                    $ccellt .=  "</span>\n";
                                }

                                            if($conflict == false) {
                                                if($amimrs[$ch] > 1) {
                                                    $nesrs = $amimrs[$ch] * 75;
                                                } else {
                                                    $nesrs = 75;
                                                }
                                            } else {
                                                $nesrs = 75;
                                            }

                                        if(!$GLOBALS["printfriend"]) {
                                            $ccellt = "\n<span id=\"esp\" style=\"width: 100%; height: ".$nesrs."; overflow: auto\">\n"."<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n".$ccellt;
                                        } else {
                                            $ccellt = "\n"."<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n".$ccellt;
                                        }

                            }
                        }
                    }
                }



    // original start of block
                if($conflict == true) {
                    $amimrs[$ch] = 0;
                }
                if($conflict == true || $bconflict == true) {
                    $extbrd = "style=\"border-style: double; border-width: 3\"";
                } else {
                    $extbrd = "";
                }
                if($amimrs[$ch] == 0 || $fxevlp == 1) {
    //                $fxevlp = 0;
                    if ($ch == $cdc) {
                        print "<TD $extbrd VALIGN=\"top\" WIDTH=\"12%\" class=\"wvcdcell\" ";
                    } else {
                        if (($weekstartonmonday==1 && $ch < 6) || ($weekstartonmonday==0 && $ch > 1 && $ch < 7)) {
                            print "<TD $extbrd VALIGN=\"top\" WIDTH=\"12%\" class=\"wvwdcell\" ";
                        } else {
                            print "<TD $extbrd VALIGN=\"top\" WIDTH=\"12%\" class=\"wvwecell\" ";
                        }
                    }
                    if($amimrs[$ch] > 0) {
                        print "rowspan=\"".$amimrs[$ch]."\"";
                        $amimrs[$ch]--;
                    }
                    print ">\n";
                } else {
                    $amimrs[$ch]--;
                }


    // HEIGHT=\"75\"

                if($amimrs[$ch] == 0 || $fxevlp == 1) {
                    $fxevlp = 0;
                    if($chktime1 == "1970-01-01") {
                        print "<B>&nbsp;".$langcfg["dtss"]."&nbsp;</B><hr>\n";
                    }

                    print $ccellt;

                    print "</TD>\n";
                }
            }

            print "</TR>\n";
        }


        $curtime = date("Hi",mktime($curh,$curm+30,0,3,3,1973));
        $ckd2 = date("d",mktime($curh,$curm+30,0,3,3,1973));

        $curh = substr($curtime,0,2);
        $curm = substr($curtime,2,2);

        if($curcalcfg["timetype"] == 1 ) {
            $timeout = date("H:i",mktime($curh,$curm,0,3,3,1973));
        } else {
            $timeout = date("g:i A",mktime($curh,$curm,0,3,3,1973));
        }
        $functimeout = date("Hi",mktime($curh,$curm,0,3,3,1973));

    }

    print "</TABLE></TD></TR></TABLE>\n";
    if($safetycounter == 0) {
        print "<br><b>Some kind of Time error has occured in the Week View.</b>";
    }
}

?>
