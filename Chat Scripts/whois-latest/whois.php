<?php
session_start();
header("Cache-control: private"); 
?>
<!-- 
        Whois Script v. 1.2.2
        Author: [ed]
        Site: http://www.acemiles.com
        Support: See site
        
        Feel free to redistribute, 
        modify, etc.. But you MUST 
        leave this header in the files.

        Based on code by:
        Cobi (WinBots.org)
        Jon Haworth (Laughing-Buddha.net)
        Ap0s7le (ap0s7le.com)

        See README for more information
        
        If you wish to change the design
        of the output, modify this
        file.

        This file is actually only an
        example of how you can take
        advantage of the whois script.
        See the readme file to learn
        how to extend the script.
-->
<HTML>
<HEAD>
<TITLE>Whois Example</TITLE>
<style type="text/css" media="screen">
#box {
        border-color: 5px #000000;
        background-color: #4169E1;
        width: 400px;
        color: #FFFFFF;
}
input {
        border: 1px solid #FFE38F;
        background-color: #CCD9FF;
        color: #000000;
        font: 12px sans-serif;
}
body {
        font: 12px sans-serif;
}
table {
        font: 12px sans-serif;
}
</style>
</HEAD>
<BODY>

<table bgcolor="#F2FFCC" width="400" border="0" cellpadding="4" cellspacing="0">
  <tr> 
    <td bgcolor="#8FABFF" valign="top" width="18%" nowrap><div align="left"><strong>Online WHOIS:</strong></div></td>
  </tr>


 <tr> 
    <td valign="top" nowrap><div align="left"><FORM ACTION="whois.php" METHOD="POST">
Enter nickname: <input type="text" name="nickname">
<input type="submit" name="Submit" value="Who is...">
</FORM>
</div></td>

  </tr>

</table>
<?php 
if(isset($HTTP_POST_VARS['Submit'])) {
require("func.php");
if (isset($nickname)) {
 ?>
<table bgcolor="#F2FFCC" width="400" border="0" cellpadding="4" cellspacing="0">
  <tr> 
    <td bgcolor="#FFE38F" valign="top" width="18%" nowrap><div align="right">Nick:</div></td>
    <td bgcolor="#FFE38F" valign="top" width="82%" nowrap><?php echo stripslashes($nickname); ?> (<?php echo stripslashes($username); echo "@"; echo stripslashes($hostname); ?>)</td>
  </tr>
  <tr> 
    <td valign="top" nowrap><div align="right">Realname:</div></td>
    <td valign="top"><?php echo stripslashes($realname); ?></td>

  </tr>
  <tr> 
    <td valign="top" nowrap><div align="right">Channels:</div></td>
    <td valign="top"><?php echo stripslashes($channels); ?></td>
  </tr>
  <tr> 
    <td valign="top" nowrap><div align="right">Server:</div></td>
    <td valign="top"><?php echo stripslashes($server); ?></td>

  </tr>
<tr> 
    <td valign="top" nowrap><div align="right">Idle time:</div></td>
    <td valign="top"><?php echo @stripslashes($idletime); ?></td>

  </tr>
<tr> 
    <td valign="top" nowrap><div align="right">Time of signon:</div></td>
    <td valign="top"><?php echo @stripslashes($signon); ?></td>
  </tr>
<?php 
if(!empty($nickreg)) {
echo"<tr><td valign=\"top\" nowrap><div align=\"right\">Nickname:</div></td>
    <td valign=\"top\">is registered</td>
  </tr>";
}
?>
<?php 
if(!empty($ircop)) {
echo"<tr><td valign=\"top\" nowrap><div align=\"right\">Status:</div></td>
    <td valign=\"top\">User is " . $ircop . "</td>
  </tr>";
}
?>

</table>
<?php
}
else {
echo "<br>";
}
}
?><Br><br><hr><strong>Please send all comments/suggestions/bugs to <A href="mailto:ed@nullnet.net">ed@nullnet.net</a></strong><br><i>2004, AceMiles, Inc. - <a href="http://www.acemiles.com">http://www.acemiles.com</a>.
</BODY>
</HTML>
