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
$getnews="SELECT * from `CC_news` where entryid='$ID'";
$getnews2=mysql_query($getnews) or die("Could not get blog");
$getnews3=mysql_fetch_array($getnews2);
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
   $getuser="SELECT * from `CC_users` where username='$bloguser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   $visitor_name =  $getuser3[user_site_name];
   $mail = registre($getuser3[user_email_address]);
   $visitor_site =  $getuser3[website];
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
@mysql_query("UPDATE `CC_prefs` SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
include "layout.php";
include "header.php";
echo "<table border='0'>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
$query =  ("SELECT * FROM `CC_blocks` ORDER By blockposition ASC") or die($no_blocks_found_error);
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
if($getprefs3[showseparator]==1){
echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
if ($visitor_name == $guest_name_label){
echo "$getprefs3[title] $welcomes_visitor_label - $visitor_name"; }
else {
echo  "$welcome_back_user_label $visitor_name"; }
if($getprefs3[shownewsticker]==1){echo "<br>";
include "ticker.php";}
if(isset($_POST['submit']))
{
   if(strlen($_POST['thename'])<1 || strlen($_POST['comment'])<1)
   {
      echo "<b>$missing_post_data_error</b>";
   }else{
     $IP=antihax($_SERVER["REMOTE_ADDR"]);
     $ID=antihax($_POST['ID']);
     $thename=antihax($_POST['thename']);
     $comment=antihaxmjr($_POST['comment']);
     $mail=antihax($_POST['mail']);
     $mail=sesson($mail);
     $url=antihax($_POST['url']);
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
     $makecomment="INSERT into `CC_comments` (mail, url,date, comment,IP,master,name) values('$mail','$url','$date','$comment','$IP','$ID','$thename')";
     mysql_query($makecomment) or die($no_comments_error);
     $updatecount="update `CC_news` set numcomments=numcomments+1 where entryid='$ID'";
     mysql_query($updatecount) or die($no_comments_error);
     if ($getprefs3[mailcomments == '1'])
     {
         @mail("$siteemail","$comment_added_email_subject $sitename","$new_comment_added_email_text $ID\n\n$comment","FROM: $siteemail");
     }
     $getnewswatchers="SELECT * from `CC_watchnews` WHERE masterid = '$ID'";
     $getnewswatchers2=mysql_query($getnewswatchers) or die($no_watchers_error);
     while($getnewswatchers3=mysql_fetch_array($getnewswatchers2))
     {
        $sendaddress = $getnewswatchers3[address];
        $stopaddress = sesson($getnewswatchers3[address]);
        @mail("$sendaddress","$news_updated_subject $sitename","$newswatch_added_email_text\n\n$siteaddress/more.php?ID=$ID\n\n$newswatch_stopwatch_email_text\n\n$siteaddress/stopwatchnews.php?validate=$stopaddress&ID=$ID","FROM: $siteemail");
     }
     echo "$comment_posted_successfully_label <META HTTP-EQUIV = 'Refresh' Content = '0; URL =comments.php?start=0&ID=$ID'>";
     echo "<p align = 'center'>$if_you_see_label <A href='comments.php?start=0&ID=$ID'> $click_here_label</a></p>";
   }
}
else if(isset($_GET['ID']))
$ID=$_GET['ID'];
{
   if($getnews3[allowcomments]=='0')
   {
      echo "<b>$cannot_comment_error_label</b>";
   }
   else
   {
    $getnews="SELECT * from `CC_news` where entryid='$ID'";
    $getnews2=mysql_query($getnews) or die($no_news_error);
    while($getnews3=mysql_fetch_array($getnews2))
    {
       echo "<table border='0' cellspacing='0' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]' width='100%'>";
       echo"<tr><td width = '70%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getnews3[newstitle]</b> $posted_by_label $getnews3[author]";
       echo "</td><td  width = '30%' valign= 'top' style='border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]><i>$getnews3[thetime]</i></td></tr>";
       echo "<tr><td colspan = '2'>";
       echo "<br><p align = 'justify'>$getnews3[introcontent]<br></p>";
       echo "<tr><td colspan = '2'>";
       echo "<br><p align = 'justify'>$getnews3[maincontent]<br></p>";
       echo "</td></tr></table><br>";
    }
    $getcomments="SELECT * from `CC_comments` where master='$ID' ORDER by commentid ASC";
    $getcomments2=mysql_query($getcomments) or die($no_comments_error);
    while($getcomments3=mysql_fetch_array($getcomments2))
    {
       $thisctr++;
    }
    $therow = ($thisctr-5);
    $getthecomments="SELECT * from `CC_comments` where master='$ID' ORDER by commentid ASC LIMIT $therow,5 ";
    $getthecomments2=mysql_query($getthecomments) or die($no_comments_error);
    while($getthecomments3=mysql_fetch_array($getthecomments2))
    {
          $getthecomments3[name]=strip_tags($getthecomments3[name]);
          $getthecomments3[name]=htmlspecialchars($getthecomments3[name]);
          echo "<table border='0' cellspacing='0' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]' width = '100%'>";
          echo "<tr><td valign='top' width = '10%'><i>$posted_by_label</i>";
          echo "<td valign='top' width=90%><b>$getthecomments3[name]</b>";
          echo "<tr><td width = '10%'><td width = '90%'>$getthecomments3[date]";
          if(isset($_SESSION['cadmin']))
          {
             echo" $current_ip_address_label <font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title= \"$trace_label\" href='admin/queryindex.php?query=$getthecomments3[IP]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$getthecomments3[IP]</a>";
          }
          echo "<tr><td valign='top'><i>$user_comment_label</i></td><td width=90% valign='top'>$getthecomments3[comment]";
          if(isset($_SESSION['cadmin']))
          {
              echo "<tr><td colspan = '2'><form><input type='button' value='$delete_this_comment_button_label' class = 'buttons' onClick='parent.location=\"admin/deletecomment.php?ID=$getthecomments3[commentid],comment=$getthecomments3[comment]\"'></form>";
          }
          echo "</td></tr></table><br>";
    }
    echo "<table border='0' cellspacing='0' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'><tr><td>";
    echo "<form action='postcomment.php?ID=$ID' method='post' name='form'>";
    if($_SESSION['cuser'])
    {
       echo "$your_name_label<br>";
       echo "<input type='text' name='thename' size='40' value = '$visitor_name'><br>";
       echo "$vis_post_news_mail_label<br>";
       echo "<input type='text' name='mail' size='40' value = '$mail'><br>";
       echo "$vis_post_news_url_label<br>";
       echo "<input type='text' name='url' size='40' value = '$visitor_site'><br>";
    }else{
       echo "$your_name_label<br>";
       echo "<input type='text' name='thename' size='40'><br>";
       echo "$vis_post_news_mail_label<br>";
       echo "<input type='text' name='mail' size='40'><br>";
       echo "$vis_post_news_url_label<br>";
       echo "<input type='text' name='url' size='40' value = 'http://'><br>";
    }
    echo "<input type='hidden' name='ID' value = '$ID'>";
    echo "$your_comment_label<br>";
    echo "<textarea name='comment' rows='5' cols='100'></textarea><br><br>";
    echo "<input type='submit' name='submit' value='$post_my_comment_button_label'class = 'buttons'></form>";
    echo "</table>";
   }
}
echo "</center></td>";
if($getprefs3[showrightblocks]==1){
    echo "<td valign='top' width='181'>";
    echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
    $query =  ("SELECT *, side FROM `CC_blocks` ORDER By blockposition ASC") or die($no_blocks_found_error);
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
             if ((($row["side"]=="1")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="1") && ($row["view"]=="0"))){
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
}
include "endlayout.php";
?>