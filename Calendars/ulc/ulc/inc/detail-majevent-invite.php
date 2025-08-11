
<table class=f>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.title"]; ?>
</td><td class=d colspan=2>
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
</td><td class=d colspan=2>
<b><? echo $CALANGUAGE["formevent.tab.invite.explain"]; ?></b>
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.invite"]; ?>
</td><td class=d colspan=2>
<form>
<input type=hidden name=tab value="invite">
<input type=hidden name=e value="<? echo $CALPARAMS["ide"]; ?>">
<input name=critere size=10 value="<? if(isset($_GET["critere"])) echo $_GET["critere"]; ?>"> <input type=submit value="<? echo $CALANGUAGE["formevent.search"]; ?>"> <i>(<? echo $CALANGUAGE["formevent.searchformat"]; ?>)</i>
</form>
</td></tr>


<?
if(isset($_GET["critere"])&&strlen($_GET["critere"]=trim($_GET["critere"]))>1)
{
				
?>
<tr><td class=g>
</td><td>
<form action="form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=invite" method=post>
<select name=utilisateur size=1>
<?
	$query="select * from compte where login like '%".mysql_real_escape_string($_GET["critere"])."%' or nom like '%".mysql_real_escape_string($_GET["critere"])."%' order by nom";
	$comptes=array();
	$comptes[""]=$CALANGUAGE["formevent.search.user.header"];
	$results=mysql_query($query,$mysql_link);
	$n=0;
	while($compte=mysql_fetch_assoc($results))
	{
		$comptes[$choix=$compte["login"]]=$compte["nom"];
		$n++;
	}
	if($n!=1)$choix="";
	mysql_free_result($results);
	write_options_select($choix,$comptes);
?>
</select>

<input name=okutilisateur type=submit value="<? echo $CALANGUAGE["formevent.submit.user"]; ?>">
</form>
</td>
<td>
<form action="form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=invite" method=post>
<select name=groupe size=1>
<?
	$query="select distinct groupe from groupe where groupe like '%".mysql_real_escape_string($_GET["critere"])."%' order by groupe";
	$groupes=array();
	$groupes[""]=$CALANGUAGE["formevent.search.group.header"];
	$results=mysql_query($query,$mysql_link);
	$n=0;
	while($groupe=mysql_fetch_assoc($results))
	{
		$groupes[$choix=$groupe["groupe"]]=$groupe["groupe"];
		$n++;
	}
	if($n!=1)$choix="";
	mysql_free_result($results);
	write_options_select($choix,$groupes);
?>
</select>
<input name=okgroupe type=submit value="<? echo $CALANGUAGE["formevent.submit.group"]; ?>">
</form>
</td></tr>
<?
}
?>
<tr>
<td></td>
<td class=u>
<b><? echo $CALANGUAGE["formevent.user.header"]; ?></b>
</td>
<td class=u>
<b><? echo $CALANGUAGE["formevent.group.header"]; ?></b>
</td>
</tr>
<tr>
<td></td>
<td class=u>
<?
$query="select c.*, i.reponse, i.commentaire as icom from compte c, invitation i where i.ide = $CALPARAMS[ide] and c.login = i.qui and i.porte='user' order by nom";
$results=mysql_query($query,$mysql_link);
while($compte=mysql_fetch_assoc($results))
{
?>
<input class=l type=button title="<? echo $CALANGUAGE["formevent.delinvite.confirm"]; ?>" onClick="goc('form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=invite&supprimer=oui&porte=user&qui=<? echo $compte["login"]; ?>','<? echo $CALANGUAGE["formevent.delinvite.confirm"]; ?>')" value="-"> <? echo $compte["nom"]; ?> (<? echo $compte["login"]; ?>)
<?
if($compte["reponse"])
	echo "<span class=r$compte[reponse]>".$CALANGUAGE["invite.reply.short.$compte[reponse]"]."</span>";
if($compte["icom"])
	echo " <span class=rc>".$compte["icom"]."</span>";
?><br><?
}
mysql_free_result($results);
?>
</td>
<td class=u>
<?
$query="select qui from invitation where ide = $CALPARAMS[ide] and porte='group' order by qui";
$results=mysql_query($query,$mysql_link);
while($groupe=mysql_fetch_assoc($results))
{
?>
<input type=button title="<? echo $CALANGUAGE["formevent.delinvite.confirm"]; ?>" onClick="goc('form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=invite&supprimer=oui&porte=user&qui=<? echo $groupe["qui"]; ?>','<? echo $CALANGUAGE["formevent.delinvite.confirm"]; ?>')" value="-"> <? echo $groupe["qui"]; ?><br>
<?
}
mysql_free_result($results);
?>
</td>
</tr>
<? if(isset($CALPARAMS["iide"])) { ?>
<tr>
<td class=g><? echo $CALANGUAGE["invite.answer"]; ?> </td>
<td colspan=2>
<form action="form.php?e=<? echo $CALPARAMS["ide"]; ?>&tab=invite" method=post>
<select name=reponse size=1>
<?
$oprep=array();
$oprep['']='';
$oprep['ok']=$CALANGUAGE["invite.reply.ok"];
$oprep['ko']=$CALANGUAGE["invite.reply.ko"];
$oprep['oko']=$CALANGUAGE["invite.reply.oko"];
write_options_select($EVENEMENTS[$CALPARAMS["ide"]]["reponse"],$oprep);
?>
</select>
<input type=text name=commentaire value="<? echo $EVENEMENTS[$CALPARAMS["ide"]]["icom"]; ?>">
<input type=submit name=reply value="<? echo $CALANGUAGE["invite.reply"]; ?>">
</form>
</td>
</tr>
<? } ?>
</table>

