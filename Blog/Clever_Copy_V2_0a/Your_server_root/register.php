<?php
session_start();
include "admin/connect.inc";
include "languages/default.php";
include "admin/languages/default.php";
include "banned.php";
include "antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getblocks="SELECT * from CC_block_names";
$getblocks2=mysql_query($getblocks) or die($no_blocks_error);
$getblocks3=mysql_fetch_array($getblocks2);
$style = $getprefs3[personality];
?>
<head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
<script language="JavaScript">
<!-- Begin
function getthis(page) {
OpenWin = this.open(page, "window", "height=130,width=320,toolbar=no,menubar=no,location=no,scrollbars=no,resizable=no");
}
// End -->
</script>
<?php
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
                  include "$theblock";
                  echo "<br>";
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
if ($getprefs3[membersallowed] == '1')
{
  if (isset($_SESSION['cuser'])){
    echo "<img src=images/seperator.gif border='0' width='10' height='1'>";
    echo "<td valign='top' ><center>";
    if($getprefs3[showseparator]==1){echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
    echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height] colspan = '3'>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;<b>$register_new_user_label</b></font></b></center></td></tr>";
    echo "<tr><td colspan = '3'><br><p align = 'justify'>$getprefs3[userterms]<br><hr><br>";
    echo "<br><center><b>$already_registered_label</center></b><br><br>";
  }else{
    echo "<img src=images/seperator.gif border='0' width='10' height='1'>";
    echo "<td valign='top' ><center>";
    if($getprefs3[showseparator]==1){echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
    echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height] colspan = '3'>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;<b>$register_new_user_label</b></font></b></center></td></tr>";
    echo "<tr><td colspan = '3'><br><p align = 'justify'>$getprefs3[userterms]<br><hr><br>";
    echo "<form action='register.php?op=register_new' method='post'>";
    echo "<tr><td width = '25%' valign = 'top'>$new_realname_label";
    echo "<td width = '75%' valign = 'top'><input type='text' name='user_site_name' size='50'><br><br>";
    echo "<tr><td width = '25%' valign = 'top'>$new_user_aemail_label";
    echo "<td width = '75%' valign = 'top'><input type='text' name='user_email_address' size='50'><br><br>";
    echo "<tr><td colspan = '2' valign = 'top'><hr>$supply_login_details_label<br><br>";
    echo "<tr><td width = '25%' valign = 'top'>$new_username_label<font color = 'red'>*</font>";
    echo "<td width = '75%' valign = 'top'><input type='text' name='username' size='50'><br><br>";
    echo "<tr><td width = '25%' valign = 'top'>$new_password_label";
    echo "<td width = '75%' valign = 'top'><input type='password' name='password' size=50'><br><br>";
    echo "<tr><td width = '25%' valign = 'top'>$new_password_retype_label";
    echo "<td width = '75%' valign = 'top'><input type='password' name='password2' size='50'><br><br>";
    echo "<tr><td width = '25%' valign = 'top'>$new_receive_newsletter_label";
    echo "<td width = '75%' valign = 'top'><input type='checkbox' name='receivenews' value='ON'class = 'checkbox' checked><br><br>";
    echo "<input type='submit' name='submit' value='$join_button_label'class = 'buttons'>";
    echo "</form></center>";
    echo "<tr><td><td>";
    echo "<font color = 'red'>*</font> $you_might_check_name_label <tr><td>";
    echo "<td><form><input type=button onClick='getthis(\"namecheck.php\")' class = 'buttons' value='$namecheck_button_label'></form><br><br>";
    echo "<tr><td colspan = '2'>";
  }
}else{
    echo "<img src=images/seperator.gif border='0' width='10' height='1'>";
    echo "<br><br><td valign='top' ><center>";
    if($getprefs3[showseparator]==1){echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";}
    echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height] colspan = '3'>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;<b>$register_new_user_label</b></font></b></center></td></tr>";
    echo "<tr><td colspan = '3'><br><p align = 'justify'>$getprefs3[userterms]<br><hr><br>";
    echo "<br><center><b>$no_new_members_allowed_label</center></b><br><br>";
}
switch($_GET[ "op" ])
{

 case "register_new":
 include "admin/languages/default.php";
 include "languages/default.php";
 include "admin/connect.inc";
 $user_email_address=antihax($_POST["user_email_address"]);
 $user_site_name=antihax($_POST["user_site_name"]);
 $username=antihax($_POST["username"]);
 $status="8";
 $receivenews = antihax($_POST["receivenews"]);
 $usercheck = antihax($_POST["user_email_address"]);
 $usercheck = md5($usercheck);
 $password=antihax($_POST["password"]);
 $password2=antihax($_POST["password2"]);
 if (($password == "")||($username == "") || ($password2 == "") || ($user_email_address == ""))
 {
   $error_msg .= "<p>$missing_post_data_error</p>";
   echo "<b>$error_msg</b>";
   exit;
 }
 if ($password2 !== $password)
 {
   echo $passwords_no_match_error_label;
   exit;
 }
 if (strlen($password)<8)
 {
   echo $pass_too_short_error;
   exit;
 }
 $password=md5($password);
 $password2=md5($password2);
 $query =  ("SELECT * FROM CC_users") or die ($no_login_error);
 $result = mysql_query($query);
 $nameinuse = "false";
 $mailinuse = "false";
 while($row = mysql_fetch_array( $result ))
 {
        $tempuname = $row[username];
        $tempmail = registre($row[user_email_address]);
        if ($username ==  $tempuname)
        {
           $nameinuse = "true";
        }
        if ($user_email_address ==  $tempmail)
        {
           $mailinuse = "true";
        }
 }
 if (($nameinuse == "false") && ($mailinuse == "false"))
 {
    $user_email_address = sesson($user_email_address);
    $dandt = mktime();
    @mysql_query( "INSERT INTO CC_users(joined,usercheck,user_site_name,user_email_address, username, status, password ) VALUES('$dandt','$usercheck','$user_site_name','$user_email_address','$username', '$status', '$password')" );
    $error_msg .= mysql_error();

    if ($receivenews =='ON')
    {
          $query =  ("SELECT * FROM CC_newsletter") or die ($no_mail_found_error);
          $result = mysql_query($query);
          $mailinuse = "false";
          $tempmail = "";
          while($row = mysql_fetch_array($result))
                 {
                 $tempmail = $row[mail_address];
                 if ($user_email_address == $tempmail)
                 {
                      $mailinuse = "true";
                      $in_newsletter = $already_newsletter_member_label;
                 }
          }
          if ($mailinuse == "false")
          {
              $time = time();
              $thehit=getenv ("REMOTE_ADDR");
              @mysql_query( "INSERT INTO CC_newsletter( time,mail_address, IP) VALUES('$time','$user_email_address','$thehit')" );
              $error_msg .= mysql_error();
              $in_newsletter = $new_user_added_newsletter_label;
          }
    }
 }
 else
     {
     $error_msg .= $that_name_taken_error_label;
     echo "<b>$error_msg</b><br>";
     exit;
 }
 if($error_msg == "")
 {
     $error_msg = "<p><center><b>$new_user_successfully_added_label</b></p><br>";
     echo $error_msg;
     echo "<p><center><b>$in_newsletter</b></p><br>";
     echo "<form name='theform' method='post' action='cntctnewmember.php'>";
     echo "<input type='hidden' name='username' value = $username><br>";
     echo "<input type='hidden' name='usercheck' value = $usercheck><br>";
     echo "<input type='hidden' name='password' value = $_POST[password]>";
     echo "<input type='hidden' name='user_site_name'value='$user_site_name'>";
     echo "<input type='hidden' name='email'value='$user_email_address'>";
     $user_email_address=registre($user_email_address);
     echo "<input type='hidden' name='destination_email' value='$user_email_address'>";
     echo "<input type='hidden' name='sendurl' value='register.php'>";
     echo "<input type='hidden' name='welcome_email_label' value='$welcome_member_email_label'>";
     echo "<input type='hidden' name='welcome_email_label_cont' value='$welcome_new_member_email_confirm_cont_label $getprefs3[siteaddress]/register.php?op=confirm&value=$usercheck&mail=$user_email_address'>";
     echo "<input type='hidden' name='new_member_email_subject' value='$new_member_email_subject'>";
     echo "<input type='submit' name='submit' value='$continue_button_label' class = 'buttons'>";
     echo "</form>";
 }
 break;

 case "confirm":
 $value = $_GET[value];
 $mailcheck = antihax($_GET[mail]);
 $mailcheck = sesson($mailcheck);



 $usercheck =antihax($_GET[value]);
 $res = @mysql_query( "SELECT status FROM CC_users WHERE user_email_address = '$mailcheck'" );
 $error_msg = "";
 if((!isset($_GET["value"])) || (!isset($_GET["mail"])))
     {
     $error_msg .= "<p>$missing_post_data_error</p>";
     echo $error_msg;
     exit;
 }
 else
 {
       $getstat="SELECT * from CC_users where user_email_address ='$mailcheck'";
       $getstat2=mysql_query($getstat) or die($no_users_error_label);
       $getstat3=mysql_fetch_array($getstat2);
       if($getstat3['status']==9)
       {
           $error_msg = $already_confimed_error_label;
           echo "<br><b><center>$error_msg</b>";
           echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
           exit;
       }
       else
       {
           @mysql_query ("UPDATE CC_users SET status='9',usercheck='' WHERE usercheck ='$usercheck'");
           $error_msg .= mysql_error();
           if($error_msg == "")
           {
               echo "<center><b>$new_member_confirmed_label</b><br><br>";
           }
           else
           {
               echo $error_msg;
           }
       }
 }
 break;
}
echo "</td></tr></table>";
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
                  include "$theblock";
                  echo "<br>";
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