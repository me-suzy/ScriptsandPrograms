<?php
session_start();
include "admin/connect.inc";
include "languages/default.php";
include "admin/languages/default.php";
include "banned.php";
include "antihack.php";
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
$usercheck = antihax($_GET[usercheck]);
$owner =antihax($_GET[thischeck]);
$owner = registre($owner);
$getchk="SELECT * FROM CC_ppcsubmitted WHERE owner = '$owner'";
$getchk2=mysql_query($getchk) or die($no_preferences_error);
$getchk3=mysql_fetch_array($getchk2);
if (($getchk3[usercheck] == "") && ($getchk3[validated]=='1')){
      echo "<br><br>";
      echo "<table border='1' cellspacing='0' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
      echo"<td width = '70%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]>$ppc_details_title_label $sitename";
      echo "</td><td  width = '30%' valign= 'top' style='border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]></td></tr>";
      echo "<tr><td  colspan = '2'style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 1; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color]><p align='justify'>";
      echo $ppc_already_validated_label;
}
else
{
    @mysql_query ("UPDATE CC_ppcsubmitted SET validated='1',usercheck='' WHERE owner = '$owner' &&  usercheck ='$usercheck'");
    $error_msg .= mysql_error();
    if ($error_msg ==""){
       $error_msg = $ppc_link_submission_activated_label;
       echo "<br><br>";
       echo "<table border='1' cellspacing='0' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
       echo"<td width = '70%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]>$ppc_details_title_label $sitename";
       echo "</td><td  width = '30%' valign= 'top' style='border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]></td></tr>";
       echo "<tr><td  colspan = '2'style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 1; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color]><p align='justify'>";
       echo "$error_msg";
       $siteemail = registre($getprefs3[siteemail]);
       mail("$siteemail","$mail_ppc_admin_new_link_subject","$mail_admin_new_ppc_link_message_label","FROM: $siteemail");
    }
}
echo "</td></tr></table>";
echo "</center></td>";
include "rightblocks.php";
include "endlayout.php";
?>