<?php
/***************************************************************************
 *   admin/functions.php
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

require ("./constants.php");

// function - connect to MySQL database

function connect($cName, $cPass, $cBase, $cServer) {
	$connection = mysql_pconnect ($cServer, $cName, $cPass);
	if (!$connection) {
		echo "Sorry, could not connect to " . $cServer . " for the moment.\n";
		exit;
	}
	if (!mysql_select_db ($cBase, $connection)) {
		echo "Sorry, could not reach " . $cBase . " for the moment.\n";
		echo "<b>Message from MySQL:</b>" . mysql_error($connection);
		exit;
	}
	return $connection;
}


// function - execute requests on MySQL DB

function execRequest($request, $connection) {
	$result = mysql_query($request, $connection);
	if ($result) {
		return $result;
	} else {
		echo "Sorry, could not execute " . $request . ".\n";
		echo "<b>Message from MySQL:</b>" . mysql_error($connection);
		exit;
	}
}


// function - seek in the result variable for a next line

function nextLine($result) {
	return mysql_fetch_object($result);
}


// function - used to convert month to a text format

function convertMonth($str) {
		require ("../language/" . BLANG . ".php");
		
		$result = str_replace("01", $lang['jan1'], $str);
		$result = str_replace("02", $lang['feb1'], $result);
		$result = str_replace("03", $lang['mar1'], $result);
		$result = str_replace("04", $lang['apr1'], $result);
		$result = str_replace("05", $lang['may1'], $result);
		$result = str_replace("06", $lang['june1'], $result);
		$result = str_replace("07", $lang['july1'], $result);
		$result = str_replace("08", $lang['aug1'], $result);
		$result = str_replace("09", $lang['sep1'], $result);
		$result = str_replace("10", $lang['oct1'], $result);
		$result = str_replace("11", $lang['nov1'], $result);
		$result = str_replace("12", $lang['dec1'], $result);
		
		return $result;
}


// function - converts unix timestamp used in the DB to usable string

function convertDate($time) {
	require ("../language/" . BLANG . ".php");

	if (substr(SERVERTIME, 0, 1) == "+") {
		$offset = substr(SERVERTIME, 1, 2);
	} else {
		$offset = "-" . substr(SERVERTIME, 1, 2);
	}
	
	$timeLocal = $time + (3600 * $offset);
	$date = date("d-m-y-H-i", $timeLocal);
	$dateArray = explode("-", $date);

 	$dateArray[1] = str_replace("01", $lang['jan'], $dateArray[1]);
 	$dateArray[1] = str_replace("02", $lang['feb'], $dateArray[1]);
 	$dateArray[1] = str_replace("03", $lang['mar'], $dateArray[1]);
 	$dateArray[1] = str_replace("04", $lang['apr'], $dateArray[1]);
 	$dateArray[1] = str_replace("05", $lang['may'], $dateArray[1]);
 	$dateArray[1] = str_replace("06", $lang['june'], $dateArray[1]);
 	$dateArray[1] = str_replace("07", $lang['july'], $dateArray[1]);
 	$dateArray[1] = str_replace("08", $lang['aug'], $dateArray[1]);
 	$dateArray[1] = str_replace("09", $lang['sep'], $dateArray[1]);
 	$dateArray[1] = str_replace("10", $lang['oct'], $dateArray[1]);
 	$dateArray[1] = str_replace("11", $lang['nov'], $dateArray[1]);
 	$dateArray[1] = str_replace("12", $lang['dec'], $dateArray[1]);

 	return $dateArray[0]." ".$dateArray[1]." ".$dateArray[2]." - ".$dateArray[3].":".$dateArray[4];
}


// function - used to get the total number of returned images in the gallery

function getImg($connection) {
	$result = execRequest("SELECT COUNT(*) as totai FROM blogimages", $connection);
	while ($toti = nextLine($result)) {
		$totalimg = $toti->totai;
	}
	return $totalimg;
}


// function - returns every language file from the language directory

function getLang() {
  	$handle = opendir("../language");
    while ($file = readdir($handle)) {
		if ($file != "." && $file != "..") {
			$filef = substr($file, 0, (strlen($file)-4));
			if ($filef == BLANG) {
				$selec = " selected=\"selected\"";
			} else {
				$selec = "";
			}
      	 	echo "<option value=\"" . $filef . "\"" . $selec . "> " . $filef . "</option>\n";
   		}
	}
   	closedir($handle);
}


// function - prints the HTML headers for the admin part

function print_header2() {
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
		. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      	. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n"
		. "<head>\n<title>" . stripslashes(BLOG_NAME) . " - ADMIN PAGES</title>\n"
		. "<meta name=\"description\" content=\"" . stripslashes(BLOG_DESCRIPTION) . "\" />\n<meta name=\"keywords\" content=\"" . stripslashes(BLOG_KEYWORDS) . "\" />\n"
		. "<meta http-equiv=\"imagetoolbar\" content=\"no\" />\n<meta name=\"author\" content=\"" . stripslashes(AUTHOR_NAME) . "\" />\n"
		. "<meta name=\"Copyright\" content=\"Axel Achten / e-motionalis.net\" />\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n"
		. "<link rel=\"stylesheet\" type=\"text/css\" href=\"../includes/style.css\" />\n</head>\n<body>\n\n";
	if (CENTER == "1") {
		echo "<div align=\"center\">\n\n";
	}
}


// function - prints the javascript function used to add or modify a post

function print_jscript() {
	require ("../language/" . BLANG . ".php");
	echo "<script type=\"text/javascript\">\n
	function addline() {
		linesrc = '\\n[line]\\n';
		document.post.content.value  += linesrc;
		document.post.content.focus();
	}\n

	function addline2() {
		linesrc2 = '\\n[line]\\n';
		document.post2.content.value  += linesrc2;
		document.post2.content.focus();
	}\n

	function question(postid) {
		answer = window.confirm ('" . $lang['a_delconfirm'] . "');
		if (answer == true) self.location.href = './modpost.php?action=del&id=' + postid + '&" . SESS . "';
		else answer = null;
	}\n

	function questionC(commid, postid, numcom) {
		answer2 = window.confirm ('" . $lang['a_delcommconfirm'] . "');
		if (answer2 == true) self.location.href = './modpost.php?action=delcomm&id=' + commid + '&postid=' + postid + '&numcom=' + numcom + '&" . SESS . "';
		else answer2 = null;
	}
	
	function questionI(id) {
		answer3 = window.confirm ('" . $lang['a_delimgconfirm'] . "');
		if (answer3 == true) self.location.href = './modpost.php?action=deli&id=' + id + '&" . SESS . "';
		else answer3 = null;
	}
</script>\n\n";
}


// function - prints top of the page (image + menu)

function print_top() {
	require ("../language/" . BLANG . ".php");
	
	echo "<a name=\"top\"></a><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
		. "<tr><td align=\"center\" valign=\"middle\" class=\"menu\"><div class=\"calign\"><a href=\"" . BLOG_URL . "index.php\" title=\"" . stripslashes(BLOG_NAME) . "\">"
		. "<img src=\"../img/blog.gif\" alt=\"blog\" /></a></div></td></tr>\n"
		. "<tr><td class=\"menu\"><a href=\"" . BLOG_URL . "index.php\" class=\"menu\" title=\"" . $lang['index'] . "\">" . $lang['index'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "archives.php\" class=\"menu\" title=\"" . strtolower($lang['archives']) . "\">" . strtolower($lang['archives']) . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "gallery.php\" class=\"menu\" title=\"" . strtolower($lang['gallery']) . "\">" . strtolower($lang['gallery']) . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "search.php\" class=\"menu\" title=\"" . strtolower($lang['search']) . "\">" . strtolower($lang['search']) . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "rss.php\" target=\"_blank\" class=\"menu\" title=\"" . strtolower($lang['rss']) . "\">" . strtolower($lang['rss']) . "</a>\n"
		. "&nbsp;</td></tr>\n<tr><td>&nbsp;</td></tr>\n\n";
}


// function - prints admin menu

function print_admin() {
	require ("../language/" . BLANG . ".php");
	
	echo "<tr><td class=\"menu\"><a href=\"" . BLOG_URL . "admin/index2.php?" . SESS ."\" class=\"menu\" title=\"" . $lang['a_addpost'] . "\">" . $lang['a_addpost'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "admin/edit.php?display=list&" . SESS ."\" class=\"menu\" title=\"" . $lang['a_editpost'] . "\">" . $lang['a_editpost'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "admin/gallery.php?" . SESS ."\" class=\"menu\" title=\"" . $lang['gallery'] . "\">" . $lang['gallery'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "admin/conf.php?" . SESS ."\" class=\"menu\" title=\"" . $lang['a_config'] . "\">" . $lang['a_config'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "admin/help.php?" . SESS ."\" class=\"menu\" title=\"" . $lang['a_help'] . "\">" . $lang['a_help'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "admin/logout.php?" . SESS ."\" class=\"menu\" title=\"" . $lang['a_logout'] . "\">" . $lang['a_logout'] . "</a>\n"
		. "&nbsp;</td></tr>\n<tr><td>&nbsp;</td></tr>\n<tr><td>\n\n";
}


// function - prints the HTML footer

function print_footer() {
	echo "\n\n</td></tr>\n<tr><td>&nbsp;<br />&nbsp;<br />&nbsp;<br /></td></tr>\n"
		. "<tr><td align=\"center\" valign=\"middle\" class=\"copyright\">"
		. "<a href=\"http://www.e-motionalis.net\" target=\"_blank\" class=\"copyright\" title=\"" . stripslashes(EBLOGVER) . "\">" . stripslashes(EBLOGVER) . "</a><br />\n"
		. "<span class=\"copyright\">" . stripslashes(COPYRIGHT) . "</span></td></tr></table>\n";
	if (CENTER == "1") {
		echo "</div>\n";
	}	
	echo "<br />&nbsp;</body></html>";
}


// function - used to print the Help link for comments posting if On-Page Comments are allowed

function print_help($langu) {
	echo "&nbsp;&nbsp;\n";
	echo "<input type=\"button\" value=\"" . $langu . "\" class=\"buttons\" ";
	echo "onClick=\"";
	echo "window.open('help.php', 'help', 'toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=no, width=400, height=300, left=100, top=200');";
	echo "\" />\n";
}


// function - module of functions used to parse UBB tags to html and parse urls and such into html automatically

function urlTags($str) {
	$result = preg_replace("/\[url=(http:\/\/)?([^\]]*)\]([^\[]*)\[\/url]/i","<a href=\"http://\\2\" target=\"_blank\" title=\"URL\">\\3</a>",$str);
	return $result;
}

function urlReplace($strr) {
	$str = preg_replace("/(<a [^>]*>.+<\/a>)/ie","saveLinks('\\0',1)",$strr);
	$str = preg_replace("/src=\"?([^\s\"]*)\"?/ie","saveLinks('\\0',1)",$str);
	$str = preg_replace("/[^@\s\b,'!:]*@[^\s\n\r\t,]*/e","toEmail('\\0')",$str);
	$str = preg_replace("/(^|\b| |>)(http:\/\/|(www[0-9]?\.|ftp\.))([%:&.?=a-z0-9_\/\\-]*)/ei","toURL('\\1','\\2','\\3','\\4')",$str);
	$str = preg_replace("/\[~href([0-9]+)\]/ie","saveLinks('\\1',0)",$str);	
	return $str;
}

