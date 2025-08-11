<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>BloGenerator - Blog tool</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="600" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td height="60" colspan="2" valign="top"><img src="title.jpg" width="332" height="54"></td>
  </tr>
  <tr>
    <td >

	 
<?php

if ($submit) {

//the prefix variable
$table_prefix= 'blog_';
//here you set the table name for usage in your code
define('EXAMPLE_TABLE', $table_prefix. 'table_name');
//the implementation in your query:
$sql = "SELECT * FROM " .EXAMPLE_TABLE. " WHERE `something` = 'something'";

require_once('connect.php');

$query="

CREATE TABLE  `entries` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `title` TINYTEXT NOT NULL ,
 `text` TEXT NOT NULL ,
 `picture` TINYTEXT,
 `mood` TINYTEXT,
 `year` SMALLINT NOT NULL ,
 `month` TINYINT NOT NULL ,
 `day` TINYINT NOT NULL ,
`time` TIMESTAMP( 14 ) NOT NULL,
PRIMARY KEY (  `id` )
);
";

$query1="
CREATE TABLE  `about` (
 `name` VARCHAR( 30 ) NOT NULL ,
 `email` VARCHAR( 40 ) ,
 `AIM` VARCHAR( 40 ) ,
 `MSN` VARCHAR( 40 ) ,
 `country` VARCHAR( 30 ) ,
 `state` VARCHAR( 20 ) ,
 `dob` TINYTEXT ,
 `gender` VARCHAR( 7 ) ,
 `bio` TEXT,
 `intrests` TEXT,
 `picture` TINYTEXT,
 `ocupation` TINYTEXT
);
";

$query2="
CREATE TABLE  `blog` (
 `template` TINYTEXT NOT NULL ,
 `color1` VARCHAR( 7 ) NOT NULL ,
 `color2` VARCHAR( 7 ) NOT NULL ,
 `color3` VARCHAR( 7 ) NOT NULL ,
 `font1` TINYTEXT NOT NULL ,
 `font2` TINYTEXT NOT NULL ,
 `font3` TINYTEXT NOT NULL ,
 `title` TINYTEXT,
 `titlefont` TINYTEXT,
 `sub` TINYTEXT NOT NULL ,
 `subfont` TINYTEXT NOT NULL ,
 `titleimage` TINYTEXT,
 `bgimage` TINYTEXT
);
";
$query3="
CREATE TABLE  `auth` (
 `username` VARCHAR( 20 ) NOT NULL ,
 `password` VARCHAR( 20 ) NOT NULL
);
";

$query4 = "INSERT INTO auth (username, password) VALUES ('$bloguser', '$blogpass')";

$query5 = "INSERT INTO about (name, email, aim, msn, country, state, dob, gender, bio, intrests, picture, ocupation) VALUES ('$name','$email', '$aim','$msn','$country','$state','$dob','$gender','$bio','$intrests','$picture','$ocupation')";

$query6 = "INSERT INTO blog (title, sub, titleimage) VALUES ('$blogtitle','$blogsub','$blogimg')";

mysql_query($query);
mysql_query($query1);
mysql_query($query2);
mysql_query($query3);
mysql_query($query4);
mysql_query($query5);
mysql_query($query6);
mysql_close();


echo "Configuration Complete. <a href='login.php'>Click here</a> to start blogging.";

} else{

$host="localhost";

  // display form

if (!isset($_POST['submit']))
 { 

  ?>


<form method="post" action="<?php echo $PHP_SELF?>">

<table>
<tr>
<td colspan="2">
Welcome to the BloGenerator configuraton page. Here you can setup your blog.
<br>
* required fields - all other fields may be left blank if desired
</td>
</tr>

<tr>
<td>
Blog Settings
</td>
</tr>

<tr>
<td>
*Blog Administration username:</td><td><input type="Text" name="bloguser" size="50"><br>
</td>
</tr>
<tr>
<td>
*Blog Administration password:</td><td><input type="Text" name="blogpass" size="50"><br>
</td>
</tr>

<tr>
<td>
*Blog Title:</td><td><input type="Text" name="blogtitle" size="50"><br>
</td>
</tr>
<tr>
<td>
Blog Subtitle:</td><td><input type="Text" name="blogsub" size="50"><br>
</td>
</tr>
<tr>
<td>
Blog Title Image URL:</td><td><input type="Text" name="blogimg" size="50"><br>
</td>
</tr>


<tr>
<td>
Personal Information (Will be displayed on Blog)
</td>
</tr>

<tr>
<td>
*Name:</td><td><input type="Text" name="name" size="50"><br>
</td>
</tr>
<tr>
<td>
Picture URL:</td><td><input type="Text" name="picture" size="50"><br>
</td>
</tr>
<tr>
<td>
Email:</td><td><input type="Text" name="email" size="50"><br>
</td>
</tr>
<tr>
<td>
AIM:</td><td><input type="Text" name="aim" size="50"><br>
</td>
</tr>
<tr>
<td>
MSN:</td><td><input type="Text" name="msn" size="50"><br>
</td>
</tr>
<tr>
<td>
Country:</td><td><input type="Text" name="country" size="50"><br>
</td>
</tr>
<tr>
<td>
State/Province:</td><td><input type="Text" name="state" size="50"><br>
</td>
</tr>
<tr>
<td>
Birthday:</td><td><input type="Text" name="dob" size="50"><br>
</td>
</tr>
<tr>
<td>
Gender:</td><td><input type="Text" name="gender" size="50"><br>
</td>
</tr>
<tr>
<td>
Ocupation:</td><td><input type="Text" name="ocupation" size="50"><br>
</td>
</tr>
<tr>
<td>
Bio:</td><td><textarea rows="10" cols="50" maxlength="300" name="bio"></textarea><br>
</td>
</tr>
<tr>
<td>
Intrests:</td><td><textarea rows="10" cols="50" maxlength="300" name="intrests"></textarea><br>
</td>
</tr>



<tr>
<td>
<input type="submit" name="submit" value="submit">
</td>
</tr>

</table>
</form>
  <?php



} // end if
}


?>




	</div>
    </td>
  </tr>
</table>
</body>
</html>