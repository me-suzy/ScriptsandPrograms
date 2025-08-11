version 1.6
released 3 Mar 2005

note: i would really appreciate people sending me links
on how they use it :)

Thanks for trying this out, i hope it works for everyone.
The install should be pretty easy, just check the mms.class.php
file and edit the config. 
Be sure to have php, mysql and imap support installed on your
webserver, otherwise its a no go. (or order at hosting.bolink.org)

if you want to add a table manually, use this :

CREATE TABLE mms (
  id int(11) NOT NULL auto_increment,
  type text NOT NULL,
  subject text NOT NULL,
  date text NOT NULL,
  UNIQUE KEY id (id)
) TYPE=MyISAM;

and make sure the directory ($images_dir) is created and writable.

ruben@bolink.org
http://bolink.org/projects/mms/