    <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
    <!--

    var ferr = false;

    function getdefaultcal() {

	var extretval = "";
	//var xurl="defcalsel.php";

	var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=defcalselect";

	var xarg = "";

	var sFeatures="dialogHeight: 520px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
	extretval = window.showModalDialog(xurl, xarg, sFeatures);
//window.open(xurl);
	if(extretval=="0") {
	    alert("Change or set Default Calendar cancled.\n\n");
	    //calgsetup.forcedefaultcal.selectedIndex = 0;
	    return false;
	}

	extretval = extretval.split("|");
	calgsetup.forcedefaultcal.selectedIndex = 1;

        calgsetup.usercustom.selectedIndex = 0;
	calgsetup.dispcnpd.selectedIndex = 0;

	calgsetup.usercustom.disabled = true;
        calgsetup.dispcnpd.disabled = true;
	calgsetup.defaultcalid.value = extretval[0];
	calgsetup.defaultcalname.value = extretval[1];

	alert("Default Calendar Option set.\n\nUser Can Customise has been disabled.\n\nDisplay Calendar Pulldown has been disabled.");

    }

    function selcheck(selfield) {
	//alert(selfield);
	//alert(document.all.item(selfield).value);
	if(selfield=="forcedefaultcal") {
	    tfld = document.all.item(selfield).value;
	    if(tfld==0) {

		calgsetup.usercustom.disabled = false;
		calgsetup.dispcnpd.disabled = false;
		calgsetup.usercustom.selectedIndex = 1;
		calgsetup.dispcnpd.selectedIndex = 1;

		calgsetup.defaultcalid.value = "";
		calgsetup.defaultcalname.value = "";

		alert("Default Calendar Option disabled.\n\nUser Can Customise has been enabled.\n\nDisplay Calendar Pulldown has been enabled.");
	    }else if(tfld==1) {
		alert("This setting has no efect untill you select a default calendar.");
	    }
	}
    }

    function calgsetup_onsubmit() {
    	calgsetup.siteowner.value = trim(calgsetup.siteowner.value);
    	calgsetup.email.value = trim(calgsetup.email.value);
    	calgsetup.baseurl.value = trim(calgsetup.baseurl.value);

	var stdcalon = calgsetup.forcedefaultcal.value
	var stdcalid = calgsetup.defaultcalid.value

	if(stdcalon==1) {
	    if(stdcalid == "") {
		alert("If you turn on the Standard Default Calendar Option\nthen you must also select a calendar.\nUse the button provided!");
		return false;
	    }
	}

        if(calgsetup.siteowner.value == "") {
            alert("You must enter a Site Owner Name!");
            return false;
        }
        if(calgsetup.email.value == "") {
            alert("You must enter an Admin Email!");
            return false;
        }

        if(calgsetup.baseurl.value == "") {
            alert("You must enter base URL!");
            return false;
        }
        if(calgsetup.allowopen.value == 0 && calgsetup.allowpublic.value == 0 && calgsetup.allowprivate.value == 0) {
            alert("At least one type of Calendar must be enabled!");
            return false;
        }
        if(calgsetup.allowdv.value == 0 && calgsetup.allowwv.value == 0 && calgsetup.allowmv.value == 0 && calgsetup.allowyv.value == 0) {
            alert("At least one type of View must be enabled!");
            return false;
        }
        return true;
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

<?
if($reconfigfinish == 0) {

    print "function window_onload() {\n";

    print "calgsetup.forcedefaultcal.disabled = false;\n";
    print "calgsetup.selectdefaultcalendar.disabled = false;\n";

    if($GLOBALS["forcedefaultcal"] == 1) {

        print "calgsetup.usercustom.selectedIndex = 0;\n";
	print "calgsetup.dispcnpd.selectedIndex = 0;\n";

	print "calgsetup.usercustom.disabled = true;\n";
        print "calgsetup.dispcnpd.disabled = true;\n";
    }
    print "}\n";


} else {

    print "function window_onload() {\n";
    print "}\n";

}
?>

   //-->
    </SCRIPT>
