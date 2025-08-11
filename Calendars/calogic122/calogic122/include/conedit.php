<html>

<?php
print $GLOBALS["htmldoctype"];
?>
<head>
<title>Contacts</title>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

amediting = false;

function regulate(value) {
    var re = new RegExp("[\|]","ig");
    value = value.replace(re, "");
    return(value);
}

function conlist_onchange() {

    var haveerror = false;

    document.all.grpowner.innerHTML = "Owner: &nbsp;";

    if(conlist.selectedIndex == -1) {
        return false;
    }

    if(assmode.checked == false) {
        //conlist.selectedIndex = -1;
        grplist.selectedIndex = -1;
        sharedgrplist.selectedIndex = -1;

        if(grpmode.checked == true) {
            txid = conlist.options(conlist.selectedIndex).id
            txid = txid.split("-");
            tcurid = "conlnk-" + txid[1];
//            tcurid = "conlnk-" + conlist.options(conlist.selectedIndex).id;
            tcongrps = document.all.item(tcurid).value;
            //alert(tcongrp);
            tcongrp = tcongrps.split("|");

            for(i=0;i<tcongrp.length;i++) {
                if(trim(tcongrp[i]) != "") {
                    tcid = "grp-" + tcongrp[i];
                    //grplist.options(tcid).selected = true;
                    try {
                        document.all.item(tcid).selected = true;
                    } catch(e) {

                    }
                }
            }
            if(haveerror == true) {
                // could show an alert here, that the selected shared contact is in a non shared
                // group of another user.
                // which really has no efect on how CaLogic works.
            }

        }


    }
    amediting = false;

    var curconval = conlist.options(conlist.selectedIndex).value;
    var curcon = curconval.split("|");

    confname.value = curcon[3];
    conlname.value = curcon[4];
    conemail.value = curcon[5];
    conemailtype.value = curcon[15];

    for(i=0;i<conemailtype.length;i++) {
            if(conemailtype.options(i).value == curcon[15]) {
                conemailtype.selectedIndex = i;
            }
    }

    conbday.value = curcon[6];
    contzos.value = curcon[7];
    contel1.value = curcon[8];
    contel2.value = curcon[9];
    contel3.value = curcon[10];
    confax.value = curcon[11];
    conadr.innerText = curcon[12];
    if(curcon[2]==1) {
        conshare.selectedIndex = 1;
    } else {
        conshare.selectedIndex = 0;
    }
    document.all.tdowner.innerHTML = "<a href='mailto:" + curcon[14] + "'>" + curcon[13] + "</a>";

    if(curcon[0] != curuid.value && curuidia.value == 0) {
        editcon.disabled = true;
        savecon.disabled = true;
        deletecon.disabled = true;
        curconid.value="";

    } else {
        editcon.disabled = false;
        savecon.disabled = false;
        deletecon.disabled = false;
        curconid.value=curcon[1];
    }

}

function assmode_onclick() {

    //conlist.selectedIndex = -1;
    //grplist.selectedIndex = -1;
    //sharedgrplist.selectedIndex = -1;

    clearconform();
    //clearlists();
    setbutsview();

}

function newcon_onclick() {

    amediting = false;

    conlist.selectedIndex = -1;
    grplist.selectedIndex = -1;
    sharedgrplist.selectedIndex = -1;

    clearconform();
    clearlists();
    setbutsedit();

}


function cancelnewcon_onclick() {

    conlist.selectedIndex = -1;
    grplist.selectedIndex = -1;
    sharedgrplist.selectedIndex = -1;

    clearconform();
    clearlists();
    setbutsview();

}

function newcongp_onclick() {

    disablebuts();

    if(trim(gpedit.value) == "") {
        alert("First enter a new group name\nthen click New");
        enablebuts();
        return false;
    }

    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=newgroup&uid=" + curuid.value + "&grpname=" + trim(gpedit.value) + "&grpshare=" + grpshare.selectedIndex;
    var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl, '', sFeatures);
    if(extretval == "1") {
        document.location.reload();
    }

    enablebuts();

}

