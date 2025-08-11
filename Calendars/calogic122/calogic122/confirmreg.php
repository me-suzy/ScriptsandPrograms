<?php

require_once("./include/config.php");

$sqlstr = "select count(*) as keysum from $gutab where regkey = '$xrkey'";
$query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$row = mysql_fetch_array($query1) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

if($row["keysum"] > 0) {

    @mysql_free_result($query1);

    $sqlstr = "select * from $gutab where regkey = '$xrkey'";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $row = mysql_fetch_array($query1) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row = gmqfix($row);
    #mqfix($row,1);

    $wptitle = translate("urth",$row["langid"]);

    ?>
<?php
print $GLOBALS["htmldoctype"];
?>

    <html>

    <head>
    <title><?php print $GLOBALS["sitetitle"]; ?> - <?php print $wptitle; ?></title>
    </head>

    <body <?php print $GLOBALS["sysbodystyle"]; ?>>
    <br>
    <?php

    if ($row["emok"]==1) {
//        print sprintf(translate("rereg",$row["langid"]),$GLOBALS["idxfile"]);

        $tstr1 = translate("rereg",$row["langid"]);
        $txstr = $GLOBALS["idxfile"]."?gologinform=1";
        $tstr1 = str_replace("%index%",$txstr,$tstr1);
        print $tstr1;


    } else {

        $conftime = time();
        $sqlstr = "update $gutab set emok=1, conftime=$conftime where regkey = '$xrkey' limit 1";
        $query2 = mysql_query($sqlstr) or die("Cannot update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

//        print sprintf($tstr1,$tstr2,$GLOBALS["idxfile"]);

        $repstr1 = $row["fname"]." ".$row["lname"];
        $tstr1 = translate("regconf",$row["langid"]);
        $txstr = $GLOBALS["idxfile"]."?gologinform=1";
        $tstr1 = str_replace("%index%",$txstr,$tstr1);
        $tstr1 = str_replace("%name%",$repstr1,$tstr1);

        print $tstr1;

        if($GLOBALS["sadmmail"]==1) {
            $siteowner=$GLOBALS["siteowner"];
            $adminemail=$GLOBALS["adminemail"];
            if($GLOBALS["uniem"] == 1) {
                $toadr="CaLogic Administrator <$adminemail>";
                $fromadr="CaLogic web site <$adminemail>";
            } else {
                $toadr="$adminemail";
                $fromadr="$adminemail";
            }

            $emsub = "System email - CaLogic User confirmation";
            $embody="<HTML><BODY>A user has just confirmed the registration<br><br>User: ".$row["fname"]." ".$row["lname"]."</body></html>";
            $emtext="A user has just confirmed the registration\n\nUser: ".$row["fname"]." ".$row["lname"];
            sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
        }

        $logentry["uid"] = $row["uid"];
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "New user registration confirmed, user: ".$row["fname"]." ".$row["lname"];
        $logentry["lbefore"] = " ";
        $logentry["lafter"] = " ";
        $logentry["remarks"] = " ";
        histlog($logentry);

    }
} else {

?>
<?php
print $GLOBALS["htmldoctype"];
?>
    <html>
    <head>
    <title>Registration problem</title>
    </head>

    <body <?php print $GLOBALS["sysbodystyle"]; ?>>
    <br>
    <form name="manreg" method="post" action="confirmreg.php">
There is a problem locating your registration key.<br><br>
Please cut and paste the registration key that was sent to you into the following field, then click submit.<br><br>
<input name="xrkey" size="50"><br><br><input type="submit" value="Submit" name="subreg"><br><br><br>
<?php
    print "If this problem continues, please email the following info to the site admin at:<br>".$adminemail;
    print "<br><br>Debug info:<br>Key: ".$xrkey."<br>Row Count: ".$row["keysum"]."<br>SQL: ".$sqlstr;

}
print "<br><br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");

?>


