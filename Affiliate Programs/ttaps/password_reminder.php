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

include("functions.php");

if ($_POST) { // if the user submited the form
	$usertosend = "";
	$passtosend = "";
	$nametosend = "";
	$mailtosend = "";
	if (isset($_POST['nickname']) || isset($_POST['email'])) { // if he entered the nickname or email address
		$username = (isset($_POST['nickname'])) ? cleanvalue($_POST['nickname']) : "";
		$useremail = (isset($_POST['email'])) ? cleanvalue($_POST['email']) : "";
		if ($username!="" || $useremail!="") {
			$affiliatesdb = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
			for ($i = 0; $i < count($affiliatesdb); $i++) { // check to see if it´s on file
				if ($affiliatesdb[$i]!="") {
					$arruserdata = explode("|", $affiliatesdb[$i]);
					if ($arruserdata[0]==$username || $arruserdata[2]==$useremail) {
						$usertosend = $arruserdata[0];
						$passtosend = $arruserdata[10];
						$nametosend = $arruserdata[1];
						$mailtosend = $arruserdata[2];
					}
				}
			}
		}
	}
	// if it is then send the email with his data
	if (($usertosend!="") && ($passtosend!="") && ($mailtosend!="") && ($nametosend!="")) {
		$passwordmsg = template(msg_password_reminder);
		$passwordmsg = str_replace("[name]", $nametosend, $passwordmsg);
		$passwordmsg = str_replace("[username]", $usertosend, $passwordmsg);
		$passwordmsg = str_replace("[password]", $passtosend, $passwordmsg);
		$passwordmsg = str_replace("[site_title]", site_title, $passwordmsg);
		$passwordmsg = str_replace("[title_affiliates]", title_affiliates, $passwordmsg);
		$passwordmsg = str_replace("[main_url]", main_url, $passwordmsg);
		sendmsg($mailtosend, site_title." - Password reminder", $passwordmsg, title_affiliates." <".email_affiliates.">");
		$passwordsent = template(affiliate_password_sent);
		$passwordsent = str_replace("[title_affiliates]", title_affiliates, $passwordsent);
		echo $passwordsent;
	} else {
		// if it isn´t then show an error message
		error("Password reminder", "The info you entered is not in our records");
	}
} else { // and if he didn´t submitted the form, then show it :)
	$passform = template(affiliate_password_reminder);
	$passform = str_replace("[title_affiliates]", title_affiliates, $passform);
	echo $passform;
}
?>