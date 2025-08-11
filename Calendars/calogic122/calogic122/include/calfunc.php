<?php

/***************************************************************
** Title.........: Calendar Functions
** Version.......: 1.2.0
** Author........: Philip Boone <philip@calogic.de>
** Filename......: calfunc.php
** Last changed..:
** Notes.........:
** Use...........:


** Functions:
***************************************************************/
/***************************************************************
**
***************************************************************/

function datediff ($interval, $date1,$date2) {

    // get the number of seconds between the two dates (mktime time stamps)
    $timedifference =  $date2 - $date1;

    switch ($interval) {
        case "w":
# week
            $retval  = $timedifference / 604800;
            break;
        case "d":
# day
            #$retval  = bcdiv( $timedifference,86400);
            $retval  = $timedifference / 86400;
            break;
        case "h":
# hour
             $retval = $timedifference / 3600 ;
            break;
        case "n":
# minute
            $retval  = $timedifference / 60;
            break;
        case "s":
# second
            $retval  = $timedifference;
            break;

    }
    return $retval;

}

function dateadd ($interval,  $number, $date) {

    /*
    yyyy     year
    q	Quarter
    m	Month
    y	Day of year
    d	Day
    w	Weekday
    ww  Week of year
    h	Hour
    n	Minute
    s	Second

    */
    $date_time_array  = getdate($date);

    $hours =  $date_time_array["hours"];
    $minutes =  $date_time_array["minutes"];
    $seconds =  $date_time_array["seconds"];
    $month =  $date_time_array["mon"];
    $day =  $date_time_array["mday"];
    $year =  $date_time_array["year"];

    switch ($interval) {

        case "yyyy":
            $year +=$number;
            break;
        case "q":
            $year +=($number*3);
            break;
        case "m":
            $month +=$number;
            break;
        case "y":
        case "d":
        case "w":
             $day+=$number;
            break;
        case "ww":
             $day+=($number*7);
            break;
        case "h":
             $hours+=$number;
            break;
        case "n":
             $minutes+=$number;
            break;
        case "s":
             $seconds+=$number;
            break;

    }
    $timestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
    return $timestamp;
}

