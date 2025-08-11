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
if ($submit)
{
$sql ="UPDATE dc_setings SET  shout='$box', bbcode='$bbcode', word='$word' WHERE id='1'";
$result = mysql_query($sql) or die(mysql_error());
echo "updated shoutbox setings";

}
else
{
?>
<form method="POST" action="options.php">
<b>Shoutbox(On/Off) :</b><select size="1" name="box">
<option selected value="y">On</option>
<option value="n">Off</option>
</select>
<br><br>
<b>BB Code(On/Off) :</b><select size="1" name="bbcode">
<option selected value="y">On</option>
<option value="n">Off</option>
</select>
<br>
<b>Worf filter(On/Off) :</b><select size="1" name="word">
<option selected value="y">On</option>
<option value="n">Off</option>
</select>
<br>
<input type="submit" value="Update" name="submit">
</form>
<?
}
}
include "footer.php";
?>









