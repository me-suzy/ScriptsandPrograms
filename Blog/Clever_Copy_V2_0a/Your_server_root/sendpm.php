<?php
session_start();
include "antihack.php";
include "admin/connect.inc";
include "languages/default.php";
include "admin/languages/default.php";
include "banned.php";
global $siteemail;
$getprefs="SELECT * FROM `CC_prefs`";
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
if ($ID == "")
{
   $ID = $_GET['theid'];
}
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr><td><center><b>$sendpm_title_label</b><br><br></center></td></tr>";
if ($ID == "")
{
  echo "<tr><td><form method='post' action='sendpm.php?op=getuser'>";
  echo "<center>$sendpm_where_label<br>";
  echo "<input type='text' name='nuser' size='80'><br><br>";
  echo "<br><center><input type='submit' value='$namecheck_button_label' class = 'buttons'>";
  echo "</form>";

}else{
 $query =  ("SELECT user_site_name, user_email_address FROM CC_users WHERE theid = '$ID'") or die($no_users_error);
 $result = mysql_query($query);
 while($row = mysql_fetch_array($result))
 {
  $uname = $row[user_site_name];
  $umail = $row[user_email_address];
  $umail = registre($umail);
  $sender = $visitor_name;
  echo "<tr><td><hr color=$getprefs3[separatorlinecolor] size = '1'><form method='post' action='sendpm.php?op=send'>";
  echo "<b>$typing_msg_label $uname<br><br><br></b>";
  echo "$pm_subject_label<br>";
  echo "<input type='text' name='subject' size='80'><br><br>";
  echo "$your_msg_label<br>";
  echo "<textarea name='message' rows='10' cols='100'></textarea><br><br>";
  echo "<input type = 'hidden' name='uname' value = '$uname'>";
  echo "<input type = 'hidden' name='umail' value = '$umail'>";
  echo "<input type = 'hidden' name='from' value = '$sender'>";
  echo "<br><center><input type='submit' value='$sendpm_button_label' class = 'buttons'>";
  echo "</form>";
 }
}
switch( $_GET[ "op" ] )
{
case "getuser":
echo "<b>$please_wait_label";
$usern = antihax($_POST['nuser']);
$bquery =  ("SELECT * FROM CC_users WHERE user_site_name = '$usern'") or die($no_users_error);
$bresult = mysql_query($bquery);
while($brow = mysql_fetch_array($bresult))
{
  $theid = $brow[theid];
}
if ($theid == "")
{
   echo "$user_not_found_label";
   echo "<META HTTP-EQUIV = 'Refresh' Content = '0; URL =sendpm.php'>";
   echo "</b><p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
}else{
   echo "<META HTTP-EQUIV = 'Refresh' Content = '0; URL =sendpm.php?theid=$theid'>";
   echo "</b><p align = 'center'>$if_you_see_label <A href='sendpm.php?theid=$theid'> $click_here_label</a></p>";
}
break;

case "send":
include "admin/connect.inc";
$getnewprefs="SELECT * FROM `CC_prefs`";
$getnewprefs2=mysql_query($getnewprefs) or die($no_preferences_error);
$getnewprefs3=mysql_fetch_array($getnewprefs2);
$sitename = $getnewprefs3[title];
$siteaddress = $getnewprefs3[siteaddress];
$siteemail = $getnewprefs3[siteemail];
$siteemail = registre($siteemail);
$message = antihaxmjr($_POST[message]);
$uname = antihaxmjr($_POST[uname]);
$umail = antihaxmjr($_POST[umail]);
$from = antihaxmjr($_POST[from]);
$title = antihaxmjr($_POST[subject]);
if((strlen($uname)<1)||(strlen($message)<1)||(strlen($title)<1))
{
    $error_msg .= "$missing_post_data_error";
    echo "<tr><td align = 'center'><b>$there_was_problem_label - $error_msg</b><br>";
    echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
    echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
    exit;
}else{
    if ($getprefs3[dateset] =="1"){
          $theoffset = $getprefs3[time_offset];
          $theoffset = ($theoffset *'60');
          $date=date("D M jS Y - H:i",time() + $theoffset);
     }else{
          $theoffset = $getprefs3[time_offset];
          $theoffset = ($theoffset *'60');
          $date=date("D jS M Y - H:i",time() + $theoffset);
          $date = antihax($date);
     }
    @mysql_query( "INSERT INTO CC_pmsg(`date`, `read`, `from`, `title`, `user`, `message`) VALUES('$date','0','$from','$title','$uname','$message')" );
    @mail("$umail","$notify_pmmail_subject_label $sitename","$pm_visit_label \n\n$siteaddress","FROM: $siteemail");
    $error_msg .= mysql_error();
     if ($error_msg=="")
    {
         echo "<tr><td><b><center>$pm_success_label $uname<br></b>";
         echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
         echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
    }else{
         echo "<tr><td align = 'center'><b>$there_was_problem_label - $error_msg</b><br>";
         echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
         echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
    }
}
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