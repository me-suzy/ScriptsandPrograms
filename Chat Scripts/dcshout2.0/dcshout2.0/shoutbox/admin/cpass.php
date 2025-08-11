<?php
//Dc-shout2.0 (c)devilcoderz 2004

include "header.php";
include "config.php";
include "functions.php";
if (!session_is_registered(username)) {
echo "Your not loged in!" ;
}
else
{
if ($submit)
{
if (!$_POST['pass'] )
{
die('You did not put in a password.<u><a href=javascript:%20history.back(-2)>Back</a></u>.') ;
}
$password = md5 ($_POST[pass]) ;
$user= $_SESSION[username] ;
$sql ="UPDATE dc_admin SET  password='$password' WHERE user='$user' ";
$result = mysql_query($sql) or die(mysql_error());
echo "Password changed!" ;
}
else
{
echo "<b>what would you like you new pass to be?</b>" ;
?>
<form method="POST" action="cpass.php">
<input type="password" name="pass" >
<input type="submit" value="Change" name="submit"> 
</form>
<?
}
}
include "footer.php";
?>


