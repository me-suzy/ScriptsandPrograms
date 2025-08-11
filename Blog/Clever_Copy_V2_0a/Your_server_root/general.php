<?php
session_start();
include "languages/default.php";
include "admin/languages/default.php";
include "admin/connect.inc";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
$site = $getprefs3[siteaddress];
echo "<head><title>General</title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
if ($getprefs3[showrss]==1)
  {
  echo "<a href='$getprefs3[siteaddress]/news/feed.xml' target=new>$site_rss_feed_label</a><br>";
}
echo "<a href='$getprefs3[siteaddress]/contactsend.php'>$contact_us_label</a><br>";
?>
<script language="JavaScript">
<!--
if (navigator.appName == 'Microsoft Internet Explorer' && parseInt(navigator.appVersion) >= 4){
document.write('<a href=\"#\" onclick=\"javascript:window.external.AddFavorite(location.href,document.title)\">');
document.write('<?php echo $bookmark_netscape_label; ?></a>');
}else{
var msg = "<?php echo $bookmark_netscape_label; ?>";
if(navigator.appName == "Netscape") msg += "  (Ctrl-D)";
document.write(msg);
}
// -->
</script>
<br>
<a href='javascript:;' onClick='window.print();return false'><?php echo $print_this_page_label; ?></a>
<br>
<!--[if IE]>
<a HREF onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('<?php echo $site; ?>');"><?php echo $make_homepage_label; ?></a>
<![endif]-->
<?php
echo "<br><a title = '$watch_site_exp_label' href='$getprefs3[siteaddress]/sitewatch.php'>$watch_this_site_label</a>";

?>