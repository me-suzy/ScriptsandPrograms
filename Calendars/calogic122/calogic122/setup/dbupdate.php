<?php

# this is the dynamic database update program.
# it will attempt to automatically update your CaLogic database,
# no matter what version you are currently using.
print "<br>Checking and updating Database...<br>";

global $tabpre,$calogicversion,$langtabs;

$langtabs = array("Deutsch", "English", "French", "Swedish");

# update from versions 1.0.0a, 1.0.1a, 1.0.2a or 1.0.3a

$havetzos = false;

$sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_con";
$query = mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$i = 0;
while ($i < mysql_num_fields($query)) {
    $meta = mysql_fetch_field($query);
    $fname = $meta->name;
    if($fname == "tzos") {$havetzos = true;}
    $i++;
}
if($havetzos == false) {
    print "<br>Updating database to Version 1.0.4a<br>";
    $sqlstr = "ALTER TABLE ".$GLOBALS["tabpre"]."_user_con ADD tzos INT DEFAULT '0' NOT NULL AFTER bday";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

}

@mysql_free_result($query);

# update from version 1.0.4a

$haveclver = false;
$haveoldver = false;
$vergot = "";

$sqlstr = "select * from ".$GLOBALS["tabpre"]."_setup";
$query = mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

$query2 = mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
$updrow = mysql_fetch_array($query2) or die("Database query error<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);

$i = 0;
while ($i < mysql_num_fields($query)) {
    $meta = mysql_fetch_field($query);
    $fname = $meta->name;
#    print $fname.": ".$row[$fname]."<br>";
    if($fname == "calogic_version") {
        $haveclver = true;
        $haveoldver=true;
        $vergot = $updrow[$fname];
        break;
    }
    if($fname == "calogicversion") {
        $haveclver = true;
        $vergot = $updrow[$fname];
        break;
    }
    $i++;
}

@mysql_free_result($query);
@mysql_free_result($query2);

if($haveoldver==true) {
    $sqlstr = "ALTER TABLE ".$tabpre."_setup CHANGE calogic_version calogicversion varchar(15) NOT NULL default '$calogicversion';";
    mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
}

if($haveclver == false) {
    $sqlstr = "ALTER TABLE ".$tabpre."_setup ADD calogicversion varchar(15) NOT NULL default '$calogicversion';";
}

if($haveclver == false || $vergot=="1.0.4a") {
    print "<br>Updating database to Version 1.0.5a<br>";
    $sqlstr = "delete from ".$GLOBALS["tabpre"]."_cal_ini where tuid = '1'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_ini VALUES (1, '0', 'Default', 0, 'Default', 'Default', 0, 1, 'Month', 1, 1, '0000', '0000', 1, './img/stonbk.jpg', '#0000FF', '', 'underline', '#0000FF', '', 'underline', '#0000FF', 'underline', '#FFFF80', '#000000', '#B04040', '#FFFFFF', 'none', '#FFFFFF', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#FFFFFF', 'none', '#FFFFFF', 'Lightpink', '#000000', '#000000', '#B04040', '#FFFFFF', 'none', '#FFFFFF', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#FFFFFF', 'Lightpink', '#000000', '#000000', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#FFFFFF', 'none', '#FFFFFF', '#B04040', '', 'none', '#000000', '#000000', '#FF0000', '#80FFFF', 'none', '#80FFFF', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#008000', '#008000', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#FFFFFF', '#FFFFFF', '#000000', '#000000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#FFFFFF', '#FFFFFF')";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    #include("calogic_lang_english.php");
    include("calogic_mysql_color.php");
    $vergot="1.0.5a";
}


# update from version 1.0.5a

if($haveclver == false || $vergot=="1.0.5a") {
    print "<br>Updating database to Version 1.1.0<br>";
    $sqlstr = "ALTER TABLE ".$tabpre."_setup CHANGE standardtxtcolor btxtcolor VARCHAR( 100 ) DEFAULT NULL;";
    @mysql_query($sqlstr); #or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $vergot="1.1.0";
}

# update from version  1.1.0
if($haveclver == false || $vergot=="1.1.0") {
    print "<br>Updating database to Version 1.1.1<br>";

    $sqlstr = "ALTER TABLE ".$tabpre."_user_reg ADD udefscid VARCHAR( 32 ) DEFAULT '0' NOT NULL ,
    ADD udefscname VARCHAR( 50 ) DEFAULT '' NOT NULL ;";
    mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_events ADD subtitle VARCHAR( 50 ) DEFAULT '' NOT NULL AFTER title;";
    mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $vergot="1.1.1";
}

# update from version  1.1.1
if($haveclver == false || $vergot=="1.1.1") {
    print "<br>Updating database to Version 1.1.2<br>";

    $vergot="1.1.2";
}


# update from version  1.1.2
if($haveclver == false || $vergot=="1.1.2") {
    print "<br>Updating database to Version 1.1.3<br>";
    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD weektype SMALLINT DEFAULT '1' NOT NULL AFTER showweek;";
    mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    #include("calogic_lang_deutsch.php");
    $vergot="1.1.3";
}

# update from version  1.1.3
if($haveclver == false || $vergot=="1.1.3") {
    print "<br>Updating database to Version 1.1.4<br>";
    $vergot="1.1.4";
}

# update from version  1.1.4
if($haveclver == false || $vergot=="1.1.4") {
    print "<br>Updating database to Version 1.1.5<br>";
    $vergot="1.1.5";
}


# update from version  1.1.5
if($haveclver == false || $vergot=="1.1.5") {

    print "<br>Updating database to Version 1.1.6<br>";
    $sqlstr = "ALTER TABLE ".$tabpre."_setup ADD headtext VARCHAR( 100 ) DEFAULT '' NULL AFTER headpic ;";
    mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_setup ADD foottext VARCHAR( 100 ) DEFAULT '' NULL AFTER footpic ;";
    mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $vergot="1.1.6";

}

# update from version  1.1.6
if($haveclver == false || $vergot=="1.1.6") {
    print "<br>Updating database to Version 1.1.7<br>";
    $vergot="1.1.7";
}

# update from version  1.1.7
if($haveclver == false || $vergot=="1.1.7") {
    print "<br>Updating database to Version 1.1.8<br>";
    $vergot="1.1.8";
}

# update from version  1.1.8
if($haveclver == false || $vergot=="1.1.8") {
    print "<br>Updating database to Version 1.1.9<br>";
    $vergot="1.1.9";

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_events ADD pending TINYINT NOT NULL DEFAULT '0'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_event_rems ADD pending TINYINT NOT NULL DEFAULT '0'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD collisioncheck TINYINT NOT NULL DEFAULT '1' AFTER caltype,
    ADD allcollisioncheck TINYINT NOT NULL DEFAULT '1' AFTER collisioncheck;";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    #include("calogic_lang_french.php");

}

# update from version  1.1.9
if($haveclver == false || $vergot=="1.1.9") {

    print "<br>Updating database to Version 1.1.10<br>";
    $vergot="1.1.10";

    $sqlstr = "ALTER TABLE ".$GLOBALS["tabpre"]."_cal_ini
    ADD gcfont VARCHAR(20) DEFAULT 'Times New Roman' NOT NULL AFTER gcbgimg,
    ADD gcfontcolor VARCHAR(20) DEFAULT 'Black' NOT NULL AFTER gcfont;";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "DROP TABLE IF EXISTS ".$GLOBALS["tabpre"]."_cal_event_exceptions";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$GLOBALS["tabpre"]."_cal_event_exceptions (
    exid int(11) NOT NULL auto_increment,
    evid int(11) NOT NULL,
    calid varchar(32) NOT NULL default '',
    exday char(2) NOT NULL default '',
    exmonth char(2) NOT NULL default '',
    exyear varchar(4) NOT NULL default '',
    PRIMARY KEY  (exid),
    KEY calid (calid)
    ) TYPE=MyISAM COMMENT='CaLogic Event Exceptions'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "SELECT name FROM ".$GLOBALS["tabpre"]."_languages";
    $query1 = mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = mysql_fetch_array($query1)) {

        if($row["name"] == "Deutsch") {

            $sqlstr2 = "SELECT count(*) as langentrycount FROM ".$tabpre."_lang_".$row["name"];
            $query2 = mysql_query($sqlstr2) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = mysql_fetch_array($query2);
            $entrynum = $row2["langentrycount"];

            @mysql_free_result($query2);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcfont', 'Calendar Schrift', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcfontcolor', 'Calendar Schrift Farbe', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        } else {

            $sqlstr2 = "SELECT count(*) as langentrycount FROM ".$tabpre."_lang_".$row["name"];
            $query2 = mysql_query($sqlstr2) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = mysql_fetch_array($query2);
            $entrynum = $row2["langentrycount"];

            @mysql_free_result($query2);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcfont', 'Calendar Font', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcfontcolor', 'Calendar Font Color', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }

    }

    @mysql_free_result($query1);

}


