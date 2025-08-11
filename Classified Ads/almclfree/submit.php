<?
require("funcs2.php");

  
function get_idnum()
{

global $id_count, $table_ads, $ct;
$sql_query="select idnum from $table_ads 
order by idnum desc limit 1";
$sql_res=mysql_query("$sql_query");
$row=mysql_fetch_row($sql_res);
$id_count=$row[0];
$id_count++;

 
return $id_count;

}


 function check_fields()
{
global $db_entry, $visible_val, $cat_fields, $email, 
$HTTP_POST_VARS, $photos_count, $phptomaxsize, $userfile, $prviewphotomax,
$incl_prevphoto, $incl_mtmdfile, $mtmdfile_maxs, $userfile_name, $select_text;

if(!get_magic_quotes_gpc())
{

foreach ($HTTP_POST_VARS as $key5 => $value )
{
$HTTP_POST_VARS[$key5]=addslashes($HTTP_POST_VARS[$key5]);
}
}

foreach ( $cat_fields as $key => $value )
{
$HTTP_POST_VARS[$key]=ereg_replace('<', '&#060;', $HTTP_POST_VARS[$key]);
$HTTP_POST_VARS[$key]=ereg_replace('>', '&#062;', $HTTP_POST_VARS[$key]);

if ($cat_fields[$key][2]=="minmax")
{ $HTTP_POST_VARS[$key]=ereg_replace(',', '', $HTTP_POST_VARS[$key]); }

if ($cat_fields[$key][4]=="checkbox")
{
$aa5=split('<option>',$cat_fields[$key][7]);
$i_aa5=0;
foreach ($aa5 as $value1)
{
$i_aa5++;
$namechbx=$key.$i_aa5;
if ($HTTP_POST_VARS[$namechbx]!="")
{$HTTP_POST_VARS[$key]=$HTTP_POST_VARS[$key].$HTTP_POST_VARS[$namechbx]."; ";}
}
}


$str_length1=strlen($HTTP_POST_VARS[$key]);
$aa4=split(':',$cat_fields[$key][3]);
$fmaxsize=$aa4[1];
if ($aa4[2]!="") $fmaxsize=$aa4[2];
if ( $str_length1 > $fmaxsize)
{
$message="
<center>
<font FACE='ARIAL, HELVETICA' COLOR='#880000' >
  Ad info in the  field <b>".$cat_fields[$key][0]." </b> is too large. 
 <font size='-1' color='#000088'>
<p> Please use your browser's <b> back button </b> to return to the form
and make more short info  in this field.
</font></font>
</center>
";
output_message($message);
exit;
}

if ($HTTP_POST_VARS[$key]==$select_text)
{$HTTP_POST_VARS[$key]="";}

if ($cat_fields[$key][5]=='1')
{
if (( $HTTP_POST_VARS[$key]=="") or ( $HTTP_POST_VARS[$key]=="http://"))
{
$message="
<center>
<font FACE='ARIAL, HELVETICA' COLOR='#880000' >
  Ad field <b>".$cat_fields[$key][0]."</b> (marked by * )  
  was missing on your form submission. 
 <font size='-1' color='#000088'>
<p> Please use your browser's <b> back button </b> to return to the form
and fill in this field.
</font></font>
</center>
";
output_message($message);
exit;
}
}
}
if ($cat_fields['email'][5]='1'){
$HTTP_POST_VARS['email']=check_email($HTTP_POST_VARS['email']);
}

for ($i=1; $i<=$photos_count; $i++)
{
$i1=$i-1;

if (file_exists($userfile[$i1])){
if (filesize($userfile[$i1]) > $phptomaxsize)
{
$phptomaxsize1=$phptomaxsize/1000;
$message="
<center>
<font FACE='ARIAL, HELVETICA' COLOR='#880000' >
  Your photo $i  ( ".$userfile_name[$i1]." ) is too large  
 <font size='-1' color='#000088'>
<p> Please use your browser's <b> back button </b> to return to the form
and submit photo with size < $phptomaxsize1 Kbyte.
</font></font>
</center>
";
}
}
}
 
}
 
 

function submit_ad()
{
global $db_entry, $visible_val, $cat_fields, $email, $HTTP_POST_VARS;

global $photo_url, $photo_path, $id_count, 
$userfile, $userfile_name, $html_header, $html_footer,
$photos_url, $photos_path, $photos_count, $moderating, $ad_idnum, $table_ads;

check_fields();

$visible_val="1";
if ($moderating=='yes') $visible_val="0"; 

$idnum=get_idnum();
save_photos($idnum);
$sql_query=add_sql_entry($idnum);

if( !(@mysql_query("$sql_query")))
{echo $html_header;
echo "
<center>
<font FACE='ARIAL, HELVETICA'  COLOR='#bb0000' size=-1><b>
Error in submitting new ad. <br>
You need to re-create ads MySQL table '$table_ads' (after having changed ads
fields structure). <br> <a href='createtb.php'>Click here </a> to create new ads table.
</b></font></center>
";
echo $html_footer;
exit;
}
 
delete_expired_ads();

print_subm_ad($ad_idnum,'submitad');
exit;
}

