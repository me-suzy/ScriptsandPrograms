<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

 if(isset($IN["pass"]) && ($IN["pass"] == $CFG['PASSW'])) {
   $_SESSION["log"] = 1;
   return;
  }
 else if(isset($IN["pass"])) {
   $warning = "<br><font color=#ff0000>Wrong Password</font>";
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
 <title>Fast Click SQL</title>
 <meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1">
 <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body bgcolor="#FFFFFF">
 <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="250" align=center>
  <TR>
   <TD>
     <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
       <form action="admin.php" method=post>
       <TR><TD bgcolor="#a5bcc0" align=center style="font-size:11pt;">Administrator Login</TD></TR>
       <TR>
         <TD bgcolor="#e9e9e9" align=center>
<?=$warning?>
          <p class=form>Password:<br><input type="password" name="pass" class="field"></p>
<?if(isset($IN[page])) { ?>
          <input type="hidden" name="page" value="<?=$IN[page]?>">
<?}?>
          <input type="submit" value="Login" class=button><br><br>
         </TD>
       </TR>
       </form>
     </TABLE>
   </TD>
  </TR>
 </TABLE>
<br>
<div align=center><a class="liter2" href="<?=$CFG[URL]?>" target="_blank">Fast Click SQL <?=$CFG['SERIES']?></a> <?=$CFG['VERSION']?></div>
<div align=center>Copyright &copy;2005 by Trainer</div>
</body></html>
<?exit;?>
