<?php
include("includes/db.conf.php");
include("includes/connect.inc.php");

// Number of items per page, 
$num_per_page = 10;

$querypcatname=mysql_query("Select * from categories where id='$_GET[cat]' ");
$rowpcatname=mysql_fetch_array($querypcatname);

$querykind=mysql_query("Select * from departments where id='$rowpcatname[department]' ");
$rowpkind=mysql_fetch_array($querykind);


switch ($rowpkind['kind']) {
case 1:
   $table = "booksbusinesstech";
   $template = "cat_books.tpl";
   break;
 case 2:
   $table = "booksfiction";
   $template = "cat_books.tpl";
   break;
case 3:
   $table = "booksjuvenile";
   $template = "cat_books.tpl";
   break;
case 4:
   $table = "booksmiscellaneous";
   $template = "cat_books.tpl";
   break;
case 5:
   $table = "booksnonfiction";
   $template = "cat_books.tpl";
   break;
case 6:
   $table = "bookstextbooks";
   $template = "cat_books.tpl";
   break;
case 7:
   $table = "music";
   $template = "cat_music.tpl";
   break;
case 8:
   $table = "dvd";
   $template = "cat_dvd.tpl";
   break;
case 9:
   $table = "vhs";
   $template = "cat_vhs.tpl";
   break;
case 10:
   $table = "videogames";
   $template = "cat_videogames.tpl";
   break;
case 11:
   $table = "general";
   $template = "cat_general.tpl";
   break;
case 12:
   $table = "sportsgear";
   $template = "cat_sportsgear.tpl";
   break;
case 13:
   $table = "worldstock";
   $template = "cat_worldstock.tpl";
   break;

}


######## Getting the current link by removing the last part of the URL ####
$relative = $_SERVER['PHP_SELF'];
$slash_position = strpos($relative, "/");
$last_slash = strrpos($relative, "/");
$length = $last_slash - $slash_position;
$path = substr($relative, $slash_position, $length) . "/";

$dir= "http://" . $_SERVER['HTTP_HOST'] . $path;

### End link ####

$des = file_get_contents("templates/".$template);   
include_once("navigation.php");
$nav = $menu;

$this_case = $rowpkind['kind'];
include_once("featured.php");
$fea = $feature;

$cattem = file_get_contents("templates/category.tpl");   

if (isset($_GET['set'])){

$set=$_GET['set'];
}else{
$set=0;
}
$start=$set*$num_per_page;

$catslash= addslashes($rowpcatname['category']);

$queryp1=mysql_query("Select * from $table where category='$catslash' ");
$nump=mysql_num_rows($queryp1);
$pages=$nump/$num_per_page;

$queryover=mysql_query("Select * from admin where id='1' ");
$rowover=mysql_fetch_array($queryover);

$queryp=mysql_query("Select * from $table where category='$catslash' limit $start,$num_per_page");

$t1=0;
while ($rowp=mysql_fetch_array($queryp)){
$t1++;
$des2 = str_replace("%sku%", "$rowp[sku]", $des);
$des2 = str_replace("%productlink%", $dir."product/$rowp[sku]/$rowpkind[kind]/", $des2);
$des2 = str_replace("%overid%", "$rowover[overid]", $des2);
$des2 = str_replace("%productname%", "$rowp[productname]", $des2);
$des2 = str_replace("%productshortname%", "$rowp[productshortname]", $des2);
$des2 = str_replace("%brandname%", "$rowp[brandname]", $des2);
$des2 = str_replace("%manufacturer%", "$rowp[manufacturer]", $des2);
$des2 = str_replace("%manufacturerpartno%", "$rowp[manufacturerpartno]", $des2);
$des2 = str_replace("%modelno%", "$rowp[modelno]", $des2);
$des2 = str_replace("%productdimensions%", "$rowp[productdimensions]", $des2);
$des2 = str_replace("%productmaterials%", "$rowp[productmaterials]", $des2);
$des2 = str_replace("%productorigin%", "$rowp[productorigin]", $des2);
$des2 = str_replace("%storelistname%", "$rowp[storelistname]", $des2);
$des2 = str_replace("%category%", "$rowp[category]", $des2);
$des2 = str_replace("%subcategory%", "$rowp[subcategory]", $des2);
$des2 = str_replace("%price%", "$rowp[price]", $des2);
$des2 = str_replace("%msrp%", "$rowp[msrp]", $des2);
$des2 = str_replace("%longdescription%", "$rowp[longdescription]", $des2);
$des2 = str_replace("%shortdescription%", "$rowp[shortdescription]", $des2);
$des2 = str_replace("%productquality%", "$rowp[productquality]", $des2);
$des2 = str_replace("%productwarranty%", "$rowp[productwarranty]", $des2);
$des2 = str_replace("%qtyonhand%", "$rowp[qtyonhand]", $des2);
$des2 = str_replace("%upc%", "$rowp[upc]", $des2);
$des2 = str_replace("%thumbnailimage%", "$rowp[thumbnailimage]", $des2);
$des2 = str_replace("%largeimage%", "$rowp[largeimage]", $des2);
$des2 = str_replace("%storename%", "$rowp[storename]", $des2);
$des2 = str_replace("%title%", "$rowp[title]", $des2);
$des2 = str_replace("%isbn%", "$rowp[isbn]", $des2);
$des2 = str_replace("%format%", "$rowp[format]", $des2);
$des2 = str_replace("%imageurl%", "$rowp[imageurl]", $des2);
$des2 = str_replace("%author%", "$rowp[author]", $des2);
$des2 = str_replace("%publisher%", "$rowp[publisher]", $des2);
$des2 = str_replace("%artist%", "$rowp[artist]", $des2);
$des2 = str_replace("%recordlabel%", "$rowp[recordlabel]", $des2);
$des2 = str_replace("%releasestudio%", "$rowp[releasestudio]", $des2);
$des2 = str_replace("%actor%", "$rowp[actor]", $des2);
$des2 = str_replace("%director%", "$rowp[director]", $des2);
$des2 = str_replace("%language%", "$rowp[language]", $des2);
$des2 = str_replace("%rating%", "$rowp[rating]", $des2);

if($t1==1){
$des3=$des2;
}else{
$des3.=$des2;}
}

$morepages="";

if($set<=10){
$beg=0;}
else{
$beg=$set-10;}

if($beg+19>$pages){
$end=$pages;}
else{
$end=$beg+19;}
for ($i=$beg; $i <= ($end); $i++){
$e=$i+1;
$morepages.= "<a href='$dir"."category/$_GET[cat]/$i/'>$e</a>\n";
}

$cattem = str_replace("%navigation%", $nav, $cattem);
$cattem = str_replace("%featured%", $fea, $cattem);
$cattem = str_replace("%catlist%", $des3, $cattem);
$cattem = str_replace("%department%", "$rowp[department]", $cattem);
$cattem = str_replace("%category%", "$rowpcatname[category]", $cattem);
$cattem = str_replace("%morepages%", $morepages, $cattem);
$cattem = str_replace("</body>", "<div  style='font-size: 12px;'>Script by <a href='http://www.datafeed-scripts.com'>Datafeed Scripts</a></div></body>", $cattem);
//echo $des;
echo $cattem;
?>
