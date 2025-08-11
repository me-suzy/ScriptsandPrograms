<?php

#
# Table structure for table `".$tabpre."_user_groups
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_groups";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_user_groups (
    uid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    groupname VARCHAR( 100 ) DEFAULT ' ' NOT NULL ,
    INDEX ( groupname )
    ) COMMENT = 'CaLogic User Groups Table'";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "INSERT INTO ".$tabpre."_user_groups VALUES (1,'Guest')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "INSERT INTO ".$tabpre."_user_groups VALUES (2,'All Users')";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


#
# Table structure for table `".$tabpre."_user_cal_grp
#


    $sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_cal_grp";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_user_cal_grp (
    uid INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    userid INT( 11 ) NOT NULL ,
    calid VARCHAR( 32 ) NOT NULL ,
    grpid INT( 11 ) NOT NULL ,
    level INT( 11 ) DEFAULT '0' NOT NULL
    ) COMMENT = 'CaLogic User Group Rights Table'";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_cal_grp ADD INDEX ( userid ) ";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_cal_grp ADD INDEX ( calid ) ";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_cal_grp ADD INDEX ( grpid ) ";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Table structure for table `".$tabpre."_cal_event_rems`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_cal_event_rems";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_cal_event_rems (
  remid int(11) NOT NULL auto_increment,
  calid varchar(32) NOT NULL default '',
  uid int(11) NOT NULL default '0',
  evid int(11) NOT NULL default '0',
  contyp char(1) NOT NULL default '',
  conid int(11) NOT NULL default '0',
  srint TINYINT DEFAULT '0' NOT NULL ,
  srval INT( 11 ) DEFAULT '0' NOT NULL ,
  fname VARCHAR( 50 ) DEFAULT ' ' NOT NULL ,
  lname VARCHAR( 50 ) DEFAULT ' ' NOT NULL ,
  remail VARCHAR( 100 ) DEFAULT ' ' NOT NULL ,
  remailtype VARCHAR( 4 ) DEFAULT 'HTML' NOT NULL ,
  rtzos int(11) NOT NULL default '0',
  remark TEXT ,
  approved TINYINT DEFAULT '0' NOT NULL ,
  confirmed TINYINT DEFAULT '0' NOT NULL ,
  confirmkey VARCHAR( 32 ) DEFAULT ' ' NOT NULL ,
  pending TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY  (remid),
  INDEX ( calid, uid, evid )
) TYPE=MyISAM COMMENT='CaLogic Event Reminder List'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_log`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_log";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_log (
    hlid INT( 11 ) NOT NULL AUTO_INCREMENT ,
    uid INT( 11 ) DEFAULT '0' NOT NULL ,
    calid VARCHAR( 32 ) DEFAULT '0' NOT NULL ,
    evid INT( 11 ) DEFAULT '0' NOT NULL ,
    hldate BIGINT( 20 ) DEFAULT '0' NOT NULL ,
    adate BIGINT( 20 ) DEFAULT '0' NOT NULL ,
    laction VARCHAR( 100 ) DEFAULT ' ' NOT NULL ,
    lbefore MEDIUMTEXT ,
    lafter MEDIUMTEXT ,
    remarks TEXT ,
    PRIMARY KEY ( hlid ) ,
    INDEX ( uid , calid , evid , hldate , adate , laction )
    ) TYPE=MyISAM COMMENT = 'CaLogic History and Log Table'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table ".$tabpre."_ext_def
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_ext_def";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_ext_def (
    efid INT( 11 ) AUTO_INCREMENT PRIMARY KEY ,
    uid INT( 11 ) DEFAULT '0' NOT NULL ,
    calid VARCHAR( 32 ) DEFAULT '0' NOT NULL ,
    efuseage TINYINT DEFAULT '0' NOT NULL ,
    eftype VARCHAR( 20 ) DEFAULT ' ' NOT NULL ,
    eftext VARCHAR( 20 ) DEFAULT ' ' NOT NULL ,
    format VARCHAR( 10 ) DEFAULT 'Input' NOT NULL ,
    standard TINYINT DEFAULT '0' NOT NULL ,
    required TINYINT DEFAULT '0' NOT NULL ,
    validate TINYINT DEFAULT '0' NOT NULL ,
    checktype VARCHAR( 20 ) DEFAULT 'Text' NOT NULL ,
    maxlen INT DEFAULT '50' NOT NULL ,
    INDEX ( uid , calid , eftype )
    ) TYPE=MyISAM COMMENT = 'CaLogic Extended Field Definition Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------


#
# Table structure for table ".$tabpre."_extents
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_extents";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_extents (
    exid INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    evid INT( 11 ) DEFAULT '0' NOT NULL ,
    efid INT( 11 ) DEFAULT '0' NOT NULL ,
    efsid INT( 11 ) DEFAULT '0' NOT NULL ,
    exval MEDIUMTEXT,
    INDEX ( exid,evid,efid,efsid )
    ) TYPE=MyISAM COMMENT = 'CaLogic Extended Field Values Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table ".$tabpre."_ext_sel_def
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_ext_sel_def";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_ext_sel_def (
    efsid INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    efid INT( 11 ) DEFAULT '0' NOT NULL ,
    efsval VARCHAR( 50 ) DEFAULT ' ' NOT NULL ,
    standard TINYINT DEFAULT '0' NOT NULL ,
    INDEX ( efid )
    ) TYPE=MyISAM COMMENT = 'CaLogic Extended Select Field Definition Table'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_cal_events`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_cal_events";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_cal_events (
  evid int(11) NOT NULL auto_increment,
  uid int(11) NOT NULL default '0',
  calid varchar(32) NOT NULL default '',
  title varchar(50) NOT NULL default '',
  subtitle varchar(50) NOT NULL default '',
  description text NOT NULL,
  catid int(11) NOT NULL default '0',
  startday char(2) NOT NULL default '',
  startmonth char(2) NOT NULL default '',
  startyear varchar(4) NOT NULL default '',
  isallday tinyint(4) NOT NULL default '0',
  starthour char(2) NOT NULL default '',
  startmin char(2) NOT NULL default '',
  endhour char(2) NOT NULL default '',
  endmin char(2) NOT NULL default '',
  sendreminder TINYINT DEFAULT '0' NOT NULL ,
  remsuballow TINYINT DEFAULT '0' NOT NULL ,
  remsublevel TINYINT DEFAULT '0' NOT NULL ,
  extfields TINYINT DEFAULT '0' NOT NULL ,
  iseventseries tinyint(4) NOT NULL default '0',
  estype tinyint(4) NOT NULL default '0',
  estd tinyint(4) NOT NULL default '0',
  estdint int(11) NOT NULL default '0',
  estwint int(11) NOT NULL default '0',
  estwd varchar(7) NOT NULL default '0000000',
  estm tinyint(4) NOT NULL default '0',
  estm1d char(2) NOT NULL default '',
  estm1int int(11) NOT NULL default '0',
  estm2dp int(11) NOT NULL default '0',
  estm2wd int(11) NOT NULL default '0',
  estm2int int(11) NOT NULL default '0',
  esty tinyint(4) NOT NULL default '0',
  esty1d char(2) NOT NULL default '',
  esty1m char(2) NOT NULL default '',
  esty2dp int(11) NOT NULL default '0',
  esty2wd int(11) NOT NULL default '0',
  esty2m char(2) NOT NULL default '',
  ese tinyint(4) NOT NULL default '0',
  eseaoint int(11) NOT NULL default '0',
  esed char(2) NOT NULL default '',
  esem char(2) NOT NULL default '',
  esey varchar(4) NOT NULL default '',
  endafterdate varchar(10) NOT NULL default '',
  endafterdays bigint(20) NOT NULL default '0',
  pending TINYINT(4) NOT NULL DEFAULT '0',
  public TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY  (evid)
) TYPE=MyISAM COMMENT='CaLogic Calendar Events Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_cal_event_exceptions`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_cal_event_exceptions";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_cal_event_exceptions (
  exid int(11) NOT NULL auto_increment,
  evid int(11) NOT NULL,
  calid varchar(32) NOT NULL default '',
  exday char(2) NOT NULL default '',
  exmonth char(2) NOT NULL default '',
  exyear varchar(4) NOT NULL default '',
  PRIMARY KEY  (exid),
  KEY calid (calid)
) TYPE=MyISAM COMMENT='CaLogic Event Exceptions'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_cal_ini`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_cal_ini";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_cal_ini (
  tuid int(11) NOT NULL auto_increment,
  calid varchar(32) NOT NULL default '0',
  calname varchar(50) NOT NULL default 'Default',
  userid int(11) NOT NULL default '0',
  username varchar(10) NOT NULL default 'Default',
  deiuser TINYINT(4) DEFAULT '1' NOT NULL,
  deititle TINYINT(4) DEFAULT '1' NOT NULL,
  deisub TINYINT(4) DEFAULT '1' NOT NULL,
  deidate TINYINT(4) DEFAULT '1' NOT NULL,
  deidesc TINYINT(4) DEFAULT '1' NOT NULL,
  deirem TINYINT(4) DEFAULT '1' NOT NULL,
  deiext TINYINT(4) DEFAULT '1' NOT NULL,
  deicat TINYINT(4) DEFAULT '1' NOT NULL,
  deirep TINYINT(4) DEFAULT '1' NOT NULL,
  deiexc TINYINT(4) DEFAULT '1' NOT NULL,
  caltitle varchar(100) NOT NULL default 'Default',
  caltype tinyint(4) NOT NULL default '0',
  dtih TINYINT(4) NOT NULL DEFAULT '0',
  collisioncheck TINYINT(4) NOT NULL DEFAULT '1',
  allcollisioncheck TINYINT(4) NOT NULL DEFAULT '1',
  collisionsave TINYINT(4) DEFAULT '1' NOT NULL,
  catcollisioncheck TINYINT(4) NOT NULL DEFAULT '0',
  showstatus TINYINT(4) NOT NULL DEFAULT '1',
  showweek tinyint(4) NOT NULL default '1',
  weektype tinyint(4) NOT NULL default '1',
  preferedview varchar(20) NOT NULL default 'Month',
  weekstartonmonday tinyint(4) NOT NULL default '1',
  weekselreact tinyint(4) NOT NULL default '1',
  daybeginhour varchar(5) NOT NULL default '0000',
  dayendhour varchar(5) NOT NULL default '0000',
  timetype tinyint(4) NOT NULL default '0',
  showalltimes tinyint(4) NOT NULL default '1',
  gcscoif_subtitletxt varchar(20) NOT NULL default 'Sub Title:',
  gcscoif_standardbgimg varchar(100) NOT NULL default './img/stonbk.jpg',
  gcscoif_btxtfont VARCHAR(20) DEFAULT 'Times New Roman' NOT NULL,
  gcscocf_btxtcolor VARCHAR(20) DEFAULT 'Black' NOT NULL,
  gcscoif_btxtsize VARCHAR(20) DEFAULT '11' NOT NULL,
  gcscocf_standardbgcolor VARCHAR(20) DEFAULT 'White' NOT NULL,
  gcscocf_prevcolor varchar(20) NOT NULL default '#0000FF',
  gcscocf_prevbgcolor varchar(20) NOT NULL default '',
  gcscosf_prevstyle varchar(50) NOT NULL default 'underline',
  gcscocf_nextcolor varchar(20) NOT NULL default '#0000FF',
  gcscocf_nextbgcolor varchar(20) NOT NULL default '',
  gcscosf_nextstyle varchar(50) NOT NULL default 'underline',
  gcscocf_prefcolor varchar(20) NOT NULL default '#0000FF',
  gcscosf_prefstyle varchar(50) NOT NULL default 'underline',
  gcscocf_cssc varchar(20) NOT NULL default '#FFFF80',
  gcscoif_headpic varchar(100) NULL default '',
  gcscoif_headtext varchar(100) NULL default '',
  gcscoif_headlink varchar(100) NULL default '',
  gcscoif_headtarget varchar(100) NULL default '_blank',
  gcscoif_footpic varchar(100) NULL default '',
  gcscoif_foottext varchar(100) NULL default '',
  gcscoif_footlink varchar(100) NULL default '',
  gcscoif_foottarget varchar(100) NULL default '_blank',
  gcscoyn_allowdv tinyint(4) NOT NULL default '1',
  gcscoyn_allowwv tinyint(4) NOT NULL default '1',
  gcscoyn_allowmv tinyint(4) NOT NULL default '1',
  gcscoyn_allowyv tinyint(4) NOT NULL default '1',
  gcscoyn_dispwvpd tinyint(4) NOT NULL default '1',
  gcscoyn_dispmvpd tinyint(4) NOT NULL default '1',
  gcscoyn_dispyvpd tinyint(4) NOT NULL default '1',
  gcscoyn_dispcnpd tinyint(4) NOT NULL default '1',
  gcscoyn_dispevcr tinyint(4) NOT NULL default '1',
  gcscoyn_withesb tinyint(4) NOT NULL default '1',
  gcscoyn_withwvesb tinyint(4) NOT NULL default '1',
  gcscoyn_withdvesb tinyint(4) NOT NULL default '0',
  gcscoyn_showomd tinyint(4) NOT NULL default '1',
  gcscoyn_showwvtime tinyint(4) NOT NULL default '1',
  gcscoyn_showdvtime tinyint(4) NOT NULL default '1',
  pu_functionmenutype tinyint(4) NOT NULL default '1',
  pu_MenuBarColor varchar(20) NOT NULL default 'Burlywood',
  pu_MenuBarFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_MenuBarFontColor varchar(20) NOT NULL default '#000000',
  pu_MenuBarFontSize varchar(10) NOT NULL default '12',
  pu_MenuBarHighlightColor varchar(20) NOT NULL default 'Saddlebrown',
  pu_MenuBarHighlightFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_MenuBarHighlightFontColor varchar(20) NOT NULL default '#FFFFFF',
  pu_MenuItemBorderColor varchar(20) NOT NULL default 'Saddlebrown',
  pu_MenuItemColor varchar(20) NOT NULL default 'Wheat',
  pu_MenuItemFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_MenuItemFontColor varchar(20) NOT NULL default 'Black',
  pu_MenuItemFontSize varchar(10) NOT NULL default '11',
  pu_MenuItemHighlightColor varchar(20) NOT NULL default 'Peru',
  pu_MenuItemHighlightFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_MenuItemHighlightFontColor varchar(20) NOT NULL default 'White',
  pu_PopupDayCaptionColor varchar(20) NOT NULL default '#009933',
  pu_PopupDayCaptionFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_PopupDayCaptionFontColor varchar(20) NOT NULL default '#FFFFFF',
  pu_PopupDayCaptionSize varchar(10) NOT NULL default '1',
  pu_PopupDayColor varchar(20) NOT NULL default '#99ff99',
  pu_PopupDayFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_PopupDayFontColor varchar(20) NOT NULL default '#000000',
  pu_PopupDayFontSize varchar(10) NOT NULL default '1',
  pu_PopupEventCaptionColor varchar(20) NOT NULL default '#333399',
  pu_PopupEventCaptionFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_PopupEventCaptionFontColor varchar(20) NOT NULL default '#FFFFFF',
  pu_PopupEventCaptionSize varchar(10) NOT NULL default '1',
  pu_PopupEventColor varchar(20) NOT NULL default '#CCCCFF',
  pu_PopupEventFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_PopupEventFontColor varchar(20) NOT NULL default '#000000',
  pu_PopupEventFontSize varchar(10) NOT NULL default '1',
  pu_PopupCreatorCaptionColor varchar(20) NOT NULL default '#FF6633',
  pu_PopupCreatorCaptionFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_PopupCreatorCaptionFontColor varchar(20) NOT NULL default '#FFFFFF',
  pu_PopupCreatorCaptionSize varchar(10) NOT NULL default '1',
  pu_PopupCreatorColor varchar(20) NOT NULL default '#FEF3E0',
  pu_PopupCreatorFont varchar(100) NOT NULL default 'Verdana,Arial,Helvetica',
  pu_PopupCreatorFontColor varchar(20) NOT NULL default '#000000',
  pu_PopupCreatorFontSize varchar(10) NOT NULL default '1',
  mcdividerlinecolor varchar(20) NOT NULL default '#000000',
  mcttcolor varchar(20) NOT NULL default '#B04040',
  mcttbgcolor varchar(20) NOT NULL default '#FFFFFF',
  mcttstyle varchar(50) NOT NULL default 'none',
  mcttcellcolor varchar(20) NOT NULL default '#FFFFFF',
  mcheaderwdcolor varchar(20) NOT NULL default '#FF0000',
  mcheaderwdbgcolor varchar(20) NOT NULL default '#80FFFF',
  mcheaderwecolor varchar(20) NOT NULL default '#0000FF',
  mcheaderwebgcolor varchar(20) NOT NULL default '#FFFF80',
  mcwdcolor varchar(20) NOT NULL default '#000000',
  mcwdbgcolor varchar(20) NOT NULL default '#C0C0C0',
  mcwdstyle varchar(50) NOT NULL default 'none',
  mcwdcellcolor varchar(20) NOT NULL default '#C0C0C0',
  mcwecolor varchar(20) NOT NULL default '#000000',
  mcwebgcolor varchar(20) NOT NULL default '#808080',
  mcwestyle varchar(50) NOT NULL default 'none',
  mcwecellcolor varchar(20) NOT NULL default '#808080',
  mccdcolor varchar(20) NOT NULL default '#0000FF',
  mccdbgcolor varchar(20) NOT NULL default '#FFFF80',
  mccdstyle varchar(50) NOT NULL default 'none',
  mccdcellcolor varchar(20) NOT NULL default '#FFFF80',
  mcnccolor varchar(20) NOT NULL default '#000000',
  mcncbgcolor varchar(20) NOT NULL default '#FFFFFF',
  mcncstyle varchar(50) NOT NULL default 'none',
  mcnccellcolor varchar(20) NOT NULL default '#FFFFFF',
  mcdwecellcolor varchar(20) NOT NULL default 'Lightpink',
  yvdividerlinecolor varchar(20) NOT NULL default '#000000',
  yvheadercolor varchar(20) NOT NULL default '#000000',
  yvttcolor varchar(20) NOT NULL default '#B04040',
  yvttbgcolor varchar(20) NOT NULL default '#FFFFFF',
  yvttstyle varchar(50) NOT NULL default 'none',
  yvttcellcolor varchar(20) NOT NULL default '#FFFFFF',
  yvheaderwdcolor varchar(20) NOT NULL default '#FF0000',
  yvheaderwdbgcolor varchar(20) NOT NULL default '#80FFFF',
  yvheaderwecolor varchar(20) NOT NULL default '#0000FF',
  yvheaderwebgcolor varchar(20) NOT NULL default '#FFFF80',
  yvwdcolor varchar(20) NOT NULL default '#000000',
  yvwdbgcolor varchar(20) NOT NULL default '#C0C0C0',
  yvwdstyle varchar(50) NOT NULL default 'none',
  yvwdcellcolor varchar(20) NOT NULL default '#C0C0C0',
  yvwecolor varchar(20) NOT NULL default '#000000',
  yvwebgcolor varchar(20) NOT NULL default '#808080',
  yvwestyle varchar(50) NOT NULL default 'none',
  yvwecellcolor varchar(20) NOT NULL default '#808080',
  yvcdcolor varchar(20) NOT NULL default '#0000FF',
  yvcdbgcolor varchar(20) NOT NULL default '#FFFF80',
  yvcdstyle varchar(50) NOT NULL default 'none',
  yvcdcellcolor varchar(20) NOT NULL default '#FFFF80',
  yvnccellcolor varchar(20) NOT NULL default '#FFFFFF',
  yvdwecellcolor varchar(20) NOT NULL default 'Lightpink',
  yvselmc_mcyv tinyint(4) NOT NULL default '3',
  mvdividerlinecolor varchar(20) NOT NULL default '#000000',
  mvheadercolor varchar(20) NOT NULL default '#000000',
  mvheaderwdcolor varchar(20) NOT NULL default '#FF0000',
  mvheaderwdbgcolor varchar(20) NOT NULL default '#80FFFF',
  mvheaderwecolor varchar(20) NOT NULL default '#0000FF',
  mvheaderwebgcolor varchar(20) NOT NULL default '#FFFF80',
  mvwdcolor varchar(20) NOT NULL default '#000000',
  mvwdbgcolor varchar(20) NOT NULL default '#C0C0C0',
  mvwdstyle varchar(50) NOT NULL default 'none',
  mvwdcellcolor varchar(20) NOT NULL default '#C0C0C0',
  mvwecolor varchar(20) NOT NULL default '#000000',
  mvwebgcolor varchar(20) NOT NULL default '#808080',
  mvwestyle varchar(50) NOT NULL default '#none',
  mvwecellcolor varchar(20) NOT NULL default '#808080',
  mvcdcolor varchar(20) NOT NULL default '#0000FF',
  mvcdbgcolor varchar(20) NOT NULL default '#FFFF80',
  mvcdstyle varchar(50) NOT NULL default 'none',
  mvcdcellcolor varchar(20) NOT NULL default '#FFFF80',
  mvnccolor varchar(20) NOT NULL default '#000000',
  mvncbgcolor varchar(20) NOT NULL default '#FFFFFF',
  mvncstyle varchar(50) NOT NULL default 'none',
  mvnccellcolor varchar(20) NOT NULL default '#FFFFFF',
  mvwlcolor varchar(20) NOT NULL default '#B04040',
  mvwlbgcolor varchar(20) NOT NULL default '',
  mvwlstyle varchar(50) NOT NULL default 'none',
  mvselmc_mcmv tinyint(4) NOT NULL default '2',
  wvdividerlinecolor varchar(20) NOT NULL default '#000000',
  wvheadercolor varchar(20) NOT NULL default '#000000',
  wvheaderwdcolor varchar(20) NOT NULL default '#FF0000',
  wvheaderwdbgcolor varchar(20) NOT NULL default '#80FFFF',
  wvheaderwdstyle varchar(50) NOT NULL default 'none',
  wvheaderwdcellcolor varchar(20) NOT NULL default '#80FFFF',
  wvheaderwecolor varchar(20) NOT NULL default '#0000FF',
  wvheaderwebgcolor varchar(20) NOT NULL default '#FFFF80',
  wvheaderwestyle varchar(50) NOT NULL default 'none',
  wvheaderwecellcolor varchar(20) NOT NULL default '#FFFF80',
  wvheadercdcolor varchar(20) NOT NULL default '#0000FF',
  wvheadercdbgcolor varchar(20) NOT NULL default '#FFFF80',
  wvheadercdstyle varchar(50) NOT NULL default 'none',
  wvheadercdcellcolor varchar(20) NOT NULL default '#FFFF80',
  wvheaderadcolor varchar(20) NOT NULL default '#000000',
  wvheaderadbgcolor varchar(20) NOT NULL default '#008000',
  wvheaderadcellcolor varchar(20) NOT NULL default '#008000',
  wvawdcolor varchar(20) NOT NULL default '#000000',
  wvawdbgcolor varchar(20) NOT NULL default '#C0C0C0',
  wvawdcellcolor varchar(20) NOT NULL default '#C0C0C0',
  wvawecolor varchar(20) NOT NULL default '#000000',
  wvawebgcolor varchar(20) NOT NULL default '#808080',
  wvawecellcolor varchar(20) NOT NULL default '#808080',
  wvacdcolor varchar(20) NOT NULL default '#000000',
  wvacdbgcolor varchar(20) NOT NULL default '#FFFF80',
  wvacdcellcolor varchar(20) NOT NULL default '#FFFF80',
  wvwdcolor varchar(20) NOT NULL default '#000000',
  wvwdbgcolor varchar(20) NOT NULL default '#C0C0C0',
  wvwdcellcolor varchar(20) NOT NULL default '#C0C0C0',
  wvwecolor varchar(20) NOT NULL default '#000000',
  wvwebgcolor varchar(20) NOT NULL default '#808080',
  wvwecellcolor varchar(20) NOT NULL default '#808080',
  wvcdcolor varchar(20) NOT NULL default '#000000',
  wvcdbgcolor varchar(20) NOT NULL default '#FFFF80',
  wvcdcellcolor varchar(20) NOT NULL default '#FFFF80',
  wvtccolor varchar(20) NOT NULL default '#000000',
  wvtcbgcolor varchar(20) NOT NULL default '#FFFFFF',
  wvtccellcolor varchar(20) NOT NULL default '#FFFFFF',
  wvselmc_mcwv tinyint(4) NOT NULL default '0',
  dvdividerlinecolor varchar(20) NOT NULL default '#000000',
  dvheadercolor varchar(20) NOT NULL default '#000000',
  dvadcolor varchar(20) NOT NULL default '#000000',
  dvadbgcolor varchar(20) NOT NULL default '#008000',
  dvadcellcolor varchar(20) NOT NULL default '#008000',
  dvawdcolor varchar(20) NOT NULL default '#000000',
  dvawdbgcolor varchar(20) NOT NULL default '#008000',
  dvawdcellcolor varchar(20) NOT NULL default '#008000',
  dvawecolor varchar(20) NOT NULL default '#000000',
  dvawebgcolor varchar(20) NOT NULL default '#008000',
  dvawecellcolor varchar(20) NOT NULL default '#008000',
  dvacdcolor varchar(20) NOT NULL default '#000000',
  dvacdbgcolor varchar(20) NOT NULL default '#008000',
  dvacdcellcolor varchar(20) NOT NULL default '#008000',
  dvwdcolor varchar(20) NOT NULL default '#000000',
  dvwdbgcolor varchar(20) NOT NULL default '#C0C0C0',
  dvwdcellcolor varchar(20) NOT NULL default '#C0C0C0',
  dvwecolor varchar(20) NOT NULL default '#000000',
  dvwebgcolor varchar(20) NOT NULL default '#808080',
  dvwecellcolor varchar(20) NOT NULL default '#808080',
  dvcdcolor varchar(20) NOT NULL default '#000000',
  dvcdbgcolor varchar(20) NOT NULL default '#FFFF80',
  dvcdcellcolor varchar(20) NOT NULL default '#FFFF80',
  dvtccolor varchar(20) NOT NULL default '#000000',
  dvtcbgcolor varchar(20) NOT NULL default '#FFFFFF',
  dvtccellcolor varchar(20) NOT NULL default '#FFFFFF',
  dvselmc_mcdv tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (tuid),
  KEY calid (calid),
  KEY calname (calname),
  KEY userid (userid),
  KEY username (username)
) TYPE=MyISAM COMMENT='CaLogic Calendar Configuration Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#
# Dumping data for table `".$tabpre."_cal_ini`
#

$sqlstr = "INSERT INTO ".$tabpre."_cal_ini (tuid) VALUES (1)";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


#$sqlstr = "INSERT INTO ".$tabpre."_cal_ini VALUES (1,'0','Default',0,'Default',1,1,1,1,1,1,1,1,1,1,'Default',0,0,1,1,0,1,1,1,'Month',1,1,'0000','0000',0,1,'./img/stonbk.jpg','Times New Roman','Black','11','White','#0000FF','','underline','#0000FF','','underline','#0000FF','underline','#FFFF80','#000000','#B04040','#FFFFFF','none','#FFFFFF', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#FFFFFF', 'none', '#FFFFFF', 'Lightpink', '#000000', '#000000', '#B04040', '#FFFFFF', 'none', '#FFFFFF', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#FFFFFF', 'Lightpink', '#000000', '#000000', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#FFFFFF', 'none', '#FFFFFF', '#B04040', '', 'none', '#000000', '#000000', '#FF0000', '#80FFFF', 'none', '#80FFFF', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#008000', '#008000', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#FFFFFF', '#FFFFFF', '#000000', '#000000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#FFFFFF', '#FFFFFF')";
#mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_languages`
#
#
# Global Languages table
# The Actual Language entry is added with the laguage file.
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_languages";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_languages (
  uid int(10) unsigned NOT NULL auto_increment,
  name varchar(20) NOT NULL default '',
  remark varchar(50) default NULL,
  PRIMARY KEY  (uid),
  UNIQUE KEY name (name),
  KEY name_2 (name)
) TYPE=MyISAM COMMENT='CaLogic Languages table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


