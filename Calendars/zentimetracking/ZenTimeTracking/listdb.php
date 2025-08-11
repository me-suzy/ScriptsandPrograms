<html>

<head>
 <title>Zen Time Tracking</title>
<script language="javascript">

function call(a,b,c,d)

{
parent.document.forms[0].dbname.value = d ;
parent.document.forms[0].dbpassword.value = c ;
parent.document.forms[0].dbusername.value = b ;

parent.document.forms[0].dbservername.value = a ;

}

</script>

</head>

<body>



<form method = "post"><?php

include "common_db.php" ;
if ($dbhost){
echo('<b>Click to choose existing Database</b> ('. $dbhost . ')<br>');
}


$link_id  = db_connect();
if ($link_id != 0)
{
$list =   mysql_list_dbs($link_id) ;

while ( $row = mysql_fetch_object($list) )  

{

?>
<a href = "listdb.php" onClick="call('<?php echo $dbhost;?>','<?php echo $dbusername;?>','<?php echo $dbuserpassword;?>','<? echo $row->Database; ?>')" ><?php

echo $row->Database ;

echo "<br>" ;

?>

</a>

<?php

}
}
?>

</form>

</body>

</html>



