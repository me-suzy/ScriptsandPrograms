<?php
// Configuration
include('config/config.php');

// Libraries
include('lib/bdDB.php');
include('lib/TableHandler.php');
include('lib/CategoriesHandler.php');
include('lib/EntriesHandler.php');
include('lib/RSSExporter.php');

// Controls
include('controls/CategoryControl.php');

$db = new bdDB( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

// Handlers
$categoriesHandler = new CategoriesHandler( $db );
$entriesHandler = new EntriesHandler( $db );
$rssExporter = new RSSExporter( RSS_TITLE, RSS_LINK, RSS_DESCRIPTION, RSS_BASE_URL );

// Initialize categories
$categoryControl = new CategoryControl( $categoriesHandler->getList() );

$list = $entriesHandler->getList();
if ( count($list) )
	foreach( $list as $item )
		$rssExporter->addItem( $categoryControl->getString( $item['category'] ), $item['date'], $item['title'] );

header('Content-type: text/xml');
$rssExporter->printRSS();	
?>