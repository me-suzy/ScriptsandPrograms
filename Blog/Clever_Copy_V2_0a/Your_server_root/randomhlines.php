<?php
session_start();
include "languages/default.php";
include "admin/languages/default.php";
include "admin/connect.inc";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$ctr = '0';
$getthisnews="SELECT * from CC_news";
$getthisnews2=mysql_query($getthisnews) or die($no_news_error);
while($getthisnews3=mysql_fetch_array($getthisnews2))
{
  $id = $getthisnews3[entryid];
  if ($rannewsctr <= $id)
  {
    $rannewsctr = $id;
  }
}
srand((double)microtime()*1000000);
$thisrdm = rand(0,$rannewsctr);
srand((double)microtime()*30000);
$thisrdm = rand(0,$thisrdm);
for ($limiter = 0; $limiter <= ($show_numrandom_headlines-1); $limiter +=1)
{
  $rnewsquery = "SELECT * FROM CC_news WHERE entryid = '$thisrdm'";
  $rnewsresult = mysql_query($rnewsquery) or die($no_news_error);
  if (mysql_affected_rows() > 0)
  {
      $gettheblog="SELECT * from CC_news where entryid = '$thisrdm'";
      $gettheblog2=mysql_query($gettheblog) or die($no_news_error);
      while($gettheblog3=mysql_fetch_array($gettheblog2))
      {
         $the_news = $gettheblog3['newstitle'];
         echo "$the_news<br>";
         echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title = '$more_link_alt_text_label' href='more.php?ID=$gettheblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>[$more_label]</a></font><br><br>";
         $lastrdm = $thisrdm;
         srand((double)microtime()*100);
         $rndm = rand(0,15);
         $thisrdm = $thisrdm+$rndm;
         if ($thisrdm = $lastrdm)
         {
            $thisrdm=$thisrdm+11;
         }
      }
  }
  else
  {
    $limiter = $limiter-1;
    $thisrdm=$thisrdm+4;
  }
  if ($thisrdm >= $rannewsctr)
  {
    $thisrdm = '0';
  }
}
?>