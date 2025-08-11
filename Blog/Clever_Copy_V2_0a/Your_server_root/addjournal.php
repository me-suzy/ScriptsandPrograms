<?php
session_start();
include "admin/connect.inc";
include "admin/languages/default.php";
include "languages/default.php";
include "antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
$siteaddress = $getprefs3[siteaddress];
$siteaddress = "$siteaddress/";
$getblocks="SELECT * from CC_block_names";
$getblocks2=mysql_query($getblocks) or die($no_blocks_error);
$getblocks3=mysql_fetch_array($getblocks2);
?>
<head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<!-- Start Avanti Web Stats tracking code - copyright (c) 2004 Liquid Frog Software - www.liquidfrog.com -->
<script src="<?$siteaddress?>stats/script.js" language="JavaScript"></script>
<noscript><img src="<?$siteaddress?>stats/script.php?image=1&javascript=false"></noscript>
</html>
<?php
@mysql_query("UPDATE CC_prefs SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
if(isset($_SESSION['cuser']))
   {
   $cuser=$_SESSION['cuser'];
   $getuser="SELECT * from CC_users WHERE username='$cuser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   if ($getuser3[user_site_name]==""){
        $visitor_name = $guest_name_label;
   }else{
        $visitor_name =  $getuser3[user_site_name];
   }
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
                  if ($row["block_file"] == "loginblock.php")
                  {
                  echo "";
             }else{
                   include "$theblock";
                   echo "<br>";
             }
          }
       }
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="0")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
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
   echo "$getprefs3[title] $welcomes_visitor_label - $visitor_name"; }
 else {
   echo  "$welcome_back_user_label $visitor_name"; }
 if($getprefs3[showwelcome_message]==1){
   include "welcome.php";}
 if($getprefs3[shownewsticker]==1){
   include "ticker.php";}
 echo "<table border='0' cellspacing='0' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]' width='100%'>";
 echo "<tr><td colspan='3'><center><b>$add_to_diary_label</b><br><br></center></td></tr>";
 echo "<tr><td colspan = '3' valign='top' align = 'left'>";
 echo "<form action='addjournal.php?op=publish' method='post' name='form'>";
 if($_SESSION['cuser'])
 {
   echo "<center>$vis_post_news_title_label<br>";
   echo "<input type='text' name='title' size='80'><br><br>";
   echo "$your_diary_entry_label<br>";
   echo "<textarea name='entry' rows='5' cols='100'></textarea><br><br>";
   echo "$who_can_see_diary_label<br>";
   echo "<select name='public'>";
   echo "<option value='1'>$public_label</option>";
   echo "<option value='0'>$private_label</option>";
   echo "</select><br><br><br>";
   echo "<input type='submit' name='submit' value='$publish_diary_button_label'class = 'buttons'></form>";
 }else{
   echo "<center><b>$not_authorised_error_label</b>";
   echo "<meta http-equiv='refresh' content='2;URL=login.php?'>";
   echo "<center>$if_you_see_label <a href='index.php'>$click_here_label</a>";
   exit;
 }
 echo "<form><input type='button' class = 'buttons' value='$back_label' onclick='history.back()'></form>";
 echo "</center>";


 switch( $_GET[ "op" ] )
 {
 case "publish":
 $entry = antihaxmjr($_POST['entry']);
 $title = antihaxmjr($_POST['title']);
 $public = antihaxmjr($_POST['public']);
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
 $now = mktime();
 $makediary="INSERT into CC_journal (realtime, user, entry,date, title,public) values('$now','$visitor_name','$entry','$date','$title','$public')";
 mysql_query($makediary) or die($no_diary_error);
 echo "<tr><td colspan = '3' valign='top' align = 'left'>";
 echo "<b><center>$post_diary_success_label<br></b>";
 echo "<meta http-equiv='refresh' content='2;URL=myjournal.php?'>";
 echo "<center>$if_you_see_label <a href='myjournal.php'>$click_here_label</a>";
 break;
 }
 echo "</td></tr></table>";
 if($getprefs3[showrightblocks]==1){
 echo "<td valign='top' width='181'>";
 echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
 $query =  ("SELECT * FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
 $result = mysql_query($query);
 if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
 while($row = mysql_fetch_array($result)){
       $theblock = $row["block_file"];
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="1") && ($row["view"]=="1")) || (($row["side"]=="1") && ($row["view"]=="0"))){
                  if ($row["block_file"] == "loginblock.php")
                  {
                  echo "";
             }else{
                   include "$theblock";
                   echo "<br>";
             }
          }
       }
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="1")&& ($row["view"]=="2")) || (($row["side"]=="1") && ($row["view"]=="1")) || (($row["side"]=="1") && ($row["view"]=="0"))){
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
}
else
   {
   echo "<center><b>$not_authorised_error_label</b>";
   echo "<meta http-equiv='refresh' content='2;URL=login.php?'>";
   echo "<center>$if_you_see_label <a href='index.php'>$click_here_label</a>";
   exit;
}
?>