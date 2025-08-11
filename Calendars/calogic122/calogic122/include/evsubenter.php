<?php
if (!isset($reguser)) {$reguser=0;}
?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<meta HTTP-EQUIV="Expires" CONTENT="0">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>Event Reminder Subscription</title>

<script id="clientEventHandlersJS" language="javascript">
<!--
function trim(strvalue) {
 startpos=0;

    var re = new RegExp("[\]\[\|\"\'\&\,]","ig");
    strvalue = strvalue.replace(re, "");

 while((strvalue.charAt(startpos)==" ")&&(startpos<strvalue.length)) {
   startpos++;
 }
 if(startpos==strvalue.length) {
   strvalue="";
 } else {
   strvalue=strvalue.substring(startpos,strvalue.length);
   endpos=(strvalue.length)-1;
   while(strvalue.charAt(endpos)==" ") {
     endpos--;
   }
   strvalue=strvalue.substring(0,endpos+1);
 }
 return(strvalue);
}

function emcheck(emstr) {

    var sFeatures="dialogHeight: 175px; dialogWidth: 275px;  help: 0; resizable: 1; status: 0;";

//    xurl = "./include/emcheck.php?calbodystyle=<?php print $bodyfont; ?>&bodycolor=<?php print $curcalcfg["gcscoif_btxtcolor"]; ?>&background=<?php print $curcalcfg["gcbgimg"]; ?>";
    xurl = './include/emcheck.php?sysbodystyle=<?php print $GLOBALS["sysbodystyle"]; ?>';
    xurl += "&email=" + emstr;

    //alert(xurl);
    emcrv = window.showModalDialog(xurl, "", sFeatures);
//    emcrv = window.open(xurl);

    if (emcrv==1){
        return true;
    } else {
        return false;
    }

}

function checkremset () {
    if(evsubform.srint.value == 1) {
        if(evsubform.srval.value < <?php print $GLOBALS["rminmin"]; ?> || evsubform.srval.value > <?php print $GLOBALS["rminmax"]; ?>) {
            alert("Invalid number of minutes for reminder!\nPlease enter a value from <?php print $GLOBALS["rminmin"]; ?> to <?php print $GLOBALS["rminmax"]; ?>");
            return false;
        }
    }
    if(evsubform.srint.value == 2) {
        if(evsubform.srval.value < <?php print $GLOBALS["rhourmin"]; ?> || evsubform.srval.value > <?php print $GLOBALS["rhourmax"]; ?>) {
            alert("Invalid number of hours for reminder!\nPlease enter a value from <?php print $GLOBALS["rhourmin"]; ?> to <?php print $GLOBALS["rhourmax"]; ?>");
            return false;
        }
    }
    if(evsubform.srint.value == 3) {
        if(evsubform.srval.value < <?php print $GLOBALS["rdaymin"]; ?> || evsubform.srval.value > <?php print $GLOBALS["rdaymax"]; ?>) {
            alert("Invalid number of days for reminder!\nPlease enter a value from <?php print $GLOBALS["rdaymin"]; ?> to <?php print $GLOBALS["rdaymax"]; ?>");
            return false;
        }
    }
    return true;
}


function cancelevsub_onclick() {
    window.returnValue = "0";
    window.close();
}

function window_onload() {

    window.returnValue = "0";

    tvar = window.dialogArguments;
    tvar = tvar.split("|");
    evsubform.currentuser.value = tvar[0];
    evsubform.currentcal.value = tvar[1];
    evsubform.remsublevel.value = tvar[2];

<?php
    if ($aiev!="1") {

    }
if ($reguser > 0) {
    #print "evsubform.isreguser.value = tvar[3];\n";
}
?>
    window.defaultStatus = "Event Reminder Subscribe.";

<?php
    if($remsublevel=="0") {
?>
        var d, tz, utz;
        d = new Date();
        tz = d.getTimezoneOffset();
        if (tz < 0)
            utz = "+" + Math.abs(tz) / 60;
        else if (tz == 0)
            uzz = "0";
        else
            utz = "-" + Math.abs(tz) / 60;

        evsubform.tzos.value = utz;
<?php
    }
?>
}

