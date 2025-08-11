<?php

/************************************************************************/
/* G-Shout : Gravitasi Shoutbox                                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2005 by Yohanes Pradono                                */
/* http://gravitasi.com                                                 */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

// to prevent direct access
if (eregi("functions.inc.php",$_SERVER['PHP_SELF'])) {           
	die("<b>Access Denied!</b><br /><i>You can't access this file directly...</i><br /><br />- G-Shout -");
}

// functions to count the page generation time (from phpBB2)
// ( or just any time between timer_start() and timer_stop() )

function timer_start() {
    global $timestart;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timestart = $mtime;
    return true;
}

function timer_stop($display=0,$precision=3) { //if called like timer_stop(1), will echo $timetotal
    global $timestart,$timeend;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timeend = $mtime;
    $timetotal = $timeend-$timestart;
    if ($display)
        echo number_format($timetotal,$precision);
    return $timetotal;
}

//starting to count the page generation time
timer_start();

include("./includes/globals.inc.php");
include("config.php");
include("./languages/lang-".$language.".php");

// format date with GMT different
function formattanggal($tgl) {
	global $gmt,$dateformat;
	$timeadjust = ($gmt * 60 * 60);
	$waktu = gmdate($dateformat,$tgl + $timeadjust);

	//days
	$waktu = str_replace("Sunday", _SUNDAY, $waktu);
	$waktu = str_replace("Monday", _MONDAY, $waktu);
	$waktu = str_replace("Tuesday", _TUESDAY, $waktu);
	$waktu = str_replace("Wednesday", _WEDNESDAY, $waktu);
	$waktu = str_replace("Thursday", _THURSDAY, $waktu);
	$waktu = str_replace("Friday", _FRIDAY, $waktu);
	$waktu = str_replace("Saturday", _SATURDAY, $waktu);

	//months
	$waktu = str_replace("January", _JANUARY, $waktu);
	$waktu = str_replace("February", _FEBRUARY, $waktu);
	$waktu = str_replace("March", _MARCH, $waktu);
	$waktu = str_replace("April", _APRIL, $waktu);
	$waktu = str_replace("May", _MAY, $waktu);
	$waktu = str_replace("June", _JUNE, $waktu);
	$waktu = str_replace("July", _JULY, $waktu);
	$waktu = str_replace("August", _AUGUST, $waktu);
	$waktu = str_replace("September", _SEPTEMBER, $waktu);
	$waktu = str_replace("October", _OCTOBER, $waktu);
	$waktu = str_replace("November", _NOVEMBER, $waktu);
	$waktu = str_replace("December", _DECEMBER,$waktu);
 
    return $waktu;
}


/* function to display random images,
 * borrowed from rid.php script by Nenad Motika [nmotika@bezveze.com]
 * URL : http://www.bezveze.com/skripte/rid/
 */
function displayRandomImage($dirname) {
	$folder=opendir($dirname);
	while ($file = readdir($folder)) $names[count($names)] = $file;
	closedir($folder);//sort file names in array
	sort($names);
	//remove any non-images from array
	$tempvar=0;
	for ($i=0;$names[$i];$i++){
		$ext=strtolower(substr($names[$i],-4));
		if ($ext==".jpg"||$ext==".gif"||$ext=="jpeg"||$ext==".png"){
			$names1[$tempvar]=$names[$i];$tempvar++;
			}
		}
//random
srand ((double) microtime() * 10000000);
$rand_keys = array_rand ($names1, 2);
//random image from array
$slika=$names1[$rand_keys[0]]; 
//image dimensions
$dimensions = GetImageSize($dirname.$slika);
//if (isset($pic)){header ("Location: $slika");}      //original, commented out
//else {echo "<img src=\"$slika\" $dimensions[3]>";}  //original, commented out
$imageurl = $dirname.$slika;                          //added this
  return $imageurl;                                   //added this

}
#####################

// function to check website / email address
function check_uri($address) {
	return eregi('^([:/~@a-zA-Z0-9_\-\.]+)\.([:/~a-zA-Z0-9]+)$',$address);
}