function editcongp_onclick() {

    disablebuts();

    if(grplist.selectedIndex == -1) {
        alert("First click a group name, then change\nthe name in the field provided\nthen click Rename");
        enablebuts();
        return false;
    }
    if(gpedit.value == "") {
        alert("First enter a new group name\nthen click Rename");
        enablebuts();
        return false;
    }

    grpid = grplist.options(grplist.selectedIndex).value;
    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=editgroup&uid=" + curuid.value + "&newgrpname=" + trim(gpedit.value) + "&grpid=" + grpid + "&grpshare=" + grpshare.selectedIndex;
    var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl, '', sFeatures);
    if(extretval == "1") {
        document.location.reload();
    }
    enablebuts();
}


function delcongp_onclick() {

    disablebuts();

    if(grplist.selectedIndex == -1) {
        alert("First select the group(s) you want to delete.");
        enablebuts();
        return false;
    }

    dodelete = false;
    if(grplist.multiple == true) {
        dodelete = confirm("Are you sure you want to delete ALL of the\nselected groups?\n\nOnly the groups will be deleted,\nnot the contacts in the groups.");
    } else {
        dodelete = confirm("Are you sure you want to delete\nthe selected group?\n\nOnly the group will be deleted,\nnot the contacts in the group.");
    }

    if(dodelete==false) {
        alert("Group delete canceled");
        enablebuts();
        return false;
    }

    params = "";
    for (i=0; i<grplist.options.length; i++) {
        if(grplist.options(i).selected == true) {
            tid = grplist.options(i).id;
            txid = tid.split("-");
            tid = txid[1];
            params += tid + "|";
        }
    }

    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=deletegroup&grpvals=" + params;
    var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl, '', sFeatures);
    if(extretval == "1") {
        document.location.reload();
    }

    enablebuts();

}


function donecon_onclick() {
    document.location.href="<?php print $GLOBALS["idxfile"]; ?>";
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

function copycon_onclick() {

    if(conlist.selectedIndex == -1) {
        alert("First select the contact you want to copy.");
        return false;
    }

    prepconedit();
    setbutsedit();
    curconid.value="";

}

function conmode_onclick() {

    conlist.selectedIndex = -1;
    grplist.selectedIndex = -1;
    sharedgrplist.selectedIndex = -1;

    clearlists();
    clearconform();

    conlist.multiple = true;
    grplist.multiple = false;

    conmode.checked = true;
    grpmode.checked = false;


}

function grpmode_onclick() {

    conlist.selectedIndex = -1;
    grplist.selectedIndex = -1;
    sharedgrplist.selectedIndex = -1;

    clearlists();
    clearconform();

    conlist.multiple = false;
    grplist.multiple = true;

    grpmode.checked = true;
    conmode.checked = false;

}

function clearlists() {

    for(i=0;i<conlist.length;i++) {
        conlist.options(i).selected = false;
    }

    for(i=0;i<grplist.length;i++) {
        grplist.options(i).selected = false;
    }

    document.all.grpowner.innerHTML = "Owner: &nbsp;";

}


function clearconform() {

    confname.value = "";
    conlname.value = "";
    conemail.value = "";
    conemailtype.selectedIndex = 0;
    conbday.value = "";
    contzos.value = "<?php print $xdusertz; ?>";
    contel1.value = "";
    contel2.value = "";
    contel3.value = "";
    confax.value = "";
    conadr.innerText = "";
    document.all.tdowner.innerHTML = "&nbsp;";
    conshare.selectedIndex = 0;
    curconid.value="";
    amediting = false;
    document.all.grpowner.innerHTML = "Owner: &nbsp;";

}

function savecon_onclick() {

    disablebuts();

/*
    if(conlist.selectedIndex == -1) {
        alert("First select the contact you want to save.");
        enablebuts();
        return false;
    }
*/

    confname.value = trim(regulate(confname.value));
    conlname.value = trim(regulate(conlname.value));
    if(confname.value == "" && conlname.value == "") {
        alert("Either the First or Last name must be filled!");
        enablebuts();
        return false;
    }

    params = "";
    params += curconid.value;
    params += "|" + trim(regulate(confname.value));
    params += "|" + trim(regulate(conlname.value));
    params += "|" + trim(regulate(conemail.value));
    params += "|" + trim(regulate(conemailtype.value));
    params += "|" + trim(regulate(conbday.value));
    params += "|" + trim(regulate(contzos.value));
    params += "|" + trim(regulate(contel1.value));
    params += "|" + trim(regulate(contel2.value));
    params += "|" + trim(regulate(contel3.value));
    params += "|" + trim(regulate(confax.value));
    params += "|" + conshare.selectedIndex;
    params += "|" + encodeURIComponent(regulate(conadr.innerText));

    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=savecon&convals=" + params;
    var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl, '', sFeatures);
    if(extretval == "1") {
        document.location.reload();
    }

    enablebuts();

}