function saveLinks($link,$create) {
	global $saveIndex,$saveArray;
	$link = str_replace('\"','"',$link);
	if($create) {
		$saveArray[++$saveIndex] = $link;
		$result = "[~href$saveIndex]";
		return $result;
	}else{
		return "$saveArray[$link]";
	}
}

function toEmail($email) {
	if(preg_match("/[.,\n\s]/",substr($email,-1))) {
		$extra = substr($email,-1);
		$email = substr($email,0,strlen($email)-1);
	}
	return "<a href=\"mailto:$email\" title=\"e-mail\">$email</a>$extra";
}

function toURL($p1,$p2,$p3,$p4) {
	if(preg_match("/[.,\n!\s]/",substr($p4,-1))) {
		$extra = substr($p4,-1);
		$p4 = substr($p4,0,strlen($p4)-1);
	}
	if (strlen($p4) >= 40) {
		$pshort = substr($p4, 0, 25) . "..." . substr($p4, -15);
	} else {
		$pshort = $p4;
	}
	return "$p1<a href=\"http://$p3$p4\" target=\"_blank\" title=\"URL\">$p2$pshort</a>$extra";
}

function buisTags($str) {
	$result = preg_replace("/\[(\/)?([buis])\]/i","<\\1\\2>",$str);
	return $result;
}

