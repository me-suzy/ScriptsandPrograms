<?php 
$encrypted = md5("$unencrypted"); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Your origional text: <?php echo "$unencrypted"; ?></p>
<p>Your md5 hashed text: <?php echo "$encrypted"; ?></p>
<br>
<br>
<a href="http://www.razore.co.uk">Powered by MD5 Hasher</a>
</body>
</html>