function minical($sday,$smonth,$syear,$swcw) {

#print "MCSD: ".$sday.$smonth.$syear."<br>";

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$wsbfd,$wsbld,$weekselreact,$fsize;
    global $langcfg,$curcalcfg,$evbgcol,$evfgcol,$cevent,$cellarr,$cellcount;

    $mclinkfen = "";
    if(isset($GLOBALS["mcpiactive"])) {
        $orgidx = $GLOBALS["idxfile"];
        $GLOBALS["idxfile"] = $GLOBALS["CLURL"]."/".$GLOBALS["idxfile"];
        if($GLOBALS["MCLINKRES"]==1) {
            $mclinkfen = "target=_blank";
        }
    }

    if(!isset($GLOBALS["aimcal"])) {$GLOBALS["aimcal"]=1;}

    $startmonth = $smonth;
    $startday = $sday;
    $startyear = $syear;

    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

//    $firstweekdaynum = strftime("%u",mktime(0,0,0,$startmonth,$startday,$startyear));
# Some of the modifiers differ on win32
# (eg. %u -> %w, %e -> %d).
# Search at http://msdn.microsoft.com/ for
# strftime().

//        if($GLOBALS["usingwindows"] == true) {
            $firstweekdaynum = strftime("%w",mktime(0,0,0,$startmonth,$startday,$startyear));
            if($firstweekdaynum == 0) {$firstweekdaynum = 7;}
//        } else {
//            $firstweekdaynum = strftime("%u",mktime(0,0,0,$startmonth,$startday,$startyear));
//        }

    $date_time_array = getdate ($cuts);
    $todayday = $date_time_array[ "mday"];
    $todaymonth = $date_time_array[ "mon"];
    $todayyear = $date_time_array[ "year"];

    $xuts = mktime(0,0,0,$todaymonth,$todayday,$todayyear);

    $xdta = getdate ($xuts);
    $xdtm = $monthtextl[$xdta[ "mon"]];

    $lyear = strftime("%Y",$xuts);
    $lmonth = strftime("%m",$xuts);

    $date_time_array = getdate (time());
    $todayday = $date_time_array[ "mday"];
    $todaymonth = $date_time_array[ "mon"];
    $todayyear = $date_time_array[ "year"];


        print "<TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"0\"><TR><TD CLASS=\"mcdivider\">\n";
        print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"2\">\n";
        print "<TR><TD class=\"mcmcell\" COLSPAN=7 ALIGN=\"center\">";
        if($GLOBALS["aimcal"]==1) {
            print "<A ".$mclinkfen." class=\"mcmlink\" HREF=\"".$GLOBALS["idxfile"]."?viewdate=$lyear$lmonth"."01&viewtype=Month&monthsel=$lyear$lmonth"."01\">$xdtm&nbsp;$lyear</A>";
        } else {
            print "<font class=\"mcmlink\">$xdtm&nbsp;$lyear</font>";
        }
        print "</TD></TR>";

    if ($weekstartonmonday==0) {
        $firstweekdaynum++;
        if($firstweekdaynum>7){$firstweekdaynum=1;}
    }

    $cellarr[0][0] = 0;
    $cellarr[0][1] = 0;
    $cellarr[0][2] = 0;
    $cellarr[0][3] = 0;
    $cellarr[0][4] = 0;
    $cellarr[0][5] = 0;

    $cellcount = 1;
    for($i=$firstweekdaynum-1;$i>0;$i--){

    //    $tval = datesub($cuts,0,0,0,$cellcount,0,0);
        $tval = dateadd("d",$cellcount*-1,$cuts);
        $tval2 = strftime("%Y",$tval);
        $cellarr[$i][0] = $tval2;

        $tval2 = strftime("%m",$tval);
        $cellarr[$i][1] = $tval2;

        $tval2 = strftime("%d",$tval);
        $cellarr[$i][2] = $tval2;

        $cellcount++;
    }


        for ( $ch = 1; $ch <= 7; $ch++ ) {
            print "<TD ALIGN=\"center\"";
                if (($weekstartonmonday==1 && $ch < 6) || ($weekstartonmonday==0 && $ch > 1 && $ch < 7)) {
                print "class=\"mchwdcell\"><FONT class=\"mchwd\" >$daytext[$ch]</FONT>";
            } else {
                print "class=\"mchwecell\"><FONT class=\"mchwe\" >$daytext[$ch]</FONT>";
            }
        }
        print "</TD></TR>\n";

        $cellcount = 1;
        $acelcnt = 0;

        for ( $cr = 1; $cr <= 6; $cr++ ) {
            print "<TR>\n";
            for ( $cc = 1; $cc <= 7; $cc++ ) {

                if ($cellcount < 10 ) {
                    $cellcounttext = "0".$cellcount;
                } else {
                    $cellcounttext = $cellcount;
                }

                if ($cellcount>=$firstweekdaynum) {
        //            $tval = dateadd($cuts,0,0,0,$acelcnt,0,0);
                    $tval = dateadd("d",$acelcnt,$cuts);

                    $tval2 = strftime("%Y",$tval);
                    $cellarr[$cellcount][0] = $tval2;

                    $tval2 = strftime("%m",$tval);
                    $cellarr[$cellcount][1] = $tval2;

                    $tval2 = strftime("%d",$tval);
                    $cellarr[$cellcount][2] = $tval2;
                    $acelcnt++;
                }

                $cevent = false;
                $evfgcol="";
                if ($startmonth == $cellarr[$cellcount][1] || $curcalcfg["gcscoyn_showomd"]==true) {
                    //function checkforevents($eday, $emonth, $eyear,$ehour,$emin,$eview) {
                    $cevent = checkforevents($cellarr[$cellcount][2], $cellarr[$cellcount][1], $cellarr[$cellcount][0],0,0,"Minical");
                    $smcpop = getmcpop(1);
                    if($cevent[0][0] > 0) {
                        $cevent = true;
                    } else {
                        $cevent = false;
                    }
                } else {
                    $cevent = false;
                }

                print "<TD VALIGN=\"top\" ALIGN=\"center\"";

                if ($startmonth == $cellarr[$cellcount][1] ) {
                    if ($todayday == $cellarr[$cellcount][2] && $todaymonth == $cellarr[$cellcount][1] && $todayyear == $cellarr[$cellcount][0]) {
                        print " class=\"mccdcell\">";
                        if($GLOBALS["aimcal"]==1) {
                            print "<A ".$smcpop." ".$mclinkfen." class=\"mccdlink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                        } else {
                            print "<font ".$smcpop." class=\"mccdlink\">".$cellarr[$cellcount][2]."</font>";
                        }
                        print "</TD>\n";

                    } else {
                        if (($weekstartonmonday==1 && $cc < 6) || ($weekstartonmonday==0 && $cc > 1 && $cc < 7)) {
// weekday
                            if($cevent == true) {
//                                print "class=\"mcdwecell\"><A class=\"mcwdwelink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A></TD>\n";
// changes for Sean
                                print " bgColor=\"$evbgcol\" >";
                                if($GLOBALS["aimcal"]==1) {
                                    print "<A ".$smcpop." ".$mclinkfen." style=\"background-color: $evbgcol; color: ".$evfgcol."; text-decoration: ".$curcalcfg["mcwdstyle"]."; cursor: hand; font-size: 7pt;\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                } else {
                                    print "<font ".$smcpop." style=\"background-color: $evbgcol; color: ".$evfgcol."; text-decoration: ".$curcalcfg["mcwdstyle"]."; font-size: 7pt;\">".$cellarr[$cellcount][2]."</font>";
                                }
                                print "</TD>\n";
// changes for Sean
                            } else {
                                print " class=\"mcwdcell\">";
                                if($GLOBALS["aimcal"]==1) {
                                    print "<A ".$smcpop." ".$mclinkfen." class=\"mcwdlink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                } else {
                                    print "<font ".$smcpop." class=\"mcwdlink\">".$cellarr[$cellcount][2]."</font>";
                                }
                                print "</TD>\n";
                            }
//                            print "<A class=\"mcwdlink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A></TD>\n";
                        } else {
//week end
                            if($cevent == true) {
//                                print " class=\"mcdwecell\"><A class=\"mcwewelink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A></TD>\n";
// changes for Sean
                                print " bgColor=\"$evbgcol\" >";
                                if($GLOBALS["aimcal"]==1) {
                                    print "<A ".$smcpop." ".$mclinkfen." style=\"background-color: $evbgcol; color: ".$evfgcol."; text-decoration: ".$curcalcfg["mcwestyle"]."; cursor: hand; font-size: 7pt;\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                } else {
                                    print "<font ".$smcpop." style=\"background-color: $evbgcol; color: ".$evfgcol."; text-decoration: ".$curcalcfg["mcwestyle"]."; font-size: 7pt;\">".$cellarr[$cellcount][2]."</font>";
                                }
                                print "</TD>\n";
// changes for Sean


                            } else {
                                print " class=\"mcwecell\">";
                                if($GLOBALS["aimcal"]==1) {
                                    print "<A ".$smcpop." ".$mclinkfen." class=\"mcwelink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                } else {
                                    print "<font ".$smcpop." class=\"mcwelink\">".$cellarr[$cellcount][2]."</font>";
                                }
                                print "</TD>\n";
                            }
//                            print "<A class=\"mcwelink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A></TD>\n";
                        }
                    }

                } else {

# out of month

                    if(($cellarr[$cellcount][2]==1) || ($cellcount==($firstweekdaynum-1))) {

                        $xuts = mktime(0,0,0,$cellarr[$cellcount][1],$cellarr[$cellcount][2],$cellarr[$cellcount][0]);

                        $xdta = getdate ($xuts);
                        $xdtm = $xdta[ "month"];
                            if($cevent == true) {
                                #print "class=\"mcdwecell\">";
                                print " bgColor=\"$evbgcol\" >";
                                if($curcalcfg["gcscoyn_showomd"]==true) {
                                    if($GLOBALS["aimcal"]==1) {
                                        #print "<A ".$smcpop." ".$mclinkfen." class=\"mcncdwelink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                        print "<A ".$smcpop." ".$mclinkfen." style=\"background-color: $evbgcol; color: ".$evfgcol."; text-decoration: ".$curcalcfg["mcncstyle"]."; cursor: hand; font-size: 7pt;\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";

                                    } else {
                                        print "<font ".$smcpop." class=\"mcncdwelink\">".$cellarr[$cellcount][2]."</font>";
                                    }
                                    print "</TD>\n";
                                } else {
// changes for Sean
                                    print "<font style=\" font-size: 7pt;\">&nbsp;</font></TD>\n";
                                }
// changes for Sean
                            } else {
                                if($curcalcfg["gcscoyn_showomd"]==true) {

                                    print "class=\"mcnccell\">";
                                    if($GLOBALS["aimcal"]==1) {
                                        print "<A ".$smcpop." ".$mclinkfen." class=\"mcnclink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                        #print "<A ".$smcpop." ".$mclinkfen." style=\"background-color: $evbgcol; color: ".$curcalcfg["mcnccolor"]."; text-decoration: ".$curcalcfg["mcncstyle"]."; cursor: hand; font-size: 7pt;\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                    } else {
                                        print "<font ".$smcpop." class=\"mcnclink\">".$cellarr[$cellcount][2]."</font>";
                                    }
                                    print "</TD>\n";
                                } else {
// changes for Sean
                                    print "class=\"mcnccell\"><font style=\" font-size: 7pt;\">&nbsp;</font></TD>\n";
                                }
// changes for Sean
                            }

//                        print "<A class=\"mcnclink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A></TD>\n";
                    } else {
                            if($cevent == true) {
                                if($curcalcfg["gcscoyn_showomd"]==true) {
                                    #print "class=\"mcdwecell\">";
                                    print " bgColor=\"$evbgcol\" >";
                                    if($GLOBALS["aimcal"]==1) {
                                        #print "<A ".$smcpop." ".$mclinkfen." class=\"mcncdwelink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                        print "<A ".$smcpop." ".$mclinkfen." style=\"background-color: $evbgcol; color: ".$evfgcol."; text-decoration: ".$curcalcfg["mcncstyle"]."; cursor: hand; font-size: 7pt;\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                    } else {
                                        print "<font ".$smcpop." class=\"mcncdwelink\">".$cellarr[$cellcount][2]."</font>";
                                    }
                                    print "</TD>\n";
                                } else {
// changes for Sean
                                    print "class=\"mcdwecell\"><font style=\" font-size: 7pt;\">&nbsp;</font></TD>\n";
                                }
// changes for Sean
                            } else {
                                if($curcalcfg["gcscoyn_showomd"]==true) {
                                    print "class=\"mcnccell\">";
                                    if($GLOBALS["aimcal"]==1) {
                                        print "<A ".$smcpop." ".$mclinkfen." class=\"mcnclink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                        #print "<A ".$smcpop." ".$mclinkfen." style=\"background-color: $evbgcol; color: ".$curcalcfg["mcnccolor"]."; text-decoration: ".$curcalcfg["mcncstyle"]."; cursor: hand; font-size: 7pt;\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A>";
                                    } else {
                                        print "<font ".$smcpop." class=\"mcnclink\">".$cellarr[$cellcount][2]."</font>";
                                    }
                                    print "</TD>\n";
                                } else {
// changes for Sean
                                    print "class=\"mcnccell\"><font style=\" font-size: 7pt;\">&nbsp;</font></TD>\n";
                                }
// changes for Sean
                            }

//                        print "<A class=\"mcnclink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day\">".$cellarr[$cellcount][2]."</A></TD>\n";
                    }
                }
                $cellcount++;
            }

            print "</TR>\n";
        }
        print "</TABLE></TD></TR></TABLE>\n";

        if($swcw==0) {
            $wsbfd = mktime(0,0,0,$cellarr[1][1],$cellarr[1][2],$cellarr[1][0]);
            $wsbld = dateadd("ww",15,$wsbfd);
//            $wsbfd = $cellarr[1][0].$cellarr[1][1].$cellarr[1][2];
        } else {

            $wsbfd = mktime(0,0,0,$cellarr[1][1],$cellarr[1][2],$cellarr[1][0]);
            $wsbfd = dateadd("ww",-6,$wsbfd);
            $wsbld = dateadd("ww",15,$wsbfd);


#            $wsbld = mktime(0,0,0,$cellarr[42][1],$cellarr[42][2],$cellarr[42][0]);

        }


    if(isset($mcpiactive)) {
        $GLOBALS["idxfile"] = $orgidx;
    }

}