function centerTag($str) {
	$result = preg_replace("/\[center\](.+)\[\/center\]/i","<div align=\"center\">\\1</div>",$str);
	return $result;
}

function imageTag($str) {
	$result = preg_replace("/\[img( right| left)?\](http:\/\/)?(.*)\[\/img\]/ie","toImg('\\1','\\3')",$str);
	return $result;
}

function toImg($aligni, $image) {
	$imgtype = substr($image, -3, 3);
	if ($imgtype == "jpg" || $imgtype == "JPG" || $imgtype == "png" || $imgtype == "PNG") {
		if (RESIZE == "1") {
			if ($aligni == " right") {
				return "<img src=\"../blog_resize.php?img=http://" . $image . "\" alt=\"image\" style=\"float:right; margin: 2px 0 2px 2px;\" />";
			} else if ($aligni == " left") {
				return "<img src=\"../blog_resize.php?img=http://" . $image . "\" alt=\"image\" style=\"float:left; margin: 2px 2px 2px 0;\" />";
			} else if ($aligni != " left" && $aligni != " right") {
				return "<img src=\"../blog_resize.php?img=http://" . $image . "\" alt=\"image\" />";
			}
		} else {
			if ($aligni == " right") {
				return "<img src=\"http://" . $image . "\" alt=\"image\" style=\"float:right; margin: 2px 0 2px 2px;\" />";
			} else if ($aligni == " left") {
				return "<img src=\"http://" . $image . "\" alt=\"image\" style=\"float:left; margin: 2px 2px 2px 0;\" />";
			} else if ($aligni != " left" && $aligni != " right") {
				return "<img src=\"http://" . $image . "\" alt=\"image\" />";
			}
		}
	} else {
		$result = toURL("", "http://", "", $image);
		return $result;
	}
}

