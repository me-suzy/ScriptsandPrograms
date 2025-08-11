
-- Click Counter Deluxe

-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sites`
-- 

CREATE TABLE `sites` (
  `id` int(11) NOT NULL auto_increment,
  `clicks` int(11) NOT NULL default '0',
  `url` longtext collate latin1_general_ci NOT NULL,
  `users` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1;

-- 
-- Dumping data for table `sites`
-- 

