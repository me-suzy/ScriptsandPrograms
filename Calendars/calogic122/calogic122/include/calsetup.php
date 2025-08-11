<?php

/*
CaLogic
Copyright (c) Philip Boone.
philip@calogic.de
*/

function calsetup($firstsetup=0,$section="cg",$uobj) {

if($GLOBALS["usercustom"]!=1 && !$uobj->gsv("isadmin") && $firstsetup!=1) {return;}


    global $curcalcfg,$timear,$timeara,$lstyle;
    global $langcfg,$csectcnt;
    $rowcolor1="#DDDDDD";
    $rowcolor2="#CCCCCC";

    $disablebuts = 1;
    if($uobj->gsv("curcalowner") == 1) {
        $disablebuts = 0;
    }
    if($uobj->gsv("isadmin") == 1) {
        $disablebuts = 0;
    }
    if($GLOBALS["demomode"]==true && $uobj->gsv("uname")=="Guest") {
        $disablebuts = 0;
    }
    ?>

<?php
print $GLOBALS["htmldoctype"];
?>
    <html>
    <head>
<?php
    include($GLOBALS["CLPath"]."/include/style.php");
?>
    <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
    <!--
    var curfeld = "";
    var aclr = "";

<?php
if($uobj->gsv("isadmin")=="1" && $section=="cg") {
    if($GLOBALS["forcedefaultcal"]==0) {print "var fdefcal=0;";}else{print "var fdefcal=1;";} ?>
/*
        function mstdefcal_onclick() {
            if(document.setupform.mstdefcal.checked == true) {
                document.setupform.allocalselect.disabled = false;
                document.setupform.goallocalselect.disabled = false;
            } else {
                document.setupform.allocalselect.disabled = true;
                if(fdefcal==0) {
                    document.setupform.goallocalselect.disabled = true;
                } else {
                    document.setupform.goallocalselect.disabled = false;
                }
            }
        }

        function mdefcal_onclick() {

        }
*/
    <?php
}
    if($section=="cg") {
        ?>

	function setcbval(curocb) {

	    if(document.all.item(curocb).checked) {
		document.all.item(curocb).value = 1;
	    }else{
		document.all.item(curocb).value = 0;
	    }

	}

        function submit_onclick() {
            document.setupform.calname.value=trim(document.setupform.calname.value);
            document.setupform.caltitle.value=trim(document.setupform.caltitle.value);
            if(document.setupform.calname.value == "") {
                alert("<?php print $langcfg["alcn"]; ?>");
                document.setupform.calname.focus();
                return false;
            }
            if(document.setupform.caltitle.value == "") {
                alert("<?php print $langcfg["alct"]; ?>");
                document.setupform.caltitle.focus();
                return false;
            }

            if(document.setupform.dayendhour.value < document.setupform.daybeginhour.value) {
                alert("<?php print $langcfg["alts"]; ?>");
                document.setupform.daybeginhour.focus();
                return false;
            }

        }
        function timetype_onchange() {
            if(document.setupform.timetype.value==0) {
        <?php

            for($lc=0;$lc<=47;$lc++) {
        		print "        document.setupform.daybeginhour.item(".$lc.").innerHTML=\"".$timeara[$lc]."\";\n";
            }

            for($lc=0;$lc<=47;$lc++) {
        		print "        document.setupform.dayendhour.item(".$lc.").innerHTML=\"".$timeara[$lc]."\";\n";
            }
            ?>
        	} else {
        <?php
            for($lc=0;$lc<=47;$lc++) {
        		print "        document.setupform.daybeginhour.item(".$lc.").innerHTML=\"".substr($timear[$lc],0,2).":".substr($timear[$lc],2,2)."\";\n";
            }

            for($lc=0;$lc<=47;$lc++) {
        		print "        document.setupform.dayendhour.item(".$lc.").innerHTML=\"".substr($timear[$lc],0,2).":".substr($timear[$lc],2,2)."\";\n";
            }

            ?>
            }
        }
    <?php
    } else {
        print "function submit_onclick() {\n";
        print "}\n";
    }
    ?>
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

<?php
if($section=="cg") {
?>
    function calselect_onchange() {
        if(document.setupform.calselect.value == 0) {

            document.setupform.mstdcal.checked = false;
            document.setupform.mstdcal.disabled = true;
            document.setupform.gocalselect.disabled = true;
            document.setupform.prefgodc.disabled = true;

        } else {

            document.setupform.gocalselect.disabled = false;
	    document.setupform.prefgodc.disabled = false;

            if(document.setupform.calselect.value == document.setupform.xscalid.value) {
                document.setupform.mstdcal.checked = true;
                document.setupform.mstdcal.disabled = true;
            } else {
                document.setupform.mstdcal.checked = false;
                document.setupform.mstdcal.disabled = false;
            }

            if(document.setupform.calselect.value == '-1') {
                document.setupform.prefgodc.disabled = true;
            }
        }
<?php
if($uobj->gsv("isadmin")!="1" && $GLOBALS["demomode"] == true) {
?>
		document.setupform.mstdcal.checked = false;
		document.setupform.mstdcal.disabled = true;
		document.setupform.gocalselect.disabled = true;
		document.setupform.prefgodc.disabled = true;

<?php
}
?>

<?php
if($uobj->gsv("isadmin")=="1" && $section=="cg") {
?>
        if(document.setupform.calselect.value == document.setupform.curdefcal.value) {
            document.setupform.prefgodc.disabled = true;
        }
<?php
}
?>
    }
<?php
}
?>


    function mnc_onclick() {
        if(confirm("<?php print $langcfg["alncc"]; ?> "+document.setupform.calselect.item(document.setupform.calselect.selectedIndex).innerText + " ?")) {
            return true;
        } else {
            alert("<?php print $langcfg["funcan"]; ?>");
            return false;
        }
    }

    function mnoc_onclick() {
        if(confirm("<?php print $langcfg["alncc"]; ?> "+document.setupform.ocalselect.item(document.setupform.ocalselect.selectedIndex).innerText + " ?")) {
            return true;
        } else {
            alert("<?php print $langcfg["funcan"]; ?>");
            return false;
        }
    }


    function ddc_onclick() {
        if(confirm("<?php print $langcfg["aldel1"]; ?> "+document.setupform.calselect.item(document.setupform.calselect.selectedIndex).innerText + " <?php print $langcfg["calword"]; ?>?")) {
            if(confirm("<?php print $langcfg["aldel2"]; ?> "+document.setupform.calselect.item(document.setupform.calselect.selectedIndex).innerText + " <?php print $langcfg["aldel3"]; ?>")) {
                return true;
            } else {
                return false;
            }
        } else {
            alert("<?php print $langcfg["funcan"]; ?>");
            return false;
        }
    }

    function mnl_onclick() {

    }

    function ddl_onclick() {

    }

    function window_onload() {
<?php
if($section=="cg") {
?>
        calselect_onchange();
        timetype_onchange();
<?php
}
?>
    }

    function setcolor_ondblclick(cname) {
//    	alert(cname);
	if(curfeld != "") {
	    setupform.item(curfeld).value = cname;
            ikey = "ifld_" + curfeld.substring(4);
	    document.all(ikey).bgColor = cname;
	}
	curfeld = "";
    }

    function cfld_onfocus(cfield) {
        curfeld = cfield;
        nkey = "nfld_" + cfield.substring(4);
        aclr = document.all(nkey).bgColor;
        document.all(nkey).bgColor = "<?php print $curcalcfg["gcscocf_cssc"]; ?>";
    }

    function cfld_onfocusout(nfield) {
        document.all(nfield).bgColor = aclr;
    }

    function setupform_onreset() {
        for(i=0; i<document.all.length; i++) {
            xkey = document.all(i).id;
            tkey = xkey.substring(0,5);
            if(tkey == "ifld_") {
                zkey = "prev_" + xkey.substring(5);
                document.all(i).bgColor = setupform.item(zkey).value;
            }
        }
    }

    //-->
    </SCRIPT>


    <title><?php print $GLOBALS["sitetitle"]; ?> - <?php print $langcfg["calword"]; ?> <?php print $langcfg["prefl"]; ?></title>
    </head>

    <body <?php if($firstsetup==1) {print $GLOBALS["sysbodystyle"];} else {print $GLOBALS["calbodystyle"];} ?> LANGUAGE=javascript onload="return window_onload()">

<?php
#print "demo mode: ".$GLOBALS["demomode"]."<br>";
#print "disablebuts: ".$disablebuts."<br>";
?>
    <form method="<?php print $GLOBALS["postorget"]; ?>" name="setupform" id="setupform" action="<?php print $GLOBALS["idxfile"]; ?>" LANGUAGE=javascript onreset="return setupform_onreset()">
    <table border="1" width="100%">
      <tr>
        <td width="100%" colspan="7" align="center">
          <b><?php print $GLOBALS["sitetitle"]; ?> - <?php print $langcfg["calword"]; ?> <?php print $langcfg["prefl"]; ?> - <?php print $curcalcfg["calname"]; ?><br>
          <?php

          if($firstsetup==0) {
              print $langcfg["calownerword"];
              $sqlstr="select fname,lname,email from ".$GLOBALS["tabpre"]."_user_reg where uid=".$curcalcfg["userid"];
#              echo $sqlstr."<br>";
              $query = mysql_query($sqlstr) or die("Cannot query User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
              $row = mysql_fetch_array($query) or die("Cannot query User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
              $row = gmqfix($row,1);
              print ": <a href=\"mailto:".$row["email"]."\">".$row["fname"]." ".$row["lname"]."</a>";
          } else {
              print $langcfg["ffcaltxt"];
          }
          ?></b>
        </td>
      </tr>
      <tr>
        <td width="14%" align="center" <?php if($section=="cg") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["scgbut"]; ?>" name="prefgocg" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="gc") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["sgcbut"]; ?>" name="prefgogc" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="mc") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["smcbut"]; ?>" name="prefgomc" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="yv") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["syvbut"]; ?>" name="prefgoyv" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="mv") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["smvbut"]; ?>" name="prefgomv" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="wv") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["swvbut"]; ?>" name="prefgowv" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="dv") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["sdvbut"]; ?>" name="prefgodv" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
      </tr>

      <tr>
        <td width="14%" align="center" <?php if($section=="pu") {print "class=\"gccssc\"";} ?>><input type="submit" value="Menus" name="prefgopu" <?php if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" >&nbsp;</td>
        <td width="14%" align="center" >&nbsp;</td>
        <td width="14%" align="center" >&nbsp;</td>
        <td width="14%" align="center" >&nbsp;</td>
        <td width="14%" align="center" >&nbsp;</td>
        <td width="14%" align="center" >&nbsp;</td>
        <td width="14%" align="center" >&nbsp;</td>
      </tr>
      <tr>