function getmcpop($mcspvar=0) {

# $mcspvar (use fixed spacing, only neede for the minical: 0 = no, 1 = yes)
# the year, month and week views use this function too, but with $mcspvar set to 0)

# this function builds the popup for the "over day number" event.
# the popup shows all the events for the day the mouse is placed over
# it returns an overlib function call

global $cevent,$cellarr,$cellcount,$user,$curcalcfg;

$eventstoday = "";
$popevent = "";

    $checkdisp = false;
    if($user->gsv("isadmin")!="1") {
#        if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
        if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
            $checkdisp = true;
        }
    }

#onmouseover=\"return overlib('Click user name to send this user an Email', FGCOLOR, '#FEF3E0', CAPTION, 'Send Email',BGCOLOR,'#FF6633');\" onmouseout=\"nd();\">

    if($cevent[0][0] > 0) {
        for($pec=1;$pec<=$cevent[0][0];$pec++) {
    #        $eventstoday .= "Event 1<br>";
            if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                if($cevent[$pec]["isallday"]==1) {
                    $eventstoday .= "All Day<br>";
                }else {
                    $eventstoday .= $cevent[$pec]["starttimet"]." - ".$cevent[$pec]["endtimet"]."<br>";
                }
            }

            if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                if(strlen($cevent[$pec]["subtitle"])>0) {
                	$subtt="<br>".$cevent[$pec]["subtitle"];
                } else {
                	$subtt="";
                }
            } else {
                $subtt = "";
            }

            if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                $eventstoday .= $cevent[$pec]["title"];
            }
            if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
                $eventstoday .= $subtt;
            }

            if($pec != $cevent[0][0]) {
                $eventstoday .= "<hr noshade color=\"black\" size=\"1\" width=\"95%\">";
            }
        }
    } else {
        $eventstoday = "None";
    }

    $mcpopfix = "";

    if($mcspvar==1) {
        if($cellcount < 8) {
            #row 1
            $mcpopfix = "OFFSETY, 70, ";
        } elseif($cellcount < 15) {
            # row 2
            $mcpopfix = "OFFSETY, 58, ";
        } elseif($cellcount < 22) {
            # row 3
            $mcpopfix = "OFFSETY, 46, ";
        } elseif($cellcount < 29) {
            # row 4
            $mcpopfix = "OFFSETY, 34, ";
        } elseif($cellcount < 36) {
            # row 5
            $mcpopfix = "OFFSETY, 22, ";
        } else {
            # row 6
            $mcpopfix = "OFFSETY, 10, ";
        }
    }

