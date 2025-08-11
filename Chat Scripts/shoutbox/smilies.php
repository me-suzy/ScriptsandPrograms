<?
/*
 +-------------------------------------------------------------------+
 |                      S H O U T B O X   (v1.5)                     |
 |                          P a r t   III                            |
 |                                                                   |
 | Copyright Gerd Tentler               www.gerd-tentler.de/tools    |
 | Created: Jun. 1, 2004                Last modified: Jul. 21, 2005 |
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

  include('config.inc.php');
  if(!isset($language)) $language = 'en';
  include("lang_$language.inc");
  include('smilies.inc');

//========================================================================================================
// Main
//========================================================================================================
?>
<html>
<head>
<title><? echo $msg['smilies']; ?></title>
<script language="JavaScript"> <!--
function insert(txt) {
  if(window.opener) {
    el = window.opener.document.fShout.Text;
    if(!el.value) el.value = txt + ' ';
    else el.value += ((el.value.charAt(el.value.length-1) == ' ') ? '' : ' ') + txt + ' ';
    self.close();
  }
}
//--> </script>
<link rel="stylesheet" href="shoutbox.css" type="text/css">
</head>
<body leftmargin=5 topmargin=5 marginwidth=5 marginheight=5>
<table border=0 cellspacing=0 cellpadding=4 align=center>
<?
  while(list($code, $img) = each($sm)) {
    if($img != $img_old) {
      $bgcolor = ($bgcolor != '#E0E0E0') ? '#E0E0E0' : '#F0F0F0';
?>
      <tr bgcolor=<? echo $bgcolor; ?>>
      <td><a href="javascript:insert('<? echo $code; ?>')">
      <img src="smilies/<? echo $img; ?>" border=0 width=15 height=15></a></td>
      <td class="cssShoutText"><b><? echo $code; ?></b></td>
      </tr>
<?
    }
    $img_old = $img;
  }
?>
</table>
</body>
</html>
