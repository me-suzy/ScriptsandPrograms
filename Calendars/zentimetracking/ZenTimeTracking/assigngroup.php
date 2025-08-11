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
     $username =$_POST['username'];
     $groupname =$_POST['groupname'];
     $result2 = mysql_query("update ".$tblreport." set groupname = '" . $groupname . "' where username='" . $username . "'" .  mysql_error());
     $result3 = mysql_query("update ".$tbluser." set groupname = '" . $groupname . "' where username='" . $username . "'" .  mysql_error());
     $assigned = "yes";
     if (!$result2 || !$result3) {
     die('Invalid query: ' . mysql_error());
     }
}
$result = mysql_query("select * from ".$tblgroup .  mysql_error());
$result1 = mysql_query("select * from ".$tbluser .  mysql_error());
?>
<FORM action=assigngroup.php method=post name=y>
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
<TD noWrap><SPAN class=c>Assign Group To User</SPAN></TD>
</TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<? if (!empty($_POST['groupname'])) {
   if ($assigned=="yes"){
?>
<TR>
<TD align=left colspan=2 ><font color="blue">Group Assigned Successfully.</TD>
</TR>
<?}}?>
<TR>
<TD align=right width=80><B>Select&nbsp;Group:</B></TD>
<TD align=left width=200><select size=1 name="groupname">
<option selected value="">select</otpion>
<?while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {?>
<option value="<? echo($row['groupname']); ?>"><?echo($row["groupname"]);?></option>
<?}?>
</select></TD></TR>
<TR>
<TD align=right width=80><B>Select&nbsp;User:</B></TD>
<TD align=left width=200><select size=1 name="username">
<option selected value="">select</otpion>
<?while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) {?>
<option value="<? echo($row1['username']); ?>"><?echo($row1["username"]);?></option>
<?}?>
</select></TD></TR>
<TR>
<TD align=center colSpan=2><INPUT class=buttonclass type=submit value=Assign>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
</body>
</html>
<?include("base.php");
    }}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
ob_end_flush();?>

