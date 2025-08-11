<?php
session_start();
include "header.php";
include "smiley.php";
include "admin/connect.php";
$numentries=15;

//SELECT ALL VARIABLES
$membername=$_GET['membername'];
$getvars2=mysql_query("SELECT * from bl_admin where username='$membername'");
$getvars3=mysql_fetch_array($getvars2);
$getvarz="SELECT * from bl_vars where idvars='$getvars3[adminid]'"; //get current variable values
$getvarz2=mysql_query($getvarz) or die("Could not get variables");
$getvarz3=mysql_fetch_array($getvarz2);
print "$getvars3[css]";

print "<head><title>$getvars3[title]</title></head>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
print "<table class='maintable'>";
print "<tr class='headline'><td><center>Main</center></td></tr>";
print "<tr class='mainrow'><td><A href='members.php?membername=$membername'>Back to Main</a></td></tr></table><br><br>";
//grab profile
include "memberleft.php";
print "</td>";
print "<td valign='top' width=56%><center>"; 
$ID=$_GET['ID'];
//get LAST 15 main blog entries
$getblog="SELECT * from bl_blog where entryid='$ID'";
$getblog2=mysql_query($getblog) or die("Could not get blog");
while($getblog3=mysql_fetch_array($getblog2))
{
  $getblog3[maincontent]=smile($getblog3[maincontent]);
  $getblog3[maincontent]=nl2br($getblog3[maincontent]);
  print "<table class='maintable'><tr class='headline'><td><b>$getblog3[blogtitle]</b> posted by $getblog3[author]<br>";
  print "Posted on $getblog3[thetime]</td></tr>";
  print "<tr class='mainrow'><td>";
  print "$getblog3[maincontent]<br>";
  if($getblog3[allowcomments]==1)
  {
    print "<br><A href='comments.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>$getblog3[numcomments] comments</a>--<A href='postcomment.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>Add comment</a>";
  }
 
  print "</td></tr></table><br>";
  if(!isset($_GET['start']))
  {
    $start=0;
  }
  else
  {
    $start=$_GET['start'];
  }
  $getcomments="SELECT * from bl_comments where eparent='$ID' order by commentid DESC limit $start, $numentries";
  $getcomments2=mysql_query($getcomments) or die("Could not get comments");
  while($getcomments3=mysql_fetch_array($getcomments2))
  {
    $getcomments3[comment]=strip_tags($getcomments3[comment]);
    $getcomments3[comment]=htmlspecialchars($getcomments3[comment]);
    $getcomments3[comment]=smile($getcomments3[comment]);
    $getcomments3[comment]=stripslashes($getcomments3[comment]);
    $getcomments3[name]=strip_tags($getcomments3[name]);
    $getcomments3[name]=htmlspecialchars($getcomments3[name]);
    $getcomments3[name]=wordwrap($getcomments3[name], 30, "\n", 1);
    $getcomments3[comment]=wordwrap($getcomments3[comment], 30, "\n", 1);
    print "<table class='maintable'><tr class='headline'><td>Name</td><td>Comment</td></tr>";
    print "<tr class='mainrow'><td valign='top' width=25%>$getcomments3[name]";
    if(isset($_SESSION['blogadmin']))
    {
       print "<br>IP: $getcomments3[IP]";
    }
    print "</td><td width=80% valign='top'>$getcomments3[comment]";
    if(isset($_SESSION['blogadmin']))
    {
      print "<br><br><A href='admin/deletecomment.php?membername=$membername&threadID=$ID&ID=$getcomments3[commentid]'>Delete Comment</a>";
    }
    print "</td></tr></table><br>";
  }
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center><b>Comments navigation</b></center></td></tr>";
  print "<tr class='mainrow'><td valign='top'>";
 
  $order="SELECT * from bl_comments where eparent='$ID'";
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
    print "<A href='comments.php?start=$prev&ID=$ID'><<</a>&nbsp;";
  }
  while($order3=mysql_fetch_array($order2))
  {
     if($f>=$start-3*$numentries&&$f<=$start+7*$numentries)
     {
        if($f%$numentries==0)
        {
           print "<A href='comments.php?start=$d&ID=$ID'>$g</a> ";
        }
     }
     $d=$d+1;
     $g=1+$d/$numentries;
     $f++;
  }
  if($start<=$num-$numentries)
  {
    print "<A href='comments.php?start=$next&ID=$ID'>>></a>&nbsp;";
  }
  print "</td></tr></table>";
}

print "</center></td>";
print "<td valign='top' width=22%>";
include "memberight.php";
print "</td></tr></table>";
include "footer.php";
print "<br><br>";

?>
