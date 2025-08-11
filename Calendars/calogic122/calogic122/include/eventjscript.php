<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

function regulate(value) {
    var re = new RegExp("[\]\[\|\"\'\&]","ig");
    value = value.replace(re, "");
    return(value);
}
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

function extfldcheck(extfldid,extfldvalid,chktype) {

    tfld = document.all.item(extfldid).value;
    tfld = document.all.item(extfldid).options(document.all.item(extfldid).selectedIndex).innerText;
//    alert(tfld);

    tval = document.all.item(extfldvalid).value;
//    alert(tval);
    var badval = false;
    if(chktype==1) {
        var re = new RegExp("[,]","ig");
        tval = tval.replace(re, ".");
        tval=trim(tval);
        if(tval=="") {
            alert("Extended field: \"" + tfld + "\" must be a number.\nOnly numbers and a decimal seperator ( . or , ) are allowed.");
            badval=true;
        } else if(isNaN(tval)) {
            alert("Extended field: \"" + tfld + "\" must be a number.\nOnly numbers and a decimal seperator ( . or , ) are allowed.");
            badval=true;
        }
    } else if(chktype==2) {
        if(tval=="") {
            alert("Extended field: \"" + tfld + "\" must not be blank.");
            badval=true;
        } else if(!check_date(tval)) {
            alert("Extended field: \"" + tfld + "\" must be a date.\nUse the format: DD.MM.YYYY");
            badval=true;
        }
    } else {
        if(tval=="") {
            alert("Extended field: \"" + tfld + "\" must not be blank.");
            badval=true;
        }
    }
    if(badval==true) {
        document.all.item(extfldvalid).focus();
        document.all.item(extfldvalid).select();
        return false;
    } else {
        return true;
    }
}

function rbday_onclick() {
divday.style.display="inline";
divweek.style.display="none";
divmonth.style.display="none";
divyear.style.display="none";

}

function rbmonth_onclick() {
divday.style.display="none";
divweek.style.display="none";
divmonth.style.display="inline";
divyear.style.display="none";

}

function rbweek_onclick() {
divday.style.display="none";
divweek.style.display="inline";
divmonth.style.display="none";
divyear.style.display="none";

}

function rbyear_onclick() {
divday.style.display="none";
divweek.style.display="none";
divmonth.style.display="none";
divyear.style.display="inline";

}

function eventrepeat_onclick() {
	if (cevent.eventrepeat.checked==true) {
		cevent.rbday.disabled=false;
		cevent.rbweek.disabled=false;
		cevent.rbmonth.disabled=false;
		cevent.rbyear.disabled=false;
		cevent.rbday.checked=true;
		divseriesevent.style.display="inline";
		divday.style.display="inline";
		divsend.style.display="inline";
		divweek.style.display="none";
		divmonth.style.display="none";
		divyear.style.display="none";
	} else {
		cevent.rbday.checked=false;
		cevent.rbweek.checked=false;
		cevent.rbmonth.checked=false;
		cevent.rbyear.checked=false;
		cevent.rbday.disabled=true;
		cevent.rbweek.disabled=true;
		cevent.rbmonth.disabled=true;
		cevent.rbyear.disabled=true;
		divseriesevent.style.display="none";
		divsend.style.display="none";
		divday.style.display="none";
		divweek.style.display="none";
		divmonth.style.display="none";
		divyear.style.display="none";
	}
}

