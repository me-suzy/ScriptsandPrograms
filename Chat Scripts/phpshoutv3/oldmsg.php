<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>phpSHOUT - Archive</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="default.css" rel="stylesheet" type="text/css">
</head>

<body class="phpshout_body">

<? 
	include "config.php";
	include "functions.php";

	$numPerPage = $archivenoofposts;
	$filename = "messages.txt";
	$handle = fopen($filename, "r");
	$read =	file_get_contents($filename);
	$x=0;

	// create array elements by new lines
	$array = explode ("\n",$read);
	
	$page = isset($_GET['page']) ? $_GET['page'] : 1;

	$start = ($page-1) * $numPerPage;

	?>
	<table align="center" class="phpshout_table">
	<?
	// start loop for each page
	for ($i=$start; $i<$start+$numPerPage; $i++) {		
		
		if ($array[$i] != NULL || $array[$i] != "") {
		
			list($name, $msg, $date) = explode("\t", $array[$i]);
			
			$date = str_replace(" ","/",$date);
			list($year,$month,$day,$time) = explode("/", $date);
			
			// convert text to smilies.
			$msg = smiles($msg);

			// Show date, Yes or No.
			if ($showdate == "1") {
				$title = "title=\"Posted ".$day."/".$month."/".$year." ".$time."\"";
			} else {
				$title = "";
			}
			
				$x++;
				if ( $x % 2 != 0 ) {
					echo "<tr><td ".$title." class=\"phpshout_posts\"><strong>".wordwrap($name,18,"<br>\n",1)." : </strong>".ereg_replace("([^ \/]{22})","\\1<wbr>",$msg)."</td></tr>";
				} else {
					echo "<tr><td ".$title." class=\"phpshout_2nd_posts\"><strong>".wordwrap($name,18,"<br>\n",1)." : </strong>".ereg_replace("([^ \/]{22})","\\1<wbr>",$msg)."</td></tr>";
				} 	
						
		} else {
		
		// stop loop
			break;
			
		}		
		
	}
	?>
	<tr>
	<td class="phpshout_posts">
	<?
	$totalPages = ceil(count($array) / $numPerPage);
	
	if ($page!=1) echo "<a class=\"phpshout_link\" href=".$_SERVER['PHP_SELF']."?page=".($page-1).">Previous</a> ";
	for ($i=1; $i<=$totalPages; $i++) {
    
    echo ($i==$page) ? $page.' ' : "<a class=\"phpshout_link\" href=".$_SERVER['PHP_SELF']."?page=".$i.">".$i."</a> ";
    
	}
	if ($page!=$totalPages) echo "<a class=\"phpshout_link\" href=".$_SERVER['PHP_SELF']."?page=".($page+1).">Next</a>";

	fclose($handle);
	?>
	</td>
	</tr>
	</table>
</body>
</html>