function lineTag($str) {
	$result = $str = str_replace("[line]", "<img src=\"../img/line.gif\" height=\"1\" width=\"" . (MAX_WIDTH - 8) . "\" alt=\"line\" />", $str);
	return $result;
}

function parseUBB($str) {
	$result = imageTag($str);
	$result = urlTags($result);
	$result = urlReplace($result);
	$result = buisTags($result);
	$result = centerTag($result);
	$result = lineTag($result);
	return $result;
}


// function - used to parse the comments content and act on smileys

function parseSmileys($strr) {

	if (SMILEYS == "0") {
		return $strr;
		
	} else if (SMILEYS == "1") {
		$bli = "<img src=" . BLOG_URL . "img/smileys/blick.gif />";
		$fro = "<img src=" . BLOG_URL . "img/smileys/frown.gif />";
		$gri = "<img src=" . BLOG_URL . "img/smileys/grin.gif />";
		$sla = "<img src=" . BLOG_URL . "img/smileys/slant.gif />";
		$smi = "<img src=" . BLOG_URL . "img/smileys/smile.gif />";
		$sta = "<img src=" . BLOG_URL . "img/smileys/straight.gif />";
		$tan = "<img src=" . BLOG_URL . "img/smileys/tan.gif />";
		
		$str = str_replace(";)", $bli, $strr);
		$str = str_replace(";-)", $bli, $str);
		$str = str_replace(":(", $fro, $str);
		$str = str_replace(":-(", $fro, $str);
		$str = str_replace(":D", $gri, $str);
		$str = str_replace(":-D", $gri, $str);
		$str = str_replace(":d", $gri, $str);
		$str = str_replace(":-d", $gri, $str);
		$str = str_replace(":-/", $sla, $str);
		$str = str_replace(":)", $smi, $str);
		$str = str_replace(":-)", $smi, $str);
		$str = str_replace(":|", $sta, $str);
		$str = str_replace(":-|", $sta, $str);
		$str = str_replace(":P", $tan, $str);
		$str = str_replace(":-P", $tan, $str);
		$str = str_replace(":p", $tan, $str);
		$str = str_replace(":-p", $tan, $str);
		return $str;
		
	} else if (SMILEYS == "2") {
		$str = str_replace(";)", "", $strr);
		$str = str_replace(";-)", "", $str);
		$str = str_replace(":(", "", $str);
		$str = str_replace(":-(", "", $str);
		$str = str_replace(":D", "", $str);
		$str = str_replace(":-D", "", $str);
		$str = str_replace(":d", "", $str);
		$str = str_replace(":-d", "", $str);
		$str = str_replace(":-/", "", $str);
		$str = str_replace(":)", "", $str);
		$str = str_replace(":-)", "", $str);
		$str = str_replace(":|", "", $str);
		$str = str_replace(":-|", "", $str);
		$str = str_replace(":P", "", $str);
		$str = str_replace(":-P", "", $str);
		$str = str_replace(":p", "", $str);
		$str = str_replace(":-p", "", $str);
		return $str;
	}
}


