<?php
/*
=====================================================================
SCRIPT :: Made by Xan Manning - http://www.knoxious.co.uk/
xan.manning@knoxious.co.uk

This script is released under GPL, please refer to the GNU General 
Public License included in this .zip file.
=====================================================================

=====================================================================
CONFIGURATION
=====================================================================
*/

// General Options
	$adminpass = "password";				// Administrator password. Letters and Numbers Recommended.
	$adminemail = "you@email.com";			// Admin email (For QuickMail).
	$boxname = "kNitrogenTag +66.4kJ";		// Tagboard Name.
	$quickmail = 1;							// Use Quickmail? (allows people to contact via TagBoard).
	$shouts = 10;							// Number of shouts to display on page.
	$maxword = 25;							// Maximum word length (Stops long woooooooooooooooooooords).
	$taglength = 255;						// Maximum Length per shout.
	$flood = 30;							// Time in seconds until user can post again.
	$allowedtag = "<b><i><u>";				// Allowed HTML tags (Be carefull which ones are used).
	
// Text Database Options
	$txt_filename = "tag.db";				// Filename of text database.
	$banfile = "banned.db";					// Filename of Banned IP Database.
	
// Bad Language Filter
	$badwords = array(	"shit",
						"fuck",
						"bastard",
						"bitch",
						"piss",
						"crap",
						"masturbate",
						"wank",
						"cunt",
						"penis",
						"faggot",
						"pussy",
						"spastic",
						"prick",
						"cock",
						"whore"
					);
	
/* 
=====================================================================
STYLE - For More Experienced WebDesigners.
=====================================================================
*/

$css_style = "body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
	font-size: x-small;
	margin-left: 0px;
    margin-right: 0px;
    margin-top: 0px;
    margin-bottom: 0px;
	background-color:#FFFFFF;
}

.poster {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: dashed;
	border-left-style: none;
	border-top-color: #999999;
	border-right-color: #999999;
	border-bottom-color: #E3E3E3;
	border-left-color: #999999;
}
.text {
	background-color: #F9F9F9;
}
a:link {
	color: #3399FF;
	text-decoration: none;
}
a:visited {
	color: #3399FF;
	text-decoration: none;
}
a:hover {
	color: #3333FF;
	text-decoration: underline overline;
}
a:active {
	color: #3366FF;
}
.input {
	color: #666666;
	background-color: #F9F9F9;
	border: 1px solid #999999;
	width: 85%;
}
.button {
	color: #000000;
	background-color: #F5F5F5;
	border: 1px solid #999999;
}
.dialogue {
	background-color: #F5F5F5;
	border: 1px solid #EEEEEE;
}
.container {
	background-color: #EBEBEB;
}
.cell-a {
	background-color: #F9F9F9;
	width: 40%;
}
.cell-b {
	background-color: #E3E3E3;
}
.expander {
	overflow: auto;
	height: 220px;
	width: 98%;
}";

/* 
=====================================================================
PHP - The good stuff eh? the code! Only Edit if you know what you
are doing.
=====================================================================
*/

// Session Handlers.
session_start();
error_reporting(0);
$admin = $_COOKIE['admin'];
$page = $_GET['p'];
$version = "1.3.4";
	switch($page) {
		case "login":
			if(@$_POST['password'] == $adminpass)
					{
						setcookie('admin', md5($_POST['password']), time()+3600*24);
					}
		break;
		case "post":
		setcookie("name", stripslashes($_POST['username']), time()+3600*24*365);
		setcookie("email", stripslashes($_POST['email']), time()+3600*24*365);
		setcookie("url", stripslashes($_POST['url']), time()+3600*24*365);
		break;
		case "logout":
		setcookie('admin', "", time()-3600*24);
		break;
		default:
		$all = "ok";
		break;
		}
$shouts = $shouts + 1;

/* 
=====================================================================
FUNCTIONS
=====================================================================
*/

// Inport Banned IPs
function getBannedIPs($file)
	{
		$fopen = fopen($file, "r");
		$fread = fread($fopen, filesize($file)+1);
		fclose($fopen);
		return $fread;
	}

// Check if Banned IP
function checkBan($ip, $ban)
	{
	global $config;
	$ban = explode(",", $ban);
	foreach($ban as $banip)
		{
			if($ip == $banip)
				{
					$msg = "NotOk";
					break;
				} else {
					$msg = "Aok";
				}
		}
		return $msg;
	}


// Ban Current
function banCurrent($ip, $banfile)
	{
		$fopen = fopen($banfile, "a+");
		$fwrite = fwrite($fopen, ",".$ip);
		fclose($fopen);
		if(!$fwrite)
			{
				return FALSE;
			} else {
		return true;
		}
	}

