<?php
session_start();
include "antihack.php";
include "admin/connect.inc";
include "languages/default.php";
include "admin/languages/default.php";
include "banned.php";
$getprefs="SELECT * FROM `CC_prefs`";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getblocks="SELECT * FROM `CC_block_names`";
$getblocks2=mysql_query($getblocks) or die($no_blocks_error);
$getblocks3=mysql_fetch_array($getblocks2);
$num_results = '0';
$getvnews="SELECT * FROM `CC_vposted_news`";
$getvnews2=mysql_query($getvnews) or die($no_news_waiting_error);
$getvnews3=mysql_fetch_array($getvnews2);
$result = mysql_query($getvnews);
$num_results = mysql_num_rows($result);
$ppcctr = '0';
$getppcsub="SELECT * FROM `CC_ppcsubmitted`";
$getppcsub2=mysql_query($getppcsub) or die($no_ppc_error);
$getppcsub3=mysql_fetch_array($getppcsub2);
$thisresult = mysql_query($getppcsub);
$ppcctr = mysql_num_rows($thisresult);
$getmenu = "SELECT * FROM `CC_menu`";
$getmenu2 = mysql_query($getmenu)or die($no_menu_error);
$getmenu3 = mysql_num_rows($getmenu2);
$getppc = "SELECT * FROM `CC_ppc`";
$getppc2 = mysql_query($getppc)or die($no_ppc_error); ;
$getppc3 = mysql_num_rows($getppc2);
$getweblinks = "SELECT * FROM `CC_weblinks`";
$getweblinks2 = mysql_query($getweblinks)or die($no_weblinks_error); ;
$getweblinks3 = mysql_num_rows($getweblinks2);
$getlinksub= "SELECT * FROM `CC_weblinksposted`";
$getlinksub2=mysql_query($getlinksub) or die($no_ppc_error);
$getlinksub3=mysql_fetch_array($getlinksub2);
$linksresult = mysql_query($getlinksub);
$wlctr = mysql_num_rows($linksresult);
$hitexists=@mysql_num_rows(@mysql_query("SELECT * FROM `CC_online`")or die($no_vonline_error));
$queryright="SELECT * FROM `CC_custom_blocks`";
$style = $getprefs3[personality];
$sitename = $getprefs3[sitename];
$siteaddress = $getprefs3[siteaddress];
$siteaddress = "$siteaddress/";
$cpc_rate = $getprefs3[cpc_default_rate];
$show_numrandom_headlines = $getprefs3[show_numrandom_headlines];
if ($getuser3[user_site_name]==""){
      $visitor_name = $guest_name_label;
   }else{
      $visitor_name =  $getuser3[user_site_name];
}
if(isset($_SESSION['cuser'])){
   $bloguser=$_SESSION['cuser'];
   $getuser="SELECT user_site_name from `CC_users` where username='$bloguser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   $visitor_name =  $getuser3[user_site_name];
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
@mysql_query("UPDATE `CC_prefs` SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
include "layout.php";
include "header.php";
echo "<table border='0'>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
include "leftblocks.php";
echo "<td valign='top'><center>";
echo "<img src=images/seperator.gif border='0' width='10' height='1'>";
if($getprefs3[showseparator]==1){
echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
if ($visitor_name == $guest_name_label){
echo "$getprefs3[title] $welcomes_visitor_label - $visitor_name"; }
else {
echo  "$welcome_back_user_label $visitor_name"; }
if($getprefs3[shownewsticker]==1){echo "<br>";
include "ticker.php";}
$next = 0;
$ID=$_GET['ID'];
if(!isset($_GET['start']))
{
    $start=0;
    $showmax = "10";
}
else
{
    $start=$_GET['start'];
    $showmax = "10";
    $getnews="SELECT * from `CC_news` where entryid='$ID'";
    $getnews2=mysql_query($getnews) or die($no_news_error);
    while($getnews3=mysql_fetch_array($getnews2))
    {
       echo "<table border='0' cellspacing='0' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
       echo"<tr><td width = '80%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getnews3[newstitle]</b> $posted_by_label $getnews3[author]";
       echo "</td><td  width = '20%' valign= 'top' style='border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]><i>$getnews3[thetime]</i></td></tr>";
       echo "<tr><td colspan = '2'>";
       echo "<br><p align = 'justify'>$getnews3[introcontent]<br></p>";
       echo "<tr><td colspan = '2'>";
       echo "<br><p align = 'justify'>$getnews3[maincontent]<br></p><hr>";
       $getcomments="SELECT * from `CC_comments` where master='$ID' ORDER by commentid ASC LIMIT $start,$showmax ";
       $getcomments2=mysql_query($getcomments) or die($no_comments_error);
       while($getcomments3=mysql_fetch_array($getcomments2))
       {
          $getcomments3[name]=strip_tags($getcomments3[name]);
          $getcomments3[name]=htmlspecialchars($getcomments3[name]);
          echo "<table border = '0' width = '100%'><tr><td valign='top' width = '10%'><i>$posted_by_label</i>";
          echo "<td valign='top' width=90%><b>$getcomments3[name]</b>&nbsp;";
          echo "<tr width=10%><td>";
          if (strlen($getcomments3[mail]) >= '5')
          {
               $mail=$getcomments3[mail];
               echo "<a href= 'mailposter.php?ad=$mail'><img border='0' src='$siteaddress/images/postermail.gif'alt='$poster_mail_alt_text'></a> ";
          }
          if ($getcomments3[url] !== "")
          {
              $www=$getcomments3[url];
              $www="http://$www";
              echo "<a href=$www target='new'><img src='$siteaddress/images/posterwww.gif'alt='$poster_www_alt_text' border='0'></a> ";
          }

          echo "<td valign='top' width = '90%'>$getcomments3[date]";
          if(isset($_SESSION['cadmin']))
          {
             echo" $current_ip_address_label <font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title= \"$trace_label\" href='admin/queryindex.php?query=$getcomments3[IP]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$getcomments3[IP]</a>";
          }
          echo "<tr><td valign='top'><i>$user_comment_label</i></td><td width=80% valign='top'>$getcomments3[comment]";
          if(isset($_SESSION['cadmin']))
          {
              echo "<tr><td colspan = '2'><form><input type='button' value='$delete_this_comment_button_label' class = 'buttons' onClick='parent.location=\"admin/deletecomment.php?ID=$getcomments3[commentid]\"'></form>";
          }
          echo "</td></tr></table><br>";
       }
       if($getnews3[allowcomments]==1)
       {
          echo "<br><center><b>$have_your_say_label</b>";
          echo "<form><input type='button' value='$add_your_comment_button_label' class = 'buttons' onClick='parent.location=\"postcomment.php?ID=$getnews3[entryid]\"'></form>";
       }
       echo "<tr><td colspan = '2'><center><b>$go_to_page_label</b></center></td></tr>";
       echo "<tr><td colspan = '2' valign='top'>";
       $order="SELECT * from `CC_comments` where master='$ID'";
       $order2=mysql_query($order) or die(mysql_error());
       $ctr=0;
       $fixed=0;
       $md=1+$ctr/$showmax;
       $num=mysql_num_rows($order2);
       $next=$start+$showmax;
       echo "<center>";
       if($start>=$showmax)
       {
          echo "<A href='comments.php?start=0&ID=$ID'><-</a>&nbsp;";
       }
       while($order3=mysql_fetch_array($order2))
       {
       if($fixed>=$start-3*$showmax&&$fixed<=$start+7*$showmax)
       {
         if($fixed%$showmax==0)
         {
             echo "<A href='comments.php?start=$ctr&ID=$ID'>$md</a>&nbsp;";
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
      echo "<A href='comments.php?start=$end&ID=$ID'>-></a>&nbsp;";
    }
    $pageno = ($start/$showmax)+1;
    $pageno = number_format($pageno,0);
    echo "<br>$page_number_label $pageno/$totalpages";
}
}
echo "</td></tr></table>";
echo "</center></td>";
include "rightblocks.php";
include "endlayout.php";
?>