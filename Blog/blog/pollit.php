<?php
include "admin/connect.php";
$yourip=$_SERVER["REMOTE_ADDR"];
$checkips="SELECT * from bl_pollip where pollip='$yourip' limit 1";
$checkips2=mysql_query($checkips) or die("Could not check ips");
$checkips3=mysql_fetch_array($checkips2);
if(isset($_POST['submit']))
{
  if(strlen($checkips3[pollip])>1)
  {
    print "You have already voted in this poll. Redirecting...<META HTTP-EQUIV = 'Refresh' Content = '2; URL =poll.php'>";
  }
  else
  {
     $choice=$_POST['choice'];
     $recordpoll="update bl_pollchoices set votes=votes+1 where choiceid='$choice'";
     mysql_query($recordpoll) or die("Could not record poll");
     $insertip="INSERT into bl_pollip (pollip) values('$yourip')";
     mysql_query($insertip) or die("Could not insert ip");
     print "Thanks for voting, redirecting... <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'>";

  }

}

?>

