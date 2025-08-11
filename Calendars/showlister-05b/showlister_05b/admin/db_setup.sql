# Host: localhost
# Database: showlister_04b
# Table: 'showlister_artists'
# 
CREATE TABLE `showlister_artists` (
  `artist_id` int(11) NOT NULL auto_increment,
  `artist_name` varchar(100) default NULL,
  `artist_email` varchar(100) default NULL,
  `artist_phone` varchar(100) default '',
  `artist_url` varchar(100) default NULL,
  PRIMARY KEY  (`artist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1; 

# Host: localhost
# Database: showlister_04b
# Table: 'showlister_shows'
# 
CREATE TABLE `showlister_shows` (
  `show_id` int(11) NOT NULL auto_increment,
  `month` int(2) default NULL,
  `day` int(2) default NULL,
  `year` int(4) default NULL,
  `location` varchar(100) default NULL,
  `venue` varchar(100) default NULL,
  `details` varchar(100) default NULL,
  `artist_id` int(11) default NULL,
  PRIMARY KEY  (`show_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1; 
