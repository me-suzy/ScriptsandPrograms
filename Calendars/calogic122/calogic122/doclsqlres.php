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
<title>CaLogic Restore</title>
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
<h1>CaLogic - Database Restore</h1>
<br>
<h3>Please wait while the database gets restored...</h3>
<br><br>
<?php

flush();
usleep(25);

include_once($GLOBALS["CLPath"]."/include/config.php");

#function iam_restore($filename, $host, $dbname, $dbuser, $dbpass)

#$clbackup = new iam_restore("$filename", "$dbhost", "$dbname", "$dbuser", "$dbpass");

$curbtime = time();
$curresfile = "tmp_".strftime("%Y",$curbtime).strftime("%m",$curbtime).strftime("%d",$curbtime)."_".strftime("%H",$curbtime).strftime("%M",$curbtime).strftime("%S",$curbtime);


if ( !$file = gzopen($GLOBALS["CLPath"]."/$filename","rb") ) {
    print "could not open backup file.";
    exit();
}

if ( !$tfile = fopen($GLOBALS["CLPath"]."/$curresfile","w") ) {
    print "could not create temp restore file.";
    exit();
}

while (!gzeof( $file ) ) {
    $line = gzgets( $file, 1024 );
    if ( fwrite($tfile,$line) == -1 ) {
        print "could not write to temp restore file.";
        gzclose($file);
        fclose($tfile);
        exit();
    }
}

gzclose($file);
fclose($tfile);

include($GLOBALS["CLPath"]."/$curresfile");

print "<br><br><b>Job finished.</b><br><br>";
print "<INPUT type=\"button\" value=\"Close Window\" ID=\"jobdone\" NAME=\"jobdone\" onclick=\"return jobdone_onclick()\">";
print "<br><br>";

@unlink($GLOBALS["CLPath"]."/$curresfile");

$logentry["uid"] = $user->gsv("cuid");
$logentry["calid"] = "0";
$logentry["evid"] = "0";
$logentry["adate"] = time();
$logentry["laction"] = "Database restored";
$logentry["lbefore"] = " ";
$logentry["lafter"] = " ";
$logentry["remarks"] = "Backup file: ".$filename;
histlog($logentry);

?>
</body>
</html>
<?php
}
?>
