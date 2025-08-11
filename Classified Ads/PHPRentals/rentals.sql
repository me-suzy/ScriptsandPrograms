-- 
-- Table structure for table `landlords`
-- 

CREATE TABLE `landlords` (
  `lid` int(6) unsigned NOT NULL auto_increment,
  `fname` varchar(55) default '0',
  `lname` varchar(55) NOT NULL default '',
  `phone` varchar(25) default '0',
  PRIMARY KEY  (`lid`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `landlords`
-- 

INSERT INTO `landlords` VALUES (1, 'Herman', 'Muenster', '555-555-5555');

-- --------------------------------------------------------

-- 
-- Table structure for table `listings`
-- 

CREATE TABLE `listings` (
  `rid` int(15) NOT NULL auto_increment,
  `llid` int(6) NOT NULL default '0',
  `rtype` varchar(25) NOT NULL default '',
  `addone` varchar(75) NOT NULL default '',
  `addtwo` varchar(75) NOT NULL default '',
  `city` varchar(35) NOT NULL default '',
  `state` varchar(25) NOT NULL default '',
  `pets` char(3) NOT NULL default '',
  `descrip` text NOT NULL,
  `bed` int(2) NOT NULL default '0',
  `bath` char(2) NOT NULL default '',
  `garage` char(3) NOT NULL default '',
  `yard` char(3) NOT NULL default '',
  `utilities` varchar(5) NOT NULL default '',
  `rent` varchar(10) NOT NULL default '0.00',
  `deposit` varchar(10) NOT NULL default '0.00',
  `listdate` date NOT NULL default '0000-00-00',
  `img1` varchar(25) NOT NULL default '',
  `img2` varchar(25) NOT NULL default '',
  KEY `lstid` (`rid`),
  KEY `city` (`city`),
  KEY `pets` (`pets`),
  KEY `bed` (`bed`),
  KEY `bath` (`bath`),
  KEY `garage` (`garage`),
  KEY `yard` (`yard`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `listings`
-- 

INSERT INTO `listings` VALUES (1, 1, 'Home', '1313 Mockingbird Land', '', 'grass valley', 'ca', 'No', 'test listing', 3, '2', 'No', 'No', 'None', '1500', '1000', '2005-02-06', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `userid` int(10) NOT NULL auto_increment,
  `llid` int(10) NOT NULL default '0',
  `fname` varchar(35) NOT NULL default '',
  `lname` varchar(35) NOT NULL default '',
  `email` varchar(75) NOT NULL default '',
  `addone` varchar(75) NOT NULL default '',
  `addtwo` varchar(75) NOT NULL default '',
  `city` varchar(35) NOT NULL default '',
  `state` varchar(25) NOT NULL default '',
  `zip` varchar(15) NOT NULL default '',
  `phone` varchar(25) NOT NULL default '',
  `passwd` varchar(35) NOT NULL default '',
  `tdate` date NOT NULL default '0000-00-00',
  KEY `userid` (`userid`),
  KEY `email` (`email`),
  KEY `passwd` (`passwd`),
  KEY `date` (`tdate`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 1, 'Herman', 'Muenster', 'guest', '1313 Mockingbird Land', '', 'grass valley', 'ca', '95949', '555-555-5555', '084e0343a0486ff05530df6c705c8bb4', '2005-02-06');
