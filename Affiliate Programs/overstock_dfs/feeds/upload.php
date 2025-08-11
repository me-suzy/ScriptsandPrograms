<?php
include ("../includes/db.conf.php");
include ("../includes/connect.inc.php");


$queryp=mysql_query("select distinct csv from departments where used='1' ");
while ($rowp=mysql_fetch_array($queryp)){

switch ($rowp['csv']) {
case "apparel_accessories":
   $table = "general";
   break;
 case "bed_bath_linens":
   $table = "general";
   break;
case "books_business_tech":
   $table = "booksbusinesstech";
   break;
case "books_fiction":
   $table = "booksfiction";
   break;
case "books_juvenile":
   $table = "booksjuvenile";
   break;
case "books_miscellaneous":
   $table = "booksmiscellaneous";
   break;
case "books_non_fiction":
   $table = "booksnonfiction";
   break;
case "books_textbooks":
   $table = "bookstextbooks";
   break;
case "DVD":
   $table = "DVD";
   break;
case "electronics_computer":
   $table = "general";
   break;
case "gifts_gadgets_toys":
   $table = "general";
   break;
case "home_garden_decor":
   $table = "general";
   break;
case "housewares_appliances":
   $table = "general";
   break;
case "jewelry_watches":
   $table = "general";
   break;
case "luggage_business":
   $table = "general";
   break;
case "sports_gear":
   $table = "sports_gear";
   break;
case "worldstock":
   $table = "worldstock";
   break;
case "music":
   $table = "music";
   break;
case "VHS":
   $table = "VHS";
   break;
case "videogames":
   $table = "videogames";
   break;
}

$file=$rowp['csv'].".csv";

$queryp2=mysql_query("LOAD DATA LOCAL INFILE '$file' REPLACE INTO TABLE $table FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES");
$mysqlresult = mysql_query("update $table set rndnumber=1000000*rand() ");

echo mysql_error();
echo $rowp['csv']."<br>";
}
?>
