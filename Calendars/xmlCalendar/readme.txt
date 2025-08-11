xmlCalendar v1.1 README
	Script and README Author: <http://www.fromthedesk.com/code>
	Script Last Modified: 11/08/2005
	README Last Modified: 11/08/2005

TABLE OF CONTENTS
1. Purpose
2. Requirements
3. Installation
4. Customization
5. How to Use
6. Change Log
7. Reporting Bugs
8. Acceptable Use
9. Donate

1. PURPOSE - Brief Explanation, Advantages, and Limitations
	xmlCalendar v1.1 uses an XML file to display events on a calendar. The calendar automatically displays the current month and users can navigate to past and future months. Adding, editing, and deleting events in the XML file is simple. A stylesheet is used to easily change the calendar design. Days listed with events can appear differently than other days.

2. REQUIREMENTS - Necessary Software and Server Access
	PHP must be installed on your Web server.

3. INSTALLATION - Step-by-Step
	(1) Download and unzip calendar.zip.  You should now have the following files:
		* calendar.php
		* calendar.xml
		* calendar.css
	(2) Upload the files.
	(3) You should finish by testing it.

4. CUSTOMIZATION
	If you know CSS, you may customize the calendar design using calendar.css.  The HTML output of calendar.php is basic to allow maximum use of CSS.  One built-in feature assigns a special CSS class of the TD tag to cells with events.  This allows you, for example, to make events appear in red.
	If you are comfortable with PHP, you can also edit the HTML output in calendar.php.

5. HOW TO USE
	To begin adding your own events, open calendar.xml for editing.  If you know XML, you will quickly understand how to use xmlCalendar.  If not, read on.
	Notice that the file is heavily tabbed.  You'll notice three levels: year, month, and day.  It looks like this:

<Y2006>
	<January>
		<D1>New Year's Day</D1>
	</January>
</Y2006>

	Also notice that the XML code looks much like HTML code except the tag names are unfamiliar.  XML allows you to create your own tags.  Just like HTML, XML must have opening and closing tags and data can be stored within the tags.  Year tags include the letter "Y" followed by the year.  Month tags are the full name of the month.  Day tags include the letter "D" followed by the day.
	You can easily add events.  If you need to, create the year and month tags to place your day event tag.  You can only add one tag per day.  Also keep in mind that the events are meant to be simple titles or headlines.
	You can easily delete events.  Delete the day tag.  If there are no other events in that month, delete the month tags.  If there are no other events in that year, delete the year tags.  (Remember to delete opening and closing tags.)
	Remember to upload calendar.xml to your site after you make changes.  Always refresh the calendar to make sure you didn't make any mistakes in calendar.xml.

6. CHANGE LOG

9/27/2005: xmlCalendar 1.0 displayed only the data from the first year tag in the XML file.  Version 1.1 resolves this problem.

10/14/2005: xmlCalendar now displays month names for the previous and next month links.  The CSS stylesheet has also been modified so that the table cells for days are square.  Lastly, the XML file now includes the proper dates for 2005 and 2006 holidays.

11/08/2005: xmlCalendar now works without PHP's global_registers set to "On".

7. REPORTING BUGS
	Visit <http://www.fromthedesk.com/code> for updates and bug reporting.

8. ACCEPTABLE USE
	You may freely use, modify, and distribute this script.

9. DONATE
	Found this script useful?  Donate a couple of bucks!  Donations pay for my Web site.  You can donate in two easy ways:

Amazon Honor System: <http://s1.amazon.com/exec/varzea/pay/TRYEUATI4836V>

PayPal: <https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=jp%40john117%2ecom&item_name=The%20JPT%20Web%20site&amount=2%2e00&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8>