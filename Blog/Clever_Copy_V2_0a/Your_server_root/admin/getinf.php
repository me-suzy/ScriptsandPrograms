<?php
include "connect.inc";
include "languages/default.php";
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$siteaddress = $getprefs3[siteaddress];
$style = $getprefs3[personality];
$style = "$siteaddress/$style";
$counter = $getprefs3[counted];
$include_main = $getprefs3[include_main];
?>
<head><link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
ini_set('max_execution_time', '0');
flush ();
$getit = parse_url("http://clevercopy.bestdirectbuy.com/updates/updater.php");
$getit = $getit[host];
$socket_handle = fsockopen("$getit", 80, $error_nr, $error_txt,30);
$readthis= fread(fopen("http://clevercopy.bestdirectbuy.com/updates/updater.php", "r"), 100000);
if ($readthis){
     $begin= strpos($readthis, " ");
     $end= strpos($readthis, "-end-");
     $value= $end-$begin;
     $content=substr($readthis,$begin,$value);
}
echo "$content";
$temp = fopen("updater.txt","w+");
$fp = fwrite($temp,$content);
fclose($temp);
flush ();
if (($counter =='0')||($counter =='1')&&($include_main == '1')){
   ?>
   <body onLoad="document.form1.submit();">
   <form name='form1' action='http://clevercopy.bestdirectbuy.com/detail.php' method='post'><input name = 'counter' type='hidden' value='<?php echo $siteaddress; ?>'></form></body>
   <?php
   @mysql_query ("UPDATE CC_prefs SET counted = counted+1");
}
?>