<?php
if($GLOBALS["allowreminders"] == 1) {
?>

        function checkremset () {
            if(cevent.srint.value == 1) {
                if(cevent.srval.value < <?php print $GLOBALS["rminmin"]; ?> || cevent.srval.value > <?php print $GLOBALS["rminmax"]; ?>) {
                    alert("Invalid number of minutes for reminder!\nPlease enter a value from <?php print $GLOBALS["rminmin"]; ?> to <?php print $GLOBALS["rminmax"]; ?>");
                    return false;
                }
            }
            if(cevent.srint.value == 2) {
                if(cevent.srval.value < <?php print $GLOBALS["rhourmin"]; ?> || cevent.srval.value > <?php print $GLOBALS["rhourmax"]; ?>) {
                    alert("Invalid number of hours for reminder!\nPlease enter a value from <?php print $GLOBALS["rhourmin"]; ?> to <?php print $GLOBALS["rhourmax"]; ?>");
                    return false;
                }
            }
            if(cevent.srint.value == 3) {
                if(cevent.srval.value < <?php print $GLOBALS["rdaymin"]; ?> || cevent.srval.value > <?php print $GLOBALS["rdaymax"]; ?>) {
                    alert("Invalid number of days for reminder!\nPlease enter a value from <?php print $GLOBALS["rdaymin"]; ?> to <?php print $GLOBALS["rdaymax"]; ?>");
                    return false;
                }
            }
            return true;
        }

        function sendreminder_onclick() {
                if (cevent.sendreminder.checked==true) {
                    reminderbox.style.display="inline";
                } else {
                    reminderbox.style.display="none";
                }

        }

        function allcontacts_ondblclick() {
            if(checkremset()) {
                var nrl;
                for (i=0; i<cevent.allcontacts.options.length; i++) {
                    if(cevent.allcontacts.options(i).selected) {
                        nrl = document.createElement("OPTION");
                        nrl.text=cevent.allcontacts.options(i).text;
                        nrl.value=cevent.allcontacts.options(i).value + "|" + cevent.srval.value + "|" + cevent.srint.value;
                        document.all.cevent.remindercontacts.add(nrl);
                        cevent.allcontacts.options.remove(i);
                    }
                }
            }
        }

        function remindercontacts_ondblclick() {
            var drl;
            for (i=0; i<cevent.remindercontacts.options.length; i++) {
                if(cevent.remindercontacts.options(i).selected) {
                    drl = document.createElement("OPTION");
                    drl.text=cevent.remindercontacts.options(i).text;

                    tstrcvg = cevent.remindercontacts.options(i).value;
                    tstrcvg = tstrcvg.split("|");

                    drl.value=tstrcvg[0];
//                    drl.value=cevent.remindercontacts.options(i).value;
//                    drl.value=drl.value.substring(0,2);
                    document.all.cevent.allcontacts.add(drl);
                    cevent.remindercontacts.options.remove(i);
                }
            }
        }

        function addalllist_onclick() {
            if(checkremset()) {
                var narl;
                for (i=0; i<cevent.allcontacts.options.length; i++) {
                    narl = document.createElement("OPTION");
                    narl.text=cevent.allcontacts.options(i).text;
                    narl.value=cevent.allcontacts.options(i).value + "|" + cevent.srval.value + "|" + cevent.srint.value;
                    document.all.cevent.remindercontacts.add(narl);
                }
                do {
                    cevent.allcontacts.options.remove(0);
                } while(cevent.allcontacts.options.length > 0)
            }
        }

        function removealllist_onclick() {
            var rarl;
            for (i=0; i<cevent.remindercontacts.options.length; i++) {
                rarl = document.createElement("OPTION");
                rarl.text=cevent.remindercontacts.options(i).text;

                    tstrcvg=cevent.remindercontacts.options(i).value;
                    tstrcvg = tstrcvg.split("|");

                    rarl.value=tstrcvg[0];
//                rarl.value=cevent.remindercontacts.options(i).value;
//                rarl.value=rarl.value.substring(0,2);
                document.all.cevent.allcontacts.add(rarl);
            }
            do
            {
                cevent.remindercontacts.options.remove(0);
            }
            while(cevent.remindercontacts.options.length > 0)
        }

        function remindercontacts_onchange() {
            var tstrcvg;
            for (i=0; i<cevent.remindercontacts.options.length; i++) {
                if(cevent.remindercontacts.options(i).selected) {
                    tstrcvg=cevent.remindercontacts.options(i).value;
                    tstrcvg = tstrcvg.split("|");
                    cevent.srval.value = tstrcvg[1];
                    for (x=0; x<cevent.srint.options.length; x++) {
                        if(cevent.srint.options(x).value == tstrcvg[2]) {
                            cevent.srint.options(x).selected = true;
                        }
                    }
                }
            }
        }
<?php
if($curcalcfg["caltype"] < "2") {
?>
        function evsublist_onchange() {
            var tstrcvg,txstr1;
            for (i=0; i<cevent.evsublist.options.length; i++) {
                if(cevent.evsublist.options(i).selected) {
                    tstrcvg=cevent.evsublist.options(i).value;
                    tstrcvg = tstrcvg.split("|");
                    if(tstrcvg[0].substring(0,1)=="A") {
                        for (x=0; x<cevent.srint.options.length; x++) {
                            if(cevent.srint.options(x).value == tstrcvg[5]) {
                                txstr1 = cevent.srint.options(x).innerText;
                            }
                        }
                        cevent.selevsublist.innerText = "[A] " + tstrcvg[1] + " " + tstrcvg[2] + "\n" + tstrcvg[3] + "\n" + tstrcvg[4] + " " + txstr1 ;
                    } else {
                        for (x=0; x<cevent.srint.options.length; x++) {
                            if(cevent.srint.options(x).value == tstrcvg[3]) {
                                txstr1 = cevent.srint.options(x).innerText;
                            }
                        }
                        cevent.selevsublist.innerText = cevent.evsublist.options(i).innerText + " (" + tstrcvg[1] +")\n" + tstrcvg[2] + " " + txstr1 ;
                    }
                    //alert(cevent.evsublist.options(i).value);
                }
            }
        }

        function remsuballow_onclick() {
            if(cevent.remsuballow.checked==true) {
                divremsubopts.style.display="inline";
            } else {
                divremsubopts.style.display="none";
            }
        }

        function removesubscriber_onclick() {
            for (i=0; i<cevent.evsublist.options.length; i++) {
                if(cevent.evsublist.options(i).selected) {
                    cevent.evsublist.options.remove(i);
                    cevent.selevsublist.innerText = "";
                    break;
                }
            }
        }

        function addnewsubscriber_onclick() {
            var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=addevsub&currentuser=" + cevent.currentuser.value + "&currentcal=" + cevent.currentcal.value + "&remsublevel=" + cevent.remsublevel.value + "&aiev=1";
            var xarg = cevent.currentuser.value + "|" + cevent.currentcal.value + "|" + cevent.remsublevel.value + "|1";
            var sFeatures="dialogHeight: 520px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
            extretval = window.showModalDialog(xurl, xarg, sFeatures);
            //alert(extretval);
//            window.open(xurl);

//            xretval = "0|A0|" + evsubform.fname.value + "|" + evsubform.lname.value + "|" + evsubform.email.value + "|" + evsubform.srval.value + "|" + evsubform.srint.value + "|" + evsubform.tzos.value + "|" + evsubform.emailtype.value;

            if(extretval=="0") {
                alert("Add New Subscriber Cancled.");
                return false;
            }
            extretval = extretval.split("|");

            //alert(extretval[0]);
            if(extretval[0]==0) {

                extretval[4] = extretval[4].toLowerCase( );
                for (i=0; i<cevent.evsublist.options.length; i++) {
                    tstrcvg=cevent.evsublist.options(i).value;
                    tstrcvg = tstrcvg.split("|");
                    if(tstrcvg[0].substring(0,1)=="A") {
                        if(extretval[4]==tstrcvg[3] && extretval[5]==tstrcvg[4] && extretval[6]==tstrcvg[5]) {
                            for (x=0; x<cevent.srint.options.length; x++) {
                                if(cevent.srint.options(x).value == extretval[6]) {
                                    txstr1 = cevent.srint.options(x).innerText;
                                }
                            }
                            alert("Email adress: " + extretval[4] + "\nwith a reminder interval of " + extretval[5] + " " + txstr1 + "\nhas already been added to the subscription list.");
                            return false;
                        }
                    }
                }

                narl = document.createElement("OPTION");
                narl.text="[A] " + extretval[2] + " " + extretval[3] + ", " + extretval[4];
                narl.value=extretval[1] + "|" + extretval[2] + "|" + extretval[3] + "|" + extretval[4] + "|" + extretval[5] + "|" + extretval[6] + "|" + extretval[7] + "|" + extretval[8];
                document.all.cevent.evsublist.add(narl);

            } else {

                y=2;

                for(x=1;x<=extretval[1];x++) {
                    axnosave = false;
                    for (i=0; i<cevent.evsublist.options.length; i++) {
                        tstrcvg=cevent.evsublist.options(i).value;
                        tstrcvg = tstrcvg.split("|");
                        if(tstrcvg[0].substring(0,1)=="U") {
                            if(extretval[y+1]==tstrcvg[0] && extretval[y+3]==tstrcvg[2] && extretval[y+4]==tstrcvg[3]) {
                                for (z=0; z<cevent.srint.options.length; z++) {
                                    if(cevent.srint.options(z).value == extretval[y+4]) {
                                        txstr1 = cevent.srint.options(z).innerText;
                                    }
                                }

                                alert("User: " + extretval[y+2] + "\nwith a reminder interval of " + extretval[y+3] + " " + txstr1 + "\nhas already been added to the subscription list.");
                                axnosave = true;
                                break;
                            }
                        }
                    }
                    if(axnosave==false) {
                        narl = document.createElement("OPTION");
                        narl.text=extretval[y];
                        narl.value=extretval[y+1] + "|" + extretval[y+2] + "|" + extretval[y+3] + "|" + extretval[y+4];
                        document.all.cevent.evsublist.add(narl);
                    }
                    y = y + 5;
                }
            }
        }
<?php
}
}
?>

