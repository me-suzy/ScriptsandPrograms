<?php
include ("../includes/db.conf.php");
include ("../includes/connect.inc.php");


$queryp=mysql_query("select * from departments where used='1' order by lasttime limit 0,1");
while ($rowp=mysql_fetch_array($queryp)){

$last= time();
$queryp2=mysql_query("update departments set lasttime=$last where csv='$rowp[csv]'");

// open some file for reading
$remote_file = $rowp['csv'].".zip";
$handle = fopen($remote_file, 'wb');
$ftp_server = "ftp.overstock.com";
// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, "media", "m3d.14");




if (ftp_fget($conn_id, $handle, $remote_file, FTP_BINARY)) {
echo "successfully written to $remote_file\n";
} else {
echo "There was a problem with $remote_file\n";
}

// close the connection and the file handler
ftp_close($conn_id);
fclose($handle);

}
?>
