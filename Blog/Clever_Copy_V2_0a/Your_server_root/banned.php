<?php
$banned_message = "You are not authorised to view this page";
$REMOTE_ADDR = getenv("REMOTE_ADDR");
$query="SELECT * from CC_ipbans";
$result = mysql_query($query);
while( $row = mysql_fetch_array( $result ))
        {
        if ($REMOTE_ADDR == $row[banip]){
             echo $banned_message;
             exit;
       }
}
?>