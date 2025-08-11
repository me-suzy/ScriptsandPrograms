<?php

function automation_create_user($calogickey,$uservalsnew,$createcalendar=1) {
global $cldb;

$sqlres = "";
$rowcount = "";
$row = "";
$eoq = false;

/*
  function to create a user using automation
  by default, this function will also create a calendar for the user
  set $createcalendar to 0 (zero) to disable calendar creation

parameters
  $calogickey must be set to the same value of the calogic_uid field in the
  _setup table

  $uservalsnew must be an array

$createcalendar: 0 = do not create calendar, 1 = create calendar


Function Return value:
  returns an array with 3 keys:

  result: true when success, false when an error happened
  $array["result"] = true;

  # the error message in text format
  $array["message"] = "Error message in text format";

  # the error message in HTML format
  $array["messagehtml"] = "Error message in HTML format";



$uservalsnew array explanation:

  # a unique user name that is not yet present in CaLogic
  $uservalsnew["username"] = "username";

  # first name must not be blank
  $uservalsnew["firstname"] = "Philip";

  # last name must not be blank
  $uservalsnew["lastname"] = "Boone";

  # Email address must not be blank and must not yet exist in CaLogic
  # The email address syntax will also get checked
  $uservalsnew["email"] = "philip@calogic.de";

  # Email type defaults to HTML if empty or invalid
  # valid values are HTML, TEXT. or SMS
  $uservalsnew["emailtype"] = "HTML";

  # password in plain text
  # when empty will default to the user name
  $uservalsnew["password"] = "password";

  # Force user to create a new password upon next login
  # 0 (zero) = no, 1 (one) = yes
  # will default to NO when empty or invalid
  $uservalsnew["forcenewpassword"] = 0;

  # Language name must exist in CaLogic
  # Defaults to the standard language when empty
  $uservalsnew["languagename"] = "English";


*/

    $haveerror = false;
    $retobj["result"] = false;
    $retobj["messagehtml"] = "";
    $retobj["message"] = "";


    $sqlstr = "select calogic_uid from ".$GLOBALS["tabpre"]."_setup";
    $qu_res = mysql_query($sqlstr);

    if(mysql_errno() != 0) {
        $retobj["message"] .= "Function error.\n";
        $haveerror = true;
    }

    if($haveerror == false) {
        $row = mysql_fetch_array($qu_res);
        @mysql_free_result($qu_res);

        if($row["calogic_uid"] != $calogickey) {
            $retobj["message"] .= "Function error.\n";
            $haveerror = true;
        }
    }

    if($haveerror == false) {


        if(!is_array($uservalsnew)) {
            $retobj["message"] .= "No array given.\n";
            $haveerror = true;
        }

        if(!isset($uservalsnew["username"])) {
            $retobj["message"] .= "User name not set.\n";
            $haveerror = true;

        }elseif(strlen(trim($uservalsnew["username"])) == 0) {
            $retobj["message"] .= "User name is blank.\n";
            $haveerror = true;
        }

        for($xl=0;$xl<strlen($uservalsnew["username"]);$xl++) {
            if(ereg("^[^a-zA-Z0-9]$",substr($uservalsnew["username"],$xl,1))) {
                $retobj["message"] .= "User name has invalid characters, only leters and numers are allowed.\n";
                $haveerror = true;
            }
        }

        if($haveerror == false) {
            $sqlstr = "select count(*) as usercount from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$uservalsnew["username"]."'";
            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {

                $retobj["message"] .= "Cannot query User Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;

            }

            $row = mysql_fetch_array($qu_res);
            @mysql_free_result($qu_res);
            $usercount = $row["usercount"];


            if($usercount != 0) {
                $retobj["message"] .= "User name already exists.\n";
                $haveerror = true;
            }
        }

        if(!isset($uservalsnew["firstname"])) {
            $retobj["message"] .= "First name name not set.\n";
            $haveerror = true;
        }elseif(strlen(trim($uservalsnew["firstname"])) == 0) {
            $retobj["message"] .= "First name is blank.\n";
            $haveerror = true;
        }

        if(!isset($uservalsnew["lastname"])) {
            $retobj["message"] .= "Last name not set.\n";
            $haveerror = true;
        }elseif(strlen(trim($uservalsnew["lastname"])) == 0) {
            $retobj["message"] .= "Last name is blank.\n";
            $haveerror = true;
        }

        if(!isset($uservalsnew["email"])) {
            $retobj["message"] .= "Email address not set.\n";
            $haveerror = true;
        }elseif(strlen(trim($uservalsnew["email"])) == 0) {
            $retobj["message"] .= "Email is blank.\n";
            $haveerror = true;
        }

        if(!emailok($uservalsnew["email"])) {
            $retobj["message"] .= "Email syntax is not valid.\n";
            $haveerror = true;
        }


        if($haveerror == false) {

            $sqlstr = "select count(*) as emailcount from ".$GLOBALS["tabpre"]."_user_reg where email = '".$uservalsnew["email"]."'";
            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {

                $retobj["message"] .= "Cannot query User Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;

            }
            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $emailcount = $row["emailcount"];
                if($emailcount != 0) {
                    $retobj["message"] .= "Email address already exists.\n";
                    $haveerror = true;
                }
            }
        }

        if(!isset($uservalsnew["emailtype"])) {
            $uservalsnew["emailtype"] = "HTML";
        }elseif($uservalsnew["emailtype"] != "HTML" && $uservalsnew["emailtype"] != "TEXT" && $uservalsnew["emailtype"] != "SMS") {
            $uservalsnew["emailtype"] = "HTML";
        }

        if(!isset($uservalsnew["password"])) {
            $uservalsnew["password"] = $uservalsnew["username"];
        }elseif(strlen(trim($uservalsnew["password"])) == 0) {
            $uservalsnew["password"] = $uservalsnew["username"];
        }

        if(!isset($uservalsnew["forcenewpassword"])) {
            $uservalsnew["forcenewpassword"] = 0;
        }elseif(strlen(trim($uservalsnew["password"])) == 0) {
            $uservalsnew["forcenewpassword"] = 0;
        }elseif($uservalsnew["forcenewpassword"] != 0 && $uservalsnew["forcenewpassword"] != 1) {
            $uservalsnew["forcenewpassword"] = 0;
        }

        if(!isset($uservalsnew["languagename"])) {
            $uservalsnew["languagename"] = "not set";
            $uservalsnew["languageid"] = $GLOBALS["standardlangid"];

        }elseif(strlen(trim($uservalsnew["languagename"])) == 0) {
            $uservalsnew["languagename"] = "not set";
            $uservalsnew["languageid"] = $GLOBALS["standardlangid"];
        }


        if($uservalsnew["languagename"] == "not set") {

            $sqlstr = "select *  from ".$GLOBALS["tabpre"]."_languages where uid = '".$uservalsnew["languageid"]."'";
            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {

                $retobj["message"] .= "Cannot query Language Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;

            }

            if($haveerror == false) {
                $row = mysql_fetch_array($qu_res);
                $num_rows = mysql_num_rows($qu_res);
                @mysql_free_result($qu_res);

                if($num_rows != 1) {

                    $retobj["message"] .= "Language ID Table Query failed\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                    $haveerror = true;

                } else {
                    $uservalsnew["languagename"] = $row["name"];
                }
            }

        } else {

            $sqlstr = "select *  from ".$GLOBALS["tabpre"]."_languages where name = '".$uservalsnew["languagename"]."'";
            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {

                $retobj["message"] .= "Cannot query Language Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;

            }
            if($haveerror == false) {
                $row = mysql_fetch_array($qu_res);
                $num_rows = mysql_num_rows($qu_res);
                @mysql_free_result($qu_res);

                if($num_rows != 1) {

                    $retobj["message"] .= "Language Name Table Query failed\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                    $haveerror = true;

                } else {
                    $uservalsnew["languageid"] = $row["uid"];
                }
            }
        }


        if($haveerror == false) {

            $uservalsnew = gmqfmt($uservalsnew,2);

            $regtime = time();
            $key = md5(uniqid(rand(), true));

            $xmdpw = md5($uservalsnew["password"]);

            if($GLOBALS["forcedefaultcal"] == 1) {
                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_reg
                (uname,fname,lname,email,emailtype,pw,emok,langid,language,regtime,regkey,isadmin,startcalid,startcalname)
                values('".$uservalsnew["username"]."','".$uservalsnew["firstname"]."','".$uservalsnew["lastname"]."','".$uservalsnew["email"]."','".$uservalsnew["emailtype"]."','".$xmdpw."',1,".$uservalsnew["languageid"].",'".$uservalsnew["languagename"]."',".$regtime.",'".$key."',0,'".$GLOBALS["defaultcalid"]."','".fmtfordb($GLOBALS["defaultcalname"],2)."')";

            } else {

                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_reg
                (uname,fname,lname,email,emailtype,pw,emok,langid,language,regtime,regkey,isadmin)
                values('".$uservalsnew["username"]."','".$uservalsnew["firstname"]."','".$uservalsnew["lastname"]."','".$uservalsnew["email"]."','".$uservalsnew["emailtype"]."','".$xmdpw."',1,".$uservalsnew["languageid"].",'".$uservalsnew["languagename"]."',".$regtime.",'".$key."',0)";
            }

            mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot insert to user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
        }
    }

    if($haveerror == true) {
        $retobj["result"] = false;
    } else {
        $retobj["result"] = true;
        $retobj["message"] = "User created\n\n";
        if($createcalendar == 1) {

            $retobj["message"] .= "Creating Calendar\n\n";
            $calcreate = automation_create_calendar($calogickey,$uservalsnew["username"]);
            $retobj["result"] = $calcreate["result"];
            $retobj["message"] .= $calcreate["message"];

        }
    }

    $retobj["messagehtml"] = nl2br($retobj["message"]);

    return($retobj);

}

