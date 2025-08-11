-- phpMyAdmin SQL Dump
-- version 2.6.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 01, 2005 at 04:19 PM
-- Server version: 4.0.21
-- PHP Version: 4.3.10
-- 
-- Database: `attendance`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `site_events`
-- 

CREATE TABLE `site_events` (
  `event_id` int(11) NOT NULL auto_increment,
  `event_date` int(11) NOT NULL default '0',
  `event_description` text NOT NULL,
  `event_title` varchar(200) NOT NULL default '',
  `event_public` int(1) NOT NULL default '0',
  PRIMARY KEY  (`event_id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `site_events`
-- 

INSERT INTO `site_events` VALUES (3, 1112709600, 'This is a meeting for new members.', 'New members meeting', 1);
INSERT INTO `site_events` VALUES (7, 1110038400, 'Regular Monthly Meeting.', 'March Monthly Meeting', 1);
INSERT INTO `site_events` VALUES (4, 1113147000, 'Regular Monthly Meeting', 'April Monthly Meeting', 1);
INSERT INTO `site_events` VALUES (5, 1113399000, 'This is a meeting for leaders only.', 'Leaders Meeting', 0);
INSERT INTO `site_events` VALUES (6, 1115305200, 'Regular Monthly Meeting.', 'May Monthly Meeting', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `site_events_users`
-- 

CREATE TABLE `site_events_users` (
  `field_id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`field_id`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `site_events_users`
-- 

INSERT INTO `site_events_users` VALUES (7, 1, 1003);
INSERT INTO `site_events_users` VALUES (15, 7, 1006);
INSERT INTO `site_events_users` VALUES (12, 3, 1008);
INSERT INTO `site_events_users` VALUES (14, 3, 1007);
INSERT INTO `site_events_users` VALUES (13, 3, 1009);
INSERT INTO `site_events_users` VALUES (10, 2, 1003);
INSERT INTO `site_events_users` VALUES (16, 7, 1005);
INSERT INTO `site_events_users` VALUES (17, 7, 1007);
INSERT INTO `site_events_users` VALUES (18, 7, 1010);

-- --------------------------------------------------------

-- 
-- Table structure for table `site_mb_msg`
-- 

CREATE TABLE `site_mb_msg` (
  `msg_id` int(11) NOT NULL auto_increment,
  `msg_type` int(1) NOT NULL default '0',
  `msg_user` int(11) NOT NULL default '0',
  `msg_date` int(11) NOT NULL default '0',
  `msg_title` varchar(200) NOT NULL default '',
  `msg_from` int(11) NOT NULL default '0',
  `msg_to` int(11) NOT NULL default '0',
  `msg_body` longtext NOT NULL,
  `msg_new` int(1) NOT NULL default '0',
  `msg_delete` int(1) NOT NULL default '0',
  PRIMARY KEY  (`msg_id`)
) TYPE=MyISAM AUTO_INCREMENT=106 ;

-- 
-- Dumping data for table `site_mb_msg`
-- 

INSERT INTO `site_mb_msg` VALUES (100, 1, 2, 1110523892, 'admin', 2, 2, 'test', 1, 0);
INSERT INTO `site_mb_msg` VALUES (101, 2, 2, 1110523892, 'admin', 2, 2, 'test', 0, 0);
INSERT INTO `site_mb_msg` VALUES (103, 2, 2, 1110523929, 'tt', 2, 1, 'tt', 0, 0);
INSERT INTO `site_mb_msg` VALUES (105, 2, 1003, 1110524073, 'testx', 1003, 1, 'sadfsdf', 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `site_user_notes`
-- 

CREATE TABLE `site_user_notes` (
  `note_id` int(11) NOT NULL auto_increment,
  `note_title` varchar(200) NOT NULL default '',
  `note_body` text NOT NULL,
  `note_relation` int(11) NOT NULL default '0',
  `note_type` int(1) NOT NULL default '0',
  `note_post_date` int(11) NOT NULL default '0',
  `note_post_ip` varchar(20) NOT NULL default '',
  `note_post_user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`note_id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `site_user_notes`
-- 

INSERT INTO `site_user_notes` VALUES (7, 'Incident March', 'Barney brought an unloaded gun to the meeting in March, watch him closely from now on.', 1008, 0, 1112373352, '127.0.0.1', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `site_users`
-- 

CREATE TABLE `site_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_login` varchar(30) NOT NULL default '',
  `user_password` varchar(30) NOT NULL default '',
  `user_name` varchar(200) NOT NULL default '',
  `user_address` varchar(200) NOT NULL default '',
  `user_city` varchar(100) NOT NULL default '',
  `user_state` char(3) NOT NULL default '',
  `user_zip` varchar(20) NOT NULL default '',
  `user_country` char(3) NOT NULL default '',
  `user_phone` varchar(39) NOT NULL default '',
  `user_email` varchar(200) NOT NULL default '',
  `user_email2` varchar(200) NOT NULL default '',
  `user_im_aol` varchar(100) NOT NULL default '',
  `user_im_icq` varchar(100) NOT NULL default '',
  `user_im_msn` varchar(100) NOT NULL default '',
  `user_im_yahoo` varchar(100) NOT NULL default '',
  `user_im_other` varchar(200) NOT NULL default '',
  `user_status` int(1) NOT NULL default '0',
  `user_level` int(1) NOT NULL default '0',
  `user_pending` int(11) NOT NULL default '0',
  `user_date` int(11) NOT NULL default '0',
  `last_login` int(11) NOT NULL default '0',
  `last_ip` varchar(20) NOT NULL default '',
  `user_msg_send` int(1) NOT NULL default '0',
  `user_msg_subject` varchar(200) NOT NULL default '',
  `user_protect_delete` int(1) default '0',
  `user_protect_edit` int(11) NOT NULL default '0',
  `user_other` text NOT NULL,
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=1011 ;

-- 
-- Dumping data for table `site_users`
-- 

INSERT INTO `site_users` VALUES (1, 'admin', 'test', 'Site Admin', '', '', 'AK', '', '', '', 'admin@example.com', 'user@yahoo.example.com', '', '', '', '', '', 0, 0, 0, 0, 1112376650, '127.0.0.1', 1, 'New Message', 1, 0, '');
INSERT INTO `site_users` VALUES (1008, '', 'fife', 'Barney Fife', '100 Main', 'Mayberry', '', '', '', '', 'bfife@example.com', '', '', '', '', '', '', 0, 1, 0, 1112373206, 1112376490, '127.0.0.1', 0, '', 0, 0, '');
INSERT INTO `site_users` VALUES (1007, '', 'sally', 'Sally Johnson', '555 West Main', 'Denver', 'CO', '80222', 'US', '757-1212', 'sally@example.com', '', '', '', '', '', '', 0, 1, 0, 1112373092, 1112376529, '127.0.0.1', 0, '', 0, 0, '');
INSERT INTO `site_users` VALUES (1005, '', 'jdoe', 'Jon Doe', '', '', 'CT', '', '', '', 'jon@example.com', '', '', '', '', '', '', 0, 1, 0, 1110530835, 1112376547, '127.0.0.1', 0, '', 0, 0, '');
INSERT INTO `site_users` VALUES (1006, '', 'adoe', 'Alan Doe', '', '', 'AR', '', '', '', 'adoe@example.com', '', '', '', '', '', '', 0, 1, 0, 1110530869, 1112376566, '127.0.0.1', 0, '', 0, 0, '');
INSERT INTO `site_users` VALUES (1009, '', 'ws', 'Julia Goulia', '', '', '', '', '', '', 'jg@example.com', '', '', '', '', '', '', 0, 1, 0, 1112373235, 1112376582, '127.0.0.1', 0, '', 0, 0, '');
INSERT INTO `site_users` VALUES (1010, '', 'sdunc', 'Sandy Duncan', '', '', '', '', '', '', 'sandy@example.com', '', '', '', '', '', '', 0, 1, 0, 1112373282, 1112376640, '127.0.0.1', 0, '', 0, 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `site_vars`
-- 

CREATE TABLE `site_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=36 ;

-- 
-- Dumping data for table `site_vars`
-- 

