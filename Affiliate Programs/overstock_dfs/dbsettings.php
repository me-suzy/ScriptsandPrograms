<html>
<head>
<style type="text/css">
body {font-family: arial}
</style></head>

<body bgcolor='#CCCCFF'>

<?php


$title="<?php \n //This page contains the database settings for your website \n";
$file = fopen( "includes/db.conf.php", "w" );
fwrite( $file, $title );
$setings="$" ."db_username='" .$_POST['username'] ."';\n";
$setings.="$" ."db_password='" .$_POST['password'] ."';\n";
$setings.="$" ."db_server='localhost';\n";
$setings.="$" ."db_type='mysql';\n";
$setings.="$" ."db_db='" .$_POST['database'] ."';\n";
$setings.="$" ."admin='" .$_POST['adusername'] ."';\n";
$setings.="$" ."adpass='" .$_POST['adpassword'] ."';\n";

fwrite( $file, $setings );
fwrite( $file, "?>" );

print "Database parameters set.  Press Continue <br><br>";

echo "<form action='dbsetup.php' method=post>";
echo "<input type='hidden' name='username' value='$_POST[adusername]'>";
echo "<input type='hidden' name='password' value='$_POST[adpassword]'>";
echo "<input type='submit' name='submit' value='Continue'>";
?>

</body>
 </html>
