<?php
    // include the methods
    include("showlister_methods.inc.php");
    // parse the $_POST vars into something useful 
    $the_id = $_POST['artist_id'];
?>
<html>
<head>
    <title>showlister :: edit show</title>
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

    // query for the show selected for editing in manage_shows.php
    $result = mysql_query("select artist_id, artist_name, artist_email, artist_url, artist_phone  
        from $database_table_artists where artist_id = '$the_id'",$db)
        or die_now("<h2>Could not select artist to be edited</h2>");

    // echo the show into an editing form
    while($row = mysql_fetch_array($result)) {
        $the_artist_id = $row["artist_id"];
        $the_artist_name = $row["artist_name"];
        $the_artist_email = $row["artist_email"];
        $the_artist_url = $row["artist_url"];
        $the_artist_phone = $row["artist_phone"];
        echo("<div class='box'><h3>showlister :: edit artist</h3></div>
            <div class='box'>
            <form method='post' action='edit_artists_02.php'>
            <table border='1' width='80%'>
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>email</td>
                    <td>url</td>
                    <td>phone</td>
                </tr>
                <tr>
                    <td><b>$the_id</b></td>
                    <td><input type='text' name='name' value='$the_artist_name'></input></td>
                    <td><input type='text' name='email' value='$the_artist_email'></input></td>
                    <td><input type='text' name='url' value='$the_artist_url'></input></td>
                    <td><input type='text' name='phone' value='$the_artist_phone'></input</td>
                </tr>
            </table>
            <br>
            <input type='hidden' name='artist_id' value='$the_id'>
            <input type='submit' value='update artist'>
            </form>
            </div>");
    }

?>

<?php
  footer();
?>