function window_onload() {

}

function remrow_onclick(exremrow) {
    for(x=0;x < extfldtab.rows.length;x++) {
        if(extfldtab.rows.item(x).id == exremrow) {
            retval = extfldtab.deleteRow(x);
            return;
        }
    }
}
function addextfield_onclick() {

	currowlen = extfldtab.rows.length;
	textfldcnt = cevent.extfldcnt.value;
	xdefcntst = extflddefcnt.value;
	if(xdefcntst > 0 ) {
            textfldcnt++;
            cevent.extfldcnt.value = textfldcnt;

            newrow = extfldtab.insertRow();
            newrow.id="extfldrow-" + textfldcnt;
            newrow.align="center";
            newrow.vAlign="top";

            newcel = newrow.insertCell();
            newcel.id="extfldcella-" + textfldcnt;
            newcel.align="center";
            newcel.vAlign="top";
            newcel.innerHTML = "<INPUT type=\"button\" value=\"Remove\" id=\"remrow-" + textfldcnt + "\"  LANGUAGE=javascript onclick=\"return remrow_onclick('extfldrow-" + textfldcnt + "')\">";

            newcel = newrow.insertCell();
            newcel.id="extfldcellb-" + textfldcnt;
            newcel.align="center";
            newcel.vAlign="top";
            newhtml = "<select language=\"javascript\" onchange=\"addextfldval('"+ textfldcnt + "|extfldcellc-" + textfldcnt + "|extfld-" + textfldcnt + "')\" style=\"width=170px\" name=\"extfld[" + textfldcnt + "]\" id=\"extfld-" + textfldcnt + "\">";
            newhtml += "<option value=\"0\">--</option>";
            for(x=1;x<=extflddefcnt.value;x++) {

                defpreid = "extdef-" + x;
                valpredef = document.all.item(defpreid).value;

                nextoptid = valpredef; //"extfld-def-" + x;
                nextopt = document.all.item(nextoptid);
                nextoptval = nextopt.value;
                nextoptval = nextoptval.split("|");
    /*            newhtml += "<option value=\"" + nextoptval[0] + "\">" + nextoptval[3] + "</option>"; */
                newhtml += "<option value=\"" + x + "\">" + nextoptval[3] + "</option>";
            }
            newhtml += "</select>";
            newcel.innerHTML = newhtml;

            newcel = newrow.insertCell();
            newcel.id="extfldcellc-" + textfldcnt;
            newcel.nowrap = true;
            newcel.innerText = " Please choose field definition";

            return "extfld-" + textfldcnt;
        } else {
            alert("No extended fields defined");
        }
}


function addreqfld() {

	currowlen = extfldtab.rows.length;
	rowidx = cevent.extreqfldcnt.value;
	rowidx++;
        cevent.extreqfldcnt.value = rowidx++;

	textfldcnt = cevent.extfldcnt.value;
	textfldcnt++;
	cevent.extfldcnt.value = textfldcnt;

	newrow = extfldtab.insertRow(rowidx-1);
        newrow.id="extfldrow-" + textfldcnt;
        newrow.align="center";
        newrow.vAlign="top";

        newcel = newrow.insertCell();
        newcel.id="extfldcella-" + textfldcnt;
        newcel.align="center";
        newcel.vAlign="top";
	newcel.innerText = "Required";

        newcel = newrow.insertCell();
        newcel.id="extfldcellb-" + textfldcnt;
        newcel.align="center";
        newcel.vAlign="top";
	newhtml = "<select language=\"javascript\" onchange=\"addextfldval('"+ textfldcnt + "|extfldcellc-" + textfldcnt + "|extfld-" + textfldcnt + "')\" style=\"width=170px\" name=\"extfld[" + textfldcnt + "]\" id=\"extfld-" + textfldcnt + "\">";

        defpreid = "extdef-" + extflddefcnt.value;
        valpredef = document.all.item(defpreid).value;
        nextoptid = valpredef; //"extfld-def-" + x;
        nextopt = document.all.item(nextoptid);
        nextoptval = nextopt.value;
        nextoptval = nextoptval.split("|");
        newhtml += "<option value=\"" + extflddefcnt.value + "\">" + nextoptval[3] + "</option>";

	newhtml += "</select>";
        newcel.innerHTML = newhtml;

        newcel = newrow.insertCell();
	newcel.id="extfldcellc-" + textfldcnt;
	newcel.nowrap = true;
        newcel.innerText = " Please choose field definition";

        cevent.extendedfields.checked=true;
        cevent.extendedfields.title = "Check this box to add an extended field  (Some extended fields required)";
        document.all.item("extendedfieldslabel").title = "Check this box to add extended fields  (Some extended fields required)"
        document.all.item("extendedfieldslabel").innerHTML = "<b>Add Extended Fields  (Some extended fields required)</b>";
        document.all.item("extfld-" + textfldcnt).onchange();

        //addextfldval("'" + textfldcnt + "|extfldcellc-" + textfldcnt + "|extfld-" + textfldcnt + "'");
}


