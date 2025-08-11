<?php
function edituser($cuser) {

    global $langcfg,$xcid;
    global $curcalcfg, $monthtext;

$xregtime = $cuser->gsv("regtime") + $cuser->gsv("caltzadj");
$xconftime = $cuser->gsv("conftime") + $cuser->gsv("caltzadj");

if($curcalcfg["timetype"] == 1) {
    $uregtime = date("d",$xregtime)." ".$monthtext[date("n",$xregtime)]." ".date("Y",$xregtime)." ".date("H",$xregtime).":".date("i",$xregtime);
    $uconftime = date("d",$xconftime)." ".$monthtext[date("n",$xconftime)]." ".date("Y",$xconftime)." ".date("H",$xconftime).":".date("i",$xconftime);
} else {
    $uregtime = date("d",$xregtime)." ".$monthtext[date("n",$xregtime)]." ".date("Y",$xregtime)." ".date("g",$xregtime).":".date("i",$xregtime).date("A",$xregtime);
    $uconftime = date("d",$xconftime)." ".$monthtext[date("n",$xconftime)]." ".date("Y",$xconftime)." ".date("g",$xconftime).":".date("i",$xconftime).date("A",$xconftime);
}

?>

<?php
print $GLOBALS["htmldoctype"];
?>
<html>

<head>
<title>User Settings</title>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

function useredit_onsubmit() {
	if(useredit.submitnocheck.value=="1") {
	    return true;
	}

    useredit.username.value=trim(useredit.username.value);
    useredit.firstname.value=trim(useredit.firstname.value);
    useredit.lastname.value=trim(useredit.lastname.value);
    useredit.useremail.value=trim(useredit.useremail.value);
    useredit.userpw.value=trim(useredit.userpw.value);
    useredit.newuserpw.value=trim(useredit.newuserpw.value);
    useredit.newuserpw2.value=trim(useredit.newuserpw2.value);

    if(useredit.username.value == "") {
        alert("None of the fields may be blank.");
        useredit.username.focus();
        return false;
    }
    if(useredit.firstname.value == "") {
        alert("None of the fields may be blank.");
        useredit.firstname.focus();
        return false;
    }
    if(useredit.lastname.value == "") {
        alert("None of the fields may be blank.");
        useredit.lastname.focus();
        return false;
    }
    if(useredit.useremail.value == "") {
        alert("None of the fields may be blank.");
        useredit.useremail.focus();
        return false;
    }

    if(useredit.makenewu.value==0) {
        if(useredit.userpw.value != "") {
                if(useredit.newuserpw.value == "" || useredit.newuserpw2.value == "") {
                    alert("You entered your password, which means you wish to change it.\nHowever, one or both of the new password fields is blank.");
                        useredit.userpw.value="";
                            useredit.newuserpw.value ="";
                            useredit.newuserpw2.value ="";
                        useredit.userpw.focus();
                    return false;
                }
                    if(useredit.newuserpw.value != useredit.newuserpw2.value) {
                        alert("The new password fields do not match.");
                        useredit.userpw.value="";
                            useredit.newuserpw.value ="";
                            useredit.newuserpw2.value ="";
                        useredit.userpw.focus();
                        return false;
                    }
        }
    } else {
        if(useredit.userpw.value == "") {
            alert("You must enter a password");
            return false;
        }
    }

    if(useredit.cuia.value == "1") {
        if(useredit.newuserpw.value != useredit.newuserpw2.value) {
            alert("The new password fields do not match.");
                useredit.newuserpw.value ="";
                useredit.newuserpw2.value ="";
            useredit.newuserpw.focus();
            return false;
        }
    }
	useredit.deluserok.value="0";
    return true;
}

<?php
if ($cuser->gsv("isadmin") == 1) {
?>
function userlist_onchange() {

	if(useredit.userlist.selectedIndex < 0) {
	    return false;
	}
	var curuserval = useredit.userlist.options(useredit.userlist.selectedIndex).value;
	var curuserset = curuserval.split("|");
	useredit.changepass.checked = false;
	useredit.ccxid.value = curuserset[0];
	useredit.username.value = curuserset[1];
	useredit.firstname.value = curuserset[2];
	useredit.lastname.value = curuserset[3];
	useredit.useremail.value = curuserset[4];

	useredit.pusername.value = curuserset[1];
	useredit.pfirstname.value = curuserset[2];
	useredit.plastname.value = curuserset[3];
	useredit.puseremail.value = curuserset[4];

	useredit.usertzos.value = curuserset[10];
	useredit.userregon.value = curuserset[11];
	useredit.userconfon.value = curuserset[12];
	useredit.failedli.value = curuserset[13];

	if(curuserset[15] == 1) {
	    useredit.usertzlock.checked = true;
	} else {
	    useredit.usertzlock.checked = false;
	}

	//useredit.pfailedli.value = curuserset[13];

	if(useredit.ccxid.value != useredit.currentuser.value) {
	    useredit.userpw.disabled = true;
	    if(curuserset[1] == "Guest" || curuserset[1] == "demo") {
		useredit.newuserpw.disabled = true;
		useredit.newuserpw2.disabled = true;
		useredit.changepass.disabled = true;
	    } else {
		useredit.newuserpw.disabled = false;
		useredit.newuserpw2.disabled = false;
		useredit.changepass.disabled = false;
	    }
	} else {
		useredit.userpw.disabled = false;
		useredit.newuserpw.disabled = false;
		useredit.newuserpw2.disabled = false;
		useredit.changepass.disabled = false;
	}

	for(i=0;i<useredit.userlangsel.length;i++) {
		if(useredit.userlangsel.options(i).value == curuserset[6]) {
			useredit.userlangsel.selectedIndex = i;
			//useredit.puserlangsel.value = useredit.userlangsel.options(i).value;
		}
	}

	for(i=0;i<useredit.emailtype.length;i++) {
		if(useredit.emailtype.options(i).value == curuserset[14]) {
		    useredit.emailtype.selectedIndex = i;
		}
	}

<?php
if($GLOBALS["forcedefaultcal"]==0) {
?>
	for(i=0;i<useredit.usercalsel.length;i++) {
		if(useredit.usercalsel.options(i).value == curuserset[8]) {
			useredit.usercalsel.selectedIndex = i;
			//useredit.pusercalsel.value = useredit.usercalsel.options(i).value;
		}
	}
<?php
}
?>
    useredit.userisadmin.selectedIndex = curuserset[5];
    //useredit.puserisadmin.value = curuserset[5];

    if(curuserset[0] == useredit.currentuser.value) {
        useredit.username.disabled = false;
        useredit.userisadmin.disabled = true;
        useredit.deleteuser.disabled = true;

            document.all.item("pwinfo").innerText = "Enter your current password here if you intend to change it.";
            document.all.item("newpwinfo1").innerText = "Enter your new password here.";
            document.all.item("newpwinfo2").innerText = "Confirm your new password here.";

    } else {
        if(curuserset[1] == "Guest" || curuserset[1] == "demo") {
            useredit.username.disabled = true;
            useredit.userisadmin.disabled = true;
            useredit.deleteuser.disabled = true;
            document.all.item("pwinfo").innerText = "This users password cannot be changed";
            document.all.item("newpwinfo1").innerText = "This users password cannot be changed";
            document.all.item("newpwinfo2").innerText = "This users password cannot be changed";

        } else {
            document.all.item("pwinfo").innerText = "As Admin, you may now change the users password.";
            document.all.item("newpwinfo1").innerText = "Enter the users new password here.";
            document.all.item("newpwinfo2").innerText = "Confirm the users new password here.";
            useredit.username.disabled = false;
            useredit.userisadmin.disabled = false;
            useredit.deleteuser.disabled = false;
        }
    }
    //alert("ccxid: " + useredit.ccxid.value);
    //alert("curuserset[0]: " + curuserset[0]);
    //alert("currentuser: " + useredit.currentuser.value);
}
<?php
}
?>

function checkuser_onclick() {
    useredit.username.value=trim(useredit.username.value);
    if(useredit.username.value == "") {
        alert("None of the fields may be blank.");
        useredit.username.focus();
        return false;
    }

	xurl="checkuser.php?username=" + useredit.username.value;
	window.open(xurl,null,"height=200,width=400,status=no,toolbar=no,menubar=no,location=no",true);
}

function checkemail_onclick() {
    useredit.useremail.value=trim(useredit.useremail.value);
    if(useredit.useremail.value == "") {
        alert("None of the fields may be blank.");
        useredit.useremail.focus();
        return false;
    }

	xurl="checkemail.php?useremail=" + useredit.useremail.value;
	window.open(xurl,null,"height=200,width=400,status=no,toolbar=no,menubar=no,location=no",true);
}

function deleteuser_onclick() {

<?php
if ($cuser->gsv("isadmin") == 1) {
?>
	if(useredit.userlist.selectedIndex < 0) {
		alert("You must first select a user!");
		return false;
	}
	var curuserval = useredit.userlist.options(useredit.userlist.selectedIndex).value;
	var curuserset = curuserval.split("|");
	if(curuserset[0] == useredit.currentuser.value) {
            alert("An Admin user cannot delete him/her self");
            return false;
        }

	if(curuserset[0] == useredit.currentuser.value) {

<?php
}
?>
		if(confirm("Are you sure you want to delete yourself?\nEverything associated with your user name will also be deleted, including\nyour Calendars, Events and Contacts.") == true) {
			useredit.submitnocheck.value="1";
			useredit.deluserok.value="1";
			useredit.submit();
		}

<?php
if ($cuser->gsv("isadmin") == 1) {
?>

	} else {
		if(confirm("Are you sure you wish to delete the selected user?\nEverything associated with this user name will also be deleted, including\nCalendars, Events and Contacts.") == true) {
    		if(confirm("Would you like to inform the user of the deletion per email?") == true) {
                useredit.senddelmail.value = "1";
            }
			useredit.submitnocheck.value="1";
			useredit.deluserok.value="1";
			useredit.submit();
		}
	}

<?php
}
?>
}

<?php
if($cuser->gsv("isadmin")==1) {
?>

function startemulation() {

    if(useredit.userlist.selectedIndex < 0) {
	    alert("You must first select a user!");
	    return false;
    }
    useremulate.username.value = useredit.username.value;
    ///xurl = "<?php #print $GLOBALS["baseurl"].$GLOBALS["progdir"].$GLOBALS["idxfile"]; ?>?clseckey=<?php #print $GLOBALS["calogic_uid"]; ?>&emulateuser=1&uname=" + useredit.username.value
    ///window.open(xurl,"CaLogic","height=600,width=800,status=no,toolbar=yes,menubar=no,location=no,resizable=yes,scrollbars=yes");
    ///return false;
    useremulate.submit();

}


function newuser_onclick() {

    alert("Enter New User Information, then click Save.\nClick Done to cancel.");
    useredit.makenewu.value=1;
    useredit.deleteuser.disabled = true;
    useredit.newuser.disabled = true;
    useredit.changepass.checked = false;
    useredit.userisadmin.disabled = false;

    useredit.ccxid.value = "";
    useredit.username.value = "";
    useredit.firstname.value = "";
    useredit.lastname.value = "";
    useredit.useremail.value = "";

    useredit.pusername.value = "";
    useredit.pfirstname.value = "";
    useredit.plastname.value = "";
    useredit.puseremail.value = "";

    useredit.usertzos.value = "";
    useredit.usertzlock.checked = false;
    useredit.userregon.value = "";
    useredit.userconfon.value = "";
    useredit.failedli.value = "0";
    useredit.pfailedli.value = "";

    useredit.ccxid.value = "";
//    useredit.currentuser.value = "";
    useredit.userpw.disabled = false;
    useredit.changepass.disabled = false;
    useredit.userlangsel.selectedIndex = 0;
    useredit.puserlangsel.value = 0;
    useredit.userisadmin.selectedIndex = 0;
    useredit.emailtype.selectedIndex = 0;

}

<?php
}
?>

function doneuser_onclick() {

	if(useredit.makenewu.value==1) {

	    useredit.deleteuser.disabled = false;
	    useredit.newuser.disabled = false;
	    useredit.changepass.checked = false;
	    useredit.userisadmin.disabled = false;
	    useredit.userpw.disabled = false;
	    useredit.changepass.disabled = false;
	    useredit.makenewu.value="0";
	    useredit.userlist.selectedIndex = 0;
	    userlist_onchange();
	    return false;

	} else {

	    useredit.submitnocheck.value="1";
	    useredit.deluserok.value="0";
	    return true;

	}


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

function window_onload() {
<?php
if ($cuser->gsv("isadmin") == 1 && !isset($xcid)) {
    print "useredit.userlist.selectedIndex = 0;";
    print "userlist_onchange();";
} elseif ($cuser->gsv("isadmin") == 1 && isset($xcid)) {
    if ($xcid !=0) {
        print "userlist_onchange();";
    } else {
        print "useredit.userlist.selectedIndex = 0;";
        print "userlist_onchange();";
    }
} elseif ($cuser->gsv("isadmin") == 1) {
    print "useredit.userlist.selectedIndex = 0;";
    print "userlist_onchange()";
}
?>

}

//-->
</SCRIPT>
</head>

<body <?php print $GLOBALS["calbodystyle"]; ?> LANGUAGE=javascript onload="return window_onload()">

<h1>User Settings</h1>
<?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "<center><b>This user cannot be changed</b></center>";} ?>
<form method="<?php print $GLOBALS["postorget"]; ?>" name="useredit" id="useredit" action="<?php print $GLOBALS["idxfile"]; ?>" LANGUAGE=javascript onsubmit="return useredit_onsubmit()">
<INPUT type="hidden" id="deluserok" name="deluserok" value="0">
<INPUT type="hidden" id="senddelmail" name="senddelmail" value="0">
<INPUT type="hidden" id="currentuser" name="currentuser" value="<?php print $cuser->gsv("cuid"); ?>">
<INPUT type="hidden" id="makenewu" name="makenewu" value="0">
<?php
if($cuser->gsv("isadmin") == 1) {
?>
<INPUT type="hidden" id="ccxid" name="ccxid" value="">
<INPUT type="hidden" id="cuia" name="cuia" value="1">
<?php
} else {
?>
<INPUT type="hidden" id="cuia" name="cuia" value="0">
<?php
}
?>
<INPUT type="hidden" id="submitnocheck" name="submitnocheck" value="0">
<table border="1" width="100%">
    <tr>
      <td width="<?php if($cuser->gsv("isadmin") == 1) { print "15%"; } else { print "0"; } ?>" valign="top" align="center">
      <?php if($cuser->gsv("isadmin") == 1) { ?>
        <u>User List</u><br>
        <select size="20" tabindex="1" name="userlist" id="userlist" style="width: 250" LANGUAGE=javascript onchange="return userlist_onchange()">
<?php
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_user_reg order by lname,fname";
    $query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        $selcuruser = " ";
        if($row["uid"] == $xcid) {
            $selcuruser = " selected ";
        }
	print "        <option ".$selcuruser." ";
        $zregtime = $row["regtime"]+$row["tzos"];
        $zconftime = $row["conftime"]+$row["tzos"];

        if($curcalcfg["timetype"] == 1) {
            $cregtime = date("d",$zregtime)." ".$monthtext[date("n",$zregtime)]." ".date("Y",$zregtime)." ".date("H",$zregtime).":".date("i",$zregtime);
            $cconftime = date("d",$zconftime)." ".$monthtext[date("n",$zconftime)]." ".date("Y",$zconftime)." ".date("H",$zconftime).":".date("i",$zconftime);
        } else {
            $cregtime = date("d",$zregtime)." ".$monthtext[date("n",$zregtime)]." ".date("Y",$zregtime)." ".date("g",$zregtime).":".date("i",$zregtime).date("A",$zregtime);
            $cconftime = date("d",$zconftime)." ".$monthtext[date("n",$zconftime)]." ".date("Y",$zconftime)." ".date("g",$zconftime).":".date("i",$zconftime).date("A",$zconftime);
        }

	    if($row["tzos"] != 0) {
		$xtzos = abs($row["tzos"]) / 60 / 60;
	    } else {
		$xtzos = 0;
	    }
	    if($row["tzos"] < 0) {
		$xtzos = "-" + $xtzos;
	    } else {
		$xtzos = "+" + $xtzos;
	    }

        print "value = \"".$row["uid"]."|".($row["uname"])."|".($row["fname"])."|".($row["lname"])."|".($row["email"])."|".$row["isadmin"]."|".$row["langid"]."|".$row["language"]."|".$row["startcalid"]."|".($row["startcalname"])."|".$xtzos."|".$cregtime."|".$cconftime."|".$row["failedli"]."|".$row["emailtype"]."|".$row["tzlock"]."\">".$row["lname"].", ".$row["fname"]." (".$row["uname"].")</option>\n";
     }
     mysql_free_result($query1);
?>
        </select>
	<hr>
	Click this button to emulate the selected user. After clicking, a new instance of CaLogic will start in a new browser and you will be logged on as the selected user.<br>
	<input type="button" value="Emulate user" id="emulateuser" name="emulateuser" language="javascript" onclick="return startemulation();">
      <?php
      } else {
        print "&nbsp;";
      }
      ?>
      </td>
      <td width="<?php if($cuser->gsv("isadmin") == 1) { print "55%"; } else { print "100%"; } ?>" valign="top" align="left" nowrap>
        <table border="1" width="100%">
          <tr>
            <td width="20%" valign="top" align="left" nowrap>User Name:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" tabindex="2" name="fields[username]" id="username" style="width: 250" maxlength="10" value="<?php print $cuser->gsv("uname"); ?>">&nbsp;
            <input type="hidden" name="prev_fields[username]" id="pusername" value="<?php print $cuser->gsv("uname"); ?>">
            </td>
            <td width="70%" valign="top" align="left">
                <input type="button" tabindex="3" value="Check" name="checkuser" id="checkuser" LANGUAGE=javascript onclick="return checkuser_onclick()">&nbsp;
                The User Name must be unique.
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>First Name:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" tabindex="4" name="fields[firstname]" id="firstname" style="width: 250" maxlength="20" value="<?php print $cuser->gsv("fname"); ?>">&nbsp;
            <input type="hidden" name="prev_fields[firstname]" id="pfirstname" value="<?php print $cuser->gsv("fname"); ?>">
		  </td>
            <td width="70%" valign="top" align="left">&nbsp;
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>Last Name:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" tabindex="5" name="fields[lastname]" id="lastname" style="width: 250" maxlength="20" value="<?php print $cuser->gsv("lname"); ?>">&nbsp;
            <input type="hidden" name="prev_fields[lastname]" id="plastname" value="<?php print $cuser->gsv("lname"); ?>">
            </td>
            <td width="70%" valign="top" align="left">&nbsp;
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>E-Mail:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" tabindex="6" name="fields[useremail]" id="useremail" style="width: 250" maxlength="50" value="<?php print $cuser->gsv("email"); ?>">&nbsp;
            <input type="hidden" name="prev_fields[useremail]" id="puseremail" value="<?php print $cuser->gsv("email"); ?>">
            </td>
            <td width="70%" valign="top" align="left">
            <input type="button" tabindex="7" value="Check" name="checkemail" id="checkemail" LANGUAGE=javascript onclick="return checkemail_onclick()">&nbsp;
            The E-Mail must be unique.
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>E-Mail Type:</td>
            <td width="30%" valign="top" align="left" nowrap>

            <select size="1" tabindex="13" name="fields[emailtype]" id="emailtype" style="width: 250">
            <option <?php if($cuser->gsv("emailtype")=="HTML") {print "selected";} ?> value="HTML">HTML</option>
            <option <?php if($cuser->gsv("emailtype")=="TEXT") {print "selected";} ?> value="TEXT">Text</option>
            <option <?php if($cuser->gsv("emailtype")=="SMS") {print "selected";} ?> value="SMS">SMS</option>
            </select>
            <input type="hidden" name="prev_fields[emailtype]" id="pemailtype" value="<?php print $cuser->gsv("emailtype"); ?>">
            </td>
            <td width="70%" valign="top" align="left">
	    Select how you want emails sent to you to be formated
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>Password:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "disabled";} ?> type="password" tabindex="8" name="userpw" id="userpw" style="width: 250">
            </td>
            <td width="70%" valign="top" align="left" id="pwinfo">
            Enter your current password here if you intend to change it.
            <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "<br>This users password cannot be changed";} ?>
            </td>
          </tr>
          <tr>
            <td width="20%" valign="top" align="left" nowrap>New Password:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "disabled";} ?> type="password" tabindex="9" name="newuserpw" id="newuserpw" style="width: 250">
            </td>
            <td width="70%" valign="top" align="left" id="newpwinfo1">
            Enter your new password here.
            <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "<br>This users password cannot be changed";} ?>
            </td>
          </tr>
          <tr>
            <td width="20%" valign="top" align="left" nowrap>New Password Repeat:</td>
            <td width="30%" valign="top" align="left" nowrap >
            <input <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "disabled";} ?> type="password" tabindex="10" name="newuserpw2" id="newuserpw2" style="width: 250">
            </td>
            <td width="70%" valign="top" align="left" id="newpwinfo2">
            Confirm your new password here.
            <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "<br>This users password cannot be changed";} ?>
            </td>
          </tr>
