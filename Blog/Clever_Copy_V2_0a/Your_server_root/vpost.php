<?php
session_start();
include "admin/connect.inc";
include "antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
?>
<head><title>Clever Copy - Post News</title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
$ip_address = getenv("REMOTE_ADDR");
include "languages/default.php";
include "admin/languages/default.php";
echo "<body bgcolor=$getprefs3[block_background_color]>";
include "banned.php";
if(isset($_SESSION['cuser'])){
   $bloguser=$_SESSION['cuser'];
   $getuser="SELECT * from CC_users where username='$bloguser'";
   $getuser2=mysql_query($getuser) or die($no_login_error);
   $getuser3=mysql_fetch_array($getuser2);
   $visitor_name =  $getuser3[user_site_name];
}
if(isset($_POST['submit']))
   {
   if ((strlen($_POST['vismail']) <6) || (strlen($_POST['visname']) <1) || (strlen($_POST['visnewspost']) <1)){
         echo "<table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse'  bordercolor=$getprefs3[blockbordercolor] width='100%'>";
         echo "<tr><td width='100%'><p align='center'><b>$no_news_post_details_error</b></td></tr><tr></p>";
         echo "<td width='100%'><p align='center'>$taking_you_back_label <A href='visitorpostnews.php'>$click_here_label</a></td></tr></p></table>";
         echo "<meta http-equiv='refresh' content='3;URL=visitorpostnews.php'>";
         exit;
   }
   $ext_post=antihax($_POST['visext_post']);
   $vname=antihax($_POST['visname']);
   $vmail=antihax($_POST['vismail']);
   $vurl=antihax($_POST['visurl']);
   $category=antihax($_POST['category']);
   $newspost=antihax($_POST['visnewspost']);
   $ext_post=antihax($_POST['visext_post']);
   $vis_admin_notes=antihax($_POST['vis_admn_notes']);
   $showmail=$_POST['showmail'];
   $showurl=$_POST['showurl'];
   $vtitle=antihax($_POST['vtitle']);
   $posttempnews="INSERT INTO CC_vposted_news (category, ip_address,vtitle,showurl,showmail, vis_admin_notes, ext_post, newspost, vurl, vmail, vname) VALUES ('$category','$ip_address','$vtitle','$showurl','$showmail', '$vis_admin_notes','$ext_post','$newspost','$vurl','$vmail','$vname')";
   mysql_query($posttempnews) or die($news_not_sent_error);
   echo "<center>$news_sent_label";
   echo "<meta http-equiv='refresh' content='2;URL=index.php?'>";
   echo "<center>$if_you_see_label <a href='index.php'>$click_here_label</a>";
}
else
   {
   $getvnews="SELECT * from CC_vposted_news";
   $getvnews2=mysql_query($getvnews) or die("Unable to retrieve visitor posted news details from database");
   $getvnews3=mysql_fetch_array($getvnews2);
   echo "<table border='0' cellpadding='1' cellspacing='0' style='border-collapse: collapse;' bordercolor=$getprefs3[blockbordercolor] width='100%'>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'><font color = 'red'>* </font> $required_label";
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'><br><br>";
   echo "<tr><td valign = 'top' colspan = '2' bgcolor=$getprefs3[block_background_color] ><img src = 'images/information.gif'> $no_html_allowed_label<br><br>";
   echo "<tr><td valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo "<form action='vpost.php' method='post'>";
   if ($_SESSION['cuser'])
   {
      $mailaddy = registre($getuser3[user_email_address]);
      $wwaddy = $getuser3[website];
      echo "$vis_post_news_name_label<font color = 'red'>* </font>";
      echo "<td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '80%'>";
      echo "<input type ='text'  name='visname' size='40' value='$visitor_name'>";
      echo "<tr><td bgcolor=$getprefs3[block_background_color] width= '20%'>";
      echo "$vis_post_news_mail_label<font color = 'red'>* </font>";
      echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
      echo "<input type='text' name='vismail' size='40' value = '$mailaddy'>";
      echo "<tr><td bgcolor=$getprefs3[block_background_color] width= '20%'>";
      echo $vis_post_news_url_label;
      echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
      echo "<input type='text' name='visurl' size='40' value='$wwaddy'>";
   }else{
      echo "$vis_post_news_name_label<font color = 'red'>* </font>";
      echo "<td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '80%'>";
      echo "<input type ='text'  name='visname' size='40'>";
      echo "<tr><td bgcolor=$getprefs3[block_background_color] width= '20%'>";
      echo "$vis_post_news_mail_label<font color = 'red'>* </font>";
      echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
      echo "<input type='text' name='vismail' size='40'>";
      echo "<tr><td bgcolor=$getprefs3[block_background_color] width= '20%'>";
      echo $vis_post_news_url_label;
      echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
      echo "<input type='text' name='visurl' size='40' value='http://'>";
   }

   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo "Choose a suitable category";
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<select name='category'>";
   $getcat="SELECT * from CC_categories";
   $getcat2=mysql_query($getcat) or die($no_categories_error);
   while($getcat3=mysql_fetch_array($getcat2))
   {
        echo "<option value=\"" . $getcat3[ "category" ] . "\">". $getcat3[ "category" ] . "</option>\n";
   }
   echo "</select><br><br>";

   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo "$vis_post_news_title_label<font color = 'red'>* </font>";
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<input type ='text'  name='vtitle' size='61'>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo "$vis_post_news_main_label<font color = 'red'>* </font>";
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<textarea name=visnewspost rows=7 cols=60></textarea>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo $vis_post_news_ext_label;
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<textarea name=visext_post rows=7 cols=60></textarea>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo $vis_post_news_note_label;
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<textarea name=vis_admn_notes rows=4 cols=60></textarea>";
   echo "<tr><td colspan = '3'>&nbsp;<br>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo $show_email_vpost_label;
   echo "<td valign = 'top' bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<select name='showmail'>";
   echo "<option value= '0'>$no_label</option>";
   echo "<option value= '1'>$yes_label</option>";
   echo "</select>";
   echo "<tr><td colspan = '3'>&nbsp;<br>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo $show_url_vpost_label;
   echo "<td valign = 'top' bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<select name='showurl'>";
   echo "<option value= '1'>$yes_label</option>";
   echo "<option value= '0'>$no_label</option>";
   echo "</select>";
   echo "<tr><td  valign = 'top' bgcolor=$getprefs3[block_background_color] width= '20%'>";
   echo "<td bgcolor=$getprefs3[block_background_color] width= '80%'>";
   echo "<br><input type='submit' value='$visitor_post_news_button_label' name='submit' class = 'buttons' </form>";
}
?>