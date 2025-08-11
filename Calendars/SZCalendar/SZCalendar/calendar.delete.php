<?
require('header.inc.php');
if (isset($ID)) {
  $cal->deleteEvent($ID);
  header("Location: $cal->PATH_PAGE_CALENDAR"."?action=findDate&numeric_month=$month&year=$year");
}
?>    

