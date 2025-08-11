<?php

# changes for 1.1.10
$editingserieseventoccurance = false;
$exyear="";
$exmonth="";
$exday="";
$esoyear="";
$esomonth="";
$esoday="";

# changes for 1.1.10

function editeventform($cuser,$evid) {
    global $timear,$timeara,$curcalcfg,$monthtext,$monthtextl,$langcfg;

# changes for 1.1.10
    global $exyear,$exmonth,$exday,$editingserieseventoccurance;
# changes for 1.1.10

//prepare some field output
    $daypostxt[1] = "First";
    $daypostxt[2] = "Second";
    $daypostxt[3] = "Third";
    $daypostxt[4] = "Fourth";
    $daypostxt[5] = "Last";

    $wdaytxt[1] = $langcfg["wdnl1"];
    $wdaytxt[2] = $langcfg["wdnl2"];
    $wdaytxt[3] = $langcfg["wdnl3"];
    $wdaytxt[4] = $langcfg["wdnl4"];
    $wdaytxt[5] = $langcfg["wdnl5"];
    $wdaytxt[6] = $langcfg["wdnl6"];
    $wdaytxt[7] = $langcfg["wdnl7"];

    $wdaytxt[8] = "Weekday";
    $wdaytxt[9] = "Weekend day";
    $wdaytxt[10] = "Day";

    #$sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where uid = '".$cuser->gsv("cuid")."' and (calid = '".$cuser->gsv("curcalid")."' and evid = ".$evid.")";
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where (calid = '".$cuser->gsv("curcalid")."' and evid = ".$evid.")";
    $query1 = mysql_query($sqlstr) or die("Cannot query Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$evrow = mysql_fetch_array($query1);
$evrow = gmqfix($evrow,1);

@mysql_free_result($query1);


# Changes for 1.1.10

#    $fyear=$evrow["startyear"];
#    $fmonth=$evrow["startmonth"];
#    $fday=$evrow["startday"];

    if($editingserieseventoccurance == true) {
        $fyear=$exyear;
        $fmonth=$exmonth;
        $fday=$exday;
    } else {
        $fyear=$evrow["startyear"];
        $fmonth=$evrow["startmonth"];
        $fday=$evrow["startday"];
    }

# Changes for 1.1.10



    $fyear=$evrow["startyear"];
    $fmonth=$evrow["startmonth"];
    $fday=$evrow["startday"];
    $fhour=$evrow["starthour"];
    $fmin=$evrow["startmin"];
    $cuts = mktime($fhour,$fmin,0,$fmonth,$fday,$fyear);
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
    $islastpos = 1;
    $weekdayposcnt = 0;
    $islastposcnt = 0;

    while(($zfuncdate["mon"] == $xfuncdate["mon"])) {
        if(($zfuncdate["wday"] == $rfdow) && ($zfuncdate["mday"] <= $xfuncdate["mday"])) {
            $weekdaypos++;
            $weekdayposcnt++;
        }
        if($zfuncdate["mday"] > $xfuncdate["mday"]) {
            if($zfuncdate["wday"] == $rfdow) {
                $islastpos = 0;
                $islastposcnt++;
            }
        }

        $zfcday++;
        $tuts = mktime(0,0,0,$fmonth,$zfcday,$fyear);
        $zfuncdate = getdate($tuts);
    }
    if($islastpos == 1) {
        $weekdaypos=5;
    }
?>
<?php
print $GLOBALS["htmldoctype"];
?>

<HTML>
<HEAD>

<!--
changes for 1.1.0

<TITLE>CaLogic Edit Event</TITLE>
-->
<?php
    if($editingserieseventoccurance == true) {
        print "<TITLE>CaLogic Edit Event Series Occurance</TITLE>";
    } else {
        print "<TITLE>CaLogic Edit Event</TITLE>";
    }

?>

<!--
changes for 1.1.0
-->

<?php
include($GLOBALS["CLPath"]."/include/eventjscript.php");
?>
</HEAD>
<BODY <?php print $GLOBALS["calbodystyle"]; ?> LANGUAGE=javascript onload="return window_onload()">
<?php
//print $sqlstr;
//exit();
/*
    print "fyear: ".$fyear." <br>";
    print "fmonth: ".$fmonth." <br>";
    print "fday: ".$fday." <br>";
    print "fhour: ".$fhour." <br>";
    print "fmin: ".$fmin." <br>";
    print "cuts: ".$cuts." <br>";
    print "xfuncdate: ".$xfuncdate." <br>";
    print "fdow: ".$fdow." <br>";
    print "xfdow: ".$xfdow." <br>";
    print "rfdow: ".$rfdow." <br>";
    print "zfcday: ".$zfcday." <br>";
    print "tuts: ".$tuts." <br>";
    print "zfuncdate: ".$zfuncdate." <br>";
    print "weekdaypos: ".$weekdaypos." <br>";
    print "islastpos: ".$islastpos." <br>";
    print "weekdayposcnt ".$weekdayposcnt." <br>";
    print "islastposcnt ".$islastposcnt." <br>";

*/
    if($editingserieseventoccurance == true) {
        $h1text = "Edit Event Series Occurance";
    } else {
        $h1text = "Edit Event";
    }
?>
<h1><?php print $h1text; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="button" value="Save" id="saveevent" name="saveevent" language="javascript" onclick="cevent_onsubmit()">&nbsp;&nbsp;&nbsp;<INPUT type="button" value="Go to Calendar" id="doneevent" name="doneevent" LANGUAGE=javascript onclick="return doneevent_onclick()">
</h1>
<?php
    if($editingserieseventoccurance == true) {
        print "<h3>Changing this occurance will create this changed occurance as a new event. As well as add the original occurance to the exceptions list.</h3>";
    }
?>

<form method="<?php print $GLOBALS["postorget"]; ?>" name="cevent" id="cevent" action="<?php print $GLOBALS["idxfile"]; ?>" LANGUAGE=javascript onsubmit="return cevent_onsubmit()">
<input type="hidden" name="nef[nosave]" id="nosave" value="0" />
<input type="hidden" name="nef[alldayevent]" id="alldayevent" value="<?php print $evrow["isallday"]; ?>" />
<input type="hidden" name="nef[srcons]" id="srcons" value="" />
<input type="hidden" name="nef[srsubs]" id="srsubs" value="" />
<input type="hidden" name="savingevent" id="savingevent" value="0" />
<input type="hidden" name="edevid" id="edevid" value="<?php print $evid; ?>" />
<?php
print "<input type=\"hidden\" name=\"currentuser\" id=\"currentuser\" value=\"".$cuser->gsv("cuid")."\" />\n";
print "<input type=\"hidden\" name=\"currentcal\" id=\"currentcal\" value=\"".$cuser->gsv("curcalid")."\" />\n";
?>
<table border="1" cellspacing="2" cellpadding="1" width="100%">
  <tr>
    <td width="30%">
<div title="Enter the Title and <?php print $curcalcfg["gcscoif_subtitletxt"]; ?> of the event here. It will appear on the different Calendar views.">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%">
  <tr>
    <td width="25%"><b>Title:</b></td>
    <td width="75%">
    <input value="<?php print (($evrow["title"])); ?>" title="Enter the Title of the event here. It will appear on the different Calendar views." name="nef[eventtitle]" size="32" id="eventtitle" maxLength="50">
    </td>
  </tr>
  <tr>
    <td width="25%"><b><?php print $curcalcfg["gcscoif_subtitletxt"]; ?>:</b></td>
    <td width="75%">
    <input value="<?php print (($evrow["subtitle"])); ?>" title="Enter the <?php print $curcalcfg["gcscoif_subtitletxt"]; ?> of the event here. It will appear on the different Calendar views." name="nef[eventsubtitle]" size="32" id="eventsubtitle" maxLength="50">
    </td>
  </tr>
</table>
</div>
    </td>
    <td width="70%">

      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="35%">

            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td width="33%" nowrap>
<div title="Select the day on which the event occurs" >
                <b>Day</b>
</div>
                </td>
                <td width="33%" nowrap>
<div title="Select the month in which the event occurs" >
                <b>Month</b>
</div>
                </td>
                <td width="34%" nowrap>
<div title="Select the year in which the event occurs" >
                <b>Year</b>
</div>
                </td>
              </tr>
              <tr>
                <td width="33%" nowrap>
<div title="Select the day on which the event occurs" >
                <select size="1" id="eventday" style="WIDTH: 47px" name="nef[eventday]" LANGUAGE=javascript onchange="return eventday_onchange()">
<?php
    for($lc=1;$lc<=31;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
#changes for 1.1.10
#        if($evrow["startday"]==$mlc) {
        if($fday==$mlc) {
#changes for 1.1.10
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$mlc."</option>\n";
     }
    ?>
                </select>
</div>
                </td>
                <td width="33%" nowrap>
<div title="Select the month in which the event occurs" >
                <select size="1" id="eventmonth" style="WIDTH: 65px" name="nef[eventmonth]" LANGUAGE=javascript onchange="return eventmonth_onchange()">
<?php
    for($lc=1;$lc<=12;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
# changes for 1.1.10
#        if($evrow["startmonth"]==$mlc) {
        if($fmonth==$mlc) {
# changes for 1.1.10
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$monthtext[$lc]."</option>\n";
     }
    ?>
                </select>
</div>
                </td>
                <td width="34%" nowrap>
<div title="Select the year in which the event occurs" >
                <select size="1" id="eventyear" style="WIDTH: 70px" name="nef[eventyear]" LANGUAGE=javascript onchange="return eventyear_onchange()">
<?php
# changes for 1.1.10
#    for($lc=($evrow["startyear"]-1);$lc<=($evrow["startyear"]+4);$lc++) {
    for($lc=($fyear-1);$lc<=($fyear+4);$lc++) {
# changes for 1.1.10
		print "        <option ";
# changes for 1.1.10
#    if($evrow["startyear"]==$lc) {
        if($fyear==$lc) {
# changes for 1.1.10
            print "selected ";
        }
        print "value = \"".$lc."\" >".$lc."</option>\n";
     }
    ?>
                </select>
</div>
                </td>
              </tr>
            </table>

          </td>
          <td width="65%">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td width="33%" align="center" nowrap>
<div title="Select the event starting time. Leave the time fields blank for an All Day Event.">
                <b>Start Time</b>
</div>
                </td>
                <td width="33%" align="center" nowrap>
<div title="Select the event ending time. Leave the time fields blank for an All Day Event.">
                <b>End Time</b>
</div>
                </td>
                <td width="34%" nowrap>
&nbsp;<!--
<div title="Use the Durration field to help calculate the end of the event.">
                <b>Duration</b>
</div>
-->                </td>
              </tr>
              <tr>
                <td width="33%" align="center" nowrap>
<div title="Select the event starting time. Leave the time fields blank for an All Day Event.">
                <select size="1" name="nef[eventstarttimehour]" style="WIDTH: 70px" id="eventstarttimehour" LANGUAGE=javascript onchange="return eventstarttimehour_onchange()">
                <option <?php if($evrow["isallday"]==1) {print "selected";} ?> value = ""></option>
<?php
    for($lc=0;$lc<47;$lc++) {
		print "        <option ";
        if($evrow["starthour"]==substr($timear[$lc],0,2) && $evrow["isallday"]!=1) {
            print "selected ";
        }
        print "value = \"".substr($timear[$lc],0,2)."\" >";
        if($curcalcfg["timetype"]==1) {
            print substr($timear[$lc],0,2)."</option>\n";
        } else {
            if(strpos($timeara[$lc],":")==1) {
                print substr($timeara[$lc],0,1)." ".substr($timeara[$lc],5,2)."</option>\n";
            } else {
                print substr($timeara[$lc],0,2)." ".substr($timeara[$lc],6,2)."</option>\n";
            }
        }
        $lc++;
     }
    ?>

                </select> :
                <select size="1" name="nef[eventstarttimemin]" style="WIDTH: 60px" id="eventstarttimemin" LANGUAGE=javascript onchange="return eventstarttimemin_onchange()">
                <option <?php if($evrow["isallday"]==1) {print "selected";} ?> value = ""></option>
<?php
    for($lc=0;$lc<=59;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["startmin"]==$mlc && $evrow["isallday"]!=1) {
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$mlc."</option>\n";
     }
    ?>
                </select>
</div>
                </td>
                <td width="33%" align="center" nowrap>
<div title="Select the event ending time. Leave the time fields blank for an All Day Event.">
                <select size="1" name="nef[eventendtimehour]" style="WIDTH: 70px" id="eventendtimehour" LANGUAGE=javascript onchange="return eventendtimehour_onchange()">
                <option <?php if($evrow["isallday"]==1) {print "selected";} ?> value=""></option>
<?php
    for($lc=0;$lc<47;$lc++) {
		print "        <option ";
        if($evrow["endhour"]==substr($timear[$lc],0,2) && $evrow["isallday"]!=1) {
            print "selected ";
        }
        print "value = \"".substr($timear[$lc],0,2)."\" >";
        if($curcalcfg["timetype"]==1) {
            print substr($timear[$lc],0,2)."</option>\n";
        } else {
            if(strpos($timeara[$lc],":")==1) {
                print substr($timeara[$lc],0,1)." ".substr($timeara[$lc],5,2)."</option>\n";
            } else {
                print substr($timeara[$lc],0,2)." ".substr($timeara[$lc],6,2)."</option>\n";
            }
        }
        $lc++;
     }
    ?>
                </select> :
                <select size="1" name="nef[eventendtimemin]" style="WIDTH: 60px" id="eventendtimemin" LANGUAGE=javascript onchange="return eventendtimemin_onchange()">
                <option <?php if($evrow["isallday"]==1) {print "selected";} ?> value=""></option>
<?php
    for($lc=0;$lc<=59;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["endmin"]==$mlc && $evrow["isallday"]!=1) {
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$mlc."</option>\n";
     }
    ?>
                </select>
</div>
                </td>
                <td width="34%" nowrap>&nbsp;
<!--
<div title="Use the Durration field to help calculate the end of the event.">
		<select size="1" name="nef[eventlength]" style="WIDTH: 90px" id="eventlength"></select>
</div>
-->                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <!--
    <td width="24%">&nbsp;</td>
    -->
  </tr>
  <tr>
    <td width="30%" valign="top">
      <table border="0" cellspacing="2" cellpadding="1" width="100%">
        <tr>
          <td width="100%" valign="top" align="left">
<div title="Enter a description for the event. This description also gets sent with reminder mails.">
          &nbsp;<b>Description:</b>
</div>
          </td>
        </tr>
        <tr>
          <td width="100%">
<TEXTAREA title="Enter a description for the event. This description also gets sent with reminder mails." id="desc" style="WIDTH: 272px; HEIGHT: 117px" name="nef[desc]" rows="6" cols="31"><?php print ($evrow["description"]); ?></TEXTAREA>
          </td>
        </tr>
        <tr>
          <td width="100%">
<div title="Select a categroy for the event.">
          <b>Category:</b>
        <select size="1" name="pcat" style="WIDTH: 195px" id="cat" LANGUAGE=javascript onchange="return cat_onchange()">
        <option <?php if($evrow["catid"]==0) {print "selected";} ?> value="0">none</option>
<?php
#    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_cat where (uid = '".$cuser->gsv("cuid")."' and (calid = '".$cuser->gsv("curcalid")."' or calid = '0')) or calid='-2'";
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_cat where ((uid=".$cuser->gsv("cuid")." and (calid = '".$cuser->gsv("curcalid")."' or calid='0')) or (calid='-2'))";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Category Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
	print "        <option ";
        if($evrow["catid"]==$row["catid"]) {
            print " selected ";
            $xcurctc = $row["catcolortext"];
            $xcurcbc = $row["catcolorbg"];
        }
        print "value = \"".$row["catid"]."|".$row["catcolortext"]."|".$row["catcolorbg"]."\">".$row["catname"]."</option>\n";
     }
     mysql_free_result($query1);
    ?>
        </select>
        <input type="hidden" name="nef[cat]" id="rcat" value="<?php print $evrow["catid"]; ?>">
</div>
    <table border="1" width="272px"><tr>
    <TD id="cexampcell" <?php if($evrow["catid"]!=0) {echo "bgcolor=\"".$xcurcbc."\"";} ?>>
    <font id="cexampfont" color="<?php
    if($evrow["catid"]==0) {
        echo $curcalcfg["gcscocf_btxtcolor"]."\"";
    } else {
        echo $xcurctc."\"";
    } ?>>This box will show you an example<br>of the category you choose.</font>
    </TD></tr></table>
</td>
 </tr>
        <tr>
          <td width="100%" align="center">

<?php
if($GLOBALS["allowreminders"] == 1) {
?>
          <hr size="1" />
          <INPUT <?php if($evrow["sendreminder"]==1) {print "checked";} ?> title="Check this box to send a reminder for this event." type="checkbox" id="sendreminder" name="nef[sendreminder]" LANGUAGE=javascript onclick="return sendreminder_onclick()">
          <label title="Check this box to send a reminder for this event." for="sendreminder"><b>Send Reminder</b></label>
<div style="display: <?php if($evrow["sendreminder"]==1) {print "inline";} else {print "none";} ?> " id="reminderbox">
      <table border="0" cellspacing="1" cellpadding="0" width="100%">
        <tr>
          <td width="45%" valign="top" align="center">
            <div style="display: inline" title="Add contacts to the reminder list by double clicking the entry.">
            Contacts List<br>
            <SELECT style="WIDTH: 130px" id="allcontacts" size="5" name="nef[allcontacts]" LANGUAGE=javascript ondblclick="return allcontacts_ondblclick()">
<?php
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$cuser->gsv("cuid")." and calid = '".$cuser->gsv("curcalid")."' and evid=".$evid." and contyp='M' and conid=".$cuser->gsv("cuid");
    $query1 = mysql_query($sqlstr) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $numrows = @mysql_num_rows($query1);
    if($numrows != 1) {
        print "<option value=\"M0\" text=\"Myself\">Myself</option>";
    }
    @mysql_free_result($query1);

    $sqlstr = "select congpid,gpname from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$cuser->gsv("cuid")." or shared = 1 order by gpname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Group Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        $sqlstr2 = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$cuser->gsv("cuid")." and calid = '".$cuser->gsv("curcalid")."' and evid=".$evid." and contyp='G' and conid=".$row["congpid"];
        $query2 = mysql_query($sqlstr2) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $numrows = @mysql_num_rows($query2);
        if($numrows != 1) {
    		print "        <option ";
            print "value = \"G".$row["congpid"]."\" text=\"G ".$row["gpname"]."\">G ".$row["gpname"]."</option>\n";
        }
        @mysql_free_result($query2);
     }
     mysql_free_result($query1);

    $sqlstr = "select conid,fname,lname from ".$GLOBALS["tabpre"]."_user_con where uid = ".$cuser->gsv("cuid")." or shared = 1 order by lname,fname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        $sqlstr2 = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$cuser->gsv("cuid")." and calid = '".$cuser->gsv("curcalid")."' and evid=".$evid." and contyp='C' and conid=".$row["conid"];
        $query2 = mysql_query($sqlstr2) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $numrows = @mysql_num_rows($query2);
        if($numrows != 1) {
    		print "        <option ";
            print "value = \"C".$row["conid"]."\" text=\"C ".$row["fname"]." ".$row["lname"]."\">C ".implode(", ",array($row["lname"],$row["fname"]))."</option>\n";
        }
        @mysql_free_result($query2);
     }
     mysql_free_result($query1);
?>
            </SELECT><br>
            <button title="Click this button to add all contacts to the reminder list." style="WIDTH: 130px;" LANGUAGE=javascript onclick="return addalllist_onclick()">->&nbsp;Add All&nbsp;-></button>
</div>
          </td>
          <td width="45%" valign="top" align="center">
<div style="display: inline" title="Remove contacts from the reminder list by double clicking the entry.">
            To List<br>
            <SELECT style="WIDTH: 130px" id="remindercontacts" size="5" name="nef[remindercontacts]" LANGUAGE=javascript ondblclick="return remindercontacts_ondblclick()" onchange="return remindercontacts_onchange()">

<?php

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$cuser->gsv("cuid")." and calid = '".$cuser->gsv("curcalid")."' and evid=".$evid." and contyp='M' and conid=".$cuser->gsv("cuid");

    $query1 = mysql_query($sqlstr) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $numrows = @mysql_num_rows($query1);
    if($numrows == 1) {
        @mysql_free_result($query1);
        $query1 = mysql_query($sqlstr) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = @mysql_fetch_array($query1);
        $row = gmqfix($row,1);
        print "<option value=\"M0"."|".$row["srval"]."|".$row["srint"]."\" text=\"Myself\">Myself</option>";
    }
    @mysql_free_result($query1);

    $sqlstr = "select congpid,gpname from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$cuser->gsv("cuid")." or shared = 1 order by gpname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Group Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        $sqlstr2 = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$cuser->gsv("cuid")." and calid = '".$cuser->gsv("curcalid")."' and evid=".$evid." and contyp='G' and conid=".$row["congpid"];
        $query2 = mysql_query($sqlstr2) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $numrows = @mysql_num_rows($query2);
        if($numrows == 1) {

            @mysql_free_result($query2);
            $query2 = mysql_query($sqlstr2) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = @mysql_fetch_array($query2);
            $row2 = gmqfix($row2,1);

    	    print "        <option ";
            print "value = \"G".$row["congpid"]."|".$row2["srval"]."|".$row2["srint"]."\" text=\"G ".$row["gpname"]."\">G ".$row["gpname"]."</option>\n";
        }
        @mysql_free_result($query2);
     }
     mysql_free_result($query1);

    $sqlstr = "select conid,fname,lname from ".$GLOBALS["tabpre"]."_user_con where uid = ".$cuser->gsv("cuid")." or shared = 1 order by lname,fname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        $sqlstr2 = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$cuser->gsv("cuid")." and calid = '".$cuser->gsv("curcalid")."' and evid=".$evid." and contyp='C' and conid=".$row["conid"];
        $query2 = mysql_query($sqlstr2) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $numrows = @mysql_num_rows($query2);
        if($numrows == 1) {

            @mysql_free_result($query2);
            $query2 = mysql_query($sqlstr2) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = @mysql_fetch_array($query2);
            $row2 = gmqfix($row2,1);

    		print "        <option ";
            print "value = \"C".$row["conid"]."|".$row2["srval"]."|".$row2["srint"]."\" text=\"C ".$row["fname"]." ".$row["lname"]."\">C ".implode(", ",array($row["lname"],$row["fname"]))."</option>\n";
        }
        @mysql_free_result($query2);
     }
     mysql_free_result($query1);
