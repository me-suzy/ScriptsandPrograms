<?php
    // include the methods
    include("showlister_methods.inc.php");
    // parse the $_POST vars into something useful 
    $the_id = $_POST['show_id'];
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
    $result = mysql_query("select show_id, month, day, year, location, details, venue, artist_id 
        from $database_table where show_id = '$the_id'",$db)
        or die_now("<h2>Could not echo show to be edited</h2>");

    // echo the show into an editing form
    while($row = mysql_fetch_array($result)) {
        $the_month = $row["month"];
        $the_day = $row["day"];
        $the_year = $row["year"];
        $the_location = $row["location"];
        $the_details = $row["details"];
        $the_venue = $row["venue"];
        $the_artist_id = $row["artist_id"];
        echo("<div class=\"box\"><h3>showlister :: edit show</h3></div>
            <div class=\"box\">
            <form method=\"post\" action=\"edit_shows_02.php\">
            <table border=\"1\" width=\"80%\">
                <tr>
                    <td>show id</td>
                    <td>artist id</td>
                    <td>month</td>
                    <td>day</td>
                    <td>year</td>
                    <td>venue</td>
                    <td>location</td>   
                    <td>details</td>
                </tr>
                <tr>
                    <td><b>$the_id</b></td>
                    <td><input type=\"text\" name=\"artist\" value=\"$the_artist_id\" size=\"2\"></input></td>
                    <td><input type=\"text\" name=\"month\" value=\"$the_month\" size=\"2\"></input></td>
                    <td><input type=\"text\" name=\"day\" value=\"$the_day\" size=\"2\"></input></td>
                    <td><input type=\"text\" name=\"year\" value=\"$the_year\" size=\"4\"></input></td>
                            
                    <td><input type=\"text\" name=\"venue\" value=\"$the_venue\" size=\"12\"></input></td>
                    <td><input type=\"text\" name=\"location\" value=\"$the_location\"></input></td>
                    <td><input type=\"text\" name=\"details\" value=\"$the_details\"></input></td>
                </tr>
            </table><br>
            <input type=\"hidden\" name=\"show_id\" value=\"$the_id\">
            <input type=\"submit\" value=\"update show\">
            </form>
            </div>");
    }
    // for now, list table of artist ids + artist names
    // later, we'll echo it into a select box

    // connect to the RDBMS
    $db = mysql_connect("$site","$user","$pass") 
        or die_now("<h2>Could not connect to database server</h2><p>Check passwords and sockets</p>");

    // select the database
    mysql_select_db("$database",$db) 
        or die_now("<h2>Could not select database $database</h2><p>Check database name</p>");

    // query for the artist ids and anems
    $result = mysql_query("select artist_id, artist_name 
        from $database_table_artists
        order by artist_name",$db)
        or die_now("<h2>Could not echo artists table</h2>");

    // echo the results
    echo("<div class='box'><b>artist ids and names</b><br>");
    while($row = mysql_fetch_array($result)) {
        $the_artist_id = $row["artist_id"];
        $the_artist_name = $row["artist_name"];
    echo("$the_artist_id" . " = " . "$the_artist_name" . "<br>\n");
    }
    echo("</div>");
?>

<?php
  footer();
?>