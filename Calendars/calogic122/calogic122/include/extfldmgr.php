<?php
if(($GLOBALS["allowmakeextf"]==1) || ($user->gsv("isadmin")==1) || $GLOBALS["demomode"]==true) {
?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<meta HTTP-EQUIV="Expires" CONTENT="0">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>Extended Fields</title>

<script id="clientEventHandlersJS" language="javascript">
<!--
fldvals = "";
function trim(strvalue) {
 startpos=0;

    var re = new RegExp("[\]\[\|\"\'\&]","ig");
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

function newextfield_onclick() {

//    for(x=2;x < optTable.rows.length;x++) {
//        retval = optTable.deleteRow(x);
//    }

    zx = optTable.rows.length-2;
    if(zx > 0) {
        for(x=0;x < zx;x++) {
            retval = optTable.deleteRow(2);
        }
    }

    format.selectedIndex = 0;
    eftext.value = "";
    useage.selectedIndex = 0;
    eftype.selectedIndex = 0;
    standard.selectedIndex = 0;
    required.selectedIndex = 0;
    maxlen.value = "50";
    validate.selectedIndex = 0;
    checktype.selectedIndex = 0;
    curextfieldid.value = "";
    format_onchange();

}

function format_onchange() {
    if(format.value != "Input") {
        maxlen.disabled = true;
        validate.disabled = true;
        checktype.disabled = true;
    } else {
        maxlen.disabled = false;
        validate.disabled = false;
        checktype.disabled = false;
    }
    if(format.value == "Select") {
        optdiv.style.display="inline";
    } else {
        optdiv.style.display="none";
    }
}

function cancelextfield_onclick() {
    document.location.href="<?php print $GLOBALS["idxfile"]; ?>";
}

function window_onload() {

    currentuser.value = "<?php print $user->gsv("cuid"); ?>";
    currentcal.value = "<?php print $user->gsv("curcalid"); ?>";
//    window.defaultStatus = "Extended Event Field. Please fill out the form, then click save.";

}

function remrow_onclick(xoptrow) {
    for(x=2;x < optTable.rows.length;x++) {
        if(optTable.rows.item(x).id == xoptrow) {
            retval = optTable.deleteRow(x);
            return;
        }
    }
}

function efseldefdef_onclick(negval) {
//    alert(negval);
    if(document.all.item(negval).checked==true) {
//        alert("checked");
        seldefs = document.all.item("efseldefdef");
        for(x=0;x < seldefs.length;x++) {
            valdef = seldefs.item(x).id;
            if(valdef != negval ) {
                seldefs.item(x).checked = false;
            }
        }
    }
}

function addopt_onclick() {

	currowlen = optTable.rows.length;
	toptcount = optcount.value;
	toptcount++;
	optcount.value = toptcount;

	newrow = optTable.insertRow();
        newrow.id="optrow-" + (toptcount);
        newrow.align="center";
        newrow.vAlign="top";

        newcel = newrow.insertCell();
        newcel.id="optcella-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newcel.innerHTML = "<INPUT type=\"button\" value=\"Remove\" id=\"remrow-" + toptcount + "\"  LANGUAGE=javascript onclick=\"return remrow_onclick('optrow-" + toptcount + "')\">";

        newcel = newrow.insertCell();
        newcel.id="optcellb-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newhtml = "<input size=\"23\" oldid=\"\" style=\"width=120px\" name=\"efseldef\" id=\"efseldef-" + (toptcount) + "\" value=\"Enter option text\">";
        newcel.innerHTML = newhtml;

        newcel = newrow.insertCell();
        newcel.id="optcellc-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newhtml = "<input language=\"javascript\" onclick=\"return efseldefdef_onclick('efseldefdef-" + (toptcount) + "')\" type=\"checkbox\" name=\"efseldefdef\" id=\"efseldefdef-" + (toptcount) + "\" value=\"1\">";
        newcel.innerHTML = newhtml;

}

function autoaddopt(textval,checkedval,oldid) {

	currowlen = optTable.rows.length;
	toptcount = optcount.value;
	toptcount++;
	optcount.value = toptcount;

	newrow = optTable.insertRow();
        newrow.id="optrow-" + (toptcount);
        newrow.align="center";
        newrow.vAlign="top";

        newcel = newrow.insertCell();
        newcel.id="optcella-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newcel.innerHTML = "<INPUT type=\"button\" value=\"Remove\" id=\"remrow-" + toptcount + "\"  LANGUAGE=javascript onclick=\"return remrow_onclick('optrow-" + toptcount + "')\">";

        newcel = newrow.insertCell();
        newcel.id="optcellb-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newhtml = "<input size=\"23\" oldid=\"" + oldid + "\" style=\"width=120px\" name=\"efseldef\" id=\"efseldef-" + (toptcount) + "\" value=\"" + textval + "\">";
        newcel.innerHTML = newhtml;

        newcel = newrow.insertCell();
        newcel.id="optcellc-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newhtml = "<input " + checkedval + " language=\"javascript\" onclick=\"return efseldefdef_onclick('efseldefdef-" + (toptcount) + "')\" type=\"checkbox\" name=\"efseldefdef\" id=\"efseldefdef-" + (toptcount) + "\" value=\"1\">";
        newcel.innerHTML = newhtml;

}

function deleteextfield_onclick() {

    if(trim(curextfieldid.value) == "") {
        alert("First select the field you want to delete.");
        return false;
    }

    disablebuts();

    xurl = "<?php print $GLOBALS["idxfile"]; ?>?godeleteextfield=1&efid2del=" + curextfieldid.value;
    var sFeatures="dialogHeight: 250px; dialogWidth: 350px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl , "", sFeatures);

    document.location.reload();

    enablebuts();
}

function saveextfield_onclick() {

    disablebuts();

    tval = trim(eftext.value);
    eftext.value = tval;
    if(tval == "" ) {
        alert("The Field Name cannot be blank.\nSome special characters are not allowed.");
        enablebuts();
        return false;
    }
    if(format.value != "Select") {
        for(x=2;x < optTable.rows.length;x++) {
            retval = optTable.deleteRow(x);
        }
    } else {
        if(optTable.rows.length == 1) {
            alert("A Select Field must have at least one Option.");
            enablebuts();
            return false;
        }
        seldefs = document.all.item("efseldef");
        for(x=0;x < seldefs.length;x++) {
            valdef = seldefs.item(x).value;
            valdef = trim(valdef);
            seldefs.item(x).value = valdef;
            if(valdef == "" ) {
                alert("Option Fields cannot be blank.\nSome special characters are not allowed.");
                enablebuts();
                return false;
            }
        }
    }

    if(format.value == "Input") {
        maxlen.value = trim(maxlen.value);
        if(maxlen.value == "" || maxlen.value < "1" ) {
            alert("Input Fields must have a Maximum Length set.");
            enablebuts();
            return false;
        }
        if(validate.value == 1 && checktype.value == "Date" && maxlen.value < 10) {
            alert("Date Validation must have a minium length of 10.");
            enablebuts();
            return false;
        }
    }

    xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosaveextfield=1";

    xref =  "&currentuser=" + currentuser.value;
    xref += "&currentcal=" + currentcal.value;
    xref += "&efdef[eftext]=" + eftext.value;
    xref += "&efdef[format]=" + format.value;
    xref += "&efdef[useage]=" + useage.value;
    xref += "&efdef[eftype]=" + eftype.value;
    xref += "&efdef[standard]=" + standard.value;
    xref += "&efdef[required]=" + required.value;
    xref += "&efdef[maxlen]=" + maxlen.value;
    xref += "&efdef[validate]=" + validate.value;
    xref += "&efdef[checktype]=" + checktype.value;

    if(format.value == "Select") {
        seldefs = document.all.item("efseldef");
        for(x=0;x < seldefs.length;x++) {
            xref += "&efseldef[" + x + "]=" + seldefs.item(x).value;
            xref += "&efseldefoldid[" + x + "]=" + seldefs.item(x).oldid;
        }

        xref += "&efseldefcount=" + seldefs.length;

        var defaultsel = "-1";
        seldefs = document.all.item("efseldefdef");
        //alert(seldefs.length);
        for(x=0;x < seldefs.length;x++) {
            if(seldefs.item(x).checked==true ) {
                defaultsel = x;
                break;
            }
        }
        xref += "&defaultsel=" + defaultsel;
    } else {
        xref += "&efseldefcount=0";
    }
    xref += "&curextfieldid=" + curextfieldid.value;

    xurl += xref;
    //alert(xurl);

    var sFeatures="dialogHeight: 250px; dialogWidth: 350px;  help: 0; resizable: 1; status: 0;";

    extretval = window.showModalDialog(xurl , "", sFeatures);

    document.location.reload();

    enablebuts();
}

function fieldlist_onchange() {

    newextfield_onclick();

//alert(extfldlist.value);
    fldval = extfldlist.value;
    fldvals = fldval.split("|");

    if(fldvals[7]=="Input") {
        format.selectedIndex = 0;
    } else if(fldvals[7]=="Textarea") {
        format.selectedIndex = 1;
    } else {

        format.selectedIndex = 2;

        yy = 15;

        for(zz=0;zz<fldvals[0];zz++) {
            if(fldvals[yy+2] == 1) {
                tchkval = "checked";
            } else {
                tchkval = "";
            }
            autoaddopt(fldvals[yy+1],tchkval,fldvals[yy]);
            yy += 3;
        }
    }

    if(fldvals[5]=="Event") {
        eftype.selectedIndex = 0;
    } else {
        eftype.selectedIndex = 1;
    }

    standard.selectedIndex = fldvals[8];
    required.selectedIndex = fldvals[9];
    maxlen.value = fldvals[12];
    validate.selectedIndex = fldvals[10];
    if(fldvals[10] == 1) {
        if(fldvals[11]=="Text") {
            checktype.selectedIndex = 0;
        } else if(fldvals[11]=="Number") {
            checktype.selectedIndex = 1;
        } else {
            checktype.selectedIndex = 2;
        }
    }
    useage.selectedIndex = fldvals[4];
    eftext.value = fldvals[6];
    flduser.value = "";
    fldcalendar.value = "";
    if(fldvals[4]==0) {
        flduser.value = fldvals[13];
        fldcalendar.value = fldvals[14];
    } else if(fldvals[4]==1) {
        flduser.value = fldvals[13];
        fldcalendar.value = "Any of mine";
    } else if(fldvals[4]==2) {
        flduser.value = fldvals[13];
        fldcalendar.value = "Any";
    } else if(fldvals[4]==3) {
        flduser.value = "Any";
        fldcalendar.value = fldvals[14];
    } else if(fldvals[4]==4) {
        flduser.value = "Any";
        fldcalendar.value = "Any of mine";
    } else if(fldvals[4]==5) {
        flduser.value = "Any"
        fldcalendar.value = "Any";
    }
    curextfieldid.value = fldvals[1];

    format_onchange();


}

function disablebuts() {
    newextfield.disabled = true;
    saveextfield.disabled = true;
    deleteextfield.disabled = true;
    cancelextfield.disabled = true;
}

function enablebuts() {
    newextfield.disabled = false;
    saveextfield.disabled = false;
    deleteextfield.disabled = false;
    cancelextfield.disabled = false;

}
//-->
</script>

</head>

<?php
print "<body LANGUAGE=\"javascript\" onload=\"return window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
?>
<input type="hidden" id="optcount" value="0">
<h2>Extended Fields</h2>
<center>
<!--
<form target = "_self" align="center" method="<?php print $GLOBALS["postorget"]; ?>" name="extfieldform" id="extfieldform" action="<?php print $GLOBALS["idxfile"]; ?>">
-->
<input type="hidden" id="currentuser" name="currentuser" value="<?php print $currentuser; ?>">
<input type="hidden" id="currentcal" name="currentcal" value="<?php print $currentcal; ?>">
<input type="hidden" name="gosaveextfield" value="1">
<input type="hidden" name="curextfieldid" value="">
<center>
<table border="0" cellpadding="3" cellspacing="0" width="98%" ID="Table2">
<tr>
<td valign="top">
      <b>Extended Field List</b><br>
      <select language="javascript" onchange="return fieldlist_onchange()" size="18" id="extfldlist" name="extfldlist" style="WIDTH: 170px">
<?php

$sqlstr = "SELECT
".$GLOBALS["tabpre"]."_ext_def.efid,
".$GLOBALS["tabpre"]."_ext_def.uid,
".$GLOBALS["tabpre"]."_ext_def.calid,
efuseage,
eftype,
eftext,
format,
".$GLOBALS["tabpre"]."_ext_def.standard,
required,
validate,
checktype,
maxlen,
".$GLOBALS["tabpre"]."_user_reg.uname,
".$GLOBALS["tabpre"]."_cal_ini.calname
FROM ".$GLOBALS["tabpre"]."_ext_def
left join ".$GLOBALS["tabpre"]."_user_reg on ".$GLOBALS["tabpre"]."_ext_def.uid = ".$GLOBALS["tabpre"]."_user_reg.uid
left join ".$GLOBALS["tabpre"]."_cal_ini on ".$GLOBALS["tabpre"]."_ext_def.calid = ".$GLOBALS["tabpre"]."_cal_ini.calid
order by ".$GLOBALS["tabpre"]."_ext_def.eftext";

    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        if(($user->gsv("isadmin")==1) || ($user->gsv("cuid")==$row["uid"]) || $GLOBALS["demomode"] == true) {

            $row = gmqfix($row,1);

            $tlistid = $row["efid"];
            $tselcount = 0;
            $tlistval = "";
            $tlistval .= $row["efid"]."|";    #1
            $tlistval .= $row["uid"]."|";    #2
            $tlistval .= $row["calid"]."|";    #3
            $tlistval .= $row["efuseage"]."|";    #4
            $tlistval .= $row["eftype"]."|";    #5
            $tlistval .= $row["eftext"]."|";    #6
            $tlistval .= $row["format"]."|";    #7
            $tlistval .= $row["standard"]."|";    #8
            $tlistval .= $row["required"]."|";    #9
            $tlistval .= $row["validate"]."|";    #10
            $tlistval .= $row["checktype"]."|";    #11
            $tlistval .= $row["maxlen"]."|";    #12
            $tlistval .= $row["uname"]."|";    #13
            $tlistval .= $row["calname"];    #14

            if($row["format"] == "Select") {

                $sqlstr2 = "SELECT * from ".$GLOBALS["tabpre"]."_ext_sel_def where efid = ".$row["efid"]." order by efid,efsid";
                $query2 = mysql_query($sqlstr2) or die("Cannot query User Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                while($row2 = @mysql_fetch_array($query2)) {
                    $row2 = gmqfix($row2,1);
                    $tselcount++;    #0
                    $tlistval .= "|";
                    $tlistval .= $row2["efsid"]."|";
                    $tlistval .= $row2["efsval"]."|";
                    $tlistval .= $row2["standard"];
                }
                mysql_free_result($query2);
            }
            $tlistval = $tselcount."|".$tlistval;
            print "        <option ";
            print "value = \"".$tlistval."\">".$row["eftext"]."</option>\n";
        }
     }
     mysql_free_result($query1);

?>      </select><br>
User:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly id="flduser" name = "flduser" value=""><br>
Calendar:&nbsp;<input readonly id="fldcalendar" name = "fldcalendar" value=""><br>
</td>
<td>
<table border="1" cellpadding="3" cellspacing="0" width="98%" ID="Table1">
  <tr>
    <th width="20%" nowrap>Option</th>
    <th width="22%" nowrap>Entry</th>
    <th width="58%" nowrap>Remark</th>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">HTML Format</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[format]" id="format" language="javascript" onchange="return format_onchange()">
    <option selected value="Input">Input</option>
    <option value="Textarea">Textarea</option>
    <option value="Select">Select</option>
    </select>

<div id="optdiv" style="display:none">

<table border="1" cellpadding="1" cellspacing="0" width="100%" ID="optTable">
<tr id="optrow-0">
<td colspan="3" align="center">
    <input type="button" id="addopt" language="javascript" onclick="addopt_onclick()" value ="Add Option">
</td>
</tr>
</tr>
<th>Action</th>
<th>Value</th>
<th>Default</th>
</tr>
</table>

</div>
    </td>
    <td width="58%" valign="top">Choose <b>Input</b>, <b>Textarea</b> or <b>
    Select</b>.<b><br>
    Input</b> will generate a single line field, <b>Textarea</b> will generate a
    multiline field. <b>Select</b> will generate a list of options to choose
    from, you must also supply the options.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Field Name</th>
    <td width="22%" align="left" valign="top">
    <input style="width: 190px" type="text" name="efdef[eftext]" size="23" id="eftext"></td>
    <td width="58%" valign="top">Enter a description for the field to be used as the name or title. Country or City for example.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Field Usage</th>
    <td width="22%" nowrap align="left" valign="top">
    <select style="width: 190px" size="1" id="useage" name="efdef[useage]">
    <option value="0">Only me, only this calendar</option>
    <option value="1">Only me, any of my calendars</option>
    <option selected value="2">Only me, any calendar</option>
<?php
if($user->gsv("isadmin")==1) {
    ?>
    <option value="3">Any user, only this calendar</option>
    <option value="4">Any user, any of my calendars</option>
    <option selected value="5">Any user, any calendar</option>
<?php
}
?>
    </select>
    </td>
    <td width="58%" valign="top">Select who and where this field can be used.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Field Visibility</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[eftype]" id="eftype">
    <option selected value="Event">Event Form</option>
    <option value="Contact">Contact Form</option>
    </select>
    </td>
    <td width="58%" valign="top">Choose if field should be seen on an <b>Event</b>
    or on a <b>Contact</b> form. At the moment only Extended Event Fields are supported.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Standard</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[standard]" id="standard">
    <option value="0">No</option>
    <option selected value="1">Yes</option>
    </select></td>
    <td width="58%" valign="top">Select <b>Yes</b> if the field should be
    displayed automatically.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Required</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[required]" id="required">
    <option value="0">No</option>
    <option selected value="1">Yes</option>
    </select></td>
    <td width="58%" valign="top">Select <b>Yes</b> if the field must be filled.
    <b>Required</b> fields are automatically <b>Standard</b> as well</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Max Length</th>
    <td width="22%" align="left" valign="top">
    <input value="50" style="width: 190px" type="text" name="efdef[maxlen]" size="23" id="maxlen">
    </td>
    <td width="58%" valign="top">Enter the maximum length for an <b>Input</b>
    field type. <b>Textarea's</b> have a max length of approximately 1000
    characters.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Validate</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[validate]" id="validate">
    <option value="0">No</option>
    <option selected value="1">Yes</option>
    </select></td>
    <td width="58%" valign="top">Choose <b>Yes</b> if an <b>Input</b> fields
    contents are to be validated.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Validation</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[checktype]" id="checktype">
    <option selected value="Text">Text</option>
    <option value="Number">Number</option>
    <option value="Date">Date</option>
    </select></td>
    <td width="58%" valign="top">Choose the type of validation.</td>
  </tr>
</table>
</td>
</tr>
</table>
<br>
<?php

$disablebut = " disabled ";

if($GLOBALS["allowmakeextf"]==1) {
    $disablebut = " ";
}

if($GLOBALS["demomode"]==true) {
    $disablebut = " disabled ";
}

if($user->gsv("isadmin")==1) {
    $disablebut = " ";
}


?>
<input <?php print $disablebut; ?> language="javascript" onclick="return newextfield_onclick()" type="button" value = "New" id="newextfield" name="newextfield">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input <?php print $disablebut; ?> language="javascript" onclick="return saveextfield_onclick()" type="button" value = "Save" id="saveextfield" name="saveextfield">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input <?php print $disablebut; ?> language="javascript" onclick="return deleteextfield_onclick()" type="button" value = "Delete" id="deleteextfield" name="deleteextfield">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input language="javascript" onclick="return cancelextfield_onclick()" type="button" value = "Go to Calendar" id="cancelextfield" name="cancelextfield">
</center>
<!--
</form>
-->
</center>
<br><br>
<?php
if($GLOBALS["demomode"]==true && $user->gsv("isadmin")!=1) {
    print "<b>Functions disabled in demo mode</b>";
}
?>
</body>

</html>
<?php
exit();
} else {

}

?>
