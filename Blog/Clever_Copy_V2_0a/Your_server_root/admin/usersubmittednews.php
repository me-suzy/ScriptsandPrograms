<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
include "connect.inc";
?>
<head>
<title><?php echo $user_news_approve_title; ?></title>
<script>
<!-- Begin
function goTorefreshURL() { window.location = "usersubmittednews.php"; }
//  End -->
</script>
<script language="JavaScript">
<!-- Begin
function win() { window.open("../feed.php","","scroll = 'yes' height=800,width=600,left=10,top=10");
}
// End -->
</script>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head> ";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if (($getadmin3['status']==3)||($getadmin3['status']==2))
{
      include "index.php";
      $query =  ("SELECT * FROM CC_vposted_news ORDER By ID ASC") or die($no_news_found_error);
      $result = mysql_query($query);
      $siteemail = registre($getprefs3['siteemail']);
      echo "<br><br>";
      echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
      echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='3'><left>";
      echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$approve_user_news_postings_label</font></b></center></td></tr>";
      while( $row = mysql_fetch_array( $result ) )
      {
                  echo "<form action='usersubmittednews.php?op=approve_this_item' method='post'>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$admin_id_label</b> ";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo $row[ "ID" ];
                  echo "<input type='hidden' name='ID' value='$row[ID]'>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$news_posted_username_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo $row[ "vname" ];
                  echo "<input type='hidden' name='author' value='$row[vname]'>";
                  echo "<input type='hidden' name='submitter' value='$row[vname]'>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$current_ip_address_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo"<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title= \"$trace_label\" href='queryindex.php?query=$row[ip_address]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$row[ip_address]</a></font>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='middle'>";
                  echo "<b>$category_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='middle'><br>";
                  echo "<select name='category'>";
                  $getcat="SELECT * from CC_categories";
                  $getcat2=mysql_query($getcat) or die($no_categories_error);
                  while($getcat3=mysql_fetch_array($getcat2))
                  {
                     echo "<option value=\"" . $getcat3[ "category" ] . "\">". $getcat3[ "category" ] . "</option>\n";
                  }
                  echo "</select><br>";
                  echo "<tr><td  bgcolor=$getprefs3[block_background_color] colspan = '3'>&nbsp;<br><br>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$the_main_temp_title_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<textarea rows='2' name='title' cols='80'>$row[vtitle]</textarea>";
                  echo "<tr><td  bgcolor=$getprefs3[block_background_color] colspan = '3'>&nbsp;<br><br>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$the_main_temp_news_label</b>";
                  $posteraddy = sesson($row[vmail]);
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  if ((($row['showurl']) == '1') && (($row['showmail']) == '1')){
                        echo "<textarea rows='10' name='introcontent' cols='80'><i>$post_submitted_by_label  $row[vname] - <a title='$poster_www_alt_text' href='http://$row[vurl]' target='_new'><img border='0' src='images/posterwww.gif'width='15' height='15'></a> - <a title='$poster_mail_alt_text' href='mailposter.php?ad=$posteraddy'><img border = '0' src='images/postermail.gif'width='15' height='15'></a></i><br>------------------------<br><br> $row[newspost]</textarea>";
                  }elseif ((($row['showurl']) == '1') && ((!$row['showmail']) == '1')){
                        echo "<textarea rows='10' name='introcontent' cols='80'><i>$post_submitted_by_label  $row[vname] - <a title='$poster_www_alt_text' href='http://$row[vurl]' target='_new'><img border='0' src='images/posterwww.gif'width='15' height='15'></a></i><br>------------------------<br><br> $row[newspost]</textarea>";
                  }elseif (((!$row['showurl']) == '1') && (($row['showmail']) == '1')){
                        echo "<textarea rows='10' name='introcontent' cols='80'><i>$post_submitted_by_label  $row[vname] - <a title='$poster_mail_alt_text' href='mailposter.php?ad=$posteraddy'><img border = '0' src='images/postermail.gif'width='15' height='15'></a></i><br>------------------------<br><br> $row[newspost]</textarea>";
                  }else{
                        echo "<textarea rows='10' name='introcontent' cols='80'><i>$post_submitted_by_label  $row[vname]</i><br>------------------------<br><br> $row[newspost]</textarea>";
                  }
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$the_ext_temp_news_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<textarea rows='10' name='maincontent' cols='80'>$row[ext_post]</textarea>";
                  echo "<tr><td  bgcolor=$getprefs3[block_background_color] colspan = '3'>&nbsp;<br><br>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$temp_news_posters_mail_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  $mailaddy = ($row['vmail']);
                  echo "<input type='hidden' name='authmail' value='$row[vmail]'>";
                  echo "<a href='mailto:$mailaddy?subject=$news_posted_mail_subject_label $sitename'>$mailaddy</a>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$temp_news_posters_url_label</b>";
                  echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  $urladdy = ($row['vurl']);
                  echo "<input type='hidden' name='authweb' value='$row[vurl]'>";
                  echo "<a target='_blank' href='http://$urladdy'>$urladdy</a>";
                  echo "<tr><td  bgcolor=$getprefs3[block_background_color] colspan = '3'>&nbsp;<br><br>";
                  echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                  echo "<b>$temp_news_posters_show_mail_label</b>";
                  echo "<td width='5%'  bgcolor=$getprefs3[block_background_color] valign='top' colspan = '2'>";
                  if (($row['showmail']) == '1')
                  {
                        $showmailtemp = $yes_label;
                  }else{
                        $showmailtemp = $no_label;
                  }
                 echo $showmailtemp;
                 echo "<td width='85%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo "<b>$temp_news_posters_show_url_label</b>";
                 echo "<td width='5%' bgcolor=$getprefs3[block_background_color] valign='top' colspan = '2'>";
                 if (($row['showurl']) == '1')
                 {
                       $showurltemp = $yes_label;
                 }else{
                       $showurltemp = $no_label;
                 }
                 echo $showurltemp;
                 echo "<td width='85%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo "<tr><td colspan = '3'>";
                 echo "<img src = '../images/information.gif'> $poster_info_label";
                 echo "<tr><td  bgcolor=$getprefs3[block_background_color] colspan = '3'>&nbsp;<br><br>";
                 echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo "<b>$allow_comments_on_post_label</b>";
                 echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo "<select name='allowcomments'>";
                 echo "<option value= '1'>$yes_label</option>";
                 echo "<option value= '0'>$no_label</option>";
                 echo "<tr><td width='10%' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo "<b>$temp_news_posters_comments_to_admin_label</b>";
                 echo "<td width='90%' colspan = '2' bgcolor=$getprefs3[block_background_color] valign='top'>";
                 echo ($row["vis_admin_notes"]);
                 echo "<br><br>";
                 echo "<tr><td bgcolor=$getprefs3[block_background_color] valign ='bottom' width = '10%'><br><input type='submit' value=$approve_button_label name='B1'class = 'buttons'><input type='hidden' name='ID' value='$row[ID]'></form>";
                 echo "<td valign ='bottom' width = '10%'><br>";
                 echo "<form action='usersubmittednews.php?op=delete_this_item' method='post'>";
                 echo "<input type='submit' value='$delete_this_admin_button_label' name='del' class = 'buttons'><input type='hidden' name='ID' value='$row[ID]'></form>";
                 echo "<form action='ban.php' method='post'>";
                 echo "<input type='submit' value='$ban_this_ip_address_label' name='ban' class = 'buttons'><input type='hidden' name='ip_address' value='$row[ip_address]'></form>";
                 echo "<tr><td  bgcolor=$getprefs3[block_background_color] colspan = '3'>&nbsp;<br><hr>";
      }
      switch( $_GET[ 'op' ] )
      {
               case "mail_this_item":
               include "connect.inc";
               $destination_email = $_POST[destination_email];
               $submitter = $_POST[submitter];
               $was_news_posted_subject = $_POST[was_news_posted_subject];
               $your_news_is_postedordeclined_label  = $_POST[was_news_postedordeclined];
               $goto_site_label = $getprefs3['siteaddress'];
               $sitetitle = $getprefs3['title'];
               if($HTTP_POST_VARS)
               {
                 mail("$destination_email","$was_news_posted_subject","$submitter$your_news_is_postedordeclined_label\n\n$goto_site_label\n\n$invoice_mail_signature_label $sitetitle","FROM: $siteemail");
                 echo $email_sent_label;
                 echo "<meta http-equiv='refresh' content='0;URL=usersubmittednews.php'>";
               }
               break;

               case "delete_this_item":
               include "connect.inc";
               include "languages/default.php";
               $ID=$_POST['ID'];
               $was_news_posted = $news_has_not_been_posted_subject;
               $was_news_postedordeclined = $your_news_was_not_posted_label;
               $goto_site_label = "";
               $query =  ("SELECT * FROM CC_vposted_news WHERE ID='$ID'") or die($no_news_found_error);
               $result = mysql_query($query);
               while( $row = mysql_fetch_array( $result ) )
               {
                  $submitter = ($row['vname']);
                  $destination_email = ($row['vmail']);
               }
               $delentry="DELETE from CC_vposted_news where ID='$ID'";
               mysql_query($delentry) or die($problem_deleting_vpost_error);
               echo "<center><b>$post_deleted_success_label</b>";
               echo "<br>$submitter_has_requested_notification_label $would_you_like_to_mail_user $submitter";
               echo "<form name='theform' action='usersubmittednews.php?op=mail_this_item' method='post'>";
               echo "<input type='hidden' name='submitter' value = $submitter><br>";
               echo "<input type='hidden' name='was_news_posted_subject' value='$news_has_not_been_posted_subject'>";
               echo "<input type='hidden' name='was_news_postedordeclined' value='$was_news_postedordeclined'>";
               echo "<input type='hidden' name='goto_site_label'value='$goto_site_label'>";
               echo "<input type='hidden' name='destination_email' value='$destination_email'>";
               echo "<input type='submit' name='submit' value='$mail_user_details_button_label $submitter' class = 'buttons'>";
               echo "</form>";
               break;

               case "approve_this_item":
               include "connect.inc";
               include "languages/default.php";
               $ID=$_POST['ID'];
               $author=$cadmin;
               $submitter = $_POST['submitter'];
               $category = $_POST['category'];
               $introcontent=$_POST['introcontent'];
               $maincontent=$_POST['maincontent'];
               $authmail=$_POST['authmail'];
               $authweb=$_POST['authweb'];
               $showemail=$_POST['showemail'];
               $showurl=$_POST['showurl'];
               $allowcomments=$_POST['allowcomments'];
               $title=$_POST['title'];
               if ($getprefs3[dateset] =="1"){
                    $theoffset = $getprefs3[time_offset];
                    $theoffset = ($theoffset *'60');
                    $thetime=date("D M d Y - H:i",time() + $theoffset);
               }else{
                     $theoffset = $getprefs3[time_offset];
                     $theoffset = ($theoffset *'60');
                     $thetime=date("D d M Y - H:i",time() + $theoffset);
               }
               $realtime=date("U");
               $month=date("n");
               $year=date("Y");
               $goto_site_label = $getprefs3[siteaddress];
               $was_news_posted = $news_has_been_posted_subject;
               $was_news_postedordeclined = $your_news_is_posted_label;
               @mysql_query ("INSERT INTO CC_news (category,month,year,thetime,realtime,newstitle,author,introcontent,maincontent,authmail,authweb,showemail,showurl,allowcomments) VALUES ('$category','$month','$year','$thetime','$realtime','$title','$author','$introcontent','$maincontent','$authmail','$authweb','$showemail','$showurl','$allowcomments')");
               $error_msg .= mysql_error();
               if( $error_msg == "" ) {
                    $error_msg = "<center><b>$your_news_posted_ok_label</b><br><br>";
                    $delentry="DELETE from CC_vposted_news where ID='$ID'";
                    mysql_query($delentry) or die($problem_deleting_vpost_error);
               }else{
                    echo $error_msg;
                    $error_msg = "<center><b>$your_news_notposted_ok_label</b><br><br>";
                    echo $error_msg;
                    exit;
               }
               if ($getprefs3[showrss] == '1')
               {
                  echo "<b>$your_news_posted_ok_label</b>";
                  echo "<body onload=\"window.open('../feed.php')\">";
               }else{
                  echo "<b>$your_news_posted_ok_no_rss_label</b>";
               }
               echo "<br><b>$submitter_has_requested_notification_label $would_you_like_to_mail_user $submitter</b>";
               echo "<form name='theform' action='usersubmittednews.php?op=mail_this_item' method='post'>";
               echo "<input type='hidden' name='submitter' value = $submitter><br>";
               echo "<input type='hidden' name='destination_email'value='$authmail'>";
               echo "<input type='hidden' name='goto_site_label'value='$goto_site_label'>";
               echo "<input type='hidden' name='was_news_postedordeclined' value='$was_news_postedordeclined'>";
               echo "<input type='hidden' name='was_news_posted_subject' value='$news_has_been_posted_subject'>";
               echo "<input type='submit' name='submit' value='$mail_user_details_button_label $submitter' class = 'buttons'>";
               echo "</form>";
               break;
      }
      echo "</tr></td></table>";
      echo "<input type=button value='$refresh_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
}else
 {
  echo $no_login_error;
  include "index.php";
}
?>