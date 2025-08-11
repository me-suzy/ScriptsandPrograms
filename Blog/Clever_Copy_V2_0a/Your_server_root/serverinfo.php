<?
include "languages/default.php";
function uptime() {
  $uptm = strtok( exec( "cat /proc/uptime" ), "." );
  $days = sprintf( "%2d", ($uptm/(3600*24)) );
  $hours = sprintf( "%2d", ( ($uptm % (3600*24)) / 3600) );
  $minutes = sprintf( "%2d", ($uptm % (3600*24) % 3600)/60  );
  $seconds = sprintf( "%2d", ($uptm % (3600*24) % 3600)%60  );
  return array( $days, $hours, $minutes, $seconds );
}
$uptime = uptime();
if($getprefs3[showuptime]==1){
echo  $server_uptime_label;
echo  "  $uptime[0] $days_label,  $uptime[1] $hours_label, $uptime[2] $minutes_label.<br> ";
}else{}
$loadavg_array = explode(" ", exec("cat /proc/loadavg"));
$loadavg = $loadavg_array[2];
echo $server_load_label;
echo ($loadavg . "%");
?>