//funtion to encode email address
function hex_encode($email_address) {
	for ($x=0; $x < strlen($email_address); $x++) {
		$encoded .= '%' . bin2hex($email_address[$x]);
		}
return $encoded; 
} 
function hexentity_encode($email_address) {
	for ($x=0; $x < strlen($email_address); $x++) {
		$encoded .= '&#x' . bin2hex($email_address[$x]);
		}
	return $encoded;
}

function remQuote($theQ) {
	$trans = array ("\'" => "'", "\\\"" => "\"");
	return strtr(chop($theQ), $trans);
}

/****************************************************************
these 2 functions are used to view shoutbox in frontpage side
*****************************************************************/
// to format the table layout
function content($id,$com,$nam,$sex,$uri,$timestamp,$ip,$reply,$redate) {
	global $hr, $namaadmin, $deletetime, $adminweb, $entry, $require_uri, $gmt;
	$com = remQuote($com);
	if($hr == "yes") {
		$hrbar = "<hr align=\"center\" />";
	} else {
		$hrbar = "";
	}
	
	if ($sex == "m") {
		$urlsexm = displayRandomImage("images/male/");
		$sex = "<img alt=\""._MALE."\" title=\""._MALE."\" src=\"$urlsexm\" width=\"24\" height=\"24\" />";
	} else if ($sex == "f") {
		$urlsexf = displayRandomImage("images/female/");
		$sex = "<img alt=\""._FEMALE."\" title=\""._FEMALE."\" src=\"$urlsexf\" width=\"24\" height=\"24\" />";
	} else {
		$sex = "<img alt=\"unknown\" title=\"unknown\" src=\"images/unknown.gif\" width=\"24\" height=\"24\" />";
	}
	
	// older shouts before version 1.0 won't be processed by formattanggal()
	if (is_numeric($timestamp)) {
		$tgltime = $timestamp;
		$tgl = formattanggal($timestamp);
		} else {
			$tgl = $timestamp;
	}
	
	// check the $gmt value
	if(substr($gmt,0,1)=="-"){
	$tz_info = "(GMT".$gmt.")";
	}else if($gmt == "0") {
	$tz_info = "(GMT)";
	} else {
	$tz_info = "(GMT+".$gmt.")";
	}
			
		$style = ($entry % 2) ? 'tableCellOne' : 'tableCellTwo';
		echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"$style\"><tr><td title=\""._SHOUTED_ON." ".$tgl." ";
		echo $tz_info;
		echo "\"><p align=\"justify\">$sex&nbsp;";

		if(empty($uri)){
			echo ("<b>$nam</b>");
		} else {
				$uri = strip_tags(checkUri(chop($uri)));
				echo ("<a href=\"$uri\" target=\"_blank\">$nam</a>");
		}

			echo ": $com </p></td><tr><td>";
		
		if (($ip == $_SERVER["REMOTE_ADDR"]) && ($timestamp > time()-ceil($deletetime*60))){
			echo "<a class=\"delete\" href=\"shoutbox.php?action=deleteshout&amp;id=$id\" onclick=\"return confirm('You are about to delete this shout \\n  \'OK\' to delete, \'Cancel\' to stop.')\">delete</a>";
			}
			
		echo "</td></tr>";
		if ($reply!=""){
			echo "<tr><td title=\""._REPLIED_ON." ".formattanggal($redate)." ";
			echo $tz_info;
			echo "\"><i><a href=\"#\">$namaadmin</a> : $reply</i></tr></td>";
			}
		echo "</table>$hrbar";

} //end of showTag

