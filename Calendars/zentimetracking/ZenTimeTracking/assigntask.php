<?ob_start();
include("top.php");
include ("menu.php");
include "dataaccess1.php" ;
$taskfield = "";
session_start();
if(session_is_registered("whossession")){
    if (($_SESSION['who'])=="user"){
    $username1 = $_SESSION['username'];
    //echo $username;
    dbConnect();
  if (!empty($_POST[field]))
  { $taskfield ="entered";}
   if(!empty($_POST[nooffields]))
   {
     $i=0;
     while ($nooffields) {
     $i++;
     $description= $_POST["description".$i];
     $hours = $_POST["hours".$i];
     if (!empty($description)){
     $result = mysql_query("insert into ".$tblreport." (categoryname,description,hoursspent,reporteddate,username) values('" . $_POST[category]. "','" . $description . "','" . $hours . "',SYSDATE(),'" . $username1 . "')" .  mysql_error());
     $taskfield = "inserted";
     }
   $nooffields=$nooffields-1;}
   }
 ?>
<form name="task" action="assigntask.php" method="post">
<? if (empty($taskfield)){ ?>
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
<TD noWrap><SPAN class=c>Please Assign Task :: </SPAN></TD>
</TR></TBODY></TABLE></TD></TR>
<TR class=a>
<TD>
<TABLE cellSpacing=6 width="100%">
<TBODY>
<TR>
<TD align=right width=200><B>Enter&nbsp;Required&nbsp;Number&nbsp;of&nbsp;Fields&nbsp;:</B></TD>
<TD align=right width=80><INPUT class=ia maxLength=25 name=field
size=3></TD></TR>
<TR>
<TD align=right colSpan=2><INPUT class=buttonclass type=submit value=Create>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
 <?}elseif($taskfield=="inserted"){
  echo "<center>Tasks added Sucessfully.</center>";
 }else{ $nooffields = $_POST[field];
 $result = mysql_query("select * from ".$tblcategory .  mysql_error());
 ?>
<input type="hidden" name="nooffields" value="<?echo ($nooffields);?>">
<table align="center" border="0" width="600">
  <tbody>
    <tr>
      <td colSpan="2">
        <table border="0" cellPadding="0" cellSpacing="0" width="100%">
          <tbody>
            <tr>
              <td class="q">
                <table border="0" cellPadding="5" cellSpacing="1" width="100%">
                  <tbody>
                    <tr class="c">
                      <td colSpan="5">
                        <table cellPadding="2" cellSpacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td noWrap colspan="2"><span class="c">
                                Enter Task Detail</span></td><TD noWrap><SPAN class=c><td align="right"><a href="user.php" style="COLOR: #ffffff;"><b>Home</b></a></b></td></SPAN></TD>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <TR class="a">
                    <TD align=left colspan=3><B>Select&nbsp;Category&nbsp;:&nbsp;</B>
                    <select size=1 name="category">
                    <option value=""></option>
                    <?while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {?>
                    <option value="<? echo($row['categoryname']); ?>"><?echo($row["categoryname"]);?></option>
                    <?}?>
                    </select></TD></TR>
                    <tr class="z">
                      <td class="f" noWrap width="10%">&nbsp;SL&nbsp;No.&nbsp;</td>
                      <td class="f" noWrap width="60%">&nbsp;Description&nbsp;</td>
                      <td class="f" noWrap width="30%">&nbsp;Hours&nbsp;Spent&nbsp;(HH:MM)</td>
                    </tr>
                     <?
                     $i=0;
                    while ($nooffields) {
                    $i++;
                    ?>
                    <tr class="a">
                      <td><? echo($i); ?></td>
                      <TD align=right width=60%><textarea class=ia cols=40 rows=3 name="description<?echo($i);?>"></textarea></TD>
                      <TD align=right width=30%><INPUT class=ia maxLength=150 name="hours<?echo($i);?>" size=25></TD>

                    <? $nooffields=$nooffields-1; }?></tr>
                       <tr class=z>
                        <td width=100% nowrap align=center colspan="3"><input type="submit" class="buttonclass" value="Submit" name="delete"></td>
                      </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
<?}?>
</form>
<?include("base.php");
    }}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
ob_end_flush();?>