function save_photos($id_cnt)
{
global $photo_url, $photo_path,  
$userfile, $userfile_name, $HTTP_POST_VARS,
$photos_url, $photos_path, $photos_count, $moderating, $ad_idnum, $adphotos,
$incl_prevphoto, $incl_mtmdfile, $multimedia_path, $previewphoto_path,$savepherr; 

get_jpg_path($id_cnt);

$savepherr="0";
for ($i=1; $i<=$photos_count; $i++)
{
 $i1=$i-1;

 
if (($userfile_name[$i1]=="d")  and (file_exists($photo_path[$i])))
{ unlink($photo_path[$i]);}
 
if (($userfile_name[$i1] !="") and ($userfile_name[$i1] !="d")){
 copy($userfile[$i1], $photo_path[$i]) ;
}
}

if ($incl_prevphoto=="yes")
{
$i1++;

if (( $userfile_name[$i1]=="d") and (file_exists($previewphoto_path)))
{unlink($previewphoto_path);}

if (($userfile_name[$i1] !="") and ($userfile_name[$i1] !="d")){
 copy($userfile[$i1], $previewphoto_path) ;
}
 
}

if ($incl_mtmdfile=="yes")
{
$i1++;
 
if (($userfile_name[$i1]=="d") and (file_exists($multimedia_path)))  { unlink($multimedia_path);}
if (($userfile_name[$i1] !="" ) and ($userfile_name[$i1] !="d")){
 copy($userfile[$i1], $multimedia_path) ;
}
 
}


$adphotos="no";
for($i=1; $i<=$photos_count; $i++)
{
if (file_exists($photo_path[$i])){$adphotos="yes";} 
}
}


function print_photos1($idnum, $row)
{
global  $photos_url, $photos_path, $photo_path, $photo_url, $photos_count,$multim_link;
$pho1="";
get_jpg_path($idnum);
for($i=1; $i<=$photos_count; $i++)
{
if (file_exists($photo_path[$i])){$pho1="1";} 
 
}
 
if ($pho1==""){return;}

$html="
<center>
<table width='100%' bgcolor='#eeeeee'>
<tr><td> 
<font FACE='ARIAL, HELVETICA' COLOR='#000099'>
<b> Photo Gallery </b> </font>
</td></tr></table>
</center>
";
$timepho=time();
for($i=1; $i<=$photos_count; $i++)
{
if (file_exists($photo_path[$i])){
$photokey="photocaption$i";
$photocapt=$row[$photokey];
$html=$html."
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
<font size='-2'>Photo $i</font>
<center>
<img src='$photo_url[$i]?$timepho'> <br> $photocapt
</center>
";
}
}
return $html;
}

function print_multimed1($idnum)
{
global $incl_mtmdfile,$multimedia_path, $multimedia_url, $multim_link;
$mm_link="";
if ($incl_mtmdfile=='yes')
{
get_jpg_path($idnum);
if (file_exists($multimedia_path)) 
{
$mm_link="
<li>Multimedia file: <b><a href='$multimedia_url'>$multim_link</a></b></li>
";
}
}
return  $mm_link;
}




