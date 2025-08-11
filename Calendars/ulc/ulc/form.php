<?
include_once("etc/config.php");
include_once("inc/constantes.php");
include_once("inc/language.php");
include_once("inc/mquotes.php");
include_once("inc/start_session.php");
include_once("inc/check_session.php");
include_once("inc/mysql_connexion.php");
include_once("inc/f_check_login.php");
include_once("inc/f_date.php");
include_once("inc/calendrier.php");

$url="index.php";

if(isset($CALPARAMS["detail"]))
{
	switch($CALPARAMS["detail"])
	{
	case "myc":
		$url="index.php?myc&ctri=$CALPARAMS[ctri]";
		if(isset($_GET["action"])&&isset($CALPARAMS["aidc"])&&$_GET["action"]=="abo")
		{
			$query="insert into abonnement(login,idc,type) values('{$_SESSION['compte']['login']}',$CALPARAMS[aidc],'shown')";
			mysql_query($query,$mysql_link);
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["aidc"])&&$_GET["action"]=="noabo")
		{
			$query="delete from abonnement where login='{$_SESSION['compte']['login']}' and idc=$CALPARAMS[aidc]";
			mysql_query($query,$mysql_link);
			if(isset($CALPARAMS["cidc"]))
				$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["cidc"])&&$_GET["action"]=="subg"&&$_GET['group'])
		{
			$query="delete from droit where idc=$CALPARAMS[cidc] and porte='group' and qui='$_GET[group]'";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["cidc"])&&$_GET["action"]=="subu"&&$_GET['user'])
		{
			$query="delete from droit where idc=$CALPARAMS[cidc] and porte='user' and qui='$_GET[user]'";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["cidc"])&&$_GET["action"]=="swapg"&&$_GET['group']&&$_GET["type"])
		{
			$query="update droit set type='".($_GET['type']=='read'?'write':'read')."' where idc=$CALPARAMS[cidc] and porte='group' and qui='$_GET[group]'";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["cidc"])&&$_GET["action"]=="swapu"&&$_GET['user']&&$_GET["type"])
		{
			$query="update droit set type='".($_GET['type']=='read'?'write':'read')."' where idc=$CALPARAMS[cidc] and porte='user' and qui='$_GET[user]'";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["cidc"])&&$_GET["action"]=="addg"&&$_POST['groupe'])
		{
			$query="insert ignore into droit(idc,porte,qui,type) values($CALPARAMS[cidc],'group','$_POST[groupe]','read')";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&isset($CALPARAMS["cidc"])&&$_GET["action"]=="addu"&&$_POST['utilisateur'])
		{
			$query="insert ignore into droit(idc,porte,qui,type) values($CALPARAMS[cidc],'user','$_POST[utilisateur]','read')";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($_GET["action"])&&$_GET["action"]=="new")
		{
			$query="insert into calendrier(type,login,visibilite,nom) values('private','{$_SESSION['compte']['login']}','local','Nouveau calendrier')";
			mysql_query($query,$mysql_link);
			$idc=mysql_insert_id($mysql_link);
			$query="insert into abonnement(login,idc,type) values('{$_SESSION['compte']['login']}',$idc,'shown')";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$idc";
		}
		else if(isset($_POST["supprimer"])&&isset($CALPARAMS["cidc"]))
		{
			$query="delete from calendrier where idc=$CALPARAMS[cidc]";
			mysql_query($query,$mysql_link);
			$query="delete from occurence where idc=$CALPARAMS[cidc]";
			mysql_query($query,$mysql_link);
			$query="delete from droit where idc=$CALPARAMS[cidc]";
			mysql_query($query,$mysql_link);
			$query="delete from abonnement where idc=$CALPARAMS[cidc]";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]";
		}
		else if(isset($_POST["sauver"])&&isset($CALPARAMS["cidc"]))
		{
			if(!isset($_POST['visibilite'])) $_POST['visibilite']='local';
			else if($_POST["type"]=="protected"&&$_POST["visibilite"]=="global")
			{
				$query="select * from groupe where groupe='$_POST[groupe]' and login='{$_SESSION['compte']['login']}'";
				$results=mysql_query($query,$mysql_link);
				$groupe=mysql_fetch_assoc($results);
				mysql_free_result($results);
				if(!$groupe||$groupe['type']!='admin')$_POST['visibilite']='local';
			}
			else if($_SESSION['compte']['type']!='admin'&&$_POST["visibilite"]=="global")
				$_POST['visibilite']='local';
		
			$query="update calendrier set type='$_POST[type]', visibilite='$_POST[visibilite]', groupe='$_POST[groupe]'";
		if(trim($_POST['nom'])) $query.=", nom='".mysql_real_escape_string(trim($_POST['nom']))."'";	
			$query.=" where idc=$CALPARAMS[cidc]";
			mysql_query($query,$mysql_link);
			$url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
		}
		else if(isset($CALPARAMS["cidc"])) $url="index.php?myc&ctri=$CALPARAMS[ctri]&cidc=$CALPARAMS[cidc]";
	break;
	case "delevent":
		$query="delete from evenement where ide=$CALPARAMS[ide]";
		mysql_query($query,$mysql_link);
		$query="delete from invitation where ide=$CALPARAMS[ide]";
		mysql_query($query,$mysql_link);
	break;
	case "majevent":
		$url="index.php?e=$CALPARAMS[ide]&ts={$CALPARAMS["date"]["ts"]}&tab=$CALPARAMS[tab]";
		switch($CALPARAMS["tab"])
		{

		case "cancel":				
			$query="update evenement set etat='canceled' where ide = $CALPARAMS[ide]";
			mysql_query($query,$mysql_link);
			$url="index.php?e=$CALPARAMS[ide]";
		break;

		case "repeat":
			if($_POST["occurrence"]<=0||$_POST["interval"]<=0) break;
			if(!date_checkfr($_POST["date"])) break;
			switch($EVENEMENTS[$CALPARAMS["ide"]]["type"])
			{
			case "default": case "taska":
			case "periode": case "taskp":
				$ts=date_db2ts($EVENEMENTS[$CALPARAMS["ide"]]["debut"]);
			break;
			case "task": case "taskb":
				$ts=date_db2ts($EVENEMENTS[$CALPARAMS["ide"]]["fin"]);
			break;
			}
			$tsr=date_db2ts(date_fr2db($_POST["date"]));
			$ecartbase=$tsr-$ts;
			switch($_POST["unit"])
			{
			case "week":
							$_POST["unit"]="day";
							$_POST["interval"]*=7;
			break;
			case "year":
							$_POST["unit"]="month";
							$_POST["interval"]*=12;
			break;
			}
			//$tsr+=;
			$query="";
			$d=date("d",$tsr);
			$m=date("m",$tsr);
			$y=date("Y",$tsr);
			for($i=0;$i<$_POST["occurrence"];$i++)
			{
				if($_POST["unit"]=="day")
					$ecart=$ecartbase+mktime(12,0,0,$m,$d+$_POST["interval"]*($i+1),$y)-($tsr+ONEDAY/2);
				else
					$ecart=$ecartbase+mktime(12,0,0,$m+$_POST["interval"]*($i+1),$d,$y)-($tsr+ONEDAY/2);
				$insert="";
				reset($EVENEMENTS[$CALPARAMS["ide"]]);
				while(list($champ,$valeur)=each($EVENEMENTS[$CALPARAMS["ide"]]))
				{
					if($champ=="ide") continue;
					if(!isset($FIELDSOFTABLES['evenement'][$champ])) continue;
					switch($champ)
					{
					case "debut": case "fin":
						$valeur=date_ts2db(date_db2ts($valeur)+$ecart+ONEDAY/2);
					break;
					case "etat":
						$valeur="";
					break;
					case "source":
						$valeur="repeated";
					break;
					case "idep":
						$valeur=$CALPARAMS["ide"];
					break;
					}
					if($insert)
					{
						$insert.=",$champ";
						$values.=",'".mysql_real_escape_string($valeur)."'";
					}
					else
					{
						$insert="insert into evenement($champ";
						$values="values('".mysql_real_escape_string($valeur)."'";
					}
				}
				$query="$insert)\n$values);\n";
				mysql_query($query,$mysql_link);
				$ide=mysql_insert_id($mysql_link);
				$query="insert into invitation(ide,porte,qui) select $ide, porte, qui from invitation where ide=$CALPARAMS[ide]";
				mysql_query($query,$mysql_link);
			}
		break;

		case "publish":
			if(isset($_GET['action'])&&$_GET["action"]=="addpublish"&&isset($_GET["pidc"]))
			{
				if($CALENDRIERS[$_GET["pidc"]]["droit"]=='write')
				{
					$query="insert ignore into occurence(idc,ide) values($_GET[pidc],$CALPARAMS[ide])";
					mysql_query($query,$mysql_link);
				}
			}
			else if(isset($_GET['action'])&&$_GET["action"]=="delpublish"&&isset($_GET["pidc"]))
			{
				$query="delete from occurence where idc=$_GET[pidc] and ide=$CALPARAMS[ide]";
				mysql_query($query,$mysql_link);
			}
			$url="index.php?e=$CALPARAMS[ide]&tab=publish";
		break;
		
		case "invite":
			if(isset($_GET["supprimer"])&&isset($_GET["porte"])&&isset($_GET["qui"]))
			{
				$query="delete from invitation where ide=$CALPARAMS[ide] and porte='$_GET[porte]' and qui='$_GET[qui]'";
				mysql_query($query,$mysql_link);
			}
			else if(isset($_POST["okutilisateur"])&&isset($_POST["utilisateur"])&&$_POST["utilisateur"])
			{
				$query="insert ignore into invitation(ide,porte,qui) values($CALPARAMS[ide],'user','$_POST[utilisateur]')";
				mysql_query($query,$mysql_link);
			}
			else if(isset($_POST["okgroupe"])&&isset($_POST["groupe"])&&$_POST["groupe"])
			{
				$query="insert ignore into invitation(ide,porte,qui) values($CALPARAMS[ide],'group','$_POST[groupe]')";
				mysql_query($query,$mysql_link);
			}
			else if(isset($_POST["reply"]))
			{
				$query="update invitation set reponse='$_POST[reponse]', commentaire='".mysql_real_escape_string($_POST["commentaire"])."' where ide=$CALPARAMS[ide] and qui='{$_SESSION["compte"]["login"]}' and porte='user'";
				mysql_query($query,$mysql_link);
			}
			$url="index.php?e=$CALPARAMS[ide]&tab=invite";	
		break;
			
		case "move":
			if(!date_checkfr($_POST["date"])) break;
			$ts=date_db2ts(date_fr2db($_POST["date"]));
			switch($EVENEMENTS[$CALPARAMS["ide"]]["type"])
			{
			case "default": case "taska":
				$tsr=date_db2ts($EVENEMENTS[$CALPARAMS["ide"]]["debut"]);
			break;
			case "task": case "taskb":
				$tsr=date_db2ts($EVENEMENTS[$CALPARAMS["ide"]]["fin"]);
			break;
			case "periode": case "taskp":
				$tsr=date_db2ts($EVENEMENTS[$CALPARAMS["ide"]]["debut"]);
			break;
			}
			if($ts>$tsr) $etat="postponed";
			else if($ts<$tsr) $etat="preponed";
			else $etat="";
			if($etat)
			{
				$query="update evenement set etat='$etat', datep='".date_fr2db($_POST["date"])."' where ide = $CALPARAMS[ide]";
				mysql_query($query,$mysql_link);
				$insert="";
				reset($EVENEMENTS[$CALPARAMS["ide"]]);
				while(list($champ,$valeur)=each($EVENEMENTS[$CALPARAMS["ide"]]))
				{
					if($champ=="ide") continue;
					if(!isset($FIELDSOFTABLES['evenement'][$champ])) continue;
					switch($champ)
					{
					case "debut": case "fin":
						$valeur=date_ts2db(date_db2ts($valeur)+($ts-$tsr)+ONEDAY/2);
					break;
					case "heure":
						if(isset($_POST["estheure"]))
							$valeur=heure_fr2db($_POST["heure"]);
					break;
					case "estheure":
						$valeur=isset($_POST["estheure"]);
					break;
					case "duree":
						$valeur=$_POST["duree"];
					break;
					case "etat":
						$valeur="";
					break;
					case "source":
						$valeur="moved";
					break;
					case "idep":
						$valeur=$CALPARAMS["ide"];
					break;
					}
					if($insert)
					{
						$insert.=",$champ";
						$values.=",'".mysql_real_escape_string($valeur)."'";
					}
					else
					{
						$insert="insert into evenement($champ";
						$values="values('".mysql_real_escape_string($valeur)."'";
					}
				}
				$query="$insert) $values)";
				mysql_query($query,$mysql_link);
				$ide=mysql_insert_id($mysql_link);
				$query="insert into invitation(ide,porte,qui) select $ide, porte, qui from invitation where ide=$CALPARAMS[ide]";
				mysql_query($query,$mysql_link);
				$url="index.php?e=$ide&ts=$ts";
			}
			else
				$url="index.php?e=$CALPARAMS[ide]&ts=$tsr&tab=move";
		break;
		
		case "update":

			if(!isset($_POST["titre"])||(!$_POST["titre"]))
				$_POST["titre"]=$EVENEMENTS[$CALPARAMS["ide"]]["titre"];
			switch($_POST["type"])
			{
			case "default": case "taska":
				if((!isset($_POST["debut"]))||(!$_POST["debut"])||(!date_checkfr($_POST["debut"])))
					if($EVENEMENTS[$CALPARAMS["ide"]]["debut"]=="0000-00-00")
						$_POST["debut"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
					else $_POST["debut"]=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]);
				$_POST["fin"]=$_POST["debut"];
				$ts=date_db2ts(date_fr2db($_POST["debut"]));
			break;
			case "task": case "taskb":
				if((!isset($_POST["fin"]))||(!$_POST["fin"])||(!date_checkfr($_POST["fin"])))
					if($EVENEMENTS[$CALPARAMS["ide"]]["fin"]=="0000-00-00")
						$_POST["fin"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
					else $_POST["fin"]=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]);
				$_POST["debut"]=$_POST["fin"];
				$ts=date_db2ts(date_fr2db($_POST["fin"]));
			break;
			case "period": case "taskp":
				if((!isset($_POST["debut"]))||(!$_POST["debut"])||(!date_checkfr($_POST["debut"])))
					if($EVENEMENTS[$CALPARAMS["ide"]]["debut"]=="0000-00-00")
						$_POST["debut"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
					else $_POST["debut"]=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["debut"]);
				if((!isset($_POST["fin"]))||(!$_POST["fin"])||(!date_checkfr($_POST["fin"])))
					if($EVENEMENTS[$CALPARAMS["ide"]]["fin"]=="0000-00-00")
						$_POST["fin"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
					else $_POST["fin"]=date_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["fin"]);
				if(date_db2ts(date_fr2db($_POST["debut"]))>date_db2ts(date_fr2db($_POST["fin"])))
					$_POST["fin"]=$_POST["debut"];
				$ts=date_db2ts(date_fr2db($_POST["debut"]));
				break;
			}
			if(!isset($_POST["estheure"]))$_POST["estheure"]="";
			if((!isset($_POST["heure"]))||(!$_POST["heure"])||(!heure_checkfr($_POST["heure"])))
				$_POST["heure"]=heure_db2fr($EVENEMENTS[$CALPARAMS["ide"]]["heure"]);
			$query="
