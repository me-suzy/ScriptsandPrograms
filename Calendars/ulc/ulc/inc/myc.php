<b><? echo $CALANGUAGE['cp.comment']; ?></b>
<table class=mycp>
<tr>
<td><a href="#" onClick="go('?myc&ctri=groupe')"><? echo $CALANGUAGE['cfield.groupe']; ?></a>
<? if($CALPARAMS['ctri']=='groupe') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=type')"><? echo $CALANGUAGE['cfield.type']; ?></a>
<? if($CALPARAMS['ctri']=='type') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=visibilite')"><? echo $CALANGUAGE['cfield.visibilite']; ?></a>
<? if($CALPARAMS['ctri']=='visibilite') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=nom')"><? echo $CALANGUAGE['cfield.nom']; ?></a>
<? if($CALPARAMS['ctri']=='nom') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td>[<a href="#" onClick="go('form.php?myc&ctri=<? echo $CALPARAMS['ctri']; ?>&action=new')"><? echo $CALANGUAGE['cp.nouveau']; ?></a>]</td>
</tr>
<?
$ctrip=array();
$ctrie=array();
reset($CALENDRIERS);
$i=0;
while(list($idc,$calendrier)=each($CALENDRIERS))
{
	$i++;
	if($calendrier['login']==$_SESSION['compte']['login'])
		$ctrip[$calendrier[$CALPARAMS['ctri']].$i]=$calendrier;
	else
		$ctrie[$calendrier[$CALPARAMS['ctri']].$i]=$calendrier;
}
ksort($ctrip);
ksort($ctrie);
reset($ctrip);
$i=0;
while(list($groupei,$calendrier)=each($ctrip))
{
	$i++;
?>
<tr class=l<? echo ($i%2); ?>>
<td><? echo $calendrier['groupe']; ?></td>
<td><? echo $CALANGUAGE["ctype.$calendrier[type]"]; ?></td>
<td><? echo $CALANGUAGE["cvisibility.$calendrier[visibilite]"]; ?></td>
<td><? echo $calendrier['nom']; ?></td>
<td>[<a href="#" onClick="go('?myc&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $calendrier["idc"]; ?>')"><? echo $CALANGUAGE['cp.detail']; ?></a>]</td>
</tr>
<?
}
?>
</table>
<?
if(isset($CALPARAMS["cidc"]))
{
?>
<br>
<form class=c action="form.php?myc&action=up&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>" method=post>
<table class=c>
<tr>
<td align=right>
<b><? echo $CALANGUAGE['cfield.groupe']; ?>*</b>
</td>
<td>
<select name=groupe>
<?
$opgroup=array();
$query="select * from groupe where login = '{$_SESSION["compte"]["login"]}'";
$results=mysql_query($query,$mysql_link);
$isgadmin=FALSE;
while($groupe=mysql_fetch_assoc($results))
{
	$opgroup[$groupe['groupe']]=$groupe['groupe'];
	if($groupe['type']=='admin')
	{
		$opgroup[$groupe['groupe']].="*";
		$isgadmin=TRUE;
	}
}
mysql_free_result($results);
ksort($opgroup);
write_options_select($CALENDRIERS[$CALPARAMS["cidc"]]["groupe"],$opgroup);
?>
</select>
</td>
</tr>
<tr>
<td align=right>
<b><? echo $CALANGUAGE['cfield.type']; ?>*</b>
</td>
<td>
<select name=type>
<?
$optype=array();
$optype['private']=$CALANGUAGE["ctype.private"];
$optype['protected']=$CALANGUAGE["ctype.protected"];
$optype['general']=$CALANGUAGE["ctype.general"];
$optype['public']=$CALANGUAGE["ctype.public"];
write_options_select($CALENDRIERS[$CALPARAMS["cidc"]]["type"],$optype);
?>
</select>
</td>
</tr>
<? if($_SESSION["compte"]["type"]=="admin"||$isgadmin) { ?>
<tr>
<td align=right>
<b><? echo $CALANGUAGE['cfield.visibilite']; ?>*</b>
</td>
<td>
<select name=visibilite>
<?
$opvis=array();
$opvis['local']=$CALANGUAGE["cvisibility.local"];
if(($CALENDRIERS[$CALPARAMS["cidc"]]["type"]!='general'&&$CALENDRIERS[$CALPARAMS["cidc"]]["type"]!='global')||$_SESSION["compte"]["type"]=="admin")
	$opvis['global']=$CALANGUAGE["cvisibility.global"];
write_options_select($CALENDRIERS[$CALPARAMS["cidc"]]["visibilite"],$opvis);
?>
</select>
</td>
</tr>
<? } ?>
<tr>
<td align=right>
<b><? echo $CALANGUAGE['cfield.nom']; ?>*</b>
</td>
<td>
<input name=nom maxlength=32 value="<? echo $CALENDRIERS[$CALPARAMS["cidc"]]["nom"]; ?>">
</td>
</tr>
<tr>
<td align=right><input type=reset value="<? echo $CALANGUAGE["myc.cancel"]; ?>"></td>
<td><input type=submit name="sauver" value="<? echo $CALANGUAGE["myc.save"]; ?>">
<input type=submit name="supprimer" value="<? echo $CALANGUAGE["myc.remove"]; ?>" onClick="return confirm('<? echo $CALANGUAGE["myc.remove.confirm"]; ?>')"></td>
</tr>
</table>
</form>

<form>
<? echo $CALANGUAGE["myc.rights.add.comment"]; ?><br>
<input type=hidden name=myc>
<input type=hidden name=cidc value="<? echo $CALPARAMS["cidc"]; ?>">
<input type=hidden name=ctri value="<? echo $CALPARAMS["ctri"]; ?>">
<input type=text size=10 name=critere value="<? if(isset($_GET['critere'])) echo trim($_GET['critere']); ?>">
<input type=submit value="<? echo $CALANGUAGE["myc.search"]; ?>">
</form>

<table class=mycadd>
<? if(isset($_GET["critere"])&&strlen($_GET["critere"]=trim($_GET["critere"]))>1) { ?>
<tr>
<td>
<form action="form.php?myc&action=addg&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>" method=post>
<select name=groupe size=1>
<?
	$query="select distinct groupe from groupe where groupe like '%".mysql_real_escape_string($_GET["critere"])."%' order by groupe";
	$groupes=array();
	$groupes[""]=$CALANGUAGE["myc.search.group.header"];
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
<input name=okgroupe type=submit value="<? echo $CALANGUAGE["myc.search.submit.group"]; ?>">
</form>
</td>
<td>
<form method=post action="form.php?myc&action=addu&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>">
<select name=utilisateur size=1>
<?
	$query="select * from compte where login like '%".mysql_real_escape_string($_GET["critere"])."%' or nom like '%".mysql_real_escape_string($_GET["critere"])."%' order by nom";
	$comptes=array();
	$comptes[""]=$CALANGUAGE["myc.search.user.header"];
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
<input name=okutilisateur type=submit value="<? echo $CALANGUAGE["myc.search.submit.user"]; ?>">
</form>
</td>
</tr>

<? } ?>
<tr>
<td width=250><b><? echo $CALANGUAGE["myc.rights.groups"]; ?></b></td>
<td><b><? echo $CALANGUAGE["myc.rights.users"]; ?></b></td>
</tr>
<tr>
<td>
<?
$query="select * from droit where porte='group' and idc = $CALPARAMS[cidc] order by qui";
$results=mysql_query($query,$mysql_link);
while($groupe=mysql_fetch_assoc($results))
{
?>
<input title="<? echo $CALANGUAGE["myc.rights.group.sub"]; ?>" class=m type=button value="-" onClick="go('form.php?myc&action=subg&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>&group=<? echo $groupe["qui"]; ?>')">
<? echo $groupe["qui"]; ?> <i><a title="<? echo $CALANGUAGE["myc.rights.group.swap"]; ?>" href="#" onClick="go('form.php?myc&action=swapg&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>&group=<? echo $groupe["qui"]; ?>&type=<? echo $groupe["type"]; ?>')"><? echo $CALANGUAGE["myc.rights.type.$groupe[type]"]; ?></a></i><br>
<?
}
mysql_free_result($results);

?>
</td>
<td>
<?
$query="select c.*, d.type droit from compte c, droit d where d.qui = c.login and d.porte='user' and d.idc = $CALPARAMS[cidc] order by c.login";
$results=mysql_query($query,$mysql_link);
while($utilisateur=mysql_fetch_assoc($results))
{
?>
<input title="<? echo $CALANGUAGE["myc.rights.user.sub"]; ?>" class=m type=button value="-" onClick="go('form.php?myc&action=subu&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>&user=<? echo $utilisateur["login"]; ?>')">
<? echo $utilisateur["nom"]; ?> (<? echo $utilisateur["login"]; ?>) <i><a title="<? echo $CALANGUAGE["myc.rights.user.swap"]; ?>" href="#" onClick="go('form.php?myc&action=swapu&ctri=<? echo $CALPARAMS['ctri']; ?>&cidc=<? echo $CALPARAMS["cidc"]; ?>&user=<? echo $utilisateur["login"]; ?>&type=<? echo $utilisateur["droit"]; ?>')"><? echo $CALANGUAGE["myc.rights.type.$utilisateur[droit]"]; ?></a></i><br>
<?
}
mysql_free_result($results);

?>
</td>
</tr>
</table>
<?
}
else
{
?>
<br>
<b><? echo $CALANGUAGE['ce.comment']; ?></b>
<table class=myce>
<tr>
<td><a href="#" onClick="go('?myc&ctri=groupe')"><? echo $CALANGUAGE['cfield.groupe']; ?></a>
<? if($CALPARAMS['ctri']=='groupe') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=login')"><? echo $CALANGUAGE['cfield.login']; ?></a>
<? if($CALPARAMS['ctri']=='login') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=type')"><? echo $CALANGUAGE['cfield.type']; ?></a>
<? if($CALPARAMS['ctri']=='type') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=visibilite')"><? echo $CALANGUAGE['cfield.visibilite']; ?></a>
<? if($CALPARAMS['ctri']=='visibilite') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td><a href="#" onClick="go('?myc&ctri=nom')"><? echo $CALANGUAGE['cfield.nom']; ?></a>
<? if($CALPARAMS['ctri']=='nom') { ?><img src="img/ldown.gif"><? } ?>
</td>
<td class=h><? echo $CALANGUAGE['cfield.droit']; ?></td>
</tr>
<tr>
<?
reset($ctrie);
$i=0;
while(list($groupei,$calendrier)=each($ctrie))
{
	$i++;
?>
<tr class=l<? echo ($i%2); ?>>
<td><? echo $calendrier['groupe']; ?></td>
<td><? if($calendrier['nom_login']) echo $calendrier['nom_login']; else echo $calendrier['login']; ?></td>
<td><? echo $CALANGUAGE["ctype.$calendrier[type]"]; ?></td>
<td><? echo $CALANGUAGE["cvisibility.$calendrier[visibilite]"]; ?></td>
<td><? echo $calendrier['nom']; ?></td>
<td><? echo $CALANGUAGE["cright.$calendrier[droit]"]; ?></td>
<td>
<?
if(isset($calendrier["abonnement"])&&$calendrier["abonnement"]=="shown") $action="noabo";
else $action="abo";
?>
<a title="<? echo $CALANGUAGE["myc.$action.change"]; ?>" href="#" onClick="go('form.php?myc&ctri=<? echo $CALPARAMS['ctri']; ?>&aidc=<? echo $calendrier["idc"]; ?>&action=<? echo $action; ?>')"><? echo $CALANGUAGE["myc.$action"]; ?></a></td>
</tr>
<?
}
?>
</tr>
</table>
<? } ?>
