<?
include("funcs2.php");

 
  
function print_add_form()
{ 
global $html_add_form, $rightform_html;
$rightform_html=$html_add_form;
ad_form("submitad");
}

function ad_form($ed_add)
{
global $html_header, $html_footer, $cat_fields, $fields_val, $ct, 
$photos_count, $ed_id, $ed_passw, $exp_period, $rightform_html, 
$select_text, $categories, $phptomaxsize, $incl_prevphoto, $prviewphotomax,
 $prphotolimits, $pr_lim_height, $pr_lim_width, $incl_mtmdfile, $multim_link,
$multim_ext, $mtmdfile_maxs, $ad_ind_width;

if ($ed_add=="edit")
{
$time1=$fields_val['time'];
$date_posted=get_date($time1); 
$time2=$time1+$exp_period*86400;
$expire_date=get_date($time2);

}
else{
$time1=time();
$date_posted=get_date($time1); 
$time2=$time1+$exp_period*86400;
$expire_date=get_date($time2);
}

if ($ed_add=="submitad") { $title_inf="Place New Ad";}
if ($ed_add=="edit") { $title_inf="Edit Ad ( ID# ".$fields_val['idnum'].") ";}
echo $html_header;

$tbl_col='#ffffff';
$td_height='10';

echo "
<p>
<center> 
<table  ><tr><td valign='top'>

<font FACE='ARIAL, HELVETICA' COLOR='BLACK'> <font size=-1>
<b><a href='index.php'>Top:</a></b></font>
&nbsp; 
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'> 
<b>&nbsp; <font size='+1'>
<a href='index.php?ct=$ct'>".$categories[$ct][0]."
</b></a> 
</font> </font>
<hr size='1'>
<font FACE='ARIAL, HELVETICA' COLOR='#000099'> <b> $title_inf </b> </font>

<form action='index.php?ct=$ct&md=$ed_add' method='post' ENCTYPE='multipart/form-data'>
<table   width='550' border=0 bgcolor='#cccccc' cellspacing=1 cellpadding=0>
<tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
<b> Fill out the following form below:</b>
</font>
<table width='100%' border=0 cellspacing=1 cellpadding=1>
<tr>
<td bgcolor='$tbl_col' height='$td_height' width='30%' >
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'> 
Date Posted:          
</font>
</td><td bgcolor='$tbl_col' width='70%'>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
 &nbsp; $date_posted  
</font>
</td></tr>
<tr>
<td  height='$td_height' bgcolor='$tbl_col' >
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
Expire Date: 
</font>
</td><td bgcolor='$tbl_col'>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
 &nbsp; $expire_date 
</font>
</td></tr>
";



foreach ($cat_fields as $key => $value )
{
if (ereg ('url',$key))
{
if ($fields_val[$key]==""){$fields_val[$key]="http://";}
}

if ($cat_fields[$key][5] == '1')
{$cat_fields[$key][0]=$cat_fields[$key][0]."<font color='#cc0000'>* </font>";}

if ($cat_fields[$key][4] == 'select')
{
$aa4=split(':',$cat_fields[$key][3]);
$t_size=$aa4[0];
$t_max=$aa4[1];
if ($fields_val[$key]!=""){$select_text1=$fields_val[$key];}
else {$select_text1=$select_text;}
echo "
<tr>
<td height='$td_height' bgcolor='$tbl_col' >
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
".$cat_fields[$key][0].":
</font>
</td><td bgcolor='$tbl_col'>
<select name='$key' size='$t_size'>
 <option>$select_text1<checked>
".$cat_fields[$key][7]."</select></td></tr>
";
}

 
if ($cat_fields[$key][4] == 'checkbox')
{
$aa5=split('<option>',$cat_fields[$key][7]);
echo "
<tr>
<td height='$td_height' bgcolor='$tbl_col' >
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
".$cat_fields[$key][0].":
</font>
</td><td bgcolor='$tbl_col'>
";
$i_aa5=0;
foreach ($aa5 as $value1)
{
$i_aa5++;
if ($value1!=""){
$namechbx=$key.$i_aa5;
echo " 
<input type='checkbox' name='$namechbx' value='$value1' $fields_val[$namechbx]> 
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'> $value1 </font> <br>
";
}
}
echo "</select></td></tr>";
}



if ($cat_fields[$key][4] == 'text'){
$aa4=split(':',$cat_fields[$key][3]);
$t_size=$aa4[0];
$t_max=$aa4[1];
echo "
<tr>
<td height='$td_height' bgcolor='$tbl_col' >
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
".$cat_fields[$key][0].":
</font>
</td><td bgcolor='$tbl_col'>
";
 
echo "
<input type='text' name='$key' size='$t_size' value='".$fields_val[$key]."' maxlength='$t_max'>
</td></tr>
";
 
}
if ($cat_fields[$key][4] == 'textarea'){
$aa4=split(':',$cat_fields[$key][3]);
$t_rows=$aa4[1];
$t_cols=$aa4[0];
$t_max=$aa4[2];
echo "
<tr>
<td height='$td_height' bgcolor='$tbl_col' >
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
".$cat_fields[$key][0].":
<br><font size='-2' color='#aaaaaa'> Not more then  $t_max chars</font>
</font>
</td><td bgcolor='$tbl_col'>
";
if (($cat_fields[$key][7]!="") and ($ed_add=='submitad'))
{
echo "
<b>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-2'>
Delete unnecessary options and/or add yours:<br>
</b>
</font>
";
 $fields_val[$key]=$cat_fields[$key][7];
}
echo "
<textarea name='$key'   rows='$t_rows' cols='$t_cols' maxsize='$t_max'>".$fields_val[$key]."</textarea>
</td></tr>
";
}
}
 
echo "
</td></tr>
</table></td></tr>
</table>
<font FACE='ARIAL, HELVETICA' color='#000000'  size='-2'>
<b>All fields marked by <font color='#cc0000'> * </font> should be filled out 
</b></font>
<br>
";

if($photos_count > 0) {
$phptomaxsize1=$phptomaxsize/1000;
echo "
<p>
<table width='550' border=0 bgcolor='#cccccc' cellspacing=1 cellpadding=0>
<tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
<b> Submit photo:</b>
</font>  

<table width='100%' border=0 cellspacing=1 cellpadding=1>
<tr><td bgcolor='#ffffff'>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
<font size='-2'><b> Photo size < $phptomaxsize1 Kbyte  </b> </font>
<center>
";
$i=1; 
echo "
<br>Photo : <input type='file' name='userfile[]'> 
";
echo "
</center>
</td></tr></table></td></tr></table> 
</b><p> 
";
}

 
if ($ed_add=='edit')
{
if ($incl_mtmdfile=='yes') $mtmtm1= "or multimedia";
echo "
<table width='550' border=0 bgcolor='#eeeeee' cellspacing=1 cellpadding=0>
<tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-2'>
<b>
If you need to delete old photo $mtmtm1 file, write char 'd' in the field;
if you do not need to change old file nothing input in the field;
if you need to replace old file, input path to your new file.
</b>
</font>
</td></tr></table>
<p>
";
}


echo "
<input type='submit' value='submit'>
<hr size='1'>
<input type='hidden' name='ed_id' value='$ed_id'>
<input type='hidden' name='ed_passw' value='$ed_passw'>
</form>
</td><td valign='top'>
$rightform_html   
</td></tr></table> </center>
$html_footer
";

}

 


?>
