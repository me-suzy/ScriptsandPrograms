
<table class=f>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.title"]; ?>
</td><td class=d>
<b><? echo $EVENEMENTS[$CALPARAMS["ide"]]["titre"]; ?></b>
<?
$date="";
switch($EVENEMENTS[$CALPARAMS["ide"]]["type"])
{
case "default":
?>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>
<?
break;
case "period":
?>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?> - <? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
<?
break;
case "taskp":
?>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?> - <? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
<?
break;
case "task":
?>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
<?
break;
case "taskb":
?>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
<?
break;
case "taska":
?>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>
<?
break;
}
?>
</td></tr>
<tr><td class=g>
</td><td class=d>
<b><? echo $CALANGUAGE["formevent.tab.publish.explain"]; ?></b>
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.publish"]; ?>
</td><td class=d colspan=2>
<form action="form.php">
<input type=hidden name=tab value="publish">
<input type=hidden name=action value="addpublish">
<input type=hidden name=e value="<? echo $CALPARAMS["ide"]; ?>">
<select name=pidc size=1>
<?
$opcal=array();

reset($CALENDRIERS);
while(list($idc,$calendrier)=each($CALENDRIERS))
{
	if($calendrier['droit']=='write')
	{
		$opcal[$calendrier['idc']]="";
		if($calendrier['login']!=$_SESSION['compte']['login'])
			$opcal[$calendrier['idc']]="$calendrier[login] - ";
		$opcal[$calendrier['idc']].="$calendrier[nom]";
		if($calendrier["type"]=='protected') $opcal[$calendrier['idc']].=" - $calendrier[groupe]";
		else if($calendrier["type"]!='private') $opcal[$calendrier['idc']].=" - {$CALANGUAGE["ctype.$calendrier[type]"]}";
		
	}
}
write_options_select("",$opcal);
?>
</select> <input type=submit value="+">
</form>
</td></tr>
<tr>
<td></td>
<td class=u>
<b><? echo $CALANGUAGE["formevent.calendar.header"]; ?></b>
</td>
</tr>
<tr>
<td></td>
<td class=u>
<?
$query="select * from occurence where ide=$CALPARAMS[ide]";
$results=mysql_query($query,$mysql_link);
while($occ=mysql_fetch_assoc($results))
{
?>
<input class=l type=button title="<? echo $CALANGUAGE["formevent.delpublish.confirm"]; ?>" onClick="goc('form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=publish&action=delpublish&pidc=<? echo $occ["idc"]; ?>','<? echo $CALANGUAGE["formevent.delpublish.confirm"]; ?>')" value="-"> <?
$calendrier=$CALENDRIERS[$occ["idc"]];
$buffer="";
if($calendrier['login']!=$_SESSION['compte']['login'])
	$buffer="$calendrier[login] - ";
$buffer.="$calendrier[nom]";
if($calendrier["type"]=='protected') $buffer.=" - $calendrier[groupe]";
else if($calendrier["type"]!='private') $buffer.=" - {$CALANGUAGE["ctype.$calendrier[type]"]}";
echo $buffer;
?><br>
<?
}
mysql_free_result($results);
?>
</td>
</tr>
</table>

