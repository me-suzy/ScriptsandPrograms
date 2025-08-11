<?php
session_start();
include "admin/connect.inc";
include "languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
$siteaddress = $getprefs3[siteaddress];
$getbprefs="SELECT * from CC_bannerprefs";
$getbprefs2=mysql_query($getbprefs) or die($no_preferences_error);
$getbprefs3=mysql_fetch_array($getbprefs2);
$auto_prune = $getbprefs3[auto_prune];
?>
<html>
<head>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
$date = mktime();
$query="SELECT ID, last_update, owner, paused,never_expire, date_limit_on, start_date, end_date, clickthru_limit_on, clickthru_limit, clickthru, view_limit, views, view_limit_on, bannerfile, bannerurl, banneralt, active, refresh FROM CC_sidebanners";
$res = @mysql_query($query);
$num = mysql_num_rows($res);
if($num == 0)
exit();
$row = array();
if(!isset($_GET['lastbannerid'])){
    $row = mysql_fetch_array($res);
}
else{
    $first = true;
    while($row0 = mysql_fetch_array($res)){
        if($first){
            $row = $row0;
            $first = false;
        }
        if($row0['ID'] == $_GET['lastbannerid']){
            if( $row0 = mysql_fetch_array( $res ) ){
                $row = $row0;
            }
            break;
        }
    }
}
$startdate = $row[start_date];
$enddate = $row[end_date];
$banners_refresh_interval = $row[refresh];
$banners_refresh_interval= $banners_refresh_interval*1000;
?>
<script language="JavaScript">
function refresh()
{
 document.location = "<?=$_SERVER['PHP_SELF']?>?lastbannerid=<?=$row['ID']?>";
}
setTimeout("refresh()",<?=$banners_refresh_interval?> );
</script>
<body style="margin: 0px"><center>
<?php
$ID = $row[ID];
echo "$visit_our_sponsors_label<br>";
echo "<a href='bannerlogin.php' target = '_new'>$your_side_banner_here</a><br>";

