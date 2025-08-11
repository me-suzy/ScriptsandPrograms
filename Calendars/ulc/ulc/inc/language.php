<?

$CALANGUAGE=array();

if(isset($_GET["lang"]))
	$lang=$_GET["lang"];
else if (isset($_COOKIE["lang"]))
	$lang=$_COOKIE["lang"];
else $lang=app_language;


setcookie("lang",$lang,time()+3600,"/");
@include_once("etc/local/lang-$lang.php");

setlocale(LC_ALL,$CALANGUAGE["LC_"]);

function lang_getw($ts)
{
	return (date("w",$ts)+7-CAL_FIRST_DAY_OF_WEEK)%7;
}

function lang_getwn($ts)
{
	$ts+=ONEDAY*(1-CAL_FIRST_DAY_OF_WEEK);
	return date("W",$ts);
}
?>