function automation_delete_user($calogickey,$usernamedelete="",$useriddelete="") {
global $cldb;

/*
  function to delete a user using automation

Parameters:
  $calogickey must be set to the same value of the calogic_uid field in the
  _setup table

$usernamedelete = the CaLogic User name to delete
$useriddelete = the CaLogic user ID of the user to delete

one of these values must be set.

Function Return value:
  returns an array with 3 keys:

  result: true when success, false when an error happened
  $array["result"] = true;

  # the error message in text format
  $array["message"] = "Error message in text format";

  # the error message in HTML format
  $array["messagehtml"] = "Error message in HTML format";



*/

    $haveerror = false;
    $retobj["result"] = false;
    $retobj["messagehtml"] = "";
    $retobj["message"] = "";


    $sqlstr = "select calogic_uid from ".$GLOBALS["tabpre"]."_setup";
    $qu_res = mysql_query($sqlstr);

    if(mysql_errno() != 0) {
        $retobj["message"] .= "Function error.\n";
        $haveerror = true;
    }

    if($haveerror == false) {
        $row = mysql_fetch_array($qu_res);
        @mysql_free_result($qu_res);

        if($row["calogic_uid"] != $calogickey) {
            $retobj["message"] .= "Function error.\n";
            $haveerror = true;
        }
    }

    if($haveerror == false) {

        if(!isset($usernamedelete) && !isset($useriddelete)) {
            $retobj["message"] .= "User name and ID not set.\n";
            $haveerror = true;
        }elseif(strlen(trim($useriddelete)) > 0) {

        }elseif(strlen(trim($usernamedelete)) > 0) {

            $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$usernamedelete."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $useriddelete = $row["uid"];
            }

        } else {
            $retobj["message"] .= "User name and ID are blank.\n";
            $haveerror = true;
        }

        if($haveerror == false) {

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_cat where uid = ".$useriddelete;
            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from category table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where uid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from contact group link table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr);
            }

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from contact groups table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con where uid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from contacts table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr) ;
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from calendar event reminders table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_events where uid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from calendar events table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from calendar table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$useriddelete;
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from user table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

        }

    }

    if($haveerror == true) {
        $retobj["result"] = false;
    } else {
        $retobj["result"] = true;
        $retobj["message"] = "User deleted";
    }


    $retobj["messagehtml"] = nl2br($retobj["message"]);

    return($retobj);

}

