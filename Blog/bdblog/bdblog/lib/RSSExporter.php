<?php
/**
 This is a class to help export the bd:blog items in RSS 2.0 - compatible format
 
 Barebones RSS 2.0 implementation
*/
class RSSExporter
{
	// Mandatory fields
	var $title;			// Channel title
	var $link;			// channel website
	var $description;	// Channel description
	
	var $baseUrl;		// Base URL to form links to entries
	
	var $items = array();
	
	function RSSExporter( $title, $link, $description, $baseUrl )
	{
		$this->title = $title;
		$this->link = $link;
		$this->baseUrl = $baseUrl;
		
		$this->description = $description;
	}
	
	function addItem( $category, $date, $title )
	{
		$this->items[] = array
		(
			'category' => $category,
			'pubDate' => $date,
			'title' => $title
		);
	}
	
	function printRSS()
	{
		// 'echo' it to avoid confusion
		echo '<?xml version="1.0" ?>'."\n";
	?><rss version="2.0">
	<channel>
		<title><?php echo $this->title ?></title>
		<link><?php echo $this->link ?></link>
		<description><?php echo $this->description ?></description>
		<?php
		foreach( $this->items as $item )
		{
			list( $year, $month, $day ) = explode( '-', $item['pubDate'] );
		?><item>
			<category><?php echo $item['category'] ?></category>
			<pubDate><?php echo date( 'r', mktime( 0, 0, 0, $month, $day, $year ) ) ?></pubDate>
			<title><?php echo $item['title'] ?></title>
			<link><?php echo $this->baseUrl.'?date='.$item['pubDate'] ?></link>
		</item>
		<?php
		}
		?></channel>
</rss>
	<?
	}
}
?>