function addextfldval(pasval) {

//    alert("pasval: " + pasval);

    pasval = pasval.split("|");
    selval = document.all.item(pasval[2]).value;
//    alert("selval: " + selval);

    if(selval=="0") {
        document.all.item(pasval[1]).innerHTML = "";
        document.all.item(pasval[1]).innerText = "  Please choose field definition";
        return;
    }

        xfldcnt = extfldtab.rows.length;

        for(x = xfldcnt-1 ; x > 0 ; x--) {
            trid = extfldtab.rows.item(x).id;
            trid = trid.split("-");
            opid = "extfld-" + trid[1];
            if(opid==pasval[2]) {
                continue;
            }
            opval = document.all.item(opid).value;
            if(opval==selval) {
                alert("The field you selected is already being used.");
                document.all.item(pasval[2]).item(0).selected = true;
                document.all.item(pasval[2]).onchange();
                return false;
            }
        }


    defpreid = "extdef-" + selval;
    valpredef = document.all.item(defpreid).value;

    //defid = "extfld-def-" + selval;
    defid = valpredef;

    valdef = document.all.item(defid).value;

//    alert(defid);
//    alert(valdef);

    valdef = valdef.split("|");

    if(valdef[4] == "Textarea") {
        newhtml = "<textarea style=\"width: 200px\" rows=\"6\" ";
    } else if(valdef[4] == "Input") {
        newhtml = "<input maxlength=\"" + valdef[9] + "\" style=\"width: 200px\" size=\"30\" type=\"text\" ";
    } else if(valdef[4] == "Select") {
        newhtml = "<Select style=\"width: 200px\" ";
    } else {
        alert("Invalid Field Definition");
        return;
    }
    newhtml += " name=\"extfldval[" + pasval[0] + "]\" id=\"extfldval-" + pasval[0] + "\"";

    if(valdef[4] == "Textarea") {
        newhtml +=  "></textarea>";
    } else if(valdef[4] == "Input") {
        newhtml +=  ">";
    } else if(valdef[4] == "Select") {
        newhtml +=  ">";
        selcnt = "extfld-sel-" + valdef[0] + "-cnt";
//        alert(selcnt);
        selcnt = document.all.item(selcnt).value;
//        alert(selcnt);

            for(x=1;x<=selcnt;x++) {
                selid = "extfld-sel-" + valdef[0] + "-" + x;
                seldef = document.all.item(selid).value;
                seldef = seldef.split("|");
                if(seldef[3]==1) {
                    stdtxt = " selected ";
                } else {
                    stdtxt = "";
                }
                newhtml += "<option " + stdtxt + " value=\"" + seldef[0] + "\">" + seldef[2] + "</option>";
            }
            newhtml += "</select>";
    }
    document.all.item(pasval[1]).innerHTML = newhtml;
}

function newextfield_onclick() {

    var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=addextfield&currentuser=" + cevent.currentuser.value + "&currentcal=" + cevent.currentcal.value;
    var xarg = cevent.currentuser.value + "|" + cevent.currentcal.value;
    var sFeatures="dialogHeight: 660px; dialogWidth: 850px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl, xarg, sFeatures);

    if(extretval=="0") {
        alert("Extended Field Cancled.");
        return false;
    }

    try {
        extadfldcnt = extflddefcnt.value;
    } catch(e) {
        extadfldcnt = 0;
    }

    if(extadfldcnt==0) {
        //retval = extfldtab.deleteRow(1);
        noextfldtxtdisp.innerHTML = "&nbsp;";
    }

    extadfldcnt++;
    extflddefcnt.value = extadfldcnt;
    exretsave = extretval;

    exretsave = exretsave.split("|");

    newhtml = "<input type=\"hidden\" id=\"extdef-" + extadfldcnt + "\" value=\"extfld-def-" + exretsave[0] + "\"><input type=\"hidden\" id=\"extfld-def-" + exretsave[0] + "\" value=\"" + exretsave[0] + "|" + exretsave[1] + "|" + exretsave[2] + "|" + exretsave[3] + "|" + exretsave[4] + "|" + exretsave[5] + "|" + exretsave[6] + "|" + exretsave[7] + "|" + exretsave[8] + "|" + exretsave[9] + "\">";

    newrow = extflddeftab.insertRow();

    newcel = newrow.insertCell();
    newcel.innerHTML = newhtml;


    if(exretsave[10]>0) {
        y=11;
        z=0;
        for(x=1;x<=exretsave[10];x++) {
            z++;
            newhtml = "<input type=\"hidden\" id=\"extfld-sel-" + exretsave[0] + "-" + z + "\" value=\"" + exretsave[y] + "|" + exretsave[y+1] + "|" + exretsave[y+2] + "|" + exretsave[y+3] + "\">";
            y = y + 4;

            newrow = extflddeftab.insertRow();
            newcel = newrow.insertCell();
            newcel.innerHTML = newhtml;
        }

        newhtml = "<input type=\"hidden\" id=\"extfld-sel-" + exretsave[0] + "-cnt\" value=\"" + z + "\">";
        newrow = extflddeftab.insertRow();
        newcel = newrow.insertCell();
        newcel.innerHTML = newhtml;

    }

    if(exretsave[6]==1) {
        addreqfld();
    } else if(exretsave[5]==1) {
        retid = addextfield_onclick();
        document.all.item(retid).selectedIndex = extadfldcnt;
        document.all.item(retid).onchange();
    }

    xreqfldcnt = cevent.extreqfldcnt.value;
    xreqfldcnt++;

    xfldcnt = extfldtab.rows.length-1;

    for(x = xreqfldcnt ; x < xfldcnt ; x++) {
        trid = extfldtab.rows.item(x).id;
        trid = trid.split("-");
        opid = "extfld-" + trid[1];
        opsobj = document.all.item(opid);
        var newopt = document.createElement("OPTION");
        opsobj.options.add(newopt);
        newopt.innerText = exretsave[3];
        newopt.value = extadfldcnt;
    }

}

