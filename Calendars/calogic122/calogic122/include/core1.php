<?php

/***************************************************************
**  the first thing that gets checked for is if $submitsetup is set or not
    if it is not set and the startcalid == 0, then this is the first login after
    conformation, therefor go directly to the calendar setup.
***************************************************************/
    if(!isset($submitsetup)) {
        if($user->gsv("startcalid") == "0" || $user->gsv("startcalid") == "") {
            calsetup(1,"cg",$user);
        } else {

/***************************************************************
**  this sets the selected calendar
***************************************************************/
            if(isset($gocalselect) || isset($goocalselect)) {

                if(isset($goocalselect)) {
                    $calselect = $ocalselect;
                }

                unset($gocalselect);
                unset($goocalselect);

                if($user->gsv("startcalid") == "0" || $user->gsv("startcalid") == "") {
                    calsetup(1,"cg",$user);
                } else {

                    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid='".$calselect."'";
                    $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $res_query1 = @mysql_num_rows($query1) ;
                    if(mysql_error()) {
                        die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
                    }
                    if($res_query1 == 1) {
                        $row = mysql_fetch_array($query1);
                        $row = gmqfix($row,1);
                        if($row["userid"] == $user->gsv("cuid")) {
                            $user->ssv("curcalowner",1);
                        } else {
                            $user->ssv("curcalowner",0);
                        }
                        $user->ssv("curcaltype",$row["caltype"]);
                        if(($user->gsv("curcalowner") == 0 && $row["caltype"] < 2) || $user->gsv("curcalowner") == 1 || $user->gsv("isadmin") == 1) {
                            $user->ssv("curcalid",$calselect);
                            $user->ssv("curcalname",($row["calname"]));
                            if(isset($mstdcal) && ($calselect <> $row["curcalid"]) && ($user->gsv("curcalowner") == 1)) {
                                $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalid='".$calselect."', startcalname='".fmtfordb($row["calname"],1)."' where uid = ".$user->gsv("cuid")." limit 1";
                                $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                                $user->ssv("startcalid",$calselect);
                                $user->ssv("startcalname",($row["calname"]));
                            }
                        }
                    } else {
                        die("Calendar not found in Config Table<br><br>File:".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]."<br><br>SQL String: ".$sqlstr);
                    }

                    mysql_free_result($query1);
                    unset($csection);
                    unset($calselect);
                }
/***************************************************************
**  this turns on / off  the Standard Default Calendar option
**
**  This function has been moved
***************************************************************/
/*
            } elseif(isset($goallocalselect) && $user->gsv("isadmin")=="1") {
#                if($GLOBALS["forcedefaultcal"]==0) {
                if(isset($mstdefcal)) {
                    if(($GLOBALS["forcedefaultcal"]==1 && $allocalselect != $GLOBALS["defaultcalid"]) || ($GLOBALS["forcedefaultcal"]==0) ) {
                        $calselect = $allocalselect;
                        unset($goallocalselect);
                        $sqlstr = "select * from ".$GLOBALS["tabpre"]."_cal_ini where calid='".$calselect."'";
                        $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        $res_query1 = @mysql_num_rows($query1) ;
                        if(mysql_error()) {
                            die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
                        }
                        if($res_query1 == 1) {
                            $row = mysql_fetch_array($query1);
                            $row = gmqfix($row,1);
                            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set udefscid=startcalid,udefscname=startcalname";
                            $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                            $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalid='".$calselect."', startcalname='".fmtfordb($row["calname"],1)."'";
                            $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                            $user->ssv("startcalid",$calselect);
                            $user->ssv("startcalname",($row["calname"]));
                            $sqlstr = "update ".$GLOBALS["tabpre"]."_setup set dispcnpd=0, usercustom=0, forcedefaultcal=1,defaultcalid='".$calselect."', defaultcalname='".fmtfordb($row["calname"],1)."'";
                            $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        } else {
                            die("Calendar not found in Config Table<br><br>File:".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]."<br><br>SQL String: ".$sqlstr);
                        }
                        $GLOBALS["forcedefaultcal"]=1;
                        $GLOBALS["defaultcalid"]="$calselect";
                        $GLOBALS["defaultcalname"]=($row["calname"]);
                        mysql_free_result($query1);
                    }
                    unset($csection);
                    unset($calselect);
                } else {
                    if($GLOBALS["forcedefaultcal"]==1) {
                        $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalid=udefscid,startcalname=udefscname";
                        $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        $sqlstr = "update ".$GLOBALS["tabpre"]."_setup set forcedefaultcal=0,defaultcalid='', defaultcalname=''";
                        $query2 = mysql_query($sqlstr) or die("Cannot update User Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                        $GLOBALS["forcedefaultcal"]=0;
                        $GLOBALS["defaultcalid"]="";
                        $GLOBALS["defaultcalname"]="";
                    }
                }
                $goprefs=1;
*/
/***************************************************************
**  this creates a new calendar from the selected calendar
***************************************************************/
            } elseif(isset($prefgonc) || isset($prefgoonc)) {
                if(isset($prefgoonc)) {
                    $calselect = $ocalselect;
                }

                unset($prefgonc);
                unset($prefgoonc);

                $new_cal = getcalvals($calselect);
                srand((double)microtime()*1000000);
                $newcalid = md5(uniqid(rand()));
                $new_cal["calid"] = $newcalid;
                $new_cal["calname"] = time();
                $new_cal["caltitle"] = time();
                $new_cal["userid"] = $user->gsv("cuid");
                $new_cal["username"] = $user->gsv("uname");
                $sqlstr = "INSERT INTO ".$tabpre."_cal_ini VALUES (''";
                foreach($new_cal as $k1 => $v1) {
                    if($k1<>"tuid") {
                        $sqlstr .= ",'".$v1."'";
                    }
                }
                $sqlstr .= ")";
                $query1 = mysql_query($sqlstr) or die("Cannot Insert New Calendar<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $user->ssv("curcalid",$newcalid);
                $user->ssv("curcalname",($new_cal["calname"]));
                $user->ssv("curcalowner",1);
                $user->ssv("curcaltype",$new_cal["caltype"]);
                getuserstandards($user);
                setcalbody();
                calsetup(0,"cg",$user);

/***************************************************************
**  this deletes a calendar
***************************************************************/
            } elseif(isset($prefgodc)) {
                unset($prefgodc);
                if($user->gsv("curcalowner") == 1 || $user->gsv("isadmin")=="1") {

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
                        $emsub = "System email - CaLogic Calendar Deletion";
                        $embody.="<html><body>A calendar has been deleted<br><br>Calendar: ".$user->gsv("curcalname")."<br><br>Calendar was deleted by: ".$user->gsv("fullname")."</body></html>";
                        $emtext.="A calendar has been deleted\n\Calendar: ".$user->gsv("curcalname")."\n\nCalendar was deleted by: ".$user->gsv("fullname");
                        sysmail($toadr,$fromadr,$emsub,$embody,$emtext);
                    }

                    $sqlstr = "DELETE FROM ".$tabpre."_cal_event_rems where calid='".$calselect."'";
                    $query1 = mysql_query($sqlstr) or die("Cannot Delete Calendar Event Reminders<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $sqlstr = "DELETE FROM ".$tabpre."_cal_events where calid='".$calselect."'";
                    $query1 = mysql_query($sqlstr) or die("Cannot Delete Calendar Events<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    #$sqlstr = "DELETE FROM ".$tabpre."_cal_ini where calid='".$calselect."' and userid=".$user->gsv("cuid")." limit 1";
                    #$query1 = mysql_query($sqlstr) or die("Cannot Delete Calendar<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $sqlstr = "DELETE FROM ".$tabpre."_cal_ini where calid='".$calselect."' limit 1";
                    $query1 = mysql_query($sqlstr) or die("Cannot Delete Calendar<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    #$sqlstr = "update ".$tabpre."_user_reg where calid='".$calselect."' and userid=".$user->gsv("cuid")." limit 1";
                    #$query1 = mysql_query($sqlstr) or die("Cannot Delete Calendar<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    $sqlstr = "UPDATE ".$tabpre."_user_reg set udefscid='', udefscname='' where udefscid='".$calselect."'";
                    $query1 = mysql_query($sqlstr) or die("Cannot Update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                    if($user->gsv("startcalid") == $calselect) {
                        $sqlstr = "SELECT * FROM ".$tabpre."_cal_ini where userid=".$user->gsv("cuid")." limit 1";
                        $query1 = mysql_query($sqlstr) or die("Cannot Select Calendar<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                        $res_query1 = @mysql_num_rows($query1) ;
                        if($res_query1 == 1) {
                            $row = mysql_fetch_array($query1) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
                            $row = gmqfix($row,1);
                            $sqlstr = "UPDATE ".$tabpre."_user_reg set startcalid='".$row["calid"]."', startcalname='".fmtfordb($row["calname"],1)."' where uid=".$user->gsv("cuid")." limit 1";
                            $query1 = mysql_query($sqlstr) or die("Cannot Update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                            $user->ssv("startcalid",$row["calid"]);
                            $user->ssv("startcalname",($row["calname"]));

                            if($user->gsv("curcalid") == $calselect) {
                                $user->ssv("curcalid",$row["calid"]);
                                $user->ssv("curcalname",(($row["calname"])));
                            }
                            getuserstandards($user);
                            setcalbody();
                            calsetup(0,"cg",$user);
                        } else {
                            $sqlstr = "UPDATE ".$tabpre."_user_reg set startcalid='0', startcalname='' where uid=".$user->gsv("cuid")." limit 1";
                            $query1 = mysql_query($sqlstr) or die("Cannot Update User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                            $user->ssv("curcalid","");
                            $user->ssv("curcalname","");
                            $user->ssv("startcalid","0");
                            $user->ssv("startcalname","");
                            calsetup(1,"cg",$user);
                        }
                    } elseif($user->gsv("curcalid") == $calselect) {
                        $user->ssv("curcalid",$user->gsv("startcalid"));
                        $user->ssv("curcalname",$user->gsv("startcalname"));
                        getuserstandards($user);
                        setcalbody();
                        calsetup(0,"cg",$user);
                    }
                }
            }

/***************************************************************
**  as of this point, the userstandards must be set.
***************************************************************/
            getuserstandards($user);
            setcalbody();


/***************************************************************
**  this brings up the language editor, only for admins!
***************************************************************/
            if(isset($golangeditor) && $user->gsv("isadmin")=="1") {
                unset($golangeditor);
                unset($csection);
                langeditor($seledlang,$user);

/***************************************************************
**  this saves changed language entries, only for admins!
***************************************************************/
            } elseif(isset($savelang) && $user->gsv("isadmin")=="1") {

              ?>
<?php
print $GLOBALS["htmldoctype"];
?>
              <html>
              <head>
              <title><?php print $langcfg["pwlet"]; ?></title>
              </head>

              <body <?php print $GLOBALS["calbodystyle"]; ?>>

              <h3><?php print $langcfg["pwles"]; ?></h3>

              <?php

//              $sqlstr = "select * from ".$GLOBALS["tabpre"]."_lang_".$seledlang." order by uid";
//              $query1 = mysql_query($sqlstr) or die("Cannot query Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);

              set_time_limit(60);
              $htmltrans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
              $transhtml = array_flip($htmltrans);
              $fcnt = 1;
              foreach($fields as $k1 => $v1) {
                  $haveupd = 0;
                  foreach ($v1 as $k2 => $v2) {
                      $fields[$k1][$k2] = mqfix($fields[$k1][$k2]);
                      $prev_fields[$k1][$k2] = mqfix($prev_fields[$k1][$k2]);

                      if(strtr($fields[$k1][$k2],$transhtml) <> strtr($prev_fields[$k1][$k2],$transhtml)) {
                          if($haveupd==0) {
                              $haveupd = 1;
                              $sqlstr = "update ".$GLOBALS["tabpre"]."_lang_".$seledlang." set ".$k2."='".(strtr((fmtfordb($fields[$k1][$k2])),$transhtml))."'";
                          } else {
                              $sqlstr .= ", ".$k2."='".(strtr((fmtfordb($fields[$k1][$k2])),$transhtml))."'";
                          }
                          print "*";
                      } else {
                          print ".";
                      }

                      flush();
                      usleep(25);
                  }

                  if($haveupd==1) {
                      $sqlstr .= " where uid=".$k1;
                      $query1 = mysql_query($sqlstr) or die("Cannot update Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                  }

                  $fcnt++;
                  if($fcnt==60) {
                      $fcnt=1;
                      print "<br>";
                  }
                  flush();
              }

              ?>
              <br>
              <h3><?php print $langcfg["pwlec"]; ?></h3>
              <br>
              <a href="<?php print $GLOBALS["idxfile"];
                if($GLOBALS["adsid"] == true) {
                    print "?".SID;
                }

               ?>"><?php print $langcfg["butgoc"]; ?></a>&nbsp;&nbsp;&nbsp;<a href="<?php print $GLOBALS["idxfile"];

                if($GLOBALS["adsid"] == true) {
                    print "?goprefs=1&".SID;
                }

               ?>"><?php print $langcfg["butgoset"]; ?></a>&nbsp;&nbsp;&nbsp;<a href="<?php

               print $GLOBALS["idxfile"];

               ?>?golangeditor=1&seledlang=<?php print $seledlang;
                if($GLOBALS["adsid"] == true) {
                    print "&".SID;
                }
               ?>"><?php print $langcfg["butgoled"]; ?></a>
              <?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
              exit();
            }
        }
    }

/***************************************************************
**  so, this is the submitsetup section, and only gets called to setup
    the new users first calendar
***************************************************************/

    if(isset($submitsetup)) {

        unset($submitsetup);
        $fields = gmqfix($fields);

        $sqlstr = "select * from ".$tabpre."_cal_ini where userid = ".$user->gsv("cuid")." and calname = '".fmtfordb($fields["calname"],2)."'";

        $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $res_query1 = @mysql_num_rows($query1);
        if (mysql_error()) {
            die("Cannot query Calendar Config Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>Line: ".__LINE__.$GLOBALS["errep"]."<br><br>Result: ".$res_query1);
        }

        if($res_query1 > 0) {

print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";

            print "<title>".$langcfg["badcalnt"]."</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["sysbodystyle"].">\n";
            print "<center><br><h3>".$langcfg["badcaln"]." ".($fields["calname"])."</h3><br><a href=\"".$GLOBALS["idxfile"];
                if($GLOBALS["adsid"] == true) {
                    print "?".SID;
                }
            print "\">".$langcfg["pctta"]."</a></center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            exit();

        } else {

print $GLOBALS["htmldoctype"];
            print "<html>\n";
            print "<head>\n";

            print "<title>".$langcfg["pwsnc1"]."</title>\n";
            print "</head>\n";
            print "<body ".$GLOBALS["sysbodystyle"].">\n";
            print "<center><br><h3>".$langcfg["pwsnc2"]." '".($fields["calname"])."' ".$langcfg["pwsnc3"]."</h3><br><br><br><br>\n";

            srand((double)microtime()*1000000);
            $newcalid = md5(uniqid(rand()));

            $new_cal = getcalvals("0");
            srand((double)microtime()*1000000);
            $newcalid = md5(uniqid(rand()));
            $new_cal["calid"] = $newcalid;
            $new_cal["calname"] = fmtfordb($fields["calname"]);
            $new_cal["caltitle"] = fmtfordb($fields["caltitle"]);
            $new_cal["userid"] = $user->gsv("cuid");
            $new_cal["username"] = $user->gsv("uname");
            $new_cal["dtih"] = $fields["dtih"];
            $new_cal["caltype"] = $fields["caltype"];
            $new_cal["showweek"] = $fields["showweek"];
            $new_cal["collisioncheck"] = $fields["collisioncheck"];
            $new_cal["allcollisioncheck"] = $fields["allcollisioncheck"];
            $new_cal["collisionsave"] = $fields["collisionsave"];
            $new_cal["preferedview"] = $fields["preferedview"];
            $new_cal["weekstartonmonday"] = $fields["weekstartonmonday"];
            $new_cal["weekselreact"] = $fields["weekselreact"];
            $new_cal["daybeginhour"] = $fields["daybeginhour"];
            $new_cal["dayendhour"] = $fields["dayendhour"];
            $new_cal["timetype"] = $fields["timetype"];
            $new_cal["showstatus"] = $fields["showstatus"];
            $new_cal["showalltimes"] = $fields["showalltimes"];
            $new_cal["gcscoif_standardbgimg"] = $standardbgimg;

            if($GLOBALS["demomode"] == true) {

                    $fields["deiuser"] = 1;
                    $fields["deititle"] = 1;
                    $fields["deisub"] = 1;
                    $fields["deidate"] = 1;
                    $fields["deidesc"] = 1;
                    $fields["deirem"] = 1;
                    $fields["deiext"] = 1;
                    $fields["deicat"] = 1;
                    $fields["deirep"] = 1;
                    $fields["deiexc"] = 1;

            } else {

                if(!isset($fields["deiuser"])) {
                    $fields["deiuser"] = 0;
                }
                if(!isset($fields["deititle"])) {
                    $fields["deititle"] = 0;
                }
                if(!isset($fields["deisub"])) {
                    $fields["deisub"] = 0;
                }
                if(!isset($fields["deidate"])) {
                    $fields["deidate"] = 0;
                }
                if(!isset($fields["deidesc"])) {
                    $fields["deidesc"] = 0;
                }
                if(!isset($fields["deirem"])) {
                    $fields["deirem"] = 0;
                }
                if(!isset($fields["deiext"])) {
                    $fields["deiext"] = 0;
                }
                if(!isset($fields["deicat"])) {
                    $fields["deicat"] = 0;
                }
                if(!isset($fields["deirep"])) {
                    $fields["deirep"] = 0;
                }
                if(!isset($fields["deiexc"])) {
                    $fields["deiexc"] = 0;
                }
            }

            $sqlstr = "INSERT INTO ".$tabpre."_cal_ini (tuid";
            foreach($new_cal as $k1 => $v1) {
                if($k1<>"tuid") {
                    $sqlstr .= ",".$k1;
                    #if($xfloop == "") {$xfloop = ",";}
                }
            }
            $sqlstr .= ") values (''";

#            $sqlstr = "INSERT INTO ".$tabpre."_cal_ini VALUES (''";
            foreach($new_cal as $k1 => $v1) {
                if($k1<>"tuid") {
                    $sqlstr .= ",'".$v1."'";
                    #if($xfloop == "") {$xfloop = ",";}
                }
            }
            $sqlstr .= ")";

            $query1 = mysql_query($sqlstr) or die("Cannot save Calendar Config<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $sqlstr = "UPDATE ".$tabpre."_user_reg set startcalid = '$newcalid', startcalname = '".fmtfordb($fields["calname"])."' where uid = ".$user->gsv("cuid")." limit 1";
            $query1 = mysql_query($sqlstr) or die("Cannot save Calendar Config in User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $user->ssv("startcalid",$newcalid);
            $user->ssv("startcalname",fmtfordb($fields["calname"]));
            $user->ssv("curcalid",$newcalid);
            $user->ssv("curcalname",fmtfordb($fields["calname"]));
            $user->ssv("curcaltype",$fields["caltype"]);
            $user->ssv("curcalowner",1);

            getuserstandards($user);
            setcalbody();

//            print sprintf(stripslashes($langcfg["endwelc"]),$GLOBALS["idxfile"]);
    //        print sprintf($tstr1,$tstr2,$GLOBALS["idxfile"]);

            $tstr1 = $langcfg["endwelc"];
            $tstr1 = str_replace("%index%",$GLOBALS["idxfile"],$tstr1);

            print $tstr1;

            print "</center>";
            print "<br><br>";
            include($GLOBALS["CLPath"]."/include/footer.php");
            exit();
        }


/***************************************************************
**  this section saves the changed preferences
***************************************************************/

    } elseif(isset($submitprefs) || isset($submitgeneral) || isset($prefgocg) || isset($prefgogc) || isset($prefgomc) || isset($prefgoyv) || isset($prefgomv) || isset($prefgowv) || isset($prefgodv) || isset($prefgopu)) {

            set_time_limit(60);

            $haveupd = 0;
            $updcn = 0;
            $fields = gmqfix($fields);
            $prev = gmqfix($prev);

            if($GLOBALS["demomode"] == true) {

                    $fields["deiuser"] = 1;
                    $fields["deititle"] = 1;
                    $fields["deisub"] = 1;
                    $fields["deidate"] = 1;
                    $fields["deidesc"] = 1;
                    $fields["deirem"] = 1;
                    $fields["deiext"] = 1;
                    $fields["deicat"] = 1;
                    $fields["deirep"] = 1;
                    $fields["deiexc"] = 1;

            } else {
                if(!isset($fields["deiuser"])) {
                    $fields["deiuser"] = 0;
                }
                if(!isset($fields["deititle"])) {
                    $fields["deititle"] = 0;
                }
                if(!isset($fields["deisub"])) {
                    $fields["deisub"] = 0;
                }
                if(!isset($fields["deidate"])) {
                    $fields["deidate"] = 0;
                }
                if(!isset($fields["deidesc"])) {
                    $fields["deidesc"] = 0;
                }
                if(!isset($fields["deirem"])) {
                    $fields["deirem"] = 0;
                }
                if(!isset($fields["deiext"])) {
                    $fields["deiext"] = 0;
                }
                if(!isset($fields["deicat"])) {
                    $fields["deicat"] = 0;
                }
                if(!isset($fields["deirep"])) {
                    $fields["deirep"] = 0;
                }
                if(!isset($fields["deiexc"])) {
                    $fields["deiexc"] = 0;
                }
            }

            foreach($fields as $k1 => $v1) {

                #print "field: ".$k1." = ".$fields[$k1]."<br>";
                    if($fields[$k1] <> $prev[$k1]) {
                        if($k1=="calname") {
                            $updcn=1;
                            $newcn = ($fields[$k1]);
                        }
                        if($haveupd==0) {
                            $haveupd = 1;
                            $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_ini set ".$k1."='".fmtfordb($fields[$k1])."'";
                        } else {
                            $sqlstr .= ", ".$k1."='".fmtfordb($fields[$k1])."'";
                        }
                    }
            }

            if($haveupd==1) {

#                $sqlstr .= " where calid='".$user->gsv("curcalid")."' and userid=".$user->gsv("cuid")." limit 1";
                $sqlstr .= " where calid='".$user->gsv("curcalid")."' limit 1";
                $query1 = mysql_query($sqlstr) or die("Cannot update Calendar Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                if($updcn==1) {
                    $sqlstr = "update ".$GLOBALS["tabpre"]."_user_reg set startcalname='".fmtfordb($newcn,2)."' where startcalid='".$user->gsv("curcalid")."' and uid=".$user->gsv("cuid")." limit 1";
                    $query1 = mysql_query($sqlstr) or die("Cannot update user Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                    $user->ssv("curcalname",$newcn);
                }
                getuserstandards($user);
                setcalbody();
            }

/***************************************************************
**  this section returns to the preferences after saving
***************************************************************/

            if($user->gsv("isadmin") == 1 || $GLOBALS["usercustom"] == 1) {

                if(isset($submitprefs)) {
                    unset($submitprefs);
                    calsetup(0,"$csection",$user);
                } elseif(isset($submitgeneral)) {
                    unset($submitgeneral);
                    calsetup(0,"cg",$user);
                } elseif(isset($prefgocg)) {
                    unset($prefgocg);
                    calsetup(0,"cg",$user);
                } elseif(isset($prefgogc)) {
                    unset($prefgogc);
                    calsetup(0,"gc",$user);
                } elseif(isset($prefgomc)) {
                    unset($prefgomc);
                    calsetup(0,"mc",$user);
                } elseif(isset($prefgoyv)) {
                    unset($prefgoyv);
                    calsetup(0,"yv",$user);
                } elseif(isset($prefgomv)) {
                    unset($prefgomv);
                    calsetup(0,"mv",$user);
                } elseif(isset($prefgowv)) {
                    unset($prefgowv);
                    calsetup(0,"wv",$user);
                } elseif(isset($prefgodv)) {
                    unset($prefgodv);
                    calsetup(0,"dv",$user);
                } elseif(isset($prefgopu)) {
                    unset($prefgopu);
                    calsetup(0,"pu",$user);
                }
            }

/***************************************************************
**  this section goes to the prefs
***************************************************************/

    } elseif(isset($goprefs)) {

        unset($goprefs);
        if($user->gsv("isadmin") == 1 || $GLOBALS["usercustom"] == 1) {
            calsetup(0,"cg",$user);
        }

    }

function setcalbody() {

    global $calbodystyle,$curcalcfg;

    $calbodystyle = "style=\"";

    if($curcalcfg["gcscoif_btxtfont"] != "" && $GLOBALS["allow_btxtfont"]==1) {
        $calbodystyle .= "font-family: ".$curcalcfg["gcscoif_btxtfont"]."; font-size: ".$curcalcfg["gcscoif_btxtsize"]."pt; ";
    } else if($GLOBALS["btxtfont"] != "") {
        $calbodystyle .= "font-family: ".$GLOBALS["btxtfont"]."; font-size: ".$GLOBALS["btxtfontsize"]."pt; ";
    } else {
        $calbodystyle .= "font-family: Times New Roman; font-size: 11pt; ";
    }

    if($curcalcfg["gcscocf_btxtcolor"] != "" && $GLOBALS["allow_btxtcolor"]==1) {
        $calbodystyle .= "color: ".$curcalcfg["gcscocf_btxtcolor"]."; ";
    } else if($GLOBALS["btxtcolor"] != "") {
        $calbodystyle .= "color: ".$GLOBALS["btxtcolor"]."; ";
    } else {
        $calbodystyle .= "color: Black; ";
    }
    $calbodystyle .= "\" ";

    if($curcalcfg["gcscocf_standardbgcolor"] != "" && $GLOBALS["allow_standardbgcolor"]==1) {
        $calbodystyle .= "bgcolor=\"".$curcalcfg["gcscocf_standardbgcolor"]."\" ";
    } else if($GLOBALS["standardbgcolor"] != "") {
        $calbodystyle .= "bgcolor=\"".$GLOBALS["standardbgcolor"]."\" ";
    } else {
        $calbodystyle .= "bgcolor=\"White\" ";
    }

    if($curcalcfg["gcscoif_standardbgimg"] != "" && $GLOBALS["allow_standardbgimg"]==1) {
        $calbodystyle .= "background=\"".$curcalcfg["gcscoif_standardbgimg"]."\" ";
    } else if($GLOBALS["standardbgimg"] != "") {
        $calbodystyle .= "background=\"".$GLOBALS["standardbgimg"]."\" ";
    } else {
        $calbodystyle .= "background=\"\" ";
    }

}

?>
