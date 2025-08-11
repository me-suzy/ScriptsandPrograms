<?php
if(($GLOBALS["allowmakeextf"]==1) || ($user->gsv("isadmin")==1)) {
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

    for(x=2;x < optTable.rows.length;x++) {
        retval = optTable.deleteRow(x);
        return;
    }

    extfieldform.format.selectedIndex = 0;
    extfieldform.eftext.value = "";
    extfieldform.useage.selectedIndex = 0;
    extfieldform.eftype.selectedIndex = 0;
    extfieldform.standard.selectedIndex = 0;
    extfieldform.required.selectedIndex = 0;
    extfieldform.maxlen.value = "50";
    extfieldform.validate.selectedIndex = 0;
    extfieldform.checktype.selectedIndex = 0;
    format_onchange();

}

function format_onchange() {
    if(extfieldform.format.value != "Input") {
        extfieldform.maxlen.disabled = true;
        extfieldform.validate.disabled = true;
        extfieldform.checktype.disabled = true;
    } else {
        extfieldform.maxlen.disabled = false;
        extfieldform.validate.disabled = false;
        extfieldform.checktype.disabled = false;
    }
    if(extfieldform.format.value == "Select") {
        optdiv.style.display="inline";
    } else {
        optdiv.style.display="none";
    }
}

function cancelextfield_onclick() {
    window.returnValue = "0";
    window.close();
}

function window_onload() {

//    alert(window.dialogArguments);

    tvar = window.dialogArguments;
    tvar = tvar.split("|");
    extfieldform.currentuser.value = tvar[0];
    extfieldform.currentcal.value = tvar[1];
    window.defaultStatus = "Extended Event Field. Please fill out the form, then click save.";
    window.returnValue = "0";

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
        seldefs = extfieldform.item("efseldefdef");
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
	newhtml = "<input size=\"23\" style=\"width=120px\" name=\"efseldef\" id=\"efseldef-" + (toptcount) + "\" value=\"Enter option text\">";
        newcel.innerHTML = newhtml;

        newcel = newrow.insertCell();
        newcel.id="optcellc-" + (toptcount);
        newcel.align="center";
        newcel.vAlign="top";
	newhtml = "<input language=\"javascript\" onclick=\"return efseldefdef_onclick('efseldefdef-" + (toptcount) + "')\" type=\"checkbox\" name=\"efseldefdef\" id=\"efseldefdef-" + (toptcount) + "\" value=\"1\">";
        newcel.innerHTML = newhtml;

}

function saveextfield_onclick() {

    extfieldform.saveextfield.disabled=true;

    tval = trim(extfieldform.eftext.value);
    extfieldform.eftext.value = tval;
    if(tval == "" ) {
        alert("The Field Name cannot be blank.\nSome special characters are not allowed.");
        extfieldform.saveextfield.disabled=false;
        return false;
    }
    if(extfieldform.format.value != "Select") {
        for(x=2;x < optTable.rows.length;x++) {
            retval = optTable.deleteRow(x);
        }
    } else {
        if(optTable.rows.length == 1) {
            alert("A Select Field must have at least one Option.");
            extfieldform.saveextfield.disabled=false;
            return false;
        }
        seldefs = extfieldform.item("efseldef");
        for(x=0;x < seldefs.length;x++) {
            valdef = seldefs.item(x).value;
            valdef = trim(valdef);
            seldefs.item(x).value = valdef;
            if(valdef == "" ) {
                alert("Option Fields cannot be blank.\nSome special characters are not allowed.");
                extfieldform.saveextfield.disabled=false;
                return false;
            }
        }
    }

    if(extfieldform.format.value == "Input") {
        extfieldform.maxlen.value = trim(extfieldform.maxlen.value);
        if(extfieldform.maxlen.value == "" || extfieldform.maxlen.value < "1" ) {
            alert("Input Fields must have a Maximum Length set.");
            extfieldform.saveextfield.disabled=false;
            return false;
        }
        if(extfieldform.validate.value == 1 && extfieldform.checktype.value == "Date" && extfieldform.maxlen.value < 10) {
            alert("Date Validation must have a minium length of 10.");
            extfieldform.saveextfield.disabled=false;
            return false;
        }
    }

    xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosaveextfield=1";

    xref =  "&currentuser=" + extfieldform.currentuser.value;
    xref += "&currentcal=" + extfieldform.currentcal.value;
    xref += "&efdef[eftext]=" + extfieldform.eftext.value;
    xref += "&efdef[format]=" + extfieldform.format.value;
    xref += "&efdef[useage]=" + extfieldform.useage.value;
    xref += "&efdef[eftype]=" + extfieldform.eftype.value;
    xref += "&efdef[standard]=" + extfieldform.standard.value;
    xref += "&efdef[required]=" + extfieldform.required.value;
    xref += "&efdef[maxlen]=" + extfieldform.maxlen.value;
    xref += "&efdef[validate]=" + extfieldform.validate.value;
    xref += "&efdef[checktype]=" + extfieldform.checktype.value;

    if(extfieldform.format.value == "Select") {
        seldefs = extfieldform.item("efseldef");
        for(x=0;x < seldefs.length;x++) {
            xref += "&efseldef[" + x + "]=" + seldefs.item(x).value;
        }
        xref += "&efseldefcount=" + seldefs.length;

        var defaultsel = "-1";
        seldefs = extfieldform.item("efseldefdef");
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

    xurl += xref;
    //alert(xurl);

    var sFeatures="dialogHeight: 250px; dialogWidth: 350px;  help: 0; resizable: 1; status: 0;";

    extretval = window.showModalDialog(xurl , "", sFeatures);
    //alert(extretval);
    window.returnValue = extretval;
    window.close();

}

//-->
</script>

</head>

<?php
print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
?>
<input type="hidden" id="optcount" value="0">
<h2>Extended Fields</h2>
<center>
<form target = "_self" align="center" method="<?php print $GLOBALS["postorget"]; ?>" name="extfieldform" id="extfieldform" action="<?php print $GLOBALS["idxfile"]; ?>">
<input type="hidden" id="currentuser" name="currentuser" value="<?php print $currentuser; ?>">
<input type="hidden" id="currentcal" name="currentcal" value="<?php print $currentcal; ?>">
<input type="hidden" name="gosaveextfield" value="1">
<center>
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
    <option selected value="1">Yes</option>
    <option value="0">No</option>
    </select></td>
    <td width="58%" valign="top">Select <b>Yes</b> if the field should be
    displayed automatically.</td>
  </tr>
  <tr>
    <th width="20%" nowrap align="left" valign="top">Required</th>
    <td width="22%" align="left" valign="top">
    <select style="width: 190px" size="1" name="efdef[required]" id="required">
    <option selected value="1">Yes</option>
    <option value="0">No</option>
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
    <option selected value="1">Yes</option>
    <option value="0">No</option>
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
<br>
<input language="javascript" onclick="newextfield_onclick()" type="button" value = "New" id="newextfield" name="newextfield">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input language="javascript" onclick="saveextfield_onclick()" type="button" value = "Save" id="saveextfield" name="saveextfield">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input language="javascript" onclick="cancelextfield_onclick()" type="button" value = "Cancel" id="cancelextfield" name="cancelextfield">
</center>
</form>
</center>
</body>

</html>
<?php
exit();
} else {

}

?>
