<?
/*
 +-------------------------------------------------------------------+
 |                      S H O U T B O X   (v1.5)                     |
 |                          P a r t   I                              |
 |                                                                   |
 | Copyright Gerd Tentler                www.gerd-tentler.de/tools   |
 | Created: Jun. 1, 2004                 Last modified: Aug. 4, 2005 |
 +-------------------------------------------------------------------+
 | This program may be used and hosted free of charge by anyone for  |
 | personal purpose as long as this copyright notice remains intact. |
 |                                                                   |
 | Obtain permission before selling the code for this program or     |
 | hosting this software on a commercial website or redistributing   |
 | this software over the Internet or in any other medium. In all    |
 | cases copyright must remain intact.                               |
 +-------------------------------------------------------------------+
*/
  error_reporting(E_WARNING);

//========================================================================================================
// Includes
//========================================================================================================

  $this_dir = str_replace('\\', '/', dirname(__FILE__));

  include("$this_dir/config.inc.php");
  if(!isset($language)) $language = 'en';
  include("$this_dir/lang_$language.inc");
  include("$this_dir/smilies.inc");

//========================================================================================================
// Main
//========================================================================================================

  $input_width = round($boxWidth / 10);

  if($boxFolder && !ereg('/$', $boxFolder)) $boxFolder .= '/';
?>
<script language="JavaScript"> <!--
var shout_popup = 0;

function newWindow(url, w, h, x, y, scroll, menu, tool, resizable) {
  if(shout_popup && !shout_popup.closed) shout_popup.close();
  if(!x && !y) {
    x = Math.round((screen.width - w) / 2);
    y = Math.round((screen.height - h) / 2);
  }
  shout_popup = window.open(url, "shout_popup", "width=" + w + ",height=" + h +
                            ",left=" + x + ",top=" + y + ",scrollbars=" + scroll +
                            ",menubar=" + menu + ",toolbar=" + tool + ",resizable=" + resizable);
  shout_popup.focus();
}

function refreshBox() {
  document.fShout.Text.value = '';
  document.fShout.submit();
  setTimeout("document.fShout.Refresh.disabled=false", 1000);
}

function shoutIt() {
  document.fShout.submit();
  setTimeout("document.fShout.Text.value=''", 1000);
  setTimeout("document.fShout.Shout.disabled=false", 1000);
}
//--> </script>
<link rel="stylesheet" href="<? echo $boxFolder; ?>shoutbox.css" type="text/css">
<table border=0 cellspacing=0 cellpadding=0 align=center><tr>
<td colspan=2 align=center>
<iframe name="ShoutBox" src="<? echo $boxFolder; ?>shout.php" class="cssShoutBox" width=<? echo $boxWidth; ?> height=<? echo $boxHeight; ?> frameborder=0></iframe>
</td>
</tr>
<form name="fShout" action="<? echo $boxFolder; ?>shout.php" target="ShoutBox" method=post>
<tr>
<td class="cssShoutText"><? echo $msg['name']; ?>:</td>
<td align=right><input type=text name="Name" size=<? echo $input_width; ?> maxlength=20 class="cssShoutForm" value="<? echo $shouter; ?>"></td>
</tr><tr>
<td class="cssShoutText"><? echo $msg['eMail']; ?>:</td>
<td align=right><input type=text name="EMail" size=<? echo $input_width; ?> maxlength=75 class="cssShoutForm" value="<? echo $shouter_mail; ?>"></td>
</tr><tr>
<td colspan=2 align=center>
  <table border=0 cellspacing=0 cellpadding=0 width=100%><tr>
  <td class="cssShoutText"><? echo $msg['message']; ?>:</td>
  <td align=right><input type=button value="<? echo $msg['smilies']; ?>" class="cssShoutButton" onClick="newWindow('<? echo $boxFolder; ?>smilies.php', 130, 300, 0, 0, 1)"></td>
  </tr></table>
  <textarea name="Text" cols=22 rows=3 style="width:100%" wrap=virtual class="cssShoutForm"></textarea>
  <table border=0 cellspacing=0 cellpadding=0 width=100%><tr>
  <td><input type=button name="Refresh" value="<? echo $msg['refresh']; ?>" class="cssShoutButton" onClick="this.disabled=true; refreshBox()"></td>
  <td align=right><input type=button name="Shout" value="<? echo $msg['shout']; ?>" class="cssShoutButton" onClick="this.disabled=true; shoutIt()"></td>
  </tr></table>
</td>
</tr>
</form>
</table>
