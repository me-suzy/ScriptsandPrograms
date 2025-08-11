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

// initialize the needed vars
$nickname = "";
$toredirect = "";
$linktogo = "";

// assign the nickname and toredirect variables depending of the method used, GET or POST
if ($_GET) {
	$nickname = (isset($_GET['affil'])) ? cleanvalue($_GET['affil']) : "";
	$toredirect = (isset($_GET['site'])) ? cleanvalue($_GET['site']) : "";
} elseif ($_POST) {
	$nickname = (isset($_POST['affil'])) ? cleanvalue($_POST['affil']) : "";
	$toredirect = (isset($_POST['site'])) ? cleanvalue($_POST['site']) : "";
}

$linksdb = template(redirect_links_file); // open the links database
$arrlinks = explode("\n", $linksdb);
for ($i = 0; $i < count($arrlinks); $i++) {
	if (trim($arrlinks[$i])!="") {
		list($param, $title, $link) = explode("|", $arrlinks[$i]);
		if ($param == $toredirect) $linktogo = trim($link); // and select the link that matches the site passed
	}
}

// if nickname has a value assigned then... 
if ($nickname != "") {
	
	if (isset($_COOKIE[cookie_name_main])) { // if the cookie is set then...
		header("Location: ".$linktogo); // redirect the user to the selected url
	} else { // else if the cookie is NOT set then...
		$userdatafile = affiliates_db_folder."/".$nickname.".dat";
		if (file_exists($userdatafile)) { // check to see if nickname is a registered affiliate and if it is then
			$cookie_expires = time()+86400*cookie_daysto_expire; // set all the cookies and...
			setcookie(cookie_name_main, 1, $cookie_expires, cookie_path, cookie_domain, cookie_secure);
			setcookie(cookie_name_refer, $nickname, $cookie_expires, cookie_path, cookie_domain, cookie_secure);
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL='.$linktogo.'">'; // redirect the user
		} else { // and if he´s not a registered affiliate then...
			header("Location: ".$linktogo); // just redirect him
		}
	}
	
} else { // and if nickname doesn´t have a value assigned then...
	
	header("Location: ".$linktogo); // redirect the user
	
} ?>

