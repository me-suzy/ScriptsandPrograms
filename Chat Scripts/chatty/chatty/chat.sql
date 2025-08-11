#$Id$
# This file is part of Chatty :)
# Copyright (C) 2003, 2004, 2005 Marco Olivo
#
# Chatty :) is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
# 
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

CREATE DATABASE chatty;
USE chatty;

#
# Table structure for table 'users'
#
DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255),
	email VARCHAR(255),
	active VARCHAR(1) DEFAULT 'n',
	sent_on TIMESTAMP,
	UNIQUE(username)
);

#
# Table structure for table 'msg'
#
DROP TABLE IF EXISTS msg;
CREATE TABLE msg(
	id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255),
	msg VARCHAR(255),
	color VARCHAR(1),
	sent_on TIMESTAMP
);
