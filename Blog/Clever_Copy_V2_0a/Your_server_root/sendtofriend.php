<?php
include "send_inc.php";
include "admin/connect.inc";
include "languages/default.php";
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$path_to_script = $getprefs3[siteaddress];
if ($_GET['make_mail']){
        $make_mail = $_GET['make_mail'];
}
elseif ($_POST['make_mail']){
        $make_mail = $_POST['make_mail'];
}
else {
        $make_mail = "this_one";
}
switch ($make_mail) {

case "this_one":
$url = $default_url;
echo"<br>$recommend_this_site_friend_label";
sendtofriend_form($to_name,$to_email,$from_name,$from_email,$url,$added_message);
break;
case "do_it":
include "languages/default.php";
include "admin/languages/default.php";
include "antihack.php";
$to_name = antihax($_POST['to_name']);
$to_email = antihax($_POST['to_email']);
$from_name = antihax($_POST['from_name']);
$from_email = antihax($_POST['from_email']);
$url = $_POST['url'];
$added_message = antihax($_POST['added_message']);
if (!(check_mail($to_email))){
   echo"<b>$a_problem_label -  $friends_mail_address_error</b>";
   sendtofriend_form($to_name,$to_email,$from_name,$from_email,$url,$added_message);
}else{
   if (!(check_mail($from_email))){
       echo"<b>$a_problem_label - $own_mail_address_error</b>";
       sendtofriend_form($to_name,$to_email,$from_name,$from_email,$url,$added_message);
   }else{
       if (!$to_name){
           echo"<b>$a_problem_label - $no_friends_name</b>";
           sendtofriend_form($to_name,$to_email,$from_name,$from_email,$url,$added_message);
   }else{
       if (!$from_name){
           echo"<b>$a_problem_label - $no_senders_name</b>";
           sendtofriend_form($to_name,$to_email,$from_name,$from_email,$url,$added_message);
       }else{
           if(!do_email($to_name,$to_email,$from_name,$from_email,$url,$added_message,$ip)){
               echo"<b>$a_problem_label - $cant_send_mail</b>";
               sendtofriend_form($to_name,$to_email,$from_name,$from_email,$url,$added_message);
           }else{
               echo"<center>$email_sent_message_title";
               echo" $to_name $mail_sent_message $mail_sent_to_friend_label $to_email <br><br>$go_back_to_index_label<br><br></p>";
               echo "<p align = 'center'>$if_you_see_label <a href='../index.php'> $click_here_label</a></p>";
               echo "<meta http-equiv='refresh' content='5;URL=index.php'>";
           }
       }
   }
}
}
break;
}
?>