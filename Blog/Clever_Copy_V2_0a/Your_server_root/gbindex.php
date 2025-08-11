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
$siteaddress="$siteaddress/";
$page_width = $getprefs3[main_page_width];
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
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
  echo "<font size = '4' font color = 'red'><center><b>$browse_in_admin_mode_label<br></center></b></font>";
}
?>
<html><head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
<script>
<!-- Begin
function goToaddURL() { window.location = "gbookaddentry.php"; }
//  End -->
</script>
</head>
<!-- Start Avanti Web Stats tracking code - copyright (c) 2004 Liquid Frog Software - www.liquidfrog.com -->
<script src="<?$siteaddress?>stats/script.js" language="JavaScript"></script>
<noscript><img src="<?$siteaddress?>stats/script.php?image=1&javascript=false"></noscript>
</html>
<?php
@mysql_query("UPDATE CC_prefs SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
include "layout.php";
include "header.php";
echo "<table border='0' width = '100%'>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
include "leftblocks.php";
echo "<td valign='top' ><center>";
echo "<img src=images/seperator.gif border='0'  height='1'>";
if($getprefs3[showseparator]==1){echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
if ($visitor_name == $guest_name_label){
echo "<font color = '$getprefs3[linkfont_color]'>$getprefs3[title] $welcomes_visitor_label - $visitor_name";
}else{ echo  "<font color = '$getprefs3[linkfont_color]'>$welcome_back_user_label $visitor_name"; }
if($getprefs3[showwelcome_message]==1){include "welcome.php";}
if($getprefs3[shownewsticker]==1){include "ticker.php";}
$showmax=15;
echo "<table width=100% border='0'>";
echo "<tr><td colspan='3'><center><b>$guestbook_title_label</b><br><br></center></td></tr>";
echo "<tr><td colspan = '3' valign='top' align = 'left'>";
if(!isset($_GET['start']))
{
    $start=0;
}
else
{
    $start=$_GET['start'];
}
$order="SELECT * from CC_guestb";
$order2=mysql_query($order) or die($no_gbook_error);
$tctr=0;
$fixed=0;
$md=1+$tctr/$showmax;
$num=mysql_num_rows($order2);
$prev=$start-$showmax;
$next=$start+$showmax;
$pageno = ($start/$showmax)+1;
$pageno = number_format($pageno,0);
echo "<br><center>$page_number_label $pageno<br>";
if($start>=$showmax)
{
   echo "<A href='gbindex.php?start=$prev'><-</a>&nbsp;";
}
while($order3=mysql_fetch_array($order2))
{
  if($fixed>=$start-3*$showmax&&$fixed<=$start+7*$showmax)
  {
     if($fixed%$showmax==0)
     {
           echo "<A href='gbindex.php?start=$tctr'>$md </a> ";
     }
  }
  $tctr=$tctr+1;
  $md=1+$tctr/$showmax;
  $fixed++;
}
if($start<=$num-$showmax)
{
   echo "<A href='gbindex.php?start=$next'>-></a>&nbsp;";
}
echo "<tr><td valign = 'top'><b>$posted_by_label</b>";
echo "<td>&nbsp;&nbsp;";
echo "<td valign = 'top'><b>$user_comment_label</b>";
echo "<tr><td colspan = '3' valign = 'top'><hr>";
$guestbook="SELECT * FROM CC_guestb ORDER BY ID DESC LIMIT " . $start . ", $showmax";
$row=mysql_query($guestbook);
echo "<center>";
while($gbvalues=mysql_fetch_array($row))
{
   $gbvalues[comment]=htmlspecialchars($gbvalues[comment]);
   $gbvalues[name]=htmlspecialchars($gbvalues[name]);
   echo "<tr><td width = '20%'valign = 'top'><b>$gbvalues[name]</b><br>";
   echo "$gbvalues[time]<br>";
   if(isset($_SESSION['cadmin']))
   {
      echo"<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title= $trace_label href='admin/queryindex.php?query=$gbvalues[IP]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$gbvalues[IP]</a></font><br>";
   }
   if(strlen($gbvalues[www])>1)
   {
      $www=$gbvalues[www];
      $www="http://$www";
      echo "<a href=$www target='new'><img src='$siteaddress/images/posterwww.gif'alt='$poster_www_alt_text' border='0'></a> ";
   }
   if(strlen($gbvalues[mail])>1)
   {
      $mail=$gbvalues[mail];
      echo "<a href= 'mailposter.php?ad=$mail'><img border='0' src='$siteaddress/images/postermail.gif'alt='$poster_mail_alt_text'></a> ";
   }
   echo "<td >&nbsp;&nbsp;";
   echo "<td width = '80%' valign = 'top'>$gbvalues[comment]";
   if(isset($_SESSION['cadmin']))
   {
      echo "<br><br><a href='admin/gbookdelete.php?ID=$gbvalues[ID]'><font color = 'red'>$delete_label</a></font>";
   }
    echo "<tr><td colspan = '3' valign = 'top'><hr>";
}
echo "<tr><td width=100%  colspan = '3' valign='top' align = 'left'>";
echo "<center><input type=button value='$add_gbook_comment_button_label' class = 'buttons' onClick='goToaddURL()'><br>";
echo "</center>";
echo "</td></tr></table>";
include "rightblocks.php";
include "endlayout.php";
?>