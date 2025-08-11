<?php
function square( $number )
{
$newNumber = $number * $number;
return 
$newNumber;
}
function cube( $number )
{
$newNumber = $number * $number * $number;
return 
$newNumber;
}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-gb">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="calculator.css">
<title>Calculator</title>
</head>

<body>
<div align="center">
  <center>
<form method="POST" action="calculator.php">
<p>To perform calculations such as squares, square roots, and 
cubes you&nbsp; need only fill in the first number field!<br><br>
</p>
<table border="0" cellspacing="1" width="304" id="calculator" height="139">
  <tr>
    <td width="292" align="center" height="39">
    <h3>&nbsp;Calulator</h3>
    </td>
  </tr>
  <tr>
    <td width="292" align="center" height="23">
    <input type="text" name="this" size="10"><br>    <input type="text" name="that" size="10"></td>
  </tr>
  <tr>
    <td width="292" align="center" height="24">
    <input type="submit" value="+" name="do">
    <input type="submit" value="-" name="do">
    <input type="submit" value="*" name="do">
    <input type="submit" value="/" name="do"><br>
    <input type="submit" value="^2" name="do">
    <input type="submit" value="^3" name="do">
    <input type="submit" value="SqRt" name="do">&nbsp;
    </td>
  </tr>
<?php

if ($do == "+"){
	if (($_POST['this'] != "") && ($_POST['that'] != "")) {
	$result = $_POST['this'] + $_POST['that'];
	}
	else {
	$message = "<font color=\"red\">You did not fill in both fields!</font>";
	$result = "N/A";
	}
}
elseif ($do == "-"){
	if (($_POST['this'] != "") && ($_POST['that'] != "")) {
	$result = $_POST['this'] - $_POST['that'];
	}
	else {
	$message = "<font color=\"red\">You did not fill in both fields!</font>";
	$result = "N/A";
	}
}
elseif ($do == "*"){
	if (($_POST['this'] != "") && ($_POST['that'] != "")) {
	$result = $_POST['this'] * $_POST['that'];
	}
	else {
	$message = "<font color=\"red\">You did not fill in both fields!</font>";
	$result = "N/A";
	}
}
elseif ($do == "/"){
	if (($_POST['this'] != "") && ($_POST['that'] != "")) {
	$result = $_POST['this'] / $_POST['that'];
	}
	else {
	$message = "<font color=\"red\">You did not fill in both fields!</font>";
	$result = "N/A";
	}
}
elseif ($do == "^2"){
	if ($_POST['this'] != "") {
	$result = square ( $_POST['this'] );
	$that = "";
	}
	else {
	$message = "<font color=\"red\">You did not fill in the first field!</font>";
	$result = "N/A";
	}
}
elseif ($do == "SqRt"){
	if ($_POST['this'] != "") {
	$result = sqrt($_POST['this']);
	$that = "";
	}
	else {
	$message = "<font color=\"red\">You did not fill in the first field!</font>";
	$result = "N/A";
	}
}
elseif ($do == "^3"){
	if ($_POST['this'] != "") {
	$result = cube ( $_POST['this'] );
	$that = "";
	}
	else {
	$message = "<font color=\"red\">You did not fill in the first field!</font>";
	$result = "N/A";
	}
}
?>

  <tr>
    <td width="292" align="center" height="19"><br><b>Result: <?php echo($result); ?><br><?php echo($message); ?></b></td>
  </tr>
  <tr>
    <td width="292" align="center" height="19"><br>Powered by <a href="http://www.godfatheruk.com">GodfatherUK</a></td>
  </tr>
</table>
</form>
  </center>
</div>
</body>

</html>