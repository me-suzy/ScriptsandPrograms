<?

$FIELDSOFTABLES=array();
$FIELDSOFTABLES["evenement"]=array();

reset($FIELDSOFTABLES);

while(list($table,$fields)=each($FIELDSOFTABLES))
{
	$results = mysql_query("SHOW COLUMNS FROM `$table`", $mysql_link);
	while ($row = mysql_fetch_assoc($results))
		$FIELDSOFTABLES[$table][$row['Field']]=$row;
	mysql_free_result($results);
}
	
$TYPES=array(
	"default" => "",
	"period" => "",
	"task" => "",
	"taskp" => "",
	"taskb" => "",
	"taska" => "");
reset($TYPES);
while(list($type,$rien)=each($TYPES))
	$TYPES[$type]=$CALANGUAGE["event.$type.title"];

if(isset($_SESSION["compte"]))
{
	$query="
SELECT 'hidden' as display, c.*, l.nom nom_login, d.type as droit
FROM calendrier c left join compte l on c.login = l.login, droit d
WHERE d.qui = '{$_SESSION["compte"]["login"]}'
and d.idc = c.idc
and d.porte='user'
UNION
SELECT 'hidden' as display, c.*, l.nom nom_login, d.type as droit
FROM calendrier c left join compte l on c.login = l.login, droit d, groupe g
WHERE g.login = '{$_SESSION["compte"]["login"]}'
and g.groupe = d.qui
and d.idc = c.idc
and d.porte='group'
UNION
SELECT if(c.visibilite='global', 'shown', 'hidden') as display, c.*, l.nom nom_login, 'write' as droit
FROM calendrier c left join compte l on c.login = l.login
WHERE c.login =  '{$_SESSION["compte"]["login"]}'
UNION 
SELECT if(c.visibilite='global', 'shown', 'hidden') as display, c.*, l.nom nom_login, 'read' as droit
FROM calendrier c left join compte l on c.login = l.login, groupe g
WHERE c.groupe = g.groupe AND g.login =  '{$_SESSION["compte"]["login"]}' AND c.type =  'protected'
UNION 
SELECT if(c.visibilite='global', 'shown', 'hidden') as display, c.*, l.nom nom_login, '".($_SESSION["compte"]["type"]=='admin'?'write':'read')."' as droit
FROM calendrier c left join compte l on c.login = l.login
WHERE  c.TYPE  in  ('general','public')
ORDER BY droit
";
}
else
{
	$query="
SELECT  if(c.visibilite='global', 'shown', 'hidden') as display, c.*, l.nom nom_login, 'read' as droit
FROM calendrier c left join compte l on c.login = l.login
WHERE  c.TYPE  =  'public'";
}

//die($query);

$CALENDRIERS=array();
$results=mysql_query($query,$mysql_link);
while($calendrier=mysql_fetch_assoc($results))
{
	if(!isset($CALENDRIERS[$calendrier["idc"]]))
		$CALENDRIERS[$calendrier["idc"]]=array();
	reset($calendrier);
	while(list($cle,$valeur)=each($calendrier))
		if($cle!="display")
			$CALENDRIERS[$calendrier["idc"]][$cle]=$valeur;
	if($calendrier["display"]=="shown")
		$CALENDRIERS[$calendrier["idc"]]["display"]="shown";
}
mysql_free_result($results);

if(isset($_SESSION["compte"]))
{
	$query="select * from abonnement where login='{$_SESSION["compte"]["login"]}'";
	$results=mysql_query($query,$mysql_link);
	while($abonnement=mysql_fetch_assoc($results))
		if(isset($CALENDRIERS[$abonnement["idc"]]))
		{
			$CALENDRIERS[$abonnement["idc"]]["display"]=($abonnement["type"]=="shown"?TRUE:FALSE);
			$CALENDRIERS[$abonnement["idc"]]["abonnement"]=$abonnement["type"];
		}
	mysql_free_result($results);
}
ksort($CALENDRIERS);

$CALPARAMS=array();

