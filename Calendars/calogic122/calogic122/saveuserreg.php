<?php

include("./include/config.php");

$gltab = $tabpre."_languages";
$wptitel = translate("urth",$langsel);

?>
<?php
print $GLOBALS["htmldoctype"];
?>

<html>

<head>
<title><?php print $GLOBALS["sitetitle"]; ?> - <?php print $wptitel; ?></title>

<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--
function goback_onclick() {
    window.history.go(-1);
}
//-->
</SCRIPT>
</head>

<body <?php print $GLOBALS["sysbodystyle"]; ?>>

<h3><?php print translate("pwreg",$langsel); ?></h3><br><br>

<?php

$fields = gmqfix($fields);
#mqfix($fields);

$leave = 0;
$email=strtolower($fields["newemail"]);

if(!emailok($email)) {
    print translate("badem",$langsel);
    print "<br><br>$email\n";
    $leave=1;
} else {
    $sqlstr = "select * from ".$tabpre."_user_reg where email = '$email'";
    $qu_res = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $qu_num = @mysql_num_rows($qu_res);

    if($qu_num > 0) {
    //if (mysql_query($sqlstr)) {
        print translate("emar",$langsel);
        print "<br><br>\n";
        $leave=1;
    }
}

@mysql_free_result($qu_res);

    $badun = false;
    for($xl=0;$xl<strlen($fields["uname"]);$xl++) {
        if(ereg("^[^a-zA-Z0-9]$",substr($fields["uname"],$xl,1))) {
            $badun = true;
            $leave = 1;
            print "<b>User name \"".$fields["uname"]."\" has invalid characters, only leters and numers are allowed</b><br><br>";
        }
    }

    if($badun==false && $leave == 0) {

        $sqlstr = "select * from ".$tabpre."_user_reg where uname = '".$fields["uname"]."'";
        $qu_res = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $qu_num = @mysql_num_rows($qu_res);

        if($qu_num > 0) {
        //if(mysql_query($sqlstr)) {
            print translate("badun",$langsel);
            print "<br><br>\n";
            $leave=1;
        }
        @mysql_free_result($qu_res);
    }

//print "Lang: $langsel<br>";

