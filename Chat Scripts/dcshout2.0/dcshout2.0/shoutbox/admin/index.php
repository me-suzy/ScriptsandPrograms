<?php
//Dc-shout2.0 (c)devilcoderz 2004

include "header.php";
include "config.php";
include "functions.php";
if ($dc=="")
{
if (!session_is_registered(username)) {
echo"
<form method=\"POST\" action=\"index.php?dc=login\">
<center>Username :<input type=\"text\" NAME=\"username\" size=\"20\"><br>
Password :<input type=\"text\" NAME=\"password\" size=\"20\"><br>
<input type=\"submit\" value=\"Log In\" Name=\"submit\">
</form>
</center>";
}
else 
{
echo "welcome back to Dc shout admin panel";
}
}
if ($dc=="login")
{
if (!$_POST['username'] | !$_POST['password'] )
{
die('You did not fill in a username or password.<u><a href=javascript:%20history.back(-2)>Back</a></u>.') ;
}
$user = $username ;
$pass = md5 ($_POST['password']) ;
$result=mysql_query("select * from dc_admin where user='$user' ") or die ("No such username");
while ($row=mysql_fetch_array($result)) {
if ($row["password"]==$pass) {
echo ("You are now logged in $user!");
$_SESSION["username"] = "$user"; 
$_SESSION["password"] = "$pass"; 
}
else
{
echo"no such password";
}
}
}
if ($dc=="logout")
{
logout() ;
}
include "footer.php";
?>