function deletecon_onclick() {

    disablebuts();

    if(conlist.selectedIndex == -1) {
        alert("First select the contact(s) you want to delete.");
        enablebuts();
        return false;
    }

    dodelete = false;
    if(conlist.multiple == true) {
        dodelete = confirm("Are you sure you want to delete ALL of the\nselected contacts?");
    } else {
        dodelete = confirm("Are you sure you want to delete\nthe selected contact?");
    }

    if(dodelete==false) {
        alert("Contact delete canceled");
        enablebuts();
        return false;
    }

    params = "";
    for (i=0; i<conlist.options.length; i++) {
        if(conlist.options(i).selected == true) {
            tid = conlist.options(i).id;
            txid = tid.split("-");
            tid = txid[1];
            params += tid + "|";
        }
    }

    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=deletecon&convals=" + params;
    var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
    extretval = window.showModalDialog(xurl, '', sFeatures);
    if(extretval == "1") {
        document.location.reload();
    }

    enablebuts();
}

function editcon_onclick() {

    if(conlist.selectedIndex == -1) {
        alert("First select the contact you want to edit.");
        return false;
    }


    var curconval = conlist.options(conlist.selectedIndex).value;
    var curcon = curconval.split("|");


    if(curcon[0] != curuid.value && curuidia.value == 0) {
        alert("You cannot edit this contact\nbecause you are not the owner of it.");
        return false;
    }

    amediting = true;
    prepconedit();
    setbutsedit();


//    alert(curconid.value);

}

function prepconedit() {

    var curconval = conlist.options(conlist.selectedIndex).value;
    var curcon = curconval.split("|");

    conlist.selectedIndex = -1;
    grplist.selectedIndex = -1;
    sharedgrplist.selectedIndex = -1;

    clearconform();
    clearlists();

    confname.value = curcon[3];
    conlname.value = curcon[4];
    conemail.value = curcon[5];

    for(i=0;i<conemailtype.length;i++) {
            if(conemailtype.options(i).value == curcon[15]) {
                conemailtype.selectedIndex = i;
            }
    }

    conbday.value = curcon[6];
    contzos.value = curcon[7];
    contel1.value = curcon[8];
    contel2.value = curcon[9];
    contel3.value = curcon[10];
    confax.value = curcon[11];
    conadr.innerText = curcon[12];

    if(curcon[2]==1) {
        conshare.selectedIndex = 1;
    } else {
        conshare.selectedIndex = 0;
    }
    document.all.tdowner.innerHTML = "&nbsp;";
    curconid.value=curcon[1];

}

function setbutsedit() {

    divdelcon.style.display="none";
    divcannewcon.style.display="inline";

    diveditcon.style.display="none";
    divsavecon.style.display="inline";


    conlist.disabled = true;
    grplist.disabled = true;
    conmode.disabled = true;
    grpmode.disabled = true;
    assmode.disabled = true;
    sharedgrplist.disabled = true;

    newcongp.disabled = true;
    editcongp.disabled = true;
    delcongp.disabled = true;
    savegrpcon.disabled = true;

    copycon.disabled = true;
    newcon.disabled = true;
    donecon.disabled = true;

    deletecon.disabled = false;
    editcon.disabled = false;
    savecon.disabled = false;

    confname.disabled = false;
    conlname.disabled = false;
    conemail.disabled = false;
    conemailtype.disabled = false;
    conbday.disabled = false;
    contzos.disabled = false;
    contel1.disabled = false;
    contel2.disabled = false;
    contel3.disabled = false;
    confax.disabled = false;
    conadr.disabled = false;
    conshare.disabled = false;

    confname.focus;

}

