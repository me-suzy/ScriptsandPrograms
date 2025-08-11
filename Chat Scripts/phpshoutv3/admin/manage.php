<?
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>phpSHOUT Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="phpshoutadmin.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript">

	// check and uncheck all check boxes
	function CheckAll()
	{
	for (var c=0;c<document.forms[0].elements.length;c++)
	   {
	   
	   	var e = document.forms[0].elements[c];
	   	if (e.name != 'allbox')
		e.checked = document.adminview.allbox.checked;
	   
	   }
	 }
	 
	// text link as form action
	function GoDo(job)
	{
		document.adminview.action.value=job;
		document.adminview.submit();
	}
	
	// text link to delete all messages
	function DeleteAll()
	{
		if (confirm("Are you sure you want to delete all messages?")){ 
		document.adminview.action.value='del_all';
		document.adminview.submit();
		}
	}
	
</SCRIPT>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #FF0000}
.normal_post {color: #000000}
.banned_post {color: #FF0000; text-decoration: line-through;}
-->
</style>
</head>

<body class="phpshout_body">
<?	
	include "../config.php";
	include "admin_functions.php";
	
	phpshout_chk_login();
	
	if (!isset($_POST["action"])) {
		$_POST["action"] = "1";
	}

if (isset($_POST["Edit_Post_Submit"])) { // IF EDITTED POSTS
		
	$filename = "../messages.txt";
	$read =	file_get_contents($filename);
	$filearray = explode ("\n",$read);
	
		foreach($_POST["edit_id"] as $id) {

			$_POST["edit_name"][$id] = strtolower(stripslashes(trim(htmlspecialchars($_POST["edit_name"][$id]))));
			$_POST["edit_msg"][$id] = strtolower(stripslashes(trim(htmlspecialchars($_POST["edit_msg"][$id]))));
			$_POST["edit_time"][$id] = strtolower(stripslashes(trim(htmlspecialchars($_POST["edit_time"][$id]))));
			$_POST["edit_ip"][$id] = strtolower(stripslashes(trim(htmlspecialchars($_POST["edit_ip"][$id]))));

			unset($filearray[$id]);
			$filearray[$id] =  $_POST["edit_name"][$id]."\t".$_POST["edit_msg"][$id]."\t".$_POST["edit_time"][$id]."\t".$_POST["edit_ip"][$id];
			ksort($filearray);
		
		}
	
	unlink($filename);
	$handle = fopen($filename, "x+");
	
		// for every array element left reinsert
		foreach($filearray as $renew) {
	
			fwrite($handle, $renew."\n");
	
		}

	fclose($handle);
	header('location:'.$_SERVER['HTTP_REFERER']);
		
} else if (isset($_POST["Edit_Ban_Submit"])) { // IF EDIT BANNED IPS LIST CHANGED

	$banned_ips_filename = "../banned_ips.txt";
	$banned_handle = fopen($banned_ips_filename,"w");
	fwrite($banned_handle, $_POST["banned_ips"]);
	
	header('location:'.$_SERVER['HTTP_REFERER']);
		
} else if ($_POST["action"] == "delete") { // IF DELETE CLICKED
	
	if (!isset($_POST["post"])) {
	
		echo "<p class=\"phpshout_editting\">No posts have been selected to delete. Please <a href=\"".$_SERVER['HTTP_REFERER']."\">go back</a> and select the post(s) you want to delete<br></p></td></tr>";
	
	} else {
	// get file contents and create array elements by new lines
	$filename = "../messages.txt";
	$read =	file_get_contents($filename);
	$array = explode ("\n",$read);
	
	// for every tick box remove element from array
	foreach($_POST["post"] as $value) {
		
		unset($array[$value]);

	}
	
	// Delete messages file and then recreate and insert existing posts.
	unlink($filename);
	$handle = fopen($filename, "x+");
	
	// for every array element left reinsert
	foreach($array as $renew) {
	
		fwrite($handle, $renew."\n");
	
	}

	fclose($handle);
	
	header('location:'.$_SERVER['HTTP_REFERER']);
	}
	
} else if ($_POST["action"] == "edit") { // IF EDIT CLICKED
 
 	$filename = "../messages.txt";
	$read =	file_get_contents($filename);
	$array = explode ("\n",$read);
	?>
	<form name="form1" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
	<table align="center" cellpadding="5" cellspacing="0" class="phpshout_adminview">
	<tr>
	  <td colspan="5" class="phpshout_posts"><p><strong>Edit Posts <br>
      </strong>Please edit your selected posts and then click submit.</p>      </td>
	  </tr>
	<tr bgcolor="#6699CC" class="style1">
	  <td class="phpshout_posts"><strong>Name</strong></td>
	  <td class="phpshout_posts"><strong>Message</strong></td>
	  <td class="phpshout_posts"><strong>Time</strong></td>
	  <td class="phpshout_posts"><strong>IP</strong></td>
	</tr>
	<?	
	// If no checkboxes are selected
	if (!isset($_POST["post"])) {
	
		echo "<tr><td align=\"center\" colspan=\"5\" class=\"phpshout_editting\"><p>No posts have been selected to edit. Please <a href=\"".$_SERVER['HTTP_REFERER']."\">go back</a> and select the post(s) you want to edit<br></p></td></tr>";
	
	} else {
	
	foreach($_POST["post"] as $value) {

		list($arr_name,$arr_msg,$arr_time,$arr_ip) = explode("\t",$array[$value]);
		
		echo "<input name=\"edit_id[".$value."]\" type=\"hidden\" value=\"".$value."\">";
		echo "<tr><td width=\"25%\" class=\"phpshout_editting\"><input name=\"edit_name[".$value."]\" type=\"text\" id=\"edit_name[".$value."]\" value=\"".$arr_name."\" size=\"16\"></td>";
    	echo "<td width=\"25%\" class=\"phpshout_editting\"><input name=\"edit_msg[".$value."]\" type=\"text\" id=\"edit_msg[".$value."]\" value=\"".$arr_msg."\" size=\"18\"></td>";
    	echo "<td width=\"25%\" class=\"phpshout_editting\"><input name=\"edit_time[".$value."]\" type=\"text\" id=\"edit_time[".$value."]\" value=\"".$arr_time."\" size=\"15\"></td>";
    	echo "<td width=\"25%\" class=\"phpshout_posts\"><input name=\"edit_ip[".$value."]\" type=\"text\" id=\"edit_ip[".$value."]\" value=\"".$arr_ip."\" size=\"15\"></td></tr>";
	}
	
	}
	 ?>
	<tr bgcolor="#EEEEEE">
	<td colspan="5" class="phpshout_posts"><input type="submit" name="Edit_Post_Submit" value="Submit"></td>
	</tr>
	</table>
	</form>
<?
} else if ($_POST["action"] == "ban") { // IF BAN IP CLICKED
	
	$filename = "../messages.txt";
	$read =	file_get_contents($filename);
	$array = explode ("\n",$read);
	
	$banned_filename = "../banned_ips.txt";
	$ban_handle = fopen($banned_filename, "a+");

	foreach($_POST["post"] as $value) {
		
		list($arr_name,$arr_msg,$arr_time,$arr_ip) = explode("\t",$array[$value]);
		fwrite ($ban_handle,$arr_ip."\n");
		
	}
	
	header('location:'.$_SERVER['HTTP_REFERER']);
	
} else if ($_POST["action"] == "edit_ban_users") { // IF EDIT BAN CLICKED

 	$filename = "../banned_ips.txt";
	$read =	file_get_contents($filename);
	?>
	<form name="form1" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
	<table align="center" cellpadding="5" cellspacing="0" class="phpshout_adminview">
	<tr>
	  <td class="phpshout_posts"><p><strong>Edit Ban List <br>
      </strong>Here you can add or remove IP address manually. For every IP address please leave a new line.</p>      </td>
	  </tr>
	<tr bgcolor="#6699CC" class="style1">
	  <td class="phpshout_posts">&nbsp;</td>
	  </tr>
		<tr align="center"><td>
		<p><br><textarea name="banned_ips" cols="70" rows="10" id="banned_ips"><? echo $read; ?></textarea>
		</p><p>&nbsp;</p></td>
		</tr>
	<tr bgcolor="#EEEEEE">
	<td class="phpshout_posts"><input type="submit" name="Edit_Ban_Submit" value="Submit"></td>
	</tr>
	</table>
	</form>
<?
} else if ($_POST["action"] == "del_all") { // IF DELETE ALL CLICKED
	
	$filename = "../messages.txt";
	
	// Delete messages file and then recreate.
	unlink($filename);
	$handle = fopen($filename, "x+");
	
	header('location:'.$_SERVER['HTTP_REFERER']);
	
} else if ($_POST["action"] == "logout") {

	session_destroy();
	
	header('location:index.php');
	
} else {

	include "../config.php";
	include "../functions.php";

	$numPerPage = 20;
	$filename = "../messages.txt";
	$handle = fopen($filename, "r");
	$read =	file_get_contents($filename);
	
	// create array elements by new lines
	$array = explode ("\n",$read);
	
	$page = isset($_GET['page']) ? $_GET['page'] : 1;

	$start = ($page-1) * $numPerPage;

	?>
	<form name="adminview" method="post" action="">
	<input name="action" type="hidden">
	  <table align="center" cellpadding="5" cellspacing="0" class="phpshout_adminview">
        <tr>
          <td class="phpshout_posts">&nbsp;</td>
          <td colspan="5" class="phpshout_posts"><p><strong>Manage Posts<br>
            </strong>Welcome to phpSHOUT admin manager.</p>
            <p> To delete, edit or ban an ip address please tick the checkboxes corresponding with the posts and then click the relevant link.</p>
          <p><a href="javascript:GoDo('delete')" title="delete">delete</a> | <a href="javascript:GoDo('edit')" title="edit">edit</a> | <a href="javascript:GoDo('ban')" title="ban user">ban user</a> | <a href="javascript:GoDo('edit_ban_users')" title="edit banned list">edit banned users list</a> | <a href="javascript:DeleteAll();" title="delete all" class="style2">delete all</a> | <a href="javascript:GoDo('logout')" title="log out">log out</a> </p></td>
        </tr>
        <tr bgcolor="#6699CC">
          <td class="phpshout_posts"><input name="allbox" type="checkbox" id="allbox" onClick="CheckAll();" value="checkbox"></td>
          <td width="15%" class="phpshout_posts"><span class="style1"><strong>Name</strong></span></td>
          <td width="55%" class="phpshout_posts"><span class="style1"><strong>Message</strong></span></td>
          <td width="15%" class="phpshout_posts"><span class="style1"><strong>Time</strong></span></td>
          <td width="15%" class="phpshout_posts"><span class="style1"><strong>IP</strong></span></td>
        </tr>
        <?
			if ($read == "" || $read == NULL) {
				
				echo "<tr><td align=\"center\" colspan=\"6\"><p><strong>There are no posts to be displayed</strong></p></td></tr>";
			
			} else {
			
				$banned_ip_filename = "../banned_ips.txt";
				$handle = fopen($banned_ip_filename, "r");
				$ban_read =	file_get_contents($banned_ip_filename);
	
				// create array elements by new lines
				$ban_array = explode ("\n",$ban_read);
				// trim each element in the array
				foreach ($ban_array as $ban_key) {
					$ban_array[$ban_key] = trim($ban_key);
				}
				
				// start loop for each page
				for ($i=$start; $i<$start+$numPerPage; $i++) {		
					
					// if there is a blank line. fixes offset error
					if ($array[$i] != NULL || $array[$i] != "") {
						
						list($name,$msg,$time,$ip) = explode ("\t", $array[$i]);
						// convert text to smilie images.
						$msg = smiles($msg);

							// set font colour style for banned ips
							if (in_array(trim($ip), $ban_array)) {
								$post_style = "banned_post";
							} else {
								$post_style = "normal_post";
							}
						
							echo "<tr><td class=\"phpshout_posts\"><input name='post[$i]' type='checkbox' value='$i'></td><td class=\"phpshout_posts\"><span class=\"".$post_style."\">".wordwrap($name,18,"<br>\n",1)."</span></td><td class=\"phpshout_posts\"><span class=\"".$post_style."\">".ereg_replace("([^ \/]{30})","\\1<wbr>",$msg)."</span></td><td class=\"phpshout_posts\"><span class=\"".$post_style."\">".$time."</span></td><td class=\"phpshout_posts\"><span class=\"".$post_style."\">".$ip."</span></td></tr>";
					
					} else {
					
					// stop loop
						break;
						
					}		
				}
			}
	?>
        <tr bgcolor="#EEEEEE">
          <td class="phpshout_posts" colspan="6">
            <?
			
	$totalPages = ceil(count($array) / $numPerPage);
	
	if ($page!=1) echo "<a href=".$_SERVER['PHP_SELF']."?page=".($page-1).">Previous</a> ";
	for ($i=1; $i<=$totalPages; $i++) {
    
    echo ($i==$page) ? $page.' ' : "<a href=".$_SERVER['PHP_SELF']."?page=".$i.">".$i."</a> ";
    
	}
	if ($page!=$totalPages) echo "<a href=".$_SERVER['PHP_SELF']."?page=".($page+1).">Next</a>";
	
	fclose($handle);
	
	?>
          </td>
        </tr>
      </table>
</form>
<?
}
?>
</body>
</html>
<?
ob_end_flush();
?>