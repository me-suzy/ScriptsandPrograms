<html>
<head>
<style type="text/css">
body {font-family: arial}
</style></head>

<body bgcolor='#CCCCFF'>
<?php
include("includes/db.conf.php");
include("includes/connect.inc.php");



$sql= "CREATE TABLE admin (".
  "id int(3) NOT NULL default '0',".
  "username varchar(20) NOT NULL default '',".
  "password varchar(50) NOT NULL default '',".
  "overid varchar(30) NOT NULL default ''".
") TYPE=MyISAM;";

      if (mysql_query($sql)) {
        echo("<P>The table admin have been created</P>");
      } else {
        echo("<P>Error creating the table admin: " .
             mysql_error() . "</P>");
              $er=1 ;
      }
$pass=md5($_POST['password']);
$sql="insert INTO admin VALUES ('1','$_POST[username]','$pass','MSCAxU4Bdrc' );";

      if (mysql_query($sql)) {
        echo("<P>The table admin values have been inserted</P>");
      } else {
        echo("<P>Error inserting the table admin values: " .
             mysql_error() . "</P>");
              $er=1 ;
      }
      
$sql= "CREATE TABLE booksbusinesstech (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "isbn varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "author varchar(100) NOT NULL default '',".
  "publisher varchar(100) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
 " PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

      if (mysql_query($sql)) {
        echo("<P>The table booksbusinesstech have been created</P>");
      } else {
        echo("<P>Error creating the table booksbusinesstech

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }


$sql= "CREATE TABLE booksfiction (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "isbn varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
 " author varchar(100) NOT NULL default '',".
  "publisher varchar(100) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table booksfiction have been created</P>");
      } else {
        echo("<P>Error creating the table booksfiction

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql= "CREATE TABLE booksjuvenile (".
  "sku int(11) NOT NULL default '0',".
 " title varchar(200) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "isbn varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "author varchar(100) NOT NULL default '',".
  "publisher varchar(100) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table booksjuvenile have been created</P>");
      } else {
        echo("<P>Error creating the table booksjuvenile

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql= "CREATE TABLE booksmiscellaneous (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
 "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "isbn varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "author varchar(100) NOT NULL default '',".
  "publisher varchar(100) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table booksmiscellaneous have been created</P>");
      } else {
        echo("<P>Error creating the table booksmiscellaneous

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql= "CREATE TABLE booksnonfiction (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "isbn varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "author varchar(100) NOT NULL default '',".
  "publisher varchar(100) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table booksnonfiction have been created</P>");
      } else {
        echo("<P>Error creating the table booksnonfiction

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql= "CREATE TABLE bookstextbooks (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "isbn varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "author varchar(100) NOT NULL default '',".
  "publisher varchar(100) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table bookstextbooks have been created</P>");
      } else {
        echo("<P>Error creating the table bookstextbooks

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE categories (".
  "id int(11) NOT NULL auto_increment,".
  "category varchar(50) NOT NULL default '',".
  "department int(3) NOT NULL default '0',".
  "PRIMARY KEY  (id)".
") TYPE=MyISAM AUTO_INCREMENT=441 ;";

if (mysql_query($sql)) {
        echo("<P>The table categories have been created</P>");
      } else {
        echo("<P>Error creating the table categories

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }
      
$sql=mysql_query("insert INTO categories VALUES (1, 'Women''s Shirts', 1);");
$sql=mysql_query("insert INTO categories VALUES (2, 'Women''s Pants', 1);");
$sql=mysql_query("insert INTO categories VALUES (3, 'Women''s Suits', 1);");
$sql=mysql_query("insert INTO categories VALUES (4, 'Women''s Dresses', 1);");
$sql=mysql_query("insert INTO categories VALUES (5, 'Women''s Sweaters', 1);");
$sql=mysql_query("insert INTO categories VALUES (6, 'Women''s Outerwear', 1);");
$sql=mysql_query("insert INTO categories VALUES (7, 'Women''s Activewear', 1);");
$sql=mysql_query("insert INTO categories VALUES (8, 'Women''s Lingerie', 1);");
$sql=mysql_query("insert INTO categories VALUES (9, 'Women''s Plus Sizes', 1);");
$sql=mysql_query("insert INTO categories VALUES (10, 'Women''s Shorts', 1);");
$sql=mysql_query("insert INTO categories VALUES (11, 'Women''s Skirts', 1);");
$sql=mysql_query("insert INTO categories VALUES (12, 'Women''s Petites', 1);");
$sql=mysql_query("insert INTO categories VALUES (13, 'Men''s Shirts', 2);");
$sql=mysql_query("insert INTO categories VALUES (14, 'Men''s Pants', 2);");
$sql=mysql_query("insert INTO categories VALUES (15, 'Men''s Suits & Sportcoats', 2);");
$sql=mysql_query("insert INTO categories VALUES (16, 'Men''s Sweaters', 2);");
$sql=mysql_query("insert INTO categories VALUES (17, 'Men''s Activewear', 2);");
$sql=mysql_query("insert INTO categories VALUES (18, 'Men''s Outerwear', 2);");
$sql=mysql_query("insert INTO categories VALUES (19, 'Men''s Underwear & Pajamas', 2);");
$sql=mysql_query("insert INTO categories VALUES (20, 'Men''s Big and Tall', 2);");
$sql=mysql_query("insert INTO categories VALUES (21, 'Men''s Ties', 2);");
$sql=mysql_query("insert INTO categories VALUES (22, 'Men''s Shorts', 2);");
$sql=mysql_query("insert INTO categories VALUES (23, 'Infant Boys', 3);");
$sql=mysql_query("insert INTO categories VALUES (24, 'Infant Girls', 3);");
$sql=mysql_query("insert INTO categories VALUES (25, 'Kids - Boys', 3);");
$sql=mysql_query("insert INTO categories VALUES (26, 'Kids - Girls', 3);");
$sql=mysql_query("insert INTO categories VALUES (27, 'Newborn Boys', 3);");
$sql=mysql_query("insert INTO categories VALUES (28, 'Newborn Girls', 3);");
$sql=mysql_query("insert INTO categories VALUES (29, 'Toddler Boys', 3);");
$sql=mysql_query("insert INTO categories VALUES (30, 'Toddler Girls', 3);");
$sql=mysql_query("insert INTO categories VALUES (31, 'Designer Sunglasses', 4);");
$sql=mysql_query("insert INTO categories VALUES (32, 'Handbags', 4);");
$sql=mysql_query("insert INTO categories VALUES (33, 'Sport Sunglasses', 4);");
$sql=mysql_query("insert INTO categories VALUES (34, 'Belts', 4);");
$sql=mysql_query("insert INTO categories VALUES (35, 'Wallets', 4);");
$sql=mysql_query("insert INTO categories VALUES (36, 'Gloves', 4);");
$sql=mysql_query("insert INTO categories VALUES (37, 'Keyrings', 4);");
$sql=mysql_query("insert INTO categories VALUES (38, 'Eyeglasses', 4);");
$sql=mysql_query("insert INTO categories VALUES (39, 'Hats', 4);");
$sql=mysql_query("insert INTO categories VALUES (40, 'Ponchos & Wraps', 4);");
$sql=mysql_query("insert INTO categories VALUES (41, 'Scarves', 4);");
$sql=mysql_query("insert INTO categories VALUES (42, 'Umbrellas', 4);");
$sql=mysql_query("insert INTO categories VALUES (43, 'Children''s Shoes', 5);");
$sql=mysql_query("insert INTO categories VALUES (44, 'Men''s Shoes', 5);");
$sql=mysql_query("insert INTO categories VALUES (45, 'Slippers & Socks', 5);");
$sql=mysql_query("insert INTO categories VALUES (46, 'Shop By Brand', 5);");
$sql=mysql_query("insert INTO categories VALUES (47, 'Women''s Shoes', 5);");
$sql=mysql_query("insert INTO categories VALUES (48, 'Bedding', 6);");
$sql=mysql_query("insert INTO categories VALUES (49, 'Bath', 6);");
$sql=mysql_query("insert INTO categories VALUES (50, 'Down Bedding', 6);");
$sql=mysql_query("insert INTO categories VALUES (51, 'Personal Care', 6);");
$sql=mysql_query("insert INTO categories VALUES (52, 'Luxury Bedding', 6);");
$sql=mysql_query("insert INTO categories VALUES (53, 'Business & Economics', 7);");
$sql=mysql_query("insert INTO categories VALUES (54, 'Computers', 7);");
$sql=mysql_query("insert INTO categories VALUES (55, 'Education', 7);");
$sql=mysql_query("insert INTO categories VALUES (56, 'General Business', 7);");
$sql=mysql_query("insert INTO categories VALUES (57, 'General Professional', 7);");
$sql=mysql_query("insert INTO categories VALUES (58, 'General Technical', 7);");
$sql=mysql_query("insert INTO categories VALUES (59, 'Law', 7);");
$sql=mysql_query("insert INTO categories VALUES (60, 'Mathematics', 7);");
$sql=mysql_query("insert INTO categories VALUES (61, 'Medical', 7);");
$sql=mysql_query("insert INTO categories VALUES (62, 'Psychology', 7);");
$sql=mysql_query("insert INTO categories VALUES (63, 'Science', 7);");
$sql=mysql_query("insert INTO categories VALUES (64, 'Social Science', 7);");
$sql=mysql_query("insert INTO categories VALUES (65, 'Technology', 7);");
$sql=mysql_query("insert INTO categories VALUES (66, 'Action & Thrillers', 8);");
$sql=mysql_query("insert INTO categories VALUES (67, 'Fiction and Literature', 8);");
$sql=mysql_query("insert INTO categories VALUES (68, 'General', 8);");
$sql=mysql_query("insert INTO categories VALUES (69, 'Graphic Novels', 8);");
$sql=mysql_query("insert INTO categories VALUES (70, 'Mystery & Crime', 8);");
$sql=mysql_query("insert INTO categories VALUES (71, 'Romance', 8);");
$sql=mysql_query("insert INTO categories VALUES (72, 'Science Fiction & Fantasy', 8);");
$sql=mysql_query("insert INTO categories VALUES (73, 'Westerns', 8);");
$sql=mysql_query("insert INTO categories VALUES (74, 'Juvenile Fiction', 9);");
$sql=mysql_query("insert INTO categories VALUES (75, 'Juvenile Non-fiction', 9);");
$sql=mysql_query("insert INTO categories VALUES (76, 'General', 10);");
$sql=mysql_query("insert INTO categories VALUES (77, 'Antiques & Collectibles', 11);");
$sql=mysql_query("insert INTO categories VALUES (78, 'Architecture', 11);");
$sql=mysql_query("insert INTO categories VALUES (79, 'Art', 11);");
$sql=mysql_query("insert INTO categories VALUES (80, 'Biography & Autobiography', 11);");
$sql=mysql_query("insert INTO categories VALUES (81, 'Body, Mind & Spirit', 11);");
$sql=mysql_query("insert INTO categories VALUES (82, 'Cooking', 11);");
$sql=mysql_query("insert INTO categories VALUES (83, 'Crafts & Hobbies', 11);");
$sql=mysql_query("insert INTO categories VALUES (84, 'Current Events', 11);");
$sql=mysql_query("insert INTO categories VALUES (85, 'Drama', 11);");
$sql=mysql_query("insert INTO categories VALUES (86, 'Family & Relationships', 11);");
$sql=mysql_query("insert INTO categories VALUES (87, 'Foreign Language Study', 11);");
$sql=mysql_query("insert INTO categories VALUES (88, 'Games', 11);");
$sql=mysql_query("insert INTO categories VALUES (89, 'Gardening', 11);");
$sql=mysql_query("insert INTO categories VALUES (90, 'General Non-Fiction', 11);");
$sql=mysql_query("insert INTO categories VALUES (91, 'Health & Fitness', 11);");
$sql=mysql_query("insert INTO categories VALUES (92, 'History', 11);");
$sql=mysql_query("insert INTO categories VALUES (93, 'House & Home', 11);");
$sql=mysql_query("insert INTO categories VALUES (94, 'Humor', 11);");
$sql=mysql_query("insert INTO categories VALUES (95, 'Language Arts', 11);");
$sql=mysql_query("insert INTO categories VALUES (96, 'Literary Criticism', 11);");
$sql=mysql_query("insert INTO categories VALUES (97, 'Music', 11);");
$sql=mysql_query("insert INTO categories VALUES (98, 'Nature', 11);");
$sql=mysql_query("insert INTO categories VALUES (99, 'Performing Arts', 11);");
$sql=mysql_query("insert INTO categories VALUES (100, 'Pets', 11);");
$sql=mysql_query("insert INTO categories VALUES (101, 'Philosophy', 11);");
$sql=mysql_query("insert INTO categories VALUES (102, 'Photography', 11);");
$sql=mysql_query("insert INTO categories VALUES (103, 'Poetry', 11);");
$sql=mysql_query("insert INTO categories VALUES (104, 'Political Science', 11);");
$sql=mysql_query("insert INTO categories VALUES (105, 'Reference', 11);");
$sql=mysql_query("insert INTO categories VALUES (106, 'Religion', 11);");
$sql=mysql_query("insert INTO categories VALUES (107, 'Self-help', 11);");
$sql=mysql_query("insert INTO categories VALUES (108, 'Sports & Recreation', 11);");
$sql=mysql_query("insert INTO categories VALUES (109, 'Study Aids', 11);");
$sql=mysql_query("insert INTO categories VALUES (110, 'Transportation', 11);");
$sql=mysql_query("insert INTO categories VALUES (111, 'Travel', 11);");
$sql=mysql_query("insert INTO categories VALUES (112, 'True Crime', 11);");
$sql=mysql_query("insert INTO categories VALUES (113, 'Business & Economics', 12);");
$sql=mysql_query("insert INTO categories VALUES (114, 'Computers', 12);");
$sql=mysql_query("insert INTO categories VALUES (115, 'Education', 12);");
$sql=mysql_query("insert INTO categories VALUES (116, 'General Business', 12);");
$sql=mysql_query("insert INTO categories VALUES (117, 'General Professional', 12);");
$sql=mysql_query("insert INTO categories VALUES (118, 'General Technical', 12);");
$sql=mysql_query("insert INTO categories VALUES (119, 'Law', 12);");
$sql=mysql_query("insert INTO categories VALUES (120, 'Mathematics', 12);");
$sql=mysql_query("insert INTO categories VALUES (121, 'Medical', 12);");
$sql=mysql_query("insert INTO categories VALUES (122, 'Psychology', 12);");
$sql=mysql_query("insert INTO categories VALUES (123, 'Science', 12);");
$sql=mysql_query("insert INTO categories VALUES (124, 'Social Science', 12);");
$sql=mysql_query("insert INTO categories VALUES (125, 'Technology', 12);");
$sql=mysql_query("insert INTO categories VALUES (126, 'Action & Adventure', 13);");
$sql=mysql_query("insert INTO categories VALUES (127, 'Anime', 13);");
$sql=mysql_query("insert INTO categories VALUES (128, 'Boxed Sets', 13);");
$sql=mysql_query("insert INTO categories VALUES (129, 'Children''s', 13);");
$sql=mysql_query("insert INTO categories VALUES (130, 'Comedy', 13);");
$sql=mysql_query("insert INTO categories VALUES (131, 'Coming Soon', 13);");
$sql=mysql_query("insert INTO categories VALUES (132, 'Documentary', 13);");
$sql=mysql_query("insert INTO categories VALUES (133, 'Drama', 13);");
$sql=mysql_query("insert INTO categories VALUES (134, 'Exercise', 13);");
$sql=mysql_query("insert INTO categories VALUES (135, 'Foreign Films', 13);");
$sql=mysql_query("insert INTO categories VALUES (136, 'General', 13);");
$sql=mysql_query("insert INTO categories VALUES (137, 'Holiday', 13);");
$sql=mysql_query("insert INTO categories VALUES (138, 'Horror & Suspense', 13);");
$sql=mysql_query("insert INTO categories VALUES (139, 'Musical & Performing Arts', 13);");
$sql=mysql_query("insert INTO categories VALUES (140, 'New Releases', 13);");
$sql=mysql_query("insert INTO categories VALUES (141, 'Religious', 13);");
$sql=mysql_query("insert INTO categories VALUES (142, 'Science Fiction & Fantasy', 13);");
$sql=mysql_query("insert INTO categories VALUES (143, 'Sports & Recreation', 13);");
$sql=mysql_query("insert INTO categories VALUES (144, 'Television', 13);");
$sql=mysql_query("insert INTO categories VALUES (145, 'Westerns', 13);");
$sql=mysql_query("insert INTO categories VALUES (146, 'Computers', 14);");
$sql=mysql_query("insert INTO categories VALUES (147, 'Peripherals', 14);");
$sql=mysql_query("insert INTO categories VALUES (148, 'Drives & Storage', 14);");
$sql=mysql_query("insert INTO categories VALUES (149, 'Connectivity', 14);");
$sql=mysql_query("insert INTO categories VALUES (150, 'Monitors', 14);");
$sql=mysql_query("insert INTO categories VALUES (151, 'Printers & Scanners', 14);");
$sql=mysql_query("insert INTO categories VALUES (152, 'Upgrades', 14);");
$sql=mysql_query("insert INTO categories VALUES (153, 'PDA''s & Handhelds', 14);");
$sql=mysql_query("insert INTO categories VALUES (154, 'Ink Cartridges', 14);");
$sql=mysql_query("insert INTO categories VALUES (155, 'Cordless Phones', 15);");
$sql=mysql_query("insert INTO categories VALUES (156, 'Corded Phones', 15);");
$sql=mysql_query("insert INTO categories VALUES (157, 'Cell Phones', 15);");
$sql=mysql_query("insert INTO categories VALUES (158, 'Home Audio', 16);");
$sql=mysql_query("insert INTO categories VALUES (159, 'Home Video', 16);");
$sql=mysql_query("insert INTO categories VALUES (160, 'Car Audio & Video', 16);");
$sql=mysql_query("insert INTO categories VALUES (161, 'Portable Audio & Video', 16);");
$sql=mysql_query("insert INTO categories VALUES (162, 'Binoculars & Optics', 17);");
$sql=mysql_query("insert INTO categories VALUES (163, 'Film Cameras', 17);");
$sql=mysql_query("insert INTO categories VALUES (164, 'Digital Cameras', 17);");
$sql=mysql_query("insert INTO categories VALUES (165, 'Accessories', 17);");
$sql=mysql_query("insert INTO categories VALUES (166, 'Camcorders', 17);");
$sql=mysql_query("insert INTO categories VALUES (167, 'Office & Fax', 18);");
$sql=mysql_query("insert INTO categories VALUES (168, 'Dolls & Dollhouses', 19);");
$sql=mysql_query("insert INTO categories VALUES (169, 'Arts & Crafts', 19);");
$sql=mysql_query("insert INTO categories VALUES (170, 'Electronic Toys', 19);");
$sql=mysql_query("insert INTO categories VALUES (171, 'Outdoor Toys', 19);");
$sql=mysql_query("insert INTO categories VALUES (172, 'Stuffed Toys', 19);");
$sql=mysql_query("insert INTO categories VALUES (173, 'Skating & Scooters', 20);");
$sql=mysql_query("insert INTO categories VALUES (174, 'Paintball', 20);");
$sql=mysql_query("insert INTO categories VALUES (175, 'Chocolate & Wine', 21);");
$sql=mysql_query("insert INTO categories VALUES (176, 'Gift Baskets', 21);");
$sql=mysql_query("insert INTO categories VALUES (177, 'Flowers & Plants', 21);");
$sql=mysql_query("insert INTO categories VALUES (178, 'Special Gifts', 21);");
$sql=mysql_query("insert INTO categories VALUES (179, 'Perfume', 21);");
$sql=mysql_query("insert INTO categories VALUES (180, 'Bestselling Gifts', 21);");
$sql=mysql_query("insert INTO categories VALUES (181, 'Pet Supplies', 22);");
$sql=mysql_query("insert INTO categories VALUES (182, 'Appliances', 23);");
$sql=mysql_query("insert INTO categories VALUES (183, 'Cookware & Cutlery', 23);");
$sql=mysql_query("insert INTO categories VALUES (184, 'Tabletop', 23);");
$sql=mysql_query("insert INTO categories VALUES (185, 'Storage', 23);");
$sql=mysql_query("insert INTO categories VALUES (186, 'Kitchen Linens & Decor', 23);");
$sql=mysql_query("insert INTO categories VALUES (187, 'Area Rugs', 24);");
$sql=mysql_query("insert INTO categories VALUES (188, 'Decorative Accessories', 24);");
$sql=mysql_query("insert INTO categories VALUES (189, 'Lighting & Ceiling Fans', 24);");
$sql=mysql_query("insert INTO categories VALUES (190, 'Art', 24);");
$sql=mysql_query("insert INTO categories VALUES (191, 'Collectibles', 24);");
$sql=mysql_query("insert INTO categories VALUES (192, 'Patio Furniture', 25);");
$sql=mysql_query("insert INTO categories VALUES (193, 'Garden Decor', 25);");
$sql=mysql_query("insert INTO categories VALUES (194, 'Garden Lighting', 25);");
$sql=mysql_query("insert INTO categories VALUES (195, 'Flags & Poles', 25);");
$sql=mysql_query("insert INTO categories VALUES (196, 'Bedroom', 26);");
$sql=mysql_query("insert INTO categories VALUES (197, 'Dining & Bar', 26);");
$sql=mysql_query("insert INTO categories VALUES (198, 'Home Office', 26);");
$sql=mysql_query("insert INTO categories VALUES (199, 'Living Room', 26);");
$sql=mysql_query("insert INTO categories VALUES (200, 'Faucets', 27);");
$sql=mysql_query("insert INTO categories VALUES (201, 'Sinks', 27);");
$sql=mysql_query("insert INTO categories VALUES (202, 'Toilets', 27);");
$sql=mysql_query("insert INTO categories VALUES (203, 'Showers', 27);");
$sql=mysql_query("insert INTO categories VALUES (204, 'Sauna & Steam', 27);");
$sql=mysql_query("insert INTO categories VALUES (205, 'Flooring', 27);");
$sql=mysql_query("insert INTO categories VALUES (206, 'Doors & Windows', 27);");
$sql=mysql_query("insert INTO categories VALUES (207, 'Storage', 27);");
$sql=mysql_query("insert INTO categories VALUES (208, 'Ladders', 27);");
$sql=mysql_query("insert INTO categories VALUES (209, 'Bath Hardware', 27);");
$sql=mysql_query("insert INTO categories VALUES (210, 'Heating & Cooling', 28);");
$sql=mysql_query("insert INTO categories VALUES (211, 'Cleaning', 28);");
$sql=mysql_query("insert INTO categories VALUES (212, 'Safety Gear', 29);");
$sql=mysql_query("insert INTO categories VALUES (213, 'Hand Tools', 29);");
$sql=mysql_query("insert INTO categories VALUES (214, 'Corded Power Tools', 29);");
$sql=mysql_query("insert INTO categories VALUES (215, 'Yard Care', 29);");
$sql=mysql_query("insert INTO categories VALUES (216, 'Air Tools', 29);");
$sql=mysql_query("insert INTO categories VALUES (217, 'Cordless Power Tools', 29);");
$sql=mysql_query("insert INTO categories VALUES (218, 'Auto Care', 29);");
$sql=mysql_query("insert INTO categories VALUES (219, 'Men''s Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (220, 'Artisan Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (221, 'Diamond Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (222, 'Wedding Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (223, 'Sterling Silver Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (224, 'Pearl Strands', 30);");
$sql=mysql_query("insert INTO categories VALUES (225, 'Pearl Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (226, 'Emerald Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (227, 'Ruby Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (228, 'Body Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (229, 'Estate Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (230, 'One of a Kind Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (231, 'Cubic Zirconia Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (232, 'Tanzanite Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (233, 'Blue Topaz Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (234, 'Amethyst Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (235, 'Sapphire Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (236, 'Specialty Gemstones', 30);");
$sql=mysql_query("insert INTO categories VALUES (237, 'Heart Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (238, 'Fashion Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (239, 'Gold Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (240, 'Platinum Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (241, 'Titanium & Steel Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (242, 'Children''s Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (243, 'Designer Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (244, 'Garnet Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (245, 'Onyx Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (246, 'Plus Size Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (247, 'Religious Jewelry', 30);");
$sql=mysql_query("insert INTO categories VALUES (248, 'Boxes & Winders', 31);");
$sql=mysql_query("insert INTO categories VALUES (249, 'Watchbands', 31);");
$sql=mysql_query("insert INTO categories VALUES (250, 'Men''s Watches', 32);");
$sql=mysql_query("insert INTO categories VALUES (251, 'Women''s Watches', 32);");
$sql=mysql_query("insert INTO categories VALUES (252, 'Business Cases', 33);");
$sql=mysql_query("insert INTO categories VALUES (253, 'Carry Ons', 33);");
$sql=mysql_query("insert INTO categories VALUES (254, 'Duffels', 33);");
$sql=mysql_query("insert INTO categories VALUES (255, 'Luggage Sets', 33);");
$sql=mysql_query("insert INTO categories VALUES (256, 'Backpacks', 33);");
$sql=mysql_query("insert INTO categories VALUES (257, 'Travel Accessories', 33);");
$sql=mysql_query("insert INTO categories VALUES (258, 'Dolls & Dollhouses', 34);");
$sql=mysql_query("insert INTO categories VALUES (259, 'Arts & Crafts', 34);");
$sql=mysql_query("insert INTO categories VALUES (260, 'Electronic Toys', 34);");
$sql=mysql_query("insert INTO categories VALUES (261, 'Outdoor Toys', 34);");
$sql=mysql_query("insert INTO categories VALUES (262, 'Stuffed Toys', 34);");
$sql=mysql_query("insert INTO categories VALUES (263, 'Game Tables', 35);");
$sql=mysql_query("insert INTO categories VALUES (264, 'Board Games', 35);");
$sql=mysql_query("insert INTO categories VALUES (265, 'Billiards', 35);");
$sql=mysql_query("insert INTO categories VALUES (266, 'Casino Games', 35);");
$sql=mysql_query("insert INTO categories VALUES (267, 'Poker', 35);");
$sql=mysql_query("insert INTO categories VALUES (268, 'Backpacks', 36);");
$sql=mysql_query("insert INTO categories VALUES (269, 'Hunting & Fishing', 36);");
$sql=mysql_query("insert INTO categories VALUES (270, 'Snow Sports', 36);");
$sql=mysql_query("insert INTO categories VALUES (271, 'Cycling', 36);");
$sql=mysql_query("insert INTO categories VALUES (272, 'Water Sports', 36);");
$sql=mysql_query("insert INTO categories VALUES (273, 'Camping & Hiking', 36);");
$sql=mysql_query("insert INTO categories VALUES (274, 'Fitness/Exercise', 36);");
$sql=mysql_query("insert INTO categories VALUES (275, 'Golf Equipment', 36);");
$sql=mysql_query("insert INTO categories VALUES (276, 'Skating & Scooters', 36);");
$sql=mysql_query("insert INTO categories VALUES (277, 'Racquet Sports', 36);");
$sql=mysql_query("insert INTO categories VALUES (278, 'Optics', 36);");
$sql=mysql_query("insert INTO categories VALUES (279, 'Paintball', 36);");
$sql=mysql_query("insert INTO categories VALUES (280, 'Team Sports', 36);");
$sql=mysql_query("insert INTO categories VALUES (281, 'Home Gym Equipment', 36);");
$sql=mysql_query("insert INTO categories VALUES (282, 'Knives', 36);");
$sql=mysql_query("insert INTO categories VALUES (283, 'Professional Sports', 37);");
$sql=mysql_query("insert INTO categories VALUES (284, 'Collectibles', 38);");
$sql=mysql_query("insert INTO categories VALUES (285, 'Trading Cards', 38);");
$sql=mysql_query("insert INTO categories VALUES (286, 'Sports Memorabilia', 38);");
$sql=mysql_query("insert INTO categories VALUES (287, 'Coins & Stamps', 38);");
$sql=mysql_query("insert INTO categories VALUES (288, 'Musical Instruments', 38);");
$sql=mysql_query("insert INTO categories VALUES (289, 'Apparel', 39);");
$sql=mysql_query("insert INTO categories VALUES (290, 'Bags & Accessories', 39);");
$sql=mysql_query("insert INTO categories VALUES (291, 'Bath', 39);");
$sql=mysql_query("insert INTO categories VALUES (292, 'Bedding', 40);");
$sql=mysql_query("insert INTO categories VALUES (293, 'Kitchen & Dining', 40);");
$sql=mysql_query("insert INTO categories VALUES (294, 'Cabinets & Tables', 41);");
$sql=mysql_query("insert INTO categories VALUES (295, 'Chairs & Stools', 41);");
$sql=mysql_query("insert INTO categories VALUES (296, 'Large', 42);");
$sql=mysql_query("insert INTO categories VALUES (297, 'Small', 42);");
$sql=mysql_query("insert INTO categories VALUES (298, 'Runners', 42);");
$sql=mysql_query("insert INTO categories VALUES (299, 'Accent Pieces', 43);");
$sql=mysql_query("insert INTO categories VALUES (300, 'Garden Decor', 43);");
$sql=mysql_query("insert INTO categories VALUES (301, 'Candles & Lamps', 43);");
$sql=mysql_query("insert INTO categories VALUES (302, 'Wall Decor & Screens', 43);");
$sql=mysql_query("insert INTO categories VALUES (303, 'World Jewelry', 44);");
$sql=mysql_query("insert INTO categories VALUES (304, 'Native American', 44);");
$sql=mysql_query("insert INTO categories VALUES (305, 'Jewelry Boxes', 44);");
$sql=mysql_query("insert INTO categories VALUES (306, 'Games & Toys', 45);");
$sql=mysql_query("insert INTO categories VALUES (307, 'Statues & Figurines', 45);");
$sql=mysql_query("insert INTO categories VALUES (308, 'Musical Instruments', 45);");
$sql=mysql_query("insert INTO categories VALUES (309, 'Desktop & Stationery', 45);");
$sql=mysql_query("insert INTO categories VALUES (310, 'Alt Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (311, 'Alternative Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (312, 'Art Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (313, 'Bakersfield', 46);");
$sql=mysql_query("insert INTO categories VALUES (314, 'BBop', 46);");
$sql=mysql_query("insert INTO categories VALUES (315, 'Big Band', 46);");
$sql=mysql_query("insert INTO categories VALUES (316, 'Bluegrass', 46);");
$sql=mysql_query("insert INTO categories VALUES (317, 'Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (318, 'British', 46);");
$sql=mysql_query("insert INTO categories VALUES (319, 'British Folk Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (320, 'British Invasion', 46);");
$sql=mysql_query("insert INTO categories VALUES (321, 'Cajun', 46);");
$sql=mysql_query("insert INTO categories VALUES (322, 'CCCM/Gospel', 46);");
$sql=mysql_query("insert INTO categories VALUES (323, 'Chicago Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (324, 'Children''s', 46);");
$sql=mysql_query("insert INTO categories VALUES (325, 'Christian', 46);");
$sql=mysql_query("insert INTO categories VALUES (326, 'Classic Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (327, 'Classical', 46);");
$sql=mysql_query("insert INTO categories VALUES (328, 'Clearance', 46);");
$sql=mysql_query("insert INTO categories VALUES (329, 'Comedy', 46);");
$sql=mysql_query("insert INTO categories VALUES (330, 'Coming Soon', 46);");
$sql=mysql_query("insert INTO categories VALUES (331, 'Contemporary Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (332, 'Contemporary Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (333, 'Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (334, 'Country Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (335, 'Country Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (336, 'Cowboy', 46);");
$sql=mysql_query("insert INTO categories VALUES (337, 'Delta', 46);");
$sql=mysql_query("insert INTO categories VALUES (338, 'Doowop', 46);");
$sql=mysql_query("insert INTO categories VALUES (339, 'Drum & Bass/Jungle', 46);");
$sql=mysql_query("insert INTO categories VALUES (340, 'Early Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (341, 'Easy Listening', 46);");
$sql=mysql_query("insert INTO categories VALUES (342, 'Electronic', 46);");
$sql=mysql_query("insert INTO categories VALUES (343, 'Environmental', 46);");
$sql=mysql_query("insert INTO categories VALUES (344, 'Exercise', 46);");
$sql=mysql_query("insert INTO categories VALUES (345, 'Folk', 46);");
$sql=mysql_query("insert INTO categories VALUES (346, 'Funk', 46);");
$sql=mysql_query("insert INTO categories VALUES (347, 'General', 46);");
$sql=mysql_query("insert INTO categories VALUES (348, 'General Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (349, 'General Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (350, 'General Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (351, 'Girl Groups', 46);");
$sql=mysql_query("insert INTO categories VALUES (352, 'Glam Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (353, 'Gospel', 46);");
$sql=mysql_query("insert INTO categories VALUES (354, 'Guitar Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (355, 'Hard Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (356, 'Hardcore/Punk', 46);");
$sql=mysql_query("insert INTO categories VALUES (357, 'Heavy Metal', 46);");
$sql=mysql_query("insert INTO categories VALUES (358, 'Hip Hop/Rap', 46);");
$sql=mysql_query("insert INTO categories VALUES (359, 'Holiday', 46);");
$sql=mysql_query("insert INTO categories VALUES (360, 'Honkytonk', 46);");
$sql=mysql_query("insert INTO categories VALUES (361, 'House', 46);");
$sql=mysql_query("insert INTO categories VALUES (362, 'Instrumental', 46);");
$sql=mysql_query("insert INTO categories VALUES (363, 'International', 46);");
$sql=mysql_query("insert INTO categories VALUES (364, 'Interview', 46);");
$sql=mysql_query("insert INTO categories VALUES (365, 'Jazz', 46);");
$sql=mysql_query("insert INTO categories VALUES (366, 'Jump Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (367, 'Karaoke', 46);");
$sql=mysql_query("insert INTO categories VALUES (368, 'Line Dance', 46);");
$sql=mysql_query("insert INTO categories VALUES (369, 'Lo Fi', 46);");
$sql=mysql_query("insert INTO categories VALUES (370, 'Mod', 46);");
$sql=mysql_query("insert INTO categories VALUES (371, 'Modern Urban Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (372, 'Music Comedy', 46);");
$sql=mysql_query("insert INTO categories VALUES (373, 'Nashville Sound', 46);");
$sql=mysql_query("insert INTO categories VALUES (374, 'New Age', 46);");
$sql=mysql_query("insert INTO categories VALUES (375, 'New Age', 46);");
$sql=mysql_query("insert INTO categories VALUES (376, 'New Releases', 46);");
$sql=mysql_query("insert INTO categories VALUES (377, 'Oldies', 46);");
$sql=mysql_query("insert INTO categories VALUES (378, 'Original Cast', 46);");
$sql=mysql_query("insert INTO categories VALUES (379, 'Outlaw Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (380, 'Piano Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (381, 'Pop', 46);");
$sql=mysql_query("insert INTO categories VALUES (382, 'Pop', 46);");
$sql=mysql_query("insert INTO categories VALUES (383, 'Progressive Country', 46);");
$sql=mysql_query("insert INTO categories VALUES (384, 'Progressive Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (385, 'Psychedelic', 46);");
$sql=mysql_query("insert INTO categories VALUES (386, 'Punk Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (387, 'R&B', 46);");
$sql=mysql_query("insert INTO categories VALUES (388, 'Reggae', 46);");
$sql=mysql_query("insert INTO categories VALUES (389, 'Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (390, 'Rock & Roll', 46);");
$sql=mysql_query("insert INTO categories VALUES (391, 'Rockabilly', 46);");
$sql=mysql_query("insert INTO categories VALUES (392, 'Singer/Songwriter', 46);");
$sql=mysql_query("insert INTO categories VALUES (393, 'Soul', 46);");
$sql=mysql_query("insert INTO categories VALUES (394, 'Soundtracks', 46);");
$sql=mysql_query("insert INTO categories VALUES (395, 'Southern Rock', 46);");
$sql=mysql_query("insert INTO categories VALUES (396, 'Spoken Comedy', 46);");
$sql=mysql_query("insert INTO categories VALUES (397, 'Spoken Word', 46);");
$sql=mysql_query("insert INTO categories VALUES (398, 'Surf', 46);");
$sql=mysql_query("insert INTO categories VALUES (399, 'Swamp', 46);");
$sql=mysql_query("insert INTO categories VALUES (400, 'Swing', 46);");
$sql=mysql_query("insert INTO categories VALUES (401, 'Techno', 46);");
$sql=mysql_query("insert INTO categories VALUES (402, 'Texas/W. Coast Blues', 46);");
$sql=mysql_query("insert INTO categories VALUES (403, 'Trance', 46);");
$sql=mysql_query("insert INTO categories VALUES (404, 'Trip Hop/Big Beat', 46);");
$sql=mysql_query("insert INTO categories VALUES (405, 'Western Swing', 46);");
$sql=mysql_query("insert INTO categories VALUES (406, 'Zydeco', 46);");
$sql=mysql_query("insert INTO categories VALUES (407, 'Action & Adventure', 47);");
$sql=mysql_query("insert INTO categories VALUES (408, 'Anime', 47);");
$sql=mysql_query("insert INTO categories VALUES (409, 'Boxed Sets', 47);");
$sql=mysql_query("insert INTO categories VALUES (410, 'Children''s', 47);");
$sql=mysql_query("insert INTO categories VALUES (411, 'Comedy', 47);");
$sql=mysql_query("insert INTO categories VALUES (412, 'Drama', 47);");
$sql=mysql_query("insert INTO categories VALUES (413, 'Exercise', 47);");
$sql=mysql_query("insert INTO categories VALUES (414, 'Foreign Films', 47);");
$sql=mysql_query("insert INTO categories VALUES (415, 'General', 47);");
$sql=mysql_query("insert INTO categories VALUES (416, 'Holiday', 47);");
$sql=mysql_query("insert INTO categories VALUES (417, 'Horror & Suspense', 47);");
$sql=mysql_query("insert INTO categories VALUES (418, 'Musical & Performing Arts', 47);");
$sql=mysql_query("insert INTO categories VALUES (419, 'Religious', 47);");
$sql=mysql_query("insert INTO categories VALUES (420, 'Science Fiction & Fantasy', 47);");
$sql=mysql_query("insert INTO categories VALUES (421, 'Sports & Recreation', 47);");
$sql=mysql_query("insert INTO categories VALUES (422, 'Television', 47);");
$sql=mysql_query("insert INTO categories VALUES (423, 'Westerns', 47);");
$sql=mysql_query("insert INTO categories VALUES (424, 'Arts & Imaging', 48);");
$sql=mysql_query("insert INTO categories VALUES (425, 'Children''s', 48);");
$sql=mysql_query("insert INTO categories VALUES (426, 'Educational', 48);");
$sql=mysql_query("insert INTO categories VALUES (427, 'Game Boy Advance', 48);");
$sql=mysql_query("insert INTO categories VALUES (428, 'Games', 48);");
$sql=mysql_query("insert INTO categories VALUES (429, 'General', 48);");
$sql=mysql_query("insert INTO categories VALUES (430, 'Instructional', 48);");
$sql=mysql_query("insert INTO categories VALUES (431, 'Languages', 48);");
$sql=mysql_query("insert INTO categories VALUES (432, 'Nintendo GameCube', 48);");
$sql=mysql_query("insert INTO categories VALUES (433, 'Personal Finance', 48);");
$sql=mysql_query("insert INTO categories VALUES (434, 'PlayStation', 48);");
$sql=mysql_query("insert INTO categories VALUES (435, 'PlayStation 2', 48);");
$sql=mysql_query("insert INTO categories VALUES (436, 'Productivity', 48);");
$sql=mysql_query("insert INTO categories VALUES (437, 'Reference', 48);");
$sql=mysql_query("insert INTO categories VALUES (438, 'Utilities', 48);");
$sql=mysql_query("insert INTO categories VALUES (439, 'Xbox', 48);");


      



$sql= "CREATE TABLE departments (".
  "id int(11) NOT NULL auto_increment,".
  "department varchar(50) NOT NULL default '',".
  "used int(3) NOT NULL default '0',".
  "kind int(3) NOT NULL default '0',".
  "lasttime int(11) default NULL,".
  "csv varchar(50) NOT NULL default '',".
  "PRIMARY KEY  (id)".
") TYPE=MyISAM AUTO_INCREMENT=50 ;";

if (mysql_query($sql)) {
        echo("<P>The table departments have been created</P>");
      } else {
        echo("<P>Error creating the table departments

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }


$sql=mysql_query("insert INTO departments VALUES (1, 'Women''s Apparel', 0, 11, 0, 'apparel_accessories');");
$sql=mysql_query("insert INTO departments VALUES (2, 'Men''s Apparel', 0, 11, 0, 'apparel_accessories');");
$sql=mysql_query("insert INTO departments VALUES (3, 'Children''s Apparel', 0, 11, 0, 'apparel_accessories');");
$sql=mysql_query("insert INTO departments VALUES (4, 'Handbags & Accessories', 0, 11, 0, 'apparel_accessories');");
$sql=mysql_query("insert INTO departments VALUES (5, 'Footwear', 0, 11, 0, 'apparel_accessories');");
$sql=mysql_query("insert INTO departments VALUES (6, 'Bedding & Bath', 0, 11, 0, 'bed_bath_linens');");
$sql=mysql_query("insert INTO departments VALUES (7, 'Books Business Technology', 0, 1, 0, 'books_business_tech');");
$sql=mysql_query("insert INTO departments VALUES (8, 'Books Fiction', 0, 2, 0, 'books_fiction');");
$sql=mysql_query("insert INTO departments VALUES (9, 'Books Juvenile', 0, 3, 0, 'books_juvenile');");
$sql=mysql_query("insert INTO departments VALUES (10, 'Books Miscellaneous', 0, 4, 0, 'books_miscellaneous');");
$sql=mysql_query("insert INTO departments VALUES (11, 'Books Non Fiction', 0, 5, 0, 'books_non_fiction');");
$sql=mysql_query("insert INTO departments VALUES (12, 'Books Textbooks', 0, 6, 0, 'books_textbooks');");
$sql=mysql_query("insert INTO departments VALUES (13, 'DVD', 0, 8, 0, 'DVD');");
$sql=mysql_query("insert INTO departments VALUES (14, 'Computers & Printers', 0, 11, 0, 'electronics_computer');");
$sql=mysql_query("insert INTO departments VALUES (15, 'Telephones', 0, 11, 0, 'electronics_computer');");
$sql=mysql_query("insert INTO departments VALUES (16, 'Audio & Video', 0, 11, 0, 'electronics_computer');");
$sql=mysql_query("insert INTO departments VALUES (17, 'Cameras & Optics', 0, 11, 0, 'electronics_computer');");
$sql=mysql_query("insert INTO departments VALUES (18, 'Home Office Equipment', 0, 11, 0, 'electronics_computer');");
$sql=mysql_query("insert INTO departments VALUES (19, 'Toys', 0, 11, 0, 'gifts_gadgets_toys');");
$sql=mysql_query("insert INTO departments VALUES (20, 'Sports Gear & Equipment', 0, 11, 0, 'gifts_gadgets_toys');");
$sql=mysql_query("insert INTO departments VALUES (21, 'Gifts', 0, 11, 0, 'gifts_gadgets_toys');");
$sql=mysql_query("insert INTO departments VALUES (22, 'For the Pet', 0, 11, 0, 'gifts_gadgets_toys');");
$sql=mysql_query("insert INTO departments VALUES (23, 'Kitchen & Dining', 0, 11, 0, 'home_garden_decor');");
$sql=mysql_query("insert INTO departments VALUES (24, 'Home Decor', 0, 11, 0, 'home_garden_decor');");
$sql=mysql_query("insert INTO departments VALUES (25, 'Garden & Patio', 0, 11, 0, 'home_garden_decor');");
$sql=mysql_query("insert INTO departments VALUES (26, 'Furniture', 0, 11, 0, 'home_garden_decor');");
$sql=mysql_query("insert INTO departments VALUES (27, 'Home Improvement', 0, 11, 0, 'home_garden_decor');");
$sql=mysql_query("insert INTO departments VALUES (28, 'Housewares', 0, 11, 0, 'housewares_appliances');");
$sql=mysql_query("insert INTO departments VALUES (29, 'Tools', 0, 11, 0, 'housewares_appliances');");
$sql=mysql_query("insert INTO departments VALUES (30, 'Jewelry', 0, 11, 0, 'jewelry_watches');");
$sql=mysql_query("insert INTO departments VALUES (31, 'Accessories', 0, 11, 0, 'jewelry_watches');");
$sql=mysql_query("insert INTO departments VALUES (32, 'Watches', 0, 11, 0, 'jewelry_watches');");
$sql=mysql_query("insert INTO departments VALUES (33, 'Luggage', 0, 11, 0, 'luggage_business');");
$sql=mysql_query("insert INTO departments VALUES (34, 'Toys', 0, 12, 0, 'sports_gear');");
$sql=mysql_query("insert INTO departments VALUES (35, 'Parlor Games', 0, 12, 0, 'sports_gear');");
$sql=mysql_query("insert INTO departments VALUES (36, 'Sports Gear & Equipment', 0, 12, 0, 'sports_gear');");
$sql=mysql_query("insert INTO departments VALUES (37, 'Event Tickets', 0, 12, 0, 'sports_gear');");
$sql=mysql_query("insert INTO departments VALUES (38, 'Hobbies & Collectibles', 0, 12, 0, 'sports_gear');");
$sql=mysql_query("insert INTO departments VALUES (39, 'Apparel & Accessories', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (40, 'Bed, Bath & Kitchen', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (41, 'Furniture', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (42, 'Area Rugs', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (43, 'Home Decor', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (44, 'World Jewelry', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (45, 'Global Collectibles', 0, 13, 0, 'worldstock');");
$sql=mysql_query("insert INTO departments VALUES (46, 'Music', 0, 7, 0, 'music');");
$sql=mysql_query("insert INTO departments VALUES (47, 'VHS', 0, 9, 0, 'VHS');");
$sql=mysql_query("insert INTO departments VALUES (48, 'Videogames', 0, 10, 0, 'videogames');");


      
$sql="CREATE TABLE DVD (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "upc varchar(200) NOT NULL default '',".
  "format varchar(5) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "actor varchar(200) NOT NULL default '',".
  "director varchar(50) NOT NULL default '',".
  "language varchar(50) NOT NULL default '',".
  "rating varchar(10) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table dvd have been created</P>");
      } else {
        echo("<P>Error creating the table dvd

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE general (".
  "sku int(11) NOT NULL default '0',".
  "productname varchar(200) NOT NULL default '',".
  "productshortname varchar(50) NOT NULL default '',".
  "brandname varchar(50) NOT NULL default '',".
  "manufacturer varchar(50) NOT NULL default '',".
  "manufacturerpartno varchar(50) NOT NULL default '',".
  "modelno varchar(50) NOT NULL default '',".
  "productdimensions varchar(50) NOT NULL default '',".
  "productmaterials varchar(30) NOT NULL default '',".
  "productorigin varchar(20) NOT NULL default '',".
  "storelistname varchar(50) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "subcategory varchar(50) NOT NULL default '',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "longdescription text NOT NULL,".
  "shortdescription text NOT NULL,".
  "productquality varchar(20) NOT NULL default '',".
  "productwarranty varchar(20) NOT NULL default '',".
  "qtyonhand int(7) NOT NULL default '0',".
  "upc varchar(50) NOT NULL default '',".
  "thumbnailimage varchar(200) NOT NULL default '',".
  "largeimage varchar(200) NOT NULL default '',".
  "storename varchar(50) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table general have been created</P>");
      } else {
        echo("<P>Error creating the table general

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE music (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(100) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "upc varchar(50) NOT NULL default '',".
  "format varchar(20) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(100) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "artist varchar(50) NOT NULL default '',".
  "recordlabel varchar(40) NOT NULL default '',".
  "releasestudio varchar(40) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table music have been created</P>");
      } else {
        echo("<P>Error creating the table music

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE sports_gear (".
  "sku int(11) NOT NULL default '0',".
 "productname varchar(200) NOT NULL default '',".
  "productshortname varchar(50) NOT NULL default '',".
  "brandname varchar(50) NOT NULL default '',".
  "manufacturer varchar(50) NOT NULL default '',".
  "manufacturerpartno varchar(50) NOT NULL default '',".
  "modelno varchar(50) NOT NULL default '',".
  "productdimensions varchar(50) NOT NULL default '',".
  "productmaterials varchar(30) NOT NULL default '',".
  "productorigin varchar(20) NOT NULL default '',".
  "storelistname varchar(50) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "subcategory varchar(50) NOT NULL default '',".
 "price decimal(10,2) NOT NULL default '0.00',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "longdescription text NOT NULL,".
  "shortdescription text NOT NULL,".
  "productquality varchar(20) NOT NULL default '',".
  "productwarranty varchar(20) NOT NULL default '',".
  "qtyonhand int(7) NOT NULL default '0',".
  "upc varchar(50) NOT NULL default '',".
  "thumbnailimage varchar(200) NOT NULL default '',".
  "largeimage varchar(200) NOT NULL default '',".
  "storename varchar(50) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table sports_gear have been created</P>");
      } else {
        echo("<P>Error creating the table sports_gear

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE VHS (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(200) NOT NULL default '',".
 " msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "upc varchar(200) NOT NULL default '',".
 " format varchar(5) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(200) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "actor varchar(200) NOT NULL default '',".
  "director varchar(50) NOT NULL default '',".
  "language varchar(50) NOT NULL default '',".
  "rating varchar(10) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table vhs have been created</P>");
      } else {
        echo("<P>Error creating the table vhs

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE videogames (".
  "sku int(11) NOT NULL default '0',".
  "title varchar(100) NOT NULL default '',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "upc varchar(50) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "imageurl varchar(100) NOT NULL default '',".
  "shortdescription text NOT NULL,".
  "longdescription text NOT NULL,".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";

if (mysql_query($sql)) {
        echo("<P>The table videogames have been created</P>");
      } else {
        echo("<P>Error creating the table videogames

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }

$sql="CREATE TABLE worldstock (".
  "sku int(11) NOT NULL default '0',".
  "productname varchar(200) NOT NULL default '',".
  "productshortname varchar(50) NOT NULL default '',".
  "brandname varchar(50) NOT NULL default '',".
  "manufacturer varchar(50) NOT NULL default '',".
  "manufacturerpartno varchar(50) NOT NULL default '',".
  "modelno varchar(50) NOT NULL default '',".
  "productdimensions varchar(50) NOT NULL default '',".
  "productmaterials varchar(30) NOT NULL default '',".
  "productorigin varchar(20) NOT NULL default '',".
  "storelistname varchar(50) NOT NULL default '',".
  "category varchar(50) NOT NULL default '',".
  "subcategory varchar(50) NOT NULL default '',".
  "price decimal(10,2) NOT NULL default '0.00',".
  "msrp decimal(10,2) NOT NULL default '0.00',".
  "longdescription text NOT NULL,".
  "shortdescription text NOT NULL,".
  "productquality varchar(20) NOT NULL default '',".
  "productwarranty varchar(20) NOT NULL default '',".
  "qtyonhand int(7) NOT NULL default '0',".
  "upc varchar(50) NOT NULL default '',".
  "thumbnailimage varchar(200) NOT NULL default '',".
  "largeimage varchar(200) NOT NULL default '',".
  "storename varchar(50) NOT NULL default '',".
  "rndnumber int(11) NOT NULL default '0',".
  "PRIMARY KEY  (sku)".
") TYPE=MyISAM;";
if (mysql_query($sql)) {
        echo("<P>The table worldstock have been created</P>");
      } else {
        echo("<P>Error creating the table worldstock

	: " .
             mysql_error() . "</P>");
              $er=1 ;
      }
      
      if  ($er<>1){
echo "<p> You can go now to your <a href='login.php'>Site Administration</a></p>";}

?>

</body>
 </html>