$sqlstr = "select * from $gltab where uid = $langsel";
$qu_res = mysql_query($sqlstr) or die("Cannot query global language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
//$qu_num = mysql_num_rows($qu_res);

if (!$qu_res) {
    print translate("ldbp",$langsel);
    print "<br><br>\n";
    $leave=1;
}

if ($leave==1) {

print "<br><br>\n";
print "<center><A HREF=\"".$GLOBALS["idxfile"]."\">Click here for the Logon Screen</A></center><br><br>\n";
print "<center><input type=\"button\" value=\"Back to Registration Form\" name=\"goback\" id=\"goback\" LANGUAGE=javascript onclick=\"return goback_onclick()\"></center>\n";
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
@mysql_free_result($qu_res);
exit();

}

$lsel = mysql_fetch_array($qu_res);
$slanguage = $lsel["name"];

@mysql_free_result($qu_res);

/*

#old method


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

// Don't ask...
// okay ask... Someone told me that using md5 like this is overkill... I agree
// It is only done like this to (try) and ensure that the generated key is unique.
$key = md5(md5(md5($newpw_enc)));

*/

# new method
$key = md5(uniqid(rand(), true));

$regtime = time();

$xmdpw = md5($fields["pw"]);

$istfadmin = 0;

$fields = gmqfmt($fields);

if($forcedefaultcal == 1) {
    $sqlstr = "insert into ".$tabpre."_user_reg (uname,fname,lname,email,pw,emok,langid,language,regtime,regkey,isadmin,startcalid,startcalname)
    values('".$fields["uname"]."','".$fields["fname"]."','".$fields["lname"]."','$email','$xmdpw',0,$langsel,'$slanguage',$regtime,'$key',$istfadmin,'$defaultcalid','".fmtfordb($defaultcalname,2)."')";
} else {
    $sqlstr = "insert into ".$tabpre."_user_reg (uname,fname,lname,email,pw,emok,langid,language,regtime,regkey,isadmin)
    values('".$fields["uname"]."','".$fields["fname"]."','".$fields["lname"]."','$email','$xmdpw',0,$langsel,'$slanguage',$regtime,'$key',$istfadmin)";
}

if(!mysql_query($sqlstr)) {
    print "<br><br>";
    print translate("pier",$langsel);
    print "<br><br>".$sqlstr;
} else {

    $fields = gmqfix($fields);
    #mqfix($fields);

    $regmail = new htmlMimeMail();

    $regmbody="<HTML><BODY>Hello ".$fields["fname"]." ".$fields["lname"].",<br><br>You just registered with the CaLogic Calendar application running at
    ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") <br><br>
    Please click the link below to confirm your registraton:<br><br><a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?xrkey=$key\" target=\"_blank\">
    Confirm Registration</a><br><br>Or copy and paste this address to your browser:<br><br>".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?xrkey=$key<br><br>If there is a problem when confirming, you may be prompted to enter your registration key. Simply cut and paste it to the entry field.<br><br>Registration Key: ".$key."<br><br>";
    if($GLOBALS["forcedefaultcal"] == 1) {
        $regmbody.="After confirming, you may begin using the calendar.";
    } else {
        $regmbody.="After confirming, you may begin configuring a Calendar to your likings.";
    }
    $regmbody.="<br><br>
    I hope you enjoy working with the calendar, and wish you much success. Information given by you:<br><br>
    <b>User Name: </B>".$fields["uname"]."<br><B>First Name:  </B>".$fields["fname"]."<br><B>Last Name: </B> ".$fields["lname"]."<br><B>Language Selection:
    </B>$slanguage<br><br>For security reasons, your password has not been sent with this mail.<br><br>
    If you experience problems with the calendar, please let me know. <br><br>
    Thank you and best regards<br><br>".$GLOBALS["siteowner"]."<br></body></html>";

$regmtext="Hello ".$fields["fname"]." ".$fields["lname"].",\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (
".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n
".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?xrkey=$key\n\nIf there is a problem when confirming, you may be prompted to enter your registration key. Simply cut and paste it to the entry field.\n\nRegistration Key: ".$key."\n\n";
if($GLOBALS["forcedefaultcal"] == 1) {
    $regmtext.="After confirming, you may begin using the calendar.";
} else {
    $regmtext.="After confirming, you may begin configuring a Calendar to your likings.";
}
$regmtext.="\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\n
User Name: ".$fields["uname"]."\nFirst Name:  ".$fields["fname"]."\nLast Name: ".$fields["lname"]."\nLanguage Selection:  $slanguage\n\n
For security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar,
please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";


$regmsms="To confirm registraton, follow this link\n
".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?xrkey=$key\n";


    $regsub = "CaLogic Registration Confirmation";
    $siteowner=$GLOBALS["siteowner"];
    $adminemail=$GLOBALS["adminemail"];


/*
    if($GLOBALS["mailastext"]==0) {
        $regmail->setHtml($regmbody, $regmtext);
    } else {
        $regmail->setText($regmtext);
    }
*/
        if($fields["emailtype"]=="HTML") {
            $regmail->setHtml($regmbody, $regmtext);
        } elseif($fields["emailtype"]=="TEXT") {
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

        if($GLOBALS["uniem"] == 1) {
            $toadr="CaLogic Administrator <$adminemail>";
            $fromadr="CaLogic Web Site <$adminemail>";
        } else {
            $toadr="$adminemail";
            $fromadr="$adminemail";
        }

        $regmail->setFrom($fromadr);

        $regmail->setSubject("System email - CaLogic User Registration ".$GLOBALS["sitetitle"]);

$regmtext="A new user has just registered\n\nHere is a copy of the mail sent to the new user:\n\n\n".$regmtext;
        $regmail->setText($regmtext);

        $regmail->buildMessage();

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

        $logentry["uid"] = "0";
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "New user registration, user: ".$fields["fname"]." ".$fields["lname"];
        $logentry["lbefore"] = " ";
        $logentry["lafter"] = " ";
        $logentry["remarks"] = " ";
        histlog($logentry);

    }
    print translate("regok",$langsel);

}


?>
<br><br>
<center>
<?php
/*
<A HREF="<?php print $GLOBALS["idxfile"]; ?>">Click here for the Logon Screen</A></center>
*/
?>
<b>Please close this browser window before you confirm your registration.</b>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
?>

