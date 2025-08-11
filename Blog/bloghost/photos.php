<?php
session_start();
include "smiley.php";
include "admin/connect.php";
$membername=$_GET['membername'];
$getvars2=mysql_query("SELECT * from bl_admin where username='$membername'");
$getvars3=mysql_fetch_array($getvars2);
$getvarz="SELECT * from bl_vars where idvars='$getvars3[adminid]'"; //get current variable values
$getvarz2=mysql_query($getvarz) or die(mysql_error());
$getvarz3=mysql_fetch_array($getvarz2);
print "$getvars3[css]";
$numentries=21;
print "<head><title>$getvarz3[title]</title></head>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
include "memberleft.php";
print "</td>";
print "<td valign='top' width=56%><center>"; 
//get photos
$count=0;
if(!isset($_GET['start']))
   {
      $start=0;
   }
   else
   {
      $start=$_GET['start'];
   }
   $getmaincats="SELECT * from bl_userphotos where belongid='$getvars3[adminid]' order by path ASC limit $start,21";
   $getmaincats2=mysql_query($getmaincats) or die("Could not get root categories"); 
   print "<table border=0>";
   while($getmaincats3=mysql_fetch_array($getmaincats2))
   {
     if($count%3==0)
     {
       if(strlen($getmaincats3[thumbpath])<3)
       {  
         print "<tr><td><A href=\"javascript:popWin('viewphotos.php?membername=$membername&ID=$getmaincats3[userphotoid]',600, 600)\"><img src='$getmaincats3[path]' border='0' width='100' height='100'></a></td>";
       }
       else
       {
          print "<tr><td><A href=\"javascript:popWin('viewphotos.php?membername=$membername&ID=$getmaincats3[userphotoid]',600, 600)\"><img src='$getmaincats3[thumbpath]' border='0' width='100' height='100'></a></td>";
       }
     }
     else if($count%3==1)
     {
       if(strlen($getmaincats3[thumbpath])<3)
       {  
         print "<tr><td><A href=\"javascript:popWin('viewphotos.php?membername=$membername&ID=$getmaincats3[userphotoid]',600, 600)\"><img src='$getmaincats3[path]' border='0' width='100' height='100'></a></td>";
       }
       else
       {
         print "<td><A href=\"javascript:popWin('viewphotos.php?membername=$membername&ID=$getmaincats3[userphotoid]',600, 600)\"><img src='$getmaincats3[thumbpath]' border='0' width='100' height='100'></a></td>";
       }
     }
     else
     {
       if(strlen($getmaincats3[thumbpath])<3)
       {  
         print "<tr><td><A href=\"javascript:popWin('viewphotos.php?membername=$membername&ID=$getmaincats3[userphotoid]',600, 600)\"><img src='$getmaincats3[path]' border='0' width='100' height='100'></a></td>";
       }
       else
       {
         print "<td><A href=\"javascript:popWin('viewphotos.php?membername=$membername&ID=$getmaincats3[userphotoid]',600, 600)\"><img src='$getmaincats3[thumbpath]' border='0' width='100' height='100'></a></td></tr>";
       }
     }
     $count++;
   }
   print "</table>";
   

print "</center><br><br>";
$order="SELECT * from bl_userphotos where belongid='$getvars3[adminid]' order by path ASC";
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
    print "<A href='photos.php?start=$prev'><<</a>&nbsp;";
  }
  while($order3=mysql_fetch_array($order2))
  {
     if($f>=$start-3*$numentries&&$f<=$start+7*$numentries)
     {
        if($f%$numentries==0)
        {
           print "<A href='photos.php?membername=$membername&start=$d'>$g</a> ";
        }
     }
     $d=$d+1;
     $g=1+$d/$numentries;
     $f++;
  }
  if($start<=$num-$numentries)
  {
    print "<A href='photos.php?membername=$membername&start=$next'>>></a>&nbsp;";
  }
print "</td>";
print "<td valign='top' width=22%>";
include "memberight.php";
print "</td></tr></table>";
include "footer.php";
print "<br><br>";

?>
<script>


function popWin(url,width,height){
reWin=window.open(url,'hell','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=600,top=100,left=100')
}
</script>

<center><font size='2'>Powered by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Blogger</a></font></center>