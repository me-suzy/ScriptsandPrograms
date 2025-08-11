<?
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>phpSHOUT Version 3 Created By Designanet.co.uk</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function addsmiley(symbol) {
  document.postshout.msg.value += symbol;
  document.postshout.msg.focus();
}

<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=300,height=500');");
}
</script>
<link href="default.css" rel="stylesheet" type="text/css">
</head>

<body class="phpshout_body">
<form name="postshout" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
  <table align="center" class="phpshout_table">
    <tr>
      <td class="phpshout_form"><?
	include "config.php";
	include "functions.php";
	banned_user();
	
	if (isset($_POST["Submit"])) {
		
		// Remove any tabs
		$_POST["name"] = str_replace("\t"," ",$_POST["name"]);
		$_POST["msg"] = str_replace("\t"," ",$_POST["msg"]);

		// Make name and string lower case for bad language filter
		$_POST["name"] = strtolower(stripslashes(trim(htmlspecialchars($_POST["name"]))));
		$_POST["msg"] = strtolower(stripslashes(trim(htmlspecialchars($_POST["msg"]))));

		if (!file_exists("messages.txt")) {
		
			echo "<p class=\"error\">Messages.txt doesn't exsist. Please create a file call messages.txt on your server</p>";
		
		} else if ($_POST["name"] == "name" || $_POST["msg"] == "message" || $_POST["name"] == NULL || $_POST["msg"] == NULL) {
	
			echo "<p class=\"error\">Name & message are required fields. Please enter your name and message.</p>";
	
		} else {
		
			$filename = "messages.txt";
			$handle = fopen($filename,"r");
			$read = file_get_contents($filename);
		
			if ($read != "" || $read != NULL) {
					
					$array = explode("\n", $read);

					if ($array[0] != NULL || $array[0] != "") {
				
					list($name, $msg, $time, $ip) = explode("\t", $array[0]);
										
					$ip = trim($ip);
					
					// Convert timestamp to unix timestamp and get current unix timestamp
					$strtime = strtotime($time);
					$flood_gate_time = $strtime+$floodtime;
					$curtime = time();
					$valid = true;
					}
					
					if ($ip == $_SERVER['REMOTE_ADDR'] && $flood_gate_time > $curtime) {
						echo "<p class=\"error\">You must wait ".$floodtime." seconds before posting again</p>";
					} else {

					writetofile($_POST["name"],$_POST["msg"]);
					
					}
					
			} else {
				writetofile($_POST["name"],$_POST["msg"]);
			}
			
		} // end if file exists
		
	} // end submit

?></td>
    </tr>
    <tr>
      <td class="phpshout_form"><input class="textfields" name="name" type="text" id="name" value="<? echo fillnamevalues("name","name") ?>"></td>
    </tr>
    <tr>
      <td class="phpshout_form"><input class="textfields" name="msg" type="text" id="msg" value="<? echo filltextvalues("msg","message") ?>" maxlength="<? echo $maxchars; ?>"></td>
    </tr>
    <tr>
      <td class="phpshout_form"><input class="buttons" type="submit" name="Submit" value="Send">      </td>
    </tr>
    <tr>
      <td class="phpshout_form"><a href="javascript:addsmiley(' :) ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_smile.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :lol: ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_lol.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :D ');"><img src="<? echo $imagepath; ?>/icon_cheesygrin.gif" width="15" height="15" border="0" class="smilies"></a> <a href="javascript:addsmiley(' :P ');"><img src="<? echo $imagepath; ?>/icon_razz.gif" width="15" height="15" border="0" class="smilies"></a>&nbsp;<a href="javascript:addsmiley(' ;) ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_wink.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :redface: ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_redface.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :o ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_surprised.gif" width="15" height="15"></a><a href="javascript:addsmiley(' :shock: ');"> </a></td>
    </tr>
    <tr>
      <td class="phpshout_form"><a href="javascript:addsmiley(' :shock: ');"><img src="<? echo $imagepath; ?>/icon_eek.gif" width="15" height="15" border="0" class="smilies"></a>&nbsp;<a href="javascript:addsmiley(' :( ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_sad.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :cry: ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_cry.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :roll: ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_rolleyes.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :x ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_mad.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :twisted: ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_twisted.gif" width="15" height="15"></a>&nbsp;<a href="javascript:addsmiley(' :evil: ');"><img class="smilies" src="<? echo $imagepath; ?>/icon_evil.gif" width="15" height="15"></a></td>
    </tr>
    <tr>
      <td class="phpshout_form"><a class="phpshout_link" href="javascript:popUp('oldmsg.php')">Archive</a><br>
      <br></td>
    </tr>
	  	<? 
	
	$filename = "messages.txt";

	if (file_exists($filename)) {
	
	$handle = fopen($filename, "r");
	$read = file_get_contents($filename);
	$array = explode("\n", $read);
	$x=0;
	
	for($i=0; $i<$numofposts; $i++) {
		
		if ($array[$i] != NULL || $array[$i] != "") {
			
			list($name, $msg, $date, $ip) = explode("\t", $array[$i]);
					
			$date = str_replace(" ","/",$date);
			list($year,$month,$day,$time) = explode("/", $date);
			
			// convert text to smilies.
			$msg = smiles($msg);

			// Show date, Yes or No.
			if ($showdate == "1") {
				$title = "title=\"Posted ".$day."/".$month."/".$year." ".$time."\"";
			} else {
				$title = "";
			}
			
				$x++;
				if ( $x % 2 != 0 ) {
					echo "<tr><td ".$title." class=\"phpshout_posts\"><strong>".wordwrap($name,18,"<br>\n",1)." : </strong>".ereg_replace("([^ \/]{22})","\\1<wbr>",$msg)."</td></tr>";
				} else {
					echo "<tr><td ".$title." class=\"phpshout_2nd_posts\"><strong>".wordwrap($name,18,"<br>\n",1)." : </strong>".ereg_replace("([^ \/]{22})","\\1<wbr>",$msg)."</td></tr>";
				} 	
						
		} else {
		
		break;
		
		}
	}
	
	fclose($handle);
	
	}
	
?>
  </table>
</form>
</body>
</html>
<?
ob_end_flush();
?>