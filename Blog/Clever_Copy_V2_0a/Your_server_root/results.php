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
$num_results = '0';
$getvnews="SELECT * FROM CC_vposted_news";
$getvnews2=mysql_query($getvnews) or die($no_news_waiting_error);
$getvnews3=mysql_fetch_array($getvnews2);
$result = mysql_query($getvnews);
$num_results = mysql_num_rows($result);
$ppcctr = '0';
$getppcsub="SELECT * FROM CC_ppcsubmitted";
$getppcsub2=mysql_query($getppcsub) or die($no_ppc_error);
$getppcsub3=mysql_fetch_array($getppcsub2);
$thisresult = mysql_query($getppcsub);
$ppcctr = mysql_num_rows($thisresult);
$getmenu = "SELECT * FROM CC_menu";
$getmenu2 = mysql_query($getmenu)or die($no_menu_error);
$getmenu3 = mysql_num_rows($getmenu2);
$getppc = "SELECT * FROM CC_ppc";
$getppc2 = mysql_query($getppc)or die($no_ppc_error); ;
$getppc3 = mysql_num_rows($getppc2);
$getweblinks = "SELECT * FROM CC_weblinks";
$getweblinks2 = mysql_query($getweblinks)or die($no_weblinks_error); ;
$getweblinks3 = mysql_num_rows($getweblinks2);
$getlinksub= "SELECT * FROM CC_weblinksposted";
$getlinksub2=mysql_query($getlinksub) or die($no_ppc_error);
$getlinksub3=mysql_fetch_array($getlinksub2);
$linksresult = mysql_query($getlinksub);
$wlctr = mysql_num_rows($linksresult);
$hitexists=@mysql_num_rows(@mysql_query("SELECT * FROM CC_online")or die($no_vonline_error));
$queryright="SELECT * FROM CC_custom_blocks";
$style = $getprefs3[personality];
$sitename = $getprefs3[sitename];
$siteaddress = $getprefs3[siteaddress];
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
<html><head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head><body>
<?php
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
if($getprefs3[shownewsticker]==1){echo "<br>";include "ticker.php";}
$showmax=10;
$searchtype=$HTTP_POST_VARS['searchtype'];
$searchterm=$HTTP_POST_VARS['searchterm'];
if ($searchtype =="")
{
   $searchtype = $_GET['searchtype'];
   $searchterm = $_GET['searchterm'];
}
if(!isset($_GET['start']))
{
    $start=0;
}else{
    $start=$_GET['start'];
}
$searchterm= trim($searchterm);
$searchtype = addslashes($searchtype);
$searchterm = addslashes($searchterm);
$query = "SELECT * FROM CC_news WHERE ".$searchtype." LIKE '%".$searchterm."%' ORDER BY realtime DESC";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
echo "<table width = '100%' border = '0'><tr><td>";
echo "<br><b><center>$searches_found_label - $num_results</center></b><br><br>";
echo "<b><center>$search_results_label $searchtype  $searchterm. </center></b>";
echo "<b><center>$most_recent_results_label</center></b><br><hr></td></tr><tr><td>";
$query = "SELECT * FROM CC_news WHERE ".$searchtype." LIKE '%".$searchterm."%' ORDER BY realtime DESC LIMIT $start,$showmax";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
for ($i=0; $i <$num_results; $i++)
{
   $row = mysql_fetch_array($result);
   echo "<b>$row[newstitle]</b> $posted_by_label $row[author] $row[thetime]<br><br>";
   echo "$row[introcontent]<br>";
   if(strlen($row['maincontent'])>1)
   {
      echo "<tr><td><br><a title = '$more_link_alt_text_label' href='more.php?ID=$row[entryid]'><b>$more_label</a></b><br>";
   }
   if($row[allowcomments]==1)
   {
      echo "<br><a title = '$read_other_persons_comments_alt_text_label' href='comments.php?ID=$row[entryid]&start=0'>[$row[numcomments]  $comments_label</a>] ~ <A  title = '$leave_comments_alt_text_label' href='postcomment.php?ID=$row[entryid]'>[$add_comment_label]</a>";
   }
   echo '<br></p><hr>';
   if(isset($_SESSION['cadmin']))
   {
      echo "$news_item_id_label = ";
      echo htmlspecialchars(stripslashes($row['entryid']));
      echo ":&nbsp;";
      echo "<A href='../admin/editblog.php?ID=$row[entryid]'>$edit_item_label</a> - <A href='../admin/deleteentry.php?ID=$row[entryid]'>$delete_item_label</a>";
      echo "<hr><br>";
   }
}
echo "<tr><td colspan = '2'><center><b>$go_to_page_label</b></center></td></tr>";
echo "<tr><td colspan = '2' valign='top'>";
$order="SELECT * FROM CC_news WHERE ".$searchtype." LIKE '%".$searchterm."%' ORDER BY realtime DESC";
$order2=mysql_query($order) or die(mysql_error());
$ctr=0;
$fixed=0;
$md=1+$ctr/$showmax;
$num=mysql_num_rows($order2);
$next=$start+$showmax;
echo "<center>";
if($start>=$showmax)
{
    echo "<A href='results.php?start=0&searchterm=$searchterm&searchtype=$searchtype'><-</a>&nbsp;";
}
while($order3=mysql_fetch_array($order2))
{
   if($fixed>=$start-3*$showmax&&$fixed<=$start+7*$showmax)
   {
      if($fixed%$showmax==0)
      {
         echo "<A href='results.php?start=$ctr&searchterm=$searchterm&searchtype=$searchtype'>$md</a>&nbsp;";
         $totalpages = $md;
      }
   }
   $ctr=$ctr+1;
   $md=1+$ctr/$showmax;
   $fixed++;
}
if($start<=$num-$showmax)
{
   $end=$fixed-$showmax;
   echo "<A href='results.php?start=$end&searchterm=$searchterm&searchtype=$searchtype'>-></a>&nbsp;";
}
$pageno = ($start/$showmax)+1;
$pageno = number_format($pageno,0);
echo "<br>$page_number_label $pageno/$totalpages";
echo "</td></tr></table><br>";
echo "</center></td>";
include "rightblocks.php";
include "endlayout.php";
?>