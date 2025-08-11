<?php
session_start();
include "languages/default.php";
include "connect.inc";
include "../antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
$siteaddress = $getprefs3[siteaddress];
$style = "$siteaddress/$style";
$ex_link_text_label = $getprefs3[linkex_text];
$autodelete_links = $getprefs3[exlink_delete_method];
?>
<head><title><?php echo $admin_title; ?></title></head>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
<?php
$version =  $getprefs3['version'];
$graphicsvalue = $getprefs3['admingraphics'];
$querythis =  ("SELECT * FROM CC_weblinks") or die($no_weblinks_error);
$theresult = mysql_query($querythis);
$not_foundctr = '0';
while($webrow = mysql_fetch_array($theresult))
{
  $ID = $webrow[weblinksid];
  $siteurl = $webrow['recip'];
  $recip = "<a href='$siteaddress' target='_new'>$ex_link_text_label</a>";
  if (@backlinkCheck($siteurl, $recip)) {
    @mysql_query( "UPDATE CC_weblinks SET recipstatus = '1' WHERE weblinksid = '$ID'");
  }else{
    $not_foundctr++;
    @mysql_query( "UPDATE CC_weblinks SET recipstatus = '0' WHERE weblinksid = '$ID'");
    $error_msg .= mysql_error();
    echo $error_msg;
    if ($autodelete_links == '1')
    {
         @mysql_query( "DELETE FROM CC_weblinks WHERE weblinksid = '$ID'");
         $error_msg .= mysql_error();
         echo $error_msg;
    }
  }
}
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]><center>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$admin_panel_label</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
echo "<center>$admin_panel_description_label <br><br>";
if ($getadmin3['status']==0)
{
   echo $admins_only_error;
   exit;
}
if($getadmin3['status']==3 || $getadmin3['status']==2 || $getadmin3['status']==1)
{
   echo "$logged_in_as_label <b>";
   echo  $getadmin3['username'];
   echo " </b>$admin_clearance_label";
   if  ($getadmin3['status']==3){
     echo "<b>$god_label </b>$god_description_label";
   }
   elseif  ($getadmin3['status']==2){
     echo "<b>$admin_label</b>$admin_description_label";
   }else{
      echo "<b>$superuser_label</b> $superuser_description_label";
   }
   echo "<table border='0' cellspacing='3'width = '100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr><td><center>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]></font></b></center></td></tr>";
   echo "<tr><td colspan = '10' bgcolor=$getprefs3[block_background_color]>";
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>Info</font></b></td></tr>";
   echo "<tr><td><a href='credits.php'>Credits</a><br>";
   echo "<tr><td><a href='license.php'>License, limits</a><br>";
   echo "<tr><td><a href='customise.php'>Clever Copy custom configuration </a><br>";
   echo "<tr><td><a href='buyblocks.php'>Clever Copy add on's</a><br>";
   echo "<tr><td>This $version_label $version  <br><tr><td>";
   echo "<iframe height='80' width='100%' src='getinf.php' frameborder='1' scrolling='yes'> </iframe>";
   echo "</td></tr></table><br>";
   if ($graphicsvalue == "1") {
        echo "<tr><br><br>";
        echo "<td align = 'center' width = '60' valign='top'><a href='index.php'><img border='0' src='../images/admin/mainadmin.gif' width='55' height='38'></a><br><font size ='1'>$refresh_label<br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='addarticle.php'><img border='0' src='../images/admin/additem.gif' width='55' height='38'></a><br><font size ='1'>$add_news_label<br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='http://www.clevercopy.net' target = '_new'><img border='0' src='../images/admin/homesite.gif' width='55' height='38'></a><br><font size ='1'>$visit_home_site_label<br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='adminhelp.php'><img border='0' src='../images/admin/help.gif' width='55' height='38'></a><br><font size ='1'>$help_label<br></td>";
        if  ($getadmin3['status']==2){
              echo "<td align = 'center' width = '60' valign='top'><a href='ban.php'><img border='0' src='../images/admin/banning.gif' width='55' height='38'></a><br><font size ='1'>$ban_ip_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='queryindex.php'><img border='0' src='../images/admin/query.gif' width='55' height='38'></a><br><font size ='1'>$network_query_label<br></td>";
              echo "<tr>";
              echo "<td align = 'center' width = '60' valign='top'><a href='../index.php'><img border='0' src='../images/admin/edit.gif' width='55' height='38'></a><br><font size ='1'>$admin_browse_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='shout.php'><img border='0' src='../images/admin/shout.gif' width='55' height='38'></a><br><font size ='1'>$shout_label<br></td>";
        }
        if  ($getadmin3['status']==3){
              echo "<td align = 'center' width = '60' valign='top'><a href='../index.php'><img border='0' src='../images/admin/edit.gif' width='55' height='38'></a><br><font size ='1'>$admin_browse_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='ban.php'><img border='0' src='../images/admin/banning.gif' width='55' height='38'></a><br><font size ='1'>$ban_ip_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editscroller.php'><img border='0' src='../images/admin/scroller.gif' width='55' height='38'></a><br><font size ='1'>$scroller_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='pruneentries.php'><img border='0' src='../images/admin/prune.gif' width='55' height='38'></a><br><font size ='1'>$prune_label<br></td>";
              echo "<td  width = '60' align = 'center' valign='top'><a href='editprefs.php'><img border='0' src='../images/admin/prefs.gif' width='55' height='38'></a><br><font size ='1'>$site_preferences_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editadmn.php'><img border='0' src='../images/admin/editadmin.gif' width='55' height='38'></a><br><font size ='1'>$edit_admins_label<br></td><br>";
              echo "<tr><td><br></td><tr></tr>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editbanners.php'><img border='0' src='../images/admin/banners.gif' width='55' height='38'></a><br><font size ='1'>$banners_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editnewsletter.php'><img border='0' src='../images/admin/newsletter.gif' width='55' height='38'></a><br><font size ='1'>$newsletter_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editshout.php'><img border='0' src='../images/admin/shout.gif' width='55' height='38'></a><br><font size ='1'>$shout_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editrssfeed.php'><img border='0' src='../images/admin/meta.gif' width='55' height='38'></a><br><font size ='1'>$meta_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editdownloads.php'><img border='0' src='../images/admin/downloads.gif' width='55' height='38'></a><br><font size ='1'>$downloads_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='blocks.php'><img border='0' src='../images/admin/blocks.gif' width='55' height='38'></a><br><font size ='1'>$blocks_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='logview.php?&ID=1&start=0'><img border='0' src='../images/admin/stats.gif' width='55' height='38'></a><br><font size ='1'>$stats_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='queryindex.php'><img border='0' src='../images/admin/query.gif' width='55' height='38'></a><br><font size ='1'>$network_query_label<br></td>";
              $ctr = '0';
              $query2 =  ("SELECT * FROM CC_weblinksposted") or die($no_weblinks_error);
              $result2 = mysql_query($query2);
              while( $row2 = mysql_fetch_array($result2) )
              {
                 $ctr++;
              }
              if (($ctr !=='0')|| ($not_foundctr !== '0'))
              {
                echo "<td align = 'center' width = '60' valign='top'><a href='editweblinks.php'><img border='0' src='../images/admin/web_linkswaiting.gif' width='55' height='38'></a><br><font size ='1'>$weblinks_label<br></td>";
              }else{
                echo "<td align = 'center' width = '60' valign='top'><a href='editweblinks.php'><img border='0' src='../images/admin/web_links.gif' width='55' height='38'></a><br><font size ='1'>$weblinks_label<br></td>";
              }
              echo "<td align = 'center' width = '60' valign='top'><a href='editmenu.php'><img border='0' src='../images/admin/editmenu.gif' width='55' height='38'></a><br><font size ='1'>$editmenu_label<br></td>";
              echo "<tr><td><br></td><tr></tr>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editticker.php'><img border='0' src='../images/admin/ticker.gif' width='55' height='38'></a><br><font size ='1'>$newsticker_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editprofile.php'><img border='0' src='../images/admin/profile.gif' width='55' height='38'></a><br><font size ='1'>$editprofile_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editranquotes.php'><img border='0' src='../images/admin/ranquotes.gif' width='55' height='38'></a><br><font size ='1'>$ranquotes_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editgallery.php'><img border='0' src='../images/admin/editgallery.gif' width='55' height='38'></a><br><font size ='1'>$gallery_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='info.php'target='new'><img border='0' src='../images/admin/phpinfo.gif' width='55' height='38'></a><br><font size ='1'>$phpinfo_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editcalendar.php'><img border='0' src='../images/admin/editcal.gif' width='55' height='38'></a><br><font size ='1'>$editcalendar_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='block_weighting.php'><img border='0' src='../images/admin/blockpos.gif' width='55' height='38'></a><br><font size ='1'>$block_weighting_label<br></td>";
              $thisquery4 =  ("SELECT * FROM CC_vposted_news") or die($no_news_error);
              $thisresult4 = mysql_query($thisquery4);
              $newctr = '0';
              while($thisrow4 = mysql_fetch_array($thisresult4))
              {
                 $newctr++;
              }
              if ($newctr !== '0')
              {
                 echo "<td align = 'center' width = '60' valign='top'><a href='usersubmittednews.php'><img border='0' src='../images/admin/usernewswaiting.gif' width='55' height='38'></a><br><font size ='1'>$usernews_label<br></td>";
              }else{
                 echo "<td align = 'center' width = '60' valign='top'><a href='usersubmittednews.php'><img border='0' src='../images/admin/usernews.gif' width='55' height='38'></a><br><font size ='1'>$usernews_label<br></td>";
              }
              echo "<td align = 'center' width = '60' valign='top'><a href='editwelcome.php'><img border='0' src='../images/admin/welcomemsg.gif' width='55' height='38'></a><br><font size ='1'>$welcome_msg_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editsiteslogan.php'><img border='0' src='../images/admin/slogan.gif' width='55' height='38'></a><br><font size ='1'>$slogan_label<br></td>";
              echo "<tr><td><br></td><tr></tr>";
              echo "<td align = 'center' width = '60' valign='top'><a href='http://clevercopy.bestdirectbuy.com/forum/' target='_new'><img border='0' src='../images/admin/support.gif' width='55' height='38'></a><br><font size ='1'>$support_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editmembers.php?&ID=1&start=0'><img border='0' src='../images/admin/users.gif' width='55' height='38'></a><br><font size ='1'>$edit_users_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editpoll.php'><img border='0' src='../images/admin/editpoll.gif' width='55' height='38'></a><br><font size ='1'>$edit_poll_label<br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='editcategories.php'><img border='0' src='../images/admin/editcategory.gif' width='55' height='38'></a><br><font size ='1'>$edit_categories_label<br></td>";
            }
            echo "<td><td><td><td align = 'center' width = '60' valign='top'><a href='bugreporting.php'><img border='0' src='../images/admin/bug.gif' width='55' height='38'></a><br><font size ='1'>$bug_label<br></td>";
            $thisquery3 =  ("SELECT * FROM CC_ppcsubmitted") or die($no_ppc_error);
            $thisresult3 = mysql_query($thisquery3);
            $newppcctr = '0';
            while($thisrow = mysql_fetch_array($thisresult3))
            {
               if ($thisrow[validated] == '1'){
                    $newppcctr++;
               }
            }
            $thisquery4 =  ("SELECT * FROM CC_ppc") or die($no_ppc_error);
            $thisresult4 = mysql_query($thisquery4);
            while($therow4 = mysql_fetch_array($thisresult4))
            {
               if ($therow4[invoice_paid] == '0'){
                 $newppcctr++;
               }
            }
            if ($newppcctr !== '0')
            {
               echo "<td align = 'center' width = '60' valign='top'><a href='editppc.php'><img border='0' src='../images/admin/ppcwaiting.gif' width='55' height='38'></a><br><font size ='1'>$edit_ppc_label<br></td>";
            }else{
               echo "<td align = 'center' width = '60' valign='top'><a href='editppc.php'><img border='0' src='../images/admin/ppc.gif' width='55' height='38'></a><br><font size ='1'>$edit_ppc_label<br></td>";
            }
            echo "<td width = '60' align = 'center' valign='top'><a href='gone.php'><img border='0' src='../images/admin/logout.gif' width='55' height='38'></a><br><font size ='1'>$logout_label<br></td>";
            echo "</td></tr></table>";
        }else{
        echo "<tr><br><br>";
        echo "<td align = 'center' width = '60' valign='top'><a href='index.php'>$refresh_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='addarticle.php'>$add_news_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='http://www.clevercopy.net' target = '_new'>$visit_home_site_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='adminhelp.php'>$help_label</a><br><br></td>";
        if  ($getadmin3['status']==2){
              echo "<td align = 'center' width = '60' valign='top'><a href='ban.php'>$ban_ip_label</a><br><br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='queryindex.php'>$network_query_label</a><br><br></td>";
              echo "<tr>";
              echo "<td align = 'center' width = '60' valign='top'><a href='../index.php'>$admin_browse_label</a><br><br></td>";
              echo "<td align = 'center' width = '60' valign='top'><a href='shout.php'>$shout_label</a><br><br></td>";
        }
        if  ($getadmin3['status']==3){
        echo "<td align = 'center' width = '60' valign='top'><a href='../index.php'>$admin_browse_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='ban.php'>$ban_ip_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editscroller.php'>$scroller_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='pruneentries.php'>$prune_label</a><br><br></td>";
        echo "<td  width = '60' align = 'center' valign='top'><a href='editprefs.php'>$site_preferences_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editadmn.php'>$edit_admins_label</a><br><br></td><br>";
        echo "<tr><td><br></td><tr></tr>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editbanners.php'>$banners_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editnewsletter.php'>$newsletter_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editshout.php'>$shout_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editrssfeed.php'>$meta_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editdownloads.php'>$downloads_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='blocks.php'>$blocks_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='logview.php?&ID=1&start=0'>$stats_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='queryindex.php'>$network_query_label</a><br><br></td>";
        $ctr = '0';
        $query2 =  ("SELECT * FROM CC_weblinksposted") or die($no_weblinks_error);
        $result2 = mysql_query($query2);
        while( $row2 = mysql_fetch_array($result2) )
        {
           $ctr++;
        }
        if (($ctr !=='0')|| ($not_foundctr !== '0'))
        {
           echo "<td align = 'center' width = '60' valign='top'><a href='editweblinks.php' style='text-decoration: none'><font color = 'red'>$weblinks_label</a></font><br><br></td>";
        }else{
           echo "<td align = 'center' width = '60' valign='top'><a href='editweblinks.php'>$weblinks_label</a><br><br></td>";
        }
        echo "<td align = 'center' width = '60' valign='top'><a href='editmenu.php'>$editmenu_label</a><br><br></td>";
        echo "<tr><td><br></td><tr></tr>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editticker.php'>$newsticker_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editprofile.php'>$editprofile_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editranquotes.php'>$ranquotes_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editgallery.php'>$gallery_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='info.php'target='new'>$phpinfo_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editcalendar.php'>$editcalendar_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='block_weighting.php'>$block_weighting_label</a><br><br></td>";
        $thisquery4 =  ("SELECT * FROM CC_vposted_news") or die($no_news_error);
        $thisresult4 = mysql_query($thisquery4);
        $newctr = '0';
        while($thisrow4 = mysql_fetch_array($thisresult4))
        {
           $newctr++;
        }
        if ($newctr !== '0')
        {
           echo "<td align = 'center' width = '60' valign='top'><a href='usersubmittednews.php' style='text-decoration: none'><font color = 'red'>$usernews_label</a><br></font><br></td>";
        }else{
           echo "<td align = 'center' width = '60' valign='top'><a href='usersubmittednews.php'>$usernews_label</a><br><br></td>";
        }
        echo "<td align = 'center' width = '60' valign='top'><a href='editwelcome.php'>$welcome_msg_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editsiteslogan.php'>$slogan_label</a><br><br></td>";
        echo "<tr><td><br></td><tr></tr>";
        echo "<td align = 'center' width = '60' valign='top'><a href='http://clevercopy.bestdirectbuy.com/forum/' target='_new'>$support_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editmembers.php?&ID=1&start=0'>$edit_users_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editpoll.php'>$edit_poll_label</a><br><br></td>";
        echo "<td align = 'center' width = '60' valign='top'><a href='editcategories.php'>$edit_categories_label</a><br><br></td>";
      }
      echo "<td><td><td><td align = 'center' width = '60' valign='top'><a href='bugreporting.php'>$bug_label</a><br><br></td>";
      $thisquery3 =  ("SELECT * FROM CC_ppcsubmitted") or die($no_ppc_error);
      $thisresult3 = mysql_query($thisquery3);
      $newppcctr = '0';
      while($thisrow = mysql_fetch_array($thisresult3))
      {
        if ($thisrow[validated] == '1'){
             $newppcctr++;
        }
      }
      $thisquery4 =  ("SELECT * FROM CC_ppc") or die($no_ppc_error);
      $thisresult4 = mysql_query($thisquery4);
      while($therow4 = mysql_fetch_array($thisresult4))
      {
       if ($therow4[invoice_paid] == '0'){
            $newppcctr++;
       }
      }
      if ($newppcctr !== '0')
      {
         echo "<td align = 'center' width = '60' valign='top'><a href='editppc.php' style='text-decoration: none'><font color = 'red'>$edit_ppc_label</a><br></font><br></td>";
      }else{
         echo "<td align = 'center' width = '60' valign='top'><a href='editppc.php'>$edit_ppc_label</a><br><br></td>";
      }
      echo "<td width = '60' align = 'center' valign='top'><a href='gone.php'>$logout_label</a><br><br></td>";
      echo "</td></tr></table>";
   }
 $getoptquery =  ("OPTIMIZE TABLE `CC_acronyms`,`CC_admin`,`CC_bannerhistory`,`CC_bannerprefs`,`CC_bannerusers`,`CC_banners`,`CC_block_names`,`CC_blocks`,`CC_calendar`,`CC_comments`,`CC_contact`,`CC_custom_blocks`,`CC_custom_centre_blocks`,`CC_downloads`,`CC_gallery`,`CC_guestb`,`CC_ipbans`,`CC_menu`,`CC_news`,`CC_newsletter`,`CC_newsletter_template`,`CC_newsletterarchive`,`CC_newslettersave`,`CC_online`,`CC_poll`,`CC_pollips`,`CC_pollresults`,`CC_ppc`,`CC_ppchistory`,`CC_ppcsubmitted`,`CC_prefs`,`CC_profile`,`CC_radio`,`CC_rssfeed`,`CC_scroller`,`CC_slogan`,`CC_sidebanners`,`CC_stats`,`CC_tag_shout`,`CC_ticker`,`CC_users`,`CC_vposted_news`,`CC_weblinks`,`CC_weblinksposted`,`CC_welcome`");
 $getoptresult = mysql_query($getoptquery);
 $error_msg .= mysql_error();
 if ($error_msg !== "")
 {
     echo "<br><b>There was an error optomising the database -   $error_msg</b><br>";
 }
}else{
  echo $not_logged_in_label;
  echo "</td></tr></table>";
}
?>