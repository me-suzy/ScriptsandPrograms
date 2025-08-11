<?
session_start();
if(session_is_registered("whossession"))
{
  $_SESSION['who']="";
  session_destroy();
  header('Location:index.php');

}
?>

