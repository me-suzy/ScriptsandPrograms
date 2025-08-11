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
$sitetitle = $getprefs3[title];
$siteaddress = $getprefs3[siteaddress];
$siteemail = $getprefs3[siteemail];
$siteemail = registre($siteemail);
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
   $getuser="SELECT * from CC_users where username='$bloguser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   $visitor_name =  $getuser3[user_site_name];
}
?>
<html><head><title><?php echo $getprefs3[title]; ?></title>
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
echo "<table border='0' width='100%'>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
$query =  ("SELECT * FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
$result = mysql_query($query);
if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       $theblock = $row["block_file"];
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
             if ($row["block_file"] !== "loginblock.php")
             {
                  include "$theblock";
                  echo "<br>";
             }
          }
       }
       if (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="0")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  if (($row["block_file"] !== "loginblock.php")&& ($row["block_file"] == "adminblock.php"))
                  {
                    include "$theblock";
                    echo "<br>";
                  }
             }
         }
    }
}
else{
    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];
        if (($row["side"]=="0") && ($row["view"]=="0")){
             if ($row["block_file"] == "loginblock.php")
                  {
                  echo "";
             }else{
                   include "$theblock";
                   echo "<br>";
             }
        }
   }
}
echo "<td valign='top' ><center>";
echo "<img src=images/seperator.gif border='0' width='10' height='1'>";
if($getprefs3[showseparator]==1){echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
if ($visitor_name == $guest_name_label){
echo "<font color = '$getprefs3[linkfont_color]'>$getprefs3[title] $welcomes_visitor_label - $visitor_name";
}else{ echo  "<font color = '$getprefs3[linkfont_color]'>$welcome_back_user_label $visitor_name"; }
if($getprefs3[showwelcome_message]==1){include "welcome.php";}
if($getprefs3[shownewsticker]==1){echo "<center>"; include "ticker.php";}
$searchname=$_POST['searchname'];
$ID=$_POST['theid'];
if(isset($_SESSION['cuser']))
{
 if ($searchname =="")
 {
   $getuser="SELECT * from CC_users where theid ='$ID'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
 }else{
   $getuser="SELECT * from CC_users where user_site_name ='$searchname'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   if ($getuser3=="")
   {
    echo "<b>$member_search_not_found_label</b>";
    echo "<meta http-equiv='refresh' content='0;URL=memberprofiles.php'>";
    echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
   }
 }
 echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='3'><left>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$show_users_profile_label $getuser3[user_site_name]</font></b></center></td></tr>";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo $member_name_label;
 echo "<td width= '75%'colspan = '2'valign = 'top'>";
 echo $getuser3['user_site_name'];
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "<img src = 'images/yim.gif'> YIM";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 echo $getuser3['yim'];
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "<img src = 'images/aim.gif'> AIM";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 echo "$getuser3[aim]";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "<img src = 'images/msn.gif'> MSN";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 echo "$getuser3[msn]";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "<img src = 'images/icq.gif'> ICQ";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 echo "$getuser3[icq]";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "$my_quote_label";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 echo "$getuser3[sig]";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "$location_label";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 echo "$getuser3[location]";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo $profile_website_label;
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 if ($getuser3[website] !=="")
 {
   echo "<a href='$getuser3[website]' target=new><img border = '0' src='images/posterwww.gif' alt='$profile_website_alt_label'</a>";
 }else{
   echo "";
 }
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "$mygender_label";
 echo "<td width= '75%' valign = 'top' colspan = '2'>";
 if ($getuser3[gender] == "0")
 {
   echo $gender_not_given_label;
 }elseif($getuser3[gender] == "1"){
   echo $male_label;

 }elseif($getuser3[gender] == "2"){
   echo $female_label;
 }
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "<td width= '75%'colspan = '2'valign = 'top'>";
 echo "<tr><td width= '25%'valign = 'top'>";
 echo "<form><input type='button' class = 'buttons' value='$back_label' onclick='history.back()'></form>";
 echo "<td width= '75%'colspan = '2'valign = 'top'>";
 echo "<form action='sendpm.php' method='post'>";
 echo "<input name='theid' type='hidden' value = '$ID'>";
 echo "<input type='submit'  title = '$sendpm_alt_label' value= '$sendpm_button_label' class='buttons'></form>";
 echo "</td></tr></table></center>";
 echo "</center></td>";
}else{
  ?>
  <html><head><title><?php echo $getprefs3[title]; ?></title>
  <link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
  </head>
  <?php
  echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
  echo "<tr><td><center><b>$cannot_readprofile_label</b><br><br></center></td></tr>";
  echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
  echo "<tr><td align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
  echo "</td></tr></table>";
}
if($getprefs3[showrightblocks]==1){
    echo "<td valign='top' width='181'>";
    echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
    $query =  ("SELECT *, side FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
    $result = mysql_query($query);
    if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];
         if (isset($_SESSION['cuser'])){
             if ((($row["side"]=="1") && ($row["view"]=="1")) || (($row["side"]=="1") && ($row["view"]=="0"))){
                if ($row["block_file"] !== "loginblock.php")
                {
                  include "$theblock";
                  echo "<br>";
                }
             }
         }

         if (isset($_SESSION['cadmin'])){
             if (($row["side"]=="1")){
                if (($row["block_file"] !== "loginblock.php")&& ($row["block_file"] == "adminblock.php"))
                {
                  include "$theblock";
                  echo "<br>";
                }
             }
         }
    }
}
else{
    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];
        if (($row["side"]=="1") && ($row["view"]=="0")){
             if ($row["block_file"] == "loginblock.php")
                  {
                  echo "";
             }else{
                   include "$theblock";
                   echo "<br>";
             }
        }
   }
}
}include "endlayout.php";
?>