function automation_create_calendar($calogickey,$usernamenewcal="",$calnamenewcal="",$caltitelnewcal="",$useridnewcal="") {
global $cldb;

/*
  function to create a calendar using automation

parameters
  $calogickey must be set to the same value of the calogic_uid field in the
  _setup table


$usernamenewcal (optional) = user name for which the calendar is to be created (user must exist)
$calnamenewcal (optional) = Calendar name of new calendar, defaults to user name, must be unique for user
$caltitelnewcal (optional) = Calendar title of new calendar, defaults to user name
$useridnewcal (optional) = CaLogic User ID for which the calendar is to be created (ID must exist),
                           defaults to ID of the user name given

Either the user name or user ID must be given.


Function Return value:
  returns an array with 3 keys:

  result: true when success, false when an error happened
  $array["result"] = true;

  # the error message in text format
  $array["message"] = "Error message in text format";

  # the error message in HTML format
  $array["messagehtml"] = "Error message in HTML format";


*/


    $haveerror = false;
    $retobj["result"] = false;
    $retobj["messagehtml"] = "";
    $retobj["message"] = "";


    $sqlstr = "select calogic_uid from ".$GLOBALS["tabpre"]."_setup";
    $qu_res = mysql_query($sqlstr);

    if(mysql_errno() != 0) {
        $retobj["message"] .= "Function error.\n";
        $haveerror = true;
    }

    if($haveerror == false) {
        $row = mysql_fetch_array($qu_res);
        @mysql_free_result($qu_res);

        if($row["calogic_uid"] != $calogickey) {
            $retobj["message"] .= "Function error.\n";
            $haveerror = true;
        }
    }

    if($haveerror == false) {

        if(!isset($usernamenewcal) && !isset($useridnewcal)) {
            $retobj["message"] .= "User name and ID not set.\n";
            $haveerror = true;
        }elseif(strlen(trim($useridnewcal)) > 0) {

            $sqlstr = "select uname from ".$GLOBALS["tabpre"]."_user_reg where uid = '".$useridnewcal."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $usernamenewcal = $row["uname"];
            }

        }elseif(strlen(trim($usernamenewcal)) > 0) {

            $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$usernamenewcal."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $useridnewcal = $row["uid"];
            }

        } else {
            $retobj["message"] .= "User name and ID are blank.\n";
            $haveerror = true;
        }

        if($haveerror == false) {

            if(strlen(trim($calnamenewcal)) < 1) {
                $calnamenewcal = $usernamenewcal;
            }

            if(strlen(trim($caltitelnewcal)) < 1) {
                $caltitelnewcal = $usernamenewcal;
            }

            $sqlstr = "select count(*) calcount from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$useridnewcal." and calname = '".$calnamenewcal."'";
            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot query Calendar Config Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            $row = mysql_fetch_array($qu_res);
            @mysql_free_result($qu_res);
            $calcount = $row["calcount"];

            if($calcount != 0) {
                $retobj["message"] .= "Calendar name $calnamenewcal already exists for user $usernamenewcal.\n";
                $haveerror = true;
            }
        }

        if($haveerror == false) {

            $new_cal = getcalvals("0");
            srand((double)microtime()*1000000);
            $newcalid = md5(uniqid(rand()));
            $new_cal["calid"] = $newcalid;
            $new_cal["calname"] = $calnamenewcal;
            $new_cal["caltitle"] = $caltitelnewcal;
            $new_cal["userid"] = $useridnewcal;
            $new_cal["username"] = $usernamenewcal;
            $new_cal["caltype"] = "2";
            $new_cal["gcscoif_standardbgimg"] = $standardbgimg;

            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_ini (tuid";
            foreach($new_cal as $k1 => $v1) {
                if($k1<>"tuid") {
                    $sqlstr .= ",".$k1;
                }
            }
            $sqlstr .= ") values (''";

            foreach($new_cal as $k1 => $v1) {
                if($k1<>"tuid") {
                    $sqlstr .= ",'".$v1."'";
                }
            }
            $sqlstr .= ")";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot save Calendar Config\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $sqlstr = "UPDATE ".$GLOBALS["tabpre"]."_user_reg set startcalid = '$newcalid', startcalname = '".$calnamenewcal."' where uid = ".$useridnewcal." limit 1";
                $qu_res = mysql_query($sqlstr);

                if(mysql_errno() != 0) {
                    $retobj["message"] .= "Cannot save Calendar Config in User Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                    $haveerror = true;
                }
            }
        }

    }

    if($haveerror == true) {
        $retobj["result"] = false;
    } else {
        $retobj["result"] = true;
        $retobj["message"] = "Calendar created.";
    }


    $retobj["messagehtml"] = nl2br($retobj["message"]);

    return($retobj);
}

