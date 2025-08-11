<?php
// get all of the header info needed to get a comment from the DB

$ip=$_SERVER['REMOTE_ADDR']; // ip address of the reader - use to block nasties later if needed
if ($HREF==null||$ATEXT==null||$FROM==null) {
//    print "No HREF, ATEXT or FROM";
    exit();
}
  $date=date('m/d/Y G:i:s');

// write it to the file
   $handle=fopen('linktrack.txt','a'); // this must be writeable so chmod the dir to let the system work.
   fwrite($handle,"'$FROM','$HREF','$ATEXT','$date','$ip'\r\n");
   fclose($handle);
   exit();
?>
