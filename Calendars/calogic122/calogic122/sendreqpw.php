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
<title><?php print $GLOBALS["sitetitle"]; ?> - Request Password</title>

<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--
function goback_onclick() {
    window.history.go(-1);
}
//-->
</SCRIPT>
</head>

<body <?php print $GLOBALS["sysbodystyle"]; ?>>

<h3>CaLogic - Request Password</h3><br><br>

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

    if($qu_num < 1) {
        $leave=2;
    } else {
        @mysql_free_result($qu_res);
        $sqlstr = "select * from ".$tabpre."_user_reg where email = '$email'";
        $qu_res = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $userrow = mysql_fetch_array($qu_res);
        @mysql_free_result($qu_res);

        if($userrow["emok"]==1 && $userrow["newpw"]==0) {
            $sqlstr = "update ".$tabpre."_user_reg set newpw = 1 where email = '$email'";
            mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            if (strlen($userrow["regkey"]) < 1) {

/*
# old method
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
                $key = md5(md5(md5($newpw_enc)));
*/
#new method
		$key = md5(uniqid(rand(), true));
                $sqlstr = "update ".$tabpre."_user_reg set regkey = '".$key."' where email = '$email'";
                mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            } else {
                $key = $userrow["regkey"];
            }
        }
    }
}



/*
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

*/
//print "Lang: $langsel<br>";


if ($leave==1) {

    print "<br><br>\n";
    print "<center><A HREF=\"".$GLOBALS["idxfile"]."\">Click here for the Logon Screen</A></center><br><br>\n";
    print "<center><input type=\"button\" value=\"Back to Request Password Form\" name=\"goback\" id=\"goback\" LANGUAGE=javascript onclick=\"return goback_onclick()\"></center>\n";
    print "<br><br>";
    include($GLOBALS["CLPath"]."/include/footer.php");
    @mysql_free_result($qu_res);
    exit();

}

/*
$sqlstr = "select * from $gltab where uid = $langsel";
$qu_res = mysql_query($sqlstr) or die("Cannot query global language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
//$qu_num = mysql_num_rows($qu_res);

if (!$qu_res) {
    $slanguage = "English";
} else {
    $lsel = mysql_fetch_array($qu_res);
    $slanguage = $lsel["name"];
}

@mysql_free_result($qu_res);
*/

if($leave != 2 && $userrow["emok"]==1 && $userrow["newpw"]==0) {
/*
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

    $sqlstr = "update ".$tabpre."_user_reg set newpw = '".$newpw."'";
    mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
*/
    $regmail = new htmlMimeMail();

    $regmbody="<HTML><BODY>Hello ".$userrow["fname"]." ".$userrow["lname"].",<br><br>Someone has just requested a new password for your CaLogic user account running at
    ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") <br><br>
    Please click the link below to confirm the password request:<br><br><a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmnewpw.php?xrkey=".$key."\" target=\"_blank\">
    Request Password</a><br><br>Or copy and paste this address to your browser:<br><br>".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmnewpw.php?xrkey=".$key."<br><br>If there is a problem when confirming, you may be prompted to enter your request key. Simply cut and paste it to the entry field.<br><br>Request Key: ".$key."<br><br>
    If you did not request your password, you can ignore this e-mail.<br><br>
    Thank you.<br><br>".$GLOBALS["siteowner"]."<br></body></html>";


    $regmtext="Hello ".$userrow["fname"]." ".$userrow["lname"].",\n\nSomeone has just requested a new password for your CaLogic user account running at
    \n\n".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\n
    Please copy and paste this URL to your browser:\n\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmnewpw.php?xrkey=".$key."\n\n
    If there is a problem when confirming, you may be prompted to enter your request key. Simply cut and paste it to the entry field.
    \n\nRequest Key: ".$key."\n\n
    If you did not request your password, you can ignore this e-mail.\n\n
    Thank you.\n\n".$GLOBALS["siteowner"]."\n\n";

$regmsms="Confirm link:\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmnewpw.php?xrkey=".$key."\n
If request is not from you then ignore this e-mail.";


    $regsub = "CaLogic Password Request";
    $siteowner=$GLOBALS["siteowner"];
    $adminemail=$GLOBALS["adminemail"];

/*
    if($GLOBALS["mailastext"]==0) {
        $regmail->setHtml($regmbody, $regmtext);
    } else {
        $regmail->setText($regmtext);
    }
*/

	if($userrow["emailtype"]=="HTML") {
	    $regmail->setHtml($regmbody, $regmtext);
	} elseif($userrow["emailtype"]=="TEXT") {
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

#    if($GLOBALS["sadmmail"]==1) {

        if($GLOBALS["uniem"] == 1) {
            $toadr="CaLogic Administrator <$adminemail>";
            $fromadr="CaLogic Web Site <$adminemail>";
        } else {
            $toadr="$adminemail";
            $fromadr="$adminemail";
        }

        $regmail->setFrom($fromadr);

        $regmail->setSubject("System email - CaLogic User Password Request ".$GLOBALS["sitetitle"]);

        $regmtext="A user has just requested a new password\n\nHere is a copy of the mail sent to the user:\n\n\n".$regmtext;
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

        $logentry["uid"] = $userrow["uid"];
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "User requested new password: ".$userrow["fname"]." ".$userrow["lname"];
        $logentry["lbefore"] = " ";
        $logentry["lafter"] = " ";
        $logentry["remarks"] = " ";
        histlog($logentry);


#    }
}


?>
An E-Mail has been sent to you with a Password Change Request Confirmation Link. You must follow<br>
the link in that mail to activate your new password.
<br><br>
<center>
<A HREF="<?php print $GLOBALS["idxfile"]."?gologinform=1"; ?>">Click here for the Logon Screen</A></center>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
?>

