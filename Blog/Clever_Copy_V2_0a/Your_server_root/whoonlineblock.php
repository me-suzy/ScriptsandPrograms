<?php
include "admin/connect.inc";
$style = $getprefs3[personality];
$counter = $getprefs3[counter];
$counteron = $getprefs3[showcounter];
$membercounton = $getprefs3[membercounton];
?>
<head><title></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
if($getprefs3[showseparator]==1)
{
   echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";
}
if ($getprefs3[useblockwrapper]==1)
{
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   if ($getprefs3[block_use_heading_graphic] ==1)
   {
       echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height] background='bkgd.gif'>";
   }else{
       echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
   }
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[visitors_online_block_label]</font></b></center></td></tr>";
   echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
   $thisctr++;
   $thehit=getenv ("REMOTE_ADDR");
   $curtime=time();
   $rfrshtime=$curtime-60;
   @mysql_query("DELETE from CC_online WHERE timeofvisit<$rfrshtime");
   $hitexists=@mysql_num_rows(@mysql_query("SELECT id FROM CC_online WHERE visitor='$thehit'"));
   if ($hitexists>0){
           @mysql_query("UPDATE CC_online SET timeofvisit='$curtime' WHERE visitor='$thehit'");
   }else{
       @mysql_query("INSERT into CC_online (visitor,timeofvisit) VALUES ('$thehit','$curtime')");
   }
   $getadmin=@mysql_query("SELECT * from CC_online");
   while ($row=@mysql_fetch_array($getadmin)){
        if(isset($_SESSION['cadmin']))
        {
           echo"<center><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title= $trace_label href='admin/queryindex.php?query=$row[visitor]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$row[visitor]</a></font>";
        }
   }
   if(isset($_SESSION['cadmin'])){
       echo "<br>$admins_see_ip_label<br>-------------<br>";
   }
   $visitorsonline=@mysql_num_rows(@mysql_query("SELECT id from CC_online"));
   $count=$getprefs3[mostonline];
   if ($visitorsonline >= $count)
   {
      mysql_query("UPDATE CC_prefs SET mostonline ='$visitorsonline'");
   }
   echo "<div align=center>$visitorsonline<br>$visitors_online_label</div>";
   if($getprefs3[showmostonline]==1)
   {
      echo "<br><div align=center>$most_ever_online_label<br>$count</div>";
   }
   if (($counteron == '1')||(isset($_SESSION['cadmin'])))
   {
      echo "<div align=center><br>$counter<br>$total_page_views_label</div>";
   }
   if (($membercounton == '1')||(isset($_SESSION['cadmin'])))
   {
     $memcount = '0';
     $memquery = ("SELECT * FROM CC_users") or die($no_users_error);
     $memresult = mysql_query($memquery);
     while($memrow = mysql_fetch_array($memresult))
     {
        $memcount++;
     }
     echo "<div align=center><br>$memcount<br>$total_members_label</div>";
   }
   echo "</td></tr></table><br>";
}else{
   echo "<center><font face = $getprefs3[block_heading_font_face] size = $getprefs3[block_heading_font_size] color= $getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$getblocks3[visitors_online_block_label]</$getprefs3[block_heading_font_decoration]></font></center>";
   echo "<hr color=$getprefs3[separatorlinecolor] size = '1'><br></font>";
   $thehit=getenv ("REMOTE_ADDR");
   $curtime=time();
   $rfrshtime=$curtime-600;
   @mysql_query("DELETE from CC_online WHERE timeofvisit<$rfrshtime");
   $hitexists=@mysql_num_rows(@mysql_query("SELECT id FROM CC_online WHERE visitor='$thehit'"));
   if ($hitexists>0){
           @mysql_query("UPDATE CC_online SET timeofvisit='$curtime' WHERE visitor='$thehit'");
   }else{
       @mysql_query("INSERT into CC_online (visitor,timeofvisit) VALUES ('$thehit','$curtime')");
  }

  $getadmin=@mysql_query("SELECT * from CC_online");
  while ($row=@mysql_fetch_array($getadmin)){
        if(isset($_SESSION['cadmin']))
        {
           echo"<center><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title= $trace_label href='admin/queryindex.php?query=$row[visitor]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$row[visitor]</a></font>";
        }
  }
  if(isset($_SESSION['cadmin'])){
     echo "<br>$admins_see_ip_label<br>-------------<br>";
  }
  $visitorsonline=@mysql_num_rows(@mysql_query("SELECT id from CC_online"));
  $getcount="SELECT mostonline from CC_prefs";
  $getcount2=mysql_query($getcount) or die($no_prefs_error);
  $getcount3=mysql_fetch_array($getcount2);
  $count=$getcount3[mostonline];
  if ($visitorsonline >= $count)
  {
      mysql_query("UPDATE CC_prefs SET mostonline ='$visitorsonline'");
  }
  echo "<div align=center>$visitorsonline<br>$visitors_online_label</div>";
  if($getprefs3[showmostonline]==1)
  {
      echo "<br><div align=center>$most_ever_online_label<br>$count</div>";
  }
  if (($counteron == '1')||(isset($_SESSION['cadmin'])))
  {
    echo "<div align=center><br>$counter<br>$total_page_views_label</div>";
  }
  if (($membercounton == '1')||(isset($_SESSION['cadmin'])))
  {
     $memcount = '0';
     $memquery = ("SELECT * FROM CC_users") or die($no_users_error);
     $memresult = mysql_query($memquery);
     while($memrow = mysql_fetch_array($memresult))
     {
        $memcount++;
     }
     echo "<div align=center><br>$memcount<br>$total_members_label</div>";
  }
echo"<br>";
}
?>