<?php
    if ($aiev=="1" || $remsublevel == 1) {
?>
    function reguser_onclick() {
        divanyone.style.display="none";
        divreguser.style.display="inline";
        evsubform.remsublevel.value = "1";

    }

    function anyone_onclick() {
        divreguser.style.display="none";
        divanyone.style.display="inline";
        evsubform.remsublevel.value = "0";
    }

        function allusers_ondblclick() {
            if(checkremset()) {
                var nrl;
                for (i=0; i<evsubform.allusers.options.length; i++) {
                    if(evsubform.allusers.options(i).selected) {
                        nrl = document.createElement("OPTION");
                        nrl.text=evsubform.allusers.options(i).text;
                        nrl.value=evsubform.allusers.options(i).value + "|" + evsubform.srval.value + "|" + evsubform.srint.value;
                        document.all.evsubform.reminderusers.add(nrl);
                        evsubform.allusers.options.remove(i);
                    }
                }
                evsubform.dipuname.value = "";
            }
        }

        function reminderusers_ondblclick() {
            var drl;
            for (i=0; i<evsubform.reminderusers.options.length; i++) {
                if(evsubform.reminderusers.options(i).selected) {
                    drl = document.createElement("OPTION");
                    drl.text=evsubform.reminderusers.options(i).text;
                    tstrcvg=evsubform.reminderusers.options(i).value;
                    tstrcvg = tstrcvg.split("|");

                    drl.value=tstrcvg[0] + "|" + tstrcvg[1];
                    document.all.evsubform.allusers.add(drl);
                    evsubform.reminderusers.options.remove(i);
                }
            }
            evsubform.dipuname.value = "";
        }

        function addalllist_onclick() {
            if(checkremset()) {
                var narl;
                for (i=0; i<evsubform.allusers.options.length; i++) {
                    narl = document.createElement("OPTION");
                    narl.text=evsubform.allusers.options(i).text;
                    narl.value=evsubform.allusers.options(i).value + "|" + evsubform.srval.value + "|" + evsubform.srint.value;
                    document.all.evsubform.reminderusers.add(narl);
                }
                do {
                    evsubform.allusers.options.remove(0);
                } while(evsubform.allusers.options.length > 0)
                evsubform.dipuname.value = "";
            }
        }

        function removealllist_onclick() {
            var rarl;
            for (i=0; i<evsubform.reminderusers.options.length; i++) {
                rarl = document.createElement("OPTION");
                rarl.text=evsubform.reminderusers.options(i).text;

                    tstrcvg=evsubform.reminderusers.options(i).value;
                    tstrcvg = tstrcvg.split("|");

                    rarl.value=tstrcvg[0] + "|" + tstrcvg[1];

                document.all.evsubform.allusers.add(rarl);
            }
            do
            {
                evsubform.reminderusers.options.remove(0);
            }
            while(evsubform.reminderusers.options.length > 0)
            evsubform.dipuname.value = "";
        }

        function reminderusers_onchange() {
            var tstrcvg;
            for (i=0; i<evsubform.reminderusers.options.length; i++) {
                if(evsubform.reminderusers.options(i).selected) {
                    tstrcvg=evsubform.reminderusers.options(i).value;
                    tstrcvg = tstrcvg.split("|");
                    evsubform.srval.value = tstrcvg[2];
                    evsubform.dipuname.value = tstrcvg[1];

                    for (x=0; x<evsubform.srint.options.length; x++) {
                        if(evsubform.srint.options(x).value == tstrcvg[3]) {
                            evsubform.srint.options(x).selected = true;
                        }
                    }
                }
            }
        }

        function allusers_onchange() {
            var tstrcvg;
            for (i=0; i<evsubform.allusers.options.length; i++) {
                if(evsubform.allusers.options(i).selected) {
                    tstrcvg=evsubform.allusers.options(i).value;
                    tstrcvg = tstrcvg.split("|");
                    evsubform.dipuname.value = tstrcvg[1];
                }
            }
        }
<?php
    }
?>

