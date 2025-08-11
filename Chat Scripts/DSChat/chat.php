<?
include("chatconfig.php");
if (!file_exists("users/" . $_COOKIE['cookie_dschat'] . "")){
if ($hour == "23") {
echo "<head><title>" . $name . ": Error!</title></head>";
echo "<body bgcolor=" . $bg . ">";
echo "<center><strong><u><font color=" . $col3 . " size=7>" . $name . "</font></strong></u><br><br>";
echo "The server is currently resetting it's self. You've been automatically kicked.<br>Please check back later.</center>";
exit;
} else {
$no23 = "1";
}
if ($hour == "11") {
echo "<head><title>" . $name . ": Error!</title></head>";
echo "<body bgcolor=" . $bg . ">";
echo "<center> <font color=" . $col1 . ">" . $name . "</font></center>";
echo "The server is currently resetting it's self. You've been automatically kicked.<br>Please check back later.";
exit;
} else {
$no11 = "1";
}
}
?>
<html>
<head>
<title>
<? echo $name; ?>
</title>
</head>

<?
if (!isset($_COOKIE['cookie_dschat']))  
{
?>
<body bgcolor="<? echo $bg; ?>">
<center><strong><u><font face="arial" color="<? echo $col3; ?>" size="7"><? echo $name ?></font></strong></u></center>
<form method="POST" action="login.php">
    <center><h1>Login</h1>
      <Center>
        <table border="0" width="auto">
        <tr>
          <td>Nickname</td>
          <td><input type="text" name="usr" size="20"></td>
          <td> </td>
        </tr>
		</table>
    <center>
    <p><input type="submit" value="Submit" name="sub">
    <input type="reset" value="Reset" name="res"></p>
    </center>
    </form>
    <br><br>
    </body>

<IFRAME SRC="name2.php" TITLE="names" frameborder=0 scrolling="auto" width="145">
<!-- Alternate content for non-supporting browsers -->
<h3>WARNING: <BR>
YOUR BROWSER DOES NOT SUPPORT IFRAMES,
<BR>
AND THEREFOR WILL NOT ALLOW DSCHAT TO FUNCTION CORRECTLY.<br><br>
TURN FRAMES ON TO VIEW DSCHAT CORRECTLY.
</IFRAME>
	<?
	echo "<br><br><br><br>				<hr width=35%>";
}
else
{
  //Cookie is set and display the data
   $cookie_info = explode("-", $_COOKIE['cookie_dschat']);  //Extract the Data
   $user = $cookie_info[0];
   echo "<body>";
   echo "<center>Logged in as $user.";  
   echo "<br><a href='logout.php'>Logout</a>.</center><br>";
?>
<strong><u><font face="arial" color="<? echo $col3; ?>" size="7"><? echo $name ?></font></strong></u>
<table>
<tr>
       <td bgcolor="<? echo $col1; ?>" width="500" height="500">
<IFRAME SRC="center.php" TITLE="center" frameborder=0 scrolling="no" width="499" height="495">
<!-- Alternate content for non-supporting browsers -->
<h3>WARNING: <BR>
YOUR BROWSER DOES NOT SUPPORT IFRAMES,
<BR>
AND THEREFOR WILL NOT ALLOW DSCHAT TO FUNCTION CORRECTLY.<br><br>
TURN FRAMES ON TO VIEW DSCHAT CORRECTLY.
</IFRAME>
	   </td>
       <td bgcolor="<? echo $col2; ?>" width="150" height="500">
<IFRAME SRC="names.php" TITLE="names" frameborder=0 scrolling="no" width="145" height="495">
<!-- Alternate content for non-supporting browsers -->
<h3>WARNING: <BR>
YOUR BROWSER DOES NOT SUPPORT IFRAMES,
<BR>
AND THEREFOR WILL NOT ALLOW DSCHAT TO FUNCTION CORRECTLY.<br><br>
TURN FRAMES ON TO VIEW DSCHAT CORRECTLY.
</IFRAME>
	   </td>
</tr>
</table>
	   <center>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onClick="window.open('admin.php','newwin','width=505,height=500'); return false;">Admin Panel</a>
	   </center>
	   			<?
				}
				?>
				Powered by <a href="http://www.dvondrake.com" target="_BLANK">DSChat 1.0</a>
</body>
</html>
