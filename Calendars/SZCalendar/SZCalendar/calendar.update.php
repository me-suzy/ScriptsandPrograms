<?
require('header.inc.php');
$cal->updateEvent($ID, $year, $month, $day, $hour, $minute, $event_type, $header, $body, $date_year, $date_month, $date_day, $duration);
header("Location: $cal->PATH_PAGE_CALENDAR");
?>    

