<?php

/***************************************************************
** Title.........: diverse CaLogic  Functions
** Version.......: 1.0
** Author........: Philip Boone <philip@calogic.de>
** Filename......: dbfunc.php
** Last changed..:
** Notes.........:
** Use...........:
*/

function makeuid() {

    $token = md5(uniqid(rand(), true));
    return($token);
}

function getdespop($xdesctextx = "",$type=0) {
    global $user,$curcalcfg;

   $xevdesc = "";

        if($type == 0) {
            $tok = strtok(nl2br(htmlentities(str_replace("'","\'",$xdesctextx),ENT_COMPAT)),"\r\n");
        } else {
            $tok = strtok(nl2br(htmlentities($xdesctextx,ENT_QUOTES)),"\r\n");
        }

        while ($tok) {
            $xevdesc .= $tok;
            $tok = strtok("\r\n");
        }

    return($xevdesc);

}


/*
function getdespop($xdesctextx = "") {

    $xevdesc = "";
    $tok = strtok(nl2br(htmlentities(str_replace("'","\'",$xdesctextx),ENT_COMPAT)),"\r\n");
    while ($tok) {
        $xevdesc .= $tok;
        $tok = strtok("\r\n");
    }
    return($xevdesc);

# original code that was in the view scripts
#    $xevdesc="";
#    $tok = strtok(nl2br(htmlentities(str_replace("'","\'",$cevent[$ec]["description"]),ENT_COMPAT)),"\r\n");
#    while ($tok) {
#        $xevdesc .= $tok;
#        $tok = strtok("\r\n");
#    }

}
*/
function histlog($logentry) {

# logentry is an array in this format
# uid
# calid
# evid
# adate
# laction
# lbefore
# lafter
# remarks

    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_log (uid,calid,evid,hldate,adate,laction,lbefore,lafter,remarks)
    values(".$logentry["uid"].",'".$logentry["calid"]."',".$logentry["evid"].",".time().",".$logentry["adate"].",'".$logentry["laction"]."','".$logentry["lbefore"]."','".$logentry["lafter"]."','".$logentry["remarks"]."')";
    $query1 = mysql_query($sqlstr) or die("Cannot insert to Log Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    return;
}

function dumpdatabase() {

#mysqldump --host= --user= --password= --port= --add-drop-table --allow-keywords -n --result-file=calogic_dump1.sql database


}

function checkinput($pvar) {

    for($xl=0;$xl<strlen($pvar);$xl++) {
        if(ereg("^[^a-zA-Z0-9]$",substr($pvar,$xl,1))) {
            return false;
        }
    }

    return true;

}


# if mqt = 0 then are wanting to stripslash GPC
# if mqt = 1 then are wanting to stripslash runtime (database)
# if mqt = 2 then are wanting to stripslash variable


function gmqfix($xqselrow1,$mqt=0) {

    foreach($xqselrow1 as $k1 => $v1) {
        $xqselrow1[$k1] = mqfix($xqselrow1[$k1],$mqt);
    }


    #mqfix($xqselrow1,$mqt);
    return $xqselrow1;
}


function gmqfmt($xqselrow,$mqt=0) {
    foreach($xqselrow as $k1 => $v1) {
        $xqselrow[$k1] = fmtfordb($xqselrow[$k1],$mqt);
    }
    return $xqselrow;
}


function mqfix($xqfvar,$mqt=0) {
    # if mqt = 0 then are wanting to stripslash GPC (GET, POST, COOKIES)
    # if mqt = 1 then are wanting to stripslash runtime (Database Queries)
    # if mqt = 2 then are wanting to stripslash variable
    if ($GLOBALS["cldebug"] == true) {
#        print "mqfix, mqt = ".$mqt."<br>";
    }
    if ($GLOBALS["cldebug"] == true) {
#        print "mqfix, initval = ".$xqfvar."<br>";
    }

    if ($mqt==0) {
        if (get_magic_quotes_gpc()) {
            if ($GLOBALS["cldebug"] == true) {
#                print "mqfix, mq is on<br>";
            }
            if (ini_get('magic_quotes_sybase')) {
                if ($GLOBALS["cldebug"] == true) {
#                    print "mqfix, mq_sb is on<br>";
                }
                $xqfvar = preg_replace("/''/", "'", $xqfvar);
            } else {
                if ($GLOBALS["cldebug"] == true) {
#                    print "mqfix, mq_sb is off<br>";
                }
                $xqfvar = stripslashes($xqfvar);
            }
            #$xqfvar = stripslashes($xqfvar);
        } else {
            if ($GLOBALS["cldebug"] == true) {
#                print "mqfix, mq is off<br>";
            }
        }
    }
    if ($mqt==1) {
        if (get_magic_quotes_runtime()) {
            if (ini_get('magic_quotes_sybase')) {
                $xqfvar = preg_replace("/''/", "'", $xqfvar);
            } else {
                $xqfvar = stripslashes($xqfvar);
            }
        }
    }
    if ($mqt==2) {
        if ($GLOBALS["cldebug"] == true) {
#            print "mqfix, stripping<br>";
        }

        $xqfvar = stripslashes($xqfvar);
    }
/*
   if (is_array($xqfvar)) {
       while (list($key,$value) = each($xqfvar)) {
           if ($value) remove_magic_quotes($xqfvar[$key]);
       }
   } else if (ini_get('magic_quotes_sybase')) {
       $xqfvar = preg_replace("/''/", "'", $xqfvar);
   } else if (get_magic_quotes_runtime()) {
       $xqfvar = preg_replace("/\\\"/", '"', $xqfvar);
   } else if (get_magic_quotes_gpc()) {
       $xqfvar = stripslashes($xqfvar);
  }
*/
    if ($GLOBALS["cldebug"] == true) {
#        print "mqfix, rettval = ".$xqfvar."<br>";
    }

    return $xqfvar;
}

/*
remove_magic_quotes($HTTP_GET_VARS);
remove_magic_quotes($HTTP_POST_VARS);
remove_magic_quotes($HTTP_COOKIES_VARS);
remove_magic_quotes($HTTP_SESSION_VARS);
set_magic_quotes_runtime(0);

function remove_magic_quotes(&$x) {
   if (is_array($x)) {
       while (list($key,$value) = each($x)) {
           if ($value) remove_magic_quotes($x[$key]);
       }
   } else if (ini_get('magic_quotes_sybase')) {
       $x = preg_replace("/''/", "'", $x);
   } else if (get_magic_quotes_runtime()) {
       $x = preg_replace("/\\\"/", '"', $x);
   } else if (get_magic_quotes_gpc()) {
       $x = stripslashes($x);
  }
}


echo "MQ SB: ". (ini_get('magic_quotes_sybase')) ? "0" : "1"."<br>";
echo "MQ RT: ".get_magic_quotes_runtime()."<br>";
echo "MQ SV: ".get_magic_quotes_gpc()."<br>";

*/
/*
// This function is a generic data processing function. It adds slashes if the magic quotes is off.
function reslash($string)
{
if (!get_magic_quotes_gpc())
$string = addslashes($string);
return $string;
}

// This function takes out slashes if if the magic quotes are on.
function deslash($string)
{
if (get_magic_quotes_gpc())
$string = stripslashes($string);
return $string;
}

*/

function fmtfordb($pvar,$mqt=0) {
    # if mqt = 0 then are wanting to addslash GPC
    # if mqt = 1 then are wanting to addslash runtime
    # if mqt = 2 then are wanting to addslash variabla

#    echo "DEBUGGING<br><br>";
#    echo "1-PVAR: ".$pvar."<br><br>";

# remove CaLogic reserved charachter
    #$pvar = str_replace("|","&#124;",$pvar);

#    if (!get_magic_quotes_gpc()) {
#        $pvar=addslashes($pvar);
#        echo "PVAR-T: ADD<br><br>";
#    }


    if ($mqt==0) {
        if (!get_magic_quotes_gpc()) {
            $pvar = addslashes($pvar);
        } else {
            if (ini_get('magic_quotes_sybase')) {
                $pvar = preg_replace("/''/", "'", $pvar);
            }
            $pvar = addslashes($pvar);
        }
    }
    if ($mqt==1) {
        if (!get_magic_quotes_runtime()) {
            $pvar = addslashes($pvar);
        } else {
            if (ini_get('magic_quotes_sybase')) {
                $pvar = preg_replace("/''/", "'", $pvar);
            }
            $pvar = addslashes($pvar);
        }
    }
    if ($mqt==2) {
        $pvar = addslashes($pvar);
    }

/*

   if (is_array($pvar)) {
       while (list($key,$value) = each($pvar)) {
           if ($value) remove_magic_quotes($pvar[$key]);
       }
   } else if (ini_get('magic_quotes_sybase')) {
       $pvar = preg_replace("/''/", "'", $pvar);
   } else if (get_magic_quotes_runtime()) {
       $pvar = preg_replace("/\\\"/", '"', $pvar);
       $pvar = preg_replace("/\\\"/", '"', $pvar);
   } else if (get_magic_quotes_gpc()) {
       $pvar = addslashes($pvar);
  }
*/


#    echo "2-PVAR: ".$pvar."<br><br>";

    return $pvar;
}

//function fmtforcl($pvar) {
//    $pvar = ($pvar);
//    return $pvar;
//}

function translate($keyid,$setlang) {
//    global $tabpre,$gltab;
$erfilename = "File: ".substr(__FILE__,strrpos(__FILE__,"/")).";";

    $gltab = $GLOBALS["gltab"]; //$tabpre."_languages";
    $sqlstr = "select name from ".$GLOBALS["gltab"]." where uid=$setlang";
    $qu_res = mysql_query($sqlstr)  or die("Cannot query global language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

/*    if (mysql_error()) {
        $error = mysql_error();
        sqlerror($error, __LINE__, "$erfilename Cannot query Global Language Database", $sqlstr);
    }

*/
    $qu_num = @mysql_num_rows($qu_res);
    if($qu_num < 1) {
        mysql_free_result($qu_res);
        $sqlstr = "select * from $gltab where uid=1";
        $qu_res = mysql_query($sqlstr) or die("Cannot query global language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
/*        if (mysql_error()) {
            $error = mysql_error();
            sqlerror($error, __LINE__, "$erfilename Cannot query Global Language Database", $sqlstr);
        }
*/
        $qu_num = @mysql_num_rows($qu_res);
        if ($qu_num < 1) {
            sqlerror("", __LINE__, "$erfilename Database Error, nither the requested language table nor the default language table were found.",$sqlstr);
        }
        $rs_lang = mysql_fetch_array($qu_res);
        $langtab = $GLOBALS["tabpre"]."_lang_".$rs_lang["name"];
        mysql_free_result($qu_res);
        $sqlstr = "select * from $langtab where keyid='$keyid'";
        $qu_res = mysql_query($sqlstr) or die("Cannot query language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

/*        if (mysql_error()) {
            $error = mysql_error();
            sqlerror($error, __LINE__, "$erfilename Cannot query Local Language Database [$langtab]", $sqlstr);
        }
*/
        $qu_num = @mysql_num_rows($qu_res);
        if ($qu_num < 1) {
            sqlerror("", __LINE__, "$erfilename Database Error, requested language table not found, keyid $keyid in default language table $langtab not found.", $sqlstr);
        }
        $rs_key = mysql_fetch_array($qu_res);
        $ret_val = mqfix($rs_key["phrase"],1);
        mysql_free_result($qu_res);
        return $ret_val;
    }

    $rs_lang = mysql_fetch_array($qu_res);
    $langtab = $GLOBALS["tabpre"]."_lang_".$rs_lang["name"];
    $sqlstr = "select * from $langtab where keyid='$keyid'";

    $qu_res = mysql_query($sqlstr) or die("Cannot query language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
/*    if (mysql_error()) {
        $error = mysql_error();
        sqlerror($error, __LINE__, "$erfilename Cannot query Local Language Database [$langtab]", $sqlstr);
    }
*/
    $qu_num = @mysql_num_rows($qu_res);

    if ($qu_num < 1) {
        sqlerror("", __LINE__, "$erfilename Database Error, keyid [$keyid] not found in requested language table $langtab.", $sqlstr);
    }

    $rs_key = mysql_fetch_array($qu_res);
    $ret_val = mqfix($rs_key["phrase"],1);
    mysql_free_result($qu_res);
    return $ret_val;
}

function emailok($email) {
#    if (eregi("^([0-9,a-z]+)([.,_,-]([0-9,a-z]+))*[@]([0-9,a-z]+)([.,_,-]([0-9,a-z]+))*[.]([0-9,a-z]){2,4}([0-9,a-z])?$",$email)) {
    if (eregi("^([0-9,a-z]+)([.,_,-]([0-9,a-z]+))*[@]([0-9,a-z]+)([.,_,-]([0-9,a-z]+))*[.]([0-9,a-z]){2,4}$",$email)) {
        return true;
    } else {
        return false;
    }
}

function sqlerror($error="",$myerrnum=0,$errext="",$sqlstr="") {

    if($error <> "") {
        print "MySQL Database Error: <br>$error<br><br>";
    }
    if($myerrnum <> 0) {
        print "Program Error Line Number: $myerrnum<br><br>";
    }
    if($errext <> "") {
        print "Program Error Message: $errext<br><br>";
    }
    if($sqlstr <> "") {
        print "Executed SQL String: $sqlstr<br><br>";
    }
    print "Please contact the Admin if the problem persists.";
    exit();
}

function setviewtext($langsel) {
    global $weekstartonmonday,$daytext,$daytextl,$monthtext,$monthtextl,$evddt,$evddtl;
    global $langcfg;

    if ($weekstartonmonday==1) {

        $daytext[1] = $langcfg["wdns1"]; //"Mon";
        $daytext[2] = $langcfg["wdns2"]; //"Tue";
        $daytext[3] = $langcfg["wdns3"]; //"Wed";
        $daytext[4] = $langcfg["wdns4"]; //"Thu";
        $daytext[5] = $langcfg["wdns5"]; //"Fri";
        $daytext[6] = $langcfg["wdns6"]; //"Sat";
        $daytext[7] = $langcfg["wdns7"]; //"Sun";
        $daytextl[1] = $langcfg["wdnl1"]; //"Monday";
        $daytextl[2] = $langcfg["wdnl2"]; //"Tuesday";
        $daytextl[3] = $langcfg["wdnl3"]; //"Wednesday";
        $daytextl[4] = $langcfg["wdnl4"]; //"Thursday";
        $daytextl[5] = $langcfg["wdnl5"]; //"Friday";
        $daytextl[6] = $langcfg["wdnl6"]; //"Saturday";
        $daytextl[7] = $langcfg["wdnl7"]; //"Sunday";

    } else {

        $daytext[1] = $langcfg["wdns7"]; //"Sun";
        $daytext[2] = $langcfg["wdns1"]; //"Mon";
        $daytext[3] = $langcfg["wdns2"]; //"Tue";
        $daytext[4] = $langcfg["wdns3"]; //"Wed";
        $daytext[5] = $langcfg["wdns4"]; //"Thu";
        $daytext[6] = $langcfg["wdns5"]; //"Fri";
        $daytext[7] = $langcfg["wdns6"]; //"Sat";
        $daytextl[1] = $langcfg["wdnl7"]; //"Sunday";
        $daytextl[2] = $langcfg["wdnl1"]; //"Monday";
        $daytextl[3] = $langcfg["wdnl2"]; //"Tuesday";
        $daytextl[4] = $langcfg["wdnl3"]; //"Wednesday";
        $daytextl[5] = $langcfg["wdnl4"]; //"Thursday";
        $daytextl[6] = $langcfg["wdnl5"]; //"Friday";
        $daytextl[7] = $langcfg["wdnl6"]; //"Saturday";
    }

        $evddt[1] = $langcfg["wdns1"]; //"Mon";
        $evddt[2] = $langcfg["wdns2"]; //"Tue";
        $evddt[3] = $langcfg["wdns3"]; //"Wed";
        $evddt[4] = $langcfg["wdns4"]; //"Thu";
        $evddt[5] = $langcfg["wdns5"]; //"Fri";
        $evddt[6] = $langcfg["wdns6"]; //"Sat";
        $evddt[7] = $langcfg["wdns7"]; //"Sun";
        $evddtl[1] = $langcfg["wdnl1"]; //"Monday";
        $evddtl[2] = $langcfg["wdnl2"]; //"Tuesday";
        $evddtl[3] = $langcfg["wdnl3"]; //"Wednesday";
        $evddtl[4] = $langcfg["wdnl4"]; //"Thursday";
        $evddtl[5] = $langcfg["wdnl5"]; //"Friday";
        $evddtl[6] = $langcfg["wdnl6"]; //"Saturday";
        $evddtl[7] = $langcfg["wdnl7"]; //"Sunday";


    $monthtext[1] = $langcfg["mns1"]; //"Jan";
    $monthtext[2] = $langcfg["mns2"]; //"Feb";
    $monthtext[3] = $langcfg["mns3"]; //"Mar";
    $monthtext[4] = $langcfg["mns4"]; //"Apr";
    $monthtext[5] = $langcfg["mns5"]; //"May";
    $monthtext[6] = $langcfg["mns6"]; //"Jun";
    $monthtext[7] = $langcfg["mns7"]; //"Jul";
    $monthtext[8] = $langcfg["mns8"]; //"Aug";
    $monthtext[9] = $langcfg["mns9"]; //"Sep";
    $monthtext[10] = $langcfg["mns10"]; //"Oct";
    $monthtext[11] = $langcfg["mns11"]; //"Nov";
    $monthtext[12] = $langcfg["mns12"]; //"Dec";

    $monthtextl[1] = $langcfg["mnl1"]; //"January";
    $monthtextl[2] = $langcfg["mnl2"]; //"February";
    $monthtextl[3] = $langcfg["mnl3"]; //"March";
    $monthtextl[4] = $langcfg["mnl4"]; //"April";
    $monthtextl[5] = $langcfg["mnl5"]; //"May";
    $monthtextl[6] = $langcfg["mnl6"]; //"June";
    $monthtextl[7] = $langcfg["mnl7"]; //"July";
    $monthtextl[8] = $langcfg["mnl8"]; //"August";
    $monthtextl[9] = $langcfg["mnl9"]; //"September";
    $monthtextl[10] = $langcfg["mnl10"]; //"October";
    $monthtextl[11] = $langcfg["mnl11"]; //"November";
    $monthtextl[12] = $langcfg["mnl12"]; //"December";

}


function getcurlang($langsel) {
    global $langcfg;
    if ($langsel == "") {
        $langsel = $GLOBALS["standardlang"];
    }
    $gltab = $GLOBALS["gltab"]; //$tabpre."_languages";
    $sqlstr = "select name from $gltab where uid=$langsel";
    $qu_res = mysql_query($sqlstr) or die("Cannot query global language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
/*    if (mysql_error()) {
        $error = mysql_error();
        sqlerror($error, __LINE__, "$erfilename Cannot query Global Language Database", $sqlstr);
    }
*/
    $qu_num = @mysql_num_rows($qu_res);
    if (mysql_error()) {
        $error = mysql_error();
        sqlerror($error, __LINE__, "$erfilename Cannot query Global Language Database", $sqlstr);
    }
    if($qu_num == 1) {
        $rs_lang = mysql_fetch_array($qu_res);
        $langtab = $GLOBALS["tabpre"]."_lang_".$rs_lang["name"];
        $sqlstr = "select * from ".$langtab;
        $query1 = mysql_query($sqlstr) or die("Cannot query Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        #print "<br><br>get lang<br><br>";
        while($row = mysql_fetch_array($query1)) {

            #print "(BEFORE) KEY: ".$row["keyid"]." : PHRASE: ".$row["phrase"]."<br><br>";

            $langcfg[$row["keyid"]] = mqfix($row["phrase"],1);

            #print "(AFTER) KEY: ".$langcfg[$row["keyid"]]."<br><br>";

        }
        mysql_free_result($query1);
        mysql_free_result($qu_res);
    } else {
        die("Cannot query Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
    }

}

function gettablestructure($tabname,$exclfld="") {
    global $dbname;
    $retval = "";
    $fields = mysql_list_fields($dbname, $tabname);
    $columns = mysql_num_fields($fields);

    $gotcount=0;
    for ($i = 0; $i < $columns; $i++) {

        if($exclfld != "") {
            if(mysql_field_name($fields, $i) != $exclfld ) {
                if($gotcount==0) {
                    $gotcount++;
                    $retval=$retval.mysql_field_name($fields, $i);
                } else {
                    $gotcount++;
                    $retval=$retval.",".mysql_field_name($fields, $i);
                }
            }
        } else {
            if($gotcount==0) {
                $gotcount++;
                $retval=$retval.mysql_field_name($fields, $i);
            } else {
                $gotcount++;
                $retval=$retval.",".mysql_field_name($fields, $i);
            }
        }
    }
    return $retval;
}

function getuserstandards($cuser) {

# this little routine I am very proud of.
# it merges global settings with user calendar settings.
# user settings are only taken over if the admin has allowed the
# customising of the setting. Otherwise, the global defualt
# takes precedence.

    global $curcalcfg,$csectcnt,$user;
    $curcalcfg = array();
    $csectcnt = array();

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$user->gsv("curcalid")."'";
    $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $res_query1 = @mysql_num_rows($query1) ;
    if(mysql_error()) {
        die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
    }
    if($res_query1 == 1) {

        $query2 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $res_query2 = @mysql_num_rows($query2) ;
        if(mysql_error()) {
            die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
        }

    	$row = mysql_fetch_array($query2) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);

        $i = 0;

        while ($i < mysql_num_fields($query1)) {

            $meta = mysql_fetch_field($query1);
            $fname = $meta->name;

            $fieldallow = false;
            $tfldname = $fname;

            if(substr($fname,0,5) == "gcsco") {
                $tfldname = substr($fname,8);

            } elseif(substr($fname,2,6) == "selmc_") {
                $tfldname = substr($fname,8);

            } elseif(substr($fname,0,3) == "pu_") {
                $tfldname = $fname;

            } else {
                $fieldallow = true;
            }

            $tfldvar = "allow_".$tfldname;

#print "T field: ".$tfldvar."<br>";

            if(isset($GLOBALS[$tfldvar])) {
#print "global var is set to ".$GLOBALS["$tfldvar"]."<br>";
                if($GLOBALS[$tfldvar] == 1) {
                    $fieldallow = true;
                }else {
                    $fieldallow = false;
                }
            } else {
#print "global var is NOT set<br>";

                $fieldallow = true;
            }

            $xcsnt = substr($fname,0,2);

#print "allow value: ".$fieldallow."<br>";
#print "field name: ".$fname."<br>";
#print "T field name: ".$tfldname."<br>";


            if($fieldallow === true) {
                $curcalcfg[$fname] = mqfix($row["$fname"],1);
                if(!isset($csectcnt[$xcsnt])) {
                    $csectcnt[$xcsnt] = 0;
                }
                $csectcnt[$xcsnt]++;
            }else {
                $curcalcfg[$fname] = $GLOBALS[$tfldname];
            }

#print "curcal field ".$fname.": ".$curcalcfg[$fname]."<br>";
#print "global t field name ".$fname.": ".$GLOBALS[$tfldname]."<br>";
#print "======================<br>";

            #$curcalcfg["$fname"] = mqfix($row["$fname"],1);

//            $xcsnt = substr($fname,0,2);
//            if(array_key_exists($xcsnt, $csectcnt)) {
//                $csectcnt[$xcsnt]++;
//            } else {
//                $csectcnt[$xcsnt] = 1;
//            }
//            print $xcsnt.": ".$csectcnt[$xcsnt]."<br>";

            // Trick, used to create language entries he he he.
//            print "INSERT INTO `clw_lang_English` VALUES ('', '".$fname."', 'temp', 'Calendar Setup Form');<br>\n";

            $i++;
        }

        @mysql_free_result($query1);
        @mysql_free_result($query2);
#print "setting user vals  ";
        if($curcalcfg["caltype"]=="0") {
            $user->ssv("canpost",1);
            $user->ssv("canpost",1);
            #print "1-";
        } elseif($user->gsv("uname")=="Guest") {
            $user->ssv("canpost",0);
            $user->ssv("canpost",0);
            #print "2-";
        }
        #print $user->gsv("canpost");
        $xxtval = $user->gsv("canpost");

//        exit();

/*
        print "<br><br>";
        foreach($curcalcfg as $k1 => $v1) {
            print $k1.": ".$v1."<br>";
        }
        print "<br><br>";
#        exit();
*/

    } else {
        die("There was an error while getting Calander Settings<br><br>SQL String: ".$sqlstr."<br><br>This could mean your calendar has been deleted or the user name you are using has been deleted.<br><br>
It could also mean your session has gone bad. Please close your browser, open a new browser window and then logon to CaLogic.<br><br>If the problem persists, please contact the Admin.<br><br>
<a href=\"".$GLOBALS["idxfile"]."?endsess=1\">Click here to continue</a>");
    }
}


function getcalvals($xcalid) {
    $calvals = array();

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$xcalid."'";
    $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $res_query1 = @mysql_num_rows($query1) ;
    if(mysql_error()) {
        die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
    }
    if($res_query1 == 1) {
        $query2 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $res_query2 = @mysql_num_rows($query2) ;
        if(mysql_error()) {
            die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
        }
    	$row = mysql_fetch_array($query2) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
        $i = 0;
        while ($i < mysql_num_fields($query1)) {
            $meta = mysql_fetch_field($query1);
            $fname = $meta->name;
            $calvals["$fname"] = mqfix($row["$fname"],1);
            $i++;
        }
        mysql_free_result($query1);
        mysql_free_result($query2);

    } else {
        die("There is an error in the Calendar Config Table<br><br>SQL String: ".$sqlstr);
    }
    return $calvals;
}

function regresend($fname,$lname,$email,$emailtype,$uname,$slanguage,$key) {


# new method

    $regmail = new htmlMimeMail();

    $regmbody="<HTML><BODY>Hello $fname $lname,<br><br>You just registered with the CaLogic Calendar application running at
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
    <b>User Name: </B>$uname<br><B>First Name:  </B>$fname<br><B>Last Name: </B> $lname<br><B>Language Selection:
    </B>$slanguage<br><br>For security reasons, your password has not been sent with this mail.<br><br>
    If you experience problems with the calendar, please let me know. <br><br>
    Thank you and best regards<br><br>".$GLOBALS["siteowner"]."<br></body></html>";

$regmtext="Hello $fname $lname,\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (
".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n
".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?xrkey=$key\n\nIf there is a problem when confirming, you may be prompted to enter your registration key. Simply cut and paste it to the entry field.\n\nRegistration Key: ".$key."\n\n";
if($GLOBALS["forcedefaultcal"] == 1) {
    $regmtext.="After confirming, you may begin using the calendar.";
} else {
    $regmtext.="After confirming, you may begin configuring a Calendar to your likings.";
}
$regmtext.="\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\n
User Name: $uname\nFirst Name:  $fname\nLast Name: $lname\nLanguage Selection:  $slanguage\n\n
For security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar,
please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";

#    $regmtext="Hello $fname $lname,\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?key=$key\n\nAfter confirming, you may begin configuring a Calendar to your likings.\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\nUser Name: $uname\nFirst Name:  $fname\nLast Name: $lname\nLanguage Selection:  $slanguage\n\nFor security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar, please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";

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
        if($emailtype=="HTML") {
            $regmail->setHtml($regmbody, $regmtext);
        } elseif($emailtype=="TEXT") {
            $regmail->setText($regmtext);
        } else {
            $regmail->setText($regmsms);
        }


    $regmail->setSubject($regsub);

    if($GLOBALS["uniem"] == 1) {
        $toadr="$fname $lname <$email>";
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

        $regmail->setSubject("A new user has just been resent the confirmation email from ".$GLOBALS["sitetitle"]);

$regmtext="Here is a copy of the mail sent to the new user:\n\n\nHello $fname $lname,\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (
".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n
".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?xrkey=$key\n\nIf there is a problem when confirming, you may be prompted to enter your registration key. Simply cut and paste it to the entry field.\n\nRegistration Key: ".$key."\n\n";
if($GLOBALS["forcedefaultcal"] == 1) {
    $regmtext.="After confirming, you may begin using the calendar.";
} else {
    $regmtext.="After confirming, you may begin configuring a Calendar to your likings.";
}
$regmtext.="\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\n
User Name: $uname\nFirst Name:  $fname\nLast Name: $lname\nLanguage Selection:  $slanguage\n\n
For security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar,
please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";
        $regmail->setText($regmtext);
#        $regmail->setBcc($fromadr);

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

    }


# old method
/*
    if($GLOBALS["mailastext"]==0) {

#        $regmail = new html_mime_mail('X-Mailer: Html Mime Mail Class');
        $regmail = new htmlMimeMail();

        $regmbody="<HTML><BODY>Hello $fname $lname,<br><br>You just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") <br><br>Please click the link below to confirm your registraton:<br><br><a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?key=$key\" target=\"_blank\">Confirm Registration</a><br><br>Or copy and paste this address to your browser:<br><br>".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?key=$key<br><br>After confirming, you may begin configuring a Calendar to your likings.<br><br>I hope you enjoy working with the calendar, and wish you much success. Information given by you:<br><br><b>User Name: </B>$uname<br><B>First Name:  </B>$fname<br><B>Last Name: </B> $lname<br><B>Language Selection:  </B>$slanguage<br><br>For security reasons, your password has not been sent with this mail.<br><br>If you experience problems with the calendar, please let me know. <br><br>Thank you and best regards<br><br>".$GLOBALS["siteowner"]."<br></body></html>";
        $regmtext="Hello $fname $lname,\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?key=$key\n\nAfter confirming, you may begin configuring a Calendar to your likings.\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\nUser Name: $uname\nFirst Name:  $fname\nLast Name: $lname\nLanguage Selection:  $slanguage\n\nFor security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar, please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";

        $regmail->setHtml($regmbody, $regmtext);
        $regmail->setSubject("CaLogic Registration Confirmation");

#        $regmail->add_html($regmbody, '');
#        $regmail->set_charset('iso-8859-1', TRUE);
#        $regmail->build_message();
        $siteowner=$GLOBALS["siteowner"];
        $adminemail=$GLOBALS["adminemail"];
        //$mail->send('TO NAME', 'TO ADDRESS', 'FROM NAME', 'FROM ADDRESS', 'SUBJECT LINE');
        if($GLOBALS["uniem"] == 1) {
            $regmail->send("$fname $lname", "$email", "$siteowner", "$adminemail", "CaLogic Registration Confirmation");
        } else {
            $regmail->send("", "$email", "", "$adminemail", "CaLogic Registration Confirmation");
        }

	$mail->setFrom('Joe <joe@example.com>');
	$result = $mail->send(array('"Richard" <postmaster@localhost>'));

    } else {

        $regmbody="Hello $fname $lname,\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?key=$key\n\nAfter confirming, you may begin configuring a Calendar to your likings.\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\nUser Name: $uname\nFirst Name:  $fname\nLast Name: $lname\nLanguage Selection:  $slanguage\n\nFor security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar, please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";
        if($GLOBALS["uniem"] == 1) {
            mail("$fname $lname <$email>", "CaLogic Registration Confirmation", $regmbody,"From: $siteowner <$adminemail>");
        } else {
            mail("$email", "CaLogic Registration Confirmation", $regmbody,"From: $adminemail");
        }

    }


    $mailbody = "Hello $fname $lname,\n\nYou just registered with the CaLogic Calendar application running at ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\nTo confirm your registraton, please copy and paste this URL to your browser:\n\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmreg.php?key=$key\n\nAfter confirming, you may begin configuring a Calendar to your likings.\n\nI hope you enjoy working with the calendar, and wish you much success. \n\nInformation given by you:\n\nUser Name: $uname\nFirst Name:  $fname\nLast Name: $lname\nLanguage Selection:  $slanguage\n\nFor security reasons, your password has not been sent with this mail.\n\nIf you experience problems with the calendar, please let me know. \n\nThank you and best regards\n\n".$GLOBALS["siteowner"]."\n";
    sysmail($adminemail,$email,"CaLogic Registration Confirmation",$mailbody);


*/


}

function senddelmail($fname,$lname,$email,$uname) {
/*
    if($GLOBALS["mailastext"]==0) {

        $delmail = new html_mime_mail('X-Mailer: Html Mime Mail Class');
        $delmbody="<HTML><BODY>Hello $fname $lname,<br><br>Your User Profile has been deleted from ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") <br><br>If you want to find out why, send me an E-Mail asking so.<br><br>".$GLOBALS["siteowner"]."<br></body></html>";
        $delmail->add_html($delmbody, '');
        $delmail->set_charset('iso-8859-1', TRUE);
        $delmail->build_message();
        $siteowner=$GLOBALS["siteowner"];
        $adminemail=$GLOBALS["adminemail"];
        //$mail->send('TO NAME', 'TO ADDRESS', 'FROM NAME', 'FROM ADDRESS', 'SUBJECT LINE');
        if($GLOBALS["uniem"] == 1) {
            $delmail->send("$fname $lname", "$email", "$siteowner", "$adminemail", "CaLogic User Deletion");
        } else {
            $delmail->send("", "$email", "", "$adminemail", "CaLogic User Deletion");
        }
    } else {
        $delmbody="Hello $fname $lname,\n\nYour User Profile has been deleted from ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") \n\nIf you want to find out why, send me an E-Mail asking so.\n\n".$GLOBALS["siteowner"]."\n";
        if($GLOBALS["uniem"] == 1) {
            mail("$fname $lname <$email>", "CaLogic User Deletion", $delmbody,"From: $siteowner <$adminemail>");
        } else {
            mail("$email", "CaLogic User Deletion", $delmbody,"From: $adminemail");

        }

    }
*/


    $siteowner=$GLOBALS["siteowner"];
    $adminemail=$GLOBALS["adminemail"];

    $emsub = "CaLogic User Deletion";
    $embody="<HTML><BODY>Hello $fname $lname,<br><br>Your User Profile has been deleted from ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") <br><br>If you want to find out why, send me an E-Mail asking so.<br><br>".$GLOBALS["siteowner"]."<br></body></html>";
    $emtext="Hello $fname $lname,\n\nYour User Profile has been deleted from ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") \n\nIf you want to find out why, send me an E-Mail asking so.\n\n".$GLOBALS["siteowner"];


    if($GLOBALS["uniem"] == 1) {
        $toadr="$fname $lname <$email>";
        $fromadr="$siteowner <$adminemail>";
    } else {
        $toadr="$email";
        $fromadr="$adminemail";
    }

    sysmail($toadr,$fromadr,$emsub,$embody,$emtext);

    if($GLOBALS["sadmmail"]==1) {
        if($GLOBALS["uniem"] == 1) {
            $toadr="$siteowner <$adminemail>";
            $fromadr="CaLogic web site <$adminemail>";
        } else {
            $toadr="$adminemail";
            $fromadr="$adminemail";
        }

        $emsub = "System email - CaLogic User Deletion";
        $embody="<HTML><BODY>Here is a copy of the mail sent to: $toadr<br><br>Hello $fname $lname,<br><br>Your User Profile has been deleted from ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") <br><br>If you want to find out why, send me an E-Mail asking so.<br><br>".$GLOBALS["siteowner"]."<br></body></html>";
        $emtext="Here is a copy of the mail sent to: $toadr\n\nHello $fname $lname,\n\nYour User Profile has been deleted from ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].") \n\nIf you want to find out why, send me an E-Mail asking so.\n\n".$GLOBALS["siteowner"];
        sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
    }


}

function sysmail($emto,$emfrom,$emsub,$embody,$emtext) {

#ini_set("error_reporting","E_ALL");

    $mksmail = new htmlMimeMail();

#print "amhere";

    if($GLOBALS["mailastext"]==0) {
        $mksmail->setHtml($embody, $emtext);
    } else {
        $mksmail->setText($emtext);
    }
    $mksmail->setSubject($emsub);
    $mksmail->setFrom($emfrom);

    if($GLOBALS["mailtype"]=="sendmail") {
        $result = $mksmail->send(array($emto));
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

        $mksmail->setSMTPParams($GLOBALS["smtphost"],$GLOBALS["smtpport"],$emauth,$emuser,$empass);
        $result = $mksmail->send(array($emto),'smtp');
    }
#ini_set("error_reporting","E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_CORE_WARNING|E_PARSE");
}

function langeditor($seledlang,$uobj) {
    global $curcalcfg;
    global $langcfg;

    $htmltrans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
    $transhtml = array_flip($htmltrans);

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_lang_".$seledlang." order by uid";
    $query1 = mysql_query($sqlstr) or die("Cannot query Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

?>
<?php
print $GLOBALS["htmldoctype"];
?>
<head>
<title><?php print $langcfg["edlang"]; ?></title>
<style type="text/css">
<!--
body          {font-family: helvetica, arial, geneva, sans-serif; font-size: small; color: #000000}
pre, tt       {font-size: small}
th            {font-family: helvetica, arial, geneva, sans-serif; font-size: small; font-weight: bold; background-color: #D3DCE3}
td            {font-family: helvetica, arial, geneva, sans-serif; font-size: small}
form          {font-family: helvetica, arial, geneva, sans-serif; font-size: small}
input         {font-family: helvetica, arial, geneva, sans-serif; font-size: small; color: #000000}
select        {font-family: helvetica, arial, geneva, sans-serif; font-size: small; color: #000000}
textarea      {font-family: helvetica, arial, geneva, sans-serif; font-size: small; color: #000000}
//-->
</style>
</head>
<body <?php print $GLOBALS["sysbodystyle"]; ?>>
<h1><?php print $langcfg["edlt1"]; ?> <?php print "$seledlang"; ?> <?php print $langcfg["edltt"]; ?></h1>

<form method="<?php print $GLOBALS["postorget"]; ?>" action="<?php print $GLOBALS["idxfile"]; ?>">
<input type="hidden" name="seledlang" value="<?php print $seledlang; ?>">
<?php
$rcnt=1;
$ccnt=1;
while($row = mysql_fetch_array($query1)) {
    $row = gmqfix($row);

    if($ccnt==1) {
        $ccnt=2;
        $rcolor="#DDDDDD";
    } else {
        $rcolor="#CCCCCC";
        $ccnt=1;
    }
    if($rcnt==1) {
    ?>
  <table border="1" width="100%">
    <tr>
      <th width="33%"><?php print $langcfg["keyidt"]; ?></th>
      <th width="33%"><?php print $langcfg["pht"]; ?></th>
      <th width="34%"><?php print $langcfg["urrh"]; ?></th>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td width="33%" valign="top" align="center" bgcolor="<?php print "$rcolor"; ?>"><br>
            <input type="text" disabled name="fields[<?php print $row["uid"]; ?>][keyid]" value="<?php print $row["keyid"]; ?>" size="30" maxlength="30" />
            <input type="hidden" name="prev_fields[<?php print $row["uid"]; ?>][keyid]" value="<?php print $row["keyid"]; ?>" />
      </td>
      <td width="33%" valign="top" align="center" bgcolor="<?php print "$rcolor"; ?>">
            <textarea name="fields[<?php print $row["uid"]; ?>][phrase]" rows="7" cols="40"><?php print strtr(($row["phrase"]),$htmltrans); ?></textarea>
            <input type="hidden" name="prev_fields[<?php print $row["uid"]; ?>][phrase]" value="<?php print strtr(($row["phrase"]),$htmltrans); ?>" />
      </td>
      <td width="34%" valign="top" align="center" bgcolor="<?php print "$rcolor"; ?>"><br>
            <input type="text" name="fields[<?php print $row["uid"]; ?>][remark]" value="<?php print strtr(($row["remark"]),$htmltrans); ?>" size="40" maxlength="254" />
            <input type="hidden" name="prev_fields[<?php print $row["uid"]; ?>][remark]" value="<?php print strtr(($row["remark"]),$htmltrans); ?>" />
      </td>
    </tr>
    <?php
    $rcnt++;
    if($rcnt==10) {
        $rcnt=1;
        ?>
        <tr><td width="100%" valign="top" align="center" colspan="3"><br>
        <input type="submit" value="<?php print $langcfg["butsavech"]; ?>" name="savelang">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="<?php print $langcfg["butpv"]; ?>" name="canclechanges">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="<?php print $langcfg["leaved"]; ?>" name="leaveeditor">
        </td></tr>
        </table><br>
        <?php
    }
}
if($rcnt<>1) {
?>
  <tr><td width="100%" valign="top" align="center" colspan="3"><br>
  <input type="submit" value="<?php print $langcfg["butsavech"]; ?>" name="savelang">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="<?php print $langcfg["butpv"]; ?>" name="canclechanges">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="<?php print $langcfg["leaved"]; ?>" name="leaveeditor">
  </td></tr>
  </table><br>
<?php
}
?>
</form>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");

    mysql_free_result($query1);
    exit();
}

function dodatabasemaint() {
    global $user;

    $curbtime = time();
    $curbtime = strftime("%Y",$curbtime).strftime("%m",$curbtime).strftime("%d",$curbtime)."_".strftime("%H",$curbtime).strftime("%M",$curbtime).strftime("%S",$curbtime);

    $clbakdb = $GLOBALS["dbname"];
    $clbakfile = "calogic_".$clbakdb."_backup_structure_and_data_".$curbtime.".sql.gz";


    if ($user->gsv("isadmin") != 1 && $GLOBALS["demomode"] == false) {

        print $GLOBALS["htmldoctype"];
        print "<html>\n";
        print "<head>\n";

        print "<title>Error</title>\n";
        print "</head>\n";
        print "<body  ".$GLOBALS["sysbodystyle"].">\n";
        print "<center><br><h3>You are not an Admin!</h3></center>";
        print "<br><br>";
        include($GLOBALS["CLPath"]."/include/footer.php");
        exit();
    }
?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<title>CaLogic - Database Maintenance</title>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

var bkdt = "<?php print $curbtime; ?>";
var bkdb = "<?php print $clbakdb; ?>";
var xnf = "";

function dobackup_onclick() {

    var xnf = "";
    dbmtype.value=1;

    compressyes.disabled = false;
    compressno.disabled = false;

    document.all.tablesall.disabled = false;
    document.all.tablescalogic.disabled = false;

    document.all.cldata.disabled = false;
    document.all.structure.disabled = false;

    downloadyes.disabled = false;
    downloadno.disabled = false;

    fmtcalogic.disabled = false;
    fmtsql.disabled = false;


    if (tabtype.value == 1) {
        xnf = "calogic_" + bkdb + "_backup_";
    } else {
        xnf = "database_" + bkdb + "_backup_"
    }

    if (strtype.value == 1) {
        xnf += "structure_and_data_";
    } else {
        xnf += "structure_only_";
    }

    xnf += bkdt;

    if (cmptype.value == 1) {
        xnf += ".sql.gz";
    } else {
        xnf += ".sql";
    }

    filename.value = xnf;


}

function dorestore_onclick() {

    filename.value = "";

    dbmtype.value=2;

    compressyes.checked = true;
    compressyes.disabled = true;
    compressno.disabled = true;
    cmptype.value=1;

    tablesall.disabled = true;
    tablescalogic.disabled = true;
    tablesall.checked = true;
    tabtype.value=1;

    cldata.disabled = true;
    structure.disabled = true;
    cldata.checked = true;
    strtype.value=1;

    downloadyes.disabled = true;
    downloadno.disabled = true;

    fmttype.value=1;
    fmtcalogic.checked = true;
    fmtcalogic.disabled = true;
    fmtsql.disabled = true;


}

function compressyes_onclick() {
    cmptype.value=1;
    dobackup_onclick();
}

function compressno_onclick() {
    cmptype.value=2;
    dobackup_onclick();
}

function tablescalogic_onclick() {
    tabtype.value=1;
    dobackup_onclick();
}

function tablesall_onclick() {
    tabtype.value=2;
    dobackup_onclick();
}

function data_onclick() {
    strtype.value=1;
    dobackup_onclick();
}

function structure_onclick() {
    strtype.value=2;
    dobackup_onclick();
}

function downloadyes_onclick() {
    dlntype.value=1;
}

function downloadno_onclick() {
    dlntype.value=2;
}

function fmtcalogic_onclick() {
    fmttype.value=1;
}

function fmtsql_onclick() {
    fmttype.value=2;
}


function trim(value) {

 startpos=0;

 while((value.charAt(startpos)==" ")&&(startpos<value.length)) {
   startpos++;
 }
 if(startpos==value.length) {
   value="";
 } else {
   value=value.substring(startpos,value.length);
   endpos=(value.length)-1;
   while(value.charAt(endpos)==" ") {
     endpos--;
   }
   value=value.substring(0,endpos+1);
 }
 return(value);
}
<?php
if($GLOBALS["demomode"] == false || $user->gsv("isadmin")==1 ) {
?>

function dothejob_onclick() {

    dothejob.disabled = true;
    cancelthejob.disabled = true;

	if(trim(filename.value) =="") {
		alert("Please enter a file name");
		return false;
	} else {
            if(dbmtype.value==1) {
                //var xurl="doclsqlbak.php?filename=" + filename.value + "&cmptype=" + cmptype.value + "&tabtype=" + tabtype.value + "&strtype=" + strtype.value + "&dlntype=" + dlntype.value + "&fmttype=" + fmttype.value;
                message.innerHTML = "<b>Performing backup, please wait....</b>";
                var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=doclbackup&filename=" + filename.value + "&cmptype=" + cmptype.value + "&tabtype=" + tabtype.value + "&strtype=" + strtype.value + "&dlntype=" + dlntype.value + "&fmttype=" + fmttype.value;
                var xarg = filename.value;
                var sFeatures="dialogHeight: 495px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
                extretval = window.showModalDialog(xurl, xarg, sFeatures);
                message.innerHTML = "&nbsp;";
                alert("Backup finished");

            } else {
//                var xurl="doclsqlres.php?filename=" + filename.value;
                message.innerHTML = "<b>Performing restore, please wait....</b>";
                var xurl="<?php print $GLOBALS["idxfile"]; ?>?gosfuncs=1&qjump=doclrestore&filename=" + filename.value ;
                var xarg = filename.value;
                var sFeatures="dialogHeight: 495px; dialogWidth: 450px;  help: 0; resizable: 1; status: 0;";
                extretval = window.showModalDialog(xurl, xarg, sFeatures);
                message.innerHTML = "&nbsp;";
                alert("Restore finished");

            }
	}

    dothejob.disabled = false;
    cancelthejob.disabled = false;

}
<?php
}
?>
function cancelthejob_onclick() {
//	alert("job cancled");
	var xurl = "<?php print $GLOBALS["idxfile"]; ?>";
	document.location.href=xurl;
}

//-->
</SCRIPT>
</head>
<body <?php print $GLOBALS["sysbodystyle"]; ?>>
<h1>CaLogic - Database Maintenance</h1>
Use this program to backup your CaLogic database.<br>
The backup file will be created in the CaLogic root folder,<br>
and can be downloaded if desired.<br><br>
"CaLogic PHP" formated files can be restored with this tool.<br>
"SQL Format" formated files can be restored using a tool<br>
such as phpMyAdmin.<br><br>
<?php
if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
    print "<h3>NOTE: This function is deactivated while in demo mode.</h3>";
}
?>
<input type="hidden" id="dbmtype" name="dbmtype" value="1">
<input type="hidden" id="cmptype" name="cmptype" value="1">
<input type="hidden" id="tabtype" name="tabtype" value="1">
<input type="hidden" id="strtype" name="strtype" value="1">
<input type="hidden" id="dlntype" name="dlntype" value="1">
<input type="hidden" id="fmttype" name="fmttype" value="1">

<TABLE WIDTH="50%" BORDER="1" CELLSPACING="1" CELLPADDING="1">
	<TR>
		<TH>Enter file name</TH>
		<TD>
		<INPUT size="100" type="text" ID="filename" NAME="filename" value="<?php echo $clbakfile ?>">
		</TD>
	</TR>
	<TR>
		<TH>Job Type</TH>
		<TD>
		<INPUT checked type="radio" ID="dobackup" VALUE="Backup" NAME="jobtype" onclick="return dobackup_onclick()">
		<LABEL for="dobackup" value="Backup Database">Backup Database</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="radio" ID="dorestore" VALUE="Restore" NAME="jobtype" onclick="return dorestore_onclick()">
		<LABEL for="dorestore" value="Restore Database">Restore Database</LABEL>
		</TD>
	</TR>

	<TR>
		<TH>Use GZip compression</TH>
		<TD>
		<INPUT checked type="radio" ID="compressyes" VALUE="compressyes" NAME="compression" onclick="return compressyes_onclick()">
		<LABEL for="compressyes" value="Yes">Yes</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="radio" ID="compressno" VALUE="compressno" NAME="compression" onclick="return compressno_onclick()">
		<LABEL for="compressno" value="No">No</LABEL>
		</TD>
	</TR>

	<TR>
		<TH>Tables</TH>
		<TD>
		<INPUT checked type="radio" ID="tablescalogic" VALUE="tablescalogic" NAME="optiontables" onclick="return tablescalogic_onclick()">
		<LABEL for="tablescalogic" value="Only CaLogic">Only CaLogic Tables</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="radio" ID="tablesall" VALUE="tablesall" NAME="optiontables" onclick="return tablesall_onclick()">
		<LABEL for="tablesall" value="All Tables">All Tables</LABEL>
		</TD>
	</TR>

	<TR>
		<TH>Structure</TH>
		<TD>
		<INPUT checked type="radio" ID="cldata" VALUE="cldata" NAME="optiondata" onclick="return data_onclick()">
		<LABEL for="cldata" value="cldata">Structure and Data</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="radio" ID="structure" VALUE="structure" NAME="optiondata" onclick="return structure_onclick()">
		<LABEL for="structure" value="structure">Only Table Structures</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		</TD>
	</TR>

	<TR>
		<TH>Download</TH>
		<TD>
		<INPUT checked type="radio" ID="downloadyes" VALUE="downloadyes" NAME="download" onclick="return downloadyes_onclick()">
		<LABEL for="downloadyes" value="Yes">Yes</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="radio" ID="downloadno" VALUE="downloadno" NAME="download" onclick="return downloadno_onclick()">
		<LABEL for="downloadno" value="No">No</LABEL>
		</TD>
	</TR>

	<TR>
		<TH>File Format</TH>
		<TD>
		<INPUT checked type="radio" ID="fmtcalogic" VALUE="fmtcalogic" NAME="filefmt" onclick="return fmtcalogic_onclick()">
		<LABEL for="fmtcalogic" value="fmtcalogic">CaLogic PHP</LABEL>&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="radio" ID="fmtsql" VALUE="fmtsql" NAME="filefmt" onclick="return fmtsql_onclick()">
		<LABEL for="fmtsql" value="fmtsql">SQL Format</LABEL>
		</TD>
	</TR>

<?php
$disablebut = "";
if($GLOBALS["demomode"] == true && $user->gsv("isadmin")!=1 ) {
    $disablebut = " disabled ";
}
?>

	<TR>
		<TH valign="center">
		Execute?</TH>
		<TD valign="center">
		<br>
		<INPUT <?php print $disablebut; ?> type="button" value="Execute" ID="dothejob" NAME="dothejob" onclick="return dothejob_onclick()">&nbsp;&nbsp;&nbsp;&nbsp;
		<INPUT type="button" value="Go to Calendar" ID="cancelthejob" NAME="cancelthejob" onclick="return cancelthejob_onclick()">
		<br><br>
                <div id="message" name = "message">&nbsp;</div>
		</TD>
	</TR>
</TABLE>
<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");

}
?>
