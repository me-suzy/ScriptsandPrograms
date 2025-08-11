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
if (isset($action)) {
  if (!isset($day))
    $day=1;
  echo $cal->action($action, $year, $numeric_month, $day);
} else {
  echo $cal->action();
}
?>

</body>
</html>    