/*
pu_EventPopupDayCaptionColor = "#009933";
pu_EventPopupDayCaptionFont = "Verdana,Arial,Helvetica";
pu_EventPopupDayCaptionFontColor = "#FFFFFF";
pu_EventPopupDayCaptionSize = "1";
pu_EventPopupDayColor = "#99ff99";
pu_EventPopupDayFont = "Verdana,Arial,Helvetica";
pu_EventPopupDayFontColor = "#000000";
pu_EventPopupDayFontSize = "1";
*/
    $tevpop = getdespop($eventstoday);
    $popevent = " onmouseover=\"return overlib('".$tevpop."', ".$mcpopfix;
    if($GLOBALS["mcpiactive"]==1) {
        $popevent .= "CAPTION,'Events for ".$cellarr[$cellcount][2].".".$cellarr[$cellcount][1].".".$cellarr[$cellcount][0]."',";
    } else {
        $popevent .= "CAPTION,'Events for ".$cellarr[$cellcount][2].".".$cellarr[$cellcount][1].".".$cellarr[$cellcount][0]."<br>(click for day view)',";
    }
    $popevent .= "BGCOLOR,'".$curcalcfg["pu_PopupDayCaptionColor"]."',";
    $popevent .= "CAPTIONFONT,'".$curcalcfg["pu_PopupDayCaptionFont"]."',";
    $popevent .= "CAPCOLOR,'".$curcalcfg["pu_PopupDayCaptionFontColor"]."',";
    $popevent .= "CAPTIONSIZE,'".$curcalcfg["pu_PopupDayCaptionSize"]."',";
    $popevent .= "FGCOLOR, '".$curcalcfg["pu_PopupDayColor"]."',";
    $popevent .= "TEXTFONT,'".$curcalcfg["pu_PopupDayFont"]."',";
    $popevent .= "TEXTCOLOR,'".$curcalcfg["pu_PopupDayFontColor"]."',";
    $popevent .= "TEXTSIZE,'".$curcalcfg["pu_PopupDayFontSize"]."'";
    $popevent .= ");\" onmouseout=\"return nd();\" ";

    return $popevent;

}

function makeolcreator() {
global $curcalcfg;

    #$tevpop = getdespop($eventstoday);
    #onmouseover=\"return overlib('Click user name to send this user an Email', FGCOLOR, '#FEF3E0', CAPTION, 'Send Email',BGCOLOR,'#FF6633');\" onmouseout=\"nd();\">
    $popevent = " onmouseover=\"return overlib('Click user name to send this user an Email',";
    $popevent .= "CAPTION,'Send Email',";
    $popevent .= "BGCOLOR,'".$curcalcfg["pu_PopupCreatorCaptionColor"]."',";
    $popevent .= "CAPTIONFONT,'".$curcalcfg["pu_PopupCreatorCaptionFont"]."',";
    $popevent .= "CAPCOLOR,'".$curcalcfg["pu_PopupCreatorCaptionFontColor"]."',";
    $popevent .= "CAPTIONSIZE,'".$curcalcfg["pu_PopupCreatorCaptionSize"]."',";
    $popevent .= "FGCOLOR, '".$curcalcfg["pu_PopupCreatorColor"]."',";
    $popevent .= "TEXTFONT,'".$curcalcfg["pu_PopupCreatorFont"]."',";
    $popevent .= "TEXTCOLOR,'".$curcalcfg["pu_PopupCreatorFontColor"]."',";
    $popevent .= "TEXTSIZE,'".$curcalcfg["pu_PopupCreatorFontSize"]."'";
    $popevent .= ");\" onmouseout=\"return nd();\" ";

    return($popevent);

}

