<?
# Setting up Classified Ads options:

# MySQL settings
# database name: 
$db_name="dds";
# host name:
$host_name="localhost";
# user's name:
$db_user="login1";
# user's password:
$db_password="passw1";
# name of database table for ads:
$table_ads="alm23";

# Set the base of the path of the directory where
# photos files will be kept.
$photos_path="photos/";

# Set the base to the URL of the directory where
# all photos files will be kept. 
$photos_url="photos/";

# Admin password and e-mail
$adm_passw="adm";
$adm_email="info@almondsoft.com";

# Number of ads displayed in the index page
$adsonpage="10";

# Expiration period for ads (days)
$exp_period="10";

# Set max size for  photos on the second ad page
$phptomaxsize=92000;
 
# Width of the second ad page (pixels)
$ad_second_width="650";
# Width of the top page (pixels) 
$top_page_width="700";
# Width of the index page (pixels) 
$ad_ind_width="700";

# Set up categories list:

$categories=array(
'title_1' => "Affair",
'manw' =>array("Man Looking for Woman","set1"),
'womenm' =>array("Woman Looking for Man","set1"),
'manm' =>array("Man Looking for Man","set1"),
'womenw' =>array("Woman Looking for Woman","set1"),
'title_2' => "Careers, Jobs:",
'infosys' =>array("Information Systems ","set2"),
'market' =>array("Marketing","set2"),
'genmanag' =>array("General Management","set2"),
'administr' =>array("Administrative","set2"),

'title_3' => "Computers, Custom Programming",
'comphard' =>array("Computer Hardware","set3" ),
'compsoft' =>array("Computer Software","set3"),
'cgiprog' =>array("CGI Programming","set3"),
'webdes' =>array("Web Design","set3"),
'databas' =>array("Databases","set3"),
'network' =>array("Networking","set3")
);

# Set up the sets of the fields for categories
$fields_sets=array (
'set1' => array (title,name,age,weihgt,height,smoker,goal,brief,moredetails,contact_name,contact_phone,email,
homeurl,passw),
'set2' => array (title,type,salary,company,brief,contact_name,contact_phone,email,homeurl,passw),
'set3' => array (title,type,price,company,brief,contact_name,contact_phone,email,homeurl,passw,check1)
);

#  Set up description of ad fields used in all categories:
$ads_fields= array(
'title' => array('Title','1','nosearch','40:50','text','1','text'),
'brief' => array('Brief Description','2','nosearch','40:2:200','textarea','1','text'),
'contact_name' => array('Contact Name','2','nosearch','40:50', 'text', '1','text'),
'contact_phone' => array('Contact Phone','00','nosearch','20:50', 'text', '0','text'),
'email' => array('Contact e-mail','00','nosearch','20:50', 'text', '1','text'),
'homeurl' => array('Home Page URL', '00','nosearch','40:50', 'text','0','text'),
'passw' => array('Edit/delete password','00','nosearch','20:50', 'text','1','text'),
'name' => array('Name','1','nosearch','40:50','text','1','text'),
'city' => array('City','1','keyword','40:50','text','1','text'),
'goal' => array('Goal','12','keyword','1:30','select', '1', 'text',
        '<option>Marriage<option>Sex<option>Virtual Romance'),	
'check1' => array('checkbox field','12','keyword','1:30','checkbox','1','text', 
        '<option>checkoption 1<option>checkoption 2<option>checkoption 3' ),
'type' => array('Type','12','keyword','1:30','select', '1','text',
'<option>Needed<option>Offered' ),	
'price' =>  array('Price','12','minmax','10:30','text','0','integer'),
'salary' => array('Salary','12','minmax','10:30','text','0','real'),
'company' => array('Company',"12",'keyword','20:30','text', '0','text'),
'smoker' => array('Smoker','12','nosearch','1:30','select', '1', 'text',
'<option>Yes<option>No' ),
'age' =>  array('Age','12','minmax','10:30','text','1','integer'),
'weihgt' =>  array('Weight,kg','12','minmax','10:30','text','0','integer'),
'height' =>  array('Height,cm','12','minmax','10:30','text','0','integer'),	
'moredetails' => array('More Details','2','nosearch','40:6:2000','textarea','0','text')
);

# Set up short names of the fields which will be displayed 
# on the search form on the top page (it is necessary when search through all categories ) .
$allcatfields=array('title','brief','email','homeurl', 'passw', 'company','city', 'contact_name');

# Set up default value for fields with type 'select'
$select_text="Please choose one";

