<?php
function dayview($sdate) {
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
    print "<TR><TD CLASS=\"dvdivider\">\n";
    print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"2\" BORDER=\"0\">\n";
    print "<TR>\n";


    $startyear=substr($sdate,0,4);
    $startmonth=substr($sdate,4,2);
    $startday=substr($sdate,6,2);

// check for events and put them in this array
    $wdxar = checkforevents($startday, $startmonth, $startyear,0,0,"Day");

    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

//    $firstweekdaynum = strftime("%u",$cuts);
# Some of the modifiers differ on win32
# (eg. %u -> %w, %e -> %d).
# Search at http://msdn.microsoft.com/ for
# strftime().

//        if($GLOBALS["usingwindows"] == true) {
            $firstweekdaynum = strftime("%w",$cuts);
            if($firstweekdaynum == 0) {$firstweekdaynum = 7;}
//        } else {
//            $firstweekdaynum = strftime("%u",mktime(0,0,0,$startmonth,$startday,$startyear));
//        }

    if ($weekstartonmonday==0) {
        $firstweekdaynum++;
        if($firstweekdaynum>7){$firstweekdaynum=1;}
    }


    $date_time_array = getdate (time() + $user->gsv("caltzadj"));
    $todayday = $date_time_array[ "mday"];
    $todaymonth = $date_time_array[ "mon"];
    $todayyear = $date_time_array[ "year"];

    $today = time() + $user->gsv("caltzadj");
    $ltyear = strftime("%Y",$today);
    $ltmonth = strftime("%m",$today);
    $ltday = strftime("%d",$today);
    $ltweek = strftime("%W",$today);

    $ttday = mktime(0,0,0,$ltmonth,$ltday,$ltyear);

    if ($cuts == $ttday) {
        $fclas = "cd";
    } else if (($weekstartonmonday==1 && $firstweekdaynum < 6) || ($weekstartonmonday==0 && $firstweekdaynum > 1 && $firstweekdaynum < 7)) {
        $fclas = "wd";
    } else {
        $fclas = "we";
    }

    print "<TD VALIGN=\"top\" WIDTH=\"10%\" class=\"dvadcell\" HEIGHT=\"75\">\n";
    print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr>
    <td valign=\"top\" align=\"left\" width=\"15%\" class=\"dvadcell\">";
    $evsrc="dvadcell";
    if(!$GLOBALS["printfriend"]) {
        if($user->gsv("canpost")==1 || $GLOBALS["demomode"]==true) {
            print "<a href=\"".$GLOBALS["idxfile"]."?viewdate=$sdate&viewtype=Day&func=Newevent&funcdate=$sdate&functime=".$curcalcfg["daybeginhour"];
            if($GLOBALS["adsid"] == true) {
                print "&".SID;
            }
            print "\" class=\"newlink\"><img border=\"0\" src=\"./img/new.jpg\" alt=\"".$langcfg["butnew"]."&nbsp;".$langcfg["event"]."\"></a>";
        } else {
            print "&nbsp;";
        }
    } else {
        print "&nbsp;";
    }
    print "</td>";
    print "<TH VALIGN=\"top\" WIDTH=\"70%\" class=\"dvadcell\" HEIGHT=\"75\">
    <FONT class=\"dvadtext\" >".$langcfg["allday"]."<br>".$langcfg["events"]."</FONT></TH>\n";
    print "<td width=\"15%\" class=\"dvadcell\">&nbsp;</td></tr></table>";
    print "</TD>\n";

    print "<TD VALIGN=\"top\" WIDTH=\"85%\" class=\"dva".$fclas."cell\">\n";
    $evsrc="dva".$fclas."cell";

# all day events first

        $cevent = $wdxar;
//            echo "$cevent[0][0]";
            if($cevent[0][0] > 0) {

                for($xzc1=1;$xzc1<=$cevent[0][0];$xzc1++) {

                    if($cevent[$xzc1]["isallday"]=="1") {
// changes for sean
#                        if($GLOBALS["withesb"] == true) {
                        if($curcalcfg["gcscoyn_withdvesb"] == true && !$GLOBALS["printfriend"]) {
                            print "\n<span id=\"esp\" style=\"width: 100%; height: 75; overflow: auto\">\n";
                        }
// changes for sean

                        print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n";

                        for($ec=$xzc1;$ec<=$cevent[0][0];$ec++,$xzc1++) {

                            if($cevent[$ec]["isallday"]=="1") {

                                print "<TR>";
# output event status column
$tstathtml = "";
$havestatus = false;


                                if($curcalcfg["showstatus"] == 1) {

                                    if($cevent[$ec]["catcolorbg"] != "") {
                                        $evsrcx = " bgcolor=\"".$cevent[$ec]["catcolorbg"]."\"";
                                    } else {
                                        $evsrcx = " class=\"".$evsrc."\"";
                                        $evsrcx = "";
                                    }

                                    $tstathtml .= "<TD valign=\"top\">\n";
                                    if($cevent[$ec]["isallday"]==1 || $cevent[$ec]["sendreminder"]==1 || $cevent[$ec]["iseventseries"]==1 || $cevent[$ec]["conflict"]==1 || $cevent[$ec]["remsuballow"]==1) {
                                        $tstathtml .= "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"0\" CLASS=\"mvdivider\">\n";
                                        $tstathtml .= "<TR><td><TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\" ".$evsrcx."><tr>\n";
                                        $tstathtml .= "<td ".$evsrcx." align=\"center\" valign=\"top\" width=\"2%\">\n";
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
                                        print "<a title=\"Click here to edit event\" style=\"text-decoration: none;
                                        cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"".$GLOBALS["idxfile"].
                                        "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$startyear.$startmonth.$startday;
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "\">";
                                    }
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                    if(strlen($cevent[$ec]["subtitle"])>0) {$subtt="<br>".$cevent[$ec]["subtitle"];} else {$subtt="";}
} else {
    $subtt = "";
}
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \"><b>";
if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                                    print $cevent[$ec]["title"];
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                    print $subtt;
}
                                    print "</b></font>";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "</a>";
                                    }
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
                                    $htout = showviewevent($cevent[$ec]["id"]);
                                    #$htout = geteventhtml($cevent[$ec]["id"]);
                                    print $htout;
                                    print "</font><hr noshade color=\"black\" size=\"1\" >
                                    </td>";
                                } else {

#                                    print "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"98%\">";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "<a title=\"Click here to edit event\" style=\"text-decoration: none;
                                        cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"".
                                        $GLOBALS["idxfile"]."?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$startyear.$startmonth.$startday;
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "\">";
                                    }
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \"><b>";
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
                                    print "</b></font>";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "</a>";
                                    }
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
                                    $htout = showviewevent($cevent[$ec]["id"]);
                                    #$htout = geteventhtml($cevent[$ec]["id"]);
                                    print $htout;
                                    print"</font><hr noshade color=\"black\" size=\"1\" width=\"95%\" ></td>";

                                }

                                print "</tr>\n";
                            }
                        }
                        print "</table>\n";