function makeolevent($eventtext="") {
global $curcalcfg;

    $eventtext = addslashes($eventtext);

    $tevpop = getdespop($eventtext,1);
    #onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\"

    $popevent = " onmouseover=\"return overlib('".$tevpop."',";
    $popevent .= "CAPTION,'<u>Event Description</u><br>Click to view/edit<br>CTRL+Click to view in a window',";
    $popevent .= "BGCOLOR,'".$curcalcfg["pu_PopupEventCaptionColor"]."',";
    $popevent .= "CAPTIONFONT,'".$curcalcfg["pu_PopupEventCaptionFont"]."',";
    $popevent .= "CAPCOLOR,'".$curcalcfg["pu_PopupEventCaptionFontColor"]."',";
    $popevent .= "CAPTIONSIZE,'".$curcalcfg["pu_PopupEventCaptionSize"]."',";
    $popevent .= "FGCOLOR, '".$curcalcfg["pu_PopupEventColor"]."',";
    $popevent .= "TEXTFONT,'".$curcalcfg["pu_PopupEventFont"]."',";
    $popevent .= "TEXTCOLOR,'".$curcalcfg["pu_PopupEventFontColor"]."',";
    $popevent .= "TEXTSIZE,'".$curcalcfg["pu_PopupEventFontSize"]."'";
    $popevent .= ");\" onmouseout=\"return nd();\" ";


    return($popevent);

}
function ISOWeek($y, $m, $d) {
    $week=strftime("%W", mktime(0, 0, 0, $m, $d, $y));
    $dow0101=getdate(mktime(0, 0, 0, 1, 1, $y));
    $next0101=getdate(mktime(0, 0, 0, 1, 1, $y+1));

    if ($dow0101["wday"]>1 && $dow0101["wday"]<5) {
        $week++;
    }
    if ($next0101["wday"]>1 && $next0101["wday"]<5 && $week==53) {
        $$week=1;
    }
    if ($week==0) {
        $week = ISOWeek($y-1,12,31);
    }
    #$week = (substr("00" . $week, -2));
    return(substr("00" . $week, -2));
}


//function weekselectbox($sday,$smonth,$syear,$gobut) {
function weekselectbox($ayear,$amonth,$aday,$gobut,$ccwsel,$gyear,$gmonth,$gday) {

global $mainmenu,$weekmenu,$monthmenu,$yearmenu,$calmenu,$funcmenu,$mainmenustyle,$menustyle;
global $menubarprevlink,$menubarnextlink,$menubarcurweek,$menubarcurmonth,$menubarcuryear;
global $menubarprevlinktext,$menubarnextlinktext;


###return;


    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$wsbfd,$wsbld,$weekselreact;
    global $langcfg,$curcalcfg;
    global $viewdate,$weeksel,$viewtype;

$weekmenu = "";
$menubarcurweek = "";
$weeklink = "";
$weekmenunum = 0;


$weekmenu .= "<table border=\"1\" style=\"border-collapse: collapse\" width=\"100%\" id=\"weekmenulist\">";


    $tnow = time();
    $tyear = strftime("%Y",$tnow);
    $tmonth = strftime("%m",$tnow);
    $tday = strftime("%d",$tnow);

    $tdate = mktime(0,0,0,$tmonth,$tday,$tyear);

    $tbxdate = mktime(0,0,0,$amonth,$aday,$ayear);
    $texdate = dateadd("ww",15,$tbxdate);

    $fcwdate = mktime(0,0,0,$gmonth,1,$gyear);

    $canselweek=0;

    if(($tnow >= $tbxdate) && ($tnow <= $texdate)) {$canselweek = 1;}

/*
print "selwk: ".$canselweek."<br>";
print "now : ".$tdate."<br>";
print "time: ".$tnow."<br>";
print "strt: ".$tbxdate."<br>";
print "end : ".$texdate."<br>";
print "std: ".$aday."<br>";
print "stm: ".$amonth."<br>";
print "sty: ".$ayear."<br>";

print "etd: ".strftime("%Y",$texdate)."<br>";
print "etm: ".strftime("%m",$texdate)."<br>";
print "ety: ".strftime("%d",$texdate)."<br>";
*/

    ###print "<FORM action=\"".$GLOBALS["idxfile"]."\" method=".$GLOBALS["postorget"]." id=selweek name=selweek>\n";
    ###print "<INPUT type=\"submit\" value=\"".$langcfg["swvbut"]."\" id=goweek name=goweek><br>\n";
    ###print "<SELECT style=\"WIDTH: 170px\" id=weeksel name=weeksel LANGUAGE=javascript onchange=\"selweek.submit();\">\n";


    if ($ccwsel==1) {

        $syear = strftime("%Y",$wsbfd);
        $smonth = strftime("%m",$wsbfd);
        $sday = strftime("%d",$wsbfd);

    } else {

        $syear = $ayear;
        $smonth = $amonth;
        $sday = $aday;

    }


    $bdat = mktime(0,0,0,$smonth,$sday,$syear);
    $edat = dateadd("d",6,$bdat);

    for ($i=0;$i<=15;$i++) {

        $xdta = getdate ($bdat);
        $lbmn = $monthtext[$xdta["mon"]];

        $lbyear = strftime("%Y",$bdat);
        $lbmonth = strftime("%m",$bdat);
        $lbday = strftime("%d",$bdat);
        $lbweek = strftime("%W",$bdat);


        $xdta = getdate ($edat);
        $lemn = $monthtext[$xdta["mon"]];

        $leyear = strftime("%Y",$edat);
        $lemonth = strftime("%m",$edat);
        $leday = strftime("%d",$edat);
        $leweek = strftime("%W",$edat);

        if($curcalcfg["weektype"]=="1") {
            $wnum = ISOWeek($lbyear, $lbmonth, $lbday);
        #    echo "WT: 1";
        } else {
            $wnum = strftime("%W",mktime(0,0,0,$lbmonth,$lbday,$lbyear));
        #    echo "WT: 0";
        }

        $optstr = $langcfg["wns"]."&nbsp;$wnum,&nbsp;$lbmn&nbsp;$lbday&nbsp;-&nbsp;$lemn&nbsp;$leday";

        ###print "<OPTION value=$lbyear$lbmonth$lbday";

            if ($weekselreact==1) {
                if ($canselweek==1) {
                    if(($tdate >=  $bdat) && ($tdate <= $edat)) {
                        ###print " selected ";
                        $menubarcurweek = $GLOBALS["idxfile"]."?viewdate=".$lbyear.$lbmonth.$lbday."&viewtype=Week&weeksel=".$lbyear.$lbmonth.$lbday;
                        $optstr = "<b>".$optstr."</b>";
                        ###if(!isset($weeksel) && $viewtype=="Week") {
                            ###$viewdate = $lbyear.$lbmonth.$lbday;
                        ###}

                    }
                } else {
                // select first week in actual month if possible
                    if(($fcwdate >=  $bdat) && ($fcwdate <= $edat)) {
                        ###print " selected ";
                        $menubarcurweek = $GLOBALS["idxfile"]."?viewdate=".$lbyear.$lbmonth.$lbday."&viewtype=Week&weeksel=".$lbyear.$lbmonth.$lbday;
                        $optstr = "<b>".$optstr."</b>";
                        ###if(!isset($weeksel) && $viewtype=="Week") {
                            ###$viewdate = $lbyear.$lbmonth.$lbday;
                        ###}

                    }
                }
            } else {
                // select first week in actual month if possible
                    if(($fcwdate >=  $bdat) && ($fcwdate <= $edat)) {
                        ###print " selected ";
                        $menubarcurweek = $GLOBALS["idxfile"]."?viewdate=".$lbyear.$lbmonth.$lbday."&viewtype=Week&weeksel=".$lbyear.$lbmonth.$lbday;
                        $optstr = "<b>".$optstr."</b>";
                        ###if(!isset($weeksel) && $viewtype=="Week") {
                            ###$viewdate = $lbyear.$lbmonth.$lbday;
                        ###}
                    }
            }


        #print ">$optstr</OPTION>\n";


$weekmenunum++;
$menunum = "weekmenu".$weekmenunum;
$weeklink = $GLOBALS["idxfile"]."?viewdate=".$lbyear.$lbmonth.$lbday."&viewtype=Week&weeksel=".$lbyear.$lbmonth.$lbday;

$weekmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
$weekmenu .= "<td onclick=\"return jumptolink('".$weeklink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=100% onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
$weekmenu .= "</tr>";


        $bdat = dateadd("d",1,$edat);
        $edat = dateadd("d",6,$bdat);

    }

###    print "</SELECT>";
//    if($gobut==1) {
###    print "</FORM>\n";
//    }



$weekmenu .= "</table>";
#print $menustr;
$tevpop = getdespop($weekmenu);

return($tevpop);
#$popevent = " overlib('".$tevpop."',0 ,ANCHOR,'".$menuid."pos' ,ANCHORY ,20 ,FGCOLOR, '#99ff99',STICKY,NOCLOSE,CAPTION,'Menu',BGCOLOR,'#009933');\" ";
#$popevent = " overlib('".$tevpop."',0 ,ANCHOR,'".$menuid."pos' ,FGCOLOR, '#99ff99',STICKY,NOCLOSE,CAPTION,'Menu',BGCOLOR,'#009933')";
#$weekmenu = " overlib('".$tevpop."',0 ,ANCHOR,'".$menuid."pos' ,FGCOLOR, '#99ff99',STICKY,NOCLOSE,BGCOLOR,'#009933')";

}


