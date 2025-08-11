<?php
/***************************************************************************
 *   gallery.php
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

require ("../language/" . BLANG . ".php");
require ("./constants.php");

print_header2();
print_jscript();
print_top();
print_admin();

if ($imagemod != "" || $imagemod != 0) {
	$formaction = "modi";
	$result0 = execRequest("SELECT * FROM blogimages WHERE id='$imagemod'", $connection);
	while ($modimg = nextLine($result0)) {
		$modurl = stripslashes($modimg->url);
		$moddescr = stripslashes($modimg->descr);
		$modid = $modimg->id;
	}
} else {
	$formaction = "addi";
	$modurl = "";
	$moddescr = "";
	$modid = "";
}

echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . MAX_WIDTH . "\">\n"
	. "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\">\n"
	. "<span class=\"blogtitle\">" . strtoupper($lang['a_addimage']) . "</span></td></tr>\n"
	. "<tr><td width=\"" . MAX_WIDTH . "\">\n";

echo "<form action=\"modpost.php?action=$formaction\" method=\"post\" name=\"post\">"
	. "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"250\" align=\"center\">";

echo "<tr>
	  <td width=\"90\">" . $lang['a_url'] . ": *</td>
	  <td align=\"right\"><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"255\" class=\"boxes\" value=\"$modurl\" /></td>
	 </tr>
	 <tr>
	  <td width=\"90\" colspan=\"2\">" . $lang['a_descr'] . ": *</td>
	 </tr>
	 <tr>
	  <td colspan=\"2\" align=\"right\"><textarea name=\"descr\" cols=\"55\" rows=\"6\" class=\"boxes\">$moddescr</textarea></td>
	 </tr>
	 <tr>
	  <td colspan=\"2\" align=\"right\">
	  <input type=\"hidden\" value=\"$modid\" name=\"id\" />
	  <input type=\"submit\" value=\"" . $lang['a_addimage'] . "\" class=\"buttons\" />&nbsp;&nbsp;
	  <input type=\"reset\" value=\"" . $lang['a_clearbutton'] . "\" class=\"buttons\" />
	  </td>
	 </tr>
	</table>
	</form>";

echo "<br />&nbsp;</td></tr>\n\n";
	
echo "<tr><td class=\"blogheader\" width=\"" . MAX_WIDTH . "\">\n"
	. "<span class=\"blogtitle\">" . strtoupper($lang['gallery']) . "</span></td></tr>\n"
	. "<tr><td width=\"" . MAX_WIDTH . "\">\n"
	. "<br />\n\n";

$totals = getImg($connection);
$numberResults = 10;

if ($totalimg > $numberResults) {
	if (!$page || $page == "") {
		$page = 1;
	}
	
	if ($page == 1) {
		$slimit = "LIMIT 0,$numberResults";
	} else {
		$begin = ($page - 1) * $numberResults;
		$slimit = "LIMIT $begin,$numberResults";
	}	
} else {
	$slimit = "";	
}
	
echo "<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"" . (MAX_WIDTH - 8) . "\"";
	
$result = execRequest("SELECT * FROM blogimages ORDER BY date DESC $slimit", $connection);
while ($gallery = nextLine($result)) {
	
	echo "<tr>\n<td width=\"150\" valign=\"top\">\n<a href=\"#\" onClick=\"window.open('http://$gallery->url', 'image', 'toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=no, width=" . ($gallery->width + 20) . ", height=" . ($gallery->height + 20) . ", left=100, top=200');\">";
	echo "<img src=\"../blog_resize.php?rwidth=150&img=http://" . $gallery->url . "\" alt=\"image\" />";
	echo "</a>\n</td>\n<td valign=\"top\">\n";
	echo convertDate($gallery->date) . "<br />\n";
	
	if ($gallery->postid != "" && $gallery->postid != 0) {
		$result1 = execRequest("SELECT id, title, monthy FROM blogposts WHERE id='$gallery->postid'", $connection);
		while ($post = nextLine($result1)) {
			echo $lang['frompost'] . ": <a href=\"" . BLOG_URL . "/index.php?monthy=" . $post->monthy . "#" . $post->id . "\" title=\"" . $lang['link'] . "\">" . stripslashes($post->title) . "</a>\n";
		}
		
	} else {
		echo "description: " . stripslashes($gallery->descr) . "<br /><br />";
		echo "<a href=\"./gallery.php?imagemod=" . $gallery->id . "&" . SESS . "\" title=\"" . $lang['a_edit'] . "\">" . $lang['a_edit'] . "</a> - "
			. "<a href=\"javascript:questionI('" . $gallery->id . "');\" title=\"" . $lang['a_delete'] . "\">" . $lang['a_delete'] . "</a>";
	}
	
	echo "\n</td>\n</tr>\n";
	$isvalid = TRUE;
}

if ($isvalid != TRUE) {
	echo "<tr><td align=\"center\">" . $lang['no_images'] . "</td></tr>";
}

if ($totalimg > $numberResults) {
	echo "<tr><td colspan=\"2\" align=\"right\">\n\n<form action=\"search.php?action=search\" method=\"post\" name=\"pages\">\n"
		. "<div class=\"ralign\">" . $lang['numpages'] . " \n"
		. "<select name=\"page\" onChange=\"document.pages.submit();\" class=\"boxes\">\n";
	
	$pageN = (int) $totalimg/$numberResults;
	
	for($i = 1; $i <= $pageN + 1; $i++) {
		if ($i == $page) {
			echo "<option value=\"$i\" selected=\"selected\"> " . $lang['page'] . " $i</option>\n";
		} else {
			echo "<option value=\"$i\"> " . $lang['page'] . " $i</option>\n";
		}
	}
	
	echo "</select></div></form>\n\n</td></tr>\n\n";
}

echo "</table>\n\n";

echo "<br /><img src=\"../img/line.gif\" width=\"" . (MAX_WIDTH - 8) . "\" height=\"1\" alt=\"line\" /><br />\n";
echo "</td></tr></table>\n\n";

print_footer();
?>