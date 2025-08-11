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
<head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
include "layout.php";
include "header.php";
echo "<table border='0' width=100%>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
$query =  ("SELECT * FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
$result = mysql_query($query);
if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       $theblock = $row["block_file"];
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
             if ($theblock !== "loginblock.php"){
                  include "$theblock";
                  echo "<br>";
             }
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
echo "<br>";
include "ticker.php";}
$month=$_POST['month'];
$year=$_POST['year'];
if ($_POST['month'] == "1"){
$showmonth = $jan_label;}
elseif  ($_POST['month'] == "2"){
$showmonth = $feb_label;}
elseif  ($_POST['month'] == "3"){
$showmonth = $mar_label;}
elseif  ($_POST['month'] == "4"){
$showmonth = $apr_label;}
elseif  ($_POST['month'] == "5"){
$showmonth = $may_label;}
elseif  ($_POST['month'] == "6"){
$showmonth = $jun_label;}
elseif  ($_POST['month'] == "7"){
$showmonth = $jul_label;}
elseif  ($_POST['month'] == "8"){
$showmonth = $aug_label;}
elseif  ($_POST['month'] == "9"){
$showmonth = $sep_label;}
elseif  ($_POST['month'] == "10"){
$showmonth = $oct_label;}
elseif  ($_POST['month'] == "11"){
$showmonth = $nov_label;}
elseif  ($_POST['month'] == "12"){
$showmonth = $dec_label;
}
echo "<b>$showing_archives_for_label $showmonth, $year</b><hr><br>";
$getblog="SELECT * from CC_news where month='$month' and year='$year' order by realtime DESC";
$getblog2=mysql_query($getblog) or die($no_news_error);
while($getblog3=mysql_fetch_array($getblog2))
{
  echo "<table><tr><td><b>$getblog3[newstitle]</b> $posted_by_label $getblog3[author] ";
  echo "$getblog3[thetime]</td></tr><tr><td>";
  echo "<br>$getblog3[introcontent]<br>";
  if(strlen($getblog3[maincontent])>1)
  {
    echo "<br><a title = '$more_link_alt_text_label' href='more.php?ID=$getblog3[entryid]'><b>$more_label</b></a><br>";
  }
  if($getblog3[allowcomments]==1)
  {
    echo "<br><a title = '$read_other_persons_comments_alt_text_label' href='comments.php?ID=$getblog3[entryid]&start=0'>[$getblog3[numcomments]  $comments_label</a>] ~ <A  title = '$leave_comments_alt_text_label' href='postcomment.php?ID=$getblog3[entryid]'>[$add_comment_label]</a>";
  }
  if(isset($_SESSION['cadmin']))
  {
     $blogadmin=$_SESSION['cadmin'];
     $getadmin="SELECT * from CC_admin where username='$cadmin'";
     $getadmin2=mysql_query($getadmin) or die($no_login_error);
     $getadmin3=mysql_fetch_array($getadmin2);
     echo "<br><br><font color = 'red'>$admin_recognised_label  $getadmin3[username] $actions_label ";
     echo "<a href='admin/editblog.php?ID=$getblog3[entryid]'>$edit_item_label</a> - <A href='admin/deleteentry.php?ID=$getblog3[entryid]'>$delete_item_label</a>";
  }
  echo "<hr></td></tr></table><br>";
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
                if ($theblock !== "loginblock.php"){
                  include "$theblock";
                  echo "<br>";
                }
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