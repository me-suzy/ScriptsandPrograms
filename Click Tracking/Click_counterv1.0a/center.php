<?php 
// *************************************************************************************************
// Title: 			PHP AGTC-Click Counter v1.0a
// Developed by: 	Andy Greenhalgh
// Email:			andy@agtc.co.uk
// Website:			agtc.co.uk
// Copyright:		2005(C)Andy Greenhalgh - (AGTC)
// Licence:			GPL, You may distribute this software under the terms of this General Public License
// *************************************************************************************************
//
echo"<link href='style.css' rel='stylesheet' type='text/css'>";
include "config.php";
if ($showLink == "del") {
if ($_POST['Submit'] == "Delete") {
$del_id = $_POST['del_id'];
mysql_query("DELETE FROM ClickTable WHERE click_id='$del_id'",$con);
echo "The Link ID = ".$_POST['del_id']." has been deleted !"; }
echo"<form action='' method='post' name='del'>
Enter the link ID number that you wish to delete<br>
<input name='del_id' type='text' size='5' maxlength='5'>
<input name='Submit' type='submit' value='Delete'>
</form> ";
}

if ($showLink == "list") {
$result = mysql_query("Select * from ClickTable ORDER by click_id DESC",$con);
echo"<table class='body' width='90%'  border='0' cellspacing='0' cellpadding='0'><tr>
    <th width='5%' scope='col' align='left'>ID</th>
	<th width='20%' scope='col' align='left'>Click Name</th>
    <th width='55%'scope='col'>Click URL</th>
	<th width='10%'scope='col'>Count</th>
	<th width='10%'scope='col'>Bar</th>
  </tr></table><br>";

$n = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$n++;
echo"<table width='90%'  border='0' cellspacing='0' cellpadding='0'>
   
  <tr>
  <th width='5%'>".$row['click_id']."</th>
    <th width='20%' scope='col' align='left'><a class='smallred' href='clickReg.php?clickid=".$row['click_id']."'>".$row['click_name']."</a></th>
    <th width='55%'scope='col'><span>".$row['click_url']."</span> <br></th>
	<th width='10%'scope='col'>".$row['click_count']."</th>";
	$width = $row['click_count'] / 10;
	echo"<th width='10%'scope='col'><img src='endcapbar.gif'><img src='1pxbar.jpg' width='$width' height='10'></th>
  </tr>
</table>";


}}
if($_POST['Submit'] == "Submit")
{if (!$_POST['newname']) { 
echo"Error, blank fields"; 
$pass = "NO";
}
if ($pass =="") {
$result = mysql_query("Select * from ClickTable",$con);
$n = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$n++;
if ($newname == $row['click_name']) { echo "That name is already in use, please choose another <a class='small' href='index.php?showLink=add'> GOTO ADD NEW LINK</a>"; exit();  }
}
$result = mysql_query("INSERT into ClickTable (click_name,click_url,click_count) values ('".$_POST['newname']."','".$_POST['newlink']."','0')");
echo "Name of your new link =".$_POST['newname'];
$newname = $_POST['newname'];
$result = mysql_query("Select * from ClickTable",$con);
$n = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$n++;
if ($newname == $row['click_name']) { 
$id = $row['click_id'];
echo "<br>Please use the new URL below for your new link.<br><span class='smallred'>".$site_url.$site_folder."clickReg.php?clickid=". $id ."</span><br><br>
<a class='small' href='index.php?showLink=list'>CLICK HERE TO SEE THE LIST</a>";
exit();}}


}}
if ($showLink == "add" ) {
echo"<p></p><p>Add a new click count link here</p><form action='' method='post' name='add'>
<span class='small'>Type in the full URL of the page you wish to click count (Ie. http://www.mysite.com/mypage.php)</span><br>
<input name='newlink' type='text' size='100' maxlength='100'>
<span class='small'><br><br>Type in a name to identify your click count link (Ie. Link to mypage)</span><br>
<input name='newname' type='text' size='50' maxlength='50'>
<input name='Submit' type='submit' value='Submit'>
</form>      ";
}
?>
<body class="small">
<P align="center">
<a class="smallwhite" href="index.php?showLink=list">CLICK TO SEE LIST </a>&curren; <a class="smallwhite" href="index.php?showLink=add">CLICK TO ADD NEW </a>&curren; <a class="smallwhite" href="index.php?showLink=del">CLICK TO DELETE A LINK </a></P>
<P align="center">Note: The link to your URL is <?php echo $site_url.$site_folder."clickReg.php?clickid=id  (Replace id with the URL id number)"; ?></P>
