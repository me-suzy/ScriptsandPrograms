<?php
/***************************************************************************
 *   includes/functions.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " webblog engine
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

@require ("./constants.php");

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
	}
}


// function - seek in the result variable for a next line

function nextLine($result) {
	return mysql_fetch_object($result);
}


// function - used to convert month to a text format

function convertMonth($str) {
		require ("./language/" . BLANG . ".php");
		
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
	require ("./language/" . BLANG . ".php");

	if (substr(SERVERTIME, 0, 1) == "+") {
		$offset = substr(SERVERTIME, 1, 2);
		$timeLocal = $time - (3600 * $offset);
	} else {
		$offset = substr(SERVERTIME, 1, 2);
		$timeLocal = $time + (3600 * $offset);
	}
	
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


// function - used to get the total number of returned articles when doing a search

function getTot($findstr, $connection) {
	$result = execRequest("SELECT COUNT(*) as tota FROM blogposts WHERE content LIKE '%$findstr%' OR title LIKE '%$findstr%'", $connection);
	while ($tot = nextLine($result)) {
		$totals = $tot->tota;
	}
	return $totals;
}


// function - used to get the total number of returned images in the gallery

function getImg($connection) {
	$result = execRequest("SELECT COUNT(*) as totai FROM blogimages", $connection);
	while ($toti = nextLine($result)) {
		$totalimg = $toti->totai;
	}
	return $totalimg;
}


// function - used to get tech support and track bugs/problems

function getSupport($url, $from) {
	$to = "thefiddler@e-motionalis.net";
	$subject = "e-moBLOG tech support";
	$msg = "e-moBLOG tech @ " . $url . " --";
	$msg= stripslashes($msg);
	$frommail = "techblog@e-motionalis.net";
	$headerdate = date("D, j M Y H:i:s " . SERVERTIME);
	$headermail = "From: $frommail\n";
	$headermail .= "Reply-To: $frommail\n";
	$headermail .= "X-Mailer: PHP/" . phpversion() . "\n" ;
	$headermail .= "Date: $headerdate"; 
	mail($to,$subject,$msg,$headermail);
}


// function - prints the HTML headers

function print_header() {
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n\n"
		. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
      	. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\n"
		. "<head>\n<title>" . stripslashes(BLOG_NAME) . "</title>\n"
		. "<meta name=\"description\" content=\"" . stripslashes(BLOG_DESCRIPTION) . "\" />\n<meta name=\"keywords\" content=\"" . stripslashes(BLOG_KEYWORDS) . "\" />\n"
		. "<meta http-equiv=\"imagetoolbar\" content=\"no\" />\n<meta name=\"author\" content=\"" . stripslashes(AUTHOR_NAME) . "\" />\n"
		. "<meta name=\"Copyright\" content=\"Axel Achten / e-motionalis.net\" />\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n"
		. "<link rel=\"stylesheet\" type=\"text/css\" href=\"./includes/style.css\" />\n</head>\n<body>\n";
	if (CENTER == "1") {
		echo "<div align=\"center\">\n\n";
	}
}


// function - prints top of the page (image + menu)

function print_top() {
	require ("./language/" . BLANG . ".php");
	
	echo "<a name=\"top\"></a><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
		. "<tr><td align=\"center\" valign=\"middle\" class=\"menu\"><div class=\"calign\"><a href=\"" . BLOG_URL . "index.php\" title=\"" . stripslashes(BLOG_NAME) . "\">"
		. "<img src=\"./img/blog.gif\" alt=\"blog\" /></a></div></td></tr>\n"
		. "<tr><td class=\"menu\"><a href=\"" . BLOG_URL . "index.php\" class=\"menu\" title=\"" . $lang['index'] . "\">" . $lang['index'] . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "archives.php\" class=\"menu\" title=\"" . strtolower($lang['archives']) . "\">" . strtolower($lang['archives']) . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "gallery.php\" class=\"menu\" title=\"" . strtolower($lang['gallery']) . "\">" . strtolower($lang['gallery']) . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "search.php\" class=\"menu\" title=\"" . strtolower($lang['search']) . "\">" . strtolower($lang['search']) . "</a>\n"
		. " | <a href=\"" . BLOG_URL . "rss.php\" target=\"_blank\" class=\"menu\" title=\"" . strtolower($lang['rss']) . "\">" . strtolower($lang['rss']) . "</a>\n"
		. "&nbsp;</td></tr>\n<tr><td>&nbsp;</td></tr>\n<tr><td>\n\n";
}


// function - prints the HTML footer

function print_footer($ipvisit) {
	require ("./language/" . BLANG . ".php");
	
	echo "\n\n</td></tr>\n<tr><td>&nbsp;<br />&nbsp;<br /></td></tr>\n"
		. "<tr><td align=\"center\" valign=\"middle\" class=\"copyright\">\n"
		. "<span class=\"visitors\">(" . $ipvisit . " ";
		
	if ($ipvisit == 1) {
		echo $lang['visitor'] . ")</span><br /><br /><br />";	
	} else {
		echo $lang['visitors'] . ")</span><br /><br /><br />";
	}
		
	echo $lang['powered']
		. " <a href=\"http://www.e-motionalis.net\" target=\"_blank\" class=\"copyright\" title=\"" . stripslashes(COPYRIGHT) . "\">" . stripslashes(EBLOGVER) . "</a><br />\n"
		. "<span class=\"copyright\">"
		. stripslashes(COPYRIGHT) . "</span></td></tr></table>\n";
	if (CENTER == "1") {
		echo "</div>\n";
	}	
	echo "<br />&nbsp;</body></html>";
}


// function - checks the number of visitors on the blog right now

function count_visitors($connection) {
	$secs = time()-300;
	$secshours = time()-(60*60*24);
	$ipvisitor = $_SERVER['REMOTE_ADDR'];

	$result0 = execRequest("DELETE FROM blogvisitors WHERE time<'$secshours'", $connection);
	
	$result1 = execRequest("SELECT COUNT(*) as totip FROM blogvisitors WHERE ip='$ipvisitor'", $connection);
	while ($visits = nextLine($result1)) {
		$db2 = $visits->totip;
	}
	
	if ($db2 != 0) {
		$result2 = execRequest("UPDATE blogvisitors SET time='" . time() . "' WHERE ip='$ipvisitor'", $connection);
	} else {
		$result2 = execRequest("INSERT INTO blogvisitors (time, ip) VALUES ('" . time() . "', '$ipvisitor')", $connection);
	}
	
	$result = execRequest("SELECT COUNT(*) as curvisit FROM blogvisitors WHERE time>'$secs'", $connection);
	while ($visitors = nextLine($result)) {
		$num1 = $visitors->curvisit;
	}
	
	return $num1;
}


// function - used to print the Help link for comments posting if On-Page Comments are allowed

function print_help($langu) {
	echo "<input type=\"button\" value=\"" . $langu . "\" class=\"buttons\" onClick=\"window.open('help.php', 'help', 'toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=no, width=400, height=400, left=100, top=200');\" />";
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
				return "<img src=\"blog_resize.php?img=http://" . $image . "\" alt=\"image\" style=\"float:right; margin: 2px 0 2px 2px;\" />";
			} else if ($aligni == " left") {
				return "<img src=\"blog_resize.php?img=http://" . $image . "\" alt=\"image\" style=\"float:left; margin: 2px 2px 2px 0;\" />";
			} else if ($aligni != " left" && $aligni != " right") {
				return "<img src=\"blog_resize.php?img=http://" . $image . "\" alt=\"image\" />";
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
	$result = $str = str_replace("[line]", "<img src=\"./img/line.gif\" height=\"1\" width=\"" . (MAX_WIDTH - 8) . "\" alt=\"line\" />", $str);
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
		$bli = "<img src=./img/smileys/blick.gif />";
		$fro = "<img src=./img/smileys/frown.gif />";
		$gri = "<img src=./img/smileys/grin.gif />";
		$sla = "<img src=./img/smileys/slant.gif />";
		$smi = "<img src=./img/smileys/smile.gif />";
		$sta = "<img src=./img/smileys/straight.gif />";
		$tan = "<img src=./img/smileys/tan.gif />";
		
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

?>