/********************************************
FUNCTION TO SHOW THE SHOUTS FROM FRONT PAGE
*********************************************/
function viewShoutBox() {
	global $datafile, $page, $commentshown, $smileys, $smileydir, $maxchars, $allowedtags, $usesmiley, $useHTMLencode, $textwrappingwidth, $namaadmin, $help;

// pagination system
if (!isset($page)||$page==0) {
	$page=1;
}
$entry = ($commentshown * $page)-$commentshown;
$selesai = $commentshown*$page;

$d = array();
require_once($datafile);


	array_walk ($smileys, 'alter_smiley', $smileydir);
	reset ($smileys);
	while (chop($d[$entry]) != "" && $help != true && $entry < $selesai) {
		$temporary = explode("#%", $d[$entry]);
		$id = $temporary[0];
		$com = $temporary[1];

		if($maxchars != "" && $maxchars > 0) {
			$com = substr ($com, 0, $maxchars);
		} else {

		}
		
		if($allowedtags == "") {
			$com = htmlspecialchars($com);
		}

//		$transi = array ("< " => "&lt; ", " >" => " &gt;");
//		$com = strtr(chop($com), $transi);

		$com = strip_tags(chop($com), $allowedtags);
		if($usesmiley == "yes") {
			$com = strtr($com, $smileys);
		}
		if($useHTMLencode == "yes") {
			$com = HTMLEncode($com);
		}
		if($textwrappingwidth != "0"){
			$com = ww1($com);
		}

if($temporary[1] != $namaadmin){
$nam = ucfirst(chop($temporary[2]));//nama hurup gede untuk tamu
}else{
$nam = chop($temporary[2]);
}
		//if($usetextwrapping) {
		if($textwrappingwidth != "0"){
			$nam = ww2($nam);
		}
		$nam = stripslashes(strip_tags($nam));//added this
		$nam = htmlspecialchars($nam);
		$sex = $temporary[3];
		$uri = $temporary[4];
		$tgl = $temporary[5];
		$ip = $temporary[6];
		$reply = $temporary[7];
		if($usesmiley == "yes") {
			$reply = strtr($reply, $smileys);
			}
		if($textwrappingwidth != "0"){
			$reply = ww1($reply);
			//$reply = ww2($reply);
		}
		$redate = $temporary[8];

		content($id,$com,$nam,$sex,$uri,$tgl,$ip,$reply,$redate);
		$entry++;
	} // end while

}// end of viewShoutBox()

//function to show Shout Entry from Control Panel
function showEntryfromCPanel($id,$com,$nam,$sex,$uri,$timestamp,$ip,$reply,$redate) {
	global $entry, $status, $page, $usesmiley, $smileys, $smileydir ;
	$style = ($entry % 2) ? 'tableCellOne' : 'tableCellTwo';

	if ($sex == "m"){
		$esex = _M;
	}else if($sex == "f"){
		$esex = _F;
	} else {}
	
	if ($redate != ""){
		$formatted_redate = formattanggal($redate);
		} else {
			$formatted_redate = "";
	}

if ($id != ""){
echo "
<tr>

<td class=\"$style\">
$id
</td>

<td class=\"$style\">
".formattanggal($timestamp)."
</td>

<td class=\"$style\">
".wordwrap_cpanel(htmlentities($com))."
</td>

<td class=\"$style\">
$nam
</td>

<td class=\"$style\">
$esex
</td>

<td class=\"$style\">
$ip
</td>

<td class=\"$style\">
<a href=\"".checkUri($uri)."\" target=\"_blank\">$uri</a>
</td>

<td class=\"$style\">
$formatted_redate
</td>

<td class=\"$style\">
<div style=\"color: rgb(0, 153, 51);\">".wordwrap_cpanel($reply)."</div>
</td>

<td class=\"$style\">
<!--
<a href=\"editshout.php?id=$id&amp;page=$page\">"._EDIT."</a>
-->
<a href=\"javascript:void(0)\" onclick=\"window.open('pop_editshout.php?id=$id&amp;page=$page','editshout','width=400,height=500,location=0,menubar=0,toolbar=0,scrollbars=yes,resizable=0,status=1,screenx=245,screeny=102')\" >"._EDIT."</a>
</td>

<td class=\"$style\">
<input class=\"checkbox\" name=\"toggle[]\" value=\"$id\" type=\"checkbox\">
</td>

</tr>
";
}

}