// function - module of functions used to parse the articles content and save links to DB

function saveURLs($strr, $monthy, $postid, $saveimages) {
	preg_replace("/(^|\b| |>)(http:\/\/|(www[0-9]?\.|ftp\.))([%:&.?=a-z0-9_\/\\-]*)/ei", "saveLINK('\\1','\\2','\\3','\\4',$monthy,$postid,$saveimages)",$strr);
}
	
function saveLINK($p1, $p2, $p3, $p4, $monthy, $postid, $saveimages) {

	if (!$connection) {
		$connection = connect(NAME, PASSWD, BASE, SERVER);
	}
	
	$thelink = $p3 . $p4;
	$urltype = substr($thelink, -3, 3);
	
	if ($saveimages == "yes") {
		
		if ($urltype == "bmp" || $urltype == "BMP" || $urltype == "gif" || $urltype == "GIF") {
			return $p1 . $p2 . $p4;
		} else if ($urltype == "jpg" || $urltype == "JPG" || $urltype == "png" || $urltype == "PNG") {
			
			$result3 = mysql_query("SELECT * FROM blogimages WHERE url='$thelink'", $connection);
			$numrows = mysql_num_rows($result3);
			
			$image = $p2 . $p4;
			$size = getimagesize($image);
			$width = $size[0];
			$height = $size[1];
			
			if ($numrows != "" || $numrows != 0) {
				$result4 = mysql_query("UPDATE blogimages SET postid='$postid', date='" . time() . "', width='$width', height='$height' WHERE url='$thelink'", $connection);
				return $p1 . $p2 . $p4;
			} else {
	 			$result4 = mysql_query("INSERT INTO blogimages (postid, date, url, width, height) VALUES ('$postid', '" . time() . "', '$thelink', '$width', '$height')", $connection);
				return $p1 . $p2 . $p4;
			}
			
		} else {
			
			$result = mysql_query("SELECT * FROM bloglinks WHERE link='$thelink' AND monthy='$monthy'", $connection);
			$numrows = mysql_num_rows($result);
			
			if ($numrows != "" || $numrows != 0) {
				return $p1 . $p2 . $p4;
			} else {
	 			$result2 = mysql_query("INSERT INTO bloglinks (monthy, link) VALUES ('" . $monthy . "', '" . $thelink . "')", $connection);
				return $p1 . $p2 . $p4;
			}
			
		}
		
	} else {
			
		$result = mysql_query("SELECT * FROM bloglinks WHERE link='$thelink' AND monthy='$monthy'", $connection);
		$numrows = mysql_num_rows($result);
		
		if ($numrows != "" || $numrows != 0) {
			return $p1 . $p2 . $p4;
		} else {
 			$result2 = mysql_query("INSERT INTO bloglinks (monthy, link) VALUES ('" . $monthy . "', '" . $thelink . "')", $connection);
			return $p1 . $p2 . $p4;
		}
		
	}
}

?>