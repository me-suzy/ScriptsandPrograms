<?php

$page=1;

require_once('connect.php');

$query='SELECT * FROM blog';

$result=mysql_query($query);

$num=mysql_numrows($result);



$i=0;
while ($i < $num) {

$blogtitle=mysql_result($result,$i,"title");
$blogsub=mysql_result($result,$i,"sub");
$blogimage=mysql_result($result,$i,"titleimage");


$i++;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo "$blogtitle"; ?></title>
<link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="600" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td height="60" colspan="2" valign="top">
<?php

//Displaying the title

if($blogimage!=null)
{
echo "
<img src=$blogimage></img>
";
}else{
echo "
<div class='maintitle'>
$blogtitle
</div>
<div class='mainsub'>
$blogsub
</div>

";

}
?>


</td>
  </tr>
  <tr>
    <td width="113" height="208" valign="top">
	<div class="menu">

<?php

//Displaying personal blogger information

$query='SELECT * FROM about';
$result=mysql_query($query);
$num=mysql_numrows($result);

$i=0;
while ($i < $num) {

$picture=mysql_result($result,$i,"picture");
$name=mysql_result($result,$i,"name");
$email=mysql_result($result,$i,"email");
$aim=mysql_result($result,$i,"aim");
$msn=mysql_result($result,$i,"msn");
$country=mysql_result($result,$i,"country");
$state=mysql_result($result,$i,"state");
$dob=mysql_result($result,$i,"dob");
$gender=mysql_result($result,$i,"gender");
$bio=mysql_result($result,$i,"bio");
$intrests=mysql_result($result,$i,"intrests");
$ocupation=mysql_result($result,$i,"ocupation");

if($picture!=null)
{
echo "<table><tr><td width='250' align='center'>
<div class='aboutimg'><img src=$picture></img></div>
</td></tr></table>";
}
if($name!=null)
{
echo "<div class='fact'>Name: $name</div>";
}
if($email!=null)
{
echo "<div class='fact'>Email: $email</div>";
}
if($aim!=null)
{
echo "<div class='fact'>AIM: $aim</div>";
}
if($msn!=null)
{
echo "<div class='fact'>MSN: $msn</div>";
}
if($country!=null)
{
echo "<div class='fact'>Country: $country</div>";
}
if($state!=null)
{
echo "<div class='fact'>State/Province: $state</div>";
}
if($dob!=null)
{
echo "<div class='fact'>Birthday: $dob</div>";
}
if($gender!=null)
{
echo "<div class='fact'>Gender: $gender</div>";
}
if($bio!=null)
{
echo "<div class='fact'>Bio: $bio</div>";
}
if($intrests!=null)
{
echo "<div class='fact'>Intrests: $intrests</div>";
}
if($ocupation!=null)
{
echo "<div class='fact'>Ocupation: $ocupation</div>";
}

$i++;
}
?>




</div>
	<div id="main">
	 

<?php

//Displaying Blog Posts

$query='SELECT * FROM entries ORDER BY time DESC';

$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();
?>

<form method='post' action='<?php echo $PHP_SELF;?>'>
<select name='page'>
<?php

$pernum=5;
$pagenum=$num/$pernum;
if($pagenum<1)
{
$pagenum=1;
}

for ($i=0; $i<$pagenum; $i++)
{
$fornum=$i+1;
echo "<option value='$fornum'>Page $fornum</option>";
}

?>
</select>

<input type='submit' value='Go' name='Go'>
</form>

<?
for ($x=1; $x<=$pernum; $x++)
{
if($page==$x)
{
if($x==1)
{
$i=0;
}
else
{
$i=$x*$pernum-$pernum;
}
while ($i < $num)

 {

$id=mysql_result($result,$i,"id");

$title=mysql_result($result,$i,"title");
$text=mysql_result($result,$i,"text");
$picture=mysql_result($result,$i,"picture");
$mood=mysql_result($result,$i,"mood");
$day=mysql_result($result,$i,"day");
$month=mysql_result($result,$i,"month");
$year=mysql_result($result,$i,"year");
echo "
<div class='entry' height='200'>
<div class='entrytitle'>$month/$day/$year - $title</div>
<table border='0'>
<tr>
<td valign='top'>
<div class='entryimg'><img src='$picture'></img></div>
</td>
<td valign='top'>
<div class='entrytext'>$text</div>
</td>
</tr>
</table>
</div>
";
if($i==$pernum-1)
{
break;
}
$i++;
}

}
}

?>


	</div>
    </td>
  </tr>
</table>
</body>
</html>