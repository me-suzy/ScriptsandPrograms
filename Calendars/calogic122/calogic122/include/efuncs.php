<?php
/***************************************************************
**  this section brings up the new event form
***************************************************************/

    if(isset($func)) {
        if($func=="Newevent") {
            neweventform($user,$viewdate,$viewtype,$func,$funcdate,$functime);
        }
    }

/***************************************************************
**  this saves a new event
***************************************************************/

    if(isset($savingevent) && $savingevent=="1") {
/***************************************************************
**  this is used for debugging
***************************************************************/

#            foreach($nef as $k1 => $v1) {
#                print $k1." = ".$nef[$k1]."<br>";
#                if($k1 == "srcons") {
#                    $xsrcons = explode("|",$nef[$k1]);
#                    foreach($xsrcons as $x1 => $y1) {
#                        print $x1." = ".$xsrcons[$x1]."<br>";
#                    }
#                }
#            }
/*
        if(!isset($nef["eventrepeat"])) {


        } else {

            if($nef["estype"] == "1") {
                print "daily";
            } elseif($nef["estype"] == "2") {
                print "weekly";

            } elseif($nef["estype"] == "3") {
                print "monthly";

            } elseif($nef["estype"] == "4") {
                print "yearly";

            }
        }
*/
/***************************************************************
**  this delets an event that is being changed
***************************************************************/
        $xmaxdate="";

        $nef = gmqfix($nef);
        $nefoas = $nef;

# changes for 1.1.10

        $deleventokay = 0;
        $eventowner = "";
        $saveeventokay = 1;

        if(isset($edevid)) {

            if($user->gsv("isadmin")==1) {
                $deleventokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$edevid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $deleventokay = 1;
                } else {
                    $saveeventokay = 0;
                }

                @mysql_free_result($query1);
            }



            if($edevoc == 1) {

# this routine saves an edited event occurance (an occurance of a series event)
# it does this by first making an exception for the date of the occurance
# and then creating a totally new event with the changes to the original event.

                if($deleventokay == 1) {

                    $sqlstr = "select count(*) from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$edevid.")";
                    $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $evrow = mysql_fetch_array($query1);
                    $evrow = gmqfix($evrow,1);
                    @mysql_free_result($query1);
                    $exyear=$evsoyear;
                    $exmonth=$evsomonth;
                    $exday=$evsoday;

                    if($GLOBALS["sadmmail"]==1) {
                        $siteowner=$GLOBALS["siteowner"];
                        $adminemail=$GLOBALS["adminemail"];
                        if($GLOBALS["uniem"] == 1) {
                            $toadr="CaLogic Administrator <$adminemail>";
                            $fromadr="CaLogic web site <$adminemail>";
                        } else {
                            $toadr="$adminemail";
                            $fromadr="$adminemail";
                        }
                        $emsub = "System email - CaLogic Series Event Occurance Deletion";
                        $embody="<HTML><BODY>A Series Event Occurance has been deleted.<br><br>
                        Deleted occurance (y-m-d): ".$exyear."-".$exmonth."-".$exday."<br><br>".geteventhtml($edevid)."<br><br>Event occurance was deleted by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email")."</body></html>";
                        $emtext=" Series Event Occurance has has been deleted.\n\nDeleted occurance (y-m-d):
                        ".$exyear."-".$exmonth."-".$exday."\n\n".geteventtext($edevid)."\n\nEvent occurance was deleted by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email");
                        sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                    }

                    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_cal_event_exceptions (evid,calid,exday,exmonth,exyear) values('".$edevid."','".$user->gsv("curcalid")."','".$exday."','".$exmonth."','".$exyear."')";
                    mysql_query($sqlstr) or die("Cannot insert into Event Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $evid = $edevid;
                    unset($edevid);
                }
            }
        }
