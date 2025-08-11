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

if($_SESSION['cadmin'])
{
  echo "<font size = '4' font color = 'red'><center><b>$browse_in_admin_mode_label<br></center></b></font>";
}
?>
<html><head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
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
if($getprefs3[shownewsticker]==1){echo "<br>";include "ticker.php";}
$ID = $_POST['theid'];
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr><td colspan = '5'><center><b>$readpm_title_label</b><br><br></center></td></tr>";

echo "<tr><td colspan = '5' align = 'right'><input type='button' class = 'buttons' value='$shout_refresh_button_label' onclick='location.reload()'><br><br>";
if ($visitor_name==$guest_name_label)
{
  ?>
  <html><head><title><?php echo $getprefs3[title]; ?></title>
  <link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
  </head>
  <?php
  echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
  echo "<tr><td><center><b>$cannot_pm_label</b><br><br></center></td></tr>";
  echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
  echo "<tr><td align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
  echo "</td></tr></table>";
}else{
  $query =  ("SELECT * FROM CC_pmsg WHERE user = '$visitor_name'") or die($no_users_error);
  $result = mysql_query($query);
  $ctr = '0';
  echo "<tr><td width = '15%'><b>$from_msg_label";
  echo "<td width = '60%'><b>$pm_subject_label";
  echo "<td width = '15%'><b>$sentpm_label";
  echo "<td colspan = '2' width = '10%'><b>$pmstatus_label</b>";
  while($row = mysql_fetch_array($result))
  {
     $ctr++;
     echo "<tr><td colspan = '5'><hr color=$getprefs3[separatorlinecolor] size = '1'>";
     $ID =$row[mid];


     echo "<tr><td width = '15%' valign = 'top'>  $row[from]";
     echo "<td width = 60%' valign = 'top'><a href='$siteaddress/readpm.php?op=read&ID=$ID&name=$row[from]&user=$visitor_name'>$pm_subject_label $row[title]</a>";
     echo "<td width = '15%' valign = 'top'>  $row[date]";
     echo "<td width = '10%' valign = 'top'>";
     if ($row[read]=='0')
     {
        echo "<img src = 'images/unread.gif'>";
     }else{
       echo "<img src = 'images/read.gif'>";
     }
     echo "<td><form method='post' action='readpm.php?op=del&id=$ID'>";
     echo "<center><input type='submit' value='$delpm_button_label' class = 'buttons'>";
     echo "</form>";
  }
  if ($ctr <='0')
  {
     echo "<tr><td colspan = '5'><b><center>$no_new_pm_label</b>";
     echo "<META HTTP-EQUIV = 'Refresh' Content = '5; URL =index.php'>";
     echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
  }
}
switch( $_GET[ "op" ] )
{

case "read":
$ID = $_GET['ID'];
$from = $_GET['name'];
$recipient= $_GET['user'];
$thiquery =  ("SELECT * FROM CC_pmsg WHERE user = '$recipient' AND  mid = '$ID'") or die($no_users_error);
$thiresult = mysql_query($thiquery);
while($thirow = mysql_fetch_array($thiresult))
{
 echo "<tr><table border='0' cellspacing='0' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<br><br><tr><td width = '15%' bgcolor=$getprefs3[center_block_left_heading_backround_color]>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$from_msg_label</b><td width = '85%'  colspan = '2' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]>$thirow[from]";
 echo "<tr><td><b><br>$pm_subject_label: </b><td width = '84%' colspan = '3'><br>$thirow[title]";
 echo "<tr><td><b>$sentpm_label: </b><td width = '84%' colspan = '3'>$thirow[date]";
 echo "<tr><td colspan = '3'><br><b>$pmmessage_label:</b><br>";
 echo "<tr><td colspan = '3'>  $thirow[message]<hr>";
 $aquery =  ("SELECT theid FROM CC_users WHERE user_site_name = '$from'") or die($no_users_error);
 $aresult = mysql_query($aquery);
 while($arow = mysql_fetch_array($aresult))
 {
   $UID = $arow[theid];
 }
 echo "<tr><td width = '15%'><form method='post' action='readpm.php?op=del&id=$ID'><input type='submit' value='$delpm_button_label' class = 'buttons'></form>";
 echo "<td width = '84%'><form method='post' action='sendpm.php'><input type='hidden' name='theid' value = '$UID'><input type='submit' value='$replypm_button_label' class = 'buttons'></form><td>";
 echo "<tr><td width = '15%'>";
 echo "<td width = '84%'><input type='button' class = 'buttons' value='$back_label' onclick='history.back()'>";
 @mysql_query ("UPDATE CC_pmsg SET `read` = '1' WHERE `mid` = '$ID'");
}
break;
case "del":
$ID = $_GET['id'];
@mysql_query( "DELETE FROM CC_pmsg WHERE mid = '$ID'");
$error_msg .= mysql_error();
echo "<tr><td colspan = '5' align = 'center'><b>$pmmessage_del_label</b><br><br>";
echo "<META HTTP-EQUIV = 'Refresh' Content = '0; URL =readpm.php'>";
echo "<p align = 'center'>$if_you_see_label <A href='readpm.php'> $click_here_label</a></p>";
break;
}
echo "</center>";
echo "</td></tr></table>";
include "rightblocks.php";
include "endlayout.php";
}else{
?>
<html><head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr><td><center><b>$cannot_pm_label</b><br><br></center></td></tr>";
echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
echo "<tr><td align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
echo "</td></tr></table>";
}
?>