function monthselectbox($sday,$smonth,$syear,$eday,$emonth,$eyear,$cday,$cmonth,$cyear,$gobut) {

global $mainmenu,$weekmenu,$monthmenu,$yearmenu,$calmenu,$funcmenu,$mainmenustyle,$menustyle;
global $menubarprevlink,$menubarnextlink,$menubarcurweek,$menubarcurmonth,$menubarcuryear;
global $menubarprevlinktext,$menubarnextlinktext;

    ###return;


    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl;
    global $langcfg,$curcalcfg;


$monthmenu = "";
$menubarcurmonth = "";
$monthlink = "";
$monthmenunum = 0;

$monthmenu .= "<table border=\"1\" style=\"border-collapse: collapse\" width=\"100%\" id=\"monthmenulist\">";


//    print "<font class=\"cvheadtext\" size=\"-1\"><B>Month:</b></FONT><BR><SELECT id=monthsel name=monthsel LANGUAGE=javascript onchange=\"return monthsel_onchange()\">\n";

    ###print "<FORM action=\"".$GLOBALS["idxfile"]."\" method=".$GLOBALS["postorget"]." id=selmonth name=selmonth>\n";
    ###print "<INPUT type=\"submit\" value=\"".$langcfg["smvbut"]."\" id=gomonth name=gomonth><br>\n";
    ###print "<SELECT style=\"WIDTH: 120px\" id=monthsel name=monthsel LANGUAGE=javascript onchange=\"selmonth.submit();\">\n";

    $suts = mktime(0,0,0,$smonth,$sday,$syear);
    $cuts = mktime(0,0,0,$cmonth,$cday,$cyear);
    $euts = mktime(0,0,0,$emonth,$eday,$eyear);

    $xuts = $suts;

    while ($xuts <= $euts) {

        $xdta = getdate ($xuts);
        #$xdtm = $xdta["month"];

        $lyear = strftime("%Y",$xuts);
        $lmonth = strftime("%m",$xuts);
        $xdtm = $monthtextl[$xdta["mon"]];

        ###print "<OPTION value=$lyear$lmonth"."01";
        $optstr = $xdtm."&nbsp;".$lyear;
        if($lyear==$cyear && $lmonth==$cmonth) {
            ###print " selected ";
            $optstr = "<b>".$optstr."</b>";
            $menubarcurmonth = $GLOBALS["idxfile"]."?viewdate=".$lyear.$lmonth."01&viewtype=Month&monthsel=".$lyear.$lmonth."01";
        }

        ###print ">$xdtm&nbsp;$lyear</OPTION>\n";

    //    $xuts = dateadd($xuts,0,0,0,0,1,0);
        $xuts = dateadd("m",1,$xuts);

$monthmenunum++;
$menunum = "monthmenu".$monthmenunum;
$monthlink = $GLOBALS["idxfile"]."?viewdate=".$lyear.$lmonth."01&viewtype=Month&monthsel=".$lyear.$lmonth."01";

$monthmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
$monthmenu .= "<td onclick=\"return jumptolink('".$monthlink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=100% onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
$monthmenu .= "</tr>";


    }

    ###print "</SELECT>";
//    if($gobut==1) {
//    }
    ###print "</FORM>\n";

$monthmenu .= "</table>";
$tevpop = getdespop($monthmenu);

return($tevpop);


}

