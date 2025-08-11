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
$siteaddress="$siteaddress/";
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
<!-- Start Avanti Web Stats tracking code - copyright (c) 2004 Liquid Frog Software - www.liquidfrog.com -->
<script src="<?$siteaddress?>stats/script.js" language="JavaScript"></script>
<noscript><img src="<?$siteaddress?>stats/script.php?image=1&javascript=false"></noscript>
</html>
<?php
@mysql_query("UPDATE CC_prefs SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
if ($_SESSION['cadmin'])
{
  echo "<font size = '4' font color = 'red'><center><b>$browse_in_admin_mode_label<br></center></b></font>";
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
if($getprefs3[shownewsticker]==1){
echo "<br>";
include "ticker.php";}
if(isset($_POST['submit']))
   {
   $getdlfile="SELECT * from CC_downloads WHERE dlid = $_POST[ID]";
   $getdlfile2=mysql_query($getdlfile) or die($no_download_error);
   $getdlfile3=mysql_fetch_array($getdlfile2);
   echo "<br><b>$fetch_file_label</b><br><br>";
   echo "<meta http-equiv='refresh' content='0;URL=$getdlfile3[dlurl]'target='_top'>";
   $count =  $getdlfile3[dlcount];
   $count == ($count++);
   $savecount="update CC_downloads set dlcount='$count' WHERE dlid = $_POST[ID]";
   mysql_query($savecount) or die($unable_to_save_counter_error);
   echo "<table border='1' cellspacing='3' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
   echo"<td width = '100%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getblocks3[download_block_label]</b> ";
   echo "<tr><td  style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 1; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 1' bgcolor=$getprefs3[center_block_backround_color]>";
   $query = "SELECT * from CC_downloads ORDER by dlid ASC";
   $result = mysql_query($query);
   $num_results = mysql_num_rows($result);
   for ($i=0; $i <$num_results; $i++)
         {
         $row = mysql_fetch_array($result);
         ($i+1);
         echo "<table border='0' cellspacing='3' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
         echo "<tr><td colspan = '3'><b>$row[dltitle]</b><br>";
         echo "<tr><td colspan = '3'>$row[dldescription]<br><br>";
         echo "<tr><td width = '20%'>$file_size_label $row[dlfilesize]KB";
         echo "<td>$row[dlcount] $downloads_so_far_label";
         echo "<td><p align='right'><form action='downloads.php' method='post'>";
         echo "<br><input type='submit' name='submit' value='$download_button_label' class = 'buttons'>";
         echo "<input type='hidden' name='ID' value=$row[dlid]></form>";
         echo "</font></table><br>";
   }
   echo "</td></tr></table><br>";
}
else
   {
   echo "<table border='1' cellspacing='3' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
   echo"<td width = '100%' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getblocks3[download_block_label]</b> ";
   echo "<tr><td  style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 1; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 1' bgcolor=$getprefs3[center_block_backround_color]>";
   $query = "SELECT * from CC_downloads ORDER by dlid ASC";
   $result = mysql_query($query);
   $num_results = mysql_num_rows($result);
   for ($i=0; $i <$num_results; $i++)
         {
         $row = mysql_fetch_array($result);
         ($i+1);
         echo "<table border='0' cellspacing='3' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
         echo "<tr><td colspan = '3'><b>$row[dltitle]</b><br>";
         echo "<tr><td colspan = '3'>$row[dldescription]<br><br>";
         echo "<tr><td width = '20%'>$file_size_label $row[dlfilesize]KB";
         echo "<td>$row[dlcount] $downloads_so_far_label";
         echo "<td><p align='right'><form action='downloads.php' method='post'>";
         echo "<br><input type='submit' name='submit' value='$download_button_label' class = 'buttons'>";
         echo "<input type='hidden' name='ID' value=$row[dlid]></form>";
         echo "</font></table><br>";
   }
   echo "</td></tr></table><br>";
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