# Set up format for displaying fields with real type
$real_format="%01.2f"; 

# Set up html header for all pages
$html_header= "
<html>
<head><title>Almond Classified</title></head>
<body bgcolor='#ffffff' >
<center> 
<table>
<tr><td>
<center> 
<table width='100%' bgcolor='#eeeeee' border='0' cellspacing='0' cellpadding='0'>
<tr><td width='25%' align='center' bgcolor='#eeeeee'>
<font FACE='ARIAL, HELVETICA' size='-2'>
<a href='http://www.almondsoft.com'><b>AlmondSoft.Com</b></a>
</font>
</td> 
<td width='25%'  align='center' bgcolor='#eeeeee'>
<font FACE='ARIAL, HELVETICA' size='-2'>
<a href='http://www.almondsoft.com/alclfree.html'><b>Load free version</b></a>
</font>
</td> 
<td width='25%'  align='center' bgcolor='#eeeeee'>
<font FACE='ARIAL, HELVETICA' size='-2'>
<a href='http://www.almondsoft.com/ordercl.html'><b>Order On-Line</b></a>
</font>
</td> 
<td width='25%'  align='center' bgcolor='#eeeeee'>
<font FACE='ARIAL, HELVETICA' size='-2'>
<a href='http://www.almondsoft.com/alcl.html'><b>Features</b></a>
</font>
</td></tr>
</table>
<p>
 
 <font FACE='ARIAL, HELVETICA' size='-1' color='#777777'>
<b><font size='+1'>Almond Classifieds</font></b>
<br>
Classified Ads Script. Version 4.03.
</font>
</center>
 
";

# Set up html footer  for all pages
$html_footer="
<center>
<hr width='700' size=1>
<table   border='0' cellspacing='0' 
cellpadding='0' width='700'>
<tr><td>
<P ALIGN='JUSTIFY'>
<font STYLE='font-family: 
ARIAL, HELVETICA, san-serif; font-size: 11px; COLOR: #000088;
FONT-WEIGHT: normal;'> 
 &nbsp;
Dear potential customer! If you have  installed and configured successfully
the free version of Almond Classifieds, you prefer our script to others and 
plan to purchase it,
then we can consider the ability to give you Almond Classifieds script (Standard Edition)
for a trial (7 days) to make final decision about the purchase. To receive this script
please inform us via e-mail <a href='mailto:info@almondsoft.com'>info@almondsoft.com</a> for which purposes you need the 
script, and send us the URL of installed free version. In 7 days time after having  received the script,
you must inform us about the testing results and then you should either purchase the script license
or delete the script files from your computers. 
 
</font>
</td></tr>
</table>
<table width='100%' bgcolor='#eeeeee' border='0' cellspacing='0' cellpadding='0'>
<tr><td>
<font FACE='ARIAL, HELVETICA' size='-2'>
<center>
<b>Copyright © 2005 <a href='http://www.almondsoft.com'>AlmondSoft.Com</a> All right reserved.
</b>
</font>
</center>
</td></tr>
</table>
<p>
</center>
</td></tr>
</table>
</center>
</body>
</html>
";
 
# Set up info for left column on the top page:
# It should begin with html tag <td> and finish with tag </td>
$top_leftcol="
<td width='195' bgcolor='#eeeeee'  valign='top'>

<table width='100%'  bgcolor='#777799' border=0 cellspacing='0' cellpadding='0'>
<tr><td> 
<font FACE='ARIAL, HELVETICA' color='#ffffff' size='-1'>
 &nbsp;<b>Order On-Line:</b>
</font>
<TABLE  WIDTH='100%'   border='0' cellspacing='1' cellpadding='10' >
<tr><td bgcolor='#ffffff'> 
<font FACE='ARIAL, HELVETICA' color='#000099' size='-1'>
 
<P ALIGN='JUSTIFY'>
<a href='http://www.almondsoft.com/ordercl.html'>
<b>Order Standard Edition, $45</b></a><br>
editing/deleting  ads by users, ads moderating by admin,
privacy mail, powerfull searching, many photos and 
multimedia file for ads...
<a href='http://www.almondsoft.com/ac4/index.php'>Demo</a>  &nbsp; 
<a href='http://www.almondsoft.com/alcl.html'>More</a>
<P ALIGN='JUSTIFY'>
<a href='http://www.almondsoft.com/ordercl.html'>
<b>Order Pro Edition, $195</b></a><br>
e-commerce, membership, comments for ads, ads rating,
bad words guard, import ads in .csv format (e.g. from Excel) ...
<a href='http://www.almondsoft.com/acp/index.php'>Demo</a>  &nbsp; 
<a href='http://www.almondsoft.com/alcl.html'>More</a>... 
</font>
</td></tr></table>
</td></tr></table>
<p>
<table width='100%'  bgcolor='#777799' border=0 cellspacing='0' cellpadding='0'>
<tr><td> 
<font FACE='ARIAL, HELVETICA' color='#aa0000' size='-1'>
 &nbsp;<b> Warning !</b>
