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

if (isset($_POST['action'])) { // if the form is submitted
	
	$showerror = false;
	$action = cleanvalue($_POST['action']);
	$username = cleanvalue($_POST['nickname']);
	$filetocheck = affiliates_db_folder."/".$username.".dat";
	$formcompleted = true;
	$validemail = true;
	$errormsg = "";
	
	foreach($_POST as $fieldname => $fieldvalue) { // check to see if all form fields are complete
		if ($fieldname!="action") {
			$vartoassign = "";
			$newvalue = cleanvalue($fieldvalue);
			if (empty($newvalue)) {
				$vartoassign = "$"."err_".$fieldname." = "."empty_".$fieldname."_msg;";
				$formcompleted = false;
			} else {
				$vartoassign = "$".$fieldname." = '".$newvalue."';";
			}
			if (!empty($vartoassign)) eval($vartoassign);
		}
	}
	
	if (isset($email)) { // check the email address to see if it´s a valid one
		$validemail = (check_email_type=="simple") ? emailcheck($email) : advemailcheck($email);
		if (!$validemail) {
			$formcompleted = false;
			$err_email = empty_email_msg;
		}
	} else {
		$formcompleted = false;
		$err_email = empty_email_msg;
	}
	
	if ($formcompleted) { // if the form is completed and there are no errors
		if (!file_exists($filetocheck)) { // if the username isn´t taken then add it to the pending database
			$affiliateline = "$nickname|$name|$email|$address|$zipcode|$city|$state|$country|$tel|$siteurl|$pass\n";
			writetofile(main_db_folder."/".pending_data_file, $affiliateline, 'a');
			$showerror = false;
		} else { // if the username is taken return an error
			$err_nickname = affiliate_already_inuse;
			$showerror = true;
		}
	} else {
		$showerror = true;
	}
	
	if ($showerror) { // if something went wrong
		
		$errormsg = "";
		foreach($_POST as $fieldname => $fieldvalue) {
				if ($fieldname!="action") {
					$errorvar = "err_".$fieldname;
					if (isset($$errorvar)) $errormsg .= "${$errorvar}<br>";
				}
		}
		error("Sign Up", $errormsg); // show the error message
		
	} else { // if everything went fine
		
		$validationmsg = template(msg_mailvalidation_template);
		$validationmsg = str_replace("[name]", $name, $validationmsg);
		$validationmsg = str_replace("[script_root]", script_root, $validationmsg);
		$validationmsg = str_replace("[nickname]", $nickname, $validationmsg);
		$validationmsg = str_replace("[title_affiliates]", title_affiliates, $validationmsg);
		
		// send the mail validation message to the affiliate
		$subject = msg_mailvalidation_subject;
		sendmsg($email, $subject, $validationmsg, title_affiliates." <".email_affiliates.">");
		//sendmsg(email_affiliates, $subject, $validationmsg, "$name <$email>");
		
		$signupok = template(signup_validation_template);
		echo $signupok; // show the welcome page for the new affiliate
		
	}
	
} else { // if the form wasn´t submitted the show it
	
	echo template(signup_form_template);
	
} ?>