?>
            </SELECT><br>
            <button title="Click this button to remove all contacts from the reminder list." style="WIDTH: 130px;" LANGUAGE=javascript onclick="return removealllist_onclick()"><-&nbsp;Remove All&nbsp;<-</button>
</div>
          </td>
        </tr>
        <tr>
        </tr>
        <tr>
        <td colspan="2" align="left" valign="top">
        <hr size="1" />
        <table border="0" cellspacing="1" cellpadding="0" width="100%">
        <tr>
          <td width="10%" valign="middle" align="left" nowrap>
        Send<br>
        Reminder&nbsp;
        </td>
        <td width="75%" valign="middle" align="center" nowrap>
        <input id="srval" name="nef[srval]" type="text" style="WIDTH: 30px" value="3">&nbsp;
        <SELECT style="WIDTH: 100px" id="srint" size="1" name="nef[srint]">
<?php
if($GLOBALS["rinterval"] == 1) {
?>
        <option value="1">Minutes</option>
        <option value="2">Hours</option>
        <option value="3" selected>days</option>
<?php
} elseif($GLOBALS["rinterval"] == 2) {
?>
        <option value="2">Hours</option>
        <option value="3" selected>days</option>

<?php
} elseif($GLOBALS["rinterval"] == 3) {
?>
        <option value="3" selected>days</option>
<?php
}
?>
        </select>
        </td>
        <td width="15%" valign="middle" align="left" nowrap>
        &nbsp;before event<br>
        &nbsp;takes place
        </td></tr></table>
        <hr size="1" />
        </td>
        <tr>
        <td colspan="2" align="left" valign="top">
        Double click list entry to add or remove. Only Contacts with an E-Mail adr. will be sent a reminder.
        You can set a different reminder interval for each contact added. Set the interval before adding to list.
        <br><br>
        <b>Reminders get checked<br>
        every&nbsp;<?php print $GLOBALS["rfrequency"]."&nbsp;".$GLOBALS["rfrtval"]; ?></b>
        </td>
        </tr>
        </table>
