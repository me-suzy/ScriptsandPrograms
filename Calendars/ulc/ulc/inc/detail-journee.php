<?

$m=$CALPARAMS["date"]["m"];
$d=$CALPARAMS["date"]["d"];
$y=$CALPARAMS["date"]["y"];

if(isset($_SESSION["compte"]))
{
?><div class=nouveau><a href="#" onClick="go('?<? echo "new=1&ts=".$CALPARAMS["date"]["ts"]; ?>')"><img src="img/new.gif"> <? echo $CALANGUAGE["dayevent.new"] ; ?> &gt;&gt;</div><?
}
?>
<?
if(isset($PLANNING[$m][$d]))
{
	reset($PLANNING[$m][$d]);
	while(list($ide,$heure)=each($PLANNING[$m][$d]))
	{
?>
<div class=detailjournee>
<a class=p<? echo $EVENEMENTS[$ide]["priorite"]; ?>_e<? echo $EVENEMENTS[$ide]["etat"]; ?><? if(isset($CALANGUAGE["event.priority.".$EVENEMENTS[$ide]["priorite"]])) echo " title=\"".$CALANGUAGE["event.priority.".$EVENEMENTS[$ide]["priorite"]]."\""; ?> href="#" onClick="go('?<? echo "e=$ide&ts=".$CALPARAMS["date"]["ts"]; ?>')"><img src="img/event-<? echo $EVENEMENTS[$ide]["type"]; ?>.gif"> <? if($EVENEMENTS[$ide]["estheure"]) echo "<u>".heure_db2fr($EVENEMENTS[$ide]["heure"])."</u> "; ?><? echo $EVENEMENTS[$ide]["titre"]; ?> 
<? if($EVENEMENTS[$ide]["duree"]>0) printf("<b>%dh%02dmin</b>",$EVENEMENTS[$ide]["duree"]/60,$EVENEMENTS[$ide]["duree"]%60); ?>
<? if(isset($EVENEMENTS[$ide]["invitation"])&&$EVENEMENTS[$ide]["invitation"]) echo " <i>Invitation</i>"; ?> 
<? if((!isset($_SESSION["compte"]))||(isset($_SESSION["compte"])&&$_SESSION["compte"]["login"]!=$EVENEMENTS[$ide]["createur"])) echo "<i>{$EVENEMENTS[$ide]["nom"]} ({$EVENEMENTS[$ide]["login"]})</i>"; ?>
<?
switch($EVENEMENTS[$ide]["type"])
{
case "period":
	echo "<div class=p>".$CALANGUAGE["dayevent.period"]." : ".strftime($CALANGUAGE["strftime.prefered"],date_db2ts($EVENEMENTS[$ide]["debut"]))." - ".strftime($CALANGUAGE["strftime.prefered"],date_db2ts($EVENEMENTS[$ide]["fin"]))."</div>";
break;
}
?>
<?
if($EVENEMENTS[$ide]["commentaire"])
{
?><div class=c><?
$tmp=$EVENEMENTS[$ide]["commentaire"];
$tmp=str_replace("&","&#38;",$tmp);
$tmp=str_replace("<","&lt;",$tmp);
echo $tmp;
?></div>

<?
}



?>
</a><?
if( isset($CALANGUAGE["event.{$EVENEMENTS[$ide]["etat"]}.alert"]) ) {
?>
<div class=a>
<? echo $CALANGUAGE["event.{$EVENEMENTS[$ide]["etat"]}.alert"]; ?>
<? if($EVENEMENTS[$ide]["etat"]=="postponed"||$EVENEMENTS[$ide]["etat"]=="preponed") {
	$query="select * from evenement where idep=$ide and source='moved'";
	$result2=mysql_query($query,$mysql_link);
	$evenement=mysql_fetch_assoc($result2);
	mysql_free_result($result2);
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
?>
<a href="#" onClick="go('?<? echo "ts=$ts"; ?>')"> &gt;&gt; <? echo strftime($CALANGUAGE["strftime.prefered"],$ts); ?></a>
<?
	}


}
?>
</div>
<?
	}
	if(isset($CALPARAMS["iide"])&&$CALPARAMS["iide"]==$ide)
{
?>
<form action="form.php?e=<? echo $CALPARAMS["iide"]; ?>" method=post>
<div class=p>
<? echo $CALANGUAGE["invite.answer"]; ?> 
<select name=reponse size=1>
<?
$oprep=array();
$oprep['']='';
$oprep['ok']=$CALANGUAGE["invite.reply.ok"];
$oprep['ko']=$CALANGUAGE["invite.reply.ko"];
$oprep['oko']=$CALANGUAGE["invite.reply.oko"];
write_options_select($EVENEMENTS[$ide]["reponse"],$oprep);
?>
</select>
<input type=text name=commentaire value="<? echo $EVENEMENTS[$ide]["icom"]; ?>">
<input type=submit name=reply value="<? echo $CALANGUAGE["invite.reply"]; ?>">
</div>
</form>
<?
}
	
?><hr>
</div>
<?
	}

}
?>
