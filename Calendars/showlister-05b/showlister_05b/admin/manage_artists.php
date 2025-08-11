<?php
    // include the methods
    include("showlister_methods.inc.php");
?>
<html>
<head>
    <title>showlister :: manage artist</title>
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

    // select all the artists in the database
    $result = mysql_query("select artist_id, artist_name, artist_email, artist_url, artist_phone 
        from $database_table_artists order by artist_name",$db) 
        or die_now("<h2>Could not select artists</h2>");

    // output the current artists        
    echo("<div class='box'>\n<h3>showlister :: manage artists</h3>\n</div>\n<div class='box'>\n");
    echo("<table border='1' width='80%'>\n");
    echo("\t<tr>\n\t\t<td>id</td>\n\t\t<td>name</td>\n\t\t<td>email</td>\n\t\t<td>url</td>\n\t\t\n\t\t<td>phone</td>\n\t\t<td>edit</td>\n\t\t<td>delete</td>\n\t</tr>\n");
    while($row = mysql_fetch_array($result)) {
        $the_id = $row["artist_id"];
        $the_name = $row["artist_name"];
        $the_email = $row["artist_email"];
        $the_url = $row["artist_url"];
        $the_phone = $row["artist_phone"];

        // include the edit form
        echo("\n\t<form method='post' action='edit_artists.php'>\n");
        echo("\t<tr>\n\t\t<td>$the_id</td>\n");
        echo("\t\t<td>" . "$the_name" . "</td>\n");
        echo("\t\t<td><a href=\"mailto:$the_email\">" . "$the_email" . "</a></td>\n");
        echo("\t\t<td><a href=\"$the_url\">" . "$the_url" . "</a></td>\n");
        echo("\t\t<td>" . "$the_phone" . "</td>\n");
        echo("\t\t<td><input type='submit' value='edit'></td>\n");
        echo("\t\t<input type='hidden' name='artist_id' value='$the_id'>\n");
        echo("\t</form>\n");
        // include the delete form
        echo("\t<form method='post' action='delete_artist.php'>\n");
        echo("\t\t<td><input type='submit' value='del'></td>\n");
        echo("\t\t<input type='hidden' name='artist_id' value='$the_id'>\n");
        echo("\t</form>\n");
        echo("\t</tr>\n");
    }
    echo("</table>\n</div>\n");
?>
<?php
  footer();
?>