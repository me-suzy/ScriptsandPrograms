#===========================================================================
#= Script : Download Counter
#= File   : readme.txt
#= Version: 0.2
#= Author : Mike Leigh
#= Email  : mike@mikeleigh.com
#= Website: http://www.mikeleigh.com/dev/downloadcounter
#= Support: http://www.mikeleigh.com/forum
#===========================================================================
#= Copyright (c) 2003 Mike Leigh
#= You are free to use and modify this script as long as this header
#= section stays intact
#= This file is part of DownloadCounter.
#=
#= This program is free software; you can redistribute it and/or modify
#= it under the terms of the GNU General Public License as published by
#= the Free Software Foundation; either version 2 of the License, or
#= (at your option) any later version.
#=
#= This program is distributed in the hope that it will be useful,
#= but WITHOUT ANY WARRANTY; without even the implied warranty of
#= MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#= GNU General Public License for more details.
#=
#= You should have received a copy of the GNU General Public License
#= along with DownloadCounter; if not, write to the Free Software
#= Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#===========================================================================

About
Download Counter is a php/MySQL download counting script which tracks downloads on 
a daily basis.

Notes
The url form of download.php?fileid=1 is now depracated, use instead download.php?file=1 or download.php?download=1
At some point in time the url form of download.php?fileID=1 will be removed.  In the meantime I have left comments in the code of where
this is so you can use both forms of the url to download files.  I advise that you update your links and listings to the new form as at some point in the future the old form will be removed.  It has been left in because mamy search engines will need time to update the linke
to the new form of the url.  This will not have any effect if this is your first installation of the Download Counter.

Upgrading from 0.1
Please pay special attention here if you are upgrading.
1) backup backup backup backup backup your database and Download Counter files in case you need to roll back.  Enough said on this I think :)
2) there is an upgrade.php script which you will need to run (just like running the database.php script), dont run the database.php script.  The upgrade script will alter exsiting tables, add new tables and insert the admin user password.

Installation
Create a database named [download] or the same as the db_name variable in config.php
Create a folder/directory on your server named downloads

Modify the following variables in config.php to suit your own needs
$db_host : the name of your server - often called localhost
$db_user : the username of your server
$db_pass : the MySQL password for the $db_user
$db_name : the MySQL database name
$dl_path : the path to your download location from where you have installed download.php
$dl_absolute_path : the absoulte path to download.php - e.g. http://www.mikeleigh.com/download.php

Copy the following files to your domain root (mydomain.com)
download.php

Copy the following files to your newly created download directory
admin.php
adminexec.php
database.php
config.php
upgrade01_02.php
false.gif
true.gif

database.php is used to create the tables on your MySQL database.  You can also 
use phpMyAdmin and create the table structure manually.
Open a web broswer and goto http://www.yourdomain.com/downloads/database.php or http://www.yourdomain.com/downloads/upgrade.php if you are upgrading to set up the database tables and default entries

Open a web broswer and goto http://www.yourdomain.com/downloads/admin.php use the username of admin with password 1234 (the password for admin stored in the user table is an md5 hash of the string 1234).
You can now set up your file downloads.  Note that each downloads has to have a file associated with it.

you can then download these files using the url construct of the form
http://www.mikeleigh.com/download.php?file=1

You may remove the database.php file once the database has been configured

If you have any questions / suggestions then please either email me or vist my forums - details can 
be found in the header at the start of this file

Future / To Do list
1) Creat various stats scripts (e.g. top 10 downloads, 5 most popular downloads this week, etc)
2) Create graphs for the statistics
3) Please email me your suggestions :-)

If you use this script on your webserver then I would appreciate you telling me. You dont have to do this if you dont want to.

Mike Leigh 23/03/2004