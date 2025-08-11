<?php
function yearview($sdate) {
    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl;
    global $user,$fsize;
    global $langcfg,$curcalcfg,$evbgcol;
    global $cevent,$cellarr,$cellcount;

//$smonth,$sday,$syear
     set_time_limit(60);
//    ob_start();
    $startyear=substr($sdate,0,4);
    $startmonth="01";
    $startday="01";
//    $startmonth=substr($sdate,4,2);
//    $startday=substr($sdate,6,2);


    $syear=substr($sdate,0,4);
    $smonth="01";
    $sday="01";
//    $smonth=substr($sdate,4,2);
//    $sday=substr($sdate,6,2);

//print "Begin View Table\n\n\n";

    print "<TABLE BORDER=\"0\" ALIGN=\"Center\"CELLSPACING=\"4\" CELLPADDING=\"4\" WIDTH=\"98%\">\n";


    for ( $hcr = 1; $hcr <= 4; $hcr++ ) {
//        flush();

        print "<TR>\n";

        for ( $hcc = 1; $hcc <= 3; $hcc++ ) {
//            flush();

            $suts = mktime(0,0,0,$smonth,1,$syear);
            $xdta = getdate ($suts);
            $xdtm = $monthtextl[$xdta["mon"]];

            $lyear = strftime("%Y",$suts);
            $lmonth = strftime("%m",$suts);
            $lday = "01";

            print "<TD VALIGN=\"top\" align=\"center\">\n";

            print "<TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
            print "<TR>\n";
            print "<TD class=\"yvdivider\">\n";

            print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"2\">\n";
            print "<TR>\n";

            print "<TD COLSPAN=7 ALIGN=\"center\" class=\"yvmcell\">\n";
            if(!$GLOBALS["printfriend"]) {
                print "<A HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$lyear.$lmonth."01&viewtype=Month&monthsel=".$lyear.$lmonth."01";
                if($GLOBALS["adsid"] == true) {
                    print "&".SID;
                }
                print "\" CLASS=\"yvmlink\">";
            }else {
                print "<font CLASS=\"yvmlink\">";
            }
            print "$xdtm";
            if(!$GLOBALS["printfriend"]) {
                print "</A>\n";
            } else {
                print "</font>\n";
            }
            print "</TD>\n";
            print "</TR>\n";

            //header
            print "<TR>\n";

            $startmonth=$smonth;
            $startday=$sday;
            $startyear=$syear;

            $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

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

            $date_time_array = getdate (time() + $user->gsv("caltzadj"));
            $todayday = $date_time_array[ "mday"];
            $todaymonth = $date_time_array[ "mon"];
            $todayyear = $date_time_array[ "year"];

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
                    print "class=\"yvhwdcell\"><FONT class=\"yvhwd\" >$daytext[$ch]</FONT></TD>\n";
                } else {
                    print "class=\"yvhwecell\"><FONT class=\"yvhwe\">$daytext[$ch]</FONT></TD>\n";
                }
            }

            print "</TR>\n";

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

    //function checkforevents($eday, $emonth, $eyear,$ehour,$emin,$eview) {

                    if ($startmonth == $cellarr[$cellcount][1]) {

                        if($GLOBALS["seiyv"] == true) {
                            $cevent = checkforevents($cellarr[$cellcount][2], $cellarr[$cellcount][1], $cellarr[$cellcount][0],0,0,"Year");

                            $smcpop = getmcpop();
                            if($cevent[0][0] > 0) {
                                $cevent = true;
                            } else {
                                $cevent = false;
                            }

                        } else {
                            $cevent=false;
                        }

                    } else {
                            $cevent=false;
                    }
                    print "<TD VALIGN=\"middle\" ALIGN=\"center\" width=\"25\" height=\"25\" ";
                    if ($startmonth == $cellarr[$cellcount][1]) {
                        if ($todayday == $cellarr[$cellcount][2] && $todaymonth == $cellarr[$cellcount][1] && $todayyear == $cellarr[$cellcount][0]) {
                            print "class=\"yvcdcell\">";
                            if(!$GLOBALS["printfriend"]) {
                                print "<A ".$smcpop." class=\"yvcdlink\"  HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day";
                                if($GLOBALS["adsid"] == true) {
                                    print "&".SID;
                                }
                                print "\">";
                            } else {
                                print "<font class=\"yvcdlink\">";
                            }
                            print $cellarr[$cellcount][2];
                            if(!$GLOBALS["printfriend"]) {
                                print "</A>";
                            } else {
                                print "</font>";
                            }
                            print "</TD>\n";

                        } else {
                            if (($weekstartonmonday==1 && $cc < 6) || ($weekstartonmonday==0 && $cc > 1 && $cc < 7)) {
                                if($cevent == true) {
                                    print " bgColor=\"$evbgcol\" >";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "<A ".$smcpop." style=\"background-color: $evbgcol; color: ".$curcalcfg["yvwdcolor"]."; text-decoration: ".$curcalcfg["yvwdstyle"]."; cursor: hand; font-size: 9pt;\" ";
                                        print "HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day";
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "\">";
                                    } else {
                                        print "<font style=\"background-color: $evbgcol; color: ".$curcalcfg["yvwdcolor"]."; text-decoration: ".$curcalcfg["yvwdstyle"]."; font-size: 9pt;\">";
                                    }

                                } else {
                                    print "class=\"yvwdcell\">";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "<A ".$smcpop." class=\"yvwdlink\" ";
                                        print "HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day";
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "\">";
                                    } else {
                                        print "<font class=\"yvwdlink\">";
                                    }
                                }
                                print $cellarr[$cellcount][2];
                                if(!$GLOBALS["printfriend"]) {
                                    print "</A>";
                                } else {
                                    print "</font>";
                                }
                                print "</TD>\n";
                            } else {
                                if($cevent == true) {
                                    print " bgColor=\"$evbgcol\" >";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "<A ".$smcpop." style=\"background-color: $evbgcol; color: ".$curcalcfg["yvwecolor"]."; text-decoration: ".$curcalcfg["yvwestyle"]."; cursor: hand; font-size: 9pt;\" ";
                                        print "HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day";
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "\">";
                                    } else {
                                        print "<font style=\"background-color: $evbgcol; color: ".$curcalcfg["yvwecolor"]."; text-decoration: ".$curcalcfg["yvwestyle"]."; font-size: 9pt;\">";
                                    }
                                } else {
                                    print "class=\"yvwecell\">";
                                    if(!$GLOBALS["printfriend"]) {
                                        print "<A ".$smcpop." class=\"yvwelink\" ";
                                        print "HREF=\"".$GLOBALS["idxfile"]."?viewdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2]."&viewtype=Day";
                                        if($GLOBALS["adsid"] == true) {
                                            print "&".SID;
                                        }
                                        print "\">";
                                    } else {
                                        print "<font class=\"yvwelink\">";
                                    }
                                }
                                print $cellarr[$cellcount][2];
                                if(!$GLOBALS["printfriend"]) {
                                    print "</A>";
                                } else {
                                    print "</font>";
                                }
                                print "</TD>\n";
                            }
                        }

                    } else {

                        if(($cellarr[$cellcount][2]==1) || ($cellcount==($firstweekdaynum-1))) {

                            $xuts = mktime(0,0,0,$cellarr[$cellcount][1],$cellarr[$cellcount][2],$cellarr[$cellcount][0]);

                            $xdta = getdate ($xuts);
                            $xdtm = $xdta[ "month"];
                            print "class=\"yvnccell\">&nbsp;</TD>\n";
                        } else {
                            print "class=\"yvnccell\">&nbsp;</TD>\n";
                        }
                    }
                    $cellcount++;
                }

                print "</TR>\n";
            }

            print "</TABLE>\n";
//            flush();
//            usleep(25);

    //        yearviewmonth($startmonth,$startday,$startyear);

            $smonth++;

            print "</TR></TD></TABLE>\n";
//            flush();
//            usleep(25);

        }
        print "</td></TR>\n";
    }

    print "</TABLE>\n";
//    ob_end_flush();
}

?>
