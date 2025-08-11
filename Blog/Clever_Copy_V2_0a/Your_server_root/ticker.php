<?php
$getticker="SELECT * from CC_ticker";
$getticker2=mysql_query($getticker) or die($no_ticker_error);
$getticker3=mysql_fetch_array($getticker2);
$tickerspeed = $getticker3['speed'];
$news = $getticker3['ticker'];
$ffont = $getticker3['ticker_font'];
$fsize = $getticker3['ticker_font_size'];
$fcolor = $getticker3['ticker_font_color'];
echo "<font color = $fcolor size = $fsize face = $ffont>";
if ($getprefs3['blips'] =="1"){
     echo "&#9660;<marquee onmouseover=this.stop() onmouseout=this.start() scrollamount= $tickerspeed scrolldelay= '91'>$news</marquee>&#9650;";
}else{
     echo "<marquee onmouseover=this.stop() onmouseout=this.start() scrollamount= $tickerspeed scrolldelay= '91'>$news</marquee>";
}
echo "</font></center></right></left>";
echo "<br>";  
?>