function extendedfields_onclick() {
    if(cevent.extreqfldcnt.value > 0 ) {
        cevent.extendedfields.checked=true;
    }

    if (cevent.extendedfields.checked==true) {
        divextendedfields.style.display="inline";
    } else {
        divextendedfields.style.display="none";
    }
}

function eventstarttimehour_onchange() {
    if(cevent.eventstarttimehour.selectedIndex == 0) {
        if(confirm("Do you want to make this event an all day event?")) {
            cevent.eventstarttimemin.selectedIndex = 0;
            cevent.eventendtimehour.selectedIndex = 0;
            cevent.eventendtimemin.selectedIndex = 0;
            cevent.alldayevent.value = "1";
        } else {
            cevent.eventstarttimehour.selectedIndex = cevent.eventendtimehour.selectedIndex;
            cevent.alldayevent.value = "0";
            return false;
        }
    } else {
	    if(cevent.alldayevent.value == "1") {
                cevent.alldayevent.value = "0";
                cevent.eventstarttimemin.selectedIndex = 1;
                cevent.eventendtimehour.selectedIndex = cevent.eventstarttimehour.selectedIndex;
                cevent.eventendtimemin.selectedIndex = cevent.eventstarttimemin.selectedIndex;
	    } else {
                if(cevent.eventendtimehour.selectedIndex < cevent.eventstarttimehour.selectedIndex) {
                    cevent.eventendtimehour.selectedIndex = cevent.eventstarttimehour.selectedIndex;
                }
                if (cevent.eventendtimehour.selectedIndex == cevent.eventstarttimehour.selectedIndex && cevent.eventendtimemin.selectedIndex < cevent.eventstarttimemin.selectedIndex) {
                    cevent.eventendtimemin.selectedIndex = cevent.eventstarttimemin.selectedIndex;
                }
            }
    }
}

function eventstarttimemin_onchange() {
    if(cevent.eventstarttimemin.selectedIndex == 0) {
        if(confirm("Do you want to make this event an all day event?")) {
            cevent.eventstarttimehour.selectedIndex = 0;
            cevent.eventendtimehour.selectedIndex = 0;
            cevent.eventendtimemin.selectedIndex = 0;
            cevent.alldayevent.value = "1";
        } else {
            cevent.eventstarttimemin.selectedIndex = cevent.eventendtimemin.selectedIndex;
            cevent.alldayevent.value = "0";
            return false;
        }
    } else {
	    if(cevent.alldayevent.value == "1") {
                cevent.alldayevent.value = "0";
                cevent.eventstarttimehour.selectedIndex = 1;
                cevent.eventendtimehour.selectedIndex = cevent.eventstarttimehour.selectedIndex;
                cevent.eventendtimemin.selectedIndex = cevent.eventstarttimemin.selectedIndex;
	    } else {
		if (cevent.eventendtimehour.selectedIndex == cevent.eventstarttimehour.selectedIndex && cevent.eventendtimemin.selectedIndex < cevent.eventstarttimemin.selectedIndex) {
		    cevent.eventendtimemin.selectedIndex = cevent.eventstarttimemin.selectedIndex;
		}
	    }
    }
}

function eventendtimehour_onchange() {
    if(cevent.eventendtimehour.selectedIndex == 0) {
        if(confirm("Do you want to make this event an all day event?")) {
            cevent.eventstarttimehour.selectedIndex = 0;
            cevent.eventstarttimemin.selectedIndex = 0;
            cevent.eventendtimemin.selectedIndex = 0;
            cevent.alldayevent.value = "1";
        } else {
            cevent.eventendtimehour.selectedIndex = cevent.eventstarttimehour.selectedIndex;
            cevent.alldayevent.value = "0";
            return false;
        }
    } else {
	    if(cevent.alldayevent.value == "1") {
                cevent.alldayevent.value = "0";
                cevent.eventendtimemin.selectedIndex = 1;
                cevent.eventstarttimehour.selectedIndex = cevent.eventendtimehour.selectedIndex;
                cevent.eventstarttimemin.selectedIndex = cevent.eventendtimemin.selectedIndex;
	    } else {
                if(cevent.eventendtimehour.selectedIndex < cevent.eventstarttimehour.selectedIndex) {
                        cevent.eventstarttimehour.selectedIndex = cevent.eventendtimehour.selectedIndex;
                }
                if (cevent.eventendtimehour.selectedIndex == cevent.eventstarttimehour.selectedIndex && cevent.eventendtimemin.selectedIndex < cevent.eventstarttimemin.selectedIndex) {
                        cevent.eventstarttimemin.selectedIndex = cevent.eventendtimemin.selectedIndex;
                }
            }
    }
}

function eventendtimemin_onchange() {
    if(cevent.eventendtimemin.selectedIndex == 0) {
        if(confirm("Do you want to make this event an all day event?")) {
            cevent.eventstarttimehour.selectedIndex = 0;
            cevent.eventstarttimemin.selectedIndex = 0;
            cevent.eventendtimehour.selectedIndex = 0;
            cevent.alldayevent.value = "1";
        } else {
            cevent.eventendtimemin.selectedIndex = cevent.eventstarttimemin.selectedIndex;
            cevent.alldayevent.value = "0";
            return false;
        }
    } else {
	    if(cevent.alldayevent.value == "1") {
                cevent.alldayevent.value = "0";
                cevent.eventendtimehour.selectedIndex = 1;
                cevent.eventstarttimehour.selectedIndex = cevent.eventendtimehour.selectedIndex;
                cevent.eventstarttimemin.selectedIndex = cevent.eventendtimemin.selectedIndex;
	    } else {
		if (cevent.eventendtimehour.selectedIndex == cevent.eventstarttimehour.selectedIndex && cevent.eventendtimemin.selectedIndex < cevent.eventstarttimemin.selectedIndex) {
		    cevent.eventstarttimemin.selectedIndex = cevent.eventendtimemin.selectedIndex;
		}
	    }
    }
}

