<?
include("chatconfig.php");
?>
<meta http-equiv="Refresh" content="<? echo $refresh; ?>">
<?
if (!file_exists("users/" . $_COOKIE['cookie_dschat'] . "")){
if ($hour == "23") {
echo "The server is currently resetting it's self. You've been automatically kicked.";
exit;
} else {
$no23 = "1";
}
if ($hour == "11") {
echo "The server is currently resetting it's self. You've been automatically kicked.";
exit;
} else {
echo "You've been kicked from the chat! Please rejoin. (Click Logout and log back in.)<br><br><font size=1>(Note: A probable reason for this is that the server has just reset it's self recently and you need to rejoin.)</font>";
exit;
}
}
?>
<body bgcolor="<? echo $col2; ?>">

<?php
 echo "<u><b><font color=$col3>Users in the room</font></u></b><br>";  
 $folder = "users";  
 $filecnt = 0; 
 if ($handle = opendir($folder)) {  
      while (false !== ($file = readdir($handle))) {   
           if (is_file("$folder/$file")) {   
                $size = filesize("$folder/$file");  
                echo "<font color=$col3>$file</font><br>"; $filecnt++; 
           }   
      }  
      closedir($handle); 
      if ($filecnt == "0") {
           echo "<font color=$col3>Nobody</font>"; 
      } else { 
           return;  
 }
 }
?>
</body>
