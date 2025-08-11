<?php

session_start();

if(!isset($uid)) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>Please Login:</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<BODY>
<p class="style2"><form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                <table width="285" border="0" cellpadding="2" cellspacing="1">
                  <tr> 
                    <td width="91"><span class="style3"><font size="2">User 
                      ID:</font></span></td>
                    <td width="187"><span class="style3"><font size="2"> 
                      <input type="text" name="uid" size="10">
                      </font></span></td>
                  </tr>
                  <tr> 
                    <td><span class="style3"><font size="2">Password: 
                      </font></span></td>
                    <td class="style1"><span class="style3"><font size="2"> 
                      <input type="password" name="pwd" size="10">
                      </font></span></td>
                  </tr>
                  <tr> 
                    <td><span class="style3"><font size="1">
                      <input name="Submit" value="Submit" type="submit" id="Submit">
                      </font> </span></td>
                    <td><span class="style3"></span></td>
                  </tr>
                </table>
              </form> </p>
			  </body>
			  </html>

<?php
exit;
}

session_register("uid");
session_register("pwd");

$pwd = str_replace( '$', "$", $pwd);
 
if ( get_magic_quotes_gpc() )
{
 $pwd = stripslashes($pwd);
}

$luser = strtolower($uid);
$pwd = strtolower($pwd);

if($luser !== strtolower($scriptuser) or $pwd !== strtolower($scriptpass)) {

  session_unregister("uid");  
  session_unregister("pwd");
  
  unset($uid);
  unset($pwd);
  
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Error:</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
Wrong Pass.
</body>
</html>
<?php
  exit;
}
?>