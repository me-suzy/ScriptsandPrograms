<?PHP
session_start();
?>
<link rel='stylesheet' href='style.css' type='text/css'>
<?PHP
include "connect.php";
print "<center><table class='maintable'><tr class='headline'><td><center>Registering Admin</center></td></tr>";
print "<tr class='mainrow'><td>";
if (isset($_POST['submit'])) // name of submit button
{
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password=md5($password);
   $getadmin="SELECT * from bl_admin where username='$username' and password='$password' and validated='1'";
   $getadmin2=mysql_query($getadmin) or die("Could not get admin");
   $getadmin3=mysql_fetch_array($getadmin2);
   if(strlen($getadmin3['username'])<1)
   {
      print "That is the wrong admin login.";
   }
   else
   {
      $_SESSION['blogadmin']= $username;
      print "Thanks for logging in, please go to <A href='index.php'>Main Admin Page</a>.";
   }


}
print "</td></tr></table>";
?>