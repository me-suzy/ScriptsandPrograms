<?php
/*
CaLogic
Copyright (c) Philip Boone.
philip@calogic.de


*/

//asdbg_break();
$havegcfg=false;

include("../gcfg.php");

# set path info
$rootpath = str_replace("\\","/",getcwd());
$pathlen = strlen($rootpath);
$setpath = substr($rootpath,0,$pathlen-5);
$incpath = substr($rootpath,0,$pathlen-5);

$tdir = substr(dirname($_SERVER['PHP_SELF']),1);
$tdir = substr($tdir,0,strlen($tdir)-5);

$wroot = $_SERVER['HTTP_HOST']."/";
$wprogdir = $tdir;

$setpath .= "admin/"; #settings.php";
$incpath .= "include/";

#echo "rootpath: ".$rootpath."<br>";
#echo "setpath: ".$setpath."<br>";
#echo "incpath: ".$incpath."<br>";
#echo "tdir: ".$tdir."<br>";
#echo "wroot: http://".$wroot."<br>";
#echo "wprog: ".$wprogdir."<br>";

$forcedefaultcal = 0;

$rent = strftime("%y%m%d%H%M%S");
$ndblname = "";
$nbdsname = "";

$servertzos = ((date("Z") / 60) / 60);

if($servertzos > 0) {
	$servertzos = "+$servertzos";
} elseif($servertzos < 0) {
	$servertzos = "$servertzos";
}

$havedbloader = false;
$havesettings = false;

include_once("../include/dbfunc.php");
include_once("../classes/htmlMimeMail.php");
include_once("../include/setuptab.php");

setup_head();

