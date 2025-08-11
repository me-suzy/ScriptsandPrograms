<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "connect.inc";
?>
<html><head>
<title><?php echo $edit_members_label; ?></title>
<script>
<!-- Begin
function goTodelURL() { window.location = "editmembers.php?op=admin_del"; }
//  End -->
</script>
<script>
<!-- Begin
function goToeditURL() { window.location = "editmembers.php?op=admin_edit"; }
//  End -->
</script>
<script>
<!-- Begin
function goTorefreshURL() { window.location = "editmembers.php?op?&ID=1&start=0"; }
//  End -->
</script>
<script>
<!-- Begin
function goToaddURL() { window.location = "editmembers.php?op=add_admin"; }
//  End -->
</script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<center>
<?php
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
include "index.php";
$next = 0;
$ID=$_GET['ID'];
if(!isset($_GET['start']))
{
    $start=0;
    $showmax = "50";
}else{
    $start=$_GET['start'];
    $showmax = "50";
    $query =  ("SELECT * FROM CC_users ORDER By theid ASC LIMIT $start,$showmax") or die ($no_login_error);
    $result = mysql_query($query);
    echo "<br><br>";
    echo "<table border='1' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='5'><left>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_users_label</font></b></center></td></tr>";
    echo "<td width='10%' valign = 'top'>";
    echo "<b>$admin_id_label</b> ";
    echo "<td width='20%' valign = 'top'>";
    echo "<b>$admin_username_label</b>";
    echo "<td width='30%' valign = 'top'>";
    echo "<b>$users_email_label</b>";
    echo "<td width='20%' valign = 'top'>";
    echo "<b>$site_friendly_name_label</b>";
    echo "<td width='20%' valign = 'top'>";
    echo "<b>$status_label</b>";
    while($row = mysql_fetch_array( $result ))
    {
        echo "<tr><td width='10%'>";
        $ID = $row[theid];
        echo $row["theid"];
        echo "<td width='20%'>";
        echo $row[ "username" ];
        echo "<td width='30%'>";
        $mail = registre($row[user_email_address]);
        $mailto_address = "<a href=mailto:$mail>$mail</a>";
        echo $mailto_address;
        echo "<td width='20%'>";
        echo $row["user_site_name"];
        echo "<td width='20%'>";
        if ($row[status] == '9')
        {
          echo "<font color = 'green'>$registered_active_label</font>";
        }else{
          echo"<font color = 'red'>$waiting_for_confim_label</font>";
          if ($row[reval] == '0')
          {
                echo "<form action='editmembers.php?op=revalidate&ID=$ID' method='post'><input type='submit' value='$reval_button_label' class = 'buttons'></form>";
          }elseif ($row[reval] >= '1')
          {
                echo "<br>$row[reval] $reval_mails_sent_label<br>";
                echo "<form action='editmembers.php?op=revalidate&ID=$ID' method='post'><input type='submit' value='$reval_button_label' class = 'buttons'></form>";
          }
          echo "<form action='editmembers.php?op=admin_del_2nd&theid=$ID' method='post'><input type='submit' value='$delete_user_button_label' class = 'buttons'></form>";
        }
    }
    echo "<tr><td width = '100%' colspan = '5'><center><br>$go_to_page_label</center></td></tr>";
    echo "<tr><td  width = '100%' colspan = '5' valign='top'><center>";
    $order="SELECT * from CC_users";
    $order2=mysql_query($order) or die(mysql_error());
    $ctr=0;
    $fixed=0;
    $md=1+$ctr/$showmax;
    $num=mysql_num_rows($order2);
    $next=$start+$showmax;
    if($start>=$showmax)
    {
       echo "<A href='editmembers.php?start=0&ID=$ID'><-</a>&nbsp;";
    }
    while($order3=mysql_fetch_array($order2))
    {
      if($fixed>=$start-3*$showmax&&$fixed<=$start+7*$showmax)
      {
         if($fixed%$showmax==0)
         {
             echo "<A href='editmembers.php?start=$ctr&ID=$ID'>$md</a> ";
         }
      }
     $ctr=$ctr+1;
     $md=1+$ctr/$showmax;
     $fixed++;
    }
    if($start<=$num-$showmax)
    {
      $end=$fixed-50;
      echo "<A href='editmembers.php?start=$end&ID=$ID'>-></a>&nbsp;";
    }
}
echo"</tr></td></table>";
echo "<br>";
echo "<p align = 'center'>";
echo "<input type=button value='$add_user_button_label' class = 'buttons' onClick='goToaddURL()'>&nbsp;";
echo "<input type=button value='$edit_user_button_label' class = 'buttons' onClick='goToeditURL()'>&nbsp;";
echo "<input type=button value='$delete_user_button_label' class = 'buttons'  onClick='goTodelURL()'>&nbsp;";
echo "<input type=button value='$refresh_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
echo "<br><center><form action='editmembers.php?op=results' method='post'>";
echo "$search_by_label<br>";
echo "<select name='searchtype'>";
echo "<option value='theid'>$admin_id_label</option>";
echo "<option value='username'>$admin_username_label</option>";
echo "<option value='user_site_name'>$site_search_friendly_name_label</option></select><br>";
echo "$search_terms_label<br>";
echo "<input type='text' name='searchterm' size='60'><br><br>";
echo "<input type='submit' value=$search_button_label class='buttons'><br><br></form>";
echo "</p align><br><br>";