function setbutsview() {

    divdelcon.style.display="inline";
    divcannewcon.style.display="none";

    diveditcon.style.display="inline";
    divsavecon.style.display="none";

    conlist.disabled = false;
    grplist.disabled = false;
    conmode.disabled = false;
    grpmode.disabled = false;
    assmode.disabled = false;
    sharedgrplist.disabled = false;

    newcongp.disabled = false;
    editcongp.disabled = false;
    delcongp.disabled = false;
    savegrpcon.disabled = false;

    copycon.disabled = false;
    newcon.disabled = false;
    donecon.disabled = false;

    deletecon.disabled = false;
    editcon.disabled = false;
    savecon.disabled = false;

    confname.disabled = true;
    conlname.disabled = true;
    conemail.disabled = true;
    conemailtype.disabled = true;
    conbday.disabled = true;
    contzos.disabled = true;
    contel1.disabled = true;
    contel2.disabled = true;
    contel3.disabled = true;
    confax.disabled = true;
    conadr.disabled = true;
    conshare.disabled = true;

}

function disablebuts() {

    divdelcon.style.display="inline";
    divcannewcon.style.display="none";

    diveditcon.style.display="inline";
    divsavecon.style.display="none";

    savecon.disabled = true;
    editcon.disabled = true;
    deletecon.disabled = true;
    cancelnewcon.disabled = true;


    conlist.disabled = true;
    grplist.disabled = true;
    conmode.disabled = true;
    grpmode.disabled = true;
    assmode.disabled = true;
    sharedgrplist.disabled = true;

    newcongp.disabled = true;
    editcongp.disabled = true;
    delcongp.disabled = true;
    savegrpcon.disabled = true;

    copycon.disabled = true;
    newcon.disabled = true;
    donecon.disabled = true;


    confname.disabled = true;
    conlname.disabled = true;
    conemail.disabled = true;
    conemailtype.disabled = true;
    conbday.disabled = true;
    contzos.disabled = true;
    contel1.disabled = true;
    contel2.disabled = true;
    contel3.disabled = true;
    confax.disabled = true;
    conadr.disabled = true;
    conshare.disabled = true;

}

function enablebuts() {

    divdelcon.style.display="inline";
    divcannewcon.style.display="none";

    diveditcon.style.display="inline";
    divsavecon.style.display="none";

    savecon.disabled = false;
    editcon.disabled = false;
    deletecon.disabled = false;
    cancelnewcon.disabled = false;


    conlist.disabled = false;
    grplist.disabled = false;
    conmode.disabled = false;
    grpmode.disabled = false;

    newcongp.disabled = false;
    editcongp.disabled = false;
    delcongp.disabled = false;
    savegrpcon.disabled = false;

    copycon.disabled = false;
    newcon.disabled = false;
    donecon.disabled = false;


    confname.disabled = false;
    conlname.disabled = false;
    conemail.disabled = false;
    conemailtype.disabled = false;
    conbday.disabled = false;
    contzos.disabled = false;
    contel1.disabled = false;
    contel2.disabled = false;
    contel3.disabled = false;
    confax.disabled = false;
    conadr.disabled = false;
    conshare.disabled = false;

    setbutsview();

}

function savegrpcon_onclick() {

    disablebuts();

    if(assmode.checked == false) {
        alert("You have to be in Association mode\nto save Associations.");
        enablebuts();
        return false;
    }

    if(conlist.selectedIndex == -1 || grplist.selectedIndex == -1) {
        alert("First select the Contact(s)/Group(s) you want to associate.");
        enablebuts();
        return false;
    }

    if(grpmode.checked == true) {

        var params = "";

        params = conlist.options(conlist.selectedIndex).id;
        txid = params.split("-");
        params = txid[1];

        for (i=0; i<grplist.options.length; i++) {
            if(grplist.options(i).selected == true) {
                tid = grplist.options(i).id;
                txid = tid.split("-");
                tid = txid[1];
                params += "|" + tid;
            }
        }

        var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=assconsave&congrpvals=" + params;
        var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
        extretval = window.showModalDialog(xurl, '', sFeatures);
        if(extretval == "1") {
            document.location.reload();
        }

    } else if(conmode.checked == true) {

        var params = "";

        params = grplist.options(grplist.selectedIndex).id;
        txid = params.split("-");
        params = txid[1];

        for (i=0; i<conlist.options.length; i++) {
            if(conlist.options(i).selected == true) {
                tid = conlist.options(i).id;
                txid = tid.split("-");
                tid = txid[1];
                params += "|" + tid;
            }
        }

        var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=assgroupsave&grpconvals=" + params;
        var sFeatures="dialogHeight: 300px; dialogWidth: 400px;  help: 0; resizable: 1; status: 0;";
        extretval = window.showModalDialog(xurl, '', sFeatures);
        if(extretval == "1") {
            document.location.reload();
        }

    } else {
        alert("Error, either contact mode or group mode\nmust be selected.");
        enablebuts();
        return false;
    }

    enablebuts();
}