// Check IP History
function checkIPHistory($yourip, $datafile, $flood_control)
	{
		$fopen = fopen($datafile, "r");
		$fread = fread($fopen, filesize($datafile)+1);
		fclose($fopen);
		$line = explode("\n", $fread); 
		$i = count($line)+1; 
			for ($n=0 ; $n < $i-1 ; $n++)
				{ 
  					$ip = explode("|", $line[$n]);
					$ips = $ip[1];
					if($yourip == $ips)
						{
							$time[] = $ip[0];
						}
				}
				$time_now = date("U");
				if(is_array($time))
					{
						$time = array_reverse($time);
					}
				$time = $time[0];
				$flood = $time_now - $time;
				if($flood > $flood_control)
					{
						return TRUE;
					} else {
						return FALSE;
					}
	}

// Check Writable Database.
	function checkWritable($txt_filename)
		{
			if(is_writable($txt_filename))
				{
					return true;
				} else
					{
						echo "<div align=\"center\"><strong style=\"color: #CC0000;\">Error, </strong>
						$txt_filename is not writable. Please CHMOD to 0777</div>";
						return false;
					}
		}
// Delete Entry.

	function deleteEntry($txt_filename, $entry)
		{
			global $adminemail;
			$open = fopen($txt_filename,"r+"); 
			$data = fread($open, filesize($txt_filename)+1); 
			fclose($open);
			$entry = base64_decode($entry);
			$line = explode("\n", $data);
			$lines = count($line);
			if($lines == 1){
				$n = "";
				$n2 = "";
				$entryr = date("U")."|".$_SERVER['REMOTE_ADDR']."|Machine|".$adminemail."||No Shouts Avalable.";
				} elseif($lines > 1 && $entry == $line[$lines]){
				$n = "\n";
				$n2 = "";
				$entryr = "";
				} elseif($lines > 1 && $entry == $line[0]){
				$n = "";
				$n2 = "\n";
				$entryr = "";
				} else {
				$n = "\n";
				$n2 = "";
				$entryr = "";
				}
			$entry = "$n".$entry."$n2";
			$new = str_replace($entry, "$entryr", $data);
			$open = fopen($txt_filename, "w");
			fwrite($open, $new);
			fclose($open);
		}

// Edit Entry (2 Functions).
function editEntry($txt_filename, $entry)
		{
		global $admin;
		global $quickmail;
		if(isset($admin))
			{
			$dt = $entry;
			$entry = base64_decode($entry);
			$entry = explode("|", $entry);
			echo '<table width="95%"  border="0" align="center" cellpadding="2" cellspacing="2">';
			$datetime = date("d-m-Y H:i:s", $entry[0]);
									$name = $entry[2];
									$email = $entry[3];
									if($quickmail > 0 && $email != "")
										{
											$email = "<a href=\"#\" onclick=\"mail=window.open('?p=quickmail&amp;address=".base64_encode($email)."', 'Mail', 'width=320, height=240'); return false;\">@</a>";
										} elseif($quickmail < 1 && $email !="")
											{
												$email = "<a href=\"mailto:$email\">@</a>";
											} elseif($quickmail < 1 || $email == "" || $email == NULL)
												{
													$email = "@";
												}
									$url = $entry[4];
									if($url != "" || $url != NULL)
										{
											$search = stristr($url, 'http://');
											if($search == FALSE)
												{
													$url = "<a href=\"http://$url\" target=\"_blank\">$name</a>";
												} else {
													$url = "<a href=\"$url\" target=\"_blank\">$name</a>";
												}
											
										}else
											{
												$url = $name;
											}				
									$msg = $entry[5];
									$format = '<tr>
   													<td class="poster"><div align="left"><strong><strong>Original Entry</strong><br />
													'.$email.' - '.$url.'</strong> '.$datetime.'. '.$ip.' </div></td>
  												</tr>
  												<tr>
   													<td class="text"><div align="left">&quot;'.$msg.'&quot;</div></td>
  												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>';
									
									echo $format."</table>";
			
			echo "<form name=\"form1\" id=\"form1\" method=\"post\" action=\"?p=edit&amp;dt=".$dt."\" onsubmit=\"return checkForm(this);\">
  					<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   							<tr>
     							<td><strong>Name:</strong><br />
      							<input name=\"username\" type=\"text\" class=\"input\" id=\"username\" maxlength=\"32\" value=\"".$entry[2]."\" /></td>
    						</tr>
    						<tr>
      							<td><strong>Email:</strong><br />
								<input name=\"email\" type=\"text\" class=\"input\" id=\"email\" maxlength=\"32\" value=\"".$entry[3]."\" /></td>
    						</tr>
    						<tr>
      							<td><strong>URL:</strong><br />
      							<input name=\"url\" type=\"text\" class=\"input\" id=\"url\" maxlength=\"32\" value=\"".$entry[4]."\" /></td>
    						</tr>
    						<tr>
      							<td><strong>Message:</strong><br />
      							<input name=\"msg\" type=\"text\" class=\"input\" id=\"msg\" maxlength=\"$taglength\" value=\"".htmlspecialchars(reverseClean($entry[5]))."\" /></td>
    						</tr>
    						<tr>
      							<td colspan=\"2\"><div align=\"center\">
								<input type=\"hidden\" name=\"ip\" value=\"".$entry[1]."\" />
								<input type=\"hidden\" name=\"datetime\" value=\"".$entry[0]."\" /><em>IP:</em> 
								".$entry[1]."<br /><input type=\"submit\" name=\"Save\" value=\"Save\" class=\"button\" />
        							<input type=\"reset\" name=\"Reset\" value=\"Reset\" class=\"button\" />
									<input type=\"button\" onclick=\"javascript:history.back();\" name=\"Back\" class=\"button\" value=\"Back\" />
      							</div></td>
    						</tr>
							<tr>
      							<td colspan=\"2\"><div align=\"center\">
        							<a href=\"#\" onclick=\"bb=window.open('?p=bbcode', 'BBCode', 'width=320, height=400, scrollbars=yes'); return false;\">Smilies</a><br />
      							</div></td>
    						</tr>
  					</table>
				</form>";
				} else {
				echo "<div align=\"center\"><strong>Denied</strong>, you do not have permission to Edit or Delete!<br />
							<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
							</script>";
				}
		}
		
	function postEdit($txt_filename, $original, $new)
		{
			$open = fopen($txt_filename,"r+"); 
			$data = fread($open, filesize($txt_filename)+1); 
			fclose($open);
			$new = str_replace(base64_decode($original), $new, $data);
			$open = fopen($txt_filename, "w");
			fwrite($open, $new);
			fclose($open);
			return true;
		}
