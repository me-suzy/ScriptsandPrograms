<?php
/***************************************************************************
 *   admin/modpost.php
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

require ("./protect.php");
require ("../includes/db.php");
require ("./functions.php");
require ("./constants.php");

// connect to DB and insert the new post
if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

// here we might encounter more than one action, so decide which to take according to the value of the "action" variable
switch ($action) {
   case "add": // if the variable is set to "add" we will have to add a post
       
		if (POSTER == "0") {
			if (strlen($title) > 0 && strlen($content) > 0) {
				// send a cookie to keep name and email in memory
				$cookievalue = time() + 3600 * 24 * 365;
				setcookie("e-moblog_name", $HTTP_POST_VARS['name'], $cookievalue);
				setcookie("e-moblog_email", $HTTP_POST_VARS['email'], $cookievalue);

				$monthy = date(Ym);
		
				$result = execRequest("INSERT INTO blogposts (date, title, content, audio, dayquote, monthy) VALUES ('" . time() . "', '" . addSlashes(htmlspecialchars($title, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($audio, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($dayquote, ENT_QUOTES)) . "', '" . $monthy . "')", $connection);
				$postid = mysql_insert_id();
				
				if ($saveimages == "yes") {
					saveURLs($content, $monthy, $postid, $saveimages);
				} else {
					$saveimages = "no";
					saveURLs($content, $monthy, $postid, $saveimages);
				}
				
				header("Location: ./index2.php?status=add&" . SESS);
				exit;
			} else {
				// on error, get back and notify the user
				header("Location: ./index2.php?err=fields&" . SESS);
				exit;
			}
		} else if (POSTER == "1") {
			if (strlen($title) > 0 && strlen($content) > 0 && strlen($name) > 0 && strlen($email) > 0) {
				// send a cookie to keep name and email in memory
				$cookievalue = time() + 3600 * 24 * 365;
				setcookie("e-moblog_name", $HTTP_POST_VARS['name'], $cookievalue);
				setcookie("e-moblog_email", $HTTP_POST_VARS['email'], $cookievalue);

				$monthy = date(Ym);
		
				$result = execRequest("INSERT INTO blogposts (date, title, content, audio, dayquote, monthy, name, email) VALUES ('" . time() . "', '" . addSlashes(htmlspecialchars($title, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($audio, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($dayquote, ENT_QUOTES)) . "', '" . $monthy . "', '" . addSlashes(htmlspecialchars($name, ENT_QUOTES)) . "', '" . addSlashes(htmlspecialchars($email, ENT_QUOTES)) . "')", $connection);
				$postid = mysql_insert_id();
				
				if ($saveimages == "yes") {
					saveURLs($content, $monthy, $postid, $saveimages);
				} else {
					$saveimages = "no";
					saveURLs($content, $monthy, $postid, $saveimages);
				}
				
				header("Location: ./index2.php?status=add&" . SESS);
				exit;
			} else {
				// on error, get back and notify the user
				header("Location: ./index2.php?err=fields2&" . SESS);
				exit;
			}
		}	
	   	break;
		
   case "mod": // if the variable is set to "mod" we will have to update an existing post
       
		if (strlen($title) > 0 && strlen($content) > 0) {
		
			$result = execRequest("UPDATE blogposts SET title='" . addSlashes(htmlspecialchars($title, ENT_QUOTES)) . "', content='" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "', audio='" . addSlashes(htmlspecialchars($audio, ENT_QUOTES)) . "', dayquote='" . addSlashes(htmlspecialchars($dayquote, ENT_QUOTES)) . "' WHERE id='$postid'", $connection);
			
			if ($saveimages == "yes") {
				saveURLs($content, $monthy, $postid, $saveimages);
			} else {
				$saveimages = "no";
				saveURLs($content, $monthy, $postid, $saveimages);
			}
			
			header("Location: ./index2.php?status=mod&" . SESS);
			exit;
		} else {
			// on error, get back and notify the user
			header("Location: ./index2.php?err=fields&" . SESS);
			exit;
		}
	   	break;
	   	
   case "addi": // if the variable is set to "addi" we will have to add an image
       
		if (strlen($url) > 0 && strlen($descr) > 0) {
			
			if (substr($url, 0, 7) == "http://") {
				$size = getimagesize($url);
				$width = $size[0];
				$height = $size[1];
				$url = substr($url, 7);
			} else {
				$tempurl = "http://" . $url;
				$size = getimagesize($tempurl);
				$width = $size[0];
				$height = $size[1];	
			}
	
			$result = execRequest("INSERT INTO blogimages (date, url, width, height, descr) VALUES ('" . time() . "', '" . addSlashes(htmlspecialchars($url, ENT_QUOTES)) . "', '$width', '$height', '" . addSlashes(htmlspecialchars($descr, ENT_QUOTES)) . "')", $connection);
			header("Location: ./index2.php?status=add&" . SESS);
			exit;
		} else {
			// on error, get back and notify the user
			header("Location: ./index2.php?err=fields&" . SESS);
			exit;
		}
	   	break;
	   	
   case "modi": // if the variable is set to "modi" we will have to update an existing image
       
		if (strlen($url) > 0 && strlen($descr) > 0) {
		
			$result = execRequest("UPDATE blogimages SET url='" . addSlashes(htmlspecialchars($url, ENT_QUOTES)) . "', descr='" . addSlashes(htmlspecialchars($descr, ENT_QUOTES)) . "' WHERE id='$id'", $connection);
			header("Location: ./index2.php?status=modc&" . SESS);
			exit;
		} else {
			// on error, get back and notify the user
			header("Location: ./index2.php?err=fields&" . SESS);
			exit;
		}
	   	break;
	   	
   case "deli": // if the variable is set to "deli" we will have to delete an image

		$result = execRequest("DELETE from blogimages WHERE id='$id'", $connection);
		header("Location: ./index2.php?status=del&" . SESS);
		exit;
		break;
	   	
   case "modc": // if the variable is set to "modc" we will have to update an existing comment
       
		if (strlen($content) > 0) {
		
			$result = execRequest("UPDATE blogcomments SET content='" . addSlashes(htmlspecialchars($content, ENT_QUOTES)) . "' WHERE id='$commid'", $connection);
			header("Location: ./index2.php?status=modc&" . SESS);
			exit;
		} else {
			// on error, get back and notify the user
			header("Location: ./index2.php?err=fields&" . SESS);
			exit;
		}
	   	break;
		
   case "del": // if the variable is set to "del" we will have to delete a post

		$result = execRequest("DELETE from blogposts WHERE id='$id'", $connection);
		// also delete all comment srelated to this very post
		$result2 = execRequest("DELETE from blogcomments WHERE postid='$id'", $connection);
		$result3 = execRequest("DELETE from blogimages WHERE postid='$id'", $connection);
		header("Location: ./index2.php?status=del&" . SESS);
		exit;
		break;
		
   case "delcomm": // if the variable is set to "delcomm" we will have to delete a comment

		$result = execRequest("DELETE from blogcomments WHERE id='$id'", $connection);
		// don't forget to get the number of post INT down to the value -1
		$result2 = execRequest("UPDATE blogposts SET nrcomments='$numcom' WHERE id='$postid'", $connection);
		header("Location: ./index2.php?status=delcomm&" . SESS);
		exit;
		break;
		
   case "conf": // if the variable is set to "conf" we will have to update the configuration
   
       	if (strlen($bname) > 0 && strlen($burl) > 0 && strlen($aname) > 0 && strlen($aemail) > 0 && strlen($maxwidth) > 0 && strlen($servertime) > 0 && strlen($blimit) > 0) {
	   		if ($maxwidth < "270") {
				$maxwidth = "270";
			}
			if ($moblogging == "1") {
				if (strlen($mserver) > 0 && strlen($mport) > 0 && strlen($mlogin) > 0 && strlen($mpassword) > 0 && strlen($bpath) > 0) {
					$result = execRequest("UPDATE blogconfig SET comments='$comments', center='$center', poster='$poster', smileys='$smileys', language='$language', moblogging='$moblogging', resize='$resize',
															blog_name='" . addSlashes(htmlspecialchars($bname, ENT_QUOTES)) . "', 
															blog_url='" . addSlashes(htmlspecialchars($burl, ENT_QUOTES)) . "',
															blog_path='" . addSlashes(htmlspecialchars($bpath, ENT_QUOTES)) . "', 
															author_name='" . addSlashes(htmlspecialchars($aname, ENT_QUOTES)) . "', 
															author_email='" . addSlashes(htmlspecialchars($aemail, ENT_QUOTES)) . "', 
															blog_description='" . addSlashes(htmlspecialchars($bdesc, ENT_QUOTES)) . "', 
															blog_keywords='" . addSlashes(htmlspecialchars($bkeys, ENT_QUOTES)) . "',
															mserver='" . addSlashes(htmlspecialchars($mserver, ENT_QUOTES)) . "',
															mport='" . addSlashes(htmlspecialchars($mport, ENT_QUOTES)) . "',
															mtype='$mtype',
															mlogin='" . addSlashes(htmlspecialchars($mlogin, ENT_QUOTES)) . "',
															mpassword='" . addSlashes(htmlspecialchars($mpassword, ENT_QUOTES)) . "',
															blog_limit='$blimit', max_width='$maxwidth', servertime='$servertime'", $connection);
					header("Location: ./index2.php?status=conf&" . SESS);
					exit;
				} else {
					header("Location: ./conf.php?err=fields2&" . SESS);
					exit;
				}
			} else if ($moblogging == "0") {
				$result = execRequest("UPDATE blogconfig SET comments='$comments', center='$center', poster='$poster', smileys='$smileys', language='$language', moblogging='$moblogging', resize='$resize',
														blog_name='" . addSlashes(htmlspecialchars($bname, ENT_QUOTES)) . "', 
														blog_url='" . addSlashes(htmlspecialchars($burl, ENT_QUOTES)) . "', 
														author_name='" . addSlashes(htmlspecialchars($aname, ENT_QUOTES)) . "', 
														author_email='" . addSlashes(htmlspecialchars($aemail, ENT_QUOTES)) . "', 
														blog_description='" . addSlashes(htmlspecialchars($bdesc, ENT_QUOTES)) . "', 
														blog_keywords='" . addSlashes(htmlspecialchars($bkeys, ENT_QUOTES)) . "', 
														mserver='" . addSlashes(htmlspecialchars($mserver, ENT_QUOTES)) . "',
														mport='" . addSlashes(htmlspecialchars($mport, ENT_QUOTES)) . "',
														mtype='$mtype',
														mlogin='" . addSlashes(htmlspecialchars($mlogin, ENT_QUOTES)) . "',
														mpassword='" . addSlashes(htmlspecialchars($mpassword, ENT_QUOTES)) . "',
														blog_limit='$blimit', max_width='$maxwidth', servertime='$servertime'", $connection);
				header("Location: ./index2.php?status=conf&" . SESS);
				exit;
			}
		} else {
			// on error, get back and notify the user
			header("Location: ./conf.php?err=fields2&" . SESS);
			exit;
		}
       	break;
}
?>