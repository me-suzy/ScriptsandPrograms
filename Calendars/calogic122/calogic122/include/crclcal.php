<?php

/*
CaLogic
Copyright (c) Philip Boone.
philip@calogic.de

# this function is used to automatically create a user and or calendar
# it's purpose is to make CaLogic more integratable to sites that
# already require a user name and password.

how to use this feature:

There are two ways to use this feature, either as a form, or thru automation.
To use it as a form, simply enter the URL to this file in your browser, fill out the
form and click submit.

To use it thru automation, you have to call the program from your own PHP script
or thru a link.

You can also create a new user from the user settings.

Script example:


Link example:


Have fun and let me know if you need anything.

echo "am here";
exit();

*/

if(isset($crclcalsubmit)) {
    foreach($field as $k1 => $v1) {
        print $k1." = ".$field[$k1]."<br>";
    }

} elseif(isset($auto) && $auto==1) {


} else {
        //call up the form
?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>

<head>
<title>CaLogic User / Calendar Creation</title>
</head>
<body bgcolor=gainsboro>

<h2 align="center">CaLogic User / Calendar Creation</h2>
* denotes a required field
<form method="post" name="crclcalform" id="crclcalform" action="crclcal.php" >
<table border="1" cellpadding="0" cellspacing="0" style="BORDER-COLLAPSE: collapse" bordercolor="#111111" width="100%">
  <tr>
    <th width="18%" nowrap>Field</th>
    <th width="33%" nowrap>Entry</th>
    <th width="49%" nowrap>Remark</th>
  </tr>
  <tr>
    <td width="18%">User Name*</td>
    <td width="33%">&nbsp;<INPUT id="clcruname" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcruname]"></td>
    <td width="49%">Enter a unique user name</td>
  </tr>
  <tr>
    <td width="18%">First Name</td>
    <td width="33%">&nbsp;<INPUT id="clcrfname" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcrfname]"></td>
    <td width="49%">Enter the users first name</td>
  </tr>
  <tr>
    <td width="18%">Last Name</td>
    <td width="33%">&nbsp;<INPUT id="clcrlname" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcrlname]"></td>
    <td width="49%">Enter the users last name</td>
  </tr>
  <tr>
    <td width="18%">Password*</td>
    <td width="33%">&nbsp;<INPUT id="clcrpw" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcrpw]"></td>
    <td width="49%">Enter the users password</td>
  </tr>
  <tr>
    <td width="18%">Email Address*</td>
    <td width="33%">&nbsp;<INPUT id="clcremail" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcremail]"></td>
    <td width="49%">Enter the users email address.</td>
  </tr>
  <tr>
    <td width="18%">Create Calendar</td>
    <td width="33%">&nbsp;
    <INPUT type="checkbox" id="clcrmkcal" name="field[clcrmkcal]" LANGUAGE=javascript onclick="return clcrmkcal_onclick()">
	<LABEL for="clcrmkcal">Create user calendar</LABEL>
    </td>
    <td width="49%">Check this if you want to create a calendar for the user. <br>If you use the Standard Default Calendar option, then you should leave this unchecked.</td>
  </tr>
  <tr>
    <td width="18%">Calendar Name(*)</td>
    <td width="33%">&nbsp;<INPUT id="clcrcalname" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcrcalname]" disabled></td>
    <td width="49%">Enter the users calendar name</td>
  </tr>
  <tr>
    <td width="18%">Calendar Title(*)</td>
    <td width="33%">&nbsp;<INPUT id="clcrcaltit" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcrcaltit]" disabled></td>
    <td width="49%">Enter the users calendar title</td>
  </tr>
  <tr>
    <td width="100%" colspan=3>&nbsp;</td>
  </tr>
  <tr>
    <td width="18%">Admin User Name*</td>
    <td width="33%">&nbsp;<INPUT id="clcradminname" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcradminname]"></td>
    <td width="49%">Enter the admin user name</td>
  </tr>
  <tr>
    <td width="18%">Admin Password*</td>
    <td width="33%">&nbsp;<INPUT type="password" id="clcradminpass" style="WIDTH: 220px; HEIGHT: 22px" size=28 name="field[clcradminpass]"></td>
    <td width="49%">Enter the admin password</td>
  </tr>
  <tr>
    <td width="100%" colspan=3>&nbsp;</td>
  </tr>
  <tr>
    <td width="18%">Send user email</td>
    <td width="33%">&nbsp;
    <INPUT type="checkbox" id="clcrsuem" name="field[clcrsuem]">
    <LABEL for="clcrsuem">Send user email</LABEL>
    </td>
    <td width="49%">Check this to send the user a calendar creation email</td>
  </tr>
  <tr>
    <td width="18%">Include password</td>
    <td width="33%">&nbsp;
    <INPUT type="checkbox" id="clcrincpw" name="field[clcrincpw]">
	<LABEL for="clcrincpw">Include password</LABEL>
    </td>
    <td width="49%">Check this to include the password in the email</td>
  </tr>
  <tr>
	<td width="100%" colspan="3">&nbsp;</td>  </tr>
  <tr>
    <td width="100%" colspan="3">&nbsp;
    <INPUT id="crclcalsubmit" type="button" value="Submit" name="crclcalsubmit" LANGUAGE="javascript" onclick="return crclcalsubmit_onclick()">&nbsp;&nbsp;<INPUT id="reset1" type="reset" value="Reset" name="reset1"></td>
  </tr>
</table></form>
</body>

</html>

<?php
    exit();

}

?>
