<?php

$cssfile = "../images/css.css";

if (file_exists($cssfile)) {
	@chmod("$cssfile", 0777);


	if (isset($_POST['submit'])) {
		$newdata = $_POST['newdata'];
		$fp = fopen("$cssfile", "w");

		@chmod("$cssfile", 0777);


		fwrite($fp, stripslashes($newdata));
		fclose($fp);
	}

	$fp = fopen("$cssfile", "r");
	$data = "";
	while (!feof($fp)) {

		$data .= fgets($fp, 4096);

	}

	$size = filesize("$cssfile");
	$filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	$fsize = round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i];

	fclose($fp);
}
else
{
	die ("<p class='error'>CSS File not found!</p>");
}
?>
<h2>CSS Editor</h2>
<p>Filesize: <em><? echo $fsize; ?></em></p>

<form action="" method="post">
<textarea name="newdata" rows="50" cols="60">
<?
print $data;
?>
</textarea>
<br />
<input type="submit" name="submit" value="Submit">
</form>
<br />

<p><a onclick="switchMenu('nextstep');" style='cursor:pointer;cursor:hand' title="Switch!">CSS Websites</a>
</p>
<div id="nextstep" style="display: none;">
<p>
- <a href="http://www.w3schools.com/css/default.asp" title='W3Schools'>W3Schools CSS Page</a>
<br />- <a href="http://jigsaw.w3.org/css-validator/" title='CSS Validator'>W3C CSS Validator</a>
</p></div>
<br />