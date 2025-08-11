<?php
/**
 Main configuration
*/
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','bdblog');

// Tables
define('CATEGORIES_TABLE','categories');
define('ENTRIES_TABLE','entries');

// Authentification
define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','admin');

define('PER_PAGE',5);

// Information for RSS feed
define( 'RSS_TITLE', 'bd:blog' );
define( 'RSS_LINK', 'http://bd/bdblog/' );
define( 'RSS_DESCRIPTION', 'bd:blog entries' );
define( 'RSS_BASE_URL', 'http://bd/bdblog/index.php' );
?>