function sharedgrplist_onchange() {

    var haveerror = false;

    if(assmode.checked == false) {
        conlist.selectedIndex = -1;
        grplist.selectedIndex = -1;
        //sharedgrplist.selectedIndex = -1;

        if(conmode.checked == true) {
            txid = sharedgrplist.options(sharedgrplist.selectedIndex).id
            txid = txid.split("-");
            tcurid = "gplnk-" + txid[1];
            tcongrps = document.all.item(tcurid).value;
            tcongrp = tcongrps.split("|");
            for(i=0;i<tcongrp.length;i++) {
                if(trim(tcongrp[i]) != "") {
                    tcid = "con-" + tcongrp[i];
                    try {
                        conlist.options(tcid).selected = true;
                    } catch(e) {
                        haveerror = true;
                    }
                }
            }
            if(haveerror == true) {
                // could show an alert here, that some contacts in a shared
                // group are themselves not shared.
                // which really has no efect on how CaLogic works.
            }

        }


    }

    var curgrpval = sharedgrplist.options(sharedgrplist.selectedIndex).value;
    var curgrp = curgrpval.split("|");

    document.all.grpowner.innerHTML = "Owner: <a href='mailto:" + curgrp[1] + "'>" + curgrp[0] + "</a>";

}

function grplist_onchange() {

    if(grplist.selectedIndex == -1) {
        return false;
    }


    if(assmode.checked == false) {
        conlist.selectedIndex = -1;
        //grplist.selectedIndex = -1;
        sharedgrplist.selectedIndex = -1;

        if(conmode.checked == true) {

            txid = grplist.options(grplist.selectedIndex).id
            txid = txid.split("-");
            tcurid = "gplnk-" + txid[1];
            tcongrps = document.all.item(tcurid).value;
            //alert(tcongrp);
            tcongrp = tcongrps.split("|");

            for(i=0;i<tcongrp.length;i++) {
                if(trim(tcongrp[i]) != "") {
                    tcid = "con-" + tcongrp[i];
                    conlist.options(tcid).selected = true;
                }
            }

        }

    }

    var curgrpval = grplist.options(grplist.selectedIndex).value;
    var curgrp = curgrpval.split("|");

    if(curgrp[1]==1) {
        grpshare.selectedIndex = 1;
    } else {
        grpshare.selectedIndex = 0;
    }

    gpedit.value = curgrp[2];
    document.all.grpowner.innerHTML = "Owner: &nbsp;";
}

<?php

if($cuser->gsv("isadmin")==1) {

    $xpsid = "";
    if($GLOBALS["adsid"] == true) {
        $xpsid = "&".SID;
    }

    ?>

    function editallcontacts_onclick() {

        var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=contacts&contacts=1&editallcontacts=1<?php print $xpsid; ?>&trash=";
        document.location.href=xurl;

    }

<?php
}
?>

//-->
</SCRIPT>
</head>

<body <?php print $GLOBALS["calbodystyle"]; ?>>

<h1>Contacts</h1>
<?php

$curenteditstate="0";

