<?php
include("./include/config.php");

if (!isset($langsel)) {
    $langsel = $standardlang;
} else {
// select language
}

$wptitle = translate("urth",$langsel);

if($GLOBALS["demomode"]==true) {
    $runningdemo = true;
} else {
    $runningdemo = false;
}

?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title><?php print $GLOBALS["sitetitle"]; ?> - <?php print $wptitle; ?></title>

<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

function submit_onclick() {
    document.userreg.uname.value=trim(document.userreg.uname.value);
    document.userreg.fname.value=trim(document.userreg.fname.value);
    document.userreg.lname.value=trim(document.userreg.lname.value);
    document.userreg.email.value=trim(document.userreg.email.value);
    document.userreg.pw.value=trim(document.userreg.pw.value);
    document.userreg.pwc.value=trim(document.userreg.pwc.value);
    if(document.userreg.uname.value == "") {
        alert("<?php print translate("rega1",$langsel); ?>");
        document.userreg.uname.focus();
        return false;
    }
    if(document.userreg.fname.value == "") {
        alert("<?php print translate("rega2",$langsel); ?>");
        document.userreg.fname.focus();
        return false;
    }
    if(document.userreg.lname.value == "") {
        alert("<?php print translate("rega3",$langsel); ?>");
        document.userreg.lname.focus();
        return false;
    }
    if(document.userreg.email.value == "") {
        alert("<?php print translate("rega4",$langsel); ?>");
        document.userreg.email.focus();
        return false;
    }
    if(document.userreg.pw.value == "") {
        alert("<?php print translate("rega5",$langsel); ?>");
        document.userreg.pw.focus();
        return false;
    }
    if(document.userreg.pwc.value == "") {
        alert("<?php print translate("rega6",$langsel); ?>");
        document.userreg.pwc.focus();
        return false;
    }
    if(document.userreg.pw.value != document.userreg.pwc.value) {
        alert("<?php print translate("rega7",$langsel); ?>");
        document.userreg.pw.value = "";
        document.userreg.pwc.value = "";
        document.userreg.pw.focus();
        return false;
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

function langsel_onchange() {
xurl = "userreg.php?langsel=" + userreg.langsel.value;
location.href=xurl;
}


function checkuser_onclick() {
    userreg.uname.value=trim(userreg.uname.value);
    if(userreg.uname.value == "") {
        alert("<?php print translate("rega1",$langsel); ?>");
        userreg.uname.focus();
        return false;
    }

	xurl="checkuser.php?username=" + userreg.uname.value;
	window.open(xurl,null,"height=200,width=400,status=no,toolbar=no,menubar=no,location=no",true);
}

function checkemail_onclick() {
    userreg.email.value=trim(userreg.email.value);
    if(userreg.email.value == "") {
        alert("<?php print translate("rega4",$langsel); ?>");
        userreg.email.focus();
        return false;
    }

	xurl="checkemail.php?useremail=" + userreg.email.value;
	window.open(xurl,null,"height=200,width=400,status=no,toolbar=no,menubar=no,location=no",true);
}
function gologon() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>?gologinform=1";
    location.href=xurl;
}

function gocalpvbut() {
    xurl="<?php echo $GLOBALS["idxfile"] ?>";
    location.href=xurl;
}
//-->
</SCRIPT>
</head>

<body <?php print $GLOBALS["sysbodystyle"]; ?>>

<h1><b>CaLogic - <?php print translate("urth",$langsel); ?></b></h1>
<b>You must enter a valid E-Mail adress in order to use CaLogic.<br>
After submiting this registration form, you will be sent a Confirmation E-Mail.<br>
There is a link in the E-Mail that will complete the registration process.<br>
Therefor, if you do not supply a valid E-Mail adress, you cannot recieve the <br>
confirmation E-mail and you will have no access to the Calendar.<br>
<?php
if($runningdemo == true) {
    print "If you would rather just look around in the Calendar with out registering,
    <br> you can login with the user name demo and the password demo.";
}
?>
</b>
<form method="<?php print $GLOBALS["postorget"]; ?>" name="userreg" id="userreg" action="saveuserreg.php">
  <table border="1" width="100%" cellspacing="3">
    <tr>
      <th width="14%">
        <p align="right"><?php print translate("urfh",$langsel); ?></p>
      </th>
      <th width="18%"><?php print translate("ureh",$langsel); ?></th>
      <th width="68%">
        <p align="left"><?php print translate("urrh",$langsel); ?></p>
      </th>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("un",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="text" name="fields[uname]" size="20" maxlength=10 id=uname></td>
      <td width="68%" valign="top"><?php print nl2br(translate("ungt",$langsel)); ?>&nbsp;
      <input type="button" value="Check" name="checkuser" id="checkuser" LANGUAGE=javascript onclick="return checkuser_onclick()">&nbsp;
      </td>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("fnt",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="text" name="fields[fname]" size="20" maxlength=20 id=fname></td>
      <td width="68%" valign="top"><?php print nl2br(translate("fngt",$langsel)); ?></td>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("lnt",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="text" name="fields[lname]" size="20" id=lname maxlength=20></td>
      <td width="68%" valign="top"><?php print nl2br(translate("lngt",$langsel)); ?></td>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("emt",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="text" name="fields[newemail]" size="20" maxlength=50 id=email></td>
      <td width="68%" valign="top"><?php print nl2br(translate("emgt",$langsel)); ?>&nbsp;
    <input type="button" value="Check" name="checkemail" id="checkemail" LANGUAGE=javascript onclick="return checkemail_onclick()">&nbsp;      </td>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("pw",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="password" name="fields[pw]" size="20" maxlength=10 id=pw></td>
      <td width="68%" valign="top"><?php print nl2br(translate("pwgt",$langsel)); ?></td>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("pwa",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="password" name="fields[pwc]" size="20" id=pwc maxlength=10></td>
      <td width="68%" valign="top"><?php print nl2br(translate("pwagt",$langsel)); ?>.</td>
    </tr>
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("llt",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><select size="1" name="langsel" id=langsel LANGUAGE=javascript onchange="return langsel_onchange()">
<?php

$sqlstr = "select * from ".$tabpre."_languages order by name";
$qu_res = mysql_query($sqlstr) or die("Cannot query language Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);

while ($rs_lang = mysql_fetch_array($qu_res)) {
    print "<OPTION Value=".$rs_lang["uid"];
    if ($rs_lang["uid"] == $langsel ) {print " selected ";}
    print ">".$rs_lang["name"]."</OPTION>\n";
}

?>
         </select></td>
      <td width="68%" valign="top"><?php print nl2br(translate("llgt",$langsel)); ?></td>
    </tr>
  </table>
  <p><input type="submit" value="<?php print translate("subut",$langsel); ?>" name="submit" id=submit LANGUAGE=javascript onclick="return submit_onclick()">&nbsp;&nbsp;&nbsp;<input type="reset" value="<?php print translate("rebut",$langsel); ?>" name="reset" id=reset>
  </p>
</form>
<br>
  &nbsp;&nbsp;&nbsp;<input type="button" value="Back to logon screen" name="blogon" id=blogon LANGUAGE=javascript onclick="gologon()">
  <?php
  if($GLOBALS["publicview"] == true ) {
    ?>
  &nbsp;&nbsp;&nbsp;<input type="button" value="Go to Calendar" name="gocalpvbut" id="gocalpvbut" LANGUAGE="javascript" onclick="return gocalpvbut()">
    <?php
  }
  ?>

<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
?>

