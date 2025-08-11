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
$membername=$_GET['membername'];
if($getadmin3['status']==3 || $_SESSION['blogadmin']== $membername)
{
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Main Admin</center></td></tr>";
   print "<tr class='mainrow'><td>";
   $ID=$_GET['ID'];
   if(isset($_POST['submit']))
   {
      if(strlen($_POST['title'])<1 || strlen($_POST['short'])<1)
      {
         print "Either the title or short text or blank, please try again.";
      }
      else
      {
         $title=$_POST['title'];
         $short=$_POST['short'];
         $long=$_POST['long'];
         $allow=$_POST['allow'];
         $thecat=$_POST['thecat'];
         $editblog="update bl_blog set blogtitle='$title',shortblurb='$short',maincontent='$long',allowcomments='$allow',catparent='$thecat' where entryid='$ID'";
         mysql_query($editblog) or die("Could not edit blog entry");
         print "Blog entry edited.";
      }

   }
   else
   {
      print "* Denotes required field.<br>";
      $getblog="SELECT * from bl_blog where entryid='$ID'";
      $getblog2=mysql_query($getblog) or die("Could not get blog");
      $getblog3=mysql_fetch_array($getblog2);
      print "<form action='editblog.php?ID=$ID&membername=$membername' method='post' name='form'>";
      print "Title:*<br>";
      print "<input type='text' name='title' length='30' value='$getblog3[blogtitle]'><br>";
      print "Category:<br>";
      print "<select name='thecat'>";
      print "<option value='0'>General</option>";
      $getallcats="SELECT * from bl_cats order by catname ASC"; //get all categories
      $getallcats2=mysql_query($getallcats) or die("Could not get cats");
      while($getallcats3=mysql_fetch_array($getallcats2))
      {
         print "<option value='$getallcats3[catID]'>$getallcats3[catname]</option>";
      }
      print "</select><br><br>";
      print "Short Blurb*(Will appear on main index,html allowed)<br>";
      print "<textarea name='short' rows='4' cols='35'>$getblog3[shortblurb]</textarea><br>";
      print "<a onClick=\"addSmiley(':)')\"><img src='../images/smile.gif'></a> ";
      print "<a onClick=\"addSmiley(':(')\"><img src='../images/sad.gif'></a> ";
      print "<a onClick=\"addSmiley(';)')\"><img src='../images/wink.gif'></a> ";
      print "<a onClick=\"addSmiley(';smirk')\"><img src='../images/smirk.gif'></a> ";	
      print "<a onClick=\"addSmiley(':blush')\"><img src='../images/blush.gif'></a> ";
      print "<a onClick=\"addSmiley(':angry')\"><img src='../images/angry.gif'></a> ";
      print "<a onClick=\"addSmiley(':shocked')\"><img src='../images/shocked.gif'></a> ";
      print "<a onClick=\"addSmiley(':cool')\"><img src='../images/cool.gif'></a> ";
      print "<a onClick=\"addSmiley(':ninja')\"><img src='../images/ninja.gif'></a> ";
      print "<a onClick=\"addSmiley('(heart)')\"><img src='../images/heart.gif'></a> ";
      print "<a onClick=\"addSmiley('(!)')\"><img src='../images/exclamation.gif'></a> ";
      print "<a onClick=\"addSmiley('(?)')\"><img src='../images/question.gif'></a><br>";
      print "<a onclick=\"addSmiley(':{blink}')\"><img src='../images/winking.gif'></a>";
      print "<A onclick=\"addSmiley('{clover}')\"><img src='../images/clover.gif'></a>";
      print "<a onclick=\"addSmiley(':[glasses]')\"><img src='../images/glasses.gif'></a>";
      print "<a onclick=\"addSmiley(':[barf]')\"><img src='../images/barf.gif'></a>";
      print "<a onclick=\"addSmiley(':[reallymad]')\"><img src='../images/mad.gif'></a>";
      print "<script language=\"JavaScript\" type=\"text/javascript\">\n";
      print "function addSmiley(textToAdd)\n";
      print "{\n";
      print "document.form.short.value += textToAdd;";
      print "document.form.short.focus();\n";
      print "}\n";
      print "</script><br><br>";
      print "Full Text(Will appear when user clicks on the 'more' link, html allowed):<br>";
      print "<textarea name='long' rows='5' cols='40'>$getblog3[maincontent]</textarea><br>";
      print "<a onClick=\"addSmileys(':)')\"><img src='../images/smile.gif'></a> ";
      print "<a onClick=\"addSmileys(':(')\"><img src='../images/sad.gif'></a> ";
      print "<a onClick=\"addSmileys(';)')\"><img src='../images/wink.gif'></a> ";
      print "<a onClick=\"addSmileys(';smirk')\"><img src='../images/smirk.gif'></a> ";	
      print "<a onClick=\"addSmileys(':blush')\"><img src='../images/blush.gif'></a> ";
      print "<a onClick=\"addSmileys(':angry')\"><img src='../images/angry.gif'></a> ";
      print "<a onClick=\"addSmileys(':shocked')\"><img src='../images/shocked.gif'></a> ";
      print "<a onClick=\"addSmileys(':cool')\"><img src='../images/cool.gif'></a> ";
      print "<a onClick=\"addSmileys(':ninja')\"><img src='../images/ninja.gif'></a> ";
      print "<a onClick=\"addSmileys('(heart)')\"><img src='../images/heart.gif'></a> ";
      print "<a onClick=\"addSmileys('(!)')\"><img src='../images/exclamation.gif'></a> ";
      print "<a onClick=\"addSmileys('(?)')\"><img src='../images/question.gif'></a><br>";
      print "<a onclick=\"addSmileys(':{blink}')\"><img src='../images/winking.gif'></a>";
      print "<A onclick=\"addSmileys('{clover}')\"><img src='../images/clover.gif'></a>";
      print "<a onclick=\"addSmileys(':[glasses]')\"><img src='../images/glasses.gif'></a>";
      print "<a onclick=\"addSmileys(':[barf]')\"><img src='../images/barf.gif'></a>";
      print "<a onclick=\"addSmileys(':[reallymad]')\"><img src='../images/mad.gif'></a>";
      print "<script language=\"JavaScript\" type=\"text/javascript\">\n";
      print "function addSmileys(textToAdd)\n";
      print "{\n";
      print "document.form.long.value += textToAdd;";
      print "document.form.long.focus();\n";
      print "}\n";
      print "</script><br><br>";
      print "Allow people to comment?<br>";
      print "<select name='allow'>";
      if($getblog3[allowcomments]==1)
      {
        print "<option value='1'>Yes</option>";
        print "<option value='0'>No</option>";
      }
      else
      {
        print "<option value='0'>No</option>";
        print "<option value='1'>Yes</option>";
      }
      print "</select><br><br>";
      print "<input type='submit' name='submit' value='Edit'></form>";

   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>