if(isset($GLOBALS["editallcontacts"]) && $cuser->gsv("isadmin") != 1) {
    print "<br><br><h3>YOU ARE NOT AN ADMIN!<br><br>";

    include($GLOBALS["CLPath"]."/include/footer.php");
    exit();
}
if($cuser->gsv("isadmin")==1) {
    if(isset($GLOBALS["editallcontacts"])) {
        #$curenteditstate="1";
    }
    ?>
    <!--<INPUT type="button" value="Edit All Contacts" id="editallcontacts" name="editallcontacts" LANGUAGE=javascript onclick="return editallcontacts_onclick()">-->
    <?php
}
if($conbem == true) {
    print "<h3 align=center>The email address: ".$conbemady." has invalid characters and could not be saved. All other changes were saved.</h3>";
    $conben = false;
}
?>
<input type="hidden" name="nosave" id="nosave" value="0">
<input type="hidden" name="curuid" id="curuid" value="<?php print $cuser->gsv("cuid") ;?>">
<input type="hidden" name="curconid" id="curconid" value="">
<input type="hidden" name="curuidia" id="curuidia" value="0">
<!--<input type="hidden" name="curuidia" id="curuidia" value="<?php if($cuser->gsv("isadmin")==1) {print "1";}else{print "0";} ?>">-->
<!--<input type="hidden" name="curenteditstate" id="curenteditstate" value="<?php print $curenteditstate ;?>">-->

  <table border="1" width="100%">
    <tr>

      <td width="18%" valign="top" align="middle" nowrap>
      <input type="checkbox" id="grpmode" name="grpmode" language="javascript" onclick="grpmode_onclick();">
      <label for="grpmode">Group Selection Mode</label>
      <hr>
      <b>My Groups</b><br>
      <select size="8" tabindex="1" id="grplist" name="grplist" style="WIDTH: 170px" LANGUAGE=javascript onchange="return grplist_onchange()">
<?php

    if($cuser->gsv("isadmin")==1 && $curenteditstate=="1") {

        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con_grp order by gpname";
        $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    }else{

        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$cuser->gsv("cuid")." order by gpname";
        $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    }


    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        if($row["shared"]==1) {
            $sharedtext = "*";
        } else {
            $sharedtext = "&nbsp;";
        }

	print "        <option id=\"grp-".$row["congpid"]."\" ";
        print "value = \"".$row["congpid"]."|".$row["shared"]."|".$row["gpname"]."|".$row["uid"]."\">".$sharedtext.$row["gpname"]."</option>\n";
     }

     mysql_free_result($query1);

?>      </select><br>
        Shared: <SELECT id="grpshare" style="WIDTH: 100px" name="grpshare">
        <OPTION value="0">No</OPTION>
        <OPTION value="1">Yes</OPTION>
        </SELECT><br>
        <INPUT type="button" value="New" id="newcongp" name="newcongp" LANGUAGE=javascript onclick="return newcongp_onclick()">
        &nbsp;
        <INPUT type="button" value="Save" id="editcongp" name="editcongp" LANGUAGE=javascript onclick="return editcongp_onclick()">
        &nbsp;
        <INPUT type="button" value="Delete" id="delcongp" name="delcongp" LANGUAGE=javascript onclick="return delcongp_onclick()">
        <br>
        Grp Name:<INPUT type="text" value="" id="gpedit" name="gpedit" size="20">
        <hr>
        <b>Shared Groups</b><br>
      <select size="6" tabindex="1" id="sharedgrplist" name="sharedgrplist" style="WIDTH: 170px" LANGUAGE=javascript onchange="return sharedgrplist_onchange()">
<?php

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where uid <> ".$cuser->gsv("cuid")." and shared = 1 order by gpname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);

        $sqlstr = "select uname,email from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["uid"];
        $query2 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row2 = @mysql_fetch_array($query2);
        $row2 = gmqfix($row2,1);
        $owneruname = $row2["uname"]."|".$row2["email"];
        mysql_free_result($query2);
	print "        <option id=\"grp-".$row["congpid"]."\" ";
        print "value = \"".$owneruname."\">**".$row["gpname"]."</option>\n";
     }
     mysql_free_result($query1);
?>      </select><br>
<table border="0" width="100%">
<tr>
<td align="left" id="grpowner">
Owner:&nbsp;
</td>
</tr></table>
      </td>


      <td width="18%" valign="top" align="middle" nowrap>
      <input type="checkbox" id="conmode" name="conmode" checked language="javascript" onclick="conmode_onclick();">
      <label for="conmode">Contact Selection Mode</label>
      <hr>
      <b>Contacts</b><br>
      <select multiple size="18" tabindex="1" id="conlist" name="conlist" style="WIDTH: 170px" LANGUAGE=javascript onchange="return conlist_onchange()">