<?php
/*
        <td width="14%" align="center" <?php #if($section=="gr") {print "class=\"gccssc\"";} ?>>&nbsp;<!--<input type="submit" value="<?php #print $langcfg["srvbut"]; ?>" name="gogroupprefs" <?php #if($firstsetup==1 || $disablebuts == 1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()">--></td>
        <td width="14%" align="center">&nbsp;</td>
        <td width="14%" align="center">&nbsp;</td>

*/
?>
<?php
/*
        <td width="14%" align="center" <?php if($section=="gu") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["ssvbut"]; ?>" name="gouserprefs" <?php if($firstsetup==1  || $disablebuts == 1) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
        <td width="14%" align="center" <?php if($section=="cc") {print "class=\"gccssc\"";} ?>><input type="submit" value="<?php print $langcfg["scabut"]; ?>" name="gocatprefs" <?php if($firstsetup==1 ) {print "disabled";} ?> LANGUAGE=javascript onclick="return submit_onclick()"></td>
*/
?>
<?php if($section=="cg") {
?>
        <td colspan="4" nowrap align="center" <?php if($section=="cs") {print "class=\"gccssc\"";} ?>>

        <?php if($uobj->gsv("isadmin")) {print "All Calendars: ";}else {print $langcfg["mycword"];} ?> <select size="1" <?php if($firstsetup==1 || ($GLOBALS["forcedefaultcal"]==1 && $GLOBALS["defaultcalid"] == $uobj->gsv("curcalid") && $uobj->gsv("isadmin") != 1)) {print "disabled";} ?> id="calselect" name="calselect" style="WIDTH: 120px" LANGUAGE=javascript onchange="return calselect_onchange()">
        <?php if($firstsetup <> 1) {
		if($uobj->gsv("isadmin")) {
		    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini order by calname";
		} else {
		    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$uobj->gsv("cuid")." or calid='0'  order by calname";
		}
                 $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                 while($row = mysql_fetch_array($query1)) {
                     $row = gmqfix($row,1);
                     print "<option ";
                     if($uobj->gsv("curcalid") == $row["calid"]) {
                         print " selected ";
                     }
                     print "value=\"".$row["calid"]."\">".($row["calname"])."</option>\n";
                 }
                mysql_free_result($query1);
             }
        ?>
    </select>&nbsp;<input type="submit" value="<?php print $langcfg["butgo"]; ?>" name="gocalselect" <?php if($firstsetup==1) {print "disabled";}elseif($uobj->gsv("curcalid") == $uobj->gsv("startcalid")) {print "disabled";} ?>>
    <INPUT id=mstdcal type=checkbox name=mstdcal <?php if($firstsetup==1) {print "disabled checked";}elseif($uobj->gsv("curcalid") == $uobj->gsv("startcalid")) {print "disabled checked";} ?>><LABEL for=mstdcal><?php print $langcfg["mkst"]; ?></LABEL>
    &nbsp;<input type="submit" value=" <?php print $langcfg["butnew"]; ?> " name="prefgonc" <?php if($firstsetup==1 || $uobj->gsv("publicviewon")==1) {print "disabled";} ?> LANGUAGE=javascript onclick="return mnc_onclick()">
    &nbsp;<input type="submit" value="<?php print $langcfg["butdel"]; ?>" name="prefgodc" <?php if($firstsetup==1 || $uobj->gsv("publicviewon")==1) {print "disabled";} ?> LANGUAGE=javascript onclick="return ddc_onclick()">
    <INPUT type=hidden id="xccalid" name=xccalid value="<?php print $uobj->gsv("curcalid"); ?>">
    <INPUT type=hidden id="xscalid" name=xscalid value="<?php print $uobj->gsv("startcalid"); ?>">


        </td>
        <td colspan="3" align="center" >
        <?php print $langcfg["opcalword"]; ?> <select size="1" <?php if($firstsetup==1) {print "disabled";} ?> id="ocalselect" name="ocalselect" style="WIDTH: 120px">
        <?php if($firstsetup <> 1) {
                 $haveothercals = 0;

                $extsql = "";
                if($uobj->gsv("isadmin")) {
                    $extsql = " or (userid <> ".$uobj->gsv("cuid")." and calid <> '0')";
                }

                 $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where (userid <> ".$uobj->gsv("cuid")." and caltype < 2 and calid <> '0') ".$extsql."  order by calname";
                 $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                 while($row = mysql_fetch_array($query1)) {
                     $row = gmqfix($row,1);
                     $haveothercals = 1;
                     print "<option ";
                     if($uobj->gsv("curcalid") == $row["calid"]) {
                         print " selected ";
                     }
                     print "value=\"".$row["calid"]."\">".($row["calname"])."</option>\n";
                 }

                mysql_free_result($query1);
             }
        ?>
    </select>&nbsp;<input type="submit" value="<?php print $langcfg["butgo"]; ?>" name="goocalselect" <?php if($firstsetup==1 || $haveothercals==0) {print "disabled";} ?>>
             &nbsp;<input type="submit" value="<?php print $langcfg["butnew"]; ?>" name="prefgoonc" <?php if($firstsetup==1 || $haveothercals==0 || $uobj->gsv("publicviewon")==1) {print "disabled";} ?> LANGUAGE=javascript onclick="return mnoc_onclick()">
        </td>
        </tr>
      <tr>
    <td colspan="3" nowrap align="center" <?php if($section=="ls") {print "class=\"gccssc\"";} ?>>&nbsp;

    <?php if($uobj->gsv("isadmin")=="1") {?>

    <?php print $langcfg["edlang"]; ?> <select size="1" <?php if($firstsetup==1) {print "disabled";} ?> name="seledlang" style="WIDTH: 120px">
        <?php if($firstsetup <> 1) {
                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_languages order by uid";
                $query1 = mysql_query($sqlstr) or die("Cannot query Global Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                while($row = mysql_fetch_array($query1)) {
                    $row = gmqfix($row,1);
                    print "<option ";
                    if($uobj->gsv("langsel") == $row["uid"]) {
                        print " selected ";
                    }
                    print "value=\"".$row["name"]."\">".$row["name"]."</option>\n";
                }
                mysql_free_result($query1);
             }
        ?>
        </select>&nbsp;<input type="submit" value="<?php print $langcfg["butgo"]; ?>" name="golangeditor" <?php if($firstsetup==1) {print "disabled";} ?>>
    &nbsp;<input disabled type="submit" value=" <?php print $langcfg["butnew"]; ?> " name="prefgonl" <?php if($firstsetup==1 || $uobj->gsv("publicviewon")==1) {print "disabled";} ?> LANGUAGE=javascript onclick="return mnl_onclick()">
    &nbsp;<input disabled type="submit" value="<?php print $langcfg["butdel"]; ?>" name="prefgodl" <?php if($firstsetup==1 || $uobj->gsv("publicviewon")==1) {print "disabled";} ?> LANGUAGE=javascript onclick="return ddl_onclick()">
<?php } ?>
        </td>
<td colspan="4" align="center" nowrap>&nbsp;
<?php
    if($GLOBALS["forcedefaultcal"]==0) {
        ?>
        <INPUT type="hidden" id=curdefcal name=curdefcal value="0">
        <?php
    } else {
        ?>
        <INPUT type="hidden" id=curdefcal name=curdefcal value="<?php print $GLOBALS["defaultcalid"]; ?>">
        <?php
    }
    ?>
</td>
<?php

#<td colspan="4" align="center" nowrap>&nbsp;</td>
/*
if($uobj->gsv("isadmin")=="1") {?>
        <tr><td colspan="7" align="center">
        <b>Standard Default Calendar Option&nbsp;<?php if($GLOBALS["forcedefaultcal"]==0) {print "*disabled*";}else{print "*enabled*";} ?> </b><br>
        When this option is enabled, new users will not be able to create a calendar. Instead, they will<br>
        be assigned the calendar that you select here.<br>
        To enable this option, set the checkbox, select a calendar to make the Standard Default, then click GO<br>
        <INPUT id=mstdefcal type=checkbox name=mstdefcal <?php if($firstsetup==1) {print "disabled";} if($GLOBALS["forcedefaultcal"]==1) {print " checked ";}?> LANGUAGE=javascript onclick="mstdefcal_onclick()"><LABEL for=mstdefcal>Check this to enable the standard default Calendar</LABEL>&nbsp;&nbsp;
        <select size="1" <?php if($firstsetup==1 || $GLOBALS["forcedefaultcal"]==0) {print "disabled";} ?> id="allocalselect" name="allocalselect" style="WIDTH: 120px">
        <?php if($firstsetup <> 1) {
                 $haveallothercals = 0;
#                 $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where caltype < 2 and calid <> '0'";
                 $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$uobj->gsv("cuid")."";
                 $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                 while($row = mysql_fetch_array($query1)) {
                     $row = gmqfix($row,1);
                     $haveallothercals = 1;
                     print "<option ";
                     if($GLOBALS["defaultcalid"] == $row["calid"]) {
                         print " selected ";
                     }
                     print "value=\"".$row["calid"]."\">".($row["calname"])."</option>\n";
                 }
                mysql_free_result($query1);
             }
        ?>
    </select>&nbsp;<input type="submit" value="<?php print $langcfg["butgo"]; ?>" name="goallocalselect" <?php if($firstsetup==1 || $haveallothercals==0 || $GLOBALS["forcedefaultcal"]==0) {print "disabled";} ?> LANGUAGE=javascript onclick="return mdefcal_onclick()">
    <br>
    <INPUT type="hidden" id=prevmstdefcal name=prevmstdefcal value="<?php if($GLOBALS["forcedefaultcal"]==1) {print "1";} else { print "0";} ?>">
    <?php
    if($GLOBALS["forcedefaultcal"]==0) {
        ?>
        <INPUT type="hidden" id=curdefcal name=curdefcal value="0">
        <?php
    } else {
        ?>
        <INPUT type="hidden" id=curdefcal name=curdefcal value="<?php print $GLOBALS["defaultcalid"]; ?>">
        <?php
    }
    ?>
    Enabling this option will also automatically turn off the "user can customize" option of CaLogic. <br>
    It will also set the default calendar of all current and future users to the calendar you select.<br>

</td>
<?php
}
*/
} // section endif
?>
</tr>
<?php
//    }
?>
    </table>

