<?
reset($TYPES);
while(list($type,$nom)=each($TYPES))
{
?>
<div class=choix><a href="#" onClick="go('?<? echo "new=$type&ts=".$CALPARAMS["date"]["ts"]; ?>')"><img src="img/event-<? echo $type; ?>.gif"> <? echo $CALANGUAGE["dayevent.new$type"]; ?> &gt;&gt;</a>
<? if(isset($CALANGUAGE["dayevent.new$type.text"])){ ?>
<div>
<? echo $CALANGUAGE["dayevent.new$type.text"]; ?>
</div>
<? } ?>
</div>
<?
}
?>