// Bar Exploit Fix.

	function nobar($str)
		{
			$str = str_replace("|", "&bvrbar; ", preg_replace('/\s\s+/', ' ', $str));
			if($post == " ")
						{
							return false;
						}
			return $str;
		}

// Badword Filter.

    function filterBadword($badwords, $str)
    {
        foreach ($badwords as $badword)
        {
            $str = str_replace($badword, str_repeat("*", strlen($badword)), strtolower($str));
			$strr = ucfirst($str);
        }
        return $strr;
    } 
	
// LongwordCut function.

	function longWordCut($string, $width)
		{
   			$string = wordwrap($string, $width, " ", 1);
			return $string;
		}

// Clean up function.
	
		function cleanPost($post)
			{
				global $badwords;
				global $maxword;
				global $allowedtag;
						$smilies = array(
										':)' => '<img src="images/smile.gif" alt="" />',
										':@' => '<img src="images/angry.gif" alt="" />',
										':d' => '<img src="images/biggrin.gif" alt="" />',
										':blink:' => '<img src="images/blink.gif" alt="" />',
										':$' => '<img src="images/blush.gif" alt="" />',
										':sleep:' => '<img src="images/sleep.gif" alt="" />',
										':cool:' => '<img src="images/cool.gif" alt="" />',
										':dry:' => '<img src="images/dry.gif" alt="" />',
										':!:' => '<img src="images/excl.gif" alt="" />',
										':glare:' => '<img src="images/glare.gif" alt="" />',
										'=)' => '<img src="images/happy.gif" alt="" />',
										':S' => '<img src="images/huh.gif" alt="" />',
										':s' => '<img src="images/huh.gif" alt="" />',
										':lol:' => '<img src="images/laugh.gif" alt="" />',
										':mad:' => '<img src="images/mad.gif" alt="" />',
										':.' => '<img src="images/mellow.gif" alt="" />',
										':ninja:' => '<img src="images/ninja.gif" alt="" />',
										':o' => '<img src="images/ohmy.gif" alt="" />',
										':roll:' => '<img src="images/rolleyes.gif" alt="" />',
										':(' => '<img src="images/sad.gif" alt="" />',
										':p' => '<img src="images/tongue.gif" alt="" />',
										':P' => '<img src="images/tongue.gif" alt="" />',
										';)' => '<img src="images/wink.gif" alt="" />',
										':luv:' => '<img src="images/wub.gif" alt="" />'
										);
					
					$post = filterBadword($badwords, stripslashes($post));
					$post = nobar(strip_tags($post, $allowedtag));
					$post = longWordCut(preg_replace('/\s\s+/', ' ', $post), $maxword); 
					$post = str_replace(array_keys($smilies), $smilies, $post);
					$count = strlen($post);
					if($post == " " || $count < 4)
						{
							return false;
						}
					return $post;
			}
			
