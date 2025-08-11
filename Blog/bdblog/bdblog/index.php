<?php
// register_globals
import_request_variables('gp');

// Configuration
include('config/config.php');

// Libraries
include('lib/bdDB.php');
include('lib/TableHandler.php');
include('lib/CategoriesHandler.php');
include('lib/EntriesHandler.php');

$db = new bdDB( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

// Handlers
$categoriesHandler = new CategoriesHandler( $db );
$entriesHandler = new EntriesHandler( $db );

// Controls
include('controls/DateControl.php');
include('controls/PagerControl.php');
include('controls/CategoryControl.php');

// Widgets
include('widgets/LinkBox.php');
include('widgets/SearchBox.php');
include('widgets/EntryList.php');
include('widgets/DateBrowser.php');

$dateBrowser = new DateBrowser();

// Content
// Probabilities:
// - Nothing
// - $date ( NewEntry, EntryUpdate, DateBrowser )
// - $month, $year ( DateBrowser )
// - $text, $category ( SearchBox )

if ( isset($date) )
{
	$extra = 'date='.$date.'&page='.$page;
	$list = $entriesHandler->getListByDate( $date, (int)($page) );
	$dateBrowser->setDate( $date );
	list( $year, $month, $day ) = explode( '-', $date );
}
else if ( isset($year) && isset($month) )
{
	$extra = 'year='.$year.'&month='.$month.'&page='.$page;
	$list = $entriesHandler->getListByMonth( $year, $month, (int)($page) );
	$dateBrowser->setMonth( $year, $month );
}
else if ( isset( $text ) && isset( $category ) )
{
	$list = $entriesHandler->search( $text, $category, (int)($page) );
	if ( get_magic_quotes_gpc() )
		$text = stripslashes( $text );
	$extra = 'text='.urlencode($text).'&category='.$category.'&page='.$page;
}
else
{
	$extra = 'page='.$page;
	$today = getdate();
	$list = $entriesHandler->getListByMonth( $today['year'], $today['mon'], (int)($page) );
}

if ( !isset($month) || !isset($year) )
{
	$today = getdate();
	$month = $today['mon'];
	$year = $today['year'];
}

// Initialize widgets
$linkBox = new LinkBox( $extra );
$searchBox = new SearchBox( new CategoryControl($categoriesHandler->getList(), 'category', $category ), $text );

$monthlyList = $entriesHandler->getDayListByMonth( $year, $month );
if ( count( $monthlyList ) )
	foreach( $monthlyList as $item )
		$dateBrowser->addDate( $item['date'] );
		
// Minimum date
$minDate = $entriesHandler->getMinDate();
list( $year, $month, $day ) = explode('-',$minDate);
$dateBrowser->setMinYear( $year );

// Maximum date
$maxDate = $entriesHandler->getMaxDate();
list( $year, $month, $day ) = explode('-',$maxDate);
$dateBrowser->setMaxYear( $year );
	
$contents = new EntryList( $list, new CategoryControl( $categoriesHandler->getList(), '' ), $extra );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>bd:blog</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" valign="top" class="ListArea"><table width="100%" border="0" cellspacing="5">
        <tr> 
          <td valign="top"> 
            <? $contents->printWidget() ?>
          </td>
        </tr>
      </table></td>
    <td width="150" valign="top"> 
      <table width="100%" height="492" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="209"><img src="images/top.jpg" width="150" height="209"></td>
        </tr>
        <tr> 
          <td background="images/bottom.jpg" valign="top">
		  <? $searchBox->printWidget() ?>
		  <p>
		  <? $dateBrowser->printWidget() ?>
		  <p>
		  <? $linkBox->printWidget() ?>
		  </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
