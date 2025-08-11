<?php
/***************************************************************
** Title.........: CaLogic Send Reminder program
** Version.......: 1.0
** Author........: Philip Boone <philip@boone.at>
** Filename......: srxclr.php
** Last changed..:
** Use...........: This file will send reminders when called
** Notes.........:

You must set up some kind of crontab that will call this file
as often as you want reminders to be checked.

read the reminders.txt file to learn how to use reminders.

You can rename this file but do not relocate it.
***************************************************************/


/***************************************************************
** included files
** NOTE: do not change the order of appearance


TODO:

Make a "GetCalConfig" function because of the new changes in 1.2.2

Some GLOBAL settings that used to come from _setup now come from _cal_ini

shouldn't be too hard to do, just copy the getuserstandards fun from dbfunc
and modify it to get the settings from the _cal_ini according to the current
calendar.....


***************************************************************/
include_once("./include/config.php");
include_once($GLOBALS["CLPath"]."/include/calfunc.php");
include_once($GLOBALS["CLPath"]."/include/gfunc.php");
include_once($GLOBALS["CLPath"]."/include/efuncs.php");
#include_once($GLOBALS["CLPath"]."/include/remcfg.php");

# EXAMPLES FOR A RELOCATED REMINDERS SCRIPT
# To use this method, place pound signs in front of
# the require_once and include_once commands above,
# and remove the pound signs from the same commnds below.
# of course you must supply the proper full path to the files.
#
# require_once("/home/user/htdocs/calogic/include/config.php");
# include_once("/home/user/htdocs/calogic/include/calfunc.php");
# include_once("/home/user/htdocs/calogic/include/gfunc.php");
# include_once("/home/user/htdocs/calogic/include/remcfg.php");
#
# I have not tested this method, so let me know if you have problems with it.
#
#

print "Please wait while reminders get checked...<br><br>";
global $weekstartonmonday,$daytext,$daytextl,$monthtext,$monthtextl;
global $langcfg,$rinterval,$rfrequency,$rdahead,$evtimeremain,$evtimeuntil;

$servertzos = date("Z");

$evtimeremain = "";
$evtimeuntil = 0;

#$remindermail = new htmlMimeMail();

if($GLOBALS["demomode"]==true) {
    $remoffdemo = true;
    $remtesting = true;
} else {
    $remoffdemo = false;
    $remtesting = false;
}

$numckd = 2;
$mailsent = 0;

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
    $numckd = $rfrequency + 2;

}

$numckd = $numckd * -1;

//print $numckd;

//exit();

# set safety buffer date
$chkdate = time();

$chkead = dateadd("d",$numckd,$chkdate);

$chkdar = getdate($chkead);
$chkyear = $chkdar["year"];
$chkmonth = $chkdar["mon"];
$chkday = $chkdar["mday"];
$chkhour = $chkdar["hours"];
$chkmin = $chkdar["minutes"];

//$chkead = $chkyear."-".$chkmonth."-".$chkday;

$chkead = sprintf("%04d-%02d-%02d", $chkyear,$chkmonth,$chkday);


# set actual date to check (todays datte)

$chkdar = getdate($chkdate);
$chkyear = $chkdar["year"];
$chkmonth = $chkdar["mon"];
$chkday = $chkdar["mday"];
$chkhour = $chkdar["hours"];
$chkmin = $chkdar["minutes"];

$chksaved = sprintf("%04d-%02d-%02d", $chkyear,$chkmonth,$chkday);

//print "CHKEAD: ".$chkead."<br><br>";
//print "CHKSAVE: ".$chksaved."<br><br>";

$rdcnt = 0;
$rcar = array();
$rcarcnt = 0;

// int mktime ( int hour, int minute, int second, int month, int day, int year [, int is_dst])

// first get non repeating events that have not passed since last reminder check

$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where (sendreminder = 1 or remsuballow = 1) and iseventseries = 0 and pending = 0 and (to_days('".$chkead."') <= endafterdays or endafterdays = 0) order by calid";
$query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

//print "Rem SQL: ".$sqlstr."<br><br>";

print "Checking non repeating events...<br><br>";


