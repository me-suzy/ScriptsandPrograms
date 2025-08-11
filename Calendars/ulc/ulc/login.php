<?
include_once("etc/config.php");
include_once("inc/start_session.php");
include_once("inc/mquotes.php");
include_once("inc/mysql_connexion.php");
include_once("inc/f_check_login.php");

$compte=FALSE;
if(isset($_POST["login"])&&isset($_POST["password"]))
	$compte=check_login($_POST["login"],$_POST["password"], $mysql_link);

if($compte)
{
	$_SESSION["compte"]=$compte;
	$_SESSION["compte"]["expiration"]=time()+session_life;

	if(isset($_POST["keep"])&&$_POST["keep"])
	{
		setcookie("login",$_POST["login"],time()+3600*24*30,"/");
		setcookie("password",$_POST["password"],time()+3600*24*30,"/");
		setcookie("keep",$_POST["keep"],time()+3600*24*30,"/");
	}
	else
	{
		setcookie("login","",time()+3600*24*30,"/");
		setcookie("password","",time()+3600*24*30,"/");
		setcookie("keep","",time()+3600*24*30,"/");
	}

}
else
{
	unset($_SESSION["compte"]);
}

$url="index.php";
include("inc/replace.php");
?>
