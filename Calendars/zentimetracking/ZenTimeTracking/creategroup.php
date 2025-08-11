<?ob_start();?>
<?
include ("menu.php");
include "dataaccess1.php" ;
session_start();
if(session_is_registered("whossession")){
if (($_SESSION['who'])=="manager"){
dbConnect();
if (!empty($_POST['groupname']))
{
   $groupname =$_POST['groupname'];
   $result1 = mysql_query("select * from ".$tblgroup." where groupname='" . $groupname . "'" .  mysql_error());
   $rows = mysql_num_rows($result1);
    if ($rows != 0){
    $created="exist";
    }else{
     $result2 = mysql_query("insert into ".$tblgroup." (groupname) values('" . $groupname . "')" .  mysql_error());
     if (!$result2) {
     die('Invalid query: ' . mysql_error());
     }
    }
}

?>
<FORM action=creategroup.php method=post name=y>
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
<TD noWrap><SPAN class=c>Create Group</SPAN></TD>
</TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<? if (!empty($_POST['groupname'])) {
   if ($created=="exist"){
?>
<TR>
<TD align=left colspan=2 ><font color="red">Sorry, group already exist</TD>
</TR>
<?}}?>
<TR>
<TD align=right width=80><B>Enter&nbsp;Group&nbsp;Name:</B></TD>
<TD align=right width=200><INPUT class=ia maxLength=25 name=groupname
size=25></TD></TR>
<TR>
<TD align=right colSpan=2><INPUT class=buttonclass type=submit value=Create>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
</body>
</html>
<?include("base.php");
    }}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
ob_end_flush();?>

