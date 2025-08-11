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
$getnews="SELECT * from CC_news where entryid='$ID'";
$getnews2=mysql_query($getnews) or die("Could not get blog");
$getnews3=mysql_fetch_array($getnews2);
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
$siteemail = $getprefs3[siteemail];
$siteemail = registre($siteemail);
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
echo "<table border='0'>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
$query =  ("SELECT * FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
$result = mysql_query($query);
if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       $theblock = $row["block_file"];
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  include "$theblock";
                  echo "<br>";
          }
       }
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="0")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  include "$theblock";
                  echo "<br>";
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
if($getprefs3[showseparator]==1){
echo "<hr>";}
if ($visitor_name == $guest_name_label){
echo "$getprefs3[title] $welcomes_visitor_label - $visitor_name"; }
else {
echo  "$welcome_back_user_label $visitor_name"; }
if($getprefs3[shownewsticker]==1){
include "ticker.php";}
if(isset($_POST['submit']))
{
   if((strlen($_POST['toname'])<1)||(strlen($_POST['tomail'])<1))
   {
      echo "<b>$missing_post_data_error</b>";
   }
   else
   {
     $ID=antihax($_POST['ID']);
     $getnews="SELECT * from CC_news where entryid='$ID'";
     $getnews2=mysql_query($getnews) or die($no_news_error);
     while($getnews3=mysql_fetch_array($getnews2))
     {
       $the_article = $getnews3['introcontent'];
     }
     $the_article = $the_article;
     $IP=antihax($_SERVER["REMOTE_ADDR"]);
     $fromname=antihax($_POST['fromname']);
     $frommail=antihax($_POST['frommail']);
     $comment=antihax($_POST['comment']);
     $toname=antihax($_POST['toname']);
     $tomail=antihax($_POST['tomail']);
     $theaddress = $siteaddress;
     $theaddress = $theaddress."/more.php?ID=";
     $theaddress = "$theaddress$ID";
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
     @mail("$tomail","$toname $mail_article_subject_message_heading","$fromname $mail_article_mail_message\n\n$comment\n\n$the_article\n\n$theaddress","FROM: $frommail");
     echo "<p align = 'center'><b>$article_successfully_mailed_label <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'></b>";
     echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
   }
}
else if(isset($_GET['ID']))
$ID=$_GET['ID'];
{
    $getnews="SELECT * from CC_news where entryid='$ID'";
    $getnews2=mysql_query($getnews) or die($no_news_error);
    while($getnews3=mysql_fetch_array($getnews2))
    {
       echo "<table border='0' cellspacing='0' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
       echo "<center><b>$send_article_to_friend_label<br><br></b>";
       echo"<td width = '70%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getnews3[newstitle]</b> $posted_by_label $getnews3[author]";
       echo "</td><td  width = '30%' valign= 'top' style='border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]><i>$getnews3[thetime]</i></td></tr>";
       echo "<tr><td colspan = '2'>";
       echo "<br><p align = 'justify'>$getnews3[introcontent]<br></p>";
       echo "<tr><td colspan = '2'>";
       echo "<br><p align = 'justify'>$getnews3[maincontent]<br></p>";
       echo "</td></tr></table>";
    }
    echo "<form action='mailarticle.php?ID=$ID' method='post' name='form'>";
    echo "$your_name_label<br>";
    echo "<input type='text' name='fromname' size='40'><br>";
    echo "$your_mail_addy_label<br>";
    echo "<input type='text' name='frommail' size='40'><br>";
    echo "$friends_name_label<br>";
    echo "<input type='text' name='toname' size='40'><br>";
    echo "$friends_mail_address_label<br>";
    echo "<input type='text' name='tomail' size='40'><br>";
    echo "$any_other_message_label<br>";
    echo "<textarea name='comment' rows='5' cols='80'></textarea><br><br>";
    echo "<input type='hidden' name='ID' value = '$ID'>";
    echo "<input type='submit' name='submit' value='$mail_article_button_label'class = 'buttons'></form>";
   }
echo "</center></td>";
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
                  include "$theblock";
                  echo "<br>";
             }
         }
         elseif (isset($_SESSION['cadmin'])){
             if (($row["side"]=="1")){
                  include "$theblock";
                  echo "<br>";
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
}
include "endlayout.php";
?>