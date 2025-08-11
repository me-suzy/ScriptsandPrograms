<?php
/***************************************************************
**  this section brings up the special functions forms
***************************************************************/


/*

#***************************************************************
#**  save contact
#***************************************************************
    if(isset($savecon)) {
        global $conbem, $conbemady;
        $conbem = false;
        $conbemady = "";


        if(!emailok(mqfix($conemail))) {
            $conbem = true;
            $conbemady = mqfix($conemail);
        }

        $congp = fmtfordb(mqfix($congp),2);
        $confname = fmtfordb(mqfix($confname),2);
        $conlname = fmtfordb(mqfix($conlname),2);
        $conemail = fmtfordb(mqfix($conemail),2);
        $conbday = fmtfordb(mqfix($conbday),2);
        $ucaltzadj = fmtfordb(mqfix($ucaltzadj),2);
        $contel1 = fmtfordb(mqfix($contel1),2);
        $contel2 = fmtfordb(mqfix($contel2),2);
        $contel3 = fmtfordb(mqfix($contel3),2);
        $confax = fmtfordb(mqfix($confax),2);
        $conadr = fmtfordb(mqfix($conadr),2);

        $ucaltzadj = ($contzos * 60 * 60) - $user->gsv("servertz");

        if(!isset($conlist)) {
            if(!isset($congp)) {$congp = "0";}
            if($conbem == true) {
                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_con (uid,congp,fname,lname,bday,tzos,tel1,tel2,tel3,fax,address) values(".$user->gsv("cuid").",$congp,'".$confname."','".$conlname."','".$conbday."',".$ucaltzadj.",'".$contel1."','".$contel2."','".$contel3."','".$confax."','".$conadr."')";
            } else {
                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_con (uid,congp,fname,lname,email,bday,tzos,tel1,tel2,tel3,fax,address) values(".$user->gsv("cuid").",$congp,'".$confname."','".$conlname."','".$conemail."','".$conbday."',".$ucaltzadj.",'".$contel1."','".$contel2."','".$contel3."','".$confax."','".$conadr."')";
            }
        } else {
            $conpars = explode("|",$conlist);
            if($conbem == true) {
                $sqlstr = "update ".$GLOBALS["tabpre"]."_user_con set congp=$congp,fname='$confname',lname='$conlname',bday='$conbday',tzos=$ucaltzadj,tel1='$contel1',tel2='$contel2',tel3='$contel3',fax='$confax',address='$conadr' where uid=".$user->gsv("cuid")." and conid=".$conpars[0]." limit 1";
            } else {
                $sqlstr = "update ".$GLOBALS["tabpre"]."_user_con set congp=$congp,fname='$confname',lname='$conlname',email='$conemail',bday='$conbday',tzos=$ucaltzadj,tel1='$contel1',tel2='$contel2',tel3='$contel3',fax='$confax',address='$conadr' where uid=".$user->gsv("cuid")." and conid=".$conpars[0]." limit 1";
            }
        }
        $query1 = mysql_query($sqlstr) or die("Cannot update Contacts Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        editcons($user);
    }

#***************************************************************
#**  delete contact
#***************************************************************
    if(isset($deletecon)) {
        if(isset($conlist)) {
            $conpars = explode("|",$conlist);
            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con where conid=".$conpars[0]." and uid=".$user->gsv("cuid")." limit 1";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from Contacts Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where conid=".$conpars[0]." and uid=".$user->gsv("cuid")." and contyp='C'";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from event reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }
        editcons($user);
    }

#***************************************************************
#**  save new contact group
#***************************************************************
    if(isset($savenewcongp)) {
        $connewgp = fmtfordb(mqfix($connewgp),2);
        $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_con_grp (uid,gpname) values(".$user->gsv("cuid").",'$connewgp')";
        $query1 = mysql_query($sqlstr) or die("Cannot Insert into Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        editcons($user);
    }

#***************************************************************
#**  save changed contact group
#***************************************************************
    if(isset($saveeditcongp)) {
        if($congp > 0) {
            $connewgp = fmtfordb(mqfix($connewgp),2);
            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_con_grp set gpname='$connewgp' where congpid=$congp and uid=".$user->gsv("cuid")." limit 1";
            $query1 = mysql_query($sqlstr) or die("Cannot update Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }
        editcons($user);
    }

#***************************************************************
#**  delete contact group
#***************************************************************
    if(isset($deletecongpok)) {
        if($congp > 0 && $deletecongpok=="1") {
            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con_grp where congpid=$congp and uid=".$user->gsv("cuid")." limit 1";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from Contact Groups Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_con set congp=0 where congp=$congp and uid=".$user->gsv("cuid");
            $query1 = mysql_query($sqlstr) or die("Cannot update Contacts Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where conid=".$congp." and uid=".$user->gsv("cuid")." and contyp='G'";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from event reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            editcons($user);
        }
    }


*/
    if(isset($gosfuncs)) {
        unset($gosfuncs);
        if($qjump=="categories") {
            editcats($user);
        } elseif($qjump=="doclbackup") {
            include($GLOBALS["CLPath"]."/doclsqlbak.php");
            exit();
        } elseif($qjump=="doclrestore") {
            include($GLOBALS["CLPath"]."/doclsqlres.php");
            exit();
        } elseif($qjump=="histlog") {
            include($GLOBALS["CLPath"]."/viewhistlog.php");
            exit();
        } elseif($qjump=="contacts") {
            editcons($user);
        } elseif($qjump=="usersettings") {
            edituser($user);
        } elseif($qjump=="subscriptions") {

        } elseif($qjump=="cmeventgo") {


# Category check

            if($cmcatid != 0) {
                $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_user_cat where catid=".$cmcatid;
                $queryc = mysql_query($sqlstrc) or die("Cannot query user cats table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $rowc = mysql_fetch_array($queryc);
                $catcal = $rowc["calid"];
                $catuser = $rowc["uid"];
                @mysql_free_result($queryc);
                $cmcatok = false;
                if($catcal == "-2" || ($catcal == "0" && $catuser == $cmcalowner)) {
                    $cmcatok = true;
                }
            } else {
                $cmcatok = true;
            }


# Extents check

            $badextcnt = -1;
            $badext = Array();
            if($cmhasext == 1) {
                $sqlstrc = "select * from ".$GLOBALS["tabpre"]."_extents where evid=".$cmevid;
                $queryc = mysql_query($sqlstrc) or die("Cannot query extents table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrc."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                while($rowc = mysql_fetch_array($queryc)) {
                    $curexid = $rowc["exid"];

                    $sqlstrd = "select * from ".$GLOBALS["tabpre"]."_ext_def where efid=".$rowc["efid"];
                    $queryd = mysql_query($sqlstrd) or die("Cannot query extents table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrd."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $rowd = mysql_fetch_array($queryd);
                    $cxuid = $rowd["uid"];
                    $cxefid = $rowd["efid"];
                    $cxcalid = $rowd["calid"];
                    @mysql_free_result($queryd);

                    $curextchk = true;

                    # case 5
                    if($cxuid == -1 && $cxcalid == -1) {
                        $curextchk = true;
                    # case 4
                    }elseif($cxuid == -1 && $cxcalid == $cmcalowner) {
                        $curextchk = true;
                    # case 3
                    }elseif($cxuid == 0) {
                        $curextchk = false;
                        $badextcnt++;
                    # case 2
                    }elseif($cxuid == $cmevowner && $cxcalid == -1) {
                        $curextchk = true;
                    # case 1
                    }elseif($cxuid == $cmcalowner && $cxcalid == 0) {
                        $curextchk = true;
                    }else {
                        $curextchk = false;
                        $badextcnt++;
                    }

                    if($curextchk == false) {
                        $badext[$badextcnt] = $curexid;
                    }

                }
                @mysql_free_result($queryc);

            }

            if($cmaction == "move") {

                $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_events set calid = '".$cmcalid."' where evid = ".$cmevid;
                mysql_query($sqlstr) or die("Cannot update events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_event_rems set calid = '".$cmcalid."' where evid = ".$cmevid;
                mysql_query($sqlstr) or die("Cannot update event reminders table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                if($cmcatok == false) {
                    $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_events set catid = 0 where evid = ".$cmevid;
                    mysql_query($sqlstr) or die("Cannot update events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }

                for($xx=0;$xx<=$badextcnt;$xx++) {
                    $sqlstrd = "delete from ".$GLOBALS["tabpre"]."_extents where exid = ".$badext[$xx];
                    mysql_query($sqlstrd) or die("Cannot update extents table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrd."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                }

                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = $user->gsv("curcalid");
                $logentry["evid"] = $cmevid;
                $logentry["adate"] = time();
                $logentry["laction"] = "Event moved";
                $logentry["lbefore"] = $user->gsv("curcalid");
                $logentry["lafter"] = $cmcalid;
                $logentry["remarks"] = " ";
                histlog($logentry);

            } else {
# event copy
                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_events where evid = '".$cmevid."'";
                $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $res_query1 = mysql_num_rows($query1) or die("Cannot query Calendar Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                if($res_query1 > 0) {

                    $query2 = mysql_query($sqlstr) or die("Cannot query Calendar Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $res_query2 = mysql_num_rows($query2) or die("Cannot query Calendar Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $row = mysql_fetch_array($query2) or die("Cannot query Calendar Events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);

                    $i = 0;
                    $copysql = "insert into ".$GLOBALS["tabpre"]."_cal_events values (";
                    while ($i < mysql_num_fields($query1)) {
                        $meta = mysql_fetch_field($query1);
                        $fname = $meta->name;
                        if($fname == "evid") {
                            $copysql .= "''";
                        } elseif($fname == "calid") {
                            $copysql .= ",'".$cmcalid."'";
                        }else {
                            $copysql .= ",'".fmtfordb(mqfix($row["$fname"],1),2)."'";
                        }

                        $i++;
                    }
                    $copysql .= ")";

                    @mysql_free_result($query1);
                    @mysql_free_result($query2);

                    mysql_query($copysql) or die("Cannot update events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$copysql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $sqlstr = "select LAST_INSERT_ID() as cmevnewid";
                    $query1 = mysql_query($sqlstr) or die("Cannot get new event id<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $row = mysql_fetch_array($query1);
                    $cmevnewid = $row["cmevnewid"];
                    @mysql_free_result($query1);

                    if($cmcatok == false) {
                        $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_events set catid = 0 where evid = ".$cmevnewid;
                        mysql_query($sqlstr) or die("Cannot update events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    }

                }
# event rems copy
                $sqlstr1 = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where evid = '".$cmevid."'";
                $query1 = mysql_query($sqlstr1) or die("Cannot query Calendar Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr1."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $res_query1 = @mysql_num_rows($query1);

                if($res_query1 > 0) {

                    $query2 = mysql_query($sqlstr1) or die("Cannot query Calendar Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $res_query2 = mysql_num_rows($query2) or die("Cannot query Calendar Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr1."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    while ($row = @mysql_fetch_array($query2)) {

                        $i = 0;
                        $copysql = "insert into ".$GLOBALS["tabpre"]."_cal_event_rems values (";
                        while ($i < mysql_num_fields($query1)) {
                            $meta = mysql_fetch_field($query1);
                            $fname = $meta->name;
                            if($fname == "remid") {
                                $copysql .= "''";
                            } elseif($fname == "calid") {
                                $copysql .= ",'".$cmcalid."'";
                            } elseif($fname == "evid") {
                                $copysql .= ",'".$cmevnewid."'";
                            }else {
                                $copysql .= ",'".fmtfordb(mqfix($row["$fname"],1),2)."'";
                            }
                            $i++;
                        }
                        $copysql .= ")";

                        mysql_query($copysql) or die("Cannot update events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$copysql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        $sqlstr1 = "select * from ".$GLOBALS["tabpre"]."_cal_event_rems where evid = '".$cmevid."'";
                        $query1 = mysql_query($sqlstr1) or die("Cannot query Calendar Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr1."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        $res_query1 = @mysql_num_rows($query1) ;
                    }
                }
                @mysql_free_result($query1);
                @mysql_free_result($query2);

# event extents copy
                if($cmhasext == 1) {

                    $sqlstr1 = "select * from ".$GLOBALS["tabpre"]."_extents where evid = '".$cmevid."'";
                    $query1 = mysql_query($sqlstr1) or die("Cannot query Calendar Event Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr1."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $res_query1 = @mysql_num_rows($query1);

                    if($res_query1 > 0) {

                        $query2 = mysql_query($sqlstr1) or die("Cannot query Calendar Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        $res_query2 = mysql_num_rows($query2) or die("Cannot query Calendar Event Reminders Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr1."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        while ($row = @mysql_fetch_array($query2)) {

                            $i = 0;
                            $copysql = "insert into ".$GLOBALS["tabpre"]."_extents values (";
                            while ($i < mysql_num_fields($query1)) {
                                $meta = mysql_fetch_field($query1);
                                $fname = $meta->name;
                                if($fname == "exid") {
                                    $copysql .= "''";
                                } elseif($fname == "evid") {
                                    $copysql .= ",'".$cmevnewid."'";
                                }else {
                                    $copysql .= ",'".fmtfordb(mqfix($row["$fname"],1),2)."'";
                                }
                                $i++;
                            }
                            $copysql .= ")";

                            $extcopyok = true;
                            for($xx=0;$xx<=$badextcnt;$xx++) {
                                if($badext[$xx] == $row["exid"]) {
                                    $extcopyok = false;
                                }
                            }
                            if($extcopyok == true) {
                                mysql_query($copysql) or die("Cannot update events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$copysql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                            }

                            $sqlstr1 = "select * from ".$GLOBALS["tabpre"]."_extents where evid = '".$cmevid."'";
                            $query1 = mysql_query($sqlstr1) or die("Cannot query Calendar Event Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr1."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                            $res_query1 = @mysql_num_rows($query1);
                        }
                    }
                    @mysql_free_result($query1);
                    @mysql_free_result($query2);
                }

                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = $user->gsv("curcalid");
                $logentry["evid"] = $cmevid;
                $logentry["adate"] = time();
                $logentry["laction"] = "Event copied";
                $logentry["lbefore"] = $user->gsv("curcalid");
                $logentry["lafter"] = $cmcalid;
                $logentry["remarks"] = " ";
                histlog($logentry);
            }
            ?>
<?php
print $GLOBALS["htmldoctype"];
?>
            <html>

            <head>
            <title>Event changed</title>
            <script id="clientEventHandlersJS" language="javascript">
            <!--

            function window_onload() {
                window.status = "Event change saved.";
            }


            function done_onclick() {
                var xurl="<?php print $GLOBALS["idxfile"]; ?>";
                document.location.href=xurl;
            }

            //-->
            </script>

            </head>

            <?php
            print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
            ?>
            <br><br><center><h2>Event has been copied or moved.<br><br>
            Click "Okay" to continue.<br>
            <br><br></h2>
            <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
            <?php
            if($cmcatok == false) {
                print "<br><br>NOTE: The category setting could not be copied/moved due to restrictions from the source event category.";
            }
            if($badextcnt > -1) {
                print "<br><br>NOTE: Some or all Extended Field settings could not be copied/moved due to restrictions on the source Extended Fields.";
            }
            ?>
            </center>
            </body>
            </html>

            <?php
            exit();

        } elseif($qjump=="addextfield") {
            include($GLOBALS["CLPath"]."/include/extfieldform.php");
            #exit();
        } elseif($qjump=="extfldmgr") {
            include($GLOBALS["CLPath"]."/include/extfldmgr.php");
            #exit();
        } elseif($qjump=="addevsub") {
            include($GLOBALS["CLPath"]."/include/evsubenter.php");
            exit();
        } elseif($qjump=="databasemaint") {
            dodatabasemaint();
            exit();
        } elseif($qjump=="defcalselect") {
            include($GLOBALS["CLPath"]."/defcalsel.php");
            exit();
        } elseif($qjump=="savecon") {

            ?>
<?php
print $GLOBALS["htmldoctype"];
?>
            <html>
            <head>
            <title>Save Contact</title>
            <script id="clientEventHandlersJS" language="javascript">
            <!--

            function window_onload() {
                window.returnValue = "1";
                window.status = "Save Contact.";
            }


            function done_onclick() {
                window.returnValue = "1";
                window.close();
            }

            //-->
            </script>

            </head>

            <?php
            print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
            $params = explode("|",urldecode($convals));
            $tconid = array_shift($params);
            if($tconid != "") {

                $sqlstr = "select count(*) as concnt from ".$GLOBALS["tabpre"]."_user_con where uid = ".$user->gsv("cuid")." and conid = ".$tconid;
                $query1 = mysql_query($sqlstr) or die("Cannot select user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $row = mysql_fetch_array($query1);
                if($row["concnt"] > 0) {

                    $sqlstr = "update ".$GLOBALS["tabpre"]."_user_con set
                    fname = '".fmtfordb(mqfix($params[0]))."',
                    lname = '".fmtfordb(mqfix($params[1]))."',
                    email = '".fmtfordb(mqfix($params[2]))."',
                    emailtype = '".fmtfordb(mqfix($params[3]))."',
                    bday = '".fmtfordb(mqfix($params[4]))."',
                    tzos = '".fmtfordb(mqfix($params[5]))."',
                    tel1 = '".fmtfordb(mqfix($params[6]))."',
                    tel2 = '".fmtfordb(mqfix($params[7]))."',
                    tel3 = '".fmtfordb(mqfix($params[8]))."',
                    fax = '".fmtfordb(mqfix($params[9]))."',
                    shared = '".fmtfordb(mqfix($params[10]))."',
                    address = '".fmtfordb(mqfix($params[11]))."'
                    where uid = ".$user->gsv("cuid")." and conid = ".$tconid;
                    $query1 = mysql_query($sqlstr) or die("Cannot update user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $message = "Contact saved.";

                    if($params[10] == 0) {

                        $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where uid <> ".$user->gsv("cuid")." and conid = ".$tconid;
                        $query1 = mysql_query($sqlstr) or die("Cannot update user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where uid <> ".$user->gsv("cuid")." and contyp = 'C' and conid = ".$tconid;
                        $query1 = mysql_query($sqlstr) or die("Cannot update user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    }

                    $logentry["uid"] = $user->gsv("cuid");
                    $logentry["calid"] = "0";
                    $logentry["evid"] = "0";
                    $logentry["adate"] = time();
                    $logentry["laction"] = "Contact changed";
                    $logentry["lbefore"] = " ";
                    $logentry["lafter"] = " ";
                    $logentry["remarks"] = " ";
                    histlog($logentry);

                } else {
                    $message = "Could not save contact.";
                }

            } else {

                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_con (conid,uid,fname,lname,email,emailtype,bday,tzos,tel1,tel2,tel3,fax,shared,address) values('',
                '".$user->gsv("cuid")."',
                '".$params[0]."',
                '".$params[1]."',
                '".$params[2]."',
                '".$params[3]."',
                '".$params[4]."',
                '".$params[5]."',
                '".$params[6]."',
                '".$params[7]."',
                '".$params[8]."',
                '".$params[9]."',
                '".$params[10]."',
                '".$params[11]."')";
                $query1 = mysql_query($sqlstr) or die("Cannot update user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $message = "Contact saved.";

                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = "0";
                $logentry["evid"] = "0";
                $logentry["adate"] = time();
                $logentry["laction"] = "Contact added";
                $logentry["lbefore"] = " ";
                $logentry["lafter"] = " ";
                $logentry["remarks"] = " ";
                histlog($logentry);

            }
            ?>
            <br><br><center><h3><?php print $message; ?><br><br>
            Click "Okay" to continue.<br>
            <br><br></h3>
            <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
            </center>
            </body>
            </html>

            <?php

            exit();

        } elseif($qjump=="deletecon") {

            ?>
<?php
print $GLOBALS["htmldoctype"];
?>
            <html>
            <head>
            <title>Delete Contact</title>
            <script id="clientEventHandlersJS" language="javascript">
            <!--

            function window_onload() {
                window.returnValue = "1";
                window.status = "Delete Contact.";
            }


            function done_onclick() {
                window.returnValue = "1";
                window.close();
            }

            //-->
            </script>

            </head>

            <?php
            print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";

            $params = explode("|",$convals);

            $condelok = array_walk($params,"deletecontact");
/*
            if(isset($params["tconid"])) {

                $sqlstr = "select count(*) as concnt from ".$GLOBALS["tabpre"]."_user_con where uid = ".$user->gsv("cuid")." and conid = ".$params["tconid"];
                $query1 = mysql_query($sqlstr) or die("Cannot select user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $row = mysql_fetch_array($query1);
                if($row["concnt"] > 0) {

                    deletecontact($params["tconid"]);

                    $logentry["uid"] = $user->gsv("cuid");
                    $logentry["calid"] = "0";
                    $logentry["evid"] = "0";
                    $logentry["adate"] = time();
                    $logentry["laction"] = "Contact(s) deleted";
                    $logentry["lbefore"] = " ";
                    $logentry["lafter"] = " ";
                    $logentry["remarks"] = " ";
                    histlog($logentry);
                }
            }
*/

                    $logentry["uid"] = $user->gsv("cuid");
                    $logentry["calid"] = "0";
                    $logentry["evid"] = "0";
                    $logentry["adate"] = time();
                    $logentry["laction"] = "Contact(s) deleted";
                    $logentry["lbefore"] = " ";
                    $logentry["lafter"] = " ";
                    $logentry["remarks"] = " ";
                    histlog($logentry);

            ?>
            <br><br><center><h3>Contact(s) deleted.<br><br>
            Click "Okay" to continue.<br>
            <br><br></h3>
            <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
            </center>
            </body>
            </html>

            <?php
            exit();

        } elseif($qjump=="newgroup") {

            $sqlstr = "select count(*) as grpcnt from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$user->gsv("cuid")." and gpname = '".fmtfordb(mqfix($grpname))."'";

#            $sqlstr = "select count(*) as grpcnt from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$uid." and gpname = '".$grpname."'";
            $query1 = mysql_query($sqlstr) or die("Cannot select user contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row = mysql_fetch_array($query1);
            if($row["grpcnt"] > 0) {
                ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Group exists</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "0";
                    window.status = "Group not saved.";
                }


                function done_onclick() {
                    window.returnValue = "0";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                ?>
                <br><br><center><h3>The Group Name you entered already exists.<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>
                <?php
            } else {

                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_con_grp values ('',".$user->gsv("cuid").",".$grpshare.",'".$grpname."')";
#                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_con_grp values ('',".$uid.",0,'".$grpname."')";
                mysql_query($sqlstr) or die("Cannot insert to user contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Group Saved</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "1";
                    window.status = "Group saved.";
                }


                function done_onclick() {
                    window.returnValue = "1";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                ?>
                <br><br><center><h3>Group Saved.<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>
                <?php
                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = "0";
                $logentry["evid"] = "0";
                $logentry["adate"] = time();
                $logentry["laction"] = "New contact group created";
                $logentry["lbefore"] = " ";
                $logentry["lafter"] = " ";
                $logentry["remarks"] = " ";
                histlog($logentry);
            }
            exit();

        } elseif($qjump=="editgroup") {

            $sqlstr = "select count(*) as grpcnt from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$user->gsv("cuid")." and congpid = '".$grpid."'";
            $query1 = mysql_query($sqlstr) or die("Cannot select user contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row = mysql_fetch_array($query1);

            if($row["grpcnt"] < 1) {
                ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Group does not exists</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "0";
                    window.status = "Group not changed.";
                }


                function done_onclick() {
                    window.returnValue = "0";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                ?>
                <br><br><center><h3>The Group ID could not be found.<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>
                <?php
            } else {

                $sqlstr = "update ".$GLOBALS["tabpre"]."_user_con_grp set gpname = '".fmtfordb(mqfix($newgrpname))."', shared=".$grpshare." where uid = ".$user->gsv("cuid")." and congpid = '".$grpid."'";
                mysql_query($sqlstr) or die("Cannot update contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                if($grpshare==0) {

                    #$sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where uid <> ".$user->gsv("cuid")." and congpid = ".$grpid;
                    #$query1 = mysql_query($sqlstr) or die("Cannot update user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where uid <> ".$user->gsv("cuid")." and contyp = 'G' and conid = ".$grpid;
                    $query1 = mysql_query($sqlstr) or die("Cannot update user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                }
                ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Group changed</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "1";
                    window.status = "Group changed.";
                }

                function done_onclick() {
                    window.returnValue = "1";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                ?>
                <br><br><center><h3>Group changed.<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>
                <?php
                $logentry["uid"] = $user->gsv("cuid");
                $logentry["calid"] = "0";
                $logentry["evid"] = "0";
                $logentry["adate"] = time();
                $logentry["laction"] = "Contact group changed";
                $logentry["lbefore"] = " ";
                $logentry["lafter"] = " ";
                $logentry["remarks"] = " ";
                histlog($logentry);
            }
            exit();

        } elseif($qjump=="deletegroup") {

            ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Group(s) deleted</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "1";
                    window.status = "Group(s) deleted.";
                }


                function done_onclick() {
                    window.returnValue = "1";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                $params = explode("|",$grpvals);

                $condelok = array_walk($params,"deletecontactgroup");
/*
                if(isset($params["tgpid"])) {

                    $sqlstr = "select count(*) as concnt from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$user->gsv("cuid")." and congpid = ".$params["tgpid"];
                    $query1 = mysql_query($sqlstr) or die("Cannot select user contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $row = mysql_fetch_array($query1);
                    if($row["concnt"] > 0) {

                        deletecontactgroup($params["tgpid"]);

                        $logentry["uid"] = $user->gsv("cuid");
                        $logentry["calid"] = "0";
                        $logentry["evid"] = "0";
                        $logentry["adate"] = time();
                        $logentry["laction"] = "Contact group(s) deleted";
                        $logentry["lbefore"] = " ";
                        $logentry["lafter"] = " ";
                        $logentry["remarks"] = " ";
                        histlog($logentry);

                    }

                }
*/
                        $logentry["uid"] = $user->gsv("cuid");
                        $logentry["calid"] = "0";
                        $logentry["evid"] = "0";
                        $logentry["adate"] = time();
                        $logentry["laction"] = "Contact group(s) deleted";
                        $logentry["lbefore"] = " ";
                        $logentry["lafter"] = " ";
                        $logentry["remarks"] = " ";
                        histlog($logentry);
     ?>
                <br><br><center><h3>Group(s) deleted<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>
            <?php

            exit();

        } elseif($qjump=="assgroupsave") {

            ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Association saved</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "1";
                    window.status = "Association saved.";
                }


                function done_onclick() {
                    window.returnValue = "1";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                $params = explode("|",$grpconvals);
                $tgpid = array_shift($params);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where uid = ".$user->gsv("cuid")." and congpid = '".$tgpid."'";
                $query1 = mysql_query($sqlstr) or die("Cannot query user contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $gpsaveok = array_walk($params,"savegrpconlink",$tgpid);

                ?>
                <br><br><center><h3>Association saved<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>

            <?php
            exit();

        } elseif($qjump=="assconsave") {

            ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>
                <head>
                <title>Association saved</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.returnValue = "1";
                    window.status = "Association saved.";
                }


                function done_onclick() {
                    window.returnValue = "1";
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                $params = explode("|",$congrpvals);
                $tconid = array_shift($params);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where uid = ".$user->gsv("cuid")." and conid = '".$tconid."'";
                $query1 = mysql_query($sqlstr) or die("Cannot query user contacts group table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $consaveok = array_walk($params,"savecongrplink",$tconid);

                ?>
                <br><br><center><h3>Association saved<br><br>
                Click "Okay" to continue.<br>
                <br><br></h3>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>

            <?php
            exit();

        } elseif($qjump=="newsubscriber") {
#            print $newsubvalue."<br>";
            $conlist = explode("|",$newsubvalue);

#            print $conlist[0]."<br>";

            if($conlist[0] == 0) {

                $contyp = "A";
                $conid = "0";
                $cfname = $conlist[$curlpos+2];
                $clname = $conlist[$curlpos+3];
                $cemail = $conlist[$curlpos+4];
                $csrval = $conlist[$curlpos+5];
                $csrint = $conlist[$curlpos+6];
                $csrtz = $conlist[$curlpos+7];
                $cemailtype = $conlist[$curlpos+8];

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

                $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_event_rems (calid,uid,evid,contyp,conid,srint,srval,fname,lname,remail,remailtype,rtzos,approved,confirmed,confirmkey) values('".$user->gsv("curcalid")."',".$user->gsv("cuid").",".$nsevid.",'".$contyp."',".$conid.",".$csrint.",".$csrval.",'".$cfname."','".$clname."','".$cemail."','".$cemailtype."',".$csrtz.",1,0,'".$key."')";
                $query1 = mysql_query($sqlstr) or die("Cannot insert into calendar event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                if($csrval == 1) {
                    if($csrint == 1) {
                        $rixval .= "minute ";
                    } elseif($csrint == 2) {
                        $rixval .= "hour ";
                    } else {
                        $rixval .= "day ";
                    }
                } else {
                    if($csrint == 1) {
                        $rixval .= "minutes ";
                    } elseif($csrint == 2) {
                        $rixval .= "hours ";
                    } else {
                        $rixval .= "days ";
                    }
                }


                $regmail = new htmlMimeMail();

                $regmbody="<HTML><BODY>Hello ".$cfname." ".$clname.",<br><br>You have just subscribed for an event reminder at
                ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") <br><br>
                Please click the link below to confirm the reminder subscription:<br><br><a href=\"".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmsub.php?xrkey=".$key."\" target=\"_blank\">
                Confirm Subscription</a><br><br>Or copy and paste this address to your browser:<br><br>".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmsub.php?xrkey=".$key."<br><br>If there is a problem when confirming, you may be prompted to enter your request key. Simply cut and paste it to the entry field.<br><br>Request Key: ".$key."<br><br>
                If you did not subscribe, then you can ignore this e-mail.<br><br>
                Information provided by you:<br><br>
                      First name: ".$cfname."<br>
                       Last name: ".$clname."<br>
                          E-Mail: ".$cemail."<br>
                     E-Mail Type: ".$cemailtype."<br>
                        Interval: ".$csrval." ".$rixval." before event takes place.<br>
                Time Zone Offset: ".$csrtz."<br><br>

                Here is the event to which you subscribed to a reminder for:<br><br>".geteventhtml($nsevid,1)."<br><br>
                Thank you.<br><br>".$GLOBALS["siteowner"]."<br></body></html>";

                $regmtext="Hello ".$cfname." ".$clname.",\n\nYou have just subscribed for an event reminder at \n
                ".$GLOBALS["sitetitle"]." (".$GLOBALS["baseurl"].$GLOBALS["progdir"].") \n\n
                Please copy and paste this address to your browser:\n\n".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmsub.php?xrkey=".$key."
                \n\nIf there is a problem when confirming, you may be prompted to enter your request key.
                Simply cut and paste it to the entry field.\n\nRequest Key: ".$key."\n\n
                If you did not subscribe, then you can ignore this e-mail.\n\n
                Information provided by you:\n\n
                      First name: ".$cfname."
                       Last name: ".$clname."
                          E-Mail: ".$cemail."
                     E-Mail Type: ".$cemailtype."
                        Interval: ".$csrval." ".$rixval." before event takes place.
                Time Zone Offset: ".$csrtz."\n
                Here is the event to which you subscribed to a reminder for:\n\n".geteventtext($nsevid,1)."\n\n
                Thank you.\n\n".$GLOBALS["siteowner"]."\n\n";

$regmsms="start: ".$GLOBALS["baseurl"].$GLOBALS["progdir"]."confirmsub.php?xrkey=".$key;
$regmsms="stop: ".$GLOBALS["baseurl"].$GLOBALS["progdir"]."canevsub.php?xrkey=".$key;

                $regsub = "Reminder Subscription";

                $siteowner=$GLOBALS["siteowner"];
                $adminemail=$GLOBALS["adminemail"];

/*
                if($GLOBALS["mailastext"]==0) {
                    $regmail->setHtml($regmbody, $regmtext);
                } else {
                    $regmail->setText($regmtext);
                }
*/
	        if($cemailtype=="HTML") {
	            $regmail->setHtml($regmbody, $regmtext);
	        } elseif($cemailtype=="TEXT") {
	            $regmail->setText($regmtext);
	        } else {
	            $regmail->setText($regmsms);
	        }



                $regmail->setSubject($regsub);

                if($GLOBALS["uniem"] == 1) {
                    $toadr=$cfname." ".$clname." <$cemail>";
                    $fromadr="$siteowner <$adminemail>";
                } else {
                    $toadr="$cemail";
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

                    $regmail->setSubject("System email - CaLogic User Event Reminder Subscription ".$GLOBALS["sitetitle"]);

                    $regmtext="A user has just subscribed for an event reminder\nHere is a text copy of the mail sent to the user:\n\n".$regmtext;
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

                    $logentry["uid"] = $conid;
                    $logentry["calid"] = $user->gsv("curcalid");
                    $logentry["evid"] = $nsevid;
                    $logentry["adate"] = time();
                    $logentry["laction"] = "CaLogic User Event Reminder Subscription";
                    $logentry["lbefore"] = " ";
                    $logentry["lafter"] = " ";
                    $logentry["remarks"] = "Subscriber: ".$cfname." ".$clname.", ".$cemail;
                    histlog($logentry);
                }

                ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>

                <head>
                <title>Subscription Saved</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.status = "New Subscribers Saved.";
                }


                function done_onclick() {
                    //var xurl="<?php print $GLOBALS["idxfile"]; ?>";
                    //document.location.href=xurl;
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                ?>
                <br><br><p align="left">
                <h3>Your subscription has been saved.
                But before the subscription can be activated, you
                must confirm your E-Mail address by following the
                link that was just sent to the E-Mail address you
                provided.<br><br>
                Click "Okay" to continue.<br>
                </h3><br></p>
                <center>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </center>
                </body>
                </html>

                <?php
                exit();

            } else {

                $void = array_shift($conlist);
                $listlen = array_shift($conlist);

#                print $listlen."<br>";
                $curlpos = 1;

                for($k1=0;$k1<$listlen;$k1++) {

                    $contyp = "U";
                    $conid = substr($conlist[$curlpos],1);
#                    print $conlist[$curlpos]."<br>";

                    $curlpos += 1;
                    $conuname = $conlist[$curlpos];
#                    print $conlist[$curlpos]."<br>";

                    $curlpos += 1;
                    $csrval = $conlist[$curlpos];
#                    print $conlist[$curlpos]."<br>";

                    $curlpos += 1;
                    $csrint = $conlist[$curlpos];
#                    print $conlist[$curlpos]."<br>";

                    $curlpos += 2;
#                    print $conlist[$curlpos]."<br>";

#                    print "EVID: ".$nsevid."<br>";
                    $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_event_rems (calid,uid,evid,contyp,conid,srint,srval,approved,confirmed) values('".$user->gsv("curcalid")."',".$user->gsv("cuid").",".$nsevid.",'".$contyp."',".$conid.",".$csrint.",".$csrval.",1,1)";
#                    print $sqlstr."<br><br>";
#                    exit();

                    $query1 = mysql_query($sqlstr) or die("Cannot insert into calendar event reminder table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                }
                ?>
<?php
print $GLOBALS["htmldoctype"];
?>
                <html>

                <head>
                <title>Subscribers Saved</title>
                <script id="clientEventHandlersJS" language="javascript">
                <!--

                function window_onload() {
                    window.status = "New Subscribers Saved.";
                }


                function done_onclick() {
                    //var xurl="<?php print $GLOBALS["idxfile"]; ?>";
                    //document.location.href=xurl;
                    window.close();
                }

                //-->
                </script>

                </head>

                <?php
                print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
                ?>
                <br><br><center><p align="center">
                <h2>New Subscribers have been saved.<br>
                Click "Okay" to continue.<br>
                <br><br></h2>
                <input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
                </p></center>
                </body>
                </html>

                <?php
                exit();

            }
        }
    }

/***************************************************************
**  save extended field
***************************************************************/
    if(isset($gosaveextfield)) {

?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>

<head>
<title>Extended Field Saved</title>

<script id="clientEventHandlersJS" language="javascript">
<!--

function window_onload() {
    window.status = "Extended Event Field Saved.";
}


function done_onclick() {
    var xretval = "";
    window.close();
}

//-->
</script>

</head>

<?php
print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";

    $txuid = $user->gsv("cuid");

    $doupdate = false;
    $efdef = gmqfmt(gmqfix($efdef),2);

    if(isset($curextfieldid)) {
        if($curextfieldid != "") {
            $doupdate = true;
        }
    }

    if($doupdate == true) {
        $neid = $curextfieldid;
        $sqlstr = "update ".$GLOBALS["tabpre"]."_ext_def set ";
        $sqlstr .= "efuseage=".$efdef["useage"].",";
        if($efdef["useage"] == "0") {
            $sqlstr .= "uid=".$currentuser.",calid='".$currentcal."'";
        } elseif($efdef["useage"] == "1") {
            $sqlstr .= "uid=".$currentuser.",calid='0'";
        } elseif($efdef["useage"] == "2") {
            $sqlstr .= "uid=".$currentuser.",calid='-1'";
        } elseif($efdef["useage"] == "3") {
            $sqlstr .= "uid=0,calid='".$currentcal."'";
        } elseif($efdef["useage"] == "4") {
            $sqlstr .= "uid=-1,calid='".$currentuser."'";
        } elseif($efdef["useage"] == "5") {
            $sqlstr .= "uid=-1,calid='-1'";
        } else {
            $sqlstr .= "uid=".$currentuser.",calid='".$currentcal."'";
        }

        $sqlstr .= ",eftype='Event'";
        $sqlstr .= ",eftext='".$efdef["eftext"]."'";
        $sqlstr .= ",format='".$efdef["format"]."'";
        $sqlstr .= ",standard='".$efdef["standard"]."'";
        $sqlstr .= ",required='".$efdef["required"]."'";
        $sqlstr .= ",validate='".$efdef["validate"]."'";
        $sqlstr .= ",checktype='".$efdef["checktype"]."'";
        $sqlstr .= ",maxlen='".$efdef["maxlen"]."'";
        $sqlstr .= " where efid = ".$curextfieldid;
        $query1 = mysql_query($sqlstr) or die("Cannot update Extended Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $updatedseldef = Array();

        if($efdef["format"]=="Select") {
            $efseldef = gmqfmt(gmqfix($efseldef),2);
            for($x=0;$x<$efseldefcount;$x++) {
                if($efseldefoldid[$x] != "") {
                    $sqlstr = "update ".$GLOBALS["tabpre"]."_ext_sel_def set ";
                    $sqlstr .= "efsval='".$efseldef[$x]."',";
                    if($defaultsel == $x) {
                        $sqlstr .= "standard=1";
                    } else {
                        $sqlstr .= "standard=0";
                    }
                    $sqlstr .= " where efsid = ".$efseldefoldid[$x];
                    $updatedseldef[$x] = $efseldefoldid[$x];
                    $query1 = mysql_query($sqlstr) or die("Cannot update Extended Select Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                } else {

                    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_ext_sel_def values('','".$neid."'";
                    $sqlstr .= ",'".$efseldef[$x]."'";
                    if($defaultsel == $x) {
                        $sqlstr .= ",1)";
                    } else {
                        $sqlstr .= ",0)";
                    }

                    $query = mysql_query($sqlstr) or die("Cannot Insert Extended Select Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $sqlstr = "select LAST_INSERT_ID() as xidneid";
                    $query1 = mysql_query($sqlstr) or die("Cannot get new Extended Select Field Definition id<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $row = mysql_fetch_array($query1);
                    $xidneid = $row["xidneid"];
                    @mysql_free_result($query1);

                    $updatedseldef[$x] = $xidneid;

                }
            }
        }

        if(count($updatedseldef) > 0) {
            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_ext_sel_def where efid = ".$neid." and efsid not in(";
            for($x=0;$x<count($updatedseldef);$x++) {
                $sqlstr .= $updatedseldef[$x];
                if($x != (count($updatedseldef)-1)) {
                    $sqlstr .= ",";
                }
            }
            $sqlstr .= ")";
            $query = mysql_query($sqlstr) or die("Cannot delete from Extended Select Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_extents where efid = ".$neid." and efsid not in(";
            for($x=0;$x<count($updatedseldef);$x++) {
                $sqlstr .= $updatedseldef[$x];
                if($x != (count($updatedseldef)-1)) {
                    $sqlstr .= ",";
                }
            }
            $sqlstr .= ")";
            $query = mysql_query($sqlstr) or die("Cannot delete from Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }

    } else {

        $sqlstr = "insert into ".$GLOBALS["tabpre"]."_ext_def values(''";

        if($efdef["useage"] == "0") {
            $sqlstr .= ",".$currentuser.",'".$currentcal."'";
        } elseif($efdef["useage"] == "1") {
            $sqlstr .= ",".$currentuser.",'0'";
        } elseif($efdef["useage"] == "2") {
            $sqlstr .= ",".$currentuser.",'-1'";
        } elseif($efdef["useage"] == "3") {
            $sqlstr .= ",0,'".$currentcal."'";
        } elseif($efdef["useage"] == "4") {
            $sqlstr .= ",-1,'".$currentuser."'";
        } elseif($efdef["useage"] == "5") {
            $sqlstr .= ",-1,'-1'";
        } else {
            $sqlstr .= ",".$currentuser.",'".$currentcal."'";
        }

        $sqlstr .= ",'".$efdef["useage"]."'";
        $sqlstr .= ",'Event'";
        $sqlstr .= ",'".$efdef["eftext"]."'";
        $sqlstr .= ",'".$efdef["format"]."'";
        $sqlstr .= ",'".$efdef["standard"]."'";
        $sqlstr .= ",'".$efdef["required"]."'";
        $sqlstr .= ",'".$efdef["validate"]."'";
        $sqlstr .= ",'".$efdef["checktype"]."'";
        $sqlstr .= ",'".$efdef["maxlen"]."')";

        $query1 = mysql_query($sqlstr) or die("Cannot Insert Extended Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "select LAST_INSERT_ID() as neid";
        $query1 = mysql_query($sqlstr) or die("Cannot get new Extended Field Definition id<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row = mysql_fetch_array($query1);
        $neid = $row["neid"];
        @mysql_free_result($query1);

        if($efdef["format"]=="Select") {
            $efseldef = gmqfmt(gmqfix($efseldef),2);
            for($x=0;$x<$efseldefcount;$x++) {
                $sqlstr = "insert into ".$GLOBALS["tabpre"]."_ext_sel_def values('','".$neid."'";
                $sqlstr .= ",'".$efseldef[$x]."'";
                if($defaultsel == $x) {
                    $sqlstr .= ",1)";
                } else {
                    $sqlstr .= ",0)";
                }
                $query1 = mysql_query($sqlstr) or die("Cannot Insert Extended Select Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }
        }
    }

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_ext_def where efid=".$neid;
    $query1 = mysql_query($sqlstr) or die("Cannot get new Extended Field Definition row<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row = mysql_fetch_array($query1);

    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_ext_sel_def where efid=".$neid;
    $query2 = mysql_query($sqlstr) or die("Cannot get new Extended Field Definition row<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $row = gmqfix($row,1);
    $returnvar = "var xretval = \"".$row["efid"]."|".$row["uid"]."|".$row["calid"]."|".$row["eftext"]."|".$row["format"]."|".$row["standard"]."|".$row["required"]."|".$row["validate"]."|".$row["checktype"]."|".$row["maxlen"]."\";\n";

    $returnvar .= "xretval += \"|".$efseldefcount."\";\n";
    $rowseldefcount = 0;

    if($efdef["format"]=="Select") {
        while($row = mysql_fetch_array($query2)) {
            $row = gmqfix($row,1);
            $rowseldefcount++;
            $returnvar .= "xretval += \"|".$row["efid"]."|".$row["efsid"]."|".$row["efsval"]."|".$row["standard"]."\";\n";
        }
        if($rowseldefcount != $efseldefcount) {
            die("Extended Field Definition error.<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }
    }

    $returnvar .= "window.returnValue = xretval;\n";
#    print "alert(xretval);\n";
?>
<script language="javascript">
<!--
<?php
print $returnvar;
?>
//-->
</script>

<br><br><center><p align="center">
<h2>Extended Field Saved</h2>
Field has been saved. Click "Okay" to continue.<br>
<br><br>
<input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
</p></center>

</body>
</html>

<?php

        @mysql_free_result($query1);
        @mysql_free_result($query2);

        exit();

    }

/***************************************************************
**  delete extended field
***************************************************************/

    if(isset($godeleteextfield)) {

        $txuid = $user->gsv("cuid");

        if($user->gsv("isadmin")==1) {


            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_extents  where efid=".$efid2del;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_ext_def where efid=".$efid2del;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from Extended Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_ext_sel_def  where efid=".$efid2del;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from Extended Select Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        } else {

            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_extents  where uid='".$txuid."' and efid=".$efid2del;
            $query2 = mysql_query($sqlstr) or die("Cannot get Extended Field Definition<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            while($row = mysql_fetch_array($query2)) {

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_extents  where efid=".$efid2del;
                $query1 = mysql_query($sqlstr) or die("Cannot delete from Extents Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_ext_def where efid=".$efid2del;
                $query1 = mysql_query($sqlstr) or die("Cannot delete from Extended Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                $sqlstr = "delete from ".$GLOBALS["tabpre"]."_ext_sel_def  where efid=".$efid2del;
                $query1 = mysql_query($sqlstr) or die("Cannot delete from Extended Select Field Definition Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            }

            @mysql_free_result($query2);

        }
?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>

<head>
<title>Extended Field deleted</title>

<script id="clientEventHandlersJS" language="javascript">
<!--

function window_onload() {
    window.status = "Extended Event Field deleted.";
}


function done_onclick() {
    xretval = 1;
    window.returnValue = xretval;
    window.close();
}

//-->
</script>

</head>

<?php
print "<body language=\"javascript\" onload=\"window_onload()\" align=\"center\" ".$GLOBALS["calbodystyle"]." >";
?>
<br><br><center><p align="center">
<h2>Extended Field deleted</h2>
Field has been deleted. Click "Okay" to continue.<br>
<br><br>
<input type="button" value=" Okay " language="javascript" id="done" onclick="done_onclick()">
</p></center>

</body>
</html>

<?php
        exit();
    }

/***************************************************************
**  go to categories
***************************************************************/
    if(isset($gocatprefs)) {
        unset($gocatprefs);
        editcats($user);
    }

/***************************************************************
**  save category
***************************************************************/
    if(isset($savecat)) {


       $catcal = fmtfordb(mqfix($catcal),2);
       $catname = fmtfordb(mqfix($catname),2);
       $catcolortext = fmtfordb(mqfix($catcolortext),2);
       $catcolorbg = fmtfordb(mqfix($catcolorbg),2);

        if(!isset($catlist)) {
            if(!isset($catcal)) {$catcal = "0";}
            $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_cat (uid,calid,catname,catcolortext,catcolorbg) values(".$user->gsv("cuid").",'$catcal','".$catname."','".$catcolortext."','".$catcolorbg."')";
        } else {
            $catpars = explode("|",$catlist);
            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_cat set calid='$catcal',catname='".$catname."',catcolortext='".$catcolortext."',catcolorbg='".$catcolorbg."' where uid=".$user->gsv("cuid")." and catid='".$catpars[0]."' limit 1";
        }
        $query1 = mysql_query($sqlstr) or die("Cannot update Category Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        editcats($user);
    }

/***************************************************************
**  delete category
***************************************************************/
    if(isset($deletecat)) {

        if(isset($catlist)) {

            $catpars = explode("|",$catlist);
            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_cat where uid=".$user->gsv("cuid")." and catid='".$catpars[0]."' limit 1";
            $query1 = mysql_query($sqlstr) or die("Cannot delete from Category Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_events set catid = 0 where catid='".$catpars[0]."'";

            $query1 = mysql_query($sqlstr) or die("Cannot update catid in cal events Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }

        editcats($user);

    }

    $extext = "";

/***************************************************************
**  delete a user and everything associated with it.
***************************************************************/

    if(isset($deluserok) && $deluserok=="1") {

        $okaytodeleteuser = 0;

        if($user->gsv("isadmin") == 1) {
            $okaytodeleteuser = 1;
            if(isset($ccxid)) {
                $currentuser = $ccxid;
                $xcid = $ccxid;
            }
        } else {

            if($currentuser == $user->gsv("cuid")) {
                $okaytodeleteuser = 1;
            }
        }

        if($user->gsv("uname") == "Guest") {
            $okaytodeleteuser = 0;
        }

        if($okaytodeleteuser == 1) {

            $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$currentuser." limit 1";
            $query1 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row = mysql_fetch_array($query1);
            $row = gmqfix($row,1);

            if($senddelmail == "1") {
    #            while($row = mysql_fetch_array($query1)) {
                    senddelmail($row["fname"],$row["lname"],$row["email"],$row["uname"]);
    #            }
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
                $emsub = "System email - CaLogic User Deletion";
                $embody.="<html><body>A user has been deleted<br><br>User: ".$row["fname"]." ".$row["lname"].", ".$row["email"]."<br><br>User was deleted by: ".$user->gsv("fullname")."</body></html>";
                $emtext.="A user has been deleted\n\nUser: ".$row["fname"]." ".$row["lname"].", ".$row["email"]."\n\nUser was deleted by: ".$user->gsv("fullname");
                sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
            }

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_cat where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from category table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_congrp_link where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from contact groups table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con_grp where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from contact groups table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_con where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from contacts table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_event_rems where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from calendar event reminders table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_events where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from calendar table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$currentuser;
            $query1 = mysql_query($sqlstr) or die("Cannot delete from user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    /***************************************************************
    **  if deleting self, logoff
    ***************************************************************/
            if($user->gsv("cuid") == $currentuser) {

    /*
                $user->ssv("logedin",false);
                foreach($user->s_vars as $k1 => $v1) {
                    session_unregister("clsession_".$k1);
                    unset($GLOBALS["clsession_".$k1]);
                }
                $user->logoff;
                session_unset();
                session_destroy();
                $user->s_vars = array();
                unset($PHPSESSID);
                unset($xsesid);
                unset($user);
                $GLOBALS["HTTP_SESSION_VARS"] = array();
                $HTTP_SESSION_VARS = array();
                $_SESSION = array();
    */
    /*
                $user->logoff;

                    $user->logoff;

                    foreach($_SESSION as $key =>$value) {
                        unset($GLOBALS[substr($key,10)]);
                        unset($_SESSION[$key]);
                    }

                    $user->s_vars = array();
                    $_SESSION = array();
                    setcookie("CaLogicSessionID" ,"",0,"/");
                    setcookie("CaLogicSessionID");
                    // Finally, destroy the session.
                    session_destroy();
    */
                logoff();
                gologin();

            } else {
                print "<h3>User has been deleted.</h3>";
                edituser($user);
            }

        }

    }

/***************************************************************
**  check and save changed user info
***************************************************************/
    if(isset($saveuser) && $makenewu=="0") {


        $okaytosaveuser = 0;
        if($user->gsv("isadmin") == 1) {
            $okaytosaveuser = 1;

        } else {

            if($currentuser == $user->gsv("cuid")) {
                $okaytosaveuser = 1;
            }
        }

        if($user->gsv("uname") == "Guest") {
            $okaytosaveuser = 0;
        }

        if($okaytosaveuser == 1) {

            #$extext = "CCXID: ".$ccxid."   ";
            $fields = gmqfix($fields);
            $prev_fields = gmqfix($prev_fields);

            $uncheckfailed = false;
            $emcheckfailed = false;

            if(isset($ccxid) && $user->gsv("isadmin") == 1) {
                $xcid = $ccxid;
                if($ccxid != "") {
                    $currentuser = $ccxid;
                }

    /***************************************************************
    **  bring an error if trying to cheat
    ***************************************************************/

            } elseif(isset($ccxid) && $ccxid != "") {

    //            die("YOU ARE NOT AN ADMIN!");

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

    /***************************************************************
    **  check if changed user name is unique
    ***************************************************************/
            if($fields["username"] != $prev_fields["username"]) {
                if(checkinput($fields["username"]) == false) {
                print $GLOBALS["htmldoctype"];
                    print "<html>\n";
                    print "<head>\n";
                    print "<title>Error</title>\n";
                    print "</head>\n";
                    print "<body  ".$GLOBALS["sysbodystyle"].">\n";
                    print "<center><br><h3>The User Name you entered has invalid characters, only leters and numbers are allowed.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
                    if($GLOBALS["adsid"] == true) {
                        print "?".SID;
                    }
                    print "\">Go to Calendar</a></center>";
                    print "<br><br>";
                    include($GLOBALS["CLPath"]."/include/footer.php");
                    exit();
                }
                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$fields["username"]."'";
                $query1 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $res_query1 = @mysql_num_rows($query1) ;
                if($res_query1 > 0) {
                    $uncheckfailed = true;
                print $GLOBALS["htmldoctype"];
                    print "<html>\n";
                    print "<head>\n";
                    print "<title>Error</title>\n";
                    print "</head>\n";
                    print "<body ".$GLOBALS["calbodystyle"].">\n";
                    print "<center><br><h3>The User Name you have entered is already in use.</h3><br><br>";
                    print "cur un: ".$fields["username"]."<br><br>";
                    print "pre un: ".$prev_fields["username"]."<br><br>";

                    print "<a href=\"".$GLOBALS["idxfile"];
                    if($GLOBALS["adsid"] == true) {
                        print "?".SID;
                    }
                    print "\">Go to Calendar</a></center>";
                    print "<br><br>";
                    include($GLOBALS["CLPath"]."/include/footer.php");
                    mysql_free_result($query1);
                    exit();
                }
                mysql_free_result($query1);
            }

    /***************************************************************
    **  check if changed user email is unique / valid
    ***************************************************************/
            if($fields["useremail"] != $prev_fields["useremail"]) {
    /***************************************************************
    **  check if changed user email is valid
    ***************************************************************/
                if(!emailok($fields["useremail"])) {
                    $emcheckfailed = true;
                print $GLOBALS["htmldoctype"];
                    print "<html>\n";
                    print "<head>\n";
                    print "<title>Error</title>\n";
                    print "</head>\n";
                    print "<body ".$GLOBALS["calbodystyle"].">\n";
                    print "<center><br><h3>The Email you have entered is not valid.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
                    if($GLOBALS["adsid"] == true) {
                        print "?".SID;
                    }
                    print "\">Go to Calendar</a></center>";
                    print "<br><br>";
                    include($GLOBALS["CLPath"]."/include/footer.php");
                    mysql_free_result($query1);
                    exit();
                }

                $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where email = '".$fields["useremail"]."'";
                $query1 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $res_query1 = @mysql_num_rows($query1) ;
                if($res_query1 > 0) {
                    $emcheckfailed = true;
                print $GLOBALS["htmldoctype"];
                    print "<html>\n";
                    print "<head>\n";
                    print "<title>Error</title>\n";
                    print "</head>\n";
                    print "<body ".$GLOBALS["calbodystyle"].">\n";
                    print "<center><br><h3>The Email you have entered is already in use.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
                    if($GLOBALS["adsid"] == true) {
                        print "?".SID;
                    }
                    print "\">Go to Calendar</a></center>";
                    print "<br><br>";
                    include($GLOBALS["CLPath"]."/include/footer.php");
                    mysql_free_result($query1);
                    exit();
                }
                mysql_free_result($query1);
            }

    /***************************************************************
    **  save if all is ok
    ***************************************************************/
                #set_time_limit(60);
                $newpwerr = 0;
                $haveupd = 0;
                $upduls = 0;
                $updusc = 0;
                $cxuo = array();
                foreach($fields as $k1 => $v1) {
                        if($fields[$k1] != $prev_fields[$k1]) {
                            if($k1=="userlangsel") {
                                $upduls=1;
                                $newuls = $fields[$k1];
                                $xsqlstr = "select name from ".$GLOBALS["tabpre"]."_languages where uid=".$fields[$k1];
                                $xquery1 = mysql_query($xsqlstr) or die("Cannot query global language table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                                $res_query1 = @mysql_num_rows($xquery1) ;
                                if($res_query1 < 1) {
                                    die("Cannot locate language");
                                }
                                $xrow = mysql_fetch_array($xquery1);
                                $xrow = gmqfix($xrow,1);
                                $newuln = $xrow["name"];
                                @mysql_free_result($xquery1);
                                $qfield = "langid";
                                $cxuo["langsel"] = $fields[$k1];
                                $cxuo["langname"] = $newuln;
                            }elseif($k1=="usercalsel") {
                                $updusc=1;
                                $newusc = $fields[$k1];
                                $xsqlstr = "select calname from ".$GLOBALS["tabpre"]."_cal_ini where calid='".$fields[$k1]."'";
                                $xquery1 = mysql_query($xsqlstr) or die("Cannot query calendar ini table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                                $res_query1 = @mysql_num_rows($xquery1) ;
                                if($res_query1 < 1) {
                                    die("Cannot locate calendar: ".$fields[$k1]."<br>".$res_query1);
                                }
                                $xrow = mysql_fetch_array($xquery1);
                                $xrow = gmqfix($xrow,1);
                                $newusn = ($xrow["calname"]);
                                @mysql_free_result($xquery1);
                                $qfield = "startcalid";
                                $cxuo["startcalid"] = $fields[$k1];
                                $cxuo["startcalname"] = $newusn;
                            }elseif($k1=="username") {
                                $qfield = "uname";
                                $cxuo["uname"] = $fields[$k1];
                            }elseif($k1=="firstname") {
                                $qfield = "fname";
                                $cxuo["fname"] = $fields[$k1];
                            }elseif($k1=="lastname") {
                                $qfield = "lname";
                                $cxuo["lname"] = $fields[$k1];
                            }elseif($k1=="useremail") {
                                $qfield = "email";
                                $cxuo["email"] = $fields[$k1];
                            }elseif($k1=="emailtype") {
                                $qfield = "emailtype";
                                $cxuo["emailtype"] = $fields[$k1];
                            }elseif($k1=="userisadmin") {
                                $qfield = "isadmin";
                                $cxuo["isadmin"] = $fields[$k1];
                            }elseif($k1=="failedli") {
                                $qfield = "failedli";
                                $cxuo["failedli"] = $fields[$k1];
                            }elseif($k1=="usertzos") {
                                $qfield = "tzos";
                                if($fields[$k1] == "") {
                                    $fields[$k1] = 0;
                                }
                                $cxuo["tzos"] = ($fields[$k1] * 60 * 60);
                                $fields[$k1] = ($fields[$k1] * 60 * 60);
                            }elseif($k1=="usertzlock") {
                                $qfield = "tzlock";
                                $cxuo["tzlock"] = $fields[$k1];
                            }

                            $fields[$k1] = fmtfordb($fields[$k1]);
                            if($haveupd==0) {
                                $haveupd = 1;
                                $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set ".$qfield."='".$fields[$k1]."'";
                            } else {
                                $sqlstr .= ", ".$qfield."='".$fields[$k1]."'";
                            }
                        }
                }
                if($upduls==1) {
                    $sqlstr .= ", language='".$newuln."'";
                }
                if($updusc==1) {
                    $sqlstr .= ", startcalname='".fmtfordb($newusn,2)."'";
                }
                $setnextpwdate = dateadd("d",$GLOBALS["maxpwdays"],time());

                if(isset($userpw) && isset($newuserpw) && isset($newuserpw2) && $userpw != "" && $newuserpw != "" && $newuserpw2 != "") {

                    $userpw = mqfix($userpw);
                    $newuserpw = mqfix($newuserpw);
                    $newuserpw2 = mqfix($newuserpw2);

                    $xsqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = $currentuser";
                    $xqu_res = mysql_query($xsqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $xrow = mysql_fetch_array($xqu_res) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $xrow = gmqfix($xrow,1);

                    if ($xrow["pw"]==md5($userpw)) {

                        if(strlen($newuserpw) < $GLOBALS["minpwlen"]) {
                            $extext = "<br>The password you entered is too short. Min length is ".$GLOBALS["minpwlen"].". <br>Other changes have been saved.";
                            $newpwerr = 1;
                        }

                        if($GLOBALS["maxpwinterval"] > 0 && $newpwerr == 0) {

                            if(md5($newuserpw) == $xrow["pw"]) {
                                $extext = "<br>You entered your current password. Please enter a new password when changing. <br>Other changes have been saved";
                                $newpwerr = 1;
                            } else {

                                $logsql = "select * from ".$GLOBALS["tabpre"]."_log where uid = ".$currentuser." and laction = 'New password set' order by hldate desc limit ".$GLOBALS["maxpwinterval"];
                                $query1 = mysql_query($logsql) or die("Cannot query log Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$logsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                                while($row = @mysql_fetch_array($query1)) {
                                    $row = gmqfix($row,1);
                                    if(md5($newuserpw) == $row["lbefore"]) {
                                        $extext = "<br>You entered a previously used password. Please enter a new password. <br>Other changes have been saved.";
                                        $newpwerr = 1;
                                    }
                                }
                                @mysql_free_result($query1);
                            }
                        }


                    } else {
                        $extext = "<br>The current password you entered is not correct. <br>Other changes have been saved.";
                        $newpwerr = 1;
                    }

                    @mysql_free_result($xqu_res);

                    if($newpwerr == 0) {
                        $xmdpw = md5($newuserpw);

                        $logentry["uid"] =  $xrow["uid"];
                        $logentry["calid"] = "0";
                        $logentry["evid"] = "0";
                        $logentry["adate"] = time();
                        $logentry["laction"] = "New password set";
                        $logentry["lbefore"] = $xrow["pw"];
                        $logentry["lafter"] = " ";
                        $logentry["remarks"] = " ";
                        histlog($logentry);
                        $user->ssv("nextpwdate",$setnextpwdate);
                        if($haveupd==0) {
                            $haveupd = 1;
                            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set pw='".fmtfordb($xmdpw,2)."', nextpwdate=".$setnextpwdate;
                        } else {
                            $sqlstr .= ", pw='".fmtfordb($xmdpw,2)."', nextpwdate=".$setnextpwdate;
                        }
                    }
                } elseif($user->gsv("isadmin") == 1 && isset($newuserpw) && isset($newuserpw2) && $newuserpw != "" && $newuserpw2 != "") {

                    $xsqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = $currentuser";
                    $xqu_res = mysql_query($xsqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $xrow = mysql_fetch_array($xqu_res) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $xrow = gmqfix($xrow,1);

                    $newuserpw = mqfix($newuserpw);
                    $newuserpw2 = mqfix($newuserpw2);
                    $xmdpw = md5($newuserpw);

                        if(strlen($newuserpw) < $GLOBALS["minpwlen"]) {
                            $extext = "<br>The password you entered is too short. Min length is ".$GLOBALS["minpwlen"].". <br>Other changes have been saved.";
                            $newpwerr = 1;
                        }

                        if($GLOBALS["maxpwinterval"] > 0 && $newpwerr == 0) {

                            if(md5($newuserpw) == $xrow["pw"]) {
                                $extext = "<br>You entered the users current password. Please enter a new password when changing. <br>Other changes have been saved";
                                $newpwerr = 1;
                            } else {

                                $logsql = "select * from ".$GLOBALS["tabpre"]."_log where uid = ".$currentuser." and laction = 'New password set' order by hldate desc limit ".$GLOBALS["maxpwinterval"];
                                $query1 = mysql_query($logsql) or die("Cannot query log Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$logsql."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                                while($row = @mysql_fetch_array($query1)) {
                                    $row = gmqfix($row,1);
                                    if(md5($newuserpw) == $row["lbefore"]) {
                                        $extext = "<br>You entered a previously used password. Please enter a new password. <br>Other changes have been saved.";
                                        $newpwerr = 1;
                                    }
                                }
                                @mysql_free_result($query1);
                            }
                        }
                    if($newpwerr == 0) {
                        if($haveupd==0) {
                            $haveupd = 1;
                            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set pw='".fmtfordb($xmdpw,2)."', nextpwdate=".$setnextpwdate;
                        } else {
                            $sqlstr .= ", pw='".fmtfordb($xmdpw,2)."', nextpwdate=".$setnextpwdate;
                        }

                        $logentry["uid"] =  $currentuser;
                        $logentry["calid"] = "0";
                        $logentry["evid"] = "0";
                        $logentry["adate"] = time();
                        $logentry["laction"] = "New password set";
                        $logentry["lbefore"] = $xrow["pw"];
                        $logentry["lafter"] = " ";
                        $logentry["remarks"] = " ";
                        histlog($logentry);
                        $user->ssv("nextpwdate",$setnextpwdate);
                    }
                }

                if(isset($changepass)) {
                    if($haveupd==0) {
                        $haveupd = 1;
                        $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set nextpwdate=".time();
                    } else {
                        $sqlstr .= ", nextpwdate=".time();
                    }
                }

                if($haveupd==1) {
                    $sqlstr .= " where uid=".$currentuser." limit 1";
#print $sqlstr;
#exit();
                    $query1 = mysql_query($sqlstr) or die("Cannot update user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    if($currentuser == $user->gsv("cuid")) {
                        foreach($cxuo as $k1 => $v1) {
                            if($k1 == "tzos") {
                                if($cxuo[$k1] != "0") {
                                    $user->ssv("usertz",($cxuo[$k1] / 60 / 60));
                                } else {
                                    $user->ssv("usertz",$cxuo[$k1]);
                                }
                                $user->ssv("caltzadj",$cxuo[$k1]);
                            } else {
                                $user->ssv($k1,$cxuo[$k1]);
                            }

                        }
                        $user->ssv("fullname",$user->gsv("fname")."&nbsp;".$user->gsv("lname"));
                    }
                    print "<h3>Changes have been saved. ".$extext."</h3>";
                    getuserstandards($user);
                } elseif($newpwerr==1) {
                    print "<h3>".$extext."</h3>";
                    getuserstandards($user);
                }

            edituser($user);
        }
    }

    if(!isset($makenewu)) {
        $makenewu="0";
    }

    if($makenewu=="1") {
        unset($makenewu);

        if($user->gsv("isadmin") != 1) {
//            die("YOU ARE NOT AN ADMIN!");

	    print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";

            print "<title>Error</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["calbodystyle"].">\n";
            print "<center><br><h3>You are not an Admin!</h3></center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            exit();
        }

        $uncheckfailed = false;
        $emcheckfailed = false;

        $fields = gmqfix($fields);
        $userpw = mqfix($userpw);


        $xsqlstr = "select name from ".$GLOBALS["tabpre"]."_languages where uid=".$fields["userlangsel"];
        $xquery1 = mysql_query($xsqlstr) or die("Cannot query global language table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$xsqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $res_query1 = @mysql_num_rows($xquery1) ;
        if($res_query1 < 1) {
            die("Cannot locate language");
        }
        $xrow = mysql_fetch_array($xquery1);
        $xrow = gmqfix($xrow,1);
        $newuln = $xrow["name"];
        @mysql_free_result($xquery1);

        if(checkinput($fields["username"]) == false) {
	    print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";
            print "<title>Error</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["calbodystyle"].">\n";
            print "<center><br><h3>The User Name you entered has invalid characters, only leters and numbers are allowed.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
            if($GLOBALS["adsid"] == true) {
                print "?".SID;
            }
            print "\">Go to Calendar</a></center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            exit();
        }
        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$fields["username"]."'";
        $query1 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $res_query1 = @mysql_num_rows($query1) ;
        if($res_query1 > 0) {
            $uncheckfailed = true;
	    print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";
            print "<title>Error</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["calbodystyle"].">\n";
            print "<center><br><h3>The User Name you have entered is already in use.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
            if($GLOBALS["adsid"] == true) {
                print "?".SID;
            }
            print "\">Go to Calendar</a></center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            mysql_free_result($query1);
            exit();
        }
        mysql_free_result($query1);

        if(!emailok($fields["useremail"])) {
            $emcheckfailed = true;
	    print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";
            print "<title>Error</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["calbodystyle"].">\n";
            print "<center><br><h3>The Email you have entered is not valid.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
            if($GLOBALS["adsid"] == true) {
                print "?".SID;
            }
            print "\">Go to Calendar</a></center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            mysql_free_result($query1);
            exit();
        }

        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg where email = '".$fields["useremail"]."'";
        $query1 = mysql_query($sqlstr) or die("Cannot query user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $res_query1 = @mysql_num_rows($query1) ;
        if($res_query1 > 0) {
            $emcheckfailed = true;
	    print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";
            print "<title>Error</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["calbodystyle"].">\n";
            print "<center><br><h3>The Email you have entered is already in use.</h3><br><br><a href=\"".$GLOBALS["idxfile"];
            if($GLOBALS["adsid"] == true) {
                print "?".SID;
            }
            print "\">Go to Calendar</a></center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            mysql_free_result($query1);
            exit();
        }
        mysql_free_result($query1);

        $regtime = time();
        $xmdpw = md5($userpw);

        $fields = gmqfmt($fields);

        if(isset($changepass)) {
            $unpwd = time();
        } else {
            $unpwd = dateadd("d",$GLOBALS["maxpwdays"],time());
        }

        if(isset($fields["usertzlock"])) {
            $xtzlock = "1";
        } else {
            $xtzlock = "0";
        }

        $xtzos = ($fields["usertzos"] * 60 * 60);

        if($forcedefaultcal == 1) {
            $sqlstr = "insert into ".$tabpre."_user_reg (uname,fname,lname,email,emailtype,pw,emok,tzos,tzlock,langid,language,regtime,regkey,isadmin,startcalid,startcalname,nextpwdate)
            values('".$fields["username"]."','".$fields["firstname"]."','".$fields["lastname"]."','".$fields["useremail"]."','".$fields["emailtype"]."','$xmdpw',1,'".$xtzos."','".$xtzlock."',".$fields["userlangsel"].",'$newuln',$regtime,'',".$fields["userisadmin"].",'$defaultcalid','".fmtfordb($defaultcalname,2)."','".$unpwd."')";
        } else {
            $sqlstr = "insert into ".$tabpre."_user_reg (uname,fname,lname,email,emailtype,pw,emok,tzos,tzlock,langid,language,regtime,regkey,isadmin,nextpwdate)
            values('".$fields["username"]."','".$fields["firstname"]."','".$fields["lastname"]."','".$fields["useremail"]."','".$fields["emailtype"]."','$xmdpw',1,'".$xtzos."','".$xtzlock."',".$fields["userlangsel"].",'$newuln',$regtime,'',".$fields["userisadmin"].",'".$unpwd."')";
        }

        mysql_query($sqlstr) or die("Cannot insert to user table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        print "<h3>New user created. ".$extext."</h3>";

        $xcid = mysql_insert_id();

        $logentry["uid"] =  $user->gsv("cuid");
        $logentry["calid"] = "0";
        $logentry["evid"] = "0";
        $logentry["adate"] = time();
        $logentry["laction"] = "New user saved";
        $logentry["lbefore"] = " ";
        $logentry["lafter"] = " ";
        $logentry["remarks"] = " ";
        histlog($logentry);

        edituser($user);
    }

?>
