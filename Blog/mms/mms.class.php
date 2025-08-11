<?php
/**************************************************************
MMS/PHOTOBLOG CLASS
version 1.6

released 3 Mar 2005

by ruben @ bolink.org
http://www.bolink.org

**************************************************************/
// config!
$pop3_address = "mms@yourdomain.org";
$pop3_server = "localhost";
$password = "test";
$images_dir = "./images/";
$date_format = "d-m-Y";
$db_host = "localhost";
$db_user = "";
$db_password = "";
$db_name = "";
$db_table = "mms";
/***************************************************************

Changelog 1.6 :

- added imap support check
- fixed example script
- added pop3_server
- cleaned up some code

Changelog 1.5 :

- added autocreate directory
- added autocreate sql table
- added changelog (w00t)
- changed error handling
- has permission checks now
- added example file

if you want something to be changed
or added, please email me so i can
use it in the next release.


this is all folks! mail me your page so
i can see how people use this script :)

***************************************************************/

// connecting to db
@mysql_connect($db_host, $db_user, $db_password) or header("location: $url?error=1");
@mysql_select_db($db_name) or header("location: $url?error=1");

// check if table exist
$check = mysql_query("SELECT * FROM `$db_table` LIMIT 0,1");
if (!$check) {
    $query = "CREATE TABLE `$db_table` (id int(11) NOT NULL auto_increment,type text NOT NULL,subject text NOT NULL,date text NOT NULL,UNIQUE KEY id (id)) TYPE=MyISAM; ";
    $url = "http://bolink.org/projects/mms/error.php"; // don't change this, its error handling
    $result = mysql_query($query) or header("location: $url?error=1");
}

// check if directory is writable
if (!is_writable($images_dir)) {
    @mkdir("$images_dir") or header("location: $url?error=2");
    @chmod($images_dir, 0777) or header("location: $url?error=3");
}

// check if imap works
if (!function_exists('imap_open')) {
    header("location: $url?error=7");
}

// open mailbox and get all emails from server
if (! $mail = @imap_open("{".$pop3_server.":143}INBOX", "$pop3_address", "$password")) {
    header("location: $url?error=4");
}
$headerstrings = imap_headers($mail);
foreach($headerstrings as $headerstring) {
    preg_match("/[0-9]/", $headerstring, $number);
    // parse message
    $header = imap_fetchheader($mail, $number[0]);
    preg_match("/Date: (.*)?[\+|-]/", $header, $date);
    $date = htmlentities($date[1]);
    $imap = imap_fetchstructure($mail, $number[0]);
    
    if (! empty($imap->parts)) {
        for ($i = 1, $j = count($imap->parts); $i < $j; $i++) {
            $msg = imap_fetchbody($mail, $number[0], $i + 1);
            $part = $imap->parts[$i];
            
            
            $headers = imap_header($mail, $number[0]);
            $email = htmlspecialchars($headers->fromaddress);
            $subj = $headers->Subject;
            $date = date($date_format, strtotime(substr($headers->Date, 0, 22)));
            $subj = preg_replace('/^.*Q\?(.*?)\?=$/', '\\1', $subj);
            $subj = str_replace("_", " ", $subj);
            $subj = str_replace("=2E", ".", $subj);
            $subj = addslashes($subj);
            
            if ($part->type == "3") {
                $ext = "3gp";
            } else if ($part->type == "5") {
                $ext = "jpg";
            }
            
            $query = "INSERT INTO `$db_table` VALUES ('NULL','$ext','$subj','$date')";
            $result = mysql_query($query) or header("location $url?error=5");
            $count = mysql_insert_id();
            
            if (! $handle = fopen("$images_dir/".$count.".$ext", "w")) {
                header("location: $url?error=6");
            }
            fwrite($handle, imap_base64($msg));
            fclose($handle);
        }
    }
}
imap_delete($mail, $number[0]);
imap_expunge($mail);
imap_close($mail);

?>

