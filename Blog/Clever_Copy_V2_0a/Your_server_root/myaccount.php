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
   echo "<table border='0'>";
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
   if(isset($_POST['submit']))
   {
   $user_site_name=antihax($_POST['user_site_name']);
   $user_email_address=antihax($_POST['user_email_address']);
   $user_email_address = sesson($user_email_address);
   $username=antihax($_POST['username']);
   $aim=antihax($_POST['aim']);
   $yim=antihax($_POST['yim']);
   $msn=antihax($_POST['msn']);
   $icq=antihax($_POST['icq']);
   $rcvpmnote=antihax($_POST['rcvpmnote']);
   $location=antihax($_POST['location']);
   $sig=antihax($_POST['sig']);
   $website=antihax($_POST['website']);
   $website= "http://$website";
   $gender=antihax($_POST['gender']);
   if ($getuser3[username] !== $username){
       session_unregister('cuser');
       $edituser="update CC_users set user_site_name='$user_site_name', user_email_address='$user_email_address',username='$username' WHERE username='$cuser'";
       mysql_query($edituser) or die($unable_to_save_preferences_error);
       echo "<br><br><b><center>$login_changed_info_label</b>";
       echo "<br><br><center><b>$your_new_login_label $username</b>";
   }else{
   $edituser="update CC_users set rcvpmnote='$rcvpmnote',website = '$website',gender='$gender',sig='$sig',location='$location',icq='$icq',msn='$msn',yim='$yim',aim = '$aim',user_site_name='$user_site_name', user_email_address='$user_email_address',username='$username' WHERE username='$cuser'";   mysql_query($edituser) or die($unable_to_save_preferences_error);
   mysql_query($edituser) or die($unable_to_save_preferences_error);
   echo "<table><tr><td>$preferences_saved_label";
   echo "<meta http-equiv='refresh' content='0;URL=myaccount.php'>";
   echo "<p align = 'center'>$if_you_see_label <A href='myaccount.php'> $click_here_label</a></p>";
   }
 }
 else
   {
   $getnl="SELECT * from CC_newslettersave";
   $getnl2=mysql_query($getnl) or die($no_preferences_error);
   $getnl3=mysql_fetch_array($getnl2);
   $getuser="SELECT * from CC_users where username='$cuser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   echo "<table border='0' cellspacing='3' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]' width = '100%'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='5'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$myaccount_label</font></b></center></td></tr>";
   echo "<tr><td colspan = '5' valign = 'top'>$profile_exp_label";
   echo "<tr><td width= '25%'valign = 'top'><br><br>";
   echo "<b>$item_label</b>";
   echo "<td width= '75%'colspan = '4'valign = 'top'><br><br>";
   echo "<b>$current_settings_label</b>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "<form action='myaccount.php' method='post'>";
   echo $my_user_name_label;
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60' name='username' value = '$getuser3[username]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo $my_mail_label;
   echo "<td width= '75%'colspan = '4'valign = 'top'>";
   $themailad = registre($getuser3[user_email_address]);
   echo "<input type='text' size = '60'name='user_email_address'  value='$themailad'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo $my_known_as_label;
   echo "<td width= '75%'colspan = '4'valign = 'top'>";
   echo "<input type='text' size = '60'name='user_site_name' value='$getuser3[user_site_name]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo $profile_website_label;
   echo "<td width= '75%'colspan = '4'valign = 'top'>";
   echo "<input type='text' size = '60'name='website' value='$getuser3[website]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "<img src = 'images/yim.gif'> YIM";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60'name='yim'  value='$getuser3[yim]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "<img src = 'images/aim.gif'> AIM";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60'name='aim'  value='$getuser3[aim]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "<img src = 'images/msn.gif'> MSN";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60'name='msn'  value='$getuser3[msn]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "<img src = 'images/icq.gif'> ICQ";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60'name='icq'  value='$getuser3[icq]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "$my_quote_label";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60'name='sig'  value='$getuser3[sig]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "$location_label";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<input type='text' size = '60'name='location'  value='$getuser3[location]'>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "$mygender_label";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<select name='gender'>";
   if($getuser3[gender]==1)
   {
          echo "<option value='1'>$male_label</option>";
          echo "<option value='2'>$female_label</option>";
          echo "<option value='0'>$gender_not_given_label</option>";
   }
   elseif($getuser3[gender]==0)
   {
          echo "<option value='0'>$gender_not_given_label</option>";
          echo "<option value='1'>$male_label</option>";
          echo "<option value='2'>$female_label</option>";
   }
   elseif($getuser3[gender]==2)
   {
          echo "<option value='2'>$female_label</option>";
          echo "<option value='0'>$gender_not_given_label</option>";
          echo "<option value='1'>$male_label</option>";
   }
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "$notifypm_label";
   echo "<td width= '75%' valign = 'top' colspan = '4'>";
   echo "<select name='rcvpmnote'>";
   if($getuser3[rcvpmnote]==1)
   {
          echo "<option value='1'>$yes_label</option>";
          echo "<option value='0'>$no_label</option>";
   }elseif($getuser3[rcvpmnote]==0)
   {
          echo "<option value='0'>$no_label</option>";
          echo "<option value='1'>$yes_label</option>";
   }
   echo "</select><br>";
   echo "<tr><td colspan = '4'><hr>";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo $my_gets_newsletter_label;
   $query="SELECT mail_address from CC_newsletter";
   $result = mysql_query($query);
   $found = $no_label;
   while($row = mysql_fetch_array($result))
   {
       if ($getuser3[user_email_address]== $row[mail_address])
       {
            $found = $yes_label;
       }
   }
   echo "<td width= '5%'valign = 'top'>";
   echo $found;
   echo "<td width= '70%'valign = 'top' colspan = '3'><img src = 'images/information.gif'> $advise_newsletter_info_label";
   echo "<tr><td width= '25%'valign = 'top'>";
   echo "<td width= '75%'colspan = '4'valign = 'top'>";
   echo "<br><left><input type='submit'name='submit' value='$save_button_label' class = 'buttons'></form><br>";
   echo "<tr><td colspan = '5' valign = 'top'><hr color=$getprefs3[separatorlinecolor] size = '1'>";
   echo "<tr><td width = '25%'><center><form method='post' action='sendpm.php'><input type='submit' value='$sendpm_button_label' class = 'buttons'></form>";
   echo "<td width = '25%'><center><form method='post' action='myaccount.php?op=pass'><input type='submit' value='$edit_pass_button_label' class = 'buttons'></form>";
   echo "<td width = '25%'><center><form method='post' action='myjournal.php'><input type='submit'  value='$edit_journal_button_label'class = 'buttons'></form>";
   echo "<td width = '25%'><center><form method='post' action='admin/gone.php'><input type='submit' value='$logout_button_label' class = 'buttons'></form>";
 }

 switch( $_GET[ "op" ] )
 {
  case "pass":
  $cuser=$_SESSION['cuser'];
  if(isset($_POST['passsubmit']))
  {
   $getuser="SELECT * from CC_users where username='$cuser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);

   $getuser3=mysql_fetch_array($getuser2);
   $password=antihax($_POST['password']);
   $password2=antihax($_POST['password2']);
   $currentpassword=antihax($_POST['currentpassword']);
   if (($password == "")||($password2 == "") ||($currentpassword == ""))
   {
    $error_msg .= "<p>$missing_post_data_error</p>";
    echo "<br><b>$error_msg</b>";
    echo "<meta http-equiv='refresh' content='2;URL=myaccount.php?op=pass'>";
    exit;
   }
   $currentpassword=md5($currentpassword);
   if ($currentpassword !== $getuser3[password])
   {
    echo "<br><b>$current_passwords_no_match_error_label</b>";
    echo "<meta http-equiv='refresh' content='2;URL=myaccount.php?op=pass'>";
    exit;
   }
   if ($password2 !== $password)
   {
    echo "<br><b>$passwords_no_match_error_label</b>";
    echo "<meta http-equiv='refresh' content='2;URL=myaccount.php?op=pass'>";
    exit;
   }
   if (strlen($password)<8)
   {
    echo "<br><b>$pass_too_short_error</b>";
    echo "<meta http-equiv='refresh' content='2;URL=myaccount.php?op=pass'>";
    exit;
   }
   $password=md5($password);
   $password2=md5($password2);
   $edituser="update CC_users set password='$password' WHERE username='$cuser'";
   mysql_query($edituser) or die($unable_to_save_preferences_error);
   echo "<br><hr><b>$preferences_saved_label</b>";
   echo "<br><br><b>$new_password_is_label - $_POST[password]</b>";
   echo "<meta http-equiv='refresh' content='2;URL=myaccount.php'>";
 }
 else
 {
   echo "<hr><b><br><br>$change_my_password_heading_label<br></b>";
   echo "<form action='myaccount.php?op=pass' method='post'>";
   echo "<br><br>$existing_password_label<br>";
   echo "<input type='password' name='currentpassword' size='38'>";
   echo "<br><br>$new_password_label<br>";
   echo "<input type='password' name='password' size='38'>";
   echo "<br><br>$new_password_retype_label<br>";
   echo "<input type='password' name='password2' size='38'>";
   echo "<br><br><input type='submit'name='passsubmit' value='$change_pass_button_label' class = 'buttons'></form>";
 }
 break;
 }
 echo "</td></tr></table>";
 echo "</center></td>";
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