<?ob_start();
include("top.php");
include("menu.php");
include "dataaccess1.php" ;
if (!empty($_POST['password']))
{
   $username =$_POST['username'];
   $password =$_POST['password'];
   $emil =$_POST['mail'];
   dbConnect();
   $result = mysql_query("insert into ".$tbluser." (username,password,email) values('" . $username . "','" . $password . "','" . $email . "')" .  mysql_error());
  if (!$result) {
     die('Invalid query: ' . mysql_error());
     }
   header('location:userlogin.php');
   }

?>

<FORM action=register.php method=post name=y>
<input type="hidden" name="regadmin" value="yes">
<TABLE align=center border=0 cellPadding=0 cellSpacing=0 width=280>
<TBODY>
<TR>
<TD class=q>
<TABLE border=0 cellPadding=5 cellSpacing=1 width="100%">
<TBODY>
<TR class=c>
<TD>
<TABLE cellPadding=1 cellSpacing=0 width="100%">
<TBODY>
<TR>
<TD noWrap><SPAN class=c>User Registration</SPAN></TD>
</TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<TR>
<TD align=left colspan=2 >Enter the username/password to register</TD>
</TR>
<TR>
<TD align=right width=80><B>User&nbsp;Name:</B></TD>
<TD align=right width=220><INPUT class=ia maxLength=25 name=username
size=25></TD></TR>
<TR>
<TD align=right width=80><B>Password:</B></TD>
<TD align=right width=220><INPUT class=ia maxLength=25 name=password
size=25></TD></TR>
<TR>
<TD align=right width=80><B>E-mail:</B></TD>
<TD align=right width=220><INPUT class=ia maxLength=150 name=mail
size=25></TD></TR>
<TR>
<TD align=right colSpan=2><INPUT class=buttonclass type=submit value=Submit>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
</body>
</html>
<?
include("base.php");
ob_end_flush();?>

