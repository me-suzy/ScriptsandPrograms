<?php
session_start();
include "../languages/default.php";
include "languages/default.php";
include "connect.inc";
echo "<head><title>$admin_preferences_title</title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
echo "</head>";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<br><br>";
echo "<body bgcolor=$getprefs3[block_background_color]>";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   echo "<tr><td>";
   if(isset($_POST['submit']))
   {
      if(strlen($_POST['title'])<1)
      {
         echo $no_title_given_error;
      }
      else
      {
          $title=$_POST['title'];
          $showmostonline=$_POST['showmostonline'];
          $mailcomments=$_POST['mailcomments'];
          $accept_links=$_POST['accept_links'];
          $include_main=$_POST['include_main'];
          $newsbackimage=$_POST['newsbackimage'];
          $showwelcome=$_POST['showwelcome'];
          $archive_newsletter=$_POST['archive_newsletter'];
          $cc_address=$_POST['cc_address'];
          $membercounton=$_POST['membercounton'];
          $showcounter=$_POST['showcounter'];
          $privacy=$_POST['privacy'];
          $cc_address= sesson($cc_address);
          $show_numrandom_headlines=$_POST['show_numrandom_headlines'];
          $shownumofnewsitems=$_POST['shownumofnewsitems'];
          $autoprune_ppcdays=$_POST['autoprune_ppcdays'];
          $linkex_text=$_POST['linkex_text'];
          $shownumofarchives=$_POST['shownumofarchives'];
          $archives=$_POST['archives'];
          $waittime=$_POST['waittime'];
          $prunestats=$_POST['prunestats'];
          $admingraphics=$_POST['admingraphics'];
          $showuptime=$_POST['show_uptime'];
          $showwelcome_message=$_POST['showwelcome_message'];
          $showseparator=$_POST['showseparator'];
          $separatorlinecolor=$_POST['separatorlinecolor'];
          $blockbordercolor=$_POST['blockbordercolor'];
          $block_heading_background_color=$_POST['block_heading_background_color'];
          $block_heading_font_face=$_POST['block_heading_font_face'];
          $block_heading_font_color=$_POST['block_heading_font_color'];
          $block_heading_font_size=$_POST['block_heading_font_size'];
          $block_background_color=$_POST['block_background_color'];
          $block_heading_font_decoration=$_POST['block_heading_font_decoration'];
          $block_heading_height=$_POST['block_heading_height'];
          $block_use_heading_graphic=$_POST['block_use_heading_graphic'];
          $link_fontface=$_POST['link_fontface'];
          $link_fontface_size=$_POST['link_fontface_size'];
          $linkfont_color=$_POST['linkfont_color'];
          $ranpicpath=$_POST['ranpicpath'];
          $sitepath=$_POST['sitepath'];
          $center_blockbordercolor=$_POST['center_blockbordercolor'];
          $center_block_backround_color=$_POST['center_block_backround_color'];
          $center_block_left_heading_backround_color=$_POST['center_block_left_heading_backround_color'];
          $center_block_right_heading_backround_color=$_POST['center_block_right_heading_backround_color'];
          $showrightblocks=$_POST['showrightblocks'];
          $useblockwrapper=$_POST['useblockwrapper'];
          $donation_email_address= $_POST['donation_email_address'];
          $donation_email_address= sesson($donation_email_address);
          $donation_image_path=$_POST['donation_image_path'];
          $donation_currency=$_POST['donation_currency'];
          $cpc_default_rate=$_POST['cpc_default_rate'];
          $cpc_default_rate= number_format($cpc_default_rate,2);
          $siteemail= $_POST['siteemail'];
          $siteemail= sesson($siteemail);
          $siteaddress=$_POST['siteaddress'];
          $mailnewsposter=$_POST['mailnewsposter'];
          $blips=$_POST['blips'];
          $dateset=$_POST['dateset'];
          $personality=$_POST['personality'];
          $time_offset=$_POST['time_offset'];
          $main_page_color=$_POST['main_page_color'];
          $main_page_table_border=$_POST['main_page_table_border'];
          $main_page_table_border_color=$_POST['main_page_table_border_color'];
          $main_page_width=$_POST['main_page_width'];
          $center_block_alt_backround_color=$_POST['center_block_alt_backround_color'];
          $showrss=$_POST['showrss'];
          $membersallowed=$_POST['membersallowed'];
          $showbanners=$_POST['showbanners'];
          $use_bottom_menu=$_POST['use_bottom_menu'];
          $userterms=$_POST['userterms'];
          $shownewsticker=$_POST['shownewsticker'];
          $exlink_delete_method=$_POST['exlink_delete_method'];
          $editprefs="update CC_prefs set mailcomments= '$mailcomments',showmostonline='$showmostonline',accept_links='$accept_links',include_main='$include_main',newsbackimage='$newsbackimage',privacy='$privacy',membercounton='$membercounton',showcounter='$showcounter',prunestats='$prunestats',sitepath='$sitepath',exlink_delete_method='$exlink_delete_method',linkex_text='$linkex_text',show_numrandom_headlines='$show_numrandom_headlines',autoprune_ppcdays='$autoprune_ppcdays',cpc_default_rate = '$cpc_default_rate',use_bottom_menu='$use_bottom_menu',showbanners='$showbanners',showrss='$showrss',userterms='$userterms',shownewsticker='$shownewsticker',showwelcome_message ='$showwelcome',membersallowed='$membersallowed',center_block_alt_backround_color='$center_block_alt_backround_color',waittime='$waittime',archive_newsletter= '$archive_newsletter',cc_address='$cc_address',main_page_width='$main_page_width',main_page_table_border_color='$main_page_table_border_color',main_page_table_border='$main_page_table_border',main_page_color='$main_page_color',time_offset = '$time_offset', dateset='$dateset',personality='$personality',blips='$blips',mailnewsposter='$mailnewsposter',siteaddress='$siteaddress',donation_currency='$donation_currency',donation_image_path='$donation_image_path',donation_email_address='$donation_email_address',useblockwrapper='$useblockwrapper',showrightblocks='$showrightblocks',title='$title', ranpicpath='$ranpicpath',center_block_right_heading_backround_color='$center_block_right_heading_backround_color', center_block_left_heading_backround_color = '$center_block_left_heading_backround_color', center_block_backround_color= '$center_block_backround_color', center_blockbordercolor ='$center_blockbordercolor',linkfont_color = '$linkfont_color', link_fontface_size = '$link_fontface_size', link_fontface = '$link_fontface', block_use_heading_graphic ='$block_use_heading_graphic', block_heading_height = '$block_heading_height', block_heading_font_decoration ='$block_heading_font_decoration', block_background_color='$block_background_color', block_heading_font_size='$block_heading_font_size', block_heading_font_color = '$block_heading_font_color', block_heading_font_face = '$block_heading_font_face', block_heading_background_color = '$block_heading_background_color', blockbordercolor = '$blockbordercolor', separatorlinecolor = '$separatorlinecolor',shownumofnewsitems='$shownumofnewsitems', admingraphics = '$admingraphics',shownumofarchives ='$shownumofarchives',siteemail='$siteemail', showuptime='$showuptime', showseparator= '$showseparator'";
          mysql_query($editprefs);
          $error_msg .= mysql_error();
          echo "<br><b>$error_msg<br></b>";
          echo "<br>$preferences_saved_label<br>";
          echo "<meta http-equiv='refresh' content='0;URL=editprefs.php'>";
      }
   }else{
      $getprefs="SELECT * from CC_prefs";
      $getprefs2=mysql_query($getprefs) or die($no_preferences_error);
      $getprefs3=mysql_fetch_array($getprefs2);
      echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
      echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='3'><left>";
      echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_site_label</font></b></center></td></tr>";
      echo "<tr><td width= '30%'>";
      echo "<b> $item_label</b>";
      echo "<td width= '50%'>";
      echo "<b> $current_settings_label</b>";
      echo "<td width= '20%'><b> $current_value_label</b>";
      echo "<tr><td width= '30%'>";
      echo "<form action='editprefs.php' method='post'>";
      echo " $your_site_title_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='title' size='40' value='$getprefs3[title]'>";
      echo "<td width = '20%'>n/a</td>";
      echo "<tr><td width= '30%'>";
      echo " $site_address_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='siteaddress' size='40' value='$getprefs3[siteaddress]'>";
      echo "<td width = '20%'>n/a</td>";
      echo "<tr><td width= '30%'>";
      echo " $sitepath_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='sitepath' size='60' value='$getprefs3[sitepath]'>";
      echo "<td width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $site_email_label";
      echo "<td valign='top' width= '50%'>";
      $decryptmail1 = registre ($getprefs3[siteemail]);
      echo "<input type='text' name='siteemail' size='40' value='$decryptmail1'>";
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$cc_address_email_label";
      $decryptmail2 = registre ($getprefs3[cc_address]);
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='cc_address' size='40' value='$decryptmail2'>";
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $cc_address_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$linkex_text_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='linkex_text' size='80' value='$getprefs3[linkex_text]'>";
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$exlink_delete_method_message_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='exlink_delete_method'>";
      if($getprefs3[exlink_delete_method]==1)
      {
          echo "<option value='1' style='color: #000000'>$automatic_del_label</option>";
          echo "<option value='0'>$manual_del_label</option>";
      }
      elseif($getprefs3[exlink_delete_method]==0)
      {
          echo "<option value='0'>$manual_del_label</option>";
          echo "<option value='1' style='color: #000000'>$automatic_del_label</option>";
      }
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $exlink_delete_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $prunestats_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='prunestats' size='5' value='$getprefs3[prunestats]'>";
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $prunestats_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$showmostonline_message_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='showmostonline'>";
      if($getprefs3[showmostonline]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[showmostonline]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";

      echo "<tr><td valign='top' width= '30%'>";
      echo "$membercounton_message_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='membercounton'>";
      if($getprefs3[membercounton]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[membercounton]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$showcounter_message_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='showcounter'>";
      if($getprefs3[showcounter]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[showcounter]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$showwelcome_message_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='showwelcome'>";
      if($getprefs3[showwelcome_message]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[showwelcome_message]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$shownewsticker_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='shownewsticker'>";
      if($getprefs3[shownewsticker]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[shownewsticker]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$use_bottom_menu_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='use_bottom_menu'>";
      if($getprefs3[use_bottom_menu]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[use_bottom_menu]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$archive_newsletter_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='archive_newsletter'>";
      if($getprefs3[archive_newsletter]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[archive_newsletter]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $auto_archive_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $waittime_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='waittime' size='3' value='$getprefs3[waittime]'>";
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $waittime_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $donation_email_label";
      $decryptmail3 = registre($getprefs3[donation_email_address]);
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='donation_email_address' size='40' value='$decryptmail3'>";
      echo "<td valign='top' width = '20%' ><img src ='../images/information.gif'>   $donation_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $accept_currency_in_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='donation_currency'>";
      if($getprefs3[donation_currency]=="USD")
      {
          echo "<option value='USD'>US Dollars</option>";
          echo "<option value='GBP'>GB Pounds</option>";
          echo "<option value='EUR'>Euros</option>";
          echo "<option value='CAD'>Canada Dollars</option>";
          echo "<option value='JPY'>Jpn Yen</option>";
      }
      elseif($getprefs3[donation_currency]=="GBP")
      {
          echo "<option value='GBP'>GB Pounds</option>";
          echo "<option value='USD'>US Dollars</option>";
          echo "<option value='EUR'>Euros</option>";
          echo "<option value='CAD'>Canada Dollars</option>";
          echo "<option value='JPY'>Jpn Yen</option>";
      }
      elseif($getprefs3[donation_currency]=="EUR")
      {
          echo "<option value='EUR'>Euros</option>";
          echo "<option value='GBP'>GB Pounds</option>";
          echo "<option value='USD'>US Dollars</option>";
          echo "<option value='CAD'>Canada Dollars</option>";
          echo "<option value='JPY'>Jpn Yen</option>";
      }
      elseif($getprefs3[donation_currency]=="CAD")
      {
          echo "<option value='CAD'>Canada Dollars</option>";
          echo "<option value='EUR'>Euros</option>";
          echo "<option value='GBP'>GB Pounds</option>";
          echo "<option value='USD'>US Dollars</option>";
          echo "<option value='JPY'>Jpn Yen</option>";
      }
      elseif($getprefs3[donation_currency]=="JPY")
      {
          echo "<option value='JPY'>Jpn Yen</option>";
          echo "<option value='CAD'>Canada Dollars</option>";
          echo "<option value='EUR'>Euros</option>";
          echo "<option value='GBP'>GB Pounds</option>";
          echo "<option value='USD'>US Dollars</option>";
      }
      echo "<td valign='top' width = '20%'>n/a </td>";

      echo "<tr><td valign='top' width= '30%'>";
      echo "$pay_per_click_invoice_history_prune_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='autoprune_ppcdays' size='3' value='$getprefs3[autoprune_ppcdays]'>";
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $ppc_archive_info_label";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $pay_per_click_default_rate_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='cpc_default_rate' size='3' value='$getprefs3[cpc_default_rate]'>";
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $ppc_default_info_label";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $donation_image_path_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='donation_image_path' size='80' value='$getprefs3[donation_image_path]'>";
      echo "<td valign='top' width = '20%'>n/a";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$showbanners_set_to_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='showbanners'>";
      if($getprefs3[showbanners]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[showbanners]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $path_to_ran_pics_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='ranpicpath' size='80' value='$getprefs3[ranpicpath]'>";
      echo "<td valign='top' width = '20%'valign='top'><img src ='../images/information.gif'>   $random_pic_path_info_label</td>";

      echo "<tr><td valign='top' width= '30%'>";
      echo $are_members_allowed_label;
      echo "<td valign='top' width= '50%'>";
      echo "<select name='membersallowed'>";
      if($getprefs3[membersallowed]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[membersallowed]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $membersallowed_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo $accept_links_label;
      echo "<td valign='top' width= '50%'>";
      echo "<select name='accept_links'>";
      if($getprefs3[accept_links]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }
      elseif($getprefs3[accept_links]==0)
      {
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top' width = '20%'><img src ='../images/information.gif'>   $accept_links_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$privacy_label";
      echo "<td valign='top' width= '50%'>";
      echo "<textarea rows='7' name='privacy' cols='80'>$getprefs3[privacy]</textarea>";
      echo "<td valign='top' width = '20%'valign='top'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$user_terms_label";
      echo "<td valign='top' width= '50%'>";
      echo "<textarea rows='7' name='userterms' cols='80'>$getprefs3[userterms]</textarea>";
      echo "<td valign='top' width = '20%'valign='top'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $date_time_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='dateset'>";
      if($getprefs3[dateset]==1)
      {
          echo "<option value='1'>$eur_time_label</option>";
          echo "<option value='0'>$us_time_label</option>";
      }
      elseif($getprefs3[dateset]==0)
      {
          echo "<option value='0'>$us_time_label</option>";
          echo "<option value='1'>$eur_time_label</option>";
      }
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo "$server_time_offset_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='time_offset' size='3' value='$getprefs3[time_offset]'>";
      echo "<td valign='top' width = '20%'valign='top'><img src ='../images/information.gif'>   $time_offset_info_label</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $personality_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='personality'>";
      if($getprefs3[personality]=="personalities/summer.css")
      {
          echo "<option value='personalities/summer.css'>$summer_label</option>";
          echo "<option value='personalities/autumn.css'>$autumn_label</option>";
          echo "<option value='personalities/winter.css'>$winter_label</option>";
          echo "<option value='personalities/spring.css'>$spring_label</option>";
          echo "<option value='personalities/sunrise.css'>$sunrise_label</option>";
          echo "<option value='personalities/cc.css'>$default_personality_label</option>";
      }
      elseif($getprefs3[personality]=="personalities/cc.css")
      {
          echo "<option value='personalities/cc.css'>$default_personality_label</option>";
          echo "<option value='personalities/autumn.css'>$autumn_label</option>";
          echo "<option value='personalities/winter.css'>$winter_label</option>";
          echo "<option value='personalities/spring.css'>$spring_label</option>";
          echo "<option value='personalities/sunrise.css'>$sunrise_label</option>";
          echo "<option value='personalities/summer.css'>$summer_label</option>";
      }
      elseif($getprefs3[personality]=="personalities/autumn.css")
      {
          echo "<option value='personalities/autumn.css'>$autumn_label</option>";
          echo "<option value='personalities/winter.css'>$winter_label</option>";
          echo "<option value='personalities/spring.css'>$spring_label</option>";
          echo "<option value='personalities/sunrise.css'>$sunrise_label</option>";
          echo "<option value='personalities/summer.css'>$summer_label</option>";
          echo "<option value='personalities/cc.css'>$default_personality_label</option>";
      }
      elseif($getprefs3[personality]=="personalities/winter.css")
      {
          echo "<option value='personalities/winter.css'>$winter_label</option>";
          echo "<option value='personalities/autumn.css'>$autumn_label</option>";
          echo "<option value='personalities/spring.css'>$spring_label</option>";
          echo "<option value='personalities/sunrise.css'>$sunrise_label</option>";
          echo "<option value='personalities/summer.css'>$summer_label</option>";
          echo "<option value='personalities/cc.css'>$default_personality_label</option>";
      }
      elseif($getprefs3[personality]=="personalities/spring.css")
      {
          echo "<option value='personalities/spring.css'>$spring_label</option>";
          echo "<option value='personalities/sunrise.css'>$sunrise_label</option>";
          echo "<option value='personalities/winter.css'>$winter_label</option>";
          echo "<option value='personalities/autumn.css'>$autumn_label</option>";
          echo "<option value='personalities/summer.css'>$summer_label</option>";
          echo "<option value='personalities/cc.css'>$default_personality_label</option>";
      }
            elseif($getprefs3[personality]=="personalities/sunrise.css")
      {
          echo "<option value='personalities/sunrise.css'>$sunrise_label</option>";
          echo "<option value='personalities/spring.css'>$spring_label</option>";
          echo "<option value='personalities/winter.css'>$winter_label</option>";
          echo "<option value='personalities/autumn.css'>$autumn_label</option>";
          echo "<option value='personalities/summer.css'>$summer_label</option>";
          echo "<option value='personalities/cc.css'>$default_personality_label</option>";
      }
      echo "<td valign='top' width = '20%'><img src = '../images/information.gif'> $personality_info_label </td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $main_page_color_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='main_page_color' size='10' value='$getprefs3[main_page_color]'>";
      echo "<td valign='top' width = '20%'><img src = '../images/information.gif'> $main_page_color_info_label </td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $main_page_table_border_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='main_page_table_border' size='10' value='$getprefs3[main_page_table_border]'>";
      echo "<td valign='top' width = '20%'><img src = '../images/information.gif'> $main_page_table_border_info_label </td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $main_page_table_border_color_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='main_page_table_border_color' size='10' value='$getprefs3[main_page_table_border_color]'>";
      echo "<td valign='top' width = '20%'><hr color= $getprefs3[main_page_table_border_color]></td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $main_page_width_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='main_page_width' size='3' value='$getprefs3[main_page_width]'>";
      echo "<td valign='top' width = '20%'><img src = '../images/information.gif'> $main_page_width_info_label </td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $how_many_news_items_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='shownumofnewsitems' size='3' value='$getprefs3[shownumofnewsitems]'>";
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $shownumofarchives_items_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='shownumofarchives' size='3' value='$getprefs3[shownumofarchives]'>";
      echo "<td valign='top' width = '20%'>n/a</td>";
      echo "<tr><td valign='top' width= '30%'>";
      echo " $shownumofranheadlines_items_label";
      echo "<td valign='top' width= '50%'>";
      echo "<input type='text' name='show_numrandom_headlines' size='3' value='$getprefs3[show_numrandom_headlines]'>";
      echo "<td valign='top' width = '20%'>n/a</td>";


      echo "<tr><td valign='top' width= '30%'>";
      echo " $mailcomments_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='mailcomments'>";
      if($getprefs3[mailcomments]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'>n/a";



      echo "<tr><td valign='top' width= '30%'>";
      echo " $mailnewsposter_label";
      echo "<td valign='top' width= '50%'>";
      echo "<select name='mailnewsposter'>";
      if($getprefs3[mailnewsposter]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'>n/a";
      echo "<tr><td valign='top'width= '30%'>";
      echo " $showrightblocks_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='showrightblocks'>";
      if($getprefs3[showrightblocks]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'><img src ='../images/information.gif'>   $right_blocks_info_label</td>";
      echo "<tr><td valign='top'width= '30%'>";
      echo " $useblockwrapper_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='useblockwrapper'>";
      if($getprefs3[useblockwrapper]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'><img src ='../images/information.gif'>  $right_blocks_nowrapper_info_label</td>";
      echo "<tr><td valign='top'width= '30%'>";
      echo "$side_block_separator_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='showseparator'>";
      if($getprefs3[showseparator]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'>n/a";
      echo "<tr><td width= '30%'>";
      echo "$separator_line_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='separatorlinecolor' size='10' value='$getprefs3[separatorlinecolor]'>";
      echo "<td width = '20%'><hr color= $getprefs3[separatorlinecolor]>";
      echo "<tr><td width= '30%'>";
      echo " $side_block_border_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='blockbordercolor' size='10' value='$getprefs3[blockbordercolor]'>";
      echo "<td width = '20%'><hr color= $getprefs3[blockbordercolor]>";
      echo "<tr><td width= '30%'>";
      echo "$side_block_heading_back_color";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_heading_background_color' size='10' value='$getprefs3[block_heading_background_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[block_heading_background_color]><tr><td width='100%'>&nbsp;</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$side_block_graphic_header_label";
      echo "<td width= '50%'>";
      echo "<select name='block_use_heading_graphic'>";
      if($getprefs3[block_use_heading_graphic]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      if($getprefs3[block_use_heading_graphic]==1)
      {
        echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='176' bgcolor= $getprefs3[block_heading_background_color]><tr><td width='100%' height=$getprefs3[block_heading_height] background='../bkgd.gif'>&nbsp;</td></tr></table>";
      }else{
           echo "<td width = '20%'></td>";
      }
      echo "<tr><td width= '30%'>";
      echo "$side_block_heading_height_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_heading_height' size='2' value='$getprefs3[block_heading_height]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[block_heading_background_color]><tr><td width='100%'height=$getprefs3[block_heading_height]>&nbsp;</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$side_block_background_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_background_color' size='10' value='$getprefs3[block_background_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[block_background_color]><tr><td width='100%'>&nbsp;</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$all_blocks_heading_font_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_heading_font_face' size='10' value='$getprefs3[block_heading_font_face]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor=$getprefs3[blockbordercolor] width='120' > <tr bgcolor=$getprefs3[block_heading_background_color]><td width='100%'><font face=$getprefs3[block_heading_font_face]>$heading_label</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$all_blocks_heading_font_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_heading_font_color' size='10' value='$getprefs3[block_heading_font_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor=$getprefs3[blockbordercolor] width='120' > <tr bgcolor=$getprefs3[block_heading_background_color]><td width='100%'><font face=$getprefs3[block_heading_font_face] color =$getprefs3[block_heading_font_color] >$heading_label</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$all_blocks_heading_font_size_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_heading_font_size' size='2' value='$getprefs3[block_heading_font_size]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor=$getprefs3[blockbordercolor] width='120' > <tr bgcolor=$getprefs3[block_heading_background_color]><td width='100%'><font face=$getprefs3[block_heading_font_face] color =$getprefs3[block_heading_font_color] size =$getprefs3[block_heading_font_size] >$heading_label</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$all_blocks_heading_decoration_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='block_heading_font_decoration' size='2' value='$getprefs3[block_heading_font_decoration]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor=$getprefs3[blockbordercolor] width='120' > <tr bgcolor=$getprefs3[block_heading_background_color]><td width='100%'><font face=$getprefs3[block_heading_font_face] color =$getprefs3[block_heading_font_color] size =$getprefs3[block_heading_font_size] ><$getprefs3[block_heading_font_decoration]>$heading_label</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$center_block_border_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='center_blockbordercolor' size='10' value='$getprefs3[center_blockbordercolor]'>";
      echo "<td width = '20%'><hr color= $getprefs3[center_blockbordercolor]>";
      echo "<tr><td width= '30%'>";
      echo "$center_block_background_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='center_block_backround_color' size='10' value='$getprefs3[center_block_backround_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[center_block_backround_color]><tr><td width='100%'>&nbsp;</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$center_block_alt_backround_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='center_block_alt_backround_color' size='10' value='$getprefs3[center_block_alt_backround_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[center_block_alt_backround_color]><tr><td width='100%'>&nbsp;</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$center_block_left_heading_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='center_block_left_heading_backround_color' size='10' value='$getprefs3[center_block_left_heading_backround_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[center_block_left_heading_backround_color]><tr><td width='100%'>&nbsp;</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$center_block_right_heading_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='center_block_right_heading_backround_color' size='10' value='$getprefs3[center_block_right_heading_backround_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[center_block_right_heading_backround_color]><tr><td width='100%'>&nbsp;</td></tr></table>";
      echo "<tr><td valign='top'width= '30%'>";
      echo "$newsbackimage_set_to_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='newsbackimage'>";
      if($getprefs3[newsbackimage]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'><img src = '../images/information.gif'>  $newsbackimage_info_label</td>";
      echo "<tr><td width= '30%'>";
      echo "$hyperlink_font_face_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='link_fontface' size='10' value='$getprefs3[link_fontface]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[block_background_color]><tr><td width='100%'><font face=$getprefs3[link_fontface]>$link_label</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$hyperlink_font_size_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='link_fontface_size' size='2' value='$getprefs3[link_fontface_size]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[block_background_color]><tr><td width='100%'><font face=$getprefs3[link_fontface] size = $getprefs3[link_fontface_size]>$link_label</td></tr></table>";
      echo "<tr><td width= '30%'>";
      echo "$hyperlink_font_color_label";
      echo "<td width= '50%'>";
      echo "<input type='text' name='linkfont_color' size='10' value='$getprefs3[linkfont_color]'>";
      echo "<td width = '20%'><table border='1' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='120' bgcolor= $getprefs3[block_background_color]><tr><td width='100%'><font face=$getprefs3[link_fontface] size = $getprefs3[link_fontface_size]><font color = $getprefs3[linkfont_color]>$link_label</td></tr></table>";
      echo "<tr><td valign='top'width= '30%'>";
      echo "$blips_set_to_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='blips'>";
      if($getprefs3[blips]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'><img src = '../images/information.gif'>  $blips_info_label</td>";
      echo "<tr><td valign='top'width= '30%'>";
      echo "$showrss_set_to_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='showrss'>";
      if($getprefs3[showrss]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'><img src = '../images/information.gif'>  $showrss_info_label</td>";
      echo "<tr><td valign='top'width= '30%'>";
      echo "$include_main_set_to_label";
      echo "<td valign='top'width= '50%'>";
      echo "<select name='include_main'>";
      if($getprefs3[include_main]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td valign='top'width = '20%'><img src = '../images/information.gif'>  $include_main_info_label</td>";
      echo "<tr><td width= '30%'>";
      echo " $server_uptime_set_to_label";
      echo "<td width= '50%'>";
      echo "<select name='show_uptime'>";
      if($getprefs3[showuptime]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td width = '20%'>&nbsp;</td>";
      echo "<tr><td width= '30%'>";
      echo " $use_graphics_in_admin_set_label";
      echo "<td width= '50%'>";
      echo "<select name='admingraphics'>";
      if($getprefs3[admingraphics]==1)
      {
          echo "<option value='1'>$on_label</option>";
          echo "<option value='0' style='color: #000000'>$off_label</option>";
      }else{
          echo "<option value='0' style='color: #000000'>$off_label</option>";
          echo "<option value='1'>$on_label</option>";
      }
      echo "<td width = '20%'>&nbsp;</td>";
      echo "<tr><td width= '30%'>&nbsp;";
      echo " $save_changes_label";
      echo "<td width= '50%'><br>";
      echo "<input type='submit' name='submit' value='Save' class = 'buttons'></form>";
      echo "</tr></table>";
   }
   echo "</td></tr></table>";
}else{
  echo $not_logged_in_label;
  include "index.php";
}
?>