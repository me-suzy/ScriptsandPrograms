
 Fast Click SQL Lite v1.1.2 (c)2005 by Dmitry Ignatyev aka Trainer
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 Fast Click SQL is a powerful tool for counting and analyzing 
 the visitor's clicks on your web site links. It's generates 
 detailed statistics for clicks for any period of time that 
 your need (from 1 hour to 1 year and above). Anything that
 can be hyperlinked can be counted with Fast Click SQL.

 Features:
  * Easy installation and configuration
  * Convenient link management interface (add,edit,rename,delete)
  * Use both local and global links
  * One script for any type of links
  * Realtime statistics
  * Statistics for any intervals of time
  * Different types of statistics
  * Supports groups of the links
  * Works fast
  * and many more...

 System Requirements:
  * PHP4 or newer
  * MySQL server

 Installation:
  1. Unpack the Fast Click SQL archive, using directory names.
  2. Upload all files to the directory that you want them
     installed in (ie. /fclick). Make sure that you are
     uploading in ASCII mode.
  3. Set permissions for directories and files.
     These directories need permission 777:
     - directory where your php scripts will live (/fclick);
     Setting permissions for other directories and 
     files are not required on most servers.  
  4. You are now ready to begin the WWW based portion of the
     setup. In your browser, type in the full URL to the 
     /fclick/admin/admin.php file on your server. This will 
     bring up the portion of the script where you will set 
     some variables.
  5. You should now be ready to begin using the scripts. The first
     thing you will want to do is point your browser to admin.php.
     Login using entered password. Once inside the admin script you
     can start exploring the features.
  6. In "Database/Links" section you have to add the links that you
     want to track. After that you must replace the URL code of the 
     links on your web site pages. Feel free to edit the received 
     URL code if it is necessary (linking text, style, color and 
     other setting). 
  7. That's All.

 Administration:
  1. Before you can track a link you have to add it
     to your database:
      a) On admin page http://www.yousite.com/fclick/admin/admin.php
  2. To count clicks use:
     <a href="http://www.yousite.com/fclick/fclick.php?ID">your link</a>
     or
     <a href="http://www.yousite.com/fclick/fclick.php?id=ID">your link</a>
     where ID - your link id
  3. To show link or group counter you may use Counter Generator
     Goto Administration Panel -> Tools -> Counter Generator
     Setup options and click button "Generate". Insert the 
     received code into your page. It's all!
 
     OR:

     To show link counter statistic enter
     JavaScript:

       <script language="Javascript"
          src="fclick/show.php?js=1&id=ID&period=PERIOD"></script>

     or with SSI: <!--#include virtual="fclick/show.php?ID"-->
     or           <!--#include virtual="fclick/show.php?id=ID&period=PERIOD"-->

     where ID - your link id
           PERIOD - period of statistic.
                    (ie.  0 - for today,
                          1 - for today and yesterday,
                          7 - for week,
                         30 - for month,
                     you may use different values (0-10000...)
                     "total" - total of clicks,
                     Default is "total")
           "fclick/" - relative path to fclick dir

     To show category counter statistic enter
     JavaScript:

       <script language="Javascript"
          src="fclick/show.php?js=1&cid=CID&period=PERIOD"></script>

     or with SSI: <!--#include virtual="fclick/show.php?cid=CID&period=PERIOD"-->

     where CID - your category id
           PERIOD - period of statistic.
                    (ie.  0 - for today,
                          1 - for today and yesterday,
                          7 - for week,
                         30 - for month,
                     you may use different values (0-10000...)
                     "total" - total of clicks,
                     Default is "total")
           "fclick/" - relative path to fclick dir

_________________________________________________________
Please feel free to contact me with any comments,
suggestions, bug fixes, criticism, or just a
pleasant message.

E-Mail: ftrainsoft@mail.ru
Web: http://www.ftrain.siteburg.com
