<?php
include "../admin/connect.php";
print "<link rel='stylesheet' href='../admin/style.css' type='text/css'>";
$s=$_SERVER["REMOTE_ADDR"];
$ipbancheck="SELECT * from bl_banip where banip='$s'";
$ipbancheck2=mysql_query($ipbancheck); //check for banned IPS
while($ipbancheck3=mysql_fetch_array($ipbancheck2))
{
  $IPBANNED=$ipbancheck3[banip];
}
if (strlen($IPBANNED)>1)
    {
       print "You have been banned from posting";
    }

else
   {
    
    if (!isset($_POST['submit']))
    {
     print "<table border='0' width=95%><tr class='headline'><td><center>Sign Guestbook</center></td></tr>";
     print "<tr class='mainrow'><td>";
     print "<form method='post' action='addentry.php' name='form'>";
     print "<b>Name:</b><br> <input type='text' name='name' size='40'><br>";
     print "<b>Country:</b><br><input type='text' name='country' size='40'><br>";
     print "<b>Homepage(include http://):</b><br><input type='text' name='homepage' size='40'><br>";
     print "<b>E-mail:</b><br><input type='text' name='email' size='40'><br>";
     print "<b>Aim:</b><br><input type='text' name='aim' size='40'><br>";
     print "<b>ICQ:</b><br><input type='text' name='icq' size='40'><br>";
     print "<b>Yahoo:</b><br><input type='text' name='yim' size='40'><br>";
     print "<b>MSN:</b><br><input type='text' name='msn' size='40'><br>";
     print "<b>Comment:</b><br>";
     print "<textarea rows='6' name='comment' cols='45'></textarea><br>";

     print "<input type='submit' name='submit' value='submit'>";
     print "</form><br>";
     print "<center>Clickable Smilies</center>";
     //Clickable smilies
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
     print "document.form.comment.value += textToAdd;";
     print "document.form.comment.focus();\n";
     print "}\n";
     print "</script>\n";
     print "<br><br>";
     print "<A href='bbcode.php' target='top'>BBCode instructions</a>";
     print "</td></tr></table>";
   }
 
    


  else if (isset($_POST['submit']))
  {
    print "<center>";
    print "<table border='0' width=95%><tr class='headline'><td><center>Sign Guestbook</center></td></tr>";
    print "<tr class='mainrow'><td>";
    $name=$_POST['name'];
    $country=$_POST['country'];
    $email=$_POST['email'];
    $homepage=$_POST['homepage'];
    $aim=$_POST['aim'];
    $icq=$_POST['icq'];
    $yim=$_POST['yim'];
    $msn=$_POST['msn'];
    $comment=$_POST['comment'];
    if(strlen($name)<1 || strlen($comment)<1)
    {
      print "<font color='red'>Name or comment not entered, please go back and sign again</font><br>";
    }
   else
    {
     $r=$_SERVER["REMOTE_ADDR"];
     $day=date("D M d, Y H:i:s");
     $timegone=date("U") ; //seconds since Jan 1st, 1970
     $putinguestbook="INSERT INTO bl_gbook(name, country, mail, homepage, comment, realtime, aim, icq, yim, msn, time,IP) VALUES('$name','$country','$email','$homepage','$comment','$day','$aim','$icq','$yim','$msn','$timegone','$r')";
     mysql_query($putinguestbook);
     print "Thanks for posting, you will now be redirected <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'> ";
    }
    print "</td></tr></table></center>";
  }
}  
?>


