<form action="form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=move" method=post>
<table class=f>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.type"]; ?>
</td><td class=d>
<? echo $TYPES[$EVENEMENTS[$CALPARAMS["ide"]]["type"]]; ?> 
<?
if($EVENEMENTS[$CALPARAMS["ide"]]["idep"]&&$EVENEMENTS[$CALPARAMS["ide"]]["source"]=="moved")
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
?>
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.priority"]; ?>
</td><td class=d>
<? echo $CALANGUAGE["priority.".$EVENEMENTS[$CALPARAMS["ide"]]["priorite"]]; ?>
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
<b><? echo $CALANGUAGE["formevent.tab.move.explain"]; ?></b>
</td></tr>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.move"]; ?>*</b>
</td><td class=d>
<input id=debut name=date maxlength=10 size=10 value="<? echo $date; ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.hour"]; ?>
</td><td class=d>
<input id=heure name=heure maxlength=5 size=5 value="<? echo heure_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["heure"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.hourformat"]; ?>)</i> <input name=estheure type=checkbox value="oui"<? if($EVENEMENTS[$CALPARAMS["ide"]]["estheure"]) echo " checked"; ?>> <i>(<? echo $CALANGUAGE["formevent.ishour"]; ?>)</i>
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.duration"]; ?>
</td><td class=d>
<input id=duree name=duree maxlength=5 size=5 value="<? echo $EVENEMENTS[$CALPARAMS["ide"]]["duree"]; ?>"> <i>(<? echo $CALANGUAGE["formevent.durationformat"]; ?>)</i>
</td></tr>
<tr><td>
</td><td class=d>
<input type=submit name=move value="<? echo $CALANGUAGE["formevent.move"]; ?>">
<input type=submit name=cancel value="<? echo $CALANGUAGE["formevent.cancel"]; ?>" onClick="return confirm('<? echo ereg_replace("[']","\\'",$CALANGUAGE["formevent.cancel.confirm"]) ?>')">
<input type=submit name=delete value="<? echo $CALANGUAGE["formevent.delete"]; ?>" onClick="return confirm('<? echo ereg_replace("[']","\\'",$CALANGUAGE["formevent.delete.confirm"]) ?>')"> 
<i>(*<? echo $CALANGUAGE["formevent.star.text"]; ?>)</i>
</td></tr>
</table>
</form>
