<?

include('funcs2.php');

function print_categories()
{ 
global $html_header, $html_footer, $categories,$ad_ind_width,
$catl_width, $top_page_info,  $top_page_width, $topsearchfields, $top_leftcol; 
echo $html_header;
echo "
<center>
 <table width='$top_page_width'  border=0 cellspacing=0 cellpadding=1>
<tr>
$top_leftcol
<td valign='top'> 
".print_fav_ads_ind()."
<table width='100%' bgcolor='#dddddd' border=0 cellspacing=0 cellpadding=1>
<tr><td> 
<font FACE='ARIAL, HELVETICA' color='#000099' size=-1>
<b>Categories:</b>
</font>

</td></tr><tr><td>

<TABLE   bgcolor='#ffffff' border='0' cellspacing=0 cellpadding='10' WIDTH='100%' >
<tr><td> 
<TABLE   bgcolor='#ffffff' border='0' cellspacing=0 cellpadding=8 WIDTH='100%' >
 
";

$s357=0;
 foreach ($categories as $key => $value)
{
$aa1=split("_",$key);
if($aa1[0] == 'title')
{
if ($s357 == '1')
{
echo "</TR>";
$s357=0;
}
echo "
<tr><td colspan='2'>
<TABLE BORDER=0 WIDTH='100%' bgcolor='#ddeeee' cellspacing=0 cellpadding=1>
<TR>
<td>
<font FACE='ARIAL, HELVETICA' size=-1 color='#004400'><b> 
".$categories[$key]."
</b></font>
</TD></TR></TABLE>
</td></tr>
";

}
else{

if($s357 != '1')
{ $s357='1';
echo "<TR><TD width='50%' VALIGN=TOP>";
print_cat_name($key);
echo "</TD>\n";
}
else
{ $s357='0';
echo "<TD width='50%' VALIGN=TOP>\n";
print_cat_name($key);
echo "</TD></TR>\n";
}

} 
}
 
echo "
</table>
</font>
</td></tr></TABLE>
 
</td></tr></TABLE>

 
</td></tr></TABLE></center>
";

echo $html_footer;
exit;
}

 
function print_cat_name($key)
{
global $categories;
echo "
<font FACE='ARIAL, HELVETICA' size=-1> 
&nbsp;<a href='index.php?ct=$key'><b>".$categories[$key][0]."</b></a> 
</font>
<br><font size='-1'>
&nbsp; ".get_cat_count($key)." ads,  updated: ".get_date_update($key)." . </font></b>
</li>
</font>
"; 
}



?>