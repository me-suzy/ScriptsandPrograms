<?php
// class for user authorisation, registration, etc
class UserSys{
	
	// variables up for grabs
	var $Access;
	
	// user sign in and validation function
	function signin($username, $password, $from = ""){
		global $db, $dbprefix;
		
		// validate the information
		if ($username == ""){ return "No username entered"; }
		if ($password == ""){ return "No password entered"; }
		
		// select user from the database
		$sql = "SELECT * FROM " . $dbprefix . "users WHERE username = '" . dbSecure($username) . "'";
		$userget = $db->execute($sql);
		if ($userget->rows < 1){ return "This username is not registerd"; }
		
		// validate the password
		if ($userget->fields["password"] <> md5($password)){
			return "Your password was incorrect";
		}
		
		// check the account isn't locked
		if ($userget->fields["status"] == 0){ return "Your account has been locked"; }
		
		// user is cleared, update database
		$sql = "UPDATE " . $dbprefix . "users SET logindate = " . time() . ", ipaddress = '";
		$sql .= $_SERVER["REMOTE_ADDR"] . "'";
		$sql .= " WHERE ID = " . $userget->fields["ID"];
		$db->execute($sql);
		
		// load information into session
		$_SESSION["userid"] = $userget->fields["ID"];
		$_SESSION["username"] = $userget->fields["username"];
		$_SESSION["password"] = $userget->fields["password"];
		
		// where to send the user?
		if ($from <> ""){
			Header("Location: " . $from);
		} else {
			Header("Location: admin.php");
		}
		
		// kill script
		Die();
	}
	
	// log user out, destroy sessions
	function signout(){
		$_SESSION = Array();
		session_destroy();
	}
	
	// user authorisation function
	function Auth($level){
		global $db, $dbprefix;
		
		if ($_SESSION["userid"] <> ""){
			// validate users login
			$sql = "SELECT * FROM " . $dbprefix . "users WHERE ID = " . dbSecure($_SESSION["userid"]);
			$userd = $db->execute($sql);
			if ($userd->rows < 1){
				// user account not found
				$this->signout();
				$authlevel = 0;
			} else {
				// user account found
				if ($_SESSION["username"] <> $userd->fields["username"] || $_SESSION["password"] <> $userd->fields["password"]){
					// incorrect details
					$this->signout();
					$authlevel = 0;
				} else {
					// user is actually ok, supringly
					$authlevel = $userd->fields["status"];
				}
			}
		} else {
			// user is just a visitor
			$authlevel = 0;
		}
		
		// set auth level
		$this->Access = $authlevel;
		
		// finally, check if user has access
		if ($level > $authlevel){
			if ($authlevel > 0){
				die("You are not authorised to view this page");
			} else {
				if (!$_SERVER["REQUEST_URI"]){
					Header("Location: admin.php?page=signin");
				} else {
					Header("Location: admin.php?page=signin&from=" . urlencode($_SERVER["REQUEST_URI"]));
				}
				die();
			}
		}
	
	}
	
	// update password function
	function ChangePass($pass1, $pass2, $pass3){
		global $db, $dbprefix;
		
		// ok, lets begin with validation
		if ($pass1 == ""){ return "You did not enter your old password"; }
		if ($pass2 == ""){ return "You did not enter a new password"; }
		if ($pass3 == ""){ return "You did not confirm your new password"; }
		if ($pass2 <> $pass3){ return "Your new passwords did not match"; }
		
		// check user is logged in
		$this->Auth(1);
		
		// validate the current password
		$sql = "SELECT * FROM " . $dbprefix . "users WHERE ID = " . dbSecure($_SESSION["userid"]);
		$check3 = $db->execute($sql);
		if ($check3->rows < 1){ return "Your user account cound not be found"; }
		
		// ok, validate the passwords match
		if (md5($pass1) <> $check3->fields["password"]){
			return "Your old password was incorrect";
		}
		
		// everything seems fine, run update
		$sql = "UPDATE " . $dbprefix . "users SET password = '" . md5($pass2) . "' WHERE ID = " . $check3->fields["ID"];
		$db->execute($sql);
		
		// now sign user out
		$this->signout();
		
		// restart session
		StartSession();
		
		// sign user back in again
		$this->signin($check3->fields["username"], $pass2, "admin.php?page=myaccount");
		
		// and kill script
		return "Your password has been changed sucessfully!";
	}
	
	// preferences function for updating them
	function Information($email){
		global $db, $dbprefix;
		
		// check the user is signed in
		$this->Auth(1);
		
		// standard data validation
		if ($email == ""){ die("You did not enter an email address"); }
		
		// email address validation
		if (function_exists("checkdnsrr")){
			$emailsplit = split("@", $email);
			if (!(checkdnsrr($emailsplit[1], "MX"))){
				return "Your email address is not valid";
			}
		}
		
		// check email isn't already in use
		$sql = "SELECT * FROM " . $dbprefix . "users WHERE email = '" . dbSecure($email) . "'";
		$echeck = $db->execute($sql);
		if ($echeck->rows > 0){ return "This email address is already in use"; }
		
		// ok, everything seems fine, do the update
		$sql = "UPDATE " . $dbprefix . "users SET email = '" . dbSecure($email) . "' WHERE ID = " . $_SESSION["userid"];
		$db->execute($sql);
		
		// and return information
		return "Your profile has been updated successfully!";
	}
}
?>