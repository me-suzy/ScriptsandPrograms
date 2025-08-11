<?

function get_short_date($time1)
{
$d=getdate($time1);
$months =array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
$d2=$d['mon'];
$date_string=$months[$d2-1]." ".$d['mday'];
return $date_string;
}

function get_ads_count()
{
global $cat_fields, $table_ads, $ct, $page,$adsonpage, $html_header, $html_footer; 
 
$where_string=get_where_string();
$sql_query="select count(idnum) from $table_ads where 
$where_string ";


if( !($sql_res=@mysql_query("$sql_query")))
{echo $html_header;
echo "
<center>
<font FACE='ARIAL, HELVETICA'  COLOR='#bb0000' size=-1><b>
Error in connecting to ads MySQL table <font color='#000099'>'$table_ads'</font>.
<br> Seems, this table is not created, 
<a href='createtb.php'>click here </a> to create this table.
 
</b></font></center>
";
echo $html_footer;
exit;
}

$row=mysql_fetch_row($sql_res);
$count=$row[0];
return $count;
}

function get_ads()
{
global $cat_fields, $table_ads,$ct,   $page,$adsonpage, $ratedads; 
if ($ratedads=="1"){$ord_ratedads="adrate desc,";}
$html_ads="";
$start_num=($page-1)*$adsonpage; 
if($page=="")$start_num=0;
$where_string=get_where_string();
$sql_query="select * from $table_ads where $where_string 
order by $ord_ratedads idnum desc limit $start_num, $adsonpage";
$sql_res=mysql_query("$sql_query");
$html_ads=$html_ads."<p>";
while ($row = mysql_fetch_array ($sql_res))
{
$html_ads=$html_ads.print_ad($row);
} 
return $html_ads;
}

function get_where_string()
{
global $cat_fields, $ct, $table_ads, $HTTP_GET_VARS, $text_userinfo;
$adctnm1="visible=1 and ";
if ($HTTP_GET_VARS['ct'] != "")
{
$adctnm1=$adctnm1."catname='$ct' and ";
}

$where_string=$adctnm1;
$tm_check=time() - $HTTP_GET_VARS['before']*86400;

if ($HTTP_GET_VARS['before'] != "")
{$where_string=$where_string."time > $tm_check and "; 
}

if ($HTTP_GET_VARS['idemail'] != "")
{
$var_idemail=$HTTP_GET_VARS['idemail'];
$sql_query="select email from $table_ads where idnum='$var_idemail'";
$sql_res=mysql_query("$sql_query");
$row = mysql_fetch_row($sql_res);
$searchemail=$row[0];
$where_string=$where_string."email='$searchemail' and "; 
$text_userinfo="
<font FACE='ARIAL, HELVETICA' COLOR='#000099' font size='-1'>
<b>Ads posted by the same user</b>
</font>
";
}

if ($HTTP_GET_VARS['mblogin'] != "")
{$where_string=$where_string."login='".$HTTP_GET_VARS['mblogin']."' and ";
$text_userinfo="
<font FACE='ARIAL, HELVETICA' COLOR='#000099' font size='-1'>
Ads posted by member <b>'".$HTTP_GET_VARS['mblogin']."'</b>
</font>
";
}

if ($HTTP_GET_VARS['ratedads'] != "")
{$where_string=$where_string."adrate > 0 and ";
}

if ($HTTP_GET_VARS['onlywithphoto'] != "")
{$where_string=$where_string."adphotos='yes' and ";
}

if ($HTTP_GET_VARS['idnum'] != "") 
{$where_string=$where_string."idnum =".$HTTP_GET_VARS['idnum']." and ";
 }

if ($HTTP_GET_VARS['brief_key'] != "") 
{$where_string=$where_string.
"(brief like '%".$HTTP_GET_VARS['brief_key']."%' or title like '%".$HTTP_GET_VARS['brief_key']."%') and ";
 }

 foreach ($cat_fields as $key => $value )
{

if($cat_fields[$key][2] == "keyword") 
{
 
if ($HTTP_GET_VARS[$key] != "") {
$where_string=$where_string."$key like '%".$HTTP_GET_VARS[$key]."%' and ";
 }
}
if($cat_fields[$key][2] == "minmax")
{
$flmin=$key."1";
$flmax=$key."2";
if (($HTTP_GET_VARS[$flmin] != "") and ($HTTP_GET_VARS[$flmax] != "")) 
{
$HTTP_GET_VARS[$flmin]=ereg_replace(',', '', $HTTP_GET_VARS[$flmin]);
$HTTP_GET_VARS[$flmax]=ereg_replace(',', '', $HTTP_GET_VARS[$flmax]);

$where_string=$where_string."$key >= ".$HTTP_GET_VARS[$flmin]."
 and $key <= ".$HTTP_GET_VARS[$flmax]." and ";
}
}
}
$where_string=corr_wherestring($where_string);

if ($HTTP_GET_VARS['mfvrt']=='1'){$where_string=view_fv_ads();}
return $where_string;
}

function corr_wherestring($string1)
{
$string1=$string1."fdspkdsanbf";
$db_dcf="and fdspkdsanbf";
$string1=ereg_replace($db_dcf,"",$string1);
return $string1;
}


 
 

