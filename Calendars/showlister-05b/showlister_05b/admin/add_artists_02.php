<?php
    // include the methods
    include("showlister_methods.inc.php");

    // parse the $_POST vars into something useful 
    // and check for nulls on required fields
    if ($_POST['artist_name']) {
        $name = $_POST['artist_name'];
    } else {
        die_now("<h3>Sorry</h3><p>Artist name is a required field. Use your browser 'back' button to fix this.</a></p>");       
    }
    $email = $_POST['artist_email'];
    $url = $_POST['artist_url'];
    $phone = $_POST['artist_phone'];
?>
<html>
<head>
    <title>showlister :: add artist [2]</title>
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

    // add new show to the database
    $result = mysql_query("insert into $database_table_artists (artist_id, artist_name, artist_email, artist_url, artist_phone)
        values(null,'$name','$email','$url','$phone')",$db) 
        or die_now("<h2>Could not add artist to database table</h2><p>Check database structure</p>");

    // get the show_id for the previous insert query.  We'll need it 
    // so we can drag the entry back out    
    $last_artist_id = mysql_insert_id();

    // echo out the most recent addition, for error checking
    $result = mysql_query("select artist_id, artist_name, artist_email, artist_url, artist_phone 
        from $database_table_artists where artist_id = $last_artist_id",$db)
        or die_now("<h2>Could not echo most recent artist</h2>");
    
//    while($i = mysql_fetch_row($result)) {
//        echo($i[1] . "/"); // month
//        echo($i[2] . "/"); // day
//        echo($i[3] . " "); // year
//    }

    while($row = mysql_fetch_array($result)) {
        $the_artist_id = $row["artist_id"];
        $the_artist_name = $row["artist_name"];
        $the_artist_email = $row["artist_email"];
        $the_artist_url = $row["artist_url"];
        $the_artist_phone = $row["artist_phone"];
        echo("<div class='box'><h3>showlister :: latest entry</h3></div>
            <div class='box'>
              <table width='100%'>
                <tr>
                  <td>id</td>
                  <td>name</td>
                  <td>email</td>
                  <td>url</td>
                  <td>phone</td>
                </tr>
                <tr>
                  <td>$the_artist_id</td>
                  <td>$the_artist_name</td>
                  <td>$the_artist_email</td>
                  <td>$the_artist_url</td>
                  <td>$the_artist_phone</td>
                </tr>
              </table>
            </div>");
        // echo("$the_month" . "/" . "$the_day" . "/" . "$the_year " . "$the_venue $the_location $the_details");
    }
?>

<?php
  footer();
?>