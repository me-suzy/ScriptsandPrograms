<?php
if($user->gsv("isadmin")==1 || $GLOBALS["demomode"]==1) {

    $nextrec = $record + 100;
    $prevrec = $record - 100;
    if($prevrec < 0) {
        $prevrec = 0;
    }

    $rowcolor1="#DDDDDD";
    $rowcolor2="#CCCCCC";
    $rcnt=0;

?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<meta HTTP-EQUIV="Expires" CONTENT="0">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>CaLogic History Log View</title>
<script id="clientEventHandlersJS" language="javascript">
<!--
function window_onload() {

}

function prevblock_onclick() {
    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=histlog&histlog=1&record=<?php print $prevrec; ?>";
    document.location.href=xurl;
}

function nextblock_onclick() {
    var xurl = "<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=histlog&histlog=1&record=<?php print $nextrec; ?>";
    document.location.href=xurl;
}

function donehist_onclick() {
    var xurl = "<?php print $GLOBALS["idxfile"]; ?>";
    document.location.href=xurl;
}


//-->
</script>

</head>
<body LANGUAGE="javascript" onload="return window_onload()" <?php print $GLOBALS["calbodystyle"]; ?> >
<h2>CaLogic - History Log View</h2>
<br>
  <table border="0" width="100%">
  <tr>
    <td width="33%" align="middle">
    <INPUT type="button" value="Previous block" id="prevblock" name="prevblock" language="javascript" onclick="prevblock_onclick()">
    </td>
    <td width="33%" align="middle">
    <INPUT type="button" value="Next block" id="nextblock" name="nextblock" language="javascript" onclick="nextblock_onclick()">
    </td>
    <td width="34%" align="middle">&nbsp;
    <INPUT type="button" value="Go to Calendar" id="donehist" name="donehist" language="javascript" onclick="donehist_onclick()">
    </td>
  </tr>
</table>
<br>
<table border="1" CELLSPACING="1" CELLPADDING="2">
<?php

    $rcnt++;
    $bgcolor = ($rcnt % 2) ? $rowcolor1 : $rowcolor2;

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_log order by hlid desc limit ".$record.",100";
    $query1 = mysql_query($sqlstr) or die("Cannot query history log table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        #mqfix($row,1);
        $histuser = "NA";
        $histcal = "NA";
        $histevent = "NA";
        $histrem = "&nbsp;";

        if($curcalcfg["timetype"]==1) {

#            $txmon = date("j",$row["hldate"]);
#            $txmon = $monthtext[$txmon];
#            $histdate = date("d",$row["hldate"]).".".$txmon.".".date("Y H:i:s",$row["hldate"]);
            $histdate = date("d.m.Y H:i:s",$row["hldate"]);

#            $txmon = date("j",$row["adate"]);
#            $txmon = $monthtext[$txmon];
#            $histadate = date("d",$row["adate"]).".".$txmon.".".date("Y H:i:s",$row["adate"]);
            $histadate = date("d.m.Y H:i:s",$row["adate"]);


        } else {
#            $txmon = date("j",$row["hldate"]);
#            $txmon = $monthtext[$txmon];
#            $histdate = date("d",$row["hldate"]).".".$txmon.".".date("Y h:i:s a",$row["hldate"]);
            $histdate = date("d.m.Y h:i:s a",$row["hldate"]);

#            $txmon = date("j",$row["adate"]);
#            $txmon = $monthtext[$txmon];
#            $histadate = date("d",$row["adate"]).".".$txmon.".".date("Y h:i:s a",$row["adate"]);
            $histadate = date("d.m.Y h:i:s a",$row["adate"]);
        }

        $histaction = $row["laction"];

        if($row["uid"] != 0) {
            $sqlstr = "select uname from ".$GLOBALS["tabpre"]."_user_reg where uid=".$row["uid"];
            $query2 = mysql_query($sqlstr) or die("Cannot query user reg table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            while($row2 = mysql_fetch_array($query2)) {
                $row2 = gmqfix($row2,1);
	        #mqfix($row2,1);
                $histuser = $row2["uname"];
                break;
            }
            @mysql_free_result($query2);
        }

        if($row["calid"] != 0) {
            $sqlstr = "select calname from ".$GLOBALS["tabpre"]."_cal_ini where calid='".$row["calid"]."'";
            $query2 = mysql_query($sqlstr) or die("Cannot query calendar ini table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            while($row2 = mysql_fetch_array($query2)) {
                $row2 = gmqfix($row2,1);
	        #mqfix($row2,1);
                $histcal = $row2["calname"];
                break;
            }
            @mysql_free_result($query2);
        }

        if($row["evid"] != 0) {
            $sqlstr = "select title from ".$GLOBALS["tabpre"]."_cal_events where evid=".$row["evid"];
            $query2 = mysql_query($sqlstr) or die("Cannot query calendar ini table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            while($row2 = mysql_fetch_array($query2)) {
                $row2 = gmqfix($row2,1);
	        #mqfix($row2,1);
                $histevent = $row2["title"];
                break;
            }
            @mysql_free_result($query2);
        }

if(($rcnt % 20) == 0 || $rcnt ==1) {

?>

      <tr bgcolor="<?php echo $bgcolor; ?>">
        <th nowrap width="10%" align="left">User</th>
        <th nowrap width="10%" align="left">Calendar</th>
        <th nowrap width="10%" align="left">Event Titel</th>
        <th nowrap width="10%" align="left">Log Date</th>
        <th nowrap width="10%" align="left">Action Date</th>
        <th nowrap width="10%" align="left">Action</th>
        <th nowrap width="40%" align="left">Remarks</th>
      </tr>
<?php

    $rcnt++;
    $bgcolor = ($rcnt % 2) ? $rowcolor1 : $rowcolor2;

}

?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
        <td nowrap width="10%" align="left"><?php print $histuser; ?></td>
        <td nowrap width="10%" align="left"><?php print $histcal; ?></td>
        <td nowrap width="10%" align="left"><?php print $histevent; ?></td>
        <td nowrap width="10%" align="left"><?php print $histdate; ?></td>
        <td nowrap width="10%" align="left"><?php print $histadate; ?></td>
        <td nowrap width="10%" align="left"><?php print $histaction; ?></td>
        <td width="40%" align="left"><?php print $histrem; ?></td>
      </tr>
<?php

    $rcnt++;
    $bgcolor = ($rcnt % 2) ? $rowcolor1 : $rowcolor2;

    }
    @mysql_free_result($query1);
?>
</table>
<br>
  <table border="0" width="100%">
  <tr>
    <td width="33%" align="middle">
    <INPUT type="button" value="Previous block" id="prevblock" name="prevblock" language="javascript" onclick="prevblock_onclick()">
    </td>
    <td width="33%" align="middle">
    <INPUT type="button" value="Next block" id="nextblock" name="nextblock" language="javascript" onclick="nextblock_onclick()">
    </td>
    <td width="34%" align="middle">&nbsp;
    <INPUT type="button" value="Go to Calendar" id="donehist" name="donehist" language="javascript" onclick="donehist_onclick()">
    </td>
  </tr>
</table>
<br>
</body>
</html>
<?php
} else {
?>
<?php
print $GLOBALS["htmldoctype"];
?>

<html>
<head>
<meta HTTP-EQUIV="Expires" CONTENT="0">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>CaLogic History Log View</title>
</head>
<body <?php print $GLOBALS["calbodystyle"]; ?> >
<h3>not authorized</h3>
</body>
</html>

<?php
}
?>