switch( $_GET[ "op" ] )
{

case "revalidate":
$ID = $_GET['ID'];
$query =  ("SELECT * FROM CC_users WHERE theid = '$ID'") or die ($no_users_error);
$result = mysql_query($query);
while($row = mysql_fetch_array( $result ))
{
   $useraddress = registre($row[user_email_address]);
   $siteemail = registre($getprefs3[siteemail]);
   $usercheck = ($row[usercheck]);
   $sitename =  $getprefs3[title];
   $url = $getprefs3[siteaddress]."/register.php?op=confirm&value=$usercheck&mail=$useraddress";
}
@mail("$useraddress","$reval_subject_label $sitename","$revalidate_email_text \n\n$url","FROM: $siteemail");
$query =  ("SELECT * FROM CC_users WHERE theid = '$ID'") or die ($no_users_error);
$result = mysql_query($query);
while($row = mysql_fetch_array( $result ))
{
   $reval = $row[reval];
}
$reval++;
mysql_query ("UPDATE CC_users SET reval = '$reval' WHERE theid = '$ID'");
echo "<b><br>$val_mail_sent_label</b><br>";
echo "<input type=button value='$refresh_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;"; 
break;

case "results":
$searchtype=$HTTP_POST_VARS['searchtype'];
$searchterm=$HTTP_POST_VARS['searchterm'];
$searchterm= trim($searchterm);
if (!$searchtype || !$searchterm)
{
  echo "$showing_search_results_label";
  echo "<table><tr><td>";
  echo $no_search_details_error_label;
  exit;
}
$searchtype = addslashes($searchtype);
$searchterm = addslashes($searchterm);
$query = "select * from CC_users where ".$searchtype." like '%".$searchterm."%' order by theid ASC";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
echo "<table><tr><td>";
echo "$searches_found_label - $num_results<br><br>";
echo $showing_search_results_label;
echo "</td></tr><tr><td>";
for ($i=0; $i <$num_results; $i++)
{
  $row = mysql_fetch_array($result);
  echo ($i+1);
  echo ".<br><b>$admin_username_label </b>";
  echo htmlspecialchars(stripslashes($row['username']));
  echo "<br><b>$site_search_friendly_name_label </b>";
  echo htmlspecialchars(stripslashes($row['user_site_name']));
  echo"<br><b>$email_label </b> ";
  $mail = registre($row['user_email_address']);
  $mail = htmlspecialchars(stripslashes($mail));
  $mail = "<a href=mailto:$mail>$mail</a>";
  echo $mail;
  echo "<br><b>$admin_id_label </b>";
  echo htmlspecialchars(stripslashes($row['theid']));
  echo "<br><br><A href='editmembers.php?op=admin_edit_2nd&theid=$row[theid]'>$edit_label</a> - <A href='editmembers.php?op=admin_del_2nd&theid=$row[theid]'>$delete_label</a>";
  echo "<hr><br>";
}
break;

case "admin_edit":
echo "<form action='editmembers.php?op=admin_edit_2nd' method='post'>";
echo "<p><center><label>$select_admin_to_edit_label&nbsp;";
echo "<input type='text' name='theid' size = '4'>";
echo "</label></p>";
echo "<p><center><input type='submit' value='$edit_this_admin_button_label' class = 'buttons'/></p>";
echo "</form>";
break;

case "admin_edit_2nd":
include "connect.inc";
$ID = $_GET[theid];
if ($ID =="")
{
  $ID = $_POST[theid];
}
$res = @mysql_query("SELECT username FROM CC_users WHERE theid = '$ID'");
$error_msg = "";
if(!isset($ID))
$error_msg .= "<p>$missing_post_data_error</p>";
else
{
 include "connect.inc";
 $res = @mysql_query("SELECT * FROM CC_users WHERE theid = '$ID'");
 $error_msg .= mysql_error();
 {
 if( $error_msg == "" )
 {
   $row = mysql_fetch_array($res);
   if( $error_msg == "" )
   {
     echo "$editing_this_admin_label&nbsp;";
     echo $row["username"];
     echo "&nbsp;$admin_with_the_id_of_label&nbsp;";
     echo $ID;
     $error_msg .= mysql_error();
   }
 }
}
}
if($error_msg == "")
{
  $error_msg .= "";
  echo "<form method='post' action='editmembers.php?op=admin_edit_3rd'>";
  echo "<p align = 'center'><label>$edit_admin_login_label<br><input type='text' name='username' size = '60' value= '$row[username]'></label></p>";
  echo "<p align = 'center'><label>$edit_admin_password_label<br><input type='text' name='password' size = '60' value = 'enter a password'></label></p>";
  $mail = registre($row[user_email_address]);
  echo "<p align = 'center'><label>$edit_account_email_label<br><input type='text' name='user_email_address' size = '60' value = '$mail'></label></p>";
  echo "<p align = 'center'><label>$edit_friendly_label<br><input type='text' name='friendly_name' size = '60' value = '$row[user_site_name]'></label></p>";
  echo "<p align = 'center'>$admin_status_label</p><br>";
  echo "<select name='status'>";
  if($row[status]==9)
      {
          echo "<option value='9'>$registered_active_label</option>";
          echo "<option value='8'>$waiting_for_confim_label</option>";
  }else{
          echo "<option value='8'>$waiting_for_confim_label</option>";
          echo "<option value='9'>$registered_active_label</option>";
  }
  echo "</select>";
  echo "<p align = 'center'><input type='hidden' name='theid'value = '$row[theid]'></label></p>";
  echo "<p><input type='submit' value='$confirm_admin_edit_button_label' class = 'buttons'/></p>";
  echo "</form>";
  echo $error_msg;
}else{
    echo "<br>$edit_admin_problem_error";
}
break;

case "admin_edit_3rd":
if (strlen ($_POST['password'])<4)
    {
    echo $pass_too_short_error;
    }else{
$error_msg = "";
if( !isset( $_POST['username'] ) && !isset( $_POST['password'] )&& !isset( $_POST['theid'] )&& !isset( $_POST['status'] ))
$error_msg .= "<p>$missing_post_data_error</p>";
else
{
    include "connect.inc";
    $username=$_POST["username"];
    $friendly_name=$_POST["friendly_name"];
    $status=$_POST["status"];
    $user_email_address=$_POST["user_email_address"];
    $thismail = $user_email_address;
    $user_email_address = sesson($user_email_address);
    $user_site_name=$_POST["user_site_name"];
    $password=$_POST["password"];
    $password=md5($password);
    $ID=$_POST["theid"];
    @mysql_query ("UPDATE CC_users SET user_site_name='$friendly_name',user_email_address='$user_email_address',username='$username', status='$status', password='$password' WHERE theid ='$ID'");
    $error_msg .= mysql_error();
}
if( $error_msg == "" )
    $error_msg = "<p><center><b>" . $_POST["username"] . "</b>&nbsp;$admin_successfully_edited_label<br><br> $admin_assigned_password_label&nbsp; <b>" . $_POST["password"].".</b>&nbsp;$admin_note_details_label</p>";
    echo $error_msg;
    echo "<br>$would_you_like_to_mail_user $username";
    echo "<form name='theform' method='post' action='cntct.php'>";
    echo "<input type='hidden' name='username' value = $username><br>";
    echo "<input type='hidden' name='user_site_name' value = $user_site_name><br>";
    echo "<input type='hidden' name='password' value = $_POST[password]>";
    echo "<input type='hidden' name='email'value='$thismail'>";
    echo "<input type='hidden' name='destination_email' value='$thismail'>";
    echo "<input type='hidden' name='sendurl' value='editmembers.php'>";
    echo "<input type='hidden' name='welcome_email_label' value='$your_acount_changed_label'>";
    echo "<input type='hidden' name='welcome_email_label_cont' value='$welcome_member_email_cont_label $getprefs3[siteaddress]/members.php'>";
    echo "<input type='hidden' name='new_member_email_subject' value='$your_acount_edited_label'>";
    echo "<input type='submit' name='submit' value='$mail_user_details_button_label $username' class = 'buttons'>";
    echo "</form>";
}
break;

case "admin_del":
include "connect.inc";
$res = @mysql_query( "SELECT theid, username FROM CC_users" );
$num_results = mysql_num_rows($res);
if ($num_results >1){
     echo "<br>$delete_admin_warning_label<br>";
     echo "<form action='editmembers.php?op=admin_del_2nd' method='post'>";
     echo "<p><label><center>Enter account ID to delete ";
     echo "<input type='text' name='theid' size = '6'>";
     echo "</label></p>";
     echo "<p><input type='submit' value='$delete_this_admin_button_label' class = 'buttons'/></p>";
     echo "</form>";
}else{
echo $must_be_one_admin_label;
}
break;

case "admin_del_2nd":
include "connect.inc";
$ID = $_GET[theid];
if ($ID =="")
{
  $ID = $_POST[theid];
}
$res = @mysql_query("SELECT username FROM CC_users WHERE theid = '$ID'");
$error_msg = "";
if(!isset($ID))
$error_msg .= "<p>$missing_post_data_error</p>";
else
    {
    include "connect.inc";
    $res = @mysql_query( "SELECT username FROM CC_users WHERE theid = '$ID'");
    $error_msg .= mysql_error();
     {
     if( $error_msg == "" )
         {
         $row = mysql_fetch_array( $res );
         if( $error_msg == "" )
              {
              @mysql_query( "DELETE FROM CC_users WHERE theid = '$ID'");
              $error_msg .= mysql_error();
         }
     }
    }
}
if( $error_msg == "" ){
    $error_msg .= "<br><center>$admin_successfully_deleted";
    echo $error_msg;
}
else {
      echo "<br>$problem_deleting_admin_error<br>";
      echo "$error_message_was_label<font color = 'red'> $error_msg </font>";
}
echo "<meta http-equiv='refresh' content='0;URL=editmembers.php'>";
break;

case "add_admin":
echo "<form method='post' action='editmembers.php?op=add_user2nd'>";
echo "<p align = 'center'><label>$new_user_email_label<br><input type='text' size = '60' name='user_email_address'></label></p>";
echo "<p align = 'center'><label>$new_user_site_name_label<br><input type='text'  size = '60' name='user_site_name'></label></p>";
echo "<p align = 'center'><label>$new_user_username_label<br><input type='text' size = '60'  name='username'></label></p>";
echo "<p align = 'center'><label>$new_admin_password_label<br><input type='password' size = '60'  name='password'></label></p>";
//echo "<p align = 'center'><label>$new_admin_level_label<br></label>";  // Left in place for future updates
//echo "<select size='1' name='status'><option value='4'>$member_label</option><option value ='1'>$superuser_label</option><option value='2'>$admin_label</option><option value='3'>$god_label</option></select>";
echo "<p><input type='submit' value='$add_new_admin_button_label' class = 'buttons'/></p>";
echo "</form>";

break;

case "add_user2nd":
$error_msg = "";
if(!isset( $_POST["username"] ) && !isset( $_POST["password"] ))
   {
   $error_msg .= "<p>$missing_post_data_error</p>";
   }
   else
    {
    include "connect.inc";
    $user_email_address=$_POST["user_email_address"];
    $thismail =  $user_email_address;
    $user_email_address = sesson($user_email_address);
    $user_site_name=$_POST["user_site_name"];
    $username=$_POST["username"];
    $status="9";
    $password=$_POST["password"];
    $password=md5($password);
    $query =  ("SELECT * FROM CC_users") or die ($no_login_error);
    $result = mysql_query($query);
    $nameinuse = "false";
    while($row = mysql_fetch_array( $result ))
        {
         $tempuname = $row[username];
         if ($username ==  $tempuname)
              {
              $nameinuse = "true";
         }
    }
    if ($nameinuse == "false")
        {
        @mysql_query( "INSERT INTO CC_users( user_site_name,user_email_address, username, status, password ) VALUES('$user_site_name','$user_email_address','$username', '$status', '$password')" );
        $error_msg .= mysql_error();
        }
        else
            {
            $error_msg .= $that_name_taken_error_label;
            echo "<b>$error_msg</b><br>";
            exit;
    }
}
if( $error_msg == "" )
    $error_msg = "<p><center><b>&nbsp;" . $_POST["username"] . "</b> $user_successfully_added_label $username - $_POST[password]</p>";
    echo $error_msg;
    echo "<br>$would_you_like_to_mail_user $username";
    echo "<form name='theform' method='post' action='cntct.php'>";
    echo "<input type='hidden' name='username' value = $username><br>";
    echo "<input type='hidden' name='password' value = $_POST[password]>";
    echo "<input type='hidden' name='user_site_name'value='$user_site_name'>";
    echo "<input type='hidden' name='email'value='$thismail'>";
    echo "<input type='hidden' name='destination_email' value='$thismail'>";
    echo "<input type='hidden' name='sendurl' value='editmembers.php'>";
    echo "<input type='hidden' name='welcome_email_label' value='$welcome_member_email_label'>";
    echo "<input type='hidden' name='welcome_email_label_cont' value='$welcome_member_email_cont_label $getprefs3[siteaddress]/members.php'>";
    echo "<input type='hidden' name='new_member_email_subject' value='$new_member_email_subject'>";
    echo "<input type='submit' name='submit' value='$mail_user_details_button_label $username' class = 'buttons'>";
    echo "</form>";
break;
}

}else
 {
  echo $no_login_error;
  include "index.php";
}
?>