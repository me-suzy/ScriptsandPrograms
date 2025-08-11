-- 
-- Table structure for table `pwiki_config`
-- 

CREATE TABLE `pwiki_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_info` text NOT NULL,
  `config_value` varchar(255) NOT NULL default ''
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `pwiki_history`
-- 

CREATE TABLE `pwiki_history` (
  `ID` int(11) NOT NULL auto_increment,
  `pageid` int(11) NOT NULL default '0',
  `postdate` int(11) NOT NULL default '0',
  `author` varchar(50) NOT NULL default '',
  `reason` varchar(50) NOT NULL default '',
  `body` text NOT NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pwiki_pages`
-- 

CREATE TABLE `pwiki_pages` (
  `ID` int(11) NOT NULL auto_increment,
  `postdate` int(11) NOT NULL default '0',
  `locked` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `body` text NOT NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pwiki_users`
-- 

CREATE TABLE `pwiki_users` (
  `ID` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `joindate` int(11) NOT NULL default '0',
  `logindate` int(11) NOT NULL default '0',
  `ipaddress` varchar(50) NOT NULL default '',
  `status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `pwiki_config`
-- 

INSERT INTO `pwiki_config` VALUES ('sitename', 'The name of your wiki such as Mike''s Information Database or Ultimate Wiki or Crazy Clear Systems and so on.', 'Particle Wiki');
INSERT INTO `pwiki_config` VALUES ('defaultpage', 'This is the page that will be shown as the homepage. Enter the page''s title. The default is Homepage. It will mess up your wiki if the page doesn''t exist so make sure it does.', 'Homepage');
INSERT INTO `pwiki_config` VALUES ('wikipage', 'This is the page of your wiki so if you want to use some crazy server side scripting to change it to home.html or something, you can change all the links just by changing this value to the appropriate name.', 'index.php');
INSERT INTO `pwiki_config` VALUES ('allowhtml', 'If you are running the wiki in a secure environment, ie, not accessable via the public then you can enable HTML. Certain tags are enabled anyway. Set it to 1 to enable HTML or 0 to disable HTML.', '0');
INSERT INTO `pwiki_config` VALUES ('anonedit', 'This is set to 1 by default. If so, any user can come along and edit the page which is what a wiki is all about. If you want to only allow users who are logged in to edit the page though set it to 0.', '1');
INSERT INTO `pwiki_config` VALUES ('dateformat', 'This is the format that your date''s will follow when it says when the page was created or edited. It uses the PHP date format and you can find a guide <a href="http://uk.php.net/date">here</a>. Be careful that you enter a valid formula though.', 'j F Y H:i a');
INSERT INTO `pwiki_config` VALUES ('noformatting', 'If you disable HTML, you may want to disable all the auto formatting such as headers, bold text, links etc that the script provides and code everything in HTML. If you wish to do this, set it to 1, if not leave it at 0.', '0');
INSERT INTO `pwiki_config` VALUES ('defaultskin', 'This is the skin that will be displayed to users by default. Our main skin is ParticleBlue so use that if you don''t have another. If you want to use a different skin simply enter the name of the folder inside the skins folder. It is case sensitive! If you still see the same skin, files may be missing and therefore it may default back.', 'ParticleBlue');
INSERT INTO `pwiki_config` VALUES ('defaultback', 'By default, if a skin file is missing, Particle Wiki will try and use the ParticleBlue files. Set this to 1 to do this. However if you would like it to error out (good for checking for missing files) then set this to 0.', '1');
INSERT INTO `pwiki_config` VALUES ('version', '', '1.0.1');
INSERT INTO `pwiki_config` VALUES ('versionint', '', '2');

-- 
-- Dumping data for table `pwiki_pages`
-- 

INSERT INTO `pwiki_pages` VALUES (1, 1110149541, 0, 'Homepage', 'Welcome to Particle Wiki!\r\n\r\n==Wiki Pages==\r\n*Use the [[Sandbox]] for testing\r\n*Read the [[Formatting Guide]] on how to use the formatting mark-up');
INSERT INTO `pwiki_pages` VALUES (2, 1110149563, 0, 'Sandbox', 'Use this page for testing!\r\n\r\n''''''Bold text''''''\r\n\r\n''''Italic text''''\r\n\r\n[[Homepage|Link to the homepage]]\r\n\r\n==Random Junk==\r\n\r\nHmm, let me see<br />\r\n''''''''''Testing 1 2''''''''''\r\n\r\n[[Sandbox]], [[Spaced Link]], [[Image Testing]]<br />\r\n[[Image Testing|Look at the different text here]]\r\n\r\n[http://www.link.com/with a space.htm] and text afterwards\r\n\r\n[http://www.example.com/|Visit Example.com, it''s cool!]');
INSERT INTO `pwiki_pages` VALUES (5, 1110149493, 0, 'Formatting Guide', 'The mark-up is explained at the bottom of the edit page. Also, if you click the edit link on this page you can see examples of all the markup used.\r\n\r\n==General layout==\r\nIf you leave a blank line between two lines of text then it will start a new paragraph. Also if you want to start a new line at any time use &lt;br /&gt;. You can also use horizonal rules by using &lt;hr /&gt;.\r\n\r\nIf you want to give emphasis to text you can use &#39;&#39;italic&#39;&#39;, &#39;&#39;&#39;bold&#39;&#39;&#39; or combine them both together to make text bold and italic.\r\n\r\n==Linking==\r\nTo create a link to another wiki page simply put two square brackets around it. Such as &#91;&#91;Homepage&#93;&#93;. To link to an external website use &#91;http://www.example.com/&#93;.\r\n\r\nYou can also display different text to where the link goes. For example &#91;&#91;Homepage|this text links to the homepage&#93;&#93; would produce [[Homepage|this text links to the homepage]]. This also works with external links.\r\n\r\n==Headings==\r\nYou can create different sections by using equals signs. 2 for a main section which can then be linked to. For example to link to this headings section you would use &#91;&#91;Formatting Guide#Headings&#93;&#93;.\r\n\r\nYou can also use sub headings. These are smaller and do not draw a line below (although the line is just a CSS thing and might not be on your skin anyway). You cannot link to these sections. Use 3 equals signs for the first sub-heading and 4 equals signs for an even smaller one.\r\n\r\n==Images==\r\nIf you want to display an image on the site use &#91;Image:url-goes-here&#93;. You can also add a alt (alternative text) tag to the image by using &#91;Image:url-goes-here|Alt text can be fun!&#93;.\r\n\r\n==Lists==\r\nAn important part of wikis is the good old list. You can have both ordered (1, 2, 3, etc) and unordered (bullet pointed) lists. To create an unorded list simply use &#42; at the start of a line such as the example below.\r\n\r\n&#42;Item 1<br />\r\n&#42;Item 2<br />\r\n&#42;Item 3\r\n\r\n*Item 1\r\n*Item 2\r\n*Item 3\r\n\r\nThe same applies to ordered lists except that you use a hash instead.\r\n\r\n&#35;Item 1<br />\r\n&#35;Item 2<br />\r\n&#35;Item 3\r\n\r\n#Item 1\r\n#Item 2\r\n#Item 3');