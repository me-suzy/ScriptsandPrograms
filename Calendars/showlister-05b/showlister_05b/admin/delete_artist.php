<?php
    // include the methods
    include("showlister_methods.inc.php");
    // parse the $_POST vars into something useful 
    $the_id = $_POST['artist_id'];
?>
<html>
<head>
    <title>showlister :: delete show</title>
    <link rel="stylesheet" type="text/css" href="showlister.css">
</head>
<body>

<?php
    // read in the connection settings
    require("showlister_settings.inc.php");

    // connect to the RDBMS
    $db = mysql_connect("$site","$user","$pass") 
        or die_now("<h2>Could not connect to database server</h2><p>Check passwords and sockets</p>");

    // select the database
    mysql_select_db("$database",$db) 
        or die_now("<h2>Could not select database $database</h2><p>Check database name</p>");

    // delete the show in question
    $result = mysql_query("delete from $database_table_artists 
        where artist_id = '$the_id'",$db) 
        or die_now("<h2>Could not delete artist</h2>");

    // echo out a status report and show id
    echo("<div class='box'>\n\t<h3>showlister :: delete artist</h3>\n</div>\n");
    echo("<div class='box'>artist (id='$the_id') deleted</div>\n");
?>
<?php
  footer();
?>