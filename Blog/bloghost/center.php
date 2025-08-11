<?php

  $getblog="SELECT * from bl_blog a, bl_admin b where b.adminid=a.author and b.adminid='$getvars3[adminid]' order by realtime desc limit 15";
  $getblog2=mysql_query($getblog) or die(mysql_error());
  $getblog3[shortblurb]=smile($getblog3[shortblurb]);
  while($getblog3=mysql_fetch_array($getblog2))
  {
    print "<table class='maintable'><tr class='headline'><td><b>$getblog3[blogtitle]</b> posted by $getblog3[username]<br>";
    print "Posted on $getblog3[thetime]</td></tr>";
    print "<tr class='mainrow'><td>";
    print "$getblog3[shortblurb]<br>";
    if(strlen($getblog3[maincontent])>1) //if there is a long text
    {
      print "<A href='more.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>More ...</a><br>";
    }
    if($getblog3[allowcomments]==1)
    {
      print "<br><A href='comments.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>$getblog3[numcomments] comments</a>--<A href='postcomment.php?memberID=$getvars3[username]&ID=$getblog3[entryid]'>Add comment</a>";
    }
    if($_SESSION['blogadmin']==$membername || $yoursession2[status]==3)
    {
      print "<br><br><A href='../admin/editblog.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>Edit entry</a>--<A href='../admin/deleteentry.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>Delete Entry</a>";
    }
    print "</td></tr></table><br>";
  }
print "</center>";
?>