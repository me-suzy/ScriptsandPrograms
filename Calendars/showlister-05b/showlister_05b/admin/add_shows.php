<?php
    // include the methods
    include("showlister_methods.inc.php");

    // parse the $_POST vars into something useful 
    // and check for nulls on required fields

    // if they try adding a show w/o first adding an artist, show is 
    // assigned to artist id zero.  Use @ to suppress the notice
    if (@$_POST['artist']) {
        $artist = $_POST['artist'];
    } else {
        die_now("Error:  you need to <a href='add_artists.php'>create</a> at least one artist");
    }
    $month = $_POST['month'];
    $day = $_POST['day'];
    $year = $_POST['year'];
    if ($_POST['venue']) {
        $venue = $_POST['venue'];
    } else {
        die_now("<h3>Sorry</h3><p>Venue is a required field. Use your browser 'back' button to fix this.</a></p>");
    }
    if ($_POST['location']) {
        $location = $_POST['location'];
    } else {
        die_now("<h3>Sorry</h3><p>Location is a required field. Use your browser 'back' button to fix this.</a></p>");       
    }
    $details = $_POST['details'];
?>
<html>
<head>
    <title>showlister :: add shows [2]</title>
    <link rel="stylesheet" type="text/css" href="showlister.css">
</head>
<body>

<!-- testing -->
<?php echo("artist = " . $artist . "<br />"); ?>

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
    $result = mysql_query("insert into $database_table (show_id, month, day, year, location, details, venue, artist_id) 
        values(null,'$month','$day','$year','$location','$details','$venue','$artist')",$db) 
        or die_now("<h2>Could not add show to database table</h2><p>Check database structure</p>");

    // get the show_id for the previous insert query.  We'll need it 
    // so we can drag the entry back out    
    $last_show_id = mysql_insert_id();

    // echo out the most recent addition, for error checking
    $result = mysql_query("select show_id, month, day, year, location, details, venue, artist_id 
        from $database_table where show_id = $last_show_id",$db)
        or die_now("<h2>Could not echo most recent show</h2>");

    while($row = mysql_fetch_array($result)) {
        $the_month = $row["month"];
        $the_day = $row["day"];
        $the_year = $row["year"];
        $the_location = $row["location"];
        $the_details = $row["details"];
        $the_venue = $row["venue"];
        $the_artist_id = $row["artist_id"];
        echo("<div class='box'><h3>showlister :: latest entry</h3></div>
            <div class='box'>
            <table border='1' width='80%'>
                <tr>
                    <td>artist id</td>
                    <td>date</td>
                    <td>venue</td>
                    <td>location</td>   
                    <td>details</td>
                </tr>
                <tr>
                    <td>$the_artist_id</td>
                    <td>$the_month/$the_day/$the_year</td>
                    <td>$the_venue</td>
                    <td>$the_location</td>
                    <td>$the_details</td>
                </tr>
            </table>
            </div>");
        // echo("$the_month" . "/" . "$the_day" . "/" . "$the_year " . "$the_venue $the_location $the_details");
    }
?>

<?php
  footer();
?>