/**************************************************** 

main function writeTag() to write into Database File

*****************************************************/
function writeTag($nama, $kelamin, $uri, $comment) {
	global $datafile, $commentshown, $keep, $namaadmin, $errors, $gnama, $gsex, $guri, $gcomment, $ccmail, $bccmail, $emailaddress, $body, $extra_hdr_str, $require_uri;

	$trans = array ( "\n" => "<br />", "\r" => " ", "#%" => "");

	if (!is_writeable($datafile)) {
//		echo("<b>Unable to inisiate command.</b><br />It is either the file \"$datafile\" doesn't exist or the file is not set to writeable. Please refer to config file on how.<br /><br />");
//		chmod($datafile, 0666 );  
//		$file = fopen($datafile, "w+");
//		fwrite($file, $comment."#%");
//		fwrite($file, "$nama#%$uri#%".gettanggal()."#%\n");
//		fclose($file);

	} else if (chop($nama) == '' || chop($uri) == '' || chop($comment) == '') {
		echo("<div class=\"alert\"><b>Error!</b><br /><i>"._ERROR_EMPTY."</i></div><br /><br />");
	}
	else if ($_POST['gname'] == _DEFAULT_NAME || $nama == "") {// if the name field = default value 
		echo("<div class=\"alert\"><b>Error!</b><br /><i>"._ERROR_NAME."</i></div><br /><br />");
	}
	else if ($kelamin == '' && $nama != $namaadmin) {// kalau nama bukan nama admin dan jenis kelamin kosong
		echo("<div class=\"alert\"><b>Error!</b><br /><i>"._ERROR_SEX."</i></div><br /><br />");
	}
	//pikiren dewe, males njelaske
	else if(($uri == _DEFAULT_URI || !check_uri($_POST['guri'])) && $require_uri == "yes") {
		  echo("<div class=\"alert\"><b>Error!</b><br /><i>"._ERROR_URI."</i></div><br /><br />");
	}
	else if ($comment == _DEFAULT_MESSAGE || $comment == "") {      
		echo("<div class=\"alert\"><b>Error!</b><br /><i>"._ERROR_MESSAGE."</i></div><br /><br />");
	} 

	else {
		// if user's name same with admin name
		if ($nama == $namaadmin) {
		$nama = $nama."-";
		}
		//sampek sini
		$comment = strtr(chop($comment), $trans);
		$comment = stripslashes($comment);
		$uri = strtr(chop($uri), $trans);
		if(($uri == _DEFAULT_URI || empty($_POST['guri'])) && $require_uri == "no"){
		$uri = "";
		}
		$nama = strtr(chop($nama), $trans);
        $nama = stripslashes($nama);
		$kelamin = strip_tags($kelamin);

		$fp = fopen($datafile, "r");

		//to give the unique ID number
		include_once($datafile);
        $ex = explode("#%",$d[0]);
		$id = $ex[0]+1;

	while (!feof($fp)){
		$data = fgets($fp, filesize($datafile));
            if (substr($data,0,2) == "<?") {
                $output[] = "<?php\n\$d[] = \"$id#%$nama#%$kelamin#%$uri#%".time()."#%".$_SERVER["REMOTE_ADDR"]."#%#%#%\";\n";
			} else if (substr($data,0,2) == '?>'){
				$output[] = "";
			} else {//nothing happened
				$output[] = $data;
			}
	}//end while
        fclose($fp);
        $fp = fopen($datafile,"w");
		if($fp){
        //foreach ($output as $data){
        //    fwrite ($fp, $data);
        //}

		for ($i=0;$i<$keep;$i++){
			fwrite ($fp, $output[$i]);
		}
		fwrite($fp, "?>");
		fclose($fp);
		}

############### to send email
	if ($sendcomments == "yes") {
	$extra_hdr_str = "From: G-Shout ".$version." <g-shout@".$_SERVER['HTTP_HOST']."> \r\nCc: $ccmail \r\nBcc: $bccmail \r\nContent-type: text/html\r\nX-Mailer: PHP/" .phpversion();

	$body = "<p align=\"center\">Name: $gname <br /><br /> Sex: $gsex <br /><br /> Web/Email: $guri <br /><br /> Message: $gcomment <br /><br /> IP address: ".$_SERVER["SERVER_NAME"]." <br /><br /><br /> powered by <a href=\"http://g-shout.sourceforge.net\"> target=\"_blank\">G-Shout ".$version."</a></p>";

    $name = $nama;
	$nick = $nama;
	$subject = _EMAIL_SUBJECT;

	mail($emailaddress,$subject,$body,$extra_hdr_str);
	}
############### 
	}
}