function automation_delete_calendar($calogickey,$usernamecaldelete="",$useridcaldelete="",$calnamedelete="",$caliddelete="") {
global $cldb;

/*
  function to delete a calendar using automation

parameters
  $calogickey must be set to the same value of the calogic_uid field in the
  _setup table

$usernamecaldelete (optional) = user name for which the calendar is to be deleted (user must exist)
$useridcaldelete (optional) = CaLogic User ID for which the calendar is to be deleted (ID must exist),
                              defaults to ID of the user name given
$calnamedelete (optional) = Calendar name of calendar to be deleted, defaults to calendar ID of user calendar name given
$caliddelete (optional) = Calendar ID of calendar to delete, defaults to calendar ID of calendar name given.


Either the user name or user ID must be given.
Either the calendar name or ID must be given.


Function Return value:
  returns an array with 3 keys:

  result: true when success, false when an error happened
  $array["result"] = true;

  # the error message in text format
  $array["message"] = "Error message in text format";

  # the error message in HTML format
  $array["messagehtml"] = "Error message in HTML format";


*/

    $haveerror = false;
    $retobj["result"] = false;
    $retobj["messagehtml"] = "";
    $retobj["message"] = "";


    $sqlstr = "select calogic_uid from ".$GLOBALS["tabpre"]."_setup";
    $qu_res = mysql_query($sqlstr);

    if(mysql_errno() != 0) {
        $retobj["message"] .= "Function error.\n";
        $haveerror = true;
    }

    if($haveerror == false) {
        $row = mysql_fetch_array($qu_res);
        @mysql_free_result($qu_res);

        if($row["calogic_uid"] != $calogickey) {
            $retobj["message"] .= "Function error.\n";
            $haveerror = true;
        }
    }

    if($haveerror == false) {

        if(!isset($usernamecaldelete) && !isset($useridcaldelete)) {
            $retobj["message"] .= "User name and ID not set.\n";
            $haveerror = true;

        }elseif(strlen(trim($useridcaldelete)) > 0) {

            $sqlstr = "select uname from ".$GLOBALS["tabpre"]."_user_reg where uid = '".$useridcaldelete."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $usernamecaldelete = $row["uname"];
            }

        }elseif(strlen(trim($usernamecaldelete)) > 0) {

            $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$usernamecaldelete."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $useridcaldelete = $row["uid"];
            }

        } else {
            $retobj["message"] .= "User name and ID are blank.\n";
            $haveerror = true;
        }

        if($haveerror == false) {

            if(!isset($calnamedelete) && !isset($caliddelete)) {
                $retobj["message"] .= "Calendar name and ID not set.\n";
                $haveerror = true;

            }elseif(strlen(trim($caliddelete)) > 0) {

                $sqlstr = "select calname from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$caliddelete."' and userid='".$useridcaldelete."'" ;

                $qu_res = mysql_query($sqlstr);

                if(mysql_errno() != 0) {
                    $retobj["message"] .= "Cannot select from calendar table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                    $haveerror = true;
                }

                if($haveerror == false) {

                    $row = mysql_fetch_array($qu_res);
                    @mysql_free_result($qu_res);
                    $calnamedelete = $row["calname"];
                }

            }elseif(strlen(trim($calnamedelete)) > 0) {

                $sqlstr = "select calid from ".$GLOBALS["tabpre"]."_cal_ini where calname = '".$calnamedelete."' and userid='".$useridcaldelete."'" ;

                $qu_res = mysql_query($sqlstr);

                if(mysql_errno() != 0) {
                    $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                    $haveerror = true;
                }

                if($haveerror == false) {

                    $row = mysql_fetch_array($qu_res);
                    @mysql_free_result($qu_res);
                    $caliddelete = $row["calid"];
                }

            } else {
                $retobj["message"] .= "Calendar name and ID are blank.\n";
                $haveerror = true;
            }
        }

        if($haveerror == false) {

            $sqlstr = "select count(*) as calusercount from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$caliddelete."' and userid='".$useridcaldelete."'" ;

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from calendar table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $calusercount = $row["calusercount"];

                if($calusercount != 1) {
                    $retobj["message"] .= "Calendar ID and user ID do not match.\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                    $haveerror = true;
                }

            }

        }


        if($haveerror == false) {

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where calid = '".$caliddelete."'";
            $qu_res = mysql_query($sqlstr) ;

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from calendar event reminders table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_events where calid = '".$caliddelete."'";
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from calendar events table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_ini where calid = '".$caliddelete."'";
                $qu_res = mysql_query($sqlstr);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot delete from calendar table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }
            if($haveerror == false) {
                $sqlstr = "UPDATE ".$GLOBALS["tabpre"]."_user_reg set udefscid='', udefscname='' where udefscid='".$caliddelete."'";
                $qu_res = mysql_query($sqlstr) or die("Cannot Update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot Update User Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {
                $sqlstr = "UPDATE ".$GLOBALS["tabpre"]."_user_reg set startcalid=udefscid, startcalname=udefscname where startcalid='".$caliddelete."'";
                $qu_res = mysql_query($sqlstr) or die("Cannot Update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot Update User Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

        }

    }

    if($haveerror == true) {
        $retobj["result"] = false;
    } else {
        $retobj["result"] = true;
        $retobj["message"] = "Calendar deleted";
    }


    $retobj["messagehtml"] = nl2br($retobj["message"]);

    return($retobj);
}

