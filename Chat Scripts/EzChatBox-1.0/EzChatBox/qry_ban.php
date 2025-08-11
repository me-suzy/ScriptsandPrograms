<?php
if($ip)
	{
	$ip_header = "banned ips\n<br>";
	$new_ip = "$ip\n<br>";

	$ip_array = file("banned.ban");
	for ($ip_counter = 1; $ip_counter < 1000; $ip_counter++) 
	    {
		$old_ips.= $ip_array[$ip_counter];
		}
	// Opens file for writing and truncates file length to zero.

		$ban_file = fopen("banned.ban", "w");

	/*-----------FOURTH UPDATE THE messages.htm-----------*/
	// write file header...


		fputs($ban_file, $ip_header);

	// ... new line...
	// (stripSlashes because we don't want all
	// our escape characters appearing in the
	// message file)
		fputs($ban_file, stripslashes($new_ip));

	// ... old lines ...
		fputs($ban_file, $old_ips);

	// Close the file when you're done. Don't forget to wash your hands
		fclose($ban_file);
	
	}
	?>
<html>
<head>
<title>User with IP <?php echo $ip ; ?> is banned</title>
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#000000">
Users currently with a ban are:
<table>
<tr>
	<th>IP</th>
</tr>
<tr>
	<td><?php 
	$banned_array = file("banned.ban"); 
	for ($counter = 1; $counter <sizeof($banned_array); $counter++) 
		{ 
		print ("$banned_array[$counter]<br>");
		}
	?></td>
</tr>
</table><br>
<a href="home.html" target="_self">Back to Gangreen site</a>
</body>
</html>