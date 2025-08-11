<?php
session_start();
include "admin/connect.inc";
include "admin/languages/default.php";
include "languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
?>
<head><link rel="stylesheet" href="<?php echo $style; ?>" type="text/css"></head>
<?php
if (isset($_POST['submit']))
{
    function santihakt($text) {
    $text = str_replace("http://","",$text);
    $text = str_replace("\"","&quot;",$text);
    $text = str_replace("/","",$text);
    $text = str_replace(chr(10),"",$text);
    $text = strip_tags ($text, "");
    $text = str_replace(chr(13), "<br>", $text);
    $text = str_replace("'","&#39;",$text);
    return($text);
    }
   echo "<center>$getting_login_label</center>";
   $username=santihakt($_POST['username']);
   $password=santihakt($_POST['password']);
   $password=md5($password);
   $getadmin="SELECT * from CC_users where username='$username' and password='$password'";
   $getadmin2=mysql_query($getadmin) or die($no_admin_error);
   $getadmin3=mysql_fetch_array($getadmin2);
   if ((strlen($getadmin3['password'])<1) || (strlen($getadmin3['username'])<1))
   {
      echo "<b><center>$wrong_login_label</b></center>";
      echo "<meta http-equiv='refresh' content='3;URL=index.php' target='_top'>";
      echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
      exit;
   }
   if ($getadmin3['status']=='8' )
        {
        echo "<center><b>$account_not_active_error_label</b><br>";
        echo "<meta http-equiv='refresh' content='5;URL=index.php' target='_top'>";
        echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
        exit;
   }
   else
   {
      $_SESSION['cuser']= $username;
      echo "<meta http-equiv='refresh' content='0;URL=index.php' target='_top'>";
      echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
      $getadmin="SELECT * from CC_admin where username='$username' and password='$password'";
      $getadmin2=mysql_query($getadmin) or die($no_admin_error);
      $getadmin3=mysql_fetch_array($getadmin2);
      if (!$getadmin3=="")
      {
        $_SESSION['cadmin']= $username;
      }
   }
}
if(isset($_SESSION['cuser']))
  {
   $bloguser=$_SESSION['cuser'];
   $getuser="SELECT username from CC_users where username='$bloguser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   echo "<center>$user_recognised_label ";
   echo  $getuser3['username'];
   echo "<form method='link' action='admin/gone.php'><input type='submit' value='$logout_button_label' class = 'buttons'></form>";
}else{
 echo "<center><form action='login.php' method='post'>";
 echo "$admin_username_label<br>";
 echo "<input type='text' name='username' size='20'><br>";
 echo "$admin_password_label<br>";
 echo "<input type='password' name='password' size='20'><br>";
 echo "<input type='submit' name='submit' value='$login_label' class = 'buttons'></form>";
 $thisctr = '0';
 $limit = '0';
}
if ($getprefs3[membersallowed] == '1')
 {
    echo "<br>$register_on_site_label<br><br>";
    $thisquery =  ("SELECT * FROM CC_blocks WHERE view = '1' ORDER By blockposition ASC") or die($no_blocks_found_error);
    $thisresult = mysql_query($thisquery);
    while($thisrow = mysql_fetch_array($thisresult)){
       $thisctr++;
       if ($thisctr >= '1')
       {
          $limit++;
          if ($limit <= '1')
          {
             echo "$joining_gives_access_label<br>";
          }
          echo "$thisrow[label]<br>";
       }
    }
    echo "<form method='link' action='register.php'><input type='submit' value='$register_button_label' class = 'buttons'></form></p>";
 }else{
}

?>