<?php
global $user,$langcfg;

print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<title>Standard Default Calendar Select</title>
<script id="clientEventHandlersJS" language="javascript">
<!--

var retval="";

function mdefcal_onclick() {

    retval = allocalselect.value;
    window.returnValue = retval;
    window.close();
}

function canceldefcalsel_onclick() {
    window.returnValue = "0";
    window.close();

}

function window_onload() {

    window.defaultStatus = "Select a Calendar";
    window.returnValue = "0";

}

//-->
</script>

</head>
<body margin="10" language="javascript" onload="window_onload()" <?php print $GLOBALS["sysbodystyle"]; ?>>
<?php

if($user->gsv("isadmin")=="1") {?>

        <b>Standard Default Calendar Option</b><br>
        When this option is enabled, new users will not be able to create a calendar. Instead, they will
        be assigned the calendar that you select here. Only Public and Open calendars can be selected.<br><br>
        Select a calendar to make the Standard Default, then click GO.<br><br>
        <select size="1" id="allocalselect" name="allocalselect" style="WIDTH: 150px">
        <?php
                 $haveallothercals = 0;
                 $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where userid > 0 and caltype < 2 order by calname";
                 $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                 while($row = mysql_fetch_array($query1)) {
                     $row = gmqfix($row,1);
                     #mqfix($row,1);
                     $haveallothercals = 1;
                     print "<option ";
                     if($GLOBALS["defaultcalid"] == $row["calid"]) {
                         print " selected ";
                     }
                     print "value=\"".$row["calid"]."|".$row["calname"]."\">".$row["calname"]."</option>\n";
                 }
                mysql_free_result($query1);

        ?>
    </select>&nbsp;<input type="button" value="<?php print $langcfg["butgo"]; ?>" name="goallocalselect" LANGUAGE=javascript onclick="return mdefcal_onclick()">&nbsp;&nbsp;<input language="javascript" onclick="canceldefcalsel_onclick()" type="button" value = "Cancel" id="canceldefcalsel" name="canceldefcalsel">
    <br><br>
    Enabling this option will also automatically turn off the "user can customize" and "Display Calendar Pulldown options of CaLogic. Administrators however, will still be able to see and use these disabled options.

<?php
} else {
    print "<h3>You are not the admin!</h3>";
}
?>
