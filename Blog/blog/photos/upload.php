<?php
session_start();
?>
<link rel="stylesheet" href="../admin/style.css" type="text/css">
<?PHP
include "../admin/connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{


   print "<table class='maintable'><tr class='headline'><td><center>Add Photo</center></td></tr>";
   print "<tr class='mainrow'><td>";  
   if(isset($_POST['submit']))
   {
     $new_height=100;
     $new_width=100;
     $allowed_types = array( 
     'image/pjpeg', 
     'image/gif', 
     'image/png', 
     'image/jpeg'); 
     if(in_array($_FILES['thefile']['type'], $allowed_types)) 
     {
       copy ($_FILES['thefile']['tmp_name'], $_FILES['thefile']['name']) or die     ("Could not copy");
       echo "Name: ".$_FILES['thefile']['name']."";
       echo "Size: ".$_FILES['thefile']['size']."";
       echo "Type: ".$_FILES['thefile']['type']."";     
       $imagefile=$_FILES['thefile']['name'];
       list($width, $height) = getimagesize($_FILES['thefile']['name']);
       $image_p = imagecreatetruecolor($new_width,$new_height);
       if ($_FILES['thefile']['type'] == "image/gif") 
       {
           $img = @imagecreatefromgif($imagefile);
           imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
           $thename=$_FILES['thefile']['name'];
           $thenames="thumb$thename";
           $location="thumbs/$thenames";
           imagegif($image_p,$location, 100);

       }
       else
       {
         $img = @imagecreatefromjpeg($imagefile);
         imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
         $thename=$_FILES['thefile']['name'];
         $thenames="thumb$thename";
         $location="thumbs/$thenames";
         imagejpeg($image_p,$location, 100);
       }
       $insertdata="INSERT into bl_photos(mainpath,thumbpath) values('$thename','$thenames')";
       mysql_query($insertdata) or die("Could not insert photo data");
       print "<br>Photo Added. Back to <A href='../admin/addphoto.php'>Control Panel</a>.";

     }
     else
     {
       print "<br>Only Gifs and Jpegs are supported. Back to <A href='../admin/addphoto.php'>Control Panel</a>";
     }
   }
   
   print "</td></tr></table>";
 
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>