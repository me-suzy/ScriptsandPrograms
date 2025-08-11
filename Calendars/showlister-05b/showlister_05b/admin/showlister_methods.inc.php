<?php

// a custom die() function
function die_now($args) {
    echo("<html>\n<head>\n\t<title>showlister :: error</title>\n\t");
    echo("<link rel='stylesheet' type='text/css' href='showlister.css'>\n");
    echo("</head>\n<body>\n");
    echo("<div class='box'>\n<h3>showlister :: error</h3>\n</div>\n\n");
    echo("<div class='box'>$args</div>\n\n");
    echo("</body>\n</html>\n");
    die();
}

// footer function
function footer() {
    echo("<div class='box'>\n\t<a href='index.php' title='add a show'>[add show]</a> | \n\t
          <a href='manage_shows.php' title='edit or delete shows'>[manage shows]</a>\n\t 
          :: <a href='add_artists.php'>[add artists]</a> | \n\t
          <a href='manage_artists.php'>[manage artists]</a>
          \n</div>\n\n");
    echo("</body>\n</html>\n");
}

// echo the current version
function showlister_version() {
    echo(".04b");   
}
?>