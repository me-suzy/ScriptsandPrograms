<?php
session_start();
include "admin/connect.php";
print "<link rel='stylesheet' href='admin/style.css' type='text/css'>";
print "<center><table class='maintable'>";
print "<tr class='headline'><td height='7'></td></tr>";
print "<tr class='mainrow'><td>";
$ID=$_GET['ID'];
$s=$_SERVER["REMOTE_ADDR"];
$membername=$_GET['membername'];
$ipbancheck="SELECT * from bl_banip where banip='$s'";
$ipbancheck2=mysql_query($ipbancheck); //check for banned IPS
while($ipbancheck3=mysql_fetch_array($ipbancheck2))
{
  $IPBANNED=$ipbancheck3[banip];
}
if (strlen($IPBANNED)>1)
{
  die("You have been banned from posting");
}
if(isset($_POST['submit']))
{
   
   if(strlen($_POST['thename'])<1 || strlen($_POST['comment'])<1)
   {
      print "You did not enter a name or comment please try again.";
   }
   else
   {
     $IP=$_SERVER["REMOTE_ADDR"];
     $thename=$_POST['thename'];
     $comment=$_POST['comment'];
     $makecomment="INSERT into bl_comments (comment,IP,eparent,name) values('$comment','$IP','$ID','$thename')";
     mysql_query($makecomment) or die("Could not make comment");
     $updatecount="update bl_blog set numcomments=numcomments+1 where entryid='$ID'";
     mysql_query($updatecount) or die("Could not update comment count");
     print "Comment Posted. You will now be redirected <META HTTP-EQUIV = 'Refresh' Content = '2; URL =members.php?membername=$membername'>";  
   } 

}
else if(isset($_GET['ID']))
{
   $getblog="SELECT * from bl_blog where entryid='$ID'";
   $getblog2=mysql_query($getblog) or die("Could not get blog");
   $getblog3=mysql_fetch_array($getblog2);
   if($getblog3[allowcomments]==0)
   {
      print "You cannot comment on this entry.";
   }
   else
   {
     print "<form action='postcomment.php?membername=$membername&ID=$ID' method='post' name='form'>";
     print "Name:<br>";
     print "<input type='text' name='thename' size='20'><br>";
     print "Comment(html not allowed):<br>";
     print "<textarea name='comment' rows='4' cols='35'></textarea><br>";
     print "<a onClick=\"addSmiley(':)')\"><img src='/images/smile.gif'></a> ";
     print "<a onClick=\"addSmiley(':(')\"><img src='/images/sad.gif'></a> ";
     print "<a onClick=\"addSmiley(';)')\"><img src='/images/wink.gif'></a> ";
     print "<a onClick=\"addSmiley(';smirk')\"><img src='/images/smirk.gif'></a> ";	
     print "<a onClick=\"addSmiley(':blush')\"><img src='/images/blush.gif'></a> ";
     print "<a onClick=\"addSmiley(':angry')\"><img src='/images/angry.gif'></a> ";
     print "<a onClick=\"addSmiley(':shocked')\"><img src='/images/shocked.gif'></a> ";
     print "<a onClick=\"addSmiley(':cool')\"><img src='/images/cool.gif'></a> ";
     print "<a onClick=\"addSmiley(':ninja')\"><img src='/images/ninja.gif'></a> ";
     print "<a onClick=\"addSmiley('(heart)')\"><img src='/images/heart.gif'></a> ";
     print "<a onClick=\"addSmiley('(!)')\"><img src='/images/exclamation.gif'></a> ";
     print "<a onClick=\"addSmiley('(?)')\"><img src='/images/question.gif'></a><br>";
     print "<a onclick=\"addSmiley(':{blink}')\"><img src='/images/winking.gif'></a>";
     print "<A onclick=\"addSmiley('{clover}')\"><img src='/images/clover.gif'></a>";
     print "<a onclick=\"addSmiley(':[glasses]')\"><img src='/images/glasses.gif'></a>";
     print "<a onclick=\"addSmiley(':[barf]')\"><img src='/images/barf.gif'></a>";
     print "<a onclick=\"addSmiley(':[reallymad]')\"><img src='/images/mad.gif'></a>";
     print "<script language=\"JavaScript\" type=\"text/javascript\">\n";
     print "function addSmiley(textToAdd)\n";
     print "{\n";
     print "document.form.comment.value += textToAdd;";
     print "document.form.comment.focus();\n";
     print "}\n";
     print "</script><br>";
     print "<input type='submit' name='submit' value='submit'></form>";
   }

}
print "</td></tr></table></center>";

?>