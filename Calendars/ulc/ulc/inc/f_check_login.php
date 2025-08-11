<?
function check_login($login, $password, $mysql_link)
{
	$query="select * from compte where login='".mysql_real_escape_string($login)."' and password = binary '".mysql_real_escape_string($password)."'";		
	$results=mysql_query($query,$mysql_link);
	$compte=mysql_fetch_array($results);
	mysql_free_result($results);
	if(!$compte) return FALSE;
	return $compte;
}
?>
