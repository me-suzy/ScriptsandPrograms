<?php
include "admin/connect.php";
$getquestion="SELECT * from bl_pollquestion"; //get poll question
$getquestion2=mysql_query($getquestion) or die("Could not get questions");
$getquestion3=mysql_fetch_array($getquestion2);
$getchoices="SELECT * from bl_pollchoices"; //get all answer choices
$getchoices2=mysql_query($getchoices) or die("Could not get choices");
 $totalvotes=0;
   while($getchoices3=mysql_fetch_array($getchoices2))
   {
     $totalvotes+=$getchoices3[votes];
   }
   if($totalvotes==0)
   {
      print "No votes have been casted.";
   }
   else
   {
      mysql_data_seek($getchoices2,0);
      while($getchoices3=mysql_fetch_array($getchoices2))
      {
          $percentage=($getchoices3[votes]/$totalvotes)*100;
          $percentage=round($percentage,2);
          print "$getchoices3[answer]<br><img src='pollpic.gif' border='0' width='$percentage' height='5'>($percentage %)<br>";
      }
      print "<br>Total Votes Casted: $totalvotes";
   }
?>