# changes for 1.1.10


        if(isset($edevid)) {

            if($deleventokay == 1) {

                if($GLOBALS["sadmmail"]==1) {
                    $siteowner=$GLOBALS["siteowner"];
                    $adminemail=$GLOBALS["adminemail"];
                    if($GLOBALS["uniem"] == 1) {
                        $toadr="CaLogic Administrator <$adminemail>";
                        $fromadr="CaLogic web site <$adminemail>";
                    } else {
                        $toadr="$adminemail";
                        $fromadr="$adminemail";
                    }

                    $emsub = "System email - CaLogic Event Change";
                    $embody="<HTML><BODY>An Event has been Changed.<br><br>Event before the change:<br><br>".geteventhtml($edevid);
                    $emtext="An Event has been changed.\n\nEvent before the change:\n\n".geteventtext($edevid);
    #                sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                }

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_events where evid = ".$edevid." and calid='".$user->gsv("curcalid")."'";
                $query1 = mysql_query($sqlstr) or die("Cannot update calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where evid = ".$edevid." and calid='".$user->gsv("curcalid")."'";
                $query1 = mysql_query($sqlstr) or die("Cannot update event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    #            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_rem_log where evid = ".$edevid." and calid='".$user->gsv("curcalid")."'";
    #            $query1 = mysql_query($sqlstr) or die("Cannot update event reminder log table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_extents where evid = ".$edevid;
                $query1 = mysql_query($sqlstr) or die("Cannot update Extents table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
        }


# save event

        if($saveeventokay == 1) {

            #$htmltrans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
            #$transhtml = array_flip($htmltrans);


            #$nef["desc"] = stophack($nef["desc"]);
            #$nef["eventtitle"] = stophack($nef["eventtitle"]);
            #$nef["eventsubtitle"] = stophack($nef["eventsubtitle"]);

            stophack($nef);

            $nef = gmqfmt($nef);

            $sqlstr1 = "insert into ".$GLOBALS["tabpre"]."_cal_events (";
            $sqlstr2 = " values(";
            if(isset($edevid)) {
                $sqlstr1 .= "evid,";
                $sqlstr2 .= $edevid.",";
            }
            $sqlstr1 .= "uid,calid,title,subtitle,description,catid,startday,startmonth,startyear,isallday,starthour,startmin,endhour,";
            $sqlstr1 .= "endmin,sendreminder,remsuballow,remsublevel,extfields,iseventseries ";
            $sqlstr2 .= $user->gsv("cuid").",'".$user->gsv("curcalid")."','".($nef["eventtitle"])."','".($nef["eventsubtitle"])."','";
            #$sqlstr2 .= strtr($nef["desc"],$transhtml)."',".$nef["cat"].",'".$nef["eventday"]."','".$nef["eventmonth"]."','".$nef["eventyear"]."'";
            $sqlstr2 .= $nef["desc"]."',".$nef["cat"].",'".$nef["eventday"]."','".$nef["eventmonth"]."','".$nef["eventyear"]."'";

            if($nef["alldayevent"]=="0") {
                $sqlstr2 .= ",0,'".$nef["eventstarttimehour"]."','".$nef["eventstarttimemin"]."','".$nef["eventendtimehour"]."','".$nef["eventendtimemin"]."'";
            } else {
                $sqlstr2 .= ",1,'00','00','00','00'";
            }
            if(isset($nef["sendreminder"])) {
                $sqlstr2 .= ",1";
                #.$nef["srint"].",".$nef["srval"];
            } else {
                $sqlstr2 .= ",0";
                #0,0";
            }

            if(isset($nef["remsuballow"])) {
                $sqlstr2 .= ",1,".$nef["remsublevel"];
            } else {
                $sqlstr2 .= ",0,0";
            }
            if(isset($nef["extendedfields"])) {
                $sqlstr2 .= ",1";
            } else {
                $sqlstr2 .= ",0";
            }

            if(!isset($nef["eventrepeat"])) {
    // this is the easy part, no repeat
    // calculate the end date and mysql days
    /*
                $sqlstrx = "select to_days('".$nef["eventyear"]."-".$nef["eventmonth"]."-".$nef["eventday"]."') as evdays";
                $queryx = mysql_query($sqlstrx) or die("Cannot connect to database<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
                $rowx = mysql_fetch_array($queryx);
                $evdays = $rowx["evdays"];
                mysql_free_result($queryx);
    */
                $sqlstr1 .= ",endafterdate,endafterdays) ";
                $sqlstr2 .= ",0,'".$nef["eventyear"]."-".$nef["eventmonth"]."-".$nef["eventday"]."',to_days('".$nef["eventyear"]."-".$nef["eventmonth"]."-".$nef["eventday"]."'))";
                $xmaxdate = mktime(0,0,0,$nef["eventmonth"],$nef["eventday"],$nef["eventyear"]);
            } else {
    // now begins the really hard (fun) stuff.
                $sqlstr1 .= ",estype";
                $sqlstr2 .= ",1,".$nef["estype"];
                if($nef["estype"] == "1") {
    // daily
                    $sqlstr1 .= ",estd";
                    $sqlstr2 .= ",".$nef["daytype"];
                    if($nef["daytype"]=="1") {
                        $sqlstr1 .= ",estdint";
                        $sqlstr2 .= ",".$nef["eachdaycount"];
                    }

                } elseif($nef["estype"] == "2") {
    // weekly
                    $sqlstr1 .= ",estwint,estwd";
                    $sqlstr2 .= ",".$nef["eachweekcount"].",'";
                    $tstr="";
                    if(isset($nef["weekday1"])) {$tstr .= "1";} else {$tstr .= "0";} //mon
                    if(isset($nef["weekday2"])) {$tstr .= "1";} else {$tstr .= "0";} //tue
                    if(isset($nef["weekday3"])) {$tstr .= "1";} else {$tstr .= "0";} //wed
                    if(isset($nef["weekday4"])) {$tstr .= "1";} else {$tstr .= "0";} //thu
                    if(isset($nef["weekday5"])) {$tstr .= "1";} else {$tstr .= "0";} //fri
                    if(isset($nef["weekday6"])) {$tstr .= "1";} else {$tstr .= "0";} //sat
                    if(isset($nef["weekday7"])) {$tstr .= "1";} else {$tstr .= "0";} //sun
                    $sqlstr2 .= $tstr ."'";


                } elseif($nef["estype"] == "3") {
    // monthly
                    $sqlstr1 .= ",estm";
                    $sqlstr2 .= ",".$nef["dayofmonth"];
                    if($nef["dayofmonth"] == "1") {
                        $sqlstr1 .= ",estm1d,estm1int";
                        $sqlstr2 .= ",'".$nef["dayofmonthday"]."',".$nef["dayofmonthcount"];
                    } else {
                        $sqlstr1 .= ",estm2dp,estm2wd,estm2int";
                        $sqlstr2 .= ",".$nef["whichdayofmonth"].",".$nef["whichdayofmonthday"].",".$nef["whichdayofmonthcount"];
                    }


                } elseif($nef["estype"] == "4") {
    // yearly
                    $sqlstr1 .= ",esty";
                    $sqlstr2 .= ",".$nef["dayofmonthyear"];
                    if($nef["dayofmonthyear"] == "1") {
                        $sqlstr1 .= ",esty1d,esty1m";
                        $sqlstr2 .= ",'".$nef["dayofmonthyearday"]."','".$nef["dayofmonthyearmonth"]."'";
                    } else {
                        $sqlstr1 .= ",esty2dp,esty2wd,esty2m";
                        $sqlstr2 .= ",".$nef["whichdayofmonthyear"].",".$nef["whichdayofmonthyearday"].",'".$nef["whichdayofmonthyearmonth"]."'";
                    }
                }


                if($nef["eventend"] == "0") {
    # event never ends

                    $xmaxdate = mktime(0,0,0,$nef["eventmonth"],$nef["eventday"],$nef["eventyear"]);

                    if($GLOBALS["rdahead"] > 0 && $GLOBALS["rdahead"] < 400) {
                        $futurecheck = $GLOBALS["rdahead"];
                    } else {
                        $futurecheck = 400;
                    }

                    $xmaxdate = dateadd("d",$futurecheck,$xmaxdate);

                    $sqlstr1 .= ")";
                    $sqlstr2 .= ")";

                } elseif($nef["eventend"] == "1") {
    // end after a certain number of occurances

    //                $sqlstr1 .= ",ese,eseaoint,endafterdate,endafterdays)";

                    $cevdate = mktime(0,0,0,$nef["eventmonth"],$nef["eventday"],$nef["eventyear"]);
                    $cevdinf = getdate($cevdate);
                    $xev = 0;

                        if($nef["estype"] == "1") {
    // daily
                            if($nef["daytype"]=="1") {
                                $xev++;
                                while($xev<$nef["eventendafter"]) {
                                    $cevdate = dateadd("d",$nef["eachdaycount"],$cevdate);
                                    $xev++;
                                }
                            } else {
                                while($cevdinf["wday"] == 0 || $cevdinf["wday"] == 6) {
                                    $cevdate = dateadd("d",1,$cevdate);
                                    $cevdinf = getdate($cevdate);
                                }
                                $xev++;
                                while($xev<$nef["eventendafter"]) {
                                    $cevdate = dateadd("d",$nef["eachdaycount"],$cevdate);
                                    $cevdinf = getdate($cevdate);
                                    if($cevdinf["wday"] > 0 && $cevdinf["wday"] < 6) {
                                        $xev++;
                                    }
                                }
                            }

                            $xmaxdate = $cevdate;

                        } elseif($nef["estype"] == "2") {
    // weekly
                            $xwcnt = $nef["eachweekcount"] * 7;

                            if(isset($nef["weekday1"])) {$xwar[1]= 1;} else {$xwar[1]= 0;} //mon
                            if(isset($nef["weekday2"])) {$xwar[2]= 1;} else {$xwar[2]= 0;} //tue
                            if(isset($nef["weekday3"])) {$xwar[3]= 1;} else {$xwar[3]= 0;} //wed
                            if(isset($nef["weekday4"])) {$xwar[4]= 1;} else {$xwar[4]= 0;} //thu
                            if(isset($nef["weekday5"])) {$xwar[5]= 1;} else {$xwar[5]= 0;} //fri
                            if(isset($nef["weekday6"])) {$xwar[6]= 1;} else {$xwar[6]= 0;} //sat
                            if(isset($nef["weekday7"])) {$xwar[0]= 1;} else {$xwar[0]= 0;} //sun

                            $tcevdate = $cevdate;

                            while($xev<$nef["eventendafter"]) {
                                for($cxva=1;$cxva<=7;$cxva++) {
                                    $xtvar = $cevdinf["wday"];
                                     if($xwar[$xtvar] == 1) {
                                        $xmaxdate = $cevdate;
                                     }
                                    $cevdate = dateadd("d",1,$cevdate);
                                    $cevdinf = getdate($cevdate);
                                }
                                $cevdate = dateadd("d",$xwcnt,$tcevdate);
                                $tcevdate = $cevdate;
                                $xev++;
                            }

                        } elseif($nef["estype"] == "3") {
    // monthly
                            if($nef["dayofmonth"] == "1") {

    // same day every month increment
    //                            $sqlstr1 .= ",estm1d,estm1int";
    //                            $sqlstr2 .= ",'".$nef["dayofmonthday"]."',".$nef["dayofmonthcount"];
                                $cevdate = mktime(0,0,0,$nef["eventmonth"],$nef["dayofmonthday"],$nef["eventyear"]);
                                $xev = 1;
                                $xwcnt = $nef["dayofmonthcount"];
                                while($xev<$nef["eventendafter"]) {
                                    $cevdate = dateadd("m",$xwcnt,$cevdate);
                                    $xev++;
                                }
                                $xmaxdate = $cevdate;

                            } else {

    // same day pos every month increment
    //                            $sqlstr1 .= ",estm2dp,estm2wd,estm2int";
    //                            $sqlstr2 .= ",".$nef["whichdayofmonth"].",".$nef["whichdayofmonthday"].",".$nef["whichdayofmonthcount"];

                                $xwcnt = $nef["whichdayofmonthcount"];
                                $ckdpos = $nef["whichdayofmonth"];

                                if($nef["whichdayofmonthday"] == 1) {
                                    $ckday = 1;
                                } elseif($nef["whichdayofmonthday"] == 2) {
                                    $ckday = 2;
                                } elseif($nef["whichdayofmonthday"] == 3) {
                                    $ckday = 3;
                                } elseif($nef["whichdayofmonthday"] == 4) {
                                    $ckday = 4;
                                } elseif($nef["whichdayofmonthday"] == 5) {
                                    $ckday = 5;
                                } elseif($nef["whichdayofmonthday"] == 6) {
                                    $ckday = 6;
                                } elseif($nef["whichdayofmonthday"] == 7) {
                                    $ckday = 0;
                                } elseif($nef["whichdayofmonthday"] == 8) {
                                    $ckday = 8;
                                } elseif($nef["whichdayofmonthday"] == 9) {
                                    $ckday = 9;
                                } elseif($nef["whichdayofmonthday"] == 10) {
                                    $ckday = 10;
                                }

                                if($ckdpos < 5) {
    // first - fourth whatever
                                    $cevdate = mktime(0,0,0,$nef["eventmonth"],1,$nef["eventyear"]);
                                    $cevdinf = getdate($cevdate);
                                    $xwdc = 0;
                                    while($xev<$nef["eventendafter"]) {
                                        if($ckday < 7) {
                                            if($cevdinf["wday"] == $ckday) {
                                                $xwdc++;
                                            }
                                        } elseif($ckday == 8) {
                                            if($cevdinf["wday"] >= 0 && $cevdinf["wday"] <= 6) {
                                                $xwdc++;
                                            }
                                        } elseif($ckday == 9) {
                                            if($cevdinf["wday"] == 0 || $cevdinf["wday"] == 6) {
                                                $xwdc++;
                                            }
                                        } elseif($ckday == 10) {
                                            $xwdc++;
                                        }
                                        if($xwdc == $ckdpos) {
                                            $xev++;
                                            $xwdc = 0;
                                            $xmaxdate = $cevdate;
                                            $cevdate = mktime(0,0,0,$cevdinf["mon"],1,$cevdinf["year"]);
                                            $cevdate = dateadd("m",$xwcnt,$cevdate);
                                            $cevdinf = getdate($cevdate);
                                        } else {
                                            $cevdate = dateadd("d",1,$cevdate);
                                            $cevdinf = getdate($cevdate);
                                        }
                                    }

                                } else {
    // last whatever
                                    $cevdate = mktime(0,0,0,$nef["eventmonth"],1,$nef["eventyear"]);
                                    $cevdate = dateadd("m",1,$cevdate);
                                    $cevdate = dateadd("d",-1,$cevdate);
                                    $cevdinf = getdate($cevdate);
                                    $xwdc = 0;
                                    $ckdpos = 1;
                                    while($xev < $nef["eventendafter"]) {
                                        if($ckday < 7) {
                                            if($cevdinf["wday"] == $ckday) {
                                                $xwdc++;
                                            }
                                        } elseif($ckday == 8) {
                                            if($cevdinf["wday"] >= 0 && $cevdinf["wday"] <= 6) {
                                                $xwdc++;
                                            }
                                        } elseif($ckday == 9) {
                                            if($cevdinf["wday"] = 0 || $cevdinf["wday"] == 6) {
                                                $xwdc++;
                                            }
                                        } elseif($ckday == 10) {
                                            $xwdc++;
                                        }
                                        if($xwdc == $ckdpos) {
                                            $xev++;
                                            $xwdc = 0;
                                            $xmaxdate = $cevdate;
                                            $cevdate = mktime(0,0,0,$cevdinf["mon"],1,$cevdinf["year"]);
                                            $cevdate = dateadd("m",2,$cevdate);
                                            $cevdate = dateadd("d",-1,$cevdate);
                                            $cevdinf = getdate($cevdate);
                                        } else {
                                            $cevdate = dateadd("d",-1,$cevdate);
                                            $cevdinf = getdate($cevdate);
                                        }
                                    }
                                }

                                $xmaxdate = $cevdate;
                            }

                        } elseif($nef["estype"] == "4") {

                            $xycnt = $nef["eventendafter"] - 1;

                            if($nef["dayofmonthyear"] == 1) {
                                $cevdate = mktime(0,0,0,$nef["dayofmonthyearmonth"],$nef["dayofmonthyearday"],$cevdinf["year"]);
                                $cevdate = dateadd("yyyy",$xycnt,$cevdate);
                                $xmaxdate = $cevdate;

                            } else {
                                $cevdate = mktime(0,0,0,$nef["whichdayofmonthyearmonth"],1,$cevdinf["year"]);
                                $cevdate = dateadd("m",1,$cevdate);
                                $cevdate = dateadd("d",-1,$cevdate);
                                $cevdate = dateadd("yyyy",$xycnt,$cevdate);
                                $xmaxdate = $cevdate;
                            }
                        }
    //                }  // end for loop event counter

                    $sqlstr1 .= ",ese,eseaoint,endafterdate,endafterdays)";

                    $xmdi = getdate($xmaxdate);
                    $sqlstr2 .= ",1,".$nef["eventendafter"].",'".$xmdi["year"]."-".$xmdi["mon"]."-".$xmdi["mday"]."',to_days('".$xmdi["year"]."-".$xmdi["mon"]."-".$xmdi["mday"]."'))";

                } else {

                    $sqlstr1 .= ",ese,esed,esem,esey";
                    $sqlstr2 .= ",2,'".$nef["eventendday"]."','".$nef["eventendmonth"]."','".$nef["eventendyear"]."'";

                    $sqlstr1 .= ",endafterdate,endafterdays)";
                    $sqlstr2 .= ",'".$nef["eventendyear"]."-".$nef["eventendmonth"]."-".$nef["eventendday"]."',to_days('".$nef["eventendyear"]."-".$nef["eventendmonth"]."-".$nef["eventendday"]."'))";

                    $xmaxdate = mktime(0,0,0,$nef["eventendmonth"],$nef["eventendday"],$nef["eventendyear"]);
                }
            }

            $xmdi = getdate($xmaxdate);
            #$xmdi["year"]."-".$xmdi["mon"]."-".$xmdi["mday"]

            $sqlstr = $sqlstr1.$sqlstr2;
            $query1 = mysql_query($sqlstr) or die("Cannot insert to calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            if(isset($edevid)) {
                $neid = $edevid;

                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = $user->gsv("curcalid");
                $logentry["evid"] = $neid;
                $logentry["adate"] = time();
                $logentry["laction"] = "Event change";
                $logentry["lbefore"] = " ";
                $logentry["lafter"] = " ";
                $logentry["remarks"] = " ";
                histlog($logentry);

            } else {

                $sqlstr = "select LAST_INSERT_ID() as neid";
                $query1 = mysql_query($sqlstr) or die("Cannot get new calendar event id<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $row = mysql_fetch_array($query1);
                $neid = $row["neid"];
                @mysql_free_result($query1);

                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = $user->gsv("curcalid");
                $logentry["evid"] = $neid;
                $logentry["adate"] = time();
                $logentry["laction"] = "New event";
                $logentry["lbefore"] = " ";
                $logentry["lafter"] = " ";
                $logentry["remarks"] = " ";
                histlog($logentry);

            }
            if($neid == 0) {
                die("New Event ID = 0, this is an error.");
            }

            $nef = $nefoas;

            if(isset($nef["sendreminder"])) {

                $conlist = explode("|",$nef["srcons"]);
                $listlen = count($conlist)/3;
                $curlpos = 0;
                for($k1=0;$k1<$listlen;$k1++) {
                    $contyp = substr($conlist[$curlpos],0,1);
                    if($contyp == "M") {
                        $conid = $user->gsv("cuid");
                    } else {
                        $conid = substr($conlist[$curlpos],1);
                    }
                    $csrval = $conlist[$curlpos+1];
                    $csrint = $conlist[$curlpos+2];
                    $curlpos = $curlpos + 3;
                    $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_event_rems (calid,uid,evid,contyp,conid,srint,srval,approved,confirmed) values('".$user->gsv("curcalid")."',".$user->gsv("cuid").",".$neid.",'".$contyp."',".$conid.",".$csrint.",".$csrval.",1,1)";
                    $query1 = mysql_query($sqlstr) or die("Cannot insert into calendar event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }
            }

            $conlistcontrol = "";
            if(isset($nef["remsuballow"])) {

                #$nef["srsubs"] = str_ireplace("<script","< script",$nef["srsubs"]);
                #$nef["srsubs"] = stophack($nef["srsubs"]);

                $conlist = explode("|",$nef["srsubs"]);
                $conlistcontrol = $conlist;
                if($conlist[0] > 0) {

                    $listlen = array_shift($conlist);
                    $curlpos = 0;

                    for($k1=0;$k1<$listlen;$k1++) {
                        if(substr($conlist[$curlpos],0,1)=="A") {

                            $contyp = "A";
                            $conid = "0";
                            $cfname = $conlist[$curlpos+1];
                            $clname = $conlist[$curlpos+2];
                            $cemail = $conlist[$curlpos+3];
                            $csrval = $conlist[$curlpos+4];
                            $csrint = $conlist[$curlpos+5];
                            $csrtz = $conlist[$curlpos+6];
                            $cemailtype = $conlist[$curlpos+7];
                            $curlpos = $curlpos + 8;

                            $key = md5(uniqid(rand(), true));
                            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_event_rems (calid,uid,evid,contyp,conid,srint,srval,fname,lname,remail,remailtype,rtzos,approved,confirmed,confirmkey) values('".$user->gsv("curcalid")."',".$user->gsv("cuid").",".$neid.",'".$contyp."',".$conid.",".$csrint.",".$csrval.",'".$cfname."','".$clname."','".$cemail."','".$cemailtype."',".$csrtz.",1,1,'".$key."')";
                            $query1 = mysql_query($sqlstr) or die("Cannot insert into calendar event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        } elseif(substr($conlist[$curlpos],0,1)=="U") {

                            $contyp = "U";
                            $conid = substr($conlist[$curlpos],1);
                            $csrval = $conlist[$curlpos+2];
                            $csrint = $conlist[$curlpos+3];
                            $curlpos = $curlpos + 4;
                            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_event_rems (calid,uid,evid,contyp,conid,srint,srval,approved,confirmed) values('".$user->gsv("curcalid")."',".$user->gsv("cuid").",".$neid.",'".$contyp."',".$conid.",".$csrint.",".$csrval.",1,1)";
                            $query1 = mysql_query($sqlstr) or die("Cannot insert into calendar event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        } else {
                            print "Invalid Subscriber type: ".$conlist[$curlpos]." (".$curlpos.")<br>";
                            #print_r($conlistcontrol);
                        }
                    }
                }
            }

            if(isset($nef["extendedfields"])) {

                foreach($extfld as $k1 => $v1) {
                    $cefid = $extfld[$k1];
                    $xsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where efid = ".$cefid;
                    $xquery = mysql_query($xsql) or die("Cannot query Extended Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $xnumrows = @mysql_num_rows($xquery);
                    if($xnumrows < 1) {
                        die("Invalid Extended Field ID<br>SQL: ".$xsql);
                    }
                    @mysql_free_result($xquery);
                    $xquery = mysql_query($xsql) or die("Cannot query Extended Fields Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $xrow = mysql_fetch_array($xquery) or die("Cannot query Extended Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $xrow = gmqfix($xrow,1);


                    if($xrow["format"] == "Select") {
                        $cefsid = fmtfordb(mqfix($extfldval[$k1]),2);
                        $cexval="";
                    } else {
                        $cefsid = "0";
                        if($xrow["format"] == "Textarea") {
                            #$cexval=strtr(((fmtfordb(mqfix($extfldval[$k1]),2))),$transhtml);
                            $cexval=fmtfordb(mqfix($extfldval[$k1]),2);
                        } else {
                            $cexval=fmtfordb(mqfix($extfldval[$k1]),2);
                        }
                    }
                    $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_extents (evid,efid,efsid,exval) values(".$neid.",".$cefid.",".$cefsid.",'".$cexval."')";
                    $query1 = mysql_query($sqlstr) or die("Cannot insert into Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }
            }
            if(isset($edevid)) {

                if($GLOBALS["sadmmail"]==1) {
    /*
                    $siteowner=$GLOBALS["siteowner"];
                    $adminemail=$GLOBALS["adminemail"];
                    if($GLOBALS["uniem"] == 1) {
                        $toadr="CaLogic Administrator <$adminemail>";
                        $fromadr="CaLogic web site <$adminemail>";
                    } else {
                        $toadr="$adminemail";
                        $fromadr="$adminemail";
                    }
                    $emsub = "System email - CaLogic Event Change";
    */
                    $embody.="<br><br>Event after the change:<br><br>".geteventhtml($edevid)."<br><br>Event was changed by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email")."</body></html>";
                    $emtext.="\n\nEvent after the change:\n\n".geteventtext($edevid)."\n\nEvent was changed by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email");
                    sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                }

            } else {

                if($GLOBALS["sadmmail"]==1) {
                    $siteowner=$GLOBALS["siteowner"];
                    $adminemail=$GLOBALS["adminemail"];
                    if($GLOBALS["uniem"] == 1) {
                        $toadr="CaLogic Administrator <$adminemail>";
                        $fromadr="CaLogic web site <$adminemail>";
                    } else {
                        $toadr="$adminemail";
                        $fromadr="$adminemail";
                    }

                    $emsub = "System email - CaLogic Event added";
                    $embody="<HTML><BODY>An Event has been added.<br><br>".geteventhtml($neid)."<br><br>Event was added by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email")."</body></html>";
                    $emtext="An Event has been added.\n\n".geteventtext($neid)."\n\nEvent was added by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email");
                    sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                }
            }

    # check for conflicting event
            if($curcalcfg["collisioncheck"] == 1) {
        #        print "Event ID: ".$neid."<br>";

        #        print "MaxDate: ".$xmaxdate."<br>";
                $collcount = 0;
                $evcollar[0][0] = -1;
        #        $evcollar[0]["evcdate"] = -1;
        #        $evcollar[0]["evcst"] = -1;
        #        $evcollar[0]["evcet"] = -1;

                $eventstartdate = mktime(0,0,0,$nef["eventmonth"],$nef["eventday"],$nef["eventyear"]);
        #        print "eventstartdate: ".$eventstartdate."<br>";
                $eventenddate = mktime(0,0,0,$xmdi["mon"],$xmdi["mday"],$xmdi["year"]);
        #        print "eventenddate: ".$eventenddate."<br>";
                $cureventdate = $eventstartdate;

                while($cureventdate <= $eventenddate) {
        #            print "<br>Current Date: ".$cureventdate."<br>Checking...<br>";
                    $evdxi = getdate($cureventdate);
                    $cevar = checkforevents($evdxi["mday"],$evdxi["mon"],$evdxi["year"],0,0,"Month",0);
        #            print "Events found for: ".$evdxi["mday"]." ".$evdxi["mon"]." ".$evdxi["year"].": ".$cevar[0][0]."<br>";
                    if($cevar[0][0] > 0) {
                        for($xcev=1;$xcev<=$cevar[0][0];$xcev++) {
        #                    print "chk ".$xcev.", Checking EVID: ".$cevar[$xcev]["id"]."<br>";
    #                        if($cevar[$xcev]["id"] != $neid) {
                            if($cevar[$xcev]["id"] == $neid) {
    #                            $evcar = checkforconflict($neid,$evdxi["mday"],$evdxi["mon"],$evdxi["year"]);
                                $evcar = checkforconflict($neid,$evdxi["mday"],$evdxi["mon"],$evdxi["year"]);
        #                        print "Event conflicts found for: ".$evdxi["mday"]." ".$evdxi["mon"]." ".$evdxi["year"].": ".$evcar[0]."<br>";
                                if($evcar[0][0] > 0) {
                                    for($xxcev=1;$xxcev<=$evcar[0][0];$xxcev++) {
        #                                print "CFLC ID ".$xxcev.": ".$evcar[$xxcev]."<br>";

                                        if($evcar[$xxcev]["evcst"] > 0) {
                                            $evcdsa = getdate($evcar[$xxcev]["evcst"]);
                                            $evcdsa = mktime($evcdsa["hours"],$evcdsa["minutes"],0,$evdxi["mon"],$evdxi["mday"],$evdxi["year"]);
                                        } else {
                                            $evcdsa = mktime(0,0,0,$evdxi["mon"],$evdxi["mday"],$evdxi["year"]);
                                        }
                                        $xvcstrid = str_pad($evcar[$xxcev]["id"], 10, "0", STR_PAD_LEFT);
        #                                print "Date 1: ".$evcdsa."<br>";
                                        $xcdbug = getdate($evcdsa);
        #                                print "rdate: ".$xcdbug["hours"]." ".$xcdbug["minutes"]." ".$xcdbug["mon"]." ".$xcdbug["mday"]." ".$xcdbug["year"]."<br>";
        #                                print "ID PAD : ".$xvcstrid."<br>";

                                        $evcdsasort = $xvcstrid.$evcdsa;

        #                                print "sort num : ".$evcdsasort."<br><br>";
                                        $evcastat = array_count_values ($evcollar["evcdatesort"]);

                                        if (!array_key_exists("$evcdsasort", $evcastat)) {

                                            $collcount++;
                                            $evcollar["id"][$collcount] = $evcar[$xxcev]["id"];
                                            $evcollar["evcdatesort"][$collcount] = $evcdsasort;
                                            $evcollar["evcdate"][$collcount] = $evcdsa;
                                            $evcollar["evcst"][$collcount] = $evcar[$xxcev]["evcst"];
                                            $evcollar["evcet"][$collcount]  = $evcar[$xxcev]["evcet"];
                                            #$csortar[$collcount] = $evcdsa;
                                            $csortar[$collcount] = $evcdsasort;

                                        }
                                    }
                                }
                            }
                        }

                    }
                    $cureventdate = dateadd("d",1,$cureventdate);
                }

                if($collcount > 0) {
        #            print "<br><br>have conflict, count: ".$collcount."<br><br>";
                    $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_events set pending = 1 where calid = '".$user->gsv("curcalid")."' and evid=".$neid." limit 1";
                    $query1 = mysql_query($sqlstr) or die("Cannot set calendar event pending<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    asort($csortar);
                    $revar[0][0] = $collcount;
                    $revcnt = 1;
                    foreach($csortar as $key => $val) {
                        $revar["id"][$revcnt] = $evcollar["id"][$key];
                        $revar["evcdatesort"][$revcnt] = $evcollar["evcdatesort"][$key];
                        $revar["evcdate"][$revcnt] = $evcollar["evcdate"][$key];
                        $revar["evcst"][$revcnt] = $evcollar["evcst"][$key];
                        $revar["evcet"][$revcnt] = $evcollar["evcet"][$key];
                        $revcnt++;
                    }

                    $evcollar = $revar;

        #            $evcolldate[0] = $collcount;

        #            showconflict($neid,$evcollid,$evcolldate);
                    showconflict($neid,$evcollar);

                }
            }

        }  # end if save event
    } # end if saveeventokay = 1


    if(isset($func)) {

        global $weekstartonmonday,$daytext,$daytextl,$monthtext,$monthtextl,$evddtl,$evddt;
        global $langcfg;

        $dptxt[1] = "First";
        $dptxt[2] = "Second";
        $dptxt[3] = "Third";
        $dptxt[4] = "Fourth";
        $dptxt[5] = "Last";

        $wdtxt[8] = "Weekday";
        $wdtxt[9] = "Weekend day";
        $wdtxt[10] = "Day";

/***************************************************************
**  this deletes an event
***************************************************************/

        if($func=="deleteevent") {

            $deleventokay = 0;
            $eventowner = "";

            if($user->gsv("isadmin")==1) {
                $deleventokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$evid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $deleventokay = 1;
                }

                @mysql_free_result($query1);
            }

            if($deleventokay == 1) {

                if($GLOBALS["sadmmail"]==1) {
                    $siteowner=$GLOBALS["siteowner"];
                    $adminemail=$GLOBALS["adminemail"];
                    if($GLOBALS["uniem"] == 1) {
                        $toadr="CaLogic Administrator <$adminemail>";
                        $fromadr="CaLogic web site <$adminemail>";
                    } else {
                        $toadr="$adminemail";
                        $fromadr="$adminemail";
                    }
                    $emsub = "System email - CaLogic Event Deletion";
                    $embody="<HTML><BODY>An Event has been deleted.<br><br>".geteventhtml($evid)."<br><br>Event was deleted by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email")."</body></html>";
                    $emtext="An Event has been deleted.\n\n".geteventtext($evid)."\n\nEvent was deleted by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email");
                    sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                }

    #            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_events where calid = '".$user->gsv("curcalid")."' and evid=".$evid." limit 1";
    #            $query1 = mysql_query($sqlstr) or die("Cannot delete calendar event<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    #            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where calid = '".$user->gsv("curcalid")."' and evid=".$evid;
    #            $query1 = mysql_query($sqlstr) or die("Cannot delete calendar event reminders<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_events where evid = ".$evid." and calid='".$user->gsv("curcalid")."'";
                $query1 = mysql_query($sqlstr) or die("Cannot update calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where evid = ".$evid." and calid='".$user->gsv("curcalid")."'";
                $query1 = mysql_query($sqlstr) or die("Cannot update event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_extents where evid = ".$evid;
                $query1 = mysql_query($sqlstr) or die("Cannot update Extents table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = $user->gsv("curcalid");
                $logentry["evid"] = $evid;
                $logentry["adate"] = time();
                $logentry["laction"] = "Event deleted";
                $logentry["lbefore"] = " ";
                $logentry["lafter"] = " ";
                $logentry["remarks"] = " ";
                histlog($logentry);
            }

        }

/***************************************************************
**  this brings up the edit event form
***************************************************************/

        if($func=="editevent") {

            $editeventokay = 0;
            $eventowner = "";

            if($user->gsv("isadmin")==1) {
                $editeventokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$evid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $editeventokay = 1;
                }

                @mysql_free_result($query1);
            }

            if($editeventokay == 1) {
                editeventform($user,$evid);
            }
        }


# changes for 1.1.10


/***************************************************************
**  this brings up the edit event occurance form
***************************************************************/

        if($func=="editeventoccurance") {

            $editeventokay = 0;
            $eventowner = "";

            if($user->gsv("isadmin")==1) {
                $editeventokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$evid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $editeventokay = 1;
                }

                @mysql_free_result($query1);
            }

            $exyear=substr($evdate,0,4);
            $exmonth=substr($evdate,4,2);
            $exday=substr($evdate,6,2);
            $editingserieseventoccurance = true;

            if($editeventokay == 1) {
                editeventform($user,$evid);
            }

        }


/***************************************************************
**  this deletes an exception
***************************************************************/

        if($func=="deleteexception") {

            $eventactionokay = 0;
            $eventowner = "";

            if($user->gsv("isadmin")==1) {
                $eventactionokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$exid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $eventactionokay = 1;
                }

                @mysql_free_result($query1);
            }

            if($eventactionokay == 1) {


                print $GLOBALS["htmldoctype"];

                print "<html>\n";
                print "<head>\n";
                print "<title>Delete Exception</title>\n";
    ?>
                <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
                <!--
                    function closewindow_onclick() {
                        window.close;
                    }

                //-->
                </SCRIPT>
    <?php
                print "</head>\n";
                print "<body ".$GLOBALS["calbodystyle"]." >\n";

                if( $GLOBALS["demomode"] == false) {
                    $sqlstr = "select count(*) from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$exid.")";
                    $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $evrow = mysql_fetch_array($query1);
                    @mysql_free_result($query1);
                }

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_exceptions where exid='".$exid."'";
                mysql_query($sqlstr) or die("Cannot delete from Event Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                print "<br><br><center><h3>Exception deleted</h3><br>";
                print "<INPUT id=\"closewindow\" type=\"button\" value=\"Okay\" name=\"closewindow\" LANGUAGE=\"javascript\" onclick=\"window.close();\">\n";
                print "<br><br><br>\n";
                include($GLOBALS["CLPath"]."/include/footer.php");
                exit();
            }
        }

/***************************************************************
**  this deletes a single series event occurance
***************************************************************/

        if($func=="deleteeventoccurance") {

            $eventactionokay = 0;
            $eventowner = "";

            if($user->gsv("isadmin")==1) {
                $eventactionokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$evid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $eventactionokay = 1;
                }

                @mysql_free_result($query1);
            }

            if($eventactionokay == 1) {

                if( $GLOBALS["demomode"] == false) {
                    $sqlstr = "select count(*) from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$evid.")";
                    $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $evrow = mysql_fetch_array($query1);
                    $evrow = gmqfix($evrow,1);
                    @mysql_free_result($query1);
                }

                $exyear=substr($evdate,0,4);
                $exmonth=substr($evdate,4,2);
                $exday=substr($evdate,6,2);

                if($GLOBALS["sadmmail"]==1) {
                    $siteowner=$GLOBALS["siteowner"];
                    $adminemail=$GLOBALS["adminemail"];
                    if($GLOBALS["uniem"] == 1) {
                        $toadr="CaLogic Administrator <$adminemail>";
                        $fromadr="CaLogic web site <$adminemail>";
                    } else {
                        $toadr="$adminemail";
                        $fromadr="$adminemail";
                    }
                    $emsub = "System email - CaLogic Series Event Occurance Deletion";
                    $embody="<HTML><BODY>A Series Event Occurance has been deleted.<br><br>
                    Deleted occurance (y-m-d): ".$exyear."-".$exmonth."-".$exday."<br><br>".geteventhtml($evid)."<br><br>Event occurance was deleted by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email")."</body></html>";
                    $emtext=" Series Event Occurance has has been deleted.\n\nDeleted occurance (y-m-d):
                    ".$exyear."-".$exmonth."-".$exday."\n\n".geteventtext($evid)."\n\nEvent occurance was deleted by user: ".$user->gsv("uname").", ".$user->gsv("fullname").", ".$user->gsv("email");
                    sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                }


                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_cal_event_exceptions (evid,calid,exday,exmonth,exyear) values('".$evid."','".$user->gsv("curcalid")."','".$exday."','".$exmonth."','".$exyear."')";
                mysql_query($sqlstr) or die("Cannot insert into Event Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
        }
# changes for 1.1.10


/***************************************************************
**  this saves a conflicting event
***************************************************************/

        if($func=="savecollision") {

            $eventactionokay = 0;
            $eventowner = "";

            if($user->gsv("isadmin")==1) {
                $eventactionokay = 1;
            } else {

                $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$user->gsv("curcalid")."' and evid = ".$evid.")";
                $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $evrow = mysql_fetch_array($query1);
                $eventowner = $evrow["uid"];

                if($eventowner == $user->gsv("cuid")) {
                    $eventactionokay = 1;
                }

                @mysql_free_result($query1);
            }

            if($eventactionokay == 1) {

                $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_events set pending = 0 where calid = '".$user->gsv("curcalid")."' and evid=".$evid." limit 1";
                $query1 = mysql_query($sqlstr) or die("Cannot delete calendar event<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            }
        }


/***************************************************************
**  this brings up the show event page
***************************************************************/

        if($func=="showevent") {

// only allows for current users events
#            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where uid=".$user->gsv("cuid")." and calid = '".$user->gsv("curcalid")."' and evid=".$evid;
#            $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

// shows events from all users

# changes for 1.1.10
                $tevdyear=substr($evdate,0,4);
                $tevdmonth=substr($evdate,4,2);
                $tevdday=substr($evdate,6,2);
                $tmtxt = $tevdmonth;
                if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                $tevdate = $tevdday.".".$monthtextl[$tmtxt].".".$tevdyear;
# changes for 1.1.10

            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where evid=".$evid;
            $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row = mysql_fetch_array($query1) or die("Cannot query calendar events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row = gmqfix($row,1);

            $curusercansub = 0;
            if($user->gsv("uname")=="Guest") {
                $reguser = 0;

                if ($row["remsuballow"] == 1 && $row["remsublevel"] == 0) {
                    $curusercansub = 1;
                }

            } elseif($user->gsv("isadmin")=="1") {
                $reguser = 2;

                if ($row["remsuballow"] == 1) {
                    $curusercansub = 1;
                }

            } else {
                $reguser = 1;

                if ($row["remsuballow"] == 1) {
                    $curusercansub = 1;
                }
            }

            print $GLOBALS["htmldoctype"];


            print "<html>\n";
            print "<head>\n";
            print "<title>Event Info</title>\n";
            ?>
            <SCRIPT ID="clientEventHandlersJS" LANGUAGE="javascript">
            <!--

            <?php
            if(!isset($GLOBALS["noed"])) {
            ?>
                function gocal_onclick() {
                        eevent.evid.value="";
                        eevent.evdate.value="";
                        eevent.func.value="";
                        eevent.submit();
                }

                function eved_onclick() {
                        eevent.func.value="editevent";
                        eevent.submit();
                }

// Changes for 1.1.10

                function remrow(exremrow) {
                    for(x=0;x < exceptiontab.rows.length;x++) {
                        if(exceptiontab.rows.item(x).id == exremrow) {
                            retval = exceptiontab.deleteRow(x);
                            return;
                        }
                    }
                }

                function evsoed_onclick() {
                    eevent.func.value="editeventoccurance";
                    eevent.submit();
                }

                function evsdel_onclick() {

                    if(confirm("Are you sure you wish to delete this series event?\nDeleteing it will also delete all occurances of the series.") == true) {
                        eevent.func.value="deleteevent";
                        eevent.submit();
                    }

                }

                function evsodel_onclick() {

                    if(confirm("Are you sure you wish to delete this series event occurance?\nDeleteing it will only delete this occurance of the series.") == true) {
                        eevent.func.value="deleteeventoccurance";
                        eevent.submit();
                    }

                }

//                function evdel_onclick() {
//                        if(eevent.evies.value == "1") {
//                                if(confirm("Are you sure you wish to delete this series event?\nDeleteing it will also delete all occurances of the series.\nIf you wish only to delete this occurance of the series,\nyou can do so by useing the edit feature.") == true) {
//                                    eevent.func.value="deleteevent";
//                                    eevent.submit();
//                                }
//                        } else {
//                                if(confirm("Are you sure you wish to delete this event?") == true) {
//                                    eevent.func.value="deleteevent";
//                                    eevent.submit();
//                                }
//                        }
//                }

                function evdel_onclick() {
                    if(confirm("Are you sure you wish to delete this event?") == true) {
                        eevent.func.value="deleteevent";
                        eevent.submit();
                    }
                }

                function delexception_onclick(exid,exdate) {
                    if(confirm("Are you sure you wish to delete the exception on: " + exdate + "?") == true) {
                        var xurl="<?php print $GLOBALS["idxfile"]; ?>?func=deleteexception&exid=" + exid;
                        var xarg = exid;
                        var sFeatures="dialogHeight: 495px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
                        extretval = window.showModalDialog(xurl, xarg, sFeatures);
                        remrow(exid);
                    }
                }

// Changes for 1.1.10

            <?php
            } else {
            ?>

                function closewindow_onclick() {
                    window.close();
                }
            <?php
            }
            ?>



            <?php
            if ($curusercansub == 1) {
            ?>
            function evrsub_onclick() {
                message.innerHTML = "<center><h2 align=center>please wait...</h2></center>";
                eevent.evrsub.disabled = true;
                var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=addevsub&currentuser=" + currentuser.value + "&currentcal=" + currentcal.value + "&remsublevel=" + remsublevel.value + "&reguser=" + reguser.value + "&aiev=0";
                var xarg = currentuser.value + "|" + currentcal.value + "|" + remsublevel.value + "|" + reguser.value + "|0";
                var sFeatures="dialogHeight: 495px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
                //alert(xarg);
                extretval = window.showModalDialog(xurl, xarg, sFeatures);
                //extretval = window.open(xurl) //, xarg, sFeatures);
                //alert(extretval);
    //            window.open(xurl);

                if(extretval=="0") {
                    alert("Add New Subscriber Cancled.");
                    eevent.evrsub.disabled = false;
                    message.innerHTML = "&nbsp;";
                    return false;
                } else {
                    //subforevent.newsubvalue.value=extretval;
                    //subforevent.submit();
                    message.innerHTML = "<center><h2 align=center>Saving subscription, please wait...</h2></center>";
                    var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=newsubscriber&newsubvalue=" + extretval + "&nsevid=<?php print $evid; ?>&nsevdate=<?php print $evdate; ?>";
                    var xarg = extretval;
                    var sFeatures="dialogHeight: 495px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
                    extretval = window.showModalDialog(xurl, xarg, sFeatures);
                    eevent.evrsub.disabled = false;
                    message.innerHTML = "&nbsp;";
                }
                eevent.evrsub.disabled = false;
                message.innerHTML = "&nbsp;";
            }
            <?php
            }
            ?>
<?php
if($user->gsv("isadmin") == "1" || $row["uid"] == $user->gsv("cuid") || $GLOBALS["demomode"] == true) {
?>
function moveevent_onclick() {
    if(confirm("Are you sure you want to move this event?") == true) {
        var tvar = ocalselect.value;
        tvar = tvar.split("|");
        cmevent.cmcalid.value = tvar[0];
        cmevent.cmcalowner.value = tvar[1];
        cmevent.cmaction.value = "move";
        cmevent.submit();
    } else {
        alert("Move cancled");
    }

}

function copyevent_onclick() {

    if(confirm("Are you sure you want to copy this event?") == true) {
        var tvar = ocalselect.value;
        tvar = tvar.split("|");
        cmevent.cmcalid.value = tvar[0];
        cmevent.cmcalowner.value = tvar[1];
        cmevent.cmaction.value = "copy";
        cmevent.submit();
    } else {
        alert("Copy cancled");
    }

}
<?php
}
?>
                function window_onload() {
                    eidate.innerText = tevdate.value;
                }

            //-->
            </SCRIPT>
<?php
            print "</head>\n";
            print "<body language=\"javascript\" onload=\"return window_onload()\" ".$GLOBALS["calbodystyle"].">\n";
            print "<table border=\"0\" width=\100%\">";
            print "<tr>";
            print "<td nowrap width=\"20%\">";
            print "<h2>Event Information</h2>\n";
            print "<h3 id=\"eidate\">Date: </h3>\n";
            print "</td>";
            print "<td nowrap width=\"80%\">";

            print "</td>";
            print "</tr>";
            print "</table>";

            $evhtml = geteventhtml($evid);

            print $evhtml;
            print "<div id=\"message\">&nbsp;</div>";
# changes for 1.1.10
#                $tevdyear=substr($evdate,0,4);
#                $tevdmonth=substr($evdate,4,2);
#                $tevdday=substr($evdate,6,2);

#                $tmtxt = $tevdmonth;
#                if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
#                $tevdate = $tevdday.".".$monthtextl[$tmtxt].".".$tevdyear;
# changes for 1.1.10

                print "<input type=\"hidden\" name=\"tevdate\" id=\"tevdate\" value=\"".$tevdate."\">\n";

                if(!isset($GLOBALS["noed"])) {

                    if($row["uid"]==$user->gsv("cuid") || $user->gsv("isadmin")==1 || $GLOBALS["demomode"]==true) {
                        $caneditev = "";
                    } else {
                        $caneditev = "disabled";
                    }

                    print "<form method=\"".$GLOBALS["postorget"]."\" name=\"eevent\" id=\"eevent\" action=\"".$GLOBALS["idxfile"]."\">\n";
                    print "<input type=\"hidden\" name=\"evies\" id=\"evies\" value=\"".$row["iseventseries"]."\">\n";
                    print "<input type=\"hidden\" name=\"evid\" id=\"evid\" value=\"".$evid."\">\n";
                    print "<input type=\"hidden\" name=\"evdate\" id=\"evdate\" value=\"".$evdate."\">\n";
                    print "<input type=\"hidden\" name=\"func\" id=\"func\" value=\"\">\n";

                    print "<table border=\"1\" width=\"70%\">\n";
                    print "<tr>\n";

                    if($row["iseventseries"]==1) {

                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" ".$caneditev." value=\"Edit Series Event\" id=\"eved\" name=\"eved\" LANGUAGE=javascript onclick=\"return eved_onclick()\">\n";
                        print "</td>";
                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" ".$caneditev." value=\"Edit Series Occurance\" id=\"evsoed\" name=\"evsoed\" LANGUAGE=javascript onclick=\"return evsoed_onclick()\">\n";
                        print "</td>";
                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" ".$caneditev." value=\"Delete Series Event\" id=\"evsdel\" name=\"evsdel\" LANGUAGE=javascript onclick=\"return evsdel_onclick()\">\n";
                        print "</td>";
                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" ".$caneditev." value=\"Delete Series Occurance\" id=\"evsodel\" name=\"evsodel\" LANGUAGE=javascript onclick=\"return evsodel_onclick()\">\n";
                        print "</td>";

                    } else {

                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" ".$caneditev." value=\"Edit Event\" id=\"eved\" name=\"eved\" LANGUAGE=javascript onclick=\"return eved_onclick()\">\n";
                        print "</td>";
                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" ".$caneditev." value=\"Delete Event\" id=\"evdel\" name=\"evdel\" LANGUAGE=javascript onclick=\"return evdel_onclick()\">\n";
                        print "</td>";

                    }
                    print "</tr>\n";
                    print "</table>\n";

                    print "<table border=\"1\" width=\"70%\">\n";
                    print "<tr>\n";

                    print "<td align=\"center\">\n";
                    print "<INPUT type=\"button\" value=\"Go To Calendar\" id=\"gocal\" name=\"gocal\" LANGUAGE=javascript onclick=\"return gocal_onclick()\">\n";
                    print "</td>\n";

                    if ($curusercansub == 1) {
                        print "<td align=\"center\">\n";
                        print "<INPUT type=\"button\" value=\"Subscribe for Reminder\" id=\"evrsub\" name=\"evrsub\" LANGUAGE=javascript onclick=\"return evrsub_onclick()\">\n";
                        print "</td>\n";
                    }
                    print "</tr>\n";
                    print "</table>\n";
                    print "</form>\n";

if($user->gsv("isadmin") == "1" || $row["uid"] == $user->gsv("cuid") || $GLOBALS["demomode"] == true) {
?>
<input type="button" id="moveevent" name="moveevent" value=" Move " LANGUAGE="javascript" onclick="moveevent_onclick()">&nbsp;or&nbsp;<input type="button" id="copyevent" name="copyevent" value=" Copy " LANGUAGE="javascript" onclick="copyevent_onclick()"> Event to:&nbsp;
            <select size="1" id="ocalselect" name="ocalselect" style="WIDTH: 200px">
            <?php
                if($user->gsv("isadmin") == "1") {
                    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid <> '0' and calid <> '".$user->gsv("curcalid")."' order by calname";
                } else {
                    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid <> '0' and calid <> '".$user->gsv("curcalid")."' and ( (userid = ".$user->gsv("cuid").") or (caltype < 2 and calid <> '0') )  order by calname";
                }
                $query2 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                while($row1 = mysql_fetch_array($query2)) {
                    $row1 = gmqfix($row1,1);
                    print "<option ";
                    print "value=\"".$row1["calid"]."|".$row1["tuid"]."\">".($row1["calname"])."</option>\n";
                }
                mysql_free_result($query2);
            ?>
        </select>
<?
                        print "<form method=\"".$GLOBALS["postorget"]."\" name=\"cmevent\" id=\"cmevent\" action=\"".$GLOBALS["idxfile"]."?gosfuncs=1&qjump=cmeventgo\">\n";
                        print "<input type=\"hidden\" name=\"cmevid\" id=\"cmevid\" value=\"".$evid."\">\n";
                        print "<input type=\"hidden\" name=\"cmevowner\" id=\"cmevowner\" value=\"".$row["uid"]."\">\n";
                        print "<input type=\"hidden\" name=\"cmhasext\" id=\"cmhasext\" value=\"".$row["extfields"]."\">\n";
                        print "<input type=\"hidden\" name=\"cmcalid\" id=\"cmcalid\" value=\"\">\n";
                        print "<input type=\"hidden\" name=\"cmcatid\" id=\"cmcatid\" value=\"".$row["catid"]."\">\n";
                        print "<input type=\"hidden\" name=\"cmcalowner\" id=\"cmcalowner\" value=\"\">\n";
                        print "<input type=\"hidden\" name=\"cmaction\" id=\"cmaction\" value=\"\">\n";
                        print "</form>\n";
}
                    if ($curusercansub == 1) {

                        print "<form method=\"".$GLOBALS["postorget"]."\" name=\"subforevent\" id=\"subforevent\" action=\"".$GLOBALS["idxfile"]."?gosfuncs=1&qjump=newsubscriber\">\n";
                        print "<input type=\"hidden\" name=\"newsubvalue\" id=\"newsubvalue\" value=\"\">\n";
                        print "<input type=\"hidden\" name=\"nsevid\" id=\"nsevid\" value=\"".$evid."\">\n";
                        print "<input type=\"hidden\" name=\"nsevdate\" id=\"nsevdate\" value=\"".$evdate."\">\n";
                        print "</form>\n";
                    }

                } else {
                    #print "<INPUT type=\"button\" value=\"Subscribe for Reminder\" id=\"evrsub\" name=\"evrsub\" LANGUAGE=javascript onclick=\"return evrsub_onclick()\">\n";

                    print "<INPUT id=\"closewindow\" type=\"button\" value=\"Close Window\" name=\"closewindow\" LANGUAGE=\"javascript\" onclick=\"window.close();\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
                }

            if($GLOBALS["demomode"] == true) {
                print "<br><h3>NOTE: Reminders will not be sent from this demo site.</h3>";
            }

                print "<input type=\"hidden\" name=\"remsuballow\" id=\"remsuballow\" value=\"".$row["remsuballow"]."\">\n";
                print "<input type=\"hidden\" name=\"remsublevel\" id=\"remsublevel\" value=\"".$row["remsublevel"]."\">\n";
                print "<input type=\"hidden\" name=\"reguser\" id=\"reguser\" value=\"".$reguser."\">\n";
                print "<input type=\"hidden\" name=\"currentuser\" id=\"currentuser\" value=\"".$user->gsv("cuid")."\">\n";
                print "<input type=\"hidden\" name=\"currentcal\" id=\"currentcal\" value=\"".$user->gsv("curcalid")."\">\n";

            print "<br><br>\n";
            include($GLOBALS["CLPath"]."/include/footer.php");
            exit();
        } # end php if func = showevent
    } # end if(isset($func)) {


function showeventcollision($evid,$sevcar,$evlidx) {
    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$evddt,$evddtl;
    global $daybeginhour,$dayendhour,$dayhourcount,$wdtxt,$dptxt;
    global $user,$curcalcfg,$fsize;
    global $langcfg;
/***************************************************************
**  this brings up an event that has collided with other events
***************************************************************/

        $dptxt[1] = "First";
        $dptxt[2] = "Second";
        $dptxt[3] = "Third";
        $dptxt[4] = "Fourth";
        $dptxt[5] = "Last";

        $wdtxt[8] = "Weekday";
        $wdtxt[9] = "Weekend day";
        $wdtxt[10] = "Day";

/*
        $checkdisp = false;
#        if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
        if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
            $checkdisp = true;
        }
*/
            static $shevcnt=0;
            $shevcnt++;

            static $evcdone = array();
            $evcdone[0]="";
            if(in_array ($evid, $evcdone)) {
                return 0;
            }
            $evcdone[$shevcnt]=$evid;

            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where calid = '".$user->gsv("curcalid")."' and evid=".$evid;
            $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


            while($row = mysql_fetch_array($query1)) {
                $row = gmqfix($row,1);

                if($evlidx >0) {
                    print "<br><h4><font color=\"red\">Collision ".($shevcnt-1)."</font></h4>";
                }
                print "<table border=\"1\" width=\"100%\">\n";
                #if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                    print "<tr>\n";
                    print "<th align=\"left\" width=\"12%\" valign=\"top\">Title:</th>\n";
                    print "<td width=\"88%\" valign=\"top\">\n";
                    print (($row["title"]));
                    print "</td>\n";
                    print "</tr>\n";
                #}

                #if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
                    print "<tr>\n";
                    print "<th align=\"left\" width=\"12%\" valign=\"top\">".$curcalcfg["gcscoif_subtitletxt"]."</th>\n";
                    print "<td width=\"88%\" valign=\"top\">\n";
                    if(strlen($row["subtitle"]>0)) {
                        print (($row["subtitle"]));
                    } else {
                        print "&nbsp;";
                    }
                    print "</td>\n";
                    print "</tr>\n";
                #}

                print "<tr>\n";
                print "<th align=\"left\" width=\"12%\" valign=\"top\">\n";
                if($row["iseventseries"] != 0) {
                    if($row["estype"] == 1) {
                        print "Daily, starting on:";
                    } elseif($row["estype"] == 2) {
                        print "Weekly, starting on:";
                    } elseif($row["estype"] == 3) {
                        print "Monthly, starting on:";
                    } elseif($row["estype"] == 4) {
                        print "Yearly, starting on:";
                    }
                } else {
                    print "Date:";
                }
                print "</th>\n";
                print "<td width=\"88%\" valign=\"top\">\n";
                $tmtxt = $row["startmonth"];
                if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                print $row["startday"].".".$monthtextl[$tmtxt].".".$row["startyear"];

                if($row["iseventseries"] != 0) {

                    print "<br>";
                    if($row["estype"] == 1) {
                        if($row["estd"] == 1) {
                            if($row["estdint"] == 1) {
                                print "Every day.";
                            } else {
                                print "Every ".$row["estdint"]." days.";
                            }
                        } else {
                            print "Every weekday.";
                        }
                    } elseif($row["estype"] == 2) {

                        if($row["estwint"] == 1) {
                            print "Every week on:<br>";
                            $have1day = false;
                            for($wa=0;$wa<7;$wa++) {
                                $twa = substr($row["estwd"],$wa,1);
                                if($twa == 1) {
                                    if($have1day == true) {
                                        print ", ";
                                    }
                                    print $evddtl[$wa+1];
                                    $have1day = true;
                                }
                            }
                        } else {
                            print "Every ".$row["estwint"]." weeks on: ";
                            $have1day = false;
                            for($wa=0;$wa<7;$wa++) {
                                $twa = substr($row["estwd"],$wa,1);
                                if($twa == 1) {
                                    if($have1day == true) {
                                        print ", ";
                                    }
                                    print $evddtl[$wa+1];
                                    $have1day = true;
                                }
                            }
                        }
                    } elseif($row["estype"] == 3) {
                        if($row["estm"] == 1) {
                            if($row["estm1int"] == 1) {
                                print "Every month on the: ";
                            } else {
                                print "Every ".$row["estm1int"]." months on the: ";
                            }
                            print $row["estm1d"];
                        } else {
                            if($row["estm2int"] == 1) {
                                print "Every month on the: ";
                            } else {
                                print "Every ".$row["estm2int"]." months on the: ";
                            }
                            $twa = $row["estm2dp"];
                            print $dptxt[$twa]."&nbsp;";
                            $twa = $row["estm2wd"];
                            if($row["estm2wd"] > 7) {
                                print $wdtxt[$twa];
                            } else {
                                print $evddtl[$twa];
                            }
                        }

                    } elseif($row["estype"] == 4) {

                        if($row["esty"] == 1) {
                           print "Every year on: ".$row["esty1d"].".";
                           $tmtxt = $row["esty1m"];
                           if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                           print $monthtextl[$tmtxt];
                        } else {
                           print "Every year on the: ";
                            $twa = $row["esty2dp"];
                            print $dptxt[$twa]."&nbsp;";
                            $twa = $row["esty2wd"];
                            if($row["esty2wd"] > 7) {
                                print $wdtxt[$twa];
                            } else {
                                print $evddtl[$twa];
                            }
                            print "&nbsp;in&nbsp;";
                           $tmtxt = $row["esty2m"];
                           if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                           print $monthtextl[$tmtxt];
                        }
                    }
                    if($row["ese"] == 0) {
                        print "<br>Series has no end date.";
                    } else {
                        if($row["ese"] == 1) {
                            print "<br>Series will end after ".$row["eseaoint"]." occurances.";
                        } else {
                           $tmtxt = $row["esem"];
                           if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                           print "<br>Series will end after the ".$row["esed"].".".$monthtextl[$tmtxt].".".$row["esey"];
                        }
                    }
                    if($evlidx != -1) {
                        $retvid = 0;
                        $evcastat = array_count_values ($sevcar["id"]);
                        #print "<br><br>Event count, ID: ".$sevcar["id"][$evlidx]." = ".$evcastat[$sevcar["id"][$evlidx]]."<br>";
                        if($evcastat[$sevcar["id"][$evlidx]] > 1) {
                            print "<br><br><font color=\"red\"><b>Collision Dates: </b></font><br>\n";
                            print "<textarea readonly rows=\"4\" cols=\"25\">\n";
                            for($mcdcnt=1;$mcdcnt<=$sevcar[0][0];$mcdcnt++) {
                                if($sevcar["id"][$mcdcnt]==$evid) {
                                    $evdxi = getdate($sevcar["evcdate"][$mcdcnt]);
                                    print $evdxi["mday"]." ".$monthtextl[$evdxi["mon"]]." ".$evdxi["year"]."\n";
                                }
                            }
                            $retvid = 0;
                            print "</textarea>\n";

                        } else {
                            $evdxi = getdate($sevcar["evcdate"][$evlidx]);
                            print "<br><br><font color=\"red\"><b>Date of collision: ".$evdxi["mday"]." ".$monthtextl[$evdxi["mon"]]." ".$evdxi["year"]."</b></font>";
                        }
                    }
                }
                print "</td>\n";
                print "</tr>\n";

                print "<tr>\n";
                print "<th align=\"left\" width=\"12%\" valign=\"top\">\n";
                print "Time:</th>\n";
                print "<td width=\"88%\" valign=\"top\">\n";
                if($row["isallday"] == 1) {
                    print "This is an all day event\n";
                    if($evlidx > 0) {
                        $evdxis = getdate($sevcar["evcst"][$evlidx]);
                        $evdxie = getdate($sevcar["evcet"][$evlidx]);
                        if($curcalcfg["timetype"]==1) {
                            print "<br><font color=\"red\"><b>Collison from: ".date("H:i", mktime($evdxis["hours"],$evdxis["minutes"],0,3,3,1990))." To: ".date("H:i", mktime($evdxie["hours"],$evdxie["minutes"],0,3,3,1990))."</b></font>\n";
                        } else {
                            print "<br><font color=\"red\"><b>Collison from: ".date("h:i A", mktime($evdxis["hours"],$evdxis["minutes"],0,3,3,1990))." To: ".date("h:i A", mktime($evdxie["hours"],$evdxie["minutes"],0,3,3,1990))."</b></font>\n";
                        }
                    }

                } else {
                    if($curcalcfg["timetype"]==1) {
                        print "From: ".$row["starthour"].":".$row["startmin"]."&nbsp;&nbsp;To: ".$row["endhour"].":".$row["endmin"];
                        if($evlidx > 0) {
                            $evdxis = getdate($sevcar["evcst"][$evlidx]);
                            $evdxie = getdate($sevcar["evcet"][$evlidx]);
                            print "<br><font color=\"red\"><b>Collison from: ".date("H:i", mktime($evdxis["hours"],$evdxis["minutes"],0,3,3,1990))." To: ".date("H:i", mktime($evdxie["hours"],$evdxie["minutes"],0,3,3,1990))."</b></font>\n";
                        }

                    } else {
                        print "From: ".date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990))."&nbsp;&nbsp;To: ".date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990))."\n";
/*
                        $txtstrint = $row["starthour"].$row["startmin"];
                        if($txtstrint < 1200 && $row["starthour"] != "00") {
                            print "From: ".$row["starthour"].":".$row["startmin"]." AM&nbsp;&nbsp;";
                        } elseif($row["starthour"] == "00") {
                            print "From: 12:".$row["startmin"]." AM&nbsp;&nbsp;";
                        } else {
                            $txtstrint = (int) $row["starthour"];
                            if($txtstrint > 12) {
                                $txtstrint = $txtstrint-12;
                            }
                            print "From: ".$txtstrint.":".$row["startmin"]." PM&nbsp;&nbsp;";
                        }
                        $txtstrint = $row["endhour"].$row["endmin"];
                        if($txtstrint < 1200 && $row["endhour"] != "00") {
                            print "To: ".$row["endhour"].":".$row["endmin"]." AM";
                        } elseif($row["endhour"] == "00") {
                            print "From: 12:".$row["endmin"]." AM&nbsp;&nbsp;";
                        } else {
                            $txtstrint = (int) $row["endhour"];
                            if($txtstrint > 12) {
                                $txtstrint = $txtstrint-12;
                            }
                            print "To: ".$txtstrint.":".$row["endmin"]." PM";
                        }
*/
                        if($evlidx > 0) {
                            $evdxis = getdate($sevcar["evcst"][$evlidx]);
                            $evdxie = getdate($sevcar["evcet"][$evlidx]);
                            print "<br><font color=\"red\"><b>Collison from: ".date("h:i A", mktime($evdxis["hours"],$evdxis["minutes"],0,3,3,1990))." To: ".date("h:i A", mktime($evdxie["hours"],$evdxie["minutes"],0,3,3,1990))."</b></font>\n";
                        }
                    }

                }
                print "</td>\n";
                print "</tr>\n";


                print "<tr>\n";
                print "<th align=\"left\" width=\"12%\" valign=\"top\">Category:</th>\n";
                print "<td width=\"88%\" valign=\"top\">\n";
                if($row["catid"] != 0) {
# selects cats from current user
#                    $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where uid=".$user->gsv("cuid")." and (calid = '".$user->gsv("curcalid")."' or calid='0') and catid=".$row["catid"];
# selects cats from user who created event
#                    $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where (uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or calid='-2'  and catid=".$row["catid"];
                    $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid=".$row["catid"]." and ((uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or (calid='-2'))";
                    $queryc = mysql_query($sqlstrc) or die("Cannot query user cats table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    if($rowc = mysql_fetch_array($queryc)) {
                        $rowc = gmqfix($rowc,1);
                        print mqfix($rowc["catname"]);
                    }


                    @mysql_free_result($queryc);
                } else {
                    print "None assigned";
                }
                print "</td>\n";
                print "</tr>\n";
                print "<tr>\n";
                print "<th align=\"left\" width=\"12%\" valign=\"top\">Description:</th>\n";
                print "<td width=\"88%\" valign=\"top\">\n";
                print nl2br(($row["description"]));
                print "&nbsp;";
                print "</td>\n";
                print "</tr>\n";
                print "<tr>\n";
                print "<tr>\n";
                if($GLOBALS["allowreminders"] == 1) {

                    print "<th align=\"left\" width=\"12%\" valign=\"top\">Reminder Subscriptions:</th>\n";
                    print "<td width=\"88%\" valign=\"top\">\n";
                    if($row["remsuballow"]==1) {
                        print "Yes, Level: ";
                        if($row["remsublevel"]==0) {
                            print "Anyone ";
                        } else {
                            print "Registered Users Only";
                        }
                    } else {
                        print "No";
                    }
                    print "</td>\n";
                    print "</tr>\n";


                    $sqlstrx = "select tuid from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$row["calid"]."'";
                    $queryx = mysql_query($sqlstrx) or die("Cannot query cal ini<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrx."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $rowx = mysql_fetch_array($queryx);
                    $calowner = $rowx["tuid"];

                    if($user->gsv("isadmin")=="1" || $row["uid"] == $user->gsv("cuid") || $row["uid"] == $calowner) {


                        print "<tr>\n";
                        print "<th align=\"left\" width=\"12%\" valign=\"top\">Reminder:</th>\n";

                        print "<td width=\"88%\" valign=\"top\">\n";

                        if($row["sendreminder"] == 0) {
                            print "None";
                        } else {
                            print getreminder($row["uid"],$user->gsv("curcalid"),$evid);
                        }
                        print "&nbsp;</td>\n";
                        print "</tr>\n";
                    }

                    print "<tr>\n";
                }
                print "<th align=\"left\" width=\"12%\" valign=\"top\">Extents:</th>\n";
                print "<td width=\"88%\" valign=\"top\">\n";
                print getextents($evid);
                print "</td>\n";
                print "</tr>\n";

                print "</table>\n";
                print "<br>\n";

            }
            @mysql_free_result($query1);
            return $retvid;
}



function getextents($evid) {

$getefxsql = "SELECT eftext,exval,".$GLOBALS["tabpre"]."_extents.efsid,efsval FROM ".$GLOBALS["tabpre"]."_extents left join
".$GLOBALS["tabpre"]."_ext_def on ".$GLOBALS["tabpre"]."_extents.efid=".$GLOBALS["tabpre"]."_ext_def.efid left join
".$GLOBALS["tabpre"]."_ext_sel_def on ".$GLOBALS["tabpre"]."_extents.efid=".$GLOBALS["tabpre"]."_ext_sel_def.efid and
".$GLOBALS["tabpre"]."_extents.efsid = ".$GLOBALS["tabpre"]."_ext_sel_def.efsid WHERE ".$GLOBALS["tabpre"]."_extents.evid=".$evid;

#SELECT clc_extents.efid,eftext,exval,clc_extents.efsid,efsval FROM clc_extents left join clc_ext_def on clc_extents.efid=clc_ext_def.efid left join clc_ext_sel_def on clc_extents.efid=clc_ext_sel_def.efid and clc_extents.efsid = clc_ext_sel_def.efsid WHERE clc_extents.evid=57

#print "<br><br>".$getefxsql."<br><br>";

$getextentcount = 0;

    $efxquery = mysql_query($getefxsql) or die("Cannot query Event Extents <br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $numrows = @mysql_num_rows($efxquery);

    if($numrows > 0) {

        $rethtml = "<table width=\"60%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\"><tr>\n
        <th align=\"left\" valign=\"top\" width=\"20%\">Field</th>\n
        <th align=\"left\" valign=\"top\" width=\"40%\">Entry</th>\n
        </tr>\n";

        @mysql_free_result($efxquery);

        $efxquery = mysql_query($getefxsql) or die("Cannot query Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$getefxsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        while($efxrow = mysql_fetch_array($efxquery)) {
            $getextentcount++;
            $rethtml .= "<tr>";

            $efxrow = gmqfix($efxrow,1);
            $rethtml .= "<th align=\"left\" valign=\"top\" >".$efxrow["eftext"]."</th>";
            if($efxrow["efsid"] == 0) {
                $rethtml .= "<td align=\"left\" valign=\"top\" >".nl2br($efxrow["exval"])."</td>";
            } else {
                $rethtml .= "<td align=\"left\" valign=\"top\" >".$efxrow["efsval"]."</td>";
            }
            $rethtml .= "</tr>";
        }
        $rethtml .= "</table>";
    } else {
        $rethtml = "none";
    }
    if($getextentcount > 4) {
        $rethtml = "\n<span style=\"width: 100%; height: 150; overflow: auto\">\n".$rethtml."</span>";
    }

    @mysql_free_result($efxquery);


    return $rethtml;
}




function getextentstxt($evid) {

$getefxsql = "SELECT eftext,exval,".$GLOBALS["tabpre"]."_extents.efsid,efsval FROM ".$GLOBALS["tabpre"]."_extents left join
".$GLOBALS["tabpre"]."_ext_def on ".$GLOBALS["tabpre"]."_extents.efid=".$GLOBALS["tabpre"]."_ext_def.efid left join
".$GLOBALS["tabpre"]."_ext_sel_def on ".$GLOBALS["tabpre"]."_extents.efid=".$GLOBALS["tabpre"]."_ext_sel_def.efid and
".$GLOBALS["tabpre"]."_extents.efsid = ".$GLOBALS["tabpre"]."_ext_sel_def.efsid WHERE ".$GLOBALS["tabpre"]."_extents.evid=".$evid;

    $efxquery = mysql_query($getefxsql) or die("Cannot query Event Extents <br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $numrows = @mysql_num_rows($efxquery);

    if($numrows > 0) {
        $rethtml ="";

        @mysql_free_result($efxquery);

        $efxquery = mysql_query($getefxsql) or die("Cannot query Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$getefxsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        while($efxrow = mysql_fetch_array($efxquery)) {

            $efxrow = gmqfix($efxrow,1);
            $rethtml .= $efxrow["eftext"].":\n";
            if($efxrow["efsid"] == 0) {
                $rethtml .= $efxrow["exval"]."\n";
            } else {
                $rethtml .= $efxrow["efsval"]."\n";
            }
            $rethtml .= "\n";
        }
    } else {
        $rethtml = "none\n";
    }
    @mysql_free_result($efxquery);
    return $rethtml;
}

# show complete event in the day view
# This function returns an event in html format
function showviewevent($evid) {

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$evddt,$evddtl;
    global $daybeginhour,$dayendhour,$dayhourcount;
    global $user,$curcalcfg,$fsize;
    global $langcfg;

        $checkdisp = false;
        if($user->gsv("isadmin")!="1") {
#            if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
            if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
                 $checkdisp = true;
            }
        }

        $dptxt[1] = "First";
        $dptxt[2] = "Second";
        $dptxt[3] = "Third";
        $dptxt[4] = "Fourth";
        $dptxt[5] = "Last";

        $wdtxt[8] = "Weekday";
        $wdtxt[9] = "Weekend day";
        $wdtxt[10] = "Day";

#        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where calid = '".$user->gsv("curcalid")."' and evid=".$evid;
#        $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


// Private cal select
    if($curcalcfg["caltype"]==2) {
        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where uid=".$user->gsv("cuid")." and calid = '".$user->gsv("curcalid")."' and evid=".$evid;
    } elseif($curcalcfg["caltype"]==1){

// Public cal select
        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where calid = '".$user->gsv("curcalid")."' and evid=".$evid;
    } elseif($curcalcfg["caltype"]==0){

// open cal select
        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where calid = '".$user->gsv("curcalid")."' and evid=".$evid;
    }

    $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            while($row = mysql_fetch_array($query1)) {
                $row = gmqfix($row,1);

                if(($checkdisp == true && $curcalcfg["deicat"] == 1) || ($checkdisp == false)) {
                    $htout = "<br><br>\n<b>Category:</b> \n";
                    if($row["catid"] != 0) {
    #                    $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where uid=".$user->gsv("cuid")." and (calid = '".$user->gsv("curcalid")."' or calid='0') and catid=".$row["catid"];
                        $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid=".$row["catid"]." and ((uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or (calid='-2'))";
                        $queryc = mysql_query($sqlstrc) or die("Cannot query user cats table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        if($rowc = mysql_fetch_array($queryc)) {
                            $htout .= ($rowc["catname"]);
                        }
                        @mysql_free_result($queryc);
                    } else {
                        $htout .= "None assigned";
                    }
                    $htout .= "<br><br>\n";
                }
                if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
                    $htout .= "<b>Repeating Event:</b> \n";

                    if($row["iseventseries"] != 0) {
                        if($row["estype"] == 1) {
                            $htout .= "Daily, ";
                        } elseif($row["estype"] == 2) {
                            $htout .= "Weekly, ";
                        } elseif($row["estype"] == 3) {
                            $htout .= "Monthly, ";
                        } elseif($row["estype"] == 4) {
                            $htout .= "Yearly, ";
                        }
                    } else {
                        $htout .= "No.";
                    }

                    if($row["iseventseries"] != 0) {

                        if($row["estype"] == 1) {
                            if($row["estd"] == 1) {
                                if($row["estdint"] == 1) {
                                    $htout .= "Every day.";
                                } else {
                                    $htout .= "Every ".$row["estdint"]." days.";
                                }
                            } else {
                                $htout .= "Every weekday.";
                            }
                        } elseif($row["estype"] == 2) {

                            if($row["estwint"] == 1) {
                                $htout .= "Every week on:<br>";
                                $have1day = false;
                                for($wa=0;$wa<7;$wa++) {
                                    $twa = substr($row["estwd"],$wa,1);
                                    if($twa == 1) {
                                        if($have1day == true) {
                                            $htout .= ", ";
                                        }
                                        $htout .= $evddtl[$wa+1];
                                        $have1day = true;
                                    }
                                }
                            } else {
                                $htout .= "Every ".$row["estwint"]." weeks on: ";
                                $have1day = false;
                                for($wa=0;$wa<7;$wa++) {
                                    $twa = substr($row["estwd"],$wa,1);
                                    if($twa == 1) {
                                        if($have1day == true) {
                                            $htout .= ", ";
                                        }
                                        $htout .= $evddtl[$wa+1];
                                        $have1day = true;
                                    }
                                }
                            }
                        } elseif($row["estype"] == 3) {
                            if($row["estm"] == 1) {
                                if($row["estm1int"] == 1) {
                                    $htout .= "Every month on the: ";
                                } else {
                                    $htout .= "Every ".$row["estm1int"]." months on the: ";
                                }
                                $htout .= $row["estm1d"];
                            } else {
                                if($row["estm2int"] == 1) {
                                    $htout .= "Every month on the: ";
                                } else {
                                    $htout .= "Every ".$row["estm2int"]." months on the: ";
                                }

                                $twa = $row["estm2dp"];
                                $htout .= $dptxt[$twa]."&nbsp;";
                                $twa = $row["estm2wd"];
                                if($row["estm2wd"] > 7) {
                                    $htout .= $wdtxt[$twa];
                                } else {
                                    $htout .= $evddtl[$twa];
                                }
                            }

                        } elseif($row["estype"] == 4) {

                            if($row["esty"] == 1) {
                               $htout .= "Every year on: ".$row["esty1d"].".";
                               $tmtxt = $row["esty1m"];
                               if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                               $htout .= $monthtextl[$tmtxt];
                            } else {
                               $htout .= "Every year on the: ";
                                $twa = $row["esty2dp"];
                                $htout .= $dptxt[$twa]."&nbsp;";
                                $twa = $row["esty2wd"];
                                if($row["esty2wd"] > 7) {
                                    $htout .= $wdtxt[$twa];
                                } else {
                                    $htout .= $evddtl[$twa];
                                }
                                $htout .= "&nbsp;in&nbsp;";
                               $tmtxt = $row["esty2m"];
                               if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                               $htout .= $monthtextl[$tmtxt];
                            }
                        }
                        if($row["ese"] == 0) {
                            $htout .= " Series has no end date.";
                        } else {
                            if($row["ese"] == 1) {
                                $htout .= " Series will end after ".$row["eseaoint"]." occurances.";
                            } else {
                               $tmtxt = $row["esem"];
                               if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                               $htout .= " Series will end after the ".$row["esed"].".".$monthtextl[$tmtxt].".".$row["esey"];
                            }
                        }
                    }
                    $htout .= "<br><br>\n";
                }
                if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
                    $htout .= "<b>Full Description:</b> \n";
                    $htout .= nl2br(($row["description"]));
                    $htout .= "<br><br>";
                }
                if(($checkdisp == true && $curcalcfg["deirem"] == 1) || ($checkdisp == false)) {
                    if($GLOBALS["allowreminders"] == 1) {
                        $htout .= "<b>Reminder Subscriptions: </b>\n";
                        if($row["remsuballow"]==1) {
                            $htout .= "Yes, Level: ";
                            if($row["remsublevel"]==0) {
                                $htout .= "Anyone ";
                            } else {
                                $htout .= "Registered Users Only";
                            }
                        } else {
                            $htout .= "No";
                        }

                        $sqlstrx = "select tuid from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$row["calid"]."'";
                        $queryx = mysql_query($sqlstrx) or die("Cannot query cal ini<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrx."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        $rowx = mysql_fetch_array($queryx);
                        $calowner = $rowx["tuid"];

                        if($user->gsv("isadmin")=="1" || $row["uid"] == $user->gsv("cuid") || $row["uid"] == $calowner) {

                            $htout .= "<br><br><b>Reminder: </b><br>\n";
                            if($row["sendreminder"] == 0) {
                                $htout .= "None";
                            } else {
                                $htout .= getreminder($row["uid"],$user->gsv("curcalid"),$evid);
                            }
                        }
                    }
                    $htout .= "<br><br>\n";
                }
                if(($checkdisp == true && $curcalcfg["deiext"] == 1) || ($checkdisp == false)) {
                    $htout .= "<b>Extents:</b><br>\n";
                    $htout.=getextents($evid);
                }
            }
            @mysql_free_result($query1);
            return $htout;
    }


# function returns the event as html for email and the showevent page

function geteventhtml($evid,$remsubconf=0) {
#return("test");
#ini_set("error_reporting","E_ALL");

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$evddt,$evddtl;
    global $daybeginhour,$dayendhour,$dayhourcount;
    global $user,$curcalcfg,$fsize;
    global $langcfg;

    $checkdisp = false;
    if($user->gsv("isadmin")!="1") {
#        if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
        if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
            $checkdisp = true;
        }
    }

    $dptxt[1] = "First";
    $dptxt[2] = "Second";
    $dptxt[3] = "Third";
    $dptxt[4] = "Fourth";
    $dptxt[5] = "Last";

    $wdtxt[8] = "Weekday";
    $wdtxt[9] = "Weekend day";
    $wdtxt[10] = "Day";

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where evid=".$evid;
    $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);

        $evout .= "<table border=\"1\" width=\"100%\">\n";
        if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
            $evout .= "<tr>\n";
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">Title:</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            $evout .= (($row["title"]));
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
        }

        if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
            $evout .= "<tr>\n";
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">".$curcalcfg["gcscoif_subtitletxt"]."</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            if(strlen($row["subtitle"])>0) {
                $evout .= (($row["subtitle"]));
            } else {
                $evout .= "&nbsp;";
            }
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
        }
        if(($checkdisp == true && $curcalcfg["deicat"] == 1) || ($checkdisp == false)) {
            $evout .= "<tr>\n";
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">Category:</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            if($row["catid"] != 0) {
    #            $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where ((uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or calid='-2' ) and catid=".$row["catid"];
                $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid=".$row["catid"]." and ((uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or (calid='-2'))";
                $queryc = mysql_query($sqlstrc) or die("Cannot query user cats table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                if($rowc = mysql_fetch_array($queryc)) {
                    $rowc = gmqfix($rowc,1);
                    $evout .= ($rowc["catname"]);
                }
                @mysql_free_result($queryc);
            } else {
                $evout .= "None assigned";
            }
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
        }
        if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
            $evout .= "<tr>\n";
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">\n";
            if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
                if($row["iseventseries"] != 0) {
                    if($row["estype"] == 1) {
                        $evout .= "Daily, starting on:";
                    } elseif($row["estype"] == 2) {
                        $evout .= "Weekly, starting on:";
                    } elseif($row["estype"] == 3) {
                        $evout .= "Monthly, starting on:";
                    } elseif($row["estype"] == 4) {
                        $evout .= "Yearly, starting on:";
                    }
                } else {
                    $evout .= "Date:";
                }
            } else {
                $evout .= "Date:";
            }
            $evout .= "</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            $tmtxt = $row["startmonth"];
            if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
            $evout .= $row["startday"].".".$monthtextl[$tmtxt].".".$row["startyear"];
            if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
                if($row["iseventseries"] != 0) {

                    $evout .= "<br>";
                    if($row["estype"] == 1) {
                        if($row["estd"] == 1) {
                            if($row["estdint"] == 1) {
                                $evout .= "Every day.";
                            } else {
                                $evout .= "Every ".$row["estdint"]." days.";
                            }
                        } else {
                            $evout .= "Every weekday.";
                        }
                    } elseif($row["estype"] == 2) {

                        if($row["estwint"] == 1) {
                            $evout .= "Every week on:<br>";
                            $have1day = false;
                            for($wa=0;$wa<7;$wa++) {
                                $twa = substr($row["estwd"],$wa,1);
                                if($twa == 1) {
                                    if($have1day == true) {
                                        $evout .= ", ";
                                    }
                                    $evout .= $evddtl[$wa+1];
                                    $have1day = true;
                                }
                            }
                        } else {
                            $evout .= "Every ".$row["estwint"]." weeks on: ";
                            $have1day = false;
                            for($wa=0;$wa<7;$wa++) {
                                $twa = substr($row["estwd"],$wa,1);
                                if($twa == 1) {
                                    if($have1day == true) {
                                        $evout .= ", ";
                                    }
                                    $evout .= $evddtl[$wa+1];
                                    $have1day = true;
                                }
                            }
                        }
                    } elseif($row["estype"] == 3) {
                        if($row["estm"] == 1) {
                            if($row["estm1int"] == 1) {
                                $evout .=$evout .= "Every month on the: ";
                            } else {
                                $evout .= "Every ".$row["estm1int"]." months on the: ";
                            }
                            $evout .= $row["estm1d"];
                        } else {
                            if($row["estm2int"] == 1) {
                                $evout .= "Every month on the: ";
                            } else {
                                $evout .= "Every ".$row["estm2int"]." months on the: ";
                            }
                            $twa = $row["estm2dp"];
                            $evout .= $dptxt[$twa]."&nbsp;";
                            $twa = $row["estm2wd"];
                            if($row["estm2wd"] > 7) {
                                $evout .= $wdtxt[$twa];
                            } else {
                                $evout .= $evddtl[$twa];
                            }
                        }

                    } elseif($row["estype"] == 4) {

                        if($row["esty"] == 1) {
                            $evout .= "Every year on: ".$row["esty1d"].".";
                            $tmtxt = $row["esty1m"];
                            if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                            $evout .= $monthtextl[$tmtxt];
                        } else {
                            $evout .= "Every year on the: ";
                            $twa = $row["esty2dp"];
                            $evout .= $dptxt[$twa]."&nbsp;";
                            $twa = $row["esty2wd"];
                            if($row["esty2wd"] > 7) {
                                $evout .= $wdtxt[$twa];
                            } else {
                                $evout .= $evddtl[$twa];
                            }
                            $evout .= "&nbsp;in&nbsp;";
                            $tmtxt = $row["esty2m"];
                            if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                            $evout .= $monthtextl[$tmtxt];
                        }
                    }
                    if($row["ese"] == 0) {
                        $evout .= "<br>Series has no end date.";
                    } else {
                        if($row["ese"] == 1) {
                            $evout .= "<br>Series will end after ".$row["eseaoint"]." occurances.";
                        } else {
                            $tmtxt = $row["esem"];
                            if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                            $evout .= "<br>Series will end after the ".$row["esed"].".".$monthtextl[$tmtxt].".".$row["esey"];
                        }
                    }
                }
            }
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
        }
        if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
            $evout .= "<tr>\n";
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">\n";
            $evout .= "Time:</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            if($row["isallday"] == 1) {
                $evout .= "This is an all day event\n";
            } else {
                if($curcalcfg["timetype"]==1) {
                    $evout .= "From: ".$row["starthour"].":".$row["startmin"]."&nbsp;&nbsp;To: ".$row["endhour"].":".$row["endmin"];
                } else {
                    $txtstrint = $row["starthour"].$row["startmin"];
                    if($txtstrint < 1200 && $row["starthour"] != "00") {
                        $evout .= "From: ".$row["starthour"].":".$row["startmin"]." AM&nbsp;&nbsp;";
                    } elseif($row["starthour"] == "00") {
                        $evout .= "From: 12:".$row["startmin"]." AM&nbsp;&nbsp;";
                    } else {
                        $txtstrint = (int) $row["starthour"];
                        if($txtstrint > 12) {
                            $txtstrint = $txtstrint-12;
                        }
                        $evout .= "From: ".$txtstrint.":".$row["startmin"]." PM&nbsp;&nbsp;";
                    }
                    $txtstrint = $row["endhour"].$row["endmin"];
                    if($txtstrint < 1200 && $row["endhour"] != "00") {
                        $evout .= "To: ".$row["endhour"].":".$row["endmin"]." AM";
                    } elseif($row["endhour"] == "00") {
                        $evout .= "From: 12:".$row["endmin"]." AM&nbsp;&nbsp;";
                    } else {
                        $txtstrint = (int) $row["endhour"];
                        if($txtstrint > 12) {
                            $txtstrint = $txtstrint-12;
                        }
                        $evout .= "To: ".$txtstrint.":".$row["endmin"]." PM";
                    }
                }
            }
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
        }
        if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
            $evout .= "<tr>\n";
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">Description:</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            $evout .= nl2br(($row["description"]));
            $evout .= "&nbsp;";
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
            $evout .= "<tr>\n";
        }
        if(($checkdisp == true && $curcalcfg["deirem"] == 1) || ($checkdisp == false)) {
            if($GLOBALS["allowreminders"] == 1) {

                $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">Reminder Subscriptions:</th>\n";
                $evout .= "<td width=\"88%\" valign=\"top\">\n";
                if($row["remsuballow"]==1) {
                    $evout .= "Yes, Level: ";
                    if($row["remsublevel"]==0) {
                        $evout .= "Anyone ";
                    } else {
                        $evout .= "Registered Users Only";
                    }
                } else {
                    $evout .= "No";
                }
                $evout .= "</td>\n";
                $evout .= "</tr>\n";

                $sqlstrx = "select tuid from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$row["calid"]."'";
                $queryx = mysql_query($sqlstrx) or die("Cannot query cal ini<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrx."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $rowx = mysql_fetch_array($queryx);
                $calowner = $rowx["tuid"];

                if($row["sendreminder"] != 0 || $row["remsuballow"] != 0) {

                    $evout .= "<tr>\n";
                    $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">Reminder:</th>\n";
                    $evout .= "<td width=\"88%\" valign=\"top\">\n";

                    if(($user->gsv("isadmin")=="1" || $row["uid"] == $user->gsv("cuid") || $row["uid"] == $calowner) && $remsubconf == 0) {

                        $evout .= getreminder($row["uid"],$user->gsv("curcalid"),$evid);

                    } else {
                        $evout .= "Undisclosed recipients";
                    }

                    $evout .= "&nbsp;</td>\n";
                    $evout .= "</tr>\n";

                }
                @mysql_free_result($queryx);

                $evout .= "<tr>\n";
            }
        }

#extents

        if(($checkdisp == true && $curcalcfg["deiext"] == 1) || ($checkdisp == false)) {
            $evout .= "<th align=\"left\" width=\"12%\" valign=\"top\">Extents:</th>\n";
            $evout .= "<td width=\"88%\" valign=\"top\">\n";
            $evout .= getextents($evid);
            $evout .= "</td>\n";
            $evout .= "</tr>\n";
        }


# changes for 1.1.10

# exceptions
                $exceptcount = 0;
                $exceptoutpre = "";
                $exceptoutsuf = "";
                $exceptout = "";
                if($row["uid"]==$user->gsv("cuid") || $user->gsv("isadmin")==1 || $GLOBALS["demomode"]==true) {
                    $caneditev = "";
                } else {
                    $caneditev = "disabled";
                }
                if(($checkdisp == true && $curcalcfg["deiexc"] == 1) || ($checkdisp == false)) {
                    $exceptoutpre .= "<tr>\n";
                    $exceptoutpre .= "<th align=\"left\" width=\"12%\" valign=\"top\">Exceptions:</th>\n";
                    $exceptoutpre .= "<td width=\"88%\" valign=\"top\">\n";

                    $haveanexception = false;
                    $sqlstrevex = "select * from ".$GLOBALS["tabpre"]."_cal_event_exceptions
                    where (evid = '".$evid."') and (calid='".$user->gsv("curcalid")."')
                    order by to_days(CONCAT_WS('-', exyear, exmonth, exday))";

                    $queryevex = mysql_query($sqlstrevex) or die("Cannot query Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrevex."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    while ($rowevex = mysql_fetch_array($queryevex)) {
                        $exceptcount++;
                        if($haveanexception == false) {
                            #$evout .= "\n<span style=\"width: 310; height: 150; overflow: auto\">\n";

                            if($caneditev != "disabled"){
                                $exceptout .= "<table id=\"exceptiontab\" border=\"1\">\n";
                            }
                        }
                        $haveanexception = true;

                        $tmtxt = $rowevex["exmonth"];
                        if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}

                        if($caneditev != "disabled"){
                            $exceptout .= "<tr id=\"".$rowevex["exid"]."\"><td width=\50%\">";
                        }
                        $exceptout .= $rowevex["exday"].".".$monthtextl[$tmtxt].".".$rowevex["exyear"];

                        if($caneditev != "disabled"){
                            $exceptout .= "</td><td width=\50%\">";
                            $exceptout .= "<input id=\"delex-".$rowevex["exid"]."\" type=\"button\" value=\"Delete Exception\" LANGUAGE=\"javascript\" onclick=\"return delexception_onclick('".$rowevex["exid"]."','".$rowevex["exday"].".".$monthtextl[$tmtxt].".".$rowevex["exyear"]."')\">\n";
                            $exceptout .= "</td></tr>\n";
                        } else {
                            $exceptout .= "<br>";
                        }
                    }

                    @mysql_free_result($queryevex);
                    if($haveanexception == true) {
                        if($caneditev != "disabled"){
                            $exceptout .= "</table>\n";
                        }
                        #$evout .= "\n<span style=\"width: 310; height: 150; overflow: auto\">\n";

                        #$evout .= "</span>\n";
                    } else {
                        $exceptout .= "&nbsp;";
                    }
                    $exceptoutsuf .= "</td>\n";
                    $exceptoutsuf .= "</tr>\n";
                }
                if($haveanexception==true) {
                    if($exceptcount>4 && $caneditev != "disabled") {
                        $evout .= $exceptoutpre."\n<span style=\"width: 310; height: 150; overflow: auto\">\n".$exceptout."</span>\n".$exceptoutsuf;
                    }else{
                        $evout .= $exceptoutpre.$exceptout.$exceptoutsuf;
                    }
                }

# changes for 1.1.10


        $evout .= "</table>\n";
        #$evout .= "<br>\n";

    }
    @mysql_free_result($query1);
    #$evout .= "<br>\n";
