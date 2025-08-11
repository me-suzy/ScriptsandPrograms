<?ob_start();?>
<html>
<?
include ("menu.php");
include "dataaccess1.php" ;
$taskfield = "";
session_start();
if(session_is_registered("whossession")){
    if (($_SESSION['who'])=="user"){
    $username = $_SESSION['username'];
    //echo $username;
    dbConnect();
    $result = mysql_query("select * from ". $tbluser ." where username='" . $username . "'" .  mysql_error());
    if (!$result){
    die('Invalid query: ' . mysql_error());
    }

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (!empty($row['groupname'])){
    echo '<center><h3>Your group is : '.$row['groupname'].'</h3></center>';
    }else{ echo '<center><h3><font color="red">Your group is not assigned by admin.</font></h3></center>';}

    }

?>

<br><br><br>
</form>
<?include("base.php");
    }}else{
    print('<center><font color="red">Sorry, you do not have permission to access this page</font></center>');
   }
ob_end_flush();?>
</body>
</html>