<?php
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con where uid = ".$cuser->gsv("cuid")." or shared = 1 order by lname,fname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        
        #$xcontz = (abs($row["tzos"]) / 60 / 60) + (abs($cuser->gsv("servertz")) / 60 / 60);
        #if($xcontz < 0) {
        #    $xcontz = "-".$xcontz;
        #} else {
        #    $xcontz = "+".$xcontz;
        #}
        
        $xcontz = $row["tzos"];

        if($row["shared"] == 1 && $row["uid"] == $cuser->gsv("cuid")) {
            $sharedtxt = "&nbsp;*";
        } elseif($row["shared"] == 1)  {
            $sharedtxt = "**";
        } else {
            $sharedtxt = "&nbsp;&nbsp;";
        }
        if($row["uid"] != $cuser->gsv("cuid")) {
            $sqlstr = "select uname,email from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["uid"];
            $query2 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = @mysql_fetch_array($query2);
            $row2 = gmqfix($row2,1);
            $owneruname = $row2["uname"]."|".$row2["email"];
            mysql_free_result($query2);
        } else {
            $owneruname = $cuser->gsv("uname")."|";
        }
	print "        <option id=\"con-".$row["conid"]."\" ";
        print "value = \"".$row["uid"]."|".$row["conid"]."|".$row["shared"]."|".$row["fname"]."|".$row["lname"]."|".$row["email"]."|".$row["bday"]."|".$xcontz."|".$row["tel1"]."|".$row["tel2"]."|".$row["tel3"]."|".$row["fax"]."|".$row["address"]."|".$owneruname."|".$row["emailtype"]."\">".$sharedtxt.$row["fname"]." ".$row["lname"]."</option>\n";

     }
     mysql_free_result($query1);

?>      </select><br>
        <input type="button" title="Click this button to save the selected Group/Contact association" value="Save association"  id="savegrpcon" name="savegrpcon" LANGUAGE=javascript onclick="return savegrpcon_onclick()"><br>
        <input type="checkbox" id="assmode" name="assmode" LANGUAGE="javascript" onclick="return assmode_onclick()">
        <label for="assmode">Association Mode</label>
      </td>

      <td rowspan="2" width="64%" valign="top" align="left" nowrap>
      <br>
          <table border="0" width="100%">
            <tr>
              <td width="14%" valign="top" align="right" nowrap>First Name:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="3" name="confname" id="confname" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Last Name:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="4" name="conlname" id="conlname" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>E-Mail:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="5" name="conemail" id="conemail" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>E-Mail Type:</td>
              <td width="86%" valign="top" align="left" nowrap>
            <select disabled size="1" name="conemailtype" id="conemailtype" style="width: 200">
            <option value="HTML">HTML</option>
            <option value="TEXT">Text</option>
            <option value="SMS">SMS</option>
            </select>
              </td>
            </tr>

            <tr>
              <td width="14%" valign="top" align="right" nowrap>Birthday:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="6" name="conbday" id="conbday" size="30" >
              </td>
            </tr>

            <tr>
              <td width="14%" valign="top" align="right" nowrap>Time Zone Offset from GMT:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="7" name="contzos" id="contzos" size="30" >
              </td>
            </tr>

            <tr>
              <td width="14%" valign="top" align="right" nowrap>Telephone 1:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="8" name="contel1" id="contel1" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Telephone 2:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="9" name="contel2" id="contel2" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Telephone 3:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="10" name="contel3" id="contel3" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Fax:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <input disabled tabindex="11" name="confax" id="confax" size="30" >
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Address:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <TEXTAREA disabled tabindex="12" id="conadr" name="conadr" rows="6" cols="30">
              </TEXTAREA>
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Shared:</td>
              <td width="86%" valign="top" align="left" nowrap>
              <SELECT disabled tabindex="13" id="conshare" style="WIDTH: 100px" name="conshare">
              <OPTION value="0">No</OPTION>
              <OPTION value="1">Yes</OPTION>
              </SELECT>&nbsp;&nbsp;Set this to Yes, to share this contact with other users.
              </td>
            </tr>
            <tr>
              <td width="14%" valign="top" align="right" nowrap>Owned by user:</td>
              <td id="tdowner" width="86%" valign="top" align="left" nowrap>
              &nbsp;
              </td>
            </tr>
          </table><br>
          <b>Note: If you are not sure what the contacts Time Zone is, then leave it set to yours.<br>
          The Servers Time Zone Offset from GMT is: <?php print $xdservertz; ?><br>
          Your Time Zone Offset from the Server is: <?php print $xdadjtz; ?>
          </b>
          <br><br>

            <table border="1" width="60%">
            <tr>
              <td width="12%" align="middle">
              <INPUT type="button" tabindex="15" value="Copy Contact" id="copycon" name="copycon" LANGUAGE=javascript onclick="return copycon_onclick()">
              </td>
              <td width="12%" align="middle">
              <INPUT type="button" tabindex="15" value="New Contact" id="newcon" name="newcon" LANGUAGE=javascript onclick="return newcon_onclick()">
              </td>
              <td width="12%" align="middle">
          <div id="divsavecon" style="display: none">
              <INPUT type="button" tabindex="16" value="Save Contact" id="savecon" name="savecon" LANGUAGE=javascript onclick="return savecon_onclick()">
          </div>
          <div id="diveditcon" style="display: inline">
              <INPUT type="button" tabindex="16" value="Edit Contact" id="editcon" name="editcon" LANGUAGE=javascript onclick="return editcon_onclick()">
          </div>
              </td>
              <td width="12%" align="middle">
          <div id="divdelcon" style="display: inline">
              <INPUT type="button" tabindex="17" value="Delete Contact" id="deletecon" name="deletecon" LANGUAGE=javascript onclick="return deletecon_onclick()">
          </div>
          <div id="divcannewcon" style="display: none">
              <INPUT type="button" tabindex="18" value="Cancel" id="cancelnewcon" name="cancelnewcon" LANGUAGE=javascript onclick="return cancelnewcon_onclick()">
          </div>
              </td>
              <td width="12%" align="middle">
              <INPUT type="button" tabindex="19" value="Done" id="donecon" name="donecon" LANGUAGE=javascript onclick="return donecon_onclick()">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
    <td colspan="2" align="left">
