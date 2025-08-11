<?php

function savegrpconlink($tconid,$tconpos,$tgrpid) {
    global $user;

    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_congrp_link values ('',".$user->gsv("cuid").",".$tconid.",".$tgrpid.")";
    mysql_query($sqlstr) or die("Cannot insert to user contacts group link table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

}

function savecongrplink($tgrpid,$tconpos,$tconid) {
    global $user;

    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_congrp_link values ('',".$user->gsv("cuid").",".$tconid.",".$tgrpid.")";
    mysql_query($sqlstr) or die("Cannot insert to user contacts group link table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

}

function deletecontactgroup($tgpid,$tconpos) {
    global $user;

    if($tgpid != "") {

        $sqlstr = "select count(*) as concnt from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$user->gsv("cuid")." and congpid = ".$tgpid;
        $query1 = mysql_query($sqlstr) or die("Cannot select user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);

        if($row["concnt"] > 0) {

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$user->gsv("cuid")." and congpid = '".$tgpid."'";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from user contacts group link table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where congpid = '".$tgpid."'";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from user contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where contyp = 'G' and conid = ".$tgpid;
            mysql_query($sqlstr) or die("Cannot delete from event reminders table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }

        @mysql_free_result($query1);
    }

}
function deletecontact($tconid,$tconpos) {
    global $user;


    if($tconid != "") {

        $sqlstr = "select count(*) as concnt from ".$GLOBALS["tabpre"]."_user_con where uid = ".$user->gsv("cuid")." and conid = ".$tconid;
        $query1 = mysql_query($sqlstr) or die("Cannot select user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);

        if($row["concnt"] > 0) {

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con where uid = ".$user->gsv("cuid")." and conid = ".$tconid;
            mysql_query($sqlstr) or die("Cannot delete from user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where conid = ".$tconid;
            mysql_query($sqlstr) or die("Cannot delete from user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where contyp = 'C' and conid = ".$tconid;
            mysql_query($sqlstr) or die("Cannot delete from event reminders table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }
        @mysql_free_result($query1);
    }
}

function checkforevents($eday, $emonth, $eyear,$ehour,$emin,$eview,$chkfec=1) {
// day, month, year, hour, minute
    global $weekstartonmonday;
    global $user,$curcalcfg;
    global $langcfg,$evbgcol,$evfgcol;
    global $cldb,$bugrep;

#debug
#echo "<br>\n check single events for: ".$eday."-".$emonth."-".$eyear." from $eview<br>\n";

    $eventcnt = 0;
    $eventar = array();
    $sortar = array();
    $haveevent = false;

// Private cal select
    if($curcalcfg["caltype"]==2) {
        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
        uid=".$user->gsv("cuid")." and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";
    } elseif($curcalcfg["caltype"]==1){

// Public cal select

        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";

    } elseif($curcalcfg["caltype"]==0){

// open cal select

        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";

    }


    #$query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    if(!$cldb->set_sqlstring($sqlstr,$sqlres1)) {
	enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres1,true);
    }
    if(!$cldb->execute($sqlres1,$rowcount1)) {
	enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres1,true);
    }
    $eoq1 = false;

#debug
#echo "<br>\n select finished <br>\n";

        #while($row = mysql_fetch_array($query1)) {

        while($cldb->get_row($sqlres1,$row,$eoq1)) {
            #$row = gmqfix($row,1);
            $eventcnt++;
                $eventar[$eventcnt]["id"] = $row["evid"];
                $eventar[$eventcnt]["uname"] = "";
                $eventar[$eventcnt]["email"] = "";

                if($curcalcfg["gcscoyn_dispevcr"]==1) {
                    $tsql="select uname,email from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["uid"];
                    #$tquery1 = mysql_query($tsql) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$tsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    if(!$cldb->set_sqlstring($tsql,$sqlres2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }
                    if(!$cldb->execute($sqlres2,$rowcount2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }
                    $eoq2 = false;

                    if($rowcount2 !== 1) {
                        enderror("User table error",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }

                    #while($trow1 = mysql_fetch_array($tquery1)) {
                    while($cldb->get_row($sqlres2,$trow1,$eoq2)) {
                        #$trow1 = gmqfix($trow1,1);
                        $eventar[$eventcnt]["uname"] = $trow1["uname"];
                        $eventar[$eventcnt]["email"] = $trow1["email"];
                    }
                    #@mysql_free_result($tquery1);
                    $cldb->release($sqlres2);
                }

                if($row["isallday"] == 1) {
                    $eventar[$eventcnt]["isallday"] = "1";
                    $eventar[$eventcnt]["sorttime"] = "0";
                    $sortar[$eventcnt] = "0";
                    $eventar[$eventcnt]["starttimet"] = "";
                    $eventar[$eventcnt]["endtimet"] = "";
                } else {
                    $eventar[$eventcnt]["isallday"] = "0";
                    $eventar[$eventcnt]["sorttime"] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];
                    $sortar[$eventcnt] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];


                    if($curcalcfg["timetype"]==1) {
                        $eventar[$eventcnt]["starttimet"] = $row["starthour"].":".$row["startmin"];
                        $eventar[$eventcnt]["endtimet"] = $row["endhour"].":".$row["endmin"];
                    } else {

                        $eventar[$eventcnt]["starttimet"] = date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990));
                        $eventar[$eventcnt]["endtimet"] = date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990));
                    }


                }
                if(strlen(($row["subtitle"]))>0) {$subtt=$curcalcfg["gcscoif_subtitletxt"]." ".($row["subtitle"]);} else {$subtt="";}

                $eventar[$eventcnt]["title"] = ($row["title"]);
                $eventar[$eventcnt]["subtitle"] = $subtt;
                $eventar[$eventcnt]["sendreminder"] = $row["sendreminder"];
                $eventar[$eventcnt]["iseventseries"] = $row["iseventseries"];
                $eventar[$eventcnt]["remsuballow"] = $row["remsuballow"];
                $eventar[$eventcnt]["conflict"] = 0;
                if($curcalcfg["collisioncheck"] == 1) {
                    if($row["isallday"] != 1 || $curcalcfg["allcollisioncheck"] == 1) {
                        if($chkfec==1) {
                            $conflict = checkforconflict($eventar[$eventcnt]["id"],$eday, $emonth, $eyear);
                            if($conflict[0][0] > 0) {
                                $eventar[$eventcnt]["conflict"] = 1;
                            } else {
                                $eventar[$eventcnt]["conflict"] = 0;
                            }
                        } else {
                            $eventar[$eventcnt]["conflict"] = 0;
                        }
                    }
                }
                $eventar[$eventcnt]["description"] = ($row["description"]);
                if($row["catid"] != 0) {
                    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid = ".$row["catid"];
                    #$query2 = mysql_query($sqlstr) or die("Cannot query user categories table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    #$row2 = mysql_fetch_array($query2);
                    #$row2 = gmqfix($row2,1);

                    if(!$cldb->set_sqlstring($sqlstr,$sqlres2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }
                    if(!$cldb->execute($sqlres2,$rowcount2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }

                    if($rowcount2 !== 1) {
                        #enderror("Category table error",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                        if($eview == "Minical") {
                            $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["mcdwecellcolor"];
                        } elseif($eview == "Year") {
                            $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["yvdwecellcolor"];
                        } else {
                            $eventar[$eventcnt]["catcolorbg"] = "";
                        }
                        $eventar[$eventcnt]["catcolortext"] = "black";
                    } else {

                        $eoq2 = false;
                        if(!$cldb->get_row($sqlres2,$row2,$eoq2)) {
                            enderror("Category table error",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                        }

                        $eventar[$eventcnt]["catcolorbg"] = $row2["catcolorbg"];
                        if($row2["catcolortext"] == "") {
                            $eventar[$eventcnt]["catcolortext"] = "black";
                        } else {
                            $eventar[$eventcnt]["catcolortext"] = $row2["catcolortext"];
                        }

                        if($row2["catcolorbg"] == "") {
                            if($eview == "Minical") {
                                $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["mcdwecellcolor"];
                            } elseif($eview == "Year") {
                                $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["yvdwecellcolor"];
                            } else {
                                $eventar[$eventcnt]["catcolorbg"] = "";
                            }
                        }
                    }
                    $cldb->release($sqlres2);




                    #@mysql_free_result($query2);

                } else {

                    if($eview == "Minical") {
                        $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["mcdwecellcolor"];
                    } elseif($eview == "Year") {
                        $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["yvdwecellcolor"];
                    } else {
                        $eventar[$eventcnt]["catcolorbg"] = "";
                    }
                    $eventar[$eventcnt]["catcolortext"] = "black";
                }

        }

        #@mysql_free_result($query1);

        if(!$eoq1 == true) {
            enderror("Possible database error in events table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres1,true);
        }

        $cldb->release($sqlres1);

//        $eventar[0][0] = $eventcnt;
//        return $eventar;


#debug
#echo "<br>\n check series events for: ".$eday."-".$emonth."-".$eyear." from $eview<br>\n";


// Private cal select
    if($curcalcfg["caltype"]==2) {
$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where t.pending = 0 and (t.iseventseries=1 and t.uid=".$user->gsv("cuid")." and t.calid='".$user->gsv("curcalid")."' and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$eyear."-".$emonth."-".$eday."'))
and ((t.ese = 2 and to_days('".$eyear."-".$emonth."-".$eday."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or
(t.ese=0) or (t.ese=1 and to_days('".$eyear."-".$emonth."-".$eday."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";

    } elseif($curcalcfg["caltype"]==1){

// Public cal select
$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where t.pending = 0 and (t.iseventseries=1 and t.calid='".$user->gsv("curcalid")."' and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$eyear."-".$emonth."-".$eday."'))
and ((t.ese = 2 and to_days('".$eyear."-".$emonth."-".$eday."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or
(t.ese=0) or (t.ese=1 and to_days('".$eyear."-".$emonth."-".$eday."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";

    } elseif($curcalcfg["caltype"]==0){

// open cal select
$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where t.pending = 0 and (t.iseventseries=1 and t.calid='".$user->gsv("curcalid")."' and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$eyear."-".$emonth."-".$eday."'))
and ((t.ese = 2 and to_days('".$eyear."-".$emonth."-".$eday."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or
(t.ese=0) or (t.ese=1 and to_days('".$eyear."-".$emonth."-".$eday."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";
    }
        #$query1 = mysql_query($sqlstr) or die("Cannot query calendar series in events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    if(!$cldb->set_sqlstring($sqlstr,$dbquery1)) {
	enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$dbquery1,true);
    }
    if(!$cldb->execute($dbquery1,$rowcount1)) {
	enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$dbquery1,true);
    }
    $eoq1 = false;


        #while($row = mysql_fetch_array($query1)) {

#debug
#echo "<br>\n select finished <br>\n";

        $endint = 0;
        while($cldb->get_row($dbquery1,$row,$eoq1)) {
        #while($row = mysql_fetch_array($query1)) {
            #$row = gmqfix($row,1);
            #print "found event series<br>";
            $haveevent = false;
            $xuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
            $xuts2 = mktime(0,0,0,$row["startmonth"],$row["startday"],$row["startyear"]);
            $xdinf = getdate($xuts1);
            $xsdinf = getdate($xuts2);

#debug
#echo "<br>\n in loop <br>\n";


            if($xuts1 >= $xuts2) {
# this must now be true because of the new select statements
// is passed date >= check date (event)
                if($row["estype"] == 1) {
// daily

                    if($row["ese"] == 1) {

#debug
#echo "<br>\n  have day event <br>\n";

// end interval
                        $endint = $row["eseaoint"];

                        if($row["estd"] == 1) {
// every day interval
                            #if(((datediff("d", $xuts2,$xuts1)) % ($row["estdint"])) == 0) {
                            #if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0 || ($row["estdint"] - (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"]))) < 1) {
                            if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) <= 0.9 || (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0) {
                                if( ((datediff("d", $xuts2,$xuts1)) / $row["estdint"] ) < $endint) {
                                    $haveevent = true;
                                    /*
                                    $GLOBALS["bugrep"] = "CKD: ".$eday.$emonth.$eyear."
                                    <br>CKDX: ".$xuts1."
                                    <br>CKDR: ".date("d.m.Y",$xuts1)."
                                    <br>EVD: ".$row["startday"].$row["startmonth"].$row["startyear"]."
                                    <br>EVDX: ".$xuts2."
                                    <br>EVDR: ".date("d.m.Y",$xuts2)."
                                    <br>estdint: ".$row["estdint"];
                                    */
                                }
                            }

                        } elseif($xdinf["wday"] > 0 && $xdinf["wday"] < 6) {
// every week day
                            if( (datediff("d", $xuts2,$xuts1)) < $endint) {
                                $haveevent = true;
                            }

                        }

                    } elseif($row["ese"] == 2) {
#debug
#echo "<br>\n end on date <br>\n";

// end on a certain date
                        $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);

                        if($xuts1 <= $xuts3) {

                            if($row["estd"] == 1) {

#debug
#echo "<br>\n  every day <br>\n";

    // interval

$tnum = datediff("d", $xuts2,$xuts1);
$tnum1 = $row["estdint"];

#debug
#echo "<br>\n  checking dates <br>\n";

                                #if(((datediff("d", $xuts2,$xuts1)) % ($row["estdint"])) == 0) {
                                if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0 || ($row["estdint"] - (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"]))) < 1) {

#debug
#echo "<br>\n  have event <br>\n";

                                    $haveevent = true;

                                } else {
#debug
#echo "<br>\n  noevent <br>\n";

                                }

                            } elseif($xdinf["wday"] > 0 && $xdinf["wday"] < 6) {
    // every day
                                $haveevent = true;
                            }
                        }

                    } else {
// no end
                        if($row["estd"] == 1) {
// interval
                            #if(((datediff("d", $xuts2,$xuts1)) % ($row["estdint"])) == 0) {
                            if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0 || ($row["estdint"] - (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"]))) < 1) {
                                    $haveevent = true;

/*                                    $GLOBALS["bugrep"] = "CKD: ".$eday.$emonth.$eyear."
                                    <br>CKDX: ".$xuts1."
                                    <br>CKDR: ".date("d.m.Y",$xuts1)."
                                    <br>EVD: ".$row["startday"].$row["startmonth"].$row["startyear"]."
                                    <br>EVDX: ".$xuts2."
                                    <br>EVDR: ".date("d.m.Y",$xuts2)."
                                    <br>estdint: ".$row["estdint"];
*/
                            }

                        } elseif($xdinf["wday"] > 0 && $xdinf["wday"] < 6) {
// every day
                            $haveevent = true;
                        }
                    }

                } elseif($row["estype"] == 2) {
// weekly
                    if($xdinf["wday"] == 0) {
                        $wdgt = 7;
                    } else {
                        $wdgt = $xdinf["wday"];
                    }
                    $wdgt--;
// check week array
                    if(substr($row["estwd"],$wdgt,1) == "1") {

                        if($row["ese"] == 1) {
    // end interval
                            $endint = $row["eseaoint"];
                            #if(((datediff("w", $xuts2,$xuts1)) % ($row["estwint"])) == 0) {
                            if((fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"])) == 0 || ($row["estwint"] - (fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"]))) < 1) {
    // interval
                                if( ((datediff("w", $xuts2,$xuts1)) / $row["estwint"] ) < $endint) {
    // end occur
                                    $haveevent = true;
                                }
                            }
                        } elseif($row["ese"] == 2) {
    // end on a certain date
                            $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                            if($xuts1 <= $xuts3) {
                                #if(((datediff("w", $xuts2,$xuts1)) % ($row["estwint"])) == 0) {
                                if((fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"])) == 0 || ($row["estwint"] - (fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"]))) < 1) {
                                    $haveevent = true;
                                }
                            }
                        } else {
    // no end
                            #if(((datediff("w", $xuts2,$xuts1)) % ($row["estwint"])) == 0) {
                            if((fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"])) == 0 || ($row["estwint"] - (fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"]))) < 1) {
                                $haveevent = true;
                            }
                        }
                    } // day not in week array

                } elseif($row["estype"] == 3) {
// monthly

// Monthly type 1
                    if($row["estm"] == 1) {

                        $mint = $row["estm1int"];


                        $xuts4 = mktime(0,0,0,$emonth,$eday,$eyear);
                        $xuts4 = dateadd("d",1,$xuts4);
                        $dtinf4 = getdate($xuts4);

                        if($xdinf["mon"] != $dtinf4["mon"]) {$islastday = 1;} else {$islastday = 0;}
                        if($row["estm1d"] > 28 ) {$eild = 1;} else {$eild = 0;}
                        $xkd3 = date("Y-m-d",mktime(0,0,0,$emonth,$row["estm1d"],$eyear));
                        $xkd4 = mktime(0,0,0,$emonth,$row["estm1d"],$eyear);
                        $xkdinf = getdate($xkd4);
                        if($xkd3 == "1970-01-01" || $xkdinf["mon"] != $xdinf["mon"]) {$okild = 1;} else {$okild = 0;}

                        if(($row["estm1d"] == $xdinf["mday"]) || ($eild == 1 && $islastday == 1 && $okild == 1)) {
// first check, is day the same, or if
// the day falls on 29 - 31,
// is this the last day of month
                            $xuts4 = mktime(0,0,0,$row["startmonth"],1,$row["startyear"]);
                            $dtinf4 = getdate($xuts4);
                            $ckint = 0;

                            if($row["ese"] == 1) {
// event end after so many
                                while($xuts4 <= $xuts1 && $ckint <= $row["eseaoint"]) {
                                    $ckint++;
//                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"]) && ($ckint <= $row["eseaoint"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }

                            } elseif($row["ese"] == 2) {
// end after date
                                $eoint = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                $xuts5 = mktime(0,0,0,$emonth,$row["estm1d"],$eyear);
                                if($xuts5 <= $eoint) {
                                    while($xuts4 <= $xuts1) {
                                        if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                            $haveevent = true;
                                            break;
                                        }
                                        $xuts4 = dateadd("m",$mint,$xuts4);
                                        $dtinf4 = getdate($xuts4);
                                    }
                                }

                            } else {
//no end
                                while($xuts4 <= $xuts1) {
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }
                            }
                        }

                    } else {
// Month type 2
// same day pos
// every so many mnths
                        $mint = $row["estm2int"];


                        $yuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
//                            $yuts2 = mktime(0,0,0,$row["esty2m"],1,$eyear);

                        $ydinf1 = getdate($yuts1);
//                            $ydinf2 = getdate($yuts2);

                        $wdc = array();
                        $wddc = 0;
                        $wedc = 0;


                        $fyear=$eyear;
                        $fmonth=$emonth;
                        $fday=$eday;

                        $cuts = mktime(0,0,0,$fmonth,$fday,$fyear);

//                            $zuts = dateadd("yyyy",1,$cuts);
//                            $zxfdate = getdate($zuts);

                        $xfuncdate = getdate($cuts);
                        $fdow = $xfuncdate["wday"];
                        $xfdow = $fdow;
                        $rfdow = $fdow;
                        if($fdow==0) {$fdow=7;}
                        if($fdow < 6) {$isweekday = 1;} else {$isweekday = 0;}
                        $zfcday = 1;
                        $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                        $zfuncdate = getdate($tuts);
                        $weekdaypos = 0;
                        $weekdayposcnt = 0;
                        $islastpos = 1;
                        $islastposcnt = 0;
                        $wddnum = 0;
                        $wednum = 0;
                        $islastwe = 1;
                        $islastwd = 1;

                        while(($zfuncdate["mon"] == $xfuncdate["mon"])) {
                            if(($zfuncdate["wday"] == $rfdow) && ($zfuncdate["mday"] <= $xfuncdate["mday"])) {
                                $weekdaypos++;
                                $weekdayposcnt++;
                            }
                            if($zfuncdate["mday"] <= $xfuncdate["mday"]) {
                                if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                    $wednum++;
                                } else {
                                    $wddnum++;
                                }
                            }


                            if($zfuncdate["mday"] > $xfuncdate["mday"]) {
                                if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                    $islastwe = 0;
                                } else {
                                    $islastwd = 0;
                                }
                                if($zfuncdate["wday"] == $rfdow) {
                                    $islastpos = 0;
                                    $islastposcnt++;
                                }
                            }

                            $zfcday++;
                            $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                            $zfuncdate = getdate($tuts);
                        }

                        $xuts4 = mktime(0,0,0,$emonth,$eday,$eyear);
                        $xuts4 = dateadd("d",1,$xuts4);
                        $dtinf4 = getdate($xuts4);
                        if($xdinf["mon"] != $dtinf4["mon"]) {$islastday = 1;} else {$islastday = 0;}


                        if(($row["estm2dp"] == 5 && $islastpos == 1 && $fdow == $row["estm2wd"]) ||
                           ($row["estm2dp"] == $weekdaypos && $fdow == $row["estm2wd"]) ||
                           ($row["estm2dp"] == $wednum && $row["estm2wd"] == 9 && $isweekday == 0 && $row["estm2dp"] < 5) ||
                           ($row["estm2dp"] == $wddnum && $row["estm2wd"] == 8 && $isweekday == 1 && $row["estm2dp"] < 5) ||
                           ($row["estm2dp"] == 1 && $row["estm2wd"] == 10 && $eday == "01") ||
                           ($row["estm2dp"] == 1 && $row["estm2wd"] == 9 && $wednum == 1 && $isweekday == 0) ||
                           ($row["estm2dp"] == 1 && $row["estm2wd"] == 8 && $wddnum == 1 && $isweekday == 1) ||
                           ($row["estm2dp"] == 5 && $row["estm2wd"] == 10 && $islastday == 1) ||
                           ($row["estm2dp"] == 5 && $row["estm2wd"] == 9 && $islastwe == 1 && $isweekday == 0) ||
                           ($row["estm2dp"] == 5 && $row["estm2wd"] == 8 && $islastwd == 1 && $isweekday == 1)) {

                            $xuts4 = mktime(0,0,0,$row["startmonth"],1,$row["startyear"]);
                            $dtinf4 = getdate($xuts4);
                            $ckint = 0;

                            if($row["ese"] == 1) {
// event end after so many
                                while($xuts4 <= $xuts1 && $ckint <= $row["eseaoint"]) {
                                    $ckint++;
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"]) && ($ckint <= $row["eseaoint"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }

                            } elseif($row["ese"] == 2) {
// end after date
                                $eoint = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                $xuts5 = mktime(0,0,0,$emonth,$row["estm1d"],$eyear);
                                if($xuts5 <= $eoint) {
                                    while($xuts4 <= $xuts1) {
                                        if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                            $haveevent = true;
                                            break;
                                        }
                                        $xuts4 = dateadd("m",$mint,$xuts4);
                                        $dtinf4 = getdate($xuts4);
                                    }
                                }

                            } else {
//no end
                                while($xuts4 <= $xuts1) {
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }
                            }

                        }
// end month type 2
                    }



                } elseif($row["estype"] == 4) {
// yearly
                    if($row["esty"] == 1) {
// same day every year
                        if(($row["esty1d"] == $eday) && ($row["esty1m"] == $emonth) && ($row["startyear"] <= $eyear) ) {
                            if($row["ese"] == 1) {
// end interval
                                $endint = $row["eseaoint"];
                                if($eyear < ($row["startyear"] + $endint)) {
                                    $haveevent = true;
                                }

                            } elseif($row["ese"] == 2) {
// end date
                                $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                if($xuts1 <= $xuts3) {
                                    $haveevent = true;
                                }
                            } else {
//no end
                                $haveevent = true;
                            }
                        }

                    } else {
//same day pos
                        if($row["esty2m"] == $emonth) {
// is same month
                            $yuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
                            $yuts2 = mktime(0,0,0,$row["esty2m"],1,$eyear);
                            $ydinf1 = getdate($yuts1);
                            $ydinf2 = getdate($yuts2);
                            $wdc = array();
                            $wddc = 0;
                            $wedc = 0;


                            $fyear=$eyear;
                            $fmonth=$emonth;
                            $fday=$eday;

                            $cuts = mktime(0,0,0,$fmonth,$fday,$fyear);

                            $zuts = dateadd("yyyy",1,$cuts);
                            $zxfdate = getdate($zuts);

                            $xfuncdate = getdate($cuts);
                            $fdow = $xfuncdate["wday"];
                            $xfdow = $fdow;
                            $rfdow = $fdow;
                            if($fdow==0) {$fdow=7;}
                            if($fdow < 6) {$isweekday = 1;} else {$isweekday = 0;}
                            $zfcday = 1;
                            $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                            $zfuncdate = getdate($tuts);
                            $weekdaypos = 0;
                            $weekdayposcnt = 0;
                            $islastpos = 1;
                            $islastposcnt = 0;
                            $wddnum = 0;
                            $wednum = 0;
                            $islastwe = 1;
                            $islastwd = 1;

                            while(($zfuncdate["mon"] == $xfuncdate["mon"])) {
                                if(($zfuncdate["wday"] == $rfdow) && ($zfuncdate["mday"] <= $xfuncdate["mday"])) {
                                    $weekdaypos++;
                                    $weekdayposcnt++;
                                }
                                if($zfuncdate["mday"] <= $xfuncdate["mday"]) {
                                    if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                        $wednum++;
                                    } else {
                                        $wddnum++;
                                    }
                                }


                                if($zfuncdate["mday"] > $xfuncdate["mday"]) {
                                    if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                        $islastwe = 0;
                                    } else {
                                        $islastwd = 0;
                                    }
                                    if($zfuncdate["wday"] == $rfdow) {
                                        $islastpos = 0;
                                        $islastposcnt++;
                                    }
                                }

                                $zfcday++;
                                $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                                $zfuncdate = getdate($tuts);
                            }

                            $xuts4 = mktime(0,0,0,$emonth,$eday,$eyear);
                            $xuts4 = dateadd("d",1,$xuts4);
                            $dtinf4 = getdate($xuts4);
                            if($xdinf["mon"] != $dtinf4["mon"]) {$islastday = 1;} else {$islastday = 0;}


                            if(($row["esty2dp"] == 5 && $islastpos == 1 && $fdow == $row["esty2wd"]) ||
                               ($row["esty2dp"] == $weekdaypos && $fdow == $row["esty2wd"]) ||
                               ($row["esty2dp"] == $wednum && $row["esty2wd"] == 9 && $isweekday == 0 && $row["esty2dp"] < 5) ||
                               ($row["esty2dp"] == $wddnum && $row["esty2wd"] == 8 && $isweekday == 1 && $row["esty2dp"] < 5) ||
                               ($row["esty2dp"] == 1 && $row["esty2wd"] == 10 && $eday == "01") ||
                               ($row["esty2dp"] == 1 && $row["esty2wd"] == 9 && $wednum == 1 && $isweekday == 0) ||
                               ($row["esty2dp"] == 1 && $row["esty2wd"] == 8 && $wddnum == 1 && $isweekday == 1) ||
                               ($row["esty2dp"] == 5 && $row["esty2wd"] == 10 && $islastday == 1) ||
                               ($row["esty2dp"] == 5 && $row["esty2wd"] == 9 && $islastwe == 1 && $isweekday == 0) ||
                               ($row["esty2dp"] == 5 && $row["esty2wd"] == 8 && $islastwd == 1 && $isweekday == 1)) {

                                if($row["ese"] == 1) {
        // end after so many
                                    $endint = $row["eseaoint"];
                                    if($eyear < ($row["startyear"] + $endint)) {
                                        $haveevent = true;
                                    }

                                } elseif($row["ese"] == 2) {
        // end on date
                                    $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                    if($xuts1 <= $xuts3) {
                                        $haveevent = true;
                                    }
                                } else {
        // no end
                                    $haveevent = true;
                                }
                            }
                        }
                    }
                }
#debug
#echo "<br>\n next loop <br>\n";

            }  // is passed date >= check date

#debug
#echo "<br>\n exit loop <br>\n";


            if($haveevent == true) {

# Changes for 1.1.10
                $haveexception = false;
                $haveexception = checkforexception($row["calid"], $row["evid"],$eday, $emonth, $eyear);
                if($haveexception == true) {
                    $haveevent = false;
                    continue;
                }
# Changes for 1.1.10
                $eventcnt++;
                $eventar[$eventcnt]["id"] = $row["evid"];
                $eventar[$eventcnt]["uname"] = "";
                $eventar[$eventcnt]["email"] = "";
                if($curcalcfg["gcscoyn_dispevcr"]==1) {

                    $tsql="select uname,email from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["uid"];
                    #$tquery1 = mysql_query($tsql) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    #while($trow1 = mysql_fetch_array($tquery1)) {
                    #    $trow1 = gmqfix($trow1,1);
                    #    $eventar[$eventcnt]["uname"] = $trow1["uname"];
                    #    $eventar[$eventcnt]["email"] = $trow1["email"];
                    #}
                    #@mysql_free_result($tquery1);


###
$sqlres2 = "";
$rowcount2 = "";
                    if(!$cldb->set_sqlstring($tsql,$sqlres2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }
                    if(!$cldb->execute($sqlres2,$rowcount2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }
                    $eoq2 = false;

                    if($rowcount2 !== 1) {
                        enderror("User table error",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }

                    #while($trow1 = mysql_fetch_array($tquery1)) {
                    while($cldb->get_row($sqlres2,$trow1,$eoq2)) {
                        #$trow1 = gmqfix($trow1,1);
                        $eventar[$eventcnt]["uname"] = $trow1["uname"];
                        $eventar[$eventcnt]["email"] = $trow1["email"];
                    }
                    #@mysql_free_result($tquery1);
                    $cldb->release($sqlres2);


###



                }
                if($row["isallday"] == 1) {
                    $eventar[$eventcnt]["isallday"] = "1";
                    $eventar[$eventcnt]["sorttime"] = "0";
                    $sortar[$eventcnt] = "0";
                    $eventar[$eventcnt]["starttimet"] = "";
                    $eventar[$eventcnt]["endtimet"] = "";
                } else {
                    $eventar[$eventcnt]["isallday"] = "0";
                    $eventar[$eventcnt]["sorttime"] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];
                    $sortar[$eventcnt] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];


                    if($curcalcfg["timetype"]==1) {
                        $eventar[$eventcnt]["starttimet"] = $row["starthour"].":".$row["startmin"];
                        $eventar[$eventcnt]["endtimet"] = $row["endhour"].":".$row["endmin"];
                    } else {

                        $eventar[$eventcnt]["starttimet"] = date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990));
                        $eventar[$eventcnt]["endtimet"] = date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990));
                    }

                }

                if(strlen(($row["subtitle"]))>0) {$subtt=$curcalcfg["gcscoif_subtitletxt"]." ".($row["subtitle"]);} else {$subtt="";}
                $eventar[$eventcnt]["title"] = ($row["title"]);
                $eventar[$eventcnt]["subtitle"] = $subtt;
                $eventar[$eventcnt]["sendreminder"] = $row["sendreminder"];
                $eventar[$eventcnt]["iseventseries"] = $row["iseventseries"];
                $eventar[$eventcnt]["remsuballow"] = $row["remsuballow"];

                $eventar[$eventcnt]["conflict"] = 0;
                if($curcalcfg["collisioncheck"] == 1) {
                    if($row["isallday"] != 1 || $curcalcfg["allcollisioncheck"] == 1) {
                        if($chkfec==1) {
                            $conflict = checkforconflict($eventar[$eventcnt]["id"],$eday, $emonth, $eyear);
                            if($conflict[0][0] > 0) {
                                $eventar[$eventcnt]["conflict"] = 1;
                            } else {
                                $eventar[$eventcnt]["conflict"] = 0;
                            }
                        } else {
                            $eventar[$eventcnt]["conflict"] = 0;
                        }
                    }
                }

                $eventar[$eventcnt]["description"] = ($row["description"]);
                if($row["catid"] != 0) {

                    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid = ".$row["catid"];
                    #$query2 = mysql_query($sqlstr) or die("Cannot query user categories table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    #$row2 = mysql_fetch_array($query2);
                    #$row2 = gmqfix($row2,1);

####
                    if(!$cldb->set_sqlstring($sqlstr,$sqlres2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }
                    if(!$cldb->execute($sqlres2,$rowcount2)) {
                        enderror("Cannot query event table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }

                    if($rowcount2 !== 1) {
                        enderror("Category table error",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }

                    $eoq2 = false;
                    if(!$cldb->get_row($sqlres2,$row2,$eoq2)) {
                        enderror("Category table error",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres2,true);
                    }

                    $cldb->release($sqlres2);
####

                    $eventar[$eventcnt]["catcolorbg"] = $row2["catcolorbg"];
                    if($row2["catcolortext"] == "") {
                        $eventar[$eventcnt]["catcolortext"] = "black";
                    } else {
                        $eventar[$eventcnt]["catcolortext"] = $row2["catcolortext"];
                    }
                    if($row2["catcolorbg"] == "") {
                        if($eview == "Minical") {
                            $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["mcdwecellcolor"];
                        } elseif($eview == "Year") {
                            $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["yvdwecellcolor"];
                        } else {
                            $eventar[$eventcnt]["catcolorbg"] = "";
                        }
                    }

                    #@mysql_free_result($query2);
                } else {
                    if($eview == "Minical") {
                        $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["mcdwecellcolor"];
                    } elseif($eview == "Year") {
                        $eventar[$eventcnt]["catcolorbg"] = $curcalcfg["yvdwecellcolor"];
                    } else {
                        $eventar[$eventcnt]["catcolorbg"] = "";
                    }
                    $eventar[$eventcnt]["catcolortext"] = "black";
                }
            }
        }

        #@mysql_free_result($query1);

        if(!$eoq1 == true) {
            enderror("Possible database error in events table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$dbquery1,true);
        }
        $cldb->release($dbquery1);

        asort($sortar);
        $revar[0][0] = $eventcnt;
        $revcnt = 1;
        foreach($sortar as $key => $val) {
            $revar[$revcnt]["id"] = $eventar[$key]["id"];
            $revar[$revcnt]["uname"] = $eventar[$key]["uname"];
            $revar[$revcnt]["email"] = $eventar[$key]["email"];
            $revar[$revcnt]["isallday"] = $eventar[$key]["isallday"];
            $revar[$revcnt]["sorttime"] = $eventar[$key]["sorttime"];
            $revar[$revcnt]["starttimet"] = $eventar[$key]["starttimet"];
            $revar[$revcnt]["endtimet"] = $eventar[$key]["endtimet"];
            $revar[$revcnt]["title"] = $eventar[$key]["title"];
            #fmthtml($revar[$revcnt]["title"]);
            $revar[$revcnt]["subtitle"] = $eventar[$key]["subtitle"];
            #fmthtml($revar[$revcnt]["subtitle"]);
            $revar[$revcnt]["sendreminder"] = $eventar[$key]["sendreminder"];
            $revar[$revcnt]["iseventseries"] = $eventar[$key]["iseventseries"];
            $revar[$revcnt]["remsuballow"] = $eventar[$key]["remsuballow"];
            $revar[$revcnt]["conflict"] = $eventar[$key]["conflict"];
            $revar[$revcnt]["catcolorbg"] = $eventar[$key]["catcolorbg"];
            $revar[$revcnt]["catcolortext"] = $eventar[$key]["catcolortext"];
            $revar[$revcnt]["description"] = $eventar[$key]["description"];
            #fmthtml($revar[$revcnt]["description"]);
            $revcnt++;
        }
        if($haveevent == true || $eventcnt > 0) {
            $evbgcol = $revar[1]["catcolorbg"];
            $evfgcol = $revar[1]["catcolortext"];
        }

        if($eview == "Day") {
            return $revar;
        }
        if($eview == "Week") {
            return $revar;
        }
        if($eview == "Month") {
            return $revar;
        }
        if($eview == "Year") {
            return $revar;
#            if($haveevent == true || $eventcnt > 0) {
#                return true;
#            } else {
#                return false;
#            }
        }
        if($eview == "Minical") {
            return $revar;
#            if($haveevent == true || $eventcnt > 0) {
#                return true;
#            } else {
#                return false;
#            }
        }
}

function evtcmp($a, $b) {
    return strcmp($a["sorttime"], $b["sorttime"]);
}

# Changes for 1.1.10

/***************************************************************
**  check for event exceptions
***************************************************************/

function checkforexception($evexcalid, $evexid, $evexeday, $evexemonth, $evexeyear) {

    global $user,$curcalcfg;
    global $langcfg,$evbgcol;

#print "checking...<br>";

    $sqlstrevex = "select count(*) as evexception from ".$GLOBALS["tabpre"]."_cal_event_exceptions
    where (evid = '".$evexid."') and (calid='".$evexcalid."') and (to_days(CONCAT_WS('-', exyear, exmonth, exday)) = to_days(CONCAT_WS('-', '".$evexeyear."', '".$evexemonth."', '".$evexeday."')))";
    #print $sqlstrevex;

    $queryevex = mysql_query($sqlstrevex) or die("Cannot query Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrevex."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $rowevex = mysql_fetch_array($queryevex) or die("Cannot query Exceptions Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrevex."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    if($rowevex["evexception"] > 0) {
        mysql_free_result($queryevex);
        return true;
    } else {
        mysql_free_result($queryevex);
        return false;
    }
}

# Changes for 1.1.10


/***************************************************************
**  check for conflicting events
***************************************************************/

function checkforconflict($evid,$eday, $emonth, $eyear) {

// day, month, year, hour, minute
    global $weekstartonmonday;
    global $user,$curcalcfg;
    global $langcfg,$evbgcol;

        $conflict = false;
        $colevent[0][0] = 0;
        $coleventcnt = 0;

        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and calid = '".$user->gsv("curcalid")."' and evid=".$evid;
        $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);

#        print "<br>chk sql: ".$sqlstr."<br><br>";

            $cevent = getevents($eday, $emonth, $eyear);

            if($cevent[0][0] > 0 ) {

                for($xzc1=1;$xzc1<=$cevent[0][0];$xzc1++) {
                    if($cevent[$xzc1]["id"] != $row["evid"]) {
                        if(($cevent[$xzc1]["isallday"]=="1" || $row["isallday"]==1)) {
                            if( $curcalcfg["allcollisioncheck"] == 1) {
                                if(($curcalcfg["catcollisioncheck"]=="0" ) || ($curcalcfg["catcollisioncheck"]=="1" && $cevent[$xzc1]["catid"]== $row["catid"])) {
    # Changes for 1.1.10 (Typo fix, but was not a bug.. whew)
                                    $conflict = true;
    # Changes for 1.1.10 (Typo fix, but was not a bug.. whew)
                                    $coleventcnt++;
                                    #$colevent[0]++;
                                    $colevent[$coleventcnt]["id"] = $cevent[$xzc1]["id"];
                                    if($cevent[$xzc1]["isallday"]=="1" && $row["isallday"]==1) {
                                        $xzct1 = mktime(0,0,0,3,3,1973);
                                        $xzct2 = mktime(23,59,0,3,3,1973);
                                    } elseif($cevent[$xzc1]["isallday"]=="1") {
                                        $xzct1 = mktime($row["starthour"],$row["startmin"],0,3,3,1973);
                                        $xzct2 = mktime($row["endhour"],$row["endmin"],0,3,3,1973);
                                    } else {
                                        $xzct1 = mktime(substr($cevent[$xzc1]["sorttime"],0,2),substr($cevent[$xzc1]["sorttime"],2,2),0,3,3,1973);
                                        $xzct2 = mktime(substr($cevent[$xzc1]["sorttime"],4,2),substr($cevent[$xzc1]["sorttime"],6,2),0,3,3,1973);
                                    }
                                    $colevent[$coleventcnt]["evcst"] = $xzct1;
                                    $colevent[$coleventcnt]["evcet"] = $xzct2;
                                }
                            }
                        } else {
                            $zct1 = mktime($row["starthour"],$row["startmin"],0,3,3,1973);
                            $zct2 = mktime($row["endhour"],$row["endmin"],0,3,3,1973);
                            $xzct1 = mktime(substr($cevent[$xzc1]["sorttime"],0,2),substr($cevent[$xzc1]["sorttime"],2,2),0,3,3,1973);
                            $xzct2 = mktime(substr($cevent[$xzc1]["sorttime"],4,2),substr($cevent[$xzc1]["sorttime"],6,2),0,3,3,1973);
#                            print "EV ID: ".$row["evid"]."<br><br>";
#                            print "Start: ".$zct1."<br>";
#                            print "End  : ".$zct2."<br><br>";
#                            print "ck id : ".$cevent[$xzc1]["id"]."<br><br>";
#                            print "Start: ".$xzct1."<br>";
#                            print "End  : ".$xzct2."<br><br>";
                            if(($xzct1 >= $zct1 && $xzct1 <= $zct2) || ($zct1 >= $xzct1 && $zct1 < $xzct2) ) {
                                if(($curcalcfg["catcollisioncheck"]=="0" ) || ($curcalcfg["catcollisioncheck"]=="1" && $cevent[$xzc1]["catid"] == $row["catid"])) {
    # Changes for 1.1.10 (Typo fix, but was not a bug.. whew)
                                    $conflict = true;
    # Changes for 1.1.10 (Typo fix, but was not a bug.. whew)
                                    $coleventcnt++;
                                    #$colevent[0]++;
                                    $colevent[$coleventcnt]["id"] = $cevent[$xzc1]["id"];
                                    if($xzct1 >= $zct1 && $xzct1 <= $zct2) {
                                        $colevent[$coleventcnt]["evcst"] = $xzct1;
                                    } else {
                                        $colevent[$coleventcnt]["evcst"] = $zct1;
                                    }
                                    if($xzct2 <= $zct2) {
                                        $colevent[$coleventcnt]["evcet"] = $xzct2;
                                    } else {
                                        $colevent[$coleventcnt]["evcet"] = $zct2;
                                    }
                                }
                            }
                        }
                    }
                }
            }



        @mysql_free_result($query1);
        $colevent[0][0]=$coleventcnt;
        return $colevent;
}

function getevents($eday, $emonth, $eyear) {
// day, month, year, hour, minute
    global $weekstartonmonday;
    global $user,$curcalcfg;
    global $langcfg,$evbgcol;
    $eventcnt = 0;
    $eventar = array();
    $sortar = array();

/*
// Private cal select
    if($curcalcfg["caltype"]==2) {
        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and startday='".$eday."' and
        startmonth='".$emonth."' and startyear='".$eyear."' and uid=".$user->gsv("cuid")." and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";
    } elseif($curcalcfg["caltype"]==1){

// Public cal select
        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and startday='".$eday."' and
        startmonth='".$emonth."' and startyear='".$eyear."' and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";
    } elseif($curcalcfg["caltype"]==0){

// open cal select
        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and startday='".$eday."' and
        startmonth='".$emonth."' and startyear='".$eyear."' and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";
    }

*/
// Private cal select
    if($curcalcfg["caltype"]==2) {
        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
        uid=".$user->gsv("cuid")." and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";
    } elseif($curcalcfg["caltype"]==1){

// Public cal select
#        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
#        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
#        uid=".$user->gsv("cuid")." and
#        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";

        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";

    } elseif($curcalcfg["caltype"]==0){

// open cal select
#        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
#        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
#        uid=".$user->gsv("cuid")." and
#        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";

        $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where pending = 0 and iseventseries=0 and
        (to_days(CONCAT_WS('-', startyear, startmonth, startday)) = to_days(CONCAT_WS('-', '".$eyear."', '".$emonth."', '".$eday."'))) and
        calid='".$user->gsv("curcalid")."' order by isallday desc,starthour,startmin";
    }

    $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#        $trcntn = @mysql_num_rows($query1);

        while($row = mysql_fetch_array($query1)) {
            $row = gmqfix($row,1);
            $eventcnt++;
                $eventar[$eventcnt]["id"] = $row["evid"];
                if($row["isallday"] == 1) {
                    $eventar[$eventcnt]["isallday"] = "1";
                    $eventar[$eventcnt]["sorttime"] = "0";
                    $sortar[$eventcnt] = "0";
                    $eventar[$eventcnt]["starttimet"] = "";
                    $eventar[$eventcnt]["endtimet"] = "";
                } else {
                    $eventar[$eventcnt]["isallday"] = "0";
                    $eventar[$eventcnt]["sorttime"] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];
                    $sortar[$eventcnt] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];


                    if($curcalcfg["timetype"]==1) {
                        $eventar[$eventcnt]["starttimet"] = $row["starthour"].":".$row["startmin"];
                        $eventar[$eventcnt]["endtimet"] = $row["endhour"].":".$row["endmin"];
                    } else {

                        $eventar[$eventcnt]["starttimet"] = date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990));
                        $eventar[$eventcnt]["endtimet"] = date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990));
                    }


                }
        }

        @mysql_free_result($query1);

// Private cal select
    if($curcalcfg["caltype"]==2) {
$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where pending = 0 and (t.iseventseries=1 and t.uid=".$user->gsv("cuid")." and t.calid='".$user->gsv("curcalid")."' and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$eyear."-".$emonth."-".$eday."'))
and ((t.ese = 2 and to_days('".$eyear."-".$emonth."-".$eday."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or
(t.ese=0) or (t.ese=1 and to_days('".$eyear."-".$emonth."-".$eday."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";

    } elseif($curcalcfg["caltype"]==1){

// Public cal select
$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where pending = 0 and (t.iseventseries=1 and t.calid='".$user->gsv("curcalid")."' and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$eyear."-".$emonth."-".$eday."'))
and ((t.ese = 2 and to_days('".$eyear."-".$emonth."-".$eday."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or
(t.ese=0) or (t.ese=1 and to_days('".$eyear."-".$emonth."-".$eday."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";

    } elseif($curcalcfg["caltype"]==0){

// open cal select
$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where pending = 0 and (t.iseventseries=1 and t.calid='".$user->gsv("curcalid")."' and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$eyear."-".$emonth."-".$eday."'))
and ((t.ese = 2 and to_days('".$eyear."-".$emonth."-".$eday."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or
(t.ese=0) or (t.ese=1 and to_days('".$eyear."-".$emonth."-".$eday."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";
    }
        $query1 = mysql_query($sqlstr) or die("Cannot query calendar series in events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $endint = 0;
        while($row = mysql_fetch_array($query1)) {
            $row = gmqfix($row,1);
            $haveevent = false;
            $xuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
            $xuts2 = mktime(0,0,0,$row["startmonth"],$row["startday"],$row["startyear"]);
            $xdinf = getdate($xuts1);
            $xsdinf = getdate($xuts2);

            if($xuts1 >= $xuts2) {
                # this must now be true because of the new select statements
// is passed date >= check date (event)
                if($row["estype"] == 1) {
// daily

                    if($row["ese"] == 1) {
// end interval
                        $endint = $row["eseaoint"];

                        if($row["estd"] == 1) {
// every day interval
                            #if(((datediff("d", $xuts2,$xuts1)) % ($row["estdint"])) == 0) {
                            if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0 || ($row["estdint"] - (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"]))) < 1) {
                                if( ((datediff("d", $xuts2,$xuts1)) / $row["estdint"] ) < $endint) {
                                    $haveevent = true;
                                }
                            }

                        } elseif($xdinf["wday"] > 0 && $xdinf["wday"] < 6) {
// every week day
                            if( (datediff("d", $xuts2,$xuts1)) < $endint) {
                                $haveevent = true;
                            }

                        }

                    } elseif($row["ese"] == 2) {

// end on a certain date
                        $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);

                        if($xuts1 <= $xuts3) {

                            if($row["estd"] == 1) {
    // interval
                                #if(((datediff("d", $xuts2,$xuts1)) % ($row["estdint"])) == 0) {
                                if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0 || ($row["estdint"] - (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"]))) < 1) {
                                    $haveevent = true;
                                }
                            } elseif($xdinf["wday"] > 0 && $xdinf["wday"] < 6) {
    // every day
                                $haveevent = true;
                            }
                        }

                    } else {
// no end
                        if($row["estd"] == 1) {
// interval
                            #if(((datediff("d", $xuts2,$xuts1)) % ($row["estdint"])) == 0) {
                            if((fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"])) == 0 || ($row["estdint"] - (fmod(datediff("d", $xuts2,$xuts1) , $row["estdint"]))) < 1) {
                                $haveevent = true;
                            }
                        } elseif($xdinf["wday"] > 0 && $xdinf["wday"] < 6) {
// every day
                            $haveevent = true;
                        }
                    }

                } elseif($row["estype"] == 2) {
// weekly
                    if($xdinf["wday"] == 0) {
                        $wdgt = 7;
                    } else {
                        $wdgt = $xdinf["wday"];
                    }
                    $wdgt--;
// check week array
                    if(substr($row["estwd"],$wdgt,1) == "1") {

                        if($row["ese"] == 1) {
    // end interval
                            $endint = $row["eseaoint"];
                            #if(((datediff("w", $xuts2,$xuts1)) % ($row["estwint"])) == 0) {
                            if((fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"])) == 0 || ($row["estwint"] - (fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"]))) < 1) {
    // interval
                                if( ((datediff("w", $xuts2,$xuts1)) / $row["estwint"] ) < $endint) {
    // end occur
                                    $haveevent = true;
                                }
                            }
                        } elseif($row["ese"] == 2) {
    // end on a certain date
                            $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                            if($xuts1 <= $xuts3) {
                                #if(((datediff("w", $xuts2,$xuts1)) % ($row["estwint"])) == 0) {
                                if(fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"]) <= 0) {
                                    $haveevent = true;
                                }
                            }
                        } else {
    // no end
                            #if(((datediff("w", $xuts2,$xuts1)) % ($row["estwint"])) == 0) {
                            if(fmod(datediff("w", $xuts2,$xuts1) , $row["estwint"]) <= 0) {
                                $haveevent = true;
                            }
                        }
                    } // day not in week array

                } elseif($row["estype"] == 3) {
// monthly

// Monthly type 1
                    if($row["estm"] == 1) {

                        $mint = $row["estm1int"];


                        $xuts4 = mktime(0,0,0,$emonth,$eday,$eyear);
                        $xuts4 = dateadd("d",1,$xuts4);
                        $dtinf4 = getdate($xuts4);

                        if($xdinf["mon"] != $dtinf4["mon"]) {$islastday = 1;} else {$islastday = 0;}
                        if($row["estm1d"] > 28 ) {$eild = 1;} else {$eild = 0;}
                        $xkd3 = date("Y-m-d",mktime(0,0,0,$emonth,$row["estm1d"],$eyear));
                        $xkd4 = mktime(0,0,0,$emonth,$row["estm1d"],$eyear);
                        $xkdinf = getdate($xkd4);
                        if($xkd3 == "1970-01-01" || $xkdinf["mon"] != $xdinf["mon"]) {$okild = 1;} else {$okild = 0;}

                        if(($row["estm1d"] == $xdinf["mday"]) || ($eild == 1 && $islastday == 1 && $okild == 1)) {
// first check, is day the same, or if
// the day falls on 29 - 31,
// is this the last day of month
                            $xuts4 = mktime(0,0,0,$row["startmonth"],1,$row["startyear"]);
                            $dtinf4 = getdate($xuts4);
                            $ckint = 0;

                            if($row["ese"] == 1) {
// event end after so many
                                while($xuts4 <= $xuts1 && $ckint <= $row["eseaoint"]) {
                                    $ckint++;
//                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"]) && ($ckint <= $row["eseaoint"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }

                            } elseif($row["ese"] == 2) {
// end after date
                                $eoint = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                $xuts5 = mktime(0,0,0,$emonth,$row["estm1d"],$eyear);
                                if($xuts5 <= $eoint) {
                                    while($xuts4 <= $xuts1) {
                                        if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                            $haveevent = true;
                                            break;
                                        }
                                        $xuts4 = dateadd("m",$mint,$xuts4);
                                        $dtinf4 = getdate($xuts4);
                                    }
                                }

                            } else {
//no end
                                while($xuts4 <= $xuts1) {
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }
                            }
                        }

                    } else {
// Month type 2
// same day pos
// every so many mnths
                        $mint = $row["estm2int"];


                        $yuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
//                            $yuts2 = mktime(0,0,0,$row["esty2m"],1,$eyear);

                        $ydinf1 = getdate($yuts1);
//                            $ydinf2 = getdate($yuts2);

                        $wdc = array();
                        $wddc = 0;
                        $wedc = 0;


                        $fyear=$eyear;
                        $fmonth=$emonth;
                        $fday=$eday;

                        $cuts = mktime(0,0,0,$fmonth,$fday,$fyear);

//                            $zuts = dateadd("yyyy",1,$cuts);
//                            $zxfdate = getdate($zuts);

                        $xfuncdate = getdate($cuts);
                        $fdow = $xfuncdate["wday"];
                        $xfdow = $fdow;
                        $rfdow = $fdow;
                        if($fdow==0) {$fdow=7;}
                        if($fdow < 6) {$isweekday = 1;} else {$isweekday = 0;}
                        $zfcday = 1;
                        $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                        $zfuncdate = getdate($tuts);
                        $weekdaypos = 0;
                        $weekdayposcnt = 0;
                        $islastpos = 1;
                        $islastposcnt = 0;
                        $wddnum = 0;
                        $wednum = 0;
                        $islastwe = 1;
                        $islastwd = 1;

                        while(($zfuncdate["mon"] == $xfuncdate["mon"])) {
                            if(($zfuncdate["wday"] == $rfdow) && ($zfuncdate["mday"] <= $xfuncdate["mday"])) {
                                $weekdaypos++;
                                $weekdayposcnt++;
                            }
                            if($zfuncdate["mday"] <= $xfuncdate["mday"]) {
                                if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                    $wednum++;
                                } else {
                                    $wddnum++;
                                }
                            }


                            if($zfuncdate["mday"] > $xfuncdate["mday"]) {
                                if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                    $islastwe = 0;
                                } else {
                                    $islastwd = 0;
                                }
                                if($zfuncdate["wday"] == $rfdow) {
                                    $islastpos = 0;
                                    $islastposcnt++;
                                }
                            }

                            $zfcday++;
                            $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                            $zfuncdate = getdate($tuts);
                        }

                        $xuts4 = mktime(0,0,0,$emonth,$eday,$eyear);
                        $xuts4 = dateadd("d",1,$xuts4);
                        $dtinf4 = getdate($xuts4);
                        if($xdinf["mon"] != $dtinf4["mon"]) {$islastday = 1;} else {$islastday = 0;}


                        if(($row["estm2dp"] == 5 && $islastpos == 1 && $fdow == $row["estm2wd"]) ||
                           ($row["estm2dp"] == $weekdaypos && $fdow == $row["estm2wd"]) ||
                           ($row["estm2dp"] == $wednum && $row["estm2wd"] == 9 && $isweekday == 0 && $row["estm2dp"] < 5) ||
                           ($row["estm2dp"] == $wddnum && $row["estm2wd"] == 8 && $isweekday == 1 && $row["estm2dp"] < 5) ||
                           ($row["estm2dp"] == 1 && $row["estm2wd"] == 10 && $eday == "01") ||
                           ($row["estm2dp"] == 1 && $row["estm2wd"] == 9 && $wednum == 1 && $isweekday == 0) ||
                           ($row["estm2dp"] == 1 && $row["estm2wd"] == 8 && $wddnum == 1 && $isweekday == 1) ||
                           ($row["estm2dp"] == 5 && $row["estm2wd"] == 10 && $islastday == 1) ||
                           ($row["estm2dp"] == 5 && $row["estm2wd"] == 9 && $islastwe == 1 && $isweekday == 0) ||
                           ($row["estm2dp"] == 5 && $row["estm2wd"] == 8 && $islastwd == 1 && $isweekday == 1)) {

                            $xuts4 = mktime(0,0,0,$row["startmonth"],1,$row["startyear"]);
                            $dtinf4 = getdate($xuts4);
                            $ckint = 0;

                            if($row["ese"] == 1) {
// event end after so many
                                while($xuts4 <= $xuts1 && $ckint <= $row["eseaoint"]) {
                                    $ckint++;
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"]) && ($ckint <= $row["eseaoint"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }

                            } elseif($row["ese"] == 2) {
// end after date
                                $eoint = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                $xuts5 = mktime(0,0,0,$emonth,$row["estm1d"],$eyear);
                                if($xuts5 <= $eoint) {
                                    while($xuts4 <= $xuts1) {
                                        if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                            $haveevent = true;
                                            break;
                                        }
                                        $xuts4 = dateadd("m",$mint,$xuts4);
                                        $dtinf4 = getdate($xuts4);
                                    }
                                }

                            } else {
//no end
                                while($xuts4 <= $xuts1) {
                                    if(($xdinf["mon"] == $dtinf4["mon"]) && ($xdinf["year"] == $dtinf4["year"])) {
                                        $haveevent = true;
                                        break;
                                    }
                                    $xuts4 = dateadd("m",$mint,$xuts4);
                                    $dtinf4 = getdate($xuts4);
                                }
                            }

                        }
// end month type 2
                    }



                } elseif($row["estype"] == 4) {
// yearly
                    if($row["esty"] == 1) {
// same day every year
                        if(($row["esty1d"] == $eday) && ($row["esty1m"] == $emonth) && ($row["startyear"] <= $eyear) ) {
                            if($row["ese"] == 1) {
// end interval
                                $endint = $row["eseaoint"];
                                if($eyear < ($row["startyear"] + $endint)) {
                                    $haveevent = true;
                                }

                            } elseif($row["ese"] == 2) {
// end date
                                $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                if($xuts1 <= $xuts3) {
                                    $haveevent = true;
                                }
                            } else {
//no end
                                $haveevent = true;
                            }
                        }

                    } else {
//same day pos
                        if($row["esty2m"] == $emonth) {
// is same month
                            $yuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
                            $yuts2 = mktime(0,0,0,$row["esty2m"],1,$eyear);
                            $ydinf1 = getdate($yuts1);
                            $ydinf2 = getdate($yuts2);
                            $wdc = array();
                            $wddc = 0;
                            $wedc = 0;


                            $fyear=$eyear;
                            $fmonth=$emonth;
                            $fday=$eday;

                            $cuts = mktime(0,0,0,$fmonth,$fday,$fyear);

                            $zuts = dateadd("yyyy",1,$cuts);
                            $zxfdate = getdate($zuts);

                            $xfuncdate = getdate($cuts);
                            $fdow = $xfuncdate["wday"];
                            $xfdow = $fdow;
                            $rfdow = $fdow;
                            if($fdow==0) {$fdow=7;}
                            if($fdow < 6) {$isweekday = 1;} else {$isweekday = 0;}
                            $zfcday = 1;
                            $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                            $zfuncdate = getdate($tuts);
                            $weekdaypos = 0;
                            $weekdayposcnt = 0;
                            $islastpos = 1;
                            $islastposcnt = 0;
                            $wddnum = 0;
                            $wednum = 0;
                            $islastwe = 1;
                            $islastwd = 1;

                            while(($zfuncdate["mon"] == $xfuncdate["mon"])) {
                                if(($zfuncdate["wday"] == $rfdow) && ($zfuncdate["mday"] <= $xfuncdate["mday"])) {
                                    $weekdaypos++;
                                    $weekdayposcnt++;
                                }
                                if($zfuncdate["mday"] <= $xfuncdate["mday"]) {
                                    if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                        $wednum++;
                                    } else {
                                        $wddnum++;
                                    }
                                }


                                if($zfuncdate["mday"] > $xfuncdate["mday"]) {
                                    if($zfuncdate["wday"] == 0 || $zfuncdate["wday"] == 6) {
                                        $islastwe = 0;
                                    } else {
                                        $islastwd = 0;
                                    }
                                    if($zfuncdate["wday"] == $rfdow) {
                                        $islastpos = 0;
                                        $islastposcnt++;
                                    }
                                }

                                $zfcday++;
                                $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
                                $zfuncdate = getdate($tuts);
                            }

                            $xuts4 = mktime(0,0,0,$emonth,$eday,$eyear);
                            $xuts4 = dateadd("d",1,$xuts4);
                            $dtinf4 = getdate($xuts4);
                            if($xdinf["mon"] != $dtinf4["mon"]) {$islastday = 1;} else {$islastday = 0;}


                            if(($row["esty2dp"] == 5 && $islastpos == 1 && $fdow == $row["esty2wd"]) ||
                               ($row["esty2dp"] == $weekdaypos && $fdow == $row["esty2wd"]) ||
                               ($row["esty2dp"] == $wednum && $row["esty2wd"] == 9 && $isweekday == 0 && $row["esty2dp"] < 5) ||
                               ($row["esty2dp"] == $wddnum && $row["esty2wd"] == 8 && $isweekday == 1 && $row["esty2dp"] < 5) ||
                               ($row["esty2dp"] == 1 && $row["esty2wd"] == 10 && $eday == "01") ||
                               ($row["esty2dp"] == 1 && $row["esty2wd"] == 9 && $wednum == 1 && $isweekday == 0) ||
                               ($row["esty2dp"] == 1 && $row["esty2wd"] == 8 && $wddnum == 1 && $isweekday == 1) ||
                               ($row["esty2dp"] == 5 && $row["esty2wd"] == 10 && $islastday == 1) ||
                               ($row["esty2dp"] == 5 && $row["esty2wd"] == 9 && $islastwe == 1 && $isweekday == 0) ||
                               ($row["esty2dp"] == 5 && $row["esty2wd"] == 8 && $islastwd == 1 && $isweekday == 1)) {

                                if($row["ese"] == 1) {
        // end after so many
                                    $endint = $row["eseaoint"];
                                    if($eyear < ($row["startyear"] + $endint)) {
                                        $haveevent = true;
                                    }

                                } elseif($row["ese"] == 2) {
        // end on date
                                    $xuts3 = mktime(0,0,0,$row["esem"],$row["esed"],$row["esey"]);
                                    if($xuts1 <= $xuts3) {
                                        $haveevent = true;
                                    }
                                } else {
        // no end
                                    $haveevent = true;
                                }
                            }
                        }
                    }
                }

            }  // is passed date >= check date



            if($haveevent == true) {

# Changes for 1.1.10
                $haveexception = false;
                $haveexception = checkforexception($row["calid"], $row["evid"],$eday, $emonth, $eyear);
                if($haveexception == true) {
                    $haveevent = false;
                    continue;
                }
# Changes for 1.1.10

                $eventcnt++;
                $eventar[$eventcnt]["id"] = $row["evid"];
                if($row["isallday"] == 1) {
                    $eventar[$eventcnt]["isallday"] = "1";
                    $eventar[$eventcnt]["sorttime"] = "0";
                    $sortar[$eventcnt] = "0";
                    $eventar[$eventcnt]["starttimet"] = "";
                    $eventar[$eventcnt]["endtimet"] = "";
                } else {
                    $eventar[$eventcnt]["isallday"] = "0";
                    $eventar[$eventcnt]["sorttime"] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];
                    $sortar[$eventcnt] = $row["starthour"].$row["startmin"].$row["endhour"].$row["endmin"];


                    if($curcalcfg["timetype"]==1) {
                        $eventar[$eventcnt]["starttimet"] = $row["starthour"].":".$row["startmin"];
                        $eventar[$eventcnt]["endtimet"] = $row["endhour"].":".$row["endmin"];
                    } else {

                        $eventar[$eventcnt]["starttimet"] = date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990));
                        $eventar[$eventcnt]["endtimet"] = date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990));
                    }

                }

            }
        }

        @mysql_free_result($query1);

        asort($sortar);
        $revar[0][0] = $eventcnt;
        $revcnt = 1;
        foreach($sortar as $key => $val) {
            $revar[$revcnt]["id"] = $eventar[$key]["id"];
            $revar[$revcnt]["isallday"] = $eventar[$key]["isallday"];
            $revar[$revcnt]["sorttime"] = $eventar[$key]["sorttime"];
            $revar[$revcnt]["starttimet"] = $eventar[$key]["starttimet"];
            $revar[$revcnt]["endtimet"] = $eventar[$key]["endtimet"];
            $revcnt++;
        }
        return $revar;
}

?>