// Reverse Clean Function.

	function reverseClean($post)
		{
			$smilies = array(
										'<img src="images/smile.gif" alt="" />' => ':)',
										'<img src="images/angry.gif" alt="" />' => ':@',
										'<img src="images/biggrin.gif" alt="" />' => ':D',
										'<img src="images/blink.gif" alt="" />' => ':blink:',
										'<img src="images/blush.gif" alt="" />' => ':$',
										'<img src="images/sleep.gif" alt="" />' => ':sleep:',
										'<img src="images/cool.gif" alt="" />' => ':cool:',
										'<img src="images/dry.gif" alt="" />' => ':dry:',
										'<img src="images/excl.gif" alt="" />' => ':!:',
										'<img src="images/glare.gif" alt="" />' => ':glare:',
										'<img src="images/happy.gif" alt="" />' => '=)',
										'<img src="images/huh.gif" alt="" />' => ':s',
										'<img src="images/laugh.gif" alt="" />' => ':lol:',
										'<img src="images/mad.gif" alt="" />' => ':mad:',
										'<img src="images/mellow.gif" alt="" />' => ':.',
										'<img src="images/ninja.gif" alt="" />' => ':ninja:',
										'<img src="images/ohmy.gif" alt="" />' => ':o',
										'<img src="images/rolleyes.gif" alt="" />' => ':roll:',
										'<img src="images/sad.gif" alt="" />' => ':(',
										'<img src="images/tongue.gif" alt="" />' => ':p',
										'<img src="images/wink.gif" alt="" />' => ';)',
										'<img src="images/wub.gif" alt="" />' => ':luv:'
										);
										
					$post = str_replace(array_keys($smilies), $smilies, $post);
					$post = str_replace("&bvrbar; ", "|", $post);
					
					return $post;

		}
		
// Safe Credentials.

function safeCredentials($input)
	{
	global $badwords;
		$input = preg_replace('/\s\s+/', ' ', $input);
		$input = filterbadword($badwords, $input);
		$input = stripslashes(str_replace($array, $clean, $input));
		$input = strip_tags($input);
		$input = nobar($input);
		$output = $input;
		return $output;
	}
	
// URL Valid? : if it isn't right we aren't interested!
function validURL($url)
	{
		$address = $url;
		$address = preg_replace('/\s\s+/', ' ', $address);
		$search = stristr($address, 'http://');
		if($search == FALSE)
		{
			$address = "http://"
						.$address;
		}
		if($address != "" && $address != " " && $address != NULL && eregi("^(http|https)+(:\/\/)+[a-z0-9_-]+\.+[a-z0-9_-]", $address))
			{
				return $address;
			} else {
				return NULL;
			}
	}
	
