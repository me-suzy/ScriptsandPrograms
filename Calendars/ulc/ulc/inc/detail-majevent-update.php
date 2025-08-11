<form action="form.php?e=<? echo $CALPARAMS["ide"];  ?>&ts=<? echo $CALPARAMS["date"]["ts"]; ?>" method=post>
<table class=f>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.type"]; ?>
</td><td class=d>
<select name=type size=1 onChange="this.form.submit()">
<? write_options_select($EVENEMENTS[$CALPARAMS["ide"]]["type"],$TYPES); ?>
</select>
<? echo $CALANGUAGE["formevent.priority"]; ?> 
<select name=priorite size=1>
<?
$priorites=array();
$priorites["low"] = $CALANGUAGE["priority.low"];
$priorites["normal"] = $CALANGUAGE["priority.normal"];
$priorites["high"] = $CALANGUAGE["priority.high"];
write_options_select($EVENEMENTS[$CALPARAMS["ide"]]["priorite"],$priorites);
?>
</select>
<?
if( isset($CALANGUAGE["event.{$EVENEMENTS[$CALPARAMS["ide"]]["etat"]}.alert"]) ) echo "<b>".$CALANGUAGE["event.{$EVENEMENTS[$CALPARAMS["ide"]]["etat"]}.alert"]."</b>";
if($EVENEMENTS[$CALPARAMS["ide"]]["etat"]=="postponed"||$EVENEMENTS[$CALPARAMS["ide"]]["etat"]=="preponed")
{
	$query="select * from evenement where idep=$CALPARAMS[ide] and source='moved'";
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
		$ide=$evenement["ide"];
?> 
<a href="#" onClick="go('?<? echo "e=$ide&ts=$ts"; ?>')"><? echo strftime($CALANGUAGE["strftime.prefered"],$ts); ?>&nbsp;&gt;&gt;</a><br> 
<?
	}
}
?>
</td></tr>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.title"]; ?>*</b>
</td><td class=d>
<input name=titre maxlength=64 size=32 value="<? echo $EVENEMENTS[$CALPARAMS["ide"]]["titre"]; ?>">
</td></tr>
<?
switch($EVENEMENTS[$CALPARAMS["ide"]]["type"])
{
case "default":
?>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.date"]; ?>*</b>
</td><td class=d>
<input id=debut name=debut maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<?
break;
case "period":
?>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.period"]; ?>*</b>
</td><td class=d>
<input id=debut name=debut maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>"><input id=fin name=fin maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<?
break;
case "taskp":
?>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.period"]; ?>*</b>
</td><td class=d>
<input id=debut name=debut maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>"><input id=fin name=fin maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<?
break;
case "task":
?>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.date"]; ?>*</b>
</td><td class=d>
<input id=fin name=fin maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<?
break;
case "taskb":
?>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.before"]; ?>*</b>
</td><td class=d>
<input id=fin name=fin maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<?
break;
case "taska":
?>
<tr><td class=g>
<b><? echo $CALANGUAGE["formevent.after"]; ?>*</b>
</td><td class=d>
<input id=debut name=debut maxlength=10 size=10 value="<? echo date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]); ?>"> <i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<?
break;
}
?>
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
<tr><td class=g>
<? echo $CALANGUAGE["formevent.comment"]; ?>
</td><td class=d>
<textarea name=commentaire cols=50 rows=5 wrap=virtual>
<?
$tmp=$EVENEMENTS[$CALPARAMS["ide"]]["commentaire"];
$tmp=str_replace("&","&#38;",$tmp);
$tmp=str_replace("<","&lt;",$tmp);
echo "$tmp";
?>
</textarea>
</td></tr>
<tr><td>
</td><td class=d>
<input type=submit name=save value="<? echo $CALANGUAGE["formevent.save"]; ?>"<?
if($EVENEMENTS[$CALPARAMS["ide"]]["etat"]&&$EVENEMENTS[$CALPARAMS["ide"]]["etat"]!="confirmed")
	echo "onClick=\"return confirm('".$CALANGUAGE["formevent.poned.confirm"]."')\"";
?>>
<?
if($EVENEMENTS[$CALPARAMS["ide"]]["etat"]=="")
{
?>
<input type=submit name=confirm value="<? echo $CALANGUAGE["formevent.confirm"]; ?>">
<?
}
?>
<i>(*<? echo $CALANGUAGE["formevent.star.text"]; ?>)</i>
</td></tr>
</table>
</form>
