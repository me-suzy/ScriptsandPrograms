<?php
/********************************************************************
Associate-O-Matic v2.6
http://www.associate-o-matic.com

Justin Mecham
info@associate-o-matic.com

DESCRIPTION
Default configuration settings

Copyright (c) 2003-2006 Associate-O-Matic. All Rights Reserved.
********************************************************************/

// *** DO NOT MODIFY ANYTHING BELOW THIS LINE UNLESS DIRECTED, AS ASSOCIATE-O-MATIC MAY NOT WORK PROPERLY ***

// AmazonStoreType
$cfg['AmazonStoreType']['section'] = "0";
$cfg['AmazonStoreType']['list'] = Array('Amazon.com' 	=> 'Amazon.com (United States)',
										'Amazon.co.uk'	=> 'Amazon.co.uk (United Kingdom)',
										'Amazon.ca'		=> 'Amazon.ca (Canada)',
										);
$cfg['AmazonStoreType']['type'] = "complexmenu";
$cfg['AmazonStoreType']['help'] = "Select the locale for your Amazon store";
$cfg['AmazonStoreType']['default'] = "Amazon.com";
$cfg['AmazonStoreType']['javascript'] = "submitForm";

// AmazonAssociateId
$cfg['AmazonAssociateId']['section'] = "0";
$cfg['AmazonAssociateId']['type'] = "text";
$cfg['AmazonAssociateId']['help'] = "Enter your Amazon Associate ID. <b>NOTE:</b> You would want to use the Associate ID from the locale you registered with... <a target=\"_blank\" href=\"http://associates.amazon.com\">Amazon.com</a>, <a target=\"_blank\" href=\"http://associates.amazon.co.uk\">Amazon.co.uk</a>, <a target=\"_blank\" href=\"http://associates.amazon.ca\">Amazon.ca</a>";
$cfg['AmazonAssociateId']['default'] = "associatomati-20";
$cfg['AmazonAssociateId']['required'] = TRUE;

// EcsVersion
$cfg['EcsVersion']['section'] = "20";
$cfg['EcsVersion']['type'] = "text";
$cfg['EcsVersion']['help'] = "Enter the ECS Version";
$cfg['EcsVersion']['default'] = "2005-09-15";
$cfg['EcsVersion']['required'] = TRUE;

// UrlRest
$cfg['UrlRest']['section'] = "20";
$cfg['UrlRest']['type'] = "text";
$cfg['UrlRest']['help'] = "Enter the URL for REST calls";
$cfg['UrlRest']['default'] = "http://webservices.amazon.com/onca/xml";
$cfg['UrlRest']['required'] = TRUE;

// UrlSoap
$cfg['UrlSoap']['section'] = "20";
$cfg['UrlSoap']['type'] = "text";
$cfg['UrlSoap']['help'] = "Enter the WSDL for SOAP calls";
$cfg['UrlSoap']['default'] = "http://webservices.amazon.com/AWSECommerceService/2005-09-15/US/AWSECommerceService.wsdl";
$cfg['UrlSoap']['required'] = TRUE;

// SortDefault
$cfg['SortDefault']['section'] = "-999";
$cfg['SortDefault']['required'] = TRUE;

