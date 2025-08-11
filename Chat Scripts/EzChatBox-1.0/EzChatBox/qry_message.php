<?php require("config.php"); ?>
<?php
//open ban file
$banned_array = file("$EZChat_file_ban");

//mask function
function makeMask($ip) {
    // remember to escape the . so PHP doesn't think it's a concatenation
    $ip_array = explode("\.", $ip);
    $ip_mask = "$ip_array[0]\.$ip_array[1]\.$ip_array[2]";
    trim($ip_mask);
	return $ip_mask;
}

//perform check
for ($ban_counter = 0; $ban_counter < 100; $ban_counter++) 
{
    if (trim($banned_array[$ban_counter]) == trim($REMOTE_ADDR) ) 
	{
        header("Location: $EZChat_ban_relocate");
		exit; 
    }
}
//print("<font color=\"red\" face=\"arial\" align=\"center\"> You have been banned from this chat</font>");

//add cookie to store name
setcookie("name_chat", "", time()-60000);

if(isset($HTTP_COOKIE_VARS["name_chat"]))
	{
	setcookie("name_chat","$name");
	}
else
	{
	setcookie("name_chat","$name");
	}
	
//check for malicious code in message
//Clearmalicious($message);
$message = htmlspecialchars($message);

$message = str_replace("&gt;", ">", $message);
$message = str_replace("&lt;b>", "<b>", $message);
$message = str_replace("&lt;/b>", "</b>", $message);
$message = str_replace("&lt;i>", "<i>", $message);
$message = str_replace("&lt;/i>", "</i>", $message);
$message = str_replace("&lt;font ", "<font ", $message);
$message = str_replace("&lt;/font>", "</font>", $message);
// Emoticons replacement
$message = str_replace(":)","<img src=\"$EZChat_location"."/Images/smilies/smile.gif\" alt=\"smile\" />",$message);
$message = str_replace(":8","<img src=\"$EZChat_location"."/Images/smilies/smile-2.gif\" alt=\"smile\" />",$message);
$message = str_replace(":wacko:","<img src=\"$EZChat_location"."/Images/smilies/wacko.gif\" alt=\"mad\" />",$message);
$message = str_replace(":p","<img src=\"$EZChat_location"."/Images/smilies/cheesy.gif\" alt=\"tongue\" />",$message);
$message = str_replace(":suspicious:","<img src=\"$EZChat_location"."/Images/smilies/suspicious.gif\" alt=\"suspicious\" />",$message);
$message = str_replace(":hehe:","<img src=\"$EZChat_location"."/Images/smilies/wink.gif\" alt=\"lol\" />",$message);
$message = str_replace(":worried:","<img src=\"$EZChat_location"."/Images/smilies/worried.gif\" alt=\"worried\" />",$message);
$message = str_replace(":eek:","<img src=\"$EZChat_location"."/Images/smilies/weird.gif\" alt=\"eek\" />",$message);
$message = str_replace(":(","<img src=\"$EZChat_location"."/Images/smilies/sad.gif\" alt=\"sad\" />",$message);
$message = str_replace(":sad:","<img src=\"$EZChat_location"."/Images/smilies/sad-2.gif\" alt=\"sad\" />",$message);
$message = str_replace(":x","<img src=\"$EZChat_location"."/Images/smilies/sick.gif\" alt=\" \" />",$message);
$message = str_replace(":rolleyes:","<img src=\"$EZChat_location"."/Images/smilies/rolleyes.gif\" alt=\"rolleyes\" />",$message);
$message = str_replace(":|","<img src=\"$EZChat_location"."/Images/smilies/oh.gif\" alt=\"oh\" />",$message);
$message = str_replace(":o","<img src=\"$EZChat_location"."/Images/smilies/amazed.gif\" alt=\"amazed\" />",$message);
$message = str_replace("8()","<img src=\"$EZChat_location"."/Images/smilies/nuts.gif\" alt=\"nuts\" />",$message);
$message = str_replace("|)","<img src=\"$EZChat_location"."/Images/smilies/notrust.gif\" alt=\"dont trust\" />",$message);
$message = str_replace(":mad:","<img src=\"$EZChat_location"."/Images/smilies/mad.gif\" alt=\"mad\" />",$message);
$message = str_replace(":lol:","<img src=\"$EZChat_location"."/Images/smilies/laugh.gif\" alt=\"lol\" />",$message);
$message = str_replace(":huh:","<img src=\"$EZChat_location"."/Images/smilies/huh.gif\" alt=\"confused\" />",$message);
$message = str_replace(":$","<img src=\"$EZChat_location"."/Images/smilies/embarrest.gif\" alt=\"embaresses\" />",$message);
$message = str_replace(":cry:","<img src=\"$EZChat_location"."/Images/smilies/crying.gif\" alt=\"cry\" />",$message);
$message = str_replace("(H)","<img src=\"$EZChat_location"."/Images/smilies/cool.gif\" alt=\"cool\" />",$message);
$message = str_replace(":s","<img src=\"$EZChat_location"."/Images/smilies/confused.gif\" alt=\"confused\" />",$message);
$message = str_replace(":D","<img src=\"$EZChat_location"."/Images/smilies/biggrin.gif\" alt=\"big grin\" />",$message);
$message = str_replace("(6)","<img src=\"$EZChat_location"."/Images/smilies/evil.gif\" alt=\"evil\" />",$message);
$message = str_replace(":5queeze:","<img src=\"$EZChat_location"."/Images/smilies/push.gif\" alt=\"evil\" />",$message);
$message = str_replace(":relax:","<img src=\"$EZChat_location"."/Images/smilies/noworry.gif\" alt=\"relax\" />",$message);

