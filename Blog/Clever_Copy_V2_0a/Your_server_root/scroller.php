<?php
include "languages/default.php";
$getscroller="SELECT * from CC_scroller";
$getscroller2=mysql_query($getscroller) or die($no_scroller_error);
$getscroller3=mysql_fetch_array($getscroller2);
$speed = $getscroller3['sspeed'];
$news = $getscroller3['stext'];
$direction = $getscroller3['sdirection'];
echo "<marquee direction= $direction onmouseover=this.stop() onmouseout=this.start()  scrollamount= $speed scrolldelay= '100'><center>$news</marquee>";
echo "</center>";
?>