function cevent_onsubmit() {

    var xnosave = false;
    cevent.saveevent.disabled = true;
    //cevent.doneevent.disabled = true;

//    if(cevent.nosave.value == "0") {

        var tdateval;
        tdateval = cevent.eventday.item(cevent.eventday.selectedIndex).value + '.' + cevent.eventmonth.item(cevent.eventmonth.selectedIndex).value + '.' + cevent.eventyear.item(cevent.eventyear.selectedIndex).value;

        if (check_date(tdateval) != true) {
            alert("The start date must be valid!");
            xnosave = true;
        }

        cevent.eventtitle.value = trim(cevent.eventtitle.value);
        if(cevent.eventtitle.value == "") {
            alert("You must enter a Title!");
            xnosave = true;
        }
<?php
if($GLOBALS["allowreminders"] == 1) {
?>
        if(cevent.sendreminder.checked==true && cevent.remindercontacts.options.length < 1) {
            alert("At least one contact must be selected\nif you wish a reminder to be sent!");
            xnosave = true;
        }
<?php
}
?>

        if(cevent.eventrepeat.checked == true) {
            if(cevent.rbday.checked == true) {
                if(cevent.eachday.checked == true) {
                    if(cevent.eachdaycount.value < 1) {
                        xnosave = true;
                        alert("Invalid number of days!");
                    }
                }
            }
            if(cevent.rbweek.checked == true) {
                if(cevent.eachweekcount.value < 1) {
                    xnosave = true;
                    alert("Invalid number of weeks!");
                }
                if(cevent.weekday1.checked==false && cevent.weekday2.checked==false && cevent.weekday3.checked==false && cevent.weekday4.checked==false && cevent.weekday5.checked==false && cevent.weekday6.checked==false && cevent.weekday7.checked==false) {
                    xnosave = true;
                    alert("At least one day of the week must be checked!");
                }
            }
            if(cevent.rbmonth.checked == true) {
                if(cevent.dayofmonth1.checked == true) {
                    if(cevent.dayofmonthcount.value < 1) {
                        xnosave = true;
                        alert("Invalid number of months!");
                    }
                }
                if(cevent.dayofmonth2.checked == true) {
                    if(cevent.whichdayofmonthcount.value < 1) {
                        xnosave = true;
                        alert("Invalid number of months!");
                    }
                }
            }
            if(cevent.rbyear.checked == true) {

            }
            if(cevent.eventend2.checked == true) {
                if(cevent.eventendafter.value < 1) {
                    xnosave = true;
                    alert("Invalid number of occurances!");
                }
            }

            if(cevent.eventend3.checked == true) {
                tdateval = cevent.eventendday.item(cevent.eventendday.selectedIndex).value + '.' + cevent.eventendmonth.item(cevent.eventendmonth.selectedIndex).value + '.' + cevent.eventendyear.item(cevent.eventendyear.selectedIndex).value;
                if (check_date(tdateval) != true) {
                    alert("The end date must be valid!");
                    xnosave = true;
                }
            }
        }
// check extended fields

        xfldcnt = extfldtab.rows.length;

        for(x = xfldcnt-1 ; x > 0 ; x--) {
            trid = extfldtab.rows.item(x).id;
            trid = trid.split("-");
            opid = "extfld-" + trid[1];

            opval = document.all.item(opid).value;
            if(opval=="0") {
                remrow_onclick("extfldrow-" + trid[1]);
                continue;
            }


            optext = document.all.item(opid).innerText;

// get pointer id
            defval = "extdef-" + opval;
//alert(defval);
// get pointer id value (points to definition)
            defval = document.all.item(defval).value;

// get definition value
            defval = document.all.item(defval).value;

// split the definition
            defval = defval.split("|");

            valid = "extfldval-" + trid[1];

            fldval = document.all.item(valid).value;

            fldval = trim(fldval);

            document.all.item(valid).value = fldval;

// only inputs and text areas need to be checked
            if(defval[4]=="Input" || defval[4]=="Textarea") {
                if(defval[6]==1 && defval[7]==0) {
// required, no validate i.e. just not blank
                    if(!extfldcheck(opid,valid,3)) {
                        xnosave = true;
                    }
                } else if(defval[6]==1 && defval[7]==1) {
// required and validate
                    if(!extfldcheck(opid,valid,3)) {
                        xnosave = true;
                    } else {
                        if(defval[8]=="Text") {
                            if(!extfldcheck(opid,valid,3)) {
                                xnosave = true;
                            }
                        } else if(defval[8]=="Number") {
                            if(!extfldcheck(opid,valid,1)) {
                                xnosave = true;
                            }
                        } else if(defval[8]=="Date") {
                            if(!extfldcheck(opid,valid,2)) {
                                xnosave = true;
                            }
                        }
                    }
                } else if(defval[7]==1) {
// only validate, i.e. if blank then remove
                    if(fldval=="") {
                        remrow_onclick("extfldrow-" + trid[1]);
                    } else {
                        if(defval[8]=="Text") {
                            if(!extfldcheck(opid,valid,3)) {
                                xnosave = true;
                            }
                        } else if(defval[8]=="Number") {
                            if(!extfldcheck(opid,valid,1)) {
                                xnosave = true;
                            }
                        } else if(defval[8]=="Date") {
                            if(!extfldcheck(opid,valid,2)) {
                                xnosave = true;
                            }
                        }
                    }
                } else {
// not required,
//no validate,
//just remove if blank
                    if(fldval=="") {
                        remrow_onclick("extfldrow-" + trid[1]);
                    }
                }
            }
        }
        if(xnosave == true) {
            cevent.saveevent.disabled = false;
            cevent.doneevent.disabled = false;
            return false;
        } else {

            if(extfldtab.rows.length < 2) {
                cevent.extendedfields.checked = false;
            }
<?php
if($GLOBALS["allowreminders"] == 1) {
    if($curcalcfg["caltype"] < "2") {
?>
            if(cevent.remsuballow.checked==true) {
                if(cevent.evsublist.options.length>0) {
                    if(cevent.remsublevel.value==1) {
                        for (j=0; j<cevent.evsublist.options.length; j++) {
                            trxsub = cevent.evsublist.options(j).value;
                            trxsub = trxsub.split("|");
                            if(trxsub[0]=="A0") {
                                xsrx = "You have selected that only registered users may subscribe for a reminder.\n";
                                xsrx += "However, there have been non registered individuals added to the subscription list.\n";
                                xsrx += "If you continue, then all non registered individuals will be removed from the list.\n";
                                xsrx += "Do you wish to continue?";

                                if(confirm(xsrx)==true) {
                                    for (k=cevent.evsublist.options.length-1; k>=0; k--) {
                                        trxsub = cevent.evsublist.options(k).value;
                                        trxsub = trxsub.split("|");
                                        if(trxsub[0]=="A0") {
                                            cevent.evsublist.options(k).selected = true;
                                            removesubscriber_onclick();
                                        }
                                    }
                                    break;
                                } else {
                                    cevent.saveevent.disabled = false;
                                    cevent.doneevent.disabled = false;
                                    return false;
                                }
                            }
                        }
                    }
                    cevent.srsubs.value = cevent.evsublist.options.length;
                    for (i=0; i<cevent.evsublist.options.length; i++) {
                        cevent.srsubs.value += "|" + cevent.evsublist.options(i).value;
                    }
                } else {
                    cevent.srsubs.value = cevent.evsublist.options.length;
                }
            }
<?php
    }
?>
            if(cevent.sendreminder.checked==true) {
                cevent.srcons.value = "";
                var srconcnt = 0;
                for (i=0; i<cevent.remindercontacts.options.length; i++) {
                    if(srconcnt > 0) {
                        cevent.srcons.value += '|';
                    }
                    cevent.srcons.value += cevent.remindercontacts.options(i).value;
                    srconcnt++;
                }
            }


<?php
}
?>
            if(cevent.extendedfields.checked==true) {

                xfldcnt = extfldtab.rows.length;
                for(x = xfldcnt-1 ; x > 0 ; x--) {

                    trid = extfldtab.rows.item(x).id;
                    trid = trid.split("-");
                    opid = "extfld-" + trid[1];

                    opval = document.all.item(opid).value;
        // get pointer id
                    defval = "extdef-" + opval;

        // get pointer id value (points to definition)
                    defval = document.all.item(defval).value;
        // get definition value
                    defval = document.all.item(defval).value;
        // split the definition
                    defval = defval.split("|");
        // get table id of selected field
                    defid = defval[0];
        // reset the field def select field to the value of hte table id
//                    document.all.item(opid).value = defid;
                    document.all.item(opid).options(document.all.item(opid).selectedIndex).value=defid;
                }
            }
// if testing, return false here
//alert("will submit");
//return false;

//            return true;
            cevent.savingevent.value="1";
            cevent.submit();
        }
//    }
}

