<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>sample photo blog script</title>
</head>
<body>
<?
include("mms.class.php");

$query = "SELECT * FROM `$db_table`";
$result = @mysql_query($query);
$num_rows = @mysql_num_rows($result);

 if ($num_rows >= 1) {
  while ($mms = mysql_fetch_array($result, MYSQL_ASSOC)) {
   echo "<img src=\"$images_dir$mms[id].jpg\" alt=\"$mms[id]\"><br />text : $mms[subject] <br />date: $mms[date]<br /><br />";
  }
 } else {
  echo "no photos yet.";
 }
?>
</body>
</html>
