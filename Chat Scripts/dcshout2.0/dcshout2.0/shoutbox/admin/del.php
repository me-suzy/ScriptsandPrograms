<?php
//Dc-shout2.0 (c)devilcoderz 2004
include "header.php";
include "config.php";
include "functions.php";
if (!session_is_registered(username)) {
echo "Your not loged in!" ;
}
else
{
if ($_GET[shout])
{
$sql = "DELETE FROM dc_shoutbox WHERE id='$_GET[shout]'"or die ('No Such Shout!');
$result = mysql_query($sql);
echo "Shout deleted!" ;
}
else
{
echo"
No shout Deleted";
}
}
include "footer.php";
?>




