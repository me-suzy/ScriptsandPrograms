<?php

function monthview($sdate) {
    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl;
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
    print "<TR><TD CLASS=\"mvdivider\">\n";
    print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n";
    print "<TR>\n";


    $startyear=substr($sdate,0,4);
    $startmonth=substr($sdate,4,2);
    $startday=substr($sdate,6,2);

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
        print "<TH id=\"mvhid".$ch."\" WIDTH=\"14%\" ";
            if (($weekstartonmonday==1 && $ch < 6) || ($weekstartonmonday==0 && $ch > 1 && $ch < 7)) {
            print "class=\"mvhwdcell\"><FONT class=\"mvhwd\" >$daytext[$ch]</FONT></TH>\n";
        } else {
            print "class=\"mvhwecell\"><FONT class=\"mvhwe\" >$daytext[$ch]</FONT></TH>\n";
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
#                $tval = dateadd($cuts,0,0,0,$acelcnt,0,0);

                $tval = dateadd("d",$acelcnt,$cuts);

                $tval2 = strftime("%Y",$tval);
                $cellarr[$cellcount][0] = $tval2;

                $tval2 = strftime("%m",$tval);
                $cellarr[$cellcount][1] = $tval2;

                $tval2 = strftime("%d",$tval);
                $cellarr[$cellcount][2] = $tval2;
                $acelcnt++;
            }

            #if ($startmonth == $cellarr[$cellcount][1]) {
                                        // day, month , year
                $cevent = checkforevents($cellarr[$cellcount][2], $cellarr[$cellcount][1], $cellarr[$cellcount][0],0,0,"Month");
            #}


//            print "<TD VALIGN=\"top\" WIDTH=\"14%\" HEIGHT=75 ";
            print "<TD VALIGN=\"top\" WIDTH=\"14%\" HEIGHT=\"75\" ";

            if ($startmonth == $cellarr[$cellcount][1]) {
                if ($todayday == $cellarr[$cellcount][2] && $todaymonth == $cellarr[$cellcount][1] && $todayyear == $cellarr[$cellcount][0]) {
                    print "class=\"mvcdcell\">";
                    $evsrc = "mvcdcell";
# today cell head
mviewcellhead($cellarr[$cellcount][2],$cellarr[$cellcount][2],$cellarr[$cellcount][1],$cellarr[$cellcount][0],1,$cellcount,$sdate);


                } else {

                    if (($weekstartonmonday==1 && $cc < 6) || ($weekstartonmonday==0 && $cc > 1 && $cc < 7)) {
                        print "class=\"mvwdcell\">";
                        $evsrc = "mvwdcell";
# week day cell head
mviewcellhead($cellarr[$cellcount][2],$cellarr[$cellcount][2],$cellarr[$cellcount][1],$cellarr[$cellcount][0],2,$cellcount,$sdate);

                    } else {
                        print "class=\"mvwecell\">";
                        $evsrc = "mvwecell";
# week end cell head
mviewcellhead($cellarr[$cellcount][2],$cellarr[$cellcount][2],$cellarr[$cellcount][1],$cellarr[$cellcount][0],3,$cellcount,$sdate);

                    }
                }

            } else {

                if(($cellarr[$cellcount][2]==1) || ($cellcount==($firstweekdaynum-1))) {

                    $xuts = mktime(0,0,0,$cellarr[$cellcount][1],$cellarr[$cellcount][2],$cellarr[$cellcount][0]);

                    $xdta = getdate ($xuts);
                    $xdtm = $monthtextl[$xdta["mon"]];
                    print "class=\"mvnccell\">";
                    $evsrc = "mvnccell";
                    if($curcalcfg["gcscoyn_showomd"]==true) {
# out of month cell day 1
mviewcellhead("$xdtm&nbsp;".$cellarr[$cellcount][2], $cellarr[$cellcount][2], $cellarr[$cellcount][1], $cellarr[$cellcount][0], 4, $cellcount,$sdate);

                    } else {
//changes for sean
                        print "&nbsp;";

                    }
//changes for sean

                } else {
                    print "class=\"mvnccell\">";
                    $evsrc = "mvnccell";
                    if($curcalcfg["gcscoyn_showomd"]==true) {

# out of month cell head other days
mviewcellhead($cellarr[$cellcount][2], $cellarr[$cellcount][2], $cellarr[$cellcount][1], $cellarr[$cellcount][0],5,$cellcount,$sdate);
//changes for sean
                    } else {
                        print "&nbsp;";
                    }
//changes for sean

                }
            }

// events go here
// day, month, year, hour, minute

            if ($startmonth == $cellarr[$cellcount][1] || $curcalcfg["gcscoyn_showomd"]==true) {

                                        // day, month , year
                #$cevent = checkforevents($cellarr[$cellcount][2], $cellarr[$cellcount][1], $cellarr[$cellcount][0],0,0,"Month");

                if($cevent[0][0] > 0) {

//changes for sean
                if($curcalcfg["gcscoyn_withesb"] == true && !$GLOBALS["printfriend"]) {
                    print "\n<span id=\"esp\" style=\"width: 100%; height: 75; overflow: auto\">\n";
                }
//changes for sean
                    print "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"1\">\n";
                    for($ec=1;$ec<=$cevent[0][0];$ec++) {
                        print "<TR>";

# output event status column
#if(($checkdisp == true && ($curcalcfg["deidate"] == 1 || $curcalcfg["deirem"] == 1 || $curcalcfg["deirep"] == 1)) || ($checkdisp == false) || ($cevent[$ec]["conflict"]==1)) {
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
                                    $tstathtml .= "<TABLE BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"1\" CELLPADDING=\"0\" CLASS=\"mvdivider\">\n";
                                    $tstathtml .= "<TR><td><TABLE ".$evsrcx." BORDER=\"0\" WIDTH=\"100%\" CELLSPACING=\"0\" CELLPADDING=\"0\" ><tr>\n";
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
                                print $tstathtml;
                            }
#}

                        print "<td valign=\"top\" bgcolor=\"".$cevent[$ec]["catcolorbg"]."\" width=\"98%\">";
                        if(($checkdisp == true && $curcalcfg["deiuser"] == 1) || ($checkdisp == false)) {
                            if($cevent[$ec]["uname"]!=$user->gsv("uname") && strlen($cevent[$ec]["uname"])>0) {
                                if(!$GLOBALS["printfriend"]) {

                                    print "<a style=\"text-decoration: none;
                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" href=\"mailto: ".$cevent[$ec]["email"]."\" target=\"_blank\" ";
                                    #onmouseover=\"return overlib('Click user name to send this user an Email', FGCOLOR, '#FEF3E0', CAPTION, 'Send Email',BGCOLOR,'#FF6633');\" onmouseout=\"nd();\">
                                    print makeolcreator();
                                    print " <font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font></a><br>";
                                } else {
                                    print "<font color=\"".$cevent[$ec]["catcolortext"]."\" style=\"FONT-SIZE: 9pt; \">By: ".$cevent[$ec]["uname"]."</font><br>";
                                }
                            }
                        }
$subtt="";
$popdesc = "";

if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
    #$popdesc = getdespop($cevent[$ec]["description"]);
    $popdesc = makeolevent($cevent[$ec]["description"]);
} else {
    $popdesc = "";
}


#                        if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                            if($cevent[$ec]["isallday"]=="1") {

                                if(!$GLOBALS["printfriend"]) {

#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                    print "<div ";
                                    print $popdesc;
                                    #onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\"
                                    print " style=\"text-decoration: none; cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" LANGUAGE=javascript onclick=\"return eventclick('".$GLOBALS["idxfile"].
                                    "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2];
                                    if($GLOBALS["adsid"] == true) {
                                        print "&".SID;
                                    }
                                    print "')\">";
#}
                                } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                    print "<div title=\"".htmlentities($cevent[$ec]["description"],ENT_QUOTES)."\">";
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
                                "</font>";
                                if(!$GLOBALS["printfriend"]) {
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                    print "</div>";
#}
                                } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                    print "</div>";
}
                                }
                                print "<hr noshade color=\"black\" size=\"1\" >";
                                print "</td>";
                            } else {
                                if(!$GLOBALS["printfriend"]) {

#$popdesc = getdespop($cevent[$ec]["description"]);
#if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                    print "<div ";
                                    print $popdesc;
                                    #onmouseover=\"return overlib('".$popdesc."', CAPTION, 'Event Description');\" onmouseout=\"nd();\"
                                    print " style=\"text-decoration: none;
                                    cursor: hand; color: ".$cevent[$ec]["catcolortext"]."\" LANGUAGE=javascript onclick=\"return eventclick('".$GLOBALS["idxfile"].
                                    "?func=showevent&evid=".$cevent[$ec]["id"]."&evdate=".$cellarr[$cellcount][0].$cellarr[$cellcount][1].$cellarr[$cellcount][2];
                                    if($GLOBALS["adsid"] == true) {
                                        print "&".SID;
                                    }
                                    print "')\">";
#}
                                } else {
if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                                    print "<div title=\"".htmlentities($cevent[$ec]["description"],ENT_QUOTES)."\">";
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
#                        }
                        print "</tr>\n";
                    }
                    print "</table>\n";
//changes for sean
                    if($curcalcfg["gcscoyn_withesb"] == true && !$GLOBALS["printfriend"]) {
                        print "</span>\n";
                    }
//changes for sean
                }
            }

            print "</TD>\n";

            $cellcount++;
        }

        print "</TR>\n";
    }
    print "</TABLE></TD></TR></TABLE>\n";
}