#ini_set("error_reporting","E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_CORE_WARNING|E_PARSE");
    return($evout);
}



# This function returns an event in text format
function geteventtext($evid,$remsubconf=0) {
#return("test");
#ini_set("error_reporting","E_ALL");

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$evddt,$evddtl;
    global $daybeginhour,$dayendhour,$dayhourcount;
    global $user,$curcalcfg,$fsize;
    global $langcfg;

    $checkdisp = false;
    if($user->gsv("isadmin")!="1") {
#        if(($user->gsv("uname")=="Guest") || ($curcalcfg["userid"] != $user->gsv("cuid"))) {
        if(($curcalcfg["userid"] != $user->gsv("cuid"))) {
            $checkdisp = true;
        }
    }

    $dptxt[1] = "First";
    $dptxt[2] = "Second";
    $dptxt[3] = "Third";
    $dptxt[4] = "Fourth";
    $dptxt[5] = "Last";

    $wdtxt[8] = "Weekday";
    $wdtxt[9] = "Weekend day";
    $wdtxt[10] = "Day";

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where evid=".$evid;
    $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#print $GLOBALS["htmldoctype"];

#    print "<html>\n";
#    print "<head>\n";
#    print "<title>Event Info</title>\n";

#    print "</head>\n";
#    print "<body style=\"color: ".$GLOBALS["btxtcolor"]."\" background=\"".$curcalcfg["gcbgimg"]."\" >\n";
    $evout = "Event Information\n\n";

    while($row = mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        if(($checkdisp == true && $curcalcfg["deititle"] == 1) || ($checkdisp == false)) {
            $evout .= "Title: ";
            $evout .= (mqfix($row["title"]));
            $evout .= "\n";
        }
        if(($checkdisp == true && $curcalcfg["deisub"] == 1) || ($checkdisp == false)) {
            $evout .= $curcalcfg["gcscoif_subtitletxt"].": ";
            if(strlen($row["subtitle"])>0) {
                $evout .= (($row["subtitle"]));
            } else {
                $evout .= "";
            }
            $evout .= "\n";
        }
        if(($checkdisp == true && $curcalcfg["deicat"] == 1) || ($checkdisp == false)) {
            $evout .= "Category: ";
            if($row["catid"] != 0) {
    #            $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where ((uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or calid='-2' ) and catid=".$row["catid"];
                $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid=".$row["catid"]." and ((uid=".$row["uid"]." and (calid = '".$user->gsv("curcalid")."' or calid='0')) or (calid='-2'))";
                $queryc = mysql_query($sqlstrc) or die("Cannot query user cats table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                if($rowc = mysql_fetch_array($queryc)) {
                    $rowc = gmqfix($rowc,1);
                    $evout .= ($rowc["catname"]);
                }
                @mysql_free_result($queryc);
            } else {
                $evout .= "None assigned";
            }
            $evout .= "\n";
        }
        if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
            if($row["iseventseries"] != 0) {
                if($row["estype"] == 1) {
                    $evout .= "Daily, starting on: ";
                } elseif($row["estype"] == 2) {
                    $evout .= "Weekly, starting on: ";
                } elseif($row["estype"] == 3) {
                    $evout .= "Monthly, starting on: ";
                } elseif($row["estype"] == 4) {
                    $evout .= "Yearly, starting on: ";
                }
            } else {
                $evout .= "Date: ";
            }
        } else {
            if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
                $evout .= "Date: ";
            }
        }
        if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
            $tmtxt = $row["startmonth"];
            if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
            $evout .= $row["startday"].".".$monthtextl[$tmtxt].".".$row["startyear"];
            $evout .= "\n";
        }
        if(($checkdisp == true && $curcalcfg["deirep"] == 1) || ($checkdisp == false)) {
            if($row["iseventseries"] != 0) {
                if($row["estype"] == 1) {
                    if($row["estd"] == 1) {
                        if($row["estdint"] == 1) {
                            $evout .= "Every day.";
                        } else {
                            $evout .= "Every ".$row["estdint"]." days.";
                        }
                    } else {
                        $evout .= "Every weekday.";
                    }
                } elseif($row["estype"] == 2) {

                    if($row["estwint"] == 1) {
                        $evout .= "Every week on: ";
                        $have1day = false;
                        for($wa=0;$wa<7;$wa++) {
                            $twa = substr($row["estwd"],$wa,1);
                            if($twa == 1) {
                                if($have1day == true) {
                                    $evout .= ", ";
                                }
                                $evout .= $evddtl[$wa+1];
                                $have1day = true;
                            }
                        }
                    } else {
                        $evout .= "Every ".$row["estwint"]." weeks on: ";
                        $have1day = false;
                        for($wa=0;$wa<7;$wa++) {
                            $twa = substr($row["estwd"],$wa,1);
                            if($twa == 1) {
                                if($have1day == true) {
                                    $evout .= ", ";
                                }
                                $evout .= $evddtl[$wa+1];
                                $have1day = true;
                            }
                        }
                    }
                } elseif($row["estype"] == 3) {
                    if($row["estm"] == 1) {
                        if($row["estm1int"] == 1) {
                            $evout .=$evout .= "Every month on the: ";
                        } else {
                            $evout .= "Every ".$row["estm1int"]." months on the: ";
                        }
                        $evout .= $row["estm1d"];
                    } else {
                        if($row["estm2int"] == 1) {
                            $evout .= "Every month on the: ";
                        } else {
                            $evout .= "Every ".$row["estm2int"]." months on the: ";
                        }
                        $twa = $row["estm2dp"];
                        $evout .= $dptxt[$twa]." ";
                        $twa = $row["estm2wd"];
                        if($row["estm2wd"] > 7) {
                            $evout .= $wdtxt[$twa];
                        } else {
                            $evout .= $evddtl[$twa];
                        }
                    }

                } elseif($row["estype"] == 4) {

                    if($row["esty"] == 1) {
                        $evout .= "Every year on: ".$row["esty1d"].".";
                        $tmtxt = $row["esty1m"];
                        if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                        $evout .= $monthtextl[$tmtxt];
                    } else {
                        $evout .= "Every year on the: ";
                        $twa = $row["esty2dp"];
                        $evout .= $dptxt[$twa]." ";
                        $twa = $row["esty2wd"];
                        if($row["esty2wd"] > 7) {
                            $evout .= $wdtxt[$twa];
                        } else {
                            $evout .= $evddtl[$twa];
                        }
                        $evout .= " in ";
                        $tmtxt = $row["esty2m"];
                        if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                        $evout .= $monthtextl[$tmtxt];
                    }
                }
                $evout .= "\n";
                if($row["ese"] == 0) {
                    $evout .= "Series has no end date.";
                } else {
                    if($row["ese"] == 1) {
                        $evout .= "Series will end after ".$row["eseaoint"]." occurances.";
                    } else {
                        $tmtxt = $row["esem"];
                        if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
                        $evout .= "Series will end after the ".$row["esed"].".".$monthtextl[$tmtxt].".".$row["esey"];
                    }
                }
            }
            $evout .= "\n";
        }
       if(($checkdisp == true && $curcalcfg["deidate"] == 1) || ($checkdisp == false)) {
            $evout .= "Time: ";
            if($row["isallday"] == 1) {
                $evout .= "This is an all day event";
            } else {
                if($curcalcfg["timetype"]==1) {
                    $evout .= "From: ".$row["starthour"].":".$row["startmin"]."&nbsp;&nbsp;To: ".$row["endhour"].":".$row["endmin"];
                } else {
                    $txtstrint = $row["starthour"].$row["startmin"];
                    if($txtstrint < 1200 && $row["starthour"] != "00") {
                        $evout .= "From: ".$row["starthour"].":".$row["startmin"]." AM  ";
                    } elseif($row["starthour"] == "00") {
                        $evout .= "From: 12:".$row["startmin"]." AM  ";
                    } else {
                        $txtstrint = (int) $row["starthour"];
                        if($txtstrint > 12) {
                            $txtstrint = $txtstrint-12;
                        }
                        $evout .= "From: ".$txtstrint.":".$row["startmin"]." PM  ";
                    }
                    $txtstrint = $row["endhour"].$row["endmin"];
                    if($txtstrint < 1200 && $row["endhour"] != "00") {
                        $evout .= "To: ".$row["endhour"].":".$row["endmin"]." AM";
                    } elseif($row["endhour"] == "00") {
                        $evout .= "From: 12:".$row["endmin"]." AM  ";
                    } else {
                        $txtstrint = (int) $row["endhour"];
                        if($txtstrint > 12) {
                            $txtstrint = $txtstrint-12;
                        }
                        $evout .= "To: ".$txtstrint.":".$row["endmin"]." PM";
                    }
                }
            }
            $evout .= "\n";
       }
       if(($checkdisp == true && $curcalcfg["deidesc"] == 1) || ($checkdisp == false)) {
            $evout .= "Description:\n";
            $evout .= ($row["description"]);
            $evout .= " ";
            $evout .= "\n";
       }
       if(($checkdisp == true && $curcalcfg["deirem"] == 1) || ($checkdisp == false)) {
            if($GLOBALS["allowreminders"] == 1) {

                $evout .= "Reminder Subscriptions: ";
                if($row["remsuballow"]==1) {
                    $evout .= "Yes, Level: ";
                    if($row["remsublevel"]==0) {
                        $evout .= "Anyone ";
                    } else {
                        $evout .= "Registered Users Only";
                    }
                } else {
                    $evout .= "No";
                }
                $evout .= "\n";

                $sqlstrx = "select tuid from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$row["calid"]."'";
                $queryx = mysql_query($sqlstrx) or die("Cannot query cal ini<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrx."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $rowx = mysql_fetch_array($queryx);
                $calowner = $rowx["tuid"];

                if(($user->gsv("isadmin")=="1" || $row["uid"] == $user->gsv("cuid") || $row["uid"] == $calowner) && $remsubconf == 0) {

                    $evout .= "Reminder:\n";
                    if($row["sendreminder"] == 0) {
                        $evout .= "None";
                    } else {
                        $evout .= getremindertxt($row["uid"],$user->gsv("curcalid"),$evid);
                    }
                    $evout .= "\n";
                }
            }
       }
       if(($checkdisp == true && $curcalcfg["deiext"] == 1) || ($checkdisp == false)) {
            $evout .= "Extents:\n\n";
            $evout .= getextentstxt($evid);
            $evout .= "\n";
       }

# changes for 1.1.10

            if(($checkdisp == true && $curcalcfg["deiexc"] == 1) || ($checkdisp == false)) {
                $evout .= "Exceptions:\n\n";

                $haveanexception = false;
                $sqlstrevex = "select * from ".$GLOBALS["tabpre"]."_cal_event_exceptions
                where (evid = '".$evid."') and (calid='".$user->gsv("curcalid")."')
                order by to_days(CONCAT_WS('-', exyear, exmonth, exday))";

                $queryevex = mysql_query($sqlstrevex) or die("Cannot query Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrevex."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                while ($rowevex = mysql_fetch_array($queryevex)) {

                    $haveanexception = true;

                    $tmtxt = $rowevex["exmonth"];
                    if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}

                    $evout .= $rowevex["exday"].".".$monthtextl[$tmtxt].".".$rowevex["exyear"]."\n";

                }

                @mysql_free_result($queryevex);
                $evout .= "\n";
            }

# changes for 1.1.10


    }
    @mysql_free_result($query1);
    return($evout);
}