</font>
<TABLE  WIDTH='100%'   border='0' cellspacing='1' cellpadding='10' >
<tr><td bgcolor='#ffffff'> 
<font FACE='ARIAL, HELVETICA' color='#990000' size='-1'>
<P ALIGN='JUSTIFY'>
 &nbsp;
According to license agreement (see readme.txt file) it is strongly required 
to have the small link to AlmondSoft.Com on the page footers of the script. This link
can be removed in fee based versions (Standard, Pro) only. 
</font>
</td></tr></table>
</td></tr></table>
</td>
"; 

# Set up info for left column on the ads index page:
# It should begin with html tag <td> and finish with tag </td>
$ind_leftcol="
<td width='120' bgcolor='#eeeeee'  valign='top'>

<table width='100%'  bgcolor='#777799' border=0 cellspacing='0' cellpadding='0'>
<tr><td> 
<font FACE='ARIAL, HELVETICA' color='#ffffff' size='-2'>
 &nbsp; <b> Main Idea:</b>
</font>
<TABLE  WIDTH='100%'   border='0' cellspacing='1' cellpadding='4' >
<tr><td bgcolor='#ffffff'> 
<font FACE='ARIAL, HELVETICA' color='#000099' size='-2'>
 <b>
<P ALIGN='JUSTIFY'>
 &nbsp; <b>Almond Classifieds</b> main idea - 
easy to use, configurate and install;
easy set up custom categories, fields, search;
</b>
</td></tr></table>
</td></tr></table>
<p>
<table width='100%'  bgcolor='#777799' border=0 cellspacing='0' cellpadding='0'>
<tr><td> 
<font FACE='ARIAL, HELVETICA' color='#ffffff' size='-2'>
 &nbsp;<b> Warning !</b>
</font>
<TABLE  WIDTH='100%'   border='0' cellspacing='1' cellpadding='4' >
<tr><td bgcolor='#ffffff'> 
<font FACE='ARIAL, HELVETICA' color='#990000' size='-2'>
<P ALIGN='JUSTIFY'>
 &nbsp; <b>
According to license agreement (see readme.txt file) it is strongly required 
to have the small link to AlmondSoft.Com on the page footers of the script. This link
can be removed in fee based versions (Standard, Pro) only. 
</b></font>
</td></tr></table>
</td></tr></table>
 
</td>
"; 


# Set up info for left column on the  page with ads details:
# It should begin with html tag <td> and finish with tag </td>
$detl_leftcol="

<td width='160' bgcolor='#eeeeee'  valign='top'>
<table width='100%'  bgcolor='#777799' border=0 cellspacing='0' cellpadding='0'>
<tr><td> 
<font FACE='ARIAL, HELVETICA' color='#ffffff' size='-1'>
 &nbsp;<b>Order On-Line:</b>
</font>
<TABLE  WIDTH='100%'   border='0' cellspacing='1' cellpadding='4' >
<tr><td bgcolor='#ffffff'> 
<font FACE='ARIAL, HELVETICA' color='#000099' size='-1'>
 
<P ALIGN='JUSTIFY'>
<a href='http://www.almondsoft.com/ordercl.html'>Order Standard Edition, \$45</a>
 -  &nbsp;
editing/deleting  ads by users, ads moderating by admin,
privacy mail, powerfull searching, many photos and 
multimedia file for ads... 
<a href='http://www.almondsoft.com/ac4/index.php'>Demo</a>  &nbsp;
<a href='http://www.almondsoft.com/alcl.html'>More</a>
<P ALIGN='JUSTIFY'>
<a href='http://www.almondsoft.com/ordercl.html'>Order Pro Edition, \$195</a><br>
e-commerce, membership, comments for ads, ads rating,
bad words guard, import ads in .csv format (e.g. from Excel) ...
<a href='http://www.almondsoft.com/acp/index.php'>Demo</a>  &nbsp;
<a href='http://www.almondsoft.com/alcl.html'>More</a>... 
</font>
</td></tr></table>
</td></tr></table>

</td>
"; 

#############################################################

require("sfmd.php");
?>