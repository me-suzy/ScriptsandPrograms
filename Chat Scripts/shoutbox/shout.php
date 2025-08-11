<?
/*
 +-------------------------------------------------------------------+
 |                      S H O U T B O X   (v1.5)                     |
 |                          P a r t   II                             |
 |                                                                   |
 | Copyright Gerd Tentler               www.gerd-tentler.de/tools    |
 | Created: Jun. 1, 2004                Last modified: Nov. 30, 2005 |
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
// Cookies
//========================================================================================================

  if(isset($Name)) {
    $shouter = $Name;
    setcookie('shouter', $shouter);
  }
  if(isset($EMail)) {
    $shouter_mail = $EMail;
    setcookie('shouter_mail', $shouter_mail);
  }

//========================================================================================================
// Includes
//========================================================================================================

  include('config.inc.php');
  include('smilies.inc');

//========================================================================================================
// Set variables, if they are not registered globally; needs PHP 4.1.0 or higher
//========================================================================================================

  if(!isset($Name)) $Name = $_REQUEST['Name'];
  if(!isset($EMail)) $EMail = $_REQUEST['EMail'];
  if(!isset($Text)) $Text = $_REQUEST['Text'];

//========================================================================================================
// Functions
//========================================================================================================

  function db_connect() {
    global $db_name, $db_server, $db_user, $db_pass;

    $status = true;
    if(!@mysql_connect($db_server, $db_user, $db_pass)) {
      echo '<font color=red>' . mysql_errno() . ': ' . mysql_error() . '</font><br>';
      $status = false;
    }
    else if(!@mysql_select_db($db_name)) {
      echo '<font color=red>' . mysql_errno() . ': ' . mysql_error() . '</font><br>';
      $status = false;
    }
    return $status;
  }

  function timeStamp($ts) {
    return substr($ts, 0, 4) . '-' . substr($ts, 4, 2) . '-' . substr($ts, 6, 2) . ' ' . substr($ts, 8, 2) . ':' . substr($ts, 10, 2) . ':' . substr($ts, 12);
  }

  function checkRepeats($str) {
    $newstr = substr($str, 0, 3);

    for($i = 3; $i < strlen($str); $i++) {
      if($str[$i] == $str[$i-1] && $str[$i] == $str[$i-2] && $str[$i] == $str[$i-3]) continue;
      else $newstr .= $str[$i];
    }
    return $newstr;
  }

  function format($str, $sm_code = '', $sm_img = '') {
    global $allowHTML;

    if(!$allowHTML) {
      $str = str_replace('>', '&gt;', $str);
      $str = str_replace('<', '&lt;', $str);
    }
    $str = eregi_replace('http://', '', $str);
    $str = checkRepeats($str);
    if($sm_code && $sm_img) $str = str_replace($sm_code, $sm_img, $str);

    return $str;
  }

//========================================================================================================
// Main
//========================================================================================================

  if(db_connect()) {
    $error = '';

    header('Cache-control: private, no-cache, must-revalidate');
    header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');
    header('Date: Sat, 01 Jan 2000 00:00:00 GMT');
    header('Pragma: no-cache');
?>
    <html>
    <head>
    <meta http-equiv="refresh" content="<? echo $boxRefresh; ?>; URL=<? echo basename($PHP_SELF); ?>">
    <title>Output</title>
<?
    $messageOrder = strtoupper($messageOrder);
    if($messageOrder != 'ASC' && $messageOrder != 'DESC') $messageOrder = 'DESC';

    if($messageOrder == 'ASC') {
?>
      <script language="JavaScript"> <!--
      function autoscroll() {
        if(document.body && document.body.offsetHeight) window.scrollBy(0, document.body.offsetHeight);
        else if(window.innerHeight) window.scrollBy(0, window.innerHeight);
        else if(document.height) window.scrollBy(0, document.height);
      }
      window.onload = autoscroll;
      //--> </script>
<?
    }
?>
    <link rel="stylesheet" href="shoutbox.css" type="text/css">
    </head>
    <body marginwidth=0 marginheight=0 topmargin=0 leftmargin=0>
<?
    if($Text) {
      $tstamp = date('YmdHis');
      $sql = "INSERT INTO $tbl_name ($fld_timestamp, $fld_name, $fld_email, $fld_text) ";
      $sql .= "VALUES ('$tstamp', '$Name', '$EMail', '$Text')";
      if(!mysql_query($sql)) $error .= mysql_error() . '<br>';

      $sql = "SELECT $fld_id FROM $tbl_name ORDER BY $fld_timestamp DESC LIMIT 1";
      $id = mysql_result(mysql_query($sql), $fld_id) - $boxEntries;
      if($id > 0) {
        $sql = "DELETE FROM $tbl_name WHERE $fld_id<=$id";
        if(!mysql_query($sql)) $error .= mysql_error() . '<br>';
      }
    }
?>
    <table border=0 cellspacing=0 cellpadding=2 width=100%><tr>
    <td>
<?
    if($error) echo "<font color=red>$error</font><br>";
?>
    <table border=0 cellspacing=0 cellpadding=0 width=100%>
<?
    $sm_code = $sm_img = array();

    while(list($code, $img) = each($sm)) {
      $sm_code[] = $code;
      $sm_img[] = "<img src='smilies/$img' width=15 height=15 align=top>";
    }

    $sql = "SELECT * FROM $tbl_name ORDER BY $fld_timestamp $messageOrder LIMIT $boxEntries";
    $result = mysql_query($sql);

    while($row = mysql_fetch_array($result)) {
      $tstamp = timeStamp($row[$fld_timestamp]);
      $name = $row[$fld_name] ? format($row[$fld_name]) : '???';
      $email = $row[$fld_email];
      $text = format($row[$fld_text], $sm_code, $sm_img);
      $bgcolor = ($bgcolor != '#FFFFFF') ? '#FFFFFF' : '#F6F6F6';
?>
      <tr bgcolor=<? echo $bgcolor; ?>>
      <td class="cssSmall" align=right><font color=#A0A0A0><? echo $tstamp; ?></font></td>
      </tr><tr bgcolor=<? echo $bgcolor; ?>>
      <td class="cssShoutText"><? if($email) echo '<a href="mailto:' . $email . '">'; ?>
      <b><? echo $name; ?>:</b><? if($email) echo '</a>'; ?> <? echo $text; ?></td>
      </tr>
<?
    }
    mysql_close();
?>
    </table>
    </td>
    </tr></table>
    </body>
    </html>
<?
  }
?>
