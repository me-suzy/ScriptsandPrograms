<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
$status = '0';
include "languages/default.php";
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status2.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
if (!is_dir( "../admin" ))
{
  echo "<font color = '#000000'>$admin_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../admin/items" ))
{
  echo "<font color = '#000000'>$admin_items_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../admin/languages" ))
{
  echo "<font color = '#000000'>$admin_languages_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../banners" ))
{
  echo "<font color = '#000000'>$banners_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../downloads" ))
{
  echo "<font color = '#000000'>$downloads_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../gallery" ))
{
  echo "<font color = '#000000'>$gallery_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../gallery/photos" ))
{
  echo "<font color = '#000000'>$gallery_photos_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../gallery/photos/buttons" ))
{
  echo "<font color = '#000000'>$gallery_photos_buttons_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../gallery/photos/thumb" ))
{
  echo "<font color = '#000000'>$gallery_photos_thumb_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../images" ))
{
  echo "<font color = '#000000'>$images_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../images/admin" ))
{
  echo "<font color = '#000000'>$images_admin_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../languages" ))
{
  echo "<font color = '#000000'>$languages_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../news" ))
{
  echo "<font color = '#000000'>$news_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../newsletter" ))
{
  echo "<font color = '#000000'>$newsletter_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../personalities" ))
{
  echo "<font color = '#000000'>$personality_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../poll" ))
{
  echo "<font color = '#000000'>$poll_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../randompics" ))
{
  echo "<font color = '#000000'>$ranpics_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../randomquotes" ))
{
  echo "<font color = '#000000'>$ranquotes_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../stats" ))
{
  echo "<font color = '#000000'>$stats_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../tag" ))
{
  echo "<font color = '#000000'>$tag_missing<br><br>";
  $status = '1';
}
if (!is_dir( "../tag/smilies" ))
{
  echo "<font color = '#000000'>$tag_smilies_missing<br><br>";
  $status = '1';
}
if(!is_writable("../admin"))
{
  echo "<font color = '#404040'>admin $directory_unwrite<br><br>";
  $status = '1';
}
if(!is_writable("../admin/items"))
{
  echo "<font color = '#404040'>admin/items $directory_unwrite<br><br>";
  $status = '1';
}
if(!is_writable("../gallery"))
{
  echo "<font color = '#404040'>gallery $directory_unwrite<br><br>";
  $status = '1';
}
if(!is_writable("../gallery/photos"))
{
  echo "<font color = '#404040'>gallery/photos $directory_unwrite<br><br>";
  $status = '1';
}
if(!is_writable("../news"))
{
  echo "<font color = '#404040'>news $directory_unwrite<br><br>";
  $status = '1';
}
if(!is_writable("../stats"))
{
  echo "<font color = '#404040'>stats $directory_unwrite<br><br>";
  $status = '1';
}
if ($status == '0')
{
     echo "<br><img src = 'ok.gif'> $status_ok";
     echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>$dirs_ok";
     echo "<form action='conf.php' method='post'>";
     echo "&nbsp;$sitepath_n<br>";
     echo "&nbsp;<input type='text' name='siteaddy' size='70'><br> $sitepath_exp<br><br>";
     echo "&nbsp;$hostname<br>";
     echo "&nbsp;<input type='text' name='host' size='30' value = 'localhost'> $localhost_exp<br><br>";
     echo "&nbsp;$database_n<br>";
     echo "&nbsp;<input type='text' name='dbase' size='30' > $dbase_exp<br><br>";
     echo "&nbsp;$uname<br>";
     echo "&nbsp;<input type='text' name='user' size='30'> $uname_exp<br><br>";
     echo "&nbsp;$pass_w<br>";
     echo "&nbsp;<input type='text' name='pass' size='30'>  $pass_w_exp<br><br>";
     echo "&nbsp;$con_p<br>";
     echo "&nbsp;<input type='text' name='pass2' size='30'><br><br>";
     echo "<br><input type='submit' name='submit' value='$next' class = 'buttons'></form>";
     echo "<tr><td valign = 'bottom'><br><form action='install.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
}else{
     echo "<br><img src = 'notok.gif'> $status_notok";
     echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>$problem_found";
     echo "<br><br>$chmod_errors <a href='http://liquidfrog.bestdirectbuy.com' target='_new'>$this_site</a> $new_window";
     echo "<tr><td colspan = '2' valign = 'bottom'><br><br><form action='install.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
}
?>