<?php
if($cuser->gsv("isadmin") == 1) {
?>
          <tr>
            <td width="20%" valign="top" align="left" nowrap>Force Change Password:</td>
            <td width="30%" valign="top" align="left" nowrap >
            <input type="checkbox" tabindex="10" name="changepass" id="changepass" Value="1"><label for="changepass">Change Password</label>
            </td>
            <td width="70%" valign="top" align="left">
            Checking this box will force the user to change thier password upon next login.
            </td>
          </tr>
          <tr>
            <td width="20%" valign="top" align="left" nowrap>Failed Login attempts:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" tabindex="10" name="fields[failedli]" id="failedli" style="width: 250" value="<?php print $cuser->gsv("failedli"); ?>">&nbsp;
            <input type="hidden" name="prev_fields[failedli]" id="pfailedli" value="<?php print $cuser->gsv("failedli"); ?>">
            </td>
            <td width="70%" valign="top" align="left">
                This is the number of failed login attempts. <?php
                if($GLOBALS["badpwlock"] > 0 ) {
                    print "A number higher than ".$GLOBALS["badpwlock"]." means the account is locked. Set it to 0 to unlock it.";
                } else {
                    print "Account locking is not activated.";
                }
                ?>
            </td>
          </tr>

<?php
}
?>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>Language:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <select size="1" tabindex="11" name="fields[userlangsel]" id="userlangsel" style="width: 250">
<?php
    $sqlstr = "select * from ".$GLOBALS["tabpre"]."_languages ";
    $query1 = mysql_query($sqlstr) or die("Cannot query Global Language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = @mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
	print "        <option ";
        if($cuser->gsv("langsel") == $row["uid"]) {
            print "selected ";
        }
        print "value = \"".$row["uid"]."\">".$row["name"]."</option>\n";
     }
     mysql_free_result($query1);
