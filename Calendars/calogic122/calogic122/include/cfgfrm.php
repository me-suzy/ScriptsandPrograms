<?php

    $rowcolor1="#DDDDDD";
    $rowcolor2="#CCCCCC";
    $rcnt=0;
?>
    <input type="hidden" name="setup_step" value="3">
    <input type="hidden" name="curpubview" value="<?php echo $publicview; ?>">
    <table border="1" width="100%">
<?php
    $rcnt++;
    $bgcolor = ($rcnt % 2) ? $rowcolor1 : $rowcolor2;
?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
        <th width="23%" align="left">Field</th>
        <th width="22%" align="left">Entry</th>
        <th width="55%" align="left">Remark</th>
      </tr>
<?php


for($x=0;$x<$fieldcnt;$x++) {
    $rcnt++;
    $bgcolor = ($rcnt % 2) ? $rowcolor1 : $rowcolor2;

    if($setuptab[$x][1]=="tabhead") {
        ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">

        <td colspan="3" valign="top" align="left">
        <?php echo $setuptab[$x][2]; ?>
        </td>
        </tr>
        <?php
    } else {
#        $tvarxname = $setuptab[$x][1];

        #if($setuptab[$x][7]<2) {
            ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
            <td width="23%" valign="top" align="left"><?php echo $setuptab[$x][3]; ?></td>
            <td width="22%" valign="top" align="left">
            <?php

            if($setuptab[$x][7]>0) {
                if($setuptab[$x][1]=="defaultcalid" || $setuptab[$x][1]=="defaultcalname" ) {
                    $enabtxt = " readonly ";
                } else {
                    $enabtxt = " readonly ";
                }
            } else {
                $enabtxt = "";
            }
            if($setuptab[$x][5]==0) {
                if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
                    if(($setuptab[$x][1] != "calogic_uid") && ($setuptab[$x][1] != "smtppass") && ($setuptab[$x][1] != "smtpport") && ($setuptab[$x][1] != "smtphost") && ($setuptab[$x][1] != "smtpuser")) {

                ?>
                        <input <?php echo $enabtxt; ?> type="text" size="31" id="<?php echo $setuptab[$x][1]; ?>" name="fields[<?php echo $setuptab[$x][1]; ?>]" value="<?php print ${$setuptab[$x][1]}; ?>" >
                <?php
                    } else {
                        print "hidden in demo mode";
                    }
                } else {
                ?>
                        <input <?php echo $enabtxt; ?> type="text" size="31" id="<?php echo $setuptab[$x][1]; ?>" name="fields[<?php echo $setuptab[$x][1]; ?>]" value="<?php print ${$setuptab[$x][1]}; ?>" >
                <?php
                }

            } else {

                print "<select language=\"javascript\" onchange=\"selcheck('".$setuptab[$x][1]."')\" id=\"".$setuptab[$x][1]."\" $enabtxt size=\"1\" id=\"".$setuptab[$x][1]."\" name=\"fields[".$setuptab[$x][1]."]\">";

                $tempar = $setuptab[$x][6];
                foreach($tempar as $k1 => $v1) {

                    echo "<option value=\"".$tempar[$k1][0]."\"";
                    if(${$setuptab[$x][1]} == $tempar[$k1][0]) {
                        print " selected ";
                    }
                    print ">".$tempar[$k1][1]."</option>\n";
                }

                print "</select>\n";
            }
            ?>
            </td>
            <td width="55%" valign="top" align="left"><?php echo $setuptab[$x][4]; ?></td>
            </tr>
            <?php
        #}
    }
}
?>
<tr bgcolor="<?php echo $bgcolor; ?>">