# update from version  1.1.10
if($haveclver == false || $vergot=="1.1.10") {
    print "<br>Updating database to Version 1.2.0<br>";
    $vergot="1.2.0";

    $sqlstr = "SELECT name FROM ".$GLOBALS["tabpre"]."_languages";
    $query1 = mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    while($row = mysql_fetch_array($query1)) {

        if($row["name"] == "Deutsch") {

            $sqlstr2 = "SELECT count(*) as langentrycount FROM ".$tabpre."_lang_".$row["name"];
            $query2 = mysql_query($sqlstr2) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = mysql_fetch_array($query2);
            $entrynum = $row2["langentrycount"];

            @mysql_free_result($query2);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcbgcolor', 'Standart Hintergrund Farbe', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcfontsize', 'Standart Schrift Groesse in Punkte', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        } else {

            $sqlstr2 = "SELECT count(*) as langentrycount FROM ".$tabpre."_lang_".$row["name"];
            $query2 = mysql_query($sqlstr2) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
            $row2 = mysql_fetch_array($query2);
            $entrynum = $row2["langentrycount"];

            @mysql_free_result($query2);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcbgcolor', 'Standard Back Ground Color', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcfontsize', 'Standard Font Size in points', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }
    }

    @mysql_free_result($query1);


    $sqlstr = "ALTER TABLE ".$GLOBALS["tabpre"]."_cal_ini
    ADD gcfontsize VARCHAR(20) DEFAULT '11' NOT NULL AFTER gcfontcolor,
    ADD gcbgcolor VARCHAR(20) DEFAULT 'White' NOT NULL AFTER gcfontsize;";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "ALTER TABLE ".$tabpre."_setup
    ADD allowmakeextf INT DEFAULT '1' NOT NULL AFTER usercustom,
    ADD allowaddextf INT DEFAULT '1' NOT NULL AFTER allowmakeextf,
    ADD userreg TINYINT NOT NULL DEFAULT '1' AFTER publicview,
    ADD minpwlen INT DEFAULT '3' NOT NULL AFTER userreg,
    ADD maxpwdays INT DEFAULT '0' NOT NULL AFTER minpwlen,
    ADD maxpwinterval INT DEFAULT '0' NOT NULL AFTER maxpwdays,
    ADD btxtfont VARCHAR(100) DEFAULT '11' NOT NULL AFTER btxtcolor,
    ADD btxtsize VARCHAR(20) DEFAULT '11' NOT NULL AFTER btxtfont,
    ADD badpwlock INT DEFAULT '3' NOT NULL AFTER maxpwinterval";

    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD temp1 TINYINT NOT NULL DEFAULT '1' AFTER caltype,
    ADD temp2 TINYINT NOT NULL DEFAULT '1' AFTER temp1";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "update ".$tabpre."_cal_ini set temp1 = collisioncheck, temp2 = allcollisioncheck";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini DROP collisioncheck";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini DROP allcollisioncheck";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD collisioncheck TINYINT NOT NULL DEFAULT '1' AFTER caltype,
    ADD allcollisioncheck TINYINT NOT NULL DEFAULT '1' AFTER collisioncheck, ADD showstatus TINYINT NOT NULL DEFAULT '1' AFTER allcollisioncheck,
    ADD showalltimes TINYINT NOT NULL DEFAULT '1' AFTER timetype";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "update ".$tabpre."_cal_ini set collisioncheck = temp1, allcollisioncheck = temp2,showalltimes = 1,showstatus=1";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini DROP temp1, DROP temp2";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_reg CHANGE newpw newpw TINYINT NOT NULL DEFAULT '0'";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "update ".$tabpre."_user_reg set newpw = 0";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_reg ADD failedli TINYINT DEFAULT '0' NOT NULL AFTER newpw, ADD nextpwdate INT DEFAULT '0' NOT NULL AFTER failedli";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_log (
    hlid INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    uid INT( 11 ) DEFAULT '0' NOT NULL ,
    calid VARCHAR( 32 ) DEFAULT '0' NOT NULL ,
    evid INT( 11 ) DEFAULT '0' NOT NULL ,
    hldate BIGINT( 20 ) DEFAULT '0' NOT NULL ,
    adate BIGINT( 20 ) DEFAULT '0' NOT NULL ,
    laction VARCHAR( 100 ) DEFAULT ' ' NOT NULL ,
    lbefore MEDIUMTEXT ,
    lafter MEDIUMTEXT ,
    remarks TEXT ,
    INDEX ( uid , calid , evid , hldate , adate , laction ) )
    COMMENT = 'CaLogic History and Log Table'";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_ext_def (
    efid INT( 11 ) DEFAULT '0' AUTO_INCREMENT PRIMARY KEY ,
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
    ) COMMENT = 'CaLogic Extended Field Definition Table'";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_extents (
    exid INT( 11 ) DEFAULT '0' NOT NULL AUTO_INCREMENT PRIMARY KEY,
    evid INT( 11 ) DEFAULT '0' NOT NULL ,
    efid INT( 11 ) DEFAULT '0' NOT NULL ,
    efsid INT( 11 ) DEFAULT '0' NOT NULL ,
    exval MEDIUMTEXT,
    INDEX ( exid,evid,efid,efsid )
    ) COMMENT = 'CaLogic Extended Field Values Table'";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_ext_sel_def (
    efsid INT( 11 ) DEFAULT '0' NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    efid INT( 11 ) DEFAULT '0' NOT NULL ,
    efsval VARCHAR( 50 ) DEFAULT ' ' NOT NULL ,
    standard TINYINT DEFAULT '0' NOT NULL ,
    INDEX ( efid )
    ) COMMENT = 'CaLogic Extended Select Field Definition Table'";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "INSERT INTO ".$tabpre."_log SELECT ' ' hlid, '0' uid, calid, evid, to_days( chk_date ) hldate,
    to_days( ev_date ) adate, 'Send Reminder' laction, ' ' lbefore, ' ' lafter, 'Reminder Log Convert' remarks FROM ".$tabpre."_rem_log";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_rem_log";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_remrun_log";
    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_event_rems
    ADD srint TINYINT DEFAULT '0' NOT NULL AFTER conid ,
    ADD srval INT( 11 ) DEFAULT '0' NOT NULL AFTER srint ,
    ADD fname VARCHAR( 50 ) DEFAULT ' ' NOT NULL AFTER srval ,
    ADD lname VARCHAR( 50 ) DEFAULT ' ' NOT NULL AFTER fname ,
    ADD remail VARCHAR( 100 ) DEFAULT ' ' NOT NULL AFTER lname ,
    ADD rtzos INT( 11 ) DEFAULT '0' NOT NULL AFTER remail ,
    ADD remark TEXT AFTER rtzos ,
    ADD approved TINYINT DEFAULT '0' NOT NULL AFTER remark ,
    ADD confirmed TINYINT DEFAULT '0' NOT NULL AFTER approved,
    ADD confirmkey VARCHAR( 32 ) DEFAULT ' ' NOT NULL AFTER confirmed";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_event_rems ADD INDEX ( calid, uid, evid )";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "select * from ".$tabpre."_cal_events where sendreminder = 1";
    $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    while($row = mysql_fetch_array($query1)) {
        $sqlstr = "update ".$tabpre."_cal_event_rems set srint = ".$row["srint"].", srval = ".$row["srval"].",remark='Reminder Conversion', approved=1,confirmed=1 where evid=".$row["evid"];
        $query2 = mysql_query($sqlstr) or die("Cannot update calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

    @mysql_free_result($query1);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_events DROP srint, DROP srval";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_events
    ADD remsuballow TINYINT DEFAULT '0' NOT NULL AFTER sendreminder ,
    ADD remsublevel TINYINT DEFAULT '0' NOT NULL AFTER remsuballow,
    ADD extfields TINYINT DEFAULT '0' NOT NULL AFTER remsublevel,
    ADD public TINYINT DEFAULT '0' NOT NULL AFTER pending";
    mysql_query($sqlstr)  or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "DROP TABLE IF EXISTS ".$tabpre."_user_congrp_link";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$tabpre."_user_congrp_link (
    gplinkid BIGINT DEFAULT '0' NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    uid BIGINT DEFAULT '0' NOT NULL ,
    conid BIGINT DEFAULT '0' NOT NULL ,
    congpid BIGINT DEFAULT '0' NOT NULL ,
    INDEX ( uid , conid , congpid )
    ) COMMENT = 'CaLogic User Contact Group Link Table'";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


# now add already defined groups to the new table.

    $sqlstr = "SELECT ".$tabpre."_user_con.conid, ".$tabpre."_user_con.uid, ".$tabpre."_user_con.congp, ".$tabpre."_user_con_grp.congpid FROM ".$tabpre."_user_con
    inner join ".$tabpre."_user_con_grp on ".$tabpre."_user_con.congp =".$tabpre."_user_con_grp.congpid";

    $query1 = mysql_query($sqlstr) or die("Cannot query calendar events table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    while($row = mysql_fetch_array($query1)) {
        $sqlstr = "insert into ".$tabpre."_user_congrp_link values('',".$row["uid"].",".$row["conid"].",".$row["congpid"].")";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }
    @mysql_free_result($query1);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_con_grp ADD shared TINYINT DEFAULT '0' NOT NULL AFTER uid" ;
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_con CHANGE congp shared TINYINT DEFAULT '0' NOT NULL";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "update ".$tabpre."_user_con set shared = 0";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

}


