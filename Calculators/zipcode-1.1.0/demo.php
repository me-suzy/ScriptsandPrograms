<?php

/*  
   DEMO for using the zipcode PHP class. By: Micah Carrick 
   Questions?  Comments?  Suggestions?  email@micahcarrick.com
*/


require_once('zipcode.class.php');      // zip code class


// Open up a connection to the database.  The sql required to create the MySQL
// tables and populate them with the data is in the /sql subfolder.  You can
// upload those sql files using phpMyAdmin or a MySQL prompt.  You will have to
// modify the below information to your database information.  
mysql_pconnect('localhost','micah','micah') or die(mysql_error()); 
mysql_select_db('test') or die(mysql_error()); 



// Below is an example of how to calculate the distance between two zip codes.

echo '<h3>A sample calculating the distance between 2 zip codes: 93001 and 60618</h3>';

$z = new zipcode_class;
$miles = $z->get_distance(93001, 60618);

if ($miles == -1) echo 'Error: '.$z->last_error;
else echo "Zip code <b>60618</b> is <b>$miles</b> miles away from <b>93001</b>.<br>";



// Below is an example of how to return an array with all the zip codes withing
// a range of a given zip code along with how far away they are.  The array's
// keys are assigned to the zip code and their value is the distance from the
// given zip code.  

echo '<h3>A sample getting all the zip codes withing a range: 12 miles from 93001</h3>';

$zips = $z->get_zips_in_range('93001', 12);

if (empty($zips)) echo 'Error: '.$z->last_error;
else {
   foreach ($zips as $key => $value) {
      echo "Zip code <b>$key</b> is <b>$value</b> miles away from <b>93001</b>.<br>";
   }
   // I'm also calculating how long the function takes to execute as it does take a 
   // bit of time as there are over 40,000 zip codes in the database.  Have any
   // suggestions on how I can speed it up?  Email me: email@micahcarrick.com
   // It's averaging about 3 seconds on my server.
   
   echo "<br><i>get_zips_in_range() executed in <b>".$z->last_time."</b> seconds.</i><br>";
}



// And one more example of using the class to simply get the information about
// a zip code.  You can then do whatever you want with it.  The array returned
// from the function has the database field names as the keys.  I just do a 
// couple string converstions to make them more readable.

echo '<h3>A sample getting details about a zip code: 60618</h3>';

$details = $z->get_zip_details('60618');

if (empty($details)) echo 'Error: '.$z->last_error;
else {
   foreach ($details as $key => $value) {
      $key = str_replace('_',' ',$key);
      $key = ucwords($key);
      echo "$key:&nbsp;$value<br>";
   } 
}
?>