function getreminder($ruid,$rcid,$revid) {

    $rethtml = "";

#            $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid=".$ruid." and calid = '".$rcid."' and evid=".$revid." order by contyp";
            $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where calid = '".$rcid."' and evid=".$revid." order by contyp,lname,fname";
#print $sqlstrc."<br>";
            $queryc = mysql_query($sqlstrc) or die("Cannot query event reminder contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $amatc = false;
            $amatg = false;
            $amatm = false;
            $amatu = false;
            $amata = false;
            $haveme = false;

            $contyp_c = array();
            $contyp_g = array();
            $contyp_a = array();
            $contyp_u = array();
            $contyp_m = array();
/*
print "cnt: ".count($contyp_c)."<br>";
print "cnt: ".count($contyp_g)."<br>";
print "cnt: ".count($contyp_a)."<br>";
$contyp_c[] =1;
$contyp_g[] =1;
$contyp_a[] =1;
print "cnt: ".count($contyp_c)."<br>";
print "cnt: ".count($contyp_g)."<br>";
print "cnt: ".count($contyp_a)."<br>";
$ttxstr = implode(",",$contyp_a);
$ttxstr = "(".$ttxstr.")";
print "cnt: ".$ttxstr."<br>";
*/
$getremindercount = 0;

            while($rowc = mysql_fetch_array($queryc)) {

                $getremindercount++;
                $rowc = gmqfix($rowc,1);

                $rixval = ", interval: ".$rowc["srval"]." ";
                if($rowc["srval"] == 1) {
                    if($rowc["srint"] == 1) {
                        $rixval .= "minute ";
                    } elseif($rowc["srint"] == 2) {
                        $rixval .= "hour ";
                    } else {
                        $rixval .= "day ";
                    }
                } else {
                    if($rowc["srint"] == 1) {
                        $rixval .= "minutes ";
                    } elseif($rowc["srint"] == 2) {
                        $rixval .= "hours ";
                    } else {
                        $rixval .= "days ";
                    }
                }

                switch ($rowc["contyp"]) {

                    case "C":
                        $contyp_c[0][] = $rowc["conid"];
                        $contyp_c[1][] = $rixval;
                        $contyp_c[2][] = "";
                        break;
                    case "G":
                        $contyp_g[0][] = $rowc["conid"];
                        $contyp_g[1][] = $rixval;
                        $contyp_g[2][] = "";
                        break;
                    case "A":
                        $contyp_a[0][] = $rowc["remid"];
                        $contyp_a[1][] = $rixval;
                        $trethtml = "";
                        $trethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mailto:".($rowc["remail"])."\">".implode(", ",array($rowc["lname"],$rowc["fname"]))."&nbsp;</a>";
                        if($rowc["confirmed"]==1) {
                            $trethtml .= ", Confirmed";
                        } else {
                            $trethtml .= ", Not Confirmed";
                        }
                        if($rowc["approved"]==1) {
                            $trethtml .= ", Approved";
                        } else {
                            $trethtml .= ", Not Approved";
                        }
                        $trethtml .= $rixval."<br>\n";
                        $contyp_a[2][] = $trethtml;

                        break;
                    case "U":
                        $contyp_u[0][] = $rowc["conid"];
                        $contyp_u[1][] = $rixval;
                        $contyp_u[2][] = "";
                        break;
                    case "M":
                        $contyp_m[0][] = $rowc["conid"];
                        $contyp_m[1][] = $rixval;
                        $contyp_m[2][] = "";
                        break;
                }
            }

#            while($rowc = mysql_fetch_array($queryc)) {

#                $rowc = gmqfix($rowc,1);
/*
                $rixval = ", interval: ".$rowc["srval"]." ";
                if($rowc["srval"] == 1) {
                    if($rowc["srint"] == 1) {
                        $rixval .= "minute ";
                    } elseif($rowc["srint"] == 2) {
                        $rixval .= "hour ";
                    } else {
                        $rixval .= "day ";
                    }
                } else {
                    if($rowc["srint"] == 1) {
                        $rixval .= "minutes ";
                    } elseif($rowc["srint"] == 2) {
                        $rixval .= "hours ";
                    } else {
                        $rixval .= "days ";
                    }
                }
*/
                #if($rowc["contyp"] == "M") {

#                    $rethtml .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Event creator".$rixval."<br>\n";

                if(count($contyp_m) > 0) {
                    $getremindercount = 0;
                    $haveme = true;
                    #if($amatm == false) {
                    #    $amatm = true;
                        $rethtml .= "<b>Event Creator:</b><br>\n";
                    #}

                    #$sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid=".$rowc["conid"];
                    $sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid=".$contyp_m[0][0];
                    $querye = mysql_query($sqlstre) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstre."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    while($rowe = mysql_fetch_array($querye)) {
                        $rowe = gmqfix($rowe,1);
                        $rethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mailto:".($rowe["email"])."\">".implode(", ",array($rowe["lname"],$rowe["fname"]))."&nbsp;(".($rowe["uname"]).")</a>&nbsp;";
                        #$rethtml .= $rixval."<br>\n";
                        $rethtml .= $contyp_m[1][$getremindercount]."<br>\n";
                        $getremindercount++;
                    }
                    @mysql_free_result($querye);
                }


                #}elseif($rowc["contyp"] == "C") {
                if(count($contyp_c) > 0) {
                    $getremindercount = 0;

                    #if($amatc == false) {
                    #    $amatc = true;
                        $rethtml .= "<b>Individual Contacts:</b><br>\n";
                    #}
#                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con where uid=".$ruid." and conid = ".$rowc["conid"];
#                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con where conid = ".$rowc["conid"]." order by lname,fname";
                    $extsql = implode(",",$contyp_c[0]);
                    $extsql = " (".$extsql.") ";
                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con where conid in ".$extsql." order by lname,fname";
                    $queryd = mysql_query($sqlstrd) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrd."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    while($rowd = mysql_fetch_array($queryd)) {
                        $rowd = gmqfix($rowd,1);
                        $rethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mailto:".($rowd["email"])."\">".implode(", ",array($rowd["lname"],$rowd["fname"]))."</a>&nbsp;";

                        if($rowd["tel1"] != "") {
                            $rethtml .= "Tel: ".($rowd["tel1"]);
                        } else {
                            $rethtml .= "Tel: Not entered.";
                        }
                        $rethtml .= $contyp_c[1][$getremindercount]."<br>\n";
                        $getremindercount++;
                    }
                    @mysql_free_result($queryd);
                }

                #}elseif($rowc["contyp"] == "G") {
                if(count($contyp_g) > 0) {
                    $getremindercount = 0;
                    #if($amatg == false) {
                    #    $amatg = true;
                        $rethtml .= "<b>Contact Groups:</b><br>\n";
                    #}

                    $extsql = implode(",",$contyp_g[0]);
                    $extsql = " (".$extsql.") ";

                    #$sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where congpid = ".$rowc["conid"]." order by gpname";
                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where congpid in ".$extsql." order by gpname";
#print $sqlstrd."<br>";
                    $queryd = mysql_query($sqlstrd) or die("Cannot query user contact groups table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrd."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    #$rowd = mysql_fetch_array($queryd);

                    while($rowd = mysql_fetch_array($queryd)) {
                        $rowd = gmqfix($rowd,1);

                        $rethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($rowd["gpname"]).$contyp_g[1][$getremindercount]."<br>\n";

                         $sqlstre = "SELECT * FROM ".$GLOBALS["tabpre"]."_user_con left join ".$GLOBALS["tabpre"]."_user_congrp_link on
                        ".$GLOBALS["tabpre"]."_user_con.conid = ".$GLOBALS["tabpre"]."_user_congrp_link.conid WHERE ".$GLOBALS["tabpre"]."_user_congrp_link.congpid = ".$rowd["congpid"]." order by lname,fname";
    #print $sqlstre."<br>";
                        $querye = mysql_query($sqlstre) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstre."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        while($rowe = mysql_fetch_array($querye)) {
                            $rowe = gmqfix($rowe,1);
                            $rethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mailto:".($rowe["email"])."\">".implode(", ",array($rowe["lname"],$rowe["fname"]))."</a>&nbsp;";
                            if($rowe["tel1"] != "") {
                                $rethtml .= "Tel: ".($rowe["tel1"]);
                            } else {
                                $rethtml .= "Tel: Not entered.";
                            }
                            #$rethtml .= $rixval."<br>\n";
                        }
                        @mysql_free_result($querye);
                        $getremindercount++;
                    }
                }
                #}elseif($rowc["contyp"] == "U") {
                if(count($contyp_u) > 0) {
                    $getremindercount = 0;
                    #if($amatu == false) {
                    #    $amatu = true;
                        $rethtml .= "<b>Users:</b><br>\n";
                    #}

                    #$sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid=".$rowc["conid"];

                    $extsql = implode(",",$contyp_u[0]);
                    $extsql = " (".$extsql.") ";

                    $sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid in ".$extsql;
#print $sqlstre."<br>";
                    $querye = mysql_query($sqlstre) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstre."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    while($rowe = mysql_fetch_array($querye)) {
                        $rowe = gmqfix($rowe,1);
                        $rethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mailto:".($rowe["email"])."\">".implode(", ",array($rowe["lname"],$rowe["fname"]))."&nbsp;(".($rowe["uname"]).")</a>&nbsp;";
                        $rethtml .= $contyp_u[1][$getremindercount]."<br>\n";
                        $getremindercount++;
                    }
                    @mysql_free_result($querye);
                }
                #}elseif($rowc["contyp"] == "A") {
                if(count($contyp_a) > 0) {
                    $getremindercount = 0;

                    #if($amata == false) {
                    #    $amata = true;
                        $rethtml .= "<b>Subscribers:</b><br>\n";
                    #}
                    for($conxcnt=0;$conxcnt<count($contyp_a[0]);$conxcnt++) {
                        $rethtml .= $contyp_a[2][$conxcnt];
                    }

/*
                    $rethtml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mailto:".($rowc["remail"])."\">".($rowc["fname"])."&nbsp;".($rowc["lname"])."&nbsp;</a>";
                    if($rowc["confirmed"]==1) {
                        $rethtml .= ", Confirmed";
                    } else {
                        $rethtml .= ", Not Confirmed";
                    }
                    if($rowc["approved"]==1) {
                        $rethtml .= ", Approved";
                    } else {
                        $rethtml .= ", Not Approved";
                    }
                    $rethtml .= $rixval."<br>\n";
*/
                }

                #}


                @mysql_free_result($querye);
                @mysql_free_result($queryd);

