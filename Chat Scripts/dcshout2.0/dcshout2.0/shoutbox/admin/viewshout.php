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
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  height=\"1\">";
$result = mysql_query("select * from dc_shoutbox order by id desc ");
while($r=mysql_fetch_array($result))
{
echo"
<tr>
      <td width=\"443\" height=\"1\" >$r[name] - $r[text] - <a href=\"del.php?shout=$r[id]\">Delete</a></td>
</tr>
";
}
echo "</table>";
}
include "footer.php";
?>


