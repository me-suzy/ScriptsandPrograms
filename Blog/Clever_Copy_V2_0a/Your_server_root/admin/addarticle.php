<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
$siteaddress = $getprefs3[siteaddress];
$siteaddress = "$siteaddress/";
?>
<head>
<script language="JavaScript">
<!-- Begin
function win() { window.open("../feed.php","","scroll = 'yes' height=800,width=600,left=10,top=10");
}
// End -->
</script>
</head>
<?php
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   if(isset($_POST['submit']))
   {
     if(strlen($_POST['title'])<1)
     {
       echo $no_title_given_error_label;
     }
     else if(strlen($_POST['short'])<1)
     {
       echo $no_news_given_error_label;
     }
     else
     {
       $title=antihaxmjr($_POST['title']);
       $short=antihaxmjr($_POST['short']);
       $long=antihaxmjr($_POST['long']);
       $category=$_POST['category'];
       $allow=$_POST['allow'];
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
       $query = ("SELECT * FROM CC_news") or die ($no_news_error);
       $result = mysql_query($query);
       $num_results = mysql_num_rows($result);
       while($row = mysql_fetch_array( $result ))
       {
               $last_id = $row[entryid];
               $last_id++;
       }
       $url = "$getprefs3[siteaddress]/more.php?ID=$last_id";
       $siteurl = "$getprefs3[siteaddress]/more.php?ID=$last_id";
       $siteemail = registre($getprefs3[siteemail]);
       $postnews= "INSERT into CC_news(category, url,author,newstitle,thetime,realtime,introcontent,maincontent,allowcomments,month,year) values('$category','$url','$cadmin','$title','$thetime','$realtime','$short','$long','$allow','$month','$year')";
       mysql_query($postnews)or die($no_news_error);
       $siteaddress = substr($getprefs3[siteaddress],7);
       $title = $getprefs3[title];
       $title = str_replace(" ","+",$title);

       if($getprefs3[showrss]==1)
       {
          echo "<b>$your_news_posted_ok_label</b>";
          echo "<body onload=\"window.open('$getprefs3[siteaddress]/feed.php')\">";
       }else{
           echo "<b>$your_news_posted_ok_no_rss_label</b>";
       }
      }
      $ping = "http://pingomatic.com/ping/?title=$title&blogurl=http%3A%2F%2F$siteaddress&chk_weblogscom=on&chk_blogs=on&chk_technorati=on&chk_feedburner=on&chk_syndic8=on&chk_newsgator=on&chk_feedster=on&chk_myyahoo=on&chk_pubsubcom=on&chk_blogdigger=on&chk_blogrolling=on&chk_blogstreet=on&chk_moreover=on&Submit=Submit+Pings+%C2%BB";
      echo "<b><br><br><a href='$ping' target='_new'>$generate_ping_label</a><br><br></b>";
      $nwsctr =  0;
      $tellwatchers="SELECT * from CC_watch";
      $tellwatchers2=mysql_query($tellwatchers) or die($no_watchers_error);
      while($tellwatchers3=mysql_fetch_array($tellwatchers2))
      {
           $stopaddress = sesson($tellwatchers3[address]);
           $updateurl = "$getprefs3[siteaddress]";
           $siteurl = "$getprefs3[siteaddress]/stopwatching.php?ID=$stopaddress";
           $useraddress = $tellwatchers3[address];
           @mail("$useraddress","$sitename $update_watchers_updated_mail_subject","$update_watchers_updated_mail_body\n\n$updateurl\n\n$update_watchers_updated_mail_body_second\n$siteurl","FROM: $siteemail");
      }
      $getblog="SELECT * from CC_news";
      $getblog2=mysql_query($getblog) or die($no_news_error);
      while($getblog3=mysql_fetch_array($getblog2))
      {
           $nwsctr++;
      }
      $fromend = ($nwsctr-5);
      $getblog="SELECT * from CC_news order by realtime ASC limit $fromend, 5";
      $getblog2=mysql_query($getblog) or die($no_archives_error);
      while($getblog3=mysql_fetch_array($getblog2))
      {
           $entryid = $getblog3[entryid];
           $title = $getblog3[newstitle];
           $short = $getblog3[introcontent];
           $short = substr($short,0,240 );
           $url = "$getprefs3[siteaddress]/more.php?ID=$entryid";
           $content = "<b>$title</b><br><br>$short...<br><a title = '$newsreader_alt_text_label' href='$url' target='_new'>[$readmore_label]</a><br>_______________<br><br>$content";
      }
      $file = fopen( "../news/syndicate.php", "w" );
      if ($file)
      {
           fputs($file," <b>$latest_news_newsreader_label $getprefs3[title]</b><br>------------------------<br>$content-end-");
           fclose($file);
           chmod("../news/syndicate.php", 0644);
      }else{
           echo "<br>$cannot_write_newsreader_file_error_label";
      }
   }else{
     echo "<center><font color = 'red'>*</font> $required_field_label<br><br>";
     echo "<form action='addarticle.php' method='post' name='form'>";
     echo "<font color = 'red'>*</font> $the_main_temp_title_label<br>";
     echo "<input type='text' name='title' size='80'><br><br>";
     echo "<font color = 'red'>*</font> $short_text_description_label<br>";
     echo "<textarea name='short' rows='10' cols='100'></textarea><br><br>";
     echo "$long_text_description_label<br>";
     echo "<textarea name='long' rows='12' cols='100'></textarea><br><br>";
     echo "$choose_category_for_this_item_label<br>";
     echo "<select name='category'>";
     $getcat="SELECT * from CC_categories";
     $getcat2=mysql_query($getcat) or die($no_categories_error);
     while($getcat3=mysql_fetch_array($getcat2))
     {
        echo "<option value=\"" . $getcat3[ "category" ] . "\">". $getcat3[ "category" ] . "</option>\n";
     }
     echo "</select><br><br>";
     echo "$allow_comments_for_this_item_label<br>";
     echo "<select name='allow'>";
     echo "<option value='1'>$yes_label</option>";
     echo "<option value='0'>$no_label</option></select><br><br><br>";
     echo "<input type='submit' name='submit' value='$post_this_news_item_button_label' class = 'buttons'></form>";
   }
   echo "</td></tr></table>";
}else{
  echo $no_login_error;
  include "index.php";
  echo "</td></tr></table>";
}
?>