function yearselectbox($syear,$eyear,$cyear,$gobut) {
global $mainmenu,$weekmenu,$monthmenu,$yearmenu,$calmenu,$funcmenu,$mainmenustyle,$menustyle;
global $menubarprevlink,$menubarnextlink,$menubarcurweek,$menubarcurmonth,$menubarcuryear;
global $menubarprevlinktext,$menubarnextlinktext;

    ###return;


    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl;
    global $langcfg,$curcalcfg;

//    print "<font class=\"cvheadtext\" size=\"-1\"><B>Year:</b></FONT><BR><SELECT id=yearsel name=yearsel LANGUAGE=javascript onchange=\"return yearsel_onchange()\">\n";


    ###print "<FORM action=\"".$GLOBALS["idxfile"]."\" method=".$GLOBALS["postorget"]." id=selyear name=selyear>\n";
    ###print "<INPUT type=\"submit\" value=\"".$langcfg["syvbut"]."\" id=goyear name=goyear><br>\n";
    ###print "<SELECT style=\"WIDTH: 90px\" id=yearsel name=yearsel LANGUAGE=javascript onchange=\"selyear.submit();\">\n";


$yearmenu = "";
$menubarcuryear = "";
$yearlink = "";
$yearmenunum = 0;

$yearmenu .= "<table border=\"1\" style=\"border-collapse: collapse\" width=\"100%\" id=\"yearmenulist\">";



    $suts = mktime(0,0,0,1,1,$syear);
    $cuts = mktime(0,0,0,1,1,$cyear);
    $euts = mktime(0,0,0,1,1,$eyear);

    $xuts = $suts;

    while ($xuts <= $euts) {

        $lyear = strftime("%Y",$xuts);

        ###print "<OPTION value=$lyear"."0101";
        $optstr = "&nbsp;".$lyear."&nbsp";

        if($lyear==$cyear) {
            ###print " selected ";
            $optstr = "<b>".$optstr."</b>";
            $menubarcuryear = $GLOBALS["idxfile"]."?viewdate=".$lyear."0101&viewtype=Year&yearsel=".$lyear."0101";

        }

        ###print ">&nbsp;$lyear&nbsp;</OPTION>\n";

    //    $xuts = dateadd($xuts,0,0,0,1,0,1);
        $xuts = dateadd("yyyy",1,$xuts);

$yearmenunum++;
$menunum = "yearmenu".$yearmenunum;
$yearlink = $GLOBALS["idxfile"]."?viewdate=".$lyear."0101&viewtype=Year&yearsel=".$lyear."0101";

$yearmenu .= "<tr bgcolor=\"".$curcalcfg["pu_MenuItemColor"]."\">";
$yearmenu .= "<td onclick=\"return jumptolink('".$yearlink."')\" style=\"".$menustyle."cursor: hand\" id='".$menunum."' name='".$menunum."' nowrap width=100% onmouseover=\"return setmenuin('".$menunum."')\" onmouseout=\"return setmenuout('".$menunum."')\" language=\"javascript\">".$optstr."</td>";
$yearmenu .= "</tr>";

    }

    ###print "</SELECT>";
//    if($gobut==1) {
    ###print "</FORM>\n";
//    }

$yearmenu .= "</table>";
$tevpop = getdespop($yearmenu);

return($tevpop);

}


