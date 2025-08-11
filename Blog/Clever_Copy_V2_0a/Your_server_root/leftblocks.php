<?php
$getblocks="SELECT * from CC_block_names";
$getblocks2=mysql_query($getblocks) or die($no_blocks_error);
$getblocks3=mysql_fetch_array($getblocks2);
$query =  ("SELECT * FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
$result = mysql_query($query);                                                                                                                                                                                      if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       $theblock = $row["block_file"];
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  include "$theblock";
                  echo "<br>";
          }
       }
     if (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="0")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  if (($row["block_file"] !== "loginblock.php")&& ($row["block_file"] == "adminblock.php"))
                  {
                  include "$theblock";
                  echo "<br>";
               }
             }
         }
    }
}
else{

    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];



        if (($row["side"]=="0") && ($row["view"]=="0")){
             include "$theblock";
             echo "<br>";
        }
   }
}
?>