<?php
print "<table class='maintable'>";
print "<tr class='headline'><td>Main Variables</td></tr>";
print "<tr class='mainrow'><td>";
print "<li><A href='editstyle.php'>Edit Stylesheet</a><br>";
print "<li><A href='editvars.php'>Edit main Vars</a><br>";
print "<li><A href='ban.php'>Ban IP</a><br>";
print "<li><A href='unban.php'>Unban IP</a><br>";
print "<li><A href='../index.php'>Admin Browsing(editing comments and entries)</a>";
print "</td></tr></table><br><br>";
if($getadmin3[status]==3)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td>Announcements</td></tr>";
  print "<tr class='mainrow'><td>";
  print "<li><A href='addann.php'>Add announcement</a><br>";
  print "<li><A href='manageann.php'>Edit/Delete announcements</a><br>";
  print "</td></tr></table>";
  print "<br><br>";
}
if($getadmin3[status]==3)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td>Users</td></tr>";
  print "<tr class='mainrow'><td>";
  print "<li><A href='adduser.php'>Add user</a><br>"; 
  print "<li><A href='edituser.php'>Edit/delete User</a><br>";
  print "</td></tr></table><br><br>";
}

print "<table class='maintable'>";
print "<tr class='headline'><td>Profile/Picture</td></tr>";
print "<tr class='mainrow'><td>";
print "<li><A href='picture.php'>Change/edit profile Pic</a><br>";
print "<li><A href='profile.php'>Change Profile</a><br>";
print "</td></tr></table><br><br>";
print "<table class='maintable'>";
print "<tr class='headline'><td>Resume</td></tr>";
print "<tr class='mainrow'><td>";
print "<li><A href='resume.php'>Add/Edit Resume</a>";
print "</td></tr></table><br><br>";
print "<table class='maintable'>";
print "<tr class='headline'><td>GuestBook Controls</td></tr>";
print "<tr class='mainrow'><td>";
print "<li><A href='../guestbook/index.php?membername=$blogadmin'>Admin Browsing</a><br>";
print "<li><A href='gbprune.php'>Prune</a><br>";
print "</td></tr></table><br><br>";
print "<table class='maintable'><tr class='headline'><td>Blog Control</td></tr>";
print "<tr class='mainrow'><td>";
print "<li><A href='addarticle.php'>Add Entry</a><br>";
print "<li><A href='../members.php?membername=$blogadmin'>Edit/Delete Entries</a><br>";
print "<li><A href='pruneentries.php'>Prune Entries</a><br>";
print "</td></tr></table><br><br>";
if($getadmin3[status]==3)
{
  print "<table class='maintable'><tr class='headline'><td>Poll Control(only 1 may run at a time)</td></tr>";
  print "<tr class='mainrow'><td>";
  print "<li><a href='addpoll.php'>Add Poll</a><br>";
  print "<li><A href='deletepoll.php'>Delete Poll</a><br>";
  print "<li><A href='addchoice.php'>Add Poll Choice</a><br>";
  print "<li><A href='delchoice.php'>Delete Poll Choice</a><br>";
  print "</td></tr></table><br><br>";
}
print "<table class='maintable'><tr class='headline'><td>Edit Calendar</td></tr>";
print "<tr class='mainrow'><td>";
print "<A href='calen.php'>Edit Calendar</a><br>";
print "<A href='flushcal.php'>Flush Calendar</a><br>";
print "</td></tr></table><br><br>";

print "<table class='maintable'><tr class='headline'><td>Add user photos</td></tr>";
print "<tr class='mainrow'><td>";
print "<A href='adduserphoto.php'>Add Photo</a><br>";
print "<A href='deleteuserphoto.php'>Delete user Photo</a><br>";
print "</td></tr></table><br><br>";
print "<table class='maintable'><tr class='headline'><td>Unique blocks</td></tr>";
print "<tr class='mainrow'><td>";
print "<A href='uleft.php'>Edit right block</a><br>";
print "<A href='right.php'>Edit left Block</a><br>";
print "</td></tr></table>";
