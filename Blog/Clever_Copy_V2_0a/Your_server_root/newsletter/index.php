<?
session_start();
include "../admin/connect.inc";
include "../languages/default.php";
include "../antihack.php";
$getmailset="SELECT * from CC_newsletter";
$getmailset2=mysql_query($getmailset) or die($no_mail_found_error);
$getmailset3=mysql_fetch_array($getmailset2);
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$from_address = $getprefs3[siteemail];
$style = $getprefs3[personality];
$normal_header = 'Content-type: text/plain; charset="iso-8859-1"';
$the_headers[] = 'Mime-Version: 1.0';
$the_headers[] = 'Content-Transfer-Encoding: 8bit';
echo "<html><head>";
echo "<link rel='stylesheet' href='$style' type='text/css'></head></html>";
$IP = getenv ("REMOTE_ADDR");
$set = $_GET['set'];
$mail_address = stripslashes(urldecode($_GET['email']));
if ($set == 'subscribe') {
  if (!preg_match('#^([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+[^\".,?! ])$#i', $mail_address)) {
    $error_msg = $invalid_mail_error;
  }
  if (!isset($error_msg)) {
      $addressexists = false;
      $query="SELECT mail_address from CC_newsletter";
      $result = mysql_query($query);
      while($row = mysql_fetch_array($result))
      {
        $test_exists = $row[mail_address];
        $test_exists = registre($test_exists);
        if  ($test_exists == $mail_address){
              $addressexists = true;
              break;
      }
  }
  if ($addressexists) {
      $error_msg = $already_subscribed_error;
  }
}
if (!isset($error_msg)) {
    $from_address = registre($from_address);
    $headers = 'From: '.$from_address;
    if ($the_headers) {
      foreach ($the_headers as $val) $headers .= "\n".$val;
    }
    $headers .= "\n".$normal_header;
    $this_address = "$getprefs3[siteaddress]/newsletter/%s";
    if (!@mail($mail_address, $confirm_mail_subject, sprintf($confirm_msg_label."\n\n".$this_address,'?set=confirmation&email='.urlencode($mail_address)), $headers)) {
        $error_msg = $sending_error_label;
    }
}
if (!isset($error_msg)) {
        echo "<center><b>$subscribed_awaiting_confirm</b><br><br>";
        echo "<meta http-equiv='refresh' content='6;URL=../index.php'>";
        echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
}else {
    echo "<b><center>$error_msg</b><br>";
    echo "<meta http-equiv='refresh' content='6;URL=../index.php'>";
    echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
  }
}
if ($set == 'unsubscribe') {
  if (!preg_match('#^([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+[^\".,?! ])$#i', $mail_address)) {
    $error_msg = $invalid_mail_error;
  }
  if (!isset($error_msg)) {
      $addressexists = "false";
      $query="SELECT mail_address from CC_newsletter";
      $result = mysql_query($query);
      while($row = mysql_fetch_array($result))
       {
        $test_exists = $row[mail_address];
        $test_exists = registre($test_exists);
        if  ($test_exists == $mail_address){
              $addressexists = "true";
              break;
        }
     }
     if ($addressexists == "false") {
      $error_msg = "<center><b>$no_unsubscribe_address_found</b><br>";
     }
  }
  if (!isset($error_msg)) {
    $from_address = registre($from_address);
    $headers = 'From: '.$from_address;
    if ($the_headers) {
      foreach ($the_headers as $val) $headers .= "\n".$val;
    }
    $headers .= "\n".$normal_header;
    $this_address = "$getprefs3[siteaddress]/newsletter/%s";
     if (!@mail($mail_address, $confirm_remove_mail_subject, sprintf($confirm_unsubscribe_msg_label."\n\n".$this_address,'?set=remove&email='.urlencode($mail_address)), $headers)) {
        $error_msg = $sending_error_label;
    }
  }
  if (!isset($error_msg)) {
        echo "<center><b>$unsubscribed_awaiting_confirm</b><br><br>";
        echo "<meta http-equiv='refresh' content='6;URL=../index.php'>";
        echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
  }else {
    echo "<center>$error_msg";
    echo "<meta http-equiv='refresh' content='6;URL=../index.php'>";
    echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
  }
}
elseif ($set == 'remove') {
  if (!preg_match('#^([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+[^\".,?! ])$#i', $mail_address)) {
    $error_msg = $invalid_mail_error;
  }
  $mail_address = str_replace("%40","@",$mail_address);
  $addressexists = false;
  $query="SELECT mail_address, id from CC_newsletter";
  $result = mysql_query($query);
  while($row = mysql_fetch_array($result))
  {
        $test_exists = $row[mail_address];
        $test_exists = registre($test_exists);
        if  ($test_exists == $mail_address){
            $addressexists = "true";
            $id = $row[id];
            break;
        }
  }
       $deladdress="DELETE from CC_newsletter WHERE id = '$id'";
       mysql_query($deladdress);// or die($could_not_delete_mail_error);
       $error_msg .= mysql_error();
       echo "<center><b>$unsubscribe_successful_label</b><br>";
       echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
       echo "<meta http-equiv='refresh' content='2;URL=../index.php'>";
}
elseif ($set == 'confirmation') {
  if (!preg_match('#^([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+[^\".,?! ])$#i', $mail_address)) {
    $error_msg = $two_invalid_mail_error;
  }
  if (!isset($error_msg)) {
    $addressexists = false;
    $query="SELECT mail_address from CC_newsletter";
    $result = mysql_query($query);
    while($row = mysql_fetch_array($result))
       {
        $test_exists = $row[mail_address];
        if  ($test_exists == $mail_address){
              $addressexists = true;
              break;
        }
   }
   if ($addressexists) {
      $error_msg = "<center><b>$already_subscribed_error</b>";
      echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
      echo "<meta http-equiv='refresh' content='2;URL=../index.php'>";
   }
  }
  if (!isset($error_msg)) {
    $time= time();
    $mail_address = antihax($mail_address);
    $mail_address = sesson ($mail_address);
    @mysql_query( "INSERT INTO CC_newsletter( mail_address,  time, IP ) VALUES('$mail_address', '$time', '$IP')" );
    $error_msg .= mysql_error();
    echo "<center><b>$added_to_mailist_label</b><br><br>";
    echo "<meta http-equiv='refresh' content='6;URL=../index.php'>";
    echo "<center>$if_you_see_label <a href='../index.php'>$click_here_label</a></center>";
   }else{
    echo $error_msg;
  }
}
?>