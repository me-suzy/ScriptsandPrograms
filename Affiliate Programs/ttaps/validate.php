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

if (isset($_GET['affil'])) { // if the affiliate id is set
	
	$errormsg = "";
	$affiliateline = "";
	$validated = false;
	$affiliate = cleanvalue($_GET['affil']);
	$pendingdb = main_db_folder."/".pending_data_file;
	if (file_exists($pendingdb)) { // if i got pending users
		$pendingusers = explode("\n", fileread($pendingdb));
		$newpendingusers = "";
		for ($i = 0; $i < count($pendingusers); $i++) { // loop by all the pending users in the database
			if (trim($pendingusers[$i])!="") {
				list($nickname, $name, $email, $address, $zipcode, $city, $state, $country, $tel, $siteurl, $pass) = explode("|", $pendingusers[$i]);
				$affiliateline = "$nickname|$name|$email|$address|$zipcode|$city|$state|$country|$tel|$siteurl|$pass";
				if ($nickname == $affiliate) { // if the affiliate is in the database
					if (!file_exists(affiliates_db_folder."/".$nickname.".dat")) { // if the chosen name doesn´t exists then
						writetofile(affiliates_db_folder."/".$nickname.".dat", "0");
						writetofile(main_db_folder."/".affiliates_data_file, $affiliateline."|0\n", 'a'); // add the affiliate to the main database
						if (isset($_COOKIE[cookie_name_refer])) { // if the user has been referred by another affiliate
							$pairedusers = $nickname."|".$_COOKIE[cookie_name_refer]."\n";
							writetofile(main_db_folder."/".paired_data_file, $pairedusers, 'a'); //  write the data to the paired data file
							$refererdata = $nickname."|".date("D F j H:i:s Y")."|".$_COOKIE[cookie_name_refer]."\n";
							writetofile(main_db_folder."/".referred_data_file, $refererdata, 'a'); // and to the referred data file
						}
						$validated = true;
					} else { // if the username is taken return an error
						$errormsg = affiliate_already_inuse;
					}
				} else {
					$newpendingusers .= "$affiliateline\n";
				}
			}
			if ((!$validated) && ($errormsg=="")) $errormsg = not_pending_msg;
		}
		if (!$validated) { // if the validation didn´t succeed then show an error message
			error("Signu up validation", $errormsg);
		} else { // and if everything was ok then
			writetofile($pendingdb, $newpendingusers); // update the pending users database
			list($nickname, $name, $email, $address, $zipcode, $city, $state, $country, $tel, $siteurl, $pass) = explode("|", $affiliateline);
			$welcomemsg = template(msg_welcome_template);
			$welcomemsg = str_replace("[name]", $name, $welcomemsg);
			$welcomemsg = str_replace("[nickname]", $nickname, $welcomemsg);
			$welcomemsg = str_replace("[pass]", $pass, $welcomemsg);
			$welcomemsg = str_replace("[site_title]", site_title, $welcomemsg);
			$welcomemsg = str_replace("[title_affiliates]", title_affiliates, $welcomemsg);
			$welcomemsg = str_replace("[main_url]", main_url, $welcomemsg);
			
			// send the welcome message to the affiliate and the webmaster
			$subject = msg_welcome_subject;
			sendmsg($email, $subject, $welcomemsg, title_affiliates." <".email_affiliates.">");
			sendmsg(email_affiliates, $subject, $welcomemsg, "$name <$email>");
			
			$signupok = template(signup_complete_template);
			$signupok = str_replace("[nickname]", $nickname, $signupok);
			echo $signupok; // show the welcome page for the new affiliate
		}
	} else { // if i don´t have pending users show an error
		error("Sign up validation", not_pending_msg);
	}
	
} else { // if the affiliate id is not set show the signup form :)
	
	echo template(signup_form_template);
	
} ?>