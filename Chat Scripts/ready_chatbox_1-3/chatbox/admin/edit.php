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

include('inc_sessioncheck.php');
include('inc_template.php'); 
template_header();

// Connect to the database and then select the database
$con=mysql_connect ($dbServer, $dbuserName, $dbpassword) or die ('Cannot connect to the database.');
$db=mysql_select_db ($dbName);


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
   $tagArray['url'] = array('open'=>'<a class="link_b" target="_blank" href="','close'=>'">\\1</a>');
   $tagArray['email'] = array('open'=>'<a class="link_b" target="_blank" href="mailto:','close'=>'">\\1</a>');
   $tagArray['url=(.*)'] = array('open'=>'<a class="link_b" target="_blank" href="','close'=>'">\\2</a>');
   $tagArray['email=(.*)'] = array('open'=>'<a class="link_b" target="_blank" href="mailto:','close'=>'">\\2</a>');
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
		$text = str_replace("$smile_code", "<img src=\"../smilies/$smile_img\" width=\"16\" height=\"16\" border=\"0\" alt=\"\" />", "$text");
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
function output_message ( $name, $timestamp, $message, $link, $id ) {	
	print "  <tr> \n";
	print "    <td height=\"20\" align=\"left\" style=\"border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: #333333;\"> \n";
	if ( !empty($link) ) {
		print '<a class="link_b" href="'.$link.'" target="_blank">'.$name.':</a>&nbsp;&nbsp;';
	}else{
		print '<span class="link_b">'.$name.':&nbsp;&nbsp;</span>';
	}
	print "$message";
	print "	</td> \n";
	print "	<td align=\"left\" style=\"border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: #333333;\"><a class=\"link_b\" href=\"edit.php?edit_id=$id\">EDIT</a></td> \n";
	print "	<td align=\"left\" style=\"border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: #333333;\"><a class=\"link_b\" href=\"edit.php?delete_id=$id\">DELETE</a></td> \n";
	print "  </tr> \n";	
				   
}



//######################################################################################################

// If there was a call to delete a message
if ( is_numeric($delete_id) ){

	// Get the id of the message to edit, and filter it
	$in_delete = mysql_real_escape_string($_GET["delete_id"]);

	// Form the SQL Query to delete the messages from the chatbox dtat		

	$query = "DELETE FROM chatbox_data";
	$query .= " WHERE id = '$in_delete'";
	$query .= " ORDER BY timestamp DESC";
	$query .= " limit 1";
	// Run the SQL Query
	$result=@mysql_query($query);
	$affected_rows= mysql_affected_rows();
	if( $affected_rows > 0) {
		$msg_log .= "The message was successfully deleted! <br /> \n";
	}else{
		$msg_log .= "The message could not be deleted! <br /> \n";
	}

// End if there was a call to delete a message
}

//######################################################################################################


// If there was a call to edit a message
if ( is_numeric($edit_id) ){

	// Get the id of the message to edit, and filter it
	$in_edit = mysql_real_escape_string($_GET["edit_id"]);

	// Form the SQL Query to delete the messages from the chatbox dtat		

	$query = "SELECT * FROM chatbox_data";
	$query .= " WHERE id = '$in_edit'";
	$query .= " ORDER BY timestamp DESC";
	$query .= " limit 1";
	// Run the SQL Query
	$res=mysql_query($query);
			
	// If there are any messages...
	if( mysql_num_rows($res) ) {
		$edit_exists=1;
		// Get the messages
		while($obj=mysql_fetch_object($res)) {
			$edit_name=$obj->name;
			$edit_message=$obj->message;
			$edit_link=$obj->link;
					
			// Take off slashes that may have been added earlier
			$edit_name=out_safe($edit_name);
			$edit_link=out_safe($edit_link);					
			$edit_message=out_safe($edit_message);	
		} // end while
	}// end if	
				
	if ( $edit_exists==1 ){ // If the message they want to edit exists
?>
<form name="chatbox" id="chatbox" method="post" action="edit.php">
<table width="455" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>Name:</td>
    <td>
      <input name="sb_name" type="text"  value="<? print "$edit_name"; ?>">
    </td>
  </tr>
  <tr>
    <td>Link:</td>
    <td>
      <input name="sb_link" type="text"  value="<? print "$edit_link"; ?>">
    </td>
  </tr>
  <tr>
    <td>Message:</td>
    <td>
      <textarea name="sb_message" cols="40"><? print "$edit_message"; ?></textarea>
    </td>
  </tr>
  <tr>
    <td><a class="link_b" href='javascript:PopUp("../smilies.php",400,158);'>Extras</a></td>
    <td>
	  <input name="hidden_edit_id" type="hidden"  value="<? print "$in_edit"; ?>">		
      <input type="submit" name="Submit" value="Submit">
    </td>
  </tr>
</table>
<?
	} // End if the message they requested existss				
		
// End if there was a call to edit a message
}


//######################################################################################################
// If they actually edited a message
if ( isset($hidden_edit_id) ) {
	$hidden_edit_id = $_POST["hidden_edit_id"];
	$in_sb_name = $_POST["sb_name"];
	$in_sb_link = $_POST["sb_link"];
	$in_sb_message = $_POST["sb_message"];

	$in_sb_name = in_safe($in_sb_name);
	$in_sb_link = in_safe($in_sb_link);
	$in_sb_message = in_safe($in_sb_message);
	$in_sb_message= str_replace( "&lt;br /&gt;", "<br />", "$in_sb_message");

	$query = "UPDATE chatbox_data SET";
	$query .= " name=$in_sb_name,";
	$query .= " link=$in_sb_link,";
	$query .= " message=$in_sb_message";
	$query .= " WHERE id='$hidden_edit_id'";
	$query .= " ORDER BY timestamp DESC";
	$query .= " limit 1";
	$result=@mysql_query($query);
	$affected_rows= mysql_affected_rows();
		if( $affected_rows > 0) {
			$msg_log .= "The message was successfully edited! <br /> \n";
		}else{
			$msg_log .= "The message could not be edited! <br /> \n";
		}

// End If they actually edited a message 
}
//######################################################################################################


?>
<div align="center">
<table width="550" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td align="center" style="font-weight:bold"><? print "$msg_log"; ?></td>
    <td width="40">&nbsp;</td>
    <td width="55">&nbsp;</td>
  </tr>
<?php


// Form the SQL Query to fetch the messages from the chatbox dtat
$query = "SELECT * FROM chatbox_data";
$query .= " ORDER BY timestamp DESC";
// Run the SQL Query
$res=@mysql_query($query);

// If there are any messages...
if( @mysql_num_rows($res) ) {
	// Get the messages
	while($obj=@mysql_fetch_object($res)) {
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
		output_message( $name, $timestamp, $message, $link, $id );
	} // End fetch messages from database

// Else there were no messages
}else{
	print '	<tr><td colspan="3" >No messages posted yet!</td></tr>';
}



?>
</table>
</div>
<?php
template_footer();
?>