# update from version  1.2.0
if($haveclver == false || $vergot=="1.2.0") {
    print "<br>Updating database to Version 1.2.1<br>";
    $vergot="1.2.1";


    $sqlstr = "ALTER TABLE ".$tabpre."_setup ADD calogic_uid VARCHAR( 32 ) NOT NULL FIRST";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD catcollisioncheck TINYINT DEFAULT '0' NOT NULL AFTER allcollisioncheck";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD dtih TINYINT DEFAULT '0' NOT NULL AFTER caltype";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini
    ADD deiuser TINYINT DEFAULT '1' NOT NULL AFTER username ,
    ADD deititle TINYINT DEFAULT '1' NOT NULL AFTER deiuser ,
    ADD deisub TINYINT DEFAULT '1' NOT NULL AFTER deititle ,
    ADD deidate TINYINT DEFAULT '1' NOT NULL AFTER deisub ,
    ADD deidesc TINYINT DEFAULT '1' NOT NULL AFTER deidate ,
    ADD deirem TINYINT DEFAULT '1' NOT NULL AFTER deidesc ,
    ADD deiext TINYINT DEFAULT '1' NOT NULL AFTER deirem ,
    ADD deicat TINYINT DEFAULT '1' NOT NULL AFTER deiext ,
    ADD deirep TINYINT DEFAULT '1' NOT NULL AFTER deicat ,
    ADD deiexc TINYINT DEFAULT '1' NOT NULL AFTER deirep" ;
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

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

}