// valid Email? : if it isn't right we aren't interested!
function validEmail($email)
	{
		$email = preg_replace('/\s\s+/', ' ', $email);
		$address = $email;
		if($address != "" && $address != " " && $address != NULL && eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$", $email))
			{
				return $address;
			} else {
				return NULL;
			}
	}
			
// Txt Post Function.

	function writeTxt($name, $email, $http, $msg, $txt_filename)
		{
			$datetime = date("U");
			$ip = $_SERVER['REMOTE_ADDR'];
			$name = safeCredentials($name);
			$email = validEmail(safeCredentials($email));
			$http = validURL(safeCredentials($http));
			$msg = cleanPost($msg);
			$string = "\n".$datetime."|".$ip."|".$name."|".$email."|".$http."|".$msg;
			if($name != false && $msg != false)
				{
					$open = fopen("$txt_filename", "a");
					fwrite($open, $string);
					fclose($open);
					return true;
				} else {
				return false;
				}
			
			
		}			
			
// Expell TXT shouts from the collective Rectum.

	function displayTxt($txt_filename)
		{
		global $quickmail;
		global $shouts;
		global $admin;
		echo '<table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">';
			$open = fopen($txt_filename,"r+"); 
			$data = fread($open, filesize($txt_filename)+1); 
			fclose($open); 
			$line = explode("\n", $data); 
			$i = count($line)+1; 
			$offset = $i - $shouts;
			if($offset < 0)
				{
					$offset = 0;
				}
			$limit = 0;
				for ($n=$offset ; $n < $i-1 && $shouts + 1 >= $limit ; $n++ )
					{ 
 					 	$tag = explode("|", $line[$n]); 
  							if (isset($tag[0])) 
  								{ 
								
									$datetime = date("d-m-Y H:i:s", $tag[0]);
									if(isset($admin))
										{	
											$ip = "<a href=\"?p=delete&amp;dt=".base64_encode($line[$n])."\">Delete</a> - 
											<a href=\"?p=edit&amp;dt=".base64_encode($line[$n])."\">Edit</a><br />
											:: <a href=\"?p=ban&i=".base64_encode($tag[1])."\" title=\"Ban ".$tag[1].".\" onclick=\"return confirmBan();\"><em>".$tag[1]."</em></a>";
										} else
											{
												$ip = "";
											}
									$name = $tag[2];
									$email = $tag[3];
									if($quickmail > 0 && $email != "")
										{
											$email = "<a href=\"#\" onclick=\"mail=window.open('?p=quickmail&amp;address=".base64_encode($email)."', 'Mail', 'width=320, height=240'); return false;\">@</a>";
										} elseif($quickmail < 1 && $email !="")
											{
												$email = "<a href=\"mailto:$email\">@</a>";
											} elseif($quickmail < 1 || $email == "" || $email == NULL)
												{
													$email = "@";
												}
									$url = $tag[4];
									if($url != "" || $url != NULL)
										{
											$search = stristr($url, 'http://');
											if($search == FALSE)
												{
													$url = "<a href=\"http://$url\" target=\"_blank\">$name</a>";
												} else {
													$url = "<a href=\"$url\" target=\"_blank\">$name</a>";
												}
											
										}else
											{
												$url = $name;
											}				
									$msg = $tag[5];
									$format = '<tr>
   													<td class="poster"><div align="left"><strong>'.$email.' - '.$url.'</strong> '.$datetime.'. '.$ip.'</div></td>
  												</tr>
  												<tr>
   													<td class="text"><div align="left">&quot;'.$msg.'&quot;</div></td>
  												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>';
									
									echo $format;
									$limit = $limit + 1;
									
						    	} 
 					} 
					echo '</table>';
		}
		
// QuickMail Function.
	
	function quickMail($to, $email, $name, $message)
		{
			global $adminemail;
			global $boxname;
			$ip = $_SERVER['REMOTE_ADDR'];
			$message = "Dear $to,
You have received a message from $name at the $boxname Shoutbox.
If this turns out to be spam please report to $adminemail the following IP: $ip

".cleanPost($message)."

Regards, $name. $email.";
			mail($to, "Message from ".$boxname, $message, "From: $email");
		}

/* 
=====================================================================
THE PAGES
=====================================================================
*/
$ok = checkBan($_SERVER['REMOTE_ADDR'], getBannedIPs($banfile));
if($ok == "NotOk")
	{
		die("You are banned from this shoutbox!");
	}
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<meta http-equiv="author" content="Xan Manning :: Knoxious.co.uk" />
			<title>'.$boxname.' :: Powered by k.NitrogenTag +66.4kJ</title>
			<script language="javascript" type="text/javascript">
			<!--
			function checkForm(form)
				{
					name = form.username.value;
					email = form.email.value;
					url = form.url.value;
					msg = form.msg.value;

					if (name == "" || name == "Name" || msg == "" || msg == "Message") 
						{
							alert ("Please fill in the Name and Message Boxes.")
							return false;
						}
							else return true;
				}
			function confirmBan()
				{
					var ask=confirm("Are you sure you wish to ban this IP?");
					if(ask)
						{
							return true;
						} else {
					return false;
					}
				}
				// -->
			</script>
			<style type="text/css">
			<!--
			'.$css_style.'
			-->
			</style>
			  </head>';
				$conditions_scroll = array("edit", "default");
			$conditions_plain = array("delete",
								"post",
								"ban",
								"bbcode",
								"mail",
								"login",
								"quickmail",
								"all");
				if(!isset($page) || in_array($page, $conditions_scroll))
					{
						echo "<body onload=\"window.scrollTo(0,99999);\">";
					} elseif(in_array($page, $conditions_plain))
					{
						echo "<body>";					
					} else {
						echo "<body onunload=\"opener.window.location.reload();\">";
					}
					checkWritable($txt_filename);
	switch($page)
		{
			case "admin":
			if(isset($admin)){
			echo "<div align=\"center\"><strong>Already Logged in.</strong><br />
							<a href=\"?p=logout\">Logout.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.close();\", 30000);
							</script>";
			} else {
			echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  					<tr>
    					<td class=\"dialogue\"><div align=\"center\">
      					<form action=\"?p=login\" method=\"post\" name=\"form1\" id=\"form1\">
        				<br />Admin Password:<input class=\"input\" type=\"password\" name=\"password\" />
        				<input class=\"button\" type=\"submit\" name=\"Submit\" value=\"Login\" /><br />
      					</form>
    					</div></td>
  					</tr>
				</table>";
				}
			break;
			case "login":
			if(@$_POST['password'] == $adminpass)
					{
						echo "<div align=\"center\"><strong>Thank you</strong>, you will now be redirected back.<br />
							<a href=\"javascript:window.close();\">Click here if not redirected in 5 Seconds.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.close();\", 5000);
							</script>";
					}
					else {
					echo "<div align=\"center\"><strong>Incorrect Password</strong><br />
							<a href=\"javascript:history.back();\">Click to go back.</a></div>";
					}
				break;
			case "logout":
			echo "<div align=\"center\"><strong>Thank you</strong>, you will now be redirected back.<br />
							<a href=\"javascript:window.close();\">Click here if not redirected in 5 Seconds.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.close();\", 5000);
							</script>";
			break;
			case "post":
			$flood_control = checkIPHistory($_SERVER['REMOTE_ADDR'], $txt_filename, $flood);
				if($flood_control == FALSE)
					{
						echo "<div align=\"center\"><strong>Sorry</strong>, There is a ".$flood." second flood control.<br />
						<a href=\"javascript:history.back();\">Click here if not redirected in 5 Seconds.</a></div>
						<script language=\"javascript\" type=\"text/javascript\">
						setTimeout(\"history.back();\", 5000);
						</script>";
					} else {
						$name = $_POST['username'];
						$email = $_POST['email'];
						$http = $_POST['url'];
						$msg = $_POST['msg'];
						$write = writeTxt($name, $email, $http, $msg, $txt_filename);
						if($write == true)
							{
								echo "<div align=\"center\"><strong>Thank you $name</strong>, you will now be redirected back.<br />
								<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
								<script language=\"javascript\" type=\"text/javascript\">
								setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
								</script>";
							} else {
								echo "<div align=\"center\"><strong>Sorry $name</strong>, your post contained just whitespace.<br />
								<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
								<script language=\"javascript\" type=\"text/javascript\">
								setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
								</script>";
							}
					}
			break;
			case "ban":
			if(isset($admin))
				{
			$ip = base64_decode($_GET['i']);
			$yourip = $_SERVER['REMOTE_ADDR'];
			if($ip == $yourip)
				{
							echo "<div align=\"center\"><strong>Failed!</strong>, you cannot ban yourself!<br />
							<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
							</script>";
				} else {
			$ban = banCurrent($ip, $banfile);
			if($ban == FALSE)
				{
						echo "<div align=\"center\"><strong>Sorry</strong>, Cannot ban ".$ip.", Error writing to file.<br />
						<a href=\"javascript:history.back();\">Click here if not redirected in 5 Seconds.</a></div>
						<script language=\"javascript\" type=\"text/javascript\">
						setTimeout(\"history.back();\", 5000);
						</script>";
					} else {
								echo "<div align=\"center\"><strong>Thank you $name</strong>, $ip has been banned.<br />
								<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
								<script language=\"javascript\" type=\"text/javascript\">
								setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
								</script>";
					}
				}
				} else {
							echo "<div align=\"center\"><strong>Denied</strong>, you do not have permission to Edit or Delete!<br />
							<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
							</script>";
				}
			break;
			case "quickmail":
			echo '<form name="form1" id="form1" method="post" action="?p=mail">
					<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
   						<tr>
      						<td><strong>To:</strong></td>
      						<td>'.base64_decode($_GET['address']).'
      						<input name="to" type="hidden" id="to" value="'.base64_decode($_GET['address']).'" /></td>
    					</tr>
    					<tr>
      						<td><strong>Your Email:</strong></td>
      						<td><input name="email" type="text" class="input" id="email" maxlength="32" /></td>
    					</tr>
    					<tr>
      						<td><strong>Name:</strong></td>
      						<td><input name="name" type="text" class="input" id="name" value="'.$cname.'" maxlength="32" /></td>
    					</tr>
    					<tr>
      						<td><strong>Message:</strong></td>
      						<td><textarea name="msg" class="input" id="msg"></textarea></td>
    					</tr>
    					<tr>
      						<td colspan="2"><div align="center">
        					<input type="submit" name="Submit" value="Submit" class="button" />
       						<input type="reset" name="Reset" value="Reset" class="button" />
      						</div></td>
    					</tr>
  				</table>
			</form>';
			break;
			case "mail":
			quickMail($_POST['to'], $_POST['email'], $_POST['name'], $_POST['msg']);
			echo "<div align=\"center\"><strong>Thank you</strong>, you will now be redirected back.<br />
			<a href=\"javascript:window.close();\">Click here if not redirected in 5 Seconds.</a></div>
			<script language=\"javascript\" type=\"text/javascript\">
			setTimeout(\"window.close();\", 5000);
			</script>";
			break;
			case "bbcode":
			echo '<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  					<tr>
  						<td><em><strong>EMOTICON</strong></em></td>
    					<td><em><strong>CODE</strong></em></td>
 					</tr>
  					<tr>
    					<td><img src="images/smile.gif" alt=" " /></td>
   						<td>:)</td>
  					</tr>
  					<tr>
    					<td><img src="images/angry.gif" alt=" " /></td>
    					<td>:@</td>
  					</tr>
  					<tr>
    					<td><img src="images/biggrin.gif" alt=" " /></td>
    					<td>:D</td>
  					</tr>
  					<tr>
   						<td><img src="images/blink.gif" alt=" " /></td>
    					<td>:blink:</td>
  					</tr>
  					<tr>
    					<td><img src="images/blush.gif" alt=" " /></td>
    					<td>:$</td>
  					</tr>
  					<tr>
    					<td><img src="images/sleep.gif" alt=" " /></td>
    					<td>:sleep:</td>
  					</tr>
  					<tr>
    					<td><img src="images/cool.gif" alt=" " /> </td>
   						<td>:cool:</td>
  					</tr>
  					<tr>
    					<td><img src="images/dry.gif" alt=" " /></td>
    					<td>:dry:</td>
  					</tr>
  					<tr>
    					<td><img src="images/excl.gif" alt=" " /></td>
    					<td>:!:</td>
  					</tr>
  					<tr>
    					<td><img src="images/glare.gif" alt="" /></td>
    					<td>:glare:</td>
  					</tr>
  					<tr>
    					<td><img src="images/happy.gif" alt="" /></td>
    					<td>=)</td>
  					</tr>
  					<tr>
    					<td><img src="images/huh.gif" alt="" /></td>
    					<td>:S</td>
  					</tr>
  					<tr>
    					<td><img src="images/laugh.gif" alt="" /></td>
    					<td>:lol:</td>
  					</tr>
  					<tr>
    					<td><img src="images/mad.gif" alt="" /></td>
    					<td>:mad:</td>
  					</tr>
  					<tr>
    					<td><img src="images/mellow.gif" alt="" /></td>
    					<td>:.</td>
  					</tr>
  					<tr>
    					<td><img src="images/ninja.gif" alt="" /></td>
    					<td>:ninja:</td>
  					</tr>
  					<tr>
    					<td><img src="images/ohmy.gif" alt="" /></td>
    					<td>:o</td>
  					</tr>
  					<tr>
    					<td><img src="images/rolleyes.gif" alt="" /></td>
    					<td>:roll:</td>
  					</tr>
  					<tr>
    					<td><img src="images/sad.gif" alt="" /></td>
    					<td>:(</td>
  					</tr>
  					<tr>
    					<td><img src="images/tongue.gif" alt="" /></td>
    					<td>:p</td>
  					</tr>
  					<tr>
    					<td><img src="images/wink.gif" alt="" /></td>
    					<td>;)</td>
  					</tr>
  					<tr>
    					<td><img src="images/wub.gif" alt="" width="22" height="29" /></td>
    					<td>:luv:</td>
  					</tr>
				</table>';
			break;
			case "delete":
			if(isset($admin))
				{
					deleteEntry($txt_filename, $_GET['dt']);
						echo "<div align=\"center\"><strong>Done</strong>, Post Deleted, you will now be taken back.<br />
						<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
						<script language=\"javascript\" type=\"text/javascript\">
						setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
						</script>";
			} else
				{
					echo "<div align=\"center\"><strong>Denied</strong>, you do not have permission to Edit or Delete!<br />
							<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
							<script language=\"javascript\" type=\"text/javascript\">
							setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
							</script>";
				}
			break;
			case "impressum":
			echo "<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  					<tr>
    					<td class=\"dialogue\"><div align=\"center\">
      					<p><br />
          				<a href=\"http://validator.w3.org/check/referer\" target=\"_blank\"><img src=\"images/xhtml1.gif\" alt=\"\" width=\"80\" height=\"15\" border=\"0\" /></a>&nbsp;<a href=\"http://jigsaw.w3.org/css-validator/check/referer\" target=\"_blank\"><img src=\"images/css.gif\" alt=\"\" width=\"80\" height=\"15\" border=\"0\" /></a>&nbsp;<a href=\"http://www.php.net/\" target=\"_blank\"><img src=\"images/php.gif\" alt=\"\" width=\"80\" height=\"15\" border=\"0\" /></a><br />
          				<img src=\"images/txt.gif\" alt=\"\" width=\"80\" height=\"15\" />&nbsp;<a href=\"http://www.opensource.org/\" target=\"_blank\"><img src=\"images/opensource.gif\" alt=\"\" width=\"80\" height=\"15\" border=\"0\" /></a>&nbsp;<img src=\"images/56kfriendly.gif\" alt=\"\" width=\"80\" height=\"15\" /><br />
          				<a href=\"http://www.knoxious.co.uk/\" target=\"_blank\"><img src=\"images/xanmanning.gif\" alt=\"\" width=\"80\" height=\"15\" border=\"0\" /></a><br />
          				<br />".$boxname." Powered by k.N2Tag v".$version."<br />&copy; Xan Manning ".date("Y").".
      					</p>
    					</div></td>
  					</tr>
				</table>";
			break;
			case "edit";
			if(@$_POST['Save'])
					{
						$string = $_POST['datetime']."|".$_POST['ip']."|".safeCredentials($_POST['username'])."|".safeCredentials($_POST['email'])."|".safeCredentials($_POST['url'])."|".cleanPost($_POST['msg']);
						postEdit($txt_filename, $_GET['dt'], $string);
						echo "<div align=\"center\"><strong>Done</strong>, Post Edited, you will now be taken back.<br />
						<a href=\"".$_SERVER['PHP_SELF']."\">Click here if not redirected in 5 Seconds.</a></div>
						<script language=\"javascript\" type=\"text/javascript\">
						setTimeout(\"window.location = '".$_SERVER['PHP_SELF']."';\", 5000);
						</script>";
					} else {
						editEntry($txt_filename, $_GET['dt']);
					}
			break;
			case "all":
			if($page = "all")
				{
					$shouts = 10000000;
				}
			displayTxt($txt_filename);
			echo "<div align=\"center\"><input type=\"button\"
			onclick=\"javascript:history.back();\" name=\"Back\" class=\"button\" value=\"Back\" /></div>";
			break;
			default:
				$cname = stripslashes($_COOKIE['name']);
					if($cname == NULL)
						{
							$cname = "Name";
						}
				$cemail = stripslashes($_COOKIE['email']);
					if($cemail == NULL)
						{
							$cemail = "Email";
						}
				$curl = stripslashes($_COOKIE['url']);
					if($curl == NULL)
						{
							$curl = "URL";
						}
				$wname = stripslashes($_COOKIE['name']);
				$welcome = "<strong>Welcome</strong> ".stripslashes($wname);
									
			echo "<form name=\"form1\" id=\"form1\" method=\"post\" action=\"?p=post\" onsubmit=\"return checkForm(this);\">
  					<div align=\"center\">".$welcome."
					<br /><br />".displayTxt($txt_filename)."</div>
						<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   							<tr>
     							<td><input type=\"text\" name=\"username\" class=\"input\" id=\"username\" maxlength=\"32\" value=\"$cname\" onfocus=\"if(this.value=='Name')this.value='';\" onblur=\"if(this.value=='')this.value='Name';\" /></td>
    						</tr>
    						<tr>
      							<td><input type=\"text\" name=\"email\" class=\"input\" id=\"email\" maxlength=\"32\" value=\"$cemail\" onfocus=\"if(this.value=='Email')this.value='';\" onblur=\"if(this.value=='')this.value='Email';\" /></td>
    						</tr>
    						<tr>
      							<td><input type=\"text\" name=\"url\" class=\"input\" id=\"url\" maxlength=\"32\" value=\"$curl\" onfocus=\"if(this.value=='URL')this.value='';\" onblur=\"if(this.value=='')this.value='URL';\" /></td>
    						</tr>
    						<tr>
      							<td><input type=\"text\" name=\"msg\" class=\"input\" id=\"msg\" maxlength=\"$taglength\" value=\"Message\" onfocus=\"if(this.value=='Message')this.value='';\" /></td>
    						</tr>
    						<tr>
      							<td colspan=\"2\"><div align=\"center\"><br />
        							<input type=\"submit\" name=\"Submit\" value=\"Submit\" class=\"button\" />
        							<input type=\"reset\" name=\"Reset\" value=\"Reset\" class=\"button\" />
      							</div></td>
    						</tr>
							<tr>
      							<td colspan=\"2\"><div align=\"center\">
									<a href=\"?p=all\">View All</a> &mdash; 
        							<a href=\"#\" onclick=\"bb=window.open('?p=bbcode', 'BBCode', 'width=320, height=400, scrollbars=yes'); return false;\">Smilies</a> &mdash;
									<a href=\"#\" onclick=\"bb=window.open('?p="; if(isset($admin)){ echo "logout"; } else { echo "admin"; } echo "', 'Admin', 'width=350, height=50, scrollbars=yes'); return false;\">";
									if(isset($admin)){ echo "Logout"; } else { echo "Admin Login"; }
									echo "</a>
      							</div></td>
    						</tr>
  					</table><div align=\"center\">
				<a href=\"#\" onclick=\"window=window.open('?p=impressum', 'Impressum', 'width=300, height=140'); return false;\">
				<img src=\"images/knoxious.gif\" alt=\"\" width=\"80\" height=\"15\" border=\"0\" /></a></div>
				</form>";
		}
		echo '</body>
			</html>';
?>