</div>
<?php
if($curcalcfg["caltype"] < "2") {
    if($evrow["remsuballow"]==0) {
        $rsubtxt = "";
        $rsdivtxt = " none";
    } else {
        $rsubtxt = " checked ";
        $rsdivtxt = " inline";
    }
?>
        <hr size="1" />
        <INPUT <?php print $rsubtxt; ?> title="Check this box to allow Event Reminder Subscription Options." type="checkbox" id="remsuballow" name="nef[remsuballow]" LANGUAGE=javascript onclick="return remsuballow_onclick()">
        <label title="Check this box to allow Event Reminder Subscription Options." for="remsuballow"><b>Allow Event Reminder Subscriptions</b></label>
<div style="display: <?php print $rsdivtxt; ?>" id="divremsubopts" title="Set Event Reminder Subscription Options.">
        <table border="0" cellspacing="1" cellpadding="0" width="100%">
        <tr>
        <td width="100%" valign="top" align="center">
        <br>
        Select who may subscribe for an Event Reminder<br>
        <SELECT size="1" name="nef[remsublevel]" id="remsublevel">
        <option value="0" <?php if($evrow["remsublevel"]==0) {print "selected";} ?>>Anyone</option>
        <option value="1" <?php if($evrow["remsublevel"]==1) {print "selected";} ?>>Registered Users</option>
        </select>
        <br><br>
        <b>Subscriber List:</b><br>
        <input type="button" title="Add a new subscriber" value="Add New" id="addnewsubscriber" name="addnewsubscriber" language="javascript" onclick="addnewsubscriber_onclick()">
        &nbsp;&nbsp;&nbsp;
        <input type="button" title="Remove the selected subscriber" value="Remove Selected" id="removesubscriber" name="removesubscriber" language="javascript" onclick="removesubscriber_onclick()">
        <br>
        <SELECT title="Click on a list item to view details" id="evsublist" style="OVERFLOW: scroll; WIDTH: 272px" size="5" name="evsublist" LANGUAGE=javascript onchange="return evsublist_onchange()">
<?php
# select used for event edit.
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where evid=".$evid." and (contyp='U' or contyp='A') order by lname,fname";
    $query1 = mysql_query($sqlstr) or die("Cannot query Event Reminder Subscription Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($rsrow = @mysql_fetch_array($query1)) {
        $rsrow = gmqfix($rsrow,1);
        print "<OPTION value=\"";
        if($rsrow["confirmed"] == "1") {
            $confirmtxt = " C";
        } else {
            $confirmtxt = "NC";
        }
        if($rsrow["contyp"] == "A") {
            print "A0|".$rsrow["fname"]."|".$rsrow["lname"]."|".$rsrow["remail"]."|".$rsrow["srval"]."|".$rsrow["srint"]."|".$rsrow["rtzos"]."|".$rsrow["remailtype"]."\">";
            print "[A,".$confirmtxt."] ".implode(", ",array($rsrow["lname"],$rsrow["fname"])).", ".$rsrow["remail"];
        } else {
            $sqlstr2 = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid=".$rsrow["conid"];
            $query2 = mysql_query($sqlstr2) or die("\"></option></select><br><br>Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $rsrow2 = @mysql_fetch_array($query2);
            $rsrow2 = gmqfix($rsrow2,1);
            print "U".$rsrow2["uid"]."|".$rsrow2["uname"]."|".$rsrow["srval"]."|".$rsrow["srint"]."\">";
            print "[U] ".implode(", ",array($rsrow2["lname"],$rsrow2["fname"]));
            @mysql_free_result($query2);
        }
        print "</OPTION>\n";
    }
    @mysql_free_result($query1);

?>
        </SELECT>
        <br>
        <b>Selected&nbsp;Entry Details:</b><br>
        <TEXTAREA readonly title="Shows selected entry details." id="selevsublist" style="OVERFLOW: auto; WIDTH: 272px; HEIGHT: 60px" name="selevsublist" rows="3" cols="31"></TEXTAREA>
        </td></tr></table>
</div>
<?php
}
} else {
    print "&nbsp;";
}
?>        </td>
      </table>
    </td>
    <td width="70%" align="left" valign="top">
      <INPUT <?php if($evrow["iseventseries"]==1) {print "checked";} ?> title="Check this box to create an Event Series" type="checkbox" id="eventrepeat" name="nef[eventrepeat]" LANGUAGE=javascript onclick="return eventrepeat_onclick()">
      <LABEL for="eventrepeat" title="Check this box to create an Event Series"><b>Event Series</b></LABEL>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php

