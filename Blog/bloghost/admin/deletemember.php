<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?PHP
include "connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Main Admin</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit'])) //submit button has been pushed
   {
     $identifier=$_POST['identifier'];
     $deleteprofile="DELETE from bl_profile where belongid='$identifier'"; //delete profile
     mysql_query($deleteprofile) or die("Dead");
     $getentries="SELECT author from bl_blog where author='$identifier'";
     $getentries2=mysql_query($getentries) or die("COuld not get entries");
     while($getentries3=mysql_fetch_array($getentries2)) //delete comments
     {
        $delcomments="Delete from bl_comments where eparent='$getentries3[entryid]'";
        mysql_query($delcomments) or die("Could not delete comments");
     }
     $delentries="DELETE from bl_blog where author='$identifier'"; //Delete blog entries
     mysql_query($delentries) or die(mysql_error());
     $nukecalender="DELETE from bl_calender where personid='$identifier'"; //calender
     mysql_query($nukecalender) or die("Could not nuke calender");
     $clrbook="DELETE from bl_gbook where identifier='$identifier'"; //guestbook
     mysql_query($clrbook) or die(mysql_error());
     $delvars="DELETE from bl_vars where idvars='$identifier'"; //main vars
     mysql_query($delvars) or die("Could not delete varaibles");
     $deleteresume="DELETE from bl_resume where idresume='$identifier'";
     mysql_query($deleteresume) or die("Could not delete resume");//resume
     $killphotos="DELETE from bl_userphotos where belongid='$identifier'";
     mysql_query($killphotos) or die("Could not kill photos"); //photos
     $killright="DELETE from bl_right where idf='$identifier'";
     mysql_query($killright) or die("Could not kill right"); //right block
     $killleft="DELETE from bl_left where idf='$identifier'";
     mysql_query($killleft) or die("Could not kill left");  //left block
     $nukecats="DELETE from bl_cats where catbelong='$identifier'";
     mysql_query($nukecats) or die("Could not delete categories");
     $killmember="DELETE from bl_admin where adminid='$identifier'";
     mysql_query($killmember) or die("Could not kill member");
     print "Member deleted.";
   
   }
   else //confirm deletion of member
   {
      $ID=$_GET['ID'];
      print "Deleting this member will delete everything associated with this member(blogs, guestbook, etc), are you sure you want to delete this member?<br><br>";
      print "<form action='deletemember.php' method='post'>";
      print "<input type='hidden' name='identifier' value='$ID'>";
      print "<input type='submit' name='submit' value='submit'></form>";
 
   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>