function get_jpg_path($id_count)
{
global $photo_url, $photo_path,  
$photos_url, $photos_path, $photos_count,
$previewphoto_url, $previewphoto_path, $multimedia_path,
$multimedia_url, $multim_ext;

for ($i=1; $i<=$photos_count; $i++)
{
$photo_url[$i]=$photos_url."p".$id_count."n".$i.".jpg";
$photo_path[$i]=$photos_path."p".$id_count."n".$i.".jpg";
}

$previewphoto_url=$photos_url."p".$id_count."prw".".jpg";
$previewphoto_path=$photos_path."p".$id_count."prw".".jpg";

$multimedia_url=$photos_url."mtmd".$id_count.$multim_ext;
$multimedia_path=$photos_path."mtmd".$id_count.$multim_ext;
} 

function ads_pages_list()
{
global $ads_count, $adsonpage, $ct, $page, $idemail, $mblogin,  $ratedads;
$search_str=get_srch_str();
if ($idemail!=""){$search_str="idemail=$idemail";}
if ($mblogin!=""){$search_str="mblogin=$mblogin";}
if ($ratedads=="1"){$search_str="ratedads=1";}
$num_pages=($ads_count-$ads_count%$adsonpage)/$adsonpage;
if ($ads_count%$adsonpage > 0) {$num_pages++;}
$list_pages="";
for ($i = 1; $i <= $num_pages; $i++) 
{
if ($i != $page){
$list_pages=$list_pages." [<a href='index.php?ct=$ct&md=browse&page=$i&$search_str'>$i</a>]";
}
else
{
$list_pages=$list_pages." [<font color='#ee0000'>$i</font>]";
}
}
$list_pages="Listing:".$list_pages;
if ($ads_count == 0) $list_pages="";
return $list_pages;

}

function get_srch_str()
{
global $page, $ads_count, $adsonpage, $ct, $mds, $HTTP_GET_VARS;
$search_str="";
$mds_res=0;
if($HTTP_GET_VARS['mds'] == 'search')
{
foreach ($HTTP_GET_VARS as $key => $value)
{
if (($key !='md')  and ($key !='page') and ($key !='ct'))
{$mds_res=1;
$value=ereg_replace(' ', '+', $value);
$value=ereg_replace('@', '%40', $value);
$value=ereg_replace('!', '%21', $value);
$search_str=$search_str."$key=$value&";
}
}
}
if ($mds_res==0)
{
$mds="";
$HTTP_GET_VARS['mds']="";
}
return $search_str;

}

function pages_next_prev()
{
global $page, $ads_count, $adsonpage, $ct, $HTTP_GET_VARS, $idemail, $mblogin, $ratedads;
$search_str=get_srch_str();
if ($idemail!=""){$search_str="idemail=$idemail";}
if ($mblogin!=""){$search_str="mblogin=$mblogin";}
if ($ratedads=="1"){$search_str="ratedads=1";}
$max_pages=($ads_count-$ads_count%$adsonpage)/$adsonpage;
if ($ads_count%$adsonpage > 0) {$max_pages++;}
$next_prev="";
if ($page>1)
{
$a1_prev=$page-1;
$next_prev=$next_prev.
"<a href='index.php?ct=$ct&md=browse&page=$a1_prev&$search_str'>Previous</a>";
}
if($page==0)$page=1;
$next_prev=$next_prev." Page $page of $max_pages ";
$a1_next=$page+1;
$a2=$page*$adsonpage;
if ($a2 < $ads_count)
{
$next_prev=$next_prev.
"<a href='index.php?ct=$ct&md=browse&page=$a1_next&$search_str'>Next</a>";
}
if ($ads_count == 0) $next_prev="";
return $next_prev;
}



function start()
{
global $ct,$ads_fields,$categories, $ads_count, $cat_fields,$fields_sets,$allcatfields;
connect_to_db();
$c_res1=0;
foreach ($categories as $key => $value)
{
if ($key == $ct ){$c_res1=1;}
}
if ($c_res1==0){
if ($ct !=""){
echo $html_header;
echo "<h3> Incorrect Cateogry </h3>";
echo $html_footer;
exit;
}
}
if ($ct!="")
{
$a1=$categories[$ct][1];
$a2=$fields_sets[$a1];
}
else 
{$a2=$allcatfields;}
foreach ($a2 as $a2_value)
{
$cat_fields[$a2_value]=$ads_fields[$a2_value];
}
 
$ads_count=get_ads_count();
}

function corr_sqlstring($string1)
{
$string1=$string1."fdspkdsnbf";
$db_dcf=", fdspkdsnbf";
$string1=ereg_replace($db_dcf,"",$string1);
return $string1;
}

function connect_to_db()
{
global $host_name, $db_user,$db_password, $html_header, 
$html_footer, $db_name, $table_ads;

if (!(@mysql_connect("$host_name","$db_user","$db_password")))
{echo $html_header;
echo "
<center>
<font FACE='ARIAL, HELVETICA'  COLOR='#bb0000' size=-1><b>
Error in connecting to your MySQL server.  <br> You need to set up  
correct values   for variables <br> \$host_name, \$db_user, \$db_password 
in the config.php file
</b></font></center>
";
echo $html_footer;
exit;
}
if (!(@mysql_select_db("$db_name")))
{echo $html_header;
echo "
<center>
<font FACE='ARIAL, HELVETICA'  COLOR='#bb0000' size=-1><b>
Error in connecting to your MySQL database <font color='#000099'>'$db_name'</font>.
<br> You need to set up 
correct database name in variables \$db_name of <br> the config.php file 
or create the database with such a name.
</b></font></center>
";
echo $html_footer;
exit;
}
}


?>