<?
if($admincheck == 1){
$query = $database->query("SELECT * FROM users WHERE uid = '".$_SESSION['uid']."'");
$user = $database->fetch_array($query);
if($user['admin'] < 1){
echo "<b>You are not permitted here. Please leave.</b>";
exit();
}
}
if($modcheck == 1){
$query = $database->query("SELECT * FROM users WHERE uid = '".$_SESSION['uid']."'");
$user = $database->fetch_array($query);
if($user['mod'] < 1){
echo "<b>You are not permitted here. Please leave.</b>";
exit();
}
}
?>