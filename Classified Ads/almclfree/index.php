<?
require("config.php");
require("funcs1.php");
require("favrt.php");

start();
$photos_count=1;
if (($md=="details") and ($mbac_second=="m"))
{include("mb_check.php"); check_mb_login("details&id=$id");}
if ((($md=="add_form") or ($md=="submitad")) and ($mbac_addad=="m"))
{include("mb_check.php"); check_mb_login("add_form");}
if ((($md=="privacy_mail") or ($md=="send_mail")) and ($mbac_sndml=="m"))
{include("mb_check.php"); check_mb_login("privacy_mail&idnum=$idnum");}
if ($md=="forgmbpassw"){include("mb_check.php"); forgot_mb_passw();}
if ($md=="sendmbps"){include ("mb_conf.php"); include("mb_check.php"); send_mb_passw($ps_email);}
if ($md=="mblogout"){include("mb_check.php"); mb_log_out();}
if ($cook_login!=''){include("mb_lginf.php"); insert_log_welc();}
 
if (($md=="") and ($ct=="") ){include("top.php"); print_categories();} 
if (($md=="browse") or ($md=="")){browse_ads();} 
if ($md=="details"){include("details.php"); ad_details();} 
if ($md=="add_form") {include("forms.php"); print_add_form();} 
if ($md=="editlogin"){ include("forms.php"); edit_login(" ");}
if ($md=="editform"){ include("forms.php");   edit_form();}
if ($md=="forgotpassw"){include("forms.php"); forgotpassw($ps_email);}
if ($md=="sendpassw"){include("funcs2.php");sendpassw($ps_email);}
if ($md=="privacy_mail"){include("forms.php"); privacy_form($idnum);}
if ($md=="send_mail"){include("funcs2.php"); send_mail($idnum);}
if ($md=="submitad") {include("submit.php"); submit_ad();}
if ($md=="edit") {include("submit.php"); edit_ad();}

 

function browse_ads()
{
global $ads_count, $html_header, $html_footer, $ct, $mds, 
$categories, $ad_ind_width, $text_userinfo, $cat_fields, $ratedads, $ind_leftcol;
echo $html_header;

if ($mds=="search") 
{$count_info="<font color='#aa0000'>$ads_count ads match your query</font>";}
else {$count_info="$ads_count entries";}  
echo "
<table width='$ad_ind_width' border=0 cellspacing='1' cellpadding='1'><tr>
$ind_leftcol
<td valign='top'>
<table width='100%'  bgcolor='#dddddd' border=0 cellspacing='0' cellpadding='0'>
<tr>
<td> 
<TABLE  WIDTH='100%'   border='0' cellspacing='1' cellpadding='0' >
<tr><td bgcolor='#ffffff'> 
 <TABLE  WIDTH='100%'   border='0' cellspacing='0' cellpadding='0' >
<tr><td> 
<font FACE='ARIAL, HELVETICA' COLOR='BLACK' font size=-1>
<a href='index.php'>Top:</a>&nbsp; </font>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' font size=-1><b>
".category_name()." </b>  </font> $text_userinfo
 
</td><td align='right'>
 ".print_fav_ads_ind()." 
</td></tr></table> 
<TABLE BORDER=0 COLS=1 WIDTH='100%' bgcolor='#ddddee' 
border=0 cellspacing=0 cellpadding=0>
<TR> 
<TD width='33%' height='16'>
<FONT FACE='Verdana,Geneva,Arial' SIZE=1>
".pages_next_prev()."&nbsp;

</font>
</td><td align='center' width='33%'>
<FONT FACE='Verdana,Geneva,Arial' SIZE=1>
$count_info 
</td><td align='right' width='33%'>
&nbsp;
";
if (($ct!="") and ($ratedads==""))
{
echo "
<FONT FACE='Verdana,Geneva,Arial' SIZE=1>
[<a href='index.php?ct=$ct&md=add_form' >Post New Ad</a>]
</font>
";
}
echo "
</td></tr></table>
</td></tr>
</table>
</td></tr>
</table>
 
<table width='100%'  bgcolor='#dddddd' border=0 cellspacing=0 cellpadding=0>
<tr><td>
<table width='100%'  border=0 cellspacing=1 cellpadding=1>
".get_ads_captions().get_ads()."
</table> 
</table> 
<table width='100%' bgcolor='#ddddee' border=0 cellspacing=0 cellpadding=0>
<tr><td>
<FONT FACE='Verdana,Geneva,Arial' SIZE=1>
".ads_pages_list()."
 </font></td>
</td></tr></table>
<br>
<table width='100%' bgcolor='#ffffff' border=0 cellspacing=0 cellpadding=0>
<tr><td>
</td></tr>
</table>

</td></tr></table> 
</center>
";

echo $html_footer;
exit;
}

