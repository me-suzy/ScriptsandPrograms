<?php
session_start();
include "antihack.php";
include "admin/connect.inc";
include "languages/default.php";
include "admin/languages/default.php";
include "banned.php";
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getblocks="SELECT * FROM CC_block_names";
$getblocks2=mysql_query($getblocks) or die($no_blocks_error);
$getblocks3=mysql_fetch_array($getblocks2);
$getvnews="SELECT * FROM CC_vposted_news";
$getvnews2=mysql_query($getvnews) or die($no_news_waiting_error);
$getvnews3=mysql_fetch_array($getvnews2);
$result = mysql_query($getvnews);
$num_results = mysql_num_rows($result);
$getmenu = "SELECT * FROM CC_menu";
$getmenu2 = mysql_query($getmenu)or die($no_menu_error);
$getmenu3 = mysql_num_rows($getmenu2);
$getppc = "SELECT * FROM CC_ppc";
$getppc2 = mysql_query($getppc)or die($no_ppc_error); ;
$getppc3 = mysql_num_rows($getppc2);
$getweblinks = "SELECT * FROM CC_weblinks";
$getweblinks2 = mysql_query($getweblinks)or die($no_weblinks_error); ;
$getweblinks3 = mysql_num_rows($getweblinks2);
$hitexists=@mysql_num_rows(@mysql_query("SELECT * FROM CC_online")or die($no_vonline_error));
$queryright="SELECT * FROM CC_custom_blocks";
$style = $getprefs3[personality];
$sitename = $getprefs3[sitename];
$cpc_rate = $getprefs3[cpc_default_rate];
$show_numrandom_headlines = $getprefs3[show_numrandom_headlines];
if ($getuser3[user_site_name]==""){
      $visitor_name = $guest_name_label;
   }else{
      $visitor_name =  $getuser3[user_site_name];
}
if(isset($_SESSION['cuser'])){
   $bloguser=$_SESSION['cuser'];
   $getuser="SELECT user_site_name from CC_users where username='$bloguser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   $visitor_name =  $getuser3[user_site_name];
}
?>
<head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<!-- Start Avanti Web Stats tracking code - copyright (c) 2004 Liquid Frog Software - www.liquidfrog.com -->
<script src="<?$siteaddress?>/stats/script.js" language="JavaScript"></script>
<noscript><img src="<?$siteaddress?>/stats/script.php?image=1&javascript=false"></noscript>
</html>
<?php
@mysql_query("UPDATE CC_prefs SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
include "layout.php";
include "header.php";
echo "<table border='0' width=100%>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
include "leftblocks.php";
echo "<td valign='top' ><center>";
echo "<img src=images/seperator.gif border='0' width='10' height='1'>";
if($getprefs3[showseparator]==1){
echo "<hr>";}
if ($visitor_name == $guest_name_label){
echo "$getprefs3[title] $welcomes_visitor_label - $visitor_name"; }
else {
echo  "$welcome_back_user_label $visitor_name"; }
if($getprefs3[showwelcome_message]==1){
include "welcome.php";}
if($getprefs3[shownewsticker]==1){
include "ticker.php";}
echo "<br><br>";
$ID=$_GET['ID'];
$getblog="SELECT * from CC_news where entryid='$ID'";
$getblog2=mysql_query($getblog) or die($no_news_error);
while($getblog3=mysql_fetch_array($getblog2))
{
  echo "<table><tr><td><b>$getblog3[newstitle]</b> $posted_by_label $getblog3[author]<br>";
  echo "$getblog3[thetime]</td></tr>";
  echo "<tr><td>";
  echo "$getblog3[introcontent]<br><br><br>";
  echo "$getblog3[maincontent]<br>";
  if($getblog3[allowcomments]==1)
  {
    echo "<br><A href='comments.php?ID=$getblog3[entryid]&start=0'>$getblog3[numcomments] $comments_label</a> - <A href='postcomment.php?ID=$getblog3[entryid]'>$add_your_comment_button_label</a>";
  }
   if(isset($_SESSION['cadmin']))
  {
   $blogadmin=$_SESSION['cadmin'];
   $getadmin="SELECT * from CC_admin where username='$cadmin'";
   $getadmin2=mysql_query($getadmin) or die($no_login_error);
   $getadmin3=mysql_fetch_array($getadmin2);
   echo "<tr><td colspan = '2'><br><br><font color= 'red'>$admin_recognised_label ";
   echo  $getadmin3['username'];
   echo"$actions_label<a href='admin/editblog.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color= 'red'> $edit_item_label</a> - <a href='admin/deleteentry.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color= 'red'>$delete_item_label</font></a>";
  }
}
echo "</center></td>";
echo "</td></tr></table>";
echo "</center></td>";
include "rightblocks.php";
include "endlayout.php";
?>