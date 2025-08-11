<?php

require_once("./include/config.php");

$sqlstr = "select count(*) as keysum from $gutab where regkey = '".$_GET["xrkey"]."'";
$query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$row = mysql_fetch_array($query1) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
@mysql_free_result($query1);

if($row["keysum"] > 0 && strlen($_GET["xrkey"]) > 0) {

    $sqlstr = "select * from $gutab where regkey = '".$_GET["xrkey"]."'";
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
    <title><?php print $GLOBALS["sitetitle"]; ?> - New Password Granted</title>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

function gologon() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>?gologinform=1";
    location.href=xurl;
}

function gocalpvbut() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>";
    location.href=xurl;
}
//-->
</SCRIPT>

    </head>

    <body <?php print $GLOBALS["sysbodystyle"]; ?>>
    <?php

    if($row["newpw"]==1) {

        $tcurpw = $row["pw"];


        $chars = array(
            "a","A","b","B","c","C","d","D","e","E","f","F","g","G","h","H","i","I","j","J",
            "k","K","l","L","m","M","n","N","o","O","p","P","q","Q","r","R","s","S","t","T",
            "u","U","v","V","w","W","x","X","y","Y","z","Z","1","2","3","4","5","6","7","8",
            "9","0"
            );

        $max_elements = count($chars) - 1;
        srand((double)microtime()*1000000);
        $newpw = $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw .= $chars[rand(0,$max_elements)];
        $newpw_enc = md5($newpw);

        $sqlstr = "update ".$tabpre."_user_reg set pw = '".$newpw_enc."', newpw=0 where regkey = '".$_GET["xrkey"]."'";
        mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $regmail = new htmlMimeMail();

        $regmbody="<HTML><BODY>Hello ".$row["fname"]." ".$row["lname"].",<br><br>Here is your new password for your CaLogic user account running at
        ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") <br><br>
        $newpw
        <br><br>You should logon and change your password as soon as possible.<br><br>
        Thank you.<br><br>".$GLOBALS["siteowner"]."<br></body></html>";

        $regmtext="Hello ".$row["fname"]." ".$row["lname"].",\n\nHere is your new password for your CaLogic user account running at
        ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\n
        $newpw
        \n\nYou shold logon and change your password as soon as possible.\n\n
        Thank you.\n\n".$GLOBALS["siteowner"]."\n\n";

        $regmsms="Here is your new CaLogic password\n
        $newpw
        \n\nLogon and change your password soon.\n\n
        Thank you.";


        $regsub = "CaLogic Password Request Confirmation";
        $siteowner=$GLOBALS["siteowner"];
        $adminemail=$GLOBALS["adminemail"];

/*
        if($GLOBALS["mailastext"]==0) {
            $regmail->setHtml($regmbody, $regmtext);
        } else {
            $regmail->setText($regmtext);
        }
*/
        if($row["emailtype"]=="HTML") {
            $regmail->setHtml($regmbody, $regmtext);
        } elseif($row["emailtype"]=="TEXT") {
            $regmail->setText($regmtext);
        } else {
            $regmail->setText($regmsms);
        }


        $regmail->setSubject($regsub);

        if($GLOBALS["uniem"] == 1) {
            $toadr=$fields["fname"]." ".$fields["lname"]." <$email>";
            $fromadr="$siteowner <$adminemail>";
        } else {
            $toadr="$email";
            $fromadr="$adminemail";
        }

        $regmail->setFrom($fromadr);

        if($GLOBALS["mailtype"]=="sendmail") {
            $result = $regmail->send(array($toadr));
        } else {
            if(strlen($GLOBALS["smtpuser"])>0) {
                $emauth = true;
                $emuser = $GLOBALS["smtpuser"];
                $empass = $GLOBALS["smtppass"];
            } else {
                $emauth=false;
                $emuser = "";
                $empass = "";
            }

            $regmail->setSMTPParams($GLOBALS["smtphost"],$GLOBALS["smtpport"],$emauth,$emuser,$empass);
            $result = $regmail->send(array($toadr),'smtp');
        }
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

            $emsub = "System email - CaLogic User Password Request Confirmation";
            $embody="<HTML><BODY>A user has just confirmed a Password Request<br><br>User: ".$row["fname"]." ".$row["lname"]."</body></html>";
            $emtext="A user has just confirmed a Password Request\n\nUser: ".$row["fname"]." ".$row["lname"];
            sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
        }

        $logentry["uid"] = $row["uid"];
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "User requested new password confirmed: ".$row["fname"]." ".$row["lname"];
        $logentry["lbefore"] = " ";
        $logentry["lafter"] = " ";
        $logentry["remarks"] = " ";
        histlog($logentry);

        $logentry["uid"] =  $row["uid"];
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "New password set";
        $logentry["lbefore"] = $tcurpw;
        $logentry["lafter"] = " ";
        $logentry["remarks"] = " ";
        histlog($logentry);

        print "<br>
        You have been given a new password.<br><br>
        An E-Mail has been sent to you with the new password. Your old password is no longer valid.<br><br>";
    } else {
        print "<br>
        You have already been given a new password.<br><br>
        If you have forgotten again, you must make a seperate Pasword Request.<br><br>";
    }

} else {

?>
<?php
print $GLOBALS["htmldoctype"];
?>
    <html>
    <head>
    <title>New Password Grant Problem</title>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--
function gologon() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>?gologinform=1";
    location.href=xurl;
}

function gocalpvbut() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>";
    location.href=xurl;
}
//-->
</SCRIPT>

    </head>

    <body <?php print $GLOBALS["sysbodystyle"]; ?>>
    <br>
    <form name="manreg" method="post" action="confirmnewpw.php">
There is a problem locating your confirmation key.<br><br>
Please cut and paste the confirmation key that was sent to you into the following field, then click submit.<br><br>
<input name="xrkey" size="50"><br><br><input type="submit" value="Submit" name="subreg"><br><br><br>
<?php
    print "If this problem continues, please email the following info to the site admin at:<br>".$adminemail;
    print "<br><br>Debug info:<br>Key: ".$_GET["xrkey"]."<br>Row Count: ".$row["keysum"]."<br>SQL: ".$sqlstr;

}
?>
&nbsp;&nbsp;&nbsp;<input type="button" value="goto logon screen" name="blogon" id=blogon LANGUAGE=javascript onclick="gologon()">
  <?php
  if($GLOBALS["publicview"] == true ) {
    ?>
  &nbsp;&nbsp;&nbsp;<input type="button" value="Go to Calendar" name="gocalpvbut" id="gocalpvbut" LANGUAGE="javascript" onclick="return gocalpvbut()">
    <?php
  }

print "<br><br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");

?>