function mviewcellhead($dstr,$cday,$cmonth,$cyear,$ctyp,$ccnt,$sdate) {
    global $dispwnum,$curcalcfg,$fsize;
    global $langcfg,$user,$cevent;


    if($curcalcfg["weektype"]=="1") {
        $wnum = ISOWeek($cyear, $cmonth, $cday);
    #    echo "WT: 1";
    } else {
        $wnum = strftime("%W",mktime(0,0,0,$cmonth,$cday,$cyear));
    #    echo "WT: 0";
    }

    $bon="";
    $bof="";
    if ($ctyp==1) {
        $fclas = "calcdtext";
        $aclas = "mvcdlink";
    } else if ($ctyp==2) {
        $fclas = "calwdtext";
        $aclas = "mvwdlink";
    } else if ($ctyp==3) {
        $fclas = "calwetext";
        $aclas = "mvwelink";
    } else if ($ctyp==4) {
        $fclas = "caloomtext";
        $aclas = "mvnclink";
        $bon="<B>";
        $bof="</B>";
    } else {
        $fclas = "caloomtext";
        $aclas = "mvnclink";
    }



if($ctyp < 4 || $curcalcfg["gcscoyn_showomd"]==true) {

    $popevent = getmcpop(0);

} else {

    $popevent = "";

}
/*
    $checkdisp = false;
    if($user->gsv("isadmin")!="1") {
#        if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
        if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
            $checkdisp = true;
        }
    }


#$eventstoday = "Event Count: ".$cevent[0][0]."<br>";
$eventstoday = "";

if($ctyp < 4 || $curcalcfg["gcscoyn_showomd"]==true) {

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
                $eventstoday .= $cevent[$pec]["title"].$subtt;
            }

            if($pec != $cevent[0][0]) {
                $eventstoday .= "<hr noshade color=\"black\" size=\"1\" width=\"95%\">";
            }
        }
    } else {
        $eventstoday = "None";
    }

    $tevpop = getdespop($eventstoday);
    $popevent = " onmouseover=\"return overlib('".$tevpop."', FGCOLOR, '#99ff99',CAPTION,'Events for ".$cday.".".$cmonth.".".$cyear."<br>(click for day view)',BGCOLOR,'#009933');\" onmouseout=\"nd();\" ";

} else {

    $popevent = "";

}

*/

    print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"95%\">";
    print "<tr>";
    print "<td width=\"10%\" nowrap>";
    if(!$GLOBALS["printfriend"]) {
        print "<A ".$popevent." class=\"$aclas\" HREF=\"".$GLOBALS["idxfile"]."?viewdate=$cyear$cmonth$cday&viewtype=Day";
        if($GLOBALS["adsid"] == true) {
            print "&".SID;
        }
        print "\">$bon$dstr$bof</A>";
    } else {
        print "<font class=\"$aclas\">$bon$dstr$bof</font>";
    }
    print "</td>";
    print "<td width=\"40%\" nowrap align=\"center\">";
    if ($dispwnum == 1 && ( $ccnt==1 || $ccnt==8 || $ccnt==15 || $ccnt==22 || $ccnt==29 || $ccnt==36 ) ) {
        if(!$GLOBALS["printfriend"]) {
            print "<A class=\"mvkwlink\" HREF=\"".$GLOBALS["idxfile"]."?viewdate=$cyear$cmonth$cday&viewtype=Week&weeksel=$cyear$cmonth$cday";
            if($GLOBALS["adsid"] == true) {
                print "&".SID;
            }
            print "\">(".$langcfg["wnl"]." $wnum)</A>";
        } else {
            print "<font class=\"mvkwlink\">(".$langcfg["wnl"]." $wnum)</font>";
        }
    } else {
        print "<font class=\"mvkwlink\">&nbsp;</font>";
    }
    print "</td>";
    print "<td width=\"45%\" nowrap align=\"right\">";
    if(!$GLOBALS["printfriend"]) {
        if($user->gsv("canpost")==1 || $GLOBALS["demomode"]==true) {
            print "<a href=\"".$GLOBALS["idxfile"]."?viewdate=$sdate&viewtype=Month&func=Newevent&funcdate=$cyear$cmonth$cday&functime=".$curcalcfg["daybeginhour"];
            if($GLOBALS["adsid"] == true) {
                print "&".SID;
            }
            print "\" class=\"newlink\">";
            print "<img border=\"0\" src=\"./img/new.jpg\" alt=\"".$langcfg["butnew"]."&nbsp;".$langcfg["event"]."\"></a>";
        }
    }

    print "</td>";
//    <a href=\"".$GLOBALS["idxfile"]."?viewdate=$cyear$cmonth$cday&viewtype=New\" class=\"newlink\">
    print "</tr>";
    print "</table>";

}

/*
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
*/

?>
