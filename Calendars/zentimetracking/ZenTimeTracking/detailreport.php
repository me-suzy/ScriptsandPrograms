<?
ob_start();
?>
<html>
<script language="javascript">
//********used to block the numbers in name textboxes****************
function hidenumbers(){

    if ((window.event.keyCode>47)&&(window.event.keyCode<58))
    window.event.keyCode=0;
}
</script>
<?php
session_start();
if(session_is_registered("whossession")){
if (($_SESSION['who'])=="manager"){
include("menu.php");
include("functions.php");
include "dataaccess1.php" ;
dbconnect();
if (!empty($_GET['del'])){
$result = mysql_query("delete from ".$tblreport." where reportid='" . $_GET['del'] . "'" .  mysql_error());
  if (!$result) {
     die('Invalid query: ' . mysql_error());
     }
}

$result = mysql_query("select * from ".$tblgroup .  mysql_error());
$result1 = mysql_query("select * from ".$tbluser .  mysql_error());
    $UserName = "";
    $GroupName = "";
    $ReportType = "";
    $i = 0;
    
if ((!empty($_POST)) || (!empty($_GET)))
{
    if (!empty($_POST['UserName']))
        $UserName =  $_POST['UserName'];
    if (!empty($_POST['GroupName']))
        $GroupName =  $_POST['GroupName'];

    if (!empty($_GET['UserName']))
        $UserName =  $_GET['UserName'];
    if (!empty($_GET['GroupName']))
        $GroupName =  $_GET['GroupName'];


    $orderby = "username";

    $order = "asc";

    

$whereClause="";


if (!empty($UserName))
{
    if($UserName !="all")
    {   
        $whereClause = $whereClause . whereorand($i) . " username ='".$UserName."'";
        $i = $i + 1;
    }
}
if (!empty($GroupName)) 
{
    if($GroupName !="all")
    {
        $whereClause = $whereClause . whereorand($i) . " groupname='". $GroupName ."'";
        $i = $i + 1;
    }
}

// Number of records to display
$nb = 10;
if (!isset($_GET['page'])) $page = 1;
// Used for paging
else $page = intval($_GET['page']);
if (!isset($_GET['total']))
{
    $userquery="Select count(*) as count from ". $tblreport . $whereClause .mysql_error();// and  UserId =".$UserId;
    $result = mysql_query($userquery);
    $total = mysql_result($result,'0','count');
    echo $total;
}
else $total = intval($_GET['total']);
$debut = ($page - 1) * $nb;

$userquery="select reportid,categoryname,username,groupname,description,DATE_FORMAT(reporteddate,'%m-%d-%y') as reporteddate,hoursspent from ".$tblreport . $whereClause. " order by reporteddate"." ".$order." LIMIT ".$debut.",".$nb;

$result=mysql_query($userquery);
    if (!$result) {
       die('<font color=red>Invalid query: ' . mysql_error());
       }
    $noofrows = mysql_num_rows($result);
    echo "<body leftmargin=0 topmargin=0><br>";
    echo "<br><div align=center>Total Number of Tasks found for selected report : " . $noofrows . "<br>";
    echo "<BR><table width=700 align=center border=0><tr bgcolor=#0066CC class=header><th class=header>User</th><th class=header>Group</th><th class=header>Category</th><th class=header>Description</th><th class=header>Date</th><th class=header>Time</th><th class=header>Delete</th></tr>\n";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{
        echo "<tr bgcolor='#99CCFF'><td>".$row['username']."</td><td>".$row['groupname']."</td><td>".$row['categoryname']."</td><td>".$row['description']."</td><td>".$row['reporteddate']."</td><td>". $row['hoursspent']."</td><td><a href=detailreport.php?del=".$row['reportid']."&UserName=".$row['username']."&GroupName=".$row['groupname'].">Delete</a></td></tr>\n";
}
echo "</table><br><br>";
$nbpages = ceil($total / $nb); 
for($i = 1;$i <= $nbpages;$i ++){
//  echo '<a href="javascript:history.back();">BACK</a>';
  echo '<a class=aclass href="'.$_SERVER['PHP_SELF'].'?page='.$i.'&total='.$total.'&UserName='.$UserName.'&GroupName='.$GroupName.'">Page '.$i.'</a>';  if($i < $nbpages) echo ' - ';
}
echo "</div>";
mysql_free_result($result);
mysql_close();
}
else
{
?>
<body leftmargin=0 topmargin=0>
<br><br><br>
<form action="report.php" method="post">
<center><font face="Times New Roman" size=4> Generate Report </font>
<br><br><br>
<table cellspacing="3" cellpadding="6" border="0">
<tr>
    <td><font face=verdana size=2>Report Type </td>
    <td><select name="ReportType">
    <option value=daily>Daily</option>
    <option value=monthly>Monthly</option>
    <option value=yearly>Yearly</option>
    </select>
    </td>
</tr>
<tr>
    <td><font face=verdana size=2>User Name </td>
    <td><select size=1 name="UserName">
    <option selected value="all">All</otpion>
    <?while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) {?>
    <option value="<? echo($row1['username']); ?>"><?echo($row1["username"]);?></option>
    <?}?>
    </select>
    </td>
</tr>
<tr>
    <td><font face=verdana size=2>Group Name </td>
    <td><select name="GroupName">
   <option selected value="all">All</otpion>
   <?while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {?>
   <option value="<? echo($row['groupname']); ?>"><?echo($row["groupname"]);?></option>
   <?}?>
   </select>
   </td>
</tr>
<tr>
    <td align=right><input class="buttonclass" type="submit" name="BtnSearch" value="Submit"></td>
    <td><input class="buttonclass" type="reset" name="Reset" value=" Clear "></td>
</tr>
</table>
</form>

<?include("base.php");
    }}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
?>
</body>
</html>
<?
}
?>

 