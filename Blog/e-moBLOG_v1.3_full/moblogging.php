<?php
/***************************************************************************
 *   moblogging.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " weblog engine
 *
 *   This program is a free software. You can modify it as you wish, though
 *   we would just appreciate if you could keep the copyright notice on the
 *   pages (including the engine version and link)  even if you should feel
 *   free to add your own copyright if you modified and enhanced the code.
 *
 *   Please note though that, this software being copyrighted means that the
 *   whole code (or part of it) is.  You should thus not sell any version of
 *   this program, neither any modified version of it using part of the fol-
 *   lowing code. Moreover, please do not use it for commercial purposes.
 *
 ***************************************************************************/

// connect to DB if no connection established yet
if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

// get what we need from the e-moBLOG configuration table in the DB
$result0 = execRequest("SELECT mserver, mport, mtype, mlogin, mpassword, blog_url, blog_path FROM blogconfig", $connection);
while ($connvars = nextLine($result0)) {
	$moblogserver = $connvars->mserver;
	$moblogport = $connvars->mport;
	$moblogtype = $connvars->mtype;
	$mobloglogin = "$connvars->mlogin";
	$moblogpassword = "$connvars->mpassword";
	
	$blog_url = $connvars->blog_url;
	$blog_path = $connvars->blog_path;
	
	// setting up the mail server connection string
	if ($moblogtype == "pop3") {
		$connstr = "$moblogserver:$moblogport/pop3";
	} else {
		$connstr = "$moblogserver:$moblogport";
	}
}

// connect to the mailbox
$courier = imap_open("{" . $connstr . "}INBOX", $mobloglogin, $moblogpassword, CL_EXPUNGE);

// just end the script if there's no new mail or if something goes wrong
if (!$courier) {
	exit;
}

// check the number of new mails
$nummsg = imap_num_msg($courier);

// if there are new mails, read them
if ($nummsg > 0) {
	
	for ($i = 1; $i <= $nummsg; $i++) {
		
		$structure = imap_fetchstructure($courier, $i);
		$parties = $structure->parts;
		
		// if multi-part message, we will probably have to handle an attachment
		if ($parties) {
			
			$attachname = rand(0, 9999999) . ".jpg";
			$x = 1;
			
			foreach ($parties as $partie) {
			
				// if type is 5, we've got an image to handle
			    if ($partie->type == 5) {
			     	
				    $parames = $partie->dparameters;
				    
					foreach ($parames as $p) {
						if ($p->attribute == "FILENAME" || $p->attribute == "filename") {
							
							$attachfile = $p->value;
					    	$attachment = imap_fetchBody($courier, $i, $x);
					    	$strtowrite = imap_base64($attachment);
					    	
					    	// create and write the image on the hosting
							$fp = fopen("$blog_path/attach/$attachname", "w+");
							fwrite($fp, $strtowrite);
							fclose($fp);
					    }
					}
				    
				// type 0 is for plain text
				} else if ($partie->type == 0) {
			     	
			     	$headermail = imap_headerinfo($courier, $i);
					$text = imap_fetchBody($courier, $i, 1);
					
					$title = $headermail->subject;
					$content = html_entity_decode($text);
					$content = preg_replace("/([^£]+)£([^£]+)£([^£]+)/i","\\2",$content);
					$content = str_replace("£", "", $content);
					
					// check for blog password in order to post
					$checkp = strstr($title, '@');
					$title = substr($title, 0, (strlen($title) - strlen($checkp)));
					$checkp = substr($checkp, 1);
					$checkp = md5($checkp);
					
					$result = execRequest("SELECT password FROM blogconfig", $connection);
					while ($checkpass = nextLine($result)) {
						
						$passdb = "$checkpass->password";
						
						if (strcmp($checkp, $passdb) == 0) {
						
							// and add new mails to the blog posts database
							if (strlen($title) > 0 && strlen($content) > 0) {
								
								$monthy = date(Ym);
								$content = "[img]" . $blog_url . "attach/" . $attachname . "[/img]\n\n" . $content;
								$resultr = execRequest("INSERT INTO blogposts (date, title, content, monthy) VALUES ('" . time() . "', '" . addSlashes(htmlspecialchars($title, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "', '" . $monthy . "')", $connection);
								
								unset ($monthy);
							}
							
						}
					}
				}
				$x++;
			}
			
		// if single part message, we only got plain text
		} else {
			
			$headermail = imap_headerinfo($courier, $i);
			$text = imap_fetchBody($courier, $i, 1);
			
			$title = $headermail->subject;
			$content = html_entity_decode($text);
			$content = preg_replace("/([^£]+)£([^£]+)£([^£]+)/i","\\2",$content);
			$content = str_replace("£", "", $content);
			
			// check for blog password in order to post
			$checkp = strstr($title, '@');
			$title = substr($title, 0, (strlen($title) - strlen($checkp)));
			$checkp = substr($checkp, 1);
			$checkp = md5($checkp);
			
			$result = execRequest("SELECT password FROM blogconfig", $connection);
			while ($checkpass = nextLine($result)) {
				
				$passdb = "$checkpass->password";
				
				if (strcmp($checkp, $passdb) == 0) {
				
					// and add new mails to the blog posts database
					if (strlen($title) > 0 && strlen($content) > 0) {
						
						$monthy = date(Ym);
						$resultr = execRequest("INSERT INTO blogposts (date, title, content, monthy) VALUES ('" . time() . "', '" . addSlashes(htmlspecialchars($title, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "', '" . $monthy . "')", $connection);
						
						unset ($monthy);
					}
					
				}
			}
		}
		
		// flag read mails as "to be deleted"
		imap_delete($courier, $i);
	}
}

// close connection with the mailbox and end script
imap_close($courier);
?>