<?ob_start();
include("top.php");
include ("menu.php");
$created="";
//include("topinstallmenu.php");
include "dataaccess1.php" ;
session_start();
if(session_is_registered("whossession")){
if (($_SESSION['who'])=="manager"){
if (!empty($_POST['password']))
{
   $username =$_POST['username'];
   $password =$_POST['password'];
   dbConnect();
   $result1 = mysql_query("select * from ".$tblmanager." where username='" . $username . "'" .  mysql_error());
   $rows = mysql_num_rows($result1);
    if ($rows != 0){
    $created="exist";
    }else{
     $result = mysql_query("insert into ".$tblmanager." (username,password) values('" . $username . "','" . $password . "')" .  mysql_error());
     if (!$result) {
     die('Invalid query: ' . mysql_error());
     }
     header('location:main.php');
     }
 }
?>

<FORM action=regadmin1.php method=post name=y>
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
<TD noWrap><SPAN class=c>Manager/USer Registration</SPAN></TD>
</TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<TR>
<?
echo('<td align=center><a href="regadmin1.php"><Font color="black">Register Manager</font></td>');
?>
</TR>
<TR>
<TR>
<? echo('<td align=center><a href="register1.php"><Font color="black">Register User</Font></td>'); ?>
</TR>
</TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
</body>
</html>
<?include("base.php");
    }}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
ob_end_flush();?>

