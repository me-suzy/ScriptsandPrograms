<?php
include "admin/feedcreator.class.php";
include "admin/languages/default.php";
include "admin/connect.inc";
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$siteaddress = $getprefs3[siteaddress];
$sitetitle = $getprefs3[title];
$rssimageurl = $getprefs3[rssimageurl];
$rss = new UniversalFeedCreator();
$rss->useCached();
$rss->title = $getprefs3[rsstitle];
$rss->description = $getprefs3[rssdescription];
$rss->link  = $getprefs3[siteaddress];
$rss->syndicationURL = $siteaddress.$PHP_SELF;
$image = new FeedImage();
$image->title = $getprefs3[rssimagetitle];
$image->url = "$siteaddress$rssimageurl";
$image->link = $siteaddress;
$image->description = $getprefs3[rssimagedescription];
$rss->image = $image;
$getfeed="SELECT last_generated from CC_rssfeed";
$getfeed2=mysql_query($getfeed) or die($no_rssfeed_error);
$getfeed3=mysql_fetch_array($getfeed2);
$last_update =  $getfeed3[last_generated];
$res = mysql_query("SELECT * FROM CC_news WHERE realtime > '$last_update' ORDER BY realtime DESC");
$error_msg .= mysql_error();
echo $error_msg;
while ($data = mysql_fetch_object($res)) {
    $item = new FeedItem();
    $item->title = $data->newstitle;
    $item->link = $data->url;
    $item->description = $data->introcontent;
    $item->date = "";//$data->thetime;
    $item->source = $siteaddress;
    $item->author = $sitetitle;
    $rss->addItem($item);
}
$rss->saveFeed("RSS1.0", "news/feed.xml");
$last_generated = time();
$update_rss_timestamp =  "UPDATE CC_rssfeed SET last_generated='$last_generated'";
mysql_query($update_rss_timestamp)or die($no_rssfeed_error);
?>