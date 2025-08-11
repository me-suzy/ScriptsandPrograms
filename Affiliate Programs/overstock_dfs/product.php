<?php
include("includes/db.conf.php");
include("includes/connect.inc.php");

switch ($_GET['tab']) {
case 1:
   $table = "booksbusinesstech";
   $template = "pro_books.tpl";
   break;
 case 2:
   $table = "booksfiction";
   $template = "pro_books.tpl";
   break;
case 3:
   $table = "booksjuvenile";
   $template = "pro_books.tpl";
   break;
case 4:
   $table = "booksmiscellaneous";
   $template = "pro_books.tpl";
   break;
case 5:
   $table = "booksnonfiction";
   $template = "pro_books.tpl";
   break;
case 6:
   $table = "bookstextbooks";
   $template = "pro_books.tpl";
   break;
case 7:
   $table = "music";
   $template = "pro_music.tpl";
   break;
case 8:
   $table = "dvd";
   $template = "pro_dvd.tpl";
   break;
case 9:
   $table = "vhs";
   $template = "pro_vhs.tpl";
   break;
case 10:
   $table = "videogames";
   $template = "pro_videogames.tpl";
   break;
case 11:
   $table = "general";
   $template = "pro_general.tpl";
   break;
case 12:
   $table = "sportsgear";
   $template = "pro_sportsgear.tpl";
   break;
case 13:
   $table = "worldstock";
   $template = "pro_worldstock.tpl";
   break;

}
//$dir3=str_replace("product.php", "", "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
$relative = $_SERVER['PHP_SELF'];
$slash_position = strrchr($relative, "/");
$path = "/" . substr($relative, 0, $slash_position);
$dir= "http://" . $_SERVER['HTTP_HOST'] . $path;

$des = file_get_contents("templates/".$template);   
include_once("navigation.php");
$nav = $menu;
$this_case = $_GET[tab];
include_once("featured.php");
$fea = $feature;

$queryp=mysql_query("Select * from $table where sku='$_GET[id]'");
$rowp=mysql_fetch_array($queryp);
$queryover=mysql_query("Select * from admin where id='1' ");
$rowover=mysql_fetch_array($queryover);

        
$des = str_replace("%sku%", "$rowp[sku]", $des);
$des = str_replace("%productname%", "$rowp[productname]", $des);
$des = str_replace("%productshortname%", "$rowp[productshortname]", $des);
$des = str_replace("%overid%", "$rowover[overid]", $des);
$des = str_replace("%brandname%", "$rowp[brandname]", $des);
$des = str_replace("%manufacturer%", "$rowp[manufacturer]", $des);
$des = str_replace("%manufacturerpartno%", "$rowp[manufacturerpartno]", $des);
$des = str_replace("%modelno%", "$rowp[modelno]", $des);
$des = str_replace("%productdimensions%", "$rowp[productdimensions]", $des);
$des = str_replace("%productmaterials%", "$rowp[productmaterials]", $des);
$des = str_replace("%productorigin%", "$rowp[productorigin]", $des);
$des = str_replace("%storelistname%", "$rowp[storelistname]", $des);
$des = str_replace("%category%", "$rowp[category]", $des);
$des = str_replace("%subcategory%", "$rowp[subcategory]", $des);
$des = str_replace("%price%", "$rowp[price]", $des);
$des = str_replace("%msrp%", "$rowp[msrp]", $des);
$des = str_replace("%longdescription%", "$rowp[longdescription]", $des);
$des = str_replace("%shortdescription%", "$rowp[shortdescription]", $des);
$des = str_replace("%productquality%", "$rowp[productquality]", $des);
$des = str_replace("%productwarranty%", "$rowp[productwarranty]", $des);
$des = str_replace("%qtyonhand%", "$rowp[qtyonhand]", $des);
$des = str_replace("%upc%", "$rowp[upc]", $des);
$des = str_replace("%thumbnailimage%", "$rowp[thumbnailimage]", $des);
$des = str_replace("%largeimage%", "$rowp[largeimage]", $des);
$des = str_replace("%title%", "$rowp[title]", $des);
$des = str_replace("%imageurl%", "$rowp[imageurl]", $des);
$des = str_replace("%isbn%", "$rowp[isbn]", $des);
$des = str_replace("%format%", "$rowp[format]", $des);
$des = str_replace("%author%", "$rowp[author]", $des);
$des = str_replace("%publisher%", "$rowp[publisher]", $des);
$des = str_replace("%artist%", "$rowp[artist]", $des);
$des = str_replace("%recordlabel%", "$rowp[recordlabel]", $des);
$des = str_replace("%releasestudio%", "$rowp[releasestudio]", $des);
$des = str_replace("%actor%", "$rowp[actor]", $des);
$des = str_replace("%director%", "$rowp[director]", $des);
$des = str_replace("%language%", "$rowp[language]", $des);
$des = str_replace("%rating%", "$rowp[rating]", $des);
$des = str_replace("%navigation%", $nav, $des);
$des = str_replace("%featured%", $fea, $des);

$des = str_replace("</body>", "<div  style='font-size: 12px;'>Script by <a href='http://www.datafeed-scripts.com'>Datafeed Scripts</a></div></body>", $des);
//echo $des;
echo $des;
?>