// SORT: Amazon.com
$cfg['SortDefault']['list']['Amazon.com']['Apparel'] =
				  Array('salesrank'			=> 'Bestselling',
						'relevancerank' 	=> 'Featured Items',
						'-launch-date' 		=> 'Newest Arrivals',
						'sale-flag' 		=> 'On Sale',
						'pricerank' 		=> 'Price (Low to High)',
						'inverseprice'		=> 'Price (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Baby'] =
				  Array('salesrank'			=> 'Bestselling',
						'psrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);		
$cfg['SortDefault']['list']['Amazon.com']['Beauty'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'-launch-date' 		=> 'Newest Arrivals',
						'sale-flag' 		=> 'On Sale',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						);									
$cfg['SortDefault']['list']['Amazon.com']['Books'] =
				  Array('salesrank'			=> 'Bestselling',
						'relevancerank' 	=> 'Featured Items',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'pricerank' 		=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Classical'] =
				  Array('salesrank'			=> 'Bestselling',
						'psrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'orig-rel-date' 	=> 'Release Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['DigitalMusic'] =
				  Array('songtitlerank'		=> 'Most Popular',
						'uploaddaterank' 	=> 'Date Added',
						);
$cfg['SortDefault']['list']['Amazon.com']['DVD'] =
				  Array('salesrank'			=> 'Bestselling',
						'relevancerank' 	=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-video-release-date' 	=> 'Release Date (Newer to Older)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Electronics'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.com']['GourmetFood'] =
				  Array('salesrank'			=> 'Bestselling',
						'relevancerank' 	=> 'Featured Items',
						'launch-date' 		=> 'Newest Arrivals',
						'sale-flag' 		=> 'On Sale',
						'pricerank' 		=> 'Price (Low to High)',
						'inverseprice'		=> 'Price (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.com']['HealthPersonalCare'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'launch-date' 		=> 'Newest Arrivals',
						'sale-flag' 		=> 'On Sale',
						'pricerank' 		=> 'Price (Low to High)',
						'inverseprice'		=> 'Price (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Jewelry'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'launch-date' 		=> 'Newest Arrivals',
						'pricerank' 		=> 'Price (Low to High)',
						'inverseprice'		=> 'Price (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Kitchen'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Magazines'] =
				  Array('subslot-salesrank'	=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Miscellaneous'] =
				  Array('subslot-salesrank'	=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Music'] =
				  Array('salesrank'			=> 'Bestselling',
						'psrank' 			=> 'Featured Items',
						'artistrank'		=> 'Artist Name',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						'orig-rel-date'		=> 'Release Date (Newer to Older)',
						);
$cfg['SortDefault']['list']['Amazon.com']['MusicalInstruments'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'-launch-date' 		=> 'Newest Arrivals',
						'sale-flag' 		=> 'On Sale',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.com']['MusicTracks'] =
				  Array('titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['OfficeProducts'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.com']['OutdoorLiving'] =
				  Array('salesrank'			=> 'Bestselling',
						'psrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['PCHardware'] =
				  Array('salesrank'			=> 'Bestselling',
						'psrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.com']['PetSupplies'] =
				  Array('salesrank'			=> 'Bestselling',
						'+pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Photo'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Restaurants'] =
				  Array('relevance'			=> 'Featured Items',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Software'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.com']['SportingGoods'] =
				  Array('salesrank'			=> 'Bestselling',
						'relevancerank' 	=> 'Featured Items',
						'launch-date' 		=> 'Newest Arrivals',
						'sale-flag' 		=> 'On Sale',
						'pricerank' 		=> 'Price (Low to High)',
						'inverseprice'		=> 'Price (High to Low)',
						);					
$cfg['SortDefault']['list']['Amazon.com']['Tools'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Toys'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-age-min' 			=> 'Age (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.com']['VHS'] =
				  Array('salesrank'			=> 'Bestselling',
						'relevancerank' 	=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-video-release-date' 	=> 'Release Date (Newer to Older)',
						);					
$cfg['SortDefault']['list']['Amazon.com']['VideoGames'] =
				  Array('salesrank'			=> 'Bestselling',
						'pmrank' 			=> 'Featured Items',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.com']['Wireless'] =
				  Array('salesrank'			=> 'Bestselling',
						//'pmrank' 			=> 'Featured Items',
						'pricerank' 		=> 'Price (Low to High)',
						'inverse-pricerank' => 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.com']['WirelessAccessories'] =
				  Array('salesrank'			=> 'Bestselling',
						'psrank' 			=> 'Featured Items',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);

// SORT: Amazon.co.uk				
$cfg['SortDefault']['list']['Amazon.co.uk']['Books'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'pricerank' 		=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'pubdate' 			=> 'Publication Date (Older to Newer)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['DVD'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['Electronics'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['HealthPersonalCare'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['HomeGarden'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);						
$cfg['SortDefault']['list']['Amazon.co.uk']['HomeGarden'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);										
$cfg['SortDefault']['list']['Amazon.co.uk']['Kitchen'] =
				  Array('salesrank'			=> 'Bestselling',
				  		'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);				
$cfg['SortDefault']['list']['Amazon.co.uk']['Music'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'inverse-pricerank' => 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);					
$cfg['SortDefault']['list']['Amazon.co.uk']['OutdoorLiving'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'-price' 			=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['Software'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);					
$cfg['SortDefault']['list']['Amazon.co.uk']['VideoGames'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['Toys'] =
				  Array('salesrank'			=> 'Bestselling',
						'price' 			=> 'Price (Low to High)',
						'-price'			=> 'Price (High to Low)',
						'mfg-age-min' 		=> 'Age (Low to High)',
						'-mfg-age-min' 		=> 'Age (High to Low)',
						);
$cfg['SortDefault']['list']['Amazon.co.uk']['VHS'] =
				  Array('salesrank'			=> 'Bestselling',
						'reviewrank' 		=> 'Reviews (High to Low)',
						'price' 			=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'-titlerank' 		=> 'Alphabetical (Z-A)',
						);				

// SORT: Amazon.ca				
$cfg['SortDefault']['list']['Amazon.ca']['Books'] =
				  Array('salesrank'			=> 'Bestselling',
						'pricerank' 		=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'daterank' 			=> 'Publication Date (Newer to Older)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.ca']['DVD'] =
				  Array('salesrank'			=> 'Bestselling',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);
$cfg['SortDefault']['list']['Amazon.ca']['Music'] =
				  Array('salesrank'			=> 'Bestselling',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						'orig-rel-date' 	=> 'Publication Date (Newer to Older)',
						);					
$cfg['SortDefault']['list']['Amazon.ca']['Software'] =
				  Array('salesrank'			=> 'Bestselling',
						'pricerank' 		=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'-daterank' 			=> 'Publication Date (Older to Newer)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						);					
$cfg['SortDefault']['list']['Amazon.ca']['VideoGames'] =
				  Array('salesrank'			=> 'Bestselling',
						'pricerank' 		=> 'Price (Low to High)',
						'inverse-pricerank'	=> 'Price (High to Low)',
						'titlerank' 		=> 'Alphabetical (A-Z)',
						//'-titlerank' 		=> 'Alphabetical (Z-A)',
						);				
$cfg['SortDefault']['list']['Amazon.ca']['VHS'] =
				  Array('salesrank'			=> 'Bestselling',
				        '-titlerank' 		=> 'Alphabetical (Z-A)',
						);							
										

// Categories
$cfg['Categories']['enhanced'] = TRUE;
$cfg['Categories']['section'] = "4";
$cfg['Categories']['type'] = "categories";
$cfg['Categories']['help'] = "<b>INSTRUCTIONS</b><br><b>1.</b> Enter your own unique Category ID (must contain lowercase letters and/or numbers)<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>NOTE:</b> This is the 'c' paramater that will appear in the URL (it was called 'mode' in versions prior to v2.5)<br><b>2.</b> Enter the Names for each<br><b>3.</b> Select the associated Amazon Category<br><b>4.</b> Leave the default browse node or enter a different one (must be associated with Amazon Category selected)<br><b>5.</b> Optionally, specify a default Keyword to fine-tune results at category level.<br><b>6.</b> Check/uncheck box if you want this category to use the SDK (Site Default Keyword) if specified<br><b>7.</b> Check/uncheck box if you want this category displayed as a Tab<br><b>8.</b> Select the Display Order (1 is first and so on)<br><br><b>NOTES:</b><br>&#149; To add categories enter the number you want to add below and click the Go button. To delete a category, clear out the Name and click Save All Settings<br><br>&#149; Browse Nodes in green are using the default Browse Node. Browse Nodes in Grey are using something other than the current default Browse Node. To get back to the original default Browse Node for a category, simply delete the node and leave the field. It will auto populate back to the current default Browse Node.<br><br>&#149; All applicable related categories and subcategories are automatically displayed inside the associated Related Category and Subcategory Boxes if you choose to display them.<br><br>";
$cfg['Categories']['required'] = TRUE;


// Categories: Amazon.com
// Amazon.com: Apparel
$cfg['Categories']['list']['Amazon.com']['Apparel']['name'] = "Apparel";
$cfg['Categories']['list']['Amazon.com']['Apparel']['node'] = "1036682";
//$cfg['Categories']['list']['Amazon.com']['Apparel']['node'] = "1087804";
$cfg['Categories']['list']['Amazon.com']['Apparel']['nodes']['1036682'] = 
		Array('1040660'	=>  'Women',
			  '1040658'	=>  'Men',
			  '1040662'	=>  'Kids & Baby',
			  );
/*
// Amazon.com: Automotive
$cfg['Categories']['list']['Amazon.com']['Automotive']['name'] = "Automotive";
$cfg['Categories']['list']['Amazon.com']['Automotive']['node'] = "553294";
$cfg['Categories']['list']['Amazon.com']['Automotive']['nodes']['553294'] = 
		Array('12991241'=>  'Car Care',
			  '3752971'	=>  'Car & Truck Accessories',
			  '12991751'=>  'Fluids & Lubricants ',
			  );
*/
// Amazon.com: Baby
$cfg['Categories']['list']['Amazon.com']['Baby']['name'] = "Baby";
$cfg['Categories']['list']['Amazon.com']['Baby']['node'] = "540744";
$cfg['Categories']['list']['Amazon.com']['Baby']['nodes']['540744'] = 
		Array('540996'  =>  'Brands',
			  '542460'  =>  'Activity',
			  '541558'  =>  'Gear',
			  );
// Amazon.com: Beauty
$cfg['Categories']['list']['Amazon.com']['Beauty']['name'] = "Beauty";
//$cfg['Categories']['list']['Amazon.com']['Beauty']['node'] = "11055981"; 
$cfg['Categories']['list']['Amazon.com']['Beauty']['node'] = "3760911";
$cfg['Categories']['list']['Amazon.com']['Beauty']['nodes']['3760911'] =
		Array('11055991' => 'Bath & Shower',
			  '11056591' => 'Fragrance',
			  '11057241' => 'Hair Care',
			  );
// Amazon.com: Books
$cfg['Categories']['list']['Amazon.com']['Books']['name'] = "Books";
$cfg['Categories']['list']['Amazon.com']['Books']['node'] = "1000";
//$cfg['Categories']['list']['Amazon.com']['Books']['node'] = "287147";
//$cfg['Categories']['list']['Amazon.com']['Books']['node'] = "283155";
//$cfg['Categories']['list']['Amazon.com']['Books']['node'] = "13448131";
$cfg['Categories']['list']['Amazon.com']['Books']['nodes']['1000'] =
		Array('3' 		=>	'Business',
			  '17' 		=>	'Fiction',
			  '53' 		=>	'Nonfiction',
			  );
			  
/*
// Amazon.com: Classical
$cfg['Categories']['list']['Amazon.com']['Classical']['name'] = "Classical";
$cfg['Categories']['list']['Amazon.com']['Classical']['node'] = "573448";
*/
// Amazon.com: Computers
$cfg['Categories']['list']['Amazon.com']['PCHardware']['name'] = "Computers";
$cfg['Categories']['list']['Amazon.com']['PCHardware']['node'] = "541966";
$cfg['Categories']['list']['Amazon.com']['PCHardware']['nodes']['541966'] = 
		Array('565118'	=>  'Brands',
			  '565098'  =>  'Desktops',
			  '172455'  =>  'Computer Add-Ons',
			  );
/*
// Amazon.com: Digital Music
$cfg['Categories']['list']['Amazon.com']['DigitalMusic']['name'] = "Digital Music";
$cfg['Categories']['list']['Amazon.com']['DigitalMusic']['node'] = "";
*/
// Amazon.com: DVD
$cfg['Categories']['list']['Amazon.com']['DVD']['name'] = "DVD";
$cfg['Categories']['list']['Amazon.com']['DVD']['node'] = "130";
$cfg['Categories']['list']['Amazon.com']['DVD']['nodes']['130'] = 
		Array('404276'  =>  'Genres',
		      '404278'  =>  'Actors & Actresses',
			  '403502'  =>  'Directors',
			  );
// Amazon.com: Electronics	  
$cfg['Categories']['list']['Amazon.com']['Electronics']['name'] = "Electronics";
$cfg['Categories']['list']['Amazon.com']['Electronics']['node'] = "172282";
$cfg['Categories']['list']['Amazon.com']['Electronics']['nodes']['172282'] = 
		Array('226721'  =>  'Brands',
			  '1065836' =>  'Audio & Video',
			  '172517'  =>  'Gadgets',
			  );
// Amazon.com: Gourmet Food
$cfg['Categories']['list']['Amazon.com']['GourmetFood']['name'] = "Gourmet Food";
$cfg['Categories']['list']['Amazon.com']['GourmetFood']['node'] = "3580501";
//$cfg['Categories']['list']['Amazon.com']['GourmetFood']['node'] = "3370831";
$cfg['Categories']['list']['Amazon.com']['GourmetFood']['nodes']['3580501'] = 
		Array('3582081' =>  'Beverages',
			  '3586271' =>  'Candy',
			  '3587391' =>  'Cheese',
			  );
// Amazon.com: Health/Personal Care
$cfg['Categories']['list']['Amazon.com']['HealthPersonalCare']['name'] = "Health/Personal Care";
$cfg['Categories']['list']['Amazon.com']['HealthPersonalCare']['node'] = "3760931";
//$cfg['Categories']['list']['Amazon.com']['HealthPersonalCare']['node'] = "3760901";
$cfg['Categories']['list']['Amazon.com']['HealthPersonalCare']['nodes']['3760931'] = 
		Array('3760941' =>  'Health Care',
			  '3764441' =>  'Nutrition',
			  '3775161' =>  'Medical Supplies',
			  );
// Amazon.com: Jewelry
$cfg['Categories']['list']['Amazon.com']['Jewelry']['name'] = "Jewelry";
$cfg['Categories']['list']['Amazon.com']['Jewelry']['node'] = "3880591";
//$cfg['Categories']['list']['Amazon.com']['Jewelry']['node'] = "3367581";
$cfg['Categories']['list']['Amazon.com']['Jewelry']['nodes']['3880591'] = 
		Array('3880601'	=>  'Children',
			  '3882911'	=>  'Fashion',
			  '3888811'	=>  'Watches',
			  );
// Amazon.com: Kitchen
$cfg['Categories']['list']['Amazon.com']['Kitchen']['name'] = "Kitchen";
//$cfg['Categories']['list']['Amazon.com']['Kitchen']['node'] = "491864";
$cfg['Categories']['list']['Amazon.com']['Kitchen']['node'] = "284507";
$cfg['Categories']['list']['Amazon.com']['Kitchen']['nodes']['284507'] = 
		Array('291358'  =>  'Brands',
			  '289814'  =>  'Cookware',
			  '289891'  =>  'Tableware',
			  );
// Amazon.com: Magazines
$cfg['Categories']['list']['Amazon.com']['Magazines']['name'] = "Magazines";
$cfg['Categories']['list']['Amazon.com']['Magazines']['node'] = "599872";
//$cfg['Categories']['list']['Amazon.com']['Magazines']['node'] = "599858";
$cfg['Categories']['list']['Amazon.com']['Magazines']['nodes']['599872'] = 
		Array('604876'  =>  'Titles, A-Z',
		      '602352'  =>  'Men\'s Interest',
			  '602372'  =>  'Women\'s Interest',
			  );
/*
// Amazon.com: Miscellaneous
$cfg['Categories']['list']['Amazon.com']['Miscellaneous']['name'] = "Miscellaneous";
$cfg['Categories']['list']['Amazon.com']['Miscellaneous']['node'] = "";
*/
// Amazon.com: Music
$cfg['Categories']['list']['Amazon.com']['Music']['name'] = "Music";
$cfg['Categories']['list']['Amazon.com']['Music']['node'] = "301668";
$cfg['Categories']['list']['Amazon.com']['Music']['nodes']['301668'] = 
		Array('37' 		=>  'Pop',
			  '40'		=>	'Rock',
			  '39' 		=>  'R&B',
			  '42' 		=>  'Soundtracks',
			  );
// Amazon.com: Musical Instruments
$cfg['Categories']['list']['Amazon.com']['MusicalInstruments']['name'] = "Musical Instruments";
$cfg['Categories']['list']['Amazon.com']['MusicalInstruments']['node'] = "11965861";
$cfg['Categories']['list']['Amazon.com']['MusicalInstruments']['nodes']['11965861'] = 
		Array('12923161' =>  'Band/Orchestra',
			  '11971241' =>  'Guitars',
			  '11970071' =>  'Pianos',
			  );
/*
// Amazon.com: Music Tracks
$cfg['Categories']['list']['Amazon.com']['MusicTracks']['name'] = "Music Tracks";
$cfg['Categories']['list']['Amazon.com']['MusicTracks']['node'] = "";
*/
// Amazon.com: Office Products
$cfg['Categories']['list']['Amazon.com']['OfficeProducts']['name'] = "Office Products";
$cfg['Categories']['list']['Amazon.com']['OfficeProducts']['node'] = "1064954";
$cfg['Categories']['list']['Amazon.com']['OfficeProducts']['nodes']['1064954'] = 
		Array('1086182'	=>  'Brands',
			  '1069102'	=>  'Furniture', 
			  '1069242'	=>  'Office Supplies',
			  );
// Amazon.com: Outdoor Living
$cfg['Categories']['list']['Amazon.com']['OutdoorLiving']['name'] = "Outdoor Living";
$cfg['Categories']['list']['Amazon.com']['OutdoorLiving']['node'] = "292590";
$cfg['Categories']['list']['Amazon.com']['OutdoorLiving']['nodes']['292590'] = 
		Array('892986'  =>  'Camping',
			  '553760'  =>  'Cooking',
			  '553824'  =>  'Patio Furniture',
			  );
// Amazon.com: Pet Supplies
$cfg['Categories']['list']['Amazon.com']['PetSupplies']['name'] = "Pet Supplies";
$cfg['Categories']['list']['Amazon.com']['PetSupplies']['node'] = "12923371";
$cfg['Categories']['list']['Amazon.com']['PetSupplies']['nodes']['12923371'] = 
		Array('12925321'	=>  'Dogs',
			  '12924061'	=>  'Cats',
			  '12923981'	=>  'Birds',
			  );
// Amazon.com: Photo & Camera
$cfg['Categories']['list']['Amazon.com']['Photo']['name'] = "Photo & Camera";
$cfg['Categories']['list']['Amazon.com']['Photo']['node'] = "502394";
$cfg['Categories']['list']['Amazon.com']['Photo']['nodes']['502394'] = 
		Array('493666'	=>  'Brands',
			  '172421'	=>  'Camcorders',
			  '281052'	=>  'Digital Cameras',
			  );
/*
// Amazon.com: Restaurants
$cfg['Categories']['list']['Amazon.com']['Restaurants']['name'] = "Restaurants";
$cfg['Categories']['list']['Amazon.com']['Restaurants']['node'] = "";
*/
// Amazon.com: Software
$cfg['Categories']['list']['Amazon.com']['Software']['name'] = "Software";
$cfg['Categories']['list']['Amazon.com']['Software']['node'] = "229534";
$cfg['Categories']['list']['Amazon.com']['Software']['nodes']['229534'] = 
		Array('409488'  =>  'Brands',
			  '491286'  =>  'Categories',
			  '300228'  =>  'Outlet',
			  );
// Amazon.com: Sporting Goods
$cfg['Categories']['list']['Amazon.com']['SportingGoods']['name'] = "Sporting Goods";
$cfg['Categories']['list']['Amazon.com']['SportingGoods']['node'] = "3375301";
//$cfg['Categories']['list']['Amazon.com']['SportingGoods']['node'] = "3375251";
$cfg['Categories']['list']['Amazon.com']['SportingGoods']['nodes']['3375301'] = 
		Array('3395101'	=>  'Sports Equipment',
			  '3386071'	=>  'Fan Shop',
			  '3392741'	=>  'Footwear',
			  );
// Amazon.com: Tools & Hardware
$cfg['Categories']['list']['Amazon.com']['Tools']['name'] = "Tools & Hardware";
$cfg['Categories']['list']['Amazon.com']['Tools']['node'] = "228013";
$cfg['Categories']['list']['Amazon.com']['Tools']['nodes']['228013'] = 
		Array('228239'	=>  'Brands',
		      '551238'	=>  'Hand Tools',
			  '551236'	=>  'Power Tools',
			  );
// Amazon.com: Toys
$cfg['Categories']['list']['Amazon.com']['Toys']['name'] = "Toys";
$cfg['Categories']['list']['Amazon.com']['Toys']['node'] = "171280";
$cfg['Categories']['list']['Amazon.com']['Toys']['nodes']['171280'] = 
		Array('171457'  =>  'Brands',
              '491290'	=>	'Categories',
			  '171300'  =>  'Age Ranges',
			  );
// Amazon.com: VHS
$cfg['Categories']['list']['Amazon.com']['VHS']['name'] = "VHS";
$cfg['Categories']['list']['Amazon.com']['VHS']['node'] = "404272";
$cfg['Categories']['list']['Amazon.com']['VHS']['nodes']['404272'] = 
		Array('404274'  =>  'Genres',
		      '140'  	=>  'Actors & Actresses',
			  '139'  	=>  'Directors',
			  );
/*
// Amazon.com: Video
$cfg['Categories']['list']['Amazon.com']['Video']['name'] = "Video";
*/
// Amazon.com: PC & Video Games
$cfg['Categories']['list']['Amazon.com']['VideoGames']['name'] = "PC & Video Games";
$cfg['Categories']['list']['Amazon.com']['VideoGames']['node'] = "468642";
$cfg['Categories']['list']['Amazon.com']['VideoGames']['nodes']['468642'] = 
		Array('471280' 	=>	'Systems',
			  '229575'  =>  'PC Games',
			  '537504'  =>  'Xbox',
			  '301712'  =>  'PS2',
			  );
// Amazon.com: Wireless
$cfg['Categories']['list']['Amazon.com']['Wireless']['name'] = "Wireless";
$cfg['Categories']['list']['Amazon.com']['Wireless']['node'] = "301187";
//$cfg['Categories']['list']['Amazon.com']['Wireless']['node'] = "301185";
$cfg['Categories']['list']['Amazon.com']['Wireless']['nodes']['301187'] = 
		Array('548154'	=>	'Carriers',
			  '301216'	=>	'Manufacturers',
		      '301366'	=>	'Phone Types',
			  );
/*
// Amazon.com: Wireless Accessories
$cfg['Categories']['list']['Amazon.com']['WirelessAccessories']['name'] = "Wireless Accessories";
$cfg['Categories']['list']['Amazon.com']['WirelessAccessories']['node'] = "";
*/


// Categories: Amazon.co.uk
// Amazon.co.uk: Books
$cfg['Categories']['list']['Amazon.co.uk']['Books']['name'] = "Books";
$cfg['Categories']['list']['Amazon.co.uk']['Books']['node'] = "1025612";
$cfg['Categories']['list']['Amazon.co.uk']['Books']['nodes']['1025612'] =
		Array('68' 		=>	'Business',
			  '62' 		=>	'Fiction',
			  '65' 		=>	'History',
			  );
// Amazon.co.uk: DVD		  
$cfg['Categories']['list']['Amazon.co.uk']['DVD']['name'] = "DVD";
$cfg['Categories']['list']['Amazon.co.uk']['DVD']['node'] = "573406";
$cfg['Categories']['list']['Amazon.co.uk']['DVD']['nodes']['573406'] = 
		Array('501778'  =>  'Action',
		      '501866'  =>  'Comedy',
			  '501872'  =>  'Drama',
			  );
// Amazon.co.uk: Electronics
$cfg['Categories']['list']['Amazon.co.uk']['Electronics']['name'] = "Electronics";
$cfg['Categories']['list']['Amazon.co.uk']['Electronics']['node'] = "560800";
$cfg['Categories']['list']['Amazon.co.uk']['Electronics']['nodes']['560800'] = 
		Array('3108311' =>  'Gadgets',
			  '560834' 	=>  'Photography',
			  '560858'  =>  'Sound & Vision',
			  );
// Amazon.co.uk: Health/Personal Care
$cfg['Categories']['list']['Amazon.co.uk']['HealthPersonalCare']['name'] = "Health/Personal Care";
$cfg['Categories']['list']['Amazon.co.uk']['HealthPersonalCare']['node'] = "3147461";
$cfg['Categories']['list']['Amazon.co.uk']['HealthPersonalCare']['nodes']['3147461'] = 
		Array('11090951'=>  'Cosmetics',
			  '3147781' =>  'Hair Care',
			  '10706681'=>  'Spas',
			  );
// Amazon.co.uk: Home/Garden
$cfg['Categories']['list']['Amazon.co.uk']['HomeGarden']['name'] = "Home/Garden";
$cfg['Categories']['list']['Amazon.co.uk']['HomeGarden']['node'] = "11052591";
$cfg['Categories']['list']['Amazon.co.uk']['HomeGarden']['nodes']['11052591'] = 
		Array('11052651'=>  'DIY & Tools',
			  '11052671'=>  'Garden & Outdoors',
			  '11052681'=>  'Kitchen & Home',
			  '11052661'=>  'Personal Care',
			  );
// Amazon.co.uk: Kitchen
$cfg['Categories']['list']['Amazon.co.uk']['Kitchen']['name'] = "Kitchen";
$cfg['Categories']['list']['Amazon.co.uk']['Kitchen']['node'] = "3147411";
$cfg['Categories']['list']['Amazon.co.uk']['Kitchen']['nodes']['3147411'] = 
		Array('10708921' =>  'Bakeware',
			  '3147471'  =>  'Cookware',
			  '10708551' =>  'Tableware',
			  );
// Amazon.co.uk: Music
$cfg['Categories']['list']['Amazon.co.uk']['Music']['name'] = "Music";
$cfg['Categories']['list']['Amazon.co.uk']['Music']['node'] = "520920";
$cfg['Categories']['list']['Amazon.co.uk']['Music']['nodes']['520920'] = 
		Array('231239'	=>  'Rock',
		      '694208' 	=>  'Pop',
			  '754576' 	=>  'R&B',
			  '231249' 	=>  'Soundtracks',
			  );
// Amazon.co.uk: Outdoor Living
$cfg['Categories']['list']['Amazon.co.uk']['OutdoorLiving']['name'] = "Outdoor Living";
$cfg['Categories']['list']['Amazon.co.uk']['OutdoorLiving']['node'] = "10709021";
$cfg['Categories']['list']['Amazon.co.uk']['OutdoorLiving']['nodes']['10709021'] = 
		Array('11714121'  =>  'Barbecues',
			  '11714171'  =>  'Garden Furniture',
			  '11714761'  =>  'Tools',
			  );
// Amazon.co.uk: Software	  
$cfg['Categories']['list']['Amazon.co.uk']['Software']['name'] = "Software";
$cfg['Categories']['list']['Amazon.co.uk']['Software']['node'] = "1025614";
$cfg['Categories']['list']['Amazon.co.uk']['Software']['nodes']['1025614'] = 
		Array('600014'  =>  'Business',
			  '600136'  =>  'Graphics',
			  '600236'  =>  'Video',
			  );
// Amazon.co.uk: Toys
$cfg['Categories']['list']['Amazon.co.uk']['Toys']['name'] = "Toys";
$cfg['Categories']['list']['Amazon.co.uk']['Toys']['node'] = "468292";
$cfg['Categories']['list']['Amazon.co.uk']['Toys']['nodes']['468292'] = 
		Array('470432'  =>  'Characters/Brands',
              '595314'	=>	'Toy Types',
			  '589884'  =>  'Age Ranges',
			  );
// Amazon.co.uk: VHS
$cfg['Categories']['list']['Amazon.co.uk']['VHS']['name'] = "VHS";
$cfg['Categories']['list']['Amazon.co.uk']['VHS']['node'] = "573400";
$cfg['Categories']['list']['Amazon.co.uk']['VHS']['nodes']['573400'] = 
		Array('283921'  =>  'Action',
		      '283924'  =>  'Comedy',
			  '283925'  =>  'Drama',
			  );
// Amazon.co.uk: Video Games  
$cfg['Categories']['list']['Amazon.co.uk']['VideoGames']['name'] = "PC & Video Games";
$cfg['Categories']['list']['Amazon.co.uk']['VideoGames']['node'] = "300703";
$cfg['Categories']['list']['Amazon.co.uk']['VideoGames']['nodes']['300703'] = 
		Array('300729'  =>  'PC Games',
			  '660202'  =>  'Xbox',
			  '526776'  =>  'PS2',
			  );
				
// Categories: Amazon.ca
// Amazon.ca: Books
$cfg['Categories']['list']['Amazon.ca']['Books']['name'] = "Books";
$cfg['Categories']['list']['Amazon.ca']['Books']['node'] = "927726";
$cfg['Categories']['list']['Amazon.ca']['Books']['nodes']['927726'] =
		Array('935522' 	=>	'Business',
			  '927728' 	=>	'History',
			  '955190' 	=>	'Romance',
			  );
// Amazon.ca: DVD
$cfg['Categories']['list']['Amazon.ca']['DVD']['name'] = "DVD";
$cfg['Categories']['list']['Amazon.ca']['DVD']['node'] = "952768";
$cfg['Categories']['list']['Amazon.ca']['DVD']['nodes']['952768'] = 
		Array('966110'  =>  'Action',
		      '953088'  =>  'Comedy',
			  '953102'  =>  'Drama',
			  );
// Amazon.ca: Music
$cfg['Categories']['list']['Amazon.ca']['Music']['name'] = "Music";
$cfg['Categories']['list']['Amazon.ca']['Music']['node'] = "962454";
$cfg['Categories']['list']['Amazon.ca']['Music']['nodes']['962454'] = 
		Array('962490'	=>  'Rock',
		      '962486' 	=>  'Pop',
			  '1034848' =>  'R&B',
			  '962498' 	=>  'Soundtracks',
			  );
// Amazon.ca: Software
$cfg['Categories']['list']['Amazon.ca']['Software']['name'] = "Software";
$cfg['Categories']['list']['Amazon.ca']['Software']['node'] = "3234171";
$cfg['Categories']['list']['Amazon.ca']['Software']['nodes']['3234171'] = 
		Array('3314471'  =>  'Business',
			  '3316381'  =>  'Graphics',
			  '3318701'  =>  'Video',
			  );
// Amazon.ca: VHS
$cfg['Categories']['list']['Amazon.ca']['VHS']['name'] = "VHS";
$cfg['Categories']['list']['Amazon.ca']['VHS']['node'] = "962072";
$cfg['Categories']['list']['Amazon.ca']['VHS']['nodes']['962072'] = 
		Array('972682'  =>  'Action',
		      '962128'  =>  'Comedy',
			  '962130'  =>  'Drama',
			  );
// Amazon.ca: PC & Video Games
$cfg['Categories']['list']['Amazon.ca']['VideoGames']['name'] = "PC & Video Games";
$cfg['Categories']['list']['Amazon.ca']['VideoGames']['node'] = "3234221";
$cfg['Categories']['list']['Amazon.ca']['VideoGames']['nodes']['3234221'] = 
		Array('3322951' =>	'PlayStation2',
			  '3321791' =>  'PC Games',
			  '3323581' =>  'Xbox',
			  );
			  

// CategoryBox
$cfg['CategoryBox']['enhanced'] = TRUE;
$cfg['CategoryBox']['section'] = "4";
$cfg['CategoryBox']['type'] = "box";
$cfg['CategoryBox']['display']['list'] = Array('Yes', 'No');
$cfg['CategoryBox']['display']['default'] = "Yes";
$cfg['CategoryBox']['location']['list'] = Array('L', 'R');
$cfg['CategoryBox']['location']['default'] = "L";
$cfg['CategoryBox']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CategoryBox']['order']['default'] = "";
$cfg['CategoryBox']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CategoryBox']['bordersize']['default'] = "1";
$cfg['CategoryBox']['bordercolor']['default'] = "#000000";
$cfg['CategoryBox']['bgcolor']['default'] = "#FFFFFF";
$cfg['CategoryBox']['label'] = "Categories";
$cfg['CategoryBox']['help'] = "Browsable list of categories you configured above. To not display this box set Display equal to No. For Location: L=Left, R=Right";
			  
// CategoryIcons
$cfg['CategoryIcons']['section'] = "4";
$cfg['CategoryIcons']['list'] = Array('Yes',
							 		  'No',
									 );
$cfg['CategoryIcons']['default'] = "No";
$cfg['CategoryIcons']['type'] = "simplemenu";
$cfg['CategoryIcons']['help'] = "Whether or not to display the small category icons throughout Associate-O-Matic. The icon files must be named 'icon_{Your Category ID}.gif' to appear properly.";

// InformationBox
$cfg['InformationBox']['enhanced'] = TRUE;
$cfg['InformationBox']['section'] = "5";
$cfg['InformationBox']['type'] = "box";
$cfg['InformationBox']['display']['list'] = Array('Yes', 'No');
$cfg['InformationBox']['display']['default'] = "No";
$cfg['InformationBox']['location']['list'] = Array('L', 'R');
$cfg['InformationBox']['location']['default'] = "R";
$cfg['InformationBox']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['InformationBox']['order']['default'] = "";
$cfg['InformationBox']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['InformationBox']['bordersize']['default'] = "1";
$cfg['InformationBox']['bordercolor']['default'] = "#000000";
$cfg['InformationBox']['bgcolor']['default'] = "#FFFFFF";
$cfg['InformationBox']['label'] = "Information";
$cfg['InformationBox']['url'] = "";
$cfg['InformationBox']['help'] = "Links to any page URLs you specify whether inside or outside Associate-O-Matic (i.e. About page, Contact page, etc). To not display this box set Display equal to No. For Location: L=Left, R=Right";

// CustomContentBox1
$cfg['CustomContentBox1']['enhanced'] = TRUE;
$cfg['CustomContentBox1']['section'] = "6";
$cfg['CustomContentBox1']['type'] = "box";
$cfg['CustomContentBox1']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox1']['display']['default'] = "No";
$cfg['CustomContentBox1']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox1']['location']['default'] = "L";
$cfg['CustomContentBox1']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox1']['order']['default'] = "";
$cfg['CustomContentBox1']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox1']['bordersize']['default'] = "1";
$cfg['CustomContentBox1']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox1']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox1']['label'] = "";
$cfg['CustomContentBox1']['html'] = "";
$cfg['CustomContentBox1']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox2
$cfg['CustomContentBox2']['enhanced'] = TRUE;
$cfg['CustomContentBox2']['section'] = "6";
$cfg['CustomContentBox2']['type'] = "box";
$cfg['CustomContentBox2']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox2']['display']['default'] = "No";
$cfg['CustomContentBox2']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox2']['location']['default'] = "L";
$cfg['CustomContentBox2']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox2']['order']['default'] = "";
$cfg['CustomContentBox2']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox2']['bordersize']['default'] = "1";
$cfg['CustomContentBox2']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox2']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox2']['label'] = "";
$cfg['CustomContentBox2']['html'] = "";
$cfg['CustomContentBox2']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox3
$cfg['CustomContentBox3']['enhanced'] = TRUE;
$cfg['CustomContentBox3']['section'] = "6";
$cfg['CustomContentBox3']['type'] = "box";
$cfg['CustomContentBox3']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox3']['display']['default'] = "No";
$cfg['CustomContentBox3']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox3']['location']['default'] = "L";
$cfg['CustomContentBox3']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox3']['order']['default'] = "";
$cfg['CustomContentBox3']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox3']['bordersize']['default'] = "1";
$cfg['CustomContentBox3']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox3']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox3']['label'] = "";
$cfg['CustomContentBox3']['html'] = "";
$cfg['CustomContentBox3']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox4
$cfg['CustomContentBox4']['enhanced'] = TRUE;
$cfg['CustomContentBox4']['section'] = "6";
$cfg['CustomContentBox4']['type'] = "box";
$cfg['CustomContentBox4']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox4']['display']['default'] = "No";
$cfg['CustomContentBox4']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox4']['location']['default'] = "L";
$cfg['CustomContentBox4']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox4']['order']['default'] = "";
$cfg['CustomContentBox4']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox4']['bordersize']['default'] = "1";
$cfg['CustomContentBox4']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox4']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox4']['label'] = "";
$cfg['CustomContentBox4']['html'] = "";
$cfg['CustomContentBox4']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox5
$cfg['CustomContentBox5']['enhanced'] = TRUE;
$cfg['CustomContentBox5']['section'] = "6";
$cfg['CustomContentBox5']['type'] = "box";
$cfg['CustomContentBox5']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox5']['display']['default'] = "No";
$cfg['CustomContentBox5']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox5']['location']['default'] = "L";
$cfg['CustomContentBox5']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox5']['order']['default'] = "";
$cfg['CustomContentBox5']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox5']['bordersize']['default'] = "1";
$cfg['CustomContentBox5']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox5']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox5']['label'] = "";
$cfg['CustomContentBox5']['html'] = "";
$cfg['CustomContentBox5']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox6
$cfg['CustomContentBox6']['enhanced'] = TRUE;
$cfg['CustomContentBox6']['section'] = "6";
$cfg['CustomContentBox6']['type'] = "box";
$cfg['CustomContentBox6']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox6']['display']['default'] = "No";
$cfg['CustomContentBox6']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox6']['location']['default'] = "L";
$cfg['CustomContentBox6']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox6']['order']['default'] = "";
$cfg['CustomContentBox6']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox6']['bordersize']['default'] = "1";
$cfg['CustomContentBox6']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox6']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox6']['label'] = "";
$cfg['CustomContentBox6']['html'] = "";
$cfg['CustomContentBox6']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox7
$cfg['CustomContentBox7']['enhanced'] = TRUE;
$cfg['CustomContentBox7']['section'] = "6";
$cfg['CustomContentBox7']['type'] = "box";
$cfg['CustomContentBox7']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox7']['display']['default'] = "No";
$cfg['CustomContentBox7']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox7']['location']['default'] = "L";
$cfg['CustomContentBox7']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox7']['order']['default'] = "";
$cfg['CustomContentBox7']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox7']['bordersize']['default'] = "1";
$cfg['CustomContentBox7']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox7']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox7']['label'] = "";
$cfg['CustomContentBox7']['html'] = "";
$cfg['CustomContentBox7']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox8
$cfg['CustomContentBox8']['enhanced'] = TRUE;
$cfg['CustomContentBox8']['section'] = "6";
$cfg['CustomContentBox8']['type'] = "box";
$cfg['CustomContentBox8']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox8']['display']['default'] = "No";
$cfg['CustomContentBox8']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox8']['location']['default'] = "L";
$cfg['CustomContentBox8']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox8']['order']['default'] = "";
$cfg['CustomContentBox8']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox8']['bordersize']['default'] = "1";
$cfg['CustomContentBox8']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox8']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox8']['label'] = "";
$cfg['CustomContentBox8']['html'] = "";
$cfg['CustomContentBox8']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox9
$cfg['CustomContentBox9']['enhanced'] = TRUE;
$cfg['CustomContentBox9']['section'] = "6";
$cfg['CustomContentBox9']['type'] = "box";
$cfg['CustomContentBox9']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox9']['display']['default'] = "No";
$cfg['CustomContentBox9']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox9']['location']['default'] = "L";
$cfg['CustomContentBox9']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox9']['order']['default'] = "";
$cfg['CustomContentBox9']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox9']['bordersize']['default'] = "1";
$cfg['CustomContentBox9']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox9']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox9']['label'] = "";
$cfg['CustomContentBox9']['html'] = "";
$cfg['CustomContentBox9']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// CustomContentBox10
$cfg['CustomContentBox10']['enhanced'] = TRUE;
$cfg['CustomContentBox10']['section'] = "6";
$cfg['CustomContentBox10']['type'] = "box";
$cfg['CustomContentBox10']['display']['list'] = Array('Yes', 'No');
$cfg['CustomContentBox10']['display']['default'] = "No";
$cfg['CustomContentBox10']['location']['list'] = Array('L', 'R', 'PT', 'PB', 'BT', 'BB');
$cfg['CustomContentBox10']['location']['default'] = "L";
$cfg['CustomContentBox10']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['CustomContentBox10']['order']['default'] = "";
$cfg['CustomContentBox10']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['CustomContentBox10']['bordersize']['default'] = "1";
$cfg['CustomContentBox10']['bordercolor']['default'] = "#000000";
$cfg['CustomContentBox10']['bgcolor']['default'] = "#FFFFFF";
$cfg['CustomContentBox10']['label'] = "";
$cfg['CustomContentBox10']['html'] = "";
$cfg['CustomContentBox10']['help'] = "Can contain any HTML you want to include (ie Ad Content, Featured Items, Newsletter Subscription, etc.) L=Left, R=Right, PT=Page Top, PB=Page Bottom, BT=Body Top, BB=Body Bottom";

// RelatedCategoryBox
$cfg['RelatedCategoryBox']['enhanced'] = TRUE;
$cfg['RelatedCategoryBox']['section'] = "4";
$cfg['RelatedCategoryBox']['type'] = "box";
$cfg['RelatedCategoryBox']['display']['list'] = Array('Yes', 'No');
$cfg['RelatedCategoryBox']['display']['default'] = "Yes";
$cfg['RelatedCategoryBox']['location']['list'] = Array('L', 'R');
$cfg['RelatedCategoryBox']['location']['default'] = "L";
$cfg['RelatedCategoryBox']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['RelatedCategoryBox']['order']['default'] = "";
$cfg['RelatedCategoryBox']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['RelatedCategoryBox']['bordersize']['default'] = "1";
$cfg['RelatedCategoryBox']['bordercolor']['default'] = "#000000";
$cfg['RelatedCategoryBox']['bgcolor']['default'] = "#FFFFFF";
$cfg['RelatedCategoryBox']['label'] = "Related Categories";
$cfg['RelatedCategoryBox']['help'] = "Browsable list of related category links with results conforming to your <b>Site Filter</b> and <b>Site Node Filter</b> (if specified). For Location: L=Left, R=Right";

// RelatedCategoryBoxNodes
$cfg['RelatedCategoryBoxNodes']['section'] = "4";
$cfg['RelatedCategoryBoxNodes']['list'] = Array('All', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20');
$cfg['RelatedCategoryBoxNodes']['type'] = "simplemenu";
$cfg['RelatedCategoryBoxNodes']['help'] = "Controls the number of related category links (nodes) to display. <b>NOTE:</b> The number of parent links displayed is controlled by the <b>Related Category Box Parent Nodes</b> setting below.";
$cfg['RelatedCategoryBoxNodes']['default'] = "All";

// RelatedCategoryBoxParentNodes
$cfg['RelatedCategoryBoxParentNodes']['section'] = "4";
$cfg['RelatedCategoryBoxParentNodes']['list'] = Array('All', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
$cfg['RelatedCategoryBoxParentNodes']['type'] = "simplemenu";
$cfg['RelatedCategoryBoxParentNodes']['help'] = "Controls the number of levels deep of related category link parent nodes to display. <b>NOTE:</b> These are the links with the up arrows.";
$cfg['RelatedCategoryBoxParentNodes']['default'] = "4";

// SubcategoryBox
$cfg['SubcategoryBox']['enhanced'] = TRUE;
$cfg['SubcategoryBox']['section'] = "4";
$cfg['SubcategoryBox']['type'] = "box";
$cfg['SubcategoryBox']['display']['list'] = Array('Yes', 'No');
$cfg['SubcategoryBox']['display']['default'] = "Yes";
$cfg['SubcategoryBox']['location']['list'] = Array('L', 'R');
$cfg['SubcategoryBox']['location']['default'] = "L";
$cfg['SubcategoryBox']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['SubcategoryBox']['order']['default'] = "";
$cfg['SubcategoryBox']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['SubcategoryBox']['bordersize']['default'] = "1";
$cfg['SubcategoryBox']['bordercolor']['default'] = "#000000";
$cfg['SubcategoryBox']['bgcolor']['default'] = "#FFFFFF";
$cfg['SubcategoryBox']['label'] = "Subcategories";
$cfg['SubcategoryBox']['help'] = "Browsable list of subcategory links with results conforming to your <b>Site Filter</b> and <b>Site Node Filter</b> (if specified). For Location: L=Left, R=Right";

// NewReleaseBox
$cfg['NewReleaseBox']['enhanced'] = TRUE;
$cfg['NewReleaseBox']['section'] = "4";
$cfg['NewReleaseBox']['type'] = "box";
$cfg['NewReleaseBox']['display']['list'] = Array('Yes', 'No');
$cfg['NewReleaseBox']['display']['default'] = "Yes";
$cfg['NewReleaseBox']['location']['list'] = Array('L', 'R');
$cfg['NewReleaseBox']['location']['default'] = "L";
$cfg['NewReleaseBox']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['NewReleaseBox']['order']['default'] = "";
$cfg['NewReleaseBox']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['NewReleaseBox']['bordersize']['default'] = "1";
$cfg['NewReleaseBox']['bordercolor']['default'] = "#000000";
$cfg['NewReleaseBox']['bgcolor']['default'] = "#FFFFFF";
$cfg['NewReleaseBox']['label'] = "New Releases";
$cfg['NewReleaseBox']['help'] = "List of newly released item links (US locale only). <b>NOTE:</b> This list is based on the browse node only... not your Site Default Keyword or category-level keywords though results will conform to your <b>Site Filter</b> (if specified). For Location: L=Left, R=Right";

// BestsellerBox
$cfg['BestsellerBox']['enhanced'] = TRUE;
$cfg['BestsellerBox']['section'] = "4";
$cfg['BestsellerBox']['type'] = "box";
$cfg['BestsellerBox']['display']['list'] = Array('Yes', 'No');
$cfg['BestsellerBox']['display']['default'] = "Yes";
$cfg['BestsellerBox']['location']['list'] = Array('L', 'R');
$cfg['BestsellerBox']['location']['default'] = "L";
$cfg['BestsellerBox']['order']['list'] = Array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
$cfg['BestsellerBox']['order']['default'] = "";
$cfg['BestsellerBox']['bordersize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$cfg['BestsellerBox']['bordersize']['default'] = "1";
$cfg['BestsellerBox']['bordercolor']['default'] = "#000000";
$cfg['BestsellerBox']['bgcolor']['default'] = "#FFFFFF";
$cfg['BestsellerBox']['label'] = "Bestsellers";
$cfg['BestsellerBox']['help'] = "List of bestselling item links (US locale only). <b>NOTE:</b> This list is based on the browse node only... not your Site Default Keyword or category-level keywords though results will conform to your <b>Site Filter</b> (if specified). For Location: L=Left, R=Right";

// SiteName
$cfg['SiteName']['section'] = "1";
$cfg['SiteName']['type'] = "text";
$cfg['SiteName']['help'] = "Enter your site name";
$cfg['SiteName']['default'] = "[your site name here]";
$cfg['SiteName']['required'] = TRUE;

// SiteDescription
$cfg['SiteDescription']['section'] = "1";
$cfg['SiteDescription']['type'] = "text";
$cfg['SiteDescription']['help'] = "Enter your sites description (can be used in the Meta Description section below)";
$cfg['SiteDescription']['default'] = "[your description here]";
$cfg['SiteDescription']['required'] = TRUE;

// SiteKeywords
$cfg['SiteKeywords']['section'] = "1";
$cfg['SiteKeywords']['type'] = "textarea";
$cfg['SiteKeywords']['help'] = "Enter 20-30 keywords/phrases describing your website, separated by commas (can be used in the Meta Keywords section below)";
$cfg['SiteKeywords']['default'] = "[your keywords here]";
$cfg['SiteKeywords']['required'] = TRUE;

// SiteSlogan
$cfg['SiteSlogan']['section'] = "1";
$cfg['SiteSlogan']['type'] = "text";
$cfg['SiteSlogan']['help'] = "Enter a selling slogan (can be added to your page Title)";

// SiteDefaultKeyword
$cfg['SiteDefaultKeyword']['section'] = "1";
$cfg['SiteDefaultKeyword']['type'] = "text";
$cfg['SiteDefaultKeyword']['help'] = "Enter the default keyword/phrase for your site (e.g. <b>Star Wars</b>, <b>Mountain Biking</b>, etc.). This would be the general topic of your site as it will filter search and browse results. Leave blank if you are opening a general 'mall' type store. If you supply a value, be sure to test each Associate-O-Matic category you setup below to be sure results are returned. You can also fine-tune default keywords at Category level as well (see below). The more general the search term you use, the more likely Amazon will return results.";

// SiteFilter
$cfg['SiteFilter']['section'] = "8";
$cfg['SiteFilter']['type'] = "text";
$cfg['SiteFilter']['help'] = "If provided, these words will be filtered from the Subcategory, Related Category, New Release and Bestseller Boxes as well as keyword searches, etc. Enter keywords/phrases separated by a comma -  not case sensitive (e.g. sex, blue, whatever). <b>NOTE:</b> Partial words cause the whole word/phrase to be filtered (e.g. \"a\" would filter all words containing the letter \"a\" for example \"f<b>a</b>rm\", \"s<b>a</b>nta\" and etc)";

// SiteNodeFilter
$cfg['SiteNodeFilter']['section'] = "8";
$cfg['SiteNodeFilter']['type'] = "text";
$cfg['SiteNodeFilter']['help'] = "If provided, these specific nodes will be filtered from the Subcategory and Related Category Boxes";

// SiteTrafficCode
$cfg['SiteTrafficCode']['section'] = "8";
$cfg['SiteTrafficCode']['type'] = "textarea";
$cfg['SiteTrafficCode']['help'] = "This is where you can paste code from any third-party site traffic tracking programs. If supplied it will load on each page.";

// SiteDisclaimer
$cfg['SiteDisclaimer']['section'] = "8";
$cfg['SiteDisclaimer']['type'] = "textarea";
$cfg['SiteDisclaimer']['help'] = "This is where you place your any legal disclaimer for your store should you choose. It will be displayed at the very bottom of each page and can contain any HTML.";

// ErrorSearch
$cfg['ErrorSearch']['section'] = "16";
$cfg['ErrorSearch']['type'] = "textarea";
$cfg['ErrorSearch']['help'] = "If provided this error message will be displayed instead of the standard Amazon error when there are no search results. This can be text or HTML of any kind.";

// ErrorItemNotAvailable
$cfg['ErrorItemNotAvailable']['section'] = "16";
$cfg['ErrorItemNotAvailable']['type'] = "textarea";
$cfg['ErrorItemNotAvailable']['help'] = "If provided this error message will be displayed in cases where an item is no longer available. Otherwise the default message will appear... 'This Item Is No Longer Available'.";

// TextColor
$cfg['TextColor']['section'] = "2";
$cfg['TextColor']['type'] = "color";
$cfg['TextColor']['help'] = "Choose the site text color";
$cfg['TextColor']['default'] = "#000000";
$cfg['TextColor']['required'] = TRUE;

// TextHighlightColor
$cfg['TextHighlightColor']['section'] = "2";
$cfg['TextHighlightColor']['type'] = "color";
$cfg['TextHighlightColor']['help'] = "Choose the text color for highlighted areas such as 'Eligible for Super Saver Shipping', 'New Release', etc...";
$cfg['TextHighlightColor']['default'] = "#990000";
$cfg['TextHighlightColor']['required'] = TRUE;

// TextDarkColor
$cfg['TextDarkColor']['section'] = "2";
$cfg['TextDarkColor']['type'] = "color";
$cfg['TextDarkColor']['help'] = "Choose the text color for the tabs, search bar, breadcrumbs etc. This color would be used on light backgrounds versus the <b>Text Light Color</b> which is used on dark backgrounds.";
$cfg['TextDarkColor']['default'] = "#000000";
$cfg['TextDarkColor']['required'] = TRUE;

// TextLightColor
$cfg['TextLightColor']['section'] = "2";
$cfg['TextLightColor']['type'] = "color";
$cfg['TextLightColor']['help'] = "Choose the text color for the tabs, search bar, breadcrumbs etc. This color would be used on dark backgrounds versus the <b>Text Dark Color</b> which is used on light backgrounds.";
$cfg['TextLightColor']['default'] = "#FFFFFF";
$cfg['TextLightColor']['required'] = TRUE;

// TextFont
$cfg['TextFont']['enhanced'] = TRUE;
$cfg['TextFont']['section'] = "2";
$cfg['TextFont']['list'] = Array('Arial, sans-serif',
							 	 'Times New Roman, serif',
							 	 'Verdana, sans-serif',
								 'Tahoma, sans-serif',
								 'Courier New, monospace',
							 	 'Comic Sans, cursive',
							 	 'Impact, fantasy',
							 	 );
$cfg['TextFont']['type'] = "simplemenu";
$cfg['TextFont']['help'] = "Select the font for your site";
$cfg['TextFont']['default'] = "Arial, sans-serif";

// TextSize
$cfg['TextSize']['section'] = "2";
$cfg['TextSize']['list'] = Array('xx-small',
							 		 'x-small',
							 		 'small',
							 		 'medium',
							 		 'large',
							 		 'x-large',							 
							 		 'xx-large',
									 '10px',
									 '12px',
									 '14px',
									 '16px',
									 '18px',
									 );
$cfg['TextSize']['type'] = "simplemenu";
$cfg['TextSize']['help'] = "Select the size of your site text<br><span style=\"font-size: xx-small\">xx-small</span>&nbsp;&nbsp;&nbsp;<span style=\"font-size: x-small\">x-small</span>&nbsp;&nbsp;&nbsp;<span style=\"font-size: small\">small</span>&nbsp;&nbsp;&nbsp;<span style=\"font-size: medium\">medium</span>&nbsp;&nbsp;&nbsp;<span style=\"font-size: large\">large</span>&nbsp;&nbsp;&nbsp;<span style=\"font-size: x-large\">x-large</span>&nbsp;&nbsp;&nbsp;<span style=\"font-size: xx-large\">xx-large</span>";
$cfg['TextSize']['default'] = "small";

// ImageSizeHome
$cfg['ImageSizeHome']['section'] = "9";
$cfg['ImageSizeHome']['list'] = Array('Small',
									   'Medium',
									   'Large',
									   );
$cfg['ImageSizeHome']['type'] = "simplemenu";
$cfg['ImageSizeHome']['help'] = "Select the item image size to display on the Home page";
$cfg['ImageSizeHome']['default'] = "Small";

// ImageSizeListing
$cfg['ImageSizeListing']['section'] = "9";
$cfg['ImageSizeListing']['list'] = Array('Small',
									   'Medium',
									   'Large',
									   );
$cfg['ImageSizeListing']['type'] = "simplemenu";
$cfg['ImageSizeListing']['help'] = "Select the item image size to display on the Category/Subcategory pages";
$cfg['ImageSizeListing']['default'] = "Medium";

// ImageSizeItem
$cfg['ImageSizeItem']['section'] = "9";
$cfg['ImageSizeItem']['list'] = Array('Small',
									   'Medium',
									   'Large',
									   );
$cfg['ImageSizeItem']['type'] = "simplemenu";
$cfg['ImageSizeItem']['help'] = "Select the item image size to display on the Item detail pages";
$cfg['ImageSizeItem']['default'] = "Medium";

// SiteCss
$cfg['SiteCss']['section'] = "8";
$cfg['SiteCss']['type'] = "text";
$cfg['SiteCss']['help'] = "Enter the URL to your own CSS file (i.e. http://www.yoursite.com/styles.css) to further customize Associate-O-Matic beyond the control panel";

// MainColor
$cfg['MainColor']['section'] = "10";
$cfg['MainColor']['type'] = "color";
$cfg['MainColor']['help'] = "Choose the main color for your site";
$cfg['MainColor']['default'] = "#000000";
$cfg['MainColor']['required'] = TRUE;

// AccentColor
$cfg['AccentColor']['section'] = "10";
$cfg['AccentColor']['type'] = "color";
$cfg['AccentColor']['help'] = "Choose the accent color for your site";
$cfg['AccentColor']['default'] = "#FFCC33";
$cfg['AccentColor']['required'] = TRUE;

// BackgroundColor
$cfg['BackgroundColor']['section'] = "10";
$cfg['BackgroundColor']['type'] = "color";
$cfg['BackgroundColor']['help'] = "Choose the background color for your site";
$cfg['BackgroundColor']['default'] = "#FFFFFF";
$cfg['BackgroundColor']['required'] = TRUE;

// BodyBorderColor
$cfg['BodyBorderColor']['section'] = "10";
$cfg['BodyBorderColor']['type'] = "color";
$cfg['BodyBorderColor']['help'] = "Choose the body border color. In previous versions it used the <b>Main Color</b> value.";
$cfg['BodyBorderColor']['default'] = "#000000";

// BodyBackgroundColor
$cfg['BodyBackgroundColor']['section'] = "10";
$cfg['BodyBackgroundColor']['type'] = "color";
$cfg['BodyBackgroundColor']['help'] = "Choose the body background color";
$cfg['BodyBackgroundColor']['default'] = "#FFFFFF";
$cfg['BodyBackgroundColor']['required'] = TRUE;

// LineColor
$cfg['LineColor']['section'] = "10";
$cfg['LineColor']['type'] = "color";
$cfg['LineColor']['help'] = "Choose the color of separator lines. In previous versions, this was always the same as the <b>Main Color</b>. If you would rather these lines don't appear, set this color the same as your <b>Background Color</b>.";
$cfg['LineColor']['default'] = "#000000";
$cfg['LineColor']['required'] = TRUE;

// LinkColor
$cfg['LinkColor']['section'] = "3";
$cfg['LinkColor']['type'] = "color";
$cfg['LinkColor']['help'] = "Choose the color of links";
$cfg['LinkColor']['default'] = "#0000CC";
$cfg['LinkColor']['required'] = TRUE;

// LinkHoverColor
$cfg['LinkHoverColor']['section'] = "3";
$cfg['LinkHoverColor']['type'] = "color";
$cfg['LinkHoverColor']['help'] = "Choose the color of links hovered over";
$cfg['LinkHoverColor']['default'] = "#6666FF";

// LinkVisitedColor
$cfg['LinkVisitedColor']['section'] = "3";
$cfg['LinkVisitedColor']['type'] = "color";
$cfg['LinkVisitedColor']['help'] = "Choose the color of links visited";
$cfg['LinkVisitedColor']['default'] = "#551A8B";

// SiteHeaderHtml
$cfg['SiteHeaderHtml']['section'] = "8";
$cfg['SiteHeaderHtml']['type'] = "html";
$cfg['SiteHeaderHtml']['help'] = "Enter the URL to your header HTML file (i.e. http://www.yoursite.com/header.html). <b>NOTE:</b> On some servers you may need to enter the path to the file instead of the URL. If the header file is in the same location as your shop file, you might be able to simply enter the file name (e.g. header.html)";

// SiteFooterHtml
$cfg['SiteFooterHtml']['section'] = "8";
$cfg['SiteFooterHtml']['type'] = "html";
$cfg['SiteFooterHtml']['help'] = "Enter the URL to your footer HTML file (i.e. http://www.yoursite.com/footer.html). <b>NOTE:</b> On some servers you may need to enter the path to the file instead of the URL. If the footer file is in the same location as your shop file, you might be able to simply enter the file name (e.g. footer.html)";

// Logo
$cfg['Logo']['section'] = "9";
$cfg['Logo']['type'] = "image";
$cfg['Logo']['help'] = "Enter the URL (http://www.yourdomain.com/logo.gif) to your logo or masthead graphic";

// TextLogo
$cfg['TextLogo']['enhanced'] = TRUE;
$cfg['TextLogo']['section'] = "9";
$cfg['TextLogo']['type'] = "textlogo";
$cfg['TextLogo']['help'] = "If you don't have a Site Logo for the above setting use this setting to create a simple text-based 'logo'. Specify the text, font, size, weight, color. If nothing else it can act as a placeholder until you have a graphical logo.";
$cfg['TextLogo']['font']['list'] = Array('Arial, sans-serif', 'Times New Roman, serif', 'Verdana, sans-serif', 'Tahoma, sans-serif', 'Courier New, monospace', 'Comic Sans, cursive', 'Impact, fantasy');
$cfg['TextLogo']['font']['default'] = "Arial, sans-serif";
$cfg['TextLogo']['size']['list'] = Array('xx-small', 'x-small', 'small', 'medium', 'large', 'x-large', 'xx-large', '10px', '20px', '30px', '40px', '50px', '60px', '70px', '80px', '90px');
$cfg['TextLogo']['size']['default'] = "xx-large";
$cfg['TextLogo']['weight']['list'] = Array('bold', 'normal', '100', '200', '300', '400', '500', '600', '700', '800', '900');
$cfg['TextLogo']['weight']['default'] = "bold";
$cfg['TextLogo']['color']['default'] = "#000000";

// LogoAlignment
$cfg['LogoAlignment']['section'] = "9";
$cfg['LogoAlignment']['list'] = Array('Left', 'Center', 'Right');
$cfg['LogoAlignment']['type'] = "simplemenu";
$cfg['LogoAlignment']['help'] = "This sets the horizontal alignment of your graphical or text logo from above";
$cfg['LogoAlignment']['default'] = "Left";

// BackgroundImage
$cfg['BackgroundImage']['section'] = "9";
$cfg['BackgroundImage']['type'] = "text";
$cfg['BackgroundImage']['help'] = "Enter the URL (http://www.yourdomain.com/background.gif) to your background graphic";

// Alignment
$cfg['Alignment']['new'] = TRUE;
$cfg['Alignment']['section'] = "14";
$cfg['Alignment']['list'] = Array('Left', 'Center', 'Right');
$cfg['Alignment']['type'] = "simplemenu";
$cfg['Alignment']['help'] = "Select the alignment of your store within the browser window";
$cfg['Alignment']['default'] = "Center";

// Width
$cfg['Width']['new'] = TRUE;
$cfg['Width']['section'] = "14";
$cfg['Width']['type'] = "text";
$cfg['Width']['help'] = "Enter the overall width of your store. It can be a percentage (e.g. 100%) or a pixel width integer (e.g. 750)";
$cfg['Width']['default'] = "100%";
$cfg['Width']['required'] = TRUE;

// ColumnWidthLeft
$cfg['ColumnWidthLeft']['section'] = "14";
$cfg['ColumnWidthLeft']['type'] = "text";
$cfg['ColumnWidthLeft']['help'] = "Enter a width (integer) for left side navigation column (default 150 pixels)";
$cfg['ColumnWidthLeft']['default'] = "150";
$cfg['ColumnWidthLeft']['required'] = TRUE;

// ColumnWidthRight
$cfg['ColumnWidthRight']['section'] = "14";
$cfg['ColumnWidthRight']['type'] = "text";
$cfg['ColumnWidthRight']['help'] = "Enter a width (integer) for right side navigation column (default 150 pixels)";
$cfg['ColumnWidthRight']['default'] = "150";
$cfg['ColumnWidthRight']['required'] = TRUE;

// MarketplaceOptions
$cfg['MarketplaceOptions']['section'] = "14";
$cfg['MarketplaceOptions']['list'] = Array('All', 'New', 'Used', 'Refurbished', 'Collectible');
$cfg['MarketplaceOptions']['type'] = "checkboxes";
$cfg['MarketplaceOptions']['help'] = "These are the condition options that will be displayed on marketplace listing pages";
$cfg['MarketplaceOptions']['required'] = TRUE;

// MarketplaceDefault
$cfg['MarketplaceDefault']['section'] = "14";
$cfg['MarketplaceDefault']['list'] = Array('All', 'New', 'Used', 'Refurbished', 'Collectible');
$cfg['MarketplaceDefault']['type'] = "simplemenu";
$cfg['MarketplaceDefault']['help'] = "When viewing the marketplace listings, this will be the default group to show first (paginated)";
$cfg['MarketplaceDefault']['default'] = "All";

// MerchantPreference
$cfg['MerchantPreference']['section'] = "14";
$cfg['MerchantPreference']['list'] = Array('lowest_new' => 'Lowest Priced New Offer',
										   'lowest_used' => 'Lowest Priced Used Offer',
										   'lowest_collectible' => 'Lowest Priced Collectible Offer',
										   'lowest_refurbished' => 'Lowest Priced Refurbished Offer',
										   'amazon' => 'Amazon Offer',
										   );
$cfg['MerchantPreference']['type'] = "complexmenu";
$cfg['MerchantPreference']['help'] = "This setting controls the merchant preference of the item Buy buttons on Category, Subcategory and Item pages, for items that have more than one offer available. If the preferred offer isn't available, the lowest price offer from the next condition will be used in this order: New, Used, Collectible, Refurbished (depending on which Marketplace offers you selected above). <b>NOTE:</b> If there is more than one offer available, there will also be a 'Buy [New/Used/Refurbished/Collectible]' link which gives the shopper access to all available offers including the main offer you presented first. In some cases, items have variations such as size, color, etc. In these cases, you will see a <b>Select Options</b> button rather than the usual Buy button and/or Buy [New/Used/Refurbished/Collectible] link.";
$cfg['MerchantPreference']['default'] = "lowest_new";

// ListingColumns
$cfg['ListingColumns']['section'] = "14";
$cfg['ListingColumns']['list'] = Array('1', '2', '3');
$cfg['ListingColumns']['type'] = "simplemenu";
$cfg['ListingColumns']['help'] = "This is the number of columns used on applicable Category/Subcategory pages";
$cfg['ListingColumns']['default'] = "2";

// ListingNumbers
$cfg['ListingNumbers']['section'] = "14";
$cfg['ListingNumbers']['list'] = Array('On', 'Off');
$cfg['ListingNumbers']['type'] = "simplemenu";
$cfg['ListingNumbers']['help'] = "Specify whether the item listing numbers are displayed on Category/Subcategory pages";
$cfg['ListingNumbers']['default'] = "Off";

// BodyBorderSize
$cfg['BodyBorderSize']['section'] = "14";
$cfg['BodyBorderSize']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20');
$cfg['BodyBorderSize']['type'] = "simplemenu";
$cfg['BodyBorderSize']['help'] = "Select the border size in pixels for the body content area. In previous verions this was always set at 1. Set it to 0 if you don't want to display the border.";
$cfg['BodyBorderSize']['default'] = "1";

// LineSize
$cfg['LineSize']['section'] = "14";
$cfg['LineSize']['list'] = Array('1', '2', '3', '4');
$cfg['LineSize']['type'] = "simplemenu";
$cfg['LineSize']['help'] = "In various places, separator lines are used to make it easier for the eye to break apart different sections. Select the size of these lines. In previous verions this was always set at 1.";
$cfg['LineSize']['default'] = "1";

// LineType
$cfg['LineType']['section'] = "14";
$cfg['LineType']['list'] = Array('dotted', 'dashed', 'solid');
$cfg['LineType']['type'] = "simplemenu";
$cfg['LineType']['help'] = "In various places, separator lines are used to make it easier for the eye to break apart different sections. Select the type of lines you want to use. In previous versions this was always set to dotted.";
$cfg['LineType']['default'] = "1";

// BreadcrumbSeparator
$cfg['BreadcrumbSeparator']['section'] = "14";
$cfg['BreadcrumbSeparator']['type'] = "complexmenu";
$cfg['BreadcrumbSeparator']['list'] = Array('ra' => '&raquo;',
												'a' => '&gt;',
												':' => ':',
												'::' => '::',
												'~' => '~',
												'/' => '/',
												);
$cfg['BreadcrumbSeparator']['help'] = "Used to separate breadcrumb links";
$cfg['BreadcrumbSeparator']['default'] = "ra";

// DisplayTabs
$cfg['DisplayTabs']['section'] = "17";
$cfg['DisplayTabs']['list'] = Array('Yes', 'No');
$cfg['DisplayTabs']['type'] = "simplemenu";
$cfg['DisplayTabs']['help'] = "Whether you want to display the category Tabs";
$cfg['DisplayTabs']['default'] = "Yes";

// TabStyle
$cfg['TabStyle']['section'] = "17";
$cfg['TabStyle']['list'] = Array('style_01' => 'Rounded',
									 'style_02' => 'Square',
									 );
$cfg['TabStyle']['type'] = "complexmenu";
$cfg['TabStyle']['help'] = "This is the style of the category Tabs";
$cfg['TabStyle']['default'] = "style_01";

// TabSpacing
$cfg['TabSpacing']['section'] = "17";
$cfg['TabSpacing']['list'] = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15');
$cfg['TabSpacing']['type'] = "simplemenu";
$cfg['TabSpacing']['help'] = "This is the horizontal spacing (in pixels) between each category Tab";
$cfg['TabSpacing']['default'] = "0";

// TabsPerRow
$cfg['TabsPerRow']['section'] = "17";
$cfg['TabsPerRow']['list'] = Array('Dynamic', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1');
$cfg['TabsPerRow']['type'] = "simplemenu";
$cfg['TabsPerRow']['help'] = "This is the number of category Tabs to display per row. If Dynamic is selected, then the number of rows will be determined by the width of the browser window.";
$cfg['TabsPerRow']['default'] = "0";

// DisplayEditorialReviews
$cfg['DisplayEditorialReviews']['section'] = "14";
$cfg['DisplayEditorialReviews']['list'] = Array('Yes', 'No');
$cfg['DisplayEditorialReviews']['type'] = "simplemenu";
$cfg['DisplayEditorialReviews']['help'] = "Whether you want to display Editorial reviews on the item detail pages";
$cfg['DisplayEditorialReviews']['default'] = "Yes";

// DisplayCustomerReviews
$cfg['DisplayCustomerReviews']['section'] = "14";
$cfg['DisplayCustomerReviews']['list'] = Array('Yes', 'No');
$cfg['DisplayCustomerReviews']['type'] = "simplemenu";
$cfg['DisplayCustomerReviews']['help'] = "Whether you want to display Customer reviews on the item detail pages";
$cfg['DisplayCustomerReviews']['default'] = "Yes";

// DisplayAccessories
$cfg['DisplayAccessories']['section'] = "14";
$cfg['DisplayAccessories']['list'] = Array('Yes', 'No');
$cfg['DisplayAccessories']['type'] = "simplemenu";
$cfg['DisplayAccessories']['help'] = "Whether you want to display the Accessories (where available, these would be listed on individual item pages)";
$cfg['DisplayAccessories']['default'] = "Yes";

// DisplaySimilarItems
$cfg['DisplaySimilarItems']['section'] = "14";
$cfg['DisplaySimilarItems']['list'] = Array('Yes', 'No');
$cfg['DisplaySimilarItems']['type'] = "simplemenu";
$cfg['DisplaySimilarItems']['help'] = "Whether you want to display the Similar Items (where available, these would be listed on individual item pages)";
$cfg['DisplaySimilarItems']['default'] = "Yes";

// DisplayMarketplaceLinks
$cfg['DisplayMarketplaceLinks']['section'] = "14";
$cfg['DisplayMarketplaceLinks']['list'] = Array('Yes', 'No');
$cfg['DisplayMarketplaceLinks']['type'] = "simplemenu";
$cfg['DisplayMarketplaceLinks']['help'] = "Whether you want to display the Buy [New/Used/Refurbished/Collectible] links which will be present if there is more than one offer price for a particular item. <b>NOTE:</b> Setting this to No greater reduces items you'll have for sale in your store.";
$cfg['DisplayMarketplaceLinks']['default'] = "Yes";

// DisplayCrossSellLinks
$cfg['DisplayCrossSellLinks']['section'] = "14";
$cfg['DisplayCrossSellLinks']['list'] = Array('Yes', 'No');
$cfg['DisplayCrossSellLinks']['type'] = "simplemenu";
$cfg['DisplayCrossSellLinks']['help'] = "Whether you want to display the Cross Selling Links such as authors, actors, etc (where available, these would be found on individual item pages)";
$cfg['DisplayCrossSellLinks']['default'] = "Yes";

// DisplayAmazonRefs
$cfg['DisplayAmazonRefs']['section'] = "14";
$cfg['DisplayAmazonRefs']['list'] = Array('Yes', 'No');
$cfg['DisplayAmazonRefs']['type'] = "simplemenu";
$cfg['DisplayAmazonRefs']['help'] = "Whether you want to display references to \"Amazon\" within your store pages, where applicable";
$cfg['DisplayAmazonRefs']['default'] = "Yes";

// DisplaySearchAllOption
$cfg['DisplaySearchAllOption']['new'] = TRUE;
$cfg['DisplaySearchAllOption']['section'] = "14";
$cfg['DisplaySearchAllOption']['list'] = Array('Yes', 'No');
$cfg['DisplaySearchAllOption']['type'] = "simplemenu";
$cfg['DisplaySearchAllOption']['help'] = "Whether you want to display the 'All Products' option in the search bar drop down box. If set to no, your first catgory will be the default. <b>NOTE:</b> This can be useful in situations where your store categories are under one Amazon category and the 'All Products' results are combined.";
$cfg['DisplaySearchAllOption']['default'] = "Yes";

// DisplayViewCartLink
$cfg['DisplayViewCartLink']['new'] = TRUE;
$cfg['DisplayViewCartLink']['section'] = "14";
$cfg['DisplayViewCartLink']['list'] = Array('Yes', 'No');
$cfg['DisplayViewCartLink']['type'] = "simplemenu";
$cfg['DisplayViewCartLink']['help'] = "Whether you want to display the 'View Cart' link. If set to no, you will need to create your own link to the View Cart page.";
$cfg['DisplayViewCartLink']['default'] = "Yes";

// DisplayCheckoutLink
$cfg['DisplayCheckoutLink']['new'] = TRUE;
$cfg['DisplayCheckoutLink']['section'] = "14";
$cfg['DisplayCheckoutLink']['list'] = Array('Yes', 'No');
$cfg['DisplayCheckoutLink']['type'] = "simplemenu";
$cfg['DisplayCheckoutLink']['help'] = "Whether you want to display the 'Checkout' link. If set to no, there will still be a Checkout button on the View Cart page.";
$cfg['DisplayCheckoutLink']['default'] = "Yes";

// DisplaySearchBar
$cfg['DisplaySearchBar']['section'] = "14";
$cfg['DisplaySearchBar']['list'] = Array('Yes', 'No');
$cfg['DisplaySearchBar']['type'] = "simplemenu";
$cfg['DisplaySearchBar']['help'] = "Whether you want to display the search bar which includes the search box and links to Advanced Search, View Cart and Checkout. <b>NOTE:</b> If you set this to No, you will need to create your own links to the Advanced Search, View Cart and Checkout pages should you choose.";
$cfg['DisplaySearchBar']['default'] = "Yes";

// DisplayBreadcrumbs
$cfg['DisplayBreadcrumbs']['section'] = "14";
$cfg['DisplayBreadcrumbs']['list'] = Array('Yes', 'No');
$cfg['DisplayBreadcrumbs']['type'] = "simplemenu";
$cfg['DisplayBreadcrumbs']['help'] = "Whether you want to display the category/subcategory link 'breadcrumb' trail";
$cfg['DisplayBreadcrumbs']['default'] = "Yes";

// TitleHome
$cfg['TitleHome']['section'] = "11";
$cfg['TitleHome']['type'] = "text";
$cfg['TitleHome']['help'] = "This is the Title format used on the homepage. Leave as is for the default (e.g. {SITE_NAME}: {SITE_SLOGAN} ) or enter the title variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['TitleHome']['default'] = "{SITE_NAME}: {SITE_SLOGAN}";
$cfg['TitleHome']['required'] = TRUE;

// TitleSearchAll
$cfg['TitleSearchAll']['section'] = "11";
$cfg['TitleSearchAll']['type'] = "text";
$cfg['TitleSearchAll']['help'] = "This is the Title format used when searching a all categories. Leave as is for the default (e.g. {SITE_NAME}: {KEYWORD} ) or enter the title variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{KEYWORD}</b>&nbsp;&nbsp;&nbsp;uses keyword entered by user<br><br>";
$cfg['TitleSearchAll']['default'] = "{SITE_NAME}: {KEYWORD}";
$cfg['TitleSearchAll']['required'] = TRUE;

// TitleSearch
$cfg['TitleSearch']['section'] = "11";
$cfg['TitleSearch']['type'] = "text";
$cfg['TitleSearch']['help'] = "This is the Title format used when searching a single category. Leave as is for the default (e.g. {SITE_NAME}: {CATEGORY_NAME}: {KEYWORD} ) or enter the title variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{KEYWORD}</b>&nbsp;&nbsp;&nbsp;uses keyword entered by user<br><br>";
$cfg['TitleSearch']['default'] = "{SITE_NAME}: {CATEGORY_NAME}: {KEYWORD}";
$cfg['TitleSearch']['required'] = TRUE;

// TitleCategory
$cfg['TitleCategory']['section'] = "11";
$cfg['TitleCategory']['type'] = "text";
$cfg['TitleCategory']['help'] = "This is the Title format used on category pages. Leave as is for the default (e.g. {SITE_NAME}: {CATEGORY_NAME} ) or enter the title variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><br>";
$cfg['TitleCategory']['default'] = "{SITE_NAME}: {CATEGORY_NAME}";
$cfg['TitleCategory']['required'] = TRUE;

// TitleSubcategory
$cfg['TitleSubcategory']['section'] = "11";
$cfg['TitleSubcategory']['type'] = "text";
$cfg['TitleSubcategory']['help'] = "This is the Title format used on subcategory pages. Leave as is for the default (e.g. {SITE_NAME}: {CATEGORY_NAME}: {SUBCATEGORY_NAME} ) or enter the title variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SUBCATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;(uses value returned by Amazon)<br><br>";
$cfg['TitleSubcategory']['default'] = "{SITE_NAME}: {CATEGORY_NAME}: {SUBCATEGORY_NAME}";
$cfg['TitleSubcategory']['required'] = TRUE;

// TitleItem
$cfg['TitleItem']['section'] = "11";
$cfg['TitleItem']['type'] = "text";
$cfg['TitleItem']['help'] = "This is the Title format used on item pages. Leave as is for the default (e.g. {SITE_NAME}: {CATEGORY_NAME}: {ITEM_NAME} ) or enter the title variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SUBCATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{ITEM_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{ASIN}</b>&nbsp;&nbsp;&nbsp;Amazon item number<br><br>";
$cfg['TitleItem']['default'] = "{SITE_NAME}: {CATEGORY_NAME}: {ITEM_NAME}";
$cfg['TitleItem']['required'] = TRUE;

// MetaDescriptionHome
$cfg['MetaDescriptionHome']['new'] = TRUE;
$cfg['MetaDescriptionHome']['section'] = "22";
$cfg['MetaDescriptionHome']['type'] = "text";
$cfg['MetaDescriptionHome']['help'] = "This is the Meta Description format used on the homepage. Leave as is for the default (e.g. {SITE_DESCRIPTION} ) or enter the Meta Description variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaDescriptionHome']['default'] = "{SITE_DESCRIPTION}";
$cfg['MetaDescriptionHome']['required'] = TRUE;

// MetaDescriptionSearchAll
$cfg['MetaDescriptionSearchAll']['new'] = TRUE;
$cfg['MetaDescriptionSearchAll']['section'] = "22";
$cfg['MetaDescriptionSearchAll']['type'] = "text";
$cfg['MetaDescriptionSearchAll']['help'] = "This is the Meta Description format used when searching a all categories. Leave as is for the default (e.g. {KEYWORD} - {SITE_DESCRIPTION} ) or enter the Meta Description variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{KEYWORD}</b>&nbsp;&nbsp;&nbsp;uses keyword entered by user<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaDescriptionSearchAll']['default'] = "{KEYWORD} - {SITE_DESCRIPTION}";
$cfg['MetaDescriptionSearchAll']['required'] = TRUE;

// MetaDescriptionSearch
$cfg['MetaDescriptionSearch']['new'] = TRUE;
$cfg['MetaDescriptionSearch']['section'] = "22";
$cfg['MetaDescriptionSearch']['type'] = "text";
$cfg['MetaDescriptionSearch']['help'] = "This is the Meta Description format used on item pages. Leave as is for the default (e.g. {KEYWORD} - {CATEGORY_NAME} - {SITE_DESCRIPTION} ) or enter the Meta Description variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{KEYWORD}</b>&nbsp;&nbsp;&nbsp;uses keyword entered by user<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaDescriptionSearch']['default'] = "{KEYWORD} - {CATEGORY_NAME} - {SITE_DESCRIPTION}";
$cfg['MetaDescriptionSearch']['required'] = TRUE;

// MetaDescriptionCategory
$cfg['MetaDescriptionCategory']['new'] = TRUE;
$cfg['MetaDescriptionCategory']['section'] = "22";
$cfg['MetaDescriptionCategory']['type'] = "text";
$cfg['MetaDescriptionCategory']['help'] = "This is the Meta Description format used on item pages. Leave as is for the default (e.g. {CATEGORY_NAME} - {SITE_DESCRIPTION} ) or enter the Meta Description variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaDescriptionCategory']['default'] = "{CATEGORY_NAME} - {SITE_DESCRIPTION}";
$cfg['MetaDescriptionCategory']['required'] = TRUE;

// MetaDescriptionSubcategory
$cfg['MetaDescriptionSubcategory']['new'] = TRUE;
$cfg['MetaDescriptionSubcategory']['section'] = "22";
$cfg['MetaDescriptionSubcategory']['type'] = "text";
$cfg['MetaDescriptionSubcategory']['help'] = "This is the Meta Description format used on item pages. Leave as is for the default (e.g. {SUBCATEGORY_NAME} - {CATEGORY_NAME} - {SITE_DESCRIPTION} ) or enter the Meta Description variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SUBCATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaDescriptionSubcategory']['default'] = "{SUBCATEGORY_NAME} - {CATEGORY_NAME} - {SITE_DESCRIPTION}";
$cfg['MetaDescriptionSubcategory']['required'] = TRUE;

// MetaDescriptionItem
$cfg['MetaDescriptionItem']['new'] = TRUE;
$cfg['MetaDescriptionItem']['section'] = "22";
$cfg['MetaDescriptionItem']['type'] = "text";
$cfg['MetaDescriptionItem']['help'] = "This is the Meta Description format used on item pages. Leave as is for the default (e.g. {ITEM_NAME} - {SUBCATEGORY_NAME} - {CATEGORY_NAME} - {SITE_DESCRIPTION} ) or enter the Meta Description variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SUBCATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{ITEM_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{ASIN}</b>&nbsp;&nbsp;&nbsp;Amazon item number<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaDescriptionItem']['default'] = "{ITEM_NAME} - {SUBCATEGORY_NAME} - {CATEGORY_NAME} - {SITE_DESCRIPTION}";
$cfg['MetaDescriptionItem']['required'] = TRUE;

// MetaKeywordsHome
$cfg['MetaKeywordsHome']['new'] = TRUE;
$cfg['MetaKeywordsHome']['section'] = "21";
$cfg['MetaKeywordsHome']['type'] = "text";
$cfg['MetaKeywordsHome']['help'] = "This is the Meta Keywords format used on the homepage. Leave as is for the default (e.g. {SITE_KEYWORDS} ) or enter the Meta Keywords variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{SITE_KEYWORDS}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaKeywordsHome']['default'] = "{SITE_KEYWORDS}";
$cfg['MetaKeywordsHome']['required'] = TRUE;

// MetaKeywordsSearchAll
$cfg['MetaKeywordsSearchAll']['new'] = TRUE;
$cfg['MetaKeywordsSearchAll']['section'] = "21";
$cfg['MetaKeywordsSearchAll']['type'] = "text";
$cfg['MetaKeywordsSearchAll']['help'] = "This is the Meta Keywords format used when searching a all categories. Leave as is for the default (e.g. {KEYWORD}, {SITE_KEYWORDS} ) or enter the Meta Keywords variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{KEYWORD}</b>&nbsp;&nbsp;&nbsp;uses keyword entered by user<br><b>{SITE_KEYWORDS}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaKeywordsSearchAll']['default'] = "{KEYWORD}, {SITE_KEYWORDS}";
$cfg['MetaKeywordsSearchAll']['required'] = TRUE;

// MetaKeywordsSearch
$cfg['MetaKeywordsSearch']['new'] = TRUE;
$cfg['MetaKeywordsSearch']['section'] = "21";
$cfg['MetaKeywordsSearch']['type'] = "text";
$cfg['MetaKeywordsSearch']['help'] = "This is the Meta Keywords format used on item pages. Leave as is for the default (e.g. {KEYWORD}, {CATEGORY_NAME}, {SITE_KEYWORDS} ) or enter the Meta Keywords variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{KEYWORD}</b>&nbsp;&nbsp;&nbsp;uses keyword entered by user<br><b>{SITE_KEYWORDS}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaKeywordsSearch']['default'] = "{KEYWORD}, {CATEGORY_NAME}, {SITE_KEYWORDS}";
$cfg['MetaKeywordsSearch']['required'] = TRUE;

// MetaKeywordsCategory
$cfg['MetaKeywordsCategory']['new'] = TRUE;
$cfg['MetaKeywordsCategory']['section'] = "21";
$cfg['MetaKeywordsCategory']['type'] = "text";
$cfg['MetaKeywordsCategory']['help'] = "This is the Meta Keywords format used on item pages. Leave as is for the default (e.g. {CATEGORY_NAME}, {SITE_KEYWORDS} ) or enter the Meta Keywords variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SITE_KEYWORDS}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaKeywordsCategory']['default'] = "{CATEGORY_NAME}, {SITE_KEYWORDS}";
$cfg['MetaKeywordsCategory']['required'] = TRUE;

// MetaKeywordsSubcategory
$cfg['MetaKeywordsSubcategory']['new'] = TRUE;
$cfg['MetaKeywordsSubcategory']['section'] = "21";
$cfg['MetaKeywordsSubcategory']['type'] = "text";
$cfg['MetaKeywordsSubcategory']['help'] = "This is the Meta Keywords format used on item pages. Leave as is for the default (e.g. {SUBCATEGORY_NAME}, {CATEGORY_NAME}, {SITE_KEYWORDS} ) or enter the Meta Keywords variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SUBCATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{SITE_KEYWORDS}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaKeywordsSubcategory']['default'] = "{SUBCATEGORY_NAME}, {CATEGORY_NAME}, {SITE_KEYWORDS}";
$cfg['MetaKeywordsSubcategory']['required'] = TRUE;

// MetaKeywordsItem
$cfg['MetaKeywordsItem']['new'] = TRUE;
$cfg['MetaKeywordsItem']['section'] = "21";
$cfg['MetaKeywordsItem']['type'] = "text";
$cfg['MetaKeywordsItem']['help'] = "This is the Meta Keywords format used on item pages. Leave as is for the default (e.g. {ITEM_NAME}, {SUBCATEGORY_NAME}, {CATEGORY_NAME}, {SITE_KEYWORDS} ) or enter the Meta Keywords variables you want displayed, in the order you want them displayed along with any static text.<br><br><b>Available Variables</b>:<br><b>{CATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses applicable category name entered above<br><b>{SUBCATEGORY_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{ITEM_NAME}</b>&nbsp;&nbsp;&nbsp;uses value returned by Amazon<br><b>{ASIN}</b>&nbsp;&nbsp;&nbsp;Amazon item number<br><b>{SITE_KEYWORDS}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_DESCRIPTION}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_NAME}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><b>{SITE_SLOGAN}</b>&nbsp;&nbsp;&nbsp;uses value entered above<br><br>";
$cfg['MetaKeywordsItem']['default'] = "{ITEM_NAME}, {SUBCATEGORY_NAME}, {CATEGORY_NAME}, {SITE_KEYWORDS}";
$cfg['MetaKeywordsItem']['required'] = TRUE;

// ShoppingCart
$cfg['ShoppingCart']['section'] = "7";
$cfg['ShoppingCart']['list'] = Array('Yes', 'No');
$cfg['ShoppingCart']['type'] = "simplemenu";
$cfg['ShoppingCart']['help'] = "Whether or not to use the built-in Associate-O-Matic shopping cart. If, Yes, items will be added to the built-in cart and at checkout the cart contents are dumped into the Amazon shopping cart. If, No, the buy buttons will open a new browser window pointing to the specific product page on Amazon's site. Whether you use the built-in cart or not, eventually the shopper will do final checkout on Amazon's site.";
$cfg['ShoppingCart']['default'] = "Yes";
$cfg['ShoppingCart']['required'] = false;

// ShoppingCartInstructions
$cfg['ShoppingCartInstructions']['section'] = "7";
$cfg['ShoppingCartInstructions']['type'] = "textarea";
$cfg['ShoppingCartInstructions']['help'] = "If Shopping Cart is enabled above, this HTML will be presented on the view cart screen (before checkout at Amazon). This is a good place to put any instructions or other messages.";

// ReportsEmail
$cfg['ReportsEmail']['section'] = "12";
$cfg['ReportsEmail']['type'] = "text";
$cfg['ReportsEmail']['help'] = "If entered, this is the email address where Associate-O-Matic will send reporting information";

// Reports
$cfg['Reports']['section'] = "12";
$cfg['Reports']['list'] = Array('Remote_Cart');
$cfg['Reports']['type'] = "checkboxes";
$cfg['Reports']['help'] = "Choose the reports you would like sent to your email above:<br><br><b>Remote Cart:</b> You will be sent remote cart content information in real-time, as visitors checkout from your site to Amazon. This does not mean they will complete the purchase, but it does give you an idea of what people are putting in their carts and what they might purchase.<br><br>";

// PoweredBy
$cfg['PoweredBy']['section'] = "8";
$cfg['PoweredBy']['type'] = "textarea";
$cfg['PoweredBy']['help'] = "This controls the Powered By link area. Whatever you enter here will replace the current Powered By link generated by Associate-O-Matic. We are a small software company so by leaving this field as is, you help us to be able to continue improving the application.<br><br>Additionally, you can become an affiliate of Associate-O-Matic and earn a referral fee for software sales by placing special affiliate HTML in this area. To join our affiliate program, <a href=\"http://www.clixgalore.com/AffSelectProgram.aspx?AdvProgID=3791\" target=\"_blank\">Click Here</a><br><br>";
$cfg['PoweredBy']['default'] = "";
$cfg['PoweredBy']['required'] = false;

// SearchCombo
$cfg['SearchCombo']['section'] = "13";
$cfg['SearchCombo']['list'] = Array('Yes', 'No');
$cfg['SearchCombo']['type'] = "simplemenu";
$cfg['SearchCombo']['help'] = "If set to Yes, any user-entered search term(s) will be combined with the category-level keywords OR Site Default Keyword (if defined). If set to No, then only the user-entered search term(s) will be used. See our documentation for an in-depth look at how this works. <b>NOTE:</b> Setting this to Yes means you will see more focused search results, but it could also mean you lose out on sales if someone wants to search more generally.";
$cfg['SearchCombo']['default'] = "No";

// SearchRecovery
$cfg['SearchRecovery']['section'] = "13";
$cfg['SearchRecovery']['list'] = Array('0', '1', '2', '3');
$cfg['SearchRecovery']['type'] = "simplemenu";
$cfg['SearchRecovery']['help'] = "This is the maximum number of recovery search attempts made when keyword combinations return no results from Amazon. See our documentation for an in-depth look at how this works. If this option is set to 0, when no results are found, no recovery searches will take place.";
$cfg['SearchRecovery']['default'] = "1";

// SearchPriority
$cfg['SearchPriority']['section'] = "13";
$cfg['SearchPriority']['list'] = Array('user_key'	=> 'User keyword trumps your keywords',
									   'your_key' 	=> 'Your keywords trump user keyword',
									   );
$cfg['SearchPriority']['type'] = "complexmenu";
$cfg['SearchPriority']['default'] = "";
$cfg['SearchPriority']['help'] = "If set to 'User keyword trumps your keywords', in search recovery attempts user keywords will be used before your keywords. If 'Your keywords trump user keyword' is selected, the inverse is true. See our documentation for an in-depth look at how this works.";
$cfg['SearchPriority']['default'] = "user_key";

// HomePageFormat
$cfg['HomePageFormat']['section'] = "15";
$cfg['HomePageFormat']['type'] = "homepage";
$cfg['HomePageFormat']['list'] = Array('blended'	=> 'Blended',
									 'item' 	=> 'Single Item',
									 'node' 	=> 'Browse Node',
									 'asin'		=> 'ASIN List',
									 'mall'		=> 'Mall',
									 'custom'	=> 'Custom HTML',
									 );
$cfg['HomePageFormat']['help'] = "Select the format you would like for your homepage. Keep in mind there may be other settings that require input depending on which format you choose.<br><br><b>Blended:</b><br>Lists up to 3 items from each of your site categories. Requires the <b>Site Default Keyword</b> (above). <b>NOTE:</b> This format is ideal for stores setting up one AOM Category for each Amazon Category and not ideal if you have many AOM Categories under a single Amazon Category.<br><br><b>Single Item:</b><br>Displays a detailed view of a single item (Amazon ASIN). Requires the <b>Home Item</b> (below)<br><br><b>Browse Node:</b><br>Displays 10 items (with more items paginated) from the node of your choice. Requires the <b>Home Node</b> information (below)<br><br><b>ASIN List:</b><br>Lists up to 10 ASINs. Requires the <b>Home Asins</b> (below)<br><br><b>Mall:</b><br>Lists links to your site categories along with 3-4 related subcategories (see the documentation on how to customize these subcategories).<br><br><b>Custom HTML:</b><br>Displays your own HTML. Requires the <b>Home Html</b> (below)<br><br><br>";
$cfg['HomePageFormat']['default'] = "blended";
$cfg['HomePageFormat']['required'] = TRUE;

// HomeWelcomeHtml
$cfg['HomeWelcomeHtml']['section'] = "15";
$cfg['HomeWelcomeHtml']['type'] = "textarea";
$cfg['HomeWelcomeHtml']['help'] = "Can be used with any of the Home Page formats from above. If provided, this welcome HTML will be used at the top of the body section of the home page, above the Associate-O-Matic genereated content.";

// HomeBlendedCount
$cfg['HomeBlendedCount']['section'] = "15";
$cfg['HomeBlendedCount']['list'] = Array('1', '2', '3');
$cfg['HomeBlendedCount']['type'] = "simplemenu";
$cfg['HomeBlendedCount']['help'] = "When the <b>Home Page Format</b> is set to <b>Blended</b>, this is the number of items per category that will be displayed. <b>NOTE:</b> Amazon returns a maximum of 3 items per category though some categories might return 1 or 2 results depending on the Site Default Keyword.";
$cfg['HomeBlendedCount']['default'] = "3";

// HomeItem
$cfg['HomeItem']['section'] = "15";
$cfg['HomeItem']['type'] = "text";
$cfg['HomeItem']['help'] = "When the <b>Home Page Format</b> is set to <b>Single Item</b>, it is the item (Amazon ASIN) that will be used. The ASIN must be from the main group of categories you setup for your site under the Categories section. <b>NOTE:</b> Also, the ASIN entered must be from the same locale as your store (e.g. Amazon.com, Amazon.co.uk, etc).";

// HomeNode
$cfg['HomeNode']['section'] = "15";
$cfg['HomeNode']['type'] = "node";
$cfg['HomeNode']['help'] = "When the <b>Home Page Format</b> is set to <b>Browse Node</b>, this is the node information that will be used. Amazon returns up to 10 items (with more items paginated). <b>NOTE:</b> The Amazon Category selected must be from the main group of categories you setup for your site under the Categories section.";

// HomeAsins
$cfg['HomeAsins']['section'] = "15";
$cfg['HomeAsins']['type'] = "text";
$cfg['HomeAsins']['help'] = "When the <b>Home Page Format</b> is set to <b>ASIN List</b>, these are the ASINs that will be used. Enter from 1 to 10 Amazon ASINs. ASINs are Amazon part numbers. If provided, these ASIN(s) will be displayed on the home page instead of the usual Blended Search based on the Site Default Keyword. Enter ASINs separated by comma (e.g. 0345428838,0345428838). <b>NOTE:</b> The 10 item limit is an Amazon imposed limit. Also, you cannot mix and match ASINs from the different locales (e.g. Amazon.com and Amazon.co.uk). They must all be from the same locale as your store.";

// HomeHtml
$cfg['HomeHtml']['section'] = "15";
$cfg['HomeHtml']['type'] = "textarea";
$cfg['HomeHtml']['help'] = "When the <b>Home Page Format</b> is set to <b>Custom HTML</b>, the HTML you enter here will be used in the body section of the home page.";

// AmazonConnectionMethod
$cfg['AmazonConnectionMethod']['section'] = "8";
$cfg['AmazonConnectionMethod']['list'] = Array('aom' => '** RECOMMENDED ** Let Associate-O-Matic determine best method',
							 		 		   'rest_file' => 'REST (file)',
							 		 		   'rest_curl' => 'REST (curl)',
							 		 		   'soap' => 'SOAP',
							 		 		   );
$cfg['AmazonConnectionMethod']['type'] = "complexmenu";
$cfg['AmazonConnectionMethod']['help'] = "This is for troubleshooting purposes only and should not be changed unless you are directed to do so by our support team or you are not able to connect to Amazon and get errors to this effect. Almost always you will want to let the Associate-O-Matic determine the best connection method.";
$cfg['AmazonConnectionMethod']['default'] = "aom";

// ModRewrite
$cfg['ModRewrite']['section'] = "18";
$cfg['ModRewrite']['list'] = Array('On', 'Off');
$cfg['ModRewrite']['type'] = "simplemenu";
$cfg['ModRewrite']['help'] = "<b>WARNING:</b> This feature is for advanced users only and requires that you enable mod_rewrite on your server as well as upload an .htaccess file with the mod_rewrite rules. Leave set to Off if you do not know what this is. If set to On, URLs generated by Associate-O-Matic will become search engine friendly and will be parsable according to the mod_rewrite rules provided in our documentation.";
$cfg['ModRewrite']['default'] = "Off";

// UrlHomeFile
$cfg['UrlHomeFile']['section'] = "18";
$cfg['UrlHomeFile']['type'] = "text";
$cfg['UrlHomeFile']['help'] = "If Mod Rewrite is set to On, this is the name used in links to your homepage from within the store (e.g. home, index.html, shop, etc...). Keep in mind the file doesn't have to exist because the URL will get rewritten to your actual store URL. <b>NOTE:</b> You will need to modify the first line in the mod rewrite rules we provide to reflect the name you choose: RewriteRule ^<b>[Url Home File]</b>	shop.php";
$cfg['UrlHomeFile']['default'] = "home";

// UrlEndsWith
$cfg['UrlEndsWith']['section'] = "18";
$cfg['UrlEndsWith']['list'] = Array('.html', '');
$cfg['UrlEndsWith']['type'] = "simplemenu";
$cfg['UrlEndsWith']['help'] = "If Mod Rewrite is set to On, this setting determines how mod_rewritten URLs end. Be sure to use the correct rule set for the ending you've chosen (see the online documentation).";
$cfg['UrlEndsWith']['default'] = ".html";

// UrlWithName
$cfg['UrlWithName']['section'] = "18";
$cfg['UrlWithName']['list'] = Array('Yes', 'No');
$cfg['UrlWithName']['type'] = "simplemenu";
$cfg['UrlWithName']['help'] = "If set to Yes, where applicable (e.g. item links, category links, review links, marketplace links, etc), the Item Name or Category Name will be added to the link (depending on context). It's sole purpose is to help with search engine ranking. Setting it to Yes or No will not effect the functionality of your store. <b>NOTE:</b> This setting can be used with mod_rewrite On or Off (mod_rewrite is not available in Lite version). With mod_rewrite Off, a 'x=[name here]' parameter is added to the end of the URL. With mod_rewrite On, the name is simply added to the end of the URL. Be sure to use the correct rule set for the ending you've chosen (see the online documentation).";
$cfg['UrlWithName']['default'] = "Yes";

// PageCaching
$cfg['PageCaching']['section'] = "19";
$cfg['PageCaching']['list'] = Array('On', 'Off');
$cfg['PageCaching']['type'] = "simplemenu";
$cfg['PageCaching']['help'] = "Leave Page Caching set to On to have your store pages load faster. It means that instead of calling the Amazon servers with each request, pages are requested once and then stored (cached) on your server for future visitors for a period of 24 hours. Once that 24 hours passes, a new version of the page is pulled from Amazon with the next visit and cached for another 24 hour period.";
$cfg['PageCaching']['default'] = "On";

// CacheCleanup
$cfg['CacheCleanup']['section'] = "19";
$cfg['CacheCleanup']['list'] = Array('Never', '1000', '500', '400', '300', '200', '100', '90', '80', '70', '60', '50', '40', '30', '20', '10', '5');
$cfg['CacheCleanup']['type'] = "simplemenu";
$cfg['CacheCleanup']['help'] = "Page Caching requires server storage space. This settings ensures that old cached pages are cleaned from your server automatically and don't use up this valuable space. Setting this value to <b>20</b> means there is a 1 in <b>20</b> chance cache files older than 24 hours will be cleared. Setting this value higher means your cache will be cleared less often which can improve performance at the cost higher disk space usage. Setting this value lower means your cache will be cleared more frequently which will leave more disk space available at the cost of performance. We recommend the default of 20. Set higher or lower depending on your store traffic and storage limits.";
$cfg['CacheCleanup']['default'] = "20";

// CurrencyRate
$cfg['CurrencyRate']['new'] = TRUE;
$cfg['CurrencyRate']['section'] = "23";
$cfg['CurrencyRate']['type'] = "text";
$cfg['CurrencyRate']['help'] = "This is the static currency conversion rate for the currency you want to convert to. If you were converting from USD to EUR and the current conversion rate was 0.853026 you would enter this value. Keep in mind this would only be an estimated conversion as the rates will frequently change. It needs to be manually maintained.";
$cfg['CurrencyRate']['default'] = "";

// CurrencySymbolPrefix
$cfg['CurrencySymbolPrefix']['new'] = TRUE;
$cfg['CurrencySymbolPrefix']['section'] = "23";
$cfg['CurrencySymbolPrefix']['type'] = "text";
$cfg['CurrencySymbolPrefix']['help'] = "This is the symbol to use at the beginning of the converted currency value, if supplied and if currency rate above is set. Using the above USD/EUR example for a $15 item with a prefix of 'EUR ' would be displayed as: $15.00 (EUR 12.80)";
$cfg['CurrencySymbolPrefix']['default'] = "";

// CurrencySymbolSuffix
$cfg['CurrencySymbolSuffix']['new'] = TRUE;
$cfg['CurrencySymbolSuffix']['section'] = "23";
$cfg['CurrencySymbolSuffix']['type'] = "text";
$cfg['CurrencySymbolSuffix']['help'] = "This is the symbol to use at the end of the converted currency value, if supplied and if currency rate above is set. Using the above USD/EUR example for a $15 item with a suffix of ' EUR' would be displayed as: $15.00 (12.80 EUR)";
$cfg['CurrencySymbolSuffix']['default'] = "";

?>