$subsel = "select calid from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$cuser->gsv("cuid");
$subquery = mysql_query($subsel) or die("Cannot query cal ini Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$subsel."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$subcnt = false;
$incalstr = "";
while($subrow = @mysql_fetch_array($subquery)) {
    if($subcnt==false) {
        $subcnt = true;
        $incalstr=" and '".$cuser->gsv("curcalid")."' in('".$subrow["calid"]."'";
        continue;
    }
    $incalstr.=",'".$subrow["calid"]."'";
}
if($subcnt==true) {
    $incalstr.=") ";
}
@mysql_free_result($subquery);

$getextsql = "((uid = ".$cuser->gsv("cuid")." and calid ='".$cuser->gsv("curcalid")."') or
(uid = ".$cuser->gsv("cuid")." and calid = '0' ".$incalstr.") or
(uid = ".$cuser->gsv("cuid")." and calid = '-1') or
(uid = 0 and calid = '".$cuser->gsv("curcalid")."') or
(uid = -1 and calid = '".$cuser->gsv("cuid")."' ".$incalstr.") or
(uid = -1 and calid = '-1'))";

#print "<br>".$subsel."<br>";
#print "<br>".$incalstr."<br>";

$efrqtext = "";
$efrqtextdis = "";
$efrqtextcheck = "";
$efrqtextdiv = " none ";

$efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and required = 1 and ".$getextsql;

#print "<br>".$efsql."<br><br>";

$queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$numrows = @mysql_num_rows($queryexfd);
$extfldcnt = 0;
if($numrows > 0) {
    $efrqtext = " (Some extended fields required)";
#    $efrqtextdis = " disabled ";
    $efrqtextdis = " ";
    $efrqtextcheck = "checked ";
    $efrqtextdiv = " inline ";

}
@mysql_free_result($queryexfd);


      print "<INPUT ".$efrqtextcheck." ".$efrqtextdis." title=\"Check this box to add an extended field ".$efrqtext."\" type=\"checkbox\" id=\"extendedfields\"
      name=\"nef[extendedfields]\" LANGUAGE=javascript onclick=\"return extendedfields_onclick()\">\n";
      print "<LABEL id=\"extendedfieldslabel\" for=\"extendedfields\" title=\"Check this box to show extended fields ".$efrqtext."\"><b>Show Extended Fields ".$efrqtext."</b></LABEL>\n";

?>
        <hr size="1">

<div id="divseriesevent" style="display: <?php if($evrow["iseventseries"]==1) {print "inline";} else {print "none";} ?> ">

      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
        <!--
          <td width="100%" colspan="2">
        </td>
        -->
        </tr>
        <tr>
          <td width="15%" valign="top"><b>&nbsp;Type:</b>
        <hr size="1">
        <input type="radio" value="1" <?php if($evrow["estype"]==1 || $evrow["iseventseries"]!=1 ) {print "checked";} ?> title="Select this for a Daily Event." name="nef[estype]" id="rbday" maxLength=0 LANGUAGE="javascript"  onclick="return rbday_onclick()">
        <label title="Select this for a Daily Event." for="rbday">Daily</label><br>
        <input type="radio" value="2" <?php if($evrow["estype"]==2) {print "checked";} ?> title="Select this for a Weekly Event." name="nef[estype]" id="rbweek" maxLength=0 LANGUAGE="javascript"  onclick="return rbweek_onclick()">
        <label title="Select this for a Weekly Event." for="rbweek">Weekly</label><br>
        <input type="radio" value="3" <?php if($evrow["estype"]==3) {print "checked";} ?> title="Select this for a Monthly Event." name="nef[estype]" id="rbmonth" maxLength=0 LANGUAGE="javascript"  onclick="return rbmonth_onclick()">
        <label title="Select this for a Monthly Event." for="rbmonth">Monthly</label><br>
        <input type="radio" value="4" <?php if($evrow["estype"]==4) {print "checked";} ?> title="Select this for a Yearly Event." name="nef[estype]" id="rbyear" maxLength=0 LANGUAGE="javascript"  onclick="return rbyear_onclick()">
        <label title="Select this for a Yearly Event." for="rbyear">Yearly</label>
            </td>
          <td width="85%" valign="top"><b>&nbsp;Occurance:</b>
        <hr size="1">
      <DIV title="Configure your Daily Event." style="DISPLAY: <?php if($evrow["estype"]==1) {print "inline";} else {print "none";} ?> " id="divday">

<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=0>
	<TR>
		<TD NOWRAP width="100%">
			<input title="Select this for an event that occurs every so many days." <?php if($evrow["estd"]==1 || $evrow["estd"]==0) {print "checked";} ?> type="radio" name="nef[daytype]" value="1" id="eachday">
			<label title="Select this for an event that occurs every so many days."for="eachday">Every</label>&nbsp;
            <input title="Enter the interval in days." type="text" id="eachdaycount" name="nef[eachdaycount]" value="<?php if($evrow["estd"]==1 ) {print $evrow["estdint"];} else { print "1";} ?>" size="5">&nbsp;Day(s)
		</TD>
	</TR>
	<TR>
		<TD NOWRAP width="100%">
			<input <?php if($evrow["estd"]==2) {print "checked";} ?> title="Select this for an event that occurs every weekday." type="radio" name="nef[daytype]" value="2" id="eachweekday">
			<label title="Select this for an event that occurs every weekday." for="eachweekday">Every&nbsp;Weekday</label>
		</TD>
	</TR>
</TABLE>

      </DIV>
      <DIV title="Configure your Weekly Event." style="DISPLAY: <?php if($evrow["estype"]==2) {print "inline";} else {print "none";} ?> " id="divweek">