#            }


            @mysql_free_result($queryc);


            if($haveme == false) {
                $getremindercount++;
                $getremindercount++;
                $rethtml .= "<br><b>Event creator is not on the list of contacts to receive a reminder for this event.</b>\n";
            }

            if(strlen($rethtml) > 0) {
                if($getremindercount>11) {
                    $rethtml = "A Reminder will be sent to the following:<br>\n"."\n<span style=\"width: 100%; height: 225; overflow: auto\">\n".$rethtml;
                    $rethtml .=  "</span>\n";
                }else{
                    $rethtml = "A Reminder will be sent to the following:<br>\n".$rethtml;
                }
            }

            return $rethtml;


}

function getremindertxt($ruid,$rcid,$revid) {

    $rethtml = "";

            $rethtml .= "A Reminder will be sent to the following:\n";
            $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid=".$ruid." and calid = '".$rcid."' and evid=".$revid." order by contyp";
            $queryc = mysql_query($sqlstrc) or die("Cannot query event reminder contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $amatc = false;
            $amatg = false;
            $amatm = false;
            $amatu = false;
            $amata = false;
            $haveme = false;

            while($rowc = mysql_fetch_array($queryc)) {
                $rowc = gmqfix($rowc,1);

                $rixval = ", interval: ".$rowc["srval"]." ";
                if($rowc["srval"] == 1) {
                    if($rowc["srint"] == 1) {
                        $rixval .= "minute ";
                    } elseif($rowc["srint"] == 2) {
                        $rixval .= "hour ";
                    } else {
                        $rixval .= "day ";
                    }
                } else {
                    if($rowc["srint"] == 1) {
                        $rixval .= "minutes ";
                    } elseif($rowc["srint"] == 2) {
                        $rixval .= "hours ";
                    } else {
                        $rixval .= "days ";
                    }
                }

                if($rowc["contyp"] == "M") {
#                    $rethtml .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Event creator".$rixval."<br>\n";
                    $haveme = true;
                    if($amatm == false) {
                        $amatm = true;
                        $rethtml .= "Event Creator:\n";
                    }

                    $sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid=".$rowc["conid"];
                    $querye = mysql_query($sqlstre) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstre."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    while($rowe = mysql_fetch_array($querye)) {
                        $rowe = gmqfix($rowe,1);
                        $rethtml .= "          ".($rowe["email"]).", ".($rowe["fname"])." ".($rowe["lname"])." (".($rowe["uname"])."), ";
                        $rethtml .= $rixval."\n";
                    }
		    @mysql_free_result($querye);

                }elseif($rowc["contyp"] == "C") {
                    if($amatc == false) {
                        $amatc = true;
                        $rethtml .= "Individual Contacts:\n";
                    }
#                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con where uid=".$ruid." and conid = ".$rowc["conid"];
                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con where conid = ".$rowc["conid"]." order by lname,fname";
                    $queryd = mysql_query($sqlstrd) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrd."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $rowd = mysql_fetch_array($queryd);
                    $rowd = gmqfix($rowd,1);
                    $rethtml .= "     ".($rowd["email"]).", ".($rowd["fname"])." ".($rowd["lname"]).", ";

                    if($rowd["tel1"] != "") {
                        $rethtml .= "Tel: ".($rowd["tel1"]);
                    } else {
                        $rethtml .= "Tel: Not entered.";
                    }
                    $rethtml .= $rixval."\n";


                }elseif($rowc["contyp"] == "G") {
                    if($amatg == false) {
                        $amatg = true;
                        $rethtml .= "Contact Groups:\n";
                    }
#                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where uid=".$ruid." and congpid = ".$rowc["conid"];
                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where congpid = ".$rowc["conid"]." order by gpname";
                    $queryd = mysql_query($sqlstrd) or die("Cannot query user contact groups table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrd."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $rowd = mysql_fetch_array($queryd);
                    $rowd = gmqfix($rowd,1);

                    $rethtml .= "     ".($rowd["gpname"]).$rixval."\n";

#                    $sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_con where uid=".$ruid." and congp = ".$rowd["congpid"];
                    #$sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_con where congp = ".$rowd["congpid"];
                     $sqlstre = "SELECT * FROM ".$GLOBALS["tabpre"]."_user_con left join ".$GLOBALS["tabpre"]."_user_congrp_link on
                    ".$GLOBALS["tabpre"]."_user_con.conid = ".$GLOBALS["tabpre"]."_user_congrp_link.conid WHERE ".$GLOBALS["tabpre"]."_user_congrp_link.congpid = ".$rowd["congpid"]." order by lname,fname";
                    $querye = mysql_query($sqlstre) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstre."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    while($rowe = mysql_fetch_array($querye)) {
                        $rowe = gmqfix($rowe,1);
                        $rethtml .= "     ".($rowe["email"]).", ".($rowe["fname"])." ".($rowe["lname"]).", ";
                        if($rowe["tel1"] != "") {
                            $rethtml .= "Tel: ".($rowe["tel1"]);
                        } else {
                            $rethtml .= "Tel: Not entered.";
                        }
                        $rethtml .= $rixval."\n";
                    }
                }elseif($rowc["contyp"] == "U") {
                    if($amatu == false) {
                        $amatu = true;
                        $rethtml .= "Users:\n";
                    }
                    $sqlstre = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid=".$rowc["conid"];
                    $querye = mysql_query($sqlstre) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstre."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    while($rowe = mysql_fetch_array($querye)) {
                        $rowe = gmqfix($rowe,1);
                        $rethtml .= "     ".($rowe["email"]).", ".($rowe["fname"])." ".($rowe["lname"])." (".($rowe["uname"]).")";
                        $rethtml .= $rixval."\n";
                    }
                }elseif($rowc["contyp"] == "A") {
                    if($amata == false) {
                        $amata = true;
                        $rethtml .= "Subscribers:\n";
                    }
                    $rethtml .= "     ".($rowc["remail"]).", ".($rowc["fname"])." ".($rowc["lname"]);
                    if($rowc["confirmed"]==1) {
                        $rethtml .= ", Confirmed";
                    } else {
                        $rethtml .= ", Not Confirmed";
                    }
                    if($rowc["approved"]==1) {
                        $rethtml .= ", Approved";
                    } else {
                        $rethtml .= ", Not Approved";
                    }
                    $rethtml .= $rixval."\n";
                }
                @mysql_free_result($querye);
                @mysql_free_result($queryd);

            }
            @mysql_free_result($queryc);
            if($haveme == false) {
                $rethtml .= "\nEvent creator is not on the list of contacts to receive a reminder for this event.\n";
            }

            return $rethtml;


}