$listeidc="";
reset($CALENDRIERS);
while(list($idc,$calendrier)=each($CALENDRIERS))
	if(isset($calendrier["display"])&&$calendrier["display"])
		if($listeidc)$listeidc.=", $idc";
		else $listeidc=$idc;

		/*
if(isset($_GET["e"]))
{
	if(isset($_SESSION["compte"]))
		$query="
SELECT distinct e.* from evenement e left join occurence o on e.ide = o.ide where ( e.login='{$_SESSION["compte"]["login"]}'";
	else
		$query="
SELECT distinct e.* from evenement e left join occurence o on e.ide = o.ide where ( 0";
if($listeidc)
	$query.=" or o.idc in ($listeidc) ) and type in ('default','period') and e.ide = $_GET[e]";
else $query.=" )";
	echo $query;
	$results=mysql_query($query,$mysql_link);
	$evenement=mysql_fetch_assoc($results);
	mysql_free_result($results);
	if($evenement) $CALPARAMS["detail"]="evenement";
}
*/



$CALPARAMS["date"]=array();

$EVENEMENTS=array();

/*
if(isset($_GET["e"]))
{
	$query="select * from evenement where ide=$_GET[e]";
	$results=mysql_query($query,$mysql_link);
	$evenement=mysql_fetch_assoc($results);
	mysql_free_result($results);
	if($evenement
}
*/



if(isset($_GET["ts"])&&$_GET["ts"]=="now") $CALPARAMS["date"]["ts"]=time();
else if(isset($_GET["ts"])) $CALPARAMS["date"]["ts"]=$_GET["ts"];
else if(isset($_GET["y"])&&isset($_GET["m"])&&isset($_GET["d"]))
	$CALPARAMS["date"]["ts"]=mktime(12,0,0,$_GET["m"],$_GET["d"],$_GET["y"]);
else if(isset($_GET["y"])&&isset($_GET["m"]))
	$CALPARAMS["date"]["ts"]=mktime(12,0,0,$_GET["m"],date("d"),$_GET["y"]);
else if(isset($_GET["y"]))
	$CALPARAMS["date"]["ts"]=mktime(12,0,0,date("m"),date("d"),$_GET["y"]);
else if(isset($_COOKIE["ts"])&&$_COOKIE["ts"]) $CALPARAMS["date"]["ts"]=$_COOKIE["ts"];
else $CALPARAMS["date"]["ts"]=time();

setcookie("ts",$CALPARAMS["date"]["ts"],NULL,"/");
$_COOKIE["ts"]=$CALPARAMS["date"]["ts"];