update evenement
set
	type='$_POST[type]',
	etat='".(isset($_POST['confirm'])?"confirmed":"")."',
	titre='".mysql_real_escape_string($_POST["titre"])."',
	debut='".date_fr2db($_POST["debut"])."',
	fin='".date_fr2db($_POST["fin"])."',
	estheure='$_POST[estheure]',
	heure='".heure_fr2db($_POST["heure"])."',
	duree='$_POST[duree]',
	priorite='$_POST[priorite]',
	commentaire='".mysql_real_escape_string($_POST["commentaire"])."'
where ide = $CALPARAMS[ide]
";
			mysql_query($query,$mysql_link);
			/*
			{
				$query="delete from evenement where idep=$CALPARAMS[ide] and source='moved'";
				mysql_query($query,$mysql_link);
			}
			*/
			$url="index.php?e=$CALPARAMS[ide]&ts=$ts";
		break;
		}

	break;
	default:

		$titreok=TRUE;
		$query="";
		if(!isset($_POST["titre"])||(!$_POST["titre"]))
		{
			if(isset($CALANGUAGE["event.".substr($CALPARAMS["detail"],3).".title"]))
				$_POST["titre"]=$CALANGUAGE["event.".substr($CALPARAMS["detail"],3).".title"];
		else $_POST["titre"]=$CALANGUAGE["event.default.title"];
		$titreok=FALSE;
		}
		switch($CALPARAMS["detail"])
		{
		case "newdefault":
			if((!isset($_POST["debut"]))||(!$_POST["debut"])||(!date_checkfr($_POST["debut"])))
				$_POST["debut"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			$query="insert into evenement(type,createur,login,titre,debut,priorite,duree) values('default','{$_SESSION["compte"]["login"]}','{$_SESSION["compte"]["login"]}','".mysql_real_escape_string($_POST["titre"])."','".date_fr2db($_POST["debut"])."','normal',-1)";	
			$ts=date_db2ts(date_fr2db($_POST["debut"]));
		break;

		case "newperiod":
			if((!isset($_POST["debut"]))||(!$_POST["debut"])||(!date_checkfr($_POST["debut"])))
				$_POST["debut"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			if((!isset($_POST["fin"]))||(!$_POST["fin"])||(!date_checkfr($_POST["fin"])))
				$_POST["fin"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			if(date_db2ts(date_fr2db($_POST["debut"]))>date_db2ts(date_fr2db($_POST["fin"])))
				$_POST["fin"]=$_POST["debut"];
			$query="insert into evenement(type,createur,login,titre,debut,fin,priorite,duree) values('period','{$_SESSION["compte"]["login"]}','{$_SESSION["compte"]["login"]}','".mysql_real_escape_string($_POST["titre"])."','".date_fr2db($_POST["debut"])."','".date_fr2db($_POST["fin"])."','normal',-1)";	
			$ts=date_db2ts(date_fr2db($_POST["debut"]));
		break;

		case "newtask":
			if((!isset($_POST["fin"]))||(!$_POST["fin"])||(!date_checkfr($_POST["fin"])))
				$_POST["fin"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			$query="insert into evenement(type,createur,login,titre,fin,priorite,duree) values('task','{$_SESSION["compte"]["login"]}','{$_SESSION["compte"]["login"]}','".mysql_real_escape_string($_POST["titre"])."','".date_fr2db($_POST["fin"])."','normal',-1)";	
			$ts=date_db2ts(date_fr2db($_POST["fin"]));
		break;

		case "newtaskp":
			if((!isset($_POST["debut"]))||(!$_POST["debut"])||(!date_checkfr($_POST["debut"])))
				$_POST["debut"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			if((!isset($_POST["fin"]))||(!$_POST["fin"])||(!date_checkfr($_POST["fin"])))
				$_POST["fin"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			if(date_db2ts(date_fr2db($_POST["debut"]))>date_db2ts(date_fr2db($_POST["fin"])))
				$_POST["fin"]=$_POST["debut"];
			$query="insert into evenement(type,createur,login,titre,debut,fin,priorite,duree) values('taskp','{$_SESSION["compte"]["login"]}','{$_SESSION["compte"]["login"]}','".mysql_real_escape_string($_POST["titre"])."','".date_fr2db($_POST["debut"])."','".date_fr2db($_POST["fin"])."','normal',-1)";	
			$ts=date_db2ts(date_fr2db($_POST["debut"]));
		break;

		case "newtaskb":
			if((!isset($_POST["fin"]))||(!$_POST["fin"])||(!date_checkfr($_POST["fin"])))
				$_POST["fin"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			$query="insert into evenement(type,createur,login,titre,fin,priorite,duree) values('taskb','{$_SESSION["compte"]["login"]}','{$_SESSION["compte"]["login"]}','".mysql_real_escape_string($_POST["titre"])."','".date_fr2db($_POST["fin"])."','normal',-1)";	
			$ts=date_db2ts(date_fr2db($_POST["fin"]));
		break;

		case "newtaska":
			if((!isset($_POST["debut"]))||(!$_POST["debut"])||(!date_checkfr($_POST["debut"])))
				$_POST["debut"]=date("d/m/Y",$CALPARAMS["date"]["ts"]);
			$query="insert into evenement(type,createur,login,titre,debut,priorite,duree) values('taska','{$_SESSION["compte"]["login"]}','{$_SESSION["compte"]["login"]}','".mysql_real_escape_string($_POST["titre"])."','".date_fr2db($_POST["debut"])."','normal',-1)";	
			$ts=date_db2ts(date_fr2db($_POST["debut"]));
		break;
		
		default:
			if(isset($_POST["reply"]))
			{
				$query="update invitation set reponse='$_POST[reponse]', commentaire='".mysql_real_escape_string($_POST["commentaire"])."' where ide=$CALPARAMS[iide] and qui='{$_SESSION["compte"]["login"]}' and porte='user'";
				mysql_query($query,$mysql_link);
				//die($query);
				$url="index.php?e=$CALPARAMS[iide]";
				$query="";
			}			
		}
		if($query)
		{
			mysql_query($query,$mysql_link);
			$ide=mysql_insert_id($mysql_link);
			if(!$titreok)
			{
				$query="update evenement set titre = concat(titre,' (',ide,')') where ide=$ide";
				mysql_query($query,$mysql_link);
			}
			$url="index.php?e=$ide&ts=$ts";
		}

	} //swicth detail
}

include("inc/replace.php");
?>