function doneevent_onclick() {
    cevent.nosave.value="1";

    cevent.saveevent.disabled = false;
    cevent.doneevent.disabled = false;

    //cevent.submit();
    document.location.href="<?php print $GLOBALS["idxfile"]; ?>";
}

function eventend1_onclick() {
	cevent.eventendday.disabled = true;
	cevent.eventendmonth.disabled = true;
	cevent.eventendyear.disabled = true;
}

function eventend2_onclick() {
	cevent.eventendday.disabled = true;
	cevent.eventendmonth.disabled = true;
	cevent.eventendyear.disabled = true;
}

function eventend3_onclick() {
	cevent.eventendday.disabled = false;
	cevent.eventendmonth.disabled = false;
	cevent.eventendyear.disabled = false;
}

function cat_onchange() {
	var curcatval = cevent.cat.options(cevent.cat.selectedIndex).value;
	var curcat = curcatval.split("|");
	cevent.rcat.value = curcat[0];
	if(curcat[0]!=0) {
            document.all("cexampfont").color = curcat[1];
            document.all("cexampcell").bgColor = curcat[2];
        } else {
            document.all("cexampfont").color = "<?php print $curcalcfg["gcscoif_btxtcolor"]; ?>";
            document.all("cexampcell").bgColor = "";
        }
}

function eventendday_onchange() {
	if(cevent.eventendyear.selectedIndex < cevent.eventyear.selectedIndex) {
		cevent.eventyear.selectedIndex = cevent.eventendyear.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex < cevent.eventmonth.selectedIndex) {
		cevent.eventmonth.selectedIndex = cevent.eventendmonth.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex == cevent.eventmonth.selectedIndex && cevent.eventendday.selectedIndex < cevent.eventday.selectedIndex) {
		cevent.eventday.selectedIndex = cevent.eventendday.selectedIndex;
	}
}

function eventendmonth_onchange() {
	if(cevent.eventendyear.selectedIndex < cevent.eventyear.selectedIndex) {
		cevent.eventyear.selectedIndex = cevent.eventendyear.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex < cevent.eventmonth.selectedIndex) {
		cevent.eventmonth.selectedIndex = cevent.eventendmonth.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex == cevent.eventmonth.selectedIndex && cevent.eventendday.selectedIndex < cevent.eventday.selectedIndex) {
		cevent.eventday.selectedIndex = cevent.eventendday.selectedIndex;
	}
}

function eventendyear_onchange() {
	if(cevent.eventendyear.selectedIndex < cevent.eventyear.selectedIndex) {
		cevent.eventyear.selectedIndex = cevent.eventendyear.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex < cevent.eventmonth.selectedIndex) {
		cevent.eventmonth.selectedIndex = cevent.eventendmonth.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex == cevent.eventmonth.selectedIndex && cevent.eventendday.selectedIndex < cevent.eventday.selectedIndex) {
		cevent.eventday.selectedIndex = cevent.eventendday.selectedIndex;
	}
}

function eventday_onchange() {
	if(cevent.eventendyear.selectedIndex < cevent.eventyear.selectedIndex) {
		cevent.eventendyear.selectedIndex = cevent.eventyear.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex < cevent.eventmonth.selectedIndex) {
		cevent.eventendmonth.selectedIndex = cevent.eventmonth.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex == cevent.eventmonth.selectedIndex && cevent.eventendday.selectedIndex < cevent.eventday.selectedIndex) {
		cevent.eventendday.selectedIndex = cevent.eventday.selectedIndex;
	}
}