*  denotes a group/contact you are sharring with other users.<br>
** denotes a group/contact other users are sharring with you.<br><br>

    You cannot change shared contacts or groups from other users.
    You can however, add shared contacts to your groups.<br>
    In Contact Selection Mode, you can add multiple contacts to a single group.<br>
    In Group Selection Mode, you can and a single contact to multiple groups.<br>
    Use Association mode to select the contacts/Groups you want to associate.
    When not in Association mode, clicking a group or contact will display current
    associations of the clicked item.
    </td>
    </tr>
  </table>

<!-- begin hidden fields -->
<!-- contact groups -->

<?php

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con where uid = ".$cuser->gsv("cuid")." or shared = 1 order by lname,fname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {

        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_congrp_link where conid = ".$row["conid"]." order by conid";
        $query2 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Link Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $havegp = 0;
        $gpcode = "";
        while($row1 = @mysql_fetch_array($query2)) {
            if($havegp == 1) {
                $gpcode .= "|".$row1["congpid"];
            } else {
                $gpcode .= $row1["congpid"];
            }
            $havegp = 1;
         }
         print "<INPUT type=\"hidden\" value=\"".$gpcode."\" id=\"conlnk-".$row["conid"]."\">\n";
         mysql_free_result($query2);
    }
    mysql_free_result($query1);
?>

<!-- group contacts-->

<?php

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$cuser->gsv("cuid")." or shared = 1 order by gpname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {

        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_congrp_link where congpid = ".$row["congpid"];
        $query2 = mysql_query($sqlstr) or die("Cannot query User Contact Groups Link Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $havegp = 0;
        $gpcode = "";
        while($row1 = @mysql_fetch_array($query2)) {
            if($havegp == 1) {
                $gpcode .= "|".$row1["conid"];
            } else {
                $gpcode .= $row1["conid"];
            }
            $havegp = 1;
         }
         print "<INPUT type=\"hidden\" value=\"".$gpcode."\" id=\"gplnk-".$row["congpid"]."\">\n";
         mysql_free_result($query2);
    }
    mysql_free_result($query1);
?>
