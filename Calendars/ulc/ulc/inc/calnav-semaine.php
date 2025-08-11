<table class=calnavsemaine>
<tr class=w>
<?
for($ts=$CALPARAMS["date"]["semaine"]["debut"]+ONEDAY/2,$w=0;$w<7;$ts+=ONEDAY,$w++)
{
	$d=date("d",$ts);
	$m=date("m",$ts);
	$y=date("Y",$ts);
?>
<td<? if($w==$CALPARAMS["date"]["w"]) echo " class=s"; ?> onClick="go('?<? echo "ts=$ts"; ?>')"><b><? echo strftime("%A",$ts); ?></b><br><span<? if($CALPARAMS["now"]["y"]==$y&&$CALPARAMS["now"]["m"]==$m&&$CALPARAMS["now"]["d"]==$d) echo " class=s"; ?>><? echo strftime("%d %b",$ts); ?></span></td>
<?
	
}
?>
</tr>
<tr class=d>
<?
for($ts=$CALPARAMS["date"]["semaine"]["debut"]+ONEDAY/2,$w=0;$w<7;$ts+=ONEDAY,$w++)
{
	$d=date("d",$ts);
	$m=date("m",$ts);
	$y=date("Y",$ts);
?>
<td>
<?
if(isset($PLANNING[$m][$d]))
{
	reset($PLANNING[$m][$d]);
	while(list($ide,$heure)=each($PLANNING[$m][$d]))
	{
?>
<a class=p<? echo $EVENEMENTS[$ide]["priorite"]; ?>_e<? echo $EVENEMENTS[$ide]["etat"]; ?> href="#" onClick="go('?<? echo "e=$ide&ts=".mktime(12,0,0,$m,$d,$y); ?>')"><img src="img/le-<? echo $EVENEMENTS[$ide]["type"]; ?>.gif"> <? if($EVENEMENTS[$ide]["estheure"]) echo "<u>".heure_db2fr($EVENEMENTS[$ide]["heure"])."</u> "; ?><? echo $EVENEMENTS[$ide]["titre"]; ?></a><br>
<?
	}
}
?>
</td>
<?
}
?>
</tr>
</table>
