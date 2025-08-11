<?php
session_start();
include "languages/default.php";
include "connect.inc";
echo "<html><head>";
echo "<title>$admins_edit_title</title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
?>
<script>
<!-- Begin
function goTodelURL() { window.location = "editadmn.php?op=admin_del"; }
//  End -->
</script>
<script>
<!-- Begin
function goToeditURL() { window.location = "editadmn.php?op=admin_edit"; }
//  End -->
</script>
<script>
<!-- Begin
function goTorefreshURL() { window.location = "editadmn.php?op=admin_rfrsh"; }
//  End -->
</script>
<script>
<!-- Begin
function goToaddURL() { window.location = "editadmn.php?op=add_admin"; }
//  End -->
</script>
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
$siteemail = $getprefs3[siteemail];
$siteemail = registre($siteemail);
$query =  ("SELECT * FROM CC_admin ORDER By status DESC") or die($no_login_error);
$result = mysql_query($query);
echo "<br><br>";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_admins_label</font></b></center></td></tr>";
echo "<td width='10%'>";
echo "<b>$admin_id_label</b> ";
echo "<td width='20%'>";
echo "<b>$admin_username_label</b>";
echo "<td width='40%'>";
echo "<b>$users_email_label</b>";
echo "<td width='30%'>";
echo "<b>$admin_status_label</b>";
while( $row = mysql_fetch_array( $result ) )
{
        echo "<tr><td width='10%'>";
        echo   $row["theid"] ;
        echo "<td width='20%' >";
        echo  $row["username"] ;
        echo "<td width='40%'>";
        $addy = registre($row[admin_email_address]);
        $mailto_address = "<a href=mailto:$addy>$addy</a>";
        echo  $mailto_address;
        echo "<td width='30%'>";
        echo ($row["status"]);
        if  ($row["status"] == "1"){
              echo "&nbsp;$superuser_label";
        }
        elseif ($row["status"] == "2"){
              echo "&nbsp;$admin_label";
        }
        else
              {
              echo "&nbsp;$god_label";
        }
}
echo"</tr></td></table>";
echo "<br>";
echo "<p align = 'center'>";
echo "<input type=button value='$add_admin_button_label' class = 'buttons' onClick='goToaddURL()'>&nbsp;";
echo "<input type=button value='$edit_admin_button_label' class = 'buttons' onClick='goToeditURL()'>&nbsp;";
echo "<input type=button value='$delete_admin_button_label' class = 'buttons' onClick='goTodelURL()'>&nbsp;";
echo "<input type=button value='$refresh_admins_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
echo "</p align><br><br>";

