// *************************************************************************************************
// Title: 			PHP AGTC-Click Counter v1.0a
// Developed by: 	Andy Greenhalgh
// Email:			andy@agtc.co.uk
// Website:			agtc.co.uk
// Copyright:		2005(C)Andy Greenhalgh - (AGTC)
// Licence:			GPL, You may distribute this software under the terms of this General Public License
// *************************************************************************************************
//
README.txt

Hi thank you for downloading my new Click Counter v1.0a

If you ever want to know how many people are visiting a certain part of your site or how many people are linking from other sites to you
then this is the ideal little program for you, simply copy and paste the link id to replace the original URL. Each time someone clicks on that
link it will increase your counter for that link id.

You will require a mysql database and PHP on your server.

First thing is upload all files contained in Zip to a suitable folder on your server.

You will need to copy and paste the Click_db.sql code into your Sql to set up the database.
I recommend using PhpMyadmin for managing Sql databases.

1.
Click 'SQL' on the main tool bar in PhpMyadmin and click 'browse' next to location of text file
Find the file 'Click-db.sql' in folder where you downloaded Click Counter to.
Then click 'Go' this will upload the Sql file.

2.
Open 'config.php' and change the equired database details for your own, also you will need to put in your
website URL and the folder where you uploaded Click Counter to.
Example below. (Do not forget the / at each end of your $site_folder
$site_url = "http://www.agtc.co.uk"; // CHANGE THIS TO YOUR OWN WEBSITE URL Ie.(http://www.mysite.com)
$site_folder = "/work/clickcounter/"; // WHERE YOUR AGTC CLICK COUNTER FOLDER IS (/myfolder/clickcounter/)

3. Thats it, any problems please email me...  andy@agtc.co.uk