$CALPARAMS["date"]["fr"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
$CALPARAMS["date"]["d"]=date("d",$CALPARAMS["date"]["ts"]);
$CALPARAMS["date"]["w"]=lang_getw($CALPARAMS["date"]["ts"]);

$CALPARAMS["date"]["annee"]=date("Y",$CALPARAMS["date"]["ts"]);
$CALPARAMS["date"]["y"]=$CALPARAMS["date"]["annee"];

$CALPARAMS["date"]["mois"]=array();
$CALPARAMS["date"]["mois"]["m"]=date("m",$CALPARAMS["date"]["ts"]);
$CALPARAMS["date"]["m"]=$CALPARAMS["date"]["mois"]["m"];
$CALPARAMS["date"]["mois"]["debut"]=mktime(0,0,0,$CALPARAMS["date"]["m"],1,$CALPARAMS["date"]["y"]);
$CALPARAMS["date"]["semaine"]=array();
$CALPARAMS["date"]["semaine"]["debut"]=mktime(0,0,0,$CALPARAMS["date"]["m"],$CALPARAMS["date"]["d"]-$CALPARAMS["date"]["w"],$CALPARAMS["date"]["y"]);

$CALPARAMS["now"]=array();
$CALPARAMS["now"]["ts"]=time();
$CALPARAMS["now"]["fr"]=date("d/m/Y",$CALPARAMS["now"]["ts"]);
$CALPARAMS["now"]["d"]=date("d",$CALPARAMS["now"]["ts"]);
$CALPARAMS["now"]["w"]=lang_getw($CALPARAMS["now"]["ts"]);

$CALPARAMS["now"]["annee"]=date("Y",$CALPARAMS["now"]["ts"]);
$CALPARAMS["now"]["y"]=$CALPARAMS["now"]["annee"];

$CALPARAMS["now"]["mois"]=array();
$CALPARAMS["now"]["mois"]["m"]=date("m",$CALPARAMS["now"]["ts"]);
$CALPARAMS["now"]["m"]=$CALPARAMS["now"]["mois"]["m"];
$CALPARAMS["now"]["mois"]["debut"]=mktime(0,0,0,$CALPARAMS["now"]["m"],1,$CALPARAMS["now"]["y"]);


$debut=$CALPARAMS["date"]["semaine"]["debut"];
$fin=$debut+7*ONEDAY;

if($CALPARAMS["date"]["mois"]["debut"]<$debut)
	$debut=$CALPARAMS["date"]["mois"]["debut"];

for($ts=$CALPARAMS["date"]["mois"]["debut"]+ONEDAY/2;date("m",$ts)==$CALPARAMS["date"]["m"];$ts+=ONEDAY);
if($ts>$fin)
	$fin=$ts;

if(isset($_GET['ctri']))$CALPARAMS["ctri"]=$_GET['ctri'];
else $CALPARAMS["ctri"]='groupe';
	
$PLANNING=array();

$equeries=array();

$pw="
and u.login = e.createur
and (
	(
		e.type in ('default','taska')
		and e.debut >= '".date("Y-m-d",$debut)."'
		and e.debut < '".date("Y-m-d",$fin)."'
	)
	or (
		e.type in ('task','taskb')
		and e.fin >= '".date("Y-m-d",$debut)."'
		and e.fin < '".date("Y-m-d",$fin)."'
	)
	or (
		e.type in ('period','taskp')
		and (
			(
				e.debut >= '".date("Y-m-d",$debut)."'
				and e.debut < '".date("Y-m-d",$fin)."'
			)
			or (
				e.fin >= '".date("Y-m-d",$debut)."'
				and e.fin < '".date("Y-m-d",$fin)."'
			)
			or (
				e.debut <= '".date("Y-m-d",$debut)."'
				and e.fin >= '".date("Y-m-d",$fin)."'
			)
		)
	)
)
";
	
if(isset($_SESSION["compte"]))
	$query="

SELECT distinct o.idc, e.*, u.nom from compte u, evenement e left join occurence o on e.ide = o.ide where ( e.login='{$_SESSION["compte"]["login"]}'";
else
	$query="
SELECT distinct o.idc, e.*, u.nom from compte u, evenement e left join occurence o on e.ide = o.ide where ( 0";
if($listeidc)
	$query.=" or o.idc in ($listeidc) ) $pw";
       //	and e.type in ('default','period','task','taska','taskb','taskp')";
else $query.=" ) $pw";

array_push($equeries,$query);

if(isset($_SESSION["compte"]))
{
	$query="SELECT distinct e.*, u.nom, i.porte as invitation, i.qui, i.reponse, i.commentaire as icom from compte u, evenement e, invitation i, groupe g left join occurence o on e.ide = o.ide where i.porte='group' and i.qui = g.groupe and g.login = '{$_SESSION["compte"]["login"]}' and i.ide=e.ide $pw";

	array_push($equeries,$query);

	$query="SELECT distinct e.*, u.nom, i.porte as invitation, i.qui, i.reponse, i.commentaire as icom from compte u, evenement e, invitation i left join occurence o on e.ide = o.ide where i.porte='user' and i.qui = '{$_SESSION["compte"]["login"]}' and i.ide=e.ide $pw";

	array_push($equeries,$query);
}

if(isset($_GET["e"])){ $eok=FALSE; $iok=FALSE; }

reset($equeries);

while(list($rien,$query)=each($equeries))
{
	$results=mysql_query($query,$mysql_link);
	while($evenement=mysql_fetch_assoc($results))
	{
		if(isset($_GET["e"])&&$_GET["e"]==$evenement["ide"]&&isset($_SESSION["compte"])&&($evenement["login"]==$_SESSION["compte"]["login"]||(isset($evenement["idc"])&&isset($CALENDRIERS[$evenement["idc"]])&&$CALENDRIERS[$evenement["idc"]]["droit"]=="write"))) $eok=TRUE;
		if(isset($_GET["e"])&&$_GET["e"]==$evenement["ide"]&&isset($_SESSION["compte"])&&isset($evenement["qui"])&&$evenement["qui"]==$_SESSION["compte"]["login"]&&isset($evenement["invitation"])&&$evenement["invitation"]=='user') $iok=TRUE;
		switch($evenement["type"])
		{
		case "default": case "taska":
			$debut=date_db2ts($evenement["debut"]);
			$fin=$debut+ONEDAY/2;
		break;
		case "task": case "taskb":
			$debut=date_db2ts($evenement["fin"]);
			$fin=$debut+ONEDAY/2;
		break;
		case "period": case "taskp":
			$debut=date_db2ts($evenement["debut"]);
			$fin=date_db2ts($evenement["fin"])+ONEDAY/2;
		break;
		}
		for($ts=$debut;$ts<$fin;$ts+=ONEDAY)
		{
			$m=date("m",$ts);
			$d=date("d",$ts);
			if(!isset($PLANNING[$m])) $PLANNING[$m]=array();
			if(!isset($PLANNING[$m][$d])) $PLANNING[$m][$d]=array();
			//$PLANNING[$m][$d][$evenement["ide"]]=(substr($evenement["type"],0,4)=="task"?"b":"a").($evenement["estheure"]?substr($evenement["heure"],0,5):"");
			$PLANNING[$m][$d][$evenement["ide"]]=($evenement["estheure"]?substr($evenement["heure"],0,5):"").(substr($evenement["type"],0,4)=="task"?"99:99":"");
		}
		$EVENEMENTS[$evenement["ide"]]=$evenement;
		/*
		reset($evenement);
		while(list($champ,$valeur)=each($evenement))
			$EVENEMENTS[$evenement["ide"]][$champ]=$valeur;
		*/
	}
	mysql_free_result($results);
}


//echo $query;
$tqueries=array();

$pw="
and u.login = e.createur
and (
	(
		e.type in ('taska')
		and e.debut <= '".date("Y-m-d")."'
	)
	or (
		e.type in ('taskb')
		and e.fin >= '".date("Y-m-d")."'
	)
	or (
		e.type in ('task')
		and e.fin = '".date("Y-m-d")."'
	)
	or (
		e.type in ('taskp')
		and e.debut <= '".date("Y-m-d")."'
		and e.fin >= '".date("Y-m-d")."'
	)
)
and etat = ''
";

if(isset($_SESSION["compte"]))
	$query="
SELECT distinct o.idc, e.*, u.nom from compte u, evenement e left join occurence o on e.ide = o.ide where ( e.login='{$_SESSION["compte"]["login"]}'";
else
	$query="
SELECT distinct o.idc, e.*, u.nom from compte u, evenement e left join occurence o on e.ide = o.ide where ( 0";
if($listeidc)
	$query.=" or o.idc in ($listeidc) ) $pw";
else $query.=" ) $pw";

array_push($tqueries,$query);

if(isset($_SESSION["compte"]))
{
	$query="SELECT distinct e.*, u.nom, i.porte as invitation, i.qui, i.reponse, i.commentaire as icom from compte u, evenement e, invitation i, groupe g left join occurence o on e.ide = o.ide where i.porte='group' and i.qui = g.groupe and g.login = '{$_SESSION["compte"]["login"]}' and i.ide=e.ide $pw";

	array_push($tqueries,$query);

	$query="SELECT distinct e.*, u.nom, i.porte as invitation, i.qui, i.reponse, i.commentaire as icom from compte u, evenement e, invitation i left join occurence o on e.ide = o.ide where i.porte='user' and i.qui = '{$_SESSION["compte"]["login"]}' and i.ide=e.ide $pw";

	array_push($tqueries,$query);
}

$pl=array(
"low" => 1,
"normal" => 2,
"high" => 3);

$TASKS=array();

reset($tqueries);

while(list($rien,$query)=each($tqueries))
{
	$results=mysql_query($query,$mysql_link);
	while($evenement=mysql_fetch_assoc($results))
	{
		if(isset($_GET["e"])&&$_GET["e"]==$evenement["ide"]&&isset($_SESSION["compte"])&&($evenement["login"]==$_SESSION["compte"]["login"]||(isset($evenement["idc"])&&$CALENDRIERS[$evenement["idc"]]["droit"]=="write"))) $eok=TRUE;
		if(isset($_GET["e"])&&$_GET["e"]==$evenement["ide"]&&isset($_SESSION["compte"])&&isset($evenement["qui"])&&$evenement["qui"]==$_SESSION["compte"]["login"]&&isset($evenement["invitation"])&&$evenement["invitation"]=='user') $iok=TRUE;
		$EVENEMENTS[$evenement["ide"]]=$evenement;
		$TASKS[$evenement["ide"]]=$pl[$evenement["priorite"]].($evenement["estheure"]?substr($evenement["heure"],0,5):"");
	}
	mysql_free_result($results);
}

arsort($TASKS);

if(isset($_SESSION["compte"])&&isset($_GET["new"]))
{
	switch($_GET["new"])
	{
	case "default": case "period": case "task": case "taskp": case "taskb": case "taska":
		$CALPARAMS["detail"]="new$_GET[new]";
	break;
	default: $CALPARAMS["detail"]="choix";
	}
}
else if(isset($_GET["e"])&&$eok)
{
	$CALPARAMS["ide"]=$_GET["e"];
	if(isset($_POST["delete"]))
		$CALPARAMS["detail"]="delevent";
	else 
	{
		$CALPARAMS["detail"]="majevent";
		if(isset($_POST["cancel"])&&$_POST["cancel"])
			$CALPARAMS["tab"]="cancel";
		else if(isset($_GET["tab"]))
		{
			switch($_GET["tab"])
			{
			case "move":
			case "repeat":
			case "invite":
				if($EVENEMENTS[$CALPARAMS["ide"]]["etat"]==""||$EVENEMENTS[$CALPARAMS["ide"]]["etat"]=="confirmed")
					$CALPARAMS["tab"]=$_GET["tab"];
				else $CALPARAMS["tab"]="update";
			break;
			case "update":
			case "publish":
				$CALPARAMS["tab"]=$_GET["tab"];
			break;
			default:
				$CALPARAMS["tab"]="update";
			}
		}
		else $CALPARAMS["tab"]="update";
	}
	if($iok) $CALPARAMS["iide"]=$_GET["e"];
}
else if(isset($_GET["e"])&&$iok)
{
	$CALPARAMS["iide"]=$_GET["e"];
	$CALPARAMS["detail"]="journee";
}
else if (isset($_SESSION["compte"])&&isset($_GET["myc"]))
{
	$CALPARAMS["detail"]="myc";
	if(isset($_GET["cidc"])&&isset($CALENDRIERS[$_GET["cidc"]])&&$CALENDRIERS[$_GET["cidc"]]["login"]==$_SESSION["compte"]["login"])
		$CALPARAMS["cidc"]=$_GET["cidc"];
	if(isset($_GET["aidc"])&&isset($CALENDRIERS[$_GET["aidc"]]))
		$CALPARAMS["aidc"]=$_GET["aidc"];
}
else $CALPARAMS["detail"]="journee";

reset($PLANNING);
while(list($m,$mtab)=each($PLANNING))
{
	reset($PLANNING[$m]);
	while(list($d,$dtab)=each($mtab))
		asort($PLANNING[$m][$d]);
}


?>