switch( $_GET[ "op" ] )
{
case "admin_edit":
$res = @mysql_query( "SELECT theid, username FROM CC_admin" );
echo "<form action='editadmn.php?op=admin_edit_2nd' method='post'>";
echo "<p><center><label>$select_admin_to_edit_label&nbsp;";
echo "<select name='theid'>";
while( $row = mysql_fetch_array( $res ) )
{
        echo "<option value=\"" . $row[ "theid" ] . "\">" . $row[ "username" ] . "</option>\n";
}
echo "</select>";
echo "</label></p>";
echo "<p><center><input type='submit' value='$edit_this_admin_button_label' class = 'buttons'/></p>";
echo "</form>";
break;

case "admin_edit_2nd":
include "connect.inc";
$res = @mysql_query( "SELECT username FROM CC_admin WHERE theid = " . $_POST[ "theid" ] );
$error_msg = "";
if( !isset( $_POST["theid"] ) )
$error_msg .= "<p>$missing_post_data_error</p>";
else{
 include "connect.inc";
 $res = @mysql_query( "SELECT * FROM CC_admin WHERE theid = " . $_POST[ "theid" ] );
 $error_msg .= mysql_error();
 {
  if( $error_msg == "" )
       {
       $row = mysql_fetch_array( $res );
        if( $error_msg == "" )
        {
        echo "$editing_this_admin_label&nbsp;";
        echo $row[ "username" ];
        echo "&nbsp;$admin_with_the_id_of_label&nbsp;";
        echo $_POST["theid"];
        echo "<br>$admin_user_levels_label<br>";
        $error_msg .= mysql_error();
       }
      }
  }
 }
 if( $error_msg == "" )
 {
      $error_msg .= "";
      $adminmail = $row[admin_email_address];
      $adminmail = registre($adminmail);
      $ID = $_POST['theid'];
      echo "<form method='post' action='editadmn.php?op=admin_edit_3rd'>";
      echo "<p align = 'center'><label>$edit_admin_login_label<br><input type='text' name='username'value= '$row[username]'></label></p>";
      echo "<p align = 'center'><label>$edit_account_email_label<br><input type='text' size = '50' name='admin_email_address'value= '$adminmail'></label></p>";
      echo "<select name='status'>";
      if($row[status]==1)
      {
          echo "<option value='1'>$superuser_label</option>";
          echo "<option value='2'>$admin_label</option>";
          echo "<option value='3'>$god_label</option>";
      }
      elseif($row[status]==2)
      {
          echo "<option value='2'>$admin_label</option>";
          echo "<option value='3'>$god_label</option>";
          echo "<option value='1'>$superuser_label</option>";
      }
      elseif($row[status]==3)
      {
          echo "<option value='3'>$god_label</option>";
          echo "<option value='2'>$admin_label</option>";
          echo "<option value='1'>$superuser_label</option>";
      }
      echo "</select>";
      echo "<p align = 'center'><input type='hidden' name='theid'value = '$row[theid]'></label></p>";
      echo "<p><input type='submit' value='$confirm_admin_edit_button_label' class = 'buttons'/></p>";
      echo "</form>";
      echo "<p><form method='post' action='editadmn.php?op=pass_edit'><input type='hidden' name='name'value= '$row[username]'><input type='hidden' name='theid'value= '$ID'><input type='submit' value='$edit_admn_password_button_label' class = 'buttons'/></form></p>";
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
if( !isset( $_POST['username'] )&& !isset( $_POST['theid'] )&& !isset( $_POST['status'] ))
$error_msg .= "<p>$missing_post_data_error</p>";
else
{
    include "connect.inc";
    $username=$_POST['username'];
    $admin_email_address=$_POST['admin_email_address'];
    $tempadmin_email_address = $admin_email_address;
    $admin_email_address = sesson($admin_email_address);
    $status=$_POST['status'];
    $ID=$_POST['theid'];
    $cont = "$welcome_admin_email_label_cont $getprefs3[siteaddress]/admin/index.php";
    @mysql_query ("UPDATE CC_admin SET admin_email_address='$admin_email_address',username='$username', status='$status' WHERE theid ='$ID'");
    $error_msg .= mysql_error();
}
if($error_msg == "")
    $error_msg = "<p><center><b>" . $_POST["username"] . "</b>&nbsp;$admin_successfully_edited_label<br><br></b>&nbsp;$admin_note_details_label</p>";
    echo $error_msg;
    echo "<br><b>$user_has_been_mailed_label $username</b><br>";
    mail("$tempadmin_email_address","$your_acount_edited_label","$username$your_acount_changed_label\n\n$username_label $username\n\n$cont","FROM: $siteemail");
}
break;

case "pass_edit":
$ID = $_POST['theid'];
$name = $_POST['name'];
echo "<br><b>$name</b><br><br>";
echo "<form method='post' action='editadmn.php?op=pass_edit_2nd'>";
echo "<p align = 'center'><label>$edit_account_password_label<br><input type='text' name='pass'></label></p>";
echo "<p align = 'center'><label>$edit_account_password2nd_label<br><input type='text' name='passtwo'></label></p>";
echo "<input type='hidden' name='name'value= '$name'><input type='hidden' name='theid'value= '$ID'>";
echo "<p><input type='submit' value='$confirm_admin_edit_button_label' class = 'buttons'/></p>";
echo "</form>";
echo $error_msg;
break;

case "pass_edit_2nd":
$ID = $_POST['theid'];
$name = $_POST['name'];
$pass = $_POST['pass'];
$passtwo = $_POST['passtwo'];
if ($pass == $passtwo)
{
   $pass = MD5($pass);
   @mysql_query ("UPDATE CC_admin SET  password='$pass' WHERE theid ='$ID'");
   $error_msg .= mysql_error();
}
if ($error_msg == "")
{
       echo "<b>$edit_event_success_label</b>";
}else{
   echo "<b>$passwords_no_match_error_label</b>";
}
break;

case "admin_del":
include "connect.inc";
$res = @mysql_query( "SELECT theid, username FROM CC_admin" );
$num_results = mysql_num_rows($res);
if ($num_results >1){
     echo "<br>$delete_admin_warning_label<br>";
     echo "<form action='editadmn.php?op=admin_del_2nd' method='post'>";
     echo "<p><label><center>$get_admin_to_delete_label";
     echo "    <select name='theid'>";
     while($row = mysql_fetch_array($res))
     {
             echo "<option value=\"" . $row[ "theid" ] . "\">" . $row[ "username" ] . "</option>\n";
     }
echo "</select>";
echo "</label></p>";
echo "<p><input type='submit' value='$delete_this_admin_button_label' class = 'buttons'/></p>";
echo "</form>";
}else{
echo $must_be_one_admin_label;
}
break;

case "admin_del_2nd":
include "connect.inc";
$res = @mysql_query("SELECT username FROM CC_admin WHERE theid = " . $_POST[ "theid"]);
$error_msg = "";
if( !isset( $_POST["theid"] ) )
$error_msg .= "<p>$missing_post_data_error</p>";
else
    {
    include "connect.inc";
    $res = @mysql_query("SELECT username FROM CC_admin WHERE theid = " . $_POST[ "theid"]);
    $error_msg .= mysql_error();
     {
     if  ($_POST["theid"] =="1")
     {
             $error_msg .= "$cannot_delete_god_error";
     }
     if( $error_msg == "" )
         {
         $row = mysql_fetch_array( $res );
         if( $error_msg == "" )
              {
              @mysql_query( "DELETE FROM CC_admin WHERE theid = " . $_POST["theid"] );
              $error_msg .= mysql_error();
         }
     }
    }
}
if( $error_msg == "" ){
    $error_msg .= "<br><center>$admin_successfully_deleted";
    echo $error_msg;
    echo "<meta http-equiv='refresh' content='0;URL=editadmn.php'>";
}else{
      echo "<br>$problem_deleting_admin_error<br>";
      echo "$error_message_was_label<font color = 'red'> $error_msg </font>";
}
break;

case "add_admin":
echo "<br><img src ='../images/information.gif'> $admin_user_levels_label<br>";
echo "<form method='post' action='editadmn.php?op=add_admin2nd'>";
echo "<p align = 'center'><label>$new_admin_email_label<br><input type='text' size = '60' name='admin_email_address'></label></p>";
echo "<p align = 'center'><label>$new_admin_username_label<br><input type='text' name='username'></label></p>";
echo "<p align = 'center'><label>$new_admin_password_label<br><input type='password' name='password'></label></p>";
echo "<p align = 'center'><label>$new_admin_level_label<br></label>";
echo "<select size='1' name='status'><option value ='1'>$superuser_label</option><option value='2'>$admin_label</option><option value='3'>$god_label</option></select>";
echo "<p><input type='submit' value='$add_new_admin_button_label' class = 'buttons'/></p>";
echo "</form>";
break;

case "add_admin2nd":
$error_msg = "";
if( !isset( $_POST["username"] ) && !isset( $_POST["password"] ))
    $error_msg .= "<p>$missing_post_data_error</p>";
else{
    include "connect.inc";
    $username=$_POST["username"];
    $admin_email_address=$_POST["admin_email_address"];
    $themailaddress = $_POST["admin_email_address"];
    $themailaddress = sesson($themailaddress);
    $status=$_POST["status"];
    $password=$_POST["password"];
    $tempass=$_POST["password"];
    $password=md5($password);
    @mysql_query( "INSERT INTO CC_admin( admin_email_address, username, status, password) VALUES('$themailaddress','$username', '$status', '$password')" );
    $error_msg .= mysql_error();
}
if( $error_msg == "" )
    $error_msg = "<p><center><b>&nbsp;" . $_POST["username"] . "</b> $admin_successfully_added_label</p>";
    echo $error_msg;
    $site = "$getprefs3[siteaddress]/admin/index.php";
    echo "<br><b>$user_has_been_mailed_label $username</b><br>";
    mail("$admin_email_address","$new_admin_email_subject","$username$welcome_admin_email_label\n\n$password_label $tempass\n$username_label $username\n\n$welcome_admin_email_label_cont $site","FROM: $siteemail");
break;
}
}else{
  echo $no_login_error;
  include "index.php";
}
?>