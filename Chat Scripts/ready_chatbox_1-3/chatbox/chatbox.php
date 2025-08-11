<?php
/*
Copyright © 2005 WebsiteReady.Net. All Rights Reserved
This file is part of Ready ChatBox.
This script should have been freely downloadable at:
http://www.websiteready.net

Ready ChatBox is distributed in the hopes that it will be useful,
but WITHOUT ANY WARRANTY. Use at your own risk.

You should have received a copy of the GNU General Public License
along with Ready ChatBox; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
You may obtain a copy at http://www.gnu.org/copyleft/gpl.html

The link back to WebsiteReady may not be removed. It helps others to obtain the script.
If you REALLY want to remove it, you may contact WebsiteReady.Net and purchase a copyright removal.

Thanks for using Ready ChatBox!
*/

// Include your settings
include ('settings.php');

// If you  didnt select to include the stylesheet elsewhere
if ( $include_stylesheet =="YES" ){
	// Include the stylesheet
	include ('stylesheet.php');
}

// Connect to the database and then select the database
$con=mysql_connect ($dbServer, $dbuserName, $dbpassword) or die ('Cannot connect to the database.');
$db=mysql_select_db ($dbName);
// Set the default error to no
$error="no";

//****************************************************************************************************
function in_safe ($item) {  // Function takes info and removes stuff to be safe for storing
		$item = nl2br($item);
		$item = strip_tags($item, '<br>');
		$item = htmlentities($item); 
		$item = ltrim($item);
		// Checks if magic quotes is turned on, if it is Stripslashes
   		if ( get_magic_quotes_gpc() ) {
			$item = stripslashes($item);
		}
		// Now we need to add slashes and other stuff with real_escape_string
		if ( !is_numeric($item) ) {
			$item = "'" . mysql_real_escape_string($item) . "'";
		}
	 return $item;
}
//****************************************************************************************************

//****************************************************************************************************
function bb_code($text) { // Parse all of the ubb code and those darn cute smiley faces :)
   $tagArray['b'] = array('open'=>'<b>','close'=>'</b>');
   $tagArray['i'] = array('open'=>'<i>','close'=>'</i>');
   $tagArray['u'] = array('open'=>'<u>','close'=>'</u>');
   $tagArray['url'] = array('open'=>'<a class="name" target="_blank" href="','close'=>'">\\1</a>');
   $tagArray['email'] = array('open'=>'<a class="name" target="_blank" href="mailto:','close'=>'">\\1</a>');
   $tagArray['url=(.*)'] = array('open'=>'<a class="name" target="_blank" href="','close'=>'">\\2</a>');
   $tagArray['email=(.*)'] = array('open'=>'<a class="name" target="_blank" href="mailto:','close'=>'">\\2</a>');
   $tagArray['color=(.*)'] = array('open'=>'<font color="','close'=>'">\\2</font>');

   foreach($tagArray as $tagName=>$replace) {
        $tagEnd=preg_replace('/\W/Ui','',$tagName);
        $text = preg_replace("|\[$tagName\](.*)\[/$tagEnd\]|Ui","$replace[open]\\1$replace[close]",$text);
   }
   
	$smilies = array( // Create the array for the smilies
		// smiley code => smiley filename
		":?:"		=>	"icon_confused.gif",
		":D"		=>	"icon_mrgreen.gif",
		":cool:"	=>	"icon_cool.gif",
		":|:"		=>	"icon_neutral.gif",
		":sad:"		=>	"icon_cry.gif",
		":P"		=>	"icon_razz.gif",
		":wow:"		=>	"icon_eek.gif",
		":red:"		=>	"icon_redface.gif",
		":evil:"	=>	"icon_evil.gif",
		":8"		=>	"icon_rolleyes.gif",
		":lol:"		=>	"icon_lol.gif",
		":)"		=>	"icon_smile.gif",
		":X"		=>	"icon_mad.gif",
		";)" => "icon_wink.gif",
	);
	
	foreach($smilies as $smile_code=>$smile_img) { // Replace the smiley code with the img call
		$text = str_replace("$smile_code", "<img src=\"smilies/$smile_img\" width=\"16\" height=\"16\" border=\"0\" alt=\"\" />", "$text");
	}   
   return $text;
}
//****************************************************************************************************

