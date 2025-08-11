<?
include_once("etc/config.php");
include_once("inc/constantes.php");
include_once("inc/language.php");
include_once("inc/mquotes.php");
include_once("inc/start_session.php");
include_once("inc/check_session.php");
include_once("inc/mysql_connexion.php");
include_once("inc/f_date.php");
include_once("inc/f_field.php");
include_once("inc/calendrier.php");
?>
<html>
<head>
<title>Utter.Liable.Calendar</title>
<link type="text/css" rel="stylesheet" href="calstyles.css">
<script language="Javascript" src="calscripts.js"></script>
</head>
<body>

<table class=cadre>

<tr>
<td class=t colspan=2>
<? include("inc/topmenu.php"); ?>
</td>
</tr>

<tr>
<td class=d>
<? include("inc/calnav-mois.php"); ?>
<? include("inc/tacnav.php"); ?>
</td>
<td class=g>
<?
if($CALPARAMS["detail"]=="myc")
   include("inc/myc.php");
else
{
   include("inc/calnav-semaine.php");
   include("inc/detail.php");
}
?>
</td>
</tr>
</table>
<? /*
<pre>
<? print_r($PLANNING); ?>
<? print_r($CALENDRIERS); ?>
<? print_r($EVENEMENTS); ?>
<? print_r($CALPARAMS); ?>
<? print_r($TASKS); ?>
<? echo date("W",$CALPARAMS["date"]["ts"]); ?>.
<? echo lang_getwn($CALPARAMS["date"]["ts"]); ?>
</pre>
*/ ?>
</body>
</html>
