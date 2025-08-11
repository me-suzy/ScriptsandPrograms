<?
$blf = "cdata.html";
$ctext = "*Chat data dumped by admin*<br>\n";
$file = fopen($blf, 'w');
fwrite($file, $ctext);
fclose($file);

echo "Chat data dumped successfuly. <a href=admin.php>Back</a>";
?>