<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=0>
	<TR>
		<TD NOWRAP colspan="4" width="100%">Every&nbsp;
        <input title="Enter the weekly interval." type="text" id="eachweekcount" name="nef[eachweekcount]" value="<?php if($evrow["estype"]==2) {print $evrow["estwint"];} else {print "1";} ?>" size="5">&nbsp;Week(s)&nbsp;on
		</TD>
	</TR>
        <?php
        if($evrow["estype"]==2) {
        ?>
	<TR>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Mondays." type="checkbox" <?php if(substr($evrow["estwd"],0,1)==1) {print "checked"; } ?> value="1" name="nef[weekday1]" id="weekday1">
			<label title="Check this if the event occurs on Mondays." for="weekday1">Monday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Tuesdays." type="checkbox" <?php if(substr($evrow["estwd"],1,1)==1) {print "checked"; } ?>  value="2" name="nef[weekday2]" id="weekday2">
			<label title="Check this if the event occurs on Tuesdays." for="weekday2">Tuesday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Wednesdays." type="checkbox" <?php if(substr($evrow["estwd"],2,1)==1) {print "checked"; } ?>  value="3" name="nef[weekday3]" id="weekday3">
			<label title="Check this if the event occurs on Wednesdays." for="weekday3">Wednesday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Thursdays." type="checkbox" <?php if(substr($evrow["estwd"],3,1)==1) {print "checked"; } ?>  value="4" name="nef[weekday4]" id="weekday4">
			<label title="Check this if the event occurs on Thursdays." for="weekday4">Thursday</label>
		</TD>
	</TR>
	<TR>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Fridays." type="checkbox" <?php if(substr($evrow["estwd"],4,1)==1) {print "checked"; } ?>  value="5" name="nef[weekday5]" id="weekday5">
			<label title="Check this if the event occurs on Fridays." for="weekday5">Friday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Saturdays." type="checkbox" <?php if(substr($evrow["estwd"],5,1)==1) {print "checked"; } ?>  value="6" name="nef[weekday6]" id="weekday6">
			<label title="Check this if the event occurs on Saturdays." for="weekday6">Saturday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Sundays." type="checkbox" <?php if(substr($evrow["estwd"],6,1)==1) {print "checked"; } ?>  value="7" name="nef[weekday7]" id="weekday7">
			<label title="Check this if the event occurs on Sundays." for="weekday7">Sunday</label>
		</TD>
		<TD NOWRAP width="25%">&nbsp;</TD>
	</TR>
        <?php
        } else {
        ?>
	<TR>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Mondays." type="checkbox" <?php if($fdow==1) {print "checked"; } ?> value="1" name="nef[weekday1]" id="weekday1">
			<label title="Check this if the event occurs on Mondays." for="weekday1">Monday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Tuesdays." type="checkbox" <?php if($fdow==2) {print "checked"; } ?> value="2" name="nef[weekday2]" id="weekday2">
			<label title="Check this if the event occurs on Tuesdays." for="weekday2">Tuesday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Wednesdays." type="checkbox" <?php if($fdow==3) {print "checked"; } ?> value="3" name="nef[weekday3]" id="weekday3">
			<label title="Check this if the event occurs on Wednesdays." for="weekday3">Wednesday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Thursdays." type="checkbox" <?php if($fdow==4) {print "checked"; } ?> value="4" name="nef[weekday4]" id="weekday4">
			<label title="Check this if the event occurs on Thursdays." for="weekday4">Thursday</label>
		</TD>
	</TR>
	<TR>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Fridays." type="checkbox" <?php if($fdow==5) {print "checked"; } ?> value="5" name="nef[weekday5]" id="weekday5">
			<label title="Check this if the event occurs on Fridays." for="weekday5">Friday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Saturdays." type="checkbox" <?php if($fdow==6) {print "checked"; } ?> value="6" name="nef[weekday6]" id="weekday6">
			<label title="Check this if the event occurs on Saturdays." for="weekday6">Saturday</label>
		</TD>
		<TD NOWRAP width="25%">
			<input title="Check this if the event occurs on Sundays." type="checkbox" <?php if($fdow==7) {print "checked"; } ?> value="7" name="nef[weekday7]" id="weekday7">
			<label title="Check this if the event occurs on Sundays." for="weekday7">Sunday</label>
		</TD>
		<TD NOWRAP width="25%">&nbsp;</TD>
	</TR>
        <?php
        }
        ?>

</TABLE>

      </DIV>
      <DIV title="Configure your Monthly Event." style="DISPLAY: <?php if($evrow["estype"]==3) {print "inline";} else {print "none";} ?> " id="divmonth">
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=0>
	<TR>
		<TD NOWRAP width="100%">
			<input title="Select this for an event that occurs on the same day of every so many months." <?php if($evrow["estm"]==1 || $evrow["estm"]==0) {print "checked"; } ?> type="radio" name="nef[dayofmonth]" value="1" id="dayofmonth1">
			<label title="Select this for an event that occurs on the same day of every so many months." for="dayofmonth1">On&nbsp;the</label>&nbsp;
<div style="display:inline" title="Select the day of the month on which the event occurs." >
            <select size="1" id="dayofmonthday" style="WIDTH: 47px" name="nef[dayofmonthday]">
<?php
    for($lc=1;$lc<=31;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
# changes for 1.1.10
#        if($evrow["estm1d"]==$mlc || ($evrow["estm"]!=1 && $evrow["startday"]==$mlc) ) {
        if($evrow["estm1d"]==$mlc || ($evrow["estm"]!=1 && $fday==$mlc) ) {
# changes for 1.1.10
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$mlc."</option>\n";
     }
    ?>

            </select>
</div>
            &nbsp;Day,&nbsp;Every&nbsp;
            <input title="Enter the interval in months" type="text" id="dayofmonthcount" name="nef[dayofmonthcount]" value="<?php if($evrow["estm"]==1) {print $evrow["estm1int"];} else {print "1";} ?>" size="5">&nbsp;Month(s)
		</TD>
	</TR>
	<TR>
		<TD NOWRAP width="100%">
			<input title="Select this for an event that occurs on a certain day of every so many months." <?php if($evrow["estm"]==2) {print "checked"; } ?> type="radio" name="nef[dayofmonth]" value="2" id="dayofmonth2">
			<label title="Select this for an event that occurs on a certain day of every so many months." for="dayofmonth2">On&nbsp;the</label>&nbsp;
<div style="display:inline" title="Select which day the event occurs." >
            <select size="1" id="whichdayofmonth" name="nef[whichdayofmonth]" style="width: 93; height: 23">
<?php
    for($lc=1;$lc<=5;$lc++) {
		print "        <option ";
        if($evrow["estm2dp"]==$lc || ($evrow["estm"]!=2 && $weekdaypos==$lc)) {
            print "selected ";
        }
        print "value = \"".$lc."\" >".$daypostxt[$lc]."</option>\n";
     }
    ?>
            </select>&nbsp;
</div>
<div style="display:inline" title="Select the day on which the event occurs." >
			<select size="1" id="whichdayofmonthday" name="nef[whichdayofmonthday]" style="width: 92; height: 23">
<?php
    for($lc=1;$lc<=10;$lc++) {
		print "        <option ";
        if($evrow["estm2wd"]==$lc || ($evrow["estm"]!=2 && $fdow==$lc)) {
            print "selected ";
        }
        print "value = \"".$lc."\" >".$wdaytxt[$lc]."</option>\n";
     }
    ?>
            </select>,&nbsp;Every&nbsp;
</div>
            <input type="text" title="Enter the interval in months." id="whichdayofmonthcount" name="nef[whichdayofmonthcount]" value="<?php if($evrow["estm"]==2) {print $evrow["estm2int"];} else {print "1";} ?>" size="5">&nbsp;Month(s)
		</TD>
	</TR>
</TABLE>

      </DIV>
      <DIV title="Configure your Yearly Event." style="DISPLAY: <?php if($evrow["estype"]==4) {print "inline";} else {print "none";} ?> " id="divyear">
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=0>
	<TR>
		<TD NOWRAP width="100%">
			<input <?php if($evrow["esty"]==1 || $evrow["esty"]==0) {print "checked"; } ?> title="Select this for an event that occurs on the same day every year." type="radio" checked name="nef[dayofmonthyear]" value="1" id="dayofmonthyear1">
			<label title="Select this for an event that occurs on the same day every year." for="dayofmonthyear1">Every</label>&nbsp;&nbsp;&nbsp;
<div style="display:inline" title="Select the day on which the event occurs." >
			<select size="1" id="dayofmonthyearday" name="nef[dayofmonthyearday]" style="WIDTH: 47px">
<?php
    for($lc=1;$lc<=31;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["esty1d"]==$mlc || ($evrow["esty"]!=1 && $fday==$mlc)) {
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$mlc."</option>\n";
     }
    ?>
            </select>&nbsp;Day&nbsp;of&nbsp;
</div>
<div style="display:inline" title="Select the month in which the event occurs." >
            <select size="1" id="dayofmonthyearmonth" name="nef[dayofmonthyearmonth]" style="width: 89; height: 23">
<?php
    for($lc=1;$lc<=12;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["esty1m"]==$lc || ($evrow["esty"]!=1 && $xfuncdate["mon"]==$lc)) {
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$monthtextl[$lc]."</option>\n";
     }
    ?>

            </select>
</div>
		</TD>
	</TR>
	<TR>
		<TD NOWRAP width="100%">
			<input <?php if($evrow["esty"]==2) {print "checked"; } ?> title="Select this for an event that occurs on a certain day of a certain month of every year." type="radio" name="nef[dayofmonthyear]" value="2" id="dayofmonthyear2">
			<label title="Select this for an event that occurs on a certain day of a certain month of every year." for="dayofmonthyear2">On&nbsp;the</label>&nbsp;
<div style="display:inline" title="Select which day the event occurs." >
            <select size="1" id="whichdayofmonthyear" name="nef[whichdayofmonthyear]" style="width: 94; height: 23">
<?php
    for($lc=1;$lc<=5;$lc++) {
		print "        <option ";
        if($evrow["esty2dp"]==$lc || ($evrow["esty"]!=2 && $weekdaypos==$lc)) {
            print "selected ";
        }
        print "value = \"".$lc."\" >".$daypostxt[$lc]."</option>\n";
     }
    ?>
            </select>&nbsp;
</div>
<div style="display:inline" title="Select the day on which the event occurs." >
			<select size="1" id="whichdayofmonthyearday" name="nef[whichdayofmonthyearday]" style="width: 90; height: 23">
<?php
    for($lc=1;$lc<=10;$lc++) {
		print "        <option ";
        if($evrow["esty2wd"]==$lc || ($evrow["esty"]!=2 && $fdow==$lc)) {
            print "selected ";
        }
        print "value = \"".$lc."\" >".$wdaytxt[$lc]."</option>\n";
     }
    ?>
            </select>&nbsp;in&nbsp;
</div>
<div style="display:inline" title="Select the month in which the event occurs." >
            <select size="1" id="whichdayofmonthyearmonth" name="nef[whichdayofmonthyearmonth]" style="width: 82; height: 23">
<?php
    for($lc=1;$lc<=12;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["esty2m"]==$lc || ($evrow["esty"]!=2 && $xfuncdate["mon"]==$lc)) {
            print "selected ";
        }
        print "value = \"".$mlc."\" >".$monthtextl[$lc]."</option>\n";
     }
    ?>
            </select>
