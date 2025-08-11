<?

// Write posted data to file
function writetofile($post1,$post2) {
include "config.php";
								
$msgfilename = "messages.txt";
$curdate = date('Y/m/d H:i:s');
$save = file($msgfilename);
$filename = fopen($msgfilename, "r+");
								
					if ($badlang == "1") {
					
						$badwordsfile = "badlanguage.txt";
						if (file_exists($badwordsfile)) {
		
							$handle = fopen("badlanguage.txt", "r");
	
							while (!feof($handle)) {
		
								$buffer = fgets($handle, 4096);
								$badword = explode(",", $buffer);
		
								$post1 = str_replace($badword, "****", $post1);
								$post2 = str_replace($badword, "****", $post2);
							
							} // End While
				
							fclose($handle);

								fwrite($filename, $post1."\t".$post2."\t".$curdate."\t".$_SERVER['REMOTE_ADDR']."\n");
							
								foreach ($save as $reinsert) {
								fwrite($filename, $reinsert);
								}
							
								fclose($filename);					
										
								if ($savename == "1") {
								setcookie("phpSHOUT_Cookie", $_POST["name"], time()+3600);
								}
								header('Location: '.$_SERVER['HTTP_REFERER'].'');
		
						} // End If file exists
					
					} else if ($badlang == "0") {

								fwrite($filename, $post1."\t".$post2."\t".$curdate."\t".$_SERVER['REMOTE_ADDR']."\n");
							
								foreach ($save as $reinsert) {
								fwrite($filename, $reinsert);
								}
							
								fclose($filename);					
												
								if ($savename == "1") {
									setcookie("phpSHOUT_Cookie", $_POST["name"], time()+3600);
								}
							
								header('Location: '.$_SERVER['HTTP_REFERER'].'');
					
					} else {
			
						echo "Invalid Bad Language Value. Check your config.php file.";
			
					} // End If bad Language

} // End function

// Fill fields if error appears
function fillnamevalues($posted,$defaultval) {
include "config.php";
if (isset($_POST["$posted"])) {
	echo $_POST["$posted"];
} else if (isset($_COOKIE["phpSHOUT_Cookie"]) && $savename=="1") {
	echo $_COOKIE["phpSHOUT_Cookie"];
} else {
	echo $defaultval;
}
}

function filltextvalues($posted,$defaultval) {
if (isset($_POST["$posted"])) {
	echo $_POST["$posted"];
} else {
	echo $defaultval;
}
}

// Convert smilies to images
function smiles($messagetext) {

	include "config.php";

	$sm_search = array(":d",
					   ":)",
					   ":(",
					   ":o",
					   ":shock:",
					   ":-?",
					   "8)",
					   ":lol:",
					   ":x",
					   ":p",
					   ":redface:",
					   ":cry:",
					   ":evil:",
					   ":twisted:",
					   ":roll:",
					   ";)",
					   ":!:",
					   ":?:",
					   ":idea:",
					   ":arrow:"
					   );
	$sm_replace = array("<img src=$imagepath/icon_cheesygrin.gif>",
						"<img src=$imagepath/icon_smile.gif>",
						"<img src=$imagepath/icon_sad.gif>",
						"<img src=$imagepath/icon_surprised.gif>",
						"<img src=$imagepath/icon_eek.gif>",
						"<img src=$imagepath/icon_confused.gif>",
						"<img src=$imagepath/icon_cool.gif>",
						"<img src=$imagepath/icon_lol.gif>",
						"<img src=$imagepath/icon_mad.gif>",
						"<img src=$imagepath/icon_razz.gif>",
						"<img src=$imagepath/icon_redface.gif>",
						"<img src=$imagepath/icon_cry.gif>",
						"<img src=$imagepath/icon_evil.gif>",
						"<img src=$imagepath/icon_twisted.gif>",
						"<img src=$imagepath/icon_rolleyes.gif>",
						"<img src=$imagepath/icon_wink.gif>",
						"<img src=$imagepath/icon_exclaim.gif>",
						"<img src=$imagepath/icon_question.gif>",
						"<img src=$imagepath/icon_idea.gif>",
						"<img src=$imagepath/icon_arrow.gif>"
						);
	$output = str_replace($sm_search, $sm_replace, $messagetext);
	
	return $output; 

	}

function banned_user()
{

	$banned_ip_filename = "banned_ips.txt";
	$handle = fopen($banned_ip_filename, "r");
	$ban_read =	file_get_contents($banned_ip_filename);

	// create array elements by new lines
	$ban_array = explode ("\n",$ban_read);
	// trim each element in the array
	foreach ($ban_array as $ban_key) {
		$ban_array[$ban_key] = trim($ban_key);
	}
	
	$filename = "messages.txt";

	if (file_exists($filename)) {
	
	$handle = fopen($filename, "r");
	$read = file_get_contents($filename);
	$array = explode("\n", $read);
	$totalnoofposts = count($filename);
	
	for($i=0; $i<$totalnoofposts; $i++) {
		
		if ($array[$i] != NULL || $array[$i] != "") {
			
			list($name, $msg, $date, $ip) = explode("\t", $array[$i]);
			
				if (in_array(trim($ip), $ban_array)) {
					echo "<p class=\"error\">YOUR BANNED FROM USING THIS SHOUTBOX!</p>";
					exit;
				}
		}
	}
	}

}

// Word wrapping for messages.	
function real_wordwrap($string,$width,$break)
{
   $string = preg_replace('/([^\s]{'.$width.'})/i',"$1$break",$string);
   echo $string;
   return $string;
}
?>