//trim string
$string = $EZChat_stringLength;

if (strlen($message) > $string) 
	{
	$message = substr($message, 0, $string);
	$str_position = strrpos($message, ' ');
	$message = substr($message, 0, $str_position) . "  <b>String too long</b>";
	}

// check for malicious code in the name
//Clearmalicious($name);
$name = htmlspecialchars($name);

$name = str_replace("&gt;", ">", $name);
$name = str_replace("&lt;b>", "<b>", $name);
$name = str_replace("&lt;/b>", "</b>", $name);
$name = str_replace("&lt;i>", "<i>", $name);
$name = str_replace("&lt;/i>", "</i>", $name);
$name = str_replace("&lt;font ", "<font ", $name);
$name = str_replace("&lt;/font>", "</font>", $name);

// Emoticons replacement
$message = str_replace(":)","<img src=\"$EZChat_location"."/Images/smilies/smile.gif\" alt=\"smile\" />",$message);
$message = str_replace(":8","<img src=\"$EZChat_location"."/Images/smilies/smile-2.gif\" alt=\"smile\" />",$message);
$message = str_replace(":wacko:","<img src=\"$EZChat_location"."/Images/smilies/wacko.gif\" alt=\"mad\" />",$message);
$message = str_replace(":p","<img src=\"$EZChat_location"."/Images/smilies/cheesy.gif\" alt=\"tongue\" />",$message);
$message = str_replace(":suspicious:","<img src=\"$EZChat_location"."/Images/smilies/suspicious.gif\" alt=\"suspicious\" />",$message);
$message = str_replace(":hehe:","<img src=\"$EZChat_location"."/Images/smilies/wink.gif\" alt=\"lol\" />",$message);
$message = str_replace(":worried:","<img src=\"$EZChat_location"."/Images/smilies/worried.gif\" alt=\"worried\" />",$message);
$message = str_replace(":eek:","<img src=\"$EZChat_location"."/Images/smilies/weird.gif\" alt=\"eek\" />",$message);
$message = str_replace(":(","<img src=\"$EZChat_location"."/Images/smilies/sad.gif\" alt=\"sad\" />",$message);
$message = str_replace(":sad:","<img src=\"$EZChat_location"."/Images/smilies/sad-2.gif\" alt=\"sad\" />",$message);
$message = str_replace(":x","<img src=\"$EZChat_location"."/Images/smilies/sick.gif\" alt=\" \" />",$message);
$message = str_replace(":rolleyes:","<img src=\"$EZChat_location"."/Images/smilies/rolleyes.gif\" alt=\"rolleyes\" />",$message);
$message = str_replace(":|","<img src=\"$EZChat_location"."/Images/smilies/oh.gif\" alt=\"oh\" />",$message);
$message = str_replace(":o","<img src=\"$EZChat_location"."/Images/smilies/amazed.gif\" alt=\"amazed\" />",$message);
$message = str_replace("8()","<img src=\"$EZChat_location"."/Images/smilies/nuts.gif\" alt=\"nuts\" />",$message);
$message = str_replace("|)","<img src=\"$EZChat_location"."/Images/smilies/notrust.gif\" alt=\"dont trust\" />",$message);
$message = str_replace(":mad:","<img src=\"$EZChat_location"."/Images/smilies/mad.gif\" alt=\"mad\" />",$message);
$message = str_replace(":lol:","<img src=\"$EZChat_location"."/Images/smilies/laugh.gif\" alt=\"lol\" />",$message);
$message = str_replace(":huh:","<img src=\"$EZChat_location"."/Images/smilies/huh.gif\" alt=\"confused\" />",$message);
$message = str_replace(":$","<img src=\"$EZChat_location"."/Images/smilies/embarrest.gif\" alt=\"embaresses\" />",$message);
$message = str_replace(":cry:","<img src=\"$EZChat_location"."/Images/smilies/crying.gif\" alt=\"cry\" />",$message);
$message = str_replace("(H)","<img src=\"$EZChat_location"."/Images/smilies/cool.gif\" alt=\"cool\" />",$message);
$message = str_replace(":s","<img src=\"$EZChat_location"."/Images/smilies/confused.gif\" alt=\"confused\" />",$message);
$message = str_replace(":D","<img src=\"$EZChat_location"."/Images/smilies/biggrin.gif\" alt=\"big grin\" />",$message);
$message = str_replace("(6)","<img src=\"$EZChat_location"."/Images/smilies/evil.gif\" alt=\"evil\" />",$message);
$message = str_replace(":5queeze:","<img src=\"$EZChat_location"."/Images/smilies/push.gif\" alt=\"evil\" />",$message);
$message = str_replace(":relax:","<img src=\"$EZChat_location"."/Images/smilies/noworry.gif\" alt=\"relax\" />",$message);

