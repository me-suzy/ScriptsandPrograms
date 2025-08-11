<?php
//include ("includes/db.conf.php");
//include ("includes/connect.inc.php");

$nav = file_get_contents("templates/navigation.tpl");
//$dir2=str_replace("index.php", "category", "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$queryp=mysql_query("Select * from departments where used=1");
$menu = "";
while ($rowp=mysql_fetch_array($queryp)){
    $nav2 = str_replace("%department%", $rowp['department'], $nav);
    $cats="";
    $queryp2=mysql_query("Select * from categories where department='$rowp[id]'");
    while ($rowp2=mysql_fetch_array($queryp2)){
        $cats.="<a href='$dir" . "category/$rowp2[id]/0/'>$rowp2[category]</a><br>";
	}
    $nav2 = str_replace("%categories%", $cats, $nav2);
    $menu .= $nav2;
}

//echo $menu;

?>