#
# Table structure for table `".$tabpre."_user_cat`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_cat";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_user_cat (
  catid int(11) NOT NULL auto_increment,
  uid int(11) NOT NULL default '0',
  calid varchar(32) NOT NULL default '0',
  catname varchar(20) NOT NULL default '',
  catcolortext varchar(20) NOT NULL default '',
  catcolorbg varchar(20) NOT NULL default '',
  PRIMARY KEY  (catid),
  KEY uid (uid),
  KEY calid (calid)
) TYPE=MyISAM COMMENT='CaLogic User Categories'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_user_con`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_con";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_user_con (
  conid int(11) NOT NULL auto_increment,
  uid int(11) NOT NULL default '0',
  shared BIGINT DEFAULT '0' NOT NULL ,
  fname varchar(30) NOT NULL default '',
  lname varchar(30) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  emailtype varchar(4) NOT NULL default 'HTML',
  bday varchar(10) NOT NULL default '',
  tzos int(11) NOT NULL default '0',
  tel1 varchar(20) NOT NULL default '',
  tel2 varchar(20) NOT NULL default '',
  tel3 varchar(20) NOT NULL default '',
  fax varchar(20) NOT NULL default '',
  address text NOT NULL,
  PRIMARY KEY  (conid),
  KEY uid (uid)
) TYPE=MyISAM COMMENT='CaLogic User Contacts Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_user_con_grp`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_con_grp";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_user_con_grp (
  congpid int(11) NOT NULL auto_increment,
  uid int(11) NOT NULL default '0',
  shared BIGINT DEFAULT '0' NOT NULL ,
  gpname varchar(20) NOT NULL default '',
  PRIMARY KEY  (congpid)
) TYPE=MyISAM COMMENT='CaLogic User Contact Groups'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_user_reg`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_reg";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_user_reg (
  uid int(10) unsigned NOT NULL auto_increment,
  uname varchar(10) NOT NULL default '',
  fname varchar(20) NOT NULL default '',
  lname varchar(20) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  emailtype VARCHAR(4) NOT NULL default 'HTML',
  isadmin tinyint(1) NOT NULL default '0',
  pw varchar(32) NOT NULL default '',
  newpw tinyint(4) NOT NULL default '0',
  failedli TINYINT DEFAULT '0' NOT NULL,
  nextpwdate INT DEFAULT '0' NOT NULL,
  emok tinyint(4) NOT NULL default '0',
  langid int(11) NOT NULL default '0',
  language varchar(20) NOT NULL default '',
  startcalid varchar(32) NOT NULL default '0',
  startcalname varchar(50) NOT NULL default '',
  tzos int(11) NOT NULL default '0',
  tzlock tinyint(4) NOT NULL default '0',
  regtime int(11) NOT NULL default '0',
  conftime int(11) NOT NULL default '0',
  regkey varchar(32) NOT NULL default '',
  session varchar(32) NOT NULL default '',
  cookie varchar(32) NOT NULL default '',
  udefscid VARCHAR(32) NOT NULL DEFAULT '0',
  udefscname VARCHAR(50) NOT NULL DEFAULT '',
  PRIMARY KEY (uid),
  KEY langid (langid),
  KEY language (language),
  KEY uname (uname),
  KEY email (email)
) TYPE=MyISAM COMMENT='CaLogic User Registration Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

#
# Table structure for table `".$tabpre."_user_congrp_link`
#

$sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_congrp_link";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$sqlstr = "CREATE TABLE ".$tabpre."_user_congrp_link (
gplinkid BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
uid BIGINT DEFAULT '0' NOT NULL ,
conid BIGINT DEFAULT '0' NOT NULL ,
congpid BIGINT DEFAULT '0' NOT NULL ,
INDEX ( uid , conid , congpid )
) TYPE=MyISAM COMMENT = 'CaLogic User Contact Group Link Table'";
mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# --------------------------------------------------------

?>
