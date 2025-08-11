<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

var evwid;
var windowwidth;

function hideselbox() {
return;
    try {
            divselbox.style.display = "none";
            return;
        }
        catch(e) {
            return;
        }

}

function showselbox() {
return;

    try {
            divselbox.style.display = "inline";
            return;
        }
        catch(e) {
            return;
        }

}


function eventclick(eventlink) {
    if(window.event.ctrlKey) {
        eventlink += "&noed=1";
        window.open(eventlink,null,"height=800,width=800,status=yes,menubar=yes,toolbar=yes,resizable=yes,scrollbars=yes,location=no"); //,null,"height=500,width=700,status=yes,menubar=no,location=no");
    } else {
        ///eventlink += "noed=0";
        document.location.href = eventlink;
    }
}

function weeksel_onchange() {
//xurl = "selview.php?viewdate=" + weeksel.value + "&viewtype=Week";
//location.href=xurl;
selweek.submit;
}

function monthsel_onchange() {
//xurl = "selview.php?viewdate=" + monthsel.value + "&viewtype=Month";
//location.href=xurl;
selmonth.submit;
}

function yearsel_onchange() {
//xurl = "selview.php?viewdate=" + yearsel.value + "&viewtype=Year";
//location.href=xurl;
selyear.submit;
}

function ocalselect_onchange() {
//xurl = "selview.php?viewdate=" + weeksel.value + "&viewtype=Week";
//location.href=xurl;
calsel.goocalselect = 1;
goocalselect = 1;
calsel.submit;
}

function window_onload() {
try {
if (document.all) {
//	height = document.body.offsetHeight;
	windowwidth = document.body.offsetWidth;
}
else {
//	height = window.innerHeight;
	windowwidth = document.body.innerWidth;
}
}catch(e) {
}
<?php
if ($viewtype != "Day") {
?>
try {
    if(cvtab.clientWidth > document.body.clientWidth) {
        evwid = Math.round(document.body.clientWidth / 7) - 10;
    } else {
        evwid = Math.round(cvtab.clientWidth / 7) - 10;
    }
    if(evwid < 112) {
        evwid = 112;
    }
    for(i=0;i<esp.length;i++) {
        esp[i].style.width = evwid;
    }
}
catch(e) {

}

<?php
} else {

}
?>

}

function window_onresize() {

try {
if (document.all) {
//	height = document.body.offsetHeight;
	windowwidth = document.body.offsetWidth;
}
else {
//	height = window.innerHeight;
	windowwidth = document.body.innerWidth;
}
}catch(e) {
}
//alert(windowwidth);
if(windowwidth<890) {
    windowwidth=890;
}

<?php
if ($viewtype != "Day") {
?>
try {

    if(cvtab.clientWidth > document.body.clientWidth) {
        evwid = Math.round(document.body.clientWidth / 7) - 10;
    } else {
        evwid = Math.round(cvtab.clientWidth / 7) - 10;
    }
    if(evwid < 112) {
        evwid = 112;
    }
    for(i=0;i<esp.length;i++) {
        esp[i].style.width = evwid;
    }
}
catch(e) {

}

<?php
} else {

}
?>


}

function cvtab_onresize() {
try {
if (document.all) {
//	height = document.body.offsetHeight;
	windowwidth = document.body.offsetWidth;
}
else {
//	height = window.innerHeight;
	windowwidth = document.body.innerWidth;
}
}catch(e) {
}
<?php
if ($viewtype != "Day") {
?>
try {
    if(cvtab.clientWidth > document.body.clientWidth) {
        evwid = Math.round(document.body.clientWidth / 7) - 10;
    } else {
        evwid = Math.round(cvtab.clientWidth / 7) - 10;
    }
    if(evwid < 112) {
        evwid = 112;
    }
    for(i=0;i<esp.length;i++) {
        esp[i].style.width = evwid;
    }
}
catch(e) {

}

<?php
} else {

}
?>

}

function gosfuncs_onclick() {
    if(sfuncs.qjump.value == "printfriend") {
		window.open("<?php print $GLOBALS["idxfile"]; ?>?printfriend=1");
		return false;
    }
}

<?php
if (!$printfriend) {
    if($curcalcfg["pu_functionmenutype"] == 0 || $curcalcfg["pu_functionmenutype"] == 2) {
        include($GLOBALS["CLPath"]."/include/slidemenu.php");
    }
}
?>
//-->
</SCRIPT>


