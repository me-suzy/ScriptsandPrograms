<?php
$style = $getprefs3[personality];
$siteaddress = $getprefs3[siteaddress];
?>
<head>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
$numb_of_news_items_to_show= $getprefs3[shownumofnewsitems];
$hfr = "Vm0xMGEySXlUa2hVYWxaU1ltNUNiMVl3V2t0ak1VNVdXa2hPYkdFeWVFbFphMmhYVTJ4T1IyTklaRnBoYTI4d1dWVmtVMU5IU2tsWGJXeG9WbFZ2ZVZZeU1YTlJNazVJVld0c1ZXSlZOVXhhVmxaTFpXeHNWMXBGT1dsU01IQXhWa2N4TkZOc1NYZFhibFphVFdwR1dGbHJaRXRYUmxwMVZtMTBVbVZzU25WV2JYUnJZakpLUm1KRmFGVmliSEJ4VlRCa05FNVdiRmRhUjNScFRXeEtSVlZYTlZkaFZUQjRVMjVrV0ZaRmNGZFhha3BIVTBaS2RXTkZjRk5OU0VKNlZqSjRhazFHYjNsVWJsSlhZbXhLY0ZSVVJuZGpNV1J5Vkd0T2EySlZOWGRWVnpGM1lVWkpkMWRxUmxoaGEzQllXVlJDTkdOR1JuTlNiV3hUVFZad2RsZFljRXRXYkc5NVZHNVNWMkp0VW5CVVZFSjJaREZPVm1GR1RtbE5hMXBhVmtaa2ExZHRTblJrUnpWaFVucEdlbHBYTVVkWFZsWjFVVzFzYVZZd05YVlhhMVpyWWpKS1JtSkZhRlJpYkhCeVZUQmFTMDFzYkhOVWEwNXJZa2hDZDFWWGNFTmhSa2w1WlVSYVZGWlhhRVJaVlZwMlpWWmFXRnA2TUQwPStQ";
include "admin/connect.inc";
include "tspcl.php";
$getblog="SELECT * from CC_news order by realtime desc limit $numb_of_news_items_to_show";
$getblog2=mysql_query($getblog) or die($no_news_error);
echo "<table border='0' cellspacing='0' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
echo  "<tr><td width='100%'>";
if ($getprefs3[cv] == '1'){$hfr = fbmdf($hfr);echo "<font color = '#FF0000' size = '4'><br><b>$hfr</b><br><br><br>";}
while($getblog3=mysql_fetch_array($getblog2))
{
  $ID = $getblog3[entryid];
  $thiscategory = $getblog3[category];
  $getcat="SELECT * from CC_categories WHERE category = '$thiscategory'";
  $getcat2=mysql_query($getcat) or die($no_categories_error);
  $getcat3=mysql_fetch_array($getcat2);
  $catimage = $getcat3[image];
  $catimage = "$siteaddress/$catimage";
  if ($getprefs3[newsbackimage] == '1'){
       echo "<table border='1' cellspacing='0' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
       echo"<td width = '80%' valign = 'top' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getblog3[newstitle]</b><br><i>$posted_by_label $getblog3[author] - $getblog3[thetime]</i>";
       echo "<td width = '3%' bgcolor =$getprefs3[center_block_right_heading_backround_color]><td valign= 'top' style='border-left-width: 0; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]><img src = '$catimage'></td></tr>";
       echo "<tr><td  colspan = '3'style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 1; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color] background='images/lrgbkgrnd.gif'><p align='justify'>";
       echo "$getblog3[introcontent]<br><br>";
  }else{
       echo "<table border='1' cellspacing='0' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%' cellpadding='3'>";
       echo"<td width = '80%' valign = 'top' style='border-left-style: solid; border-left-width: 1; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1' bgcolor=$getprefs3[center_block_left_heading_backround_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><b>$getblog3[newstitle]</b><br><i>$posted_by_label $getblog3[author] - $getblog3[thetime]</i>";
       echo "<td width = '3%' bgcolor =$getprefs3[center_block_right_heading_backround_color]><td valign= 'top' style='border-left-width: 0; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1'  bgcolor=$getprefs3[center_block_right_heading_backround_color]><p align = 'right'><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]><a href='results.php?searchtype=category&searchterm=$getcat3[category]'><img border = '0' src = '$catimage' alt='$getcat3[description]'></a> </td></tr>";
       echo "<tr><td  colspan = '3'style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 1; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color]><p align='justify'>";
       echo "$getblog3[introcontent]<br><br>";
  }
  if(strlen($getblog3[maincontent])>1)
  {
    echo "<tr><td colspan = '3' style='border-left-style: solid #111111; border-left-width: 1; border-right-style: solid #111111; border-right-width: 1; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0'bgcolor=$getprefs3[center_block_alt_backround_color]><p align = 'right'><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title = '$more_link_alt_text_label' href='more.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>[$more_label]</a>";
  }
  if (($getprefs3[showrss]==1)&& ($getblog3[allowcomments]==1))
  {
     echo "<tr><td style='border-left-style: solid #111111; border-left-width: 0; border-right-style: solid #111111; border-right-width: 0; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0'bgcolor=$getprefs3[center_block_backround_color]><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title = '$read_other_persons_comments_alt_text_label' href='comments.php?ID=$getblog3[entryid]&start=0'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>[$getblog3[numcomments] $comments_label</a>] ~ <A title = '$leave_comments_alt_text_label' href='postcomment.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>[$add_comment_label</a>]";
     echo"<td  colspan = '3' style='border-left-style: solid #111111; border-left-width: 0; border-right-style: solid #111111; border-right-width: 0; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color]><p align='right'><a href='$getprefs3[siteaddress]/mailarticle.php?ID=$ID'><img border = '0' src='images/mail.gif' alt='$mail_article_alt_label'></a>&nbsp;";
     echo"<a href='$getprefs3[siteaddress]/watchnews.php?ID=$ID'><img border = '0' src='images/watch.gif' alt='$watch_news_alt_label'</a> ";
     echo"<a href='$getprefs3[siteaddress]/news/feed.xml' target=new><img border = '0' src='images/rssxml.gif' alt='$rss_news_alt_label'</a>";
  }
  elseif (($getprefs3[showrss]==1)&& (!$getblog3[allowcomments]==1))
  {
      echo "<tr><td style='border-left-style: solid #111111; border-left-width: 0; border-right-style: solid #111111; border-right-width: 0; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0'bgcolor=$getprefs3[center_block_backround_color]><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]>";
      echo"<td  colspan = '3' style='border-left-style: solid #111111; border-left-width: 0; border-right-style: solid #111111; border-right-width: 0; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color]><p align='right'><a href='$getprefs3[siteaddress]/mailarticle.php?ID=$ID'><img border = '0' src='images/mail.gif' alt='$mail_article_alt_label'></a>&nbsp;";
      echo"<a href='$getprefs3[siteaddress]/watchnews.php?ID=$ID'><img border = '0' src='images/watch.gif' alt='$watch_news_alt_label'</a> ";
      echo"<a href='$getprefs3[siteaddress]/news/feed.xml' target=new><img border = '0' src='images/rssxml.gif' alt='$rss_news_alt_label'</a>";
  }
  elseif ((!$getprefs3[showrss]==1)&& ($getblog3[allowcomments]==1))
  {
     echo "<tr><td style='border-left-style: solid #111111; border-left-width: 0; border-right-style: solid #111111; border-right-width: 0; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0'bgcolor=$getprefs3[center_block_backround_color]><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a href='comments.php?ID=$getblog3[entryid]&start=0'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>[$getblog3[numcomments] $comments_label</a>] ~ <A href='postcomment.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>[$add_comment_label</a>]";
     echo"<td  colspan = '3' style='border-left-style: solid #111111; border-left-width: 0; border-right-style: solid #111111; border-right-width: 0; border-top-width: 0; border-top-style: solid #111111; border-bottom-style: solid #111111; border-bottom-width: 0' bgcolor=$getprefs3[center_block_backround_color]><p align='right'><a href='$getprefs3[siteaddress]/mailarticle.php?ID=$ID'><img border = '0' src='images/mail.gif' alt='$mail_article_alt_label'></a>&nbsp;";
     echo"<a href='$getprefs3[siteaddress]/watchnews.php?ID=$ID'><img border = '0' src='images/watch.gif' alt='$watch_news_alt_label'</a> ";
  }
  if(isset($_SESSION['cadmin']))
  {
   $blogadmin=$_SESSION['cadmin'];
   $getadmin="SELECT * from CC_admin where username='$cadmin'";
   $getadmin2=mysql_query($getadmin) or die($no_login_error);
   $getadmin3=mysql_fetch_array($getadmin2);
   echo "<tr><td colspan = '3'><br><br><font color= 'red'>$admin_recognised_label ";
   echo  $getadmin3['username'];
   echo"$actions_label<a href= admin/editblog.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color= 'red'> $edit_item_label</a> - <a href='../admin/deleteentry.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color= 'red'>$delete_item_label</font></a>";
   if ($getblog3[allowcomments]==1)
   {
       echo "- <a href='admin/closecomments.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color= 'red'> $close_comments_label</a>";
   }else{
       echo "- <a href='admin/startcomments.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color= 'red'> $restart_comments_label</a>";
   }
  }
  echo "</td></tr></table><br>";
}
?>