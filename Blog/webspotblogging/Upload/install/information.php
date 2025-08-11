<?
include("../inc/installheader.inc.php");
?>
Please fill out the form below to continue.<BR>
<form action="insertinfo.php" method="post">
<table>
<!--Start Database Settings Table-->
<tr>
<td>Blog Name</td>
<td><input type="text" name="name"></td>
</tr>
<tr>
<td>Admin Username</td>
<td><input type="text" name="username"></td>
</tr>
<tr>
<td>Admin Password</td>
<td><input type="password" name="password"></td>
</tr>
<tr>
<td>Admin Email</td>
<td><input type="text" name="email"></td>
</tr>
<tr>
<td>Your Website's name</td>
<td><input type="text" name="websitename"></td>
</tr>
<tr>
<td>Your Website's url</td>
<td><input type="text" name="websiteurl"></td>
</tr>
<!--End Database Settings Table-->
</table>
<BR>
<b>
Please verify that all these settings above are correct and then press next.
</b>
<input type="submit" value="Next Step" style="float:right;">
</form>
<?
include("../inc/footer.inc.php");
?>