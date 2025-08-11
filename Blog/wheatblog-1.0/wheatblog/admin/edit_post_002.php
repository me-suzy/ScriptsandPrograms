<?php
//
// File:    admin/add_post_002.php
// License: GNU GPL
// Purpose: Receives the data from edit_post.php and updates entry with it
//					very similar to add_post.php, except for the SQL statement.
//
require_once('../settings.php');

if ( ! isAdmin() )
	HariKari('You are not the admin.');



$page_title = 'Post Successfully Edited';
include_once("$wb_inc_dir/header.php");


	// parse the passed variables
	$the_id       = $_POST['the_id'];
	$the_day      = $_POST['the_day'];
	$the_month    = $_POST['the_month'];
	$the_date     = $_POST['the_date'];
	$the_year     = $_POST['the_year'];
	$the_category = $_POST['the_category'];
	$the_showpref = $_POST['the_showpref'];
	$the_locked   = $_POST['the_locked'];
	$the_title    = $_POST['the_title'];

	# remedy for db_quote problem
	$the_body     = DB_quote($_POST['the_body']);

    # added to correctly show the post body 
	$show_body    = $_POST['the_body'];
	
	
	// Connect to the RDBMS and select the database.
	$db = DB_connect($site, $user, $pass);
	DB_select_db($database, $db);

	// insert post into the database
	$result = DB_query("update $tblPosts
		set day = '$the_day', month = '$the_month', date = '$the_date', 
		year = '$the_year', category = '$the_category', title = '$the_title', 
		body = $the_body, locked = '$the_locked', showpref = '$the_showpref'
		where id = '$the_id'",$db);

  // parse out the category id into its string value
		$result2 = DB_query("select *   
			from $tblCategories   
			where id = '$the_category'", $db);

		while($row2 = DB_fetch_array($result2))
			$the_category_name = $row2["category"];
        

		   
    // Post body
		# removed interpolation	
		# inserted markup for better formatting control	
        
		echo '<div class="subcontent">'."\n";
		echo '<div class="post-heading">'."\n"; # heading is important, needs to be seperate
		echo '<h3 class="post-title">'.$the_title.'</h3>'."\n";
		echo '<h4 class="post-date">'.$the_day.', '.$the_month.'.'.$the_date.'.'.$the_year.'</h4>'."\n";
		echo '</div>'."\n";  # closes div.post-heading
		echo '<div class="post-body">'.$show_body.'</div>'."\n\n";

		// Post category
		# removed interpolation
    		
		echo '<div class="post-menu">'."\n".'<ul class="postnav">'."\n"; #links are now unordered list
		
		# only difference from  "universal" post display is the ommission of comments and the addition of the show preference.
		
		if ($the_showpref == 1) { 
		
		echo '<li>This post is currently <strong>visible</strong>. </li>'."\n"; 
		
		} else {		
		
		echo '<li>This post is currently <strong>hidden</strong> .</li>'."\n";
		
		}
		
		echo '</ul>'."\n".'</div>'."\n";  # closes list and div.post-menu
		echo '</div>'."\n\n"; # closes div.indent

	


	include("$wb_inc_dir/rss.php");
	include("$wb_inc_dir/footer.php");
?>