if (($date >= $startdate) && ($date < $enddate) && ($row[active]=='0') && ($row[date_limit_on]=='1')){
    mysql_query( "UPDATE CC_sidebanners SET active = '1' WHERE ID = ". $row['ID'] );
}
if (($row[views]>= $row[view_limit]) && ($row[view_limit_on]=='1') && ($auto_prune == '1') && ($row[active]=='0') && ($row[paused]!== '1') && ($row[paused]!== '1') && ($row[ID] !=='1')){
   @mysql_query("DELETE FROM CC_sidebanners WHERE ID = ". $row['ID']);
   $error_msg .= mysql_error();
   echo "<br><b>$error_msg</b>";
}
if  (($row[active]=='0') && ($row[clickthru_limit_on]=='1') && ($auto_prune == '1') && ($row[clickthru]>= $row[clickthru_limit]) && ($row[paused]!== '1') && ($row[ID] !=='1')){
   @mysql_query("DELETE FROM CC_sidebanners WHERE ID = ". $row['ID']);
   $error_msg .= mysql_error();
   echo "<br><b>$error_msg</b>";
}
if  (($row[active]=='0') && ($row[date_limit_on]=='1') && ($auto_prune == '1') && ($date >= $row[end_date]) && ($row[paused]!== '1') && ($row[ID] !=='1')){
   @mysql_query("DELETE FROM CC_sidebanners WHERE ID = ". $row['ID']);
   $error_msg .= mysql_error();
   echo "<br><b>$error_msg</b>";
}
$sitebann = $row['bannerfile'];
$sitebanner = "$siteaddress/$sitebann";
if (($date >= $startdate) && ($date < $enddate) && ($row[active]=='0') && ($row[date_limit_on]=='1')){
    mysql_query( "UPDATE CC_sidebanners SET active = '1' WHERE ID = ". $row['ID'] );
}
if (($row[active]=='1') && ($row[view_limit_on]=='1') && ($row[views]<= $row[view_limit]) && ($row[paused]!== '1')){
        ?>
        <br><center><a title= '<?=$row['banneralt']?>' href="sidebanner_opener.php?ID=<?php echo $row['ID']; ?>" onClick="JavaScript:refresh()" target="_blank"><img src="<?=$sitebanner?>" border=0/></a> <!-- //// -->
        <?php
        mysql_query("UPDATE CC_sidebanners SET views = views + 1 WHERE ID = ". $row['ID']);
        if (($row[views]>= $row[view_limit])){
              mysql_query("UPDATE CC_sidebanners SET active = '0', end_date = '$date' WHERE ID = ". $row['ID']);
        }
        $thisviews = $row[views];
        $thisowner = $row[owner];
        $thisbanner = $row[bannerfile];
        $thisstart_date = $row[start_date];
        mysql_query("UPDATE CC_bannerhistory SET views = views + 1, end_date = '$date' WHERE owner = '$thisowner' && bannerfile = '$thisbanner' && start_date = '$thisstart_date' && views = '$thisviews+1'");
        $error_msg .= mysql_error();
        echo "<br>$error_msg<br>";
}elseif  (($row[active]=='1') && ($row[clickthru_limit_on]=='1') && ($row[clickthru]<= $row[clickthru_limit]) && ($row[paused]!== '1')){
   ?>
   <br><center><a title= '<?=$row['banneralt']?>' href="sidebanner_opener.php?ID=<?php echo $row['ID'];?>" onClick="JavaScript:refresh()" target="_blank"><img src="<?=$sitebanner?>" border=0/></a>    <!-- //// -->
   <?php
   mysql_query("UPDATE CC_sidebanners SET views = views + 1 WHERE ID = ". $row['ID']);
   if (($row[clickthru]>= $row[clickthru_limit])){
         mysql_query("UPDATE CC_sidebanners SET active = '0', end_date = '$date' WHERE ID = ". $row['ID']);
         $thisviews = $row[views];
         $thisowner = $row[owner];
         $thisbanner = $row[bannerfile];
         $thisstart_date = $row[start_date];
         mysql_query("UPDATE CC_bannerhistory SET views = views + 1, end_date = '$date' WHERE owner = '$thisowner' && bannerfile = '$thisbanner' && start_date = '$thisstart_date' && views = '$thisviews+1'");
         $error_msg .= mysql_error();
         echo "<br>$error_msg<br>";
   }
}elseif  (($row[active]=='1') && ($row[never_expire]=='1') && ($row[paused]!== '1')){
   ?>
   <br><center><a title= '<?=$row['banneralt']?>' href="sidebanner_opener.php?ID=<?php echo $row['ID'];?>" onClick="JavaScript:refresh()" target="_blank"><img src="<?=$sitebanner?>" border=0/></a>   <!-- ////$siteaddress$row['bannerfile'] -->
   <?php
   mysql_query("UPDATE CC_sidebanners SET views = views + 1 WHERE ID = ". $row['ID']);
   $thisviews = $row[views];
   $thisowner = $row[owner];
   $thisbanner = $row[bannerfile];
   $thisstart_date = $row[start_date];
   $thisenddate = $row[end_date];
   mysql_query("UPDATE CC_bannerhistory SET views = views + 1, end_date = '$date' WHERE owner = '$thisowner' && bannerfile = '$thisbanner' && start_date = '$thisstart_date' && views = '$thisviews+1'");
   $error_msg .= mysql_error();
   echo "<br>$error_msg<br>";
}elseif  (($row[active]=='1') && ($row[date_limit_on]=='1') && ($date <= $row[end_date])&& ($row[paused]!== '1')){
   ?>
   <br><center><a title= '<?=$row['banneralt']?>' href="sidebanner_opener.php?ID=<?php echo $row['ID'];?>" onClick="JavaScript:refresh()" target="_blank"><img src="<?=$sitebanner?>" border=0/></a>   <!-- //// -->
   <?php
   mysql_query("UPDATE CC_sidebanners SET views = views + 1 WHERE ID = ". $row['ID']);
   $thisviews = $row[views];
   $thisowner = $row[owner];
   $thisbanner = $row[bannerfile];
   $thisstart_date = $row[start_date];
   mysql_query("UPDATE CC_bannerhistory SET views = views + 1, end_date = '$date' WHERE owner = '$thisowner' && bannerfile = '$thisbanner' && start_date = '$thisstart_date' && views = '$thisviews+1'");
   $error_msg .= mysql_error();
   echo "<br>$error_msg<br>";
}elseif (($row[date_limit_on]=='1') && ($row[paused]== '1')){
    $now_time=  mktime();
    $last_update = $row['last_update'];
    $diff = ($now_time-$last_update);
    $query="SELECT bannerfile, bannerurl, banneralt, active, refresh FROM CC_sidebanners WHERE ID ='1'";
    $res = @mysql_query($query);
    $row = mysql_fetch_array($res);
    ?>
    <br><center><a title= '<?=$row['banneralt']?>' href="sidebanner_opener.php?ID=1" onClick="JavaScript:refresh()" target="_blank"><img src="<?=$sitebanner?>" border=0/></a>     <!-- //// -->
    <?php
    if  ($diff > 86400)
    {
      if ($last_update == '0')
      {
        mysql_query("UPDATE CC_sidebanners SET last_update = '$now_time' WHERE ID = '$ID'");
        $error_msg .= mysql_error();
      }
      else
      {
      $end_date=$enddate+ 86400;
      mysql_query("UPDATE CC_sidebanners SET last_update = '$now_time', end_date = '$end_date' WHERE ID = '$ID'");
      $error_msg .= mysql_error();
      echo "<br>$error_msg<br>";
      }
    }
}elseif (($date >= $row[end_date])&& ($row[active] =='1') && ($row[date_limit_on]=='1') && ($row[paused]!== '1')){
   mysql_query( "UPDATE CC_sidebanners SET active = '0', end_date = '$date' WHERE ID = ". $row['ID'] );
   $thisviews = $row[views];
   $thisowner = $row[owner];
   $thisbanner = $row[bannerfile];
   $thisstart_date = $row[start_date];
   mysql_query("UPDATE CC_bannerhistory SET end_date = '$date' WHERE owner = '$thisowner' && bannerfile = '$thisbanner' && start_date = '$thisstart_date' && views = '$thisviews'");
   $error_msg .= mysql_error();
   echo "<br>$error_msg<br>";
}else{
    $query="SELECT bannerfile, bannerurl, banneralt, active, refresh FROM CC_sidebanners WHERE ID ='1'";
    $res = @mysql_query($query);
    $row = mysql_fetch_array($res);
    ?>
    <br><center><a title= '<?=$row['banneralt']?>' href="sidebanner_opener.php?ID=1" onClick="JavaScript:refresh()" target="_blank"><img src="<?=$sitebanner?>" border=0/></a>    <!-- //// -->
    <?php
}
echo "<br><br></center></body></html>";
?>