<?
/***************************************************************************
 *   rss.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   (idea and a bit of help from Cristian Ocampo / www.cacko.tk - thanks!)
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

// define the content of the page
header ("content-type: text/xml");

require ("./includes/db.php");
require ("./includes/functions.php");
require ("./constants.php");

if (!$connection) {
	$connection = connect(NAME, PASSWD, BASE, SERVER);
}

// check mobile blogging messages if set as enabled
if (MOBLOGGING == "1") {
	$timenow = time();
	$result = execRequest("SELECT moblog FROM blogconfig", $connection);
	while ($rmoblog = nextLine($result)) {
		if ($timenow > ($rmoblog->moblog + 600)) {
				require ("moblogging.php");
				$resulta = execRequest("UPDATE blogconfig SET moblog='" . time() . "'", $connection);
		}
	}
}

// check if language option has already been loaded
if (!defined("BLANG")) {
	$result = execRequest("SELECT language FROM blogconfig", $connection);
	while ($lan = nextLine($result)) {
		define (BLANG, "$lan->language");
	}
}

// set the current date - conforms to Date and Time Specification of RFC 822
// except for the year, which is preferrably displayed with four digits
$date = date("D, d M Y H:i:s T");


// sets the default posts to be displayed to the ones from the current month
$monthy = date("Ym");


// starting XML/RSS output
// first display common data, almost static part
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n\n";
echo "<!-- RSS generator ". COPYRIGHT ." with help from Cristian Ocampo / www.cacko.tk -->\n\n\n";
echo "<rss version=\"2.0\">\n\n";
echo "\t<channel>\n";
echo "\t\t<title>" . stripslashes(BLOG_NAME) . "</title>\n";
echo "\t\t<link>" . BLOG_URL . "</link>\n";
echo "\t\t<description>" . stripslashes(BLOG_DESCRIPTION) . "</description>\n";
echo "\t\t<language>" . BLANG . "</language>\n";
echo "\t\t<copyright>". stripslashes(COPYRIGHT) ."</copyright>\n";
echo "\t\t<managingEditor>" . AUTHOR_EMAIL . "</managingEditor>\n";
echo "\t\t<webMaster>" . AUTHOR_EMAIL . "</webMaster>\n";
echo "\t\t<lastBuildDate>" . $date . "</lastBuildDate>\n";
echo "\t\t<generator>". stripslashes(EBLOGVER) ."</generator>\n";
echo "\t\t<docs>http://blogs.law.harvard.edu/tech/rss/</docs>\n";
echo "\t\t<ttl>30</ttl>\n\n\n";

// retrieve articles from database and display them
$result = execRequest("SELECT * FROM blogposts ORDER BY date DESC LIMIT 15", $connection);
while ($posts = nextLine($result)) {
		
		$content = parseUBB(stripSlashes($posts->content));
		$content = nl2br($content);
		
		$content = preg_replace("'<script[^>]*>.*?</script>'si","",$content);
		$content = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2 (\1)', $content);
		$content = preg_replace('/<!--.+?-->/','',$content);
		$content = preg_replace('/{.+?}/','',$content);
		$content = strip_tags($content);
		
		// we're displaying the post date using the same conformed timestamp
		$postdate = date("D, d M Y H:i:s T", $posts->date);
		
		// we're removing some special characters from the articles title (XML doesn't like those here)
		$titledef = stripSlashes($posts->title);
		$titledef = html_entity_decode($titledef);
		$titledef = preg_replace("/[^\w\s.:=;,@#'!+-_$]+/", "", $titledef);
		$titledef = strtoupper($titledef);

		echo "\t\t\t<item>\n";
		echo "\t\t\t<title>" . $titledef . "</title>\n";
		echo "\t\t\t<link>" . BLOG_URL . "/index.php?monthy=" . $posts->monthy . "#" . $posts->id . "</link>\n";
		echo "\t\t\t<description>" . substr($content,0,200) . " (...)</description>\n";
		echo "\t\t\t<pubDate>" . $postdate . "</pubDate>\n";
		echo "\t\t\t<guid>" . BLOG_URL . "/index.php?monthy=" . $posts->monthy . "#" . $posts->id . "</guid>\n";
		echo "\t\t\t</item>\n\n";
}

// close RSS feed page
echo "\t</channel>\n";
echo "</rss>";
?>