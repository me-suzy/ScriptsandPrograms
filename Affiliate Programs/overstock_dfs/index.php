<?php
include ("includes/db.conf.php");
include ("includes/connect.inc.php");

$queryrand=mysql_query("Select * from departments where used=1 order by rand()");
$rowrand=mysql_fetch_array($queryrand);


//$dir3=str_replace("index.php", "", "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
// $dir will be used throughout all of the files that is included, only
// this variable is needed.
$relative = $_SERVER['PHP_SELF'];
$slash_position = strpos($relative, "/");
$last_slash = strrpos($relative, "/");
$length = $last_slash - $slash_position;
$path = substr($relative, $slash_position, $length) . "/";

$dir= "http://" . $_SERVER['HTTP_HOST'] . $path;


/*  This can be replaced by file_get_contents()
$file = fopen( "templates/index.tpl", "r" )   
         or exit("Timeout reached index tpl") ;
        $des="";
        while ( ! feof( $file ) )
        {
        $line = fgets( $file, 1024 );
        $des.=$line;
        }
  fclose($file);
*/
$des = file_get_contents("templates/index.tpl");


/*  This is replaced by an include to navigation.php
$file2 = fopen( $dir3."navigation.php", "r" )  
         or exit("Timeout reached index php") ;
        $nav="";
        while ( ! feof( $file2 ) )
        {
        $line2 = fgets( $file2, 1024 );
        $nav.=$line2;
        }
  fclose($file2); 
*/

// Since an include of a file will give this file access to its variables
// navigation.php has been changed so that it does not echo the information
// but it stores all of the information into the variable $menu
include_once("navigation.php");

// Here, we assign the value of $menu to $nav so we can manipulate it below
$nav = $menu;

/* This is replaced with the code below the commented out section
$file3 = fopen( $dir3."featured.php?table=$rowrand[kind]", "r" )
	 or exit("Timeout reached index feature") ;

        $fea="";
        while ( ! feof( $file3 ) )
        {
        $line3 = fgets( $file3, 1024 );
        $fea.=$line3;
        }
  fclose($file3);
*/
// This is similar to the above, but it passes $this_case to featured.php
// then featured.php stores all of its information inside $feature
$this_case = $rowrand[kind];
include_once("featured.php");
$fea = $feature;
//$fea = "test";

$des = str_replace("%navigation%", $nav, $des);
$des = str_replace("%featured%", $fea, $des);
$des = str_replace("</body>", "<div  style='font-size: 12px;'>Script by <a href='http://www.datafeed-scripts.com'>Datafeed Scripts</a></div></body>", $des);
//echo $des;
echo $des;
?>
