<?

$cookie_time=time()+3600000;
if ($HTTP_GET_VARS['mfvrt']=="add"){add_favorite();}
if ($HTTP_GET_VARS['mfvrt']=="rmv"){remove_favorite();}
if ($HTTP_GET_VARS['mfvrt']=="rmall"){remove_all();}
if ($HTTP_GET_VARS['mfvrt']=='1'){$adsonpage="100";}


function print_fav_ads_ind()
{
global $HTTP_COOKIE_VARS, $HTTP_GET_VARS;
if ($HTTP_COOKIE_VARS['ckfvr']!='')
{
$var="
<a href='index.php?md=browse&mfvrt=1' >
<FONT FACE='Verdana,Geneva,Arial' SIZE=1 color='#990000'><b>
Your favorite ads</b></font>
</a>
  &nbsp; 
";

if ($HTTP_GET_VARS['mfvrt']=='1'){
$var="
 
<font FACE='ARIAL, HELVETICA' color='#000099' size='-1'><b>
Your favorite ads</b></font>
</a>
  &nbsp;  &nbsp;  
";
;}
}
return $var;
}

function print_add_fvrt()
{
global $HTTP_COOKIE_VARS, $HTTP_GET_VARS;
$mss_cookies=split(',',$HTTP_COOKIE_VARS['ckfvr']);

$ck_var=""; 
foreach ($mss_cookies as $cook_value)
{ 
if ($cook_value==$HTTP_GET_VARS['id']){$ck_var="1";}
}
if ($HTTP_GET_VARS['mfvrt']=='add'){$ck_var="1";}
if (($HTTP_GET_VARS['mfvrt']=='rmv') or ($HTTP_GET_VARS['mfvrt']=='rmall')){$ck_var="0";}


if ($ck_var=="1"){$var1="&nbsp;Favorite ad";}
else {$var1=
" &nbsp; <a href='index.php?ct=".$HTTP_GET_VARS['ct']."&md=".$HTTP_GET_VARS['md']."&id=".$HTTP_GET_VARS['id']."&mfvrt=add'>
 Add to favorites</a>
";} 
$var="
<FONT FACE='Verdana,Geneva,Arial' SIZE=1 color='#000099'><b>
$var1  
</b></font>
";
return $var;
}


function print_fvrt_dtl()
{
global $HTTP_COOKIE_VARS, $HTTP_GET_VARS;
$mss_cookies=split(',',$HTTP_COOKIE_VARS['ckfvr']);

$ck_var=""; 
$ck_var2=""; 
foreach ($mss_cookies as $cook_value)
{ 
if ($cook_value==$HTTP_GET_VARS['id']){$ck_var="1";}
if ($cook_value!=""){$ck_var2="1";}
}

if ($HTTP_GET_VARS['mfvrt']=='add'){$ck_var="1";}
if (($HTTP_GET_VARS['mfvrt']=='rmv') or ($HTTP_GET_VARS['mfvrt']=='rmall')){$ck_var="0";}

if ($ck_var=="1"){
$var1="

<a href='index.php?ct=".$HTTP_GET_VARS['ct']."&md=".$HTTP_GET_VARS['md']."&id=".$HTTP_GET_VARS['id']."&mfvrt=rmv'>
Remove this ad from favorites</a> &nbsp;&nbsp;

<a href='index.php?ct=".$HTTP_GET_VARS['ct']."&md=".$HTTP_GET_VARS['md']."&id=".$HTTP_GET_VARS['id']."&mfvrt=rmall'>
Remove all favorites</a>&nbsp;
";
}
else {$var1=
"<a href='index.php?ct=".$HTTP_GET_VARS['ct']."&md=".$HTTP_GET_VARS['md']."&id=".$HTTP_GET_VARS['id']."&mfvrt=add'>
Add this ad to favorite list</a>

";} 

$var2="";
if (($ck_var2=="1") and ($HTTP_GET_VARS['mfvrt']!="rmall")){
$var2="
<a href='index.php?md=browse&mfvrt=1'>
Your favorite ads 
</a>
 &nbsp;
";
}
$var="
<FONT FACE='Verdana,Geneva,Arial' SIZE=1 color='#000099'><b>
$var2 $var1    
</b></font>
";
return $var;
}



function add_favorite()
{
global $HTTP_COOKIE_VARS, $HTTP_GET_VARS,$cookie_time;

$mss_cookies=split(',',$HTTP_COOKIE_VARS['ckfvr']);

$ck_var=""; 
foreach ($mss_cookies as $cook_value)
{ 
if ($cook_value==$HTTP_GET_VARS['id']){$ck_var="1";}
}

if ($ck_var!="1"){ 
$vfvr_cookie=$HTTP_COOKIE_VARS['ckfvr'].$HTTP_GET_VARS['id'].",";
setcookie ("ckfvr", $vfvr_cookie, $cookie_time);
}
}

function remove_favorite()
{
global $HTTP_COOKIE_VARS, $HTTP_GET_VARS;
$mss_cookies=split(',',$HTTP_COOKIE_VARS['ckfvr']);

$vfvr_cookie="";

foreach ($mss_cookies as $cook_value)
{ 
if (($cook_value!='') and ($cook_value!=$HTTP_GET_VARS['id']))
{$vfvr_cookie=$vfvr_cookie.$cook_value.",";}
 }
setcookie ("ckfvr", $vfvr_cookie, $cookie_time);
 
}

function remove_all()
{
setcookie ("ckfvr");
}

function view_fv_ads()
{
global $HTTP_COOKIE_VARS, $HTTP_GET_VARS;

$mss_cookies=split(',',$HTTP_COOKIE_VARS['ckfvr']);
$where_string1="";
foreach ($mss_cookies as $cook_value)
{ 
if ($cook_value!='')
{$where_string1=$where_string1."idnum=$cook_value or ";}
} 
 
$where_string1=$where_string1."fdkspkdsanbf";
$db_dcf="or fdkspkdsanbf";
$where_string1=ereg_replace($db_dcf,"",$where_string1);

if ($HTTP_COOKIE_VARS['ckfvr']==''){$where_string1="idnum=0 ";}
return $where_string1;
}

?>