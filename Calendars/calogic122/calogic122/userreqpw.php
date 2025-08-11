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
<title><?php print $GLOBALS["sitetitle"]; ?> - Request New Password</title>

<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

function submit_onclick() {
    document.userreg.email.value=trim(document.userreg.email.value);
    if(document.userreg.email.value == "") {
        alert("<?php print translate("rega4",$langsel); ?>");
        document.userreg.email.focus();
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
xurl = "userreqpw.php?langsel=" + userreg.langsel.value;
location.href=xurl;
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

<h1><b>CaLogic - Request New Password</b></h1>
<b>Please enter the E-Mail address you used to register with CaLogic.<br>
After you submit the form, you will be sent an email with a confirmation link. You must follow the link<br>
to activate your new password.<br><br>
</b>
<form method="<?php print $GLOBALS["postorget"]; ?>" name="userreg" id="userreg" action="sendreqpw.php">
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
    <tr>
      <th width="14%" valign="top" align="right" nowrap><?php print translate("emt",$langsel); ?></th>
      <td width="18%" valign="top" align="center"><input type="text" name="fields[newemail]" size="30" maxlength=50 id=email></td>
      <td width="68%" valign="top">Enter the E-Mail address you used to register with CaLogic.
    </td>
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
  &nbsp;&nbsp;&nbsp;<input type="button" value="Go to Public Calendar" name="gocalpvbut" id="gocalpvbut" LANGUAGE="javascript" onclick="return gocalpvbut()">
    <?php
  }
  ?>

<?php
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
?>