function sheep_wordwrap($str,$cols,$non_prop,$cut,$exclude1,$exclude2){
  $count=0;
  $tagcount=0;
  $str_len=strlen($str);
  //$cut=" $cut ";
  $calcwidth=0;
  
  for ($i=0; $i<=$str_len;$i++){
    $str_len=strlen($str);
    if ($str[$i]==$exclude1)
      $tagcount++;
    elseif ($str[$i]==$exclude2){
      if ($tagcount>0)
        $tagcount--;
    }
    else{
      if (($tagcount==0)){
        if (($str[$i]==' ') || ($str[$i]=="\n"))
          $calcwidth=0;
        else{
          if ($non_prop){
            if (ereg("([QWOSDGCM#@m%w]+)",$str[$i],$matches))
              $calcwidth=$calcwidth+7;
            elseif (ereg("([I?\|()\"]+)",$str[$i],$matches))
              $calcwidth=$calcwidth+4;
            elseif (ereg("([i']+)",$str[$i],$matches))
              $calcwidth=$calcwidth+2;
            elseif (ereg("([!]+)",$str[$i],$matches))
              $calcwidth=$calcwidth+3;
            elseif (ereg("([&#x]+)",$str[$i],$matches))// hexentity
              $calcwidth=$calcwidth+2;
            else{
              $calcwidth=$calcwidth+5;
            }
          }
          else{
            $calcwidth++;
          }
          if ($calcwidth>$cols){
            $str=substr($str,0,$i).$cut.substr($str,$i,$str_len-1);
            $calcwidth=0;
          }
        }
      }
    }
  }
  return $str;
}

function ww1($stri) {
	global $textwrappingwidth, $wrappingseparator;
	$tempe = sheep_wordwrap($stri, $textwrappingwidth, true, $wrappingseparator,"<",">");
	return $tempe;
}

function ww2($stri) {
	global $textwrappingwidth, $wrappingseparator;
	$tempe = sheep_wordwrap($stri, round($textwrappingwidth*2/3), true, $wrappingseparator,"<",">");
	return $tempe;
}

$wordwrap_width = "130";// you can change this value for text wordwrap width inside Control Panel
function wordwrap_cpanel($stri) {
	global $wordwrap_width;
	$tempe = sheep_wordwrap($stri, $wordwrap_width, true, "- ","<",">");
	return $tempe;
}

function alter_smiley (&$item1, $key, $prefix) {
	$item1 = "<img alt=\"\" src=\"$prefix$item1\" align=\"middle\" border=\"0\" />";
}

function checkUri ($theUri) {
	if(!stristr($theUri, "@")) {
		$theUri = strtolower($theUri);
		if ( substr ($theUri, 0, 7) != "http://") {
			$theUri = "http://" . $theUri;
		}
	} else {
		$theUri = hex_encode($theUri); //buat mengencode email ke hex
		$theUri = "mailto:" . $theUri;
			}
	return $theUri;
}

function maximumCharacters() {
	global $maxchars;
	$tempe;
	if ($maxchars > 0) {
		$tempe = " maxlength=" . $maxchars . " ";
	}
	return $tempe;
}

function HTMLEncode($text) {
	global $urltextreplacement;
  $searcharray =  array(
   "'([-_\w\d.]+@[-_\w\d.]+)'",
   "'((?:(?!://).{3}|^.{0,2}))(www\.[-\d\w\.\/]+)'", 
   "'(http[s]?:\/\/[-_~\w\d\.\/]+)'");
  preg_match("([-_\w\d.]+@[-_\w\d.]+)", $text, $emailaddr);
  $hexmail = hex_encode($emailaddr[0]);
  $hexentemail = hexentity_encode($emailaddr[0]);
	if($urltextreplacement != '') {
		$replacearray = array(
		"<a href=\"mailto:$hexmail\">[MAIL]</a>",
		"\\1http://\\2",
		"<a target=_blank href=\"\\1\">$urltextreplacement</a>");
	} else {
		$replacearray = array(
		"<a href=\"mailto:$hexmail\">$hexentemail</a>",
		"\\1http://\\2",
		"<a target=_blank href=\"\\1\">\\1</a>");
	}
  
  return preg_replace($searcharray, $replacearray, stripslashes($text) );
}