<?php
    if($section=="cg") {?>

<table border="1" width="100%">
  <tr>
    <th width="15%"><?php print $langcfg["urfh"]; ?></th>
    <th width="20%"><?php print $langcfg["entry"]; ?></th>
    <th width="65%">
      <p align="left"><?php print $langcfg["urrh"]; ?></p></th>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["calname"]; ?></td>
    <td width="20%" valign="top" align="center">
    <input id="calname" name="fields[calname]" size="30" <?php if($firstsetup==0) {print "value=\"".$curcalcfg["calname"]."\""; if($GLOBALS["demomode"] == true && $uobj->gsv("isadmin")!="1") {print " disabled ";}} ?>>
    <input type="hidden" id="pcalname" name="prev[calname]" value="<?php if($firstsetup==0) {print $curcalcfg["calname"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fcalname"]; ?><?php if($GLOBALS["demomode"] == true && $firstsetup==0 && $uobj->gsv("isadmin")!="1") {print " <br><b>Note: Calendar Name cannot be changed in demo mode</b> ";} ?></td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["caltitle"]; ?></td>
    <td width="20%" valign="top" align="center">
    <input id="caltitle" name="fields[caltitle]" size="30" <?php if($firstsetup==0) {print "value=\"".$curcalcfg["caltitle"]."\""; if($GLOBALS["demomode"] == true && $uobj->gsv("isadmin")!="1") {print " disabled ";}} ?>>
    <input type="hidden" id="pcaltitle" name="prev[caltitle]" value="<?php if($firstsetup==0) {print $curcalcfg["caltitle"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fcaltitle"]; ?><?php if($GLOBALS["demomode"] == true && $firstsetup==0 && $uobj->gsv("isadmin")!="1") {print " <br><b>Note: Calendar Title cannot be changed in demo mode</b> ";} ?></td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["caltype"]; ?></td>
    <td width="20%" valign="top" align="center">
    <select <?php  if($GLOBALS["demomode"] == true && $firstsetup==0 && $uobj->gsv("isadmin")!="1") {print " disabled ";} ?> size="1" id="caltype" name="fields[caltype]" style="WIDTH: 136px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["caltype"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["opcw"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["caltype"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["pucw"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["caltype"]=="2") {print "selected";} ?> value="2"><?php print $langcfg["prcw"]; ?></option>
    </select>
    <input type="hidden" id="pcaltype" name="prev[caltype]" value="<?php if($firstsetup==0) {print $curcalcfg["caltype"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fcaltype"]; ?><?php if($GLOBALS["demomode"] == true && $firstsetup==0 && $uobj->gsv("isadmin")!="1") {print " <br><b>Note: Calendar Type cannot be changed in demo mode</b> ";} ?></td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Display Calendar Title in View Header</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="dtih" name="fields[dtih]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["dtih"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["dtih"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
    </select>
    <input type="hidden" id="pdtih" name="prev[dtih]" value="<?php if($firstsetup==0) {print $curcalcfg["dtih"];} ?>">
    </td>
    <td width="65%">Set this to yes to have the calendar title display in the header next to the date. This is especially usefull, if you use a logo in the header.</td>
  </tr>


  <tr>
    <td width="15%" valign="top" align="right" nowrap>Enable Event Collision Check</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="collisioncheck" name="fields[collisioncheck]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["collisioncheck"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["collisioncheck"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
    </select>
    <input type="hidden" id="pcollisioncheck" name="prev[collisioncheck]" value="<?php if($firstsetup==0) {print $curcalcfg["collisioncheck"];} ?>">
    </td>
    <td width="65%">Select yes to enable event collision checking</td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Include "All Day Events" in Event Collision Check</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="allcollisioncheck" name="fields[allcollisioncheck]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["allcollisioncheck"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["allcollisioncheck"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
    </select>
    <input type="hidden" id="pallcollisioncheck" name="prev[allcollisioncheck]" value="<?php if($firstsetup==0) {print $curcalcfg["allcollisioncheck"];} ?>">
    </td>
    <td width="65%">Select yes to include all day events in event collision checking</td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Allow saving of colliding events</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="collisionsave" name="fields[collisionsave]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["collisionsave"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["collisionsave"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
    </select>
    <input type="hidden" id="collisionsave" name="prev[collisionsave]" value="<?php if($firstsetup==0) {print $curcalcfg["collisionsave"];} ?>">
    </td>
    <td width="65%">Select yes to allow users to save conflicting events</td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Limit Event Collision Checks <br> to events in the same categorie</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="catcollisioncheck" name="fields[catcollisioncheck]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["catcollisioncheck"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["catcollisioncheck"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
    </select>
    <input type="hidden" id="pcatcollisioncheck" name="prev[catcollisioncheck]" value="<?php if($firstsetup==0) {print $curcalcfg["catcollisioncheck"];} ?>">
    </td>
    <td width="65%">Select yes to have event collision checking done only on events that are in the same categorie.</td>
  </tr>


  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["showweek"]; ?></td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="showweek" name="fields[showweek]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["showweek"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["showweek"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
    </select>
    <input type="hidden" id="pshowweek" name="prev[showweek]" value="<?php if($firstsetup==0) {print $curcalcfg["showweek"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fshowweek"]; ?></td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Week Numbering Method</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="weektype" name="fields[weektype]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["weektype"]=="1") {print "selected";} ?> value="1">ISO 8601</option>
        <option <?php if($firstsetup==0 && $curcalcfg["weektype"]=="0") {print "selected";} ?> value="0">Alternate</option>
    </select>
    <input type="hidden" id="pweektype" name="prev[weektype]" value="<?php if($firstsetup==0) {print $curcalcfg["weektype"];} ?>">
    </td>
    <td width="65%">
