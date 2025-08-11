<?php
session_start();
?>
<html>
<head>
<style type="text/css">
body {font-family: arial}
</style></head>

<body bgcolor='#CCCCFF'>
<?php
include ("includes/db.conf.php");
include ("includes/connect.inc.php");


if (isset($_SESSION['auth'])){

if (isset($_POST['submit'])){
$foo = $_POST['foo'];
$queryp=mysql_query("update departments set used='0' ");

for ($i=0;$i<count($foo);$i++) {

            // do something - this can be a SQL query, echoing data to the browser, or whatever
           
                if ($foo[$i]=="on"){
                $used=1;}
                else{
		$used=0;}
		
		$queryp=mysql_query("update departments set used='1' where id='$foo[$i]' ");
		echo mysql_error();

      } // end "for" loop
echo "<center>Departments updated</center><br>";
}
$e=0;
$usedval=array();
$queryp=mysql_query("select * from departments");
while ($rowp=mysql_fetch_array($queryp)){
$e++;
$usedval[$e]=$rowp['used'];
}
$f=0;
?>
<center>
<h2>Store Categories</h2>
<form action=usedcats.php method='post'>
<table><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Apparel & Accesories</b></td>
</tr><tr>
<td>Women's Apparel</td><td><input type='checkbox' <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?>  name=foo[] value='1'></td>
</tr><tr>
<td>Men's Apparel</td><td><input type='checkbox' <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='2'></td>
</tr><tr>
<td>Children's Apparel</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='3'></td>
</tr><tr>
<td>Handbags & Accessories</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='4'></td>
</tr><tr>
<td>Footwear</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='5'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Bedding & Bath</b></td>
</tr><tr>
<td>Bedding & Bath</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='6'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Books</b></td>
</tr><tr>
<td>Business Technology</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='7'></td>
</tr><tr>
<td>Fiction</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='8'></td>
</tr><tr>
<td>Juvenile</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='9'></td>
</tr><tr>
<td>Miscellaneous</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='10'></td>
</tr><tr>
<td>Non Fiction</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='11'></td>
</tr><tr>
<td>Textbooks</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='12'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>DVD</b></td>
</tr><tr>
<td>DVD</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='13'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Electronic Computers</b></td>
</tr><tr>
<td>Computers & Printers</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='14'></td>
</tr><tr>
<td>Telephones</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='15'></td>
</tr><tr>
<td>Audio & Video</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='16'></td>
</tr><tr>
<td>Cameras & Optics</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='17'></td>
</tr><tr>
<td>Home Office Equipment</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='18'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Gifts Gadgets Toys</b></td>
</tr><tr>
<td>Toys</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='19'></td>
</tr><tr>
<td>Sports Gear & Equipment</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='20'></td>
</tr><tr>
<td>Gifts</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='21'></td>
</tr><tr>
<td>For the Pet</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='22'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Home Garden Decor</b></td>
</tr><tr>
<td>Kitchen & Dining</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='23'></td>
</tr><tr>
<td>Home Decor</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='24'></td>
</tr><tr>
<td>Garden & Patio</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='25'></td>
</tr><tr>
<td>Furniture</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='26'></td>
</tr><tr>
<td>Home Improvement</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='27'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Houseware Appliances</b></td>
</tr><tr>
<td>Housewares</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='28'></td>
</tr><tr>
<td>Tools</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='29'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Houseware Appliances</b></td>
</tr><tr>
<td>Jewelry</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='30'></td>
</tr><tr>
<td>Accessories</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='31'></td>
</tr><tr>
<td>Watches</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='32'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Luggage</td>
</tr><tr>
<td>Luggage</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='33'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Sports Gear</b></td>
</tr><tr>
<td>Toys</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='34'></td>
</tr><tr>
<td>Parlor Games</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='35'></td>
</tr><tr>
<td>Sports Gear & Equipment</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='36'></td>
</tr><tr>
<td>Event Tickets</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='37'></td>
</tr><tr>
<td>Hobbies & Collectibles</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='38'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Worldstock</b></td>
</tr><tr>
<td>Apparel & Accessories</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='39'></td>
</tr><tr>
<td>Bed, Bath & Kitchen</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='40'></td>
</tr><tr>
<td>Furniture</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='41'></td>
</tr><tr>
<td>Area Rugs</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='42'></td>
</tr><tr>
<td>Home Decor</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='43'></td>
</tr><tr>
<td>World Jewelry</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='44'></td>
</tr><tr>
<td>Global Collectibles</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='45'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Music</b></td>
</tr><tr>
<td>Music</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='46'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>VHS</b></td>
</tr><tr>
<td>VHS</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='47'></td>
</tr><tr>
<td colspan=2 bgcolor='#CCCC99'><b>Video Games</b></td>
</tr><tr>
<td>Video Games</td><td><input type='checkbox'  <?php $f++; if ($usedval[$f]=='1'){echo "checked";} ?> name=foo[] value='48'></td>
</tr><tr>
<td colspan=2 ><input type=submit name='submit'></td></tr>
</table>
</form>
</center>

<?php

}else{

echo "<center>You are not allowed to see this page</center>";
}?>
</body>
</html>

