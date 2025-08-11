<?php
    // include the methods
    include("showlister_methods.inc.php");
?>
<html>
<head>
    <title>showlister :: manage shows</title>
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

    // select all the shows in the database
//    $result = mysql_query("select show_id, month, day, year, location, details, venue, artist_id
//        from $database_table order by year, month, day DESC",$db) 
//        or die_now("<h2>Could not select shows</h2>");

    $result = mysql_query("select $database_table.show_id, $database_table.month, $database_table.day, $database_table.year, $database_table.location, $database_table.details, $database_table.venue, $database_table.artist_id, $database_table_artists.artist_id, $database_table_artists.artist_name 
        from $database_table, $database_table_artists 
        where $database_table.artist_id = $database_table_artists.artist_id
        order by artist_name, year, month, day",$db) 
        or die_now("<h2>Could not select shows</h2>");

    // output the current shows        
    echo("<div class='box'>\n<h3>showlister :: manage shows</h3>\n</div>\n<div class='box'>\n");
    echo("<table border='1' width='95%'>\n");
    echo("\t<tr>\n\t\t<td>show id</td>\n\t\t<td>artist id</td>\n\t\t\n\t\t<td>artist name</td><td>date</td>\n\t\t<td>venue</td>\n\t\t<td>location</td>\n\t\t<td>details</td>\n\t\t<td>edit</td>\n\t\t<td>delete</td>\n\t</tr>\n");
    while($row = mysql_fetch_array($result)) {
        $the_id = $row["show_id"];
        $the_month = $row["month"];
        $the_day = $row["day"];
        $the_year = $row["year"];
        $the_location = $row["location"];
        $the_details = $row["details"];
        $the_venue = $row["venue"];
        $the_artist_id = $row["artist_id"];
        $the_artist_name = $row["artist_name"];

        // include the edit form
        echo("\n\t<form method='post' action='edit_shows.php'>\n");
        echo("\t<tr>\n");
        echo("\t\t<td>$the_id</td>");
        echo("\n\t\t<td>$the_artist_id</td>\n");
        echo("\t\t<td>" . "$the_artist_name" . "</td>\n");
        echo("\t\t<td>" . "$the_month" . "/" . "$the_day" . "/" . "$the_year" . "</td>\n");
        echo("\t\t<td>" . "$the_venue" . "</td>\n");
        echo("\t\t<td>" . "$the_location" . "</td>\n");
        echo("\t\t<td>" . "$the_details" . "</td>\n");
        echo("\t\t<td><input type='submit' value='edit'></td>\n");
        echo("\t\t<input type='hidden' name='show_id' value='$the_id'>\n");
        echo("\t</form>\n");
        // include the delete form
        echo("\t<form method='post' action='delete_show.php'>\n");
        echo("\t\t<td><input type='submit' value='del'></td>\n");
        echo("\t\t<input type='hidden' name='show_id' value='$the_id'>\n");
        echo("\t</form>\n");
        echo("\t</tr>\n");
    }
    echo("</table>\n</div>\n");
?>
<?php
  footer();
?>