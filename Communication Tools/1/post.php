<?php
header("Location: " . $_REQUEST['postFrom']);
require("dbInfo.php");

function convertSpecialChars($data){
	$data = ereg_replace("&", "&amp;", $data);
	$data = ereg_replace("<", "&lt;", $data);
	$data = ereg_replace(">", "&gt;", $data);
	$data = ereg_replace("\n", " <br /> ", $data);
	$data = ereg_replace('\\\"', "&quot;", $data);
	$data = ereg_replace("\\\'", "&#039;", $data);
	return $data;
}

$sql="SELECT * FROM Banned where ipAddr = '" . $_SERVER['REMOTE_ADDR'] . "'";
$rs=odbc_exec($conn,$sql);

if(!$rs) {
exit("Error in SQL");
}

if(!odbc_fetch_row($rs))
{
require("dbReq.php");
$maxPostsPerDay = odbc_result($rs, "maxPostsPerDay");

	if($maxPostsPerDay != 0){
		$sql="SELECT * FROM Comment where ipAddress = '" . $_SERVER['REMOTE_ADDR'] . "'";
		$rs=odbc_exec($conn,$sql);
		$count = obdc_Count($conn, $sql);	
	}
	else{ $count = 0; }
	
	if($maxPostsPerDay > $count || $count == 0){
		$author = convertSpecialChars($_POST['author']);
		$email = convertSpecialChars($_POST['email']);
		$url = convertSpecialChars($_POST['url']);
		$comment = convertSpecialChars($_POST['comment']);
		
		$today = getdate();

		if(strlen(trim($author)) != 0  && strlen(trim($email)) != 0 && strlen(trim($comment)) != 0){
		$sql = "INSERT INTO Comment(pid, author, website, email, comment, dateAdded, ipAddress) " .
		"VALUES('" . $_POST['pid'] . "','" . $author . "','" . $url . "','" . $email . "','" . 		$comment . "','" . $today[0] . "','" . $_SERVER['REMOTE_ADDR'] . "')";

		$rs=odbc_exec($conn,$sql);
		//obdc_close($conn);
		}
	}
}
?>