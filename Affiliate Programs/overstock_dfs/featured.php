<?php

//include("includes/db.conf.php");
//include("includes/connect.inc.php");

//switch ($_GET['table']) {
switch ($this_case) {
case 1:
   $table = "booksbusinesstech";
   $template = "fea_books.tpl";
    break;
 case 2:
   $table = "booksfiction";
   $template = "fea_books.tpl";
   break;
case 3:
   $table = "booksjuvenile";
   $template = "fea_books.tpl";
   break;
case 4:
   $table = "booksmiscellaneous";
   $template = "fea_books.tpl";
   break;
case 5:
   $table = "booksnonfiction";
   $template = "fea_books.tpl";
   break;
case 6:
   $table = "bookstextbooks";
   $template = "fea_books.tpl";
   break;
case 7:
   $table = "music";
   $template = "fea_music.tpl";
   break;
case 8:
   $table = "DVD";
   $template = "fea_dvd.tpl";
   break;
case 9:
   $table = "VHS";
   $template = "fea_vhs.tpl";
   break;
case 10:
   $table = "videogames";
   $template = "fea_videogames.tpl";
   break;
case 11:
   $table = "general";
   $template = "fea_general.tpl";
   break;
case 12:
   $table = "sports_gear";
   $template = "fea_sportsgear.tpl";
   break;
case 13:
   $table = "worldstock";
   $template = "fea_worldstock.tpl";
   break;

}

$feature = file_get_contents("templates/".$template);

// No need to $dir4, it is being replaced by $dir in the file that calls
// this file.
//$dir4=str_replace("featured.php", "", "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$queryover2=mysql_query("Select * from admin  ");
$rowover2=mysql_fetch_array($queryover2);

srand(time());
$queryst = (rand()%1000);


$queryf=mysql_query("Select * from $table limit $queryst,3");
echo mysql_error();
$t1=0;
while ($rowpf=mysql_fetch_array($queryf)){
	$t1=$t1+1;

$feature = str_replace("%sku%".$t1, "$rowpf[sku]", $feature);
$feature = str_replace("%productname%".$t1, "$rowpf[productname]", $feature);
$feature = str_replace("%productshortname%".$t1, "$rowpf[productshortname]", $feature);
$feature = str_replace("%productlink%".$t1, $dir."product/$rowpf[sku]/$this_case/", $feature);
$feature = str_replace("%overid%", "$rowover2[overid]", $feature);
$feature = str_replace("%brandname%".$t1, "$rowpf[brandname]", $feature);
$feature = str_replace("%manufacturer%", "$rowpf[manufacturer]", $feature);
$feature = str_replace("%manufacturerpartno%".$t1, "$rowpf[manufacturerpartno]", $feature);
$feature = str_replace("%modelno%".$t1, "$rowpf[modelno]", $feature);
$feature = str_replace("%productdimensions%".$t1, "$rowpf[productdimensions]", $feature);
$feature = str_replace("%productmaterials%".$t1, "$rowpf[productmaterials]", $feature);
$feature = str_replace("%productorigin%".$t1, "$rowpf[productorigin]", $feature);
$feature = str_replace("%storelistname%".$t1, "$rowpf[storelistname]", $feature);
$feature = str_replace("%category%".$t1, "$rowpf[category]", $feature);
$feature = str_replace("%subcategory%".$t1, "$rowpf[subcategory]", $feature);
$feature = str_replace("%price%".$t1, "$rowpf[price]", $feature);
$feature = str_replace("%msrp%".$t1, "$rowpf[msrp]", $feature);
$feature = str_replace("%longdescription%".$t1, "$rowpf[longdescription]", $feature);
$feature = str_replace("%shortdescription%".$t1, "$rowpf[shortdescription]", $feature);
$feature = str_replace("%productquality%".$t1, "$rowpf[productquality]", $feature);
$feature = str_replace("%productwarranty%".$t1, "$rowpf[productwarranty]", $feature);
$feature = str_replace("%qtyonhand%".$t1, "$rowpf[qtyonhand]", $feature);
$feature = str_replace("%upc%".$t1, "$rowpf[upc]", $feature);
$feature = str_replace("%thumbnailimage%".$t1, "$rowpf[thumbnailimage]", $feature);
$feature = str_replace("%largeimage%".$t1, "$rowpf[largeimage]", $feature);
$feature = str_replace("%title%".$t1, "$rowpf[title]", $feature);
$feature = str_replace("%imageurl%".$t1, "$rowpf[imageurl]", $feature);
$feature = str_replace("%isbn%".$t1, "$rowpf[isbn]", $feature);
$feature = str_replace("%format%".$t1, "$rowpf[format]", $feature);
$feature = str_replace("%author%".$t1, "$rowpf[author]", $feature);
$feature = str_replace("%publisher%".$t1, "$rowpf[publisher]", $feature);
$feature = str_replace("%artist%".$t1, "$rowpf[artist]", $feature);
$feature = str_replace("%recordlabel%".$t1, "$rowpf[recordlabel]", $feature);
$feature = str_replace("%releasestudio%".$t1, "$rowpf[releasestudio]", $feature);
$feature = str_replace("%actor%".$t1, "$rowpf[actor]", $feature);
$feature = str_replace("%director%".$t1, "$rowpf[director]", $feature);
$feature = str_replace("%language%".$t1, "$rowpf[language]", $feature);
$feature = str_replace("%rating%".$t1, "$rowpf[rating]", $feature);
}
?>