while($row = mysql_fetch_array($query1)) {
    $row = gmqfix($row,1);
    #mqfix($row,1);

// check if event is due to be reminded
    $evdate = sprintf("%04d-%02d-%02d", $row["startyear"],$row["startmonth"],$row["startday"]);
//print "reminder loop<br><br>";

// get time zone adjustment of event creator.
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["uid"];
    $query2 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row2 = mysql_fetch_array($query2);
    $row2 = gmqfix($row2,1);
    #mqfix($row2,1);

    $evcname = $row2["fname"]." ".$row2["lname"];
    $evcemail = $row2["email"];
    $evcemailtype = $row2["emailtype"];
    $evctzadj = $row2["tzos"];
    $evclang = $row2["langid"];

    @mysql_free_result($query2);

    getcurlang($evclang);
    setviewtext($evclang);

    $chkevdate = mktime($row["starthour"],$row["startmin"],0,$row["startmonth"],$row["startday"],$row["startyear"]);


                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where calid = '".$row["calid"]."' and evid = ".$row["evid"];
                $query2 = mysql_query($sqlstr) or die("Cannot query calendar event reminders table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                while($row2 = mysql_fetch_array($query2)) {

	            $row2 = gmqfix($row2,1);
	            #mqfix($row2,1);

                        if($row2["contyp"] == "M" || $row2["contyp"] == "U") {

                            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row2["conid"];
                            $query3 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                            while($row3 = mysql_fetch_array($query3)) {
                                    $row3 = gmqfix($row3,1);
				    #mqfix($row3,1);
                                if(checkevtime($row3["tzos"])==true) {
                                    $rcar[$rcarcnt]["name"] = $row3["fname"]." ".$row3["lname"];
                                    $rcar[$rcarcnt]["email"] = $row3["email"];
                                    $rcar[$rcarcnt]["emailtype"] = $row3["emailtype"];
                                    $rcar[$rcarcnt]["tzos"] = $row3["tzos"];
                                    $rcar[$rcarcnt]["ctype"] = $row2["contyp"];
                                    $rcar[$rcarcnt]["evid"] = $row["evid"];
                                    $rcar[$rcarcnt]["calid"] = $row["calid"];
                                    $rcar[$rcarcnt]["uid"] = $row["uid"];
                                    $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                    $rcar[$rcarcnt]["evcname"] = $evcname;
                                    $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                    $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                    $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                    $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                    $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                    $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                    $rcar[$rcarcnt]["chkrdate"] = $chkrdate;
                                    $rcar[$rcarcnt]["series"] = 0;

                                    $rcarcnt++;
                                    break;
                                }
                            }

                            @mysql_free_result($query3);

                        } elseif($row2["contyp"] == "C") {

                            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con where conid = ".$row2["conid"]." order by lname,fname";
                            $query3 = mysql_query($sqlstr) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                            while($row3 = mysql_fetch_array($query3)) {
	                        $row3 = gmqfix($row3,1);
				#mqfix($row3,1);
                                $cstzadj = ($row3["tzos"] * 60 * 60) - $servertzos;
                                #if(checkevtime($row3["tzos"])==true) {
                                if(checkevtime($cstzadj)==true) {

                                    $rcar[$rcarcnt]["name"] = $row3["fname"]." ".$row3["lname"];
                                    $rcar[$rcarcnt]["email"] = $row3["email"];
                                    $rcar[$rcarcnt]["emailtype"] = $row3["emailtype"];
                                    $rcar[$rcarcnt]["tzos"] = $cstzadj;
                                    $rcar[$rcarcnt]["ctype"] = "C";
                                    $rcar[$rcarcnt]["evid"] = $row["evid"];
                                    $rcar[$rcarcnt]["calid"] = $row["calid"];
                                    $rcar[$rcarcnt]["uid"] = $row["uid"];
                                    $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                    $rcar[$rcarcnt]["evcname"] = $evcname;
                                    $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                    $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                    $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                    $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                    $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                    $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                    $rcar[$rcarcnt]["chkrdate"] = $row2["$chkrdate"];
                                    $rcar[$rcarcnt]["chkevadj"] = $row2["$chkevadj"];
                                    $rcar[$rcarcnt]["series"] = 0;

                                    $rcarcnt++;
                                    break;
                                }
                            }

                            @mysql_free_result($query3);

                        } elseif($row2["contyp"] == "G") {

                            #$sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con where congp = ".$row2["conid"];
                            $sqlstr = "SELECT l.congpid,l.conid,c.* FROM ".$GLOBALS["tabpre"]."_user_congrp_link l left join ".$GLOBALS["tabpre"]."_user_con c on l.conid = c.conid WHERE l.congpid = ".$row2["conid"]." order by lname,fname";
                            $query3 = mysql_query($sqlstr) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                            while($row3 = mysql_fetch_array($query3)) {
                                $row3 = gmqfix($row3,1);
                                #mqfix($row3,1);
                                $cstzadj = ($row3["tzos"] * 60 * 60) - $servertzos;
                                #if(checkevtime($row3["tzos"])==true) {
                                if(checkevtime($cstzadj)==true) {
                                    $rcar[$rcarcnt]["name"] = $row3["fname"]." ".$row3["lname"];
                                    $rcar[$rcarcnt]["email"] = $row3["email"];
                                    $rcar[$rcarcnt]["emailtype"] = $row3["emailtype"];
                                    $rcar[$rcarcnt]["tzos"] = $cstzadj;
                                    $rcar[$rcarcnt]["ctype"] = "G";
                                    $rcar[$rcarcnt]["evid"] = $row["evid"];
                                    $rcar[$rcarcnt]["calid"] = $row["calid"];
                                    $rcar[$rcarcnt]["uid"] = $row["uid"];
                                    $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                    $rcar[$rcarcnt]["evcname"] = $evcname;
                                    $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                    $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                    $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                    $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                    $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                    $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                    $rcar[$rcarcnt]["chkrdate"] = $row2["$chkrdate"];
                                    $rcar[$rcarcnt]["chkevadj"] = $row2["$chkevadj"];
                                    $rcar[$rcarcnt]["series"] = 0;

                                    $rcarcnt++;
                                }
                            }

                            @mysql_free_result($query3);

                        } elseif($row2["contyp"] == "A") {

                            if($row2["confirmed"]==1 && $row2["approved"]==1) {
                                $cstzadj = ($row2["rtzos"] * 60 * 60) - $servertzos;
                                #if(checkevtime($row2["rtzos"])==true) {
                                if(checkevtime($cstzadj)==true) {
                                    $rcar[$rcarcnt]["name"] = $row2["fname"]." ".$row2["lname"];
                                    $rcar[$rcarcnt]["email"] = $row2["remail"];
                                    $rcar[$rcarcnt]["emailtype"] = $row2["remailtype"];
                                    $rcar[$rcarcnt]["tzos"] = $cstzadj;
                                    $rcar[$rcarcnt]["ctype"] = "A";
                                    $rcar[$rcarcnt]["evid"] = $row["evid"];
                                    $rcar[$rcarcnt]["calid"] = $row["calid"];
                                    $rcar[$rcarcnt]["uid"] = $row["uid"];
                                    $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                    $rcar[$rcarcnt]["evcname"] = $evcname;
                                    $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                    $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                    $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                    $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                    $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                    $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                    $rcar[$rcarcnt]["series"] = 0;

                                    $rcarcnt++;
                                }
                            }
                        }

                } # end while contacts
                @mysql_free_result($query2);


} // end while non repeating reminder select


