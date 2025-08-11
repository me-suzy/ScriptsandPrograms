boastMachine v3.1 UPGRADE info (June 2005)
------------------------------

If you are an existing user of boastMachine (3.0 platinum) and you are upgrading
to boastMachine 3.1, you can use this script to upgrade the DB (mysql) automatically.
The upgrade script converts your 3.0 database to 3.1 format.

Usage:
------

Please note that the upgrade script only upgrades the database, all other physical files
like templates, attached files etc.. will have to be replaced manually.

1. Upload boastMachine 3.1 to your EXISTING blog directory (3.0)
   ( You can spare the ./files if you need to keep the uploaded files.
     All other files and directories should be overwritten.
     And make sure that ./bmc/inc/vars/bmc_conf.php remains intact )

2. Upload upgrade.php to your blog directory from this package

3. Goto http://yoursite.com/blog/upgrade.php and click the upgrade button.
   Thats it!


	IMPORTANT: DONOT RUN THE 3.1 INSTALL SCRIPT! THAT WILL DESTROY YOUR EXISTING DATA!


Notes:
------
IT IS IMPORTANT THAT YOU DELETE upgrade.php MANUALLY after the upgrade (Security reasons)

If you have uploaded files etc. Keep the corresponding directories intact.
You dont necessarily need to touch ./files ./rss ./backup ./inc/vars

Also, keep your blog static files unaltered!
You dont need to overwrite index.php that is inside your parent blog directory

DO NOT RUN THE 3.1 install script! All you have to do is run upgrade.php
REMEMBER, if you run install.php, you'll lose all your data.

It is recommended that you take a backup of your old blog db before upgrading, although it is not necessary


Support:
--------
Official boastMachine website : http://boastology.com
Email : support@boastology.com



Regards,
Kailash Nadh
http://kailashnadh.name