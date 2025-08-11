<?

if(isset($_SESSION["compte"]))
{
	if($_SESSION["compte"]["expiration"]>time())
		$_SESSION["compte"]["expiration"]=time()+session_life;
	else
		unset($_SESSION["compte"]);
}

?>
