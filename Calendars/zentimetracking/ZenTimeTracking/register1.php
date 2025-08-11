<?ob_start();
include "dataaccess1.php";
include "menu.php";
$created="";
session_start();
if(session_is_registered("whossession")){
if (($_SESSION['who'])=="manager"){
if (!empty($_POST['password']))
{
   $username = $_POST['username'];
   $password =$_POST['password'];
   $email = $_POST['mail'];
   dbConnect();
   $result1 = mysql_query("select * from ".$tbluser." where username='" . $username . "'" .  mysql_error());
   $rows = mysql_num_rows($result1);
    if ($rows != 0){
    $created="exist";
    }else{
     $result = mysql_query("insert into ".$tbluser."(username,password,email) values('" . $username . "','" . $password . "','" . $email . "')" .  mysql_error());
     if (!$result) {
     die('Invalid query: ' . mysql_error());
     }$created="yes";
     }
 }

?>
<html>
<head>
<title></title>
<LINK href="incl/style.css" rel=stylesheet>
</head>
<body>

<FORM action=register1.php method=post name=y>
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
<TD noWrap><SPAN class=c>User Registration</SPAN></TD> <TD noWrap><SPAN class=c><td align="right"><b><a href="index.php" style="COLOR: #ffffff">Cancel</a></b></td></SPAN></TD>
</TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<? if (!empty($_POST['username'])) {
   if ($created=="yes"){
?>
<TR>
<TD align=left colspan=2 ><font color="blue">User registered successfully.&nbsp;<a href="userlogin.php">Login</a></font></TD>
</TR>
<? }elseif($created=="exist"){?>
<TR>
<TD align=left colspan=2 ><font color="red">user name already exist, please try by other name</font></TD>
</TR>
<? }else{?>
<TR>
<TD align=left colspan=2 ><font color="red">Please enter the required details</font></TD>
</TR>
<?}} ?>
<TR>
<TD align=right width=80><B>Enter&nbsp;User&nbsp;Name&nbsp;:</B></TD>
<TD align=right width=220><INPUT class=ia maxLength=25 name=username
size=25></TD></TR>
<TR>
<TD align=right width=80><B>Enter&nbsp;Password&nbsp;:</B></TD>
<TD align=right width=220><INPUT class=ia maxLength=25 name=password
size=25></TD></TR>
<TR>
<TD align=right width=80><B>E-mail&nbsp;:</b></TD>
<TD align=left width=220><INPUT class=ia maxLength=200 name=mail
size=25></TD>
</TD></TR>
<TR>
<TD align=right colSpan=2><INPUT class=buttonclass type=submit value=Submit>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
</body>
</html>
<?include("base.php");
}}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
ob_end_flush();?>