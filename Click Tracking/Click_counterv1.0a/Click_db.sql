# phpMyAdmin SQL Dump
# version 2.5.2
# http://www.phpmyadmin.net
#
# Host: jupiter.webfusion.co.uk
# Generation Time: Oct 01, 2005 at 03:17 PM
# Server version: 3.23.56
# PHP Version: 4.3.10
# 
# Database : `clickcounterDB`
# 

# --------------------------------------------------------

#
# Table structure for table `ClickTable`
#
# Creation: Sep 30, 2005 at 04:57 PM
# Last update: Oct 01, 2005 at 02:34 PM
#

CREATE TABLE `ClickTable` (
  `click_id` int(11) NOT NULL auto_increment,
  `click_name` varchar(50) NOT NULL default '',
  `click_url` varchar(100) NOT NULL default '',
  `click_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`click_id`)
) TYPE=MyISAM AUTO_INCREMENT=72 ;

#
# Dumping data for table `ClickTable`
#


INSERT INTO `ClickTable` VALUES (1, 'AGTC Home Page', 'http://www.agtc.co.uk', 250);
