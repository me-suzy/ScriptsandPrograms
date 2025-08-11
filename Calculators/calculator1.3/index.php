<?php
/*
	Copyright 2004 (c) Epleweb.com
	
	GNU General Public License
	--------------------------------------------------------------------
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>The Calculator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
body {font-family: Verdana, Arial; font-size: 12px;}
h1 {font-family: Verdana, Arial; font-size: 24px;}
h2 {font-family: Verdana, Arial; font-size: 18px;}
h3 {font-family: Verdana, Arial; font-size: 14px; font-weight: bold;}
</style>
</head>
<body>
<h1>The Calculator</h1>
<h3>Version 1.3</h3>
<p>Important: Use the radian equivalent to the number when getting cos, sin and tan.</p>
<hr>
<h2>Simple</h2>
<form action="" method="post">
<input name="first" type="text" size="6" maxlength="10">
<select name="method1">
	<option value="add" selected>Add</option>
	<option value="sub">Subtract</option>
	<option value="multi">Multiply</option>
	<option value="div">Divide</option>
</select>
<input name="second" type="text" size="6" maxlength="10">
<br><br>
<input name="submit1" type="submit" value="Calculate">
</form>
<?php
// Get variables from POST:
$submit1 = $_POST['submit1'];
$submit2 = $_POST['submit2'];
$method1 = $_POST['method1'];
$method2 = $_POST['method2'];
$first = $_POST['first'];
$second = $_POST['second'];
$number = $_POST['number'];

// Simple
if ($submit1 == true) {
	switch ($method1) {
		case add: $ans = $first + $second;
		break;
		case sub: $ans = $first - $second;
		break;
		case multi: $ans = $first * $second;
		break;
		case div: $ans = $first / $second;
		break;
	}

$ans = number_format($ans, 2, ',', ' ');
echo "<p>The answer is $ans</p>";
}
?>
<hr>
<h2>Advanced</h2>
<form action="" method="post">
<input name="number" type="text" size="6" maxlength="10">
<select name="method2">
	<option value="cos">Get cosine</option>
	<option value="sin">Get sine</option>
	<option value="tan">Get tangent</option>
	<option value="decbin">Decimal to binary</option>
	<option value="bindec">Binary to decimal</option>
	<option value="dechex">Decimal to hexadecimal</option>
	<option value="hexdec">Hexadecimal to decimal</option>
	<option value="deg2rad">Degree to radian</option>
	<option value="rad2deg">Radian to degree</option>
</select>
<br>
<br>
<input name="submit2" type="submit" value="Calculate">
</form>
<?php
// Advanced
if ($submit2 == true) {
	switch ($method2) {
		case cos: $ans = cos($number);
		break;
		case sin: $ans = sin($number);
		break;
		case tan: $ans = tan($number);
		break;
		case decbin: $ans = decbin($number);
		break;
		case bindec: $ans = bindec($number);
		break;
		case dechex: $ans = dechex($number);
		break;
		case hexdec: $ans = hexdec($number);
		break;
		case deg2rad: $and = deg2rad($number);
		break;
		case rad2deg: $ans = rad2deg($number);
		break;
	}
echo "<p>The answer is $ans</p>";
}
?>
</body>
</html>