# start repeating event check

print "Checking repeating events...<br><br>";

@mysql_free_result($query1);

# set $chksedate to actual date
$chksedate = $chkdate;

# $rdahead = number of days in advance to check for events.

for($exd=0;$exd<=$rdahead;$exd++) {

# add $exd number of days to the actual date.
# and then check for events that might fall on that day.
# do this until we've reached the max number of days to check in advance

    $chksedar = getdate($chksedate);
    $chkseyear = $chksedar["year"];
    $chksemonth = $chksedar["mon"];
    $chkseday = $chksedar["mday"];
    $chksehour = $chksedar["hours"];
    $chksemin = $chksedar["minutes"];

    $chksedate = mktime(0,0,0,$chksemonth,$chkseday,$chkseyear);

    # add number of days in advance we arfe currently on to the actual date

    $chksedate = dateadd("d",$exd,$chksedate);

    $chksedar = getdate($chksedate);
    $chkseyear = $chksedar["year"];
    $chksemonth = $chksedar["mon"];
    $chkseday = $chksedar["mday"];

    $chksead = sprintf("%04d-%02d-%02d", $chkseyear,$chksemonth,$chkseday);

    $eyear = $chkseyear;
    $emonth = $chksemonth;
    $eday = $chkseday;

    $sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events t where pending = 0 and
     ((sendreminder = 1 or remsuballow = 1) and t.iseventseries = 1 and to_days(CONCAT_WS('-', t.startyear, t.startmonth,t.startday)) <= to_days('".$chksead."'))
     and ((ese = 2 and to_days('".$chksead."') <= to_days(CONCAT_WS('-', t.esey, t.esem,t.esed))) or (t.ese=0) or (t.ese=1 and to_days('".$chksead."') <= endafterdays)) order by t.isallday desc,t.starthour,t.startmin";

        $query1 = mysql_query($sqlstr) or die("Cannot query calendar series in events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $endint = 0;

        while($row = mysql_fetch_array($query1)) {
            $row = gmqfix($row,1);
	    #mqfix($row,1);

            $haveevent = false;
            $xuts1 = mktime(0,0,0,$emonth,$eday,$eyear);
            $xuts2 = mktime(0,0,0,$row["startmonth"],$row["startday"],$row["startyear"]);
            $xdinf = getdate($xuts1);
            $xsdinf = getdate($xuts2);

            if($xuts1 >= $xuts2) {
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

            }  // is passed date >= check date


            if($haveevent == true) {

#print "Checking Exceptions...<br><br>";
#print $row["evid"].".<br><br>";
#print $eday."<br><br>";
#print $emonth."<br><br>";
#print $eyear."<br><br>";

# Changes for 1.1.10
                $haveexception = false;
                $haveexception = checkforexception($row["calid"],$row["evid"],$eday, $emonth, $eyear);
#print "Done Checking Exceptions p1...<br><br>";
                if($haveexception == true) {
                    $haveevent = false;
                    continue;
                }
# Changes for 1.1.10

#print "Done Checking Exceptions...<br><br>";

// the day checks, now the time
//$evdate gets set a few lines lower, make a new varialbe with a different datge format for the reminder mail

                #$rcar = array();
                #$rcarcnt = 0;
                $evdate = sprintf("%04d-%02d-%02d", $chkseyear,$chksemonth,$chkseday);
                $evemdate = sprintf("%02d-%02d-%04d", $chkseday,$chksemonth,$chkseyear);

            // get time zone adjustment of event creator.
                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["uid"];
                $query2 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $row2 = mysql_fetch_array($query2);
                $row2 = gmqfix($row2,1);
	        #mqfix($row2,1);
                $evcname = $row2["fname"]." ".$row2["lname"];
                $evcemail = $row2["email"];
                $evcemailtype = $row2["emailtype"];
                $evctzadj = $row2["tzos"];
                $evclang = $row2["langid"];

                @mysql_free_result($query2);


                getcurlang($evclang);
                setviewtext($evclang);

                # simulated event day

                $chkevdate = mktime($row["starthour"],$row["startmin"],0,$chksemonth,$chkseday,$chkseyear);



                            // get contacts for the reminder

                                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where calid = '".$row["calid"]."' and evid = ".$row["evid"];
                                $query2 = mysql_query($sqlstr) or die("Cannot query calendar event reminders table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                                while($row2 = mysql_fetch_array($query2)) {
                                    $row2 = gmqfix($row2,1);
				    #mqfix($row2,1);

                            //print "reminder contacts loop<br><br>";

                                    if($row2["contyp"] == "M" || $row2["contyp"] == "U") {

                                        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row2["conid"];
                                        $query3 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                                        while($row3 = mysql_fetch_array($query3)) {
                                            $row3 = gmqfix($row3,1);
					    #mqfix($row3,1);
                                            if(checkevtime($row3["tzos"])==true) {
                                                $rcar[$rcarcnt]["name"] = $row3["fname"]." ".$row3["lname"];
                                                $rcar[$rcarcnt]["email"] = $row3["email"];
                                                $rcar[$rcarcnt]["emailtype"] = $row3["emailtype"];
                                                $rcar[$rcarcnt]["tzos"] = $row3["tzos"];
                                                $rcar[$rcarcnt]["ctype"] = $row2["contyp"];
                                                $rcar[$rcarcnt]["evid"] = $row["evid"];
                                                $rcar[$rcarcnt]["calid"] = $row["calid"];
                                                $rcar[$rcarcnt]["uid"] = $row["uid"];
                                                $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                                $rcar[$rcarcnt]["evcname"] = $evcname;
                                                $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                                $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                                $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                                $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                                $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                                $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                                $rcar[$rcarcnt]["series"] = 1;

                                                $rcarcnt++;
                                                break;
                                            }
                                        }

                                        @mysql_free_result($query3);

                                    } elseif($row2["contyp"] == "C") {

                                        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con where conid = ".$row2["conid"]." order by lname,fname";
                                        $query3 = mysql_query($sqlstr) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                                        while($row3 = mysql_fetch_array($query3)) {
                                            $row3 = gmqfix($row3,1);
					    #mqfix($row3,1);
                                            $cstzadj = ($row3["tzos"] * 60 * 60) - $servertzos;
                                            #if(checkevtime($row3["tzos"])==true) {
                                            if(checkevtime($cstzadj)==true) {
                                                $rcar[$rcarcnt]["name"] = $row3["fname"]." ".$row3["lname"];
                                                $rcar[$rcarcnt]["email"] = $row3["email"];
                                                $rcar[$rcarcnt]["emailtype"] = $row3["emailtype"];
                                                $rcar[$rcarcnt]["tzos"] = $cstzadj;
                                                $rcar[$rcarcnt]["ctype"] = "C";
                                                $rcar[$rcarcnt]["evid"] = $row["evid"];
                                                $rcar[$rcarcnt]["calid"] = $row["calid"];
                                                $rcar[$rcarcnt]["uid"] = $row["uid"];
                                                $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                                $rcar[$rcarcnt]["evcname"] = $evcname;
                                                $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                                $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                                $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                                $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                                $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                                $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                                $rcar[$rcarcnt]["series"] = 1;

                                                $rcarcnt++;
                                                break;
                                            }
                                        }

                                        @mysql_free_result($query3);

                                    } elseif($row2["contyp"] == "G") {

                                        #$sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con where congp = ".$row2["conid"];
                                        $sqlstr = "SELECT l.congpid,l.conid,c.* FROM ".$GLOBALS["tabpre"]."_user_congrp_link l left join ".$GLOBALS["tabpre"]."_user_con c on l.conid = c.conid WHERE l.congpid = ".$row2["conid"]." order by lname,fname";
                                        $query3 = mysql_query($sqlstr) or die("Cannot query user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                                        while($row3 = mysql_fetch_array($query3)) {
                                            $row3 = gmqfix($row3,1);
					    #mqfix($row3,1);
                                            $cstzadj = ($row3["tzos"] * 60 * 60) - $servertzos;
                                            #if(checkevtime($row3["tzos"])==true) {
                                            if(checkevtime($cstzadj)==true) {
                                                $rcar[$rcarcnt]["name"] = $row3["fname"]." ".$row3["lname"];
                                                $rcar[$rcarcnt]["email"] = $row3["email"];
                                                $rcar[$rcarcnt]["emailtype"] = $row3["emailtype"];
                                                $rcar[$rcarcnt]["tzos"] = $cstzadj;
                                                $rcar[$rcarcnt]["ctype"] = "G";
                                                $rcar[$rcarcnt]["evid"] = $row["evid"];
                                                $rcar[$rcarcnt]["calid"] = $row["calid"];
                                                $rcar[$rcarcnt]["uid"] = $row["uid"];
                                                $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                                $rcar[$rcarcnt]["evcname"] = $evcname;
                                                $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                                $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                                $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                                $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                                $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                                $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                                $rcar[$rcarcnt]["series"] = 1;

                                                $rcarcnt++;
                                            }
                                        }

                                        @mysql_free_result($query3);

                                    } elseif($row2["contyp"] == "A") {

                                        if($row2["confirmed"]==1 && $row2["approved"]==1) {
                                            $cstzadj = ($row2["rtzos"] * 60 * 60) - $servertzos;
                                            #if(checkevtime($row2["rtzos"])==true) {
                                            if(checkevtime($cstzadj)==true) {
                                                $rcar[$rcarcnt]["name"] = $row2["fname"]." ".$row2["lname"];
                                                $rcar[$rcarcnt]["email"] = $row2["remail"];
                                                $rcar[$rcarcnt]["emailtype"] = $row2["remailtype"];
                                                $rcar[$rcarcnt]["tzos"] = $cstzadj;
                                                $rcar[$rcarcnt]["ctype"] = "A";
                                                $rcar[$rcarcnt]["evid"] = $row["evid"];
                                                $rcar[$rcarcnt]["calid"] = $row["calid"];
                                                $rcar[$rcarcnt]["uid"] = $row["uid"];
                                                $rcar[$rcarcnt]["evdate"] = $chkevdate;
                                                $rcar[$rcarcnt]["evcname"] = $evcname;
                                                $rcar[$rcarcnt]["evcemail"] = $evcemail;
                                                $rcar[$rcarcnt]["evtimeremain"] = $evtimeremain;
                                                $rcar[$rcarcnt]["evtimeuntil"] = $evtimeuntil;
                                                $rcar[$rcarcnt]["srint"] = $row2["srint"];
                                                $rcar[$rcarcnt]["srval"] = $row2["srval"];
                                                $rcar[$rcarcnt]["confirmkey"] = $row2["confirmkey"];
                                                $rcar[$rcarcnt]["series"] = 1;

                                                $rcarcnt++;
                                            }
                                        }
                                    }
                                }

                                @mysql_free_result($query2);

            }
        }

        @mysql_free_result($query1);

} // end for reminder days in future check loop

print "Sendinig Emails...<br><br>";

#print_r($rcar);
#exit();
#print "<br><br>";

foreach($rcar as $k1 => $v1) {

    $sqlstr = "SELECT count(*) as rlcnt FROM ".$GLOBALS["tabpre"]."_log WHERE calid = '".$rcar[$k1]["calid"]."' and evid = ".$rcar[$k1]["evid"]." and adate = ".$rcar[$k1]["evdate"]." and laction='Send Reminder: ".$rcar[$k1]["email"]."' and remarks = '".$rcar[$k1]["evtimeremain"]."'";
    $query2 = mysql_query($sqlstr) or die("Cannot query calendar event reminder log table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row2 = mysql_fetch_array($query2);
    $rlcnt = $row2["rlcnt"];

    $sqloutstr = $sqlstr;    //used for debugging
#print $sqloutstr;
#print "<br><br>";

    @mysql_free_result($query2);

    if($rlcnt > 0) {
        continue;
    }

#print "<br><br>getting timetype";

    $sqlstr = "SELECT timetype FROM ".$GLOBALS["tabpre"]."_cal_ini WHERE calid = '".$rcar[$k1]["calid"]."'";
    $query2 = mysql_query($sqlstr) or die("Cannot query calendar ini table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row2 = mysql_fetch_array($query2);
    $ccfgtime = $row2["timetype"];
    @mysql_free_result($query2);


#print "<br><br>getting events";

$sqlstr = "Select * from ".$GLOBALS["tabpre"]."_cal_events where evid = ".$rcar[$k1]["evid"];
$query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

//print "Rem SQL: ".$sqlstr."<br><br>";

while($row = mysql_fetch_array($query1)) {
    $row = gmqfix($row,1);
    #mqfix($row,1);



    $chkdar = getdate($rcar[$k1]["evdate"]);
    $chkyear = sprintf("%04d",$chkdar["year"]);
    $chkmonth = sprintf("%02d",$chkdar["mon"]);
    $chkday = sprintf("%02d",$chkdar["mday"]);
    $chkhour = sprintf("%02d",$chkdar["hours"]);
    $chkmin = sprintf("%02d",$chkdar["minutes"]);

#print "<br><br>got event, setting text";

    #$chksaved = sprintf("%04d-%02d-%02d", $chkyear,$chkmonth,$chkday);


#text mail

$emtextb ="Hello ".$rcar[$k1]["name"].",

This is an Event Reminder being sent to you by the CaLogic Calendar
application running at:

".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].")

This event was created by: ".$rcar[$k1]["evcname"]."  ".$rcar[$k1]["evcemail"]."

      You opted to be reminded ".$rcar[$k1]["evtimeremain"]." before the event takes place.

      Event will take place in: ".$rcar[$k1]["evtimeuntil"]."

** Event Information **

      Title: ".$row["title"]."
".$GLOBALS["subtitletxt"]." ".$row["subtitle"]."

   Category: ";
if($row["catid"] == 0) {
    $emtextb .= "None assigned";
} else {
    $sqlstr = "SELECT * FROM ".$GLOBALS["tabpre"]."_user_cat WHERE catid = ".$row["catid"];
    $query2 = mysql_query($sqlstr) or die("Cannot query user category table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row2 = mysql_fetch_array($query2);
    $row2 = gmqfix($row2,1);
    #mqfix($row2,1);
    $emtextb .= $row2["catname"];

    @mysql_free_result($query2);
}

$emtextb .= "
       Date: ";

$tmtxt = $chkmonth;
if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
$emtextb .= $chkday.".".$monthtextl[$tmtxt].".".$chkyear;
$emtextb .= "
       Time: ";

if($row["isallday"] == 1) {
    $emtextb .= "This is an all day event";
} else {
    #$emtextb .= "From: ".$row["starthour"].":".$row["startmin"]."  To: ".$row["endhour"].":".$row["endmin"];

            if($ccfgtime==1) {
                $emtextb .= "From: ".$row["starthour"].":".$row["startmin"]."  To: ".$row["endhour"].":".$row["endmin"];
            } else {
                $emtextb .= "From: ".date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990))." To: ".date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990));
            }


}
$emtextb .= "
Description: ".wordwrap($row["description"], 75, "\n", 0)."\n\n";
$emtextb .= "
Extents:
".getextentstxt($rcar[$k1]["evid"]);

if($rcar[$k1]["ctype"] == "A") {

$emtextb .= "


If you no longer wish to be reminded of this event, just enter
this link into your browser.

".$GLOBALS["baseurl"].$GLOBALS["progdir"]."canevsub.php?xrkey=".$rcar[$k1]["confirmkey"]."


If there is a problem canceling your reminder, you may be prompted to
enter a key. Here is the key to enter:

".$rcar[$k1]["confirmkey"]."

";
}




if($remtesting == true) {
    $emtextb .= "\n\n\n
This is a test, you are receiving this mail because you created a Calendar and or event with reminder
at the demo calendar web site of CaLogic, or the person who created this event with reminder has you as his/her contact,
and has included you in the reminder.";
}
$emtextb .= "\n";


# sms mail

$emsmsb = "";
$emsmssub = "";
$emsmssub = $row["title"];

#$emsmsb .= "CaLogic reminder\n";
#if($rcar[$k1]["ctype"] == "A") {
    #$emsmsb .= "Subscription cancelation link:\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."canevsub.php?xrkey=".$rcar[$k1]["confirmkey"]."\n";
#}

#$emsmsb .= "By: ".$rcar[$k1]["evcname"]."
#In: ".$rcar[$k1]["evtimeuntil"]."
#Title: ".$row["title"]."\n";
/*
if($row["catid"] == 0) {
    #$emsmsb .= "None assigned";
} else {
    $sqlstr = "SELECT * FROM ".$GLOBALS["tabpre"]."_user_cat WHERE catid = ".$row["catid"];
    $query2 = mysql_query($sqlstr) or die("Cannot query user category table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row2 = mysql_fetch_array($query2);
    $row2 = gmqfix($row2,1);
    #mqfix($row2,1);

    $emsmsb .= "Cat: ".$row2["catname"]."\n";

    @mysql_free_result($query2);
}
*/
$emsmsb .= "On: ";

$tmtxt = $chkmonth;
if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
$emsmsb .= $chkday.".".$monthtext[$tmtxt].".".$chkyear."\n";

/*
$emsmsb .= "
Time: ";
*/

if($row["isallday"] == 1) {
    $emsmsb .= "all day\n";
} else {

    if($ccfgtime==1) {
        $emsmsb .= "From: ".$row["starthour"].":".$row["startmin"]."  To: ".$row["endhour"].":".$row["endmin"]."\n";
    } else {
        $emsmsb .= "From: ".date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990))." To: ".date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990))."\n";
    }
}
$emsmsb .= "Desc: ".wordwrap($row["description"], 75, "\n", 0);
/*
$emsmsb .= "
Extents:
".getextentstxt($rcar[$k1]["evid"]);
*/