function editcats($cuser) {
    global $timear,$timeara,$curcalcfg,$monthtext,$monthtextl,$langcfg;

?>
<?php
print $GLOBALS["htmldoctype"];
?>

<html>
<head>
<title>Categories</title>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

    var curfeld = "";
    var aclr = "";


    function setcolor_ondblclick(cname) {
        if(curfeld != "") {
            catform.item(curfeld).value = cname;
            if(curfeld == "catcolortext") {
                document.all("cexampfont").color = cname;
            }
            if(curfeld == "catcolorbg") {
                document.all("cexampcell").bgColor = cname;
            }
        }
    }

    function cfld_onfocus(cfield) {
        curfeld = cfield;
	}

    function cfld_onfocusout(nfield) {
	}


function catform_onsubmit() {
    if(catform.nosave.value == "1") {
        return true;
    } else {

	    catform.catname.value = trim(catform.catname.value);
        if(catform.catname.value == "") {
            alert("The name must not be blank!");
            return false;
        }
    }
}

function donecat_onclick() {
    catform.nosave.value = "1";
}

function catlist_onchange() {
	var curcatval = catform.catlist.options(catform.catlist.selectedIndex).value;
	var curcat = curcatval.split("|");
	catform.catname.value = curcat[3];
	catform.catcolortext.value = curcat[4];
	catform.catcolorbg.value = curcat[5];
    document.all("cexampfont").color = curcat[4];
    document.all("cexampcell").bgColor = curcat[5];
	for(i=0;i<catform.catcal.length;i++) {
		if(catform.catcal.options(i).value == curcat[1]) {
			catform.catcal.selectedIndex = i;
		}
	}
}

function newcat_onclick() {
	catform.catlist.selectedIndex = -1;
	catform.catcal.selectedIndex = -1;
	catform.catname.value = "";
	catform.catcolortext.value = "";
	catform.catcolorbg.value = "";
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

<body <?php print $GLOBALS["calbodystyle"]; ?>>

<form id="catform" name="catform" method="<?php print $GLOBALS["postorget"]; ?>" action="<?php print $GLOBALS["idxfile"]; ?>" LANGUAGE=javascript onsubmit="return catform_onsubmit()">
<INPUT type="hidden" id="nosave" name="nosave" value="0">
<h1>Categories</h1>
  <table border="1" width="50%">
    <tr>
      <td width="20%" valign="top" align="middle">
      <select tabindex="1" size="10" id="catlist" name="catlist" style="WIDTH: 140px" LANGUAGE=javascript onchange="return catlist_onchange()">
<?php
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_cat where uid = '".$cuser->gsv("cuid")."'";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Category Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        #mqfix($row,1);
		print "        <option ";
        print "value = \"".$row["catid"]."|".$row["calid"]."|".($row["calname"])."|".$row["catname"]."|".$row["catcolortext"]."|".$row["catcolorbg"]."\">".$row["catname"]."</option>\n";
     }
     mysql_free_result($query1);

?>
      </select>
      </td>
      <td width="30%" valign="top">
      Name:<BR>
      <INPUT tabindex="2" id="catname" name="catname">
      <BR>Text Color:<BR>
      <INPUT tabindex="3" id="catcolortext" name="catcolortext" LANGUAGE=javascript onfocus="return cfld_onfocus('catcolortext')" onfocusout="return cfld_onfocusout('catcolortext')">
      <BR>Background Color:<BR>
      <INPUT tabindex="4" id="catcolorbg" name="catcolorbg" LANGUAGE=javascript onfocus="return cfld_onfocus('catcolorbg')" onfocusout="return cfld_onfocusout('catcolorbg')">
      <BR>Availability:<BR>
      <SELECT tabindex="6" id="catcal" style="WIDTH: 154px" name="catcal">
      <option value="0">All of my Calendars</option>
      <option value="-2">All Users</option>
<?php
    $sqlstr = "select calid, calname from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$cuser->gsv("cuid");
    $query1 = mysql_query($sqlstr) or die("Cannot query Calendar ini Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        #mqfix($row,1);

		print "        <option ";
        print "value = \"".$row["calid"]."\">".($row["calname"])."</option>\n";
     }
     mysql_free_result($query1);

?>
      </SELECT>
      </td>
      <td width="50%" valign="top">

<?php

                print "\n<span id=\"esp\" style=\"width: 100%; height: 170;overflow: auto\">\n";

                print "<table border=\"1\" width=\"100%\">";
                $csqlstr = "SELECT  * FROM ".$GLOBALS["tabpre"]."_color_table group by nicename,rgbplus order by cnum,rgbplus";
                $cquery = mysql_query($csqlstr) or die("Cannot query color Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$csqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                while($crow=mysql_fetch_array($cquery)) {
                    $crow = gmqfix($crow,1);
		        #mqfix($crow,1);

                    print"<tr>\n";
                    print"<td style=\"cursor: hand;\" width=\"10%\" LANGUAGE=javascript ondblclick=\"return setcolor_ondblclick('".$crow["cname"]."')\">".$crow["cname"]."</td>\n";
                    print"<td style=\"cursor: hand;\" id=\"".$crow["id"]."\" bgcolor=\"".$crow["cname"]."\"  LANGUAGE=javascript ondblclick=\"return setcolor_ondblclick('".$crow["cname"]."')\">&nbsp;</td>\n";
                    print"</tr>\n";
                }
                print "</table></span></td>";


?>

      </td>
    </tr>
  </table>
  To use the Color Picker, click in one of the color fields, then double click the color or color name you want.
  <br><br>

<TABLE cellSpacing=1 cellPadding=1 width="25%" border=1>

  <TR>
    <TD id="cexampcell">
    <font id="cexampfont" color="<?php print $curcalcfg["gcscoif_btxtcolor"]; ?>">This box will show you an example<br>of the colors you choose.</font>
    </TD>
  <TR>

<table border="1" width="50%">
  <tr>
    <td width="12%" align="center">
    <INPUT type="button" tabindex="7" value="New" id="newcat" name="newcat" LANGUAGE=javascript onclick="return newcat_onclick()">
    </td>
    <td width="13%" align="center">
    <INPUT type="submit" tabindex="8" value="Save" id="savecat" name="savecat">
    </td>
    <td width="13%" align="center">
    <INPUT type="submit" tabindex="9" value="Delete" id="deletecat" name="deletecat">
    </td>
    <td width="12%" align="center">
    <INPUT type="submit" tabindex="10" value="Done" id="catdone" name="catdone" LANGUAGE=javascript onclick="return donecat_onclick()">
    </td>
  </tr>
</table>

</form>

<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
exit();
}

function editcons($cuser) {
    global $timear,$timeara,$curcalcfg,$monthtext,$monthtextl,$langcfg,$conbem,$conbemady;

	if($cuser->gsv("servertz") != 0) {
		$xdservertz = $cuser->gsv("servertz") / 60 / 60;
	} else {
		$xdservertz = 0;
	}
        
        
        $xdusertz = $cuser->gsv("usertz");
        
	if($cuser->gsv("caltzadj") != 0) {
		$xdadjtz = $cuser->gsv("caltzadj") / 60 / 60;
	} else {
		$xdadjtz = 0;
	}

        if($xdservertz > 0) {
            $xdservertz = "+".$xdservertz;
        }

        if($xdadjtz > 0) {
            $xdadjtz = "+".$xdadjtz;
        }


    include($GLOBALS["CLPath"]."/include/conedit.php");

    print "<br><br>";
    include($GLOBALS["CLPath"]."/include/footer.php");
    exit();

}
?>