</div>
		</TD>
	</TR>
</TABLE>
      </DIV>

</td>
        </tr>
        <tr>

          <td width="100%" colspan="2">

<DIV style="DISPLAY: <?php if($evrow["iseventseries"] == 1) {print "inline";} else {print "none";} ?> " id="divsend">
        <hr size="1">

            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td width="15%">
    <b>Series&nbsp;End:</b></td>
                <td width="85%" colspan="2">
    <input <?php if($evrow["ese"]==0) {print "checked"; } ?> title="Select this if the event has no end date." type="radio" name="nef[eventend]" checked value="0" id="eventend1" LANGUAGE=javascript onclick="return eventend1_onclick()">
    <label title="Select this if the event has no end date." for="eventend1">Never</label></td>
              </tr>
              <tr>
                <td width="15%">&nbsp;</td>
                <td width="85%" colspan="2">
                <input <?php if($evrow["ese"]==1) {print "checked"; } ?> title="Select this if the event ends after so many occurances." type="radio" name="nef[eventend]" value="1" id="eventend2" LANGUAGE=javascript onclick="return eventend2_onclick()">
                <label title="Select this if the event ends after so many occurances." for="eventend2">End After</label>&nbsp;
                <input title="Enter the number of events to add." type="text" id="eventendafter" name="nef[eventendafter]" value="<?php if($evrow["ese"] == 1) {print $evrow["eseaoint"];} else {print "10";} ?>" size="5">&nbsp;occurances</td>
              </tr>
              <tr>
                <td width="15%">&nbsp;</td>
                <td width="15%">
                <input <?php if($evrow["ese"]==2) {print "checked"; } ?> title="Select this if the event ends after a certain date." type="radio" name="nef[eventend]" value="2" id="eventend3" LANGUAGE=javascript onclick="return eventend3_onclick()">
                <label title="Select this if the event ends after a certain date." for="eventend3">End on:
          </label>
                </td>
                <td width="70%" align="left">
                  <table border="0" cellspacing="0" cellpadding="0" width="60%">
                    <tr>
                      <td width="20%">
<div style="display:inline" title="Select the day after which the event ends" >
                      <b>Day</b>
</div>
                      </td>
                      <td width="20%">
<div style="display:inline" title="Select the month after which the event ends" >
                      <b>Month</b>
</div>
                      </td>
                      <td width="20%">
<div style="display:inline" title="Select the year after which the event ends" >
                      <b>Year</b>
</div>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%">
<div style="display:inline" title="Select the day after which the event ends" >
                      <select <?php if($evrow["ese"] != 2) {print "disabled";} ?> size="1" id="eventendday" style="WIDTH: 47px" name="nef[eventendday]" LANGUAGE=javascript onchange="return eventendday_onchange()">
<?php
    for($lc=1;$lc<=31;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["ese"] != 2) {
# changes for 1.1.10
#       if($evrow["startday"]==$lc) {
        if($fday==$lc) {
# changes for 1.1.10
                print "selected ";
            }
        } else {
            if($evrow["esed"]==$lc) {
                print "selected ";
            }
        }
        print "value = \"".$mlc."\" >".$mlc."</option>\n";
     }
    ?>
                      </select>
</div>
                      </td>
                      <td width="20%">
<div style="display:inline" title="Select the month after which the event ends" >
                      <select <?php if($evrow["ese"] != 2) {print "disabled";} ?> size="1" id="eventendmonth" style="WIDTH: 65px" name="nef[eventendmonth]" LANGUAGE=javascript onchange="return eventendmonth_onchange()">
    <?php
    for($lc=1;$lc<=12;$lc++) {
        if($lc < 10) {$mlc = "0".$lc;} else {$mlc=$lc;}
		print "        <option ";
        if($evrow["ese"] != 2) {
# changes for 1.1.10
#           if($evrow["startmonth"]==$lc) {
            if($fmonth==$lc) {
# changes for 1.1.10
                print "selected ";
            }
        } else {
            if($evrow["esem"]==$lc) {
                print "selected ";
            }
        }
        print "value = \"".$mlc."\" >".$monthtext[$lc]."</option>\n";
     }
    ?>
                      </select>
</div>
                      </td>
                      <td width="20%">
<div style="display:inline" title="Select the year after which the event ends" >
                      <select <?php if($evrow["ese"] != 2) {print "disabled";} ?> size="1" id="eventendyear" style="WIDTH: 70px" name="nef[eventendyear]" LANGUAGE=javascript onchange="return eventendyear_onchange()">
    <?php
# changes for 1.1.10
#    for($lc=($evrow["startyear"]-1);$lc<=($evrow["startyear"]+4);$lc++) {
        for($lc=($fyear-1);$lc<=($fyear+4);$lc++) {
# changes for 1.1.10
		print "        <option ";
        if($evrow["ese"] != 2) {
# changes for 1.1.10
#       if($evrow["startyear"]==$lc) {
        if($fyear==$lc) {
# changes for 1.1.10
                print "selected ";
            }
        } else {
            if($evrow["esey"]==$lc) {
                print "selected ";
            }
        }
        print "value = \"".$lc."\" >".$lc."</option>\n";
     }
    ?>
                      </select>
</div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
</div>
          </td>
        </tr>
<tr>
<td colspan="2">
<hr size="1">
</td>
</tr>
      </table>

</div>
<!-- end series event div -->

<?php

print "<div id=\"divextendedfields\" style=\"display: ".$efrqtextdiv."\">\n";

print "<!-- input required extended fields -->\n";

print "<table width=\"70%\"><tr>
<td nowrap width=\"33\" valign=\"top\" align=\"center\">
<h3>Extended&nbsp;Fields</h3></td>
<td width=\"33\" valign=\"top\" align=\"center\">";
if(($GLOBALS["allowaddextf"]==1) || ($cuser->gsv("isadmin")==1)) {
    print "<input id=\"addextfield\" type=\"button\" value=\"Add Field\" LANGUAGE=\"javascript\" onclick=\"return addextfield_onclick()\">";
} else {
    print "&nbsp;";
}
print "</td>
<td width=\"34\" valign=\"top\" align=\"center\">";
if(($GLOBALS["allowmakeextf"]==1) || ($cuser->gsv("isadmin")==1)) {
    print "<input type=\"button\" id=\"newextfield\" value=\"Create New Field\" LANGUAGE=\"javascript\" onclick=\"return newextfield_onclick()\">";
} else {
    print "&nbsp;";
}
print "</td></tr></table>\n";

print "<table id=\"extfldtab\"  width=\"50%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\"><tr>\n";
print "<th width=\"20%\" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>\n";
print "<th width=\"20%\">Field</th>\n";
print "<th width=\"60%\">Entry</th>\n";
print "</tr>\n\n\n";
$efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and ".$getextsql;

#print "<br>".$efsql."<br><br>";

$queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$numrows = @mysql_num_rows($queryexfd);
$extfldcnt = 0;
if($numrows < 1) {
    #print "<tr><td align=\"center\" colspan=\"3\">No extended fields defined</td></tr>";
} else {

    #$efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and required = 1 and ".$getextsql;

    $efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and ".$getextsql;

    #print "<br>".$efsql."<br><br>";

    $queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $numrows = @mysql_num_rows($queryexfd);
    $extfldcnt = 0;
    if($numrows > 0) {
        @mysql_free_result($queryexfd);
        $queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $optcount = 0;
        while($exfdrow = @mysql_fetch_array($queryexfd)) {
            $exfdrow = gmqfix($exfdrow,1);
            $optcount++;
            if($exfdrow["required"] != 1) {
                continue;
            }
            $extfldcnt++;
            print "<tr id=\"extfldrow-".$extfldcnt."\"><td id=\"extfldcella-".$extfldcnt."\" valign=\"top\" align=\"center\" width=\"20%\">Required</td>\n";
            print "<td id=\"extfldcellb-".$extfldcnt."\"valign=\"top\" align=\"center\" width=\"20%\">\n";
            print "<select style=\"width=170px\" name=\"extfld[".$extfldcnt."]\" id=\"extfld-".$extfldcnt."\">\n";
    #        print "<option value=\"".$exfdrow["efid"]."\">".$exfdrow["eftext"]."</option>\n";
            print "<option value=\"".$optcount."\">".$exfdrow["eftext"]."</option>\n";
            print "</select>\n";

            print "</td><td id=\"extfldcellc-".$extfldcnt."\" valign=\"top\" align=\"center\" width=\"60%\">\n";


            $getefxsql = "select * from ".$GLOBALS["tabpre"]."_extents where evid=".$evid." and efid=".$exfdrow["efid"];
            $efxquery = mysql_query($getefxsql) or die("Cannot query Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $numrows = @mysql_num_rows($efxquery);

            if($numrows > 0) {
                @mysql_free_result($efxquery);

                $efxquery = mysql_query($getefxsql) or die("Cannot query Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$getefxsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $efxrow = mysql_fetch_array($efxquery);
                $efxrow = gmqfix($efxrow,1);
                $fielddefval = $efxrow["exval"];
                $fielddefsel = $efxrow["efsid"];
                @mysql_free_result($efxquery);

            } else {
    #            die("Required Extent not found<br><br>SQL String: ".$getefxsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $fielddefval = "";
                $fielddefsel = "0";
            }
            @mysql_free_result($efxquery);

            if($exfdrow["format"] == "Textarea") {
                $fielddef = "<textarea style=\"width: 200px\" rows=\"6\" ";
            } else if($exfdrow["format"] == "Input") {
                $fielddef = "<input maxlength=\"".$exfdrow["maxlen"]."\" style=\"width: 200px\" size=\"30\" type=\"text\" ";
            } else if($exfdrow["format"] == "Select") {
                $fielddef = "<Select style=\"width: 200px\" ";
            } else {
                die("Invalid Extended Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }

            $fielddef .= "name=\"extfldval[".$extfldcnt."]\" id=\"extfldval-".$extfldcnt."\"";


            if($exfdrow["format"] == "Textarea") {

                $fielddef .= ">".$fielddefval."</textarea>\n";

            } else if($exfdrow["format"] == "Input") {

                $fielddef .= " value=\"".$fielddefval."\">\n";

            } else if($exfdrow["format"] == "Select") {

                $fielddef .= ">\n";

                $efselsql = "select * from ".$GLOBALS["tabpre"]."_ext_sel_def where efid=".$exfdrow["efid"];
                $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $numrows = @mysql_num_rows($queryexfseld);

                if($numrows < 1) {
                    die("Invalid Extended Select Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }
                @mysql_free_result($queryexfseld);
                $extselfldcnt = 0;
                $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                while($exfseldrow=mysql_fetch_array($queryexfseld)) {
                    $exfseldrow = gmqfix($exfseldrow,1);
                    $extselfldcnt++;
                    if($exfseldrow["efsid"]==$fielddefsel) {
                        $stdtxt = " selected ";
                    } else {
                        $stdtxt = "";
                    }
                    $fielddef .= "<option ".$stdtxt." value=\"".$exfseldrow["efsid"]."\">".$exfseldrow["efsval"]."</option>\n";
                }
                $fielddef .= "</select>\n";
                @mysql_free_result($queryexfseld);
            }
            print $fielddef;
            print "</td></tr>\n";
        }
    }
}

@mysql_free_result($queryexfd);
print "<!-- end input required extended fields -->\n";
$extreqfldcnt = $extfldcnt;
print "<!-- input filled extended fields -->\n";

$efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and required = 0 and ".$getextsql;


$queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$numrows = @mysql_num_rows($queryexfd);
if($numrows > 0) {
#print "<br>EXTFDEF: ".$efsql."<br>";
    @mysql_free_result($queryexfd);
    $queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($exfdrow = @mysql_fetch_array($queryexfd)) {
        $exfdrow = gmqfix($exfdrow,1);

        $chkextsql = "select * from ".$GLOBALS["tabpre"]."_extents where efid = ".$exfdrow["efid"]." and evid = ".$evid;
        $querychkext = mysql_query($chkextsql) or die("Cannot query Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$chkextsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $numrows = @mysql_num_rows($querychkext);


        if($numrows > 0) {
#print "<br>EXTENT: ".$chkextsql."<br>";
            @mysql_free_result($querychkext);
            $querychkext = mysql_query($chkextsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$chkextsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $chkextrow = mysql_fetch_array($querychkext);
            $chkextrow = gmqfix($chkextrow,1);
            @mysql_free_result($querychkext);

            $extfldcnt++;
            print "<tr id=\"extfldrow-".$extfldcnt."\"><td id=\"extfldcella-".$extfldcnt."\" valign=\"top\" align=\"center\" width=\"20%\">
            <INPUT type=\"button\" value=\"Remove\" id=\"remrow-".$extfldcnt."\"  LANGUAGE=javascript onclick=\"return remrow_onclick('extfldrow-".$extfldcnt."')\">\n
            </td>\n";
            print "<td id=\"extfldcellb-".$extfldcnt."\"valign=\"top\" align=\"center\" width=\"20%\">\n";
            print "<select language=\"javascript\" onchange=\"addextfldval('".$extfldcnt."|extfldcellc-".$extfldcnt."|extfld-".$extfldcnt."')\" style=\"width=170px\" name=\"extfld[".$extfldcnt."]\" id=\"extfld-".$extfldcnt."\">\n";
            print "<option value=\"0\">--</option>";

            $mefsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and ".$getextsql;

            $querymexfd = mysql_query($mefsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$mefsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $optcnt=0;
            while($mexfdrow = @mysql_fetch_array($querymexfd)) {
                $optcnt++;
                $mexfdrow = gmqfix($mexfdrow,1);
                if($mexfdrow["efid"]==$exfdrow["efid"]) {
                    $mseltxt = " selected ";
                } else {
                    $mseltxt = " ";
                }
    #            print "<option ".$mseltxt." value=\"".$mexfdrow["efid"]."\">".$mexfdrow["eftext"]."</option>\n";
                print "<option ".$mseltxt." value=\"".$optcnt."\">".$mexfdrow["eftext"]."</option>\n";
            }
            @mysql_free_result($querymexfd);
            print "</select>\n";

            print "</td><td nowrap id=\"extfldcellc-".$extfldcnt."\" valign=\"top\" align=\"center\" width=\"60%\">\n";

            if($exfdrow["format"] == "Textarea") {
                $fielddef = "<textarea style=\"width: 200px\" rows=\"6\" ";
            } else if($exfdrow["format"] == "Input") {
                $fielddef = "<input maxlength=\"".$exfdrow["maxlen"]."\" style=\"width: 200px\" size=\"30\" type=\"text\" ";
            } else if($exfdrow["format"] == "Select") {
                $fielddef = "<Select style=\"width: 200px\" ";
            } else {
                die("Invalid Extended Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
            print $fielddef."name=\"extfldval[".$extfldcnt."]\" id=\"extfldval-".$extfldcnt."\"";
            if($exfdrow["format"] == "Textarea") {
                print ">".$chkextrow["exval"]."</textarea>\n";
            } else if($exfdrow["format"] == "Input") {
                print " value=\"".$chkextrow["exval"]."\">\n";
            } else if($exfdrow["format"] == "Select") {
                print ">\n";
                $efselsql = "select * from ".$GLOBALS["tabpre"]."_ext_sel_def where efid=".$exfdrow["efid"];
                $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $numrows = @mysql_num_rows($queryexfseld);
                if($numrows < 1) {
                    print "</select><br><br>";
                    die("Invalid Extended Select Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }
                @mysql_free_result($queryexfseld);
                $extselfldcnt = 0;
                $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#print "<br>EXT SEL DEF: ".$efselsql."<br>";
#print "<br>EXTENT efsid: ".$chkextrow["efsid"]."<br>";
#print "<br>EXT SEL efsid: ".$exfseldrow["efsid"]."<br>";

                while($exfseldrow=mysql_fetch_array($queryexfseld)) {
                    $exfseldrow = gmqfix($exfseldrow,1);
                    $extselfldcnt++;
                    if($exfseldrow["efsid"]==$chkextrow["efsid"]) {
                        $stdtxt = " selected ";
                    } else {
                        $stdtxt = "";
                    }
                    print "<option ".$stdtxt." value=\"".$exfseldrow["efsid"]."\">".$exfseldrow["efsval"]."</option>\n";
                }
                print "</select>\n";
                @mysql_free_result($queryexfseld);
            }
            print "</td></tr>\n";
        }
    }
    @mysql_free_result($querychkext);
}
@mysql_free_result($queryexfd);
print "<!-- input end filled extended fields -->\n";

print "<!-- input standard extended fields -->\n";

$efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and standard = 1 and required = 0 and ".$getextsql;


$queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$numrows = @mysql_num_rows($queryexfd);
if($numrows > 0) {
    @mysql_free_result($queryexfd);
    $queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($exfdrow = @mysql_fetch_array($queryexfd)) {
        $exfdrow = gmqfix($exfdrow,1);

        $chkextsql = "select * from ".$GLOBALS["tabpre"]."_extents where efid = ".$exfdrow["efid"]." and evid = ".$evid;
        $querychkext = mysql_query($chkextsql) or die("Cannot query Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$chkextsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $numrows = @mysql_num_rows($querychkext);
        @mysql_free_result($querychkext);

        if($numrows == 0) {

            $extfldcnt++;
            print "<tr id=\"extfldrow-".$extfldcnt."\"><td id=\"extfldcella-".$extfldcnt."\" valign=\"top\" align=\"center\" width=\"20%\">
            <INPUT type=\"button\" value=\"Remove\" id=\"remrow-".$extfldcnt."\"  LANGUAGE=javascript onclick=\"return remrow_onclick('extfldrow-".$extfldcnt."')\">\n
            </td>\n";
            print "<td id=\"extfldcellb-".$extfldcnt."\"valign=\"top\" align=\"center\" width=\"20%\">\n";
            print "<select language=\"javascript\" onchange=\"addextfldval('".$extfldcnt."|extfldcellc-".$extfldcnt."|extfld-".$extfldcnt."')\" style=\"width=170px\" name=\"extfld[".$extfldcnt."]\" id=\"extfld-".$extfldcnt."\">\n";
            print "<option value=\"0\">--</option>";

            $mefsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and ".$getextsql;

            $querymexfd = mysql_query($mefsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$mefsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $optcnt=0;
            while($mexfdrow = @mysql_fetch_array($querymexfd)) {
                $optcnt++;
                $mexfdrow = gmqfix($mexfdrow,1);
                if($mexfdrow["efid"]==$exfdrow["efid"]) {
                    $mseltxt = " selected ";
                } else {
                    $mseltxt = " ";
                }
    #            print "<option ".$mseltxt." value=\"".$mexfdrow["efid"]."\">".$mexfdrow["eftext"]."</option>\n";
                print "<option ".$mseltxt." value=\"".$optcnt."\">".$mexfdrow["eftext"]."</option>\n";
            }
            @mysql_free_result($querymexfd);
            print "</select>\n";

            print "</td><td nowrap id=\"extfldcellc-".$extfldcnt."\" valign=\"top\" align=\"center\" width=\"60%\">\n";

            if($exfdrow["format"] == "Textarea") {
                $fielddef = "<textarea style=\"width: 200px\" rows=\"6\" ";
            } else if($exfdrow["format"] == "Input") {
                $fielddef = "<input maxlength=\"".$exfdrow["maxlen"]."\" style=\"width: 200px\" size=\"30\" type=\"text\" ";
            } else if($exfdrow["format"] == "Select") {
                $fielddef = "<Select style=\"width: 200px\" ";
            } else {
                die("Invalid Extended Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
            print $fielddef."name=\"extfldval[".$extfldcnt."]\" id=\"extfldval-".$extfldcnt."\"";
            if($exfdrow["format"] == "Textarea") {
                print "></textarea>\n";
            } else if($exfdrow["format"] == "Input") {
                print ">\n";
            } else if($exfdrow["format"] == "Select") {
                print ">\n";
                $efselsql = "select * from ".$GLOBALS["tabpre"]."_ext_sel_def where efid=".$exfdrow["efid"];
                $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $numrows = @mysql_num_rows($queryexfseld);
                if($numrows < 1) {
                    print "</select><br><br>";
                    die("Invalid Extended Select Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }
                @mysql_free_result($queryexfseld);
                $extselfldcnt = 0;
                $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                while($exfseldrow=mysql_fetch_array($queryexfseld)) {
                    $exfseldrow = gmqfix($exfseldrow,1);
                    $extselfldcnt++;
                    if($exfseldrow["standard"]==1) {
                        $stdtxt = " selected ";
                    } else {
                        $stdtxt = "";
                    }
                    print "<option ".$stdtxt." value=\"".$exfseldrow["efsid"]."\">".$exfseldrow["efsval"]."</option>\n";
                }
                print "</select>\n";
                @mysql_free_result($queryexfseld);
            }
            print "</td></tr>\n";
        }
    }
}
@mysql_free_result($queryexfd);

print "</table>\n";
if($extfldcnt==0 && $extreqfldcnt==0) {
    print "<div id=\"noextfldtxtdisp\"<br>No extended fields defined</div>";
}
print "<!-- end input standard extended fields -->\n";
print "<input type=\"hidden\" id=\"extfldcnt\" value=\"".$extfldcnt."\">\n";
print "<input type=\"hidden\" id=\"extreqfldcnt\" value=\"".$extreqfldcnt."\">\n";

?>

</div>
<!-- end extended fields div -->

    </td>
    <!--
    <td width="24%">&nbsp;</td>
    -->
  </tr>
<!--
  <tr>
    <td width="26%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
    <td width="24%">&nbsp;</td>
  </tr>
  <tr>
    <td width="26%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
    <td width="24%">&nbsp;</td>
  </tr>
-->
</table>

  <table border="0" width="60%">
  <tr>
    <td width="15%" align="middle">
    <INPUT type="button" value="Save" id="saveevent" name="saveevent" language="javascript" onclick="cevent_onsubmit()">
    </td>
    <td width="15%" align="middle">
    <INPUT type="button" value="Go to Calendar" id="doneevent" name="doneevent" LANGUAGE=javascript onclick="return doneevent_onclick()">
    </td>
    <td width="15%" align="middle">&nbsp;
    </td>
    <td width="15%" align="middle">&nbsp;
    </td>
  </tr>
</table>
<?php
#print "<input type=\"text\" id=\"tstfld\" value=\"\" size=\"25\">\n<br><br>";
#print "<INPUT type=\"button\" value=\"Test Value\" id=\"testbut1\" name=\"testbut1\" LANGUAGE=javascript onclick=\"return extfldcheck('testbut','tstfld','1')\">";
#print "<select id=\"testbut\" name=\"testbut\"><option value=\"1\">one</option></select>";
print "</form>\n";
print "<!-- pre defined extended fields -->\n";
print "<div style=\"display: none\">\n";
print "<table id=\"extflddeftab\" border=\"0\">";

$efsql = "select * from ".$GLOBALS["tabpre"]."_ext_def where eftype='Event' and ".$getextsql;

#print "<br>".$efsql."<br><br>";

$queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$numrows = @mysql_num_rows($queryexfd);
$extfldcnt = 0;
if($numrows < 1) {
    print "<tr><td><input type=\"hidden\" id=\"extflddefcnt\" value=\"0\"></td></tr>\n";
} else {
    @mysql_free_result($queryexfd);
    $queryexfd = mysql_query($efsql) or die("Cannot query Extended Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    while($exfdrow = @mysql_fetch_array($queryexfd)) {
        $exfdrow = gmqfix($exfdrow,1);
        $extfldcnt++;
#        print "<tr><td><input type=\"hidden\" id=\"extfld-def-".$extfldcnt." value=\"".$exfdrow["efid"]."|".$exfdrow["uid"]."|".$exfdrow["calid"]."|".$exfdrow["eftext"]."|".$exfdrow["format"]."|".$exfdrow["standard"]."|".$exfdrow["required"]."|".$exfdrow["validate"]."|".$exfdrow["checktype"]."|".$exfdrow["maxlen"]."\"></td></tr>\n";
        print "<tr><td><input type=\"hidden\" id=\"extdef-".$extfldcnt."\" value=\"extfld-def-".$exfdrow["efid"]."\"><input type=\"hidden\" id=\"extfld-def-".$exfdrow["efid"]."\" value=\"".$exfdrow["efid"]."|".$exfdrow["uid"]."|".$exfdrow["calid"]."|".$exfdrow["eftext"]."|".$exfdrow["format"]."|".$exfdrow["standard"]."|".$exfdrow["required"]."|".$exfdrow["validate"]."|".$exfdrow["checktype"]."|".$exfdrow["maxlen"]."\"></td></tr>\n";
        if($exfdrow["format"]=="Select") {
            $efselsql = "select * from ".$GLOBALS["tabpre"]."_ext_sel_def where efid=".$exfdrow["efid"];
            $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $numrows = @mysql_num_rows($queryexfseld);
            if($numrows < 1) {
                die("Invalid Extended Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
            @mysql_free_result($queryexfseld);
            $extselfldcnt = 0;
            $queryexfseld = mysql_query($efselsql) or die("Cannot query Extended Select Fields Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$efselsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            while($exfseldrow=mysql_fetch_array($queryexfseld)) {
                $exfseldrow = gmqfix($exfseldrow,1);
                $extselfldcnt++;
                print "<tr><td><input type=\"hidden\" id=\"extfld-sel-".$exfdrow["efid"]."-".$extselfldcnt."\" value=\"".$exfseldrow["efsid"]."|".$exfseldrow["efid"]."|".$exfseldrow["efsval"]."|".$exfseldrow["standard"]."\"></td></tr>\n";
            }
            print "<tr><td><input type=\"hidden\" id=\"extfld-sel-".$exfdrow["efid"]."-cnt\" value=\"".$extselfldcnt."\"></td></tr>\n";
            @mysql_free_result($queryexfseld);
        }
    }
    print "<tr><td><input type=\"hidden\" id=\"extflddefcnt\" value=\"".$extfldcnt."\"></td></tr>\n";

}
@mysql_free_result($queryexfd);

print "</table></div>\n<!-- end pre defined extended fields -->\n";

if($GLOBALS["remoffdemo"] == true) {
print "<h3>NOTE: Reminders will not be sent from this demo site.</h3>";
}
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
exit();
}
?>
