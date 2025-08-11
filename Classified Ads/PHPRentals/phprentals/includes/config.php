<?
//Main variables
$sitename = "PHPRentals";
$domain = "www.yourdomain.com"; //www.yourdomain.com
$owneremail = "webmaster@yourdomain.com"; //name@domain.com
$emailsubject = "PHPRentals Registration"; //Subject for landlord registration email

//Database connection info
$hostname = "localhost";
$username = "";
$password = "";
$dbName = ""; 
MYSQL_CONNECT($hostname, $username, $password) OR DIE("Unable to connect to database"); 
@mysql_select_db( "$dbName") or die( "Unable to select database"); 

//landlord add image variables
$abpath = "".$_SERVER['DOCUMENT_ROOT']."/phprentals/images/"; //Absolute path to where images are uploaded. No trailing slash
$sizelim = "yes"; //Do you want size limit, yes or no
$max_size = "25000000"; //What do you want size limited to be if there is one

?>