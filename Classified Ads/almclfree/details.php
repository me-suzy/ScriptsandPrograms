<?

include("funcs2.php");

function print_photos($idnum, $row)
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
for($i=1; $i<=$photos_count; $i++)
{
if (file_exists($photo_path[$i])){
$photokey="photocaption$i";
$photocapt=$row[$photokey];
$html=$html."
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
<font size='-2'>Photo $i</font>
<center>
<img src='$photo_url[$i]'> <br> $photocapt
</center>
";
}
}
return $html;
}

function print_multimed($idnum)
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


function ad_details()
{
global $cat_fields, $photos_count, $html_header, $html_footer, $id,
$ct, $categories, $ad_second_width, $left_width_sp, $exp_period, $privacy_mail,
$schallusrads, $detl_leftcol;

$row=get_ad_details($id);
$row=check_row($row);

 

$time1=$row['time'];
$date_posted=get_date($time1); 
$time2=$time1+$exp_period*86400;
$expire_date=get_date($time2);

if ($privacy_mail=='yes') {
$cont_email="<a href='index.php?ct=$ct&md=privacy_mail&idnum=$id'>Privacy Mail</a>";}
else{
$cont_email="<a href='mailto:".$row['email']."'>".$row['email']."</a>";
}
if ($row['homeurl']=="--")
{$homepage_info="not available";}
else{
$homepage_info="<a href='".$row['homeurl']."'>".$row['homeurl']."</a>";
}

$idnum=$row['idnum'];

$sdtpcol="#ffffff";
$sdtpcol1="#ffcccc";
$ad_sec_rt=$ad_second_width-$left_width_sp-1;

$repltitle="<title>".$row['title'].".  ";
$html_header=ereg_replace('<title>', $repltitle, $html_header);
echo $html_header;
echo "
<center>
<table width='$ad_second_width' bgcolor='#dddddd' border=0 cellspacing=1 cellpadding=0><tr>
$detl_leftcol
<td valign='top'>
<TABLE WIDTH='100%'  border=0 BGCOLOR='#ffffff' cellspacing='1' cellpadding='10' > 
<tr>
<TD  VALIGN=TOP>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK'> <font size=-1>
<a href='index.php'>Top:</a> 
<b><a href='index.php?md=browse&ct=$ct'>".$categories[$ct][0]."</a></b>
</font> 
<table width='100%' border=0 cellspacing=3 cellpadding=3>
<tr>
<td bgcolor='#eeeeee'>
<font FACE='ARIAL, HELVETICA' color='#000088' size=+1>
&nbsp;&nbsp; <b>".$row['title']."</b></font>
</td>
</tr>
</table>
<table width='100%'  bgcolor='#ffffff' cellspacing=5 cellpadding=5>
<tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK' size='-2'><b>
<font color='#007700'>&nbsp;&nbsp;ID# : </font><font color='#aa0000' >
$idnum
</font>; 
&nbsp;
<font color='#007700' >  Date posted : </font> <font color='#aa0000' >
 $date_posted </font>;
&nbsp;
<font color='#007700' >Expire date : </font>
<font color='#aa0000' > $expire_date </font>;
</b></font><br> ".print_add_fvrt()."

<table width='100%'  border=0 bordercolor='#ffffff' cellspacing=3 cellpadding=0>
";


foreach ( $cat_fields as $key => $value )
{
if ( ($cat_fields[$key][1] == '2') or ($cat_fields[$key][1] == '12'))
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
</table>
<p>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK' size='-1'>
<ul>
<li>Contact e-mail: $cont_email</li>
<li>Home Page: $homepage_info</li> 
</ul>
<p>
 ".print_multimed($idnum)."
<p>
</b></font>

<font FACE='ARIAL, HELVETICA' COLOR='BLACK' size='-1'>
 
<p>
 
</td></tr></table> 
<p>
".print_photos($idnum, $row)." 
<p>
".print_fvrt_dtl()." 
</font>
</td></tr></table>
</td></tr></table>
</center> 
";

echo $html_footer;
exit;
}

?>
