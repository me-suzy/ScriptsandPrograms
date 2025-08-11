<?

function output_message($message)
{
global $cat_fields, $photos_count, $html_header, $html_footer, $id,
$ct, $categories, $ad_second_width, $left_width_sp, $exp_period;
echo $html_header;
echo "
<center><table width='600'><tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK'> <font size=-1>
<b><a href='index.php'>Top:</a></b></font>
&nbsp; 
<font FACE='ARIAL, HELVETICA' COLOR='#000099'> 
<b>&nbsp; 
<a href='index.php?ct=$ct'>".$categories[$ct][0]."
</b></a> 
</font> 
<hr size='1'><p>
$message
<p><hr size='1'>
</tr></td></table>
</center>
";
echo $html_footer;
exit;
}

function getuseradsnum($searchemail)
{
global  $table_ads;
$sql_query="select count(idnum) from $table_ads where email='$searchemail' and visible=1";
$sql_res=mysql_query("$sql_query");
$row = mysql_fetch_row($sql_res);
$mcount=$row[0];

return $mcount;
}

function getmbadsnum($mb1_login)
{
global  $table_ads;
$sql_query="select count(idnum) from $table_ads where login='$mb1_login' and visible=1";
$sql_res=mysql_query("$sql_query");
$row = mysql_fetch_row($sql_res);
$mcount=$row[0];

return $mcount;
}

function check_email($email)
{
$email=ereg_replace(' ', '', $email);
$a1=split('@', $email);
$a2=split('\.',$email);
if (($a1[0] == "") or ($a1[1] == "") or ($a2[0] == "") or ($a2[1] == ""))
{
$message="
<font FACE='ARIAL, HELVETICA' COLOR='#000000' >
<b> E-mail <font color='#AA0000'> $email</font> has
incorrect format </b>  
 <font size='-1' color='#000088'>
<p> Please use your browser's <b> back button </b> to return to the form
and fill in these fields.
</font></font>
";
output_message($message);
exit;
}
return $email;
}

function delete_expired_ads()
{
global $cat_fields, $table_ads, $exp_period ;
$time1=time() - $exp_period*86400;
$sql_query="select idnum from $table_ads where time < $time1";
$sql_res=mysql_query("$sql_query");
while ($row = mysql_fetch_array ($sql_res))
{
$del_id=$row['idnum'];
$sql_query="delete from $table_ads where idnum=$del_id";
mysql_query("$sql_query");
delete_photos($del_id);
}
}
 

function delete_photos($id)
{
global $photo_path, $multimedia_path, $previewphoto_path, $photos_count;

get_jpg_path($id);

for ($i=1; $i<=$photos_count; $i++)
{
 if (file_exists($photo_path[$i])){unlink($photo_path[$i]);}
}
if (file_exists($previewphoto_path)){unlink($previewphoto_path);}
if (file_exists($multimedia_path)){unlink($multimedia_path);}
}

function get_date($time1)
{
$d=getdate($time1);
$date_string=$d['month']." ".$d['mday'].", ".$d['year'];
return $date_string;
}

function get_ad_details($id)
{
global $cat_fields, $table_ads;
$sql_query="select * from $table_ads where idnum=$id";
$sql_res=mysql_query("$sql_query");
$row = mysql_fetch_array ($sql_res);
if ($row['idnum']==""){
$message="
<font FACE='ARIAL, HELVETICA' COLOR='#880000' >
<b>
No Ad with ID# $id
</b>
</font>
";
output_message($message);
exit;
}
return $row; 
}

function get_edit_info($ed_id)
{
global $cat_fields, $table_ads;
$sql_query="select * from $table_ads where idnum=$ed_id";
$sql_res=mysql_query("$sql_query");
$row = mysql_fetch_array ($sql_res);

if ($row['idnum']!=""){
foreach ($row as $key => $value)
{
$row[$key]=ereg_replace("'", "&#039;", $row[$key]);
}
}
return $row; 
}

function delete_ad($ed_id)
{
global  $table_ads;
$sql_query="delete from $table_ads where idnum=$ed_id";
mysql_query("$sql_query");
delete_photos($ed_id);

$message="
<font FACE='ARIAL, HELVETICA' COLOR='BLACK'> 
<b> Your ad has been deleted ! </b>
</font>
";
output_message($message);
exit;
}



function get_cat_count($ct)
{
global $cat_fields, $table_ads,  $page, $adsonpage; 
 
 
$sql_query="select count(idnum) from $table_ads where 
catname='$ct' and visible=1";
 
$sql_res=mysql_query("$sql_query");
$row=mysql_fetch_row($sql_res);
$count=$row[0];
return $count;
}

function get_date_update($ct)
{
global $cat_fields, $table_ads,  $page, $adsonpage; 
 
 
$sql_query="select time from $table_ads where 
catname='$ct' and visible=1 order by time desc ";
$sql_res=mysql_query("$sql_query");
$row=mysql_fetch_row($sql_res);
$time1=$row[0];
$date_update=get_short_date($time1);
if ($time1==0) {$date_update="";}
return $date_update;
}

?>


