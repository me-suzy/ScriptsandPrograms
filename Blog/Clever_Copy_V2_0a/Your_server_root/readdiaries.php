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
 if ($visitor_name !== $guest_name_label){
   echo  "$welcome_back_user_label $visitor_name";
 }else{
   echo "$getprefs3[title] $welcomes_visitor_label - $visitor_name";
 }
 if($getprefs3[showwelcome_message]==1){
   include "welcome.php";}
 if($getprefs3[shownewsticker]==1){
   echo "<br>";include "ticker.php";}
 $showmax=6;
 echo "<table border='0' cellspacing='0' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]' width='100%'>";
 echo "<tr><td colspan='3'><center><b>$read_mdiary_title_label</b><br><br></center></td></tr>";
 echo "<tr><td colspan = '3' valign='top' align = 'left'>";
if(isset($_SESSION['cuser']))
{
 if(!isset($_GET['start']))
 {
    $start=0;
 }
 else
 {
    $start=$_GET['start'];
 }
 $jorder="SELECT * from CC_journal WHERE public = '1' ORDER BY realtime DESC";
 $jorder2=mysql_query($jorder) or die($no_gbook_error);
 $tctr=0;
 $fixed=0;
 $md=1+$tctr/$showmax;
 $num=mysql_num_rows($jorder2);
 $prev=$start-$showmax;
 $next=$start+$showmax;
 $pageno = ($start/$showmax)+1;
 $pageno = number_format($pageno,0);
 echo "<br><center>$page_number_label $pageno<br>";
 if($start>=$showmax)
 {
   echo "<A href='readdiaries.php?start=$prev'><-</a>&nbsp;";
 }
 while($jorder3=mysql_fetch_array($jorder2))
 {
  if($fixed>=$start-3*$showmax&&$fixed<=$start+7*$showmax)
  {
     if($fixed%$showmax==0)
     {
           echo "<A href='readdiaries.php?start=$tctr'>$md </a> ";
     }
  }
  $tctr=$tctr+1;
  $md=1+$tctr/$showmax;
  $fixed++;
 }
 if($start<=$num-$showmax)
 {
   echo "<A href='readdiaries.php?start=$next'>-></a>&nbsp;";
 }
 echo "<tr><td colspan = '3' valign = 'top'><hr color=$getprefs3[separatorlinecolor] size = '1'>";
 $journal="SELECT * FROM CC_journal WHERE public = '1' ORDER BY realtime DESC LIMIT " . $start . ", $showmax";
 $row=mysql_query($journal);
 echo "<center>";
 echo "<tr><td width = '10%'valign = 'top'><b>$diary_entry_post_by_label</b><br>";
 echo "<td width = '20%'valign = 'top'><b>$diary_entry_post_dt_label</b><br>";
 echo "<tr><td colspan = '2'><hr color=$getprefs3[separatorlinecolor] size = '1'>";
 while($journalvalues=mysql_fetch_array($row))
 {
   echo "<tr><td width = '10%'valign = 'top'><b>$journalvalues[user]</b><br>";
   echo "<td width = '20%'valign = 'top'><b>$journalvalues[date]</b><br><br>";
   echo "<tr><td colspan = '2' width = '70%'valign = 'top'><b>$journalvalues[title]</b><br>";
   echo "<tr><td colspan = '2' valign = 'top'><br>$journalvalues[entry]";
   echo "<tr><td colspan = '2' valign = 'top'><hr>";
 }
 echo "<tr><td width=100%  colspan = '3' valign='top' align = 'left'>";
 echo "<form><input type='button' class = 'buttons' value='$back_label' onclick='history.back()'></form>";
 echo "</center>";
 echo "</td></tr></table>";
}else{
  ?>
  <html><head><title><?php echo $getprefs3[title]; ?></title>
  <link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
  </head>
  <?php
  echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
  echo "<tr><td><center><b>$cannot_readdiary_label</b><br><br></center></td></tr>";
  echo "<META HTTP-EQUIV = 'Refresh' Content = '3; URL =index.php'>";
  echo "<tr><td align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
  echo "</td></tr></table>";
  exit;
}
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

?>