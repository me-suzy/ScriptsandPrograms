Version: 0.6.20050830

For first time installation, please refer to the installation section. For upgraders, please refer to the upgrade section.

------------
INTRODUCTION
------------
Calendarix is
- a powerful and easy to use calendar based on PHP and MySQL.
- developed under windows environment and tested with IE6.0 and Firefox 1.0 browser but should work on unix platforms too.

Its features include
- multiple calendar views in day, week, month and by categories.
- login for users to view calendar with login for administrators with special administration module.
- widely configurable in colors, font and functions.
- search through events for text.
- able to enter events with a repeat event feature.
- user auditing of event entries.
- quick navigation of calendar over days, weeks and months through drop-down quick selection boxes.
- approval of events can be enabled/disabled.

Language support is currently Arabic, Chinese, Dutch, Danish, English, Finnish, French, German, Greek, Indonesian, Italian, Norwegian, Polish, Portuguese, Russian, Slovenian, Spanish, Swedish, Turk and Valencian.  If you like this program and would not mind translating the contents, you can just add your translation files in the "cal_languages" folder. Do let me know of your translations.

To use the calendar
- just follow the installation instructions in the section below.
- if you are required to login to view the public calendar, username:'test', password:'testing'.
- for login into the administration, username:'admin', password:'admin'.

-------------
INSTALLATION
-------------
* unzip the file
* Import the "create_cal.sql" in the "admin" folder into your mysqldatabase
  console : mysql -u username -p
	    create calendar; (if necessary change the name)
	    use calendar;
	    source create_cal.sql;
	    quit;
  phpMyAdmin : go to the database and import the sql file.	    

Open "cal_db.inc.php" and check the database references. 
* Check that the database name, database login name, password and host are correct. Make the necessary changes and save the file as "cal_db.inc.php".

Customize the calendar controls with the file "cal_config.inc.php" and the text and colors with the files "default.css", "default.color.php" and "default.menu.css" in the themes folder.

You can customise the login page for calendarix by editing the html files "callogin_top.html" and "callogin_bottom.html".

Change the theme for the calendar display by setting the $theme variable in the cal_config.inc.php file. eg. $theme = 'fire';

Be sure to allow access to the sub-directories under your calendarix path.


---------
UPGRADING
---------
This version is very different from versions 0.5 in look and feel. However, there is no change in the database.  You should be able to work with the same database by simply removing all the old scripts and replacing with this new one.  However, you will have to reconfigure the look and feel of the calendar in the style sheet file "default.css" in the themes folder.

If you are upgrading from older versions 0f 0.6, you only need to replace all the scripts except the database file cal_db.inc.php. Note that some changes have been made on the theme files and they have to be replaced as well. If you have made changes on the theme files or created your own themes, you can do a comparison on the files and add the new attributes.

---------
MINI-CALENDAR
---------
A file "minical.php" is available for providing a mini-calendar to be embedded in website.  It uses overlib support to provide a summary of events in the mini-calendar.  To include the mini-calendar in a page, use the following code:
<?php include("minical.php"); ?>

However, note that the mini-calendar also relies on the files used by Calendarix so they are put in the same path.  Edit the include paths in "minical.php" if you wish to move the "minical.php" to another location.  

You may want to delete "minical.php" if you do not use it as it can be called by users directly to view the mini-calendar.

--------
LICENSE
--------
This application is free for you to use and modify. However, it should not be sold as a commercial product nor be part of a commercial product without first getting my permission.   

THIS SOFTWARE IS PROVIDED ''AS IS'' AND ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE CALENDARIX DEVELOPMENT TEAM OR ITS CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

overLIB 4.14 (c) is written by Erik Bosrup and is used in Calendarix.  For more information about overLib and its licensing, please visit http://www.bosrup.com/web/overlib/.

------------------------------
Any bugs or feature request ?
------------------------------
mail to webmaster@calendarix.com
http://www.calendarix.com

You can also check out the forum at http://www.calendarix.com/forum

If you need someone to host this calendar for you, you can contact me too.
I am still working on improving and adding more features into this application.  


Copyright © 2002-2005 Vincent Hor
