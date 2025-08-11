<? include("top.php"); ?>
<?php
$browser_string=$HTTP_USER_AGENT;
$client_ip=gethostbyname(localhost);
session_start();
      if(session_is_registered("whossession"))
      {
        $_SESSION['who']="manager";
      }
      else
      {
        session_register("whossession");
        $_SESSION['who']="manager";
      }
?>
<? include("topinstallmenu.php"); ?>
<?php
extract ($HTTP_POST_VARS,EXTR_OVERWRITE) ;
extract ($HTTP_GET_VARS,EXTR_OVERWRITE) ;
global $_force ;
$dbhost = "$dbservername";
$dbusername = "$dbusername";
$dbuserpassword = "$dbpassword";
$default_dbname = "$dbname";
if ($_POST["dbopname"]!="") {
$dbopname = $_POST["dbopname"];
$tblmanager = $dbopname ."tblmanager";
$tblcategory = $dbopname ."tblcategory";
$tblreport = $dbopname ."tblreport";
$tbluser = $dbopname ."tbluser";
$tblgroup = $dbopname ."tblgroup";
}
else{
$dbopname = $_POST["dbopname"];
$tblmanager ="tblmanager";
$tblcategory ="tblcategory";
$tblreport ="tblreport";
$tbluser = "tbluser";
$tblgroup = "tblgroup";
}

$MYSQL_ERRNO = "";
$MYSQL_ERROR = "";
$filename = 'dataaccess.php';
$checkfile = @fopen('dataaccess.php', 'w') or
   die("Cannot open file dataaccess.php. Please make it write-able.");
$checkfile1 = @fopen('dataaccess1.php','w') or
   die ("Cannot open file dataaccess1.php. Please make it write-able");

$filename ='dataaccess.php';
if (!$datafile = fopen($filename, 'w'))
{
         echo "Cannot open file ($filename) Please make it write-able.";

         exit;
}
else
{

    $strcontent = "<?php ";
    $strcontent = $strcontent . "\$dbservername=\"".$HTTP_POST_VARS[dbservername]."\" ;" ;
    $strcontent = $strcontent . "\$dbusername=\"".$HTTP_POST_VARS[dbusername]."\" ;" ;
    $strcontent = $strcontent . "\$dbpassword=\"".$HTTP_POST_VARS[dbpassword]."\" ;" ;
    $strcontent = $strcontent . "\$dbname=\"".$HTTP_POST_VARS[dbname]."\" ;" ;
    $strcontent = $strcontent . " ?>";
    fwrite($datafile, $strcontent , strlen($strcontent));
    fclose($datafile);
}
$filename1 ='dataaccess1.php';
if (!$datafile1 = fopen($filename1, 'w'))
{
         echo "Cannot open file ($filename1) Please make it write-able";
         exit;
}
else
{
  $strcontent1 = "<?php";
  $strcontent1 = $strcontent1 . " function dbConnect(){";
  $strcontent1 = $strcontent1 . "\$link=mysql_connect('{$_POST['dbservername']}','{$_POST['dbusername']}' , '{$_POST['dbpassword']}');";
  $strcontent1 = $strcontent1 . "if (!\$link)";
  $strcontent1 = $strcontent1 . "{ Error_handler('Error connecting to database server' , \$link ); } ";
  $strcontent1 = $strcontent1 . "mysql_select_db('{$_POST['dbname']}', \$link);}";
  $strcontent1 = $strcontent1 ."\$tblmanager=\"".$tblmanager."\";";
  $strcontent1 = $strcontent1 ."\$tblcategory=\"".$tblcategory."\";";
  $strcontent1 = $strcontent1 ."\$tblreport=\"".$tblreport."\";";
  $strcontent1 = $strcontent1 ."\$tblgroup=\"".$tblgroup."\";";
  $strcontent1 = $strcontent1 ."\$tbluser=\"".$tbluser."\";?>";
  /*$strcontent  = addslashes($strcontent)*/
  fwrite($datafile1, $strcontent1 , strlen($strcontent1));
  fclose($datafile1);
}

