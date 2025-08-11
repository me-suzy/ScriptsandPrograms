<?
require('header.inc.php');

$cal->addEvent($year, $month, $day, $hour, $minute, $event_type, $header, $body, $date_year, $date_month, $date_day, $duration);
header("Location: $cal->PATH_PAGE_CALENDAR"."?action=findDate&numeric_month=$month&year=$year");
?>    