switch ($setup_step) {

	case "1":
# create database loader and settings files, create database and tables

            checkfordbloader();
            checkforsettings($fields["databasepath"]);

            makefiles();

            if($fields["makedatabase"] == 1) {
                print "Creating Database<br><br>";

                mysql_connect($fields["databasehost"], $fields["databaseuser"], $fields["databasepass"]);
                $sqlstr = "CREATE DATABASE ".$fields["databasename"];
                $result = mysql_query($sqlstr) or die("Could not create Database. You may not have create privliges.<br>Try creating the database manually with phpMyAdmin or other tool.<br><br>If you already have a database, then answer no to the create database question.<br><br>If you are still having problems, please feel free to send me this report.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    # check results

            }

            include_once("../admin/dbloader.php");

            if($fields["maketable"] == 1) {
                print "Creating Tables<br><br>";

    #        	mysql_connect($fields["databasehost"], $fields["databaseuser"], $fields["databasepass"]);

                $sqlstr = "DROP TABLE IF EXISTS ".$GLOBALS["tabpre"]."_setup";
                mysql_query($sqlstr) or die("Database setup error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
                $sqlstr = "CREATE TABLE ".$GLOBALS["tabpre"]."_setup (";


                for($x=0;$x<$fieldcnt;$x++) {
                    if($setuptab[$x][1] != "tabhead") {
                        $sqlstr .= $setuptab[$x][1]." ".$setuptab[$x][2].",";
                    }
                }

                $sqlstr .= "calogicversion varchar(15) NOT NULL default '$calogicversion') TYPE=MyISAM COMMENT='CaLogic Setup Table';";

                mysql_query($sqlstr) or die("Could not create setup table.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

                include_once("calogic_mysql.php");
                include_once("calogic_lang_setup.php");
                include_once("calogic_mysql_color.php");
            }
            print "<br><br>Step 1 finished.<br><br>Click Next to continue<br><br>";

            print "<form method=\"post\" name=\"calnext\" id=\"calnext\" action=\"setup.php\">";
            print "<input type=\"hidden\" name=\"setup_step\" value=\"2\">";
            print "<input type=\"submit\" name=\"nextstep\" id=\"nextstep\" value=\"Next\"><br><br>";
            print "</form>";
	    break;

	case "2":
#
            include_once("../admin/dbloader.php");
            setup_calg();
	    break;
	case "3":
            include_once("../admin/dbloader.php");
            setup_step3();
?>
<br><br>Setup finished.<br><br><b>
You should now remove the setup folder from your web.<br><br>
If you later wish to change any options, please logon as admin and follow the "CaLogic Configuration" link<br>
under the Admin heading on the Functions menu.<br><br>

The Administrator user name / password is: admin / admin<br><br>

Please change the password as soon as possible. To do this,<br>
logon as admin, click the "User Settings" link from the Functions Menu<br>
enter the old password, and your new password in the 2 fields provided,<br>
enter the rest of the information as well, click the save button.</b><br><br>

If you opted to use the "Public View", you will be taken directly to the public<br>
calendar once you click the link below. To logon as admin, click the "Log On/Register" link<br>
from the functions menu, you will then be taken to the logon screen.<br><br>

If you did not opt to use the public view, you will be taken to the logon screen.<br>
when you click the link below.<br><br>

Once you logon as admin, you will first be taken to the "Calendar Configuration" screen.<br>
give your first calendar a name and title, then save it. After that you can change your
admin password.<br><br><br>

<?php

echo "<a href=\"".$fields["baseurl"].$fields["progdir"].$GLOBALS["idxfile"]."\">Click here to start CaLogic!</a><br><br>";
	    break;

	case "4":
	    break;
	default:
            setup_database();
}

setup_foot();
exit();



# begin functions

function checkfordbloader() {
    if (file_exists($GLOBALS["setpath"]."dbloader.php") ) {
        $dblrename = rename($GLOBALS["setpath"]."dbloader.php",$GLOBALS["setpath"]."dbloader".$GLOBALS["rent"].".php");
#        $GLOBALS["havedbloader"] = true;
        if($dblrename == false) {
            print "Could not rename dbloader.php<br><br>";
        } else {
            $GLOBALS["ndblname"] = "dbloader".$GLOBALS["rent"].".php";
            print "dbloader.php file exists, renaming to: ".$GLOBALS["ndblname"]."<br><br>";
        }
    }
}

function checkforsettings($pathname) {
    if (file_exists($pathname) ) {
        $sfilen = basename($pathname);
        $dbsrename = rename($pathname,$pathname.$GLOBALS["rent"].".php");
        if($dbsrename == false) {
            print "Could not rename ".$sfilen."<br><br>";
        } else {
            $sfileno = basename($pathname.$GLOBALS["rent"].".php");
            $GLOBALS["ndbsname"] = $sfileno;
            print $sfilen." file exists, renaming to: ".$GLOBALS["ndbsname"]."<br><br>";
        }
    }
}


function makefiles() {

global $fields;

    if (file_exists($GLOBALS["setpath"]."dbloader.php") ) {
        print "dbloader.php already exists!<br><br>Cannot continue with setup.";
        setup_foot();
        exit();
    } else {
    print "Creating dbloader.php<br><br>";

	$content = "<"."?php

// ------------------------------------------------------------------------- //
//                CaLogic Database Loader File                               //
// ------------------------------------------------------------------------- //


include_once(\"".$fields["databasepath"]."\");
\$setfvar = \"".$fields["databasepath"]."\";

mysql_connect(\"\$dbhost\",\"\$dbuser\",\"\$dbpass\") OR DIE(\"Couldn`t connect to MySQL server in the DBLOADER!\");
mysql_select_db(\"\$dbname\") OR DIE(\"Couldn`t connect database in the DBLOADER!\");

?".">";

    	if ( !$file = fopen($GLOBALS["setpath"]."dbloader.php","w") ) {
    		print "could not create dbloader.php Make sure that the admin folder is writable durring the setup process.";
    		setup_foot();
    		exit();
    	}
    	if ( fwrite($file,$content) == -1 ) {
    		print "could not write to dbloader.php Make sure that the admin folder is writable durring the setup process.";
    		fclose($file);
    		setup_foot();
    		exit();
    	}
    	fclose($file);

    }

    if (file_exists($fields["databasepath"]) ) {
        $sfname = basename($fields["databasepath"]);
        print $sfname." file already exists!<br><br>Cannot continue with setup.";
        setup_foot();
        exit();
    } else {
    $sfname = basename($fields["databasepath"]);
    print "Creating ".$sfname."<br><br>";

	$content = "<"."?php

// ------------------------------------------------------------------------- //
//                CaLogic Database Settings File                             //
// ------------------------------------------------------------------------- //


// Database host
\$dbhost = \"".$fields["databasehost"]."\";
// Database user
\$dbuser = \"".$fields["databaseuser"]."\";
// Database pass
\$dbpass = \"".$fields["databasepass"]."\";
// Database name
\$dbname = \"".$fields["databasename"]."\";

// table prefix
\$tabpre = \"".$fields["databaseprefix"]."\";

// index file
\$idxfile = \"".$fields["startfile"]."\";

?".">";

#    	if ( !$file = fopen($fields["databasepath"]."settings.php","w") ) {
    	if ( !$file = fopen($fields["databasepath"],"w") ) {
    		print "could not create settings file. Make sure that the folder is writable durring the setup process.";
    		setup_foot();
    		exit();
    	}
    	if ( fwrite($file,$content) == -1 ) {
    		print "could not write to settings file. Make sure that the include and admin folders are writable durring the setup process.";
    		fclose($file);
    		setup_foot();
    		exit();
    	}
    	fclose($file);

    }
}


if(isset($submitsetupnow)) {
#    <br>
#    <br><b>You may now start CaLogic!</b><br>
}


function checkforsetuptab() {

    $have_cl_setup_tab = false;

    $setup_tab = $GLOBALS["tabpre"]."_setup";

    $ck_tabres = mysql_list_tables($dbname);

    for ($i = 0; $i < mysql_num_rows($ck_tabres); $i++) {
        $tb_names[$i] = mysql_tablename($ck_tabres, $i);

        if($tb_names[$i] == $setup_tab) {
            $have_cl_setup_tab = true;
        }
    }
}

# process the submitted configuration form

function setup_step3() {

    global $fields,$tabpre,$calogicversion;
    global $setuptab,$fieldcnt;

    $fields = gmqfix($fields);

    if(!emailok($fields["email"])) {
        print "<h3>".$fields["email"]." is not a valid email address.</br>";
        print "Please check the values and submit again.</h3><br>";
        setup_calg_again();
        setup_foot();
        exit();
    }

    $sitebg = "";

    $sqlstr = "DROP TABLE IF EXISTS ".$GLOBALS["tabpre"]."_setup;";
    mysql_query($sqlstr) or die("Cannot execute query.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "CREATE TABLE ".$GLOBALS["tabpre"]."_setup (";

    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {
            $sqlstr .= $setuptab[$x][1]." ".$setuptab[$x][2].",";
        }
    }
    $sqlstr .= "calogicversion varchar(15) NOT NULL default '$calogicversion'
    ) TYPE=MyISAM COMMENT='CaLogic Setup Table';";

    mysql_query($sqlstr) or die("Cannot execute query.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_setup VALUES (";

    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {

            if($setuptab[$x][7] > 0) {

		# enter default values for disabled fields

		if($setuptab[$x][1] == "calogic_uid") {
		    $sqlstr .= "'".fmtfordb($fields[$setuptab[$x][1]])."',";
		} else {
		    $sqlstr .= "'".fmtfordb($setuptab[$x][8])."',";
		}

            } else {
                $sqlstr .= "'".fmtfordb($fields[$setuptab[$x][1]])."',";
            }
        }
    }

    $sqlstr .= "'".$calogicversion."')";

    mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

        // --------------------------------------------------------


    $key = md5(uniqid(rand(), true));

    $regtime = time();

    $xmdpw = md5("admin");

    $istfadmin = 1;

    $sqlstr = "delete from ".$GLOBALS["tabpre"]."_user_reg where uname = 'admin'";
    mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_reg (uname,fname,lname,email,pw,emok,langid,language,regtime,regkey,isadmin)
    values('admin','admin','admin','".$fields["email"]."','$xmdpw',1,1,'English',$regtime,'$key',$istfadmin)";
    mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    if($fields["publicview"] == 1){


	$key = md5(uniqid(rand(), true));

        $regtime = time();

        $xmdpw = md5("Guest");
        $istfadmin = 0;

        $sqlstr = "insert into ".$GLOBALS["tabpre"]."_user_reg (uname,fname,lname,email,pw,emok,langid,language,startcalid,startcalname,tzos,regtime,regkey,isadmin)
        values('Guest','Guest','Guest','guest@dummy.com','$xmdpw',1,1,'English',-1,'Public',0,$regtime,'$key',$istfadmin)";
        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#        $sqlstr = "INSERT INTO ".$GLOBALS["tabpre"]."_cal_ini VALUES (2,'-1', 'Public', 2, 'Public', 'Public', 0, 1, 1, 1, 1, 'Month', 1, 1, '0600', '1800', 1, '".$standardbgimg."', '#0000FF', '', 'underline', '#0000FF', '', 'underline', '#0000FF', 'underline', '#FFFF80', '#000000', '#B04040', '#FFFFFF', 'none', '#FFFFFF', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#FFFFFF', 'none', '#FFFFFF', 'Lightpink', '#000000', '#000000', '#B04040', '#FFFFFF', 'none', '#FFFFFF', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#FFFFFF', 'Lightpink', '#000000', '#000000', '#FF0000', '#80FFFF', '#0000FF', '#FFFF80', '#000000', '#C0C0C0', 'none', '#C0C0C0', '#000000', '#808080', 'none', '#808080', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#FFFFFF', 'none', '#FFFFFF', '#B04040', '', 'none', '#000000', '#000000', '#FF0000', '#80FFFF', 'none', '#80FFFF', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#0000FF', '#FFFF80', 'none', '#FFFF80', '#000000', '#008000', '#008000', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#FFFFFF', '#FFFFFF', '#000000', '#000000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#008000', '#008000', '#000000', '#C0C0C0', '#C0C0C0', '#000000', '#808080', '#808080', '#000000', '#FFFF80', '#FFFF80', '#000000', '#FFFFFF', '#FFFFFF')";
#        mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

            $new_cal = getcalvals("0");
            $new_cal["calid"] = "-1";
            $new_cal["calname"] = "Public";
            $new_cal["caltitle"] = "Public";
            $new_cal["userid"] = "2";
            $new_cal["username"] = "Guest";

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
                    #if($xfloop == "") {$xfloop = ",";}
                }
            }
            $sqlstr .= ")";
            $query1 = mysql_query($sqlstr) or die("Cannot save Calendar Config<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

    $sqlstrgi = "select standardbgimg from ".$GLOBALS["tabpre"]."_setup";
    $querygi = mysql_query($sqlstrgi) or die("Database setup table error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstrgi."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    $rowgi = mysql_fetch_array($querygi);

    $sqlstr = "update ".$GLOBALS["tabpre"]."_cal_ini set gcscoif_standardbgimg='".$rowgi["standardbgimg"]."';"; # where calid = '0'";
    mysql_query($sqlstr) or die("Cannot execute query<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    @mysql_free_result($querygi);
}

# this brings up the CaLogic configure form.
# populated withe the default values.

function setup_calg() {

global $tabpre,$servertzos,$wroot,$wprogdir,$calogicversion;
global $setuptab,$fieldcnt;

print "<br><!--am in calgsetup -->";

#ini_set("error_reporting","E_ALL");

    $have_setuptab = false;
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_setup";
    $query1 = mysql_query($sqlstr) or die("Database setup table error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    $row = mysql_fetch_array($query1);
    $row = gmqfix($row,1);

print "<!--preparing to include cfgfrm.php -->";
#print "FIELDCNT = ".$fieldcnt."<br>";

    $newcalogic_uid = makeuid();

    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {
            if(!isset($row[$setuptab[$x][1]])) {

		if($setuptab[$x][1]=="calogic_uid") {
		    ${$setuptab[$x][1]} = $newcalogic_uid;
		} else {
		    ${$setuptab[$x][1]} = $setuptab[$x][8];
		}

            } else {
# this should never happen
                ${$setuptab[$x][1]} = $row[$setuptab[$x][1]];

            }
        }
    }
    mysql_free_result($query1);
#print "<br>";

#print "<br><!--preparing to include cfgfrm.php -->";
#print "FIELDCNT = ".$fieldcnt."<br>";

?>

    <form method="post" name="calgsetup" id="calgsetup" action="setup.php" LANGUAGE=javascript onsubmit="return calgsetup_onsubmit()">
<!--preparing to include cfgfrm.php -->

<?php
$inreconfig=0;
include("../include/cfgfrm.php");
?>
<!-- end config form -->
        <td width="23%" valign="top" align="center">
        <input type="submit" value="Submit" name="sumbit_step2">
        </td>
        <td width="22%" valign="top" align="center">
        <input type="reset" value="Reset">
        </td>
        <td width="55%" valign="top" align="left">
        &nbsp;
        </td>
      </tr>
    </table>

    </form>

<?php

}

# this is called if the user entered something wrong.
# it is used so that, that whatthe user entered is re-entered

function setup_calg_again() {

    global $tabpre,$servertzos,$wroot,$wprogdir;
    global $setuptab,$fieldcnt;

    global $fields,$tabpre,$calogicversion;
    global $setuptab,$fieldcnt;


    $have_setuptab = false;
#    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_setup";
#    $query1 = mysql_query($sqlstr) or die("Database setup table error.<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

#    $row = mysql_fetch_array($query1);
#    $row = gmqfix($row,1);

    for($x=0;$x<$fieldcnt;$x++) {
        if($setuptab[$x][1] != "tabhead") {
            if(!isset($fields[$setuptab[$x][1]])) {
               ${$setuptab[$x][1]} = $setuptab[$x][8];
            } else {
                ${$setuptab[$x][1]} = $fields[$setuptab[$x][1]];
            }
        }
    }

?>

    <form method="post" name="calgsetup" id="calgsetup" action="setup.php" LANGUAGE=javascript onsubmit="return calgsetup_onsubmit()">
<!--preparing to include cfgfrm.php -->
<?php
$inreconfig=0;
include("../include/cfgfrm.php");
?>

        <td width="23%" valign="top" align="center">
        <input type="submit" value="Submit" name="sumbit_step2">
        </td>
        <td width="22%" valign="top" align="center">
        <input type="reset" value="Reset">
        </td>
        <td width="55%" valign="top" align="left">
        &nbsp;
        </td>
      </tr>
    </table>

    </form>

<?php

}

# this is the first form shown
function setup_database() {
global $setfvar;
global $setuptab,$fieldcnt;

    $allowskip = 0;

/*
change this to ask if the user wants to use the current
dbloader, or make another one.
*/

    if (file_exists($GLOBALS["setpath"]."dbloader.php") ) {
        #include($GLOBALS["incpath"]."dbloader.php");
        $allowskip = 1;
    }

    if($allowskip==1) {
?>
<h3>CaLogic is already setup on this system.</h3><b>
You should now remove the setup folder from your web.<br><br>
If you later wish to change any options, please logon as admin <br>
and follow the "CaLogic Configuration" link<br>
under the Admin heading on the Functions menu.<br><br><br>
If you need to re-run the setup, then you must first remove or rename the<br>
settings.php and the dbloader.php file from the admin folder.<br>
</b>
<?php
#    print "<a href=\"".$fields["baseurl"].$fields["progdir"].$GLOBALS["idxfile"]."\">Click here to start CaLogic!</a><br><br>";
    return;

    }
?>

    Please make sure you are using the newest version of CaLogic before installing<br>
    <a href="http://www.demo.calogic.de/index.php?version=<?php print $GLOBALS["calogicversion"]; ?>" target="_blank">Click here to open a window that will tell you the newest version.</a><br><br>

    <form method="post" name="caldbsetup" id="caldbsetup" action="setup.php" LANGUAGE=javascript onsubmit="return caldbsetup_onsubmit()">
    <input type="hidden" name="setup_step" value="1">
    <table border="1" width="100%">
      <tr>
        <th width="23%" align="left">Option</th>
        <th width="22%" align="left">Entry</th>
        <th width="55%" align="left">Remark</th>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Path and name of Database Settings File</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="databasepath"  name="fields[databasepath]" size="65" value="<?php
            if($allowskip == 1) {
                print $GLOBALS["setfvar"];
            } else {
                print $GLOBALS["setpath"]."settings.php";
            }
        ?>">

        </td>
        <td width="55%" valign="top" align="left">
	    Enter the full path and name of the Database Settings file.<br>
            <b>the file name must end in ".php"</b>
        </td>
      </tr>

      <tr>
        <td width="23%" valign="top" align="left">Database Host Name</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="databasehost"  name="fields[databasehost]" size="30" <?php if($allowskip == 1) {print "value=\"".$dbhost."\""; } ?>>

        </td>
        <td width="55%" valign="top" align="left">
			Enter the name of your CaLogic Database Host.
        </td>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Database Name</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="databasename"  name="fields[databasename]" size="30" <?php if($allowskip == 1) {print "value=\"".$dbname."\""; } ?>>

        </td>
        <td width="55%" valign="top" align="left">
			Enter the name of your CaLogic Database.
        </td>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Database User Name</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="databaseuser"  name="fields[databaseuser]" size="30" <?php if($allowskip == 1) {print "value=\"".$dbuser."\""; } ?>>

        </td>
        <td width="55%" valign="top" align="left">
			Enter the Database User Name.
        </td>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Database User Password</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="databasepass"  name="fields[databasepass]" size="30" <?php if($allowskip == 1) {print "value=\"".$dbpass."\""; } ?>>

        </td>
        <td width="55%" valign="top" align="left">
			Enter the Database User Password.
        </td>
      </tr>


      <tr>
        <td width="23%" valign="top" align="left">Create Database</td>
        <td width="22%" valign="top" align="left">
            <select size="1" id="makedatabase" name="fields[makedatabase]">
            <option value="0" selected>No</option>
            <option value="1">Yes</option>
          	</select>
        </td>
        <td width="55%" valign="top" align="left">
            Select Yes if you would like to create the database.
            Select No if the database already exists.
            Selecting Yes will have no efect if the database already exists.
            Note: you must have the proper privileges to be able to create a database.<br><b>
            </b>
        </td>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Create Tables</td>
        <td width="22%" valign="top" align="left">
        	<select size="1" id="maketable" name="fields[maketable]">
            <option value="0" <?php if($allowskip == 1) {print "selected"; } ?>>No</option>
            <option value="1" <?php if($allowskip == 0) {print "selected"; } ?>>Yes</option>
          	</select>
        </td>
        <td width="55%" valign="top" align="left">
        For first time installations, this must be set to Yes.
        Set to No if you are changing your configuration.
        <br>
        <b>WARNING: Setting this to Yes will cause any CaLogic tables with the Table Name Prefix as set below to be deleted, and re-created.</b>
        </td>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Database Table Name Prefix</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="databaseprefix"  name="fields[databaseprefix]" size="30" value="<?php if($allowskip == 1) {print $GLOBALS["tabpre"]; } else { print "clc"; } ?>">

        </td>
        <td width="55%" valign="top" align="left">
	This will be prepended to all tables created. It should be between 3 and 5 letters long. This is used to allow you to
	individualize the tables created.
        </td>
      </tr>

	  <tr>
        <td width="23%" valign="top" align="left">Start File Name</td>
        <td width="22%" valign="top" align="left">

        <input type="text" id="startfile"  name="fields[startfile]" size="30" value="<?php if($allowskip == 1) {print $idxfile; } else { print "index.php"; } ?>">

        </td>
        <td width="55%" valign="top" align="left">
	    If you do not intend to change the name of the index.php file, then do not change this setting.
        </td>
      </tr>

      </table><br>
      <input type="submit" name="setupsubmitstep1" id="setupsubmitstep1" value="Submit"><br><br><b>
      Submit Actions: <br>Database Connection and Setting files will be created.
      <br>Database and tables will be created.
      </b><br><br>
      <?php
      if($allowskip == 1) {
          print "The dbloader and settings files already exist. Click Skip to move on to the next step.<br><br>";
          print "<INPUT id=skipstep1 type=button value=Skip name=skipstep1 LANGUAGE=javascript onclick=\"return skipstep1_onclick()\">";
      }
      ?>
      </form>
<?php
}


function setup_head() {
global $havegcfg;

print $GLOBALS["htmldoctype"];
?>

    <html>
    <head>
    <meta HTTP-EQUIV="Expires" CONTENT="0">
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">

    <title>CaLogic Calendars Setup</title>

    <SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
    <!--

    var ferr = false;

    function getdefaultcal() {
	alert("You have to finish this first setup\nand create a calendar before using this option");
    }

    function caldbsetup_onsubmit() {
    	caldbsetup.databasepath.value = trim(caldbsetup.databasepath.value);
    	caldbsetup.databasehost.value = trim(caldbsetup.databasehost.value);
    	caldbsetup.databasename.value = trim(caldbsetup.databasename.value);
    	caldbsetup.databaseuser.value = trim(caldbsetup.databaseuser.value);
    	caldbsetup.databaseprefix.value = trim(caldbsetup.databaseprefix.value);
    	caldbsetup.startfile.value = trim(caldbsetup.startfile.value);

        if(caldbsetup.databasepath.value == "") {
            alert("The Path cannot be blank!");
            ferr = true;
        }
        if(caldbsetup.databasehost.value == "") {
            alert("The Host cannot be blank!");
            ferr = true;
        }
        if(caldbsetup.databasename.value == "") {
            alert("The Database Name cannot be blank!");
            ferr = true;
        }
        if(caldbsetup.databaseuser.value == "") {
            alert("The User cannot be blank!");
            ferr = true;
        }
        if(caldbsetup.databaseprefix.value == "") {
            alert("The Prefix cannot be blank!");
            ferr = true;
        }
        if(caldbsetup.startfile.value == "") {
            alert("The Start File cannot be blank!");
            ferr = true;
        }
        if(ferr==true) {
            return false;
        } else {
            return true;
        }
    }

    function calgsetup_onsubmit() {
    	calgsetup.siteowner.value = trim(calgsetup.siteowner.value);
    	calgsetup.baseurl.value = trim(calgsetup.baseurl.value);
        if(calgsetup.siteowner.value == "") {
            alert("You must enter a Site Owner Name!");
            return false;
        }
        if(calgsetup.baseurl.value == "") {
            alert("You must enter base URL!");
            return false;
        }
        if(calgsetup.allowopen.value == 0 && calgsetup.allowpublic.value == 0 && calgsetup.allowprivate.value == 0) {
            alert("At least one type of Calendar must be enabled!");
            return false;
        }
        if(calgsetup.allowdv.value == 0 && calgsetup.allowwv.value == 0 && calgsetup.allowmv.value == 0 && calgsetup.allowyv.value == 0) {
            alert("At least one type of View must be enabled!");
            return false;
        }
        return true;
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

    function skipstep1_onclick() {
        caldbsetup.setup_step.value = 2;
        caldbsetup.submit();
    }

    function selcheck(selfield) {
    }
    //-->
    </SCRIPT>

    </head>

    <body background="<?php print "../img/stonbk.jpg"; ?>">
    <?php
    if($havegcfg==false) {
        #print "GCFG has not been loaded<br>";
    } else {
        #print "GCFG has been loaded<br>";
    }
    ?>
    <h1>CaLogic Calendars - First Time Setup</h1>

<?php
}

function setup_foot() {

// Please do not remove this information
// I worked a lot of long hard hours on this program
// give credit where credit is due.

print "<center><table border=\"0\" width=\"100%\">";
print "<tr>";

    ?>
    <td width="20%" align="right">
        <A class="gcprevlink" target="_blank" href="http://sourceforge.net ">
        <IMG src="../img/sf_logo.bmp" width="125" height="37" border="0" alt="SourceForge Logo">
        </A>
    </td>

    <td width="20%" align="left">
        <a target="_blank" class="gcprevlink" href="http://www.mysql.com ">
        <img border="1" width="125" height="37" src="../img/mysql_logo.png" alt="MySQL Logo">
        </a>
    </td>
    <td width="20%" align="center" nowrap>

        <a title="Visit the Home of CaLogic!" target="_blank" class="gcprevlink" href="http://www.calogic.de ">
        <font size="-1">CaLogic Calendars V<?php print $GLOBALS["calogicversion"]; ?></font>
        </a><br>
        <a title="EMail the author!" target="_blank" class="gcprevlink" href="mailto:philip@calogic.de">
        <font size="-1">&#xA9; Philip Boone</font>
        </a>
    </td>

    <td width="20%" align="right">
    <a target="_blank" class="gcprevlink" href="http://www.activestate.com ">
    <img border="1" src="../img/komodo.gif" alt="Komodo Logo">
    </a>
    </td>
    <td width="20%" align="left">
    <a target="_blank" class="gcprevlink" href="http://www.php.net ">
    <img border="1" src="../img/powered_php.gif" alt="PHP Logo">
    </a>
    </td>
    </tr>
    </table>
</center>
</body>
</html>

<?php

    exit();
}

?>
