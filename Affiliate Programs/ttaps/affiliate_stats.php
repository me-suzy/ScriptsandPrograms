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

require("functions.php");

$showerror = true;

if (isset($_POST['action'])) {$_POST['action']();} else {showlogin();}

function login() { // login to the affiliate stats
	$showerror = false;
	$userin = false;
	$errormsg = "";
	if ((isset($_POST['nickname'])) && (isset($_POST['pass']))) {
		$username = cleanvalue($_POST['nickname']);
		$password = cleanvalue($_POST['pass']);
		if (($username!="") && ($password!="")) {
			$fp = fopen(main_db_folder."/".affiliates_data_file, 'r');
			while (!feof($fp)) {
				$userline = trim(fgets($fp, 4096));
				$arruser = explode("|", $userline);
				if (($username == $arruser[0]) && ($password == $arruser[10])) {
					$userin = true;
					break;
				}
			}
		}
		if (!$userin) {
			$errormsg = user_pass_wrong;
			$showerror = true;
		}
	} else {
		if (!isset($_POST['nickname'])) $errormsg .= empty_nickname_msg."<br>";
		if (!isset($_POST['pass'])) $errosmsg .= empty_pass_msg."<br>";
		$showerror = true;
	}
	
	if ($showerror) {
		error("Stats", $errormsg);
	} else {
		stats_show($username);
	}
}

function stats_show($username) {
	$arrtoreplace = array();
	$usersdb = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
	for ($i = 0; $i < count($usersdb); $i++) {
		if (trim($usersdb[$i])!="") {
			$arrdata = explode("|", $usersdb[$i]);
			if ($username == $arrdata[0]) {
				$arrtoreplace = $arrdata;
				break;
			}
		}
	}
	$paid = number_format($arrtoreplace[11] / 100, 2);
	$arrtoreplace[11] = $paid;
	$earned = trim(fileread(affiliates_db_folder."/".$username.".dat"));
	$arrtoreplace[] = ($earned!="") ? number_format($earned / 100, 2) : '0';
	$arrtoreplace[] = money_unit;
	$arrtouse = array("nickname", "name", "email", "address", "zipcode", "city", "state", "country", "tel", "siteurl", "pass", "total_paid", "amount_sold", "money_unit");
	$statsfile = template(affiliate_stats_template);
	for ($j = 0; $j < count($arrtouse); $j++) {
		$statsfile = str_replace("[".$arrtouse[$j]."]", $arrtoreplace[$j], $statsfile);
	}
	echo $statsfile;
}

function dataprocess() {
	
	$showerror = false;
	$formcompleted = true;
	$usersdata = "";
	$newuserdata = "";
	
	foreach($_POST as $fieldname => $fieldvalue) {
		if ($fieldname!="action") {
			$vartoassign = "";
			$newvalue = cleanvalue($fieldvalue);
			if ($newvalue=="") {
				$vartoassign = "$"."err_".$fieldname." = empty_".$fieldname."_msg;";
				$formcompleted = false;
			} else {
				$vartoassign = "$".$fieldname." = '".$newvalue."';";
			}
			if (!empty($vartoassign)) eval($vartoassign);
		}
	}
	
	$validemail = (check_email_type=="simple") ? emailcheck($email) : advemailcheck($email);
	if (!$validemail) {
		$formcompleted = false;
		$err_email = empty_email_msg;
	}
	
	if ($_POST['pass'] != $_POST['pass2']) {
		$err_pass2 = pass2_diff_pass;
		$fomrcompleted = false;
	}
	
	if ($formcompleted) {
		$usersfile = fileread(main_db_folder."/".affiliates_data_file);
		$arrusers = explode("\n", $usersfile);
		for ($i = 0; $i < count($arrusers); $i++) {
			if (trim($arrusers[$i])!="") {
				list($f_nickname, $f_name, $f_email, $f_address, $f_zipcode, $f_city, $f_state, $f_country, $f_tel, $f_siteurl, $f_pass, $f_payments) = explode("|", trim($arrusers[$i]));
				if ($nickname == $f_nickname) {
					$newuserdata = "$nickname|$name|$email|$address|$zipcode|$city|$state|$country|$tel|$siteurl|$pass|$payments";
					$usersdata .= "$newuserdata\n";
				} else {
					$usersdata .= "$f_nickname|$f_name|$f_email|$f_address|$f_zipcode|$f_city|$f_state|$f_country|$f_tel|$f_siteurl|$f_pass|$f_payments\n";
				}
			}
		}
		$showerror = false;
	} else {
		$showerror = true;
	}
	
	if ($showerror) {
		
		$errormsg = "";
		foreach($_POST as $fieldname => $fieldvalue) {
				if ($fieldname!="action") {
					$errorvar = "err_".$fieldname;
					if (isset($$errorvar)) $errormsg .= "${$errorvar}<br>";
				}
		}
		error("Stats", $errormsg);
		
	} else {
		if ($usersdata!="") writetofile(main_db_folder."/".affiliates_data_file, $usersdata);
		stats_show($nickname);
	}
	
}

function showlogin() { // show de login form for the affiliate to access his stats
	echo template(affiliate_statsenter_template);
}

?>