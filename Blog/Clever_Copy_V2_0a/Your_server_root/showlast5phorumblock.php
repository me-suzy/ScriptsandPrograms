<?php
$query =  ("SELECT * FROM CC_blocks WHERE block_file = 'showlast5phorum.php'") or die($no_blocks_found_error);
$result = mysql_query($query);                                                                                                                                                                                     if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="2") && ($row["view"]=="1")) || (($row["side"]=="2") && ($row["view"]=="0"))){
                  include "showlast5phorum.php";
          }
       }
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="2"))&& (($row["view"]=="2"))){
                   include "showlast5phorum.php";
             }
         }
    }
}
else{
    while($row = mysql_fetch_array($result)){
        if ((($row["side"]=="2") && ($row["view"]=="0"))){
             include "showlast5phorum.php";
        }
   }
}
?>