$realemsms = $emsmsb;

$emsmsb = substr($emsmsb,0,(150 - strlen($emsmssub)));


# html mail

        $regembody="<HTML><BODY>Hello ".$rcar[$k1]["name"].",<br><br>
        This is an Event Reminder being sent to you by the CaLogic Calendar application running at
        ".$GLOBALS["sitetitle"]." (<a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."\">".$GLOBALS["baseurl"]."</a>).<br><br>
        This event was created by: <a href=\"mailto:".$rcar[$k1]["evcemail"]."\">".$rcar[$k1]["evcname"]."</a><br><br>

        <b>You opted to be reminded ".$rcar[$k1]["evtimeremain"]." before the event takes place.</b><br><br>

        <b>Event will take place in: ".$rcar[$k1]["evtimeuntil"]."</b><br><br>

        <h3>Event Information</h3><br>

        <table border=\"0\" width=\"100%\">
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">Title:</th>
        <td width=\"88%\" valign=\"top\">

        ".$row["title"]."

        </td>
        </tr>
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">".$GLOBALS["subtitletxt"]."</th>
        <td width=\"88%\" valign=\"top\">

        ".$row["subtitle"]."

        </td>
        </tr>
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">Category:</th>
        <td width=\"88%\" valign=\"top\">";

        if($row["catid"] == 0) {
            $regembody .= "None assigned";
        } else {
            $sqlstr = "SELECT * FROM ".$GLOBALS["tabpre"]."_user_cat WHERE catid = ".$row["catid"];
            $query2 = mysql_query($sqlstr) or die("Cannot query user category table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = mysql_fetch_array($query2);
            $row2 = gmqfix($row2,1);
            #mqfix($row2,1);
            $regembody .= $row2["catname"];
            @mysql_free_result($query2);
        }

        $regembody .= "</td>
        </tr>
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">Description:</th>
        <td width=\"88%\" valign=\"top\">

        ".nl2br($row["description"])."

        </td>
        </tr>
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">
        Date:</th>
        <td width=\"88%\" valign=\"top\">";

        $tmtxt = $chkmonth;
        if(substr($tmtxt,0,1) == "0") {$tmtxt = substr($tmtxt,1,1);}
        $regembody .= $chkday.".".$monthtextl[$tmtxt].".".$chkyear;
        $regembody .= "</td>
        </tr>
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">
        Time:</th>
        <td width=\"88%\" valign=\"top\">";

        if($row["isallday"] == 1) {
            $regembody .= "This is an all day event\n";
        } else {
            #$regembody .= "From: ".$row["starthour"].":".$row["startmin"]."&nbsp;&nbsp;To: ".$row["endhour"].":".$row["endmin"];

            if($ccfgtime==1) {
                $regembody .= "From: ".$row["starthour"].":".$row["startmin"]."&nbsp;&nbsp;To: ".$row["endhour"].":".$row["endmin"];
            } else {
                $regembody .= "From: ".date("h:i A", mktime($row["starthour"],$row["startmin"],0,3,3,1990))."&nbsp;&nbsp;To: ".date("h:i A", mktime($row["endhour"],$row["endmin"],0,3,3,1990));
            }
        }


        $regembody .= "</td>
        </tr>
        <tr>
        <th align=\"left\" width=\"12%\" valign=\"top\">
        Extents:</th>
        <td width=\"88%\" valign=\"top\">";
        $regembody .= getextentstxt($rcar[$k1]["evid"]);
        $regembody .= "</td></tr>
        </table>";

if($rcar[$k1]["ctype"] == "A") {

$regembody .=  "
<br><br><br>
If you no longer wish to be reminded of this event, just click
this link.<br><br>

<a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."canevsub.php?xrkey=".$rcar[$k1]["confirmkey"]."\" target=\"_blank\">Cancel Reminder</a>

<br><br>If there is a problem canceling your reminder, you may be prompted to
enter a key. Here is the key to enter:

<br><br>".$rcar[$k1]["confirmkey"]."

";
}

if($remtesting == true) {
        $regembody .= "<br><br><br><b>
        This is a test, you are receiving this mail because you created a Calendar and or event with reminder
        at the demo calendar web site of CaLogic, or the person who created this event with reminder has you as his/her contact,
        and has included you in the reminder.
        </b>";
}
        $regembody .= "</body></html>";

#print "<br><br>sending mail";

    $toname = $rcar[$k1]["name"];
    $tomail = $rcar[$k1]["email"];

    $remindermail = new htmlMimeMail();

/*
    if($GLOBALS["mailastext"]==0) {
        $remindermail->setHtml($regembody, $emtextb);
    } else {
        $remindermail->setText($emtextb);
    }
*/
	if($rcar[$k1]["emailtype"]=="HTML") {
            $remindermail->setSubject("Event Reminder");
	    $remindermail->setHtml($regembody, $emtextb);
	} elseif($rcar[$k1]["emailtype"]=="TEXT") {
            $remindermail->setSubject("Event Reminder");
	    $remindermail->setText($emtextb);
	} else {
            $remindermail->setSubject($emsmssub);
	    $remindermail->setText($emsmsb);
	}


        if($GLOBALS["uniem"] == 1) {
            $toadr="$toname <$tomail>";
            $fromadr=$rcar[$k1]["evcname"]." <".$rcar[$k1]["evcemail"].">";
        } else {
            $toadr="$tomail";
            $fromadr=$rcar[$k1]["evcemail"];
        }

        $remindermail->setFrom($fromadr);

        if($GLOBALS["mailtype"]=="sendmail") {
            if(strlen(trim($tomail)) > 0) {
                #$remindermail->buildMessage();
                $result = $remindermail->send(array($toadr));
                $mailsent++;
            }
        } else {

            if(strlen($GLOBALS["smtpuser"])>0) {
                $emauth = true;
                $emuser = $GLOBALS["smtpuser"];
                $empass = $GLOBALS["smtppass"];
            } else {
                $emauth=false;
                $emuser = "";
                $empass = "";
            }

            $remindermail->setSMTPParams($GLOBALS["smtphost"],$GLOBALS["smtpport"],$emauth,$emuser,$empass);
            if(strlen(trim($tomail)) > 0) {
                #$remindermail->buildMessage();
                $result = $remindermail->send(array($toadr),'smtp');
                $mailsent++;
            }
        }

    #    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_log (uid,calid,evid,hldate,adate,laction) values(".$rcar[$k1]["uid"]."'".$row["calid"]."',".$rcar[$k1]["evid"].",".time().",'".$rcar[$k1]["evdate"]."','Send Reminder: ".$rcar[$k1]["email"]."')";
    #    $query2 = mysql_query($sqlstr) or die("Cannot insert into log table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        $logentry["uid"] = "0";
        $logentry["calid"] = $rcar[$k1]["calid"];
        $logentry["evid"] = $rcar[$k1]["evid"];
        $logentry["adate"] = $rcar[$k1]["evdate"];
        $logentry["laction"] = "Send Reminder: ".$rcar[$k1]["email"];
        $logentry["lbefore"] = " ";
        $logentry["lafter"] = " ";
        $logentry["remarks"] = $rcar[$k1]["evtimeremain"];
        histlog($logentry);

    } # end while

} # end for

