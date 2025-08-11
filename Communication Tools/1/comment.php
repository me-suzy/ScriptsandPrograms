<html>
<head>
    <link rel="stylesheet"
          type="text/css"
          href="clean.css">

<script type="text/javascript">
function validate_form(theForm){

if (theForm.author.value.length<4){
	alert("Name must be 4 characters or longer.");
	return false;
}

if (theForm.email.value.length<6){
	alert("Email address is invalid.");
	return false;
}

if (theForm.comment.value.length<10){
	alert("Message must contain at least 10 characters.");
	return false;
}

return true;
}
</script>
</head>
<body>
<div class="container">
<?php

require("dbInfo.php");

if (!$conn)
{
exit("Connection Failed: " . $conn); 
}

require("dbReq.php");

$pidIdent = odbc_result($rs, "pidIdentifier");
$smileyEnabled = odbc_result($rs, "allowSmiley");
$formattingEnabled = odbc_result($rs, "allowFormatting");
$urlDisplay = odbc_result($rs, "translateUrl");
$pid = $_GET[$pidIdent];
 
$sql="SELECT * FROM Comment where pid = '" . $pid . "' ORDER BY DateAdded DESC"; 

$rs=odbc_exec($conn,$sql); 
if (!$rs)
{ 
exit("Error in SQL");
} 

$bgswitch = 'dark';
$count = odbc_Count($conn, $sql);
echo "<p class='header'>$count Comments <a href='#post'>>></a></p>";

while (odbc_fetch_row($rs))
{

$author = odbc_result($rs, "author");
$website = odbc_result($rs, "website");
$comment = odbc_result($rs, "comment");

if($urlDisplay == 1){
$comment = split(" ", $comment); $i = 0;
	while($i < sizeof($comment)){
		if(substr(strtolower($comment[$i]), 0, 7) == "http://"){
			$comment[$i] = "<a href='" . $comment[$i] . "' target='new'>" . $comment[$i] . "</a>";
		}
		$i++;
	}
$comment = implode(" ", $comment);
}

$imgTagl = " <img src='";
$imgTagr = "width='15' height='15'>";

/* Smiley replace */
if($smileyEnabled == 1){
	$comment = ereg_replace(' :)', $imgTagl . $imgDir . "smile.png' alt='smile'" . $imgTagr, $comment);
	$comment = ereg_replace(' =)', $imgTagl . $imgDir . "smile.png' alt='smile'" . $imgTagr, $comment);
	$comment = ereg_replace(' :\|', $imgTagl . $imgDir . "neutral.png' alt='neutral'" . $imgTagr, $comment);
	$comment = ereg_replace(' =\|', $imgTagl . $imgDir . "neutral.png' alt='neutral'" . $imgTagr, $comment);
	$comment = ereg_replace(' :\(', $imgTagl . $imgDir . "sad.png' alt='sad'" . $imgTagr, $comment);
	$comment = ereg_replace(' =\(', $imgTagl . $imgDir . "sad.png' alt='sad'" . $imgTagr, $comment);
	$comment = ereg_replace(' :D', $imgTagl . $imgDir . "big_smile.png' alt='big smile'" . $imgTagr, $comment);
	$comment = ereg_replace(' =D', $imgTagl . $imgDir . "big_smile.png' alt='big smile'" . $imgTagr, $comment);
	$comment = ereg_replace(' :o', $imgTagl . $imgDir . "yikes.png' alt='yikes'" . $imgTagr, $comment);
	$comment = ereg_replace(' =O', $imgTagl . $imgDir . "yikes.png' alt='yikes'" . $imgTagr, $comment);
	$comment = ereg_replace(' \;)', $imgTagl . $imgDir . "wink.png' alt='wink'" . $imgTagr, $comment);
	$comment = ereg_replace(' :/', $imgTagl . $imgDir . "hmm.png' alt='hmm'" . $imgTagr, $comment);
	$comment = ereg_replace(' =/', $imgTagl . $imgDir . "hmm.png' alt='hmm'" . $imgTagr, $comment);
	$comment = ereg_replace(' :P', $imgTagl . $imgDir . "tongue.png' alt='tongue'" . $imgTagr, $comment);
	$comment = ereg_replace(' =P', $imgTagl . $imgDir . "tongue.png' alt='tongue'" . $imgTagr, $comment);
	$comment = ereg_replace(':lol:', $imgTagl . $imgDir . "lol.png' alt='lol'" . $imgTagr, $comment);
	$comment = ereg_replace(':mad:', $imgTagl . $imgDir . "mad.png' alt='mad'" . $imgTagr, $comment);
	$comment = ereg_replace(':rolleyes:', $imgTagl . $imgDir . "roll.png' alt='rolleyes'" . $imgTagr, $comment);
	$comment = ereg_replace(':cool:', $imgTagl . $imgDir . "cool.png' alt='cool'" . $imgTagr, $comment);
}

if($formattingEnabled == 1){
	$comment = ereg_replace('\[b\]', '<b>', $comment);
	$comment = ereg_replace('\[/b\]', '</b>', $comment);
	$comment = ereg_replace('\[i\]', '<i>', $comment);
	$comment = ereg_replace('\[/i\]', '</i>', $comment);
	$comment = ereg_replace('\[u\]', '<u>', $comment);
	$comment = ereg_replace('\[/u\]', '</u>', $comment);
}

$dateAdded = odbc_result($rs, "dateAdded");

echo "<div class='$bgswitch'><table>";
echo "<tr><th class='author'>";

if($website != "")
{
echo "<a href='$website' target='new'>$author</a> Said,</th></tr>";
}
else
{
echo "$author Said,</th></tr>";
}
$fDate = strftime('%B %d, %y @ %I:%M %p' , $dateAdded); 
echo "<tr><th class='date'>$fDate</th></tr>";
echo "<tr><td class='comment'>$comment</td></tr></table></div>";

if($bgswitch == 'light'){ $bgswitch = 'dark';} else{ $bgswitch = 'light'; }
}
odbc_close($conn);

?>
<p class="poweredby">Powered by <a href="http://www.programming-designs.com" title="Programming Designs PHP Script">Programming Designs phpComment <?php echo $version ?></a></p>

<p class="header"><a name="post"></a>Leave a Comment</p>

<form method="post" onsubmit="return validate_form(this)" action="post.php?postFrom=<?php echo $_SERVER['PATH_INFO'] . '?' . $_SERVER['QUERY_STRING']; ?>">
<div id="response"><p class="desc">
<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="text" name="author" size="30" maxlength="30"> Name (required)<br /> <br />
<input type="text" name="email" size="30" maxlength="50"> E-mail (required, never displayed)<br /> <br />
<input type="text" name="url" size="30" maxlength="50"> Website URI (optional)<br /> <br />
<textarea name="comment" rows="7" cols="60"></textarea><br /> <br />
<input type="submit" value="Submit Comment">
</p></div>
</form>
</div>

</body>
</html>