//store the complete message file

$ip_header = "<body bgcolor=\"#eeeeee\" text=\"#000000\"><table border=\"0\" width=\"100%\"><tr><td>Name</td><td>IP Address</td><td>Message</td><td>Ban</td></tr>\n";
$ip_footer = "";
$new_ip = "<tr><td width=\"15%\">$name</td><td width=\"20%\">$REMOTE_ADDR</td><td width=\"*\">$message</td><td width=\"80\" valign=\"top\"><a href=\"qry_ban.php?ip=$REMOTE_ADDR\"><img src=\"Images/Ban-IP-Button.jpg\" border=\"0\" width=\"79\" height=\"22\"></a></td></tr>\n";

$ip_array = file("$EZChat_file_ips");
for ($ip_counter = 1; $ip_counter < 100; $ip_counter++) 
    $old_ips.= $ip_array[$ip_counter];

// Opens file for writing and truncates file length to zero.
if($name AND $message)
	{
	$ip_file = fopen("$EZChat_file_ips", "w");


/*-----------FOURTH UPDATE THE messages.htm-----------*/
// write file header...

	fputs($ip_file, $ip_header);

// ... new line...
// (stripSlashes because we don't want all
// our escape characters appearing in the
// message file)
	fputs($ip_file, stripslashes($new_ip));

// ... old lines ...
	fputs($ip_file, $old_ips);
	
// Footer
	fputs($ip_file, $ip_footer);

// Close the file when you're done. Don't forget to wash your hands
	fclose($ip_file);
	}

/*-----------FIRST GET THE OLD MESSAGES FROM messages.htm-----------*/
// Read file into an array
$message_array = file("$EZChat_file_content");

// Compile the string
for ($counter = 1; $counter < 10; $counter++) {/*INSTEAD OF 20 WRITE SOMETHING ELSE, SAY 30*/
    $old_messages .= $message_array[$counter];
}

/*-----------SECOND GET AND MODIFY THE NEW MESSAGE-----------*/
//ADD TIME
$time1 = date("H");
$time1 = time1 + $EZChat_timeChange;

$time = date("H:i",mktime($time1));
$new_message = "<font class=\"ez_name\">$name </font>$link_html<font class=\"ez_time\"> ($time) :</font><font class=\"ez_message\"> $message</font><br>\n";


/*-----------THIRD MAKE THE HEADER AND THE FOOTER-----------*/
// It's important that there are no newline
// characters except at the end of the string.
// This keeps all the headers together.
$header = "\n";

$footer = "<p align=\"center\">"."</p></body></html>";

// Opens file for writing and truncates file length to zero.
if($name AND $message)
	{
	$open_file = fopen("$EZChat_file_content", "w");

/*-----------FOURTH UPDATE THE messages.htm-----------*/
// write file header...


	fputs($open_file, $header);

// ... new line...
// (stripSlashes because we don't want all
// our escape characters appearing in the
// message file)
	fputs($open_file, stripslashes($new_message));

// ... old lines ...
	fputs($open_file, $old_messages);

// Close the file when you're done. Don't forget to wash your hands
	fclose($open_file);
	}

?>
<html>
<head>
<title><?php echo $EZChat_up_title; ?></title>
<meta http-equiv="refresh" content="<?php echo $EZChat_uptime; ?>;URL=<?php echo $_SERVER['HTTP_REFERER'] ; ?>">
<link href="ez.css" rel="stylesheet" type="text/css">

</head>

<body>
<div id="chatbox" align="center">
<table vspace="5" width="178">
  <tr> 
    <td height="70" width="100%" align="center"><img src="Images/<?php echo $EZChat_image; ?>" alt="EzChatBox Logo"></td>
  </tr>
  <tr>
  	<td height="100" align="center" valign="middle"><span class="style1">Uploading Data&nbsp;&nbsp;....</span></td>
  </tr>
</table>
</div>
</body>
</html>