<div class=maj> 

<table class=c>
<tr class=p>
<?
if($EVENEMENTS[$CALPARAMS["ide"]]["etat"]==""||$EVENEMENTS[$CALPARAMS["ide"]]["etat"]=="confirmed")
	$tabs=array("update","move","repeat","invite","publish");
else
	$tabs=array("update","publish");
reset($tabs);
while(list($rien,$tab)=each($tabs))
{
?><td class=<? if($tab==$CALPARAMS["tab"]) echo "s"; else echo "n"; ?>></td><?
}
?>
<td class=l></td>
</tr>
<tr class=t>
<?
$ts=$CALPARAMS["date"]["ts"];
reset($tabs);
while(list($rien,$tab)=each($tabs))
{
?><td<? if(isset($CALANGUAGE["formevent.tab.$tab.text"])) echo " title=\"{$CALANGUAGE["formevent.tab.$tab.text"]}\""; ?> class=<? if($tab==$CALPARAMS["tab"]) echo "s"; else echo "n"; ?> onClick="go('?<? echo "e=$CALPARAMS[ide]&ts=$ts&tab=$tab"; ?>')"><? echo $CALANGUAGE["formevent.tab.$tab"]; ?></td><?
}
?>
<td class=l></td>
</tr>
<tr>
<td class=f colspan=<? echo (count($tabs)+1) ?>>

<? include("inc/detail-majevent-$CALPARAMS[tab].php"); ?>

</td>
</tr>
</table>

