<?php
$query =  ("SELECT * FROM CC_blocks WHERE block_file = 'showlastforumbb2.php'") or die($no_blocks_found_error);
$result = mysql_query($query);                                                                                                                                                                                     if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="2") && ($row["view"]=="1")) || (($row["side"]=="2") && ($row["view"]=="0"))){
                  include "showlastforumbb2.php";
          }
       }
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="2"))&& (($row["view"]=="2"))){
                   include "showlastforumbb2.php";
             }
         }
    }
}
else{
    while($row = mysql_fetch_array($result)){
        if ((($row["side"]=="2") && ($row["view"]=="0"))){
             include "showlastforumbb2.php";
        }
   }
}
?>