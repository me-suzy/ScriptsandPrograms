<?
require("config.php");
 
require("funcs1.php");

if ($md=="logout") {  logout();}

connect_to_db(); 

if ($md=="print_menu") 
{
if($admpassw1 != $adm_passw){
$inc_passw="incorrect password !"; 
printpasswordform($inc_passw);
exit;
}
setcookie("admcookpassw", $admpassw1);
print_menu();
exit;
}

if($admcookpassw != $adm_passw){
if ($admcookpassw != ""){
$inc_passw= "Incorrect password or cookies does not work"; 
}
printpasswordform($inc_passw);
exit;
}

if ($md=="") print_menu();
if ($md=="create_db") create_db();
if ($md=="create_tb") create_tb();
if ($md=="sql_tb") print_sql_tb();
 

function logout()
{
setcookie("admcookpassw", "0");

printpasswordform($inc_passw);
exit;
} 

 

function print_menu()
{
global $html_header, $html_footer, $db_name, $table_ads, 
$moderating, $categories;
echo $html_header;
echo "<center>
<table width='450' bgcolor='#dddddd' border=0 cellspacing=0 cellpadding=1>
<tr><td> 
<font FACE='ARIAL, HELVETICA' >
<center><b> Admin Interface </b></center> 
</font>
</td></tr></table>
<p>
";
echo " 
<p>
<table width='450' bgcolor='#dddddd' border=0 cellspacing=0 cellpadding=1>
<tr><td> 
<font FACE='ARIAL, HELVETICA' size=-1>
<b>Create database table for classifieds</b>
</font></td></tr><tr><td>
<TABLE   bgcolor='#ffffff' border='0' cellspacing=0 cellpadding=0 WIDTH='100%' >
<tr><td> 
<font FACE='ARIAL, HELVETICA' size=-1>
 
<br><b><a href='createtb.php?md=create_tb'>Create table '$table_ads'</a></b>
<br><font FACE='ARIAL, HELVETICA' color='#aa0000' size=-2>
Warning ! Old table '$table_ads' if exists will be deleted.
</font>
<p> 
<a href='createtb.php?md=sql_tb'>SQL for creating table '$table_ads'</a>
 </font>
</td></tr></table>
</td></tr></table>
<p><b><a href='admin.php?md=logout'>Log Out from admin. interface</a></b>
</center>";
echo $html_footer;
exit;
}

 

function print_sql_tb()
{
global $html_header, $html_footer;
echo $html_header;
echo sql_create_tb();
echo $html_footer;
exit;
}

function create_db()
{
global $host_name, $db_user,$db_password, $html_header, 
$html_footer, $db_name, $table_ads;

mysql_connect("$host_name","$db_user","$db_password");
mysql_create_db("$db_name");
echo $html_header;
echo "Database '$db_name' was created";
echo $html_footer;
exit; 
}

function create_tb()
{
global $host_name, $db_user,$db_password,
 $html_header, $html_footer, $db_name, $table_ads, $ads_fields; 

$sql_query1=sql_create_tb();

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

$result1 = mysql_list_tables ($db_name);
 $i = 0;
 while ($i < mysql_num_rows ($result1)) {
     $tb_names1  = mysql_tablename ($result1, $i);
    if ($tb_names1==$table_ads){mysql_query("DROP TABLE $table_ads;"); }
     $i++;
 }

 

if (!(mysql_query("$sql_query1"))){
echo $html_header;
echo "
<center>
<font FACE='ARIAL, HELVETICA'  COLOR='#bb0000' size=-1><b>
Error in creating   MySQL table '$table_ads'. <br> Check  errors
in variable \$ads_fields (config.php file) for ads fields settings  
   
";
echo $html_footer;
exit;
}

$message="
<font FACE='ARIAL, HELVETICA' COLOR='#000099' font size='+1'>
<b>Table '$table_ads' was created</b>  
<p>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' font size='-1'>
Now database '$db_name' contains the following tables:
<br> 
";

$result = mysql_list_tables ($db_name);
 $i = 0;
 while ($i < mysql_num_rows ($result)) {
     $tb_names[$i] = mysql_tablename ($result, $i);
   $message=$message.$tb_names[$i].", ";
     $i++;
 }
$message=$message." </font><br>
<img src='http://www.almondsoft.com/logo/logo5.php' height='1' width='1'>";
admin_message1($message);
exit; 
}

function sql_create_tb()
{
global $ads_fields, $table_ads;
$table_name=$table_ads;
$db_t_fields['idnum']="integer";
$db_t_fields['time']="integer";
$db_t_fields['exptime']="integer";
$db_t_fields['catname']="text";
$db_t_fields['visible']="integer";
$db_t_fields['adphotos']="char(5)";
$db_t_fields['login']="text";
$db_t_fields['adrate']="integer";

foreach ($ads_fields as $key => $value)
{
$db_t_fields[$key]=$ads_fields[$key][6];
}

$create_string="";
foreach ($db_t_fields as $db_key => $value)
{
$create_string=$create_string.$db_key." ".$db_t_fields[$db_key].", ";
}
$create_string=corr_sqlstring($create_string);
$sql="create table $table_name ( $create_string ) ";
return $sql;
}

 function admin_message1($message)
{
global $cat_fields, $photos_count, $html_header, $html_footer, $id,
$ct, $categories, $ad_second_width, $left_width_sp, $exp_period;
echo $html_header;
echo "
<center><table width='500'><tr><td>
<font FACE='ARIAL, HELVETICA' COLOR='BLACK'> <font size=-1>
<b><a href='index.php'>Categories:</a></b></font>
&nbsp; 
<hr size='1'><p>
$message
<p><hr size='1'>
</tr></td></table>
</center>
";
echo $html_footer;
exit;
}

function  printpasswordform($inc_passw)
{
global $html_header, $html_footer;

echo $html_header; 
echo "
<center>
<table width='500' bgcolor='#dddddd' border=0 cellspacing=0 cellpadding=1>
<tr><td> 
<font FACE='ARIAL, HELVETICA' >
<center><b> Admin Interface </b></center> 
</font>
</td></tr></table>
<p>
<font FACE='ARIAL, HELVETICA' COLOR='#990000'  >
<b> $inc_passw </b>
</font>
<p>
<form action='createtb.php?md=print_menu' method='post'>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-1'>
<b>
Input admin password : </b></font>
<input type='text' name='admpassw1'>
<input type='submit' value='Submit'>
</form>
<font FACE='ARIAL, HELVETICA' COLOR='#000099' size='-2'>
<br><b>(Cookies must be set up. Admin password is specified in the config.php file.
Default password: adm )
 </b></font>
 
<p>
<hr size=1 width='500'>
</center>
";
echo $html_footer;
exit;
}
 
?>