<?php
/*
 * I choose to use a php file to hold all configuration instead of a database
 * since it was faster to make and faster to use.
 * Also, I wanted this to be useable without the need of a database, of course
 * you cannot add events then, but it's a great calendar :)
 */

$cal->DB_TABLE_NAME = 'calendar'; // Name of the database table
$cal->OPTIONS_ADMIN = true; // simply remove this line for your public calendar
$cal->PATH_PAGE_DELETE = 'calendar.delete.php'; // POST file
$cal->PATH_PAGE_STOP = 'calendar.stop.php'; // POST file
$cal->PATH_PAGE_UPDATE = 'calendar.update.php'; // POST file
$cal->PATH_PAGE_ADD = 'calendar.add.php'; // POST file
$cal->PATH_PAGE_CALENDAR = 'calendar.example.php'; // Display the calendar
$cal->PATH_PAGE_EVENT = 'calendar.event.php';  // the form
$cal->PATH_PAGE_SHOW_EVENTS = 'calendar.showevents.php';  // the form

// Do NOT add more values into this array, since it's not supported in the
// programming. It's only used to hold the strings for easy translation.
$cal->arrEventTypes[0] = 'One Time Eevent';
$cal->arrEventTypes[1] = 'Annual Event';
$cal->arrEventTypes[2] = 'Monthly Event';
$cal->arrEventTypes[3] = 'Weekly Event';
$cal->arrEventTypes[4] = 'Daily Event';

$cal->FORM_METHOD = 'GET'; // For the next and prev buttons
$cal->FORM_NEXT_BUTTON = 'next &gt;&gt;';
$cal->FORM_PREV_BUTTON = '&lt;&lt; prev';

$cal->MONTHNAMES = 1;  // 0 = short, 1 = long
$cal->WEEKDAYNAMES = 1; // 0 = short, 1 = long
$cal->DISPLAY_WEEKDAY_NAMES_ON_COLUMN = false;
$cal->DATEBOX_TEXTALIGN = 'left'; // left, right, center
$cal->CALENDAR_TYPE = 'vertical'; // mini,large,vertical
$cal->EVENT_TARGET = ''; // Target window of the events. Leave blank when EVENT_POPUP=true 
$cal->EVENT_POPUP = true; // popup window or not

$cal->TABLE_SIZE['vertical'] = '500';
$cal->TABLE_SIZE['mini'] = '200';

$cal->WEEK['mini'] = 'w';
$cal->WEEK['vertical'] = 'w.';

$cal->CSS['mini'] = 'css/mini.css';
$cal->CSS['vertical'] = 'css/vertical.css';
$cal->CSS_COMMON = 'css/common.css';

//Strings
$cal->arrStrings[0] = 'h';  // short for hours

// Arrays for holding the names of each month
$cal->arrMonth[0][1] = 'Jan';
$cal->arrMonth[0][2] = 'Feb';
$cal->arrMonth[0][3] = 'Mar';
$cal->arrMonth[0][4] = 'Apr';
$cal->arrMonth[0][5] = 'May';
$cal->arrMonth[0][6] = 'Jun';
$cal->arrMonth[0][7] = 'Jul';
$cal->arrMonth[0][8] = 'Aug';
$cal->arrMonth[0][9] = 'Sep';
$cal->arrMonth[0][10] = 'Oct';
$cal->arrMonth[0][11] = 'Nov';
$cal->arrMonth[0][12] = 'Dec';

$cal->arrMonth[1][1] = 'January';
$cal->arrMonth[1][2] = 'February';
$cal->arrMonth[1][3] = 'March';
$cal->arrMonth[1][4] = 'April';
$cal->arrMonth[1][5] = 'May';
$cal->arrMonth[1][6] = 'June';
$cal->arrMonth[1][7] = 'July';
$cal->arrMonth[1][8] = 'August';
$cal->arrMonth[1][9] = 'September';
$cal->arrMonth[1][10] = 'October';
$cal->arrMonth[1][11] = 'November';
$cal->arrMonth[1][12] = 'December';

// Days marked in the calendar as holidays
// Add dates like 'MM/DD'
$cal->arrRedDates[0] = '12/24';
$cal->arrRedDates[1] = '1/1';
$cal->arrRedDates[2] = '12/13';
$cal->arrRedDates[3] = '2/13';

// Weekdays that are marked as holidays
$cal->arrRedDays[0] = true;  // Sunday
$cal->arrRedDays[1] = false; // Monday
$cal->arrRedDays[2] = false; // Tuesday
$cal->arrRedDays[3] = false; // Wednesday
$cal->arrRedDays[4] = false; // Thursday
$cal->arrRedDays[5] = false; // Friday
$cal->arrRedDays[6] = true; // Saturday

// Arrays for holding the names of each weekday
$cal->arrDay[0][0]="Su";
$cal->arrDay[0][1]="Mo";
$cal->arrDay[0][2]="Tu";
$cal->arrDay[0][3]="We";
$cal->arrDay[0][4]="Th";
$cal->arrDay[0][5]="Fr";
$cal->arrDay[0][6]="Sa";

$cal->arrDay[1][0]="Sunday";
$cal->arrDay[1][1]="Monday";
$cal->arrDay[1][2]="Tuesday";
$cal->arrDay[1][3]="Wednesday";
$cal->arrDay[1][4]="Thursday";
$cal->arrDay[1][5]="Friday";
$cal->arrDay[1][6]="Saturday";
?>