<form action="form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=repeat" method=post>
<table class=f2>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.type"]; ?>
</td><td class=d>
<? echo $TYPES[$EVENEMENTS[$CALPARAMS["ide"]]["type"]]; ?> 

</td>
<td class=l rowspan=9>
<?
if($EVENEMENTS[$CALPARAMS["ide"]]["idep"]&&$EVENEMENTS[$CALPARAMS["ide"]]["source"]=="repeated")
{
	$query="select * from evenement where ide={$EVENEMENTS[$CALPARAMS["ide"]]["idep"]}";
	$results=mysql_query($query,$mysql_link);
	$evenement=mysql_fetch_assoc($results);
	mysql_free_result($results);
	if($evenement)
	{
		switch($evenement["type"])
		{
		case "default": case "period": case "taska": case "taskp":
			$ts=date_db2ts($evenement["debut"]);
		break;
		default:
			$ts=date_db2ts($evenement["fin"]);
		}
		$ide=$EVENEMENTS[$CALPARAMS["ide"]]["idep"];
?>
<a href="#" onClick="go('?<? echo "e=$ide&ts=$ts"; ?>')">&lt;&lt;&nbsp;<? echo strftime($CALANGUAGE["strftime.prefered"],$ts); ?></a><br> 
<?
	}
}
$evts=array();
$query="select * from evenement where idep=$CALPARAMS[ide] and source='repeated'";
$results=mysql_query($query,$mysql_link);
while($evenement=mysql_fetch_assoc($results))
	switch($evenement["type"])
	{
	case "default": case "period": case "taska": case "taskp":
		$evts[$evenement["ide"]]=date_db2ts($evenement["debut"]);
	break;
	default:
		$evts[$evenement["ide"]]=date_db2ts($evenement["fin"]);
	}
mysql_free_result($results);
asort($evts);
reset($evts);
while(list($ide,$ts)=each($evts))
{
?>
<a href="#" onClick="go('?<? echo "e=$ide&ts=$ts"; ?>')"><? echo strftime($CALANGUAGE["strftime.prefered"],$ts); ?>&nbsp;&gt;&gt;</a><br> 
<?
}
?>
</td>
</tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.priority"]; ?>
</td><td class=d>
<? echo $CALANGUAGE["priority.".$EVENEMENTS[$CALPARAMS["ide"]]["priorite"]]; ?>
<?
if( isset($CALANGUAGE["event.{$EVENEMENTS[$CALPARAMS["ide"]]["etat"]}.alert"]) ) echo "<b>".$CALANGUAGE["event.{$EVENEMENTS[$CALPARAMS["ide"]]["etat"]}.alert"]."</b>";
?>
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.title"]; ?>
</td><td class=d>
<b><? echo $EVENEMENTS[$CALPARAMS["ide"]]["titre"]; ?></b>
</td></tr>
<?
$date="";
switch($EVENEMENTS[$CALPARAMS["ide"]]["type"])
{
case "default":
?>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.date"]; ?>
</td><td class=d>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>
</td></tr>
<?
break;
case "period":
?>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.period"]; ?>
</td><td class=d>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?> - <? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
</td></tr>
<?
break;
case "taskp":
?>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.period"]; ?>
</td><td class=d>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?> - <? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
</td></tr>
<?
break;
case "task":
?>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.date"]; ?>
</td><td class=d>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
</td></tr>
<?
break;
case "taskb":
?>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.before"]; ?>
</td><td class=d>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>
</td></tr>
<?
break;
case "taska":
?>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.after"]; ?>
</td><td class=d>
<? echo $date=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>
</td></tr>
<?
break;
}
?>
<tr><td>
</td><td class=d>
<b><? echo $CALANGUAGE["formevent.tab.repeat.explain"]; ?></b>
</td></tr>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.first"]; ?>*</b>
</td><td class=d>
<input id=debut name=date maxlength=10 size=10 value="<? echo $date; ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.number"]; ?>*</b>
</td><td class=d>
<input id=occurrence name=occurrence maxlength=5 size=5 value="1"> <i>(<? echo $CALANGUAGE["formevent.repeatunit"]; ?>)</i>
</td></tr>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.interval"]; ?>*</b>
</td><td class=d>
<input id=interval name=interval maxlength=5 size=5 value="1">
<select name=unit size=1>
<?
$intervales=array();
$intervales["day"]=$CALANGUAGE["formevent.intervalunit.day"];
$intervales["week"]=$CALANGUAGE["formevent.intervalunit.week"];
$intervales["month"]=$CALANGUAGE["formevent.intervalunit.month"];
$intervales["year"]=$CALANGUAGE["formevent.intervalunit.year"];
write_options_select("week",$intervales);
?>
</select>
</td></tr>
<tr><td>
</td><td class=d>
<input type=submit name=repeat value="<? echo $CALANGUAGE["formevent.repeat"]; ?>"> 
<i>(*<? echo $CALANGUAGE["formevent.star.text"]; ?>)</i>
</td></tr>
</table>
</form>