function showconflict($curevent,$eventlist) {

    global $weekstartonmonday,$daytext,$monthtext,$daytextl,$monthtextl,$evddt,$evddtl;
    global $daybeginhour,$dayendhour,$dayhourcount;
    global $user,$curcalcfg,$fsize;
    global $langcfg;

print $GLOBALS["htmldoctype"];

            print "<html>\n";
            print "<head>\n";
            print "<title>Event Collision</title>\n";
            ?>
            <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
            <!--
                function evsave_onclick() {
                        eevent.func.value="savecollision";
                        eevent.submit();
                }

                function eved_onclick() {
                        eevent.func.value="editevent";
                        eevent.submit();
                }

                function evdel_onclick() {
                    if(confirm("Are you sure you wish to discard this event?") == true) {
                            eevent.func.value="deleteevent";
                            eevent.submit();
                    }
                }
            //-->
            </SCRIPT>
            <?php
            print "</head>\n";
            print "<body ".$GLOBALS["calbodystyle"]." >\n";
            print "<h1>Event Collision</h1>\n";
            print "<h3>The event you have entered collides with other events.</h3>\n";
            print "<br><h4><u>Event entered</u></h4>\n";

            $nextid = showeventcollision($curevent,$eventlist,-1);

            print "<form method=\"".$GLOBALS["postorget"]."\" name=\"eevent\" id=\"eevent\" action=\"".$GLOBALS["idxfile"]."\">\n";
            print "<input type=\"hidden\" name=\"evid\" id=\"evid\" value=\"".$curevent."\">\n";
            print "<input type=\"hidden\" name=\"func\" id=\"func\" value=\"\">\n";
            print "<table border=\"1\" width=\"50%\">\n";
            print "<tr>\n";
            print "<td width=\"20%\" align=\"center\">\n";
            print "<INPUT type=\"button\" value=\"Edit Event\" id=\"eved\" name=\"eved\" LANGUAGE=javascript onclick=\"return eved_onclick()\">\n";
            print "</td><td width=\"33%\" align=\"center\">\n";
            print "&nbsp;<INPUT type=\"button\" value=\"Discard (delete) Event\" id=\"evdel\" name=\"evdel\" LANGUAGE=javascript onclick=\"return evdel_onclick()\">&nbsp;&nbsp;\n";
            print "</td><td width=\"34%\" align=\"center\">\n";
            if($curcalcfg["collisionsave"] == 1 || $user->gsv("isadmin") == 1) {
                print "&nbsp;&nbsp;<INPUT type=\"button\" value=\"Save Conflicting Event\" id=\saveconflict\" name=\"saveconflict\" LANGUAGE=javascript onclick=\"return evsave_onclick()\">&nbsp;&nbsp;\n";
            }else{
                print "&nbsp;";
            }
            print "</td>\n";
            print "</tr>\n";
            print "</table>\n";
            print "</form>\n";

            print "<br><h4><u>Collisions</u></h4>";
            for($xzc1=1;$xzc1<=$eventlist[0][0];$xzc1++) {
                $nextid = showeventcollision($eventlist["id"][$xzc1],$eventlist,$xzc1);
#                if($nextid >0) {
#                    $xzc1 = $nextid;
#                }
            }
            print "<br>\n";
            include($GLOBALS["CLPath"]."/include/footer.php");
            exit();

}
?>