function saveevsub_onclick() {
    xnosave = false;
    //alert(evsubform.remsublevel.value);
    evsubform.saveevsub.disabled=true;
    if(evsubform.remsublevel.value == "0") {

        evsubform.fname.value=trim(evsubform.fname.value);
        evsubform.lname.value=trim(evsubform.lname.value);
        evsubform.email.value=trim(evsubform.email.value);
        evsubform.tzos.value=trim(evsubform.tzos.value);

        if(evsubform.tzos.value == "") {
            evsubform.tzos.value = "0";
        }
        if(evsubform.fname.value == "") {
            alert("You must enter a first name");
            xnosave = true;
        }
        if(evsubform.lname.value == "") {
            alert("You must enter a last name");
            xnosave = true;
        }
        if(evsubform.email.value == "") {
            alert("You must enter an email adress");
            xnosave = true;
        } else if(!emcheck(evsubform.email.value)) {
            alert("The email adress you entered is not valid.");
            xnosave = true;
        }

    } else {

        if(evsubform.reminderusers.options.length < 1) {
            alert("At least one user must be selected.");
            xnosave = true;
        }
    }

    if(xnosave == false) {
    //alert(evsubform.remsublevel.value);
        if(evsubform.remsublevel.value == "0") {
            xretval = "0|A0|" + evsubform.fname.value + "|" + evsubform.lname.value + "|" + evsubform.email.value + "|" + evsubform.srval.value + "|" + evsubform.srint.value + "|" + evsubform.tzos.value + "|" + evsubform.emailtype.value;
        } else {
            xretval = "1|" + evsubform.reminderusers.options.length;
            for (i=0; i<evsubform.reminderusers.options.length; i++) {
                xretval += "|" + evsubform.reminderusers.options(i).text + "|" + evsubform.reminderusers.options(i).value;
            }
        }
        //alert(xretval);
        window.returnValue = xretval;
        window.close();
    }
    evsubform.saveevsub.disabled=false;
}

//-->
</script>

</head>

<?php

print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
?>

<input type="hidden" id="optcount" value="0">
<center>
<h2>Event Reminder Subscription </h2>
<?php


if($remsublevel=="0") {
#    if ($reguser > 0 || $aiev=="1") {
    if ($aiev=="1") {
        print "<INPUT checked type=\"radio\" ID=\"anyone\" VALUE=\"0\" NAME=\"usertype\" language=\"javascript\" onclick=\"return anyone_onclick()\">\n";
        print "<label for=\"anyone\"><b>Individual</b></label>&nbsp;&nbsp;&nbsp;\n";
        print "<INPUT type=\"radio\" ID=\"reguser\" VALUE=\"1\" NAME=\"usertype\" language=\"javascript\" onclick=\"return reguser_onclick()\">\n";
        print "<label for=\"reguser\"><b>Registered Users</b></label>&nbsp;\n";

    }
}


?>
<form target = "_self" align="center" method="<?php print $GLOBALS["postorget"]; ?>" name="evsubform" id="evsubform" action="<?php print $GLOBALS["idxfile"]; ?>">
<input type="hidden" id="currentuser" name="currentuser" value="<?php print $currentuser; ?>">
<input type="hidden" id="currentcal" name="currentcal" value="<?php print $currentcal; ?>">
<input type="hidden" id="remsublevel" name="remsublevel" value="<?php print $remsublevel; ?>">
<?php
#if ($reguser > 0) {
#    print "<input type=\"hidden\" id=\"isreguser\" name=\"isreguser\" value=\"1\">";
#} else {
#    print "<input type=\"hidden\" id=\"isreguser\" name=\"isreguser\" value=\"0\">";
#}
if ($aiev=="1") {
    print "<input type=\"hidden\" id=\"isreguser\" name=\"isreguser\" value=\"1\">";
} else {
    print "<input type=\"hidden\" id=\"isreguser\" name=\"isreguser\" value=\"0\">";
}

?>
<input type="hidden" name="gosaveevsub" value="1">
<table border="1" cellpadding="3" cellspacing="0" width="100%" ID="Table1">
  <tr>
    <th align="left" nowrap>Person Information</th>
  </tr>