// changes for sean
#                        if($GLOBALS["withesb"] == true) {
                        if($curcalcfg["gcscoyn_withdvesb"] == true && !$GLOBALS["printfriend"]) {
                            print "</span>\n";
                        }
// changes for sean
                    }
                }
            } else {
                print "&nbsp;";
            }

    print "</TD>\n";
    print "</TR>\n";

# end of all day events row
/*
    $starttime = $curcalcfg["daybeginhour"];
    $sth = substr($curcalcfg["daybeginhour"],0,2);
    $stm = substr($curcalcfg["daybeginhour"],2,2);

    $endtime = $curcalcfg["dayendhour"];
    $enh = substr($curcalcfg["dayendhour"],0,2);
    $enm = substr($curcalcfg["dayendhour"],2,2);

    $curtime = $curcalcfg["daybeginhour"];
    $curh = substr($curcalcfg["daybeginhour"],0,2);
    $curm = substr($curcalcfg["daybeginhour"],2,2);
*/

// calculate min and max hour

    $starttime = $curcalcfg["daybeginhour"];
    $endtime = $curcalcfg["dayendhour"];

    $wdxmin = $starttime;
    $wdxmax = $endtime;

        $wdxinf = $wdxar;

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

    $curtime = $starttime;
    $curh = substr($starttime,0,2);
    $curm = substr($starttime,2,2);


    if($curcalcfg["timetype"] == 1 ) {
        $timeout = date("H:i",mktime($curh,$curm,0,3,3,1973));
    } else {
        $timeout = date("g:i A",mktime($curh,$curm,0,3,3,1973));
    }
    $functimeout = date("Hi",mktime($curh,$curm,0,3,3,1973));



    $ckd1 = date("d",mktime($curh,$curm,0,3,3,1973));
    $ckd2 = date("d",mktime($curh,$curm,0,3,3,1973));
    $safetycounter = 200;
    $amimrs = 0;

    while(($curtime <= $endtime) && ($ckd1 == $ckd2) && ($safetycounter > 0)) {
        $safetycounter--;

        $ckd3 = date("Y-m-d",mktime($curh,$curm,0,$startmonth,$startday,$startyear));

        if($ckd3 == "1970-01-01") {
            $nofunc=1;
        } else {
            $nofunc=0;
        }


        if($curcalcfg["showalltimes"] == 0) {

            $printtimerow = false;

            $cevent = $wdxar;

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

        } else {
            $printtimerow = true;
        }


        if($printtimerow == true) {

            print "<TD VALIGN=\"top\" WIDTH=\"10%\" class=\"dvtccell\" HEIGHT=\"75\">\n";
            print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr>
            <td valign=\"top\" align=\"left\" width=\"15%\" class=\"dvtccell\">";
            if($nofunc==0 && !$GLOBALS["printfriend"]) {
                if($user->gsv(canpost)==1 || $GLOBALS["demomode"]==true) {
                    print "<a href=\"".$GLOBALS["idxfile"]."?viewdate=$sdate&viewtype=Day&func=Newevent&funcdate=$sdate&functime=$functimeout";
                    if($GLOBALS["adsid"] == true) {
                        print "&".SID;
                    }
                    print "\" class=\"newlink\"><img border=\"0\" src=\"./img/new.jpg\" alt=\"".$langcfg["butnew"]."&nbsp;".$langcfg["event"]."\"></a>";
                } else {
                    print "&nbsp;";
                }
            } else {
                print "&nbsp;";
            }

            print "</td>\n";
            print "<TH VALIGN=\"top\" WIDTH=\"70%\" class=\"dvtccell\" HEIGHT=\"75\">
            <FONT class=\"dvtctext\" >$timeout</FONT></TH>\n";
            print "<td width=\"15%\" class=\"dvtccell\">&nbsp;</td></tr></table>";
            print "</TD>\n";


                $cevent = $wdxar;
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
    #                        $xcevt = substr($cevent[$xzc1]["starttimet"],0,2).substr($cevent[$xzc1]["starttimet"],3,2);
                            $xcevt = substr($cevent[$xzc1]["sorttime"],0,2).substr($cevent[$xzc1]["sorttime"],2,2);
                            $xcurtime = date("Hi",mktime($curh,$curm+29,0,3,3,1973));

                            if($xcevt >= $xcurt && $xcevt <= $xcurtime) {

    //                    print "S3";


                                for($ec=$xzc1;$ec<=$cevent[0][0];$ec++,$xzc1++) {

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
                                                $zct1 = mktime(substr($cevent[$ec]["sorttime"],0,2),substr($cevent[$ec]["sorttime"],2,2),0,3,3,1973);
                                                $zct2 = mktime($zxcevth,$zxcevtm,0,3,3,1973);
                                                while($zct2 >= $zct1) {
                                                    $amimrs++;
                                                    for($xxzc1=1;$xxzc1<=$cevent[0][0];$xxzc1++) {
    #                                                    $xzct1 = mktime(substr($cevent[$xxzc1]["starttimet"],0,2),substr($cevent[$xxzc1]["starttimet"],3,2),0,3,3,1973);
    #                                                    $xzct2 = mktime(substr($cevent[$xxzc1]["endtimet"],0,2),substr($cevent[$xxzc1]["endtimet"],3,2),0,3,3,1973);
                                                        $xzct1 = mktime(substr($cevent[$xxzc1]["sorttime"],0,2),substr($cevent[$xxzc1]["sorttime"],2,2),0,3,3,1973);
                                                        $xzct2 = mktime(substr($cevent[$xxzc1]["sorttime"],4,2),substr($cevent[$xxzc1]["sorttime"],6,2),0,3,3,1973);
                                                        if($xxzc1 != $ec) {
                                                            if($xzct1 >= $zct1 && $xzct1 <= $zct2) {
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
    /*
                                            if($cevent[$ec]["sendreminder"]==1) {
                                                $ccellt .=  "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"2%\">
                                                <font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt;\">R</font>
                                                </td>";
                                            } else {
                                                $ccellt .=  "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"2%\">
                                                <font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">&nbsp;</font>
                                                </td>";
                                            }
    */
    # output event status column
$tstathtml = "";
$havestatus = false;

                                    $evsrc="dv".$fclas."cell";
                                    if($curcalcfg["showstatus"] == 1) {

                                        if($cevent[$ec]["catcolorbg"] != "") {
                                            $evsrcx = " bgcolor=\"".$cevent[$ec]["catcolorbg"]."\"";
                                        } else {
                                            #$evsrcx = " class=\"".$evsrc."\"";
                                            $evsrcx = " class=\"".$evsrc."\"";
                                        }
                                        $tstathtml .= "<TD valign=\"top\">\n";
                                        if($cevent[$ec]["isallday"]==1 || $cevent[$ec]["sendreminder"]==1 || $cevent[$ec]["iseventseries"]==1 || $cevent[$ec]["conflict"]==1 || $cevent[$ec]["remsuballow"]==1) {
                                            $tstathtml .= "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"0\" CLASS=\"mvdivider\">\n";
                                            $tstathtml .= "<TR><td><TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\" ".$evsrcx."><tr>\n";
                                            $tstathtml .= "<td ".$evsrcx." align=\"center\" valign=\"top\" width=\"2%\">\n";
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
                                                    $ccellt .= "<a title=\"Send this user an email\" style=\"text-decoration: none;
                                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"mailto: ".$cevent[$ec]["email"]."\" target=\"_blank\"><font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font></a><br>";
                                                } else {
                                                    $ccellt .= "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font><br>";
                                                }
                                            }
}

                                            if($cevent[$ec]["isallday"]=="1") {
                                                if(!$GLOBALS["printfriend"]) {
                                                    $ccellt .= "<a title=\"Click here to edit event\" style=\"text-decoration: none;
                                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"".$GLOBALS["idxfile"].
                                                    "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$startyear.$startmonth.$startday;
                                                    if($GLOBALS["adsid"] == true) {
                                                        $ccellt .=  "&".SID;
                                                    }
                                                    $ccellt .=  "\">";
                                                }
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                                if(strlen($cevent[$ec]["subtitle"])>0) {$subtt="<br>".$cevent[$ec]["subtitle"];} else {$subtt="";}
} else {
    $subtt = "";
}
                                                $ccellt .=  "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \"><b>";
if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                                                $ccellt .=  $cevent[$ec]["title"];
}
if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                                                $ccellt .=  $subtt;
}
                                                $ccellt .=  "</b></font>";
                                                if(!$GLOBALS["printfriend"]) {
                                                    $ccellt .= "</a>";
                                                }
                                                $ccellt .= "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">";
                                                $htout = showviewevent($cevent[$ec]["id"]);
                                                #$htout = geteventhtml($cevent[$ec]["id"]);
                                                $ccellt .= $htout;
                                                $ccellt .=  "</font><hr noshade color=\"black\" size=\"1\" >
                                                </td>";
                                            } else {
    #                                            $ccellt .=  "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"98%\">";
                                                if(!$GLOBALS["printfriend"]) {
                                                    $ccellt .= "<a title=\"Click here to edit event\" style=\"text-decoration: none;
                                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"".
                                                    $GLOBALS["idxfile"]."?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$startyear.$startmonth.$startday;
                                                    if($GLOBALS["adsid"] == true) {
                                                        $ccellt .= "&".SID;
                                                    }
                                                    $ccellt .=  "\">";
                                                }
                                                $ccellt .=  "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \"><b>";
if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                                                $ccellt .= $cevent[$ec]["starttimet"]." - ".$cevent[$ec]["endtimet"]."; ";
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
                                                $ccellt .= "</b></font>";
                                                if(!$GLOBALS["printfriend"]) {
                                                    $ccellt .=  "</a>";
                                                }
                                                $ccellt .= "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">".showviewevent($cevent[$ec]["id"])."</font><hr noshade color=\"black\" size=\"1\" width=\"95%\" ></td>";
                                                #$ccellt .= "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">".geteventhtml($cevent[$ec]["id"])."</font><hr noshade color=\"black\" size=\"1\" width=\"95%\" ></td>";
                                            }
                                            $ccellt .=  "</tr>\n";
                                        }
                                    }
                                }
                                $ccellt .=  "</table>\n";
        #                        if($GLOBALS["withesb"] == true) {
                                if($curcalcfg["gcscoyn_withdvesb"] == true && !$GLOBALS["printfriend"]) {
                                    $ccellt .=  "</span>\n";
                                }

                                            if($conflict == false) {
                                                if($amimrs > 1) {
                                                    $nesrs = $amimrs * 75;
                                                } else {
                                                    $nesrs = 75;
                                                }
                                            } else {
                                                $nesrs = 75;
                                            }

        #                        if($GLOBALS["withesb"] == true) {
                                if($curcalcfg["gcscoyn_withdvesb"] == true && !$GLOBALS["printfriend"]) {
                                    $ccellt = "\n<span id=\"esp\" style=\"width: 100%; height: ".$nesrs."; overflow: auto\">\n"."<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n".$ccellt;
                                } else {
                                    $ccellt = "\n"."<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n".$ccellt;

                                }

                            }
                        }
                    }
                }



                if($conflict == true) {
                    $amimrs = 0;
                }
                if($amimrs == 0 || $fxevlp == 1) {
    //                $fxevlp = 0;
                    if($conflict == true || $bconflict == true) {
                        $extbrd = "style=\"border-style: double; border-width: 3\"";
                    } else {
                        $extbrd = "";
                    }
                    print "<TD $extbrd align=\"left\" VALIGN=\"top\" WIDTH=\"85%\" class=\"dv".$fclas."cell\" ";

                    if($amimrs > 0) {
                        print "rowspan=\"".$amimrs."\"";
                        $amimrs--;
                    }
                    print ">\n";

                } else {
                    $amimrs--;
                }


    // HEIGHT=\"75\"
                if($amimrs == 0 || $fxevlp == 1) {
                    $fxevlp = 0;

                    if($chktime1 == "1970-01-01") {
                        print "<B>&nbsp;".$langcfg["dtss"]."&nbsp;</B><hr>\n";
                        $nofunc=1;
                    } else {
                        $nofunc=0;
                    }

                    print $ccellt;

                    print "</TD>\n";
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
        print "<br><b>Some kind of Time error has occured in the Day View.</b>";
    }
}?>
