CREATE TABLE `blog` (
  `id` int(11) NOT NULL auto_increment,
  `title` text collate latin1_general_ci NOT NULL,
  `message` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `comment` text collate latin1_general_ci NOT NULL,
  `name` text collate latin1_general_ci NOT NULL,
  `email` text collate latin1_general_ci NOT NULL,
  `entryid` int(11) NOT NULL default '0',
  `time` text collate latin1_general_ci NOT NULL,
  `temp` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;