<?
ob_start();
$path = "../";
$bypassclose = 1;
include("../inc/mainheader.inc.php");
if(isset($_SESSION['uid'])){
header("Location: index2.php");
ob_end_flush();
}
?>
<div align="center">
<form action="../login.php" method="POST">
<input type="hidden" name="adminpanel" value="1">
<table>
<tr><td>
<input type="text" name="username">
</td>
<td><input type="password" name="password"></td>
</tr>
<tr><td>Username</td><td>Password</td></tr>
</table>
<input type="submit" value="Login">
</form>
</div>
<?
include("../inc/footer.inc.php");
ob_end_flush();
?>
