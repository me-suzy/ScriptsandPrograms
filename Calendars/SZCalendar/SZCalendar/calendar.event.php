<?
require('header.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Calendar</title>
  <LINK REL="StyleSheet" HREF="css/style.css" type="text/css">
</head>

<body>
<?
if (isset($ID)) {
  echo $cal->displayEditForm($year, $numeric_month, $day, $ID);
} else {
  echo $cal->displayEditForm($year, $numeric_month, $day);
}
?>
</body>
</html>    