Choose the week numering method. The ISO 8601 method states:
Weeks range from 01 to 53, where week 1 is the first week that has at
least 4 days in the current year, and with Monday as the first day of the week.<br>
The alternate method is: The first week in January with a Monday is week 1.<br>
Although the ISO method states, that you must also have your weeks starting
on Monday, CaLogic does not enforce this rule. Meaning you could set to use
the ISO method, and still have your weeks start with sunday. But then the
week numbers probably won't match any paper calendars you have.</td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["preferedview"]; ?></td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="preferedview" name="fields[preferedview]" style="WIDTH: 139px">
        <option <?php if($firstsetup==0 && $curcalcfg["preferedview"]=="Year") {print "selected";} ?> value="Year"><?php print $langcfg["ynl"]; ?></option>
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["preferedview"]=="Month") {print "selected";} ?>  value="Month"><?php print $langcfg["mnl"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["preferedview"]=="Week") {print "selected";} ?> value="Week"><?php print $langcfg["wnl"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["preferedview"]=="Day") {print "selected";} ?> value="Day"><?php print $langcfg["dnl"]; ?></option>
    </select>
    <input type="hidden" id="ppreferedview" name="prev[preferedview]" value="<?php if($firstsetup==0) {print $curcalcfg["preferedview"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fpreview"]; ?></td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["weekstartonmonday"]; ?></td>
    <td width="20%" valign="top" align="center">
    <input type="radio" id="weekstartonmonday1" name="fields[weekstartonmonday]" value="1" <?php if($firstsetup==1) {print "checked";}elseif($curcalcfg["weekstartonmonday"]=="1") {print "checked";} ?> ><label for="weekstartonmonday1"><?php print $langcfg["fmondays"]; ?></label>&nbsp;&nbsp;
    <input type="radio" id="weekstartonmonday0" name="fields[weekstartonmonday]" value="0" <?php if($firstsetup==0 && $curcalcfg["weekstartonmonday"]=="0") {print "checked";} ?> ><label for="weekstartonmonday0"><?php print $langcfg["fsundays"]; ?></label>
    <input type="hidden" id="pweekstartonmonday" name="prev[weekstartonmonday]" value="<?php if($firstsetup==0) {print $curcalcfg["weekstartonmonday"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fwson"]; ?></td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["weekselreact"]; ?></td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="weekselreact" name="fields[weekselreact]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["weekselreact"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wftype1"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["weekselreact"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wftype2"]; ?></option>
    </select>
    <input type="hidden" id="pweekselreact" name="prev[weekselreact]" value="<?php if($firstsetup==0) {print $curcalcfg["weekselreact"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["ftype"]; ?></td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["timetype"]; ?></td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="timetype" name="fields[timetype]" style="WIDTH: 139px" LANGUAGE=javascript onchange="timetype_onchange()">
        <option <?php if($firstsetup==0 && $curcalcfg["timetype"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wf12"]; ?></option>
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["timetype"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wf24"]; ?></option>
    </select>
    <input type="hidden" id="ptimetype" name="prev[timetype]" value="<?php if($firstsetup==0) {print $curcalcfg["timetype"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["ftimetype"]; ?></td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["daybeginhour"]; ?></td>
    <td width="20%" valign="top" align="center">

<?php

    if($firstsetup==1) {
        $sjtt = 0;
    } elseif($curcalcfg["timetype"] == 0) {
        $sjtt = 0;
    } else {
        $sjtt = 1;
    }

?>
    <select size="1" id="daybeginhour" name="fields[daybeginhour]" style="WIDTH: 139px">
<?php

    if($sjtt == 1) {

        for($lc=0;$lc<=47;$lc++) {
    		print "        <option ";
            if($firstsetup==1 && $timear[$lc]=="0730" ) {
                print "selected ";
            } elseif($curcalcfg["daybeginhour"]==$timear[$lc]) {
                print "selected ";
            }
            print "value = \"".$timear[$lc]."\">".substr($timear[$lc],0,2).":".substr($timear[$lc],2,2)."</option>\n";
         }

     } else {

        for($lc=0;$lc<=47;$lc++) {
    		print "        <option ";
            if($firstsetup==1 && $timear[$lc]=="0730" ) {
                print "selected ";
            } elseif($curcalcfg["daybeginhour"]==$timear[$lc]) {
                print "selected ";
            }
            print "value = \"".$timear[$lc]."\">".$timeara[$lc]."</option>\n";
         }
     }

    ?>
    </select>
    <input type="hidden" id="pdaybeginhour" name="prev[daybeginhour]" value="<?php if($firstsetup==0) {print $curcalcfg["daybeginhour"];} ?>">
    </td>
    <td width="65%"><?php print $langcfg["fdayst"]; ?></td>
  </tr>
  <tr>
    <td width="15%" valign="top" align="right" nowrap><?php print $langcfg["dayendhour"]; ?></td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="dayendhour" name="fields[dayendhour]" style="WIDTH: 139px">
<?php

    if($sjtt == 1) {

        for($lc=0;$lc<=47;$lc++) {
    		print "        <option ";
            if($firstsetup==1 && $timear[$lc]=="1730" ) {
                print "selected ";
            } elseif($curcalcfg["dayendhour"]==$timear[$lc]) {
                print "selected ";
            }
            print "value = \"".$timear[$lc]."\">".substr($timear[$lc],0,2).":".substr($timear[$lc],2,2)."</option>\n";
         }

     } else {

        for($lc=0;$lc<=47;$lc++) {
    		print "        <option ";
            if($firstsetup==1 && $timear[$lc]=="1730" ) {
                print "selected ";
            } elseif($curcalcfg["dayendhour"]==$timear[$lc]) {
                print "selected ";
            }
            print "value = \"".$timear[$lc]."\">".$timeara[$lc]."</option>\n";
         }

    }
    ?>
     </select>
    <input type="hidden" id="pdayendhour" name="prev[dayendhour]" value="<?php if($firstsetup==0) {print $curcalcfg["dayendhour"];} ?>">
     </td>
    <td width="65%"><?php print $langcfg["fdayen"]; ?></td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Show all time rows</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="showalltimes" name="fields[showalltimes]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["showalltimes"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["showalltimes"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
    </select>
    <input type="hidden" id="pshowalltimes" name="prev[showalltimes]" value="<?php if($firstsetup==0) {print $curcalcfg["showalltimes"];} ?>">
     </td>
    <td width="65%">Select Yes to have the week and day views show all time rows, even if there is no event scheduled.<br>
    Select No to have the week and day views only show time rows where an event is scheduled.</td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Display the event Status Column</td>
    <td width="20%" valign="top" align="center">
    <select size="1" id="showstatus" name="fields[showstatus]" style="WIDTH: 139px">
        <option <?php if($firstsetup==1) {print "selected";}elseif($curcalcfg["showstatus"]=="1") {print "selected";} ?> value="1"><?php print $langcfg["wfyes"]; ?></option>
        <option <?php if($firstsetup==0 && $curcalcfg["showstatus"]=="0") {print "selected";} ?> value="0"><?php print $langcfg["wfno"]; ?></option>
    </select>
    <input type="hidden" id="pshowstatus" name="prev[showstatus]" value="<?php if($firstsetup==0) {print $curcalcfg["showstatus"];} ?>">
     </td>
    <td width="65%">Select Yes to enable displaying of the Event Status Column. Select No to turn it off.<br>
    The Event Status Column can be seen to the left of each event. It can display various information about an event.<br>
    An "A" for an all day event, an "R" for and event that has reminders or allows for reminder subscriptions, an "S" for
    series events, and a "C" for event collisions.</td>
  </tr>

  <tr>
    <td width="15%" valign="top" align="right" nowrap>Event display options for "Guest" users</td>
    <td width="20%" valign="top" align="left">

    <?php
    $disablecb = " ";
    if($GLOBALS["demomode"] == true && $uobj->gsv("isadmin")!="1") {
        $disablecb = " disabled ";
    }

    $tccb = "deiuser";
    $tccbtext = "Event Creator";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>">
<br>

    <?php
    $tccb = "deidate";
    $tccbtext = "Event Date and Time";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deirep";
    $tccbtext = "Event Series Info";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deititle";
    $tccbtext = "Event Title";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deisub";
    $tccbtext = "Event Sub Title";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deicat";
    $tccbtext = "Event Categorie";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deidesc";
    $tccbtext = "Event Description";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deirem";
    $tccbtext = "Event Reminder Info";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deiext";
    $tccbtext = "Event Extended Fields";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">
<br>

    <?php
    $tccb = "deiexc";
    $tccbtext = "Event Exclusions";
    ?>
    <input <? print $disablecb; ?> language="javascript" onclick="setcbval('<?php print $tccb; ?>')" type="checkbox" id="<?php print $tccb; ?>" name="fields[<?php print $tccb; ?>]" value="<?php print $curcalcfg[$tccb]; ?>" <?php if($firstsetup==0 && $curcalcfg[$tccb]==1) {print " checked ";} if($firstsetup==1) {print " checked ";} ?>>
    <label for="<?php print $tccb; ?>"><?php print $tccbtext; ?></label>
    <input type="hidden" id="p<?php print $tccb; ?>" name="prev[<?php print $tccb; ?>]" value="<?php if($firstsetup==0) {print $curcalcfg[$tccb];} ?>">

    </td>
    <td width="65%" valign="top">
    Check each option that you want "Guest" users to be able to view. A Guest user is any user that is not the owner of the calendar.
    <?php if($GLOBALS["demomode"] == true && $uobj->gsv("isadmin")!="1") {print "<br><b>Note: These options can't be changed in demo mode.</b> ";} ?>
    </td>
  </tr>

</table>

    <?php if($firstsetup==1) { ?>
    <table border="1" width="100%">
      <tr>
        <td width="20%" align="center">
            <input type="submit" value="<?php print $langcfg["subut"]; ?>" name="submitsetup" LANGUAGE=javascript onclick="return submit_onclick()">
        </td>
        <td width="80%">&nbsp;
           <b><?php print $langcfg["ffcaltxt"]; ?></b>
        </td>
    <?php } else { ?>
    <table border="0" width="100%">
    <tr>
    <td width="100%" align="right">
    <table border="1" width="65%">
      <tr>
        <td width="21%" align="center">
            <input <?php if($disablebuts == 1 ) {print "disabled";} ?> type="submit" value="<?php print $langcfg["butsavech"]; ?>" name="submitgeneral" LANGUAGE=javascript onclick="return submit_onclick()">
        </td>
        <td width="21%" align="center">
            <INPUT type="reset" value="<?php print $langcfg["butpv"]; ?>" id=reset1 name=reset1>
        </td>
        <td width="21%" align="center">
            <INPUT type="submit" value="<?php print $langcfg["butgoc"]; ?>" id=canpref name="canpref">
        </td>
      </tr>
    </table>
    <?php } ?>
    </td></tr></table>

<?php

} else {
//    gensect($section,&$uobj)

print "<center><br>To use the color picker, click in the input field you wish to change, then double click on the color or color name you want.<br></center>\n";

    $rowcolor1="#DDDDDD";
    $rowcolor2="#CCCCCC";

    if($uobj->gsv("isadmin")) {
	print "<br>An \"*\" in front of a description means that a normal user will not see this field because an admin has marked it as \"not customizable\". (A normal user also cannot see this text)<br>";
    }
    print "<table border=\"1\" width=\"100%\">\n";
    print "<tr>\n";
    print "<th width=\"33%\" bgcolor=\"#D3DCE3\">".$langcfg["descword"]."</th>\n";
    print "<th width=\"34%\" bgcolor=\"#D3DCE3\">".$langcfg["entry"]."</th>\n";
    print "<th width=\"33%\" bgcolor=\"#D3DCE3\">Color Picker</th>\n";
    print "</tr>\n";

    $rcnt=1;
    $cscnt = $csectcnt[$section];
    $splh = $cscnt*30;

    foreach($curcalcfg as $ckey => $cval) {


	$fldnameprefix = "";
	$fieldallow = false;
	$tfldname = $ckey;

	#yvselmc_mcyv
	if(substr($ckey,0,5) == "gcsco") {
	    $tfldname = substr($ckey,8);
	}elseif(substr($ckey,2,6) == "selmc_") {
	    $tfldname = substr($ckey,8);
	} else {
	    $fieldallow = true;
	}

	$tfldvar = "allow_".$tfldname;

	if(isset($GLOBALS["$tfldvar"])) {
	    if($GLOBALS["$tfldvar"] == 1) {
		$fieldallow = true;
	    }else {
		$fieldallow = false;
	    }
	} else {
	    $fieldallow = true;
	}

	if($uobj->gsv("isadmin")) {
	    if($fieldallow == false) {
		$fldnameprefix = "*";
	    }
	    $fieldallow = true;
	}

	if($fieldallow == true) {
	    if(substr($ckey,0,2) == $section) {

		$bgcolor = ($rcnt % 2) ? $rowcolor1 : $rowcolor2;

		print "<tr>\n";

		print "<td id=\"nfld_".$ckey."\" width=\"33%\" align=\"left\" valign=\"top\" bgcolor=\"$bgcolor\">\n";
		print $fldnameprefix.$langcfg["$ckey"];
		print "</td>\n";


		if(stristr($ckey,"style") || substr($ckey,0,7) == "gcscosf") {

		    print "<td width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"$bgcolor\">\n";

		    print "<SELECT name=\"fields[".$ckey."]\" style=\"WIDTH: 139px\">\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="none") {print "selected ";}
		    print "value=\"none\">".$langcfg["fnword"]."</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="underline") {print "selected ";}
		    print "value=\"underline\">".$langcfg["funword"]."</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="overline") {print "selected ";}
		    print "value=\"overline\">".$langcfg["folword"]."</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="underline overline") {print "selected ";}
		    print "value=\"underline overline\">".$langcfg["funolword"]."</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="line-through") {print "selected ";}
		    print "value=\"line-through\">".$langcfg["fstword"]."</OPTION>\n";
		    print "</SELECT>\n";
		     print "<input type=\"hidden\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";

		}elseif($ckey == "pu_functionmenutype") {

		    print "<td width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"$bgcolor\">\n";

		    print "<SELECT name=\"fields[".$ckey."]\" style=\"WIDTH: 139px\">\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="0") {print "selected ";}
		    print "value=\"0\">Sliding</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="1") {print "selected ";}
		    print "value=\"1\">Menu bar</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="2") {print "selected ";}
		    print "value=\"2\">Both</OPTION>\n";
		    print "</SELECT>\n";
		    print "<input type=\"hidden\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";

		}elseif(stristr($ckey,"color") || substr($ckey,0,7) == "gcscocf") {

		    print "<td id=\"ifld_".$ckey."\" width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"".$curcalcfg["$ckey"]."\">\n";
		    print "<input id=\"chc_".$ckey."\" name=\"fields[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\"  LANGUAGE=javascript onfocus=\"return cfld_onfocus('chc_".$ckey."')\" onfocusout=\"return cfld_onfocusout('nfld_".$ckey."')\">\n";
		    print "<input type=\"hidden\" id=\"prev_".$ckey."\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";

		}elseif(substr($ckey,0,7) == "gcscoyn") {

		    print "<td width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"$bgcolor\">\n";

		    print "<SELECT name=\"fields[".$ckey."]\" style=\"WIDTH: 139px\">\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="0") {print "selected ";}
		    print "value=\"0\">".$langcfg["wfno"]."</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="1") {print "selected ";}
		    print "value=\"1\">".$langcfg["wfyes"]."</OPTION>\n";
		    print "</SELECT>\n";
		     print "<input type=\"hidden\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";

		}elseif(substr($ckey,2,6) == "selmc_") {

		    print "<td width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"$bgcolor\">\n";

		    print "<SELECT name=\"fields[".$ckey."]\" style=\"WIDTH: 139px\">\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="0") {print "selected ";}
		    print "value=\"0\">Left</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="1") {print "selected ";}
		    print "value=\"1\">Right</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="2") {print "selected ";}
		    print "value=\"2\">Both</OPTION>\n";
		    print "<OPTION ";
		    if($curcalcfg[$ckey]=="3") {print "selected ";}
		    print "value=\"3\">None</OPTION>\n";
		    print "</SELECT>\n";
		    print "<input type=\"hidden\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";

		}elseif(substr($ckey,0,7) == "gcscoif") {

		    print "<td id=\"ifld_".$ckey."\" width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"".$bgcolor."\">\n";

		    print "<input id=\"chc_".$ckey."\" name=\"fields[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";
		    print "<input type=\"hidden\" id=\"prev_".$ckey."\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";

		} else {

		    print "<td id=\"ifld_".$ckey."\" width=\"34%\" valign=\"top\" align=\"left\" bgcolor=\"".$bgcolor."\">\n";

		    print "<input id=\"chc_".$ckey."\" name=\"fields[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";
		    print "<input type=\"hidden\" id=\"prev_".$ckey."\" name=\"prev[".$ckey."]\" size=\"30\" value=\"".$curcalcfg["$ckey"]."\">\n";
		}

		print "</td>";

		if($rcnt == 1) {

		    print "<td width=\"33%\" rowspan=\"".$cscnt."\">";
		    print "\n<span id=\"esp\" style=\"width: 250; height: ".$splh."; overflow: auto\">\n";

		    print "<table border=\"1\" width=\"100%\">";
		    $csqlstr = "SELECT  * FROM ".$GLOBALS["tabpre"]."_color_table group by nicename,rgbplus order by cnum,rgbplus";
		    $cquery = mysql_query($csqlstr) or die("Cannot query color Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$csqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

		    while($crow=mysql_fetch_array($cquery)) {
			$crow = gmqfix($crow,1);
			print"<tr>\n";
			print"<td style=\"cursor: hand;\" width=\"10%\" LANGUAGE=javascript ondblclick=\"return setcolor_ondblclick('".$crow["cname"]."')\">".$crow["cname"]."</td>\n";
			print"<td style=\"cursor: hand;\" id=\"".$crow["id"]."\" bgcolor=\"".$crow["cname"]."\"  LANGUAGE=javascript ondblclick=\"return setcolor_ondblclick('".$crow["cname"]."')\">&nbsp;</td>\n";
			print"</tr>\n";
		    }
		    print "</table></span></td>";
		}

		print "</tr>\n";
		$rcnt++;


	    }
	}
    }
    print "</table>\n";
    print "<table border=\"0\" width=\"60%\">\n";
    print "<tr>\n";
    print "<td width=\"100%\" align=\"right\">\n";
    print "<table border=\"1\" width=\"65%\">\n";
    print "<tr>\n";
    print "<td width=\"21%\" align=\"center\">\n";
    print "<input type=\"submit\" value=\"".$langcfg["butsavech"]."\" name=\"submitprefs\" ";
    if($disablebuts == 1 ) {print "disabled";}
    print " LANGUAGE=javascript onclick=\"return submit_onclick()\">\n";
    print "</td>\n";
    print "<td width=\"21%\" align=\"center\">\n";
    print "<INPUT type=\"reset\" value=\"".$langcfg["butpv"]."\" id=reset1 name=reset1>   \n";
    print "</td>\n";
    print "<td width=\"21%\" align=\"center\">\n";
    print "<INPUT type=\"submit\" value=\"".$langcfg["butgoc"]."\" id=canpref name=\"canpref\"> \n";
    print "</td>\n";
    print "</tr>\n";
    print "</table>\n";
    print "</td></tr></table>\n";
}
?>
<input type="hidden" value="<?php print $section; ?>" name="csection">
</form>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
exit();
}?>
