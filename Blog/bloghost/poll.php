<?php
print "<table class='maintable'><tr class='headline'><td><center>Poll</center></td></tr>";
print "<tr class='mainrow'><td>";
$getquestion="SELECT * from bl_pollquestion"; //get poll question
$getquestion2=mysql_query($getquestion) or die("Could not get questions");
$getquestion3=mysql_fetch_array($getquestion2);
$getchoices="SELECT * from bl_pollchoices"; //get all answer choices
$getchoices2=mysql_query($getchoices) or die("Could not get choices");
$yourip=$_SERVER["REMOTE_ADDR"];
print "<b>$getquestion3[question]</b><br>";
$checkips="SELECT * from bl_pollip where pollip='$yourip' limit 1";
$checkips2=mysql_query($checkips) or die("Could not check ips");
$checkips3=mysql_fetch_array($checkips2);
if(strlen($checkips3[pollip])>1)
{
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
          print "$getchoices3[answer]<br><img src='pollpic.gif' border='0' height='5' width='$percentage'>($percentage %)<br>";
      }
      print "<br>Total Votes Casted: $totalvotes";
   }

}
else
{
  print "<form action='pollit.php' method='post'>";
  while($getchoices3=mysql_fetch_array($getchoices2))
  {
    print "<input type='radio' name='choice' value='$getchoices3[choiceid]'>$getchoices3[answer]<br>";
  }
  print "<input type='submit' name='submit' value='vote'></form><br>";
  print "<A HREF=\"javascript:popUp('pollresults.php')\">Results</A>";
}
print "</td></tr></table>";
?>
<script>
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=200,height=200');");
}
// End -->
</script>
