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
$siteaddress = "$siteaddress/";
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
<script src="<?$siteaddress?>stats/script.js" language="JavaScript"></script>
<noscript><img src="<?$siteaddress?>stats/script.php?image=1&javascript=false"></noscript>
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
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="0")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  if ($row["block_file"] !== "loginblock.php")
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
if($getprefs3[showseparator]==1){echo "<hr>";}
if ($visitor_name == $guest_name_label){
echo "<font color = '$getprefs3[linkfont_color]'>$getprefs3[title] $welcomes_visitor_label - $visitor_name";
}else{ echo  "<font color = '$getprefs3[linkfont_color]'>$welcome_back_user_label $visitor_name"; }
if($getprefs3[showwelcome_message]==1){include "welcome.php";}
if($getprefs3[shownewsticker]==1){include "ticker.php";}
echo "<center>";
$ips=$_SERVER["REMOTE_ADDR"];
$ipban="SELECT * from CC_ipbans where banip='$ips'";
$ipban2=mysql_query($ipban);
while($ipban3=mysql_fetch_array($ipban2))
{
  $bannedip=$ipban3[banip];
}
if (strlen($bannedip)>1)
    {
       echo $banned_message;
    }else{
      if (!isset($_POST['submit']))
      {
         echo "<table border='0' width=100%><tr><td><center><b>$contact_us_label</b><br>$contact_us_description_label<br>*$required_label<br><br><br></td></tr>";
         echo "<tr><td>";
         echo "<form method='post' action='contactsend.php' name='form'>";
         if(isset($_SESSION['cuser'])){
            echo "<center>* $your_name_label<br><input type='text' name='name' size='60' value = '$visitor_name'><br>";
         }else{
            echo "<center>* $your_name_label<br><input type='text' name='name' size='60'><br>";
         }
         echo "<center>$vis_post_news_url_label<br><input type='text' name='www' size='60' value = 'http://'><br>";
         echo "<center>* $your_mail_addy_label<br><input type='text' name='email' size='60'><br>";
         echo "<center>* $your_comment_label<br>";
         echo "<center><textarea rows='8' name='comment' cols='90'></textarea><br>";
         echo "<input type='submit' name='submit' value='submit'class = 'buttons'>";
         echo "</form><br>";
         echo "</td></tr></center></table>";
      }
      else if (isset($_POST['submit']))
      {
         echo "<center>";
         echo "<table border='0' width=95%><tr><td><center><b>$contact_us_label</b></center></td></tr>";
         echo "<tr><td>";
         $name=antihax($_POST['name']);
         $email=antihax($_POST['email']);
         $www=antihax($_POST['www']);
         $comment=antihax($_POST['comment']);
         if((strlen($name)<1 || strlen($comment)<1 || strlen($email)<1))
         {
          echo "<b>$missing_post_data_error</b><br>";
         }else{
          $ip=$_SERVER["REMOTE_ADDR"];
     @mail("$siteemail","$contact_us_subject_label $sitename","$contact_comment_email\n\nFrom $name - $ip. Web - http://$www\n\n$comment","FROM: $email");
     echo "<p align = 'center'>$contact_sent_successfully_label <META HTTP-EQUIV = 'Refresh' Content = '0; URL =index.php'>";
     echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
    }
    echo "</td></tr></table></center>";
  }
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
                  if ($row["block_file"] !== "loginblock.php")
                  {
                    include "$theblock";
                    echo "<br>";
                  }
             }
         }

         elseif (isset($_SESSION['cadmin'])){
             if (($row["side"]=="1")){
                if ($row["block_file"] !== "loginblock.php")
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