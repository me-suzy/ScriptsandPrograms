<?
ob_start();
include("top.php");
include ("menu.php");
include("dataaccess1.php");
if (!empty($_POST['password']))
{
   $username =$_POST['username'];
   $password =$_POST['password'];
   dbConnect();
   $result1 = mysql_query("select * from ".$tbluser." where username='". $username ."' and password='". $password ."'".  mysql_error());
   if (!$result1) {
     die('Invalid query: ' . mysql_error());
   }
    $rows = mysql_num_rows($result1);
    if ($rows != 0){
    session_start();
      if(session_is_registered("whossession"))
      {
        $_SESSION['who']="user";
        $_SESSION['username']=$username;
        header("location:user.php");
      }
      else
      {
        session_register("whossession");
        $_SESSION['who']="user";
        $_SESSION['username']=$username;
        header("location:user.php");
      }
    }else{
     header("location:userlogin.php?error=yes");
     }
}else { ?>
<FORM action=userlogin.php method=post name=y>
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
<TD noWrap><SPAN class=c>User Login</SPAN></TD>
<TD align=right noWrap><B><A href="index.php"
style="COLOR: #ffffff">Cancel</A></B></TD>
</TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<? if (!empty($_GET['error'])){ ?>
<tr><td colspan=2><font color="red" face="verdana">username/password wrong,  please try again</font></td></tr>
<? } ?>
<TR>
<TD align=right width=80><B>User&nbsp;Name:</B></TD>
<TD align=right width=220><INPUT class=ia maxLength=25 name=username
size=25></TD></TR>
<TR>
<TD align=right width=80><B>Password:</B></TD>
<TD align=right width=220><INPUT type="password" class=ia maxLength=25 name=password
size=25></TD></TR>
<TR>
<TD align=right colSpan=2><INPUT class=buttonclass type=submit value=Submit>
</TD></TR>
<TR>
<TD align=right colSpan=2>click here to ::&nbsp;<a href="register.php"><font color="blue">REGISTER USER</font></a>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
</FORM>
</body>
</html>
<?
}
include("base.php");
ob_end_flush();
?>