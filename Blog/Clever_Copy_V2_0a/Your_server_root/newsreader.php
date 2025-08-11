<?php
ini_set('max_execution_time', '0');
flush ();
$getit = parse_url("http://develop.bestdirectbuy.com/news/syndicate.php");
$getit = $getit[host];
@$socket_handle = fsockopen("$getit", 80, $error_nr, $error_txt,30);
@$readthis= fread(fopen("http://develop.bestdirectbuy.com/news/syndicate.php", "r"), 100000);
if ($readthis){
     $begin= strpos($readthis, " ");
     $end= strpos($readthis, "-end-");
     $value= $end-$begin;
     $content=substr($readthis,$begin,$value);
     echo "<marquee direction= up onmouseover=this.stop() onmouseout=this.start()  scrollamount= 3 scrolldelay= '100'>$content</marquee>";
}else{
     echo "<marquee direction= up onmouseover=this.stop() onmouseout=this.start()  scrollamount= 3 scrolldelay= '100'>There is a problem. I am unable to get the currently syndicated news feed</marquee>";
}
?>