#print "<br>".$realemsms."<br>";

print "Reminders check finished.<br><br>\n";
print $mailsent." Reminder mails sent.";

exit();

function checkevtime($atzos) {
    global $chkhour,$chkmin,$chkmonth,$chkday,$chkyear,$row2,$chkevdate,$evtimeremain,$evtimeuntil;

    $evtimeremain = "";
    $evtimeuntil = 0;
    $evtiltext = "";

    $dayuntil = 0;
    $houruntil = 0;
    $minuntil = 0;

// actual time being checked
    $chkrdate = mktime($chkhour,$chkmin,0,$chkmonth,$chkday,$chkyear);

// event subscriber (user / Contact / Anonymous) adjusted actual time
    $chkrdate = $chkrdate + $atzos;

    $chkrdar = getdate($chkrdate);
    $chkryear = $chkrdar["year"];
    $chkrmonth = $chkrdar["mon"];
    $chkrday = $chkrdar["mday"];
    $chkrhour = $chkrdar["hours"];
    $chkrmin = $chkrdar["minutes"];

# get interval in seconds
    if($row2["srint"] == 1){
// minutes
        $chkevadj = $row2["srval"] * 60;

        if($row2["srval"] > 1) {
            $evtimeremain = $row2["srval"]." minutes";
        } else {
            $evtimeremain = $row2["srval"]." minute";
        }

    } elseif($row2["srint"] == 2){
// hours
        $chkevadj = $row2["srval"] * 60 * 60;

        if($row2["srval"] > 1) {
            $evtimeremain = $row2["srval"]." hours";
        } else {
            $evtimeremain = $row2["srval"]." hour";
        }

    } elseif($row2["srint"] == 3){
// days
        $chkevadj = $row2["srval"] * 24 * 60 * 60;

        if($row2["srval"] > 1) {
            $evtimeremain = $row2["srval"]." days";
        } else {
            $evtimeremain = $row2["srval"]." day";
        }

    } else {
    // insert a record in reminder log that states there is a bad reminder interval for event {evid}
        return false;
    }

# if current time (adjusted) + reminder interval >= event time, then we must send reminder
    if($chkrdate + $chkevadj >= $chkevdate) {

# get true number of seconds until the event takes place
        $sectilev = $chkevdate - $chkrdate;

# round to nearest minute

        $evtimeuntil = round(($sectilev/60),0) * 60;

        if($evtimeuntil < 1) {
            $evtimeuntil = "Event has already taken place.";
        }elseif($evtimeuntil < 61) {
            $evtimeuntil = "less than one minute.";
        }else {

            $evtstsql = "select sec_to_time('".$evtimeuntil."') as timetoevent";
            $queryt = mysql_query($evtstsql) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$evtstsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $rowt = mysql_fetch_array($queryt);
            $evsqltime = $rowt["timetoevent"];
            @mysql_free_result($queryt);
            $evsqltime = split(":",$evsqltime);
            if($evsqltime[0] > 24) {
                $dayuntil = floor($evsqltime[0] / 24);
                $houruntil = $evsqltime[0] - ($dayuntil * 24);
            } else {
                $houruntil = $evsqltime[0];
            }
            $minuntil = $evsqltime[1];


            $evtimeuntil = $dayuntil;

            if($dayuntil != 1) {
                $evtimeuntil .= " days, ";
            }else {
                $evtimeuntil .= " day, ";
            }

            $evtimeuntil .= $houruntil;

            if($houruntil != 1) {
                $evtimeuntil .= " hours, ";
            }else {
                $evtimeuntil .= " hour, ";
            }

            $evtimeuntil .= $minuntil;

            if($minuntil != 1) {
                $evtimeuntil .= " minutes";
            }else {
                $evtimeuntil .= " minute";
            }

            $evtimeuntil .= " from now.";

        }

        return true;

    } else {

        return false;

    }

}
?>
