<?php
session_start();
?>
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?PHP
include "connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
print "$getadmin3[css]";
if($getadmin3['status']>=1)
{
   $numentries=15;
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Delete Photo</center></td></tr>";
   print "<tr class='mainrow'><td>";  
   if(!isset($_GET['start']))
   {
      $start=0;
   }
   else
   {
      $start=$_GET['start'];
   }
   $getallphotos = "SELECT * from bl_userphotos where belongid='$getadmin3[adminid]' order by path ASC limit $start,20";
   $getallphotos2 = mysql_query($getallphotos) or die("Could not get photos");
   print "<table class='maintable'>";
   print "<tr class='headline'><td>Small Thumbnail</td><td>Delete</td></tr>";
   while($getallphotos3=mysql_fetch_array($getallphotos2))
   {
      
      print "<tr class='mainrow'><td>";
      if(strlen($getallphotos3[thumbpath])<3)
      {
         print "<img src='$getallphotos3[path]' height='100' width='100' border='0'>";
      }
      else
      {
         print "<img src='$getallphotos3[thumbpath]' height='100' width='100' border='0'>";
      }
      print "</td>";
      print "<td><A href='delphoto.php?ID=$getallphotos3[userphotoid]'>Delete Photo</a></td></tr>";
   }
   print "</table><br><br>";
   $order="SELECT * from bl_userphotos order by path ASC";
  $order2=mysql_query($order) or die(mysql_error());
  $d=0;
  $f=0;
  $g=1+$d/$numentries;
  $num=mysql_num_rows($order2);
  print "Page:</font> ";
  $prev=$start-$numentries;
  $next=$start+$numentries;
  if($start>=$numentries)
  {
    print "<A href='deletephoto.php?start=$prev'><<</a>&nbsp;";
  }
  while($order3=mysql_fetch_array($order2))
  {
     if($f>=$start-3*$numentries&&$f<=$start+7*$numentries)
     {
        if($f%$numentries==0)
        {
           print "<A href='deletephoto.php?start=$d'>$g</a> ";
        }
     }
     $d=$d+1;
     $g=1+$d/$numentries;
     $f++;
  }
  if($start<=$num-$numentries)
  {
    print "<A href='deletephoto.php?start=$next'>>></a>&nbsp;";
  }

   print "</td></tr></table>";
 
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>