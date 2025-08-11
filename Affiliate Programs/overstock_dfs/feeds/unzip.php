<?php
include ("../includes/db.conf.php");
include ("../includes/connect.inc.php");
  require_once('pclzip.lib.php');
  $archive=array();
  $i=0;
$queryp=mysql_query("select distinct csv from departments where used='1' ");
while ($rowp=mysql_fetch_array($queryp)){


echo $rowp['csv']."<br>";

  $archive[$i] = new PclZip($rowp['csv'].".zip");
  if ($archive[$i]->extract() == 0) {
    die("Error : ".$archive[$i]->errorInfo(true));
  }
  $i++;
  }
?>