?>            </select>
            <input type="hidden" name="prev_fields[userlangsel]" id="puserlangsel" value="<?php print $cuser->gsv("langsel"); ?>">
            </td>
            <td width="70%" valign="top" align="left">&nbsp;
            </td>
          </tr>
          <tr>
            <td width="20%" valign="top" align="left" nowrap>Main Calendar:</td>
            <td width="30%" valign="top" align="left" nowrap>
<?php
if($GLOBALS["forcedefaultcal"]==0) {
?>
            <select size="1" tabindex="12" name="fields[usercalsel]" id="usercalsel" style="width: 250">
<?php
    if($cuser->gsv("isadmin") == 1) {
        $sqlstr = "select calid,calname,userid,username,caltype from ".$GLOBALS["tabpre"]."_cal_ini where calid <> '0' order by calname";
    } else {
        $sqlstr = "select calid,calname,userid,username,caltype from ".$GLOBALS["tabpre"]."_cal_ini where userid = ".$cuser->gsv("cuid")." or (caltype < 2 and calid <> '0') order by calname";
    }
    $query1 = mysql_query($sqlstr) or die("Cannot query Calendar Ini Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

    while($row = mysql_fetch_array($query1)) {
        $row = gmqfix($row,1);
        $sqlstr2 = "select * from ".$GLOBALS["tabpre"]."_user_reg where uid = ".$row["userid"];
        $query2 = mysql_query($sqlstr2) or die("Cannot query user Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr2."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $row2 = mysql_fetch_array($query2);
        $row2 = gmqfix($row2,1);
		print "        <option ";
        if($cuser->gsv("startcalid") == $row["calid"]) {
            print "selected ";
        }
        print "value = \"".$row["calid"]."\">";
        if($row["caltype"] == 0) {
            print "OP ";
        } elseif($row["caltype"] == 1) {
            print "PU ";
        } elseif($row["caltype"] == 2) {
            print "PR ";
        }
        print "\"".$row["calname"]."\" Owner: ".$row2["fname"]." ".$row2["lname"]."</option>\n";
         mysql_free_result($query2);
     }
     mysql_free_result($query1);
?>
            </select>
<?php
} else {
?>
        <?php print $cuser->gsv("startcalname"); ?>
	<!--<input type="hidden" name="fields[usercalsel]" id="usercalsel" value="<?php #print $cuser->gsv("startcalid"); ?>">-->
<?php
}
?>
            <input type="hidden" name="prev_fields[usercalsel]" id="pusercalsel" value="<?php print $cuser->gsv("startcalid"); ?>">
            </td>
            <td width="70%" valign="top" align="left">
<?php
if($GLOBALS["forcedefaultcal"]==0) {
?>
            "PR" = Private, "PU" = Public, "OP" = Open
<?php
} else {
?>
Default Calendar Option is enabled so this option cannot be changed.
<?php
}
?>
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>TimeZone Offset:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" name="fields[usertzos]" id="usertzos" style="width: 250" value="<?php print $cuser->gsv("usertz"); ?>">
	    <input type="hidden" name="prev_fields[usertzos]" id="pusertzos" value="<?php print $cuser->gsv("usertz"); ?>">
	    </td>
            <td width="70%" valign="top" align="left">This is the TimeZone Offset in hours from the Server, not from GMT.<br>Note: This setting gets set each time you logon. But if your Server does not have the correct time or timezone set, this setting will be wrong. In that case, set it yourself, then check the TimeZone Lock checkbox below.
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>TimeZone Lock:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input <?php if($cuser->gsv("tzlock") == 1) {print " checked "; } ?> type="checkbox" name="fields[usertzlock]" id="usertzlock" value="1">
	    <label for="usertzlock">TimeZone Lock</label>
	    <input type="hidden" name="prev_fields[usertzlock]" id="pusertzlock" value="<?php print $cuser->gsv("tzlock"); ?>">

            </td>
            <td width="70%" valign="top" align="left">Check this if you need to set the TimeZone Offset above yourself.
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>Registered on:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" name="userregon" id="userregon" style="width: 250" readOnly value="<?php print $uregtime; ?>">
            </td>
            <td width="70%" valign="top" align="left">Read only.
            </td>
          </tr>

          <tr>
            <td width="20%" valign="top" align="left" nowrap>Confirmed on:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <input type="text" name="userconfon" id="userconfon" style="width: 250" readOnly value="<?php print $uconftime; ?>">
            </td>
            <td width="70%" valign="top" align="left">Read only.
            </td>
          </tr>
<?php
if($cuser->gsv("isadmin") == 1) {
?>
          <tr>
            <td width="20%" valign="top" align="left" nowrap>Admin:</td>
            <td width="30%" valign="top" align="left" nowrap>
            <select size="1" tabindex="13" name="fields[userisadmin]" id="userisadmin" style="width: 250">
            <option disabled value="0">No</option>
            <option selected value="1">Yes</option>
            </select>
            <input type="hidden" name="prev_fields[userisadmin]" id="puserisadmin" value="<?php print $cuser->gsv("isadmin"); ?>">
            </td>
            <td width="70%" valign="top" align="left">Use cautiously!
            </td>

          </tr>
<?php
}
?>
        </table>
        <br>
            <table border="1" width="100%">
                <tr>
                <td width="25%" valign="middle" align="center" nowrap>
                <?php
                if($cuser->gsv("isadmin")==1) {
                    ?>
                <input type="button" language="javascript" onclick="return newuser_onclick()" tabindex="14" value="New" name="newuser" id="newuser">
                <?php
                } else {
                    print "&nbsp;";
                }
                ?>
                </td>
                <td width="25%" valign="middle" align="center" nowrap>
                <input <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest") {print "disabled";} ?> type="submit" tabindex="14" value="Save" name="saveuser" id="saveuser">
                </td>
                <td width="25%" valign="middle" align="center" nowrap>
                <input <?php if($cuser->gsv("uname") == "demo" || $cuser->gsv("uname") == "Guest" || $cuser->gsv("isadmin")) {print "disabled";} ?> type="button" tabindex="15" value="Delete" name="deleteuser" id="deleteuser" LANGUAGE=javascript onclick="return deleteuser_onclick()">
                </td>
                <td width="25%" valign="middle" align="center" nowrap>
                <input type="submit" tabindex="16" value="Done" name="doneuser" id="doneuser" LANGUAGE=javascript onclick="return doneuser_onclick()">
                </td>
                </tr>
            </table>
      </td>
    </tr>
  </table>
</form>
<?php
if($cuser->gsv("isadmin")==1) {
?>
<form method="POST" name="useremulate" id="useremulate" action="<?php print $GLOBALS["idxfile"]; ?>" LANGUAGE="javascript">
<INPUT type="hidden" id="clseckey" name="clseckey" value="<?php print $GLOBALS["calogic_uid"]; ?>">
<INPUT type="hidden" id="emulateuser" name="emulateuser" value="1">
<INPUT type="hidden" id="username" name="username" value="">
</form>
<?php
}
?>

<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
exit();
}?>
