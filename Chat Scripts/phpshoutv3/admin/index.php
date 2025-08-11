<?
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>phpSHOUT Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="phpshoutadmin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {color: #FF0000}
-->
</style>
</head>

<body class="phpshout_body">
<?
	if (isset($_POST["Submit"])) {
		
		include "../config.php";
		if ($_POST["usr"] == $username && $_POST["pwd"] == $password) {
		
			session_start();
			$_SESSION["phpshout_admin_login"] = $_POST["usr"];
			$_SESSION["phpshout_admin_pwd"]  = $_POST["pwd"];
			
			header('Location: manage.php');
		} else {
			echo "<p class=\"error\">error. incorrect details. <a class=\"phpshout_link\" href=".$_SERVER['HTTP_REFERER'].">go back</a></p>";
		}
		
	} else {	
		
?>
<form name="form1" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
  <table align="center" cellpadding="5" cellspacing="0" class="phpshout_adminview">
    <tr>
      <td colspan="2" class="phpshout_posts"><p><strong>phpSHOUT Administrator Login <br>
        </strong>Welcome to phpSHOUT Administrator.</p>
        <p> Please login below to start managing your shoutbox.</p>      </td>
    </tr>
    <tr bgcolor="#6699CC">
      <td class="phpshout_posts">&nbsp;</td>
      <td class="phpshout_posts">&nbsp;</td>
    </tr>
    <tr>
      <td class="phpshout_posts">Username : </td>
      <td class="phpshout_posts"><input name="usr" type="text" id="usr" size="40"></td>
    </tr>
    <tr>
      <td class="phpshout_posts">Password : </td>
      <td class="phpshout_posts"><input name="pwd" type="password" id="pwd" size="40"></td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td class="phpshout_posts">&nbsp;</td>
      <td class="phpshout_posts"><input type="submit" name="Submit" value="Log In"></td>
    </tr>
  </table>
</form>
<?
}
?>
</body>
</html>
<?
ob_end_flush();
?>