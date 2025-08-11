<div class=tacnav>
<?
reset($TASKS);
while(list($ide,$pl)=each($TASKS))
{
	switch($EVENEMENTS[$ide]["type"])
	{
	case "taskb": case "task":
?>
<a class=p<? echo $EVENEMENTS[$ide]["priorite"]; ?> href="#" onClick="go('?<? echo "ts=".date_db2ts($EVENEMENTS[$ide]["fin"]); ?>')">
<img src="img/le-<? echo $EVENEMENTS[$ide]["type"]; ?>.gif"> <u><? echo date_db2fr($EVENEMENTS[$ide]["fin"]); ?></u> <? if($EVENEMENTS[$ide]["estheure"]) echo "<u>".heure_db2fr($EVENEMENTS[$ide]["heure"])."</u> "; ?><? echo $EVENEMENTS[$ide]["titre"]; ?>
</a><br>
<?
	break;
	case "taska": case "taskp":
?>
<a class=p<? echo $EVENEMENTS[$ide]["priorite"]; ?> href="#" onClick="go('?<? echo "ts=".date_db2ts($EVENEMENTS[$ide]["debut"]); ?>')">
<img src="img/le-<? echo $EVENEMENTS[$ide]["type"]; ?>.gif"> <? if($EVENEMENTS[$ide]["estheure"]) echo "<u>".heure_db2fr($EVENEMENTS[$ide]["heure"])."</u> "; ?><? echo $EVENEMENTS[$ide]["titre"]; ?>
</a><br>
<?
	break;
	}
}
?>
</div>
