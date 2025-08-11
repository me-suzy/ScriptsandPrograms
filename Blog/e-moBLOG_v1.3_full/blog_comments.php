<?php
/***************************************************************************
 *   blog_comments.php
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

require ("./includes/db.php");
require ("./includes/functions.php");

if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

// check if language option has already been loaded
if (!defined("BLANG")) {
	$result = execRequest("SELECT language FROM blogconfig", $connection);
	while ($lan = nextLine($result)) {
		define (BLANG, "$lan->language");
	}
}
require ("./language/" . BLANG . ".php");
require ("./constants.php");

print_header();
print_top();

$postmail = "";

// start output differently according to the options concerning the comments (if on page)
if (COMMENTS == "1") {

	echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";

	$result = execRequest("SELECT * FROM blogposts WHERE id = '$id'", $connection);
	while ($posts = nextLine($result)) {
			$content = parseUBB(stripSlashes($posts->content));
			$content = nl2br($content);
			$content = parseSmileys($content);
			echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 8) . "\"><a name=\"" . $posts->id . "\" class=\"blogtitle\">" . stripSlashes(strtoupper($posts->title)) . "</a>\n"
				. "<br />" . convertDate($posts->date) . "</td></tr>\n"
				. "<tr><td>\n";
			
			if ($posts->audio != "") {
				echo "<img src=\"./img/audio.gif\" alt=\"audio\" /> " . stripSlashes($posts->audio) . "<br />\n"
					. "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
			}

			$numcom = $posts->nrcomments;
	
			echo "<br />" . $content . "<br />&nbsp;\n";
				
			// if the quote of the day field had been filled, display it
			if ($posts->dayquote != "") {
				echo "<img src=\"./img/quote.gif\" alt=\"quote\" /> " . stripSlashes($posts->dayquote) . "<br />\n";
			}
				
			echo "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n"
				. "<div class=\"ralign\">\n";
				
			if (POSTER == "1") {
				echo "<a href=\"mailto:" . stripSlashes($posts->email) . "\" title=\"e-mail\">" . stripSlashes($posts->name) . "</a> | ";
			}
				
			echo "<a href=\"" . BLOG_URL . "/index.php?monthy=" . $posts->monthy . "#" . $posts->id . "\" title=\"" . $lang['link'] . "\">\n"
				. $lang['link'] . "</a> | <a href=\"\" title=\"" . $lang['comments'] . "\">" . $posts->nrcomments . " \n";
			
			if ($posts->nrcomments <= 1) {
				echo $lang['comment'];
			} else if ($posts->nrcomments > 0) {
				echo $lang['comments'];
			}
			
			echo "</a> </div></td></tr>\n<tr><td>&nbsp;</td></tr>\n";
	}

	echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 8) . "\"><span class=\"blogtitle\">" . strtoupper($lang['comments']) . "</span></td></tr>\n";

	if ($numcom != "0") {
		$result2 = execRequest("SELECT * FROM blogcomments WHERE postid = '$id' ORDER BY date ASC", $connection);
		while ($comments = nextLine($result2)) {
				$content = parseUBB(stripSlashes($comments->content));
				$content = nl2br($content);
				$content = parseSmileys($content);
		
			if ($comments->email == "") {
				$namestr = stripSlashes($comments->name);
			} else {
				$namestr = "<a href=\"mailto:" . stripSlashes($comments->email) . "\" class=\"commtitle\" title=\"e-mail\">" . stripSlashes($comments->name) . "</a>";
			}
			
			echo "<tr><td><span class=\"commtitle\">" . $lang['posted_by'] . " " . $namestr . " |</span> " . convertDate($comments->date) . "<br />\n"
				. $content . "<br />&nbsp;\n"
				. "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br /></td></tr>\n";
		}
	} else {
		echo "<tr><td>" . $lang['no_comments'] . "<br />\n"
			. "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /></td></tr>\n";
	}

	$ip = $REMOTE_ADDR;
	
	echo "<tr><td>&nbsp;<br /></td></tr>\n";

// other possiblity for the output, still according to the options (here, if mail)
} else if (COMMENTS == "2") {

	echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n";

	$result = execRequest("SELECT * FROM blogposts WHERE id = '$id'", $connection);
	while ($posts = nextLine($result)) {
			$content = parseUBB(stripSlashes($posts->content));
			$content = nl2br($content);
			$content = parseSmileys($content);
			echo "<tr><td class=\"blogheader\" width=\"" . (MAX_WIDTH - 8) . "\"><a name=\"" . $posts->id . "\" class=\"blogtitle\">" . stripSlashes(strtoupper($posts->title)) . "</a>\n"
				. "<br />" . convertDate($posts->date) . "</td></tr>\n"
				. "<tr><td>\n";
			
			if ($posts->audio != "") {
				echo "<img src=\"./img/audio.gif\" alt=\"audio\" /> " . stripSlashes($posts->audio) . "<br />\n"
					. "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
			}

			$numcom = $posts->nrcomments;
			$postmail = stripSlashes($posts->email);
			$article = stripSlashes($posts->title);
	
			echo "<br />" . $content . "<br />&nbsp;\n";
				
			// if the quote of the day field had been filled, display it
			if ($posts->dayquote != "") {
				echo "<img src=\"./img/quote.gif\" alt=\"quote\" /> " . stripSlashes($posts->dayquote) . "<br />\n";
			}
				
			echo "<img src=\"./img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n"
				. "<div class=\"ralign\">\n";
				
			if (POSTER == "1") {
				echo "<a href=\"mailto:" . stripSlashes($posts->email) . "\" title=\"e-mail\">" . stripSlashes($posts->name) . "</a> | ";
			}
			
			echo "<a href=\"" . BLOG_URL . "/index.php?monthy=" . $posts->monthy . "#" . $posts->id . "\" title=\"" . $lang['link'] . "\">\n"
				. $lang['link'] . "</a></div></td></tr>\n<tr><td>&nbsp;<br /></td></tr>\n";
	}
	
// don't allow the page to run if the options are set to 'no comments'
} else if (COMMENTS == "0") {
	echo "hacking attempt.";
	exit;
}

?>

 <tr>
  <td class="blogheader" width="<?php echo (MAX_WIDTH - 8); ?>"><span class="blogtitle"><?php echo strtoupper($lang['post']); ?></span></td>
 </tr>
 <tr>
  <td align="center" valign="middle" width="<?php echo (MAX_WIDTH - 8); ?>">
  
<?php

// handle eventual errors sent by the comment add scripts
if ($err == "fields") {
	echo "<span class=\"error\">" . $lang['field_error'] . "</span>\n";
} else if ($err == "fields2") {
	echo "<span class=\"error\">" . $lang['field2_error'] . "</span>\n";
} else if ($err == "mail") {
	echo "<span class=\"error\">" . $lang['email_error'] . "</span>\n";
} else if ($status == "sent") {
	echo "<span class=\"status\">" . $lang['email_sent'] . "</span>\n";
}

?>

<form action="<?php

// choose an action for the form according to options
if (COMMENTS == "1") {
	echo "blog_postcomment.php";
} else if (COMMENTS == "2") {
	echo "blog_mail_postcomment.php";
}

?>" method="post" autocomplete="on">

  <table cellspacing="0" cellpadding="0" width="250" border="0" align="center">
   <tr>
    <td width="90"><?php echo $lang['uname'] . ":"; ?></td>
	<td align="right"><input type="text" name="name" size="40" maxlength="50" class="boxes" value="<?php echo $HTTP_COOKIE_VARS["e-moblog_name"]; ?>" /></td>
   </tr>
   <tr>
    <td><?php echo $lang['uemail'] . ":"; ?></td>
	<td align="right"><input type="text" name="email" size="40" maxlength="70" class="boxes" value="<?php echo $HTTP_COOKIE_VARS["e-moblog_email"]; ?>" /></td>
   </tr>
   <tr>
    <td colspan="2"><?php echo $lang['ucomment'] . ":"; ?></td>
   </tr>
   <tr>
    <td colspan="2" align="right"><textarea name="content" cols="60" rows="5" class="boxes"></textarea></td>
   </tr>
   <tr>
    <td colspan="2" align="center">
	
		<input type="submit" value="<?php echo $lang['post_button']; ?>" class="buttons" />&nbsp;
		<input type="reset" value="<?php echo $lang['clear_button']; ?>" class="buttons" />&nbsp;
	
	<?php
	if (COMMENTS == "1") {
		print_help($lang['help']);
	}
	?>
	
	    <input type="hidden" name="ip" value="<?php echo $ip; ?>" />
		<input type="hidden" name="postid" value="<?php echo $id; ?>" />
		<input type="hidden" name="numcom" value="<?php echo $numcom; ?>" />
		<input type="hidden" name="postmail" value="<?php echo $postmail; ?>" />
		<input type="hidden" name="article" value="<?php echo $article; ?>" />
	</td>
   </tr>
  </table>
</form>

  </td>
 </tr>
</table>

<?php
$visitors = count_visitors($connection);
print_footer($visitors);
?>