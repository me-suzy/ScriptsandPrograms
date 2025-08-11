<?php
session_start();
include "../languages/default.php";
include "languages/default.php";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
    {
    $getprefs="SELECT * from CC_prefs";
    $getprefs2=mysql_query($getprefs) or die($no_preferences_error);
    $getprefs3=mysql_fetch_array($getprefs2);
    $getnl="SELECT * from CC_newslettersave";
    $getnl2=mysql_query($getnl) or die($no_preferences_error);
    $getnl3=mysql_fetch_array($getnl2);
    $getnls="SELECT * from CC_newsletter_template";
    $getnls2=mysql_query($getnls) or die($no_preferences_error);
    $getnls3=mysql_fetch_array($getnls2);
    $style = $getprefs3[personality];
    echo "<head><title>$edit_newsletter_label</title>";
    ?>
    <script>
    <!-- Begin
    function goToviewURL() { window.location = "editnewsletter.php?op=view"; }
    //  End -->
    </script>
    <script>
    <!-- Begin
    function goTonewsURL() { window.location = "editnewsletter.php?op=news"; }
    //  End -->
    </script>
    <script>
    <!-- Begin
    function goTorefreshURL() { window.location = "editnewsletter.php?op=rfrsh"; }
    //  End -->
    </script>
    <script>
    <!-- Begin
    function goToaddURL() { window.location = "editnewsletter.php?op=add"; }
    //  End -->
    </script>
    <script>
    <!-- Begin
    function goToarchivesURL() { window.location = "editnewsletter.php?op=archives"; }
    //  End -->
    </script>
    <script>
    <!-- Begin
    function goTotemplateURL() { window.location = "editnewsletter.php?op=edittemplate"; }
    //  End -->
    </script>
    <?php
    echo "<link rel='stylesheet' href='$style' type='text/css'>";
    echo "</head>";
    include "index.php";
    echo "<br><br>";
    echo "<body bgcolor=$getprefs3[block_background_color]>";
    $from_address = $getprefs3[siteemail];
    echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
    echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan = '5'><left>";
    echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_newsletter_label</font></b></center></td></tr>";
    echo "<tr><td colspan = '5'>";
    echo "<br>";
    echo "<p align = 'center'>";
    echo "<input type=button value='$send_newsletter_button_label' class = 'buttons'  onClick='goTonewsURL()'>&nbsp;";
    echo "<input type=button value='$view_members_button_label' class = 'buttons'  onClick='goToviewURL()'>&nbsp;";
    echo "<input type=button value='$add_user_button_label' class = 'buttons' onClick='goToaddURL()'>&nbsp;";
    echo "<input type=button value='$newsletter_archives_button_label' class = 'buttons' onClick='goToarchivesURL()'>&nbsp;";
    echo "<input type=button value='$newsletter_template_button_label' class = 'buttons' onClick='goTotemplateURL()'>&nbsp;";
    echo "<input type=button value='$refresh_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
    if ($getprefs3['archive_newsletter']== 1){
         echo "<br><br><br>$newsletter_auto_archive_on_label $site_preferences_label<br>";
    }else{
          echo "<br><br><br>$newsletter_auto_archive_off_label $site_preferences_label<br>";
    }
    echo "</p align><br><br></td>";

switch( $_GET[ "op" ] )
{

 case "delnewsletteritem":
 include "languages/default.php";
 $ID=$_GET['ID'];
 $del="DELETE from CC_newsletterarchive where ID='$ID'";
 mysql_query($del) or die($no_mail_found_error);
 echo "<tr><td><center><b>";
 echo $newsletter_archive_deleted_label;
 echo "</b><meta http-equiv='refresh' content='0;URL=editnewsletter.php?op=archives'>";
 break;

 case "readmore":
 include "languages/default.php";
 $ID=$_GET['ID'];
 $query =  ("SELECT * FROM CC_newsletterarchive where ID='$ID'") or die ($no_login_error);
 $result = mysql_query($query);
 echo "<tr><td>";
 echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan = '5'><left>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$newsletter_archives_label</font></b></center></td></tr>";
 echo "<tr><td width = '10%' valign = 'top'>";
 echo "<b>$newsletter_archive_date_label</b>";
 echo "<td width = '20%' valign = 'top'>";
 echo "<b>$newsletter_archive_subject_label</b>";
 echo "<td width = '60%' valign = 'top'>";
 echo "<b>$newsletter_archive_body_label</b>";
 echo "<td width = '5%' valign = 'top'>";
 echo "<td width = '5%' valign = 'top'>";
  while($row = mysql_fetch_array($result))
  {
         echo "<tr><td width = '10%' valign = 'top'>";
         if ($getprefs3[dateset] =="0"){
              $d8t = date("H:i m-d-y ", $row[time]);
         }else {
                $d8t = date("H:i d/m/y ", $row[time]);
  }
 echo $d8t;
 echo "<td width = '20%' valign = 'top'>";
 echo  $row[ "subject" ];
 echo "<td width = '60%' valign = 'top'>";
 echo $row["body"];
 echo "<br><hr>";
 echo "<td width = '5%' valign = 'top'>";
 echo "<form><input type='button' value='$back_label' class = 'buttons' onClick='history.back()'></form>";
 echo "<td width = '5%' valign = 'top'>";
 echo "<form action='editnewsletter.php?op=delnewsletteritem&ID=$row[ID]' method='post'><input type='submit' name='go' value='$delete_this_admin_button_label' class = 'buttons'></form>";
 }
 break;

 case "deloldarchives":
 $month=$_POST["month"];
 $year=$_POST["year"];
 if(isset($_POST['B1']))
 {
   echo "<tr><td><center><b>";
   $del="DELETE from CC_newsletterarchive WHERE month = '$month' AND year = '$year'";


   mysql_query($del) or die($no_mail_found_error);
   $error_msg .= mysql_error();
   if (!isset($errror_msg))
   {
     echo $newsletter_archives_deleted_label;
     echo "</b><meta http-equiv='refresh' content='0;URL=editnewsletter.php?op=archives'>";
   }else{
     echo $error_msg;
   }
 }
 break;

 case "archives":
 include "../languages/default.php";
 echo "<tr><td>";
 echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan = '2'><left>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$delete_old_newsletter_archives_label</font></b></center></td></tr>";
 echo "<tr><td width = '100%' valign = 'top'>";
 echo "<center>$delete_newsletters_prior_label</center>";
 echo "<tr><td align = 'center' width = '100%' valign = 'top'>";
 echo "<form action='editnewsletter.php?op=deloldarchives' method='post'>";
 echo "<select size='1' name='month'><option value='1'>$jan_label</option><option value='2'>$feb_label</option><option value='3'>$mar_label</option><option value='4'>$apr_label</option><option value='5'>$may_label</option><option value='6'>$jun_label</option><option value='7'>$jul_label</option><option value='6'>$aug_label</option><option value='9'>$sep_label</option><option value='10'>$oct_label</option><option value='11'>$nov_label</option><option value='12'>$dec_label</option></select>&nbsp;";
 echo "<input type='text' name='year' size='4'  value=$set_archive_year_label>";
 echo "&nbsp;<input type='submit' value='$delete_old_archives_label' name='B1' class = 'buttons'></form>";
 echo "</table><br>";
 $query =  ("SELECT * FROM CC_newsletterarchive") or die ($no_login_error);
 $result = mysql_query($query);
 $num_results = mysql_num_rows($result);
 $recs_to_show = 10;
 $count_recs = 10;
 $thecounter = 0;
 $last_shown = 0;
 $last_shown=$_GET['last_shown'];
 $thecounter=$_GET['thecounter'];
 $count_recs=$_GET['count_recs'];
 if ($thecounter<= "9"){$thecounter=0;}
 if ($last_shown <= "9"){$last_shown=0;}
 if ($count_recs <= "9"){$count_recs=9;}
 $query =  ("SELECT * FROM CC_newsletterarchive ORDER By time DESC LIMIT $last_shown,$recs_to_show") or die ($no_login_error);
 $result = mysql_query($query);
 echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan = '5'><left>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$newsletter_archives_label</font></b></center></td></tr>";
 echo "<tr><td colspan = '5'><p align = 'right'><b>$showing_newsletters_label $last_shown -> $count_recs - $most_recent_results_label</b>";
 echo "<tr><td width = '10%' valign = 'top'>";
 echo "<b>$newsletter_archive_date_label</b>";
 echo "<td width = '20%' valign = 'top'>";
 echo "<b>$newsletter_archive_subject_label</b>";
 echo "<td width = '60%' valign = 'top'>";
 echo "<b>$newsletter_archive_extract_label</b>";
 echo "<td width = '5%' valign = 'top'>";
 echo "<td width = '5%' valign = 'top'>";
 $i=="0";
 while($row = mysql_fetch_array( $result ))
        {
        echo "<tr><td width = '10%' valign = 'top'>";
        if ($getprefs3[dateset] =="0"){
               $d8t = date("H:i m-d-y ", $row[time]);
        }else {
               $d8t = date("H:i d/m/y ", $row[time]);
        }
        echo $d8t;
        echo "<td width = '20%' valign = 'top'>";
        echo  $row[ "subject" ];
        echo "<td width = '60%' valign = 'top'>";
        $thebody = $row['body'];
        $thebody = antihax($thebody);
        if ($i < 301){
              echo  substr($thebody, 0, 300);
             $i++;
        }
        echo "<br><hr>";
        echo "<td width = '5%' valign = 'top'>";
        echo "<form action='editnewsletter.php?op=readmore&ID=$row[ID]' method='post'><input type='submit' name='more' value='$more_label' class = 'buttons'></form>";
        echo "<td width = '5%' valign = 'top'>";
        echo "<form action='editnewsletter.php?op=delnewsletteritem&ID=$row[ID]' method='post'><input type='submit' name='del' value='$delete_this_admin_button_label' class = 'buttons'></form>";
 }
 $thecounter = ($thecounter+10);
 $last_shown = ($last_shown+10);
 $count_recs = ($count_recs+10);
 if ($last_shown <= $num_results)
    {
    echo "<tr><td width =10%'><td width = '20%'><td width = '60%'>";
    echo "<td width = '5%'><form action='editnewsletter.php?op=archives&last_shown=0&thecounter=0&count_recs=9' method='post'><input type='submit' name='back' value='$back_button_label' class = 'buttons'></form>";
    echo "<td width = '5%'><form action='editnewsletter.php?op=archives&last_shown=$last_shown&thecounter=$thecounter&count_recs=$count_recs' method='post'><input type='submit' name='more' value='$next_button_label' class = 'buttons'></form>";
 }else{
    echo "<tr><td width =10%'><td width = '20%'><td width = '60%'>";
    echo "<td width = '5%'><form action='editnewsletter.php?op=archives&last_shown=0&thecounter=0&count_recs=9' method='post'><input type='submit' name='more' value='$back_button_label' class = 'buttons'></form>";
    echo "<td width = '5%'>";
 }
 break;

 case "edittemplate":
 echo "<tr><td>";
 if(isset($_POST['submit']))
   {
   $template=$_POST['template'];
   $edittemplate="UPDATE CC_newsletter_template SET template='$template'";
   mysql_query($edittemplate) or die($unable_to_save_preferences_error);
   echo "<center>$preferences_saved_label</center>";
   echo "<meta http-equiv='refresh' content='0;URL=editnewsletter.php?op=edittemplate'>";
 }
 else
   {
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan = '3'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_newsletter_template_label</font></b></center></td></tr>";
   echo "<tr><td colspan = '3'><br>";
   echo "<tr><td width = '10%' valign = 'top'>";

   echo "$current_newsletter_template_label";
   echo "<td width = '20%' valign = 'top'>";
   echo "<form action='editnewsletter.php?op=edittemplate' method='post'>";
   echo "<textarea rows='9' name='template' cols = '55'>$getnls3[template]</textarea><br>";
   echo "<input type='submit' name='submit' value='Save' class = 'buttons'></form>";
   echo "<td width = '70%' valign = 'top'><img src = '../images/information.gif'> $newsletter_template_info_message_label<br><br></td>";
 }
 break;

 case "send":
 include "connect.inc";
 $the_headers[] = 'Mime-Version: 1.0';
 $the_headers[] = 'Content-Transfer-Encoding: 8bit';
 $theheader_html = 'Content-type: text/html; charset="iso-8859-1"';
 $theheader_plain = 'Content-type: text/plain; charset="iso-8859-1"';
 $waittime = $getprefs3[waittime];
 $waitinterval = 100;
 $month=date("n");
 $year=date("Y");
 $from = stripslashes($_POST['from']);
 $subject = stripslashes($_POST['subj']);
 $body = stripslashes($_POST['body']);
 $body = str_replace("'","",$body);
 $cc = (int)$_POST['cc'];
 $send_html = (int)$_POST['send_html'];
 $donemail = "1";
 $theoffset = $getprefs3[time_offset];
 $theoffset = ($theoffset *'60');
 $start = time()+ $theoffset;
 $template = $getnls3[template];
 $message = $template.$body;
 if ($send_html)
      {
      $add = "INSERT INTO `CC_newslettersave` (`month`,`year`,`body`,`from`,`subject`,`time`) VALUES ('$month','$year','$message','$from','$subject','$start')";
      mysql_query($add) or die ($no_mail_found_error);
      $error_msg .= mysql_error();
      echo "<br>$error_msg";
 }else{
       $add = "INSERT INTO `CC_newslettersave` (`month`,`year`,`body`,`from`,`subject`,`time`) VALUES ('$month','$year','$body','$from','$subject','$start')";
       mysql_query($add) or die ($no_mail_found_error);
       $error_msg .= mysql_error();
       echo "<br>$error_msg";
 }
 if (isset($_POST['submit'])) {
    $error_msg .= mysql_error();
    if ($getprefs3['archive_newsletter']== 1){
          if ($send_html)
               {
               $add = "INSERT INTO `CC_newsletterarchive` (`month`,`year`,`body`,`from`,`subject`,`time`) VALUES ('$month','$year','$message','$from','$subject','$start')";
               mysql_query($add) or die ($no_mail_found_error);
               $error_msg .= mysql_error();
          }else{
               $add = "INSERT INTO `CC_newsletterarchive` (`month`,`year`,`body`,`from`,`subject`,`time`) VALUES ('$month','$year','$body','$from','$subject','$start')";
               mysql_query($add) or die ($no_mail_found_error);
               $error_msg .= mysql_error();
          }
    }
    if ($from == '') $errror_msg = $no_newsletter_from_address_error;
    if ($body == '') $errror_msg = $no_newsletter_text_error;
    if (!isset($errror_msg)) {
        $headers = "From: ".$from."\n";
        if ($send_html) $headers .= $theheader_html;
        else $headers .= $theheader_plain;
        if ($the_headers) {
             foreach ($the_headers as $num) $headers .= "\n".$num;
        }
        if (isset($_POST['submit'])) {
            $mails_sent = 0;
            if ($cc) {
                 if ($send_html){
                      $theaddress = $getprefs3[cc_address];
                      $theaddress = registre($theaddress);
                      @mail($theaddress, $subject, $message, $headers);
                      $mails_sent++;
                 }else{
                       $theaddress = $getprefs3[cc_address];
                       $theaddress = registre($theaddress);
                       if (@mail($theaddress, $subject, $body, $headers)) $mails_sent++;}
            }
            if (!isset($errror_msg)) {
                $track_count = 0;
                $query =  ("SELECT mail_address FROM CC_newsletter") or die($no_mail_found_error);
                $result = mysql_query($query);
                while($row = mysql_fetch_array($result))
                       {
                       $mailaddress = registre($row[mail_address]);
                       if ($send_html){
                            @mail($mailaddress, $subject, $message, $headers);
                            $mails_sent++;
                            $track_count++;
                       }else{
                            @mail($mailaddress, $subject, $body, $headers);
                            $mails_sent++;
                            $track_count++;
                       }
                       if ($waitinterval > 0 && $track_count%(int)$waitinterval == 0 && $track_count != 0) {
                       sleep((int)$waittime);
                }
            }
        }
    }
    if ($donemail) {
         $end=  time()+ $theoffset;
         $thebody = "$newsletter_send_results_label\n";
         $thebody .= (int)$mails_sent." $this_many_mails_sent_label\n\n";
         $thebody .= "$sending_newsletters_began_label ".date('H:i:s', $start)." $sending_newsletter_ended_label ".date('H:i:s', $end)."\n";
         $thesiteaddress = $getprefs3[siteaddress];
         if (@mail($mailaddress, $thesiteaddress. $newsletter_finished_subject_label, $thebody, "From: ".$from)) $sent_count++;
    }
 }
 echo "<div align='center'><b>";
 if (isset($errror_msg)) {
    echo "<font color='red'$error_label $errror_msg</font>";
    } else {
      if ($sent_count > 0) {
           echo "<tr><td>";
           echo "<center><br><b>$the_newsletter_was_label $mails_sent  $people_label";
           echo "</b><br>";
      }
    }
 }
 ?>
 </b></div>
 <?php
 if (isset($_POST['submittest'])) {
    if ($from == '') $errror_msg = $no_newsletter_from_address_error;
    if ($body == '') $errror_msg = $no_newsletter_text_error;
    if (!isset($errror_msg)) {
        $headers = "From: ".$from."\n";
        if ($send_html) $headers .= $theheader_html;
        else $headers .= $theheader_plain;
        if ($the_headers) {
             foreach ($the_headers as $num) $headers .= "\n".$num;
        }
        if ($cc) {
            if ($send_html){
               $theaddress = $getprefs3[cc_address];
               $theaddress = registre($theaddress);
               @mail($theaddress, $subject, $message, $headers);
               $mails_sent++;
               $track_count++;
            }else{
                  $theaddress = $getprefs3[cc_address];
                  $theaddress = registre($theaddress);
                  @mail($theaddress, $subject, $body, $headers);
                  $mails_sent++;
                  $track_count++;
            }
        }
    }
    echo "<tr><td>";
    echo "<center><b>$did_newsletter_send_ok_label</b>";
    $getnl="SELECT * from CC_newslettersave WHERE time = $start";
    $getnl2=mysql_query($getnl) or die($no_preferences_error);
    $getnl3=mysql_fetch_array($getnl2);
    ?>
    <form name="email" action="editnewsletter.php?op=send" method="post">
    <table border="0" cellpadding="4" cellspacing="0"  align="center" style="border:  1px solid <?php echo $getprefs3[blockbordercolor]; ?>">
    <tr><td><?php echo $from_mail_label; ?></td><td><input type="text" name="from" size="45" maxlength="150" value="<?php echo $getnl3[from]; ?>"></td>
    <td>
    <input type="checkbox" name="send_html" value="1" class = "checkbox" id="chk_send_html" <?=($send_html)?'checked':''?>> <label for="chk_send_html"><?php echo $how_to_send_label; ?></label></td>
    <td></td></tr>
    <tr><td><?php echo $subject_mail_label; ?></td><td><input type="text" name="subj" size="45" maxlength="220" value="<?php echo $getnl3[subject]; ?>"></td>
    <td><input type="checkbox" name="cc" value="1" class = "checkbox" id="chk_cc" <?=(isset($cc) && $cc == 0)?'':'checked'?>> <label for="chk_cc"><?php echo $send_copy_to_self; ?></label></td></tr>
    <tr><td colspan="4"><textarea name="body" cols="150" rows="30" class="txtbox"><?php echo $getnl3[body]; ?></textarea></td></tr><tr>
    <td colspan="4" align="left"><input type="submit" name="submittest" value=" <?php echo $send_test_mail_button_label; ?> " class = "buttons">&nbsp;&nbsp;<input type="submit" name="submit" value=" <?php echo $send_live_mail_button_label; ?> "class = "buttons" onClick="return confirm('<?php echo $confirm_send_newsletter_label; ?>')"></td></tr>
    </table></form>
    <?php
 }
 break;


 case "news":
 echo "<tr><td>";
 echo "<center><b>$compose_newsletter_label</b></center>";
 echo "<br><br><img src = '../images/information.gif'> $newsletter_html_info_message_label";
 $from_address = registre($from_address);
 ?>
 <form name="email" action="editnewsletter.php?op=send" method="post">
 <table border="0" cellpadding="4" cellspacing="0"  align="center" style="border:  1px solid <?php echo $getprefs3[blockbordercolor]; ?>">
 <tr><td><?php echo $from_mail_label; ?></td><td><input type="text" name="from" size="45" maxlength="150" value="<?=($from=='')?$from_address:$from?>"></td><td>
 <input type="checkbox" name="send_html" value="1" class = "checkbox" id="chk_send_html" <?=($send_html)?'checked':''?>> <label for="chk_send_html"><?php echo $how_to_send_label; ?></label></td>
 <td></td></tr>
 <tr><td><?php echo $subject_mail_label; ?></td><td><input type="text" name="subj" size="45" maxlength="220" value="<?=($subject)?$subject:''?>"></td>
 <td><input type="checkbox" name="cc" value="1" class = "checkbox" id="chk_cc" <?=(isset($cc) && $cc == 0)?'':'checked'?>> <label for="chk_cc"><?php echo $send_copy_to_self; ?></label></td></tr>
 <tr><td colspan="4"><textarea name="body" cols="150" rows="30" class="txtbox"><?=(isset($body))?$body:''?></textarea></td></tr><tr>
 <td colspan="4" align="left"><input type="submit" name="submittest" value=" <?php echo $send_test_mail_button_label; ?> " class = "buttons">&nbsp;&nbsp;<input type="submit" name="submit" value=" <?php echo $send_live_mail_button_label; ?> "class = "buttons" onClick="return confirm('<?php echo $confirm_send_newsletter_label; ?>')"></td></tr>
 </table></form>
 <?php
 break;

 case "view":
 $query="SELECT * from CC_newsletter";
 $result = mysql_query($query);
 echo "<tr><td width = '30%'><b>$users_email_label<td width = '15%'><b>$date_joined_label</b><td width = '10%'><b>$current_ip_address_label</b><td width = '3%'><td width = '42%'>";
 $query="SELECT * from CC_newsletter";
 $result = mysql_query($query);
 @mysql_query( "DELETE FROM CC_newslettersave");
 @mysql_query("OPTIMIZE TABLE CC_newslettersave");
 @mysql_query("OPTIMIZE TABLE CC_newsletterarchive");
 @mysql_query("OPTIMIZE TABLE CC_newsletter");
 @mysql_query("OPTIMIZE TABLE CC_newsletter_template");
 while($row = mysql_fetch_array($result))
        {
        echo "<tr><td valign = 'top' width = '30%'>";
        echo registre($row[mail_address]);
        echo "<td valign = 'top' width = '15%'>";
        $joineddate = date('jS F Y',$row[time]);
        echo $joineddate;
        echo "<td valign = 'top' width = '10%'>";
        echo $row[IP];
        echo "<td valign = 'top' width = '3%'>";
        echo "<td valign = 'top' width = '42%'>";
        echo "<form action='editnewsletter.php?op=del&ID=$row[ID]' method='post'><input type='submit' name='go' value='$delete_this_admin_button_label' class = 'buttons'></form>";
 }
 echo "<tr>";
 break;

 case "del":
 $ID=$_GET['ID'];
 $del="DELETE from CC_newsletter where ID='$ID'";
 mysql_query($del) or die($no_mail_found_error);
 echo "<tr><td><center><b>";
 echo $newsletter_member_deleted_label;
 echo "</b><meta http-equiv='refresh' content='0;URL=editnewsletter.php?op=view'>";
 break;

 case "add":
 echo "<tr><td>";
 echo "<form method='post' action='editnewsletter.php?op=add_2nd'>";
 echo "<p align = 'center'><label>$new_user_email_label<br><input type='text' size = '60' name='user_email_address'></label></p>";
 echo "<p align = 'center'><input type='submit' value='$add_new_admin_button_label' class = 'buttons'/></p>";
 echo "</form>";
 break;

 case "add_2nd":
 include "languages/default.php";
 $error_msg = "";
 $user_email_address=$_POST["user_email_address"];
 $theoffset = $getprefs3[time_offset];
 $theoffset = ($theoffset *'60');
 $time = time()+ $theoffset;
 $query="SELECT mail_address from CC_newsletter";
 $result = mysql_query($query);
 $found = false;
 while($row = mysql_fetch_array($result))
       {
       $thismail = registre($row[mail_address]);
       if ($_POST["user_email_address"]== $thismail)
            {
            $found = true;
            echo "<tr><td>";
            echo "<b><center>$already_subscribed_error</b>";
            echo "<meta http-equiv='refresh' content='0;URL=editnewsletter.php?op=view'>";
            exit;
       }
 }
 if (!$found)
     {
     include "connect.inc";
     $user_email_address = sesson($user_email_address);
     $add= "INSERT INTO CC_newsletter( mail_address, time, IP) VALUES('$user_email_address','$time','$added_by_admin_label')";
     mysql_query($add) or die ($no_mail_found_error);
     $error_msg .= mysql_error();
 }
 if ($error_msg == "" ){
    echo "<tr><td>";
    $error_msg = "<p><center><b>$newsletter_member_successfully_added_label</b> </p>";
    echo $error_msg;
    echo "<meta http-equiv='refresh' content='0;URL=editnewsletter.php?op=view'>";
 }
 else
    {
     echo "<tr><td>";
     echo $member_not_added_error;
 }
 break;
 }
}
else
{
  echo $not_logged_in_label;
  include "index.php";
}
?>