function automation_user_logon($calogickey,$usernamelogon="",$useridlogon="") {
global $cldb;

/*
  function to log a user on using automation

parameters
  $calogickey must be set to the same value of the calogic_uid field in the
  _setup table

$usernamelogon (optional) = user name to log on (user must exist)
$useridlogon (optional) = CaLogic User ID to log on (ID must exist),

Either the user name or user ID must be given.


Function Return value:
  returns an array with 3 keys:

  result: true when success, false when an error happened
  $array["result"] = true;

  # the error message in text format
  $array["message"] = "Error message in text format";

  # the error message in HTML format
  $array["messagehtml"] = "Error message in HTML format";


*/

    $haveerror = false;
    $retobj["result"] = false;
    $retobj["messagehtml"] = "";
    $retobj["message"] = "";


    $sqlstr = "select calogic_uid from ".$GLOBALS["tabpre"]."_setup";
    $qu_res = mysql_query($sqlstr);

    if(mysql_errno() != 0) {
        $retobj["message"] .= "Function error.\n";
        $haveerror = true;
    }

    if($haveerror == false) {
        $row = mysql_fetch_array($qu_res);
        @mysql_free_result($qu_res);

        if($row["calogic_uid"] != $calogickey) {
            $retobj["message"] .= "Function error.\n";
            $haveerror = true;
        }
    }

    if($haveerror == false) {

        if(!isset($usernamelogon) && !isset($useridlogon)) {
            $retobj["message"] .= "User name and ID not set.\n";
            $haveerror = true;

        }elseif(strlen(trim($useridlogon)) > 0) {

            $sqlstr = "select uname from ".$GLOBALS["tabpre"]."_user_reg where uid = '".$useridlogon."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $usernamelogon = $row["uname"];
            }

        }elseif(strlen(trim($usernamelogon)) > 0) {

            $sqlstr = "select uid from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$usernamelogon."'";

            $qu_res = mysql_query($sqlstr);

            if(mysql_errno() != 0) {
                $retobj["message"] .= "Cannot select from user Table\n\nMySQL said: ".mysql_error()."\n\nSQL String: ".$sqlstr."\n\nFile: ".substr(__FILE__,strrpos(__FILE__,"/"))."\n\nLine: ".__LINE__.$GLOBALS["errep"]."\n";
                $haveerror = true;
            }

            if($haveerror == false) {

                $row = mysql_fetch_array($qu_res);
                @mysql_free_result($qu_res);
                $useridlogon = $row["uid"];
            }

        } else {
            $retobj["message"] .= "User name and ID are blank.\n";
            $haveerror = true;
        }

        if($haveerror == false) {

            $GLOBALS["login"] = 1;
            $GLOBALS["uname"] = $usernamelogon;
            $_POST["emulateuser"] = "1";
            $_POST["clseckey"] = $calogickey;
            $_POST["username"] = $usernamelogon;

        }

    }


    if($haveerror == true) {
        $retobj["result"] = false;
    } else {
        $retobj["result"] = true;
        $retobj["message"] = "User log on follows";
    }


    $retobj["messagehtml"] = nl2br($retobj["message"]);

    return($retobj);
}

?>