$_softup = $softup ;
if( $softup )
{
if( @mysql_connect($dbservername,$dbusername,$dbpassword ) )
{
   if(! @mysql_select_db($dbname))
      {
        die (" Data base doesn't exists. ") ;
    }
}
else
{
       die ("***Not connected*** ") ;
}
echo "Data base references updated " ;
echo "<br>" ;
?>
<br>
<br>
<br>
<a href ="regadmin.php">Proceed...</a> as administrator
<?php
return ;
}

$_force = $force ;
if ( ! $force )
    $_force = "N" ;
function db_connect()
{
global $dbhost,$dbusername,$dbuserpassword,$default_dbname;
global $MYSQL_ERRNO,$MYSQL_ERROR,$_force ;
$link_id=@mysql_connect($dbhost,$dbusername,$dbuserpassword);
if( $link_id == 0 )
    return 0 ;
echo "<center>" ;
$ok = false ;
if ( $_force )
{
    if ( $_force == "Y" )
    {
        $ok = false ;
        echo "<br><br>FORCE CREATION ENABLED. (tables will be replaced if found)<br><br>" ;
        }
           else
    {
        $ok = mysql_select_db($default_dbname) ;
        $_force = "" ;
    }
}
else
{
    $ok = mysql_select_db($default_dbname) ;
    $_force = "" ;
}
if( ! $ok )
{
        $querydb="create database $default_dbname" ;
        $resultdb=mysql_query($querydb);
        if(mysql_select_db($default_dbname) == false)
            {
            $MYSQL_ERRNO=mysql_errno();
            $MYSQL_ERROR=mysql_error();
            echo "connection failed @ stage2.<br>" ;
            return 0;
        }
    $dbname=$default_dbname;
}
elseif ($_POST["dbopname"]!=""){}
else
{
    echo "<br><br>Data Base already exists. Use FORCE CREATE to overwrite";
?>
&nbsp;&nbsp;&nbsp;[ <a href="install.php">Re-try</a> ]<br><br>
<?php
return;
}
return $link_id;
}

$link_id=db_connect() ;
if($link_id)
{
//to create access table
if ( $_force == "Y" )
mysql_query( "DROP TABLE ". $tblmanager ) ;
$querya = "CREATE TABLE ". $tblmanager ."(
  id int(11) NOT NULL auto_increment,
  username varchar(70) default NULL,
  password varchar(70) default NULL,
  PRIMARY KEY  (id))";
$resulta = mysql_query($querya) ;

if ( $_force == "Y" )
mysql_query( "DROP TABLE ".$tblcategory ) ;
$querys = "CREATE TABLE ". $tblcategory ." (
  categoryid int(11) NOT NULL auto_increment,
  categoryname varchar(150) default NULL,
  PRIMARY KEY  (categoryid))";
$results = mysql_query($querys) ;

if ( $_force == "Y" )
mysql_query( "DROP TABLE ". $tblreport ) ;
$queryas= " CREATE TABLE ". $tblreport ." (
  reportid int(11) NOT NULL auto_increment,
  categoryname varchar(250) default NULL,
  description text,
  hoursspent varchar(50) default NULL,
  reporteddate date default NULL,
  username varchar(100) default NULL,
  groupname varchar(200) default NULL,
  PRIMARY KEY  (reportid))";
$resultas=mysql_query($queryas) ;

if ( $_force == "Y" )
mysql_query( "DROP TABLE ".$tblgroup ) ;
$querysg = " CREATE TABLE ". $tblgroup ." (
  groupid int(11) NOT NULL auto_increment,
  groupname varchar(200) default NULL,
  PRIMARY KEY  (groupid))";
$resultsg = mysql_query($querysg) ;

if ( $_force == "Y" )
mysql_query( "DROP TABLE ".$tbluser ) ;
$querys1 = " CREATE TABLE ". $tbluser ." (
  userid int(11) NOT NULL auto_increment,
  username varchar(70) default NULL,
  password varchar(70) default NULL,
  email varchar(150) default NULL,
  groupname varchar(150) default NULL,
  PRIMARY KEY  (userid))";
$results = mysql_query($querys1) ;

echo "Data Base successfully created !";
echo "<br><br>";
?>
<br>
<br>
<br>
<a href ="regadmin.php">Proceed...</a> as administrator
<?php
}
else
 echo "** Not connected **" ;
?>
</body>
</html>
<? include("base.php");?>