function showHelp() {
	global $allowedtags, $usesmiley, $useHTMLencode, $urltextreplacement, $emailtextreplacement;
	echo("<center><b>Tags allowed</b>:<br />\n");
	if($allowedtags == "") {
		echo("All tags will be turned into HTML special tags");
	} else {
		echo(htmlspecialchars($allowedtags));	 
	}
	echo("</center><br /><br />\n\n");
	if($usesmiley) {
		echo("<center><b>Emoticons</b>:\n<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">\n");
		echo list_smileys2();
		echo "</table>\n";
		echo "<div id=\"yahoo\">Emoticons by <a href=\"htttp://www.yahoo.com\" target=\"_blank\">Yahoo!</a></div></center><br /><br />\n\n";
	}
	if($useHTMLencode) {
		echo("<center><b>HTML Encoding</b>:<p align=\"justify\">
You can type www.yoursite.com or email email@yoursite.com on shoutbox form and will be automatically changed to ");
		if($urltextreplacement == '') {
			echo("<a href=\"http://www.yoursite.com\" target=\"_blank\">http://www.yoursite.com</a> or <a href=\"mailto:".hex_encode('email@yoursite.com')."\">email@yoursite.com</a>.");
		}
		else {
			echo("<a href=\"http://www.yoursite.com\" target=\"_blank\">$urltextreplacement</a> or <a href=\"mailto:".hex_encode('email@yoursite.com')."\">[MAIL]</a>.");
		}
		echo("<br /> All email addresses will be encoded to prevent spamming.");
		echo("</p></center><hr />\n");
	}
}

function showEmoticons() {
	global $usesmiley, $smileys;
	if($usesmiley) {
		echo("<br /><center><b>Emoticons</b>:\n<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\"><br /><br />\n");
		$i = 1;
		while (list ($key, $value) = each ($smileys)) {
			if($i==1){
				$str .= "<tr>\n";
			}
		$key = htmlentities($key);
		$str .= "<td align=\"center\" valign=\"middle\"><a class=\"icon\" href=\"#\" onclick=\"add_smiley_cp('$key')\">$value</a> &nbsp; </td>\n";

		if($i==4){
			$str .= "</tr>\n";
			$i = 1;
		} else {
			$i++;
		}

		}//end while

		echo $str;
		echo "</table><br /><br />\n";
	}
}

function list_smileys () {
	global $smileys;
	while (list ($key, $value) = each ($smileys)) {
		$str .= "<tr><td align=\"center\" valign=\"middle\" width=\"50%\"> &nbsp; $key &nbsp; </td><td align=\"center\" valign=\"middle\" width=\"50%\"> &nbsp; $value &nbsp; </td></tr>\n";
	}
	return $str;
}
function list_smileys2() {
	global $smileys;
	while (list ($key, $value) = each ($smileys)) {
		$key = htmlentities($key);
		$str .= "<tr><td align=\"center\" valign=\"middle\" width=\"50%\"> &nbsp; $key &nbsp; </td><td align=\"center\" valign=\"middle\" width=\"50%\"> &nbsp; <a class=\"icon\" href=\"#\" onclick=\"add_smiley('$key')\">$value</a> &nbsp; </td></tr>\n";
	}
	return $str;
} 

# these functions below borrowed from Shoutbox by Brett Taylor - http://www.addict.net.nz/~glutnix

function getIP($id) {
    global $datafile;
    $shouts = file($datafile); // read in shouts for count
    //for ($count=$start;$count<=$finish;$count++) { // original
	for ($count=0;$count<=count($shout);$count++) { // modified by donie
        $csvdata = explode("#%",$shouts[$count]);
        if ($csvdata[0] == $id) {
            break;
        }
    }
    return $csvdata[6];
}

// for making Cookie
function makeCookie($password) {
	global $admin_password, $autologout;
	if($password == $admin_password){
		$value = sha1($password);
		if(trim($autologout) == "" || $autologout == "0"){
		setcookie("gshout_auth", $value);
		} else {
		setcookie("gshout_auth", $value, time() + ceil($autologout*60), "/");
		}
    }
}
function delCookie() {
	global $autologout;
		if(trim($autologout) == "" || $autologout == "0"){
			setcookie("gshout_auth", "");
		} else {
			setcookie("gshout_auth", "", time() - ceil($autologout*60), "/");
		}
}

function validCookie($cookiedata) { // for authentication
	global $admin_password;
	if ($cookiedata == sha1($admin_password)) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function updateShout($id,$shout,$nick,$sex,$url,$timestamp,$ip,$reply) {
    global $datafile, $message;
	$newfile = array();
    $shouts = fopen ($datafile, "r");
    $nick = str_replace("#%","",$nick);
    $shout = str_replace("#%","",$shout);
	$shout = str_replace("\n"," ",$shout);
    $url = str_replace("#%","",$url);

    $nick = stripslashes(trim($nick));
    $shout = stripslashes(trim($shout));
    $url = stripslashes(trim($url));
	
	$reply = str_replace("#%","",$reply);
	$reply = stripslashes(trim($reply));
	$reply = str_replace("\n"," ",$reply);

    while (!feof($shouts)) {
	    //$data = fgets($shouts, 8000);
		$data = fgets($shouts, filesize($datafile));
        $csvdata = explode("#%",$data);

		if ($csvdata[8] != "" || $reply == ""){//if reply time is not empty OR reply is empty
		$redate = $csvdata[8];
		} else {
			$redate = time();
		}

		if ($csvdata[0] == $id) {
			// found the ID, so re-write it
			$newfile[] = $id."#%".$shout."#%".$nick."#%".$sex."#%".$url."#%".$timestamp."#%".$ip."#%".$reply."#%".$redate."#%\n";
		} else {
            $newfile[] = $data;
		}
    }
    fclose ($shouts);
 	$o_shouts = fopen($datafile, "w");
	if($o_shouts){
	foreach ($newfile as $data){
		fwrite ($o_shouts, $data);
	}
	} else {
		return false;
		}
	fclose ($o_shouts);
	return true;
}
function deleteShout($id) {
    global $datafile;
	$newfile = array();
    $shouts = fopen ($datafile, "r");

$d = array();
require_once($datafile);

    while (!feof ($shouts) AND $d[$i] != '') {
	    //$data = fgets($shouts, 8000);
		$data = fgets($shouts, filesize($datafile));
        $csvdata = explode("#%",$d[$i]);
		//if ($csvdata[4] == $timestamp) {

		if (is_array($id) && in_array($csvdata[0],$id)){
			// found the ID, so don't write it
		} else if($csvdata[0] == $id){
			// found the ID, so don't write it
		} else {
			$newfile[] = $data;
		}
		$i++;

    }//end while
    fclose ($shouts);
 	$o_shouts = fopen($datafile, "w");
	foreach ($newfile as $data){
		fwrite ($o_shouts, $data);
	}
	fclose ($o_shouts);
}

//  Gets range of shouts from datafile
function getShouts ($start,$number,$dir) {
    global $datafile;
	//echo "getShouts:".$start.", ".$number.", ".$dir."<BR>";
    $shouts = file($datafile); // read in shouts for count
    for ($count=$start;$count<=$start+$number;$count++) {
        $csvdata = explode("#%",$shouts[$count]);
        $output[$count-$start]= array( 'id' => $csvdata[0],
			                           'com' => $csvdata[1],
                                       'nam' => $csvdata[2],
                                       'sex' => $csvdata[3],
                                       'uri'  => $csvdata[4],
                                       'timestamp' => $csvdata[5],
									   'ip' => $csvdata[6],
			                           'reply' => $csvdata[7],
                                     );
    }
    if ($dir == -1) {
        $output= array_reverse($output);
    }
    return $output;
}
function countShouts() {
    global $datafile;
	$shouts = file($datafile); // read in shouts for count
	$shouts = array_filter($shouts, "trim"); // remove arrays with empty value
	//echo "countShouts=".count($shouts)."<BR>";
    return count($shouts);
}

//function to update config file, not used
function updateConfig($variable,$value) {
	$baris = array();
    $fp = fopen ("config.php", "r");
    while (!feof ($fp)) {
		$data = fgets($fp, filesize("config.php"));
        $configdata = explode("=",$data);
		if ($configdata[0] == "$".$variable) {
			// found the variable, so re-write it
			$baris[] = $variable.' = "'.$value.'";\n';
			} else {
            $baris[] = $data;
			}
    }
    fclose ($fp);
 	$o_config = fopen("config.php", "w");
	if($o_config){
	foreach ($baris as $data){
		fwrite ($o_config, $data);
	}}
	fclose ($o_config);
}

function optionLanguages(){
	global $language;
	$handle=opendir("languages");
    while ($file = readdir($handle)) {
	if (ereg("^lang\-(.+)\.php$", $file, $matches)) {
            $langFound = $matches[1];
            $languageslist .= "$langFound ";
        }
    }
    closedir($handle);
    $languageslist = explode(" ", $languageslist);
    sort($languageslist);
    for ($i=0; $i < sizeof($languageslist); $i++) {
	if($languageslist[$i]!="") {
	    echo "<option value=\"$languageslist[$i]\" ";
		if($languageslist[$i]==$language) echo "selected=\"selected\"";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	}
	}
}

function optionSkins(){
	global $skin;
	$handle=opendir("skins");
    while ($file = readdir($handle)) {
	if (ereg("^(.+)\.css$", $file, $matches)) {
            $skinFound = $matches[1];
            $skinslist .= "$skinFound ";
        }
    }
    closedir($handle);
    $skinslist = explode(" ", $skinslist);
    sort($skinslist);
    for ($i=0; $i < sizeof($skinslist); $i++) {
	if($skinslist[$i]!="") {
	    echo "<option value=\"$skinslist[$i]\" ";
		if($skinslist[$i]==$skin) echo "selected=\"selected\"";
		echo ">".ucwords(str_replace("_"," ",$skinslist[$i]))."</option>\n";
	}
	}
}


# functions below is Log system
function writeLogs_php($ip, $action, $value) {
	global $secret_dir, $lastlogs;
	$fp = fopen($secret_dir."/logs.php","r");
	$value = base64_encode($value);
	while (!feof($fp)){
		$data = fgets($fp, filesize($secret_dir."/logs.php"));
            if (substr($data,0,2) == '<?') {
                $output[] = "<?php\n\$log[] = \"".time()."#%$ip#%$action#%$value#%\";\n";
            } else if (substr($data,0,2) == '?>') {
                $output[] = "";
			} else {//nothing happened
				$output[] = $data;
			}
	}//end while
        fclose($fp);
        $fp = fopen($secret_dir."/logs.php","w");
		if($fp){
        //foreach ($output as $data){
        //    fwrite ($fp, $data);
        //}
		for ($i=0;$i<$lastlogs;$i++){
			fwrite ($fp, $output[$i]);
			if ($i == $lastlogs-1){
				fwrite($fp, "?>");
			}
		}
		fclose($fp);
}
}

function viewLogs($timestamp,$ip,$action,$value){
	global $i;
	$value = base64_decode($value);
	$value = str_replace(">","&gt;",$value);
	$style = ($i % 2) ? 'tableCellOne' : 'tableCellTwo';

if ($timestamp != ""){
echo "
<tr>
<td  class='$style' >
".formattanggal($timestamp)."
</td>
<td  class='$style' >
$ip
</td>
<td  class='$style' >
$action
</td>
<td  class='$style' >
$value
</td>
</tr>
";
}

}

function countLogs() {
    global $logfile;
	$logs = file($logfile);
	$logs = array_filter($logs, "trim"); // remove arrays with empty value
    return count($logs);
}

// function for new antiflood system, started from v1.1
function getTimestampByIP($ip){
    global $datafile;
	$newfile = array();
    $shouts = fopen ($datafile, "r");
    while (!feof ($shouts)) {
		$fs = filesize($datafile);
		if(filesize($datafile) == "0"){
			$fs = "4096";
		}else{
			$fs = filesize($datafile);
		}
		$data = fgets($shouts, $fs);
        $csvdata = explode("#%",$data);
		if ($csvdata[6] == $ip) {
			$timestamp = $csvdata[5];
			break;
		}
    }//end while
	return $timestamp;
}

// give 1 line shout using $id
function getShoutByID($id){
    global $datafile, $com, $nam, $sex, $uri, $timestamp, $ip, $reply, $redate;
	$newfile = array();
    $shouts = fopen ($datafile, "r");
    while (!feof ($shouts)) {
		$fs = filesize($datafile);
		if(filesize($datafile) == "0"){
			$fs = "4096";
		}else{
			$fs = filesize($datafile);
		}
		$data = fgets($shouts, $fs);
        $temporary = explode("#%",$data);
		if ($temporary[0] == $id) {
			$com = htmlentities($temporary[1]);
			$nam = $temporary[2];
			$sex = $temporary[3];
			$uri = $temporary[4];
			$timestamp = $temporary[5];
			$ip = $temporary[6];
			$reply = $temporary[7];
			$redate = $temporary[8];
			break;
		}
    }//end while
}

?>