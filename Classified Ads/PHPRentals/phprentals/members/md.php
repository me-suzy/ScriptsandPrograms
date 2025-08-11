<?
$input=$_POST["pass"];

$printpass=md5("$input");
echo "$printpass";
?>