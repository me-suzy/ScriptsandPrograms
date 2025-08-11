<html>
<head>
	<title>Admin Login</title>
</head>
<?
include("chatconfig.php");
?>
<body>
<?
if (!isset($_COOKIE['cookie_dschata']))  
{
?>
<form method="POST" action="alogin.php">
    <center><h1>Admin Login</h1>
      <Center>
        <table border="0" width="auto">
        <tr>
          <td>Password</td>
          <td><input type="password" name="pass" size="20"></td>
          <td> </td>
        </tr>
		</table>
    <center>
    <p><input type="submit" value="Submit" name="sub">
    <input type="reset" value="Reset" name="res"></p>
    </center>
    </form>
	<?
}
else
{
  //Cookie is set and display the data
   $cookie_info = explode("-", $_COOKIE['cookie_dschata']);  //Extract the Data
   if ($_COOKIE['cookie_dschata'] == $pass1) { 
   $usrlvl = "admin";
   }
   if ($_COOKIE['cookie_dschata'] == $pass2) {
      $usrlvl = "moderator";
      }
   echo "<center>Logged in as $usrlvl.";  
   echo "<br><a href='alogout.php'>Logout</a>.<br><strong><u><font face=arial color=#000000 size=7>Admin Controls</font></strong></u><br><a href=admin.php>REFRESH PAGE</a></center>";
?>
<form method="POST" action="edit.php"><input name="asdf999" type="hidden" value="qwerty777"><input type="submit" value="Edit Config"></form>
<br>
<form method="POST" action="dump.php"><input type="submit" value="Dump Data"></form>
<br>
<?
$folder = "users";
if ($handle = opendir($folder)) {
    while (false !== ($file = readdir($handle))) { 
        if (is_file("$folder/$file")) { 
            $size = filesize("$folder/$file");
            echo "$file<form method=POST action=kick.php><input type=submit value=Kick><input name=name type=hidden value=$file></form>"; 
        } 
    }
    closedir($handle); 
}

   }?>


</body>
</html>
