*Thanks for PHPFREAKS.COM for help with the calendar code
*To use this script you must agree not to take any copyright links linking to chipmunk-scripts off any part of the script, failure to comply will result in loss of free liscense to use the script.
To install this script, you must have the following
1. Linux/Unix/FreeBSD OS
2. Apache webserver
3. PHP4.x/MYSQL 3.x or higher
4. Having phpMyAdmin or another sql manager will make installation for newbies easier

New things added in most recent release
- Announcement system for admin
- Listing of most recently updated blog on frontpage
- A few bugs fixed


Steps:
----------------
modify admin/connect.php and put your mysql username, password, and database name where indicated

Go into phpMyAdmin and dump everything thats in installsql.txt into your mysql database, this is the structure for the bloghost. To do this, click the sql tab in phpMyAdmin and paste the contents of installsql.txt in the box

open admin/var.php in notepad and edit the $youremail and $path variables.

Chmod the images folder to 777

Ok, now upload everything except installsql.txt

Go to admin/register.php and register yourself an administrator name and then delete admin/register.php and admin/reguser.php

Edit index.php and put your title where the variable your title is.

Only the administrator will have rights to add and delete users and have access to the sitewide poll. THe default template for the admin panel is in admin/style.css and the userpage templates are in style.css . Users have the ability to edit their own stylesheet.


header.php and footer.php are for you to put headers and footers.


---------------------------------------
To upgrade from the first release please paste in this query

CREATE TABLE bl_accouncements (
  annid bigint(20) NOT NULL auto_increment,
  anntitle varchar(255) NOT NULL default '',
  announcement mediumtext NOT NULL,
  thedate varchar(255) NOT NULL default '',
  thetime bigint(20) NOT NULL default '0',
  PRIMARY KEY  (annid)
)

And then upload everything except the installsql file, the admin/register.php and admin/reguser.php