function category_name()
{
global $categories, $ct, $ratedads;
if (($ct!="") and ($ratedads!=""))
{
$cat1_name="
<a href='index.php?ct=$ct'>".$categories[$ct][0]."</a>
";
}
else
{
$cat1_name=$categories[$ct][0];
}
return $cat1_name;
}

 
function get_ads_captions()
{

global $cat_fields, $ads_count, $ct, $photos_count, $incl_prevphoto;
$bgcol21="#eeeeee";
$bgcol22="#aa0000";

$captions="<tr>";

if ($ct == '')
{
$captions=$captions." 
<td align='center' bgcolor='$bgcol21'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
<b>Category</b>
</font>
</td>
" ;
}

if ($incl_prevphoto == 'yes') 
{
$captions=$captions." 
<td align='center' bgcolor='$bgcol21'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
<b>Preview Photo</b>
</font>
</td>
";
}
 
 

$captions=$captions."
<td align='center' bgcolor='$bgcol21' width='2%'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
<b>ID</b>
</font>
</td>
<td align='center' bgcolor='$bgcol21' width='5%'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
<b>Posted</b>
</font>
</td>
";

foreach ($cat_fields as $key => $value)
{
$ik++;
if ( ($cat_fields[$key][1]=='1') or ($cat_fields[$key][1] == '12'))
{
$captions=$captions." 
<td align='center' bgcolor='$bgcol21'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
<b> ".$cat_fields[$key][0]."</b>
 </font>
 </td>
";
}
}

if ($photos_count > 0)
{
$captions=$captions."
<td align='center' bgcolor='$bgcol21'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
Photo
</font>
</td>
";
}
$captions=$captions."
<td align='center' bgcolor='$bgcol21'>
<font FACE='ARIAL, HELVETICA'  COLOR='$bgcol22' size=-2>
Details
</font>
</td>
</tr>
";



 

if($ads_count == 0) $captions="";
return $captions;
}

function print_ad ($row)
{
global $cat_fields, $photos_count, $ct, $categories, $incl_prevphoto,
$previewphoto_url, $previewphoto_path, $prphotolimits, $pr_lim_height, $pr_lim_width;
$row=check_row($row);
$html_ad="<tr>";
$time1=$row['time'];
$ad_date=get_short_date($time1);
$idnum=$row['idnum'];

$ctval=$ct;
if ($ct =='')
{
 
$key_ctn=$row['catname'];
$ctval=$key_ctn;
$html_ad=$html_ad."
<td bgcolor='#ffffff' align='center'>
<font FACE='ARIAL, HELVETICA' size='-2'>
<b>
 <a href='index.php?md=browse&ct=$ctval'>
".$categories[$key_ctn][0]."
</b></a>
&nbsp;
</td>
";
}

if ($incl_prevphoto=='yes')
{
get_jpg_path($idnum);
$phlimitinfo="";
if ($prphotolimits=='yes'){
if ($pr_lim_height==""){
$phlimitinfo="width='$pr_lim_width'";
}
else{
$phlimitinfo="width='$pr_lim_width' height='$pr_lim_height'";
}
}
$html_ad=$html_ad."
<td bgcolor='#ffffff'  align='center' width='5%'>
";
if (file_exists($previewphoto_path)){
$html_ad=$html_ad."
<img src='$previewphoto_url' $phlimitinfo> 
";
}
else {
 $html_ad=$html_ad."
 
<font FACE='ARIAL, HELVETICA' size='-2'  >
<b>No preview photo</b></font>  
";
}

$html_ad=$html_ad."</td>";
}

$html_ad=$html_ad."
 <td bgcolor='#ffffff'  align='center' width='5%'>
<font FACE='ARIAL, HELVETICA' size='-2'  >
<b>$idnum</b></font> </td>
<td bgcolor='#ffffff'  align='center' width='5%'> 
<font FACE='ARIAL, HELVETICA' size='-2'>
<b>$ad_date </b>
</font>
</td>
";


foreach ($cat_fields as $key => $value) 
{
if ( ($cat_fields[$key][1]=='1') or ($cat_fields[$key][1] == '12'))
{
if ($key == 'title'){$html_ad=$html_ad."
<td bgcolor='#ffffff' valign='center' width='40%'>
<font FACE='ARIAL, HELVETICA' size='-1'>
<b>$row[$key]</b>  </font></td>";}
else {
$html_ad=$html_ad."
<td bgcolor='#ffffff' align='center'>
<font FACE='ARIAL, HELVETICA' size='-1'>
$row[$key]  </font></td>";}
}

}

if ($photos_count > 0)
{
$html_ad=$html_ad."
<td bgcolor='#ffffff' align='center' width='2%'> 
<font FACE='ARIAL, HELVETICA' size='-2'>
<b>".$row['adphotos']."</b></a>
</font>
</td>
";
}
$html_ad=$html_ad."
<td bgcolor='#ffffff' align='center' width='2%'> 
<font FACE='ARIAL, HELVETICA' size='-2'>
<a href='index.php?ct=$ctval&md=details&id=$idnum' target=$idnum>
<b>Details</b></a>
</font>
</td></tr>
";
 
return $html_ad;
}

function check_row($row)
{
global $cat_fields, $select_text,$real_format;
foreach ($cat_fields as $key => $value) 
{
if (($row[$key]=="") or ($row[$key]==$select_text) or ($row[$key]=='http://')
or ($row[$key]=='NULL') or ($row[$key]=='null')) 
{$row[$key]="--";}
else {
if ($cat_fields[$key][6]=='real') {$row[$key]=sprintf($real_format, $row[$key]);}
}
}
return $row;
}
?>