<?
/*
TigerTom's Affiliate Program Software (TTAPS)
http://www.tigertom.com
http://www.ttfreeware.com

Copyright (c) 2005 T. O' Donnell

Released under the GNU General Public License, with the
following proviso: 

That the HTML of hyperlinks to the authors' websites
this software generates shall remain intact and unaltered, 
in any version of this software you make.
 
If this is not strictly adhered to, your licence shall be 
rendered null, void and invalid.
*/

include("config.php");

function cleanvalue($strvalue) { // remove dangerous data from the value passed
	$newvalue = strip_tags($strvalue);
	$newvalue = str_replace("|", " ", $newvalue);
	$newvalue = str_replace("'", " ", $newvalue);
	$newvalue = stripslashes($newvalue);
	return $newvalue;
}

function emailcheck($stremail) { // basic email validation
	if (ereg("^.+@.+\..+$", $stremail)) {
		return 1;
	} else {
		return 0;
	}
}

function advemailcheck($stremail) { // advanced email validation
	if (emailcheck($stremail)) {
		list($username,$domain)=split('@',$stremail);
		return mxcheck($domain);
	} else {
		return 0;
	}
}

function mxcheck($host) { // mx record lookup to verify that the email domain exists and it has a mail server
	$hasmx = false;
	if(!empty($host)) {
  		exec("nslookup -type=MX $host",$output);
  		foreach($output as $line) {
			if(preg_match("/^$host/", $line)) $hasmx = true;
 		}
 	}
	return $hasmx;
}

function template($wichfile) { // reads the contents of the html template located in the templates_db_folder
	$filetoshow = templates_db_folder."/".$wichfile;
	$fp = fopen($filetoshow, 'r');
	$buffer = "";
	while (!feof($fp)) {
		$buffer .= fgets($fp, 1024);
	}
	$buffer = dofooter($buffer); // show copyright info
	return $buffer;
}

function fileread($wichfile) { // reads the content of a file
	$filetoshow = $wichfile;
	$fp = fopen($filetoshow, 'r');
	$buffer = "";
	while (!feof($fp)) {
		$buffer .= fgets($fp, 1024);
	}
	return $buffer;
}

function writetofile($wichfile, $what, $mode = 'w') { // writes the content of $what in $wichfile
	$fp = fopen($wichfile, $mode);
	fwrite($fp, $what);
	fclose($fp);
}

function error($inwhere, $message) { // shows an error message using the err_standard_template
	$errortemplate = template(err_standard_template);
	$errortemplate = str_replace("[WHERE]", $inwhere, $errortemplate);
	$errortemplate = str_replace("[ERRORMSG]", $message, $errortemplate);
	echo $errortemplate;
}

function sendmsg($msgto, $msgsubject, $msgbody, $msgfrom) { // sends an email message
	return mail($msgto, $msgsubject, $msgbody, "From: $msgfrom");
}

function dofooter($where) { // copyright info, should remain intact and unaltered
	$ourfooter = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

<!--- Removing or altering the hyperlinks to our sites in any way invalidates your licence to use this script --->

<p align="center" style="font-size: 7pt"><a href="http://www.ttfreeware.com">TTAPS</a> originally developed for <a href="http://www.tigertom.com">TigerTom</a> by <a href="http://www.lpin.net">LP Informática</a></p>

</body>';
	$toreturn = str_replace("</body>", $ourfooter, $where);
	return $toreturn;
}
?>