<tr>
<td>
<?php
$drudip = "inline";
if($remsublevel=="0") {
    $drudip = "none";
?>
<div id="divanyone" style="display: inline">
<table  border="1" cellspacing="1" cellpadding="0" width="100%"><tr>
    <th width="20%" nowrap align="left" valign="top">First Name</th>
    <td width="80%" align="left" valign="top">
    <input style="width: 190px" type="text" name="evsub[fname]" size="23" id="fname"></td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Last Name</th>
    <td width="80%" align="left" valign="top">
    <input style="width: 190px" type="text" name="evsub[lname]" size="23" id="lname"></td>
    </td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">E-Mail</th>
    <td width="80%" align="left" valign="top">
    <input style="width: 190px" type="text" name="evsub[email]" size="23" id="email"></td>
  </tr>

  <tr>
    <th width="20%" nowrap align="left" valign="top">E-Mail Type</th>
    <td width="80%" align="left" valign="top">
    <select size="1" name="evsub[emailtype]" id="emailtype" style="WIDTH: 130px">
    <option value="HTML">HTML</option>
    <option value="TEXT">Text</option>

<?php
if($GLOBALS["anonsmsallow"] == 1) {
    print "<option value=\"SMS\">SMS</option>\n";
}
?>
    </select>
  </tr>

  <tr>
    <th width="20%" nowrap align="left" valign="top">Time Zone<br>offset from GMT</th>
    <td width="80%" align="left" valign="top">
    <input style="width: 190px" type="text" name="evsub[tzos]" size="23" id="tzos" value="0"></td>
  </tr>
</table>
<b>
The Timezone Offset is based on your Computers time and country settings.
</b>
</div>
<?php
} else {
?>
<div id="divanyone" style="display: none">
</div>
<?php
}
?>
<div id="divreguser" style="display: <?php print $drudip; ?>">
      <table border="1" cellspacing="1" cellpadding="0" width="100%">
        <tr>
          <td width="50%" valign="top" align="center">
            <b>Registered Users</b><br>
            <SELECT style="WIDTH: 130px" id="allusers" size="5" name="evsub[allusers]" LANGUAGE=javascript ondblclick="return allusers_ondblclick()" onchange="return allusers_onchange()">
<?php
    $sqlstr = "select uid,fname,lname,email,uname from ".$GLOBALS["tabpre"]."_user_reg where emok = 1 and uname <> 'Guest' and uid <> ".$currentuser;
    $query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
	print "        <option ";
        print "value = \"U".$row["uid"]."|".$row["uname"]."\" text=\"[U] ".$row["fname"]." ".$row["lname"]."\">[U] ".$row["fname"]." ".$row["lname"]."</option>\n";
     }
     mysql_free_result($query1);
?>
            </SELECT><br>
            <button title="Click this button to add all users to the reminder list." style="WIDTH: 130px;" LANGUAGE=javascript onclick="return addalllist_onclick()">->&nbsp;Add All&nbsp;-></button>
          </td>
          <td width="50%" valign="top" align="center">
            <b>To List</b><br>
            <SELECT style="WIDTH: 130px" id="reminderusers" size="5" name="evsub[reminderusers]" LANGUAGE=javascript ondblclick="return reminderusers_ondblclick()" onchange="return reminderusers_onchange()">
            </SELECT><br>
            <button title="Click this button to remove all users from the reminder list." style="WIDTH: 130px;" LANGUAGE=javascript onclick="return removealllist_onclick()"><-&nbsp;Remove All&nbsp;<-</button>
          </td>
        </tr>
        <tr>
        <td colspan="2" align="left" valign="top">
        Double click list entry to add or remove. <br>
        You can set a different reminder interval for each user added. <br>
        Set the interval before adding to list.
        </td>
        </tr>
        <tr><td colspan="2" align="center">
        Selected users user name: <input readonly type="text" id="dipuname" name="dipuname" value="" size="23">
        </td></tr>
        </table>
</div>
</td>
</tr>
<tr>
<td>
  <table  border="1" cellspacing="1" cellpadding="0" width="100%">
    <th width="20%" nowrap align="left" valign="top">Interval</th>
    <td width="30%" align="left" valign="top">

        <input id="srval" name="evsub[srval]" type="text" style="WIDTH: 30px" value="3">&nbsp;
        <SELECT style="WIDTH: 100px" id="srint" size="1" name="evsub[srint]">
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
    <td width="50%">Before event takes place</td>
  </tr>
</table>
</td></tr></table>
<br>
<input language="javascript" onclick="saveevsub_onclick()" type="button" value = "Save" id="saveevsub" name="saveevsub">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input language="javascript" onclick="cancelevsub_onclick()" type="button" value = "Cancel" id="cancelevsub" name="cancelevsub">
</form>
</center>

<?php
    if ($aiev!="1") {
        print "<form method=\"".$GLOBALS["postorget"]."\" name=\"subforevent\" id=\"subforevent\" action=\"".$GLOBALS["idxfile"]."?gosfuncs=1&qjump=newsubscriber\">\n";
        print "<input type=\"hidden\" name=\"newsubvalue\" id=\"newsubvalue\" value=\"\">\n";
        print "<input type=\"hidden\" name=\"nsevid\" id=\"nsevid\" value=\"".$evid."\">\n";
        print "<input type=\"hidden\" name=\"nsevdate\" id=\"nsevdate\" value=\"".$evdate."\">\n";
        print "</form>\n";
    }

?>
</body>
</html>
<?php
exit();
?>
