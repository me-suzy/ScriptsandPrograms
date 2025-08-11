<?php

$sql="SELECT * FROM Admin";
$rs=odbc_exec($conn,$sql);
if(!$rs)
{
exit("Could not retrieve script settings.");
}
odbc_fetch_row($rs, 0);

function odbc_Count($con,$sql){
   $result = odbc_exec($con,$sql);
   $count=0;
   while($temp = odbc_fetch_into($result, &$counter)){
       $count++;
   }
   return $count;
}

?>