//****************************************************************************************************
function out_safe ($item) { // Function takes info that was stored and puts it back in form
	$item = stripslashes($item);
	return $item;
}
//****************************************************************************************************


//****************************************************************************************************
function output_message ( $name, $timestamp, $message, $link ) {	
	print "        <tr>\n";
	print "          <td class=\"alt_a\" align=\"left\"> "; 
	if ( !empty($link) ) {
		print '<a class="name" href="'.$link.'" target="_blank">'.$name.':</a>&nbsp;&nbsp;';
	}else{
		print '<span class="name">'.$name.':&nbsp;&nbsp;</span>';
	}
	print "$message";
	print "</td>\n";
	print "        </tr>\n";			   
}
//****************************************************************************************************

//****************************************************************************************************
function check_flood ($ip,$flood_time) {  // Function takes a ip and sees if it has posted in the pas x seconds

	$in_timestamp	= mktime(); // Get the current time
	$in_ip			= $_SERVER["REMOTE_ADDR"]; // Get the user's IP Address
	$flood = $in_timestamp - $flood_time;
	
	// See if their IP is in the table
	$query .= "SELECT * FROM chatbox_data";
	$query .= " WHERE ip = '$in_ip'";
	$query .= " && timestamp > '$flood'";
	$query .= " ORDER BY timestamp DESC";
	$query .= " limit 1";
	$res=@mysql_query($query)
	if( mysql_num_rows($res) ) {
		return false;
	}

}
//****************************************************************************************************

//****************************************************************************************************
function bad_filter ($item, $badwords) {  // Function takes a string and filters it

	foreach( $badwords as $naughty=>$nice) { // Replace the bad word with the good one
		$item = str_replace("$naughty", "$nice", "$item");
	}   
   return $item;
	
}
//****************************************************************************************************