# update from version  1.2.1
if($haveclver == false || $vergot=="1.2.1") {
    print "<br>Updating database to Version 1.2.2<br>";
    $vergot="1.2.2";

    $sqlstr2 = "";
    $sqlstr3 = "";
    $sqlstr4 = "";

    #$sqlstr = "ALTER TABLE ".$tabpre."_setup ADD calogic_uid VARCHAR( 32 ) NOT NULL FIRST";
    #mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $token = md5(uniqid(rand(), true));

    $sqlstr = "update ".$tabpre."_setup set calogic_uid = '".$token."'";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "SELECT mailformat FROM ".$GLOBALS["tabpre"]."_setup";
    $query1 = mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row = mysql_fetch_array($query1);

    $stdemailtyp = $row["mailformat"];
    @mysql_free_result($query1);

    if($stdemailtyp == 0) {
        $stdemailtyp = "HTML";
    } else {
        $stdemailtyp = "TEXT";
    }


    $sqlstr = "ALTER TABLE ".$tabpre."_user_reg ADD tzlock TINYINT DEFAULT '0' NOT NULL AFTER tzos";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_reg ADD emailtype VARCHAR( 4 ) DEFAULT '".$stdemailtyp."' NOT NULL AFTER email";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_user_con ADD emailtype VARCHAR( 4 ) DEFAULT '".$stdemailtyp."' NOT NULL AFTER email";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_event_rems ADD remailtype VARCHAR( 4 ) DEFAULT '".$stdemailtyp."' NOT NULL AFTER remail";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "SELECT name FROM ".$GLOBALS["tabpre"]."_languages";
    $query1 = mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    while($row = mysql_fetch_array($query1)) {

        $sqlstr = "ALTER TABLE ".$tabpre."_lang_".$row["name"]." CHANGE keyid keyid VARCHAR( 100 ) NOT NULL";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscoif_btxtfont' where keyid = 'gcfont'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_btxtcolor' where keyid = 'gcfontcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_standardbgcolor' where keyid = 'gcbgcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscoif_btxtsize' where keyid = 'gcfontsize'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscoif_standardbgimg' where keyid = 'gcbgimg'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_prevcolor' where keyid = 'gcprevcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_prevbgcolor' where keyid = 'gcprevbgcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscosf_prevstyle' where keyid = 'gcprevstyle'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_nextcolor' where keyid = 'gcnextcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_nextbgcolor' where keyid = 'gcnextbgcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscosf_nextstyle' where keyid = 'gcnextstyle'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_prefcolor' where keyid = 'gcprefcolor'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscosf_prefstyle' where keyid = 'gcprefstyle'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set keyid = 'gcscocf_cssc' where keyid = 'gccssc'";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        if($row["name"] == "English") {

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = 'Not used' where keyid = 'gcscocf_prefcolor' or keyid = 'gcscosf_prefstyle'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = '<b>Type1</b>: The Week Selection Box will pre-select the Current Week, if it is within six weeks of the actual viewed date, otherwise the first week of the Month viewed will be pre-selected.<br><b>Type 2</b>: The first week of the Month viewed will always be preselected.' where keyid = 'ftype'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        } elseif($row["name"] == "Deutsch") {
            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = 'Nicht verwendet' where keyid = 'gcscocf_prefcolor' or keyid = 'gcscosf_prefstyle'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = '<b>Type1</b>: Typ1: Die Wochenauswahl Box zeigt die aktuelle Woche wenn diese innerhalb 6 Wochen ist. Andernfalls wird die erste Woche des aktuellen Monats angezeigt. <bb>Standart</b><br><b>Typ 2</b>: Die erste Woche des angezeigten Monats wird immer vor selektiert.' where keyid = 'ftype'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = 'M&auml;rz' where keyid = 'mnl3'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        } elseif($row["name"] == "French") {
            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = 'non utilisé' where keyid = 'gcscocf_prefcolor' or keyid = 'gcscosf_prefstyle'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = '<b>Type1</b>: La boite de selection Semaine préselectionne la semaine en cours, si celle-ci est à moins de 6 weeks de la date affichée, sinon c\'est la première semaine du mois incluant la date affichée qui est pre-sélectionné.<br><b>Type 2</b>: The first week of the Month viewed will always be preselected.' where keyid = 'ftype'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        } elseif($row["name"] == "Swedish") {

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = 'inte använd' where keyid = 'gcscocf_prefcolor' or keyid = 'gcscosf_prefstyle'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = '<b>Typ1</b>: Vecko väljar menyn kommer för-välja aktuell vecka, om det är inom 6 weeks av den aktuella visade datumen, annars blir första veckan av månaden för-vald.<br><b>Typ 2</b>: Den första visade veckan av månaden kommer alltid att vara för-vald.' where keyid = 'ftype'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


        } else {
            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = 'Not used' where keyid = 'gcscocf_prefcolor' or keyid = 'gcscosf_prefstyle'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $sqlstr = "update ".$tabpre."_lang_".$row["name"]." set phrase = '<b>Type1</b>: The Week Selection Box will pre-select the Current Week, if it is within six weeks of the actual viewed date, otherwise the first week of the Month viewed will be pre-selected.<br><b>Type 2</b>: The first week of the Month viewed will always be preselected.' where keyid = 'ftype'";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }

    }

    @mysql_free_result($query1);


    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ADD collisionsave TINYINT DEFAULT '1' NOT NULL AFTER allcollisioncheck";
    mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr3 = "select * from ".$tabpre."_setup";
    $query3 = mysql_query($sqlstr3) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr3."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row3 = mysql_fetch_array($query3);


    $y=0;

    $wroot = $row3["baseurl"];
    $wprogdir = $row3["progdir"];


    $havefirstfield = false;
    $havefirstfield2 = false;
    $prevfieldname = "gccssc";
    $fieldprefix = "";

    $sqlstr2 = "update ".$tabpre."_cal_ini set ";

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ";

    #print "<br><br>fieldcnt: ".$fieldcnt."<br><br>";

    for($x=0;$x<$fieldcnt;$x++) {
        if($x==0) {
            #print "<br><br>am in for<br><br>";
        }

        if($setuptab[$x][1] != "tabhead") {

            if(substr($setuptab[$x][1],0,6) == "allow_") {

                if($havefirstfield == true) {
                    $sqlstr .= ",";
                } else {
                    $havefirstfield = true;
                }

                $y = $x -1;

                if($setuptab[$y][1] == "standardbgimg") {
                    $sqlstr .= " change gcbgimg gcscoif_".$setuptab[$y][1]." ".$setuptab[$y][2];

                }elseif($setuptab[$y][1] == "btxtfont") {
                    $sqlstr .= " change gcfont gcscoif_".$setuptab[$y][1]." ".$setuptab[$y][2];

                }elseif($setuptab[$y][1] == "btxtcolor") {
                    $sqlstr .= " change gcfontcolor gcscocf_".$setuptab[$y][1]." ".$setuptab[$y][2];

                }elseif($setuptab[$y][1] == "btxtsize") {
                    $sqlstr .= " change gcfontsize gcscoif_".$setuptab[$y][1]." ".$setuptab[$y][2];

                }elseif($setuptab[$y][1] == "standardbgcolor") {
                    $sqlstr .= " change gcbgcolor gcscocf_".$setuptab[$y][1]." ".$setuptab[$y][2];

                }elseif($setuptab[$y][1] == "subtitletxt") {
                    $sqlstr .= " ADD gcscoif_".$setuptab[$y][1]." ".$setuptab[$y][2]." AFTER showalltimes";
                    $sqlstr4 .= " ADD gcscoif_".$setuptab[$y][1]." ".$setuptab[$y][2]." AFTER showalltimes\n";

                } else {

                    if($setuptab[$y][5] == "0") {

                        if(substr($setuptab[$y][1],0,3) == "pu_") {
                            $fieldprefix = "";
                        } else {
                            $fieldprefix = "gcscoif_";
                        }
                    } else {

                        if(substr($setuptab[$y][1],0,2) == "mc") {
                            $fieldprefix = substr($setuptab[$y][1],2,2)."selmc_";
                        } elseif(substr($setuptab[$y][1],0,3) == "pu_") {
                            $fieldprefix = "";
                        } else {
                            $fieldprefix = "gcscoyn_";
                        }
                    }

                    $sqlstr .= " ADD ".$fieldprefix.$setuptab[$y][1]." ".$setuptab[$y][2]." AFTER ".$prevfieldname;
                    $sqlstr4 .= " ADD ".$fieldprefix.$setuptab[$y][1]." ".$setuptab[$y][2]." AFTER ".$prevfieldname."\n";

                    $prevfieldname = $fieldprefix.$setuptab[$y][1];

                    if($havefirstfield2 == true) {
                        $sqlstr2 .= ",";
                    } else {
                        $havefirstfield2 = true;
                    }

                    if(isset($row3[$setuptab[$y][1]])) {
                        $sqlstr2 .= $fieldprefix.$setuptab[$y][1]." = '".$row3[$setuptab[$y][1]]."'";
                    } else {
                        $sqlstr2 .= $fieldprefix.$setuptab[$y][1]." = '".$setuptab[$y][8]."'";
                    }

                }

            }
        }
    }

    #print "<br><br>sql1:<br>".$sqlstr;
    #print "<br><br>sql2:<br>".$sqlstr2;
    #print "<br><br>sql4:<br>".$sqlstr4;
    #print "<br><br>";

    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    mysql_query($sqlstr2) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    @mysql_free_result($query3);

    $sqlstr = "ALTER TABLE ".$tabpre."_cal_ini ";
    $sqlstr .= " change gcprevcolor gcscocf_prevcolor varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcprevbgcolor gcscocf_prevbgcolor varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcprevstyle gcscosf_prevstyle varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcnextcolor gcscocf_nextcolor varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcnextbgcolor gcscocf_nextbgcolor varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcnextstyle gcscosf_nextstyle varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcprefcolor gcscocf_prefcolor varchar(20) NOT NULL default '',";
    $sqlstr .= " change gcprefstyle gcscosf_prefstyle varchar(20) NOT NULL default '',";
    $sqlstr .= " change gccssc gcscocf_cssc varchar(20) NOT NULL default ''";

    mysql_query($sqlstr) or die("Database update error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


    $sqlstr = "SELECT name FROM ".$GLOBALS["tabpre"]."_languages";
    $query1 = mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = mysql_fetch_array($query1)) {

        $sqlstr2 = "SELECT count(*) as langentrycount FROM ".$tabpre."_lang_".$row["name"];
        $query2 = mysql_query($sqlstr2) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row2 = mysql_fetch_array($query2);
        $entrynum = $row2["langentrycount"];

        @mysql_free_result($query2);


        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_subtitletxt', 'Event Sub Title Descriptor', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_headpic', 'Header Banner Pic URL', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_headtext', 'Header Banner Picture alternat text', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_headlink', 'Header Banner Link', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_headtarget', 'Header Banner Link Target', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_footpic', 'Footer Banner Pic URL', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_foottext', 'Footer Banner Picture alternat text', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_footlink', 'Footer Banner Link', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoif_foottarget', 'Footer Banner Link Target', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_allowdv', 'Allow Day View', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_allowwv', 'Allow Week View', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_allowmv', 'Allow Month View', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_allowyv', 'Allow Year View', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_dispwvpd', 'Display Week View Selector', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_dispmvpd', 'Display Month View Selector', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_dispyvpd', 'Display Year View Selector', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_dispcnpd', 'Display Calendar Selector', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_dispevcr', 'Display Event Creator', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_withesb', 'Display Month View Event Scroll Box', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_withwvesb', 'Display Week View Event Scroll Box', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_withdvesb', 'Display Day View Event Scroll Box', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_showomd', 'Display Out of Month Day Numbers', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_showwvtime', 'Show the time column in Week View<br>(not yet implemented)', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'gcscoyn_showdvtime', 'Show the time column in Day View<br>(not yet implemented)', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);


#
        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'yvselmc_mcyv', 'Select if and where you want the mini calendar to show up in the year view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'mvselmc_mcmv', 'Select if and where you want the mini calendar to show up in the month view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'wvselmc_mcwv', 'Select if and where you want the mini calendar to show up in the week view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        $entrynum +=1;
        $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", 'dvselmc_mcdv', 'Select if and where you want the mini calendar to show up in the day view<br>if only left or right is selected then the current month will be shown. If both is selected the the previous and next months will be shown.', 'Calendar Setup')";
        mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

# menu


        $newlangkeys = array("pu_functionmenutype", "pu_MenuBarColor",
        "pu_MenuBarFont",
        "pu_MenuBarFontColor",
        "pu_MenuBarFontSize",
        "pu_MenuBarHighlightColor",
        "pu_MenuBarHighlightFont",
        "pu_MenuBarHighlightFontColor",
        "pu_MenuItemBorderColor",
        "pu_MenuItemColor",
        "pu_MenuItemFont",
        "pu_MenuItemFontColor",
        "pu_MenuItemFontSize",
        "pu_MenuItemHighlightColor",
        "pu_MenuItemHighlightFont",
        "pu_MenuItemHighlightFontColor",
        "pu_PopupDayCaptionColor",
        "pu_PopupDayCaptionFont",
        "pu_PopupDayCaptionFontColor",
        "pu_PopupDayCaptionSize",
        "pu_PopupDayColor",
        "pu_PopupDayFont",
        "pu_PopupDayFontColor",
        "pu_PopupDayFontSize",
        "pu_PopupEventCaptionColor",
        "pu_PopupEventCaptionFont",
        "pu_PopupEventCaptionFontColor",
        "pu_PopupEventCaptionSize",
        "pu_PopupEventColor",
        "pu_PopupEventFont",
        "pu_PopupEventFontColor",
        "pu_PopupEventFontSize",
        "pu_PopupCreatorCaptionColor",
        "pu_PopupCreatorCaptionFont",
        "pu_PopupCreatorCaptionFontColor",
        "pu_PopupCreatorCaptionSize",
        "pu_PopupCreatorColor",
        "pu_PopupCreatorFont",
        "pu_PopupCreatorFontColor",
        "pu_PopupCreatorFontSize");

        $newlangvals = array("Function Menu Type", "Horizontal Menu Bar Color",
        "Horizontal Menu Bar Font",
        "Horizontal Menu Bar Font Color",
        "Horizontal Menu Bar Font Size in ponts",
        "Horizontal Menu Bar Highlight Color",
        "Horizontal Menu Bar Highlight Font",
        "Horizontal Menu Bar Highlight Font Color",
        "Menu Item Border Color",
        "Menu Item Color",
        "Menu Item Font",
        "Menu Item Font Color",
        "Menu Item Font Size in points",
        "Menu Item Highlight Color",
        "Menu Item Highlight Font",
        "Menu Item Highlight Font Color",
        "Day Popup Caption Color",
        "Day Popup Caption Font",
        "Day Popup Caption Font Color",
        "Day Popup Caption Size (1 to 7)",
        "Day Popup Color",
        "Day Popup Font",
        "Day Popup Font Color",
        "Day Popup Font Size (1 to 7)",
        "Event Popup Caption Color",
        "Event Popup Caption Font",
        "Event Popup Caption Font Color",
        "Event Popup Caption Size (1 to 7)",
        "Event Popup Color",
        "Event Popup Font",
        "Event Popup Font Color",
        "Event Popup Font Size (1 to 7)",
        "Creator Popup Caption Color",
        "Creator Popup Caption Font",
        "Creator Popup Caption Font Color",
        "Creator Popup Caption Size (1 to 7)",
        "Creator Popup Color",
        "Creator Popup Font",
        "Creator Popup Font Color",
        "Creator Popup Font Size (1 to 7)");

        #$keycount = 0;
        foreach($newlangkeys as $key => $val) {

            $keyval = $val;
            $val = $newlangvals["$key"];

            $entrynum +=1;
            $sqlstr = "INSERT INTO ".$tabpre."_lang_".$row["name"]." VALUES (".$entrynum.", '".$keyval."', '".$val."', 'Calendar Setup')";
            mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        }


    }


}

# Language Table update

foreach ($langtabs as $langtabname) {

    $sqlstr = "SELECT count(*) as langentrycount FROM ".$GLOBALS["tabpre"]."_languages where name = '".$langtabname."'";
    $query = mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $row = mysql_fetch_array($query);
    $entrynum = $row["langentrycount"];

    @mysql_free_result($query);

    if($entrynum == 0) {
        include("calogic_lang_".$langtabname.".php");
    }
}




$sqlstr = "update ".$GLOBALS["tabpre"]."_setup set calogicversion='".$calogicversion."'";
mysql_query($sqlstr) or die("Database Update Error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

?>