function eventmonth_onchange() {
	if(cevent.eventendyear.selectedIndex < cevent.eventyear.selectedIndex) {
		cevent.eventendyear.selectedIndex = cevent.eventyear.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex < cevent.eventmonth.selectedIndex) {
		cevent.eventendmonth.selectedIndex = cevent.eventmonth.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex == cevent.eventmonth.selectedIndex && cevent.eventendday.selectedIndex < cevent.eventday.selectedIndex) {
		cevent.eventendday.selectedIndex = cevent.eventday.selectedIndex;
	}
}

function eventyear_onchange() {
	if(cevent.eventendyear.selectedIndex < cevent.eventyear.selectedIndex) {
		cevent.eventendyear.selectedIndex = cevent.eventyear.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex < cevent.eventmonth.selectedIndex) {
		cevent.eventendmonth.selectedIndex = cevent.eventmonth.selectedIndex;
	}
	if(cevent.eventendyear.selectedIndex == cevent.eventyear.selectedIndex && cevent.eventendmonth.selectedIndex == cevent.eventmonth.selectedIndex && cevent.eventendday.selectedIndex < cevent.eventday.selectedIndex) {
		cevent.eventendday.selectedIndex = cevent.eventday.selectedIndex;
	}
}

function check_date(dateval){

    //  contains the given date-string
    var Date;

    //  contains the length of the given date-string
    var date_length;

    //  contains the number of days of the month
    var month_length;

    //  These contain the day,month and year of the given date string after
    //  format correction
    var Day,Month,Year;

    //  number of points in date-string
    var point_count = 0;

    //  positions of points in date-string
    var point_positions = new Array;

    //  the new formated date is filled in here
    var correct_date_temp = new Array;

    //  start position of the year in the date-string
    var year_start_pos = 0;

    Date = dateval;
    date_length = Date.length;

    if(Date != ""){
        for(var str_pos = 0;str_pos < date_length; str_pos++){
            if(Date.charAt(str_pos)<"0" || Date.charAt(str_pos)>"9"){
                if(Date.charAt(str_pos,1)=='.'){
                    point_count++;
                    if(point_count <= 2){
                        point_positions[point_positions.length] = str_pos;
                    }
                } else {
                    return false;
                }
            }
        }
        if(point_count!=2){
            return false;
        }
        //case 1 day-length = 1
        if(point_positions[0] == 1){
            correct_date_temp[correct_date_temp.length] = "0";
            correct_date_temp[correct_date_temp.length] = Date.substr(0,1);
            correct_date_temp[correct_date_temp.length] = ".";
            //month-length = 1
            if(point_positions[1] == 3){
                correct_date_temp[correct_date_temp.length] = "0";
                correct_date_temp[correct_date_temp.length] = Date.substr(2,1);
                correct_date_temp[correct_date_temp.length] = ".";
                year_start_pos = 4;
            } else if(point_positions[1] == 4) {
                //month-length = 2
                correct_date_temp[correct_date_temp.length] = Date.substr(2,2);
                correct_date_temp[correct_date_temp.length] = ".";
                year_start_pos = 5;
            } else {
                //point at wrong position
                //alertbox(textbox);
                return false;
            }
        } else if(point_positions[0] == 2) {
            //case 2 day-length = 2
            correct_date_temp[correct_date_temp.length] = Date.substr(0,2);
            correct_date_temp[correct_date_temp.length] = ".";
            //month-length = 1
            if(point_positions[1] == 4){
                correct_date_temp[correct_date_temp.length] = "0";
                correct_date_temp[correct_date_temp.length] = Date.substr(3,1);
                correct_date_temp[correct_date_temp.length] = ".";
                year_start_pos = 5;
            } else if(point_positions[1] == 5) {
                //month-length = 2
                correct_date_temp[correct_date_temp.length] = Date.substr(3,2);
                correct_date_temp[correct_date_temp.length] = ".";
                year_start_pos = 6;
            } else {
                //point at wrong position
                return false;
            }
        }
        //year-length = 1
        if(date_length - year_start_pos == 1){
            correct_date_temp[correct_date_temp.length] = "200";
            correct_date_temp[correct_date_temp.length] = Date.substr(year_start_pos,1);
        } else if(date_length - year_start_pos == 2) {
            //year-length = 2
            if(Date.substr(year_start_pos,2)<=30){
                correct_date_temp[correct_date_temp.length] = "20";
                correct_date_temp[correct_date_temp.length] = Date.substr(year_start_pos,2);
            } else {
                correct_date_temp[correct_date_temp.length] = "19";
                correct_date_temp[correct_date_temp.length] = Date.substr(year_start_pos,2);
            }
        } else if(date_length - year_start_pos == 4) {
            //year-length must be 4
            correct_date_temp[correct_date_temp.length] = Date.substr(year_start_pos,4);
        } else {
            return false;
        }
        Date = correct_date_temp.join("");
        dateval = Date;

        if (Date.length==10 && Date.substring(2,3)=="." && Date.substring(5,6)=="."){
            Day = parseInt(Date.substr(0,2),10);
            Month = parseInt(Date.substr(3,2),10);
            Year = parseInt(Date.substr(6,4),10);
        } else {
            return false;
        }
        if (Month==4 || Month==6 || Month==9 || Month==11){
            month_length=30;
        } else if (Month==1 || Month==3 || Month==5 || Month==7 || Month==8 || Month==10 || Month==12){
            month_length=31;
        } else if(Month==2 && Year%4==0 && Year%100!=0 || Year%400==0){
            month_length=29;
        } else if(Month==2 && Year%4!=0 || Year%100==0 && Year%400!=0){
            month_length=28;
        }
        if (Day>=1 && Day<=month_length && Month>=1 && Month<=12 ){
            return true;
        }
        else{
            return false;
        }
    } else {
        return false;
    }
}

//-->
</SCRIPT>