if ( $sb_submit=="Shout" ) { // If they submitted the form

// Get all the information needed
$val_name		= $_POST["sb_name"];
$val_link		= $_POST["sb_link"];
$val_message	= $_POST["sb_message"];

$val_timestamp	= mktime(); // Get the current time
$val_ip			= $_SERVER["REMOTE_ADDR"]; // Get the user's IP Address

// Check if they at least filled in something longer than one character
if ( strlen($val_name) <= 1) { $error="yes"; $log[] = "Name Required"; }
if ( strlen($val_message) <= 1) { $error="yes"; $log[] = "Message Required"; }

// Check if the values were the default ones (ie - they didn't fill anything out)
if ( $val_name=="Name") { $error="yes"; $log[] = "Name Required"; }
if ( $val_message=="Your Message") { $error="yes"; $log[] = "Message Required"; }
if ( $val_link=="Website/Email") { $val_link=""; }

// Time to remove that nasty language some people like to include...weirdos.
// If you specified you wanted to filter then do it
if ( $filter_bad_words ) {
	$val_name = bad_filter($val_name, $badwords);
	$val_message = bad_filter($val_message, $badwords);
}


// Make safe everything that they submitted is good to go
$val_name		= in_safe($val_name);
$val_message	= in_safe($val_message);
// Allow breaks that we took out in the in_safe funtion
$val_message	= str_replace( "&lt;br /&gt;", "<br />", "$val_message"); 
$val_link		= in_safe($val_link);

// If they have flood protection on
if ( $flood_time > 0 ){
	// call the function
	if ( !check_flood($val_ip,$flood_time){
		// Reeport the error
		$error="yes"; $log[] = "Slow Down";
	}
}




// If there are no errors, submit the data into the chatbox
if ( $error=="no" ) {
// Create the SQL Query
$sql="INSERT INTO chatbox_data(name,message,link,timestamp,ip) VALUES($val_name,$val_message,$val_link,'$val_timestamp','$val_ip')";
// Run the SQL QUERY
$res=mysql_query($sql)or die("Error entering in message");
// Log that it was successfull
$log[] = "Message Submited";
}


} // End if they submited
?>


<script language="JavaScript" type="text/javascript">
<!--
	function ClearField(field){
		if ( field.defaultValue==field.value ) {
			field.value = ""
		}
	}
	
	
	function PopUp(url,width,height){
		window.open(url, 'popup', 'width=' + width + ',height=' + height + ',toolbar=0,scrollbars=no,location=0,statusbar=1,menubar=0,resizable=1');
	}
-->
</script>


<form name="chatbox" id="chatbox" method="post" action="index.php">
<table width="150" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="topic">Messages:</td>
  </tr>
  <tr>
    <td align="center" class="cell_bg">
      <table width="148" border="0" cellspacing="0" cellpadding="0">
		<?php
			// Form the SQL Query to fetch the messages from the chatbox dtat		
			$query .= "SELECT * FROM chatbox_data";
			//$query .= " WHERE timestamp < '$TimeLimit'";
			$query .= " ORDER BY timestamp DESC";
			$query .= " limit $CountLimit";
			// Run the SQL Query
			$res=@mysql_query($query);
			
			// If there are any messages...
			if( mysql_num_rows($res) ) {
				// Get the messages
				while($obj=mysql_fetch_object($res)) {
					$id=$obj->id;
					$name=$obj->name;
					$timestamp=$obj->timestamp;
					$message=$obj->message;
					$link=$obj->link;
					$ip=$obj->ip;
					
					// Take off slashes that may have been added earlier
					$name=out_safe($name);
					$link=out_safe($link);					
					$message=out_safe($message);
					$message=bb_code($message);					

					
					// Format the timestamp into a nice, human readable date
					$date=date("F d, Y", $timestamp);
					// Call the function to output the message
					output_message( $name, $timestamp, $message, $link );
				} // End fetch messages from database
			
			// Else there were no messages	
			}else{
				print '	<tr><td class="alt_a"><span class="name">No messages posted yet!</span></td></tr>';
			}
		?>
		
			

      </table>
    </td>
  </tr>
  <tr>
    <td class="topic">Shout It!</td>
  </tr>
<?php
	if ( !empty($log[0]) ) { // If we made a message for them, display it in a new row
			print "  <tr>\n";
			print '    <td align="center" class="cell_bg"><span class="log">';
			print "* $log[0]";
			print "</span></td>\n";
			print "  </tr>\n\n"; 
		} 
?>	
  
  <tr>
    <td align="center" class="cell_bg">
      <input name="sb_name" type="text" class="input" value="Name" size="23" onfocus="ClearField(sb_name);" />
    </td>
  </tr>
  <tr>
    <td align="center" class="cell_bg">
      <input name="sb_link" type="text" class="input" value="Website/Email" size="23" onfocus="ClearField(sb_link);"/>
    </td>
  </tr>
    <tr>
    <td align="center" class="cell_bg"><a class="href1" href='javascript:PopUp("smilies.php",400,158);'>Smilies || Extras</a> </td>
  </tr>
  <tr>
    <td align="center" class="cell_bg">
      <textarea name="sb_message" cols="20" rows="3" class="input" onfocus="ClearField(sb_message);">Your Message</textarea>
</td>
  </tr>
  <tr>
    <td align="center" class="cell_bg">
      <input name="sb_submit" type="submit" class="input" value="Shout" />
      <input name="sb_refresh" type="submit" class="input" value="Refresh" />
    </td>
  </tr>
  <tr>
    <td class="cell_bg" height="3"></td>
  </tr>   
  <tr>
    <td align="center" class="cell_bg"><a class="href1" <? echo base64_decode('PGEgY2xhc3M9ImhyZWYxIiBocmVmPSdodHRwOi8vd3d3LndlYnNpdGVyZWFkeS5uZXQnPldlYnNpdGVSZWFkeTwvYT4=') ?></a></td>
  </tr>  
  <tr>
    <td class="cell_bg" height="3"></td>
  </tr>  
</table>
</form>
