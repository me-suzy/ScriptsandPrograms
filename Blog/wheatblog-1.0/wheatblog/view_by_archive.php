<?php
//
// File:    view_by_archive.php
// License: GNU GPL
//
require_once('./settings.php');
$page_title = ':: archive view';
include_once("$wb_inc_dir/header.php");

	// parse the passed vars into something useful 
	// also check for nulls
	$the_year = $_GET['the_year'];
	$the_month = $_GET['the_month'];

	// Connect to the RDBMS and select the database.
	$db = DB_connect($site, $user, $pass);
	DB_select_db($database, $db);

    // select recent posts in the database
    $result = DB_query("select * 
        from $tblPosts
        where year = '$the_year' and month = '$the_month' 
        order by year DESC, month DESC, date DESC, id DESC", $db);

	// output the current entries         

	echo("<div class='indent2'>\n");
	echo("<span class='cnt-subhead'>Filter: View by Archive</span><br>\n");
	echo("[archived entires for : " . "$the_month" . "." . "$the_year" . "] ");
	echo("[<a href='$blog_index_page_name']>remove</a>]\n");
	echo("</div>\n");

    while($row = DB_fetch_array($result)) {
        $the_id = $row["id"];
        $the_day = $row["day"];
        $the_month = $row["month"];
        $the_date = $row["date"];
        $the_year = $row["year"];
        $the_category = $row["category"];
        
            // parse out the category id into its string value
            $result2 = DB_query("select *   
                from $tblCategories
                where id = '$the_category'", $db);

            while($row2 = DB_fetch_array($result2)) {
                $the_category_name = $row2["category"];
            }
        
        $the_showpref = $row['showpref'];
        $the_title    = $row['title'];
        $the_body     = $row['body'];
        $comments     = $row['comments'];

        // post
        echo("<div class='indent'>\n");
        echo("<span class='cnt-subhead'>$the_day" . ", " . "$the_month" . "." . "$the_date" . "." . "$the_year" . " :: " . "$the_title" . "</span><br>\n");
        echo("$the_body" . "<br>\n");
        echo("[<a href='view_by_category.php?the_category=$the_category'" . "'>" . "$the_category_name" . "</a>] ");
        echo("<!-- [" . "<a href='view_by_permalink.php?the_id=$the_id'" . "'>id: " . "$the_id" . "</a>] -->\n");
        echo("[" . "<a href='view_by_permalink.php?the_id=$the_id'" . "'>" . "comments ($comments)" . "</a>]\n"); 
        echo("</div>\n\n");
    }


include_once("$wb_inc_dir/footer.php");
?>
