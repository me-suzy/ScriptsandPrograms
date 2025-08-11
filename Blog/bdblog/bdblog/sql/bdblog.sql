# phpMyAdmin MySQL-Dump
# version 2.2.2
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Sunucu:: localhost
# Çýktý Tarihi: Temmuz 03, 2003 at 03:26 PM
# Server sürümü: 3.23.46
# PHP Sürümü: 4.3.2
# Veritabaný : `bdblog`
# --------------------------------------------------------

#
# Tablo için tablo yapýsý `categories`
#

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id int(11) NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Tablo döküm verisi `categories`
#

INSERT INTO categories (id, title) VALUES (9, 'Work');
INSERT INTO categories (id, title) VALUES (8, 'Personal');
# --------------------------------------------------------

#
# Tablo için tablo yapýsý `entries`
#

DROP TABLE IF EXISTS entries;
CREATE TABLE entries (
  id int(11) NOT NULL auto_increment,
  category int(11) NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  title varchar(100) NOT NULL default '',
  text text NOT NULL,
  PRIMARY KEY  (id),
  FULLTEXT KEY title (title,text)
) TYPE=MyISAM;

#
# Tablo döküm verisi `entries`
#

INSERT INTO entries (id, category, date, title, text) VALUES (19, 0, '2003-07-03', 'Test entry', '<P>Test entry.</P>\r\n<P>I\'ve finished writing this blog software just several minutes ago...<BR>(2003-07-03)</P>');

