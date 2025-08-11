<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   $delfirst = $getprefs3[prunestats];
   $thisctr = '0';
   $arcquery = ("SELECT * FROM CC_stats ORDER By thedate DESC") or die($no_stats_error);
   $arcresult = mysql_query($arcquery);
   while($arcrow = mysql_fetch_array($arcresult))
   {
       $thisctr++;
       $ID=$arcrow[ID];
       if ($thisctr >= $delfirst+1)
       {
          $thisquery = ("DELETE FROM CC_stats WHERE ID = '$ID'") or die($no_stats_error);
          $thisresult = mysql_query($thisquery);
          $error_msg .= mysql_error();
       }
  }
  echo "<br><b>$error_msg<br></b>";
  include "index.php";
  $next = 0;
  $ID=$_GET['ID'];
  if(!isset($_GET['start']))
  {
    $start=0;
    $showmax = "75";
  }else{
    $start=$_GET['start'];
    $showmax = "75";
    $query =  ("SELECT * FROM CC_stats ORDER BY thedate DESC LIMIT $start,$showmax") or die ($no_stats_error);
    $result = mysql_query($query);
    echo "<br><br>";
    echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]><center>";
    $optquery = ("OPTIMIZE TABLE `CC_stats`");
    $optresult = mysql_query($optquery);
    ?>
    <b><br>Web Stats code extraction taken from Avanti Web Stats courtesy of Liquid Frog Software<b><br>
    Avanti Webstats allows you to view ALL your stats for ALL your sites at the same time on your desktop! Get
    your free copy at <a href="http://www.liquidfrog.com" target="_new">Liquid Frog</a><br><br>
    <?php
    echo "$number_of_stats_recorded_label $thisctr";
    echo "</font></b></center></td></tr></table>";
    echo "<table width = '100%' border = '1'><tr>";
    echo "<td valign = 'top'><b>$date_label</td>";
    echo "<td valign = 'top'><b>$current_ip_address_label</b></td>";
    echo "<td valign = 'top'><b>$remote_host_label</b></td>";
    echo "<td valign = 'top'><b>$country_label</b></td>";
    echo "<td valign = 'top'><b>$browser_label</b></td>";
    echo "<td valign = 'top'><b>$os_label</b></td>";
    echo "<td valign = 'top'><b>$referrer_label</b></td>";
    echo "<td valign = 'top'><b>$came_from_label</b></td>";
    echo "<td valign = 'top'><b>$java_enabled_label</b></td>";
    echo "<td valign = 'top'><b>$resolution_label</b></td></tr>";
    $theoffset = $getprefs3[time_offset];
    $theoffset = ($theoffset *'60');
    while($row = mysql_fetch_array($result))
    {
         if ($getprefs3[dateset] =="1"){
               $thedate = date('D M d Y - H:i:s',$row[thedate] + $theoffset);
         }else{
               $thedate = date('D d M Y - H:i:s',$row[thedate] + $theoffset);
         }
         echo "<td valign = 'top'>$thedate</td>";
         echo"<td valign = 'top'><a title= \"$trace_label\" href='queryindex.php?query=$row[remote_addr]'>$row[remote_addr]</a></td>";
         echo"<td valign = 'top'><a title= '$trace_label' href='queryindex.php?query=$row[remotead]'>$row[remotead]</a></td>";
         echo "<td valign = 'top'>$row[cty_name]</td>";
         echo "<td valign = 'top'>$row[web_browser]</td>";
         echo "<td valign = 'top'>$row[operating_system]</td>";
         if ($row[referrer] == 'Direct Hit'){
         echo "<td valign = 'top'>$direct_hit_label</td>";
         }else{
         echo "<td valign = 'top'><a href='$row[referrer]' target='_new'>$row[referrer]</a></td>";
         }
         echo "<td valign = 'top'><a href='$row[referrer2]' target='_new'>$row[referrer2]</a></td>";
         $jav = $row[jav];
         if ($jav == 'true')
         {
              echo "<td valign = 'top'>$yes_label</td>";
         }else{
              echo "<td valign = 'top'>$no_label</td>";
         }
              echo "<td valign = 'top'>$row[resolution]</td><tr>";
    }
    echo "<tr><td width = '100%' colspan = '10'><center><br>$go_to_page_label<br>";
    $order="SELECT * from CC_stats";
    $order2=mysql_query($order) or die(mysql_error());
    $ctr=0;
    $fixed=0;
    $md=1+$ctr/$showmax;
    $num=mysql_num_rows($order2);
    $next=$start+$showmax;
    if($start>=$showmax)
    {
       echo "<A href='logview.php?start=0&ID=$ID'><-</a>&nbsp;";
    }
    while($order3=mysql_fetch_array($order2))
    {
      if($fixed>=$start-3*$showmax&&$fixed<=$start+9*$showmax)
      {
         if($fixed%$showmax==0)
         {
             echo "<A href='logview.php?start=$ctr&ID=$ID'>$md</a>&nbsp;";
             $totalpages = $md;
         }
      }
     $ctr++;
     $md=1+$ctr/$showmax;
     $fixed++;
    }
    if($start<=$num-$showmax)
    {
      $end=$fixed-$showmax;
      echo "<A href='logview.php?start=$end&ID=$ID'>-></a>&nbsp;";
    }
    $pageno = ($start/$showmax)+1;
    $pageno = number_format($pageno,0);
    echo "<br>$page_number_label $pageno/$totalpages";
}
}else{
  echo $no_login_error;
  include "index.php";
}

?>