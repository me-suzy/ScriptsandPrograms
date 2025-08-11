<?php
if($user->gsv("isadmin")==1) {
?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<meta HTTP-EQUIV="Expires" CONTENT="0">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>CaLogic Backup</title>
<script id="clientEventHandlersJS" language="javascript">
<!--
function window_onload() {
/*
    tvar = window.dialogArguments;
    jobdone.scrollIntoView();
    jobdone.focus();
    window.scrollBy(0, 600);
*/
}

function jobdone_onclick() {
    window.returnValue = "1";
    window.close();
}

//-->
</script>
</head>
<body LANGUAGE="javascript" onload="return window_onload()" <?php print $GLOBALS["sysbodystyle"]; ?>>
<h1>CaLogic - Database Backup</h1>
<br>
<h3>Please wait while the database gets saved...</h3>
<br><br>
<?php

flush();
usleep(25);

include_once($GLOBALS["CLPath"]."/include/config.php");
include_once($GLOBALS["CLPath"]."/classes/cl_backup.php");

#mysql_connect("$dbhost","$dbuser","$dbpass") OR DIE("Couldn`t connect to MySQL server in the DBLOADER!");

if ($cmptype == 1) {
    $cmptype = true;
} else {
    $cmptype = false;
}

if ($tabtype == 1) {
    $tabtype = true;
} else {
    $tabtype = false;
}

if ($strtype == 1) {
    $strtype = false;
} else {
    $strtype = true;
}

if ($dlntype == 1) {
    $dlntype = true;
} else {
    $dlntype = false;
}

if ($fmttype == 1) {
    $fmttype = true;
} else {
    $fmttype = false;
}

$clbackup = new iam_backup($dlntype, $strtype, "$dbhost", "$dbname", "$dbuser", "$dbpass", $GLOBALS["CLPath"]."/$filename", $tabtype, $cmptype, $fmttype);
$clbackup->perform_backup();

$logentry["uid"] = $user->gsv("cuid");
$logentry["calid"] = "0";
$logentry["evid"] = "0";
$logentry["adate"] = time();
$logentry["laction"] = "Database backed up";
$logentry["lbefore"] = " ";
$logentry["lafter"] = " ";
$logentry["remarks"] = "Backup file: ".$filename;
histlog($logentry);

print "<br><br><b>Job finished.</b><br><br>";
if($dlntype == true) {
    print "<a id=\"dnldfile\" href=\"".$filename."\" target=\_blank\">Click here to download the file</a>&nbsp;&nbsp;&nbsp;";
}
print "<INPUT type=\"button\" value=\"Close Window\" ID=\"jobdone\" NAME=\"jobdone\" onclick=\"return jobdone_onclick()\">";
print "<br><br>";
?>
</body>
</html>
<?php
}
?>