function print_subm_ad($ad_idnum,$ed_subm)
{
global $cat_fields, $photos_count, $html_header, $html_footer, $id,
$ct, $categories, $ad_second_width, $left_width_sp, $exp_period, $incl_prevphoto,
$prphotolimits, $pr_lim_width, $pr_lim_height, $previewphoto_path, $previewphoto_url,
$moderating, $savepherr;

$sdtpcol="#ffffff";
$sdtpcol1="#ffcccc";

$row=get_edit_info($ad_idnum);
$row=check_row($row);

$time1=$row['time'];
$date_posted=get_date($time1); 
$time2=$time1+$exp_period*86400;
$expire_date=get_date($time2);

if ($ed_subm=='editad') 
{ $info11="
Your ad has been edited successfuly 
";
}

if ($ed_subm=='submitad') 
{ $info11="
Your ad has been submitted successfuly 
";
}

if ($moderating=='yes')
{
$info11=$info11."
<br> and will appear in the index as soon as possible
";
}
 
if ($savepherr=="1")
{ $info11=$info11."
<br>
<font FACE='ARIAL, HELVETICA' COLOR='#aa0000' size='-1'>
Due to incorrect server configuration your 
photos does not saved into database 
</font>
";
}

echo $html_header;
echo "
<center><table width='500'><tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK'> <font size=-1>
<b><a href='index.php'>Top:</a></b></font>
&nbsp; 
<font FACE='ARIAL, HELVETICA' COLOR='#000099'> 
<b>&nbsp; 
<a href='index.php?ct=$ct'>".$categories[$ct][0]."</a>
</b> 
</font> 
<hr size='1'>
<center>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='+1'> 
<b> $info11 </b></font>
</center><p>
";

echo "
<table width='100%' border=0 cellspacing=3 cellpadding=3>
<tr>
<td bgcolor='#ddeeff'>
<font FACE='ARIAL, HELVETICA' color='#000088' size=+1>
  &nbsp; <b>".$row['title']."</b></font>
</td>
</tr>
</table>
<table width='100%'  bgcolor='#ffffff' cellspacing=5 cellpadding=5>
<tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK' size='-2'><b>
<font color='#007700' >&nbsp;&nbsp;ID# : </font><font color='#aa0000'>
".$row['idnum']."
</font>; 
&nbsp;
<font color='#007700' >  Date posted : </font> <font color='#aa0000' >
 $date_posted </font>;
&nbsp;
<font color='#007700' >Expire date : </font>
<font color='#aa0000' > $expire_date </font>;
</b></font>
<table width='100%'  border=0 bordercolor='#ffffff' cellspacing=3 cellpadding=0>
 
";


foreach ( $cat_fields as $key => $value )
{

if ($key != 'title')
{ 
echo "
<tr><td colspan='2' height='1' bgcolor='$sdtpcol1'><spacer type='block' height='1' width='1'></td></tr>
<tr><td bgcolor='$sdtpcol' width='25%'>
<font FACE='ARIAL, HELVETICA' COLOR='#000088' size='-1'>
&nbsp; ".$cat_fields[$key][0].":</font>
</td><td bgcolor='$sdtpcol' width='75%'>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK' size='-1'>
 ".$row[$key]." &nbsp; </td></tr>
 
";
} 
}

echo "
<tr><td colspan='2' height='1' bgcolor='$sdtpcol1'><spacer type='block' height='1' width='1'></td></tr>
</table></td></tr></table>
";

if ($incl_prevphoto=='yes')
{
get_jpg_path($row['idnum']);
$phlimitinfo="";
if ($prphotolimits=='yes'){
$phlimitinfo="width='$pr_lim_width' height='$pr_lim_height'";}
if (file_exists($previewphoto_path)){
echo "
<center>
<font FACE='ARIAL, HELVETICA' COLOR='#000088' size='-1'>
Preview Photo: <img src='$previewphoto_url' $phlimitinfo hspace='6' align='center'> 
</font>
</center>
";
}
}
 
echo "
<p>
<center>
<font FACE='ARIAL, HELVETICA' COLOR='#000088' size='-1'>
".print_multimed1($row['idnum'])."
</font>
</center>
<p>
";

echo print_photos1($row['idnum'], $row)."
<hr size='1'>
</tr></td></table>
";

echo $html_footer;

exit;
}

function form_sql_entry($idnum)
{
global $ct,  $table_ads, $visible_val, $cat_fields,
$HTTP_POST_VARS, $moderating, $adphotos, $cook_login;

$db_entry['login']=$cook_login;

$time_now=time();
 
$db_entry['idnum']=$idnum;

$db_entry['exptime']=$time_now + $expperiod*86400;
$db_entry['time']=$time_now;
$db_entry['catname']=$ct;
$db_entry['visible']=$visible_val;
$db_entry['adphotos']= $adphotos;


foreach ($cat_fields as $key => $value)
{
 
$db_entry[$key]=$HTTP_POST_VARS[$key];

}
 
return $db_entry;
}
 
function add_sql_entry($idnum)
{
global $ct, $db_entry, $table_ads, $visible_val, $cat_fields,
$HTTP_POST_VARS ,$ad_idnum;

 
$ad_idnum=$idnum;
$db_entry=form_sql_entry($idnum);
 
$db_sql_string="";
$db_sql_var="";
foreach ($db_entry as $db_key => $db_value)
{

if ($db_key !="")
{
if ($db_entry[$db_key] == "" )
{
$db_sql_string=$db_sql_string."NULL, ";
}
else{
$db_sql_string=$db_sql_string."'$db_entry[$db_key]', ";
}
$db_sql_var=$db_sql_var."$db_key, ";
}
}
$db_sql_string=corr_sqlstring($db_sql_string);
$db_sql_var=corr_sqlstring($db_sql_var);
$sql="insert into $table_ads ( $db_sql_var ) values( $db_sql_string )";

return $sql;

} 

?>
