<?php

require_once("./include/config.php");

$sqlstr = "select count(*) as keysum from ".$GLOBALS["tabpre"]."_cal_event_rems where confirmkey = '$xrkey'";
$query1 = mysql_query($sqlstr) or die("Cannot query Event Reminders Table <br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$row = mysql_fetch_array($query1) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

if($row["keysum"] > 0) {

    @mysql_free_result($query1);

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where confirmkey = '$xrkey'";
    $query1 = mysql_query($sqlstr) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $row = mysql_fetch_array($query1) or die("Cannot query Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row = gmqfix($row);
    #mqfix($row,1);

    $wptitle = "Event Reminder Subscription Confirmation";

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

    if ($row["confirmed"]==1) {
//        print sprintf(translate("rereg",$row["langid"]),$GLOBALS["idxfile"]);


        print "<br><h3>Your Event Reminder Subscription has already been confirmed.<br><br>
        <a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."\">Click here to start CaLogic</a></h3><br><br><br>";


    } else {

        $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_event_rems set confirmed = 1 where confirmkey = '$xrkey'";
        $query2 = mysql_query($sqlstr) or die("Cannot update Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        print "<br><h3>Your Event Reminder Subscription is now confirmed.<br>
        <a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."\">Click here to start CaLogic</a></h3>";

        $logentry["uid"] = "0";
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "Event Reminder Subscription confirmed.";
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
    <title>Event Reminder Subscription problem</title>
    </head>

    <body <?php print $GLOBALS["sysbodystyle"]; ?>>
    <br>
    <form name="manreg" method="post" action="confirmsub.php">
There is a problem locating your subscription key.<br><br>
Please cut and paste the subscription key that was sent to you into the following field, then click submit.<br><br>
<input name="xrkey" size="50"><br><br><input type="submit" value="Submit" name="confsub"><br><br><br>
<?php
    print "If this problem continues, please email the following info to the site admin at:<br>".$adminemail;
    print "<br><br>Event Subscribe Debug info:<br>Key: ".$xrkey."<br>Row Count: ".$row["keysum"]."<br>SQL: ".$sqlstr;

}
print "<br><br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");

?>


