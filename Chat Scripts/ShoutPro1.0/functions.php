<?php

/*
SHOUTPRO 1.0 - functions.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is functions.php.  It contains functions essential to ShoutPro.  There is no need to modify this file.
*/

function copyrighttext(){
	echo ("	<div align='center'><font size='1'>
			Powered by 
			<a href='http://www.shoutpro.com' target='_blank'>ShoutPro 1.0</a> 
			</font></div>
			");
}

function length($shout,$minlength,$maxlength){
	if (strlen($shout) < $minlength){
		echo ("	<script language='JavaScript'>\n
				alert('Sorry, your shout must be at least $minlength characters long.');\n
				location.href='shoutbox.php';\n
				</script>");
		return false;
	} else if (strlen($shout) > $maxlength){
		echo ("	<script language='JavaScript'>\n
				alert('Sorry, your shout must be nore more than $maxlength characters long.');\n
				location.href='shoutbox.php';\n
				</script>");
		return false;
	} else {
		return true;
	}
}

function badname($name){
	$name = strtolower($name);
	$badnames = file("lists/badnames.php");
	foreach($badnames as $value) {
	  list($badname) = explode ("|^|",$value);
		if($name == $badname) {
			include ("config.php");
			echo "<script>alert('$badnamemessage');\n";
			echo "location.href='shoutbox.php';</script>";
			exit;
		}
	}
}

function thecheck($value){
	if (str_replace("|^|","|*|",$value)!=$value){
		return TRUE;
	} else {
		return FALSE;
	}
}

function first($shout){
	$shout = str_replace("|^|","|*|",$shout);
	return $shout;
}

function killhtml($shout){
	//This function searches the shout for HTML tags and replaces them with the actual symbol.
	$shout = str_replace("<","&lt;",$shout);
	$shout = str_replace(">","&gt;",$shout);
	return $shout;
}

function killscript($value){
	$value = str_replace("<script>","&lt;*&gt;",$value);
	$value = str_replace("</script>","&lt;/*&gt;",$value);
	return $value;
}

function shoutcode($shout){
	//This function parses the ShoutCode.
	$FileName="lists/shoutcode.php";
	$list = file ($FileName);
	foreach ($list as $value) {
		list ($code,$html,) = explode ("|^|", $value);
		$shout = str_replace ($code, $html, $shout);
	}
	return $shout;
}

function smilies($shout){
	//This function searches the shout for the smilies and replaces it with the image code.
	$FileName="lists/smilies.php";
	$list = file ($FileName);
	foreach ($list as $value) {
		list ($code,$image,) = explode ("|^|", $value);
		$shout = str_replace ($code, "<img src='smilies/".$image."'>", $shout);
	}
	return $shout;
}

function profanityfilter($shout){
	//This function filters profanities from the shout.
	$FileName="lists/profanities.php";
	$list = file ($FileName);
	foreach ($list as $value) {
		list ($profanity,$filter,) = explode ("|^|", $value);
		$shout = str_replace ($profanity, $filter, $shout);
	}
	return $shout;
}

function restrictedname($name,$shout,$namepass2){
	//This function checks to see if the name is on the restricted list and prompts for a password if it is.
	$FileName="lists/names.php";
	$list = file ($FileName);
	foreach ($list as $value) {
		list ($restrictedname,$namepass,$nameemail,) = explode ("|^|", $value);
		if ($name == $restrictedname){
			if ($namepass != $namepass2){
				echo("<script>\r\n");
				echo("var enterednamepass = prompt(\"You have entered a restricted name.  Please input the password.\",\"\");\r\n");
				echo("if (enterednamepass==\"".$namepass."\"){\r\n");
				echo("location.href='shoutbox.php?action=post&name=$name&shout=$shout&namepass2=$namepass';\r\n");
				echo("}else{\r\n");
				echo("alert('Wrong password');\r\n");
				echo("location.href='shoutbox.php';\r\n");
				echo("}\r\n");
				echo("</script>\r\n");
				die;
			}
		}
	}
	return $rname;
}

function colornames($name,$namecolor){
	//This function searches to see if the username has a color assigned to it and sets the color variable if it does.
	$FileName="lists/colornames.php";
	$list = file ($FileName);
	foreach ($list as $value) {
		list ($name1,$namecolor1,) = explode ("|^|", $value);
		if ($name == $name1) {
			$namecolor = $namecolor1;
		}
	}
	return $namecolor;
}
?>